<?php
add_action('admin_menu', 't_guide');
function t_guide() {
	add_theme_page('Unite主题使用说明', '使用说明', 8, 'user_guide', 't_guide_options');
}
function t_guide_options() {
?>
<div class="wrap">
	<div class="opwrap" style="line-height: 90%; margin:10px auto; width:95%; padding:10px; border:1px solid #ddd;" >
		<div id="wrapr">
			<div class="headsection">
				<h3 style="clear:both; padding:10px; color:#444; font-size:20px; background:#eee;text-align: center;">Unite主题使用说明</h3>
			</div>
		</div>
	</div>
</div>
<?php }; ?>