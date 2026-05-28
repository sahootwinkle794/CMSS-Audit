$(document).ready(function(){
	$('#txtTransDate').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
		endDate:"+0d"
    });
    
   
	var tbAdmin = $('#tbAdmin').dataTable({
		"ajax":
		{
			"url": base_url+"ajax_controller/get_admin_details",
			"type": "POST",
			
		},
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort":true,
        "bInfo": true,
        "bDestroy":true,
        "bAutoWidth": false, 
        "bRetrieve": true,
	   	"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>>rtBp",
		
        "buttons": [
            	{
	            	extend: 'excel',
	                text: '<i class="fa fa-file-excel-o"></i>&nbsp;Excel Export',
	                tag: 'button',
	                className: 'btn btn-success excelClass',
	                filename:'All Admin Details',
	                title:'Details'
                }
       ],
		"aoColumns": [
						{ "sName": "Sl_No","sWidth": "5%"},
						{ "sName": "Admin_name","sWidth": "10%" },
                     	{ "sName": "Admin_Id","sWidth": "10%" },
						{ "sName": "Role","sWidth": "10%" },            
                     	{ "sName": "Institute_Name","sWidth": "20%" }
        ],
       
	});
	
	var tbApplicants = $('#tbApplicants').dataTable({
		"ajax":
		{
			"url": base_url+"ajax_controller/get_applicant_details",
			"type": "POST",
			
		},
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort":true,
        "bInfo": true,
        "bDestroy":true,
        "bAutoWidth": false, 
        "bRetrieve": true,
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
		"aoColumns": [
						{ "sName": "Sl No","sWidth": "5%"},
						{ "sName": "reg_user_id","sWidth": "10%" },
                     	{ "sName": "applied_prog","sWidth": "20%" },
						{ "sName": "prog_name","sWidth": "10%" },            
                     	{ "sName": "full_name","sWidth": "10%" },
                     	{ "sName": "gender","sWidth": "10%" },
                     	{ "sName": "inst_code","sWidth": "10%" },
                     	{ "sName": "institute_name","sWidth": "10%" },
                     	{ "sName": "appl_status","sWidth": "15%" }
        ],
       
	});
	
    $('#cmbInstitute').change(function(){
    	rr = $('#cmbInstitute').val();
					
        $('#tbApplicants').DataTable({
	        "ajax":
	            {
	                "url": base_url+"ajax_controller/get_applicant_details",
	                "type": "POST",

	                "data": {
	                    cmbInstitute:rr
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