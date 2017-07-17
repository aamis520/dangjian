define(function(require) {
	var $ = require("jquery");
	var justep = require("$UI/system/lib/justep");
	require("$UI/dangjianapp/common/configreader");

	var Model = function() {
		this.callParent();
	};
	
	
	//图片路径转换
	Model.prototype.toUrl = function(url){
		return url ? require.toUrl(url) : "";
	};

	Model.prototype.btnCheckUserLogin = function(event){
		var userData = this.comp("userData");
        //用户名和密码为空提示
        if ( $.trim(userData.val("username")) === "" || $.trim(userData.val("password")) === "") {
                this.comp("messageDialog").show({
                        "title" : "温馨提示",
                        "message" : "请输入用户名或密码"
                });
        }else {
        	 var self = this;
        	 console.log("start");

             $.ajax({
                     "type" : "get",
                     "async" : true,
                     "data":{
                    	 "loginname":userData.val("username"), //POS提交用户名字段
                         "password":userData.val("password")  //POS提交密码字段
                     },
                     "dataType" : "json",
                     "url" : generateapiurl("loginapi"), 
                     "success" : function(data) {
                         if(data['userid']!=null){
                        	 localStorage.setItem('userid',data['userid']);
                        	 localStorage.setItem('loginname',userData.val("username"));
                        	 localStorage.setItem('userrealname',data["userrealname"]);
                        	 localStorage.setItem('phonenumber',data["phonenumber"]);
                        	 localStorage.setItem('picurl',data["picurl"]);
                        	 localStorage.setItem('appartment',data['appartment']);
                        	 localStorage.setItem('userkey',data['userkey']);
                             window.location.href="../shouye/shouye.w";   //登录成功，跳转到APP首页
                         }else{
                        	 self.comp("messageDialog").show({
                        		 "title" : "温馨提示",
                                 "message" : "输入的用户名或密码不正确"
                                 });
                         }
                     },
                     "error": function(){
                    	 self.comp("messageDialog").show({
                    		 "title" : "温馨提示",
		                     "message" : "网络不好，请重试"
		                     });
                     }
                     
             });
        	
        	
        }
        	
	}

	Model.prototype.modelLoad = function(event) {
		var userData = this.comp("userData");
		userData.setValue("username", localStorage.getItem('loginname'));
	}
	
	return Model;
});