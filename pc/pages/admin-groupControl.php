<link rel="stylesheet" type="text/css" href="assets/js/datatables/css/jquery.dataTables.min.css"/>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">群组管理</h3>
	</div>
	<div class="panel-body">
		<div id="example-1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
			<div class="row">
				
				
				<div class="col-xs-12">
					<div id="example-2_filter" class="dataTables_filter pull-right">
						<div class="form-group">
							<!--<a href="javascript:;" type="button" class="btn  btn-blue">　　删除群组　　</a>-->
							<a href="?page=admin-creatGroup" type="submit" class="btn  btn-success">　　创建群组　　</a>
							
						</div>
					</div>
				</div>
			</div>
			
			
			<table id="groupmanage" class="display" cellpadding="0">
				<thead>
					<tr>
						<th></th>
						<th style="width: 40%;"></th>
						<th></th>
						<th></th>
						<th></th>
						<th style="width: 6%;"></th>
						<th style="width: 6%;"></th>
						<th style="width: 4%;"></th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>
<script src="assets/js/datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			type:"GET",
			url:"<?php echo getapiurl('listallgroupapi'); ?>",
			data:{
				radom:parseInt(10000*Math.random())
			},
			dataType:"json",
			success:function(res){
				var data = eval(res.org);
				var colum = [];
				var colums = [];
				for(var i = 0 ; i < data.length ; i++){
					var len = 0;
					var temp = i;
					(function(){
						if(data[temp].groupname ==""){
							data[temp].groupname =" ";
						}
						if(data[temp].description ==""){
							data[temp].description =" ";
						}
						if(data[temp].createdAt ==""){
							data[temp].createdAt =" ";
						}
						if(data[temp].users == null){
							data[temp].users = " ";
						}
						var newarray = data[temp].users.split(',');
						len = newarray.length;
						colum.push(
							data[temp].groupname,
							data[temp].description,
							data[temp].createdAt.substring(0,10),
							data[temp].groupid,
							len,
							'',
							'',
							''
						);
					})(temp);
					colums.push(colum);
					colum = [];
				}
				//start
				var oTable = $('#groupmanage').dataTable({
					"bDestroy": true,
					"bRetrieve": true,
					"bPaginate": false, //翻页功能
					"bLengthChange": false, //改变每页显示数据数量
					"bFilter": false, //过滤功能
					"bSort": true, //排序功能
					"bInfo": true, //页脚信息
					"bAutoWidth": false, //自动宽度
					"data":colums,
					"columns": [ //定义列数据来源
						{ 'title': '群名称' },
						{ 'title': '描述' },
						{ 'title': '创建时间'},
						{'title':' '},
						{'title':'群组人数'},
						{'title':''},
						{'title':''},
						{'title':''}
					],
					"columnDefs":[
						{
							"targets":3,
							"visible":false
						},
				        {
				            "targets": 5, //改写哪一列
				            "render":function(data, type, full){
				                var html = '<button data="'+full+'" class="btn btn-xs btn-blue groupSetting" style="cursor:pointer;font-size:12px;">　群组设置　</button>';
				                return html;
				            }
				        },
				        {
				            "targets": 6, //改写哪一列
				            "render":function(data, type, full){
				                var html = '<button data="'+full+'" class="btn btn-xs btn-blue tianjiachengyuan" style="cursor:pointer;font-size:12px;">　添加人员　</button>';
				                return html;
				            }
				        },
				        {
				            "targets": 7, //改写哪一列
				            "render":function(data, type, full){
				                var html = '<button data="'+full+'" class="btn btn-xs btn-danger delGroup" style="cursor:pointer;font-size:12px;">　删除　</button>';
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
					"initComplete": function(){
						
					}
				});
				//群组设置
				$('.groupSetting').on('click',function(){
					var data = $(this).attr('data').split(',');
					var len = data.length;
					var groupid = data[len-5];
					window.location.href = "?page=admin-groupSetting&groupid="+groupid;
				});
				//删除群组
				$('.delGroup').on('click',function(){
					var data = $(this).attr('data').split(',');
					var len = data.length;
					var groupid = data[len-5];
					$.ajax({
						type:"GET",
						url:"<?php echo getapiurl('delusergroupapi'); ?>",
						dataType:"json",
						data:{
							groupid:groupid
						},
						success:function(res){
							if(res.org == "删除成功"){
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
									toastr.success("删除成功","",opts);
								})();
								setTimeout(function(){
									window.location.reload();
								},1500);
							}
						},
						error:function(err){
							console.log(err);
						}
					});
				});
				
				
				
				//添加成员到群组的JS
				//页面开始的时候显示所有成员
				//当前用户后面的删除/添加按钮不显示
				$('.tianjiachengyuan').on('click',function(){
					var data = $(this).attr('data').split(',');
					var len = data.length;
					var groupid = data[len-5];
					var groupname = data[0];
					$.ajax({
						type:"GET",
						url:"<?php echo getapiurl('listonemygroupapi'); ?>",
						dataType:"json",
						data:{
							groupid:groupid,
							radom:parseInt(10000*Math.random())
						},
						success:function(res){
							var data = eval(res.org);
							var usersChar = data[0].users;
							var fromusername = data[0].ownername;
							//字符串转成数组
							var users = usersChar.split(',');
							$('#modal-addToGroup').modal('show',{backdrop:'static'});
							var myselfId = "<?php echo $_SESSION["userid"]; ?>";
							
							$.ajax({
								type:"GET",
								url:"<?php echo getapiurl('listalluserapi'); ?>",
								dataType:"json",
								data:{
									radom:parseInt(10000*Math.random()),
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
									//隐藏自身之后的按钮
									for (var j=0;j<$('#addProfile tr button').length;j++) {
										var tmp = j;
										if($('#addProfile tr button')[tmp].getAttribute('data').split(',')[3] == myselfId){
											$($('#addProfile tr button')[tmp]).hide();
										}
									}
									//查找当前群组信息
									//加进群组
									$('.addUser').on('click',function(){
										var usrid = $(this).attr('data').split(',')[3];
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
												var notifyContent = groupname;
												//发送通知
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
								},
								error:function(err){
									
								}
							});
						//列出所有人员
						
								
							
						
						},
						error:function(err){
							
						}
					});
				});

				
			},
			error:function(err){
				console.log(err);
			}
		});
		$('#closeModal').on('click',function(){
			$('#modal-addToGroup').modal('hide');
			location.reload() ;
		});
		
	});
</script>
