<!DOCTYPE html>
<html>
<?php
		session_start();
		/*-------题号修改这里↓↓↓---------*/
		$_SESSION['qID'] = 3;
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
			<h3 class="text-c">基于数组的线性表</h3>
			<p class="desturction">
				<font size = "2">本题目不做测试，你可以随意发挥，题目中仅给出一种思路,你可以随意修改源码(main函数的返回值请不要动).<br>
				希望你能理解什么是线性表，我们的题目是<strong>基于数组</strong>的线性表,意思是你要用数组去实现线性表.<br>举个例子,一个房子的图纸,能够形容出房子是什么样的,但是具体用什么去盖房子，砖头还是木头，这个并不是图纸所要关心的事情。
				我们可以用木头(数组)去盖(实现)房子(线性表),同样我们也可以用别的东西来盖(例如链表).我们希望你能借此理解数据结构的本质.(对于初学者来说，往往要花上很长时间来'顿悟').
				</font>
			</p>
			<div class="tips">
				<h4>小贴士:</h4>
				<ul>
					<!--这里是说明  修改这里！！-->
					
					<li><span class="label label-primary radius va-m">1</span><span>线性表的数据应该是串成一串儿的，所有的数据都得紧挨着(就是不允许出现a[0],a[1],a[3]有数据而a[2]没有数据的情况)</span></li>
				
					<li><span class="label label-primary radius">2</span><span>程序中printf()的值会返回控制台，但是因为后台机制的原因，字符串的最后几位会被吞掉，所以记得在printf()多写几个空格来避免这种现象</span></li>
				
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