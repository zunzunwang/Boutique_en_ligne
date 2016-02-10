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
	include("../html/articleTse.html");
	/**
	 * gestion_admin
	 */
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
	 * 获取当前使用的数据库表格
	 * @param string $url
	 */
	function _PAGELIST($url = '') {
	
		global $list,$_SERVER,$produit_id;
	
		if($_GET[from_list]){//先要获得当前发送的list的值否则返回主页
			$list=$_GET[from_list];
		}
		if (!$list){//如果没有规定list则返回主页
			$url_index="../php/index.php";
			echo "<SCRIPT LANGUAGE=\"JavaScript\">location.href='$url_index'</SCRIPT>";
		}
		if($list=='tse')
			$list='Tse_produit_list';
		
		if($_GET[articleId]){//先要获得当前发送的Id的值否则返回主页
			$produit_id=$_GET[articleId];
		}
		if (!$produit_id){//如果没有规定page则限定到第一页
			$url_index="../php/index.php";
			echo "<SCRIPT LANGUAGE=\"JavaScript\">location.href='$url_index'</SCRIPT>";
		}
	}
	
	/***
	 *
	 * 翻页函数
	 * @param unknown $totle
	 * @param number $displaypg
	 * @param string $url
	 * @return boolean
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
		echo "<script language=\"javascript\">document.getElementById(\"pager_select\").innerHTML=\"$pageselect\";</script>";
	
	}
	
	
	/**
	 * 页面处理入口加载商品信息
	 */
	_PAGELIST();//get list
	$result_produit=mysql_query("SELECT * FROM `$list` WHERE `id`= $produit_id;");
	$row=mysql_fetch_array($result_produit);	
	echo "<script language=\"javascript\">document.getElementById(\"produit_name\").innerHTML=\"$row[name]\";</script>";
	echo "<script language=\"javascript\">document.getElementById(\"produit_price\").innerHTML=\"Price: $row[price]€\";</script>";
	echo "<script language=\"javascript\">document.getElementById(\"produit_type\").innerHTML=\"Type: $row[type]\";</script>";
	echo "<script language=\"javascript\">document.getElementById(\"upload_username\").innerHTML=\"Upload by: $row[upload_username]\";</script>";
	echo "<script language=\"javascript\">document.getElementById(\"upload_date\").innerHTML=\"Upload date: $row[upload_date]\";</script>";
	echo "<script language=\"javascript\">document.getElementById(\"produit_description\").innerHTML=\"Description:<br>$row[description]\";</script>";
	?>
	<script>
	$('#produit_image').attr('src',"<?php echo "..\/upload_img\/".$row[img]?>");	 
	</script>
	<?php	
	/**
	 * 处理每页显示的评论信息
	 */
	$result_comment=mysql_query("SELECT * FROM `Comment_list` WHERE `produit_id` = '$produit_id';");
	$total=mysql_num_rows($result_comment);
	
	_PAGEFT($total,10);
	$index=1;
	$result_comment=mysql_query("SELECT * FROM `Comment_list` WHERE `produit_id` = '$produit_id' limit $firstcount,$displaypg");
	
	if($result_comment){
		while($row=mysql_fetch_array($result_comment)){
			//在此填充每个单
			$div_name ="comment$index";
			?>
			<script>$('<?php echo "#".$div_name ?>').attr('class',"well well-lg")</script>
			<?php
			$comment_name=$div_name."_name";
			echo "<script language=\"javascript\">document.getElementById(\"$comment_name\").innerHTML=\"$row[comment_username]:\";</script>";
			$comment_description=$div_name."_description";
			echo "<script language=\"javascript\">document.getElementById(\"$comment_description\").innerHTML=\"$row[comment_description]\";</script>";
			$comment_date=$div_name."_date";
			echo "<script language=\"javascript\">document.getElementById(\"$comment_date\").innerHTML=\"$row[comment_date]&nbsp&nbsp&nbsp<button>reply</button>\";</script>";				
			?>
			<script>$('<?php echo "#".$comment_date." > button"?>').attr('onclick',"reply('<?php echo $row[comment_username];?>','<?php echo $row[comment_date];?>','<?php echo $row[comment_description];?>')");</script>
			<?php	
			$index += 1;
			}
			?>
			<script>$('<?php echo " p > button"?>').attr('class',"btn btn-default btn-xs");</script>
			<?php
		
	}

}

?>
