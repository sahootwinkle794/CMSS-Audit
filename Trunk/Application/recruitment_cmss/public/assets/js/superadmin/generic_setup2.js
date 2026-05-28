$(document).ready(function(){
	var isDelete_Country= false;
	var isDelete_State= false;
	var isDelete_District= false;
	var isDelete_Nationality= false;
	var isDelete_Board= false;
	var isDelete_Standard= false;
	var isDelete_Qualification= false;
	var isDelete_Registration_Field= false;
	
	var isEdit_Country = false;
	var isEdit_State = false;
	var isEdit_District = false;
	var isEdit_Nationality = false;
	var isEdit_Board = false;
	var isEdit_Standard = false;
	var isEdit_Qualification = false;
	var isEdit_Registration_Field = false;
	MY_SESSION_NAME = '';
	
	
	
	/*********************************************** For Country Tab ************************************************/
	var countryMaster = $('#tblCountryMaster').dataTable({		
		"sAjaxSource": base_url+"ajax_controller/select_country",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 institutegroupbutton' >>><'col-xs-6'p>>",
		"aoColumns": [
	                     { "sName": "Slno","sWidth": "5%" },
	                     { "sName": "Code" },
	                     { "sName": "name" },
	                     { "sName": "id","bVisible":false },
	                     { "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "10%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEditCentre' onclick='countryRow(event,\"edit\")'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<button id='btnDeleteCentre' title='Delete' class='btn btn-danger tooltipTable btn-circle' onclick='countryRow(event,\"delete\")'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}
        			
        			],
					 "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 3 ] }],
					 "fnInitComplete": function(oSettings, json) {
			     		$('.tooltipTable').tooltipster( {
				         	theme: 'tooltipster-punk',
				      		animation: 'grow',
				        	delay: 200, 
				         	touchDevices: false,
				         	trigger: 'hover'
			      		} );          
			  		} 
	});
	/**CREATING BUTTON*****/
	$("div.institutegroupbutton").html('<button id="btnAddCountry" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	/*****END OF BUTTON CREATION******/

	$('#btnAddCountry').click(function(e){
		isEdit_Country = false;	
		isDelete_Country = false;
		
		$("#errorlog_country_add").html("");
		$('#frmCountryAdd').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$(countryMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		$('#txtCountryCode').val("");
		$('#txtCountryName').val("");
		$('#hidOperCountry').val("insert_country");
		$('#countryAddModal').modal('show');
		
		$('#countryAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtCountryCode').focus(); // Focusing the textbox
		})
	});
	
	
	
	//ADD RECORD WITH VALIDATION

	$('#frmCountryAdd').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingCountryAdd").show();
			var formData = new FormData(document.getElementById("frmCountryAdd"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/insert_country",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							$("#errorlog_country_add").html("");
							toastr.success(obj.msg);
							var dtblProgram = $("#tblCountryMaster").DataTable();
				 			dtblProgram.ajax.reload();
				 			$('#frmCountryAdd').data('bootstrapValidator').resetForm(true);	
							//toastr.success('Data Successfully Inserted');				
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_country_add').html(obj.msg);
		                	$('#errorlog_country_add').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_country_add').html(obj.msg);
		                	$('#errorlog_country_add').show();
		                }
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}
					$("#spanProcessingCountryAdd").hide();
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
					txtCountryCode: {							//form input type name
						validators: {
							notEmpty: {
								message: 'This field can\'t left blank'
							},
							regexp: {
								regexp: /^([A-Za-z0-9\s]+)$/i,
								message: "Special characters are not allowed"
							},
							stringLength: {
								max: 8,
								message: 'Code should not be more then 8 characters'
								}
						}
					},
					txtCountryName: {
						validators: {
							notEmpty: {
								message: 'This field can\'t left blank'
							},
							regexp: {
								regexp: /^([A-Za-z\s]+)$/i,
								message: "Only Alphabets are allowed"
							}
						}
					}
					
			}
	} );
	//END OF ADD RECORD WITH VALIDATION
	//EDIT RECORD WITH VALIDATION

	$('#frmCountryEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{	
			$("#spanProcessingCountryEdit").show();
			var formData = new FormData(document.getElementById("frmCountryEdit"));						
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/update_country",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){
					
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							$('#errorlog_country_edit').html("");
							toastr.success(obj.msg);
							$('#countryEditModal').modal('hide'); 
							//Reseting the tick marks before opening add modal
							var dtblProgram = $("#tblCountryMaster").DataTable();
				 			dtblProgram.ajax.reload();	
				 			$('#frmCountryEdit').data('bootstrapValidator').resetForm(true);
				 			isEdit_Country = false;	
							isDelete_Country = false; 			
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_country_edit').html(obj.msg);
		                	$('#errorlog_country_edit').show();
		                	isEdit_Country = false;	
							isDelete_Country = false; 	
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_country_edit').html(obj.msg);
		                	$('#errorlog_country_edit').show();
		                	isEdit_Country = false;	
							isDelete_Country = false; 	
		                }
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}			
					$("#spanProcessingCountryEdit").hide();			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields:{
			txtCountryCodeEdit: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					},
					stringLength: {
						max: 8,
						message: 'Code should not be more then 8 characters'
						}
				}
			},
			txtCountryNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z\s]+)$/i,
						message: "Only Alphabets are allowed"
					}
				}
			}
		}
			
	});
	
	$('#txtCountryCodeEdit').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtCountryCodeEdit:$(event.target).val(),
				validatecountrycode:true,
			};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_country_edit",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
					 	//$('#frmCountryEdit').data('bootstrapValidator').updateStatus('txtCountryCodeEdit', 'INVALID', null);
					 	$('#frmCountryEdit').data('bootstrapValidator').updateStatus('txtCountryCodeEdit', 'NOT_VALIDATED', null).validateField('txtCountryCodeEdit');
						toastr.error('Country Code Already Created');
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
	$('#txtCountryCode').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtCountryCode:$(event.target).val(),
				validatecountrycode:true,
			};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_country_code",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
					 	$('#frmCountryAdd').data('bootstrapValidator').updateStatus('txtCountryCode', 'NOT_VALIDATED', null).validateField('txtCountryCode');
						toastr.error('Country Code Already Created');
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
	
	/*************************************************** For State Tab******************************************/

	var stateMaster = $('#tblStateMaster').dataTable({
		"sAjaxSource": base_url+"ajax_controller/select_state",
		//"sAjaxSource": "generic_setup2_db.php?_s="+MY_SESSION_NAME+"&type=SELECT_STATE",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 groupbutton' >>><'col-xs-6'p>>",
		"aoColumns": [
	                     { "sName": "Slno","sWidth": "5%" },
	                     { "sName": "country name" },
	                     { "sName": "Code" },
	                     { "sName": "name" },
	                     { "sName": "id","bVisible":false },
	                     { "sName": "con_code","bVisible":false },
	                     { "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "10%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEditCentre' onclick='stateRow(event,\"edit\")'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<button id='btnDeleteCentre' title='Delete' class='btn btn-danger tooltipTable btn-circle' onclick='stateRow(event,\"delete\")'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}
        			
        			],
					 "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 3 ] }],
					 "fnInitComplete": function(oSettings, json) {
			     		$('.tooltipTable').tooltipster( {
				         	theme: 'tooltipster-punk',
				      		animation: 'grow',
				        	delay: 200, 
				         	touchDevices: false,
				         	trigger: 'hover'
			      		} );          
			  		} 
	});
	/**CREATING BUTTON*****/
	$("div.groupbutton").html('<div class="btngroup"><button id="btnAddState" class="btn btn-primary "><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	/*****END OF BUTTON CREATION******/
	
	/*****END OF BUTTON CREATION******/
   
	$('#btnAddState').click(function(e){
		isEdit_State = false;	
		isDelete_State = false;	
		$("#errorlog_state_add").html("");
		$('#frmStateAdd').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#txtStateCode').val("");
		$('#txtStateName').val("");
		$('#hidOperAddState').val("insert_state");
		$('#cmbCountryName_State').val("");
		$(stateMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		$('#stateAddModal').modal('show');
		$('#stateAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtStateCode').focus(); // Focusing the textbox
		})
		load_country();
	});
	
	$('#frmStateAdd').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingStateAdd").show();
			var formData = new FormData(document.getElementById("frmStateAdd"));		
			var institutedata={
				txtStateCode:$('#txtStateCode').val(),
				txtStateName:$('#txtStateName').val(),
				cmbCountryName_State:$('#cmbCountryName_State').val(),
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/insert_state",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							$("#errorlog_state_add").html("");
							toastr.success(obj.msg);
							var dtblProgram = $("#tblStateMaster").DataTable();
				 			dtblProgram.ajax.reload();
				 			$('#frmStateAdd').data('bootstrapValidator').resetForm(true);				
				    	}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_state_add').html(obj.msg);
		                	$('#errorlog_state_add').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_state_add').html(obj.msg);
		                	$('#errorlog_state_add').show();
		                }
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}	
					$("#spanProcessingStateAdd").hide();			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			txtStateCode: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					},
					stringLength: {
						max: 8,
						message: 'Code should not be more then 8 characters'
						}
				}
			},
			txtStateName: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z\s]+)$/i,
						message: "Only Alphabets are allowed"
					}
				}
			},
			cmbCountryName_State: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z\s]+)$/i,
						message: "Only Alphabets are allowed"
					}
				}
			}
		}
	});
	$('#frmStateEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingStateEdit").show();
			var formData = new FormData(document.getElementById("frmStateEdit"));			
			var institutedata={
				hidUniqueidEdit:$('#hidUniqueidEdit').val(),
				txtStateCodeEdit:$('#hidStateCodeEdit').val(),
				txtStateNameEdit:$('#txtStateNameEdit').val(),
				cmbCountryNameEdit_State:$('#cmbCountryNameEdit_State').val(),
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/update_state",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){
					isEdit_State = false;	
					isDelete_State = false; 
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							$('#stateEditModal').modal('hide'); 
							var dtblProgram = $("#tblStateMaster").DataTable();
				 			dtblProgram.ajax.reload();	
				 			$('#frmStateEdit').data('bootstrapValidator').resetForm(true);
				 		}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_state_edit').html(obj.msg);
		                	$('#errorlog_state_edit').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_state_edit').html(obj.msg);
		                	$('#errorlog_state_edit').show();
		                }
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}		
					$("#spanProcessingStateEdit").hide();		
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields:{
			txtStateCodeEdit: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					},
					stringLength: {
						max: 8,
						message: 'Code should not be more then 8 characters'
						}
				}
			},
			txtStateNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z\s]+)$/i,
						message: "Only Alphabets are allowed"
					}
				}
			},
			cmbCountryNameEdit_State: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z\s]+)$/i,
						message: "Only Alphabets are allowed"
					}
				}
			}
		}
			
	});
