<?php

/**
 * WeChat Interface for WeChat Subscribers Lite
 */
global $token;

define('IS_DEBUG', isset($_GET['debug']));

$wechatObj = new WechatCallbackapi($token);

if ($wechatObj->valid()) {
    $wechatObj->responseMsg();
} else {
    header('Location: ' . home_url());
}
exit;

class WechatCallbackapi
{

    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function valid()
    {
        //valid signature , option
        if ($this->checkSignature()) {
            if (isset($_GET["echostr"]) && $_GET["echostr"] != '') {
				ob_clean();
                echo $_GET["echostr"];
                exit;
            }
            return true;
        } else {
            return false;
        }
    }

    public function responseMsg()
    {

        //get post data, May be due to the different environments
        if (IS_DEBUG) {
            $postStr = "<xml>
    						<ToUserName><![CDATA[toUser]]></ToUserName>
    						<FromUserName><![CDATA[fromUser]]></FromUserName>
    						<CreateTime>1348831860</CreateTime>
    						<MsgType><![CDATA[text]]></MsgType>
    						<Content><![CDATA[testsearch]]></Content>
    						<MsgId>1234567890123456</MsgId>
    						</xml>";
        } else {
            $postStr = file_get_contents('php://input');
        }

        //extract post data
        if (!empty($postStr) && $this->checkSignature()) {

            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $msgType = $postObj->MsgType;

            if ($msgType == 'event') {
                $msg = $this->eventRespon($postObj);
            } else {
                $msg = $this->sendAutoReply($postObj);
            }

            echo $msg;
        } else {
            echo "";
            exit;
        }
    }

    private function saveKeyWord($fromUsername, $keyword, $match)
    {
        $messageRow = [
            "openid" => $fromUsername,
            "keyword" => $keyword,
            "is_match" => $match,
            "time" => current_time("Y-m-d H:i:s", 0)];
        global $wpdb;
        $rows_affected = $wpdb->insert(DB_TABLE_WPWSL_HISTORY, $messageRow);
    }

    private function sendAutoReply($postObj)
    {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $topic_keyword = '';
        $resultStr = '';

        $is_match = false;
        if ($keyword != '') {
            if (substr_count($keyword, '#') == 1) {
                $keyword = "#" . $keyword;
            }
            if (preg_match("/(#.*?#)/i", $keyword, $re) !== false) {
                $topic_keyword = $re[1] ? strtolower($re[1]) : '';
            }
            $keyword = strtolower($keyword);

            foreach (get_data() as $d) {
                if ($d->trigger == 'default' || $d->trigger == 'subscribe') {
                    continue;
                }
                $curr_key = $d->key;
                foreach ($curr_key as $k) {
                    $_k = strtolower(trim($k));
                    if ($topic_keyword != '' && $topic_keyword == $_k){
                        $is_match = true;
                    }else if ($keyword == $_k) {
                        $is_match = true;
                    }
                }
                if ($is_match) {
                    $resultStr = $this->getMessageByType($d, $fromUsername, $toUsername);
                    break;
                }
            }
        }
        $match = $is_match ? "y" : "n";
        if (!$is_match) {
            foreach (get_data() as $d) {
                if ($d->trigger == 'default') {
                    $d->key[0] = $keyword;
                    $resultStr = $this->getMessageByType($d, $fromUsername, $toUsername);
                    break;
                }
            }
        }
        $this->saveKeyWord($fromUsername, $keyword, $match);
        return $resultStr;
    }

    private function eventRespon($postObj)
    {

        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $eventType = $postObj->Event;
        $resultStr = '';

        foreach (get_data() as $d) {
            if ($d->trigger == $eventType) {
                $resultStr = $this->getMessageByType($d, $fromUsername, $toUsername);
                break;
            }
        }

        return $resultStr;
    }

    private function parseurl($url = "")
    {
        $url = rawurlencode($url);
        $a = [
            "%3A",
            "%2F",
            "%40"];
        $b = [
            ":",
            "/",
            "@"];
        return str_replace($a, $b, $url);
    }

