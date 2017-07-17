<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><strong>创建群组</strong></h3>
			</div>
			<div class="panel-body">
				<form role="form" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="field-1">群名称</label>
						<div class="col-sm-10">
							<input class="form-control" id="field-1" type="text" placeholder="请输入群组名称">
						</div>
					</div>
					<div class="form-group-separator"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="about">群描述</label>
						<div class="col-sm-10">
							<textarea class="form-control autogrow" name="about" id="about" data-validate="minlength[10]"  placeholder="请输入群组描述" style="overflow: hidden; overflow-wrap: break-word; height: 124px;"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 pull-right">
							<button type="button" class="btn btn-success btn-single pull-right" id="creatGroup">　提　交　</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="assets/js/toastr/toastr.min.js"></script>
<script type="text/javascript">
	//获取用户信息
	$.ajax({
		type:"GET",
		url:"<?php echo getapiurl('getuserprofileapi'); ?>",
		data:{
			usrid:"<?php echo $_SESSION["userid"]?>",
			live:1
		},
		dataType:"json",
		success:function(res){
			res = eval(res);
			var ownername = res[0].userrealname;
			$('#creatGroup').on('click',function(){
				//创建群组
				//id 描述  群名称 群主
				
				var description = $('#about').val();
				var groupImg = $('#field-2').val();
				var groupName = $('#field-1').val();
				var tissueid = 1;
				var fatherGroup = "党委"; 
				var users = '<?php echo $_SESSION["userid"]?>';
//				users.push('<?php echo $_SESSION["userid"]?>');
				if(groupName == ""){
					//不得为空
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
						toastr.error("名称不得为空","",opts);
			        })();
					return;
				}
				
				if(description == ""){
					description == " ";
				}
				
				$.ajax({
					type:"GET",
					url:"<?php echo getapiurl('newusergroupapi'); ?>",
					data:{
						groupname:groupName,
						description:description,
						ownerid:"<?php echo $_SESSION["userid"]?>",
						users:users,
						ownername:ownername,
						istissue:true
					},
					dataType:"json",
					success:function(res){
						if(res){
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
								toastr.success("创建群组成功","",opts);
					        })();
					        setTimeout(function(){
		                    	window.location.href = "?page=admin-groupControl";
		                		
		                	},1500);
						}
					},
					error:function(err){
						if(err){
							alert(err);
						}
					}
				});
			})	
		}
	});
	
</script>