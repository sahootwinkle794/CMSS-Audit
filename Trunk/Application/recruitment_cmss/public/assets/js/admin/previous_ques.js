$(document).ready(function()
{
	/*$('#txtInfoDate').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
    }).on('changeDate', function(e) { 
        $('#PrevQuesForm').data('bootstrapValidator').updateStatus('txtInfoDate', 'VALID', null);
    });    
    $('#txtInfoDate').datepicker('setDate', new Date());*/
	latest_information();txtQuesSet
	 $('#txtQuesSet').attr('readonly', false); 
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
	CKEDITOR.replace('textareaLink',
    {
    	toolbarCanCollapse: true,
    	toolbarStartupExpanded: false,
    	removePlugins : 'elementspath'
		
	});
});

function latest_information(){
	
	var applicantdetails = $('#tblPrevQues').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_prev_ques",
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
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addAdditionalbtnques' >>><'col-xs-6'p>>",
	    "aoColumns": [    
	    	{ "sName": "sl_no","sClass":"alignCenter","sWidth": "5%" },
	    	{ "sName": "id","visible":false},
		    { "sName": "ques set","sWidth": "10%"},
		    { "sName": "link","sWidth": "20%","sClass":"alignCenter", "data":null, "sDefaultContent": "<button  type = 'button' class='btn btn-info btn-sm btn-circle tooltipTable' onclick='viewLatestInformation(event)' title='View' ><i class='fa fa-info-circle'></i></button>"},
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
	$("div.addAdditionalbtnques").html('<button id="btnAdd" type = "button" class="btn btn-success" onclick="add_latest_information()"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
}

function viewLatestInformation(event)
{
	var oTable = $('#tblPrevQues').dataTable();		
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
	
	
}

$('#PrevQuesForm').bootstrapValidator({
	excluded:[':disabled', ':hidden', ':not(:visible)'],
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
		for ( instance in CKEDITOR.instances )
       		CKEDITOR.instances[instance].updateElement();
		var formData = new FormData(document.getElementById("PrevQuesForm"));
		//console.log(formData);return;
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/operation_prev_ques",
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
						toastr.success(obj.msg);
						var tblPrevQues = $("#tblPrevQues").DataTable();
			 			var isDelete= false;
						tblPrevQues.ajax.reload();	
			 			$('#PrevQuesForm').data('bootstrapValidator').resetForm(true);
			 			$('#infoModal').modal('hide');
					}
					else if(obj.status === 'validationerror'){
	                	$('#errorlog').html(obj.msg);
	                	$('#errorlog').show();
	                }
					else if(obj.status === 'xsserror'){
	                	$('#errorlog').html(obj.msg);
	                	$('#errorlog').show();
	                }
					else 
					{
						sweetAlert("Previous Question paper",obj.msg, "error");	
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
        txtQuesSet: {							//form input type name
            validators: {
                notEmpty: {
                    message: 'Required'
                }
            }
        },
        filePdf: {
            validators: {
                notEmpty: {
                    message: 'Required'
                },
                file: {
          			extension: 'pdf,PDF', 
          			type: 'application/pdf',
          			maxSize: 5*1024*1024,  //for 5mb
         	 		message: 'The selected file is not valid, it should be pdf and maximum 5MB.'
    			}
            }
        },
       
	}	
});
function edit_latest_information(event)
{
	
	$('#txtQuesSet').attr('readonly', true); 
	$('#PrevQuesForm').data('bootstrapValidator').resetForm(true);
	$('#PrevQuesForm')[0].reset();
	var oTable = $('#tblPrevQues').dataTable();						
	$(oTable.fnSettings().aoData).each(function (){
		$(this.nTr).removeClass('success');
	});
	var row;

	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	$('#infoModal').modal('show');
  	$('#hidOperType').val('edit_prev_ques');
  	
	$("#myModalLabelHeader1").html("Update Previous Year Question Paper");
	$(row).addClass('success');
	var ques_set = oTable.fnGetData( row )['ques_set'];
	var link = oTable.fnGetData( row )['link_path'];
	//var date = oTable.fnGetData( row )['date'];
	var id = oTable.fnGetData( row )['id'];
	//alert(date);
	$('#txtQuesSet').val(ques_set);
	
	/*if(link2 == '#')
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
	}*/
	
	//$('#txtInfoDate').val(date);
	$('#hidInfoid').val(id);
}

function add_latest_information(){

	 $('#txtQuesSet').attr('readonly', false); 
	$('#PrevQuesForm').data('bootstrapValidator').resetForm(true);
	$('#PrevQuesForm')[0].reset();
	$("#hidOperType").val("add_prev_ques");
	$('#infoModal').modal('show');
	$("#myModalLabelHeader1").html("Add  Previous Year Question Paper");/*
	CKEDITOR.instances['textareaLink'].setData(" ");*/
}
	
function delete_latest_information(event)
{
	var oTable = $('#tblPrevQues').dataTable();		
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
		  text: "You Want to Delete the Previous Year Question Paper!",
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
			    swal("Cancelled", "Previous Year Question Paper is safe ", "error");
		  }
		});
        function deleteMaster(){
			var id=
			{
				id:del_id
				
			};		
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/delete_prev_ques",
				type:"post",
				data:id,
				success:function(responsedata)
				{  
					var result = jQuery.parseJSON(responsedata);
		            if(result.status)
		            {
		            	//alert("hi");
						//toastr.success(result.msg);
						swal("Deleted", "Previous Year Question Paper has been deleted successfully.", "success");
			 			var tblPrevQues = $("#tblPrevQues").DataTable();
			 			var isDelete= false;
						tblPrevQues.ajax.reload();	
					}
					else
					{
						sweetAlert("Previous Year Question Paper",result.msg, "error");	
					}				 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});	
		}
}