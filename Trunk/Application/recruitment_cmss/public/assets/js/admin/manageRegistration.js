$(document).ready(function()
{
	var isDelete= false;
	var isEdit = false;
	var session = $("#hidSession").val();
	
	
	var oTable;
	var dtblApplicationDetailTable = $('#dtblApplicationDetail').dataTable({
		
		//"sAjaxSource": base_url+"/ajax_controller/select_applns",
		
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "sDom":"<'row'<'col-xs-5'i><'col-xs-3'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7' >>><'col-xs-6'p>>",
        //"sDom":"<'row'<'col-xs-4'l><'col-xs-4'i><'col-xs-4'f>r>t <'row'<'col-xs-6' B><'col-xs-6'p>>",
		"aoColumns": [
	                   { "sName": "sl_no","sWidth": "1%" },
                       { "sName": "name","sWidth": "15%" },
                       { "sName": "mobile","sClass": "alignRight","sWidth": "10%"},
				       { "sName": "email_id","sWidth": "10%"},
				       { "sName": "dob","sWidth": "20%"},
                       /*{ "sName": "state","sWidth": "20%"}*/
					   
        ],
		buttons: [{
						extend: 'excelHtml5',
						text: '<button class="btn btn-success" title = "Export"><i class="fa fa-file-excel-o" style="color:white"></i> Export to Excel</button>',
						filename:'Manage Registration',
						header:true,
						title:'Manage Registration',
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
	
	table_load();
	
	
	$('#cmbProgramGroup,input[name=radioProgramType]').change(function()
	{
		var program_group = $("#cmbProgramGroup").val();
		var program_type = $("input[name=radioProgramType]:checked").val();
		/*if(program_group != '' && program_type != '')
		{*/
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
					var opt = "<option value =''>Select Program</option>";
					if(options == ''){
						$('#cmbProgram').html("");   //campusid from academicPeriod
						$('#cmbProgram').append(opt);   
						var program = $("#cmbProgram").val();
						var program_group = $("#cmbProgramGroup").val();
						var program_type = $("input[name=radioProgramType]:checked").val();
						load_table(program,program_group,program_type)	
					}
					else{
						$('#cmbProgram').html("");   
						$('#cmbProgram').append(options);	
						var program = $("#cmbProgram").val();
						var program_group = $("#cmbProgramGroup").val();
						var program_type = $("input[name=radioProgramType]:checked").val();
						/*if(program !='' || program != null && program_group !='' || program_group != null )
						{*/
							load_table(program,program_group,program_type)	
						//}
					}
					
				},
				error:function()
				{
					alert("We are unable to Process.Please contact Support");
				}
			});
		//}
	});
	
	$("#cmbProgram").change(function()
	{
		var program = $("#cmbProgram").val();
		var program_group = $("#cmbProgramGroup").val();
		var program_type = $("input[name=radioProgramType]:checked").val();
		load_table(program,program_group,program_type);		
	});
	
	$("#cmbStatus").change(function()
	{
		if($("#cmbStatus").val() == 'only_registered'){
			$("#cmbProgram").hide();
			$("#cmbProgramGroup").hide();
			$("#cmbPrograml").hide();
			$("#cmbProgramGroupl").hide();
		}
		else{
			$("#cmbProgram").show();
			$("#cmbProgramGroup").show();
			$("#cmbPrograml").show();
			$("#cmbProgramGroupl").show();
		}
	});
	
	$("#btnFilter").click(function()
	{
		var program = $("#cmbProgram").val();
		var program_group = $("#cmbProgramGroup").val();
		var program_type = $("input[name=radioProgramType]:checked").val();
		var appl_status = $("#cmbStatus").val();
		var reg_user_id = $("#txtMobileNo").val();
		var payment_mode = $("#cmbPayment").val();
		var payment_date = $("#txtPaymentDate").val();
		//if($("#cmbStatus").val() != 'only_registered'){
			
			if((program =='' || program ==null) && $("#cmbStatus").val() != 'only_registered')
			{
				toastr.error("Please Select a Program");
			}
			else if((program_group =='' || program_group ==null) && $("#cmbStatus").val() != 'only_registered' )
			{
				toastr.error("Please Select a Program Group");
			}
			else
			{
				var data = {
					program:program,
					program_group:program_group,
					program_type:program_type,
					appl_status:appl_status,
					reg_user_id:reg_user_id,
					payment_mode:payment_mode,
					payment_date:payment_date,
					_s:session
				};
				$.ajax({
					url: base_url+"/ajax_controller/select_applns",
					type:"post",
					data:data,
					success:function(response)
					{  
						data = jQuery.parseJSON(response);
						dtblApplicationDetailTable.fnClearTable();
						if (data.aaData.length)
						dtblApplicationDetailTable.fnAddData(data.aaData);
						dtblApplicationDetailTable.fnDraw();		
					},
					error:function()
					{
						toastr.error("We are unable to Process.Please contact Support");
					}
				});
				
			}
		//}
	});
	
	$("#txtPaymentDate").datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
		endDate:"+0d"
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

function table_load(){
	
	$.ajax({
		url:base_url+"/ajax_controller/select_registrations",
		type:"POST",
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
function load_table(program,program_group,program_type)
{
	var data = {
		program:program,
		program_group:program_group,
		program_type:program_type
	};
	$.ajax({
		url:base_url+"/ajax_controller/select_applns",
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
    var appl_status = oTable.fnGetData( row )[3];//GETTING Applicant Mobile No.
    var appl_no = oTable.fnGetData( row )[7];//GETTING Applicant Mobile No.
    var program_code = oTable.fnGetData( row )['program_code'];//GETTING Applicant Mobile No.
    
   
    //alert(program_code); 
    
	if(appl_status =='')
	{
		var mode = 'new';
	}
	else
	{
		var mode = 'edit';
	}
	var program = $("#cmbProgram").val();
	var program_group = $("#cmbProgramGroup").val();
	var program_type = $("input[name=radioProgramType]:checked").val();
	var program = program;
	
	if(program == ''){
		program = program_code
	}
	
	/*if(action == 'print')
	{
		window.open(base_url+"admin/download_application/"+reg_user_id+"/"+program);
		//window.open(base_url+"mpdf_controller/template008_pdf/reg_user_id/"+data.file_name);
		//window.open("../../PDF/download_application.php?reg_user_id="+reg_user_id+"&admcode="+program+"&_s="+session);
	}*/
	if(action == 'print')
	{

		var institutedata={
			program : program,
			reg_user_id : reg_user_id,
			mode : mode,
		};
		//alert(institutedata.program);
		$.ajax({
			url:base_url+"/ajax_controller/edit_manage_appns",
			type:"post",
			data:institutedata,
			success:function(response)
			{  
				var res1 = JSON.parse(response);
				//alert(res1.file_name);
				var file_name = res1.file_name+"_pdf";
				window.open(base_url+"mpdf_controller/"+file_name+"/reg_user_id/"+res1.file_name+"/program/"+program);
				/*$.each(res1.aaData,function(i,data)
				{
					//alert(res1.file_name);
					window.open(base_url+"mpdf_controller/template001_pdf/reg_user_id/"+data.file_name+"/program/"+program);
				});	*/
			},
			error:function()
			{
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	}
	else if(action == 'edit')
	{
		var institutedata={
			program : program,
			reg_user_id : reg_user_id,
			mode : mode
		};
		
		$.ajax({
			url:base_url+"/ajax_controller/edit_manage_appns",
			type:"post",
			data:institutedata,
			success:function(response)
			{  
				var data = JSON.parse(response);
				if(data.file_name == 'No Program Selected')
				{
					toastr.error("No Data Available");
				}
				else{
					window.open("../Admin_apply/"+data.file_name+"/reg_user_id/"+reg_user_id);
				}
				/*$.each(res1.aaData,function(i,data)
				{
					//alert(data.file_name);
					if(data.file_name == 'No Program Selected')
					{
						toastr.error("No Data Available");
					}
					else{
						window.open("../Admin_apply/"+data.file_name+"/reg_user_id/"+reg_user_id);
					}
				});	*/
			},
			error:function()
			{
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	}
}