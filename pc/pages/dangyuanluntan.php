<section class="profile-env" style="position: relative;">
    <?php global $requestfromdangjianapp; if(!$requestfromdangjianapp) {?>
    <nav class="navbar navbar-default " role="navigation" style="padding-left: 30px; ">
        <h4>党员论坛</h4>
    </nav>
    <?php }?>
    <div class="row">
        <div class="col-sm-12">
            <!--对话框  开始-->
            <section class="mailbox-env">
                <div class="row">
                    <!-- Compose Email Form -->
                    <div class="col-sm-12 mailbox-left">
                        <div class="mail-compose" style="padding-bottom: 5px;">
                            <form method="post" role="form">
                                <div class="compose-message-editor">
                                    <textarea id="sample_wysiwyg" class="form-control wysihtml5" data-html="false" data-color="false" data-stylesheet-url="assets/css/wysihtml5-color.css" name="sample_wysiwyg"></textarea>
                                    <div class="row" style="padding-top: 20px;">
                                        <div class="col-sm-6">
                                            <!--<input type="file"  value="上传附件" class="btn btn-xs" value="上传附件" />-->
                                            <div class="file-box" style="position: relative;">
                                                <input type="file" name="fileField" class="file" id="fileField" size="28" onchange="document.getElementById('textfield').value=this.value" style="position:absolute; top:0; left:0; height:24px; filter:alpha(opacity:0);opacity: 0;width:80px;" />
<!--                                                <button type="submit" name="submit" class="btn btn-xs" />-->
<!--                                                <i class="fa-upload"></i>-->
<!--                                                <span>上传附件</span>-->
<!--                                                </button>-->
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
            <section id="topics" class="user-timeline-stories">
            </section>
            <!--            loadmore-->
            <section id="loadmore" class="btn btn-block btn-default" style="background: #fff;display: none;">点击加载</section>
            <section id="nomore" class="text-center text-muted" style="font-size:14px;background: #fff;padding:10px 0;display: none;">暂无更多消息</section>
        </div>
    </div>
