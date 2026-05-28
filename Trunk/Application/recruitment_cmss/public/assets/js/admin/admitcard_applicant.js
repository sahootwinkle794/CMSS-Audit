$(document).ready(function()
{	
	$(document).ajaxSend(function(){
	    $('.loadingRPimage').fadeIn(250);
	});
	$(document).ajaxComplete(function(){
	    $('.loadingRPimage').fadeOut(500);
	});
	// to get program name
	var institutedata={
		program_code : $('#sel_program').val(),
		//applied_exam_center_code : $('#exam_centre').val(),
		applied_date : $('#applied_date').val()
	};
	$.ajax({
		url:base_url+"/ajax_controller/get_applicants_program_name_admit_setup",
		type:"post",
		data : institutedata,
		success:function(response){ 
			var res1 = JSON.parse(response); 
			$("#program").html(res1.program_name); 
			$("#program").val(res1.program_code); 
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
	// to get exam_center
	/*var institutedata={
		program_code : $('#sel_program').val(),
		applied_exam_center_code : $('#exam_centre').val(),
		applied_date : $('#applied_date').val()
	};
	$.ajax({
		url:base_url+"/ajax_controller/get_applicants_exam_centre_name_admit_setup",
		type:"post",
		data : institutedata,
		success:function(response){ 
			var res1 = JSON.parse(response); 
			$("#exam_center").html(res1.exam_center_name); 
			$("#exam_center").val(res1.exam_center_code); 
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});*/
	
	// to get applied_upto
	$("#applied_upto").html($('#applied_date').val()); 
	$("#applied_upto").val($('#applied_date').val()); 
	
	// to load data table
	var institutedata={
		program_code : $('#sel_program').val(),
		//applied_exam_center_code : $('#exam_centre').val(),
		applied_date : $('#applied_date').val(),
		round_data : $('#round_data').val()
	};
	$.ajax({
		url:base_url+"/ajax_controller/get_applicants_admit_setup",
		type:"post",
		data : institutedata,
		success:function(response){ 
			var res1 = JSON.parse(response); 
			$("#divApplicantList").html(res1.html); 
			$("#btnTotalcount").html(res1.totalapplicant); 
			countChecked();
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	/*$.ajax({
		url:base_url+"/ajax_controller/get_total_count_applicant",
		type:"post",
		data : institutedata,
		success:function(response){ 
			var res1 = JSON.parse(response); 
			$("#btnTotalcount").html(res1.count); 
			countChecked();
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});*/
	
	
	$('#center_name1').change(function(){
		var institutedata={
		program_code : $('#sel_program').val(),
		preference1 : $('#center_name1').val(),
		preference2 : $('#center_name2').val(),
		preference3 : $('#center_name3').val(),
		applied_date : $('#applied_date').val(),
		round_data : $('#round_data').val()
		};
		$.ajax({
			url:base_url+"/ajax_controller/get_applicants_admit_setup",
			type:"post",
			data : institutedata,
			success:function(response){ 
				var res1 = JSON.parse(response); 
				$("#divApplicantList").html(res1.html);
				$("#btnTotalcount").html(res1.totalapplicant);  
				countChecked();
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
		
	    
	});
	$('#center_name2').change(function(){
		var institutedata={
		program_code : $('#sel_program').val(),
		preference1 : $('#center_name1').val(),
		preference2 : $('#center_name2').val(),
		preference3 : $('#center_name3').val(),
		applied_date : $('#applied_date').val(),
		round_data : $('#round_data').val()
		};
		$.ajax({
			url:base_url+"/ajax_controller/get_applicants_admit_setup",
			type:"post",
			data : institutedata,
			success:function(response){ 
				var res1 = JSON.parse(response); 
				$("#divApplicantList").html(res1.html);
				$("#btnTotalcount").html(res1.totalapplicant);  
				countChecked();
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
		
	    
	});
	$('#center_name3').change(function(){
		var institutedata={
		program_code : $('#sel_program').val(),
		preference1 : $('#center_name1').val(),
		preference2 : $('#center_name2').val(),
		preference3 : $('#center_name3').val(),
		applied_date : $('#applied_date').val(),
		round_data : $('#round_data').val()
		};
		$.ajax({
			url:base_url+"/ajax_controller/get_applicants_admit_setup",
			type:"post",
			data : institutedata,
			success:function(response){ 
				var res1 = JSON.parse(response); 
				$("#divApplicantList").html(res1.html);
				$("#btnTotalcount").html(res1.totalapplicant);  
				countChecked();
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
		
	    
});
	var institutedata={
		program_code : $('#sel_program').val()
	};
	$.ajax({
		url:base_url+"/ajax_controller/get_applicants_centre_admit_setup",
		type:"post",
		data : institutedata,
		success:function(response){  
			var options = "<option value =''>Exam Center</option>";
			var res1 = JSON.parse(response);
			$.each(res1.aaData,function(i,data){
				options = options + "<option value="+data.exam_centre_code+">"+data.exam_centre_name+"</option>";
				
			});
			$('#cmbExamCenter').html("");   //campusid from academicPeriod
			$('#cmbExamCenter').append(options);
			
			$('#center_name1').html("");   //campusid from academicPeriod
			$('#center_name1').append(options);
			$("#center_name1").append('<option value="Blank"></option>');
			
			$('#center_name2').html("");   //campusid from academicPeriod
			$('#center_name2').append(options);
			
			$('#center_name3').html("");   //campusid from academicPeriod
			$('#center_name3').append(options);
			
			//$('#cmbExamCenter').val($('#exam_centre').val());
			/*var institutedata={
				program_code : $('#sel_program').val(),
				round_data : $('#round_data').val(),
				applied_exam_center_code : $('#exam_centre').val()
			};
			$.ajax({
				url:base_url+"/ajax_controller/get_applicants_venue_admit_setup",
				type:"post",
				data : institutedata,
				success:function(response){  
					$("#spanProcessingExam").hide();
					var options = "<option value =''>Exam Venues</option>";
					var res1 = JSON.parse(response);
					$.each(res1.aaData,function(i,data){
						options = options + "<option value='"+data.exam_vanue_code+"'>"+data.exam_vanue+"</option>";
						
					});
								
					
					$('#cmbExamVanue').html("");   //campusid from academicPeriod
					$('#cmbExamVanue').append(options);
					
					//alert("hello");		
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});*/
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
	
	/*$('#cmbExamCenter').change(function(){
		var center = $('#cmbExamCenter').val();
		if(center !='')
		{
			$('#spanCapacity').html("");
			$("#spanProcessingExam").show();
			var institutedata={
				program_code : $('#sel_program').val(),
				round_data : $('#round_data').val(),
				applied_exam_center_code : $('#cmbExamCenter').val()
			};
			$.ajax({
				url:base_url+"/ajax_controller/get_applicants_venue_admit_setup",
				type:"post",
				data : institutedata,
				success:function(response){  
					$("#spanProcessingExam").hide();
					var options = "<option value =''>Exam Venues</option>";
					var res1 = JSON.parse(response);
					$.each(res1.aaData,function(i,data){
						options = options + "<option value='"+data.exam_vanue_code+"'>"+data.exam_vanue+"</option>";
						
					});
								
					
					$('#cmbExamVanue').html("");   //campusid from academicPeriod
					$('#cmbExamVanue').append(options);
					
					//alert("hello");		
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		}
	    
	});*/
	$('#cmbExamCenter').change(function(){
		var center = $('#cmbExamCenter').val();
		var vanue = $('#cmbExamVanue').val();
		if(center !='')
		{
			var institutedata={
				program_code : $('#sel_program').val(),
				center : center,
				vanue : vanue
			};
			$('#spanCapacity').html("");
			$("#spanProcessingExamVanue").show();
			$.ajax({
				url:base_url+"/ajax_controller/get_applicants_capacity_admit_setup",
				type:"post",
				data : institutedata,
				success:function(response){  
					$("#spanProcessingExamVanue").hide();
					var options = "";
					var capacity ="";
					var available_value ="";
					var res1 = JSON.parse(response);
					$.each(res1.aaData,function(i,data){
						available_value = data.capacity-data.no_of_assign;
						capacity = data.capacity;
						options = options + available_value+"/"+data.capacity;
						//alert(options);
						
					});
								
					
					//$('#txtCapacity').html("");   //campusid from academicPeriod
					$('#hidCapacity').val(capacity);
					$('#hidAssigned').val(available_value);
					$('#spanCapacity').text(options);
					//alert(available_value);
					
					//alert("hello");		
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		}
	    
	});
	
	$( "#btnRandomize" ).on("click", function(){
		var institutedata={
		program_code : $('#sel_program').val(),
		//applied_exam_center_code : $('#exam_centre').val(),
		applied_date : $('#applied_date').val(),
		round_data : $('#round_data').val(),
		preference1 : $('#center_name1').val(),
		preference2 : $('#center_name2').val(),
		preference3 : $('#center_name3').val()
		};
		$.ajax({
			url:base_url+"/ajax_controller/applicants_randomize_admit_setup",
			type:"post",
			data : institutedata,
			success:function(response){ 
				var res1 = JSON.parse(response); 
				$("#divApplicantList").html(res1.html); 
				countChecked();
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	});
	$( "#btnMark" ).on( "click", function(){
		var arrFromNo = $("#txtFromSlNo").val();
			//alert(arrFromNo);
		var arrToNo = $("#txtToSlNo").val();
		if(arrToNo >= arrFromNo)
		{
			$("#applicantBody input[type='checkbox']").each(function() { //loop through each checkbox
	            if(!this.disabled)
	            {
	            	this.checked = false; 
	            	//this.parentNode.parentNode.style.backgroundColor = "red";   
	            }	                    
	        });  
			//select specific roll no
			var rows = $("#tblApplicants").dataTable().fnGetNodes();
		
			//alert(arrToNo);
			for(i=arrFromNo-1;i<arrToNo;i++)
	        {
				
				var slno = $(rows[i]).find("td:eq(0)").html();
				//alert(slno);
				var rowslnum = i+1;
				$("#chk"+rowslnum).prop("checked", true );
	            
	        }
			countChecked();
		}
		else
		{
			toastr.error('From sl No should be less than or equal to Sl No');
			$("#divApplicantList input[type='checkbox']").each(function() { //loop through each checkbox
                if(!this.disabled)
                {
                	this.checked = false; 
                	//this.parentNode.parentNode.style.backgroundColor = "red";   
                }	                    
            });
			countChecked();
			
		}
		
	});
	
	countChecked();
	
});
function check()
{
	countChecked();
}
function allcheck(selectAllList,classname)
{
	//selectlength = null;
	var selectlength=$('.'+selectAllList+':checked').length;
	if(selectlength == 1)
	{
		if(!this.disabled)
        {
			$('.'+classname+'').prop("checked", true);
			countChecked();
		}
	}
	else
	{
		if(!this.disabled)
        {
			$('.'+classname+'').prop("checked", false);
			countChecked();
		}
	}
}

function checkStatus()
{
	var available = 0;
	var checked = 0;
	var examCenter = $('#cmbExamCenter').val();
	var examVanue = $('#cmbExamVanue').val();
	var capacity = $('#hidCapacity').val();
	available = $('#hidAssigned').val();
	checked = $('#spanNowAssign').text();
	//var available = document.getElementById("hidAssigned").innerText;
	//var checked = document.getElementById("spanNowAssign").innerText;
	//alert(available);
	//alert(checked);
	
	var arr_show_status = new Array();
    $('input[name="chkApplicant[]"]').each(function(){
        if($(this).is(':checked')){
			arr_show_status.push($(this).val());
		}
    });	
    
	if(parseInt(available) < parseInt(checked))
	{
		
		toastr.error('Can not Assign more than available Seats');
		return false;
	}
	if(examCenter == "")
	{
		toastr.error('Exam Center is Required.');
		return false;
	}
	else
	{
		if(arr_show_status.length == 0){
			toastr.error("Please select atleast one applicant to assign");
		}else{
			var institutedata={
				program_code : $('#sel_program').val(),
				applied_exam_center_code : $('#cmbExamCenter').val(),
				applied_date : $('#applied_date').val(),
				round_data : $('#round_data').val(),
				examCenter : examCenter,
				examVanue : examVanue,
				chkApplicant : arr_show_status
			};
			$.ajax({
				url:base_url+"/ajax_controller/assign_applicants_centre_admit_setup",
				type:"post",
				data : institutedata,
				success:function(response){  
					var res1 = JSON.parse(response);
					if(res1.status = 'SUCCESS')
					{
						var institutedata={
							program_code : $('#sel_program').val(),
							applied_exam_center_code : $('#cmbExamCenter').val(),
							applied_date : $('#applied_date').val(),
							round_data : $('#round_data').val(),
						};
						$.ajax({
							url:base_url+"/ajax_controller/get_applicants_admit_setup",
							type:"post",
							data : institutedata,
							success:function(response){ 
								var res1 = JSON.parse(response); 
								$("#divApplicantList").html(res1.html); 
							},
							error:function(){
								toastr.error("We are unable to Process.Please contact Support");
							}
						});
						$.ajax({
							url:base_url+"/ajax_controller/get_total_count_applicant",
							type:"post",
							data : institutedata,
							success:function(response){ 
								var res1 = JSON.parse(response); 
								$("#btnTotalcount").html(res1.count); 
								countChecked();
							},
							error:function(){
								toastr.error("We are unable to Process.Please contact Support");
							}
						});
						$('#successDiv').html("");
						$('#successDiv').append('<div class="alert alert-dismissable alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button><p style="font-size:14px;">Center allocated successfully.</p></div>');
						//$("#successDiv").html('Center allocated successfully.'); 
						$( "#spanNowAssign" ).text("");
						if(examVanue !='')
						{
							var institutedata={
								program_code : $('#sel_program').val(),
								center : $('#cmbExamCenter').val(),
								vanue : $('#cmbExamVanue').val()
							};
							$('#spanCapacity').html("");
							$("#spanProcessingExamVanue").show();
							$.ajax({
								url:base_url+"/ajax_controller/get_applicants_capacity_admit_setup",
								type:"post",
								data : institutedata,
								success:function(response){  
									$("#spanProcessingExamVanue").hide();
									var options = "";
									var capacity ="";
									var available_value ="";
									var res1 = JSON.parse(response);
									$.each(res1.aaData,function(i,data){
										available_value = data.capacity-data.no_of_assign;
										capacity = data.capacity;
										options = options + available_value+"/"+data.capacity;
										//alert(options);
										
									});
												
									
									//$('#txtCapacity').html("");   //campusid from academicPeriod
									$('#hidCapacity').val(capacity);
									$('#hidAssigned').val(available_value);
									$('#spanCapacity').text(options);
									//alert(available_value);
									
									//alert("hello");		
								},
								error:function(){
									toastr.error("We are unable to Process.Please contact Support");
								}
							});
						}
					}
					else
					{
						toastr.error("Unable to allocate center");
					}
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		}
	}
	
	
}

var countChecked = function() {
	//alert("Dsadsa");
	$( "#spanNowAssign" ).text("");
	var p = $( "#applicantBody input:checked" ).length;
	var total = $( "#applicantBody input[type='checkbox']" ).length;
	var exitcount = $( "#applicantBody input[disabled]" ).length;
	$( "#spanNowAssign" ).text( p  );
	//$( "#spanAbsentCount" ).text( (total-exitcount-p)  );
};
countChecked();