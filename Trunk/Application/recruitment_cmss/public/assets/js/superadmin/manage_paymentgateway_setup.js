$(document).ready(function(){
	$('.selectpicker').selectpicker(
	  {  
	    liveSearchPlaceholder: 'Placeholder text'
	  }
	);
	$('.bs-searchbox input').attr('placeholder', 
      'Search');
	isPgMasterSetupDelete= false;
	isPgMasterSetupEdit = false;
	var dtblPgMasterSetup = $('#dtblPgMasterSetup').dataTable({
		//"responsive": true,
		"ajax":
		{
			"url": base_url+"/ajax_controller/select_payment_gateway_master",
			"type": "POST",
			"data": '',
		}, 
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth":true,    
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 pgmastergroupbutton' >>><'col-xs-6'p>>",
	    "aoColumns": [    
                        { "sName": "sl_no","sWidth": "5%" },
                        { "sName": "pg_code","sWidth": "10%" },
                        { "sName": "pg_name","sWidth": "10%" },
                        { "sName": "logo_url","sWidth":"10%","sClass":"alignCenter",
						 	"mRender":function(data, type, full) 
						 	{
						 		if(data == 'default.png'|| data == '')
						 			return "<a href='../images/"+data+"' class='html5lightbox' data-width='200' data-height='200' ><img src='../loginimages/"+data+"' style='width:50px;height:50px'/></a>";
						 		else	
				    				return "<a href='"+data+"' class='html5lightbox' data-width='200' data-height='200' ><img src='"+data+"?v=" + new Date().getTime()+"' style='width:50px;height:50px'/></a>";
				    		}
					 	},
					 	{ "sName": "remarks","sWidth": "25%"},
					 	{ "sName": "payment_process_url","sWidth": "10%"},
					 	{ "sName": "pg_action_url","sWidth": "10%"},
                        { "sName": "pg_master_id","bVisible" : false },
                        { "sName": "record_status","bVisible" : false },
                        { "sName": "status","sClass" : "alignCenter", "sWidth": "5%",
                       		"mRender": function( data, type, full ) 
                       		{
			           			if(data == 1)
				                	return '<img src="'+base_url+'public/assets/images/ACTIVE.png"/>';
				                else
				                	return '<img src="'+base_url+'public/assets/images/INACTIVE.png"/>';
	           				}  
                        },
                       {"sName": "default","sWidth": "15%", "sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='masterSetupRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>"}
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
			  		},   
         "fnDrawCallback": function(oSettings, json) {
		   $('.html5lightbox').html5lightbox();	         
		},           
	});
	$("div.pgmastergroupbutton").html('<div class="btngroup"><button id="btnAddPgMasterSetup" class="btn btn-info custombtn"><i class="fa fa-plus"></i> Add</button></div>');//<button class="btn btn-info custombtn" id="btnDeletePgMasterSetup"><i class="fa fa-trash"></i> Delete</button>
	
	//ADD button clicked
	$('#btnAddPgMasterSetup').click(function()
	{
		//alert('a');
		isPgMasterSetupDelete= false;
		isPgMasterSetupEdit = false;
		$(dtblPgMasterSetup.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		$('#frmPgMasterSetup').data('bootstrapValidator').resetForm(true);
		//document.getElementById("signMessageEdit1").innerHTML="";
		$('#txtPgMasterCode').val("");
		$('#txtPgMasterName').val("");
		$('#hidPgMasterId').val('');
		$('#fileLogo').val('');
		$('#hidPgMasterCode').val('');
		$('#cmbPGCodeStatus').val('');
		$('#txtPgMasterCode').attr('readonly', false);
		$("#myModalLabel").html("Add Record");
		$("#hidbtnData").val("Add");
		$("#btnSavePgMasterSetup").html("<i class='fa fa-save'></i> Add");
		$('#modalPgMasterSetup').modal('show');
		$('#modalPgMasterSetup').on('shown.bs.modal', function()
		{  
			$('#txtPgMasterCode').focus();// Focusing the textbox
		})	
	});
	$('#fileLogo').change(function()			
	 { 
	 //alert("ghg");
		var file = document.getElementById("fileLogo").files[0];
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
			if(iFileSize <= 400000)
			{
			
			  //document.getElementById("signMessageEdit1").innerHTML="";
			  $("#imageDisplayareaEdit1").attr('height','0');
			  $("#imageDisplayareaEdit1").attr('width','0');
			  readURLSigLogo(this);
			  
			}
			else
			{
				//alert("File size exceeds 1 MB.");
				//document.getElementById("signMessageEdit1").innerHTML="Error : File size exceeds 400 KB";
				$('#fileLogo').val("");
				$('#frmPgMasterSetup').data('bootstrapValidator').updateStatus('fileLogo', 'NOT_VALIDATED', null).validateField('fileLogo');
				$('#imageDisplayareaEdit1').attr('src','');
				$("#imageDisplayareaEdit1").attr('height','0');
				$("#imageDisplayareaEdit1").attr('width','0');
			}
        }
		else
		{
            //alert("Invalid File Format");
			//document.getElementById("signMessageEdit1").innerHTML="Error : Invalid File Format";
			//$('#fileLogo').val("");
			//$('#frmPgMasterSetup').data('bootstrapValidator').updateStatus('fileLogo', 'NOT_VALIDATED', null).validateField('fileLogo');
			/*$('#imageDisplayareaEdit1').attr('src','');
			$("#imageDisplayareaEdit1").attr('height','0');
			$("#imageDisplayareaEdit1").attr('width','0');*/
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
	//ADD/UPDATE/ RECORD WITH VALIDATION	
	$('#frmPgMasterSetup').bootstrapValidator({
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
			var formData = new FormData(document.getElementById("frmPgMasterSetup"));
			var text = $("#hidbtnData").val();
			if(text == 'Add')
			{
				var oper = 'add_payment_gateway_master';
			}
			else if(text == 'Update')
			{
				var oper = 'edit_payment_gateway_master';
			}
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/"+oper,
				//url:"manage_paymentgateway_setup_db.php?type="+oper, 
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response)
				{ 
					var res = JSON.parse(response); 
					if(res.status == "Error")
					{
						toastr.error('Duplicate entry of Code.Try a new one!!!');
						$('#modalPgMasterSetup').modal('show');
						$('#txtPgMasterCode').focus();
						$('#txtPgMasterCode').val("");
				 		$('#frmPgMasterSetup').data('bootstrapValidator').updateStatus('txtPgMasterCode', 'NOT_VALIDATED', null).validateField('txtPgMasterCode');						
						isPgMasterSetupDelete= false;
						isPgMasterSetupEdit = false;
						return false;
					}
					else if(res.status == "Inserted")
					{ 
						$('#modalPgMasterSetup').modal('show');
						$('#frmPgMasterSetup').data('bootstrapValidator').resetForm(true);
						var dtblPgMasterSetup = $("#dtblPgMasterSetup").DataTable();
					 	dtblPgMasterSetup.ajax.reload();
						toastr.success('Data Successfully Saved');
						isPgMasterSetupDelete= false;
						isPgMasterSetupEdit = false;
					}	
					else if(res.status == "Updated")
					{ 
						$('#modalPgMasterSetup').modal('hide');
						$('#frmPgMasterSetup').data('bootstrapValidator').resetForm(true);
						var dtblPgMasterSetup = $("#dtblPgMasterSetup").DataTable();
					 	dtblPgMasterSetup.ajax.reload();
						toastr.success('Data Updated Successfully');
						isPgMasterSetupDelete= false;
						isPgMasterSetupEdit = false;
					}
					else if(res.status == "Failure")
					{
						toastr.error('Error In Uploading Image File!!!');
						$('#modalPgMasterSetup').modal('show');
						$('#txtPgMasterCode').focus();
						$('#txtPgMasterCode').val("");
				 		$('#frmPgMasterSetup').data('bootstrapValidator').updateStatus('fileLogo', 'NOT_VALIDATED', null).validateField('fileLogo');						
						isPgMasterSetupDelete= false;
						isPgMasterSetupEdit = false;
						return false;
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
            txtPgMasterCode: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
						regexp: /^([A-Za-z0-9]+)$/i,
						message: "Special characters and space are not allowed"
					}
                }
            },
            txtPgMasterName: {							
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            fileLogo: 
            { 
            	validators: { 
            		callback: {
	                    message: 'Required',
	                    callback: function(value, validator, $field) {
	                        // Get the selected options
	                        var hidPgMasterId = $('#hidPgMasterId').val();
	                        if((hidPgMasterId == '') && ($("#fileLogo").val() == ''))
	                        	return false;
	                        else if((hidPgMasterId != '') && ($("#fileLogo").val() == ''))
		                        return true;
		                    else if((hidPgMasterId != '') && ($("#fileLogo").val() != ''))
		                        return true;
		                    else if((hidPgMasterId == '') && ($("#fileLogo").val() != ''))
		                        return true;
	                    }
	                },     
	                file: 
	                {
	                    extension: 'jpeg,jpg,png,JPEG,JPG,PNG',
	                   	type: 'image/jpeg,image/png',
	                    message: 'The selected file is not valid'
	                }
            	}
            },
            txtRemarks: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                }
            },
            txtPaymentProcessURL: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                }
            },
            txtActionURL: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                }
            },
            cmbPGCodeStatus: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                }
            }
		}	
	});
	
	$('#modalPgMasterSetup').on('hidden.bs.modal', function (e) {
 		$('#frmPgMasterSetup').data('bootstrapValidator').resetForm(true);
 		$(dtblPgMasterSetup.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isPgMasterSetupEdit = false;
		isPgMasterSetupDelete = false;
	})
	//============================================================================PAMENT GATEWAY MASTER TAB==============================================//
		isPgParameterDelete= false;
		isPgParameterEdit = false;
		
	var dtblPgParameter = $('#dtblPgParameter').dataTable({
		//"sAjaxSource":"manage_paymentgateway_setup_db.php?type=GET_PG_PARAMETERS&pg_code=",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth":false,    
        "bDestroy":true,    
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 pgparametergroupbutton' >>><'col-xs-6'p>>",
	    "aoColumns": [    
                       { "sName": "slno","sWidth": "3%"},
                       { "sName": "pg_parameters_id","bVisible": false},
                       { "sName": "pg_code","bVisible": false},
                       { "sName": "pg_name","sWidth": "10%"},
                       { "sName": "pg_parameter_code","sWidth": "10%"},
                       { "sName": "pg_parameter_name","sWidth": "30%"},
                       { "sName": "record_status","bVisible" : false },
                       { "sName": "status","sClass" : "alignCenter", "sWidth": "5%",
                       		"mRender": function( data, type, full ) 
                       		{
			           			if(data == 1)
				                	return '<img src="'+base_url+'public/assets/images/ACTIVE.png"/>';
				                else
				                	return '<img src="'+base_url+'public/assets/images/INACTIVE.png"/>';
	           				}  
                       },
                       {"sName": "default","sWidth": "15%", "sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='parameterRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>"}
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
	$("div.pgparametergroupbutton").html('<div class="btngroup"><button id="btnAddPgParameter" class="btn btn-info custombtn"><i class="fa fa-plus"></i> Add</button></div>');//<button class="btn btn-info custombtn" id="btnDeletePgParameter"><i class="fa fa-trash"></i> Delete</button>
	
	$("#tabParameterTab").click(function(){
		//get account group list in dropdown
		$.ajax({
			url:base_url+"ajax_controller/get_pg_code_list", 
			type:"post",	
			success:function(response){  
				var options = "";
				options = "";
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data){
						options = options + "<option value="+data.pg_code+">"+data.pg_name+"</option>";
				});
				$('#cmbPgCode').html(options).selectpicker('refresh');					   
				$('#cmbPgCode').append(options);
				var codedescdata={
					pg_code:$('#cmbPgCode').val(),
				};
			   //ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/get_pg_parameter",
					type:"POST",
					data:codedescdata,
					success:function(response)
					{  
						data = jQuery.parseJSON(response);
						dtblPgParameter.fnClearTable();
						if (data.aaData.length)
						dtblPgParameter.fnAddData(data.aaData);
						dtblPgParameter.fnDraw();	
					},
					error:function(){
						toastr.error('Unable to Process Please Contact Support');
					}
				});	
				//var dtblPgParameter = $('#dtblPgParameter').DataTable();
				//dtblPgParameter.ajax.url(base_url+"/ajax_controller/get_pg_parameter"+"manage_paymentgateway_setup_db.php?type=GET_PG_PARAMETERS&pg_code="+$('#cmbPgCode').val()).load();
			},
			error:function(){
				alert("We are unable to Process.Please contact Support");
			}
		});
	});
	$("#cmbPgCode").change(function(){
		var codedescdata={
			pg_code:$('#cmbPgCode').val(),
		};
	   //ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/get_pg_parameter",
			type:"POST",
			data:codedescdata,
			success:function(response)
			{  
				data = jQuery.parseJSON(response);
				dtblPgParameter.fnClearTable();
				if (data.aaData.length)
				dtblPgParameter.fnAddData(data.aaData);
				dtblPgParameter.fnDraw();	
			},
			error:function(){
				toastr.error('Unable to Process Please Contact Support');
			}
		});	
	});
	//ADD button clicked
	$('#btnAddPgParameter').click(function()
	{
		isPgParameterDelete= false;
		isPgParameterEdit = false;
		$(dtblPgParameter.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		var pg_code = $("#cmbPgCode").val();
		$('#txtPgCode').val(pg_code);
		$('#hidPgCode').val(pg_code);
		$('#frmPgParameter').data('bootstrapValidator').resetForm(true);
		$('#cmbPGParameterStatus').val("");
		$("#myModalLabel").html("Add Record");
		$("#hidbtnPgCodeData").val("Add");
		$("#btnSavePgParameter").html("<i class='fa fa-save'></i> Add");
		$('#modalPgParameter').modal('show');
		$('#modalPgParameter').on('shown.bs.modal', function()
		{  
			$('#txtPgParameterCode').focus();// Focusing the textbox
		})	
	});
	
	//ADD/UPDATE RECORD WITH VALIDATION	
	$('#frmPgParameter').bootstrapValidator({
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
			var formData = new FormData(document.getElementById("frmPgParameter"));
			//alert(formData);
			var text = $("#hidbtnPgCodeData").val();
			if(text == 'Add')
			{
				var oper = 'add_pg_parameter';
			}
			else if(text == 'Update')
			{
				var oper = 'edit_pg_parameter';
			}
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/"+oper,
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response)
				{  
					var res = JSON.parse(response); 
					//$('#modalCodeGroupDesc').modal('hide');
					if(res.status == "Exist")
					{
						$('#txtPgParameterCode').val("");
				 		$('#frmPgParameter').data('bootstrapValidator').updateStatus('txtPgParameterCode', 'NOT_VALIDATED', null).validateField('txtPgParameterCode');
						$('#txtPgParameterCode').focus();
						toastr.error('Duplicate entry of  Parameter code for this pg code.Try a new one !!!');
						return false;
					}
					else if(res.status == "Error")
					{
						$('#txtPgParameterName').val("");
				 		$('#frmPgParameter').data('bootstrapValidator').updateStatus('txtPgParameterName', 'NOT_VALIDATED', null).validateField('txtPgParameterName');
						$('#txtPgParameterName').focus();
						toastr.error('Duplicate entry of parameter name for this pg code.Try a new one !!!');
						return false;
					}
					else if(res.status == "Inserted")
					{
						$('#modalPgParameter').modal('show');
						$('#frmPgParameter').data('bootstrapValidator').resetForm(true);
						var codedescdata={
							pg_code:$('#cmbPgCode').val(),
						};
					   //ajax call to server
						$.ajax({
							url:base_url+"ajax_controller/get_pg_parameter",
							type:"POST",
							data:codedescdata,
							success:function(response)
							{  
								data = jQuery.parseJSON(response);
								dtblPgParameter.fnClearTable();
								if (data.aaData.length)
								dtblPgParameter.fnAddData(data.aaData);
								dtblPgParameter.fnDraw();	
							},
							error:function(){
								toastr.error('Unable to Process Please Contact Support');
							}
						});	
						toastr.success('Data Successfully Saved');
						isPgParameterEdit = false;
						isPgParameterDelete = false;	
					}
					else if(res.status == "Updated")
					{
						$('#modalPgParameter').modal('hide');
						$('#frmPgParameter').data('bootstrapValidator').resetForm(true);
						var codedescdata={
							pg_code:$('#cmbPgCode').val(),
						};
					   //ajax call to server
						$.ajax({
							url:base_url+"ajax_controller/get_pg_parameter",
							type:"POST",
							data:codedescdata,
							success:function(response)
							{  
								data = jQuery.parseJSON(response);
								dtblPgParameter.fnClearTable();
								if (data.aaData.length)
								dtblPgParameter.fnAddData(data.aaData);
								dtblPgParameter.fnDraw();	
							},
							error:function(){
								toastr.error('Unable to Process Please Contact Support');
							}
						});	
						toastr.success('Data Successfully Updated');
						isPgParameterEdit = false;
						isPgParameterDelete = false;	
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
            txtPgParameterCode : {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
						regexp: /^([A-Za-z0-9]+)$/i,
						message: "Special characters and space are not allowed"
					}
                }
            },
             txtPgParameterName: {							
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            cmbPGParameterStatus: {							
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }
		}	
	});
	
	$('#modalPgParameter').on('hidden.bs.modal', function (e) {
 		$('#frmPgParameter').data('bootstrapValidator').resetForm(true);
 		$(dtblPgParameter.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isPgParameterEdit = false;
		isPgParameterDelete = false;
	})
	//============================================================================PAMENT GATEWAY PARAMETER TAB===========================================//
		isPgParameterValueEdit = false;
		isPgParameterValueDelete = false;
		var dtblPGParameterValues = $('#dtblPGParameterValues').dataTable({
		//"sAjaxSource":"manage_paymentgateway_setup_db.php?type=GET_PG_PARAMETER_VALUE&pg_code=&school_code=",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth":true,    
       // "bDestroy":true,    
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 pgparametervaluesgroupbutton' >>><'col-xs-6'p>>",
	    "aoColumns": [    
                       { "sName": "slno","sWidth": "3%"},
                       { "sName": "pg_parameter_values_id","bVisible": false},
                       { "sName": "pg_code","bVisible": false},
                       { "sName": "pg_parameter_code","bVisible": false},
                       { "sName": "school_code","bVisible": false},
                       { "sName": "institute_name","sWidth": "10%"},
                       { "sName": "pg_name","sWidth": "10%"},
                       { "sName": "pg_parameter_name","sWidth": "10%"},
                       { "sName": "pg_parameter_value","sWidth": "10%"},
                       { "sName": "record_status","bVisible" : false },
                       { "sName": "status","sClass" : "alignCenter", "sWidth": "20%",
                       		"mRender": function( data, type, full ) 
                       		{
			           			if(data == 1)
				                	return '<img src="'+base_url+'public/assets/images/ACTIVE.png"/>';
				                else
				                	return '<img src="'+base_url+'public/assets/images/INACTIVE.png"/>';
	           				}  
                       },
                       {"sName": "default","sWidth": "15%", "sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='parametervaluesRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>"}
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
	$("div.pgparametervaluesgroupbutton").html('<div class="btngroup"><button id="btnAddPgParameterValue" class="btn btn-info custombtn"><i class="fa fa-plus"></i> Add</button></div>');//<button class="btn btn-info custombtn" id="btnDeletePgParameterValue"><i class="fa fa-trash"></i> Delete</button>

	$('#tabParameterValuesTab').on('click',function(){
		$.ajax({	
			url:base_url+"ajax_controller/select_institutes",
			type:"post",
			success:function(response){  
				var options = "";
				options = "";//<option value=\"\">SELECT</option>
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data){
						options = options + "<option value="+data.institute_code+">"+data.institute_name+"</option>";
				});
				$('#cmbSchool').html(options).selectpicker('refresh');
				$.ajax({	
					url:base_url+"ajax_controller/select_pgcodes",
					type:"post",
					success:function(response){  
						var options = "<option value=''>Select</option>";
						var res1 = JSON.parse(response);
						$.each(res1.aaData,function(i,data){
								options = options + "<option value=\""+data.pg_code+"\">"+data.pg_name+"</option>";
						});
						$('#cmbPGcode').html(options).selectpicker('refresh');	
						$('#cmbPGCodeModal').html(options).selectpicker('refresh');	
						
					},
					error:function(){
						alert("We are unable to Process.Please contact Support");
					}
				});
				$('#cmbInstituteMultiselect').html("");					   
				$('#cmbInstituteMultiselect').append(options);
				$('#cmbInstituteMultiselect').multiselect({
				includeSelectAllOption: true,
		     	enableCaseInsensitiveFiltering:true,
		     	maxHeight: 200,
				buttonWidth: '356px',
				numberDisplayed:1
				}); 
			},
			error:function(){
				alert("We are unable to Process.Please contact Support");
			}
		});
	});
	$('#cmbSchool').on('change',function(){
		//load datatable
		$('#cmbPGcode').selectpicker('val', '');
		$('#cmbPGCode').selectpicker("refresh");	
		var codedescdata={
			pg_code:$('#cmbPgCode').val(),
			school_code:$('#cmbSchool').val(),
		};
	   //ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/get_pg_parameter_values",
			type:"POST",
			data:codedescdata,
			success:function(response)
			{  
				data = jQuery.parseJSON(response);
				dtblPGParameterValues.fnClearTable();
				if (data.aaData.length)
				dtblPGParameterValues.fnAddData(data.aaData);
				dtblPGParameterValues.fnDraw();	
			},
			error:function(){
				toastr.error('Unable to Process Please Contact Support');
			}
		});	
		/*var dtblPGParameterValues =  $('#dtblPGParameterValues').DataTable();
		dtblPGParameterValues.ajax.url("manage_paymentgateway_setup_db.php?type=GET_PG_PARAMETER_VALUE&pg_code="+$('#cmbPGcode').val()+"&school_code="+$('#cmbSchool').val()).load();*/
	});

	$('#cmbPGcode').on('change',function(){
		//load datatable
		var codedescdata={
			pg_code:$('#cmbPgCode').val(),
			school_code:$('#cmbSchool').val(),
		};
	   //ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/get_pg_parameter_values",
			type:"POST",
			data:codedescdata,
			success:function(response)
			{  
				data = jQuery.parseJSON(response);
				dtblPGParameterValues.fnClearTable();
				if (data.aaData.length)
				dtblPGParameterValues.fnAddData(data.aaData);
				dtblPGParameterValues.fnDraw();	
			},
			error:function(){
				toastr.error('Unable to Process Please Contact Support');
			}
		});	
		/*var dtblPGParameterValues =  $('#dtblPGParameterValues').DataTable();
		dtblPGParameterValues.ajax.url("manage_paymentgateway_setup_db.php?type=GET_PG_PARAMETER_VALUE&pg_code="+$('#cmbPGcode').val()+"&school_code="+$('#cmbSchool').val()).load();*/
	});
	
	$('#cmbPGCodeModal').on('change',function(){
			var institutedata={
			pg_code : $('#cmbPGCodeModal').val()
			};
			$.ajax({	
			url:base_url+"ajax_controller/select_pgparameter_codes", 
			type:"post",
			data:institutedata,
			success:function(response){  
				var options = "<option value=''>Select</option>";
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data){
						options = options + "<option value=\""+data.pg_parameter_code+"\">"+data.pg_parameter_name+"</option>";
				});
				$('#cmbPGParameterModal').html(options).selectpicker('refresh');	
			},
			error:function(){
				alert("We are unable to Process.Please contact Support");
			}
		});
		});

	$('#btnAddPgParameterValue').on('click',function(){
		 //var school = $('#cmbSchool').val();
		/* var cmbPGcode = $('#cmbPGcode').val();
		$('#cmbPGCodeModal').val(cmbPGcode);*/
		 //alert(school_code);return();
		 
		$(dtblPGParameterValues.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		//deselect selected options multiselect
	    $('option', $('#cmbInstituteMultiselect')).each(function(element) {
	    	$(this).removeAttr('selected').prop('selected', false);
	    });
    	//refresh the multiselect 
    	$('#cmbInstituteMultiselect').multiselect('refresh').multiselect("enable");
    	$.ajax({	
			url:base_url+"ajax_controller/select_institutes",
			type:"post",
			success:function(response){  
				var res1 = JSON.parse(response);
				var cmbSchool = $('#cmbSchool').val();
				
				var options_multi = "";
				options_multi = "";//<option value=\"\">SELECT</option>
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data){
					if(cmbSchool != '')
					{
							//alert(cmbPGcode);
							$("#cmbInstituteMultiselect option[value='" + cmbSchool + "']").prop("selected", true);
							$("#cmbInstituteMultiselect").multiselect("refresh");
							options_multi = options + "<option value="+data.institute_code+">"+data.institute_name+"</option>";
							$('#frmPGParameterValues').data('bootstrapValidator').updateStatus('cmbInstituteMultiselect', 'VALIDATED');
							
					}
					
				});
				
				$('#cmbInstituteMultiselect').html("");					   
				$('#cmbInstituteMultiselect').append(options_multi);
				$('#cmbInstituteMultiselect').multiselect({
				includeSelectAllOption: true,
		     	enableCaseInsensitiveFiltering:true,
		     	maxHeight: 200,
				buttonWidth: '356px',
				numberDisplayed:1
				}); 
			},
			error:function(){
				alert("We are unable to Process.Please contact Support");
			}
		});
		$.ajax({	
			url:base_url+"ajax_controller/select_pgcodes",
			type:"post",
			success:function(response){  
				var options = "<option value=''>Select</option>";
				var cmbPGcode = $('#cmbPGcode').val();
				//alert(cmbPGcode);
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data){
						$("#cmbPGCodeModal option[value='" + cmbPGcode + "']").prop("selected", true);
						$('#cmbPGCodeModal').selectpicker('refresh');
						//options = options + "<option value=\""+data.pg_code+"\">"+data.pg_name+"</option>";
				});
				//$('#cmbPGcode').html(options).selectpicker('refresh');	
				//$('#cmbPGCodeModal').html(options).selectpicker('refresh');	
				
			},
			error:function(){
				alert("We are unable to Process.Please contact Support");
			}
		});
		var pg_code = $('#cmbPGcode').val();
		//alert(pg_code);
		$.ajax({	
			url:base_url+"ajax_controller/select_pgparameter_codes", 
			type:"post",
			data:{ pg_code: pg_code },
			success:function(response){  
				var options = "<option value=''>Select</option>";
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data){
						options = options + "<option value=\""+data.pg_parameter_code+"\">"+data.pg_parameter_name+"</option>";
				});
				$('#cmbPGParameterModal').html(options).selectpicker('refresh');	
			},
			error:function(){
				alert("We are unable to Process.Please contact Support");
			}
		});
		
		//var cmbPGcode = $('#cmbPGcode').val();
    	 //$('#cmbInstituteMultiselect').val(school);
    	//deselect selected options selectpicker
		$('#cmbPGCodeModal').selectpicker('val','').prop('disabled', false);
		$('#cmbPGCodeModal').selectpicker('refresh');
		$('#cmbPGParameterModal').selectpicker('val', '').prop('disabled', false);
		$('#cmbPGParameterModal').selectpicker('refresh');
		$("#myModalLabelParameterValue").html("Add PG ParameterValues");
		$('#txtParameterValues').val('');
		$('#cmbPGParameterValuesStatus').val(1);
		$("#hidbtnPgParameterData").val("Save");
		$("#btnSaveParameterValues").html("<i class='fa fa-save'></i> Save");
		$('#modalPGParameterValues').modal('show');
	});
	$('#frmPGParameterValues').bootstrapValidator({
		excluded: ':disabled',
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
			var pgParameterValuesData ={
				schools: $('#cmbInstituteMultiselect').val(),
				//schools: $('#cmbSchool').val(),
				pg_code: $('#cmbPGCodeModal').val(),
				parameter_code: $('#cmbPGParameterModal').val(),
				parameter_value: $('#txtParameterValues').val(),
				parameter_value_status: $('#cmbPGParameterValuesStatus').val(),
				hidPgParameterValueId: $('#hidPgParameterValueId').val(),
			}
			//alert(formData);
			var text = $("#hidbtnPgParameterData").val();
			if(text == 'Save')
			{
				var oper = 'add_pg_parameter_values';
			}
			else if(text == 'Update')
			{
				var oper = 'edit_pg_parameter_values';
			}
			$.ajax({
				url:base_url+"ajax_controller/"+oper,
				type:"post",
				data:pgParameterValuesData,
				success:function(response)
				{ 
					var res = JSON.parse(response); 
					if(res.status == "Error")
					{ 
						//alert("dsgfhdsfgjh")
						toastr.error(res.msg);
						//toastr.success(res.msg);
						//$('#modalPGParameterValues').modal('show');
						//$('#cmbPGParameterModal').focus();
						//$('#cmbPGParameterModal').val("");
						//$('#cmbPGParameterModal').selectpicker('val', '')
				 		//$('#frmPGParameterValues').data('bootstrapValidator').updateStatus('cmbPGParameterModal', 'NOT_VALIDATED', null).validateField('cmbPGParameterModal');						
						//$('#cmbPGParameterModal').selectpicker('refresh');
						return false;
					}
					else if(res.status == 'UPDATED')
					{
						var codedescdata={
							pg_code:$('#cmbPgCode').val(),
							school_code:$('#cmbSchool').val(),
						};
					   //ajax call to server
						$.ajax({
							url:base_url+"ajax_controller/get_pg_parameter_values",
							type:"POST",
							data:codedescdata,
							success:function(response)
							{  
								data = jQuery.parseJSON(response);
								dtblPGParameterValues.fnClearTable();
								if (data.aaData.length)
								dtblPGParameterValues.fnAddData(data.aaData);
								dtblPGParameterValues.fnDraw();	
							},
							error:function(){
								toastr.error('Unable to Process Please Contact Support');
							}
						});	
						$('#frmPGParameterValues').data('bootstrapValidator').resetForm(true);
						$('#modalPGParameterValues').modal('hide');				  	   
						toastr.success('Updated Successfully');	
					}
					else
					{
						var codedescdata={
							pg_code:$('#cmbPgCode').val(),
							school_code:$('#cmbSchool').val(),
						};
					   //ajax call to server
						$.ajax({
							url:base_url+"ajax_controller/get_pg_parameter_values",
							type:"POST",
							data:codedescdata,
							success:function(response)
							{  
								data = jQuery.parseJSON(response);
								dtblPGParameterValues.fnClearTable();
								if (data.aaData.length)
								dtblPGParameterValues.fnAddData(data.aaData);
								dtblPGParameterValues.fnDraw();	
							},
							error:function(){
								toastr.error('Unable to Process Please Contact Support');
							}
						});	
						$('#frmPGParameterValues').data('bootstrapValidator').resetForm(true);	
						$('#modalPGParameterValues').modal('hide');			  	   
						toastr.success(res.msg);	
					}
					isPgParameterValueEdit = false;
					isPgParameterValueDelete = false;
				},
				error:function()
				{
					toastr.error('We are unable to process please contact support');	
				}
			});
		},
        fields:
        {
        	cmbInstituteMultiselect: {
                validators: {
                   callback: {
                        message: 'Please choose atleast one Organization',
                        callback: function(value, validator, $field) {
                            // Get the selected options
                            var options = validator.getFieldElements('cmbInstituteMultiselect').val();
                            return (options != null);
                        }
                    },
                }
            },  
            cmbPGCodeModal: {	validators: {  	
            		notEmpty: { message: 'Required'  }
                }
            },
            cmbPGParameterModal: {	validators: {  	
            		notEmpty: { message: 'Required'  }
                }
            },
		}	
	});
	$('#modalPGParameterValues').on('hidden.bs.modal', function (e) {
 		$('#frmPGParameterValues').data('bootstrapValidator').resetForm(true);
 		$(dtblPGParameterValues.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		isPgParameterValueEdit = false;
		isPgParameterValueDelete = false;
	})
	//============================================================================PAMENT GATEWAY PARAMETER VALUES TAB====================================//
	/* CODE FOR TOOLTIP */
	$('.tooltips').tooltipster({
		theme: 'tooltipster-punk',
		animation: 'grow',
        delay: 500, 
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

//Edit or Delete master setup button clicked
function masterSetupRow(event,action)
{
	var oTable = $('#dtblPgMasterSetup').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});			
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
		
	var pg_master_id = oTable.fnGetData(row)[7];
	var pg_master_code = oTable.fnGetData(row)[1];
    $('#txtPgMasterCode').val(row.cells[1].innerHTML);
    $('#txtPgMasterName').val(row.cells[2].innerHTML);
    $('#txtRemarks').val(row.cells[4].innerHTML);
    $('#txtPaymentProcessURL').val(row.cells[5].innerHTML);
    $('#txtActionURL').val(row.cells[6].innerHTML);
    $('#cmbPGCodeStatus').val(oTable.fnGetData(row)[8]);
    //$('#filelogo').val(dtblPgMasterSetup.fnGetData( event.target.parentNode )[9]);
    $('#hidPgMasterId').val(pg_master_id);
    $('#hidPgMasterCode').val(pg_master_code);
	if(action == 'edit')
	{	
		$('#txtPgMasterCode').attr('readonly', true);
		$("#myModalLabel").html("Update Record");
		$("#hidbtnData").val("Update");
		$("#btnSavePgMasterSetup").html("<i class='fa fa-save'></i> Update");	
		$('#modalPgMasterSetup').modal('show');
	}	
	
}

//Edit or Delete parameter button clicked
function parameterRow(event,action)
{
	var oTable = $('#dtblPgParameter').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});			
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	
	var pg_parameters_id = oTable.fnGetData( row )[1];
	var pg_code = oTable.fnGetData( row )[2];
	$('#txtPgParameterCode').val(oTable.fnGetData( row )[4]);
    $('#txtPgParameterName').val(oTable.fnGetData( row )[5]);
    $('#hidPgParameterName').val(oTable.fnGetData( row )[5]);
    $('#hidPgCode').val(pg_code);
    $('#txtPgCode').val(pg_code);
    $('#hidPgParameterCode').val(oTable.fnGetData( row )[4]);
    $('#cmbPGParameterStatus').val(oTable.fnGetData( row )[6]);
    $('#hidPgParameterId').val(pg_parameters_id);
	if(action == 'edit')
	{	
		$("#myModalLabelParameters").html("Update Record");
		$("#hidbtnPgCodeData").val("Update");
		$("#btnSavePgParameter").html("<i class='fa fa-save'></i> Update");	
		$('#modalPgParameter').modal('show');
	}
	/*else
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
				hidPgParameterId:$('#hidPgParameterId').val(),
				type:"DELETE_ROLE",
				
			};		
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/delete_parameter",
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
	}*/	
	
}

