<body class="fixed-navigation">
		<div id="wrapper">
				{side_navbar}

				<div id="page-wrapper" class="gray-bg sidebar-content">
						<div class="row border-bottom">
								{top_navbar}
						</div>
						{sidebar_panel}

						<div class="wrapper wrapper-content">

								<div class="row">
										<div class="col-lg-6">
												<div class="ibox float-e-margins">
														<div class="ibox-title">
																<div class="ibox-tools">
																		<a class="collapse-link">
																				<i class="fa fa-chevron-up"></i>
																		</a>
																		<ul class="dropdown-menu dropdown-user">
																				<li><a href="#">Config option 1</a>
																				</li>
																				<li><a href="#">Config option 2</a>
																				</li>
																		</ul>
																		<a class="close-link">
																				<i class="fa fa-times"></i>
																		</a>
																</div>
														</div>
														<div class="ibox-content ibox-heading">
																<h3>Classes
							<div class="stat-percent text-navy">{count_classes}<i class="fa fa-level-up"></i></div>
						</h3>
														</div>
														<div class="ibox-content">
																<div>
																		<h4>List
									<br/>

								{class_less}
									<small class="m-r"><a href="graph_flot.html"> {name}</a> </small>
								{/class_less}
							<span class="badge badge-info pull-right">+{count_badge}</span>
								</h4>
																</div>
														</div>
												</div>
										</div>

										<div class="col-lg-6">
												<div class="ibox float-e-margins">
														<div class="ibox-title">
																<div class="ibox-tools">
																		<a class="collapse-link">
																				<i class="fa fa-chevron-up"></i>
																		</a>
																		<ul class="dropdown-menu dropdown-user">
																				<li><a href="#">Config option 1</a>
																				</li>
																				<li><a href="#">Config option 2</a>
																				</li>
																		</ul>
																		<a class="close-link">
																				<i class="fa fa-times"></i>
																		</a>
																</div>
														</div>
														<div class="ibox-content ibox-heading">
																<h3>Class Admins
							<div class="stat-percent text-navy">{count_faculties}<i class="fa fa-level-up"></i></div>
						</h3>
														</div>
														<div class="ibox-content">
																<div>
																		<h4>List
									<br/>
							{faculties_less}
								<small class="m-r"><a href="graph_flot.html"> {name} </a> </small>
							{/faculties_less}
							<span class="badge badge-info pull-right">+{count_faculties_badge}</span>   
								</h4>
																</div>
														</div>
												</div>
										</div>
								</div>


								<div class="row">
										<div class="col-lg-12">
												<div class="ibox float-e-margins">
														<div class="ibox-content">
																<div>
																		<h1 class="m-b-xs">Add a class admin</h1>
																		<small></small>
																</div>
																<!--   <div>
									<canvas id="lineChart" height="70"></canvas>
								</div> -->
																<!-- form here -->
																<div class="ibox-content">
																		<form method="post" class="form-horizontal" id="create_admin_form" action="/admin/create_admin">
																				<div class="form-group">
																						<label class="col-sm-2 control-label">Admin Email</label>
																						<div class="col-sm-10">
																								<input type="email" name="email" class="form-control">
																								<!-- <span class="help-block m-b-none">Administrator is the HOD</span> -->
																						</div>
																				</div>

																				<!-- <div class="hr-line-dashed"></div> -->

																				<div class="form-group">
																						<div class="col-sm-4 col-sm-offset-2">
																								<button class="btn btn-white" type="reset" onclick="$('select').val(0).trigger('chosen:updated')">Reset</button>
																								<button class="btn btn-primary" type="submit">Save changes</button>
																						</div>
																				</div>
																		</form>
																</div>


																<div class="m-t-md">
																		<small class="pull-right">
										<i class="fa fa-clock-o"> </i>
										Last added on {{timestamp}}
									</small>
																</div>

														</div>
												</div>
										</div>
								</div>


								<div class="row">
										<div class="col-lg-12">
												<div class="ibox float-e-margins">
														<div class="ibox-content">
																<div>
																		<h1 class="m-b-xs">Add a class</h1>
																		<small></small>
																</div>
																<div class="ibox-content">
																		<form method="post" id="create_class" action="/admin/create_class" class="form-horizontal">
																				<div class="form-group">
																						<label class="col-sm-2 control-label">Class name</label>
																						<div class="col-sm-10">
																								<input type="text" name="class_name" class="form-control">
																						</div>
																				</div>

																				<div class="form-group">
																						<label class="col-sm-2 control-label">Select</label>

																						<div class="col-sm-10">
																								<select id="admin_list" name="admin_email" data-placeholder="Select a admin" required="required" class="form-control m-b" name="account">
																										<option></option>
																										
																									{faculties}
																										<option value="{email}">{email}</option>
																									{/faculties}
																										
																								</select>
																									
																						</div>
																				</div>
																				<div class="form-group">
																						<div class="col-sm-4 col-sm-offset-2">
																								<button class="btn btn-white" type="reset" onclick="$('select').val(0).trigger('chosen:updated')">Reset</button>
																								<button class="btn btn-primary" type="submit">Save changes</button>
																						</div>
																				</div>
																		</form>
																</div>


																<div class="m-t-md">
																		<small class="pull-right">
								<i class="fa fa-clock-o"> </i>
								Last added on {{timestamp}}
							</small>
																</div>
														</div>
												</div>
										</div>
								</div>

				<div class="row">
					<div class="col-lg-6">
								<div class="ibox float-e-margins">
									<div class="ibox-title">
										<h5>Class admin list</h5>
										<div class="ibox-tools">
											<a class="collapse-link">
												<i class="fa fa-chevron-up"></i>
											</a>
											<a class="close-link">
												<i class="fa fa-times"></i>
											</a>
										</div>
									</div>
									<div class="ibox-content">
										<table class="table table-hover no-margins">
											<thead>
												<th>Name</th>
												<th>Created</th>
												<th>Delete</th>
											</thead>
											<tbody>
											{faculties_list_full}
												<tr>
													<td>{user_name}</td>
													<td><i class="fa fa-calendar"> {c_date} </i> </td>
													<td><a href="#"><i class="fa fa-trash-o"></i></a></td>
												</tr>
											{/faculties_list_full}
											</tbody>
										</table>
									</div>
								</div>
						</div>


					<div class="col-lg-6">
								<div class="ibox float-e-margins">
									<div class="ibox-title">
										<h5>Class list</h5>
										<div class="ibox-tools">
											<a class="collapse-link">
												<i class="fa fa-chevron-up"></i>
											</a>
											<a class="close-link">
												<i class="fa fa-times"></i>
											</a>
										</div>
									</div>
									<div class="ibox-content">
										<table class="table table-hover no-margins">
											<thead>
												<th>Name</th>
												<th>Class admin</th>
												<th>Delete</th>
											</thead>                                            
											<tbody>
											{faculties_list_full}
												<tr>
													<td>{room_name}</td>
													<td><i class="fa fa-user"></i> {user_name}</td>
													<td><a href="#"><i class="fa fa-trash-o"></i></a></td>
												</tr>
											{/faculties_list_full}

											</tbody>
										</table>
									</div>
								</div>
						</div>
				</div>
								

						</div>
						<!-- end of wrapper wrapper-content -->
						{page_footer}

																			<!-- Added content -->

				</div>
		</div>

		<!-- Mainly scripts -->
		<!-- Flot -->
		<script src="/static/js/plugins/flot/jquery.flot.js"></script>
		<script src="/static/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
		<script src="/static/js/plugins/flot/jquery.flot.spline.js"></script>
		<script src="/static/js/plugins/flot/jquery.flot.resize.js"></script>
		<script src="/static/js/plugins/flot/jquery.flot.pie.js"></script>
		<script src="/static/js/plugins/flot/jquery.flot.symbol.js"></script>
		<script src="/static/js/plugins/flot/curvedLines.js"></script>

		<!-- Peity -->
		<script src="/static/js/plugins/peity/jquery.peity.min.js"></script>
		<script src="/static/js/demo/peity-demo.js"></script>

		<!-- Custom and plugin javascript -->

		<!-- jQuery UI -->
		<script src="/static/js/plugins/jquery-ui/jquery-ui.min.js"></script>

		<!-- Jvectormap -->
		<script src="/static/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
		<script src="/static/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

		<!-- Sparkline -->
		<script src="/static/js/plugins/sparkline/jquery.sparkline.min.js"></script>

		<!-- Sparkline demo data  -->
		<script src="/static/js/demo/sparkline-demo.js"></script>

		<!-- ChartJS-->
		<script src="/static/js/plugins/chartJs/Chart.min.js"></script>
</body>
