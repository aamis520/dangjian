<div id="social">
	<div class="social-main">
		<span class="like">
            <a href="javascript:void(0)" id="shang-main-p" <?php echo get_favorites_button()."&nbsp;&nbsp;&nbsp;" ?> </a>
		</span>
		<span class="shang-p">or</span>
		<span class="share-s"><a href="javascript:void(0)" id="share-main-s">&nbsp;&nbsp;&nbsp;喜欢</a></span>
		<div class="clear"></div>
	</div>
</div>


<!--//收藏按钮需要调用的API-->
<!--    $.ajax({-->
<!--            url: plugin.ajaxurl,-->
<!--            type: 'post',-->
<!--            datatype: 'json',-->
<!--            data: {-->
<!--            action : plugin.formactions.favorite,-->
<!--            nonce : plugin.nonce,-->
<!--            postid : post_id,-->
<!--            siteid : site_id,-->
<!--            status : status-->
<!--    },-->
<!--    success: function(data){-->
<!--            $(button).removeClass('loading');-->
<!--            $(button).html(original_html);-->
<!--            $(button).attr('disabled', false);-->
<!--            plugin.userfavorites = data.favorites;-->
<!--            plugin.updateAllLists();-->
<!--            plugin.updateAllButtons();-->
<!--            plugin.updateClearButtons();-->
<!--            plugin.updateTotalFavorites();-->
<!--            favorites_after_button_submit(data.favorites);-->
<!--            }-->
<!--    });-->