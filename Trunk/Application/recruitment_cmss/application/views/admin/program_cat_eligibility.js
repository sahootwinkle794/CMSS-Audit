$(document).ready(function(){
	
	
	// *************************************************************** FOR Category SETUP ***********************************************************
	
	var ApplicationDetail = $('#tblCounsellingPeriod').dataTable({
		"ajax":
		{
			"url": base_url+"/ajaxcounselling_controller/select_CounsellingPeriod",
			"type": "POST",
			"data": ''
		}, 
		"bPaginate": false,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bDestroy" : true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4 addbuttonCounsellingPeriod'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6'i >>><'col-xs-6'p>>",
		"aoColumns": [
						{ "sName": "sl_no","sWidth": "5%"},
						{ "sName": "category_code","sWidth": "15%"},
						{ "sName": "category_name","sWidth": "15%"},
						{ "sName": "status","sWidth": "15%"},
						{"sName": "default","sWidth": "15%", "sClass":"dt-center", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='categoryRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>\
			            <button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='categoryRow(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}
        			]
	});
	$("div.addbuttonCounsellingPeriod").html("<button id='btnAddCounsellingPeriod' class='btn btn-info btn-circle tooltips' title='Add Category'><i class='fa fa-plus'></i></button>");	
	
	//ADD button clicked
	$('#btnAddCounsellingPeriod').click(function()
	{
		$('#frmCounsellingPeriod').data('bootstrapValidator').resetForm(true);
		$('#txtCounsellingPeriodCode').val("");
		$('#txtCounsellingPeriodName').val("");
		$('#cmbCounsellingPeriodStatus').val("");
		$("#txtCounsellingPeriodCode").prop('disabled', false);	
		$("#myModalLabelCounsellingPeriod").html("Add Record");
		$("#btnSaveCounsellingPeriod").html("Add");
		$('#modalCounsellingPeriod').modal('show');
		$('#modalCounsellingPeriod').on('shown.bs.modal', function()
		{  
			$('#txtCounsellingPeriodCode').focus();// Focusing the textbox
		})	
	});
	
	//ADD/UPDATE RECORD WITH VALIDATION	
	$('#frmCounsellingPeriod').bootstrapValidator({
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
			var formData = new FormData(document.getElementById("frmCounsellingPeriod"));
			var oper = $("#btnSaveCounsellingPeriod").html();
			//ajax call to server
			if(oper == 'Add')
				oper = 'ADD_CounsellingPeriod';
			else if(oper == 'Update')
				oper = 'UPDATE_CounsellingPeriod';
				
			$.ajax({
				url:base_url+"ajaxcounselling_controller/"+oper,
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response)
				{  
					var res = JSON.parse(response);
					if(res.status == "SUCCESS"){
						var tblCounter = $("#tblCounsellingPeriod").DataTable();
			 			tblCounter.ajax.reload();
			 			$('#frmCounsellingPeriod').data('bootstrapValidator').resetForm(true);	
						toastr.success(res.msg);
						if(oper != 'ADD_CounsellingPeriod')
						{
							$('#modalCounsellingPeriod').modal('hide');
						}
					} 
					else
					{
						var res = JSON.parse(response);
						toastr.warning(res.msg);
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
            txtCounsellingPeriodCode: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }, 
            cmbCounsellingPeriodStatus: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            txtCounsellingPeriodName: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }
		}	
	});
});


// ************************************************** FOR Counselling Period SETUP******************************************
function categoryRow(event,action)
{
	var oTable = $('#tblCounsellingPeriod').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;
	$('#frmCounsellingPeriod').data('bootstrapValidator').resetForm(true);
	$('#hidCounsellingPeriod').val( oTable.fnGetData(row)['counselling_period_code']);
	$('#txtCounsellingPeriodCode').val( oTable.fnGetData(row)['counselling_period_code']);
	$('#txtCounsellingPeriodName').val( oTable.fnGetData(row)['counselling_period_name']);
	$('#cmbCounsellingPeriodStatus').val( oTable.fnGetData(row)['status']);
	
	if(action == 'edit')
	{
		$("#myModalLabelCounsellingPeriod").html("Update Record");
		$("#btnSaveCounsellingPeriod").html("Update");
		$("#txtCounsellingPeriodCode").prop('disabled', true);	
		$('#modalCounsellingPeriod').modal('show');
	}	
	else
	{
		swal({
		  title: "Are you sure?",
		  text: "You want to Delete the Counselling Period!",
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
		    swal("Deleted", "Counselling Period has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Counselling Period is safe ", "error");
		  }
		});
	    function deleteMaster(){ 
			var institutedata=
			{
				hidCounsellingPeriod:$('#hidCounsellingPeriod').val(),
				type:"operation_delete_CounsellingPeriod"
			};	
			type = 'operation_delete_CounsellingPeriod';	
			//ajax call to server
			$.ajax({
				url:base_url+"ajaxcounselling_controller/"+type,
				type:"post",
				data:institutedata,
				success:function(response)
				{  
					var result = JSON.parse(response);	
					if(result.status == true)
					{	
						var tblCounsellingPeriod = $("#tblCounsellingPeriod").DataTable();
		 				tblCounsellingPeriod.ajax.reload();
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
