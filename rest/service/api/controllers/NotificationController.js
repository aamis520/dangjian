/**
 * MainController
 *
 * @description :: Server-side logic for managing users
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

module.exports = {

    send: function (req, res) {
        var fromid = req.param("fromid");//当前用户的id
        var toids = req.param("toids");
        var totype = req.param("totype");
        var messagetype = req.param("messagetype");
        var content = req.param("content");
        Notification.create({
            fromid:fromid,
            toids:toids,
            totype:totype,
            messagetype:messagetype,
            content:content
        }).exec(function (err, item) {
          if(err){
              res.send(500, "内部错误");
          }else{
              res.send(200,{id:item.id});
          }
        })
    },



    //标记所有的都为已读。
    markread: function (req, res) {
        res.send(200, "临时成功");
    },



    delete: function (req, res) {
        res.send(200, "临时成功");
    },



    getbyuser: function (req, res) {
        var usrid = req.param("usrid");
        var groupid=[];
        UserGroup.find({
            memberid: {
                "contains": usrid
            }
        }).exec(function(error, items){
            for(i in items ){
                groupid.push(i.id);
            }
        })

        Notification.find( {or:[//先找组的。
            {totype:"Group",toids:{"contain":groupid}},
            {totype:"Persons",toids:{"contain":usrid}}
        ]
        }).exec(function (err, notify) {
            if(err){
                res.send(500, "内部错误");
            }else{
                    res.send(200, composereply(usrid,notify));
                }
        })


    },



};

    function composereply(usrid, notify){
        var unreadnumber = 0;

        for(i in notify){
            if(!i.whoread.contain(usrid)){
                unreadnumber+=1
            }
        }

        return {
            unreadnumber:unreadnumber,
            notify:notify
        }
    }