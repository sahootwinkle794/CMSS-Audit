$(document).ready(function()
{
	/*$('#txtDate').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
    });
    $('#txtDate').datepicker('setDate', new Date());*/
	news_events();
	$("#editFileInstitute").hide();
	$("#FileInstitute").show();
	
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
	
	var applicantdetails = $('#tblChairman').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_chairman",
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
         "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addAdditionalbtn4' >>><'col-xs-6'p>>",
	    "aoColumns": [    
	    	{ "sName": "sl_no","sClass":"alignCenter","sWidth": "10%" },
	    	{ "sName": "id","visible":false},
		    { "sName": "Name","sWidth": "20%"},
		    { "sName": "message","sWidth": "20%"},
		    { "sName": "profile_photo","sWidth": "10%","sClass":"alignCenter","bVisible":false},
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
	$("div.addAdditionalbtn4").html('<button id="btnAdd" type = "button" class="btn btn-success" onclick="add_news_events()"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
}

$('#chairmanForm').bootstrapValidator({
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
		var formData = new FormData(document.getElementById("chairmanForm"));
		//console.log(formData);return;
		//ajax call to server
		var fileUpload = $("#fileInstituteImage")[0];
		/*alert($("#hidOperType").val());
		if($("#hidOperType").val() == 'edit_chairman')
		{
			$('#chairmanForm').data('bootstrapValidator').updateStatus('fileInstituteImage', 'VALID', null);
		}*/
		if($("#fileInstituteImage").val() != '')
		{
			var reader = new FileReader();
			//Read the contents of Image File.
			reader.readAsDataURL(fileUpload.files[0]);
			reader.onload = function (e) 
			{
			//Initiate the JavaScript Image object.
				var image = new Image();
				//Set the Base64 string return from FileReader as source.
				image.src = e.target.result;
				image.onload = function () 
				{
					//Determine the Height and Width.
					var height = this.height;
					var width = this.width;

					if (height > 400 || width > 400) 
					{
						toastr.error("Chairman image dimension should be less than or equal to 400 X 400");
						$("#savecadremaster").removeAttr('disabled');
						$("#spanProcessinginstitute").hide();
					}
					else
					{
						$.ajax({
							url:base_url+"ajax_controller/operation_chairman",
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
										var tblChairman = $("#tblChairman").DataTable();
							 			var isDelete= false;
										tblChairman.ajax.reload();	
							 			$('#chairmanForm').data('bootstrapValidator').resetForm(true);
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
										sweetAlert("Chairman",obj.msg, "error");	
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
					}
				}
			}
		}
		else
		{
			$.ajax({
				url:base_url+"ajax_controller/operation_chairman",
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
							var tblChairman = $("#tblChairman").DataTable();
				 			var isDelete= false;
							tblChairman.ajax.reload();	
				 			$('#chairmanForm').data('bootstrapValidator').resetForm(true);
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
							sweetAlert("Chairman",obj.msg, "error");	
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
		}
		
				
					
			
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
        txtMessage: {
            validators: {
                notEmpty: {
                    message: 'Required'
                }
            }
        },
        fileInstituteImage: {
				validators: {
					notEmpty: {
						message: 'Required'
					}
					
				}
			},
		imageDisplayarea: {
			validators: {
				notEmpty: {
					message: 'Required'
				}
			}
		},
    
       
	}	
});
$('#fileInstituteImage').change(function()			
	 { 
		var file = document.getElementById("fileInstituteImage").files[0];
		//alert(file);
		var sFileName = file.name;
		//alert(sFileName);
		var file_path = file.path;
		//alert(file.mozFullPath);
        var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
        var iFileSize = file.size;
        //var iConvert = (file.size / 1048576).toFixed(2);
        if (sFileExtension == "jpg" || sFileExtension == "jpeg" || sFileExtension == "png" )
		{ 
			if(iFileSize <= 600000)
			{
			
			  document.getElementById("signMessage").innerHTML="";
			  $("#imageDisplayarea").attr('height','0');
			  $("#imageDisplayarea").attr('width','0');
			  readURLSig(this);
			  
			}
			else
			{
				//alert("File size exceeds 1 MB.");
				document.getElementById("signMessage").innerHTML="Error : File size exceeds 500 KB";
				$('#fileInstituteImage').val("");
				$('#chairmanForm').data('bootstrapValidator').updateStatus('fileInstituteImage', 'NOT_VALIDATED', null).validateField('fileInstituteImage');
				$('#imageDisplayarea').attr('src','');
				$("#imageDisplayarea").attr('height','0');
				$("#imageDisplayarea").attr('width','0');
			}
        }
		else
		{
            //alert("Invalid File Format");
			document.getElementById("signMessage").innerHTML="Error : Invalid File Format";
			$('#chairmanForm').data('bootstrapValidator').updateStatus('fileInstituteImage', 'NOT_VALIDATED', null).validateField('fileInstituteImage');
			$('#fileInstituteImage').val("");
			$('#imageDisplayarea').attr('src','');
			$("#imageDisplayarea").attr('height','0');
			$("#imageDisplayarea").attr('width','0');
		}
		
	});

$('#editfileInstituteImage').change(function()			
	 { 
		var file = document.getElementById("editfileInstituteImage").files[0];
		//alert(file);
		var sFileName = file.name;
		//alert(sFileName);
		var file_path = file.path;
		//alert(file.mozFullPath);
        var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
        var iFileSize = file.size;
        //var iConvert = (file.size / 1048576).toFixed(2);
        if (sFileExtension == "jpg" || sFileExtension == "jpeg" || sFileExtension == "png" )
		{ 
			if(iFileSize <= 600000)
			{
			
			  document.getElementById("signMessage").innerHTML="";
			  $("#editimageDisplayarea").attr('height','0');
			  $("#editimageDisplayarea").attr('width','0');
			  readURLSigEdit(this);
			  
			}
			else
			{
				//alert("File size exceeds 1 MB.");
				document.getElementById("signMessage").innerHTML="Error : File size exceeds 500 KB";
				$('#editfileInstituteImage').val("");
				//$('#chairmanForm').data('bootstrapValidator').updateStatus('fileInstituteImage', 'NOT_VALIDATED', null).validateField('fileInstituteImage');
				$('#editimageDisplayarea').attr('src','');
				$("#editimageDisplayarea").attr('height','0');
				$("#editimageDisplayarea").attr('width','0');
			}
        }
		else
		{
            //alert("Invalid File Format");
			document.getElementById("signMessage").innerHTML="Error : Invalid File Format";
			//$('#chairmanForm').data('bootstrapValidator').updateStatus('fileInstituteImage', 'NOT_VALIDATED', null).validateField('fileInstituteImage');
			$('#editfileInstituteImage').val("");
			$('#editimageDisplayarea').attr('src','');
			$("#editimageDisplayarea").attr('height','0');
			$("#editimageDisplayarea").attr('width','0');
		}
		
	});
function readURLSigEdit(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#editimageDisplayarea').attr('src', e.target.result);
				$("#editimageDisplayarea").attr('height','100');
				$("#editimageDisplayarea").attr('width','100');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
	function readURLSig(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#imageDisplayarea').attr('src', e.target.result);
				$("#imageDisplayarea").attr('height','100');
				$("#imageDisplayarea").attr('width','100');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
function edit_news_events(event)
{
	
	$("#editFileInstitute").show();
	$("#FileInstitute").hide();
	$('#chairmanForm').data('bootstrapValidator').resetForm(true);
	//$('#chairmanForm').data('bootstrapValidator').updateStatus('fileInstituteImage', 'VALID', null);
	$("#signMessage").html('');
	/*$('#imageDisplayarea').attr('src', '');
	$("#imageDisplayarea").attr('height','');
	$("#imageDisplayarea").attr('width','');*/
	$("#editimageDisplayarea").attr('src','');
	var oTable = $('#tblChairman').dataTable();						
	$(oTable.fnSettings().aoData).each(function (){
		$(this.nTr).removeClass('success');
	});
	var row;

	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	$('#editModal').modal('show');
  	$('#hidOperType').val('edit_chairman');
	$(row).addClass('success');
	var name = oTable.fnGetData( row )['name'];
	var id = oTable.fnGetData( row )['id'];
	var message = oTable.fnGetData( row )['message'];
	var image = oTable.fnGetData( row )['profile_photo'];
	//var institute_image = base_url+"public/assets/images/"+image;
			//alert(signature);
			$('#editimageDisplayarea').attr('src', image);
			$("#editimageDisplayarea").attr('height','100');
			$("#editimageDisplayarea").attr('width','100');
	//alert(news+date+id+type);
	$('#txtName').val(name);
	$('#txtMessage').val(message);
	/*document.getElementById('txtName').value=name;
	document.getElementById('txtMessage').value=message;*/
	$('#hidid').val(id);
	$("#myModalLabelHeader").html("Update Chairman");
}

function add_news_events(){

	$('#chairmanForm').data('bootstrapValidator').resetForm(true);
	$("#hidOperType").val("add_chairman");
	$('#editModal').modal('show');
	
	$("#myModalLabelHeader").html("Add Chairman");
	$("#imageDisplayarea").attr('src','');
	$("#editimageDisplayarea").attr('src','');
	$("#signMessage").html('');
	$("#editFileInstitute").hide();
	$("#FileInstitute").show();
}
	
function delete_news_events(event)
{
	var oTable = $('#tblChairman').dataTable();		
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
		  text: "You Want to Delete the Chairman Details!",
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
			    swal("Cancelled", "Chairman Details is safe ", "error");
		  }
		});
        function deleteMaster(){
			var id=
			{
				id:del_id
				
			};		
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/delete_chairman",
				type:"post",
				data:id,
				success:function(responsedata)
				{  
					var result = jQuery.parseJSON(responsedata);
		            if(result.status)
		            {
		            	//alert("hi");
						//toastr.success(result.msg);
						swal("Deleted", "Chairman Details has been deleted successfully.", "success");
			 			var tblChairman = $("#tblChairman").DataTable();
			 			var isDelete= false;
						tblChairman.ajax.reload();	
					}
					else
					{
						sweetAlert("Chairman Details",result.msg, "error");	
					}				 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});	
		}
}