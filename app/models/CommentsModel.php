<?php
require_once 'DB.php';
class CommentsModel
{
    public $db;
    public $text;
    
    public function __construct()
    {
      $this->db = DB::getInstance();  
    }
    
	public function upshot() 
	{
	     $url = $_SERVER['REQUEST_URI'];
         $url = explode('/', $url);
         $upshot=$url[3];
		 return $upshot;
	} 
    
    public function getCategory() 
    {    
		$result = $this->db->prepare("SELECT category.id,category.name, count(*) as count_total
		FROM ads INNER JOIN category  
		ON category.id = ads.category_id
		group by
		category.id, category.name");
        $result->execute();
		return  $categorys = $result->fetchAll(PDO::FETCH_ASSOC);  
    }
    
    public function rules()
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
    
    public function getContent()
    {
       $url = $_SERVER['REQUEST_URI'];
       $url = explode('/', $url);
       $upshot=$url[3];
       $result = $this->db->prepare("SELECT ads.id, ads.text,category.name, users.login, ads.data FROM ads INNER JOIN category ON category_id = category_id
       join users ON users.id = ads.user_id
       Where ads.id = '$upshot'");
       $result->execute();
       return $result->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getFromForm($text)
    {
       $this->text = $_POST["comment"]; 
    }
    
    public function validComment()
    {
        if (!empty($this->text)) {
               return "Ваш комментарий отправлен на проверку"; 
        }
    }
    
    public function addComment()
    {
        $sql = "INSERT INTO comments(text,user_id,ads_id,data_add,confirmation) VALUES(:text, :user_id, :ads_id, :data_add, :confirmation)";
        $result = $this->db->prepare($sql);
        $result->execute(['text' => htmlspecialchars($this->text), 'user_id' => $_SESSION['id'], 'ads_id' => $this->upshot(), 'data_add' => date('Y-m-d H:i:s'),'confirmation' => 0]);
    }
    
    public function getComment()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        $upshot=$url[3];
        $result = $this->db->prepare("SELECT comments.text, comments.data_add,comments.id, ads.id, users.login FROM comments INNER JOIN ads ON comments.ads_id = ads.id join users ON users.id = ads.user_id  WHERE comments.ads_id = '$upshot' AND comments.confirmation = 1 ORDER BY comments.id ASC");
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);    
    }
    
    public function newComment()
    {
        $result = $this->db->prepare("SELECT users.login, comments.text,comments.id
        FROM users INNER JOIN ads  
	    ON users.id = ads.user_id
        join comments ON comments.ads_id = ads.id
        WHERE comments.confirmation=:confirmation ");
        $result->execute(["confirmation" =>0]);   
        return $result->fetchAll(PDO::FETCH_ASSOC); 
    }
    
    public function moderationComment()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        $upshot=$url[3];
        $result=$this->db->prepare("UPDATE comments SET     
        confirmation=:confirmation WHERE id=:id");
        $result->execute(["confirmation" => 1, "id" => $upshot]);   
    }
    
    public function vipUsers()
    {
        $result=$this->db->prepare("SELECT*FROM users WHERE id = :id ");
        $result->execute(['id' => $_SESSION["id"]]); 
        return $result->fetch(PDO::FETCH_ASSOC); 
    }
    
    public function commentsUsers()
    {
        $result=$this->db->prepare("SELECT comments.text,comments.ads_id,comments.id
        FROM comments INNER JOIN ads  
	    ON comments.ads_id = ads.id
        WHERE comments.user_id=:user_id ");
        $result->execute(['user_id' => $_SESSION["id"]]); 
        return $result->fetchAll(PDO::FETCH_ASSOC); 
    }
    
    public function delete()
    {
        $result=$this->db->prepare("DELETE FROM comments WHERE id=:id"); 
        $result->execute(["id" => $this->upshot()]);  
    }
}