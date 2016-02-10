<?php
ob_start();
if($_COOKIE['cookie']==null||$_COOKIE['cookie']=="out"){
	$url_signIn="../php/signIn.php";
	echo "<SCRIPT LANGUAGE=\"JavaScript\">location.href='$url_signIn'</SCRIPT>";
}else{//之前要先验证是不是有保存正确的cookie 否则就要退出
	if($_GET[out]){
		setcookie("cookie", "out");
		echo "<script language=\"javascript\">location.href='signIn.php';</script>";
	}
	
	header("content-type:text/html;charset=utf-8");
	include("Link.php");
	include("../html/admin.html");
	if($_COOKIE['cookie']=="admin"){
		$gestioin_admin="<a>ADMIN</a>";
		echo "<script language=\"javascript\">document.getElementById(\"gestion_admin\").innerHTML=\"$gestioin_admin\";</script>";
		?>
		<SCRIPT language = javascript>
	    function gestion_admin(){
		$('#gestion_admin > a').attr('class',"page-scroll");
		$('#gestion_admin > a').attr('href',"../php/admin.php");
		}		
		</SCRIPT>
		<?php
						echo "<script language=\"javascript\">gestion_admin();</script>";
					}
	$username=$_COOKIE['cookie'];
	$label_username="Welcome: ".$username;
	echo "<script language=\"javascript\">document.getElementById(\"label_username\").innerHTML=\"$label_username\";</script>";
	
		

	/**
	 * 用户分页功能
	 */
	function _PAGEFT($totle, $displaypg = 10, $url = '') {
	
		global $page, $firstcount, $pagenav, $_SERVER;
	
		$GLOBALS["displaypg"] = $displaypg;//获得每页显示的数量
	
		if($_GET[page]){//先要获得当前发送的page的值否则一直都为第一页
			$page=$_GET[page];
		}
		if (!$page)//如果没有规定page则限定到第一页
			$page = 1;
	
		if (!$url) {
			$url = $_SERVER["REQUEST_URI"];//初始化到默认的地址
		}
	
		//URL分析：
		$parse_url = parse_url($url);//使用parse_url进行数据的分析
		$url_query = $parse_url["query"]; //单独取出URL的查询字串
		if ($url_query) {
			$url_query = ereg_replace("(^|&)page=$page", "", $url_query);
			$url = str_replace($parse_url["query"], $url_query, $url);
			if ($url_query){
				$url .= "&page";
			}
			else{
				$url .= "page";
			}
		} else {
			$url .= "?page";//给url加上page的标签 实际是给后来用get来获取的
		}
		$lastpg = ceil($totle / $displaypg); //最后页，也是总页数
		$page = min($lastpg, $page);//页数要取到是当前也和总页数中最小的一个
		$prepg = $page -1; //上一页
		$nextpg = ($page == $lastpg ? 0 : $page +1); //下一页
		$firstcount = ($page -1) * $displaypg;//分页公式
	
		//开始分页导航条代码：
		$pagenav = "Page $page, Display <B>" . ($totle ? ($firstcount +1) : 0) . "</B>-<B>" . min($firstcount + $displaypg, $totle) . "</B> records, Total $totle records. ";
		echo "<script language=\"javascript\">document.getElementById(\"pager_records\").innerHTML=\"$pagenav\";</script>";
	
		//如果只有一页则跳出函数：
		if ($lastpg <= 1)
			return false;
	
		$pageselect .= " <a href='$url=1'>Home</a> ";
		if ($prepg)
			$pageselect .= " <a href='$url=$prepg'>Previous</a> ";
		else
			$pageselect .= " Previous ";
		if ($nextpg)
			$pageselect .= " <a href='$url=$nextpg'>Next</a> ";
		else
			$pageselect .= " Next ";
		$pageselect .= " <a href='$url=$lastpg'>Last page</a> ";
		echo "<script language=\"javascript\">document.getElementById(\"page\").innerHTML=\"$pageselect\";</script>";
	
	}
	
	/**
	 * 订购纪录分页功能
	 */
	function _PAGEQU($totle, $displaypgrecord = 10, $url = '') {
	
		global $pagerecord, $firstcountrecord, $pagenavrecord;
	
		$GLOBALS["displaypgrecord"] = $displaypgrecord;//获得每页显示的数量
	
		if($_GET[pagerecord]){//先要获得当前发送的page的值否则一直都为第一页
			$pagerecord=$_GET[pagerecord];
		}
		if (!$pagerecord)//如果没有规定page则限定到第一页
			$pagerecord = 1;
	
		if (!$url) {
			$url = $_SERVER["REQUEST_URI"];//初始化到默认的地址
		}
	
		//URL分析：
		$parse_url = parse_url($url);//使用parse_url进行数据的分析
		$url_query = $parse_url["query"]; //单独取出URL的查询字串
		if ($url_query) {
			$url_query = ereg_replace("(^|&)pagerecord=$pagerecord", "", $url_query);
			$url = str_replace($parse_url["query"], $url_query, $url);
			if ($url_query){
				$url .= "&pagerecord";
			}
			else{
				$url .= "pagerecord";
			}
		} else {
			$url .= "?pagerecord";//给url加上page的标签 实际是给后来用get来获取的
		}
		$lastpgrecord = ceil($totle / $displaypgrecord); //最后页，也是总页数
		$pagerecord = min($lastpgrecord, $pagerecord);//页数要取到是当前也和总页数中最小的一个
		$prepgrecord = $pagerecord -1; //上一页
		$nextpgrecord = ($pagerecord == $lastpgrecord ? 0 : $pagerecord +1); //下一页
		$firstcountrecord = ($pagerecord -1) * $displaypgrecord;//分页公式
	
		//开始分页导航条代码：
		$pagenavrecord = "Page $pagerecord, Display <B>" . ($totle ? ($firstcountrecord +1) : 0) . "</B>-<B>" . min($firstcountrecord + $displaypgrecord, $totle) . "</B> records, Total $totle records. ";
		echo "<script language=\"javascript\">document.getElementById(\"pager_records_quantity\").innerHTML=\"$pagenavrecord\";</script>";
	
		//如果只有一页则跳出函数：
		if ($lastpgrecord <= 1)
			return false;
	
		$pageselectrecord .= " <a href='$url=1'>Home</a> ";
		if ($prepgrecord)
			$pageselectrecord .= " <a href='$url=$prepgrecord'>Previous</a> ";
		else
			$pageselectrecord .= " Previous ";
		if ($nextpgrecord)
			$pageselectrecord .= " <a href='$url=$nextpgrecord'>Next</a> ";
		else
			$pageselectrecord .= " Next ";
		$pageselectrecord .= " <a href='$url=$lastpgrecord'>Last page</a> ";
		echo "<script language=\"javascript\">document.getElementById(\"page_quantity\").innerHTML=\"$pageselectrecord\";</script>";
	
	}

	
/**	
 * 函数入口
 */
	$result=mysql_query("SELECT * FROM `UserList`");
	$total = mysql_num_rows($result);
	_PAGEFT($total, 10);
	$result = mysql_query("SELECT * FROM `UserList` limit $firstcount, $displaypg ");
	$index=1;
	while($row = mysql_fetch_array($result))
	{
		$user_name = "user$index";
		$user_div = $user_name."div";
		$user_email = "email$index";
		$user_delete ="delete$index";
		echo "<script language=\"javascript\">document.getElementById(\"$user_name\").innerHTML=\"$row[username]\";</script>";
		echo "<script language=\"javascript\">document.getElementById(\"$user_email\").innerHTML=\"$row[email]\";</script>";
		echo "<script language=\"javascript\">document.getElementById(\"$user_delete\").innerHTML=\"<span></span>\";</script>";
		
		?>
		<script>
		$('<?php echo "#".$user_div?>').attr('class',"row well well-sm");
		$('<?php echo "#".$user_delete." > span"?>').attr('onclick',"user_delete(<?php echo $row[id] ?>)");
		$('<?php echo "#".$user_delete." > span"?>').attr('class',"glyphicon glyphicon-remove pull-right");		
		</script>
		<?php
		$index+=1;
	}
		
	/**
	 * quantity函数入口
	 */
	$result_quantity=mysql_query("SELECT * FROM `Bde_produit_list`");
	$total_quantity = mysql_num_rows($result_quantity);
	_PAGEQU($total_quantity, 10);
	
	$result_quantity = mysql_query("SELECT * FROM `Bde_produit_list` limit $firstcountrecord, $displaypgrecord");
	echo mysql_error();
	$index_quantity=1;
	while($row_quantity = mysql_fetch_array($result_quantity))
	{
		$quantity=0;
		$produit_div = "produit$index_quantity";
		$produit_bound = $produit_div."_bound";
		$produit_name = $produit_div."_name";
		$produit_quantity = $produit_div."_quantity";
		$produit_all_records = $produit_div."_all_records";		
		echo "<script language=\"javascript\">document.getElementById(\"$produit_name\").innerHTML=\"$row_quantity[name]\";</script>";
		$request=mysql_query("SELECT * FROM `Order_list` WHERE `produit_name` = \"$row_quantity[name]\" ");
		while($request_quantity = mysql_fetch_array($request)){
			$quantity = $request_quantity[produit_quantity]+$quantity;
		}
		echo "<script language=\"javascript\">document.getElementById(\"$produit_quantity\").innerHTML=\"Quantity: $quantity\";</script>";
		$amount = $quantity*$row_quantity[price];
		$produit_amount=$produit_div."_amount";
		echo "<script language=\"javascript\">document.getElementById(\"$produit_amount\").innerHTML=\"Amount (€): $amount \";</script>";
		echo "<script language=\"javascript\">document.getElementById(\"$produit_all_records\").innerHTML=\"all records\";</script>";
		
		
		?>
		<script>
		$('<?php echo "#".$produit_bound?>').attr('class',"row well well-sm");
//		$('<?php echo "#".$produit_all_records." > span"?>').attr('onclick',"allrecords(<?php echo $row_quantity[id] ?>)");
		$('<?php echo "#".$produit_all_records?>').attr('href',"../php/allrecords?id=<?php echo $row_quantity[id] ?>");
		$('<?php echo "#".$produit_all_records." > span"?>').attr('class',"pull-right");
	
		
		</script>
		<?php
		$index_quantity+=1;
	}	
}
?>
	
<SCRIPT language = javascript>
function CheckUpload(){
 	if (Uploadform.name.value=="")
 	{
 		alert("please write your product name.");
 		Uploadform.name.focus();
 		return false;
 	}
 	if (Uploadform.name.value.length>15)
 	{
 		alert("the title can't more than 15 words.");
 		Uploadform.name.focus();
 		return false;
 	}
 	if (Uploadform.price.value=="")
 	{
 		alert("please wriite your price");
 		Uploadform.price.focus();
 		return false;
 	}
 	
 	if (isNaN(Uploadform.price.value))
 	{
 		alert("please write correct price");
 		Uploadform.price.focus();
 		return false;
 	}

 	if (Uploadform.description.value=="")
 	{
 		alert("the content can't be empty");
 		Uploadform.description.focus();
 		return false;
 	}
 	if (Uploadform.file.value=="")
 	{
 		alert("the image file can't be empty");
 		Uploadform.file.focus();
 		return false;
 	}


}
</SCRIPT>