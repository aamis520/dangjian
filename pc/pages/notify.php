<?php global $requestfromdangjianapp; if(!$requestfromdangjianapp) {?>
<nav class="navbar navbar-default " role="navigation">
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
            <li>
                <a href="?page=reply">
                    消息通知
                </a>
            </li>
            <li class="active">
                <a href="?page=notify">
                    系统通知
                </a>
            </li>
		</ul>
	</div>
</nav>
<?php }?>
<section class="profile-env" style="position: relative;">
    <div class="row">
        <div class="col-sm-12">
            <section id="systemmessagelistbody" class="user-timeline-stories">
            </section>
            <section id="loadmore" class="btn btn-block btn-default" style="background: #fff;margin-top: 10px;display: none;">点击加载</section>
            <section id="nomore" class="text-center text-muted" style="margin-top:10px;font-size:14px;background: #fff;padding:10px 0;display: none;">暂无更多消息</section>
        </div>
    </div>
</section>
<script src="assets/js/publicfunction.js"></script>
<script type="text/javascript">
    $(function () {
        var count = 1;
        var limit = 10;
        $("#loadmore").click(function () {
            var skip = count * limit;
            count ++;
            initMessage(skip,limit);
        });
        initMessage(0,limit);
        function initMessage(skip,limit) {
            $.ajax({
                url: "<?php echo getapiurl('listsystemmessagesapi')?>",
                dataType: "json",
                type: "get",
                cache: false,
                data: {
                    userid:"<?php echo $_SESSION['userid']?>",
                    skip:skip,
                    limit:limit
                },
                success: function (res) {
                    if(res.messages){
                        var $html = '';
                        $.each(res.messages,function (index,value) {
                            if(value.notifytype == "system-addgroup" && value.isagree == "0"){
                                $html += '<a href="javascript:;" class="notifys showNotifyModal">';
                                $html += '<article class="timeline-story clearfix" style="margin-bottom: 0;border-bottom: 1px solid #ccc;">';
                                if(value.isread == '0'){
                                    $html += '<i class="fa-envelope" style="margin-right: 10px;color:#f00;"></i>';
                                }else{
                                    $html += '<i class="fa-envelope-o" style="margin-right: 10px;"></i>';
                                }
                                $html += '<span class="line joininorremove">';
                                $html += '<span class="joininorremove">您被移出群组：</span>';
                                $html += '<span class="text-info groupname">';
                                 $html += value.topiccontext;
                                $html += '</span>';
                                $html += '</span>';
                                $html += '<span class="line small time pull-right">';
                                $html += getDateChange(value.createdAt);
                                $html += '</span>';
                                $html += "</article>";
                                $html += '</a>';
                            }else if(value.notifytype == "system-addgroup" && value.isagree == "1"){
                                $html += '<a href="javascript:;" class="notifys showNotifyModal">';
                                $html += '<article class="timeline-story clearfix" style="margin-bottom: 0;border-bottom: 1px solid #ccc;">';
                                if(value.isread == '0'){
                                    $html += '<i class="fa-envelope" style="margin-right: 10px;color:#f00;"></i>';
                                }else{
                                    $html += '<i class="fa-envelope-o" style="margin-right: 10px;"></i>';
                                }
                                $html += '<span class="line">';
                                $html += '<span class="joininorremove">您成功加入群组：</span>';
                                $html += '<span class="text-info groupname">';
                                $html += value.topiccontext;
                                $html += '</span>';
                                $html += '</span>';
                                $html += '<span class="line small time pull-right">';
                                $html += getDateChange(value.createdAt);
                                $html += '</span>';
                                $html += "</article>";
                                $html += '</a>';
                            }
                        });
                        $("#systemmessagelistbody").append($html);
                        if(res.messages.length == limit){
                            $("#loadmore").show();
                            $("#nomore").hide();
                        }
                        if(res.messages.length < limit){
                            $("#loadmore").hide();
                            $("#nomore").show();
                        }
                        if($("#systemmessagelistbody").children().length == 0){
                            $("#nomore").show();
                        }
                    }
                },
                error: function () {
                    notifybox("error", "网络异常，请稍后重试")
                }
            })
        }
        //点击一条消息,标记为已读
        $("#systemmessagelistbody").on("click",".notifys",function () {
            var msgid = $(this).attr("msgid");
            $.ajax({
                url:"<?php echo getapiurl('readedmessageapi')?>",
                dataType:'json',
                type:'get',
                cache:false,
                data:{
                    messageid:msgid
                },
                success:function (res) {
                    console.log(res)
                },
                error:function () {
                    notifybox("error","网络异常，请稍后重试")
                }

            })
        });

        $("#systemmessagelistbody").on("click",".showNotifyModal",function () {
            $('#showNotifyModal').modal('show', {backdrop: 'static'});
            var groupname = $(this).find('.groupname').text();
            var joininorremove = $(this).find('.joininorremove').text();
            var $html = '<p class="text-center">'+joininorremove+'<span class="text-info">'+groupname +'</span></p>';
            $("#showNotifyModalBody").html($html);
        })
    })
</script>