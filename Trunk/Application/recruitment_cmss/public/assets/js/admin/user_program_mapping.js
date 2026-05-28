$(document).ready(function(){
	var isDelete= false;
	var isEdit = false;
	var isPublish = false;
	var oTable;
	var isArchive = false;
	var session = $('#hidSessionCode').val();
	
	
	var programAdditional = $('#tbluserprogrammapping').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_user_program_mapping_data",
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
						{ "sName": "user_program_mapping_id", "bVisible":false }, 
						{ "sName": "user_code", "sWidth": "10%" },
						{ "sName": "user_name", "sWidth": "10%" },
						{ "sName": "program_code", "bVisible":false },					
						{ "sName": "program_name", "sWidth": "10%" },					
						/*{"sName": "Action","sWidth": "10%", "sClass":"dt-center", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='ProgramGeneralinfoSetup(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>\
			            <button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='ProgramGeneralinfoSetup(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}*/
			            {"sName": "Action","sWidth": "10%", "sClass":"dt-center", "sDefaultContent": "<button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='UserprogrammappingSetup(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}
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
		//$('#userprogrammapingForm').data('bootstrapValidator').resetForm(true); 
		$("#hidAction").val('Add');
		$('#cmbadmin').val("");
		$("#cmbadmin").prop('disabled', false);
		$("#myModalLabel").html("Add User Program Mapping"); 
		$("#programaddsave").html("<i class='fa fa-save'></i>  Add");
		$('#program_modal').modal('show');
		$('#program_modal').on('shown.bs.modal', function()
		{  
			$('#cmbadmin').focus();// Focusing the textbox
		})	
	});
	
	/*****AJAX CALL TO GET DATA FROM DATABASE(FOR SELECT OPTIONS)**********/
	// get Drive name from database
	$.ajax({
		url:base_url+"ajax_controller/select_Admin_user",
		type:"post",
		success:function(response){ 
			var options = "<option selected disabled value=''>Select Admin</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value='"+data.user_code+"'>"+data.user_name+"</option>"; 
				
			});
			$('#cmbadmin').html("");   //campusid from academicPeriod
			$('#cmbadmin').append(options);
				
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});  
	
	var programAdditional2 = $('#dtblSelectedProgramName').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_program_name",
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
		//"sDom":"<'row'<'col-xs-4 addAdditionalbtn'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-7'> <'col-xs-5' i>>><'col-xs-3'p>>",
		//"sDom":"<'row'<'col-xs-4 addAdditionalbtn'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-7 addcheckbtn'> <'col-xs-5' i>>><'col-xs-3'p>>",
		//"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addAdditionalbtn' >>><'col-xs-6'p>>", 
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addbuttonCode2' >>><'col-xs-6'p>>", 
		"aoColumns": [
					    { "sName": "sl_no","sWidth": "1%"},
					    /*{ "sName": "document_code","bVisible":false,"mRender": function( data, type, full ) {
	                    	return '<input type="hidden" class= "form-control" name="txtDocument[]" value="">';
	               		} },*/
						{ "sName": "id", "bVisible":false },
						{ "sName": "program_code", "bVisible":false },
						{ "sName": "program_name","sWidth":"20%" ,"mRender": function( data, type, full ) {
	                    	return data+'<input type="hidden" name="program_name[]" value="'+data+'">';
	               	    }},
						//{ "sName": "program_name", "sWidth": "15%" },
	               		{ "sName": "check_programcode","sWidth": "5%","mRender": function( data, type, full ) {
				   			
								return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusSingle[]"  value="'+data+'"  onclick="getCodeUpdate()"/><div class=\"control__indicator\"></div></label>';
								getCodeUpdate(); 							
	               		},"sClass":"alignCenter"  }
        ],
        /*"fnDrawCallback": function(oSettings, json) 
       	{
     		getCodeUpdate();
  		}*/
	}); 
	//$("div.addbuttonCode2").html('<button id="btnUpdateCentreMultiple" class="btn btn-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Assign</button>&nbsp;</div>');
	
	$("#chkSelectedUpdateAll").change(function () {
		if($('#chkSelectedUpdateAll').is(":checked"))
		{
			$('input[name="chkStatusSingle[]"]').each( function () {
			 	$(this).prop('checked', true);
			});
		}
		else
		{
			$('input[name="chkStatusSingle[]"]').each( function () {
			 	$(this).prop('checked', false);
			});
		}
		 
	});
	
	/*function getCodeUpdate()
	{
	    if($('input[name="chkStatusSingle[]"][type=checkbox]').length == 0)
		{
			 $('#chkSelectedUpdateAll').prop('checked', false);
		}
		else
		{
			if ($('input[name="chkStatusSingle[]"][type=checkbox]:checked').length == $('input[name="chkStatusSingle[]"][type=checkbox]').length) 
		    {
		        $('#chkSelectedUpdateAll').prop('checked', true);
		    } 
		    else 
		    {
		        $('#chkSelectedUpdateAll').prop('checked', false);
		    }
	    }
	}*/
	
	//ADD/UPDATE RECORD WITH VALIDATION	
	$('#userprogrammapingForm').bootstrapValidator({
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
			//var program_codes = $("#cmbadmin").val();
			//var program_codes = serealizeSelects($('.cmbadmin'));
			//alert(program_codes);
			
			/*var program_codes = $("#cmbadmin").val();
			alert(program_codes); 
			if(program_codes == '')
			{
				toastr.error('Please Select a Admin');
			}
			else
			{			
				var arr_program_name = new Array();
			    $('input[name="program_name[]"]').each(function(){
			        var program_name1 = $(this).val();
			        arr_program_name.push(program_name1);
			    });
				
				var arr_cnt = 0;
				var arr_show_status = new Array();
			    $('input[name="chkStatusSingle[]"]').each(function(){
			        if($(this).is(':checked')){
			        	var show_status1 = $(this).val();
						arr_show_status.push(show_status1);
						arr_cnt++;
					}
					else
					{
						arr_show_status.push(0);
					}
			        
			    });	
			    if(arr_cnt == 0)
			    {
					toastr.error('Please Select atleast one Program');
				}
				else
				{
					var institutedata={
						program_codes : program_codes, 
						//centre_code : arr_centre_code,
						program_name : arr_program_name,
						//centre_name : arr_centre_name,
						show_status : arr_show_status
					};
					//alert(institutedata);
					$.ajax({
					    url:base_url+"ajax_controller/Add_user_program_maping_setup",
					    type:"post",
					    data:institutedata,
					    success:function(response)
					    {  					
					    	var result = JSON.parse(response);
							if(result.status=='SUCCESS')
							{
								alert(result);
								toastr.success(result.msg);  
								var dtblExamCentreAdd = $('#tblCenterAdd').DataTable();
								dtblExamCentreAdd.ajax.reload();
							var dtblExamCentreSingle = $('#tblCenterMaster').DataTable();
							dtblExamCentreSingle.ajax.reload();
								$("#cmbProgramMultiple option:selected").removeAttr("selected");
								$('#cmbProgramMultiple').multiselect('refresh');
								$("#chkAll").prop('checked', false);
								
							}
							else
							{
								toastr.error(result.msg);
							}
					    },
					    error:function()
					    {
					     	toastr.error('We are unable to process please contact support'); 
					    }
				   }); 
				}			
			}*/
			
			var formData = new FormData(document.getElementById("userprogrammapingForm"));
			console.log(formData);		
			var oper = $("#hidAction").val();
			//ajax call to server
			if(oper == 'Add')
				oper = 'Add_user_program_maping_setup';
			else if(oper == 'Update')
				oper = 'Update_user_program_maping_setup'; 
				
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
						var tbluserprogrammapping = $("#tbluserprogrammapping").DataTable();
			 			tbluserprogrammapping.ajax.reload();
			 			$('#userprogrammapingForm').data('bootstrapValidator').resetForm(true);	
						toastr.success(res.msg);
						if(oper != 'Add_user_program_maping_setup')
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
            cmbadmin: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Please Select Admin'
                    }
                }
            },     
		}	
	});	
	
	////////////////////////////////////////////////////
		
});

