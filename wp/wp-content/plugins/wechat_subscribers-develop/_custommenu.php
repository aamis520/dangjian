<?php

add_filter('wm_post_custom_menus','wm_post_custom_menus',10,2);

wechat_manager_optionpage_menu();


function wm_get_setting($opt)
{
	$options = get_option(WPWSL_SETTINGS_OPTION);
	return $options[$opt] ? $options[$opt] : null;
}

function wm_get_access_token(){

	if(wm_get_setting('appid') && wm_get_setting('appsecret')){

		$wm_access_token = get_transient('wm_access_token');

		if($wm_access_token === false){
			$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.wm_get_setting('appid').'&secret='.wm_get_setting('appsecret');
			$wm_access_token = wp_remote_get($url,array('sslverify'=>false));
			if(is_wp_error($wm_access_token)){
				echo '<div class="wrap"><div class="updated"><p>'.$wm_access_token->get_error_code().'：'. $wm_access_token->get_error_message().'</p></div></div>';
				exit;
			}
			$wm_access_token = json_decode($wm_access_token['body'],true);
			if(isset($wm_access_token['access_token'])){
				set_transient('wm_access_token',$wm_access_token['access_token'],$wm_access_token['expires_in']);
				return $wm_access_token['access_token'];
			}else{
				echo '<div class="wrap"><div class="updated"><p>错误代码：'.$wm_access_token['errcode'].'，信息：'.$wm_access_token['errmsg'].'</p></div></div>';
				return;
			}
		}else{
			return $wm_access_token;
		}
	}else{
		echo '<div class="wrap"><div class="updated"><p>请先设置 AppID 与 AppSecret</p></div></div>';
		return;
	}
}

function wechat_manager_optionpage_menu()
{
    global $wm_custom_menus, $id, $succeed_msg;

    $wm_custom_menus = get_option('wechat-custom-menus');
    if(!$wm_custom_menus) $wm_custom_menus = array();

    if(isset($_GET['delete']) && isset($_GET['id']) && $_GET['id']) {
        unset($wm_custom_menus[$_GET['id']]);
        update_option('wechat-custom-menus',$wm_custom_menus);
        $succeed_msg = '删除成功';
    }

    if(isset($_GET['sync'])) {
        $succeed_msg = apply_filters('wm_post_custom_menus','', $wm_custom_menus);
    } elseif (isset($_GET['deleteAll'])) {
        update_option('wechat-custom-menus', '');
    } elseif(isset($_GET['edit']) && isset($_GET['id'])){
        $id = (int)$_GET['id'];
    }

    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

        if ( !wp_verify_nonce($_POST['wm_custom_menu_nonce'],'wechat-options') ){
            ob_clean();
            wp_die('非法操作');
        }

        $is_sub = isset($_POST['is_sub'])?1:0;

        $data = array(
            'name'          => stripslashes( trim( $_POST['name'] )),
            'type'          => stripslashes( trim( $_POST['type'] )),
            'key'           => stripslashes( trim( $_POST['key'] )),
            'position'      => $is_sub?'0':stripslashes( trim( $_POST['position'] )),
            'parent'        => $is_sub?stripslashes( trim( $_POST['parent'] )):'0',
            'sub_position'  => $is_sub?stripslashes( trim( $_POST['sub_position'] )):'0',
        );

        if(empty($id)){
            if($wm_custom_menus){
                end($wm_custom_menus);
                $id = key($wm_custom_menus)+1;
            }else{
                $id = 1;
            }
            $wm_custom_menus[$id]=$data;
            update_option('wechat-custom-menus',$wm_custom_menus);
            $succeed_msg = '添加成功';
            $id = 0;
        }else{
            $wm_custom_menus[$id]=$data;
            update_option('wechat-custom-menus',$wm_custom_menus);
            $succeed_msg = '修改成功';
        }
    }
?>


    <div class="wrap">
        <h2>自定义菜单</h2>
        <?php if(!empty($succeed_msg)){?>
        <div class="updated">
            <p><?php echo $succeed_msg;?></p>
        </div>
        <?php }?>
        <?php wm_custom_menu_list(); ?>
        <?php wm_custom_menu_add(); ?>
    </div>

<?php
}

