$(document).ready(function()
{
	var base_adm_url = $("#hidBaseAsmUrl").val(); 
	var isDelete= false;
	var isEdit = false;
	var oTable;
	//********************************* FOR INSTITUTE TAB ********************************************//
	var institutedetailstable = $('#institutedetails').dataTable({
		//"responsive": true,
		"processing": false, //Feature control the processing indicator.
		"serverSide": false, //Feature control DataTables' server-side processing mode.
		"destroy": true,
		"paging":   true,
		"info":     true,
		"autoWidth": false,
		"scrollX":true,
		"responsive":false,
		"searching":true,
		// Load data for the table's content from an ajax source
        "ajax":
		{
			"url": base_url+"/ajax_controller/select_institute_setup_data",
			"type": "POST"
		},      
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutebutton' >>><'col-xs-6'p>>",
	    "aoColumns": [    
			
			{ "sName": "sl_no","sWidth": "7%" },
			{ "sName": "institute_name","sWidth": "30%","mRender": function( data, type, full ) {
				var institute_url = data.split('`');
				return '<a target="_blank" href="'+institute_url[1]+'" style="color:blue;" >'+institute_url[0]+'</a>';
			}	                   	
			},
			{ "sName": "institute_code","sWidth": "10%"},
			{ "sName": "institute_type","sWidth": "10%"},
			{ "sName": "institute_email","bVisible":false},
			{ "sName": "website_address","bVisible":false},
			{ "sName": "contact_number","sWidth": "10%"},
			
			{ "sName": "record_status","bVisible":false },
			{ "sName": "logo","sWidth": "10%","sClass":"alignCenter",
				"mRender": function( data, type, full ) {
			        return '<img src="'+base_url+'public/assets/images/'+ data +'.png?v='+Math.random()+'" ></img>';
			    }  },
			{ "sName": "logo_url", "sClass":"alignCenter",
			   	"mRender": function( data, type, full ) {
			        return '<img src="'+base_url+'public/assets/images/logo/'+ data +'" style="width:40px;height:40px"></img>';
			    } },
			{ "sName": "location","sWidth": "10%"},
			{ "sName": "type","bVisible":false},
			{ "sName": "admin_name","bVisible":false},
			{ "sName": "admin_user_name","bVisible":false},
			{ "sName": "institute_address","bVisible":false},
			{ "sName": "image_url","bVisible":false}
        ]          
	});
	//<button class="btn btn-info custombtn" id="institutemanagedeletebtn"><i class="fa fa-times"></i> Delete</button>
	$("div.institutebutton").html('<div class="btngroup"><button id="institutemanageaddbtn" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>&nbsp;<button class="btn btn-success" id="institutemanageeditbtn"><i class="fa fa-edit"></i> Edit</button></div>');
	$('#institutemanageaddbtn').click(function()
	{
		$('#instmanageformid').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal
		$('#institutename').val("");
		$('#institutecode').val("");
		$('#txtinstituteType').val("");
		$('#txtWebaddress').val("");
		$('#txtContactNo').val("");
		$('#txtLocation').val("");
		$('#txtSessionCode').val("");	
		
		//document.getElementById('imageDisplayarea').removeAttribute('src');
		$('#periodname').val("");
		$('#fromdate').val("");
		$('#todate').val("");
		$("#fileInstituteImage").val("");
		$('#fileinstitutelogo').val("");
		$('#imageDisplayarea').attr('src', '');
		$('#imageDisplayareaLogo').attr('src', '');
		document.getElementById("signMessagelogo").innerHTML="";
		document.getElementById("signMessage").innerHTML="";
		$('#instituteaddModal').modal('show');
		$('#instituteaddModal').on('shown.bs.modal', function()
		{  
			$('#institutename').focus();// Focusing the textbox
		})
		//$("#instmanageformid")[0].reset();	
	});
	$('#institutemanageeditbtn').click(function()
	{
		if(isEdit)
		{
			//$('#instmanageeditformid').data('bootstrapValidator').resetForm(true);//reseting the tick marks before opening edit modal
			$('#instituteeditmodal').modal('show');
		}
		else
		{
			toastr.error('Please Select a Record');
		}	
	});
	$('#institutemanageloginbtn').click(function()
	{
		if(isEdit)
		{
			$('#institutemanageloginbtn').attr('target', '_blank');
			$(this).attr("href", "../redirection.php?institute_code="+$('#instituteeditcode').val()+"&user_name="+$('#instituteadminusernameEdit').val()+"&_os=<?=$MY_SESSION_NAME?>");
			
		}
		else
		{
			toastr.error('Please Select a Record');
		}	
	});
	$('#institutemanagedeletebtn').click(function()
	{
		if(isDelete)
		{
			$('#institutedeletemodal').modal('show');
		}
		else
		{
			toastr.error('Please Select a Record');
		}	
	});
	$('#institutemanagesettingbtn').click(function()
	{
		if(isEdit)
		{
			$('#institutesettingmodal').modal('show');
		}
		else
		{
			toastr.error('Please Select a Record');
		}	
	});
	// to select data when edit button is click
	$('#institutedetails tbody').on('click', function (event)
	{	
		isEdit = true;	
		isDelete = true;			
		$(institutedetailstable.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		//alert(event.target.tagName);
		if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
	  		row = event.target.parentNode.parentNode.parentNode; 
	  	else
	  		row = event.target.parentNode;
		$(row).addClass('success');
		$("#fileInstituteImageEdit").val("");
		$('#instmanageeditformid').data('bootstrapValidator').resetForm(true);
		$('#instituteeditname').val(institutedetailstable.fnGetData( event.target.parentNode )['institute_name']);
	    $('#instituteeditcode').val(institutedetailstable.fnGetData( event.target.parentNode )['institute_code']);
	    $('#txtinstituteTypeEdit').val(institutedetailstable.fnGetData( event.target.parentNode )['institute_type']);
	    $('#txtinstituteEmailEdit').val(institutedetailstable.fnGetData( event.target.parentNode )['institute_email']);
		$('#fileinstitutelogoEdit').val("");
		document.getElementById("signMessageEditlogo").innerHTML="";
		document.getElementById("signMessageEdit").innerHTML="";
		$('#txtWebaddressEdit').val(institutedetailstable.fnGetData( event.target.parentNode )['website_address']);
	    $('#txtContactNoEdit').val(institutedetailstable.fnGetData( event.target.parentNode )['contact_number']);
	    $('#txtLocationEdit').val(institutedetailstable.fnGetData( event.target.parentNode )['location']);
	    $('#cmbRecordStatusEdit').val(institutedetailstable.fnGetData( event.target.parentNode )['record']);
	    $('#cmbInsTypeEdit').val(institutedetailstable.fnGetData( event.target.parentNode )['type']);
	    $('#instituteeditAddress').val(institutedetailstable.fnGetData( event.target.parentNode )['institute_address']);
	    $('#instituteadmindisplaynameEdit').val(institutedetailstable.fnGetData( event.target.parentNode )['admin_name']);
	    $('#instituteadminusernameEdit').val(institutedetailstable.fnGetData( event.target.parentNode )['admin_user_name']);
	    var image = institutedetailstable.fnGetData( event.target.parentNode )['image_url'];
	    var image_logo = institutedetailstable.fnGetData( event.target.parentNode )['logo_url'];
		var institute_image = base_url+"public/assets/images/"+image+"?v="+Math.random();
		var institute_logo = base_url+"public/assets/images/logo/"+image_logo+"?v="+Math.random();
		
			//alert(signature);
			$('#imageDisplayareaEdit').attr('src', institute_image);
			$("#imageDisplayareaEdit").attr('height','100');
			$("#imageDisplayareaEdit").attr('width','200');
			$('#imageDisplayareaEditLogo').attr('src', institute_logo);
			$("#imageDisplayareaEditLogo").attr('height','100');
			$("#imageDisplayareaEditLogo").attr('width','100');
		//$('#hidinstmanageid').val(event.target.parentNode.cells[2].innerHTML)
	    /*$('#hidSelInstCode').val(event.target.parentNode.cells[2].innerHTML);
	   var instituteid = hris_departmenttable.fnGetData( event.target.parentNode )[12];//GETTING DATA FOR HIDDEN COLUMN
		$('#hidinstmanageid').val(instituteid);//GETTING VALUE FOR HIDDEN COLUMN*/
	});
	//ADD RECORD WITH VALIDATION	
	$('#instmanageformid').bootstrapValidator({
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
			if($("#fileinstitutelogo").val() != '')
			{
				var fileUpload = $("#fileinstitutelogo")[0];
				//Initiate the FileReader object.
				var reader = new FileReader();
				//Read the contents of Image File.
				reader.readAsDataURL(fileUpload.files[0]);
				reader.onload = function (e) {
				//Initiate the JavaScript Image object.
				var image = new Image();
				//Set the Base64 string return from FileReader as source.
				image.src = e.target.result;
					image.onload = function () {
					//Determine the Height and Width.
						var height = this.height;
						var width = this.width;

						if (height > 60 || width > 60) 
						{
							toastr.error("Logo dimension should be less than or equal to 60 X 60");
							$("#institutemanageaddsave").removeAttr('disabled');
							$("#spanProcessinginstitute").hide();
						}
						else
						{
							$("#spanProcessinginstitute").show();
							var formData = new FormData(document.getElementById("instmanageformid"));
							//ajax call to server
							$.ajax({
								url:base_url+"ajax_controller/operation_institute_add", 
								type:"post",
								enctype: 'multipart/form-data',
								data:formData,
								cache: false,
						        contentType: false,
						        processData: false,
								success:function(response)
								{  
									$("#spanProcessingInstitute").hide();
									try
										{
											var obj = jQuery.parseJSON(response);
											if(obj.status == true)
											{
												toastr.success(obj.msg);
												$('#instmanageformid').data('bootstrapValidator').resetForm(true);
												var dtblInstitute = $("#institutedetails").DataTable();
								 				dtblInstitute.ajax.reload();
								 				var dtblApplicationMode = $("#dtblApplicationMode").DataTable();
								 				dtblApplicationMode.ajax.reload();
								 				var dtblPaymentMode = $("#dtblPaymentMode").DataTable();
								 				dtblPaymentMode.ajax.reload();
								 				var dtblExamCenterSetup = $("#dtblExamCenterSetup").DataTable();
								 				dtblExamCenterSetup.ajax.reload();
								 				$.ajax({
													url:base_url+"ajax_controller/select_institute_center",
													mType:"post",
													data:'',
												
													//data:{center1:center},
													success:function(response)
													{  
														var options = "";				
														var res1 = JSON.parse(response);
														var dataProviderForMultiSelect = [];
														
														$.each(res1.aaData,function(i,data){
														//alert('ok');		
															options = options + "<option value='"+data.institute_code+"'>"+data.institute_name+"</option>";	
															//dataProviderForMultiSelect.push({label: data.center_name, value: data.center_code});	
														});			 //classname from studentmanage
														$('#cmbInstituteforExamAdd').html("");  
														$('#cmbInstituteforExamAdd').append(options)
														//$("#txtCenterTypeCpdeD").multiselect('dataprovider', dataProviderForMultiSelect);
														$('#cmbInstituteforExamAdd').multiselect({
													        enableFiltering: true,
													        includeSelectAllOption:true,
															enableCaseInsensitiveFiltering:true,
															numberDisplayed: 1,
															buttonWidth:"265px",
															maxHeight: 250
													 	});	
														$("#cmbInstituteforExamAdd").multiselect('refresh');	
													},
													error:function()
													{
														toastr.error('Unable to process please contact support');
													}
												});
									    		var role =  $('#cmbMenuRole').val();
												$('#errorlogInstitute').html('');
												$('#errorlogInstitute').show();
												$('#txtLocation').val('');
												$('#fileinstitutelogo').val('');
												$('#txtAddress').val('');
												$('#fileInstituteImage').val('');
												$('#imageDisplayarea').attr('src', '');
												$('#imageDisplayareaLogo').attr('src', '');
									    		
											}
											else if(obj.status === 'validationerror'){
							                	$('#errorlogInstitute').html(obj.msg);
							                	$('#errorlogInstitute').show();
							                }
											else if(obj.status === 'xsserror'){
							                	$('#errorlogInstitute').html(obj.msg);
							                	$('#errorlogInstitute').show();
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
									toastr.error('We are unable to process please contact support');	
								}
							});
						}
						
					};
				}
			}
			else
			{
				$("#spanProcessinginstitute").show();
				var formData = new FormData(document.getElementById("instmanageformid"));
				//ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/operation_institute_add", 
					type:"post",
					enctype: 'multipart/form-data',
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response)
					{  
						$("#spanProcessingInstitute").hide();
						try
							{
								var obj = jQuery.parseJSON(response);
								if(obj.status == true)
								{
									toastr.success(obj.msg);
									$('#instmanageformid').data('bootstrapValidator').resetForm(true);
									var dtblInstitute = $("#institutedetails").DataTable();
					 				dtblInstitute.ajax.reload();
					 				var dtblApplicationMode = $("#dtblApplicationMode").DataTable();
					 				dtblApplicationMode.ajax.reload();
					 				var dtblPaymentMode = $("#dtblPaymentMode").DataTable();
					 				dtblPaymentMode.ajax.reload();
					 				var dtblExamCenterSetup = $("#dtblExamCenterSetup").DataTable();
					 				dtblExamCenterSetup.ajax.reload();
						    		var role =  $('#cmbMenuRole').val();
									$('#errorlogInstitute').html('');
									$('#errorlogInstitute').show();
						    		
								}
								else if(obj.status === 'validationerror'){
				                	$('#errorlogInstitute').html(obj.msg);
				                	$('#errorlogInstitute').show();
				                }
								else if(obj.status === 'xsserror'){
				                	$('#errorlogInstitute').html(obj.msg);
				                	$('#errorlogInstitute').show();
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
						toastr.error('We are unable to process please contact support');	
					}
				});
			}
		},
    	//live: 'enabled',
        fields:
         {
            institutename: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'The Institute name is required and cannot be empty'
                    }
                }
            },
            institutecode: {
                validators: {
                    notEmpty: {
                        message: 'The Institute code is required and cannot be empty'
                    },
                    regexp: {
								regexp: /^([A-Za-z\s]+)$/i,
								message: "Special characters and numbers are not allowed"
					},
                    stringLength: {
								max: 6,
								message: 'Code not more then 6 character'
					}
                }
            },
           txtinstituteType:{
                validators: {
                    notEmpty: {
                        message: 'Institute Type is required and cannot be empty'
                    }
                }
            },
            txtWebaddress:{
                validators: {
                    notEmpty: {
                        message: 'Website Address is required and cannot be empty'
                    },
                    uri: {
						message: 'The input is not a valid URL'
					}
                }
            },
            txtContactNo: {
                validators: {
                    notEmpty: {
                        message: 'Contact No is required and cannot be empty'
                    },
                    digits: {
							message: 'The value can contain only digits'
						},
					stringLength: {
						min: 10,
						max: 10,
						message: 'Contact no should be of 10 digits'
					}
                }
            },
            txtSessionCode: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([0-9-\s]+)$/i,
						message: "Special characters and letters are not allowed"
					},
					stringLength: {
						max: 7,
						message: 'Code not more then 7 digits'
						}
				}
			},
			periodname: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			fromdate: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			todate: {
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
			instituteadmindisplayname: {
                validators: {
                    notEmpty: {
                        message: 'Admin name is required and cannot be empty'
                    }
                }
            },
			instituteadminusername: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
						regexp: /^([a-zA-Z0-9-\s]+)$/i,
						message: "Special characters are not allowed"
					},
					stringLength: {
						max: 8,
						message: 'UserName Shouldnot be more than 8 character'
					}
				}
			}
		}	
	});	
	//EDIT RECORD WITH VALIDATION
	$('#instmanageeditformid').bootstrapValidator({
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
			
			/*var institutedata=
			{
				insteditname:$('#instituteeditname').val(),
				insteditcode:$('#instituteeditcode').val(),
				insttypeedit:$('#txtinstituteTypeEdit').val(),
				instwebaddessedit:$('#txtWebaddressEdit').val(),
				instcontactedit:$('#txtContactNoEdit').val(),
				instlocationedit:$('#txtLocationEdit').val(),
				type:3
			};	*/
			if($("#imageDisplayareaEditLogo").val() != '')
			{
				var fileUpload = $("#imageDisplayareaEditLogo")[0];
				//Initiate the FileReader object.
				var reader = new FileReader();
				//Read the contents of Image File.
				reader.readAsDataURL(fileUpload.files[0]);
				reader.onload = function (e) {
				//Initiate the JavaScript Image object.
				var image = new Image();
				//Set the Base64 string return from FileReader as source.
				image.src = e.target.result;
					image.onload = function () {
					//Determine the Height and Width.
						var height = this.height;
						var width = this.width;

						if (height > 150 || width > 150) 
						{
							toastr.error("Logo dimension should be less than or equal to 150 X 150");
							$("#institutemanageeditsave").html('<i class="fa fa-save"></i> Save');
							$("#institutemanageeditsave").removeAttr('disabled');
							
							$("#spanProcessingInstituteEdit").hide();
						}
						else
						{
							$("#spanProcessingInstituteEdit").show();
							var formData = new FormData(document.getElementById("instmanageeditformid"));
							//ajax call to server
							$.ajax({
								url:base_url+"ajax_controller/operation_institute_edit", 
								type:"post",
								enctype: 'multipart/form-data',
								data:formData,
								cache: false,
						        contentType: false,
						        processData: false,
								success:function(response)
								{  
									$("#spanProcessingInstitute").hide();
									try
										{
											var obj = jQuery.parseJSON(response);
											if(obj.status == true)
											{
												$("#spanProcessingInstituteEdit").hide();
												toastr.success(obj.msg);
												
									    		var role =  $('#cmbMenuRole').val();
												$('#errorlogInstitute').html('');
												$('#errorlogInstitute').show();
												$('#instituteeditmodal').modal('hide');
												$('#instmanageeditformid').data('bootstrapValidator').resetForm(true);
												/*if(first_time_load)
												{
													setTimeout($("#institutedetails").DataTable();
													dtblInstitute.ajax.reload();, 1000);
													first_time_load = false;
												}*/
												var dtblInstitute = $("#institutedetails").DataTable();
								 				dtblInstitute.ajax.reload();
								 				var dtblApplicationMode = $("#dtblApplicationMode").DataTable();
								 				dtblApplicationMode.ajax.reload();
								 				var dtblPaymentMode = $("#dtblPaymentMode").DataTable();
								 				dtblPaymentMode.ajax.reload();
								 				var dtblExamCenterSetup = $("#dtblExamCenterSetup").DataTable();
								 				dtblExamCenterSetup.ajax.reload();
									    		
											}
											else if(obj.status === 'validationerror'){
							                	$('#errorlogInstituteEdit').html(obj.msg);
							                	$('#errorlogInstituteEdit').show();
							                }
											else if(obj.status === 'xsserror'){
							                	$('#errorlogInstituteEdit').html(obj.msg);
							                	$('#errorlogInstituteEdit').show();
							                }
											else 
											{
												sweetAlert("INSTITUTE",obj.msg, "error");	
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
					};
				}
			}
			else
			{
				$("#spanProcessingInstituteEdit").show();
				var formData = new FormData(document.getElementById("instmanageeditformid"));
				//ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/operation_institute_edit", 
					type:"post",
					enctype: 'multipart/form-data',
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response)
					{  
						$("#spanProcessingInstitute").hide();
						try
							{
								var obj = jQuery.parseJSON(response);
								if(obj.status == true)
								{
									$("#spanProcessingInstituteEdit").hide();
									toastr.success(obj.msg);
									$('#instmanageeditformid').data('bootstrapValidator').resetForm(true);
									var dtblInstitute = $("#institutedetails").DataTable();
					 				dtblInstitute.ajax.reload();
					 				var dtblApplicationMode = $("#dtblApplicationMode").DataTable();
					 				dtblApplicationMode.ajax.reload();
					 				var dtblPaymentMode = $("#dtblPaymentMode").DataTable();
					 				dtblPaymentMode.ajax.reload();
					 				var dtblExamCenterSetup = $("#dtblExamCenterSetup").DataTable();
					 				dtblExamCenterSetup.ajax.reload();
						    		var role =  $('#cmbMenuRole').val();
									$('#errorlogInstitute').html('');
									$('#errorlogInstitute').show();
									$('#instituteeditmodal').modal('hide');
						    		
								}
								else if(obj.status === 'validationerror'){
				                	$('#errorlogInstituteEdit').html(obj.msg);
				                	$('#errorlogInstituteEdit').show();
				                }
								else if(obj.status === 'xsserror'){
				                	$('#errorlogInstituteEdit').html(obj.msg);
				                	$('#errorlogInstituteEdit').show();
				                }
								else 
								{
									sweetAlert("INSTITUTE",obj.msg, "error");	
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
		},
    	//live: 'enabled',
        fields:
        {
            insteditname: {
                validators: {
                    notEmpty: {
                        message: 'The Institute name is required and cannot be empty'
                    }
                }
            },
            insteditcode: {
                validators: {
                    notEmpty: {
                        message: 'The Institute code is required and cannot be empty'
                    },
                    regexp: {
								regexp: /^([A-Za-z\s]+)$/i,
								message: "Special characters and numbers are not allowed"
							},
                    stringLength: {
								max: 6,
								message: 'Code not more then 6 digits'
								}
                }
            },
            txtinstituteTypeEdit: {
                validators: {
                    notEmpty: {
                        message: 'Institute Type is required and cannot be empty'
                    }
                }
            },
            instituteadmindisplaynameEdit: {
                validators: {
                    notEmpty: {
                        message: 'Admin name is required and cannot be empty'
                    }
                }
            },
            instituteadminusernameEdit: {
                validators: {
                    notEmpty: {
                        message: 'Admin User Name is required and cannot be empty'
                    },
                    regexp: {
								regexp: /^([A-Za-z0-9\s]+)$/i,
								message: "Special characters  are not allowed"
					},
					stringLength: {
						max: 8,
						message: 'UseraName Should not be more than 8 character'
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
            txtWebaddressEdit: {
                validators: {
                    notEmpty: {
                        message: 'Website Address is required and cannot be empty'
                    },
                    uri: {
						message: 'The input is not a valid URL'
					}
                }
            },
            txtContactNoEdit: {
                validators: {
                    notEmpty: {
                        message: 'Contact No is required and cannot be empty'
                    },
                    digits: {
							message: 'The value can contain only digits'
						},
					stringLength: {
						min: 10,
						max: 10,
						message: 'Contact no must be 10 characters'
					}
                }
            }
		}
	});

	// Delete Record Save	
	$('#institutemanagedeleterec').click(function(){
	$('#institutedeletemodal').modal('hide');		
	var institutedata=
	{
		instdeleteid:$('#instituteeditcode').val(),
		type:"DELETE_INSTITUTE"
	};
	//ajax call to server
	$.ajax({
			url:"institute_setup_db.php?_s="+MY_SESSION_NAME,
			mType:"post",
			data:institutedata,
			success:function()
			{  
				institutedetailstable.fnClearTable();// REFRESH THE DATATABLE 
						$.ajax({
							url:"institute_setup_db.php?type=SELECT_INSTITUTE",
							success:function(data)
							{ 
								/*data=jQuery.parseJSON(data);
								 institutedetailstable.fnAddData(data.aaData,true);*/
								 //institutedetailstable.fnDraw();
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
	// CHECKING DUPLICATION OF INSTITUTE CODE 
	$('#institutecode').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				institutecode:$(event.target).val(),
				validateinstitutecode:true,
				type:"CHKDUCPLICATE_INSTITUTE"
			};
		   //ajax call to server
			$.ajax({
				url:"institute_setup_db.php?_s="+MY_SESSION_NAME,
				mType:"get",
				data:institutedata,
				success:function(response)
				{
					
					if(response!="")
					{
					 	$(event.target).val("");
					 	$('#instmanageformid').data('bootstrapValidator').updateStatus('institutecode', 'INVALID', null);
						toastr.error('Code Already Used');
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
	// CHECKING DUPLICATION OF INSTITUTE CODE FOR EDIT
	$('#instituteeditcode').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				instituteeditcode:$(event.target).val(),
				validateinstitutecode:true,
				type:"CHKEDITDUCPLICATE_INSTITUTE"
			};
		   //ajax call to server
			$.ajax({
				url:"institute_setup_db.php?_s="+MY_SESSION_NAME,
				mType:"get",
				data:institutedata,
				success:function(response)
				{
					if(response!="")
					{
					 	$(event.target).val("");
					 	$('#instmanageeditformid').data('bootstrapValidator').updateStatus('instituteeditcode', 'INVALID', null);
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
	$('#fileinstitutelogo').change(function()			
	{ 
		
		var file = document.getElementById("fileinstitutelogo").files[0];
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
			
			  document.getElementById("signMessagelogo").innerHTML="";
			  $("#imageDisplayareaLogo").attr('height','0');
			  $("#imageDisplayareaLogo").attr('width','0');
			  $('#institutemanageaddsave').prop('disabled', false);
			  readURLSigLogo(this);
			   
			  
			}
			else
			{
				//alert("File size exceeds 1 MB.");
				document.getElementById("signMessagelogo").innerHTML="Error : File size exceeds 400 KB";
				$('#fileinstitutelogo').val("");
				$('#imageDisplayareaLogo').attr('src','');
				$("#imageDisplayareaLogo").attr('height','0');
				$("#imageDisplayareaLogo").attr('width','0');
			}
        }
		else
		{
			//alert("hello");
            //alert("Invalid File Format");
			document.getElementById("signMessagelogo").innerHTML="Error : Invalid File Format";
			$('#fileControllerSignature').val("");
			$('#imageDisplayareaLogo').attr('src','');
			$("#imageDisplayareaLogo").attr('height','0');
			$("#imageDisplayareaLogo").attr('width','0');
		}
		/*var file = document.getElementById("fileinstitutelogo").files[0];
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
			
			  document.getElementById("signMessagelogo").innerHTML="";
			  
			  //readURLSig(this);
			  
			}
			else
			{
				//alert("File size exceeds 1 MB.");
				document.getElementById("signMessagelogo").innerHTML="Error : File size exceeds 100 KB";
				$('#fileinstitutelogo').val("");
				
			}
        }
		else
		{
            //alert("Invalid File Format");
			document.getElementById("signMessagelogo").innerHTML="Error : Invalid File Format";
			$('#fileControllerSignature').val("");
			
		}*/
		
	});
	$('#fileinstitutelogoEdit').change(function()			
	 { 
		var file = document.getElementById("fileinstitutelogoEdit").files[0];
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
			
			  document.getElementById("signMessageEditlogo").innerHTML="";
			  $("#imageDisplayareaEditLogo").attr('height','0');
			  $("#imageDisplayareaEditLogo").attr('width','0');
			   $('#institutemanageeditsave').prop('disabled', false);
			  readURLSigLogoEdit(this);
			  
			}
			else
			{
				//alert("File size exceeds 1 MB.");
				document.getElementById("signMessageEditlogo").innerHTML="Error : File size exceeds 400 KB";
				$('#fileinstitutelogoEdit').val("");
				
			}
        }
		else
		{
            //alert("Invalid File Format");
			document.getElementById("signMessageEditlogo").innerHTML="Error : Invalid File Format";
			$('#fileControllerSignature').val("");
			
			
		}
		
	});
	$('#fileInstituteImage').change(function()			
	{ 
		var file = document.getElementById("fileInstituteImage").files[0];
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
			
			  document.getElementById("signMessage").innerHTML="";
			  $("#imageDisplayarea").attr('height','0');
			  $("#imageDisplayarea").attr('width','0');
			  $('#institutemanageaddsave').prop('disabled', false);
			  readURLSig(this);
			  
			}
			else
			{
				//alert("File size exceeds 1 MB.");
				document.getElementById("signMessage").innerHTML="Error : File size exceeds 400 KB";
				$('#fileInstituteImage').val("");
				$('#imageDisplayarea').attr('src','');
				$("#imageDisplayarea").attr('height','0');
				$("#imageDisplayarea").attr('width','0');
			}
        }
		else
		{
            //alert("Invalid File Format");
			document.getElementById("signMessage").innerHTML="Error : Invalid File Format";
			$('#fileControllerSignature').val("");
			$('#imageDisplayarea').attr('src','');
			$("#imageDisplayarea").attr('height','0');
			$("#imageDisplayarea").attr('width','0');
		}
		
	});
	$('#fileInstituteImageEdit').change(function()			
	{ 
		var file = document.getElementById("fileInstituteImageEdit").files[0];
		var sFileName = file.name;
        var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
        var iFileSize = file.size;
        //var iConvert = (file.size / 1048576).toFixed(2);
        if (sFileExtension == "jpg" || sFileExtension == "jpeg" || sFileExtension == "png" )
		{ 
			if(iFileSize <= 409600)
			{
			
			  document.getElementById("signMessageEdit").innerHTML="";
			  readURLSigEdit(this);
			  
			}
			else
			{
				//alert("File size exceeds 1 MB.");
				document.getElementById("signMessageEdit").innerHTML="Error : File size exceeds 400 KB";
				$('#fileInstituteImageEdit').val("");
				$('#imageDisplayareaEdit').attr('src','');
				$("#imageDisplayareaEdit").attr('height','0');
				$("#imageDisplayareaEdit").attr('width','0');
			}
        }
		else
		{
            //alert("Invalid File Format");
			document.getElementById("signMessageEdit").innerHTML="Error : Invalid File Format";
			$('#fileControllerSignatureEdit').val("");
			$('#signatureDisplayareaEdit').attr('src','');
			$("#signatureDisplayareaEdit").attr('height','0');
			$("#signatureDisplayareaEdit").attr('width','0');
		}
		
	});
	function readURLSigEdit(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#imageDisplayareaEdit').attr('src', e.target.result);
				$("#imageDisplayareaEdit").attr('height','100');
				$("#imageDisplayareaEdit").attr('width','200');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
	function readURLSig(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#imageDisplayarea').attr('src', e.target.result);
				$("#imageDisplayarea").attr('height','100');
				$("#imageDisplayarea").attr('width','200');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURLSigLogo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#imageDisplayareaLogo').attr('src', e.target.result);
				$("#imageDisplayareaLogo").attr('height','100');
				$("#imageDisplayareaLogo").attr('width','100');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURLSigLogoEdit(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#imageDisplayareaEditLogo').attr('src', e.target.result);
				$("#imageDisplayareaEditLogo").attr('height','100');
				$("#imageDisplayareaEditLogo").attr('width','100');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    //*********************************************************************************************************
    //********************************* FOR INSTITUTE IMAGE SETUP TAB ********************************************//
    var instituteimagesetuptable = $('#dtblInstituteImageSetup').dataTable({
    	"ajax":
		{
			"url": base_url+"/ajax_controller/select_institute_image_setup_data",
			"type": "POST"
		}, 
		"bPaginate": false,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bDestroy" : true,
        "bAutoWidth": true,
		"sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
		
	    "aoColumns": [    
			
			{ "sName": "sl_no","sWidth": "10%" },
			/*{ "sName": "institute_name","sWidth": "30%","mRender": function( data, type, full ) {
				var institute_url = data.split('`');
				return '<a target="_blank" href="'+institute_url[1]+'" style="color:blue;" >'+institute_url[0]+'</a>';
			}*/	                   	
			
			{ "sName": "institute_code","sWidth": "10%"},
			{ "sName": "institute_name","sWidth": "15%"},
			/*{ "sName": "website_address","bVisible":false},
			{ "sName": "contact_number","sWidth": "10%"},*/
			
			
			/*{ "sName": "logo","sWidth": "10%","sClass":"alignCenter",
				"mRender": function( data, type, full ) {
			        return '<img src="'+base_url+'public/assets/images/'+ data +'.png" ></img>';
			    }  },*/
			{ "sName": "slider_1", "sClass":"alignCenter","sWidth": "15%",
			   	"mRender": function( data, type, full ) {
			        return '<img src="'+base_adm_url+'/institute/'+ data +'" style="width:40px;height:40px"></img>';
			    } },
			{ "sName": "slider_2", "sClass":"alignCenter","sWidth": "15%",
			   	"mRender": function( data, type, full ) {
			        return '<img src="'+base_adm_url+'/institute/'+ data +'" style="width:40px;height:40px"></img>';
			    } },
			{ "sName": "slider_3", "sClass":"alignCenter","sWidth": "15%",
			   	"mRender": function( data, type, full ) {
			        return '<img src="'+base_adm_url+'/institute/'+ data +'" style="width:40px;height:40px"></img>';
			    } },
			{"sName": "default","sWidth": "10%", "sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='imageSetupRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>\
			            <button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='imageSetupRow(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}    
			
        ]          
	});
	$('#institutimageaddsave').click(function()
	{
		$('#instituteimageaddModal').modal('hide');
		var dtblImageInstitute = $("#dtblInstituteImageSetup").DataTable();
		dtblInstitute.ajax.reload();
	});
	$('#instituteimageeditsave').click(function()
	{
		$('#instituteimageeditmodal').modal('hide');
		var dtblImageInstitute = $("#dtblInstituteImageSetup").DataTable();
		dtblInstitute.ajax.reload();
	});
	
	$('#assignNewImageToInstitutebtn').click(function()
	{
		//$('#instimageaddformid').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal
		$('#cmbInstituteNameAdd').val("");
		$("#fileInstituteImage1").val('');
		$('#imageDisplayarea1').attr('src', '');
		$("#fileInstituteImage2").val('');
		$('#imageDisplayarea2').attr('src', '');
		$("#fileInstituteImage3").val('');
		$("#errorlogImageInstitute").html('');
		$('#imageDisplayarea3').attr('src', '');
		
		$('#instituteimageaddModal').modal('show');
		$('#instituteimageaddModal').on('shown.bs.modal', function()
		{  
			$('#institutename').focus();// Focusing the textbox
		})	
	});
	/*$('#assignNewImageToInstitutebtn').click(function()
	{
		editModalForExamcentersetup(event);
	});*/
	//***************FOR DISPLAYING IMAGE IN DISPLAY AREA FOR ADDING IMAGE IN SLIDE 1****************************
	$('#fileInstituteImage1').change(function()			
	 { 
		var file = document.getElementById("fileInstituteImage1").files[0];
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
			
			  document.getElementById("signMessage1").innerHTML="";
			  $("#imageDisplayarea1").attr('height','0');
			  $("#imageDisplayarea1").attr('width','0');
			  readURLSig1(this);
			  
			}
			else
			{
				//alert("File size exceeds 1 MB.");
				document.getElementById("signMessage1").innerHTML="Error : File size exceeds 400 KB";
				$('#fileInstituteImage1').val("");
				$('#imageDisplayarea1').attr('src','');
				$("#imageDisplayarea1").attr('height','0');
				$("#imageDisplayarea1").attr('width','0');
			}
        }
		else
		{
            //alert("Invalid File Format");
			document.getElementById("signMessage1").innerHTML="Error : Invalid File Format";
			$('#fileControllerSignature').val("");
			$('#imageDisplayarea1').attr('src','');
			$("#imageDisplayarea1").attr('height','0');
			$("#imageDisplayarea1").attr('width','0');
		}
		
	});
	function readURLSig1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#imageDisplayarea1').attr('src', e.target.result);
				$("#imageDisplayarea1").attr('height','100');
				$("#imageDisplayarea1").attr('width','200');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    //********************FOR SLIDE 2 IMAGE************************************
    $('#fileInstituteImage2').change(function()			
	 { 
		var file = document.getElementById("fileInstituteImage2").files[0];
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
			
			  document.getElementById("signMessage2").innerHTML="";
			  $("#imageDisplayarea2").attr('height','0');
			  $("#imageDisplayarea2").attr('width','0');
			  readURLSig2(this);
			  
			}
			else
			{
				//alert("File size exceeds 1 MB.");
				document.getElementById("signMessage2").innerHTML="Error : File size exceeds 400 KB";
				$('#fileInstituteImage2').val("");
				$('#imageDisplayarea2').attr('src','');
				$("#imageDisplayarea2").attr('height','0');
				$("#imageDisplayarea2").attr('width','0');
			}
        }
		else
		{
            //alert("Invalid File Format");
			document.getElementById("signMessage2").innerHTML="Error : Invalid File Format";
			$('#fileControllerSignature').val("");
			$('#imageDisplayarea2').attr('src','');
			$("#imageDisplayarea2").attr('height','0');
			$("#imageDisplayarea2").attr('width','0');
		}
		
	});
	function readURLSig2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#imageDisplayarea2').attr('src', e.target.result);
				$("#imageDisplayarea2").attr('height','100');
				$("#imageDisplayarea2").attr('width','200');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    //*****************************FOR SLIDE 3 IMAGE 3******************************
    $('#fileInstituteImage3').change(function()			
	 { 
		var file = document.getElementById("fileInstituteImage3").files[0];
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
			
			  document.getElementById("signMessage3").innerHTML="";
			  $("#imageDisplayarea3").attr('height','0');
			  $("#imageDisplayarea3").attr('width','0');
			  readURLSig3(this);
			  
			}
			else
			{
				//alert("File size exceeds 1 MB.");
				document.getElementById("signMessage3").innerHTML="Error : File size exceeds 400 KB";
				$('#fileInstituteImage3').val("");
				$('#imageDisplayarea3').attr('src','');
				$("#imageDisplayarea3").attr('height','0');
				$("#imageDisplayarea3").attr('width','0');
			}
        }
		else
		{
            //alert("Invalid File Format");
			document.getElementById("signMessage3").innerHTML="Error : Invalid File Format";
			$('#fileControllerSignature').val("");
			$('#imageDisplayarea3').attr('src','');
			$("#imageDisplayarea3").attr('height','0');
			$("#imageDisplayarea3").attr('width','0');
		}
		
	});
	function readURLSig3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#imageDisplayarea3').attr('src', e.target.result);
				$("#imageDisplayarea3").attr('height','100');
				$("#imageDisplayarea3").attr('width','200');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    
	//***************FOR DISPLAYING IMAGE IN DISPLAY AREA FOR UPDATING/EDITING IMAGE IN SLIDE 1****************************
	$('#fileInstituteImageEdit1').change(function()			
	 { 
		var file = document.getElementById("fileInstituteImageEdit1").files[0];
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
			
			  document.getElementById("signMessageEdit1").innerHTML="";
			  $("#imageDisplayareaEdit1").attr('height','0');
			  $("#imageDisplayareaEdit1").attr('width','0');
			  readURLEditSig1(this);
			  
			}
			else
			{
				//alert("File size exceeds 1 MB.");
				document.getElementById("signMessageEdit1").innerHTML="Error : File size exceeds 400 KB";
				$('#fileInstituteImageEdit1').val("");
				$('#imageDisplayareaEdit1').attr('src','');
				$("#imageDisplayareaEdit1").attr('height','0');
				$("#imageDisplayareaEdit1").attr('width','0');
			}
        }
		else
		{
            //alert("Invalid File Format");
			document.getElementById("signMessageEdit1").innerHTML="Error : Invalid File Format";
			$('#fileControllerSignature').val("");
			$('#imageDisplayareaEdit1').attr('src','');
			$("#imageDisplayareaEdit1").attr('height','0');
			$("#imageDisplayareaEdit1").attr('width','0');
		}
		
	});
	function readURLEditSig1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#imageDisplayareaEdit1').attr('src', e.target.result);
				$("#imageDisplayareaEdit1").attr('height','100');
				$("#imageDisplayareaEdit1").attr('width','200');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    
    $('#fileInstituteImageEdit2').change(function()			
	 { 
		var file = document.getElementById("fileInstituteImageEdit2").files[0];
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
			
			  document.getElementById("signMessageEdit2").innerHTML="";
			  $("#imageDisplayareaEdit2").attr('height','0');
			  $("#imageDisplayareaEdit2").attr('width','0');
			  readURLEditSig2(this);
			  
			}
			else
			{
				//alert("File size exceeds 1 MB.");
				document.getElementById("signMessageEdit2").innerHTML="Error : File size exceeds 400 KB";
				$('#fileInstituteImageEdit2').val("");
				$('#imageDisplayareaEdit2').attr('src','');
				$("#imageDisplayareaEdit2").attr('height','0');
				$("#imageDisplayareaEdit2").attr('width','0');
			}
        }
		else
		{
            //alert("Invalid File Format");
			document.getElementById("signMessageEdit2").innerHTML="Error : Invalid File Format";
			$('#fileControllerSignature').val("");
			$('#imageDisplayareaEdit2').attr('src','');
			$("#imageDisplayareaEdit2").attr('height','0');
			$("#imageDisplayareaEdit2").attr('width','0');
		}
		
	});
	function readURLEditSig2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#imageDisplayareaEdit2').attr('src', e.target.result);
				$("#imageDisplayareaEdit2").attr('height','100');
				$("#imageDisplayareaEdit2").attr('width','200');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    
    $('#fileInstituteImageEdit3').change(function()			
	 { 
		var file = document.getElementById("fileInstituteImageEdit3").files[0];
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
			
			  document.getElementById("signMessageEdit3").innerHTML="";
			  $("#imageDisplayareaEdit3").attr('height','0');
			  $("#imageDisplayareaEdit3").attr('width','0');
			  readURLEditSig3(this);
			  
			}
			else
			{
				//alert("File size exceeds 1 MB.");
				document.getElementById("signMessageEdit3").innerHTML="Error : File size exceeds 400 KB";
				$('#fileInstituteImageEdit3').val("");
				$('#imageDisplayareaEdit3').attr('src','');
				$("#imageDisplayareaEdit3").attr('height','0');
				$("#imageDisplayareaEdit3").attr('width','0');
			}
        }
		else
		{
            //alert("Invalid File Format");
			document.getElementById("signMessageEdit3").innerHTML="Error : Invalid File Format";
			$('#fileControllerSignature').val("");
			$('#imageDisplayareaEdit3').attr('src','');
			$("#imageDisplayareaEdit3").attr('height','0');
			$("#imageDisplayareaEdit3").attr('width','0');
		}
		
	});
	function readURLEditSig3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#imageDisplayareaEdit3').attr('src', e.target.result);
				$("#imageDisplayareaEdit3").attr('height','100');
				$("#imageDisplayareaEdit3").attr('width','200');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
	
	//*********************************************BOOTSTRAP VALIDATION FOR IMAGE ADDING FORM*******************************************************************
	//ADD IMAGE RECORD WITH VALIDATION	
	$('#instimageaddformid').bootstrapValidator({
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
			//***************FOR SLIDE IMAGE 1*********************************
			if($("#fileInstituteImage1").val() != '')
			{
				var fileUpload = $("#fileInstituteImage1")[0];
				//Initiate the FileReader object.
				var reader = new FileReader();
				//Read the contents of Image File.
				reader.readAsDataURL(fileUpload.files[0]);
				reader.onload = function (e) 
				{
				//Initiate the JavaScript Image object.
					var image = new Image();
					//Set the Base64 string return from FileReader as source.
					image.src = e.target.result;
					image.onload = function () 
					{
					//Determine the Height and Width.
						var height = this.height;
						var width = this.width;

						if (height > 381 || width > 508) 
						{
							toastr.error("lOGO dimension should be less than or equal to 60 X 60");
							$("#institutimageaddsave").removeAttr('disabled');
							$("#spanProcessinginstitute").hide();
						}
						else
						{
							$("#spanProcessinginstitute").show();
							var formData = new FormData(document.getElementById("instimageaddformid"));
							//ajax call to server
							$.ajax({
								url:base_url+"ajax_controller/operation_image_to_slide_add", 
								type:"post",
								enctype: 'multipart/form-data',
								data:formData,
								cache: false,
						        contentType: false,
						        processData: false,
								success:function(response)
								{  
									$("#spanProcessingInstitute").hide();
									try
										{
											var obj = jQuery.parseJSON(response);
											if(obj.status == true)
											{
												toastr.success(obj.msg);
												$('#instimageaddformid').data('bootstrapValidator').resetForm(true);
												var dtblInstitute = $("#dtblInstituteImageSetup").DataTable();
								 				dtblInstitute.ajax.reload();
									    		var role =  $('#cmbMenuRole').val();
												$('#errorlogImageInstitute').html('');
												$('#errorlogImageInstitute').show();
									    		
											}
											else if(obj.status === 'validationerror'){
							                	$('#errorlogImageInstitute').html(obj.msg);
							                	$('#errorlogImageInstitute').show();
							                }
											else if(obj.status === 'xsserror'){
							                	$('#errorlogImageInstitute').html(obj.msg);
							                	$('#errorlogImageInstitute').show();
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
									toastr.error('We are unable to process please contact support');	
								}
							});
						}
					};
				}		
			}
			/*else
			{
				$("#spanProcessinginstitute").show();
				var formData = new FormData(document.getElementById("instimageaddformid"));
				//ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/operation_image_to_slide_add", 
					type:"post",
					enctype: 'multipart/form-data',
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response)
					{  
						$("#spanProcessingInstitute").hide();
						try
							{
								var obj = jQuery.parseJSON(response);
								if(obj.status == true)
								{
									toastr.success(obj.msg);
									$('#instimageaddformid').data('bootstrapValidator').resetForm(true);
									var dtblInstitute = $("#dtblInstituteImageSetup").DataTable();
					 				dtblInstitute.ajax.reload();
						    		var role =  $('#cmbMenuRole').val();
									$('#errorlogImageInstitute').html('');
									$('#errorlogImageInstitute').show();
						    		
								}
								else if(obj.status === 'validationerror'){
				                	$('#errorlogImageInstitute').html(obj.msg);
				                	$('#errorlogImageInstitute').show();
				                }
								else if(obj.status === 'xsserror'){
				                	$('#errorlogImageInstitute').html(obj.msg);
				                	$('#errorlogImageInstitute').show();
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
						toastr.error('We are unable to process please contact support');	
					}
				});
			}*/	
			//************************FOR SLIDE IMAGE 2*************************************		
			else if($("#fileInstituteImage2").val() != '')
			{
				var fileUpload = $("#fileInstituteImage2")[0];
				//Initiate the FileReader object.
				var reader = new FileReader();
				//Read the contents of Image File.
				reader.readAsDataURL(fileUpload.files[0]);
				reader.onload = function (e) 
				{
				//Initiate the JavaScript Image object.
					var image = new Image();
					//Set the Base64 string return from FileReader as source.
					image.src = e.target.result;
					image.onload = function () 
					{
					//Determine the Height and Width.
						var height = this.height;
						var width = this.width;

						if (height > 381 || width > 508) 
						{
							toastr.error("lOGO dimension should be less than or equal to 60 X 60");
							$("#institutimageaddsave").removeAttr('disabled');
							$("#spanProcessinginstitute").hide();
						}
						else
						{
							$("#spanProcessinginstitute").show();
							var formData = new FormData(document.getElementById("instimageaddformid"));
							//ajax call to server
							$.ajax({
								url:base_url+"ajax_controller/operation_image_to_slide_add", 
								type:"post",
								enctype: 'multipart/form-data',
								data:formData,
								cache: false,
						        contentType: false,
						        processData: false,
								success:function(response)
								{  
									$("#spanProcessingInstitute").hide();
									try
										{
											var obj = jQuery.parseJSON(response);
											if(obj.status == true)
											{
												toastr.success(obj.msg);
												$('#instimageaddformid').data('bootstrapValidator').resetForm(true);
												var dtblInstitute = $("#dtblInstituteImageSetup").DataTable();
								 				dtblInstitute.ajax.reload();
									    		var role =  $('#cmbMenuRole').val();
												$('#errorlogImageInstitute').html('');
												$('#errorlogImageInstitute').show();
									    		
											}
											else if(obj.status === 'validationerror'){
							                	$('#errorlogImageInstitute').html(obj.msg);
							                	$('#errorlogImageInstitute').show();
							                }
											else if(obj.status === 'xsserror'){
							                	$('#errorlogImageInstitute').html(obj.msg);
							                	$('#errorlogImageInstitute').show();
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
									toastr.error('We are unable to process please contact support');	
								}
							});
						}
					};
				}		
			}
			/*else
			{
				$("#spanProcessinginstitute").show();
				var formData = new FormData(document.getElementById("instimageaddformid"));
				//ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/operation_image_to_slide_add", 
					type:"post",
					enctype: 'multipart/form-data',
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response)
					{  
						$("#spanProcessingInstitute").hide();
						try
							{
								var obj = jQuery.parseJSON(response);
								if(obj.status == true)
								{
									toastr.success(obj.msg);
									$('#instimageaddformid').data('bootstrapValidator').resetForm(true);
									var dtblInstitute = $("#dtblInstituteImageSetup").DataTable();
					 				dtblInstitute.ajax.reload();
						    		var role =  $('#cmbMenuRole').val();
									$('#errorlogImageInstitute').html('');
									$('#errorlogImageInstitute').show();
						    		
								}
								else if(obj.status === 'validationerror'){
				                	$('#errorlogImageInstitute').html(obj.msg);
				                	$('#errorlogImageInstitute').show();
				                }
								else if(obj.status === 'xsserror'){
				                	$('#errorlogImageInstitute').html(obj.msg);
				                	$('#errorlogImageInstitute').show();
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
						toastr.error('We are unable to process please contact support');	
					}
				});
			}*/	
			//**************************FOR SLIDE IMAGE 3************************************************
			else if($("#fileInstituteImage3").val() != '')
			{
				var fileUpload = $("#fileInstituteImage3")[0];
				//Initiate the FileReader object.
				var reader = new FileReader();
				//Read the contents of Image File.
				reader.readAsDataURL(fileUpload.files[0]);
				reader.onload = function (e) 
				{
				//Initiate the JavaScript Image object.
					var image = new Image();
					//Set the Base64 string return from FileReader as source.
					image.src = e.target.result;
					image.onload = function () 
					{
					//Determine the Height and Width.
						var height = this.height;
						var width = this.width;

						if (height > 381 || width > 508) 
						{
							toastr.error("lOGO dimension should be less than or equal to 60 X 60");
							$("#institutimageaddsave").removeAttr('disabled');
							$("#spanProcessinginstitute").hide();
						}
						else
						{
							$("#spanProcessinginstitute").show();
							var formData = new FormData(document.getElementById("instimageaddformid"));
							//ajax call to server
							$.ajax({
								url:base_url+"ajax_controller/operation_image_to_slide_add", 
								type:"post",
								enctype: 'multipart/form-data',
								data:formData,
								cache: false,
						        contentType: false,
						        processData: false,
								success:function(response)
								{  
									$("#spanProcessingInstitute").hide();
									try
										{
											var obj = jQuery.parseJSON(response);
											if(obj.status == true)
											{
												toastr.success(obj.msg);
												$('#instimageaddformid').data('bootstrapValidator').resetForm(true);
												var dtblInstitute = $("#dtblInstituteImageSetup").DataTable();
								 				dtblInstitute.ajax.reload();
									    		var role =  $('#cmbMenuRole').val();
												$('#errorlogImageInstitute').html('');
												$('#errorlogImageInstitute').show();
									    		
											}
											else if(obj.status === 'validationerror'){
							                	$('#errorlogImageInstitute').html(obj.msg);
							                	$('#errorlogImageInstitute').show();
							                }
											else if(obj.status === 'xsserror'){
							                	$('#errorlogImageInstitute').html(obj.msg);
							                	$('#errorlogImageInstitute').show();
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
									toastr.error('We are unable to process please contact support');	
								}
							});
						}
					};
				}		
			}
			else
			{
				$("#spanProcessinginstitute").show();
				var formData = new FormData(document.getElementById("instimageaddformid"));
				//ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/operation_image_to_slide_add", 
					type:"post",
					enctype: 'multipart/form-data',
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response)
					{  
						$("#spanProcessingInstitute").hide();
						try
							{
								var obj = jQuery.parseJSON(response);
								if(obj.status == true)
								{
									toastr.success(obj.msg);
									$('#instimageaddformid').data('bootstrapValidator').resetForm(true);
									var dtblInstitute = $("#dtblInstituteImageSetup").DataTable();
					 				dtblInstitute.ajax.reload();
						    		var role =  $('#cmbMenuRole').val();
									$('#errorlogImageInstitute').html('');
									$('#errorlogImageInstitute').show();
						    		
								}
								else if(obj.status === 'validationerror'){
				                	$('#errorlogImageInstitute').html(obj.msg);
				                	$('#errorlogImageInstitute').show();
				                }
								else if(obj.status === 'xsserror'){
				                	$('#errorlogImageInstitute').html(obj.msg);
				                	$('#errorlogImageInstitute').show();
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
						toastr.error('We are unable to process please contact support');	
					}
				});
			}
			
			/*$("#spanProcessinginstitute").show();
			var formData = new FormData(document.getElementById("instimageaddformid"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_image_to_slide_add", 
				type:"post",
				enctype: 'multipart/form-data',
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response)
				{  
					$("#spanProcessingInstitute").hide();
					try
						{
							var obj = jQuery.parseJSON(response);
							if(obj.status == true)
							{
								toastr.success(obj.msg);
								$('#instimageaddformid').data('bootstrapValidator').resetForm(true);
								var dtblInstitute = $("#dtblInstituteImageSetup").DataTable();
				 				dtblInstitute.ajax.reload();
					    		var role =  $('#cmbMenuRole').val();
								$('#errorlogImageInstitute').html('');
								$('#errorlogImageInstitute').show();
					    		
							}
							else if(obj.status === 'validationerror'){
			                	$('#errorlogImageInstitute').html(obj.msg);
			                	$('#errorlogImageInstitute').show();
			                }
							else if(obj.status === 'xsserror'){
			                	$('#errorlogImageInstitute').html(obj.msg);
			                	$('#errorlogImageInstitute').show();
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
					toastr.error('We are unable to process please contact support');	
				}
			});*/
		},
    	//live: 'enabled',
        fields:
         {
            
			cmbInstituteNameAdd: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}	
	});	
	
	
	//*******************************EDIT IMAGE TO INSTITUTES WITH VALIDATION********************************
	$('#instimageeditformid').bootstrapValidator({
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
			if($("#fileInstituteImageEdit1").val() != '')
			{
				var fileUpload = $("#fileInstituteImageEdit1")[0];
				//Initiate the FileReader object.
				var reader = new FileReader();
				//Read the contents of Image File.
				reader.readAsDataURL(fileUpload.files[0]);
				reader.onload = function (e) {
				//Initiate the JavaScript Image object.
				var image = new Image();
				//Set the Base64 string return from FileReader as source.
				image.src = e.target.result;
					image.onload = function () {
					//Determine the Height and Width.
						var height = this.height;
						var width = this.width;

						if (height > 381 || width > 508) 
						{
							toastr.error("lOGO dimension should be less than or equal to 60 X 60");
							$("#instituteimageeditsave").html('<i class="fa fa-save"></i> Save');
							$("#instituteimageeditsave").removeAttr('disabled');
							
							$("#spanProcessingInstituteEdit").hide();
						}
						else
						{
							$("#spanProcessinginstitute").show();
							var formData = new FormData(document.getElementById("instimageeditformid"));
							//ajax call to server
							$.ajax({
								url:base_url+"ajax_controller/operation_image_to_slide_edit", 
								type:"post",
								enctype: 'multipart/form-data',
								data:formData,
								cache: false,
						        contentType: false,
						        processData: false,
								success:function(response)
								{  
									$("#spanProcessingInstitute").hide();
									try
										{
											var obj = jQuery.parseJSON(response);
											if(obj.status == true)
											{
												toastr.success(obj.msg);
												$('#instimageeditformid').data('bootstrapValidator').resetForm(true);
												var dtblInstitute = $("#dtblInstituteImageSetup").DataTable();
								 				dtblInstitute.ajax.reload();
									    		var role =  $('#cmbMenuRole').val();
												$('#errorlogImageInstitute').html('');
												$('#errorlogImageInstitute').show();
									    		
											}
											else if(obj.status === 'validationerror'){
							                	$('#errorlogImageInstitute').html(obj.msg);
							                	$('#errorlogImageInstitute').show();
							                }
											else if(obj.status === 'xsserror'){
							                	$('#errorlogImageInstitute').html(obj.msg);
							                	$('#errorlogImageInstitute').show();
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
									toastr.error('We are unable to process please contact support');	
								}
							});
						}
					};
				}
			}
			//****************************FOR SLIDE IMAGE EDIT 2**********************************************
			else if($("#fileInstituteImageEdit2").val() != '')
			{
				var fileUpload = $("#fileInstituteImageEdit2")[0];
				//Initiate the FileReader object.
				var reader = new FileReader();
				//Read the contents of Image File.
				reader.readAsDataURL(fileUpload.files[0]);
				reader.onload = function (e) {
				//Initiate the JavaScript Image object.
				var image = new Image();
				//Set the Base64 string return from FileReader as source.
				image.src = e.target.result;
					image.onload = function () {
					//Determine the Height and Width.
						var height = this.height;
						var width = this.width;

						if (height > 381 || width > 508) 
						{
							toastr.error("lOGO dimension should be less than or equal to 60 X 60");
							$("#instituteimageeditsave").html('<i class="fa fa-save"></i> Save');
							$("#instituteimageeditsave").removeAttr('disabled');
							
							$("#spanProcessingInstituteEdit").hide();
						}
						else
						{
							$("#spanProcessinginstitute").show();
							var formData = new FormData(document.getElementById("instimageeditformid"));
							//ajax call to server
							$.ajax({
								url:base_url+"ajax_controller/operation_image_to_slide_edit", 
								type:"post",
								enctype: 'multipart/form-data',
								data:formData,
								cache: false,
						        contentType: false,
						        processData: false,
								success:function(response)
								{  
									$("#spanProcessingInstitute").hide();
									try
										{
											var obj = jQuery.parseJSON(response);
											if(obj.status == true)
											{
												toastr.success(obj.msg);
												$('#instimageeditformid').data('bootstrapValidator').resetForm(true);
												var dtblInstitute = $("#dtblInstituteImageSetup").DataTable();
								 				dtblInstitute.ajax.reload();
									    		var role =  $('#cmbMenuRole').val();
												$('#errorlogImageInstitute').html('');
												$('#errorlogImageInstitute').show();
									    		
											}
											else if(obj.status === 'validationerror'){
							                	$('#errorlogImageInstitute').html(obj.msg);
							                	$('#errorlogImageInstitute').show();
							                }
											else if(obj.status === 'xsserror'){
							                	$('#errorlogImageInstitute').html(obj.msg);
							                	$('#errorlogImageInstitute').show();
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
									toastr.error('We are unable to process please contact support');	
								}
							});
						}
					};
				}
			}
			//*****************************FOR SLIDE IMAGE 3 EDIT*************************************
			else if($("#fileInstituteImageEdit3").val() != '')
			{
				var fileUpload = $("#fileInstituteImageEdit3")[0];
				//Initiate the FileReader object.
				var reader = new FileReader();
				//Read the contents of Image File.
				reader.readAsDataURL(fileUpload.files[0]);
				reader.onload = function (e) {
				//Initiate the JavaScript Image object.
				var image = new Image();
				//Set the Base64 string return from FileReader as source.
				image.src = e.target.result;
					image.onload = function () {
					//Determine the Height and Width.
						var height = this.height;
						var width = this.width;

						if (height > 381 || width > 508) 
						{
							toastr.error("lOGO dimension should be less than or equal to 60 X 60");
							$("#instituteimageeditsave").html('<i class="fa fa-save"></i> Save');
							$("#instituteimageeditsave").removeAttr('disabled');
							
							$("#spanProcessingInstituteEdit").hide();
						}
						else
						{
							$("#spanProcessinginstitute").show();
							var formData = new FormData(document.getElementById("instimageeditformid"));
							//ajax call to server
							$.ajax({
								url:base_url+"ajax_controller/operation_image_to_slide_edit", 
								type:"post",
								enctype: 'multipart/form-data',
								data:formData,
								cache: false,
						        contentType: false,
						        processData: false,
								success:function(response)
								{  
									$("#spanProcessingInstitute").hide();
									try
										{
											var obj = jQuery.parseJSON(response);
											if(obj.status == true)
											{
												toastr.success(obj.msg);
												$('#instimageeditformid').data('bootstrapValidator').resetForm(true);
												var dtblInstitute = $("#dtblInstituteImageSetup").DataTable();
								 				dtblInstitute.ajax.reload();
									    		var role =  $('#cmbMenuRole').val();
												$('#errorlogImageInstitute').html('');
												$('#errorlogImageInstitute').show();
									    		
											}
											else if(obj.status === 'validationerror'){
							                	$('#errorlogImageInstitute').html(obj.msg);
							                	$('#errorlogImageInstitute').show();
							                }
											else if(obj.status === 'xsserror'){
							                	$('#errorlogImageInstitute').html(obj.msg);
							                	$('#errorlogImageInstitute').show();
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
									toastr.error('We are unable to process please contact support');	
								}
							});
						}
					};
				}
			}
			else
			{
				$("#spanProcessinginstitute").show();
				var formData = new FormData(document.getElementById("instimageeditformid"));
				//ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/operation_image_to_slide_edit", 
					type:"post",
					enctype: 'multipart/form-data',
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response)
					{  
						$("#spanProcessingInstitute").hide();
						try
							{
								var obj = jQuery.parseJSON(response);
								if(obj.status == true)
								{
									toastr.success(obj.msg);
									$('#instimageeditformid').data('bootstrapValidator').resetForm(true);
									var dtblInstitute = $("#dtblInstituteImageSetup").DataTable();
					 				dtblInstitute.ajax.reload();
						    		var role =  $('#cmbMenuRole').val();
									$('#errorlogImageInstitute').html('');
									$('#errorlogImageInstitute').show();
						    		
								}
								else if(obj.status === 'validationerror'){
				                	$('#errorlogImageInstitute').html(obj.msg);
				                	$('#errorlogImageInstitute').show();
				                }
								else if(obj.status === 'xsserror'){
				                	$('#errorlogImageInstitute').html(obj.msg);
				                	$('#errorlogImageInstitute').show();
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
						toastr.error('We are unable to process please contact support');	
					}
				});
			}
			
			/*$("#spanProcessinginstitute").show();
			var formData = new FormData(document.getElementById("instimageeditformid"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_image_to_slide_edit", 
				type:"post",
				enctype: 'multipart/form-data',
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response)
				{  
					$("#spanProcessingInstitute").hide();
					try
						{
							var obj = jQuery.parseJSON(response);
							if(obj.status == true)
							{
								toastr.success(obj.msg);
								$('#instimageeditformid').data('bootstrapValidator').resetForm(true);
								var dtblInstitute = $("#dtblInstituteImageSetup").DataTable();
				 				dtblInstitute.ajax.reload();
					    		var role =  $('#cmbMenuRole').val();
								$('#errorlogImageInstitute').html('');
								$('#errorlogImageInstitute').show();
					    		
							}
							else if(obj.status === 'validationerror'){
			                	$('#errorlogImageInstitute').html(obj.msg);
			                	$('#errorlogImageInstitute').show();
			                }
							else if(obj.status === 'xsserror'){
			                	$('#errorlogImageInstitute').html(obj.msg);
			                	$('#errorlogImageInstitute').show();
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
					toastr.error('We are unable to process please contact support');	
				}
			});*/
		},
    	//live: 'enabled',
        fields:
         {
            
			cmbInstituteImageNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}	
	});	
	
	//****************************************************************************************************************
	//****************************************************************************************************************
	//****************************************************************************************************************
	//****************************************************************************************************************
	
    //********************************* FOR INSTITUTE IMAGE SETUP TAB ENDS ********************************************//
    //********************************* FOR APPLICATION MODE TAB ********************************************//
    
    var applicationtable = $('#dtblApplicationMode').dataTable({
		//"responsive": true,
		//"responsive": true,
		"processing": true, //Feature control the processing indicator.
		"serverSide": true, //Feature control DataTables' server-side processing mode.
		"destroy": true,
		"paging":   true,
		"info":     true,
		"autoWidth": true,
		"responsive":false,
		"searching":true,
		// Load data for the table's content from an ajax source
        "ajax":
		{
			"url": base_url+"/ajax_controller/get_datatable_data/get_institute_application_mode",
			"type": "POST",
			"data": ''
		},       
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 applicationbutton' >>><'col-xs-6'p>>",
	    "aoColumns": [    
                       { "sName": "sl_no" },
                       { "sName": "institute_code","bVisible":false},
					   { "sName": "institute_name"},
                       { "sName": "online_mode","bVisible":false},
					   { "sName": "offline_mode","bVisible":false},
                       { "sName": "application_mode"},
              	     ]          
	});
	//<button class="btn btn-info custombtn" id="institutemanagedeletebtn"><i class="fa fa-times"></i> Delete</button>
	$("div.applicationbutton").html('<button class="btn btn-info custombtn" id="applicationeditbtn"><i class="fa fa-edit"></i> Edit</button></div>');
	$('#applicationeditbtn').click(function()
	{
		if(isEdit)
		{
			//$('#instmanageeditformid').data('bootstrapValidator').resetForm(true);//reseting the tick marks before opening edit modal
			$('#applicationeditmodal').modal('show');
			
		}
		else
		{
			toastr.error('Please Select a Record');
		}	
	});
// to select data when edit button is click
	$('#dtblApplicationMode tbody').on('click', function (event)
	 {	
		isEdit = true;			
		oTable = $('#dtblApplicationMode').dataTable();
		$(oTable.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
	  		row = event.target.parentNode.parentNode.parentNode; 
	  	else
	  		row = event.target.parentNode;
		$(row).addClass('success');
		hidInstituteCode = oTable.fnGetData( event.target.parentNode )[1];	
		$('#hidInstituteCode').val(hidInstituteCode);
	    var online_mode = oTable.fnGetData( event.target.parentNode )[3];
		var offline_mode = oTable.fnGetData( event.target.parentNode )[4];
	    if(online_mode == 1)
			$("#chkOnlineMode").prop("checked", true);
		else
			$("#chkOnlineMode").prop("checked", false);
		if(offline_mode == 1)
			$("#chkOfflineMode").prop("checked", true);
		else
			$("#chkOfflineMode").prop("checked", false);
		//alert(online_mode);
	    /*//$('#hidSelInstCode').val(event.target.parentNode.cells[2].innerHTML);
	   var instituteid = hris_departmenttable.fnGetData( event.target.parentNode )[12];//GETTING DATA FOR HIDDEN COLUMN
		$('#hidinstmanageid').val(instituteid);//GETTING VALUE FOR HIDDEN COLUMN*/
	});
//ADD RECORD WITH VALIDATION	
	
//EDIT RECORD WITH VALIDATION
	$('#frmApplicationModeEdit').bootstrapValidator({
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
			/*var institutedata=
			{
				insteditname:$('#instituteeditname').val(),
				insteditcode:$('#instituteeditcode').val(),
				insttypeedit:$('#txtinstituteTypeEdit').val(),
				instwebaddessedit:$('#txtWebaddressEdit').val(),
				instcontactedit:$('#txtContactNoEdit').val(),
				instlocationedit:$('#txtLocationEdit').val(),
				type:3
			};	*/
			var formData = new FormData(document.getElementById("frmApplicationModeEdit"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_application_mode",
				type:"post",
				enctype: 'multipart/form-data',
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
							$('#frmApplicationModeEdit').data('bootstrapValidator').resetForm(true);
							var dtblInstitute = $("#dtblApplicationMode").DataTable();
			 				dtblInstitute.ajax.reload();	
							$('#applicationeditmodal').modal('hide');	
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
					toastr.error('Unable to Process Please Contact Support');
				}
			});
		},
    	//live: 'enabled',
	});
	//******************************************* FOR PAYMENT MODE TAB ***********************************//
    
    var paymenttable = $('#dtblPaymentMode').dataTable({
		//"responsive": true,
		"processing": true, //Feature control the processing indicator.
		"serverSide": true, //Feature control DataTables' server-side processing mode.
		"destroy": true,
		"paging":   true,
		"info":     true,
		"autoWidth": true,
		"responsive":false,
		"searching":true,
		// Load data for the table's content from an ajax source
        "ajax":
		{
			"url": base_url+"/ajax_controller/get_datatable_data/get_institute_payment_mode",
			"type": "POST",
			"data": ''
		},  
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 paymentbutton' >>><'col-xs-6'p>>",
	    "aoColumns": [    
                       { "sName": "sl_no","sWidth": "5%" },
					   { "sName": "institute_code","bVisible":false},
                       { "sName": "institute_name","sWidth": "50%" },
					   { "sName": "payment_mode","bVisible":false},
					   { "sName": "payment_mode_name","sWidth": "40%"},
              	     ]          
	});
	//<button class="btn btn-info custombtn" id="institutemanagedeletebtn"><i class="fa fa-times"></i> Delete</button>
	$("div.paymentbutton").html('<button class="btn btn-info custombtn" id="paymenteditbtn"><i class="fa fa-edit"></i> Edit</button></div>');
	$('#paymenteditbtn').click(function()
	{
		if(isEdit)
		{
			//$('#instmanageeditformid').data('bootstrapValidator').resetForm(true);//reseting the tick marks before opening edit modal
			$('#paymenteditmodal').modal('show');
		}
		else
		{
			toastr.error('Please Select a Record');
		}	
	});
	
	
	$('#dtblPaymentMode tbody').on('click', function (event)
	 {	
		isEdit = true;			
		oTable = $('#dtblPaymentMode').dataTable();
		$(oTable.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
	  		row = event.target.parentNode.parentNode.parentNode; 
	  	else
	  		row = event.target.parentNode;
		$(row).addClass('success');
		hidPaymentCode = oTable.fnGetData( event.target.parentNode )[1];	
		$('#hidPaymentCode').val(hidPaymentCode);
	    var checked_vals = oTable.fnGetData( event.target.parentNode )[3];
		//alert(checked_vals);
		var divPaymentModes = document.getElementById("divPaymentModes");
		divPaymentModes.innerHTML = "";
		$.ajax({
			url:base_url+"ajax_controller/get_payment_mode", 
			type:"post",
			cache: false,
	        contentType: false,
	        processData: false,
			success:function(response)
			{  
				
				code = '';
				
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data){
					//alert("hello");
					var optionValue = data.code;
					//alert(optionValue);
					var checkbox = document.createElement("input");
					checkbox.type = "checkbox";
					checkbox.name = optionValue;
					checkbox.id = optionValue;
					checkbox.value = optionValue;
					//options = options + "<option value="+data.code+">"+data.program_name+"</option>";
					if(checked_vals !='')
					{
						var periods = checked_vals.split(",");
						for (j = 0; j < periods.length; j++) { 
							if(optionValue == periods[j])
								checkbox.checked = true;
						}	
					}
					divPaymentModes.appendChild(checkbox);
			
					var label = document.createElement('label')
					label.htmlFor = optionValue;
					label.class = "control-label";
					label.appendChild(document.createTextNode(optionValue));

					divPaymentModes.appendChild(label);
					divPaymentModes.appendChild(document.createElement("br"));
					
				});
				
			},
			error:function()
			{
				toastr.error('Unable to Process Please Contact Support');
			}
		});	
		//alert(online_mode);
	    /*//$('#hidSelInstCode').val(event.target.parentNode.cells[2].innerHTML);
	   var instituteid = hris_departmenttable.fnGetData( event.target.parentNode )[12];//GETTING DATA FOR HIDDEN COLUMN
		$('#hidinstmanageid').val(instituteid);//GETTING VALUE FOR HIDDEN COLUMN*/
	});
//ADD RECORD WITH VALIDATION	
	
//EDIT RECORD WITH VALIDATION
	$('#frmPaymentModeEdit').bootstrapValidator({
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
			var checked_vals = new Array(); 
			$('#divPaymentModes input:checkbox:checked').each(function(index) {
					checked_vals.push($(this).val());
				});
			var checked_values = checked_vals.join();
			var institutedata=
			{
				hidPaymentCode : $('#hidPaymentCode').val(),
				checked_values : checked_values,
				type:"operation_payment_mode"
			};
			//alert(checked_vals);
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_payment_mode", 
				type:"post",
				data:institutedata,
				success:function(response)
				{  
					//alert(response);
					$('#paymenteditmodal').modal('hide');
					var dtblInstitute = $("#dtblPaymentMode").DataTable();
				 	dtblInstitute.ajax.reload();
					toastr.success('Data Successfully Updated');
					$('#frmPaymentModeEdit').data('bootstrapValidator').resetForm(true);
					//$('#paymenteditmodal').data('bootstrapValidator').resetForm(true);
					
				},
				error:function()
				{
					toastr.error('Unable to Process Please Contact Support');
				}
			});
		},
    	//live: 'enabled',
       
		
	});
	/*********Exam Center Setup  Edit table render on click of edit button*/ 
	/*var institutedata={
		txtTemplateCode:$('#txtTemplateCode').val(),
		txtTemplateName:$('#txtTemplateName').val(),
		textTemplateDescription:$('#textTemplateDescription').val(),
		txtFileName:$('#txtFileName').val(),
		type:"INSERT_TEMPLATE"
	};*/
	// FOR INSTITUTE IMAGE SETUP
	$.ajax({
		url:base_url+"ajax_controller/select_institute_names_list_dropdown",
		mType:"post",
		data:'',
	
		//data:{center1:center},
		success:function(response)
		{  
			var options = "";				
			var res1 = JSON.parse(response);
			var dataProviderForMultiSelect = [];
			
			$.each(res1.aaData,function(i,data){
			//alert('ok');		
				options = options + "<option value='"+data.institute_code+"'>"+data.institute_name+"</option>";	
				//dataProviderForMultiSelect.push({label: data.center_name, value: data.center_code});	
			});			 //classname from studentmanage
			$('#cmbInstituteNameAdd').html("");  
			$('#cmbInstituteNameAdd').append(options)
			//$("#txtCenterTypeCpdeD").multiselect('dataprovider', dataProviderForMultiSelect);
			$('#cmbInstituteNameAdd').multiselect({
		        enableFiltering: true,
		        includeSelectAllOption:true,
				enableCaseInsensitiveFiltering:true,
				numberDisplayed: 1,
				buttonWidth:"265px",
				maxHeight: 250
		 	});	
			$("#cmbInstituteNameAdd").multiselect('refresh');	
		},
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	});
	// FOR INSTITUTE IMAGE Edit SETUP
	$.ajax({
		url:base_url+"ajax_controller/select_institute_names_list_dropdown",
		mType:"post",
		data:'',
	
		//data:{center1:center},
		/*success:function(response)
		{  
			var options = "";				
			var res1 = JSON.parse(response);
			var dataProviderForMultiSelect = [];
			
			$.each(res1.aaData,function(i,data){
			//alert('ok');		
				options = options + "<option value='"+data.institute_code+"'>"+data.institute_name+"</option>";	
				//dataProviderForMultiSelect.push({label: data.center_name, value: data.center_code});	
			});			 //classname from studentmanage
			$('#cmbInstituteImageNameEdit').html("");  
			$('#cmbInstituteImageNameEdit').append(options)
			//$("#txtCenterTypeCpdeD").multiselect('dataprovider', dataProviderForMultiSelect);
			$('#cmbInstituteImageNameEdit').multiselect({
		        enableFiltering: true,
		        includeSelectAllOption:true,
				enableCaseInsensitiveFiltering:true,
				numberDisplayed: 1,
				buttonWidth:"265px",
				maxHeight: 250
		 	});	
			$("#cmbInstituteImageNameEdit").multiselect('refresh');	
		},*/
		success:function(response)
			{  
				var options = "<option value=''>Select</option>";					
				var res1 = JSON.parse(response);					
				$.each(res1.aaData,function(i,data)
				{
					options = options + "<option value='"+data.institute_code+"'>"+data.institute_name+"</option>";
				});
				$('#cmbInstituteImageNameEdit').html("");   
				$('#cmbInstituteImageNameEdit').append(options);
				$('#cmbRoleFilter').html("");   
				$('#cmbRoleFilter').append(options);
				$('#cmbInstituteImageNameEdit').html(options)
				.selectpicker('refresh');		
			},
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	});
	
	
	
	
	//ajax call to server
	
	$.ajax({
		url:base_url+"ajax_controller/select_institute_center",
		mType:"post",
		data:'',
	
		//data:{center1:center},
		success:function(response)
		{  
			var options = "";				
			var res1 = JSON.parse(response);
			var dataProviderForMultiSelect = [];
			
			$.each(res1.aaData,function(i,data){
			//alert('ok');		
				options = options + "<option value='"+data.institute_code+"'>"+data.institute_name+"</option>";	
				//dataProviderForMultiSelect.push({label: data.center_name, value: data.center_code});	
			});			 //classname from studentmanage
			$('#cmbInstituteforExamAdd').html("");  
			$('#cmbInstituteforExamAdd').append(options)
			//$("#txtCenterTypeCpdeD").multiselect('dataprovider', dataProviderForMultiSelect);
			$('#cmbInstituteforExamAdd').multiselect({
		        enableFiltering: true,
		        includeSelectAllOption:true,
				enableCaseInsensitiveFiltering:true,
				numberDisplayed: 1,
				buttonWidth:"265px",
				maxHeight: 250
		 	});	
			$("#cmbInstituteforExamAdd").multiselect('refresh');	
		},
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	});
	
	$.ajax({
		url:base_url+"ajax_controller/SELECT_EXAM_FOR_EXAM_CENTER_SETUP",
		mType:"post",
		data:'',
	
		//data:{center1:center},
		success:function(response)
		{  
			var options = "";
			//options = "<option value=''>Select Institute Name</option>";					
			var res1 = JSON.parse(response);
			var dataProviderForMultiSelect = [];
			
			$.each(res1.aaData,function(i,data){
			//alert('ok');		
				options = options + "<option value='"+data.exam_centre_code+"'>"+data.exam_centre_name+"</option>";	
				//dataProviderForMultiSelect.push({label: data.center_name, value: data.center_code});	
			});					
			$('#cmbExamCenterAdd').html("");   //classname from studentmanage
			$('#cmbExamCenterAdd').append(options)
			//$("#txtCenterTypeCpdeD").multiselect('dataprovider', dataProviderForMultiSelect);
			$('#cmbExamCenterAdd').multiselect({
		        enableFiltering: true,
		        includeSelectAllOption:true,
				enableCaseInsensitiveFiltering:true,
				numberDisplayed: 1,
				buttonWidth:"265px",
				max_height: "200px"
		 	});
			$("#cmbExamCenterAdd").multiselect('refresh');	
		},
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	});
	
	var examCenterSetuptable = $('#dtblExamCenterSetup').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/select_exam_center",
			"type": "POST",
			"data": '',
		}, 
		//"sAjaxSource": "institute_setup_db.php?type=SELECT_EXAM_CENTER_SETUP&_s="+MY_SESSION_NAME,
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth":false,    
 		"sDom":"<'row'<'col-xs-4 addbuttonExamCentersetup'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6' i>>><'col-xs-6'p>>",
	    "aoColumns":[    
	                    { "sName": "sl_no","sWidth": "10%" },
						{ "sName": "institute_code","bVisible":false},
	                    { "sName": "institute_name","sWidth": "50%" },
						{ "sName": "exam_centre_code","bVisible":false},
						{ "sName": "exam_centre_name","sWidth": "30%"},
						{ "sName": "id","bVisible":false},
						{ "sName": "Action","sClass":"alignCenter","sWidth": "10%", "sDefaultContent": "<button   class='btn btn-warning  btn-circle tooltipTable' id='btnCorseEdit' title='Edit' onclick='editModalForExamcentersetup(event)'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
					],
        "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 6 ] }],
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
	
	$("div.addbuttonExamCentersetup").html("<button id='btnAddexamCentersetup' class='btn btn-info  btn-circle tooltips' title='Add'><i class='fa fa-plus'></i></button>");
	$('#btnAddexamCentersetup').click(function(){
		//$('#frmExamCenterSetupAdd').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#cmbInstituteforExamAdd').multiselect("rebuild");
		$('#cmbExamCenterAdd').multiselect("rebuild");
		$('#examCenterSetupAddmodal').modal('show');
		$('#examCenterSetupAddmodal').on('shown.bs.modal', function () 
		{ 
			$('#cmbInstituteforExamAdd').focus(); // Focusing the textbox
		})
	});
	
	//ADD RECORD WITH VALIDATION
	$('#frmExamCenterSetupAdd').bootstrapValidator({
		excluded: [':disabled'],
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
				cmbInstituteforExamAdd:$('#cmbInstituteforExamAdd').val(),
				cmbExamCenterAdd:$('#cmbExamCenterAdd').val()
			};
			//ajax call to server
			$.ajax({
				url: base_url+"/ajax_controller/get_add_exam_center",
				type:"post",
				data:institutedata,
				success:function(response){
					var res = JSON.parseJSON(response);
					//var dbMsgLength =(result.dbMessage).length;
					if(res.dbStatus == 'SUCCESS' && res.dbError == '')
					{	
						var dtblProgram = $("#dtblExamCenterSetup").DataTable();
			 			dtblProgram.ajax.reload();
			 			$('#frmExamCenterSetupAdd').data('bootstrapValidator').resetForm(true);	
			 			$("#cmbInstituteforExamAdd").multiselect('rebuild');
						$("#cmbExamCenterAdd").multiselect('rebuild');			
						toastr.success("Data Successfully Inserted");  
					}
					else if(res.dbStatus == 'SUCCESS' && res.dbError != '')
					{
						var dtblProgram = $("#dtblExamCenterSetup").DataTable();
			 			dtblProgram.ajax.reload();
			 			$('#frmExamCenterSetupAdd').data('bootstrapValidator').resetForm(true);	
			 			$("#cmbInstituteforExamAdd").multiselect('rebuild');
						$("#cmbExamCenterAdd").multiselect('rebuild');
						toastr.success("Data Successfully Inserted");  
						toastr.warning("Some Combinations are Already Exist");  
					}
					else if(res.dbStatus == 'ERROR' && res.dbError != '')
					{
						var dtblProgram = $("#dtblExamCenterSetup").DataTable();
			 			dtblProgram.ajax.reload();
			 			$('#frmExamCenterSetupAdd').data('bootstrapValidator').resetForm(true);	
			 			$("#cmbInstituteforExamAdd").multiselect('rebuild');
						$("#cmbExamCenterAdd").multiselect('rebuild');
						toastr.warning("All Combinations Are Already Exist"); 
					} 
									
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			'cmbInstituteforExamAdd[]': {							//form input type name
				validators: {
	                notEmpty: {
							message: 'Institute must be  required and can\'t be empty',
						
	                    },
	                    callback: function(value, validator, $field) {
	                        // Get the selected options
	                        message: 'Please choose atleast 1 Institute'
	                        var options = validator.getFieldElements('cmbInstituteforExamAdd[]').val();
	                        return (options != null
	                                && options.length >= 1);
	                    
	                }
	            
	            }
			},
			'cmbExamCenterAdd[]': {
	            validators: {
	                notEmpty: {
							message: 'Exam Center must be  required and can\'t be empty',
						
	                    },
	                    callback: function(value, validator, $field) {
	                        // Get the selected options
	                        message: 'Please choose atleast 1 Exam Center'
	                        var options = validator.getFieldElements('cmbExamCenterAdd[]').val();
	                        return (options != null
	                                && options.length >= 1);
	                    
	                }
	            
	            }
       		}
		}
	});
	var dtblExamCenterEditTable = $('#dtblExamCenterEdit').dataTable({
		
		//"responsive": true,
		"bPaginate": false,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth":false,    
 		"sDom":"<'row'<'col-xs-7'i><'col-xs-5'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6' >>><'col-xs-6'>>",
	    "aoColumns":[    
	                    { "sName": "sl_no","sWidth": "10%" },
						{ "sName": "exam_centre_name","sWidth": "30%"},
						{ "sName": "id","bVisible":false},
						{ "sName": "Action","sClass":"alignCenter","sWidth": "20%", "sDefaultContent": "<button type='button'  id='btnDocumentDelete' title='Delete' class='btn btn-danger btn-circle tooltipTable' onclick='deleteModalForExamcentersetup(event)'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}
					],
        "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 3 ] }],
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
	if($('#hidInstituteCode').val() != '')
	{
		var institutedata = {
			institute:hidInstituteCode
		};
		var dtblExamCenterEditTable = $('#dtblExamCenterEdit').dataTable({
			"ajax":
			{
				"url": base_url+"/ajax_controller/select_exam_center_edit",
				"type": "POST",
				"data": institutedata
			}, 
			//"responsive": true,
			"bPaginate": false,
	        "bLengthChange": true,
	        "bFilter": true,
	        "bSort": false,
	        "bInfo": true,
	        "bAutoWidth":false,    
	 		"sDom":"<'row'<'col-xs-7'i><'col-xs-5'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6' >>><'col-xs-6'>>",
		    "aoColumns":[    
		                    { "sName": "sl_no","sWidth": "10%" },
							{ "sName": "exam_centre_name","sWidth": "30%"},
							{ "sName": "id","bVisible":false},
							{ "sName": "Action","sClass":"alignCenter","sWidth": "20%", "sDefaultContent": "<button type='button'  id='btnDocumentDelete' title='Delete' class='btn btn-danger btn-circle tooltipTable' onclick='deleteModalForExamcentersetup(event)'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}
						],
	        "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 3 ] }],
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
});
function editModalForExamcentersetup(event)
{
	var oTable = $('#dtblExamCenterSetup').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;
	
	hidInstituteCode =  oTable.fnGetData(row)[1];	
	$('#hidInstituteCode').val(hidInstituteCode);
	$('#instituteForExmCentreEdit').html(oTable.fnGetData(row)[2]);
  	var checked_vals = oTable.fnGetData(row)[3];
	 //ajax call to server for edit exam center setup edit table render
	var institutedata={
		institute:$('#hidInstituteCode').val()
	};
	//ajax call to server
	$.ajax({
		url:base_url+"/ajax_controller/select_exam_center_edit",
		type:"post",
		data:institutedata,
		//data:menudata,
		success:function(response)
		{ 
			var data = JSON.parse(response);	
			var dtblExamCenterEditTable  = $('#dtblExamCenterEdit').dataTable(); 
			//data = jQuery.parseJSON(response);
			dtblExamCenterEditTable .fnClearTable();
			if (data.aaData.length)
			dtblExamCenterEditTable .fnAddData(data.aaData);
			dtblExamCenterEditTable .fnDraw();	
		},
		error:function(){
			//toastr.error('Unable to Process Please Contact Support');
		}
	});
	$('#examCenterSetupEditmodal').modal('show');
}
function deleteModalForExamcentersetup(event)
{	
	swal
	({
	  	title: "Are you sure?",
	  	text: "You want to Delete the Exam Center!",
	 	type: "warning",
	  	showCancelButton: true,
	 	confirmButtonColor: "#DD6B55",
	  	confirmButtonText: "Yes, delete it!",
	  	cancelButtonText: "No, cancel",
	  	closeOnConfirm: false,
	  	closeOnCancel: true
	},
	function(isConfirm)
	{
	  	if (isConfirm) {
		  	deleteMaster();
		    swal("Deleted", "Exam Center has been deleted successfully.", "success");
	  	} else {
		    swal("Cancelled", "Exam Center is safe ", "error");
		}
	});
	function deleteMaster()
	{
		var oTable = $('#dtblExamCenterEdit').dataTable();
		
		var row;
		if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
		   row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
		   row = event.target.parentNode.parentNode.parentNode;
		$('#hidExamCenterId').val( oTable.fnGetData(row)[2]); 
		//var session = $('#hidSession').val();
		var institutedata=
		{
			hidExamCenterId:$('#hidExamCenterId').val(),
			institute:$('#hidInstituteCode').val()
		};		
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/delete_exam_centerdata",
			type:"post",
			data:institutedata,
			//data:menudata,
			success:function(response)
			{ 
				var dtblExamCenterEditTable = $('#dtblExamCenterEdit').dataTable({
					"ajax":
					{
						"url": base_url+"/ajax_controller/select_exam_center_edit",
						"type": "POST",
						"data": institutedata,
					}, 
					//"responsive": true,
					"bPaginate": false,
			        "bLengthChange": true,
			        "bFilter": true,
			        "bSort": false,
			        "bInfo": true,
			        "bAutoWidth":false,  
			        "bDestroy": true,  
			 		"sDom":"<'row'<'col-xs-7'i><'col-xs-5'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6' >>><'col-xs-6'>>",
				    "aoColumns":[    
				                    { "sName": "sl_no","sWidth": "10%" },
									{ "sName": "exam_centre_name","sWidth": "30%"},
									{ "sName": "id","bVisible":false},
									{ "sName": "Action","sClass":"alignCenter","sWidth": "20%", "sDefaultContent": "<button type='button'  id='btnDocumentDelete' title='Delete' class='btn btn-danger btn-circle tooltipTable' onclick='deleteModalForExamcentersetup(event)'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}
								],
			        "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 3 ] }],
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
				var examCenterSetuptable = $('#dtblExamCenterSetup').dataTable({
					"ajax":
					{
						"url": base_url+"/ajax_controller/select_exam_center",
						"type": "POST",
						"data": '',
					}, 
					//"sAjaxSource": "institute_setup_db.php?type=SELECT_EXAM_CENTER_SETUP&_s="+MY_SESSION_NAME,
					"bPaginate": true,
			        "bLengthChange": true,
			        "bFilter": true,
			        "bSort": false,
			        "bInfo": true,
			        "bAutoWidth":false,  
			        "bDestroy": true,    
			 		"sDom":"<'row'<'col-xs-4 addbuttonExamCentersetup'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6' i>>><'col-xs-6'p>>",
				    "aoColumns":[    
				                    { "sName": "sl_no","sWidth": "10%" },
									{ "sName": "institute_code","bVisible":false},
				                    { "sName": "institute_name","sWidth": "50%" },
									{ "sName": "exam_centre_code","bVisible":false},
									{ "sName": "exam_centre_name","sWidth": "30%"},
									{ "sName": "id","bVisible":false},
									{ "sName": "Action","sClass":"alignCenter","sWidth": "10%", "sDefaultContent": "<button   class='btn btn-warning  btn-circle tooltipTable' id='btnCorseEdit' title='Edit' onclick='editModalForExamcentersetup(event)'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
								],
			        "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 6 ] }],
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
			},
			error:function(){
				//toastr.error('Unable to Process Please Contact Support');
			}
		});
		$.ajax({
			url:base_url+"ajax_controller/delete_exam_centerdata",
			type:"post",
			data:institutedata,
			success:function()
			{  
				var dtblProgram = $("#dtblExamCenterEdit").DataTable();
				var dTable = $("#dtblExamCenterSetup").DataTable();
				var data = {
					institute:$('#hidInstituteCode').val()
				};
				var dtblExamCenterEditTable = $('#dtblExamCenterEdit').dataTable({
					"ajax":
					{
						"url": base_url+"/ajax_controller/select_exam_center_edit",
						"type": "POST",
						"data": data,
					}, 
					//"responsive": true,
					"bPaginate": false,
			        "bLengthChange": true,
			        "bFilter": true,
			        "bSort": false,
			        "bInfo": true,
			        "bAutoWidth":false,  
			        "bDestroy": true,  
			 		"sDom":"<'row'<'col-xs-7'i><'col-xs-5'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6' >>><'col-xs-6'>>",
				    "aoColumns":[    
				                    { "sName": "sl_no","sWidth": "10%" },
									{ "sName": "exam_centre_name","sWidth": "30%"},
									{ "sName": "id","bVisible":false},
									{ "sName": "Action","sClass":"alignCenter","sWidth": "20%", "sDefaultContent": "<button type='button'  id='btnDocumentDelete' title='Delete' class='btn btn-danger btn-circle tooltipTable' onclick='deleteModalForExamcentersetup(event)'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}
								],
			        "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 3 ] }],
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
				var examCenterSetuptable = $('#dtblExamCenterSetup').dataTable({
					"ajax":
					{
						"url": base_url+"/ajax_controller/select_exam_center",
						"type": "POST",
						"data": '',
					}, 
					//"sAjaxSource": "institute_setup_db.php?type=SELECT_EXAM_CENTER_SETUP&_s="+MY_SESSION_NAME,
					"bPaginate": true,
			        "bLengthChange": true,
			        "bFilter": true,
			        "bSort": false,
			        "bInfo": true,
			        "bAutoWidth":false,  
			        "bDestroy": true,    
			 		"sDom":"<'row'<'col-xs-4 addbuttonExamCentersetup'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6' i>>><'col-xs-6'p>>",
				    "aoColumns":[    
				                    { "sName": "sl_no","sWidth": "10%" },
									{ "sName": "institute_code","bVisible":false},
				                    { "sName": "institute_name","sWidth": "50%" },
									{ "sName": "exam_centre_code","bVisible":false},
									{ "sName": "exam_centre_name","sWidth": "30%"},
									{ "sName": "id","bVisible":false},
									{ "sName": "Action","sClass":"alignCenter","sWidth": "10%", "sDefaultContent": "<button   class='btn btn-warning  btn-circle tooltipTable' id='btnCorseEdit' title='Edit' onclick='editModalForExamcentersetup(event)'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>"}
								],
			        "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 6 ] }],
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
				$("div.addbuttonExamCentersetup").html("<button id='btnAddexamCentersetup' class='btn btn-info  btn-circle tooltips' title='Add'><i class='fa fa-plus'></i></button>");
				$('#btnAddexamCentersetup').click(function(){
					//$('#frmExamCenterSetupAdd').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
					$('#cmbInstituteforExamAdd').multiselect("rebuild");
					$('#cmbExamCenterAdd').multiselect("rebuild");
					$('#examCenterSetupAddmodal').modal('show');
					$('#examCenterSetupAddmodal').on('shown.bs.modal', function () 
					{ 
						$('#cmbInstituteforExamAdd').focus(); // Focusing the textbox
					})
				});
				toastr.success('Data Successfully Deleted');				 
			},
			error:function()
			{
				toastr.error('Unable to process please contact support');
			}
		});	
	}
}
/*function editResourceRow(event)
{
	isEdit = true;	
		isDelete = true;			
		$(institutedetailstable.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		//alert(event.target.tagName);
		if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
	  		row = event.target.parentNode.parentNode.parentNode; 
	  	else
	  		row = event.target.parentNode;
		$(row).addClass('success');
		$("#fileInstituteImageEdit").val("");
		$('#instmanageeditformid').data('bootstrapValidator').resetForm(true);
		$('#instituteeditname').val(institutedetailstable.fnGetData( event.target.parentNode )['institute_name']);
	    $('#instituteeditcode').val(institutedetailstable.fnGetData( event.target.parentNode )['institute_code']);
	    $('#txtinstituteTypeEdit').val(institutedetailstable.fnGetData( event.target.parentNode )['institute_type']);
		$('#fileinstitutelogoEdit').val("");
	    $('#txtWebaddressEdit').val(institutedetailstable.fnGetData( event.target.parentNode )['website_address']);
	    $('#txtContactNoEdit').val(institutedetailstable.fnGetData( event.target.parentNode )['contact_number']);
	    $('#txtLocationEdit').val(institutedetailstable.fnGetData( event.target.parentNode )['location']);
	    $('#cmbRecordStatusEdit').val(institutedetailstable.fnGetData( event.target.parentNode )['record']);
	    $('#instituteeditAddress').val(institutedetailstable.fnGetData( event.target.parentNode )['institute_address']);
	    $('#instituteadmindisplaynameEdit').val(institutedetailstable.fnGetData( event.target.parentNode )['admin_name']);
	    $('#instituteadminusernameEdit').val(institutedetailstable.fnGetData( event.target.parentNode )['admin_user_name']);
	    var image = institutedetailstable.fnGetData( event.target.parentNode )['image_url'];
		var institute_image = base_url+"public/assets/images/"+image;
			//alert(signature);
			$('#imageDisplayareaEdit').attr('src', institute_image);
			$("#imageDisplayareaEdit").attr('height','100');
			$("#imageDisplayareaEdit").attr('width','200');
}*/
function imageSetupRow(event,action)
{
	var base_adm_url = $("#hidBaseAsmUrl").val(); 	
	//var instituteimagesetuptable = $('#dtblInstituteImageSetup').dataTable();
	var oTable = $('#dtblInstituteImageSetup').dataTable();
	isEdit = true;	
	isDelete = true;			
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});
	//alert(event.target.tagName);
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	else
  		row = event.target.parentNode;
  		var record_id = oTable.fnGetData( row )[0];
	$(row).addClass('success');
	
	$('#hid_img_code').val(oTable.fnGetData( row )[1]);
	
	
	$("#fileInstituteImageEdit1").val("");
	$("#fileInstituteImageEdit2").val("");
	$("#fileInstituteImageEdit3").val("");
	
	
	var insti_code = oTable.fnGetData( row )[1];
	//alert(insti_code);
	var image1 = oTable.fnGetData( row )[3];		
	var image2 = oTable.fnGetData( row )[4];																
	var image3 = oTable.fnGetData( row )[5];
	$('select[name=cmbInstituteImageNameEdit]').val(insti_code); 
	$('.selectpicker').selectpicker('refresh');
	
	//$('#cmbInstituteImageNameEdit').val(insti_code);
	var institute_image1 = base_adm_url+"/institute/"+image1;
	//var institute_image1 = DOCUMENT_UPLOAD_URL+image1;
		//alert(signature);
		$('#imageDisplayareaEdit1').attr('src', institute_image1);
		$("#imageDisplayareaEdit1").attr('height','100');
		$("#imageDisplayareaEdit1").attr('width','200');
   // var image2 = instituteimagesetuptable.fnGetData( event.target.parentNode )['image_url'];
	var institute_image2 = base_adm_url+"/institute/"+image2;
	//var institute_image2 = DOCUMENT_UPLOAD_URL+"/"+image2;
		//alert(signature);
		$('#imageDisplayareaEdit2').attr('src', institute_image2);
		$("#imageDisplayareaEdit2").attr('height','100');
		$("#imageDisplayareaEdit2").attr('width','200');
    //var image3 = instituteimagesetuptable.fnGetData( event.target.parentNode )['image_url'];
	var institute_image3 = base_adm_url+"/institute/"+image3;
	//var institute_image3 = DOCUMENT_UPLOAD_URL+"/"+image3;
		//alert(signature);
		$('#imageDisplayareaEdit3').attr('src', institute_image3);
		$("#imageDisplayareaEdit3").attr('height','100');
		$("#imageDisplayareaEdit3").attr('width','200');
	  
	if(action == 'edit')
	{
		$('#instituteimageeditmodal').modal('show');
	}	
	else
	{   
		/*var hid = $('#hid_img_code').val();    
		alert(hid);	  */
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
				hidimgId:$('#hid_img_code').val(),
				type:"DELETE_ROLE",
				
			};		
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/delete_institute_image_data",
				type:"post",
				data:institutedata,
				success:function(responsedata)
				{  
					var result = jQuery.parseJSON(responsedata);
		            if(result.status)
		            {
		            	//alert("hi");
						toastr.success(result.msg);
						
			 			var dtblInstituteImageSetup = $("#dtblInstituteImageSetup").DataTable();
			 			var isDelete= false;
			 			$('#frmrolesetup').data('bootstrapValidator').resetForm(true);
						bind_role();
						dtblInstituteImageSetup.ajax.reload();	
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