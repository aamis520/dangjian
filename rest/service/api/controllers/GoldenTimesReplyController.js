/**
 * MainController
 *
 * @description :: Server-side logic for managing users
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

module.exports = {
    create:function (req,res) {
        var topicid = req.param("topicid");
        var context = req.param("context");
        var ownerid = req.param("ownerid");

        GoldenTimesReply.create({
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

