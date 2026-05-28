$(document).ready(function()
{
	var categCheck  = $('#cmbProgramSelect').multiselect({
	    includeSelectAllOption: true,
	     enableFiltering : true,
		 numberDisplayed: 0
	});
	var userCheck  = $('#cmbUserSelect').multiselect({
	    includeSelectAllOption: true,
	     enableFiltering : true,
		 numberDisplayed: 0
	});
	var oTable;
	var session = $("#hidSession").val();
	//alert(session);
	$.ajax({
		url:base_url+"ajax_controller/select_institute",
		type:"post",
		data:"",
		success:function(response){  
			var options = "";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value='"+data.institute_code+"'>"+data.institute_name+"</option>";
			});
			 /*$.each(res1, function (index, item) {
	           options = options + "<option value="+item.institute_code+">"+item.institute_name+"</option>";
    		});*/
			$('#cmbInstitute').html("");   //campusid from academicPeriod
			$('#cmbInstitute').append(options);
			institute_code = $('#cmbInstitute').val();
			if(institute_code != '')
			{
				selectUser(institute_code,session);
				selectProgram(institute_code,session);
				load_table(institute_code,session);
			}
							
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	var today = $("#txtDateFilter").val();
	var dtblUserProgram = $('#dtblUserProgram').dataTable({
		//"responsive": true,
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth":true,    
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutegroupbutton' >>><'col-xs-6'p>>",
	    "aoColumns": [    
                       { "sName": "sl_no","sWidth": "7%" },
					   { "sName": "user_code","bVisible":false},
					   { "sName": "user","sWidth": "44%"},
                       { "sName": "program_name","sWidth": "44%" },
					   {"sName": "default","sClass":"dt-center","sWidth": "2%", "sDefaultContent":" <button type='button' class='btn btn-danger dt-center'  onclick='fnUserProgram(event);' title='Manage'><i class='fa fa-list'></i></button>"}
              	     ]          
	});
	var dtblManageProgram = $('#dtblManageProgram').dataTable({
		//"responsive": true,
		"bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": false,
        "bInfo": true,
        "bAutoWidth":true,    
        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-3'>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutegroupbutton' >>><'col-xs-6'p>>",
	    "aoColumns": [    
                       { "sName": "sl_no","sWidth": "10%" },
                       { "sName": "program_code","bVisible":false },
                       { "sName": "program_name","sWidth": "85%" },
					   {"sName": "default", "sClass":"dt-center","sWidth": "5%", "sDefaultContent":" <button type='button' class='btn btn-danger dt-center'  onclick='fnManageUserProgram(event);' title='Delete'><i class='fa fa-trash'></i></button>"}
              	     ]          
	});
	$("#cmbInstitute").change(function()
	{
		var institute_code = $("#cmbInstitute").val();
		//alert(institute);
		if(institute_code != '')
		{
			selectUser(institute_code,session);
			selectProgram(institute_code,session);
			load_table(institute_code,session);
		}
		else
		{
			toastr.error("Please Select an Institute");
		}
	});
	$("#btnAssign").click(function()
    {
		var institute_code = $("#cmbInstitute").val();
		var program_codes = serealizeSelects($('.cmbProgramSelect'));
		var users = serealizeSelects($('.cmbUserSelect'));
		//alert(program_codes);
		if(program_codes == '')
		{
			toastr.error('Please Select Atleast One Post');
		}
		else if(users == '')
		{
			toastr.error('Please Select Atleast One User');
		}
		else
		{
			
			
			//alert(arr_document_code);
			var institutedata={
				program_codes : program_codes,
				users : users,
				institute : institute_code,
			};
			$.ajax({
			    url:base_url+"ajax_controller/operation_user_program",
			    type:"post",
			    data:institutedata,
			    success:function(response)
			    { 
				   var res = JSON.parse(response); 
				   if(res.status)
				   {
				   		toastr.success(res.msg);
						load_table(institute_code,session);
						$("#cmbUserSelect option:selected").removeAttr("selected");
						$("#cmbProgramSelect option:selected").removeAttr("selected");
						$('#cmbUserSelect').multiselect('refresh');
						$('#cmbProgramSelect').multiselect('refresh');
				   }
				   else
				   {
				   		toastr.error(res.msg);
				   		$("#cmbUserSelect option:selected").removeAttr("selected");
						$("#cmbProgramSelect option:selected").removeAttr("selected");
						$('#cmbUserSelect').multiselect('refresh');
						$('#cmbProgramSelect').multiselect('refresh');
				   }					
			    },
			    error:function()
			    {
			     	toastr.error('We are unable to process please contact support'); 
			    }
		   }); 
			
		}
    });
	function serealizeSelects (select)
	{
	    var array = [];
	    select.each(function(){ array.push($(this).val()) });
	    return array;
	}
	
});
function selectUser(institute,session)
{
	
	var userCheck  = $('#cmbUserSelect').multiselect({
	    includeSelectAllOption: true,
	     enableFiltering : true
	});
	if(institute != '')
	{
		var institutedata={
				institute : institute
			};
		$.ajax({
			url:base_url+"ajax_controller/select_institute_user",
			type:"post",
			data:institutedata,
			success:function(response){  
				var options = "";
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data)
				{
					options = options + "<option value='"+data.user_code+"'>"+data.user+"</option>";	
					//arr_course.push(data.course_code);	
				});	
				$('#cmbUserSelect').html("");
				$('#cmbUserSelect').append(options);	
				$('#cmbUserSelect').multiselect('rebuild');	
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	}
}
function selectProgram(institute,session)
{
	var institutedata={
		institute : institute
	};
	$.ajax({
		url:base_url+"ajax_controller/select_institute_program",
		type:"post",
		data:institutedata,
		success:function(response){  
			var options = "";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data)
			{
				options = options + "<option value='"+data.program_code+"'>"+data.program_name+"</option>";	
				//arr_course.push(data.course_code);	
			});	
			$('#cmbProgramSelect').html("");
			$('#cmbProgramSelect').append(options);	
			$('#cmbProgramSelect').multiselect('rebuild');			
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
}
function load_table(institute)
{
	if(institute != '')
	{
		$.ajax({
			url:base_url+"ajax_controller/select_user_program_mapping",
			type:"post",
			data:{institute:institute},
			success:function(response)
			{  				
				var res1 = JSON.parse(response);					
				var table = $('#dtblUserProgram').DataTable();
				table.clear().draw();
				table.rows.add(res1.aaData).draw();	
			},
			error:function()
			{
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	}
}
function fnUserProgram(event)
{
	var oTable = $('#dtblUserProgram').dataTable();
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
	   row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
	   row = event.target.parentNode.parentNode.parentNode;
	var user_code = oTable.fnGetData( row )['user_code']; 
	var user = oTable.fnGetData( row )['user']; 
	var session = $('#hidSession').val();
	$('#hidUserCode').val(user_code);
	$('#lblUserName').html(user);
	
	$.ajax({
		url:base_url+"ajax_controller/select_user_program_manage",
		type:"post",
		data:{user_code:user_code},
		success:function(response)
		{  				
			var res1 = JSON.parse(response);					
			var table = $('#dtblManageProgram').DataTable();
			table.clear().draw();
			table.rows.add(res1.aaData).draw();	
			$("#UserProgramEditModal").modal('show');
		},
		error:function()
		{
			toastr.error("We are unable to Process.Please contact Support");
		}
	});	
}
function fnManageUserProgram(event)
{
	// sweet-alert for delete
    swal({
	  title: "Are you sure?",
	  text: "You want to Delete the User Post Mapping!",
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
	    swal("Deleted", "User Post Mapping has been deleted successfully.", "success");
	  } else {
		    swal("Cancelled", "User Post Mapping is safe ", "error");
	  }
	});
    function deleteMaster(){
		var oTable = $('#dtblManageProgram').dataTable();
		var row;
		if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
		   row = event.target.parentNode.parentNode;
		else if(event.target.tagName == "I")
		   row = event.target.parentNode.parentNode.parentNode;
		var program_code = oTable.fnGetData( row )['program_code']; 
		var session = $('#hidSession').val();
		var institute = $('#cmbInstitute').val();
		var user_code = $('#hidUserCode').val();
		var institutedata=
		{
			user_code:user_code,
			program_code:program_code
		};		
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/delete_user_program",
			type:"post",
			data:institutedata,
			success:function(response)
			{  
				var res = JSON.parse(response); 
				if(res.status)
				{
					toastr.success(res.msg);
					$.ajax({
						url:base_url+"ajax_controller/select_user_program_manage",
						type:"post",
						data:{user_code:user_code},
						success:function(response)
						{  				
							var res1 = JSON.parse(response);					
							var table = $('#dtblManageProgram').DataTable();
							table.clear().draw();
							table.rows.add(res1.aaData).draw();	
							load_table(institute,session);
							//$("#UserProgramEditModal").modal('show');
						},
						error:function()
						{
							toastr.error("We are unable to Process.Please contact Support");
						}
					});	
					
					
				}
				else
				{
					toastr.error(res.msg);
				}				 
			},
			error:function()
			{
				toastr.error('Unable to process please contact support');
			}
		});	
	}
}