//Edit or Delete parameter value button clicked
function parametervaluesRow(event,action)
{
	var oTable = $('#dtblPGParameterValues').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});			
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	
	var pg_parameters_id = oTable.fnGetData( row )[1];
	var pg_code = oTable.fnGetData( row )[2];
	var pg_parameter_code1 = oTable.fnGetData( row )[3];
	var school_code = oTable.fnGetData( row )[4];
	var status = oTable.fnGetData( row )[10];
	var pg_parameter_value = oTable.fnGetData( row )[8];

    $('#cmbPGParameterValuesStatus').val(status);
    $('#cmbPGCodeModal').selectpicker('val', pg_code).prop('disabled', true);
    var institutedata={
		pg_code : $('#cmbPGCodeModal').val()
	};
	$.ajax({	
		url:base_url+"ajax_controller/select_pgparameter_codes", 
		type:"post",
		data:institutedata,
		success:function(response){  
			var options = "<option value=''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
					options = options + "<option value=\""+data.pg_parameter_code+"\">"+data.pg_parameter_name+"</option>";
			});
			$('#cmbPGParameterModal').html(options).selectpicker('refresh');
			$('#cmbPGParameterModal').selectpicker('val', pg_parameter_code1).prop('disabled', true);	
		},
		error:function(){
			alert("We are unable to Process.Please contact Support");
		}
	});
    $('#txtParameterValues').val(pg_parameter_value);
    $('#hidPgParameterValueId').val(pg_parameters_id);
    $('option', $('#cmbInstituteMultiselect')).each(function(element) {
		$(this).removeAttr('selected').prop('selected', false);
    });
    //refresh the multiselect 
    $('#cmbInstituteMultiselect').multiselect('refresh');
    $('#cmbInstituteMultiselect').multiselect('select', school_code).multiselect("disable");
		
	if(action == 'edit')
	{	
		$("#myModalLabelParameterValue").html("Update PG ParameterValues");
		$("#hidbtnPgParameterData").val("Update");
		$("#btnSaveParameterValues").html("<i class='fa fa-save'></i> Update");
		$('#modalPGParameterValues').modal('show');
	}	
	
}
