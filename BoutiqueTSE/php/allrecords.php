<?php
include("Link.php");
//获得来自 URL 的 username 参数
$id=$_GET['id'];
$request=mysql_query("SELECT * FROM `Order_list` WHERE `produit_id` = '$id' ",$link);
while($request_quantity = mysql_fetch_array($request)){
	echo "*order_id:  ".$request_quantity[id]."&nbsp&nbsp";
	echo "*User_name:  ".$request_quantity[user_name]."&nbsp&nbsp";
	echo "*produit name:  ".$request_quantity[produit_name]."&nbsp&nbsp";
	echo "*produit_color:  ".$request_quantity[produit_color]."&nbsp&nbsp";
	echo "*produit_size:  ".$request_quantity[produit_size]."&nbsp&nbsp";
	echo "*produit_quantity:  ".$request_quantity[produit_quantity]."&nbsp&nbsp";	
	echo "<br>";
}
?>
<html>
</html>