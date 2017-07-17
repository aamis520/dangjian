/**
 * Created by demo on 2017/3/30.
 */
module.exports = {

    attributes: {
        context:{
            type: 'STRING'
        },

        ownerid:{
            type: 'STRING'
        },
        owner: {
            model: 'goldentimestopic'
        }
    }
};