<?php
$h =  new mysqli('127.0.0.1','root','asdf',"test");
$time = date("Y-m-d", time()-600);
$sql = "select `tbody`, `is_use` from `proxy_tbody` where `is_use` = 0 and `ctime` >".$time;
//echo $sql;die();
$res = $h->query($sql);
while($arr = $res->fetch_assoc()){ echo 123;
    $tbody = $arr['tbody'];
    $tr_arr = explode("</tr>", $tbody);
    foreach($tr_arr as $tr){
        $td_arr = explode("</td>", $tr);
        if(count($td_arr) < 4){
            continue;
        }
        $IP = str_replace("<tr><td>", "", $td_arr[0]);
	$PORT = str_replace("<td>", "", $td_arr[1]);
//	$exec = "nc -z -w  10 $IP $PORT";
//	 exec($exec, $output, $exitCode);
//	if( $exitCode != 0){
//		continue;
//	}
        $sql = "INSERT INTO `proxy`(`IP`, `PORT`, `area`) VALUES('$IP', '$PORT', 2)";
        try{
            $insert_res = $h->query($sql);
        } catch(Exception $e){
            echo 1;
        }
    }

}

$h->query("UPDATE `proxy_tbody` SET `is_use` = 1");
