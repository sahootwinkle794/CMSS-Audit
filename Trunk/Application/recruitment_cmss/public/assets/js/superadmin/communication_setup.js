/***** smsProvider  Edit Delete Functions Starts***********/

//Function for edit modal for Board
function editModalFormsprovider(event){
	var oTable = $('#tblsmsprovidersetup').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;
	$('#frmprovidersetupEdit').data('bootstrapValidator').resetForm(true);
	//--------------
	var smsproviderid = oTable.fnGetData(row)[6];//alert(smsproviderid);return;
	
	//$('#hidOperProviderEdit').val("edit_provider");//GETTING VALUE FOR HIDDEN COLUMN
	$('#errorlog_provider_edit').html("");
	$('#hidprovideridEdit').val(smsproviderid);//GETTING VALUE FOR HIDDEN COLUMN
	$('#txtproviderEdit').val( oTable.fnGetData(row)[1]);
	$('#txtsmsUrlEdit').val( oTable.fnGetData(row)[2]);
	$('#txtUserNameEdit').val( oTable.fnGetData(row)[3]);
	$('#txtsmspasswordEdit').val( oTable.fnGetData(row)[4]);
	$('#txtSenderEdit').val( oTable.fnGetData(row)[5]);
	//----------
	$('#providersetupModalEdit').modal('show');
}
	
//Delete In Board
function deleteRowForsmsprovider(event)
{
	// sweet-alert for delete
    swal({
	  title: "Are you sure?",
	  text: "You want to Delete the Provider!",
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
	    swal("Deleted", "Provider has been deleted successfully.", "success");
	  } else {
		    swal("Cancelled", "Provider is safe ", "error");
	  }
	});
    function deleteMaster(){
		var oTable = $('#tblsmsprovidersetup').dataTable();
		var row;
		if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
		   row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
		   row = event.target.parentNode.parentNode.parentNode;
		$('#hidprovideridEdit').val( oTable.fnGetData(row)[6]); 
		var institutedata=
		{
			hidprovideridEdit:$('#hidprovideridEdit').val(),
		};		
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/operation_provider_delete",
			type:"post",
			data:institutedata,
			success:function(response)
			{ 
				try
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
						toastr.success(obj.msg);
						var dtblProgram = $("#tblsmsprovidersetup").DataTable();
	 					dtblProgram.ajax.reload();
	 					
					}
					else
					{
						toastr.error(obj.msg);
					}
				}
				catch(e)
				{
					sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
				} 		 				 
			},
			error:function()
			{
				toastr.error('Unable to process please contact support');
			}
		});	
	}
}
/*****smsProvider Edit Delete Functions Ends***********/

/***** smsSetup  Edit Delete Functions Starts***********/

//Function for edit modal for sms
function editModalForsmssetup(event)
{
	var oTable = $('#tblsmssetup').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;
	$('#frmsmssetupEdit').data('bootstrapValidator').resetForm(true);	
	//--------------
	var smssetupid = oTable.fnGetData(row)[7];
		$('#hidsmsidEdit').val(smssetupid);//GETTING VALUE FOR HIDDEN COLUMN
		
		var selectedText1 = oTable.fnGetData(row)[1];
		/*$("#cmbsmsTypeEdit option").each(function () {
			if ($(this).html() == selectedText) {
				$(this).attr("selected", "selected");
				return;
			}
		});*/
		/*$.ajax({
			url:base_url+"ajax_controller/select_sms_provider",
			type:"post",
			success:function(response)
			{  
				var options = "";
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data){
					options = options + "<option value="+data.provider_name+">"+data.providername+"</option>";
				});		
				$('#cmbsmsProviderEdit').html("");
				$('#cmbsmsProviderEdit').append(options);		
			},
			error:function()
			{
				toastr.error('Unable to process please contact support');
			}
		});*/
		$("#cmbsmsTypeEdit").val(selectedText1);
		$("#hidsmsTypeEdit").val(selectedText1);
		$('#txtSubjectEdit').val(oTable.fnGetData(row)[2]);
		var selectedText = oTable.fnGetData(row)[5];
		$('#cmbStatusEdit').val(selectedText);//GETTING VALUE FOR HIDDEN COLUMN
		$('#txtContentEdit').val(oTable.fnGetData(row)[3]);
		var selectedText2 = oTable.fnGetData(row)[4];//alert(selectedText2);return;
		/*$("#cmbsmsProviderEdit option").each(function () {
			if ($(this).html() == selectedText) {
				$(this).attr("selected", "selected");
				return;
			}
		});*/
		$('#cmbsmsProviderEdit').val(oTable.fnGetData( row )['prov_name']);
		//alert($('#cmbsmsProviderEdit').val());
		//$("#cmbsmsProviderEdit").val(selectedText2);
		
	//----------
	$('#smssetupModalEdit').modal('show');
}
	
	//Delete In Board
function deleteRowForsmssetup(event)
{
	// sweet-alert for delete
    swal({
	  title: "Are you sure?",
	  text: "You want to Delete the SMS!",
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
	    swal("Deleted", "SMS has been deleted successfully.", "success");
	  } else {
		    swal("Cancelled", "SMS is safe ", "error");
	  }
	});
    function deleteMaster(){
		var oTable = $('#tblsmssetup').dataTable();
		var row;
		if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
		   row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
		   row = event.target.parentNode.parentNode.parentNode;
		$('#hidsmsidEdit').val( oTable.fnGetData(row)[7]); 
		var institutedata=
		{
			hidsmsidEdit:$('#hidsmsidEdit').val(),
		};		
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/operation_sms_delete",
			type:"post",
			data:institutedata,
			success:function(response)
			{ 
				try
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
						var dtblProgram = $("#tblsmssetup").DataTable();
	 					dtblProgram.ajax.reload();
						toastr.success('Data Successfully Deleted');
	 					
					}
					else
					{
						toastr.error(obj.msg);
					}
				}
				catch(e)
				{
					sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
				} 		 				 
			}
		});
		
	}
}
/*****smsSetup Edit Delete Functions Ends***********/
//===================================================================================
/***** EmailProvider  Edit Delete Functions Starts***********/

