<?php
include("Link.php");
//获得来自 URL 的 username 参数
$username=$_GET['username'];
$username_query=mysql_query("SELECT `username` FROM `UserList` WHERE `username`='$username'",$link);
$array_nameresult=mysql_fetch_array($username_query);
if($array_nameresult==null){
	$response="";	 	
}else{
	$response="This name exist";
}
//输出响应	
echo $response;
?>