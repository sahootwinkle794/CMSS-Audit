$(document).ready(function(){

	$.ajax({
		url:base_url+"ajax_controller/select_program_data_manage_app", 
		type:"post",
		success:function(response)
		{  
			var options = "<option value=''>Select</option>";					
			var res1 = JSON.parse(response);					
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value='"+data.program_group_code+"'>"+data.program_group_name+"</option>";
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
		var program_type = '';
		/*if(program_group != '' && program_type != '')
		{*/
			var institutedata = {
				program_type:program_type,
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
					var opt = "<option value =''>Select Post</option>";
					if(options == ''){
						$('#cmbProgramFilter').html("");   //campusid from academicPeriod
						$('#cmbProgramFilter').append(opt);   
						var program = $("#cmbProgramFilter").val();
						var program_group = $("#cmbProgramGroup").val();
						
					}
					else{
						$('#cmbProgramFilter').html("");   
						$('#cmbProgramFilter').append(options);	
						var program = $("#cmbProgramFilter").val();
						var program_group = $("#cmbProgramGroup").val();
						
						/*if(program !='' || program != null && program_group !='' || program_group != null )
						{*/
							
						//}
					}
					
				},
				error:function()
				{
					alert("We are unable to Process.Please contact Support");
				}
			});
		//}
	});
	var ApplicationDetail = $('#tblCounsellingPeriod').dataTable({
			"bPaginate": true,
	        "bLengthChange": true,
	        "bFilter": true,
	        "bSort": true,
	        "bInfo": true,
	        "bDestroy" : true,
	        "bAutoWidth": false,
	        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 ' >>><'col-xs-6'p>>", 
	});	
	
	$('#cmbProgramFilter').change(function()
	{
		var institutedata = {
			program:$('#cmbProgramFilter').val()
		};
		var ApplicationDetail = $('#tblCounsellingPeriod').dataTable({
			"ajax":
			{
				"url": base_url+"/ajax_controller/select_course",
				"type": "POST",
				"data": institutedata
			}, 
			"bPaginate": true,
	        "bLengthChange": true,
	        "bFilter": true,
	        "bSort": true,
	        "bInfo": true,
	        "bDestroy" : true,
	        "bAutoWidth": false,
			/*"sDom":"<'row'<'col-xs-4 addbuttonCounsellingPeriod'><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-6'i >>><'col-xs-6'p>>",*/
			"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-7 addbuttonCounsellingPeriod' >>><'col-xs-6'p>>", 
			"aoColumns": [
							{ "sName": "sl_no","sWidth": "5%"},
							{ "sName": "program_code","bVisible":false},
							{ "sName": "program_name","sWidth": "25%"}, 
							{ "sName": "course_name","sWidth": "25%"}, 
							{ "sName": "course_code","bVisible":false},
							{ "sName": "eligible_start_date","sWidth": "15%"},
							{ "sName": "eligible_end_date","sWidth": "15%"},
							{"sName": "default","sWidth": "15%", "sClass":"dt-center", "sDefaultContent": "<button class='btn btn-warning btn-sm btn-circle tooltipTable' onclick='categoryRow(event,\"edit\")' title='Edit' ><i class='fa fa-edit'></i></button>\
				            <button class='btn btn-danger btn-sm btn-circle tooltipTable' onclick='categoryRow(event,\"delete\")' title='Delete' ><i class='fa fa-trash'></i>"}
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
		$("div.addbuttonCounsellingPeriod").html('<button id="btnAddCounsellingPeriod" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>&nbsp;</div>');	
		/*$("div.addbuttonCounsellingPeriod").html("<button id='btnAddCounsellingPeriod' class='btn btn-info btn-circle tooltips' title='Add Category'><i class='fa fa-plus'></i></button>");	*/
		//ADD button clicked
		$('#btnAddCounsellingPeriod').click(function()
		{
			$('#frmCounsellingPeriod').data('bootstrapValidator').resetForm(true);
			cmbProgramFilter = $('#cmbProgramFilter').val();
			$("#hidAction").val("Add");
			$("#cmbProgram").prop('disabled', false);
			$('#cmbProgram').val(cmbProgramFilter);
			$('#txtCoursecode').val("");
			$('#txtCourseName').val("");
			$('#txtAgeStartdate').val("");
			$('#txtAgeEnddate').val("");/*
			$("#cmbProgram").prop('disabled', true);	*/
			$("#txtCoursecode").prop('disabled', false);
			$("#txtCourseName").prop('disabled', false);
			$("#myModalLabelCounsellingPeriod").html("Add Course");
			$("#btnSaveCounsellingPeriod").html("<i class='fa fa-save'></i>  Add");
			$('#modalCounsellingPeriod').modal('show');
			$('#modalCounsellingPeriod').on('shown.bs.modal', function()
			{  
				//$('#txtAgeStartdate').focus();// Focusing the textbox
			})	
			filter_category();
		});
	});
	// *************************************************************** FOR Category SETUP ***********************************************************
	filter_category();
	$.ajax({
		url:base_url+"/ajax_controller/get_program_elig_cat",
		type:"post",
		data : '',
		success:function(response){  
			var options = "<option value =''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.program_code+">"+data.program_name+"</option>";
				
			});
			$('#cmbProgram').html("");   //campusid from academicPeriod
			$('#cmbProgram').append(options);
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	/*$.ajax({
		url:base_url+"/ajax_controller/get_cat_elig_cat",
		type:"post",
		data : '',
		success:function(response){  
			var options = "<option value =''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.category_code+">"+data.category_name+"</option>";
				
			});
			$('#cmbCategory').html("");   //campusid from academicPeriod
			$('#cmbCategory').append(options);
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});*/
	
	
	
	
	
	//ADD/UPDATE RECORD WITH VALIDATION	
	$('#frmCounsellingPeriod').bootstrapValidator({
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
			var formData = new FormData(document.getElementById("frmCounsellingPeriod"));
			var oper = $("#hidAction").val();
			//ajax call to server
			if(oper == 'Add')
				oper = 'ADD_Course';
			else if(oper == 'Update')
				oper = 'UPDATE_Course';
				
			$.ajax({
				url:base_url+"ajax_controller/"+oper,
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response)
				{  
					var res = JSON.parse(response);
					
					if(res.status == "Error")
					{ 
						
						toastr.error(res.msg);
						return false;
					}
					else if(res.status == "SUCCESS"){
						var tblCounter = $("#tblCounsellingPeriod").DataTable();
			 			tblCounter.ajax.reload();
			 			$('#frmCounsellingPeriod').data('bootstrapValidator').resetForm(true);	
						toastr.success(res.msg);
						if(oper != 'ADD_CounsellingPeriod')
						{
							$('#modalCounsellingPeriod').modal('hide');
						}
					} 
					else
					{
						var res = JSON.parse(response);
						toastr.warning(res.msg);
					} 
				},
				error:function()
				{
					toastr.error('We are unable to process please contact support');	
				}
			});
		},
    	//live: 'enabled',
        fields: 
         {
            cmbProgram: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }, 
            txtCourseName: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
             txtCoursecode: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            txtAgeStartdate: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            txtAgeEnddate: {							//form input type name
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }
		}	 
	});
	$.fn.datepicker.defaults.format = "dd-mm-yyyy";
	$('#txtAgeEnddate').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    endDate: '+0d'
	    
	}).on('changeDate', function (selected) {
		$('#frmCounsellingPeriod').data('bootstrapValidator').updateStatus('txtAgeEnddate', 'NOT_VALIDATED').validateField('txtAgeEnddate');
		var startDate = new Date(selected.date.valueOf());
	    var date2 = $('#txtAgeEnddate').datepicker('getDate');
        date2.setDate(date2.getDate() - 1);
	   	$('#txtAgeStartdate').datepicker().datepicker('setEndDate', date2);
	}).on('clearDate', function (selected) {
		$('#frmCounsellingPeriod').data('bootstrapValidator').updateStatus('txtAgeEnddate', 'NOT_VALIDATED').validateField('txtAgeEnddate');
	});
	$('#txtAgeStartdate').datepicker({
	    autoclose:true,
	    clearBtn:true,
	    endDate: '+0d'
	    
	}).on('changeDate', function (selected) {
		$('#frmCounsellingPeriod').data('bootstrapValidator').updateStatus('txtAgeStartdate', 'NOT_VALIDATED').validateField('txtAgeStartdate');
	    var date2 = $('#txtAgeStartdate').datepicker('getDate');
        date2.setDate(date2.getDate() + 1);
	    $('#txtAgeEnddate').datepicker('setStartDate', date2);
	}).on('clearDate', function (selected) {
		$('#frmCounsellingPeriod').data('bootstrapValidator').updateStatus('txtAgeStartdate', 'NOT_VALIDATED').validateField('txtAgeStartdate');
	    $('#txtAgeEnddate').datepicker('setStartDate', null);
	});/*
	$('#txtAgeStartdate').datepicker({
		dateFormat: 'dd-mm-yy',
		onSelect: function (date) {
            var date2 = $('#txtAgeStartdate').datepicker('getDate');
            date2.setDate(date2.getDate() + 1);
            $('#txtAgeEnddate').datepicker('option', 'minDate', date2);
        }
	});
    $('#txtAgeEnddate').datepicker({
		dateFormat: 'dd-mm-yy',
		onSelect: function (date) {
            var date2 = $('#txtAgeEnddate').datepicker('getDate');
        }
	});*/
});


