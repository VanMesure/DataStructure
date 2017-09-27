<!DOCTYPE html>
<html>
<head>
	<title>Let's code!</title>
	<?php
 		header("content-type:text/html; charset=utf-8");
 		header ("Cache-Control: no-cache, must-revalidate");
	?>
	<link rel="stylesheet" type="text/css" href="css/index.css"/>
	<meta charset="utf-8">

</head>

<body>
<div class = "mask">
	<h1 class="logo">Let's code!</h1>
	<div class = "border">
		<div class = "login">
			 <form action="pages/logincheck.php" method="post"  autocomplete="off">
			 	<div class = "form-head">请登录</div>
			 	<div class="form"><span>用户名： </span><br/><input type="text" name="user_name" placeholder="请输入学号" autocomplete="off"></div>
			 	<div class="form"><span>密码： </span><br/><input type="password" name="user_password" placeholder="请输入密码" autocomplete="off"></div>
			 	<div class="submit">
			 		<button action = "logincheck.php">登录</button>
			 		<button id="signbtn">注册</button>
			 	</div>
			 </form>
		</div>
	</div>

	<!--弹出层-->
	<div class = "diolog" >
		<div class="d-head"><h4>请注意</h4></div>
		<div class="d-body">
			<p>1. 该网站目前尚处于测试阶段，使用过程中可能会出现一些小问题。第一次进入时可能有点慢，请耐心等待。</p>
			<p>2. 强烈建议使用Firefox或者Chrome浏览器访问本站，如果使用其他浏览器，请尽量升级到最新版本。</p>
			<p>3. 本站所有题目均为原创，如果发现题目中有错误，或者是有好的建议，可以联系站长。</p>
			<p>4. 程序编译出错时，我们会给出错误信息，这些信息由系统生成，里面携带了一些目录信息，看上去可能会有点长，请自行提取有用信息。</p>
			<p>5. 暂时不限制提交题目的次数，无论对错，我们仅会保留最后一次结果。（也就是说如果做了两次题目，第一次正确第二次错误，那么该题会被当作错题处理）。</p>
			<p>6. 感谢你使用本站，可以通过QQ 562771180联系我们 ：） </p>
			<button class="diologBtn">知道啦</button>
		</div>
	</div>

	<div class = "diolog" id="sign-panel">
		<div class="d-head"><h4>注册</h4></div>
		<div class="d-body">
			<form " id="sign_form">
				<div class="form"><span>请输入学号： </span><br/><input type="text" name="user_name" placeholder="请输入学号" id="username""></div>
			 	<div class="form"><span>请输入密码： </span><br/><input type="password" name="user_password" placeholder="请输入密码" autocomplete="off" id="password" onfocus="this.type='text'"  onblur="this.type='password'"></div>
			 	<div class="form" id="r-password"><span>请重复输入密码： </span><br/><input type="password" name="repeat" placeholder="请输入密码" autocomplete="off" onfocus="this.type='text'" onblur="this.type='password'" id="repeat" "></div>
			 	<div class="form" id="sign-name"><span>请重复输入姓名： </span><br/><input type="password" name="repeat" placeholder="请输入姓名" autocomplete="off" onfocus="this.type='text'" onblur="this.type='password'" "></div>
			 	<div class="form" id="sign-class"><span>请重复输入班级： </span><br/><input type="password" name="repeat" placeholder="请输入班级" autocomplete="off" onfocus="this.type='text'" onblur="this.type='password'" "></div>
			 	<!--<div class="warning"><p>暂时只允许使用学号进行注册</p></div>-->
			 	<div class="btnbox">
			 		<button id="sign">注册</button>
			 		<button id="close">取消</button>
			 	</div>
			</form>
			
		</div>
	</div>

</div>
<script type="text/javascript" src = "js/basic.js"></script>
</body>
</html>