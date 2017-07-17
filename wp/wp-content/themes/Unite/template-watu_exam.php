<?php
/* Template Name: watu考核模版 */

/**watu 考试模板
 * watu exam template.
 */

// File Security Exam
if ( ! defined( 'ABSPATH' ) ) { exit; }


    function youku_video(){
        global $wpdb;
        $quiz_id = intval(@$_GET['quizid']);
        $quiz = $wpdb->get_results("SELECT id, trainingvideo FROM {$wpdb->prefix}watu_master where id=".$quiz_id);
        if(wp_is_mobile()) {//适配移动端
            echo '<iframe height=210 width="100%" src=http://player.youku.com/embed/'.$quiz[0]->trainingvideo.' frameborder=0 allowfullscreen></iframe>';
        }else {
            echo '<iframe height=480 width="100%" src=http://player.youku.com/embed/'.$quiz[0]->trainingvideo.' frameborder=0 allowfullscreen></iframe>';        }
    };
    /**
     * php截取指定两个字符之间字符串，默认字符集为utf-8
     * @param string $begin  开始字符串
     * @param string $end    结束字符串
     * @param string $str    需要截取的字符串
     * @return string
     */
    function _cut($begin,$end,$str){
        $b = mb_strpos($str,$begin) + mb_strlen($begin);
        $e = mb_strpos($str,$end) - $b;
        return mb_substr($str,$b,$e);
    }

get_header();

    ?>

<div id="content" class="site-content">
    <div class="clear"></div>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">


                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <div class="entry-content">
                        <div class="single-content">
                            <div id="youku_video" style="margin-top: 23px;"><?php echo youku_video();?></div>
                        </div>
                        <div class="clear"></div>

                        <div class="single-content">
                            <div id="exam" style="margin-top: 23px;"><?php echo do_action('watu_showdetail',$_GET['quizid']);?></div>
                        </div>

                    </div><!-- .entry-content -->

                </article>
        </main><!-- .site-main -->
    </div><!-- .content-area -->
    <div class="clear"></div>
</div><!-- .site-content -->

<?php get_footer(); ?>


