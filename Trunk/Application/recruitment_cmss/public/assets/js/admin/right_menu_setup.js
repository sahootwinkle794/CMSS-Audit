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
    $('#txtNewsEvents').attr('readonly', false); 
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
			"url": base_url+"/ajax_controller/get_document_details",
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
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 btnNews' >>><'col-xs-6'p>>",
		
	    "aoColumns": [    
	    	{ "sName": "sl_no","sClass":"alignCenter","sWidth": "10%" },
	    	{ "sName": "id","visible":false},
	    	{ "sName": "type_id","visible":false},
		    { "sName": "doc type","sWidth": "20%"},
		    { "sName": "doc title","sWidth": "20%"},
		    { "sName": "Upload_type","visible":false},
		    { "sName": "published_date","visible":false },
		    { "sName": "link_path","sWidth": "10%","sClass":"alignCenter", "data":null, "sDefaultContent": "<button  type = 'button' class='btn btn-info btn-sm btn-circle tooltipTable' onclick='viewLatestInformation(event)' title='View' ><i class='fa fa-info-circle'></i></button>"},
		 	{ "sName": "record status","sWidth": "10%","sClass":"alignCenter",
				"mRender": function( data, type, full ) {
					if(data == '1')
					{
						return '<img src="'+base_url+'public/assets/images/ACTIVE.png" ></img>';
					}
					else
					{
						 return '<img src="'+base_url+'public/assets/images/INACTIVE.png" ></img>';
					}
			       
		    }},
		   {"sName": "default","sWidth": "20%", "sClass":"alignCenter", "sDefaultContent": "<button type='button' id='btnEdit' class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='edit_news_events(event)' title='Edit' ><i class='fa fa-edit'></i></button>&nbsp;&nbsp;<button  type = 'button' class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='delete_news_events(event)' title='Delete' ><i class='fa fa-trash-o'></i></button>"}
		   
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
	$("div.btnNews").html('<button type="button" id="btnAdd" onclick="add_news_events()" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
						
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
$.ajax({
		url:base_url+"ajax_controller/get_right_menu", 
		type:"post",
		success:function(response){  
			var options = "";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.menu_code+">"+data.menu_name+"</option>";
				
			});
						
			$('#txtMenu').html("");   //campusid from academicPeriod
			$('#txtMenu').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
/*$("#txtNewsEvents").change(function(){
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
	    
	
});*/
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
			url:base_url+"ajax_controller/operation_document_details",
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
       cmbRecordStatus: {
            validators: {
                notEmpty: {
                    message: 'Required'
                }
            }
        },
        /*filePdf: {
            validators: {
                notEmpty: {
                    message: 'Required'
                },
                file: {
          			extension: 'pdf', 
          			type: 'application/pdf',
          			maxSize: 20*1024*1024,  //for 5mb
         	 		message: 'The selected file is not valid, it should be pdf and maximum 5MB.'
    			}
            }
        },*/
        textareaLink: {
            validators: {
                /*notEmpty: {
                    message: 'Required'
                },*/
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
	
    $("input[name=radioType]").click(function(){
	    return true;
	});
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
  	$('#hidOperType').val('edit_document_details');
	$(row).addClass('success');
	var news = oTable.fnGetData( row )['document_title'];
	var id = oTable.fnGetData( row )['id'];
	var document_type = oTable.fnGetData( row )['document_type'];
	var selectedText3 = oTable.fnGetData( row )['record_status'];
	var upload_type = oTable.fnGetData( row )['upload_type'];//alert(upload_type)die();
	var link_path = oTable.fnGetData( row )['link_path'];//alert(upload_type)die();
	//alert(news+date+id+type+upload_type);
	document.getElementById('txtNewsEvents').value=news;
	$('#hidid').val(id);
	//$("input[name=radioType][value='"+type+"']").prop("checked",true);
	$("input[name=radioUpload][value='"+upload_type+"']").prop("checked",true);
	$('#txtMenu').val(document_type);
	$('#radioUpload').val(upload_type);
	$("#cmbRecordStatus").val(selectedText3);
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
	
	$("#myModalLabelHeader").html("Update Document Details");
}

function add_news_events(){
	$("#textbox").hide(); 
	$("#filebox").hide(); 
	$('#txtNewsEvents').attr('readonly', false); 
    $("input[name=radioType]").click(function(){
	    return true;
	});
//	alert("hghg");
	$('#newsEventsForm').data('bootstrapValidator').resetForm(true);
	$("#hidOperType").val("add_document_details");
	$('#editModal').modal('show');
	$("#myModalLabelHeader").html("Add Document Details");
}
	
