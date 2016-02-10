<?php

// $a=4;

// if (a == 3){
// 	echo "ok";
	
// }else{
// 	echo "no";
// }


// switch ($a){
// 	case 0:
// 		echo "0";
// 		break;
// 	case 1:
// 		echo "1";
// 		break;
// 	case 2:
// 		echo"2";
// 		break;
// 	default:echo "ssss";
	
// }
//phpinfo();

$test = 10;
echo $test;
?>

<SCRIPT language = javascript>
function CheckSignin()
{
var test =<?php echo $test;?>;
alert(test);
		
}
</SCRIPT>
<?php


echo "<SCRIPT>CheckSignin();</SCRIPT>";

echo "<script language=\"javascript\">window.open('./allrecords.php', 'newwindow', 'height=100, width=400, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=no,location=no, status=no')</script>";
echo "<script language=\"javascript\">alert('aaaaa');</script>";


?>






