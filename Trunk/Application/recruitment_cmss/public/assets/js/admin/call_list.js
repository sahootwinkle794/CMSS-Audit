marit_list();
$.ajax({
	url:base_url+"/ajax_controller/get_program_group_scrutiny_applnts",
	type:"post",
	success:function(response){  
		var options = "<option value =''>Select</option>";
		var res1 = JSON.parse(response);
		$.each(res1.aaData,function(i,data){
			options = options + "<option value='"+data.program_group+"'>"+data.program_group+"</option>";
			
		});
		$('#cmbProgramGroup').html("");   //campusid from academicPeriod
		$('#cmbProgramGroup').append(options);
	},
	error:function(){
		toastr.error("We are unable to Process.Please contact Support");
	}
});
$('#cmbProgramGroup').change(function (event)
{
	if($(event.target).val() != "" && $(event.target).val() != undefined)
	{
		$("#divProcessing").show();
		/*Program for Dropdown*/
		var institutedata = {
			program_group:$('#cmbProgramGroup').val()
		};
		$.ajax({
			url:base_url+"/ajax_controller/get_program_scrutiny_applnts",
			type:"post",
			data:institutedata,
			success:function(response){  
				var options = "<option value =''>Select</option>";
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data){
					options = options + "<option value="+data.program_code+">"+data.program_name+"</option>";
					
				});
				$('#cmbProgram').html("");   //campusid from academicPeriod
				$('#cmbProgram').append(options);
				$("#divProcessing").hide();
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
				$("#divProcessing").hide();
			}
		});
	}
	else
	{
		$("#divProcessing").show();
		$('#cmbProgram').html("");   //campusid from academicPeriod
		$('#cmbProgram').append("<option value =''>Select</option>");
		$("#divProcessing").hide();
	}
});
$('#btnGenerateReport').click(function(){
	marit_list();
});
function marit_list(){
	admcode=$('#cmbProgram').val();
	cmbProgramGroup=$('#cmbProgramGroup').val();
	var tblCallList = $('#tblCallList').dataTable({
	"ajax":
		{
			"url": base_url+"/ajax_controller/get_call_list",
			"type": "POST",
			"data":  {
				applied_program:admcode,
				program_group:cmbProgramGroup
				
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
        "dom": 'Bfrtip',
        "buttons": [
            	{
	            	extend: 'excel',
	                text: '<i class="fa fa-file-excel-o">&nbsp;Excel</i>',
	                tag: 'button',
	                className: 'btn btn-success excelClass',
	                title:'Call List-2018',
	                filename:'Call List-2018'
                }
       ],
	    "aoColumns": [    
           { "sName": "sl_no"},
           { "sName": "reg_user_id"},
           { "sName": "program_name"},
           { "sName": "downloaded_date" }
        ]
	});
}
