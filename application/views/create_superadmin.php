<body>
	<div id="wrapper">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary" style="margin-top:100px; text-align:center;">
				<div class="panel-heading">
					 Create Super Admin
				</div>
				<div class="panel-body">
					<form action="install/save" id="create_super_admin_form" method="post">
						<input type="email" name="email" class="form-control" placeholder="Email">
						<input type="text" name="name" class="form-control" placeholder="Name">
						<input type="password" name="password" class="form-control" placeholder="Password">
						<input type="password" name="repass" class="form-control" placeholder="Confirm Password">
						<button type="submit" class="btn btn-primary pull-right">Next</button>
					</form>
				</div>
				<div class="panel-footer">
				<p></p>
				</div>
			</div>
		</div>
	</div>
</body>