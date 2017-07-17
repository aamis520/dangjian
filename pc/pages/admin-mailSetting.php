
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">信箱设置</h3>
			</div>
			<div class="panel-body">
				<form role="form" class="form-horizontal">
					<!--姓名-->
					<div class="form-group">
						<label class="col-sm-2 control-label">党委书记信箱</label>
						<div class="col-sm-10">
							<select class="form-control chooseUser" value="请选择人员" id="dangweiMail">
								<option>请选择人员</option>
								
							</select>
						</div>
					</div>
					<div class="form-group-separator"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label">纪委书记信箱</label>
						<div class="col-sm-10">
							<select class="form-control chooseUser" value="请选择人员" id="jiweiMail">
								<option>请选择人员</option>
								
							</select>
						</div>
					</div>
					<div class="form-group-separator"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label">支部书记信箱</label>
						<div class="col-sm-10">
							<select class="form-control chooseUser" value="请选择人员" id="zhibuMail">
								<option>请选择人员</option>
								
							</select>
						</div>
					</div>
					<div class="form-group">
						<!--<button type="button" class="btn btn-gray btn-single">Sign in</button>-->
						<button id="mailSendSet" type="button" class="btn btn-success btn-single pull-right">　保　存　</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(function()
    {
    	//选择所有人员
    	$.ajax({
			type:"GET",
			url:"<?php echo getapiurl('getuserprofileapi') ?>",
			dataType:"json",
			async:false,
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
				}
			}
		});
		//设置回显
		$.ajax({
			type:"GET",
			url:"<?php echo getapiurl('getmailinfo') ?>",
			dataType:"json",
			async:false,
			data:{
				usrid: "<?php echo $_SESSION["userid"]; ?>"
			},
			success:function(res){
				if(res && res.org[0]){
					var resback = res.org[0];
					$('#dangweiMail').val(resback.dangweiid);
					$('#jiweiMail').val(resback.jiweiid);
					$('#zhibuMail').val(resback.zhibuid);
				}
			},
			error:function(err){
				console.log(err);
			}
		});
		//设置
		$('#mailSendSet').on('click',function(){
			//判断有没有选择人员
			if(($('#dangweiMail').val() == "请选择人员") || ($('#jiweiMail').val() == "请选择人员") || ($('#zhibuMail').val() == "请选择人员") ){
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
					toastr.error("请选择一位人员","",opts);
                })();
                return;
			}
			$.ajax({
				type:"GET",
				url:"<?php echo getapiurl('mailupdate') ?>",
				dataType:"json",
				data:{
					usrid: "<?php echo $_SESSION["userid"]; ?>",
					dangweiid:$('#dangweiMail').val(),
					jiweiid:$('#jiweiMail').val(),
					zhibuid:$('#zhibuMail').val()
				},
				success:function(res){
					if(res){
						$.ajax({
							type:"GET",
							url:"<?php echo getapiurl('updateshenfenapi'); ?>",
							dataType:"json",
							data:{
								usrid: "<?php echo $_SESSION["userid"]; ?>",
								dangweiid:$('#dangweiMail').val(),
								jiweiid:$('#jiweiMail').val(),
								zhibuid:$('#zhibuMail').val()
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
					}
				}
			});
		});
       
    });
</script>
