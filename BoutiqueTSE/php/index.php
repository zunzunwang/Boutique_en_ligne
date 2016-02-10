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
	include("../html/index.html");
	if($_COOKIE['cookie']=="admin"){
		$gestioin_admin="<a>admin</a>";	
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
}
?>