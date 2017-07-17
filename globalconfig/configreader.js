var globalconfig = {
    "mainserver": "http://localhost/dangjian/pc",
    "wpserver": "http://localhost/dangjian/wp",
    "apiserver": "http://localhost:1337",
    "httpfileserver": "http://localhost:8000",
    "token": "czmytoken",

    "apis": {
		"loginapi": "/main/login"
    },

    "pages": {
		"notify": {
			"页面描述": "用于显示通知列表",
				"wpurl": "/2017/03/08/adf/",
				"pcurl": "?page=notify"
			}
    }
}

function generaluserhash(){
    //从本地读取用户信息。
}

function generatewpurl(){
    //根据当前pc上的?page="pagename"来获取配置中的内容, 并返回url + token + 用户信息
    var page = GetQueryString('page');
    return globalconfig.pages.page.wpurl;
}

//些API只能用于移动端，iframe引入时获取iframe的url
function generatepcurl(){
    //需返回pc 的 url + token + 用户信息
    var page = window.location.pathname;
    return globalconfig.mainserver + globalconfig.pages.page.wpurl;
}

function GetQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg); //获取url中"?"符后的字符串并正则匹配
    var context = "";
    if (r != null)
        context = r[2];
    reg = null;
    r = null;
    return context == null || context == "" || context == "undefined" ? "" : context;
}
