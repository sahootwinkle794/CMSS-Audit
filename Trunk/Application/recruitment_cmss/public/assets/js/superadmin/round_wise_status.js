$(document).ready(function(){
	$.ajax({
		url:base_url+"ajax_controller/select_program_data", 
		type:"post",
		success:function(response){  
			var options = "<option value=''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData, function (index, item) {
				options += "<option value='"+item.program_code+"'>"+item.program_name+"</option>";
			});
			$('#cmbProgramFilter').html("");   //campusid from academicPeriod
			$('#cmbProgramFilter').append(options);
			},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
	$("#cmbProgramFilter").change(function(){
		var institutedata=
		{
			program_code:$('#cmbProgramFilter').val()
		};	
		var ApplicationDetail = $('#dtblApplicationDetail').dataTable({
			"ajax":
			{
				"url": base_url+"/ajax_controller/get_roundWiseStatus",
				"type": "POST",
				"data": institutedata
			}, 
			"bPaginate": false,
	        "bLengthChange": true,
	        "bFilter": true,
	        "bSort": true,
	        "bInfo": true,
	        "bDestroy" : true,
	        "bAutoWidth": false,
			"sDom":"<'row'<'col-xs-4 addCoursebtnCharge'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-5' i>>><'col-xs-3'p>>",
			"aoColumns": [
							{ "sName": "sl_no","sWidth": "5%"},
							{ "sName": "program_code","sWidth": "10%"},
							{ "sName": "round_no","sWidth": "10%"},
							{ "sName": "log","sWidth": "15%"}
				            
	        			]
		});
	});
	var ApplicationDetail = $('#dtblApplicationDetail').dataTable({
		"bPaginate": false,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bDestroy" : true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4 addCoursebtnCharge'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-5' i>>><'col-xs-3'p>>",
		"aoColumns": [
						{ "sName": "sl_no","sWidth": "5%"},
						{ "sName": "program_code","sWidth": "10%"},
						{ "sName": "round_no","sWidth": "10%"},
						{ "sName": "log","sWidth": "15%"}
			            
        			]
	});
	
	$("#btnUpdate").click(function(){
		if($('#cmbProgramFilter').val() == '' || $('#cmbProgramFilter').val() == null)
		{
			toastr.error('Please Select Post');
		}
		else
		{
			var result = false;
			var institutedata=
			{
				program_code:$('#cmbProgramFilter').val()
			};	
			$.ajax({
				url:base_url+"ajax_controller/check_publish_status", 
				type:"post",
				data:institutedata,
				success:function(response){  
					var res1 = JSON.parse(response);
					if(res1.log1 == 'NO')
					{
						toastr.error("Cannot change the status as the process hasn't completed!!")
					}
					else
					{
						if(res1.log1 == 'End')
						{
							swal({
								title: "Are you sure",
								text: "You want to continue exams?",
								type: "warning",
								showCancelButton: true,
								confirmButtonColor: "#DD6B55",
								confirmButtonText: "Yes, Continue Exam!",
								cancelButtonText: "No, cancel",
								closeOnConfirm: false,
								closeOnCancel: true
							},
							function(isConfirm){
							  	if (isConfirm) {
							  		deleteCode();
							    	swal("Continued", "Exams Continued successfully", "success");
							  	}
							});
						}
						else
						{
							swal({
								title: "Are you sure",
								text: "You want to end exams?",
								type: "warning",
								showCancelButton: true,
								confirmButtonColor: "#DD6B55",
								confirmButtonText: "Yes, End Exam!",
								cancelButtonText: "No, cancel",
								closeOnConfirm: false,
								closeOnCancel: true
							},
							function(isConfirm){
							  	if (isConfirm) {
							  		deleteCode();
							    	swal("Ended", "Exams Ended successfully", "success");
							  	} 
							});
						}
						function deleteCode()
						{
							var institutedata=
							{
								program_code:$('#cmbProgramFilter').val(),
								status:res1.log1
							};	
							$.ajax({
								url:base_url+"ajax_controller/change_publish_status", 
								type:"post",
								data:institutedata,
								success:function(response){  
									var res1 = JSON.parse(response);
									if(res1.status == 'SUCCESS')
									{
										var dtblApplicationDetail = $("#dtblApplicationDetail").DataTable();
					 					dtblApplicationDetail.ajax.reload();
										toastr.success(res1.msg);
									}
									else
									{
										toastr.error("Unable to change the status");
									}
								},
								error:function(){
									toastr.error("We are unable to Process.Please contact Support");
								}
							});
						}
						
						
					}
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		}
		
	});
	
});