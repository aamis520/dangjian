<?php
//下面的代码是由globalconfig.json自动生成。不要修改
$configjson = '
{
  "mainserver": "http://localhost/dangjian/pc",
  "wpserver": "http://localhost/dangjian/wp",
  "apiserver": "http://localhost:1337",
  "httpfileserver": "http://localhost:8000",
  "avatarlocation": "http://localhost/dangjian/pc/avatars/",
  "token": "czmytoken",


  "apis": {
    "loginapi": "/main/login",
    "resetpassapi": "/main/resetpassword",
	
    "createuserapi": "/users/create",
    "deluserapi": "/users/delete",
	  "getuserprofileapi": "/userprofile",
    "updateuserprofileapi": "/userprofile/update",
    "listalluserapi": "/userprofile",
	
	
    "newusergroupapi": "/usergroup/create",
    "updateusergroupapi": "/usergroup/update",
    "addusertogroupapi": "/usergroup/adduser",
    "getusergroupinfoapi": "/usergroup/",
    "deluserfromgroupapi": "/usergroup/deluser",
    
    
		"newgroupapi":"/group/create",
		"delgroupapi":"/group/delgroup",
		"getgroupapi":"/group/",
		"addgroupapi":"/group/addgroup",
		
		"newserviceflowapi":"/serviceflow/create",
		"delserviceflowapi":"/serviceflow/delete",
		
    "sendnotificapi": "/notification/send",
    "getunreadnotifybyuserapi": "/notification/unread",
    "delnotifybyuserapi": "/notification/delete",
	
	"createreplyapi":"/reply/create",
	
	"listtopicapi":"/topic/list",
	"listtopicreplyapi":"/topic/topicreply",
    "createtopicapi": "/topic/create",
    "replytopicapi": "/topic/reply",
    "deletetopicapi": "/topic/delete",
    "deletereplyapi": "/topic/delreply",	
    "topicsummaryapi": "/topic/summary",

    "insertdangfeeapi": "/dangfee/insert",
    "listgroupdangfeeapi": "/dangfee/list",
    "listuserdangfeeapi": "/dangfee/list"	,
    
    "orgupdate": "/orginfo/update",
    "getorginfo": "/orginfo/get"	
    },
  
  
  
    "pages": {
    	"framedemo" : {
    		"页面描述" : "纯粹用于demo，不要删除",
    		"wpurl" : "/"
        },
        "mywpfavority" : {
		    "页面描述" : "用于显示文章的收藏页",
		    "wpurl" : "/favoritylist/"
        },
        "dangweitongzhi": {
          "页面描述": "用于显示党委通知列表",
          "wpurl": "/category/notice/party-committee-notice/"
        },
         "dangyuanluntan": {
          "页面描述": "用于显示党员论坛列表页面",
          "wpurl": "/"
        },
         "guojiajianchatizhigaige": {
          "页面描述": "用于显示国家检查体制改革列表",
          "wpurl": "/category/the-state-audit-system-reform/"
        },
         "jiweitongzhi": {
          "页面描述": "用于显示纪委通知列表",
          "wpurl": "/category/notice/discipline-inspection-notice/"
        },
         "liangxueyizuo": {
          "页面描述": "用于显示两学一做页面",
          "wpurl": "/"
        },
         "liangxueyizuo_chengxiao": {
          "页面描述": "用于显示两学一做页面下的“做”的成效",
          "wpurl": "/category/two-learn-to-do/do-the-results/"
        },
         "liangxueyizuo_dongtai": {
          "页面描述": "用于显示两学一做页面下的学习动态",
          "wpurl": "/category/two-learn-to-do/learning-dynamics/"
        },
         "liangxueyizuo_ziliao": {
          "页面描述": "用于显示两学一做页面下的知识资料",
          "wpurl": "/category/two-learn-to-do/knowledge-data/"
        },
         "lianjie": {
          "页面描述": "用于显示廉洁作风页面",
          "wpurl": "/"
        },
         "lianjie_anli": {
          "页面描述": "用于显示廉洁作风页面下的案例警示",
          "wpurl": "/category/party-member-management/incorruptible-style/case-warning/"
        },
         "lianjie_kaimo": {
          "页面描述": "用于显示廉洁作风页面下的勤廉楷模",
          "wpurl": "/category/party-member-management/incorruptible-style/diligence-model/"
        },
         "lianjie_yaowen": {
          "页面描述": "用于显示廉洁作风页面下的廉洁要闻",
          "wpurl": "/category/party-member-management/incorruptible-style/clean-news/"
        },
         "lituixiudangyuan": {
          "页面描述": "用于显示离退休党员页面",
          "wpurl": "/"
        },
         "lituixiudangyuan_suiyue": {
          "页面描述": "用于显示离退休党员页面下的流金岁月",
          "wpurl": "/"
        },
         "lituixiudangyuan_zhengce": {
          "页面描述": "用于显示离退休党员页面下的政策法规",
          "wpurl": "/"
        },
         "luntan": {
          "页面描述": "用于显示论坛页面",
          "wpurl": "/"
        },
         "luntan_dangyuan": {
          "页面描述": "用于显示论坛页面下的党员论坛",
          "wpurl": "/"
        },
         "luntan_suiyue": {
          "页面描述": "用于显示论坛页面下的流金岁月",
          "wpurl": "/"
        },
         "luntan_zhengwen": {
          "页面描述": "用于显示论坛页面下的征文论坛",
          "wpurl": "/category/party-member-management/essay-forum/"
        },
         "peixun": {
          "页面描述": "用于显示培训页面",
          "wpurl": "/"
        },
         "peixun_dangke": {
          "页面描述": "用于显示培训页面下的党课培训",
          "wpurl": "/"
        },
         "peixun_rudang": {
          "页面描述": "用于显示培训页面下的入党培训",
          "wpurl": "/"
        },
         "pinpaidangjian": {
          "页面描述": "用于显示品牌党建页面",
          "wpurl": "/"
        },
         "pinpaidangjian_fuwu": {
          "页面描述": "用于显示品牌党建页面下的党建+服务",
          "wpurl": "/category/party-member-management/brand-party-building/party-building-service/"
        },
         "pinpaidangjian_guanli": {
          "页面描述": "用于显示品牌党建页面下的党建+管理",
          "wpurl": "/category/party-member-management/brand-party-building/party-building-and-management/"
        },
         "pinpaidangjian_jifenka": {
          "页面描述": "用于显示品牌党建页面下的党员积分卡",
          "wpurl": "/category/party-member-management/brand-party-building/party-membership-card/"
        },
         "pinpaidangjian_xiangmu": {
          "页面描述": "用于显示品牌党建页面下的党建+项目",
          "wpurl": "/category/party-member-management/brand-party-building/party-building-project/"
        },
         "sanhuiyike": {
          "页面描述": "用于显示三会一课页面",
          "wpurl": "/"
        },
         "sanhuiyike_dangke": {
          "页面描述": "用于显示三会一课页面下的精品党课",
          "wpurl": "/category/three-lessons/excellent-lectures/"
        },
         "sanhuiyike_dongtai": {
          "页面描述": "用于显示三会一课页面下的支部动态",
          "wpurl": "/category/three-lessons/branch-dynamic/"
        },
         "sanhuiyike_jianying": {
          "页面描述": "用于显示三会一课页面下的活动剪影",
          "wpurl": "/category/three-lessons/activity-photos/"
        },
         "settingpage": {
          "页面描述": "用于显示设置页面",
          "wpurl": "/"	
        },
         "shouye": {
          "页面描述": "用于显示首页页面",
          "wpurl": "/"
        },
         "sixiangjiaoliu": {
          "页面描述": "用于显示思想交流页面",
          "wpurl": "/"
        },
         "sixiangjiaoliu_lunshu": {
          "页面描述": "用于显示思想交流页面下的领导论述",
          "wpurl": "/category/party-member-management/thinking-communication/leadership-discourse/"
        },
         "sixiangjiaoliu_taolun": {
          "页面描述": "用于显示思想交流页面下的专题讨论",
          "wpurl": "/"
        },
         "sixiangjiaoliu_xinde": {
          "页面描述": "用于显示思想交流页面下的党员心得",
          "wpurl": "/"
        },
         "sixiangjiaoliu_xinxiang": {
          "页面描述": "用于显示思想交流页面下的书记信箱",
          "wpurl": "/"
        },

         "tongzhi": {
          "页面描述": "用于显示通知列表",
          "wpurl": "/"
        },
        "tongzhi_huifu": {
            "页面描述": "用于显示回复通知列表",
            "pcurl": "/index.php?page=personCenter"
        },
          "tongzhi_xitong": {
              "页面描述": "用于显示系统通知列表",
              "wpurl": "/"
        },
         "wode": {
          "页面描述": "用于显示我的页面",
          "wpurl": "/"
        },
         "dangjianxuanchuan": {
          "页面描述": "用于显示党建宣传页面",
          "wpurl": "/"
        },
         "dangjianxuanchuan_danggui": {
          "页面描述": "用于显示党建宣传页面下的党纪党规",
          "wpurl": "/category/party-member-management/learning-propaganda/party-discipline/"
        },
         "dangjianxuanchuan_yaowen": {
          "页面描述": "用于显示党建宣传页面下的党建要闻",
          "wpurl": "/category/party-member-management/learning-propaganda/party-news/"
        },
         "dangjianxuanchuan_zhishiku": {
          "页面描述": "用于显示党建宣传页面党建知识库",
          "wpurl": "/"
        },
         "dangjianxuanchuan_ziliao": {
          "页面描述": "用于显示党建宣传页面下的知识资料",
          "wpurl": "/category/party-member-management/learning-propaganda/knowledge-data-learning-propaganda/"
        },
         "zaixianxuexi": {
          "页面描述": "用于显示党员在线学习页面",
          "wpurl": "/"
        },
         "zaixianxuexi_dangke": {
          "页面描述": "用于显示党员在线学习页面下的党课培训",
          "wpurl": "/"
        },
         "zaixianxuexi_rudang": {
          "页面描述": "用于显示党员在线学习页面下的入党培训",
          "wpurl": "/"
        },
         "zhengcejiedu": {
          "页面描述": "用于显示政策解读页面",
          "wpurl": "/category/policy-interpretation/"
        },
         "zhengwenluntan": {
          "页面描述": "用于显示征文论坛页面",
          "wpurl": "/category/party-member-management/essay-forum/"
        },
         "zhibutongzhi": {
          "页面描述": "用于显示支部通知页面",
          "wpurl": "/category/notice/branch-notice/"
        },
         "zhongyaohuiyibaogaojiedu": {
          "页面描述": "用于显示重要会议报告解读页面",
          "wpurl": "/category/interpretation-of-important-conference-report/"
        },
         "zuzhishenghuo": {
          "页面描述": "用于显示组织生活页面",
          "wpurl": "/"
        },
         "zuzhishenghuo_dongtai": {
          "页面描述": "用于显示组织生活页面下的组织动态",
          "wpurl": "/category/party-member-management/organizational-life/organizational-dynamics/"
        },
         "zuzhishenghuo_fazhan": {
          "页面描述": "用于显示组织生活页面的党员发展",
          "wpurl": "/"
        },
         "zuzhishenghuo_gaikuang": {
          "页面描述": "用于显示组织生活页面下的组织概况",
          "wpurl": "/category/party-member-management/organizational-life/organizational-profile/"
        },
         "zuzhishenghuo_xianfeng": {
          "页面描述": "用于显示组织生活页面下的模范先锋",
          "wpurl": "/category/party-member-management/organizational-life/live-pioneer/"
        },
         "dangfeijiaona": {
          "页面描述": "用于显示党费缴纳页面",
          "wpurl": "/"
        },
         "dangfeijiaona_guiding": {
          "页面描述": "用于显示党费缴纳页面下的党费规定",
          "wpurl": "/category/pay-membership-dues/"
        },
         "dangfeijiaona_jiaona": {
          "页面描述": "用于显示党费缴纳页面下的党费缴纳",
          "wpurl": "/"
        },
         "dangfeijiaona_xinxi": {
          "页面描述": "用于显示党费缴纳页面下的缴费信息",
          "wpurl": "/"
        }
      }
    }
'
?>




<?php
    $myglobalconfig = json_decode($configjson);

    function getapiurl($key){
        global $myglobalconfig;
        if(isset($myglobalconfig->{'apis'}->{$key})){
            return $myglobalconfig->{'apiserver'}.$myglobalconfig->{'apis'}->{$key};
        }
        echo "查找的API URL不存在, 严重问题";
        return null;
    }

    function getconfigwpurl(){
        global $myglobalconfig;
        global $pageid;
        if(!isset($myglobalconfig->{'pages'})){
            return null;
        }

        if(!isset($myglobalconfig->{'pages'}->{$pageid})){
            return null;
        }

        if(!isset($myglobalconfig->{'pages'}->{$pageid}->{'wpurl'})){
            return null;
        }

        $token = "?token=".$myglobalconfig->{'token'};
        $userkey= "&userkey=". $_SESSION["userkey"];
        return $myglobalconfig->{'wpserver'}.$myglobalconfig->{'pages'}->{$pageid}->{'wpurl'}.$token.$userkey;
    }

    function iswppageconfiged(){
        if(getconfigwpurl()!=null){
            return true;
        }
        return false;
    }

?>

