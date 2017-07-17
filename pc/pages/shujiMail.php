<link rel="stylesheet" href="assets/js/wysihtml5/src/bootstrap-wysihtml5.css">
<section class="profile-env" style="position: relative;">
    <section class="mailbox-env">
        <div class="row">
            <div class="col-sm-12 mailbox">
                <div class="mail-compose">
                    <!-- Header Title and Button Options -->
                    <div class="mail-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>
                                    <i class="linecons-pencil"></i>
                                    写邮件
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="mail-compose" style="padding-bottom: 0;">
                        <form method="post" role="form">
                            <div class="compose-message-editor">
                                <div class="vertical-top clearfix" id="chooseArea">
                                    <div class="pull-left">发送给：</div>
                                    <div id="btngroup" class="pull-left">
                                        <a href="javascript:;" id="todangwei" class="btn btn-gray btn-xs" type="dangwei" toid="">　党委　</a>
                                        <a href="javascript:;" id="tojiwei" class="btn btn-gray btn-xs" type="jiwei" toid="">　纪委　</a>
                                        <a href="javascript:;" id="tozhibu" class="btn btn-gray btn-xs" type="zhibu" toid="">　支部　</a>
                                    </div>
                                </div>
                                <textarea id="sample_wysiwyg" class="form-control wysihtml5" data-html="false" data-color="false" data-stylesheet-url="assets/css/wysihtml5-color.css" name="sample_wysiwyg"></textarea>
                                <div class="row" style="padding-top: 20px;">
                                    <div class="col-sm-6">
                                        <!--<input type="file"  value="上传附件" class="btn btn-xs" value="上传附件" />-->
                                        <div class="file-box" style="position: relative;">
                                            <input type="file" name="fileField" class="file" id="fileField" size="28" onchange="document.getElementById('textfield').value=this.value" style="position:absolute; top:0; left:0; height:24px; filter:alpha(opacity:0);opacity: 0;width:80px;" />
                                            <!--<button type="submit" name="submit" class="btn btn-xs" />-->
                                            <!--<i class="fa-upload"></i>-->
                                            <!--<span>上传附件</span>-->
                                            <!--</button>-->
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
        </div>
    </section>
    <section id="topics" class="user-timeline-stories"></section>
    <section id="loadmore" class="btn btn-block btn-default" style="background: #fff;display: none;">点击加载</section>
    <section id="nomore" class="text-center text-muted" style="font-size:14px;background: #fff;padding:10px 0;display: none;">暂无更多消息</section>
