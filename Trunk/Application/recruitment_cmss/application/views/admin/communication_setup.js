$(document).ready(function(){
	var session = $('#hidSessionCode').val();
	var categCheck  = $('#cmbProgramSelect').multiselect({
	    includeSelectAllOption: true,
	    enableFiltering : true,
		buttonWidth: '200px'
	}); 
	
	$.ajax({
		url:base_url+"ajax_controller/select_program_data", 
		type:"post",
		success:function(response){  
			var options = "";
			var res1 = JSON.parse(response);
			 $.each(res1.aaData, function (index, item) {
	            var opt = $('<option />', {
	                value: item.program_code,
	                text: item.program_name
	            });
	            opt.appendTo(categCheck);
	            categCheck.multiselect('rebuild');
			   options = options + "<option value="+item.program_code+">"+item.program_name+"</option>";
    		});
			$('#cmbProgramFilter').html("");   //campusid from academicPeriod
			$('#cmbProgramFilter').append(options);
			program = $('#cmbProgramFilter').val();
			if(program != '')
			{	
				var data = {
					program:program
				};
				var programSmsTableSingle = $('#dtblProgramSmsSingle').dataTable({
					"ajax":
					{
						"url": base_url+"/ajax_controller/select_program_sms",
						"type": "POST",
						"data": data,
					},
					"bPaginate": false,
			        "bLengthChange": false,
			        "bFilter": true,
			        "bSort": false,
			        "bInfo": true,
			        "bAutoWidth":false, 
			        "bDestroy": true,   
			        "sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
					"aoColumns": [    
			                       { "sName": "sl_no","sWidth": "15%"},
								   { "sName": "sms_type_code","bVisible":false,"mRender": function( data, type, full ) {
				                    	return '<input type="hidden" class= "form-control" name="txtCategory[]" value="">';
				               		} },
								   { "sName": "sms_type","sWidth": "55%"},
								   { "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
							   			if(data == '0')
										{
											return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusSingle[]"  value="1"  onclick="getsmsSingleCode()"/><div class=\"control__indicator\"></div></label>';
										}
										if(data == '1')
										{
											return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusSingle[]"  value="1"  onclick="getsmsSingleCode()" checked/><div class=\"control__indicator\"></div></label>';
										}
				               		},"sClass":"alignCenter"  }
			              	     ],
			        "fnDrawCallback": function(oSettings, json) {
		        		getsmsSingleCode();
		        	}       	             
				});
			}
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});

	var programSmsTable = $('#dtblProgramSms').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/select_all_sms",
			"type": "POST",
			"data": ''
		},  
		"bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth":false, 
        "bDestroy": true,   
        "sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
		"aoColumns": [    
                       { "sName": "sl_no","sWidth": "15%"},
					   { "sName": "sms_type_code","bVisible":false,"mRender": function( data, type, full ) {
	                    	return '<input type="hidden" class= "form-control" name="txtCategory[]" value="">';
	               		} },
					   { "sName": "sms_type","sWidth": "55%"},
					   { "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
	                    		return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatus[]"  value="1"  onclick="getsmsCode()"/><input type="hidden" class= "form-control" name="txtCategoryEdit[]" value="'+data+'"><div class=\"control__indicator\"></div></label>';
	               	   },"sClass":"alignCenter"  }
					   
              	     ],
        "fnDrawCallback": function(oSettings, json) {
	        $('input[class=flat-red]').iCheck({
				checkboxClass: 'icheckbox_flat-blue',
				radioClass: 'icheckbox_flat-blue'
			}); 
		}        	             
	});
	$("#chksmsAll").change(function () {
		if($('#chksmsAll').is(":checked"))
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
		 
	});
	function customCheckbox(checkboxName){
        var checkBox = $('input[name="'+ checkboxName +'"]');
        $(checkBox).each(function(){
            $(this).wrap( "<span class='custom-checkbox'></span>" );
            if($(this).is(':checked')){
                $(this).parent().addClass("selected");
            }
        });
        $(checkBox).click(function(){
            $(this).parent().toggleClass("selected");
        });
    }
	$("#cmbProgramFilter").change(function(){
		
		var program_code = $("#cmbProgramFilter").val();
		if(program_code != '')
		{
			
				var data = {
					program_code:program_code
				};
				var programSmsTableSingle = $('#dtblProgramSmsSingle').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/select_communication_sms",
					"type": "POST",
					"data": data,
				},  
				"bPaginate": false,
		        "bLengthChange": false,
		        "bFilter": true,
		        "bSort": false,
		        "bInfo": true,
		        "bAutoWidth":false, 
		        "bDestroy": true,   
		        "sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
				"aoColumns": [    
		                       { "sName": "sl_no","sWidth": "15%"},
							   { "sName": "sms_type_code","bVisible":false,"mRender": function( data, type, full ) {
			                    	return '<input type="hidden" class= "form-control" name="txtCategory[]" value="">';
			               		} },
							   { "sName": "sms_type","sWidth": "55%"},
							   { "sName": "select","sWidth": "15%","mRender": function( data, type, full ) {
						   			if(data == '0')
									{
										return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusSingle[]"  value="1"  onclick="getsmsSingleCode()"/><div class=\"control__indicator\"></div></label>';
									}
									if(data == '1')
									{
										return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusSingle[]"  value="1"  onclick="getsmsSingleCode()" checked/><div class=\"control__indicator\"></div></label>';
									}
				               },"sClass":"alignCenter"  }
							   
		              	     ],
		        "fnDrawCallback": function(oSettings, json) {
	        		getsmsSingleCode();
	        	}    	             
			});
		}
		
	});
	$("#chksmsUpdate").change(function () {
		if($('#chksmsUpdate').is(":checked"))
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
	$("#btnUpdateMultiple").click(function()
    {
		
		var program_codes = serealizeSelects($('.cmbProgramSelect'));
		if(program_codes == '')
		{
			toastr.error('Please Select at least One Program');
		}
		else
		{
			var arr_category_code = new Array();
		    $('input[name="txtCategoryEdit[]"]').each(function(){
		        var category_code = $(this).val();
		        //alert(studentCode);
		        arr_category_code.push(category_code);
		    });
			var arr_show_status = new Array();
		    $('input[name="chkStatus[]"]').each(function(){
		        if($(this).is(':checked')){
					arr_show_status.push(1);
				}
				else
				{
					arr_show_status.push(0);
				}
		        
		    });	
			var institutedata={
				program_codes : program_codes,
				category_codes : arr_category_code,
				show_status : arr_show_status,
			};
			$.ajax({
				url:base_url+"ajax_controller/update_multiple_sms", 
			    type:"post",
			    data:institutedata,
			    success:function(response)
			    {  		
			    	var res = JSON.parse(response); 
					if(res.status)
					{			
						toastr.success(res.msg);  
						var programcategoryTable = $('#dtblProgramcategory').DataTable();
						programcategoryTable.ajax.reload();
						var dtblProgramSmsSingle = $('#dtblProgramSmsSingle').DataTable();
						dtblProgramSmsSingle.ajax.reload();
						$("#cmbProgramSelect option:selected").removeAttr("selected");
						$('#cmbProgramSelect').multiselect('refresh');
						$('#chksmsAll').prop('checked', false);
						$('input[name="chkStatus[]"]').prop('checked', false);
					}
					else
					{
						toastr.error(res.msg);
						var programcategoryTable = $('#dtblProgramcategory').DataTable();
						programcategoryTable.ajax.reload();
						var dtblProgramSmsSingle = $('#dtblProgramSmsSingle').DataTable();
						dtblProgramSmsSingle.ajax.reload();
						$("#cmbProgramSelect option:selected").removeAttr("selected");
						$('#cmbProgramSelect').multiselect('refresh');
						$('#chksmsAll').prop('checked', false);
						$('input[name="chkStatus[]"]').prop('checked', false);
					}
			    },
			    error:function()
			    {
			     	toastr.error('We are unable to process please contact support'); 
			    }
		   }); 
			
		}
    });
	$("#btnUpdateSingle").click(function()
    {
		
		var program_code = $("#cmbProgramFilter").val();
		if(program_code == '')
		{
			toastr.error('Please Select a Program');
		}
		else
		{
			
			var arr_show_status = new Array();
		    $('input[name="chkStatusSingle[]"]').each(function(){
		        if($(this).is(':checked')){
					arr_show_status.push(1);
				}
				else
				{
					arr_show_status.push(0);
				}
		    });	
			//alert(program_code);
			var institutedata={
				program_code : program_code,
				show_status : arr_show_status
			};
			$.ajax({
				url:base_url+"ajax_controller/update_single_sms",
				type:"post",
			    data:institutedata,
			    success:function(response)
			    {  				
			    	//alert(response);	
			    	var res = JSON.parse(response); 
					if(res.status)
					{
						toastr.success(res.msg);  
						var programcategoryTable = $('#dtblProgramSmsSingle').DataTable();
						programcategoryTable.ajax.reload();
					}
					else
					{
						toastr.error(res.msg);
						var programcategoryTable = $('#dtblProgramSmsSingle').DataTable();
						programcategoryTable.ajax.reload();
					}
			    },
			    error:function()
			    {
			     	toastr.error('We are unable to process please contact support'); 
			    }
		   }); 
			
		}
    });
    
    // email tab
    var EmailCheck  = $('#cmbSelectProgram').multiselect({
	    includeSelectAllOption: true,
	    enableFiltering : true,
		buttonWidth: '200px'
	}); 
   
   
    $.ajax({
    	url:base_url+"ajax_controller/select_program_email", 
		type:"post",
		success:function(response){  
			var options = "";
			var res1 = JSON.parse(response);
			$.each(res1.aaData, function (index, item) {
				var opt = $('<option />', {
	                value: item.program_code,
	                text: item.program_name
	            });
	            opt.appendTo(EmailCheck);
	            EmailCheck.multiselect('rebuild');
				options += "<option value='"+item.program_code+"'>"+item.program_name+"</option>";
			});
			$('#cmbFilter').html("");   //campusid from academicPeriod
			$('#cmbFilter').append(options);
			var program_filter = $('#cmbFilter').val();
			if(program_filter != '')
			{
				
				var data = {
					program:program_filter
				};
					var programmenuTable = $('#tblProgramDocument').dataTable({
					"ajax":
					{
						"url": base_url+"/ajax_controller/select_communication_menu",
						"type": "POST",
						"data": data,
					},   
					"bPaginate": false,
			        "bLengthChange": false,
			        "bFilter": true,
			        "bSort": false,
			        "bInfo": true,
			        "bAutoWidth":false, 
			        "bDestroy": true,   
			        "sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
					"aoColumns": [    
			                       { "sName": "sl_no","sWidth": "15%"},
			                       { "sName": "select","sWidth": "55%","mRender": function( data, type, full ) {
				                       		var total = data;
				                       		return data + '<input type="hidden" id="txtMenuEdit" name="txtMenuEdit[]" value="'+data+'">';
				                    } },
			                        { "sName": "select","sWidth": "10%","sClass":"alignCenter","mRender": function( data, type, full ) {
				               			
								   			if(data == '0')
											{
												return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkFieldStatus[]"  value="1"  onclick="getEmailUpdateCode()"/><div class=\"control__indicator\"></div></label>';
											}
											if(data == '1')
											{
												return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkFieldStatus[]"  value="1"  onclick="getEmailUpdateCode()" checked/><div class=\"control__indicator\"></div></label>';
											}
										}
									}
			                       
			              	     ],
			        "fnDrawCallback": function(oSettings, json) {
		        		getEmailUpdateCode();
		        	}        
				});
			}
							
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
	
	
	$("#cmbFilter").change(function(){
		var program_filter = $("#cmbFilter").val();
		if(program_filter != '')
		{
			
			var data = {
					program:program_filter
				};
			var programmenuTable = $('#tblProgramDocument').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/select_communication_menu",
					"type": "POST",
					"data": data,
				},
				"bPaginate": false,
		        "bLengthChange": false,
		        "bFilter": true,
		        "bSort": false,
		        "bInfo": true,
		        "bAutoWidth":false, 
		        "bDestroy": true,   
		        "sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
				"aoColumns": [    
		                        { "sName": "sl_no","sWidth": "15%"},
		                        { "sName": "select","sWidth": "55%","mRender": function( data, type, full ) {
		                       		var total = data;
		                       		return data + '<input type="hidden" id="txtMenuEdit" name="txtMenuEdit[]" value="'+data+'">';
		                   	    } },
		                   	    { "sName": "select","sWidth": "10%","sClass":"alignCenter","mRender": function( data, type, full ) {
				               			
							   			if(data == '0')
										{
											return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkFieldStatus[]"  value="1"  onclick="getEmailUpdateCode()"/><div class=\"control__indicator\"></div></label>';
										}
										if(data == '1')
										{
											return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkFieldStatus[]"  value="1"  onclick="getEmailUpdateCode()" checked/><div class=\"control__indicator\"></div></label>';
										}
									}
								}
		              	     ],
		        "fnDrawCallback": function(oSettings, json) {
	        		getEmailUpdateCode();
	        	}   
			});
		}
		
	});
	$("#chkEmailUpdate").change(function () {
		if($('#chkEmailUpdate').is(":checked"))
		{
			$('input[name="chkFieldStatus[]"]').each( function () {
			 	$(this).prop('checked', true);
			});
		}
		else
		{
			$('input[name="chkFieldStatus[]"]').each( function () {
			 	$(this).prop('checked', false);
			});
		}
		 
	});
	var programmenuTable = $('#tblAssignEmail').dataTable({		
		"ajax":
		{
			"url": base_url+"/ajax_controller/select_communication_assign",
			"type": "POST",
			"data": "",
		},
		"bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth":false, 
        "bDestroy": true,   
        "sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
		"aoColumns": [    
                       { "sName": "sl_no","sWidth": "15%"},
                       { "sName": "sms_type","sWidth": "55%"},
					   { "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
	                    		return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusEmail[]"  value="1"  onclick="getEmailCode()"/><input type="hidden" class= "form-control" name="txtEmail[]" value="'+data+'"><div class=\"control__indicator\"></div></label>';
	               	   },"sClass":"alignCenter"  }
                       
              	     ],
	});
	$("#chkEmailAll").change(function () {
		if($('#chkEmailAll').is(":checked"))
		{
			$('input[name="chkStatusEmail[]"]').each( function () {
			 	$(this).prop('checked', true);
			});
		}
		else
		{
			$('input[name="chkStatusEmail[]"]').each( function () {
			 	$(this).prop('checked', false);
			});
		}
		 
	});
	$("#btnAssignEmail").click(function()
    {
		
		var program_codes = serealizeSelects($('.cmbSelectProgram'));
		if(program_codes == '')
		{
			toastr.error('Please Select at least One Program');
		}
		else
		{
			var arr_email_code = new Array();
		    $('input[name="txtEmail[]"]').each(function(){
		        var email_code = $(this).val();
		        //alert(studentCode);
		        arr_email_code.push(email_code);
		    });
			var arr_show_status_email = new Array();
		    $('input[name="chkStatusEmail[]"]').each(function(){
		        if($(this).is(':checked')){
					arr_show_status_email.push(1);
				}
				else
				{
					arr_show_status_email.push(0);
				}
		    });	
		    //alert(arr_email_code);
			var institutedata={
				program_codes : program_codes,
				email_codes : arr_email_code,
				show_status_email : arr_show_status_email,
			};
			$.ajax({
			   	url:base_url+"ajax_controller/update_multiple_email", 
				type:"post",
			    data:institutedata,
			    success:function(response)
			    {  		
			    	var res = JSON.parse(response); 
					if(res.status)
					{			
						toastr.success(res.msg);  
						var programEmail = $('#tblAssignEmail').DataTable();
						programEmail.ajax.reload();
						var programEmailView = $('#tblProgramDocument').DataTable();
						programEmailView.ajax.reload();
						$("#cmbSelectProgram option:selected").removeAttr("selected");
						$('#cmbSelectProgram').multiselect('refresh');
						$("#chkEmailAll").prop('checked', false);
						$('input[name="chkStatusEmail[]"]').prop('checked', false);
					}
					else
					{
						toastr.error(res.msg);
						var programEmail = $('#tblAssignEmail').DataTable();
						programEmail.ajax.reload();
						var programEmailView = $('#tblProgramDocument').DataTable();
						programEmailView.ajax.reload();
						$("#cmbSelectProgram option:selected").removeAttr("selected");
						$('#cmbSelectProgram').multiselect('refresh');
						$("#chkEmailAll").prop('checked', false);
						$('input[name="chkStatusEmail[]"]').prop('checked', false);
					}
			    },
			    error:function()
			    {
			     	toastr.error('We are unable to process please contact support'); 
			    }
		   }); 
		}
    });
	$("#btnUpdateMenu").click(function()
	{
		var program_filter = $("#cmbFilter").val();
		var arr_field_status = new Array();
		$('input[name="chkFieldStatus[]"]').each(function(){
	        if($(this).is(':checked')){
				arr_field_status.push(1);
			}
			else
			{
				arr_field_status.push(0);
			}
	    });	
	    var arr_menu_code = new Array();
	    $('input[name="txtMenuEdit[]"]').each(function(){
	        var menu_code = $(this).val();
	        arr_menu_code.push(menu_code);
	    });
		var institutedata={
			arr_field_status:arr_field_status,
			arr_menu_code:arr_menu_code,
			program:program_filter,
			//type:"UPDATE_EMAIL"
		};
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/update_communication_email", 
			type:"post",
		    data:institutedata,
			success:function(response){
				var res = JSON.parse(response); 
				if(res.status)
				{ 
					var programmenuTable = $('#tblProgramDocument').DataTable();
					programmenuTable.ajax.reload();	
					toastr.success(res.msg);
					$('#chkEmailUpdate').prop('checked', false);
				}
				else
				{
					var programmenuTable = $('#tblProgramDocument').DataTable();
					programmenuTable.ajax.reload();	
					toastr.error(res.msg);
					$('#chkEmailUpdate').prop('checked', false);
				}
			},
			error:function(){
				toastr.error('Unable to process please contact support');
			}
		});
	});
	function serealizeSelects (select)
	{
	    var array = [];
	    select.each(function(){ array.push($(this).val()) });
	    return array;
	}
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

