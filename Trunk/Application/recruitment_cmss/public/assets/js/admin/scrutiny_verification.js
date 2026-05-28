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
			toastr.error("Please Select a Post");
		}
		else
		{
			
			var applicantdetails = $('#tblApplicantDetails').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/get_applnt_details_scrutiny",
					"type": "POST",
					"data": {
						program:program,
						app_date:app_date,
						status:''
					},
				},  
				"bPaginate": true,
		        "bLengthChange": true,
		        "bFilter": true,
		        "bSort": true,
		        "bInfo": true,
				"bDestroy":true,
		        "bAutoWidth":false,    
		        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutegroupbutton' >>><'col-xs-6'p>>",
			    "aoColumns": [    
	               { "sName": "sl_no","sWidth": ".5%" },
				   { "sName": "index","sWidth": "10%"},
				   { "sName": "mobile","sWidth": "10%","mRender": function( data, type, full ) { 
				            mobile = data.replace(/\d(?=\d{4})/g, "*");
					        return mobile;
					    }
					},
				   { "sName": "mobile_no","bVisible":false},
	               { "sName": "name","sWidth": "20%" },
				   { "sName": "status","sWidth": "10%"},
				   { "sName": "remark","sWidth": "15%"},
				   { "sName": "appl_no","bVisible":false},
				   { "sName": "submission_date","sWidth": "15%"},
				   { "sName": "scrutinized_date","sWidth": "15%","bVisible":false},
				   {"sName": "default","sWidth": "5%","mRender": function( data, type, full ) { 
				            return "<button type='button' class='btn btn-primary btn-sm tooltipTable' onclick='view_document(event,1)' title='View'><i class='fa fa-file'></i></button>";
						} 
					},
				   {"sName": "default","sWidth": "15%","mRender": function( data, type, full ) { 
				            return "<button type='button' class='btn btn-primary btn-sm tooltipTable' onclick='qualify(event)' title='Validate'><i class='fa fa-check'></i></button> <button type='button' class='btn btn-primary btn-sm tooltipTable' onclick='disqualify(event)' title='Invalidate'><i class='fa fa-close'></i></button>";
					    }
					}
				   
		        ],
		        "fnDrawCallback": function(oSettings, json) 
		       	{
		     		$('.tooltipTable').tooltipster( {
			         	theme: 'tooltipster-punk',
			      		animation: 'grow',
			        	delay: 200, 
			         	touchDevices: false,
			         	trigger: 'hover'
		      		} );          
		  		}
			});
				
			
			var applicantdetailsvalid = $('#tblApplicantDetailsValid').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/get_applnt_details_scrutiny",
					"type": "POST",
					"data": {
						program:program,
						app_date:app_date,
						status:'Valid'
					},
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
				   { "sName": "mobile","sWidth": "10%","mRender": function( data, type, full ) { 
				            mobile = data.replace(/\d(?=\d{4})/g, "*");
					        return mobile;
					    }
					},
				   { "sName": "mobile_no","bVisible":false},
	               { "sName": "name","sWidth": "30%" },
				   { "sName": "status","sWidth": "10%"},
				   { "sName": "remark","sWidth": "15%"},
				   { "sName": "appl_no","bVisible":false},
				   { "sName": "submission_date","sWidth": "15%"},
				   { "sName": "scrutinized_date","sWidth": "15%"},
				   {"sName": "default","sWidth": "10%", "sDefaultContent": "<button type='button' class='btn btn-primary btn-sm' onclick='view_document(event,2)' title='View'><i class='fa fa-file'></i></button>"},
		        ]
			});
			var applicantdetailsinvalid = $('#tblApplicantDetailsInvalid').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/get_applnt_details_scrutiny",
					"type": "POST",
					"data": {
						program:program,
						app_date:app_date,
						status:'Invalid'
					},
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
				   { "sName": "mobile","sWidth": "10%","mRender": function( data, type, full ) { 
				            mobile = data.replace(/\d(?=\d{4})/g, "*");
					        return mobile;
					    }
					},
				   { "sName": "mobile_no","bVisible":false},
	               { "sName": "name","sWidth": "30%" },
				   { "sName": "status","sWidth": "10%"},
				   { "sName": "remark","sWidth": "15%"},
				   { "sName": "appl_no","bVisible":false},
				   { "sName": "submission_date","sWidth": "15%"},
				   { "sName": "scrutinized_date","sWidth": "15%"},
				   {"sName": "default","sWidth": "10%", "sDefaultContent": "<button type='button' class='btn btn-primary btn-sm' onclick='view_document(event,3)' title='View'><i class='fa fa-file'></i></button>"},
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
			toastr.error("Please Select a Post");
		}
		else
		{
			window.open(base_url+"admin/excel_scrutiny_report/"+program+"/"+status+"/"+app_date,"Scrutiny Report","left=0,top=0,width=1024,height=700,target=_blank, scrollbars=1,menubar=0,status=0,toolbar=0").focus();
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
			window.open(base_url+"admin/excel_scrutiny_report/"+program+"/"+status+"/"+app_date,"Scrutiny Report","left=0,top=0,width=1024,height=700,target=_blank, scrollbars=1,menubar=0,status=0,toolbar=0").focus();
		}
	});
	$("#btnSynopsisSheet").click(function (){
		var program = $('#cmbProgram').val();
		var app_date = $('#txtAppDate').val();
		var status = $('#cmbStatus').val();
		if(program =='')
		{
			toastr.error("Please Select a Post");
		}
		else
		{	
			window.open(base_url+"admin/excel_synopsis_report/"+program+"/"+status+"/"+app_date,"Scrutiny Report","left=0,top=0,width=1024,height=700,target=_blank, scrollbars=1,menubar=0,status=0,toolbar=0").focus();
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
				program:$('#cmbProgram').val()
			};
			//ajax call to server
			//var result = confirm('Are you sure you want to Invalidate the applicant?');
			swal({
				title: "Are you sure",
				text: "You want to Invalidate the applicant?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, Invalidate the applicant!",
				cancelButtonText: "No, cancel",
				closeOnConfirm: false,
				closeOnCancel: true
			},
			function(isConfirm){
			  	if (isConfirm) {
			
					$.ajax({
						url:base_url+"/ajax_controller/disqualify_scrutiny_applnts",
						type:"post",
						data:institutedata,
						success:function(){ 
							
							swal("Continued", "Invalidated applicant successfully", "success");
							$('#applicantDisqualifyModal').modal('hide');
							toastr.success("Successfully Disqualified");
							var oTable = $('#tblApplicantDetails').dataTable();
							oTable.api().ajax.reload();	
							var oTable1 = $('#tblApplicantDetailsValid').dataTable();
							oTable1.api().ajax.reload();
							var oTable2 = $('#tblApplicantDetailsInvalid').dataTable();
							oTable2.api().ajax.reload();	
							$('#frmDisQualifyModal').data('bootstrapValidator').resetForm(true); //to reset the form
						},
						error:function(){
							toastr.error('Unable to process please contact support');
						}
					});
				}
			});
			
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
	var reg_user_id = oTable.fnGetData( row )[3];
	var program =  $('#cmbProgram').val();
	
	
	$("#hidRegqualyUserId").val(reg_user_id);
	$("#hidqualyProgram").val(program);
	//$('#applicantqualifyModal').modal('show');
	var institutedata={
		reg_user_id:$('#hidRegqualyUserId').val(),
		hidProgram:$('#hidqualyProgram').val(),
		taRemark:$('#taqulyRemark').val(),
		program:$('#cmbProgram').val()
	};
	//ajax call to server
	swal({
		title: "Are you sure",
		text: "You want to valid the applicant?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, valid the applicant!",
		cancelButtonText: "No, cancel",
		closeOnConfirm: false,
		closeOnCancel: true
	},
	function(isConfirm){
	  	if (isConfirm) {
	    	
	    	$.ajax({
				url:base_url+"/ajax_controller/qualify_scrutiny_applnts",
				type:"post",
				data:institutedata,
				success:function(response){ 
					var res1 = JSON.parse(response);
					
					if(res1.status=="SUCCESS"){
						//$('#applicantqualifyModal').modal('hide');
						toastr.success("Successfully Accepted");
						toastr.success("Application Verified");
						
						$("#btnReject").show();
						$("#btnAccept").hide();
						$("#taqulyRemark").val("");
						swal("Continued", "Validated applicant successfully", "success");
							var oTable = $('#tblApplicantDetails').dataTable();
							oTable.api().ajax.reload();	
							var oTable1 = $('#tblApplicantDetailsValid').dataTable();
							oTable1.api().ajax.reload();
							var oTable2 = $('#tblApplicantDetailsInvalid').dataTable();
							oTable2.api().ajax.reload();		
						
					}else{
						toastr.error("Unable to save.Please Try Again");
					}
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
	  	}
	});
	
}

$('#frmQualifyModal').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			
			var institutedata={
				reg_user_id:$('#hidRegqualyUserId').val(),
				hidProgram:$('#hidqualyProgram').val(),
				taRemark:$('#taqulyRemark').val(),
				program:$('#cmbProgram').val()
			};
			//ajax call to server
			swal({
				title: "Are you sure",
				text: "You want to valid the applicant?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, valid the applicant!",
				cancelButtonText: "No, cancel",
				closeOnConfirm: false,
				closeOnCancel: true
			},
			function(isConfirm){
			  	if (isConfirm) {
			    	
			    	$.ajax({
						url:base_url+"/ajax_controller/qualify_scrutiny_applnts",
						type:"post",
						data:institutedata,
						success:function(response){ 
							var res1 = JSON.parse(response);
							
							if(res1.status=="SUCCESS"){
								$('#applicantqualifyModal').modal('hide');
								toastr.success("Successfully Accepted");
								$("#btnReject").show();
								$("#btnAccept").hide();
								$("#taqulyRemark").val("");
								swal("Continued", "Validated applicant successfully", "success");
									var oTable = $('#tblApplicantDetails').dataTable();
									oTable.api().ajax.reload();	
									var oTable1 = $('#tblApplicantDetailsValid').dataTable();
									oTable1.api().ajax.reload();
									var oTable2 = $('#tblApplicantDetailsInvalid').dataTable();
									oTable2.api().ajax.reload();		
								
							}else{
								toastr.error("Unable to save.Please Try Again");
							}
						},
						error:function(){
							toastr.error('Unable to process please contact support');
						}
					});
			  	}
			});
			/*var result = confirm('Are you sure you want to valid the applicant?');
			if(result)
			{
				
			}*/
		},
		fields:{
			taqulyRemark: {							//form input type name
					validators: {
						notEmpty: {
							message: 'This field can\'t left blank'
						}
					}
				}
		}
			
});

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
	var reg_user_id = oTable.fnGetData( row )[3];
	$("#hidRegUserId").val(reg_user_id);
	
	var program =  $('#cmbProgram').val();
	$("#hidProgram").val(program);
	$('#frmDisQualifyModal').data('bootstrapValidator').resetForm(true); //to reset the form
	$('#applicantDisqualifyModal').modal('show');
	
}

