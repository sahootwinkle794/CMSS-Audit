$(document).ready(function(){
	var isDelete= false;
	var isEdit = false;
	var isPublish = false;
	var oTable;
	var isArchive = false;
	var session = $('#hidSessionCode').val();
	
	
	$('#txtstartdate').datetimepicker({
			useCurrent: false,
			dateFormat: 'dd-mm-yyyy',
			onSelect: function (date) {
            var date2 = $('#txtstartdate').datetimepicker('getDate');
            date2.setDate(date2.getDate() + 1);
            //$('#txtenddate').datetimepicker('option', 'minDate', date2);
            //$('#txtstartdate').datetimepicker('option', 'maxDate', date2);
            $('#actionForm').data('bootstrapValidator').updateStatus('txtstartdate', 'VALID', null);
            
        	}			
	});
	$('#txtenddate').datetimepicker({
			useCurrent: false,
			dateFormat: 'dd-mm-yyyy',
			onSelect: function (date) {
	            var date2 = $('#txtstartdate').datetimepicker('getDate');
	           	// date2.setDate(date2.getDate() + 1);
	          	// $('#txtenddate').datetimepicker('option', 'minDate', '10/01/2022');
	            $('#actionForm').data('bootstrapValidator').updateStatus('txtstartdate', 'VALID', null);
	           
        	}			
	});
	
	$("#txtstartdate").change(function(){	
		checkDateValididty();
	});
	$("#txtenddate").change(function(){	
		checkDateValididty();
	});
	
	
		
	var programAdditional = $('#tblactionmaster').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_actionmaster",
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
						{ "sName": "program_code", "bVisible":false },
						{ "sName": "Program_name", "sWidth": "15%" },
						{ "sName": "action_name", "sWidth": "20%" },
						{ "sName": "start_date", "sWidth": "15%"  },
						{ "sName": "end_date","sWidth": "15%"  },
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
					    { "sName": "checkid","sWidth": "10%","mRender": function( data, type, full ) {
					    		var checkidArr=data.split("&&");
							   	if(checkidArr[1] == '1' )
									{
										return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatus[]" id="checkbox_'+checkidArr[0]+'" value="'+checkidArr[0]+'"  onchange="getcode(event)" checked/><input type="hidden" name="hidCheckEdit[]" value="'+checkidArr[0]+'"/><div class=\"control__indicator\"></div></label>';
								   	}
							   	else
							       {
							         	return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatus[]" id="checkbox_'+checkidArr[0]+'" value="'+checkidArr[0]+'"  onchange="getcode(event)"/><input type="hidden" name="hidCheckEdit[]" value="'+checkidArr[0]+'"/><div class=\"control__indicator\"></div></label>';
							       }					    	
	                    		//return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatus[]" id="checkbox_'+data+'" value="'+data+'"  onchange="getcode(event)"/><input type="hidden" name="hidCheckEdit[]" value="'+data+'"/><div class=\"control__indicator\"></div></label>';
	               		},"sClass":"alignCenter"  },
	               		{ "sName": "round", "bVisible":false },					
						{"sName": "Action","sWidth": "15%", "sClass":"dt-center", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='ActionmasterSetupRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>\
			            <button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='ActionmasterSetupRow(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}
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
		$('#actionForm').data('bootstrapValidator').resetForm(true); 
		$("#hidAction").val('Add');
		$('#cmbProgramName').val("");
		$('#txtactionname').val("");
		$('#txtround').val("");
		$('#txtstartdate').val("");
		$('#txtenddate').val("");
		$('#cmbRecordStatus').val("");
		$("#cmbProgramName").prop('disabled', false);
		$("#txtactionname").prop('disabled', false);
		$("#myModalLabel").html("Add Action Master"); 
		$("#programaddsave").html("<i class='fa fa-save'></i>  Add");
		$('#actionmodal').modal('show');
		$('#actionmodal').on('shown.bs.modal', function()
		{  
			$('#cmbProgramName').focus();// Focusing the textbox
		})	
	});
	
	/*****AJAX CALL TO GET DATA FROM DATABASE(FOR SELECT OPTIONS)**********/
	// get program name from database
	$.ajax({
		url:base_url+"ajax_controller/select_programname",
		type:"post",
		success:function(response){  
			var options = "<option selected disabled value=''>Select Program Name</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value='"+data.program_code+"'>"+data.program_name+"</option>";
				
			});
			$('#cmbProgramName').html("");   //campusid from academicPeriod
			$('#cmbProgramName').append(options);
				
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	}); 
	
	// get Action name from database
	$.ajax({
		url:base_url+"ajax_controller/select_action_name",
		type:"post",
		success:function(response){ 
			var options = "<option selected disabled value=''>Select Action Name</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value='"+data.action_name+"'>"+data.action_name+"</option>"; 
				
			});
			$('#txtactionname').html("");   //campusid from academicPeriod
			$('#txtactionname').append(options + "<option value='other' id='other'>Other</option>");
				
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});  
	/////////////////////////////////////////////////////////////
	var element = document.getElementById("actionname2");
    element.style.display = "none";
	
	$("#txtactionname").change(function () {
		var ProgramName = $("#cmbProgramName").val();
		var value = $("#txtactionname").val();
		//alert(ProgramName);
		if(ProgramName == '' || ProgramName == null){
			toastr.error('Please Select Program Name First.');
			//swal("Please Select Program Name First.");
			$('#actionForm').trigger('reset');	
			//window.location.reload();
		}else{
			 
			if(value == 'other'){
				var element = document.getElementById("actionname2");
	        	element.style.display = "block";
	        	/*$('#actionForm').bootstrapValidator({
	        	fields:
		         {
		            txtactionname2: {							//form input type name
		                validators: {
		                    notEmpty: {
		                        message: 'Please enter Action Name'
		                    },
		                   regexp: {
								regexp: /^([A-Za-z0-9& -_\s]+)$/i,
								message: "Special characters are not allowed"
							},
		                }
		            },
		          }	
				});	*/ 
				$('#txtround').val('1');
							
			}else{
				 var element = document.getElementById("actionname2");
	        	 element.style.display = "none";
	        	 
	        	 var cmbProgramName = $("#cmbProgramName").val();
	        	 var txtactionname = $("#txtactionname").val();
	        	 
	        	var institutedata={
					cmbProgramName : cmbProgramName,
					txtactionname : txtactionname
				};	
				$.ajax({
					url:base_url+"ajax_controller/get_action_round_no",
					type:"post",
					data:institutedata,
					success:function(response)
					{  
						var result = JSON.parse(response);
						//console.log(result);
						//alert(result[0].round);
						$('#txtround').val(result); 
					},
					error:function()
					{
						toastr.error('Unable to process please contact support');
					}
				});	
			}
		}		
	});
	
	
	
	//ADD/UPDATE RECORD WITH VALIDATION	
	$('#actionForm').bootstrapValidator({
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
			var formData = new FormData(document.getElementById("actionForm"));
			
			var oper = $("#hidAction").val();
			//ajax call to server
			if(oper == 'Add')
				oper = 'Add_actionmaster_setup';
			else if(oper == 'Update')
				oper = 'Update_actionmaster_setup'; 
				
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
						var tblactionmaster = $("#tblactionmaster").DataTable();
			 			tblactionmaster.ajax.reload();
			 			$('#actionForm').data('bootstrapValidator').resetForm(true);	
						toastr.success(res.msg);
						if(oper != 'Add_actionmaster_setup')
						{
							$('#actionmodal').modal('hide');
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
            cmbProgramName: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Please Select Program Name'
                    }
                }
            },
            txtactionname: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Please enter Action Name'
                    },
                   regexp: {
						regexp: /^([A-Za-z0-9& -_\s]+)$/i,
						message: "Special characters are not allowed"
					},
                }
            },
            txtactionname2: {							//form input type name
                validators: {
                    /*notEmpty: {
                        message: 'Please enter Action Name'
                    },*/
                   regexp: {
						regexp: /^([A-Za-z0-9& -_\s]+)$/i,
						message: "Special characters are not allowed"
					},
                }
            },
            txtstartdate: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Please enter start date'
                    }
                }
            },
            txtenddate: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Please enter end date'
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

