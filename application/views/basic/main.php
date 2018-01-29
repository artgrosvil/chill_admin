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
				<h1>Statistics <small>Statistics API and Frontend</small></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="thumbnail">
					<div class="caption">
						<h3><center><strong>Promo mail</strong></center></h3>
						<h3><center><span class="label label-primary"><?=$stat['count_promo_email'];?></span></h3>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="thumbnail">
					<div class="caption">
						<h3><center><strong>Users App</strong></center></h3>
						<h3><center><span class="label label-primary"><?=$stat['count_users_app'];?></span></h3>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="thumbnail">
					<div class="caption">
						<h3><center><strong>Messages</strong></center></h3>
						<h3><center><span class="label label-primary"><?=$stat['count_messages'];?></span></h3>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="footer">
		<div class="container">
			<p class="text-muted">Chill App 2014. All rights reserved.</p>
		</div>
	</div>

	<!-- start js -->
	<?php $this->load->view('include/js');?>
	<!-- end js -->

</body>
</html>