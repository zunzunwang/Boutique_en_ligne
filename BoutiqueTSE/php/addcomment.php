<?php
include("Link.php");



/**
 * 接受新的评论并加入到数据库。
 */
$username=$_COOKIE['cookie'];
if($_POST['produit_id'])
	$produit_id=$_POST['produit_id'];

if($_POST['comment']){
	$comment=htmtocode($_POST['comment']);
	$comment=mysql_real_escape_string($comment);
	$add_query="INSERT INTO `Comment_list` (`id`, `produit_id`, `comment_username`, `comment_date`, `comment_description`) VALUES (NULL, '$produit_id', '$username', CURRENT_TIMESTAMP, '$comment')";
	mysql_query($add_query);
}
?>