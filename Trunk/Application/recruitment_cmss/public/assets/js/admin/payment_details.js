$(document).ready(function()
{
	var isDelete= false;
	var isEdit = false;
	var oTable;
	session = $("#hidSession").val();
	$("#btnGenerateReport").click(function (){
		$('#cmbProgramGroup').val("");
		$('#cmbProgram').val("");
		$('#cmbStatus').val("");
		/*var program = $('#cmbProgram').val();*/
		var pgCode = $('#cmbPGCode').val();
		var from_date = $('#txtStartdate').val();
		var to_date = $('#txtToDate').val();
		if(pgCode =='')
		{
			toastr.error("Please Select a PG Code");
		}
		else if(from_date == '')
		{
			toastr.error("Please Select a From date");
		}
		else if(to_date == '')
		{
			toastr.error("Please Select a To date");
		}
		else
		{
			var data = {
				cmbPGCode:pgCode,
				from_date:from_date,
				to_date:to_date
			};
			var applicantdetails = $('#tblApplicantDetails').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/get_applnt_details_payment_pgCode",
					"type": "POST",
					"data": data,
				},  
				"bPaginate": true,
		        "bLengthChange": true,
		        "bFilter": true,
		        "bSort": true,
		        "bInfo": true,
				"bDestroy":true,
		        "bAutoWidth":false,    
		        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutegroupbutton' B >>><'col-xs-6'p>>",
			    "aoColumns": [    
	               { "sName": "sl_no","sWidth": ".5%" },
				   { "sName": "appl_no","sWidth": "15%"},
				   { "sName": "reg_user_id","sWidth": "10%"},
	               { "sName": "full_name","sWidth": "20%" },
				   { "sName": "order_number","sWidth": "15%"},
				   { "sName": "payment_status","sWidth": "10%"},
				   { "sName": "depositdate","sWidth": "10%"},
				   { "sName": "transction_no","sWidth": "10%"},
				   { "sName": "pg_code","sWidth": "10%"},
				   { "sName": "vle_id","sWidth": "10%"},
				   
				   { "sName": "amount","sWidth": "10%"}
		        ],
				buttons: [{
						extend: 'excelHtml5',
						text: '<button class="btn btn-success" title = "Export"><i class="fa fa-file-excel-o" style="color:white"></i> Export to Excel</button>',
						filename:'Payment Details',
						header:true,
						title:'Payment Details',
				}]
			});
		}
	});
	
	$("#btnFilter").click(function (){
		var programGroup = $('#cmbProgramGroup').val();
		var program = $('#cmbProgram').val();
		var pgCode = $('#cmbPGCode').val();
		var from_date = $('#txtStartdate').val();
		var to_date = $('#txtToDate').val();
		var status = $('#cmbStatus').val();
		if(pgCode =='')
		{
			toastr.error("Please Select a PG Code");
		}
		else if(programGroup == '')
		{
			toastr.error("Please Select a Recruitment Drive");
		}
		else if(program == '')
		{
			toastr.error("Please Select a Post");
		}
		else if(from_date == '')
		{
			toastr.error("Please Select a From date");
		}
		else if(to_date == '')
		{
			toastr.error("Please Select a To date");
		}
		else
		{
			var data = {
				program:program,
				cmbPGCode:pgCode,
				from_date:from_date,
				to_date:to_date,
				status:status
			};
			var applicantdetails = $('#tblApplicantDetails').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/get_applnt_details_payment",
					"type": "POST",
					"data": data,
				},  
				"bPaginate": true,
		        "bLengthChange": true,
		        "bFilter": true,
		        "bSort": true,
		        "bInfo": true,
				"bDestroy":true,
		        "bAutoWidth":false,    
		        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutegroupbutton' B >>><'col-xs-6'p>>",
			    "aoColumns": [    
	               { "sName": "sl_no","sWidth": ".5%" },
				   { "sName": "appl_no","sWidth": "15%"},
				   { "sName": "reg_user_id","sWidth": "10%"},
	               { "sName": "full_name","sWidth": "20%" },
				   { "sName": "order_number","sWidth": "15%"},
				   { "sName": "payment_status","sWidth": "10%"},
				   { "sName": "depositdate","sWidth": "10%"},
				   { "sName": "transction_no","sWidth": "10%"},
				   { "sName": "pg_code","sWidth": "10%"},
				   { "sName": "vle_id","sWidth": "10%"},
				   
				   { "sName": "amount","sWidth": "10%"}
		        ],
				buttons: [{
						extend: 'excelHtml5',
						text: '<button class="btn btn-success" title = "Export"><i class="fa fa-file-excel-o" style="color:white"></i> Export to Excel</button>',
						filename:'Payment Details',
						header:true,
						title:'Payment Details',
				}]
			});
		}
	});
	
	$("#btnPrint").click(function (){
		var program = $('#cmbProgram').val();
		var app_date = $('#txtAppDate').val();
		var status = $('#cmbStatus').val();
		if(program =='')
		{
			toastr.error("Please Select a Post");
		}
		else
		{
			window.open("applicant_count.php?program="+program+"&status="+status,"Scrutiny Report","left=0,top=0,width=1024,height=700,target=_blank, scrollbars=1,menubar=0,status=0,toolbar=0").focus();
		}	
	});
	$("#btnExportReport").click(function (){
		var program = $('#cmbProgram').val();
		var app_date = $('#txtAppDate').val();
		var status = $('#cmbStatus').val();
		if(program =='')
		{
			toastr.error("Please Select a Post");
		}
		else
		{	
			window.open("excel_scrutiny_report.php?program="+program+"&status="+status+"&_s="+session,"Scrutiny Report","left=0,top=0,width=1024,height=700,target=_blank, scrollbars=1,menubar=0,status=0,toolbar=0").focus();
		}
	});
	$('.tooltips').tooltipster({
		theme: 'tooltipster-punk',
		animation: 'grow',
        delay: 200, 
        touchDevices: false,
        trigger: 'hover'
     });	
     
    /*Program Group for Dropdown*/
	$.ajax({
		url:base_url+"/ajax_controller/get_program_group_scrutiny_applnts",
		type:"post",
		success:function(response){  
			var options = "<option value =''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value='"+data.program_group+"'>"+data.program_group_name+"</option>";
				
			});
			$('#cmbProgramGroup').html("");   //campusid from academicPeriod
			$('#cmbProgramGroup').append(options);
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
	$.ajax({
		url:base_url+"/ajax_controller/get_pgCode_scrutiny_applnts",
		type:"post",
		data:'',
		success:function(response){  
			var options = "<option value =''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.pg_code+">"+data.pg_code+"</option>";
				
			});
			$('#cmbPGCode').html("");   //campusid from academicPeriod
			$('#cmbPGCode').append(options);
			$("#divProcessing").hide();
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
			$("#divProcessing").hide();
		}
	});
	
	$.ajax({
		url:base_url+"/ajax_controller/get_status_scrutiny_applnts",
		type:"post",
		data:'',
		success:function(response){  
			var options = "<option value =''>Select</option>";
			options = options + "<option value =''>All</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.deposit_status+">"+data.deposit_status+"</option>";
				
			});
			$('#cmbStatus').html("");   //campusid from academicPeriod
			$('#cmbStatus').append(options);
			//$("#divProcessing").hide();
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
			//$("#divProcessing").hide();
		}
	});
	
	$('#cmbProgramGroup').change(function (event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			$("#divProcessing").show();
			/*Program for Dropdown*/
			var institutedata = {
				program_group:$('#cmbProgramGroup').val()
			};
			$.ajax({
				url:base_url+"/ajax_controller/get_program_scrutiny_applnts",
				type:"post",
				data:institutedata,
				success:function(response){  
					var options = "<option value =''>Select</option>";
					var res1 = JSON.parse(response);
					$.each(res1.aaData,function(i,data){
						options = options + "<option value="+data.program_code+">"+data.program_name+"</option>";
						
					});
					$('#cmbProgram').html("");   //campusid from academicPeriod
					$('#cmbProgram').append(options);
					$("#divProcessing").hide();
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
					$("#divProcessing").hide();
				}
			});
			
			
		}
		else
		{
			$("#divProcessing").show();
			$('#cmbProgram').html("");   //campusid from academicPeriod
			$('#cmbPGCode').html("");   //campusid from academicPeriod
			$('#cmbProgram').append("<option value =''>Select</option>");
			$('#cmbPGCode').append("<option value =''>Select</option>");
			$("#divProcessing").hide();
		}
	});
   
	$('#txtStartdate').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true
    });
    $('#txtStartdate').datepicker('setDate', new Date());
    $('#txtToDate').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true
    });
    $('#txtToDate').datepicker('setDate', new Date());
  
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
	$('#frmDisQualifyModal').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			//$("#spanProcessingProgramEdit").show();
					
			var institutedata={
				hidRegUserId:$('#hidRegUserId').val(),
				hidProgram:$('#hidProgram').val(),
				taRemark:$('#taRemark').val(),
				program:$('#cmbProgram').val()
			};
			//ajax call to server
			var result = confirm('Are you sure you want to Invalidate the applicant?');
			if(result)
			{
				$.ajax({
					url:base_url+"/ajax_controller/disqualify_scrutiny_applnts",
					type:"post",
					data:institutedata,
					success:function(response){
						var result = JSON.parse(response);
						if(result.status=='xsserror')
						{
							
							toastr.error(result.msg);
							$('#applicantDisqualifyModal').modal('hide');	
							$("#taRemark").val("");
						}	 
						else{
							$('#applicantDisqualifyModal').modal('hide');
							toastr.success("Successfully Disqualified");
							var oTable = $('#tblApplicantDetails').dataTable();
							oTable.api().ajax.reload();	
							$("#taRemark").val("");
						}
						
					},
					error:function(){
						toastr.error('Unable to process please contact support');
					}
				});
			}
		},
		fields:{
			taRemark: {							//form input type name
					validators: {
						notEmpty: {
							message: 'This field can\'t left blank'
						}
					}
				}
		}
			
	});
});
function qualify(event)
{
	//alert("hello");
	var oTable = $('#tblApplicantDetails').dataTable();			
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	var appl_no = oTable.fnGetData( row )[6];//GETTING DATA FOR HIDDEN COLUMN(PEOPLEID)
	var reg_user_id = row.cells[2].innerHTML;
	var program =  $('#cmbProgram').val();
	var result = confirm('Are you sure you want to Validate the applicant ?');
	if(result)
	{
		if(program !='' && reg_user_id !='')
		{
			var institutedata={
				reg_user_id:reg_user_id,
				program:program
			};
			
			$.ajax({
				url:base_url+"/ajax_controller/qualify_scrutiny_applnts",
				type:"post",
				data:institutedata,
				success:function(response){  
					//var dtblInbox = $("#dtblInbox").dataTable();
					
		 			toastr.success("Successfully Qualified");
					oTable.api().ajax.reload();
			
					
					//alert("hello");		
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
			
			
		}
	}
	
	
	
}
function disqualify(event)
{
	var oTable = $('#tblApplicantDetails').dataTable();			
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	//var appl_no = oTable.fnGetData( row )[6];//GETTING DATA FOR HIDDEN COLUMN(PEOPLEID)
	var reg_user_id = row.cells[2].innerHTML;
	$("#hidRegUserId").val(reg_user_id);
	
	var program =  $('#cmbProgram').val();
	$("#hidProgram").val(program);
	
	$('#applicantDisqualifyModal').modal('show');
	
}
function view_document(event)
{
	
	var oTable = $('#tblApplicantDetails').dataTable();			
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	var appl_no = oTable.fnGetData( row )[6];//GETTING DATA FOR HIDDEN COLUMN(PEOPLEID)
	var reg_user_id = row.cells[2].innerHTML;
	var program =  $('#cmbProgram').val();
	var institutedata = {
		program:program
	};
	$.ajax({
		url:base_url+"/ajax_controller/get_template_scrutiny_applnts",
		type:"post",
		data:institutedata,
		success:function(response){  
			var template = "";
			template = response;
			//alert(template);
			$('#hidTemplate').val(template);
			//alert($('#hidTemplate').val());
			if(program !='' && reg_user_id !='')
			{
				template = $('#hidTemplate').val();
				//alert(template);
				//<?=base_url()?>apply/download_print_application
				window.open(base_url+"Mpdf_controller/applicant_documents_008/"+program+"/"+reg_user_id+"/"+appl_no,"view_documents","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
				//window.open("../../PDF/applicant_documents_"+template+".php?program="+program+"&reg_user_id="+reg_user_id,"view_documents","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
			}		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
}