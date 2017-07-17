/**
 * MainController
 *
 * @description :: Server-side logic for managing users
 * @help        :: See http://sailsjs.org/#!/documentation/concepts/Controllers
 */

module.exports = {
    update: function (req, res) { //将update变成只更新一条数据。
        var name = req.param("name");
        var desciption = req.param("desciption");
        Orginfo.findOrCreate({
           id:"1"
        }).exec(function (error, org){
            Orginfo.update(
                {id:"1"},
                {id:"1", name:name, desciption:desciption
                }).exec(function (error, org){
                res.send(200, {id:1});
            })
        });
    },

    get: function (req, res) { //将update变成只更新一条数据。
        Orginfo.findOrCreate({
            id:"1"
        }).exec(function (error, org){
            res.send(200, org);
        });
    },

    create: function (req, res) {
        res.send(200, "不支持");
    },

    delete: function (req, res) {
        res.send(200, "不支持");
    },

};

