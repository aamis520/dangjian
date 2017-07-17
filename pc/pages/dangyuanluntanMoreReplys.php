<section class="profile-env" style="position: relative;">
    <div class="row">
        <div class="col-sm-12">
            <section id="topics" class="user-timeline-stories"></section>
        </div>
    </div>
</section>
<script src="assets/js/publicfunction.js"></script>
<script type="text/javascript">
    $(function () {
        var topicid = getUrlParam('topicid');
        if(topicid) {
            $.ajax({
                url: "<?php echo getapiurl('dangyuanluntanlistonetopicapi')?>",
                dataType: "json",
                type: "get",
                cache: false,
                data: {
                    topicid: topicid
                },
                success: function (res) {
                    var userprofiles = res.userprofiles;
                    if(res && res.topics){
                        var topic = res.topics;
                        var $html = "";
                        $html += '<article class="eachtopic timeline-story" style="display: none;" topicid="'+ topic.id+'">';
                        $html += '<input type="hidden" class="topicid" name="topicid" value="'+ topic.id +'">';
                        $html += '<input type="hidden" class="ownerid" name="ownerid" value="'+ topic.ownerid +'">'
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
                        }
                        $html += '<form class="story-comment-form">';
                        $html += '<textarea class="form-control input-unstyled autogrow" placeholder="评论..." style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 76px;"></textarea>';
                        $html += '</form>';
                        $html += '<button class="sendreply btn btn-single btn-xs btn-success post-story-button pull-right" >  发  表  </button>';
                        $html += '</article>';

                        $("#topics").append($html);
                        $(".eachtopic").fadeIn(1000);

                    }
                },
                error:function () {
                    notifybox("error","网络异常，请稍后重试")
                }
            })
        }else{
            console.log("未取得topicid")
        };

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

        //发送评论
        $("#topics").on('click','button.sendreply',function () {
            //保存this
            var $self = $(this);
            var topicid = $(this).closest("article").find(".topicid").val();
            var topicownerid = $(this).closest("article").find(".ownerid").val();
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
                        notifybox("error","回复失败");
                    }
                },
                error:function () {
                    notifybox("error","回复失败");
                }
            })
        })
    })
</script>