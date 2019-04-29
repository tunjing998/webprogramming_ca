	<table class="table table-condensed"> //用精简表格
	<caption>account table</caption>
	<thead>
		<tr>
			<th>accountid</th>
			<th>username</th>
			<th>email</th>
			<th>passcode</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>
	

<!-- 按钮触发模态框 -->
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
	add account
</button>
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">
					add account
				</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form">

	<div class="form-group">
		<label for="inputPassword" class="col-sm-2 control-label">accountid</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="inputPassword" 
				   placeholder="pleas enter accountid ">
		</div>
	</div>
	
	<div class="form-group">
		<label for="inputPassword" class="col-sm-2 control-label">username</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="inputPassword" 
				   placeholder="pleas enter username">
		</div>
	</div>
	
	
	<div class="form-group">
		<label for="inputPassword" class="col-sm-2 control-label">email</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="inputPassword" 
				   placeholder="please enter email">
		</div>
	</div>
	<div class="form-group">
		<label for="inputPassword" class="col-sm-2 control-label">passcode</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="inputPassword" 
				   placeholder="please enter passcode">
		</div>
	</div>
</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">close
				</button>
				<button type="button" class="btn btn-primary">
					submit
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>
	<script>
   $(function () { $('#myModal').modal('hide')});
</script>


