$(document).ready(function(){
	var isDelete= false;
	var isEdit = false;
	var isPublish = false;
	var oTable;
	var isArchive = false;
	var session = $('#hidSessionCode').val();
	
	CKEDITOR.replace('txtDeclaration',
    {
    	toolbarCanCollapse: true,
    	toolbarStartupExpanded: false,
    	removePlugins : 'elementspath'
		
	});
	
	var programAdditional = $('#tblgeneralinformation').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_general_information_data",
			"type": "POST",
			"data": ''
		},
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bDestroy":true,
        "bInfo": true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-4 addAdditionalbtn'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-7'> <'col-xs-5' i>>><'col-xs-3'p>>",
		//"sDom":"<'row'<'col-xs-4 addAdditionalbtn'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-7 addcheckbtn'> <'col-xs-5' i>>><'col-xs-3'p>>",
		//"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addAdditionalbtn' >>><'col-xs-6'p>>", 
		"aoColumns": [
						{ "sName": "sl_no", "sWidth": "5%" },
						{ "sName": "id", "bVisible":false },
						{ "sName": "program_group_code", "bVisible":false },
						{ "sName": "program_group_name", "bVisible":false },
						{ "sName": "program_code", "bVisible":false },
						{ "sName": "Program_name", "sWidth": "15%" },
						{ "sName": "declaration", "sWidth": "25%" },
						//{ "sName": "record_status","sWidth": "10%"  },
						{ "sName": "record_status","sWidth": "8%","sClass":"alignCenter",
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
						{"sName": "Action","sWidth": "10%", "sClass":"dt-center", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='ProgramGeneralinfoSetup(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>\
			            <button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='ProgramGeneralinfoSetup(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}
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
	//$("div.addAdditionalbtn").html('<button id="btnAddAdditional" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	$("div.addAdditionalbtn").html('<button class="btn btn-info tooltips btn-circle" title="Add" id="btnAddAdditional"><i class="fa fa-plus" aria-hidden="true"></i></button>');
	//$("div.addcheckbtn").html('<button class="btn btn-info tooltips"  title="Check" id="btnAddCheck"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Check</button>');
	
	//ADD button clicked
	$('#btnAddAdditional').click(function()
	{
		$('#generalinfoForm').data('bootstrapValidator').resetForm(true); 
		$("#hidAction").val('Add');
		$('#cmbRecruitmentType').val("");
		$('#cmbProgramName').val("");
		//$('#txtDeclaration').val("");
		CKEDITOR.instances['txtDeclaration'].setData(" ");
		$('#cmbRecordStatus').val("");
		$("#cmbRecruitmentType").prop('disabled', false);
		$("#cmbProgramName").prop('disabled', false);
		$("#myModalLabel").html("Add Program General Information"); 
		$("#programaddsave").html("<i class='fa fa-save'></i>  Add");
		$('#program_modal').modal('show');
		$('#program_modal').on('shown.bs.modal', function()
		{  
			$('#cmbRecruitmentType').focus();// Focusing the textbox
		})	
	});
	
	/*****AJAX CALL TO GET DATA FROM DATABASE(FOR SELECT OPTIONS)**********/
	// get Drive name from database
	$.ajax({
		url:base_url+"ajax_controller/select_recruitment_drive",
		type:"post",
		success:function(response){ 
			var options = "<option selected disabled value=''>Select Recruitment Type</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value='"+data.program_group_code+"'>"+data.program_group_name+"</option>"; 
				
			});
			$('#cmbRecruitmentType').html("");   //campusid from academicPeriod
			$('#cmbRecruitmentType').append(options);
				
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});  
	
	$('#cmbRecruitmentType').change(function()
	{
		change_cmbRecruitmentType();
	});
	
	//ADD/UPDATE RECORD WITH VALIDATION	
	$('#generalinfoForm').bootstrapValidator({
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
			
			var formData = new FormData(document.getElementById("generalinfoForm"));
			
			if($("#txtDeclaration").val() == '' || $("#txtDeclaration").val() == null)
			{
				toastr.error("Please enter Information");
				$('#generalinfoForm').data('bootstrapValidator').updateStatus('txtDeclaration', 'VALID', null);
				return false;
			}
			
			var oper = $("#hidAction").val();
			//ajax call to server
			if(oper == 'Add')
				oper = 'Add_generalinfo_setup';
			else if(oper == 'Update')
				oper = 'Update_generalinfo_setup'; 
				
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
			 			$('#program_modal').modal('hide');
						var tblgeneralinformation = $("#tblgeneralinformation").DataTable();
			 			tblgeneralinformation.ajax.reload();
			 			$('#generalinfoForm').data('bootstrapValidator').resetForm(true);	
						toastr.success(res.msg);
						if(oper != 'Add_generalinfo_setup')
						{
							$('#program_modal').modal('hide');
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
            cmbRecruitmentType: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Please Select Recruitment Type'
                    }
                }
            },
            cmbProgramName: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Please Select Program Name'
                    }
                }
            },
            txtDeclaration: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Please enter Declaration'
                    },
                   regexp: {
						regexp: /^([A-Za-z0-9& -_\s]+)$/i,
						message: "Special characters are not allowed"
					},
                }
            },
            cmbRecordStatus: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Please Select status'
                    }
                }
            } 
                    
		}	
	});	
	
});

