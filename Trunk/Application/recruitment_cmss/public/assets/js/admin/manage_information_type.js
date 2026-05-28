$(document).ready(function()
{
	information_type_menu();
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

function information_type_menu(){
	
	var applicantdetails = $('#tblmenu').dataTable({
		"ajax":
		{
			"url": base_url+"/ajax_controller/get_information_type_menu",
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
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6 btnfaq' >>><'col-xs-6'p>>",
		
	    "aoColumns": [    
	    	{ "sName": "sl_no","sClass":"alignCenter","sWidth": "10%" },
	    	{ "sName": "id","visible":false},
		    { "sName": "Menu Name","sWidth": "30%"},
		     { "sName": "record status","sWidth": "8%","sClass":"alignCenter",
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
			{"sName": "default","sWidth": "15%", "sClass":"alignCenter", "sDefaultContent": "<button type='button' id='btnEdit' class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='edit_information_type_menu(event)' title='Edit' ><i class='fa fa-edit'></i></button>"}
		   
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
	$("div.btnfaq").html('<button type="button" id="btnAdd" onclick="add_right_menu()" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
						
}

$('#menuForm').bootstrapValidator({
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
		var formData = new FormData(document.getElementById("menuForm"));
		//console.log(formData);return;
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/operation_information_type_menu",
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
					//alert(obj);return;
					if(obj.status == true)
					{
						toastr.success(obj.msg);
						var tblmenu = $("#tblmenu").DataTable();
			 			var isDelete= false;
						tblmenu.ajax.reload();	
			 			$('#menuForm').data('bootstrapValidator').resetForm(true);
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
						sweetAlert("Right Menu",obj.msg, "error");	
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
        /*txtUrl: {
            validators: {
                notEmpty: {
                    message: 'Required'
                }
            }
        },*/
        cmbRecordStatus: {
            validators: {
                notEmpty: {
                    message: 'Required'
                }
            }
        },
        
       
	}	
});

function edit_information_type_menu(event)
{
	$('#menuForm').data('bootstrapValidator').resetForm(true);
	var oTable = $('#tblmenu').dataTable();						
	$(oTable.fnSettings().aoData).each(function (){
		$(this.nTr).removeClass('success');
	});
	var row;

	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	$('#editModal').modal('show');
  	$('#hidOperType').val('edit_information_type_menu');
	$(row).addClass('success');
	var page_url = oTable.fnGetData( row )['page_url'];
	var id = oTable.fnGetData( row )['menu_code'];
	var menu_name = oTable.fnGetData( row )['menu_name'];
	var selectedText3 = oTable.fnGetData( row )['record_status'];
	//alert(selectedText3);
	document.getElementById('txtMenu').value=menu_name;
	//document.getElementById('txtUrl').value=page_url;
	
	$("#cmbRecordStatus").val(selectedText3);
	$('#hidid').val(id);
	$("#myModalLabelHeader").html("Update Information Type");
}

function add_right_menu(){

	$('#menuForm').data('bootstrapValidator').resetForm(true);
	$("#hidOperType").val("add_information_type_menu");
	$('#editModal').modal('show');
	$("#myModalLabelHeader").html("Add Information Type");
}
	
   