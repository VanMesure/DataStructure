<?php  
	/*
	* 状态码：
	* 0： 数据库链接失败
	* 1： 未知的用户名或者qID
	* 2： 数据库错误
	* 3： 成功
	*/
	session_start();
	$code = file_get_contents('php://input');
	$link = null;
	if(!($link = mysqli_connect("localhost","root", ""))){
		echo "0";
		exit(0);
	}
	mysqli_select_db($link, "newds");
	mysqli_query($link, "SET NAMES utf8");
	$username = $_SESSION['username'];
	if(!username){
		exit();
	}
	$qID = $_SESSION['qID'];
	if($username == null || $qID == null){
		echo "1";
		exit(0);
	}

	$status = 0;
	$sql = "select * from student_code where username = '$username' and qID = $qID";
	$result = mysqli_query($link, $sql);
	$rows = mysqli_num_rows($result);
	if($rows < 1){
		$sql = "insert into student_code values('$username', '$qID', '$code', 0, 'null', 'null')";
	}else{
		$sql = "update student_code set code = '$code', status = $status, result = '暂时没有结果呢，请稍等一下....' where username = '$username' and qID = $qID";
	}
	if(!mysqli_query($link, $sql)){
		echo $sql;
		echo "2"; 
	}else{
		echo $sql;
		echo "3 ";
	}

//	$code = null;
//	$code =  $_POST['code'];
//	
//	$file = fopen("code.txt", "w");
//	file_put_contents("code.txt", $str);
	

?>