$(document).ready(function() {
 $('#txtFirstName').focus();
 $("#spanEmail").html("");
 $('#txtCandidatePhone1').focus();
 $('#txtdob').datepicker({
    format: "dd-mm-yyyy",
	todayHighlight:true,
	autoclose:true
    });
	$('#txtdob1').datepicker({
    format: "dd-mm-yyyy",
	todayHighlight:true,
	autoclose:true
    });

	
 $.ajax({
			url:base_url+"ajax_controller/check_birth_date",
			type:"post",
			success:function(response){  
				var start_date = "";
				var end_date = "";
				var res1 = JSON.parse(response);
				$.each(res1.aaData,function(i,data){
					start_date = data.birth_start_date;
					end_date = data.birth_end_date;
				});
				$('#txtdob').datepicker('setStartDate', start_date);	
				$('#txtdob').datepicker('setEndDate', end_date);	
				$('#txtdob1').datepicker('setStartDate', start_date);	
				$('#txtdob1').datepicker('setEndDate', end_date);	
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	
	$.ajax({
			url:base_url+"ajax_controller/create_captcha",
			type:"post",
			success:function(response){ 
				var value = 'hello';
				refresh = base_url + 'public/assets/images/refresh.png';
				var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha" onclick="refresh_captcha()"  id="refreshCaptcha" ><img src="'+refresh+'"/></a>';
				$("#captImg").html(res);	
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	
	$('#frmVerify').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
			txtVerifyCode: {
				notEmpty: {
							message: 'Pin cannot be empty'
						},
                validators: {
					digits: {
							message: 'The value can contain only digits'
						}, 
					stringLength: {
						max: 4,
						min: 4,
						message: 'Pin must be of 4 characters'
					}
				}
			}
		}
	});
	$('#frmApplyNew').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
			txtCandidatePhone: {
                validators: {
					digits: {
							message: 'The value can contain only digits'
						}, 
					stringLength: {
						max: 10,
						min: 10,
						message: 'Phone no must be 10 characters'
					}
				}
			},
			txtEmail: {
                validators: {
					emailAddress: {
								message: 'The input is not a valid email address'
							}
				}
			},
			txtFirstName: {
                validators: {
					regexp: {
                        regexp: /^([A-Za-z]+)$/,
                        message: "Special characters and Numbers are not allowed"
					}
                }
            },
			txtMiddleName: {
                validators: {
                    regexp: {
                        regexp: /^([A-Za-z\s]+)$/,
                        message: "Special characters and Numbers are not allowed"
					}
                }
            },
			txtLastName: {
                validators: {
                    
					regexp: {
                        regexp: /^([A-Za-z]+)$/,
                        message: "Special characters and Numbers are not allowed"
					}
                }
            }
		}
	});
	$("#txtCandidatePhone1").change(function(){
		//alert($("#txtCandidatePhone1").val());
		$("#spanPhone").html("");
		 var phone = $("#txtCandidatePhone1").val();
         var result = isNaN(phone.value);
		 if (isNaN(phone)) {
		 	//
		 		if(phone.search("@") != '-1')
				{
					//alert(phone);
					if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(phone))
					{
						$("#hidInput").val("email");
					}
					else
					{
						$("#spanPhone").html("Invalid Email Id");
					}
				} 
				else
				{
					$("#hidInput").val("appl_no");
				}   
         }
		 else
		 {
		 	//alert('hello');
			 if(phone.length != 10)
				{
					$("#spanPhone").html("Invalid Mobile No");
				}
				else if(phone.length == 10)
				{
					$("#spanPhone").html("");
					$("#hidInput").val("mobile");
				}
		 }
	});
	$('#btnInstruction').click(function(){
		var page = $("#hidPageCode").val();
		//$("#spanEmail").html("");
		if(page != '')
		{
			$.ajax({
				url:"db_instruction.php?type=SELECT&page="+page,
				mType:"get",
				success:function(response){  
					$("#divInstruction").html(response);
					$('#modalInstruction').modal('show');
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		}
	});
 

});

function tolower(o)
{
	//o.value=o.value.toLowerCase().replace(/([^0-9A-Z])/g,"");
	o.value=o.value.toLowerCase();
}
function refresh_captcha()
{
	$.get(base_url+'ajax_controller/refresh_captcha', function(data){
		refresh = base_url + 'public/assets/images/refresh.png';
		var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha" onclick="refresh_captcha()"  id="refreshCaptcha" ><img src="'+refresh+'"/></a>';
		$("#captImg").html(data);
    });
}
