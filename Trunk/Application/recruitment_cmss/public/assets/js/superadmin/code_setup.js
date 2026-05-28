$(document).ready(function()
{
	$('.selectpicker').selectpicker(
	  {  
	    liveSearchPlaceholder: 'Placeholder text'
	  }
	);
	$('.bs-searchbox input').attr('placeholder', 
      'Search');
	var isDelete= false;
	var isEdit = false;
	var oTable;
	var session = $("#hidSession").val();
	$('#tabCodeGroup').click(function () 
    {
    	
    	var instituteAdminTable = $('#dtblCodeGroup').DataTable();
		instituteAdminTable.ajax.url(base_url+"ajax_controller/select_code").load();
    });
    $('#tabCodeDesc').click(function () 
    {
	    $.ajax({
			url:base_url+"ajax_controller/select_code",
			mType:"get",
			data:'',
			success:function(response)
			{  
				var options = "";					
				var res1 = JSON.parse(response);					
				$.each(res1.aaData,function(i,data)
				{
					options = options + "<option value='"+data.code_group+"'>"+data.code_group+"</option>";
				});
				$('#cmbCodeGroup').html("")   
				$('#cmbCodeGroup').append(options);	
				
				$('#hidCodeGroupDesc').val($('#cmbCodeGroup').val());
				var codedescdata={
								cmbCodeGroup:$('#cmbCodeGroup').val(),
							};
				   //ajax call to server
					$.ajax({
						url:base_url+"ajax_controller/select_code_desc",
						type:"POST",
						data:codedescdata,
						success:function(response)
						{  
							data = jQuery.parseJSON(response);
							dtblCodeGroupDescTable.fnClearTable();
							if (data.aaData.length)
							dtblCodeGroupDescTable.fnAddData(data.aaData);
							dtblCodeGroupDescTable.fnDraw();	
						},
						error:function(){
							toastr.error('Unable to Process Please Contact Support');
						}
					});	
			},
			error:function()
			{
				toastr.error('We are unable to process please contact support');	
			}
		});
    	
    });
	
	
	var instituteAdminTable = $('#dtblCodeGroup').dataTable({
		//"responsive": true,
		"sAjaxSource": base_url+"ajax_controller/select_code",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth":false, 
        "bRetrieve": true,   
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addbuttonCode' >>><'col-xs-6'p>>", 
	    "aoColumns": [    
                       { "sName": "sl_no","sWidth": "7%" },
                       { "sName": "Code_group","sWidth": "55%" },
                       { "sName": "sequence_no","sWidth": "23%" },
                       {"sName": "default","sWidth": "15%", "sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='codegroupRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>\
			            <button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='codegroupRow(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}
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
	$("div.addbuttonCode").html('<button id="btnAddCodeGroup" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	/*$("div.addbuttonCode").html("<button id='btnAddCodeGroup' class='btn btn-info custombtn btn-circle tooltips' title='Add Code'><i class='fa fa-plus'></i></button>");	*/
	
	//ADD button clicked
	$('#btnAddCodeGroup').click(function()
	{
		
		$(instituteAdminTable.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
		$('#frmCodeGroup').data('bootstrapValidator').resetForm(true);
		$('#txtCodeGroup').val("");
		$('#txtSequenceNo').val("");
		$("#myModalLabel").html("Add Code Group");
		$('#txtCodeGroup').attr('readonly', false);
		$("#btnSaveCodeGroup").html("<i class='fa fa-save'></i>  Add");
		$("#hidOperTypeCode").val("add_code");
		$('#modalCodeGroup').modal('show');
		$('#modalCodeGroup').on('shown.bs.modal', function()
		{  
			$('#txtCodeGroup').focus();// Focusing the textbox
		})	
		
		//alert('a');
		
		
	});
	//EDIT button clicked
	
	
	// to select data when edit button is click
	
	//ADD/UPDATE/DELETE RECORD WITH VALIDATION	
	$('#frmCodeGroup').bootstrapValidator({
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
			var formData = new FormData(document.getElementById("frmCodeGroup"));
			var oper = $("#btnSaveCodeGroup").html();
			//ajax call to server
			if(oper == 'Add')
				oper = 'ADD_CODE';
			else if(oper == 'Update')
				oper = 'UPDATE_CODE';
				
			$.ajax({
				url:base_url+"ajax_controller/operation_code",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response)
				{ 
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							//toastr.success(result.dbMessage);
				 			var dtblProgram = $("#dtblCodeGroup").DataTable();
			 				dtblProgram.ajax.reload();
			 				$('#frmCodeGroup').data('bootstrapValidator').resetForm(true);	
						 	if($("#hidOperTypeCode").val() == 'edit_code')
						 	{
								$('#modalCodeGroup').modal('hide');
							}
							//ind_resource();
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_code').html(obj.msg);
		                	$('#errorlog_code').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_code').html(obj.msg);
		                	$('#errorlog_code').show();
		                }
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
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
            txtCodeGroup: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
						regexp: /^([A-Za-z_]+)$/i,
						message: "Special characters and numbers and space are not allowed"
					}
                }
            },
            txtSequenceNo: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    digits: {
						message: 'The value can contain only digits'
					},
					stringLength: {
						min: 1,
						max: 6,
						message: 'Sequence No must be less than 6 digits'
					}
                }
            }
		}	
	});	
	/*** uppercase convert of code******/
	$('#txtCodeGroup').on('keydown', function(e) {
	    //console.log(e.which);
	    if(e.which != 37 &&  e.which != 39 && e.which != 8 ) // For back space, left & right arrow
	    {
	      var str = document.getElementById("txtCodeGroup").value;
	        var res = str.toUpperCase();
	        document.getElementById("txtCodeGroup").value = res;
	    }
 	});
	$('#txtCodeGroup').on('keyup', function(e) {
	    //console.log(e.which);
	    if(e.which != 37 && e.which != 39 && e.which != 8 )
	    {
	      var str = document.getElementById("txtCodeGroup").value;
	        var res = str.toUpperCase();
	        document.getElementById("txtCodeGroup").value = res;
	    }
	});
	$('#txtCodeGroup').on('change', function(e) {
	    //console.log(e.which);
	    var str = document.getElementById("txtCodeGroup").value;
	    var res = str.toUpperCase();
	    document.getElementById("txtCodeGroup").value = res; 
	});
	$('#txtCode').on('keydown', function(e) {
	    //console.log(e.which);
	    if(e.which != 37 &&  e.which != 39 && e.which != 8 ) // For back space, left & right arrow
	    {
	      var str = document.getElementById("txtCode").value;
	        var res = str.toUpperCase();
	        document.getElementById("txtCode").value = res;
	    }
 	});
	$('#txtCode').on('keyup', function(e) {
	    //console.log(e.which);
	    if(e.which != 37 && e.which != 39 && e.which != 8 )
	    {
	      var str = document.getElementById("txtCode").value;
	        var res = str.toUpperCase();
	        document.getElementById("txtCode").value = res;
	    }
	});
	$('#txtCode').on('change', function(e) {
	    //console.log(e.which);
	    var str = document.getElementById("txtCode").value;
	    var res = str.toUpperCase();
	    document.getElementById("txtCode").value = res; 
	});
	$('#txtCodeGroup').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtCode:$(event.target).val()
				};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_code",
				type:"POST",
				data:institutedata,
				success:function(response)
				{
					//alert(response)
					var obj = jQuery.parseJSON(response);
					if(obj.status)
					{
					 	$(event.target).val("");
					 	$('#frmCodeGroup').data('bootstrapValidator').updateStatus('txtCodeGroup', 'NOT_VALIDATED', null).validate('txtCodeGroup');
						toastr.error('Code Already Created');
						$(event.target).focus();					
					}
					else
					{
						
					}
				},  
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			}); 
		}
	}); 
	/********For Code Description tab************/
	var dtblCodeGroupDescTable = $('#dtblCodeGroupDesc').dataTable({
		"bPaginate": true,
       "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth":false,  
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6 institutegroupbutton'>>><'col-xs-6'p>>",
	    "aoColumns": [    
                       { "sName": "sl_no","sWidth": "10%"},
                       { "sName": "id","bVisible":false},
                       { "sName": "code_group","bVisible":false},
                       { "sName": "code","sWidth": "20%"},
                       { "sName": "code_desc","sWidth": "20%"},
                       { "sName": "sequence_no","sWidth": "20%"},
                       {"sName": "default","sWidth": "20%", "sClass":"alignCenter", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='codedescRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>\
			            <button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='codedescRow(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}
              	     ],
		"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 6 ] }],
		"fnRowCallback": function(oSettings, json) {
     		$('.tooltipTable').tooltipster( {
	         	theme: 'tooltipster-punk',
	      		animation: 'grow',
	        	delay: 200, 
	         	touchDevices: false,
	         	trigger: 'hover'
      		} );          
  		}              
	});
	$("div.institutegroupbutton").html('<button id="btnAddCodeDesc" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	//ADD button clicked
	$('#btnAddCodeDesc').click(function()
	{
		$(dtblCodeGroupDescTable.fnSettings().aoData).each(function ()
		{
			$(this.nTr).removeClass('success');
		});
//nothing selected in code group dropdown
		if($('#cmbCodeGroup').val() == '')
		{
			toastr.error('Please Select a Code Group');
			$('#cmbCodeGroup').focus();
		}
		else
		{
			$('#frmCodeGroupDesc').data('bootstrapValidator').resetForm(true);
			//$('#cmbCodeGroup').val("");		
			$('#txtCode').val("");
			$('#txtCodeDesc').val("");
			$('#txtCodeDescSlNo').val("");
			$('#txtCodeSequenceNo').val("");
			$("#myModalLabel1").html("Add Code Description");
			$("#btnSaveCodeDesc").html("<i class='fa fa-save'></i>  Add");
			$('#txtCode').attr('readonly', false);
			$('#hidOperTypeCodeDesc').val('add_code_desc');
			$('#modalCodeGroupDesc').modal('show');
			$('#modalCodeGroupDesc').on('shown.bs.modal', function()
			{  
				$('#txtCode').focus();// Focusing the textbox
			})	
		}
		
		
	});
	
	
	
	
	//ADD/UPDATE RECORD WITH VALIDATION	
	$('#frmCodeGroupDesc').bootstrapValidator({
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
			var formData = new FormData(document.getElementById("frmCodeGroupDesc"));
			//alert(formData);
			var oper = $("#btnSaveCodeDesc").html();
			if(oper == 'Add')
				oper = 'ADD_CODE_DESC';
			else if(oper == 'Update')
				oper = 'UPDATE_CODE_DESC';
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_code_desc",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response)
				{ 
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							//toastr.success(result.dbMessage);
				 			var codedescdata={
								cmbCodeGroup:$('#cmbCodeGroup').val(),
							};
					   //ajax call to server
							$.ajax({
								url:base_url+"ajax_controller/select_code_desc",
								type:"POST",
								data:codedescdata,
								success:function(response)
								{  
									data = jQuery.parseJSON(response);
									dtblCodeGroupDescTable.fnClearTable();
									if (data.aaData.length)
									dtblCodeGroupDescTable.fnAddData(data.aaData);
									dtblCodeGroupDescTable.fnDraw();
										
								},
								error:function(){
									toastr.error('Unable to Process Please Contact Support');
								}
							});
						 	$('#frmCodeGroupDesc').data('bootstrapValidator').resetForm(true);
							if($("#hidOperTypeCodeDesc").val() == 'edit_code_desc')
							{
								$('#modalCodeGroupDesc').modal('hide');
							}
							//else
							//{
								
							//}
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_code_desc').html(obj.msg);
		                	$('#errorlog_code_desc').show();
		                }
						else if(obj.status === 'xsserror'){
		                	$('#errorlog_code_desc').html(obj.msg);
		                	$('#errorlog_code_desc').show();
		                }
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
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
            cmbCodeGroup: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            txtCode: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            txtCodeDesc:{
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                }
            },
            txtCodeSequenceNo:{
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    digits: {
						message: 'The value can contain only digits'
					},
                }
            }
		}	
	});	
	
	//get parent from database
	$('#cmbCodeGroup').change(function (event){
			var codegroup = $('#cmbCodeGroup').val();
			$('#hidCodeGroupDesc').val(codegroup);
			var codedescdata={
							cmbCodeGroup:$('#cmbCodeGroup').val(),
							
						};
			   //ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/select_code_desc",
					type:"POST",
					data:codedescdata,
					success:function(response)
					{  
						data = jQuery.parseJSON(response);
						dtblCodeGroupDescTable.fnClearTable();
						if (data.aaData.length)
						dtblCodeGroupDescTable.fnAddData(data.aaData);
						dtblCodeGroupDescTable.fnDraw();	
					},
					error:function(){
						toastr.error('Unable to Process Please Contact Support');
					}
				});
	});
	
	// Delete Record Save	
	$('#codedescdeleterec').click(function(){
		$('#codedescdeletemodal').modal('hide');		
		var gencodeiddata=
		{
			gencodeid:$('#hidGenCodeIdDlt').val(),
			type:"DELETE_CODE_DESC",
			_s:session
		};
		//ajax call to server
		$.ajax({
				url:"code_setup_db.php",
				mType:"post",
				data:gencodeiddata,
				success:function(response)
				{  	
					var codedescdata={
							cmbCodeGroup:$('#cmbCodeGroup').val(),
							type:"GET_VALUE",
							_s:session
						};
				   //ajax call to server
					$.ajax({
						url:"code_setup_db.php",
						mType:"get",
						data:codedescdata,
						success:function(response)
						{  
							data = jQuery.parseJSON(response);
							dtblCodeGroupDescTable.fnClearTable();
							if (data.aaData.length)
							dtblCodeGroupDescTable.fnAddData(data.aaData);
							dtblCodeGroupDescTable.fnDraw();	
						},
						error:function(){
							//toastr.error('Unable to Process Please Contact Support');
						}
					});
					toastr.success('Data Successfully Deleted');							
				},
				error:function()
				{
					toastr.error('Unable to Process Please Contact Support');
				}
			});
	});	
	$('#txtCode').on("change",function(event)
	{
			if($(event.target).val() != "" && $(event.target).val() != undefined)
			{
				var institutedata=
				{
					txtCode:$(event.target).val(),
					txtCodeGroup:$('#cmbCodeGroup').val()
					
				};
		   //ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/check_duplicate_code_desc",
				type:"POST",
				data:institutedata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
					 	$(event.target).val("");
					 	$('#frmCodeGroupDesc').data('bootstrapValidator').updateStatus('txtCode', 'NOT_VALIDATED', null).validate('txtCode');
						toastr.error('Code Already Created');
						$(event.target).focus();					
					}
					else
					{
						
					}
				},  
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			}); 
		}
	}); 
	
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
	  "showDuration": "300",
	  "hideDuration": "1000",
	  "timeOut": "2000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}
	/* END OF CODE FOR TOASTR*/
});

