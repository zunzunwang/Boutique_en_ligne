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
	include("../html/article.html");
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
		if($list=='bde')
			$list='Bde_produit_list';
		
		if($_GET[articleId]){//先要获得当前发送的Id的值否则返回主页
			$produit_id=$_GET[articleId];
		}
		if (!$produit_id){//如果没有规定page则限定到第一页
			$url_index="../php/index.php";
			echo "<SCRIPT LANGUAGE=\"JavaScript\">location.href='$url_index'</SCRIPT>";
		}
	}
	
	/**
	 * 页面处理入口
	 */
	_PAGELIST();//get list
	$result=mysql_query("SELECT * FROM `$list` WHERE `id`= $produit_id;");
	$row=mysql_fetch_array($result);	
	echo "<script language=\"javascript\">document.getElementById(\"produit_name\").innerHTML=\"$row[name]\";</script>";
	echo "<script language=\"javascript\">document.getElementById(\"produit_price\").innerHTML=\"Price: $row[price]€\";</script>";
	echo "<script language=\"javascript\">document.getElementById(\"produit_description\").innerHTML=\"Description: $row[description]\";</script>";
	?>
	<script>
	$('#produit_image').attr('src',"<?php echo "..\/upload_img\/".$row[img]?>");	 
	</script>
	<?php		
	if($_POST[size1])
		$produit_size=$_POST[size1];
	if($_POST[size2])
		$produit_size=$_POST[size2];
	if($_POST[size3])
		$produit_size=$_POST[size3];
	if($_POST[size4])
		$produit_size=$_POST[size4];
	if($_POST[size5])
		$produit_size=$_POST[size5];
	
	if($_POST[color_Black])
		$produit_color=$_POST[color_Black];
	if($_POST[color_White])
		$produit_color=$_POST[color_White];
	if($_POST[color_Blue])
		$produit_color=$_POST[color_Blue];
	
	
	if($_POST[produit_quantity]||$_POST[value_own_quality]){
		$username=$_COOKIE['cookie'];
		if($_POST[produit_quantity]=="other"){
			$description_escape=mysql_real_escape_string($row[description]);
			$result=mysql_query("INSERT INTO `Order_list` (`id`, `produit_id`, `produit_name`, `produit_img`, `produit_description`, `produit_price`, `produit_type`, `produit_size`, `produit_color`, `produit_quantity`, `user_name`, `order_date`, `pay`) VALUES (NULL, '$row[id]', '$row[name]','$row[img]','$description_escape','$row[price]', '$row[type]', '$produit_size', '$produit_color', '$_POST[value_own_quality]', '$username', CURRENT_TIMESTAMP, '0')");
		}
		else {
			$description_escape=mysql_real_escape_string($row[description]);				
			$result=mysql_query("INSERT INTO `Order_list` (`id`, `produit_id`, `produit_name`, `produit_img`, `produit_description`, `produit_price`, `produit_type`, `produit_size`, `produit_color`, `produit_quantity`, `user_name`, `order_date`, `pay`) VALUES (NULL, '$row[id]', '$row[name]','$row[img]','$description_escape','$row[price]', '$row[type]', '$produit_size', '$produit_color', '$_POST[produit_quantity]', '$username', CURRENT_TIMESTAMP, '0')");
		}

		echo "<script language=\"javascript\">alert(\"Thanks for your order.\");</script>";		
		$url_myAccount="../php/myAccount.php";
		echo "<SCRIPT LANGUAGE=\"JavaScript\">location.href='$url_myAccount'</SCRIPT>";
		
	
	}
	
	
	
	


?>
<SCRIPT language = javascript>
function  Checkarticle(){
	//定义一个form表单其中名字为signiform 其中的变量名称为id取他的值 id优先级大于name
	if(articleform.produit_quantity.value=="other"){	
	if (articleform.value_own_quality.value==""){
		alert("please fill in your quantity");
		articleform.value_own_quality.focus();
		return false;		
		}
	}		
}
</SCRIPT>
<?php
}

?>