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
																<h3>Faculties Enrolled
							<div class="stat-percent text-navy">{faculties_list_count}<i class="fa fa-level-up"></i></div>
						</h3>
														</div>
														<div class="ibox-content">
																<div>
																		<h4>List
									<br/>

								{faculties_list_less}
									<small class="m-r"><a href="graph_flot.html"> {user_name}</a> </small>
								{/faculties_list_less}
								
							<span class="badge badge-info pull-right">+{faculties_list_less_count}</span>
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
																<h3>Subjects Enrolled
							<div class="stat-percent text-navy">{subject_list_count}<i class="fa fa-level-up"></i></div>
						</h3>
														</div>
														<div class="ibox-content">
															<div>
																<h4>List
																	<br/>
																	{subject_list_less}
																		<small class="m-r"><a href="graph_flot.html"> {subject_name} </a> </small>
																	{/subject_list_less}
																	<span class="badge badge-info pull-right">+{count_subject_list_badge}</span>
																
																</h4>
															</div>
														</div>
												</div>
										</div>
									</div>
								<!-- for  adding information about subject-->
									<div class="row">
										<div class="col-lg-12">
												<div class="ibox float-e-margins">
														<div class="ibox-content">
																<div>
																		<h2 class="m-b-xs">Add a subject</h2>
																		<small></small>
																</div>
																<div class="ibox-content">
																		<form method="post" id="add_subject" action="/dashboard/add_subject" class="form-horizontal">
																				<div class="form-group">
																						<label class="col-sm-2 control-label">Subject Code</label>
																						<div class="col-sm-10">
																							<input type="text" name="subject_code" required="required" class="form-control">
																						</div>
																				</div>
																				<div class="form-group">
																						<label class="col-sm-2 control-label">Subject Name</label>
																						<div class="col-sm-10">
																							<input type="text" name="subject_name" required="required" class="form-control">
																						</div>
																				</div>
																				<div class="form-group">
																						<div class="col-sm-4 col-sm-offset-2">
																								<button class="btn btn-white" type="reset">Reset</button>
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
																		<h2 class="m-b-xs">Enroll Faculty to {class_name}</h2>
																		<small></small>
																</div>
																<div class="ibox-content">
																		<form method="post" id="create_class" action="/dashboard/assign_faculty" class="form-horizontal">
																				<div class="form-group">
																						<label class="col-sm-2 control-label">Email</label>
																						<div class="col-sm-10">
																							<input type="email" required="required" name="faculty_email" class="form-control">
																						</div>
																				</div>
																				<div class="form-group">
																						<label class="col-sm-2 control-label">Subject</label>
																						<div class="col-sm-10">
																							<select name="subject" data-placeholder="Select a subject" class="form-control" id="subject_list">
																								<option value=""></option>
																								{subject_list}
																								<option value="{subject_code}">{subject_name}</option>
																								{/subject_list}
																							</select>
																						</div>
																				</div>
																				<div class="form-group">
																						<div class="col-sm-4 col-sm-offset-2">
																								<button class="btn btn-white" type="reset" onclick="$('#subject_list').val(0).trigger('chosen:updated')">Reset</button>
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
																		<h2 class="m-b-xs">Import Students to {class_name}</h2>
																		<small></small>
																</div>
																<div class="ibox-content">
																		<form method="post" id="import_students" action="/dashboard/create_students" class="form-horizontal">
																				<div class="form-group">
																					<a href="/static/student_info_template.csv">Download a CSV template</a> | <a data-toggle="modal" data-target="#csv_guide">CSV Guide</a><br>
																					<label for="student_data">Insert CSV here</label>
																					<textarea placeholder="USN,Emali,Parent's Phone Number" name="student_data" id="student_data" cols="30" rows="10" class="form-control"></textarea>
																				</div>
																				<div class="form-group">
																					<button class="btn btn-white" type="reset" onclick="$('#subject_list').val(0).trigger('chosen:updated')">Reset</button>
																					<button class="btn btn-primary" type="submit">Save changes</button>
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
										<h5>Faculties Enrolled to {class_name}</h5>
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
												<th>Subject</th>
												<th>Delete</th>
											</thead>
											<tbody>
											{faculties_list}
												<tr>
													<td>{user_name}</td>
													<td><i class="fa fa-newspaper-o"></i> {subject_name}</td>
													<td><a href="#"><i class="fa fa-trash-o"></i></a></td>
												</tr>
											{/faculties_list}
											</tbody>
										</table>
									</div>
								</div>
						</div>


					<div class="col-lg-6">
								<div class="ibox float-e-margins">
									<div class="ibox-title">
										<h5>Subjects List</h5>
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
												<th>Subject Name</th>
												<th>Subject Code</th>
												<th>Delete</th>
											</thead>                                            
											<tbody>
											{subject_list}
												<tr>
													<td>{subject_name}</td>
													<td><i class="fa fa-quote-left"></i> {subject_code}</td>
													<td><a href="#"><i class="fa fa-trash-o"></i></a></td>
												</tr>
											{/subject_list}
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
		<div class="modal inmodal fade" id="csv_guide" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Guides for CSV</h4>
					<small class="font-bold">Do's and Don'ts</small>
				</div>
				<div class="modal-body">
					<div class="row">
						<ul>
							<li>Don't include any header</li>
							<li>This is going to be processed by a script so write in a sensible way</li>
							<li>Don't include any quotation marks</li>
							<li>Use the provided template if needed, don't paste invalid data</li>
							<li>Think before you submit</li>
							<li>Keep the template clean, it's not Uranus</li>
							<li>First field should be USN, second should be email address and 3rd should be parent's phone number</li>
						</ul>
					</div>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
				</div>
			</div>
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
