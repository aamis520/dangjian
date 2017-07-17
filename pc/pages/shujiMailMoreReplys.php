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
        if(topicid){
            $.ajax({
                url:"<?php echo getapiurl('mailcontentlistonetopicapi')?>",
                dataType:"json",
                type:"get",
                cache:false,
                data:{
                    topicid: topicid
                },
                success:function (res) {
                    console.log(res);
                    var userprofiles = res.userprofiles;
                    if(res && res.topics){
                        var topic = res.topics;
                        var $html = "";
                            $html += '<article class="eachtopic timeline-story" style="display: none;" topicid="'+ topic.id+'">';
                            $html += '<input type="hidden" class="topicid" name="topicid" value="'+ topic.id +'">';
                            $html += '<input type="hidden" class="ownerid" name="ownerid" value="'+ topic.ownerid +'">';
                            $html += '<input type="hidden" class="toid" name="toid" value="'+ topic.toid +'">';
                            $html += '<i class="fa-paper-plane-empty block-icon"></i>';
                            $html += '<header>';
                            $html += '<a  class="user-img">';
                            if(userprofiles[topic.ownerid].picurl != ""){
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
                            if(topic.mailtype == 'zhibu'){
                                $html += '<p class="pull-right text-success">　支部　</p>';
                            }else if(topic.mailtype == 'jiwei'){
                                $html += '<p class="pull-right text-warning">　纪委　</p>';
                            }else if(topic.mailtype == 'dangwei') {
                                $html += '<p class="pull-right text-info">　党委　</p>';
                            }
                            $html += '</div>';
                            $html += '</div>';
                            $html += '</header>';
                            $html += '<div class="story-content clearfix">';
                            $html += '<p class="topiccontext">'+ topic.context+'</p>';
                            if(topic.reply && topic.reply.length > 0){
                                $html += '<ul class="list-unstyled story-comments">';
                                $.each(topic.reply,function (index,reply) {
                                    $html += '<li class="eachreply" replyid="'+reply.id+'">';
                                    $html += '<div class="story-comment">';
                                    if(reply.shenfen == ""){
                                        $html += '<a  class="comment-user-img">';
                                        if(userprofiles[reply.ownerid].picurl){
                                            $html += '<img src="'+userprofiles[reply.ownerid].picurl+'" alt="user-img" class="img-circle img-responsive" width="50" height="50">';
                                        }else{
                                            $html += '<img src="avatar/default.png" alt="user-img" class="img-circle img-responsive" width="50" height="50">';
                                        }
                                    }
                                    $html += '</a>';
                                    $html += '<div class="story-comment-content">';
                                    $html += '<a  class="story-comment-user-name">';
                                    if(reply.shenfen == ""){
                                        $html +=  userprofiles[reply.ownerid].userrealname ;
                                    }else if(reply.shenfen == "dangwei"){
                                        $html += "党委书记";
                                    }else if(reply.shenfen == "jiwei"){
                                        $html += "纪委书记";
                                    }else if(reply.shenfen == "zhibu"){
                                        $html += "支部书记";
                                    }
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
                    notifybox("error","网络异常，请稍后重试");
                }
            })
        }else{
            console.log("未取得topicid")
        }

        //点击发送评论
        $("#topics").on("click","button.sendreply",function () {
            var $self = $(this);
            var topicid = $(this).closest("article").find(".topicid").val();
            var context = $(this).parents("article").find("textarea").val();
            var ownerid = "<?php echo $_SESSION["userid"];?>";

            //身份不为空则是纪委，支部，党委
            var touserid = "";
            if("<?php echo $_SESSION['userdetailinfo'][0]->shenfen?>" != ""){
                touserid = $(this).closest("article").find(".ownerid").val();
            }else{
                touserid = $(this).closest("article").find(".toid").val();
            }
            if(context == ""){
                notifybox("warning","内容不可为空");
                return;
            }
            $.ajax({
                url:"<?php echo getapiurl('mailcontentcreatereplyapi')?>",
                dataType:"json",
                type:"get",
                cache:false,
                data:{
                    ownerid:"<?php echo $_SESSION["userid"];?>",
                    topicid:topicid,
                    context:context,
                    shenfen:"<?php echo $_SESSION['userdetailinfo'][0]->shenfen?>"
                },
                success:function (res) {
                    if(res){
                        $self.parents("article").find("textarea").val("");
                        var $html = '';
                        //评论列表有li，不创建ul
                        if($self.closest("article").find("ul.story-comments").children("li").length > 0){
                        }else{
                            $html += '<ul class="list-unstyled story-comments">';
                        }
                        $html += '<li class="eachreply" replyid="'+res.reply.id+'" style="display: none;">';
                        $html += '<div class="story-comment">';
                        if("<?php echo $_SESSION['userdetailinfo'][0]->shenfen?>" == ""){
                            $html += '<a  class="comment-user-img">';
                            if("<?php echo $_SESSION['userdetailinfo'][0]->picurl?>" == ""){
                                $html += '<img src="avatar/default.png" alt="user-img" class="img-circle img-responsive" width="50" height="50">';
                            }else{
                                $html += '<img src="<?php echo $_SESSION['userdetailinfo'][0]->picurl?>" alt="user-img" class="img-circle img-responsive" width="50" height="50">';
                            }
                            $html += '</a>';
                        }
                        $html += '<div class="story-comment-content">';
                        $html += '<a class="story-comment-user-name">';
                        if("<?php echo $_SESSION['userdetailinfo'][0]->shenfen?>" == ""){
                            $html += '<?php echo $_SESSION['userdetailinfo'][0]->userrealname?>';
                        }else if("<?php echo $_SESSION['userdetailinfo'][0]->shenfen?>" == "dangwei"){
                            $html += '党委书记';
                        }else if("<?php echo $_SESSION['userdetailinfo'][0]->shenfen?>" == "jiwei"){
                            $html += '纪委书记';
                        }else if("<?php echo $_SESSION['userdetailinfo'][0]->shenfen?>" == "zhibu"){
                            $html += '支部书记';
                        }
                        $html += '<time>刚刚</time>';
                        $html += '</a>';
                        $html += '<p>' +　res.reply.context　+ '</p>';
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
                            $self.closest("article").find(".story-comment-form").before($html);
                        }
                        $(".eachreply").fadeIn(1000);

                        var fromusername = "<?php echo $_SESSION['userdetailinfo'][0]->userrealname?>";
                        if("<?php echo $_SESSION['userdetailinfo'][0]->shenfen?>" != ""){
                            fromusername = "<?php echo $_SESSION['userdetailinfo'][0]->shenfen?>"
                        }

                        //创建消息
                        $.ajax({
                            url:"<?php echo getapiurl('createmailmessageapi')?>",
                            dataType:"json",
                            type:"get",
                            cache:false,
                            data:{
                                userid:"<?php echo $_SESSION['userid']?>",
                                username:fromusername,
                                touserid:touserid,
                                replytocontext:context,
                                topage:getUrlParam("page"),
                                notifyid:topicid
                            },
                            success:function (res) {
                                if(res.mail){

                                }else{
                                }
                            },
                            error:function () {
                            }
                        })
                    }else{
                        notifybox("error","回复失败")
                    }
                },
                error:function () {
                    notifybox("error","网络异常，请稍后重试")
                }
            })
        })
    })
</script>