function checkDateValididty() {
		var  startDate = $("#txtstartdate").val();
		var  endDate = $("#txtenddate").val();
		if(startDate != ''){
	        var startArr = startDate.split(" ");
	        var startDateArr =  startArr[0].split("/");
	        var startTimeArr =  startArr[1].split(":");
	        if(startArr[2] == 'PM'){
				startTimeArr[0] = parseInt(startTimeArr[0])+12;
			}
			// month is 0-based, that's why we need startDateArr[0] - 1
			startDateArr[0] = parseInt(startDateArr[0])-1;
	        // (YYYY, MM, DD, Hr, Min, Sec)
	    	var g1 = new Date(startDateArr[2], startDateArr[0], startDateArr[1], startTimeArr[0], startTimeArr[1], 00);
			//console.log("g1", g1);
		}
    	if(endDate != ''){
	    	var endArr = endDate.split(" ");
	        var endDateArr =  endArr[0].split("/");
	        var endTimeArr =  endArr[1].split(":");
	        if(endArr[2] == 'PM'){
				endTimeArr[0] = parseInt(endTimeArr[0])+12;
			}
			// month is 0-based, that's why we need startDateArr[0] - 1
			endDateArr[0] = parseInt(endDateArr[0])-1;
	        // (YYYY, MM, DD, Hr, Min, Sec)
	    	var g2 = new Date(endDateArr[2], endDateArr[0], endDateArr[1], endTimeArr[0], endTimeArr[1], 00);
	    	//console.log("g2", g2);
	    	if (g1.getTime() > g2.getTime()){
			//document.write("g1 is lesser than g2");
	        toastr.error("End date should be greater than Start date.")
	        $('#txtenddate').val('');
			}
	        
	    }
	} 
