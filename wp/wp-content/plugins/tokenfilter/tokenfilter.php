<?php
/**
 * Plugin Name: tokenfilter
 * author: SDK(inc)
 * Date: 2016
 */

add_filter('post_link', 'mytokenpostlink',20,3);
add_filter('next_post_link', 'mytokenpostlink',20,3);
add_filter('previous_post_link', 'mytokenpostlink',20,3);

function mytokenpostlink($permalink, $post, $leavename)
{
    if($permalink == "") return;

    if($_GET['token'] == "czmytoken"){
        return $permalink."?token=czmytoken";
    }
    return $permalink;
}
?>