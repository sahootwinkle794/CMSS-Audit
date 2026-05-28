$(document).ready(function(){
	var session = $('#hidSessionCode').val();
	$("#bulk").hide();
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
	$('#cmbRound').change(function()
	{
		$('#bulk').show();   
		var institutedata = {
			program:$('#cmbProgram').val(),
			program_group:$('#cmbProgramGroup').val(),
			round_data:$('#cmbRound').val()
		};
		
		var programmenuTable = $('#dtblProgramMenu').dataTable({
			"ajax":
			{
				"url": base_url+"/ajax_controller/select_published_applicants",
				"type": "POST",
				"data": institutedata
			},
			"bPaginate": false,
	        "bLengthChange": false,
	        "bFilter": true,
	        "bSort": true,
	        "bInfo": true,
	        "bAutoWidth":false, 
	        "bDestroy": true,   
	        "sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
			"aoColumns": [    
	                        { "sName": "sl_no" ,"sWidth":"5%"},
							{ "sName": "full_name"},
		                    { "sName": "appl_no","sWidth": "55%","mRender": function( data, type, full ) {
			                    	var appl_no = data;
			                    	return appl_no+'<input type="hidden" class= "form-control" name="hidApplNo[]" value="'+appl_no+'">';
			               		} },
							
							{ "sName": "select","sWidth": "15%","iDataSort":6,"sClass":"dt-center","mRender": function( data, type, full ) {
									var menu_status = data.split('@');
									if(menu_status[3] == 'NO')
									{
										return '<span> Not Uploaded</span>';
									}
									else
									{
										return '<span> Uploaded</span>';
									}
		                    		//return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkShow[]"  value="'+menu_status[0]+'"  onclick="getCode()"/><div class=\"control__indicator\"></div></label><input type="hidden" name="hidMenuCode[]" value="'+menu_status[0]+'" /><input type="hidden" name="hidDocumentStatusAssign[]" value="'+menu_status[1]+'" /><input type="hidden" name="hidAppliedProgram[]" value="'+menu_status[2]+'" />';
		               			}  
		               		},
							{ "sName": "select","sWidth": "15%","iDataSort":6,"sClass":"dt-center","mRender": function( data, type, full ) {
									var Ansewr_key = data;
									if(Ansewr_key == 'YES')
									{
										return '<span> Yes</span>';
									}
									else
									{
										return '<span> No</span>';
									}
		                    		//return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkShow[]"  value="'+menu_status[0]+'"  onclick="getCode()"/><div class=\"control__indicator\"></div></label><input type="hidden" name="hidMenuCode[]" value="'+menu_status[0]+'" /><input type="hidden" name="hidDocumentStatusAssign[]" value="'+menu_status[1]+'" /><input type="hidden" name="hidAppliedProgram[]" value="'+menu_status[2]+'" />';
		               			}  
		               		},
			               	{ "sName": "is_document_upload1","sWidth": "10%","sClass":"alignCenter","mRender": function( data, type, full ) {
			               			var doc_checked = data.split('@');
									return '<input type="hidden" id="hid'+doc_checked[0]+'" value="'+doc_checked[1]+'"><input type="hidden" name="hidDocumentCodeAssign[]" value="'+data+'"> <button type="button" name="upload" class="btn btn-primary btn-circle tooltipTable" title="upload"  onclick="upload1(event)" ><i class="fa fa-folder"></i></button>&nbsp;&nbsp;<button type="button" name="previewId" class="btn btn-success btn-circle tooltipTable" title="View"  onclick=\'previewChooseFile("'+doc_checked[0]+'")\'><i class="fa fa-eye"></i></button>';
									//return '<input type="hidden" name="hidDocumentCodeAssign[]" value="'+data+'"> <button type="button" name="upload" class="btn btn-primary btn-circle tooltipTable" title="upload"  onclick="upload1(event)" ><i class="fa fa-folder"></i></button>&nbsp;&nbsp;<button type="button" name="previewId" class="btn btn-success btn-circle tooltipTable" title="View"  onclick=\'readURL(event)\' ><i class="fa fa-eye"></i></button>';
									//return '<input type="hidden" name="hidDocumentCodeAssign[]" value="'+data+'"> <button type="button" name="upload" class="btn btn-primary btn-circle tooltipTable" title="upload"  onclick="upload1(event)" ><i class="fa fa-folder"></i></button>&nbsp;&nbsp;<button type="button" name="previewId" class="btn btn-success btn-circle tooltipTable" title="View"  onclick=\'readURL(event)\' ><i class="fa fa-eye"></i></button>';
		                    		
		               			}  
		               		}
	              	    ],
	        "fnDrawCallback": function(oSettings, json) {
	        	$('.tooltipTable').tooltipster({
					theme: 'tooltipster-punk',
					animation: 'grow',
			        delay: 200, 
			        touchDevices: false,
			        trigger: 'hover'
			    });	
		        $('input[class=flat-red]').iCheck({
					checkboxClass: 'icheckbox_flat-blue',
					radioClass: 'icheckbox_flat-blue'
				}); 
			}      	             
		});
	});
	var institutedata = {
		program:$('#cmbProgram').val(),
		program_group:$('#cmbProgramGroup').val(),
	};
	
	var programmenuTable = $('#dtblProgramMenu').dataTable({
		/*"ajax":
		{
			"url": base_url+"/ajax_controller/select_published_applicants",
			"type": "POST",
			"data": institutedata
		},*/
		"bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth":false, 
        "bDestroy": true,   
        "sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
		"aoColumns": [    
                        { "sName": "sl_no" ,"sWidth":"5%"},
						{ "sName": "full_name"},
						{ "sName": "appl_no","sWidth":"10%"},
						{ "sName": "select","sWidth": "15%","iDataSort":6,"sClass":"dt-center","mRender": function( data, type, full ) {
									var menu_status = data.split('@');
		                    		//return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkShow[]"  value="'+menu_status[0]+'"  onclick="getCode()"/><div class=\"control__indicator\"></div></label><input type="hidden" name="hidMenuCode[]" value="'+menu_status[0]+'" /><input type="hidden" name="hidDocumentStatusAssign[]" value="'+menu_status[1]+'" /><input type="hidden" name="hidAppliedProgram[]" value="'+menu_status[2]+'" />';
		               			}  
		               		},
						/*{ "sName": "select","sWidth": "15%","iDataSort":6,"sClass":"dt-center","mRender": function( data, type, full ) {
								var status = full[file_path];
									if(full!='')
									{
										if(status!='')
										{
											return '<span> Uploaded</span>';
										}
										else
										{
											return '<span> Not Uploaded</span>';
										}
										
									}
									else
									{
										return '';
									}
									
		               			}  
		               		},*/
						/*{ "sName": "is_document_upload","sWidth": "30%","sClass":"alignCenter","mRender": function( data, type, full ) {
									return '<input type="file" style="width: 80%;" class= "form-control" id="file'+data+'" name="file'+data+'" />';
			               		}
			               	},*/
		               	{ "sName": "is_document_upload1","sWidth": "10%","sClass":"alignCenter","mRender": function( data, type, full ) {
								var doc_checked = data.split('@');
								return '<input type="hidden" id="hid'+doc_checked[0]+'" value="'+doc_checked[1]+'"><input type="hidden" name="hidDocumentCodeAssign[]" value="'+data+'"> <button type="button" name="upload" class="btn btn-primary btn-circle tooltipTable" title="upload"  onclick="upload1(event)" ><i class="fa fa-folder"></i></button>&nbsp;&nbsp;<button type="button" name="previewId" class="btn btn-success btn-circle tooltipTable" title="View"  onclick=\'previewChooseFile("'+doc_checked[0]+'")\'><i class="fa fa-eye"></i></button>';
								//return '<input type="hidden" name="hidDocumentCodeAssign[]" value="'+data+'"> <button type="button" name="upload" class="btn btn-primary btn-circle tooltipTable" title="upload"  onclick="upload1(event)" ><i class="fa fa-folder"></i></button>&nbsp;&nbsp;<button type="button" name="previewId" class="btn btn-success btn-circle tooltipTable" title="View"  onclick=\'readURL(event)\' ><i class="fa fa-eye"></i></button>';
	                    		
	               			}  
	               		}
              	    ],
        "fnDrawCallback": function(oSettings, json) {
        	$('.tooltipTable').tooltipster({
				theme: 'tooltipster-punk',
				animation: 'grow',
		        delay: 200, 
		        touchDevices: false,
		        trigger: 'hover'
		    });	
	        $('input[class=flat-red]').iCheck({
				checkboxClass: 'icheckbox_flat-blue',
				radioClass: 'icheckbox_flat-blue'
			}); 
		}      	             
	});
	$("#chkAll").change(function () {
		if($('#chkAll').is(":checked"))
		{
			$('input[name="chkShow[]"]').each( function () {
			 	$(this).prop('checked', true);
			});
		}
		else
		{
			$('input[name="chkShow[]"]').each( function () {
			 	$(this).prop('checked', false);
			});
		}
		 
	});
	function customCheckbox(checkboxName)
	{
        var checkBox = $('input[name="'+ checkboxName +'"]');
        $(checkBox).each(function(){
            $(this).wrap( "<span class='custom-checkbox'></span>" );
            if($(this).is(':checked'))
            {
                $(this).parent().addClass("selected");
            }
        });
        $(checkBox).click(function(){
            $(this).parent().toggleClass("selected");
        });
    }
    
	
	$("#btnbulk").click(function () {
		$('#frmbulkUpload').data('bootstrapValidator').resetForm(true);	
			var hidAppliedProgrambulk = $('#cmbProgram').val();
		  	$('#hidAppliedProgrambulk').val(hidAppliedProgrambulk);
		  	var hidRoundbulk = $('#cmbRound').val();
		  	$('#hidRoundbulk').val(hidRoundbulk);
		  	var arr_appl_no = new Array();
			    $('input[name="hidApplNo[]"]').each(function(){
			        var applNo = $(this).val();
			        arr_appl_no.push(applNo);
			    });
			$('#hidapplnobulk').val(arr_appl_no);
			$('#divModalbulkStudent').modal('show');
		});
	$("#chkUpdate").change(function () {
		if($('#chkUpdate').is(":checked"))
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
	/*$("#btnAssign").click(function()
    {
    	$('#frmUpload').data('bootstrapValidator').resetForm(true);	
    });*/
    	$('#frmUpload').bootstrapValidator({
			message: 'This value is not valid',
	        feedbackIcons: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
			submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{
				var frmData = new FormData(document.getElementById("frmUpload"));
				$.ajax({
					url:base_url+"ajax_controller/insert_scanned_copies",
					type:"post",
					data:frmData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response){
				 		//$("#btnAssign").html('<i class="fa fa-check-square-o">&nbsp; Upload</i>');
						var res = JSON.parse(response);
						if(res.dbStatus == 'SUCCESS')
						{
						    toastr.success(res.dbMessage); 
							var dtblProgramOld = $("#dtblProgramMenu").DataTable();
							dtblProgramOld.ajax.reload();
							$('#frmUpload').data('bootstrapValidator').resetForm(true);	
							$("#divModalStudent").modal('hide')
							$("#btnAssign").attr('disabled', false);
						}
						else 
						{
							toastr.warning(res.dbMessage);
							var dtblProgramOld = $("#dtblProgramMenu").DataTable();
							dtblProgramOld.ajax.reload();
							$('#frmUpload').data('bootstrapValidator').resetForm(true);
							$("#btnAssign").attr('disabled', false);
						}
					},
					error:function(){
						toastr.error('We are Unable to process please contact support');
					}
				});
			},
			fields:
		         {
		            file: {							//form input type name
		                validators: {
		                    notEmpty: {
		                        message: 'Required'
		                    }
		                }
		            },
		        }
		});
    /*});*/
    $('#frmbulkUpload').bootstrapValidator({
			message: 'This value is not valid',
	       
			submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{
				
				
				var frmData = new FormData(document.getElementById("frmbulkUpload"));
				$.ajax({
					url:base_url+"ajax_controller/insert_bulk_scanned_copies",
					type:"post",
					data:frmData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response){
				 		//$("#btnAssign").html('<i class="fa fa-check-square-o">&nbsp; Upload</i>');
						var res = JSON.parse(response);
						if(res.dbStatus == 'SUCCESS')
						{
						    toastr.success(res.dbMessage); 
							var dtblProgramOld = $("#dtblProgramMenu").DataTable();
							dtblProgramOld.ajax.reload();
							$('#frmbulkUpload').data('bootstrapValidator').resetForm(true);	
							$("#divModalbulkStudent").modal('hide')
							$("#btnAssignbulk").attr('disabled', false);
						}
						else 
						{
							toastr.warning(res.dbMessage);
							var dtblProgramOld = $("#dtblProgramMenu").DataTable();
							dtblProgramOld.ajax.reload();
							$('#frmbulkUpload').data('bootstrapValidator').resetForm(true);
							$("#btnAssignbulk").attr('disabled', false);
						}
					},
					error:function(){
						toastr.error('We are Unable to process please contact support');
					}
				});
			},
			fields:
		         {
		            filebulk: {							//form input type name
		                validators: {
		                	/*file: {
							      extension: 'zip',
							      type: 'application/zip',
							    
							      message: 'The selected file is not valid, it should be Zip file '
							},*/
		                    notEmpty: {
		                        message: 'Required'
		                    }
		                }
		            },
		        }
		});
	function serealizeSelects (select)
	{
	    var array = [];
	    select.each(function(){ array.push($(this).val()) });
	    return array;
	}
	$('#filebulk').change(function()			
	 { 
		var file = document.getElementById("filebulk").files[0];
		//alert(file);
		var sFileName = file.name;
		//alert(sFileName);
		var file_path = file.path;
		//alert(file.mozFullPath);
        var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
        var iFileSize = file.size;
        //var iConvert = (file.size / 1048576).toFixed(2);
        if (sFileExtension == "zip" || sFileExtension == "ZIP" )
		{ 
			
			  document.getElementById("signMessage2").innerHTML="";
			  document.getElementById("btnAssignbulk").disabled = false;
			
			
        }
		else
		{
            //alert("Invalid File Format");
           
			document.getElementById("signMessage2").innerHTML="Error : Invalid File Format";
			document.getElementById("btnAssignbulk").disabled = true;
		}
		
	});
	$('#file').change(function()			
	 { 
		var file = document.getElementById("file").files[0];
		//alert(file);
		var sFileName = file.name;
		//alert(sFileName);
		var file_path = file.path;
		//alert(file.mozFullPath);
        var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
        var iFileSize = file.size;
        //var iConvert = (file.size / 1048576).toFixed(2);
        if (sFileExtension == "pdf" || sFileExtension == "PDF" || sFileExtension == "doc" || sFileExtension == "DOC" ||sFileExtension == "docx" || sFileExtension == "DOCX" || sFileExtension == "jpg" || sFileExtension == "JPG" || sFileExtension == "JPEG" || sFileExtension == "jpeg" || sFileExtension == "PNG" || sFileExtension == "png")
		{ 
			
			  document.getElementById("signMessage3").innerHTML="";
			  document.getElementById("btnAssign").disabled = false;
			
			
        }
		else
		{
            //alert("Invalid File Format");
           
			document.getElementById("signMessage3").innerHTML="Error : Invalid File Format";
			document.getElementById("btnAssign").disabled = true;
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
/*function readURL(event) 
{	
	var oTable = $('#dtblProgramMenu').dataTable();
	var row;
	if(event.target.tagName == "BUTTON")
	  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	else
  		row = event.target.parentNode;
  	var appl_no1 = oTable.fnGetData(row)['preview_application_no'];
  	var data1 = {
			appl_no1:appl_no
		};
    $.ajax({
			url:base_url+"ajax_controller/filepath_scanned_copies",
			type:"post",
			data:data1,
			success:function(response){
				var res = JSON.parse(response);console.log(res);
				if(res.dbStatus == 'SUCCESS')
				{
				    toastr.success(res.dbMessage); 
					var dtblProgramOld = $("#dtblProgramMenu").DataTable();
					dtblProgramOld.ajax.reload();
					
				}
				else 
				{
					toastr.warning(res.dbMessage);
					var dtblProgramOld = $("#dtblProgramMenu").DataTable();
					dtblProgramOld.ajax.reload();
					
				}
			},
			error:function(){
				toastr.error('We are Unable to process please contact support');
			}
		});
}*/
function upload1(event) 
{
	$('#frmUpload').data('bootstrapValidator').resetForm(true);	
	var oTable = $('#dtblProgramMenu').dataTable();
	var row;
	if(event.target.tagName == "BUTTON")
	  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	else
  		row = event.target.parentNode;
  	var appl_nos = oTable.fnGetData(row)['appl_no'];
  	//alert(appl_nos);return;
  	var hidAppliedProgram = $('#cmbProgram').val();
  	$('#hidapplno').val(appl_nos);
  	$('#hidAppliedProgram').val(hidAppliedProgram);
	$('#divModalStudent').modal('show');
	
}
	
	//$('#frmStudent').data('bootstrapValidator').resetForm(true);
	
	

 
function previewChooseFile(id)
{
	var sFileName = '';
	var file_path = $("#hid"+id).val(); //saved file path
	if(file_path != 'NO')
  	{
		window.open(file_path,'preview','width=1000,height=800');
	}
	else
	{
		toastr.error("No file was uploaded.");
	}
}
function getCode()
{
	
	$("[name='chkShow[]']").change(function () {
        if ($('input[name="chkShow[]"][type=checkbox]:checked').length == $('input[name="chkShow[]"][type=checkbox]').length) 
        {
            $('#chkAll').prop('checked', true);
        } 
        else 
        {
            $('#chkAll').prop('checked', false);
        }
    });
}
function getCodeUpdate()
{
    if ($('input[name="chkShowSingle[]"][type=checkbox]:checked').length == $('input[name="chkShowSingle[]"][type=checkbox]').length) 
    {
        $('#chkUpdate').prop('checked', true);
    } 
    else 
    {
        $('#chkUpdate').prop('checked', false);
    }
}