function wm_custom_menu_list(){
    global $plugin_page;

    $wm_custom_menus = get_option('wechat-custom-menus');
    if(!$wm_custom_menus) $wm_custom_menus = array();
    ?>

    <h3>自定义菜单列表 <small><a href="<?php echo admin_url('admin.php?page='.$plugin_page.'&deleteAll'); ?>">清空</a></small></h3>
    <?php if($wm_custom_menus) { ?>
    <?php $wm_ordered_custom_menus = wm_get_ordered_custom_menus($wm_custom_menus);?>
    <form action="<?php echo admin_url('admin.php?page='.$plugin_page); ?>" method="POST">
        <table class="widefat" cellspacing="0">
        <thead>
            <tr>
                <th>按钮</th>
                <th>按钮位置/子按钮位置</th>
                <th>类型</th>
                <th>Key/URL</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php $alternate = '';?>
        <?php foreach($wm_ordered_custom_menus as $wm_custom_menu){ $alternate = $alternate?'':'alternate'; ?>
            <?php if(isset($wm_custom_menu['parent'])){?>
            <tr class="<?php echo $alternate; ?>">
                <td><?php echo $wm_custom_menu['parent']['name']; ?></td>
                <td><?php echo $wm_custom_menu['parent']['position']; ?></td>
                <td><?php echo $wm_custom_menu['parent']['type']; ?></td>
                <td><?php echo $wm_custom_menu['parent']['key']; ?></td>
                <?php $id = $wm_custom_menu['parent']['id'];?>
                <td><span><a href="<?php echo admin_url('admin.php?page='.$plugin_page.'&edit&id='.$id.'#edit'); ?>">编辑</a></span> | <span class="delete"><a href="<?php echo admin_url('admin.php?page='.$plugin_page.'&delete&id='.$id); ?>">删除</a></span></td>
            </tr>
            <?php } ?>
            <?php if(isset($wm_custom_menu['sub'])){  ?>
            <?php foreach($wm_custom_menu['sub'] as $wm_custom_menu_sub){ $alternate = $alternate?'':'alternate';?>
            <tr colspan="4" class="<?php echo $alternate; ?>">
                <td> └── <?php echo $wm_custom_menu_sub['name']; ?></td>
                <td> └── <?php echo $wm_custom_menu_sub['sub_position']; ?></td>
                <td><?php echo $wm_custom_menu_sub['type']; ?></td>
                <td><?php echo $wm_custom_menu_sub['key']; ?></td>
                <?php $id = $wm_custom_menu_sub['id'];?>
                <td><span><a href="<?php echo admin_url('admin.php?page='.$plugin_page.'&edit&id='.$id.'#edit'); ?>">编辑</a></span> | <span class="delete"><a href="<?php echo admin_url('admin.php?page='.$plugin_page.'&delete&id='.$id); ?>">删除</a></span></td>
            <tr>
            <?php }?>
            <?php } ?>
        <?php } ?>
        </tbody>
        </table>
        <p class="submit"><a href="<?php echo admin_url('admin.php?page='.$plugin_page.'&sync'); ?>" class="button-primary">同步自定义菜单</a></p>
    </form>
    <?php } ?>
<?php
}

// 后台表单 JS
add_action('admin_enqueue_scripts', 'wm_enqueue_scripts');
function wm_enqueue_scripts() {
    wp_enqueue_media();
    wp_enqueue_script('wechat-setting', plugins_url('/js/wechat-setting.js', __FILE__), array('jquery'));
    wp_localize_script('wechat-setting', 'wm_setting', array(
        'ajax_url'  => admin_url('admin-ajax.php'),
        'nonce'     => wp_create_nonce('wm_setting_nonce')
    ));
}

function wm_get_ordered_custom_menus($wm_custom_menus){
    $wm_ordered_custom_menus = array();

    foreach ($wm_custom_menus as $id => $wm_custom_menu) {
        $wm_custom_menu['id'] = $id;
        if($wm_custom_menu['parent']){
            $wm_ordered_custom_menus[$wm_custom_menu['parent']]['sub'][$wm_custom_menu['sub_position']] = $wm_custom_menu;
        }else{
            $wm_ordered_custom_menus[$wm_custom_menu['position']]['parent'] = $wm_custom_menu;
        }
    }

    ksort($wm_ordered_custom_menus);

    foreach ($wm_ordered_custom_menus as $key => $wm_ordered_custom_menu) {
        if(isset($wm_ordered_custom_menu['sub'])){
            ksort($wm_ordered_custom_menus[$key]['sub']);
        }
    }

    return $wm_ordered_custom_menus;
}

