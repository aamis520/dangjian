<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><strong>头像上传</strong></h3>
			</div>
			<div class="panel-body">
				<form target="nm_iframe" name="uploadForm" method="post" id="uploadForm" enctype="multipart/form-data" class="form-horizontal" action="<?php echo getmainapi('uploadavatar'); ?>">
					<input name="usrid" id="input" type="hidden" value="<?php echo $_SESSION['userid']; ?>" />
					<div class="form-group">
						<div class="col-sm-2">
						</div>
						<div class="col-sm-10">
							<div class="img_show img_show1">
							  <img src="assets/images/user-4.png" width="120" height="120" alt="user-image" id="user-img" style="object-fit: cover;">
							 
							</div>
						</div>
					</div>
					<div class="form-group-separator"></div>
					<div class="form-group">
						<div class="col-sm-2"></div>
						<div class="col-sm-10 ">
							<input type="file" class="upfile" name="file" style="cursor: pointer;">
							<p style="line-height: 34px;">建议上传200×200像素的jpg或png图片，文件大小需小于100KB</p>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 pull-right">
							<button type="submit" class="btn btn-success btn-single pull-right" id="fileSubmit">　提　交　</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<iframe id="id_iframe" name="nm_iframe" style="display:none;"></iframe>  

<script type="text/javascript">
	$(document).ready(function() {
		//预览图片
		var DS = function() {
			$('.img_show').each(function() {
				$('.upfile').on('change', function() {
					var file = $(this)[0].files[0],
						imgSrc = $(this)[0].value,
						url = URL.createObjectURL(file);
					var picurl = "avatar/"+"<?php echo $_SESSION["userid"]; ?>"+".jpg";
					//判断上传文件类型
					var size = parseInt(file.size/1024);
					if(size > 100){
						//图片过大
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
							toastr.error("图片大小不得超过100KB，请更换新的图片作为您的头像","",opts);
						})();
						return false;
					}
					if(!/\.(jpg|jpeg|png|JPG|PNG|JPEG)$/.test(imgSrc)) {
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
							toastr.error("请上传jpg或png格式的图片","",opts);
						})();
						return false;
					} else {
						$('#user-img').attr('src', url);
						$('#user-img').css({ 'opacity': '1' });
						
					}
					$('#uploadForm').on('submit',function(){
						//将图片的路径更新到个人资料
						$.ajax({
							type:"GET",
							url:"<?php echo getapiurl('updatepicurlapi'); ?>",
							dataType:"json",
							data:{
								usrid:"<?php echo $_SESSION["userid"] ?>",
								picurl:picurl
							},
							success:function(res){
								if(res.usrid){
									//上传成功
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
										toastr.success("头像设置成功","",opts);
									})();
									setTimeout(function(){
										window.location.reload();
									},1000);
								}
							},
							error:function(err){
								console.log(err);
							}
						});
						return true;
					});
				});
			});
			
		}();
		//判断文件大小

		//下载
        function gosubmit2(){
            $("#uploadForm").ajaxSubmit({
                data:{
                  usrid:"<?php echo $_SESSION['userid']; ?>"
                },
                dataType :'json',//返回数据类型
                success:function(data){//图片上传成功时
                    //获取服务器端返回的文件数据
                    console.log(111);
                    alert(data.name+","+data.pic+","+data.size);
                },
                error:function(xhr){
                    alert("上传失败");
                }
            });
        }
	});
</script>