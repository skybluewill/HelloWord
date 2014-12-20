<?php
		


		/*
		*	GBK和UTF-8编码互转，支持数组和字符串
		*	@parm mix $source	待转换的数组或者字符串
		*	@parm str $encode	待转换的变量本身的编码(其实本来想把这个参数写成"转换后的编码格式"的)
		*/
		function Sconv($source,$encode){
			$encode = strtoupper($encode);		//把编码转换成大些，以便下面比较
			//编码比较
			switch($encode){
				case 'GBK': 
					$decode = 'UTF-8'; 
				break;

				case 'UTF-8':
					$decode = 'GBK';   
				break;

				case 'UTF8':
					$decode = 'GBK';
				break;

			}
			
			//数组和对象编码转换
			if(is_array($source) or is_object($source)){
				foreach($source as $key => $val){
					if(is_array($val)){
						Sconv($val,$encode);
					}
					if(!is_array($val)){
						 $destination[$key] = mb_convert_encoding($val,$decode,$encode);
					}
				}
			}
			
			//字符串转换
			if(is_string($source)){
				 $destination = mb_convert_encoding($source,$decode,$encode);
			}
			var_dump($destination);
			return $destination;
		}
		/*
		*
		*
		*/

		function VarData ($pdo, $table, $condition){
			$sql = 'select count(*) from ' . $table . ' where ' . $condition;	//.字符连接符会忽略掉不是字符串内的“空白”
			if($PdoRs = $pdo->query($sql)){
				if($PdoRs -> fetchColumn() > 0){								//rowCount这个方法大多数数据库都不支持这个方法，所以自定义一个函数
					return true;
				}
				return false;
			}
			return 0;
		}

		function ErrAlert($Info){
			echo '<script type="text/javascript">window.onload=function(){';
			echo 'alert("';
			echo $Info;
			echo '");';
			echo 'location.href='.'"'.$_SERVER['HTTP_REFERER'].'";';
			echo '}</script>';
		}




?>