//Function for edit modal for EmailProvider
function editModalForemailprovider(event)
{
	var oTable = $('#tblemailprovidersetup').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;
	$('#frmemailprovidersetupEdit').data('bootstrapValidator').resetForm(true);
	//--------------
	var emailproviderid = oTable.fnGetData(row)[8];
	$('#hidEprovideridEdit').val(emailproviderid);//GETTING VALUE FOR HIDDEN COLUMN
	
	$('#txtMailProviderEdit').val(oTable.fnGetData(row)[1]);
	//alert(oTable.fnGetData(row)[1]);
	$('#txtMailHostEdit').val(oTable.fnGetData(row)[2]);
	$('#txtMailPortEdit').val(oTable.fnGetData(row)[3]);
	$('#txtemailIDEdit').val(oTable.fnGetData(row)[4]);
	$('#txtmailpasswordEdit').val(oTable.fnGetData(row)[5]);
	$('#txtSmtpauthEdit').val(oTable.fnGetData(row)[6]);
	$('#txtSmtpsecureEdit').val(oTable.fnGetData(row)[7]);
	//----------
	$('#emailprovidersetupModalEdit').modal('show');
}
	
//Delete In EmailProvider
function deleteRowForemailprovider(event)
{
	// sweet-alert for delete
    swal({
	  title: "Are you sure?",
	  text: "You want to Delete the Provider!",
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
	    swal("Deleted", "Provider has been deleted successfully.", "success");
	  } else {
		    swal("Cancelled", "Provider is safe ", "error");
	  }
	});
    function deleteMaster(){
		var oTable = $('#tblemailprovidersetup').dataTable();
		var row;
		if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
		   row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
		   row = event.target.parentNode.parentNode.parentNode;
		$('#hidEprovideridEdit').val( oTable.fnGetData(row)[8]); 
		var institutedata=
		{
			hidEprovideridEdit:$('#hidEprovideridEdit').val()
		};		
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/operation_email_provider_delete",
			type:"post",
			data:institutedata,
			success:function(response)
			{ 
				try
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
						toastr.success(obj.msg);
						var dtblProgram = $("#tblemailprovidersetup").DataTable();
	 					dtblProgram.ajax.reload();	
					}
					else
					{
						toastr.error(obj.msg);
					}
				}
				catch(e)
				{
					sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
				} 		 				 
			},
			error:function()
			{
				toastr.error('Unable to process please contact support');
			}
		});	
			
	}
}
/*****EmailProvider Edit Delete Functions Ends***********/

/***** EmailSetup  Edit Delete Functions Starts***********/

//Function for edit modal for Emailserup
function editModalForemailsetup(event){
	
	var oTable = $('#tblemailsetup').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;
	
	//--------------
	
	
	$('#frmemailsetupEdit').data('bootstrapValidator').resetForm(true);	
	var emailsetupid = oTable.fnGetData(row)[7];
		$('#hidemailidEdit').val(emailsetupid);//GETTING VALUE FOR HIDDEN COLUMN
		var selectedText12 = oTable.fnGetData(row)[1];
		//alert(selectedText12);
		$("#cmbMailTypeEdit").val(selectedText12);
		$("#hidMailTypeEdit").val(selectedText12);
		$('#txtemailSubjectEdit').val(oTable.fnGetData(row)[2]);
		var selectedText123 =oTable.fnGetData(row)[5];
		//alert(selectedText123);
		$('#cmbStatusEdit1').val(selectedText123);//GETTING VALUE FOR HIDDEN COLUMN
		//alert($('#cmbStatusEdit').val());
		$('#txtemailContentEdit').val(oTable.fnGetData(row)[3]);
		//alert(oTable.fnGetData(row)[3]);
		var selectedText = oTable.fnGetData(row)[4];
		//selectedText = selectedText+'_'+$('#hidInsCode').val();
		//alert(selectedText);
		$("#cmbEmailProviderEdit").val(oTable.fnGetData(row)[4]);
	//----------
	$('#emailsetupModalEdit').modal('show');
}
	
//Delete In Email setup
function deleteRowForemailsetup(event)
{
	// sweet-alert for delete
    swal({
	  title: "Are you sure?",
	  text: "You want to Delete the Email!",
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
	    swal("Deleted", "Email has been deleted successfully.", "success");
	  } else {
		    swal("Cancelled", "Email is safe ", "error");
	  }
	});
    function deleteMaster(){
		var oTable = $('#tblemailsetup').dataTable();
		var row;
		if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
		   row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
		   row = event.target.parentNode.parentNode.parentNode;
		$('#hidemailidEdit').val( oTable.fnGetData(row)[7]); 
		var institutedata=
		{
			hidemailidEdit:$('#hidemailidEdit').val()
		};		
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/operation_email_delete",
			type:"post",
			data:institutedata,
			success:function(response)
			{  
				try
				{
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
						toastr.success(obj.msg);
						var dtblProgram = $("#tblemailsetup").DataTable();
	 					dtblProgram.ajax.reload();
					}
					else
					{
						toastr.error(obj.msg);
					}
				}
				catch(e)
				{
					sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
				} 			 
			},
			error:function()
			{
				toastr.error('Unable to process please contact support');
			}
		});	
	}
}
/*****EmailSetup Edit Delete Functions Ends***********/






