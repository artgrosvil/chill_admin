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
					<a class="btn btn-primary" role="button" data-toggle="modal" data-target="#addIcons">Add icons</a>
				</div>
			</div>
			<h1>Icons <small>Store icons</small></h1>
		</div>

		<table id="dataTables" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Description</th>
				<th>Pack</th>
				<th>Bytes</th>
				<th>Size 42</th>
				<th>Size 66</th>
				<th>Size 80</th>
				<th>Size 214</th>
				<th>Size 272</th>
				<th>Action</th>
			</tr>
			</thead>

			<tbody>
			<?php foreach($icons->result() as $data): ?>
				<tr id="<?=$data->id;?>">
					<td><?=$data->id;?></td>
					<td><?=$data->name;?></td>
					<td><?=$data->description;?></td>
					<td><?=$data->pack;?></td>
					<td><?=$data->bytes;?></td>
					<td><a href="<?=$data->size42;?>">Link</a></td>
					<td><a href="<?=$data->size66;?>">Link</a></td>
					<td><a href="<?=$data->size80;?>">Link</a></td>
					<td><a href="<?=$data->size214;?>">Link</a></td>
					<td><a href="<?=$data->size272;?>">Link</a></td>
					<td>
						<a href="#" onclick="deleteIcon(<?=$data->id;?>)"><span class="glyphicon glyphicon-remove"></span></a>
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
	function deleteIcon(id) {
		$.ajax({
			type: 'POST',
			url: '/icons/delete',
			data: "id=" + id,
			success: function(data){
				$("tr[id='"+id+"']").animate({ opacity: "hide" }, "slow");
			}
		});

	}
</script>

<!-- notify all modal -->
<div class="modal fade" id="addIcons" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Add an icon to the store</h4><span id="result_data"></span>
			</div>
			<?=form_open('/icons/add', array('role' => 'form', 'enctype' => 'multipart/form-data'));?>
				<div class="modal-body">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Enter name icon">
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<input type="text" class="form-control" id="description" name="description" placeholder="Enter description icon">
					</div>
					<div class="form-group">
						<label for="subject">Pack</label>
						<input type="text" class="form-control" id="pack" name="pack" placeholder="Enter pack name">
					</div>
					<div class="form-group">
						<label for="bytes">Bytes</label>
						<input type="text" class="form-control" id="bytes" name="bytes" placeholder="Enter bytes">
					</div>
					<div class="form-group">
						<label for="userfile">Icon</label>
						<input type="file" class="form-control" id="userfile" name="userfile">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Send</button>
				</div>
			<?=form_close();?>
		</div>
	</div>
</div>
</body>
</html>