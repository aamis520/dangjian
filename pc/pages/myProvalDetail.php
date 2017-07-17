<div class="row">
	<div class="col-sm-12">
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">入党审批</h3>
				<button class="btn btn-blue pull-right" onclick="window.history.go(-1)">返回列表</button>
			</div>
			<div class="panel-body">
				
				<form role="form" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="field-6">申请状态</label>
						
						<div class="col-sm-10">
							<input type="text" class="form-control" id="field-6" placeholder="" value="" disabled="disabled" style="background: transparent; border: none;">
						</div>
					</div>
					<div class="form-group-separator"></div>
					
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
					
					<div class="form-group-separator"></div>
					<div class="form-group" id="reasons" style="display: none;">
						<label class="col-sm-2 control-label" for="field-reason">原因：</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="field-reason" placeholder="" value="" disabled="disabled" style="background: transparent; border: none;">
						</div>
					</div>
				</form>
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
		var touser = $.trim(Request['touser']);
		var fromusrid = Request['fromusrid'];
		$.ajax({
			type:"GET",
			url:"<?php echo getapiurl('getserviceflowapi'); ?>",
			dataType:"json",
			data:{
				fromusrid:"<?php echo $_SESSION["userid"]; ?>",
				touser:touser,
			},
			success:function(res){
				//设置显示的申请信息
				var data = eval(res.org);
				var name = data.provalname,
					sex = data.sex,
					nation = data.nation,
					politicalstatus = data.politicalstatus,
					provalstatus = data.provalstatus,
					reasons = data.reasons,
					provaldoc = data.provaldoc;
				$('#field-1').val(name);
				$('#field-2').val(sex);
				$('#field-3').val(nation);
				$('#field-4').val(politicalstatus);
				$('#field-5').val(provaldoc);
				$('#field-6').val(provalstatus);
				$('#field-reason').val(reasons);
				if(provalstatus == "拒绝"){
					$('#reasons').show();
					
				}else{
					$('#reasons').hide();
					$('#reasons').prev('div').hide();
				}
				//下载附件
				$('#downloadzip').on('click',function(){
					var url =encodeURI('uploadfile/'+fromusrid+'/'+provaldoc);
					window.location.href = url;
				});
			},
			error:function(err){
//				console.log(err);
			}
		})

		
	});
</script>
	