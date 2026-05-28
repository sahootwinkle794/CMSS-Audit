$(document).ready(function()
{
	var oTable;
	var session = $("#hidSession").val();
	//alert(session);
	
	var today = '';
	var paymentdetails = $('#dtblOnlinePayments').dataTable({
		//"responsive": true,
		"sAjaxSource": base_url+"ajax_controller/select_payment_verification",
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth":true,    
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutegroupbutton' >>><'col-xs-6'p>>",
	    "aoColumns": [    
                       { "sName": "sl_no","sWidth": "5%" },
					   { "sName": "institute_code","bVisible":false},
                       { "sName": "institute_name","sWidth": "30%" },
					   { "sName": "Total Success Payment","sWidth": "20%"},
					   { "sName": "Total Payment Gateway Amount","sWidth": "20%"},
					   { "sName": "Payment Amount","sWidth": "20%"},
					   {"sName": "default","sWidth": "20%", "sDefaultContent":" <button type='button' class='btn btn-info' align='center' onclick='paymentDetails(event);' title='Show Payments'>Show</button>"}
              	     ]          
	});
	var date = $("#txtDateFilter").val();
	var date = date.split('-').join('/');
	//alert(date);
	var d = new Date(date);
	
	var date = d.getDate();
	//alert(date);
	var month =  d.getMonth();
	month += 1;  
	var y = d.getFullYear();
	var date=(y+ "-" + date + "-" + month );
	//var date = date.split('-').join('-');
	var data = {
		date:date
	};
	var pgReport = $('#dtblPgReport').dataTable({
	//"responsive": true,
		"ajax":
		{
			"url": base_url+"ajax_controller/select_pg_report",
			"type": "POST",
			"data": data,
		}, 
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth":true,   
		"bDestroy" : true, 
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutegroupbutton1' >>><'col-xs-6'p>>",
	    "aoColumns": [    
                       { "sName": "sl_no" },
					   { "sName": "order_id"},
                       { "sName": "transaction_id" },
                       { "sName": "transaction_date" },
                       { "sName": "payment_date" },
                       { "sName": "customer_details" },
                       { "sName": "bank_transaction_id","bVisible":false },
                       { "sName": "gross_amount" },
                       { "sName": "payment_gateway_charge" },
                       { "sName": "net_amount" },
                       { "sName": "bank_name" },
                       { "sName": "transaction_status" },
                       { "sName": "merchant_name","bVisible":false },
                       { "sName": "payment_remark","bVisible":false },
                       { "sName": "refund_date" },
                       { "sName": "refund_status" },
                       { "sName": "refund_amount" }
          	     ]          
	});
	if(today != '')
	{
		var institutedata=
		{
			date:today
		};	
		$.ajax({
			url:base_url+"ajax_controller/select_pg_report",
			type:"post",
			data:institutedata,
			success:function(response)
			{  				
				var res1 = JSON.parse(response);					
				var table = $('#dtblPgReport').DataTable();
				table.clear().draw();
				table.rows.add(res1.aaData).draw();	
				//load_table(institute,session);
				//$("#UserProgramEditModal").modal('show');
			},
			error:function()
			{
				toastr.error("We are unable to Process.Please contact Support");
			}
		});	
	}

	$('#btnUploadReport').click(function(){
		//alert("hello");
		w = window.open(base_url+"superadmin/upload_payment_report","winreport","status=0, menubar=0, scrollbars=1, resizable=1, width=980, height=600");
		w.focus();
	});
	$('#txtDateFilter').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
    }).datepicker('setEndDate', new Date());
	$('#txtDateFilter').change(function(){
		date = $("#txtDateFilter").val();
		if(date != '')
		{
			var date = $("#txtDateFilter").val();
			//var date = date.split('/').join('-');
			var d = new Date(date);
			var date = d.getDate();
			var month =  d.getMonth();
			month += 1;  
			var y = d.getFullYear();
			var date=(y+ "-" + month + "-" + date);
			var data = {
				date:date
			};
					var pgReport = $('#dtblPgReport').dataTable({
					//"responsive": true,
						"ajax":
						{
							"url": base_url+"ajax_controller/select_pg_report",
							"type": "POST",
							"data": data,
						}, 
						"bPaginate": true,
				        "bLengthChange": true,
				        "bFilter": true,
				        "bSort": true,
				        "bInfo": true,
				        "bAutoWidth":true,   
						"bDestroy" : true, 
				        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutegroupbutton1' >>><'col-xs-6'p>>",
					    "aoColumns": [    
				                       { "sName": "sl_no" },
									   { "sName": "order_id"},
				                       { "sName": "transaction_id" },
				                       { "sName": "transaction_date" },
				                       { "sName": "payment_date" },
				                       { "sName": "customer_details" },
				                       { "sName": "bank_transaction_id","bVisible":false },
				                       { "sName": "gross_amount" },
				                       { "sName": "payment_gateway_charge" },
				                       { "sName": "net_amount" },
				                       { "sName": "bank_name" },
				                       { "sName": "transaction_status" },
				                       { "sName": "merchant_name","bVisible":false },
				                       { "sName": "payment_remark","bVisible":false },
				                       { "sName": "refund_date" },
				                       { "sName": "refund_status" },
				                       { "sName": "refund_amount" }
			              	     ]          
					});

			$('#btnUploadReport').click(function(){
				//alert("hello");
				w = window.open(base_url+"superadmin/upload_payment_report","winreport","status=0, menubar=0, scrollbars=1, resizable=1, width=980, height=600");
				w.focus();
			});
		}
		
	});
});
function tablereloadfunction()
{
	var pgReport = $('#dtblPgReport').dataTable();
	pgReport.ajax.reload();
}

