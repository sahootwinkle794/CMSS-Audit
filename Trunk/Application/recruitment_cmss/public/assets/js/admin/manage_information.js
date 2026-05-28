/*$(document).ready(function() {
  var dt = $('#tbnews_events').dataTable();
  dt.fnDestroy();
});*/
/*$(".row_position").sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $(".row_position>tr").each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });

    function updateOrder(aData) {
        $.ajax({
            url: 'ajaxPost.php',
            type: 'POST',
            data: {
                allData: aData
            },
            success: function() {
                alert("Your change successfully saved");
            }
        });
    }*/


$(document).ready(function()
{
	/*CKEDITOR.replace('textareaLink',
    {
    	toolbarCanCollapse: true,
    	toolbarStartupExpanded: false,
    	removePlugins : 'elementspath'
		
	});*/
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
    $('#txtMenu').attr('readonly', false); 
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
			"url": base_url+"/ajax_controller/get_information_details",
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
		// "rowReorder": {"dataSrc": 'sl_no',},
	    "aoColumns": [    
	    	{ "sName": "sl_no","sClass":"alignCenter","sWidth": "7%" },
	    	//{ "sName": "sl_noOrig","sClass":"alignCenter","sWidth": "7%" },
	    	{ "sName": "id","visible":false},
	    	{ "sName": "information_type","visible":false},
		    { "sName": "menu_name","sWidth": "15%"},
		    { "sName": "information_details","sWidth": "20%"}, 
		    { "sName": "font_color","visible":false}, 
		    { "sName": "Date","sWidth": "10%"},
		    { "sName": "upload_type","sWidth": "10%"},
		    //{ "sName": "link_path", "visible":false}, 
		    { "sName": "link_path","sWidth": "10%","sClass":"alignCenter", "data":null, "sDefaultContent": "<button  type = 'button' class='btn btn-info btn-sm btn-circle tooltipTable' onclick='viewLatestInformation(event)' title='View' ><i class='fa fa-info-circle'></i></button>"},
		 
		 	{ "sName": "record_status","sWidth": "8%","sClass":"alignCenter",
				"mRender": function( data, type, full ) {
					//console.log(data.record_status);
					//alert(data); 
					if(data == '1')
					{
						//alert(data);
						return '<img src="'+base_url+'public/assets/images/ACTIVE.png" ></img>';
					}
					else
					{
						//alert(data);
						return '<img src="'+base_url+'public/assets/images/INACTIVE.png" ></img>';
					}
			        
		    }},
		   {"sName": "default","sWidth": "10%", "sClass":"alignCenter", "sDefaultContent": "<button type='button' id='btnEdit' class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='edit_news_events(event)' title='Edit' ><i class='fa fa-edit'></i></button>&nbsp;&nbsp;<button  type = 'button' class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='delete_news_events(event)' title='Delete' ><i class='fa fa-trash-o'></i></button>"}
		   
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
	
	$(".row_position").sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            /*$('table > tbody  > tr').each(function(index, tr) { 
			   console.log(index);
			   console.log(tr);
			   var ids = $.map(table.rows('.selected').data(), function (item) {
			        return item[0]
			    });
			    console.log(ids)
			    alert(table.rows('.selected').data().length + ' row(s) selected');
			   selectedData.push($(this).attr("id"));
			});*/
            
            $(".row_position>tr").each(function() {
            	/*var oTable = $('#tbnews_events').dataTable();		
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
				var row_id = oTable.fnGetData( row )['id'];	
				console.log("rowid",row_id);*/
            	//var checkedvalue= "#"+event.target.id;
				//var checkedvalue2= event.target.value;
            	//alert(checkedvalue);
                //selectedData.push(checkedvalue);
                selectedData.push($(this).attr("id"));
                //selectedData.push($(this).attr(row.id));
            });
            updateOrder(selectedData);
        }
    });
					
}
function updateOrder(aData) {
	alert(aData);
	
	
	
    $.ajax({
        url: base_url+"/ajax_controller/update_information_details",
        type: 'POST',
        data: {
            allData: aData
        },
        success: function(responsedata) {
        	var result = jQuery.parseJSON(responsedata);
            if(result.status)
            {
            	alert("hi");
				//toastr.success(result.msg);
				/*swal("Deleted", "Document has been deleted successfully.", "success");
	 			var tbnews_events = $("#tbnews_events").DataTable();
	 			var isDelete= false;
				tbnews_events.ajax.reload();*/	
			}
			else
			{
				//alert(111);
				sweetAlert("Document",result.msg, "error");	
			}	
        },
        error:function()
		{
			toastr.error('Unable to process please contact support');
		}
    });
}

