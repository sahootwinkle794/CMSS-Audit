marit_list();

/*Program Group for Dropdown*/
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
	var tblMaritList = $('#tblMaritList').dataTable({
	"ajax":
		{
			"url": base_url+"/ajax_controller/get_rank_data",
			"type": "POST",
			"data":  {
				applied_program:admcode
				
			},
		},  
		"bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
		"bDestroy":true,
        "bAutoWidth":true, 
        "scrollX":true,
        //"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutegroupbutton' >>><'col-xs-6'p>>",
        "dom": 'Bfrtip',
        "buttons": [
            	{
	            	extend: 'excel',
	                text: '<i class="fa fa-file-excel-o">&nbsp;Excel</i>',
	                tag: 'button',
	                className: 'btn btn-success excelClass',
	                title:'Marit List-2018',
	                filename:'Marit List-2018'
                }
       ],
	    "aoColumns": [    
           { "sName": "sl_no"},
           { "sName": "full_name"},
           { "sName": "jee_rankno"},
           { "sName": "program" },
           { "sName": "mark_obtained"},
           { "sName": "applicant_status" },
           { "sName": "rank_sc"},
           { "sName": "rank_st"},
           { "sName": "rank_obc"},
           { "sName": "rank_ph"},
           { "sName": "rank_gen"},
           { "sName": "1st_center" },
           { "sName": "2nd_center" },
           { "sName": "3rd_center" },
           { "sName": "state" },
           { "sName": "reg_user_id" },
           { "sName": "counselling_letter", "sClass":"alignCenter", "mRender":function(data,type,full){
	           		if(full['applicant_status']=='SL'){
						return "<button  type = 'button' class='btn btn-success btn-sm btn-circle tooltipTable' onclick='print_rank_card(event)' title='Rank Card' ><i class='fa fa-download'></i></button>";
					}else{
						return "<button  type = 'button' class='btn btn-success btn-sm btn-circle tooltipTable'  title='Rank Card' disabled><i class='fa fa-download'></i></button>";
					}
		   		}
		   },
		   { "sName": "yes_no", "sClass":"alignCenter", "data":null,"sDefaultContent": "<span></span>"}
        ]
	});
}
function print_rank_card(event){		
	var oTable = $('#tblMaritList').dataTable();				
	$(oTable.fnSettings().aoData).each(function (){
		$(this.nTr).removeClass('success');
	});
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
	$(row).addClass('success');
	var applied_program = oTable.fnGetData( row )['applied_program'];
	
	var reg_user_id = oTable.fnGetData( row )['reg_user_id'];
	var URL = base_url+'mpdf_controller/rank_card/app_prog/'+applied_program+'/reg_user_id/'+reg_user_id ;
	var strWindowFeatures = "location=yes,height=825,width=1500,scrollbars=yes,status=yes";
	window.open(URL, "_blank", strWindowFeatures);
}
