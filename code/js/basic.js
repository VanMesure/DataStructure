var body = document.getElementsByClassName("mask")[0];
body.style.height = screen.height + "px";

var diologBtn1 = document.getElementsByClassName("diologBtn")[0];
diologBtn1.addEventListener("click",function(mouse){
	mouse.preventDefault();
	document.getElementsByClassName("diolog")[0].style.display = "none";
});

var signbtn = document.getElementById("signbtn");
signbtn.addEventListener("click",function(mouse){
	mouse.preventDefault();
	document.getElementById("sign-panel").style.display = "block";
})

//注册
var sign_btn = document.getElementById("sign");
var close_btn = document.getElementById("close");
sign_btn.addEventListener("click", signEvent);
close_btn.addEventListener("click",closeEvent);
function closeEvent(mouse){
	mouse.preventDefault();
	document.getElementsByClassName("diolog")[1].style.display = "none";
}
function signEvent(mouse){
	mouse.preventDefault();
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	var repeat = document.getElementById("repeat").value;
	var name = document.getElementById("sign-name").value;
	var clas = document.getElementById("sign-class").value;
	console.log(username + "  " + password + "  " + repeat );
	if(username == null || password == null || repeat == null || name ==null || clas == null){
		alert("请全部填写完毕后再提交");
		return;
	}
	if (!(password == repeat)) {
		alert("两次输入的密码不一致！");
		return;
	}

	if(username.length != 9){
		alert("学号长度不对");
		return;
	}

	if(username.slice(0,3) != "201"){
		alert("不要拿假学号来糊弄我哦");
		return;
	}

	for(var i = 0; i < username.length; i++){
		if(!(username[i] >= "0" && username[i] <= "9") ){
			alert("不要拿假学号来糊弄我哦！");
			return;
		}
	}
	for(var i = 0; i < name.length; i++){
		if(!((name[i] >= 'a' && name[i] <= 'z') || (name[i] >= 'A' && name[i] <= 'Z'))){
			alert("只支持中文名字！");
			return;
		}
	}
	if(name.length != 5 || name[2] != 1){
		alert("班级格式不正确，请按正确格式输入，如（通信152）");
		return;
	}
	for(var i = 0; i < name.length; i++){
		if(!((name[i] >= 'a' && name[i] <= 'z') || (name[i] >= 'A' && name[i] <= 'Z'))){
			alert("只支持中文名字！");
			return;
		}
	}
	//var form = new FormData(document.getElementById("sign_form"));
	var xhr = new XMLHttpRequest();
	var url = "pages/signup.php?username=" + username + "&password=" + password + "&name=" + name + "&class=" + clas; 
	console.log(url);
	xhr.open("get", url, true);
	xhr.send();
	xhr.onreadystatechange = function(){
		if((xhr.status >= 200 && xhr.status <= 300) ){
			if(xhr.readyState == 4){
				alert(xhr.responseText);
			}
		}
	};

}