<?php
?>
<link rel="stylesheet" type="text/css" href="assets/js/datatables/css/jquery.dataTables.min.css"/>
<div class="panel panel-default" id="groupDetail" style="position: relative;">
	<div class="panel-heading">
		<h3 class="panel-title"></h3>
		
		<button class="btn btn-blue pull-right" onclick="window.history.go(-1)">返回列表</button>
		<button class="btn btn-success pull-right" id="tianjiachengyuan" style="margin-right: 20px;">添加成员</button>
		<button type="button" id="cancelDel" class="btn btn-info pull-right" style="margin-right: 20px;display: none;" href="javascript:;">　取消删除　</button>
		<button type="button" id="delGroup" class="btn btn-danger pull-right" style="margin-right: 20px;" href="javascript:;">　删除成员　</button>
		<button type="button" id="setGroup" class="btn btn-blue pull-right" style="margin-right: 20px;" href="javascript:;">　群组设置　</button>
	</div>
	<div class="panel-body">
		<table id="groupmanage" class="display" cellpadding="0">
				<thead>
					<tr>
						<th></th>
						<th></th>
						<th style="width: 10%;"></th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<button class="btn btn-danger" id="dismissGroup">解散群组</button>
		</div>
	</div>
</div>
<script src="assets/js/datatables/js/jquery.dataTables.min.js"></script>
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
		var groupid = getUrlParam('groupid');
		//
		$('#setGroup').on('click',function(){
			window.location.href = "?page=groupSetting&groupid="+groupid;
		});
		//获取当前群组信息  通过groupID
		$.ajax({
			type:"GET",
			url:"<?php echo getapiurl('getusergroupinfoapi'); ?>",
			dataType:"json",
			data:{
				groupid:groupid
			},
			success:function(res){
				var data = eval(res);
				var usersChar = res[0].users;
				var fromusername = res[0].ownername;
				//字符串转成数组
				var users = usersChar.split(',');
				var len = users.length;
				var groupname = res[0].groupname;
				$('#groupDetail h3').text(groupname);
				var a1 = [];
				var a11= [];
				//展示群组信息
				$.ajax({
					type:"GEt",
					url:"<?php echo getapiurl('listgroupusersapi'); ?>",
					data:{
						//这里的参数需要是字符串
						users:usersChar
					},
					success:function(res){
						res = eval(res);
						//将users和data的数据组合成datatable需要的格式	
						var data =res.listgroupuser; 	
						for(var i=0;i<data.length;i++){
							var temp = i;
							for(var j=0;j<users.length;j++){
								var tmp = j;
								if(temp == tmp){
									a1.push(users[tmp],data[temp]);
									a11.push(a1);
									a1 = [];
								}
							}
						}	
						var oTable = $('#groupmanage').dataTable({
							"bDestroy": true,
							"bRetrieve": true,
							"bPaginate": true, //翻页功能
							"bLengthChange": false, //改变每页显示数据数量
							"bFilter": false, //过滤功能
							"bSort": false, //排序功能
							"bInfo": false, //页脚信息
							"bAutoWidth": true, //自动宽度
							"data":a11,
							"columns": [ //定义列数据来源
								{ 'title': 'userID' },
								{ 'title': '姓名'},
								{'title':''}
					
							],
							"columnDefs":[
								{
									"targets":0,
									"visible":false
								},
						        {
						            "targets": 2, //改写哪一列
						            "render":function(data, type, full){
						                var html = '<button data="'+full+'" class="btn btn-xs btn-danger delUser" style="display: none;cursor:pointer;font-size:12px;">　删除　</button>';
						                return html;
						            }
						        }
						    ],
							"oLanguage": {
								"sSearch": "搜索:",
								"sProcessing": "加载中...",
								"sLengthMenu": "每页显示 _MENU_ 条记录",
								"sZeroRecords": "没有匹配的结果",
								"sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
								"sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
								"sInfoFiltered": "从 _MAX_ 条数据中检索",
								"sLoadingRecords": "载入中...",
								"sEmptyTable": "表中数据为空",
								"oPaginate": {
									"sFirst": "首页",
									"sPrevious": "前一页",
									"sNext": "后一页",
									"sLast": "尾页"
								}
							},
						});
						//解散群组
						$('#dismissGroup').on('click',function(){
							$('#modal-dismiss').modal('show',{'backdrop':'static'});
							$('#confirmDelGroup').on('click',function(){
								$.ajax({
									type:"GET",
									url:"<?php echo getapiurl('delusergroupapi'); ?>",
									dataType:"json",
									data:{
										groupid:groupid
									},
									success:function(res){
										if(res && res.org == "删除成功"){
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
												toastr.success("删除群组成功","",opts);
					                        })();
											$('#modal-dismiss').modal('hide');
											setTimeout(function(){
									        	window.location.href = "?page=myTeamGroup";
									        },1500);
										}
									},
									error:function(err){
										console.log(err);
									}
								});
							});
						});
					}
				});
				//添加成员到群组的JS
				//页面开始的时候显示所有成员
				//当前用户后面的删除/添加按钮不显示
				$('#tianjiachengyuan').on('click',function(){
					$('#modal-addToGroup').modal('show',{backdrop:'static'});
					var myselfId = "<?php echo $_SESSION["userid"]; ?>";
					for (var j=0;j<$('#addProfile tr button').length;j++) {
						var tmp = j;
						if($('#addProfile tr button')[tmp].getAttribute('data').split(',')[3] == myselfId){
							$($('#addProfile tr button')[tmp]).hide();
						}
					}
				});
				//列出所有人员
				$.ajax({
					type:"GET",
					url:"<?php echo getapiurl('listalluserapi'); ?>",
					dataType:"json",
					data:{
						live:1
					},
					success:function(res){
						var data = eval(res.org);
						var colum = [];
						var colums = [];
						for(var i = 0 ; i < data.length ; i++){
							var temp = i;
							(function(){
								if(data[temp].userrealname ==""){
									data[temp].userrealname =" ";
								}
								if(data[temp].appartment ==""){
									data[temp].appartment =" ";
								}
								if(data[temp].zhiwei ==""){
									data[temp].zhiwei =" ";
								}
								if(data[temp].sex ==""){
									data[temp].sex =" ";
								}
								if(data[temp].email ==""){
									data[temp].email =" ";
								}
								if(data[temp].phonenumber ==""){
									data[temp].phonenumber =" ";
								}
								colum.push(
									data[temp].userrealname,
									data[temp].appartment,
									data[temp].sex,
									data[temp].usrid,
									''
								);
							})(temp);
							colums.push(colum);
							colum = [];
						}
						//start 添加人员的表格
						$('#addProfile').dataTable().fnDestroy();
						oTable = $('#addProfile').dataTable({
							"bDestroy": true,
							"bRetrieve": true,
							"bPaginate": false, //翻页功能
							"bLengthChange": false, //改变每页显示数据数量
							"bFilter": false, //过滤功能
							"bSort": false, //排序功能
							"bInfo": false, //页脚信息
							"bAutoWidth": false, //自动宽度
							"data":colums,
							"columns": [ //定义列数据来源
								{ 'title': '姓名' },
								{ 'title': '部门' },
								{ 'title': '性别'},
								{'title':''},
								{'title':'操作'}
								
							],
							"columnDefs":[
								{
									"targets":3,
									"visible":false
								},
						        {
						            "targets": 4, //改写哪一列
						            "render":function(data, type, full){
						                var html = '<button data="'+full+'" class="btn btn-xs btn-success addUser" style="cursor:pointer;font-size:12px;">添加</button>';
						                return html;
						            }
						        }
						    ],
							"oLanguage": {
								"sSearch": "搜索:",
								"sProcessing": "加载中...",
								"sLengthMenu": "每页显示 _MENU_ 条记录",
								"sZeroRecords": "没有匹配的结果",
								"sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
								"sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
								"sInfoFiltered": "从 _MAX_ 条数据中检索",
								"sLoadingRecords": "载入中...",
								"sEmptyTable": "表中数据为空",
								"oPaginate": {
									"sFirst": "",
									"sPrevious": "",
									"sNext": "",
									"sLast": ""
								}
							}
						});
						//查找当前群组信息
						//加进群组
						$('.addUser').on('click',function(){
							var groupInfo = $(this).attr('data').split(',');
//							console.log(groupInfo);
							var usrid = groupInfo[3];
							var $self = $(this);
							users.push(usrid);
							//数组去重
							$.unique(users);  
							//更新群组users
							//将数组转换成字符串存到表里
							var ss = users.join(',');
							$.ajax({
								type:"GET",
								url:"<?php echo getapiurl('addusertogroupapi'); ?>",
								dataType:"json",
								data:{
									groupid:groupid,
									users:ss
								},
								success:function(res){
									//加人进群组--发送通知
									var notifyContent = groupname;
									$.ajax({
										type:"GET",
										url:"<?php echo getapiurl('createmessageapi'); ?>",
										dataType:"json",
										data:{
											userid:"<?php echo $_SESSION["userid"]; ?>",//发送消息的人
											touserid:usrid,//接收消息的人
											username:fromusername,//发送消息的人名
											notifytype:"system-addgroup",//消息类型
											isagree:1,
											topiccontext:notifyContent
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
												toastr.success("添加人员成功","",opts);
					                        })();
											$self.parents('tr').remove();
										},
										error:function(err){
											console.log(err);
										}
									});
									//提示
									
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
										toastr.error("添加人员失败","",opts);
			                        })();
			                        setTimeout(function(){
			                        	$('#modal-addToGroup').modal('hide');
			                        },1000);
								}
							});
						});
						
						//删除群组的成员
						$('#delGroup').on('click',function(){
							$('#groupmanage button').show('slow');
							//找到与群主相关的行  让删除按钮隐藏
							var myselfId = "<?php echo $_SESSION["userid"]; ?>";
							for (var i=0;i<$('#groupmanage tr button').length;i++) {
								var temp = i;
								if($('#groupmanage tr button')[temp].getAttribute('data').split(',')[0] == myselfId){
									$($('#groupmanage tr button')[temp]).hide();
								}
							}
							
							$(this).hide('slow');
							$('#cancelDel').show('slow');
							$('.delUser').on('click',function(){
								var usrid = $(this).attr('data').split(',')[0];
								console.log(usrid);
								console.log(users);
								
								//获取点击的usrid
								//从users里面匹配 然后删除
								users.splice($.inArray(usrid,users),1);
								//数组去重
								$.unique(users); 
								var ss = users.join(',');
								var $self = $(this);
								$.ajax({
									type:"GET",
									url:"<?php echo getapiurl('addusertogroupapi'); ?>",
									dataType:"json",
									data:{
										groupid:groupid,
										users:ss
									},
									success:function(res){
										var notifyContent = groupname;
										//从群组里面删除人员  给被删除人发送通知
										$.ajax({
											type:"GET",
											url:"<?php echo getapiurl('createmessageapi'); ?>",
											dataType:"json",
											data:{
												userid:"<?php echo $_SESSION["userid"]; ?>",//发送消息的人
												touserid:usrid,//接收消息的人
												username:fromusername,//发送消息的人名
												notifytype:"system-addgroup",//消息类型
												isagree:0,
												topiccontext:notifyContent
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
													toastr.success("删除人员成功","",opts);
						                        })();
												$self.parents('tr').remove();
												setTimeout(function(){
//													window.location.reload();
												},1000);
											},
											error:function(err){
												console.log(err);
											}
										});
									}
								});
								
							});
						});
					},
					error:function(err){
						
					}
				});
			},
			error:function(err){
				
			}
		});
		//取消删除
		$('#cancelDel').on('click',function(){
			$('#groupmanage button').hide('slow');
			$(this).hide('slow');
			$('#delGroup').show('slow');
		});
		
		//关闭添加人员进群组的 模态框的时候  刷新页面
		//先判断 模态框 显示的情况下 点击body  模态框消失   并且刷新
		//todo
		//点击关闭按钮时候  模态框消失  并且刷新
		$('#closeModal').on('click',function(){
			$('#modal-addToGroup').modal('hide');
			window.location.reload() ;
		});
	});
</script>
