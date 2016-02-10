<?php
ob_start();
include("Link.php");
if($_COOKIE['cookie']==null||$_COOKIE['cookie']=="out"){
	include("../html/signIn.html");
if($_GET[out]){
	setcookie("cookie", "out");
	echo "<script language=\"javascript\">location.href='signIn.php';</script>";
}
if($_POST[username]!=null){
	$user_query=mysql_query("SELECT * FROM `UserList` WHERE `username`= '$_POST[username]'",$link);
	$array_result=mysql_fetch_array($user_query);
 	if($_POST[username]==$array_result['username']&&$_POST[password]==$array_result['password']){
 		if ($_POST[remember]=="on"){
 			setcookie("cookie",$_POST[username],time()+3600*24*7);
 			echo "<script language=\"javascript\">location.href='./signIn.php';</script>";
 		}else{
 			setcookie("cookie",$_POST[username]);
 			echo "<script language=\"javascript\">location.href='signIn.php';</script>";			
 		}
	}
}
?>
<SCRIPT language = javascript>
function CheckSignin()
{
	//定义一个form表单其中名字为signiform 其中的变量名称为user取他的值
	
	if (signinform.username.value==""){
		alert("please fill in your name");
		signinform.username.focus();
		return false;		
	}

	if (signinform.password.value==""){
		alert("password can't be empty");
		signinform.password.focus();
		return false;		
	}
		
}
</SCRIPT>
<?php
}else{
?>	
<?php
$url_index="../php/index.php";
echo "<SCRIPT LANGUAGE=\"JavaScript\">location.href='$url_index'</SCRIPT>";
}
?>