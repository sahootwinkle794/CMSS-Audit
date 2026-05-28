$.ajax({
	url:base_url+"ajax_controller/select_program_data_manage_app", 
	type:"post",
	success:function(response)
	{  
		var options = "<option value=''>Select</option>";					
		var res1 = JSON.parse(response);					
		$.each(res1.aaData,function(i,data)
		{
			options = options + "<option value='"+data.program_group_name+"'>"+data.program_group_name+"</option>";
		});
		$('#cmbProgramGroup').html("");   
		$('#cmbProgramGroup').append(options);
	},
	error:function()
	{
		toastr.error("We are unable to Process.Please contact Support");
	}
});
$('#cmbProgramGroup').change(function()
{
	var program_group = $("#cmbProgramGroup").val();
	var institutedata = {
		program_group:program_group,
	};
	$.ajax({
		url:base_url+"/ajax_controller/select_program_manage_app",
		type:"post",
		data:institutedata,
		success:function(response)
		{  
			var options = "<option value =''>Select Post</option>";					
			var res1 = JSON.parse(response);					
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value="+data.program_code+">"+data.program_name+"</option>";
			});
			//var opt = "<option value =''>Select Program</option>";
			$('#cmbProgram').html("");   //campusid from academicPeriod
			$('#cmbProgram').append(options);  
			
		},
		error:function()
		{
			alert("We are unable to Process.Please contact Support");
		}
	});
});
$('#cmbProgram').change(function(){
	cmbProgram = $('#cmbProgram').val();
	if(cmbProgram!=''){
		
		var institutedata = {
			program_code : cmbProgram
		}
		$.ajax({
			url:base_url+"/ajax_controller/get_round_no",
			type:"post",
			data:institutedata,
			success:function(response)
			{  
				var options = "<option value =''>Select Round</option>";					
				var res1 = JSON.parse(response);					
				$.each(res1.aaData,function(i,data)
				{
					options = options + "<option value='"+data.round_no+"'>"+data.round_no+"</option>";
				});
				$('#cmbRound').html("");   
				$('#cmbRound').append(options);
			},
			error:function()
			{
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
		
	}else{
		toastr.error("Please Select program");
	}
	
});
$('#cmbRound').change(function(){
	doc_download();
});
function doc_download(){
	var cmbProgram = $('#cmbProgram').val();
	var program_group = $("#cmbProgramGroup").val();
	var round_data = $("#cmbRound").val();
	var tblDocDown = $('#tblDocDown').dataTable({
	"ajax":
		{
			"url": base_url+"/ajax_controller/get_doc_down_list",
			"type": "POST",
			"data":  {
				cmbProgram:cmbProgram,
				round_data:round_data,
				program_group:program_group
			},
		},  
		"bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
		"bDestroy":true,
        "bAutoWidth":false, 
        "scrollX":true,
        //"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutegroupbutton' >>><'col-xs-6'p>>",
        /*"dom": 'Bfrtip',
        "buttons": [
            	{
	            	extend: 'excel',
	                text: '<i class="fa fa-file-excel-o">&nbsp;Excel</i>',
	                tag: 'button',
	                className: 'btn btn-success excelClass',
	                title:'Document Download',
	                filename:'Call List-2018'
                }
       ],*/
	    "aoColumns": [    
           { "sName": "sl_no"},
           { "sName": "name"},
           { "sName": "roll_no"},
           { "sName": "mob_no"},
           { "sName": "secured_mark"},
           { "sName": "appl_no", "visible":false},
           { "sName": "applied_program", "visible":false},
           { "sName": "view_doc","data":null,"sWidth": "11%","sClass":"alignCenter", "sDefaultContent": "<button type='button' id='btnView' class='btn btn-success btn-sm btn-circle tooltipTable' onclick='view_doc1(event)' title='Download'><i class='fa fa-eye' style='color:white'></i></button>"},
           { "sName": "download_doc","data":null,"sWidth": "11%","sClass":"alignCenter", "sDefaultContent": "<button type='button' id='btnDownload' class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='download_doc(event)' title='Remark' ><i class='fa fa-download' style='color:white'></i></button>"}
        ]
	});
}

function view_doc1(event)
{
	var oTable = $('#tblDocDown').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});		
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	var appl_no = oTable.fnGetData( row )['appl_no'];
	var program = oTable.fnGetData( row )['program']; //alert(appl_no);return;
	window.open(base_url+"admin/view_document/"+appl_no+"/"+program);
}

function download_doc(event)
{
	var oTable = $('#tblDocDown').dataTable();		
	$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});		
	var row;
	if(event.target.tagName == "BUTTON")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	var appl_no = oTable.fnGetData( row )['appl_no'];
	var program = oTable.fnGetData( row )['program']; //alert(appl_no);return;
	window.open(base_url+"admin/zip_doc/"+appl_no+"/"+program);
}