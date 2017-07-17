<li class="dropdown hover-line">
    <a href="#" data-toggle="dropdown">
        <i class="fa-envelope-o"></i>
        <span class="mailmessagecount badge badge-green">0</span>
    </a>
    <ul class="dropdown-menu notifications">
        <li class="top">
            <p class="small">
                <a id="mailmessageallreaded" href="javascript:;" class="pull-right">全部标志已读</a>
                您有 <strong class="mailmessagecount text-danger">0</strong> 条新信息.
            </p>
        </li>
        <li>
            <ul id="mailmessagelist" class="dropdown-menu-list list-unstyled ps-scrollbar">
            </ul>
        </li>
        <li class="external">
            <a href="?page=mailMore">
                <span>查看所有信息</span>
                <i class="fa-link-ext"></i>
            </a>
        </li>
    </ul>
</li>
<script type="text/javascript">
    $(function () {
//        setInterval(updateMessages,60000);
        updateMessages();
        function updateMessages(){
            $.ajax({
                url:"<?php echo getapiurl('listmailmessageapi')?>",
                dataType:"json",
                type:"get",
                cache:false,
                data:{
                    userid:"<?php echo $_SESSION['userid']?>",
                    skip:0,
                    limit:5
                },
                success:function (res) {
                    if(res && res.count){
                        $(".mailmessagecount").html(res.count);
                    }
                    if(res && res.messages){
                        var $html = '';
                        $.each(res.messages,function (index,value) {
                            value.context = value.context.replace(/<[^>]+>/g,"");
                            value.topiccontext = value.topiccontext.replace(/<[^>]+>/g,"");

                            if(value.mailtype == "topic"){
                                $html += '<li class="active notification-success">';
                                $html += '<a class="notifys" href="?page='+value.topage+'&skipto='+value.notifyid+'" mailid="'+value.id+'">';
                                $html += '<i class="fa-envelope-o"></i>';
                                $html += '<span class="line">';
                                $html += '<span class="text-info">' + value.fromusername + '</span>向你发送了一条消息:';
                                $html += '<span class="text-info">';
                                if(value.context.length > 15){
                                    $html += value.context.slice(0,15)+'...';
                                }else{
                                    $html += value.context;
                                }
                                $html += '</span>';
                                $html += '</span>';
                                $html += '<span class="line small time">';
                                $html += getDateDiff(value.updatedAt);
                                $html += '</span>';
                                $html += '</a>';
                                $html += '</li>';
                            }else if(value.mailtype == "reply"){
                                if(value.fromusername == "dangwei" || value.fromusername == "jiwei" || value.fromusername == "zhibu"){
                                    var username = "";
                                    if(value.fromusername == "dangwei"){
                                        username = "党委书记";
                                    }else if(value.fromusername == "jiwei"){
                                        username = "纪委书记";
                                    }else if(value.fromusername == "zhibu"){
                                        username = "支部书记";
                                    }
                                    $html += '<li class="active notification-success">';
                                    $html += '<a class="notifys" href="?page='+value.topage+'&skipto='+value.notifyid+'" mailid="'+value.id+'">';
                                    $html += '<i class="fa-envelope-o"></i>';
                                    $html += '<span class="line">';
                                    $html += '<span class="text-info">' + username + '</span>对你的消息';
                                    $html += '<span class="text-info">';
                                    if(value.topiccontext.length > 15){
                                        $html += value.topiccontext.slice(0,15)+'...';
                                    }else{
                                        $html += value.topiccontext;
                                    }
                                    $html += '</span>';
                                    $html += '进行了回复:';
                                    $html += '<span class="text-info">';
                                    if(value.context.length > 15){
                                        $html += value.context.slice(0,15)+'...';
                                    }else{
                                        $html += value.context;
                                    }
                                    $html += '</span>';
                                    $html += '</span>';
                                    $html += '<span class="line small time">';
                                    $html += getDateDiff(value.updatedAt);
                                    $html += '</span>';
                                    $html += '</a>';
                                    $html += '</li>';
                                }else{
                                    $html += '<li class="active notification-success">';
                                    $html += '<a class="notifys" href="?page='+value.topage+'&skipto='+value.notifyid+'" mailid="'+value.id+'">';
                                    $html += '<i class="fa-envelope-o"></i>';
                                    $html += '<span class="line">';
                                    $html += '<span class="text-info">' + value.fromusername + '</span>对';
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
                                    $html += '<span class="line small time">';
                                    $html += getDateDiff(value.updatedAt);
                                    $html += '</span>';
                                    $html += '</a>';
                                    $html += '</li>';
                                }
                            }
                        });
                        $("#mailmessagelist").empty().append($html);

                    }
                },
                error:function () {
                    notifybox("error","网络异常，请稍后重试")
                }
            })
        }

        //当前已读
        $("#mailmessagelist").on("click",".notifys",function () {
            var mailid = $(this).attr("mailid");
            $.ajax({
                url:"<?php echo getapiurl('readedmailmessageapi')?>",
                dataType:"json",
                type:"get",
                cache:false,
                data:{
                    id:mailid
                },
                success:function (res) {
                    if(res.status == 1){
                        $(".mailmessagecount").html(0);
                    }else{
                        notifybox("error","网络异常，请稍后重试")
                    }
                },
                error:function () {
                    notifybox("error","网络异常，请稍后重试")
                }
            })
        });

        //所有已读
        $("#mailmessageallreaded").click(function () {
            if($(".messagescount").html() == 0){
                return;
            }
            $.ajax({
                url:"<?php echo getapiurl('allreadedmailmessageapi')?>",
                dataType:'json',
                type:'get',
                cache:'false',
                data:{
                    userid:"<?php echo $_SESSION['userid']?>"
                },
                success:function (res) {
                    if(res.status == 1){
                        $(".mailmessagecount").html(0);
                    }else{
                        notifybox("error","网络异常，请稍后重试")
                    }
                },
                error:function () {
                    notifybox("error","网络异常，请稍后重试")
                }
            })
        });
    })
</script>
