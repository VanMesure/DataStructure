<?php
	session_start();
	header("content-type:text/html; charset=utf-8");
	//禁用浏览器缓存，否则会出先奇怪的情况
 	header ("Cache-Control: no-cache, must-revalidate");

	$userName = $_POST['user_name'];
	$userPassword = $_POST['user_password'];

	//连接数据库
	$link = mysqli_connect("localhost:3306", "root", "");
	if(!$link){
		echo "faild to connect databases!";
	}
	//设置编码格式
	mysqli_query($link, "SET NAMES utf8"); 
	//选择datastructure数据库
	mysqli_select_db($link, "newds");

	//查询用户名密码是否正确  注意表名别填错
	$sql = "select * from student_info where username = '$userName' and password = '$userPassword'";
	$result = mysqli_query($link, $sql);
	$rows = mysqli_num_rows($result);
	if($rows == 1){
	
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

	
		$name = $row['username'];
		$password = $row['password'];
		$_SESSION['username'] = $name;
		$_SESSION['password'] = $password;

		echo "登录成功-<a href='qList.php'>点击这里跳转</a>";
		
	}else{
		echo "账号密码错误！";
	}

?>



</body>
</html>