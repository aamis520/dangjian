<?php
require_once("./functions/mysql.php");
global $mysqlDB;
$kechengs = $mysqlDB->field('ID, name')->select('dangjian_watu_master');
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">学分统计</h3>
	</div>
	<div class="panel-body">
		<div id="example-1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
			<table id="example-1" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="example-1_info" style="width: 100%;" width="100%" cellspacing="0">
				<thead>
					<tr role="row">
						<th class="sorting_asc" tabindex="0" aria-controls="example-1" rowspan="1" colspan="1" style="width: 40%;" aria-sort="ascending" aria-label="Name: activate to sort column ascending">课程名称</th>
						<th class="sorting" tabindex="0" aria-controls="example-1" rowspan="1" colspan="1" style="width: 15%;" aria-label="Position: activate to sort column ascending">考核人数</th>
						<th class="" tabindex="0" aria-controls="example-1" rowspan="1" colspan="1" style="width: 15%;" aria-label="Position: activate to sort column ascending">通过人数</th>
						<th class="" tabindex="0" aria-controls="example-1" rowspan="1" colspan="1" style="width: 10%;" aria-label="Office: activate to sort column ascending">通过率</th>
						<th class="" tabindex="0" aria-controls="example-1" rowspan="1" colspan="1" style="width: 20%;" aria-label="Office: activate to sort column ascending">详情</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th rowspan="1" colspan="1">课程名称</th>
						<th rowspan="1" colspan="1">考核人数</th>
						<th rowspan="1" colspan="1">通过人数</th>
						<th rowspan="1" colspan="1">通过率</th>
						<th rowspan="1" colspan="1">详情</th>
					</tr>
				</tfoot>

				<tbody>
                <?php foreach ($kechengs as $kecheng){
                    $results = $mysqlDB->doSql("SELECT count(*) FROM dangjian_watu_takings WHERE exam_id = ".$kecheng["ID"]." GROUP BY user_id");
                    $total = sizeof($results);
                    $results = $mysqlDB->doSql("SELECT count(*) FROM dangjian_watu_takings WHERE exam_id = ".$kecheng["ID"]." AND points >= 60 GROUP BY user_id");
                    $passed = sizeof($results);
                    ?>
					<tr role="row" class="odd">
						<td class="sorting_1"><?php echo $kecheng['name'];?></td>
						<td><?php echo $total;?></td>
						<td><?php echo $passed;?></td>
						<td><?php if (intval($total) == 0){ echo "0";}else {echo intval($passed/$total*100).'%';}?></td>
						<td style="text-align: center;">
							<a href=<?php echo "?page=admin-classTestDetail&exam_id=".$kecheng['ID']?> class="btn btn-xs btn-info">查看详情</a>
						</td>
					</tr>
                <?php }?>
				</tbody>
			</table>
</div>
<script src="assets/js/datatables/js/jquery.dataTables.min.js"></script>
