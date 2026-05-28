$(document).ready(function(){
	var session = $('#hidSessionCode').val();
	var categCheck  = $('#cmbProgramSelect').multiselect({
	    includeSelectAllOption: true,
	    enableFiltering : false,
		buttonWidth: '200px',
		numberDisplayed: 0,
		maxHight:'200px'
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
				var programmenuTable = $('#dtblProgramMenuSingle').dataTable({
					"ajax":
					{
						"url": base_url+"/ajax_controller/SELECTMENU",
						"type": "POST",
						"data": institutedata,
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
									{ "sName": "link_text","sWidth": "25%"},
									{ "sName": "select","sWidth": "5%","sClass":"alignCenter","mRender": function( data, type, full ) {
											var seq_id = data.split('`');
											var seq_data = data.split('-');
											if(seq_data[0] != ''){
												return "<input type='text' id='txtSeqNoEdit"+seq_id[0]+"' name='txtSeqNoEdit[]' class= 'form-control' value='"+seq_data[0]+"' maxlength = '2' onkeypress='return isNumberKey(event)' />\
														<input type='hidden' name='hidMenuCode[]' value='"+seq_data[1]+"' />";
											}
											else{
												return "<input type='text' id='txtSeqNoEdit"+seq_id[0]+"' name='txtSeqNoEdit[]' class= 'form-control' value='' onkeypress='return isNumberKey(event)' />\
														<input type='hidden' name='hidMenuCode[]' value='"+seq_data[1]+"' />";
											}
				               			}  
				               		},
				               		{ "sName": "select","sWidth": "15%","iDataSort":6,"sClass":"dt-center","mRender": function( data, type, full ) {
					               			var menu_status = data.split('-');
								   			if(menu_status[0] == '0')
											{
												return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkShowSingle[]"  value="'+menu_status[1]+'"  onclick="getCodeUpdate()"/><div class=\"control__indicator\"></div></label>';
											}
											if(menu_status[0] == '1')
											{
												return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkShowSingle[]"  value="'+menu_status[1]+'"  onclick="getCodeUpdate()" checked/><div class=\"control__indicator\"></div></label>';
											}
										}  
									},
									{ "sName": "is_document_upload","sWidth": "15%","sClass":"alignCenter","mRender": function( data, type, full ) {
					               			var doc_status = data.split('-');
					               			if(doc_status[0] =='Yes'){
												return '<input type="hidden" name="hidDocumentStatus[]" value="'+doc_status[0]+'" /><input type="file" style="width: 80%;" class= "form-control" name="fileEdit'+doc_status[1]+'" id="fileEdit'+doc_status[1]+'" />';
											}
											else
												return '<input type="hidden" name="hidDocumentStatus[]" value="'+doc_status[0]+'">';
					               		}
					               	},
					               	{ "sName": "is_document_upload1","sWidth": "30%","sClass":"dt-center","mRender": function( data, type, full ) {
					               			var doc_checked = data.split('`');
					               			
					               			if(doc_checked[0] =='Yes'){
												return '<input type="hidden" id="hid'+doc_checked[1]+'" value="'+doc_checked[2]+'"><button type="button" name="previewId" class="btn btn-success btn-circle tooltipTable" title="View/Preview"  onclick=\'previewChooseFile("'+doc_checked[1]+'")\' ><i class="fa fa-eye"></i></button>';
				                    		}
				                    		else
												return '<input type="hidden" id="hid'+doc_checked[1]+'" value="">';
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
					    getCodeUpdate();
					}       	             
				});
			}
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	var programmenuTable = $('#dtblProgramMenu').dataTable({
			"ajax":
			{
				"url": base_url+"/ajax_controller/SELECT_ALL_MENU",
				"type": "POST",
				"data": ''
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
							{ "sName": "link_text"},
							{ "sName": "sequence_no","sWidth":"10%", 
								"mRender":function(data, type, full) {
									var getSequenceId = data.split('`');
					    			return "<input type='hidden' name='txtMenuEdit[]' value='"+data+"' /><input type='text' id ='txtSeqNo"+data+"' name='txtSeqNo[]' class= 'form-control' value='' maxlength = '2' onkeypress='return isNumberKey(event)' />";
					    		}
					    	},
							{ "sName": "select","sWidth": "15%","iDataSort":6,"sClass":"dt-center","mRender": function( data, type, full ) {
		                    		return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkShow[]"  value="'+data+'"  onclick="getCode()"/><div class=\"control__indicator\"></div></label>';
		               			}  
		               		},
							{ "sName": "is_document_upload","sWidth": "30%","sClass":"alignCenter","mRender": function( data, type, full ) {
			               			var doc_status = data.split('-');
			               			if(doc_status[0] =='Yes'){
										return '<input type="hidden" name="hidDocumentStatusAssign[]" value="'+doc_status[0]+'" /><input type="hidden" name="hidDocumentCodeAssign[]" value="'+doc_status[1]+'"><input type="file" style="width: 80%;" class= "form-control" id="file'+doc_status[1]+'" name="file'+doc_status[1]+'" onchange=\'showImage("'+doc_status[1]+'")\' /> <div id="divMessage'+doc_status[1]+'" style="color:red;font-size:16px;"></div>';
									}
									else
										return '<input type="hidden" name="hidDocumentStatusAssign[]" value="'+doc_status[0]+'"><input type="hidden" name="hidDocumentCodeAssign[]" value="'+doc_status[1]+'">';
			               		}
			               	}/*,
			               	{ "sName": "is_document_upload1","sWidth": "10%","sClass":"alignCenter","mRender": function( data, type, full ) {
			               			var doc_checked = data.split('-');
			               			if(doc_checked[0] =='Yes'){
										return '<input type="hidden" name="hidDocumentCodeAssign[]" value="'+doc_checked[1]+'"><button type="button" name="previewId" class="btn btn-success btn-circle tooltipTable" title="View"  onclick=\'readURL("file'+doc_checked[1]+'")\' ><i class="fa fa-eye"></i></button>';
		                    		}
		                    		else
										return '<input type="hidden" name="hidDocumentCodeAssign[]" value="'+doc_checked[1]+'">';
		               			}  
		               		}*/
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
    
	$("#cmbProgramFilter").change(function(){
		var program = $("#cmbProgramFilter").val();
		var institutedata={
				program : program 
			};
		if(program != '')
		{
			var programmenuTable = $('#dtblProgramMenuSingle').dataTable({
				"ajax":
					{
						"url": base_url+"/ajax_controller/SELECTMENU",
						"type": "POST",
						"data": institutedata,
					},
				//"sAjaxSource": "program_menu_setup_db.php?type=SELECT_MENU&program="+program+"&_s="+session,
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
								{ "sName": "link_text","sWidth": "25%"},
								{ "sName": "select","sWidth": "5%","sClass":"alignCenter","mRender": function( data, type, full ) {
										var seq_id = data.split('`');
										var seq_data = data.split('-');
										
										if(seq_data[0] != ''){
											return "<input type='text' id='txtSeqNoEdit"+seq_id[0]+"' name='txtSeqNoEdit[]' class= 'form-control' value='"+seq_data[0]+"' />\
													<input type='hidden' name='hidMenuCode[]' value='"+seq_data[1]+"' />";
										}
										else{
											return "<input type='text' id='txtSeqNoEdit"+seq_id[0]+"' name='txtSeqNoEdit[]' class= 'form-control' value='' />\
													<input type='hidden' name='hidMenuCode[]' value='"+seq_data[1]+"' />";
										}
			                    		
			               			}  
			               		},
			               		{ "sName": "select","sWidth": "15%","iDataSort":6,"sClass":"dt-center","mRender": function( data, type, full ) {
				               			var menu_status = data.split('-');
							   			if(menu_status[0] == '0')
										{
											return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkShowSingle[]"  value="'+menu_status[1]+'"  onclick="getCodeUpdate()"/><div class=\"control__indicator\"></div></label>';
										}
										if(menu_status[0] == '1')
										{
											return '<label class=\"control control--checkbox\" style="font-weight: 100;"><input type="checkbox" name="chkShowSingle[]"  value="'+menu_status[1]+'"  onclick="getCodeUpdate()" checked/><div class=\"control__indicator\"></div></label>';
										}
									}  
								},
								{ "sName": "is_document_upload","sWidth": "15%","sClass":"alignCenter","mRender": function( data, type, full ) {
				               			var doc_status = data.split('-');
				               			if(doc_status[0] =='Yes'){
											return '<input type="hidden" name="hidDocumentStatus[]" value="'+doc_status[0]+'" /><input type="file" style="width: 80%;" class= "form-control" name="fileEdit'+doc_status[1]+'" id="fileEdit'+doc_status[1]+'"  onchange=\'showImageUpdate("'+doc_status[1]+'")\' /> <div id="divMessage1'+doc_status[1]+'" style="color:red;font-size:16px;"></div>';
										}
										else
											return '<input type="hidden" name="hidDocumentStatus[]" value="'+doc_status[0]+'">';
				               		}
				               	},
				               	{ "sName": "is_document_upload1","sWidth": "30%","sClass":"alignCenter","mRender": function( data, type, full ) {
				               			var doc_checked = data.split('`');
				               			
				               			if(doc_checked[0] =='Yes'){
											return '<input type="hidden" id="hid'+doc_checked[1]+'" value="'+doc_checked[2]+'"><button type="button" name="previewId" class="btn btn-success btn-circle tooltipTable" title="View/Preview"  onclick=\'previewChooseFile("'+doc_checked[1]+'")\' ><i class="fa fa-eye"></i></button>';
			                    		}
			                    		else
											return '<input type="hidden" id="hid'+doc_checked[1]+'" value="">';
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
				    getCodeUpdate();
				}       	             
			});
		}
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
	$("#btnUpdateMultiple").click(function()
    {
    	var program_codes = serealizeSelects($('.cmbProgramSelect'));
		if(program_codes == '')
		{
			toastr.error('Please Select at least One Post');
			return false;
		}
		else
		{
			var arr_show_status = new Array();
			var arr_cnt = '0';
		    $('input[name="chkShow[]"]').each(function(){
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
				toastr.error("Please Select atleast one menu");
				return false;
			}
			else
			{
				$('#frmMenuAssign').bootstrapValidator({
					message: 'This value is not valid',
			        feedbackIcons: {
			            valid: 'glyphicon glyphicon-ok',
			            invalid: 'glyphicon glyphicon-remove',
			            validating: 'glyphicon glyphicon-refresh'
			        },
					submitButtons: 'button[type="submit"]',
					submitHandler: function(validator, form, submitButton) 
					{
						//$("#btnUpdateMultiple").attr('disabled', true);
						var frmData = new FormData(document.getElementById("frmMenuAssign"));
						$.ajax({
							url:base_url+"ajax_controller/UPDATE_MULTIPLE",
							type:"post",
							data:frmData,
							cache: false,
					        contentType: false,
					        processData: false,
							success:function(response){
						 		$("#btnUpdateMultiple").html('<i class="fa fa-check-square-o">&nbsp; Assign</i>');
								$("#btnUpdateMultiple").removeAttr('disabled');
								var res = JSON.parse(response);
								if(res.dbStatus == 'SUCCESS' && res.dbError != '')
								{
								    toastr.success(res.dbMessage); 
								    toastr.warning("Some Combinations are Already Exist"); 
									var dtblProgramOld = $("#dtblProgramMenu").DataTable();
									dtblProgramOld.ajax.reload();
									//var dtblProgramOld = $("#dtblProgramMenuSingle").DataTable();
									//dtblProgramOld.ajax.reload();
									$("#cmbProgramSelect option:selected").removeAttr("selected");
					   				$('#cmbProgramSelect').multiselect('refresh');
					   				$('#chkAll').prop('checked', false);
								}
								else if(res.dbStatus == 'SUCCESS' && res.dbError == '')
								{
									toastr.success(res.dbMessage);  
									var dtblProgramOld = $("#dtblProgramMenu").DataTable();
									dtblProgramOld.ajax.reload();
									//var dtblProgramOld = $("#dtblProgramMenuSingle").DataTable();
									//dtblProgramOld.ajax.reload();
									$("#cmbProgramSelect option:selected").removeAttr("selected");
					   				$('#cmbProgramSelect').multiselect('refresh');
					   				$('#chkAll').prop('checked', false);
								}
								else if(res.dbStatus == 'ERROR' && res.dbError == '')
								{
									toastr.warning(res.dbMessage);
									var dtblProgramOld = $("#dtblProgramMenu").DataTable();
									dtblProgramOld.ajax.reload();
									//var dtblProgramOld = $("#dtblProgramMenuSingle").DataTable();
									//dtblProgramOld.ajax.reload();
									$("#cmbProgramSelect option:selected").removeAttr("selected");
					  				$('#cmbProgramSelect').multiselect('refresh');
					  				$('#chkAll').prop('checked', false);
								}
							},
							error:function(){
								toastr.error('We are Unable to process please contact support');
								$("#btnUpdateMultiple").html('<i class="fa fa-gear fa-spin"></i> Loading...');
								$("#btnUpdateMultiple").attr('disabled', true);
								$("#cmbProgramSelect option:selected").removeAttr("selected");
					   			$('#cmbProgramSelect').multiselect('refresh');
					   			$('#chkAll').prop('checked', false);
							}
						});
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
			toastr.error('Please Select a Program');
		}
		else
		{
			var arr_show_status = new Array();
			var arr_cnt = '0';
		    $('input[name="chkShowSingle[]"]').each(function(){
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
				toastr.error("Please Select atleast one menu");
				return false;
			}
			else
			{
				$('#frmMenu').bootstrapValidator({
					message: 'This value is not valid',
			        feedbackIcons: {
			            valid: 'glyphicon glyphicon-ok',
			            invalid: 'glyphicon glyphicon-remove',
			            validating: 'glyphicon glyphicon-refresh'
			        },
					submitButtons: 'button[type="submit"]',
					submitHandler: function(validator, form, submitButton) 
					{
						$("#btnUpdateSingle").attr('disabled', true);
						var frmData = new FormData(document.getElementById("frmMenu"));
						$.ajax({
							url:base_url+"ajax_controller/UPDATE",
							type:"post",
							data:frmData,
							cache: false,
					        contentType: false,
					        processData: false,
							success:function(response){
						 		$("#btnUpdateSingle").html('<i class="fa fa-pencil-square-o">&nbsp; Update</i>');
								$("#btnUpdateSingle").removeAttr('disabled');
								var res = JSON.parse(response);
								if(res.dbStatus == 'SUCCESS')
								{
								    toastr.success(res.dbMessage); 
									var dtblProgramOld = $("#dtblProgramMenuSingle").DataTable();
									dtblProgramOld.ajax.reload();
									//$('#chkUpdate').prop('checked', false);
								}
								else if(res.dbStatus == 'ERROR' && res.dbError == '')
								{
									toastr.error(res.dbMessage);  
									var dtblProgramOld = $("#dtblProgramMenuSingle").DataTable();
									dtblProgramOld.ajax.reload();
									//$('#chkUpdate').prop('checked', false);
								}
								else 
								{
									toastr.warning(res.dbMessage);
									var dtblProgramOld = $("#dtblProgramMenuSingle").DataTable();
									dtblProgramOld.ajax.reload();
									//$('#chkUpdate').prop('checked', false);
								}
							},
							error:function(){
								toastr.error('We are Unable to process please contact support');
								$("#btnUpdateSingle").html('<i class="fa fa-gear fa-spin"></i> Loading...');
								$("#btnUpdateSingle").attr('disabled', true);
								//$('#chkUpdate').prop('checked', false);
							}
						});
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
function readURL(id) 
{	
    if (document.getElementById(id).files && document.getElementById(id).files[0]) {
        var reader = new FileReader();
           
        reader.onload = function (e){
            window.open(e.target.result,'preview','width=1000,height=800');
        }
        reader.readAsDataURL(document.getElementById(id).files[0]);
    }
    else{
		toastr.error("Please Browse a File");
	}
}
function previewChooseFile(id)
{
	var sFileName = '';
	var file_path = $("#hid"+id).val(); //saved file path
	if(document.getElementById("fileEdit"+id).files && document.getElementById("fileEdit"+id).files[0])
	{
		
		var file = document.getElementById("fileEdit"+id).files[0];
		sFileName = file.name;
	}
    if(sFileName != '')
    {
		readURL("fileEdit"+id);
	}
  	else if(file_path != '')
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
function showImage(id)
{
	var file = document.getElementById("file"+id).files[0];
		//alert(file);
	var sFileName = file.name;
	//alert(sFileName);
	var file_path = file.path;
	//alert(file.mozFullPath);
    var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
    var iFileSize = file.size;
    //var iConvert = (file.size / 1048576).toFixed(2);
    if (sFileExtension == "jpg" || sFileExtension == "jpeg" || sFileExtension == "png" || sFileExtension == "pdf" || sFileExtension == "doc" || sFileExtension == "xls" || sFileExtension == "xlsx" )
	{ 
		if(iFileSize <= 1000000)
		{
		
		  document.getElementById("divMessage"+id).innerHTML="";
		  $("#img").attr('height','0');
		  $("#img").attr('width','0');
		  readURLSig(this);
		  
		}
		else
		{
			//alert("File size exceeds 1 MB.");
			document.getElementById("divMessage"+id).innerHTML="Error : File size exceeds 1 MB";
			$('#file').val("");
			$('#img').attr('src','');
			$("#img").attr('height','0');
			$("#img").attr('width','0');
		}
    }
	else
	{
        //alert("Invalid File Format");
		document.getElementById("divMessage"+id).innerHTML="Error : Invalid File Format";
		$('#file').val("");
		$('#img').attr('src','');
		$("#img").attr('height','0');
		$("#img").attr('width','0');
	}
	/*var file = document.getElementById("file"+id).files[0];
    var iFileSize = file.size;
    if(iFileSize <= 1000000)
	{
	  	document.getElementById("divMessage"+id).innerHTML="";
	  	//readURL(width,height,id);
	}
	else
	{
		document.getElementById("divMessage"+id).innerHTML="Error : File size exceeds 1 MB";
		$("#file"+id).val("");
		$('#img'+id).attr('src','');
		$('#img'+id).attr('height','0');
		$('#img'+id).attr('width','0');
	}*/
}
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode != 46 && charCode > 31 
		&& (charCode < 48 || charCode > 57))
		return false;

	return true;
}
function showImageUpdate(id)
{
	/*var file = document.getElementById("fileEdit"+id).files[0];
    var iFileSize = file.size;
    if(iFileSize <= 1000000)
	{
	  	document.getElementById("divMessage1"+id).innerHTML="";
	  	//readURL(width,height,id);
	}
	else
	{
		document.getElementById("divMessage1"+id).innerHTML="Error : File size exceeds 1 MB";
		$("#file"+id).val("");
		$('#img'+id).attr('src','');
		$('#img'+id).attr('height','0');
		$('#img'+id).attr('width','0');
	}*/
	var file = document.getElementById("fileEdit"+id).files[0];
		//alert(file);
	var sFileName = file.name;
	//alert(sFileName);
	var file_path = file.path;
	//alert(file.mozFullPath);
    var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
    var iFileSize = file.size;
    //var iConvert = (file.size / 1048576).toFixed(2);
    if (sFileExtension == "jpg" || sFileExtension == "jpeg" || sFileExtension == "png" || sFileExtension == "pdf" || sFileExtension == "doc" || sFileExtension == "xls" || sFileExtension == "xlsx" )
	{ 
		if(iFileSize <= 1000000)
		{
		
		  document.getElementById("divMessage1"+id).innerHTML="";
		  $("#img").attr('height','0');
		  $("#img").attr('width','0');
		  readURLSig(this);
		  
		}
		else
		{
			//alert("File size exceeds 1 MB.");
			document.getElementById("divMessage1"+id).innerHTML="Error : File size exceeds 1 MB";
			$('#file').val("");
			$('#img').attr('src','');
			$("#img").attr('height','0');
			$("#img").attr('width','0');
		}
    }
	else
	{
        //alert("Invalid File Format");
		document.getElementById("divMessage1"+id).innerHTML="Error : Invalid File Format";
		$('#file').val("");
		$('#img').attr('src','');
		$("#img").attr('height','0');
		$("#img").attr('width','0');
	}
}