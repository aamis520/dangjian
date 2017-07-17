/**
 * Created by demo on 2017/3/29.
 */
//提示框
function notifybox(type,title,content) {
    if(content == "" || content == null || content == undefined){
        content = null;
    }
    var opts = {
        "closeButton":false,
        "debug":false,
        "positionClass":"toast-top-full-width",
        "onclick":null,
        "showDuration":"300",
        "hideDuration":"1000",
        "timeout":"1000",
        "extndedTimeout":"1000",
        "showEasing":"swing",
        "showMethod":"fadeIn",
        "hideMethod":"fadeOut"
    };
    if(type == 'error'){
        toastr.error(content,title,opts);
    }
    if(type == "info"){
        toastr.info(content,title,opts);
    }
    if(type == "warning"){
        toastr.warning(content,title,opts);
    }
    if(type == "success"){
        toastr.success(content,title,opts);
    }
}

//时间转换
function getDateDiff(dateTimeStamp){
    var curTime = new Date(dateTimeStamp);
    dateTimeStamp = curTime.getTime();
    var minute = 1000 * 60;
    var hour = minute * 60;
    var day = hour * 24;
    var month = day * 30;
    var year = month * 12;
    var now = new Date().getTime();
    var diffValue = now - dateTimeStamp;
    if(diffValue < 0){return "刚刚";}
    var yearC = diffValue/year;
    var monthC =diffValue/month;
    var weekC =diffValue/(7*day);
    var dayC =diffValue/day;
    var hourC =diffValue/hour;
    var minC =diffValue/minute;
    if(yearC>=1){
        result="" + parseInt(yearC) + "年前";
    }else if(monthC>=1){
        result="" + parseInt(monthC) + "月前";
    }else if(weekC>=1){
        result="" + parseInt(weekC) + "周前";
    }else if(dayC>=1){
        result=""+ parseInt(dayC) +"天前";
    }else if(hourC>=1){
        result=""+ parseInt(hourC) +"小时前";
    }else if(minC>=1){
        result=""+ parseInt(minC) +"分钟前";
    }else{
        result="刚刚";
    }
    return result;
}


function getDateChange(dateTimeStamp) {
    var curTime = new Date(dateTimeStamp);
    dateTimeStamp = curTime.getTime();
    var minute = 1000 * 60;
    var hour = minute * 60;
    var day = hour * 24;
    var month = day * 30;
    var year = month * 12;
    var now = new Date().getTime();
    var diffValue = now - dateTimeStamp;
    if(diffValue < 0){return "刚刚";}
    var yearC = diffValue/year;
    var monthC =diffValue/month;
    var weekC =diffValue/(7*day);
    var dayC =diffValue/day;
    var hourC =diffValue/hour;
    var minC =diffValue/minute;
    var yearT = curTime.getFullYear();
    var monthT = curTime.getMonth() + 1;
    var dayT = curTime.getDay();
    var hourT = curTime.getHours();
    var minT = curTime.getMinutes();
    var secT = curTime.getSeconds();
    if(yearC>=1){
        result="" + parseInt(yearC) + "年前";
    }else if(monthC>=1){
        result="" + parseInt(monthC) + "月前";
    }else if(weekC>=1){
        result="" + parseInt(weekC) + "周前";
    }else if(dayC>=1){
        result=""+ parseInt(dayC) +"天前";
    }else if(hourC>=1){
        result="" + getDouble(monthT) + "-" +getDouble(dayT)+" "+ getDouble(hourT)+":"+getDouble(minT);
    }else if(minC>=1){
        result="" + getDouble(monthT) + "-" +getDouble(dayT)+" "+ getDouble(hourT)+":"+getDouble(minT);
    }else{
        result="刚刚";
    }

    function getDouble(num){    //为个位数时取双补0
        var str = "" + num;
        if(str.length < 2){
            str = "0"+num;
        }
        return str;
    }
    return result;
}

//时间转成xxxx-xx-xx xx:xx:xx
function getNowDateFormat(dateTimeStamp) {
    var date = new Date(dateTimeStamp);
    var month = date.getMonth() + 1;
    var day = date.getDate();
    var hour = date.getHours();
    var minute = date.getMinutes();
    var second = date.getSeconds();
    function getDouble(num){    //为个位数时取双补0
        var str = "" + num;
        if(str.length < 2){
            str = "0"+num;
        }
        return str;
    }
    var currentdate = date.getFullYear() + "-" + getDouble(month) + "-" + getDouble(day)
        + " " + getDouble(hour) + ":" + getDouble(minute) + ":" + getDouble(second);
    return currentdate;
}

//获取当前页面参数
function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)","i");
    var r = window.location.search.substr(1).match(reg);
    if (r!=null) return (r[2]); return null;
}

//滚动到指定位置
function scrolltotarget() {
    var skipto = getUrlParam("skipto");
    if(skipto){
        if($("article[topicid='"+skipto+"']").html() == undefined){
            console.log("没找到对应的topicid")
            return;
        }
        var height = $("article[topicid='"+skipto+"']").offset().top-120;
        $("body").animate({ scrollTop: height}, 500);
    }else{
        return;
    }
}