//Edit or Delete group code button clicked
function codegroupRow(event,action)
{
	var oTable = $('#dtblCodeGroup').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});			
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	var record_id = oTable.fnGetData( row )[0];
	//alert(record_id);
	$('#frmCodeGroup').data('bootstrapValidator').resetForm(true);	
	$(row).addClass('success');
    var id = oTable.fnGetData( row )[1];
	//alert(id);
			
	$('#txtCodeGroup').val(row.cells[1].innerHTML);
	$('#hidCodeGroup').val(row.cells[1].innerHTML);
	$('#txtSequenceNo').val(row.cells[2].innerHTML);
	if(action == 'edit')
	{
		$('#txtCodeGroup').attr('readonly', true);
		$("#myModalLabel").html("Update Code Group");
		$("#btnSaveCodeGroup").html("<i class='fa fa-save'></i>  Update");	
		$("#hidOperTypeCode").val("edit_code");	
		$('#modalCodeGroup').modal('show');
	}	
	else
	{
		swal({
		  title: "Are you sure?",
		  text: "you want to Delete the Code!",
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
		  	deleteCode();
		    swal("Deleted", "Code has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Code is safe ", "error");
		  }
		});
		function deleteCode()
		{
			var gencodeiddata=
			{
				hidCode:$('#hidCodeGroup').val()
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/delete_code",
				type:"post",
				data:gencodeiddata,
				success:function(response)
				{ 
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							//toastr.success(result.dbMessage);
				 			$('#modalCodeGroup').modal('hide');
							$('#frmCodeGroup').data('bootstrapValidator').resetForm(true);
							var dtblInstitute = $("#dtblCodeGroup").DataTable();
					 		dtblInstitute.ajax.reload();
							//ind_resource();
				    		
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlogInstitute').html(obj.msg);
		                	$('#errorlogInstitute').show();
		                }
						else 
						{
							sweetAlert("MENU",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					} 
				},
				error:function()
				{
					toastr.error('We are unable to process please contact support');	
				} 	
			});
		}
	}	
	
}
//Edit or Delete group Description button clicked
function codedescRow(event,action)
{
	$('#frmCodeGroupDesc').data('bootstrapValidator').resetForm(true);
	var dtblCodeGroupDescTable = $('#dtblCodeGroupDesc').dataTable();		
	$(dtblCodeGroupDescTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});			
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
	  		row = event.target.parentNode.parentNode.parentNode; 
	  	else
	  		row = event.target.parentNode;
		$(row).addClass('success');
	var codegrp = dtblCodeGroupDescTable.fnGetData( row )[1];
		//alert(codegrp);
	$(row).addClass('success');
	//var selectedTextCodeDesc = row.cells[1].innerHTML;
	var selectedTextCodeDesc = dtblCodeGroupDescTable.fnGetData( row )['code_group'];//alert(selectedTextCodeDesc);return;
	$("#cmbCodeGroup option").each(function () {
		if ($(this).html() == selectedTextCodeDesc) {
			$(this).attr("selected", "selected");
			return;
		}
	});
	var code = dtblCodeGroupDescTable.fnGetData( row )[3];
	var codedesc = dtblCodeGroupDescTable.fnGetData( row )[4];
	var codeseqc = dtblCodeGroupDescTable.fnGetData( row )[5];
	$('#txtCode').val(code);
    $('#txtCodeDesc').val(codedesc);
    $('#hidCodeGroupDesc').val(selectedTextCodeDesc);
    $('#hidOperTypeCodeDesc').val('edit_code_desc');
    $('#txtCodeSequenceNo').val(codeseqc);
    $('#hidGenCodeId').val(codegrp);
    $('#hidGenCodeIdDlt').val(codegrp);
	if(action == 'edit')
	{
		$('#txtCode').attr('readonly', true);
		$("#myModalLabel1").html("Update Code Description");
		$("#btnSaveCodeDesc").html("<i class='fa fa-save'></i>  Update");	
		$('#modalCodeGroupDesc').modal('show');
	}	
	else
	{
		swal({
		  title: "Are you sure?",
		  text: "you want to Delete the Code Description!",
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
		    swal("Deleted", "Code Description has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Code Description is safe ", "error");
		  }
		});
		function deleteMaster()
		{
			var gencodeiddata=
			{
				hidCode:$('#hidGenCodeIdDlt').val(),
			};
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/delete_code_desc",
				type:"post",
				data:gencodeiddata,
				success:function(response)
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
						toastr.success(obj.msg);  	
						var codedescdata={
							cmbCodeGroup:$('#cmbCodeGroup').val()
						};
					   //ajax call to server
						$.ajax({
							url:base_url+"ajax_controller/select_code_desc",
							type:"POST",
							data:codedescdata,
							success:function(response)
							{  
								var result = JSON.parse(response);
							
								var dtblCodeGroupDesc = $('#dtblCodeGroupDesc').dataTable();
							
								//toastr.success('Data Successfully Deleted');
								data = jQuery.parseJSON(response);
								dtblCodeGroupDescTable.fnClearTable();
								if (data.aaData.length)
								dtblCodeGroupDescTable.fnAddData(data.aaData);
								dtblCodeGroupDescTable.fnDraw();
							
							},
							
							error:function(){
								toastr.error('Unable to Process Please Contact Support');
							}
						});	
					}
					else
					{
						toastr.error('Unable to Delete');
					}				
				},
				error:function()
				{
					toastr.error('Unable to Process Please Contact Support');
				}
			});
		}
		
	}	
	
}
function bind_code_group()
{
	var session = $("#hidSession").val();
	$.ajax({
		url:"code_setup_db.php",
		mType:"get",
		data:{type:"SELECT_CODE",_s:session},
		success:function(response)
		{  
			var options = "<option value=''>Select</option>";					
			var res1 = JSON.parse(response);					
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value='"+data.code_group+"'>"+data.code_group+"</option>";
			});
			$('#cmbCodeGroup').html("");   
			$('#cmbCodeGroup').append(options);	
			$('#cmbCodeGroup').html(options)
			.selectpicker('refresh');	
		},
		error:function()
		{
			toastr.error('We are unable to process please contact support');	
		}
	});
}

