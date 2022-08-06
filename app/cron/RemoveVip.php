<?php
require_once '../models/DB.php';


	$db = Db::getInstance();

	$sth = $db->prepare("SELECT*FROM `users`");
	$sth->execute([]);
	$arrays = $sth->fetchAll(PDO::FETCH_ASSOC);

	foreach ($arrays as $array) {
		$time = date('Y-m-d H:i:s');	
		if ($array["date_vip_off"] < $time) {
			$sth = $db->prepare("UPDATE users SET vip=0 WHERE `id` = :id"); 
			$sth->execute(['id' => $array['id']]);
		}  
     
    }