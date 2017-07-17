/**
 * Users.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {

    attributes: {
        name: {//组织名。
            type: 'STRING'
        },
        imageurl:{//组织图片
            type: 'STRING'
        },
        descirption: {//组织描述
            type: 'STRING'
        }
    }
};

