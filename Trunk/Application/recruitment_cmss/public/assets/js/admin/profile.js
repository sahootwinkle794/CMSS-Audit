$(document).ready(function(){
	
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
			$('#cmbProgramGroupCat').html("");   
			$('#cmbProgramGroupCat').append(options);
			$('#cmbProgramGroupExam').html("");   
			$('#cmbProgramGroupExam').append(options);
			$('#cmbProgramGroupCatSingle').html("");   
			$('#cmbProgramGroupCatSingle').append(options);
			$('#cmbProgramGroupExamSingle').html("");   
			$('#cmbProgramGroupExamSingle').append(options);
			$('#cmbProgramGroupQual').html("");   
			$('#cmbProgramGroupQual').append(options);
			$('#cmbProgramGroupQualSingle').html("");   
			$('#cmbProgramGroupQualSingle').append(options);
			$('#cmbProgramGroupVacancy').html("");   
			$('#cmbProgramGroupVacancy').append(options);
			$('#cmbProgramGroupVacancySingle').html("");   
			$('#cmbProgramGroupVacancySingle').append(options);
			$('#cmbProgramGroupDC').html("");   
			$('#cmbProgramGroupDC').append(options);
			$('#cmbProgramGroupDCSingle').html("");   
			$('#cmbProgramGroupDCSingle').append(options);
		},
		error:function()
		{
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	var session = $('#hidSessionCode').val();
	var categCheck  = $('#cmbProgramSelect').multiselect({
	    includeSelectAllOption: true,
	    enableFiltering : true,
	    enableCaseInsensitiveFiltering: true,
		numberDisplayed: 0,
		buttonWidth: '200px',
		height: '60px'
	}); 
	var categVacancyCheck  = $('#cmbProgramVacancySelect').multiselect({
	    includeSelectAllOption: true,
	    enableFiltering : true,
	    enableCaseInsensitiveFiltering: true,
		buttonWidth: '200px',
		numberDisplayed: 0
	}); 
	$('.tooltips').tooltipster({
		theme: 'tooltipster-punk',
		animation: 'grow',
        delay: 200, 
        touchDevices: false,
        trigger: 'hover'
     }); 
    $('#cmbProgramGroupCat').change(function()
	{
		var program_group = $("#cmbProgramGroupCat").val();
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
	var programCheck  = $('#cmbProgramMultiple').multiselect({
	    includeSelectAllOption: true,
		enableFiltering : true,
		enableCaseInsensitiveFiltering: true,
		buttonWidth: '200px',
		numberDisplayed: 0
	}); 
	var dcCheck  = $('#cmbProgramSelectdc').multiselect({
	    includeSelectAllOption: true,
	    enableFiltering : true,
	    enableCaseInsensitiveFiltering: true,
		buttonWidth: '200px',
		numberDisplayed: 0
	}); 
	var progCheck  = $('#cmbSelectProgram').multiselect({
	    includeSelectAllOption: true,
		numberDisplayed: 0,
	    enableFiltering : true,
	    enableCaseInsensitiveFiltering: true,
		buttonWidth: '200px'
	});
	
	$('#cmbProgramGroupExam').change(function()
	{
		var program_group = $("#cmbProgramGroupExam").val();
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
			        programCheck.empty(); 
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
			            opt1.appendTo(programCheck);
			            
			            programCheck.multiselect('rebuild');
			            
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
	$('#cmbProgramGroupDC').change(function()
	{
		var program_group = $("#cmbProgramGroupDC").val();
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
			        dcCheck.empty(); 
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
			            opt1.appendTo(dcCheck);
			            
			            dcCheck.multiselect('rebuild');
			            
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
	$('#cmbProgramGroupQual').change(function()
	{
		var program_group = $("#cmbProgramGroupQual").val();
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
			        progCheck.empty(); 
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
			            opt1.appendTo(progCheck);
			            
			            progCheck.multiselect('rebuild');
			            
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
	$('#cmbProgramGroupVacancy').change(function()
	{
		var program_group = $("#cmbProgramGroupVacancy").val();
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
			        categVacancyCheck.empty(); 
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
			            opt1.appendTo(categVacancyCheck);
			            
			            categVacancyCheck.multiselect('rebuild');
			            
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
	$('#cmbProgramGroupCatSingle').change(function()
	{
		var program_group = $("#cmbProgramGroupCatSingle").val();
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
	$('#cmbProgramGroupDCSingle').change(function()
	{
		var program_group = $("#cmbProgramGroupDCSingle").val();
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
						$('#cmbProgramFilterdc').html("");   //campusid from academicPeriod
						$('#cmbProgramFilterdc').append(opt);   
						var program = $("#cmbProgramFilterdc").val();
						var program_group = $("#cmbProgramGroup").val();
						
					}
					else{
						$('#cmbProgramFilterdc').html("");   
						$('#cmbProgramFilterdc').append(options);	
						var program = $("#cmbProgramFilterdc").val();
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
	$('#cmbProgramGroupVacancySingle').change(function()
	{
		var program_group = $("#cmbProgramGroupVacancySingle").val();
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
						$('#cmbProgramFilterVacancy').html("");   //campusid from academicPeriod
						$('#cmbProgramFilterVacancy').append(opt);   
						var program = $("#cmbProgramFilterVacancy").val();
						var program_group = $("#cmbProgramGroup").val();
						
					}
					else{
						$('#cmbProgramFilterVacancy').html("");   
						$('#cmbProgramFilterVacancy').append(options);	
						var program = $("#cmbProgramFilterVacancy").val();
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
	$('#cmbProgramGroupQualSingle').change(function()
	{
		var program_group = $("#cmbProgramGroupQualSingle").val();
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
						$('#cmbFilter').html("");   //campusid from academicPeriod
						$('#cmbFilter').append(opt);   
						var program = $("#cmbFilter").val();
						var program_group = $("#cmbProgramGroup").val();
						
					}
					else{
						$('#cmbFilter').html("");   
						$('#cmbFilter').append(options);	
						var program = $("#cmbFilter").val();
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
	$('#cmbProgramGroupExamSingle').change(function()
	{
		var program_group = $("#cmbProgramGroupExamSingle").val();
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
						$('#cmbProgram').html("");   //campusid from academicPeriod
						$('#cmbProgram').append(opt);   
						var program = $("#cmbProgram").val();
						var program_group = $("#cmbProgramGroup").val();
						
					}
					else{
						$('#cmbProgram').html("");   
						$('#cmbProgram').append(options);	
						var program = $("#cmbProgram").val();
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
	
	var programCategoryTable = $('#dtblProgramCategory').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_category_all",
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
       /* "sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",*/
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addbuttonCode1' >>><'col-xs-6'p>>", 
		"aoColumns": [    
                       { "sName": "sl_no","sWidth": "15%"},
					   { "sName": "category_code","bVisible":false,"mRender": function( data, type, full ) {
	                    	return '<input type="hidden" class= "form-control" name="txtCategory[]" value="">';
	               		} },
					   { "sName": "category_name","sWidth": "55%"},
					   { "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
	                    		return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatus[]"  value="1"  onclick="getCatcode()"/><input type="hidden" name="hidCategoryEdit[]" value="'+data+'"/><div class=\"control__indicator\"></div></label>';
	               		},"sClass":"alignCenter"  }
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
	$("div.addbuttonCode1").html('<button id="btnUpdateMultiple" class="btn btn-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Assign</button>&nbsp;</div>');
	$("#chkCatAll").change(function () {
		if($('#chkCatAll').is(":checked"))
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
	var programFee = $('#tblProgramVacancyAssign').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_vacancy_assign_all",
			"type": "POST",
			"data": ''
		}, 
		"bPaginate": false,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bDestroy" : true,
        "bAutoWidth": true,
		/*"sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",*/
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addbuttonCode4' >>><'col-xs-6'p>>", 
		"aoColumns": [
						{ "sName": "sl_no","sWidth": "15%"},
						{ "sName": "category_code","bVisible":false,"mRender": function( data, type, full ) {
								return '<input type="hidden" class= "form-control" name="txtfeeCategory[]" value="'+data+'">';
							} 
						},
						{ "sName": "category_name","sWidth": "55%"},
						{ "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
								var feeAmtId = data.split('`');
								return '<input type="text" class= "form-control" onkeypress="return isNumberKey(event)"  id="txtVacancy'+data+'"   name="txttxtVacancyAll[]" value="" maxlength="3"><input type="hidden" class= "form-control" name="txtfeeCategory[]" value="'+data+'">';
							},"sClass":"dt-center"
						}
        			]
	});
	$("div.addbuttonCode4").html('<button id="btnUpdateMultipleVacancy" class="btn btn-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Assign</button>&nbsp;</div>');
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
			var programcategoryTable = $('#dtblProgramcategorySingle').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/get_category_single",
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
							   { "sName": "category_code","bVisible":false,"mRender": function( data, type, full ) {
			                    	return '<input type="hidden" class= "form-control" name="txtCategory[]" value="">';
			               		} },
							   { "sName": "category_name","sWidth": "55%"},
							   { "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
							   			if(data == '0')
										{
											return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusSingle[]"  value="1"  onclick="getCatUpdatecode()"/><div class=\"control__indicator\"></div></label>';
										}
										if(data == '1')
										{
											return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusSingle[]"  value="1"  onclick="getCatUpdatecode()" checked/><div class=\"control__indicator\"></div></label>';
										}
				               },"sClass":"alignCenter"  }
		              	     ],
		        "fnDrawCallback": function(oSettings, json) {
					getCatUpdatecode();
				}       	             
			});
			//var programcategoryTable = $("#dtblProgramcategorySingle").DataTable();
			//programcategoryTable.ajax.url(base_url+"/ajax_controller/get_category_single").load();
		}
		
	});
	$("#cmbProgramFilterVacancy").change(function(){
		
		var program_vac = $("#cmbProgramFilterVacancy").val();
		if(program_vac != '')
		{
			var data = {
					program:program_vac
				};
				var programvacTable = $('#tblProgramVacancy').dataTable({
					"ajax":
					{
						"url": base_url+"/ajax_controller/get_vacancy_single",
						"type": "POST",
						"data": data,
					}, 
					"bPaginate": false,
			        "bLengthChange": true,
			        "bFilter": true,
			        "bSort": false,
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
				                    { "sName": "no_of_vacancy","sWidth": "10%","sClass": "alignCenter","mRender": function( data, type, full ) {
				                    	return '<input type="text" class= "form-control" onkeypress="return isNumberKey(event)"  name="txtAmt[]" value="'+data+'" maxlength="3"><input type="hidden" class= "form-control" name="hidAmt[]" value="'+data+'">';
				               		} }
			        			]
			             	             
				});
			//var programcategoryTable = $("#dtblProgramcategorySingle").DataTable();
			//programcategoryTable.ajax.url(base_url+"/ajax_controller/get_category_single").load();
		}
		
	});
	$("#chkCatUpdate").change(function () {
		if($('#chkCatUpdate').is(":checked"))
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
		//alert(program_codes);
		if(program_codes == '')
		{
			toastr.error('Please Select at least One Post');
		}
		else
		{
			var arr_category_code = new Array();
		    $('input[name="hidCategoryEdit[]"]').each(function(){
		        var category_code = $(this).val();
		        //alert(studentCode);
		        arr_category_code.push(category_code);
		    });
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
		    });	
		    if(arr_cnt == 0)
		    {
				toastr.error("Please Select atleast one category");
			}
			else
			{
				var institutedata={
					program_codes : program_codes,
					category_codes : arr_category_code,
					show_status : arr_show_status
				};
				//alert(institutedata);
				$.ajax({
				    url:base_url+"ajax_controller/update_multiple_category", 
				    type:"post",
				    data:institutedata,
				    success:function(response)
				    {  	
				    	var res = JSON.parse(response); 
						if(res.status == 'SUCCESS')
						{
							//alert("Hello");
							toastr.success(res.msg);
							var programcategoryTable = $('#dtblProgramCategory').DataTable();
							programcategoryTable.ajax.reload();
							/*var dtblProgramcategorySingle = $('#dtblProgramcategorySingle').DataTable();
							dtblProgramcategorySingle.ajax.reload();*/
							$("#cmbProgramSelect option:selected").removeAttr("selected");
							$('#cmbProgramSelect').multiselect('refresh');
							$('#chkCatAll').prop('checked', false);			
							
						}
						else
						{
							toastr.error(res.msg);
							var programcategoryTable = $('#dtblProgramCategory').DataTable();
							programcategoryTable.ajax.reload();
							/*var dtblProgramcategorySingle = $('#dtblProgramcategorySingle').DataTable();
							dtblProgramcategorySingle.ajax.reload();*/
							$("#cmbProgramSelect option:selected").removeAttr("selected");
							$('#cmbProgramSelect').multiselect('refresh');
							$('#chkCatAll').prop('checked', false);			
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
	$("#btnUpdateMultipleVacancy").click(function()
    {
		
		var program_codes = serealizeSelects($('.cmbProgramVacancySelect'));
		//alert(program_codes);
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
			var arr_vacancy = new Array();
		    $('input[name="txttxtVacancyAll[]"]').each(function(){
		        var vacancy = $(this).val();
				if(vacancy == '')
				{
					arr_vacancy.push(0);
					
				}
				else
				{
					arr_vacancy.push(vacancy);
					arr_cnt++;
				}
		    });	
		   // alert(arr_cnt);
		    if(arr_cnt == 0)
		    {
				toastr.error('Please Specify Atleast One Vaccancy Number');
			}
			else
			{
				var institutedata={
				program_codes : program_codes,
				category_codes : arr_category_code,
				vacancy : arr_vacancy
			};
			$.ajax({
			   url:base_url+"ajax_controller/update_multiple_vacancy", 
			    type:"post",
			    data:institutedata,
			    success:function(response)
			    {  
			    	var res = JSON.parse(response); 
					if(res.status)
					{
						toastr.success(res.msg);  
						var programmenuTable = $('#tblProgramVacancyAssign').DataTable();
						programmenuTable.ajax.reload();
						/*var programFee = $("#tblProgramVacancy").DataTable();
						programFee.ajax.reload();*/
						$("#cmbProgramVacancySelect option:selected").removeAttr("selected");
						$('#cmbProgramVacancySelect').multiselect('refresh');	
						
					}
					else
					{
						toastr.error(res.msg);
						var programmenuTable = $('#tblProgramVacancyAssign').DataTable();
						programmenuTable.ajax.reload();
						/*var programFee = $("#tblProgramVacancy").DataTable();
						programFee.ajax.reload();*/
						$("#cmbProgramVacancySelect option:selected").removeAttr("selected");
						$('#cmbProgramVacancySelect').multiselect('refresh');		
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
			//alert(arr_slno);
			var arr_show_status = new Array();
			var arr_cnt = '0';
		    $('input[name="chkStatusSingle[]"]').each(function(){
		        if($(this).is(':checked')){
					arr_show_status.push(1);
					arr_cnt++;
				}
				else
				{
					arr_show_status.push(0);
				}
		    });	
		    
		    if(arr_cnt == 0)
		    {
				toastr.error("Please Select atleast one category");
			}
			else
			{
				var institutedata={
					program_code : program_code,
					show_status : arr_show_status
				};
				
				$.ajax({
				    url:base_url+"/ajax_controller/update_single_category",
				    type:"post",
				    data:institutedata,
				    success:function(response)
				    {  	
				    	var res = JSON.parse(response); 
						if(res.status)
						{
							toastr.success(res.msg);
							var programcategoryTable = $('#dtblProgramCategorySingle').DataTable();
							programcategoryTable.ajax.url(base_url+"/ajax_controller/get_category_all").load();			
							
						}
						else
						{
							toastr.error(res.msg);
							var programcategoryTable = $('#dtblProgramCategorySingle').DataTable();
							programcategoryTable.ajax.url(base_url+"/ajax_controller/get_category_all").load();			
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
	$("#btnUpdateSingleVacancy").click(function()
    {
		var program_code = $("#cmbProgramFilterVacancy").val();
		if(program_code == '')
		{
			toastr.error('Please Select a Post');
		}
		else
		{
			var arr_cnt = '0';
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
					arr_cnt++;
				}
		    });	
		    var arr_category_code = new Array();
		    $('input[name="hidCategory[]"]').each(function(){
		        var category_code = $(this).val();
		        //alert(studentCode);
		        arr_category_code.push(category_code);
		    });
		    if(arr_cnt == 0)
		    {
				toastr.error("Please Specify Atleast One Vaccancy Number");
			}
		    else
		    {
				var institutedata={
				cmbProgramFilter : program_code,
				cmbCategoryEdit : arr_category_code,
				txtAmountEdit : arr_slno
			};
			$.ajax({
			   url:base_url+"/ajax_controller/update_single_vacancy",
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
			//alert(arr_slno);
			
			
		}
    });
	function serealizeSelects (select)
	{
	    var array = [];
	    select.each(function(){ array.push($(this).val()) });
	    return array;
	}
	
	// FOR QUALIFICATION Tab
	
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
	            opt.appendTo(progCheck);
	            progCheck.multiselect('rebuild');
	            options += "<option value='"+item.program_code+"'>"+item.program_name+"</option>";
			});
			$('#cmbFilter').html("");   //campusid from academicPeriod
			$('#cmbFilter').append(options);
			program = $('#cmbFilter').val();
			if(program != '')
			{
				var data = {
					program:program
				};
				var programmenuTable = $('#dtblProgramQualification').dataTable({
					"ajax":
					{
						"url": base_url+"/ajax_controller/get_qualification_single",
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
			                       { "sName": "sl_no","sWidth": "10%"},
			                       { "sName": "qualification_code","sWidth": "60%","mRender": function( data, type, full ) {
			                       		var code = data.split('`');
				                    	return code[1]+'<input type="hidden" class= "form-control" name="txtQlftcnCode[]" value="'+code[0]+'">';
				               		} },
								   { "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
							   			if(data == '0')
										{
											return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkShowSingle[]"  value="1"  onclick="getQualUpdateCode()"/><div class=\"control__indicator\"></div></label>';
										}
										if(data == '1')
										{
											return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkShowSingle[]"  value="1"  onclick="getQualUpdateCode()" checked/><div class=\"control__indicator\"></div></label>';
										}
				               		},"sClass":"alignCenter"  }
			              	     ],
			        "fnDrawCallback": function(oSettings, json) {
		        		getQualUpdateCode();
		        	}       	             
				});
			}
							
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$("#cmbFilter").change(function(){
		var program = $("#cmbFilter").val();
		if(program != '')
		{
			var data = {
				program:program
			};
			var programmenuTable = $('#dtblProgramQualification').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/get_qualification_single",
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
		                       { "sName": "sl_no","sWidth": "10%"},
		                       { "sName": "qualification_code","sWidth": "60%","mRender": function( data, type, full ) {
			                       		var code = data.split('`');
				                    	return code[1]+'<input type="hidden" class= "form-control" name="txtQlftcnCode[]" value="'+code[0]+'">';
				               } },
							   { "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
						   			if(data == '0')
									{
										return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkShowSingle[]"  value="1"  onclick="getQualUpdateCode()"/><div class=\"control__indicator\"></div></label>';
									}
									if(data == '1')
									{
										return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkShowSingle[]"  value="1"  onclick="getQualUpdateCode()" checked/><div class=\"control__indicator\"></div></label>';
									}
			               		},"sClass":"alignCenter"  }
		              	     ],
		        "fnDrawCallback": function(oSettings, json) {
	        		getQualUpdateCode();
	        	}      	             
			});
		}
		
	});
	$("#chkQualUpdate").change(function () {
		if($('#chkQualUpdate').is(":checked"))
		{
			$('input[name="chkShowSingle[]"]').each( function () {
			 	$(this).prop('checked', true);
			});
		}
		else
		{
			$('input[name="chkShowSingle[]"]').each( function () {
			 	$(this).prop('checked', false);
			});
		}
		 
	});
	var programmenuTable = $('#dtblProgramQualificationAssign').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_qualification_all",
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
        /*"sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",*/
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addbuttonCode3' >>><'col-xs-6'p>>", 
		"aoColumns": [    
                       { "sName": "sl_no","sWidth": "10%"},
                       { "sName": "qualification_code","sWidth": "60%","mRender": function( data, type, full ) {
                       		var code = data.split('`');
                       		//alert(data);
	                    	return code[1]+'<input type="hidden" class= "form-control" name="txtCode[]" value="'+code[0]+'">';
	               		} },
					   { "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
	                    		return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusQlfctn[]"  value="1"  onclick="getQualCode()"/><div class=\"control__indicator\"></div></label>';
	               		},"sClass":"alignCenter"  }
              	     ]          
	});
	$("div.addbuttonCode3").html('<button id="btnUpdateMultipleQualification" class="btn btn-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Assign</button>&nbsp;</div>');
	$("#chkQualAll").change(function () {
		if($('#chkQualAll').is(":checked"))
		{
			$('input[name="chkStatusQlfctn[]"]').each( function () {
			 	$(this).prop('checked', true);
			});
		}
		else
		{
			$('input[name="chkStatusQlfctn[]"]').each( function () {
			 	$(this).prop('checked', false);
			});
		}
		 
	});
	$("#btnUpdateMultipleQualification").click(function()
    {
		
		var program_codes = serealizeSelects($('.cmbSelectProgram'));
		if(program_codes == '')
		{
			toastr.error('Please Select at least One Post');
		}
		else
		{
			var arr_qualification_code = new Array();
		    $('input[name="txtCode[]"]').each(function(){
		        var qualification_code = $(this).val();
		        //alert(studentCode);
		        arr_qualification_code.push(qualification_code);
		    });
		    
		    var arr_cnt = '0';
			var arr_show_status = new Array();
		    $('input[name="chkStatusQlfctn[]"]').each(function(){
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
		    if(arr_cnt == 0)
		    {
				toastr.error('Please Select at least One Qualification');
			}
			else
			{
				var institutedata={
					program_codes : program_codes,
					qualification_codes : arr_qualification_code,
					show_status : arr_show_status
				};
				//alert(institutedata);
				$.ajax({
				    url:base_url+"ajax_controller/update_multiple_centre", 
				    type:"post",
				    data:institutedata,
				    success:function(response)
				    {  		
				    	var res = JSON.parse(response); 
						if(res.status == 'SUCCESS')
						{
							toastr.success(res.msg);
							var programcategoryTable = $('#dtblProgramQualificationAssign').DataTable();
							programcategoryTable.ajax.reload();
							/*var programcategoryTable1 = $('#dtblProgramQualification').DataTable();
							programcategoryTable1.ajax.reload();*/
							$("#cmbSelectProgram option:selected").removeAttr("selected");
							$('#cmbSelectProgram').multiselect('refresh');
							$("#chkQualAll").prop('checked', false);		
							
						}
						else
						{
							toastr.error(res.msg);
							var programcategoryTable = $('#dtblProgramQualificationAssign').DataTable();
							programcategoryTable.ajax.reload();
							/*var programcategoryTable = $('#dtblProgramQualification').DataTable();
							programcategoryTable.ajax.reload();*/
							$("#cmbSelectProgram option:selected").removeAttr("selected");
							$('#cmbSelectProgram').multiselect('refresh');
							$("#chkQualAll").prop('checked', false);			
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
	$('#btnUpdateQualification').click(function(){
		var program_code = $("#cmbFilter").val();
		if(program_code == '')
		{
			toastr.error('Please Select a Post');
		}
		else
		{
			//alert(arr_slno);
			var arr_qualification_code = new Array();
		    $('input[name="txtQlftcnCode[]"]').each(function(){
		        var qualification_code = $(this).val();
		        //alert(studentCode);
		        arr_qualification_code.push(qualification_code);
		    });
			var arr_cnt = 0;
			var arr_show_status = new Array();
		    $('input[name="chkShowSingle[]"]').each(function(){
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
			//alert(arr_menu_code);
			if(arr_cnt == 0)
		    {
				toastr.error('Please Select atleast one qualification');
			}
			else
			{
				var institutedata={
					program_code : program_code,
					qualification_code : arr_qualification_code,
					show_status : arr_show_status
				};
				$.ajax({
				    url:base_url+"/ajax_controller/update_single_qualification",
				    type:"post",
				    data:institutedata,
				    success:function(response)
				    {  					
				    	var res = JSON.parse(response); 
						if(res.status)
						{
							toastr.success(res.msg);
							var programmenuTable = $('#dtblProgramQualification').DataTable();
							programmenuTable.ajax.url(base_url+"/ajax_controller/get_qualification_single").load();
							$('#chkQualUpdate').prop('checked', false);		
							
						}
						else
						{
							toastr.error(res.msg);
							var programmenuTable = $('#dtblProgramQualification').DataTable();
							programmenuTable.ajax.url(base_url+"/ajax_controller/get_qualification_single").load();
							$('#chkQualUpdate').prop('checked', false);	
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
	
		
	// *************************************************************** FOR NODAL CENTER TO COUNTER MAPPING ***********************************************************
	
	/*var ApplicationDetail = $('#tblNodalCentre').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/select_program_qual_stream",
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
		"sDom":"<'row'<'col-xs-4 addbuttonNodalCounterMapping'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6'i >>><'col-xs-6'p>>",
		"aoColumns": [
						{ "sName": "sl_no","sWidth": "5%"},
						{ "sName": "program_code","bVisible": false},
						{ "sName": "program_name","sWidth": "15%"},
						{ "sName": "qualification_code","bVisible": false},
						{ "sName": "qualification_name","sWidth": "15%"},
						{ "sName": "stream_code","bVisible": false},
						{ "sName": "stream_name","sWidth": "15%"},
						{"sName": "default","sWidth": "15%", "sClass":"dt-center", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='nodalCounterMappingRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>\
			            <button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='nodalCounterMappingRow(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}
        			]
	});
	$("div.addbuttonNodalCounterMapping").html("<button id='btnAddNodalCounterMapping' class='btn btn-info btn-circle tooltips' title='Add Counter'><i class='fa fa-plus'></i></button>");	
	
	// get counter code name from database
	$.ajax({
		url:base_url+"ajax_controller/select_Stream_Code",
		type:"post",
		success:function(response){  
			var options = "";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value='"+data.stream_code+"'>"+data.stream_name+"</option>";
				
			});	
			$('#cmbStreamCodeEdit').html("")   //campusid from academicPeriod
			$('#cmbStreamCodeEdit').append(options);	
			$('#cmbStreamCode').html("")   //campusid from academicPeriod
			$('#cmbStreamCode').append(options);	
			$('#cmbStreamCode').multiselect({
		        enableFiltering: true,
		        includeSelectAllOption:true,
				enableCaseInsensitiveFiltering:true,
				numberDisplayed: 1,
				buttonWidth:"360px"
		 	});
			$("#cmbStreamCode").multiselect('refresh');
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	// get nodal center name from database
	$.ajax({
		url:base_url+"ajax_controller/select_program_Stream_Code",
		type:"post",
		success:function(response){  
			var options = "<option value=''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value='"+data.program_code+"'>"+data.program_name+"</option>";
				
			});
			$('#cmbProgramCode').html("")   //campusid from academicPeriod
			$('#cmbProgramCode').append(options);	
			var program_code = $("#cmbProgramCode").val();
			var institutedata={
				program_code:program_code
			};
			// get nodal center name from database
			$.ajax({
				url:base_url+"ajax_controller/select_qual_Stream_Code",
				type:"post",
				data:institutedata,
				success:function(response){  
					var options = "<option value=''>Select</option>";
					var res1 = JSON.parse(response);
					$.each(res1.aaData,function(i,data){
						options = options + "<option value='"+data.qualification_code+"'>"+data.qualification_name+"</option>";
						
					});
					$('#cmbQualificationCode').html("")   //campusid from academicPeriod
					$('#cmbQualificationCode').append(options);	
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$.ajax({
		url:base_url+"ajax_controller/select_qual_Stream_Code",
		type:"post",
		data:'',
		success:function(response){  
			var options = "<option value=''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value='"+data.qualification_code+"'>"+data.qualification_name+"</option>";
				
			});
			$('#cmbQualificationCode').html("")   //campusid from academicPeriod
			$('#cmbQualificationCode').append(options);	
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$("#cmbProgramCode").change(function () {
		var program_code = $("#cmbProgramCode").val();
		var institutedata={
			program_code:program_code
		};
		// get nodal center name from database
		$.ajax({
			url:base_url+"ajax_controller/select_qual_Stream_Code",
			type:"post",
			data:institutedata,
			success:function(response){  
				var options = "<option value=''>Select</option>";
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data){
					options = options + "<option value='"+data.qualification_code+"'>"+data.qualification_name+"</option>";
					
				});
				$('#cmbQualificationCode').html("")   //campusid from academicPeriod
				$('#cmbQualificationCode').append(options);	
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	});
	*/
	//ADD button clicked
	$('#btnAddNodalCounterMapping').click(function()
	{
		$('#frmNodalCentre').data('bootstrapValidator').resetForm(true);
		$('#cmbProgramCode').prop( "disabled", false);
		$('#cmbQualificationCode').prop( "disabled", false);
		$('#cmbProgramCode').val("");
		$('#cmbQualificationCode').val("");
		$('#cmbStreamCode').val("");
		$('#CounterCodeEdit').hide();
		$('#CounterCode').show();
		$("#cmbStreamCode").multiselect('rebuild');
		$("#myModalLabel").html("Add Record");
		$("#btnSaveNodalCentre").html("Add");
		
		
		$('#modalNodalCounterMapping').modal('show');
		$('#modalNodalCounterMapping').on('shown.bs.modal', function()
		{  
			$('#txtCounterNumber').focus();// Focusing the textbox
		})	
	});

	
	//ADD/UPDATE RECORD WITH VALIDATION	
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
				oper = 'ADD_ProgQualStreamMapping';
			else if(oper == 'Update')
				oper = 'UPDATE_ProgQualStreamMapping';
				
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
						var tblNodalCentre = $("#tblNodalCentre").DataTable();
			 			tblNodalCentre.ajax.reload();
			 			$('#frmNodalCentre').data('bootstrapValidator').resetForm(true);	
						toastr.success(res.msg);
						if(oper != 'ADD_NodalCounterMapping')
						{
							$('#modalNodalCounterMapping').modal('hide');
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
            cmbNodalCode: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            cmbCounterCode: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }
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
function edit(event){
	var session = $('#hidSessionCode').val();
	var oTable = $('#tblCenterMaster').dataTable();
	var row;
	//alert(event.target.tagName);
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	else
  		row = event.target.parentNode;
	//$(row).addClass('success');
	var centreCode = oTable.fnGetData(row)['exam_centre_code'];
	var programCode = oTable.fnGetData(row)['program_code'];
	var programName = oTable.fnGetData(row)['exam_centre_name'];
   	$('#hidProgramCodeEdit').val(programCode);//GETTING VALUE FOR HIDDEN COLUMN
   	$('#hidCentreCodeEdit').val(centreCode);//GETTING VALUE FOR HIDDEN COLUMN
	$('#hidUniqueidEdit').val(programName);
	$('#txtExamCentreNameEdit').val(oTable.fnGetData(row)['exam_centre_name']);
	
	var selectedText2 = oTable.fnGetData(row)['record_status'];
	$("#cmbStatusEdit option").each(function () 
	{
		if ($(this).html() == selectedText2)
	 	{
			$(this).attr("selected", "selected");
			return;
		}
	});
	$('#centreEditModal').modal('show');
	
	$('#frmCentreEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			$('#centreEditModal').modal('hide');
			var institutedata={
				hidProgramCodeEdit:$('#hidProgramCodeEdit').val(),
				txtExamCentreCodeEdit:$('#hidCentreCodeEdit').val(),
				txtExamCentreNameEdit:$('#txtExamCentreNameEdit').val(),
				cmbStatusEdit:$('#cmbStatusEdit').val(),
				type:"UPDATE_CENTRE"
			};
			//ajax call to server
			$.ajax({
				url:"profile_db.php?_s="+session,
				mType:"post",
				data:institutedata,
				success:function(){ 
					var dtblCenter = $("#tblCenterMaster").DataTable();
					dtblCenter.ajax.reload();
					toastr.success('Data Successfully Updated');
					$('#CentreEditModal').modal('hide'); 
					$('#frmCentreEdit').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
					$('#txtExamCentreCodeEdit').val("");
					$('#txtExamCentreNameEdit').val("");
					$('#CentreEditModal').modal('hide');	
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields:{
			txtExamCentreNameEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
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
function chkCentreCode()
{
	
	$("[name='chkCentre[]']").change(function () {
		if($('input[name="chkCentre[]"][type=checkbox]').length == 0)
		{
			 $('#chkAll').prop('checked', false);
		}
		else
		{ 
	        if ($('input[name="chkCentre[]"][type=checkbox]:checked').length == $('input[name="chkCentre[]"][type=checkbox]').length) 
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
function getQualCode()
{
	
	$("[name='chkStatusQlfctn[]']").change(function () {
       	if($('input[name="chkStatusQlfctn[]"][type=checkbox]').length == 0)
		{
			 $('#chkQualAll').prop('checked', false);
		}
		else
		{ 
			if ($('input[name="chkStatusQlfctn[]"][type=checkbox]:checked').length == $('input[name="chkStatusQlfctn[]"][type=checkbox]').length) 
	        {
	            $('#chkQualAll').prop('checked', true);
	        } 
	        else 
	        {
	            $('#chkQualAll').prop('checked', false);
	        }
	    }
    });
}
function getCatcode()
{
	
	$("[name='chkStatus[]']").change(function () {
		if($('input[name="chkStatus[]"][type=checkbox]').length == 0)
		{
			 $('#chkCatAll').prop('checked', false);
		}
		else
		{
	        if ($('input[name="chkStatus[]"][type=checkbox]:checked').length == $('input[name="chkStatus[]"][type=checkbox]').length) 
	        {
	            $('#chkCatAll').prop('checked', true);
	        } 
	        else 
	        {
	            $('#chkCatAll').prop('checked', false);
	        }
	    }
    });
}
function getCatUpdatecode()
{
    if($('input[name="chkStatusSingle[]"][type=checkbox]').length == 0)
	{
		 $('#chkCatUpdate').prop('checked', false);
	}
	else
	{
		if ($('input[name="chkStatusSingle[]"][type=checkbox]:checked').length == $('input[name="chkStatusSingle[]"][type=checkbox]').length) 
	    {
	        $('#chkCatUpdate').prop('checked', true);
	    } 
	    else 
	    {
	        $('#chkCatUpdate').prop('checked', false);
	    }
	}
}
function getQualUpdateCode()
{
	if($('input[name="chkShowSingle[]"][type=checkbox]').length == 0)
	{
		 $('#chkQualUpdate').prop('checked', false);
	}
	else
	{
		if ($('input[name="chkShowSingle[]"][type=checkbox]:checked').length == $('input[name="chkShowSingle[]"][type=checkbox]').length) 
	    {
	        $('#chkQualUpdate').prop('checked', true);
	    } 
	    else 
	    {
	        $('#chkQualUpdate').prop('checked', false);
	    }
	}
    
}
function getCodeUpdate()
{
	if($('input[name="chkStatusCentre[]"][type=checkbox]').length == 0)
	{
		 $('#chkCentreUpdate').prop('checked', false);
	}
	else
	{
	    if ($('input[name="chkStatusCentre[]"][type=checkbox]:checked').length == $('input[name="chkStatusCentre[]"][type=checkbox]').length) 
	    {
	        $('#chkCentreUpdate').prop('checked', true);
	    } 
	    else 
	    {
	        $('#chkCentreUpdate').prop('checked', false);
	    }
	}
}

// ************************************************** FOR NODAL CENTER TO COUNTER MAPPING ****************************
function nodalCounterMappingRow(event,action)
{
	var oTable = $('#tblNodalCentre').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;
	$('#CounterCodeEdit').show();
	$('#CounterCode').hide();
	$('#frmNodalCentre').data('bootstrapValidator').resetForm(true);
	$('#hidProgramCode').val( oTable.fnGetData(row)['program_code']);
	$('#hidStreamCode').val( oTable.fnGetData(row)['stream_code']);
	$('#hidQualCode').val( oTable.fnGetData(row)['qualification_code']);
	$('#cmbProgramCode').prop( "disabled", true);
	$('#cmbQualificationCode').prop( "disabled", true);
	$('#cmbProgramCode').val( oTable.fnGetData(row)['program_code']);
	$('#cmbQualificationCode').val( oTable.fnGetData(row)['qualification_code']);
	$('#cmbStreamCodeEdit').val( oTable.fnGetData(row)['stream_code']);
	
	if(action == 'edit')
	{
		$("#myModalLabel").html("Update Record");
		$("#btnSaveNodalCentre").html("Update");
		$('#modalNodalCounterMapping').modal('show');
	}	
	else
	{
		swal({
		  title: "Are you sure?",
		  text: "You want to Delete the Qualification to Stream Mapping!",
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
		    swal("Deleted", " Qualification to Stream has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", " Qualification to Stream to Counter Mapping is safe ", "error");
		  }
		});
	    function deleteMaster(){ 
			var institutedata=
			{
				hidProgramCode:$('#hidProgramCode').val(),
				hidQualCode:$('#hidQualCode').val(),
				hidStreamCode:$('#hidStreamCode').val(),
				type:"operation_deleteQualStreamMapping"
			};	
			type = 'operation_deleteQualStreamMapping';	
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
						var tblNodalCentre = $("#tblNodalCentre").DataTable();
		 				tblNodalCentre.ajax.reload();
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



// for exam center tab
	
	
		//$("div.institutegroupbutton").html('<div class="btngroup"><button id="btnAddCentre" class="btn btn-info custombtn">Add</button><button class="btn btn-info custombtn" id="btnEditCentre">Edit</button></div>');
/*****END OF BUTTON CREATION******/
	
	
	$("#cmbProgram").change(function(){
		
		var program_code = $("#cmbProgram").val();
		$('#hidProgramCode').val(program_code);
		$('#hidProgramCodeEdit').val(program_code);
		if(program_code !='')
		{
			var challanMaster = $('#tblCenterMaster').dataTable({
			
			"ajax":
			{
				"url": base_url+"/ajax_controller/get_exam_centre_single",
				"type": "POST",
				"data": {'program':program_code}
			},  
			"bPaginate": false,
	        "bLengthChange": false,
	        "bFilter": true,
	        "bSort": false,
		"bSearchable":true,
	        "bInfo": true,
	        "bAutoWidth":false, 
	        "bDestroy": true, 
			"sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
			"aoColumns": [
	                     { "sName": "Slno","sWidth": "15%" },
						 /*{ "sName": "program_code","bVisible":false },*/
						 { "sName": "exam_centre_code","bVisible":false },
	                     { "sName": "exam_center_name" },
						 { "sName": "select","sWidth": "17%","mRender": function( data, type, full ) {
					   			if(data == '0')
								{
									return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusCentre[]"  value="1"  onclick="getCodeUpdate()"/><div class=\"control__indicator\"></div></label>';
								}
								if(data == '1')
								{
									return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusCentre[]"  value="1"  onclick="getCodeUpdate()" checked/><div class=\"control__indicator\"></div></label>';
								}
		               		},"sClass":"alignCenter"  }
        			],
        	"fnDrawCallback": function(oSettings, json) {
        		getCodeUpdate();
        	}
		});
		/**CREATING BUTTON*****/
		//$("div.addCoursebtn").html('<button class="btn btn-info tooltips btn-circle" title="Add" id="btnAddCentre"><i class="fa fa-plus" aria-hidden="true"></i></button>');
			/**CREATING BUTTON*****/
		//$("div.institutegroupbutton").html('<div class="btngroup"><button id="btnAddCentre" class="btn btn-info custombtn">Add</button><button class="btn btn-info custombtn" id="btnEditCentre">Edit</button></div>');
/*****END OF BUTTON CREATION******/
		}
		$('#btnAddCentre').click(function(){
		//alert("hello");
			//$('#frmAddCentre').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
			$('#txtExamCentreCode').val("");
			$('#txtExamCentreName').val("");
			
			$('#txtStatus').val("");
			
			$('#centreAddModal').modal('show');
			$('#centreAddModal').on('shown.bs.modal', function () 
			{ 
				$('#txtExamCentreCode').focus(); // Focusing the textbox
			})
		});
    });
    $("#chkCentreUpdate").change(function () {
		if($('#chkCentreUpdate').is(":checked"))
		{
			$('input[name="chkStatusCentre[]"]').each( function () {
			 	$(this).prop('checked', true);
			});
		}
		else
		{
			$('input[name="chkStatusCentre[]"]').each( function () {
			 	$(this).prop('checked', false);
			});
		}
		 
	});
	
    var dtblExamCentreAdd = $('#tblCenterAdd').dataTable({
		
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_exam_centre_multiple",
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
        /*"sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",*/
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addbuttonCode2' >>><'col-xs-6'p>>", 
		"aoColumns": [    
                        { "sName": "Slno","sWidth":"10%" },
						{ "sName": "exam_centre_code","sWidth":"20%" ,"mRender": function( data, type, full ) {
	                    	return data+'<input type="hidden" name="txtCentreCode[]" value="'+data+'">';
	               	    }},
	                    { "sName": "exam_centre_name","sWidth":"40%" ,"mRender": function( data, type, full ) {
	                    	return data+'<input type="hidden" name="txtCentreName[]" value="'+data+'">';
	               	    } },
					    { "sName": "select","sWidth": "10%","iDataSort":6,"sClass":"alignCenter" ,"mRender": function( data, type, full ) {
	                    	return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkCentre[]"  value="1"  onclick="chkCentreCode()"/><div class=\"control__indicator\"></div></label>';
	               	    }}
					   
              	     ],
        "fnDrawCallback": function(oSettings, json) {
	        $('input[class=flat-red]').iCheck({
				checkboxClass: 'icheckbox_flat-blue',
				radioClass: 'icheckbox_flat-blue'
			}); 
		}        	             
	});
	$("div.addbuttonCode2").html('<button id="btnUpdateCentreMultiple" class="btn btn-success"><i class="fa fa-check-square-o" aria-hidden="true"></i> Assign</button>&nbsp;</div>');
	$("#chkAll").change(function () {
		if($('#chkAll').is(":checked"))
		{
			$('input[name="chkCentre[]"]').each( function () {
			 	$(this).prop('checked', true);
			});
		}
		else
		{
			$('input[name="chkCentre[]"]').each( function () {
			 	$(this).prop('checked', false);
			});
		}
		 
	});
	$("#btnUpdateCentre").click(function()
    {
		var program_code = $("#cmbProgram").val();
		if(program_code == '')
		{
			toastr.error('Please Select a Post');
		}
		else
		{
			var arr_cnt = 0;
			var arr_show_status = new Array();
		    $('input[name="chkStatusCentre[]"]').each(function(){
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
		    
		    if(arr_cnt == 0)
		    {
				toastr.error('Please Select atleast one Centre');
			}
			else
			{
				var institutedata={
					program_code : program_code,
					show_status : arr_show_status
				};
				$.ajax({
				    url:base_url+"/ajax_controller/update_exam_centre",
				    type:"post",
				    data:institutedata,
				    success:function(response)
				    {  					
				    	var result = JSON.parse(response);
						if(result.dbStatus=='SUCCESS')
						{
							toastr.success(result.dbMessage);  
							var dtblExamCentreSingle = $('#tblCenterMaster').DataTable();
							dtblExamCentreSingle.ajax.reload();
							//$('#chkCentreUpdate').prop('checked', false);
				    	}
				    	else
						{
							toastr.error(result.dbMessage);
							var dtblExamCentreSingle = $('#tblCenterMaster').DataTable();
							dtblExamCentreSingle.ajax.reload();
							//$('#chkCentreUpdate').prop('checked', false);
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
	$("#btnUpdateCentreMultiple").click(function()
    {
		var program_codes = serealizeSelects($('.cmbProgramMultiple'));
		if(program_codes == '')
		{
			toastr.error('Please Select at least One Post');
		}
		else
		{
			var arr_centre_code = new Array();
		    $('input[name="txtCentreCode[]"]').each(function(){
		        var centre_code = $(this).val();
		        arr_centre_code.push(centre_code);
		    });
		    var arr_centre_name = new Array();
		    $('input[name="txtCentreName[]"]').each(function(){
		        var centre_name = $(this).val();
		        arr_centre_name.push(centre_name);
		    });
		    var arr_cnt = 0;
			var arr_show_status = new Array();
		    $('input[name="chkCentre[]"]').each(function(){
		        if($(this).is(':checked')){
					arr_show_status.push(1);
					arr_cnt++;
				}
				else
				{
					arr_show_status.push(0);
				}
		        
		    });	
		    if(arr_cnt == 0)
		    {
				toastr.error('Please Select atleast one Centre');
			}
			else
			{
				var institutedata={
					program_codes : program_codes,
					centre_code : arr_centre_code,
					centre_name : arr_centre_name,
					show_status : arr_show_status
				};
				//alert(institutedata);
				$.ajax({
				    url:base_url+"ajax_controller/update_multiple_exam_centre",
				    type:"post",
				    data:institutedata,
				    success:function(response)
				    {  					
				    	var result = JSON.parse(response);
						if(result.status=='SUCCESS')
						{
							toastr.success(result.msg);  
							var dtblExamCentreAdd = $('#tblCenterAdd').DataTable();
							dtblExamCentreAdd.ajax.reload();
							var tblCenterMaster = $('#tblCenterMaster').DataTable();
							tblCenterMaster.ajax.reload();
							$("#cmbProgramMultiple option:selected").removeAttr("selected");
							$('#cmbProgramMultiple').multiselect('refresh');
							$('#cmbProgramGroupExamSingle').multiselect('refresh');
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
		}
    });
	$.ajax({
		url:base_url+"/ajax_controller/get_exam_centre_multiple",
		mType:"get",
		data:'',
		success:function(response)
		{  
			var options = "<option value=''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.exam_centre_code+">"+data.exam_centre_name+"</option>";
			});
			$('#txtExamCentreCode').html("");   //campusid from academicPeriod
			$('#txtExamCentreCode').append(options);	
		},
		error:function()
		{
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
	
	
	/*$.ajax({
		url:base_url+"ajax_controller/select_program_data", 
		type:"post",
		success:function(response){  
			var options = "<option value=''>Select Post</option> ";
			var res1 = JSON.parse(response);
			 $.each(res1.aaData, function (index, item) {
	            var opt = $('<option />', {
	                value: item.program_code,
	                text: item.program_name
	            });
	            opt.appendTo(dcCheck);
	            dcCheck.multiselect('rebuild');
			   options = options + "<option value="+item.program_code+">"+item.program_name+"</option>";
    		});
			$('#cmbProgramFilterdc').html("");   //campusid from academicPeriod
			$('#cmbProgramFilterdc').append(options);
			program = $('#cmbProgramFilterdc').val();
			if(program != '')
			{
				//alert("dhgbnfdg");
				var data = {
					program:program
				};
				var programDcTable = $('#dtblProgramDcSingle').dataTable({
					"ajax":
					{
						"url": base_url+"/ajax_controller/get_dc_single",
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
								   { "sName": "DC_code","bVisible":false,"mRender": function( data, type, full ) {
				                    	return '<input type="hidden" class= "form-control" name="txtDc[]" value="">';
				               		} },
								   { "sName": "DC_name","sWidth": "55%"},
								   { "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
								   			if(data == '0')
											{
												return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusSingledc[]"  value="1"  onclick="getdcUpdatecode()"/><div class=\"control__indicator\"></div></label>';
											}
											if(data == '1')
											{
												return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusSingledc[]"  value="1"  onclick="getdcUpdatecode()" checked/><div class=\"control__indicator\"></div></label>';
											}
					               },"sClass":"alignCenter"  }
			              	     ],
			        //"fnDrawCallback": function(oSettings, json) {
					//	getdcUpdatecode();
					//}       	             
				});
			}			
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});*/
	var programDcTable = $('#dtblProgramDc').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_dc_all",
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
					   { "sName": "DC_code","bVisible":false,"data":null,"mRender": function( data, type, full ) {
	                    	return '<input type="hidden" class= "form-control" name="txtDc[]" value="">';
	               		} },
					   { "sName": "DC_name","sWidth": "55%"},
					   { "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
	                    		return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatus1dc[]"  value="1"  onclick="getDccode()"/><input type="hidden" name="hidDcEdit[]" value="'+data+'"/><div class=\"control__indicator\"></div></label>';
	               		},"sClass":"alignCenter"  }
              	     ]       
	});
	/*function customCheckbox(checkboxName){
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
    }*/
	$("#cmbProgramFilterdc").change(function(){
		
		var program = $("#cmbProgramFilterdc").val();
		
		if(program != '')
		{ //alert(program);
			var data = {
				program:program
			};
			var programDcTable = $('#dtblProgramDcSingle').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/get_dc_single",
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
							   { "sName": "DC_code","bVisible":false,"mRender": function( data, type, full ) {
			                    	return '<input type="hidden" class= "form-control" name="txtDc[]" value="">';
			               		} },
							   { "sName": "DC_name","sWidth": "55%"},
							   { "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
							   			if(data == '0')
										{
											return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusSingledc[]"  value="1"  onclick="getdcUpdatecode()"/><div class=\"control__indicator\"></div></label>';
										}
										if(data == '1')
										{
											return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkStatusSingledc[]"  value="1"  onclick="getdcUpdatecode()" checked/><div class=\"control__indicator\"></div></label>';
										}
				               },"sClass":"alignCenter"  }
		              	     ],
		        /*"fnDrawCallback": function(oSettings, json) {
					getdcUpdatecode();
				}  */     	             
			});
			//var programDcTable = $("#dtblProgramDcSingle").DataTable();
			//programDcTable.ajax.url(base_url+"/ajax_controller/get_category_single").load();
		}
		
	});
	$("#chkDcUpdate").change(function () {
		if($('#chkDcUpdate').is(":checked"))
		{
			$('input[name="chkStatusSingledc[]"]').each( function () {
			 	$(this).prop('checked', true);
			});
		}
		else
		{
			$('input[name="chkStatusSingledc[]"]').each( function () {
			 	$(this).prop('checked', false);
			});
		}
		 
	});
	
	$("#btnUpdateMultipleDc").click(function()
    {
		
		var program_codes = serealizeSelects($('.cmbProgramSelectdc'));
		//alert(program_codes);
		if(program_codes == '')
		{
			toastr.error('Please Select at least One Post');
		}
		else
		{
			var arr_dc_code = new Array();
		    $('input[name="hidDcEdit[]"]').each(function(){
		        var dc_code = $(this).val();
		        //alert(studentCode);
		        arr_dc_code.push(dc_code);
		    });
			var arr_show_status = new Array();
		    $('input[name="chkStatus1dc[]"]').each(function(){
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
				dc_code : arr_dc_code,
				show_status : arr_show_status
			};
			//alert(institutedata);
			$.ajax({
			    url:base_url+"ajax_controller/update_multiple_dc", 
			    type:"post",
			    data:institutedata,
			    success:function(response)
			    {  	
			    	var res = JSON.parse(response); 
					if(res.status=='SUCCESS')
					{
						toastr.success(res.msg);
						var programDcTable = $('#dtblProgramDc').DataTable();
						programDcTable.ajax.reload();
						$("#cmbProgramSelectdc option:selected").removeAttr("selected");
						$('#cmbProgramSelectdc').multiselect('refresh');
						$('#chkDcAll').prop('checked', false);		
						$('input[name="chkStatus1dc[]"]').prop('checked', false);	
						
					}
					else
					{
						toastr.error(res.msg);
						var programDcTable = $('#dtblProgramDc').DataTable();
						programDcTable.ajax.reload();
						var programDcTable = $('#dtblProgramDcSingle').DataTable();
						programDcTable.ajax.reload();
						$("#cmbProgramSelectdc option:selected").removeAttr("selected");
						$('#cmbProgramSelectdc').multiselect('refresh');
						$('#chkDcAll').prop('checked', false);		
						$('input[name="chkStatus1dc[]"]').prop('checked', false);		
					}	
			    },
			    error:function()
			    {
			     	toastr.error('We are unable to process please contact support'); 
			    }
		   }); 
			
		}
    });
	$("#chkDcAll").change(function () {
		if($('#chkDcAll').is(":checked"))
		{
			$('input[name="chkStatus1dc[]"]').each( function () {
			 	$(this).prop('checked', true);
			});
		}
		else
		{
			alert("dsadas");
			$('input[name="chkStatus1dc[]"]').each( function () {
			 	$(this).prop('checked', false);
			});
		}
		 
	});
	$("#btnUpdateSingleDc").click(function()
    {
		
		var program_code = $("#cmbProgramFilterdc").val();
		if(program_code == '')
		{
			toastr.error('Please Select a Program');
		}
		else
		{
			//alert(arr_slno);
			var arr_show_status = new Array();
		    $('input[name="chkStatusSingledc[]"]').each(function(){
		        if($(this).is(':checked')){
					arr_show_status.push(1);
				}
				else
				{
					arr_show_status.push(0);
				}
		    });	
			var institutedata={
				program_code : program_code,
				show_status : arr_show_status
			};
			
			$.ajax({
			    url:base_url+"/ajax_controller/update_single_dc",
			    type:"post",
			    data:institutedata,
			    success:function(response)
			    {  	
			    	var res = JSON.parse(response); 
					if(res.status)
					{
						toastr.success(res.msg);
						var programDcTable = $('#dtblProgramDc').DataTable();
						programDcTable.ajax.url(base_url+"/ajax_controller/get_dc_all").load();			
						
					}
					else
					{
						toastr.error(res.msg);
						var programDcTable = $('#dtblProgramDc').DataTable();
						programDcTable.ajax.url(base_url+"/ajax_controller/get_dc_all").load();			
					}	
			    },
			    error:function()
			    {
			     	toastr.error('We are unable to process please contact support'); 
			    }
		   }); 
			
		}
    });
	function serealizeSelects (select)
	{
	    var array = [];
	    select.each(function(){ array.push($(this).val()) });
	    return array;
	}
	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode != 46 && charCode > 31 
			&& (charCode < 48 || charCode > 57))
			return false;

		return true;
	}
	