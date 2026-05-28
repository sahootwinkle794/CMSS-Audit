$(document).ready(function()
{
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
	$('.tooltips').tooltipster( {
     	theme: 'tooltipster-punk',
  		animation: 'grow',
    	delay: 200, 
     	touchDevices: false,
     	trigger: 'hover'
	});  
	$('#btnFilter').click(function()
	{
		$("#tableCReport").hide();
		$("#tableSWReport").hide();
		$("#tableCCReport").hide();
		$("#tableSWCReport").hide();
		$("#alert2").hide();
		if($("#cmbProgramGroup").val() == '')
		{
			toastr.error("Please select recruitment drive");
		}
		else if($("#cmbProgram").val() == '')
		{
			toastr.error("Please select post");
		}
		else if($("#cmbRound").val() == '')
		{
			toastr.error("Please select round");
		}
		else if($("#cmbExcel").val() == '')
		{
			toastr.error("Please select excel type");
		}
		else if($("#cmbExcel").val() == 'report_c')
		{
			$("#tableCReport").show();
			$("#tableSWReport").hide();
			$("#tableCCReport").hide();
			$("#tableSWCReport").hide();
			$("#alert2").hide();
			var institutedata = {
				program:$('#cmbProgram').val()
			};
			var dtblReportC = $('#dtblReportC').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/getConsolidatedReport",
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
		                       { "sName": "applicant_name","sWidth": "50%" },
		                       { "sName": "roll_no","sWidth": "15%" },
		                       { "sName": "total_marks","sWidth": "15%"},
		                       { "sName": "rank","sWidth": "10%","sClass": "alignCenter"}
		        ],
				buttons: [{
								extend: 'excelHtml5',
								text: '<button class="btn btn-success tooltipTable" title = "Export"><i class="fa fa-file-excel-o" style="color:white"></i> Export to Excel</button>',
								filename:'Consolidated Report',
								header:true,
								title:'Consolidated Report',
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
		else if($("#cmbExcel").val() == 'report_sw')
		{
			$("#tableCReport").hide();
			$("#tableSWReport").show();
			$("#tableCCReport").hide();
			$("#tableSWCReport").hide();
			$("#alert2").hide();
			var postData = {
				program:$('#cmbProgram').val()
			};
			$.ajax({
				url:base_url+"/ajax_controller/getSWReportHeader",
			    type:"post",
			    data:postData,
			    success:function(response)
			    {   
					var res1 = JSON.parse(response);
					var subject_names = res1.subject_names;
					if(subject_names != '')
					{
						var options = '';
						options = options + "<th class='text-center' style='vertical-align:middle;'>#</th><th class='text-center' style='vertical-align:middle;'>Name</th><th class='text-center' style='vertical-align:middle;'>Roll No</th>";		
						var subject_names = res1.subject_names;
						var subjects = subject_names.split(':');
						for(i in subjects)
						{
							options = options + "<th class='text-center' style='vertical-align:middle;'>" + subjects[i] + "</th>";
						}
						$('#tableSWReport').html("");
						options = options + "<th class='text-center' style='vertical-align:middle;'> Total </th><th class='text-center' style='vertical-align:middle;'> Rank </th>";	
						$("#tableSWReport").append('<table id="dtblReportSW" class="table table-striped table-bordered" width="100%" height="50%" style="white-space:nowrap;overflow-y:auto;"><thead><tr>' + options + '</tr></thead><tbody></tbody></table>');	
						var dtblReportSW = $('#dtblReportSW').dataTable({
							"ajax":
							{
								"url": base_url+"/ajax_controller/getSWReport",
								"type": "post",
								"data": postData
							},
							"bPaginate": true,
					        "bLengthChange": true,
							"bStateSave": true,
					        "bFilter": true,
					        "bSort": true,
					        "bInfo": true,
					        "bAutoWidth":true,    
					        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6 ' >>><'col-xs-6'p>>",
					        buttons: [{
								extend: 'excelHtml5',
								text: '<button class="btn btn-success" title = "Export"><i class="fa fa-file-excel-o" style="color:white"></i> Export to Excel</button>',
								filename:'Subject Wise Report',
								header:true,
								title:'Subject Wise Report',
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
					else
					{
						$("#tableCReport").hide();
						$("#tableSWReport").hide();
						$("#tableCCReport").hide();
						$("#tableSWCReport").hide();
						$("#alert2").show();
						$("#alertmessageDanger").html("No data available");
					}
					
				},			                            					
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}		
			});
		}
		else if($("#cmbExcel").val() == 'report_cc')
		{
			$("#tableCReport").hide();
			$("#tableSWReport").hide();
			$("#tableCCReport").show();
			$("#tableSWCReport").hide();
			$("#alert2").hide();
			var institutedata = {
				program:$('#cmbProgram').val()
			};
			var dtblReportC = $('#dtblReportCC').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/getConsolidatedCountReport",
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
		                       { "sName": "applicant_name","sWidth": "30%" },
		                       { "sName": "roll_no","sWidth": "10%" },
		                       { "sName": "right_count","sWidth": "10%" },
		                       { "sName": "wrong_count","sWidth": "10%" },
		                       { "sName": "blank_count","sWidth": "10%" },
		                       { "sName": "total_marks","sWidth": "10%"},
		                       { "sName": "rank","sWidth": "10%"}
		        ],
				buttons: [{
								extend: 'excelHtml5',
								text: '<button class="btn btn-success tooltipTable" title = "Export"><i class="fa fa-file-excel-o" style="color:white"></i> Export to Excel</button>',
								filename:'Consolidated with Count Report',
								header:true,
								title:'Consolidated with Count Report',
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
		else if($("#cmbExcel").val() == 'report_swc')
		{
			$("#tableCReport").hide();
			$("#tableSWReport").hide();
			$("#tableCCReport").hide();
			$("#tableSWCReport").show();
			$("#alert2").hide();
			var postData = {
				program:$('#cmbProgram').val()
			};
			$.ajax({
				url:base_url+"/ajax_controller/getSWReportHeader",
			    type:"post",
			    data:postData,
			    success:function(response)
			    {   
					var res1 = JSON.parse(response);
					var subject_names = res1.subject_names;
					if(subject_names != ''){
						var optionss = '';
						var options = '';
						options = options + "<th class='text-center' style='vertical-align:middle;' rowspan='2'>#</th><th class='text-center' style='vertical-align:middle;' rowspan='2'>Name</th><th class='text-center' style='vertical-align:middle;' rowspan='2'>Roll No</th>";		
						var subjects = subject_names.split(':');
						for(i in subjects)
						{
							options = options + "<th class='text-center' style='vertical-align:middle;' colspan='4'>" + subjects[i] + "</th>";
							optionss = optionss + "<th class='text-center' style='vertical-align:middle;'> R </th><th class='text-center' style='vertical-align:middle;'> W </th><th class='text-center' style='vertical-align:middle;'> B </th><th class='text-center' style='vertical-align:middle;'> Marks </th>";	
						}
						options = options + "<th class='text-center' style='vertical-align:middle;' rowspan='2'>Total</th><th class='text-center' style='vertical-align:middle;' rowspan='2'>Rank</th>";		
						$('#tableSWCReport').html("");
						$("#tableSWCReport").append('<table id="dtblReportSWC" class="table table-striped table-bordered" width="100%" height="50%" style="white-space:nowrap;overflow-y:auto;"><thead><tr>' + options + '</tr><tr>'+optionss+'</tr></thead><tbody></tbody></table>');	
						var dtblReportSWC = $('#dtblReportSWC').dataTable({
							"ajax":
							{
								"url": base_url+"/ajax_controller/getSWCReport",
								"type": "post",
								"data": postData
							},
							"bPaginate": true,
					        "bLengthChange": true,
							"bStateSave": true,
					        "bFilter": true,
					        "bSort": true,
					        "bInfo": true,
					        "bAutoWidth":true,    
					        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6 ' >>><'col-xs-6'p>>",
					        buttons: [{
								extend: 'excelHtml5',
								text: '<button class="btn btn-success" title = "Export"><i class="fa fa-file-excel-o" style="color:white"></i> Export to Excel</button>',
								filename:'Subject Wise With Count Report',
								header:true,
								title:'Subject Wise With Count Report',
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
					else
					{
						$("#tableCReport").hide();
						$("#tableSWReport").hide();
						$("#tableCCReport").hide();
						$("#tableSWCReport").hide();
						$("#alert2").show();
						$("#alertmessageDanger").html("No data available");
					}
					
				},			                            					
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}		
			});
		}
	});

	$('#btnExcelDownload').click(function()
	{
		$("#tableCReport").hide();
		$("#tableSWReport").hide();
		$("#tableCCReport").hide();
		$("#tableSWCReport").hide();
		$("#alert2").hide();
		var program = $("#cmbProgram").val();
		if($("#cmbProgramGroup").val() == '')
		{
			toastr.error("Please select recruitment drive");
		}
		else if($("#cmbProgram").val() == '')
		{
			toastr.error("Please select post");
		}
		else if($("#cmbRound").val() == '')
		{
			toastr.error("Please select round");
		}
		else if($("#cmbExcel").val() == '')
		{
			toastr.error("Please select excel type");
		}
		else if($("#cmbExcel").val() == 'report_c')
		{
			window.open(base_url+"admin/consolidated_report/"+program,"Consolidated Report","left=0,top=0,width=1024,height=700,target=_blank, scrollbars=1,menubar=0,status=0,toolbar=0").focus();
		}
		else if($("#cmbExcel").val() == 'report_sw')
		{
			window.open(base_url+"admin/subjectWise_report/"+program,"Subject Wise Report","left=0,top=0,width=1024,height=700,target=_blank, scrollbars=1,menubar=0,status=0,toolbar=0").focus();
		}
		else if($("#cmbExcel").val() == 'report_cc')
		{
			window.open(base_url+"admin/consolidatedCount_report/"+program,"Consolidated With Count Report","left=0,top=0,width=1024,height=700,target=_blank, scrollbars=1,menubar=0,status=0,toolbar=0").focus();
		}
		else if($("#cmbExcel").val() == 'report_swc')
		{
			window.open(base_url+"admin/subjectWiseCount_report/"+program,"Subject Wise With Count Report","left=0,top=0,width=1024,height=700,target=_blank, scrollbars=1,menubar=0,status=0,toolbar=0").focus();
		}
	});
});