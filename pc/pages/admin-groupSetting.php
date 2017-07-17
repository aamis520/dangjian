<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><strong>群组设置</strong></h3>
			</div>
			<div class="panel-body">
				<form role="form" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="field-1">群名称</label>
						<div class="col-sm-10">
							<input class="form-control" id="field-1" placeholder="" type="text" placeholder="请输入群组名称" value="<?php echo $creatgroupinfo->{'groupname'};?>">
						</div>
					</div>
					<div class="form-group-separator"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="about">群描述</label>
						<div class="col-sm-10">
							<textarea class="form-control autogrow" name="about" id="about" data-validate="minlength[10]"  placeholder="" style="overflow: hidden; overflow-wrap: break-word; height: 124px;"><?php echo $creatgroupinfo->{'description'};?></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 pull-right">
							<button type="button" class="btn btn-success btn-single pull-right" id="setGroup">　提　交　</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="assets/js/toastr/toastr.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		//初始化群组数据
		//获取URL中传递过来的参数 groupid 
		//start
		function getUrlParam (name) {
		    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
		    var r = window.location.search.substr(1).match(reg);
		    if (r!= null) {
		        return unescape(r[2]);
		    }else{
		        return null;
		    }
		} 
		var groupid = decodeURI(getUrlParam('groupid'));
		$.ajax({
			type:"GET",
			url:"<?php echo getapiurl('getusergroupinfoapi'); ?>",
			dataType:"json",
			data:{
				groupid:groupid
			},
			success:function(res){
				if(res){
					var data = res[0];	
					var groupname = data.groupname;
					var description = data.description;
					//回显
					$('#field-1').val(groupname);
					$('#about').val(description);
					//修改群组信息
					$('#setGroup').on('click',function(){
						var newGroupName =  $('#field-1').val();
						var newDescription = $('#about').val();
						//判断如果都没有修改 则不提交
						if(!(newGroupName == groupname && newDescription == description)){
							$.ajax({
								type:"GET",
								url:"<?php echo getapiurl('updategroupsetapi'); ?>",
								dataType:"json",
								data:{
									groupid:groupid,
									groupname:newGroupName,
									description:newDescription
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
											toastr.success("修改群组信息成功","",opts);
				                        })();
				                        setTimeout(function(){
				                        	window.location.href = "?page=admin-groupControl";
				                        },1500);
									}
								},
								error:function(err){
									console.log(err);
								}
							});
						}else{
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
								toastr.error("您没有修改群组信息","",opts);
	                        })();
						}
					});
				}
				
			}
		})
	});
	
</script>