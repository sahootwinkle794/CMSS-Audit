$(document).ready(function(){
	
	//after clicking of tab page will be reload-this is used because after creating a role that role is not showing in menu master with out page reload
	$('#roleTab').click(function() {
	    location.reload();
	}); 
	$('#resourceTab').click(function() {
	    location.reload();
	});
	$('#menuTab').click(function() {
	    location.reload();
	});

	$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {

	    localStorage.setItem('activeTab', $(e.target).attr('href'));
	    

	});

	var activeTab = localStorage.getItem('activeTab');

	if(activeTab){
		
	    $('#myTab a[href="' + activeTab + '"]').tab('show');

	}
	
	
	//Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
    
    /*------------------------------------------------------Menu Tab Part -------------------------------------------------------------------------------------------------*/
  
   /*
	* Author: Ashish Narayan Barick
	* Date: 11/09/2017
	* Description : This is used for Manage resource (manage_resource.php).
	* Tab :Menu
	* 
 	**/
   
   //Menu Datatable
    var dtblMenu = $('#dtblMenu').dataTable({
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
			"url": base_url+"/ajax_controller/get_datatable_data/get_menudata",
			"type": "POST",
			"data": function (data)
		    {
		    	data.menu_role = $('#cmbMenuRole').val();
		    }
		},    
        "aoColumns":[    
                       	{ "sName": "sl_no","sWidth":"3%"},
                       	{ "sName": "role","sWidth":"10%"},
                       	{ "sName": "link_text","sWidth":"15%"},
                       	{ "sName": "link_url","sWidth":"20%"},
                       	{ "sName": "parent_id","sWidth":"7%"},
                       	{ "sName": "parent_name","sWidth":"7%"},
                       	{ "sName": "menu_sl","sWidth":"5%"},
                       	{ "sName": "has_child","sWidth":"10%"},
                       	{ "sName": "is_last_child","sWidth":"10%"},
                       	{ "sName": "access_type","sWidth":"5%"},
                    	{ "sName": "Action",data:null,"sWidth": "15%","sClass":"alignCenter","sDefaultContent":  "<button id='btnMenuEdit' type='button' class='btn btn-info btn-circle tooltipTable' onclick='editMenuData(event)' title='Edit'><i class='fa fa-pencil-square-o'></i></button> <button type='button' class='btn btn-circle btn-danger tooltipTable' id='btnMenuDelete' onclick='deleteMenuData(event)' title='Delete'><i class='fa fa-trash-o'></i></button>"}	
              	    ],
        "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 9 ] },{ "bVisible": false, "aTargets": [ 4 ] }],
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
   	//datatable to show header properly after adding scrollX 
	$('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
	    $($.fn.dataTable.tables(true)).DataTable()
	       .columns.adjust()
	       .responsive.recalc();
	});
	// on Change of role load datatable and load parent
	$('#cmbMenuRole').change(function(){
		var dtbl_menu = $('#dtblMenu').DataTable();
		var role =  $('#cmbMenuRole').val();
		dtbl_menu.draw();// ReLoad the Datatable
			dtbl_menu.clear();
	});
    //Menu tab click event
    $('#menuTab').click(function(){
    	// on Change of role load datatable and load parent
    	$('#cmbMenuRole').change(function(){
    		var dtbl_menu = $('#dtblMenu').DataTable();
    		var role =  $('#cmbMenuRole').val();
    		dtbl_menu.draw();// ReLoad the Datatable
			dtbl_menu.clear();
    	});
    });
	
	//It will reset the bootstrap validation on time of rest fields
	$('#btnMenuReset').click(function(){ 
		$('#frmMenu').data('bootstrapValidator').resetForm(true);
		$('#txtHaschild').iCheck('uncheck');
		$('#txtHaschild').iCheck('uncheck');
		$("#btnMenuSubmit").html("<i class='fa fa-paper-plane'></i> Add");
		$("#spanMenu").html("Add Menu");
		$("#op_type").val("add_menu");
	});
	
	// Here ADD/EDIT the Menu Part
	$('#frmMenu').bootstrapValidator({
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
			if($('#cmbMenuRole').val()!= null && $('#cmbMenuRole').val()!= '')
			{
				var formData = new FormData(document.getElementById("frmMenu"));
				$.ajax({
					url :base_url+'ajax_controller/operation_menudata',
					type:"post",
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response)
					{  
						try
						{
							var obj = jQuery.parseJSON(response);
							if(obj.status == true)
							{
								sweetAlert("MENU",obj.msg, "success");
								$('#frmMenu').data('bootstrapValidator').resetForm(true);
								$('#txtHaschild').iCheck('uncheck');
								$('#txtHaschild').iCheck('uncheck');
								var dtbl_menu = $('#dtblMenu').DataTable();
					    		var role =  $('#cmbMenuRole').val();
					    		dtbl_menu.draw();// ReLoad the Datatable
								dtbl_menu.clear();
								$("#btnMenuSubmit").html("<i class='fa fa-paper-plane'></i> Add");
								$("#spanMenu").html("Add Menu");
								$("#op_type").val("add_menu");
							}
							else if(obj.status === 'validationerror'){
			                	$('#errorlog').html(obj.msg);
			                	$('#errorlog').show();
			                }
							else 
							{
								sweetAlert("MENU",obj.msg, "error");	
							}
						}
						catch(e)
						{
							sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
						}
						
					},
					error:function()
					{
						toastr.error('We are unable to process please contact support');	
					}
				});
			}
			else
			{
				toastr.error('Please select the role.');	
			}
		},
    	//live: 'enabled',
        fields:
        {
            txtmenulinktext: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            cmbMenuLinkURL: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            cmbMenuParent: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            txtMenuslno: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp:{
						regexp:/^[0-9]{1,11}(?:\.[0-9]{1,2})?$/,message:'Numeric value or decimal with maximum 2 digits'
					},
					stringLength: {	max: 10,message: '10 digits'}
                }
            }
		}	
	});
	
	//COPY THE MENU TO OTHER ROLE IF THE MENU HAS SAME 
	$('#btnMenuCopy').click(function()
	{
		if($('#cmbMenuRole').val() == '' && $('#cmbMenuCopyTo').val() == '')
		{
			//toastr.error('Please Select Role');
			toastr.error('Please Select each field');
			$('#cmbMenuCopyTo').focus();
			$('#cmbMenuRole').focus();
		}
		else if($('#cmbMenuRole').val() != '' && $('#cmbMenuCopyTo').val() == '')
		{
			toastr.error('Please Select Copy To Role');
			$('#cmbMenuCopyTo').focus();
		}
		else if($('#cmbMenuRole').val() == '' && $('#cmbMenuCopyTo').val() != '')
		{
			toastr.error('Please Select Role');
			$('#cmbMenuRole').focus(); 
		}
		else
		{
			var roledata=
			{
				cmbRole:$('#cmbMenuRole').val(),
				cmbCopyRole:$('#cmbMenuCopyTo').val(),
				type:"copy_menu"
			};
			$('#btnMenuCopy').html('<i class="fa fa-spinner fa-spin fa-fw"></i>');
			//ajax call to server
			$.ajax({
				url :base_url+'ajax_controller/operation_menudata',
				mType:"post",
				data:roledata,
				success:function(response)
				{  					
					//alert(response);
					try {
						var obj = jQuery.parseJSON(response);		 
						if(obj.status == true)
						{
							sweetAlert("MENU",obj.msg, "success");
						}
						else
						{
							sweetAlert("MENU",obj.msg, "error");
						}
						$('#btnMenuCopy').html('<i class="fa fa-copy"></i>');
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to save.Please Try Again !', "error");
					}
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
					$('#btnMenuCopy').html('<i class="fa fa-copy"></i>');
				}
			});
		}	
    }); 
   
    //on click preview button to check the design of menu that you have made
    $('#btnMenuPreview').click(function(){
  		if($('#cmbMenuRole').val() != '')
  		{
  			var cmbRole = $('#cmbMenuRole').val();
  			window.open('menuPreview.php?role_code='+cmbRole,'winview','width=900,height=700,toolbar=0,status=0,menubar=0,resizable=1,scrollbars=1').focus();
  		}
  		else
  		{
  			toastr.error('Please Select Role');
  		}
    });	
	
	/**Show the Parent list onchange of Role in the Dropdown**/
	$("#cmbMenuRole").change(function () {
	    var role = $(this).val();
	    target = $(this).attr("data-target"),
	    op_type = $(this).attr("data-type");

	    if (role == "") {
	        $(target).html("");
	        return false;
	    }
	    switch (op_type) {
	        case 'GET_LINK_URL':
	            var option = $('option:selected', this).attr('data-info');

	            var parent_options = "<option value=''>Select</option><option value='#'>No Parent</option>";
	            if (option != "") {
	                var parent_info = JSON.parse(option);
	                $.each(parent_info, function (k, v) {
	                    //console.log(v.block_name);
	                    parent_options += "<option value=" + v.menu_id + ">" + v.resource_name + "</option>";
	                });
	            }
	            $(target).html(parent_options);
	            break;
	    }

	});
});

