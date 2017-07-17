/**
 * ServiceflowController
 *
 * @description :: Server-side logic for managing users
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

module.exports = {

    groupdocpath: function (req, res) {
        //根据用户信息，取得ftp服务器的信息，用于文件上传，浏览下载等。
        res.send(200, "临时成功");
    },

    persondocpath: function (req, res) {
        //根据用户信息，取得ftp服务器的信息，用于文件上传，浏览下载等。
        res.send(200, "临时成功");
    },
};

