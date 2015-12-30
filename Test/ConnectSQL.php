<?php

/*
<?php
$link = mysql_connect('localhost', 'mysql_user', 'mysql_password');
if (!$link) {
die('Impossible de se connecter : ' . mysql_error());
}
mysql_select_db('mydb');

mysql_query("INSERT INTO mytable (product) values ('kossu')");
printf("Le dernier ID inséré dans est le id %d\n", mysql_insert_id());
?>
 */



//mysql_connect用于开启Mysql链接 @是屏蔽错误 返回的值是一个布尔值。
//使用or die 语句来验证数据库是否链接正确。

//$link = @mysql_connect("localhost","root","12345") or die ("we have connection problem ");
$link = @mysql_connect("localhost","root","12345");
if (!$link) {
	die('Impossible de se connecter : ' . mysql_error());
}

//打开一个数据库 后跟链接标示符
mysql_select_db("test",$link);

//去执行一个sql语句
/*
 * mysql_query	
 */


$sql ="INSERT INTO `BoutiqueTSE` (`id`, `uid`, `mdp`) VALUES (NULL, 'user1', 'user1')";
//$result=mysql_query($sql,$conn);
//echo $result;


//select 语句查询出来之后返回值两种查询函数 array和row函数

//第一步先写出命令
//$sql="SELECT * FROM `BoutiqueTSE`";
//第二部将命令输入到mysql之中
$query=mysql_query($sql,$link);
//第三部是将输出结果输出
$row=mysql_fetch_row($query);

//Array ( [0] => 13005018 [1] => wang.zunzun [2] => 19920911 )
//print_r($row);

//Array ( [0] => 13005019 [id] => 13005019 [1] => lyu.yi-shuo [uid] => lyu.yi-shuo [2] => 12345 [mdp] => 12345 )
/*
$array=mysql_fetch_array($query);
print_r($array);
*/
//这个函数自身具有偏移变量 可以作为索引使用 并且 返回值是一个布尔值当没有行时返回false
//解决中文乱码问题 mysql_query("set names 'GBK'");
//while($array=mysql_fetch_array($query)){
//	echo $array['id']."<br><hr>";	
//}

// system function count
//echo mysql_num_rows($query);


//return id 返回刚才一条插入后的主键号。因为是自动增加所以有可能会不知道。
echo mysql_insert_id($link);












?>