<?php
require_once '../models/DB.php';


	$db = Db::getInstance();

	$sth = $db->prepare("SELECT ads.id,users.vip,ads.data,ads.data_raise_vip,ads.data_omit_vip,ads.time_raise_vip FROM ads INNER JOIN users  
	    ON  ads.user_id = users.id
        ");
	$sth->execute([]);
	$arrays = $sth->fetchAll(PDO::FETCH_ASSOC);
    echo $arrays["users.vip"];
    $currentDate = date('Y-m-d H:i:s');

    foreach($arrays as $key=>$value){
        $begin = new DateTime($value['data_raise_vip']);
        $end = new DateTime($value['data_omit_vip']);
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
	
		
	
    foreach ($period as $dt) {
		print_r($dt);
		$dt->modify($value['time_raise_vip']);
		$result = $dt->format("Y-m-d H:i:s");

	if ($value['vip'] == 1){
    if ($currentDate > $result) {
        $sth = $db->prepare('UPDATE ads SET data=:data WHERE `id` = :id'); 
        $sth->execute(['id' => $value["id"], 'data' => $result]); 
    }
	}	
	}
    }




			
	