/**
 * Users.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {

    attributes: {
    	approvalid:{//是否管理员id
    		type:"STRING"
    	},
        jijishenpiid: {//积极分子审批人id
            type: 'STRING'
        },
        yubeishenpiid: {//预备党员审批人id
            type: 'STRING'
        },
        zhengshishenpiid: {//正式党员申请人id
            type: 'STRING'
        }

    }
};



