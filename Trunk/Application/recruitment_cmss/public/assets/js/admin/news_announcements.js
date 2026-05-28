$(document).ready(function()
{
	$('#txtDate').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
    });
    $('#txtDate').datepicker('setDate', new Date());
	news_events();
	
	$('.tooltips').tooltipster({
		theme: 'tooltipster-punk',
		animation: 'grow',
        delay: 200, 
        touchDevices: false,
        trigger: 'hover'
     });	
   /* $('#txtNewsEvents').attr('readonly', false); 
    $('#radioType').attr('readonly', false); */
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
	
	var applicantdetails = $('#tbnews_events').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/news_events",
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
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addAdditionalbtn1' >>><'col-xs-6'p>>",
	    "aoColumns": [    
	    	{ "sName": "sl_no","sClass":"alignCenter","sWidth": "10%" },
	    	{ "sName": "id","visible":false},
		    { "sName": "news","sWidth": "40%"},
		    { "sName": "type","sWidth": "10%", "sClass":"alignCenter"},
		    { "sName": "Upload_type","visible":false},
		    { "sName": "published_date","sClass":"alignCenter","sWidth": "10%" },
		    { "sName": "link_path","sWidth": "15%","sClass":"alignCenter", "data":null, "sDefaultContent": "<button  type = 'button' class='btn btn-info btn-sm btn-circle tooltipTable' onclick='viewLatestInformation(event)' title='View' ><i class='fa fa-info-circle'></i></button>"},
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
	$("div.addAdditionalbtn1").html('<button id="btnAdd" type = "button" class="btn btn-success" onclick="add_news_events()"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
}
$("#textbox").hide(); 
$("#filebox").hide(); 
$("input[name=radioUpload]").change(function(){
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
$("#txtNewsEvents").change(function(){
	var news_type = $("#txtNewsEvents").val();
	//alert(news_type);
	if(news_type != '')
	{
		var institutedata=
			{
				news_type:news_type
			};
	   //ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/check_news_announcement",
			type:"POST",
			data:institutedata,
			success:function(response)
			{
				var obj = jQuery.parseJSON(response);
				if(obj.status == true)
				{
				 	$("#txtNewsEvents").val("");
				 	$('#newsEventsForm').data('bootstrapValidator').updateStatus('txtNewsEvents', 'NOT_VALIDATED', null).validate('txtNewsEvents');
					toastr.error('News/ Announcement Already Created');
					$('#txtNewsEvents').focus();					
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

$('#newsEventsForm').bootstrapValidator({
	excluded:[':disabled',':hidden'],
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
		var formData = new FormData(document.getElementById("newsEventsForm"));
		//console.log(formData);return;
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/operation_newsEventsData",
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
						var tbnews_events = $("#tbnews_events").DataTable();
			 			var isDelete= false;
						tbnews_events.ajax.reload();	
			 			$('#newsEventsForm').data('bootstrapValidator').resetForm(true);
			 			$('#editModal').modal('hide');
						$("#savecadremaster").attr("disabled", false);
					}
					else if(obj.status === 'validationerror'){
	                	$('#errorlog').html(obj.msg);
						$("#savecadremaster").attr("disabled", false);
	                	$('#errorlog').show();
	                }
					else if(obj.status === 'xsserror'){
	                	$('#errorlog').html(obj.msg);
	                	$('#errorlog').show();
						$("#savecadremaster").attr("disabled", false);
	                }
					else 
					{
						sweetAlert("News & Events",obj.msg, "error");	
						$("#savecadremaster").attr("disabled", false);
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
        txtNewsEvents: {							//form input type name
            validators: {
                notEmpty: {
                    message: 'Required'
                }
            }
        },
        radioType: {
            validators: {
                notEmpty: { 
                    message: 'Required'
                }
            }
        },
        txtDate: {
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
                /*notEmpty: {
                    message: 'Required'
                },*/
                file: {
          			extension: 'pdf', 
          			type: 'application/pdf',
          			maxSize: 5*1024*1024,  //for 5mb
         	 		message: 'The selected file is not valid, it should be pdf and maximum 5MB.'
    			}
            }
        },
        textareaLink: {
            validators: {
                notEmpty: {
                    message: 'Required'
                },
                uri: {
					message: 'The input is not a valid URL'
				}
            }
        },
       
	}	
});
function viewLatestInformation(event)
{
	var oTable = $('#tbnews_events').dataTable();		
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
	//alert(link1);return;
	if(link_path != '#')
	{
		window.open(link_path);
	}
	
	
}
function edit_news_events(event)
{
	
	$('#newsEventsForm').data('bootstrapValidator').resetForm(true);
	
    /*$("input[name=radioType]").click(function(){
	    return false;
	});*/
	
	//$('#txtNewsEvents').attr('readonly', true); 
	
	var oTable = $('#tbnews_events').dataTable();						
	$(oTable.fnSettings().aoData).each(function (){
		$(this.nTr).removeClass('success');
	});
	var row;

	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	$('#editModal').modal('show'); 
  	$('#hidOperType').val('edit_news_events');
	$(row).addClass('success');
	var news = oTable.fnGetData( row )['news_details'];
	var date = oTable.fnGetData( row )['published_date'];
	var id = oTable.fnGetData( row )['id'];
	var type = oTable.fnGetData( row )['type'];
	var upload_type = oTable.fnGetData( row )['upload_type'];//alert(type);return;
	var link_path = oTable.fnGetData( row )['link_path'];//alert(upload_type)die();
	//alert(news+date+id+type+upload_type);
	document.getElementById('txtNewsEvents').value=news;
	document.getElementById('txtDate').value = date;
	$('#hidid').val(id);
	//radiotype=$("input[name=radioType]").val();
	$('#hidType').val(type);
	$("input[name=radioType][value='"+type+"']").prop("checked",true);
	$("input[name=radioUpload][value='"+upload_type+"']").prop("checked",true);
	$('#radioType').val(type);
	$('#radioUpload').val(upload_type);
	if(upload_type == 'URL')
	{
		//alert(1);
		$("input[name=radioUpload][value='URL']").prop("checked",true);
		//$('#textareaLink').val(link1);
		//CKEDITOR.instances['textareaLink'].setData(link1);
		document.getElementById('textareaLink').value=link_path;
		$("#textbox").show(); 
		$("#filebox").hide();
	}
	else if(upload_type == 'PDF')
	{
		//alert(link1);return;
		//$('#newsEventsForm').data('bootstrapValidator').updateStatus('filePdf', 'VALID', null);
		$("input[name=radioUpload][value='PDF']").prop("checked",true);
		//CKEDITOR.instances['textareaLink'].setData(" ");
		$("#filebox").show();
		$("#textbox").hide(); 
	}
	$('input[name=radioType]').attr('disabled', true); 
	$("#myModalLabelHeader").html("Update News and Announcements");
}

function add_news_events(){
	$('#newsEventsForm').data('bootstrapValidator').resetForm(true);
	$("#textbox").hide(); 
	$("#filebox").hide(); 
	//$('#txtNewsEvents').attr('readonly', false); 
	$('input[name=radioType]').attr('disabled', false); 
	$("input[name=radioType]").prop("checked",false);
    /*$("input[name=radioType]").click(function(){
	    return true;
	});*/
//	alert("hghg");
	
	$("#hidOperType").val("add_news_events");
	$('#editModal').modal('show');
	$("#myModalLabelHeader").html("Add News and Announcements");
}

/*$('#btnAdd').click(function(){
	$('#newsEventsForm').data('bootstrapValidator').resetForm(true);
	$("#textbox").hide(); 
	$("#filebox").hide(); 
	$('#txtNewsEvents').attr('readonly', false); 
	$('input[name=radioType]').attr('disabled', false); 
	$("input[name=radioType]").prop("checked",false);
  
	
	$("#hidOperType").val("add_news_events");
	$('#editModal').modal('show');
	$("#myModalLabelHeader").html("Add News and Announcements");
});
	*/
function delete_news_events(event)
{
	var oTable = $('#tbnews_events').dataTable();		
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
			    swal("Cancelled", "News is safe ", "error");
		  }
		});
        function deleteMaster(){
			var id=
			{
				id:del_id
				
			};		
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/delete_news_events",
				type:"post",
				data:id,
				success:function(responsedata)
				{  
					var result = jQuery.parseJSON(responsedata);
		            if(result.status)
		            {
		            	//alert("hi");
						//toastr.success(result.msg);
						swal("Deleted", "News & Events has been deleted successfully.", "success");
			 			var tbnews_events = $("#tbnews_events").DataTable();
			 			var isDelete= false;
						tbnews_events.ajax.reload();	
					}
					else
					{
						sweetAlert("News & Events",result.msg, "error");	
					}				 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});	
		}
}