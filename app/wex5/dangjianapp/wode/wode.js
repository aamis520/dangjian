define(function(require){
	var $ = require("jquery");
	var justep = require("$UI/system/lib/justep");
	require("$UI/dangjianapp/common/configreader");
	
	var Model = function(){
		this.callParent();
	};
	this.myName = justep.Bind.observable("");
	this.myName.set(localStorage.getItem('userrealname'));
	this.avatarURL = justep.Bind.observable("");
	this.avatarURL = getavatarurl()+localStorage.getItem('picurl');
	
	Model.prototype.btnExit = function(event){
		window.location.href="../login/loginpage.w";
	}

	return Model;
});