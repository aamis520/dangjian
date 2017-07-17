<!--modify password-->
<div class="modal fade" id="modal-6" style="display: none;" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title">修改密码</h5>
				</div>
				
				<div class="modal-body">
					
					<div class="row">
						<div class="col-md-12">
							
							<div class="form-group">
								<label for="oldPassword" class="control-label">当前密码</label>
								
								<input class="form-control" id="oldPassword" placeholder="" type="password">
							</div>	
							
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							
							<div class="form-group">
								<label for="newPassword" class="control-label">新密码</label>
								
								<input class="form-control" id="newPassword" placeholder="" type="password">
							</div>	
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							
							<div class="form-group">
								<label for="confirmPassword" class="control-label">确认新密码</label>
								
								<input class="form-control" id="confirmPassword" placeholder="" type="password">
							</div>	
							
						</div>
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">　关　闭　</button>
					<button type="button" class="btn btn-success" id="confirmnewpsd">　提　交　</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#confirmnewpsd').on('click',function(){
				if(!($('#confirmPassword').val() === $('#newPassword').val())){
					//提示输入的密码不一致
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
						toastr.error("两次输入的新密码不一致","",opts);
                    })();
                    return false;
				}
				$.ajax({
					type:"GET",
					url:"<?php echo $url = getapiurl('resetpassapi');?>",
					dataType:"json",
					data:{
						userid:"<?php echo $_SESSION["userid"]?>",
						oldpassword:$('#oldPassword').val(),
						newpassword:$('#newPassword').val()
					},
					success:function(req){
						if(req && req["usrid"]){
							//成功
							(function(){
		                    	var opts = {
									"closeButton":false,
									"debug":false,
									"positionClass":"toast-center-center",
									"onclick":null,
									"showDuration":"300",
									"hideDuration":"1000",
									"timeout":"3000",
									"extndedTimeout":"1000",
									"showEasing":"swing",
									"showMethod":"fadeIn",
									"hideMethod":"fadeOut"
								};
								toastr.success("修改密码成功","",opts);
								$('#modal-6').modal('hide');
		                    })();
						}else{
							//失败
							(function(){
		                    	var opts = {
									"closeButton":false,
									"debug":true,
									"positionClass":"toast-center-center",
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
		                    return false;
						}
					}
				}).done(function(){
					
				});
			})
		});
	</script>