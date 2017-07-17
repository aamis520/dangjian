/**
 * MailContent
 *
 * @description :: Server-side logic for managing users
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

module.exports = {

//  update: function (req, res) { //将update变成只更新一条数据。
//      var dangwei = req.param("dangwei");
//      var jiwei = req.param("jiwei");
//      var zhibu = req.param("zhibu");
//      Mailbox.findOrCreate({
//          id:1
//      }).exec(function (error, org){
//          Mailbox.update(
//              {id:1},
//              {id:1, dangwei:dangwei, jiwei:jiwei,zhibu:zhibu
//              }).exec(function (error, org){
//                  res.send(200, {id:1});
//          })
//      });
//  },
//	
//	get: function (req, res) { //将update变成只更新一条数据。
//      Mailbox.findOrCreate({
//          id:1
//      }).exec(function (error, org){
//          res.send(200, org);
//      });
//  },
    create: function (req, res) {
        var usrid = req.param('usrid');
        var sendmail = req.param('sendmail');
        var acceptmail = req.param('acceptmail');
        var sendcontent = req.param('sendcontent');
        var sendtitle = req.param('sendtitle');
        var acceptperson = req.param('acceptperson');
        MailContent.findOrCreate(
        	{
        		usrid:usrid,
        		sendmail:sendmail,
        		acceptmail:acceptmail,
        		sendtitle:sendtitle,
        		acceptperson:acceptperson,
        		sendcontent:sendcontent
        	}
    	).exec(function(err,finn){
    		if(err){
    			res.send(500,{error:"网络错误"});
    		}
    		if(finn){
    			res.send(200,{error:"不可发送相同内容的邮件"});
    		}
    		else{
    			 MailContent.create(
    			 	{
    			 		usrid:usrid,
		        		sendmail:sendmail,
		        		acceptperson:acceptperson,
		        		sendtitle:sendtitle,
		        		acceptmail:acceptmail,
		        		sendcontent:sendcontent
    			 	}
			 	).exec(function(err,created){
			 		if(err){
			 			res.send(200,{error:"未知错误"});
			 		}
			 		MailContent.update(
			 			{
			 				usrid:usrid,
			        		sendmail:sendmail,
			        		acceptperson:acceptperson,
			        		sendtitle:sendtitle,
			        		acceptmail:acceptmail,
			        		sendcontent:sendcontent
			 			},
			 			{
			 				usrid:usrid,
			 				mailid:created.id,
			        		sendmail:sendmail,
			        		acceptperson:acceptperson,
			        		sendtitle:sendtitle,
			        		acceptmail:acceptmail,
			        		sendcontent:sendcontent
			 			}
		 			).exec(function(err,org){
		 				res.send(200,{org:org});
		 			})
			 	})
    		}
    	})
    },

    delete: function (req, res) {
        res.send(200, "不支持");
    },

};