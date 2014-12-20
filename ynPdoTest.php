<?php
		include 'ynpdo.php';
		phpinfo();

		$db=new Database('mysql','127.0.0.1', 'wordpress','root','111111'); 
		//var_dump($db);
		$t=$db->pdo_statement_select(array('*'),'wp_usermeta',"where umeta_id='1'"); 
		var_dump($t); 
?>