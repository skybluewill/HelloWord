<?php
		require('include.php');
		$search = 'EmployeeMsg';     
		//$pdo = new PDO("odbc:Driver={SQL Server};Server=192.168.50.12;Database=test;",'sa','');
		$pdo = new PDO($dsn,$user,$password);

	/*
	*	$sql = "Select TABLE_NAME FROM test.INFORMATION_SCHEMA.TABLES Where TABLE_TYPE='BASE TABLE'";
	*	$rs  = $pdo->query($sql);
	
		
		$temp = 'no';
		foreach($rs as $v){
			if($v[0] != $search){
				continue;
			} else if($v[0] == $search){
				$temp = 'yes';
				break;
			}
		}
		echo "<script type='text/javascript'>";
		if($temp == 'no'){
			echo "alert('您查询的表不存在')";		
		} else if($temp = 'yes'){
			echo "alert('您查询的表存在')";
		} else{
			echo "alert('程序出错,请轻揉')";
		}
		echo "</script>";
	*/
		$rs = 0;
		$sql = "Select * from OverTimeMsg where OverTimeID = 648526";		//648525
		echo $sql;
		$sql = Sconv($sql,'GBK');
		$rs = $pdo->query($sql);
		if(!$rs){
			print_r($pdo->errorInfo());
			exit;
		}
		foreach($rs as $v){
			//$tvar = mb_convert_encoding($v['ChineseName'],'utf8','gbk');
			//echo $tvar;
			//var_dump($v);
			print_r(Sconv($v,'GBK'));
		}
	





?>