</section>
<script src="assets/js/wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
<script src="assets/js/wysihtml5/src/bootstrap-wysihtml5.js"></script>
<script src="assets/js/publicfunction.js"></script>
<script type="text/javascript">
   $(function () {
       var topicskip = 0;
       var topiclimit = 10;
       var replyskip = 0;
       var replylimit = 2;
       InitTopics(topicskip,topiclimit,replyskip,replylimit);

        //点击加载更多
       //点击次数
       var $topicloadcount = 1;
       $("#loadmore").click(function () {
           var topicskip = $topicloadcount * topiclimit;
           InitTopics(topicskip,topiclimit,0,replylimit);
           $topicloadcount++;
       });
       //设置按钮的党委，纪委，支部id
       $.ajax({
           url:"<?php echo getapiurl('getmailinfo')?>",
           dataType:'json',
           type:'get',
           cache:false,
           data:{
             usrid:"<?php echo $_SESSION['userid']?>"
           },
           success:function (res) {
               if(res) {
                   $("#todangwei").attr("toid", res.org[0].dangweiid);
                   $("#tojiwei").attr("toid", res.org[0].jiweiid);
                   $("#tozhibu").attr("toid", res.org[0].zhibuid);
               }else{

               }
           },
           error:function () {

           }
       });

       //发送给谁的id
       var toid = "";
       var mailtype = "";
        $("#btngroup").children("a").click(function () {
            $(this).toggleClass("btn-gray btn-turquoise").siblings().removeClass("btn-turquoise").addClass("btn-gray");
            toid = $(this).attr("toid");
            mailtype = $(this).attr("type");
        });



        //点击发送topic
       $("#sendtopicbtn").click(function () {
           var ownerid = "<?php echo $_SESSION["userid"]?>";
           var ownername = "<?php echo $_SESSION['userdetailinfo'][0]->userrealname?>";
           var context = $("#sample_wysiwyg").val();

           if(toid == ""){
               notifybox("warning","请选择发送对象");
               return;
           }
           if(context == ""){
               notifybox("warning","内容不可为空");
               return;
           }

           $.ajax({
               url:"<?php echo getapiurl('mailcontentcreatetopicapi')?>",
               dataType:'json',
               type:'get',
               cache:false,
               data:{
                   ownerid:"<?php echo $_SESSION["userid"]?>",
                   toid:toid,
                   context:context,
                   mailtype:mailtype
               },
               success:function (res) {
                   if(res && res.topic){
                       notifybox("success","发布成功");
                       var $html = "";
                       $html += '<article class="newtopic timeline-story" style="display: none;" topicid="'+ res.topic.id +'">';
                       $html += '<input type="hidden" class="topicid" name="topicid" value="'+ res.topic.id +'">';
                       $html += '<input type="hidden" class="ownerid" name="ownerid" value="'+ ownerid +'">';
                       $html += '<input type="hidden" class="toid" name="toid" value="'+ toid +'">';
                       $html += '<i class="fa-paper-plane-empty block-icon"></i>';
                       $html += '<header>';
                       $html += '<a class="user-img">';
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
                       if(mailtype == 'jiwei' ){
                           $html += '<span class="text-warning pull-right">　纪委　</span>';
                       }else if(mailtype == "zhibu"){
                           $html += '<span class="text-success pull-right">　支部　</span>';
                       }else if(mailtype == "dangwei"){
                           $html += '<span class="text-info pull-right">　党委　</span>';
                       }
                       $html += '</div>';
                       $html += '</header>';
                       $html += '<div class="story-content clearfix">';
                       $html += '<p class="topiccontext">' + context + '</p>';
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
                   };

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
                           touserid:toid,
                           topage:getUrlParam("page"),
                           notifyid:res.topic.id,
                           context:context,
                           mailtype:'topic'
                       },
                       success:function (res) {
                           if(res.mail){

                           }else{
                           }
                       },
                       error:function () {
                       }
                   })
               },
               error:function () {
               }
           })
       });

       //点击发送评论
       $("#topics").on("click","button.sendreply",function () {
           var $self = $(this);
           var topicid = $(this).closest("article").find(".topicid").val();
           var context = $(this).parents("article").find("textarea").val();
           var topiccontext = $(this).closest("article").find(".topiccontext").html();
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
                       notifybox("success","发布成功");
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
                       $html += '<p class="topiccontext">' +　res.reply.context　+ '</p>';
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
                               context:context,
                               topiccontext:topiccontext,
                               topage:getUrlParam("page"),
                               notifyid:topicid,
                               mailtype:'reply'
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
                   }
               },
               error:function () {
                   notifybox("error","网络异常，请稍后重试")
               }
           })
       })
   });
   //初始化加载
    function InitTopics(topicskip,topiclimit,replyskip,replylimit) {
        $.ajax({
            url:"<?php echo getapiurl('mailcontentlisttopicapi')?>",
            dataType:"json",
            type:"get",
            cache:false,
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
                            //判断replynum大于replylimit，显示查看更多评论按钮
                            if(topic.reply.length >= replylimit) {
                                $html += '<div class="col-sm-12 clearfix" style="height:30px;margin-bottom: 10px;">';
                                $html += '<a href="?page=shujiMailMoreReplys&topicid='+topic.id+'" class="btn btn-xs btn-single btn-info pull-right">查看更多评论</a>';
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
                notifybox("error","网络异常，请稍后重试");
            }
        }).done(function () {
            //点击消息滚动到指定位置
            scrolltotarget();
            })
    }
</script>