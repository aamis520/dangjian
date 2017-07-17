<div class="xe-widget xe-conversations">
	<div class="xe-header">
		<div class="xe-label">
			<h3>
				全部人员
			</h3>
		</div>
	</div>
	<div class="xe-body">
		<ul class="list-unstyled" id="showAllPersons">
			<li>
				<div class="row">
					<div class="col-sm-12">
						<div class="xe-comment-entry">
							<a href="#" class="xe-user-img">
								<!--<img src="assets/images/user-2.png" class="img-circle" width="40">-->
							</a>
							
						</div>
					</div>
					
				</div>
			</li>
		</ul>
		
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			type:"GET",
			url:"<?php echo getapiurl('getuserprofileapi'); ?>",
			dataType:"json",
			data:{
				live:1
			},
			success:function(res){
				res = eval(res);
				for (var i = 0; i < res.length ; i ++) {
					var tmp = i;
					var $html = "";
					(function(){
						var personname =  res[tmp].userrealname;
						var phonenumber = res[tmp].phonenumber;
						var appartment = res[tmp].appartment;
						var zhiwei = res[tmp].zhiwei;
						if(phonenumber == null){
							phonenumber = "";
						}
						if(appartment == null){
							appartment = "";
						}
						if(zhiwei == null){
							zhiwei = "";
						}
						var sex = res[tmp].sex;
						var personid = res[tmp].usrid;
			                $html += '<li>';
			                $html += '<div class="row">';
			                $html += '<div class="col-sm-12">'
			                $html += '<div class="xe-comment-entry">';
			                $html += '<a href="#" class="xe-user-img">';
//			                $html += '<img src="assets/images/user-2.png" class="img-circle" width="40">';
			                $html += '</a>';
			                $html += '<div class="xe-comment">';
			                $html += '<a href="#" class="xe-user-name">';
			                $html += '<strong>'+ personname +'</strong>';
			                $html += '　<i>'+ sex +'</i>';
			                $html += '</a>';
			                $html += '<p>联系方式：<i style="text-decoration: underline;">'+ phonenumber +'</i></p>';
			                $html += '<p>部门：<span>'+ appartment +'　</span>职位：<b>'+ zhiwei +'</b></p>';
			                $html += '<input type="hidden" value="';
			                $html += personid;
			                $html += '" />';
			                $html += '</div></div></div></div></li>';
			                
			                $("#showAllPersons").prepend($html);
					})(tmp);
				}
				
			},
			error:function(err){
				
			}
		});
		
	
	});
</script>
