$(document).ready(function(){
	var session = $("#hidSession").val();
	var categCheck  = $('#cmbProgramSelect').multiselect({
	    includeSelectAllOption: true,
	    enableFiltering : true,
		numberDisplayed: 0,
		buttonWidth: '200px'
	}); 
	var cmbSelectedAssigned  = $('#cmbSelectedAssigned').multiselect({
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
			$('#cmbProgramGroupDocument').html("");   
			$('#cmbProgramGroupDocument').append(options);
			$('#cmbProgramGroupDocSingle').html("");   
			$('#cmbProgramGroupDocSingle').append(options);
			
		},
		error:function()
		{
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$('#cmbProgramGroupDocument').change(function()
	{
		var program_group = $("#cmbProgramGroupDocument").val();
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
	$('#cmbProgramGroupDocSingle').change(function()
	{
		var program_group = $("#cmbProgramGroupDocSingle").val();
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
	$('.tooltips').tooltipster({
		theme: 'tooltipster-punk',
		animation: 'grow',
        delay: 200, 
        touchDevices: false,
        trigger: 'hover'
     });
	$.ajax({
		url:base_url+"ajax_controller/select_program_data", 
		type:"post",
		data:{type:"SELECT_PROGRAM"},
		success:function(response){  
			var options = "<option value=''>Select Post</option>";
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
				var programdocumentTable = $('#dtblProgramDocumentSingle').dataTable({
					"ajax":
					{
						"url": base_url+"/ajax_controller/get_document_single",
						"type": "POST",
						"data": data,
					},  
					"bPaginate": false,
			        "bLengthChange": true,
			        "bFilter": true,
			        "bSort": false,
			        "bInfo": true,
			        "bAutoWidth":false, 
			        "bDestroy": true,   
			        "sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
					"aoColumns": [    
			                       { "sName": "sl_no","sWidth": "15%"},
								   { "sName": "document_code","bVisible":false,"mRender": function( data, type, full ) {
				                    	return '<input type="hidden" class= "form-control" name="txtDocument[]" value="">';
				               		} },
								   { "sName": "document_name","sWidth": "55%"},
								   { "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
								   		if(data =='0')
										{
											return '<input type="text" class= "form-control" name="txtSlNoSingle[]" maxlength = "3" onkeypress="return isNumberKey(event)" value="" maxlength="2">';
										}
										else
										{
											return '<input type="text" class= "form-control" name="txtSlNoSingle[]" maxlength = "3" onkeypress="return isNumberKey(event)" value="'+data+'" maxlength="2">';
										}
				                    	
				               		} },
				               		{ "sName": "select","sWidth": "15%","mRender": function( data, type, full ) {
								   			if(data == '0')
											{
												return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusSingle[]"  value="1"  onclick="getCodeUpdate()"/><div class=\"control__indicator\"></div></label>';
											}
											if(data == '1')
											{
												return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusSingle[]"  value="1"  onclick="getCodeUpdate()" checked/><div class=\"control__indicator\"></div></label>';
											}
					               		},"sClass":"alignCenter"  }
			              	     ],
			        "fnDrawCallback": function(oSettings, json) {
		        		getCodeUpdate();
		        	}          	             
				});
			}			
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$("#chkUpdateAll").change(function () {
		if($('#chkUpdateAll').is(":checked"))
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
	var programdocumentTable = $('#dtblProgramDocument').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_document_all",
			"type": "POST",
			"data": ''
		}, 
		"bPaginate": false,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth":false,  
       /* "sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",*/
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addbuttonCode' >>><'col-xs-6'p>>", 
		"aoColumns": [    
                       { "sName": "sl_no","sWidth": "15%"},
					   { "sName": "document_code","bVisible":false,"mRender": function( data, type, full ) {
	                    	return '<input type="hidden" class= "form-control" name="txtDocument[]" value="">';
	               		} },
					   { "sName": "document_name","sWidth": "55%"},
					   { "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
	                    	return '<input type="text" class= "form-control" onkeypress="return isNumberKey(event)" maxlength = "2" name="txtSlNo[]" value="" maxlength="2"><input type="hidden" class= "form-control"  name="txtDocumentEdit[]" value="'+data+'">';
	               		} },
	               		{ "sName": "select","iDataSort":6,"sWidth": "15%","mRender": function( data, type, full ) {
	                    		return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatus[]"  value="1"  onclick="getCode()" /><div class=\"control__indicator\"></div></label>';
	               		},"sClass":"alignCenter"  }
					   
              	     ],
        "fnDrawCallback": function(oSettings, json) {
	        $('input[class=flat-red]').iCheck({
				checkboxClass: 'icheckbox_flat-blue',
				radioClass: 'icheckbox_flat-blue'
			}); 
		}       	             
	});
	$("div.addbuttonCode").html('<button id="btnUpdateMultiple" class="btn btn-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Assign</button>&nbsp;</div>');
	$("#chkAll").change(function () {
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
		 
	});
	$("#chkAll1").change(function () {
		if($('#chkAll1').is(":checked"))
		{ 
			$('input[name="chkassignStatus[]"]').each( function () {
			 	$(this).prop('checked', true);
			});
		}
		else
		{ 
			$('input[name="chkassignStatus[]"]').each( function () {
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
		var program = $("#cmbProgramFilter").val();
		if(program != '')
		{
			var data = {
				program:program
			};
			var programdocumentTable = $('#dtblProgramDocumentSingle').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/get_document_single",
					"type": "POST",
					"data": data,
				},
				"bPaginate": false,
		        "bLengthChange": true,
		        "bFilter": true,
		        "bSort": false,
		        "bInfo": true,
		        "bAutoWidth":false, 
		        "bDestroy": true,   
		        "sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
				"aoColumns": [    
		                        { "sName": "sl_no","sWidth": "15%"},
							    { "sName": "document_code","bVisible":false,"mRender": function( data, type, full ) {
			                    	return '<input type="hidden" class= "form-control" name="txtDocument[]" value="">';
			               		} },
							    { "sName": "document_name","sWidth": "55%"},
							    { "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
							   		if(data =='0')
									{
										return '<input type="text" class= "form-control" onkeypress="return isNumberKey(event)" name="txtSlNoSingle[]" value="" maxlength="2">';
									}
									else
									{
										return '<input type="text" class= "form-control" onkeypress="return isNumberKey(event)" name="txtSlNoSingle[]" value="'+data+'" maxlength="2">';
									}
			                    	
			               		} },
			               		{ "sName": "select","sWidth": "15%","mRender": function( data, type, full ) {
						   			if(data == '0')
									{
										return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusSingle[]"  value="1"  onclick="getCodeUpdate()"/><div class=\"control__indicator\"></div></label>';
									}
									if(data == '1')
									{
										return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusSingle[]"  value="1"  onclick="getCodeUpdate()" checked/><div class=\"control__indicator\"></div></label>';
									}
			               		},"sClass":"alignCenter"  }
		              	     ],
		        "fnDrawCallback": function(oSettings, json) {
	        		getCodeUpdate();
	        	}        	             
			});
		}
		
	});
	
	$("#btnUpdateMultiple").click(function()
    {
		
		var program_codes = serealizeSelects($('.cmbProgramSelect'));
		//alert(program_codes);
		if(program_codes == '')
		{
			toastr.error('Please Select at least One Post');
		}
		else
		{
			var arr_document_code = new Array();
		    $('input[name="txtDocumentEdit[]"]').each(function(){
		        var document_code = $(this).val();
		        //alert(studentCode);
		        arr_document_code.push(document_code);
		    });
			var arr_slno = new Array();
		    $('input[name="txtSlNo[]"]').each(function(){
		        var slno = $(this).val();
				if(slno == '')
				{
					arr_slno.push(0);
				}
				else
				{
					arr_slno.push(slno);
				}
		        //alert(studentCode);
		        
		    });	
			//alert(arr_slno);
			var arr_show_status = new Array();
			var arr_cnt = '0';
		    $('input[name="chkStatus[]"]').each(function(){
		        if($(this).is(':checked')){
					arr_show_status.push(1);
					arr_cnt++;
				}
				else
				{
					arr_show_status.push(0);
				}
		        //alert(studentCode);
		        
		    });	
			//alert(arr_document_code);
			if(arr_cnt == 0)
		    {
				toastr.error("Please Select atleast one document");
				return false;
			}
			else
			{
				var institutedata={
					program_codes : program_codes,
					document_codes : arr_document_code,
					sl_nos : arr_slno,
					show_status : arr_show_status
				};
				$.ajax({
				    url:base_url+"ajax_controller/update_multiple_document", 
				    type:"post",
				    data:institutedata,
				    success:function(response)
				    {  		
				    	var result = JSON.parse(response);
						if(result.status=='SUCCESS')
						{
							toastr.success(result.msg);  
							var programdocumentTable = $('#dtblProgramDocument').DataTable();
							programdocumentTable.ajax.reload();
							/*var dtblProgramDocumentSingle = $('#dtblProgramDocumentSingle').DataTable();
							dtblProgramDocumentSingle.ajax.reload();*/
							$("#cmbProgramSelect option:selected").removeAttr("selected");
							$('#cmbProgramSelect').multiselect('refresh');
							$('#chkAll').prop('checked', false);
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
			
		}
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
		    $('input[name="txtSlNoSingle[]"]').each(function(){
		        var slno = $(this).val();
				if(slno == '')
				{
					arr_slno.push(0);
				}
				else
				{
					arr_slno.push(slno);
				}
		        //alert(studentCode);
		        
		    });	
			//alert(arr_slno);
			var arr_show_status = new Array();
			var arr_cnt = 0;
		    $('input[name="chkStatusSingle[]"]').each(function(){
		        if($(this).is(':checked')){
					arr_show_status.push(1);
					arr_cnt++;
				}
				else
				{
					arr_show_status.push(0);
				}
		        //alert(studentCode);
		        
		    });	
			//alert(arr_document_code);
			
			if(arr_cnt == 0)
		    {
				toastr.error("Please Select atleast one document");
				return false;
			}
			else
			{
				var institutedata={
					program_code : program_code,
					sl_nos : arr_slno,
					show_status : arr_show_status
				};
				$.ajax({
				    url:base_url+"/ajax_controller/update_single_document",
				    type:"post",
				    data:institutedata,
				    success:function(response)
				    {  					
				    	var result = JSON.parse(response);
						if(result.status=='SUCCESS')
						{
							toastr.success(result.msg);  
							var programdocumentTable = $('#dtblProgramDocumentSingle').DataTable();
							programdocumentTable.ajax.reload();
							//$('#chkUpdateAll').prop('checked', false);
				    	}
				    	else
						{
							toastr.error(result.msg);
							//$('#chkUpdateAll').prop('checked', false);
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
	function serealizeSelects (select)
	{
	    var array = [];
	    select.each(function(){ array.push($(this).val()) });
	    return array;
	}
	
	
	
/*js code starts here for Selected Assigned*/
var programdocumentTable = $('#dtblSelectedAssigned').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_assign_document_all",
			"type": "POST",
			"data": ''
		}, 
		"bPaginate": false,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth":false, 
        "bDestroy": true,   
        "sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
		"aoColumns": [    
                       { "sName": "sl_no","sWidth": "15%"},
					   { "sName": "document_code","bVisible":false,"mRender": function( data, type, full ) {
	                    	return '<input type="hidden" class= "form-control" name="txtassigDocumentEdit[]" value="">';
	               		} },
					   { "sName": "document_name","sWidth": "55%"},
					   { "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
	                    	return '<input type="text" class= "form-control" name="txtassignSlNo[]" value=""><input type="hidden" class= "form-control" name="txtassignDocumentEdit[]" value="'+data+'">';
	               		} },
	               		{ "sName": "select","iDataSort":6,"sWidth": "15%","mRender": function( data, type, full ) {
	                    		return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkassignStatus[]"  value="1"  onclick="getsCode()" /><div class=\"control__indicator\"></div></label>';
	               		},"sClass":"alignCenter"  }
					   
              	     ],
        "fnDrawCallback": function(oSettings, json) {
	        $('input[class=flat-red]').iCheck({
				checkboxClass: 'icheckbox_flat-blue',
				radioClass: 'icheckbox_flat-blue'
			}); 
		}       	             
	});

$.ajax({
		url:base_url+"ajax_controller/selected_assign_data", 
		type:"post",
		data:{type:"SELECT_PROGRAM"},
		success:function(response){  
			var options = "<option value=''>Select Post</option>";
			var res1 = JSON.parse(response);
			 $.each(res1.aaData, function (index, item) {
	            var opt = $('<option />', {
	                value: item.program_code,
	                text: item.program_name
	            });
	            opt.appendTo(cmbSelectedAssigned);
	           	cmbSelectedAssigned.multiselect('rebuild');
			  	options = options + "<option value="+item.program_code+">"+item.program_name+"</option>";
    		});
			/*$('#cmbSelectedAssigned').html("");   //campusid from academicPeriod
			$('#cmbSelectedAssigned').append(options);*/
			program = $('#cmbSelectedAssigned').val();
					
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
   $("#btnUpdateMultiple1").click(function()
    {
		
		var program_codes = serealizeSelects($('.cmbSelectedAssigned'));
		if(program_codes == '')
		{
			toastr.error('Please Select at least One Program');
		}
		else
		{
			var arr_document_code = new Array();
		    $('input[name="txtassignDocumentEdit[]"]').each(function(){
		        var document_code = $(this).val();
		        //alert(studentCode);
		        arr_document_code.push(document_code);
		    });
			var arr_slno = new Array();
		    $('input[name="txtassignSlNo[]"]').each(function(){
		        var slno = $(this).val();
				if(slno == '')
				{
					arr_slno.push(0);
				}
				else
				{
					arr_slno.push(slno);
				}
		        //alert(studentCode);
		        
		    });	
			//alert(arr_slno);
			var arr_show_status = new Array();
		    $('input[name="chkassignStatus[]"]').each(function(){
		        if($(this).is(':checked')){
					arr_show_status.push(1);
				}
				else
				{
					arr_show_status.push(0);
				}
		        //alert(studentCode);
		        
		    });	
			//alert(arr_document_code);
			var assingdata={
				program_codes : program_codes,
				document_codes : arr_document_code,
				sl_nos : arr_slno,
				show_status : arr_show_status
			};	   	
	   
		$.ajax({
			    url:base_url+"ajax_controller/select_assign_document", 
			    type:"post",
			    data:assingdata,
			    success:function(response)
			    {  					
			    	var result = JSON.parse(response);
					if(result.status=='SUCCESS')
					{
						toastr.success(result.msg);  
						var programdocumentTable = $('#dtblSelectedAssigned').DataTable();
						programdocumentTable.ajax.reload();
						var dtblSelectedProgramDocumentSingle = $('#dtblSelectedProgramDocumentSingle').DataTable();
						dtblSelectedProgramDocumentSingle.ajax.reload();
						$("#cmbSelectedAssigned option:selected").removeAttr("selected");
						$('#cmbSelectedAssigned').multiselect('refresh');
						$('#chkAll').prop('checked', false);
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
     });
	
	
	//----------------------- selected update--------------------------------
	$.ajax({
		url:base_url+"ajax_controller/select_program_data", 
		type:"post",
		data:{type:"SELECT_PROGRAM"},
		success:function(response){  
			var options = "<option value=''>Select Post</option>";
			var res1 = JSON.parse(response);
			 $.each(res1.aaData, function (index, item) {
	            var opt = $('<option />', {
	                value: item.program_code,
	                text: item.program_name
	            });
	            /*opt.appendTo(categCheck);
	            categCheck.multiselect('rebuild');*/
			   options = options + "<option value="+item.program_code+">"+item.program_name+"</option>";
    		});
			$('#cmbSelectedProgramFilter').html("");   //campusid from academicPeriod
			$('#cmbSelectedProgramFilter').append(options);
			program = $('#cmbSelectedProgramFilter').val();
			if(program != '')
			{
				var data = {
					program:program
				};
				var programdocumentTable = $('#dtblSelectedProgramDocumentSingle').dataTable({
					"ajax":
					{
						"url": base_url+"/ajax_controller/get_sdocument_single",
						"type": "POST",
						"data": data,
					},  
					"bPaginate": false,
			        "bLengthChange": true,
			        "bFilter": true,
			        "bSort": false,
			        "bInfo": true,
			        "bAutoWidth":false, 
			        "bDestroy": true,   
			        "sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
					"aoColumns": [    
			                       { "sName": "sl_no","sWidth": "15%"},
								   { "sName": "document_code","bVisible":false,"mRender": function( data, type, full ) {
				                    	return '<input type="hidden" class= "form-control" name="txtDocuments[]" value="">';
				               		} },
								   { "sName": "document_name","sWidth": "55%"},
								   { "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
								   		if(data =='0')
										{
											return '<input type="text" class= "form-control" name="txtSlNoSingles[]" value="">';
										}
										else
										{
											return '<input type="text" class= "form-control" name="txtSlNoSingles[]" value="'+data+'">';
										}
				                    	
				               		} },
				               		{ "sName": "select","sWidth": "15%","mRender": function( data, type, full ) {
								   			if(data == '0')
											{
												return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusSingles[]"  value="1"  onclick="getsCodeUpdate()"/><div class=\"control__indicator\"></div></label>';
											}
											if(data == '1')
											{
												return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusSingles[]"  value="1"  onclick="getsCodeUpdate()" checked/><div class=\"control__indicator\"></div></label>';
											}
					               		},"sClass":"alignCenter"  }
			              	     ],
			        "fnDrawCallback": function(oSettings, json) {
		        		getsCodeUpdate();
		        	}          	             
				});
			}			
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$("#cmbSelectedProgramFilter").change(function(){
			var program = $("#cmbSelectedProgramFilter").val();
			if(program != '')
			{
				var data = {
					program:program
				};
				var programdocumentTable = $('#dtblSelectedProgramDocumentSingle').dataTable({
					"ajax":
					{
						"url": base_url+"/ajax_controller/get_sdocument_single",
						"type": "POST",
						"data": data,
					},
					"bPaginate": false,
			        "bLengthChange": true,
			        "bFilter": true,
			        "bSort": false,
			        "bInfo": true,
			        "bAutoWidth":false, 
			        "bDestroy": true,   
			        "sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
					"aoColumns": [    
			                        { "sName": "sl_no","sWidth": "15%"},
								    { "sName": "document_code","bVisible":false,"mRender": function( data, type, full ) {
				                    	return '<input type="hidden" class= "form-control" name="txtDocuments[]" value="">';
				               		} },
								    { "sName": "document_name","sWidth": "55%"},
								    { "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
								   		if(data =='0')
										{
											return '<input type="text" class= "form-control" name="txtSlNoSingles[]" value="">';
										}
										else
										{
											return '<input type="text" class= "form-control" name="txtSlNoSingles[]" value="'+data+'">';
										}
				                    	
				               		} },
				               		{ "sName": "select","sWidth": "15%","mRender": function( data, type, full ) {
							   			if(data == '0')
										{
											return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusSingles[]"  value="1"  onclick="getsCodeUpdate()"/><div class=\"control__indicator\"></div></label>';
										}
										if(data == '1')
										{
											return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusSingles[]"  value="1"  onclick="getsCodeUpdate()" checked/><div class=\"control__indicator\"></div></label>';
										}
				               		},"sClass":"alignCenter"  }
			              	     ],
			        "fnDrawCallback": function(oSettings, json) {
		        		getsCodeUpdate();
		        	}        	             
				});
			}
			
		});
	$("#btnSelectedUpdateSingle").click(function() {
		
		var program_code = $("#cmbSelectedProgramFilter").val();
		if(program_code == '')
		{
			toastr.error('Please Select a Post');
		}
		else
		{
			var arr_slno = new Array();
		    $('input[name="txtSlNoSingles[]"]').each(function(){
		        var slno = $(this).val();
				if(slno == '')
				{
					arr_slno.push(0);
				}
				else
				{
					arr_slno.push(slno);
				}
		        //alert(studentCode);
		        
		    });	
			//alert(arr_slno);
			var arr_show_statuses = new Array();
		    $('input[name="chkStatusSingles[]"]').each(function(){
		        if($(this).is(':checked'))
		        {
					arr_show_statuses.push(1);
				}
				else
				{
					arr_show_statuses.push(0);
				}
		        //alert(studentCode);
		        
		    });	
			var institutedata={
				program_code : program_code,
				sl_nos : arr_slno,
				show_status : arr_show_statuses
			};
			$.ajax({
			    url:base_url+"/ajax_controller/update_single_sdocument",
			    type:"post",
			    data:institutedata,
			    success:function(response)
			    {  					
			    	var result = JSON.parse(response);
					if(result.status=='SUCCESS')
					{
						toastr.success(result.msg);  
						var programdocumentTable = $('#dtblSelectedProgramDocumentSingle').DataTable();
						programdocumentTable.ajax.reload();
						//$('#chkUpdateAll').prop('checked', false);
			    	}
			    	else
					{
						toastr.error(result.msg);
						//$('#chkUpdateAll').prop('checked', false);
					}
			    },
			    error:function()
			    {
			     	toastr.error('We are unable to process please contact support'); 
			    }
		   }); 
			
		}
    });
	$("#chkSelectedUpdateAll").change(function () {
		if($('#chkSelectedUpdateAll').is(":checked"))
		{
			$('input[name="chkStatusSingles[]"]').each( function () {
			 	$(this).prop('checked', true);
			});
		}
		else
		{
			$('input[name="chkStatusSingles[]"]').each( function () {
			 	$(this).prop('checked', false);
			});
		}
		 
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

function getCode()
{
	
	$("[name='chkStatus[]']").change(function () {
        if($('input[name="chkStatus[]"][type=checkbox]').length == 0)
		{
			 $('#chkAll').prop('checked', false);
		}
		else
		{
			if ($('input[name="chkStatus[]"][type=checkbox]:checked').length == $('input[name="chkStatus[]"][type=checkbox]').length) 
	        {
	            $('#chkAll').prop('checked', true);
	        } 
	        else 
	        {
	            $('#chkAll').prop('checked', false);
	        }
	    }
    });
}
function getsCode()
{
	
	$("[name='chkassignStatus[]']").change(function () {
        if($('input[name="chkassignStatus[]"][type=checkbox]').length == 0)
		{
			 $('#chkAll1').prop('checked', false);
		}
		else
		{
			if ($('input[name="chkassignStatus[]"][type=checkbox]:checked').length == $('input[name="chkassignStatus[]"][type=checkbox]').length) 
	        {
	            $('#chkAll1').prop('checked', true);
	        } 
	        else 
	        {
	            $('#chkAll1').prop('checked', false);
	        }
	    }
    });
}
function getCodeUpdate()
{
    if($('input[name="chkStatusSingle[]"][type=checkbox]').length == 0)
	{
		 $('#chkUpdateAll').prop('checked', false);
	}
	else
	{
		if ($('input[name="chkStatusSingle[]"][type=checkbox]:checked').length == $('input[name="chkStatusSingle[]"][type=checkbox]').length) 
	    {
	        $('#chkUpdateAll').prop('checked', true);
	    } 
	    else 
	    {
	        $('#chkUpdateAll').prop('checked', false);
	    }
    }
}

function getsCodeUpdate()
{
    if($('input[name="chkStatusSingles[]"][type=checkbox]').length == 0)
	{
		 $('#chkSelectedUpdateAll').prop('checked', false);
	}
	else
	{
		if ($('input[name="chkStatusSingles[]"][type=checkbox]:checked').length == $('input[name="chkStatusSingles[]"][type=checkbox]').length) 
	    {
	        $('#chkSelectedUpdateAll').prop('checked', true);
	    } 
	    else 
	    {
	        $('#chkSelectedUpdateAll').prop('checked', false);
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