//END OF EDIT RECORD WITH VALIDATION

/****DELETE RECORD DELETE********/
	
	//CHECKING DUPLICATION OF STATE CODE
	$('#txtStateCode').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtStateCode:$(event.target).val(),
					validatestatecode:true,
				};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_state",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
					 	$('#frmStateAdd').data('bootstrapValidator').updateStatus('txtStateCode', 'NOT_VALIDATED', null).validateField('txtStateCode');
					 	//$('#frmStateAdd').data('bootstrapValidator').updateStatus('txtStateCode', 'INVALID', null);
						toastr.error('State Code Already Created');
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
	//CHECKING DUPLICATION OF STATE CODE FOR EDIT
	$('#txtStateCodeEdit').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtStateCodeEdit:$(event.target).val(),
					validatestatecode:true,
				};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_state_edit",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
					 	$('#frmStateEdit').data('bootstrapValidator').updateStatus('txtStateCodeEdit', 'NOT_VALIDATED', null).validateField('txtStateCodeEdit');
						toastr.error('State Code Already Created');
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
	
	/*$('#stateAddModal').on('hidden.bs.modal', function (e) {
 		$('#frmStateAdd').data('bootstrapValidator').resetForm(true);
 		$(stateMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isEdit_State = false;	
		isDelete_State = false; 
	})*/
/*** Datatable for District **/
	var districtMaster = $('#tblDistrictMaster').dataTable({
		"sAjaxSource": base_url+"ajax_controller/select_district",
		//"sAjaxSource": "generic_setup2_db.php?_s="+MY_SESSION_NAME+"&type=SELECT_DISTRICT",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 button' >>><'col-xs-6'p>>",
		"aoColumns": [
	                     { "sName": "Slno","sWidth": "5%" },
	                     { "sName": "Code" },
	                     { "sName": "name" },
	                     { "sName": "state name" },
	                     { "sName": "country name" },
	                     { "sName": "country_code","bVisible":false },
	                     { "sName": "state_code","bVisible":false },
	                     { "sName": "id","bVisible":false },
	                     { "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "10%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEditdistrict' onclick='districtRow(event,\"edit\")'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<button id='btnDeletedistrict' title='Delete' class='btn btn-danger tooltipTable btn-circle' onclick='districtRow(event,\"delete\")'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}
        			
        			],
					 "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 3 ] }],
					 "fnInitComplete": function(oSettings, json) {
			     		$('.tooltipTable').tooltipster( {
				         	theme: 'tooltipster-punk',
				      		animation: 'grow',
				        	delay: 200, 
				         	touchDevices: false,
				         	trigger: 'hover'
			      		} );          
			  		} 
	});
/**CREATING BUTTON*****/

	$("div.button").html('<div class="btngroup"><button id="btnAddDistrict" class="btn btn-primary "><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');

/*****END OF BUTTON CREATION******/

	  /*load_state_country();*/
	$('#btnAddDistrict').click(function(e){
		isEdit_District = false;	
		isDelete_District = false;	
		$('#frmDistrictAdd').data('bootstrapValidator').resetForm(true);
		$("#errorlog_district_add").html("");//Reseting the tick marks before opening add modal	
		$('#txtDistrictCode').val("");
		$('#txtDistrictName').val("");
		$('#hidOperAddDistrict').val("insert_district");
		$('#cmbStateName_District').val("");
		$('#cmbCountryName_District').val("");
		$('#districtAddModal').modal('show');
		
		$(districtMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		$('#districtAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtDistrictCode').focus(); // Focusing the textbox
		})
		load_state_country();
	});
	$('#frmDistrictAdd').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingDistrictAdd").show();
			var formData = new FormData(document.getElementById("frmDistrictAdd"));		
			var institutedata={
				txtDistrictCode:$('#txtDistrictCode').val(),
				txtDistrictName:$('#txtDistrictName').val(),
				cmbStateName_District:$('#cmbStateName_District').val(),
				cmbCountryName_District:$('#cmbCountryName_District').val(),
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/insert_district",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							$("#errorlog_district_add").html("");
							toastr.success(obj.msg);
							var dtblProgram = $("#tblDistrictMaster").DataTable();
				 			dtblProgram.ajax.reload();
				 			$('#frmDistrictAdd').data('bootstrapValidator').resetForm(true);	
							
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_district_add').html(obj.msg);
		                	$('#errorlog_district_add').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_district_add').html(obj.msg);
		                	$('#errorlog_district_add').show();
		                }
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}	
					$("#spanProcessingDistrictAdd").hide();			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			txtDistrictCode: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					stringLength: {
						max: 8,
						message: 'Code should not be more then 8 characters'
					}
				}
			},
			txtDistrictName: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z\s]+)$/i,
						message: "Only Alphabets are allowed"
					}
				}
			},
			cmbStateName_District: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z\s]+)$/i,
						message: "Only Alphabets are allowed"
					}
				}
			},
			cmbCountryName_District: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z\s]+)$/i,
						message: "Only Alphabets are allowed"
					}
				}
			}
		}
	});
//END OF ADD RECORD WITH VALIDATION


//EDIT RECORD WITH VALIDATION

	$('#frmDistrictEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingDistrictEdit").show();
			var formData = new FormData(document.getElementById("frmDistrictEdit"));			
			var institutedata={
				hidUniqueidEditDistrict:$('#hidUniqueidEditDistrict').val(),
				txtDistrictCodeEdit:$('#hidDistrictCodeEdit').val(),
				txtDistrictNameEdit:$('#txtDistrictNameEdit').val(),
				cmbStateNameEdit_District:$('#cmbStateNameEdit_District').val(),
				cmbCountryNameEdit_District:$('#cmbCountryNameEdit_District').val(),
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/update_district",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){ 
					isEdit_District = false;	
					isDelete_District = false;
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							$('#districtEditModal').modal('hide'); 
							var dtblProgram = $("#tblDistrictMaster").DataTable();
				 			dtblProgram.ajax.reload();	
				 			$('#frmDistrictEdit').data('bootstrapValidator').resetForm(true);		
				 		}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_district_edit').html(obj.msg);
		                	$('#errorlog_district_edit').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_district_edit').html(obj.msg);
		                	$('#errorlog_district_edit').show();
		                }
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}	
					$("#spanProcessingDistrictEdit").hide();			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields:{
			txtDistrictCodeEdit: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					stringLength: {
						max: 8,
						message: 'Code should not be more then 8 characters'
					}
				}
			},
			txtDistrictNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z\s]+)$/i,
						message: "Only Alphabets are allowed"
					}
				}
			},
			cmbStateNameEdit_District: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbCountryNameEdit_District: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}
		
	});
	//END OF EDIT RECORD WITH VALIDATION

	/****DELETE RECORD DELETE********/
	
	// CHECKING DUPLICATION OF BOARD CODE 
	$('#txtDistrictCode').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtDistrictCode:$(event.target).val(),
				validatedistrictcode:true,
			};
	  		 //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_district",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
					 	$('#frmDistrictAdd').data('bootstrapValidator').updateStatus('txtDistrictCode', 'NOT_VALIDATED', null).validateField('txtDistrictCode');
						toastr.error('District Code Already Created');
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
	// CHECKING DUPLICATION OF BOARD CODE FOR EDIT
	$('#txtDistrictCodeEdit').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtDistrictCodeEdit:$(event.target).val(),
				validatedistrictcode:true,
			};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_district_edit",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
					 	$('#frmDistrictEdit').data('bootstrapValidator').updateStatus('txtDistrictCodeEdit', 'NOT_VALIDATED', null).validateField('txtDistrictCodeEdit');
						toastr.error('District Code Already Created');
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
	$('#districtEditModal').on('hidden.bs.modal', function (e) {
 		$('#frmDistrictEdit').data('bootstrapValidator').resetForm(true);
 		$(districtMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isEdit_District = false;	
		isDelete_District = false;
	})
	//************************************ For Nationality Tab***********************************//
	
	var nationalityMaster = $('#tblNationalityMaster').dataTable({
		"sAjaxSource": base_url+"ajax_controller/select_nationality",
		//"sAjaxSource": "generic_setup2_db.php?_s="+MY_SESSION_NAME+"&type=SELECT_NATIONALITY",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 nationalitybutton' >>><'col-xs-6'p>>",
		"aoColumns": [
	                     { "sName": "Slno","sWidth": "5%" },
	                     { "sName": "Code" },
	                     { "sName": "name" },
	                     { "sName": "id","bVisible":false },
	                     { "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "10%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEditnationality' onclick='nationalityRow(event,\"edit\")'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<button id='btnDeletenationality' title='Delete' class='btn btn-danger tooltipTable btn-circle' onclick='nationalityRow(event,\"delete\")'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}
        			
        			],
					 "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 3 ] }],
					 "fnInitComplete": function(oSettings, json) {
			     		$('.tooltipTable').tooltipster( {
				         	theme: 'tooltipster-punk',
				      		animation: 'grow',
				        	delay: 200, 
				         	touchDevices: false,
				         	trigger: 'hover'
			      		} );          
			  		} 
	});
/**CREATING BUTTON*****/

	$("div.nationalitybutton").html('<div class="btngroup"><button id="btnAddNationality" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');

/*****END OF BUTTON CREATION******/

	$('#btnAddNationality').click(function(e){
		isEdit_Nationality = false;	
		isDelete_Nationality = false;
		$('#errorlog_nationality_add').html("");
		$('#frmNationalityAdd').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#txtNationalityCode').val("");
		$('#txtNationalityName').val("");
		
		$(nationalityMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		$('#hidOperAddNationality').val("insert_nationality");
		$('#nationalityAddModal').modal('show');
		$('#nationalityAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtNationalityCode').focus(); // Focusing the textbox
		})
	});
	$('#frmNationalityAdd').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingNationalityAdd").show();
			var formData = new FormData(document.getElementById("frmNationalityAdd"));	
			var institutedata={
				txtNationalityCode:$('#txtNationalityCode').val(),
				txtNationalityName:$('#txtNationalityName').val(),
				//type:"INSERT_NATIONALITY"
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/insert_nationality",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							
							$('#errorlog_nationality_add').html("");
							toastr.success(obj.msg);
							var dtblProgram = $("#tblNationalityMaster").DataTable();
				 			dtblProgram.ajax.reload();
				 			$('#frmNationalityAdd').data('bootstrapValidator').resetForm(true);	
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_nationality_add').html(obj.msg);
		                	$('#errorlog_nationality_add').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_nationality_add').html(obj.msg);
		                	$('#errorlog_nationality_add').show();
		                }
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}	
					$("#spanProcessingNationalityAdd").hide();			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			txtNationalityCode: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					},
					stringLength: {
						max: 8,
						message: 'Code should not be more then 8 characters'
						}
				}
			},
			txtNationalityName: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z\s]+)$/i,
						message: "Only Alphabets are allowed"
					}
				}
			}
		}
	});
	//END OF ADD RECORD WITH VALIDATION


	//EDIT RECORD WITH VALIDATION

	$('#frmNationalityEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingNationalityEdit").show();
			var formData = new FormData(document.getElementById("frmNationalityEdit"));			
			var institutedata={
				hidUniqueidEdit:$('#hidUniqueidEditNationality').val(),
				txtNationalityCodeEdit:$('#hidNationalityCodeEdit').val(),
				txtNationalityNameEdit:$('#txtNationalityNameEdit').val(),
			};
		//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/update_nationality",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){ 
					isEdit_Nationality = false;	
					isDelete_Nationality = false;
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							$('#nationalityEditModal').modal('hide'); 
							var dtblProgram = $("#tblNationalityMaster").DataTable();
				 			dtblProgram.ajax.reload();		
				 			$('#frmNationalityEdit').data('bootstrapValidator').resetForm(true);	
				    	}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_nationality_edit').html(obj.msg);
		                	$('#errorlog_nationality_edit').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_nationality_edit').html(obj.msg);
		                	$('#errorlog_nationality_edit').show();
		                }
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}	
					$("#spanProcessingNationalityEdit").hide();	
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields:{
			txtNationalityCodeEdit: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					},
					stringLength: {
						max: 8,
						message: 'Code should not be more then 8 characters'
					}
				}
			},
			txtNationalityNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z\s]+)$/i,
						message: "Only Alphabets are allowed"
					}
				}
			}
		}
			
} );
	//END OF EDIT RECORD WITH VALIDATION

