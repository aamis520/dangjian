<?php 

namespace SimpleFavorites\Entities\User;

use SimpleFavorites\Entities\User\UserRepository;
use SimpleFavorites\Entities\Favorite\FavoriteFilter;
use SimpleFavorites\Helpers;
use SimpleFavorites\Entities\Favorite\FavoriteButton;
use SimpleFavorites\Config\SettingsRepository;

class UserFavorites 
{

	/**
	* User ID
	* @var int
	*/
	private $user_id;

	/**
	* Site ID
	* @var int
	*/
	private $site_id;

	/**
	* Display Links
	* @var boolean
	*/
	private $links;

	/**
	* Filters
	* @var array
	*/
	private $filters;

	/**
	* User Repository
	*/
	private $user_repo;

	/**
	* Settings Repository
	*/
	private $settings_repo;

	public function __construct($user_id = null, $site_id = null, $links = false, $filters = null)
	{
		$this->user_id = $user_id;
		$this->site_id = $site_id;
		$this->links = $links;
		$this->filters = $filters;
		$this->user_repo = new UserRepository;
		$this->settings_repo = new SettingsRepository;
	}

	/**
	* Get an array of favorites for specified user
	*/
	public function getFavoritesArray()
	{
		$favorites = $this->user_repo->getFavorites($this->user_id, $this->site_id);
		if ( isset($this->filters) && is_array($this->filters) ) $favorites = $this->filterFavorites($favorites);
		return $this->removeInvalidFavorites($favorites);
	}

	/**
	* Remove non-existent or non-published favorites
	* @param array $favorites
	*/
	private function removeInvalidFavorites($favorites)
	{
		foreach($favorites as $key => $favorite){
			if ( !$this->postExists($favorite) ) unset($favorites[$key]);
		}
		return $favorites;
	}

	/**
	* Filter the favorites
	* @since 1.1.1
	* @param array $favorites
	*/
	private function filterFavorites($favorites)
	{
		$favorites = new FavoriteFilter($favorites, $this->filters);
		return $favorites->filter();
	}	

	/**
	* Return an HTML list of favorites for specified user
	* @param $include_button boolean - whether to include the favorite button
	*/
	public function getFavoritesList($include_button = false)
	{
		if ( is_null($this->site_id) || $this->site_id == '' ) $this->site_id = get_current_blog_id();
		
		$favorites = $this->getFavoritesArray();
		$no_favorites = $this->settings_repo->noFavoritesText();

		// Post Type filters for data attr
		$post_types = '';
		if ( isset($this->filters['post_type']) ){
			$post_types = implode(',', $this->filters['post_type']);
		}
		
		if ( is_multisite() ) switch_to_blog($this->site_id);
		
		$out = '';
		$out .= '';
		foreach ( $favorites as $key => $favorite ){
			$out .= '';
            $url = get_permalink($favorite);
            $pic = $this->catch_that_image($favorite);
            $title = get_the_title($favorite);
            $desciption = get_the_excerpt($favorite);
            $out .= $this->formatoutput($favorites,$url, $pic,$title, $desciption);
			$out .= '';
		}
		if ( empty($favorites) ) $out .= '<li data-postid="0" data-nofavorites>' . $no_favorites . '</li>';
		$out .= '';
		if ( is_multisite() ) restore_current_blog();
		return $out;
	}

    function catch_that_image( $id ) {
	    global $post;
        $first_img = '';

        $post_thumbnail_id = get_post_thumbnail_id( $id );
        if ( $post_thumbnail_id ) {
            $output = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );
            $first_img = $output[0];
        }
        else { // 没有缩略图，查找文章中的第一幅图片
            ob_start();
            ob_end_clean();
            $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
            $first_img = $matches [1] [0];

        }

        if(empty($first_img)){ // 既没有缩略图，文中也没有图，设置一幅默认的图片
            $first_img = plugin_dir_url( FAVORITES_PLUGIN_FILE )."assets/images/default.jpg";
        }

        return $first_img;
    }

	/**
	* Check if post exists and is published
	*/
	private function postExists($id)
	{
		$status = get_post_status($id);
		return( !$status || $status !== 'publish') ? false : true;
	}

    private function formatoutput($id, $url, $pic,$title, $desciption){
        ?>

        <article id="post-<?php echo $id; ?>" class="post type-post status-publish format-standard hentry">
            <figure class="thumbnail">
                <?php get_template_part( 'inc/thumbnail' ); ?>
            </figure>
            <?php get_template_part( 'inc/new' ); ?>
            <header class="entry-header">
                <h2 class="entry-title"><a href="<?php echo $url; ?>" rel="bookmark" title="<?php echo $title; ?>"><?php echo cut_str($title,40); ?></a></h2>
            </header><!-- .entry-header -->

            <div class="entry-content">
			<span class="entry-meta">
				<span class="date"><?php  get_the_time( 'Y/n/j H:i', $id);?>&nbsp;&nbsp;</span>
			</span>
                <span class="cat">
				<?php
                $category = get_the_category($id);
                if($category[0]){
                    echo '<a href='.get_category_link($category[0]->term_id ).'>'.$category[0]->cat_name.'</a>';
                }
                ?>
			</span>
                <br/>

                <div class="archive-content">
                    <?php if (has_excerpt($id)){ the_excerpt($id);} else { echo mb_strimwidth(strip_tags($desciption), 0, 118,"..."); } ?>
                </div>

                <div class="clear"></div>
            </div><!-- .entry-content -->

            <span class="archive-tag"><?php the_tags('', ', ', '');?></span>
        </article><!-- #post -->

        <?php
    }


}