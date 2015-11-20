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
										<div class="col-lg-12">
												<div class="ibox float-e-margins">
														<div class="ibox-content">
																<div>
																		<h1 class="m-b-xs">Add a group</h1>
																		<small></small>
																</div>
																<div class="ibox-content">
																		<form method="post" class="form-horizontal" id="create_admin_form" action="/sudo/create_group">
																				<div class="form-group">
																						<label class="col-sm-2 control-label" for="email">Group Name</label>
																						<div class="col-sm-10">
																								<input type="text" id="email" name="group" class="form-control">
																								<!-- <span class="help-block m-b-none">Administrator is the HOD</span> -->
																						</div>
																				</div>

																				<!-- <div class="hr-line-dashed"></div> -->

																				<div class="form-group">
																						<div class="col-sm-4 col-sm-offset-2">
																								<button class="btn btn-white" type="reset">Cancel</button>
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
																		<h1 class="m-b-xs">Add a test</h1>
																		<small></small>
																</div>
																<div class="ibox-content">
																		<form method="post" id="create_department" action="/sudo/create_test" class="form-horizontal">
																				<div class="form-group">
																						<label class="col-sm-2 control-label">Select</label>

																						<div class="col-sm-10">
																								<select id="admin_list" data-placeholder="Select a group" class="form-control m-b" name="group">
																										<option></option>
																										{list_of_groups}
																											<option value="{id}">{group_name}</option>
																										{/list_of_groups}
																								</select>
																						</div>
																				</div>
																				<div class="form-group">
																						<label class="col-sm-2 control-label">Test name</label>
																						<div class="col-sm-10">
																								<input type="text" name="test_name" placeholder="Name of test" class="form-control">
																						</div>
																				</div>
																				<div class="form-group">
																						<label class="col-sm-2 control-label">Value Units</label>
																						<div class="col-sm-10">
																								<input type="text" name="unit_measurement" placeholder="Unit of Measurement" class="form-control">
																						</div>
																				</div>
																				<div class="form-group">
																						<label class="col-sm-2 control-label">Differance Value</label>
																						<div class="col-sm-10">
																								<input type="text" name="default_value" placeholder="Normal Value of test" class="form-control">
																						</div>
																				</div>
																				<div class="form-group">
																						<label class="col-sm-2 control-label">Default Value</label>
																						<div class="col-sm-10">
																								<input type="text" name="prefill_value" placeholder="Default Value of test" class="form-control">
																						</div>
																				</div>
																				<div class="form-group">
																						<label class="col-sm-2 control-label">Input Field</label>
																						<div class="col-sm-10">
																								<input type="text" name="input_field" placeholder="Input field" class="form-control">
																						</div>
																				</div>
																				<div class="form-group">
																						<label class="col-sm-2 control-label">Price</label>
																						<div class="col-sm-10">
																								<input type="text" name="price" placeholder="Price" class="form-control">
																						</div>
																				</div>

																				<div class="form-group">
																						<div class="col-sm-4 col-sm-offset-2">
																								<button class="btn btn-white" type="submit">Cancel</button>
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
							<div class="ibox-title">
								<h5>Group list</h5>
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
										<th>Delete / Edit</th>
									</thead>
									<tbody>
									{list_of_groups}
									<tr>
										<td>{group_name}</td>
										<td><a href="#"><i class="fa fa-trash-o"></i></a> - <a href="#"><i class="fa fa-edit"></i></a></td>
									</tr>
									{/list_of_groups}
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
