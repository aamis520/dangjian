/**
 * Created by demo on 2017/3/28.
 */
module.exports = {

    attributes: {
        //作者id
        ownerid: {
            type: 'STRING'
        },
        context: {
            type: 'STRING'
        },
        //是否允许回复
        allowreply:{
            type: 'STRING'
        },
        //赞数量
        zannum:{
            type: 'STRING'
        },
        //回复数量
        replynum:{
            type: 'STRING'
        },
        //谁可读
        togroupid:{
            type: 'STRING'
        },
        //谁可读,数组
        touserids:{

        },
        //是否所有人可读
        toall:{
            type: 'STRING'
        },
        //联表查询
        reply: {
            collection: 'reply',
            via: 'owner'//owner是外键，你完全可以自定义
        }
    }
};