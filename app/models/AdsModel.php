<?php
require_once 'DB.php';

class AdsModel
{
    public $text;
    private $db;
    public  $day = 86400;
    public $qty;
    
    public $data_raise_vip;
    public $data_omit_vip;
    public $time_raise_vip;
    
    public function __construct()
    {    
         $this -> db = DB::getInstance();    
    }
	
	public function upshot() 
	{
	     $url = $_SERVER['REQUEST_URI'];
         $url = explode('/', $url);
         $upshot=$url[3];
		 return $upshot;
	}
    
    
    public function setText($text) 
   {
        $this->text = $_POST["text"];
   }
    
    
    public function validForm() 
	{
        if (!empty($this->text)){
             $success = "Ваше объявление опубликуется после проверки модератором";
             return $success;
        }
      
       
    }
    
   public function addAds() 
   {
         
         $sql = 'INSERT INTO ads (text, category_id, user_id, data, display, main, highlight, data_start_color, data_end_color)       
	 	 VALUES(:text, :category_id, :user_id, :data, :display, :main, :highlight, :data_start_color, :data_end_color)';
         $res = $this->db->prepare($sql);
         $res->execute(
             [
             'text' => htmlspecialchars($this->text),
             'category_id' => $_POST['category_id'],
             'user_id' => $_SESSION['id'],
             'data' => date('Y.m.d H:i:s'),
             'display' => 0,
             'main' => 0,
             'highlight' => 0, 
             'data_start_color' => date('Y.m.d H:i:s'),  
             'data_end_color' => date('Y.m.d H:i:s')  
             ]
     );
     }

