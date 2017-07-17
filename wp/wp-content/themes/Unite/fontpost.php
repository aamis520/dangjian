<?php
/**
 * Template Name: empty(空页模版)
 * 作者：无
 * 博客：
 *
 */
?>

<?php
error_reporting(E_ERROR | E_PARSE);
get_header();
error_reporting(E_ERROR | E_PARSE | E_WARNING);
?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				    <?php the_content(); ?>
			<?php endwhile; ?>
		</main><!-- .site-main -->
	</div><!-- .site-content -->
</div>

<?php get_footer();?>
