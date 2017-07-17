<div class="xe-widget xe-conversations">
	<div class="xe-header">
		<div class="xe-label">
			<h3>
				我的申请
			</h3>
		</div>
	</div>
	<div class="xe-body">
		<div class="row">
			<ul class="list-unstyled col-sm-12" id="showMyApprovalList">
				
			</ul>
		</div>
		
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		//显示我的申请
		$.ajax({
			type:"GET",
			url:"<?php echo getapiurl('listallmyserviceapi') ?>",
			dataType:"json",
			data:{
				fromusrid:"<?php echo $_SESSION["userid"]; ?>",
				radom:parseInt(10000*Math.random())
			},
			success:function(res){
				//设置显示的申请信息
				res = eval(res.org);
				//申请类型 申请时间  状态
				
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
						var totype = "";
						if(touser == "dangyuanapprover"){
							totype ="申请正式党员";
						}
						if(touser == "yubeiapprover"){
							totype ="申请预备党员";
						}
						if(touser == "jijiapprover"){
							totype ="申请积极分子";
						}
			                $html += '<li><div class="row"><div class="col-sm-12">';
			                $html += '<div class="xe-comment-entry"><div class="xe-comment">';
			                $html += '<button class="btn btn-xs btn-success pull-right" onclick="window.location.href =';
			                $html += "'?page=myProvalDetail&touser=";
			                $html += touser +	"&fromusrid=" + fromusrid + "'";
			                $html += ';">　详　情　</button>';
			                $html += '<input type="hidden" value="" />';
			                $html += '<p><span>'+provalname+'</span>的申请</p>';
			                $html += '<p>申请时间：<b>'+ creatTime +'</b></p>';
			                $html += '<p>申请类型：<span>'+ totype +'</span></p>'
			                $html += '<p>申请状态：<span>'+ provalstatus +'</span></p>'
			                $html += '</div></div></div></div></li>';
			                $("#showMyApprovalList").prepend($html);
					})(tmp);
				}
			}
		});
		
	});
</script>
	