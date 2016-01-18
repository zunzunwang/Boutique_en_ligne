<?php
include("Link.php");
//获得来自 URL 的 username 参数
$id=$_GET['id'];
$username_query=mysql_query("DELETE FROM `UserList` WHERE `id`='$id'",$link);
?>