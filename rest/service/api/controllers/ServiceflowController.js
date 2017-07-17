/**
 * ServiceflowController
 *
 * @description :: Server-side logic for managing users
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

module.exports = {

    create: function (req, res) {
        var fromusrid = req.param('fromusrid');
        var touser = req.param('touser');
        Serviceflow.findOne({
        	fromusrid:fromusrid,
        	touser:touser
        }).exec(function(err,finn){
        	if(err){
        		res.send(500,{error:"网络错误18"});
        	}else{
        		if(!(finn)){
        			console.log(123);
        			Serviceflow.create(
        				{
        					fromusrid:fromusrid,
        					touser:touser,
        					tousrid:req.param('tousrid'),
        					sex:req.param('sex'),
        					provalname:req.param('provalname'),
        					politicalstatus:req.param('politicalstatus'),
        					nation:req.param('nation'),
        					provaldoc:req.param('provaldoc'),
        					provalstatus:req.param('provalstatus')
        				}
    				).exec(function(err,org){
    					if(err){
    						res.send(500,{error:"网络错误35"});
    					} else {
                            res.send(200,{fromusrid:fromusrid});
						}
    				})
        		}else{
        			Serviceflow.update(
        				{
        					fromusrid:req.param('fromusrid'),
        					touser:touser,
        				},
        				{
        					fromusrid:req.param('fromusrid'),
        					touser:touser,
        					tousrid:req.param('tousrid'),
        					sex:req.param('sex'),
        					provalname:req.param('provalname'),
        					politicalstatus:req.param('politicalstatus'),
        					nation:req.param('nation'),
        					provaldoc:req.param('provaldoc'),
        					provalstatus:req.param('provalstatus')
        				}
    				).exec(function(err,org){
    					if(err){
    						res.send(500,{error:"网络错误59"});
    					} else{
                            res.send(200,org);
						}
    				})
        		}
        	}
        })
    },
	

    delete: function (req, res) {
    	var customerid = req.param('customerid');
    	var deluserid = req.param('deluserid');
    	//判断是否为管理员操作
    	UserProfile.findOne({usrid:customerid}).exec(function(err,finn){
			if(err){
				res.send(500, { error: "服务器发生异常" });
			}
			if(!finn){
				res.send(200, { error: "您不是管理员" });
			}else if(finn.isadmin == "true" || finn.isadmin == true){
				Serviceflow.find({fromusrid:deluserid}).exec(function(err,finn){
					if(err){
						res.send(500, { error: "服务器发生异常" });
					}
					if(finn){
						Users.destroy({fromusrid:deluserid}).exec(function(err,org){
							if(err){
								res.send(500, { error: "服务器发生异常" });
							}
							res.send(200, { org: "删除申请成功" });
						})
					}
				})
			}
		})
        res.send(200, "临时成功");
    },
    
    updatestatus:function(req,res){
    	var fromusrid = req.param('fromusrid');
    	var tousrid = req.param('tousrid');
    	var provalstatus = req.param('provalstatus');
    	var reasons = req.param('reasons');
    	Serviceflow.findOne(
    		{
    			fromusrid:fromusrid,
    			tousrid:tousrid
    		}
		).exec(function(err,finn){
			if(err){
				res.send(500, { error: "服务器发生异常" });
			}
			if(finn && finn.id){
				Serviceflow.update(
					{
		    			fromusrid:fromusrid,
		    			tousrid:tousrid
			    	},
			    	{
		    			fromusrid:fromusrid,
		    			tousrid:tousrid,
		    			provalstatus:provalstatus,
		    			reasons:reasons
		    		}
				).exec(function(err,org){
					if(err){
						res.send(200, { error: "服务器发生异常" });
					}else{
						res.send(200, { org: org });
					}
				})
			}
		})
    },
    
    updateservicefilename:function(req,res){
    	var fromusrid = req.param('fromusrid');
        Serviceflow.findOne({
        	fromusrid:fromusrid
        }).exec(function(err,finn){
        	if(err){
				res.send(500, { error: "服务器发生异常" });
			}else if(finn){
				Serviceflow.update(
					{
		    			fromusrid:fromusrid,
			    	},
			    	{
		    			fromusrid:fromusrid,
		    			filename:req.param('filename')
		    		}
				).exec(function(err,org){
					if(err){
						res.send(200, { error: "服务器发生异常" });
					}else{
						res.send(200, { org: org });
					}
				})
			}else{
				res.send(200,{error:"未找到个人申请"});
			}
       })
    },
	listallmyservice:function(req,res){
		var fromusrid = req.param('fromusrid');
        Serviceflow.find({
        	fromusrid:fromusrid
        }).exec(function(err,org){
        	if(err){
				res.send(500, { error: "服务器发生异常" });
			}else if(org){
				res.send(200, { org: org });
			}
		})
	},
	listonemyservice:function(req,res){
		var fromusrid = req.param('fromusrid');
		var touser = req.param('touser');
        Serviceflow.findOne({
        	fromusrid:fromusrid,
        	touser:touser
        }).exec(function(err,org){
        	if(err){
				res.send(500, { error: "服务器发生异常" });
			}else if(org){
				res.send(200, {org:org});
			}else{
				
			}
		})
	},
	listoneotherservice:function(req,res){
		var tousrid = req.param('tousrid');
		var touser = req.param('touser');
        Serviceflow.find({
        	tousrid:tousrid,
        	touser:touser
        }).exec(function(err,org){
        	if(err){
				res.send(500, { error: "服务器发生异常" });
			}else if(org){
				res.send(200, { org: org });
			}
		})
	},
};

