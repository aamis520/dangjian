<?php

?>
<!--流程审批-->
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">设置审批人员</h3>
			</div>
			<div class="panel-body">
				<form role="form" class="form-horizontal">
										
					<!--<div class="form-group">
						<label class="col-sm-2 control-label">部门</label>
						<div class="col-sm-10">
							<select class="form-control" value="请选择部门">
								<option>请选择部门</option>
								<option>党委</option>
								<option>纪委</option>
								<option>支部</option>
							</select>
						</div>
					</div>-->
					<!--<div class="form-group-separator"></div>-->
					<div class="form-group">
						<label class="col-sm-2 control-label">入党积极分子申请审批人</label>
						<div class="col-sm-10">
							<select class="form-control chooseUser" value="请选择人员" id="jijishenqing">
								<option>请选择人员</option>
								
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">预备党员申请审批人</label>
						<div class="col-sm-10">
							<select class="form-control chooseUser" value="请选择人员" id="yubeishenqing">
								<option>请选择人员</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">正式党员申请审批人</label>
						<div class="col-sm-10">
							<select class="form-control chooseUser" value="请选择人员" id="dangyuanshenqing">
								<option>请选择人员</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<button type="button" class="btn btn-success btn-single pull-right" id="shenpiSetting">　保　存　</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			type:"GET",
			url:"<?php echo getapiurl('getuserprofileapi') ?>",
			async:false,
			data:{
				live:1
			},
			dataType:"json",
			success:function(res){
				for (var i = 0; i < res.length ; i ++) {
					var tmp = i;
					var $html = "";
					(function(){
						var username = res[tmp].userrealname;
						var usrid = res[tmp].usrid;
			                $html += '<option value="'+ usrid +'">'+username+'</option>';
			                $(".chooseUser").append($html);
					})(tmp);
				};
				//设置回显
				$.ajax({
					type:"GET",
					url:"<?php echo getapiurl('getapprovalinfo') ?>",
					dataType:"json",
					async:false,
					data:{
						usrid: "<?php echo $_SESSION["userid"]; ?>"
					},
					success:function(res){
						if(res && res.org){
							var resOrg = res.org;
							$('#jijishenqing').val(resOrg.jijishenpiid);
							$('#yubeishenqing').val(resOrg.yubeishenpiid);
							$('#dangyuanshenqing').val(resOrg.zhengshishenpiid);
						}
					},
					error:function(err){
						console.log(err);
					}
				});
			}
		});
		//积极分子
		$('#shenpiSetting').on('click',function(){
			if($('#jijishenqing').val() == "请选择人员"){
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
					toastr.error("请选择一位审批人","",opts);
                })();
                return;
			}
			if($('#yubeishenqing').val() == "请选择人员"){
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
					toastr.error("请选择一位审批人","",opts);
                })();
                return;
            }
            if($('#dangyuanshenqing').val() == "请选择人员"){
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
					toastr.error("请选择一位审批人","",opts);
                })();
                return;
            }
			var jijishenpiid = $('#jijishenqing').val();
			var yubeishenpiid = $('#yubeishenqing').val();
			var zhengshishenpiid = $('#dangyuanshenqing').val();
			$.ajax({
				type:"GET",
				url:"<?php echo getapiurl('approvalupdate') ?>",
				dataType:"json",
				data:{
					usrid:"<?php echo $_SESSION["userid"]; ?>",
					jijishenpiid:jijishenpiid,
					yubeishenpiid:yubeishenpiid,
					zhengshishenpiid:zhengshishenpiid
				},
				success:function(res){
					//改变个人的审批字段
					$.ajax({
						type:"GET",
						url:"<?php echo getapiurl('updatecapabilityapi'); ?>",
						dataType:"json",
						data:{
							usrid:"<?php echo $_SESSION["userid"]; ?>",
							jijishenpiid:jijishenpiid,
							yubeishenpiid:yubeishenpiid,
							zhengshishenpiid:zhengshishenpiid
						},
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
										"timeout":"3000",
										"extndedTimeout":"1000",
										"showEasing":"swing",
										"showMethod":"fadeIn",
										"hideMethod":"fadeOut"
									};
									toastr.success("设置成功","",opts);
				                })();
				                setTimeout(function(){
				                	window.location.reload();
				                },1000);
							}
						},
						error:function(err){
							console.log(err);
						}
					});
					
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
							"timeout":"3000",
							"extndedTimeout":"1000",
							"showEasing":"swing",
							"showMethod":"fadeIn",
							"hideMethod":"fadeOut"
						};
						toastr.error(err,"",opts);
	                })();
				}
			});
		});
	})
</script>