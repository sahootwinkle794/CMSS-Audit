$(document).ready(function(){
	// to get program name
	var institutedata={
		program_code : $('#sel_program').val()
	};
	$.ajax({
		url:base_url+"/ajax_controller/get_applicants_program_name_admit_setup",
		type:"post",
		data : institutedata,
		success:function(response){ 
			var res1 = JSON.parse(response); 
			$("#program").html(res1.program_name); 
			$("#program").val(res1.program_code); 
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
	// to get exam centre name
	var institutedata={
		program_code : $('#sel_program').val(),
		assigned_exam_center_code : $('#sel_exam_center').val(),
	};
	$.ajax({
		url:base_url+"/ajax_controller/get_published_applicants_exam_centre_name_admit_setup",
		type:"post",
		data : institutedata,
		success:function(response){ 
			var res1 = JSON.parse(response); 
			$("#exam_centre").html(res1.exam_center_name); 
			$("#exam_centre").val(res1.exam_center_code); 
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
	//alert($('#sel_exam_vanue').val());
	// to get exam centre name
	var institutedata={
		program_code : $('#sel_program').val(),
		assigned_exam_center_code : $('#sel_exam_center').val(),
		exam_vanue : $('#sel_exam_vanue').val()
	};
	$.ajax({
		url:base_url+"/ajax_controller/get_published_applicants_exam_venue_name_admit_setup_1",
		type:"post",
		data : institutedata,
		success:function(response){ 
			var res1 = JSON.parse(response); 
			$("#exam_venue").html(res1.exam_venue_name); 
			//$("#exam_venue").val(res1.exam_venue_code); 
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
	// to load data table
	var institutedata={
		program_code : $('#sel_program').val(),
		assigned_exam_center_code : $('#sel_exam_center').val(),
		exam_vanue : $('#sel_exam_vanue').val(),
		round_data: $("#round_data").val()
	};
	$.ajax({
		url:base_url+"/ajax_controller/get_published_applicants_report_admit_setup",
		type:"post",
		data : institutedata,
		success:function(response){ 
			var res1 = JSON.parse(response); 
			$("#divApplicantList").html(res1.html); 
			$("#btnTotalcount").html(res1.totalapplicant);
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$("#btnExcel12").click(function(){
		var from = $("#txtFromSlNo").val();
		var to = $("#txtToSlNo").val();
		var program_code = $('#sel_program').val();
		var assigned_exam_center_code = $('#sel_exam_center').val();
		var exam_vanue = $('#sel_exam_vanue').val();
		var course = $('#sel_course').val();
		var exam_vanue_new = exam_vanue.replace('/', "_");
		var program_code_new = program_code.replace('/', "`");
		if(from == '' || to == '')
		{
			if(from =='')
			{
				toastr.error("Please Enter From SlNo");
			}
			else if(to == '')
			{
				toastr.error("Please Enter To SlNo");
			}
			else
			{
				toastr.error("Please Enter From and To SlNo");
			}
		}
		else
		{
			window.open(base_url+"admin/excel_admitcard12/"+program_code_new+"/"+assigned_exam_center_code+"/"+exam_vanue_new+"/"+from+"/"+to+"/"+course,"winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
			//window.open("excel_admitcard1.php?program_code=<?php echo $sel_program?>&assigned_exam_center_code=<?php echo $sel_exam_center?>&assigned_exam_vanue=<?php echo $sel_exam_vanue?>&from="+from+"&to="+to+"&_s=<?=$MY_SESSION_NAME?>","winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
		}
		
	});
	$("#btnpdfl2").click(function(){
		var from = $("#txtFromSlNo").val();
		var to = $("#txtToSlNo").val();
		var program_code = $('#sel_program').val();
		var assigned_exam_center_code = $('#sel_exam_center').val();
		var exam_vanue = $('#sel_exam_vanue').val();
		var course = $('#sel_course').val();
		var exam_vanue_new = exam_vanue.replace('/', "_");
		var program_code_new = program_code.replace('/', "`");
		if(from == '' || to == '')
		{
			if(from =='')
			{
				toastr.error("Please Enter From SlNo");
			}
			else if(to == '')
			{
				toastr.error("Please Enter To SlNo");
			}
			else
			{
				toastr.error("Please Enter From and To SlNo");
			}
		}
		else
		{
			window.open(base_url+"admin/pdfreport12/"+program_code_new+"/"+assigned_exam_center_code+"/"+exam_vanue_new+"/"+from+"/"+to+"/"+course,"MsgWindow","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
			//window.open("admit_card.php?program_code=<?php echo $sel_program?>&assigned_exam_center_code=<?php echo $sel_exam_center?>&assigned_exam_vanue=<?php echo $sel_exam_vanue?>&from="+from+"&to="+to+"&_s=<?=$MY_SESSION_NAME?>","winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
		}
	});
	$("#btnExcel1").click(function(){
		var from = $("#txtFromSlNo").val();
		var to = $("#txtToSlNo").val();
		var program_code = $('#sel_program').val();
		var assigned_exam_center_code = $('#sel_exam_center').val();
		var exam_vanue = $('#sel_exam_vanue').val();
		if(from == '' || to == '')
		{
			if(from =='')
			{
				toastr.error("Please Enter From SlNo");
			}
			else if(to == '')
			{
				toastr.error("Please Enter To SlNo");
			}
			else
			{
				toastr.error("Please Enter From and To SlNo");
			}
		}
		else
		{
			window.open(base_url+"admin/excel_admitcard1/"+program_code_new+"/"+assigned_exam_center_code+"/"+exam_vanue+"/"+from+"/"+to,"winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
			//window.open("excel_admitcard1.php?program_code=<?php echo $sel_program?>&assigned_exam_center_code=<?php echo $sel_exam_center?>&assigned_exam_vanue=<?php echo $sel_exam_vanue?>&from="+from+"&to="+to+"&_s=<?=$MY_SESSION_NAME?>","winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
		}
		
	});
	$("#btnExcel2").click(function(){
		var from = $("#txtFromSlNo").val();
		var to = $("#txtToSlNo").val();
		var program_code = $('#sel_program').val();
		var assigned_exam_center_code = $('#sel_exam_center').val();
		var exam_vanue = $('#sel_exam_vanue').val();
		var program_code_new = program_code.replace('/', "`");
		if(from == '' || to == '')
		{
			if(from =='')
			{
				toastr.error("Please Enter From SlNo");
			}
			else if(to == '')
			{
				toastr.error("Please Enter To SlNo");
			}
			else
			{
				toastr.error("Please Enter From and To SlNo");
			}
		}
		else
		{
			window.open(base_url+"admin/excel_admitcard2/"+program_code_new+"/"+assigned_exam_center_code+"/"+exam_vanue+"/"+from+"/"+to,"winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
			//window.open("excel_admitcard2.php?program_code=<?php echo $sel_program?>&assigned_exam_center_code=<?php echo $sel_exam_center?>&assigned_exam_vanue=<?php echo $sel_exam_vanue?>&from="+from+"&to="+to+"&_s=<?=$MY_SESSION_NAME?>","winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
		}
	});
	$("#btnPrintAdmitCard").click(function(){
		var from = $("#txtFromSlNo").val();
		var to = $("#txtToSlNo").val();
		var program_code = $('#sel_program').val();
		var assigned_exam_center_code = $('#sel_exam_center').val();
		var exam_vanue = $('#sel_exam_vanue').val();
		var exam_vanue_new = exam_vanue.replace('/', "_");
		var program_code_new = program_code.replace('/', "`"); 
		if(from == '' || to == '')
		{
			if(from =='')
			{
				toastr.error("Please Enter From SlNo");
			}
			else if(to == '')
			{
				toastr.error("Please Enter To SlNo");
			}
			else
			{
				toastr.error("Please Enter From and To SlNo");
			}
		}
		else
		{ 
			window.open(base_url+"admin/admit_card/"+program_code_new+"/"+assigned_exam_center_code+"/"+exam_vanue_new+"/"+from+"/"+to,"winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
			//window.open("admit_card.php?program_code=<?php echo $sel_program?>&assigned_exam_center_code=<?php echo $sel_exam_center?>&assigned_exam_vanue=<?php echo $sel_exam_vanue?>&from="+from+"&to="+to+"&_s=<?=$MY_SESSION_NAME?>","winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
		}
	});
	$("#btnSaveAdmitCard").click(function(){
		$("#btnSaveAdmitCard").prop('disabled', true);
		$("#btnSaveAdmitCard").html('Saving...');
		var from = $("#txtFromSlNo").val(); 
		var to = $("#txtToSlNo").val();
		var url_data = {
			from_sl_no : from,
			to_sl_no : to,
			program_code: $('#sel_program').val(),
			assigned_exam_center_code: $('#sel_exam_center').val(),
			assigned_exam_vanue:$('#sel_exam_vanue').val()
		};
		$.ajax({
			url:base_url+"/ajax_controller/get_save_admit_card",
			type:"post",
			data:url_data,
			success:function(response){ 
				$("#btnSaveAdmitCard").prop('disabled', false);;
				$("#btnSaveAdmitCard").html('Save a Copy'); 
				if(response == 'SUCCESS')
				{
					toastr.success("Admit Cards saved in the system");
				}
				//alert("hello");		
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});	
	});
});