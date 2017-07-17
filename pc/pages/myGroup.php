<nav class="navbar navbar-default " role="navigation">
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li class="active">
				<a href="?page=myGroup" class="">
					我的分组
				</a>
			</li>
			<li class="">
				<a href="?page=allPersons">
					全部人员
				</a>
			</li>
		</ul>
	</div>
</nav>
<div class="row">
	<div class="col-sm-3">
		<div class="xe-widget xe-counter xe-counter-blue " data-count=".num" data-from="0" data-to="213" data-duration="4">
			<div class="xe-icon">
				<i class="linecons-cloud"></i>
			</div>
			<div class="xe-label">
				<strong class="num">213</strong>
				<span>群组人员</span>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="xe-widget xe-counter xe-counter-turquoise" data-count=".num" data-from="1" data-to="66"  data-duration="3" data-easing="false">
			<div class="xe-icon">
				<i class="linecons-user"></i>
			</div>
			<div class="xe-label">
				<strong class="num">66</strong>
				<span>群组人员</span>
			</div>
		</div>
	</div>
	
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">全部成员</h3>
	</div>
	<div class="panel-body">
		<div id="example-1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
			<div class="row">
				<div class="col-xs-6">
					<div class="dataTables_length" id="example-1_length">
						<label>每页显示
							<select name="example-1_length" aria-controls="example-1" class="form-control input-sm">
								<option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="-1">All</option>
							</select>
						</label>
					</div>
				</div>
				<div class="col-xs-6">
					<div id="example-1_filter" class="dataTables_filter pull-right">
						<label>搜索:
							<input class="form-control input-sm" placeholder="" aria-controls="example-1" type="search">
						</label>
					</div>
				</div>
			</div>
			<table id="example-1" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="example-1_info" style="width: 100%;" width="100%" cellspacing="0">
				<thead>
					<tr role="row">
						<th class="sorting_asc" tabindex="0" aria-controls="example-1" rowspan="1" colspan="1" style="width: 10%;" aria-sort="ascending" aria-label="Name: activate to sort column ascending">姓名</th>
						<th class="sorting" tabindex="0" aria-controls="example-1" rowspan="1" colspan="1" style="width: 25%;" aria-label="Position: activate to sort column ascending">所属部门</th>
						<th class="sorting" tabindex="0" aria-controls="example-1" rowspan="1" colspan="1" style="width: 25%;" aria-label="Position: activate to sort column ascending">职位</th>
						<th class="" tabindex="0" aria-controls="example-1" rowspan="1" colspan="1" style="width: 40%;" aria-label="Office: activate to sort column ascending">添加到分组</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th rowspan="1" colspan="1">姓名</th>
						<th rowspan="1" colspan="1">所属部门</th>
						<th rowspan="1" colspan="1">职位</th>
						<th rowspan="1" colspan="1">添加到分组</th>
					</tr>
				</tfoot>

				<tbody>
					<tr role="row" class="odd">
						<td class="sorting_1"></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr role="row" class="even">
						<td class="sorting_1"> </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr role="row" class="odd">
						<td class="sorting_1"></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr role="row" class="even">
						<td class="sorting_1"> </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr role="row" class="odd">
						<td class="sorting_1"></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr role="row" class="even">
						<td class="sorting_1"> </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr role="row" class="odd">
						<td class="sorting_1"></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr role="row" class="even">
						<td class="sorting_1"> </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
			<div class="row">
				<div class="col-xs-12">
					<div class="dataTables_paginate paging_simple_numbers pull-right" id="example-1_paginate">
						<ul class="pagination">
							<li class="paginate_button previous disabled" aria-controls="example-1" tabindex="0" id="example-1_previous">
								<a href="#">
									上一页
								</a>
							</li>
							<li class="paginate_button active" aria-controls="example-1" tabindex="0">
								<a href="#">
									1
								</a>
							</li>
							<li class="paginate_button " aria-controls="example-1" tabindex="0">
								<a href="#">
									2
								</a>
							</li>
							<li class="paginate_button " aria-controls="example-1" tabindex="0">
								<a href="#">
									3
								</a>
							</li>
							<li class="paginate_button " aria-controls="example-1" tabindex="0">
								<a href="#">
									4
								</a>
							</li>
							<li class="paginate_button " aria-controls="example-1" tabindex="0">
								<a href="#">
									5
								</a>
							</li>
							<li class="paginate_button " aria-controls="example-1" tabindex="0">
								<a href="#">
									6
								</a>
							</li>
							<li class="paginate_button next" aria-controls="example-1" tabindex="0" id="example-1_next">
								<a href="#">
									下一页
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="assets/js/datatables/js/jquery.dataTables.min.js"></script>
