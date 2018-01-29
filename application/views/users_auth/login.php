<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Chill Admin</title>

	<!-- start css -->
		<?php $this->load->view('include/css');?>
	<!-- end css -->
	</head>
	<body>

		<div class="container">
			<div class="row">
			<div class="col-lg-offset-4 col-lg-4 col-lg-offset-4">
				<div class="page-header">
					<h3>Administration panel</h3>
				</div>
				<div id="auth_email">
					<form method="post" action="javascript:void(null);" onsubmit="sendEmail()" id="emailForm">
						<div class="form-group">
							<input type="text" class="form-control" id="email" name="email" placeholder="Email administration" required autofocus>
						</div>
						<button class="btn btn-lg btn-primary btn-block" type="submit">Send email</button>
					</form>
				</div>
				<div id="auth_code" style="display:none;">
					<form method="post" action="javascript:void(null);" onsubmit="sendCode()" id="codeForm">
						<div class="form-group">
							<input type="text" class="form-control" id="code" name="code" placeholder="Code" required autofocus>
							<input type="hidden" class="form-control" id="email_code" name="email">
						</div>
						<button class="btn btn-lg btn-primary btn-block" type="submit">Confirm code</button>
					</form>
				</div>
				<div id="result_data" class="result-data-login"></div>
			</div>
		</div>
		</div>

		<!-- start footer -->
			<?php $this->load->view('include/footer');?>
		<!-- end footer -->

		<!-- start js -->
			<?php $this->load->view('include/js');?>
		<!-- end js -->
	</body>
<script>
	function sendEmail() {
		$.ajax({
			url: '/users_auth/send_email',
			type: "POST",
			dataType: "json",
			data: jQuery("#"+"emailForm").serialize()
		}).done(function(response) {
			if (response.success == true) {
				$('#auth_email').remove();
				$('#auth_code').show();
				$('#result_data').append('<span class="label label-success">Code send to email</span>');
				$('#email_code').val(response.data.email);
			} else if (response.success == false) {
				if (response.error == 101) {
					$('#result_data').append('<span class="label label-danger">Data is not valid</span>');
				} else if(response.error == 102) {
					$('#result_data').append('<span class="label label-danger">Email is not exist</span>');
				} else if (response.error == 103) {
					$('#result_data').append('<span class="label label-danger">Email not send</span>');
				};
			};
		});
	}
</script>
<script>
	function sendCode() {
		$.ajax({
			url: '/users_auth/send_code',
			type: "POST",
			dataType: "json",
			data: jQuery("#"+"codeForm").serialize()
		}).done(function(response) {
			$('div#result_data').empty();
			if (response.success == true) {
				$('#result_data').append('<span class="label label-success">Authorization successful. Redirect ...</span>');
				window.setTimeout(function() {
					window.location.replace(window.location.protocol + "//" + window.location.host);
				}, 1000);
			} else if (response.success == false) {
				if (response.error == 111) {
					$('#result_data').append('<span class="label label-danger">Code is not valid</span>');
				} else if(response.error == 112) {
					$('#result_data').append('<span class="label label-danger">Code is not exist</span>');
				} else if (response.error == 113) {
					$('#result_data').append('<span class="label label-danger">Session not send</span>');
				};
			};
		});
	}
</script>
</html>