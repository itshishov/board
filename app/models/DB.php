<?php
 class DB
 {
     private static $db = null;
     
     public static function getInstance()
     {
     if (self::$db == null) {
        /* self::$db=new PDO('mysql:host=localhost;dbname=russ;
		 charset=utf8;','root',''); */
		 self::$db=new PDO('mysql:host=localhost;dbname=u1556708_test;
		 charset=utf8;','u1556_708test','1556708Qtest');
		 return self::$db;
     }
     }
    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}
 }