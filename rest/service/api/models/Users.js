/**
 * Users.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {

    attributes: {
        loginname: {//登录名，一般为手机号。
            type: 'STRING'
        },
        password: {//用户密码
            type: 'STRING'
        }
    }
};

