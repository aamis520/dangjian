<link rel="stylesheet" href="assets/js/uikit/uikit.css">
<link rel="stylesheet" type="text/css" href="assets/js/datatables/css/jquery.dataTables.min.css"/>
<div class="row">
	<div class="col-sm-12">
		<!-- /.navbar-collapse -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">相应的组织人员</h3>
			</div>
			<div class="panel-body">
				<div id="example-1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
					<div class="row">
						<div class="col-xs-6">

						</div>
						<div class="col-xs-6">
							<div id="example-2_filter" class="dataTables_filter ">
								<div class="form-group pull-right">
									<button type="button" id="cancelDel" class="btn btn-blue" href="javascript:;" style="display: none;">　取消删除　</button>
									<!--<button type="button" id="confirmDel" class="btn btn-danger" href="javascript:;" style="display: none;">　确定删除　</button>-->
									<button type="button" id="delGroup" class="btn btn-danger" href="javascript:;">　删除成员　</button>
									<button type="button" class="btn  btn-success" href="javascript:;"
									onclick="jQuery('#modal-2').modal('show',{backdrop:'static'})">　添加成员　</button>
								</div>
							</div>
						</div>
					</div>

					<table id="userprofile" class="display" cellpadding="0">
						<thead>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
					
			</div>
		</div>

	</div>
</div>

<script src="assets/js/uikit/js/uikit.min.js"></script>
<script src="assets/js/uikit/js/addons/nestable.min.js"></script>
<script src="assets/js/datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		//添加人员
		//radio   赋值
		$('#sex label').on('click',function(){
			$('#sex').attr('name',$(this).children('input').val());
		})
		$('#save').on('click',function(){
			//判断不得为空  todo
			if($('#field-1').val() == ""){
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
					toastr.error("姓名不得为空","",opts);
                })();
                return false;
			}
			if($('#field-2').val() == ""){
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
					toastr.error("手机号码不得为空","",opts);
                })();
                return false;
			}
			if($('#field-3').val() == ""){
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
					toastr.error("请输入您所在的部门","",opts);
                })();
                return false;
			}
			if($('#field-4').val() == ""){
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
					toastr.error("请输入您的职位","",opts);
                })();
                return false;
			}
			//创建新用户
            $.ajax({
                url:"<?php echo getapiurl('createuserapi')?>",
                dataType:'json',
                type:"get",
                data:{
                    ownerid:"<?php echo $_SESSION["userid"]?>",
                    userrealname:$('#field-1').val(),
                    userloginname:$('#field-2').val(),
                    phonenumber:$('#field-2').val(),
                    sex:$('#sex').attr('name'),
                    appartment:$('#field-3').val(),
                    zhiwei:$('#field-4').val(),
                    live:1
                },
                success:function (res) {
                    if(res){
                    	$('#modal-2').modal('hide');
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
							toastr.success("添加用户成功","",opts);
		                })();
                    	setTimeout(function(){
	                    	window.location.reload();
                    		
                    	},1000);
                    }
                },
                error:function (err) {
					if(err){
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
							toastr.error("该用户已经注册","",opts);
		                })();
		                $('#modal-2').modal('hide');
