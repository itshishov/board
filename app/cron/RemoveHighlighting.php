<?php
require_once '../models/DB.php';


	$db = Db::getInstance();

	$sth = $db->prepare("SELECT*FROM `ads`");
	$sth->execute([]);
	$arrays = $sth->fetchAll(PDO::FETCH_ASSOC);

	foreach ($arrays as $array) {
		$time = date('Y-m-d H:i:s');	
		if ($array["data_end_color"] < $time) {
			$sth = $db->prepare("UPDATE ads SET highlight=0 WHERE `id` = :id"); 
			$sth->execute(['id' => $array['id']]);
        }  
     
    }