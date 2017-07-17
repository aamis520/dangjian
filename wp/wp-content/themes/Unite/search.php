<?php get_header(); ?>
<?php $posts = query_posts($query_string . '&posts_per_page=10'."&post_type=post"); //只搜索文章?>
    <header class="entry-header">
        <h2 class="entry-title">&nbsp;&nbsp;与您搜索相关的内容有：</h2>
    </header>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <figure class="thumbnail">
                <?php get_template_part('inc/thumbnail'); ?>
            </figure>
            <?php get_template_part('inc/new'); ?>
            <header class="entry-header">
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"
                                           title="<?php the_title(); ?>"><?php echo cut_str($post->post_title, 40); ?></a>
                </h2>
            </header><!-- .entry-header -->

            <div class="entry-content">
			<span class="entry-meta">
				<span class="date"><?php the_time('Y/n/j H:i'); ?>&nbsp;&nbsp;</span>
			<span class="comment"><?php comments_popup_link(' 评论 0 条', ' 评论 1 条', ' 评论 % 条'); ?></span>
			</span>
                <br/>

                <div class="archive-content">
                    <?php if (has_excerpt()) {
                        the_excerpt();
                    } else {
                        echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 118, "...");
                    } ?>
                </div>
                <div class="clear"></div>
            </div><!-- .entry-content -->

            <span class="archive-tag"><?php the_tags('', ', ', ''); ?></span>
        </article><!-- #post -->

        <!-- ad -->
        <?php if ($wp_query->current_post == 1) : ?>
            <?php if (get_option('ygj_adh') == '关闭') { ?>
                <?php {
                    echo '';
                } ?>
            <?php } else {
                include(TEMPLATEPATH . '/inc/ad/ad_h.php');
            } ?>
        <?php endif; ?>
        <?php if ($wp_query->current_post == 5) : ?>
            <?php if (get_option('ygj_adhx') == '关闭') { ?>
                <?php {
                    echo '';
                } ?>
            <?php } else {
                include(TEMPLATEPATH . '/inc/ad/ad_hx.php');
            } ?>
        <?php endif; ?>
        <!-- end: ad -->
    <?php endwhile; ?>
<?php else : ?>
    <li class="search-inf"></li>
    <li class="entry-title">
    没有找到您要找的文章，请换个词试试。。。
<?php endif; ?>
<?php get_footer(); ?>