/****DELETE RECORD DELETE********/
	
	// CHECKING DUPLICATION OF BOARD CODE 
	$('#txtNationalityCode').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtNationalityCode:$(event.target).val(),
					validatenationalitycode:true,
				};
		   	//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_nationality",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
					 	$('#frmNationalityAdd').data('bootstrapValidator').updateStatus('txtNationalityCode', 'NOT_VALIDATED', null).validateField('txtNationalityCode');
						
						toastr.error('Nationality Code Already Created');
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
	// CHECKING DUPLICATION OF BOARD CODE FOR EDIT
	$('#txtNationalityCodeEdit').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtNationalityCodeEdit:$(event.target).val(),
					validatenationalitycode:true,
				};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_nationality_edit",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
						$('#frmNationalityEdit').data('bootstrapValidator').updateStatus('txtNationalityCodeEdit', 'NOT_VALIDATED', null).validateField('txtNationalityCodeEdit');
						toastr.error('Nationality Code Already Created');
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
	$('#nationalityEditModal').on('hidden.bs.modal', function (e) {
 		$('#frmNationalityEdit').data('bootstrapValidator').resetForm(true);
 		$(nationalityMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isEdit_Nationality = false;	
		isDelete_Nationality = false;
	})
	//************************************ For Board Tab***********************************//
	
	var boardMaster = $('#tblBoardMaster').dataTable({
		"sAjaxSource": base_url+"ajax_controller/select_board",
		//"sAjaxSource": "generic_setup2_db.php?_s="+MY_SESSION_NAME+"&type=SELECT_BOARD",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 boardbutton' >>><'col-xs-6'p>>",
		"aoColumns": [
	                     { "sName": "Slno","sWidth": "5%" },
	                     { "sName": "Code" },
	                     { "sName": "name" },
	                     { "sName": "id","bVisible":false },
	                     { "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "10%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEditboard' onclick='boardRow(event,\"edit\")'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<button id='btnDeleteboard' title='Delete' class='btn btn-danger tooltipTable btn-circle' onclick='boardRow(event,\"delete\")'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}
        			
        			],
					 "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 3 ] }],
					 "fnInitComplete": function(oSettings, json) {
			     		$('.tooltipTable').tooltipster( {
				         	theme: 'tooltipster-punk',
				      		animation: 'grow',
				        	delay: 200, 
				         	touchDevices: false,
				         	trigger: 'hover'
			      		} );          
			  		} 
	});
/**CREATING BUTTON*****/

	$("div.boardbutton").html('<div class="btngroup"><button id="btnAddBoard" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');

/*****END OF BUTTON CREATION******/

	$('#btnAddBoard').click(function(e){
		isEdit_Board = false;	
		isDelete_Board = false;	
		$('#errorlog_board_add').html("");
		$('#frmBoardAdd').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#txtBoardCode').val("");
		$('#txtBoardName').val("");
		
		$(boardMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		$('#hidOperAddBoard').val("insert_board");
		$('#boardAddModal').modal('show');
		$('#boardAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtBoardCode').focus(); // Focusing the textbox
		})
	});
	
	

//ADD RECORD WITH VALIDATION

	$('#frmBoardAdd').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingBoardAdd").show();
			var formData = new FormData(document.getElementById("frmBoardAdd"));		
			var institutedata={
				txtBoardCode:$('#txtBoardCode').val(),
				txtBoardName:$('#txtBoardName').val(),
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/insert_board",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							$('#errorlog_board_add').html("");
							toastr.success(obj.msg);
							var dtblProgram = $("#tblBoardMaster").DataTable();
				 			dtblProgram.ajax.reload();
				 			$('#frmBoardAdd').data('bootstrapValidator').resetForm(true);		
					
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_board_add').html(obj.msg);
		                	$('#errorlog_board_add').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_board_add').html(obj.msg);
		                	$('#errorlog_board_add').show();
		                }
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}
					$("#spanProcessingBoardAdd").hide();								
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			txtBoardCode: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					},
					stringLength: {
						max: 8,
						message: 'Code should not be more then 8 characters'
						}
				}
			},
			txtBoardName: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z\s]+)$/i,
						message: "Only Alphabets are allowed"
					}
				}
			}
		}
	} );
//END OF ADD RECORD WITH VALIDATION


//EDIT RECORD WITH VALIDATION

$('#frmBoardEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingBoardEdit").show();
			var formData = new FormData(document.getElementById("frmBoardEdit"));			
			var institutedata={
				hidUniqueidEdit:$('#hidUniqueidEditBoard').val(),
				txtBoardCodeEdit:$('#hidBoardCodeEdit').val(),
				txtBoardNameEdit:$('#txtBoardNameEdit').val(),
				//type:"UPDATE_BOARD"
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/update_board",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){
					isEdit_Board = false;	
					isDelete_Board = false;	
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							$('#boardEditModal').modal('hide'); 
							var dtblProgram = $("#tblBoardMaster").DataTable();
				 			dtblProgram.ajax.reload();			
				    		$('#frmBoardEdit').data('bootstrapValidator').resetForm(true);
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_board_edit').html(obj.msg);
		                	$('#errorlog_board_edit').show();
		                	$('#frmBoardEdit').data('bootstrapValidator').resetForm(true);
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_board_edit').html(obj.msg);
		                	$('#errorlog_board_edit').show();
		                }
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}	
					$("#spanProcessingBoardEdit").hide(); 
								
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields:{
			txtBoardCodeEdit: {							//form input type name
					validators: {
						notEmpty: {
							message: 'This field can\'t left blank'
						},
						regexp: {
							regexp: /^([A-Za-z0-9\s]+)$/i,
							message: "Special characters are not allowed"
						},
						stringLength: {
							max: 8,
							message: 'Code should not be more then 8 characters'
							}
					}
				},
			txtBoardNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z\s]+)$/i,
						message: "Only Alphabets are allowed"
					}
				}
			}
		}
			
	});
//END OF EDIT RECORD WITH VALIDATION