    private function getMessageByType($d, $fromUsername, $toUsername)
    {
        switch ($d->type)
        {
            case "news":
                $resultStr = $this->sendPhMsg($fromUsername, $toUsername, $d->phmsg);
                break;
            case "recent":
                $messages = $this->getRecentlyPosts($d->remsg);
                $resultStr = $this->sendMsgBase($fromUsername, $toUsername, $messages);
                break;
            case "random":
                $messages = $this->getRandomPosts($d->remsg);
                $resultStr = $this->sendMsgBase($fromUsername, $toUsername, $messages);
                break;
            case "search":
                $messages = $this->getSearchPosts($d->key[0], $d->remsg);
                $resultStr = $this->sendMsgBase($fromUsername, $toUsername, $messages);
                break;
            default: //text
                $resultStr = $this->sendMsg($fromUsername, $toUsername, $d->msg);
        }

        return $resultStr;
    }

    private function sendMsg($fromUsername, $toUsername, $contentData)
    {

        if ($contentData == '') {
            return '';
        }

        $textTpl = "<xml>
          			<ToUserName><![CDATA[%s]]></ToUserName>
          			<FromUserName><![CDATA[%s]]></FromUserName>
          			<CreateTime>%s</CreateTime>
          			<MsgType><![CDATA[%s]]></MsgType>
          			<Content><![CDATA[%s]]></Content>
          			<FuncFlag>0</FuncFlag>
          			</xml>";

        $msgType = "text";
        $time = time();
        return sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentData);
    }

    private function sendPhMsg($fromUsername, $toUsername, $contentData)
    {
        if ($contentData == '') {
            return '';
        }

        $headerTpl = "<ToUserName><![CDATA[%s]]></ToUserName>
        	        <FromUserName><![CDATA[%s]]></FromUserName>
        	        <CreateTime>%s</CreateTime>
        	        <MsgType><![CDATA[%s]]></MsgType>
        	        <ArticleCount>%s</ArticleCount>";

        $itemTpl = "<item>
      					<Title><![CDATA[%s]]></Title>
      					<Description><![CDATA[%s]]></Description>
      					<PicUrl><![CDATA[%s]]></PicUrl>
      					<Url><![CDATA[%s]]></Url>
      					</item>";

        $itemStr = "";
        $mediaCount = 0;
        foreach ($contentData as $mediaObject) {
            $title = $mediaObject->title;
            $des = $mediaObject->des;
            $media = $this->parseurl($mediaObject->pic);
            $url = $mediaObject->url;
            $itemStr .= sprintf($itemTpl, $title, $des, $media, $url);
            $mediaCount++;
        }

        $msgType = "news";
        $time = time();
        $headerStr = sprintf($headerTpl, $fromUsername, $toUsername, $time, $msgType, $mediaCount);

        $resultStr = "<xml>" . $headerStr . "<Articles>" . $itemStr . "</Articles></xml>";

        return $resultStr;
    }

    private function getSearchPosts($keyword, $contentData = null)
    {
        if (!$contentData) {
            return null;
        }
        $re_type = isset($contentData['type']) ? $contentData['type'] : "";
        $re_cate = isset($contentData['cate']) ? $contentData['cate'] : "";
        $re_count = isset($contentData['count']) ? $contentData['count'] : 6;
        $args = [
            'posts_per_page' => $re_count,
            'orderby' => 'post_date',
            'order' => 'desc',
            'ignore_sticky_posts' => 1,
        ];
        if ($re_type != "") {
            $args['post_type'] = $re_type;
            if ($re_type == "post" && $re_cate != "") {
                $args['category'] = $re_cate;
            }
        } else {
            $args['post_type'] = 'any';
        }
        $args['post_status'] = "publish";

        // $args['tag'] = $keyword;
        // $posts = get_posts($args);
        //
    // $more_count = $re_count - count($posts);
        //
    // if($more_count <= 0){
        //   return $posts;
        // }
        // unset($array['tag']);

        $args['posts_per_page'] = $re_count;
        $args['s'] = $keyword;
        $posts = get_posts($args);

        // return array_merge($posts, $more_posts);
        return $posts;
    }

    private function getRandomPosts($contentData = null)
    {
        if (!$contentData)
            return null;
        $re_type = isset($contentData['type']) ? $contentData['type'] : "";
        $re_cate = isset($contentData['cate']) ? $contentData['cate'] : "";
        $re_count = isset($contentData['count']) ? $contentData['count'] : 6;
        $args = [
            'posts_per_page' => $re_count,
            'orderby' => 'rand',
        ];
        if ($re_type != "") {
            $args['post_type'] = $re_type;
            if ($re_type == "post" && $re_cate != "") {
                $args['category'] = $re_cate;
            }
        } else {
            $args['post_type'] = 'any';
        }
        $args['post_status'] = "publish";

        return get_posts($args);
    }

    private function getRecentlyPosts($contentData = null)
    {
        if (!$contentData) {
            return null;
        }
        $re_type = isset($contentData['type']) ? $contentData['type'] : "";
        $re_cate = isset($contentData['cate']) ? $contentData['cate'] : "";
        $re_count = isset($contentData['count']) ? $contentData['count'] : 6;
        $args = [
            'posts_per_page' => $re_count,
            'orderby' => 'post_date',
            'order' => 'desc',
        ];
        if ($re_type != "") {
            $args['post_type'] = $re_type;
            if ($re_type == "post" && $re_cate != "") {
                $args['category'] = $re_cate;
            }
        } else {
            $args['post_type'] = 'any';
        }
        $args['post_status'] = "publish";

        return get_posts($args);
    }

    private function getImgsSrcInPost($post_id = null, $post_content = '',
        $i = 1, $type = '', $post_excerpt = '')
    {

        $imageSize = $i == 1 ? "sup_wechat_big" : "sup_wechat_small";
        $text = "";
        $rimg = WPWSL_PLUGIN_URL . "/img/" . $imageSize . ".png";

        $setting_opts = get_option(WPWSL_SETTINGS_OPTION);

        if (isset($setting_opts[$imageSize]) && $setting_opts[$imageSize] != '') {
            $rimg = $setting_opts[$imageSize];
        }

        if ($type == "attachment") {
            $tmp_img_obj = wp_get_attachment_image_src($post_id, $imageSize);
            $rimg = $tmp_img_obj[0];
        } else {
            if (get_the_post_thumbnail($post_id) != '') {
                $_tmp_id = get_post_thumbnail_id($post_id);
                $tmp_img_obj = wp_get_attachment_image_src($_tmp_id, $imageSize);
                $rimg = $tmp_img_obj[0];
            } else {
                $attachments = get_posts([
                    'post_type' => 'attachment',
                    'posts_per_page' => -1,
                    'post_parent' => $post_id,
                    'exclude' => get_post_thumbnail_id($post_id)
                ]);
                if (count($attachments) > 0) {
                    $tmp_img_obj = wp_get_attachment_image_src($attachments[0]->ID, $imageSize);
                    $rimg = $tmp_img_obj[0];
                }
            }
        }
        if (trim($post_excerpt) != "") {
            $text = trim_words($post_excerpt, SYNC_EXCERPT_LIMIT);
        } else if (trim($post_content != "")) {
            $text = trim_words($post_content, SYNC_EXCERPT_LIMIT);
        }
        return [
            "src" => $rimg,
            "text" => $text];
    }

    private function sendMsgBase($fromUsername, $toUsername, $messages)
    {
        if (count($messages) > 0) {
            $headerTpl = "<ToUserName><![CDATA[%s]]></ToUserName>
      			        <FromUserName><![CDATA[%s]]></FromUserName>
      			        <CreateTime>%s</CreateTime>
      			        <MsgType><![CDATA[%s]]></MsgType>
      			        <ArticleCount>%s</ArticleCount>";

            $itemTpl = "<item>
        					<Title><![CDATA[%s]]></Title>
        					<Description><![CDATA[%s]]></Description>
        					<PicUrl><![CDATA[%s]]></PicUrl>
        					<Url><![CDATA[%s]]></Url>
        					</item>";

            $itemStr = "";
            $mediaCount = 0;
            $i = 1;
            foreach ($messages as $mediaObject) {
                $src_and_text = $this->getImgsSrcInPost($mediaObject->ID, $mediaObject->post_content, $i, $contentData['type'], $mediaObject->post_excerpt);

                $title = trim_words($mediaObject->post_title, SYNC_TITLE_LIMIT);
                $des = $src_and_text['text'];  // strip_tags or not
                $media = $this->parseurl($src_and_text['src']);
                if ($contentData['type'] == "attachment") {
                    $url = home_url('/?attachment_id=' . $mediaObject->ID);
                } else {
                    $url = html_entity_decode(get_permalink($mediaObject->ID));
                }

                $itemStr .= sprintf($itemTpl, $title, $des, $media, $url);
                $mediaCount++;
                $i++;
            }

            $msgType = "news";
            $time = time();
            $headerStr = sprintf($headerTpl, $fromUsername, $toUsername, $time, $msgType, $mediaCount);

            $resultStr = "<xml>" . $headerStr . "<Articles>" . $itemStr . "</Articles></xml>";
        } else {
            $textTpl = "<xml>
        					<ToUserName><![CDATA[%s]]></ToUserName>
        					<FromUserName><![CDATA[%s]]></FromUserName>
        					<CreateTime>%s</CreateTime>
        					<MsgType><![CDATA[%s]]></MsgType>
        					<Content><![CDATA[%s]]></Content>
        					<FuncFlag>0</FuncFlag>
        					</xml>";

            $msgType = "text";
            $time = time();
            $no_result = __('Sorry! No result.', 'WPWSL');
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $no_result);
        }
        return $resultStr;
    }

    private function checkSignature()
    {
        if (IS_DEBUG) {
            return true;
        }
        
        $signature = WpwslHelper::get('signature');
        $timestamp = WpwslHelper::get('timestamp');
        $nonce = WpwslHelper::get('nonce');

        $tmpArr = [
            $this->token,
            $timestamp,
            $nonce];
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        return ($tmpStr == $signature);
        
    }

}

