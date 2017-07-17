<div class="wrap">
    <div class="postbox-container" style="min-width:60%;margin-right:2%;">
        <h1><?php printf(__("Manage Grading for Quiz '%s'", 'watu'), $quiz->name); ?></h1>
        <p><a href="admin.php?page=watu_exams"><?php _e('Back to quizzes list', 'watu') ?></a> |
            <a href="admin.php?page=watu_questions&quiz=<?php echo $quiz->ID ?>"><?php _e('Manage Questions', 'watu') ?></a>
            |
            <a href="admin.php?page=watu_exam&quiz=<?php echo $quiz->ID ?>&action=edit"><?php _e('Edit quiz', 'watu') ?></a>
        </p>

        <?php if (sizeof($grades)): ?>
            <h2><?php _e('编辑结果显示', 'watu') ?></h2>

            <?php foreach ($grades as $grade): ?>
                <form method="post" onsubmit="return validateWatuGrade(this);">
                    <div class="postbox inside watu-padded">
                        <p><label><?php _e('结果标题:', 'watu') ?></label> <input type='text' name='gtitle'
                                                                              value="<?php echo stripslashes($grade->gtitle) ?>"
                                                                              size="30"/><br/><label><?php _e('描述:（可选）', 'watu') ?></label><br/><?php wp_editor(stripslashes($grade->gdescription), 'gdesc' . $grade->ID) ?>
                            <br/><label><?php _e('起点分数:', 'watu') ?> <input type='text' class='numeric'
                                                                            name='gfrom' size="4"
                                                                            value="<?php echo $grade->gfrom ?>"/></label><label><?php _e('终点分数', 'watu') ?>
                                <input type='text' class='numeric' name='gto' size="4"
                                       value="<?php echo $grade->gto ?>"/></label>
                        <p><label><?php _e('如果达到，重定向到下面的URL:（比如列表页）', 'watu') ?></label>
                            <input type="text" name="redirect_url" size="60" value="<?php echo $grade->redirect_url ?>">
                        </p>
                        <input type="submit" name="save" value="<?php _e('Save grade', 'watu') ?>">
                    </div>
                    <input type="hidden" name="id" value="<?php echo $grade->ID ?>">
                    <input type="hidden" name="del" value="0">
                    <?php wp_nonce_field('watu_grades'); ?>
                </form>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div id="watu-sidebar">
        <?php include(WATU_PATH . "/views/sidebar.php"); ?>
    </div>
</div>

<script type="text/javascript">
    function validateWatuGrade(frm) {
        if (frm.gtitle.value == '') {
            alert("<?php _e('Please enter grade title', 'watu')?>");
            frm.gtitle.focus();
            return false;
        }

        if (frm.gfrom.value == '' || isNaN(frm.gfrom.value)) {
            alert("<?php _e('Please enter From points, numbers only', 'watu')?>");
            frm.gfrom.focus();
            return false;
        }

        if (frm.gto.value == '' || isNaN(frm.gto.value)) {
            alert("<?php _e('Please enter To points, numbers only', 'watu')?>");
            frm.gto.focus();
            return false;
        }

        return true;
    }

    function watuConfirmDelGrade(frm) {
        if (confirm("<?php _e('Are you sure?', 'watu')?>")) {
            frm.del.value = 1;
            frm.submit();
        }
    }
</script>