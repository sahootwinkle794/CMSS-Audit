$(document).ready(function(){
	var categCheck  = $('#cmbProgramSelect').multiselect({
	    includeSelectAllOption: true,
	    enableFiltering : true,
		numberDisplayed: 0,
		buttonWidth: '200px'
	});
	
	var categCheckReeval  = $('#cmbProgramSelectReeval').multiselect({
	    includeSelectAllOption: true,
	    enableFiltering : true,
		numberDisplayed: 0,
		buttonWidth: '200px'
	}); 
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
			$('#cmbProgramGroupFee').html("");   
			$('#cmbProgramGroupFee').append(options);
			$('#cmbProgramGroupFeeSingle').html("");   
			$('#cmbProgramGroupFeeSingle').append(options);
			
		},
		error:function()
		{
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$('#cmbProgramGroupFee').change(function()
	{
		var program_group = $("#cmbProgramGroupFee").val();
		var program_type = '';
		/*if(program_group != '' && program_type != '')
		{*/
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
					var options = "<option value =''>Select Post</option>";					
					var res1 = JSON.parse(response);
			        categCheck.empty(); 
					 $.each(res1.aaData, function (index, item) {
			            var opt = $('<option />', {
			                value: item.program_code,
			                text: item.program_name
			            });
			            var opt1 = $('<option />', {
			                value: item.program_code,
			                text: item.program_name
			            });
			           // categCheck.multiselect('destroy');
			            //categCheck.multiselect('clear');
			            opt1.appendTo(categCheck);
			            
			            categCheck.multiselect('rebuild');
			            
					   options = options + "<option value="+item.program_code+">"+item.program_name+"</option>";
		    		});
					
				},
				error:function()
				{
					alert("We are unable to Process.Please contact Support");
				}
			});
		//}
	});
	$('#cmbProgramGroupFeeSingle').change(function()
	{
		var program_group = $("#cmbProgramGroupFeeSingle").val();
		var program_type = '';
		/*if(program_group != '' && program_type != '')
		{*/
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
					var options = "<option value =''>Select Post</option>";					
					var res1 = JSON.parse(response);					
					$.each(res1.aaData,function(i,data)
					{
						options = options + "<option value="+data.program_code+">"+data.program_name+"</option>";
					});
					var opt = "<option value =''>Select Post</option>";
					if(options == ''){
						$('#cmbProgramFilter').html("");   //campusid from academicPeriod
						$('#cmbProgramFilter').append(opt);   
						var program = $("#cmbProgramFilter").val();
						var program_group = $("#cmbProgramGroup").val();
						
					}
					else{
						$('#cmbProgramFilter').html("");   
						$('#cmbProgramFilter').append(options);	
						var program = $("#cmbProgramFilter").val();
						var program_group = $("#cmbProgramGroup").val();
						
						/*if(program !='' || program != null && program_group !='' || program_group != null )
						{*/
							
						//}
					}
					
				},
				error:function()
				{
					alert("We are unable to Process.Please contact Support");
				}
			});
		//}
	});
	$.ajax({
		url:base_url+"ajax_controller/select_program_data", 
		type:"post",
		success:function(response){  
			var options = "<option value=''>Select Post</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData, function (index, item) {
	            var opt = $('<option />', {
	                value: item.program_code,
	                text: item.program_name
	            }); 
	            var opt1 = $('<option />', {
	                value: item.program_code,
	                text: item.program_name
	            });	           
	            opt.appendTo(categCheckReeval);
	            categCheckReeval.multiselect('rebuild');
	            opt1.appendTo(categCheck);
	            categCheck.multiselect('rebuild');
				options += "<option value='"+item.program_code+"'>"+item.program_name+"</option>";
			});
			$('#cmbProgramFilter').html("");   //campusid from academicPeriod
			$('#cmbProgramFilter').append(options);
			$('#cmbProgramFilterReeval').html("");   //campusid from academicPeriod
			$('#cmbProgramFilterReeval').append(options);
			var programReeval = $('#cmbProgramFilterReeval').val();
			program = $('#cmbProgramFilter').val();
			if(program != '')
			{
				var data = {
					program:program
				};
				var programFee = $('#tblProgramFee').dataTable({
					"ajax":
					{
						"url": base_url+"/ajax_controller/get_fee_single",
						"type": "POST",
						"data": data,
					}, 
					"bPaginate": false,
			        "bLengthChange": true,
			        "bFilter": true,
			        "bSort": true,
			        "bInfo": true,
			        "bDestroy" : true,
			        "bAutoWidth": true,
					"sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
					"aoColumns": [
				                    { "sName": "Slno","sWidth": "15%" },
				                    { "sName": "Category","sWidth": "55%","mRender": function( data, type, full ) {
				                    	var category = data.split('`');
				                    	return category[0]+'<input type="hidden" class= "form-control" name="hidCategory[]" value="'+category[1]+'">';
				               		} },
				                    { "sName": "Amount","sWidth": "10%","sClass": "alignCenter","mRender": function( data, type, full ) {
				                    	return '<input type="text" class= "form-control" name="txtAmt[]" maxlength = "5" onkeypress="return isNumberKey(event)" value="'+data+'" maxlength="5" ><input type="hidden" class= "form-control" name="hidAmt[]" value="'+data+'">';
				               		} }
			        			]
				});
			}
			if(programReeval != '')
			{
				var data = {
					program:programReeval
				};
				var programFee = $('#tblProgramFeeReeval').dataTable({
					"ajax":
					{
						"url": base_url+"/ajax_controller/get_fee_single_reeval",
						"type": "POST",
						"data": data,
					}, 
					"bPaginate": false,
			        "bLengthChange": true,
			        "bFilter": true,
			        "bSort": true,
			        "bInfo": true,
			        "bDestroy" : true,
			        "bAutoWidth": true,
					"sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
					"aoColumns": [
				                    { "sName": "Slno","sWidth": "15%" },
				                    { "sName": "Category","sWidth": "55%","mRender": function( data, type, full ) {
				                    	var category = data.split('`');
				                    	return category[0]+'<input type="hidden" class= "form-control" name="hidCategoryReeval[]" value="'+category[1]+'">';
				               		} },
				                    { "sName": "Amount","sWidth": "10%","sClass": "alignCenter","mRender": function( data, type, full ) {
				                    	return '<input type="text" class= "form-control" name="txtAmtReeval[]" maxlength = "5" value="'+data+'"><input type="hidden" class= "form-control" name="hidAmtReeval[]" value="'+data+'">';
				               		} }
			        			]
				});
			}
							
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	/**CREATING BUTTON*****/
	
	$('#cmbProgramFilter').change(function(){
		program = $('#cmbProgramFilter').val();
		//var programFee = $("#tblProgramFee").DataTable();
		var data = {
				program:program
			};
			var programFee = $('#tblProgramFee').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/get_fee_single",
					"type": "POST",
					"data": data,
				}, 
				"bPaginate": false,
		        "bLengthChange": true,
		        "bFilter": true,
		        "bSort": true,
		        "bInfo": true,
		        "bDestroy" : true,
		        "bAutoWidth": true,
				"sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
				"aoColumns": [
			                    { "sName": "Slno","sWidth": "15%" },
			                    { "sName": "Category","sWidth": "55%","mRender": function( data, type, full ) {
			                    	var category = data.split('`');
			                    	return category[0]+'<input type="hidden" class= "form-control" name="hidCategory[]" value="'+category[1]+'">';
			               		} },
			                    { "sName": "Amount","sWidth": "10%","sClass": "alignCenter","mRender": function( data, type, full ) {
			                    	return '<input type="text" class= "form-control" name="txtAmt[]" onkeypress="return isNumberKey(event)" maxlength = "5" value="'+data+'" maxlength="5"><input type="hidden" class= "form-control" name="hidAmt[]" value="'+data+'">';
			               		} }
		        			]
			});
		//programFee.ajax.url(base_url+"/ajax_controller/get_fee_single").load();
	});

	$('#cmbProgramFilterReeval').change(function(){
		program = $('#cmbProgramFilterReeval').val();
		//var programFee = $("#tblProgramFee").DataTable();
		var data = {
				program:program
			};
			var programFee = $('#tblProgramFeeReeval').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/get_fee_single_reeval",
					"type": "POST",
					"data": data,
				}, 
				"bPaginate": false,
		        "bLengthChange": true,
		        "bFilter": true,
		        "bSort": true,
		        "bInfo": true,
		        "bDestroy" : true,
		        "bAutoWidth": true,
				"sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
				"aoColumns": [
			                    { "sName": "Slno","sWidth": "15%" },
			                    { "sName": "Category","sWidth": "55%","mRender": function( data, type, full ) {
			                    	var category = data.split('`');
			                    	return category[0]+'<input type="hidden" class= "form-control" name="hidCategoryReeval[]" value="'+category[1]+'">';
			               		} },
			                    { "sName": "Amount","sWidth": "10%","sClass": "alignCenter","mRender": function( data, type, full ) {
			                    	return '<input type="text" class= "form-control" name="txtAmtReeval[]" maxlength = "5" value="'+data+'"><input type="hidden" class= "form-control" name="hidAmtReeval[]" value="'+data+'">';
			               		} }
		        			]
			});
		//programFee.ajax.url(base_url+"/ajax_controller/get_fee_single").load();
	});
	var programFee = $('#tblProgramFeeAssignReeval').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_fee_assign_all_reeval",
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
		"sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
		"aoColumns": [
						{ "sName": "sl_no","sWidth": "15%"},
						{ "sName": "category_code","bVisible":false,"mRender": function( data, type, full ) {
								return '<input type="hidden" class= "form-control" name="txtfeeCategoryReeval[]" value="'+data+'">';
							} 
						},
						{ "sName": "category_name","sWidth": "55%"},
						{ "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
								var feeAmtId = data.split('`');
								return '<input type="text" class= "form-control" id="txtAmountForFeeReeval'+data+'"   name="txtAmountForFeeReeval[]" value=""><input type="hidden" class= "form-control" name="txtfeeCategoryReeval[]" value="'+data+'">';
							},"sClass":"dt-center"
						}
        			]
	});
	var programFee = $('#tblProgramFeeAssign').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_fee_assign_all",
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
		/*"sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",*/
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addbuttonCode' >>><'col-xs-6'p>>", 
		"aoColumns": [
						{ "sName": "sl_no","sWidth": "15%"},
						{ "sName": "category_code","bVisible":false,"mRender": function( data, type, full ) {
								return '<input type="hidden" class= "form-control" name="txtfeeCategory[]" value="'+data+'">';
							} 
						},
						{ "sName": "category_name","sWidth": "55%"},
						{ "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
								var feeAmtId = data.split('`');
								return '<input type="text" class= "form-control" id="txtAmountForFee'+data+'"   name="txtAmountForFee[]" onkeypress="return isNumberKey(event)" value="" maxlength="5" ><input type="hidden" class= "form-control" name="txtfeeCategory[]" value="'+data+'">';
							},"sClass":"dt-center"
						}
        			]
	});
	$("div.addbuttonCode").html('<button type="button" id="btnUpdateMultiple" class="btn btn-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Assign</button>&nbsp;</div>');
	
	$("#btnUpdateMultiple").click(function()
    {
		
		var program_codes = serealizeSelects($('.cmbProgramSelect'));
		if(program_codes == '')
		{
			toastr.error('Please Select at least One Post');
		}
		else
		{
			var arr_category_code = new Array();
		    $('input[name="txtfeeCategory[]"]').each(function(){
		        var category_code = $(this).val();
		        arr_category_code.push(category_code);
		    });
		    var arr_cnt = '0';
			var arr_amt = new Array();
		    $('input[name="txtAmountForFee[]"]').each(function(){
		        var amt = $(this).val();
				if(amt == '')
				{
					arr_amt.push(0);
				}
				else
				{
					arr_amt.push(amt);
					arr_cnt++;
				}
		    });	
		    if(arr_cnt == 0)
		    {
				toastr.error('Please Specify Any Amount To Atleast One Category');
			}
			else
			{
				var institutedata={
				program_codes : program_codes,
				category_codes : arr_category_code,
				amts : arr_amt
			};
			$.ajax({
			   url:base_url+"ajax_controller/update_multiple_fee", 
			    type:"post",
			    data:institutedata,
			    success:function(response)
			    {  
			    	var res = JSON.parse(response); 
					if(res.status)
					{
						toastr.success(res.msg);  
						var programmenuTable = $('#tblProgramFeeAssign').DataTable();
						programmenuTable.ajax.reload();
						/*var programFee = $("#tblProgramFee").DataTable();
						programFee.ajax.reload();*/
						$("#cmbProgramSelect option:selected").removeAttr("selected");
						$('#cmbProgramSelect').multiselect('refresh');	
						
					}
					else
					{
						toastr.error(res.msg);
						var programmenuTable = $('#tblProgramFeeAssign').DataTable();
						programmenuTable.ajax.reload();
						/*var programFee = $("#tblProgramFee").DataTable();
						programFee.ajax.reload();*/
						$("#cmbProgramSelect option:selected").removeAttr("selected");
						$('#cmbProgramSelect').multiselect('refresh');		
					}	
			    },
			    error:function()
			    {
			     	toastr.error('We are unable to process please contact support'); 
			    }
		  	 }); 
			}
			
		}
    });


	$("#btnUpdateMultipleReeval").click(function()
    {
		
		var program_codes = serealizeSelects($('.cmbProgramSelectReeval'));
		if(program_codes == '')
		{
			toastr.error('Please Select at least One Post');
		}
		else
		{
			var arr_category_code = new Array();
		    $('input[name="txtfeeCategoryReeval[]"]').each(function(){
		        var category_code = $(this).val();
		        arr_category_code.push(category_code);
		    });
			var arr_amt = new Array();
		    $('input[name="txtAmountForFeeReeval[]"]').each(function(){
		        var amt = $(this).val();
				if(amt == '')
				{
					arr_amt.push(0);
				}
				else
				{
					arr_amt.push(amt);
				}
		    });	
			var institutedata={
				program_codes : program_codes,
				category_codes : arr_category_code,
				amts : arr_amt
			};
			$.ajax({
			   url:base_url+"ajax_controller/update_multiple_fee_reeval", 
			    type:"post",
			    data:institutedata,
			    success:function(response)
			    {  
			    	var res = JSON.parse(response); 
					if(res.status)
					{
						toastr.success(res.msg);  
						var programmenuTable = $('#tblProgramFeeAssignReeval').DataTable();
						programmenuTable.ajax.reload();
						var programFee = $("#tblProgramFeeReeval").DataTable();
						programFee.ajax.reload();
						$("#cmbProgramSelectReeval option:selected").removeAttr("selected");
						$('#cmbProgramSelectReeval').multiselect('refresh');	
						
					}
					else
					{
						toastr.error(res.msg);
						var programmenuTable = $('#tblProgramFeeAssignReeval').DataTable();
						programmenuTable.ajax.reload();
						var programFee = $("#tblProgramFeeReeval").DataTable();
						programFee.ajax.reload();
						$("#cmbProgramSelectReeval option:selected").removeAttr("selected");
						$('#cmbProgramSelectReeval').multiselect('refresh');		
					}	
			    },
			    error:function()
			    {
			     	toastr.error('We are unable to process please contact support'); 
			    }
		   }); 
		}
    });
    
	
	$('#btnAddFee').click(function(){
		$('#frmFeeAdd').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#cmbCategory').val("");
		$('#txtAmount').val("");
		$('#feeAddModal').modal('show');
		$('#feeAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtAmount').focus(); // Focusing the textbox
		})
	});

	$("#btnUpdateSingle").click(function()
    {
		var program_code = $("#cmbProgramFilter").val();
		if(program_code == '')
		{
			toastr.error('Please Select a Post');
		}
		else
		{
			var arr_slno = new Array();
		    $('input[name="txtAmt[]"]').each(function(){
		        var slno = $(this).val();
				if(slno == '')
				{
					arr_slno.push(0);
				}
				else
				{
					arr_slno.push(slno);
				}
		    });	
		    var arr_category_code = new Array();
		    $('input[name="hidCategory[]"]').each(function(){
		        var category_code = $(this).val();
		        //alert(studentCode);
		        arr_category_code.push(category_code);
		    });
			//alert(arr_slno);
			var institutedata={
				cmbProgramFilter : program_code,
				cmbCategoryEdit : arr_category_code,
				txtAmountEdit : arr_slno
			};
			$.ajax({
			   url:base_url+"/ajax_controller/update_single_fee",
			    type:"post",
			    data:institutedata,
			    success:function(response)
			    {  	
			    
			    	var res = JSON.parse(response); 
					if(res.status)
					{
						toastr.success(res.msg);
						var programcategoryTable = $('#dtblProgramDocumentSingle').DataTable();
						programcategoryTable.ajax.reload();	
						
					}
					else
					{
						toastr.error(res.msg);
						var programcategoryTable = $('#dtblProgramDocumentSingle').DataTable();
						programcategoryTable.ajax.reload();		
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
    
	
	$("#btnUpdateSingleReeval").click(function()
    {
		var program_code = $("#cmbProgramFilterReeval").val();
		if(program_code == '')
		{
			toastr.error('Please Select a Post');
		}
		else
		{
			var arr_slno = new Array();
		    $('input[name="txtAmtReeval[]"]').each(function(){
		        var slno = $(this).val();
				if(slno == '')
				{
					arr_slno.push(0);
				}
				else
				{
					arr_slno.push(slno);
				}
		    });	
		    var arr_category_code = new Array();
		    $('input[name="hidCategoryReeval[]"]').each(function(){
		        var category_code = $(this).val();
		        //alert(studentCode);
		        arr_category_code.push(category_code);
		    });
			//alert(arr_slno);
			var institutedata={
				cmbProgramFilter : program_code,
				cmbCategoryEdit : arr_category_code,
				txtAmountEdit : arr_slno
			};
			$.ajax({
			   url:base_url+"/ajax_controller/update_single_fee_reeval",
			    type:"post",
			    data:institutedata,
			    success:function(response)
			    {  	
			    
			    	var res = JSON.parse(response); 
					if(res.status)
					{
						toastr.success(res.msg);
						var programcategoryTable = $('#dtblProgramDocumentSingleReeval').DataTable();
						programcategoryTable.ajax.reload();	
						
					}
					else
					{
						toastr.error(res.msg);
						var programcategoryTable = $('#dtblProgramDocumentSingleReeval').DataTable();
						programcategoryTable.ajax.reload();		
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
	
	$('#frmFeeAdd').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			var institutedata={
				cmbProgramFilter:$('#cmbProgramFilter').val(),
				cmbCategory:$('#cmbCategory').val(),
				txtAmount:$('#txtAmount').val(),
				type:"INSERT"
			};
			//ajax call to server
			$.ajax({
				url:"fee_setup_db.php?_s="+session,
				mType:"post",
				data:institutedata,
				success:function(response){  
					var result = JSON.parse(response);
					if(result.dbStatus=='SUCCESS')
					{
						var dtblProgram = $("#tblProgramFee").DataTable();
			 			dtblProgram.ajax.reload();
			 			$('#frmFeeAdd').data('bootstrapValidator').resetForm(true);	
						toastr.success('Data Successfully Inserted');		
					}
					else
					{
						var dtblProgram = $("#tblProgramFee").DataTable();
			 			dtblProgram.ajax.reload();
			 			$('#frmFeeAdd').data('bootstrapValidator').resetForm(true);	
						toastr.error(result.dbMessage);
					}
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields:{
			cmbCategory: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtAmount: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits:{
						message: 'only digits are allowed'
					}
				}
			}		
		}
	});
	function serealizeSelects (select)
	{
	    var array = [];
	    select.each(function(){ array.push($(this).val()) });
	    return array;
	}
	
	// for transaction charge tab
	var chargeMaster = $('#tblTransactionChargeMaster').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_charge",
			"type": "POST",
			"data": ''
		},  
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
		/*"sDom":"<'row'<'col-xs-4 addCoursebtnCharge'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-5' i>>><'col-xs-3'p>>",*/
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addCoursebtnCharge' >>><'col-xs-6'p>>", 
		"aoColumns": [
	                     { "sName": "Slno","sWidth":"5%" },
						 { "sName": "program_code","bVisible":false },
	                     { "sName": "program","sWidth":"20%" },
						 { "sName": "tansaction_charge","sWidth":"15%" },
						 { "sName": "Status","sWidth":"15%" ,"sClass":"alignCenter",
							"mRender": function( data, type, full ) {
						        return '<img src="'+base_url+'public/assets/images/'+ data +'.png" ></img>';
					    }},
						 { "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "10%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEditChallan' onclick='editcharge(event);'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<button id='btnDeleteChallan' title='Delete' class='btn btn-danger tooltipTable btn-circle' onclick='deleteRowcharge(event);'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}
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
	$("div.addCoursebtnCharge").html('<button id="btnAddChallan" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	/**CREATING BUTTON*****/
	/*$("div.addCoursebtnCharge").html('<button class="btn btn-info tooltips btn-circle" title="Add" id="btnAddChallan"><i class="fa fa-plus" aria-hidden="true"></i></button>');*/
	//$("div.institutegroupbutton").html('<div class="btngroup"><button id="btnAddChallan" class="btn btn-info custombtn">Add</button><button class="btn btn-info custombtn" id="btnEditChallan">Edit</button><button class="btn btn-info custombtn" id="btnDeleteChallan">Delete</button></div>');

	/*****END OF BUTTON CREATION******/

	/*****AJAX CALL TO GET DATA FROM DATABASE(FOR SELECT OPTIONS)**********/
	// get template code from database
	var FilterCheck  = $('#cmbProgramCode').multiselect({
	    includeSelectAllOption: true,
	    enableFiltering : true,
		buttonWidth: '450px'
	});
	$.ajax({
		url:base_url+"ajax_controller/select_program_data", 
		type:"post",
		success:function(response){  
			var options = "<option value=''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				var opt = $('<option />', {
	                value: data.program_code,
	                text: data.program_name
	            });
	            opt.appendTo(FilterCheck);
	            FilterCheck.multiselect('rebuild');
			});	
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
			
	
					
/*****END OF AJAX CALL TO GET DATA FROM DATABASE**********/

	$('#btnAddChallan').click(function(){
		$('#frmAddCharge').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		/*$('#cmbProgramCode').val("");*/
		$("#cmbProgramCode option:selected").removeAttr("selected");
		$('#cmbProgramCode').multiselect('refresh');
		$('#txtBankCode').val("");
		$('#txtBankName').val("");
		$('#txtBranchName').val("");
		$('#txtAcNo').val("");
		$('#txtCharge').val("");
		$('#challanAddModal').modal('show');
		$("#hidOperTypeFeeAdd").val("add_fee");
		$('#challanAddModal').on('shown.bs.modal', function () 
		{ 
			$('#cmbProgram').focus(); // Focusing the textbox
		})
	});
	//ADD RECORD WITH VALIDATION

	$('#frmAddCharge').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			var program_codes = serealizeSelects($('.cmbProgramCode'));
			var oper = $("#challanaddsave").html();
			var institutedata={
				programCodes:program_codes,
				txtCharge:$('#txtCharge').val(),
				cmbStatus:$('#cmbStatus').val(),
				hidOperTypeFeeAdd:$('#hidOperTypeFeeAdd').val()
			};
			cmbProgramCode = $('#cmbProgramCode').val();
			
			if(cmbProgramCode=='' || cmbProgramCode==null){
				toastr.error('Please select Post');
				$('#challanaddsave').prop('disabled',false);
				return false;
			}
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_feedata",
				type:"post",
				data:institutedata,
				success:function(response)
				{ 
					var res = JSON.parse(response); 
					if(res.status == 'TRUE' )
					{
						toastr.success(res.msg);
						$("#cmbProgramCode").multiselect("clearSelection");
 						$("#cmbProgramCode").multiselect( 'refresh' );
						var dtblChallan = $("#tblTransactionChargeMaster").DataTable();
			 			dtblChallan.ajax.reload();
			 			$('#frmAddCharge').data('bootstrapValidator').resetForm(true);	
						//$('#ChallanAddModal').modal('hide');	
					 	if(oper != 'Add')
					 	{
							$('#ChallanAddModal').modal('hide');
						}
					}
					else if(res.status === 'validationerror'){
	                	$('#errorlogResource').html(res.msg);
	                	$('#errorlogResource').show();
	                }
	                else if(res.status === 'xsserror'){
	                	$('#errorlogResource').html(res.msg);
	                	$('#errorlogResource').show();
	                }
					else{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}
					
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			cmbProgram: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtBankCode: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtBankName: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtBranchName: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtAcNo: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtCharge: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					digits:{
						message: 'Only numbers are allowed'
					}
				}
			},
			cmbStatus: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
		}
	} );
	//END OF ADD RECORD WITH VALIDATION


	function serealizeSelects (select)
	{
	    var array = [];
	    select.each(function(){ array.push($(this).val()) });
	    return array;
	}

	/****DELETE RECORD DELETE********/
	
	 
	$('#txtStartdate').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true
    });
    $('#txtEnddate').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true
    });
    $('#txtStartdateEdit').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true
    });
    $('#txtEnddateEdit').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true
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
	/* END OF CODE FOR TOASTR*/	
});
function editcharge(event)
{
	var oTable = $('#tblTransactionChargeMaster').dataTable();
	$("#hidOperTypeFeeEdit").val("edit_fee");
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	else
  		row = event.target.parentNode;
   	var programCode = oTable.fnGetData(row)['program_code'];//GETTING DATA FOR HIDDEN COLUMN
   	var programName = oTable.fnGetData(row)['program_name'];//GETTING DATA FOR HIDDEN COLUMN
	$('#hidUniqueidEdit').val(programCode);//GETTING VALUE FOR HIDDEN COLUMN
	$('#txtChargeEdit').val(oTable.fnGetData(row)['transaction_charge']);
	var selectedText1 = oTable.fnGetData(row)['program_code'];
	$("#cmbProgramCodeEdit").val(programName);
	$("#cmbStatusEdit").val(oTable.fnGetData(row)['status']);
	if(oTable.fnGetData(row)['status'] == 'INACTIVE')
	{
		$("#cmbStatusEdit").val('0');
	}
	else
	{
		$("#cmbStatusEdit").val('1');
	}
	/*var selectedText2 = oTable.fnGetData(row)['status'];
	
	$("#cmbStatusEdit option").each(function () 
	{
		//alert($(this).html());
		if ($(this).html() == selectedText2)
	 	{
			$(this).attr("selected", "selected");
			return;
		}
	});*/
	$('#challanEditModal').modal('show');
	
	$('#frmChargeEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			var institutedata={
				hidUniqueidEdit:$('#hidUniqueidEdit').val(),
				cmbProgramCodeEdit:programCode,
				txtChargeEdit:$('#txtChargeEdit').val(),
				cmbStatusEdit:$('#cmbStatusEdit').val(),
				hidOperTypeFeeEdit:$('#hidOperTypeFeeEdit').val()
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_feeeditdata",
				type:"post",
				data:institutedata,
				success:function(response){ 
					var res = JSON.parse(response); 
					if(res.status)
					{
						toastr.success(res.msg);
						$('#chllanEditModal').modal('hide'); 
						$('#frmChargeEdit').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
						$('#cmbProgramCodeEdit').val("");
						$('#txtChargeEdit').val("");
						var dtblChallan = $("#tblTransactionChargeMaster").DataTable();
			 			dtblChallan.ajax.reload();
			 			$('#challanEditModal').modal('hide');	
			 		}
			 		else
					{
						toastr.error(res.msg);
						$('#chllanEditModal').modal('hide'); 
						$('#frmChargeEdit').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
						$('#cmbProgramCodeEdit').val("");
						$('#txtChargeEdit').val("");
						var dtblChallan = $("#tblTransactionChargeMaster").DataTable();
			 			dtblChallan.ajax.reload();	
			 			$('#challanEditModal').modal('hide');
					}	
			 		
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields:{
			cmbProgramCodeEdit: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtChargeEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					regexp: {
                        regexp: /^[0-9.]+$/i,
                        message: 'Only numbers and dot are allowed'
                    }
				}
			},
			
			cmbStatusEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			}
		}
			
	});
}
function deleteRowcharge(event)
{
	var session = $('#hidSessionCode').val();
	//$('#ChargeDeleteModal').modal('show');
	var oTable = $('#tblTransactionChargeMaster').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;
	var programCode = oTable.fnGetData(row)['program_code'];//GETTING DATA FOR HIDDEN COLUMN
	$('#hidUniqueidEdit').val(programCode);//GETTING VALUE FOR HIDDEN COLUMN
	swal({
	  title: "Are you sure?",
	  text: "you want to Delete the record!",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Yes, Delete it!",
	  cancelButtonText: "No, cancel",
	  closeOnConfirm: false,
	  closeOnCancel: true
	},
	function(isConfirm){
	  if (isConfirm) {
	  	delete_transaction();
	    swal("Delete", "Record Deleted Successfully.", "success");
	  } else {
		    swal("Cancelled", "Not Deleted ", "error");
	  }
	});
	function delete_transaction(){
		//$('#ChargeDeleteModal').modal('hide');		
		var institutedata=
		{
			programCode:$('#hidUniqueidEdit').val()
		};		
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/delete_feedata",
			type:"post",
			data:institutedata,
			success:function(response)
			{  
				var res = JSON.parse(response); 
				if(res.status)
				{
					toastr.success(res.msg);
					var dtblChallan = $("#tblTransactionChargeMaster").DataTable();
		 			dtblChallan.ajax.reload();	
					
				}
				else
				{
					toastr.error(res.msg);
					var dtblChallan = $("#tblTransactionChargeMaster").DataTable();
		 			dtblChallan.ajax.reload();
				}	
				 
			},
			error:function()
			{
				toastr.error('Unable to process please contact support');
			}
		});		
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

