
<section class="profile-env" style="position: relative;">
        <h4>公告</h4>
    <!--            notifys-->
    <section id="notifys" class="user-timeline-stories">
    </section>
    <!--            loadmore-->
    <section id="loadmore" class="btn btn-block btn-default" style="background: #fff;display: none;">点击加载</section>
    <section id="nomore" class="text-center text-muted" style="font-size:14px;background: #fff;padding:10px 0;display: none;">暂无更多消息</section>

</section>
<script src="assets/js/publicfunction.js"></script>
<script type="text/javascript">
    $(function () {
        //notify每次加载多少条
        var limit = 10;
        //页面初始化加载
        init(0,limit);

        //点击加载更多
        //点击次数
        var $loadcount = 1;
        $("#loadmore").click(function () {
            var skip = $loadcount * limit;
            init(skip,limit);
            $loadcount++;
        });
    })
    //初始化加载
    function init(skip,limit) {
        $.ajax({
            url:"<?php echo getapiurl('listnotifyapi')?>",
            dataType:"json",
            cache:false,
            type:"get",
            data:{
                ownerid:"<?php echo $_SESSION['userid']?>",
                skip:skip,
                limit:limit
            },
            success:function (res) {
                if(res && res.notifys){
                    var $html = "";
                    $.each(res.notifys,function (index,notify) {
                        $html += '<article class="eachnotify timeline-story" style="display: none;" notifyid="'+ notify.id+'">';
                        $html += '<input type="hidden" class="notifyid" name="notifyid" value="'+ notify.id +'">';
                        $html += '<input type="hidden" class="ownerid" name="ownerid" value="'+ notify.ownerid +'">';
                        $html += '<i class="fa-paper-plane-empty block-icon"></i>';
                        $html += '<header>';
                        $html += '<div class="user-details clearfix">';
                        $html += '<p class="pull-left"></p>';
                        $html += '<p class="pull-right">'+getNowDateFormat(notify.createdAt)+'</p>';
                        $html += '</div>';
                        $html += '</header>';
                        $html += '<h4 class="text-center">' + notify.title + '</h4>';
                        $html += '<div>' + notify.context + '</div>';
                        $html += '</article>';
                    });
                    $("#notifys").append($html);
                    $(".eachnotify").fadeIn(1000);
//                    判断消息条数少于指定的加载条数，notify加载更多按钮不显示
                    if(res.notifys.length < limit ){
                        $("#loadmore").hide();
                        $("#nomore").show();
                    }
                    if(res.notifys.length == limit ){
                        $("#loadmore").show();
                        $("#nomore").hide();
                    }

                }
            },
            error:function () {
                console.log('失败了')
            }
        });
    }
</script>