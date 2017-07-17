<li id="toFrontBtn" class="" style="display: none;">
	<a href="?page=personCenter">
        <span>回到前端</span>
	</a>
</li>
<li id="toBackBtn" class="" style="display: none;">
	<a href="?page=admin-baseInfo">
        <span>进入后台</span>
	</a>
</li>
<script src="assets/js/publicfunction.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			type:"GET",
			url:"<?php echo getapiurl('getuserprofileapi'); ?>",
			data:{
				usrid:"<?php echo $_SESSION["userid"]; ?>",
				live:1
			},
			dataType:"json",
			success:function(res){
				res = eval(res);
				if(res[0].isadmin == true || res[0].isadmin == "true"){
                    var curPage = getUrlParam('page');
                    console.log(curPage)
                    var re = /^admin-/;
                    if(re.test(curPage)){
                        $("#toFrontBtn").show();
                        $("#toBackBtn").hide();
                    }else{
                        $("#toFrontBtn").hide();
                        $("#toBackBtn").show();
                    }
				}else{
					$("#toFrontBtn").hide();
                    $("#toBackBtn").hide();
				}
				if(res[0].capability == "dangyuanapprover" || res[0].capability == "jijiapprover" || res[0].capability == "yubeiapprover" ){
					$('#isProval').show();
				}else{
					$('#isProval').hide();
				}
			},
			error:function(error){

			}
		});
	});
</script>