$(document).ready(function()
{
	var isDelete= false;
	var isEdit = false;
	var session = $("#hidSession").val();
	
	$("#btnPublishResult").hide();
	$("#btnAddCodeGroup").hide();
	$("#btnUploadReport").hide();
	$("#bulk").hide();
	$.ajax({
		url:base_url+"ajax_controller/select_program_data_manage_app", 
		type:"post",
		success:function(response)
		{  
			var options = "<option value=''>Select</option>";					
			var res1 = JSON.parse(response);					
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value='"+data.program_group_code+"'>"+data.program_group_name+"</option>";
			});
			$('#cmbProgramGroup').html("");   
			$('#cmbProgramGroup').append(options);
		},
		error:function()
		{
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$('#cmbProgramGroup').change(function()
	{
		var program_group = $("#cmbProgramGroup").val();
		/*if(program_group != '' && program_type != '')
		{*/
			var institutedata = {
				program_group:program_group,
			};
			$.ajax({
				url:base_url+"/ajax_controller/select_program_manage_app",
				type:"post",
				data:institutedata,
				success:function(response)
				{  
					var options = "<option value =''>Select Post</option>";					
					var res1 = JSON.parse(response);					
					$.each(res1.aaData,function(i,data)
					{
						options = options + "<option value="+data.program_code+">"+data.program_name+"</option>";
					});
					$('#cmbProgram').html("");  
					$('#cmbProgram').append(options);   
					
				},
				error:function()
				{
					alert("We are unable to Process.Please contact Support");
				}
			});
		//}
	});
	$('#cmbProgram').change(function()
	{
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
	});
	$('#btnFilter').click(function()
	{
		
		
		if($('#cmbProgram').val() == '' || $('#cmbProgram').val() == null)
		{
			toastr.error("Please Select Post");
		}
		else if($('#cmbRound').val() == '' || $('#cmbRound').val() == null)
		{
			toastr.error("Please Select Round");
		}
		else
		{
			$("#txtFromSlNo").val("");
			$("#txtToSlNo").val("");
			$("#bulk").show();
			var prog_code = $('#cmbProgram').val();
			var institutedata = {
				program:$('#cmbProgram').val(),
				round_data:$('#cmbRound').val()
			};
			var dtblApplicationDetailTable = $('#dtblApplicationDetail').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/select_meritDetails",
					"type": "POST",
					"data": institutedata
				}, 
				"bPaginate": true,
		        "bLengthChange": true,
		        "bFilter": true,
		        "bSort": true,
		        "bInfo": true,
		        "bAutoWidth": false,
		        "bDestroy": true,
		        
				"sDom":"<'row'<'col-xs-4' i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-5' >>><'col-xs-3'p>>",
				"aoColumns": [
			                   { "sName": "sl_no","sWidth": "1%" },
		                       { "sName": "applicant_name","sWidth": "15%" },
		                       { "sName": "applicant_id","sWidth": "15%" ,"mRender": function( data, type, full ) {
			                    	var roll_no = data;
			                    	return roll_no+'<input type="hidden" class= "form-control" name="hidRollNo[]" value="'+roll_no+'">';
			               		} },
		                       { "sName": "appl_no","sWidth": "55%","mRender": function( data, type, full ) {
			                    	var appl_no = data;
			                    	return appl_no+'<input type="hidden" class= "form-control" name="hidApplNo[]" value="'+appl_no+'">';
			               		} },
			               		 { "sName": "mark","sWidth": "10%","mRender": function( data, type, full ) {
			                    	var mark = data;
			                    	return mark+'<input type="hidden" class= "form-control" name="hidmark[]" value="'+mark+'">';
			               		} },
			               		{ "sName": "view","sWidth": "10%","data":null,"mRender": function( data, type, full ) {
			               			
			               			 var appl_no = full['appl_no'];
			               			var round1_no = full['round_no'];
			               			
			                    	return '<button type="button" name="previewId" class="btn btn-success btn-circle tooltipTable" title="View"  onclick=\'pdfopen("'+appl_no+'","'+round1_no+'","'+prog_code+'")\' ><i class="fa fa-eye"></i></button>';
			                    	
			               		} }
		        ],
				buttons: [{
								extend: 'excelHtml5',
								text: '<button class="btn btn-success" title = "Export"><i class="fa fa-file-excel-o" style="color:white"></i> Export to Excel</button>',
								filename:'Results',
								header:true,
								title:'Results',
						}],

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
		
		
		
	});
	
	$('#btnUploadReport').click(function(){
		//alert("hello");
		if($('#cmbProgram').val() == '' || $('#cmbProgram').val() == null)
		{
			toastr.error("Please Select Post");
		}
		else if($('#cmbRound').val() == '' || $('#cmbRound').val() == null)
		{
			toastr.error("Please Select Round");
		}
		else
		{
			w = window.open(base_url+"admin/upload_excel_result/"+$('#cmbProgram').val()+"/"+$('#cmbRound').val(),"winreport","status=0, menubar=0, scrollbars=1, resizable=1, width=980, height=600");
			w.focus();
		}
	});
	var oTable;
	var institutedata = {
		program:$('#cmbProgram').val(),
		program_group:$('#cmbProgramGroup').val(),
	};
	var dtblApplicationDetailTable = $('#dtblApplicationDetail').dataTable({
		
		//"sAjaxSource": base_url+"/ajax_controller/select_applns",
		/*"ajax":
		{
			"url": base_url+"/ajax_controller/select_resultDetails",
			"type": "POST",
			"data": institutedata
		}, */
			"bPaginate": true,
		        "bLengthChange": true,
		        "bFilter": true,
		        "bSort": true,
		        "bInfo": true,
		        "bAutoWidth": false,
		        "bDestroy": true,
		        
				"sDom":"<'row'<'col-xs-4' i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-5' >>><'col-xs-3'p>>",
				"aoColumns": [
			                   { "sName": "sl_no","sWidth": "1%" },
		                       { "sName": "applicant_name","sWidth": "15%" },
		                       { "sName": "applicant_id","sWidth": "15%" ,"mRender": function( data, type, full ) {
			                    	var roll_no = data;
			                    	return roll_no+'<input type="hidden" class= "form-control" name="hidRollNo[]" value="'+roll_no+'">';
			               		} },
		                       { "sName": "appl_no","sWidth": "55%","mRender": function( data, type, full ) {
			                    	var appl_no = data;
			                    	return appl_no+'<input type="hidden" class= "form-control" name="hidApplNo[]" value="'+appl_no+'">';
			               		} },
			               		 { "sName": "mark","sWidth": "10%","mRender": function( data, type, full ) {
			                    	var mark = data;
			                    	return mark+'<input type="hidden" class= "form-control" name="hidmark[]" value="'+mark+'">';
			               		} },
			               		{ "sName": "view","sWidth": "10%","mRender": function( data, type, full ) {
			               			var appl_no = full['appl_no'];
			                    	return '<button type="button" name="previewId" class="btn btn-success btn-circle tooltipTable" title="View" onclick=\'pdfopen("'+appl_no+'","'+round1_no+'")\'><i class="fa fa-eye"></i></button>';
			                    	
			               		} },
	               		/*{ "sName": "value","sClass":"alignCenter","sWidth": "15%","mRender": function( data, type, full ) {
						   		var field_status = data;
						   		//var desc_list = field_status[0].split(',');
						   		var desc_list = [
									    "Select Result",
									    "Selected",
									    "Not Selected"
									];
									var code_list = [
									    "",
									    "Selected",
									    "Not Selected"
									];
		                    	var str = '<select class="form-control tooltips" name="cmbStatus[]">';
	                    		for(var i=0; i<desc_list.length; i++)
	                    		{
									if(code_list[i] == field_status){
										str += '<option value="'+code_list[i]+'" selected>'+desc_list[i]+'</option>';
									}
									else{
										str += '<option value="'+code_list[i]+'">'+desc_list[i]+'</option>';
									}
								}
	                    		str += '</select>';
	                    		return str;
	               			} 
	               		}*/
        ],
		buttons: [{
						extend: 'excelHtml5',
						text: '<button class="btn btn-success" title = "Export"><i class="fa fa-file-excel-o" style="color:white"></i> Export to Excel</button>',
						filename:'Results',
						header:true,
						title:'Results',
				}],

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
	/*$("div.addbuttonCode").html("<button id='btnAddCodeGroup' class='btn btn-info btn-circle tooltips' title='Add Center'><i class='fa fa-plus'></i></button>");	*/
	$("#btnBulkdownload").click(function(){
		var from = $("#txtFromSlNo").val();
		var to = $("#txtToSlNo").val();
		var program_code = $('#cmbProgram').val();
		var round_no = $('#cmbRound').val();
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
			window.open(base_url+"Mpdf_controller/merit_list_bulk_pdf/"+program_code+"/"+round_no+"/"+from+"/"+to,"winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
			//window.open("admit_card.php?program_code=<?php echo $sel_program?>&assigned_exam_center_code=<?php echo $sel_exam_center?>&assigned_exam_vanue=<?php echo $sel_exam_vanue?>&from="+from+"&to="+to+"&_s=<?=$MY_SESSION_NAME?>","winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
		}
	});
    $('.tooltips').tooltipster({
		theme: 'tooltipster-punk',
		animation: 'grow',
        delay: 200, 
        touchDevices: false,
        trigger: 'hover'
    });	
    /* CODE FOR TOASTR */
	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "progressBar": false,
	  "positionClass": "toast-bottom-right",//top-right,bottom-left,top-left,top-full-width,bottom-full-width,top-center,bottom-center
	  "onclick": null,
	  "showDuration": "20000",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	} 
});
function pdfopen(appl_no,round1_no,program_code)
{
	//alert(appl_no);return;
	
	window.open(base_url+"Mpdf_controller/merit_list_pdf/"+round1_no+"/"+appl_no+"/"+program_code);
}
function program(){
	var program_group = $("#cmbProgramGroup").val();
	var program_type = $("input[name=radioProgramType]:checked").val();
		
	var institutedata = {
		program_type:program_type,
		program_group:program_group,
	};
	$.ajax({
		url:base_url+"/ajax_controller/select_program_manage_app",
		type:"post",
		data:institutedata,
		success:function(response)
		{  
			var options = "<option value =''>Select Program</option>";					
			var res1 = JSON.parse(response);					
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value="+data.program_code+">"+data.program_name+"</option>";
			});
			$('#cmbProgram').html("");   
			$('#cmbProgram').append(options);
		},
		error:function()
		{
			alert("We are unable to Process.Please contact Support");
		}
	});
}
/*function load_table(program,program_group)
{
	var data = {
		program:program,
		program_group:program_group
	};
	$.ajax({
		url:base_url+"/ajax_controller/select_dms_applns",
		type:"POST",
		data:data,
		success:function(response)
		{  				
			var res1 = JSON.parse(response);					
			var table = $('#dtblApplicationDetail').DataTable();
			table.clear().draw();
			table.rows.add(res1.aaData).draw();	
		},
		error:function()
		{
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
}


function rowApplication(event,action)
{
	var session = $("#hidSession").val();
	var oTable = $('#dtblApplicationDetail').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});		
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I" || event.target.tagName == "SPAN")
		row = event.target.parentNode.parentNode.parentNode;
	var record_id = oTable.fnGetData( row )[0];
    var reg_user_id = oTable.fnGetData( row )[2];//GETTING Applicant Mobile No.
    var appl_no = oTable.fnGetData( row )[3];//GETTING Applicant Mobile No.
    var ins_code = oTable.fnGetData( row )[4];//GETTING Applicant Mobile No.
    //var appl_no = oTable.fnGetData( row )[7];//GETTING Applicant Mobile No.
    //var program_code = oTable.fnGetData( row )['program_code'];//GETTING Applicant Mobile No.
    
    
   
    
}*/