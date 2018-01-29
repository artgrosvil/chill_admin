<div class="navbar navbar-default navbar-static-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Chill App Admin Panel</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><?=anchor('', 'Dashboard');?></li>
						<li><?=anchor('messages', 'Messages');?></li>
						<li><?=anchor('icons/index', 'Icons');?></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><?=anchor('users_admin', 'Admin panel');?></li>
								<li><?=anchor('users_app', 'Application');?></li>
							</ul>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello, <?=$this->session->userdata('login');?> <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><?=anchor('logout', 'Logout');?></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
