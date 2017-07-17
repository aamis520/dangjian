/*! 
* WeX5 v3 (http://www.justep.com) 
* Copyright 2015 Justep, Inc.
* Licensed under Apache License, Version 2.0 (http://www.apache.org/licenses/LICENSE-2.0) 
*/ 
define(function(require) {

	var Component = require("$UI/system/lib/base/component"), 
		Str = require("$UI/system/lib/base/string"),
		ViewComponent = require("$UI/system/lib/base/viewComponent"),
		url = require.normalizeName("./dangjianframe");
	var ComponentConfig = require("./dangjianframe.config");
	require('css!./css/dangjianframe').load();
	
	require("../configreader"); 
	
	var DangjianFrame = ViewComponent.extend({
		// 构造函数
		constructor : function(options) {
			this.callParent(options);
		},
		
		getConfig: function(){
			return ComponentConfig; 
		},
		
		init: function(){
			this.callParent();
			$(this.domNode).append("" +
					"<iframe src='" +
					generateiframeurl() + 
					"' id='myiframe' scrolling='yes' " +
					"frameborder='0' " +
					"height='100%' width='100%'" +
					"/iframe>");

		}
	});
	
	Component.register(url, DangjianFrame);
	return DangjianFrame;
});
