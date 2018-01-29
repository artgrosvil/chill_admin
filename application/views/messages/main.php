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
				<h1>Users messages <small>Brief information about messages</small></h1>
			</div>

			<table id="dataTables" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>#</th>
						<th>ID sender</th>
						<th>ID recipient</th>
						<th>Content & type</th>
						<th>Read</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach($messages->result() as $data): ?>
						<tr id="<?=$data->id;?>">
							<td><?=$data->id;?></td>
							<td><?=$data->id_sender;?></td>
							<td><?=$data->id_recipient;?></td>
							<?php if ($data->type == 'location'): ?>
								<td><a class="btn btn-xs btn-success" href="#" data-toggle="modal" data-target="#messageLoc" onclick="seeContent(<?=$data->id;?>)">location</a></td>
							<?php endif; ?>
							<?php if ($data->type == 'photo' or $data->type == 'parse'): ?>
								<td><a class="btn btn-xs btn-success" href="#" data-toggle="modal" data-target="#messageImg" onclick="seeContent(<?=$data->id;?>)">photo</a></td>
							<?php endif; ?>
							<?php if ($data->type == 'icon'): ?>
								<td><a class="btn btn-xs btn-success" href="#" data-toggle="modal" data-target="#messageImg" onclick="seeContent(<?=$data->id;?>)">icon</a></td>
							<?php endif; ?>
							<?php if ($data->read == 1): ?>
								<td><span class="label label-success">read</span></td>
							<?php else: ?>
								<td><span class="label label-danger">not read</span></td>
							<?php endif; ?>
							<td>
								<a href="#" onclick="deleteMessage(<?=$data->id;?>)"><span class="glyphicon glyphicon-remove"></span></a>
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
		function deleteMessage(id) {
			$.ajax({
				type: 'POST',
				url: '/messages/delete',
				data: "id=" + id,
				success: function(data){
					$("tr[id='"+id+"']").animate({ opacity: "hide" }, "slow");
				}
			});

		}
	</script>

	<script>
	    function seeContent(id) {
	        $.ajax({
	            type: 'POST',
	            url: '/messages/get_message',
	            data: "id=" + id,
	            dataType: 'json',
	            success: function(data) { 
	            	if (data.type == 'photo') {
	            		data.content = 'http://api.iamchill.co/'+data.content;
	            		$('#message-img').children('img').attr({src: data.content});
	            	};
	            	if (data.type == 'parse') {
	            		$('#message-img').children('img').attr({src: data.content});
	            	};
	            	if (data.type == 'location') {
						var strings = data.content.split(' ');
						var lat1 = strings[0], lat2 = strings[1];
						var mapOptions = {
							center: new google.maps.LatLng(lat1, lat2),
							zoom: 15,
							mapTypeId: google.maps.MapTypeId.ROADMAP
						};
						var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
	            	};
				}
	        });
	    }
	</script>

	<!-- Add user modal -->
	<div class="modal fade" id="messageImg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	                <h4 class="modal-title" id="myModalLabel">Content user</h4>
	            </div>
	            <div id="message-img" class="modal-body">
					<img style="width:100%;">
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Add user modal -->
	<div class="modal fade" id="messageLoc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	                <h4 class="modal-title" id="myModalLabel">Content user</h4>
	            </div>
	            <div id="message-loc" class="modal-body">
					<div id="map_canvas" style="width:100%; height:450px;"></div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	            </div>
	        </div>
	    </div>
	</div>

</body>
</html>