<?php
/**
 * Plugin Name: mypostsummary
 * author: SDK(inc)
 * Date: 2016
 */

add_action( 'wp_ajax_mypostsummary', 'mypostsummary' );

function countbymonth($catid, $month) {
    $ret = 0;
    $posts = get_posts('category='.$catid);
    foreach($posts as $post) {
        $ret += the_viewinmonth($post->ID, $month);
    }
    return $ret;
}

function mypostsummary()
{
    $data = null;
    header( "Content-Type: application/json" );
    $ret = array();
    $categories=get_categories();
    foreach($categories as $category) {
        $cat = array(
            "name" => $category->cat_name,
            "count" => array(
                "一月" => countbymonth($category->term_id, "01"),
                "二月" => countbymonth($category->term_id, "02"),
                "三月" => countbymonth($category->term_id, "03"),
                "四月" => countbymonth($category->term_id, "04"),
                "五月" => countbymonth($category->term_id, "05"),
                "六月" => countbymonth($category->term_id, "06"),
                "七月" => countbymonth($category->term_id, "07"),
                "八月" => countbymonth($category->term_id, "08"),
                "九月" => countbymonth($category->term_id, "09"),
                "十月" => countbymonth($category->term_id, "10"),
                "十一月" => countbymonth($category->term_id, "11"),
                "十二月" => countbymonth($category->term_id, "12")
            )
        );

        $ret[] = $cat;
    }

    echo json_encode($ret);
    exit();
}
?>