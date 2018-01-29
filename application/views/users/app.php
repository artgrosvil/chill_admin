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
				<h1>Users Application <small>Brief information about users</small></h1>
			</div>

			<table id="dataTables" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Login</th>
						<th>Name</th>
						<th>Email</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach($users->result() as $data): ?>
						<tr id="<?=$data->id;?>">
							<td><?=$data->id;?></td>
							<td><?=$data->login;?></td>
							<td><?=$data->name;?></td>
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
				url: '/users_app/add',
				type: "POST",
				dataType: "html",
				data: jQuery("#"+"addUserForm").serialize(), 
				success: function(response) {
					document.getElementById('result_data').innerHTML = "<span class='label label-success'>User added</span>";
					window.setTimeout(function() {
						$('#addUser').modal('hide');
					}, 1000);
				},
				error: function(response) {
					document.getElementById('result_data').innerHTML = "<span class='label label-danger'>User not added</span>";
				}
			});
		}
	</script>

	<script>
		function editUser() {
			$.ajax({
				url: '/users_app/edit',
				type: "POST",
				dataType: "html",
				data: jQuery("#"+"editUserForm").serialize(), 
				success: function(response) {
					document.getElementById('result_data').innerHTML = "<span class='label label-success'>User update</span>";
					window.setTimeout(function() {
						$('#editUser').modal('hide');
					}, 1000);
				},
				error: function(response) {
					document.getElementById('result_data').innerHTML = "<span class='label label-danger'>User not update</span>";
				}
			});
		}
	</script>

	<script>
		function getDataUser(id) {
			$.ajax({
				type: 'POST',
				url: '/users_app/get_user',
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

	<script>
		function deleteUser(id) {
			$.ajax({
				type: 'POST',
				url: '/users_app/delete',
				data: "id=" + id,
				success: function(response) {
					$("tr[id='"+id+"']").animate({ opacity: "hide" }, "slow");
				},
				error: function(response) {
					document.getElementById('result_data').innerHTML = "<span class='label label-danger'>User not added</span>";
				}
				success: function(data){
					$("tr[id='"+id+"']").animate({ opacity: "hide" }, "slow");
				}
			});

		}
	</script>

	<script>
		function approvedUser(id) {
			$.ajax({
				type: 'POST',
				url: '/users_app/approved',
				data: "id=" + id,
				success: function(data){
					location.reload();
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
							<label for="login">Login</label>
							<input type="text" class="form-control" id="login" name="login" placeholder="Enter login">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Name</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password">
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
					<h4 class="modal-title" id="myModalLabel">Edit user</h4><span id="result_data"></span>
				</div>
				<form method="post" name="editUserForm" id="editUserForm" role="from">
					<div class="modal-body">
						<div class="form-group">
							<label for="login">Login</label>
							<input type="text" class="form-control" id="login" name="login" placeholder="Enter login">
							<input type="hidden" id="id" name="id">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Name</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" onclick="editUser()">Save changes</button>
					</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
	</body>
	</html>