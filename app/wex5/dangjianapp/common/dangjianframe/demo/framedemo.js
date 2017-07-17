/*! 
* WeX5 v3 (http://www.justep.com) 
* Copyright 2015 Justep, Inc.
* Licensed under Apache License, Version 2.0 (http://www.apache.org/licenses/LICENSE-2.0) 
*/ 
define(function(require) {

	var Button = require("$UI/system/components/justep/button/button");
	var justep = require("$UI/system/lib/justep");
	var Message = require("$UI/system/components/justep/common/common");
	var Model = function() {
		this.i = 0;
		this.callParent();
		this.isVisible = Message.flag;
		this.click1 = function(event) {
			alert('点击成功:' + event.source.get("label"));
		};


	};
	Model.prototype.closeWin = function(event){
		justep.Shell.closePage();
	};
	Model.prototype.showBarSource = function(event){
		this.comp("windowDialog").open({
			data : "system/service/common/getWindowContent.j?window=/UI2/system/components/justep/bar/demo/base.w&xid=demoBar"
		});	
	};
	return Model;

});