</section>
<link rel="stylesheet" href="assets/js/wysihtml5/src/bootstrap-wysihtml5.css">
<script src="assets/js/wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
<script src="assets/js/wysihtml5/src/bootstrap-wysihtml5.js"></script>
<script src="assets/js/toastr/toastr.min.js"></script>
<script src="assets/js/publicfunction.js"></script>
<script type="text/javascript">
    $(function () {

        //topic每次加载多少条
        var topiclimit = 10;
        //reply每次加载多少条
        var replylimit = 2;
        //页面初始化加载
        init(0,topiclimit,0,replylimit);

        //点击加载更多
        //点击次数
        var $loadcount = 1;
        $("#loadmore").click(function () {
            var topicskip = $loadcount * topiclimit;
            init(topicskip,topiclimit,0,replylimit);
            $loadcount++;
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
            zannumber = parseInt(zannumber) + 1 ;
            var $self = $(this);
            $.ajax({
                url:"<?php echo getapiurl('dangyuanluntanupdatezantopicapi')?>",
                dataType:"json",
                cache:false,
                type:"get",
                data:{
                    topicid:topicid
                },
                success:function (res) {
                    if(res && res.result){
                        $self.find("span").html(zannumber);
                    }
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
            if(context == ""){
                notifybox("warning","内容不可为空");
                return;
            }
            //先提交内容
            $.ajax({
                url:"<?php echo getapiurl('dangyuanluntancreatetopicapi')?>",
                dataType:'json',
                cache:false,
                type:"get",
                data:{
                    ownerid:"<?php echo $_SESSION["userid"]?>",
                    context:context
                },
                success:function (res) {
                    if(res && res.id){
                        createtopicid = res.id;
                        notifybox("success","发表成功");

                        //再刷新最新的topic
                        var $html = "";
                        $html += '<article class="newtopic timeline-story" style="display: none;" topicid="'+ createtopicid +'">';
                        $html += '<input type="hidden" class="topicid" name="topicid" value="'+ createtopicid +'">';
                        $html += '<input type="hidden" class="ownerid" name="ownerid" value="'+ ownerid +'">';
                        $html += '<i class="fa-paper-plane-empty block-icon"></i>';
                        $html += '<header>';
                        $html += '<a  class="user-img">';
                        if("<?php echo $_SESSION['userdetailinfo'][0]->picurl?>" == ""){
                            $html += '<img src="avatar/default.png" alt="user-img" class="img-responsive img-circle" width="50" height="50">';
                        }else{
                            $html += '<img src="<?php echo $_SESSION['userdetailinfo'][0]->picurl?>" alt="user-img" class="img-responsive img-circle" width="50" height="50">';
                        }
                        $html += '</a>';
                        $html += '<div class="user-details">';
                        $html += '<span><?php echo $_SESSION['userdetailinfo'][0]->userrealname?></span>';
                        $html += '<time>刚刚</time>';
                        $html += '</div>';
                        $html += '</header>';
                        $html += '<div class="story-content clearfix">';
                        $html += '<p class="topiccontext">' + context + '</p>';
                        $html += '<div class="story-options-links">';
                        $html += '<a href="#" class="zannum">';
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
                        $html += '<button class="sendreply btn btn-single btn-xs btn-success post-story-button pull-right">　发　表  </button>';
                        $html += '</article>';
                        $("#topics").prepend($html);
                        $(".newtopic").fadeIn(1000);

                        //创建消息
                        $.ajax({
                            url:"<?php echo getapiurl('createmessageapi')?>",
                            dataType:'json',
                            cache:false,
                            type:"get",
                            data:{
                                userid:"<?php echo $_SESSION['userid']?>",
                                username:"<?php echo $_SESSION['userdetailinfo'][0]->userrealname?>",
                                toall:1,
                                notifytype:"message",
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
                        notifybox("error","发表失败");
                    }
                },
                error:function () {
                    notifybox("error","网络不好，请稍后重试")
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
            replynumber = parseInt(replynumber) + 1;
            if(context == ""){
                notifybox("warning","内容不可为空");
                return;
            }
            //更新replynum
            $.ajax({
                url:"<?php echo getapiurl('dangyuanluntanupdatereplynumtopicapi')?>",
                dataType:"json",
                type:"get",
                cache:false,
                data:{
                    topicid:topicid
                },
                success:function (res) {
                    $self.closest("article").find(".replynum>span").html(replynumber);
                },
                error:function () {

                }
            });

            //创建reply
            $.ajax({
                url:"<?php echo getapiurl('dangyuanluntancreatereplyapi')?>",
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
                        $html += '<a  class="story-comment-user-name">';
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
                        if("<?php echo $_SESSION['userid']?>" != topicownerid) {
                            //创建消息
                            $.ajax({
                                url: "<?php echo getapiurl('createmessageapi')?>",
                                dataType: 'json',
                                cache: false,
                                type: "get",
                                data: {
                                    userid:"<?php echo $_SESSION['userid']?>",
                                    username: "<?php echo $_SESSION['userdetailinfo'][0]->userrealname?>",
                                    touserid: topicownerid,
                                    notifytype: 'reply',
                                    notifyid: topicid,
                                    topage: getUrlParam('page'),
                                    context: context,
                                    topiccontext: topiccontext
                                },
                                success: function (res) {
                                    if (res.status == 0) {

                                    } else {

                                    }
                                },
                                error: function () {

                                }
                            });
                        }
                    }else{
                        notifybox("error","回复失败");
                    }
                },
                error:function () {
                    notifybox("error","回复失败");
                }
            })
        })
    });
    //初始化加载
    function init(topicskip,topiclimit,replyskip,replylimit) {
        var ownerid = "<?php echo $_SESSION['userid']?>";
        $.ajax({
            url:"<?php echo getapiurl('dangyuanluntanlisttopicapi')?>",
            dataType:"json",
            cache:false,
            type:"get",
            data:{
                ownerid:ownerid,
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
                        $html += '<article class="eachtopic timeline-story" style="display: none;" topicid="'+ topic.id+'">';
                        $html += '<input type="hidden" class="topicid" name="topicid" value="'+ topic.id +'">';
                        $html += '<input type="hidden" class="ownerid" name="ownerid" value="'+ topic.ownerid +'">';
                        $html += '<i class="fa-paper-plane-empty block-icon"></i>';
                        $html += '<header>';
                        $html += '<a  class="user-img">';
                        if(userprofiles[topic.ownerid].picurl){
                            $html += '<img src="'+ userprofiles[topic.ownerid].picurl+'" alt="user-img" class="img-responsive img-circle" width="50" height="50">';
                        }else {
                            $html += '<img src="avatar/default.png" alt="user-img" class="img-responsive img-circle" width="50" height="50">';
                        }
                        $html += '</a>';
                        $html += '<div class="user-details">';
                        $html += '<span>'+ userprofiles[topic.ownerid].userrealname +'</span>';
                        $html += '<time>'+ getDateDiff(topic.createdAt)+'</time>';
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
                                $html += '<a href="?page=dangyuanluntanMoreReplys&topicid='+topic.id+'" class="btn btn-xs btn-single btn-info pull-right">查看更多评论</a>';
                                $html += '</div>';
                            }
                        }
                        $html += '<form class="story-comment-form">';
                        $html += '<textarea class="form-control input-unstyled autogrow" placeholder="评论..." style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 76px;"></textarea>';
                        $html += '</form>';
                        $html += '<button class="sendreply btn btn-single btn-xs btn-success post-story-button pull-right" >  发  表  </button>';
                        $html += '</article>';
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

</script>