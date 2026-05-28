/*
 * Author: Rahul Patro
 * Date: 08/09/2017
 * Description : This is used for user creation (manage_user.php).
 * 
 **/
$(document).ready(function(){
	$(":file").filestyle({classButton: "btn btn-primary"});//for file execution
	var urls =base_url+"/ajax_controller/get_datatable_data/get_userdata";
	var user_table = $('#user_table').dataTable({
		"processing": true, //Feature control the processing indicator.
		"serverSide": true, //Feature control DataTables' server-side processing mode.
		"destroy": true,
		"paging":   true,
		"info":     true,
		"autoWidth": false,
		"scrollX":true,
		"responsive":false,
		"searching":true,
		// Load data for the table's content from an ajax source
		"ajax":
		{
			"url": urls,
			"type": "POST"
		},
		//Set column definition initialisation properties.
		"columns": [
			{"sName": "sl_no","sWidth": "5%","sClass":"alignCenter"},
			{"sName": "user_code","bVisible":false,"sWidth": "15%","sClass":"alignCenter"},
			{"sName": "user_name","sWidth": "20%","sClass":"alignCenter"},
			{"sName": "display_name","sWidth": "20%","sClass":"alignCenter"},
			{"sName": "password","bVisible":false,"sWidth": "15%","sClass":"alignCenter"},
			{"sName": "prof_img","sWidth": "20%","sClass":"alignCenter","mRender": function( data, type, full ) {
	       		return "<img src='"+base_url+data+"' width='30'>";
	       	}},
			{ "sName": "status","sWidth": "5%","sClass" : "alignCenter",
	            "mRender": function( data, type, full ) 
	            {
	                return '<img src="'+base_url+'public/photos/'+data+'.png" />';
	            }  
	        },
			{"sName": "button",data:null,"sWidth": "15%","sDefaultContent":"<button type='button' class='btn btn-info btn-circle tooltipTable' align='center' onclick='editUserData(event);' title='Edit' ><i class='fa fa-pencil-square-o'></i></button>\
				<button type='button' class='btn btn-danger btn-circle tooltipTable' align='center' onclick='deleteUserData(event);' title='Delete' ><i class='fa fa-trash-o'></i></button>"
	       	}
		],
		"columnDefs": [{"targets": [ 5,7 ],"orderable": false}], 
		// to show tooltips in datatable
		"fnDrawCallback": function(oSettings, json) 
		{
	     		$('.tooltipTable').tooltipster({
		         	theme: 'tooltipster-punk',
		      		animation: 'grow',
		        	delay: 200, 
		         	touchDevices: false,
		         	trigger: 'hover'
	      		} );          
	  		}
	});
	
	// on click of add/update button it will validate then submit 	
	$('#frm_user').bootstrapValidator({
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
			var formData = new FormData(document.getElementById("frm_user"));
			urls =base_url+"/ajax_controller/operation_userdata";
			$.ajax({
				url : urls,
				method : 'POST',
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success : function(response)
				{
					try {
		                var obj = JSON.parse(response);
		                if (obj.status == false) {
		                	$('#errorlog').html('');
		                	$('#errorlog').hide();
		                    sweetAlert("USER",obj.msg, "error");
		                }else if(obj.status === 'validationerror'){
		                	$('#errorlog').html(obj.msg);
		                	$('#errorlog').show();
		                } else {
		                	sweetAlert("USER",obj.msg, "success");
		                	$('#errorlog').html('');
		                	$('#errorlog').hide();
		            		user_table = $('#user_table').DataTable();
							user_table.draw();
							user_table.clear();
							$('#frm_user').data('bootstrapValidator').resetForm(true);//Reseting user form
							$("#btn_submit").html("<i class='fa fa-paper-plane'></i> Add");
							$("#spanuser").html("Add User");
							$('#hiduser_name').val('');
							$("#frm_user input[name='op_type']").val("add_user");
		                }
		            } catch (e) {
		                sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
		            }
				},error: function(err){
					toastr.error("unable to save");
				}
			});
		},
		//live: 'enabled',
	    fields:
	    {
	        txtUserName: {							//form input type name
	            validators: {
	                notEmpty: {
	                    message: 'Required'
	                }
	            }
	        },
	        txtDisplayName: {							//form input type name
	            validators: {
	                notEmpty: {
	                    message: 'Required'
	                }
	            }
	        },
	        user_status: {							//form input type name
	            validators: {
	                notEmpty: {
	                    message: 'Required'
	                }
	            }
	        }
		}	
	});
});
function editUserData(event){//on edit click assign the value to text field
	$("#btn_submit")[0].innerHTML ="<i class='fa fa-edit'></i> Update";
	$("#spanuser")[0].innerHTML ="Edit User";
    $("#frm_user input[name='op_type']").val("edit_user");
    var oTable = $('#user_table').dataTable();
    var row;
    if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
    var user_code = oTable.fnGetData(row)['user_code'];
    var user_name = oTable.fnGetData(row)['user_name'];           
    var user_display_name = oTable.fnGetData(row)['user_display_name'];
    var prof_img = oTable.fnGetData(row)['prof_img'];
    var status = oTable.fnGetData(row)['record_status'];
    $('#hiduser_code').val(user_code);
    $('#txtUserName').val(user_name);
    $('#hiduser_name').val(user_name);
    $('#txtDisplayName').val(user_display_name);
    $('#fileimage').val(prof_img);  
    $('#user_status').val(status); 
}
function deleteUserData(event){//delete user
	swal({
		title: "Are you sure?",
		text: "You want to Delete the User!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, delete it!",
		cancelButtonText: "No, cancel",
		closeOnConfirm: false,
		closeOnCancel: true
	},
	function(isConfirm){
		if(isConfirm)
		{
		 	var oTable = $('#user_table').dataTable();
	        var row;
		    if(event.target.tagName == "BUTTON")
				row = event.target.parentNode.parentNode;
			else if(event.target.tagName == "I")
				row = event.target.parentNode.parentNode.parentNode;
	        var urls = base_url + "/ajax_controller/delete_data";
		    var formData = {
		    				user_code:oTable.fnGetData(row)['user_code'],
		    				op_type:"delete_user"};
			$.ajax({
				url: urls,
		        method: 'POST',
		        data: formData,
		        success: function (response) {
		            try {
		                var obj = JSON.parse(response);
		                if (!obj.status) {
		                    sweetAlert("USER",obj.msg, "error");
		                } else {
		                	swal('Deleted!',obj.msg,'success');
		                	user_table = $('#user_table').DataTable();
							user_table.draw();
							user_table.clear();
							$('#frm_user').data('bootstrapValidator').resetForm(true); //to reset the form
							$("#btn_submit").html("<i class='fa fa-paper-plane'></i> Add");
							$("#spanuser").html("Add User");
							$('#hiduser_name').val('');
							$("#frm_user input[name='op_type']").val("add_user");
		                }
		            } catch (e) {
		                sweetAlert("Sorry","We are unable to Process !", "error");
		            }
		        }, error: function (err) {
		            toastr.error(err);
		        }
			});
		}
	});

	   
}
//for form reset button click to reset the form
function form_reset(){
	$('#hiduser_name').val('');
	$('#frm_user').data('bootstrapValidator').resetForm(true); //to reset the form
	$("#btn_submit").html("<i class='fa fa-paper-plane'></i> Add");
	$("#spanuser").html("Add User");
	$("#frm_user input[name='op_type']").val("add_user");
}