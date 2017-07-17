$(document).ready(function(){
	function sliderBarAuto(){
		//返回url  类型为string
		var url = window.location.href;
		//取参数
		function getQueryString(name) {  
	        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");  
	        var r = window.location.search.substr(1).match(reg);  
	        if (r != null) {
	        	return unescape(r[2]);
	        }  
	        return null;  
	    }
	    var urlArg = '?page='+getQueryString('page');
	    //获得 参数   类型为string
	    //字符串拼接？
	    //获取页面呢侧边栏 链接的href;
		//匹配 href  取得 链接的index
		for(var j=0;j<$('#bs-example-navbar-collapse-1 a').length; j++){
			var arg = j;
			(function(){
				if($('#bs-example-navbar-collapse-1 a')[arg].getAttribute('href')=== urlArg){
					var tar = $($('#bs-example-navbar-collapse-1 a')[arg]).parent('li').parent('ul').children('li').first().children('a');
					urlArg = tar.attr("href");
				}
			})(arg);
		} 
		if(urlArg =="?page=index"){
	    	return false;
	   }
		//后台群组
		if(urlArg == "?page=admin-groupSetting" || urlArg == "?page=admin-creatGroup"){
			urlArg = "?page=admin-groupControl";
		}
		//前台群组
		if(urlArg == "?page=groupDetail" || urlArg == "?page=creatGroup" ||urlArg == "?page=groupSetting"){
			urlArg = "?page=myTeamGroup";
		}
		if(urlArg == "?page=admin-classTestDetail"){
			urlArg = "?page=admin-scoreInfo";
		}
		if(urlArg == "?page=joinProval"){
			urlArg = "?page=joinProvalList";
		}
		if(urlArg == "?page=myProvalDetail"){
			urlArg = "?page=myProval";
		}
		for(var i=0;i<$('#main-menu a').length;i++){
			var temp = i;
			(function (){
				if($('#main-menu a')[temp].getAttribute('href')=== urlArg){
					//将链接所在侧边栏展开 并且高亮		    
					if($('.sidebar-menu').hasClass('collapsed')){
						
					}else{
						var sliObj = $($('#main-menu a')[temp]);
						var sliObjFa = sliObj.parent('li').parent('ul');
						var sliObjGa = sliObjFa.parent('li').parent('ul');
						sliObj.parent('li').addClass('active');
						sliObjFa.show();
						sliObjGa.show();
						if(sliObjFa.parent('li').hasClass('has-sub')){
							sliObjFa.parent('li').addClass('expanded');
						}
						if(sliObjGa.parent('li').hasClass('has-sub')){
							sliObjGa.parent('li').addClass('expanded');
						}
					}
				}
				return false;	
			})(temp);
		}
		//
		
	}
	sliderBarAuto();
});