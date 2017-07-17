/**
 * Serviceflow.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {

  attributes: {
      servicetype: {
          //服务单类型
          type:'STRING'
      },
      fromusrid : {
          //发起人用户ID
          type:'STRING'
      },
      tousrid : {
          //被申请人(需要处理人)用户ID
          type:'STRING'
      },
      applydate : {
          //申请时间
          type:'DATE'
      },
      provalstatus : {
          //当前状态。包括"申请中, 同意, 拒绝"
          type:'STRING'
      },
      reasons : {
          //如果拒绝，拒绝理由是什么
          type:'STRING'
      }

  }
};

