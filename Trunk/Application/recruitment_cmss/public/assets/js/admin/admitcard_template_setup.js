$(document).ready(function(){
	var ApplicationDetail = $('#dtblApplicationDetail').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_admitcardTemplates",
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
						{ "sName": "template_code"},
						{ "sName": "template_name"},
						{ "sName": "template_description"},
						{ "sName": "file_name"},
						{"sName": "default","sWidth": "15%", "sClass":"dt-center", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='CounsellingSetupRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>\
			            <button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='CounsellingSetupRow(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}
			            
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
	
	//ADD button clicked
	$('#btnAddChallan').click(function()
	{
		$('#frmAddProgram').data('bootstrapValidator').resetForm(true);
		$("#hidAction").val('Add');
		$('#txtTemplateCode').val("");
		$('#txtTemplateName').val("");
		$('#taTemplateDesc').val("");
		$('#txtFileName').val("");
		$("#txtTemplateCode").prop('disabled', false);	
		$("#myModalLabel").html("Add Admit Card Template");
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
				oper = 'Add_template_setup';
			else if(oper == 'Update')
				oper = 'Update_template_setup';
				
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
						if(oper != 'Add_template_setup')
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
            txtTemplateCode: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            txtTemplateName: {							//form input type name
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
            taTemplateDesc: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            txtFileName: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }
		}	
	});	
	
});
function CounsellingSetupRow(event,action)
{
	var oTable = $('#dtblApplicationDetail').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;
	$('#frmAddProgram').data('bootstrapValidator').resetForm(true);
	$('#hidUniqueid').val( oTable.fnGetData(row)['template_code']);
	$('#txtTemplateCode').val( oTable.fnGetData(row)['template_code']);
	$('#txtTemplateName').val( oTable.fnGetData(row)['template_name']);
	$('#taTemplateDesc').val( oTable.fnGetData(row)['template_description']);
	$('#txtFileName').val( oTable.fnGetData(row)['file_name']);
	$("#hidAction").val('Update');
	if(action == 'edit')
	{
		$("#myModalLabel").html("Update Admit Card Template");
		$("#txtTemplateCode").prop('disabled', true);	
		$("#programaddsave").html("<i class='fa fa-save'></i>  Update");	
		$('#programAddModal').modal('show');
	}	
	else
	{
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
		  if (isConfirm) {
		  	deleteMaster();
		    swal("Deleted", "Template has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Template is safe ", "error");
		  }
		});
	    function deleteMaster(){ 
			var institutedata=
			{
				template_code:$('#hidUniqueid').val(),
				type:"operation_delete_admitcard_templateSetup"
			};	
			type = 'operation_delete_admitcard_templateSetup';	
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
						toastr.success(result.msg);
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