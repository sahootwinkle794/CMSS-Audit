$(document).ready(function()
{
	$('.selectpicker').selectpicker(
	  {  
	    liveSearchPlaceholder: 'Placeholder text'
	  }
	);
	$('.bs-searchbox input').attr('placeholder', 
      'Search');
	var isDelete= false;
	var isEdit = false;
	var oTable;
	session = '';
	$("#spanInstitute").hide(); 
	$("#spanLoading").hide(); 
	$('.selectpicker').selectpicker();
	/*------------------------------- TAB CLICK LOAD DATA  STARTS--------------------------------------------------------*/
	$('#tabResource').click(function(){
		var instituteAdminTable = $('#dtblResource').DataTable();
		instituteAdminTable.ajax.url(base_url+"ajax_controller/select_resource").load();
	});
	$('#tabRole').click(function(){
		// GET LANDING PAGE URL
		$.ajax({
			url:base_url+"ajax_controller/select_resource",
			mType:"get",
			data:'',
			success:function(response)
			{  
				var options = "<option value=''>Select Landing Page URL</option>";					
				var res1 = JSON.parse(response);					
				$.each(res1.aaData,function(i,data)
				{
					options = options + "<option value='"+data.resource_code+"'>"+data.resource_code+"</option>";
				});
				$('#cmbLandingPageUrl').html("");   
				$('#cmbLandingPageUrl').append(options);
				$('#cmbLandingPageUrl').html(options)
				.selectpicker('refresh');
				 		
			},
			error:function()
			{
				toastr.error('We are unable to process please contact support');	
			}
		});
		// GET PROFILE PAGE URL
		$.ajax({
			url:base_url+"ajax_controller/select_resource",
			mType:"get",
			data:'',
			success:function(response)
			{  
				var options = "<option value=''>Select Profile Page URL</option>";					
				var res1 = JSON.parse(response);					
				$.each(res1.aaData,function(i,data)
				{
					options = options + "<option value='"+data.resource_code+"'>"+data.resource_code+"</option>";
				});
				$('#cmbProfilePageUrl').html("");   
				$('#cmbProfilePageUrl').append(options);
				$('#cmbProfilePageUrl').html(options)
				.selectpicker('refresh');
				 		
			},
			error:function()
			{
				toastr.error('We are unable to process please contact support');	
			}
		});
		var dtblRole = $('#dtblRole').DataTable();
		dtblRole.ajax.url(base_url+"ajax_controller/select_role").load();
	});
	$('#tabMenu').click(function(){
		//GET ROLE FOR MENU TAB
		$.ajax({
			url:base_url+"ajax_controller/select_role",
			mType:"get",
			data:'',
			success:function(response)
			{  
				var options = "<option value=''>Select</option>";					
				var res1 = JSON.parse(response);					
				$.each(res1.aaData,function(i,data)
				{
					options = options + "<option value='"+data.role_code+"'>"+data.role_name+"</option>";
				});
				$('#cmbRole').html("");   
				$('#cmbRole').append(options);
				$('#cmbRoleFilter').html("");   
				$('#cmbRoleFilter').append(options);
				$('#cmbRole').html(options)
				.selectpicker('refresh');		
			},
			error:function()
			{
				toastr.error('We are unable to process please contact support');	
			}
		});
		//GET LINK URL
		$.ajax({
			url:base_url+"ajax_controller/select_resource",
			mType:"get",
			data:{type:"SELECT",_s:session},
			success:function(response)
			{  
				var options = "<option value=''>Select Landing Page URL</option>";					
				var res1 = JSON.parse(response);					
				$.each(res1.aaData,function(i,data)
				{
					options = options + "<option value='"+data.resource_code+"'>"+data.resource_code+"</option>";
				});  
				$('#cmbLinkUrl').html("");   
				$('#cmbLinkUrl').append(options);
				$('#cmbLinkUrl').html(options)
				.selectpicker('refresh');   		
			},
			error:function()
			{
				toastr.error('We are unable to process please contact support');	
			}
		});
	});
	
	/*------------------------------- TAB CLICK LOAD DATA  ENDS--------------------------------------------------------*/
	var instituteAdminTable = $('#dtblResource').dataTable({
		//"responsive": true,
		"sAjaxSource": base_url+"ajax_controller/select_resource",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth":true, 
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addbuttonResource' >>><'col-xs-6'p>>",  
	    "aoColumns": [    
                       { "sName": "sl_no","sWidth": "5%" },
                       { "sName": "Resource_Code","sWidth": "30%" },
                       { "sName": "Resource_Name","sWidth": "25%","bVisible":false},
                       { "sName": "is_instruction_applicable","sWidth": "25%","bVisible":false},
					   {"sName": "default","sWidth": "10%","bVisible":false, "sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='editResourceRow(event)' title='Edit' ><i class='fa fa-edit'></i></button>"}
              	  	],
		"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 4 ] }],
		"fnDrawCallback": function(oSettings, json) {
     		$('.tooltipTable').tooltipster( {
	         	theme: 'tooltipster-punk',
	      		animation: 'grow',
	        	delay: 200, 
	         	touchDevices: false,
	         	trigger: 'hover'
      		} );          
  		}      
	});
	$("div.addbuttonResource").html('<button id="btnAddResource" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	/*$("div.addbuttonResource").html("<button id='btnAddResource' class='btn btn-info custombtn btn-circle tooltips' title='Add Resource'><i class='fa fa-plus'></i></button>");*/
	//ADD button clicked
	$('#btnAddResource').click(function()
	{
		$(instituteAdminTable.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		 $("#txtResourceCode").attr("readonly", false); 
		$('#frmResource').data('bootstrapValidator').resetForm(true);
		$('#txtResourceCode').val("");
		$('#txtResourceName').val("");
		$('#chkIsInstruction').prop('checked', false);
		$("#myModalLabel").html("Add Resource");
		$("#btnSaveResource").html("<i class='fa fa-save'></i>  Add");
		$("#hidOperTypeResource").val("add_resource");
		$('#modalResource').modal('show');
		$('#modalResource').on('shown.bs.modal', function()
		{  
			$('#txtResourceCode').focus();// Focusing the textbox
		})	
		
	});
	
	//ADD/UPDATE RECORD WITH VALIDATION	
	$('#frmResource').bootstrapValidator({
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
			var formData = new FormData(document.getElementById("frmResource"));
			var oper = $("#btnSaveResource").html();
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_resourcedata",
				type:"post",
				data:formData,
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
							$('#frmResource').data('bootstrapValidator').resetForm(true);
							$('#chkIsInstruction').prop('checked', false);
							var dtblResource = $("#dtblResource").DataTable();
						 	dtblResource.ajax.reload();
						 	if(oper != 'Add')
						 	{
								$('#modalResource').modal('hide');
							}
							bind_resource();
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlogResource').html(obj.msg);
		                	$('#errorlogResource').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlogResource').html(obj.msg);
		                	$('#errorlogResource').show();
		                }
						else 
						{
							
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
		},
    	//live: 'enabled',
        fields:
         {
            txtResourceCode: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }/*,
                    regexp: {
						regexp: /^([A-Za-z]+)$/i,
						message: "Special characters and numbers and space are not allowed"
					}*/
                }
            },
            txtResourceName: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }
		}	
	});	
	$('#txtResourceCode').on("blur",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtCode:$(event.target).val(),
					validatemenucode:true
				};
		   //ajax call to server
		   
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_resource", 
				type:"post",
				data:institutedata,
				success:function(response)
				{
					//alert(response)
					var obj = jQuery.parseJSON(response);
					if(obj.status)
					{
					 	$(event.target).val("");
					 	$('#frmResource').data('bootstrapValidator').updateStatus('txtResourceCode', 'NOT_VALIDATED', null).validateField('txtResourceCode');
						toastr.error('Code Already Created');
						$(event.target).focus();					
					}
					else
					{
						
					}
				},  
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			}); 
		}
	}); 
	
	/*****For Role tab*****/
	$('#dtblRole').DataTable({		
		//"sAjaxSource": "usermanamanage_user_dbge_db.php?type=GET_ROLE&_s="+session,
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth":false, 
        "bRetrieve": true,
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addbuttonRole' >>><'col-xs-6'p>>",
        "aoColumns": [
						{ "sName": "slno","sWidth": "5%"},
						{ "sName": "role_id","bVisible":false},
						{ "sName": "role_code","sWidth": "20%" },
			         	{ "sName": "role_name","sWidth": "20%" },
						{ "sName": "index_page_url","sWidth": "20%" },
						{ "sName": "profile_page_url","sWidth": "20%" },
			         	{"sName": "default","sWidth": "15%","sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='roleRow(event,\"edit\" )' title='Edit' ><i class='fa fa-edit'></i></button>&nbsp;<button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='roleRow(event,\"delete\" )' title='Delete' ><i class='fa fa-trash'></i></button>  "}                  					            				 				 
					],
		"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 6 ] }],
		"fnDrawCallback": function(oSettings, json) {
     		$('.tooltipTable').tooltipster( {
	         	theme: 'tooltipster-punk',
	      		animation: 'grow',
	        	delay: 200, 
	         	touchDevices: false,
	         	trigger: 'hover'
      		} );
		}    
	});	
	$("div.addbuttonRole").html('<button id="roleaddbtn" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	/*$("div.addbuttonRole").html("<button id='roleaddbtn' class='btn btn-info custombtn btn-circle tooltips' title='Add Role'><i class='fa fa-plus'></i></button>");	*/
	
	$('#roleaddbtn').click(function()
	{				
		$('#frmrolesetup').data('bootstrapValidator').resetForm(true);		
		$('#hidRoleId').val('');
		//alert($('#hidRoleId').val());												
		$('#txtRoleCode').val("");
		$('#txtRoleCode').attr("readonly", false);
		$('#txtRoleName').val("");
		$('#cmbLandingPageUrl').selectpicker("refresh");
		$('#cmbProfilePageUrl').selectpicker("refresh");
		bind_resource();
		$('#hidOperTypeRole').val("add_role");
		$("#myModalLabel").html("Update Resource");
		$("#saveRoleMaster").html('<i class="fa fa-save"></i> Save');
		$("#lblModalRoleSetup").html('Add');				
						
		$('#RoleSetupModal').modal('show');					
	});
	
	$('#frmrolesetup').bootstrapValidator({
		excluded: [':disabled'],
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
			var hid_code = $('#hidRoleId').val();
			//alert(hid_code);
			var oper;								
			if(hid_code == '')					
				oper = 'INSERT_ROLE';												
			else
				oper = 'UPDATE_ROLE';
				
			var formData = new FormData(document.getElementById("frmrolesetup"));
				//alert(formData);
			$.ajax({
				url:base_url+"ajax_controller/operation_roledata",
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
							//toastr.success(result.dbMessage);
				 			var dtblRole = $("#dtblRole").DataTable();
				 			dtblRole.ajax.reload();
							$('#frmrolesetup').data('bootstrapValidator').resetForm(true);
						 	if(oper == 'UPDATE_ROLE')
						 	{
								$('#RoleSetupModal').modal('hide');
							}
							bind_resource();
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlogRole').html(obj.msg);
		                	$('#errorlogRole').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlogRole').html(obj.msg);
		                	$('#errorlogRole').show();
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
					
				}
			});																						
		},
		fields: {			
			txtRoleCode: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            txtRoleName: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            cmbLandingPageUrl: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            cmbProfilePageUrl: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            cmbSchoolLvlAccess: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }			
		}
	});

	//ajax call to get institute code and name
	$.ajax({
		url:base_url+"ajax_controller/select_institute",
		type:"get",
		success:function(response){  
			var res1 = JSON.parse(response);
			var options = "";
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value='"+data.institute_code+"'>"+data.institute_name+"</option>";
			}); 
			$('#cmbInstitute').html(options).selectpicker('refresh');  
			show_datatable($('#cmbInstitute').val());
		},
		error:function(){
			alert("We are unable to Process.Please contact Support");
		}
	});
	//onchange of institute name
	$('#cmbInstitute').change(function (event){
		var institute = $('#cmbInstitute').val();
		show_datatable($('#cmbInstitute').val());
		$("#hidInstituteCode").val(institute);
	});
	//onclick of refresh button
	/*$("#btnRefresh").click(function(){
    	window.location.href = "manage_user.php?_s="+session+"&institute_code="+$('#cmbInstitute').val()+"&tab_name=User";
	});*/
	//ajax call to get role
	$.ajax({
		url:base_url+"ajax_controller/select_role",
		type:"get",
		success:function(response){ 
			var res1 = JSON.parse(response);
			var options = "<option value=''>Select Role</option>";
			$.each(res1.aaData,function(i,data){
				options += "<option value='"+data.role_code+"'>"+data.role_name+"</option>";
			});
			$('#cmbRoleUser').html(options).selectpicker('refresh');
			//$('#cmbRoleUser').append(options);  
			$('#cmbRoleUserEdit').html("");
			$('#cmbRoleUserEdit').append(options); 
		},
		error:function(){
			alert("We are unable to Process.Please contact Support");
		}
	});
	//onclick of add button
	$('#btnAdd').click(function(){
		if($("#cmbInstitute").val() == '')
		{
			toastr.error("Select the Institute Name");
		}
		else
		{	
		
			$('#usermanageformid').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal
			$('#txtEmployeeName').val("");
			$('#cmbRoleUser').selectpicker('val',"");
			//$('#cmbRole').val("");
			$('#txtUserName').attr('readonly', false);
			$('#cmbStatus').val("");
			$('#userImageUpload').val("");
			$('#hidUserCode').val("");
			$('#userAddModal').modal('show');
			$('#imageDisplayareaUser').attr('src', '');
			document.getElementById("signMessageUser").innerHTML="";
			var institute = $('#cmbInstitute').val();
			show_datatable($('#cmbInstitute').val());
			$("#hidInstituteCode").val(institute);
			$('#userAddModal').on('shown.bs.modal', function()
			{  
				$('#txtEmployeeName').focus();// Focusing the textbox
			})
		}	
	});
	$('#txtUserName').change(function(){
		var user_name = $('#txtUserName').val();	
		if(user_name != '')
		{
			
			var institutedata={
				institute_code:$("#cmbInstitute").val(),
				txtUserName:$('#txtUserName').val()
			};
			$.ajax({
				url:base_url+"ajax_controller/check_user_username",
				type:"post",
				data:institutedata,
				success:function(response){  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status)
						{
							$('#txtUserName').val("");
							$('#usermanageformid').data('bootstrapValidator').updateStatus('txtUserName', 'NOT_VALIDATED', null).validateField('txtUserName');
							toastr.error('Username Already Created');
				    		
						}
						
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}
					//$("#spanProcessingMenu").hide();
						
					//toastr.success('Data Successfully Inserted');				
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		}
		
			
	});
	//ADD RECORD WITH VALIDATION	
	$('#usermanageformid').bootstrapValidator({
		excluded: [':disabled'],
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
			var formData = new FormData(document.getElementById("usermanageformid"));
			
			$("#userBtn").html("Processing...");
			//var type = '';
			if($('#hidUserCode').val() == '')
			{
				//type = 'inser_user';
				var institutedata={
					institute_code:$("#cmbInstitute").val(),
					txtEmployeeName:$('#txtEmployeeName').val(),
					txtUserName:$('#txtUserName').val(),
					cmbRoleUser:$('#cmbRoleUser').val(),
					hidImageUpload:$('#hidImageUpload').val(),
					userImageUpload:$('#userImageUpload').val(),
					cmbStatus:$('#cmbStatus').val(),
					cmbRole:$('#cmbRole').val()
					
				};
					$.ajax({
					url:base_url+"ajax_controller/insert_manageUser_User",
					type:"post",
					data:formData,
					processData: false,
   					contentType: false,
					success:function(response){  
						try
						{
							var obj = jQuery.parseJSON(response);
							if(obj.status == true)
							{
								toastr.success(obj.msg);
								var dtblProgram = $("#dtblManageUsers").DataTable();
					 			dtblProgram.ajax.reload();
					 			$('#usermanageformid').data('bootstrapValidator').resetForm(true);
					    		$('#imageDisplayareaUser').attr('src', '');
					    		$('#userImageUpload').val('');
					    		
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
						//$("#spanProcessingMenu").hide();
							
						//toastr.success('Data Successfully Inserted');				
					},
					error:function(){
						toastr.error('Unable to process please contact support');
					}
				});
			}
				
			else
			{
				var formData = new FormData(document.getElementById("usermanageformid"));
				//type = 'update_user';
					/*var institutedata={
						institute_code:$("#cmbInstitute").val(),
						hidUserCode:$("#hidUserCode").val();
						txtEmployeeName:$('#txtEmployeeName').val(),
						txtUserName:$('#txtUserName').val(),
						cmbRoleUser:$('#cmbRoleUser').val(),
						hidImageUpload:$('#hidImageUpload').val(),
						userImageUpload:$('#userImageUpload').val(),
						cmbStatus:$('#cmbStatus').val(),
						cmbRole:$('#cmbRole').val()
						
					};*/
					$.ajax({
					url:base_url+"ajax_controller/update_manageUser_User",
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
								var dtblProgram = $("#dtblManageUsers").DataTable();
					 			dtblProgram.ajax.reload();
					 			$('#usermanageformid').data('bootstrapValidator').resetForm(true);
					 			$('#userAddModal').modal('hide');
					 			//$('#imageDisplayareaUser').attr('src', '');
					    		
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
				
			}
				
				
			//var formData = new FormData(document.getElementById("usermanageformid"));
			//ajax call for add and update
			
			/*$.ajax({
				url:"manage_user_db.php?_s="+session+"&type="+type+"&institute_code="+$("#cmbInstitute").val(), 
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(responsedata)
				{  
					var result = jQuery.parseJSON(responsedata);
					if(type == 'UPDATE_USER')
	            	{
	            		var dtblManageUsers = $("#dtblManageUsers").DataTable();
				 		dtblManageUsers.ajax.reload();
	            		$('#userAddModal').modal('hide');
					}
		            if(result.dbStatus == 'SUCCESS')
		            {
						var dtblManageUsers = $("#dtblManageUsers").DataTable();
				 		dtblManageUsers.ajax.reload();
						toastr.success(result.dbMessage);
					}
					else if(result.dbStatus == 'FAILURE')
		            {
						toastr.error(result.dbMessage);	
					}
					$('#usermanageformid').data('bootstrapValidator').resetForm(true);
					$('#cmbRoleUser').selectpicker('val',"");
					$('#hidUserCode').val("");
				},
				error:function()
				{
					toastr.error('We are unable to process please contact support');	
				}
			});*/
			$("#userBtn").html("<i class='fa fa-save'></i>  Save");
		},
        fields:
        {
            txtEmployeeName: { validators: { 
            	notEmpty: {
            		 message: 'Required' 
            		 },
            		 regexp: {
                        regexp: /^([a-zA-Z. ]+)$/,
                        message: "only Alphabet and (.) are  allowed"
					}, 
					stringLength: {
						max: 50,
						message: 'Maximum 50 character`s are allowed'
					}
            }},
            txtUserName: { validators: { 
            	notEmpty: { message: 'Required' }
            }},
            cmbRoleUser: {  validators: {
                notEmpty: { message: 'Required' }
            }},
            userImageUpload: { validators: { 
            	callback: {
                    message: 'Required',
                    callback: function(value, validator, $field) {
                        // Get the selected options
                        var hidcode = $('#hidUserCode').val();
                        if((hidcode == '') && ($("#userImageUpload").val() == ''))
                        	return false;
                        else
	                        return true;
                    }
                },          
                /*file: 
                {
                    extension: 'jpeg,jpg,png,JPEG,JPG,PNG',
                   	type: 'image/jpeg,image/png',
                    message: 'The selected file is not valid'
                }*/
            }},
            cmbStatus: { validators: {           
                notEmpty: { message: 'Required' }
            }}
		}	
	});	
	//validating image field
	/*$('#userImageUpload').on('change', function (event)
	{
		$('#usermanageformid').data('bootstrapValidator').updateStatus('userImageUpload', 'NOT_VALIDATED', null).validateField('userImageUpload');
	});*/
	//********* for display area and validation********
	$('#userImageUpload').change(function()			
	{ 
	  // alert("sdfd");
		var file = document.getElementById("userImageUpload").files[0];
		//alert(file);
		var sFileName = file.name;
		//alert(sFileName);
		var file_path = file.path;
		//alert(file.mozFullPath);
        var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
        var iFileSize = file.size;
        //var iConvert = (file.size / 1048576).toFixed(2);
        if (sFileExtension == "jpg" || sFileExtension == "jpeg" || sFileExtension == "png" )
		{ 
			if(iFileSize <= 409600)
			{
			
			  document.getElementById("signMessageUser").innerHTML="";
			  $("#imageDisplayareaUser").attr('height','0');
			  $("#imageDisplayareaUser").attr('width','0');
			  readURLSigLogo(this);
			  
			}
			else
			{
				//alert("File size exceeds 1 MB.");
				document.getElementById("signMessageUser").innerHTML="Error : File size exceeds 400 KB";
				$('#userImageUpload').val("");
				$('#usermanageformid').data('bootstrapValidator').updateStatus('userImageUpload', 'NOT_VALIDATED', null).validateField('userImageUpload');
						
				$('#imageDisplayareaUser').attr('src','');
				$("#imageDisplayareaUser").attr('height','0');
				$("#imageDisplayareaUser").attr('width','0');
			}
        }
		else
		{
            //alert("Invalid File Format");
			document.getElementById("signMessageUser").innerHTML="Error : Invalid File Format";
			$('#userImageUpload').val("");
			$('#usermanageformid').data('bootstrapValidator').updateStatus('userImageUpload', 'NOT_VALIDATED', null).validateField('userImageUpload');
			//$('#usermanageformid').data('bootstrapValidator').updateStatus('userImageUpload', 'NOT_VALIDATED', null).validateField('userImageUpload');
			$('#imageDisplayareaUser').attr('src','');
			$("#imageDisplayareaUser").attr('height','0');
			$("#imageDisplayareaUser").attr('width','0');
		}
		
		
	});
	
	function readURLSigLogo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#imageDisplayareaUser').attr('src', e.target.result);
				$("#imageDisplayareaUser").attr('height','100');
				$("#imageDisplayareaUser").attr('width','100');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
	$('#txtRoleCode').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtCode:$(event.target).val(),
					validatemenucode:true
				};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_role", 
				type:"post",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status)
					{
					 	$(event.target).val("");
						$('#frmrolesetup').data('bootstrapValidator').updateStatus('txtRoleCode', 'NOT_VALIDATED', null).validateField('txtRoleCode');
						toastr.error('Code Already Created');
						$(event.target).focus();					
					}
					else
					{
						
					}
				},  
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			}); 
		}
	}); 
	
	//******************************* FOR MENU TAB **********************************//
	var dtblMenuTable = $('#dtblMenu').dataTable({
		
		"bPaginate": true,
        "bLengthChange": true,
        "bStateSave": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth":false,  
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 divButtonMenu' >>><'col-xs-6'p>>", 
	    "aoColumns": [    
                       { "sName": "sl_no","sWidth": "5%"},
                       { "sName": "link_text","sWidth": "10%"},
                       { "sName": "link_url","sWidth": "15%"},
                       { "sName": "parent","sWidth": "10%"},
                       { "sName": "menu_sl","sWidth": "5%"},
                       { "sName": "has_child","sWidth": "12%"},
                       { "sName": "is_last_child","sWidth": "12%"},
                       { "sName": "icon_class","sWidth": "15%"},
                       {"sName": "default",data:null,"sWidth": "11%","sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='menuRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>&nbsp;<button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='menuRow(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i></button>"}
                       /*{ "sName": "role","bVisible":false,data:null},
                       { "sName": "parent_id","bVisible":false,data:null},
                       { "sName": "menu_id","bVisible":false,data:null}*/
              	     ],
		//"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 11 ] }],
		"fnRowCallback": function(oSettings, json) {
	 		$('.tooltipTable').tooltipster( {
	         	theme: 'tooltipster-punk',
	      		animation: 'grow',
	        	delay: 200, 
	         	touchDevices: false,
	         	trigger: 'hover'
	  		} );
		}              
	});
	$("div.divButtonMenu").html('<button id="btnAddMenu" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	/*$("div.divButtonMenu").html("<button type='button' id='btnAddMenu' class='btn btn-info custombtn btn-circle tooltips' title='Add Menu'><i class='fa fa-plus'></i></button>");*/
	$('#btnAddMenu').click(function()
	{
		
		if($("#cmbRole").val() != '')
		{
			$(dtblMenuTable.fnSettings().aoData).each(function ()
			{
				$(this.nTr).removeClass('success');
			});
			$('#frmMenu').data('bootstrapValidator').resetForm(true);
			$('#cmbRoles').val("");
			$('#txtLinkText').val("");
			$('#cmbLinkUrl').selectpicker("refresh");
			$('#cmbParent').val("");
			$('#txtMenuSl').val("");
			$('#txtIconClass').val("");
			$('#hidOperTypeMenu').val("add_menu");
			$('#chkHasChild').prop('checked', false);
			$('#chkIsLastChild').prop('checked', false);
			$("#myModalLabel").html("Add Menu");
			$("#btnSaveMenu").html("<i class='fa fa-save'></i>  Add");
			$('#modalMenu').modal('show');
			$('#modalMenu').on('shown.bs.modal', function()
			{  
				$('#cmbRoles').focus();// Focusing the textbox
			})
		}
		else
		{
			toastr.error('Please Select A Role');	
		}	
		
	});
	$('#btnCopy').click(function()
	{
		 
		if($('#cmbRole').val() == '' && $('#cmbCopyRole').val() == '')
		{
			toastr.error('Please Select Role');
			toastr.error('Please Select Copy To Role');
		}
		else if($('#cmbRole').val() != '' && $('#cmbCopyRole').val() == '')
		{
			toastr.error('Please Select Copy To Role');
		}
		else if($('#cmbRole').val() == '' && $('#cmbCopyRole').val() != '')
		{
			toastr.error('Please Select Role');
		}
		else
		{
			$("#btnUpdate").html('<i class="fa fa-gear fa-spin"></i> Saving...');
   			$("#btnUpdate").attr('disabled', true);
			var roledata=
			{
				cmbRole:$('#cmbRole').val(),
				cmbCopyRole:$('#cmbCopyRole').val()
			};
			var $btn = $(this);
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/copy_menudata",
				type:"POST",
				data:roledata,
				success:function(response)
				{
					$("#btnUpdate").html('<i class="fa fa-files-o"></i> Copy');
      				$("#btnUpdate").removeAttr('disabled');   					
					//alert(obj.dbStatus);		
					var obj = jQuery.parseJSON(response);
					if(obj.dbstatus  == true)
					{
						//Alert("FAILURE");
						toastr.success(obj.dbMessage); 
					}
					else
					{
						toastr.error(obj.dbMessage);	
					}
					$btn.button('reset'); 
				},
				error:function()
				{
					$("#spanLoading").hide(); 
					toastr.error('Unable to process please contact support');
					$btn.button('reset'); 
				}
			});
		}	
    }); 
	//preview button
  	$('#btnPreview').click(function(){
  		if($('#cmbRole').val() != '')
  		{
  			var cmbRole = $('#cmbRole').val();
  			window.open(base_url+"superadmin/menuPreview/"+cmbRole,'winview','width=900,height=700,toolbar=0,status=0,menubar=0,resizable=1,scrollbars=1').focus();
  		}
  		else
  		{
  			toastr.error('Please Select Role');
  		}
  	});	
	$('#frmMenu').bootstrapValidator({
		excluded: [':disabled'],
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
			var formData = new FormData(document.getElementById("frmMenu"));
			var oper = $("#btnSaveMenu").html();
			if(oper == 'Add')
			{
				oper = "ADD_MENU";
			}
			else if(oper == 'Update')
			{
				oper = "UPDATE_MENU";
			}
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_menudata",
				type:"post",
				data:formData,
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
							//toastr.success(result.dbMessage);
				 			var menudata={
								cmbRole:$('#cmbRole').val(),
							};
						   //ajax call to server
							$.ajax({
								url:base_url+"ajax_controller/select_menu",
								type:"POST",
								data:menudata,
								success:function(response)
								{  
									data = jQuery.parseJSON(response);
									dtblMenuTable.fnClearTable();
									if (data.aaData.length)
									dtblMenuTable.fnAddData(data.aaData);
									dtblMenuTable.fnDraw();	
									$('#chkHasChild').prop('checked', false);
									$('#chkIsLastChild').prop('checked', false);
									
									$('#modalMenu').modal('hide');
									
									/*$('#txtLinkText').val('');
									$('#cmbLinkUrl').val('');
									$('#cmbParent').val('');
									$('#txtMenuSl').val('');
									$('#chkHasChild').val('');
									$('#chkIsLastChild').val('');
									$('#txtIconClass').val('');*/
								},
								error:function(){
									//toastr.error('Unable to Process Please Contact Support');
								}
							});
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlogMenu').html(obj.msg);
		                	$('#errorlogMenu').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlogMenu').html(obj.msg);
		                	$('#errorlogMenu').show();
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
					toastr.error('Unable to Save.Please Try Again ');	
				}
			});
		},
    	//live: 'enabled',
        fields:
         {
            cmbRoles: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            txtLinkText: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
           cmbLinkUrl:{
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            cmbParent:{
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            txtMenuSl:{
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
					numeric: {
						message: 'Please Enter a numeric value'
					}
                    
                }
            },
            txtIconClass:{
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }
		}	
	});	
	$('#menudeleterec').click(function(){
		$('#menudeletemodal').modal('hide');		
		var menudata=
		{
			menuid:$('#hidMenuId').val(),
			type:"DELETE_MENU"
		};
		//ajax call to server
		$.ajax({
				url:"manage_user_db.php",
				mType:"post",
				data:menudata,
				success:function(response)
				{  	
					var menudata={
							cmbRole:$('#cmbRole').val(),
							type:"GET_VALUE",
							_s:session
						};
				   //ajax call to server
					$.ajax({
						url:"manage_user_db.php",
						mType:"get",
						data:menudata,
						success:function(response)
						{  
							data = jQuery.parseJSON(response);
							dtblMenuTable.fnClearTable();
							if (data.aaData.length)
							dtblMenuTable.fnAddData(data.aaData);
							dtblMenuTable.fnDraw();	
						},
						error:function(){
							//toastr.error('Unable to Process Please Contact Support');
						}
					});
					toastr.success('Data Successfully Deleted');							
				},
				error:function()
				{
					toastr.error('Unable to Process Please Contact Support');
				}
			});
	});
	//get parent from database
	$('#cmbRole').change(function (event){
			var role = $('#cmbRole').val();
			$('#hidRole').val(role);
			var roledata={
							cmbRole:$('#cmbRole').val()
						};
			   //ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/select_copy_role",
					type:"post",
					data:roledata,
					success:function(response)
					{  
						var options = "<option value=''>Select</option>";					
						var res1 = JSON.parse(response);					
						$.each(res1.aaData,function(i,data)
						{
							options = options + "<option value='"+data.role_code+"'>"+data.role_name+"</option>";
						});
						$('#cmbCopyRole').html("");   
						$('#cmbCopyRole').append(options);
						$('#cmbCopyRole').html(options)
						.selectpicker('refresh');
							
					},
					error:function(){
						toastr.error('Unable to Process Please Contact Support');
					}
				});
			var menudata={
							cmbRole:$('#cmbRole').val(),
						};
			   //ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/select_menu",
					type:"post",
					data:menudata,
					success:function(response)
					{  
						data = jQuery.parseJSON(response);
						dtblMenuTable.fnClearTable();
						if (data.aaData.length)
							dtblMenuTable.fnAddData(data.aaData);
						dtblMenuTable.fnDraw();	
					},
					error:function(){
						toastr.error('Unable to Process Please Contact Support');
					}
				});
				var parentdata={
							cmbRole:$('#cmbRole').val()
						};
			   //ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/select_parent",
					type:"post",
					data:parentdata,
					success:function(response)
					{  
						var options = "<option value=''>Select Parent</option><option value='0'>(No Parent)</option>";					
						var res1 = JSON.parse(response);					
						$.each(res1.aaData,function(i,data)
						{
							options = options + "<option value='"+data.menu_id+"'>"+data.link_text+"</option>";
						});
						$('#cmbParent').html("");   
						$('#cmbParent').append(options);		
					},
					error:function(){
						toastr.error('Unable to Process Please Contact Support');
					}
				});  
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
	  "showDuration": "300",
	  "hideDuration": "1000",
	  "timeOut": "2000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}
	/* END OF CODE FOR TOASTR*/
	
	/*** uppercase convert of code******/
	$('#txtRoleCode').on('keydown', function(e) {
	    //console.log(e.which);
	    if(e.which != 37 &&  e.which != 39 && e.which != 8 ) // For back space, left & right arrow
	    {
	      var str = document.getElementById("txtRoleCode").value;
	        var res = str.toUpperCase();
	        document.getElementById("txtRoleCode").value = res;
	    }
 	});
	$('#txtRoleCode').on('keyup', function(e) {
	    //console.log(e.which);
	    if(e.which != 37 && e.which != 39 && e.which != 8 )
	    {
	      var str = document.getElementById("txtRoleCode").value;
	        var res = str.toUpperCase();
	        document.getElementById("txtRoleCode").value = res;
	    }
	});
	$('#txtRoleCode').on('change', function(e) {
	    //console.log(e.which);
	    var str = document.getElementById("txtRoleCode").value;
	    var res = str.toUpperCase();
	    document.getElementById("txtRoleCode").value = res; 
	});
});
function editResourceRow(event)
{
	$('#frmResource').data('bootstrapValidator').resetForm(true);
	$('#chkIsInstruction').prop('checked', false);
	//alert($('#chkIsInstruction').prop);
	//$(instituteAdminTable.fnSettings().aoData).each(function ()
	var oTable = $('#dtblResource').dataTable();		
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
    $('#txtResourceCode').val(row.cells[1].innerHTML.replace('&amp;','&'));
    $('#txtResourceName').val(row.cells[2].innerHTML.replace('&amp;','&'));
    $("#txtResourceCode").attr('readonly','readonly');
    var chkIsInstruction = 'Yes';
    //alert(chkIsInstruction);
   
	if(chkIsInstruction == 'Yes')
    {
    	$('#chkIsInstruction').iCheck('check');
    }
    else 
    {
    	//alert("HI");
    	//$('#chkIsInstruction').attr('checked', false);
    	$('#chkIsInstruction').iCheck('uncheck');
    }
	
    
    $('#hidResourceCode').val(row.cells[1].innerHTML);
	$('#hidChkIns').val(chkIsInstruction);
	$("#myModalLabel").html("Update Resource");
	$("#btnSaveResource").html("<i class='fa fa-save'></i>  Update");
	$("#hidOperTypeResource").val("edit_resource");	
	$('#modalResource').modal('show');
}
function roleRow(event,action)
{
	//$(instituteAdminTable.fnSettings().aoData).each(function ()
	if(action == 'edit'){
		$('#frmrolesetup').data('bootstrapValidator').resetForm(true);
	}
	var oTable = $('#dtblRole').dataTable();		
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
	//alert(record_id);
	$(row).addClass('success');
    var id = oTable.fnGetData( row )[1];
	//alert(id);			
	$("#lblModalRoleSetup").html('Update');
	var roleCode = oTable.fnGetData( row )[2];
	var roleName = oTable.fnGetData( row )[3];		
	var landingPageUrl = oTable.fnGetData( row )[4];																
	var profilePageUrl = oTable.fnGetData( row )[5];																
	$('#hidRoleId').val(id);//GETTING VALUE FOR HIDDEN COLUMN	
	//alert($('#hidRoleId').val());			
	$('#txtRoleCode').val(roleCode);
	$('#txtRoleCode').attr("readonly", true);
					
	$('#txtRoleName').val(roleName);	
	$('#hidOperTypeRole').val("edit_role");	
	$('#cmbLandingPageUrl').val(landingPageUrl);
	$('#cmbProfilePageUrl').val(profilePageUrl);
	$('#cmbProfilePageUrl').selectpicker('refresh').selectpicker('val',profilePageUrl);
	$('#cmbLandingPageUrl').selectpicker('refresh').selectpicker('val',landingPageUrl);
	if(action == 'edit')
	{
		$('#RoleSetupModal').modal('show');
	}	
	else
	{
		
		// sweet-alert for delete
        swal({
		  title: "Are you sure?",
		  text: "you want to Delete the Role!",
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
		  	deleteMaster();
		    swal("Deleted", "Role has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Role is safe ", "error");
		  }
		});
        function deleteMaster(){
			var institutedata=
			{
				hidRoleId:$('#hidRoleId').val(),
				type:"DELETE_ROLE",
				
			};		
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/delete_roledata",
				type:"post",
				data:institutedata,
				success:function(responsedata)
				{  
					var result = jQuery.parseJSON(responsedata);
		            if(result.status)
		            {
		            	//alert("hi");
						toastr.success(result.msg);
						
			 			var dtblRole = $("#dtblRole").DataTable();
			 			var isDelete= false;
			 			$('#frmrolesetup').data('bootstrapValidator').resetForm(true);
						bind_role();
						dtblRole.ajax.reload();	
					}
					else
					{
						sweetAlert("Role",result.msg, "error");	
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

function bind_resource(){
	$.ajax({
		url:base_url+"ajax_controller/select_resource",
		mType:"get",
		data:'',
		success:function(response)
		{  
			var options = "<option value=''>Select Landing Page URL</option>";					
			var res1 = JSON.parse(response);					
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value='"+data.resource_code+"'>"+data.resource_code+"</option>";
			});
			$('#cmbLandingPageUrl').html("");   
			$('#cmbLandingPageUrl').append(options);
			$('#cmbLandingPageUrl').html(options)
			.selectpicker('refresh');
			 		
		},
		error:function()
		{
			toastr.error('We are unable to process please contact support');	
		}
	});
	$.ajax({
		url:base_url+"ajax_controller/select_resource",
		mType:"get",
		data:'',
		success:function(response)
		{  
			var options = "<option value=''>Select Profile Page URL</option>";					
			var res1 = JSON.parse(response);					
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value='"+data.resource_code+"'>"+data.resource_code+"</option>";
			});
			$('#cmbProfilePageUrl').html("");   
			$('#cmbProfilePageUrl').append(options);
			$('#cmbProfilePageUrl').html(options)
			.selectpicker('refresh');
			 		
		},
		error:function()
		{
			toastr.error('We are unable to process please contact support');	
		}
	});
	$.ajax({
		url:base_url+"ajax_controller/select_resource",
		mType:"get",
		data:{type:"SELECT",_s:$("#hidSession").val()},
		success:function(response)
		{  
			var options = "<option value=''>Select Landing Page URL</option>";					
			var res1 = JSON.parse(response);					
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value='"+data.resource_code+"'>"+data.resource_code+"</option>";
			});  
			$('#cmbLinkUrl').html("");   
			$('#cmbLinkUrl').append(options);
			$('#cmbLinkUrl').html(options)
			.selectpicker('refresh');   		
		},
		error:function()
		{
			toastr.error('We are unable to process please contact support');	
		}
	});

}
function bind_role()
{
	$.ajax({
		url:base_url+"ajax_controller/select_role",
		type:"post",
		data:'',
		success:function(response)
		{  
			var options = "<option value=''>Select</option>";					
			var res1 = JSON.parse(response);					
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value='"+data.role_code+"'>"+data.role_name+"</option>";
			});
			$('#cmbRole').html("");   
			$('#cmbRole').append(options);
			$('#cmbRoleFilter').html("");   
			$('#cmbRoleFilter').append(options);
			$('#cmbRole').html(options)
			.selectpicker('refresh');		
		},
		error:function()
		{
			toastr.error('We are unable to process please contact support');	
		}
	});
	$.ajax({
		url:base_url+"ajax_controller/select_role",
		mType:"get",
		data:{type:"SELECT_EMPLOYEE_ROLE",_s:$("#hidSession").val()},
		success:function(response)
		{  
			var options = "<option value=''>Select</option>";					
			var res1 = JSON.parse(response);					
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value='"+data.role_code+"'>"+data.role_name+"</option>";
			});
			$('#cmbEmployeeRole').html("");   
			$('#cmbEmployeeRole').append(options);
			$('#cmbEmployeeRole').html(options)
			.selectpicker('refresh');		
		},
		error:function()
		{
			toastr.error('We are unable to process please contact support');	
		}
	});
}
function show_datatable(institute_code)// to show datatable
{	
	var data = {
		institute_code:institute_code
	};
	var dtblManageUsers = $('#dtblManageUsers').dataTable({
		//"sAjaxSource": "manage_user_db.php?_s="+session+"&type=SELECT_USER&institute_code="+institute_code,
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth":false,    
        "bDestroy":true,
		"ajax":
		{
			"url": base_url+"/ajax_controller/select_user",
			"type": "POST",
			"data": data
		},
		 "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 groupbutton' >>><'col-xs-6'p>>",  
	   
        "aoColumns": [    
           	{ "sName": "sl_no","sWidth": "5%"},
	        { "sName": "employee_name","sWidth": "10%"},
	        { "sName": "user_name","sWidth": "30%"},
	        { "sName": "role","sWidth": "10%"},
	        { "sName": "image_file_name","sWidth":"15%","sClass":"alignCenter",
			 	"mRender":function(data, type, full) {
			 		if(data == 'default.png')
			 			return "<a href='"+base_url+"public/assets/images/loginimages/"+data+"?v='+Math.random()+'' class='html5lightbox' data-width='200' data-height='200' ><img src='"+base_url+"public/assets/images/loginimages/"+data+"' style='width:40px;height:50px'/></a>";
			 		else	
	    				return "<a href='"+data+"' class='html5lightbox' data-width='200' data-height='200' ><img src='"+data+"?v='+Math.random()+'' style='width:40px;height:50px'/></a>";
	    		}
		 	},
	        { "sName": "record_status","sClass":"alignCenter","sWidth": "15%",
           		"mRender": function(data, type, full) {
           			if(data == 1)
	                	return '<img src="'+base_url+'public/assets/images/ACTIVE.png" />';
	                else
	                	return '<img src="'+base_url+'public/assets/images/INACTIVE.png" />';
	            }  
	        },
	        { "sName": "Action", "data":null, "sWidth": "5%","sClass":"alignCenter","sDefaultContent":  "<button type = 'button' id='btnEdit' class='btn btn-info tooltipTable' onclick='edit_user(event);' title='Edit'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;<button id='btnResetPwd' class='btn btn-danger tooltipTable' onclick='reset_pwd(event);' title='Reset Password'><i class='fa fa-undo'></i></button>"}
  	    ], 
		"fnDrawCallback": function(oSettings, json) {
			jQuery(".html5lightbox").html5lightbox();  
			$('.tooltipTable').tooltipster({
			    theme: 'tooltipster-punk',
				animation: 'grow',
			    delay: 200, 
			    touchDevices: false,
			    trigger: 'hover'
			});	          
		}                    
	});
	$("div.groupbutton").html('<button type="button" id="btnAdd" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	//$("div.groupbutton").html('<div class="btngroup"><button id="btnAddState" class="btn btn-primary "><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	$('#btnAdd').click(function(){
		if($("#cmbInstitute").val() == '')
		{
			toastr.error("Select the Institute Name");
		}
		else
		{	
		
			$('#usermanageformid').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal
			$('#txtEmployeeName').val("");
			$('#cmbRoleUser').selectpicker('val',"");
			//$('#cmbRole').val("");
			$('#txtUserName').attr('readonly', false);
			$('#cmbStatus').val("");
			$('#userImageUpload').val("");
			$('#hidUserCode').val("");
			$('#userAddModal').modal('show');
			$('#imageDisplayareaUser').attr('src', '');
			document.getElementById("signMessageUser").innerHTML="";
			var institute = $('#cmbInstitute').val();
			show_datatable($('#cmbInstitute').val());
			$("#hidInstituteCode").val(institute);
			$('#userAddModal').on('shown.bs.modal', function()
			{  
				$('#txtEmployeeName').focus();// Focusing the textbox
			})
		}	
	});
	
}
//Edit User
function edit_user(event)
{
	//alert("adhuaf");
	
	document.getElementById("signMessageUser").innerHTML="";
	$('#usermanageformid').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal
	var oTable = $('#dtblManageUsers').dataTable();						
	$(oTable.fnSettings().aoData).each(function (){
		$(this.nTr).removeClass('success');
	});
	var row;
	if($("#cmbInstitute").val() == '')
		{
			toastr.error("Select the Institute Name");
		}
	else{
		if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	  		row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
	  		row = event.target.parentNode.parentNode.parentNode; 
		$(row).addClass('success');
		var user_code = oTable.fnGetData( row )['user_name'];
		var role = oTable.fnGetData( row )['role']
		//alert(user_code);
		var institute = $('#cmbInstitute').val();
		//show_datatable($('#cmbInstitute').val());
		$("#hidInstituteCode").val(institute);
		$('#hidUserCode').val(user_code);
		$('#txtEmployeeName').val(oTable.fnGetData( row )['employee_name']);
		$('#txtUserName').val(oTable.fnGetData( row )['user_name']);
		$('#cmbRoleUser').selectpicker('val', role);
		$('#cmbStatus').val(oTable.fnGetData( row )['record_status']);
		$('#txtUserName').attr('readonly', true);
		$("#myModalLabel2").html("Update User");
		$('#userAddModal').modal('show');
		var image = oTable.fnGetData( row )['image_file_name'];
		if(image == 'default.png')
		{
			image = base_url+"public/assets/images/loginimages/"+image;
		}
		
		//alert(User_image);
		$('#imageDisplayareaUser').attr('src', image);
		$("#imageDisplayareaUser").attr('height','100');
		$("#imageDisplayareaUser").attr('width','100');
		/*var image = institutedetailstable.fnGetData( event.target.parentNode )['image_url'];
	    var image_logo = institutedetailstable.fnGetData( event.target.parentNode )['logo_url'];
		var institute_image = base_url+"public/assets/images/"+image;
		var institute_logo = base_url+"public/assets/images/logo/"+image_logo;
		
			//alert(signature);
			$('#imageDisplayareaEdit').attr('src', institute_image);
			$("#imageDisplayareaEdit").attr('height','100');
			$("#imageDisplayareaEdit").attr('width','200');*/
	}
	
}
/*function edit_user(event)
{
	//alert("adhuaf");
	var oTable = $('#dtblManageUsers').dataTable();						
	$(oTable.fnSettings().aoData).each(function (){
		$(this.nTr).removeClass('success');
	});
	var row;
	if($("#cmbInstitute").val() == '')
		{
			toastr.error("Select the Institute Name");
		}
	else{
		if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	  		row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
	  		row = event.target.parentNode.parentNode.parentNode; 
		$(row).addClass('success');
		var user_code = oTable.fnGetData( row )['user_code'];
		var role = oTable.fnGetData( row )['role']
		//alert(user_code);
		$('#hidUserCode').val(user_code);
		$('#txtEmployeeName').val(oTable.fnGetData( row )['employee_name']);
		$('#txtUserName').val(oTable.fnGetData( row )['user_name']);
		$('#cmbRoleUser').selectpicker('val', role);
		$('#cmbStatus').val(oTable.fnGetData( row )['record_status']);
		$("#myModalLabel").html("Update Record");
		$('#userAddModal').modal('show');
	}
	
}*/
//Reset Password
function reset_pwd(event)
{
	var oTable = $('#dtblManageUsers').dataTable();						
	$(oTable.fnSettings().aoData).each(function (){
		$(this.nTr).removeClass('success');
	});
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	  row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	  row = event.target.parentNode.parentNode.parentNode; 
	$(row).addClass('success');
	var user_code = oTable.fnGetData( row )['user_code'];//alert(user_code);return;
	swal({
		title: "Do you really want to reset password?",
		text: "You will not be able to recover!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, reset it!",
		cancelButtonText: "No, cancel!",
		closeOnConfirm: false,
		closeOnCancel: true
	},
	function(isConfirm){
		if (isConfirm){
			$.ajax({	
				url:base_url+"ajax_controller/reset_password",
				type:"post",
				data:{
					user_code:user_code
				},
				success:function(response){ 
					var res1 = JSON.parse(response);
					if(res1.status == true)
					{
						swal("Password Reset!", "Password has been reset successfully to 'password'.", "success");
					}
					else
					{
						sweetAlert("Password Reset!", res1.msg, "error");	
					}
				},
				error:function(){
					alert("We are unable to Process.Please contact Support");
				}
			});
		}
	});
}
function menuRow(event,action)
{
    $('#frmMenu').data('bootstrapValidator').resetForm(true);
	//$(instituteAdminTable.fnSettings().aoData).each(function ()
	var oTable = $('#dtblMenu').dataTable();		
	var dtblMenuTable = $('#dtblMenu').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});		
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	var record_id = oTable.fnGetData( row )['sl_no'];
	//alert(record_id);
	$(row).addClass('success');
    var parentid = oTable.fnGetData( row )['parent_id'];//GETTING DATA FOR HIDDEN COLUMN
	var menuid = oTable.fnGetData( row )['menu_id'];
	//var linkurl = oTable.fnGetData( row )['link_url'];
	var access_type = oTable.fnGetData( row )[10];
	$(row).addClass('success');
	var selectedTextRole = row.cells[1].innerHTML;
	$("#cmbRoles option").each(function () {
		if ($(this).html() == selectedTextRole) {
			$(this).attr("selected", "selected");
			return;
		}
	});
	$('#txtLinkText').val(row.cells[1].innerHTML.replace('&amp;','&'));
	//alert(row.cells[3].innerHTML);
    //$('#cmbLinkUrl').val(row.cells[2].innerHTML);
	$('select[name=cmbLinkUrl]').val(row.cells[2].innerHTML.replace('&amp;','&'));
	$('.selectpicker').selectpicker('refresh');
	//$('#cmbLinkUrl').val(linkurl);
   	$('#cmbParent').val(parentid);
   	//$('#cmbParent').selectpicker('refresh').selectpicker('val',parentid);
    $('#txtMenuSl').val(row.cells[4].innerHTML);
    $("#myModalLabel1").html("Update Menu");
	$("#btnSaveMenu").html("<i class='fa fa-save'></i>  Update");
	$('#hidOperTypeMenu').val("edit_menu");
    var selectedTextHasChild = row.cells[5].innerHTML;
    if(selectedTextHasChild == 'Yes')
    {
		$('#chkHasChild').iCheck('check');
    }
    else
    {
    	$('#chkHasChild').iCheck('uncheck');
    }
    var selectedTextIsLastChild = row.cells[6].innerHTML;
    if(selectedTextIsLastChild == "Yes")
    {
		$('#chkIsLastChild').iCheck('check');
    }
    else
    {
    	$('#chkIsLastChild').iCheck('uncheck');
    }
    $('#txtIconClass').val(row.cells[7].innerHTML);
    $('#hidMenuId').val(menuid);
	if(action == 'edit')
	{
		$('#modalMenu').modal('show');
	}	
	else
	{
		swal({
		  title: "Are you sure?",
		  text: "you want to Delete the Menu!",
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
		  	deleteMaster();
		    swal("Deleted", "Menu has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Menu is safe ", "error");
		  }
		});
        function deleteMaster(){
			var institutedata=
			{
				menuid:$('#hidMenuId').val(),
				
			};
			//alert($('#hidMenuId').val());	
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/delete_menudata",
				type:"post",
				data:institutedata,
				success:function(response)
				{  	
					var menudata={
						cmbRole:$('#cmbRole').val(),
					};
				   //ajax call to server
					$.ajax({
						url:base_url+"ajax_controller/select_menu",
						type:"POST",
						data:menudata,
						success:function(response)
						{  
							data = jQuery.parseJSON(response);
							dtblMenuTable.fnClearTable();
							if (data.aaData.length)
							dtblMenuTable.fnAddData(data.aaData);
							dtblMenuTable.fnDraw();	
						},
						error:function(){
							//toastr.error('Unable to Process Please Contact Support');
						}
					});
			
					
								
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});	
		}
	}	
	
}