/****DELETE RECORD DELETE********/
	
	// CHECKING DUPLICATION OF BOARD CODE 
	$('#txtBoardCode').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtBoardCode:$(event.target).val(),
					validateboardcode:true,
					//type:"CHKDUCPLICATE_BOARD"
				};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_board",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
					 	$('#frmBoardAdd').data('bootstrapValidator').updateStatus('txtBoardCode', 'NOT_VALIDATED', null).validateField('txtBoardCode');
						toastr.error('Board Code Already Created');
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
	// CHECKING DUPLICATION OF BOARD CODE FOR EDIT
	$('#txtBoardCodeEdit').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtBoardCodeEdit:$(event.target).val(),
					validateboardcode:true,
					type:"CHKEDITDUCPLICATE_BOARD"
				};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_board_edit",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
					 	$('#frmBoardEdit').data('bootstrapValidator').updateStatus('txtBoardCodeEdit', 'NOT_VALIDATED', null).validateField('txtBoardCodeEdit');
						toastr.error('Board Code Already Created');
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
	$('#boardEditModal').on('hidden.bs.modal', function (e) {
 		$('#frmBoardEdit').data('bootstrapValidator').resetForm(true);
 		$(boardMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isEdit_Board = false;	
		isDelete_Board = false;	
	})
		//************************************ For Standard Tab***********************************//
		
	var standardMaster = $('#tblStandardMaster').dataTable({
		"sAjaxSource": base_url+"ajax_controller/select_standard",
		//"sAjaxSource": "generic_setup2_db.php?_s="+MY_SESSION_NAME+"&type=SELECT_STANDARD",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 standardbutton' >>><'col-xs-6'p>>",
		"aoColumns": [
	                     { "sName": "Slno","sWidth": "5%" },
	                     { "sName": "Code" },
	                     { "sName": "name" },
	                     { "sName": "Previous Standard" },
	                     { "sName": "id","bVisible":false },
	                     { "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "10%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEditStandard' onclick='standardRow(event,\"edit\")'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<button id='btnDeleteStandard' title='Delete' class='btn btn-danger tooltipTable btn-circle' onclick='standardRow(event,\"delete\")'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}
        			
        			],
					 "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 3 ] }],
					 "fnInitComplete": function(oSettings, json) {
			     		$('.tooltipTable').tooltipster( {
				         	theme: 'tooltipster-punk',
				      		animation: 'grow',
				        	delay: 200, 
				         	touchDevices: false,
				         	trigger: 'hover'
			      		} );          
			  		} 
	});
/**CREATING BUTTON*****/

	$("div.standardbutton").html('<div class="btngroup"><button id="btnAddStandard" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');

/*****END OF BUTTON CREATION******/

	$('#btnAddStandard').click(function(e){
		isEdit_Standard = false;	
		isDelete_Standard = false;	
		
		$(standardMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		$('#errorlog_standard_add').html("");
		$('#frmStandardAdd').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#txtStandardCode').val("");
		$('#txtStandardName').val("");
		$('#txtPreviousStandard').val("");
		$('#hidOperAddStandard').val("insert_standard");
		
		$('#standardAddModal').modal('show');
		$('#standardAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtStandardCode').focus(); // Focusing the textbox
		})
	});
//ADD RECORD WITH VALIDATION

	$('#frmStandardAdd').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingStandardAdd").show();
			var formData = new FormData(document.getElementById("frmStandardAdd"));	
			var institutedata={
				txtStandardCode:$('#txtStandardCode').val(),
				txtStandardName:$('#txtStandardName').val(),
				txtPreviousStandard:$('#txtPreviousStandard').val(),
				//type:"INSERT_STANDARD"
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/insert_standard",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							$('#errorlog_standard_add').html("");
							toastr.success(obj.msg);
							var dtblStandard = $("#tblStandardMaster").DataTable();
				 			dtblStandard.ajax.reload();
				 			$('#frmStandardAdd').data('bootstrapValidator').resetForm(true);	
							//toastr.success('Data Successfully Inserted');	
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_standard_add').html(obj.msg);
		                	$('#errorlog_standard_add').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_standard_add').html(obj.msg);
		                	$('#errorlog_standard_add').show();
		                }
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}	
					$("#spanProcessingStandardAdd").hide();			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			txtStandardCode: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					},
					stringLength: {
						max: 8,
						message: 'Code should not be more then 8 characters'
						}
				}
			},
			txtStandardName: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtPreviousStandard: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
		}
	} );
//END OF ADD RECORD WITH VALIDATION


//EDIT RECORD WITH VALIDATION

$('#frmStandardEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingStandardEdit").show();
			var formData = new FormData(document.getElementById("frmStandardEdit"));			
			var institutedata={
				hidUniqueidEdit:$('#hidUniqueidEdit').val(),
				txtStandardCodeEdit:$('#txtStandardCodeEdit').val(),
				txtStandardNameEdit:$('#txtStandardNameEdit').val(),
				txtPreviousStandardEdit:$('#txtPreviousStandardEdit').val(),
				//type:"UPDATE_STANDARD"
			};
		//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/update_standard",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){ 
					isEdit_Standard = false;	
					isDelete_Standard = false;
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							$('#standardEditModal').modal('hide'); 
							var dtblStandard = $("#tblStandardMaster").DataTable();
				 			dtblStandard.ajax.reload();		
							$('#frmStandardEdit').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
				 		}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_menu_add').html(obj.msg);
		                	$('#errorlog_menu_add').show();
							$('#frmStandardEdit').data('bootstrapValidator').resetForm(true);
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_menu_add').html(obj.msg);
		                	$('#errorlog_menu_add').show();
							$('#frmStandardEdit').data('bootstrapValidator').resetForm(true);
		                }
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
							$('#frmStandardEdit').data('bootstrapValidator').resetForm(true);
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}	
					$("#spanProcessingStandardEdit").hide();	
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields:{
			txtStandardCodeEdit: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					},
					stringLength: {
						max: 8,
						message: 'Code should not be more then 8 characters'
					}
				}
			},
			txtStandardNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtPreviousStandardEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}
			
	});
//END OF EDIT RECORD WITH VALIDATION