function editMenuData(event) // Edit the Menu part
{
	isStateEdit = true;	
	var oTable = $('#dtblMenu').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I" || event.target.tagName == "SPAN")
	   row = event.target.parentNode.parentNode.parentNode;
	
	$('#txtmenulinktext').val(oTable.fnGetData(row)['menu_name']);
    $('#hidStateCode').val(oTable.fnGetData(row)['state_name']);
    $('#cmbMenuLinkURL').val( oTable.fnGetData(row)['resource_code']);
    $('#cmbMenuParent').val( oTable.fnGetData(row)['parent_id']);
    $('#txtMenuslno').val( oTable.fnGetData(row)['sl_no']);
    var has_child = oTable.fnGetData(row)['has_child'];
    var is_has_child = oTable.fnGetData(row)['is_last_child'];
    if(has_child == 'Yes')
    	$('#txtHaschild').iCheck('check');
    else
    	$('#txtHaschild').iCheck('uncheck');
    if(is_has_child == 'Yes')
    	$('#txtislastchild').iCheck('check');
    else
    	$('#txtislastchild').iCheck('uncheck');
    	
    $('#txtNewWindow').val( oTable.fnGetData(row)['target']);
    $('#txtIconClass').val( oTable.fnGetData(row)['icon_class']);
    $('#hidMenuId').val( oTable.fnGetData(row)['menu_id']);
    $("#btnMenuSubmit").html("<i class='fa fa-edit'></i> Update");
	$("#spanMenu").html("Update Menu");	
	$("#op_type").val("edit_menu");
}
function deleteMenuData(event) // delete the Menu part
{
	var oTable = $('#dtblMenu').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I" || event.target.tagName == "SPAN")
	   row = event.target.parentNode.parentNode.parentNode;
	var menu_id =  oTable.fnGetData(row)['menu_id'];
	swal
	({
	  	title: "Are you sure?",
	  	text: "You want to Delete the Menu!",
	 	type: "warning",
	  	showCancelButton: true,
	 	confirmButtonColor: "#DD6B55",
	  	confirmButtonText: "Yes, delete it!",
	  	cancelButtonText: "No, cancel",
	  	closeOnConfirm: false,
	  	closeOnCancel: true
	},
	function(isConfirm)
	{
		if(isConfirm)
		{
			$.ajax({
				url :base_url+'ajax_controller/delete_data',
				type:"post",
				data:{menu_id:menu_id,op_type:'delete_menu'},
				success:function(response)
				{  
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
						swal("MENU", obj.msg, "success");
						//toastr.success(res.msg);	
						$('#frmMenu').data('bootstrapValidator').resetForm(true);
						var dtbl_menu = $('#dtblMenu').DataTable();
			    		var role =  $('#cmbMenuRole').val();
			    		$('#hidMenuId').val("");
			    		dtbl_menu.draw(); // Load the Datatable
			    		dtbl_menu.clear(); 
						}
					else 
					{
						swal("Cancelled", "Menu is safe ", "error");	
					}
				},
				error:function()
				{
					toastr.error('We are unable to process please contact support');	
				}
			});
		}
	});
}

	
	/*
	* This pice of code is for creating updating and deleting a role  for the user access control (begins)
	*/ 
	
	 
   /*
	* Author:  Lina Mohapatra
	* Date: 11/09/2017
	* Description : This pice of code is for creating updating and deleting a role.
	* Tab :Role
	* 
 	**/
	
   	
	var url =base_url+"ajax_controller/get_datatable_data/get_roledata";
	var dtblrolemaster = $('#dtblrolemaster').dataTable({
		"processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "bDestroy": true,
        "paging":   true,
        "info":     true,
        "autoWidth": false,
        "responsive":true,
       	"searching":true,
		"ajax": {
		     "url": url,
		     "type": "POST",
		     "data": function(d) {
		       var frm_data = $('#frm_organization').serializeArray();
		       $.each(frm_data, function(key, val) {
		         d[val.name] = val.value;
		       });
		    }
		},
        "columns": [
           { "sName": "sl_no","sClass":"alignCenter"},
           { "sName": "role_code"},
           { "sName": "role_name"},
           { "sName": "index_page_url"},
           { "sName": "index_page_code" },
           { "sName": "button","sClass":"alignCenter","sDefaultContent":"<button type='button' class='btn btn-info btn-circle'  onclick='updateRoleMaster(event);' id='edit' ><i class='fa fa-pencil-square-o'></i></button>&nbsp;\
           				<button type='button' class='btn btn-danger btn-circle' onclick='deleteRole(event);'  id='delete'><i class='fa fa-trash'></i></button>"
	       }
        ] , 
         "aoColumnDefs": [{ "bVisible": false, "aTargets": [ 4 ] }], 	           
	});
	
	/*
	* edit in role master table 
	*/	
		
	function updateRoleMaster(event)
	{
		$('#role_btn')[0].innerHTML = '<i class="fa fa-edit"></i> Update';
		$('#span_addrole')[0].innerHTML = 'Edit Role'; 
		$("#txtrolecode").prop("readonly", true);
		$('#op_type_role').val('edit_role');
		
		var oTable = $('#dtblrolemaster').dataTable();
		var row;
		if(event.target.tagName == "BUTTON")
		   row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
		   row = event.target.parentNode.parentNode.parentNode;
		$('#txtrolecode').val(oTable.fnGetData(row)['role_code']);
		$('#txtroleName').val( oTable.fnGetData(row)['role_name']);
		$('#txtLandingPage').val( oTable.fnGetData(row)['index_page_code']);
	}
		
	/*
	* bootstrap validation for the role form 
	*/		
		
	$('#frm_role').bootstrapValidator({
		excluded: [':disabled'],
		message: 'This value is not valid',
		feedbackIcons: 
        {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton){
			var formData = new FormData(document.getElementById("frm_role"));
			$.ajax({
		        type: "POST",
		        url: base_url + "ajax_controller/operation_roledata",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
		        success: function(response){
					try {
		                var obj = JSON.parse(response);
		                if (obj.status == false) {
		                	$('#errorlog').html('');
		                	$('#errorlog').hide();
		                    sweetAlert("ROLE",obj.msg, "error");
		                }else if(obj.status === 'validationerror'){
		                	$('#errorlog').html(obj.msg);
		                	$('#errorlog').show();
		                } else {
		                	sweetAlert("ROLE",obj.msg, "success");
		                	$('#errorlog').html('');
		                	$('#errorlog').hide();
		            		dtblrolemaster = $('#dtblrolemaster').DataTable();
							dtblrolemaster.draw();
							dtblrolemaster.clear();
							$('#frm_role').data('bootstrapValidator').resetForm(true);
							$("#role_btn").html("<i class='fa fa-paper-plane'></i> Add");
							$("#span_addrole").html("Add User");
							$("#frm_role input[name='op_type_role']").val("add_role");
							$("#txtrolecode").prop("readonly", false);
		                }
		            } catch (e) {
		                sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
		            }
	            },
	            error: function(){
		           alert("unable to save")
		        }
		    });
		},
		fields:{
			txtrolecode: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtroleName: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtLandingPage: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			
		}
	});
	
	/*
	* Delete in role master table 
	*/	
		
	function deleteRole(event)
	{   
		swal({
			title: "Are you sure?",
			text: "You want to Delete the Role !",
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
				var oTable = $('#dtblrolemaster').dataTable();
				var row;
				//alert(event.target.tagName);
				if(event.target.tagName == "BUTTON")
				   row = event.target.parentNode.parentNode;
				else if(event.target.tagName == "I")
				   row = event.target.parentNode.parentNode.parentNode;
				var formData = {
	    				rolecode:oTable.fnGetData(row)['role_code'],
	    				op_type:"delete_role"
	    			};
				$.ajax({
			        type: "POST",
			        url: base_url + "ajax_controller/delete_data", 
					data: formData,
			        success: function(response){
						 try {
			                var obj = JSON.parse(response);
			                if (!obj.status) {
			                    sweetAlert("ROLE",obj.msg, "error");
			                } else {
			                	swal('Deleted!',obj.msg,'success');
			                	dtblrolemaster = $('#dtblrolemaster').DataTable();
								dtblrolemaster.draw();
								dtblrolemaster.clear();
			                }
			            } catch (e) {
			                sweetAlert("Sorry","We are unable to Process !", "error");
			            }
		            },
		            error: function(){
			           alert("Fail")
			        }
			    });
			}
	    });
	}
		
	/*
	* Reset button click 
	*/
	
	$("#role_reset").click(function()
    {  
    	$("#role_btn").html("<i class='fa fa-paper-plane'></i> Add");
		$("#span_addrole").html("Add User");
		$("#frm_role input[name='op_type_role']").val("add_role");
	    $('#frm_role').data('bootstrapValidator').resetForm(true);
	    $("#txtrolecode").prop("readonly", false);
 	});
	 	
	 	
	 	
	/*
	* This pice of code is for creating updating and deleting a role  for the user access control (ends)
	*/ 
	
	
	
	/*
	* This pice of code is for creating updating and deleting a resource  for the user access control (begins)
	*/ 
	
	
		 
   /*
	* Author:  Lina Mohapatra
	* Date: 11/09/2017
	* Description : This pice of code is for creating updating and deleting a resource.
	* Tab :Role
	* 
 	**/
	

	var url =base_url+"ajax_controller/get_datatable_data/get_resourcedata";
	var dtblresourcemaster = $('#dtblresourcemaster').dataTable({
		"processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "bDestroy": true,
        "paging":   true,
        "info":     true,
        "autoWidth": false,
        "responsive":true,
       	"searching":true,
		"ajax": {
		     "url": url,
		     "type": "POST"
		},
        "columns": [
           { "sName": "sl_no","sClass":"alignCenter"},
           { "sName": "resource_code"},
           { "sName": "resource_link"},
           { "sName": "resource_name"},
           { "sName": "id"},
           { "sName": "button","sClass":"alignCenter","sDefaultContent":"<button type='button' class='btn btn-info btn-circle'  onclick='updateResource(event);' id='edit' ><i class='fa fa-pencil-square-o'></i></button>&nbsp;\
           				<button type='button' class='btn btn-danger btn-circle' onclick='deleteResource(event);'  id='delete'><i class='fa fa-trash'></i></button>"
	       }
        ],
        "aoColumnDefs": [{ "bVisible": false, "aTargets": [ 1,4 ] }], 	             
	});
	 	
   
	/*
	* edit in role master table 
	*/	
		
	function updateResource(event)
	{
		$('#resource_btn')[0].innerHTML = '<i class="fa fa-edit"></i> Update';
		$('#span_addresource')[0].innerHTML = 'Edit Role'; 
		//$("#txtresourcecode").prop("readonly", true);
		$('#op_type_resource').val('edit_resource');
		
		var oTable = $('#dtblresourcemaster').dataTable();
		var row;
		if(event.target.tagName == "BUTTON")
		   row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
		   row = event.target.parentNode.parentNode.parentNode;
		$('#txtresourcelink').val(oTable.fnGetData(row)['resource_link']);
		$('#txtresourceName').val( oTable.fnGetData(row)['resource_name']);
		$('#resource_code').val( oTable.fnGetData(row)['resource_code']);
		
	}
	
	/*
	* Delete in role master table 
	*/	
	
	function deleteResource(event)
	{
		swal({
			title: "Are you sure?",
			text: "You want to Delete the Resource !",
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
				var oTable = $('#dtblresourcemaster').dataTable();
				var row;
				if(event.target.tagName == "BUTTON")
				   row = event.target.parentNode.parentNode;
				else if(event.target.tagName == "I")
				   row = event.target.parentNode.parentNode.parentNode;
		
				var formData = {
	    				resourcecode:oTable.fnGetData(row)['resource_code'],
	    				op_type:"delete_resource"};
				$.ajax({
			        type: "POST",
			        url: base_url + "ajax_controller/delete_data", 
					data: formData,
			        success: function(response){
						 try {
			                var obj = JSON.parse(response);
			                if (!obj.status) {
			                    sweetAlert("RESOURCE",obj.msg, "error");
			                } else {
			                	swal('Deleted!',obj.msg,'success');
			                	dtblresourcemaster = $('#dtblresourcemaster').DataTable();
								dtblresourcemaster.draw();
								dtblresourcemaster.clear();
			                }
			            } catch (e) {
			                sweetAlert("Sorry","We are unable to Process !", "error");
			            }
		            },
		            error: function(){
			           alert("Fail")
			        }
			    });
		    }
	    });
	}
		
	/*
	* bootstrap validator for resorce form
	*/	
		
	$('#frm_resource').bootstrapValidator({
		excluded: [':disabled'],
		message: 'This value is not valid',
		feedbackIcons: 
        {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton){
			var formData = new FormData(document.getElementById("frm_resource"));
			$.ajax({
		        type: "POST",
		        url: base_url + "ajax_controller/operation_resourcedata", 
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
		        success: function(response){
					try {
		                var obj = JSON.parse(response);
		                if (obj.status == false) {
		                	$('#errorlog_resorce').html('');
		                	$('#errorlog_resorce').hide();
		                    sweetAlert("RESOURCE",obj.msg, "error");
		                }else if(obj.status === 'validationerror'){
		                	$('#errorlog_resorce').html(obj.msg);
		                	$('#errorlog_resorce').show();
		                } else {
		                	sweetAlert("RESOURCE",obj.msg, "success");
		                	$('#errorlog_resorce').html('');
		                	$('#errorlog_resorce').hide();
		            		dtblresourcemaster = $('#dtblresourcemaster').DataTable();
							dtblresourcemaster.draw();
							dtblresourcemaster.clear();
							$('#frm_resource').data('bootstrapValidator').resetForm(true);
							$("#resource_btn").html("<i class='fa fa-paper-plane'></i> Add");
							$("#span_addresource").html("Add Resource");
							$("#frm_resource input[name='op_type_resource']").val("add_resource");
							//$("#txtresourcecode").prop("readonly", false);
		                }
		            } catch (e) {
		                sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
		            }
					
		        },
		        error: function(){
		           alert("unable to save")
		        }
		    });
		},
		fields:{
			txtresourcelink: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			txtresourceName: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
		}
	});
	
		
	/*
	* Reset button click 
	*/
	
	$("#resource_reset").click(function()
    {  
    	$("#resource_btn").html("<i class='fa fa-paper-plane'></i> Add");
		$("#span_addresource").html("Add Resource");
		$("#frm_resource input[name='op_type_resource']").val("add_resource");
	    $('#frm_resource').data('bootstrapValidator').resetForm(true);
	    //$("#txtresourcecode").prop("readonly", false);
 	});
	 	
	 	
	 	
	/*
	* This pice of code is for creating updating and deleting a resource  for the user access control (ends)
	*/ 

