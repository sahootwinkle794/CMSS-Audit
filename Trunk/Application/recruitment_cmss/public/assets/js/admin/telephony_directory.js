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
	
	var applicantdetails = $('#tbltelephony').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_telephony",
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
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addAdditionalbtntele' >>><'col-xs-6'p>>",
	    "aoColumns": [    
	    	{ "sName": "sl_no","sClass":"alignCenter","sWidth": "10%" },
	    	{ "sName": "id","visible":false},
		    { "sName": "Name","sWidth": "20%"},
		    { "sName": "Designation","sWidth": "20%", "sClass":"alignCenter"},
		    { "sName": "Office No","sWidth": "20%", "sClass":"alignCenter"},
		    { "sName": "Mobile","sWidth": "20%", "sClass":"alignCenter"},
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
	$("div.addAdditionalbtntele").html('<button id="btnAdd" type = "button" class="btn btn-success" onclick="add_news_events()"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
}

$('#telephonyForm').bootstrapValidator({
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
		var formData = new FormData(document.getElementById("telephonyForm"));
		//console.log(formData);return;
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/operation_telephony",
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
						var tbltelephony = $("#tbltelephony").DataTable();
			 			var isDelete= false;
						tbltelephony.ajax.reload();	
			 			$('#telephonyForm').data('bootstrapValidator').resetForm(true);
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
        txtName: {							//form input type name
            validators: {
                notEmpty: {
                    message: 'Required'
                }
            }
        },
        txtDesg: {
            validators: {
                notEmpty: {
                    message: 'Required'
                }
            }
        },
        txtOffice: {
                validators: {
                   /* integer:{
						message:'Only numbers are allowed'
					}, */
					stringLength: {
						max: 10,
						min: 10,
						message: 'Mobile no must be 10 characters'
					}
                }
        },
        txtMobile: {
                validators: {
                	notEmpty: {
                        message: 'Please Enter Mobile No'
                    },
                    integer:{
						message:'Only numbers are allowed'
					}, 
					stringLength: {
						max: 10,
						min: 10,
						message: 'Mobile no must be 10 characters'
					}
                }
        },
        
       
	}	
});

function edit_news_events(event)
{
	$('#telephonyForm').data('bootstrapValidator').resetForm(true);
	var oTable = $('#tbltelephony').dataTable();						
	$(oTable.fnSettings().aoData).each(function (){
		$(this.nTr).removeClass('success');
	});
	var row;

	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	$('#editModal').modal('show');
  	$('#hidOperType').val('edit_telephony');
	$(row).addClass('success');
	var name = oTable.fnGetData( row )['name'];
	var id = oTable.fnGetData( row )['id'];
	var designation = oTable.fnGetData( row )['designation'];
	var office_no = oTable.fnGetData( row )['office_no'];
	var mobile_no = oTable.fnGetData( row )['mobile_no'];
	//alert(news+date+id+type);
	document.getElementById('txtName').value=name;
	document.getElementById('txtDesg').value=designation;
	document.getElementById('txtOffice').value=office_no;
	document.getElementById('txtMobile').value=mobile_no;
	$('#hidid').val(id);
	$("#myModalLabelHeader").html("Update Telephony Directory");
}

function add_news_events(){

	$('#telephonyForm').data('bootstrapValidator').resetForm(true);
	$("#hidOperType").val("add_telephony");
	$('#editModal').modal('show');
	$("#myModalLabelHeader").html("Add Telephony Directory");
}
	
function delete_news_events(event)
{
	var oTable = $('#tbltelephony').dataTable();		
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
		  text: "You Want to Delete the Telephony Directory!",
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
			    swal("Cancelled", "Telephony Directory is safe ", "error");
		  }
		});
        function deleteMaster(){
			var id=
			{
				id:del_id
				
			};		
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/delete_telephony",
				type:"post",
				data:id,
				success:function(responsedata)
				{  
					var result = jQuery.parseJSON(responsedata);
		            if(result.status)
		            {
		            	//alert("hi");
						//toastr.success(result.msg);
						swal("Deleted", "Telephony Directory has been deleted successfully.", "success");
			 			var tbltelephony = $("#tbltelephony").DataTable();
			 			var isDelete= false;
						tbltelephony.ajax.reload();	
					}
					else
					{
						sweetAlert("Telephony Directory",result.msg, "error");	
					}				 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});	
		}
}