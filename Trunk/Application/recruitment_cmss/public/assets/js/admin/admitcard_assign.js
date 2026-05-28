$(document).ready(function()
{
	$("#tblReport").hide();
	$('#txtApplDate').datepicker({
    format: "dd-mm-yyyy",
	todayHighlight:true,
	autoclose:true
    });
	$('#txtAutoApplDate').datepicker({
    format: "dd-mm-yyyy",
	todayHighlight:true,
	autoclose:true
    });
	
    $.ajax({
		url:base_url+"/ajax_controller/get_program_group_admit_setup",
		type:"post",
		data:"",
		success:function(response)
		{  
			var options = "<option value =''>Select Recruitment Drive</option>";					
			var res1 = JSON.parse(response);					
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value='"+data.program_group_code+"'>"+data.program_group_name+"</option>";
			});
			$('#cmbProgramGroup').html("");   
			$('#cmbProgramGroup').append(options);
			$('#cmbAutoProgramGroup').html("");   
			$('#cmbAutoProgramGroup').append(options);
			var program_group = $("#cmbProgramGroup").val();
		},
		error:function()
		{
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
	
	$("#cmbAutoProgramGroup").change(function(){
		var cmbAutoProgramGroup = $("#cmbAutoProgramGroup").val();
		if(cmbAutoProgramGroup != '')
		{
			var institutedata = {
				program_group : cmbAutoProgramGroup,
				program_type : "Current"
			}
			progCodeDropDown(institutedata,'cmbAutoProgram');
		}
		
	});
	$("#cmbProgramGroup").change(function(){
		var program_group = $("#cmbProgramGroup").val();
		if(program_group != '')
		{
			var institutedata = {
				program_group : program_group,
				program_type : "Current"
			}
			progCodeDropDown(institutedata,'cmbProgram');
		}
	});
	function progCodeDropDown(institutedata,change_id){
		$.ajax({
			url:base_url+"/ajax_controller/get_program_admit_setup",
			type:"post",
			data : institutedata,
			success:function(response){  
				var optionss = "<option value =''>Select</option>";
				var res1 = JSON.parse(response); 
				var count = 0;
				$.each(res1.aaData,function(i,data){
					count++;
					optionss = optionss + "<option value="+data.program_code+">"+data.program_name+"</option>";
				});
				var opt = "<option value ='null'>Select</option>";
				if(count == 0){
					$('#'+change_id).html("");   //campusid from academicPeriod
					$('#'+change_id).append(opt);
				}
				else{
					$('#'+change_id).html("");   //campusid from academicPeriod
					$('#'+change_id).append(optionss);
				}
				
				
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});	
	}
	
    $('#frmAdmitCard').bootstrapValidator({
		/* excluded: [':disabled'], */
        message: 'This value is not valid',
        fields: {
			cmbProgram: {
                validators: {
					notEmpty: {
						message: 'Required'
					}
				}
			},
			/*cmbExamCenter: {
                validators: {
					notEmpty: {
						message: 'Required'
					}
				}
			},*/
			txtApplDate: {
                validators: {
					notEmpty: {
						message: 'Required'
					}
				}
			}
		}
	});
	$("#cmbAutoProgram").change(function(){
		var institutedata = {
			program_code : $("#cmbAutoProgram").val()
		}
		roundDropDown(institutedata,'cmbAutoRound');
	});
	$("#cmbProgram").change(function(){
		var program_code = $("#cmbProgram").val();
		if(program_code !='')
		{
			//$("#spanProcessingProgram").show();
				
			/*var institutedata = {
				program_code : program_code
			}
			$.ajax({
				url:base_url+"/ajax_controller/get_exam_centre_admit_setup",
				type:"post",
				data : institutedata,
				success:function(response){ 
					$("#spanProcessingProgram").hide(); 
					var options = "<option value =''>Applied Exam Center</option>";
					var res1 = JSON.parse(response);
					$.each(res1.aaData,function(i,data){
						options = options + "<option value="+data.exam_centre_code+">"+data.exam_centre_name+"</option>";
					});
					$('#cmbExamCenter').html("");   //campusid from academicPeriod
					$('#cmbExamCenter').append(options);
					$('#cmbExamCentreAdd').html("");   //campusid from academicPeriod
					$('#cmbExamCentreAdd').append(options);
					var exam_centre_code = $('#cmbExamCenter').val();
					
					$('#hidExamCentreCode').val(exam_centre_code);
					
					//alert("hello");		
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});*/
			var institutedata = {
				program_code : $("#cmbProgram").val()
			}
			roundDropDown(institutedata,'cmbRound');
		}
	
	});
	function roundDropDown(institutedata,assign_id){
		$.ajax({
			url:base_url+"/ajax_controller/get_round_no",
			type:"post",
			data:institutedata,
			success:function(response)
			{  
				var options = "<option value =''>Select Round</option>";					
				var res1 = JSON.parse(response);					
				$.each(res1.aaData,function(i,data)
				{
					options = options + "<option value='"+data.round_no+"'>"+data.round_no+"</option>";
				});
				$('#'+assign_id).html("");   
				$('#'+assign_id).append(options);
			},
			error:function()
			{
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	}
	$("#btnShow").click(function(){
			
		var program_group = $("#cmbProgramGroup").val();
		var program_code = $("#cmbProgram").val();
		//var exam_center_code = $("#cmbExamCenter").val();
		var applied_date = $("#txtApplDate").val();
		var cmbRound = $("#cmbRound").val();
		//var date = applied_date.split('/');
		var date = applied_date.replace (/\//g, "-");
		if((program_group =='' || program_group == null))
		{
			toastr.error("Please Select Recruitment Drive");
		}
		else if((program_code =='' || program_code == null))
		{
			toastr.error("Please Select Post");
		}
		/*else if((exam_center_code =='' || exam_center_code == null))
		{
			toastr.error("Please Select Exam Center");
		}*/
		else if((cmbRound =='' || cmbRound == null))
		{
			toastr.error("Please Select Round");
		}
		else if((applied_date =='' || applied_date == null))
		{
			toastr.error("Please Enter Date");
		}
		else
		{
			
			var program_code_new = program_code.replace('/', "`");
			window.open("admitcard_applicant/"+program_code_new+"/"+date+"/"+cmbRound,"winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
		}
		
	});
	
	$("#btnShowAppl").click(function(){
		var program_code = $("#cmbProgram").val();
		var exam_center_code = $("#cmbExamCenter").val();
		var applied_date = $("#txtApplDate").val();
		//var date = applied_date.split('/');
		var date = applied_date.replace (/\//g, "-");
		if(program_code != null && exam_center_code != '')
		{
			$("#tblReport").show();
			var data = {
				program_code:program_code,
				exam_centre_code:exam_center_code,
			};
			var centerAddressMaster = $('#tblReportMaster').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/get_report_admit_assign",
					"type": "POST",
					"data": data,
				},  
				"bPaginate": false,
		        "bLengthChange": false,
		        "bFilter": false,
		        "bSort": false,
		        "bInfo": true,
				"bDestroy" : true,
		        "bAutoWidth": false,
				"sDom":"<'row'<'col-xs-4'i><'col-xs-4'><'col-xs-4'f>r>t<'row'<'col-xs-9'><'col-xs-3'>>",
				"aoColumns": [
			                 { "sName": "Slno","sWidth": "5%" },
		                     { "sName": "exam_vanue","sWidth": "20%" },
							 { "sName": "assigned_students","sWidth": "10%" },
							 { "sName": "published_students","sWidth": "10%" }
		        			],
		        "fnDrawCallback": function(oSettings, json) {
			        $('.tooltipTable').tooltipster( {
			           theme: 'tooltipster-punk',
			           animation: 'grow',
			           delay: 200, 
			           touchDevices: false,
			           trigger: 'hover'
			        });
		        }
			});
			
			var data = {
				program_code:program_code,
				exam_centre_code:exam_center_code,
			};
			var centerAddressMaster = $('#tblConsReportMaster').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/get_cons_report_admit_assign",
					"type": "POST",
					"data": data,
				},  
				"bPaginate": false,
		        "bLengthChange": false,
		        "bFilter": false,
		        "bSort": false,
		        "bInfo": true,
				"bDestroy" : true,
		        "bAutoWidth": true,
				"sDom":"<'row'<'col-xs-4'i><'col-xs-4'><'col-xs-4'>r>t<'row'<'col-xs-9'><'col-xs-3'>>",
				"aoColumns": [
			                 { "sName": "Slno"},
		                     { "sName": "no_of_not_assigned_students"}
		        			],
		        "fnDrawCallback": function(oSettings, json) {
			        $('.tooltipTable').tooltipster( {
			           theme: 'tooltipster-punk',
			           animation: 'grow',
			           delay: 200, 
			           touchDevices: false,
			           trigger: 'hover'
			        });
		        }
			});
		}
		else
		{
			if(program_code == '' || program_code == null)
			{
				toastr.error("Please select program");
			}
			else if(exam_center_code == '' || exam_center_code == null)
			{
				toastr.error("Please select Exam center");
			}
			
		}
	});
	
	$('#btnAutoAssign').click(function(){
		cmbAutoRound = $('#cmbAutoRound').val();
		txtAutoApplDate = $('#txtAutoApplDate').val();
		if(cmbAutoRound!='' && txtAutoApplDate!=''){		
			formdata = new FormData(document.getElementById('frmAdmitCardAutomatic'));
			$.ajax({
				url: base_url+'ajax_controller/admitcard_auto_assign',
				type: 'POST',
				data:formdata,
				contentType: false,
				processData: false,
				success:function(response){
					
				},
				error:function(e){
					alert('Unable to Load.Please Try Again');
				}
			});
		}else{
			toastr.error("Please select All the Filter");
		}
	});
});