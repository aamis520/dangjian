<div class="wrap">
	<h2><?php printf(__("培训列表", 'watu'), __('Quizzes', 'watu')); ?></h2>
	
		<div class="postbox-container" style="width:73%;margin-right:2%;">

		<a href="admin.php?page=watu_exam&amp;action=new"><?php _e("创建新培训", 'watu')?></a>

		<table class="widefat">
			<thead>
			<tr>
				<th scope="col"><div style="text-align: center;"><?php _e('ID', 'watu') ?></div></th>
				<th scope="col"><?php _e('标题', 'watu') ?></th>
				<th scope="col"><?php _e('短代码', 'watu') ?></th>
				<th scope="col"><?php _e('问题数量', 'watu') ?></th>
				<th scope="col"><?php _e('培训情况', 'watu') ?></th>
				<th scope="col" colspan="3"><?php _e('管理', 'watu') ?></th>
			</tr>
			</thead>
		
			<tbody id="the-list">
		<?php
		if(count($exams)):
			foreach($exams as $quiz):
				$class = ('alternate' == @$class) ? '' : 'alternate';
		
				print "<tr id='quiz-{$quiz->ID}' class='$class'>\n";
				?>
				<th scope="row" style="text-align: center;"><?php echo $quiz->ID ?></th>
				<td><?php if(!empty($quiz->post)) echo "<a href='".get_permalink($quiz->post->ID)."' target='_blank'>"; 
				echo stripslashes($quiz->name);
				if(!empty($quiz->post)) echo "</a>";?></td>
        <td><input type="text" size="8" readonly onclick="this.select()" value="[WATU <?php echo $quiz->ID ?>]"></td>
                <td><?php echo $quiz->question_count ?></td>
				<td><a href="admin.php?page=watu_takings&exam_id=<?php echo $quiz->ID?>"><?php printf(__('参加 %d 次', 'watu'), $quiz->taken)?></a></td>
				<td><a href='admin.php?page=watu_questions&amp;quiz=<?php echo $quiz->ID?>' class='edit'><?php _e('培训问题管理', 'watu')?></a><br>
				<a href='admin.php?page=watu_grades&amp;quiz_id=<?php echo $quiz->ID?>' class='edit'><?php _e('考核结果设置', 'watu')?></a></td>
				<td><a href='admin.php?page=watu_exam&amp;quiz=<?php echo $quiz->ID?>&amp;action=edit' class='edit'><?php _e('编辑', 'watu'); ?></a></td>
				<td><a href="<?php echo wp_nonce_url('admin.php?page=watu_exams&amp;action=delete&amp;quiz='.$quiz->ID, 'watu_exams');?>" class='delete' onclick="return confirm('<?php echo  addslashes(__("确定要删除", 'watu'))?>');"><?php _e('删除', 'watu')?></a></td>
				</tr>
		<?php endforeach;
			else:?>
			<tr>
				<td colspan="5"><?php _e('没有培训', 'watu') ?></td>
			</tr>
		<?php endif;?>
			</tbody>
		</table>
		
			<p><a href="admin.php?page=watu_exam&amp;action=new"><?php _e("创建新培训", 'watu')?></a></p>
			
		</div>
		<div id="watu-sidebar">
				<?php include(WATU_PATH."/views/sidebar.php");?>
		</div>
	</div>	