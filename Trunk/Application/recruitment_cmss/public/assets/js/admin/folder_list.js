$('#fileView').hide();
$('#fileDetailView').hide();
var cmbRoleMulti  = $('#cmbRole').multiselect({
    includeSelectAllOption: true,
	enableFiltering : false,
	nonSelectedText:'Role',
	enableCaseInsensitiveFiltering:false,
	buttonWidth: '420px'
}); 
folderDataShow();
function folderDataShow(file_search){
	$('#fileDetailView').hide();
	$('#fileView').hide();	
	oper = 'get_folder_detail';
	$.ajax({
		url:base_url+"ajax_controller/"+oper,
		type:"post",
		data:{
			file_search:file_search
		},
		success:function(response)
		{  
			option = '';
			var res = JSON.parse(response);
			for(i=0;i<res.length;i++){
				option+='<div class="col-md-1 folderClick"  onclick="fileShow(`'+res[i]['folder_id']+'`,`'+res[i]['folder_name']+'`)">\
							<div class="text-center select">\
								<i class="fa fa-folder fa-3x" style="color: #f5a939;"></i>\
								<span class="icon-name row" style="color: black;">'+res[i]['folder_name']+'</span>\
							</div>\
						</div>';
			}
			
	       	$('#divFolderList').html('');
	       	$('#divFolderList').append(option);
		},
		error:function()
		{
			toastr.error('We are unable to process please contact support');	
		}
	});
}
$("#txtFolderName").change(function(){
	var folder_name = $("#txtFolderName").val();
	//alert(news_type);
	if(folder_name != '')
	{
		var institutedata=
			{
				folder_name:folder_name
			};
	   //ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/check_folder_name",
			type:"POST",
			data:institutedata,
			success:function(response)
			{
				var obj = jQuery.parseJSON(response);
				if(obj.status == true)
				{
				 	$("#txtFolderName").val("");
				 	$('#frmAddFolder').data('bootstrapValidator').updateStatus('txtFolderName', 'NOT_VALIDATED', null).validate('txtFolderName');
					toastr.error('Folder Already Created');
					$('#txtFolderName').focus();					
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
function fileShow(folder_id,folder_name)
{
	$('#hidFolderId').val(folder_id);
	$('#spanFoldername').html(folder_name);
	$('#search-file').val('');
	funcFileData(folder_id);
	$('#fileDetailView').hide();
	$('#fileView').show();
}
function funcFileData(folder_id,ssearch_file=''){
	oper = 'GET_FILE_DATA';
	$.ajax({
		url:base_url+"ajax_controller/"+oper,
		type:"post",
		data:{folder_id:folder_id,ssearch_file:ssearch_file},
		success:function(response)
		{  
			option = '';
			var res = JSON.parse(response);
			for(i=0;i<res.length;i++){
				option+='<div class="fileContent" onclick="fileDetail(`'+res[i]['file_id']+'`)">\
           				<input type="hidden" value="71" class="display-none">\
           				<div class="fileIcon">\
           					<i class="icon-display fa fa-file-text"></i>\
           				</div>\
           				<div class="fileBody">\
           					'+res[i]['file_name']+'<span class="pull-right leaveType">View Details</span>\
           				</div>\
           				<div class="fileBodyFoot">\
           					<div class="pull-left fileSub">\
           						<span class="createdDate">Created By: <span>'+res[i]['employee_name']+' </span></span>\
           					</div>\
           					<div class="pull-right fileSub">\
           						<span class="createdDate">Created On: <span>'+res[i]['created_on']+'</span></span>\
           					</div>\
           				</div>\
           			</div>';
			}
			
           	$('#file_div').html('');
           	$('#file_div').append(option);
		},
		error:function()
		{
			toastr.error('We are unable to process please contact support');	
		}
	});
}

function fileDetail(file_id)
{
	$('#fileDetailView').show();
	oper = 'GET_FILE_DETAIL_INFO';
	$.ajax({
		url:base_url+"ajax_controller/"+oper,
		type:"post",
		data:{file_id:file_id},
		success:function(response)
		{  
			option = '';
			var res = JSON.parse(response);
			file_size = (res['file_size']/1024).toFixed(2);
           	$('#folder_name_view').html(res['folder_name']);
           	$('#file_name_view').html(res['file_name']);
           	$('#spanFileName').html(res['file_name']);
           	$('#file_type_view').html(res['file_type']);
           	$('#file_createdon_view').html(res['created_on']);
           	$('#file_size_view').html(file_size+'KB');
           	$('#file_desc_view').html(res['file_description']);
           	//$('#folder_name_view').html(res['file_path']);
           	$("#viePdfFile").attr("href", res['file_path']);
		},
		error:function()
		{
			toastr.error('We are unable to process please contact support');	
		}
	});
}
function btnAddFolder(){
	 $('#cmbRole option:selected').each(function() {
        $(this).prop('selected', false);
    })
    $('#cmbRole').multiselect('refresh');  
    $('#frmAddFolder').data('bootstrapValidator').resetForm(true); 
	$('#modalAddFolder').modal('show');
}
function btnAddFile(){
	$('#frmAddFile').data('bootstrapValidator').resetForm(true);
	$('#modalAddFile').modal('show');
}
//--------------------------------Add Folder-------------------------------------------------
//ADD RECORD WITH VALIDATION	
$('#frmAddFolder').bootstrapValidator({
	excluded: [':disabled'],
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
		var formData = new FormData(document.getElementById("frmAddFolder"));
		oper = 'ADD_NEW_FOLDER';
		//alert(1);return;
		//ajax call to server					
		$.ajax({
			url:base_url+"ajax_controller/"+oper,
			type:"post",
			data:formData,
			cache: false,
	        contentType: false,
	        processData: false,
			success:function(response)
			{  
				var res = JSON.parse(response);
				if(res.status == true){
					$('#modalAddFolder').modal('hide');
					toastr.success(res.msg);
					$('#frmAddFolder').data('bootstrapValidator').resetForm(true);	
					folderDataShow($('#search-folder').val());
				} 
				else
				{
					toastr.error(res.msg);
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
        txtFolderName: {							//form input type name
            validators: {
                notEmpty: {
                    message: 'Required'
                }
            }
        }, 
        'cmbRole[]': {							//form input type name
            validators: {
                notEmpty: {
                    message: 'Required'
                }
            }
        },
        txtFolderDesc: {							//form input type name
            validators: {
                notEmpty: {
                    message: 'Required'
                }
            }
        }
	}	
});
//--------------------------------For Searching File and Folder-------------------------------------------------
$('#search-folder').keyup(function(){
	ssearch_folder=$('#search-folder').val();
	folderDataShow(ssearch_folder);
});
$('#search-file').keyup(function(){
	ssearch_file=$('#search-file').val();
	//alert(ssearch_file);
	hidFolderId = $('#hidFolderId').val();
	funcFileData(hidFolderId,ssearch_file);
});
//--------------------------------Add File-------------------------------------------------
$('#frmAddFile').bootstrapValidator({
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
		var formData = new FormData(document.getElementById("frmAddFile"));
		oper = 'ADD_NEW_FILE';
		hidFolderId = $('#hidFolderId').val();
		//alert(1);return;
		//ajax call to server					
		$.ajax({
			url:base_url+"ajax_controller/"+oper,
			type:"post",
			data:formData,
			cache: false,
	        contentType: false,
	        processData: false,
			success:function(response)
			{  
				var res = JSON.parse(response);
				if(res.status == true){
					$('#modalAddFile').modal('hide');
					toastr.success(res.msg);
					$('#frmAddFile').data('bootstrapValidator').resetForm(true);
					funcFileData(hidFolderId,$('#search-file').val());		
				} 
				else
				{
					toastr.error(res.msg);
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
        fileName: {							//form input type name
            validators: {
                notEmpty: {
                    message: 'Required'
                },
	            file: {
					    extension: 'jpg,jpeg,png,pdf,JPG,JPEG,PNG,PDF',
					    //type: '	image/jpeg,image/jpg,application/pdf,image/png',
					    maxSize: 10*1024*1024,   // 10 MB
					    message: 'The selected file is not valid, it should be (jpg, jpeg, png, pdf) and 10 MB at maximum.'
				}
            }
        }, 
        txtFileDesc: {							//form input type name
            validators: {
                notEmpty: {
                    message: 'Required'
                }
            }
        }, 
        txtFileName: {							//form input type name
            validators: {
                notEmpty: {
                    message: 'Required'
                }
            }
        }
	}	
});