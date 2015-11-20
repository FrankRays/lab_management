<body class="fixed-navigation" style="margin-left:80px !important;">
	<div id="wrapper">
		<div id="page-wrapper" style="min-height:80px !important;margin-left:0px !important;" class="gray-bg sidebar-content">
			<div class="wrapper wrapper-content">
				<div id="information" class="information">
					<div class="screen_only">
						<a href="/sudo" class="btn btn-primary">Back to home</a>
					</div>
						<div class="form-group">
							<div class="row">
							<div class="col-md-6">
							<table class="table table-condensed" id="user_info">
								<tr>
									<th>Name</th><td>{patient_name}</td><th>Age - {age}</th><td></td>
								</tr>
								<tr>
									<th>Sex</th><td>{sex}</td><th>Ref. By</th><td>{ref}</td>
								</tr>
								<tr>
									<th>Address</th><td>{address}</td><th>Short Clinical History</th><td>{short_clinical_history}</td>
								</tr>
								<tr>
									<th>Date</th><td>{date_checked}</td><th>Lab Number</th><td rowspan="3">{lab_number}</td>
								</tr>
								<tr class="screen_only">
									<th>Price</th><td rowspan="3">{price}</td>
								</tr>
							</table>
							</div>
							</div>

						</div>
						{results}
							<div class="panel panel-primary" id="">
								<div class="panel-heading">
									{name}
								</div>
								<div class="panel-body">
									<table class="table table-condensed">
										<thead>
											<th>Name of test</th>
											<th>Result</th>
											<th>Diferance Value</th>
										</thead>
										<tbody>
											{group_info}
											<tr>
												<td>{test_name}</td>
												<td>{result}</td>
												<td>{default_value}</td>
											</tr>
											{/group_info}
										</tbody>
									</table>
								</div>
							</div>
							<div class="user_info">
								
							</div>
							<div class="screen_only" style="margin-bottom:10px;"><button type="button" class="btn btn-primary" onclick='$(this).parent().prev().prev().css("margin-bottom","+=10px");'>+ Margin</button><button type="button" class="btn btn-info" onclick='$(this).parent().prev().prev().css("margin-bottom","-=10px");'>- Margin</button><button type="button" class="btn btn-white pull-right" onclick="$(this).parent().prev().html($('#user_info').parent().html())">+ User Info</button><button type="button" class="btn btn-white pull-right" onclick="$(this).parent().prev().html('')">- User Info</button></div>
						{/results}
				</div>
			</div> <!-- end of wrapper wrapper-content -->
			<div class="row">
				<div class="col-xs-3">
					_________________
					<br>Verified By
				</div>
				<div class="col-xs-3 pull-right">
					_________________
					<br>Signature
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
	<style>
	.sidebar-content .wrapper, .wrapper.sidebar-content{
		padding-right:0px !important;
	}
	.sidebar-content .wrapper, .wrapper.sidebar-content {
     padding-right: 0px !important; 
}
.sidebar-content .wrapper, .wrapper.sidebar-content{
	padding-right: 0px !important;
}
*{
	font-family: sans-serif !important;
}
		@media only print{
			*{
				/*font-size:0.98em;*/
			}
			.panel-body{
				padding:0px;
			}
			.table{
				margin-bottom: 0px;
			}
			.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
				padding:5px !important;
			}
			.screen_only{
				display:none;
			}
		}
	</style>
</body>
</html>
