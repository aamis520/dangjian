<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default" id="policyProval">
            <div class="panel-heading">
                <h3 class="panel-title">申请成为<span>预备党员</span></h3>
            </div>
            <div class="panel-body">
                <form role="form" class="form-horizontal" id="myform">
                    <!--姓名-->
                    <div class="form-group" style="display: none;">
                        <label class="col-sm-2 control-label" for="field-1"></label>
                        <div class="col-sm-10">
                            您已经是正式党员
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="field-1">姓名</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="field-1" placeholder="请输入姓名" disabled="disabled" type="text" value="">
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">性别</label>

                        <div class="col-sm-10" id="sex" name="男">
                            <input class="form-control" id="field-sex" placeholder="请输入姓名" disabled="disabled" type="text" value="">
                            <!--<p>
                                <label class="radio-inline">
                                    <input name="radio-2" checked="" type="radio" value="男">
                                    男
                                </label>
                                <label class="radio-inline">
                                    <input name="radio-2" type="radio" value="女">
                                    女
                                </label>
                            </p>-->

                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="field-2">民族</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="field-2" placeholder="" type="text" value="" >
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <!--政治面貌-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">政治面貌</label>

                        <div class="col-sm-10">
                            <select class="form-control" id="policyStatus">
                                <option>积极分子</option>
                                <option>团员</option>
                                <option>群众</option>
                                <option>预备党员</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group-separator"></div>
                    <!--上传-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="field-4">上传申请书</label>
                        <div class="col-sm-10" id="uploadZip">
                            <input class="form-control" id="field-4" type="file"/>
                            <input type="hidden" name="" id="" value="<?php echo $_SESSION["userid"]; ?>" />
                            <p style="padding-top: 5px;font-size: 12px;font-family: '微软雅黑';">请上传小于2M以内的压缩文件，文件格式支持 .zip .rar .tar .cab .arj .gzip .jar .z格式的文件</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="" id="touser" value="" />
                        <button type="button" class="btn btn-success btn-single pull-right" id="provalBtn">　提　交　</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        //姓名 性别自动填写
        $.ajax({
            type:"GET",
            url:"<?php echo getapiurl('getuserprofileapi'); ?>",
            dataType:"json",
            data:{
                usrid:"<?php echo $_SESSION["userid"]; ?>",
                live:1
            },
            success:function(res){
                if(res[0] && res[0].usrid){
                    var data = res[0];
                    var username = data.userrealname;
                    var sex = data.sex;
                    $('#field-1').val(username);
                    $('#field-sex').val(sex);
                }
            },
            error:function(err){
                console.log(err);
            }
        });
        //判断申请状态  积极还是预备
        $('#policyProval .panel-body .form-group:first-child').hide();
        $('#policyStatus').on('change',function(){
            if($('#policyStatus').val() == "团员"){
                $('#policyProval h3 span').text("积极分子");
                $('#touser').val("jijiapprover");
            }else
            if($('#policyStatus').val() == "群众"){
                $('#policyProval h3 span').text("积极分子");
                $('#touser').val("jijiapprover");
            }else
            if($('#policyStatus').val() == "积极分子"){
                $('#policyProval h3 span').text("预备党员");
                $('#touser').val("yubeiapprover");
            }else
            if($('#policyStatus').val() == "预备党员"){
                $('#policyProval h3 span').text("正式党员");
                $('#touser').val("dangyuanapprover");
            }else
            if($('#policyStatus').val() == "党员"){
                $('#policyProval h3').remove('span');
                $('#policyProval h3').text("我要入党");
                $('#policyProval .panel-body .form-group').hide();
                $('#policyProval .panel-body .form-group-separator').hide();
                $('#policyProval .panel-body .form-group:first-child').show();
            }
        });
        //
        $('#field-4').on('change',function(){
            var file = $(this)[0].files[0];
            var filetype = $(this)[0].value;
            var filename = file.name;
            var filesize = Math.ceil(file.size/(1024*1024));
            if(filesize > 2){
                //文件过大
                (function(){
                    var opts = {
                        "closeButton":false,
                        "debug":false,
                        "positionClass":"toast-top-full-width",
                        "onclick":null,
                        "showDuration":"300",
                        "hideDuration":"1000",
                        "timeout":"3000",
                        "extndedTimeout":"1000",
                        "showEasing":"swing",
                        "showMethod":"fadeIn",
                        "hideMethod":"fadeOut"
                    };
                    toastr.error("文件大小不得超过2M","",opts);
                })();
                return false;
            }
            if(!/\.(zip|rar|tar|cab|arj|gzip|jar|z)$/.test(filetype)) {
                (function(){
                    var opts = {
                        "closeButton":false,
                        "debug":false,
                        "positionClass":"toast-top-full-width",
                        "onclick":null,
                        "showDuration":"300",
                        "hideDuration":"1000",
                        "timeout":"3000",
                        "extndedTimeout":"1000",
                        "showEasing":"swing",
                        "showMethod":"fadeIn",
                        "hideMethod":"fadeOut"
                    };
                    toastr.error("请把文件以压缩文件形式上传","",opts);
                })();
                return false;
            }
            //文件发生变化就上传附件
            var form = new FormData(document.getElementById("myform"));
            form.append("usrid", "<?php echo $_SESSION["userid"]; ?>");
            form.append("file", document.getElementById("field-4").files[0]);
            $.ajax({
                url:"<?php echo getmainapi('uploadshenqing'); ?>",
                type:"post",
                data:form,
                processData:false,
                contentType:false,
                success:function(data){//图片上传成功时
                    //获取服务器端返回的文件数据
                   var filename = data.filename;
                   var touser = $('#touser').val();
		            if(touser == ""){
		                touser = "yubeiapprover";
		            }
                },
                error:function(err){
                	console.log(err);
                }
            });
        });
        //提交申请
        $('#provalBtn').on('click',function(){
            var touser = $('#touser').val();
            if(touser == ""){
                touser = "yubeiapprover";
            }
            //判断
            if($('#field-1').val() == ""){
                (function(){
                    var opts = {
                        "closeButton":false,
                        "debug":false,
                        "positionClass":"toast-top-full-width",
                        "onclick":null,
                        "showDuration":"300",
                        "hideDuration":"1000",
                        "timeout":"3000",
                        "extndedTimeout":"1000",
                        "showEasing":"swing",
                        "showMethod":"fadeIn",
                        "hideMethod":"fadeOut"
                    };
                    toastr.error("姓名不得为空","",opts);
                })();
                return false;
            }
            if($('#field-2').val() == ""){
                (function(){
                    var opts = {
                        "closeButton":false,
                        "debug":false,
                        "positionClass":"toast-top-full-width",
                        "onclick":null,
                        "showDuration":"300",
                        "hideDuration":"1000",
                        "timeout":"3000",
                        "extndedTimeout":"1000",
                        "showEasing":"swing",
                        "showMethod":"fadeIn",
                        "hideMethod":"fadeOut"
                    };
                    toastr.error("请输入您的民族","",opts);
                })();
                return false;
            }
            if($('#field-4').val() == ""){
                (function(){
                    var opts = {
                        "closeButton":false,
                        "debug":false,
                        "positionClass":"toast-top-full-width",
                        "onclick":null,
                        "showDuration":"300",
                        "hideDuration":"1000",
                        "timeout":"3000",
                        "extndedTimeout":"1000",
                        "showEasing":"swing",
                        "showMethod":"fadeIn",
                        "hideMethod":"fadeOut"
                    };
                    toastr.error("请上传附件","",opts);
                })();
                return false;
            }
            //在判断一次文件大小
            var file = $('#field-4:file')[0].files[0];
            var filetype = $('#field-4:file')[0].value;
            var filename = file.name;
            var filesize = Math.ceil(file.size/(1024*1024));
            if(filesize > 2){
                //文件过大
                (function(){
                    var opts = {
                        "closeButton":false,
                        "debug":false,
                        "positionClass":"toast-top-full-width",
                        "onclick":null,
                        "showDuration":"300",
                        "hideDuration":"1000",
                        "timeout":"3000",
                        "extndedTimeout":"1000",
                        "showEasing":"swing",
                        "showMethod":"fadeIn",
                        "hideMethod":"fadeOut"
                    };
                    toastr.error("文件大小不得超过2M","",opts);
                })();
                return false;
            }
            if(!/\.(zip|rar|tar|cab|arj|gzip|jar|z)$/.test(filetype)) {
                (function(){
                    var opts = {
                        "closeButton":false,
                        "debug":false,
                        "positionClass":"toast-top-full-width",
                        "onclick":null,
                        "showDuration":"300",
                        "hideDuration":"1000",
                        "timeout":"3000",
                        "extndedTimeout":"1000",
                        "showEasing":"swing",
                        "showMethod":"fadeIn",
                        "hideMethod":"fadeOut"
                    };
                    toastr.error("请把文件以压缩文件形式上传","",opts);
                })();
                return false;
            }
            //通过touser获取 审批人 id
            $.ajax({
                type:"GET",
                url:"<?php echo getapiurl('getuserprofileapi'); ?>",
                dataType:"json",
                data:{
                    capability:touser
                },
                success:function(res){
                    res = eval(res);
                    var tousrid = res[0].usrid;
                    $.ajax({
                        type:"GET",
                        //创建申请 接口
                        url:"<?php echo getapiurl('newserviceflowapi');?>",
                        data:{
                            fromusrid:"<?php echo $_SESSION["userid"]; ?>",
                            tousrid:tousrid,
                            sex:$('#field-sex').val(),
                            provalname:$('#field-1').val(), //申请人姓名
                            politicalstatus:$('#policyStatus').val(), //政治面貌
                            nation:$('#field-2').val(), //民族
                            provaldoc:filename,
                            provalstatus:"申请中",
                            //申请人姓名 民族  政治面貌  申请书 类型 状态 向谁申请
                            touser:touser
                        },
                        dataType:"json",
                        success:function(res){
                            if(res){
                                //
                                //给审批发申请  给审批人发送通知
                                $.ajax({
                                    type:"GET",
                                    url:"<?php echo getapiurl('createmessageapi'); ?>",
                                    dataType:"json",
                                    data:{
                                        userid:"<?php echo $_SESSION["userid"]; ?>",//发送消息的人
                                        touserid:tousrid,//接收消息的人
                                        username:$('#field-1').val(),//发送消息的人名
                                        notifytype:"request",//消息类型
                                        isagree:2,
                                        topage:"joinProvalList"
                                    },
                                    success:function(res){
                                        (function(){
                                            var opts = {
                                                "closeButton":false,
                                                "debug":false,
                                                "positionClass":"toast-top-full-width",
                                                "onclick":null,
                                                "showDuration":"300",
                                                "hideDuration":"1000",
                                                "timeout":"3000",
                                                "extndedTimeout":"1000",
                                                "showEasing":"swing",
                                                "showMethod":"fadeIn",
                                                "hideMethod":"fadeOut"
                                            };
                                            toastr.success("申请成功","",opts);
                                        })();
                                        setTimeout(function(){
											window.location.href = "?page=myProval";
                                        },1500);
                                    },
                                    error:function(err){
                                        console.log(err);
                                    }
                                });
                            }
                        },
                        error:function(err){
                            console.log(err)
                        }
                    });
                }
            });
            return true;
        })

    });
</script>