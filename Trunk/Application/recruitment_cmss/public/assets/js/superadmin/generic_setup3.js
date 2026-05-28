$(document).ready(function(){
	var isDelete= false;
	var isEdit = false;
	MY_SESSION_NAME = '';
	/****************************************************FOR REGISTRATION TEMPLATE****************************************************/
	var tblRegistrationTemplate = $('#tblRegistrationTemplate').dataTable({
		"sAjaxSource": base_url+"ajax_controller/select_registration_template",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4 addRegistrationTemplatebtn'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-5' i>>><'col-xs-3'p>>",
		"aoColumns": [
	                     { "sName": "Slno","sWidth":"5%" },
	                     { "sName": "Code","sWidth":"15%" },
	                     { "sName": "Name","sWidth":"15%" },
						 { "sName": "Description","sWidth":"30%" },
	                     { "sName": "File Name","sWidth":"20%","mRender": function( data, type, full ) {
				                return '<a href="../../registration_template/'+data+'" target="_blank" style="color:blue">'+data+'</a>';
				            } },
	                     { "sName": "resource","bVisible":false},
	                     { "sName": "id","bVisible":false},
	                     { "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "25%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnRegistrationTemplate' onclick='editRegistrationTemplate(event);'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<button id='btnDeleteRegistrationTemplate' title='Delete' class='btn btn-danger tooltipTable btn-circle' onclick='deleteRegistrationTemplate(event);'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}
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
	/**CREATING BUTTON*****/
	$("div.addRegistrationTemplatebtn").html('<button class="btn btn-info tooltips btn-circle" title="Add" id="btnAddRegistrationTemplate"><i class="fa fa-plus" aria-hidden="true"></i></button>');
	/*****END OF BUTTON CREATION******/
	$('#btnAddRegistrationTemplate').click(function(){
		$('#frmRegistrationAddTemplate').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#txtRegistrationTemplateCode').val("");
		$('#txtRegistrationTemplateName').val("");
		$('#textRegistrationTemplateDescription').val("");
		$('#hidRegdTempAdd').val("insert_registration_template");		
		$('#registrationTemplateAddModal').modal('show');
		$('#registrationTemplateAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtRegistrationTemplateCode').focus(); // Focusing the textbox
		})
	});
	$.ajax({
		url:base_url+"ajax_controller/select_file_name", 
		type:"post",
		success:function(response){  
			var options = " <option value=''>Select Template</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.resource_code+">"+data.resource_code+"</option>";
			});
			$('#txtRegistrationFileNameEdit').html("");   //campusid from academicPeriod
			//$('#txtRegistrationFileNameEdit').append(options);
			$('#txtRegistrationFileNameEdit').html(options)
			//$("#txtRegistrationFileNameEdit").selectize();		
			$('#txtRegistrationFileName').html("");   //campusid from academicPeriod
			//$('#txtRegistrationFileName').append(options);
			$('#txtRegistrationFileName').html(options)
			//$("#txtRegistrationFileName").selectize();		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	//ADD RECORD WITH VALIDATION
	$('#frmRegistrationAddTemplate').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingRegdTempAdd").show();
			var formData = new FormData(document.getElementById("frmRegistrationAddTemplate"));	
			var institutedata={
				txtRegistrationTemplateCode:$('#txtRegistrationTemplateCode').val(),
				txtRegistrationTemplateName:$('#txtRegistrationTemplateName').val(),
				textRegistrationTemplateDescription:$('#textRegistrationTemplateDescription').val(),
				txtRegistrationFileName:$('#txtRegistrationFileName').val(),
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/insert_registration_template",
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
							var dtblProgram = $("#tblRegistrationTemplate").DataTable();
				 			dtblProgram.ajax.reload();
				 			$('#frmRegistrationAddTemplate').data('bootstrapValidator').resetForm(true);			
				    	}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_regd_temp_add').html(obj.msg);
		                	$('#errorlog_regd_temp_add').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_regd_temp_add').html(obj.msg);
		                	$('#errorlog_regd_temp_add').show();
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
					$("#spanProcessingRegdTempAdd").hide();			
				},
				error:function(){
					//alert('jjhd');
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call
		},
		fields: {
			txtRegistrationTemplateCode: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					},
					stringLength: {
						max: 10,
						message: 'Code should not be more then 10 characters'
						}
				}
			},
			txtRegistrationTemplateName: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			textRegistrationTemplateDescription: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtRegistrationFileName: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}
	});
	//END OF ADD RECORD WITH VALIDATION
	$('#txtRegistrationTemplateCode').on("blur",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtCode:$(event.target).val(),
					validatemenucode:true,
				};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_registration_code",
				type:"post",
				data:institutedata,				
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
					 	$('#frmRegistrationAddTemplate').data('bootstrapValidator').updateStatus('txtRegistrationTemplateCode', 'INVALID', null);
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
	/****************************************************FOR PROFILE TEMPLATE****************************************************/
	var templateMaster = $('#tblTemplateMaster').dataTable({
		"sAjaxSource": base_url+"ajax_controller/select_template_master",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4 addTemplatebtn'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-5' i>>><'col-xs-3'p>>",
		"aoColumns": [
	                     { "sName": "Slno","sWidth":"5%" },
	                     { "sName": "Code","sWidth":"15%" },
	                     { "sName": "Name","sWidth":"15%" },
						 { "sName": "Description","sWidth":"30%" },
	                     { "sName": "File Name","sWidth":"25%","mRender": function( data, type, full ) {
						 		//templateMaster.removeClass('success');
				                return '<a href="../../form_template/'+data+'" target="_blank" style="color:blue">'+data+'</a>';
				            } },
				         { "sName": "resource","bVisible":false},
	                     { "sName": "id","bVisible":false},
	                     { "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "20%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEditTemplate' onclick='editTemplate(event);'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<button id='btnDeleteTemplate' title='Delete' class='btn btn-danger tooltipTable btn-circle' onclick='deleteTemplate(event);'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}
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
/**CREATING BUTTON*****/
	$("div.addTemplatebtn").html('<button class="btn btn-info tooltips btn-circle" title="Add" id="btnAddTemplate"><i class="fa fa-plus" aria-hidden="true"></i></button>');
	

/*****END OF BUTTON CREATION******/

	
/*****END OF AJAX CALL TO GET DATA FROM DATABASE**********/

	$('#btnAddTemplate').click(function(){
		$('#frmAddTemplate').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#txtTemplateCode').val("");
		$('#txtTemplateName').val("");
		$('#txtFileName').val("");
		$('#hidProfTempAdd').val("insert_profile_template");
		
		$('#templateAddModal').modal('show');
		$('#templateAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtTemplateCode').focus(); // Focusing the textbox
		})
	});
	
	// to select data when edit button is click
	$.ajax({
		url:base_url+"ajax_controller/select_file_template_name", 
		type:"post",
		success:function(response){  
			var options = " <option value=''>Select Template</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.resource_name+">"+data.resource_code+"</option>";
			});	
			$('#txtFileName').html("");   //campusid from academicPeriod  
			//$('#txtFileName').append(options);		
			$('#txtFileName').html(options)
			//$("#txtFileName").selectize();	
			$('#txtFileNameEdit').html("");   //campusid from academicPeriod
			//$('#txtFileNameEdit').append(options);		
			$('#txtFileNameEdit').html(options)
			//$("#txtFileNameEdit").selectize();	
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
//ADD RECORD WITH VALIDATION

	$('#frmAddTemplate').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingProfTempAdd").show();
			var formData = new FormData(document.getElementById("frmAddTemplate"));	
			var institutedata={
				txtTemplateCode:$('#txtTemplateCode').val(),
				txtTemplateName:$('#txtTemplateName').val(),
				textTemplateDescription:$('#textTemplateDescription').val(),
				txtFileName:$('#txtFileName').val(),
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/insert_profile_template",
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
							var dtblProgram = $("#tblTemplateMaster").DataTable();
				 			dtblProgram.ajax.reload();
				 			$('#frmAddTemplate').data('bootstrapValidator').resetForm(true);			
				    	}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_prof_temp_add').html(obj.msg);
		                	$('#errorlog_prof_temp_add').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_prof_temp_add').html(obj.msg);
		                	$('#errorlog_prof_temp_add').show();
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
					$("#spanProcessingProfTempAdd").hide();			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call
					
		},
		fields: {
			txtTemplateCode: {							//form input type name
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
						message: 'Code should not be more then 5 characters'
						}
				}
			},
			txtTemplateName: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			textTemplateDescription: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtFileName: {
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

	
//END OF EDIT RECORD WITH VALIDATION

/****DELETE RECORD DELETE********/
	$('#templateDeleteRecord').click(function()
	{
		$('#templateDeleteModal').modal('hide');		
		var institutedata=
		{
			templateID:$('#hidUniqueidEdit').val(),
		};		
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/delete_profile_template",
			type:"post",
			data:institutedata,
			cache: false,
			contentType: false,
			processData: false,
			success:function(response)
			{ 
				try
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
						toastr.success(obj.msg);
						 var dtblProgram = $("#tblTemplateMaster").DataTable();
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
			
	});
	$('#txtTemplateCode').on("blur",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtCode:$(event.target).val(),
					validatemenucode:true,
				};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_template_code",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					//alert(response)
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
					 	$('#frmAddTemplate').data('bootstrapValidator').updateStatus('txtTemplateCode', 'INVALID', null);
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
	// CHECKING DUPLICATION OF MENU CODE FOR EDIT
	/*$('#txtTemplateCodeEdit').on("blur",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtCodeEdit:$(event.target).val(),
					validatemenucode:true,
				};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_template_code_edit",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
					 	$('#frmTemplateEdit').data('bootstrapValidator').updateStatus('txtTemplateCodeEdit', 'INVALID', null);
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
	});*/
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
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	        return false;
	    }
    return true;
}
function editRegistrationTemplate(event)
{
	var oTable = $('#tblRegistrationTemplate').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	else
  		row = event.target.parentNode;
   	var templateID = oTable.fnGetData(row)['template_code'];//GETTING DATA FOR HIDDEN COLUMN
   	$('#hidUniqueidEditRegistration').val(templateID);
   	$('#hidRegdTempEdit').val("update_registration_template");
	$('#txtRegistrationTemplateCodeEdit').val(templateID);
	$('#txtRegistrationTemplateNameEdit').val(oTable.fnGetData(row)['template_name']);
	$('#textRegistrationTemplateDescriptionEdit').val(oTable.fnGetData(row)['template_description']);
	$('#txtRegistrationFileNameEdit').val(oTable.fnGetData(row)['resource_code']);
	var filename = "";
	var selectedText = oTable.fnGetData(row)['resource_code'];
	/*var select = $('#txtRegistrationFileNameEdit').selectize();
	var selectize = select[0].selectize;
	selectize.setValue(selectedText);*/
	$('#registrationTemplateEditModal').modal('show');
	
	$('#frmRegistrationTemplateEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingRegdTempEdit").show();	
			var formData = new FormData(document.getElementById("frmRegistrationTemplateEdit"));				
			var institutedata={
				hidUniqueidEditRegistration:$('#hidUniqueidEditRegistration').val(),
				txtRegistrationTemplateCodeEdit:$('#txtRegistrationTemplateCodeEdit').val(),
				txtRegistrationTemplateNameEdit:$('#txtRegistrationTemplateNameEdit').val(),
				textRegistrationTemplateDescriptionEdit:$('#textRegistrationTemplateDescriptionEdit').val(),
				txtRegistrationFileNameEdit:$('#txtRegistrationFileNameEdit').val(),
				//type:"UPDATE_REGISTRATION_TEMPLATE"
			};
		//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/update_registration_template",
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
							$('#registrationTemplateEditModal').modal('hide');		
							var dtblProgram = $("#tblRegistrationTemplate").DataTable();
				 			dtblProgram.ajax.reload();
				 			$('#frmRegistrationTemplateEdit').data('bootstrapValidator').resetForm(true);			
				    	}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_regd_temp_edit').html(obj.msg);
		                	$('#errorlog_regd_temp_edit').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_regd_temp_edit').html(obj.msg);
		                	$('#errorlog_regd_temp_edit').show();
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
					$("#spanProcessingRegdTempEdit").hide();			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call
				
		},
		fields:{
			txtRegistrationTemplateCodeEdit: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					},
					stringLength: {
						max: 10,
						message: 'Code should not be more then 10 characters'
						}
				}
			},
			txtRegistrationTemplateNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			textRegistrationTemplateDescriptionEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtRegistrationFileNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}
			
	});
}
function deleteRegistrationTemplate(event)
{
	// sweet-alert for delete
	swal({
	  title: "Are you sure?",
	  text: "You want to Delete the Template!",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Yes, delete it!",
	  cancelButtonText: "No, cancel",
	  closeOnConfirm: false,
	  closeOnCancel: true
	},
	function(isConfirm){
	  	if (isConfirm) 
	  	{
	  		var oTable = $('#tblRegistrationTemplate').dataTable();
			var row;
			if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
			   row = event.target.parentNode.parentNode;
			else if(event.target.tagName == "I")
			   row = event.target.parentNode.parentNode.parentNode;
			var templateID = oTable.fnGetData(row)['template_code'];//GETTING DATA FOR HIDDEN COLUMN
   			$('#hidUniqueidEditRegistration').val(templateID);
   			var institutedata=
			{
				templateID:$('#hidUniqueidEditRegistration').val()
			};	
			
			//ajax call to server
			/*$.ajax({
				url:base_url+"ajax_controller/delete_registration_template",
				type:"post",
				data:institutedata,
				success:function(response)
				{  
					var res = JSON.parse(response); 
					if(res.status)
					{
						toastr.success(res.msg);
						var dtblChallan = $("#tblTransactionChargeMaster").DataTable();
			 			dtblChallan.ajax.reload();	
						
					}
					else
					{
						toastr.error(res.msg);
						var dtblChallan = $("#tblTransactionChargeMaster").DataTable();
			 			dtblChallan.ajax.reload();
					}	
					 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});	*/
   			/*var institutedata=
			{
				templateID:$('#hidUniqueidEditRegistration').val()
				//type:"DELETE_REGISTRATION_TEMPLATE"
			};*/
			//alert(templateID);		
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/delete_registration_template",
				type:"post",
				data:institutedata,
				success:function(response)
				{ 
					try
					{
						//alert(templateID);
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							//alert(templateID);
							toastr.success(obj.msg);
							var tblRegistrationTemplate = $("#tblRegistrationTemplate").DataTable();
			 				tblRegistrationTemplate.ajax.reload();
							swal("Deleted", "Template has been deleted successfully.", "success");
						}
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
							var tblRegistrationTemplate = $("#tblRegistrationTemplate").DataTable();
			 				tblRegistrationTemplate.ajax.reload();
			 				$('#templateDeleteModalError').modal('show');
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
					
			$('#closeDeleteRecord').click(function()
			{
				swal("Cancelled", " Template is safe ", "error");
				$('#templateDeleteModalError').modal('hide');
			});	
		} 
		else 
		{
			swal("Cancelled", " Template is safe ", "error");
	  	}
	});
	
	
	
}
function editTemplate(event)
{
	var oTable = $('#tblTemplateMaster').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	else
  		row = event.target.parentNode;
   	var templateID = oTable.fnGetData(row)['template_code'];
   	$('#hidUniqueidEdit').val(templateID);//GETTING VALUE FOR HIDDEN COLUMN
   	$('#hidProfTempEdit').val("update_profile_template");
	$('#txtTemplateCodeEdit').val(oTable.fnGetData(row)['template_code']);
	$('#txtTemplateNameEdit').val(oTable.fnGetData(row)['template_name']);
	$('#textTemplateDescriptionEdit').val(oTable.fnGetData(row)['template_description']);
	$('#txtFileNameEdit').val(oTable.fnGetData(row)['resource_name']);
	var filename = "";
	var selectedText = oTable.fnGetData(row)['resource_code'];
	/*var select = $('#txtFileNameEdit').selectize();
	var selectize = select[0].selectize;
	selectize.setValue(selectedText);*/
	$('#templateEditModal').modal('show');
	
	$('#frmTemplateEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingProfTempEdit").show();	
			var formData = new FormData(document.getElementById("frmTemplateEdit"));			
			var institutedata={
				hidUniqueidEdit:$('#hidUniqueidEdit').val(),
				txtTemplateCodeEdit:$('#txtTemplateCodeEdit').val(),
				txtTemplateNameEdit:$('#txtTemplateNameEdit').val(),
				textTemplateDescriptionEdit:$('#textTemplateDescriptionEdit').val(),
				txtFileNameEdit:$('#txtFileNameEdit').val(),
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/update_profile_template",
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
							$('#templateEditModal').modal('hide');		
							var dtblProgram = $("#tblTemplateMaster").DataTable();
				 			dtblProgram.ajax.reload();
				 			$('#frmTemplateEdit').data('bootstrapValidator').resetForm(true);				
				    	}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_prof_temp_edit').html(obj.msg);
		                	$('#errorlog_prof_temp_edit').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_prof_temp_edit').html(obj.msg);
		                	$('#errorlog_prof_temp_edit').show();
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
					$("#spanProcessingProfTempEdit").hide();			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call
				
		},
		fields:{
			txtTemplateCodeEdit: {							//form input type name
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
						message: 'Code should not be more then 5 characters'
						}
				}
			},
			txtTemplateNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			textTemplateDescriptionEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtFileNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}
			
	});
}
function deleteTemplate(event)
{
	// sweet-alert for delete
	swal({
	  title: "Are you sure?",
	  text: "You want to Delete the Template!",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Yes, delete it!",
	  cancelButtonText: "No, cancel",
	  closeOnConfirm: false,
	  closeOnCancel: true
	},
	function(isConfirm){
	  	if (isConfirm) 
	  	{
	  		var oTable = $('#tblTemplateMaster').dataTable();
			var row;
			if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
			   row = event.target.parentNode.parentNode;
			else if(event.target.tagName == "I")
			   row = event.target.parentNode.parentNode.parentNode;
			var templateID = oTable.fnGetData(row)['template_code'];
   			$('#hidUniqueidEdit').val(templateID);//GETTING VALUE FOR HIDDEN COLUMN
			var institutedata=
			{
				templateID:$('#hidUniqueidEdit').val(),
			};		
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/delete_profile_template",
				type:"post",
				data:institutedata,
				success:function(response)
				{ 
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							var dtblProgram = $("#tblTemplateMaster").DataTable();
				 			dtblProgram.ajax.reload();
							swal("Deleted", "Template has been deleted successfully.", "success");	
						}
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
							var dtblProgram = $("#tblTemplateMaster").DataTable();
			 				dtblProgram.ajax.reload();
			 				$('#deleteModalError').modal('show');
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
				
				
			$('#closetemplateDeleteRecord').click(function()
			{
				swal("Cancelled", " Template is safe ", "error");
				$('#deleteModalError').modal('hide');
			});	
		} 
		else 
		{
			swal("Cancelled", " Template is safe ", "error");
	  	}
	});
}