function userRow(event,action)
{
	//$(instituteAdminTable.fnSettings().aoData).each(function ()
	var oTable = $('#dtblStudent').dataTable();		
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
	//alert(record_id);
	$('#frmUsersetup').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal
	$(row).addClass('success');
   
	var student_name = oTable.fnGetData( row )[2];
	var user_name = oTable.fnGetData( row )[3];
	var user_code = oTable.fnGetData( row )[1];
	var status = oTable.fnGetData( row )[4];
	$(row).addClass('success');
	//$('#txtLinkText').val(user_code);
	$('#txtStudentName').html(student_name);
    $('#txtUserName').html(user_name);
    $('#lblModalUserSetup').html("UPDATE");
	
	$('#cmbRecordStatus').val(status);
	
   	
   // var selectedTextHasChild = row.cells[6].innerHTML;
    $('#hidEmpId').val(user_code);
	if(action == 'edit')
	{
		$('#UserSetupModal').modal('show');
    	$('#myModalLabel2').html("Update User");
	}	
	else
	{
		swal({
		  title: "Are you sure?",
		  text: "you want to Reset the password!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, reset it!",
		  cancelButtonText: "No, cancel",
		  closeOnConfirm: false,
		  closeOnCancel: true
		},
		function(isConfirm){
		  if (isConfirm) {
		  	resetPassword();
		    swal("Reset", "Password has been reset successfully.", "success");
		  } else {
			    swal("Cancelled", "Old Password is not reset ", "error");
		  }
		});
        function resetPassword(){
			var institutedata=
			{
				hidEmpId:$('#hidEmpId').val(),
				type:"RESET_PASSWORD",
				_s:$("#hidSession").val()
			};		
			//ajax call to server
			$.ajax({
				url:"manage_user_db.php",
				mType:"post",
				data:institutedata,
				success:function(response)
				{  	
					var menudata={
							ins:$('#cmbStudentInsFilter').val(),
							type:"SELECT_STUDENTS",
							_s:$("#hidSession").val()
						};
				   //ajax call to server
					$.ajax({
						url:"manage_user_db.php",
						mType:"get",
						data:menudata,
						success:function(response)
						{  
							data = jQuery.parseJSON(response);
							var dtblStudentTable = $('#dtblStudent').dataTable();
							dtblStudentTable.fnClearTable();
							if (data.aaData.length)
							dtblStudentTable.fnAddData(data.aaData);
							dtblStudentTable.fnDraw();	
						},
						error:function(){
							//toastr.error('Unable to Process Please Contact Support');
						}
					});
					toastr.success('Password Successfully Reset');							
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});	
		}
	}	
	
}




