$(document).ready(function(){
	var isDelete_Template= false;
	var isDelete_Document= false;
	var isDelete_Category= false;
	var isDelete_Minority_community= false;
	var isDelete_Caste= false;
	var isDelete_Religion= false;
	var isDelete_Instruction= false;
	
	var isEdit_Template = false;
	var isEdit_Menu = false;
	var isEdit_Program_Group = false;
	var isEdit_Document = false;
	var isEdit_sDocument = false;
	var isEdit_Category = false;
	var isEdit_Minority_community = false;
	var isEdit_Caste = false;
	var isEdit_Religion = false;
	var isEdit_Instruction = false;
	MY_SESSION_NAME = '';
	var templateMaster = $('#tblTemplateMaster').dataTable({
		
		"sAjaxSource": base_url+"ajax_controller/select_template",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 institutegroupbutton' >>><'col-xs-6'p>>",
		"aoColumns": [
	                     { "sName": "Slno","sWidth":"5%" },
	                     { "sName": "Code","sWidth":"15%" },
	                     { "sName": "Name","sWidth":"15%" },
						 { "sName": "Description","sWidth":"30%" },
	                     { "sName": "File Name","sWidth":"25%"},
	                     { "sName": "id","bVisible":false},
	                     {"sName": "default","sWidth": "15%", "sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='templateRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>\
				            <button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='templateRow(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}
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

	$("div.institutegroupbutton").html('<div class="btngroup"><button id="btnAddTemplate" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button></div>');


	$.ajax({
		url:base_url+"ajax_controller/get_file_name1",
		type:"post",
		success:function(response)
		{  
			var options = "<option value=''>Select</option>";					
			var res1 = JSON.parse(response);					
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value='"+data.resource_code+"'>"+data.resource_code+"</option>";
			});
			$('#txtFileName').html("");   
			$('#txtFileName').append(options);
			$('#txtFileName').html(options);
			
			$('#txtFileNameEdit').html("");   
			$('#txtFileNameEdit').append(options);
			$('#txtFileNameEdit').html(options);
		},
		error:function()
		{
			toastr.error('We are unable to process please contact support');	
		}
	}) ;

	$('#btnAddTemplate').click(function(e){
		$('#frmAddTemplate').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
			
		$(templateMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		$('#txtTemplateCode').val("");
		$('#txtTemplateName').val("");
		$('#txtFileName').val("");
		
		$('#templateAddModal').modal('show');
		$('#templateAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtTemplateCode').focus(); // Focusing the textbox
		})
		
	});
	
	$('#txtLastDate').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
		
	    $('#frmAddProgramGroup').data('bootstrapValidator').updateStatus('txtLastDate', 'VALIDATED').validateField('txtLastDate');
	}).datepicker('setStartDate', new Date());
	$('#txtLastDateEdit').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy'
	    
	}).on('changeDate', function (selected) {
	    $('#frmEditProgramGroup').data('bootstrapValidator').updateStatus('txtLastDateEdit', 'VALIDATED').validateField('txtLastDateEdit');
	}).datepicker('setStartDate', new Date());;
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
			var institutedata={
				txtTemplateCode:$('#txtTemplateCode').val(),
				txtTemplateName:$('#txtTemplateName').val(),
				textTemplateDescription:$('#textTemplateDescription').val(),
				txtFileName:$('#txtFileName').val(),
				//type:"INSERT_TEMPLATE"
			};
			//ajax call to server **********************************************by me
			$.ajax({
				url:base_url+"ajax_controller/insert_template",
				type:"post",
				data:institutedata,
				success:function(response){  
					try
					{
						var obj = jQuery.parseJSON(response);
						//alert(obj.status);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							var dtblProgram = $("#tblTemplateMaster").DataTable();
				 			dtblProgram.ajax.reload();
				 			$('#frmAddTemplate').data('bootstrapValidator').resetForm(true);
				 		}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_menu_add').html(obj.msg);
		                	$('#errorlog_menu_add').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_menu_add').html(obj.msg);
		                	$('#errorlog_menu_add').show();
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
					$("#spanProcessingMenu").hide();
						
					//toastr.success('Data Successfully Inserted');				
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
			/*$.ajax({
				url:"generic_setup1_db.php?_s="+MY_SESSION_NAME,
				mType:"post",
				data:institutedata,
				success:function(){  
					var dtblProgram = $("#tblTemplateMaster").DataTable();
		 			dtblProgram.ajax.reload();
		 			$('#frmAddTemplate').data('bootstrapValidator').resetForm(true);	
					toastr.success('Data Successfully Inserted');				
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call*/	
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
							
			var institutedata={
				hidUniqueidEdit:$('#hidUniqueidEdit').val(),
				txtTemplateCodeEdit:$('#txtTemplateCodeEdit').val(),
				txtTemplateNameEdit:$('#txtTemplateNameEdit').val(),
				textTemplateDescriptionEdit:$('#textTemplateDescriptionEdit').val(),
				txtFileNameEdit:$('#txtFileNameEdit').val(),
				//type:"UPDATE_TEMPLATE"
			};
		//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/update_generic_template",
				type:"post",
				data:institutedata,
				success:function(response){  
					isDelete_Template= false;
					isEdit_Template = false;
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							var dtblProgram = $("#tblTemplateMaster").DataTable();
				 			dtblProgram.ajax.reload();
				 			$('#frmTemplateEdit').data('bootstrapValidator').resetForm(true);
				 			$('#templateEditModal').modal('hide');
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_menu_add').html(obj.msg);
		                	$('#errorlog_menu_add').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_menu_add').html(obj.msg);
		                	$('#errorlog_menu_add').show();
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
					$("#spanProcessingMenu").hide();
						
					//toastr.success('Data Successfully Inserted');				
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
			/*$.ajax({
				url:"generic_setup1_db.php?_s="+MY_SESSION_NAME,
				mType:"post",
				data:institutedata,
				success:function(){  
							$('#templateEditModal').modal('hide');		
							var dtblProgram = $("#tblTemplateMaster").DataTable();
				 			dtblProgram.ajax.reload();
				 			$('#frmTemplateEdit').data('bootstrapValidator').resetForm(true);	
							toastr.success('Data Successfully Updated');
									
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});*/
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
//END OF EDIT RECORD WITH VALIDATION


	$('#txtTemplateCode').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
				var institutedata=
				{
					txtCode:$(event.target).val(),
					validatemenucode:true,
					//type:"CHKDUCPLICATE_CODE"
				};
		   //ajax call to server
		   	$.ajax({
				url:base_url+"ajax_controller/check_duplicacy_code",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
					 	$('#frmAddTemplate').data('bootstrapValidator').updateStatus('txtTemplateCode', 'NOT_VALIDATED', null).validateField('txtTemplateCode');
						toastr.error('Template Code Already Created');
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
	
	$('#txtMenuCode').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
				var institutedata=
				{
					txtCode:$(event.target).val(),
					validatemenucode:true,
					//type:"CHKDUCPLICATE_CODE"
				};
		   //ajax call to server
		   	$.ajax({
				url:base_url+"ajax_controller/check_duplicacy_menu_code",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
					 	$('#frmMenuAdd').data('bootstrapValidator').updateStatus('txtMenuCode', 'NOT_VALIDATED', null).validateField('txtMenuCode');
						toastr.error('Menu Code Already Created');
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
	$('#txtTemplateCodeEdit').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtCodeEdit:$(event.target).val(),
					validatemenucode:true,
					type:"CHKEDITDUCPLICATE_CODE"
				};
		   //ajax call to server
		   		$.ajax({
				url:base_url+"ajax_controller/check_duplicacy_code_Edit",
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
	});
	$('#templateEditModal').on('hidden.bs.modal', function (e) {
 		$('#frmTemplateEdit').data('bootstrapValidator').resetForm(true);
 		$(templateMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isDelete_Template= false;
		isEdit_Template = false;
	})
	//********************************************************** FOR MENU TAB****************************************//
	
	var programMenuMaster = $('#tblMenuMaster').dataTable({
		
		"sAjaxSource": base_url+"ajax_controller/select_program_menu",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 menubutton' >>><'col-xs-6'p>>",
		"aoColumns": [
	                     { "sName": "Slno","sWidth": "3%" },
	                     { "sName": "Code" },
	                     { "sName": "link text" },
	                     { "sName": "link url" },
						 { "sName": "new window" },
						 { "sName": "document upload","sWidth": "12%" },
						 { "sName": "record status","sWidth": "8%","sClass":"alignCenter",
							"mRender": function( data, type, full ) {
								if(data == '1')
								{
									return '<img src="'+base_url+'public/assets/images/ACTIVE.png" ></img>';
								}
								else
								{
									 return '<img src="'+base_url+'public/assets/images/INACTIVE.png" ></img>';
								}
						       
					    }},
						 { "sName": "menu slno" },
	                     { "sName": "id","bVisible":false },
	                       {"sName": "default","sWidth": "15%", "sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='menuRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>"}
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

	$("div.menubutton").html('<div class="btngroup"><button id="btnAddMenu" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button></div>');

/*****END OF BUTTON CREATION******/

	$('#btnAddMenu').click(function(e){
			
		$(programMenuMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isEdit_Menu = false; //alert(isEdit_Menu);
		$('#errorlog_menu_add').hide();
		$('#frmMenuAdd').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#txtMenuCode').val("");
		$('#txtLinkText').val("");
		$('#hidOperProgramMenu').val("add_program_menu");
		
		$('#txtLinkURL').val("");
		$('#cmbNewWindow').val("");
		$('#cmbDocumentUpload').val("");
		$('#cmbRecordStatus').val("");
		$('#txtProgramMenuSlno').val("");
		
		$('#menuAddModal').modal('show');
		$('#menuAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtMenuCode').focus(); // Focusing the textbox
		})
	});
	
	
//ADD RECORD WITH VALIDATION

	$('#frmMenuAdd').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingMenu").show();
			var formData = new FormData(document.getElementById("frmMenuAdd"));
			var institutedata={
				txtMenuCode:$('#txtMenuCode').val(),
				txtLinkText:$('#txtLinkText').val(),
				txtLinkURL:$('#txtLinkURL').val(),
				cmbNewWindow:$('#cmbNewWindow').val(),
				cmbDocumentUpload:$('#cmbDocumentUpload').val(),
				cmbRecordStatus:$('#cmbRecordStatus').val(),
				txtProgramMenuSlno:$('#txtProgramMenuSlno').val(),
				type:"INSERT_MENU"
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_program_menu_add",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){  
					isEdit_Menu = false;	 
					try
					{
						
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							$('#menuAddModal').modal('hide');
							toastr.success(obj.msg);
							var dtblProgram = $("#tblMenuMaster").DataTable();
				 			dtblProgram.ajax.reload();
				 			$('#frmMenuAdd').data('bootstrapValidator').resetForm(true);
				 			
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_menu_add').html(obj.msg);
		                	$('#errorlog_menu_add').show();
		                	
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_menu_add').html(obj.msg);
		                	$('#errorlog_menu_add').show();
		                	
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
					$("#spanProcessingMenu").hide();
						
					//toastr.success('Data Successfully Inserted');				
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			txtMenuCode: {							//form input type name
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
			txtLinkText: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtLinkURL: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbNewWindow: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbDocumentUpload: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbRecordStatus: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtProgramMenuSlno: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits:{
						message:'This field can contain only digit'
					}
				}
			}
		}
	});
//END OF ADD RECORD WITH VALIDATION


//EDIT RECORD WITH VALIDATION

	$('#frmMenuEditModal').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$("#spanProcessingMenuEdit").show();
			var a=$('#hidUniqueidEditMenu').val();
			//alert(a);
			var formData = new FormData(document.getElementById("frmMenuEditModal"));	
			var institutedata={
				hidUniqueidEditMenu:$('#hidUniqueidEditMenu').val(),
				txtMenuCodeEdit:$('#txtMenuCodeEdit').val(),
				txtLinkTextEdit:$('#txtLinkTextEdit').val(),
				txtLinkURLEdit:$('#txtLinkURLEdit').val(),
				cmbNewWindowEdit:$('#cmbNewWindowEdit').val(),
				cmbDocumentUploadEdit:$('#cmbDocumentUploadEdit').val(),
				cmbRecordStatusEdit:$('#cmbRecordStatusEdit').val(),
				txtProgramMenuSlnoEdit:$('#txtProgramMenuSlnoEdit').val(),
				//type:"UPDATE_MENU"
			};
		//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_program_menu_edit",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){
					isEdit_Menu = false;	 
					try
					{
						var obj = jQuery.parseJSON(response);
						//alert(obj.status);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							var dtblProgram = $("#tblMenuMaster").DataTable();
				 			dtblProgram.ajax.reload();
				 			$('#frmMenuEditModal').data('bootstrapValidator').resetForm(true);
				 			$("#menuEditModal").modal('hide');
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_menu_edit').html(obj.msg);
		                	$('#errorlog_menu_edit').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_menu_edit').html(obj.msg);
		                	$('#errorlog_menu_edit').show();
		                }
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
						$("#spanProcessingMenuEdit").hide();
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}
						
					//toastr.success('Data Successfully Inserted');			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields:{
			txtMenuCodeEdit: {							//form input type name
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
			txtLinkTextEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtLinkURLEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbNewWindowEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbDocumentUploadEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbRecordStatusEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtProgramMenuSlnoEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits:{
						message:'This field can contain only digit'
					}
				}
			}
		}
			
	});
//END OF EDIT RECORD WITH VALIDATION


	// CHECKING DUPLICATION OF MENU CODE FOR EDIT
	$('#txtMenuCodeEdit').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtMenuCodeEdit:$(event.target).val()
				};
			
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_program_menu_code_edit",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$('#txtMenuCodeEdit').val("");
						$('#frmMenuEditModal').data('bootstrapValidator').updateStatus('txtMenuCodeEdit', 'NOT_VALIDATED', null).validateField('txtMenuCodeEdit');
						toastr.error('Menu Code Already Created');
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
	$('#menuEditModal').on('hidden.bs.modal', function (e) {
 		$('#frmMenuEditModal').data('bootstrapValidator').resetForm(true);
 		$(programMenuMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isEdit_Menu = false;
	})
	
	//**************************************************** FOR PROGRAM GROUP TAB************************************//
	
	var programGroup = $('#tblProgramGroup').dataTable({
			
		"sAjaxSource": base_url+"ajax_controller/select_program_group",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
		"bDestroy" : true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 programgroupbutton' >>><'col-xs-6'p>>",
		"aoColumns": [
	                     { "sName": "Slno","sWidth": "5%" },
	                     { "sName": "program_group_code","sWidth": "15%" },
	                     { "sName": "program_group_name","sWidth": "30%" },
	                     { "sName": "application_last_date","sWidth": "20%" },
						 { "sName": "Record Status" ,"sWidth": "15%","sClass":"alignCenter",
							"mRender": function( data, type, full ) {
						        return '<img src="'+base_url+'public/assets/images/'+ data +'.png" ></img>';
					    }},
                       {"sName": "default","sWidth": "15%", "sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='programgroupRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>"}
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
	$("div.programgroupbutton").html('<div class="btngroup"><button id="btnAddProgramGroup" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button></div>');
/*****END OF BUTTON CREATION******/
	
	
	$('#btnAddProgramGroup').click(function(e){
	//alert("hello");
		//$('#frmAddCentre').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal
		isEdit_Program_Group = false;
		$('#frmAddProgramGroup').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal
		//$('#txtProgramGroupCode').val("");
		$(programGroup.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		var group = $("#hidProgramGroupCode").val();
		$('#txtProgramGroupCode').val(group);
		$('#txtProgramGroupName').val("");
		$("#txtLastDate").datepicker().datepicker("setDate", new Date());
		$('#txtLastDate').val("");
		/*$("#txtLastDate").datepicker("destroy");
		$("#txtLastDate").datepicker("refresh");*/
		$('#hidOperProgramGroup').val("add_program_group");
		$('#txtStatus').val("");
		
		$('#programGroupAddModal').modal('show');
		$('#programGroupAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtProgramGroupName').focus(); // Focusing the textbox
		})
	});
   
 	$('#frmAddProgramGroup').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			//alert($('#cmbProgramCode').val());
			
			var formData = new FormData(document.getElementById("frmAddProgramGroup"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_program_group_add",
				type:"post",
				data:formData,
				contentType: false,
		        processData: false,
				success:function(response){
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							var dtblProgramGroup = $("#tblProgramGroup").DataTable();
		 					dtblProgramGroup.ajax.reload();
		 					$('#frmAddProgramGroup').data('bootstrapValidator').resetForm(true);
		 					$.ajax({
								url:base_url+"ajax_controller/program_group_data",
								type:"post",
								data:'',
								success:function(response)
								{
									
									var obj = jQuery.parseJSON(response);
									$("#hidProgramGroupCode").val(obj.program_group_code);
									var group = $("#hidProgramGroupCode").val();
									$('#txtProgramGroupCode').val(group);
								},  
								error:function()
								{
									toastr.error('Unable to process please contact support');
								}
							});
		 					
							$('#errorlog_program_group').hide();
				    		$('#programGroupAddModal').modal('hide');
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_program_group').html(obj.msg);
		                	$('#errorlog_program_group').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_program_group').html(obj.msg);
		                	$('#errorlog_program_group').show();
		                }
						else 
						{
							sweetAlert("PROGRAM GROUP",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}
						
					//toastr.success('Data Successfully Inserted');			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}  
						

			});//end of ajax call	
		},
		fields: {
			txtProgramGroupCode: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtProgramGroupName: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtLastDate: {
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
	$('#frmEditProgramGroup').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
					
			var formData = new FormData(document.getElementById("frmEditProgramGroup"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_program_group_edit",
				type:"post",
				contentType: false,
		    	processData: false,
				data:formData,
				success:function(response){ 
					isEdit_Program_Group = false;
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							var dtblProgramGroup = $("#tblProgramGroup").DataTable();
		 					dtblProgramGroup.ajax.reload();
		 					$('#frmEditProgramGroup').data('bootstrapValidator').resetForm(true);
		 					$('#programGroupEditModal').modal('hide');
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_program_group_edit').html(obj.msg);
		                	$('#errorlog_program_group_edit').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_program_group_edit').html(obj.msg);
		                	$('#errorlog_program_group_edit').show();
		                }
						else 
						{
							sweetAlert("PROGRAM GROUP",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields:{
			txtProgramGroupCodeEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtProgramGroupNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtLastDateEdit: {
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
	
	// CHECKING DUPLICATION OF PROGRAM CODE
	$('#txtProgramGroupCode').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtProgramGroupCode:$(event.target).val()
				};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_program_group_code",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status)
					{
					 	$(event.target).val("");
					 	$('#frmAddProgramGroup').data('bootstrapValidator').updateStatus('txtProgramGroupCode', 'NOT_VALIDATED', null).validateField('txtProgramGroupCode');
						toastr.error('Program Group Code Already Created');
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
	
	$('#txtProgramGroupCodeEdit').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtProgramGroupCodeEdit:$(event.target).val()
				};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_program_group_code_edit",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status)
					{
					 	$(event.target).val("");
					 	$('#frmEditProgramGroup').data('bootstrapValidator').updateStatus('txtProgramGroupCodeEdit', 'NOT_VALIDATED', null).validateField('txtProgramGroupCodeEdit');
						toastr.error('Program Group Code Already Created');
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
	$('#programGroupEditModal').on('hidden.bs.modal', function (e) {
 		$('#frmEditProgramGroup').data('bootstrapValidator').resetForm(true);
 		$(programGroup.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isEdit_Program_Group = false;
	})
	//****************************************** FOR DOCUMENT TAB *****************************************//
	
	var documentMaster = $('#tblDocumentMaster').dataTable({
		
		"sAjaxSource": base_url+"ajax_controller/select_program_document",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": true,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 documentgroupbutton' >>><'col-xs-6'p>>",
		"aoColumns": [
	                     { "sName": "Slno" ,"sWidth": "5%"},
	                     { "sName": "Code" },
	                     { "sName": "name" },
	                     { "sName": "document_description","bVisible":false },
	                     { "sName": "document_size_description","bVisible":false },
	                     { "sName": "document_size" },
	                     { "sName": "document_preview_height" },
	                     { "sName": "document_preview_width" },
	                     { "sName": "id","bVisible":false },
	                     { "sName": "doc_extension","bVisible":false },
                       {"sName": "default","sWidth": "15%", "sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='documentRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>\
			            <button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='documentRow(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}
              	     ]               
	});
	CKEDITOR.replace("txtDocumentDesc",{
					toolbarCanCollapse: true,
    				toolbarStartupExpanded: false,
					startupFocus : true
				});
	CKEDITOR.replace("txtDocumentDescEdit",{
					toolbarCanCollapse: true,
    				toolbarStartupExpanded: false,
					startupFocus : true
				});
	CKEDITOR.replace("txtDocumentSizeDesc",{
					toolbarCanCollapse: true,
    				toolbarStartupExpanded: false
					
				});
	CKEDITOR.replace("txtDocumentSizeDescEdit",{
					toolbarCanCollapse: true,
    				toolbarStartupExpanded: false
					
				});
	CKEDITOR.config.toolbar = [
					{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
					{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
					{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Scayt' ] },
					
					{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
					{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
					'/',	
					{ name: 'insert', items: [ 'Table', 'HorizontalRule', 'Symbol', 'base64image' ] },
					{ name: 'styles', items: [ 'Styles', 'Format' ] },
					{ name: 'colors', items : [ 'TextColor','BGColor' ] }
					
					
				];
				CKEDITOR.config.extraPlugins = 'lineutils,widget,codesnippet,symbol,base64image';
				CKEDITOR.config.codeSnippet_theme = 'mono-blue';
				CKEDITOR.config.allowedContent = true;
				CKEDITOR.config.height = 100;
/**CREATING BUTTON*****/
	$("div.documentgroupbutton").html('<div class="btngroup"><button id="btnAddDocument" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button></div>');

/*****END OF BUTTON CREATION******/

	$('#btnAddDocument').click(function(e){
		isEdit_Document = false;	
		isDelete_Document = false;		
		$(documentMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		$('#frmDocumentAdd').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#txtDocumentCode').val("");
		$('#txtDocumentName').val("");
		$('#txtLinkURL').val("");
		$('#hidOperDocument').val("add_document");
		CKEDITOR.instances['txtDocumentSizeDesc'].setData("");
		CKEDITOR.instances['txtDocumentDesc'].setData("");
			//$('#txtDocumentSizeDesc').SetHTML('');
		//$('#txtDocumentDesc').val('');
		//$('#txtDocumentSizeDesc').val('');
		$('#txtDocumentSize').val('');
		$('#txtDocumentHeight').val('');
		$('#txtDocumentWidth').val('');
		$('#documentAddModal').modal('show');
		$('#documentAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtDocumentCode').focus(); // Focusing the textbox
		})
	});
	
	

//ADD RECORD WITH VALIDATION

	$('#frmDocumentAdd').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			var formData = new FormData(document.getElementById("frmDocumentAdd"));
			var institutedata={
				txtDocumentCode:$('#txtDocumentCode').val(),
				txtDocumentName:$('#txtDocumentName').val(),
				txtDocumentDesc:CKEDITOR.instances['txtDocumentDesc'].getData(),
				txtDocumentSizeDesc:CKEDITOR.instances['txtDocumentSizeDesc'].getData(),
				txtDocumentSize:$('#txtDocumentSize').val(),
				txtDocumentHeight:$('#txtDocumentHeight').val(),
				txtDocumentWidth:$('#txtDocumentWidth').val(),
				cmbDocumentTypeAdd:$('#cmbDocumentTypeAdd').val()
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_program_document_add",
				type:"post",
				data:institutedata,
				success:function(response){
						
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							var dtblProgram = $("#tblDocumentMaster").DataTable();
		 					dtblProgram.ajax.reload();
		 					$('#frmDocumentAdd').data('bootstrapValidator').resetForm(true);
		 					
							CKEDITOR.instances['txtDocumentSizeDesc'].setData("");
							CKEDITOR.instances['txtDocumentDesc'].setData("");
		 					//$('#txtDocumentDesc').val('');
		 					//$('#txtDocumentSizeDesc').val('');
		 					$('#txtDocumentSize').val('');
		 					$('#txtDocumentHeight').val('');
		 					$('#txtDocumentWidth').val('');
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_document').html(obj.msg);
		                	$('#errorlog_document').show();
		                }
						else 
						{
							sweetAlert("DOCUMENT",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}		
				},
				error:function(){
					/*alert("hello");*/
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			txtDocumentCode: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					}
				}
			},
			txtDocumentName: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			cmbDocumentTypeAdd: {
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

	$('#frmDocumentEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			if($('#cmbDocumentTypeEdit').val() == '')
			{
				toastr.error('Please select the Doc Type');return;
			}
					
			var formData = new FormData(document.getElementById("frmDocumentEdit"));
			
			var institutedata={
				hidOperDocumentEdit:$('#hidOperDocumentEdit').val(),
				hidDUniqueidEdit:$('#hidDUniqueidEdit').val(),
				hidUniqueidEdit:$('#hidUniqueidEdit').val(),
				txtDocumentCodeEdit:$('#txtDocumentCodeEdit').val(),
				txtDocumentNameEdit:$('#txtDocumentNameEdit').val(),
				txtDocumentDescEdit:CKEDITOR.instances['txtDocumentDescEdit'].getData(),
				txtDocumentSizeDescEdit:CKEDITOR.instances['txtDocumentSizeDescEdit'].getData(),
				txtDocumentSizeEdit:$('#txtDocumentSizeEdit').val(),
				txtDocumentHeightEdit:$('#txtDocumentHeightEdit').val(),
				cmbDocumentTypeEdit:$('#cmbDocumentTypeEdit').val(),
				txtDocumentWidthEdit:$('#txtDocumentWidthEdit').val()
			};
			
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_program_document_edit",
				type:"post",
				data:institutedata,
				success:function(response){ 
					isEdit_Document = false;	
					isDelete_Document = false;
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							// 
							var dtblProgram = $("#tblDocumentMaster").DataTable();
							dtblProgram.ajax.reload();
				 			$('#frmDocumentEdit').data('bootstrapValidator').resetForm(true);
							
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_document_edit').html(obj.msg);
		                	$('#errorlog_document_edit').show();
		                }
						else 
						{
							sweetAlert("DOCUMENT",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}		
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
			$('#documentEditModal').modal('hide');
		},
		fields:{
			txtDocumentCodeEdit: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					}
				}
			},
			txtDocumentNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				},
			cmbDocumentTypeEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}
		}
			
	});
//END OF EDIT RECORD WITH VALIDATION
//for document extension type dropdown
	$.ajax({
		url:base_url+"ajax_controller/select_document_type_list_dropdown",
		mType:"post",
		data:'',
	
		
		success:function(response)
			{  
				var options = "<option value=''>Select</option>";					
				var res1 = JSON.parse(response);					
				$.each(res1.aaData,function(i,data)
				{
					options = options + "<option value='"+data.code+"'>"+data.description+"</option>";
				});
				$('#cmbDocumentTypeAdd').html("");   
				$('#cmbDocumentTypeAdd').append(options);	
			},
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	});
	
	$.ajax({
		url:base_url+"ajax_controller/select_document_type_list_dropdown",
		mType:"post",
		data:'',
	
		
		success:function(response)
			{  
				var options = "<option value=''>Select</option>";					
				var res1 = JSON.parse(response);					
				$.each(res1.aaData,function(i,data)
				{
					options = options + "<option value='"+data.code+"'>"+data.description+"</option>";
				});
				$('#cmbDocumentTypeEdit').html("");   
				$('#cmbDocumentTypeEdit').append(options);
				
				$('#cmbDocumentTypeEdit').html(options)
				.selectpicker('refresh');		
			},
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	});
//END OF EDIT RECORD WITH VALIDATION

	// CHECKING DUPLICATION OF MENU CODE 
	$('#txtDocumentCode').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtDocumentCode:$(event.target).val()
			};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_document",
				type:"POST",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status)
					{
					 	$(event.target).val("");
						$('#frmDocumentAdd').data('bootstrapValidator').updateStatus('txtDocumentCode', 'NOT_VALIDATED', null).validateField('txtDocumentCode');
						toastr.error('Document Code Already Created');
						$(event.target).focus();					
					}
					else
					{
						return false;
					}
				},  
				error:function()
				{
					/*alert("asdhchuah");*/
					toastr.error('Unable to process please contact support');
				}
			}); 
		}
	}); 
	// CHECKING DUPLICATION OF MENU CODE FOR EDIT
	$('#txtDocumentCodeEdit').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtDocumentCodeEdit:$(event.target).val(),
			};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_document_edit",
				type:"POST",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status)
					{
					 	$(event.target).val("");
					 	$('#frmDocumentEdit').data('bootstrapValidator').updateStatus('txtDocumentCodeEdit', 'NOT_VALIDATED', null).validateField('txtDocumentCodeEdit');
						toastr.error('Document Code Already Created');
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
	$('#documentEditModal').on('hidden.bs.modal', function (e) {
 		$('#frmDocumentEdit').data('bootstrapValidator').resetForm(true);
 		$(documentMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isEdit_Document = false;	
		isDelete_Document = false;
	})
		//****************************************** FOR SELECTED DOCUMENT TAB *****************************************//
	
	var sdocumentMaster = $('#tblsDocumentMaster').dataTable({
		
		"sAjaxSource": base_url+"ajax_controller/select_program_sdocument",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth": true,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 sdocumentgroupbutton' >>><'col-xs-6'p>>",
		"aoColumns": [
	                     { "sName": "Slno" ,"sWidth": "5%"},
	                     { "sName": "Code" },
	                     { "sName": "name" },
	                     { "sName": "document_description","bVisible":false },
	                     { "sName": "document_size_description","bVisible":false },
	                     { "sName": "document_size" },
	                     { "sName": "document_preview_height" },
	                     { "sName": "document_preview_width" },
	                     { "sName": "id","bVisible":false },
	                     { "sName": "doc_extension","bVisible":false }
        			]
	});
	CKEDITOR.replace("txtsDocumentDesc",{
					startupFocus : true
				});
	CKEDITOR.replace("txtsDocumentDescEdit",{
					startupFocus : true
				});
	CKEDITOR.replace("txtsDocumentSizeDesc",{
					
				});
	CKEDITOR.replace("txtsDocumentSizeDescEdit",{
					
				});
	CKEDITOR.config.toolbar = [
					{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
					{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
					{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Scayt' ] },
					
					{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
					{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
					'/',	
					{ name: 'insert', items: [ 'Table', 'HorizontalRule', 'Symbol', 'base64image' ] },
					{ name: 'styles', items: [ 'Styles', 'Format' ] },
					{ name: 'colors', items : [ 'TextColor','BGColor' ] }
					
					
				];
				CKEDITOR.config.extraPlugins = 'lineutils,widget,codesnippet,symbol,base64image';
				CKEDITOR.config.codeSnippet_theme = 'mono-blue';
				CKEDITOR.config.allowedContent = true;
				CKEDITOR.config.height = 100;
/**CREATING BUTTON*****/
	$("div.sdocumentgroupbutton").html('<div class="btngroup"><button id="btnAddsDocument" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;<button class="btn btn-success" id="btnEditsDocument"><i class="fa fa-edit"></i> Edit</button>&nbsp;<button class="btn btn-danger" id="btnDeletesDocument"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button></div>');

/*****END OF BUTTON CREATION******/

	$('#btnAddsDocument').click(function(e){
		$('#frmsDocumentAdd').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#txtsDocumentCode').val("");
		$('#txtsDocumentName').val("");
		$('#txtLinkURL').val("");
		$('#hidOpersDocument').val("add_sdocument");
			
		$(sdocumentMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		$('#sdocumentAddModal').modal('show');
		$('#sdocumentAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtsDocumentCode').focus(); // Focusing the textbox
		})
	});
	
	$('#btnEditsDocument').click(function(){
		if(isEdit_sDocument){
			$('#hidOpersDocumentEdit').val("edit_sdocument");
			$('#sdocumentEditModal').modal('show');
		}
		else{
			toastr.error("Please Select a record");
		}	
	});
	$('#btnDeletesDocument').click(function(){
		if(isDelete_sDocument){
		
		$('#sdocumentDeleteModal').modal('show');
		}
		else{
			toastr.error("Please Select a record");
		}
		
	});
// to select data when edit button is click
	$('#tblsDocumentMaster tbody').on('click', function (event) {	
		isEdit_sDocument = true;	
		isDelete_sDocument = true;			
			$(sdocumentMaster.fnSettings().aoData).each(function (){
			$(this.nTr).removeClass('success');
		});
		var sextensionType = sdocumentMaster.fnGetData( event.target.parentNode )[9];
		//alert(extensionType);
		var sdocumentID = sdocumentMaster.fnGetData( event.target.parentNode )[8];//GETTING DATA FOR HIDDEN COLUMN
		var sdocument_description = sdocumentMaster.fnGetData( event.target.parentNode )[3];//GETTING DATA FOR HIDDEN COLUMN
		var sdocument_size_description = sdocumentMaster.fnGetData( event.target.parentNode )[4];//GETTING DATA FOR HIDDEN COLUMN
		//alert(document_description);
		if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
	  		row = event.target.parentNode.parentNode.parentNode; 
	  	else
	  		row = event.target.parentNode;
		$(row).addClass('success');
		$('select[name=cmbsDocumentTypeEdit]').val(sextensionType); 
		$('.selectpicker').selectpicker('refresh');
		
		//var selectedText = event.target.parentNode.cells[2].innerHTML;
		/*$("#cmbDocumentTypeEdit option").each(function () 
		{
			if ($(this).html() == extensionType)
		 	{
				$(this).attr("selected", "selected");
				return;
			}
		});*/
		
		
		$('#shidDUniqueidEdit').val(sdocumentID);//GETTING VALUE FOR HIDDEN COLUMN
		//alert($('#hidUniqueidEdit').val());
		//$('#hidUniqueidEdit').val(documentID);//GETTING VALUE FOR HIDDEN COLUMN
		CKEDITOR.instances['txtsDocumentDescEdit'].setData(sdocument_description);
		CKEDITOR.instances['txtsDocumentSizeDescEdit'].setData(sdocument_size_description);
		$('#txtsDocumentCodeEdit').val(event.target.parentNode.cells[1].innerHTML);
		$('#txtsDocumentNameEdit').val(event.target.parentNode.cells[2].innerHTML);
		$('#txtsDocumentSizeEdit').val(event.target.parentNode.cells[3].innerHTML);
		$('#txtsDocumentHeightEdit').val(event.target.parentNode.cells[4].innerHTML);
		$('#txtsDocumentWidthEdit').val(event.target.parentNode.cells[5].innerHTML);
		
	});
//ADD RECORD WITH VALIDATION

	$('#frmsDocumentAdd').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			alert($('#txtsDocumentCodeEdit').val());
			var formData = new FormData(document.getElementById("frmsDocumentAdd"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_program_sdocument_add",
				type:"post",
				data:formData,
				contentType: false,
		    	processData: false,
				success:function(response){
					/*alert("hello");  */
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							var dtblProgram = $("#tblsDocumentMaster").DataTable();
		 					dtblProgram.ajax.reload();
		 					$('#frmsDocumentAdd').data('bootstrapValidator').resetForm(true);
		 					$('#txtsDocumentDesc').val('');
		 					$('#txtsDocumentSizeDesc').val('');
		 					$('#txtsDocumentSize').val('');
		 					$('#txtsDocumentHeight').val('');
		 					$('#txtsDocumentWidth').val('');
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_sdocument').html(obj.msg);
		                	$('#errorlog_sdocument').show();
		                }
						else 
						{
							sweetAlert("DOCUMENT",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}		
				},
				error:function(){
					/*alert("hello");*/
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			txtsDocumentCode: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					}
				}
			},
			txtsDocumentName: {
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

	$('#frmsDocumentEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
					
			var formData = new FormData(document.getElementById("frmsDocumentEdit"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_program_sdocument_edit",
				type:"post",
				data:formData,
				contentType: false,
		    	processData: false,
				success:function(response){ 
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							// 
							var dtblProgram = $("#tblsDocumentMaster").DataTable();
							$('#frmsDocumentEdit').data('bootstrapValidator').resetForm(true);
				 			dtblProgram.ajax.reload();
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_sdocument_edit').html(obj.msg);
		                	$('#errorlog_sdocument_edit').show();
		                }
						else 
						{
							sweetAlert("DOCUMENT",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}		
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
			$('#sdocumentEditModal').modal('hide');
		},
		fields:{
			txtsDocumentCodeEdit: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					}
				}
			},
			txtsDocumentNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}
			
	});
//END OF EDIT RECORD WITH VALIDATION
//for document extension type dropdown
	$.ajax({
		url:base_url+"ajax_controller/select_document_type_list_dropdown",
		mType:"post",
		data:'',
	
		
		success:function(response)
			{  
				var options = "<option value=''>Select</option>";					
				var res1 = JSON.parse(response);					
				$.each(res1.aaData,function(i,data)
				{
					options = options + "<option value='"+data.code+"'>"+data.description+"</option>";
				});
				$('#cmbsDocumentTypeAdd').html("");   
				$('#cmbsDocumentTypeAdd').append(options);
				
				$('#cmbsDocumentTypeAdd').html(options)
				.selectpicker('refresh');		
			},
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	});
	
	$.ajax({
		url:base_url+"ajax_controller/select_document_type_list_dropdown",
		mType:"post",
		data:'',
	
		
		success:function(response)
			{  
				var options = "<option value=''>Select</option>";					
				var res1 = JSON.parse(response);					
				$.each(res1.aaData,function(i,data)
				{
					options = options + "<option value='"+data.code+"'>"+data.description+"</option>";
				});
				$('#cmbsDocumentTypeEdit').html("");   
				$('#cmbsDocumentTypeEdit').append(options);
				
				$('#cmbsDocumentTypeEdit').html(options)
				.selectpicker('refresh');		
			},
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	});
/****DELETE RECORD DELETE********/
	$('#sdocumentDeleteRecord').click(function()
	{
		$('#sdocumentDeleteModal').modal('hide');		
		var institutedata=
		{
			sdocumentID:$('#shidDUniqueidEdit').val(),
			
		};		
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/operation_program_sdocument_delete",
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
						var dtblProgram = $("#tblsDocumentMaster").DataTable();
	 					dtblProgram.ajax.reload();
	 					
					}
					else
					{
						toastr.error(obj.msg);
					}
				}
				catch(e)
				{
					sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
				}	
				$('#sdocumentDeleteModal').modal('hide');			 
			},
			error:function()
			{
				toastr.error('Unable to process please contact support');
			}
		});		
	});
	// CHECKING DUPLICATION OF MENU CODE 
	$('#txtsDocumentCode').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtDocumentCode:$(event.target).val()
			};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_sdocument",
				type:"POST",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status)
					{
					 	$(event.target).val("");
					 	$('#frmsDocumentAdd').data('bootstrapValidator').updateStatus('txtsDocumentCode', 'INVALID', null);
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
					/*alert("asdhchuah");*/
					toastr.error('Unable to process please contact support');
				}
			}); 
		}
	}); 
	// CHECKING DUPLICATION OF MENU CODE FOR EDIT
	$('#txtsDocumentCodeEdit').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtsDocumentCodeEdit:$(event.target).val(),
			};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_sdocument_edit",
				type:"POST",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status)
					{
					 	$(event.target).val("");
					 	$('#frmsDocumentEdit').data('bootstrapValidator').updateStatus('txtsDocumentCodeEdit', 'INVALID', null);
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
	//**************************************************** FOR CATEGORY TAB******************************//
	
	var categoryMaster = $('#tblCategoryMaster').dataTable({
		
		"sAjaxSource": base_url+"ajax_controller/select_category",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 categorybutton' >>><'col-xs-6'p>>",
		"aoColumns": [
	                     { "sName": "Slno","sWidth": "5%" },
	                     { "sName": "Code" },
	                     { "sName": "name" },
	                     { "sName": "id","bVisible":false },
                       	  {"sName": "default","sWidth": "15%", "sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='categoryRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>\
			            <button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='categoryRow(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}
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

	$("div.categorybutton").html('<div class="btngroup"><button id="btnAddCategory" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button></div>');

/*****END OF BUTTON CREATION******/

	$('#btnAddCategory').click(function(e){
		isEdit_Category = false;	
		isDelete_Category = false;	
		$('#frmCategoryAdd').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#txtCategoryCode').val("");
		$('#txtCategoryName').val("");
		$('#hidOperCategory').val("add_category");
		
		$(categoryMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		
		$('#categoryAddModal').modal('show');
		$('#categoryAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtCategoryCode').focus(); // Focusing the textbox
		})
	});
	
//ADD RECORD WITH VALIDATION

	$('#frmCategoryAdd').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			var formData = new FormData(document.getElementById("frmCategoryAdd"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_category_add",
				type:"post",
				data:formData,
				contentType: false,
		    	processData: false,
				success:function(response){  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg); 
							var dtblProgram = $("#tblCategoryMaster").DataTable();
		 					dtblProgram.ajax.reload();
		 					$('#frmCategoryAdd').data('bootstrapValidator').resetForm(true);
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_category').html(obj.msg);
		                	$('#errorlog_category').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_category').html(obj.msg);
		                	$('#errorlog_category').show();
		                }
						else 
						{
							sweetAlert("CATEGORY",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			txtCategoryCode: {							//form input type name
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
			txtCategoryName: {
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

	$('#frmCategoryEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
					
		var formData = new FormData(document.getElementById("frmCategoryEdit"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_category_edit",
				type:"post",
				data:formData,
				contentType: false,
		    	processData: false,
				success:function(response){
					isEdit_Category = false;	
					isDelete_Category = false;  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							// 
							var dtblProgram = $("#tblCategoryMaster").DataTable();
		 					dtblProgram.ajax.reload();
		 					$('#frmCategoryEdit').data('bootstrapValidator').resetForm(true);
							$('#categoryEditModal').modal('hide');
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_category_edit').html(obj.msg);
		                	$('#errorlog_category_edit').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_category_edit').html(obj.msg);
		                	$('#errorlog_category_edit').show();
		                }
						else 
						{
							sweetAlert("CATEGORY",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields:{
			txtCategoryCodeEdit: {							//form input type name
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
			txtCategoryNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}
			
	});
//END OF EDIT RECORD WITH VALIDATION

	// CHECKING DUPLICATION OF MENU CODE 
	$('#txtCategoryCode').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtCategoryCode:$(event.target).val()
			};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_category",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status)
					{
					 	$(event.target).val("");
					 	$('#frmCategoryAdd').data('bootstrapValidator').updateStatus('txtCategoryCode', 'NOT_VALIDATED', null).validateField('txtCategoryCode');
					 	toastr.error('Category Code Already Created');
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
	$('#txtCategoryCodeEdit').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtCategoryCodeEdit:$(event.target).val()
			};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_category_edit",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status)
					{
					 	$(event.target).val("");
					 	$('#frmCategoryEdit').data('bootstrapValidator').updateStatus('txtCategoryCodeEdit', 'NOT_VALIDATED', null).validateField('txtCategoryCodeEdit');
					 	toastr.error('Category Code Already Created');
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
	$('#categoryEditModal').on('hidden.bs.modal', function (e) {
 		$('#frmCategoryEdit').data('bootstrapValidator').resetForm(true);
 		$(categoryMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isEdit_Category = false;	
		isDelete_Category = false;
	})

	
	//************************************************ FOR MINORITY COMMUNITY TAB ******************************//
	
	var minoritycommunityMaster = $('#tblMinorityCommunityMaster').dataTable({
		"sAjaxSource": base_url+"ajax_controller/select_minority",
		//"sAjaxSource": "generic_setup1_db.php?_s="+MY_SESSION_NAME+"&type=SELECT_MINORITY",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 minoritycommunitybutton' >>><'col-xs-6'p>>",
		"aoColumns": [
	                     { "sName": "Slno","sWidth": "5%" },
	                     { "sName": "Code" },
	                     { "sName": "name" },
	                     { "sName": "id","bVisible":false },
                       {"sName": "default","sWidth": "15%", "sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='minorityRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>\
			            <button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='minorityRow(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}
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

	$("div.minoritycommunitybutton").html('<div class="btngroup"><button id="btnAddMinoritycommunity" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button></div>');

/*****END OF BUTTON CREATION******/

	$('#btnAddMinoritycommunity').click(function(e){
		isEdit_Minority_community = false;	
		isDelete_Minority_community = false;	
		$('#frmMinoritycommunityAdd').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#txtMinoritycommunityCode').val("");
		$('#txtMinoritycommunityName').val("");
		$('#hidOperMinority').val("add_minority");
		
		$(minoritycommunityMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		
		$('#minoritycommunityAddModal').modal('show');
		$('#minoritycommunityAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtMinoritycommunityCode').focus(); // Focusing the textbox
		})
	});
	
//ADD RECORD WITH VALIDATION

	$('#frmMinoritycommunityAdd').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			var formData = new FormData(document.getElementById("frmMinoritycommunityAdd"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_minority_add",
				type:"post",
				data:formData,
				contentType: false,
		    	processData: false,
				success:function(response){ 
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							// 
							$('#minoritycommunityEditModal').modal('hide'); 
							var dtblProgram = $("#tblMinorityCommunityMaster").DataTable();
		 					dtblProgram.ajax.reload();
							$('#frmMinoritycommunityAdd').data('bootstrapValidator').resetForm(true);
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_minority_edit').html(obj.msg);
		                	$('#errorlog_minority_edit').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_minority_edit').html(obj.msg);
		                	$('#errorlog_minority_edit').show();
		                }
						else 
						{
							sweetAlert("Minority Community",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}	 			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			txtMinoritycommunityCode: {							//form input type name
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
			txtMinoritycommunityName: {
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

	$('#frmMinoritycommunityEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
					
			var formData = new FormData(document.getElementById("frmMinoritycommunityEdit"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_minority_edit",
				type:"post",
				data:formData,
				contentType: false,
		    	processData: false,
				success:function(response){ 
					isEdit_Minority_community = false;	
					isDelete_Minority_community = false;
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							// 
							$('#minoritycommunityEditModal').modal('hide'); 
							var dtblProgram = $("#tblMinorityCommunityMaster").DataTable();
		 					dtblProgram.ajax.reload();
							$('#frmMinoritycommunityEdit').data('bootstrapValidator').resetForm(true);
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_minority_edit').html(obj.msg);
		                	$('#errorlog_minority_edit').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_minority_edit').html(obj.msg);
		                	$('#errorlog_minority_edit').show();
		                }
						else 
						{
							sweetAlert("Minority Community",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields:{
			txtMinoritycommunityCodeEdit: {							//form input type name
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
			txtMinoritycommunityNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}
			
	});
//END OF EDIT RECORD WITH VALIDATION

	// CHECKING DUPLICATION OF BOARD CODE 
	$('#txtMinoritycommunityCode').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtMinoritycommunityCode:$(event.target).val(),
			};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_minority",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status)
					{
					 	$(event.target).val("");
						$('#frmMinoritycommunityAdd').data('bootstrapValidator').updateStatus('txtMinoritycommunityCode', 'NOT_VALIDATED', null).validateField('txtMinoritycommunityCode');
						toastr.error('Minority Community Code Already Created');
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
	$('#txtMinoritycommunityCodeEdit').on("change",function(event)
	{
			
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtMinoritycommunityCodeEdit:$(event.target).val(),
			};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_minority_edit",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status)
					{
					 	$(event.target).val("");
						$('#frmMinoritycommunityEdit').data('bootstrapValidator').updateStatus('txtMinoritycommunityCodeEdit', 'NOT_VALIDATED', null).validateField('txtMinoritycommunityCodeEdit');
						toastr.error('Minority Community Code Already Created');
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
	$('#minoritycommunityEditModal').on('hidden.bs.modal', function (e) {
 		$('#frmMinoritycommunityEdit').data('bootstrapValidator').resetForm(true);
 		$(minoritycommunityMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isEdit_Minority_community = false;	
		isDelete_Minority_community = false;
	})
	
	//*********************************************** FOR CASTE TAB *********************************//
	
	var tblCaste = $('#tblCaste').dataTable({
		"sAjaxSource": base_url+"ajax_controller/select_caste",	
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
		"bDestroy" : true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 castebutton' >>><'col-xs-6'p>>",
		"aoColumns": [
             { "sName": "Slno","sWidth": "5%" },
             { "sName": "caste_master_code" },
             { "sName": "caste_master_name" },
			 { "sName": "Record Status","sWidth": "10%","sClass":"alignCenter",
							"mRender": function( data, type, full ) {
						        return '<img src="'+base_url+'public/assets/images/'+ data +'.png" ></img>';
			 }},
			 { "sName": "status","bVisible": false},
             {"sName": "default","sWidth": "15%", "sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='casteRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>\
	            <button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='casteRow(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}
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
	$("div.castebutton").html('<div class="btngroup"><button id="btnAddCaste" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button></div>');
/*****END OF BUTTON CREATION******/
	
	
	$('#btnAddCaste').click(function(e){
	//alert("hello");
		isEdit_Caste = false;	
		isDelete_Caste = false;	
		$('#frmAddCaste').data('bootstrapValidator').resetForm(true);
		
		//$('#frmAddCentre').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#txtCasteCode').val("");
		$('#txtCasteName').val("");
		
		$(tblCaste.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		$('#txtStatus').val("");
		$('#hidOperCaste').val("add_caste");
		
		$('#CasteAddModal').modal('show');
		$('#CasteAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtCasteCode').focus(); // Focusing the textbox
		})
	});
 	$('#frmAddCaste').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			var formData = new FormData(document.getElementById("frmAddCaste"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_caste_add",
				type:"post",
				data:formData,
				contentType: false,
		    	processData: false,
				success:function(response){ 
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							// 
							$('#CasteAddModal').modal('hide'); 
							var dtblProgram = $("#tblCaste").DataTable();
		 					dtblProgram.ajax.reload();
							$('#frmAddCaste').data('bootstrapValidator').resetForm(true);
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_caste').html(obj.msg);
		                	$('#errorlog_caste').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_caste').html(obj.msg);
		                	$('#errorlog_caste').show();
		                }
						else 
						{
							sweetAlert("Caste",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}	 			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			txtCasteCode: {							//form input type name
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
			txtCasteName: {
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
//END OF ADD RECORD WITH VALIDATION


//EDIT RECORD WITH VALIDATION

	$('#frmEditCaste').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
					
			var formData = new FormData(document.getElementById("frmEditCaste"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_caste_edit",
				type:"post",
				data:formData,
				contentType: false,
		    	processData: false,
				success:function(response){ 
					isEdit_Caste = false;	
					isDelete_Caste = false;
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							// 
							$('#CasteEditModal').modal('hide'); 
							var dtblProgram = $("#tblCaste").DataTable();
		 					dtblProgram.ajax.reload();
							$('#frmEditCaste').data('bootstrapValidator').resetForm(true);
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_caste_edit').html(obj.msg);
		                	$('#errorlog_caste_edit').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_caste_edit').html(obj.msg);
		                	$('#errorlog_caste_edit').show();
		                }
						else 
						{
							sweetAlert("Caste",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields:{
			txtCasteCodeEdit: {							//form input type name
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
			txtCasteNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}
			
	});
	
	$('#txtCasteCodeEdit').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				txtCasteCodeEdit:$(event.target).val(),
				validateminoritycommunitycode:true,
				//type:"CHKEDITDUCPLICATE_CASTE"
			};
		   //ajax call to server
		   $.ajax({
				url:base_url+"ajax_controller/check_casteEdit",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status)
					{
					 	$(event.target).val("");
					 	$('#frmEditCaste').data('bootstrapValidator').updateStatus('txtCasteCodeEdit', 'NOT_VALIDATED', null).validateField('txtCasteCodeEdit');
					 	toastr.error('Caste Code Already Created');
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
	$('#txtCasteCode').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtCasteCode:$(event.target).val(),
					validateminoritycommunitycode:true,
					//type:"CHKDUCPLICATE_CASTE"
				};
				$.ajax({
				url:base_url+"ajax_controller/check_caste",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
						$('#frmAddCaste').data('bootstrapValidator').updateStatus('txtCasteCode', 'NOT_VALIDATED', null).validateField('txtCasteCode');
					 	toastr.error('Caste Code Already Created');
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
	$('#CasteEditModal').on('hidden.bs.modal', function (e) {
 		$('#frmEditCaste').data('bootstrapValidator').resetForm(true);
 		$(tblCaste.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isEdit_Caste = false;	
		isDelete_Caste = false;
	})
	
	//************************************** FOR RELIGION TAB *************************************************//
	
	var religionMaster = $('#tblReligionMaster').dataTable({
		
		"sAjaxSource": base_url+"ajax_controller/select_religion",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 religionbutton' >>><'col-xs-6'p>>",
		"aoColumns": [
	                     { "sName": "Slno","sWidth": "5%" },
	                     { "sName": "Code" },
	                     { "sName": "name" },
	                     { "sName": "id","bVisible":false },
                       	 {"sName": "default","sWidth": "15%", "sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='religonRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>\
				            <button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='religonRow(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}
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

	$("div.religionbutton").html('<div class="btngroup"><button id="btnAddReligon" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button></div>');

/*****END OF BUTTON CREATION******/

	$('#btnAddReligon').click(function(e){
		isEdit_Religion = false;	
		isDelete_Religion = false;	
		$('#frmReligionAdd').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#txtReligionCode').val("");
		$('#txtReligionName').val("");
		$('#hidOperReligion').val("add_religion");
		
		
		$(religionMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		$('#religionAddModal').modal('show');
		$('#religionAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtReligionCode').focus(); // Focusing the textbox
		})
	});
	
//ADD RECORD WITH VALIDATION

	$('#frmReligionAdd').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			var formData = new FormData(document.getElementById("frmReligionAdd"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_religion_add",
				type:"post",
				data:formData,
				contentType: false,
		    	processData: false,
				success:function(response){  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							// 
							$('#CasteEditModal').modal('hide'); 
							var dtblProgram = $("#tblReligionMaster").DataTable();
		 					dtblProgram.ajax.reload();
		 					$('#frmReligionAdd').data('bootstrapValidator').resetForm(true);
							$('#errorlog_religion').html('');
		                	$('#errorlog_religion').hide();
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_religion').html(obj.msg);
		                	$('#errorlog_religion').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_religion').html(obj.msg);
		                	$('#errorlog_religion').show();
		                }
						else 
						{
							sweetAlert("Religion",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}		
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			txtReligionCode: {							//form input type name
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
			txtReligionName: {
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

	$('#frmReligionEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
					
			var formData = new FormData(document.getElementById("frmReligionEdit"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_religion_edit",
				type:"post",
				data:formData,
				contentType: false,
		    	processData: false,
				success:function(response){ 
					isEdit_Religion = false;	
					isDelete_Religion = false;
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							// 
							$('#religionEditModal').modal('hide'); 
							var dtblProgram = $("#tblReligionMaster").DataTable();
		 					dtblProgram.ajax.reload();
		 					$('#frmReligionEdit').data('bootstrapValidator').resetForm(true);
							$('#errorlog_religion_edit').html('');
		                	$('#errorlog_religion_edit').hide();
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_religion_edit').html(obj.msg);
		                	$('#errorlog_religion_edit').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_religion_edit').html(obj.msg);
		                	$('#errorlog_religion_edit').show();
		                }
						else 
						{
							sweetAlert("Religion",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}		
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields:{
			txtReligionCodeEdit: {							//form input type name
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
			txtReligionNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}
			
	});
//END OF EDIT RECORD WITH VALIDATION


	$('#txtReligionCodeEdit').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtReligionCodeEdit:$(event.target).val(),
					validateminoritycommunitycode:true,
					//type:"CHKDUCPLICATE_CASTE"
				};
				$.ajax({
				url:base_url+"ajax_controller/check_religion_edit",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
						$('#frmReligionEdit').data('bootstrapValidator').updateStatus('txtReligionCodeEdit', 'NOT_VALIDATED', null).validateField('txtReligionCodeEdit');
					 	toastr.error('Religion Code Already Created');
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
	$('#txtReligionCode').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtReligionCode:$(event.target).val(),
					validateminoritycommunitycode:true,
					//type:"CHKDUCPLICATE_CASTE"
				};
				$.ajax({
				url:base_url+"ajax_controller/check_religion",
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
						$('#frmReligionAdd').data('bootstrapValidator').updateStatus('txtReligionCode', 'NOT_VALIDATED', null).validateField('txtReligionCode');
					 	toastr.error('Religion Code Already Created');
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
	$('#religionEditModal').on('hidden.bs.modal', function (e) {
 		$('#frmReligionEdit').data('bootstrapValidator').resetForm(true);
 		$(religionMaster.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isEdit_Religion = false;	
		isDelete_Religion = false;
	})
	
	//***************************************** FOR INSTRUCTION TAB ******************************//
	
	var tblInst = $('#tblInstruction').dataTable({
		"sAjaxSource": base_url+"ajax_controller/select_instruction",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
		"bDestroy" : true,
        "bAutoWidth": true,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-8 instructionbutton' >>><'col-xs-6'p>>",
		"aoColumns": [
	                     { "sName": "Slno" ,"sWidth": "5%"},
	                     { "sName": "page_code" },
	                     { "sName": "instruction_text","bVisible":false },
	                     { "sName": "instruction","bVisible":false },
						 { "sName": "Record Status","sWidth": "10%","sClass":"alignCenter",
							"mRender": function( data, type, full ) {
								if(data == '1')
								{
									return '<img src="'+base_url+'public/assets/images/ACTIVE.png" ></img>';
								}
						        else if (data == '0')
						        {
									return '<img src="'+base_url+'public/assets/images/INACTIVE.png" ></img>';
								}
					    }},
					     { "sName": "status","bVisible":false }
        			]
		});
		/**CREATING BUTTON*****/
	$("div.instructionbutton").html('<div class="btngroup"><button id="btnAddInstruction" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;<button class="btn btn-success" id="btnEditInstruction"><i class="fa fa-edit"></i> Edit</button>&nbsp;<button class="btn btn-danger" id="btnDeleteInstruction"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button></div>');
/*****END OF BUTTON CREATION******/
	
	
	$('#btnAddInstruction').click(function(e){
	//alert("hello");
		isEdit_Instruction = false;	
		isDelete_Instruction = false;
		$('#errorlog_instruction').hide();
		CKEDITOR.instances['taInstruction'].setData("");
		$('#frmAddInstruction').data('bootstrapValidator').resetForm(true);	
		$('#cmbPageCode').val("");
		
		$('#cmbStatus').val("");
		$('#hidOperInstruction').val("add_instruction");
		
		$('#InstructionAddModal').modal('show');
		$('#InstructionAddModal').on('shown.bs.modal', function () 
		{ 
			$('#cmbPageCode').focus(); // Focusing the textbox
		})
	});
	$('#btnEditInstruction').click(function(){
		$('#errorlog_instruction_edit').hide();
		if(isEdit_Instruction){
			$('#hidOperInstructionEdit').val("edit_instruction");
			$('#InstructionEditModal').modal('show');
		}
		else{
			toastr.error("Please Select a record");
		}	
	});
	$('#btnDeleteInstruction').click(function(){
		if(isDelete_Instruction){
			$('#InstructionDeleteModal').modal('show');
		}
		else{
			toastr.error("Please Select a record");
		}
		
	});
	 $('#tblInstruction tbody').on('click', function (event) {	
		isEdit_Instruction = true;	
		isDelete_Instruction = true;		
			$(tblInst.fnSettings().aoData).each(function (){
			$(this.nTr).removeClass('success');
		});
		//alert(event.target.parentNode.parentNode);
		//var programCode = challanMaster.fnGetData( event.target.parentNode )[1];//GETTING DATA FOR HIDDEN COLUMN
		if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
	  		row = event.target.parentNode.parentNode.parentNode; 
	  	else
	  		row = event.target.parentNode;
		$(row).addClass('success');
		$('#frmEditInstruction').data('bootstrapValidator').resetForm(true);
		$('#hidInstructionCodeEdit').val(event.target.parentNode.cells[1].innerHTML);//GETTING VALUE FOR HIDDEN COLUMN
		
		//$('#cmbProgramCodeEdit').val(event.target.parentNode.cells[1].innerHTML);
		$('#cmbPageCodeEdit').val(event.target.parentNode.cells[1].innerHTML);
		var selectedvalue = tblInst.fnGetData( event.target.parentNode )[5];
		
		//$('#taInstructionEdit').val(event.target.parentNode.cells[2].innerHTML);
		var instruction = tblInst.fnGetData( event.target.parentNode )[2];
		CKEDITOR.instances['taInstructionEdit'].setData(instruction);
		$("#cmbInsStatusEdit").val(selectedvalue);
	});

   
 	$('#frmAddInstruction').bootstrapValidator({
 		excluded: [':disabled',':hidden'],
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			//alert(CKEDITOR.instances['taInstruction'].getData());
			var formData = new FormData(document.getElementById("frmAddInstruction"));
			var institutedata={
				cmbPageCode:$('#cmbPageCode').val(),
				taInstruction:CKEDITOR.instances['taInstruction'].getData(),
				cmbInsStatus:$('#cmbInsStatus').val(),
				hidOperInstruction:$('#hidOperInstruction').val()
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_instruction_add",
				type:"post",
				data:institutedata,
				success:function(response){  
					try
					{
						var obj = jQuery.parseJSON(response);
						//alert(obj.status);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							// 
							var dtblInstruction = $("#tblInstruction").DataTable();
		 					dtblInstruction.ajax.reload();
		 					$('#frmAddInstruction').data('bootstrapValidator').resetForm(true);
							CKEDITOR.instances['taInstruction'].setData("");	
							$('#errorlog_instruction').html('');
		                	$('#errorlog_instruction').hide();
						}
						else if(obj.status === 'validationerror'){
							CKEDITOR.instances['taInstruction'].on('change', function() {
								$('#errorlog_instruction').html('');
								$('#errorlog_instruction').hide();
								$('#frmAddInstruction').data('bootstrapValidator').updateStatus('taInstruction', 'VALID',null);
								//$('#frmAddInstruction').data('bootstrapValidator').resetForm(true);
							});
		                	$('#errorlog_instruction').html(obj.msg);
		                	//$('#frmAddInstruction').data('bootstrapValidator').resetForm(true);
		                	$('#errorlog_instruction').show();
		                }
						else 
						{
							sweetAlert("Instruction",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}		
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			cmbPageCode: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			taInstruction: {
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
		
	
	$('#frmEditInstruction').bootstrapValidator({
		excluded: [':disabled,:hidden'],
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{	
			var formData = new FormData(document.getElementById("frmEditInstruction"));
			//ajax call to server
			var institutedata={
				cmbPageCodeEdit:$('#cmbPageCodeEdit').val(),
				taInstructionEdit:CKEDITOR.instances['taInstructionEdit'].getData(),
				cmbInsStatusEdit:$('#cmbInsStatusEdit').val(),
				hidInstructionCodeEdit:$('#hidInstructionCodeEdit').val(),
				cmbInsStatusEdit:$('#cmbInsStatusEdit').val()
			};
			$.ajax({
				url:base_url+"ajax_controller/operation_instruction_edit",
				type:"post",
				data:institutedata,
				
				success:function(response){ 
					isEdit_Instruction = false;	
					isDelete_Instruction = false;
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							// 
							var dtblCenter = $("#tblInstruction").DataTable();
							dtblCenter.ajax.reload();
		 					$('#frmEditInstruction').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
							$('#cmbPageCodeEdit').val("");
							CKEDITOR.instances['taInstructionEdit'].setData("");	
							$('#InstructionEditModal').modal('hide');	
							$('#errorlog_instruction_edit').html('');
		                	$('#errorlog_instruction_edit').hide();
						}
						else if(obj.status === 'validationerror'){
							CKEDITOR.instances['taInstructionEdit'].on('change', function() {
								$('#errorlog_instruction_edit').html('');
								$('#errorlog_instruction_edit').hide();
								$('#frmEditInstruction').data('bootstrapValidator').updateStatus('taInstructionEdit', 'VALID',null);
								//$('#frmAddInstruction').data('bootstrapValidator').resetForm(true);
							});
		                	$('#errorlog_instruction_edit').html(obj.msg);
		                	$('#errorlog_instruction_edit').show();
		                }
						else 
						{
							sweetAlert("Instruction",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}
				
					
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields:{
			cmbPageCodeEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			taInstructionEdit: {
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
	$('#groupDeleteRecordInstruction').click(function()
	{
		$('#InstructionDeleteModal').modal('hide');		
		var institutedata=
		{
			hidInstructionCodeEdit:$('#hidInstructionCodeEdit').val(),
		};		
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/operation_instruction_delete",
			type:"post",
			data:institutedata,
			success:function(response)
			{ 
				isEdit_Instruction = false;	
				isDelete_Instruction = false;
				try
				{
					var obj = jQuery.parseJSON(response);
					//alert(obj.status);
					if(obj.status == true)
					{
						toastr.success(obj.msg);
						var dtblChallan = $("#tblInstruction").DataTable();
	 					dtblChallan.ajax.reload();
	 					
					}
					else
					{
						toastr.error(obj.msg);
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
	$('#cmbPageCode').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				cmbPageCode:$(event.target).val(),
				validatereligioncode:true,
				//type:"CHKDUCPLICATE_INSTRUCTION"
			};
		   //ajax call to server
		   $.ajax({
					url:base_url+"ajax_controller/check_instruction",
					type:"post",
					data:institutedata,
					success:function(response){
					//alert('djfsh');
						var res1 = JSON.parse(response);
							if(res1.status == true)
							{
								$('#cmbPageCode').val("");
								$('#frmAddInstruction').data('bootstrapValidator').updateStatus('cmbPageCode', 'NOT_VALIDATED', null).validateField('cmbPageCode');
								toastr.error('Page Code Already Used.Try With Another One.');
								$(event.target).focus();
								
							}
						
					},  
					error:function(){
						toastr.error('Unable to process please contact support');
					}
				}); 
			
		}
	}); 
	// CHECKING DUPLICATION OF BOARD CODE FOR EDIT
	/*$('#cmbPageCodeEdit').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
				var institutedata=
				{
					cmbPageCodeEdit:$(event.target).val(),
					validatemenucode:true,
					//type:"CHKDUCPLICATE_CODE"
				};
		   //ajax call to server
		    $.ajax({
					url:base_url+"ajax_controller/check_instructionEdit",
					type:"post",
					data:institutedata,
					success:function(response){
					//alert('djfsh');
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
							{
								//alert('eeee');
								$('#cmbPageCodeEdit').val("");
								$('#frmEditInstruction').data('bootstrapValidator').updateStatus('cmbPageCodeEdit', 'NOT_VALIDATED', null).validateField('cmbPageCodeEdit');
								toastr.error('Page Code Already Used.Try With Another One.');
								$(event.target).focus();
								
							}
						
					},  
					error:function(){
						toastr.error('Unable to process please contact support');
					}
				}); 
			
		}
	}); */
	$('#InstructionEditModal').on('hidden.bs.modal', function (e) {
 		$('#frmEditInstruction').data('bootstrapValidator').resetForm(true);
 		$(tblInst.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isEdit_Instruction = false;	
		isDelete_Instruction = false;
	})
	
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

	CKEDITOR.replace( 'taInstruction',
    {
    	toolbarCanCollapse: false,
    	toolbarStartupExpanded: true,
    	removePlugins : 'elementspath'
		
	});
	CKEDITOR.replace( 'taInstructionEdit',
    {
    	toolbarCanCollapse: false,
    	toolbarStartupExpanded: true,
    	removePlugins : 'elementspath'
		
	});
});
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	        return false;
	    }
    return true;
}
//Edit or Delete group code button clicked
function programgroupRow(event,action)
{
	var oTable = $('#tblProgramGroup').dataTable();		
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
	$('#hidOperProgramGroupEdit').val("edit_program_group");
	//alert(record_id);
	$('#frmEditProgramGroup').data('bootstrapValidator').resetForm(true);	
	$(row).addClass('success');
    var id = oTable.fnGetData( row )[1];
	//alert(id);
	$('#hidProgramGroupCodeEdit').val(row.cells[1].innerHTML);//GETTING VALUE FOR HIDDEN COLUMN
	$('#hidProgramGroupCodeDelete').val(row.cells[1].innerHTML);//GETTING VALUE FOR HIDDEN COLUMN
	
	//$('#cmbProgramCodeEdit').val(event.target.parentNode.cells[1].innerHTML);
	$('#txtProgramGroupCodeEdit').val(row.cells[1].innerHTML);
	$('#txtProgramGroupNameEdit').val(row.cells[2].innerHTML);
	$('#txtLastDateEdit').val(row.cells[3].innerHTML);
	
	
	var selectedText2 = oTable.fnGetData( row )[4];
	if(selectedText2 == 'ACTIVE')
	{
		selectedText2 = 1;
	}
	else
	{
		selectedText2 = 0;
	}
	$('#cmbStatusEdit').val(selectedText2);
	$("#cmbStatusEdit option").each(function () 
	{
		if ($(this).html() == selectedText2)
	 	{
			$(this).attr("selected", "selected");
			return;
		}
	});
			
	if(action == 'edit')
	{	
		$('#programGroupEditModal').modal('show');
	}		
	
}

//Edit or Delete template button clicked
function templateRow(event,action)
{
	var oTable = $('#tblTemplateMaster').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});			
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
		
	$('#frmTemplateEdit').data('bootstrapValidator').resetForm(true);
	
	var templateID = row.cells[1].innerHTML;//GETTING DATA FOR HIDDEN COLUMN
		
	$('#hidUniqueidEdit').val(templateID);//GETTING VALUE FOR HIDDEN COLUMN
	$('#txtTemplateCodeEdit').val(row.cells[1].innerHTML);
	$('#txtTemplateNameEdit').val(row.cells[2].innerHTML);
	$('#textTemplateDescriptionEdit').val(row.cells[3].innerHTML);
	var filename = "";
	//var selectedText = event.target.parentNode.cells[4].textContent; 
	var selectedText = row.cells[4].innerHTML; 
	filename = selectedText.split("-");
	$("#txtFileNameEdit").val(row.cells[4].innerHTML) ;
	//$("#txtFileNameEdit").val(event.target.parentNode.cells[4].textContent) ;
		
	if(action == 'edit')
	{	
		$('#templateEditModal').modal('show');
	}	
	else
	{
		swal({
		  title: "Are you sure?",
		  text: "Do you want to Delete the Template!",
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
		    swal("Deleted", "Template has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Template is safe ", "error");
		  }
		});
		function deleteCode()
		{
			var institutedata=
			{
				templateID:$('#hidUniqueidEdit').val(),
				//type:"DELETE_TEMPLATE"
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/deletion_template_record",
				type:"post",
				data:institutedata,
				success:function(response)
				{ 
					try
					{
						var obj = jQuery.parseJSON(response);
						//alert(obj.status);
						if(obj.status == true)
						{
							//alert("uhufh");
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
					var dtblProgram = $("#tblTemplateMaster").DataTable();
		 			dtblProgram.ajax.reload();
				},
				error:function()
				{
					toastr.error('We are unable to process please contact support');	
				} 	
			});
		}
	}	
	
}
//Edit or Delete menu button clicked
function menuRow(event,action)
{
	var oTable = $('#tblMenuMaster').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});			
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
		
	$('#frmMenuEditModal').data('bootstrapValidator').resetForm(true); 
	var menuID = oTable.fnGetData(row)['id'];//GETTING DATA FOR HIDDEN COLUMN
	$('#hidUniqueidEditMenu').val(menuID);//GETTING VALUE FOR HIDDEN COLUMN
		
	$('#txtMenuCodeEdit').val(row.cells[1].innerHTML);
	$('#txtLinkTextEdit').val(row.cells[2].innerHTML);
	$('#txtLinkURLEdit').val(row.cells[3].innerHTML);
	
	var selectedText = row.cells[4].innerHTML; 
	$("#cmbNewWindowEdit").val(selectedText);
	var selectedText2 = row.cells[5].innerHTML;
	$("#cmbDocumentUploadEdit").val(selectedText2);
	var selectedText3 = oTable.fnGetData(row)['record_status'];
	var selectedText3 = oTable.fnGetData(row)['id'];
	if(selectedText3 == '1')
	{
		selectedText3 = 'Active';
	}
	else
	{
		selectedText3 = 'Inactive';
	}
	$("#cmbRecordStatusEdit").val(selectedText3);
	sl_no = row.cells[7].innerHTML;//alert(sl_no);return;
	$('#txtProgramMenuSlnoEdit').val(sl_no);
		
	if(action == 'edit')
	{	
		$('#errorlog_menu_edit').hide();
		$('#hidOperProgramMenuEdit').val("edit_program_menu");
		$('#menuEditModal').modal('show');
	}	
	
}
//Edit or Delete document button clicked
function documentRow(event,action)
{
	var oTable = $('#tblDocumentMaster').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});			
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
		
	$('#frmDocumentEdit').data('bootstrapValidator').resetForm(true); 
	
	var extensionType = oTable.fnGetData(row)[9];
	//alert(extensionType);
	var documentID = oTable.fnGetData(row)[8];
	var document_description = oTable.fnGetData(row)[3];
	var document_size_description = oTable.fnGetData(row)[4];
	
	$('select[name=cmbDocumentTypeEdit]').val(extensionType); 
	$('.selectpicker').selectpicker('refresh');
	
	
	$('#hidDUniqueidEdit').val(documentID);//GETTING VALUE FOR HIDDEN COLUMN
	CKEDITOR.instances['txtDocumentDescEdit'].setData(document_description);
	CKEDITOR.instances['txtDocumentSizeDescEdit'].setData(document_size_description);
	$('#txtDocumentCodeEdit').val(row.cells[1].innerHTML);
	$('#txtDocumentNameEdit').val(row.cells[2].innerHTML);
	$('#txtDocumentSizeEdit').val(row.cells[3].innerHTML);
	$('#txtDocumentHeightEdit').val(row.cells[4].innerHTML);
	$('#txtDocumentWidthEdit').val(row.cells[5].innerHTML);
	
	if(action == 'edit')
	{	
		$('#hidOperDocumentEdit').val("edit_document");
		$('#documentEditModal').modal('show');
	}
	else
	{
		swal({
		  title: "Are you sure?",
		  text: "Do you want to Delete the Document!",
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
		    swal("Deleted", "Document has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Document is safe ", "error");
		  }
		});
		function deleteCode()
		{
			var institutedata=
			{
				documentID:$('#hidDUniqueidEdit').val(),
				
			};	
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_program_document_delete",
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
							var dtblProgram = $("#tblDocumentMaster").DataTable();
		 					dtblProgram.ajax.reload();
		 					
						}
						else
						{
							toastr.error(obj.msg);
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}
				},
				error:function()
				{
					toastr.error('We are unable to process please contact support');	
				} 	
			});
		}
	}	
	
}
//Edit or Delete category button clicked
function categoryRow(event,action)
{
	var oTable = $('#tblCategoryMaster').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});			
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
		
	$('#frmCategoryEdit').data('bootstrapValidator').resetForm(true); 
	var categoryID = oTable.fnGetData(row)[3];//GETTING DATA FOR HIDDEN COLUMN
	$('#hidCUniqueidEdit').val(categoryID);//GETTING VALUE FOR HIDDEN COLUMN
	$('#txtCategoryCodeEdit').val(row.cells[1].innerHTML);
	$('#txtCategoryNameEdit').val(row.cells[2].innerHTML);
	
	if(action == 'edit')
	{	
		$('#hidOperCategoryEdit').val("edit_category");
		$('#categoryEditModal').modal('show');
	}
	else
	{
		swal({
		  title: "Are you sure?",
		  text: "Do you want to Delete the Category!",
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
		    swal("Deleted", "Category has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Category is safe ", "error");
		  }
		});
		function deleteCode()
		{
			var institutedata=
			{
				categoryID:$('#hidCUniqueidEdit').val(),
			};		
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_category_delete",
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
							var dtblProgram = $("#tblCategoryMaster").DataTable();
		 					dtblProgram.ajax.reload();
		 					
						}
						else
						{
							toastr.error(obj.msg);
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
//Edit or Delete minority community button clicked
function minorityRow(event,action)
{
	var oTable = $('#tblMinorityCommunityMaster').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});			
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
		
	$('#frmMinoritycommunityEdit').data('bootstrapValidator').resetForm(true); 
	var categoryID = oTable.fnGetData(row)[3];//GETTING DATA FOR HIDDEN COLUMN
	$('#hidMUniqueidEdit').val(categoryID);//GETTING VALUE FOR HIDDEN COLUMN
	$('#txtMinoritycommunityCodeEdit').val(row.cells[1].innerHTML);
	$('#txtMinoritycommunityNameEdit').val(row.cells[2].innerHTML);
	
	if(action == 'edit')
	{	
		$('#hidOperMinorityEdit').val("edit_minority");
		$('#minoritycommunityEditModal').modal('show');
	}
	else
	{
		swal({
		  title: "Are you sure?",
		  text: "Do you want to Delete the Community!",
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
		    swal("Deleted", "Community has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Community is safe ", "error");
		  }
		});
		function deleteCode()
		{
			var institutedata=
			{
				minoritycommunityID:$('#hidMUniqueidEdit').val(),
			};		
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_minority_delete",
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
							 var dtblProgram = $("#tblMinorityCommunityMaster").DataTable();
		 					dtblProgram.ajax.reload();
		 					
						}
						else
						{
							toastr.error(obj.msg);
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Delete.Please Try Again !', "error");
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
//Edit or Delete caste button clicked
function casteRow(event,action)
{
	var oTable = $('#tblCaste').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});			
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
		
	$('#frmEditCaste').data('bootstrapValidator').resetForm(true); 
	var programCode = oTable.fnGetData(row)[1];//GETTING DATA FOR HIDDEN COLUMN
	
	$('#hidCasteCodeEdit').val(row.cells[1].innerHTML);//GETTING VALUE FOR HIDDEN COLUMN
	$('#txtCasteCodeEdit').val(row.cells[1].innerHTML);
	$('#txtCasteNameEdit').val(row.cells[2].innerHTML);
	
	
	var selectedText2 = oTable.fnGetData(row)[4];
	$('#cmbCasteStatusEdit').val(selectedText2);
	
	if(action == 'edit')
	{	
		$('#hidOperCasteEdit').val("edit_caste");
		$('#CasteEditModal').modal('show');
	}
	else
	{
		swal({
		  title: "Are you sure?",
		  text: "Do you want to Delete the Caste!",
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
		    swal("Deleted", "Caste has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Caste is safe ", "error");
		  }
		});
		function deleteCode()
		{
			var institutedata=
			{
				hidCasteCodeEdit:$('#hidCasteCodeEdit').val(),
			};		
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_caste_delete",
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
							var dtblChallan = $("#tblCaste").DataTable();
		 					dtblChallan.ajax.reload();
		 					
						}
						else
						{
							toastr.error(obj.msg);
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
//Edit or Delete Religion button clicked
function religonRow(event,action)
{
	var oTable = $('#tblReligionMaster').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});			
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
		
	$('#frmReligionEdit').data('bootstrapValidator').resetForm(true); 
	var programCode = oTable.fnGetData(row)[3];//GETTING DATA FOR HIDDEN COLUMN
	
	$('#hidRUniqueidEdit').val(programCode);//GETTING VALUE FOR HIDDEN COLUMN
	$('#txtReligionCodeEdit').val(row.cells[1].innerHTML);
	$('#txtReligionNameEdit').val(row.cells[2].innerHTML);
	
	
	var selectedText2 = oTable.fnGetData(row)[4];
	$('#cmbCasteStatusEdit').val(selectedText2);
	
	if(action == 'edit')
	{	
		$('#hidOperReligionEdit').val("edit_religion");
		$('#religionEditModal').modal('show');
	}
	else
	{
		swal({
		  title: "Are you sure?",
		  text: "Do you want to Delete the Religion!",
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
		    swal("Deleted", "Religion has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Religion is safe ", "error");
		  }
		});
		function deleteCode()
		{
			var institutedata=
			{
				religionID:$('#hidRUniqueidEdit').val(),
			};		
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_religion_delete",
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
							var dtblProgram = $("#tblReligionMaster").DataTable();
		 					dtblProgram.ajax.reload();
		 					
						}
						else
						{
							toastr.error(obj.msg);
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