<?php
		require 'config.php';
		
		$pdo = new PDO($dsn,$user,$password);
		//$sql = "DELETE FROM employeemsg WHERE chinesename='刘心愿' or idcard='511002199110212819'";
		//$sql = "UPDATE employeemsg SET ContactPhone='',ContactAddr='',edulevel='',IDcard='' WHERE chinesename='刘心愿'";
		//$sql = "UPDATE employeemsg SET convert(money,.0000) WHERE chinesename='刘心愿'";
		echo $sql;
	
		$rs  = $pdo -> query($sql);
		if(!$rs){
			$err = $pdo -> errorInfo();
			print_r($err);
			exit;
		}



?>