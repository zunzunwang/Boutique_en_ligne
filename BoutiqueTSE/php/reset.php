<?php
setcookie("cookie", "out");
header("content-type:text/html;charset=utf-8");
ini_set("magic_quotes_runtime",0);
require 'class.phpmailer.php';
ob_start();
include("Link.php");
if($_COOKIE['cookie']==null||$_COOKIE['cookie']=="out"){
	include("../html/reset.html");	
if($_POST[username]!=null&&$_POST[answer]!=null ){
	$user_query=mysql_query("SELECT * FROM `UserList` WHERE `username`= '$_POST[username]'",$link);
	$array_result=mysql_fetch_array($user_query);
 	if(($_POST[username]==$array_result['username'])&&($_POST[answer]==$array_result['answer'])&&($_POST[question]==$array_result['question'])){
 		try {
 			$mail = new PHPMailer(true);
 			$mail->IsSMTP();
 			$mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
 			$mail->SMTPAuth   = true;                  //开启认证
 			$mail->Port       = 25;
 			$mail->Host       = "smtp.sina.com";
 			$mail->Username   = "boutique_tse@sina.com";  //发送邮箱
 			$mail->Password   = "boutique_tse";  //发送邮箱密码
 			//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could  not execute: /var/qmail/bin/sendmail ”的错误提示
// 			$mail->AddReplyTo($_POST[email],"reply for your messages to BoutiqueTSE");//回复地址
 			$mail->From       = "boutique_tse@sina.com";
 			$mail->FromName   = "BoutiqueTSE";
 			$to = $array_result['email'];//收件箱
 			$mail->AddAddress($to);
 			$mail->Subject  = "no_reply:find your password";//更改为主题
 			$mail->Body = "messages：hello {$_POST[username]}, your password is:{$array_result['password']}.";//更改的为这个部分
 			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
 			$mail->WordWrap   = 80; // 设置每行字符串的长度
 			//$mail->AddAttachment("f:/test.png");  //可以添加附件
 			$mail->IsHTML(true);
 			$mail->Send();
 			echo "<script>alert('your password has been sent to your email');location.href='../php/signIn.php';</script>";
 		} catch (phpmailerException $e) {
 			echo "fail to send your messages, the reason is:".$e->errorMessage();
 			echo "<script language=\"javascript\">location.href='./reset.php';</script>";
 		} 			
	}else{
		echo "<script language=\"javascript\">alert(\"your answer is not correct\");</script>";
		echo "<script language=\"javascript\">location.href='./reset.php';</script>";
		
	}
}
?>
<SCRIPT language = javascript>
function CheckReset()
{
	//定义一个form表单其中名字为signiform 其中的变量名称为user取他的值
	
	if (resetform.username.value==""){
		alert("please fill in your name");
		resetform.username.focus();
		return false;		
	}

	if (resetform.answer.value==""){
		alert("password can't be empty");
		resetform.answer.focus();
		return false;		
	}
		
}
</SCRIPT>
<?php
}
?>