$("#textbox").hide(); 
$("#filebox").hide(); 
$("input[name=radioUpload]").change(function(){
	if($(this).val()=="PDF")
	{
	    $("#filebox").show();
	    $("#textbox").hide(); 
	    
	}
	else if($(this).val()=="URL")
	{
	     $("#textbox").show(); 
	     $("#filebox").hide(); 
	}
	else{
		$("#textbox").hide(); 
		$("#filebox").hide();
	}
});
$.ajax({
		url:base_url+"ajax_controller/get_informationtype", 
		type:"post",
		success:function(response){  
			var options = "<option selected disabled value=''>Select Information Type</option>"; 
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
		//$("#savecadremaster").attr("disabled", true);
		/*for ( instance in CKEDITOR.instances )
       		CKEDITOR.instances[instance].updateElement();
   		
		var formData = new FormData(document.getElementById("newsEventsForm"));*/
   		if($("input[name='radioUpload']:checked").val() == 'PDF')
   		{
			if($("#filePdf").val() == '')
			{
				toastr.error("Please insert Pdf");
				$('#newsEventsForm').data('bootstrapValidator').updateStatus('filePdf', 'VALID', null);
				return false;
			}
		}
		var formData = new FormData(document.getElementById("newsEventsForm"));
		//console.log(formData);return;
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/operation_informaion_details",
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
					//console.log(obj);
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
        txtMenu: {							//form input type name
            validators: {
                notEmpty: {
                    message: 'Required'
                }
            }
        },
        txtSubMenu: {
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
        filePdf: {
            validators: {
                /*notEmpty: {
                    message: 'Required'
                },*/
                file: {
          			extension: 'pdf', 
          			type: 'application/pdf',
          			maxSize: 20*1024*1024,  //for 5mb
         	 		message: 'The selected file is not valid, it should be pdf and maximum 5MB.'
    			}
            }
        },
        textareaLink: {
            validators: {
                /*notEmpty: {
                    message: 'Required'
                },*/
                /*uri: {
					message: 'The input is not a valid URL'
				}*/ 
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
	/*else if(){
		//alert(1);return;
		$('#viewModal').modal('show');
		$('#link_description').html(' ');
		$('#link_description').html(link1);
		
	}*/
	
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
  	$('#hidOperType').val('edit_information_details');
	$(row).addClass('success');
	var information_type = oTable.fnGetData( row )['information_type'];
	var id = oTable.fnGetData( row )['id'];
	var menu_name = oTable.fnGetData( row )['menu_name'];
	var information_details = oTable.fnGetData( row )['information_details'];
	var font_color = oTable.fnGetData( row )['font_color'];
	var date = oTable.fnGetData( row )['Date'];
	var upload_type = oTable.fnGetData( row )['upload_type'];//alert(upload_type)die();
	var linkpath = oTable.fnGetData( row )['link_path'];//alert(upload_type)die();
	var record_status = oTable.fnGetData( row )['record_status'];//alert(upload_type)die();
	//alert(news+date+id+type+upload_type);
	document.getElementById('txtSubMenu').value=information_details;
	$('#hidid').val(id);
	//$("input[name=radioType][value='"+type+"']").prop("checked",true);
	$("input[name=radioUpload][value='"+upload_type+"']").prop("checked",true);
	$('#txtMenu').val(information_type);
	$('#txtSubMenu').val(information_details);
	$('#txtcolor').val(font_color);
	$('#txtDate').val(date);
	$('#radioUpload').val(upload_type);
	$("#cmbRecordStatus").val(record_status);
	
	if(upload_type == 'URL')
	{
		//alert(1);
		$("input[name=radioUpload][value='URL']").prop("checked",true);
		$('#textareaLink').val(linkpath);
		//CKEDITOR.instances['textareaLink'].setData(linkpath);
		//document.getElementById('textareaLink').value=linkpath;
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
	else
	{
		$("#filebox").hide();
		$("#textbox").hide();
	}
	
	$("#myModalLabelHeader").html("Update Information Details");
}
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
		  text: "You Want to Delete the Document!",
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
			    swal("Document", "News is safe ", "error");
		  }
		});
        function deleteMaster(){
			var id=
			{
				id:del_id
				
			};		
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/delete_information_details",
				type:"post",
				data:id,
				success:function(responsedata)
				{  
					var result = jQuery.parseJSON(responsedata);
		            if(result.status)
		            {
		            	//alert("hi");
						//toastr.success(result.msg);
						swal("Deleted", "Document has been deleted successfully.", "success");
			 			var tbnews_events = $("#tbnews_events").DataTable();
			 			var isDelete= false;
						tbnews_events.ajax.reload();	
					}
					else
					{
						sweetAlert("Document",result.msg, "error");	
					}				 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});	
		}
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
	$("#hidOperType").val("add_information_details");
	$('#editModal').modal('show');
	$("#myModalLabelHeader").html("Add Information Details");
}

	
  