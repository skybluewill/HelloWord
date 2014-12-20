<?php
		//define('ROOTDIR',$_SERVER['DOCUMENT_ROOT']);		//G:\wamp\www\
		define('ROOTDIR',dirname(__FILE__));				//G:\wamp\www		
		//当单一网站时，区别仅在最后的'\'，如果是多网站时，建议用dirname,因为dirname可以设置为应用的根目录
		require ROOTDIR.'/'.'config.php';
		require ROOTDIR.'/'.'functions.php';	
	


?>