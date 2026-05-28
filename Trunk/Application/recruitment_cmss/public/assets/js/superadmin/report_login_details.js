$(document).ready(function(){
	$('#txtLoginDate').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
		endDate:"+0d"
    });
    var tbLoginDetails = $('#tbLoginDetails').dataTable({
			"ajax":
			{
				"url": base_url+"ajax_controller/get_login",
				"type": "POST",
				
			},
			"bPaginate": true,
	        "bLengthChange": true,
	        "bFilter": true,
	        "bSort":true,
	        "bInfo": true,
	        "bDestroy":true,
	        "bAutoWidth": false, 
	        //"bRetrieve": true,
			//"sDom":"<'row'<'col-xs-4 B'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6' i>>><'col-xs-6'p>>",
			"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>>rtBp",
			//"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addbuttonResource' >>><'col-xs-6'p>>",  
			//"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 B' >>><'col-xs-6'p>>",  
	   
	        "buttons": [
	            	{
		            	extend: 'excel',
		                text: '<i class="fa fa-file-excel-o"></i>&nbsp;Export to Excel ',
		                tag: 'button',
		                className: 'btn btn-success excelClass',
		                filename:'All Login Details',
		                title:'Details'
	                }
	       ],
			"aoColumns": [
							{ "sName": "Sl_No","sWidth": "5%"},
							{ "sName": "login_id","sWidth": "10%" },
							{ "sName": "ip_address","sWidth": "10%" },            
	                     	{ "sName": "login_role","sWidth": "10%" },            
	                     	{ "sName": "created_on","sWidth": "10%" }
	        ],
	       
		});
	$('#txtLoginDate').change(function(){
    	rr = $('#txtLoginDate').val();
		//alert(rr);return;			
        $('#tbLoginDetails').DataTable({
	        "ajax":
	            {
	                "url": base_url+"ajax_controller/get_login",
	                "type": "POST",

	                "data": {
	                    txtLoginDate:rr
	                }
	            },
	            "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>>rtBp",
	            "buttons": [
            	{
	            	extend: 'excel',
	                text: '<i class="fa fa-file-excel-o"></i>&nbsp;Excel Export',
	                tag: 'button',
	                className: 'btn btn-success excelClass',
	                filename:'All Applicant Details',
	                title:'Details'
                }
   				],
	        	"destroy" : true
	    }).ajax.reload();	
    });
});