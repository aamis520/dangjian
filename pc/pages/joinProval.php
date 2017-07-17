<div class="row">
	<div class="col-sm-12">
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">入党审批</h3>
			</div>
			<div class="panel-body">
				
				<form role="form" class="form-horizontal">
					
					<div class="form-group">
						<label class="col-sm-2 control-label" for="field-1">姓名</label>
						
						<div class="col-sm-10">
							<input type="text" class="form-control" id="field-1" placeholder="" value="" disabled="disabled" style="background: transparent; border: none;">
						</div>
					</div>
					
					<div class="form-group-separator"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="field-2">性别</label>
						
						<div class="col-sm-10">
							<input type="text" class="form-control" id="field-2" placeholder="" value="" disabled="disabled" style="background: transparent; border: none;">
						</div>
					</div>
					
					<div class="form-group-separator"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="field-3">民族</label>
						
						<div class="col-sm-10">
							<input type="text" class="form-control" id="field-3" placeholder="" value="" disabled="disabled" style="background: transparent; border: none;">
						</div>
					</div>
					
					<div class="form-group-separator"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="field-4">政治面貌</label>
						
						<div class="col-sm-10">
							<input type="text" class="form-control" id="field-4" placeholder="" value="" disabled="disabled" style="background: transparent; border: none;">
						</div>
					</div>
					<div class="form-group-separator"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="field-6">申请状态</label>
						
						<div class="col-sm-10">
							<input type="text" class="form-control" id="field-6" placeholder="" value="" disabled="disabled" style="background: transparent; border: none;">
						</div>
					</div>
					<div class="form-group-separator"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="field-5">入党申请书</label>
						
						<div class="col-sm-10">
							<div class="row">
								<div class="col-sm-4">
									<input type="text" class="form-control" id="field-5" placeholder="" value="" disabled="disabled" style="background: transparent; border: none;cursor: pointer;">
								</div>
								<div class="col-sm-8">
									<a href="javascript:;" class="btn btn-xs btn-blue" id="downloadzip">下载附件</a>
								</div>
							</div>
						</div>
					</div>
				</form>
				<div class="row" style="padding-top: 15px; display: none;" id="corpration">
					<div class="col-sm-12">
						<button class="btn btn-success" onclick = "$('#modal-agree').modal('show',{backdrop:'static'})">同　意</button>
						<button class="btn btn-white" onclick = "$('#modal-refuse').modal('show',{backdrop:'static'})">拒　绝</button>
					</div>
					<!--<div class="col-sm-6">
					</div>-->
				</div>
			</div>
		</div>
		
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		//获取URL中传递过来的参数 groupid 
		//start
		function GetRequest() { 
			var url = location.search; //获取url中"?"符后的字串 
			var theRequest = new Object(); 
			if (url.indexOf("?") != -1) { 
				var str = url.substr(1); 
				strs = str.split("&"); 
				for(var i = 0; i < strs.length; i ++) { 
					theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]); 
				} 
			} 
			return theRequest; 
		} 
		var Request = new Object(); 
		Request = GetRequest(); 
		var touser = Request['touser'];
		var fromusrid = Request['fromusrid'];
		//获取当前登录人员的审批职能
		$.ajax({
			type:"GET",
			url:"<?php echo getapiurl('getuserprofileapi'); ?>",
			dataType:"json",
			data:{
				usrid:"<?php echo $_SESSION["userid"] ?>",
				live:1
			},
			success:function(res){
				if(res[0].capability == "jijiapprover" || res[0].capability == "yubeiapprover" || res[0].capability == "dangyuanapprover"){
					var touser = res[0].capability;
					var username = res[0].userrealname;
					//显示申请信息
					$.ajax({
						type:"GET",
						url:"<?php echo getapiurl('getserviceflowapi') ?>",
						dataType:"json",
						data:{
							fromusrid:fromusrid,
							touser:touser,
							radom:parseInt(10000*Math.random())
						},
						success:function(res){
							//设置显示的申请信息
							data = eval(res.org);
							var name = data.provalname,
								sex = data.sex,
								nation = data.nation,
								politicalstatus = data.politicalstatus,
								provalstatus = data.provalstatus,
								provaldoc = data.provaldoc;
							$('#field-1').val(name);
							$('#field-2').val(sex);
							$('#field-3').val(nation);
							$('#field-4').val(politicalstatus);
							$('#field-5').val(provaldoc);
							$('#field-6').val(provalstatus);
							if(provalstatus == "申请中"){
								$('#corpration').show();
							}else{
								$('#corpration').hide();
							}
							//下载附件
							$('#downloadzip').on('click',function(){
								var url =encodeURI('uploadfile/'+fromusrid+'/'+provaldoc);
								window.location.href = url;
							});
							//同意申请
							$('#agreeConfirm').on('click',function(){
								provalstatus = "同意";
								var reasons = "";
								//审批  修改申请的状态
								$.ajax({
									type:"GET",
									url:"<?php echo getapiurl('updateserviceflowstatusapi'); ?>",
									dataType:"json",
									data:{
										fromusrid:fromusrid,
										tousrid:"<?php echo $_SESSION["userid"]; ?>",
										provalstatus:provalstatus,
										reasons:reasons
									},
									success:function(res){
										if(res && res.org[0].provalstatus == "同意"){
											//给申请人发送消息  -- 同意申请
											//0 拒绝  1 同意 2 申请
											$.ajax({
												type:"GET",
												url:"<?php echo getapiurl('createmessageapi'); ?>",
												dataType:"json",
												data:{
													userid:"<?php echo $_SESSION["userid"]; ?>",//发送消息的人
													touserid:fromusrid,//接收消息的人
													username:username,//发送消息的人名
													notifytype:"request",//消息类型
													isagree:1,
													topage:"myProval"
												},
												success:function(res){
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
														toastr.success("您已同意此申请","",opts);
													})();
													//关闭弹窗
													$('#modal-agree').modal('hide');
													setTimeout(function(){
														window.location.href = "?page=joinProvalList";
													},1500);
												},
												error:function(err){
													console.log(err);
												}
											});
										}
									},
									error:function(err){
										console.log(err);
									}
								});
							});
							//拒绝申请
							$('#refuseConfirm').on('click',function(){
								provalstatus = "拒绝";
								var reasons = $('#refuseReason').val();
								if(reasons == ""){
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
										toastr.error("请填写拒绝申请","",opts);
									})();
									return false;
								}
								//审批  修改申请的状态
								$.ajax({
									type:"GET",
									url:"<?php echo getapiurl('updateserviceflowstatusapi'); ?>",
									dataType:"json",
									data:{
										fromusrid:fromusrid,
										tousrid:"<?php echo $_SESSION["userid"]; ?>",
										provalstatus:provalstatus,
										reasons:reasons
									},
									success:function(res){
										if(res && res.org[0].provalstatus == "拒绝"){
											//给申请人发送消息  -- 同意申请
											//0 拒绝  1 同意 2 申请
											$.ajax({
												type:"GET",
												url:"<?php echo getapiurl('createmessageapi'); ?>",
												dataType:"json",
												data:{
													userid:"<?php echo $_SESSION["userid"]; ?>",//发送消息的人
													touserid:fromusrid,//接收消息的人
													username:username,//发送消息的人名
													notifytype:"request",//消息类型
													topiccontext:reasons,
													isagree:0,
													topage:"myProval"
												},
												success:function(res){
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
														toastr.success("您已拒绝此申请","",opts);
													})();
													//关闭弹窗
													$('#modal-refuse').modal('hide');
													setTimeout(function(){
														window.location.href = "?page=joinProvalList";
													},1500);
												},
												error:function(err){
													console.log(err);
												}
											});
										}
									},
									error:function(err){
										console.log(err);
									}
								});
							})
						},
						error:function(err){
							
						}
					});
				}else{
					
				}
					
			},
			error:function(err){
							
			}
		});
		
	});
</script>
	