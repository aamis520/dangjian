/**
 * MainController
 *
 * @description :: Server-side logic for managing users
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

module.exports = {

    update: function (req, res) {
        var usrid = req.param("usrid");
		var userrealname = req.param("name"),
			phonenumber = req.param("phonenumber"),
			sex = req.param("sex"),
			appartment = req.param("appartment"),
			zhiwei =req.param("zhiwei"),
			picurl = req.param("picurl"),
			email =req.param("email"),
			birthday = req.param("birthday"),
			capability = req.param("capability");
        UserProfile.findOrCreate({
            usrid: usrid,
        }).exec(function (error, org) {
            UserProfile.update(
                {usrid: usrid},
                {
                    usrid: usrid, 
                    userrealname: userrealname,
					phonenumber: phonenumber,
					sex: sex,
					appartment: appartment,
					zhiwei:zhiwei,
					picurl:picurl,
					email:email,
					birthday:birthday,
					capability:capability
                }).exec(function (error, org) {
                	if(error){
                		res.send(200, {error:"未知错误"});
                	}else{
                		res.send(200, {usrid:usrid});
                	}
            });
            
        });
    },
    updatecapability:function(req,res){
    	var jijishenpiid = req.param("jijishenpiid");
        var yubeishenpiid = req.param("yubeishenpiid");
        var zhengshishenpiid = req.param("zhengshishenpiid");
        var customerid = req.param("usrid");
        UserProfile.findOne({usrid:customerid}).exec(function(err,usr){
        	if(err){
        		res.send(500,{error:"服务器错误"});
        	}
        	if(usr){
        		sails.log.debug(usr);
        		UserProfile.findOne({capability:"jijiapprover"}).exec(function(err,finn){
            		if(finn){
            			//找到积极审批
            			UserProfile.update(
            				{capability:"jijiapprover"},
            				{capability:""}
            			).exec(function(err,org){
            				UserProfile.findOne({usrid:jijishenpiid}).exec(function(err,finn){
	            				UserProfile.update(
	            					{usrid:jijishenpiid},
	            					{capability:"jijiapprover"}
	        					).exec(function(err,org){
	        						//寻找预备审批人
		            				UserProfile.findOne({capability:"yubeiapprover"}).exec(function(err,finn){
					            		if(finn){
					            			UserProfile.update(
					            				{capability:"yubeiapprover"},
					            				{capability:""}
					            			).exec(function(err,org){
					            				UserProfile.findOne({usrid:yubeishenpiid}).exec(function(err,finn){
						            				UserProfile.update(
						            					{usrid:yubeishenpiid},
						            					{capability:"yubeiapprover"}
						        					).exec(function(err,org){
						        						//寻找党员审批人
						        						UserProfile.findOne({capability:"dangyuanapprover"}).exec(function(err,finn){
										            		if(finn){
										            			UserProfile.update(
										            				{capability:"dangyuanapprover"},
										            				{capability:""}
										            			).exec(function(err,org){
										            				UserProfile.findOne({usrid:zhengshishenpiid}).exec(function(err,finn){
											            				UserProfile.update(
											            					{usrid:zhengshishenpiid},
											            					{capability:"dangyuanapprover"}
											        					).exec(function(err,org){
											        						if(err){
														                		res.send(200, {error:"未知错误"});
														                	}else{
														                		res.send(200, {org:"成功"});
														                	}
												            			})
											            			})
										            			})
										            		}else{
										            			//未找到党员审批人
										            			UserProfile.findOne({usrid:zhengshishenpiid}).exec(function(err,finn){
										            				UserProfile.update(
										            					{usrid:zhengshishenpiid},
										            					{capability:"dangyuanapprover"}
										        					).exec(function(err,org){
										        						if(err){
													                		res.send(200, {error:"未知错误"});
													                	}else{
													                		res.send(200, {org:"成功"});
													                	}
											            			})
										            			})
										            		}
										            	});
							            			})
						            			})
					            			})
					            		}else{
					            			//未找到预备审批人
					            			UserProfile.findOne({usrid:yubeishenpiid}).exec(function(err,finn){
					            				UserProfile.update(
					            					{usrid:yubeishenpiid},
					            					{capability:"yubeiapprover"}
					        					).exec(function(err,org){
					        						//
					        						//寻找党员审批人
					        						UserProfile.findOne({capability:"dangyuanapprover"}).exec(function(err,finn){
									            		if(finn){
									            			UserProfile.update(
									            				{capability:"dangyuanapprover"},
									            				{capability:""}
									            			).exec(function(err,org){
									            				UserProfile.findOne({usrid:zhengshishenpiid}).exec(function(err,finn){
										            				UserProfile.update(
										            					{usrid:zhengshishenpiid},
										            					{capability:"dangyuanapprover"}
										        					).exec(function(err,org){
										        						if(err){
													                		res.send(200, {error:"未知错误"});
													                	}else{
													                		res.send(200, {org:"成功"});
													                	}
											            			})
										            			})
									            			})
									            		}else{
									            			//未找到党员审批人
									            			UserProfile.findOne({usrid:zhengshishenpiid}).exec(function(err,finn){
									            				UserProfile.update(
									            					{usrid:zhengshishenpiid},
									            					{capability:"dangyuanapprover"}
									        					).exec(function(err,org){
									        						if(err){
												                		res.send(200, {error:"未知错误"});
												                	}else{
												                		res.send(200, {org:"成功"});
												                	}
										            			})
									            			})
									            		}
									            	});
						            			})
					            			})
					            		}
					            	});
	        					})
	            			})
            			})
            		}else{
            			//未找到积极审批人
            			UserProfile.findOne({usrid:jijishenpiid}).exec(function(err,finn){
            				UserProfile.update(
            					{usrid:jijishenpiid},
            					{capability:"jijiapprover"}
        					).exec(function(err,org){
        						//寻找预备审批人
	            				UserProfile.findOne({capability:"yubeiapprover"}).exec(function(err,finn){
				            		if(finn){
				            			UserProfile.update(
				            				{capability:"yubeiapprover"},
				            				{capability:""}
				            			).exec(function(err,org){
				            				UserProfile.findOne({usrid:yubeishenpiid}).exec(function(err,finn){
					            				UserProfile.update(
					            					{usrid:yubeishenpiid},
					            					{capability:"yubeiapprover"}
					        					).exec(function(err,org){
					        						//寻找党员审批人
					        						UserProfile.findOne({capability:"dangyuanapprover"}).exec(function(err,finn){
									            		if(finn){
									            			UserProfile.update(
									            				{capability:"dangyuanapprover"},
									            				{capability:""}
									            			).exec(function(err,org){
									            				UserProfile.findOne({usrid:zhengshishenpiid}).exec(function(err,finn){
										            				UserProfile.update(
										            					{usrid:zhengshishenpiid},
										            					{capability:"dangyuanapprover"}
										        					).exec(function(err,org){
										        						if(err){
													                		res.send(200, {error:"未知错误"});
													                	}else{
													                		res.send(200, {org:"成功"});
													                	}
											            			})
										            			})
									            			})
									            		}else{
									            			//未找到党员审批人
									            			UserProfile.findOne({usrid:zhengshishenpiid}).exec(function(err,finn){
									            				UserProfile.update(
									            					{usrid:zhengshishenpiid},
									            					{capability:"dangyuanapprover"}
									        					).exec(function(err,org){
									        						if(err){
												                		res.send(200, {error:"未知错误"});
												                	}else{
												                		res.send(200, {org:"成功"});
												                	}
										            			})
									            			})
									            		}
									            	});
						            			})
					            			})
				            			})
				            		}else{
				            			//未找到预备审批人
				            			UserProfile.findOne({usrid:yubeishenpiid}).exec(function(err,finn){
				            				UserProfile.update(
				            					{usrid:yubeishenpiid},
				            					{capability:"yubeiapprover"}
				        					).exec(function(err,org){
				        						//寻找党员审批人
				        						UserProfile.findOne({capability:"dangyuanapprover"}).exec(function(err,finn){
								            		if(finn){
								            			UserProfile.update(
								            				{capability:"dangyuanapprover"},
								            				{capability:""}
								            			).exec(function(err,org){
								            				UserProfile.findOne({usrid:zhengshishenpiid}).exec(function(err,finn){
									            				UserProfile.update(
									            					{usrid:zhengshishenpiid},
									            					{capability:"dangyuanapprover"}
									        					).exec(function(err,org){
									        						if(err){
												                		res.send(200, {error:"未知错误"});
												                	}else{
												                		res.send(200, {org:"成功"});
												                	}
										            			})
									            			})
								            			})
								            		}else{
								            			//未找到党员审批人
								            			UserProfile.findOne({usrid:zhengshishenpiid}).exec(function(err,finn){
								            				UserProfile.update(
								            					{usrid:zhengshishenpiid},
								            					{capability:"dangyuanapprover"}
								        					).exec(function(err,org){
								        						if(err){
											                		res.send(200, {error:"未知错误"});
											                	}else{
											                		res.send(200, {org:"成功"});
											                	}
									            			})
								            			})
								            		}
								            	});
					            			})
				            			})
				            		}
				            	});
	            			})
            			})
            		}
            	});
        	}
        })
    },
    updateshenfen:function(req,res){
    	 var dangweiid = req.param("dangweiid");
        var jiweiid = req.param("jiweiid");
        var zhibuid = req.param("zhibuid");
        var customerid = req.param("usrid");
        UserProfile.findOne({usrid:customerid}).exec(function(err,usr){
        	if(err){
        		res.send(500,{error:"服务器错误"});
        	}
        	if(usr){
        		sails.log.debug(usr);
        		//查找党委
        		UserProfile.findOne({shenfen:"dangwei"}).exec(function(err,finn){
            		if(finn){
            			UserProfile.update(
            				{shenfen:"dangwei"},
            				{shenfen:""}
            			).exec(function(err,org){
            				UserProfile.findOne({usrid:dangweiid}).exec(function(err,finn){
	            				UserProfile.update(
	            					{usrid:dangweiid},
	            					{shenfen:"dangwei"}
	        					).exec(function(err,org){
	        						//找到纪委
	        						UserProfile.findOne({shenfen:"jiwei"}).exec(function(err,finn){
					            		if(finn){
					            			UserProfile.update(
					            				{shenfen:"jiwei"},
					            				{shenfen:""}
					            			).exec(function(err,org){
					            				UserProfile.findOne({usrid:jiweiid}).exec(function(err,finn){
						            				UserProfile.update(
						            					{usrid:jiweiid},
						            					{shenfen:"jiwei"}
						        					).exec(function(err,org){
						        						UserProfile.findOne({shenfen:"zhibu"}).exec(function(err,finn){
										            		if(finn){
										            			UserProfile.update(
										            				{shenfen:"zhibu"},
										            				{shenfen:""}
										            			).exec(function(err,org){
										            				UserProfile.findOne({usrid:zhibuid}).exec(function(err,finn){
											            				UserProfile.update(
											            					{usrid:zhibuid},
											            					{shenfen:"zhibu"}
											        					).exec(function(err,org){
											        						if(err){
														                		res.send(200, {error:"未知错误"});
														                	}else{
														                		res.send(200, {org:"成功"});
														                	}
												            			})
											            			})
										            			})
										            		}else{
										            			UserProfile.findOne({usrid:zhibuid}).exec(function(err,finn){
										            				UserProfile.update(
										            					{usrid:zhibuid},
										            					{shenfen:"zhibu"}
										        					).exec(function(err,org){
										        						if(err){
													                		res.send(200, {error:"未知错误"});
													                	}else{
													                		res.send(200, {org:"成功"});
													                	}
											            			})
										            			})
										            		}
										            	});
							            			})
						            			})
					            			})
					            		}else{
					            			UserProfile.findOne({usrid:jiweiid}).exec(function(err,finn){
					            				UserProfile.update(
					            					{usrid:jiweiid},
					            					{shenfen:"jiwei"}
					        					).exec(function(err,org){
					        						UserProfile.findOne({shenfen:"zhibu"}).exec(function(err,finn){
									            		if(finn){
									            			UserProfile.update(
									            				{shenfen:"zhibu"},
									            				{shenfen:""}
									            			).exec(function(err,org){
									            				UserProfile.findOne({usrid:zhibuid}).exec(function(err,finn){
										            				UserProfile.update(
										            					{usrid:zhibuid},
										            					{shenfen:"zhibu"}
										        					).exec(function(err,org){
										        						if(err){
													                		res.send(200, {error:"未知错误"});
													                	}else{
													                		res.send(200, {org:"成功"});
													                	}
											            			})
										            			})
									            			})
									            		}else{
									            			UserProfile.findOne({usrid:zhibuid}).exec(function(err,finn){
									            				UserProfile.update(
									            					{usrid:zhibuid},
									            					{shenfen:"zhibu"}
									        					).exec(function(err,org){
									        						if(err){
												                		res.send(200, {error:"未知错误"});
												                	}else{
												                		res.send(200, {org:"成功"});
												                	}
										            			})
									            			})
									            		}
									            	});
						            			})
					            			})
					            		}
					            	});
		            			})
	            			})
            			})
            		}else{
            			//未找到党委
            			UserProfile.findOne({usrid:dangweiid}).exec(function(err,finn){
            				UserProfile.update(
            					{usrid:dangweiid},
            					{shenfen:"dangwei"}
        					).exec(function(err,org){
        						UserProfile.findOne({shenfen:"jiwei"}).exec(function(err,finn){
				            		if(finn){
				            			UserProfile.update(
				            				{shenfen:"jiwei"},
				            				{shenfen:""}
				            			).exec(function(err,org){
				            				UserProfile.findOne({usrid:jiweiid}).exec(function(err,finn){
					            				UserProfile.update(
					            					{usrid:jiweiid},
					            					{shenfen:"jiwei"}
					        					).exec(function(err,org){
					        						UserProfile.findOne({shenfen:"zhibu"}).exec(function(err,finn){
									            		if(finn){
									            			UserProfile.update(
									            				{shenfen:"zhibu"},
									            				{shenfen:""}
									            			).exec(function(err,org){
									            				UserProfile.findOne({usrid:zhibuid}).exec(function(err,finn){
										            				UserProfile.update(
										            					{usrid:zhibuid},
										            					{shenfen:"zhibu"}
										        					).exec(function(err,org){
										        						if(err){
													                		res.send(200, {error:"未知错误"});
													                	}else{
													                		res.send(200, {org:"成功"});
													                	}
											            			})
										            			})
									            			})
									            		}else{
									            			UserProfile.findOne({usrid:zhibuid}).exec(function(err,finn){
									            				UserProfile.update(
									            					{usrid:zhibuid},
									            					{shenfen:"zhibu"}
									        					).exec(function(err,org){
									        						if(err){
												                		res.send(200, {error:"未知错误"});
												                	}else{
												                		res.send(200, {org:"成功"});
												                	}
										            			})
									            			})
									            		}
									            	});
						            			})
					            			})
				            			})
				            		}else{
				            			UserProfile.findOne({usrid:jiweiid}).exec(function(err,finn){
				            				UserProfile.update(
				            					{usrid:jiweiid},
				            					{shenfen:"jiwei"}
				        					).exec(function(err,org){
				        						UserProfile.findOne({shenfen:"zhibu"}).exec(function(err,finn){
								            		if(finn){
								            			UserProfile.update(
								            				{shenfen:"zhibu"},
								            				{shenfen:""}
								            			).exec(function(err,org){
								            				UserProfile.findOne({usrid:zhibuid}).exec(function(err,finn){
									            				UserProfile.update(
									            					{usrid:zhibuid},
									            					{shenfen:"zhibu"}
									        					).exec(function(err,org){
									        						if(err){
												                		res.send(200, {error:"未知错误"});
												                	}else{
												                		res.send(200, {org:"成功"});
												                	}
										            			})
									            			})
								            			})
								            		}else{
								            			UserProfile.findOne({usrid:zhibuid}).exec(function(err,finn){
								            				UserProfile.update(
								            					{usrid:zhibuid},
								            					{shenfen:"zhibu"}
								        					).exec(function(err,org){
								        						if(err){
											                		res.send(200, {error:"未知错误"});
											                	}else{
											                		res.send(200, {org:"成功"});
											                	}
									            			})
								            			})
								            		}
								            	});
					            			})
				            			})
				            		}
				            	});
	            			})
            			})
            		}
            	});
        	}
        })
    },
    updatepersonal: function (req, res) {
        var usrid = req.param("usrid");
		var simpleproduct = req.param("simpleproduct"),
			birthday = req.param("birthday");
        UserProfile.findOne({
            usrid: usrid,
        }).exec(function (error, org) {
            UserProfile.update(
                {usrid: usrid},
                {
                    usrid: usrid, 
                    simpleproduct: simpleproduct,
					birthday:birthday
                }).exec(function (err, org) {
                	if(err){
                		res.send(200, {error:"未知错误"});
                	}else{
                    	res.send(200, {usrid:usrid});
                	}

            });
            
        });
    },
    updatepicurl:function(req,res){
    	var usrid = req.param('usrid');
    	var picurl = req.param('picurl');
    	UserProfile.findOne({
            usrid: usrid,
        }).
        exec(function (error, org) {
            UserProfile.update(
                {usrid: usrid},
                {
                    usrid: usrid, 
					picurl:picurl,
            }).
            exec(function (error, org) {
                if(error){
            		res.send(200, {error:"未知错误"});
            	}else{
                	res.send(200, {usrid:usrid});
            	}
            });
            
        });
    },
    updateapproval:function(req,res){
    	var userrealname = req.param('userrealname');
    	var capability = req.param('capability');
    	UserProfile.findOne(
    		{capability:capability}
    	).exec(function(err,finn){
    		if(err){
    			res.send(500, { error: "服务器发生异常" });
    		}
    		if(finn){
    			UserProfile.update(
    				{capability:capability},
    				{capability:""}
				).exec(function(err,org){
					if(err){
						res.send(500, { error: "服务器发生异常" });
					}else{
						res.send(200,{org:org});
					}
				})
    		}else{
		    	UserProfile.findOne(
		    			{userrealname:userrealname}
		    	).exec(function(err,finn){
		    		if(err){
		    			res.send(500, { error: "服务器发生异常" });
		    		}else if(finn){
		    			UserProfile.update(
		    				{userrealname:userrealname},
		    				{
		    					capability:capability,
		    					userrealname:userrealname
		    				}
		    			).exec(function(err,org){
		    				if(err){
		    					res.send(200,{error:"未知错误"});
		    				}else{
		    					res.send(200,{capability:capability});
		    				}
		    			})
		    		}
		    		
		    	})
    		}
    	})
    },
    
	alluser:function(req,res){
		var live = req.param('live');
		UserProfile.find({live:live}).exec(function(err,org){
			if(err){
				res.send(500,"失败");
			}else{
				res.send(200,{org:org});
			}
		})
	}
};
