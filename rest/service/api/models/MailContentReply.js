/**
 * Created by demo on 2017/4/10.
 */
module.exports = {
    attributes: {
        context:{
            type: 'STRING'
        },
        ownerid:{
            type: 'STRING'
        },
        //发送者的身份
        shenfen:{
            type: 'STRING'
        },
        owner: {
            model: 'mailcontenttopic'
        }
    }
};