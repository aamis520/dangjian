<section class="profile-env" style="position: relative;">
	<div class="row">
		<div class="col-sm-8">
			<!--对话框  开始-->
			<section class="mailbox-env">
				<div class="row">
					<!-- Compose Email Form -->
					<div class="col-sm-12 mailbox-left">
						<div class="mail-compose" style="padding-bottom: 0;">
							<form method="post" role="form">
								<div class="compose-message-editor">
									<div class="vertical-top clearfix" id="chooseArea">
									<div class="pull-left">信息范围：</div>
                                    <div class="pull-left">
                                        <a href="javascript:;" id="toall" class="btn btn-warning btn-xs">　公开　</a>
                                        <a href="javascript:;" id="togroup" class="btn btn-danger btn-xs">　指定群组　</a>
                                        <a href="javascript:;" id="toperson" class="btn btn-info btn-xs">　指定人员　</a>
                                    </div>
                                    </div>
                                    <div class="vertical-top clearfix">
                                        <div class="pull-left">当前选择的是：</div>
                                        <div id="markbtngroup" class="pull-left">
                                            <a href="javascript:;" id="marktoall" class="btn btn-warning btn-xs" disabled>　公开　</a>
                                            <a href="javascript:;" id="marktogroup" class="btn btn-danger btn-xs hide" disabled>　指定群组　</a>
                                            <a href="javascript:;" id="marktoperson" class="btn btn-info btn-xs hide" disabled>　指定人员　</a>
                                        </div>
                                    </div>
									<textarea id="sample_wysiwyg" class="form-control wysihtml5" data-html="false" data-color="false" data-stylesheet-url="assets/css/wysihtml5-color.css" name="sample_wysiwyg"></textarea>
									<div class="row" style="padding-top: 20px;">
										<div class="col-sm-6">
<!--											<input type="file"  value="上传附件" class="btn btn-xs" value="上传附件" />-->
											<div class="file-box" style="position: relative;">
											    <input type="file" name="fileField" class="file" id="fileField" size="28" onchange="document.getElementById('textfield').value=this.value" style="position:absolute; top:0; left:0; height:24px; filter:alpha(opacity:0);opacity: 0;width:80px;" />
<!--											 	<button type="submit" name="submit" class="btn btn-xs" />-->
<!--											 		<i class="fa-upload"></i>-->
<!--											 		<span>上传附件</span>-->
<!--											 	</button>-->
												<i style="padding-left: 10px; position: relative;top: -5px; font-style: normal;"><input type='text' name='textfield' id='textfield' class='txt' style=" border:none; width:180px;" /></i>
											</div>
										</div>
                                        <div class="col-sm-6 ">
                                            <button type="button" id="sendtopicbtn" class="btn btn-single btn-xs btn-success post-story-button pull-right">　发　布　</button>
                                        </div>
									</div>
								</div>
							</form>
                        </div>
					</div>
				</div>
			</section>
<!--            topics-->
			<section id="topics" class="user-timeline-stories"></section>
<!--            loadmore-->
            <section id="loadmore" class="btn btn-block btn-default" style="background: #fff;display: none;">点击加载</section>
            <section id="nomore" class="text-center text-muted" style="margin-top:10px;font-size:14px;background: #fff;padding:10px 0;display: none;">暂无更多消息</section>

        </div>
<?php global $requestfromdangjianapp; if(!$requestfromdangjianapp) {?>
		<div class="col-sm-4 personCenterSp pull-right">
			<div class="panel panel-default">
				<div class="panel-heading">
					公告
				</div>
				<div id="notifys" class="panel-body">
				</div>
				<div class="panel-heading">
					组织介绍
				</div>
				<div class="panel-body">
                    <h6 id="groupTitle" class=" text-center"></h6>
                    <div id="groupIntro"></div>
				</div>
			</div>
		</div>
<?php }?>
    </div>