function ProgramGeneralinfoSetup(event,action)
{
	var oTable = $('#tblgeneralinformation').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;
	$('#generalinfoForm').data('bootstrapValidator').resetForm(true);
	$('#hidid').val( oTable.fnGetData(row)['id']);
	$('#cmbRecruitmentType').val( oTable.fnGetData(row)['program_group_code']);
	// $('#cmbRecruitmentType').trigger('change');
	change_cmbRecruitmentType(oTable.fnGetData(row)['program_code']);
	//$('#cmbProgramName').val( oTable.fnGetData(row)['program_code']);
	$('#txtDeclaration').val( oTable.fnGetData(row)['general_info']);
	var general_info = oTable.fnGetData(row)['general_info'];
	CKEDITOR.instances['txtDeclaration'].setData(general_info);
	$('#cmbRecordStatus').val( oTable.fnGetData(row)['record_status']);
	$("#hidAction").val('Update');
	if(action == 'edit')
	{
		$("#myModalLabel").html("Update Program General Information");
		$("#cmbRecruitmentType").prop('disabled', true);	
		$("#cmbProgramName").prop('disabled', true);	
		$("#programaddsave").html("<i class='fa fa-save'></i>  Update");	
		$('#program_modal').modal('show');
		//checkDateValididty();
		//checkDateValididty2();
	}	
	else
	{
		swal({
		  title: "Are you sure?",
		  text: "You want to Delete the Data!",
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
		    swal("Deleted", "Data has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Data is safe ", "error");
		  }
		});
	    function deleteMaster(){ 
			var institutedata=
			{
				hidid :$('#hidid').val(), 
				type:"delete_generalinfo_Setup" 
			};	
			type = 'delete_generalinfo_Setup';	
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
						var tblgeneralinformation = $("#tblgeneralinformation").DataTable();
		 				tblgeneralinformation.ajax.reload();
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

function change_cmbRecruitmentType(cmbRecruitmentType_val='')
{
	var recruitment_type = $("#cmbRecruitmentType").val();
		/*if(program_group != '' && program_type != '')
		{*/
			var institutedata = {
				recruitment_type:recruitment_type,
			};
			$.ajax({
				url:base_url+"/ajax_controller/select_program_name",
				type:"post",
				data:institutedata,
				success:function(response)
				{  
					var options = "<option selected disabled value=''>Select Program Name</option>";					
					var res1 = JSON.parse(response);					
					$.each(res1.aaData,function(i,data)
					{ 
						options = options + "<option value='"+data.program_code+"'>"+data.program_name+"</option>";
					});
					$('#cmbProgramName').html("");   
					$('#cmbProgramName').append(options);	
					if(cmbRecruitmentType_val != '' && cmbRecruitmentType_val != null)
					{
						$('#cmbProgramName').val(cmbRecruitmentType_val);
					}
				},
				error:function()
				{
					alert("We are unable to Process.Please contact Support");
				}
			});
		//}
}


  