function serealizeSelects(select)
{
    var array = [];
    select.each(function(){ array.push($(this).val()) });
    return array;
}

function UserprogrammappingSetup(event,action)
{
	var oTable = $('#tbluserprogrammapping').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;
	$('#userprogrammapingForm').data('bootstrapValidator').resetForm(true);
	$('#hidid').val( oTable.fnGetData(row)['user_program_mapping_id']);
	$('#cmbadmin').val( oTable.fnGetData(row)['user_code']);
	// $('#cmbRecruitmentType').trigger('change');
	//change_cmbRecruitmentType(oTable.fnGetData(row)['program_code']);
	//$('#cmbProgramName').val( oTable.fnGetData(row)['program_code']);
	//$("#hidAction").val('Update');
	/*if(action == 'edit')
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
	{*/
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
				type:"Delete_user_program_maping_setup" 
			};	
			type = 'Delete_user_program_maping_setup';	
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
						var tbluserprogrammapping = $("#tbluserprogrammapping").DataTable();
		 				tbluserprogrammapping.ajax.reload();
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
	/*}*/		
}


function getCodeUpdate()
{
    if($('input[name="chkStatusSingle[]"][type=checkbox]').length == 0)
	{
		 $('#chkSelectedUpdateAll').prop('checked', false);
	}
	else
	{
		if ($('input[name="chkStatusSingle[]"][type=checkbox]:checked').length == $('input[name="chkStatusSingle[]"][type=checkbox]').length) 
	    {
	        $('#chkSelectedUpdateAll').prop('checked', true);
	    } 
	    else 
	    {
	        $('#chkSelectedUpdateAll').prop('checked', false);
	    }
    }
}



    