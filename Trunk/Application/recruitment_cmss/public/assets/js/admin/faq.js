$(document).ready(function()
{
	/*$('#txtDate').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
    });
    $('#txtDate').datepicker('setDate', new Date());*/
	news_events();
	
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

function news_events(){
	
	var applicantdetails = $('#tblfaq').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_faq",
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
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addAdditionalbtnfaq' >>><'col-xs-6'p>>",
	    "aoColumns": [    
	    	{ "sName": "sl_no","sClass":"alignCenter","sWidth": "10%" },
	    	{ "sName": "id","visible":false},
		    { "sName": "Question","sWidth": "30%"},
		    { "sName": "Answer","sWidth": "45%", "sClass":"alignCenter"},
			{"sName": "default","sWidth": "15%", "sClass":"alignCenter", "sDefaultContent": "<button type='button' id='btnEdit' class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='edit_news_events(event)' title='Edit' ><i class='fa fa-edit'></i></button>&nbsp;&nbsp;<button  type = 'button' class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='delete_news_events(event)' title='Delete' ><i class='fa fa-trash-o'></i></button>"}
		   
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
	$("div.addAdditionalbtnfaq").html('<button id="btnAdd" type = "button" class="btn btn-success" onclick="add_news_events()"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
}

$('#faqForm').bootstrapValidator({
	excluded:[':disabled'],
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
		var formData = new FormData(document.getElementById("faqForm"));
		//console.log(formData);return;
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/operation_faq",
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
						var tblfaq = $("#tblfaq").DataTable();
			 			var isDelete= false;
						tblfaq.ajax.reload();	
			 			$('#faqForm').data('bootstrapValidator').resetForm(true);
			 			$('#editModal').modal('hide');
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
						sweetAlert("FAQ",obj.msg, "error");	
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
        txtQues: {							//form input type name
            validators: {
                notEmpty: {
                    message: 'Required'
                }
            }
        },
        txtAns: {
            validators: {
                notEmpty: {
                    message: 'Required'
                }
            }
        },
        
       
	}	
});

function edit_news_events(event)
{
	$('#faqForm').data('bootstrapValidator').resetForm(true);
	var oTable = $('#tblfaq').dataTable();						
	$(oTable.fnSettings().aoData).each(function (){
		$(this.nTr).removeClass('success');
	});
	var row;

	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	$('#editModal').modal('show');
  	$('#hidOperType').val('edit_faq');
	$(row).addClass('success');
	var question = oTable.fnGetData( row )['question'];
	var id = oTable.fnGetData( row )['id'];
	var answer = oTable.fnGetData( row )['answer'];
	//alert(news+date+id+type);
	document.getElementById('txtAns').value=answer;
	document.getElementById('txtQues').value=question;
	$('#hidid').val(id);
	$("#myModalLabelHeader").html("Update FAQ");
}

function add_news_events(){

	$('#faqForm').data('bootstrapValidator').resetForm(true);
	$("#hidOperType").val("add_faq");
	$('#editModal').modal('show');
	$("#myModalLabelHeader").html("Add FAQ");
}
	
function delete_news_events(event)
{
	var oTable = $('#tblfaq').dataTable();		
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
		  text: "You Want to Delete the News!",
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
			    swal("Cancelled", "FAQ is safe ", "error");
		  }
		});
        function deleteMaster(){
			var id=
			{
				id:del_id
				
			};		
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/delete_faq",
				type:"post",
				data:id,
				success:function(responsedata)
				{  
					var result = jQuery.parseJSON(responsedata);
		            if(result.status)
		            {
		            	//alert("hi");
						//toastr.success(result.msg);
						swal("Deleted", "FAQ has been deleted successfully.", "success");
			 			var tblfaq = $("#tblfaq").DataTable();
			 			var isDelete= false;
						tblfaq.ajax.reload();	
					}
					else
					{
						sweetAlert("FAQ",result.msg, "error");	
					}				 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});	
		}
}