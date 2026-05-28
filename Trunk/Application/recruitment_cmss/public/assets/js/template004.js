/*
function isNumberKey1(evt)
{
	alert(evt);
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	 if (this.value.length == 0 && e.which == 48 ){
	      return false;
	   }
	if (charCode != 46 && charCode > 31 
		&& (charCode < 48 || charCode > 57))
		return false;

	return true;
}*/
function validate_academic()
{
	if($("#txtExamName1").val() != '')
	{
		if(document.getElementById("txtStream1").value  == '' )
		{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtStream1', 'INVALID', null);
		}
		else{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtStream1', 'VALID', null);
		}
		if(document.getElementById("txtYearQual1").value  == '' )
		{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtYearQual1', 'INVALID', null);
		}
		else{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtYearQual1', 'VALID', null);
		}
		if(document.getElementById("txtBoardOth1").value  == '' )
		{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtBoardOth1', 'INVALID', null);
		}
		else{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtBoardOth1', 'VALID', null);
		}
		if(document.getElementById("txtDiv1").value  == '' )
		{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtDiv1', 'INVALID', null);
		}
		else{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtDiv1', 'VALID', null);
		}
		if(document.getElementById("txtGradingOth1").value  == '' )
		{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtGradingOth1', 'INVALID', null);
		}
		else{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtGradingOth1', 'VALID', null);
		}
		if(document.getElementById("txtCGPA1").value  == '' )
		{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtCGPA1', 'NOT_VALIDATED',null).validateField('txtCGPA1');/*
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtCGPA1', 'INVALID', null).validateField('txtCGPA1');*/
		}
		else{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtCGPA1', 'VALID', null);
		}
		
	}
	else
	{
		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtStream1', 'VALID', null);
		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtYearQual1', 'VALID', null);
		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtBoardOth1', 'VALID', null);
		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtDiv1', 'VALID', null);
		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtGradingOth1', 'VALID', null);
		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtCGPA1', 'VALID', null);
	}
	if($("#txtExamName2").val() != '')
	{
		if(document.getElementById("txtStream2").value  == '' )
		{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtStream2', 'INVALID', null);
		}
		else{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtStream2', 'VALID', null);
		}
		if(document.getElementById("txtYearQual2").value  == '' )
		{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtYearQual2', 'INVALID', null);
		}
		else{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtYearQual2', 'VALID', null);
		}
		if(document.getElementById("txtBoardOth2").value  == '' )
		{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtBoardOth2', 'INVALID', null);
		}
		else{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtBoardOth2', 'VALID', null);
		}
		if(document.getElementById("txtDiv2").value  == '' )
		{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtDiv2', 'INVALID', null);
		}
		else{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtDiv2', 'VALID', null);
		}
		if(document.getElementById("txtGradingOth2").value  == '' )
		{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtGradingOth2', 'INVALID', null);
		}
		else{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtGradingOth2', 'VALID', null);
		}
		if(document.getElementById("txtCGPA2").value  == '' )
		{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtCGPA2', 'NOT_VALIDATED',null).validateField('txtCGPA2');
		}
		else{
			$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtCGPA2', 'VALID', null);
		}
		
	}
	else
	{
		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtStream2', 'VALID', null);
		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtYearQual2', 'VALID', null);
		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtBoardOth2', 'VALID', null);
		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtDiv2', 'VALID', null);
		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtGradingOth2', 'VALID', null);
		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtCGPA2', 'VALID', null);
	}
	
}
$(document).ready(function() {
	/*$("#cmbPostSelect").selectize();
	$.ajax({
		url:base_url+"ajax_controller/select_course_data", 
		type:"post",
		success:function(response){  
			//var options = "<option value=''>Select Post</option>";
			var selectize = $("#cmbPostSelect").selectize()[0].selectize;
			selectize.clear();
			selectize.clearOptions();
			var res1 = JSON.parse(response);
			$.each(res1.aaData, function (i, data) {
				selectize.addOption({value:data.course_code,text:data.course_name});	            
	        });   
	            
	    },       
	            
	});*/
	
	var posts = $("#hiddenPost").val();
	//Make an array
	
	//var post_array=posts.split(",");
	//alert(post_array);
	var count = 0;
	$.ajax({
		url:base_url+"ajax_controller/select_course_data", 
		type:"post",
		success:function(response){  
			//var options = "<option value=''>Select Post</option>";
			var options = "";
			var res1 = JSON.parse(response);
		   	$.each(res1.aaData,function(i,data){
		   		if(posts.includes(data.course_code))
		   		{
					options = options + "<option value='"+data.course_code+"' selected>"+data.course_name+"</option>";
				}
				else
				{
					options = options + "<option value='"+data.course_code+"'>"+data.course_name+"</option>";
				}
		    	
		   	});  
			
			//alert(options);
			$('#cmbPostSelect').html("");   //campusid from academicPeriod
			$('#cmbPostSelect').append(options);
			
			
			$('#cmbPostSelect').multiselect({
		        enableFiltering: true,
		        maxHeight:400,
		        enableCaseInsensitiveFiltering:true, 
		        nonSelectedText: 'Not Selected', 
		        numberDisplayed: 2, 
		        selectAll: false
		    });
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
            
            
	
	
	
var appl_status = $("#hidApplStatus").val();
	//alert(appl_status);
	if(appl_status == 'Student Details Submitted' || appl_status == 'Document Uploaded' || appl_status == 'Verified' || appl_status == 'Fee Paid' || appl_status == 'Applicant_Info')
	{
		$("#tab_b").show(); 
	 	$("#tab_c").show(); 
	 	$("#tab_d").show();
	}
	else if(appl_status == 'Applicant_Academic_Details')
	{
		$("#tab_b").show(); 
	 	$("#tab_c").show();
	 	$("#tab_d").hide();
	}
	else if(appl_status == 'Applicant_Details')
	{
		$("#tab_b").show(); 
		$("#tab_c").hide(); 
	 	$("#tab_d").hide();
	}
	else
	{
		$("#tab_b").hide(); 
	 	$("#tab_c").hide(); 
	 	$("#tab_d").hide();
	}
	$(".input-group > input").focus(function(e){
        $(this).parent().addClass("input-group-focus");
    }).blur(function(e){
        $(this).parent().removeClass("input-group-focus");
    });
	$('[data-toggle="tooltip"]').tooltip(); 
	$('#txtFirstName').on('keydown', function(e) {
		//console.log(e.which);
		if(e.which != 37 &&  e.which != 39 && e.which != 8 )
		{
			var str = document.getElementById("txtFirstName").value;
		    var res = str.toUpperCase();
		    document.getElementById("txtFirstName").value = res;
		}
 	});
 	$.ajax({
		url:base_url+"ajax_controller/select_center_preference",
		type:"post",
		//data:institutedata,
		success:function(response){  
			var options = "<option value =''>Select Preference</option>";
			var res1 = JSON.parse(response);
			//alert(res1); 
		   	for(var i=0;i<res1.length;i++){
		    	options = options + "<option value='"+res1[i].exam_centre_code+"' >"+res1[i].exam_centre_code+". "+res1[i].exam_centre_name+"</option>";
		   	} 
						
			//alert(options);
			$('#center_name1').html("");   //campusid from academicPeriod
			$('#center_name1').append(options);
			if(prefernce1_drop !=''){
				$('#center_name1').val(prefernce1_drop);
				$('#center_name1').trigger('change');
			}
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$('#center_name1').change(function(){
		preference1 = $('#center_name1').val();
		$('#center_name3').html("");
		$('#center_name3').append("<option value =''>Select Preference</option>");
		$.ajax({
			url:base_url+"ajax_controller/select_center_preference",
			type:"post",
			data:{preference1:preference1},
			success:function(response){  
				var options = "<option value =''>Select Preference</option>";
				var res1 = JSON.parse(response);
				//alert(res1); 
			   	for(var i=0;i<res1.length;i++){
			    	options = options + "<option value='"+res1[i].exam_centre_code+"' >"+res1[i].exam_centre_code+". "+res1[i].exam_centre_name+"</option>";
			   	} 
							
				//alert(options);
				$('#center_name2').html("");   //campusid from academicPeriod
				$('#center_name2').append(options);
				if(prefernce2_drop !=''){
					$('#center_name2').val(prefernce2_drop);
					$('#center_name2').trigger('change');
				}
				if(prefernce3_drop !=''){
					$('#center_name3').val(prefernce3_drop);
					
				}
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	});
	$('#center_name2').change(function(){
		preference1 = $('#center_name1').val();
		preference2 = $('#center_name2').val();
		$.ajax({
			url:base_url+"ajax_controller/select_center_preference",
			type:"post",
			data:{preference1:preference1,preference2:preference2},
			success:function(response){  
				var options = "<option value =''>Select Preference</option>";
				var res1 = JSON.parse(response);
				//alert(res1); 
			   	for(var i=0;i<res1.length;i++){
			    	options = options + "<option value='"+res1[i].exam_centre_code+"' >"+res1[i].exam_centre_code+". "+res1[i].exam_centre_name+"</option>";
			   	} 
							
				//alert(options);
				$('#center_name3').html("");   //campusid from academicPeriod
				$('#center_name3').append(options);
				if(prefernce3_drop !=''){
					$('#center_name3').val(prefernce3_drop);
					$('#frmApplicantDetails').data('bootstrapValidator').updateStatus('center_name3', 'NOT_VALIDATED',null).validateField('center_name3');
					//$('#center_name2').trigger('change');
				}
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	});
 	$("#cmbCommunity").change(function () {
 		
		var edit_status = $("#hidEditStatus").val();
		if(edit_status == 1)
		{
			swal({
				title: "Category Change",
				text: "If you change the category, you may need to pay extra fee.",
				//type: "error"
			},
			function(isConfirm) {
			  if (isConfirm) {
			  	//window.location.href = ("<?php echo base_url() ?>index/institute_login/ins/<?php echo $ins; ?>");
			  }
			});
		}
		var institutedata={
			category:$("#cmbCommunity").val()
		};
		$.ajax({
			url:base_url+"ajax_controller/select_category_eligibility_details",
			type:"post",
			data:institutedata,
			success:function(response){  
				var res1 = JSON.parse(response);
				document.getElementById("hidCatElig").value = res1;
				if(res1 == '0')
				{
					$("#cmbCommunity").val('');
					swal({
						title: "Sorry",
						text: "You are not eligible to apply this program under the selected category",
						type: "error"
					},
					function(isConfirm) {
					  if (isConfirm) {
					  	//window.location.href = ("<?php echo base_url() ?>index/institute_login/ins/<?php echo $ins; ?>");
					  }
					});
				}
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
    });
    $("#txtPercent1").change(function () {
 		var percent1 = $("#txtPercent1").val();
 		//alert(percent1);
 		//alert();
 		if(percent1.toString().indexOf('.') == -1)
 		{
			percent1 = percent1+'.00';
			$("#txtPercent1").val(percent1);
		}
		else
		{
			//alert(percent1.toString().split(".")[1].length);
			if(percent1.toString().split(".")[1].length < 2)
			{
				//alert("hello");
				percent1 = percent1+'0';
				$("#txtPercent1").val(percent1);
			}
			
		}
 		//$('#frmApply').data('bootstrapValidator').updateStatus('txtPercent1', 'VALID', null);
 	});
 	$("#txtPercent2").change(function () {
 		var percent1 = $("#txtPercent2").val();
 		//alert(percent1);
 		//alert();
 		if(percent1.toString().indexOf('.') == -1)
 		{
			percent1 = percent1+'.00';
			$("#txtPercent2").val(percent1);
		}
		else
		{
			//alert(percent1.toString().split(".")[1].length);
			if(percent1.toString().split(".")[1].length < 2)
			{
				//alert("hello");
				percent1 = percent1+'0';
				$("#txtPercent2").val(percent1);
			}
			
		}
 		//$('#frmApply').data('bootstrapValidator').updateStatus('txtPercent1', 'VALID', null);
 	});
 	$("#txtPercent3").change(function () {
 		var percent1 = $("#txtPercent3").val();
 		//alert(percent1);
 		//alert();
 		if(percent1.toString().indexOf('.') == -1)
 		{
			percent1 = percent1+'.00';
			$("#txtPercent3").val(percent1);
		}
		else
		{
			//alert(percent1.toString().split(".")[1].length);
			if(percent1.toString().split(".")[1].length < 2)
			{
				//alert("hello");
				percent1 = percent1+'0';
				$("#txtPercent3").val(percent1);
			}
			
		}
 		//$('#frmApply').data('bootstrapValidator').updateStatus('txtPercent1', 'VALID', null);
 	});
 	
 	$("#txtPercent4").change(function () {
 		var percent1 = $("#txtPercent4").val();
 		//alert(percent1);
 		//alert();
 		if(percent1.toString().indexOf('.') == -1)
 		{
			percent1 = percent1+'.00';
			$("#txtPercent4").val(percent1);
		}
		else
		{
			//alert(percent1.toString().split(".")[1].length);
			if(percent1.toString().split(".")[1].length < 2)
			{
				//alert("hello");
				percent1 = percent1+'0';
				$("#txtPercent4").val(percent1);
			}
			
		}
 		//$('#frmApply').data('bootstrapValidator').updateStatus('txtPercent1', 'VALID', null);
 	});
 	$("#txtPercent5").change(function () {
 		var percent1 = $("#txtPercent5").val();
 		//alert(percent1);
 		//alert();
 		if(percent1.toString().indexOf('.') == -1)
 		{
			percent1 = percent1+'.00';
			$("#txtPercent5").val(percent1);
		}
		else
		{
			//alert(percent1.toString().split(".")[1].length);
			if(percent1.toString().split(".")[1].length < 2)
			{
				//alert("hello");
				percent1 = percent1+'0';
				$("#txtPercent5").val(percent1);
			}
			
		}
 		//$('#frmApply').data('bootstrapValidator').updateStatus('txtPercent1', 'VALID', null);
 	});
    $("#txtPercent6").change(function () {
 		var percent1 = $("#txtPercent6").val();
 		//alert(percent1);
 		//alert();
 		if(percent1.toString().indexOf('.') == -1)
 		{
			percent1 = percent1+'.00';
			$("#txtPercent6").val(percent1);
		}
		else
		{
			//alert(percent1.toString().split(".")[1].length);
			if(percent1.toString().split(".")[1].length < 2)
			{
				//alert("hello");
				percent1 = percent1+'0';
				$("#txtPercent6").val(percent1);
			}
			
		}
 		//$('#frmApply').data('bootstrapValidator').updateStatus('txtPercent1', 'VALID', null);
 	});
    $("#txtPercent7").change(function () {
 		var percent1 = $("#txtPercent7").val();
 		//alert(percent1);
 		//alert();
 		if(percent1.toString().indexOf('.') == -1)
 		{
			percent1 = percent1+'.00';
			$("#txtPercent7").val(percent1);
		}
		else
		{
			//alert(percent1.toString().split(".")[1].length);
			if(percent1.toString().split(".")[1].length < 2)
			{
				//alert("hello");
				percent1 = percent1+'0';
				$("#txtPercent7").val(percent1);
			}
			
		}
 		//$('#frmApply').data('bootstrapValidator').updateStatus('txtPercent1', 'VALID', null);
 	});
	$("#txtPercent8").change(function () {
 		var percent1 = $("#txtPercent8").val();
 		//alert(percent1);
 		//alert();
 		if(percent1.toString().indexOf('.') == -1)
 		{
			percent1 = percent1+'.00';
			$("#txtPercent8").val(percent1);
		}
		else
		{
			//alert(percent1.toString().split(".")[1].length);
			if(percent1.toString().split(".")[1].length < 2)
			{
				//alert("hello");
				percent1 = percent1+'0';
				$("#txtPercent8").val(percent1);
			}
			
		}
 		//$('#frmApply').data('bootstrapValidator').updateStatus('txtPercent1', 'VALID', null);
 	});
 	$("#cmbidproof").change(function () {
 		if($("#txtidproof").val() == '')
 		{
			
		}
		else
		{
			$("#txtidproof").val('');
 			$('#frmApplicantDetails').data('bootstrapValidator').updateStatus('txtidproof', 'NOT_VALIDATED', null).validateField('txtidproof');  //for single field valdation
 	
		}
 	});
 	$("#txtgrading1").change(function () {
 		$("#txtPercent1").val('');
 		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtPercent1', 'NOT_VALIDATED', null).validateField('txtPercent1');  //for single field valdation
 	});
 	$("#txtgrading2").change(function () {
 		$("#txtPercent2").val('');
 		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtPercent2', 'NOT_VALIDATED', null).validateField('txtPercent2');  //for single field valdation
 	});
 	$("#txtgrading3").change(function () {
 		$("#txtPercent3").val('');
 		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtPercent3', 'NOT_VALIDATED', null).validateField('txtPercent3');  //for single field valdation
 	});
 	$("#txtgrading4").change(function () {
 		$("#txtPercent4").val('');
 		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtPercent4', 'NOT_VALIDATED', null).validateField('txtPercent4');  //for single field valdation
 	});
 	$("#txtgrading5").change(function () {
 		$("#txtPercent5").val('');
 		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtPercent5', 'NOT_VALIDATED', null).validateField('txtPercent5');  //for single field valdation
 	});
 	$("#txtgrading6").change(function () {
 		$("#txtPercent6").val('');
 		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtPercent6', 'NOT_VALIDATED', null).validateField('txtPercent6');  //for single field valdation
 	});
 	$("#txtgrading7").change(function () {
 		$("#txtPercent7").val('');
 		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtPercent7', 'NOT_VALIDATED', null).validateField('txtPercent7');  //for single field valdation
 	});
 	$("#txtgrading8").change(function () {
 		$("#txtPercent8").val('');
 		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtPercent8', 'NOT_VALIDATED', null).validateField('txtPercent8');  //for single field valdation
 	});
 	$("#txtGradingOth1").change(function () {
 		$("#txtCGPA1").val('');
 		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtCGPA1', 'NOT_VALIDATED', null).validateField('txtCGPA1');  //for single field valdation
 	});
 	$("#txtGradingOth2").change(function () {
 		$("#txtCGPA2").val('');
 		$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtCGPA2', 'NOT_VALIDATED', null).validateField('txtCGPA2');  //for single field valdation
 	});
 	$("#tab_a").click(function(){
 		$('input[type="submit"]').removeAttr('disabled');
 		//$("#frmApplicantDetails").bootstrapValidator(options).bootstrapValidator('validate');
 	}); 
 	
 	
 	
 	// First Tab
	$('#frmApplicantDetails').bootstrapValidator({
        message: 'This value is not valid',
        submitButtons: 'button[type="submit"]',
        //excluded: [':disabled'],
		submitHandler: function(validator, form, submitButton) 
		{
			var no_of_posts =  $('#cmbPostSelect option:selected').length;
			if(no_of_posts == 0)
			{
				toastr.error("Please select posts");
				$('#cmbPostSelect').focus();
			}
			else
			{
				var institutedata={
					selected_posts:$("#cmbPostSelect").val()
				};
				$.ajax({
					url:base_url+"ajax_controller/course_wise_date_eligibility",
					type:"post",
					data:institutedata,
					success:function(response){  
						var res1 = JSON.parse(response);
						if(res1.count == 0){
							swal({
								title: "Sorry",
								text: "You are not eligible for any post",
								type: "error"
							},
							function(isConfirm) {
							  if (isConfirm) {
							  	window.location.reload();
							  	//window.location.href = ("<?php echo base_url() ?>index/institute_login/ins/<?php echo $ins; ?>");
							  }
							});
						}
						else
						{
							var size_post = ($("#cmbPostSelect").val()).length;
							var size = (res1.course_codes).length;
							if(size_post == size)
							{
								var formData = new FormData(document.getElementById("frmApplicantDetails"));
								//ajax call to server
								$.ajax({
									url:base_url+"ajax_controller/save_applicant_details_temp",
									type:"post",
									data:formData,
									cache: false,
							        contentType: false,
							        processData: false,
									success:function(response)
									{  
										var obj = jQuery.parseJSON(response);
										if(obj.status == true)
										{
											$('.nav-tabs > .active').next('li').find('a').trigger('click');
											$("#tab_b").show(); 
										}
										else
										{
											toastr.error(obj.msg);
										}
										
									},
									error:function()
									{
										toastr.error('Unable to Save.Please Try Again ');	
									}
								});
							}
							else
							{
								$("#cmbPostSelect").val(res1.course_codes);
								swal({
									title: "Posts",
									text: 'You are not eligible for these posts. \n '+res1.course_name+'. Do you want to continue?',
									type: "error",
									  showCancelButton: true,
									  cancelButtonColor: "#DD6B55",
									  confirmButtonText: "Yes",
									  cancelButtonText: "Cancel",
									  closeOnConfirm: true,
									  closeOnCancel: true
									},
								function(isConfirm) {
								  if (isConfirm) {
									  	//swal.closeModal();
									    var formData = new FormData(document.getElementById("frmApplicantDetails"));
										//ajax call to server
										$.ajax({
											url:base_url+"ajax_controller/save_applicant_details_temp",
											type:"post",
											data:formData,
											cache: false,
									        contentType: false,
									        processData: false,
											success:function(response)
											{  
												var obj = jQuery.parseJSON(response);
												if(obj.status == true)
												{
													$('.nav-tabs > .active').next('li').find('a').trigger('click');
													$("#tab_b").show(); 
												}
												else
												{
													toastr.error(obj.msg);
												}
												
											},
											error:function()
											{
												toastr.error('Unable to Save.Please Try Again ');	
											}
										});
									  }else{
									  	//$('#cmbPostSelect :selected').attr('selected', '');
										var all = $(this);
										  $('#cmbPostSelect').each(function() {
										  		$(this).prop("checked", false);
										       ///$(this).prop("checked", all.prop("checked"));
										  });
									  	//$("#cmbPostSelect").prop("checked", false);
									  	//$("#cmbPostSelect").multiselect("uncheckAll");
									  	//$("#cmbPostSelect").val('');
									  	window.scrollTo(0, 0);
								  	//window.location.reload();	
								  }
								});
							}
							
						}
					},
					error:function(){
						toastr.error("We are unable to Process.Please contact Support");
					}
				});
			}
			
			
		},
        fields: {
			'cmbPostSelect[]': {
                validators: {
                    notEmpty: {
                        message: 'Please Select the Post'
                    }
                }
            },
			radiogender: {
                validators: {
                    notEmpty: {
                        message: 'Please Select the Gender'
                    }
                }
            },
            center_name1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
			center_name2: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
			center_name3: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            cmbExamCenter: {
                validators: {
                    notEmpty: {
                        message: 'Please Select the Exam Center'
                    }
                }
            },
            cmbPH: {
                validators: {
                    notEmpty: {
                        message: 'Please Select the type of Pwd'
                    }
                }
            },
			cmbCategory: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }, 
            cmbDcOffice: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }, 
			txtFatherName: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z. ]+)$/,
                        message: "Only Alphabets and (.) are allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
                }
            },
			txtMotherName: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z. ]+)$/,
                        message: "Only Alphabets and (.) are allowed"
					},  
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
                }
            },
            
			txtPresentAddress:{
				validators: {
					notEmpty: {
						message: 'Required'
					},
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
			txtPresentLocality:{
				validators: {
					notEmpty: {
						message: 'Required'
					},
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
			txtPresentPost:{
				validators: {
					notEmpty: {
						message: 'Required'
					},
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
			cmbPresentState:{
						validators: {
							notEmpty: {
								message: 'Required'
							}
						}
			},
			cmbPresentDist:{
						validators: {
							notEmpty: {
								message: 'Required'
							}
						}
			},
			txtPresentPin:{
				validators: {
					notEmpty: {
						message: 'Required'
					},
							
					digits: {
							message: 'The value can contain only digits'
						}, 
					stringLength: {
						max: 6,
						min:6,
						message: 'Pin no must be 6 characters long'
					}
				}
			},
			txtPermanentPin:{
						validators: {
							notEmpty: {
							message: 'Required'
						},
							digits: {
							message: 'The value can contain only digits'
						}, 
					stringLength: {
						max: 6,
						min:6,
						message: 'Pin no must be 6 characters long'
					}
				}
			},
		   
		   txtPermenentLocality: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "Only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
		   txtPermanentPost: {
                validators: {
                	notEmpty: {
						message: 'Required'
					},
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "Only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
		   city_name1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "Only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
		   cmbPermanentState: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
		   cmbPermanentDist: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			radioPhysicallY: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			radioService: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			radioSports: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			cmbCommunity: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			city_name: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: /^([a-zA-Z0-9-\n\r \/.,();]+)$/,
                        message: "only Alphabet,Numbers and These . , - / ( ) ; Symbols are  allowed"
					}, 
					stringLength: {
						max: 80,
						message: 'Maximum 80 character`s are allowed'
					}
				}
			},
			
			
			cmbidproof: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtidproof: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
					callback: {
                        message: 'Invalid Id proof Number<br>',
                        callback: function (value, validator, $field) {
                        	 id_proof = document.getElementById("cmbidproof").value;
                        	 aadhar_regexp = /^\d{4}\s\d{4}\s\d{4}$/;
                        	 aadhar_regexp12 = /^\d{12}$/;
                        	 //voter_regexp = /^([a-zA-Z]){3}([0-9]){7}?$/;
                        	 voter_regexp = /^([a-zA-Z0-9-\n\r \/]+)$/;
                        	 pan_regexp = /^[A-Za-z]{5}\d{4}[A-Za-z]{1}$/;
                            if(id_proof  == 'AADHAR' )
							{
								
								if(aadhar_regexp.test(document.getElementById("txtidproof").value) == false && aadhar_regexp12.test(document.getElementById("txtidproof").value) == false)
								{
	                                return false;
	                                /*message: 'Only Numbers Are allowed in Aadhar Number'
	                                return {
										valid: false,    // or false
            							message: 'Only Numbers Are allowed in Aadhar Number'
									};*/
								}
								else
								{
									return true;
								}
								
							}
							else if(id_proof  == 'PAN')
							{
								if(pan_regexp.test(document.getElementById("txtidproof").value) == false)
								{
	                                return false;
	                               
								}
								else
								{
									return true;
								}
							}
							else{
								if(voter_regexp.test(document.getElementById("txtidproof").value) == false)
								{
	                                return false;
	                               
								}
								else
								{
									return true;
								}
							}
                        }
                    }
				}
			}
			
        }
    });
	// Second Tab
	$('#frmAcademicInfo').bootstrapValidator({
        message: 'This value is not valid',
        submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			
			var formData = new FormData(document.getElementById("frmAcademicInfo"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/save_applicant_academic_details_temp",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response)
				{  
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
						
						$('.customtab a[href="#info_tab"]').click();
						$("#tab_b").show(); 
						$("#tab_c").show(); 
						
					}
					else
					{
						toastr.error(obj.msg);
					}
					
				},
				error:function()
				{
					toastr.error('Unable to Save.Please Try Again ');	
				}
			});
		},
        fields: {
        	txtStream1:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }/*,
					callback: {
                        callback: function (value, validator, $field) {
                        	if($("#txtExamName1").val() == '')
                        	{
								$('#frmAcademicInfo').data('bootstrapValidator').updateStatus('txtStream1', 'VALID', null);
								return true;
							}
							else
							{
								return false;
							}
                        }
                    }*/
                }
			},
			txtYearQual1:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                }
			},
			txtBoardOth1:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                }
			},
			txtDiv1:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                }
			},
			txtGradingOth1:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                }
			},
			txtStream2:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                }
			},
			txtYearQual2:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                }
			},
			txtBoardOth2:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                }
			},
			txtDiv2:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                }
			},
			txtGradingOth2:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                }
			},
			radioComputer: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
        	txtYear1: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: 'Year must be greater </br> than birth year and </br> less than current year',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtYear2: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: '<ul type="disc" style="list-style: outside;"><li> Year must be greater </br> than birth year and </br> less than current year. </li><li>Senior Secondary Qualification </br>Year must be greater then </br>Secondary Qualification Year</li></ul>',
                        callback: function (value, validator, $field) {
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else if(parseInt(document.getElementById("txtYear1").value) > parseInt(value))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtYear3: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: '<ul type="disc" style="list-style: outside;"><li> Year must be greater </br> than birth year and </br> less than current year. </li><li>Diploma Qualification </br>Year must  be  greater then </br> Secondary Qualification Year</li></ul>',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else if(parseInt(document.getElementById("txtYear2").value) > parseInt(value))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtYear4: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: '<ul type="disc" style="list-style: outside;"><li> Year must be greater </br> than birth year and </br> less than current year. </li><li>Graduation Qualification </br>Year must  be  greater then </br> Diploma Qualification Year</li></ul>',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else if(parseInt(document.getElementById("txtYear3").value) > parseInt(value))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtYear5: {
                validators: {
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: '<ul type="disc" style="list-style: outside;"><li> Year must be greater </br> than birth year and </br> less than current year. </li><li>Graduation Qualification </br>Year must  be  greater then </br> Diploma Qualification Year</li></ul>',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else if(parseInt(document.getElementById("txtYear4").value) > parseInt(value))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtYear6: {
                validators: {
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: '<ul type="disc" style="list-style: outside;"><li> Year must be greater </br> than birth year and </br> less than current year. </li><li>Graduation Qualification </br>Year must  be  greater then </br> Diploma Qualification Year</li></ul>',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else if(parseInt(document.getElementById("txtYear5").value) > parseInt(value))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtYear8: {
                validators: {
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: '<ul type="disc" style="list-style: outside;"><li> Year must be greater </br> than birth year and </br> less than current year. </li><li>Graduation Qualification </br>Year must  be  greater then </br> Diploma Qualification Year</li></ul>',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else if(parseInt(document.getElementById("txtYear7").value) > parseInt(value))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtYear7: {
                validators: {
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: '<ul type="disc" style="list-style: outside;"><li> Year must be greater </br> than birth year and </br> less than current year. </li><li>Graduation Qualification </br>Year must  be  greater then </br> Diploma Qualification Year</li></ul>',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else if(parseInt(document.getElementById("txtYear6").value) > parseInt(value))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtTechnical_5_2: {
                validators: {
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: '<ul type="disc" style="list-style: outside;"><li> Year must be greater </br> than birth year and </br> less than current year. </li><li>Graduation Qualification </br>Year must  be  greater then </br> Diploma Qualification Year</li></ul>',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtTechnical_6_2: {
                validators: {
                    integer: {
                        message: 'invalid year'
                    }, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Year must be 4 digit number'
					},
					callback: {
                        message: '<ul type="disc" style="list-style: outside;"><li> Year must be greater </br> than birth year and </br> less than current year. </li><li>PhD Qualification </br>Year must  be  greater then </br> Diploma Qualification Year</li></ul>',
                        callback: function (value, validator, $field) {
                            // Determine the numbers which are generated in captchaOperation
                            if(parseInt(todayyear) < parseInt(value))
							{
								return false;
							}else if( parseInt(value) < parseInt(birthyear))
							{
								return false;
							}else if(parseInt(document.getElementById("txtTechnical_5_2").value) > parseInt(value))
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtBoard1: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
					stringLength: {
						max: 50,
						message: 'Maximum 50 character`s are allowed'
					},
                    regexp: {
                        regexp: /^([a-zA-Z-\n\r \/.,();]+)$/,
                        message: "Only Alphabet and </br> These . , - / ( ) ; Symbols are  allowed"
					}
				}
			},
			txtBoard2: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
					stringLength: {
						max: 50,
						message: 'Maximum 50 character`s are allowed'
					},
                    regexp: {
                        regexp: /^([a-zA-Z-\n\r \/.,();]+)$/,
                        message: "Only Alphabet and </br> These . , - / ( ) ; Symbols are  allowed"
					}
				}
			},
			txtBoard3: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
					stringLength: {
						max: 50,
						message: 'Maximum 50 character`s are allowed'
					},
                    regexp: {
                        regexp: /^([a-zA-Z-\n\r \/.,();]+)$/,
                        message: "Only Alphabet and </br> These . , - / ( ) ; Symbols are  allowed"
					}
				}
			},
			txtBoard4: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
					stringLength: {
						max: 50,
						message: 'Maximum 50 character`s are allowed'
					},
                    regexp: {
                        regexp: /^([a-zA-Z-\n\r \/.,();]+)$/,
                        message: "Only Alphabet and </br> These . , - / ( ) ; Symbols are  allowed"
					}
				}
			},
			txtFM1: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
					stringLength: {
						max: 4,
						message: 'Maximum 4 digit number`s are allowed'
					},
					integer: {
                        message: 'Invalid Number'
                    },
					callback: {
                        message: 'Maximum mark must be </br> greater than mark secured',
                        callback: function (value, validator, $field) {
                            if(parseInt(document.getElementById("txtMS1").value) > parseInt(value) )
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtFM2: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
					stringLength: {
						max: 4,
						message: 'Maximum 4 digit number`s are allowed'
					},
					integer: {
                        message: 'Invalid Number'
                    },
					callback: {
                        message: 'Maximum mark must be </br> greater than mark secured',
                        callback: function (value, validator, $field) {
                            if(parseInt(document.getElementById("txtMS2").value) > parseInt(value) )
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtFM3: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
					stringLength: {
						max: 4,
						message: 'Maximum 4 digit number`s are allowed'
					},
					integer: {
                        message: 'Invalid Number'
                    },
					callback: {
                        message: 'Maximum mark must be </br> greater than mark secured',
                        callback: function (value, validator, $field) {
                            if(parseInt(document.getElementById("txtMS3").value) > parseInt(value) )
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtFM4: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
					stringLength: {
						max: 4,
						message: 'Maximum 4 digit number`s are allowed'
					},
					integer: {
                        message: 'Invalid Number'
                    },
					callback: {
                        message: 'Maximum mark must be </br> greater than mark secured',
                        callback: function (value, validator, $field) {
                            if(parseInt(document.getElementById("txtMS3").value) > parseInt(value) )
							{
								return false;
							}else{
								return true;
							}
                        }
                    }
				}
			},
			txtqual22: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtqual23: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtqual24: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtOther_grad1: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtOther_grad2: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtOther_grad3: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtOther_grad4: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtOther_grad5: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtgrading1: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtgrading2: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtgrading3: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtgrading4: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtdistinct1: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtdistinct2: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			
			txtdistinct3: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtdistinct4: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtPercent1: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                   
                    callback: {
                        message: 'Please give correct CGPA/%<br>',
                        callback: function (value, validator, $field) {
                        	 pattern = /^[^0]\d*$/;
                        	 if(pattern.test(document.getElementById("txtidproof").value) == false)
							{
                                return false;
                               
							}
							else
							{
								 if(document.getElementById("txtgrading1").value  == 'YES' )
								{
									var totalMarkX = value;
									var numX = parseFloat(totalMarkX);
									//console.info(numX);return;
									if(numX > 10.00)
									{
		                                return false;
									}
									else{
										return true;
									} 
									
								}
								if(document.getElementById("txtgrading1").value  == 'NO'){
									var numX = parseFloat(value);
									
									if(numX > 100.00){
										return false;
									}
									else{
										return true;
									}
								}
							}
                           
							return true; 
                        }
                    }
				}
            },
			txtPercent3: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                    
					callback: {
                        message: 'Please give correct CGPA/%<br>',
                        callback: function (value, validator, $field) {
                            if(document.getElementById("txtgrading3").value  == 'YES' )
							{
								var totalMarkX = value;
								var numX = parseFloat(totalMarkX);
								//console.info(numX);return;
								if(numX > 10.00)
								{
	                                return false;
								}
								else{
									return true;
								}
								
							}
							if(document.getElementById("txtgrading3").value  == 'NO'){
								//var totalMarkX = value;
								var numX = parseFloat(value);
								
								if(numX > 100.00){
									return false;
								}
							}
							return true;
                        }
                    }
				}
			},
			txtPercent2: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                    callback: {
                        message: 'Please give correct CGPA/%<br>',
                        callback: function (value, validator, $field) {
                            if(document.getElementById("txtgrading2").value  == 'YES' )
							{
								var totalMarkX = value;
								var numX = parseFloat(totalMarkX);
								//console.info(numX);return;
								if(numX > 10.00)
								{
	                                return false;
								}
								else{
									return true;
								}
								
							}
							if(document.getElementById("txtgrading2").value  == 'NO'){
								//var totalMarkX = value;
								var numX = parseFloat(value);
								
								if(numX > 100.00){
									return false;
								}
							}
							return true;
                        }
                    }
				}
			},
			txtPercent4: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                    callback: {
                      message: 'Please give correct CGPA/%<br>',
                        callback: function (value, validator, $field) {
                            if(document.getElementById("txtgrading4").value  == 'YES' )
							{
								var totalMarkX = value;
								var numX = parseFloat(totalMarkX);
								//console.info(numX);return;
								if(numX > 10.00)
								{
	                                return false;
								}
								else{
									return true;
								}
								
							}
							if(document.getElementById("txtgrading4").value  == 'NO'){
								var numX = parseFloat(value);
								
								if(numX > 100.00){
									return false;
								}
							}
							return true;
                        }
                    }
				}
			},
			txtPercent5: {
                validators: {
                    callback: {
                       message: 'Please give correct CGPA/%<br>',
                        callback: function (value, validator, $field) {
                            if(document.getElementById("txtgrading5").value  == 'YES' )
							{
								var totalMarkX = value;
								var numX = parseFloat(totalMarkX);
								//console.info(numX);return;
								if(numX > 10.00)
								{
	                                return false;
								}
								else{
									return true;
								}
								
							}
							if(document.getElementById("txtgrading5").value  == 'NO'){
								//var totalMarkX = value;
								var numX = parseFloat(value);
								
								if(numX > 100.00){
									return false;
								}
							}
							return true;
                        }
                    }
				}
			},
			txtPercent6: {
                validators: {
                    callback: {
                        message: 'Please give correct CGPA/%<br>',
                        callback: function (value, validator, $field) {
                            if(document.getElementById("txtgrading6").value  == 'YES' )
							{
								var totalMarkX = value;
								var numX = parseFloat(totalMarkX);
								//console.info(numX);return;
								if(numX > 10.00)
								{
	                                return false;
								}
								else{
									return true;
								}
								
							}
							if(document.getElementById("txtgrading6").value  == 'NO'){
								var numX = parseFloat(value);
								
								if(numX > 100.00){
									return false;
								}
							}
							return true;
                        }
                    }
				}
			},
			txtPercent7: {
                validators: {
                    callback: {
                       message: 'Please give correct CGPA/%<br>',
                        callback: function (value, validator, $field) {
                            if(document.getElementById("txtgrading7").value  == 'YES' )
							{
								var totalMarkX = value;
								var numX = parseFloat(totalMarkX);
								//console.info(numX);return;
								if(numX > 10.00)
								{
	                                return false;
								}
								else{
									return true;
								}
								
							}
							if(document.getElementById("txtgrading7").value  == 'NO'){
								var numX = parseFloat(value);
								
								if(numX > 100.00){
									return false;
								}
							}
							return true;
                        }
                    }
				}
			},
			txtPercent8: {
                validators: {
                    callback: {
                        message: 'Please give correct CGPA/%<br>',
                        callback: function (value, validator, $field) {
                            if(document.getElementById("txtgrading8").value  == 'YES' )
							{
								var totalMarkX = value;
								var numX = parseFloat(totalMarkX);
								//console.info(numX);return;
								if(numX > 10.00)
								{
	                                return false;
								}
								else{
									return true;
								}
								
							}
							if(document.getElementById("txtgrading8").value  == 'NO'){
								var numX = parseFloat(value);
								
								if(numX > 100.00){
									return false;
								}
							}
							return true;
                        }
                    }
				}
			},

			txtCGPA1: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                    callback: {
                        message: 'Please give correct CGPA/%<br>',
                        callback: function (value, validator, $field) {
                            if(document.getElementById("txtGradingOth1").value  == 'YES' )
							{
								var totalMarkX = value;
								var numX = parseFloat(totalMarkX);
								//console.info(numX);return;
								if(numX > 10.00)
								{
	                                return false;
								}
								else{
									return true;
								}
								
							}
							if(document.getElementById("txtGradingOth1").value  == 'NO'){
								var numX = parseFloat(value);
								
								if(numX > 100.00){
									return false;
								}
							}
							return true;
                        }
                    }
					
				}
			},
			txtCGPA2: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    },
                   callback: {
                       message: 'Please give correct CGPA/%<br>',
                        callback: function (value, validator, $field) {
                            if(document.getElementById("txtGradingOth2").value  == 'YES' )
							{
								var totalMarkX = value;
								var numX = parseFloat(totalMarkX);
								//console.info(numX);return;
								if(numX > 10.00)
								{
	                                return false;
								}
								else{
									return true;
								}
								
							}
							if(document.getElementById("txtGradingOth2").value  == 'NO'){
								var numX = parseFloat(value);
								
								if(numX > 100.00){
									return false;
								}
							}
							return true;
                        }
                    }
				}
			}
        }
    });
	// Third Tab
	$('#frmInfoDetails').bootstrapValidator({
        message: 'This value is not valid',
        submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			var formData = new FormData(document.getElementById("frmInfoDetails"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/save_applicant_info_temp",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response)
				{  
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
						$('.nav-tabs > .active').next('li').find('a').trigger('click');
						$("#tab_b").show(); 
						$("#tab_c").show(); 
						$("#tab_d").show(); 
					}
					else 
					{
						toastr.error(obj.msg);
					}
					
				},
				error:function()
				{
					toastr.error('Unable to Save.Please Try Again ');	
				}
			});
		},
        fields: {
			empGovt:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			chkInformed:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtNameOfOffice:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtDOJ:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtNameOfPost:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			empDisciplinary:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtDateOfDebar:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtPeriodOfDebar:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			}
        }
    });
	// Fourth Tab
	$('#frmDeclaration').bootstrapValidator({
        message: 'This value is not valid',
        submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			var formData = $('#frmApplicantDetails, #frmAcademicInfo, #frmInfoDetails, #frmDeclaration').serialize();
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/add_application_data_02",
				type:"post",
				data:formData,
				success:function(response)
				{  
					var obj = jQuery.parseJSON(response);
					if(obj.status == true)
					{
						var ins = $("#hidInsCode").val();
						var edit_status = $("#hidEditStatus").val();
						$("#tab_b").show(); 
						$("#tab_c").show(); 
						$("#tab_d").show(); 
						if(edit_status != '')
						{
							window.open(base_url+"Apply/apply_3/ins/"+ins+"/edit/1","_self");
						}
						else
						{
							window.open(base_url+"Apply/apply_3/ins/"+ins,"_self");
						}
						//window.open(base_url+"Apply/apply_3/ins/"+ins,"_self");
					}
					else
					{
						toastr.error(obj.msg);
					}
					
				},
				error:function()
				{
					toastr.error('Unable to Save.Please Try Again ');	
				}
			});
		},
        fields: {
			chkUndertaking1: {
                validators: {
                    notEmpty: {
                        message: 'Please Check Declaration'
                    }
                }
            }
        }
    });

 	
 	
 	
	$('.btnNext').click(function(){
		$('.nav-tabs > .active').next('li').find('a').trigger('click');
	});

	$('.btnPrevious').click(function(){
		$('.nav-tabs > .active').prev('li').find('a').trigger('click');
	});
	
	$("#forReservedQuota").hide();
	$("#onlineMode").hide();
	$("#offlineMode").hide();
	//$("#divAcademicInfoAppeared").hide();
	if($("input[name=mode]:checked").val()=="Offline")
	{
		$("#onlineMode").hide();
		$("#offlineMode").show();
		$("#forReservedQuota").show();
		
	}
	if($("input[name=mode]:checked").val()=="Online")
	{
		$("#onlineMode").show();
		//$("#forReservedQuota").show();
		$("#offlineMode").hide();
		//$("#divAcademicInfoAppeared").show();
	}
	$("#modeOffline").click(function () {
        $("#onlineMode").hide();
		$("#offlineMode").show();
		$("#forReservedQuota").show();
    });
	$("#modeOnline").click(function () {
        $("#onlineMode").show();
        $("#forReservedQuota").show();
		$("#offlineMode").hide();
    });
	
	
	/*if($("input[name=radioMarkSheet]:checked").val()=="Yes")
	{
		$("#divAcademicInfo").show();
		$("#GRADUTION").show();
		$("#radioNoGradCert").show();
		$("#radioGradMarkSheet").show();
		$( "#txtMS1" ).prop( "disabled", false);
		$( "#txtFM1" ).prop( "disabled", false);
		
		
	}
	if($("input[name=radioMarkSheet]:checked").val()=="No")
	{
		$("#divAcademicInfo").show();
		$("#GRADUTION").show();
		$("#radioNoGradCert").hide();
		$("#radioGradMarkSheet").hide();
		$( "#txtMS1" ).prop( "disabled", true);
		$( "#txtFM1" ).prop( "disabled", true);
		$("#txtMS1").val('')
		$("#txtFM1").val('')
		$("#txtPercent1").val('')
		
		
	}*/
	
	
	
	if($("input[name=radioQuota]:checked").val()=="Yes")
	{
		$("#forReservedQuota").show();
	}
	if($("input[name=radioQuota]:checked").val()=="No")
	{
		$("#forReservedQuota").hide();
	}
	$("#radioyes").click(function () {
        $("#forReservedQuota").show();	
    });
	$("#radiono").click(function () {
        $("#forReservedQuota").hide();	
    });
    
   /* $("#radioYesMarks").click(function () {
        $("#divAcademicInfo").show();	
        $("#GRADUTION").show();	
        $("#radioNoGradCert").show();
		$("#radioGradMarkSheet").show();
		$("#txtMS1").prop( "disabled", false);
		$("#txtFM1").prop( "disabled", false);
        //$("#divAcademicInfoAppeared").hide();	
    });
    
	$("#radioNoMarks").click(function () {
        $("#divAcademicInfo").show();	
        $("#GRADUTION").show();	
        $("#radioNoGradCert").hide();
		$("#radioGradMarkSheet").hide();
		
		$("#txtMS1").prop( "disabled", true);
		$("#txtFM1").prop( "disabled", true);
		$("#txtMS1").val('')
		$("#txtFM1").val('')
		$("#txtPercent1").val('')
		
        //$("#divAcademicInfoAppeared").show();	
    });*/
    $("#divPH").hide();
	if($("input[name=radioPhysicallY]:checked").val()=="YES")
	{
		$("#divPH").show();	
	}
	else
	{
		$("#divPH").hide();
	}
	$("#radioPhysicallYY").click(function () {
        $("#divPH").show();	
    });
    $("#radioPhysicallYN").click(function () {
        $("#divPH").hide();
    });
    
    $("#divEmpSuspendedInfo").hide();
	if($("input[name=empGovt]:checked").val()=="YES")
	{
		$("#divEmpSuspendedInfo").show();	
	}
	else
	{
		$("#divEmpSuspendedInfo").hide();
		$("#chkInformed"). prop("checked", false);
		$("#txtNameOfOffice").val("");
        $("#txtDOJ").val("");
        $("#txtNameOfPost").val("");
		
		 var d = $("#cmbDay").val();
		var m = $("#cmbMonth").val();
		var y = $("#cmbYear").val();
		 var startDate =  d + "-"+m+"-"+y;
		//options + "<option value="+data.template_code+">"+data.template_name+"</option>"
       $("#txtDOJ").datepicker({
			format: "dd-mm-yyyy",
			todayHighlight:true,
			autoclose:true,
		}).datepicker('setEndDate', new Date()).on('changeDate', function (selected) {
			$('#frmInfoDetails').data('bootstrapValidator').updateStatus('txtDOJ', 'NOT_VALIDATED').validateField('txtDOJ');
		    $("#txtDOJ").datepicker().datepicker("setStartDate", startDate);
		});
		
		
	}
	$("#empGovtyes").click(function () {
        $("#divEmpSuspendedInfo").show();	
    });
    $("#empGovtno").click(function () {
        $("#divEmpSuspendedInfo").hide();
		$("#chkInformed"). prop("checked", false);
        $("#txtNameOfOffice").val("");
        $("#txtDOJ").val("");
        $("#txtNameOfPost").val("");
        
        var d = $("#cmbDay").val();
		var m = $("#cmbMonth").val();
		var y = $("#cmbYear").val();
		 var startDate =  d + "-"+m+"-"+y; 
		//options + "<option value="+data.template_code+">"+data.template_name+"</option>"
       $("#txtDOJ").datepicker({
			format: "dd-mm-yyyy",
			todayHighlight:true,
			autoclose:true,
		}).datepicker('setEndDate', new Date()).on('changeDate', function (selected) {
			$('#frmInfoDetails').data('bootstrapValidator').updateStatus('txtDOJ', 'NOT_VALIDATED').validateField('txtDOJ');
		    $("#txtDOJ").datepicker().datepicker("setStartDate", startDate);
		});
    });
    
    $("#divEmpDisciplinaryInfo").hide();
	if($("input[name=empDisciplinary]:checked").val()=="YES")
	{
		$("#divEmpDisciplinaryInfo").show();	
	}
	else
	{
		$("#divEmpDisciplinaryInfo").hide();
		$("#txtDateOfDebar").val("");
        $("#txtPeriodOfDebar").val("");
        
        var d = $("#cmbDay").val();
		var m = $("#cmbMonth").val();
		var y = $("#cmbYear").val();
		 var startDate =  d + "-"+m+"-"+y; 	
       $("#txtDateOfDebar").datepicker({
			format: "dd-mm-yyyy",
			todayHighlight:true,
			autoclose:true,
		}).datepicker('setEndDate', new Date()).on('changeDate', function (selected) {
			$('#frmInfoDetails').data('bootstrapValidator').updateStatus('txtDateOfDebar', 'NOT_VALIDATED').validateField('txtDateOfDebar');
		    $("#txtDateOfDebar").datepicker().datepicker("setStartDate", startDate);
		});
    
	}
	$("#empDisciplinaryyes").click(function () {
        $("#divEmpDisciplinaryInfo").show();	
    });
    $("#empDisciplinaryno").click(function () {
        $("#divEmpDisciplinaryInfo").hide();
        $("#txtDateOfDebar").val("");
        $("#txtPeriodOfDebar").val("");
       
		 var d = $("#cmbDay").val();
		var m = $("#cmbMonth").val();
		var y = $("#cmbYear").val();
		 var startDate =  d + "-"+m+"-"+y; 
       $("#txtDateOfDebar").datepicker({
			format: "dd-mm-yyyy",
			todayHighlight:true,
			autoclose:true,
		}).datepicker('setEndDate', new Date()).on('changeDate', function (selected) {
			$('#frmInfoDetails').data('bootstrapValidator').updateStatus('txtDateOfDebar', 'NOT_VALIDATED').validateField('txtDateOfDebar');
		    $("#txtDateOfDebar").datepicker().datepicker("setStartDate", startDate);
		});
   
    });
    
	if($("input[name=radioCourseType]:checked").val()=="Honours")
	{
		$("#tablePass").show();	
        $("#tableHonours").show();
	}
	if($("input[name=radioCourseType]:checked").val()=="Pass")
	{
		$("#tablePass").show();	
        $("#tableHonours").hide();
	}
	
    $("#radioHonours").click(function () {
        $("#tablePass").show();	
        $("#tableHonours").show();	
    });
    $("#radioPass").click(function () {
        $("#tablePass").show();	
        $("#tableHonours").hide();	
    });
	$('#txtFirstName').on('keyup', function(e) {
		//console.log(e.which);
		if(e.which != 37 && e.which != 39 && e.which != 8 )
		{
			var str = document.getElementById("txtFirstName").value;
		    var res = str.toUpperCase();
		    document.getElementById("txtFirstName").value = res;
		}
 	});
	$('#txtMiddleName').on('keydown', function(e) {
		//console.log(e.which);
		if(e.which != 37 && e.which != 39 )
		{
			var str = document.getElementById("txtMiddleName").value;
		    var res = str.toUpperCase();
		    document.getElementById("txtMiddleName").value = res;
		}
 	});
	$('#txtMiddleName').on('keyup', function(e) {
		//console.log(e.which);
		if(e.which != 37 && e.which != 39 )
		{
			var str = document.getElementById("txtMiddleName").value;
		    var res = str.toUpperCase();
		    document.getElementById("txtMiddleName").value = res;
		}
 	});
	$('#txtMiddleName').on('keydown', function(e) {
		console.log(e.which);
		if(e.which != 37 && e.which != 39 )
		{
			var str = document.getElementById("txtMiddleName").value;
		    var res = str.toUpperCase();
		    document.getElementById("txtMiddleName").value = res;
		}
 	});
	$('#txtMiddleName').on('keyup', function(e) {
		console.log(e.which);
		if(e.which != 37 && e.which != 39 )
		{
			var str = document.getElementById("txtMiddleName").value;
		    var res = str.toUpperCase();
		    document.getElementById("txtMiddleName").value = res;
		}
 	});
	$('#txtLastName').on('keydown', function(e) {
		console.log(e.which);
		if(e.which != 37 && e.which != 39 )
		{
			var str = document.getElementById("txtLastName").value;
		    var res = str.toUpperCase();
		    document.getElementById("txtLastName").value = res;
		}
 	});
	$('#txtLastName').on('keyup', function(e) {
		console.log(e.which);
		if(e.which != 37 && e.which != 39 )
		{
			var str = document.getElementById("txtLastName").value;
		    var res = str.toUpperCase();
		    document.getElementById("txtLastName").value = res;
		}
 	});
	$('#txtFirstName').on('change', function(e) {
		//console.log(e.which);
		var str = document.getElementById("txtFirstName").value;
		var res = str.toUpperCase();
		document.getElementById("txtFirstName").value = res;
		
 	});
	
  	$('#txtMiddleName').on('change', function(e)  {
	 	var str = document.getElementById("txtMiddleName").value;
	    var res = str.toUpperCase();
	    document.getElementById("txtMiddleName").value = res;
	});
	$('#txtLastName').on('change', function(e) {
	 	var str = document.getElementById("txtLastName").value;
	    var res = str.toUpperCase();
	    document.getElementById("txtLastName").value = res;
	});
	
	
	$('.alert').hide();
	$("#forminority").hide();
	if($("input[name=radiominority]:checked").val()=="Yes")
	{
		$("#forminority").show();
	}
    $("#radioyes").click(function () {
        $("#forminority").show();	
    });
    $("#radiono").click(function () {
        $("#forminority").hide();
		$("#cmbMinority").val("");
    });
	$("#forillness").hide();
	if($("input[name=radioIllness]:checked").val()=="Yes")
	{
		$("#forillness").show();
	}
    $("#radioYesIllness").click(function () {
        $("#forillness").show();	
    });
    $("#radioNoIllness").click(function () {
        $("#forillness").hide();
		$("#txtChronicIllness").val("");
    });
	$("#forAllergies").hide();
	if($("input[name=radioAllergies]:checked").val()=="Yes")
	{
		$("#forAllergies").show();
	}
    $("#radioYesAllergies").click(function () {
        $("#forAllergies").show();	
    });
    $("#radioNoAllergies").click(function () {
        $("#forAllergies").hide();
		$("#txtAllergies").val("");
    });
	
	if($("input[name=chksameasresidential]:checked").val()=="Y")
	{
		$('#txtPermenentAddress').attr('disabled', true);
		$('#txtPermenentLocality').attr('disabled', true);
		$('#txtPermanentPost').attr('disabled', true);
		$('#cmbPermanentDist').attr('disabled', true);
		$('#cmbPermanentState').attr('disabled', true);
		$('#txtPermanentPin').attr('disabled', true);
		$('#txtOtherPermanentState').attr('disabled', true);
		$('#txtOtherPermanentDist').attr('disabled', true);
		$('#cand_name1').attr('disabled', true);
		$('#co_name1').attr('disabled', true);
		$('#city_name1').attr('disabled', true);
		$('#phone_no1').attr('disabled', true);
	}
	$("#txtUnivName").change(function () {
		if($("#txtUnivName").val()=="OTH")
		{
			$("#forOtherUniv").show();
		}
		else
		{
			$("#forOtherUniv").hide();
			$("#txtOtherUniversity").val("");
		}
    });
	$("#txtHonoursSubject").change(function () {
		if($("#txtHonoursSubject").val()=="OTH")
		{
			$("#forOtherSubject").show();
		}
		else
		{
			$("#forOtherSubject").hide();
			$("#txtOtherSubject").val("");
		}
    });
	if($("#txtHonoursSubject").val()=="OTH")
	{
		$("#forOtherSubject").show();
	}
	if($("#txtUnivName").val()=="OTH")
	{
		$("#forOtherUniv").show();
	}
	$("#cmbNationality").change(function () {
		if($("#cmbNationality").val()=="OTH")
		{
			$("#cmbCommunity").val("GEN");
			//$("input[name=radiobelong]").val("NO");
			$("input[name=radiobelong]").attr('disabled', true);
			$("#cmbCommunity").prop("disabled", true);
		}
		else
		{
			$("#forNationality").hide();
			$("#txtOtherNationality").val("");
			$("#cmbCommunity").prop("disabled", false);
			$("input[name=radiobelong]").attr('disabled', false);
		}
    });
	if($("#cmbNationality").val()=="OTH")
	{
		$("#forNationality").show();
		$("#cmbCommunity").val("GEN");
		//$("input[name=radiobelong]").val("NO");
		$("input[name=radiobelong]").attr('disabled', true);
		$("#cmbCommunity").prop("disabled", true);
	}


	$("#cmbrelationship").change(function () {
		if($("#cmbrelationship").val()=="OTH")
		{
			$("#forRelationship").show();
		}
		else
		{
			$("#forRelationship").hide();
			$("#txtOtherRelations").val("");
		}
    });
	if($("#cmbrelationship").val()=="OTH")
	{
		$("#forRelationship").show();
	}

	
	$("#cmbBoardName").change(function () {
		if($("#cmbBoardName").val()=="OTH")
		{
			$("#forBoard").show();
		}
		else
		{
			$("#forBoard").hide();
			$("#txtOtherBoard").val("");
		}
    });
	if($("#cmbBoardName").val()=="OTH")
	{
		$("#forBoard").show();
	}
	
	$("#cmbExamTypeX").change(function () {
        var examType=$("#cmbExamTypeX").val();
		if(examType == "SA-I")
		{
			$("#cmbMarkTypeX").val("CGPA");
		}
		else if(examType == "Half_Yearly_Examination")
		{
			$("#cmbMarkTypeX").val("Percentage");
		}
		else
		{
			$("#cmbMarkTypeX").val("");
		}
    });
	$("#cmbExamTypeIX").change(function () {
        var examType=$("#cmbExamTypeIX").val();
		if(examType == "SA-II")
		{
			$("#cmbMarkTypeIX").val("CGPA");
		}
		else if(examType == "Annual_Examination")
		{
			$("#cmbMarkTypeIX").val("Percentage");
		}
		else
		{
			$("#cmbMarkTypeIX").val("");
		}
    });
	$("#txtPermenentAddress").change(function () {
		
		if($("#txtPermenentAddress").val() !='')
		{
			$("#hidPermenentAddress").val($('#txtPermenentAddress').val());
			//alert($("#hidPermenentAddress").val());
		}
    });
	$("#txtPermenentLocality").change(function () {
		if($("#txtPermenentLocality").val() !='')
		{
			$("#hidPermenentLocality").val($('#txtPermenentLocality').val());
			//alert($("#hidPermenentLocality").val());
		}
    });
	$("#txtPermanentPost").change(function () {
		
		if($("#txtPermanentPost").val() !='')
		{
			$("#hidPermanentPost").val($("#txtPermanentPost").val());
			//alert($("#hidPermanentPost").val());
		}
    });
	
	$("#txtOtherPermanentDist").change(function () {
		
		if($("#txtOtherPermanentDist").val() !='')
		{
			$("#hidOtherPermanentDist").val($('#txtOtherPermanentDist').val());
			//alert($("#hidOtherPermanentDist").val());
		}
    });
	$("#txtOtherPermanentState").change(function () {
		
		if($("#txtOtherPermanentState").val() !='')
		{
			$("#hidOtherPermanentState").val($('#txtOtherPermanentState').val());
			//alert($("#hidOtherPermanentState").val());
		}
    });
	$("#txtPermanentPin").change(function () {
		
		if($("#txtPermanentPin").val() !='')
		{
			$("#hidPermanentPin").val($('#txtPermanentPin').val());
			//alert($("#hidPermanentPin").val());
		}
    });
	$("#cmbPermanentDist").change(function () {
		
		if($("#cmbPermanentDist").val() !='')
		{
			$("#hidPermanentDist").val($('#cmbPermanentDist').val());
			//alert($("#hidPermanentPin").val());
		}
    });
	$('#cmbPermanentState').change(function(){
		//alert("hello");
		permanentStateChange();
	});
	
	
	$('#cmbPresentState').change(function(){
		//alert("hello");
		var state = $("#cmbPresentState").val();
		
		if(state != '')
		{
			$("#spanState").show();
			var institutedata={
				state:state
			};
			$.ajax({
				url:base_url+"ajax_controller/select_district_details",
				type:"post",
				data:institutedata,
				success:function(response){  
					var options = "<option value =''>Select District</option>";
					var res1 = JSON.parse(response);
					//alert(res1);
					$.each(res1.aaData,function(i,data){
						options = options + "<option value="+data.district_code+">"+data.district_name+"</option>";
						
					});
								
					//alert(options);
					$('#cmbPresentDist').html("");   //campusid from academicPeriod
					$('#cmbPresentDist').append(options);
					$("#spanState").hide();
					//$('#frmApply').data('bootstrapValidator').updateStatus('cmbPresentDist', 'NOT_VALIDATED', null).validateField('cmbPresentDist');  //for single field valdation
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		}
	});

	$('#center_name1COMMON').val("");
 	$('#center_name2COMMON').val("");
 	$('#center_name3COMMON').val("");
 	
	$.ajax({
		url:base_url+"ajax_controller/select_center_preference_common",
		type:"post",
		//data:institutedata,
		success:function(response){  
			var options = "<option value =''>Select Preference</option>";
			var res1 = JSON.parse(response);
			//alert(res1); 
		   	for(var i=0;i<res1.length;i++){
		    	options = options + "<option value='"+res1[i].centre_code+"' >"+res1[i].centre_name+"</option>";
		   	} 
			$('#center_name1COMMON').html("");   //campusid from academicPeriod
			$('#center_name1COMMON').append(options);
			if(prefernce1_drop !=''){
				$('#center_name1COMMON').val(prefernce1_drop);
				$('#center_name1COMMON').trigger('change');
			}
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$('#center_name1COMMON').change(function(){
		preference1 = $('#center_name1COMMON').val();
		$('#center_name3COMMON').html("");
		$('#center_name3COMMON').append("<option value =''>Select Preference</option>");
		$.ajax({
			url:base_url+"ajax_controller/select_center_preference_common",
			type:"post",
			data:{preference1:preference1},
			success:function(response){  
				var options = "<option value =''>Select Preference</option>";
				var res1 = JSON.parse(response);
				//alert(res1); 
			   	for(var i=0;i<res1.length;i++){
			    	options = options + "<option value='"+res1[i].centre_code+"' >"+res1[i].centre_name+"</option>";
			   	} 
							
				//alert(options);
				$('#center_name2COMMON').html("");   //campusid from academicPeriod
				$('#center_name2COMMON').append(options);
				if(prefernce2_drop !=''){
					$('#center_name2COMMON').val(prefernce2_drop);
					$('#center_name2COMMON').trigger('change');
				}
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	});
	$('#center_name2COMMON').change(function(){
		preference1 = $('#center_name1COMMON').val();
		preference2 = $('#center_name2COMMON').val();
		$.ajax({
			url:base_url+"ajax_controller/select_center_preference_common",
			type:"post",
			data:{preference1:preference1,preference2:preference2},
			success:function(response){  
				var options = "<option value =''>Select Preference</option>";
				var res1 = JSON.parse(response);
				//alert(res1); 
			   	for(var i=0;i<res1.length;i++){
			    	options = options + "<option value='"+res1[i].centre_code+"' >"+res1[i].centre_name+"</option>";
			   	} 
							
				//alert(options);
				$('#center_name3COMMON').html("");   //campusid from academicPeriod
				$('#center_name3COMMON').append(options);
				if(prefernce3_drop !=''){
					$('#center_name3COMMON').val(prefernce3_drop);
				}
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	});
});

function permanentStateChange(x=''){
		var state = $("#cmbPermanentState").val();
		if(state != '')
		{
			$("#hidPermanentState").val($('#cmbPermanentState').val());
			$("#spanState1").show();
			var institutedata={
				state:state
			};
			$.ajax({
				url:base_url+"ajax_controller/select_district_details",
				type:"post",
				data:institutedata,
				success:function(response){  
					var options = "<option value =''>Select District</option>";
					var res1 = JSON.parse(response);
					
					$.each(res1.aaData,function(i,data){
						if(data.district_code == x){
							selected='selected';
						}else{
							selected='';
						}
						options = options + "<option value="+data.district_code+" "+selected+">"+data.district_name+"</option>";
						
					});
								
					
					$('#cmbPermanentDist').html("");   //campusid from academicPeriod
					$('#cmbPermanentDist').append(options);
					$("#spanState1").hide();
					//$('#frmApply').data('bootstrapValidator').updateStatus('cmbPermanentDist', 'NOT_VALIDATED', null).validateField('cmbPermanentDist');  //for single field valdation
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		}
	}
	/*$('#master_name').change(function(){
  		coursedetail();
  	});*/
  	coursedetail();
  	
  	function coursedetail(){
		var selecting_value = $("#txtQualification1").val();
  		$.ajax({
			url:base_url+"ajax_controller/select_graduation_course",
			type:"post",
			data:{course_name:$('#master_name').val()},
			success:function(response){  
				//alert(response);
				var options = "<option value =''>Select Course</option>";
				var res1 = JSON.parse(response);
				if(res1.status =='validationerror'){
					toastr.error(res1.msg);
				}else{
					for(var i=0;i<res1.length;i++){
						if(res1[i].graduation_code == selecting_value){
							selected='selected';
						}else{
							selected='';
						}
						options = options + "<option value="+res1[i].graduation_code+" "+selected+">"+res1[i].graduation_name+"</option>";
					}
				}	
				$('#txtQualification1').html("");   //campusid from academicPeriod
				$('#txtQualification1').append(options);
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	}