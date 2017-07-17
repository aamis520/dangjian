/**
 * Created by demo on 2017/4/5.
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
            model: 'zhuantidiscusstopic'
        }
    }
}