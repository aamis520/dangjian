/**
 * Serviceflow.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {
    usrid:{//对应的用户的id
      type:'STRING'
    },
    capability: {//"admin", 管理员; "jijiapprover":积极分子申批人; "yubeiapprover": 预备党员申批人; "zhengshiapprover": 正式党员审批人.
        type: 'STRING',
    },
    picurl: {//用户头像路径, 只返回文件名。头像路径为 domain + "/useravatar/" + 文件名。
        type: 'STRING',
        defaultsTo: ' '

    },
    userrealname: {//用户实名
        type: 'STRING',
        defaultsTo: ' '

    },
    sex: {//性别
        type: 'STRING',
        defaultsTo: ' 男'
    },
    phonenumber: {//用户电话
        type: 'STRING',
        defaultsTo: ' '
    },
    appartment: {//用户部门
        type: 'STRING',
        defaultsTo: ' '
    },
    email: {//邮箱
        type: 'STRING',
        defaultsTo: ' '
    },

    zhiwei: {//职位
        type: 'STRING',
        defaultsTo: ' '
    },
	
	isadmin: {//是否为管理员
        type: 'STRING',
        defaultsTo: ' '
    },
    
    birthday: {//生日
        type: 'STRING',
        defaultsTo: ' '
    },
    
    simpleproduct: {//简介
        type: 'STRING',
        defaultsTo: ' '
    },
    shenfen: {
    	type:"STRING",
    	defaultsTo:''
    }
};

