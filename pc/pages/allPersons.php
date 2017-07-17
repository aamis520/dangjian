<?php
?>
<link rel="stylesheet" type="text/css" href="assets/js/datatables/css/jquery.dataTables.min.css"/>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">全部成员</h3>
	</div>
	<div class="panel-body">
		<div id="example-1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
			<table id="allpersons" class="display" cellpadding="0">
				<thead>
					<tr>
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
<script src="assets/js/datatables/js/jquery.dataTables.min.js"></script>
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
				var data = eval(res);
				var colum = [];
				var colums = [];
				for(var i = 0 ; i < data.length ; i++){
					var temp = i;
					(function(){
						if(!data[temp].userrealname || data[temp].userrealname ==""){
							data[temp].userrealname =" ";
						}
						if(!data[temp].appartment || data[temp].appartment ==""){
							data[temp].appartment =" ";
						}
						if(!data[temp].zhiwei || data[temp].zhiwei ==""){
							data[temp].zhiwei =" ";
						}
						if(!data[temp].phonenumber || data[temp].phonenumber ==""){
							data[temp].phonenumber =" ";
						}
						colum.push(
							data[temp].userrealname,
							data[temp].appartment,
							data[temp].zhiwei,
							data[temp].phonenumber
						);
					})(temp);
					colums.push(colum);
					colum = [];
				}
				//start
				var oTable = $('#allpersons').dataTable({
					"bDestroy": true,
					"bRetrieve": true,
					"bLengthChange": false, //改变每页显示数据数量
					"bFilter": false, //过滤功能
					"bSort": false, //排序功能
					"bInfo": true, //页脚信息
					"bAutoWidth": true, //自动宽度
					"bPaginate": true, //翻页功能
					"bProcessing":true,
//					"bLengthChange":true,//是否显示一个每页长度的选择条
					"data":colums,
					"columns": [ //定义列数据来源
						{ 'title': '姓名' },
						{ 'title': '部门' },
						{ 'title': '职位' },
						{ 'title': '电话号码'}
			
					],
					"aaSorting": [[ 1, "desc" ]],  
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
				
			},
			error:function(err){
				
			}
		});
		
	
	});
</script>
