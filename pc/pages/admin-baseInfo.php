<?php
$url = getapiurl('getorginfo');
$orginfo = json_decode(mycurl($url));
?>

<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">基本信息</h3>
			</div>
			<div class="panel-body">
				<form role="form" class="form-horizontal">
					<!--姓名-->
					<div class="form-group">
						<label class="col-sm-2 control-label" for="field-1">组织描述</label>

						<div class="col-sm-10">
							<input class="form-control" id="field-1" placeholder="请输入组织名称" value="<?php echo $orginfo->{'name'};?>" type="text">
						</div>
					</div>
					<!--<div class="form-group-separator"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="field-2">组织LOGO</label>

						<div class="col-sm-10">
							<input class="form-control" id="field-2" type="file">
						</div>
						<img src="avatar/default.png"/>
					</div>-->
					<div class="form-group-separator"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="field-3">组织介绍</label>
						<div class="col-sm-10">
							<textarea rows="5"  class="form-control" id="field-3" placeholder="请输入组织介绍"><?php echo $orginfo->{"desciption"}?></textarea>
						</div>
					</div>
					<div class="form-group">
						<!--<button type="button" class="btn btn-gray btn-single">Sign in</button>-->
						<button id="submitorginfo" type="button" class="btn btn-success btn-single pull-right">　提　交　</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="assets/js/publicfunction.js"></script>
<script type="text/javascript">
    $(function()
    {
        $("#submitorginfo").click(function()
        {
            $.ajax
            ({
                type:"GET",
                url: "<?php echo $url = getapiurl('orgupdate');?>",
                dataType: "json",
                data:{
                    name:$("#field-1").val(),
                    desciption:$("#field-3").val()
                },
                success:function (res) {
                    if(res.id == "1"){
                        notifybox("success","提交成功")
                    }else{
                        notifybox("error","提交失败")
                    }
                }
            }).done();
        });
    });
</script>
