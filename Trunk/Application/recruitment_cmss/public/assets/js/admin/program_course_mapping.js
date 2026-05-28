$(document).ready(function(){
	$.ajax({
		url:base_url+"ajax_controller/select_program_data", 
		type:"post",
		success:function(response){  
			var options = "<option value=''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData, function (index, item) {
				options += "<option value='"+item.program_code+"'>"+item.program_name+"</option>";
			});
			$('#cmbProgramFilter').html("");   //campusid from academicPeriod
			$('#cmbProgramFilter').append(options);
			$('#cmbProgram').html("");   //campusid from academicPeriod
			$('#cmbProgram').append(options);
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	var program_code = null;
	if($("#cmbProgram").val() != '')
	{
		program_code = $("#cmbProgram").val();
	}
	var institutedata=
	{
		program_code:program_code
	};	
	var ApplicationDetail = $('#dtblApplicationDetail').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_courseSetup",
			"type": "POST",
			"data": institutedata
		}, 
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bDestroy" : true,
        "bAutoWidth": false,
		/*"sDom":"<'row'<'col-xs-4 addCoursebtnCharge'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-7' <'row'<'col-xs-5' i>>><'col-xs-5'p>>",*/
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addCoursebtnCharge' >>><'col-xs-6'p>>", 
		"aoColumns": [
					{ "sName": "sl_no","sWidth": "5%"},
					{ "sName": "program_code","bVisible": false},
					{ "sName": "course_code","bVisible": false},
					{ "sName": "program_name","sWidth": "10%"},
					{ "sName": "course_name","sWidth": "10%"},
					{ "sName": "total_mark","sWidth": "10%"},
					{ "sName": "date","sWidth": "10%"},
					{ "sName": "timing","sWidth": "10%"},
					{ "sName": "session","sWidth": "10%"},
					{"sName": "default","sWidth": "15%", "sClass":"dt-center", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='CourseSetupRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>\
		            <button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='CourseSetupRow(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}
			            
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
		$('#frmAddProgram')[0].reset();
		$("#hidAction").val("Add_course_setup");
		$('#cmbProgram').val("");
		$('#cmbProgram').prop('disabled', false);
		$("#txtCourseCode").prop('disabled', false);
		$('#txtCourseCode').val("");
		$('#txtCourseName').val("");
		$('#txtExamDate').val("");
		$('#txtMark').val("");
		$('#cmbSession').val("");
		$("#myModalLabel").html("Add Post-Examination");
		$("#programaddsave").html("<i class='fa fa-save'></i>  Add");
		
		$('#programAddModal').modal('show');
		$('#programAddModal').on('shown.bs.modal', function()
		{  
			$('#txtProgramCode').focus();// Focusing the textbox
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
			
			
				oper = $("#hidAction").val();
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
			 			$('#frmAddProgram')[0].reset();
			 			toastr.success(res.msg);
						if(oper != 'Add_course_setup')
						{
							$('#programAddModal').modal('hide');
						}
					} 
					else
					{
						var res = JSON.parse(response);
						
						if(res.status == "validationerror") 
						{
							$('#txtCourseCode').val("");
							$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtCourseCode', 'NOT_VALIDATED', null).validateField('txtCourseCode');
						}
						var activity_data = {
							status : res.status,
							msg : res.msg,
							action : oper
						};
						
						$.ajax({
							url:base_url+"ajax_controller/activity_details",
							type:"post",
							data:activity_data,
							success:function(response)
							{  
								toastr.error(res.msg);
							},
							error:function()
							{
								toastr.error(res.msg);	
							}
							
						});
						
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
            txtCourseCode: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            txtCourseName: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            txtExamDate: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            txtMark: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            cmbSession: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }
		}	
	});	
	
	$("#txtExamDate").datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
    }).on('changeDate', function(e) { 
        $('#frmAddProgram').data('bootstrapValidator').updateStatus('txtExamDate', 'NOT_VALIDATED', null).validateField('txtExamDate');
    });
    
});
function CourseSetupRow(event,action)
{
	var oTable = $('#dtblApplicationDetail').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;
	$('#frmAddProgram').data('bootstrapValidator').resetForm(true);
	$('#frmAddProgram')[0].reset();
	$('#hidUniqueid').val( oTable.fnGetData(row)['program_code']);
	$('#hidUniqueCourseid').val( oTable.fnGetData(row)['id']);
	$('#cmbProgram').val( oTable.fnGetData(row)['program_code']);
	$('#txtCourseCode').val( oTable.fnGetData(row)['course_code']);
	$('#txtCourseName').val( oTable.fnGetData(row)['course_name']);
	$('#txtExamDate').val( oTable.fnGetData(row)['date_of_exam']);
	$('#txtTiming').val( oTable.fnGetData(row)['timing']);
	$('#txtMark').val( oTable.fnGetData(row)['total_mark']);
	$('#cmbSession').val( oTable.fnGetData(row)['session']);
	
	if(action == 'edit')
	{
		$("#hidAction").val("Update_course_setup");
		$("#myModalLabel").html("Update Post-Examination");
		$("#cmbProgram").prop('disabled', true);	
		$("#txtCourseCode").prop('disabled', true);	
		$("#programaddsave").html("<i class='fa fa-save'></i>  Update");	
		$('#programAddModal').modal('show');
	}	
	else
	{
		swal({
		  title: "Are you sure?",
		  text: "You want to Delete the Examination-Post!",
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
		    swal("Deleted", "Examination-Post has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Examination-Post is safe ", "error");
		  }
		});
	    function deleteMaster(){ 
			var institutedata=
			{
				hidUniqueid:$('#hidUniqueid').val(),
				hidUniqueCourseid:$('#hidUniqueCourseid').val(),
				type:"operation_delete_courseSetup"
			};	
			type = 'operation_delete_courseSetup';	
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
						var activity_data = {
							status : result.status,
							msg : result.msg,
							action : type
						};
						
						$.ajax({
							url:base_url+"ajax_controller/activity_details",
							type:"post",
							data:activity_data,
							success:function(response)
							{  
								toastr.error(result.msg);	
							},
							error:function()
							{
								toastr.error(result.msg);	
							}
							
						});
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
function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode != 46 && charCode > 31 
			&& (charCode < 48 || charCode > 57))
			return false;

		return true;
	}