$(document).ready(function(){
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
				options += "<option value='"+item.program_code+"'>"+item.program_name+"</option>";
			});
			$('#cmbProgramFilter').html("");   //campusid from academicPeriod
			$('#cmbProgramFilter').append(options);
			program = $('#cmbProgramFilter').val();
			if(program != '')
			{
				var institutedata = 
				{
					program : $('#cmbProgramFilter').val()
				}
				var MasterView = $('#dtblRegistrationFieldSingle').dataTable({
					//"sAjaxSource": "registration_field_db.php?_s="+MY_SESSION_NAME+"&type=SELECT&program="+program,
					"ajax":
					{
						"url": base_url+"/ajax_controller/SELECT",
						"type": "POST",
						"data": institutedata,
					},
					"bPaginate": true,
			        "bLengthChange": true,
			        "bFilter": true,
			        "bSort": true,
			        "bInfo": true,
			        "bDestroy": true,
			        "bAutoWidth": false,
					"sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
					"aoColumns":[
				                    { "sName": "sl_no","sWidth": "5%" },
				                    { "sName": "description","sWidth": "40%","mRender": function( data, type, full ) {
									   		var description = data.split('@');
				                    		return description[0]+'<input type="hidden" id="hidFieldCode" name="hidFieldCode[]" value="'+description[1]+'">';
				               			} 
				               		},
				                    { "sName": "field_status","sClass":"alignCenter","sWidth": "15%","mRender": function( data, type, full ) {
									   		var field_status = data.split('`');
									   		var code_list = field_status[0].split(',');
									   		var desc_list = field_status[1].split(',');
					                    	var str = '<select class="form-control tooltips" name="cmbStatus[]">';
				                    		
				                    		for(var i=0; i<desc_list.length; i++)
				                    		{
												if(code_list[i] == field_status[2]){
													str += '<option value="'+code_list[i]+'" selected>'+desc_list[i]+'</option>';
												}
												else{
													str += '<option value="'+code_list[i]+'">'+desc_list[i]+'</option>';
												}
											}
				                    		str += '</select>';
				                    		return str;
				               			} 
				               		},
				                    
				                    
			       				]
				});
			}
							
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$("#cmbProgramFilter").change(function(){
		var program = $("#cmbProgramFilter").val();
		if(program != '')
		{
			var institutedata = 
				{
					program : $('#cmbProgramFilter').val()
				}
			var MasterView = $('#dtblRegistrationFieldSingle').dataTable({
				"ajax":
					{
						"url": base_url+"/ajax_controller/SELECT",
						"type": "POST",
						"data": institutedata,
					},
				"bPaginate": true,
		        "bLengthChange": true,
		        "bFilter": true,
		        "bSort": true,
		        "bInfo": true,
		        "bDestroy": true,
		        "bAutoWidth": false,
				"sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
				"aoColumns":[
			                    { "sName": "sl_no","sWidth": "5%" },
			                    { "sName": "description","sWidth": "40%","mRender": function( data, type, full ) {
								   		var description = data.split('@');
			                    		return description[0]+'<input type="hidden" id="hidFieldCode" name="hidFieldCode[]" value="'+description[1]+'">';
			               			} 
			               		},
			                    { "sName": "field_status","sClass":"alignCenter","sWidth": "15%","mRender": function( data, type, full ) {
								   		var field_status = data.split('`');
								   		var code_list = field_status[0].split(',');
								   		var desc_list = field_status[1].split(',');
				                    	var str = '<select class="form-control tooltips" name="cmbStatus[]">';
			                    		
			                    		for(var i=0; i<desc_list.length; i++)
			                    		{
											if(code_list[i] == field_status[2]){
												str += '<option value="'+code_list[i]+'" selected>'+desc_list[i]+'</option>';
											}
											else{
												str += '<option value="'+code_list[i]+'">'+desc_list[i]+'</option>';
											}
										}
			                    		str += '</select>';
			                    		return str;
			               			} 
			               		},
			                    
		       				]
			});
		}
		
	});
	var Master = $('#dtblRegistrationFields').dataTable({
		//"sAjaxSource": "registration_field_db.php?_s="+MY_SESSION_NAME+"&type=SELECT_ALL",
		"ajax":
		{
			"url": base_url+"/ajax_controller/SELECT_ALL",
			"type": "POST",
			//"data": institutedata,
		},
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bDestroy": true,
        "bAutoWidth": false,
		"sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
		"aoColumns":[
	                    { "sName": "sl_no","sWidth": "5%"},
	                    { "sName": "description","sWidth": "40%","mRender": function( data, type, full ) {
						   		var description = data.split('`');
	                    		return description[0]+'<input type="hidden" id="txtFieldCode" name="txtFieldCode[]" value="'+description[1]+'">';
	               			} 
	               		},
	                    { "sName": "field_status","sClass":"alignCenter","sWidth": "15%","mRender": function( data, type, full ) {
						   		var field_status = data.split('`');
						   		var code_list = field_status[0].split(',');
						   		var desc_list = field_status[1].split(',');
						   		//alert(code_list);
		                    	var str = '<select class="form-control tooltips" name="cmbFieldStatus[]">';
	                    		
	                    		for(var i=0; i<desc_list.length; i++)
	                    		{
									if(code_list[i] == field_status[2]){
										/*alert(desc_list[i]);*/
										str += '<option value="'+code_list[i]+'" selected>'+desc_list[i]+'</option>';
									}
									else{
										str += '<option value="'+code_list[i]+'">'+desc_list[i]+'</option>';
									}
								}
	                    		str += '</select>';
	                    		/*alert(str);*/
	                    		return str;
	               			} 
	               		},
	                    
       				]
	});
	
	$("#btnUpdateSingle").click(function()
    {
		
		var program_codes = $('#cmbProgramFilter').val();
		if(program_codes == '')
		{
			toastr.error('Please Select at least One Program');
		}
		else
		{
			var arr_field_code = new Array();
		    $('input[name="hidFieldCode[]"]').each(function(){
		        var field_code = $(this).val();
		        arr_field_code.push(field_code);
		    });
		    var arr_field_status = new Array();
		    $('select[name="cmbStatus[]"]').each(function(){
		        var field_status = $(this).val();
		        arr_field_status.push(field_status);
		    });
			var institutedata={
				program_codes : program_codes,
				field_code : arr_field_code,
				field_status : arr_field_status,
			};
			$.ajax({
			    url:base_url+"ajax_controller/UPDATE_reg",
				type:"post",
			    data:institutedata,
			    success:function(response)
			    {  		
			    	var result = JSON.parse(response);
					if(result.dbStatus=='SUCCESS')
					{			
						toastr.success(result.dbMessage);  
						var programmenuTable = $('#dtblProgramMenu').DataTable();
						programmenuTable.ajax.reload();
						$("#cmbProgramSelect option:selected").removeAttr("selected");
						$('#cmbProgramSelect').multiselect('refresh');
					}
					else
					{
						toastr.error(result.dbMessage);
					}
			    },
			    error:function()
			    {
			     	toastr.error('We are unable to process please contact support'); 
			    }
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
			var arr_field_code = new Array();
		    $('input[name="txtFieldCode[]"]').each(function(){
		        var field_code = $(this).val();
		        arr_field_code.push(field_code);
		    });
		    var arr_field_status = new Array();
		    $('select[name="cmbFieldStatus[]"]').each(function(){
		        var field_status = $(this).val();
		        arr_field_status.push(field_status);
		    });
			var institutedata={
				program_codes : program_codes,
				field_code : arr_field_code,
				field_status : arr_field_status, 
			};
			$.ajax({
			   	url:base_url+"ajax_controller/UPDATE_MULTIPLE_reg",
				type:"post",
			    data:institutedata,
			    success:function(response)
			    {  			
			    	var result = JSON.parse(response);
					if(result.dbStatus=='SUCCESS')
					{		
					   toastr.success(result.dbMessage);  
					   var programmenuTable = $('#dtblProgramMenu').DataTable();
					   programmenuTable.ajax.reload();
					   var programmenuTableSingle = $('#dtblRegistrationFieldSingle').DataTable();
					   programmenuTableSingle.ajax.reload();
					   $("#cmbProgramSelect option:selected").removeAttr("selected");
					   $('#cmbProgramSelect').multiselect('refresh');
					}
					else
					{
						toastr.error(result.dbMessage);
					}
			    },
			    error:function()
			    {
			     	toastr.error('We are unable to process please contact support'); 
			    }
		   }); 
			
		}
    });
	
	/*****FOR COMBO BOXES ADD AND EDIT******/
	$.ajax({
		url:base_url+"ajax_controller/CMB_STATUS_dt",
		type:"post",
		success:function(response){  
			var options = "";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.code+">"+data.code+"</option>";
			});
			$('#cmbFieldStatus').html("");
			$('#cmbFieldStatus').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$.ajax({
		url:base_url+"ajax_controller/CMB_STATUS_dt",
		type:"post",
		success:function(response){  
			var options = "";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.code+">"+data.code+"</option>";
			});
			$('#cmbFieldStatusEdit').html("");   //campusid from academicPeriod
			$('#cmbFieldStatusEdit').append(options);	
			$('#cmbFieldStatusEditView').html("");   //campusid from academicPeriod
			$('#cmbFieldStatusEditView').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$.ajax({
		url:base_url+"ajax_controller/CMB_CODE_dt",
		type:"post",
		success:function(response){  
			var options = "";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.COLUMN_NAME+">"+data.COLUMN_NAME+"</option>";
			});
			$('#cmbCode').html(""); 
			$('#cmbCode').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$.ajax({
		url:base_url+"ajax_controller/CMB_CODE_dt",
		type:"post",
		success:function(response){  
			var options = "";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.COLUMN_NAME+">"+data.COLUMN_NAME+"</option>";
			});
			$('#cmbCodeEdit').html("");  
			$('#cmbCodeEdit').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	/*****END OF COMBO BOXES ADD AND EDIT******/
	
	
//*********************************** COMMON DATA *********************************//
	/* CODE FOR TOOLTIP */
	$('.tooltips').tooltipster({
		theme: 'tooltipster-punk',
		animation: 'grow',
        delay: 200, 
        touchDevices: false,
        trigger: 'hover'
     });	
/* END OF TOOLTIP */
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
function serealizeSelects (select)
{
    var array = [];
    select.each(function(){ array.push($(this).val()) });
    return array;
}