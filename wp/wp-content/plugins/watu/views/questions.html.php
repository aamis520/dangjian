<div class="wrap">
	<h2><?php echo __("您正在管理的是：", 'watu') . ' ' . $exam_name; ?></h2>
	
		<div class="postbox-container" style="min-width:60%;margin-right:2%;">
		
		<p>
            <a href="admin.php?page=watu_exams"><?php _e('回到问题列表', 'watu')?></a> &nbsp;
        </p>
		
		<?php
		wp_enqueue_script( 'listman' );
		wp_print_scripts();
		?>
		

		<table class="widefat">
			<thead>
			<tr>
				<th scope="col"><div style="text-align: center;">#</div></th>
				<th scope="col"><?php _e('问题', 'watu') ?></th>
				<th scope="col"><?php _e('问题类型', 'watu') ?></th>
				<th scope="col"><?php _e('是否必答', 'watu') ?></th>
				<th scope="col"><?php _e('答案数量', 'watu') ?></th>
				<th scope="col" colspan="3"><?php _e('操作', 'watu') ?></th>
			</tr>
			</thead>
		
			<tbody id="the-list">
		<?php
									
		
		if (count($all_question)) {
			$bgcolor = '';			
			$question_count = 0;
			foreach($all_question as $question) {
				$class = ('alternate' == @$class) ? '' : 'alternate';
				$question_count++;
				print "<tr id='question-{$question->ID}' class='$class'>\n";
				?>
				<td style="text-align: center;">
				<div style="float:left;<?php if(!empty($_POST['filter_cat_id'])) echo 'display:none;'?>">
				<?php if(($question_count+$offset)>1):?>
					<a href="admin.php?page=watu_questions&quiz=<?php echo $_GET['quiz']?>&move=<?php echo $question->ID?>&dir=up"><img src="<?php echo  WATU_URL.'/img/arrow-up.png'?>" alt="<?php _e('Move Up', 'watu')?>" border="0"></a>
				<?php else:?>&nbsp;<?php endif;?>
				<?php if(($question_count+$offset) < $num_questions):?>	
					<a href="admin.php?page=watu_questions&quiz=<?php echo $_GET['quiz']?>&move=<?php echo $question->ID?>&dir=down"><img src="<?php echo  WATU_URL.'/img/arrow-down.png'?>" alt="<?php _e('Move Down', 'watu')?>"></a>
				<?php else:?>&nbsp;<?php endif;?>
			</div>							
				<?php echo $question_count ?></td>
				<td><?php echo stripslashes($question->question) ?></td>
				<td><?php switch($question->answer_type):
					case 'radio': _e('单选', 'watu'); break;
					case 'checkbox': _e('多选', 'watu'); break;
					case 'textarea': _e('开放式问题', 'watu'); break;
				endswitch;?></td>
				<td><?php echo $question->is_required ? __('Yes', 'watu') : __('No', 'watu');?></td>
				<td><?php echo $question->answer_count ?></td>
				<td><a href='admin.php?page=watu_question&amp;question=<?php echo $question->ID?>&amp;action=edit&amp;quiz=<?php echo $_REQUEST['quiz']?>' class='edit'><?php _e('编辑', 'watu'); ?></a></td>
				<td><a href="<?php echo wp_nonce_url('admin.php?page=watu_questions&amp;action=delete&amp;question='.$question->ID.'&amp;quiz='.$_REQUEST['quiz'], 'watu_questions');?>" class='删除' onclick="return confirm('<?php echo addslashes(__("You are about to delete this question. This will delete the answers to this question. Press 'OK' to delete and 'Cancel' to stop.", 'watu'))?>');"><?php _e('Delete', 'watu')?></a></td>
				</tr>
		<?php
				}
			} else {
		?>
			<tr style='background-color: <?php echo @$bgcolor; ?>;'>
				<td colspan="4"><?php _e('No questions found.', 'watu') ?></td>
			</tr>
		<?php
		}
		?>
			</tbody>
		</table>
		
		<a href="admin.php?page=watu_question&amp;action=new&amp;quiz=<?php echo $_REQUEST['quiz'] ?>"><?php _e('创建新的问题', 'watu')?></a>
		</div>
		<div id="watu-sidebar">
				<?php include(WATU_PATH."/views/sidebar.php");?>
		</div>
	</div>