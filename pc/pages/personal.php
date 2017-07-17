<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">个人资料</h3>
			</div>
			<div class="panel-body">
				<form role="form" class="form-horizontal">
					<!--姓名-->
					<div class="form-group">
						<label class="col-sm-2 control-label" for="field-1">姓名</label>

						<div class="col-sm-10">
							<input class="form-control" id="field-1" disabled="disabled" value="<?php echo getsession('userdetailinfo')[0]->{"userrealname"};?>" type="text">
						</div>
					</div>
					<div class="form-group-separator"></div>
					<!--性别-->
					<div class="form-group">
						<label class="col-sm-2 control-label">性别</label>
						
						<div class="col-sm-10" id="sex" name="男">
							<!--<p>
								<label class="radio-inline">
									<input name="radio-2" checked="" type="radio" value="男">
									男
								</label>
								<label class="radio-inline">
									<input name="radio-2" type="radio" value="女">
									女
								</label>
							</p>-->
							<input class="form-control" id="field-sex" disabled="disabled" value="<?php echo getsession('userdetailinfo')[0]->{"sex"};?>" type="text">
						</div>
					</div>
					<div class="form-group-separator"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="field-2">生日</label>
						<div class="col-sm-10">
							<input class="form-control" id="field-2" placeholder="" type="text">
						</div>
					</div>
					<div class="form-group-separator"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label">简介</label>
						<div class="col-sm-10">
							<input class="form-control" id="field-3" placeholder="" type="text">
						</div>
					</div>
					<div class="form-group-separator"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label">电话</label>
						<div class="col-sm-10">
							<input class="form-control" id="field-4" disabled="disabled" value="<?php echo getsession('userdetailinfo')[0]->{"phonenumber"};?>" type="text">
						</div>
					</div>
				</form>
					<div class="form-group" style="padding-top: 15px;">
						<button id="submitpersoninfo" type="button" class="btn btn-success btn-single pull-right">　保　存　</button>
					</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(function()
    {
    	//回显
    	$.ajax({
			type:"GET",
			url:"<?php echo getapiurl('getuserprofileapi'); ?>",
			dataType:"json",
			data:{
				usrid:"<?php echo $_SESSION["userid"];  ?>",
				live:1
			},
			success:function(res){
				if(res){
					var data = res[0];
					var birthday = data.birthday;
					var simpleproduct = data.simpleproduct;
					$("#field-2").val(birthday);
					$("#field-3").val(simpleproduct);
				}
			},
			error:function(err){
				console.log(err);
			}
		});
		//修改个人资料
        $("#submitpersoninfo").click(function()
        {
        	//生日
        	if($("#field-2").val() == ""){
        		$("#field-2").val() == " ";
        	}
        	//简介
        	if($("#field-3").val() == ""){
        		$("#field-3").val() == " ";
        	}
            $.ajax
            ({
                type:"GET",
                url: "<?php echo $url = getapiurl('updatepersonalapi');?>",
                dataType: "json",
                data:{
                    usrid:"<?php echo $_SESSION["userid"]?>",
                    birthday:$("#field-2").val(),//生日
                    simpleproduct:$("#field-3").val(),//描述
                },
                success:function(req){
                	if(req && req["usrid"]){
                		(function(){
	                    	var opts = {
								"closeButton":false,
								"debug":false,
								"positionClass":"toast-top-full-width",
								"onclick":null,
								"showDuration":"300",
								"hideDuration":"1000",
								"timeout":"2000",
								"extndedTimeout":"1000",
								"showEasing":"swing",
								"showMethod":"fadeIn",
								"hideMethod":"fadeOut"
							};
							toastr.success("修改资料成功","",opts);
	                    })();
                	}else{
                		console.log(232);
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
							"timeout":"2000",
							"extndedTimeout":"1000",
							"showEasing":"swing",
							"showMethod":"fadeIn",
							"hideMethod":"fadeOut"
						};
						toastr.error(err,"",opts);
                    })();
                }
            }).done(function(){
            	//提示提交成功
            	
            });
        });
    });
</script>
