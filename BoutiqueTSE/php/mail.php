<?php
/**
* by www.phpddt.com
*/
header("content-type:text/html;charset=utf-8");
ini_set("magic_quotes_runtime",0);
require 'class.phpmailer.php';
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
	$mail->AddReplyTo($_POST[email],"reply for your messages to BoutiqueTSE");//回复地址
	$mail->From       = "boutique_tse@sina.com";
	$mail->FromName   = $_POST[name];
	$to = "contact.boutiquetse@gmail.com";//收件箱
	$mail->AddAddress($to);
	$mail->Subject  = $_POST[subject];//更改为主题
	$mail->Body = "messages：".$_POST[message];//更改的为这个部分
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
	$mail->WordWrap   = 80; // 设置每行字符串的长度
	//$mail->AddAttachment("f:/test.png");  //可以添加附件
	$mail->IsHTML(true); 
	$mail->Send();
	echo "<script>alert('Thanks for your messages, we will respond you soon！');location.href='../html/index.html';</script>";
} catch (phpmailerException $e) {
	echo "fail to send your messages, the reason is:".$e->errorMessage();
}
?>