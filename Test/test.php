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

?>






