<?php
 class DB
 {
     private static $db = null;
     
     public static function getInstance()
     {
     if (self::$db == null) {
         self::$db=new PDO('mysql:host=localhost;dbname=russ;
		 charset=utf8;','root',''); 
         
		 return self::$db;
     }
     }
    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}
 }