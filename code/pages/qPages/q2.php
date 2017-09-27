<!DOCTYPE html>
<html>
<?php
		session_start();
		/*-------题号修改这里↓↓↓---------*/
		$_SESSION['qID'] = 2;
		header ("Cache-Control: no-cache, must-revalidate");
?>
<head>
	<title>Editor</title>
	<meta charset="utf-8">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css\codemirror.css">
	<link rel="stylesheet" type="text/css" href="../css\seti.css">
	<script type="text/javascript" src="../js\codemirror.js"></script>
	<script type="text/javascript" src="../js\clike.js"></script>
	<script type="text/javascript" src="../js/matchbrackets.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/static/h-ui/css/H-ui.css">
	<script type="text/javascript" src = '../css/static/h-ui/js/H-ui.js'></script>
	<link href="../css\lib\Hui-iconfont\1.0.8\iconfont.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="../css/editor.css">
	<script type="text/javascript" src="../js/H-ui.js"></script>
</head>

<body>
	<main role="main">
		<aside class="aside col-md-2">
			<a href = "../qList.php"><i class="Hui-iconfont">&#xe678;</i></a>
			<h3 class="text-c">斐波那契数列</h3>
			<p class="desturction">  斐波那契数列是什么？简单的说就是有这样一个数列，他的前两项都是1，从第三项开始，第n项的值为第n-1项的值加上第n-2项的值。就像下面这样<br/>1 1 2 3 5 8 ··· <br> 完成Fsequence()函数，使其返回斐波那契数列中第n项的值。
			</p>
			<div class="tips">
				<h4>小贴士:</h4>
				<ul>
					<!--这里是说明  修改这里！！-->
					<li><span class="label label-primary radius va-m">1</span><span>建议使用递归来完成。</span></li>
					<li><span class="label label-primary radius">2</span><span>不要忘记 return </span></li>
					<li><span class="label label-primary radius">3</span><span>合理使用注释、缩进来增强代码可读性</span></li>
					
				</ul>
			</div>
			</p>
		</aside>
		<div id = "editor" class="col-md-7">
			<textarea id = "code"></textarea>
		</div>
		<div id="right" class="col-md-3">
			<form action="*" class="text-c">
				<div class="btn-box">
					<button class="btn btn-primary radius size-XL" id="submit" onClick="modaldemo()""><i class="Hui-iconfont">&#xe642;</i> 上传代码</button>
				</div>
				<div class="btn-box">
					<button class="btn btn-secondary radius size-XL" id="result"><i class="Hui-iconfont">&#xe695;</i> 查看结果</button>
				</div>
				<div class="btn-box">
					<button class="btn btn-warning radius size-XL" id="back"><i class="Hui-iconfont">&#xe68f;</i> 重置代码</button>
				</div>
			</form>
			<div class="panel panel-primary" id="result-panel">
				<dir class="panel-header">运行结果</dir>
				<div class="panel-body" id="resultBody"></div>
			</div>
		</div>
	</main>

	<!--弹出层 up-->
	<div id="modal-up" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content radius">
				<div class="modal-header">
					<h3 class="modal-title"></h3>
					<a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
				</div>
				<div class="modal-body">
					<p class="text-c">上传成功！稍后点击查看结果按钮获取运行结果</p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">确定</button>
				</div>
			</div>
		</div>
	</div>

	<!--弹出层 reback-->
	<div id="modal-reback" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content radius">
				<div class="modal-header">
					<h3 class="modal-title"></h3>
					<a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
				</div>
				<div class="modal-body">
					<p class="text-c">注意！此操作将重置代码</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" data-dismiss="modal" id="reback">确定</button>
					<button class="btn" data-dismiss="modal" aria-hidden="true">在再虑一下</button>
				</div>
			</div>
		</div>
	</div>

	
</body>
	<script type="text/javascript" src="../js/editor.js"></script>
</html>