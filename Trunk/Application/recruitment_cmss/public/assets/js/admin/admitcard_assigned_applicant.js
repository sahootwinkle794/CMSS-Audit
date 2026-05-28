$(document).ready(function(){
    $("#tblApplicantDetails").dataTable({
		"bSort": false,
	});

	// to get program name
	var institutedata={
		program_code : $('#sel_program').val()
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
	
	// to get exam centre name
	var institutedata={
		program_code : $('#sel_program').val(),
		assigned_exam_center_code : $('#sel_exam_center').val(),
	};
	$.ajax({
		url:base_url+"/ajax_controller/get_published_applicants_exam_centre_name_admit_setup",
		type:"post",
		data : institutedata,
		success:function(response){ 
			var res1 = JSON.parse(response); 
			$("#exam_centre").html(res1.exam_center_name); 
			$("#exam_centre").val(res1.exam_center_code); 
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
	// to get exam centre name
	var institutedata={
		program_code : $('#sel_program').val(),
		assigned_exam_center_code : $('#sel_exam_center').val(),
		exam_vanue : $('#sel_exam_vanue').val()
	};
	$.ajax({
		url:base_url+"/ajax_controller/get_published_applicants_exam_venue_name_admit_setup",
		type:"post",
		data : institutedata,
		success:function(response){ 
			var res1 = JSON.parse(response); 
			$("#exam_venue").html(res1.exam_venue_name); 
			//$("#exam_venue").val(res1.exam_venue_code); 
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	// to load data table
	var institutedata={
		program_code : $('#sel_program').val(),
		assigned_exam_center_code : $('#sel_exam_center').val(),
		exam_vanue : $('#sel_exam_vanue').val(),
		round_data: $("#round_data").val()
	};
	$.ajax({
		url:base_url+"/ajax_controller/get_published_applicants_admit_setup",
		type:"post",
		data : institutedata,
		success:function(response){ 
			var res1 = JSON.parse(response); 
			$("#divApplicantList").html(res1.html); 
			$("#btnTotalcount").html(res1.totalapplicant); 
			$("#btnTotalPublishedcount").html(res1.totalpublishedapplicant); 
			countChecked();
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$( "#applicantBody input[type=checkbox]" ).on( "click", function(event){
		countChecked();
	});
	$('#chkSelectAll').on( "click", function(){
		if(this.checked == true)
		{
			$("#applicantBody input[type='checkbox']").each(function() { //loop through each checkbox
                if(!this.disabled)
                {
                	this.checked = true; 
                	//this.parentNode.parentNode.style.backgroundColor = "red";   
                }	                    
            }); 
			countChecked();
		}
		else
		{
			$("#applicantBody input[type='checkbox']").each(function() { //loop through each checkbox
                if(!this.disabled)
                {
                	this.checked = false; 
                	//this.parentNode.parentNode.style.backgroundColor = "red";   
                }	                    
            });
			countChecked();  
		}
	});
	$("#btnMark" ).on( "click", function(){
		var arrFromNo = $("#txtFromSlNo").val();
			//alert(arrFromNo);
	    var arrToNo = $("#txtToSlNo").val();
		if(parseInt(arrToNo) >= parseInt(arrFromNo))
		{
			//deselect all
			$("#divApplicantList input[type='checkbox']").each(function() { //loop through each checkbox
	            if(!this.disabled)
	            {
	            	this.checked = false; 
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
                }	                    
            });
			countChecked(); 
		}
	});
	$('.tooltips').tooltipster({
		theme: 'tooltipster-punk',
		animation: 'grow',
        delay: 200, 
        touchDevices: false,
        trigger: 'hover'
 	});	
	/* END OF TOOLTIP */
	/* CODE FOR TOASTR */
	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "progressBar": false,
	  "positionClass": "toast-bottom-right",//top-right,bottom-left,top-left,top-full-width,bottom-full-width,top-center,bottom-center
	  "onclick": null,
	  "showDuration": "20000",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}
});
function check()
{
	countChecked();
}
function checkStatus()
{
	var arr_show_status = new Array();
    $('input[name="chkApplicant[]"]').each(function(){
        if($(this).is(':checked')){
			arr_show_status.push($(this).val());
		}
    });	
    if(arr_show_status.length == 0){
		toastr.error("Please select atleast one applicant to publish");
	}else{
		var institutedata={
			program_code : $('#sel_program').val(),
			assigned_exam_center_code : $('#sel_exam_center').val(),
			exam_vanue : $('#sel_exam_vanue').val(),
			round_data : $('#round_data').val(),
			chkApplicant : arr_show_status
		};
		$.ajax({
			url:base_url+"/ajax_controller/assign_published_applicants_admit_setup",
			type:"post",
			data : institutedata,
			success:function(response){  
				var res1 = JSON.parse(response);
				if(res1.status = 'success')
				{
					
					var institutedata={
						program_code : $('#sel_program').val(),
						assigned_exam_center_code : $('#sel_exam_center').val(),
						exam_vanue : $('#sel_exam_vanue').val(),
						round_data: $("#round_data").val()
					};
					$.ajax({
						url:base_url+"/ajax_controller/get_published_applicants_admit_setup",
						type:"post",
						data : institutedata,
						success:function(response){ 
							var res1 = JSON.parse(response); 
							$("#divApplicantList").html(res1.html); 
							$("#btnTotalPublishedcount").html(res1.totalpublishedapplicant); 
						},
						error:function(){
							toastr.error("We are unable to Process.Please contact Support");
						}
					});
					$('#successDiv').html("");
					$('#successDiv').append('<div class="alert alert-dismissable alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button><p style="font-size:14px;">Admit Card published successfully.</p></div>');
					//$("#successDiv").html('Center allocated successfully.'); 
					$( "#spanNowPublish" ).text("");
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
function allcheck(selectAllList,classname)
{
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

var countChecked = function() {
	var p = $( "#applicantBody input:checked" ).length;
	var total = $( "#applicantBody input[type='checkbox']" ).length;
	var exitcount = $( "#applicantBody input[disabled]" ).length;
	$( "#spanNowPublish" ).text( p  );
	//$( "#spanAbsentCount" ).text( (total-exitcount-p)  );
};
countChecked();