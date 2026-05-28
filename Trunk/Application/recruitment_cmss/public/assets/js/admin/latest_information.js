$(document).ready(function()
{
	
	CKEDITOR.replace('textareaLink',
    {
    	toolbarCanCollapse: true,
    	toolbarStartupExpanded: false,
    	removePlugins : 'elementspath'
		
	});
	/*$('#txtInfoDate').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
    }).on('changeDate', function(e) { 
        $('#latestInformationForm').data('bootstrapValidator').updateStatus('txtInfoDate', 'VALID', null);
    });    
    $('#txtInfoDate').datepicker('setDate', new Date());*/
	latest_information();
	$('#txtLinkName').attr('readonly', false); 
	
	$('.tooltips').tooltipster({
		theme: 'tooltipster-punk',
		animation: 'grow',
        delay: 200, 
        touchDevices: false,
        trigger: 'hover'
     });	
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
});

function latest_information(){
	
	var applicantdetails = $('#tbLatestInformation').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/latest_information",
			"type": "POST",
		},  
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
		"bDestroy":true,
        "bAutoWidth":false, 
        "scrollX":false,
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addAdditionalbtn2' >>><'col-xs-6'p>>",
	    "aoColumns": [    
	    	{ "sName": "sl_no","sClass":"alignCenter","sWidth": "5%" },
	    	{ "sName": "id","visible":false},
		    { "sName": "link_name","sWidth": "10%"},
		    { "sName": "link","sWidth": "20%","sClass":"alignCenter", "data":null, "sDefaultContent": "<button  type = 'button' class='btn btn-info btn-sm btn-circle tooltipTable' onclick='viewLatestInformation(event)' title='View' ><i class='fa fa-info-circle'></i></button>"},
		    { "sName": "published_date","sClass":"alignCenter","sWidth": "15%" },
		    { "sName": "link_path","visible":false},
			{"sName": "default","sWidth": "15%", "sClass":"alignCenter", "sDefaultContent": "<button type='button' id='btnEdit' class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='edit_latest_information(event)' title='Edit' ><i class='fa fa-edit'></i></button>&nbsp;&nbsp;<button  type = 'button' class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='delete_latest_information(event)' title='Delete' ><i class='fa fa-trash-o'></i></button>"}
			
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
	$("div.addAdditionalbtn2").html('<button id="btnAdd" type = "button" class="btn btn-success" onclick="add_latest_information()"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
}

function viewLatestInformation(event)
{
	var oTable = $('#tbLatestInformation').dataTable();		
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
	var link_path = oTable.fnGetData( row )['link_path'];
	var link1 = oTable.fnGetData( row )['link'];
	//alert(link1);return;
	if(link_path != '#')
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
$("input[type='radio']").change(function(){
	if($(this).val()=="PDF")
	{
	    $("#filebox").show();
	    $("#textbox").hide(); 
	    
	}
	else
	{
	     $("#textbox").show(); 
	     $("#filebox").hide(); 
	}
});
$('#latestInformationForm').bootstrapValidator({
	//excluded:[':disabled'],
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
		$("#savecadremaster").attr("disabled", true);
		for ( instance in CKEDITOR.instances )
       		CKEDITOR.instances[instance].updateElement();
   		
		var formData = new FormData(document.getElementById("latestInformationForm"));
   		if($("input[name='radioUpload']:checked").val() == 'CODE')
   		{
			if($("#textareaLink").val() == '')
			{
				toastr.error("Please enter code");
				$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtLinkName', 'VALID', null);
				return false;
			}
		}
		//console.log(formData);return;
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/operation_latestInfoData",
			type:"post",
			data:formData,
			cache: false,
	        contentType: false,
	        processData: false,
			success:function(response)
			{  
				/*try
				{*/
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
						$("#savecadremaster").attr("disabled", false);
						toastr.success(obj.msg);
						var tbLatestInformation = $("#tbLatestInformation").DataTable();
			 			var isDelete= false;
						tbLatestInformation.ajax.reload();	
			 			$('#latestInformationForm').data('bootstrapValidator').resetForm(true);
			 			$('#infoModal').modal('hide');
					}
					else if(obj.status === 'validationerror'){
						$("#savecadremaster").attr("disabled", false);
	                	$('#errorlog').html(obj.msg);
	                	$('#errorlog').show();
	                }
					else if(obj.status === 'xsserror'){
						$("#savecadremaster").attr("disabled", false);
	                	$('#errorlog').html(obj.msg);
	                	$('#errorlog').show();
	                }
					else 
					{
						$("#savecadremaster").attr("disabled", false);
						sweetAlert("Latest Information",obj.msg, "error");	
					}
				/*}
				catch(e)
				{
					sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
				}*/
				
			},
			error:function()
			{
				toastr.error('Unable to Save.Please Try Again ');	
			}
		});
	},