/****DELETE RECORD DELETE********/
	
	// CHECKING DUPLICATION OF MENU CODE 
	$('#txtStandardCode').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtStandardCode:$(event.target).val(),
					validatestandardcode:true,
					//type:"CHKDUCPLICATE_STANDARD"
				};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_standard",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
						$('#frmStandardAdd').data('bootstrapValidator').updateStatus('txtStandardCode', 'NOT_VALIDATED', null).validateField('txtStandardCode');
						toastr.error('Standard Code Already Created');
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
	// CHECKING DUPLICATION OF MENU CODE FOR EDIT
	$('#txtStandardCodeEdit').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtStandardCodeEdit:$(event.target).val(),
					validatestandardcode:true,
					//type:"CHKEDITDUCPLICATE_STANDARD"
				};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_standard_edit",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
						$('#frmStandardEdit').data('bootstrapValidator').updateStatus('txtStandardCodeEdit', 'NOT_VALIDATED', null).validateField('txtStandardCodeEdit');
						toastr.error('Standard Code Already Created');
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
	$('#standardEditModal').on('hidden.bs.modal', function (e) {
 		$('#frmStandardEdit').data('bootstrapValidator').resetForm(true);
 		$(standardMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isEdit_Standard = false;	
		isDelete_Standard = false;	
	})
	//************************************ For Qualification Tab***********************************//
	
	var challanMaster = $('#tblQualification').dataTable({
		"sAjaxSource": base_url+"ajax_controller/select_qualification",	
		//"sAjaxSource": "generic_setup2_db.php?_s="+MY_SESSION_NAME+"&type=SELECT_QUALIFICATION",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
		"bDestroy" : true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 qualificationbutton' >>><'col-xs-6'p>>",
		"aoColumns": [
	                     { "sName": "Slno","sWidth": "5%" },
	                     { "sName": "Qualification_master_code" },
	                     { "sName": "Qualification_master_name" },
						 { "sName": "Record Status" ,"sWidth": "10%","sClass":"alignCenter",
							"mRender": function( data, type, full ) {
								if(data == '1')
								{
									return '<img src="'+base_url+'public/assets/images/ACTIVE.png" ></img>';
								}
						        else if (data == '0')
						        {
									return '<img src="'+base_url+'public/assets/images/INACTIVE.png" ></img>';
								}
						       // return '<img src="'+base_url+'public/assets/images/'+ data +'.png" ></img>';
					    }},
					    { "sName": "status","bVisible":false },
					    { "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "10%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEditQualification' onclick='qualificationRow(event,\"edit\")'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<button id='btnDeleteQualification' title='Delete' class='btn btn-danger tooltipTable btn-circle' onclick='qualificationRow(event,\"delete\")'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}
        			
					    
        			],
					 "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 3 ] }],
					 "fnInitComplete": function(oSettings, json) {
			     		$('.tooltipTable').tooltipster( {
				         	theme: 'tooltipster-punk',
				      		animation: 'grow',
				        	delay: 200, 
				         	touchDevices: false,
				         	trigger: 'hover'
			      		} );          
			  		} 
	});
		/**CREATING BUTTON*****/
	$("div.qualificationbutton").html('<div class="btngroup"><button id="btnAddQualification" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	/*****END OF BUTTON CREATION******/
		
		
	$('#btnAddQualification').click(function(e){
	$('#frmAddQualification').data('bootstrapValidator').resetForm(true);
	//alert("hello");
	$('#errorlog_qualification_add').html("");
		isEdit_Qualification = false;	
		isDelete_Qualification = false;	
		$('#txtQualificationCode').val("");
		$('#txtQualificationName').val("");
		
		$(challanMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		$('#hidOperAddQualification').val("insert_qualification");
		$('#txtStatus').val("");
		
		$('#QualificationAddModal').modal('show');
		$('#QualificationAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtQualificationCode').focus(); // Focusing the textbox
		})
	});
	
	
 	$('#frmAddQualification').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingQualificationAdd").show();
			var formData = new FormData(document.getElementById("frmAddQualification"));
			var institutedata={
				txtQualificationCode:$('#txtQualificationCode').val(),
				txtQualificationName:$('#txtQualificationName').val(),
				cmbStatus:$('#cmbStatus').val(),
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/insert_qualification",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							$('#errorlog_qualification_add').html("");
							toastr.success(obj.msg);
							var dtblQualification = $("#tblQualification").DataTable();
				 			dtblQualification.ajax.reload();
				 			$('#frmAddQualification').data('bootstrapValidator').resetForm(true);	
							$('#QualificationAddModal').modal('hide');								
				    	}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_qualification_add').html(obj.msg);
		                	$('#errorlog_qualification_add').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_qualification_add').html(obj.msg);
		                	$('#errorlog_qualification_add').show();
		                }
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}	
					$("#spanProcessingQualificationAdd").hide();	
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			txtQualificationCode: {
					validators: {
						notEmpty: {
							message: 'This field can\'t left blank'
						}
					}
				},
			txtQualificationName: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbStatus: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}
	});
	$('#frmEditQualification').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingQualificationEdit").show();
			var formData = new FormData(document.getElementById("frmEditQualification"));		
			var institutedata={
				txtQualificationCodeEdit:$('#txtQualificationCodeEdit').val(),
				txtQualificationNameEdit:$('#txtQualificationNameEdit').val(),
				cmbStatusEdit:$('#cmbStatusEdit').val(),
				//type:"UPDATE_QUALIFICATION"
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/update_qualification",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){ 
					isEdit_Qualification = false;	
					isDelete_Qualification = false;
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							var dtblCenter = $("#tblQualification").DataTable();
	 						dtblCenter.ajax.reload();
							$('#frmEditQualification').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
							$('#txtQualificationCodeEdit').val("");
							$('#txtQualificationNameEdit').val("");
							$('#QualificationEditModal').modal('hide');				
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_qualification_edit').html(obj.msg);
		                	$('#errorlog_qualification_edit').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_qualification_edit').html(obj.msg);
		                	$('#errorlog_qualification_edit').show();
		                }
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}	
					$("#spanProcessingQualificationEdit").hide();
							
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields:{
			txtQualificationCodeEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtQualificationNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbStatusEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}
			
	});
	
	
	// CHECKING DUPLICATION OF MENU CODE 
	$('#txtQualificationCode').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtQualificationCode:$(event.target).val(),
					validatestandardcode:true,
				};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_qualification",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
						$('#frmAddQualification').data('bootstrapValidator').updateStatus('txtQualificationCode', 'NOT_VALIDATED', null).validateField('txtQualificationCode');
						toastr.error('Qualification Code Already Created');
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
	// CHECKING DUPLICATION OF MENU CODE FOR EDIT
	$('#txtQualificationCodeEdit').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtQualificationCodeEdit:$(event.target).val(),
					validatestandardcode:true,
				};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_qualification_edit",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
					 	
						$('#frmEditQualification').data('bootstrapValidator').updateStatus('txtQualificationCodeEdit', 'NOT_VALIDATED', null).validateField('txtQualificationCodeEdit');
						toastr.error('Code Already Created');
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
	$('#QualificationEditModal').on('hidden.bs.modal', function (e) {
 		$('#frmEditQualification').data('bootstrapValidator').resetForm(true);
 		$(challanMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isEdit_Qualification = false;	
		isDelete_Qualification = false;	
	})
	//************************************ For Exam Center Tab***********************************//
	var examCenter = $('#dtblExamCenter').dataTable({
		"sAjaxSource": base_url+"ajax_controller/select_center",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 addCoursebtnCharge' >>><'col-xs-6'p>>",
		"aoColumns": [
	                    { "sName": "Slno","sWidth":"5%" },
						{ "sName": "exam_centre_code","sWidth":"20%" },
	                    { "sName": "exam_centre_name","sWidth":"20%" },
						{ "sName": "Record Status","sWidth": "10%","sClass":"alignCenter",
							"mRender": function( data, type, full ) {
								/*if(data == '1'){
									return '<img src="'+base_url+'public/assets/images/ACTIVE.png" ></img>';
								}
								else if(data == '0'){
									return '<img src="'+base_url+'public/assets/images/INACTIVE.png" ></img>';
								}*/
						        return '<img src="'+base_url+'public/assets/images/'+ data+'.png" ></img>';
					    }},
					    { "sName": "status","bVisible":false },
						{ "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "10%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEditCentre' onclick='editCentre(event);'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<button id='btnDeleteCentre' title='Delete' class='btn btn-danger tooltipTable btn-circle' onclick='deleteCentre(event);'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}
        			],
					 "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 3 ] }],
					 "fnInitComplete": function(oSettings, json) {
			     		$('.tooltipTable').tooltipster( {
				         	theme: 'tooltipster-punk',
				      		animation: 'grow',
				        	delay: 200, 
				         	touchDevices: false,
				         	trigger: 'hover'
			      		} );          
			  		} 
	});
	/**CREATING BUTTON*****/
	
	$("div.addCoursebtnCharge").html('<div class="btngroup"><button id="btnAddCentre" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	
	$('#btnAddCentre').click(function(e){
		$('#frmExamCenterAdd').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#txtCenterCode').val("");
		$('#txtCenterName').val("");
		$('#errorlog_exam_center_add').html("");
		$(examCenter.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		$('#hidOperAddExamCenter').val("insert_center");
		$('#AddExamCenterModal').modal('show');
		$('#AddExamCenterModal').on('shown.bs.modal', function () 
		{ 
			$('#txtCenterCode').focus(); // Focusing the textbox
		})
	});
	
	/*$.ajax({
		url:base_url+"ajax_controller/cmb_status_centre", 
		type:"post",
		success:function(response){  
			var options = "";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.code+">"+data.code+"</option>";
			});
			$('#cmbCenterStatus').html("");
			$('#cmbCenterStatus').append(options);
			$('#cmbCenterStatusEdit').html("");
			$('#cmbCenterStatusEdit').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});*/
	// Add record with validation
	$('#frmExamCenterAdd').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingExamCenterAdd").show();
			var formData = new FormData(document.getElementById("frmExamCenterAdd"));		
			var institutedata={
				centrecode:$('#txtCenterCode').val(),
				centrename:$('#txtCenterName').val(),
				cmbCenterStatus:$('#cmbCenterStatus').val(),
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/insert_center",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
		        success:function(response){  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							$('#errorlog_exam_center_add').html("");
							var dtblExamCenter = $("#dtblExamCenter").DataTable();
				 			dtblExamCenter.ajax.reload();
				 			$('#frmExamCenterAdd').data('bootstrapValidator').resetForm(true);	
							$('#AddExamCenterModal').modal('hide');									
				    	}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_exam_center_add').html(obj.msg);
		                	$('#errorlog_exam_center_add').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_exam_center_add').html(obj.msg);
		                	$('#errorlog_exam_center_add').show();
		                }
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}	
					$("#spanProcessingExamCenterAdd").hide();	
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			txtCenterCode: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtCenterName: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbCenterStatus: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
		}
	} );
	//END OF ADD RECORD WITH VALIDATION
	$('#frmExamCenterEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingExamCenterEdit").show();
			var formData = new FormData(document.getElementById("frmExamCenterEdit"));
			var institutedata={
				hidUniqueidEdit:$('#hidUniqueidEditCenter').val(),
				centrecode:$('#hidUniqueidEditCenter').val(),
				centrename:$('#txtCenterNameEdit').val(),
				cmbCenterStatusEdit:$('#cmbCenterStatusEdit').val(),
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/update_centre",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
		        success:function(response){  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							$('#EditExamCenterModal').modal('hide'); 
							$('#frmExamCenterEdit').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
							var dtblExamCenter = $("#dtblExamCenter").DataTable();
				 			dtblExamCenter.ajax.reload();
							$('#EditExamCenterModal').modal('hide');		
							
						}
						else if(obj.status === 'validationerror'){
							$('#errorlog_exam_center_edit').html(obj.msg);
							$('#errorlog_exam_center_edit').show();
						}
						else if(obj.status === 'xsserror'){
							$('#errorlog_exam_center_edit').html(obj.msg);
							$('#errorlog_exam_center_edit').show();
						}
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}
					$("#spanProcessingExamCenterEdit").hide();
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields: {
			txtCenterCodeEdit: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtCenterNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbCenterStatusEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
		}
			
	});
	$('#txtCenterCode').on("blur",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtCenterCode:$('#txtCenterCode').val(),
					validateprogramcode:true,
				};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_center",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$('#txtCenterCode').val("");
					 	$('#frmExamCenterAdd').data('bootstrapValidator').updateStatus('txtCenterCode', 'INVALID', null);
						toastr.error('Code Already Used');
						$('#txtCenterCode').focus();				
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
	
	$('#CenterDelete').click(function()
	{
		$('#DeleteExamCenterModal').modal('hide');		
		var institutedata=
		{
			centrecode:$('#hidUniqueidEditCenter').val(),
		};		
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/delete_center",
			type:"post",
			data:institutedata,
			/*cache: false,
			contentType: false,
			processData: false,*/
			success:function(response)
			{  
				try
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
						toastr.success(obj.msg);						
						var dtblExamCenter = $("#dtblExamCenter").DataTable();
			 			dtblExamCenter.ajax.reload();
					}
					else 
					{
						sweetAlert("MENU",obj.msg, "error");	
					}
				}
				catch(e)
				{
					sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
				}				 
			},
			error:function()
			{
				toastr.error('Unable to process please contact support');
			}
		});		
	});
	
	
	// FOR REGISTRATION FIELD TAB	
	var Master = $('#dtblRegistrationFields').dataTable({
		"sAjaxSource": base_url+"ajax_controller/select_field",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 registrationbutton' >>><'col-xs-6'p>>",
		"aoColumns":[
	                    { "sName": "sl_no","sWidth": "5%" },
	                    { "sName": "code" },
	                    { "sName": "description" },
	                    { "sName": "sl_no" },
	                    { "sName": "field_status" },
	                    { "sName": "id","bVisible":false }
       				]
	});
	/**CREATING BUTTON*****/
	$("div.registrationbutton").html('<div class="btngroup"><button id="btnAdd" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;<button class="btn btn-success" id="btnEdit"><i class="fa fa-edit"></i> Edit</button>&nbsp;<button class="btn btn-danger" id="btnDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button></div>');
	/*****END OF BUTTON CREATION******/
	/*****FOR COMBO BOXES ADD AND EDIT******/
	$.ajax({
		url:base_url+"ajax_controller/cmb_status", 
		type:"post",
		success:function(response){  
			var options = "";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.code+">"+data.code+"</option>";
			});
			$('#cmbFieldStatus').html("");
			$('#cmbFieldStatusEdit').html("");
			$('#cmbFieldStatus').append(options);		
			$('#cmbFieldStatusEdit').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
	$.ajax({
		url:base_url+"ajax_controller/cmb_code", 
		type:"post",
		success:function(response){  
			var options = "";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.COLUMN_NAME+">"+data.COLUMN_NAME+"</option>";
			});
			$('#cmbCode').html(""); 
			$('#cmbCode').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$.ajax({
		url:base_url+"ajax_controller/cmb_code", 
		type:"post",
		success:function(response){  
			var options = "";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.COLUMN_NAME+">"+data.COLUMN_NAME+"</option>";
			});
			$('#cmbCodeEdit').html("");  
			$('#cmbCodeEdit').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	/*****END OF COMBO BOXES ADD AND EDIT******/
	/*****ON CLICK ADD******/
	$('#btnAdd').click(function(e){
		$('#frmRegistrationAdd').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#cmbCode').val("");
		$('#txtDescription').val("");
		$('#txtSlNo').val("");
		$('#cmbFieldStatus').val("");
		$(Master.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		$('#update_qualification').val("insert_field");
		$('#AddModal').modal('show');
		$('#AddModal').on('shown.bs.modal', function () 
		{ 
			$('#cmbCode').focus(); // Focusing the textbox
		})
	});
	/*****END OF ON CLICK ADD******/
	/*****ON CLICK EDIT******/
	$('#btnEdit').click(function(){
		if(isEdit_Registration_Field){
			$('#hidOperEditFields').val("update_field");
			$('#EditModal').modal('show');
		}
		else{
			toastr.error("Please Select a record");
		}	
	});
	/*****END OF ON CLICK EDIT******/
	/*****ON CLICK DELETE******/
	$('#btnDelete').click(function(){
		if(isDelete_Registration_Field){
			$('#DeleteModal').modal('show');
		}
		else{
			toastr.error("Please Select a record");
		}
		
	});
	/*****END OF ON CLICK EDIT******/
	// to select data when edit button is click
	$('#dtblRegistrationFields tbody').on('click', function (event) {
			
		isEdit_Registration_Field = true;	
		isDelete_Registration_Field = true;			
		$(Master.fnSettings().aoData).each(function (){
			$(this.nTr).removeClass('success');
		});
		var id = Master.fnGetData( event.target.parentNode )[5];//GETTING DATA FOR HIDDEN COLUMN
		if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
	  		row = event.target.parentNode.parentNode.parentNode; 
	  	else
	  		row = event.target.parentNode;
		$(row).addClass('success');
		$('#hidUniqueidEditRegistration').val(id);//GETTING VALUE FOR HIDDEN COLUMN
		$('#frmRegistrationEdit').data('bootstrapValidator').resetForm(true);
		$('#cmbCodeEdit').val(event.target.parentNode.cells[1].innerHTML);
		$('#txtDescriptionEdit').val(event.target.parentNode.cells[2].innerHTML);
		$('#txtSlNoEdit').val(event.target.parentNode.cells[3].innerHTML);
		var selectedText = event.target.parentNode.cells[4].innerHTML;
		$('#cmbFieldStatusEdit').val(selectedText);
		/*$("#cmbFieldStatusEdit option").each(function () 
		{
			if ($(this).html() == selectedText)
		 	{
				$(this).attr("selected", "selected");
				return;
			}
		});		*/
	});
	//ADD RECORD WITH VALIDATION

	$('#frmRegistrationAdd').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingFieldAdd").show();
			var formData = new FormData(document.getElementById("frmRegistrationAdd"));		
			var institutedata={
				cmbCode:$('#cmbCode').val(),
				txtDescription:$('#txtDescription').val(),
				txtSlNo:$('#txtSlNo').val(),
				cmbFieldStatus:$('#cmbFieldStatus').val(),
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/insert_field",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
		        success:function(response){  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							var dtblProgram = $("#dtblRegistrationFields").DataTable();
							dtblProgram.ajax.reload();
							$('#frmRegistrationAdd').data('bootstrapValidator').resetForm(true);	
						}
						else if(obj.status === 'validationerror'){
							$('#errorlog_field_add').html(obj.msg);
							$('#errorlog_field_add').show();
						}
						else if(obj.status === 'xsserror'){
							$('#errorlog_field_add').html(obj.msg);
							$('#errorlog_field_add').show();
						}
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}
					$("#spanProcessingFieldAdd").hide();
				},				
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			cmbCode: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^[a-zA-Z_]+$/i,
						message: "Only alphabets and underscore are allowed"
					},
					stringLength: {
						max: 20,
						message: 'Code should not be more then 8 characters'
					}
				}
			},
			txtDescription: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtSlNo: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^[0-9]+$/i,
						message: "Only Numbers are allowed"
					},
				}
			},
			cmbFieldStatus: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}
	});
