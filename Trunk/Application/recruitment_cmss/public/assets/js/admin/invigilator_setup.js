$(document).ready(function(){
	var ApplicationDetail = $('#dtblApplicationDetail').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_InvigilatorData",
			"type": "POST",
			"data": ''
		}, 
		"bPaginate": false,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bDestroy" : true,
        "bAutoWidth": true,
		/*"sDom":"<'row'<'col-xs-4 addCoursebtnCharge'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-5' i>>><'col-xs-3'p>>",*/
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addCoursebtnCharge' >>><'col-xs-6'p>>", 
		"aoColumns": [
						{ "sName": "sl_no","sWidth": "5%"},
						{ "sName": "program_code","bVisible": false},
						{ "sName": "program_name"},
						{ "sName": "code"},
						{ "sName": "name"},
						{ "sName": "designation"},
						{ "sName": "from"},
						{ "sName": "mobile_no","bVisible": false},
						{ "sName": "mail_id","bVisible": false},
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
	/*$("div.addCoursebtnCharge").html('<button class="btn btn-info tooltips btn-circle" title="Add" id="btnAddChallan"><i class="fa fa-plus" aria-hidden="true"></i></button>');*/
	$("div.addCoursebtnCharge").html('<button id="btnAddChallan" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	
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
	//ADD button clicked
	$('#btnAddChallan').click(function()
	{
		$('#frmAddProgram').data('bootstrapValidator').resetForm(true);
		$("#hidAction").val('Add');
		$('#cmbProgram').attr("disabled",false);
		$('#cmbProgram').val("");
		$('#txtInvigilatorName').val("");
		$('#txtMailId').val("");
		$('#txtPhoneNo').val("");
		$('#txtFrom').val("");
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
		$("#myModalLabel").html("Add Invigilator");
		$("#programaddsave").html("<i class='fa fa-save'></i>  Add");
		$('#programAddModal').modal('show');
		$('#programAddModal').on('shown.bs.modal', function()
		{  
			$('#txtTemplateCode').focus();// Focusing the textbox
		})	
	});
	
	//ADD/UPDATE RECORD WITH VALIDATION	
	$('#frmAddProgram').bootstrapValidator({
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
			var formData = new FormData(document.getElementById("frmAddProgram"));
			
			var oper = $("#hidAction").val();
			//ajax call to server
			if(oper == 'Add')
				oper = 'Add_Invigilator_setup';
			else if(oper == 'Update')
				oper = 'Update_Invigilator_setup';
				
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
					if(res.status == true){
						var dtblApplicationDetail = $("#dtblApplicationDetail").DataTable();
			 			dtblApplicationDetail.ajax.reload();
			 			$('#frmAddProgram').data('bootstrapValidator').resetForm(true);	
						toastr.success(res.msg);
						if(oper != 'Add_Invigilator_setup')
						{
							$('#programAddModal').modal('hide');
						}
						else
						{
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
            txtInvigilatorCode: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            txtInvigilatorName: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
					regexp: {
						regexp: /^([A-Za-z0-9\s]+)$/i,
						message: "Special characters are not allowed"
					}
                }
            },
            txtMailId: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
					emailAddress: {
	                    message: 'The value is not a valid email address'
	                }
                }
            },
            txtPhoneNo: {							//form input type name
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
            txtDesignation: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            txtFrom: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }
		}	
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
	//alert(oTable.fnGetData(row)['program_code']);
	$('#cmbProgram').val( oTable.fnGetData(row)['program_code']);
	//alert($('#cmbProgram').val());
	$('#txtInvigilatorName').val( oTable.fnGetData(row)['name']);
	$('#txtMailId').val( oTable.fnGetData(row)['mail_id']);
	$('#txtPhoneNo').val( oTable.fnGetData(row)['mobile_no']);
	$('#txtFrom').val( oTable.fnGetData(row)['from']);
	$('#txtDesignation').val( oTable.fnGetData(row)['designation']);
	$('#txtInvigilatorCode').val( oTable.fnGetData(row)['code']);
	$("#hidAction").val('Update');
	if(action == 'edit')
	{
		$('#cmbProgram').attr("disabled", "true");
		$("#myModalLabel").html("Update Invigilator");
		$("#programaddsave").html("<i class='fa fa-save'></i>  Update");	
		$('#programAddModal').modal('show');
	}	
	else
	{
		swal({
		  title: "Are you sure?",
		  text: "You want to Delete the Invigilator!",
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
		    swal("Deleted", "Invigilator has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Invigilator is safe ", "error");
		  }
		});
	    function deleteMaster(){ 
			var institutedata=
			{
				code:$('#hidUniqueid').val(),
				post_code:$('#hidUniquePostId').val(),
				type:"operation_delete_Invigilator_setup"
			};	
			type = 'operation_delete_Invigilator_setup';	
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
	
}