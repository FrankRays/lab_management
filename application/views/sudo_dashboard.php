<body class="fixed-navigation">
	<div id="wrapper">
		{side_navbar}
		<div id="page-wrapper" class="gray-bg sidebar-content">
		<div class="row border-bottom">
			{top_navbar}
		</div>
				{sidebar_panel}
			<div class="wrapper wrapper-content">
				<div id="information" class="information">
					<form id="create_report" action="/sudo/next" method="post">
						<div class="form-group">
							<div class="row">
								<label class="col-sm-2 control-label" for="patient_name">Name</label>
								<div class="col-sm-10">
									<input type="text" id="patient_name" name="name" class="form-control">
								</div>
							</div>
							<div class="row">
								<label class="col-sm-2 control-label" for="ref_by">Ref. by Dr.</label>
								<div class="col-sm-10">
									<input type="text" id="ref_by" name="ref_by" class="form-control">
								</div>
							</div>
							<div class="row">
								<label class="col-sm-2 control-label" for="age">Age</label>
								<div class="col-sm-4">
									<input type="text" id="age" name="age" class="form-control">
								</div>
								<label class="col-sm-2 control-label" for="sex">Sex</label>
								<div class="col-sm-4">
									<select id="sex" name="sex" class="form-control">
										<option value="Female">Female</option>
										<option value="Male">Male</option>
									</select>
								</div>
							</div>
							
							<div class="row">
								<label class="col-sm-2 control-label" for="address">Address</label>
								<div class="col-sm-10">
									<input type="text" id="address" name="address" class="form-control">
								</div>
							</div>
							<div class="row">
								<label class="col-sm-2 control-label" for="short_clinical_history">Short Clinical History</label>
								<div class="col-sm-10">
									<input type="text" id="short_clinical_history" placeholder="Short Clinical History" name="short_clinical_history" class="form-control">
								</div>
							</div>
							<div class="row">
								<label class="col-sm-2 control-label" for="price">Price</label>
								<div class="col-sm-10">
									<input type="text" id="price" placeholder="Price" name="price_whole" class="form-control">
								</div>
							</div>

						</div>
						<table id="list_of_tests" class="table table-bordered">
							<thead>
								<th>Name of test</th>
								<th>Result</th>
								<th>Measured in</th>
								<th>Diferance Value</th>
								<th>Price</th>
							</thead>
						</table>
						<button class="btn btn-danger pull-right" type="submit">Next</button>
					</form>
				</div>
				<select name="test" id="test_list">
					{test_list}
						<option value="{id}">{group_name}</option>
					{/test_list}
				</select>
				<button class="btn btn-primary" id="add_test">Add test</button>
				<button class="btn btn-white" id="smart_style">Smart Style</button>
				

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

	<script>
		 $(document).ready(function() {

			 var lineData = {
				 labels: ["CIV", "CSE", "EEE", "ECE", "ISE", "ME","MBA"],
				datasets: [
					{
						label: "Example dataset",
						fillColor: "rgba(220,220,220,0.5)",
						strokeColor: "rgba(220,220,220,1)",
						pointColor: "rgba(220,220,220,1)",
						pointStrokeColor: "#fff",
						pointHighlightFill: "#fff",
						pointHighlightStroke: "rgba(220,220,220,1)",
						data: [65, 59, 80, 81, 56, 55, 40]
					},
					{
						label: "Example dataset",
						fillColor: "rgba(26,179,148,0.5)",
						strokeColor: "rgba(26,179,148,0.7)",
						pointColor: "rgba(26,179,148,1)",
						pointStrokeColor: "#fff",
						pointHighlightFill: "#fff",
						pointHighlightStroke: "rgba(26,179,148,1)",
						data: [28, 48, 40, 19, 86, 27, 90]
					}
				]
			};

			var lineOptions = {
				scaleShowGridLines: true,
				scaleGridLineColor: "rgba(0,0,0,.05)",
				scaleGridLineWidth: 1,
				bezierCurve: true,
				bezierCurveTension: 0.4,
				pointDot: true,
				pointDotRadius: 4,
				pointDotStrokeWidth: 1,
				pointHitDetectionRadius: 20,
				datasetStroke: true,
				datasetStrokeWidth: 2,
				datasetFill: true,
				responsive: true,
			};

		});
	</script>
</body>
</html>
