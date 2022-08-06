<?php
require_once 'DB.php';

class ProjectModel
{
    private $db;
    
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
    
    public function getCategory() :array
    {    
		$result = $this->db->query("SELECT category.id,category.name, count(*) as count_total
		FROM ads INNER JOIN category  
		ON category.id = ads.category_id
		group by
		category.id, category.name");   
		return  $categorys = $result->fetchAll(PDO::FETCH_ASSOC);  
    }
 
    public function maingetAds() :array
    {  
		$result = $this->db->prepare("SELECT users.login,users.vip, ads.text,ads.data,category.name,ads.id,ads.highlight
		FROM ads INNER JOIN users
		ON users.id = ads.user_id
		join category ON category.id = ads.category_id 
		
        
        WHERE ads.display=:display AND ads.main=:main  ORDER BY data DESC");        
		$result->execute(['display' => 1, 'main' => 1]);  
		return  $res = $result->fetchAll(PDO::FETCH_ASSOC);
        
    }
      public function commentsUsers()
    {
        $result=$this->db->prepare("SELECT*FROM users WHERE id = :id ");
        $result->execute(['id' => $_SESSION["id"]]); 
        return $result->fetch(PDO::FETCH_ASSOC); 
    }

}