function ActionmasterSetupRow(event,action)
{
	var element = document.getElementById("actionname2");
    element.style.display = "none";
    
	var oTable = $('#tblactionmaster').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;
	$('#actionForm').data('bootstrapValidator').resetForm(true);
	$('#hidid').val( oTable.fnGetData(row)['id']);
	$('#cmbProgramName').val( oTable.fnGetData(row)['program_code']);
	$('#txtactionname').val( oTable.fnGetData(row)['action_name']);
	$('#txtround').val( oTable.fnGetData(row)['round']);
	
	$('#txtstartdate').val( moment(oTable.fnGetData(row)['start_date']).format('MM/DD/YYYY hh:mm A'));
	//$('#txtstartdate').data("DateTimePicker").setValue('2020-05-03')
	$('#txtenddate').val( moment(oTable.fnGetData(row)['end_date']).format('MM/DD/YYYY hh:mm A'));
	$('#cmbRecordStatus').val( oTable.fnGetData(row)['record_status']);
	$("#hidAction").val('Update');
	if(action == 'edit')
	{
		$("#myModalLabel").html("Update Action Master");
		$("#cmbProgramName").prop('disabled', true);	
		$("#txtactionname").prop('disabled', true);	
		$("#programaddsave").html("<i class='fa fa-save'></i>  Update");	
		$('#actionmodal').modal('show');
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
				type:"delete_actionmaster_Setup"
			};	
			type = 'delete_actionmaster_Setup';	
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
						var tblactionmaster = $("#tblactionmaster").DataTable();
		 				tblactionmaster.ajax.reload();
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

function getcode(event)
{
	//$.each($("input[name='chkStatus[]']:checked"), function() {
	//$("[name='chkStatus[]']").change(function () {
		var checkedvalue= "#"+event.target.id;
		var checkedvalue2= event.target.value;
		//if ($('input[name="chkStatus[]"][type=checkbox]:checked')){ 
		if ($(checkedvalue).prop('checked')==true){ 
			swal({
			  title: "Are you sure?",
			  text: "You want to Show the data in Home Page",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Yes",
			  cancelButtonText: "No",
			  closeOnConfirm: false,
			  closeOnCancel: true
			},
			function(isConfirm){
			  if (isConfirm) {
		
		        //alert(checkedvalue2); 
		        var institutedata={
					show_status : checkedvalue2,
					type:"add_checked_value"
					};	
				type = 'add_checked_value';	
					//ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/"+type,
					type:"post",
					data:institutedata,
					success:function(response)
					{  
						//alert(response);
						//console.log(response);
						var result = JSON.parse(response);	
						if(result.status == true)
						{	
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
			
				swal("Succeed", "Data is set successfully.", "success");
			  } else {
			  		$(checkedvalue).prop('checked', false);
				    swal("Cancelled", "Data is not set ", "error");
			  }
			});
	    } else if($(checkedvalue).prop('checked')==false){
			swal({
			  title: "Are you sure?",
			  text: "You don't want to Show the data in Home Page",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Yes",
			  cancelButtonText: "No",
			  closeOnConfirm: false,
			  closeOnCancel: true
			},
			function(isConfirm){
			  if (isConfirm) {
		
		        //alert(checkedvalue2); 
		        var institutedata={
					show_status : checkedvalue2,
					type:"remove_checked_value"
					};	
				type = 'remove_checked_value';	
					//ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/"+type,
					type:"post",
					data:institutedata,
					success:function(response)
					{  
						//alert(response);
						//console.log(response);
						var result = JSON.parse(response);	
						if(result.status == true)
						{	
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
			
				swal("Succeed", "Data unset successfully.", "success");
			  } else {
			  		$(checkedvalue).prop('checked', true);
				    swal("Cancelled", "Data is not changed ", "error");
			  }
			});
		}
}


/*$("#chkAll").change(function () {
	if($('#chkAll').is(":checked"))
	{
		$('input[name="chkStatus[]"]').each( function () {
		 	$(this).prop('checked', true);
		});
	}
	else
	{
		$('input[name="chkStatus[]"]').each( function () {
		 	$(this).prop('checked', false);
		});
	}
	 
});*/
     