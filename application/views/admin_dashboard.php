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
										<h1 class="m-b-xs">Overall status for {Date}</h1> <br>
									</div>

								<div>
									<canvas id="lineChart" height="70"></canvas>
								</div>

								<div class="m-t-md">
									<small class="pull-right">
										<i class="fa fa-clock-o"> </i>
										Update for {Date}
									</small>
								</div>

							</div>
						</div>
					</div>
				</div>
				<!--  -->
					<div class="row">
						<div class="col-lg-12">
											<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Attendance status</h5>
					</div>

					<div class="ibox-content">
						<div class="row">
							<div class="col-xs-4">
								<h4>Class</h4>
							</div>

							<div class="col-xs-4">
								<h4>Total</h4>
							</div>
							<div class="col-xs-4">
								<h4>Present</h4>
							</div>
						</div>
					</div>

					<div class="ibox-content">
						<div class="row">
							<div class="col-xs-4">
								<h4>3 ISE</h4>
							</div>

							<div class="col-xs-4">
								<h4>80/100</h4>
							</div>
							<div class="col-xs-4">
								<h4>48.6%</h4>
							</div>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-xs-4">
								<h4>5 ISE</h4>
							</div>

							<div class="col-xs-4">
								<h4>80/101</h4>
							</div>
							<div class="col-xs-4">
								<h4>78.5%</h4>
							</div>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-xs-4">
								<h4>7 ISE</h4>
							</div>

							<div class="col-xs-4">
								<h4>80/100</h4>
							</div>
							<div class="col-xs-4">
								<h4>79.8%</h4>
							</div>
						</div>
					</div>
				</div>
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

	<script>
		 $(document).ready(function() {

			 var lineData = {
				 labels: ["3A-CSE", "5A-CSE", "7A-CSE", "3B-CSE", "5B-CSE", "7B-CSE"],
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


			var ctx = document.getElementById("lineChart").getContext("2d");
			var myNewChart = new Chart(ctx).Line(lineData, lineOptions);

		});
	</script>
</body>
</html>