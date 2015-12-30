<?php
$a = array(3,5,"hello",9);
$b = array("id"=>2,"title"=>3);

echo $b['id'];
//print_r 可以清楚的显示数组的内容 下标也是从0开始的。

print_r($a);

//多维数组的创建
$arraylist =array(array(3,6),array(4,8));
print_r($arraylist);
echo $arraylist[1][1].$arraylist[1][0];

//数组的统计函数 count统计单个数组中的元素 只是单个数组中的元素 而不是最基本元素
echo count($arraylist);

//is_array 判断是不是数组
if (is_array($arraylist))
	echo "yes";
else 
	echo "no";

//explode 另一种创建数组的方式 直接把一串字符串变成一个数组
$a = "1986-1983-1980-1977";
$aa =explode("-",$a);
print_r($aa);

echo"<br>";
//使用foreach 遍历数组 非常方便的提取出每个的key 和value 也可以直接提取值
foreach ($aa as $key => $val){
	echo $key."-";
	echo $val;
	echo"<br>";
}


?>