function wm_custom_menu_add(){
    global $id, $plugin_page;

    $wm_custom_menus = get_option('wechat-custom-menus');
    $wm_custom_menu = array();
    if($id && $wm_custom_menus && isset($wm_custom_menus[$id])){
        $wm_custom_menu = $wm_custom_menus[$id];
    }

    $parent_options         = array('0'=>'','1'=>'1','2'=>'2','3'=>'3');
    $position_options       = array('1'=>'1','2'=>'2','3'=>'3');
    $sub_position_options   = array('0'=>'','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5');
    $type_options           = array('click'=>'点击事件', 'view'=>'访问网页');
?>
    <h3 id="edit"><?php echo $id?'修改':'新增';?>自定义菜单 <?php if($id) { ?> <a href="<?php echo admin_url('admin.php?page='.$plugin_page.'&add'); ?>" class="add-new-h2">新增另外一条自定义菜单</a> <?php } ?></h3>

     <form method="post" action="<?php echo admin_url('admin.php?page='.$plugin_page.'&edit&id='.$id.'#edit'); ?>" enctype="multipart/form-data" id="form">
        <table class="form-table" cellspacing="0">
            <tbody>
                <tr valign="top" id="tr_name">
                    <th scope="row"><label for="name">按钮名称</label></th>
                    <td>
                        <input type="text" name="name" id="name" class="type-text regular-text" value="<?php echo $wm_custom_menu ? $wm_custom_menu['name'] : ''; ?>">
                        <p class="description">按钮描述，既按钮名字，不超过16个字节，子菜单不超过40个字节</p>
                    </td>
                </tr>
                <tr valign="top" id="tr_type">
                    <th scope="row"><label for="type">按钮类型</label></th>
                    <td>
                        <select name="type" id="type" class="type-select ">
                            <option value="click" <?php echo ($wm_custom_menu && $wm_custom_menu['type'] == 'click') ? 'selected' : ''; ?>>点击事件</option>
                            <option value="view" <?php echo ($wm_custom_menu && $wm_custom_menu['type'] == 'view') ? 'selected' : ''; ?>>打开网页</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top" id="tr_key">
                    <th scope="row"><label for="key">按钮KEY值/URL</label></th>
                    <td>
                        <input type="text" name="key" id="key" class="type-text regular-text" value="<?php echo $wm_custom_menu ? $wm_custom_menu['key'] : ''; ?>">
                        <p class="description">用于消息接口（event类型）推送，不超过128字节，如果按钮还有子按钮，可以不填，其他必填，否则报错。<br>如果类型为点击事件时候，则为按钮KEY值，如果类型为浏览网页，则为URL。<br>点击事件的KEY值应设置为关键词回复中设置好的关键词。</p>
                    </td>
                </tr>
                <tr valign="top" id="tr_is_sub">
                    <th scope="row"><label for="is_sub">子按钮</label></th>
                    <td>
                        <input type="checkbox" name="is_sub" id="is_sub" class="type-checkbox is_sub" value="1" <?php echo ($wm_custom_menu && $wm_custom_menu['parent'] != 0) ? 'checked': ''; ?>>
                        <label for="is_sub" class="is_sub">是否激活</label>
                        <p class="description">选择激活，则显示为子菜单，需要选择父级菜单及子菜单位置</p>
                    </td>
                </tr>
                    <tr valign="top" id="tr_position">
                        <th scope="row"><label for="position">位置</label></th>
                        <td>
                            <select name="position" id="position" class="type-select ">
                                <option value="1" <?php echo ($wm_custom_menu && $wm_custom_menu['position'] == 1) ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?php echo ($wm_custom_menu && $wm_custom_menu['position'] == 2) ? 'selected' : ''; ?>>2</option>
                                <option value="3" <?php echo ($wm_custom_menu && $wm_custom_menu['position'] == 3) ? 'selected' : ''; ?>>3</option>
                            </select>
                            <p class="description">设置按钮的位置</p>
                        </td>
                </tr>
                <tr valign="top" id="tr_parent">
                    <th scope="row"><label for="parent">所属父按钮位置</label></th>
                    <td>
                        <select name="parent" id="parent" class="type-select ">
                            <option value="0"></option>
                            <option value="1" <?php echo ($wm_custom_menu && $wm_custom_menu['parent'] == 1) ? 'selected' : ''; ?>>1</option>
                            <option value="2" <?php echo ($wm_custom_menu && $wm_custom_menu['parent'] == 2) ? 'selected' : ''; ?>>2</option>
                            <option value="3" <?php echo ($wm_custom_menu && $wm_custom_menu['parent'] == 3) ? 'selected' : ''; ?>>3</option>
                        </select>
                        <p class="description">如果是子按钮则需要设置所属父按钮的位置</p>
                    </td>
                </tr>
                <tr valign="top" id="tr_sub_position">
                    <th scope="row"><label for="sub_position">子按钮的位置</label></th>
                    <td>
                        <select name="sub_position" id="sub_position" class="type-select ">
                            <option value="0"></option>
                            <option value="1" <?php echo ($wm_custom_menu && $wm_custom_menu['sub_position'] == 1) ? 'selected' : ''; ?>>1</option>
                            <option value="2" <?php echo ($wm_custom_menu && $wm_custom_menu['sub_position'] == 2) ? 'selected' : ''; ?>>2</option>
                            <option value="3" <?php echo ($wm_custom_menu && $wm_custom_menu['sub_position'] == 3) ? 'selected' : ''; ?>>3</option>
                            <option value="4" <?php echo ($wm_custom_menu && $wm_custom_menu['sub_position'] == 4) ? 'selected' : ''; ?>>4</option>
                            <option value="5" <?php echo ($wm_custom_menu && $wm_custom_menu['sub_position'] == 5) ? 'selected' : ''; ?>>5</option>
                        </select>
                        <p class="description">设置子按钮的位置</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php wp_nonce_field('wechat-options','wm_custom_menu_nonce'); ?>
        <input type="hidden" name="action" value="edit" />
        <p class="submit"><input class="button-primary" type="submit" value="<?php echo $id?'修改':'新增';?>" /></p>
    </form>

    <script type="text/javascript">
    jQuery(function(){
        <?php if( $id && $wm_custom_menu['parent'] ){?>
            jQuery('#tr_position').hide();
        <?php } else {?>
            jQuery('#tr_parent').hide();
            jQuery('#tr_sub_position').hide();
        <?php }?>

        jQuery('.is_sub').mousedown(function(){
            jQuery('#tr_parent').toggle();
            jQuery('#tr_sub_position').toggle();
            jQuery('#tr_position').toggle();
        });

    });
    </script>
<?php
}

