<?php

header("content-type:text/html;charset=utf-8");



	function _PAGEFT($totle, $displaypg = 20, $url = '') {

		global $page, $firstcount, $pagenav, $_SERVER;

		$GLOBALS["displaypg"] = $displaypg;//获得每页显示的数量
		
		if($_GET[page]){//先要获得当前发送的page的值否则一直都为第一页
			$page=$_GET[page];
		}
		if (!$page)//如果没有规定page则限定到第一页
			$page = 1;
		if (!$url) {
			$url = $_SERVER["REQUEST_URI"];//初始化到默认的地址
		}

		//URL分析：
		$parse_url = parse_url($url);//使用parse_url进行数据的分析
		$url_query = $parse_url["query"]; //单独取出URL的查询字串
		if ($url_query) {
			$url_query = ereg_replace("(^|&)page=$page", "", $url_query);
			$url = str_replace($parse_url["query"], $url_query, $url);
			if ($url_query)
				$url .= "&page";
			else
				$url .= "page";
		} else {
			$url .= "?page";//给url加上page的标签 实际是给后来用get来获取的
		}
		$lastpg = ceil($totle / $displaypg); //最后页，也是总页数
		$page = min($lastpg, $page);//页数要取到是当前也和总页数中最小的一个
		$prepg = $page -1; //上一页
		$nextpg = ($page == $lastpg ? 0 : $page +1); //下一页
		$firstcount = ($page -1) * $displaypg;//分页公式

		//开始分页导航条代码：
		$pagenav = "显示第 <B>" . ($totle ? ($firstcount +1) : 0) . "</B>-<B>" . min($firstcount + $displaypg, $totle) . "</B> 条记录，共 $totle 条记录";

		//如果只有一页则跳出函数：
		if ($lastpg <= 1)
			return false;

		$pagenav .= " <a href='$url=1'>Home</a> ";
		if ($prepg)
			$pagenav .= " <a href='$url=$prepg'>Previous</a> ";
		else
			$pagenav .= " Previous ";
		if ($nextpg)
			$pagenav .= " <a href='$url=$nextpg'>Next</a> ";
		else
			$pagenav .= " Next ";
		$pagenav .= " <a href='$url=$lastpg'>Last page</a> ";

		//下拉跳转列表，循环列出所有页码：
		$pagenav .= "　To <select name='topage' size='1' onchange='window.location=\"$url=\"+this.value'>\n";
		for ($i = 1; $i <= $lastpg; $i++) {
			if ($i == $page)
				$pagenav .= "<option value='$i' selected>$i</option>\n";
			else
				$pagenav .= "<option value='$i'>$i</option>\n";
		}
		$pagenav .= "</select> page，Total $lastpg ";
	}
//________________________________php code_________________________________________________//

	

include("Link.php");

$result=mysql_query("SELECT * FROM `Bde_produit_list`");
$total=mysql_num_rows($result);
//调用pageft()，每页显示10条信息（使用默认的20时，可以省略此参数），使用本页URL（默认，所以省略掉）。
_PAGEFT($total,9);
echo $pagenav;

$result=mysql_query("SELECT * FROM `Bde_produit_list` limit $firstcount,$displaypg ");
while($row=mysql_fetch_array($result)){

echo "<hr><b>".$row[name]." | ".$row[description];

}








?>
