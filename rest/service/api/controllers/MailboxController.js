/**
 * UsersController
 *
 * @description :: Server-side logic for managing users
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

module.exports = {

    create: function (req, res) { //将update变成只更新一条数据。
        var dangweiid = req.param("dangweiid");
        var jiweiid = req.param("jiweiid");
        var zhibuid = req.param("zhibuid");
        var customerid = req.param("usrid");
        Mailbox.findOne({
            mailboxid:customerid
        }).exec(function (err, finn){
        	if(err){
        		res.send(500,{error:"服务器错误"});
        	}
        	if(!finn){
	            Mailbox.create(
	                {
	                	mailboxid:customerid, 
	                	dangweiid:dangweiid, 
	                	jiweiid:jiweiid,
	                	zhibuid:zhibuid
	                }
	            ).exec(function (err,org){
	            	if(err){
	            		res.send(200,{error:"未知错误"})
	            	}else{
	            		res.send(200,{org:org});
	            	}
	        	})
        	}else{
        		Mailbox.update(
        			{
        				mailboxid:customerid, 	
        			},
        			{
	                	mailboxid:customerid, 
	                	dangweiid:dangweiid, 
	                	jiweiid:jiweiid,
	                	zhibuid:zhibuid
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
		var customerid = req.param('usrid');
        Mailbox.find({
        
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

