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
	include("../html/myAccount.html");
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
	
	/***
	 *
	 * 翻页函数
	 * @param unknown $totle
	 * @param number $displaypg
	 * @param string $url
	 * @return boolean
	 */
	function _PAGEFT($totle, $displaypg = 9, $url = '') {
	
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
	
	
	/**
	 * 函数的入口
	 */
	$result=mysql_query("SELECT * FROM `Order_list` WHERE `user_name` = '$username'");
	$total=mysql_num_rows($result);
	//调用pageft()，每页显示12条信息（使用默认的20时，可以省略此参数），使用本页URL（默认，所以省略掉）。
	_PAGEFT($total,9);
	
	$index=1;
	$result=mysql_query("SELECT * FROM `Order_list` WHERE `user_name` = '$username' ORDER BY `order_date` DESC limit $firstcount,$displaypg");
	
	while($row=mysql_fetch_array($result)){
		//在此填充每个单
		$div_name ="produit$index";
		$produit_bound=$div_name."_bound";
		?>
		<script>
		$('<?php echo "#".$produit_bound; ?>').attr('class',"thumbnail");		 
		</script>
		<?php
		$produit_name=$div_name."_name";
		echo "<script language=\"javascript\">document.getElementById(\"$produit_name\").innerHTML=\"$row[produit_name]\";</script>";
		?>
		<SCRIPT language = javascript>
		function dir_article(){
			$('<?php echo "#".$produit_name; ?>').attr('href',"<?php echo "../php/article.php?from_list=bde&articleId=".$row[produit_id]?>");
			}		
		</SCRIPT>
		<?php		 
		echo "<script language=\"javascript\">dir_article();</script>";
		$produit_price=$div_name."_price";
		echo "<script language=\"javascript\">document.getElementById(\"$produit_price\").innerHTML=\"$row[produit_price]€\";</script>";
		$produit_quantity=$div_name."_quantity";
		echo "<script language=\"javascript\">document.getElementById(\"$produit_quantity\").innerHTML=\"Quantity:$row[produit_quantity]\";</script>";
		$produit_description=$div_name."_description";
		$description="There isn't any description.";
		$length=strlen($row[produit_description]);
		if($row[produit_description]){
			//$description=$row[description];		 		
			echo "<script language=\"javascript\">document.getElementById(\"$produit_description\").innerHTML=\"$row[produit_description]\";</script>";
		}
		else{
			echo "<script language=\"javascript\">document.getElementById(\"$produit_description\").innerHTML=\"$description\";</script>";
		}
		$produit_order_date=$div_name."_order_date";
		echo "<script language=\"javascript\">document.getElementById(\"$produit_order_date\").innerHTML=\"Date:$row[order_date]\";</script>";
		$produit_order_id=$div_name."_order_id";
		echo "<script language=\"javascript\">document.getElementById(\"$produit_order_id\").innerHTML=\"your order id:$row[id]\";</script>";
		$produit_image=$div_name."_image";
		?>
		<script>
		$('<?php echo "#".$produit_image; ?>').attr('src',"<?php echo "..\/upload_img\/".$row[produit_img]?>");
		$('<?php echo "#".$produit_image; ?>').attr('width',"350px");
		$('<?php echo "#".$produit_image; ?>').attr('height',"150px");		 
		</script>
		<?php
		$produit_delete=$div_name."_delete";
		echo "<script language=\"javascript\">document.getElementById(\"$produit_delete\").innerHTML=\"<button>Delete</button>\";</script>";
		?>
		<script>$('<?php echo "#".$produit_delete." > button"?>').attr('onclick',"produit_delete(<?php echo $row[id] ?>)");</script>
		<?php

		$index += 1;
	}

	$result_user=mysql_query("SELECT * FROM `UserList` WHERE `username` = '$username'");
	while($row_user=mysql_fetch_array($result_user)){
		echo "<script language=\"javascript\">document.getElementById(\"user_name\").innerHTML=\"User name: $row_user[username]\";</script>";
		echo "<script language=\"javascript\">document.getElementById(\"user_grade\").innerHTML=\"User grade: $row_user[grade]\";</script>";
		echo "<script language=\"javascript\">document.getElementById(\"user_email\").innerHTML=\"User email: $row_user[email]\";</script>";		
	}

}

?>
	<SCRIPT language=javascript>
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
