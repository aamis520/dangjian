/**
 * Created by demo on 2017/4/10.
 */
module.exports = {
    create:function (req,res) {
        var ownerid = req.param("ownerid");
        var toid = req.param("toid");
        var context = req.param("context");
        var mailtype = req.param("mailtype");
        MailContentTopic.create({
            ownerid:ownerid,
            toid:toid,
            context:context,
            mailtype:mailtype
        }).exec(function (err,topic) {
            if(err){
                res.send(500,"error");
            }else{
                if(topic && topic.id){
                    res.send(200,{topic:topic})
                }
            }
        })
    },
    list:function (req,res) {
        var userid = req.param("userid");
        var topicskip = req.param("topicskip");
        var topiclimit = req.param("topiclimit");
        var replyskip = req.param("replyskip");
        var replylimit = req.param("replylimit");
        if(!topiclimit){
            topiclimit = 0;
        }
        if(!topicskip){
            topicskip = 0;
        }
        if(!replylimit){
            replylimit = 0;
        }
        if(!replyskip){
            replyskip = 0;
        }

        MailContentTopic.find({
            or : [
                { ownerid : userid },
                { toid : userid }
            ],
            skip:topicskip,
            limit:topiclimit,
            sort:'createdAt DESC'
        })
        .populate("reply",{
            skip:replyskip,
            limit:replylimit,
            sort:'createdAt DESC'
        })
        .exec(function (err,topics) {
            if(err){
                res.send(500,"error")
            }else{
                if(topics){
                    //建一个数组保存每次查出的ownerid
                    var owneridarr = [];
                    var userprofilesarr = {};
                    for(var topic in topics) {
                        owneridarr.push(topics[topic].ownerid);
                        for(var reply in topics[topic].reply){
                            owneridarr.push(topics[topic].reply[reply].ownerid);
                        }
                    }
                    UserProfile.find({
                        usrid:owneridarr
                    }).exec(function (err,userprofiles) {
                        if(err){
                            res.send(500,"error");
                        }else {
                            for(var index in userprofiles){
                                userprofilesarr[userprofiles[index].usrid] = userprofiles[index];
                            }
                            res.send(200,{topics:topics,userprofiles:userprofilesarr});
                        }
                    })
                }
            }
        })
    },
    listone:function (req,res) {
        var topicid = req.param("topicid");
        MailContentTopic.findOne({
            id:topicid
        }).populate("reply",{
            sort:'createdAt DESC'
        })
        .exec(function (err,topics) {
            if(err){
                res.send(500,"error")
            }else{
                if(topics){
                    //建一个数组保存每次查出的ownerid
                    var owneridarr = [];
                    var userprofilesarr = {};
                    owneridarr.push(topics.ownerid);
                    for(var reply in topics.reply){
                        owneridarr.push(topics.reply[reply].ownerid);
                    }

                    UserProfile.find({
                        usrid:owneridarr
                    }).exec(function (err,userprofiles) {
                        if(err){
                            res.send(500,"error");
                        }else {
                            for(var index in userprofiles){
                                userprofilesarr[userprofiles[index].usrid] = userprofiles[index];
                            }
                            res.send(200,{topics:topics,userprofiles:userprofilesarr});
                        }
                    })
                }
            }
        })
    }
};