<?php
	session_start();
	$qID = $_SESSION['qID'];
	$fileName = "questions/"."q".$qID.".txt"; 
	$file = fopen($fileName,"r");
	$code = "";
	$d = 1;
	while(!feof($file)){
		echo fgets($file);
		$d ++;

	}
	echo $code;
	fclose($file);


?>