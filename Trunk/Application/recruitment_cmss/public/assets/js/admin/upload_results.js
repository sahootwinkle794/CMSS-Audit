$(document).ready(function()
{
	var isDelete= false;
	var isEdit = false;
	var session = $("#hidSession").val();
	
	$("#btnPublishResult").hide();
	$("#btnAddCodeGroup").hide();
	$("#btnUploadReport").hide();
	
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
	$('#cmbProgramGroup').change(function()
	{
		var program_group = $("#cmbProgramGroup").val();
		/*if(program_group != '' && program_type != '')
		{*/
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
		//}
	});
	$('#cmbProgram').change(function()
	{
		var institutedata = {
			program_code : $("#cmbProgram").val()
		}
		$.ajax({
			url:base_url+"/ajax_controller/get_round_no",
			type:"post",
			data:institutedata,
			success:function(response)
			{  
				var options = "<option value =''>Select Round</option>";					
				var res1 = JSON.parse(response);					
				$.each(res1.aaData,function(i,data)
				{
					options = options + "<option value='"+data.round_no+"'>"+data.round_no+"</option>";
				});
				$('#cmbRound').html("");   
				$('#cmbRound').append(options);
			},
			error:function()
			{
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	});
	$('#btnFilter').click(function()
	{
		if($('#cmbProgramGroup').val() == '' || $('#cmbProgramGroup').val() == null)
		{
			toastr.error("Please Select Recruitment Drive");
		}
		else if($('#cmbProgram').val() == '' || $('#cmbProgram').val() == null)
		{
			toastr.error("Please Select Post");
		}
		else if($('#cmbRound').val() == '' || $('#cmbRound').val() == null)
		{
			toastr.error("Please Select Round");
		}
		else
		{
			var institutedata = {
				program:$('#cmbProgram').val(),
				round_data:$('#cmbRound').val()
			};
			var dtblApplicationDetailTable = $('#dtblApplicationDetail').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/select_resultDetails",
					"type": "POST",
					"data": institutedata
				}, 
				"bPaginate": true,
		        "bLengthChange": true,
		        "bFilter": true,
		        "bSort": true,
		        "bInfo": true,
		        "bAutoWidth": false,
		        "bDestroy": true,
		        "initComplete": function(settings, json) {
				    var arr_publish_status = new Array();
				    $('input[name="publishStatus[]"]').each(function(){
				        var publishStatus = $(this).val();
				        arr_publish_status.push(publishStatus);
				    });
				    var publish_status = arr_publish_status.includes("YES");
				    if(!publish_status)
				    {
						$("#btnPublishResult").show();
						$("#btnAddCodeGroup").hide();
						$("#btnUploadReport").show();
					}
					else
					{
						$("#btnPublishResult").hide();
						$("#btnAddCodeGroup").hide();
						$("#btnUploadReport").hide();
					} 
				},
				"sDom":"<'row'<'col-xs-4' i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-5' >>><'col-xs-3'p>>",
				"aoColumns": [
			                   { "sName": "sl_no","sWidth": "1%" },
		                       { "sName": "applicant_name","sWidth": "15%" },
		                       { "sName": "applicant_id","sWidth": "15%" ,"mRender": function( data, type, full ) {
			                    	var roll_no = data;
			                    	return roll_no+'<input type="hidden" class= "form-control" name="hidRollNo[]" value="'+roll_no+'">';
			               		} },
		                       { "sName": "appl_no","sWidth": "55%","mRender": function( data, type, full ) {
			                    	var appl_no = data;
			                    	return appl_no+'<input type="hidden" class= "form-control" name="hidApplNo[]" value="'+appl_no+'">';
			               		} },
		                       { "sName": "field","sWidth": "10%","sClass": "alignCenter","mRender": function( data, type, full ) {
			                    	var data_value = data.split('@');
			                    	var value = data_value[0];
			                    	var status = data_value[1];
			                    	return '<input type="text" class= "form-control" name="txtRank[]" maxlength ="5" onkeypress="return isNumberKey(event)" readonly="" value="'+value+'"><input type="hidden" class= "form-control" name="hidAmt[]" value="'+value+'"><input type="hidden" class= "form-control" id="publishStatus" name="publishStatus[]" value="'+status+'">';
			               		} },
			               		{ "sName": "value","sClass":"alignCenter","sWidth": "15%","mRender": function( data, type, full ) {
								   		var field_status = data;
								   		var str = '';
								   		str += '<input type="text" class= "form-control" value="'+field_status+'" readonly>';
								   		//var desc_list = field_status[0].split(',');
								   		/*var desc_list = [
										    "Select",
										    "Selected",
										    "Not Selected"
										];
										var code_list = [
										    "",
										    "Selected",
										    "Not Selected"
										];
				                    	//var str = '<select class="form-control tooltips" name="cmbStatus[]">';
				                    	var str = '';
				                    	//return '<input type="text" class= "form-control" value="'+desc_list[i]+'">';
			                    		for(var i=0; i<desc_list.length; i++)
			                    		{
											if(code_list[i] == field_status){
												str += '<input type="text" class= "form-control" value="'+desc_list[i]+'" readonly>';
											}
										}*/
			                    		str += '';
			                    		//str += '</select>';
			                    		return str;
			               			} 
			               		}
		        ],
				buttons: [{
								extend: 'excelHtml5',
								text: '<button class="btn btn-success" title = "Export"><i class="fa fa-file-excel-o" style="color:white"></i> Export to Excel</button>',
								filename:'Results',
								header:true,
								title:'Results',
						}],

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
		
		
		
	});
	
	$('#btnUploadReport').click(function(){
		//alert("hello");
		if($('#cmbProgram').val() == '' || $('#cmbProgram').val() == null)
		{
			toastr.error("Please Select Post");
		}
		else if($('#cmbRound').val() == '' || $('#cmbRound').val() == null)
		{
			toastr.error("Please Select Round");
		}
		else
		{	var institutedata = {
				program:$('#cmbProgram').val(),
				round_data:$('#cmbRound').val()
			};
			$.ajax({
			   	url:base_url+"/ajax_controller/save_result",
			    type:"post",
			    data:institutedata,
			    success:function(response)
			    {  	
			    
			    	var res = JSON.parse(response); 
					if(res.status == "SUCCESS"){
						var dtblApplicationDetail = $("#dtblApplicationDetail").DataTable();
			 			dtblApplicationDetail.ajax.reload();
						toastr.success(res.msg);
					} 
					else
					{
						var res = JSON.parse(response);
						toastr.error(res.msg);	
					}
			    	//programcategoryTable.ajax.reload();
			    },
			    error:function()
			    {
			     	toastr.error('We are unable to process please contact support'); 
			    }
		   }); 
		}
	});
	var oTable;
	var institutedata = {
		program:$('#cmbProgram').val(),
		program_group:$('#cmbProgramGroup').val(),
	};
	var dtblApplicationDetailTable = $('#dtblApplicationDetail').dataTable({
		
		//"sAjaxSource": base_url+"/ajax_controller/select_applns",
		/*"ajax":
		{
			"url": base_url+"/ajax_controller/select_resultDetails",
			"type": "POST",
			"data": institutedata
		}, */
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
	    "bDestroy": true,
		"sDom":"<'row'<'col-xs-4' i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-5' >>><'col-xs-3'p>>",
		"aoColumns": [
	                   { "sName": "sl_no","sWidth": "1%" },
                       { "sName": "applicant_name","sWidth": "15%" },
                       { "sName": "applicant_id","sWidth": "15%" ,"mRender": function( data, type, full ) {
	                    	var roll_no = data;
	                    	return roll_no+'<input type="hidden" class= "form-control" name="hidRollNo[]" value="'+roll_no+'">';
	               		} },
                       { "sName": "appl_no","sWidth": "55%","mRender": function( data, type, full ) {
	                    	var appl_no = data;
	                    	return appl_no+'<input type="hidden" class= "form-control" name="hidApplNo[]" value="'+appl_no+'">';
	               		} },
                       { "sName": "field","sWidth": "10%","sClass": "alignCenter","mRender": function( data, type, full ) {
	                    	var data_value = data.split('@');
	                    	var value = data_value[0]
	                    	var status = data_value[1]
	                    	return '<input type="text" class= "form-control" name="txtRank[]" value="'+value+'"><input type="hidden" class= "form-control" name="hidAmt[]" value="'+value+'"><input type="hidden" class= "form-control" id="publishStatus" name="publishStatus[]" value="'+status+'">';
	               		} },
	               		{ "sName": "value","sClass":"alignCenter","sWidth": "15%","mRender": function( data, type, full ) {
						   		var field_status = data;
						   		var str = '';
								str += '<input type="text" class= "form-control" value="'+field_status+'" readonly>';
	                    		return str;
	               			} 
	               		}
        ],
		buttons: [{
						extend: 'excelHtml5',
						text: '<button class="btn btn-success" title = "Export"><i class="fa fa-file-excel-o" style="color:white"></i> Export to Excel</button>',
						filename:'Results',
						header:true,
						title:'Results',
				}],

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
	/*$("div.addbuttonCode").html("<button id='btnAddCodeGroup' class='btn btn-info btn-circle tooltips' title='Add Center'><i class='fa fa-plus'></i></button>");	*/
	$('#btnAddCodeGroup').click(function()
	{
		var arr_cnt = '0';
		var arr_amt = new Array();
	    $('input[name="txtRank[]"]').each(function(){
	        var amt = $(this).val();
			if(amt == '')
			{
				arr_amt.push('');
			}
			else
			{
				arr_amt.push(amt);
				arr_cnt++;
			}
			
	    });	
     	/*var arr_field_status = new Array();
	    $('select[name="cmbStatus[]"]').each(function(){
	        var field_status = $(this).val();
	        arr_field_status.push(field_status);
	    });*/
	    var arr_appl_no = new Array();
	    $('input[name="hidApplNo[]"]').each(function(){
	        var category_code = $(this).val();
	        arr_appl_no.push(category_code);
	    });
    	 if(arr_cnt == 0)
	    {
			toastr.error("Please Update atleast One Mark");
		}
		else
		{
			
		    var institutedata={/*
				status : arr_field_status,*/
				appl_no : arr_appl_no,
				txtRank : arr_amt,
				round_data : $("#cmbRound").val()
			};
			$.ajax({
			   url:base_url+"/ajax_controller/ADD_Result",
			    type:"post",
			    data:institutedata,
			    success:function(response)
			    {  	
			    
			    	var res = JSON.parse(response); 
					if(res.status == "SUCCESS"){
						var dtblApplicationDetail = $("#dtblApplicationDetail").DataTable();
			 			dtblApplicationDetail.ajax.reload();
						toastr.success(res.msg);
					} 
					else
					{
						var res = JSON.parse(response);
						toastr.error(res.msg);	
					} 
			    	//programcategoryTable.ajax.reload();
			    },
			    error:function()
			    {
			     	toastr.error('We are unable to process please contact support'); 
			    }
		   }); 
		}
	});

	$('#btnPublishResult').click(function(){
		
		$('#frmNodalPublish').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#txtAvailableFrom').val("");
		$('#txtAvailableUpto').val("");
		$('#modalPublish').modal('show');
		$("#txtAvailableFrom").datepicker({
			format: "dd-mm-yyyy",
			todayHighlight:true,
			autoclose:true,
			endDate:"+0d"
		}).on('changeDate', function (selected) {
			var startDate = new Date(selected.date.valueOf());
			$('#txtAvailableUpto').datepicker('setStartDate', startDate);
		}).on('clearDate', function (selected) {
			$('#txtAvailableUpto').datepicker('setStartDate', null);
		}).on('change',function () {
			$('#frmNodalPublish').data('bootstrapValidator').updateStatus('txtAvailableFrom', 'NOT_VALIDATED', null).validateField('txtAvailableFrom');
		});
		
		$("#txtAvailableUpto").datepicker({
			format: "dd-mm-yyyy",
			todayHighlight:true,
			autoclose:true
		}).on('changeDate', function (selected) {
			var endDate = new Date(selected.date.valueOf());
			$('#txtAvailableFrom').datepicker('setEndDate', endDate);
			$('#frmNodalPublish').data('bootstrapValidator').updateStatus('txtAvailableUpto', 'NOT_VALIDATED', null).validateField('txtAvailableUpto');
		}).on('clearDate', function (selected) {
			$('#txtAvailableFrom').datepicker('setEndDate', null);
		}).on('change', function () {
			$('#frmNodalPublish').data('bootstrapValidator').updateStatus('txtAvailableUpto', 'NOT_VALIDATED', null).validateField('txtAvailableUpto');
		});
	});
	
	//ADD/UPDATE RECORD WITH VALIDATION	
	$('#frmNodalPublish').bootstrapValidator({
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
			var arr_roll_no = new Array();
		    $('input[name="hidRollNo[]"]').each(function(){
		        var roll_no = $(this).val();
		        arr_roll_no.push(roll_no);
		    });
			var arr_appl_no = new Array();
		    $('input[name="hidApplNo[]"]').each(function(){
		        var category_code = $(this).val();
		        arr_appl_no.push(category_code);
		    });
		    var result = false;
		    if($('input[name=radioAdmitCard]:checked').val() == 'N')
		    {
		    	swal({
					title: "Are you sure",
					text: "You want to end exams?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, End Exam!",
					cancelButtonText: "No, cancel",
					closeOnConfirm: false,
					closeOnCancel: true
				},
				function(isConfirm){
				  	if (isConfirm) {
				  		deleteCode();
				  		$('#modalPublish').modal('hide');
				    	swal("Ended", "Ended exams successfully", "success");
				  	} 
				  	else
				  	{
				  		
				  		$("input:radio[name='radioAdmitCard']").each(function(i) {
						       this.checked = false;
						});
				  		//$(".radioAdmitCard").checked = false;
						$('#frmNodalPublish').data('bootstrapValidator').updateStatus('radioAdmitCard', 'NOT_VALIDATED', null).validateField('radioAdmitCard');
					}
				});
				//var result = confirm('Are you sure, you want to end exams?');
			}
			else
			{
				swal({
					title: "Are you sure",
					text: "You want to continue exams?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, Continue Exams!",
					cancelButtonText: "No, cancel",
					closeOnConfirm: false,
					closeOnCancel: true
				},
				function(isConfirm){
				  	if (isConfirm) {
				  		deleteCode();
				  		$('#modalPublish').modal('hide');
				    	swal("Continued", "Continued exams successfully.", "success");
				  	} 
				  	else
				  	{	
				  		$("input:radio[name='radioAdmitCard']").each(function(i) {
						       this.checked = false;
						});
				  		//$(".radioAdmitCard").checked = false;
						$('#frmNodalPublish').data('bootstrapValidator').updateStatus('radioAdmitCard', 'NOT_VALIDATED', null).validateField('radioAdmitCard');
					}
				});
			}
		    
			function deleteCode()
			{
			    var institutedata={
					appl_no : arr_appl_no,
					arr_roll_no : arr_roll_no,
					txtAvailableFrom : $('#txtAvailableFrom').val(),
					txtAvailableUpto : $('#txtAvailableUpto').val(),
					round_data : $('#cmbRound').val(),
					radioAdmitCard : $('input[name=radioAdmitCard]:checked').val()
				};
				var formData = new FormData(document.getElementById("frmNodalPublish"));
				$.ajax({
					url:base_url+"ajax_controller/publish_result",
					type:"post",
					data:institutedata,
					success:function(response)
					{  
						var res = JSON.parse(response);
						
						if(res.status == "SUCCESS"){
							$('#modalPublish').hide();
							var dtblApplicationDetail = $("#dtblApplicationDetail").DataTable();
				 			dtblApplicationDetail.ajax.reload();
				 			$('#frmNodalPublish').data('bootstrapValidator').resetForm(true);	
							toastr.success(res.dbMessage);
							
						} 
						else
						{
							var res = JSON.parse(response);
							toastr.error(res.dbMessage);
							$('#frmNodalPublish').data('bootstrapValidator').resetForm(true);	
						} 
						
					},
					error:function()
					{
						toastr.error('We are unable to process please contact support');	
					}
				});
			}
		},
        fields:
        {
            txtAvailableFrom: {
                validators: {
					notEmpty: {
						message: 'Required'
					}
				}
			},
			txtAvailableUpto: {
                validators: {
					notEmpty: {
						message: 'Required'
					}
				}
			},
			radioAdmitCard: {
                validators: 
                {
					notEmpty: 
					{
						message: 'Required'
					}
				}
			}
		}	
	});	
	
	$('#frmNodalCentre').bootstrapValidator({
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
			var formData = new FormData(document.getElementById("frmNodalCentre"));
			var oper = $("#btnSaveNodalCentre").html();
			//ajax call to server
			if(oper == 'Add')
				oper = 'ADD_Result';
			else if(oper == 'Update')
				oper = 'UPDATE_Result';
				
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
			 			$('#frmNodalCentre').data('bootstrapValidator').resetForm(true);	
						toastr.success(res.msg);
						if(oper != 'ADD_Result')
						{
							$('#modalNodalCentre').modal('hide');
						}
					} 
					else
					{
						var res = JSON.parse(response);
						toastr.error(res.msg);
						$('#frmNodalCentre').data('bootstrapValidator').resetForm(true);	
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
            txtName: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            txtApplNo: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            txtRollNo: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            txtRank: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
	                integer: {
						message: "Please enter a number"
					}
                }
            },
            cmbResult: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }
		}	
	});	
	
	
	$("#cmbStatus").change(function()
	{
		if($("#cmbStatus").val() == 'only_registered'){
			$("#cmbProgram").hide();
			$("#cmbProgramGroup").hide();
			$("#cmbPrograml").hide();
			$("#cmbProgramGroupl").hide();
		}
		else{
			$("#cmbProgram").show();
			$("#cmbProgramGroup").show();
			$("#cmbPrograml").show();
			$("#cmbProgramGroupl").show();
		}
	});
	
	/*$("#btnFilter").click(function()
	{
		var program = $("#cmbProgram").val();
		var program_group = $("#cmbProgramGroup").val();
		var reg_user_id = $("#txtMobileNo").val();
		//if($("#cmbStatus").val() != 'only_registered'){
			
			if((program =='' || program ==null))
			{
				toastr.error("Please Select a Program");
			}
			else if((program_group =='' || program_group ==null) )
			{
				toastr.error("Please Select a Program Group");
			}
			else
			{
				var data = {
					program:program,
					program_group:program_group,
					reg_user_id:reg_user_id,
					_s:session
				};
				$.ajax({
					url: base_url+"/ajax_controller/select_dms_applns",
					type:"post",
					data:data,
					success:function(response)
					{  
						data = jQuery.parseJSON(response);
						dtblApplicationDetailTable.fnClearTable();
						if (data.aaData.length)
						dtblApplicationDetailTable.fnAddData(data.aaData);
						dtblApplicationDetailTable.fnDraw();		
					},
					error:function()
					{
						toastr.error("We are unable to Process.Please contact Support");
					}
				});
				
			}
		//}
	});*/
	
	$("#txtPaymentDate").datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
		endDate:"+0d"
    });
    $('.tooltips').tooltipster({
		theme: 'tooltipster-punk',
		animation: 'grow',
        delay: 200, 
        touchDevices: false,
        trigger: 'hover'
    });	
    /* CODE FOR TOASTR */
	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "progressBar": false,
	  "positionClass": "toast-bottom-right",//top-right,bottom-left,top-left,top-full-width,bottom-full-width,top-center,bottom-center
	  "onclick": null,
	  "showDuration": "20000",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	} 
});
function program(){
	var program_group = $("#cmbProgramGroup").val();
	var program_type = $("input[name=radioProgramType]:checked").val();
		
	var institutedata = {
		program_type:program_type,
		program_group:program_group,
	};
	$.ajax({
		url:base_url+"/ajax_controller/select_program_manage_app",
		type:"post",
		data:institutedata,
		success:function(response)
		{  
			var options = "<option value =''>Select Program</option>";					
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
}
function load_result_table()
{
	var dtblApplicationDetail = $("#dtblApplicationDetail").DataTable();
	dtblApplicationDetail.ajax.reload();
}
	function load_table(program,program_group)
{
	var data = {
		program:program,
		program_group:program_group
	};
	$.ajax({
		url:base_url+"/ajax_controller/select_dms_applns",
		type:"POST",
		data:data,
		success:function(response)
		{  				
			var res1 = JSON.parse(response);					
			var table = $('#dtblApplicationDetail').DataTable();
			table.clear().draw();
			table.rows.add(res1.aaData).draw();	
		},
		error:function()
		{
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
}
function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode != 46 && charCode > 31 
			&& (charCode < 48 || charCode > 57))
			return false;

		return true;
	}
function rowApplication(event,action)
{
	var session = $("#hidSession").val();
	var oTable = $('#dtblApplicationDetail').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});		
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I" || event.target.tagName == "SPAN")
		row = event.target.parentNode.parentNode.parentNode;
	var record_id = oTable.fnGetData( row )[0];
    var reg_user_id = oTable.fnGetData( row )[2];//GETTING Applicant Mobile No.
    var appl_no = oTable.fnGetData( row )[3];//GETTING Applicant Mobile No.
    var ins_code = oTable.fnGetData( row )[4];//GETTING Applicant Mobile No.
    //var appl_no = oTable.fnGetData( row )[7];//GETTING Applicant Mobile No.
    //var program_code = oTable.fnGetData( row )['program_code'];//GETTING Applicant Mobile No.
    
    
   var institutedata=
	{
		appl_no:appl_no,
		reg_user_id : reg_user_id,
		ins_code : ins_code,
		program_code:$("#cmbProgram").val()
	};	
	$.ajax({
		url:base_url+"/ajax_controller/get_dms_modal_data",
		type:"post",
		data : institutedata,
		success:function(response){  
			var res = JSON.parse(response);
			$('#exampleModal').modal('show');
			$("#dataPreview").html(res.html);
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
    
}