function get_data()
{

    foreach (get_posts([
        'post_type' => 'wpwsl_template',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'post_status' => 'publish',
        'order' => 'DESC'
    ]) as $p) {

        $tmp_msg = new stdClass();
        $tmp_msg->phmsg = [];

        foreach (get_post_meta($p->ID, '_phmsg_item') as $_item) {
            $_tmp_item = json_decode($_item);

            $_tmp_item->title = urldecode($_tmp_item->title);
            $_tmp_item->pic = urldecode($_tmp_item->pic);
            $_tmp_item->des = urldecode($_tmp_item->des);
            $_tmp_item->url = urldecode($_tmp_item->url);

            $tmp_msg->phmsg[] = $_tmp_item;
        }
        $tmp_key = trim(get_post_meta($p->ID, '_keyword', TRUE));

        $tmp_msg->title = $p->post_title;
        $tmp_msg->type = get_post_meta($p->ID, '_type', TRUE);
        $tmp_msg->key = explode(',', $tmp_key);
        $tmp_msg->trigger = get_post_meta($p->ID, '_trigger', TRUE);
        $tmp_msg->msg = get_post_meta($p->ID, '_content', TRUE);

        //response source
        $tmp_msg->remsg = [
            "type" => get_post_meta($p->ID, '_re_type', TRUE),
            "cate" => get_post_meta($p->ID, '_re_cate', TRUE),
            "count" => get_post_meta($p->ID, '_re_count', TRUE)
        ];
        yield $tmp_msg;
    }
}
