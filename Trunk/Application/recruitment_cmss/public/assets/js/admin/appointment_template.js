$(document).ready(function(){
	
	CKEDITOR.replace( 'taExamSchedule',
    {
    	toolbarCanCollapse: true,
    	toolbarStartupExpanded: false,
    	removePlugins : 'elementspath',
    	
	});
	
	for (var i in CKEDITOR.instances) {
        CKEDITOR.instances[i].on('change', function() {
        });
    }
	
	$.ajax({
		url:base_url+"ajax_controller/select_program_data_manage_app", 
		type:"post",
		success:function(response)
		{  
			var options = "<option value=''>Select</option>";					
			var res1 = JSON.parse(response);					
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value='"+data.program_group_code+"'>"+data.program_group_name+"</option>";
			});
			$('#cmbProgramGroup').html("");   
			$('#cmbProgramGroup').append(options);
		},
		error:function()
		{
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$.ajax({
		url:base_url+"/ajax_controller/get_program_table_data",
		type:"post",
		data:'',
		success:function(response)
		{  
			var options = "<option value =''>Select Post</option>";					
			var res1 = JSON.parse(response);					
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value="+data.program_code+">"+data.program_name+"</option>";
			});
			$('#cmbProgram').html("");  
			$('#cmbProgram').append(options);   
			
		},
		error:function()
		{
			alert("We are unable to Process.Please contact Support");
		}
	});
	$('#cmbProgramGroup').change(function()
	{
		var program_group = $("#cmbProgramGroup").val();
		var institutedata = {
			program_group:program_group,
		};
		$.ajax({
			url:base_url+"/ajax_controller/select_program_manage_app",
			type:"post",
			data:institutedata,
			success:function(response)
			{  
				var options = "<option value =''>Select Post</option>";					
				var res1 = JSON.parse(response);					
				$.each(res1.aaData,function(i,data)
				{
					options = options + "<option value="+data.program_code+">"+data.program_name+"</option>";
				});
				$('#cmbProgram').html("");  
				$('#cmbProgram').append(options);   
				
			},
			error:function()
			{
				alert("We are unable to Process.Please contact Support");
			}
		});
	});
	$('#btnFilter').click(function()
	{
		if($('#cmbProgramGroup').val() == '' || $('#cmbProgramGroup').val() == null)
		{
			toastr.error("Please Select Recruitment Drive");
			return false;
		}
		else if($('#cmbProgram').val() == '' || $('#cmbProgram').val() == null)
		{
			toastr.error("Please Select Post");
			return false;
		}

		else
		{
			
			var institutedata = {
				post_code:$('#cmbProgram').val()
			};
			var ApplicationDetail = $('#dtblApplicationDetail').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/get_AppointmentData", 
					"type": "POST",
					"data": institutedata
				}, 
				"bPaginate": false,
		        "bLengthChange": true,
		        "bFilter": true,
		        "bSort": true,
		        "bInfo": true,
		        "bDestroy" : true,
		        "bAutoWidth": true,
		        "initComplete": function(settings, json) {
		        	var table = $('#dtblApplicationDetail').dataTable();
		         	if(table.fnGetData().length >= 1)
		         	{
						$("#btnAddChallan").hide();
					}
					else
					{
						$("#btnAddChallan").show();
					}
		        },
				/*"sDom":"<'row'<'col-xs-4 addCoursebtnCharge'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-5' i>>><'col-xs-3'p>>",*/
				"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addCoursebtnCharge' >>><'col-xs-6'p>>", 
				"aoColumns": [
								{ "sName": "sl_no","sWidth": "5%"},
								{ "sName": "program_code","bVisible": false},
								{ "sName": "program_name"},
								{ "sName": "authorised_name"},
								{ "sName": "instructions","bVisible": false},
								{ "sName": "signature","bVisible": false},
								{"sName": "default","sWidth": "15%", "sClass":"dt-center", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='InvigilatorSetupRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>\
					            <button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='InvigilatorSetupRow(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}
					            
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
		}
		/*$("div.addCoursebtnCharge").html('<button class="btn btn-info tooltips btn-circle" title="Add" id="btnAddChallan"><i class="fa fa-plus" aria-hidden="true"></i></button>');*/
		$("div.addCoursebtnCharge").html('<button id="btnAddChallan" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	
		
		//ADD button clicked
		$('#btnAddChallan').click(function()
		{
			$('#frmAddProgram').data('bootstrapValidator').resetForm(true);
			$("#hidAction").val('Add');
			var post_code = $('#cmbProgram').val();
			$('#hidUniquePostId').val(post_code);
			$('#signatureDisplayarea').attr('src','');
			$("#signatureDisplayarea").attr('height','0');
			$("#signatureDisplayarea").attr('width','0');
			CKEDITOR.instances['taExamSchedule'].setData("");
			$('#fileControllerSignature').val("");
			$('#txtAuthorisedName').val("");
			$.ajax({
				url:base_url+"ajax_controller/invigilator_code",
				type:"post",
				data:'',
				success:function(response)
				{
					
					var obj = jQuery.parseJSON(response);
					$('#txtInvigilatorCode').val(obj.invigilator_code);
				},  
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});
			$("#myModalLabel").html("Add Appointment Setup");
			$("#programaddsave").html("<i class='fa fa-save'></i>  Add");
			$('#programAddModal').modal('show');
			$('#programAddModal').on('shown.bs.modal', function()
			{  
				$('#txtTemplateCode').focus();// Focusing the textbox
			})	
		});
		
		//ADD/UPDATE RECORD WITH VALIDATION	
		$('#frmAddProgram').bootstrapValidator({
			excluded:[':disabled'],
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
				for ( instance in CKEDITOR.instances )
       			CKEDITOR.instances[instance].updateElement();
       			if($("#fileControllerSignature").val() == '' && $('#signatureDisplayarea').attr('src') == '')
       			{
       				toastr.error("Please Upload Authorised Signature");
       				$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtAuthorisedName', 'VALID', null);
       				return false;
				}
       			if($("#taExamSchedule").val() == '')
       			{
					toastr.error("Please enter Appointment Letter");
					$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtAuthorisedName', 'VALID', null);
					return false;
				}
				var formData = new FormData(document.getElementById("frmAddProgram"));
				var oper = $("#hidAction").val();
				//ajax call to server
				if(oper == 'Add')
					oper = 'add_appointmentLetter';
				else if(oper == 'Update')
					oper = 'edit_appointmentLetter';
					
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
						if(res.status == "SUCCESS"){
							var dtblApplicationDetail = $("#dtblApplicationDetail").DataTable();
				 			dtblApplicationDetail.ajax.reload();
				 			$('#frmAddProgram').data('bootstrapValidator').resetForm(true);	
							toastr.success(res.msg);
							$('#fileControllerSignature').val('');
							$('#signatureDisplayarea').attr('src','');
							$("#signatureDisplayarea").attr('height','0');
							$("#signatureDisplayarea").attr('width','0');
							CKEDITOR.instances['taExamSchedule'].setData("");
							if(oper != 'add_appointmentLetter')
							{
								$('#programAddModal').modal('hide');
							}
						} 
						else
						{
							var res = JSON.parse(response);
							toastr.error(res.msg);
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
	            cmbProgram: {							//form input type name
	                validators: {
	                    notEmpty: {
	                        message: 'Required'
	                    }
	                }
	            },
	            /*taExamSchedule: {							//form input type name
	                validators: {
	                    notEmpty: {
	                        message: 'Required'
	                    }
	                }
	            },*/
	            txtAuthorisedName: {							//form input type name
	                validators: {
	                    notEmpty: {
	                        message: 'Required'
	                    }
	                }
	            },
	            /*fileControllerSignature: {							//form input type name
	                validators: {
	                    notEmpty: {
	                        message: 'Required'
	                    }
	                }
	            },*/
	            taExamSchedule: {							//form input type name
	                validators: {
	                    notEmpty: {
	                        message: 'Required'
	                    }
	                }
	            }
			}	
		});	
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
	var ApplicationDetail = $('#dtblApplicationDetail').dataTable({
		"bPaginate": false,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bDestroy" : true,
        "bAutoWidth": true,
		"sDom":"<'row'<'col-xs-4 addCoursebtnCharge'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-5' i>>><'col-xs-3'p>>",
		"aoColumns": [
						{ "sName": "sl_no","sWidth": "5%"},
						{ "sName": "program_code","bVisible": false},
						{ "sName": "program_name"},
						{ "sName": "authorised_name"},
						{ "sName": "instructions","bVisible": false},
						{ "sName": "signature","bVisible": false},
						{"sName": "default","sWidth": "15%", "sClass":"dt-center", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='InvigilatorSetupRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>\
			            <button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='InvigilatorSetupRow(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}
			            
        			]
	});
	
	
});
function InvigilatorSetupRow(event,action)
{
	var oTable = $('#dtblApplicationDetail').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;
	$('#frmAddProgram').data('bootstrapValidator').resetForm(true);
	$('#hidUniqueid').val( oTable.fnGetData(row)['code']);
	$('#hidUniquePostId').val( oTable.fnGetData(row)['program_code']);
	$('#txtInvigilatorCode').val( oTable.fnGetData(row)['code']);
	//$('#signatureDisplayarea').val( oTable.fnGetData(row)['authorised_sign']);
	$('#txtAuthorisedName').val( oTable.fnGetData(row)['authorised_name']);
	$('#taExamSchedule').val( oTable.fnGetData(row)['instructions']);
	CKEDITOR.instances['taExamSchedule'].setData(oTable.fnGetData(row)['instructions']);
	var image = oTable.fnGetData( row )['authorised_sign'];
	$('#signatureDisplayarea').attr('src', image);
	$("#signatureDisplayarea").attr('height','100');
	$("#signatureDisplayarea").attr('width','100');
	
	$("#hidAction").val('Update');
	if(action == 'edit')
	{
		$("#myModalLabel").html("Update Appointment Setup");
		$("#programaddsave").html("<i class='fa fa-save'></i>  Update");	
		$('#programAddModal').modal('show');
	}	
	else
	{
		swal({
		  title: "Are you sure?",
		  text: "You want to Delete the Appointment Letter!",
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
		    swal("Deleted", "Appointment Letter has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Appointment Letter is safe ", "error");
		  }
		});
	    function deleteMaster(){ 
			var institutedata=
			{
				code:$('#hidUniqueid').val(),
				post_code:$('#hidUniquePostId').val(),
				type:"operation_delete_AppointmentLetter"
			};	
			type = 'operation_delete_AppointmentLetter';	
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/"+type,
				type:"post",
				data:institutedata,
				success:function(response)
				{  
					var result = JSON.parse(response);	
					if(result.status == true)
					{	
						var dtblApplicationDetail = $("#dtblApplicationDetail").DataTable();
		 				dtblApplicationDetail.ajax.reload();
						//toastr.success(result.msg);
					}
					else
					{
						toastr.error(result.msg);
					}					 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});	
		}
	}	
	
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
}