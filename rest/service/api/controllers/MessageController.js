/**
 * Created by demo on 2017/4/6.
 */
module.exports = {
    create:function (req,res) {
        var isread = 0;
        var isagree = req.param("isagree");
        var fromuserid = req.param("userid");
        var fromusername = req.param("username");
        var touserids = req.param("touserids");
        var touserid = req.param("touserid");
        var togroupid = req.param("togroupid");
        var togroupname = req.param("togroupname");
        var context = req.param("context");
        var topiccontext = req.param("topiccontext");
        var istoall = req.param("toall");
        var notifytype = req.param("notifytype");
        var noitifyid = req.param("notifyid");
        var topage = req.param("topage");
        if(!touserid){
             touserid = "";
        }
        if(touserids == "" || touserids == undefined || touserids == "undefined" ){
            touserids = [];
        }
        if(!istoall){
             istoall = 0;
        }
        if(!isagree){
             isagree = 0;
        }
        if(!togroupid){
             togroupid = "";
        }
        if(!noitifyid){
            noitifyid = "";
        }
        if(!topage){
            topage = "";
        }
        if(!fromusername){
            fromusername = "";
        }
        if(!togroupname){
            togroupname = "";
        }
        if(!context){
            context = "";
        }
        if(!topiccontext){
            topiccontext = "";
        }


        // 发给单个人的
        if(istoall == 0 && touserid){
            Message.create({
                fromuserid:fromuserid,
                fromusername:fromusername,
                touserid:touserid,
                notifyid:noitifyid,
                notifytype:notifytype,
                togroupname:togroupname,
                context:context,
                isread:isread,
                isagree:isagree,
                topage:topage,
                topiccontext:topiccontext
            }).exec(function (err,message) {
                if(err){
                    res.send(500,"error")
                }else{
                    if(message && message.id){
                        res.send(200,{status:1})
                    }else{
                        res.send(200,{status:0})
                    }
                }
            })
        }
        //发送给全部的
        if(istoall == 1){
//          console.log('toall')
            UserProfile.find({
            }).exec(function (err,userprofiles) {
                if(err){
                    res.send(500,"error");
                }else{
                    if(userprofiles){
                        for(var index in userprofiles){
                            if(userprofiles[index].usrid == fromuserid){
                                continue;
                            }
                            Message.create({
                                fromuserid:fromuserid,
                                fromusername:fromusername,
                                touserid:userprofiles[index].usrid,
                                notifyid:noitifyid,
                                notifytype:notifytype,
                                togroupname:togroupname,
                                context:context,
                                isread:isread,
                                isagree:isagree,
                                topage:topage,
                                topiccontext:topiccontext
                            }).exec(function (err,message) {
                                if(err){
                                    res.send(500,"error")
                                }else{
                                    if(message && message.id){

                                    }else{

                                    }
                                }
                            })
                        }
                    }
                }
            })
        }
        //发送给group的
        if(istoall == 0 && togroupid){
            UserGroup.findOne({
                id:togroupid
            }).exec(function (err,usergroup) {
                if(err){
                    res.send(500,"error")
                }else {
                    if(usergroup && usergroup.users){
                        var touserarr = usergroup.users.split(",");
                       for(var idx in touserarr){
                           if(touserarr[idx] == fromuserid){
                               continue;
                           }
                           Message.create({
                               fromuserid:fromuserid,
                               fromusername:fromusername,
                               touserid:touserarr[idx],
                               notifyid:noitifyid,
                               notifytype:notifytype,
                               togroupname:togroupname,
                               context:context,
                               isread:isread,
                               isagree:isagree,
                               topage:topage,
                               topiccontext:topiccontext
                           }).exec(function (err,message) {
                               if(err){
                                   res.send(500,"error")
                               }else{
                                   if(message && message.id){

                                   }else{
                                   }
                               }
                           })
                       }
                    }
                }
            })
        }
        //发给指定人员的
        if(istoall == 0 && !togroupid && touserids != []){
//          console.log('touserids');
            for(var idx in touserids){
                Message.create({
                    fromuserid:fromuserid,
                    fromusername:fromusername,
                    touserid:touserids[idx],
                    notifyid:noitifyid,
                    notifytype:notifytype,
                    togroupname:togroupname,
                    context:context,
                    isread:isread,
                    isagree:isagree,
                    topage:topage,
                    topiccontext:topiccontext
                }).exec(function (err,message) {
                    if(err){
                        res.send(500,"error")
                    }else{
                        if(message && message.id){

                        }else{

                        }
                    }
                })
            }
        }
    },

    readed:function (req,res) {
        var messageid = req.param("messageid");
        Message.update(
            {id:messageid},
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
        Message.update(
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

    //列出未读的
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
        Message.find({
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
                    Message.find({
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

    // 列出所有的
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
        Message.find({
            where:{
                touserid:userid
            },
            sort:'createdAt DESC'
        }).exec(function (err,finn) {
            if(err){
                res.send(500,"error")
            }else{
                if(finn){
                    Message.find({
                        where:{
                            touserid:userid,
                            notifytype:{ '!' : ['system-addgroup'] }
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
    listsystemmessages:function (req,res) {
        var userid = req.param("userid");
        var skip = req.param("skip");
        var limit = req.param("limit");
        if(!skip) {
            skip = 0;
        }
        if(!limit){
            limit = 0;
        }
        Message.find({
            where:{
                touserid:userid,
                notifytype:{'like':'%条件'}
            },
            sort:'createdAt DESC'
        }).exec(function (err,finn) {
            if(err){
                res.send(500,"error")
            }else{
                if(finn){
                    Message.find({
                        where:{
                            touserid:userid,
                            notifytype:{'startsWith':'system-'}
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
            }
        })
    }

};