</section>
<!--编辑器用s-->
<link rel="stylesheet" href="assets/js/wysihtml5/src/bootstrap-wysihtml5.css">
<script src="assets/js/wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
<script src="assets/js/wysihtml5/src/bootstrap-wysihtml5.js"></script>
<!--编辑器用e-->
<!--消息提示用s-->
<script src="assets/js/toastr/toastr.min.js"></script>
<!--消息提示用e-->
<script src="assets/js/publicfunction.js"></script>
<script type="text/javascript">
    $(function () {
        //topic每次加载多少条
        var topiclimit = 10;
        //reply每次加载多少条
        var replylimit = 2;
        //notify初始化加载多少条
        var notifyinitlimit = 5;

        //页面初始化文章，评论加载
        topicInit(0,topiclimit,0,replylimit);
        //点击加载更多
        //点击次数
        var $topicloadcount = 1;
        $("#loadmore").click(function () {
            var topicskip = $topicloadcount * topiclimit;
            topicInit(topicskip,topiclimit,0,replylimit);
            $topicloadcount++;
        });

        //初始化指定群组中的内容
        togroup();
        //定义变量接收选中的togroupid和topersonid组
        var toall = 1;
        var togroupid = "";
        var touserids = [];
        var togroupname = "";

        //点击选择group
        $("#togroupbtns").on("click",".groupbtn",function () {
            $(this).toggleClass("btn-gray btn-turquoise").siblings().removeClass("btn-turquoise").addClass("btn-gray");
            $(this).toggleClass("checked").siblings().removeClass("checked");
        });
        //取togroup的groupid
        $("#togroupsure").click(function () {
            toall=0;
            togroupid = $("#togroupbtns .checked").attr("groupid");
            togroupname = $("#togroupbtns .checked span").html();
            $("#marktogroup").removeClass("hide");
            $("#marktoall,#marktoperson").addClass("hide");
            if(togroupid == "" || togroupid == undefined || togroupid == "undefined"){
                toall=1;
                togroupname = "";
                $("#marktoall").removeClass("hide");
                $("#marktogroup,#marktoperson").addClass("hide");
            }
        });

        //初始化指定人员中的信息
        toperson();
        //取toperson的id组
        $("#topersonsure").click(function () {
            toall = 0;
            touserids = [];
            for(var i = 0;i < $("#topersons >.done").length;i++){
                var curid = $("#topersons >.done").eq(i).find("input").attr("personid");
                touserids.push(curid);
            }
            touserids = $.unique(touserids);
            $("#marktoperson").removeClass("hide");
            $("#marktoall,#marktogroup").addClass("hide");
            if(touserids && touserids.length == 0){
                toall = 1;
                $("#marktoall").removeClass("hide");
                $("#marktoperson,#marktogroup").addClass("hide");
            }
        });

        //点击公开按钮
        $("#toall").click(function () {
            toall = 1;
            togroupid = "";
            touserids = [];
            togroupname = "";
            $("#marktoall").removeClass("hide");
            $("#marktogroup,#marktoperson").addClass("hide");
        });

        //点击指定群组按钮
        $("#togroup").click(function () {
            touserids = [];
            $('#personCenterModal-chooseGroup').modal('show',{backdrop:'static'});
        });

        //点击指定人员按钮
        $("#toperson").click(function () {
            togroupid = "";
            togroupname = "";
            $('#personCenterModal-choosePerson').modal('show',{backdrop:'static'});
        });

        //点赞
        $("#topics").on('click','a.zannum',function () {
            var topicid = $(this).closest("article").find(".topicid").val();
            if($(this).find("i").hasClass("fa-heart")){
                return false;
            }else {
                $(this).find("i").removeClass("fa-heart-o").addClass("fa-heart");
            }
            var zannumber = $(this).find("span").html();
            var $self = $(this);
            $.ajax({
                url:"<?php echo getapiurl('updatezantopicapi')?>",
                dataType:"json",
                cache:false,
                type:"get",
                data:{
                    topicid:topicid
                },
                success:function (res) {
                    if(res && res.result == true){
                        zannumber = parseInt(zannumber) + 1 ;
                    }else{

                    }
                    $self.find("span").html(zannumber);
                },
                error:function () {
                }
            });
            return false;
        });

        //创建新的topic返回的id
        var createtopicid = '';
        //提交新的topic
        $("#sendtopicbtn").click(function(){
            var ownerid = "<?php echo $_SESSION["userid"]?>";
            var context = $("#sample_wysiwyg").val();
            if(touserids == undefined || touserids == "undefined"){
                touserids = [];
            }
            if(context == ""){
                notifybox("warning","内容不可为空");
                return;
            }

            //先提交内容
            $.ajax({
                url:"<?php echo getapiurl('createtopicapi')?>",
                dataType:'json',
                cache:false,
                type:"get",
                data:{
                    ownerid:"<?php echo $_SESSION["userid"]?>",
                    context:context,
                    togroupid:togroupid,
                    touserids:touserids,
                    toall:toall
                },
                success:function (res) {
                    if(res && res.id){
                        createtopicid = res.id;
                        $("#sample_wysiwyg").val("");
                        notifybox("success","发表成功");

                        //再刷新最新的topic
                        var $html = "";
                        $html += '<article class="newtopic timeline-story" style="display: none;" topicid="'+ createtopicid +'">';
                        $html += '<input type="hidden" class="topicid" name="topicid" value="'+ createtopicid +'">';
                        $html += '<input type="hidden" class="ownerid" name="ownerid" value="'+ ownerid +'">';
                        $html += '<i class="fa-paper-plane-empty block-icon"></i>';
                        $html += '<header>';
                        $html += '<a  class="user-img">';
                        if("<?php echo $_SESSION['userdetailinfo'][0]->picurl;?>" == "") {
                            $html += '<img src="avatar/default.png" alt="user-img" class="img-responsive img-circle" width="50" height="50">';
                        }else{
                            $html += '<img src="<?php echo $_SESSION['userdetailinfo'][0]->picurl;?>" alt="user-img" class="img-responsive img-circle" width="50" height="50">';
                        }
                        $html += '</a>';
                        $html += '<div class="user-details clearfix">';
                        $html += '<p class="pull-left">';
                        $html += '<span><?php echo $_SESSION['userdetailinfo'][0]->userrealname?></span>';
                        $html += '<time>刚刚</time>';
                        $html += '</p>';
                        if(toall == 1 ){
                            $html += '<span class="text-warning pull-right">　公开　</span>';
                        }else if(toall == 0 && togroupid != ""){
                            $html += '<span class="text-danger pull-right">　指定群组　</span>';
                        }else if(toall == 0 && togroupid == "" && touserids.length != 0){
                            $html += '<span class="text-info pull-right">　指定人员　</span>';
                        }
                        $html += '</div>';
                        $html += '</header>';
                        $html += '<div class="story-content clearfix">';
                        $html += '<p class="topiccontext">' + context + '</p>';
                        $html += '<div class="story-options-links">';
                        $html += '<a href="#" class="zannum" >';
                        $html += '<i class="fa-heart-o"></i>';
                        $html += '(<span>0</span>)';
                        $html += '</a>';
                        $html += '<a class="replynum">';
                        $html += '回复(<span>0</span>)';
                        $html += '</a>';
                        $html += '</div>';
                        $html += '<form class="story-comment-form">';
                        $html += '<textarea class="form-control input-unstyled autogrow" placeholder="评论..." style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 76px;"></textarea>';
                        $html += '<div class="row">';
                        $html += '<div class="col-sm-12">';
                        $html += '</div>';
                        $html += '</div>';
                        $html += '</form>';
                        $html += '<button class="sendreply btn btn-single btn-xs btn-success post-story-button pull-right">发 表</button>';
                        $html += '</article>';
                        $("#topics").prepend($html);
                        $(".newtopic").fadeIn(1000);
                        //保存到消息中

                        var notifytype = "message";
                        if(toall == 0 && togroupid != ""){
                            notifytype = "group";
                        }

                        //创建消息
                        $.ajax({
                            url:"<?php echo getapiurl('createmessageapi')?>",
                            dataType:'json',
                            cache:false,
                            type:"get",
                            data:{
                                userid:"<?php echo $_SESSION['userid']?>",
                                username:"<?php echo $_SESSION['userdetailinfo'][0]->userrealname?>",
                                toall:toall,
                                togroupname:togroupname,
                                touserids:touserids,
                                togroupid:togroupid,
                                notifytype:notifytype,
                                topage:getUrlParam("page"),
                                notifyid:res.id,
                                context:context
                            },
                            success:function (res) {
                                if(res.status == 0){

                                }else{

                                }
                            },
                            error:function () {
                            }
                        });
                    }else{

                    }
                },
                error:function () {

                }
            })
        });

        //发送评论
        $("#topics").on('click','button.sendreply',function () {
            //保存this
            var $self = $(this);
            var topicid = $(this).closest("article").find(".topicid").val();
            var topicownerid = $(this).closest("article").find(".ownerid").val();
            var topiccontext = $(this).closest("article").find(".topiccontext").html();
            var context = $(this).parents("article").find("textarea").val();
            var ownerid = "<?php echo $_SESSION["userid"];?>";
            var replynumber = $(this).closest("article").find(".replynum>span").html();
            if(context == ""){
                notifybox("warning","内容不可为空");
                return;
            }
            //更新replynum
            $.ajax({
                url:"<?php echo getapiurl('updatereplynumtopicapi')?>",
                dataType:"json",
                type:"get",
                cache:false,
                data:{
                    topicid:topicid
                },
                success:function (res) {
                    if(res &&　res.result == true){
                        replynumber = parseInt(replynumber) + 1;
                    }else{
                    }
                    $self.closest("article").find(".replynum>span").html(replynumber);
                },
                error:function () {

                }
            });
            //创建reply
            $.ajax({
                url:"<?php echo getapiurl('createreplyapi')?>",
                dataType:"json",
                type:"get",
                cache:false,
                data:{
                    topicid:topicid,
                    context:context,
                    ownerid:ownerid
                },
                success:function (res) {
                    if(res && res.id) {
                        notifybox("success","回复成功");
                        $self.parents("article").find("textarea").val("");

                        var $html = '';
                        //评论列表有li，不创建ul
                        if($self.closest("article").find("ul.story-comments").children("li").length > 0){
                        }else{
                            $html += '<ul class="list-unstyled story-comments">';
                        }
                        $html += '<li class="eachreply" replyid="'+res.id+'" style="display: none;">';
                        $html += '<div class="story-comment">';
                        $html += '<a  class="comment-user-img">';
                        if("<?php echo $_SESSION['userdetailinfo'][0]->picurl?>" == ""){
                            $html += '<img src="avatar/default.png" alt="user-img" class="img-circle img-responsive" width="50" height="50">';
                        }else{
                            $html += '<img src="<?php echo $_SESSION['userdetailinfo'][0]->picurl?>" alt="user-img" class="img-circle img-responsive" width="50" height="50">';
                        }
                        $html += '</a>';
                        $html += '<div class="story-comment-content">';
                        $html += '<a class="story-comment-user-name">';
                        $html += '<?php echo $_SESSION['userdetailinfo'][0]->userrealname?>';
                        $html += '<time>刚刚</time>';
                        $html += '</a>';
                        $html += '<p class="topiccontext">' +　context　+ '</p>';
                        $html += '</div></div>';
                        $html += '</li>';
                        //评论列表有li，不创建ul
                        if($self.closest("article").find("ul.story-comments").children("li").length > 0){
                        }else{
                            $html += '</ul>';
                        }
                        //没有评论，插入到story-options-links之后,有评论，插入到ul.story-comments的头部
                        if($self.closest("article").find("ul.story-comments").children("li").length > 0){
                            $self.closest("article").find($("ul.story-comments")).prepend($html);
                        }else {
                            $self.closest("article").find(".story-options-links").after($html);
                        }
                        $(".eachreply").fadeIn(1000);

                        //如果自己回复自己的topic，不创建消息
                        if("<?php echo $_SESSION['userid']?>" != topicownerid){
                            //创建消息
                            $.ajax({
                                url:"<?php echo getapiurl('createmessageapi')?>",
                                dataType:'json',
                                cache:false,
                                type:"get",
                                data:{
                                    userid:"<?php echo $_SESSION['userid']?>",
                                    username:"<?php echo $_SESSION['userdetailinfo'][0]->userrealname?>",
                                    touserid:topicownerid,
                                    notifytype:'reply',
                                    notifyid:topicid,
                                    topage:getUrlParam('page'),
                                    context:context,
                                    topiccontext:topiccontext
                                },
                                success:function (res) {
                                    if(res.status == 0){

                                    }else{

                                    }
                                },
                                error:function () {

                                }
                            });
                        }

                    }else{
                        notifybox("error","回复失败");
                    }
                },
                error:function () {
                    notifybox("error","网络异常，请稍后重试");
                }
            })
        });

        groupIntroINit();
        function groupIntroINit() {
            $.ajax({
                url:"<?php echo getapiurl('getorginfo')?>",
                dataType:"json",
                cache:false,
                type:'get',
                success:function (req) {
                    if(req){
                        $("#groupIntro").html(req.desciption);
                        $("#groupTitle").html(req.name)
                    }
                },
                error:function () {

                }
            })

        }

        //初始化加载公告中的内容
        notifyInit(0,notifyinitlimit);
        //点击一条公告
        $("#notifys").on('click','li.eachnotify',function () {
            $('#notifydetail').modal('show', {backdrop: 'static'});
            $.ajax({
                url:"<?php echo getapiurl('shownotifydetailapi')?>",
                dataType:'json',
                type:'get',
                cache:'false',
                data:{
                    id:$(this).attr("notifyid")
                },
                success:function (res) {
                    if(res && res.notify && res.userprofile){
                        var notify = res.notify;
                        var userprofile = res.userprofile;
                        var $htm = '';
                        $htm += '<h4 class="text-center">';
                        $htm += notify.title;
                        $htm += '</h4>';
                        $htm += '<div>';
                        $htm += notify.context;
                        $htm += '</div>';
                        $("#notifydetailbody").empty().append($htm);

                        var $html = '';
                        $html += '<div class="clearfix">';
                        $html += '<div class="pull-left">';
                        $html += userprofile.userrealname;
                        $html += '</div>';
                        $html += '<div class="pull-right">';
                        $html += getNowDateFormat(notify.createdAt);
                        $html += '</div>';
                        $html += '</div>';
                        $("#notifydetailheader").empty().append($html);
                    }else{
                        notifybox("error","网络异常，请稍后重试")
                    }
                },
                error:function () {
                    notifybox("error","网络异常，请稍后重试")
                }
            })

        })

    });
    //初始化加载topic
    function topicInit(topicskip,topiclimit,replyskip,replylimit) {
        $.ajax({
            url:"<?php echo getapiurl('listtopicapi')?>",
            dataType:"json",
            cache:false,
            type:"get",
            data:{
                userid:"<?php echo $_SESSION['userid']?>",
                topicskip:topicskip,
                topiclimit:topiclimit,
                replyskip:replyskip,
                replylimit:replylimit
            },
            success:function (res) {
                var userprofiles = res.userprofiles;
                if(res && res.topics){
                    var $html = "";
                    $.each(res.topics,function (index,topic) {
                        if(userprofiles[topic.ownerid]){
                            $html += '<article class="eachtopic timeline-story" style="display: none;" topicid="'+ topic.id+'">';
                            $html += '<input type="hidden" class="topicid" name="topicid" value="'+ topic.id +'">';
                            $html += '<input type="hidden" class="ownerid" name="ownerid" value="'+ topic.ownerid +'">';
                            $html += '<i class="fa-paper-plane-empty block-icon"></i>';
                            $html += '<header>';
                            $html += '<a  class="user-img">';
                            if(userprofiles[topic.ownerid].picurl){
                                $html += '<img src="'+ userprofiles[topic.ownerid].picurl+'" alt="user-img" class="img-responsive img-circle" width="50" height="50">';
                            }else{
                                $html += '<img src="avatar/default.png" alt="user-img" class="img-responsive img-circle" width="50" height="50">';
                            }
                            $html += '</a>';
                            $html += '<div class="user-details clearfix">';
                            $html += '<p class="pull-left">';
                            $html += '<span>'+ userprofiles[topic.ownerid].userrealname +'</span>';
                            $html += '<time>'+ getDateDiff(topic.createdAt)+'</time>';
                            $html += '<p>';
                            if(topic.toall == 1){
                                $html += '<p class="pull-right text-warning">　公开　</p>';
                            }else if(topic.toall == 0 && topic.togroupid == "" ){
                                $html += '<p class="pull-right text-info">　指定人员　</p>';
                            }else if(topic.toall == 0 && topic.togroupid != "")
                                $html += '<p class="pull-right text-danger">　指定群组　</p>';
                            $html += '</div>';
                            $html += '</div>';
                            $html += '</header>';
                            $html += '<div class="story-content clearfix">';
                            $html += '<p class="topiccontext">'+ topic.context+'</p>';
                            $html += '<div class="story-options-links">';
                            $html += '<a href="#" class="zannum">';
                            $html += '<i class="fa-heart-o"></i>';
                            $html += '(<span>'+ topic.zannum +'</span>)';
                            $html += '</a>';
                            $html += '<a class="replynum">';
                            $html += '回复(<span>'+ topic.replynum +'</span>)';
                            $html += '</a>';
                            $html += '</div>';
                            if(topic.reply && topic.reply.length > 0){
                                $html += '<ul class="list-unstyled story-comments">';
                                $.each(topic.reply,function (index,reply) {
                                    $html += '<li class="eachreply" replyid="'+reply.id+'">';
                                    $html += '<div class="story-comment">';
                                    $html += '<a  class="comment-user-img">';
                                    if(userprofiles[reply.ownerid].picurl){
                                        $html += '<img src="'+userprofiles[reply.ownerid].picurl+'" alt="user-img" class="img-circle img-responsive" width="50" height="50">';
                                    }else{
                                        $html += '<img src="avatar/default.png" alt="user-img" class="img-circle img-responsive" width="50" height="50">';
                                    }
                                    $html += '</a>';
                                    $html += '<div class="story-comment-content">';
                                    $html += '<a  class="story-comment-user-name">';
                                    $html +=  userprofiles[reply.ownerid].userrealname ;
                                    $html += '<time>'+ getDateDiff(reply.createdAt)+'</time>';
                                    $html += '</a>';
                                    $html += '<p>'+ reply.context+'</p>';
                                    $html += '</div>';
                                    $html += '</div>';
                                    $html += '</li>';
                                });
                                $html += '</ul>';
                                //判断replynum大于replylimit，显示查看更多评论按钮
                                if(topic.reply && topic.replynum > replylimit) {
                                    $html += '<div class="col-sm-12 clearfix" style="height:30px;margin-bottom: 10px;">';
                                    $html += '<a href="?page=personCenterMoreReplys&topicid='+topic.id+'" class="btn btn-xs btn-single btn-info pull-right">查看更多评论</a>';
                                    $html += '</div>';
                                }
                            }
                            $html += '<form class="story-comment-form">';
                            $html += '<textarea class="form-control input-unstyled autogrow" placeholder="评论..." style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 76px;"></textarea>';
                            $html += '</form>';
                            $html += '<button class="sendreply btn btn-single btn-xs btn-success post-story-button pull-right" >  发  表  </button>';
                            $html += '</article>';
                        }
                    });
                    $("#topics").append($html);
                    $(".eachtopic").fadeIn(1000);
                    //判断消息条数少于指定的加载条数，topic加载更多按钮不显示
                    if( res.topics.length < topiclimit ){
                        $("#loadmore").hide();
                        $("#nomore").show();
                    }
                    if(res.topics.length == topiclimit){
                        $("#loadmore").show();
                        $("#nomore").hide();
                    }
                    if($("#topics").children().length == 0){
                        $("#nomore").show();
                    }
                }
            },
            error:function () {
                notifybox("error","网络异常，请稍后重试")
            }
        }).done(function () {
            //点击消息滚动到指定位置
            scrolltotarget();
        });
    }
    //加载指定人员中的内容
    function toperson(){
        $.ajax({
            url:"<?php echo getapiurl('getuserprofileapi');?>",
            data:{
            	live:1
            },
            dataType:"json",
            // 不能加cache:false，否则娶不到数据
//                 cache:false,
            type:"get",
            success:function (res) {
                if(res){
                    var $html="";
                    $.each(res,function (index,value) {
                        //指定人员中不显示当前用户
                        if(value.usrid != "<?php echo $_SESSION['userid']?>"){
                            $html += ' <li>';
                            $html += '<label>';
                            $html += '<input type="checkbox" class="cbr" personid="'+ value.usrid +'">';
                            $html += '<span style="margin-left: 10px;">' + value.userrealname + '</span>';
                            $html += '<span style="margin-left: 10px;">' + value.appartment + '</span>';
                            $html += '</label>';
                            $html += '</li>';
                        }
                    });
                    $("#topersons").append($html);
                }
            },
            error:function () {
                notifybox("error","网络异常，请稍后重试")
            }
        })
    };
    //加载指定群组中的内容
    function togroup() {
        $.ajax({
            url:"<?php echo getapiurl('listmyusergroupapi');?>",
            dataType:"json",
            // 不能加cache:false，否则娶不到数据
//                 cache:false,
            type:"get",
            data:{
                userid:"<?php echo $_SESSION['userid'] ;?>"
            },
            success:function (res) {
                if(res && res.usergroup){
                    var $html = '';
                    $.each(res.usergroup,function (index,value) {
                        $html += '<button class="groupbtn btn btn-gray btn-icon" groupid="'+value.id+'">';
                        $html += '<i class="fa-user"></i>';
                        $html += '<span>' + value.groupname+ '</span>';
                        $html += '</button>';
                    });
                    $("#togroupbtns").append($html);
                }
            },
            error:function(){

            }
        })
    };
    //加载公告列表中的内容
    function notifyInit(skip,limit) {
        $.ajax({
            url:"<?php echo getapiurl('listnotifyapi')?>",
            dataType:"json",
            cache:false,
            type:"get",
            data: {
                skip: skip,
                limit: limit
            },
            success:function (res) {
                if(res && res.notifys){
                    var $html = '';
                    if(res.notifys.length > 0){
                        $html += '<ul class="list-group">';
                    }
                    $.each(res.notifys,function (index,notify) {
                        $html += '<li class="eachnotify" notifyid="' + notify.id + '">';
                        $html += '<a class="center-block text-gray" style="font-size: 14px;" href="javascript:;">';
                        $html +=  notify.title;
                        $html += '</a>';
                        $html += '</li>';
                    });
                    if(res.notifys.length > 0){
                        $html += '</ul>';
                    };
                    if(res.notifys.length = limit && res.notifys.length > 0){
                        $html += '<div class="clearfix">';
                        $html += '<a href="?page=listNotifys" class="btn btn-info btn-xs">查看更多 >> </a>';
                        $html += '<div>';
                    }
                    $("#notifys").append($html);
                }
            },
            error:function () {

            }
        })
    }
</script>