<!doctype html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>用户登录</title>
<link rel="stylesheet" href="assets/css/xenon-components.css">
<link rel="stylesheet" type="text/css" href="assets/css/loginstyles.css">
</head>
<body>
<!-- 代码 开始 -->
<div class="wrapper">
	<div class="container">
		<form class="form">
			<input id="username" type="text" placeholder="用户名">
			<input id="password" type="password" placeholder="密码">
			<a href="javascript:;" id="forgetPsd">忘记密码</a>
			<button type="submit" id="login-button">登陆</button>
		</form>
	</div>
	
</div>

<script src="assets/js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="assets/js/toastr/toastr.min.js"></script>
<script>
$('#login-button').click(function (event) {
	event.preventDefault();
//	$('form').fadeOut(500, function(){
	    $.ajax(
            {
                url: "<?php echo getapiurl('loginapi')?>",
                dataType: "json",   //返回格式为json
                cache:false,
                data: {
                    "loginname": document.getElementById('username').value,
                    "password":document.getElementById('password').value
                },
                type: "get",   //使用get进行查询
                success: function(req) {
                    //请求成功时处理
                    if(req && req["userid"]){
                        location.href = "index.php?page=personCenter&userkey="+req['userkey']+"&userid="+req['userid'];
                    }else{
                    	//用户名或密码错误
                        (function(){
                        	var opts = {
								"closeButton":false,
								"debug":false,
								"positionClass":"toast-top-full-width",
								"onclick":null,
								"showDuration":"300",
								"hideDuration":"1000",
								"timeout":"3000",
								"extndedTimeout":"1000",
								"showEasing":"swing",
								"showMethod":"fadeIn",
                                "hideMethod":"fadeOut"
							};
							toastr.error(req["error"],"",opts);
                        })();
                        	
                    }
                },
                error: function() {
                	//网络错误
                    (function(){
                    	var opts = {
							"closeButton":false,
							"debug":false,
							"positionClass":"toast-top-full-width",
							"onclick":null,
							"showDuration":"300",
							"hideDuration":"1000",
							"timeout":"3000",
							"extndedTimeout":"1000",
							"showEasing":"swing",
							"showMethod":"fadeIn",
							"hideMethod":"fadeOut"
						};
						toastr.error("网络异常，请刷新后重试","",opts);
                    })();
                }
            }
        )
//  });
	$('.wrapper').addClass('form-success');
});
var flag = true;
$('#forgetPsd').on('click',function(ev){
	
	ev.preventDefault();
	if(flag){
		var opts = {
			"closeButton":false,
			"debug":false,
			"positionClass":"toast-top-left",
			"onclick":null,
			"showDuration":"300",
			"hideDuration":"1000",
			"timeout":"2000",
			"extndedTimeout":"1000",
			"showEasing":"swing",
			"showMethod":"fadeIn",
			"hideMethod":"fadeOut"
		};
		toastr.error("请联系管理员","忘记密码",opts);
	}
	flag = false;
});

</script>
<!-- 代码 结束 -->

</body>
</html>