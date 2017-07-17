<div class="xe-widget xe-conversations">
	<div class="xe-header">
		<div class="xe-label">
			<h3>
				入党审批
			</h3>
		</div>
	</div>
	<div class="xe-body">
		<div class="row">
			<ul class="list-unstyled col-sm-12" id="showMyApproval">
				
			</ul>
		</div>
		
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			type:"GET",
			url:"<?php echo getapiurl('getuserprofileapi') ?>",
			dataType:"json",
			data:{
				usrid:"<?php echo $_SESSION["userid"]?>",
				live:1
			},
			success:function(res){
				var touser = res[0].capability;
				if(res[0].capability && res[0].capability != "" && res[0].capability != null){
					$.ajax({
						type:"GET",
						url:"<?php echo getapiurl('getotherserviceflowapi') ?>",
						dataType:"json",
						data:{
							tousrid:"<?php echo $_SESSION["userid"]; ?>",
							touser:touser,
							radom:parseInt(10000*Math.random())
						},
						success:function(data){
							//设置显示的申请信息
							res = eval(data.org);
							for (var i=0;i<res.length;i++) {
								//列出申请列表
								var tmp = i;
								var $html = "";
								(function(){
									var fromusrid = res[tmp].fromusrid;
									var provalname = res[tmp].provalname;
									var creatTime = res[tmp].updatedAt.substring(0,10);
									var touser = res[tmp].touser;
									var tousrid = res[tmp].tousrid;
									var provalstatus = res[tmp].provalstatus;
						                $html += '<li><div class="row"><div class="col-sm-12">';
						                $html += '<div class="xe-comment-entry"><div class="xe-comment">';
										$html += '<button class="btn btn-xs btn-success pull-right" onclick="window.location.href = ';
						                $html += "'?page=joinProval&touser= ";
						                $html +=  touser +	"&fromusrid=" + fromusrid + "'";
						                $html += ';">　详　情　</button>';					                
						                $html += '<input type="hidden" value="" />';
						                $html += '<p><span>'+provalname+'</span>的申请</p>';
						                $html += '<p>申请人：<span>'+ provalname +'</span> 　发布时间：<b>'+ creatTime +'</b></p>';
						                $html += '<p>申请状态：<span>'+ provalstatus +'</span></p>'
						                $html += '</div></div></div></div></li>';
					                $("#showMyApproval").prepend($html);
								})(tmp);
							}
						}
					});
				}else{
					
				}
				
			}
		});
		
	});
</script>
	