<li class="dropdown user-profile">
    <a href="#" data-toggle="dropdown">
        <img id="user-image" src="avatar/default.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" height="28" />
            <span>
                <?php echo getsession('userdetailinfo')[0]->{"userrealname"};?>
			    <i class="fa-angle-down"></i>
			</span>
    </a>

    <ul class="dropdown-menu user-profile-menu list-unstyled">
        <li>
            <a href="?page=mywpfavority">
                <i class="fa-edit"></i>
               我的收藏
            </a>
        </li>
        <li>
            <a href="?page=personal">
                <i class="fa-user"></i>
                个人资料
            </a>
        </li>

		 <li>
            <a href="?page=uploadpic">
                <i class="fa-user"></i>
                上传头像
            </a>
        </li>
        <li>
            <a href="javascript:;" onclick = "$('#modal-6').modal('show',{backdrop:'static'})">
                <i class="fa-wrench"></i>
                修改密码
            </a>
        </li>
        <li class="last">
            <a href="?action=exit">
                <i class="fa-lock"></i>
                退出
            </a>
        </li>
    </ul>
</li>
<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			type:"GET",
			url:"<?php echo getapiurl('getuserprofileapi'); ?>",
			dataType:"json",
			data:{
				usrid:"<?php echo $_SESSION["userid"] ?>",
				live:1
			},
			success:function(res){
				res = eval(res);
				var data = res[0];
				if(!data.picurl && data.picurl != null){
					return false;
				}else{
					$('#user-image').attr('src',data.picurl);
				}
			},
			error:function(err){
				console.log(err);
			}
		});	
	});
</script>
