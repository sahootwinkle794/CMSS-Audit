$(document).ready(function(){
	
	function upload_result(){
		var programAdditional = $('#tbluploadresult').dataTable({
			"ajax":
			{
				"url": base_url+"/ajax_controller/get_experience_validation_data",
				"type": "POST",
				"data": ''
			},
			"bPaginate": true,
	        "bLengthChange": true,
	        "bFilter": true,
	        "bSort": true,
	        "bDestroy":true,
	        "bInfo": true,
	        "bAutoWidth": false,
			/*"sDom":"<'row'<'col-xs-4 addAdditionalbtn'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-7'> <'col-xs-5' i>>><'col-xs-3'p>>",*/
			"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addAdditionalbtn' >>><'col-xs-6'p>>", 
			"aoColumns": [
							{ "sName": "#", "sWidth": "5%" },
							{ "sName": "program_name", "sWidth": "25%" },
							{ "sName": "experience", "sWidth": "20%" },
							//{ "sName": "year","sWidth": "20%"},
	                       	{ "sName": "program_code","bVisible":false},
	                       	{ "sName": "id","bVisible":false},
							{ "sName": "Action","sClass": "alignCenter",data:null,"sWidth": "20%", "sDefaultContent": "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEditAdditional' onclick='edit_additional(event);'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;<button id='btnDeleteAdditional' title='Delete' class='btn btn-danger tooltipTable btn-circle' onclick='deleteRowAdditional(event);'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"},
							
							
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
		$("div.addAdditionalbtn").html('<button id="btnAddAdditional" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
		$('#btnAddAdditional').click(function(){
			$('#cmbAdditionalProgram').prop('disabled', false);
			$('#frmAdditionalData').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
			$('#fileResultname').val('');
			$('#hidUniqueidAdditional').val('');
			$('#programAdditionalModal').modal('show');
		});
	}
	upload_result();
	$('#frmAdditionalData').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
		    var formData = new FormData(document.getElementById("frmAdditionalData"));
			$("#spanProcessingProgram").show();
			
			var unique_key = $("#hidUniqueidAdditional").val();
			
			if(unique_key != '' && unique_key != 'undefined')
			{
				var action = 'update_exp_validation_data';
			}
			else
			{
				var action = 'insert_exp_validation_data';
			}
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/"+action,
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){  
					var result = JSON.parse(response);
					if(result.status == true)
					{
						$("#spanProcessingProgram").hide();
						//$('#fileResultname').val('');
						upload_result();
						$('#hidUniqueidAdditional').val("");
						$('#frmAdditionalData').data('bootstrapValidator').resetForm(true);
						$('#programAdditionalModal').modal('hide');
			 			//Reseting the tick marks before opening add modal	
						//CKEDITOR.instances.txtareainstruction.setData('');
						toastr.success(result.msg);	
						
					}
					else
					{
						toastr.error(result.msg);
						$("#spanProcessingProgram").hide();
						var dtblProgram = $("#tbluploadresult").DataTable();
						dtblProgram.ajax.reload();
			 			$('#frmAdditionalData').data('bootstrapValidator').resetForm(true);	
					}			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			cmbAdditionalProgram: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtExperience: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			/*txtYear: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					integer: {
                        message: 'invalid year'
                    },
				}
			},*/
			
			
		}

	});	
});
function viewLatestInformation(event)
{
	var oTable = $('#tbluploadresult').dataTable();	
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});		
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	$(row).addClass('success');
	var link1 = oTable.fnGetData( row )['corrigendum_path'];
	//var link1 = oTable.fnGetData( row )['file_path'];
	//alert(link1);return;
	if(link1 != '#')
	{
		window.open(link1);
	}
	else
	{
		//alert(1);return;
		$('#viewModal').modal('show');
		$('#link_description').html(' ');
		$('#link_description').html(link1);
		
	}
	
}
$.ajax({
	"url": base_url+"/ajax_controller/get_program_table_data",
	type:"POST",
	data : '',
	success:function(response)
	{
		//alert("hello");  				
		var res1 = JSON.parse(response);					
		var options = "<option value=''>Select</option>";
	    $.each(res1.aaData,function(i,data)
	    {
	    	options = options + "<option value='"+data.program_code+"'>"+data.program_name+"</option>";
	    });
	    //alert(1);
	    $('#cmbAdditionalProgram').html("");   
		$('#cmbAdditionalProgram').append(options);
		$('#cmbAdditionalProgram').html(options);	
	},
	error:function()
	{
		toastr.error("We are unable to Process.Please contact Support");
	}
});		


function edit_additional(event)
{
	
	$('#frmAdditionalData').data('bootstrapValidator').resetForm(true);
	//var session = $('#hidSessionCode').val();
	var oTable = $('#tbluploadresult').dataTable();
	var row;
	//alert(event.target.tagName);
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	else
  		row = event.target.parentNode;
	$(row).addClass('success');
    var content = oTable.fnGetData(row)['general_info'];
    
    // Will alert the same content that you are assigning to CKEditor.
	
   // CKEDITOR.instances['txtareainstruction'].setData(oTable.fnGetData(row)['general_info']); 
    
    var program_code = oTable.fnGetData(row)['program_code'];//GETTING DATA FOR HIDDEN COLUMN
	var id = oTable.fnGetData(row)['id'];
	
	$('#hidUniqueidAdditional').val(id);
	$('#hidUniqueidprogram').val(program_code);
	$('#cmbAdditionalProgram').val(program_code);
	$('#txtExperience').val(oTable.fnGetData(row)['experience']);
	$('#txtYear').val(oTable.fnGetData(row)['year']);
	
	$('#programAdditionalModal').modal('show');
	
	
}
function deleteRowAdditional(event)
{
	//$(instituteAdminTable.fnSettings().aoData).each(function ()
	var oTable = $('#tbluploadresult').dataTable();	
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});		
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	var id = oTable.fnGetData(row)['id'];
	//alert(record_id);
	$(row).addClass('success');
   
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
	  	delete_resultdata();
	    swal("Delete", "Record Deleted Successfully.", "success");
	  } else {
		    swal("Cancelled", "Not Deleted ", "error");
	  }
	});
 function delete_resultdata(){
		var institutedata=
		{
			hidEmpId:id
		};		
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/delete_exp_validation_data",
			type:"post",
			data:institutedata,
			success:function(response)
			{  
				//Load table function	
				var dtblProgram = $("#tbluploadresult").DataTable();
				dtblProgram.ajax.reload();
				//Displying success message
				toastr.success('Record Deleted Successfully');							
			},
			error:function()
			{
				toastr.error('Unable to process please contact support');
			}
		});	
	}
		
	
}