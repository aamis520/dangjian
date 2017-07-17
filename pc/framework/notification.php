<?php
//$url = getapiurl('getnotifybyuser').'?usrid='.$_SESSION['userid'];
//$notifyinfo = json_decode(mycurl($url));
?>


<li class="dropdown hover-line">
    <a href="#" data-toggle="dropdown">
        <i class="fa-bell-o"></i>
        <span class="messagescount badge badge-purple">0</span>
    </a>

    <ul class="dropdown-menu notifications">
        <li class="top">
            <p class="small">
                <a id="messageallreaded" href="javascript:;" class="pull-right">全部标志已读</a>
                您有 <strong class="messagescount text-danger">0</strong> 条新通知.
            </p>
        </li>
        <li>
            <ul id="messagelist" class="dropdown-menu-list list-unstyled ps-scrollbar">
            </ul>
        </li>
        <li class="external">
            <a href="?page=reply">
                <span>查看所有通知</span>
                <i class="fa-link-ext"></i>
            </a>
        </li>
    </ul>
</li>
<script src="assets/js/publicfunction.js"></script>
<script type="text/javascript">
    $(function () {
        updateMessage();
//        setInterval(updateMessage,60000);
        function updateMessage() {
            var skip = 0;
            var limit = 4;
            $.ajax({
                url:"<?php echo getapiurl('listmessageapi')?>",
                dataType:"json",
                type:"get",
                cache:false,
                data:{
                    userid:"<?php echo $_SESSION['userid']?>",
                    skip:skip,
                    limit:limit
                },
                success:function (res) {
                    if(res && res.count){
                        $(".messagescount").html(res.count);
                    }
                    if(res && res.messages){
                        var $html = '';
                        $.each(res.messages,function (index,value) {
                            if(value.notifytype == "message"){
                                $html += '<li class="active notification-success">';
                                $html += '<a class="notifys" href="?page='+value.topage+'&skipto='+value.notifyid+'" msgid="'+value.id+'">';
                                $html += '<i class="fa-envelope-o"></i>';
                                $html += '<span class="line">';
                                $html += '<span class="text-info">' + value.fromusername + '</span>';
                                if(value.topage == "personCenter"){
                                    $html += '在<span class="text-info">个人中心</span>';
                                }else if(value.topage == "dangyuanluntan"){
                                    $html += '在<span class="text-info">党员论坛</span>';
                                }else if(value.topage == "goldenTimes"){
                                    $html += '在<span class="text-info">流金岁月</span>';
                                }else if(value.topage == "zhuantitaolun"){
                                    $html += '在<span class="text-info">专题讨论</span>';
                                }
                                $html += '向你发送了一条消息';
                                $html += '</span>';
                                $html += '<span class="line small time">';
                                $html += getDateDiff(value.updatedAt);
                                $html += '</span>';
                                $html += '</a>';
                                $html += '</li>';
                            }else if(value.notifytype == "group"){
                                $html += '<li class="active notification-success">';
                                $html += '<a class="notifys" href="?page='+value.topage+'&skipto='+value.notifyid+'" msgid="'+value.id+'">';
                                $html += '<i class="fa-envelope-o"></i>';
                                $html += '<span class="line">';
                                $html += '<span class="text-info">' + value.fromusername + '</span>向你所在的群组<span class="text-info">'+value.togroupname+'</span>发送了一条消息';
                                $html += '</span>';
                                $html += '<span class="line small time">';
                                $html += getDateDiff(value.updatedAt);
                                $html += '</span>';
                                $html += '</a>';
                                $html += '</li>';
                            }else if(value.notifytype == "notify"){
                                $html += '<li class="active notification-success">';
                                $html += '<a class="notifys" href="?page='+value.topage+'&skipto='+value.notifyid+'" notifyid="'+value.notifyid+'" msgid="'+value.id+'" >';
                                $html += '<i class="fa-envelope-o"></i>';
                                $html += '<span class="line">';
                                $html += '组织发布了新公告';
                                $html += '</span>';
                                $html += '<span class="line small time">';
                                $html += getDateDiff(value.updatedAt);
                                $html += '</span>';
                                $html += '</a>';
                                $html += '</li>';
                            }else if(value.notifytype == "reply"){
                                $html += '<li class="active notification-success">';
                                $html += '<a class="notifys" href="?page='+value.topage+'&skipto='+value.notifyid+'" msgid="'+value.id+'">';
                                $html += '<i class="fa-envelope-o"></i>';
                                $html += '<span class="line">';
                                $html += '<span class="text-info">' + value.fromusername + '</span>对';
                                if(value.topage == "personCenter"){
                                    $html += '<span class="text-info">个人中心</span>';
                                }else if(value.topage == "dangyuanluntan"){
                                    $html += '<span class="text-info">党员论坛</span>';
                                }else if(value.topage == "goldenTimes"){
                                    $html += '<span class="text-info">流金岁月</span>';
                                }else if(value.topage == "zhuantitaolun"){
                                    $html += '<span class="text-info">专题讨论</span>';
                                }
                                value.topiccontext = value.topiccontext.replace(/<[^>]+>/g,"");
                                $html += '中的<span class="text-info">' + value.topiccontext.slice(0,15) + '...</span>进行了回复';
                                $html += '</span>';
                                $html += '<span class="line small time">';
                                $html += getDateDiff(value.updatedAt);
                                $html += '</span>';
                                $html += '</a>';
                                $html += '</li>';
                            }else if(value.notifytype == "request" && value.isagree == 2){
                                $html += '<li class="active notification-success">';
                                $html += '<a class="notifys" href="?page='+value.topage+'" msgid="'+value.id+'">';
                                $html += '<i class="fa-envelope-o"></i>';
                                $html += '<span class="line">';
                                $html += '<span class="text-info">' + value.fromusername + '</span>向您发送了党员发展申请';
                                $html += '</span>';
                                $html += '<span class="line small time">';
                                $html += getDateDiff(value.updatedAt);
                                $html += '</span>';
                                $html += '</a>';
                                $html += '</li>';
                            }else if(value.notifytype == "request" && value.isagree == 0) {
                                $html += '<li class="active notification-success">';
                                $html += '<a class="notifys" href="?page=' + value.topage + '&skipto=' + value.notifyid + '" msgid="' + value.id + '">';
                                $html += '<i class="fa-envelope-o"></i>';
                                $html += '<span class="line">';
                                value.topiccontext = value.topiccontext.replace(/<[^>]+>/g,"");
                                $html += '组织拒绝了您的申请，理由是：';
                                $html += '<span class="text-info">'+value.topiccontext+'</span>';
                                $html += '</span>';
                                $html += '<span class="line small time">';
                                $html += getDateDiff(value.updatedAt);
                                $html += '</span>';
                                $html += '</a>';
                                $html += '</li>';
                            }else if(value.notifytype == "request" && value.isagree == 1) {
                                $html += '<li class="active notification-success">';
                                $html += '<a class="notifys" href="?page=' + value.topage + '&skipto=' + value.notifyid + '" msgid="' + value.id + '">';
                                $html += '<i class="fa-envelope-o"></i>';
                                $html += '<span class="line">';
                                $html += '组织同意了您的申请';
                                $html += '</span>';
                                $html += '<span class="line small time">';
                                $html += getDateDiff(value.updatedAt);
                                $html += '</span>';
                                $html += '</a>';
                                $html += '</li>';
                            }else if(value.notifytype == "system-addgroup" && value.isagree == "0"){
                                $html += '<li class="active notification-success">';
                                $html += '<a href="javascript:;" class="notifys showNotifyModal" msgid="' + value.id + '">';
                                $html += '<i class="fa-envelope-o"></i>';
                                $html += '<span class="line">';
                                value.topiccontext = value.topiccontext.replace(/<[^>]+>/g,"");
                                $html += '<span class="joininorremove">您被移出群组</span>';
                                $html += '<span class="text-info groupname">'+value.topiccontext+'</span>';
                                $html += '</span>';
                                $html += '<span class="line small time">';
                                $html += getDateDiff(value.updatedAt);
                                $html += '</span>';
                                $html += '</a>';
                                $html += '</li>';
                            }else if(value.notifytype == "system-addgroup" && value.isagree == "1"){
                                $html += '<li class="active notification-success">';
                                $html += '<a href="javascript:;" class="notifys showNotifyModal" msgid="' + value.id + '">';
                                $html += '<i class="fa-envelope-o"></i>';
                                $html += '<span class="line">';
                                value.topiccontext = value.topiccontext.replace(/<[^>]+>/g,"");
                                $html += '<span class="joininorremove">您成功加入群组</span>';
                                $html += '<span class="text-info groupname">'+value.topiccontext+'</span>';
                                $html += '</span>';
                                $html += '<span class="line small time">';
                                $html += getDateDiff(value.updatedAt);
                                $html += '</span>';
                                $html += '</a>';
                                $html += '</li>';
                            }
                        });
                        $("#messagelist").empty().append($html);

                    }else{

                    }
                },
                error:function () {
                    notifybox("error","网络异常，请稍后重试")
                }
            })
        }
//        //点击一条消息,标记为已读
        $("#messagelist").on("click",".notifys",function () {
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
        //所有已读
        $("#messageallreaded").click(function () {
            if($(".messagescount").html() == 0){
                return;
            }
            $.ajax({
                url:"<?php echo getapiurl('allreadedmessageapi')?>",
                dataType:'json',
                type:'get',
                cache:'false',
                data:{
                    userid:"<?php echo $_SESSION['userid']?>"
                },
                success:function (res) {
                    if(res.status == 1){
                        $(".messagescount").html(0);
                    }else{

                    }
                },
                error:function () {
                    notifybox("error","网络异常，请稍后重试")
                }
            })
        });
    //打开模态框
        $("#messagelist").on("click",".showNotifyModal",function () {
            $('#showNotifyModal').modal('show', {backdrop: 'static'});
            var groupname = $(this).find('.groupname').text();
            var joininorremove = $(this).find('.joininorremove').text();
            var $html = '<p class="text-center">'+joininorremove+'<span class="text-info">'+groupname +'</span></p>';
            $("#showNotifyModalBody").html($html);
        })
    })
</script>
