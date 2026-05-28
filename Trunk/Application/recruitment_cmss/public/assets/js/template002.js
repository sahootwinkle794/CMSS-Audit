function CalculateExp() {
	
	if($("#txtdoj").val()!=="" && $("#txtdor").val()!==""){
	
	var From_date = new Date(date_format_change($("#txtdoj").val()));
	var To_date = new Date(date_format_change($("#txtdor").val()));
	if(From_date > To_date){
		
		//toastr.error("Date of Joining should not be greater than Date of Leaving in Experience Details"); 
		$("#txtExp").val("");
	}
	else{
		var diff = Math.floor(To_date.getTime() - From_date.getTime());
	    var day = (1000 * 60 * 60 * 24);
	     
		
	    var days = Math.floor(diff/day);
	    if(days >= 360)
		{
			//console.log(days);
			var multiply = Math.floor(days/360);
			console.log(multiply); 
			multiply1 = 6*multiply;
			days = days+multiply1;
			var days_to_be_added = 1*multiply;
			if(days_to_be_added >2)
			{
				days_to_be_added = 2;
			}
			days = days+days_to_be_added;
			//console.log(days);
			
		}
	    var months1 = Math.floor(days/31);
	    var days1 = days % 31;
	    var months = months1 % 12;
	    var years = Math.floor(months1/12);

	   
		$("#txtExp").val(years+'/'+months);
		/*$("#hidYear1_1").val(years);
		$("#hidYear1_2").val( months);
		$("#hidYear1_3").val( days1);*/
		//alert( years+" year(s) "+months+" month(s) "+days+" and day(s)");
		}
	}
	else{
		//alert("Please select dates");
		$("#txtExp").val("");
		/*$("#hidYear1_1").val("");
		$("#hidYear1_2").val("");
		$("#hidYear1_3").val("");*/
		return false;
	}
}
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
function calculate_total_experience()
{
	var sl_no = $("#hidSlNo").val();
	/*alert(sl_no);*/
	var i;
	total_year = 0;
	total_month = 0;
	for(i=1;i<=sl_no;i++)
	{
		var duration = $("#txtduration"+i).val();
		arr = duration.split('/');
		var year = arr[0];
		var month = arr[1];
		var total_year = parseInt(total_year) + parseInt(year) ;
		var total_month = parseInt(total_month) + parseInt(month);
		
		//alert(total_year);
		//alert(total_month);
	}
   
	if(total_month >= 12)
	{
		total_year = total_year + Math.floor(total_month/12);
		total_month = total_month % 12;
		
	}
	$("#txtTotalExperience").val(total_year+" Years "+total_month+" months ");
}
function CalculateDiff(sl_no) {

	//alert(sl_no); 
	if($("#txtdate_from"+sl_no).val()!=="" && $("#txtdate_to"+sl_no).val()!==""){
	//console.log($(".txtExperience_1_3").val());
	var From_date = new Date(date_format_change($("#txtdate_from"+sl_no).val()));
	var To_date = new Date(date_format_change($("#txtdate_to"+sl_no).val()));
	var diff = Math.floor(To_date.getTime() - From_date.getTime());
    var day = (1000 * 60 * 60 * 24);
    
	
    var days = Math.floor(diff/day);
    if(days >= 360)
	{
		//console.log(days);
		var multiply = Math.floor(days/360);
		console.log(multiply); 
		multiply1 = 6*multiply;
		days = days+multiply1;
		var days_to_be_added = 1*multiply;
		if(days_to_be_added >2)
		{
			days_to_be_added = 2;
		}
		days = days+days_to_be_added;
		//console.log(days);
		
	}
    var months1 = Math.floor(days/31);
    var days1 = days % 31;
    var months = months1 % 12;
    var years = Math.floor(months1/12);

   
	$("#txtduration"+sl_no).val(years+'/'+months);
	/*$("#hidYear1_1").val(years);
	$("#hidYear1_2").val( months);
	$("#hidYear1_3").val( days1);*/
	//alert( years+" year(s) "+months+" month(s) "+days+" and day(s)");
	}
	else{
		//alert("Please select dates");
		$("#txtduration"+sl_no).val("");
		/*$("#hidYear1_1").val("");
		$("#hidYear1_2").val("");
		$("#hidYear1_3").val("");*/
		return false;
	}
}
function date_format_change(dateArg)
{
	//alert(dateOrg);
	var res = dateArg.split("-");
	dateVal = res[2]+"-"+res[1]+"-"+res[0];
	
    //alert(dateVal);
    return dateVal;


}
function enc(str) {
    var encoded = "";
    for (i=0; i<str.length;i++) {
        var a = str.charCodeAt(i);
        var b = a ^ 123;    // bitwise XOR with any number, e.g. 123
        encoded = encoded+String.fromCharCode(b);
    }
    return encoded;
}
$(document).ready(function() {
	if(id_proof_number != '')
	{
		var res =enc(id_proof_number);
		console.log("res",res);
		var finalres = res+'*'+Math.random();
		$('#txtidproof').val('************');
		$('#key').val(finalres);
	}
	$('#txtidproof').change(function(){
		var res =enc($('#txtidproof').val());
		console.log("res",res);
		var finalres = res+'*'+Math.random();
		$('#txtidproof').val('************');
		$('#key').val(finalres);
	});
	//alert(show); 
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

	var post_array=posts.split(",");
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
	$.ajax({
		url:base_url+"ajax_controller/select_count_experience",
		type:"post",
		//data:institutedata,
		success:function(response){  
			var res1 = JSON.parse(response);
			$("#hidSlNo").val(res1);
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
            
            
	$("#divExService").hide();
	if($("input[name=radioService]:checked").val()=="YES")
	{
		$("#divExService").show();	
	}
	else
	{
		$("#divExService").hide();
	}
	$("#radioServiceY").click(function () {
        $("#divExService").show();	
    });
    $("#radioServiceN").click(function () {
        $("#divExService").hide();
    });
	/*$('#txtdoj').datepicker({
		format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
	}).on('changeDate', function (selected) {
		//$('#frmInfoDetails').data('bootstrapValidator').updateStatus('txtdate_from1', 'NOT_VALIDATED').validateField('txtdate_from1');
	    var startDate = new Date(selected.date.valueOf());
	    startDate.setDate(startDate.getDate() + 1);
	    $('#txtdor').datepicker('setStartDate', startDate);
	}).on('clearDate', function (selected) {
		 $('#txtdor').datepicker('setStartDate', null);
	});
	$('#txtdor').datepicker({
		format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
	}).on('changeDate', function (selected) {
		var startDate = new Date(selected.date.valueOf());
	    $('#txtdoj').datepicker('setEndDate', startDate);
	    
	}).on('clearDate', function (selected) {
		 $('#txtdor').datepicker('setStartDate', null);
	});*/
	$('#txtdoj').datepicker({
		format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
	}).on('changeDate', function (selected) {
		//$('#frmInfoDetails').data('bootstrapValidator').updateStatus('txtdate_from1', 'NOT_VALIDATED').validateField('txtdate_from1');
	    var startDate = new Date(selected.date.valueOf());
	    startDate.setDate(startDate.getDate() + 1);
	    $('#txtdor').datepicker('setStartDate', startDate);
	});
	$('#txtdor').datepicker({
		format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
	})
var appl_status = $("#hidApplStatus").val();
	//alert(appl_status);
	if(appl_status == 'Student Details Submitted' || appl_status == 'Document Uploaded' || appl_status == 'Verified' || appl_status == 'Fee Paid' || appl_status == 'Applicant_Info' || appl_status == 'Payment Updated' || appl_status == 'Application Submitted')
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
			//alert("hello"); 
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
	var category_1 = $("#cmbCommunity").val();
 		if(category_1 != 'GEN')
 		{
			$("input[name='radioEWS']").prop('checked', false);
		}
 	$("#cmbCommunity").change(function () {
 		var category = $("#cmbCommunity").val();
 		if(category == 'GEN')
 		{
			$("#divews").show();
		}
		else
		{
			$("#divews").hide();
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
 	var dtblPromoter = $('#dtblPromoter').dataTable({
	        "ajax":
			{
				"url": base_url+"/ajax_controller/add_table_research",
				"type": "POST"				
			},
			"bPaginate": false,
	        "bLengthChange": false,
	        "bFilter": false,
	        "bSort": false,
	        "bInfo": false,
	        "bAutoWidth": true,
	        "bDestroy": true,
	        "scrollX":true ,
	        //"sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
			"aoColumns": [			      
	           	{ "sName": "organization","sClass":"alignCenter" },
	           	{ "sName": "post_held","sClass":"alignCenter" },
			   	{ "sName": "from_date",},
			    { "sName": "to_date", },
	           	{ "sName": "duration","sClass":"alignCenter"},
	           	{ "sName": "nature_of_job","sClass":"alignCenter"},
	           	{ "sName": "pay_band","sClass":"alignCenter" },
	           /*	{ "sName": "basic_pay","sClass":"alignCenter" },
	           	{ "sName": "gross_salary","sClass":"alignCenter" },*/
	           	
	           	{ "sName": "remove","sClass":"alignCenter","mRender": function( data, type, full ) {
	           		if(show==1){
						return '<button type="button" class="btn btn-danger btn-circle" id="rowDelete" disabled><i class="fa fa-trash-o"></i></button>';
					}
					else{
						return '<button type="button" class="btn btn-danger btn-circle" id="rowDelete"><i class="fa fa-trash-o"></i></button>';
					}						
									        
				} }
	        ] 
		});
		$('#btnPromoter').click(function(){
			$('.btnnextexp').attr('disabled',false);
			var sl_no = $("#hidSlNo").val();
			var fordate = sl_no;
			var sl_no_count = ++sl_no;
			
		   
		    var add_status = true;
		    $('input[name="txtorganization[]"]').each(function(){
			    var organization = $(this).val();
			    if(organization == '')
			    {
			    	toastr.error("Please enter the Employer Name");
			    	add_status = false;
			    }
			    else
			    	add_status = true;
		    });
		    if(add_status == true){
				$('input[name="txtpost_held[]"]').each(function(){
		        var post_held = $(this).val();
			        if(post_held == '')
			        {
			    		toastr.error("Please enter the Post Held");
			    		add_status = false;
			    	}
			   		else
			     	add_status = true;
			    });
			}
		    if(add_status == true){
			    $('input[name="txtpay_band[]"]').each(function(){
			        var pay_band = $(this).val();
			        if(pay_band == '')
			        {
				    	toastr.error("Please enter the Scale of Pay");
				    	add_status = false;
					}
				    else
				    	add_status = true;
			    });
			}
			if(add_status == true){
			    $('select[name="txtbasic_pay[]"]').each(function(){
			        var basic_pay = $(this).val();
			        if(basic_pay == '')
			        {
				    	toastr.error("Please select the Basic Pay");
				    	add_status = false;
					}
				    else
				    	add_status = true;
			    });
			}
			if(add_status == true){
			    $('select[name="txtdate_from[]"]').each(function(){
			        var date_from = $(this).val();
			        if(date_from == '')
			        {
				    	toastr.error("Please enter the From Period");
				    	add_status = false;
					}
				    else
				    	add_status = true;
			    });
			}
			if(add_status == true){
				$('select[name="txtdate_to[]"]').each(function(){
			        var date_to = $(this).val();
			        if(date_to == '')
			        {
				    	toastr.error("Please enter the To Period");
				    	add_status = false;
					}
				    else
				    	add_status = true;
			    });
			}
			if(add_status == true){
			    $('input[name="txtnature_of_job[]"]').each(function(){
			        var nature_of_job = $(this).val();
			        if(nature_of_job == '')
			        {
				    	toastr.error("Please enter the nature of duties/work");
				    	add_status = false;
					}
				    else
				    	add_status = true;
			    });
			}
			if(add_status == true){
			    $('input[name="txtgross[]"]').each(function(){
			        var gross = $(this).val();
			        if(gross == '')
			        {
				    	toastr.error("Please enter the gross");
				    	add_status = false;
					}
				    else
				    	add_status = true;
			    });
			}
			if(add_status == true){
			    $('input[name="txtorganisation[]"]').each(function(){
			        var gross = $(this).val();
			        if(gross == '')
			        {
				    	toastr.error("Please enter the Organisation");
				    	add_status = false;
					}
				    else
				    	add_status = true;
			    });
			}
			if(add_status == true){
			    $('input[name="txtrank[]"]').each(function(){
			        var gross = $(this).val();
			        if(gross == '')
			        {
				    	toastr.error("Please enter the Rank");
				    	add_status = false;
					}
				    else
				    	add_status = true;
			    });
			}
			if(add_status == true){
			    $('input[name="txtyear[]"]').each(function(){
			        var gross = $(this).val();
			        if(gross == '')
			        {
				    	toastr.error("Please enter the Year");
				    	add_status = false;
					}
				    else
				    	add_status = true;
			    });
			}
			if(add_status == true)
			{
				re_assign();
				//alert(sl_no_count);
			    $('#dtblPromoter').DataTable().row.add
			     ([
			       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control promoterInput" id="txtorganization'+sl_no_count+'" name="txtorganization[]"></div></div>', 
			       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control " id="txtpost_held'+sl_no_count+'" name="txtpost_held[]"></div></div>', 
			       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control date" id="txtdate_from'+sl_no_count+'" name="txtdate_from[]" readonly onchange="CalculateDiff('+sl_no_count+')"></div></div>', 
			       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control date" id="txtdate_to'+sl_no_count+'" 	name="txtdate_to[]" readonly onchange="CalculateDiff('+sl_no_count+')"></div></div>', 
			       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control " id="txtduration'+sl_no_count+'" readonly name="txtduration[]"></div></div>',
			       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control " id="txtnature_of_job'+sl_no_count+'" name="txtnature_of_job[]"  ></div></div>',
			       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control " id="txtpay_band'+sl_no_count+'" name="txtpay_band[]" ></div></div>',
			      /* '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control " id="txtbasic_pay'+sl_no_count+'" name="txtbasic_pay[]" ></div></div>',
			       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control " id="txtgross'+sl_no_count+'" name="txtgross[]" ></div></div>',*/
			       '<button type="button" class="btn btn-danger btn-circle" id="rowDelete"><i class="fa fa-trash-o"></i></button>' 
			     ]).draw();
		     	
		     		if(fordate >= 1)
		     		{
						var date2 = $('#txtdate_to'+fordate+'').datepicker('getDate');
				        date2.setDate(date2.getDate() + 1);
				        
				       	$(".date").datepicker({
						format: "dd-mm-yyyy",
						todayHighlight:true,
						autoclose:true,
						});
						
					    $('#txtdate_from'+sl_no_count+'').datepicker('setStartDate', date2);
					    $('#txtdate_from'+sl_no_count+'').datepicker().on('changeDate', function (selected) {
						    var date2 = $('#txtdate_from'+sl_no_count+'').datepicker('getDate');
					        date2.setDate(date2.getDate() + 1);
						   	$('#txtdate_to'+sl_no_count+'').datepicker('setStartDate', date2);
						});
						
						$('#txtdate_to'+fordate+'').datepicker({
						    autoclose:true,
						    clearBtn:true,
						    //endDate: '+0d'
						    
						}).on('changeDate', function (selected) {
						    var date2 = $('#txtdate_to'+fordate+'').datepicker('getDate');
					        date2.setDate(date2.getDate() + 1);
						   	$('#txtdate_from'+sl_no_count+'').datepicker('setStartDate', date2);
						});
					   
					}
					else
					{
						$(".date").datepicker({
						format: "dd-mm-yyyy",
						todayHighlight:true,
						autoclose:true,
						});
						
					}
					
				
		     	 
				
				
				
		     	//re_assign();
		      	sl_no_count ++;
		      
		      	$("#hidSlNo").val(--sl_no_count);
		      
			}
							//Remove Refund Data from table
							
		});

		
		
		$(".date").datepicker({
			format: "dd-mm-yyyy",
			todayHighlight:true,
			autoclose:true,
		});
		
		$('#dtblPromoter tbody').on( 'click', '#rowDelete', function () {
			//var dtblPromoter =  $('#dtblPromoter').dataTable();
			//alert("hello"); 
			var aPos = dtblPromoter.fnGetPosition( $(this).closest('tr').get(0));
			// Delete the row
			dtblPromoter.fnDeleteRow(aPos);
			add_status = true;
			re_assign();
		});
		//when delete the row, it will re-assign the sl_no.
		function re_assign()
		{
			var renum = 1;
			$("tr td .serial_no").each(function(){
			  	$(this).text(renum);
			  	renum++;
			});
			
			sl_no_count = renum;
			$("#hidSlNo").val(sl_no_count);
			/*alert(sl_no_count);*/
			return sl_no_count;
		}
		//start qual
		var dbtblQual = $('#dbtblQual').dataTable({
	        "ajax":
			{
				"url": base_url+"/ajax_controller/add_qual",
				"type": "POST"				
			},
			"bPaginate": false,
	        "bLengthChange": false,
	        "bFilter": false,
	        "bSort": false,
	        "bInfo": false,
	        "bAutoWidth": true,
	        "bDestroy": true,
	        "scrollX":true ,
			"aoColumns": [			      
	           	{ "sName": "qual_desc_1","sClass":"alignCenter" },
	           	{ "sName": "stream","sClass":"alignCenter" },
	           	{ "sName": "year","sClass":"alignCenter"},
	           	{ "sName": "affiliation_from","sClass":"alignCenter"},
	           	{ "sName": "division","sClass":"alignCenter" },
	           	{ "sName": "remark","sClass":"alignCenter" },
	           	{ "sName": "grade_cgpa","sClass":"alignCenter" },
	           	
	           	{ "sName": "remove","sClass":"alignCenter","mRender": function( data, type, full ) {
	           		if(show==1){
						return '<button type="button" class="btn btn-danger btn-circle" id="rowQualDelete" disabled><i class="fa fa-minus"></i></button>';
					}
					else{
						return '<button type="button" class="btn btn-danger btn-circle" id="rowQualDelete"><i class="fa fa-minus"></i></button>';
					}						
									        
				} }
	        ] 
		}); 
		$('#btnQual').click(function(){
			var sl_no = $("#hidQualSlNo").val();
			/*var fordate = sl_no;*/
			var sl_no_count = ++sl_no;
			
		   
		    var add_status = true;
		    $('input[name="txtExamName[]"]').each(function(){
			    var qual_desc_1 = $(this).val();
			    if(qual_desc_1 == '')
			    {
			    	toastr.error("Please enter the Exam Passed");
			    	add_status = false;
			    }
			    else
			    	add_status = true;
		    });
		    if(add_status == true){
				$('input[name="txtStream[]"]').each(function(){
		        var stream = $(this).val();
			        if(stream == '')
			        {
			    		toastr.error("Please enter the Degree/Master");
			    		add_status = false;
			    	}
			   		else
			     	add_status = true;
			    });
			}
		    if(add_status == true){
			    $('input[name="txtYearQual[]"]').each(function(){
			        var year = $(this).val();
			        if(year == '')
			        {
				    	toastr.error("Please enter the Year of Passing");
				    	add_status = false;
					}
				    else
				    	add_status = true;
			    });
			}
			if(add_status == true){
			    $('select[name="txtBoardOth[]"]').each(function(){
			        var affiliation_from = $(this).val();
			        if(affiliation_from == '')
			        {
				    	toastr.error("Please select the Board/University");
				    	add_status = false;
					}
				    else
				    	add_status = true;
			    });
			}
			if(add_status == true){
			    $('select[name="txtDiv[]"]').each(function(){
			        var division = $(this).val();
			        if(division == '')
			        {
				    	toastr.error("Please enter the Division/Class");
				    	add_status = false;
					}
				    else
				    	add_status = true;
			    });
			}
			if(add_status == true){
			    $('input[name="txtGradingOth[]"]').each(function(){
			        var remark = $(this).val();
			        if(remark == '')
			        {
				    	toastr.error("Please enter the nature of Grading System");
				    	add_status = false;
					}
				    else
				    	add_status = true;
			    });
			}
			if(add_status == true){
			    $('input[name="txtCGPA[]"]').each(function(){
			        var grade_cgpa = $(this).val();
			        if(grade_cgpa == '')
			        {
				    	toastr.error("Please enter the CGPA/% of Marks");
				    	add_status = false;
					}
				    else
				    	add_status = true;
			    });
			}
			if(add_status == true)
			{
				re_assign_qual();
				//alert(sl_no_count);
			    $('#dbtblQual').DataTable().row.add
			     ([
			       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control input-sm" id="txtExamName'+sl_no_count+'" name="txtExamName[]"></div></div>', 
			       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control input-sm" id="txtStream'+sl_no_count+'" name="txtStream[]"></div></div>', 
			       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control input-sm" id="txtYearQual'+sl_no_count+'" name="txtYearQual[]"></div></div>', 
			       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control input-sm" id="txtBoardOth'+sl_no_count+'" 	name="txtBoardOth[]"></div></div>',
			       '<div class="col-md-12"><div class="form-group"><select class="form-control input-sm" name="txtDiv[]" id="txtDiv'+sl_no_count+'"><option value="">Select</option><option value="1st">1st</option><option value="2nd">2nd</option><option value="3rd">3rd</option></select></div></div>',
			       /*'<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control" id="txtDiv'+sl_no_count+'" name="txtDiv[]"></div></div>',*/
			       /*'<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control " id="txtGradingOth'+sl_no_count+'" name="txtGradingOth[]"  ></div></div>',*/
			       '<div class="col-md-12"><div class="form-group"><select class="form-control input-sm" name="txtGradingOth[]" id="txtGradingOth'+sl_no_count+'"><option value="">Select</option><option value="CGPA">CGPA</option><option value="PERCENTAGE">PERCENTAGE</option></select></div></div>',
			       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control input-sm" id="txtCGPA'+sl_no_count+'" name="txtCGPA[]" ></div></div>',
			       '<button type="button" class="btn btn-danger btn-circle" id="rowQualDelete"><i class="fa fa-trash-o"></i></button>' 
			     ]).draw();
		     	
		     	//re_assign();
		      	sl_no_count ++;
		      
		      	$("#hidQualSlNo").val(--sl_no_count);
		      
			}
							//Remove Refund Data from table
							
		});
		$('#dbtblQual tbody').on( 'click', '#rowQualDelete', function () {
			//var dtblPromoter =  $('#dtblPromoter').dataTable();
			//alert("hello"); 
			var aPos = dbtblQual.fnGetPosition( $(this).closest('tr').get(0));
			// Delete the row
			dbtblQual.fnDeleteRow(aPos);
			add_status = true;
			re_assign_qual();
		});
		function re_assign_qual()
		{
			var renum = 1;
			$("tr td .serial_no").each(function(){
			  	$(this).text(renum);
			  	renum++;
			});
			
			sl_no_count = renum;
			$("#hidQualSlNo").val(sl_no_count);
			/*alert(sl_no_count);*/
			return sl_no_count;
		}
		//end qual
		//$("#txtdate_from1").
		    
 	// First Tab
 	
	$('#frmApplicantDetails').bootstrapValidator({
        message: 'This value is not valid',
        submitButtons: 'button[type="submit"]',
        excluded: [':disabled',':hidden'],
		submitHandler: function(validator, form, submitButton) 
		{
		
				var institutedata={
					category:$("#cmbCommunity").val(),
					physically_handicapped:$("input[name=radioPhysicallY]:checked").val(),
					service_man:$("input[name=radioService]:checked").val(),
					exp_service:$("#txtExp").val(),
					no_of_year:$("#txtExpNirtar").val(),
					is_exp:$("input[name=radioExp]:checked").val()
				};
				$.ajax({
					url:base_url+"ajax_controller/course_wise_date_eligibility",
					type:"post",
					data:institutedata,
					success:function(response){  
						var res1 = JSON.parse(response);
						console.log(res1);
						if(res1.eligibility == '0'){
							swal({
								title: "",
								text: "You are not eligible as per criteria/recruitment rules for the applied post",
								type: "error"
							},
							function(isConfirm) {
							  if (isConfirm) {
							  	//window.location.reload();
							  	//window.location.reload();
							  	//window.location.href = ("<?php echo base_url() ?>index/institute_login/ins/<?php echo $ins; ?>");
							  }
							});
						}
						else
						{
							//alert(1);
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
					},
					error:function(){
						toastr.error("We are unable to Process.Please contact Support");
					}
				});
			
			
		},
        fields: {
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
			txtExp: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtDoj: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtDor: {
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
			radioEWS: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			radioExp: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtExpNirtar: {
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
					/*callback: {
                        message: 'Invalid Id proof Number<br>',
                        callback: function (value, validator, $field) {
                        	 id_proof = document.getElementById("cmbidproof").value;
                        	 aadhar_regexp = /^\d{4}\s\d{4}\s\d{4}$/;
                        	 aadhar_regexp12 = /^\d{12}$/;
                        	 voter_regexp = /^([a-zA-Z0-9-\n\r \/]+)$/;
                        	 pan_regexp = /^[A-Za-z]{5}\d{4}[A-Za-z]{1}$/;
                            if(id_proof  == 'AADHAR' )
							{
								
								if(aadhar_regexp.test(document.getElementById("txtidproof").value) == false && aadhar_regexp12.test(document.getElementById("txtidproof").value) == false)
								{
	                                return false;
	                                message: 'Only Numbers Are allowed in Aadhar Number'
	                                return {
										valid: false,    // or false
            							message: 'Only Numbers Are allowed in Aadhar Number'
									};
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
                    }*/
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
							}else if(parseInt(document.getElementById("txtYear1").value) >= parseInt(value))
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
							}else if(parseInt(document.getElementById("txtYear2").value) >= parseInt(value))
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
							}else if(parseInt(document.getElementById("txtYear3").value) >= parseInt(value))
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
							}else if(parseInt(document.getElementById("txtYear4").value) >= parseInt(value))
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
							}else if(parseInt(document.getElementById("txtYear5").value) >= parseInt(value))
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
							}else if(parseInt(document.getElementById("txtYear7").value) >= parseInt(value))
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
							}else if(parseInt(document.getElementById("txtYear6").value) >= parseInt(value))
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
			
			txtqual21: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtCourse2: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtCourse3: {
                validators: {
                	notEmpty: {
                        message: 'Required'
                    }
				}
			},
			txtCourse4: {
                validators: {
                	notEmpty: {
                        message: 'Required'
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
			$.ajax({
				url:base_url+"ajax_controller/check_experience_validation",
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
			radioExperience1:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
				}
			},
			radioExperience2:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
				}
			},
			radioExperience3:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
				}
			},
			radioExperience4:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
				}
			},
			radioExperience5:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
				}
			},
			radioExperience6:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
				}
			},
			radioExperience7:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
				}
			},
			radioExperience8:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
				}
			},
			radioExperience9:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
				}
			},
			radioExperience10:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
				}
			},
			'Experience[]':{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    integer: {
                        message: 'invalid year'
                    },
				}
			},
			Experience7:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    integer: {
                        message: 'invalid year'
                    },
				}
			},
			Experience6:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			Experience5:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			Experience4:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			Experience3:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			Experience2:{
				validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
			Experience1:{
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
			var formData = new FormData(document.getElementById("frmInfoDetails"));
			$.ajax({
				url:base_url+"ajax_controller/check_experience_validation",
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
						var status = true
						 $('input[name="txtorganization[]"]').each(function(){
						    var organization = $(this).val();
						    if(organization == '')
						    {
						    	toastr.error("Please enter the Employer Name in Work Experience");
						    	status =  false;
						    }
					    });
					    $('input[name="txtpost_held[]"]').each(function(){
					        var post_held = $(this).val();
						        if(post_held == '')
						        {
						    		toastr.error("Please enter the Post Held in Work Experience");
						    		status = false;
						    	}
						});
		    			if(status)
		    			{
							var formData = $('#frmApplicantDetails, #frmAcademicInfo, #frmInfoDetails, #frmDeclaration').serialize();
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
    $("#radioYesExp").click(function () {
        $("#divNoOfExp").show();
		
    });
	$("#radioNoExp").click(function () {
        
		$("#divNoOfExp").hide();
		$("#divNoOfExp").val("");
    });  
    if($("input[name=radioExp]:checked").val()=="YES") 
    {
        $("#divNoOfExp").show();
		
    }
	if($("input[name=radioExp]:checked").val()=="NO")  
	{
        
		$("#divNoOfExp").hide();
		$("#divNoOfExp").val("");
    }
	
	
	/*if($("input[name=radioExp]:checked").val()=="Yes")
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
	/*if($("input[name=empGovt]:checked").val()=="YES")
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
		}).on('changeDate', function (selected) {
			$('#frmInfoDetails').data('bootstrapValidator').updateStatus('txtDOJ', 'NOT_VALIDATED').validateField('txtDOJ');
		    $("#txtDOJ").datepicker().datepicker("setStartDate", startDate);
		});
		
		
	}*/
	$("#empGovtyes").click(function () {
        $("#divEmpSuspendedInfo").show();	
    });
    /*$("#empGovtno").click(function () {
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
    });*/
    
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
	var category = $("#cmbCommunity").val();
	if(category == 'GEN')
	{
		$("#divews").show();
	}
	else
	{
		$("#divews").hide();
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

///qualification maping 
	$('#txtqual22').change(function(){
			var txtqual22 = $('#txtqual22').val();
			$.ajax({
			url:base_url+"ajax_controller/select_course_SRSEC",
			type:"post",
			data:{txtqual22:txtqual22,programcode:admcode},
			success:function(response){  
				var options = "<option value =''>Select</option>";
				var res1 = JSON.parse(response);
				//alert(res1); 
				if(res1.length > 0)
				{
					$('#txtCourse2').attr("disabled",false);
					for(var i=0;i<res1.length;i++){
			    	options = options + "<option value='"+res1[i].course_name+"' >"+res1[i].course_name+"</option>";
				   	} 
					$('#txtCourse2').html("");   //campusid from academicPeriod
					$('#txtCourse2').append(options);
				}
				else
				{
					$('#txtCourse2').val("");
					$('#txtCourse2').attr("disabled",true);
					//$('#txtCourse2').val('');
				}
			   	
				
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	})
	$('#txtqual23').change(function(){
			var txtqual23 = $('#txtqual23').val();
			$.ajax({
			url:base_url+"ajax_controller/select_course_GRADUTION",
			type:"post",
			data:{txtqual23:txtqual23,programcode:admcode},
			success:function(response){  
				var options = "<option value =''>Select</option>";
				var res1 = JSON.parse(response);
				//alert(res1); 
				if(res1.length > 0)
				{
					$('#txtCourse3').attr("disabled",false);
				   	for(var i=0;i<res1.length;i++){
				    	options = options + "<option value='"+res1[i].course_name+"' >"+res1[i].course_name+"</option>";
				   	} 
				   	$('#txtCourse3').html("");   //campusid from academicPeriod
					$('#txtCourse3').append(options);
			   	}
			   	else
				{
					$('#txtCourse3').val("");
					$('#txtCourse3').attr("disabled",true);
					//$('#txtCourse2').val('');
				}
				
				
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	})
	$('#txtqual24').change(function(){
			var txtqual24 = $('#txtqual24').val();
			$.ajax({
			url:base_url+"ajax_controller/select_course_PG",
			type:"post",
			data:{txtqual24:txtqual24,programcode:admcode},
			success:function(response){  
				var options = "<option value =''>Select</option>";
				var res1 = JSON.parse(response);
				//alert(res1); 
				if(res1.length > 0)
				{
					$('#txtCourse4').attr("disabled",false);
				   	for(var i=0;i<res1.length;i++){
				    	options = options + "<option value='"+res1[i].course_name+"' >"+res1[i].course_name+"</option>";
				   	} 
					$('#txtCourse4').html("");   //campusid from academicPeriod
					$('#txtCourse4').append(options);
				}
				else
				{
					$('#txtCourse4').val("");
					$('#txtCourse4').attr("disabled",true);
					//$('#txtCourse2').val('');
				}
				
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	})
	if(txtCourse2 != '' || txtqualtwelve != '')
	{
		  
			$.ajax({
			url:base_url+"ajax_controller/select_course_SRSEC",
			type:"post",
			data:{txtqual22:txtqualtwelve,programcode:admcode},
			success:function(response){  
				var options = "<option value =''>Select</option>";
				var res1 = JSON.parse(response);
				//alert(res1); 
				if(res1.length > 0)
				{
					
					$('#txtCourse2').attr("disabled",false);
					for(var i=0;i<res1.length;i++){
			    	options = options + "<option value='"+res1[i].course_name+"' >"+res1[i].course_name+"</option>";
				   	} 
					$('#txtCourse2').html("");   //campusid from academicPeriod
					$('#txtCourse2').append(options);
					if(txtCourse2 != '' || txtCourse2 != undefined)
					$('#txtCourse2').val(txtCourse2);
				}
				else
				{
					$('#txtCourse2').val("");
					$('#txtCourse2').attr("disabled",true);
				}
			   
				
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	}
	if(txtCourse3 != '' || txtqualgrad != '')
	{
		  
		  
			$.ajax({
			url:base_url+"ajax_controller/select_course_GRADUTION",
			type:"post",
			data:{txtqual23:txtqualgrad,programcode:admcode},
			success:function(response){  
				var options = "<option value =''>Select</option>";
				var res1 = JSON.parse(response);
				//alert(res1); 
				if(res1.length > 0)
				{
					$('#txtCourse3').attr("disabled",false);
					for(var i=0;i<res1.length;i++){
			    	options = options + "<option value='"+res1[i].course_name+"' >"+res1[i].course_name+"</option>";
				   	} 
					$('#txtCourse3').html("");   //campusid from academicPeriod
					$('#txtCourse3').append(options);
					if(txtCourse3 != '' || txtCourse3 != undefined)
					$('#txtCourse3').val(txtCourse3);
				}
				else
				{
					$('#txtCourse3').val("");
					$('#txtCourse3').attr("disabled",true);
				}
			   	
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	}
	if(txtCourse4 != '' || txtqualpg != '')
	{
		   
			$.ajax({
			url:base_url+"ajax_controller/select_course_PG",
			type:"post",
			data:{txtqual24:txtqualpg,programcode:admcode},
			success:function(response){  
				var options = "<option value =''>Select</option>";
				var res1 = JSON.parse(response);
				//alert(res1); 
				if(res1.length > 0)
				{
					$('#txtCourse4').attr("disabled",false);
					for(var i=0;i<res1.length;i++){
			    		options = options + "<option value='"+res1[i].course_name+"' >"+res1[i].course_name+"</option>";
				   	} 
					$('#txtCourse4').html("");   //campusid from academicPeriod
					$('#txtCourse4').append(options);
					if(txtCourse4 != '' || txtCourse4 != undefined)
					$('#txtCourse4').val(txtCourse4);
				}
				else
				{
					$('#txtCourse4').val("");
					$('#txtCourse4').attr("disabled",true);
				}
			   
				
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	}
/// end qualification maping 
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


/*$('#txtPresentPin').change(function(){
		//alert("hello");
		permanentPostChange();
});*/


