/**
 * MainController
 *
 * @description :: Server-side logic for managing users
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

module.exports = {
    create:function (req,res){
        var ownerid = req.param("ownerid");
        var context = req.param("context");
        var togroupid = req.param("togroupid");
        var touserids = req.param("touserids");
        var toall = req.param("toall");
        var allowreply = false;
        var zannum = 0;
        var replynum = 0;
        if(req.param("allowreply")){
            allowreply = req.param("allowreply");
        }
        if(togroupid == "" || togroupid == undefined || togroupid == "undefined"){
            togroupid = ""
        }
        if(touserids == "" || touserids == undefined || touserids == "undefined"){
            touserids = [];
        }
        Topic.create({
            ownerid:ownerid,
            context:context,
            allowreply:allowreply,
            zannum:zannum,
            replynum:replynum,
            togroupid:togroupid,
            touserids:touserids,
            toall:toall
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
        Topic.findOne({
            id:topicid
        }).exec(function (error,topic) {
            var replynumber = Number(topic.replynum) + 1;
            Topic.update(
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
        Topic.findOne({
            id:topicid
        }).exec(function (error,topic) {
            var zannumber = Number(topic.zannum) + 1;
           Topic.update(
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
        UserGroup.find({
            users : {
                'contains' : userid
            }
        }).exec(function (err,finn) {
            if(err){
                res.send(500,"error");
            }else{
                if(finn){
                    var groupid = [];
                    for(var idx in finn){
                        groupid.push(finn[idx].id)
                    }
                    Topic.find({
                        or : [
                            { toall:"1" },
                            { ownerid : userid },
                            { touserids: { 'contains' : userid} },
                            { togroupid: groupid }
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
                }
            }
        });
    },

    listone:function (req,res) {
        var topicid = req.param("topicid");
        Topic.findOne({
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

