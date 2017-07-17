<?php
/* Template Name: watu考核列表模版 */

/**watu 考试列表模板
 * watu exam template.
 */
?>
<?php
error_reporting(E_ERROR | E_PARSE);
get_header();
error_reporting(E_ERROR | E_PARSE | E_WARNING);
?>
<div id="content" class="site-content">
    <div class="clear"></div>
    <br/>
    <section id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php
            global $wpdb;
            $quizs = $wpdb->get_results("SELECT id, name,trainingvideo, final_screen, description FROM {$wpdb->prefix}watu_master");
            $num_quizs = sizeof($quizs);
            if ($num_quizs > 0) {
                foreach ($quizs as &$quiz) {
                    ?>
                    <article id="post-<?php $quiz->ID; ?>" class="post type-post status-publish format-standard hentry">
                        <figure class="thumbnail">
                            <?php get_template_part('inc/thumbnail'); ?>
                        </figure>
                        <header class="entry-header">
                            <h2 class="entry-title">
                                <a href="
                                <?php
                                        $userkey='';
                                        if($_GET['userkey']){
                                            $userkey='&userkey='.$_GET['userkey'];
                                        }
                                        echo home_url() .'/watu答题界面?quizid=' . $quiz->id."&token=czmytoken".$userkey; ?>"
                                   rel="bookmark" title="<?php $quiz->name ?>"><?php echo "培训题目：" . cut_str($quiz->name, 40); ?></a>
                            </h2>
                        </header><!-- .entry-header -->

                        <div class="entry-content">
                            <br/>
                            <div class="archive-content">
                                <?php echo "培训描述：" . mb_strimwidth(strip_tags(apply_filters('the_content', $quiz->description)), 0, 118, "..."); ?>
                            </div>

                            <div class="clear"></div>
                        </div><!-- .entry-content -->

                    </article><!-- #post -->

                <?php } ?>
            <?php } else { ?>
                <section class="content">
                    <p>目前还没有党建培训！</p>
                    <p>请等待管理员配置培训信息</p>
                </section>
            <?php } ?>
        </main><!-- .site-main -->
    </section><!-- .content-area -->
    <div class="clear"></div>
</div><!-- .site-content -->
<?php get_footer(); ?>