// ************************************************** FOR Counselling Period SETUP******************************************
function filter_category()
{ 
	cmbProgram = $("#cmbProgram").val();
	$.ajax({
		url:base_url+"/ajax_controller/get_cat_elig_cat",
		type:"post",
		data : {cmbProgram: cmbProgram},
		success:function(response){  
			var options = "<option value =''>Select</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.category_code+">"+data.category_name+"</option>";
				
			});
			$('#cmbCategory').html("");   //campusid from academicPeriod
			$('#cmbCategory').append(options);
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
}
function categoryRow(event,action)
{
	$.fn.datepicker.defaults.format = "dd-mm-yyyy";
	$('#txtAgeStartdate').datepicker({
	    autoclose:true,
	    clearBtn:true
	    
	}).on('changeDate', function (selected) {
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtAgeEnddate').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
	    $('#txtAgeEnddate').datepicker('setStartDate', null);
	});
	var oTable = $('#tblCounsellingPeriod').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;
	$('#frmCounsellingPeriod').data('bootstrapValidator').resetForm(true);
	$('#hidCounsellingPeriod').val( oTable.fnGetData(row)['program_code']);
	$('#hidCounsellingCat').val( oTable.fnGetData(row)['course_code']);
	$('#cmbProgram').val( oTable.fnGetData(row)['program_code']);
	$('#txtCourseName').val( oTable.fnGetData(row)['course_name']);
	$('#txtCoursecode').val( oTable.fnGetData(row)['course_code']);
	$('#txtAgeStartdate').val( oTable.fnGetData(row)['eligible_start_date']);
	$('#txtAgeEnddate').val( oTable.fnGetData(row)['eligible_end_date']);
	
	if(action == 'edit')
	{
		$("#myModalLabelCounsellingPeriod").html("Update Category Wise Age Relaxation");
		$("#btnSaveCounsellingPeriod").html("<i class='fa fa-save'></i>  Update");
		$("#hidAction").val("Update");
		$("#cmbProgram").prop('disabled', true);	
		$("#txtCoursecode").prop('disabled', true);	
		//$("#cmbCategory").prop('disabled', true);	
		$('#modalCounsellingPeriod').modal('show');
	}	
	else
	{
		swal({
		  title: "Are you sure?",
		  text: "You want to Delete the Setup!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, delete it!",
		  cancelButtonText: "No, cancel",
		  closeOnConfirm: false,
		  closeOnCancel: true
		},
		function(isConfirm){
		  if (isConfirm) {
		  	deleteMaster();
		    swal("Deleted", "Course has been deleted successfully.", "success");
		  } else {
			    swal("Cancelled", "Course Setup is safe ", "error");
		  }
		});
	    function deleteMaster(){ 
			var institutedata=
			{
				cmbProgram:$('#hidCounsellingPeriod').val(),
				CourseName:$('#txtCourseName').val(), 
				Coursecode:$('#txtCoursecode').val(),  
				type:"operation_delete_Course" 
			};	
			/*alert (institutedata);*/ 
			type = 'operation_delete_Course';	 
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/"+type,
				type:"post",
				data:institutedata,
				success:function(response)
				{  
					var result = JSON.parse(response);	
					if(result.status == true)
					{	
						var tblCounsellingPeriod = $("#tblCounsellingPeriod").DataTable();
		 				tblCounsellingPeriod.ajax.reload();
						toastr.success(result.msg);
					}
					else
					{
						toastr.error(result.msg);
					}					 
				},
				error:function()
				{
					toastr.error('Unable to process please contact support');
				}
			});	
		}
	}	
	
}
