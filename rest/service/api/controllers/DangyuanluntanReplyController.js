/**
 * Created by demo on 2017/3/30.
 */

module.exports = {
    create:function (req,res) {
        var topicid = req.param("topicid");
        var context = req.param("context");
        var ownerid = req.param("ownerid");

        DangyuanluntanReply.create({
            owner:topicid,
            context:context,
            ownerid:ownerid
        }).exec(function (err,reply) {
            if(err){
                res.send(500,"error")
            }else{
                if(reply){
                    res.send(200,{id:reply.id})
                }
            }
        })
    }
};

