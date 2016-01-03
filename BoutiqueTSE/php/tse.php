<?php
ob_start();
if($_COOKIE['cookie']==null||$_COOKIE['cookie']=="out"){
	$url_signIn="../html/signIn.html";
	echo "<SCRIPT LANGUAGE=\"JavaScript\">location.href='$url_signIn'</SCRIPT>";
}else{//之前要先验证是不是有保存正确的cookie 否则就要退出
	if($_GET[out]){
		setcookie("cookie", "out");
		echo "<script language=\"javascript\">location.href='signIn.php';</script>";
	}
	
	header("content-type:text/html;charset=utf-8");
	include("Link.php");
	include("../html/tse.html");
	/***
	 * 类型函数
	 */
	function _PAGETP($url = '') {
	
		global $type,$_SERVER;
		
		if($_GET[type]){//先要获得当前发送的page的值否则一直都为第一页
			$type=$_GET[type];
		}
		if (!$type)//如果没有规定page则限定到第一页
			$type = "All";
// 		if (!$url) {
// 			$url = $_SERVER["REQUEST_URI"];//初始化到默认的地址
// 		}
	
// 		//URL分析：
// 		$parse_url = parse_url($url);//使用parse_url进行数据的分析
// 		$url_query = $parse_url["query"]; //单独取出URL的查询字串
// 		if ($url_query) {
// 			$url_query = ereg_replace("(^|&)type=$type", "", $url_query);
	
// 			$url = str_replace($parse_url["query"], $url_query, $url);
// 			if ($url_query){
// 				$url .= "&type";
// 			}
// 			else{
// 				$url .= "type";
// 			}
// 		} else {
// 			$url .= "?type";//给url加上type的标签 实际是给后来用get来获取的
// 		}
// 		$type_All = " <a href='$url=All'><h4>ALL</h4></a> ";
// 		echo "<script language=\"javascript\">document.getElementById(\"type_All\").innerHTML=\"$type_All\";</script>";
// 		$type_Clothes = " <a href='$url=Clothes'><h4>Clothes</h4></a> ";
// 		echo "<script language=\"javascript\">document.getElementById(\"type_Clothes\").innerHTML=\"$type_Clothes\";</script>";
// 		$type_Appliances = " <a href='$url=Appliances'><h4>Appliances</h4></a> ";
// 		echo "<script language=\"javascript\">document.getElementById(\"type_Appliances\").innerHTML=\"$type_Appliances\";</script>";
// 		$type_Furnitures = " <a href='$url=Furnitures'><h4>Furnitures</h4></a> ";
// 		echo "<script language=\"javascript\">document.getElementById(\"type_Furnitures\").innerHTML=\"$type_Furnitures\";</script>";
// 		$type_Residences = " <a href='$url=Residences'><h4>Residences</h4></a> ";
// 		echo "<script language=\"javascript\">document.getElementById(\"type_Residences\").innerHTML=\"$type_Residences\";</script>";
	
	}
	
	/***
	 * 
	 * 翻页函数
	 * @param unknown $totle
	 * @param number $displaypg
	 * @param string $url
	 * @return boolean
	 */	
	function _PAGEFT($totle, $displaypg = 20, $url = '') {
	
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
		echo "<script language=\"javascript\">document.getElementById(\"pager_select\").innerHTML=\"$pageselect\";</script>";
		
	}
	/***
	 * 正常的页面的进入入口。
	 */
	_PAGETP();
	//获得需要搜索的项

	if($type!="All"){
		$result=mysql_query("SELECT * FROM `Tse_produit_list` WHERE `type` = \"$type\"; ");
	}
	else{
		$result=mysql_query("SELECT * FROM `Tse_produit_list`");
	}
	$total=mysql_num_rows($result);
	
	//调用pageft()，每页显示12条信息（使用默认的20时，可以省略此参数），使用本页URL（默认，所以省略掉）。
	_PAGEFT($total,9);
	
//	echo $pagenav;
//	echo "<script language=\"javascript\">document.getElementById(\"pager_records\").innerHTML=\"$pagenav\";</script>";
	//  用于显示填充的部分	
//	$result=mysql_query("SELECT * FROM `Tse_produit_list` limit $firstcount,$displaypg ");
	$index=1;
	if($type!="All"){
		$result=mysql_query("SELECT * FROM `Tse_produit_list` WHERE `type` = \"$type\" limit $firstcount,$displaypg;");
	}
	else{
		$result=mysql_query("SELECT * FROM `Tse_produit_list` limit $firstcount,$displaypg");
	}
	while($row=mysql_fetch_array($result)){
		//在此填充每个单元
		 $div_name ="produit$index";
		 $produit_name=$div_name."_name";
		 echo "<script language=\"javascript\">document.getElementById(\"$produit_name\").innerHTML=\"$row[name]\";</script>";
		 $produit_price=$div_name."_price";
		 echo "<script language=\"javascript\">document.getElementById(\"$produit_price\").innerHTML=\"$row[price]€\";</script>";
		 $produit_description=$div_name."_description";
		 $description="There isn't any description.";
		 $length=strlen($row[description]);
		 if($row[description]){
		 		//$description=$row[description];		 		
		 	echo "<script language=\"javascript\">document.getElementById(\"$produit_description\").innerHTML=\"$row[description]\";</script>";
		 }
		 else{
		 	echo "<script language=\"javascript\">document.getElementById(\"$produit_description\").innerHTML=\"$description\";</script>";
		 }
		 $produit_upload_username=$div_name."_upload_username";
		 echo "<script language=\"javascript\">document.getElementById(\"$produit_upload_username\").innerHTML=\"Up_user:$row[upload_username]\";</script>";
		 $produit_upload_date=$div_name."_upload_date";
		 echo "<script language=\"javascript\">document.getElementById(\"$produit_upload_date\").innerHTML=\"Date:$row[upload_date]\";</script>";
		 $index += 1;
	}
	
}
?>