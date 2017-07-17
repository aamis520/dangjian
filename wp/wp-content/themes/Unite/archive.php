<?php get_header();?>

<?php $allowcreate=$curcat = get_query_var('cat');

$Agent = $_SERVER['HTTP_USER_AGENT'];
if(ereg('dangjianapp', $Agent)) {
    $allowcreate = false;
}
//在APP上，不显示创建按钮。
if($allowcreate){ ?>

    <div id="top-menu">
        <a href="<?php echo home_url()."/%e6%96%87%e7%ab%a0%e5%8f%91%e5%b8%83%e9%a1%b5/?token=czmytoken&category=".$curcat; ?> "><span class="nav-newtopic">新建文章</span></a>
        <div class="clear"></div>

    </div>
<?php } ?>

<div id="content" class="site-content">	
	<div class="clear"></div>
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<figure class="thumbnail">		
			<?php get_template_part( 'inc/thumbnail' ); ?>					
		</figure>
		<?php get_template_part( 'inc/new' ); ?>
		<header class="entry-header">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php echo cut_str($post->post_title,40); ?></a></h2>		
		</header><!-- .entry-header -->
		
		<div class="entry-content">
			<span class="entry-meta">
				<span class="date"><?php  the_time( 'Y/n/j H:i');?>&nbsp;&nbsp;</span>
				<span class="views"><?php if( function_exists( 'the_views' ) ) { print '  本文已被阅读 '; the_views(); print '次  ';  } ;?></span>&nbsp;&nbsp;
			<span class="comment"><?php comments_popup_link( ' 评论 0 条', ' 评论 1 条', ' 评论 % 条' ); ?></span>				
			</span>	
			<span class="cat">
				<?php 
					$category = get_the_category(); 
					if($category[0]){
					echo '<a>'.$category[0]->cat_name.'</a>';
					}
				?>
			</span>
			<br/>		
			
			<div class="archive-content">			 				
				<?php if (has_excerpt()){ the_excerpt();} else { echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 118,"..."); } ?>
			</div>
            <?php if($allowcreate){ ?>
            <span class="views"><?php if( function_exists( 'the_views' ) ) { echo '        下面的人阅读过本文: '.the_viewer(); } ;?></span>
            <?php } ?>
			<div class="clear"></div>
		</div><!-- .entry-content -->
		
		<span class="archive-tag"><?php the_tags('', ', ', '');?></span>
	</article><!-- #post -->

 	<!-- ad -->
	<?php if ($wp_query->current_post == 1) : ?>
	<?php if (get_option('ygj_adh') == '关闭') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/inc/ad/ad_h.php'); } ?>
	<?php endif; ?>	
	<?php if ($wp_query->current_post == 5) : ?>
	<?php if (get_option('ygj_adhx') == '关闭') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/inc/ad/ad_hx.php'); } ?>
	<?php endif; ?>	
	<!-- end: ad -->
<?php endwhile; ?>
		<?php else : ?>
		<section class="content">
			<p>目前还没有文章！</p>
		</section>
		<?php endif; ?>		
		</main><!-- .site-main -->		
		<?php pagenavi(); ?>
	</section><!-- .content-area -->
<?php get_sidebar();?>
<div class="clear"></div>
</div><!-- .site-content -->
<?php get_footer();?>