function getsmsCode()
{
	
	$("[name='chkStatus[]']").change(function () {
        if ($('input[name="chkStatus[]"][type=checkbox]:checked').length == $('input[name="chkStatus[]"][type=checkbox]').length) 
        {
            $('#chksmsAll').prop('checked', true);
        } 
        else 
        {
            $('#chksmsAll').prop('checked', false);
        }
    });
}
function getEmailCode()
{
	
	$("[name='chkStatusEmail[]']").change(function () {
        if ($('input[name="chkStatusEmail[]"][type=checkbox]:checked').length == $('input[name="chkStatusEmail[]"][type=checkbox]').length) 
        {
            $('#chkEmailAll').prop('checked', true);
        } 
        else 
        {
            $('#chkEmailAll').prop('checked', false);
        }
    });
}
function getsmsSingleCode()
{
    if ($('input[name="chkStatusSingle[]"][type=checkbox]:checked').length == $('input[name="chkStatusSingle[]"][type=checkbox]').length) 
    {
        $('#chksmsUpdate').prop('checked', true);
    } 
    else 
    {
        $('#chksmsUpdate').prop('checked', false);
    }
}
function getEmailUpdateCode()
{
    if ($('input[name="chkFieldStatus[]"][type=checkbox]:checked').length == $('input[name="chkFieldStatus[]"][type=checkbox]').length) 
    {
        $('#chkEmailUpdate').prop('checked', true);
    } 
    else 
    {
        $('#chkEmailUpdate').prop('checked', false);
    }
}