<nav class="navbar navbar-default " role="navigation">
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li class="">
				<a href="?page=myTeamGroup" class="">
					我的群组
				</a>
			</li>
			<li class="active">
				<a href="?page=teamGroup">
					组织群组
				</a>
			</li>
		</ul>
		
	</div>
</nav>
<div class="xe-widget xe-conversations">
	<div class="xe-header">
		<div class="xe-label">
			<h3>
				组织群组
			</h3>
		</div>
	</div>
	<div class="xe-body">
		<ul class="list-unstyled" id="showMyTeamGroup">
			
		</ul>
		
	</div>
</div>
<script type="text/javascript">
	//展示我的群组的信息
	$(document).ready(function(){
		$.ajax({
			type:"GET",
			url:"<?php echo getapiurl('getusergroupinfoapi'); ?>",
			data:{
				istissue:true
			},
			dataType:"json",
			success:function(res){
				res = eval(res);
				for (var i = 0; i < res.length ; i ++) {
					var tmp = i;
					var $html = "";
					(function(){
						var name = res[tmp].groupname;
						var ownername = res[tmp].ownername;
						var creatTime = res[tmp].createdAt.substring(0,10);
						var description = res[tmp].description;
						//字符串转成数组
						var usersChar = res[tmp].users;
						var users = usersChar.split(',');
						var len = users.length;
			                $html += '<li>';
			                $html += '<div class="row">';
			                $html += '<div class="col-sm-12">'
			                $html += '<div class="xe-comment-entry">';
			                $html += '<a href="#" class="xe-user-img">';
//			                $html += '<img src="assets/images/user-2.png" class="img-circle" width="40">';
			                $html += '</a>';
			                $html += '<div class="xe-comment">';
			                $html += '<a href="#" class="xe-user-name">';
			                $html += '<strong>'+name+'</strong>';
			                $html += '</a>';
			                $html += '<p>'+description+'</p>';
			                $html += '<p>群主：<span>'+ownername+'　　</span>创建时间：<b>'+creatTime+'</b> 　　成员：<i>'+len+'</i></p>';
			                
			                $html += '</div></div></div></div></li>';
			                
			                $("#showMyTeamGroup").prepend($html);
					})(tmp);
				}
			},
			error:function(err){
				
			}
		});
	});
</script>
	

					