function view_document(event,num)
{
	//alert(1);
	if(num==1){
		var oTable = $('#tblApplicantDetails').dataTable();	
	}else if(num==2){
		var oTable = $('#tblApplicantDetailsValid').dataTable();	
	}else if(num==3){
		var oTable = $('#tblApplicantDetailsInvalid').dataTable();	
	}
			
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});
	//alert(2);
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	var appl_no = oTable.fnGetData( row )[6];//GETTING DATA FOR HIDDEN COLUMN(PEOPLEID)
	var reg_user_id = oTable.fnGetData( row )[3];
	var program =  $('#cmbProgram').val();
	var institutedata={
			program : program,
			reg_user_id : reg_user_id,
			mode : 'edit',
		};
	//alert(3);
		$.ajax({
			url:base_url+"/ajax_controller/edit_manage_appns",
			type:"post",
			data:institutedata,
			success:function(response)
			{  
			//alert(4);
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
						$('#viewModal').modal('show');
						$("#tempPreview").html(res.html);
					},
					error:function(){
						toastr.error("We are unable to Process.Please contact Support");
					}
				});
				//window.open(base_url+"apply/"+file_name,"view_documents","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
				/*$.each(res1.aaData,function(i,data)
				{
					window.open(base_url+"mpdf_controller/template008_verification/reg_user_id/","view_documents","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
				});	*/
			},
			error:function()
			{
				//alert(5);
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	
}