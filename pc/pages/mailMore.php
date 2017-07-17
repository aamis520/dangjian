<section class="profile-env" style="position: relative;">
    <div class="row">
        <div class="col-sm-12">
            <section id="mailmessagelistbody" class="user-timeline-stories">
            </section>
            <section id="loadmore" class="btn btn-block btn-default" style="background: #fff;margin-top: 10px;display: none">点击加载</section>
            <section id="nomore" class="text-center text-muted" style="margin-top:10px;font-size:14px;background: #fff;padding:10px 0;display: none;">到底了</section>
            <section id="nothas" class="text-center text-muted" style="margin-top:10px;font-size:14px;background: #fff;padding:10px 0;display: none;">暂无最新消息</section>
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
                url:"<?php echo getapiurl('listallmailmessageapi')?>",
                dataType:"json",
                type:"get",
                cache:false,
                data:{
                    userid:"<?php echo $_SESSION['userid']?>",
                    skip:skip,
                    limit:limit
                },
                success:function (res) {
                    if(res.messages){
                        var $html = '';
                        $.each(res.messages,function (index,value) {
                            value.context = value.context.replace(/<[^>]+>/g,"");
                            value.topiccontext = value.topiccontext.replace(/<[^>]+>/g,"");
                            if(value.mailtype == "topic"){
                                $html += '<a class="notifys" href="?page='+value.topage+'&skipto='+value.notifyid+'" msgid="'+value.id+'">';
                                $html += '<article class="timeline-story clearfix" style="margin-bottom: 0;border-bottom: 1px solid #ccc;">';
                                if(value.isread == '0'){
                                    $html += '<i class="fa-envelope" style="margin-right: 10px;color:#f00;"></i>';
                                }else{
                                    $html += '<i class="fa-envelope-o" style="margin-right: 10px;"></i>';
                                }
                                $html += '<span class="line">';
                                $html += '<span class="text-info">';
                                $html += value.fromusername;
                                $html += '</span>';
                                $html += '向您发送了一条新消息：';
                                $html += '<span class="text-info">';
                                if(value.context.length > 15){
                                    $html += value.context.slice(0,15)+'...';
                                }else{
                                    $html += value.context;
                                }
                                $html += '</span>';
                                $html += '</span>';
                                $html += '<span class="line small time pull-right">';
                                $html += getDateChange(value.createdAt);
                                $html += '</span>';
                                $html += '</article>';
                                $html += '</a>';
                            }else if (value.mailtype == "reply"){
                                if(value.fromusername == "dangwei" || value.fromusername == "jiwei" || value.fromusername == "zhibu"){
                                    $html += '<a class="notifys" href="?page='+value.topage+'&skipto='+value.notifyid+'" msgid="'+value.id+'">';
                                    $html += '<article class="timeline-story clearfix" style="margin-bottom: 0;border-bottom: 1px solid #ccc;">';

                                    var username = "";
                                    if(value.fromusername == "dangwei"){
                                        username = "党委书记";
                                    }else if(value.fromusername == "jiwei"){
                                        username = "纪委书记";
                                    }else if(value.fromusername == "zhibu"){
                                        username = "支部书记";
                                    }
                                    if(value.isread == '0'){
                                        $html += '<i class="fa-envelope" style="margin-right: 10px;color:#f00;"></i>';
                                    }else{
                                        $html += '<i class="fa-envelope-o" style="margin-right: 10px;"></i>';
                                    }
                                    $html += '<span class="line">';
                                    $html += '<span class="text-info">';
                                    $html += username;
                                    $html += '</span>';
                                    $html += '对你的消息：';
                                    $html += '<span class="text-info">';
                                    if(value.topiccontext.length > 15){
                                        $html += value.topiccontext.slice(0,15)+'...';
                                    }else{
                                        $html += value.topiccontext;
                                    }
                                    $html += '</span>';
                                    $html += '进行了回复：';
                                    $html += '<span class="text-info">';
                                    if(value.context.length > 15){
                                        $html += value.context.slice(0,15)+'...';
                                    }else{
                                        $html += value.context;
                                    }
                                    $html += '</span>';
                                    $html += '</span>';
                                    $html += '<span class="line small time pull-right">';
                                    $html += getDateChange(value.createdAt);
                                    $html += '</span>';
                                    $html += '</article>';
                                    $html += '</a>';
                                }else{
                                    $html += '<a class="notifys" href="?page='+value.topage+'&skipto='+value.notifyid+'" msgid="'+value.id+'">';
                                    $html += '<article class="timeline-story clearfix" style="margin-bottom: 0;border-bottom: 1px solid #ccc;">';
                                    if(value.isread == '0'){
                                        $html += '<i class="fa-envelope" style="margin-right: 10px;color:#f00;"></i>';
                                    }else{
                                        $html += '<i class="fa-envelope-o" style="margin-right: 10px;"></i>';
                                    }
                                    $html += '<span class="line">';
                                    $html += '</span class="text-info">';
                                    $html += value.fromusername;
                                    $html += '</span>';
                                    $html += '对你的消息：';
                                    $html += '<span class="text-info">';
                                    if(value.topiccontext.length > 15){
                                        $html += value.topiccontext.slice(0,15)+'...';
                                    }else{
                                        $html += value.topiccontext;
                                    }
                                    $html += '</span>';
                                    $html += '作出了回复：';
                                    $html += '<span class="text-info">';
                                    if(value.context.length > 15){
                                        $html += value.context.slice(0,15)+'...';
                                    }else{
                                        $html += value.context;
                                    }
                                    $html += '</span>';
                                    $html += '</span>';
                                    $html += '<span class="line small time pull-right">';
                                    $html += getDateChange(value.createdAt);
                                    $html += '</span>';
                                    $html += '</article>';
                                    $html += '</a>';
                                }
                            }
                        });
                        $("#mailmessagelistbody").append($html);

                        if($("#mailmessagelistbody").children().length == 0){
                            $("#nothas").show()
                        }
                        if(res.messages.length == limit){
                            $("#loadmore").show();
                            $("#nomore").hide();
                        }
                        if(res.messages.length != 0 && res.messages.length  < limit){
                            $("#nomore").show();
                            $("#loadmore").hide();
                        }
                    }

                },
                error:function () {
                    notifybox("error","网络异常，请稍后重试")
                }
            })
        }

        //点击一条消息,标记为已读
        $("#mailmessagelistbody").on("click",".notifys",function () {
            var msgid = $(this).attr("msgid");
            $.ajax({
                url:"<?php echo getapiurl('readedmailmessageapi')?>",
                dataType:'json',
                type:'get',
                cache:false,
                data:{
                    id:msgid
                },
                success:function (res) {
                    console.log(res)
                },
                error:function () {
                    notifybox("error","网络异常，请稍后重试")
                }

            })
        });


    })
</script>