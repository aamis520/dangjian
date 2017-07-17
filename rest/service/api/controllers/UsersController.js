/**
 * UsersController
 *
 * @description :: Server-side logic for managing users
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

module.exports = {

	create: function(req, res) {
		var ownerid = req.param("ownerid");

		//todo , 判断ownerid是否为管理员

		var userrealname = req.param("userrealname");
		var userloginname = req.param("userloginname");
		var phonenumber = req.param("phonenumber");
		var sex = req.param("sex");
		var picurl = req.param("picurl");
		var appartment = req.param("appartment");
		var zhiwei = req.param("zhiwei");
		var isadmin = false;
		var birthday = req.param('birthday');
		var live = "1";
		var capability = req.param('capability');
		Users.findOne({
			loginname: userloginname
		}).exec(function(err, usr) {
			if(err) {
				res.send(500, { error: "服务器发生异常" });
			} else {
				if(usr) {
					res.send(400, { error: "用户名已存在" });
				} else {
					Users.create({
						loginname: userloginname,
						defaultpassword: "123456",
						isadmin: "false",
						picurl:"avatar/default.png"
					}).exec(function(err, created) {
						if(err) {
							res.send(500, { error: "服务器发生异常" });
						} else {
							UserProfile.findOrCreate({
								usrid: created.id,
							}).exec(function(error, org) {
								UserProfile.update({ usrid: created.id }, {
									usrid: created.id,
									userrealname: userrealname,
									phonenumber: phonenumber,
									sex: sex,
									appartment: appartment,
									zhiwei: zhiwei,
									picurl:"avatar/default.png",
									birthday:birthday,
									live:live,
									isadmin:isadmin,
									capability:""
								}).exec(function(error, org) {
									if(error){
										res.send(200, {error:"未知错误"});
									}else{
										res.send(200, org);
									}
								})
							});
						}
					});
				}
			}
		});

	},

	
	alluser: function(req, res) {
		res.send(200, "delete 临时成功");
	},

	delete: function(req, res) {
		var userid = req.param("userid");
		Users.destroy({
			id: userid
		}).exec(function(err, usr) {
			if(err) {
				res.send(500, { error: "服务器发生异常" });
			}else if(usr){
				UserProfile.findOne({usrid:userid}).exec(function(err,finn){
					if(err){
						res.send(200, { error: "服务器发生异常" });
					}else if(finn){
						UserProfile.update({usrid:userid},{usrid:userid,live:0})
						.exec(function(err,org){
							if(err){
								res.send(200, { error: "服务器发生异常" });
							}else{
								res.send(200, { sucess: "true" });
							}
						})
					}
				})
			}
		})
	},
	
};