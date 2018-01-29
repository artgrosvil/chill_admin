		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Bootstrap js -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<!-- Custom js -->
		<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
		 <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

		<script>
			$(document).ready(function() {
				$('#dataTables').dataTable();
			});
		</script>
		<script>
			$(document).ready(function() {
				$('#dataTablesWhiteList').dataTable();
			});
		</script>

		<script>
			$(document).ready(function() {
				$('.nav li.active').removeClass('active');
				$('.nav li a').each(function() {
					if ($(this).attr('href') == window.location.href) {
						$(this).parent('li').addClass('active');
					};
				});
			});
		</script>