/******* Message(sms) Table for Insert and Edit *********/
$(document).ready(function(){
	var isDelete= false;
	var isEdit = false;
	var session = $("#hidSession").val();
	var oTable;
	/*$('#emailaddbtn').click(function(){
		//GET PROVIDER NAME LIST
		
		
	});*/
	$('#email').click(function(){
		
		var tblemailprovidersetup = $('#tblemailprovidersetup').DataTable();
		tblemailprovidersetup.ajax.url(base_url+"ajax_controller/select_email_provider").load();
		var tblemailsetup = $('#tblemailsetup').DataTable();
		tblemailsetup.ajax.url(base_url+"ajax_controller/select_email_setup").load();
	});
	/*$('#smsaddbtn').click(function(){
		//GET PROVIDER NAME LIST
		
		
	});*/
	/*$.ajax({
		url:base_url+"ajax_controller/select_email_type",
		type:"post",
		success:function(response)
		{  
			var options = "";
			options = "<option value=''>Select Email Type</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value='"+data.email_type+"'>"+data.email_type+"</option>";
			});		
			$('#cmbMailTypeEdit').html("");
			$('#cmbMailTypeEdit').append(options);		
			
		},
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	});	*/
	$.ajax({
		url:base_url+"ajax_controller/select_email_provider",
		type:"post",
		success:function(response)
		{  
			var options = "";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.providername+">"+data.providername+"</option>";
			});		
			$('#cmbEmailProviderEdit').html("");
			$('#cmbEmailProviderEdit').append(options);		
		},
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	});
	$('#message').click(function(){
		
		var tblsmsprovidersetup = $('#tblsmsprovidersetup').DataTable();
		tblsmsprovidersetup.ajax.url(base_url+"ajax_controller/select_sms_provider").load();
		var tblsmssetup = $('#tblsmssetup').DataTable();
		tblsmssetup.ajax.url(base_url+"ajax_controller/select_sms_setup").load();
	});
	var tblemailprovidersetup = $('#tblsmsprovidersetup').dataTable({
		"sAjaxSource": base_url+"ajax_controller/select_sms_provider",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort":true,
        "bInfo": true,
        "scrollX": true,
        "bAutoWidth": false, 
        "bRetrieve": true,
		/*"sDom":"<'row'<'col-xs-4 addbuttonSmsProvider'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6' i>>><'col-xs-6'p>>",*/
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addbuttonSmsProvider' >>><'col-xs-6'p>>", 
		"aoColumns": [
						{ "sName": "Sl No","sWidth": "5%"},
						{ "sName": "Provider","sWidth": "10%" },
                     	{ "sName": "url","sWidth": "45%" },
						{ "sName": "user name","sWidth": "10%" },            
                     	{ "sName": "password","sWidth": "10%" },
                     	{ "sName": "sender","sWidth": "10%" },
                     	{ "sName": "id","bVisible":false },
                     	{ "sName": "provider_name","bVisible":false },
                     	{ "sName": "Action","sClass": "alignCenter","sWidth": "10%", "sDefaultContent": "<button   class='btn btn-warning  btn-circle tooltipTable' id='btnCorseEdit' title='Edit' onclick='editModalFormsprovider(event)'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<button  id='btnDocumentDelete' title='Delete' class='btn btn-danger btn-circle tooltipTable' onclick='deleteRowForsmsprovider(event)'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}	
        ],
        "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 8 ] }],
        "fnDrawCallback": function(oSettings, json) {
	        $('.tooltipTable').tooltipster( {
	           theme: 'tooltipster-punk',
	           animation: 'grow',
	           delay: 200, 
	           touchDevices: false,
	           trigger: 'hover'
	        });
        }
	});
	$("div.addbuttonSmsProvider").html('<button id="provideraddbtn" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	/*$("div.addbuttonSmsProvider").html('<div class="btngroup"><button id="provideraddbtn" class="btn btn-info btn-circle tooltipTable" title="Add"><i class="fa fa-plus"></i> </button></div>');*/
	var tblsms = $('#tblsmssetup').dataTable({
		"sAjaxSource": base_url+"ajax_controller/select_sms_setup",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort":true,
        "bInfo": true,
        "bAutoWidth": false, 
        "bRetrieve": true,
		/*"sDom":"<'row'<'col-xs-4 addbuttonSmsSetup'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6' i>>><'col-xs-6'p>>",*/
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addbuttonSmsSetup' >>><'col-xs-6'p>>", 
		"aoColumns": [
						{ "sName": "Sl No","sWidth": "5%"},
                     	{ "sName": "sms type","sWidth": "10%" },
                     	{ "sName": "subject" ,"sWidth": "10%"},
                     	{ "sName": "content","sWidth": "50%" },
                     	{ "sName": "Provider Name","sWidth": "10%" },
                     	{ "sName": "status","bVisible":false },
                     	{ "sName": "status","sWidth": "5%","sClass":"alignCenter",
                       		"mRender": function( data, type, full ) {
				                return '<img src="'+ base_url +'public/assets/images/'+ data +'.png" ></img>';
				            }  },
                     	{ "sName": "id","bVisible":false },
                     	{ "sName": "Action","data":null,"sClass":"alignCenter","sWidth": "10%", "sDefaultContent": "<button  class='btn btn-warning  btn-circle tooltipTable' id='btnCorseEdit' title='Edit' onclick='editModalForsmssetup(event)'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<button   id='btnDocumentDelete' title='Delete' class='btn btn-danger btn-circle tooltipTable' onclick='deleteRowForsmssetup(event)'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}
        ],
        "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 8 ] }],
        "fnDrawCallback": function(oSettings, json) {
	        $('.tooltipTable').tooltipster( {
	           theme: 'tooltipster-punk',
	           animation: 'grow',
	           delay: 200, 
	           touchDevices: false,
	           trigger: 'hover'
	        });
        }
	});
	$("div.addbuttonSmsSetup").html('<button id="smsaddbtn" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	/*$("div.addbuttonSmsSetup").html('<div class="btngroup"><button id="smsaddbtn" class="btn btn-info btn-circle tooltipTable" title="Add"><i class="fa fa-plus"></i></button></div>');*/
	
	
	if ($("#providerSetupCheckedMsg").is(":checked")) {
	    	$("#smssetup").hide("slide");
	        $("#smsprovidersetup").show("slide");
	    } 
	    else {
	        //otherwise, hide it
	        $("#smsprovidersetup").hide("slide");
	    }
	if ($("#smsSetupChecked").is(":checked")) 
	{
        $("#smsprovidersetup").hide("slide");
        $("#smssetup").show("slide");
	 }
	else 
	{
        //otherwise, hide it
        $("#smssetup").hide("slide");
    }
	$('#provideraddbtn').click(function(){
		$('#frmprovidersetup').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal
			
		$('#txtprovider').val("");
		$('#txtsmsUrl').val("");
		$('#txtUserName').val("");
		$('#txtsmspassword').val("");
		$('#txtSender').val("");
		$('#hidOperProvider').val("add_sms_provider");
		$('#errorlog_provider').html("");
		
		$('#providersetupModal').modal('show');
		$('#providersetupModal').on('shown.bs.modal', function () {  // Focusing the textbox
			$('#txtprovider').focus();
			})
	});
	
	$('#providereditbtn').click(function(){
		if(isEdit){
		$('#providersetupModalEdit').modal('show');
		}
		else{
			toastr.error('Please Select a Record');
		}	
	});
	$('#providerdeletebtn').click(function(){
		if(isDelete){
		
		$('#smsproviderdeletemodal').modal('show');
		}
		else{
			toastr.error('Please Select a Record');
		}
		
	});
	$('#smsaddbtn').click(function(){
		$('#frmsmssetup').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal
			
		$('#cmbsmsType').val("");
		$('#txtSubject').val("");
		$('#txtContent').val("");
		$('#cmbsmsProvider').val("");
		$('#cmbStatus').val("");
		
		$('#smssetupModal').modal('show');
		$('#smssetupModal').on('shown.bs.modal', function () {  // Focusing the textbox
			$('#cmbsmsType').focus();
		});
		$.ajax({
			url:base_url+"ajax_controller/select_sms_provider",
			type:"post",
			success:function(response)
			{  
				var options = "";
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data){
					options = options + "<option value="+data.provider_name+">"+data.providername+"</option>";
				});		
				$('#cmbsmsProvider').html("");
				$('#cmbsmsProvider').append(options);		
			},
			error:function()
			{
				toastr.error('Unable to process please contact support');
			}
		});
	});
	
	$('#smseditbtn').click(function(){
		if(isEdit){
		$('#smssetupModalEdit').modal('show');
		}
		else{
			toastr.error('Please Select a Record');
		}	
	});
	$('#smsdeletebtn').click(function(){
		if(isDelete){
		
		$('#smsdeletemodal').modal('show');
		}
		else{
			toastr.error('Please Select a Record');
		}
		
	});
	//GET PROVIDER NAME LIST
		$.ajax({
			url:base_url+"ajax_controller/select_sms_provider",
			type:"post",
			success:function(response)
			{  
				var options = "";
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data){
					options = options + "<option value="+data.provider_name+">"+data.providername+"</option>";
				});		
				$('#cmbsmsProvider').html("");
				$('#cmbsmsProvider').append(options);		
			},
			error:function()
			{
				toastr.error('Unable to process please contact support');
			}
		});
		$.ajax({
			url:base_url+"ajax_controller/select_sms_provider",
			type:"post",
			success:function(response)
			{  
				var options = "";
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data){
					options = options + "<option value="+data.provider_name+">"+data.providername+"</option>";
				});		
				$('#cmbsmsProviderEdit').html("");
				$('#cmbsmsProviderEdit').append(options);		
			},
			error:function()
			{
				toastr.error('Unable to process please contact support');
			}
		});
	
	
	// CHECKING DUPLICATION OF PROVIDER NAME	
	

	$('#txtprovider').on("change",function(event){
	if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
		var institutedata={
						smsprovider:$(event.target).val(),
						validateprovidername:true,
						
					};
		   //ajax call to server
						$.ajax({
							url:base_url+"ajax_controller/check_sms_provider",
							type:"post",
							data:institutedata,
							success:function(response){
							//alert('djfsh');
								var res1 = JSON.parse(response);
								$.each(res1.aaData,function(i,data){
									if($(event.target).val() == aaData.provider_name)
									{
										$(event.target).val("");
										$('#frmprovidersetup').data('bootstrapValidator').updateStatus('txtprovider', 'INVALID', null);
										//$('.duplication').modal('show');
										toastr.error('Provider Name Already Used.Try With Another One.');
										$(event.target).focus();
										
									}
								});	
							},  
							error:function(){
								toastr.error('Unable to process please contact support');
							}
						}); 
		}
	});
	$('#txtproviderEdit').on("change",function(event){
	if($(event.target).val() != "" && $(event.target).val() != undefined)
	{
		var institutedata={
			smsprovideredit:$(event.target).val(),
			validateprovidername:true,
		};
			//ajax call to server
			$.ajax({
					url:base_url+"ajax_controller/check_sms_provider_edit",
					type:"post",
					data:institutedata,
					success:function(response){
					//alert('djfsh');
						var res1 = JSON.parse(response);
						$.each(res1.aaData,function(i,data){
							if($(event.target).val() == aaData.provider_name)
							{
								$(event.target).val("");
								$('#frmprovidersetupEdit').data('bootstrapValidator').updateStatus('txtproviderEdit', 'INVALID', null);
								//$('.duplication').modal('show');
								toastr.error('Provider Name Already Used.Try With Another One.');
								$(event.target).focus();
								
							}
						});	
					},  
					error:function(){
						toastr.error('Unable to process please contact support');
					}
				}); 
			
		}
	});
	