//END OF ADD RECORD WITH VALIDATION
//EDIT RECORD WITH VALIDATION
	$('#frmRegistrationEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingFieldEdit").show();
			var formData = new FormData(document.getElementById("frmRegistrationEdit"));		
			var institutedata={
				hidUniqueidEditRegistration:$('#hidUniqueidEditRegistration').val(),
				cmbCodeEdit:$('#cmbCodeEdit').val(),
				txtDescriptionEdit:$('#txtDescriptionEdit').val(),
				txtSlNoEdit:$('#txtSlNoEdit').val(),
				cmbFieldStatusEdit:$('#cmbFieldStatusEdit').val(),
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/update_field",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
		        success:function(response){  
		        	isEdit_Registration_Field = false;	
					isDelete_Registration_Field = false;	
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							$('#EditModal').modal('hide'); 
							var dtblProgram = $("#dtblRegistrationFields").DataTable();
				 			dtblProgram.ajax.reload();		
				 			$('#frmRegistrationEdit').data('bootstrapValidator').resetForm(true);	
							
						}
						else if(obj.status === 'validationerror'){
							$('#errorlog_field_edit').html(obj.msg);
							$('#errorlog_field_edit').show();
							$('#frmRegistrationEdit').data('bootstrapValidator').resetForm(true);
						}
						else if(obj.status === 'xsserror'){
							$('#errorlog_field_edit').html(obj.msg);
							$('#errorlog_field_edit').show();
							$('#frmRegistrationEdit').data('bootstrapValidator').resetForm(true);
						}
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}
					$("#spanProcessingFieldEdit").hide();
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields:{
			cmbCodeEdit: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z_]+)$/i,
						message: "Only alphabets and underscore are allowed"
					},
					stringLength: {
						max: 20,
						message: 'Code should not be more then 8 characters'
					}
				}
			},
			txtDescriptionEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtSlNoEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^[0-9]+$/i,
						message: "Only Numbers are allowed"
					},
				}
			},
			cmbFieldStatus: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}
		
	});
//END OF EDIT RECORD WITH VALIDATION

