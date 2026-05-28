$(document).ready(function(){
	var isDelete= false;
	var isEdit = false;
	var isPublish = false;
	var oTable;
	var isArchive = false;
	var session = $('#hidSessionCode').val();
	
	var programAdditional = $('#tblProgramAdditional').dataTable({
		"ajax":
		{
			"url": base_url+"ajax_controller/get_program_advertisement_data",
			"type": "POST",
			"data": ''
		},
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bDestroy":true,
        "bInfo": true,
        "bAutoWidth": false,
		/*"sDom":"<'row'<'col-xs-4 addAdditionalbtn'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-9' <'row'<'col-xs-7'> <'col-xs-5' i>>><'col-xs-3'p>>",*/
		"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addAdditionalbtn' >>><'col-xs-6'p>>", 
		"aoColumns": [
						{ "sName": "#", "sWidth": "5%" },
						// { "sName": "program_code", "bVisible":false },
						{ "sName": "program_group", "sWidth": "20%" },
						{ "sName": "advtn_seq_no", "sWidth": "20%"  },
						{ "sName": "advt_no","sWidth": "20%"  },
						{ "sName": "advt_date","sWidth": "15%"  },
						{ "sName": "advt_id", "bVisible":false },
						{ "sName": "Action","sClass": "alignCenter","mRender": function( data, type, full )
							{
								return "<button class='btn btn-warning  tooltipTable btn-circle' title='Edit' id = 'btnEditProgram' onclick='edit(event);'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<button id='btnDeleteAdvt' title='Delete' class='btn btn-danger tooltipTable btn-circle' onclick='deleteRow(event);'><i class='fa fa-trash-o' aria-hidden='true'></i></button>&nbsp;&nbsp;<a href="+data+" target='_blank'><button class='btn btn-info tooltipTable btn-circle' title='PDF' id='btnEditAdditional'><i class='fa fa-file-pdf-o' aria-hidden='true'></i></button></a>"
							}
						},
        ],
        "fnDrawCallback": function(oSettings, json) 
       	{
     		$('.tooltipTable').tooltipster( {
	         	theme: 'tooltipster-punk',
	      		animation: 'grow',
	        	delay: 200, 
	         	touchDevices: false,
	         	trigger: 'hover'
      		} );          
  		}
	});
	$("div.addAdditionalbtn").html('<button id="btnAddAdditional" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');
	/*$("div.addAdditionalbtn").html('<button class="btn btn-info tooltips btn-circle" title="Add" id="btnAddAdditional"><i class="fa fa-plus" aria-hidden="true"></i></button>');*/
	$('#btnAddAdditional').click(function(){
		$('#cmbAdditionalProgram').prop('disabled', false);
		$('#frmAdditionalData').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#hidUniqueidAdditional').val("");
		$('#txtClassification').val("");
		$('#txtMinistry').val("");
		$('#txtDepartment').val("");
		$('#txtOrganisation').val("");
		$('#txtPayScale').val("");
		$('#txtAge').val("");
		$('#txtEsQualification').val("");
		$('#txtDesireQualification').val("");
		$('#radioUpload').attr('checked',false);
		$('#divUpload').hide();
		$('#divWrite').hide();
		$('#txtDuties').val("");
		$('#txtProbPeriod').val("");
		$('#txtHeadQuarter').val("");
		$('#txtOtherDetail').val("");
		
		$('#programAdditionalModal').modal('show');
		$('#programAdditionalModal').on('shown.bs.modal', function () 
		{ 
			$('#txtClassification').focus(); // Focusing the textbox
		})
	});
/*****AJAX CALL TO GET DATA FROM DATABASE(FOR SELECT OPTIONS)**********/
	// get group name from database
	$.ajax({
		url:base_url+"ajax_controller/select_cmbgroup_data",
		type:"post",
		success:function(response){  
			var options = "<option selected disabled value=''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value='"+data.program_group_code+"'>"+data.program_group_name+"</option>";
				
			});
			$('#cmbProgramGroup').html("");   //campusid from academicPeriod
			$('#cmbProgramGroup').append(options);
			// $('#cmbProgramGroupCopy').html("");   //campusid from academicPeriod
			// $('#cmbProgramGroupCopy').append(options);
			// $('#cmbProgramGroupEdit').html("");   //campusid from academicPeriod
			// $('#cmbProgramGroupEdit').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});				
/*****END OF AJAX CALL TO GET DATA FROM DATABASE**********/
//*** *********** CHANGE BY ME*************************
	$('#btnAddProgram').click(function(){
		$('#frmAddProgram').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
		$('#txtProgramCode').val("");
		$('#cmbProgramGroup').val("");
		$('#taElectiveSubjects').val("");
		$('#txtProgramName').val("");
		//$('#txtYear').val("");
		$('#txtSlno').val("");
		$('#txtOnlineTransactionNo').val("");
		//$('#txtOmrNo').val("");
		$('#cmbStatus').val("");
		$('#cmbTemplate').val("");
		$('#txtProgramDate').val("");
		$('#txtAppDate').val("");
		$('#txtStartdate').val("");
		$('#txtAdmitCardEnddate').val("");
		$('#txtAdmitCardStartdate').val("");
		$('#txtEnddate').val("");
		$('#txtOMRNo').val("");
		//$('#txtAgeEnddate').val("");
		$('#txtSeqCode').val("");
		$('#txtSeqno').val("");
		$("#txtYear").val(new Date().getFullYear());
		//$("#txtOmrNo").val('001');
		$('#programAddModal').modal('show');
		$('#programAddModal').on('shown.bs.modal', function () 
		{ 
			$('#txtProgramCode').focus(); // Focusing the textbox
		})
	});
	
	$('#frmAdditionalData').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			/*txtAppStartdate=$("#txtAppDate").val();
		    txtEligibledate=$("#txtEligibleDate").val();
		    txtProgramdate=$("#txtProgramDate").val();*/
		    var formData = new FormData(document.getElementById("frmAdditionalData"));
			$("#spanProcessingProgram").show();
			
			var unique_key = $("#hidUniqueidAdditional").val();
			
			if(unique_key != '' && unique_key != 'undefined')
			{
				var action = 'update_advertisement_data';
			}
			else
			{
				var action = 'insert_advertisement_data';
			}
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/"+action,
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){  
					var result = JSON.parse(response);
					if(result.status=='SUCCESS')
					{
						
						$('#programAdditionalModal').modal('hide');
						
			 			$('#frmAdditionalData').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
						$('#hidUniqueidAdditional').val("");
						$('#advNo').val("");
						$('#programAdditionalModal').modal('hide');
						toastr.success(result.msg);
						var tblProgramAdditional = $("#tblProgramAdditional").DataTable();
						tblProgramAdditional.ajax.reload();
					}
					else
					{
						toastr.error(result.msg);
						var dtblProgram = $("#tblProgramAdditional").DataTable();
			 			dtblProgram.ajax.reload();
			 			$('#frmAdditionalData').data('bootstrapValidator').resetForm(true);	
					}			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			cmbAdditionalProgram: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			advNo: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			filePdf: {							//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					},
					file: {
	          			extension: 'pdf', 
	          			type: 'application/pdf',
	          			maxSize: 1024*1024*10,  //for 5mb
	         	 		message: 'The selected file is not valid, it should be pdf and maximum 10 MB.'
	    			}
				}
			},
			
		}

	});
	
	$('#txtAdvtDate').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy' 
	});
	$('#txtAdvtDateEdit').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    format:'dd-mm-yyyy' 
	});

});
function deleteRow(event)
{
	var session = $('#hidSessionCode').val();
	var oTable = $('#tblProgramAdditional').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;	
	var advt_id = oTable.fnGetData(row)['advt_id'];
	$('#hidUniqueidDelete').val(advt_id);
	$('#programDeleteModal').modal('show');
}

