
		/*
		*初始化编辑器
		*/
		var editor=CodeMirror.fromTextArea(document.getElementById("code"),{
                value:"drwegbrdd",
                mode:"text/x-c", 	//选择c模式
                lineNumbers:true,	//显示行号
                theme:"seti",		//选择主题
                matchBrackets:true,	//括号匹配
        });
        var height = document.documentElement.clientHeight;
        editor.setSize("auto",height - 1 + "px");


		/*
		*获取源代码
        */
        function getCode(mouseEvent){
        	var url = "../getCode.php";
      	 	var xhr = new XMLHttpRequest();
        	xhr.open("get", url, true);
        	xhr.send();
        	xhr.onreadystatechange = function(){
        		if(xhr.readyState == 4){
        			if(xhr.status >= 200 && xhr.status < 300){
        				var code = xhr.responseText;
        				editor.setValue(code);
        			}
        		}
       		}
        }
        getCode();


        /*
		    *添加提交代码事件
        */
        var submit = document.getElementById("submit");
        submit.addEventListener("click", function(mouseEvent){
        	//阻止跳转
        	mouseEvent.preventDefault();
        	var code = editor.getValue();
        	var xhr = new XMLHttpRequest();
        	xhr.onreadystatechange = function(){
        		if(xhr.readyState == 4){
        			if(xhr.status >= 200 && xhr.status < 300){
        				console.log(xhr.responseText);
        			}
        		}
        	};
        	xhr.open("post", "../receiveCode.php", true);//初始化一个http请求，第三个参数为true的时候代表异步发送请求，配合onreadystatechange事件
        	xhr.send(code);//发送请求
        	$("#modal-up").modal("show");
          document.getElementById("resultBody").innerHTML = " ";
        	setPanelColor("primary");
        });


        /*
		*重置代码
        */
       var back = document.getElementById("back");
       back.addEventListener("click", function(mouseEvent){
       		mouseEvent.preventDefault();
       		$("#modal-reback").modal("show");
       //		getCode();
       });
       document.getElementById("reback").addEventListener("click", getCode);


       /*
		*查询结果
       */
       var result = document.getElementById("result");
       var resultBody = document.getElementById("resultBody");
       result.addEventListener("click",function(mouseEvent){
       		mouseEvent.preventDefault();
       		var xhr = new XMLHttpRequest();
       		xhr.onreadystatechange = function(){
       			var readyState = xhr.readyState;
       			var status = xhr.status;
       			if(readyState == 4){
       				if(status >= 200 && status < 300){

       					var result = JSON.parse(xhr.responseText)['result'];
       					var status = JSON.parse(xhr.responseText)['status'];
       					var result = result.slice(0,result.length - 2);//后台c程序在测试时，在所有结果的最后会输出一个数字，用于java判断运行状态，这个数字会被当成结果插入数据库，因此这里要处理一下
       					
       					//将所有的换行符换成html支持的<br/>
       					while(result.indexOf("\n") != -1){
       						result = result.replace("\n", "<br/>");
       					}
       					var hint;
       					//更改提示和panel颜色
       					switch(status){
       						case "1": setPanelColor("warning");hint = "<strong>编译未通过！</strong><br/>";break;
       						case "2": setPanelColor("danger");hint = "<strong>运行结果不正确！</strong><br/>";break;
       						case "3": setPanelColor("success");hint = "<strong>测试通过!</strong><br/>";break;
       					}

                document.getElementById("resultBody").innerHTML = " " + hint + result;
       				}
       			}
       		
       		};
       		xhr.open("get","../getResult.php",true);
       		xhr.send();
       })


       /*
       *设置结果面板的颜色
       */
       function setPanelColor(color){
       		var panel = document.getElementById("result-panel");
       		panel.className = "panel panel-" + color;
     }