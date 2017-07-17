<?php
global $mysqlDB;
$testresults = [];
if (isset($_GET['exam_id'])){
    require_once("./functions/mysql.php");
    $kaohename = $mysqlDB->field('*')->where("ID=".$_GET['exam_id'])->select('dangjian_watu_master')[0]['name'];
    $testresults = $mysqlDB->field('*')->where("exam_id=".$_GET['exam_id'])->select('dangjian_watu_takings');
}

?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">课程考核详情</h3>
	</div>
	<div class="panel-body">
			<table id="example-1" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="example-1_info" style="width: 100%;" width="100%" cellspacing="0">
				<thead>
					<tr role="row">
						<th> 课程名称</th>
						<th>姓名</th>
						<th>得分</th>
						<th>考核情况</th>
					</tr>
				</thead>
				<tfoot>

                <tr>
						<th >课程名称</th>
						<th >姓名</th>
						<th >得分</th>
						<th >考核情况</th>
					</tr>
				</tfoot>

				<tbody>
                    <?php foreach ($testresults as $testresult){
                        $usernames = $mysqlDB->field('user_login, user_nicename, display_name')->where("ID=".$testresult['user_id'])->select('dangjian_users')[0];
                        if($usernames['display_name'] != ""){
                            $username = $usernames['display_name'];
                        } else if($usernames['user_nicename'] != ""){
                            $username = $usernames['user_nicename'];
                        } else {
                            $username = $usernames['user_login'];
                        }
                        ?>
                    <tr role="row" class="odd">
						<td><?php echo $kaohename ?></td>
						<td><?php echo $username ?></td>
						<td><?php echo $testresult['points'];?></td>
						<td><?php if(intval($testresult['points'])>=60) {echo "通过";} else {echo "未通过";};?></td>
					</tr>
                    <?php }?>
				</tbody>
			</table>
		</div>
	</div>
</div>
