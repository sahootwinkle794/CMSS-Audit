$(document).ready(function(){
		
	var session = $('#hidSessionCode').val();
	$('#txtApplDate').datepicker({
	    format: "yyyy-mm-dd",
		todayHighlight:true,
		autoclose:true,
		endDate:"+0d"
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
			var program_group = $("#cmbProgramGroup").val();
		},
		error:function()
		{
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
    /*$('#frmAdmitCard').bootstrapValidator({
		
        message: 'This value is not valid',
        fields: {
			cmbProgram: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			cmbExamCenter: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			cmbExamVanue: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			}
		}
	});*/
	$("#cmbProgramGroup").change(function(){
		var program_group = $("#cmbProgramGroup").val();
		if(program_group != '')
		{
			var institutedata = {
				program_group : program_group,
				program_type : "Current"
			}
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
						$('#cmbProgram').html("");   //campusid from academicPeriod
						$('#cmbProgram').append(opt);
					}
					else{
						$('#cmbProgram').html("");   //campusid from academicPeriod
						$('#cmbProgram').append(optionss);
					}
					var program_code = $("#cmbProgram").val();
					$('#hidProgramCode').val(program_code);
					$('#hidProgramCodeEdit').val(program_code);
					
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});	
		}
	});
	
	$("#btnShow").click(function(){
		var program_group = $("#cmbProgramGroup").val();
		var program_code = $("#cmbProgram").val();
		var exam_center_code = $("#cmbExamCenter").val();
		var exam_vanue = $("#cmbExamVanue").val();
			
		var program_code = $("#cmbProgram").val();
		var exam_center_code = $("#cmbExamCenter").val();
		var cmbRound = $("#cmbRound").val();
		//alert(program_code);
		if((program_group =='' || program_group == null))
		{
			toastr.error("Please Select a Recruitment Drive");
		}
		else if((program_code =='' || program_code == null))
		{
			toastr.error("Please Select Post");
		}
		else if((exam_center_code =='' || exam_center_code == null))
		{
			toastr.error("Please Select Exam Center");
		}
		else if((cmbRound =='' || cmbRound == null))
		{
			toastr.error("Please Select Round");
		}
		/*else if((exam_vanue =='' || exam_vanue == null))
		{
			toastr.error("Please Enter Venue");
		}*/
		else
		{
			var exam_vanue_new = exam_vanue;
			//var exam_vanue_new = exam_vanue.replace('/', "_");
			var program_code_new = program_code.replace('/', "`");
			window.open("admitcard_assigned_applicant/"+program_code_new+"/"+exam_center_code+"/"+exam_vanue_new+"/"+cmbRound,"winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();	
		}
		
	});
	$("#cmbProgram").change(function(){
		var program_code = $("#cmbProgram").val();
		if(program_code !='')
		{
			$("#spanProcessingProgram").show();
			
			var institutedata = {
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
			});
			var institutedata = {
				program_code : $("#cmbProgram").val()
			}
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
					$('#cmbRound').html("");   
					$('#cmbRound').append(options);
				},
				error:function()
				{
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		}
	});
	$('#cmbRound,#cmbExamCenter').change(function()
	{
		var center = $("#cmbExamCenter").val();
		var program_code = $("#cmbProgram").val();
		var round_data = $('#cmbRound').val();
		if(center !='')
		{
			$("#spanProcessingExam").show();
			var institutedata = {
				program_code : program_code,
				round_data : round_data,
				exam_centre_code : center
			}
			$.ajax({
				url:base_url+"/ajax_controller/get_exam_venue_admit_setup",
				type:"post",
				data : institutedata,
				success:function(response){
					$("#spanProcessingExam").hide();  
					var options = "<option value =''>Assigned Exam Venues</option>";
					var res1 = JSON.parse(response);
					$.each(res1.aaData,function(i,data){
						options = options + "<option value='"+data.exam_vanue_code+"'>"+data.exam_vanue+"</option>";
						
					});
					
					$('#cmbExamVanue').html("");   //campusid from academicPeriod
					$('#cmbExamVanue').append(options);
					
					//alert("hello");		
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		}
	});
    	
});