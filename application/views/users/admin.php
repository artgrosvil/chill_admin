<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Chill App Admin Panel</title>

	<!-- start css -->
	<?php $this->load->view('include/css');?>
	<!-- end css -->
</head>
<body>
	<!-- start css -->
	<?php $this->load->view('include/header');?>
	<!-- end css -->

	<div class="container">
		<div class="row">
			<div class="page-header">
				<div class="btn-toolbar" role="toolbar" style="float:right;">
					<div class="btn-group">
						<a class="btn btn-primary" role="button" data-toggle="modal" data-target="#addUser">Add user</a>
					</div>
				</div>
				<h1>Users Admin Panel <small>Brief information about users</small></h1>
			</div>

			<table id="dataTables" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Email</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody id="users_admin">
					<?php foreach($data_users->result() as $data): ?>
						<tr id="<?=$data->id;?>">
							<td><?=$data->id;?></td>
							<td><?=$data->email;?></td>
							<td>
								<a href="#" data-toggle="modal" data-target="#editUser" onclick="getDataUser(<?=$data->id;?>)"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="#" onclick="deleteUser(<?=$data->id;?>)"><span class="glyphicon glyphicon-remove"></span></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

		</div>
	</div>

	<!-- start footer -->
	<?php $this->load->view('include/footer');?>
	<!-- end footer -->

	<!-- start js -->
	<?php $this->load->view('include/js');?>
	<!-- end js -->

	<script>
		function addUser() {
			$.ajax({
				url: '/users_admin/add',
				type: "POST",
				dataType: "json",
				data: jQuery("#"+"addUserForm").serialize(), 
			}).done(function(response) {
				if (response.success == true) {
					$('#result_data').append('<span class="label label-success">User added</span>');

					var dataTables = $('#dataTables').DataTable();

					var html_action = '<td><a href="#" data-toggle="modal" data-target="#editUser" onclick="getDataUser('+response.data.id+')"><span class="glyphicon glyphicon-pencil"></span></a><a href="#" onclick="deleteUser('+response.data.id+')"><span class="glyphicon glyphicon-remove"></span></a></td>';

					dataTables.row.add( [
						response.data.id,
						response.data.email,
						html_action
					] ).draw();

					window.setTimeout(function() {
						$('#addUser').modal('hide');
						$('#result_data').empty();
					}, 1000);
				} else if (response.success == false) {
					if (response.error == 101) {
						$('#result_data').append('<span class="label label-success">Data is not valid</span>');
					} else if (response.error == 102) {
						$('#result_data').append('<span class="label label-success">Data is not valid</span>');
					} else if (response.error == 103) {
						$('#result_data').append('<span class="label label-success">Data is not valid</span>');
					};
					window.setTimeout(function() {
						$('#addUser').modal('hide');
						$('#result_data').empty();
					}, 1000);
				};
			});
		}
	</script>

	<script>
		function editUser() {
			$.ajax({
				url: '/users_admin/edit',
				type: "POST",
				dataType: "html",
				data: jQuery("#"+"editUserForm").serialize(), 
				success: function(response) {
					$('#result_data').append('<span class="label label-success">User update</span>');
					window.setTimeout(function() {
						$('#editUser').modal('hide');
						$('#result_data').empty();
					}, 1000);
				},
				error: function(response) {
					$('#result_data').append('<span class="label label-success">>User not update</span>');
					window.setTimeout(function() {
						$('#editUser').modal('hide');
						$('#result_data').empty();
					}, 1000);
				}
			});
		}
	</script>

	<script>
		function deleteUser(id) {
			$.ajax({
				type: 'POST',
				url: '/users_admin/delete',
				data: "id=" + id,
			}).done(function(response) {
				if (response.success == true) {
					$("tr[id='"+id+"']").animate({ opacity: "hide" }, "slow");
				} else if (response.success == false) {

				};
			});
		}
	</script>

	<script>
		function getDataUser(id) {
			$.ajax({
				type: 'POST',
				url: '/users_admin/get_user',
				data: "id=" + id,
				dataType: 'json',
				success: function(data){
					form = document.editUserForm;
					$.each(data, function (key, value) {
						if (form[key]) {
							form[key].value = value;
						}
					});
				}
			});
		}
	</script>

	<!-- Add user modal -->
	<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">Add user</h4><span id="result_data"></span>
				</div>
				<form method="post" name="addUserForm" id="addUserForm" role="from">
					<div class="modal-body">
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" onclick="addUser()">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>


	<!-- Edit user modal -->
	<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">Edit user</h4>
				</div>
				<form method="post" name="editUserForm" id="editUserForm" role="from">
				<div class="modal-body">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="editUser()">Save changes</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>