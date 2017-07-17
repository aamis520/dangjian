/**
 * Created by demo on 2017/4/1.
 */
module.exports = {
    create:function (req,res) {
        var ownerid = req.param("ownerid");
        var title = req.param("title");
        var context = req.param("context");
        Notify.create({
            ownerid:ownerid,
            title:title,
            context:context
        }).exec(function (err,notify) {
            if(err){
                res.send(500,"error")
            }else{
                if(notify){
                    res.send(200,{notify:notify})
                }
            }
        })
    },
    list:function (req,res) {
        var skip = req.param("skip");
        var limit = req.param("limit");
        if(!skip){
            skip = 0;
        }
        if(!limit){
            limit = 0;
        }
        Notify.find({
            skip:skip,
            limit:limit,
            sort:'createdAt DESC'
        }).exec(function (err,notifys) {
            if(err){
                res.send(500,{error:"error"})
            }else{
                if(notifys){
                    res.send(200,{notifys:notifys})
                }
            }
        })
    },
    detail:function (req,res) {
        var id = req.param("id");
        Notify.findOne({
            id:id
        }).exec(function (err,notify) {
            console.log(notify)
            if(err){
                res.send(500,"error")
            }else{
                if(notify == undefined || notify == "undefined"){
                    res.send(200,{notify:"deleted"})
                }else{
                    UserProfile.findOne({
                        usrid:notify.ownerid
                    }).exec(function (err,userprofile) {
                        if(err){
                            res.send(500,"error")
                        }else{
                            res.send(200,{notify:notify,userprofile:userprofile})
                        }
                    })
                }
            }
        })
    },
    delete:function (req,res) {
        var notifyid = req.param("notifyid");
        Notify.destroy({
            id:notifyid
        }).exec(function (err,finn) {
            if(err){
                res.send(500,"error");
            }else{
                if(finn){
                    res.send(200,{status:1})
                }else{
                    res.send(200,{status:0})
                }
            }
        })
    }
}