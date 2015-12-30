<?php
$b=90;
//$a = date("Y-m-d");
echo  $a;

$b = md5("edison0000916");
echo $b;
echo "<br>";
		
//自定义函数
//即可以默认传值同时 给定初始的值 如果不定义的话就使用初始的值进行计算。


function myfunction($val,$val2="baby") {
	global $b;
	echo $val." ".$val2;
}

myfunction("come on","honey");
echo "<br>";
myfunction("come on");

echo "<br>";
if (function_exists("myfunction")){
	echo "yes";
}else{
	echo "no";
}

//返回引用值


	
	



?>