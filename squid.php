<?php

  $squid =  file_get_contents('/etc/squid/squid.conf.bak.170701');
  $squid_arr = explode('start', $squid);
  $squid_back = fopen('/etc/squid/squid.conf.bak', 'w');

  fwrite($squid_back, $squid_arr[0]." start \n");


  $mysqli = new mysqli('127.0.0.1', 'root', 'asdf', 'test');
  $mysqli->query("set names utf8");
  $result = $mysqli->query('select `IP`, `PORT` from `proxy` where `area` =2');
  $mysqli->query("delete  from `proxy`  where `area` =2 ");
  if($result->num_rows == 0){
	exit();
  }
  
  $ip_arr = array();
  while($row = $result->fetch_assoc()){
  		$ip = $row['IP'];
		if(in_array($ip, $ip_arr)){
			continue;
		}else{
			$ip_arr[] = $ip;
		}
  		$port = $row['PORT'];
  		$cache_peer = "cache_peer $ip parent $port 0 no-query weighted-round-robin weight=1 connect-fail-limit=20 allow-miss max-conn=5 name=".md5($ip.$port)."\n";
		$mysqli->query("DELETE FROM `proxy` where `IP` = $ip AND `PORT` = $port ");
#		var_dump($cache_peer);
  		fwrite($squid_back, $cache_peer);
  }

  fclose($squid_back);
  copy('/etc/squid/squid.conf.bak', '/etc/squid/squid.conf');