$('#programDeleteRecord').click(function()
{
	$('#programDeleteModal').modal('hide');	
	var institutedata=
	{
		advt_id:$('#hidUniqueidDelete').val(),
	};
	//ajax call to server
	$.ajax({
		url:base_url+"ajax_controller/delete_advertisement_data",
		type:"post",
		data:institutedata,
		success:function(response)
		{  
			var dtblProgramAdditional = $("#tblProgramAdditional").DataTable();
 			dtblProgramAdditional.ajax.reload();
			toastr.success('Data Successfully Deleted');				 
		},
		error:function()
		{
			toastr.error('Unable to process please contact support');
		}
	});
});
function edit(event)
{
	isPublish = false;
	var session = $('#hidSessionCode').val();
	var oTable = $('#tblProgramAdditional').dataTable();
	var row;
	//alert(event.target.tagName);
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A" || event.target.tagName == "IMG")
	  		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
  		row = event.target.parentNode.parentNode.parentNode; 
  	else
  		row = event.target.parentNode;
	$(row).addClass('success');
	// alert(oTable.fnGetData(row)['advt_id']);
	//$('#frmProgramEdit').data('bootstrapValidator').resetForm(true);
    var advt_id = oTable.fnGetData(row)['advt_id'];//GETTING DATA FOR HIDDEN COLUMN
	var advt_date = oTable.fnGetData(row)['advt_date'];
	var advt_no = oTable.fnGetData(row)['advt_no'];
	var program_group_name = oTable.fnGetData(row)['program_group_name'];
	var advt_path = oTable.fnGetData(row)['advt_path'];
   	$.ajax({
		url:base_url+"ajax_controller/select_cmbgroup_data",
		type:"post",
		success:function(response){  
			var options = "<option selected disabled value=''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				if(program_group_name == data.program_group_name){
					options = options + "<option value='"+data.program_group_code+"' selected>"+data.program_group_name+"</option>";	
				}else{
					options = options + "<option value='"+data.program_group_code+"'>"+data.program_group_name+"</option>";
				}
			});
			$('#cmbProgramGroupEdit').html("");   //campusid from academicPeriod
			$('#cmbProgramGroupEdit').append(options);		
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$('#advNoEdit').val(advt_no);
	$('#txtAdvtDateEdit').val(advt_date);
	$('#hidUniqueidEdit').val(advt_id);
	$('#programEditModal').modal('show');
	
	$('#frmProgramEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
		    var formData = new FormData(document.getElementById("frmProgramEdit"));
			$("#spanProcessingProgram").show();
			
			var unique_key = $("#hidUniqueidEdit").val();
			
			if(unique_key != '' && unique_key != 'undefined')
			{
				var action = 'update_advertisement_data';
			}
			else
			{
				var action = 'insert_advertisement_data';
			}
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/"+action,
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response){  
					var result = JSON.parse(response);
					if(result.status=='SUCCESS')
					{
						
						$('#programEditModal').modal('hide');
						
			 			$('#frmProgramEdit').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
						$('#hidUniqueidAdditional').val("");
						// $('#radioUpload').attr('checked',false);
						$('#advNo').val("");
						$('#programEditModal').modal('hide');
						toastr.success(result.msg);
						var tblProgramAdditional = $("#tblProgramAdditional").DataTable();
						tblProgramAdditional.ajax.reload();
					}
					else
					{
						toastr.error(result.msg);
						var dtblProgram = $("#tblProgramAdditional").DataTable();
			 			dtblProgram.ajax.reload();
			 			$('#frmProgramEdit').data('bootstrapValidator').resetForm(true);	
					}			
				},
				error:function(){
					toastr.error('Unable to process please contact support');
				}
			});//end of ajax call	
		},
		fields: {
			cmbAdditionalProgramEdit: {			//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			advNoEdit: {			//form input type name
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
			filePdfEdit: {			//form input type name
				validators: {
					// notEmpty: {
					// 	message: 'This field can\'t left blank'
					// },
					file: {
	          			extension: 'pdf', 
	          			type: 'application/pdf',
	          			maxSize: 1024*1024*10,  //for 10mb
	         	 		message: 'The selected file is not valid, it should be pdf and maximum 10 MB.'
	    			}
				}
			},
		}
	});
}