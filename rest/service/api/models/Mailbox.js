/**
 * Users.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {

    attributes: {
    	id:{//是否管理员id
    		type:"STRING"
    	},
        dangweiid: {//党委收信人id
            type: 'STRING'
        },
        jiweiid: {//纪委收信人id
            type: 'STRING'
        },
        zhibuid: {//支部收信人id
            type: 'STRING'
        }

    }
};

