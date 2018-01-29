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
					<a class="btn btn-primary" role="button" data-toggle="modal" data-target="#sendAllUsers">Send a letter to all users</a>
				</div>
			</div>
			<h1>Icons <small>add, edit, remove</small></h1>
		</div>

		<table id="dataTables" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Pack</th>
				<th>Bytes</th>
				<th>Action</th>
			</tr>
			</thead>

			<tbody>
			<?php foreach($icons->result() as $data): ?>
				<tr id="<?=$data->id;?>">
					<td><?=$data->id;?></td>
					<td><?=$data->name;?></td>
					<td><?=$data->pack;?></td>
					<td><?=$data->bytes;?></td>
					<td>
						<a href="#" onclick="getDataEmail(<?=$data->id;?>)" data-toggle="modal" data-target="#sendOneUser"><span class="glyphicon glyphicon-envelope"></span></a>
						<a href="#" onclick="deleteEmail(<?=$data->id;?>)"><span class="glyphicon glyphicon-remove"></span></a>
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
	function sendEmail() {
		$.ajax({
			url: '/promo_email/send_one_user',
			type: "POST",
			dataType: "json",
			data: jQuery("#"+"sendOneEmailUser").serialize(),
			success: function(response) {
				document.getElementById('result_data').innerHTML = "<span class='label label-success'>Send email</span>";
				window.setTimeout(function() {
					$('#sendOneUser').modal('hide');
				}, 1000);
			},
			error: function(response) {
				document.getElementById('result_data').innerHTML = "<span class='label label-danger'>Not send emil</span>";
			}
		});
	}
</script>

<script>
	function sendAllEmail() {
		$.ajax({
			url: '/promo_email/send_all_users',
			type: "POST",
			dataType: "json",
			data: jQuery("#"+"sendAllEmailUser").serialize()
		}).done(function(response) {
			if (response.success == true) {
				$('#result_data').append('<span class="label label-success">Email send</span>');
				window.setTimeout(function() {
					$('#sendAllUsers').modal('hide');
					$('#result_data').empty();
					console.log(response.data);
				}, 1000);
			} else if(response.success == false) {
				if (response.error == 101) {
					$('#result_data').append('<span class="label label-success">Email not send</span>');
				};
			};
		});
	}
</script>

<script>
	function getDataEmail(id) {
		$.ajax({
			type: 'POST',
			url: '/promo_email/get_data_promo_email',
			data: "id=" + id,
			dataType: 'json',
			success: function(data){
				form = document.sendOneEmailUser;
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
	function deleteEmail(id) {
		$.ajax({
			type: 'POST',
			url: '/promo_email/delete',
			data: "id=" + id,
			success: function(data){
				$("tr[id='"+id+"']").animate({ opacity: "hide" }, "slow");
			}
		});

	}
</script>

<!-- notify modal -->
<div class="modal fade" id="sendOneUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Send a letter to one user</h4><span id="result_data"></span>
			</div>
			<form method="post" name="sendOneEmailUser" id="sendOneEmailUser" role="from">
				<div class="modal-body">
					<div class="form-group">
						<label for="subject">Subject</label>
						<input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject">
						<input type="hidden" class="form-control" id="id" name="id_email">
					</div>
					<div class="form-group">
						<label for="message">Email</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
					</div>
					<div class="form-group">
						<label for="message">Message</label>
						<textarea class="form-control" rows="7" id="message" name="message" placeholder="Enter message"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="sendEmail()">Send email</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- notify all modal -->
<div class="modal fade" id="sendAllUsers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Send a letter to all users</h4><span id="result_data"></span>
			</div>
			<form method="post" name="sendAllEmailUser" id="sendAllEmailUser" role="from">
				<div class="modal-body">
					<div class="form-group">
						<label for="subject ">Subject</label>
						<input type="subject" class="form-control" id="subject" name="subject" placeholder="Enter subject">
					</div>
					<div class="form-group">
						<label for="message">Message</label>
						<textarea class="form-control" rows="7" id="message" name="message" placeholder="Enter message"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<span id="result_data"></span>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="sendAllEmail()">Send email</button>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>