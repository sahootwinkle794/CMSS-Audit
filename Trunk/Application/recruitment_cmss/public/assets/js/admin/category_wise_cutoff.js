$(document).ready(function(){
	var session = $('#hidSessionCode').val();
	var categVacancyCheck  = $('#cmbProgramVacancySelect').multiselect({
	    includeSelectAllOption: true,
	    enableFiltering : false,
		buttonWidth: '200px',
		numberDisplayed: 0
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
			$('#cmbProgramGroupVacancy').html("");   
			$('#cmbProgramGroupVacancy').append(options);
			$('#cmbProgramGroupVacancySingle').html("");   
			$('#cmbProgramGroupVacancySingle').append(options);
			
		},
		error:function()
		{
			toastr.error("We are unable to Process.Please contact Support");
		}
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
	            opt.appendTo(categVacancyCheck);
	            categVacancyCheck.multiselect('rebuild');
			   options = options + "<option value="+item.program_code+">"+item.program_name+"</option>";
    		}); //campusid from academicPeriod
			$('#cmbProgramFilterVacancy').html("");  
			$('#cmbProgramFilterVacancy').append(options);
			program_vac = $('#cmbProgramFilterVacancy').val();
				
			if(program_vac != '')
			{
				var data = {
					program:program_vac
				};
				var programvacTable = $('#tblProgramVacancy').dataTable({
					"ajax":
					{
						"url": base_url+"/ajax_controller/get_vacancy_cutoff_single",
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
				                    { "sName": "no_of_vacancy","sWidth": "10%","sClass": "alignCenter","mRender": function( data, type, full ) {
				                    	return '<input type="text" class= "form-control" name="txtAmt[]"  onkeypress="return isNumberKey(event)"  value="'+data+'"><input type="hidden" class= "form-control" name="hidAmt[]" value="'+data+'">';
				               		} }
			        			]
			             	             
				});
			}			
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
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
        "bSort": true,
        "bInfo": true,
        "bDestroy" : true,
        "bAutoWidth": true,
		"sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
		"aoColumns": [
						{ "sName": "sl_no","sWidth": "15%"},
						{ "sName": "category_code","bVisible":false,"mRender": function( data, type, full ) {
								return '<input type="hidden" class= "form-control" name="txtfeeCategory[]" value="'+data+'">';
							} 
						},
						{ "sName": "category_name","sWidth": "55%"},
						{ "sName": "select","sWidth": "10%","mRender": function( data, type, full ) {
								var feeAmtId = data.split('`');
								return '<input type="text" class= "form-control" onkeypress="return isNumberKey(event)"  id="txtVacancy'+data+'"   name="txttxtVacancyAll[]" value=""><input type="hidden" class= "form-control" name="txtfeeCategory[]" value="'+data+'">';
							},"sClass":"dt-center"
						}
        			]
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
						"url": base_url+"/ajax_controller/get_vacancy_cutoff_single",
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
				                    { "sName": "no_of_vacancy","sWidth": "10%","sClass": "alignCenter","mRender": function( data, type, full ) {
				                    	return '<input type="text" class= "form-control" onkeypress="return isNumberKey(event)"  name="txtAmt[]" value="'+data+'"><input type="hidden" class= "form-control" name="hidAmt[]" value="'+data+'">';
				               		} }
			        			]
			             	             
				});
			//var programcategoryTable = $("#dtblProgramcategorySingle").DataTable();
			//programcategoryTable.ajax.url(base_url+"/ajax_controller/get_category_single").load();
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
		    if(arr_cnt == 0)
		    {
				toastr.error('Please Specify Atleast One Cutoff Marks');
			}
			else
			{
				var institutedata={
				program_codes : program_codes,
				category_codes : arr_category_code,
				vacancy : arr_vacancy
			};
			$.ajax({
			   url:base_url+"ajax_controller/update_multiple_cutoff_vacancy", 
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
						//var programFee = $("#tblProgramVacancy").DataTable();
						//programFee.ajax.reload();
						$("#cmbProgramVacancySelect option:selected").removeAttr("selected");
						$('#cmbProgramVacancySelect').multiselect('refresh');	
						
					}
					else
					{
						toastr.error(res.msg);
						var programmenuTable = $('#tblProgramVacancyAssign').DataTable();
						programmenuTable.ajax.reload();
						var programFee = $("#tblProgramVacancy").DataTable();
						programFee.ajax.reload();
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
	$("#btnUpdateSingleVacancy").click(function()
    {
		var program_code = $("#cmbProgramFilterVacancy").val();
		if(program_code == '')
		{
			toastr.error('Please Select a Post');
		}
		else
		{
			var arr_slno = new Array();
			var arr_cnt = '0';
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
			//alert(arr_slno);
			if(arr_cnt == 0)
		    {
				toastr.error('Please Specify Atleast One Cutoff Marks');
			}
			else
			{
				var institutedata={
				cmbProgramFilter : program_code,
				cmbCategoryEdit : arr_category_code,
				txtAmountEdit : arr_slno
			};
			$.ajax({
			   url:base_url+"/ajax_controller/assign_single_cutoff_vacancy",
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
			
			
		}
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

	function serealizeSelects (select)
	{
	    var array = [];
	    select.each(function(){ array.push($(this).val()) });
	    return array;
	}
	