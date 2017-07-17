/**
 * Created by demo on 2017/4/10.
 */
module.exports = {
    attributes: {
        //用户id
        ownerid: {
            type: "STRING"
        },
        toid:{
            type: "STRING"
        },
        //内容
        context: {
            type: "STRING"
        },
        //发送类型
        mailtype:{
            type: "STRING"
        },
        //联表查询
        reply: {
            collection: 'mailcontentreply',
            via: 'owner'//owner是外键，你完全可以自定义
        }
    }
};
