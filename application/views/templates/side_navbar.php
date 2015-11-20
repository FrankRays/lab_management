<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav" id="side-menu">
			<li class="nav-header">
				<div class="dropdown profile-element">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<span class="clear">
							<span class="block m-t-xs"> <strong class="font-bold">{name}</strong></span>
							<span class="text-muted text-xs block">Admin <b class="caret"></b></span>
						</span>
					</a>
					<ul class="dropdown-menu animated fadeInRight m-t-xs">
						<li><a href="/accounts/">Edit Profile</a></li>
						<li><a href="/login/logout">Logout</a></li>
					</ul>
				</div>
				<div class="logo-element">
						LMS
				</div>
			</li>
			<li {index}>
					<a href="/{role_url}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
			</li>
			<li {infographics}>
					<a href="/{role_url}/infographics"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Infographics</span></a>
			</li>

			<li {settings}>
					<a href="/{role_url}/settings"><i class="fa fa-cogs"></i> <span class="nav-label">Settings</span></a>
			</li>
		</ul>
	</div>
</nav>