<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh" lang="zh">
<head>
<meta http-equiv="Content-Language" content="zh-CN" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="IE=7" http-equiv="X-UA-Compatible"/>
<title>网上购物网站大全投稿-www.net7788.com</title>

<LINK 
href="images/style10.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2900.5726" name=GENERATOR>


<SCRIPT language=javascript>
function CheckPost()
{
	if (myform.title.value=="")
	{
		alert("请填写标题");
		myform.title.focus();
		return false;
	}


email=myform.email.value;   
if(!/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/.test(email))   
{   
alert("mail格式不对，请重新输入");   
myform.email.focus();   
return false;   
}  
	if (myform.content.value=="")
	{
		alert("必须要填写内容");
		myform.content.focus();
		return false;
	}
}
</SCRIPT>


</HEAD>



<BODY leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">
<STYLE>#ChannelNavTop {
	CLEAR: both; FONT-SIZE: 12px; BACKGROUND: url(images/topbg06.gif) repeat-x 50% bottom; WIDTH: 750px; COLOR: #8c8e8c; HEIGHT: 25px
}
#ChannelNavTop P {
	BACKGROUND: url(images/topdot06.gif) no-repeat 0px 8px; FLOAT: right; MARGIN: 0px; WIDTH: 82px; LINE-HEIGHT: 25px; HEIGHT: 25px; TEXT-ALIGN: center
}
#ChannelNavTop P A {
	COLOR: #8c8e8c; TEXT-DECORATION: none
}
#ChannelNavTop P A:hover {
	COLOR: red
}
#ChannelEndTmp  {
	PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px; PADDING-TOP: 0px
}
#ChannelEndTmp {
	CLEAR: both; PADDING-RIGHT: 0px; BORDER-TOP: #d6d7d6 1px solid; PADDING-LEFT: 0px; FONT-SIZE: 12px; BACKGROUND: #fff; PADDING-BOTTOM: 6px; MARGIN: 0px auto 2px; VERTICAL-ALIGN: middle; WIDTH: 750px; LINE-HEIGHT: 12px; PADDING-TOP: 0px; BORDER-BOTTOM: #d6d7d6 1px solid; HEIGHT: 40px; TEXT-ALIGN: center
}
#ChannelEndTmp UL {
	CLEAR: both; MARGIN-LEFT: 8px; LIST-STYLE-TYPE: none
}
#ChannelEndTmp LI A {
	FONT-SIZE: 12px; COLOR: black; LINE-HEIGHT: 12px; TEXT-DECORATION: none
}
#ChannelEndTmp LI A:hover {
	COLOR: red; LINE-HEIGHT: 12px
}
#ChannelEndTmp LI A.reds:link {
	COLOR: red; LINE-HEIGHT: 12px
}
A.reds:visited {
	COLOR: red; LINE-HEIGHT: 12px
}
#ChannelEndTmp LI {
	BORDER-RIGHT: black 1px solid; FLOAT: left; MARGIN: 8px auto 2px; WIDTH: 38px; PADDING-TOP: 1px
}
#ChannelEndTmp LI.gtEnd {
	BORDER-RIGHT: 0px; BORDER-TOP: 0px; FONT-SIZE: 12px; FLOAT: left; BORDER-LEFT: 0px; WIDTH: 40px; BORDER-BOTTOM: 0px
}
</STYLE>
<?php 
/*
*作者：小蔡
*邮箱:caitianzhihot@gmail.com
*日期：2011-4-28
*功能：发送邮件
*网站：www.net7788.com
*/
session_start();


 include ('email.class.php');
 include ('conn.php');

if($_POST[submit]){

	if(strtolower($_SESSION[an])==strtolower($_POST[code])){
		//##########################################
$smtpserver = $smtpserverconn;//SMTP服务器
$smtpserverport =25;//SMTP服务器端口
$smtpusermail = $smtpuserconn;//SMTP服务器的用户邮箱
$smtpemailto = $smtpuserconn;//发送给谁
$smtpuser = $smtpuserconn;//SMTP服务器的用户帐号
$smtppass = $smtppassconn;//SMTP服务器的用户密码
$mailsubject = "$_POST[title]";//邮件主题
$mailbody = "来自".$_POST[email]."<br>".$_POST[content];//邮件内容
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
##########################################
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
$smtp->debug = FALSE;//是否显示发送的调试信息
$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
	 echo "<script>alert('已发送到站长邮箱！等待回复！');location.href='index.php';</script>";
	}else{



	echo "<script>alert('验证码不正确请重新输入！');location.href='index.php';</script>";
	}


}
?>
<!--[if !IE]>|xGv00|fb3ba6d7d054bb2398a478203c40cecd<![endif]-->
<TABLE cellSpacing=0 cellPadding=0 width=750 align=center border=0>
  <TBODY>
  <TR>
    <TD background=images/con28.gif><IMG height=1 
      src="images/con28.gif" width=3></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=750 align=center border=0>
  <TBODY>
  <TR>
    <TD width=137 background=images/new_mess_01.gif 
