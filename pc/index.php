<?php

    if(!isset($_SESSION)) session_start();
    $ROOTPATH = dirname(__FILE__);
    require_once($ROOTPATH."/functions/functions.php");
    require_once($ROOTPATH."/configreader.php");

    $CURRENTDOMIN=$_SERVER['HTTP_HOST'];

    error_reporting(0);
    $action = $_GET['action'];
    $pageid = $_GET['page'];
    if(isset($_GET['s'])){
        $pageid = 'wpsearch';
    }
    error_reporting(E_ERROR | E_WARNING | E_PARSE);

    //如果action是退出，则清除相关的session信息，并输入登录界面。
    if(isset($action )){
        if($action == "exit"){
            unset($_SESSION["userkey"]);
            unset($_SESSION["userdetailinfo"]);
            require_once($ROOTPATH."/pages/login.php");
            return;
        }
    }

    //如果登录并没有设置pageid，进入personcenter, 否则，进入登录界面。。
    if(!isset($pageid )){
        if(isSystemLogin()){
            $pageid = "personCenter";
        }else {
            require_once($ROOTPATH."/pages/login.php");
            return;
        }

    }

    //保存userid到session中。
    if((isset($_GET['userid']))){
        saveLoginid($_GET['userid']);
    }

    //保存userkey到session中。
    if((isset($_GET['userkey']))){
        saveLogininfo($_GET['userkey']);
    }

    //从api服务器中取得用户详情，保存到session中。
    if(isset($_GET['userid'])) {
        $url = getapiurl('getuserprofileapi').'?usrid='.$_GET['userid'];
        savesession('userdetailinfo', json_decode(mycurl($url)));
    }

    $Agent = $_SERVER['HTTP_USER_AGENT'];
    if(ereg('dangjianapp', $Agent)) {
        $requestfromdangjianapp = true;
    }

    if((isset($_GET['appkey'])) && ($_GET['appkey']) == "dangjianapp"){
        $requestfromdangjianapp = true;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Cache-Control:max-age＝0,must－revalidate">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>党建</title>
	<link rel="stylesheet" href="assets/css/fonts/linecons/css/linecons.css">
	<link rel="stylesheet" href="assets/css/fonts/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/xenon-core.css">
	<link rel="stylesheet" href="assets/css/xenon-forms.css">
	<link rel="stylesheet" href="assets/css/xenon-components.css">
	<link rel="stylesheet" href="assets/css/xenon-skins.css">
	<link rel="stylesheet" href="assets/css/custom.css">

    <link rel="stylesheet" href="res/css/xc-dangjian.css"/>
    <?php if ($requestfromdangjianapp) {?>
        <link rel="stylesheet" href="res/css/xc-dangjian-mobile.css"/>
    <?php } ?>
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	
</head>
<body class="page-body skin-watermelon">
<?php if (!$requestfromdangjianapp) {?>
	<div style="width: 100%;position: fixed;z-index: -1;">
		<img src="res/images/conBg.png" style="width: 100%;display: block;"/>
	</div>
<?php } ?>
	<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

		<!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
		<!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
		<!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
<?php if (!$requestfromdangjianapp) {?>
		<div class="sidebar-menu toggle-others fixed" style="position: relative;z-index: 1;">

			<div class="sidebar-menu-inner">
                <?php
                    if(strstr($pageid, "admin-") == false) { //判断是不是后台管理端页面
                        require_once($ROOTPATH . "/framework/sidebar.php");
                    } else {
                        require_once($ROOTPATH."/framework/admin-sidebar.php");
                    }
                ?>


			</div>

		</div>
		
		<div class="main-content">
			
			<!-- User Info, Notifications and Menu Bar -->
			<nav class="navbar user-info-navbar" role="navigation">

				<!-- Left links for user info navbar -->
				<ul class="user-info-menu left-links list-inline list-unstyled">

					<li class="hidden-sm hidden-xs">
						<a href="#" data-toggle="sidebar">
							<i class="fa-bars"></i>
						</a>
					</li>

<!--                    --><?php //require_once($ROOTPATH."/framework/mail.php"); ?>

                    <?php require_once($ROOTPATH."/framework/notification.php"); ?>
                    <?php require_once($ROOTPATH."/framework/mail.php"); ?>
					
					
					<?php require_once($ROOTPATH."/framework/backstage.php"); ?>
				</ul>

				<!-- Right links for user info navbar -->
				<ul class="user-info-menu right-links list-inline list-unstyled">

                    <?php require_once($ROOTPATH."/framework/search.php"); ?>
                    <?php require_once($ROOTPATH."/framework/userprofile.php"); ?>

<!--					<li>-->
<!--						<a href="#" data-toggle="chat">-->
<!--							<i class="fa-comments-o"></i>-->
<!--						</a>-->
<!--					</li>-->

				</ul>
			</nav>
<?php }?>

            <!--            内容区域开始 -->
            <?php

            if(file_exists($ROOTPATH."/pages/".$pageid.".php")){
                require_once($ROOTPATH."/pages/".$pageid.".php");
            }else if( iswppageconfiged()){
                //如果在global config中配置了wpconfig, 则直接显示。
                require_once($ROOTPATH."/pages/wpframe.php");
            } elseif(isotherpageconfiged()){
                require_once($ROOTPATH."/pages/otherframe.php");
            } else {
                require_once($ROOTPATH."/pages/error.php");
            }

            ?>
            <!--            内容区域结束 -->


			<?php if (!$requestfromdangjianapp) {?>

			<!-- Main Footer -->
			<!-- Choose between footer styles: "footer-type-1" or "footer-type-2" -->
			<!-- Add class "sticky" to  always stick the footer to the end of page (if page contents is small) -->
			<!-- Or class "fixed" to  always fix the footer to the end of page -->
		</div>


        <?php require_once($ROOTPATH."/framework/chat.php"); ?>
		
	</div>
	<!--弹出框放置位置-->
	<!--页面名称  id名称--> 
	<?php require_once($ROOTPATH."/modal/alterPassword.php"); ?>
	<?php require_once($ROOTPATH."/modal/addMember.php"); ?>
 	<?php require_once($ROOTPATH."/modal/chooseSomebody.php"); ?>
	<?php require_once($ROOTPATH."/modal/agreeProval.php"); ?>
 	<?php require_once($ROOTPATH."/modal/refuseProval.php"); ?>
	<?php require_once($ROOTPATH."/modal/photoYulan.php"); ?>
	<?php require_once($ROOTPATH."/modal/addToGroup.php"); ?>
	<?php require_once($ROOTPATH."/modal/dismissConfirm.php"); ?>

<!--    lyd.add-->
    <?php require_once($ROOTPATH."/modal/personCenterModal.php")?>
    <?php require_once($ROOTPATH."/modal/deleteNotifyConfirm.php") ?>
    <?php require_once($ROOTPATH."/modal/showNotifyModal.php")?>

	<div class="page-loading-overlay">
		<div class="loader-2"></div>
	</div>
<?php }else {?>
    <?php require_once($ROOTPATH."/modal/personCenterModal.php")?>
<?php }?>
	
    <script type="text/javascript">
        document.domain = "localhost";
    </script>

	
	<!-- Bottom Scripts -->
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/TweenMax.min.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/xenon-api.js"></script>
	<script src="assets/js/xenon-toggles.js"></script>


	<!-- Imported scripts on this page -->
	<script src="assets/js/xenon-widgets.js"></script>
	<script src="assets/js/devexpress-web-14.1/js/globalize.min.js"></script>
	<script src="assets/js/devexpress-web-14.1/js/dx.chartjs.js"></script>
	<script src="assets/js/toastr/toastr.min.js"></script>


	<!-- JavaScripts initializations and stuff -->
	<script src="assets/js/xenon-custom.js"></script>
	
	<!--slidebar auto slide down-->
	<script src="res/js/sliderBarAuto.js"></script>

</body>
</html>