	 public function getCategory() 
    {    
		$result = $this->db->query("SELECT category.id,category.name, count(*) as count_total
		FROM ads INNER JOIN category  
		ON category.id = ads.category_id
		group by
		category.id, category.name");   
		return  $categorys = $result->fetchAll(PDO::FETCH_ASSOC);  
    }
	
	
	
	
   public function myads() 
   {
       $result = $this->db->query("SELECT users.login, ads.text,ads.data,category.name,ads.id
       FROM ads INNER JOIN users  
       ON users.id = ads.user_id
       join category ON category.id = ads.category_id
	   Where users.login = '{$_SESSION["login"]}'  ORDER BY data DESC");
       return $result->fetchAll(PDO::FETCH_ASSOC); 
   }
    
   public function deleteOneAd() 
   {

       $result=$this->db->prepare("DELETE FROM ads WHERE id=:id"); 
       $result->execute(["id" => $this->upshot()]); 
   }
    
   public function raiseUp() 
   {
        $date = date('Y-m-d H:i:s');
       
        $sql = $this->db->prepare("SELECT*FROM `ads` WHERE id=:id");
        $sql->execute(["id" => $this->upshot()]);
        $ads = $sql->fetch(PDO::FETCH_ASSOC);
        
       
        $ads = new DateTime($ads['data']);
        $ads->setTime(0, 0, 0);
        $ads_itog = $ads->format('Y-m-d H:i:s');
       
        
        
       
        $current_date = new DateTime("$date");
        $current_date->setTime(0, 0, 0);
        $current_date = $current_date->format('Y-m-d H:i:s');
  
       
       
       
        if ($current_date > $ads_itog) {
			$result=$this->db->prepare("UPDATE ads SET  data=:data WHERE id=:id");
			$result->execute(["data" => $date, "id" => $this->upshot()]);   
        }
       else {
           return false;
       }
    }
    
    public function newAds() 
    {
        $result = $this->db->prepare("SELECT users.login, ads.text,ads.data,ads.id,category.name
        FROM ads INNER JOIN users  
	    ON users.id = ads.user_id
        join category ON category.id = ads.category_id WHERE ads.display=:display ");
        $result->execute(["display" =>0]);   
        return $result->fetchAll(PDO::FETCH_ASSOC); 
    } 

    public function moderation(int $qty) 
    {
        $this->qty = (int)$_POST["qty"];
		if (empty($_POST["qty"])) {
			$qty_empty = 0;
			$time = date('Y.m.d H:i:s');
		}
		else {
			$qty_empty = 1;	
			$time = time() +  ($this->qty * $this->day);
		}
        
        $result=$this->db->prepare("UPDATE ads SET     
		display=:display,highlight=:highlight,data_start_color=:data_start_color,data_end_color=:data_end_color WHERE id=:id");
        $result->execute(["display" => 1, "id" => $this->upshot(), "highlight" =>$qty_empty, "data_start_color" => date('Y.m.d    
		H:i:s'), "data_end_color" => 
		date('Y-m-d H:i:s', $time) ]); 
    }
    
    public function moderationMain($qty_main) 
    {
        
          $this->qty = (int)$_POST["qty_main"];
		if (empty($_POST["qty_main"])) {
			$qty_empty = 0;
			$time = date('Y.m.d H:i:s');
		}
		else {
			$qty_empty = 1;	
			$time = time() +  ($this->qty * $this->day);
		}
        
        
        $result=$this->db->prepare("UPDATE ads SET  display=:display, highlight=:highlight, main=:main,data_start_color=:data_start_color,data_end_color=:data_end_color  WHERE id=:id");
 	    $result->execute(["display" => 1, "highlight" =>$qty_empty, "main" => 1, "id" => $this->upshot(), "data_start_color" => date('Y.m.d    
		H:i:s'), "data_end_color" => 
		date('Y-m-d H:i:s', $time)]); 
    }
    
    public function categoryGetContent() 
    {

        $url2 = $_SERVER['REQUEST_URI'];
        $url2 = explode('?page=', $url2);
        $str2=$url2[1];
		
        $page = $str2;    
        $qty_content = 5;
        $res = ($page-1) * $qty_content;
        $result = $this->db->prepare("SELECT users.login,users.vip, ads.text,ads.data,ads.id,ads.highlight,category.name
        FROM ads INNER JOIN users  
        ON users.id = ads.user_id
        join category ON category.id = ads.category_id WHERE ads.display=:display AND ads.category_id=:category_id ORDER BY data DESC LIMIT $qty_content ");
        $result->execute(["display" => 1, "category_id" => $this->upshot()]);

        if (isset($page)) {
        $result = $this->db->prepare("SELECT users.login, ads.text,ads.data,ads.id,ads.highlight,category.name
        FROM ads INNER JOIN users  
        ON users.id = ads.user_id
        join category ON category.id = ads.category_id WHERE ads.display=:display AND ads.category_id=:category_id ORDER BY data DESC LIMIT  $res,$qty_content");
        $result->execute(["display" => 1, "category_id" => $this->upshot()]);  
        }
        return $result->fetchAll(PDO::FETCH_ASSOC);      
    }
    
    public function pagination() 
    {
        $result=$this->db->prepare("SELECT count(*) as count_total FROM ads WHERE category_id = :category_id"); 
        $result->execute(["category_id" => $this->upshot()]); 
        return $result->fetch(PDO::FETCH_ASSOC); 
    } 
	
	public function addingWithoutConfirmation() 
	{
		if (!isset($_SESSION['login'])) {
		$users = $this->db->query("SELECT * FROM users");
		$users->execute();	
		}
		else {
		$users = $this->db->query("SELECT * FROM `users` WHERE id = {$_SESSION['id']}");
		$users->execute();
		}
		return  $result = $users->fetch(PDO::FETCH_ASSOC);
    }
    
    public function commentsUsers()
    {
        $result=$this->db->prepare("SELECT*FROM users WHERE id = :id ");
        $result->execute(['id' => $_SESSION["id"]]); 
        return $result->fetch(PDO::FETCH_ASSOC); 
    }
    
    public function automaticLifting($data_raise_vip, $data_omit_vip, $time_raise_vip)
    {

        $this->data_raise_vip = new DateTime($_POST["data_raise_vip"]);
        $this->data_raise_vip->setTime(0, 0, 0);
        $data_raise_vip = $this->data_raise_vip->format('Y-m-d H:i:s');
       
        $this->data_omit_vip = new DateTime($_POST["data_omit_vip"]);
        $this->data_omit_vip->setTime(0, 0, 0);
        $data_omit_vip = $this->data_omit_vip->format('Y-m-d H:i:s');
       
        
        $this->time_raise_vip = $_POST["time_raise_vip"];
        
       
        
      $result=$this->db->prepare("UPDATE ads SET  data_raise_vip=:data_raise_vip, data_omit_vip=:data_omit_vip, time_raise_vip=:time_raise_vip  WHERE id=:id");
 	    $result->execute(["data_raise_vip" => $data_raise_vip, "data_omit_vip" =>$data_omit_vip, "time_raise_vip" => $this->time_raise_vip, "id" => $this->upshot()]);   
   
    }
    
}