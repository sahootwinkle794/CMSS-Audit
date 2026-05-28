$(document).ready(function()
{
	var session = $('#hidSessionCode').val();
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
	CKEDITOR.replace( 'txtExamInstructions',
    {
    	toolbarCanCollapse: true,
    	toolbarStartupExpanded: false,
    	removePlugins : 'elementspath'
		
	});
	CKEDITOR.replace( 'txtExamInstructionsEdit',
    {
    	toolbarCanCollapse: true,
    	toolbarStartupExpanded: false,
    	removePlugins : 'elementspath'
		
	});
	if(dd<10) {
	    dd='0'+dd
	} 

	if(mm<10) {
	    mm='0'+mm
	} 

	today = dd+'-'+mm+'-'+yyyy;
	//document.write(today);
	
	var isDelete= false;
	var isEdit = false;
	$.ajax({
		url:base_url+"/ajax_controller/get_admitcard_templateCode",
		type:"post",
		data : '',
		success:function(response){  
			var options = "<option value =''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.template_code+">"+data.template_name+"</option>";
				
			});
			$('#cmbTemplate').html("");   //campusid from academicPeriod
			$('#cmbTemplate').append(options);
			$('#cmbTemplateEdit').html("");   //campusid from academicPeriod
			$('#cmbTemplateEdit').append(options);
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$.ajax({
		url:base_url+"/ajax_controller/get_program_group_admit_setup",
		type:"post",
		data:"",
		success:function(response)
		{  
			var options = "<option value=''>Select Recruitment Drive</option>";					
							
			var res1 = JSON.parse(response);					
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value='"+data.program_group_code+"'>"+data.program_group_name+"</option>";
			});
			$('#cmbProgramGroup').html("");   
			$('#cmbProgramGroup').append(options);
			var program_group = $("#cmbProgramGroup").val();
			if(program_group != '')
			{
				var institutedata = {
					program_group : program_group,
					program_type : 'Current'
				}
				$.ajax({
					url:base_url+"/ajax_controller/get_program_admit_setup",
					type:"post",
					data : institutedata,
					success:function(response){ 
						var optionss = "<option value=''>Select Post</option>";
						var res1 = JSON.parse(response); 
						var count = 0;
						$.each(res1.aaData,function(i,data){
							count++;
							optionss = optionss + "<option value="+data.program_code+">"+data.program_name+"</option>";
						});
						var opt = "<option value ='null'>Select Post</option>";
						if(count == 0){
							$('#cmbProgramFilter').html("");   //campusid from academicPeriod
							$('#cmbProgramFilter').append(opt);
						}
						else{
							$('#cmbProgramFilter').html("");   //campusid from academicPeriod
							$('#cmbProgramFilter').append(optionss);
						}
						var program_code = $("#cmbProgramFilter").val();
						$('#hidProgramCode').val(program_code);
						$('#hidProgramCodeEdit').val(program_code);
						if(program_code != '')
						{
							var institutedata = {
								program_code : program_code
							}
							$.ajax({
							url:base_url+"ajax_controller/get_admitcard_date",
							type:"post",
							data:institutedata,
							success:function(response)
							{  
								var options = "<option value =''>Select Round</option>";					
								var res1 = JSON.parse(response);
								$("#txtAvailableFrom").val(res1.admitcard_start_date);
								$("#txtAvailableUpto").val(res1.admitcard_end_date);
								//alert($("#txtAvailableFrom").val());					
								
							},
							error:function()
							{
								toastr.error("We are unable to Process.Please contact Support");
							}
						});
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
							$("#spanProcessingProgram").show();
							var institutedata = {
								program_code : program_code
							}
							$.ajax({
								url:base_url+"/ajax_controller/get_exam_centre_admit_setup",
								type:"post",
								data : institutedata,
								success:function(response){ 
									$("#spanProcessingProgram").hide(); 
									var options = "<option value =''>Select</option>";
									var res1 = JSON.parse(response);
									$.each(res1.aaData,function(i,data){
										options = options + "<option value="+data.exam_centre_code+">"+data.exam_centre_name+"</option>";
									});
									$('#cmbExamCentre').html("");   //campusid from academicPeriod
									$('#cmbExamCentre').append(options);
									$('#cmbExamCentreAdd').html("");   //campusid from academicPeriod
									$('#cmbExamCentreAdd').append(options);
									var exam_centre_code = $('#cmbExamCentre').val();
									
									
										/**CREATING BUTTON*****/
										//$("div.institutegroupbutton").html('<div class="btngroup"><button class="btn btn-info custombtn" id="btnEditCentreAddress">Edit</button></div>');
										/*****END OF BUTTON CREATION******/
									
									if(exam_centre_code != ''){
										var data = {
											program_code:program_code,
											exam_centre_code:exam_centre_code,
										};
										var addbuttonCode1 = 1;
										var centerAddressMaster = $('#tblCenterAddressMaster').dataTable({
											"ajax":
											{
												"url": base_url+"/ajax_controller/get_admit_genericData",
												"type": "POST",
												"data": data,
											},  
											"bPaginate": true,
									        "bLengthChange": true,
									        "bFilter": true,
									        "bSort": true,
									        "bInfo": true,
											"bDestroy" : true,
									        "bAutoWidth": false,
									        "initComplete": function( settings, json ) {
											    if(centerAddressMaster.fnGetData().length > 0){
													$("div.addbuttonCode").hide();
												}else{
													$("div.addbuttonCode").show();
												}
											},
											"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 addbuttonCode' >>><'col-xs-6'p>>",
		
											"aoColumns": [
										                 { "sName": "Slno","sWidth": "5%" },
														 { "sName": "program_code","bVisible":false },
														 { "sName": "admit_card_available_from","sWidth": "10%" },
														 { "sName": "admit_card_available_upto","sWidth": "10%","mRender": function( data, type, full ) { 
													           if(full.length > 0){
															   		$("div.addbuttonCode").hide();
															   }
														         return data;
														    }
														},
														 { "sName": "instruction","bVisible":false },
														 { "sName": "controller_name"},
														 { "sName": "controller_mobile_no" },
														 { "sName": "controller_email" },
														 { "sName": "controller sign","bVisible":false },
														 
														 { "sName": "reporting_time"},
														 { "sName": "exam_start_time"},
														 { "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "10%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEdit' onclick='edit(event);'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
									        			],
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
										if (addbuttonCode1 == 1) {
										    $("div.addbuttonCode").html('<button id="btnAddCentreAddress" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
										}
										
										$('#btnAddCentreAddress').click(function(){
		
											//alert("hello");return;
											var program_code = $("#cmbProgramFilter").val();
											var institutedata = {
												program_code:program_code
											};
												
												$.ajax({
													url:base_url+"/ajax_controller/get_admitcard_date",
													type:"post",
													data:institutedata,
													success:function(response)
													{  
														var options = "<option value =''>Select Round</option>";					
														var res1 = JSON.parse(response);
														if(res1.admitcard_start_date != '01-01-1970'){
															$("#txtAvailableFrom").val(res1.admitcard_start_date);
															$("#txtAvailableUpto").val(res1.admitcard_end_date);		
														}
																	
														
													},
													error:function()
													{
														toastr.error("We are unable to Process.Please contact Support");
													}
												});
											$.ajax({
												url:base_url+"ajax_controller/exam_venue_data",
												type:"post",
												data:institutedata,
												success:function(response)
												{
													
													var obj = jQuery.parseJSON(response);
													$('#txtExamVanueCode').val(obj.exam_vanue_code);
												},  
												error:function()
												{
													toastr.error('Unable to process please contact support');
												}
											});
											CKEDITOR.instances['taExamSchedule'].setData("");
											CKEDITOR.instances['txtExamInstructions'].setData("");
											$('#frmAddCentreAddress').data('bootstrapValidator').resetForm(true);
											//Reseting the tick marks before opening add modal	
											var cmbExamCentre = $("#cmbExamCentre").val();
											
											$('#cmbExamCentreAdd').val(cmbExamCentre);
											$('#txtExamVanue').val("");
											//$('#txtExamRound').val("");
											$('#txtCapacity').val("");
											$('#txtCentreAddress').val("");
											$('#txtExamInstructions').val("");
											$('#fileControllerSignature').val("");
											$('#cmbStatus').val("");
											$('#signatureDisplayarea').attr('src', '');
											$('#centreAddressAddModal').modal('show');
											$("#hidOperTypeCentreAdd").val("add_centre");
											$('#centreAddressAddModal').on('shown.bs.modal', function () 
											{ 
												$('#txtExamCentreCode').focus(); // Focusing the textbox
											})
										});
										$('#sbtnExcel').click(function(){
											window.open(base_url+"/Admin/excel_admitcard_setup");
										});
									}
									else{
										var addbuttonCode2 = 1; 
										var data = {
											program_code:program_code,
											exam_centre_code:exam_centre_code,
										};
										var centerAddressMaster = $('#tblCenterAddressMaster').dataTable({
											"ajax":
											{
												"url": base_url+"/ajax_controller/get_admit_genericData",
												"type": "POST",
												"data": data,
											},  
											"bPaginate": true,
									        "bLengthChange": true,
									        "bFilter": true,
									        "bSort": true,
									        "bInfo": true,
											"bDestroy" : true,
									        "bAutoWidth": false,
									        "initComplete": function( settings, json ) {
											    if(centerAddressMaster.fnGetData().length > 0){
													$("div.addbuttonCode").hide();
												}else{
													$("div.addbuttonCode").show();
												}
											},
											//"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9'><'col-xs-3'p>>",
											"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 addbuttonCode' >>><'col-xs-6'p>>",
											/*"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addbuttonCode' >>><'col-xs-6'p>>", */
											"aoColumns": [
										                 { "sName": "Slno","sWidth": "5%" },
														 { "sName": "program_code","bVisible":false },
														 { "sName": "admit_card_available_from","sWidth": "10%" },
														 { "sName": "admit_card_available_upto","sWidth": "10%","mRender": function( data, type, full ) { 
													           if(full.length > 0){
															   		$("div.addbuttonCode").hide();
															   }
														         return data;
														    }
														},
														 { "sName": "instruction","bVisible":false },
														 { "sName": "controller_name"},
														 { "sName": "controller_mobile_no" },
														 { "sName": "controller_email" },
														 { "sName": "controller sign","bVisible":false },
														 
														 { "sName": "reporting_time"},
														 { "sName": "exam_start_time"},
														 { "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "10%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEdit' onclick='edit(event);'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
									        			],
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
										
										
										if ( addbuttonCode2 == 1) {
										    $("div.addbuttonCode").html('<button id="btnAddCentreAddress" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
										}
										//$("div.addbuttonCode").html('<button id="btnAddCentreAddress" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
										$('#btnAddCentreAddress').click(function(){
		
											//alert("hello");return;
											var program_code = $("#cmbProgramFilter").val();
											var institutedata = {
												program_code:program_code
											};
												
												$.ajax({
													url:base_url+"/ajax_controller/get_admitcard_date",
													type:"post",
													data:institutedata,
													success:function(response)
													{  
														var options = "<option value =''>Select Round</option>";					
														var res1 = JSON.parse(response);
														if(res1.admitcard_start_date != '01-01-1970'){
															$("#txtAvailableFrom").val(res1.admitcard_start_date);
															$("#txtAvailableUpto").val(res1.admitcard_end_date);		
														}
																		
														
													},
													error:function()
													{
														toastr.error("We are unable to Process.Please contact Support");
													}
												});
											$.ajax({
												url:base_url+"ajax_controller/exam_venue_data",
												type:"post",
												data:institutedata,
												success:function(response)
												{
													
													var obj = jQuery.parseJSON(response);
													$('#txtExamVanueCode').val(obj.exam_vanue_code);
												},  
												error:function()
												{
													toastr.error('Unable to process please contact support');
												}
											});
											CKEDITOR.instances['taExamSchedule'].setData("");
											CKEDITOR.instances['txtExamInstructions'].setData("");
											$('#frmAddCentreAddress').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
											$('#txtExamVanue').val("");
											//$('#txtExamRound').val("");
											var cmbExamCentre = $("#cmbExamCentre").val();
											$('#cmbExamCentreAdd').val(cmbExamCentre);
											$('#txtCapacity').val("");
											$('#txtCentreAddress').val("");
											$('#txtExamInstructions').val("");
											$('#fileControllerSignature').val("");
											$('#cmbStatus').val("");
											$('#signatureDisplayarea').attr('src', '');
											$('#centreAddressAddModal').modal('show');
											$("#hidOperTypeCentreAdd").val("add_centre");
											$('#centreAddressAddModal').on('shown.bs.modal', function () 
											{ 
												$('#txtExamCentreCode').focus(); // Focusing the textbox
											})
										});
										$('#sbtnExcel').click(function(){
												window.open(base_url+"/Admin/excel_admitcard_setup");
										});
									}
									$('#hidExamCentreCode').val(exam_centre_code);
									//$('#hidExamCentreCodeEdit').val(exam_centre_code);
								},
								error:function(){
									toastr.error("We are unable to Process.Please contact Support");
								}
							});
							var institutedata = {
								program_code:program_code
							};
							$.ajax({
								url:base_url+"/ajax_controller/get_apply_date_admit_setup",
								type:"post",
								data: institutedata,
								success:function(response){ 
									var res1 = JSON.parse(response);
									$.each(res1.aaData,function(i,data){
										var date = data.apply_end_date;	
										var startDate = new Date(date);
									});	
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
		},
		error:function()
		{
			toastr.error("We are unable to Process.Please contact Support");
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
					var optionss = "<option value=''>Select Post</option>";
					var res1 = JSON.parse(response); 
					var count = 0;
					$.each(res1.aaData,function(i,data){
						count++;
						optionss = optionss + "<option value="+data.program_code+">"+data.program_name+"</option>";
					});
					var opt = "<option value=''>Select Post</option>";
					if(count == 0){
						$('#cmbProgramFilter').html("");   //campusid from academicPeriod
						$('#cmbProgramFilter').append(opt);
					}
					else{
						$('#cmbProgramFilter').html("");   //campusid from academicPeriod
						$('#cmbProgramFilter').append(optionss);
					}
					var program_code = $("#cmbProgramFilter").val();
					$('#hidProgramCode').val(program_code);
					$('#hidProgramCodeEdit').val(program_code);
					if(program_code != '')
					{
						var institutedata = {
							program_code : program_code
						}
						$.ajax({
							url:base_url+"ajax_controller/get_admitcard_date",
							type:"post",
							data:institutedata,
							success:function(response)
							{  
								var options = "<option value =''>Select Round</option>";					
								var res1 = JSON.parse(response);
								if(res1.admitcard_start_date != '01-01-1970'){
									$("#txtAvailableFrom").val(res1.admitcard_start_date);
									$("#txtAvailableUpto").val(res1.admitcard_end_date);		
								}
													
								
							},
							error:function()
							{
								toastr.error("We are unable to Process.Please contact Support");
							}
						});
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
						$("#spanProcessingProgram").show();
						
						var institutedata = {
							program_code : program_code
						}
						$.ajax({
							url:base_url+"/ajax_controller/get_exam_centre_admit_setup",
							type:"post",
							data : institutedata,
							success:function(response){ 
								$("#spanProcessingProgram").hide(); 
								var options = "<option value =''>Select</option>";
								var res1 = JSON.parse(response);
								$.each(res1.aaData,function(i,data){
									options = options + "<option value="+data.exam_centre_code+">"+data.exam_centre_name+"</option>";
								});
								$('#cmbExamCentre').html("");   //campusid from academicPeriod
								$('#cmbExamCentre').append(options);
								$('#cmbExamCentreAdd').html("");   //campusid from academicPeriod
								$('#cmbExamCentreAdd').append(options);
								var exam_centre_code = $('#cmbExamCentre').val();
								
								if(exam_centre_code != ''){
									var data = {
										program_code:program_code,
										exam_centre_code:exam_centre_code,
									};
									var addbuttonCode3= 1;
									var centerAddressMaster = $('#tblCenterAddressMaster').dataTable({
										"ajax":
										{
											"url": base_url+"/ajax_controller/get_admit_genericData",
											"type": "POST",
											"data": data,
										},  
										"bPaginate": true,
								        "bLengthChange": true,
								        "bFilter": true,
								        "bSort": true,
								        "bInfo": true,
										"bDestroy" : true,
								        "bAutoWidth": false,
									        "initComplete": function( settings, json ) {
											    if(centerAddressMaster.fnGetData().length > 0){
													$("div.addbuttonCode").hide();
												}else{
													$("div.addbuttonCode").show();
												}
											},
										"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 addbuttonCode' >>><'col-xs-6'p>>",
										"aoColumns": [
									                     { "sName": "Slno","sWidth": "5%" },
														 { "sName": "program_code","bVisible":false },
														 { "sName": "admit_card_available_from","sWidth": "10%" },
														 { "sName": "admit_card_available_upto","sWidth": "10%","mRender": function( data, type, full ) { 
													           if(full.length > 0){
															   		$("div.addbuttonCode").hide();
															   }
														         return data;
														    }
														},
														 { "sName": "instruction","bVisible":false },
														 { "sName": "controller_name"},
														 { "sName": "controller_mobile_no" },
														 { "sName": "controller_email" },
														 { "sName": "controller sign","bVisible":false },
														 
														 { "sName": "reporting_time"},
														 { "sName": "exam_start_time"},
														 { "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "10%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEdit' onclick='edit(event);'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
								        			],
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
									
									if ( addbuttonCode3 == 1 ) {
									    $("div.addbuttonCode").html('<button id="btnAddCentreAddress" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
									}
									//$("div.addbuttonCode").html('<button id="btnAddCentreAddress" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
									$('#btnAddCentreAddress').click(function(){
		
											//alert("hello");return;
											var program_code = $("#cmbProgramFilter").val();
											var institutedata = {
												program_code:program_code
											};
												
												$.ajax({
													url:base_url+"/ajax_controller/get_admitcard_date",
													type:"post",
													data:institutedata,
													success:function(response)
													{  
														var options = "<option value =''>Select Round</option>";					
														var res1 = JSON.parse(response);
														if(res1.admitcard_start_date != '01-01-1970'){
															$("#txtAvailableFrom").val(res1.admitcard_start_date);
															$("#txtAvailableUpto").val(res1.admitcard_end_date);		
														}
																			
														
													},
													error:function()
													{
														toastr.error("We are unable to Process.Please contact Support");
													}
												});
											$.ajax({
												url:base_url+"ajax_controller/exam_venue_data",
												type:"post",
												data:institutedata,
												success:function(response)
												{
													
													var obj = jQuery.parseJSON(response);
													$('#txtExamVanueCode').val(obj.exam_vanue_code);
												},  
												error:function()
												{
													toastr.error('Unable to process please contact support');
												}
											});
											CKEDITOR.instances['taExamSchedule'].setData("");
											CKEDITOR.instances['txtExamInstructions'].setData("");
											$('#frmAddCentreAddress').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
											$('#txtExamVanue').val("");
											//$('#txtExamRound').val("");
											var cmbExamCentre = $("#cmbExamCentre").val();
											$('#cmbExamCentreAdd').val(cmbExamCentre);
											$('#txtCapacity').val("");
											$('#txtCentreAddress').val("");
											$('#txtExamInstructions').val("");
											$('#fileControllerSignature').val("");
											$('#cmbStatus').val("");
											$('#signatureDisplayarea').attr('src', '');
											$('#centreAddressAddModal').modal('show');
											$("#hidOperTypeCentreAdd").val("add_centre");
											$('#centreAddressAddModal').on('shown.bs.modal', function () 
											{ 
												$('#txtExamCentreCode').focus(); // Focusing the textbox
											})
										});
									$('#sbtnExcel').click(function(){
											window.open(base_url+"/Admin/excel_admitcard_setup");
									});
									//$("div.institutegroupbutton").html('<button id="sbtnExcel" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
									//$("div.institutegroupbutton").html('<button type="submit"  class="btn btn-success" id="sbtnExcel" name="sbtnExcel">Excel</button>);
	
								}
								else{
									var data = {
										program_code:program_code,
										exam_centre_code:exam_centre_code,
									};
									var addbuttonCode4 = 1;
									var centerAddressMaster = $('#tblCenterAddressMaster').dataTable({
										"ajax":
										{
											"url": base_url+"/ajax_controller/get_admit_genericData",
											"type": "POST",
											"data": data,
										},  
										"bPaginate": true,
								        "bLengthChange": true,
								        "bFilter": true,
								        "bSort": true,
								        "bInfo": true,
										"bDestroy" : true,
								        "bAutoWidth": false,
									        "initComplete": function( settings, json ) {
											    if(centerAddressMaster.fnGetData().length > 0){
													$("div.addbuttonCode").hide();
												}else{
													$("div.addbuttonCode").show();
												}
											},
										//"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9'><'col-xs-3'p>>",
										"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 addbuttonCode' >>><'col-xs-6'p>>",
										/*"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addbuttonCode' >>><'col-xs-6'p>>", */
										"aoColumns": [
									                 { "sName": "Slno","sWidth": "5%" },
													 { "sName": "program_code","bVisible":false },
													 { "sName": "admit_card_available_from","sWidth": "10%" },
													 { "sName": "admit_card_available_upto","sWidth": "10%","mRender": function( data, type, full ) { 
												           if(full.length > 0){
														   		$("div.addbuttonCode").hide();
														   }
													         return data;
													    }
													},
													 { "sName": "instruction","bVisible":false },
													 { "sName": "controller_name"},
													 { "sName": "controller_mobile_no" },
													 { "sName": "controller_email" },
													 { "sName": "controller sign","bVisible":false },
													 
													 { "sName": "reporting_time"},
													 { "sName": "exam_start_time"},
													 { "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "10%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEdit' onclick='edit(event);'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
								        			],
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
									if ( addbuttonCode4 == 1) {
									    $("div.addbuttonCode").html('<button id="btnAddCentreAddress" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
									}
									//$("div.addbuttonCode").html('<button id="btnAddCentreAddress" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
									$('#btnAddCentreAddress').click(function(){
		
											//alert("hello");return;
											var program_code = $("#cmbProgramFilter").val();
											var institutedata = {
												program_code:program_code
											};
												
												$.ajax({
													url:base_url+"/ajax_controller/get_admitcard_date",
													type:"post",
													data:institutedata,
													success:function(response)
													{  
														var options = "<option value =''>Select Round</option>";					
														var res1 = JSON.parse(response);
														if(res1.admitcard_start_date != '01-01-1970'){
															$("#txtAvailableFrom").val(res1.admitcard_start_date);
															$("#txtAvailableUpto").val(res1.admitcard_end_date);		
														}
																				
														
													},
													error:function()
													{
														toastr.error("We are unable to Process.Please contact Support");
													}
												});
											$.ajax({
												url:base_url+"ajax_controller/exam_venue_data",
												type:"post",
												data:institutedata,
												success:function(response)
												{
													
													var obj = jQuery.parseJSON(response);
													$('#txtExamVanueCode').val(obj.exam_vanue_code);
												},  
												error:function()
												{
													toastr.error('Unable to process please contact support');
												}
											});
											CKEDITOR.instances['taExamSchedule'].setData("");
											CKEDITOR.instances['txtExamInstructions'].setData("");
											$('#frmAddCentreAddress').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
											$('#txtExamVanue').val("");
											var cmbExamCentre = $("#cmbExamCentre").val();
											$('#cmbExamCentreAdd').val(cmbExamCentre);
											//$('#txtExamRound').val("");
											$('#txtCapacity').val("");
											$('#txtCentreAddress').val("");
											$('#txtExamInstructions').val("");
											$('#fileControllerSignature').val("");
											$('#cmbStatus').val(""); 
											$('#signatureDisplayarea').attr('src', '');
											$('#centreAddressAddModal').modal('show');
											$("#hidOperTypeCentreAdd").val("add_centre");
											$('#centreAddressAddModal').on('shown.bs.modal', function () 
											{ 
												$('#txtExamCentreCode').focus(); // Focusing the textbox
											})
										});
									$('#sbtnExcel').click(function(){
											window.open(base_url+"/Admin/excel_admitcard_setup");
									});
								}
								$('#hidExamCentreCode').val(exam_centre_code);
								//$('#hidExamCentreCodeEdit').val(exam_centre_code);
								
							},
							error:function(){
								toastr.error("We are unable to Process.Please contact Support");
							}
						});
						var institutedata = {
							program_code:program_code
						};
						$.ajax({
							url:base_url+"/ajax_controller/get_apply_date_admit_setup",
							type:"post",
							data: institutedata,
							success:function(response){ 
								var res1 = JSON.parse(response);
								$.each(res1.aaData,function(i,data){
									var date = data.apply_end_date;	
									var startDate = new Date(date);
								});	
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
	});

	$("#cmbProgramFilter").change(function(){
		var program_code = $("#cmbProgramFilter").val();
		$('#hidProgramCode').val(program_code);
		$('#hidProgramCodeEdit').val(program_code);
		if(program_code != '')
		{
			$("#spanProcessingProgram").show();
			var institutedata = {
				program_code : program_code
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
			$.ajax({
				url:base_url+"/ajax_controller/get_admitcard_date",
				type:"post",
				data:institutedata,
				success:function(response)
				{  
					var options = "<option value =''>Select Round</option>";					
					var res1 = JSON.parse(response);
					if(res1.admitcard_start_date != '01-01-1970'){
						$("#txtAvailableFrom").val(res1.admitcard_start_date);
						$("#txtAvailableUpto").val(res1.admitcard_end_date);		
					}
										
					
				},
				error:function()
				{
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
			var institutedata = {
				program_code : program_code
			}
			$.ajax({
				url:base_url+"/ajax_controller/get_exam_centre_admit_setup",
				type:"post",
				data : institutedata,
				success:function(response){ 
					$("#spanProcessingProgram").hide(); 
					var options = "<option value =''>Select</option>";
					var res1 = JSON.parse(response);
					$.each(res1.aaData,function(i,data){
						options = options + "<option value="+data.exam_centre_code+">"+data.exam_centre_name+"</option>";
					});
					$('#cmbExamCentre').html("");   //campusid from academicPeriod
					$('#cmbExamCentre').append(options);
					$('#cmbExamCentreAdd').html("");   //campusid from academicPeriod
					$('#cmbExamCentreAdd').append(options);
					var exam_centre_code = $('#cmbExamCentre').val();
					
					if(exam_centre_code != ''){
						var data = {
							program_code:program_code,
							exam_centre_code:exam_centre_code,
						};
						var addbuttonCode5 = 1;
						var centerAddressMaster = $('#tblCenterAddressMaster').dataTable({
							"ajax":
							{
								"url": base_url+"/ajax_controller/get_admit_genericData",
								"type": "POST",
								"data": data,
							},  
							"bPaginate": true,
					        "bLengthChange": true,
					        "bFilter": true,
					        "bSort": true,
					        "bInfo": true,
							"bDestroy" : true,
					        "bAutoWidth": false,
					        "initComplete": function( settings, json ) {
								if(centerAddressMaster.fnGetData().length > 0){
									$("div.addbuttonCode").hide();
								}else{
									$("div.addbuttonCode").show();
								}
							},
							"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 addbuttonCode' >>><'col-xs-6'p>>",
							"aoColumns": [
						                     { "sName": "Slno","sWidth": "5%" },
											 { "sName": "program_code","bVisible":false },
											 { "sName": "admit_card_available_from","sWidth": "10%" },
											 { "sName": "admit_card_available_upto","sWidth": "10%","mRender": function( data, type, full ) { 
										           if(full.length > 0){
												   		$("div.addbuttonCode").hide();
												   }
											         return data;
											    }
											},
											 { "sName": "instruction","bVisible":false },
											 { "sName": "controller_name"},
											 { "sName": "controller_mobile_no" },
											 { "sName": "controller_email" },
											 { "sName": "controller sign","bVisible":false },
											 
											 { "sName": "reporting_time"},
											 { "sName": "exam_start_time"},
											 { "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "10%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEdit' onclick='edit(event);'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
					        			],
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
						if ( addbuttonCode5 == 1 ) {
						    $("div.addbuttonCode").html('<button id="btnAddCentreAddress" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
						}	
						$('#btnAddCentreAddress').click(function(){

							//alert("hello");return;
							var program_code = $("#cmbProgramFilter").val();
							var institutedata = {
								program_code:program_code
							};
								
								$.ajax({
									url:base_url+"/ajax_controller/get_admitcard_date",
									type:"post",
									data:institutedata,
									success:function(response)
									{  
										var options = "<option value =''>Select Round</option>";					
										var res1 = JSON.parse(response);
										if(res1.admitcard_start_date != '01-01-1970'){
											$("#txtAvailableFrom").val(res1.admitcard_start_date);
											$("#txtAvailableUpto").val(res1.admitcard_end_date);		
										}
														
										
									},
									error:function()
									{
										toastr.error("We are unable to Process.Please contact Support");
									}
								});
							$.ajax({
								url:base_url+"ajax_controller/exam_venue_data",
								type:"post",
								data:institutedata,
								success:function(response)
								{
									
									var obj = jQuery.parseJSON(response);
									$('#txtExamVanueCode').val(obj.exam_vanue_code);
								},  
								error:function()
								{
									toastr.error('Unable to process please contact support');
								}
							});
							//CKEDITOR.instances['taExamSchedule'].setData("");
							CKEDITOR.instances['txtExamInstructions'].setData("");
							$('#frmAddCentreAddress').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
							$('#txtExamVanue').val("");
							//$('#txtExamRound').val("");
							var cmbExamCentre = $("#cmbExamCentre").val();
							$('#cmbExamCentreAdd').val(cmbExamCentre);
							$('#txtCapacity').val("");
							$('#txtCentreAddress').val("");
							$('#txtExamInstructions').val("");
							$('#fileControllerSignature').val("");
							$('#cmbStatus').val("");
							$('#signatureDisplayarea').attr('src', '');
							$('#centreAddressAddModal').modal('show');
							$("#hidOperTypeCentreAdd").val("add_centre");
							$('#centreAddressAddModal').on('shown.bs.modal', function () 
							{ 
								$('#txtExamCentreCode').focus(); // Focusing the textbox
							})
						});
						$('#sbtnExcel').click(function(){
								window.open(base_url+"/Admin/excel_admitcard_setup");
						});			
					}
					else{
						var data = {
							program_code:program_code,
							exam_centre_code:exam_centre_code,
						};
						var addbuttonCode6 = 1;
						var centerAddressMaster = $('#tblCenterAddressMaster').dataTable({
							"ajax":
							{
								"url": base_url+"/ajax_controller/get_admit_genericData",
								"type": "POST",
								"data": data,
							},  
							"bPaginate": true,
					        "bLengthChange": true,
					        "bFilter": true,
					        "bSort": true,
					        "bInfo": true,
							"bDestroy" : true,
					        "bAutoWidth": false,
					        "initComplete": function( settings, json ) {
					        	if(centerAddressMaster.fnGetData().length > 0){
									$("div.addbuttonCode").hide();
								}else{
									$("div.addbuttonCode").show();
								}
							},
							"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 addbuttonCode' >>><'col-xs-6'p>>",
							"aoColumns": [
						                     { "sName": "Slno","sWidth": "5%" },
											 { "sName": "program_code","bVisible":false },
											 { "sName": "admit_card_available_from","sWidth": "10%" },
											 { "sName": "admit_card_available_upto","sWidth": "10%","mRender": function( data, type, full ) { 
										           if(full.length > 0){
												   		$("div.addbuttonCode").hide();
												   }
											         return data;
											    }
											},
											 { "sName": "instruction","bVisible":false },
											 { "sName": "controller_name"},
											 { "sName": "controller_mobile_no" },
											 { "sName": "controller_email" },
											 { "sName": "controller sign","bVisible":false },
											 
											 { "sName": "reporting_time"},
											 { "sName": "exam_start_time"},
											 { "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "10%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEdit' onclick='edit(event);'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
					        			],
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
						if ( addbuttonCode6 == 1 ) {
						    $("div.addbuttonCode").html('<button id="btnAddCentreAddress" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
						}
						//$("div.addbuttonCode").html('<button id="btnAddCentreAddress" onclick="add_news_events()" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
						$('#btnAddCentreAddress').click(function(){
		
							//alert("hello");return;
							var program_code = $("#cmbProgramFilter").val();
							var institutedata = {
								program_code:program_code
							};
								
								$.ajax({
									url:base_url+"/ajax_controller/get_admitcard_date",
									type:"post",
									data:institutedata,
									success:function(response)
									{  
										var options = "<option value =''>Select Round</option>";					
										var res1 = JSON.parse(response);
										if(res1.admitcard_start_date != '01-01-1970'){
											$("#txtAvailableFrom").val(res1.admitcard_start_date);
										}
										if(res1.admitcard_end_date != '01-01-1970'){
											$("#txtAvailableUpto").val(res1.admitcard_end_date);
										}										
										
									},
									error:function()
									{
										toastr.error("We are unable to Process.Please contact Support");
									}
								});
							$.ajax({
								url:base_url+"ajax_controller/exam_venue_data",
								type:"post",
								data:institutedata,
								success:function(response)
								{
									
									var obj = jQuery.parseJSON(response);
									$('#txtExamVanueCode').val(obj.exam_vanue_code);
								},  
								error:function()
								{
									toastr.error('Unable to process please contact support');
								}
							});
							CKEDITOR.instances['taExamSchedule'].setData("");
							CKEDITOR.instances['txtExamInstructions'].setData("");
							$('#frmAddCentreAddress').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
							$('#txtExamVanue').val("");
							//$('#txtExamRound').val("");
							var cmbExamCentre = $("#cmbExamCentre").val();
							$('#cmbExamCentreAdd').val(cmbExamCentre);
							$('#txtCapacity').val("");
							$('#txtCentreAddress').val("");
							$('#txtExamInstructions').val("");
							$('#fileControllerSignature').val("");
							$('#cmbStatus').val("");
							$('#signatureDisplayarea').attr('src', '');
							$('#centreAddressAddModal').modal('show');
							$("#hidOperTypeCentreAdd").val("add_centre");
							$('#centreAddressAddModal').on('shown.bs.modal', function () 
							{ 
								$('#txtExamCentreCode').focus(); // Focusing the textbox
							})
						});
						$('#sbtnExcel').click(function(){
								window.open(base_url+"/Admin/excel_admitcard_setup");
						});			
					}
					$('#hidExamCentreCode').val(exam_centre_code);
					//$('#hidExamCentreCodeEdit').val(exam_centre_code);
					
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		}
	});
	
	
	function readURLSig(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#signatureDisplayarea').attr('src', e.target.result);
				$("#signatureDisplayarea").attr('height','100');
				$("#signatureDisplayarea").attr('width','100');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
	function readURLSigEdit(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#signatureDisplayareaEdit').attr('src', e.target.result);
				$("#signatureDisplayareaEdit").attr('height','100');
				$("#signatureDisplayareaEdit").attr('width','100');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#signatureDisplayarea').attr('src','');
	$("#signatureDisplayarea").attr('height','0');
	$("#signatureDisplayarea").attr('width','0');
	$('#fileControllerSignature').change(function()			
	{ 
		var file = document.getElementById("fileControllerSignature").files[0];
		var sFileName = file.name;
        var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
        var iFileSize = file.size;
        if (sFileExtension == "jpg" || sFileExtension == "jpeg" || sFileExtension == "png" )
		{ 
			if(iFileSize <= 204800)
			{
			  document.getElementById("signMessage").innerHTML="";
			  readURLSig(this);
			}
			else
			{
				document.getElementById("signMessage").innerHTML="File size exceeds 200 KB";
				$('#fileControllerSignature').val("");
				$('#signatureDisplayarea').attr('src','');
				$("#signatureDisplayarea").attr('height','0');
				$("#signatureDisplayarea").attr('width','0');
			}
        }
		else
		{
			document.getElementById("signMessage").innerHTML="Invalid File Format";
			$('#fileControllerSignature').val("");
			$('#signatureDisplayarea').attr('src','');
			$("#signatureDisplayarea").attr('height','0');
			$("#signatureDisplayarea").attr('width','0');
		}
	});
	$('#fileControllerSignatureEdit').change(function()			
	{ 
		var file = document.getElementById("fileControllerSignatureEdit").files[0];
		var sFileName = file.name;
        var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
        var iFileSize = file.size;
        if (sFileExtension == "jpg" || sFileExtension == "jpeg" || sFileExtension == "png" )
		{ 
			if(iFileSize <= 204800)
			{
			  document.getElementById("signMessageEdit").innerHTML="";
			  readURLSigEdit(this);
			}
			else
			{
				document.getElementById("signMessageEdit").innerHTML="File size exceeds 200 KB";
				$('#fileControllerSignatureEdit').val("");
				$('#signatureDisplayareaEdit').attr('src','');
				$("#signatureDisplayareaEdit").attr('height','0');
				$("#signatureDisplayareaEdit").attr('width','0');
			}
        }
		else
		{
			document.getElementById("signMessageEdit").innerHTML="Invalid File Format";
			$('#fileControllerSignatureEdit').val("");
			$('#signatureDisplayareaEdit').attr('src','');
			$("#signatureDisplayareaEdit").attr('height','0');
			$("#signatureDisplayareaEdit").attr('width','0');
		}
	});
/*	var exam_centre_code = $("#cmbExamCentre").val();
	var program_code = $("#cmbProgramFilter").val();*/
	/*function add_news_events(){
		
	}*/
	
	/*$('#sbtnExcel').click(function(){
		window.open(base_url+"/Admin/excel_admitcard_setup");
	});*/
	$("#cmbExamCentre").change(function(){
		var exam_centre_code = $("#cmbExamCentre").val();
		var program_code = $("#cmbProgramFilter").val();
		$('#hidProgramCode').val(program_code);
		$('#hidExamCentreCode').val(exam_centre_code);
		$('#hidProgramCodeEdit').val(program_code);
		//$('#hidExamCentreCodeEdit').val(exam_centre_code);
		if(exam_centre_code !='')
		{
			var data = {
				program_code:program_code,
				exam_centre_code:exam_centre_code,
			};
			var addbuttonCode7 = 1;
			var centerAddressMaster = $('#tblCenterAddressMaster').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/get_admit_genericData",
					"type": "POST",
					"data": data,
				},  
				"bPaginate": true,
		        "bLengthChange": true,
		        "bFilter": true,
		        "bSort": true,
		        "bInfo": true,
				"bDestroy" : true,
		        "bAutoWidth": false,
		        "initComplete": function( settings, json ) {
					if(centerAddressMaster.fnGetData().length > 0){
						$("div.addbuttonCode").hide();
					}else{
						$("div.addbuttonCode").show();
					}
				},
				"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 addbuttonCode' >>><'col-xs-6'p>>",
				"aoColumns": [
			                    { "sName": "Slno","sWidth": "5%" },
								 { "sName": "program_code","bVisible":false },
								 { "sName": "admit_card_available_from","sWidth": "10%" },
								 { "sName": "admit_card_available_upto","sWidth": "10%","mRender": function( data, type, full ) { 
							           if(full.length > 0){
									   		$("div.addbuttonCode").hide();
									   }
								         return data;
								    }
								},
								 { "sName": "instruction","bVisible":false },
								 { "sName": "controller_name"},
								 { "sName": "controller_mobile_no" },
								 { "sName": "controller_email" },
								 { "sName": "controller sign","bVisible":false },
								 
								 { "sName": "reporting_time"},
								 { "sName": "exam_start_time"},
								 { "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "10%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEdit' onclick='edit(event);'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
		        			],
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
			//$("div.addbuttonCode").html('<button id="btnAddCentreAddress" onclick="add_news_events()" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
			if ( addbuttonCode7 == 1 ) {
			    $("div.addbuttonCode").html('<button id="btnAddCentreAddress" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
			}
			$('#btnAddCentreAddress').click(function(){

				//alert("hello");return;
				var program_code = $("#cmbProgramFilter").val();
				var institutedata = {
					program_code:program_code
				};
					
					$.ajax({
						url:base_url+"/ajax_controller/get_admitcard_date",
						type:"post",
						data:institutedata,
						success:function(response)
						{  
							var options = "<option value =''>Select Round</option>";					
							var res1 = JSON.parse(response);
							if(res1.admitcard_start_date != '01-01-1970'){
								$("#txtAvailableFrom").val(res1.admitcard_start_date);
							}
							if(res1.admitcard_end_date != '01-01-1970'){
								$("#txtAvailableUpto").val(res1.admitcard_end_date);
							}										
							
						},
						error:function()
						{
							toastr.error("We are unable to Process.Please contact Support");
						}
					});
				$.ajax({
					url:base_url+"ajax_controller/exam_venue_data",
					type:"post",
					data:institutedata,
					success:function(response)
					{
						
						var obj = jQuery.parseJSON(response);
						$('#txtExamVanueCode').val(obj.exam_vanue_code);
					},  
					error:function()
					{
						toastr.error('Unable to process please contact support');
					}
				});
				CKEDITOR.instances['taExamSchedule'].setData("");
				CKEDITOR.instances['txtExamInstructions'].setData("");
				$('#frmAddCentreAddress').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
				$('#txtExamVanue').val("");
				//$('#txtExamRound').val("");
				var cmbExamCentre = $("#cmbExamCentre").val();
				$('#cmbExamCentreAdd').val(cmbExamCentre);
				$('#txtCapacity').val("");
				$('#txtCentreAddress').val("");
				$('#txtExamInstructions').val("");
				$('#fileControllerSignature').val("");
				$('#cmbStatus').val("");
				$('#signatureDisplayarea').attr('src', '');
				$('#centreAddressAddModal').modal('show');
				$("#hidOperTypeCentreAdd").val("add_centre");
				$('#centreAddressAddModal').on('shown.bs.modal', function () 
				{ 
					$('#txtExamCentreCode').focus(); // Focusing the textbox
				})
			});
			$('#sbtnExcel').click(function(){
					window.open(base_url+"/Admin/excel_admitcard_setup");
			});		
			
		}
    });
	$('#txtExamVanueCode').on("blur",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtExamVanueCode:$(event.target).val(),
				program_code:$("#cmbProgramFilter").val(),
				exam_centre:$("#cmbExamCentre").val(),
				txtExamVanueCode:$(event.target).val(),
				validatevanuecode:true
			};
		   //ajax call to server
			$.ajax({
				url:base_url+"/ajax_controller/chk_duplicate_admit_setup",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var res = JSON.parse(response); 
					if(res.status >= '1')
					{
						$(event.target).val("");
					 	$('#frmAddCentreAddress').data('bootstrapValidator').updateStatus('txtExamVanueCode', 'INVALID', null);
						toastr.error('Venue Code Already Used for this Program');
						$(event.target).focus();
					}
					else
					{
						return false;
					}
				},  
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			}); 
		}
	});
	$('#frmAddCentreAddress').bootstrapValidator({
		/*excluded: [':disabled'], */
		message: 'This value is not valid',
        feedbackIcons: 
        {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			var value = CKEDITOR.instances['txtExamInstructions'].getData();
			//var schedule = CKEDITOR.instances['taExamSchedule'].getData();
			for ( instance in CKEDITOR.instances )
       			CKEDITOR.instances[instance].updateElement();
			if(value == ''){
				toastr.error("Please Enter Instructions");
				$("#centreaddsave").attr("disabled",false);
			}
			else{
				$("#spanProcessingSetup").show();
				var formData = new FormData(document.getElementById("frmAddCentreAddress"));
				//ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/Add_admit_generic_setup",
					type:"post",
					enctype: 'multipart/form-data',
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response)
					{  
						var result = JSON.parse(response);
						if(result.status=='SUCCESS')
						{
							$("#spanProcessingSetup").hide();
							$("div.addbuttonCode").hide();
							//$("#spanProcessingInstitute").hide();
							$('#centreAddressAddModal').modal('hide');
							var dtblCentreAddress = $("#tblCenterAddressMaster").DataTable();
						 	dtblCentreAddress.ajax.reload();
							toastr.success(result.msg);	
							var program_code = $("#cmbProgramFilter").val();
							var institutedata = {
								program_code:program_code
							};
							$.ajax({
								url:base_url+"ajax_controller/exam_venue_data",
								type:"post",
								data:institutedata,
								success:function(response)
								{
									var obj = jQuery.parseJSON(response);
									$('#txtExamVanueCode').val(obj.exam_vanue_code);
								},  
								error:function()
								{
									toastr.error('Unable to process please contact support');
								}
							});
						}
						else
						{
							toastr.error(result.msg);
							$("#spanProcessingSetup").hide();
							//$("#spanProcessingInstitute").hide();
							$('#centreAddressAddModal').modal('hide');
							var dtblCentreAddress = $("#tblCenterAddressMaster").DataTable();
						 	dtblCentreAddress.ajax.reload();
						}
					},
					error:function()
					{
						toastr.error('We are unable to process please contact support');	
					}
				});
			}
			//$("#spanProcessinginstitute").show();
			
		},
        fields: {
			cmbExamCentreAdd: {
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
			txtExamVanueCode: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			cmbRound: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			fileControllerSignature: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			txtExamInstructions: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			/*cmbTemplate: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},*/
			txtExamVanue: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			txtCapacity: {
                validators: {
					notEmpty: {
							message: 'Required'
						},
					digits: {
						message:'This should be a number'
					}
				}
			},
			txtExamCenterAddress: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			taExamSchedule: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			txtAvailableFrom: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			txtAvailableUpto: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			txtControllerName: {
                validators: {
					notEmpty: {
						message: 'Required'
					},
					regexp: {
						regexp: /^([a-zA-Z. ]+)$/,
						message: "Only Alphabet and (.) are allowed"
						},
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
			txtControllerMobileNo: {
                validators: {
					notEmpty: {
						message: 'Required'
					},
					integer: {
							message: 'The value can contain only numbers'
						}, 
					stringLength: {
						max: 10,
						min: 10,
						message: 'Phone no must be 10 characters'
					}
				}
			},
			txtControllerEmail: {
                validators: {
					notEmpty: {
						message: 'Required'
					},
					emailAddress: {
						message: 'The input is not a valid email address'
					}
				}
			},
			cmbStatus: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			cmbSession: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			txtDate: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			txtReportingTime: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			txtStartTime: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			txtExamStartTime: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			
		}
	});
	/* CODE FOR TOOLTIP */
	$('.tooltips').tooltipster({
		theme: 'tooltipster-punk',
		animation: 'grow',
        delay: 200, 
        touchDevices: false,
        trigger: 'hover'
     });	
	/* END OF TOOLTIP */
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
	/* END OF CODE FOR TOASTR*/	
		
	$('#txtAvailableFrom').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
    });
    
    $('#txtDate').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
    }).datepicker('setStartDate', new Date());
	$("#txtAvailableFrom").datepicker()
	.on('show', function(ev){                 
      	var today = new Date();
      	var t = today.getDate() + "-" + today.getMonth() + "-" + today.getFullYear();
      	$('#datepicker').data({date: t}).datepicker('update');
	})
	.on('changeDate', function (selected) {
		var startDate = new Date(selected.date.valueOf());
		$('#txtAvailableUpto').datepicker('setStartDate', startDate);
		$('#frmAddCentreAddress').data('bootstrapValidator').updateStatus('txtAvailableFrom', 'VALIDATED').validateField('txtAvailableFrom');
	}).on('changeDate', function () {
		
 	})
	.on('clearDate', function (selected) {
		$('#txtAvailableUpto').datepicker('setStartDate', null);
	});
		
		//$('#txtAvailableFrom').datepicker('setDate', today);
		/*.datepicker('setDate',function() {
		    var ishaveDate = $('#txtAvailableFrom').datepicker().children('input').val();
		    return ishaveDate != null ? ishaveDate : today;
		})*/;
		
	$('#txtAvailableUpto').datepicker({
	    format: "dd-mm-yyyy",
		startDate: $('#txtAvailableFrom').val(),
		todayHighlight:true,
		autoclose:true
    })
    
    .on('changeDate', function (selected) {
  		var endDate = new Date(selected.date.valueOf());
  		$('#txtAvailableFrom').datepicker('setEndDate', endDate);
  		$('#frmAddCentreAddress').data('bootstrapValidator').updateStatus('txtAvailableUpto', 'VALIDATED').validateField('txtAvailableUpto');
 	})
 	.on('clearDate', function (selected) {
 		$('#txtAvailableFrom').datepicker('setEndDate', null);
 	});
	
});
function edit(event)
{
	var session = $('#hidSessionCode').val();
	$("#hidOperTypeCentreEdit").val("edit_centre");
	var oTable = $('#tblCenterAddressMaster').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	else
  		row = event.target.parentNode;
  	
	document.getElementById("signMessageEdit").innerHTML="";
  	var program_code = $("#cmbProgramFilter").val();	
  	var exam_centre_code = oTable.fnGetData(row)['exam_center_code'];
  	var centre_code = oTable.fnGetData(row)['exam_centre_name'];
  	var capacity = oTable.fnGetData(row)['capacity'];
	var address = oTable.fnGetData(row)['exam_center_address'];
	var date_from = oTable.fnGetData(row)['admit_card_available_from'];
	var date_to = oTable.fnGetData(row)['admit_card_available_upto'];
	var instructions = oTable.fnGetData(row)['exam_instructions'];
	var controller_signature = oTable.fnGetData(row)['controller_signature'];
	var signature = base_url+"public/assets/images/logo/"+controller_signature;
	$('#signatureDisplayareaEdit').attr('src', signature);
	$("#signatureDisplayareaEdit").attr('height','100');
	$("#signatureDisplayareaEdit").attr('width','100');
	//$(event.target.parentNode).addClass('success');
	$('#hidExamCentreCodeEdit').val(exam_centre_code);
	$('#cmbExamCentreEdit').val(centre_code);
	$('#txtCapacityEdit').val(capacity);//GETTING VALUE FOR HIDDEN COLUMN
	$('#txtCentreAddressEdit').val(address);
	$('#txtAvailableFromEdit').val(date_from);
	$('#txtAvailableUptoEdit').val(date_to);
	//$('#txtTimeToEdit').val(time_to);
	/*$('#txtAvailableFromEdit').val(date_from);
	$('#txtAvailableFromEdit').datepicker("setDate", date_from ).datepicker('update');
	$('#txtAvailableUptoEdit').val(date_to);
	$('#txtAvailableUptoEdit').datepicker("setDate", date_to ).datepicker('update');*/
	$('#txtExamInstructionsEdit').val(instructions);
	CKEDITOR.instances['txtExamInstructionsEdit'].setData(instructions);
	//$('#fileControllerSignatureEdit').val(controller_signature);
	$('#cmbProgramCodeEdit').val(oTable.fnGetData(row)['program_code']);
	//alert(event.target.parentNode.cells[2].innerHTML);
	$('#txtControllerNameEdit').val(oTable.fnGetData(row)['controller_name']);
	$('#txtControllerMobileNoEdit').val(oTable.fnGetData(row)['controller_mobile_no']);
	$('#txtControllerEmailEdit').val(oTable.fnGetData(row)['controller_email']);
	$('#txtExamVanueEdit').val(oTable.fnGetData(row)['exam_vanue']);
	$('#txtExamRoundEdit').val(oTable.fnGetData(row)['round']);
	$('#hidUniqueidEdit').val(oTable.fnGetData(row)['exam_vanue_code']);
	$('#taExamScheduleEdit').val(oTable.fnGetData(row)['exam_schedule']);
	$('#cmbTemplateEdit').val(oTable.fnGetData(row)['template_code']);
	$('#cmbStatusEdit').val(oTable.fnGetData(row)['record_status']);
	$('#cmbSessionEdit').val(oTable.fnGetData(row)['exam_shift']);
	$('#txtDateEdit').val(oTable.fnGetData(row)['examination_date']);
	$('#txtReportingTimeEdit').val(oTable.fnGetData(row)['reporting_time']);
	$('#txtStartTimeEdit').val(oTable.fnGetData(row)['gate_closing_time']);
	$('#txtExamStartTimeEdit').val(oTable.fnGetData(row)['exam_start_time']);
//	CKEDITOR.instances['taExamScheduleEdit'].setData(oTable.fnGetData(row)['exam_schedule']);
	$('#txtExamRoundEdit').attr('readonly',true);
	//$('#txtExamCentreNameEdit').val(event.target.parentNode.cells[4].innerHTML);
	
	/*var selectedText2 = oTable.fnGetData(row)['record_status'];
	alert(selectedText2);
	$("#cmbStatusEdit option").each(function () 
	{
		if ($(this).html() == selectedText2)
	 	{
			$(this).attr("selected", "selected");
			return;
		}
	});*/
	
  	$('#centreAddressEditModal').modal('show');	
	
	$('#frmEditCentreAddress').bootstrapValidator({
		/* excluded: [':disabled'], */
		message: 'This value is not valid',
        feedbackIcons: 
        {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingSetupEdit").show();
			for ( instance in CKEDITOR.instances )
       			CKEDITOR.instances[instance].updateElement();
       		var value = CKEDITOR.instances['txtExamInstructionsEdit'].getData();
			if(value == ''){
				toastr.error("Please Enter Instructions");
				$("#centreeditsave").attr("disabled",false);
			}
			else{
			$('#centreAddressEditModal').modal('hide');	
				var formData = new FormData(document.getElementById("frmEditCentreAddress"));
				//ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/Update_admit_generic_setup",
					type:"post",
					enctype: 'multipart/form-data',
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response)
					{  
						var result = JSON.parse(response);
						if(result.status=='SUCCESS')
						{
							$("#spanProcessingSetupEdit").hide();
							$('#centreAddresseDITModal').modal('hide');
							document.getElementById("signMessageEdit").innerHTML="";
							$('#frmEditCentreAddress').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal
							var dtblCentreAddress = $("#tblCenterAddressMaster").DataTable();
						 	dtblCentreAddress.ajax.reload();
							toastr.success(result.msg);	
						}
						else
						{
							$("#spanProcessingSetupEdit").hide();
							$('#centreAddresseDITModal').modal('hide');
							var dtblCentreAddress = $("#tblCenterAddressMaster").DataTable();
						 	dtblCentreAddress.ajax.reload();
							toastr.error(result.msg);
							document.getElementById("signMessageEdit").innerHTML="";
							$('#frmEditCentreAddress').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
						}
					},
					error:function()
					{
						toastr.error('We are unable to process please contact support');	
					}
				});
			}
			
		},
        fields: {
			txtExamVanueEdit: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			txtCapacityEdit: {
                validators: {
					notEmpty: {
							message: 'Required'
						},
					digit: {
						message:'This should be a number'
					}
				}
			},
			txtExamCenterAddressEdit: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			taExamScheduleEdit: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			txtAvailableFromEdit: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			txtAvailableUptoEdit: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			txtExamRoundEdit: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			/*cmbTemplateEdit: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},*/
			txtExamInstructionsEdit: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			txtControllerNameEdit: {
                validators: {
					notEmpty: {
						message: 'Required'
					},
					regexp: {
						regexp: /^([a-zA-Z. ]+)$/,
						message: "Only Alphabet and (.) are allowed"
						},
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
			txtControllerMobileNoEdit: {
                validators: {
					notEmpty: {
						message: 'Required'
					},
					integer: {
							message: 'The value can contain only numbers'
						}, 
					stringLength: {
						max: 10,
						min: 10,
						message: 'Phone no must be 10 characters'
					}
				}
			},
			txtControllerEmailEdit: {
                validators: {
					notEmpty: {
						message: 'Required'
					},
					emailAddress: {
						message: 'The input is not a valid email address'
					}
				}
			},
			cmbStatusEdit: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			cmbSessionEdit: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			txtDateEdit: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			txtReportingTimeEdit: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			txtStartTimeEdit: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
			txtExamStartTimeEdit: {
                validators: {
					notEmpty: {
							message: 'Required'
						}
				}
			},
		}
	});
	
	$('#txtAvailableFromEdit').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
		endDate: $('#txtExamDateEdit').val(),
    })
    .on('changeDate', function (selected) {
		var startDate = new Date(selected.date.valueOf());
  		$('#txtAvailableUptoEdit').datepicker('setStartDate', startDate);
 	})
 	.on('clearDate', function (selected) {
  		$('#txtAvailableUptoEdit').datepicker('setStartDate', null);
 	});
	$('#txtAvailableUptoEdit').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
		startDate: $('#txtAvailableFromEdit').val(),
		endDate: $('#txtExamDateEdit').val(),
    })
    .on('changeDate', function (selected) {
		var endDate = new Date(selected.date.valueOf());
		$('#txtAvailableFromEdit').datepicker('setEndDate', endDate);
 	})
 	.on('clearDate', function (selected) {
  		$('#txtAvailableFromEdit').datepicker('setEndDate', null);
 	});
 	
 	$('#txtDateEdit').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
    }).on('changeDate', function (selected) {
  		$('#frmEditCentreAddress').data('bootstrapValidator').updateStatus('txtDateEdit', 'VALIDATED').validateField('txtDateEdit');
 	}).datepicker('setStartDate', new Date());
}


