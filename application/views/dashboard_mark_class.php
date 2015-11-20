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
						<form action="{url}" method="post" id="mark_attendance">
							<label for="hour">Hour</label>
							<select class="form-control" name="hour" id="hour_class">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
							</select>
							<table class="table">
								<thead>
									<tr>
										<th class="text-center"><h3>USN</h3></th>
										<th class="text-center"><h3>Name</h3></th>
										<th class="text-center"><h3><a href="#" id="toggle_all_btn">Toggle All</a><!--  | <a href="" onclick="uncheckall()">Uncheck All</a> --></h3></th>
									</tr>
								</thead>
								</h3><tbody>
									{list_students}
									<tr>
										<td class="text-center"><h3>{sn}</h3></td>
										<td class="text-center"><h3>{name}</h3></td>
										<td class="text-center">
											<input name="student[{user_id}]" type="checkbox" class="js-switch_2" data-switchery="true" />
										</td>
									</tr>
									{/list_students}
								</tbody>
							</table>
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>	
						<h2>{list_students_message}</h2>
					</div>
				</div>

			</div> <!-- end of wrapper wrapper-content -->
		{page_footer}

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
	<script src="/static/js/inspinia.js"></script>
	<script src="/static/js/plugins/pace/pace.min.js"></script>

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

	<!-- SwitcheryJS -->
	<script src="/static/js/plugins/switchery/switchery.js"></script>

</body>
</html>