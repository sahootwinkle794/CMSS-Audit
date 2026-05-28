$(document).ready(function()
{
	var isDelete= false;
	var isEdit = false;
	var session = $("#hidSession").val();
	$(document).ajaxSend(function(){
	    $('.loadingRPimage').fadeIn(250);
	});
	$(document).ajaxComplete(function(){
	    $('.loadingRPimage').fadeOut(250);
	});
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
	var oTable;
	var dtblApplicationDetailTable = $('#dtblApplicationDetail').dataTable({
		
		//"sAjaxSource": base_url+"/ajax_controller/select_applns",
		
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
       /* "processing": true,
        "serverSide": true,*/
        "bInfo": true,
        "bAutoWidth": false,
        "bDestroy": true,
        "scrollX": true,
        "scrollCollapse": true,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-5' B>>><'col-xs-3'p>>",
		"aoColumns": [
	                   { "sName": "sl_no","sWidth": "5%"},
                       { "sName": "name","sWidth": "15%"},
                       { "sName": "mobile","sClass": "alignRight","sWidth": "10%"},
				       { "sName": "email_id","sWidth": "10%"},
				       { "sName": "program_name","sWidth": "10%"},
                       { "sName": "status","sWidth": "10%"},
					   { "sName": "payment","sWidth": "10%"},
					   { "sName": "Application Date","sWidth": "10%"},
					   { "sName": "Print","sWidth": "10%","sClass": "alignCenter","sWidth": "10%","mRender": function( data, type, full ) { 
					           if(data == 'YES')
					           {
						         return '<button class="btn btn-success tooltipTable btn-circle" title="Print" onclick="rowApplication(event,\'print\')"><i class="fa fa-print" aria-hidden="true"></i></button>';
						       }
						       else
						       {
						         return '';
						       }
						    }
						},
					   { "sName": "Application Date","sWidth": "5%","bVisible": false},
					   {"sName": "default","sWidth": "5%","data":null,"sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='rowApplication(event,\"edit\")' title='Next' ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
       ],
		buttons: [{
						extend: 'excelHtml5',
						text: '<button class="btn btn-success" title = "Export"><i class="fa fa-file-excel-o" style="color:white"></i> Export to Excel</button>',
						filename:'Manage Application',
						header:true,
						title:'Manage Application',
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
	
	program();
	
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
					var options = "<option value =''>Select Post</option>";					
					var res1 = JSON.parse(response);					
					$.each(res1.aaData,function(i,data)
					{
						options = options + "<option value="+data.program_code+">"+data.program_name+"</option>";
					});
					var opt = "<option value =''>Select Post</option>";
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
			
			if((program_group =='' || program_group ==null) && $("#cmbStatus").val() != 'only_registered' )
			{
				toastr.error("Please Select a Recruitment Drive");
			}
			else if((program =='' || program ==null) && $("#cmbStatus").val() != 'only_registered')
			{
				toastr.error("Please Select a Post");
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
				var dtblApplicationDetailTable = $('#dtblApplicationDetail').dataTable({
					"ajax":
					{
						"url": base_url+"/ajax_controller/select_applns",
						"type": "POST",
						"data": data
					},
					//"sAjaxSource": base_url+"/ajax_controller/select_applns",
					
					"bPaginate": true,
			        "bLengthChange": true,
			        "bFilter": true,
			        "bSort": true,
			        "processing": true,
			        "serverSide": true,
			        "bInfo": true,
			        "bAutoWidth": false,
			        "bDestroy": true,
			        "scrollX": true,
			        "scrollCollapse": true,
        
					"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-5' B>>><'col-xs-3'p>>",
					"aoColumns": [
				                   { "sName": "sl_no","sWidth": "5%"},
			                       { "sName": "name","sWidth": "15%"},
			                       { "sName": "mobile","sClass": "alignRight","sWidth": "10%"},
							       { "sName": "email_id","sWidth": "10%"},
							       { "sName": "program_name","sWidth": "10%"},
			                       { "sName": "status","sWidth": "10%"},
								   { "sName": "payment","sWidth": "10%"},
								   { "sName": "Application Date","sWidth": "10%"},
								   { "sName": "Print","sWidth": "10%","sClass": "alignCenter","sWidth": "10%","mRender": function( data, type, full ) { 
								           if(data == 'YES')
								           {
									         return '<button class="btn btn-success tooltipTable btn-circle" title="Print" onclick="rowApplication(event,\'print\')"><i class="fa fa-print" aria-hidden="true"></i></button>';
									       }
									       else
									       {
									         return '';
									       }
									    }
									},
								   { "sName": "Application Date","sWidth": "5%","bVisible": false},
								   {"sName": "default","sWidth": "5%","data":null,"sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='rowApplication(event,\"edit\")' title='Next' ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
			       ],
					buttons: [{
									extend: 'excelHtml5',
									text: '<button class="btn btn-success" title = "Export"><i class="fa fa-file-excel-o" style="color:white"></i> Export to Excel</button>',
									filename:'Manage Application',
									header:true,
									title:'Manage Application',
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
				/*$.ajax({
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
				});*/
				
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
}
function table_load(){
	var program = $("#cmbProgram").val();
	var program_group = $("#cmbProgramGroup").val();
	var program_type = $("input[name=radioProgramType]:checked").val();
	
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

function getAge(dateString) {
  var now = new Date("2021/09/30");
  var today = new Date(now.getYear(),now.getMonth(),now.getDate());

  var yearNow = now.getYear();
  var monthNow = now.getMonth();
  var dateNow = now.getDate();

  var dob = new Date(dateString.substring(6,10),
                     dateString.substring(0,2)-1,                   
                     dateString.substring(3,5)                  
                     );

  var yearDob = dob.getYear();
  var monthDob = dob.getMonth();
  var dateDob = dob.getDate();
  var age = {};
  var ageString = "";
  var yearString = "";
  var monthString = "";
  var dayString = "";


  yearAge = yearNow - yearDob;

  if (monthNow >= monthDob)
    var monthAge = monthNow - monthDob;
  else {
    yearAge--;
    var monthAge = 12 + monthNow -monthDob;
  }

  if (dateNow >= dateDob)
    var dateAge = dateNow - dateDob;
  else {
    monthAge--;
    var dateAge = 31 + dateNow - dateDob;

    if (monthAge < 0) {
      monthAge = 11;
      yearAge--;
    }
  }

  age = {
      years: yearAge,
      months: monthAge,
      days: dateAge
      };

  if ( age.years > 1 ) yearString = " years";
  else yearString = " year";
  if ( age.months> 1 ) monthString = " months";
  else monthString = " month";
  if ( age.days > 1 ) dayString = " days";
  else dayString = " day";


  if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.years + yearString + ", " + age.months + monthString + ", and " + age.days + dayString + " old.";
  else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
    ageString = "Only " + age.days + dayString + " old!";
  else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
    ageString = age.years + yearString + " old";
  else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.years + yearString + " and " + age.months + monthString + " old.";
  else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.months + monthString + " and " + age.days + dayString + " old.";
  else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
    ageString = age.years + yearString + " and " + age.days + dayString + " old.";
  else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.months + monthString + " old.";
  else ageString = "Oops! Could not calculate age!";

  return ageString;
}
function load_table(program,program_group,program_type)
{
	var data = {
		program:program,
		program_group:program_group,
		program_type:program_type
	};
	var excel_data = {
		program:program,
		program_group:program_group,
		program_type:program_type,
		page : "ALL"
	};
		jQuery.fn.DataTable.Api.register( 'buttons.exportData()', function ( options ) { 
            if ( this.context.length ) {
            	var dataArr = [];
                var jsonResult = $.ajax({
                	url:base_url+"/ajax_controller/select_applns_report",
					type:"POST",
					data:excel_data,
                    success: function (result) {
                        res = jQuery.parseJSON(result);
                        $.each(res.aaData,function(i,arr){
                        	var agecalfrom = arr.dob;
                        	var agecalto = getAge(agecalfrom);
                        	var objArr = [i+1,arr.full_name,arr.father_name,arr.address,arr.mobileno,arr.email_id,arr.category,arr.dob,agecalto,arr.qualification,arr.work_experience,arr.updated_on];
                        	dataArr.push(objArr);
                        });
                    },
                    async: false
                });
				//console.log(dataArr);
                return {body: dataArr, header: ['SL NO','NAME','FATHER NAME','ADDRESS','MOBILE NO','EMAIL ID','CATEGORY','DOB','AGE AS ON CUTOFF DATE','QUALIFICATION','WORK EXPERIENCE','DATE OF APPLICATION','REMARK']};
            }
        } );
        
	var dtblApplicationDetailTable = $('#dtblApplicationDetail').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/select_applns",
			"type": "POST",
			"data": data
			
		},
		//"sAjaxSource": base_url+"/ajax_controller/select_applns",
		
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "processing": true,
        "serverSide": true,
        "bInfo": true,
        "bAutoWidth": false,
        "bDestroy": true,
        "scrollX": true,
        "scrollCollapse": true,

		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-5' B>>><'col-xs-3'p>>",
		"aoColumns": [
	                   { "sName": "sl_no","sWidth": "5%"},
                       { "sName": "name","sWidth": "15%"},
                       { "sName": "mobile","sClass": "alignRight","sWidth": "10%"},
				       { "sName": "email_id","sWidth": "10%"},
				       { "sName": "program_name","sWidth": "10%"},
                       { "sName": "status","sWidth": "10%"},
					   { "sName": "payment","sWidth": "10%"},
					   { "sName": "Application Date","sWidth": "10%"},
					   { "sName": "Print","sWidth": "10%","sClass": "alignCenter","sWidth": "10%","mRender": function( data, type, full ) { 
					           if(data == 'YES')
					           {
						         return '<button class="btn btn-success tooltipTable btn-circle" title="Print" onclick="rowApplication(event,\'print\')"><i class="fa fa-print" aria-hidden="true"></i></button>';
						       }
						       else
						       {
						         return '';
						       }
						    }
						},
					   { "sName": "Application Date","sWidth": "5%","bVisible": false},
					   {"sName": "default","sWidth": "5%","data":null,"sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='rowApplication(event,\"edit\")' title='Next' ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
       ],
		buttons: [{
						extend: 'excelHtml5',
						text: '<button class="btn btn-success" title = "Export"><i class="fa fa-file-excel-o" style="color:white"></i> Export to Excel</button>',
						filename:'Manage Application',
						header:true,
						title:'Manage Application',
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
				//var prog = encodeURI(program);
				var prog = program.replace("/", "`");
				//alert(prog);
				var file_name = res1.file_name+"_pdf";
				window.open(base_url+"mpdf_controller/"+file_name+"/reg_user_id/"+res1.file_name+"/program/"+prog);
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
				if(data.file_name == 'No Post Selected')
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