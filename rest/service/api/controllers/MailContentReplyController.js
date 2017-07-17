/**
 * Created by demo on 2017/4/10.
 */
module.exports = {
    create:function (req,res) {
        var topicid = req.param("topicid");
        var context = req.param("context");
        var ownerid = req.param("ownerid");
        var shenfen = req.param("shenfen");
        if(!shenfen){
            shenfen = ""
        }

        MailContentReply.create({
            owner:topicid,
            context:context,
            ownerid:ownerid,
            shenfen:shenfen
        }).exec(function (err,reply) {
            if(err){
                res.send(500,"error")
            }else{
                if(reply){
                    res.send(200,{reply:reply})
                }
            }
        })
    }
};