height=50></TD>
    <TD width=137 background=images/new_mess_02.gif></TD>
    <TD width=198 background=images/new_mess_03.gif></TD>
    <TD width=198 background=images/new_mess_04.gif></TD>
    <TD width=80 background=images/new_mess_05.gif></TD></TR>
  <TR>
    <TD background=images/new_mess_06.gif height=103></TD>
    <TD background=images/new_mess_07.gif></TD>
    <TD background=images/new_mess_26.gif colSpan=2 rowSpan=3><!-- 留言表单开始  -->
      <TABLE cellSpacing=7 cellPadding=0 width="100%" border=0>
       <form name="myform" method="post" action="" onsubmit="return CheckPost();">
        <TBODY>
       
        <TR>
          <TD align=right>标题：</TD>
          <TD><INPUT size=28 name=title>(必填) </TD></TR>
        
        <TR>
          <TD align=right>邮箱：</TD>
          <TD><INPUT size=28 name=email>(必填) </TD></TR>
        <TR>
          <TD vAlign=top align=right>内容：</TD>
          <TD><TEXTAREA style="FONT-SIZE: 14px" name=content rows=7 cols=28></TEXTAREA> 
          </TD></TR>
 <TR>
          <TD align=right>验证码：</TD>
          <TD><INPUT size=14 name=code><img src="img.php" height="25" border="0" alt=""> </TD></TR>

        <TR>
          <TD><INPUT type=hidden name=referrer>
           
             <INPUT id=channel type=hidden value=submit name=submit> </TD>
          <TD><INPUT type=image height=38 width=84 
		  
            src="images/new_mess_28.gif"> 


      </TD></TR></FORM></TBODY></TABLE><!-- 留言表单结束  --></TD>
    <TD background=images/new_mess_09.gif></TD></TR>
  <TR>
    <TD background=images/new_mess_10.gif height=103></TD>
    <TD background=images/new_mess_11.gif></TD>
    <TD background=images/new_mess_12.gif></TD></TR>
  <TR>
    <TD background=images/new_mess_13.gif height=103></TD>
    <TD background=images/new_mess_14.gif></TD>
    <TD background=images/new_mess_15.gif></TD></TR>
  <TR>
    <TD background=images/new_mess_16.gif height=86></TD>
    <TD background=images/new_mess_17.gif></TD>
    <TD background=images/new_mess_18.gif></TD>
    <TD background=images/new_mess_19.gif></TD>
    <TD background=images/new_mess_20.gif></TD></TR>
  <TR>
    <TD background=images/new_mess_21.gif height=86></TD>
    <TD background=images/new_mess_22.gif></TD>
    <TD background=images/new_mess_23.gif></TD>
    <TD background=images/new_mess_24.gif></TD>
    <TD background=images/new_mess_25.gif></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=750 align=center border=0>
  <TBODY>
  <TR>
    <TD height=6></TD></TR>
  <TR>
    <TD bgColor=#afafaf height=1></TD></TR>
  <TR>
    <TD align=middle height=12></TD></TR>

  <TR>
    <TD align=middle><FONT style="FONT-SIZE: 12px; COLOR: #3b3b3b">Copyright &copy; 
      2011<A class=footer 
      href="http://www.net7788.com" 
      target=_blank>网上购物大全</A>&nbsp;&nbsp;&nbsp;&nbsp;<A class=footer 
      href="http://www.114qyw.com" 
      target=_blank>114企业网</A>&nbsp;&nbsp;&nbsp;&nbsp;<A class=footer 
      href="http://3g7788.com" 
      target=_blank>免费Q币网</A>&nbsp;&nbsp;&nbsp;&nbsp;<A class=footer 
      href="http://bbs.net7788.com/" 
      target=_blank>网上购物论坛</A></FONT></TD></TR>
  <TR>
    <TD height=12></TD></TR></TBODY></TABLE>

<NOSCRIPT><IMG alt="" src="images/m.gif"> </NOSCRIPT><!-- END NNR Site Census V5.1 --><!--[if !IE]>|xGv00|d0a354a073bff3fb10894f08cbd33bda<![endif]-->
<div style="display:none">
<script>var lainframe;</script>
<script language="javascript" type="text/javascript" src="http://js.users.51.la/4715937.js"></script>
</div>

</BODY></HTML>
