/**
 * Users.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {

  attributes: {
      messagetype: {
          //通知类型，包括:"系统通知, 组通知,用户通知"
            type:'STRING'
      },
      fromid: {
          //发起人
          type:'STRING'
      },
      toids:{
          //通知给谁. 可以是一个人,也可以是一个组.
          type:'STRING'
      },
      totype:{
          //通知类型 "Group", "Persons"
        type:'STRING'
      },
      content:{
          //通知内容
          type:'STRING'
      },
      whoread:{
          //读过的用户的ursid
          type:'STRING'
      }

  }
};

