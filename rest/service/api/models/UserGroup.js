/**
 * Usergroup.js
 *非管理员创建的分组
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {

    attributes: {
    	//群主id
		ownerid: {
		    type:'STRING'
		},
		//群主姓名
		ownername:{
			type:'STRING'
		},
		//个人群组id
		usergroupid: {
			type:'STRING'
		},
		//个人群组名称
		usergroupname:{
			type:'STRING'
		},
		//个人群组logo
		usergroupimg:{
			type:'STRING'
		},
		//个人群组描述
		description:{
			type:'STRING'
		},
		//个人群组是否为组织群组
		istissue:{
			type:'STRING'
		},
				
		type: {//类型："users":用户自己创建的，"system":管理员创建的系统群组。 "default": "默认的群组，每个大群就一个"
		    type:'STRING'
		},
		
		memberid: {
		    type:'STRING'
		},
		
		groupid: {  //群组id
		    type:'STRING'
		}
	}

};

