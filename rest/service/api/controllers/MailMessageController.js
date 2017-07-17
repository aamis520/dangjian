/**
 * Created by demo on 2017/4/10.
 */
module.exports = {
    create:function (req,res) {
        var fromuserid = req.param("userid");
        var fromusername = req.param("username");
        var touserid = req.param("touserid");
        var context = req.param("context");
        var topiccontext = req.param("topiccontext");
        var isread = 0;
        var notifyid = req.param("notifyid");
        var topage = req.param("topage");
        var mailtype = req.param("mailtype");
        if(!context){
            context = "";
        }
        if(!topiccontext){
            topiccontext = "";
        }
        MailMessage.create({
            fromuserid:fromuserid,
            fromusername:fromusername,
            touserid:touserid,
            context:context,
            topiccontext:topiccontext,
            isread:isread,
            notifyid:notifyid,
            topage:topage,
            mailtype:mailtype
        }).exec(function (err,mail) {
            if(err){
                res.send(500,"error")
            }else{
                if(mail){
                    res.send(200,{mail:mail.id})
                }
            }
        })
    },

    readed:function (req,res) {
        var id = req.param("id");
        MailMessage.update(
            {id:id},
            {isread:1}
        ).exec(function (err,message) {
            if(err){
                res.send(500,"error")
            }else{
                if(message){
                    res.send(200,{status:1})
                }else{
                    res.send(200,{status:0})
                }
            }
        })
    },

    allreaded:function (req,res) {
        var userid = req.param("userid");
        MailMessage.update(
            {touserid:userid},
            {isread:1}
        ).exec(function (err,finn) {
            if(err){
                res.send(500,"error")
            }else{
                if(finn){
                    res.send(200,{status:1})
                }else{
                    res.send(200,{status:0})
                }
            }
        })
    },

    list:function (req,res) {
        var userid = req.param("userid");
        var skip = req.param("skip");
        var limit = req.param("limit");
        if(!skip) {
            skip = 0;
        }
        if(!limit){
            limit = 0;
        }
        MailMessage.find({
            where:{
                touserid:userid,
                isread:0
            },
            sort:'createdAt DESC'
        }).exec(function (err,finn) {
            if(err){
                res.send(500,"error")
            }else{
                if(finn){
                    MailMessage.find({
                        where:{
                            touserid:userid,
                            isread:0
                        },
                        skip:skip,
                        limit:limit,
                        sort:'createdAt DESC'
                    }).exec(function (err,messages) {
                        if(err){
                            res.send(500,"error")
                        }else{
                            if(messages) {
                                res.send(200,{messages:messages,count:finn.length})
                            }
                        }
                    })
                }
            }
        })
    },

    listall:function (req,res) {
        var userid = req.param("userid");
        var skip = req.param("skip");
        var limit = req.param("limit");
        if(!skip) {
            skip = 0;
        }
        if(!limit){
            limit = 0;
        }
        MailMessage.find({
            where:{
                touserid:userid
            },
            skip:skip,
            limit:limit,
            sort:'createdAt DESC'
        }).exec(function (err,messages) {
            if(err){
                res.send(500,"error")
            }else{
                if(messages) {
                    res.send(200,{messages:messages})
                }
            }

        })
    }
};