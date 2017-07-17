/**
 * UsersController
 *
 * @description :: Server-side logic for managing users
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

module.exports = {

    create: function (req, res) { //将update变成只更新一条数据。
        var jijishenpiid = req.param("jijishenpiid");
        var yubeishenpiid = req.param("yubeishenpiid");
        var zhengshishenpiid = req.param("zhengshishenpiid");
        var customerid = req.param("usrid");
        Approval.findOne({
            approvalid:customerid
        }).exec(function (err, appro){
        	if(err){
        		res.send(500,{error:"服务器错误"});
        	}
        	if(!appro){
	            Approval.create(
	                {
	                	approvalid:customerid, 
	                	jijishenpiid:jijishenpiid, 
	                	yubeishenpiid:yubeishenpiid,
	                	zhengshishenpiid:zhengshishenpiid
	                }
	            ).exec(function (err,org){
	            	if(err){
	            		res.send(200,{error:"未知错误"})
	            	}else{
	            		res.send(200,{org:org});
	            	}
	        	})
        		
        	}else{
        		Approval.update(
        			{
        				approvalid:customerid, 	
        			},
        			{
	                	approvalid:customerid, 
	                	jijishenpiid:jijishenpiid, 
	                	yubeishenpiid:yubeishenpiid,
	                	zhengshishenpiid:zhengshishenpiid
	                }
        		).exec(function(err,org){
        			if(err){
	            		res.send(200,{error:"未知错误"})
	            	}else{
	            		res.send(200,{org:org});
	            	}
        		})
        	}
        });
    },
	
	get: function (req, res) { //将update变成只更新一条数据。
		var customerid = req.param("usrid");
        Approval.findOrCreate({
            approvalid:customerid
        }).exec(function (err, org){
            if(err){
        		res.send(200,{error:"未知错误"})
        	}else{
        		res.send(200,{org:org});
        	}
        });
    },

    delete: function (req, res) {
        res.send(200, "不支持");
    },

};