function wm_post_custom_menus($message, $wm_custom_menus){

    if(wm_get_setting('appid') && wm_get_setting('appsecret')){
        $wm_access_token = wm_get_access_token();
        if($wm_access_token){
            $url =  'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$wm_access_token;
            $request = wm_create_buttons_request($wm_custom_menus);
            $result = wm_post_custom_menus_core($url,urldecode(json_encode($request)));

            $message = $message?$message.'<br />':$message;
            return $message.'微信：'.$result;
        }else{
            return '无法获取正确的token，请检查appid与appsecret是否正确';
        }
    }else{
        return '没有设置appid与appsecret的情况下，无法同步微信自定义菜单';
    }
    return $message;
}

function wm_post_custom_menus_core($url,$request){

    $response = wp_remote_post($url,array( 'body' => $request,'sslverify'=>false));

    if(is_wp_error($response)){
        return $response->get_error_code().'：'. $response->get_error_message();
    }

    $response = json_decode($response['body'],true);

    if($response['errcode']){
        return $response['errcode'].': '.$response['errmsg'];
    }else{
        return '自定义菜单成功同步';
    }
}

function wm_create_buttons_request($wm_custom_menus){

    $wm_ordered_custom_menus = wm_get_ordered_custom_menus($wm_custom_menus);

    $request = $buttons_json = $button_json = $sub_buttons_json = $sub_button_json = array();

    foreach($wm_ordered_custom_menus as $wm_custom_menu){
        if(isset($wm_custom_menu['parent']) && isset($wm_custom_menu['sub'])){
            $button_json['name']    = urlencode($wm_custom_menu['parent']['name']);

            foreach($wm_custom_menu['sub'] as $wm_custom_menu_sub){
                $sub_button_json['type']    = $wm_custom_menu_sub['type'];
                $sub_button_json['name']    = urlencode($wm_custom_menu_sub['name']);
                if($sub_button_json['type'] == 'click'){
                    $sub_button_json['key']     = urlencode($wm_custom_menu_sub['key']);
                }elseif($sub_button_json['type'] == 'view'){
                    $sub_button_json['url']     = urlencode($wm_custom_menu_sub['key']);
                }
                $sub_buttons_json[]         = $sub_button_json;
                unset($sub_button_json);
            }

            $button_json['sub_button']      = $sub_buttons_json;

            unset($sub_buttons_json);

            $buttons_json[]                 = $button_json;
        }elseif(isset($wm_custom_menu['parent'])){
            $button_json['type']    = $wm_custom_menu['parent']['type'];
            $button_json['name']    = urlencode($wm_custom_menu['parent']['name']);
            if($button_json['type'] == 'click'){
                $button_json['key']     = urlencode($wm_custom_menu['parent']['key']);
            }elseif($button_json['type'] == 'view'){
                $button_json['url']     = urlencode($wm_custom_menu['parent']['key']);
            }
            $buttons_json[]         = $button_json;
        }

        unset($button_json);
    }
    $request['button'] = $buttons_json;
    unset($buttons_json);
    return $request;
}
