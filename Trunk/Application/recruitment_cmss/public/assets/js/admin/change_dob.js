$(document).ready(function(){
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
			var options = "<option value =''>Select Program Group</option>";					
			var res1 = JSON.parse(response);					
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value='"+data.program_group_name+"'>"+data.program_group_name+"</option>";
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
	$("#btnShow").click(function(){
		var program_group = $("#cmbProgramGroup").val();
		var program_code = $("#cmbProgram").val();
		var reg_user_id = $("#txtRegUserId").val();
		
		if(program_group !='' && program_code !='' && reg_user_id !='' )
		{
			var institutedata = {
				program_code : program_code,
				reg_user_id : reg_user_id
			}
			$.ajax({
				url:base_url+"/ajax_controller/get_change_program_setup",
				type:"post",
				data:institutedata,
				success:function(response){ 
					var res1 = JSON.parse(response);
					if(res1.aaData == '')
					{
						$("#tblApplicantDetail").hide();
						toastr.error("No Record Fround");
					}
					else
					{
						//alert(response);
						$.each(res1.aaData,function(i,data){
							$("#spanApplicantNo").html(data.appl_no);
							$("#spanApplicantName").html(data.full_name);
							$("#spanApplicantDob").html(data.dob);
							$("#tblApplicantDetail").show();
							
						});
						var institutedata = {
							program_group : program_group,
							program_code : program_code
						}
						$.ajax({
							url:base_url+"/ajax_controller/get_change_program",
							type:"post",
							data:institutedata,
							success:function(response){ 
								var options = "<option value =''>Program</option>";
								var res1 = JSON.parse(response);
								$.each(res1.aaData,function(i,data){
									options = options + "<option value="+data.program_code+">"+data.program_name+"</option>";
								});
											
								
								$('#cmbChangeProgram').html("");   //campusid from academicPeriod
								$('#cmbChangeProgram').append(options);
								$("#divChangeProgram").show();
								
								//alert("hello");		
							},
							error:function(){
								toastr.error("We are unable to Process.Please contact Support");
							}
						});
						
					}
					
					//alert("hello");		
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		}
		else
		{
			$('#frmChangeProgram').bootstrapValidator({
				 message: 'This value is not valid',
			        fields: {
						cmbProgramGroup: {
			                validators: {
								notEmpty: {
										message: 'Required'
									}
							}
						},
						cmbProgram: {
			                validators: {
								notEmpty: {
										message: 'Required'
									}
							}
						},
						txtRegUserId: {
			                validators: {
								notEmpty: {
										message: 'Required'
									}
							}
						}
					}
				});
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
	$('#txtChangeRegUserId').datepicker({
    	format: "dd-mm-yyyy",
	  	todayHighlight:true,
	  	autoclose:true,
	  	//endDate:"+0d",
	  	//startDate:"<?=$ageMinDate[0]['birth_start_date']?>",
	  	//endDate:"<?=$ageMinDate[0]['birth_end_date']?>",
    });
	
	$("#btnChange").click(function(){
		var change_dob = $("#txtChangeRegUserId").val();
		
		if(change_dob == '')
		{
			toastr.error("Please Enter DOB");
		}
		/*else if(change_dob.length != 10)
		{
			toastr.error("Please Enter a 10 Digit  mobile No");
		}*/
		else
		{
			var ques = confirm("Are You Sure you Want to Change the Registered DOB");
			if(ques)
			{
				var program_code = $("#cmbProgram").val();
	    		var reg_user_id = $("#txtRegUserId").val();
				var change_dob = $("#txtChangeRegUserId").val();
				var appl_no = $("#spanApplicantNo").html();
				
				var institutedata = {
					program_code : program_code,
					reg_user_id : reg_user_id,
					change_dob : change_dob
				}
				$.ajax({
					url:base_url+"/ajax_controller/get_check_mobile_number_change_dob",
					type:"post",
					data : institutedata,
					success:function(response){ 
						var res1 = JSON.parse(response); 
						if(res1.aaData == '0')
						{
							toastr.error("This Mobile No is Not Registered with this Program. DOB Cannot be Changed");
						}
						else if(res1.aaData == '1')
						{
							var institutedata = {
								program_code : program_code,
								reg_user_id : reg_user_id,
								change_dob : change_dob,
								appl_no : appl_no
							}
							$.ajax({
								url:base_url+"/ajax_controller/get_change_DOB",
								type:"post",
								data : institutedata,
								success:function(response){ 
									var res1 = JSON.parse(response); 
									if(res1.status == true)
									{
										toastr.success(res1.msg);	
									}
									else
									{
										toastr.error(res1.msg);	
									}
									
									$("#divChangeProgram").hide();
									$("#txtChangeRegUserId").val("");
									$("#tblApplicantDetail").hide();
								},
								error:function(){
									toastr.error("We are unable to Process.Please contact Support");
								}
							});
						}
					},
					error:function(){
						toastr.error("We are unable to Process.Please contact Support");
					}
				});
				
				
			}
		}
	});

});
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}