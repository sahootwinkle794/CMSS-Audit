$(document).ready(function(){
	var ApplicationDetail = $('#dtblApplicationDetail').dataTable({
		"bPaginate": false,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bDestroy" : true,
        "bAutoWidth": true,
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-5' B>>><'col-xs-3'p>>",
		"aoColumns": [
			{ "sName": "sl_no","sWidth": "5%"},
			/*{ "sName": "program_code","bVisible": false},*/
			{ "sName": "program_name"},
			/*{ "sName": "exam_vanue_code","bVisible": false},*/
			{ "sName": "exam_vanue"},
			{ "sName": "code","bVisible": false},
			{ "sName": "name"}
	            
		],
		buttons: [{
			extend: 'excelHtml5',
			text: '<button class="btn btn-success" title = "Export"><i class="fa fa-file-excel-o" style="color:white"></i> Export to Excel</button>',
			filename:'Manage Registration',
			header:true,
			title:'Manage Registration',
		}],

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
	$.ajax({
		url:base_url+"/ajax_controller/get_program_table_data",
		type:"post",
		data:'',
		success:function(response)
		{  
			var options = "<option value =''>Select Post</option>";					
			var res1 = JSON.parse(response);					
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value="+data.program_code+">"+data.program_name+"</option>";
			});
			$('#cmbProgram').html("");  
			$('#cmbProgram').append(options);   
			
		},
		error:function()
		{
			alert("We are unable to Process.Please contact Support");
		}
	});
	
	
	$("#cmbProgram").change(function(){
		var institutedata=
		{
			post_code:$('#cmbProgram').val()
		};
		var ApplicationDetail = $('#dtblApplicationDetail').dataTable({
			"ajax":
			{
				"url": base_url+"/ajax_controller/get_InvigilatorVenueData",
				"type": "POST",
				"data": institutedata
			}, 
			"bPaginate": false,
	        "bLengthChange": true,
	        "bFilter": true,
	        "bSort": true,
	        "bInfo": true,
	        "bDestroy" : true,
	        "bAutoWidth": true,
			"sDom":"<'row'<'col-xs-4'B><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-5' i>>><'col-xs-3'p>>",
			"aoColumns": [
							{ "sName": "sl_no","sWidth": "5%"},
							/*{ "sName": "program_code","bVisible": false},*/
							{ "sName": "program_name"},
							/*{ "sName": "exam_vanue_code","bVisible": false},*/
							{ "sName": "exam_vanue"},
							{ "sName": "code","bVisible": false},
							{ "sName": "name"}
				            
	        			],
		buttons: [{
			extend: 'excelHtml5',
			text: '<button class="btn btn-success" title = "Export"><i class="fa fa-file-excel-o" style="color:white"></i> Export to Excel</button>',
			filename:'Manage Registration',
			header:true,
			title:'Manage Registration',
		}],

        "fnDrawCallback": function(oSettings, json) {
     		$('.tooltipTable').tooltipster( {
	         	theme: 'tooltipster-punk',
	      		animation: 'grow',
	        	delay: 200, 
	         	touchDevices: false,
	         	trigger: 'hover'
      		});          
  		}   
	});});	
	
	$("#btnRandomize").click(function(){
		if($("#cmbProgram").val() == '')
		{
			toastr.error("Please select a Post");
		}
		else if($("#txtNoOfInvi").val() == '')
		{
			toastr.error("Please enter number of invigilators per venue");
		}
		else
		{
			var institutedata=
			{
				post_code:$('#cmbProgram').val(),
				no_of_invi:$('#txtNoOfInvi').val()
			};
			$.ajax({
				url:base_url+"/ajax_controller/randomize_invigilators",
				type:"post",
				data:institutedata,
				success:function(response)
				{  				
					var res1 = JSON.parse(response);	
					if(res1.status == true)
					{
						toastr.success(res1.msg);
						var dtblApplicationDetail = $("#dtblApplicationDetail").DataTable();
		 				dtblApplicationDetail.ajax.reload();
					}
					else
					{
						toastr.error(res1.msg);
						var dtblApplicationDetail = $("#dtblApplicationDetail").DataTable();
		 				dtblApplicationDetail.ajax.reload();
					}
				},
				error:function()
				{
					alert("We are unable to Process.Please contact Support");
				}
			});
		}
	});
	
});