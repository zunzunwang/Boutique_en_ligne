<?php
header("content-type:text/html;charset=utf-8");
global $url;
$url = "../php/admin.php";
include("Link.php");


//上传文件类型列表
$uptypes=array(
  		'image/jpeg',
  		'image/png', 
  		'image/pjpeg',
  		'image/gif',
  		'image/bmp',
  		'image/x-png'
  );

  $max_file_size=2000000;     //上传文件大小限制, 单位BYTE
  $destination_folder="../upload_img/"; //上传文件路径
  $watermark=1;      //是否附加水印(1为加水印,其他为不加水印);
  $watertype=1;      //水印类型(1为文字,2为图片)
  $waterposition=1;     //水印位置(1为左下角,2为右下角,3为左上角,4为右上角,5为居中);
  $waterstring="https://www.telecom-st-etienne.fr";  //水印字符串
  $waterimg="./img/logo_tse.png";    //水印图片
  $imgpreview=1;      //是否生成预览图(1为生成,其他为不生成);
  $imgpreviewsize=1/2;    //缩略图比例

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
  	if (!is_uploaded_file($_FILES["upfile"][tmp_name]))
  	//是否存在文件
  	{
 		echo "<script>alert(\"the image doesn't exist!\")</script>";
 		echo "<script language=\"javascript\">location.href='../php/myAccount.php';</script>";
 		exit;
 	}

 	$file = $_FILES["upfile"];
 	if($max_file_size < $file["size"])
 	//检查文件大小
 	{
 		echo "<script>alert(\"the image is too big!\")</script>";
 		echo "<script language=\"javascript\">location.href='../php/myAccount.php';</script>";
 		exit;
 	}

 	if(!in_array($file["type"], $uptypes))
 	//检查文件类型
 	{
 		echo "<script>alert(\"the type isn't correct!\")</script>";
 		echo "<script language=\"javascript\">location.href='../php/myAccount.php';</script>";
 		exit;
 	}

 	if(!file_exists($destination_folder))
 	{
 		mkdir($destination_folder);
 	}

 	$filename=$file["tmp_name"];
 	$image_size = getimagesize($filename);
 	$pinfo=pathinfo($file["name"]);
 	$ftype=$pinfo['extension'];
 	$destination = $destination_folder.time().".".$ftype;
 	if (file_exists($destination) && $overwrite != true)
 	{
 		echo "<script>alert(\"the image name can't be same!\")</script>";
 		echo "<script language=\"javascript\">location.href='../php/myAccount.php';</script>";
 		exit;
 	}

 	if(!move_uploaded_file ($filename, $destination))
 	{
 		echo "<script>alert(\"problem of uploadTse\")</script>";
 		echo "<script language=\"javascript\">location.href='../php/myAccount.php';</script>";
 		exit;
 	}

 	$pinfo=pathinfo($destination);
 	$fname=$pinfo[basename];
 	echo " <font color=red>success</font><br>name:  <font color=blue>".$destination_folder.$fname."</font><br>";
 	echo " width:".$image_size[0];
 	echo " length:".$image_size[1];
 	echo "<br> size:".$file["size"]." bytes";

 	if($watermark==1)
 	{
 		$iinfo=getimagesize($destination,$iinfo);
 		$nimage=imagecreatetruecolor($image_size[0],$image_size[1]);
 		$white=imagecolorallocate($nimage,255,255,255);
 		$black=imagecolorallocate($nimage,0,0,0);
 		$red=imagecolorallocate($nimage,255,0,0);
 		imagefill($nimage,0,0,$white);
 		switch ($iinfo[2])
 		{
 			case 1:
 				$simage =imagecreatefromgif($destination);
 				break;
 			case 2:
 				$simage =imagecreatefromjpeg($destination);
				break;
			case 3:
				$simage =imagecreatefrompng($destination);
				break;
			case 6:
				$simage =imagecreatefromwbmp($destination);
				break;
			default:
				die("不支持的文件类型");
				exit;
		}

		imagecopy($nimage,$simage,0,0,0,0,$image_size[0],$image_size[1]);
		imagefilledrectangle($nimage,1,$image_size[1]-15,80,$image_size[1],$white);

		switch($watertype)
		{
			case 1:   //加水印字符串
				imagestring($nimage,2,3,$image_size[1]-15,$waterstring,$black);
				break;
			case 2:   //加水印图片
				$simage1 =imagecreatefromgif("../img/logo_tse.png");
				imagecopy($nimage,$simage1,0,0,0,0,85,15);
				imagedestroy($simage1);
				break;
		}

		switch ($iinfo[2])
		{
			case 1:
				//imagegif($nimage, $destination);
				imagejpeg($nimage, $destination);
				break;
			case 2:
				imagejpeg($nimage, $destination);
				break;
			case 3:
				imagepng($nimage, $destination);
				break;
			case 6:
				imagewbmp($nimage, $destination);
				//imagejpeg($nimage, $destination);
				break;
		}

		//覆盖原上传文件
		imagedestroy($nimage);
		imagedestroy($simage);
	}

	if($imgpreview==1)
	{
		echo "<br>image prévu:<br>";
		echo "<img src=\"".$destination."\" width=".($image_size[0]*$imgpreviewsize)." height=".($image_size[1]*$imgpreviewsize);
		echo " alt=\"image prévu:\rname:".$destination."\rupload_time:\">";
	}
	
}
if($_POST['submit']){
	$username=$_COOKIE['cookie'];
	$description=$_POST[description];
	$description=htmtocode($description);
	$description=mysql_real_escape_string($description);	
	$add_query="INSERT INTO `Bde_produit_list` (`id`, `name`, `type`, `price`, `description`, `img`) VALUES (NULL, '$_POST[name]', '$_POST[type]', '$_POST[price]', '$description', '$fname')";
	mysql_query($add_query);
	$error=mysql_error();
//	echo "<script language=\"javascript\">alert('you have added a new product');location.href='../php/myAccount.php';</script>";
	
 }

?>
<html>   
<head>   
<meta http-equiv="refresh" content="5;url=<?php echo $url;?>">   
</head>   
<body>   
5 seconds, we will return to the page……   
</body> 
</html>  

