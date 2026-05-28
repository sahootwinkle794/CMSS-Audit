$(document).ready(function()
{
	/*Program Group for Dropdown*/
	$.ajax({
		url:base_url+"/ajax_controller/get_program_group_sbi_applnts",
		type:"post",
		success:function(response){  
			var options = "<option value =''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value='"+data.program_group_name+"'>"+data.program_group_name+"</option>";
				
			});
			$('#cmbProgramGroup').html("");   //campusid from academicPeriod
			$('#cmbProgramGroup').append(options);
			var program_group = $("#cmbProgramGroup").val();
			if(program_group != '')
			{
				$("#labelType").show();
				$("#divType").show();
			}
			else
			{
				$("#labelType").hide();
				$("#divType").hide();
			}
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
	$('#cmbProgramGroup').change(function()
	{
		var program_group = $("#cmbProgramGroup").val();
		if(program_group != '')
		{
			var institutedata = {
				program_group: program_group
			};
			$.ajax({
				url:base_url+"/ajax_controller/get_program_sbi_applnts",
				type:"post",
				data:institutedata,
				success:function(response)
				{  
					var options = "<option value=''>Select Program</option>";					
					var res1 = JSON.parse(response);					
					$.each(res1.aaData,function(i,data)
					{
						options = options + "<option value="+data.program_code+">"+data.program_name+"</option>";
					});
					$('#cmbProgram').html("");   
					$('#cmbProgram').append(options);		
					
					
					$('#cmbProgram').change(function()
					{
						var program = $('#cmbProgram').val();	
						var data = {
							program:program
						};
						var applicantdetails = $('#applicationDetail').dataTable({
							"ajax":
							{
								"url": base_url+"/ajax_controller/get_applnt_details_sbi",
								"type": "POST",
								"data": data
							},  
							"bPaginate": true,
							"bDestroy": true,
					        "bLengthChange": true,
							"bStateSave": true,
					        "bFilter": true,
					        "bSort": false,
					        "bInfo": true,
					        "bAutoWidth":false,    
					        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6 ' >>><'col-xs-6'p>>",
						    "aoColumns": [    
					                       { "sName": "sl_no","sWidth": "5%" },
					                       { "sName": "name","sWidth": "15%" },
					                       { "sName": "mobile","sClass": "alignRight","sWidth": "10%","mRender": function( data, type, full ) {
						                    		return data+'<input type="hidden" id="reg_user_id" name="reg_user_id" value="'+data+'">';
					                       			var reg_user_id = $('#reg_user_id').val();
						               			} 
						               		},
					                       { "sName": "ref_no","sClass": "alignRight","sWidth": "15%"},
										   { "sName": "amount","sClass": "alignRight","sWidth": "10%"},
										   { "sName": "deposit_date","sWidth": "10%"},
										   { "sName": "bank_name","sWidth": "10%"},
										   { "sName": "branch_code","sWidth": "10%"},
										   { "sName": "challlan","data": null,"sClass": "alignCenter","sWidth": "5%", "sDefaultContent": "<button type='button' class='btn btn-warning  tooltipTable btn-circle' title='removeBtn' id = 'viewBtn' onclick='getValueImage(event);'><i class='fa fa-file-image-o'></i></button>"},
										   { "sName": "Action","data": null,"sClass": "alignCenter","sWidth": "10%", "sDefaultContent": "<button type='button' class='btn btn-warning  tooltipTable btn-circle' title='Verify' id = 'removeBtn' onclick='getValue(event);'><i class='fa fa-check'></i></button>&nbsp;<button type='button' class='btn btn-danger  tooltipTable btn-circle' title='Reject' id = 'rejectBtn' onclick='getValueReject(event);'><i class='fa fa-close'></i></button>"}
					              	     ]          
						});
					});
				},
				error:function()
				{
					alert("We are unable to Process.Please contact Support");
				}
			});
		}
	});
	
	
});
function getValueImage(event){
	var oTable = $('#applicationDetail').dataTable();
	var row;
	//alert(event.target.tagName);
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	else
  		row = event.target.parentNode;
  	var challan_path = oTable.fnGetData(row)['challan_path'];//GETTING DATA FOR HIDDEN COLUMN
  	window.open(challan_path,'_blank');
}
function getValue(event)
{
	var oTable = $('#applicationDetail').dataTable();
	var row;
	//alert(event.target.tagName);
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	else
  		row = event.target.parentNode;
  	var reg_user_id = oTable.fnGetData(row)['reg_user_id'];//GETTING DATA FOR HIDDEN COLUMN
  	var institutedata={
		reg_user_id:reg_user_id
	};
  	$.ajax({
		url:base_url+"/ajax_controller/get_verify_sbi_applnts",
		type:"post",
		data:institutedata,
		success:function(response){ 
			var res = JSON.parse(response); 
			toastr.success("Successfully Verified");
			var oTable = $('#applicationDetail').dataTable();
			oTable.api().ajax.reload();	
		},
		error:function(){
			toastr.error('Unable to process please contact support');
		}
	});
	$('#removeid').val(reg_user_id);
	//return true;
}
function getValueReject(event){
	var oTable = $('#applicationDetail').dataTable();
	var row;
	//alert(event.target.tagName);
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	else
  		row = event.target.parentNode;
  	var reg_user_id = oTable.fnGetData(row)['reg_user_id'];//GETTING DATA FOR HIDDEN COLUMN
  	var program_code = oTable.fnGetData(row)['applied_program'];//GETTING DATA FOR HIDDEN COLUMN
  	//alert(reg_user_id+'#'+program_code);
  	$('#hidRegUserId').val(reg_user_id);
  	$('#hidProgram').val(program_code);
  	$('#taRemark').val('');
  	$('#applicantDisqualifyModal').modal('show');
}
$('#applicantDisqualify').click(function(){
	taRemark = $('#taRemark').val();
	if(taRemark!=''){
		institutedata={  
			hidRegUserId:$('#hidRegUserId').val(),
			hidProgram:$('#hidProgram').val(),
			taRemark:$('#taRemark').val(),
		}
		$.ajax({
			url:base_url+"/ajax_controller/get_reject_sbi_applnts",
			type:"post",
			data:institutedata,
			success:function(response){ 
				var res = JSON.parse(response); 
				toastr.success("Successfully Rejected");
				var oTable = $('#applicationDetail').dataTable();
				oTable.api().ajax.reload();	
				$('#applicantDisqualifyModal').modal('hide');
			},
			error:function(){
				toastr.error('Unable to process please contact support');
			}
		});
	}else{
		toastr.error("Please give your Remark");
	}
	
});