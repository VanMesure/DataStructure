<?php

	header('content-type:application/json;charset=utf8');
	session_start();
	$qID = $_SESSION['qID'];
	$username = $_SESSION['username'];

	$link = mysqli_connect("localhost:3306", "root", "");
	mysqli_query($link, "SET NAMES utf8"); 
	mysqli_select_db($link, "newds");
	$sql = "select result, status from student_code where username = '$username' and qID = $qID";
	$result = mysqli_query($link, $sql);
	$rowNumber = mysqli_num_rows($result);
	if($rowNumber < 1){
		echo "没有查询到相关记录，请确定以提交";
		exit(1);
	}
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$results = $row;
	echo json_encode($results);

	mysqli_free_result($result);
	mysqli_close($link);

?>