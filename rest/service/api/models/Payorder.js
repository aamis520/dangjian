/**
 * Payorder.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/documentation/concepts/models-and-orm/models
 */

module.exports = {

  attributes: {
	orderID: {
		//订单号。
        type:'STRING'
    },  
    usrid: {
		//付款用户ID
        type:'STRING'
    },
    usrname: {
		//付款用户姓名
        type:'STRING'
    },
	paymenttype: {
		//付款类型
        type:'STRING'
    },
	paymentaccount: {
		//付款账户
        type:'STRING'
    },
	payment: {
		//付款金额
        type:'STRING'
    }
  }

};