window.tablereloadfunction = function(){
var pgReport = $('#dtblPgReport').DataTable();
pgReport.destroy();
var today = $("#txtDateFilter").val();
var date = $("#txtDateFilter").val();
//var date = date.split('/').join('-');
var d = new Date(date);
var date = d.getDate();
var month =  d.getMonth();
month += 1;  
var y = d.getFullYear();
var date=(y+ "-" + month + "-" + date);

var data = {
	date:date
};
	var pgReport = $('#dtblPgReport').dataTable({
	//"responsive": true,
		"ajax":
		{
			"url": base_url+"ajax_controller/select_pg_report",
			"type": "POST",
			"data": data,
		}, /*
 var pgReport = $('#dtblPgReport').dataTable({
		"responsive": true,
		"sAjaxSource": "db_payment_verification.php?type=SELECT_PG_REPORT&date="+today,*/
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth":true,   
		"bDestroy" : true, 
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutegroupbutton1' >>><'col-xs-6'p>>",
	    "aoColumns": [    
                       { "sName": "sl_no" },
					   { "sName": "order_id"},
                       { "sName": "transaction_id" },
                       { "sName": "transaction_date" },
                       { "sName": "payment_date" },
                       { "sName": "customer_details" },
                       { "sName": "bank_transaction_id","bVisible":false },
                       { "sName": "gross_amount" },
                       { "sName": "payment_gateway_charge" },
                       { "sName": "net_amount" },
                       { "sName": "bank_name" },
                       { "sName": "transaction_status" },
                       { "sName": "merchant_name","bVisible":false },
                       { "sName": "payment_remark","bVisible":false },
                       { "sName": "refund_date" },
                       { "sName": "refund_status" },
                       { "sName": "refund_amount" }
              	     ]          
	});
	$("div.institutegroupbutton1").html('<div class="btngroup"><button id="btnUploadReport" class="btn btn-info custombtn" onclick = "openWindow()"><i class="fa fa-upload"></i> Upload</button></div>');

}
function openWindow()
{
        var session = $("#hidSession").val();
		//alert("hello");
		w = window.open("upload_payment_report.php?_s="+session,"winreport","status=0, menubar=0, scrollbars=1, resizable=1, width=980, height=600");
		w.focus();
}
function paymentDetails(event)
{
	var oTable = $('#dtblOnlinePayments').dataTable();			
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});	
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	var institute_code = oTable.fnGetData( row )[1];
	window.open("online_payment_details/"+institute_code).focus();
}


