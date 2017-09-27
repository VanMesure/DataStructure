<?php
	$username = $_GET['username'];
	$password = $_GET['password'];
	$name =  $_GET['name'];
	$class =  $_GET['class'];
	$connect = mysqli_connect("localhost:3306","root","");
	echo $username;
	if(!$connect){
		echo "链接数据库错误，请稍后重试";
		exit();
	}
	mysqli_select_db($connect,"newds");
	$sql = "select * from student_info where username='$username'";
	$result = mysqli_query($connect,$sql);
	$rowCount = mysqli_num_rows($result);
	if($rowCount != 0){
		echo "账号已经存在！";
		exit();
	}
	$sql = "insert into student_info values('$username', '$password','$name', '$class')";
	mysqli_query($connect,$sql);
	echo "注册成功";


?>