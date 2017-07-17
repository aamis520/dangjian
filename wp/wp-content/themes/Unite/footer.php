<?php

if($_GET['token'] == "czmytoken"){
    wp_footer(); ?>
</body></html>
<?php    return;} ?>

<div id="footer-widget-box">
</div>
<div class="tools">
    <a href="#" class="tools_top" title="返回顶部"></a>
</div>
<?php if (is_single() || is_page() ) { ?>
<?php } ?>
<?php if (is_home() || is_archive() || is_search()) { ?>
<?php } ?>
<?php wp_footer(); ?>
</body></html>