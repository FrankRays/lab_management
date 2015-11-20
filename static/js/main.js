jQuery(document).ready(function($) {
	$("#create_super_admin_form").on('submit', function(event) {
		event.preventDefault();
		data=$("#create_super_admin_form").serialize();
		$.ajax({
			url: '/install/save',
			type: 'POST',
			dataType: 'json',
			data: data
		})
		.done(function(e) {
			if(e.status=="ok"){
				toast("success","Success",e.message);
				$(".panel-body").hide()
					.html("<p>Account Created, you can verify your email and <a href='/login'>login</a> to your account now.</p><p class='text-muted'>You should be deleting Install controller and installer now. Preserving those files would be a huge security risk.</p>Additionally, you should also modify the action of this form")
						.show();
			}else if(e.status=="error"){
				toast("error","Error",e.message);
			}else{
				toast("error","Error","An unknown error occured");
			}
		})
		.fail(function() {
			toast("error","Error","We can't connect to server, please check your internet connection");
		});
	});
	function toast (kind,title,message) {
		toastr.clear();
		toastr.options = {
			"closeButton": true,
			"debug": false,
			"progressBar": true,
			"positionClass": "toast-top-right",
			"onclick": null,
			"showDuration": "400",
			"hideDuration": "1000",
			"timeOut": "7000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "slideDown",//fadeIn
			"hideMethod": "slideUp"//fadeOut
		}
		toastr[kind](message,title);
	}
	$("#loginForm").on('submit', function(event) {
		event.preventDefault();
		data = $("#loginForm").serialize();
		action=$("#loginForm").attr("action");
		$.ajax({
			url: action,
			type: 'POST',
			dataType: 'json',
			data: data
		})
		.done(function(data) {
			if(data.status == 'Success'){
				window.location=data.url;
			}
			if(data.status == 'Error'){
				toast('error','Error',data.message);
			}
			
		})
		.fail(function() {
			toast('error','Error','Looks like there is a problem with internet connection');
		});
	});
	$("#resend_form").on('submit', function(event) {
		event.preventDefault();
		data = $("#resend_form").serialize();
		action=$("#resend_form").attr("action");
		$("#resend_form button").attr("disabled","disabled");
		$.ajax({
			url: action,
			type: 'POST',
			dataType: 'json',
			data: data
		})
		.done(function(data) {
			$("#resend_form button").removeAttr("disabled");
			if(data.status == 'Success'){
				toast('success','Success',data.message);
			}
			if(data.status == 'Error'){
				toast('error','Error',data.message);
			}
			
		})
		.fail(function() {
			$("#resend_form button").removeAttr("disabled");
			toast('error','Error','Looks like there is a problem with internet connection');
		});
	});
	$("#change_password").on('submit', function(event) {
		event.preventDefault();
		data = $("#change_password").serialize();
		action=$("#change_password").attr("action");
		$("#change_password button").attr("disabled","disabled");
		$.ajax({
			url: action,
			type: 'POST',
			dataType: 'json',
			data: data
		})
		.done(function(data) {
			$("#change_password button").removeAttr("disabled");
			if(data.status == 'Success'){
				toast('success','Success',data.message);
				window.location=data.url;
			}
			if(data.status == 'Error'){
				toast('error','Error',data.message);
			}
			
		})
		.fail(function() {
			$("#change_password button").removeAttr("disabled");
			toast('error','Error','Looks like there is a problem with internet connection');
		});
	});
	$("#forgot_form").on('submit', function(event) {
		event.preventDefault();
		data = $("#forgot_form").serialize();
		action=$("#forgot_form").attr("action");
		$("#forgot_form button").attr("disabled","disabled");
		$.ajax({
			url: action,
			type: 'POST',
			dataType: 'json',
			data: data
		})
		.done(function(data) {
			$("#forgot_form button").removeAttr("disabled");
			if(data.status == 'Success'){
				toast('success','Success',data.message);
			}
			if(data.status == 'Error'){
				toast('error','Error',data.message);
			}
			
		})
		.fail(function() {
			$("#forgot_form button").removeAttr("disabled");
			toast('error','Error','Looks like there is a problem with internet connection');
		});
	});
	$("#create_admin_form").on('submit', function(event) {
		event.preventDefault();
		data = $("#create_admin_form").serialize();
		email=$("#create_admin_form input").val();
		action=$("#create_admin_form").attr("action");
		$("#create_admin_form button[type=submit]").attr("disabled","disabled");
		$.ajax({
			url: action,
			type: 'POST',
			dataType: 'json',
			data: data
		})
		.done(function(data) {
			$("#create_admin_form button[type=submit]").removeAttr("disabled");
			if(data.status == 'Success'){
				a="<option value='"+email+"'>"+email+"</option>";
				$("#admin_list").append(a);
				$("#admin_list").val(0).trigger('chosen:updated')
				toast('success','Success',data.message);
				$("#create_admin_form")[0].reset();
				$("#create_admin_form select").val(0).trigger('chosen:updated')
			}
			if(data.status == 'Error'){
				toast('error','Error',data.message);
			}
			
		})
		.fail(function() {
			$("#create_admin_form button[type=submit]").removeAttr("disabled");
			toast('error','Error','Looks like there is a problem with internet connection');
		});
		
	});
	$("#create_department").on('submit', function(event) {
		event.preventDefault();
		data = $("#create_department").serialize();
		action=$("#create_department").attr("action");
		$("#create_department button[type=submit]").attr("disabled","disabled");
		$.ajax({
			url: action,
			type: 'POST',
			dataType: 'json',
			data: data
		})
		.done(function(data) {
			$("#create_department button[type=submit]").removeAttr("disabled");
			if(data.status == 'Success'){
				toast('success','Success',data.message);
				$("#create_department")[0].reset();
				$("#create_department select").val(0).trigger('chosen:updated')
			}
			if(data.status == 'Error'){
				toast('error','Error',data.message);
			}
			
		})
		.fail(function() {
			$("#create_department button[type=submit]").removeAttr("disabled");
			toast('error','Error','Looks like there is a problem with internet connection');
		});
	});
	$("#create_class").on('submit', function(event) {
		event.preventDefault();
		data = $("#create_class").serialize();
		action=$("#create_class").attr("action");
		$("#create_class button[type=submit]").attr("disabled","disabled");
		$.ajax({
			url: action,
			type: 'POST',
			dataType: 'json',
			data: data
		})
		.done(function(data) {
			$("#create_class button[type=submit]").removeAttr("disabled");
			if(data.status == 'Success'){
				toast('success','Success',data.message);
				$("#create_class")[0].reset();
				$("#create_class select").val(0).trigger('chosen:updated')
			}
			if(data.status == 'Error'){
				toast('error','Error',data.message);
			}
			
		})
		.fail(function() {
			$("#create_class button[type=submit]").removeAttr("disabled");
			toast('error','Error','Looks like there is a problem with internet connection');
		});
	});
	$("#add_subject").on('submit', function(event) {
		event.preventDefault();
		data = $("#add_subject").serialize();
		action=$("#add_subject").attr("action");
		$("#add_subject button[type=submit]").attr("disabled","disabled");
		subject_name=$("#add_subject input[name=subject_name]").val();
		subject_code=$("#add_subject input[name=subject_code]").val();
		$.ajax({
			url: action,
			type: 'POST',
			dataType: 'json',
			data: data
		})
		.done(function(data) {
			$("#add_subject button[type=submit]").removeAttr("disabled");
			if(data.status == 'Success'){
				toast('success','Success',data.message);
				a="<option value='"+subject_code+"'>"+subject_name+"</option>";
				$("#subject_list").append(a);
				$("#add_subject")[0].reset();
				$("#create_class select").val(0).trigger('chosen:updated')
			}
			if(data.status == 'Error'){
				toast('error','Error',data.message);
			}
			
		})
		.fail(function() {
			$("#add_subject button[type=submit]").removeAttr("disabled");
			toast('error','Error','Looks like there is a problem with internet connection');
		});
	});
	$("#import_students").on('submit', function(event) {
		event.preventDefault();
		data = $("#import_students").serialize();
		action=$("#import_students").attr("action");
		$("#import_students button[type=submit]").attr("disabled","disabled");
		subject_name=$("#import_students input[name=subject_name]").val();
		subject_code=$("#import_students input[name=subject_code]").val();
		$.ajax({
			url: action,
			type: 'POST',
			dataType: 'json',
			data: data
		})
		.done(function(data) {
			$("#import_students button[type=submit]").removeAttr("disabled");
			if(data.status == 'Success'){
				toast('success','Success',data.message);
				a="<option value='"+subject_code+"'>"+subject_name+"</option>";
				$("#subject_list").append(a);
				$("#import_students")[0].reset();
				$("#create_class select").val(0).trigger('chosen:updated')
			}
			if(data.status == 'Error'){
				toast('error','Error',data.message);
			}
			
		})
		.fail(function() {
			$("#import_students button[type=submit]").removeAttr("disabled");
			toast('error','Error','Looks like there is a problem with internet connection');
		});
	});
	$("#mark_attendance").on('submit', function(event) {
		event.preventDefault();
		data = $("#mark_attendance").serialize();
		action=$("#mark_attendance").attr("action");
		$("#mark_attendance button[type=submit]").attr("disabled","disabled");
		subject_name=$("#mark_attendance input[name=subject_name]").val();
		subject_code=$("#mark_attendance input[name=subject_code]").val();
		$.ajax({
			url: action,
			type: 'POST',
			dataType: 'json',
			data: data
		})
		.done(function(data) {
			$("#mark_attendance button[type=submit]").removeAttr("disabled");
			if(data.status == 'Success'){
				toast('success','Success',data.message);
				a="<option value='"+subject_code+"'>"+subject_name+"</option>";
				$("#subject_list").append(a);
				$("#create_class select").val(0).trigger('chosen:updated')
			}
			if(data.status == 'Error'){
				toast('error','Error',data.message);
			}
			
		})
		.fail(function() {
			$("#mark_attendance button[type=submit]").removeAttr("disabled");
			toast('error','Error','Looks like there is a problem with internet connection');
		});
	});
	$("#add_test").click(function(event) {
		event.preventDefault();
		var group=$("#test_list").val();
		//perform an ajax request and get list of tests under ```group```
		$.ajax({
			url: '/sudo/list_tests',
			type: 'GET',
			dataType: 'json',
			data: {group: group}
		})
		.done(function(data) {
			if(data.status == 'Error'){
				toast('error','Error',data.message);
			}else{
				list_of_tests=data.lists;
				for(var i =0 ; i<list_of_tests.length; i++){
					test=list_of_tests[i];
					test_id=test.id;
					test_name=test.test_name;
					unit_measurement=test.unit_measurement;
					default_value=test.default_value;
					prefill_value=test.prefill_value;
					price=test.price;
					if(price==null){
						price="";
					}
					if(prefill_value==null){
						prefill_value="";
					}
					var cal=new Date();
					var date=cal.getDate()+"/"+cal.getMonth()+"/"+cal.getFullYear();
					prefill_value=prefill_value.replace('{date}',date);
					input_field=test.input_field;
					if(input_field==null || input_field==""){
						test_result_input="<input style='background:#846583 !important; color:#ffffff !important' value='"+prefill_value+"' class='form-control styled_placeholder result_input' type='text' tabindex='1'  placeholder='Result of Test' name='test_result["+test_id+"]' />";
					}else{
						test_result_input=input_field;
						test_result_input=test_result_input.replace('{name}',"test_result["+test_id+"]");
						console.log(test_result_input);
					}
					test_name_input="<input style='background:#6E93B7 !important; color:#ffffff !important' class='form-control' type='text' name='test_name["+test_id+"]' value='"+test_name+"' />";
					test_unit_measure="<input style='background:#6E93B7 !important; color:#ffffff !important' class='form-control' type='text' name='unit_measurement["+test_id+"]' value='"+unit_measurement+"' />";
					default_value_input="<input style='background:#6E93B7 !important; color:#ffffff !important' class='form-control' type='text' name='default_value["+test_id+"]' value='"+default_value+"' />";
					price_input="<input style='background:#6E93B7 !important; color:#ffffff !important' class='form-control' type='text' name='price["+test_id+"]' value='"+price+"' />";
					var tr="<tr><td>"+test_name_input+"</td><td>"+test_result_input+"</td><td>"+test_unit_measure+"</td><td>"+default_value_input+"</td><td>"+price_input+"</td></tr>";
					$("#list_of_tests").append(tr);
				}
			}
		})
		.fail(function() {
			toast('error','Error','came');
		});
		
	});
	if($('[data-requestFocus]')[0]){
		$('[data-requestFocus]')[0].focus();
	}
	$("#test_list").chosen();
	$("#admin_list").chosen();
	if($('.js-switch_2')[0]){
		$('.js-switch_2').each(function(index, el) {
			switchery=new Switchery(el);
		});;
	}
	$("#toggle_all_btn").click(function(event) {
		event.preventDefault();
		$('span.switchery').each(function(index, el) {
			el.click();
		});;
	});
	$("#smart_style").click(function(event) {
		event.preventDefault();
		$(".result_input").each(function(index, el) {
			if($(el).val()==""){
				$(el).parent().parent().hide('slow');
				$(el).parent().parent().remove();
			}
		});
		$("select.form-control").each(function(index, el) {
			if($(el).val()==""){
				$(el).parent().parent().hide('slow');
				$(el).parent().parent().remove();
			}
		});
	});
	$("#create_report").on('submit', function(event) {
		event.preventDefault();
		data = $("#create_report").serialize();
		action=$("#create_report").attr("action");
		$("#create_report button[type=submit]").attr("disabled","disabled");
		$.ajax({
			url: action,
			type: 'POST',
			dataType: 'json',
			data: data
		})
		.done(function(data) {
			$("#create_report button[type=submit]").removeAttr("disabled");
			if(data.status == 'Success'){
				toast('success','Success',data.message);
				window.location='/sudo/tests/'+data.test_id;
			}
			if(data.status == 'Error'){
				toast('error','Error',data.message);
			}
			
		})
		.fail(function() {
			$("#create_report button[type=submit]").removeAttr("disabled");
			toast('error','Error','Looks like there is a problem with internet connection');
		});
	});
		$("#list_tests").on('submit', function(event) {
		event.preventDefault();
		data = $("#list_tests").serialize();
		action=$("#list_tests").attr("action");
		$("#list_tests button[type=submit]").attr("disabled","disabled");
		$.ajax({
			url: action,
			type: 'POST',
			dataType: 'json',
			data: data
		})
		.done(function(data) {
			$("#infographics").children('canvas').remove();
			html='<canvas id="lineChart" height="70"></canvas>';
			$("#infographics").html(html);
			$("#list_tests button[type=submit]").removeAttr("disabled");
			if(data.status == 'Success'){
				//data.html
				$("#results_container").html(data.html);
				dataset=data.dataset;
				console.log(dataset);
				var labels=new Array();
				var datasets=new Array();
				for(var i = 0; i< dataset.length;i++){
					labels.push(dataset[i].ref);
					datasets.push(dataset[i].amount);
				}
				console.log(labels);
				var lineData = {
				labels: labels,
				datasets: [
					{
						label: "Example dataset",
						fillColor: "rgba(26,179,148,0.5)",
						strokeColor: "rgba(26,179,148,0.7)",
						pointColor: "rgba(26,179,148,1)",
						pointStrokeColor: "#fff",
						pointHighlightFill: "#fff",
						pointHighlightStroke: "rgba(26,179,148,1)",
						data: datasets
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

				//data.dataset
			}
			if(data.status == 'Error'){
				toast('error','Error',data.message);
			}
			
		})
		.fail(function() {
			$("#list_tests button[type=submit]").removeAttr("disabled");
			toast('error','Error','Looks like there is a problem with internet connection');
		});
	});
});
function delete_test (id,elem) {
	if(confirm('Are you sure you want to delete this test?')){
		$.ajax({
			url: '/sudo/delete_test',
			type: 'GET',
			dataType: 'json',
			data: {id: id},
		})
		.done(function(e) {
			$(elem).parent().parent().remove();
			if(e.status=="Success"){
				toast('success','Success',e.message);
			}else{
				toast('error','Error',e.message);
			}
		})
		.fail(function() {
			toast('error','Error',"Looks like there is a problem with internet connection");
		});
	}else{
		return false;
	}
}