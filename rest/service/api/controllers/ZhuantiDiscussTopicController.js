/**
 * Created by demo on 2017/4/5.
 */

module.exports = {
    create:function (req,res){
        var ownerid = req.param("ownerid");
        var context = req.param("context");
        var allowreply = false;
        var zannum = 0;
        var replynum = 0;
        if(req.param("allowreply")){
            allowreply = req.param("allowreply");
        }
        ZhuantiDiscussTopic.create({
            ownerid:ownerid,
            context:context,
            allowreply:allowreply,
            zannum:zannum,
            replynum:replynum
        })
        .exec(function (err,topic) {
            if(err){
                res.send(500,"error")
            }else{
                if(topic){
                    res.send(200,{id:topic.id})
                }
            }
        })
    },
    //更新replynum的数量
    updatereplynum:function (req,res) {
        var topicid = req.param("topicid");
        ZhuantiDiscussTopic.findOne({
            id:topicid
        }).exec(function (error,topic) {
            var replynumber = Number(topic.replynum) + 1;
            ZhuantiDiscussTopic.update(
                {id:topicid},
                {replynum:replynumber}
            ).exec(function (err,finn) {
                if(err){
                    res.send(500,"error")
                }else{
                    if(finn){
                        res.send(200,{result:true})
                    }else{
                        res.send(200,{result:false})
                    }

                }
            })
        })
    },
    //点赞
    updatezannum:function (req,res) {
        var topicid = req.param("topicid");
        ZhuantiDiscussTopic.findOne({
            id:topicid
        }).exec(function (error,topic) {
            var zannumber = Number(topic.zannum) + 1;
            ZhuantiDiscussTopic.update(
                {id:topicid},
                {zannum:zannumber}
            ).exec(function (err,finn) {
                if(err){
                    res.send(500,"error")
                }else{
                    if(finn){
                        res.send(200,{result:true})
                    }else{
                        res.send(200,{result:false})
                    }

                }
            })
        })

    },

    list:function (req,res) {
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
        ZhuantiDiscussTopic.find({
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
        ZhuantiDiscussTopic.findOne({
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

