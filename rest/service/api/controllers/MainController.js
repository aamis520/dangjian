/**
 * MainController
 *
 * @description :: Server-side logic for managing users
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

module.exports = {

    signup: function (req, res) {
        var username = req.param("username");
        var password = req.param("password");
        Users.findOne({
            name: username
        }).exec(function (err, finn) {
            if (err) {
                res.send(500, { error: "服务器发生异常" });
            } else {
                if (finn ) {
                    res.send(200, { error: "您输入的用户登录名已存在，不能重复注册" });
                } else {
                    Users.create({name:username, password:password}).exec(function (err, record) {
                        if (err) {
                            res.send(500, "服务器发生异常");
                        } else {
	                        UserProfile.create({
		                    	name:username,
		                    	password:password,
		                    	tel:tel,
		                    	sex:sex,
		                    }).exec(function(err,finn){
		                    	if(err){
		                    		res.send();
		                    	}else{
		                            res.send(200, {"userid":record.id});
		                    	}
		                    });
                        }
                    });
                    
                }
            }
        });
    },

    //登录后需要返回的数据中包括一个token,token需要用base64进行编码，结果中包含
    //1. 用户登录名。2. 密码。3.用户姓名 4. 用户头像。

    login: function (req, res) {
        var username = req.param("loginname");
        var password = req.param("password");
        Users.findOne({
            loginname: username
        }).exec(function (err, usr) {
            if (err) {
                res.send(500, { error: "服务器发生异常" });
            } else {
                if (usr) {
                    if (password == usr.password) {
                        UserProfile.findOne({
                            usrid:usr.id
                        }).exec (function (err, usprof){
                            res.send(200,
                                {
                                    userid:usr.id,
                                    userkey:generatetoken(usr, usprof),
                                    userrealname:usprof.userrealname,
                                    phonenumber:usprof.phonenumber,
                                    picurl:usprof.picurl,
                                    sex:usprof.sex,
                                    appartment:usprof.appartment
                                });
                        });
                        return;
                    } else {
                        if (!usr.password) {
                            if (password == usr.defaultpassword) {
                                UserProfile.findOne({
                                    usrid: usr.id
                                }).exec(function (err, usprof) {
                                    res.send(200,
                                        {
                                            userid: usr.id,
                                            userkey: generatetoken(usr, usprof),
                                            userrealname: usprof.userrealname,
                                            phonenumber: usprof.phonenumber,
                                            picurl: usprof.picurl,
                                            sex: usprof.sex,
                                            appartment: usprof.appartment
                                        });
                                    return;
                                })
                            } else {
                                res.send(200, {error: "您的密码是错误的，请验证后重新输入"});
                            }
                        }else {
                            res.send(200, {error: "您的密码是错误的，请验证后重新输入"});
                        }
                    }
                } else {
                    res.send(200, { error: "您输入的用户名不存在" });
                }
            }
        });
    },
	
	//修改密码
    resetpassword: function (req, res) {
        var usrid = req.param("userid");
        var oldpassword = req.param("oldpassword");
        var newpassword = req.param("newpassword");
        Users.findOne({
            id: usrid
        }).exec(function (err, usr) {
            if (err) {
                res.send(500, { error: "服务器发生异常" });
            } else {
//                 sails.log.debug(usr);
                if (usr) {
                	if(oldpassword =="" || newpassword == ""){
                		res.send(200,{error:"密码不得为空！"});
                		
                	}else{
                		if (oldpassword == usr.password || oldpassword == usr.defaultpassword) {
	                        Users.update({id:usrid},{password:newpassword})
	                        	.exec(function(err, org){
		                        	res.send(200, {usrid:usr.id});
	                        	});
	                    }else {
	                        res.send(200, { error: "输入的旧密码不对，请重新检查" });
	                    }
                	}
					
                } else {
                    res.send(200, { error: "您输入的用户并不存在" });
                }
            }
        });
    },
	
	//重置密码
	chongzhipassword:function(req,res){
		var customerid = req.param('customerid'),
			usrid = req.param('usrid');
		//判断是否为管理员操作
		UserProfile.findOne({usrid:customerid}).exec(function(err,finn){
			if(err){
				res.send(500, { error: "服务器发生异常" });
			}
			if(!finn){
				res.send(200, { error: "您不是管理员" });
			}else if(finn.isadmin == "true" || finn.isadmin == true){
				Users.findOne({id:usrid}).exec(function(err,finn){
					if(err){
						res.send(500, { error: "服务器发生异常" });
					}
					if(finn){
						Users.update({id:usrid},{id:usrid,password:"123456"}).exec(function(err,org){
							if(err){
								res.send(500, { error: "服务器发生异常" });
							}else{
								res.send(200, { org: "密码重置成功" });
							}
						})
					}
				})
			}
		})
	}

};

function generatetoken(user, userprof){
    key = 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
    var data = user.loginname + "|" + user.password + "|" + userprof.userrealname +"|" + userprof.picurl;
    // var cipher = crypto.createCipher('aes-256-cbc', key);
    // cipher.update(data, 'binary', 'base64');
    return new Buffer(data).toString("base64").replace(/\//g, '_').replace(/\+/g, '-');
}

