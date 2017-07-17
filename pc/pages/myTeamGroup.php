<?php global $requestfromdangjianapp; if(!$requestfromdangjianapp) {?>
<nav class="navbar navbar-default " role="navigation">
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li class="active">
				<a href="?page=myTeamGroup" class="">
					我的群组
				</a>
			</li>
			<li class="">
				<a href="?page=teamGroup">
					组织群组
				</a>
			</li>
		</ul>
		<a href="?page=creatGroup" class="btn btn-xs btn-danger pull-right center" style="position: relative;top: 20px;">　创建群组　</a>
	</div>
</nav>
<?php } ?>
<div class="xe-widget xe-conversations">
	<div class="xe-header">
		<div class="xe-label">
			<h3>
				我的群组
			</h3>
		</div>
	</div>
	<div class="xe-body">
		<ul class="list-unstyled" id="showMyGroup">
			<!--<li>
				<div class="row">
					<div class="col-sm-12">
						<div class="xe-comment-entry">
							<a href="#" class="xe-user-img">
							</a>
							
							<div class="xe-comment">
								<a href="#" class="xe-user-name">
									<strong>Jack Gates</strong>
								</a>
								<button class="btn btn-xs btn-success pull-right" onclick="window.location.href = '?page=groupDetail&groupid='+groupid;">　详　情　</button>
								<input type="hidden" value="" />
								<p>关于这个群组的简介</p>
								<p>群主：<span>苏妲己</span>创建时间：<b>2017-3-12</b> 成员：<i>1</i></p>
							</div>
						</div>
					</div>
					
				</div>
			</li>-->
		</ul>
		
	</div>
</div>

<script type="text/javascript">
	//展示我的群组的信息
	$(document).ready(function(){
		init();
		
		$.ajaxSetup({cache:false});
		function init(){
			
			$.ajax({
				type:"GET",
				url:"<?php echo getapiurl('listallmygroupapi'); ?>",
				data:{
					ownerid:"<?php echo $_SESSION["userid"]?>",
					radom:parseInt(10000*Math.random())
				},
				dataType:"json",
				success:function(res){
					console.log(res.org);
					res = eval(res.org);
					for (var i = 0; i < res.length ; i ++) {
						var tmp = i;
						var $html = "";
						(function(){
							var groupname =  res[tmp].groupname;
							var ownername = res[tmp].ownername;
							var creatTime = res[tmp].createdAt.substring(0,10);
							var description = res[tmp].description;
							var groupid = res[tmp].groupid;
							//字符串转成数组
							var usersChar = res[tmp].users;
							var users = usersChar.split(',');
							var len = users.length;
				                $html += '<li>';
				                $html += '<div class="row">';
				                $html += '<div class="col-sm-12">'
				                $html += '<div class="xe-comment-entry">';
				                $html += '<a href="#" class="xe-user-img">';
//				                $html += '<img src="assets/images/user-2.png" class="img-circle" width="40">';
				                $html += '</a>';
				                $html += '<div class="xe-comment">';
				                $html += '<a href="#" class="xe-user-name">';
				                $html += '<strong>'+ groupname +'</strong>';
				                $html += '</a>';
				                $html += '<button class="btn btn-xs btn-success pull-right" onclick="window.location.href = ';
				                $html += "'?page=groupDetail&groupid=";
				                $html +=  groupid +"'";
				                $html += ';">　详　情　</button>';
//				                $html += '<button class="btn btn-xs btn-success pull-right groupDetail">　详　情　</button>';
				                $html += '<p>'+description+'</p>';
				                $html += '<p>群主：<span>'+ownername+'　　</span>创建时间：<b>'+creatTime+'　　</b> 成员人数：<i>'+ len +'</i></p>';
				                $html += '<input type="hidden" value="';
				                $html += groupid;
				                $html += '" />';
				                $html += '</div></div></div></div></li>';
				                
				                $("#showMyGroup").prepend($html);
						})(tmp);
					}
				},
				error:function(err){
					(function(){
			        	var opts = {
							"closeButton":false,
							"debug":false,
							"positionClass":"toast-top-full-width",
							"onclick":null,
							"showDuration":"300",
							"hideDuration":"1000",
							"timeout":"1000",
							"extndedTimeout":"1000",
							"showEasing":"swing",
							"showMethod":"fadeIn",
							"hideMethod":"fadeOut"
						};
						toastr.error("网络错误","",opts);
			        })();
				}
			});
			
		};
	});
</script>
	

					