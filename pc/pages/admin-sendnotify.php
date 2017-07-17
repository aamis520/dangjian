<section class="profile-env" style="position: relative;">
    <div class="row">
        <div class="col-sm-12">
            <!--对话框  开始-->
            <section class="mailbox-env">
                <div class="row">
                    <!-- Compose Email Form -->
                    <div class="col-sm-12 mailbox-left">
                        <div class="mail-compose" style="padding-bottom: 5px;">
                            <form method="post" role="form">
                                <div class="mail-header">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h3>
                                                公告发布
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="subject">标题：</label>
                                    <input type="text" class="form-control" id="subject" tabindex="1">
                                </div>
                                <div class="compose-message-editor">
                                    <textarea id="sample_wysiwyg" class="form-control wysihtml5" data-html="false" data-color="false" data-stylesheet-url="assets/css/wysihtml5-color.css" name="sample_wysiwyg"></textarea>
                                    <div class="row" style="padding-top: 20px;">
                                        <div class="col-sm-12 ">
                                            <button type="button" id="sendnotifybtn" class="btn btn-single btn-xs btn-success post-story-button pull-right">　发　布　</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!--            notifys-->
            <section id="notifys" class="user-timeline-stories">
            </section>
            <!--            loadmore-->
            <section id="loadmore" class="btn btn-block btn-default" style="background: #fff;">点击加载</section>
            <section id="nomore" class="text-center text-muted" style="font-size:14px;background: #fff;padding:10px 0;display: none;">到底了</section>
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
        //notify每次加载多少条
        var limit = 10;
        //页面初始化加载
        init(0,limit);
        
        //点击加载更多
        //点击次数
        var $loadcount = 1;
        $("#loadmore").click(function () {
            var skip = $loadcount * limit;
            init(skip,limit);
            $loadcount++;
        });

        //提交新的notify
        $("#sendnotifybtn").click(function(){
            //创建新的notify返回的id
            var createnotifyid = '';
            var createnotifytime = '';
            var title = $("#subject").val();
            var context = $("#sample_wysiwyg").val();
            if(title == ""){
                notifybox("warning","标题不可为空");
                return;
            }
            if(context == ""){
                notifybox("warning","内容不可为空");
                return;
            }
            //先提交内容
            $.ajax({
                url:"<?php echo getapiurl('createnotifyapi')?>",
                dataType:'json',
                cache:false,
                type:"get",
                data:{
                    ownerid:"<?php echo $_SESSION["userid"]?>",
                    context:context,
                    title:title
                },
                success:function (res) {
                    if(res && res.notify ){
                        createnotifyid = res.notify.id;
                        createnotifytime = res.notify.createdAt;
                        notifybox("success","发布成功");
                        //再刷新最新的notify
                        var $html = "";
                        $html += '<article class="newnotify timeline-story" style="display: none;" notifyid="'+ createnotifyid +'">';
                        $html += '<input type="hidden" class="notifyid" name="notifyid" value="'+ createnotifyid +'">';
                        $html += '<input type="hidden" class="ownerid" name="ownerid" value="<?php echo $_SESSION['userid']?>">';
                        $html += '<i class="fa-paper-plane-empty block-icon"></i>';
                        $html += '<header>';
                        $html += '<div class="user-details clearfix">';
                        $html += '<p class="pull-left"></p>';
                        $html += '<p class="pull-right"><button type="button" class="deletegonggao btn btn-single post-story-button btn-xs btn-danger" style="margin-left: 20px;">删除</button></p>';
                        $html += '<p class="pull-right">'+getNowDateFormat(createnotifytime)+'</p>';
                        $html += '</div>';
                        $html += '</header>';
                        $html += '<div class="clearfix">';
                        $html += '<h4 class="text-center">' + title + '</h4>';
                        $html += '<div>' + context + '</div>';
                        $html += '</article>';
                        $("#notifys").prepend($html);
                        $(".newnotify").fadeIn(1000);

                        //创建消息
                        $.ajax({
                            url:"<?php echo getapiurl('createmessageapi')?>",
                            dataType:'json',
                            cache:false,
                            type:"get",
                            data:{
                                userid:"<?php echo $_SESSION['userid']?>",
                                username:"<?php echo $_SESSION['userdetailinfo'][0]->userrealname?>",
                                notifytype:"notify",
                                notifyid:createnotifyid,
                                toall:1,
                                topage:"listNotifys",
                                content:title
                            },
                            success:function (res) {
                                if(res.status == 1){

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
                    notifybox("error","网络异常，请稍后重试")
                }
            })
        });

        //删除公告的confirm
        var deletenotifyid = "";
        $("#notifys").on("click",".deletegonggao",function () {
            deletenotifyid = $(this).parents("article").attr("notifyid");
            $('#deleteNotifyConfirm').modal('show', {backdrop: 'static'});
        });
        $("#deleteNotifySure").click(function () {
            $.ajax({
                url:"<?php echo getapiurl('deletenotifyapi')?>",
                dataType:"json",
                type:"get",
                cache:false,
                data:{
                    notifyid:deletenotifyid
                },
                success:function (res) {
                    if(res.status == "1"){
                        notifybox("success","删除成功");
                        window.location.reload();
                    }else if(res.status == "0"){
                        notifybox("error","删除失败");
                    }
                },
                error:function () {
                    
                }
            })
        })

    });
    //初始化加载
    function init(skip,limit) {
        $.ajax({
            url:"<?php echo getapiurl('listnotifyapi')?>",
            dataType:"json",
            cache:false,
            type:"get",
            data:{
                skip:skip,
                limit:limit
            },
            success:function (res) {
                if(res && res.notifys){
                    var $html = "";
                    $.each(res.notifys,function (index,notify) {
                        $html += '<article class="eachnotify timeline-story" style="display: none;" notifyid="'+ notify.id+'">';
                        $html += '<input type="hidden" class="notifyid" name="notifyid" value="'+ notify.id +'">';
                        $html += '<input type="hidden" class="ownerid" name="ownerid" value="'+ notify.ownerid +'">';
                        $html += '<i class="fa-paper-plane-empty block-icon"></i>';
                        $html += '<header>';
                        $html += '<div class="user-details clearfix">';
                        $html += '<p class="pull-left"><?php echo $_SESSION['userdetailinfo'][0]->userrealname?></p>';
                        $html += '<p class="pull-right"><button type="button" class="deletegonggao btn btn-single post-story-button btn-xs btn-danger" style="margin-left: 20px;">删除</button></p>';
                        $html += '<p class="pull-right">'+getNowDateFormat(notify.createdAt)+'</p>';
                        $html += '</div>';
                        $html += '</header>';
                        $html += '<h4 class="text-center">' + notify.title + '</h4>';
                        $html += '<div>' + notify.context + '</div>';
                        $html += '</article>';
                    });
                    $("#notifys").append($html);
                    $(".eachnotify").fadeIn(1000);
//                    判断消息条数少于指定的加载条数，notify加载更多按钮不显示
                    if(res.notifys.length < limit ){
                        $("#loadmore").hide();
                        $("#nomore").show();
                    }
                }
            },
            error:function () {
                console.log('失败了')
            }
        });
    }

</script>