//ADD RECORD WITH VALIDATION
	$('#frmprovidersetup').bootstrapValidator({
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
			var formData = new FormData(document.getElementById("frmprovidersetup"));	
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_sms_provider_add",
				type:"post",
				cache: false,
		        contentType: false,
		        processData: false,
		        data: formData,
				success:function(response)
				{  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == "Error")
						{
							toastr.error('Duplicate entry of Provider .Try a new one!!!');
							$('#providersetupModal').modal('show');
							$('#txtprovider').focus();
							$('#txtprovider').val("");
					 		$('#frmprovidersetup').data('bootstrapValidator').updateStatus('txtprovider', 'NOT_VALIDATED', null).validateField('txtprovider');						
							
							return false;
						}
						else if(obj.status == true)
						{
							toastr.success(obj.msg);
							var dtblprovidersetup = $("#tblsmsprovidersetup").DataTable();
						 	dtblprovidersetup.ajax.reload();
						 	$('#frmprovidersetup').data('bootstrapValidator').resetForm(true);	
							$('#errorlog_provider').html("");
		                	$('#errorlog_provider').hide();
		                	$('#providersetupModal').modal('hide');
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_provider').html(obj.msg);
		                	$('#errorlog_provider').show();
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
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields: {			
			
			cmbInstitute:{
				validators: {
					notEmpty: {
						message: 'Institute is Required'
					}
				}
			},
			txtsmspassword:{
				validators: {
					notEmpty: {
						message: 'SMS Password is Required'
					}
				}
			},	
			txtSender:{
				validators: {
					notEmpty: {
						message: 'Sender Name is Required'
					}
				}
			},	
			
			txtUserName:{
				validators: {
					notEmpty: {
						message: 'User Name is Required'
					}
				}
			},	
			txtsmsUrl:{
				validators: {
					notEmpty: {
						message: 'HTTP API SMS URL is Required'
					}
				}
			},		
			txtprovider:{
				validators: {
					notEmpty: {
						message: 'Provider Name is Required'
					},
					regexp: {
								regexp: /^([A-Za-z0-9]+)$/i,
								message: "Special characters and space are not allowed"
							},
				}
			}
		}
	} );
//EDIT RECORD WITH VALIDATION
	$('#frmprovidersetupEdit').bootstrapValidator({
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
			var formData = new FormData(document.getElementById("frmprovidersetupEdit"));//console.log(formData);return;	
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_sms_provider_edit",
				type:"post",
				cache: false,
		        contentType: false,
		        processData: false,
		        data: formData,
				success:function(response)
				{  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							var dtblprovidersetup = $("#tblsmsprovidersetup").DataTable();
						 	dtblprovidersetup.ajax.reload();
						 	$('#frmprovidersetupEdit').data('bootstrapValidator').resetForm(true);	
							$('#errorlog_provider_edit').html("");
		                	$('#errorlog_provider_edit').hide();
		                	$('#providersetupModalEdit').modal('hide');
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_provider_edit').html(obj.msg);
		                	$('#errorlog_provider_edit').show();
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
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields: {
			
			cmbInstituteEdit:{
				validators: {
					notEmpty: {
						message: 'Institute is Required'
					}
				}
			},				
			
			txtsmspasswordEdit:{
				validators: {
					notEmpty: {
						message: 'SMS Password is Required'
					}
				}
			},	
			txtSenderEdit:{
				validators: {
					notEmpty: {
						message: 'Sender Name is Required'
					}
				}
			},	
			
			txtUserNameEdit:{
				validators: {
					notEmpty: {
						message: 'User Name is Required'
					}
				}
			},	
			txtsmsUrlEdit:{
				validators: {
					notEmpty: {
						message: 'HTTP API SMS URL is Required'
					}
				}
			},		
			txtproviderEdit:{
				validators: {
					notEmpty: {
						message: 'Provider Name is Required'
					},
					regexp: {
								regexp: /^([A-Za-z0-9]+)$/i,
								message: "Special characters and space are not allowed"
							},
				}
			}
		}
	} );
	
	//ADD RECORD WITH VALIDATION
	$('#frmsmssetup').bootstrapValidator({
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
			var formData = new FormData(document.getElementById("frmsmssetup"));	
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_sms_add",
				type:"post",
				cache: false,
		        contentType: false,
		        processData: false,
		        data: formData,
				success:function(response)
				{  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == "Error")
						{
							toastr.error('Duplicate entry of Sms type .Try a new one!!!');
							$('#smssetupModal').modal('show');
							$('#cmbsmsType').focus();
							$('#cmbsmsType').val("");
					 		$('#frmsmssetup').data('bootstrapValidator').updateStatus('cmbsmsType', 'NOT_VALIDATED', null).validateField('cmbsmsType');						
							
							return false;
						}
						else if(obj.status == true)
						{
							toastr.success(obj.msg);
							var dtblsmssetup = $("#tblsmssetup").DataTable();
				 			dtblsmssetup.ajax.reload();
				 			$('#frmsmssetup').data('bootstrapValidator').resetForm(true);	
							$('#errorlog_sms').html("");
		                	$('#errorlog_sms').hide();
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_sms').html(obj.msg);
		                	$('#errorlog_sms').show();
		                }
						else 
						{
							sweetAlert("SMS",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}		 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields: {			
			cmbsmsType:{
				validators: {
					notEmpty: {
						message: 'SMS Type is Required'
					}
				}
			},	
			txtSubject:{
				validators: {
					notEmpty: {
						message: 'Subject is Required'
					}
				}
			},
			txtContent:{
				validators: {
					notEmpty: {
						message: 'Content is Required'
					}
				}
			},		
			cmbsmsProvider:{
				validators: {
					notEmpty: {
						message: 'Email Provider is Required'
					}
				}
			},	
			cmbStatus:{
				validators: {
					notEmpty: {
						message: 'Status is Required'
					}
				}
			}
		}
	} );
	// edit record with validation for email setup
	$('#frmsmssetupEdit').bootstrapValidator({
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
			var formData = new FormData(document.getElementById("frmsmssetupEdit"));	
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_sms_edit",
				type:"post",
				cache: false,
		        contentType: false,
		        processData: false,
		        data: formData,
				success:function(response)
				{  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							var dtblsmssetup = $("#tblsmssetup").DataTable();
				 			dtblsmssetup.ajax.reload();
				 			$('#frmsmssetupEdit').data('bootstrapValidator').resetForm(true);	
							$('#errorlog_sms_edit').html("");
		                	$('#errorlog_sms_edit').hide();
		                	$('#smssetupModalEdit').modal('hide');
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_sms_edit').html(obj.msg);
		                	$('#errorlog_sms_edit').show();
		                }
						else 
						{
							sweetAlert("SMS",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}		 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields: {			
			cmbsmsTypeEdit:{
				validators: {
					notEmpty: {
						message: 'Mail Type is Required'
					}
				}
			},	
			txtSubjectEdit:{
				validators: {
					notEmpty: {
						message: 'Subject is Required'
					}
				}
			},	
			txtContentEdit:{
				validators: {
					notEmpty: {
						message: 'Content is Required'
					}
				}
			},	
			cmbsmsProviderEdit:{
				validators: {
					notEmpty: {
						message: 'Email Provider is Required'
					}
				}
			},
			cmbStatusEdit:{
				validators: {
					notEmpty: {
						message: 'Status is Required'
					}
				}
			}
		}
	} );

	$('#cmbsmsType').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				cmbsmsType:$(event.target).val(),
				validateMailcode:true,
				//type:"CHKDUCPLICATE_INSTRUCTION"
			};
		   //ajax call to server
		   $.ajax({
					url:base_url+"ajax_controller/check_smsType",
					type:"post",
					data:institutedata,
					success:function(response){
						var res1 = JSON.parse(response);
						$.each(res1.aaData,function(i,data){
							if($(event.target).val() == data.sms_type)
							{
								$(event.target).val("");
								$('#frmsmssetup').data('bootstrapValidator').updateStatus('cmbsmsType', 'INVALID', null);
								//$('.duplication').modal('show');
								toastr.error('SMS type Already Used.');
								$(event.target).focus();
								
							}
						});	
					},  
					error:function(){
						toastr.error('Unable to process please contact support');
					}
				}); 
			
		}
	}); 

	$('#cmbsmsTypeEdit').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				cmbsmsType:$(event.target).val(),
				validateMailcode:true,
				//type:"CHKDUCPLICATE_INSTRUCTION"
			};
		   //ajax call to server
		   $.ajax({
					url:base_url+"ajax_controller/check_smsType",
					type:"post",
					data:institutedata,
					success:function(response){
						var res1 = JSON.parse(response);
						$.each(res1.aaData,function(i,data){
							if($(event.target).val() == data.sms_type)
							{
								$(event.target).val("");
								$('#frmsmssetupEdit').data('bootstrapValidator').updateStatus('cmbsmsTypeEdit', 'INVALID', null);
								//$('.duplication').modal('show');
								toastr.error('SMS type Already Used.');
								$(event.target).focus();
								
							}
						});	
					},  
					error:function(){
						toastr.error('Unable to process please contact support');
					}
				}); 
			
		}
	}); 
	/*********  EMAIL SETUP  TEABLE FOR INSERT AND EDIT STARTS **********/
	var session = $("#hidSession").val();
	var tblemailprovidersetup = $('#tblemailprovidersetup').dataTable({
		//"sAjaxSource": "communication_setup_db.php?type=PROVIDERSELECT_email&_s="+session,
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort":true,
        "bInfo": true,
        "bAutoWidth": false,
         "scrollX": true, 
        "bRetrieve": true,
 		/*"sDom":"<'row'<'col-xs-4 addbuttonemailProvider'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6' i>>><'col-xs-6'p>>",*/
 		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addbuttonemailProvider' >>><'col-xs-6'p>>", 
		"aoColumns": [
						{ "sName": "Sl No","sWidth": "5%"},
						{ "sName": "Provider","sWidth": "10%" },
                     	{ "sName": "host","sWidth": "15%" },
						{ "sName": "port","sWidth": "10%" },
                     	{ "sName": "emailid" ,"sWidth": "10%"},              
                     	{ "sName": "password" ,"sWidth": "10%"},
                     	{ "sName": "smtp auth" ,"sWidth": "10%"},
                     	{ "sName": "smtp secure","sWidth": "18%" },
                     	{ "sName": "id","bVisible":false},
                     	{ "sName": "provider_name","bVisible":false},
                     	{ "sName": "Action","sClass": "alignCenter","sWidth": "10%", "sDefaultContent": "<button  class='btn btn-warning  btn-circle tooltipTable' id='btnCorseEdit' title='Edit' onclick='editModalForemailprovider(event)'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<button   id='btnDocumentDelete' title='Delete' class='btn btn-danger btn-circle tooltipTable' onclick='deleteRowForemailprovider(event)'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}	
        ],
        "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 10 ] }],
        "fnDrawCallback": function(oSettings, json) {
	        $('.tooltipTable').tooltipster( {
	           theme: 'tooltipster-punk',
	           animation: 'grow',
	           delay: 200, 
	           touchDevices: false,
	           trigger: 'hover'
	        });
        }
	});
	$("div.addbuttonemailProvider").html('<button id="emailproviderAddbtn" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	/*$("div.addbuttonemailProvider").html('<div class="btngroup"><button id="emailproviderAddbtn" class="btn btn-info btn-circle tooltipTable" title="Add"><i class="fa fa-plus"></i> </button></div>');*/
	$('#emailproviderAddbtn').click(function(){
		//alert(11);
		$('#frmemailprovidersetup').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal
			
		$('#txtproviderEmail').val("");
		$('#txtHost').val("");
		$('#txtMailPort').val("");
		$('#txtemailID').val("");
		$('#txtmailpassword').val("");
		$('#txtSmtpauth').val("");
		$('#txtSmtpsecure').val("");
		
		$('#emailProvidersetupModal').modal('show');
		$('#emailProvidersetupModal').on('shown.bs.modal', function () {  // Focusing the textbox
			$('#txtproviderEmail').focus();
		})
	});
	var tblemail = $('#tblemailsetup').dataTable({
		//"sAjaxSource": "communication_setup_db.php?type=EMAILSELECT_email&_s="+session,
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort":true,
        "bInfo": true,
        "bAutoWidth": false, 
        "bRetrieve": true,
 		/*"sDom":"<'row'<'col-xs-4 addbuttonemailSetup'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6' i>>><'col-xs-6'p>>",*/
 		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addbuttonemailSetup' >>><'col-xs-6'p>>", 
		"aoColumns": [
						{ "sName": "Sl No","sWidth": "5%"},
                     	{ "sName": "mail type","sWidth": "10%" },
                     	{ "sName": "subject","sWidth": "10%" },
                     	{ "sName": "content","sWidth": "40%" },
                     	{ "sName": "Provider Name" ,"sWidth": "10%"},
                     	{ "sName": "status","bVisible":false },
                     	{ "sName": "status","sWidth": "10%","sClass": "alignCenter",
                       		"mRender": function( data, type, full ) {
				                return '<img src="'+ base_url +'public/assets/images/'+ data +'.png" ></img>';
				            }  
				        },
                     	{ "sName": "id","bVisible":false },
                     	{ "sName": "Action","sClass": "alignCenter","sWidth": "10%", "sDefaultContent": "<button   class='btn btn-warning  btn-circle tooltipTable' id='btnCorseEdit' title='Edit' onclick='editModalForemailsetup(event)'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<button   id='btnDocumentDelete' title='Delete' class='btn btn-danger btn-circle tooltipTable' onclick='deleteRowForemailsetup(event)'><i class='fa fa-trash-o' aria-hidden='true'></i></button>"}	
        ],
        "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 8 ] }],
        "fnDrawCallback": function(oSettings, json) {
	        $('.tooltipTable').tooltipster( {
	           theme: 'tooltipster-punk',
	           animation: 'grow',
	           delay: 200, 
	           touchDevices: false,
	           trigger: 'hover'
	        });
        }
	});
	$("div.addbuttonemailSetup").html('<button id="emailaddbtn" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	/*$("div.addbuttonemailSetup").html('<div class="btngroup"><button id="emailaddbtn" class="btn btn-info btn-circle tooltipTable" title="Add"><i class="fa fa-plus"></i> </button></div>');*/
	
	$('#emailaddbtn').click(function(){
		$('#frmemailsetup').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal
			
		$('#errorlog_email').html("");
		$('#errorlog_email').val("");
		$('#cmbMailType').val("");
		$('#txtSubject').val("");
		$('#txtContent').val("");
		$('#cmbEmailProvider').val("");
		$('#cmbStatus').val("");
		
		$('#emailsetupModal').modal('show');
		$('#emailsetupModal').on('shown.bs.modal', function () {  // Focusing the textbox
			$('#cmbMailType').focus();
		});
		$.ajax({
			url:base_url+"ajax_controller/select_email_provider",
			type:"post",
			success:function(response)
			{  
				var options = "";
				options = "<option value=''>Select Provider</option>";
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data){
					options = options + "<option value="+data.provider_name+">"+data.providername+"</option>";
				});		
				$('#cmbEmailProvider').html("");
				$('#cmbEmailProvider').append(options);			
			},
			error:function()
			{
				toastr.error('Unable to process please contact support');
			}
		});	
		/*$.ajax({
			url:base_url+"ajax_controller/select_email_type",
			type:"post",
			success:function(response)
			{  
				var options = "";
				options = "<option value=''>Select Email Type</option>";
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data){
					options = options + "<option value='"+data.email_type+"'>"+data.email_type+"</option>";
				});		
						
				$('#cmbMailType').html("");
				$('#cmbMailType').append(options);	
				
				$('#cmbMailTypeEdit').html("");
				$('#cmbMailTypeEdit').append(options);	
			},
			error:function()
			{
				toastr.error('Unable to process please contact support');
			}
		});	*/
	});
	// CHECKING DUPLICATION OF PROVIDER NAME	
	$('#txtproviderEmail').on("change",function(event){
	if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
		var institutedata={
			emailprovider:$(event.target).val(),
			validateprovidername:true,
		};
//ajax call to server
			$.ajax({
					url:base_url+"ajax_controller/check_email_provider",
					type:"post",
					data:institutedata,
					success:function(response){
					//alert('djfsh');
						var res1 = JSON.parse(response);
						$.each(res1.aaData,function(i,data){
							if($(event.target).val() == aaData.provider_name)
							{
								$(event.target).val("");
								$('#frmemailprovidersetup').data('bootstrapValidator').updateStatus('txtproviderEmail', 'INVALID', null);
								//$('.duplication').modal('show');
								toastr.error('Provider Name Already Used.Try With Another One.');
								$(event.target).focus();
								
							}
						});	
					},  
					error:function(){
						toastr.error('Unable to process please contact support');
					}
				}); 
			
		}
	}); 
	$('#txtMailProviderEdit').on("change",function(event){
	if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
		var institutedata={
			emailprovideredit:$(event.target).val(),
			validateprovidername:true,
		};
//ajax call to server
			$.ajax({
					url:base_url+"ajax_controller/check_email_providerEdit",
					type:"post",
					data:institutedata,
					success:function(response){
					//alert('djfsh');
						var res1 = JSON.parse(response);
						$.each(res1.aaData,function(i,data){
							if($(event.target).val() == aaData.provider_name)
							{
								$(event.target).val("");
								$('#frmemailprovidersetupEdit').data('bootstrapValidator').updateStatus('txtMailProviderEdit', 'INVALID', null);
								//$('.duplication').modal('show');
								toastr.error('Provider Name Already Used.Try With Another One.');
								$(event.target).focus();
								
							}
						});	
					},  
					error:function(){
						toastr.error('Unable to process please contact support');
					}
				}); 
			
		}
	});
	//ADD RECORD WITH VALIDATION
	$('#frmemailprovidersetup').bootstrapValidator({
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
			var formData = new FormData(document.getElementById("frmemailprovidersetup"));	
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_email_provider_add",
				type:"post",
				cache: false,
		        contentType: false,
		        processData: false,
		        data: formData,
				success:function(response)
				{  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == "Error")
						{
							toastr.error('Duplicate entry of Provider .Try a new one!!!');
							$('#emailProvidersetupModal').modal('show');
							$('#txtproviderEmail').focus();
							$('#txtproviderEmail').val("");
					 		$('#frmemailprovidersetup').data('bootstrapValidator').updateStatus('txtproviderEmail', 'NOT_VALIDATED', null).validateField('txtproviderEmail');						
							
							return false;
						}
						else if(obj.status == true)
						{
							toastr.success(obj.msg);
							var dtblprovidersetup = $("#tblemailprovidersetup").DataTable();
				 			dtblprovidersetup.ajax.reload();
				 			$('#frmemailprovidersetup').data('bootstrapValidator').resetForm(true);	
							$('#errorlog_email_provider').html("");
		                	$('#errorlog_email_provider').hide();
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_email_provider').html(obj.msg);
		                	$('#errorlog_email_provider').show();
		                }
						else 
						{
							sweetAlert("Email Provider",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}		 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields: {			
			
			txtemailID:{
				validators: {
					notEmpty: {
						message: 'Enter Email ID'
					},
					emailAddress: {
						message: 'The input is not a valid email address'
					}
				}
			},
			txtmailpassword:{
				validators: {
					notEmpty: {
						message: 'Password is Required'
					}
				}
			},	
			txtMailPort:{
				validators: {
					notEmpty: {
						message: 'Mail Port is Required'
					},
					digits:{
						message: 'This field can contain only digits'
					}
				}
			},	
			txtHost:{
				validators: {
					notEmpty: {
						message: 'Host is Required'
					}
				}
			},
			txtSmtpauth:{
				validators: {
					notEmpty: {
						message: 'SMTP Auth is Required'
					}
				}
			},	
			txtSmtpsecure:{
				validators: {
					notEmpty: {
						message: 'SMTP Secure is Required'
					}
				}
			},		
			txtproviderEmail:{
				validators: {
					notEmpty: {
						message: 'Provider is Required'
					},
					regexp: {
								regexp: /^([A-Za-z0-9]+)$/i,
								message: "Special characters and space are not allowed"
							},
				}
			}
		}
	} );
	//EDIT RECORD WITH VALIDATION
	$('#frmemailprovidersetupEdit').bootstrapValidator({
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
			var formData = new FormData(document.getElementById("frmemailprovidersetupEdit"));	
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_email_provider_edit",
				type:"post",
				cache: false,
		        contentType: false,
		        processData: false,
		        data: formData,
				success:function(response)
				{  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							toastr.success(obj.msg);
							var dtblprovidersetup = $("#tblemailprovidersetup").DataTable();
				 			dtblprovidersetup.ajax.reload();
				 			$('#frmemailprovidersetupEdit').data('bootstrapValidator').resetForm(true);	
							$('#errorlog_email_provider_edit').html("");
		                	$('#errorlog_email_provider_edit').hide();
		                	$('#emailprovidersetupModalEdit').modal('hide');
		                	
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_email_provider_edit').html(obj.msg);
		                	$('#errorlog_email_provider_edit').show();
		                }
						else 
						{
							sweetAlert("SMS",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}		 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields: {			
			
			txtemailIDEdit:{
				validators: {
					notEmpty: {
						message: 'Enter Email ID'
					},
					emailAddress: {
						message: 'The input is not a valid email address'
					}
				}
			},
			txtmailpasswordEdit:{
				validators: {
					notEmpty: {
						message: 'Password is Required'
					}
				}
			},	
			txtMailPortEdit:{
				validators: {
					notEmpty: {
						message: 'Mail Port is Required'
					},
					digit:{
						message: 'This field can contain only digits'
					}
				}
			},	
			txtSmtpsecureEdit:{
				validators: {
					notEmpty: {
						message: 'SMTP Secure is Required'
					}
				}
			},	
			txtSmtpauthEdit:{
				validators: {
					notEmpty: {
						message: 'SMTP Auth is Required'
					}
				}
			},	
			txtMailHostEdit:{
				validators: {
					notEmpty: {
						message: 'Host is Required'
					}
				}
			},	
			txtMailProviderEdit:{
				validators: {
					notEmpty: {
						message: 'Provider is Required'
					},
					regexp: {
								regexp: /^([A-Za-z0-9]+)$/i,
								message: "Special characters and space are not allowed"
							},
				}
			}
		}
	} );
	//ADD RECORD WITH VALIDATION
	$('#frmemailsetup').bootstrapValidator({
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
			var formData = new FormData(document.getElementById("frmemailsetup"));	
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_email_add",
				type:"post",
				cache: false,
		        contentType: false,
		        processData: false,
		        data: formData,
				success:function(response)
				{  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == "Error")
						{
							toastr.error('Duplicate entry of Mail type .Try a new one!!!');
							$('#emailsetupModal').modal('show');
							$('#cmbMailType').focus();
							$('#cmbMailType').val("");
					 		$('#frmemailsetup').data('bootstrapValidator').updateStatus('cmbMailType', 'NOT_VALIDATED', null).validateField('cmbMailType');						
							
							return false;
						}
						else if(obj.status == true)
						{
							toastr.success(obj.msg);
							var dtblsmssetup = $("#tblemailsetup").DataTable();
				 			dtblsmssetup.ajax.reload();
				 			$('#frmemailsetup').data('bootstrapValidator').resetForm(true);	
							$('#errorlog_email').html("");
		                	$('#errorlog_email').hide();
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_email').html(obj.msg);
		                	$('#errorlog_email').show();
		                }
						else 
						{
							sweetAlert("Email",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}		 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields: {			
			cmbMailType:{
				validators: {
					notEmpty: {
						message: 'Mail Type is Required'
					}
				}
			},	
			txtSubject:{
				validators: {
					notEmpty: {
						message: 'Subject is Required'
					}
				}
			},
			txtContent:{
				validators: {
					notEmpty: {
						message: 'Content is Required'
					}
				}
			},		
			cmbEmailProvider:{
				validators: {
					notEmpty: {
						message: 'Email Provider is Required'
					}
				}
			},	
			cmbStatus:{
				validators: {
					notEmpty: {
						message: 'Status is Required'
					}
				}
			}
		}
	} );
	// edit record with validation for email setup
	$('#frmemailsetupEdit').bootstrapValidator({
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
			var formData = new FormData(document.getElementById("frmemailsetupEdit"));	
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/operation_email_edit",
				type:"post",
				cache: false,
		        contentType: false,
		        processData: false,
		        data: formData,
				success:function(response)
				{  
					try
					{
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							$('#emailsetupModalEdit').modal('hide');
							toastr.success(obj.msg);
							var dtblsmssetup = $("#tblemailsetup").DataTable();
				 			dtblsmssetup.ajax.reload();
				 			$('#frmemailsetupEdit').data('bootstrapValidator').resetForm(true);	
							$('#errorlog_email_edit').html("");
		                	$('#errorlog_email_edit').hide();
		                	$('#emailsetupModalEdit').modal('hide');
						}
						else if(obj.status === 'validationerror'){
		                	$('#errorlog_email_edit').html(obj.msg);
		                	$('#errorlog_email_edit').show();
		                }
						else 
						{
							sweetAlert("Email",obj.msg, "error");	
						}
					}
					catch(e)
					{
						sweetAlert("Sorry",'Unable to Save.Please Try Again !', "error");
					}		 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});
		},
		fields: {			
			cmbMailTypeEdit:{
				validators: {
					notEmpty: {
						message: 'Mail Type is Required'
					}
				}
			},
			cmbStatusEdit1:{
				validators: {
					notEmpty: {
						message: 'Status is Required'
					}
				}
			},	
			txtemailSubjectEdit:{
				validators: {
					notEmpty: {
						message: 'Subject is Required'
					}
				}
			},	
			txtemailContentEdit:{
				validators: {
					notEmpty: {
						message: 'Content is Required'
					}
				}
			},	
			cmbEmailProviderEdit:{
				validators: {
					notEmpty: {
						message: 'Email Provider is Required'
					}
				}
			},
			cmbStatusEdit:{
				validators: {
					notEmpty: {
						message: 'Status is Required'
					}
				}
			}
		}
	} );
	
	$('#cmbMailType').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				cmbMailType:$(event.target).val(),
				validateMailcode:true,
				//type:"CHKDUCPLICATE_INSTRUCTION"
			};
		   //ajax call to server
		   $.ajax({
					url:base_url+"ajax_controller/check_mailType",
					type:"post",
					data:institutedata,
					success:function(response){
						var res1 = JSON.parse(response);
						$.each(res1.aaData,function(i,data){
							if($(event.target).val() == data.email_type)
							{
								$(event.target).val("");
								$('#frmemailsetup').data('bootstrapValidator').updateStatus('cmbMailType', 'INVALID', null);
								//$('.duplication').modal('show');
								toastr.error('Mail type Already Used.');
								$(event.target).focus();
								
							}
						});	
					},  
					error:function(){
						toastr.error('Unable to process please contact support');
					}
				}); 
			
		}
	});
	$('#cmbMailTypeEdit').on("change",function(event)
	{
		if($(event.target).val() != "" && $(event.target).val() != undefined)
		{
			var institutedata=
			{
				cmbMailType:$(event.target).val(),
				validateMailcode:true,
				//type:"CHKDUCPLICATE_INSTRUCTION"
			};
		   //ajax call to server
		   $.ajax({
					url:base_url+"ajax_controller/check_mailType",
					type:"post",
					data:institutedata,
					success:function(response){
						var res1 = JSON.parse(response);
						$.each(res1.aaData,function(i,data){
							if($(event.target).val() == data.email_type)
							{
								$(event.target).val("");
								$('#frmemailsetupEdit').data('bootstrapValidator').updateStatus('cmbMailTypeEdit', 'INVALID', null);
								//$('.duplication').modal('show');
								toastr.error('Mail type Already Used.');
								$(event.target).focus();
								
							}
						});	
					},  
					error:function(){
						toastr.error('Unable to process please contact support');
					}
				}); 
			
		}
	}); 

	/* CODE FOR TOASTR */
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
	/* END OF CODE FOR TOASTR*/	
});
