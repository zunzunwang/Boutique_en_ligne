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
	$username=$_COOKIE['cookie'];
	$label_username="Welcome: ".$username;
	echo "<script language=\"javascript\">document.getElementById(\"label_username\").innerHTML=\"$label_username\";</script>";
	
		

}
?>

<SCRIPT language = javascript>
function CheckUpload()
{
	//定义一个form表单其中名字为signiform 其中的变量名称为id取他的值 id优先级大于name
	
	if (Uploadform.name.value==""){
		alert("please fill in your name");
		Uploadform.name.focus();
		return false;		
	}

	if (Uploadform.price.value==""){
		alert("price can't be empty");
		Uploadform.price.focus();
		return false;		
	}
	if (Uploadform.description.value==""){
		alert("description can't be empty");
		Uploadform.description.focus();
		return false;		
	}
		
}
</SCRIPT>