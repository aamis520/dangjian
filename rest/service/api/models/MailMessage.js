/**
 * Created by demo on 2017/4/10.
 */
module.exports = {
    fromuserid:{
        type:"STRING"
    },
    //消息发出者的名字
    fromusername:{
        type:"STRING"
    },
    //发送给用的id,
    touserid:{
        type:"STRING"
    },
    //向哪个内容回复
    replytocontext:{
        type:"STRING"
    },
    //是否已读 1，读过 0 未读
    isread:{
        type:"STRING"
    },
    //消息的id
    notifyid:{
        type:"STRING"
    },
    //消息跳转到哪个页面
    topage:{
        type:"STRING"
    },
}