//live: 'enabled',
    fields:
    {
        txtLinkName: {							//form input type name
            validators: {
                notEmpty: {
                    message: 'Required'
                }
            }
        },
        radioUpload: {							//form input type name
            validators: {
                notEmpty: {
                    message: 'Required'
                }
            }
        },
       /* txtInfoDate: {
            validators: {
                notEmpty: {
                    message: 'Required'
                }
            }
        },*/
        filePdf: {
            validators: {
                notEmpty: {
                    message: 'Required'
                },
                file: {
          			extension: 'pdf', 
          			type: 'application/pdf',
          			maxSize: 5*1024*1024,  //for 5mb
         	 		message: 'The selected file is not valid, it should be pdf and maximum 5MB.'
    			}
            }
        }
	}	
});	
function edit_latest_information(event)
{
	$('#txtLinkName').attr('readonly', true); 
	$('#latestInformationForm').data('bootstrapValidator').resetForm(true);
	$('#latestInformationForm')[0].reset();
	//$('#latestInformationForm').data('bootstrapValidator').updateStatus('filePdf', 'VALID', null);
	var oTable = $('#tbLatestInformation').dataTable();						
	$(oTable.fnSettings().aoData).each(function (){
		$(this.nTr).removeClass('success');
	});
	var row;

	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	$('#infoModal').modal('show');
  	$('#hidOperType').val('edit_latest_information');
  	
	$("#myModalLabelHeader1").html("Update Latest Information");
	$(row).addClass('success');
	var linkName = oTable.fnGetData( row )['link_name'];
	var link1 = oTable.fnGetData( row )['link'];
	var link2 = oTable.fnGetData( row )['link_path'];
	//var date = oTable.fnGetData( row )['date'];
	var id = oTable.fnGetData( row )['id'];
	//alert(date);
	$('#txtLinkName').val(linkName);
	
	if(link2 == '#')
	{
		//alert(1);
		$("input[name=radioUpload][value='CODE']").prop("checked",true);
		//$('#textareaLink').val(link1);
		CKEDITOR.instances['textareaLink'].setData(link1);
		$("#textbox").show(); 
		$("#filebox").hide();
	}
	else
	{
		//alert(link1);return;
		$("input[name=radioUpload][value='PDF']").prop("checked",true);
		CKEDITOR.instances['textareaLink'].setData(" ");
		$("#filebox").show();
		$("#textbox").hide(); 
	}
	
	//$('#txtInfoDate').val(date);
	$('#hidInfoid').val(id);
}

function add_latest_information(){

	$('#txtLinkName').attr('readonly', false); 
	$('#latestInformationForm').data('bootstrapValidator').resetForm(true);
	$('#latestInformationForm')[0].reset();
	$("#hidOperType").val("add_latest_information");
	$("#filebox").hide();
	$("#textbox").hide(); 
	$('#infoModal').modal('show');
	$("#myModalLabelHeader1").html("Add Latest Information");
	CKEDITOR.instances['textareaLink'].setData(" ");
}
	
function delete_latest_information(event)
{
	var oTable = $('#tbLatestInformation').dataTable();		
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
	var del_id = oTable.fnGetData( row )['id'];		
	
		// sweet-alert for delete
        swal({
		  title: "Are you sure?",
		  text: "You Want to Delete the Latest Information!",
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
		    
		  } else {
			    swal("Cancelled", "Latest announcement is safe ", "error");
		  }
		});
        function deleteMaster(){
			var id=
			{
				id:del_id
				
			};		
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/delete_latest_information",
				type:"post",
				data:id,
				success:function(responsedata)
				{  
					var result = jQuery.parseJSON(responsedata);
		            if(result.status)
		            {
		            	//alert("hi");
						//toastr.success(result.msg);
						swal("Deleted", "Latest announcement has been deleted successfully.", "success");
			 			var tbLatestInformation = $("#tbLatestInformation").DataTable();
			 			var isDelete= false;
						tbLatestInformation.ajax.reload();	
					}
					else
					{
						sweetAlert("Latest Information",result.msg, "error");	
					}				 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});	
		}
}