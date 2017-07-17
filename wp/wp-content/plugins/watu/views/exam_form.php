<script type="text/javascript">
    function validate() {
        var ret = true;
        return ret;
    }
</script>

<div class="wrap">
    <h2><?php _e(ucfirst($action) . " Quiz", 'watu'); ?></h2>

    <div class="postbox-container" style="min-width:60%;max-width:70%;margin-right:2%;">

        <p><a href="admin.php?page=watu_exams"><?php _e('回到问题列表', 'watu') ?></a>
        </p>

        <form name="post" action="admin.php?page=watu_exam" method="post" id="post" onsubmit="return validate()">

            <div class="postbox wrap" id="titlediv">
                <h3>&nbsp;<?php printf(__('%s 名称及设置', 'watu'), __('Quiz', 'watu')) ?></h3>
                <div class="inside wrap">
                    <input type='text' name='name' id="title" value='<?php echo stripslashes(@$dquiz->name); ?>'/>
                </div>
            </div>

            <div class="postbox wrap" id="videodiv">
                <h3>&nbsp;<?php printf(__('输入培训视频优酷ID（如果不正确，视频将无法播放）', 'watu'), __('Quiz', 'watu')) ?></h3>
                <div class="inside wrap">
                    <input type='text' style="width:700px;"  name='video' id="video" value='<?php echo stripslashes(@$dquiz->trainingvideo); ?>'/>
                </div>
            </div>

            <div class="inside">


                <div class="postbox">
                    <h3>&nbsp;<?php _e('描述', 'watu') ?></h3>
                    <div class="inside">
                        <textarea name='description' rows='5' cols='50'
                                  style='width:100%'><?php echo stripslashes(@$dquiz->description); ?></textarea>
                        <p><?php _e('描述会显示在问题最上端，同时在结果页中也显示.', 'watu') ?></p>
                    </div>
                </div>

                <p class="submit">
                    <?php wp_nonce_field('watu_create_edit_quiz'); ?>
                    <input type="hidden" name="action" value="<?php echo $action; ?>"/>
                    <input type="hidden" name="quiz" value="<?php echo $_REQUEST['quiz']; ?>"/>
                    <input type="hidden" id="user-id" name="user_ID" value="<?php echo $user_ID ?>"/>
                    <span id="autosave"></span>
                    <input type="submit" name="submit" value="<?php _e('Save', 'watu') ?>" class="button button-primary"
                           tabindex="4"/>
                </p>

            </div>
        </form>

    </div>

    <div id="watu-sidebar">
        <?php include(WATU_PATH . "/views/sidebar.php"); ?>
    </div>
</div>