/****DELETE RECORD DELETE********/
	$('#DeleteRecord').click(function()
	{
		$('#DeleteModal').modal('hide');		
		var institutedata=
		{
			ID:$('#hidUniqueidEditRegistration').val(),
		};		
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/delete_field",
			type:"post",
			data:institutedata,
			/*cache: false,
			contentType: false,
			processData: false,*/
			success:function(response)
			{
				isEdit_Registration_Field = false;	
				isDelete_Registration_Field = false;  
				try
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
						toastr.success(obj.msg);
						var dtblProgram = $("#dtblRegistrationFields").DataTable();
			 			dtblProgram.ajax.reload();	 				
					}
					else 
					{
						sweetAlert("MENU",obj.msg, "error");	
					}
				}
				catch(e)
				{
					sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
				}
				/*try
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
						toastr.success(obj.msg);
						var dtblProgram = $("#dtblRegistrationFields").DataTable();
			 			dtblProgram.ajax.reload();	 					
					}
					else 
					{
						var dtblProgram = $("#dtblRegistrationFields").DataTable();
			 			dtblProgram.ajax.reload();
			 			toastr.success(obj.msg);	
					}
				}
				catch(e)
				{
					toastr.error('Unable to process please contact support');
				}*/
							 
			},
			error:function()
			{
				toastr.error('Unable to process please contact support');
			}
		});		
	});
	
	// CHECKING DUPLICATION OF ID
	$('#cmbCode').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				cmbCode:$(event.target).val(),
				validatecodeAdd:true,
			};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_master_code",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
						$('#frmRegistrationAdd').data('bootstrapValidator').updateStatus('cmbCode', 'NOT_VALIDATED', null).validateField('cmbCode');
						toastr.error('Code Already Created');
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
	
	// CHECKING DUPLICATION OF CODE EDIT
	$('#cmbCodeEdit').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				cmbCodeEdit:$(event.target).val(),
				validatecodeAdd:true,
			};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_code_edit",
				type:"post",
				data:institutedata,
				success:function(response)
				{	
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
						$('#frmRegistrationEdit').data('bootstrapValidator').updateStatus('cmbCodeEdit', 'NOT_VALIDATED', null).validateField('cmbCodeEdit');
						toastr.error('Code Already Created');
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
	// CHECKING DUPLICATION OF SL_NO 
	$('#txtSlNo').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtSlNo:$(event.target).val(),
				validatecode:true,
			};
	  		//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_field",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
					 	$('#frmRegistrationAdd').data('bootstrapValidator').updateStatus('txtSlNo', 'NOT_VALIDATED', null).validateField('txtSlNo');
						toastr.error('Serial No Already Created');
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
	// CHECKING DUPLICATION OF SL_NO FOR EDIT
	/*$('#txtSlNoEdit').on("change",function(event)
	{
		var code = $('#cmbCodeEdit').val();
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtSlNoEdit:$(event.target).val(),
				cmbCodeEdit:code,
				validateEditcode:true,
			};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_field_edit",
				type:"post",
				data:institutedata,
				success:function(response)
				{	
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
					 	$('#frmRegistrationEdit').data('bootstrapValidator').updateStatus('txtSlNoEdit', 'NOT_VALIDATED', null).validateField('txtSlNoEdit');
					 	toastr.error('Serial No Already Exist');
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
	});*/
	$('#EditModal').on('hidden.bs.modal', function (e) {
 		$('#frmRegistrationEdit').data('bootstrapValidator').resetForm(true);
 		$(Master.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isEdit_Registration_Field = false;	
		isDelete_Registration_Field = false;
	})//*********************************** COMMON DATA *********************************//
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
});
function editCentre(event)
{
	$('#frmExamCenterEdit').data('bootstrapValidator').resetForm(true);
	var oTable = $('#dtblExamCenter').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	else
  		row = event.target.parentNode;
   	var centrecode = oTable.fnGetData(row)['exam_centre_code'];//GETTING DATA FOR HIDDEN COLUMN
   	var centrename = oTable.fnGetData(row)['exam_centre_name'];//GETTING DATA FOR HIDDEN COLUMN
	$('#hidUniqueidEditCenter').val(centrecode);//GETTING VALUE FOR HIDDEN COLUMN
	$('#txtCenterCodeEdit').val(centrecode);//GETTING VALUE FOR HIDDEN COLUMN
	$('#txtCenterNameEdit').val(centrename);//GETTING VALUE FOR HIDDEN COLUMN
	$('#hidOperEditExamCenter').val("update_centre");
	var selectedText2 = oTable.fnGetData(row)['status'];
	//alert(selectedText2);
	$("#cmbCenterStatusEdit").val(selectedText2);
	
	$('#EditExamCenterModal').modal('show');
	
	
}
function deleteCentre(event)
{
	$('#DeleteExamCenterModal').modal('show');
	var oTable = $('#dtblExamCenter').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;
	var centrecode = oTable.fnGetData(row)['exam_centre_code'];//GETTING DATA FOR HIDDEN COLUMN
	$('#hidUniqueidEditCenter').val(centrecode);//GETTING VALUE FOR HIDDEN COLUMN
	
}

function countryRow(event,action)
{
	$('#frmCountryEdit').data('bootstrapValidator').resetForm(true);
	var oTable = $('#tblCountryMaster').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});			
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	var record_id = oTable.fnGetData( row )[0];
	$(row).addClass('success');
    var categoryID = oTable.fnGetData( row )[3];
	//alert(id);
	$('#hidUniqueidEdit').val(categoryID);
	//alert(row.cells[1].innerHTML);	
	
	$('#txtCountryCodeEdit').val(row.cells[1].innerHTML);
	$('#hidCountryCodeEdit').val(row.cells[1].innerHTML);
	$('#txtCountryNameEdit').val(row.cells[2].innerHTML);
	
	if(action == 'edit')
	{
		$('#hidOperCountryEdit').val("update_country");	
		$('#countryEditModal').modal('show');
	}	
	else
	{
		var formData = new FormData(document.getElementById("frmCountryEdit"));		
		swal({
		  title: "Are you sure?",
		  text: "you want to Delete the Country!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, delete it!",
		  cancelButtonText: "No, cancel",
		  closeOnConfirm: false,
		  closeOnCancel: true
		},
		function(isConfirm){
		  if (isConfirm) {
		  	deleteCode();
		    swal("Deleted", "Country has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Country is safe ", "error");
		  }
		});
		function deleteCode()
		{
			$.ajax({
				url:base_url+"ajax_controller/delete_country",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response)
				{  
					isEdit_Country = false;	
					isDelete_Country = false; 
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							/*alert("hsdvhsduh");*/
							toastr.success(obj.msg);
							var dtblProgram = $("#tblCountryMaster").DataTable();
		 					dtblProgram.ajax.reload();
		 					/*alert("hhahf");*/
						}
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}
									 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});		
		}
	}	
	
}

function stateRow(event,action)
{
	//load_country();
	$('#frmStateEdit').data('bootstrapValidator').resetForm(true);	

	var oTable = $('#tblStateMaster').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});			
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	var record_id = oTable.fnGetData( row )[0];
	$(row).addClass('success');
    var stateID = oTable.fnGetData( row )[4];
	$('#hidUniqueidEditState').val(stateID);//GETTING VALUE FOR HIDDEN COLUMN
		
	$('#txtStateCodeEdit').val(row.cells[2].innerHTML);
	$('#hidStateCodeEdit').val(row.cells[2].innerHTML);
	$('#txtStateNameEdit').val(row.cells[3].innerHTML);
	var selectedText = oTable.fnGetData( row )[5];
	$('#cmbCountryNameEdit_State').val(selectedText);
	if(action == 'edit')
	{
		$('#hidOperEditState').val("update_state");
		$('#stateEditModal').modal('show');
		
	}	
	else
	{
		
		swal({
		  title: "Are you sure?",
		  text: "you want to Delete the State!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, delete it!",
		  cancelButtonText: "No, cancel",
		  closeOnConfirm: false,
		  closeOnCancel: true
		},
		function(isConfirm){
		  if (isConfirm) {
		  	deleteCode();
		    swal("Deleted", "State has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "State is safe ", "error");
		  }
		});
		function deleteCode()
		{
			$('#stateDeleteModal').modal('hide');	
			
		var institutedata=
		{
			stateID:$('#hidUniqueidEditState').val(),
		};		
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/delete_state",
			type:"post",
			data:institutedata,
			/*cache: false,
			contentType: false,
			processData: false,*/
			success:function(response)
			{
				isEdit_State = false;	
				isDelete_State = false; 
				//alert("huafuda");  
				try
				{
					
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
						toastr.success(obj.msg);
						var dtblProgram = $("#tblStateMaster").DataTable();
	 					dtblProgram.ajax.reload();
					}
					else 
					{
						sweetAlert("MENU",obj.msg, "error");	
					}
				}
				catch(e)
				{
					sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
				}
							 
			},
			error:function()
			{
				toastr.error('Unable to process please contact support');
			}
		});	
		}
	}	
	
}
function districtRow(event,action)
{
	/*load_state_country();*/
	$('#frmDistrictEdit').data('bootstrapValidator').resetForm(true);	
		
	var oTable = $('#tblDistrictMaster').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});			
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	var record_id = oTable.fnGetData( row )[0];
	$(row).addClass('success');
	var districtID = oTable.fnGetData( row )['id'];
	$('#hidUniqueidEditDistrict').val(districtID);//GETTING VALUE FOR HIDDEN COLUMN
	
	$('#txtDistrictCodeEdit').val(oTable.fnGetData(row)['district_code']);
	$('#hidDistrictCodeEdit').val(oTable.fnGetData(row)['district_code']);
	$('#txtDistrictNameEdit').val(oTable.fnGetData(row)['district_name']);
	$('#cmbStateNameEdit_District').val(oTable.fnGetData(row)['state_code']);
	$('#cmbCountryNameEdit_District').val(oTable.fnGetData(row)['country_code']);
	
    	
	
	if(action == 'edit')
	{
		$('#hidOperEditDistrict').val("update_district");
		$('#districtEditModal').modal('show');
		
	}	
	else
	{
		
		swal({
		  title: "Are you sure?",
		  text: "you want to Delete the District!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, delete it!",
		  cancelButtonText: "No, cancel",
		  closeOnConfirm: false,
		  closeOnCancel: true
		},
		function(isConfirm){
		  if (isConfirm) {
		  	deleteCode();
		    swal("Deleted", "District has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "District is safe ", "error");
		  }
		});
		function deleteCode()
		{
			$('#districtDeleteModal').modal('hide');		
			var institutedata=
			{
				districtID:$('#hidUniqueidEditDistrict').val(),
				//type:"DELETE_DISTRICT"
			};		
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/delete_district",
				type:"post",
				data:institutedata,
				/*cache: false,
				contentType: false,
				processData: false,*/
				success:function(response)
				{ 
					isEdit_District = false;	
					isDelete_District = false;
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							 var dtblProgram = $("#tblDistrictMaster").DataTable();
				 			dtblProgram.ajax.reload();	
						}
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					} 
								 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});	
		}
	}	
	
}
function nationalityRow(event,action)
{
	
	$('#frmNationalityEdit').data('bootstrapValidator').resetForm(true);
		
	var oTable = $('#tblNationalityMaster').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});			
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	var record_id = oTable.fnGetData( row )[0];
	$(row).addClass('success');
	var nationalityId = oTable.fnGetData( row )['id'];
	
    $('#hidUniqueidEditNationality').val(nationalityId);//GETTING VALUE FOR HIDDEN COLUMN
	
	$('#txtNationalityCodeEdit').val(row.cells[1].innerHTML);
	$('#hidNationalityCodeEdit').val(row.cells[1].innerHTML);
	$('#txtNationalityNameEdit').val(row.cells[2].innerHTML);	
	
	if(action == 'edit')
	{
		$('#hidOperEditNationality').val("update_nationality");
			$('#nationalityEditModal').modal('show');
		
	}	
	else
	{
		
		swal({
		  title: "Are you sure?",
		  text: "you want to Delete the Nationality!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, delete it!",
		  cancelButtonText: "No, cancel",
		  closeOnConfirm: false,
		  closeOnCancel: true
		},
		function(isConfirm){
		  if (isConfirm) {
		  	deleteCode();
		    swal("Deleted", "Nationality has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Nationality is safe ", "error");
		  }
		});
		function deleteCode()
		{
			$('#nationalityDeleteModal').modal('hide');
			var formData = new FormData(document.getElementById("frmNationalityEdit"));		
			/*var institutedata=
			{
				nationalityID:$('#hidUniqueidEdit').val(),
			};	*/	
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/delete_nationality",
				type:"post",
				data:formData,
				cache: false,
				contentType: false,
				processData: false,
				success:function(response)
				{
					isEdit_Nationality = false;	
					isDelete_Nationality = false; 
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							/*alert("hgadga");*/
							toastr.success(obj.msg);						
							var dtblProgram = $("#tblNationalityMaster").DataTable();
				 			dtblProgram.ajax.reload();
						}
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					} 				 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});	
		}
	}	
	
}
function boardRow(event,action)
{
	
	$('#frmBoardEdit').data('bootstrapValidator').resetForm(true);
	var oTable = $('#tblBoardMaster').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});			
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	var record_id = oTable.fnGetData( row )[0];
	$(row).addClass('success');
	var nationalityId = oTable.fnGetData( row )['id'];
	$('#hidUniqueidEditBoard').val(nationalityId);//GETTING VALUE FOR HIDDEN COLUMN
	
	$('#txtBoardCodeEdit').val(row.cells[1].innerHTML);
	$('#hidBoardCodeEdit').val(row.cells[1].innerHTML);
	$('#txtBoardNameEdit').val(row.cells[2].innerHTML);
	if(action == 'edit')
	{
		$('#hidOperEditBoard').val("update_board");
		$('#boardEditModal').modal('show');
		
	}	
	else
	{
		
		swal({
		  title: "Are you sure?",
		  text: "you want to Delete the Board!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, delete it!",
		  cancelButtonText: "No, cancel",
		  closeOnConfirm: false,
		  closeOnCancel: true
		},
		function(isConfirm){
		  if (isConfirm) {
		  	deleteCode();
		    swal("Deleted", "Board has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Board is safe ", "error");
		  }
		});
		function deleteCode()
		{
			$('#boardDeleteModal').modal('hide');	
		var formData = new FormData(document.getElementById("frmBoardEdit"));	 	
		/*var institutedata=
		{
			boardID:$('#hidUniqueidEdit').val(),
			//type:"DELETE_BOARD"
		};*/		
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/delete_board",
			type:"post",
			data:formData,
			cache: false,
			contentType: false,
			processData: false,
			success:function(response)
			{ 
				isEdit_Board = false;	
				isDelete_Board = false;	 
				try
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
						toastr.success(obj.msg);						
						 var dtblProgram = $("#tblBoardMaster").DataTable();
			 			dtblProgram.ajax.reload();
					}
					else 
					{
						sweetAlert("MENU",obj.msg, "error");	
					}
				}
				catch(e)
				{
					sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
				}
				 /*var dtblProgram = $("#tblBoardMaster").DataTable();
	 			dtblProgram.ajax.reload();*/
				//toastr.success('Data Successfully Deleted');				 
			},
			error:function()
			{
				toastr.error('Unable to process please contact support');
			}
		});	
		}
	}	
	
}

