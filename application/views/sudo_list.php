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
					<form action="/sudo/infographics_list_tests" id="list_tests">
						<div class="form-group col-xs-3">
							<label>From<input placeholder="from" name="from" class="form-control" type="date"></label>
						</div>
						<div class="form-group col-xs-3">
							<label>To<input class="form-control col-xs-3" name="to" type="date" placeholder="to"></label>
						</div>
						<div class="form-group col-xs-3">
							<label>Reffered By<input type="text" name="ref" placeholder="Reffered By" class="form-control"></label>
						</div>
						<div class="form-group col-xs-3">
							<button class="btn btn-primary" type="submit">Load</button>
						</div>
					</form>
				</div>
				<div class="infographics">
					
					<canvas id="lineChart" height="70"></canvas>
				</div>
				<div id="results_container" class="row">
					
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
</body>
</html>
