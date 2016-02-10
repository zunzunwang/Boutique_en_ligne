<?php
setcookie("cookie", "out");
//ini_set('display_errors','off');
ob_start();
include("Link.php");
if($_COOKIE['cookie']==null||$_COOKIE['cookie']=="out"){
	include("../html/signUp.html");
if($_GET[out]){
	setcookie("cookie", "out");
	echo "<script language=\"javascript\">location.href='signUp.php';</script>";
}
 if(($_POST[username]!=null)&&($_POST[password]==$_POST[confirmPassword])&&($_POST[email]!=null)&&($_POST[answer]!=null)){
 	$user_query=mysql_query("INSERT INTO `UserList` (`id`, `username`, `password`, `grade`, `email`, `question`, `answer`, `admin`) VALUES (NULL, '$_POST[username]', '$_POST[password]', '$_POST[grade]', '$_POST[email]', '$_POST[question]', '$_POST[answer]','0')",$link);

 	echo "<script language=\"javascript\">alert(\"success\");</script>"; 	
 	echo "<script language=\"javascript\">location.href='../php/signIn.php';</script>";			 		
 	}
 	else{
 	}
?>
<SCRIPT language = javascript>
function CheckSignup()
{
	//定义一个form表单其中名字为signiform 其中的变量名称为user取他的值
	
	if (signupform.username.value==""){
		alert("please fill in your name");
		signupform.username.focus();
		return false;		
	}
	if (signupform.password.value==""){
		alert("password can't be empty");
		signupform.password.focus();
		return false;		
	}
	if (signupform.confirmPassword.value==""){
		alert("confirmPassword can't be empty");
		signupform.confirmPassword.focus();
		return false;		
	}
	if (signupform.email.value==""){
		alert("email can't be empty");
		signupform.email.focus();
		return false;		
	}
	if (signupform.answer.value==""){
		alert("answer can't be empty");
		signupform.answer.focus();
		return false;		
	}
			
}
</SCRIPT>
<?php
}
?>