function load_country()
{
	$.ajax({
		url:base_url+"ajax_controller/select_country", 
		type:"post",
		success:function(response){  
			var options = "<option value= '' >Select Country</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.country_code+">"+data.country_name+"</option>";				
			});						
			$('#cmbCountryName_State').html("");   //campusid from academicPeriod
			$('#cmbCountryName_State').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
	$.ajax({
		url:base_url+"ajax_controller/select_country", 
		type:"post",
		success:function(response){  
			var options = "";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.country_code+">"+data.country_name+"</option>";
				
			});
						
			$('#cmbCountryNameEdit_State').html("");   //campusid from academicPeriod
			$('#cmbCountryNameEdit_State').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
}
function load_state_country()
{
	$.ajax({
			/*url:"generic_setup2_db.php?_s="+MY_SESSION_NAME,
			mType:"get",
			data:{type:"SELECT_COUNTRY"},*/
			url:base_url+"ajax_controller/select_country", 
			type:"post",
			success:function(response){  
				var options = "<option value= '' >Select Country</option>";
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data){
					options = options + "<option value="+data.country_code+">"+data.country_name+"</option>";
					
				});
							
				$('#cmbCountryName_District').html("");   //campusid from academicPeriod
				$('#cmbCountryName_District').append(options);		
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	$.ajax({
		url:base_url+"ajax_controller/select_country", 
		type:"post",
		success:function(response){  
			var options = "<option value= '' >Select Country</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.country_code+">"+data.country_name+"</option>";
				
			});
						
			$('#cmbCountryNameEdit_District').html("");   //campusid from academicPeriod
			$('#cmbCountryNameEdit_District').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$.ajax({
		url:base_url+"ajax_controller/select_state", 
		type:"post",
		success:function(response){  
			var options = "<option value= '' >Select State</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.state_code+">"+data.state_name+"</option>";
				
			});
						
			$('#cmbStateName_District').html("");   //campusid from academicPeriod
			$('#cmbStateName_District').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$.ajax({
		url:base_url+"ajax_controller/select_state", 
		type:"post",
		success:function(response){  
			var options = "<option value= '' >Select State</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.state_code+">"+data.state_name+"</option>";
				
			});
						
			$('#cmbStateNameEdit_District').html("");   //campusid from academicPeriod
			$('#cmbStateNameEdit_District').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
}
function standardRow(event,action)
{
	
	$('#frmStandardEdit').data('bootstrapValidator').resetForm(true);
	var oTable = $('#tblStandardMaster').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});			
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	var record_id = oTable.fnGetData( row )[0];
	$(row).addClass('success');
	var standardID = oTable.fnGetData( row )['id'];
	$('#hidUniqueidEditStandard').val(standardID);//GETTING VALUE FOR HIDDEN COLUMN
	
	$('#txtStandardCodeEdit').val(row.cells[1].innerHTML);
	$('#txtStandardNameEdit').val(row.cells[2].innerHTML);
	$('#txtPreviousStandardEdit').val(row.cells[3].innerHTML);
	//GETTING VALUE FOR HIDDEN COLUMN
	
	if(action == 'edit')
	{
		$('#hidOperEditStandard').val("update_standard");
		$('#standardEditModal').modal('show');
	}	
	else
	{
		
		swal({
		  title: "Are you sure?",
		  text: "you want to Delete the Standard!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, delete it!",
		  cancelButtonText: "No, cancel",
		  closeOnConfirm: false,
		  closeOnCancel: true
		},
		function(isConfirm){
		  if (isConfirm) {
		  	deleteCode();
		    swal("Deleted", "Standard has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Standard is safe ", "error");
		  }
		});
		function deleteCode()
		{
			$('#standardDeleteModal').modal('hide');	
			var formData = new FormData(document.getElementById("frmStandardEdit"));
			/*var institutedata=
			{
				standardID:$('#hidUniqueidEditStandard').val(),
				//type:"DELETE_STANDARD"
			};*/		
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/delete_standard",
				type:"post",
				data:formData,
				cache: false,
				contentType: false,
				processData: false,
				success:function(response)
				{  
					isEdit_Standard = false;	
					isDelete_Standard = false;
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							var dtblStandard = $("#tblStandardMaster").DataTable();
				 			dtblStandard.ajax.reload();
						}
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}
									 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});	
		}
	}	
	
}

function qualificationRow(event,action)
{
	
	$('#frmEditQualification').data('bootstrapValidator').resetForm(true);
	var oTable = $('#tblQualification').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});			
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	var record_id = oTable.fnGetData( row )[0];
	$(row).addClass('success');
	var qualificationID = oTable.fnGetData( row )[1];
	
	$('#hidUniqueidEditQualification').val(qualificationID);
	
	$('#txtQualificationCodeEdit').val(row.cells[1].innerHTML);
	$('#txtQualificationNameEdit').val(row.cells[2].innerHTML);
	var selectedvalue = oTable.fnGetData(row )[4];
	
	$("#cmbQualStatusEdit").val(selectedvalue);
	if(action == 'edit')
	{
		$('#hidOperEditQualification').val("update_qualification");
		$('#QualificationEditModal').modal('show');
	}	
	else
	{
		
		swal({
		  title: "Are you sure?",
		  text: "you want to Delete the Qualification!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, delete it!",
		  cancelButtonText: "No, cancel",
		  closeOnConfirm: false,
		  closeOnCancel: true
		},
		function(isConfirm){
		  if (isConfirm) {
		  	deleteCode();
		    swal("Deleted", "Qualification has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Qualification is safe ", "error");
		  }
		});
		function deleteCode()
		{
			$('#QualificationDeleteModal').modal('hide');
			var formData = new FormData(document.getElementById("frmEditQualification"));		
			/*var institutedata=
			{
				hidQualificationCodeEdit:$('#hidQualificationCodeEdit').val(),
			};*/		
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/delete_qualification",
				type:"post",
				data:formData,
				cache: false,
				contentType: false,
				processData: false,
				success:function(response)
				{ 
					isEdit_Qualification = false;	
					isDelete_Qualification = false; 
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							var dtblChallan = $("#tblQualification").DataTable();
				 			dtblChallan.ajax.reload();	 				
						}
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}
							 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});	
		}
	}	
	
}