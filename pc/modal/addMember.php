<?php ?>
<div class="modal fade" id="modal-2">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				×
				</button>
				<h4 class="modal-title">创建新用户</h4>
			</div>

			<div class="modal-body">
				<!--name-->
				<div class="row">
					<div class="col-md-6">

						<div class="form-group">
							<label for="field-1" class="control-label">姓名</label>

							<input class="form-control" id="field-1" placeholder="请输入姓名" type="text">
						</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">
							<label for="field-2" class="control-label">手机号码</label>

							<input class="form-control" id="field-2" placeholder="" type="text">
						</div>

					</div>
				</div>
				<!--sex-->
				<div class="row">
					<div class="col-md-12">

						<div class="form-group" id="sex" name="男">
							<label for="" class="control-label">性别</label>

							<p>
								<label class="radio-inline">
									<input name="radio-2" checked="checked" type="radio" value="男">
									男
								</label>
								<label class="radio-inline">
									<input name="radio-2" type="radio" value="女">
									女
								</label>
							</p>
						</div>

					</div>
				</div>
				<div class="row">
					<div class="col-md-6">

						<div class="form-group">
							<label for="field-3" class="control-label">部门</label>

							<input class="form-control" id="field-3" placeholder="" type="text">
						</div>

					</div>

					<div class="col-md-6">

						<div class="form-group">
							<label for="field-4" class="control-label">职位</label>

							<input class="form-control" id="field-4" placeholder="" type="text">
						</div>

					</div>
				</div>
				
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">
				　取消　
				</button>
				<button type="button" class="btn btn-info" id="save">
				　保存　
				</button>
			</div>
		</div>
	</div>
</div>

