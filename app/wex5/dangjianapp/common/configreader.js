var globalconfig = {
		  "mainserver": "http://www.zgzyfy.com/dangjian/pc",
		  "wpserver": "http://www.zgzyfy.com/dangjian/wp",
		  "apiserver": "http://www.zgzyfy.com:1337",
		  "httpfileserver": "http://www.zgzyfy.com:8000",
		  "token": "czmytoken",

		  "apis": {
		    "loginapi": "/main/login",
		    "resetpassapi": "/main/resetpassword",
		    "getuserinfo": "/main/getuserinfo",
		    
		    "createuserapi": "/user/create",
		    "deluserapi": "/user/delete",
		    "getuserprofileapi": "/userprofile",
		    "updateuserprofileapi": "/userprofile/update",
		    "listalluserapi": "/user/alluser",
			
		    "newusergroupapi": "/usergroup/create",
		    "addusertogroupapi": "/usergroup/adduser",
		    "getusergroupinfoapi": "/usergroup/",
		    "deluserfromgroupapi": "/usergroup/deluser",

		    "sendnotificapi": "/notification/send",
		    "getunreadnotifybyuserapi": "/notification/unread",
		    "delnotifybyuserapi": "/notification/delete",
			
			
		    "createtopicapi": "/topic/create",
		    "replytopicapi": "/topic/reply",
		    "deletetopicapi": "/topic/delete",
		    "deletereplyapi": "/topic/delreply",	
		    "topicsummaryapi": "/topic/summary",

		    "insertdangfeeapi": "/dangfee/insert",
		    "listgroupdangfeeapi": "/dangfee/list",
		    "listuserdangfeeapi": "/dangfee/list"	
		  },

		    "pages": {
		    	"framedemo" : {
		    		"页面描述" : "纯粹用于demo，不要删除",
		    		"wpurl" : "/"
		        },
		      "admin-fileadmin" : {
		        "页面描述" : "用于显示文章的收藏页",
		        "otherurl" : ":8001"
		      },
		      "dangjianzhishiku" : {
		        "页面描述" : "用于显示文章的收藏页",
		        "otherurl" : ":8000"
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
		          "pcurl": "/index.php?page=dangyuanluntan"
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
		          "wpurl": "/category/two-learn-to-do/learning-dynamics/"
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
		          "wpurl": "/category/party-member-management/incorruptible-style/clean-news/"
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
		          "wpurl": "/category/party-member-management/retired-party-members/policies-and-regulations/"
		        },
		         "lituixiudangyuan_suiyue": {
		          "页面描述": "用于显示离退休党员页面下的流金岁月",
		          "pcurl": "/index.php?page=goldenTimes"
		        },
		         "lituixiudangyuan_zhengce": {
		          "页面描述": "用于显示离退休党员页面下的政策法规",
		          "wpurl": "/category/party-member-management/retired-party-members/policies-and-regulations/"
		        },
		         "luntan_quan": {
		          "页面描述": "用于显示论坛-党建圈页面",
		          "pcurl": "/index.php?page=personCenter"
		        },
		         "luntan_dangyuan": {
		          "页面描述": "用于显示论坛页面下的党员论坛",
		          "pcurl": "/index.php?page=dangyuanluntan"
		        },
		         "luntan_suiyue": {
		          "页面描述": "用于显示论坛页面下的流金岁月",
		          "pcurl": "/index.php?page=goldenTimes"
		        },
		         "luntan_zhengwen": {
		          "页面描述": "用于显示论坛页面下的征文论坛",
		          "wpurl": "/category/party-member-management/essay-forum/"
		        },
		         "peixun": {
		          "页面描述": "用于显示培训页面",
		          "wpurl": "/watu考核列表"
		        },
		         "peixun_dangke": {
		          "页面描述": "用于显示培训页面下的党课培训",
		          "wpurl": "/watu考核列表"
		        },
		         "pinpaidangjian": {
		          "页面描述": "用于显示品牌党建页面",
		          "wpurl": "/category/party-member-management/brand-party-building/party-building-project/"
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
		          "wpurl": "/category/three-lessons/branch-dynamic/"
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
		         "shouye": {
		          "页面描述": "用于显示首页页面",
		          "wpurl": "/"
		        },
		         "sixiangjiaoliu": {
		          "页面描述": "用于显示思想交流页面",
		          "wpurl": "/category/party-member-management/thinking-communication/party-members-experience/"
		        },
		         "sixiangjiaoliu_lunshu": {
		          "页面描述": "用于显示思想交流页面下的领导论述",
		          "wpurl": "/category/party-member-management/thinking-communication/leadership-discourse/"
		        },
		         "sixiangjiaoliu_taolun": {
		          "页面描述": "用于显示思想交流页面下的专题讨论",
		          "pcurl": "/index.php?page=zhuantitaolun"
		        },
		         "sixiangjiaoliu_xinde": {
		          "页面描述": "用于显示思想交流页面下的党员心得",
		          "wpurl": "/category/party-member-management/thinking-communication/party-members-experience/"
		        },
		         "sixiangjiaoliu_xinxiang": {
		          "页面描述": "用于显示思想交流页面下的书记信箱",
		          "pcurl": "/index.php?page=shujiMail"
		        },

		         "tongzhi": {
		          "页面描述": "用于显示通知列表",
		          "pcurl": "/index.php?page=reply"
		        },
		        "tongzhi_huifu": {
		            "页面描述": "用于显示消息通知列表",
		            "pcurl": "/index.php?page=reply"
		        },
		          "tongzhi_xitong": {
		              "页面描述": "用于显示系统通知列表",
		              "pcurl": "/index.php?page=notify"
		        },
		          "tongzhi_xinxiang": {
		              "页面描述": "用于显示信箱通知列表",
		              "pcurl": "/index.php?page=mailMore"
		        },
		         "dangjianxuanchuan": {
		          "页面描述": "用于显示党建宣传页面",
		          "wpurl": "/category/party-member-management/learning-propaganda/party-news/"
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
		          "pcurl": "/index.php?page=dangjianzhishiku"
		        },
		         "dangjianxuanchuan_ziliao": {
		          "页面描述": "用于显示党建宣传页面下的知识资料",
		          "wpurl": "/category/party-member-management/learning-propaganda/knowledge-data-learning-propaganda/"
		        },
		         "zaixianxuexi": {
		          "页面描述": "用于显示党员在线学习页面",
		          "wpurl": "/watu考核列表"
		        },
		         "zaixianxuexi_dangke": {
		          "页面描述": "用于显示党员在线学习页面下的党课培训",
		          "wpurl": "/watu考核列表"
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
		          "wpurl": "/category/party-member-management/organizational-life/live-pioneer/"
		        },
		         "zuzhishenghuo_dongtai": {
		          "页面描述": "用于显示组织生活页面下的组织动态",
		          "wpurl": "/category/party-member-management/organizational-life/organizational-dynamics/"
		        },
		         "zuzhishenghuo_fazhan": {
		          "页面描述": "用于显示组织生活页面的党员发展",
		          "pcurl": "/index.php?page=memberDevelop"
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
		          "wpurl": "/category/pay-membership-dues/"
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
		          "wpurl": "/category/party-membership-dues-payment/"
		        },
		         "quanmiancongyanzhidang": {
		          "页面描述": "用于显示全面从严治党页面",
		          "wpurl": "/category/an-all-out-effort-to-enforce-strict-party-discipline/"
		        },
		         "jijianyewu": {
		          "页面描述": "用于显示纪检业务页面",
		          "wpurl": "/category/discipline-inspection-business/"
		        },
		        "wenhualinian": {
		          "页面描述": "用于显示文化理念页面",
		          "wpurl": "/category/corporate-culture/cultural-idea/"
		        },
		        "gongtuanhuodong": {
		          "页面描述": "用于显示工团活动页面",
		          "wpurl": "/category/corporate-culture/all-activities/"
		        },
		        "dangyuangushi": {
		          "页面描述": "用于显示党员故事页面",
		          "wpurl": "/category/corporate-culture/living-story/"
		        },
		         "wode": {
		          "页面描述": "用于显示我的页面",
		          "wpurl": "/"
		        },
		        "guanyu": {
		          "页面描述": "用于显示我的-关于页面",
		          "pcurl": "/"
		        },
		        "lianxiren": {
		          "页面描述": "用于显示我的-我的联系人页面",
		          "pcurl": "/index.php?page=allPersons_mobile"
		        },
		        "qunzu": {
		          "页面描述": "用于显示我的-我的群组页面",
		          "pcurl": "/index.php?page=myTeamGroup_mobile"
		        },
		        "shenpi": {
		          "页面描述": "用于显示我的-我的审批页面",
		          "pcurl": "/index.php?page=joinProvalList"
		        },
		        "shenqing": {
		          "页面描述": "用于显示我的-我的申请页面",
		          "pcurl": "/index.php?page=myProval"
		        },
		        "shoucang": {
		          "页面描述": "用于显示我的-我的收藏页面",
		          "pcurl": "/index.php?page=mywpfavority"
		        },
		        "ziliao": {
		          "页面描述": "用于显示我的-我的资料页面",
		          "pcurl": "/index.php?page=personal"
		        }
		      }
		};


function generateapiurl($key) {
	var api = eval("globalconfig.apis." + $key);
	return globalconfig.apiserver + api;
}

function getavatarurl() {
	return globalconfig.mainserver + "/";
}


function generateiframeurl() {
	//根据当前pc上的?page="pagename"来获取配置中的内容, 并返回url + token + 用户信息
	var page = eval("globalconfig.pages." + GetpageString() + ".pcurl");
	var token = "token=" + globalconfig.token + "&appkey=dangjianapp";
	var userkey =  "&userkey=" + localStorage.getItem('userkey');
	var userid =  "&userid=" + localStorage.getItem('userid');
	if (page == null || page == "" || page == "undefined") {
		page = eval("globalconfig.pages." + GetpageString() + ".wpurl")
		return globalconfig.wpserver + page + "?"+ token + userid + userkey;
	} else {
		return globalconfig.mainserver + page + "&"+ token + userid + userkey;
	}
}

function GetpageString() {
	var a = window.location.href;
	var b = a.split("/");
	var c = b.slice(b.length - 1, b.length).toString(String).split(".")[0];
	return c;
}
