$(document).ready(function(){
	
	/*$.ajax({
		url:base_url+"ajax_controller/select_cmbgroup_data",
		type:"post",
		success:function(response){  
			var options = "<option value=''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.program_group_name+">"+data.program_group_name+"</option>";
				
			});
			$('#cmbProgramGroup').html("");   //campusid from academicPeriod
			$('#cmbProgramGroup').append(options);
			$('#cmbProgramGroupEdit').html("");   //campusid from academicPeriod
			$('#cmbProgramGroupEdit').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});*/
	
	$.ajax({
		url:base_url+"ajax_controller/select_prog_all",
		type:"post",
		success:function(response){  
			var options = "";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.program_code+">"+data.program_name+"</option>";
				
			});
			$('#cmbProgram').html("");   //campusid from academicPeriod
			$('#cmbProgram').append(options);
			$('#cmbProgramResult').html("");   //campusid from academicPeriod
			$('#cmbProgramResult').append(options);
		}
	});	
})		