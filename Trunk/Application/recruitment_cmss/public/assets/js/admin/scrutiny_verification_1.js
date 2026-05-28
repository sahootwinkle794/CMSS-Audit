$(document).ready(function()
{
	var isDelete= false;
	var isEdit = false;
	var oTable;
	session = $("#hidSession").val();
	$("#btnGenerateReport").click(function (){
		var program = $('#cmbProgram').val();
		var app_date = $('#txtAppDate').val();
		var status = $('#cmbStatus').val();
		if(program =='')
		{
			toastr.error("Please Select a Program");
		}
		else
		{
			var data = {
				program:program,
				app_date:app_date,
				status:status
			};
			var applicantdetails = $('#tblApplicantDetails').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/get_applnt_details_scrutiny",
					"type": "POST",
					"data": data,
				},  
				"bPaginate": true,
		        "bLengthChange": true,
		        "bFilter": true,
		        "bSort": false,
		        "bInfo": true,
				"bDestroy":true,
		        "bAutoWidth":false,    
		        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutegroupbutton' >>><'col-xs-6'p>>",
			    "aoColumns": [    
	               { "sName": "sl_no","sWidth": ".5%" },
				   { "sName": "index","sWidth": "10%"},
				   { "sName": "mobile","sWidth": "10%"},
	               { "sName": "name","sWidth": "30%" },
				   { "sName": "status","sWidth": "10%"},
				   { "sName": "remark","sWidth": "15%"},
				   { "sName": "appl_no","bVisible":false},
				   { "sName": "email","bVisible":false},
				   { "sName": "applied_program","bVisible":false},
				   {"sName": "default","sWidth": "10%", "sDefaultContent": "<button type='button' class='btn btn-primary btn-sm' onclick='view_document(event)' title='View'><i class='fa fa-file'></i></button>"},
				   {"sName": "default","sWidth": "15%", "sDefaultContent": "<button type='button' class='btn btn-primary btn-sm' onclick='qualify(event)' title='Validate'><i class='fa fa-check'></i></button> <button type='button' class='btn btn-primary btn-sm' onclick='disqualify(event)' title='Invalidate'><i class='fa fa-close'></i></button>"},
				   
		        ]
			});
		}
	});
	$("#btnPrint").click(function (){
		var program = $('#cmbProgram').val();
		var app_date = $('#txtAppDate').val();
		var status = $('#cmbStatus').val();
		if(program =='')
		{
			toastr.error("Please Select a Program");
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
			toastr.error("Please Select a Program");
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
			$('#cmbProgram').append("<option value =''>Select</option>");
			$("#divProcessing").hide();
		}
	});
	
	$('#txtAppDate').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true
    });
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
				program:$('#cmbProgram').val(),
				hidName:$('#hidName').val(),
				hidEmail:$('#hidEmail').val()
			};
			//ajax call to server
			var result = confirm('Are you sure you want to Invalidate the applicant?');
			if(result)
			{
				$.ajax({
					url:base_url+"/ajax_controller/disqualify_scrutiny_applnts",
					type:"post",
					data:institutedata,
					success:function(){ 
						$('#applicantDisqualifyModal').modal('hide');
						toastr.success("Successfully Disqualified");
						var oTable = $('#tblApplicantDetails').dataTable();
						oTable.api().ajax.reload();	
						$("#taRemark").val("");
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
	var name = row.cells[3].innerHTML;
	//var email1 = row.cells[7].innerHTML;
	var email = oTable.fnGetData( row )['email_id'];
	//alert(email);return;
	$("#hidRegUserId").val(reg_user_id);
	$("#hidName").val(name);
	$("#hidEmail").val(email);
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
	var session = $("#hidSession").val();
	var oTable = $('#tblApplicantDetails').dataTable();
	
    var reg_user_id = oTable.fnGetData( row )['reg_user_id'];//GETTING Applicant Mobile No.
    var applied_program = oTable.fnGetData( row )['applied_program'];//GETTING Applicant Mobile No.
    
    var file_name = '';
    
    var institutedata={
			program : applied_program,
			reg_user_id : reg_user_id,
			mode : 'edit',
	};

	$.ajax({
		url:base_url+"/ajax_controller/edit_manage_appns",
		type:"post",
		data:institutedata,
		success:function(response)
		{  
			var res1 = JSON.parse(response);
			file_name =  res1.file_name;
			
			var controller = "get_scrutiny_modal_data_"+file_name;
			var institutedata=
			{
				reg_user_id : reg_user_id,
				program_code:$("#cmbProgram").val()
			};	
			$.ajax({
				url:base_url+"/ajax_controller/"+controller,
				type:"post",
				data : institutedata,
				success:function(response){  
					var res = JSON.parse(response);
					$('#exampleModal').modal('show');
					$("#dataPreview").html(res.html);
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		},
		error:function()
		{
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
   
	
}