//                  	setTimeout(function(){
//	                    	window.location.reload();
//                  		
//                  	},1500);
					}
                }
                

            })
			
        });
		//页面开始的时候显示所有成员
		$.ajax({
			type:"GET",
			url:"<?php echo getapiurl('listalluserapi'); ?>",
			dataType:"json",
			data:{
				live:1,
				radom:parseInt(10000*Math.random())
			},
			success:function(res){
				var data = eval(res.org);
//				console.log(res);
				var colum = [];
				var colums = [];
				for(var i = 0 ; i < data.length ; i++){
					var temp = i;
					(function(){
						if(!data[temp].userrealname|| data[temp].userrealname ==""){
							data[temp].userrealname =" ";
						}
						if(!data[temp].appartment || data[temp].appartment ==""){
							data[temp].appartment =" ";
						}
						if(!data[temp].zhiwei || data[temp].zhiwei ==""){
							data[temp].zhiwei =" ";
						}
						if(!data[temp].sex || data[temp].sex ==""){
							data[temp].sex =" ";
						}
						if(!data[temp].email || data[temp].email ==""){
							data[temp].email =" ";
						}
						if(!data[temp].phonenumber || data[temp].phonenumber ==""){
							data[temp].phonenumber =" ";
						}
						colum.push(
							data[temp].userrealname,
							data[temp].appartment,
							data[temp].zhiwei,
							data[temp].sex,
							data[temp].email,
							data[temp].phonenumber,
							data[temp].usrid,
							'',
							''
						);
					})(temp);
					colums.push(colum);
					colum = [];
				}
				//start
				$('#userprofile').dataTable().fnDestroy();
				oTable = $('#userprofile').dataTable({
					"bDestroy": true,
					"bRetrieve": true,
					"bPaginate": false, //翻页功能
					"bLengthChange": false, //改变每页显示数据数量
					"bFilter": false, //过滤功能
					"bSort": false, //排序功能
					"bInfo": true, //页脚信息
					"bAutoWidth": false, //自动宽度
					"data":colums,
					"columns": [ //定义列数据来源
						{ 'title': '姓名' },
						{ 'title': '部门' },
						{ 'title': '职位' },
						{ 'title': '性别'},
						{ 'title': '邮箱'},
						{ 'title': '联系方式'},
						{'title':'id'},
						{'title':'删除'},
						{'title':'操作'}
						
					],
					"columnDefs":[
						{
							"targets":6,
							"visible":false
						},
				        {
				            "targets": 7, //改写哪一列
				            "render":function(data, type, full){
				                var html = '<button data="'+full+'" class="btn btn-xs btn-danger delUser" style="display: none;cursor:pointer;font-size:12px;">删除</button>';
				                return html;
				            }
				        },
				        {
				            "targets": 8, //改写哪一列
				            "render":function(data, type, full){
				                var html = '<button data="'+full+'" class="btn btn-xs btn-blue resetPass" style="cursor:pointer;font-size:12px;">重置密码</button>';
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
					}
				});
				
				//end
				//重置密码
				$('.resetPass').on('click',function(){
					var usrid = $(this).attr('data').split(',')[6];
					$.ajax({
						type:"GET",
						url:"<?php echo getapiurl('chongzhipasswordapi'); ?>",
						dataType:"json",
						data:{
							customerid:"<?php echo $_SESSION["userid"]; ?>",
							usrid:usrid
						},
						success:function(res){
							if(res.org == "密码重置成功"){
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
									toastr.success("密码重置成功","",opts);
								})();
								
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
									"timeout":"3000",
									"extndedTimeout":"1000",
									"showEasing":"swing",
									"showMethod":"fadeIn",
							        "hideMethod":"fadeOut"
								};
								toastr.error(err,"",opts);
							})();
						}
					});
				})
				
			},
			error:function(err){
				
			}
		});
		//删除人员
		$('#delGroup').on('click',function(){
			$('#userprofile .delUser').show('slow');
			//找到与登陆用户相关的行  让删除按钮隐藏
			var myselfId = "<?php echo $_SESSION["userid"]; ?>";
			for (var i=0;i<$('#userprofile tr .delUser').length;i++) {
				var temp = i;
				if($('#userprofile tr .delUser')[temp].getAttribute('data').split(',')[6] == myselfId){
					$($('#userprofile tr .delUser')[temp]).hide();
				}
			}
			$(this).hide('slow');
			$('#cancelDel').show('slow');
			//删除人员  只是从user表里面删除  userprofile  和 usergroup  里面的人员相关的不删除
			$('.delUser').on('click',function(){
				var usrid = $(this).attr('data').split(',')[6];
				var $self = $(this);
				$.ajax({
					type:"GET",
					url:"<?php echo getapiurl('deluserapi'); ?>",
					dataType:"json",
					data:{
						userid:usrid,
						live:0,
					},
					success:function(res){
						if(res){
							//获得当前用户所在群组的群组 id
	                        //删除当前用户所在群组的 用户id
//							$.ajax({
//								type:"GET",
//								url:"<?php //echo getapiurl('deluserfromgroupapi'); ?>",
//								dataType:"json",
//								data:{
//									usrid:usrid
//								},
//								success:function(res){
//									if(res){
//										console.log(res);
//									}
//								}
//							});
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
		                    	window.location.reload();
	                    		
	                    	},1000);	
						}
					}
				});
				
			});
		});
		
		$('#cancelDel').on('click',function(){
			$('#userprofile .delUser').hide('slow');
			$(this).hide('slow');
			$('#delGroup').show('slow');
		});
		
		
	});
	
</script>

