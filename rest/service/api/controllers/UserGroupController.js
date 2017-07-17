/**
 * MainController
 *
 * @description :: Server-side logic for managing users
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

module.exports = {

    create: function (req, res) {
        var ownerid = req.param('ownerid');
        var description = req.param('description');
        var groupname = req.param('groupname');
        if (ownerid =='' ){//TODO, 未来需要做更严格的审查。
            res.send(200, {error:"无法创建组"});
            return;
        }

        UserGroup.findOne({
            groupname:groupname,
            ownerid:ownerid
        }).exec(function (err, finn ) {
            if (err) {
                res.send(500, {error: "服务器发生异常"});
                return;
            } else {
                if (!finn) {
                	UserGroup.create(
                		{
                			ownerid:ownerid,
                			ownername:req.param('ownername'),
                			groupname : groupname,
							groupimg:req.param('groupimg'),
							istissue:req.param('istissue'),
							fathergroup:req.param('fathergroup'),
                			description:description,
                			users:req.param('users')
                		}
                	).exec(function(err,created){
                		UserGroup.update(
                			{
                				ownerid:ownerid,
                				groupname : groupname,
                			},
                			{
                				groupid:created.id
                			}
            			).exec(function(err,org){
            				if(err){
            					res.send(200, {error: "服务器发生异常"});
            				}else{
            					res.send(200, {groupid: created.id});
            				}
            			})
                	})
                }
                else{
                    UserGroup.update(
                    	{
            				ownerid:ownerid,
            				groupname : groupname,
            			},
                    	{
                    		ownerid:ownerid,
                			ownername:req.param('ownername'),
                			groupname :groupname,
							groupimg:req.param('groupimg'),
							istissue:req.param('istissue'),
							fathergroup:req.param('fathergroup'),
                			description:description,
                			users:req.param('users')
                			
                    	}
                	).exec(function(err,org){
                		if(err){
        					res.send(200, {error: "服务器发生异常"});
        				}else{
        					res.send(200,{ownerid:ownerid});
        				}
                	})
                }
            }
        });

//      req.file('avatar').upload({//上传组头像
//          maxBytes: 400000,
//          dirname: require('path').resolve(sails.config.appPath, 'avatar')
//      },function (err, uploadedFiles) {
//          if (err) return res.negotiate(err);
//
//          return res.json({
//              message: uploadedFiles.length + ' file(s) uploaded successfully!'
//          });
//      });
    },
	listallmygroup:function(req,res){
		var ownerid = req.param('ownerid');
		UserGroup.find({
			ownerid:ownerid
		}).exec(function(err,org){
			if(err){
				res.send(500, {error: "服务器发生异常"});
			}else{
				res.send(200, {org: org});
			}
		})
	},
	listonemygroup:function(req,res){
		var groupid = req.param('groupid');
		UserGroup.find({
			groupid:groupid
		}).exec(function(err,org){
			if(err){
				res.send(500, {error: "服务器发生异常"});
			}else{
				res.send(200, {org: org});
			}
		})
	},
	listallgroup:function(req,res){
		UserGroup.find({
			
		}).exec(function(err,org){
			if(err){
				res.send(500, {error: "服务器发生异常"});
			}else{
				res.send(200, {org: org});
			}
		})
	},
	update:function(req,res){
		var ownerid = req.param('ownerid');
		var ownername = req.param('ownername');
        var groupname = req.param('groupname');
        var description = req.param('description');
        var groupimg = req.param('groupimg');
        var fathergroup = req.param('fathergroup');
        var istissue = req.param('istissue');
        var users = req.param('users');
        if (ownerid =='' ){//TODO, 未来需要做更严格的审查。
            res.send(200, {error:"无法创建组"});
            return;
        }
        UserGroup.findOne({
        	or:[
        	{
        		groupname:groupname,
        		ownerid:ownerid
        	},
        	{
        		groupid:groupid	
        	}
        	]
    	}).exec(function(err,finn){
        	if(err){
        		res.send(500, {error: "服务器发生异常"});
        	}else{
        		if(finn){
//      			sails.log.debug(finn);
        			UserGroup.update(
        				{or:[
        					{
        						groupname:groupname,
        						ownerid:ownerid
        					},
        					{
        						groupid:groupid
        					}
        				]},
        				{
	        				ownername:ownername,
	        				groupname:groupname,
	        				description:description,
	        				groupimg:groupimg,
	        				tissueid:tissueid,
	        				users:users,
	                        fathergroup:fathergroup,
	                        istissue:istissue
        				}
    				).exec(function(err,org){
        				if(err){
        					res.send(500, {error: "服务器发生异常"});
        				}else{
        					res.send(200, {org: org});
        				}
        			})	
        		}else{
        			res.send(500, {error: "群组不存在"});
        		}
        	}
        });
	},
	updategroupset:function(req,res){
		var groupid = req.param('groupid');
		var groupname = req.param('groupname');
		var description = req.param('description');
		UserGroup.findOne({
    		groupid:groupid
   		}).exec(function(err,finn){
    		if(err){
    			res.send(500,{error:"服务器错误"});
    		}else{
    			if(finn){
    				UserGroup.update({
    					groupid:groupid
    				},{
    					groupid:groupid,
    					groupname:groupname,
    					description:description
    				}
    				).exec(function(err,org){
    					if(err){
    						res.send(200, {err: "未知错误"});
    					}else{
    						res.send(200, {org: org});
    					}
    				});
    			}
    		}
    	})
	},
	
    adduser: function (req, res) {
    	var groupid= req.param('groupid');
    	var users= req.param('users');
    	UserGroup.findOne({
    		groupid:groupid
    	}).exec(function(err,finn){
    		if(err){
    			
    		}else{
    			if(finn){
    				UserGroup.update({
    					groupid:groupid
    				},{
    					groupid:groupid,
    					users:users
    				}
    				).exec(function(err,org){
    					if(err){
    						res.send(200, {err: "未知错误"});
    					}else{
    						res.send(200, {org: org});
    					}
    				});
    			}
    		}
    	});
    },
    deluser: function (req, res) {
    	var groupid= req.param('groupid');
    	var users= req.param('users');
    	UserGroup.findOne({
    		groupid:groupid
    	}).exec(function(err,finn){
    		if(err){
    			
    		}else{
    			if(finn){
    				UserGroup.update({
    					groupid:groupid
    				},{
    					groupid:groupid,
    					users:users
    				}
    				).exec(function(err,org){
    					if(err){
    						res.send(200, {err: "未知错误"});
    					}else{
    						res.send(200, {org: org});
    					}
    				});
    			}
    		}
    	});
        res.send(200, "临时成功");
    },
    
    //删除用户的时候删除群组里的用户id
    deluserfromgroup:function(req,res){
    	var usrid = req.param('usrid');
    	//删除数组指定元素 
    	//start
    	Array.prototype.remove=function(dx) 
		{ 
		  if(isNaN(dx)||dx>this.length){return false;} 
		  for(var i=0,n=0;i<this.length;i++) 
		  { 
		    if(this[i]!=this[dx]) 
		    { 
		      this[n++]=this[i] 
		    } 
		  } 
		  this.length-=1 
		};
		//end
    	UserGroup.find(
    		{}
		).exec(function(err,finn){
			if(err){
				
			}
			if(finn){
				for(var i=0;i<finn.length;i++){
					var tmp = i;
					(function(){
						var a = [];
						var newusers = finn[tmp].users;
						var groupid = finn[tmp].groupid;
						a = newusers.split(',')
						for(j=0;j<a.length;j++){
							var b = "";
							if(a[j] == usrid){
								a.remove(j);
								b= a.join(','); 
								UserGroup.update(
									{groupid:groupid},
									{
										groupid:groupid,
										users:b
									}
								).exec(function(err,org){
								})
							}
						}
					})(tmp);
					
				}
				
				res.send(200,{org:"修改成功"});
			}
		})
    },
    
    listgroupusers:function(req,res){
    	var users = req.param('users');
    	var listgroupuser = [];
    	var ss = users.split(',');
    	for(var i=0; i< ss.length;i++){
    		var temp = i;
    		(function(){
    			UserProfile.findOne({
	    			usrid:ss[temp]
	    		}).exec(function(err,finn){
	    			if(err){
	    				res.send(500,{error:"网络错误"});
	    			}
	    			if(finn.userrealname){
		    			listgroupuser.push(finn.userrealname);
	    			}
					if(listgroupuser.length == ss.length){
				    	res.send(200,{listgroupuser:listgroupuser});
					}
	    		});
    		})(temp);
    	}
    },
    
    listmyusergroup:function (req,res) {
        var userid = req.param("userid");
        UserGroup.find({
            users : {
                'contains' : userid
            }
        }).exec(function (err,finn) {
            if(err){
                res.send(500,"error");
            }else{
                if(finn){
                    res.send(200,{usergroup:finn})
                }
            }
        })
    },
    
    delusergroup:function(req,res){
    	var groupid = req.param('groupid');
    	UserGroup.findOne({groupid:groupid}).exec(function(err,finn){
    		if(err){
    			res.send(500,{error:err});
    		}
    		if(finn){
    			UserGroup.destroy({groupid:groupid}).exec(function(err,org){
    				if(err){
    					res.send(200,{error:err});
    				}else{
    					res.send(200,{org:"删除成功"});
    				}
    			})
    		}
    	})
    }

};

