<?php  
/** 
 * File name server.php 
 * 服务器端代码 
 *  
 * @author guisu.huang 
 * @since 2012-04-11 
 *  
 */  
  
//确保在连接客户端时不会超时  
set_time_limit(0);  
//设置IP和端口号  
$address = "93.188.160.120";  
$port = 1236; //调试的时候，可以多换端口来测试程序！  
/** 
 * 创建一个SOCKET  
 * AF_INET=是ipv4 如果用ipv6，则参数为 AF_INET6 
 * SOCK_STREAM为socket的tcp类型，如果是UDP则使用SOCK_DGRAM 
*/  
$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("socket_create() 失败的原因是:" . socket_strerror(socket_last_error()) . "/n");  
//非阻塞模式  
socket_set_nonblock($sock) or die("socket_set_block() 失败的原因是:" . socket_strerror(socket_last_error()) . "/n");  
//绑定到socket端口  
$result = socket_bind($sock, $address, $port) or die("socket_bind() 失败的原因是:" . socket_strerror(socket_last_error()) . "/n");
socket_getsockname($sock, $hostAddress, $hostPort) or die('Get Host IP is error'."/n");
//开始监听  
$result = socket_listen($sock, 4) or die("socket_listen() 失败的原因是:" . socket_strerror(socket_last_error()) . "/n");  
echo "OK\nBinding the socket on $address:$port ... ";  
echo "OK\nNow ready to accept connections.\nListening on the socket ... \n";  
/*
do { // never stop the daemon  
    //它接收连接请求并调用一个子连接Socket来处理客户端和服务器间的信息  
    $msgsock = socket_accept($sock) or  die("socket_accept() failed: reason: " . socket_strerror(socket_last_error()) . "/n");  
      
    //读取客户端数据  
    echo "Read client data \n";  
    //socket_read函数会一直读取客户端数据,直到遇见\n,\t或者\0字符.PHP脚本把这写字符看做是输入的结束符.  
    $buf = socket_read($msgsock, 8192);  
    echo "Received msg: $buf   \n";  
      
    //数据传送 向客户端写入返回结果  
    $msg = "welcome \n";  
    socket_write($msgsock, $msg, strlen($msg)) or die("socket_write() failed: reason: " . socket_strerror(socket_last_error()) ."/n");  
    //一旦输出被返回到客户端,父/子socket都应通过socket_close($msgsock)函数来终止  
    socket_close($msgsock);  
} while (true); 
*/
$arr = array($sock);
//var_dump(gethostbyname('lxy.18idc.ml'));
$w = NULL;
$e = NULL;
$change = $arr;
var_dump($arr);
//echo count($arr);
while(1){
	$read = $change;
	//print_r($read);echo "\n";
	//$num_socket_select = 
	if(socket_select($read,$w,$e,500)<1){ continue;}
	//if($num_socket_select > 0){
	if(count($read) == 0){$change = $arr;continue;}
			foreach($read as $v){
				//print_r($read);echo "123\n";
				if($v == $sock){
					$newconn = socket_accept($v);
					if($newconn == false){
						continue;
					}
					array_push($change,$newconn);
				} else {
					$data = socket_read($v,1024,PHP_BINARY_READ);
					#var_dump($data);
					if($data == '' or $data == '\n' or $data === false){
						$index = array_search($v, $change);
						array_splice($change, $index, 1);
						socket_close($v);
						continue;
					}

					if(socket_getpeername($v,$address,$clientPort)){
						$data = $address."[$clientPort]".'说：'.$data;
						$utfData = utf8_encode($data);
					} else {
						$data = 'UNKNOW[未知人物] 说:'.$data;
						$utfData = utf8_encode($data);
					}
					echo $utfData.'11111111';
					foreach($change as $otherC){
							if($otherC == $sock or $otherC == $v){continue;}
							#echo $utfData.'2222222';
							var_dump($otherC);
							$rs = socket_write($otherC,$utfData);
							if($rs == false){echo 'trans failure!!!';}
							else{
								socket_getpeername($otherC,$Caddress,$Cport);
								echo $Cport,'广播成功';
							}
					}
					//echo $utfData,$data,"\n";
				}
			}
	/*} else{
		socket_strerror(socket_last_error());
		break;
	}*/
}
socket_close($sock);  