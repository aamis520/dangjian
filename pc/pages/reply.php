<?php global $requestfromdangjianapp; if(!$requestfromdangjianapp) {?>
<nav class="navbar navbar-default " role="navigation">
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li class="active">
				<a href="?page=reply" class="">
					消息通知
				</a>
			</li>
			<li>
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
            <section id="messagelistbody" class="user-timeline-stories">
            </section>
            <section id="loadmore" class="btn btn-block btn-default" style="background: #fff;margin-top: 10px;display:none;">点击加载</section>
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
                url:"<?php echo getapiurl('listallmessageapi')?>",
                dataType:"json",
                type:"get",
                cache:false,
                data:{
                    userid:"<?php echo $_SESSION['userid']?>",
                    skip:skip,
                    limit:limit
                },
                success:function (res) {
                    if(res && res.messages){
                        var $html = '';
                        $.each(res.messages,function (index,value) {
                            if(value.notifytype == "message"){
                                $html += '<a class="notifys" href="?page='+value.topage+'&skipto='+value.notifyid+'" msgid="'+value.id+'">';
                                $html += '<article class="timeline-story clearfix" style="margin-bottom: 0;border-bottom: 1px solid #ccc;">';
                                if(value.isread == '0'){
                                    $html += '<i class="fa-envelope" style="margin-right: 10px;color:#f00;"></i>';
                                }else{
                                    $html += '<i class="fa-envelope-o" style="margin-right: 10px;"></i>';
                                }
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
                                $html += '向你发送了一条消息:';
                                $html += '<span class="text-info">';
                                value.context = value.context.replace(/<[^>]+>/g,"");
                                if(value.context.length>15){
                                    $html += value.context.slice(0,15) + '...';
                                }else{
                                    $html += value.context;
                                }
                                $html += '</span>';
                                $html += '</span>';
                                $html += '<span class="line small time pull-right">';
                                $html += getDateChange(value.createdAt);
                                $html += '</span>';
                                $html += "</article>";
                                $html += '</a>';
                            }
                            if(value.notifytype == "group"){
                                $html += '<a class="notifys" href="?page='+value.topage+'&skipto='+value.notifyid+'" msgid="'+value.id+'">';
                                $html += '<article class="timeline-story clearfix" style="margin-bottom: 0;border-bottom: 1px solid #ccc;">';
                                if(value.isread == '0'){
                                    $html += '<i class="fa-envelope" style="margin-right: 10px;color:#f00;"></i>';
                                }else{
                                    $html += '<i class="fa-envelope-o" style="margin-right: 10px;"></i>';
                                }
                                $html += '<span class="line">';
                                $html += '<span class="text-info">' + value.fromusername + '</span>向你所在的群组';
                                $html += '<span class="text-info">'+value.togroupname+'</span>发送了一条消息:';
                                $html += '<span class="text-info">';
                                value.context = value.context.replace(/<[^>]+>/g,"");
                                if(value.context.length>15){
                                    $html += value.context.slice(0,15) + '...';
                                }else{
                                    $html += value.context;
                                }
                                $html += '</span>';
                                $html += '</span>';
                                $html += '<span class="line small time pull-right">';
                                $html += getDateChange(value.createdAt);
                                $html += '</span>';
                                $html += "</article>";
                                $html += '</a>';
                            }
                            if(value.notifytype == "notify"){
                                $html += '<a href="?page='+value.topage+'&skipto='+value.notifyid+'" class="notifys" notifyid="'+value.notifyid+'" msgid="'+value.id+'">';
                                $html += '<article class="timeline-story clearfix" style="margin-bottom: 0;border-bottom: 1px solid #ccc;">';
                                if(value.isread == '0'){
                                    $html += '<i class="fa-envelope" style="margin-right: 10px;color:#f00;"></i>';
                                }else{
                                    $html += '<i class="fa-envelope-o" style="margin-right: 10px;"></i>';
                                }
                                $html += '<span class="line">';
                                $html += '组织发布了新公告';
                                $html += '</span>';
                                $html += '<span class="line small time pull-right">';
                                $html += getDateChange(value.createdAt);
                                $html += '</span>';
                                $html += "</article>";
                                $html += '</a>';
                            }
                            if(value.notifytype == "reply"){
                                $html += '<a class="notifys" href="?page='+value.topage+'&skipto='+value.notifyid+'" msgid="'+value.id+'">';
                                $html += '<article class="timeline-story clearfix" style="margin-bottom: 0;border-bottom: 1px solid #ccc;">';
                                if(value.isread == '0'){
                                    $html += '<i class="fa-envelope" style="margin-right: 10px;color:#f00;"></i>';
                                }else{
                                    $html += '<i class="fa-envelope-o" style="margin-right: 10px;"></i>';
                                }
                                $html += '<span class="line">';
                                $html += '<span class="text-info">' + value.fromusername + '</span>对';
                                $html += '<span class="text-info">';
                                value.topiccontext = value.topiccontext.replace(/<[^>]+>/g,"");
                                if(value.topiccontext.length>15){
                                    $html += value.topiccontext.slice(0,15) + '...';
                                }else{
                                    $html +=  value.topiccontext ;
                                }
                                $html += '</span>进行了回复:';
                                $html += '<span class="text-info">';
                                value.context = value.context.replace(/<[^>]+>/g,"");
                                if(value.context.length>15){
                                    $html += value.context.slice(0,15) + '...';
                                }else{
                                    $html += value.context;
                                }
                                $html += '</span>';
                                $html += '</span>';
                                $html += '<span class="line small time pull-right">';
                                $html += getDateChange(value.createdAt);
                                $html += '</span>';
                                $html += "</article>";
                                $html += '</a>';
                            }
                            if(value.notifytype == "request" && value.isagree == 2){
                                $html += '<a href="?page='+value.topage+'" class="notifys" msgid="'+value.id+'">';
                                $html += '<article class="timeline-story clearfix" style="margin-bottom: 0;border-bottom: 1px solid #ccc;">';
                                if(value.isread == '0'){
                                    $html += '<i class="fa-envelope" style="margin-right: 10px;color:#f00;"></i>';
                                }else{
                                    $html += '<i class="fa-envelope-o" style="margin-right: 10px;"></i>';
                                }
                                $html += '<span class="line">';
                                $html += '<span class="text-info">' + value.fromusername + '</span>';
                                $html += '向您发送了党员发展申请';
                                $html += '<span class="line small time pull-right">';
                                $html += getDateChange(value.createdAt);
                                $html += '</span>';
                                $html += "</article>";
                                $html += '</a>';
                            }
                            if(value.notifytype == "request" && value.isagree == 0){
                                $html += '<a href="?page='+value.topage+'" class="notifys"  msgid="'+value.id+'">';
                                $html += '<article class="timeline-story clearfix" style="margin-bottom: 0;border-bottom: 1px solid #ccc;">';
                                if(value.isread == '0'){
                                    $html += '<i class="fa-envelope" style="margin-right: 10px;color:#f00;"></i>';
                                }else{
                                    $html += '<i class="fa-envelope-o" style="margin-right: 10px;"></i>';
                                }
                                $html += '<span class="line">';
                                $html += '组织拒绝了您的申请，理由是：';
                                value.topiccontext = value.topiccontext.replace(/<[^>]+>/g,"");
                                $html += '<span class="text-info">'+value.topiccontext+'</span>';
                                $html += '<span class="line small time pull-right">';
                                $html += getDateChange(value.createdAt);
                                $html += '</span>';
                                $html += "</article>";
                                $html += '</a>';
                            }
                            if(value.notifytype == "request" && value.isagree == 1){
                                $html += '<a href="?page='+value.topage+'" class="notifys"  msgid="'+value.id+'">';
                                $html += '<article class="timeline-story clearfix" style="margin-bottom: 0;border-bottom: 1px solid #ccc;">';
                                if(value.isread == '0'){
                                    $html += '<i class="fa-envelope" style="margin-right: 10px;color:#f00;"></i>';
                                }else{
                                    $html += '<i class="fa-envelope-o" style="margin-right: 10px;"></i>';
                                }
                                $html += '<span class="line">';
                                $html += '组织同意了您的申请';
                                $html += '<span class="line small time pull-right">';
                                $html += getDateChange(value.createdAt);
                                $html += '</span>';
                                $html += "</article>";
                                $html += '</a>';
                            }
                        });

                        $("#messagelistbody").append($html);

                        if(res.messages.length == limit){
                            $("#loadmore").show();
                            $("#nomore").hide();
                        }
                        if(res.messages.length < limit){
                            $("#loadmore").hide();
                            $("#nomore").show();
                        }
                        if($("#messagelistbody").children().length == 0){
                            $("#nomore").show();
                        }

                    }else{
                        notifybox("error","网络异常，请稍后重试1111")
                    }
                },
                error:function () {
                    notifybox("error","网络异常，请稍后重试112")
                }
            })
        }
        //点击一条消息,标记为已读
        $("#messagelistbody").on("click",".notifys",function () {
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
                },
                error:function () {
                    notifybox("error","网络异常，请稍后重试aa")
                }

            })
        });
    })
</script>