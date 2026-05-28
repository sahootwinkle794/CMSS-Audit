$(document).ready(function() {
	//alert($("#hidOnlineTab").val);
	var app_status = $("#hidAppStatus").val();
	if($("#hidOnlineTab").val == '1')
	{
		document.getElementById("btnPayment").style.visibility = 'hidden';
		$("#offlieSubmit").hide();
		$("#onlineSubmit").show();
		$("#hidPaymentMode").val('ONLINE');
	}
    else if($("#hidOnlineTab").val == '')
	{
		document.getElementById("btnPayment").style.visibility = 'visible';
		$("#offlieSubmit").show();
		$("#onlineSubmit").hide();
	}
 $('.nav-tabs a').click(function (e) {
      var activeTab = e.target.hash;
	  if(activeTab == "#Online")
	  {
		   $("#hidPaymentMode").val('ONLINE');
		   $("#offlieSubmit").hide();
		   $("#onlineSubmit").show();
		   document.getElementById("btnPayment").style.visibility = 'hidden';
		   document.getElementById("btnOnline").style.visibility = 'visible';
	   //document.getElementById("btnSave").style.visibility = 'hidden';
	  }
	  else if(activeTab == "#Challan")
	  {
	  	$("#offlieSubmit").show();
		$("#onlineSubmit").hide();
		$("#hidPaymentMode").val('CHALLAN');
	  /* document.getElementById("btnPayment").style.visibility = 'visible';
	   document.getElementById("btnOnline").style.visibility = 'hidden';*/
	   var appl_no=document.getElementById("hidAppNo").value;
		//alert(appl_no);
		
        $("#offline").show();
		//$("#challan").show();
		$("#txtChallanNo").val("");
		$("#txtChallanDate").val("");
		//$("#offlieSubmit").show();
		//$("#onlineSubmit").hide();
		//$('#btnPayment').html("Submit");
   
	   //document.getElementById("btnSave").style.visibility = 'visible';
	 }
	 else if(activeTab == "#SBI")
	 {
	  	$("#offlieSubmit").show();
		$("#onlineSubmit").hide();
		$("#hidPaymentMode").val('SBI');
	   document.getElementById("btnPayment").style.visibility = 'visible';
	   //alert(document.getElementById("btnPayment").style.visibility);
	   document.getElementById("btnOnline").style.visibility = 'hidden';
	   var appl_no=document.getElementById("hidAppNo").value;
		//alert(appl_no);
		
        $("#offlineSbi").show();
		//$("#challan").show();
		$("#txtChallanNo").val("");
		$("#txtChallanDate").val("");
		//$("#offlieSubmit").show();
		//$("#onlineSubmit").hide();
		//$('#btnPayment').html("Submit");
   
	   //document.getElementById("btnSave").style.visibility = 'visible';
	  }
	 
	  
	});
	
	/*$("#radioOffline").click(function () {
		var appl_no=document.getElementById("hidAppNo").value;
		//alert(appl_no);
		$.ajax({
			
			url:"db_apply_2.php",
			mType:"get",
			data:{type:9,application_no:appl_no},
			success:function(response)
			{  				
				var res1 = JSON.parse(response);					
				$.each(res1.aaData,function(i,data)
				{
					if(data.appl_status != "Challan Generated")
					{
						$('#btnPayment').prop('disabled', true);
						//console.log("Hello");
					}
					else
					{
						$('#btnPayment').prop('disabled', false);
					}
				});
				
			},
			error:function()
			{
				alert("We are unable to Process.Please contact Support");
			}
		});
        $("#offline").show();
		//$("#challan").show();
		$("#txtChallanNo").val("");
		$("#txtChallanDate").val("");
		$("#offlieSubmit").show();
		$("#onlineSubmit").hide();
		//$('#btnPayment').html("Submit");
    });
	$("#radioOnline").click(function () {
        $("#offline").hide();
		$('#btnPayment').prop('disabled', false);
		$("#onlineSubmit").show();
		$("#offlieSubmit").hide();
		//$('#btnPayment').html("Proceed for Online Payment");
		//$("#challan").hide();
    });
	if($("input[name=radioPayment]:checked").val()=="CHALLAN")
	{
		$("#offline").show();
		$("#offlieSubmit").show();
		$("#onlineSubmit").hide();
	}
	else if($("input[name=radioPayment]:checked").val()=="ONLINE")
	{
		$("#offline").hide();
		$('#btnPayment').prop('disabled', false);
		$("#onlineSubmit").show();
		$("#offlieSubmit").hide();
		//$('#btnPayment').html("Proceed for Online Payment");
	}
	else if($("input[name=radioPayment]:checked").val()=="ON THE COUNTER")
	{
		$("#offlieSubmit").show();
		$("#onlineSubmit").hide();
	}
	else
	{
		$("#offlieSubmit").show();
		$("#onlineSubmit").hide();
	}*/
	$('#challanfrmApply').bootstrapValidator({
		/* excluded: [':disabled'], */
        message: 'This value is not valid',
        fields: {
			txtChallanAmount: {
                validators: {
             
					numeric: {
							message: 'The value can contain only digits'
					}
                }
           }
		}
	});
	$("#download").click(function(e){
		//e.preventDefault();//this will prevent the link trying to navigate to another page
		//var href = $(this).attr("href");//get the href so we can navigate later
		$('#btnPayment').prop('disabled', false);
		/*var appdata=
				{
					application_no:$("#hidAppNo").val(),
					reg_user_id:$("#hidRegNo").val(),
					seladmcode:$("#hidProgNo").val(),
					type:8	
				};	
		$.ajax({
			url:"db_apply_2.php",
			mType:"get",
			data:appdata,
			success:function()
			{  
				//window.location = href;
				$('#btnPayment').prop('disabled', false);
				window.open(href,'_blank');
			},
			error:function()
			{
				//return false;
			}
		});*/
	});
	$('#challanfrmApply').submit(function (evt) {
		
		var is_north_east = $('#hidis_north_east').val();
		
		if (is_north_east==1){
			evt.preventDefault();
			document.getElementById('challanfrmApply').submit();
			return(true);
		}else{
			evt.preventDefault();
			$('#alertModal').modal('show');
			//window.history.back();
			
			$('.submitbtn').click(function(){
				$('#alertModal').modal('hide');
				document.getElementById('challanfrmApply').submit();
				return(true);
			});
			$('.cancelbtn').click(function(){
				$('#alertModal').modal('hide');
				/*var ins = $("#hidHexIns").val();
				var session = $("#hidSession").val();
				window.location = "preview.php?ins="+ins+"&_s="+session;*/
				$('#btnPay').prop('disabled', false);
				$('#btnPayment').prop('disabled', false);
			}); 
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
	$('#btnPay').click(function(){		
		//$('#preview').hide();
	});
      // datepicker	
    $('#txtChallanDate').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
		endDate:"+0d"
    });
	$('#txtCollectDate').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
		endDate:"+0d"
    });
    
   /* $('#BankSubmitForm').bootstrapValidator({
		excluded:[':disabled',':hidden'],
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
			
			var formData = new FormData(document.getElementById("BankSubmitForm"));
			console.log(formData);return;
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/Bank_challan_submit",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response)
				{  
					
						var obj = jQuery.parseJSON(response);
						alert(obj);
					
				},
				error:function()
				{
					toastr.error('Unable to Save.Please Try Again ');	
				}
			});
		},
		
	});*/
	//$("form[name='BankSubmitForm']").on("submit", function(ev) {
	$("#btnBanksubmit").click(function(){
	  //ev.preventDefault(); // Prevent browser default submit.
		//alert(123);
	  //var formData = new FormData("#BankSubmitForm");
	  //console.log(document.getElementById("BankSubmitForm"));return; 
	  var formData = new FormData(document.getElementById("challanfrmApply"));
	  //var formData = new FormData(document.querySelector('BankSubmitForm'))
	 // console.log(formData); return;
	  
	   //var formElement = document.getElementById("BankSubmitForm");
       //var formData = new FormData(formElement);
       //console.log(formData);return;  
	  	$.ajax({
			url:base_url+"/ajax_controller/Bank_challan_submit",

			// alert(url);return false;
			type:"post",
			data : formData,
			cache: false,
	        contentType: false,
	        processData: false, 
			success:function(response){  
				var obj = jQuery.parseJSON(response);
				//console.log(obj); 
				if(obj.status == true)
				{
					toastr.success(obj.msg);
					window.location.reload();
					//window.location.href = base_url+ "/apply/apply_4/ins/<?=$ins?>";
				}
				else{
					toastr.error(obj.msg);
				}
				//alert(res);
				//window.location.href = base_url+ "/apply/apply_4/ins/<?=$ins?>";
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	 });
	 
	 
	 $("#btnPay").click(function(){
	// $("form[name='btnPayment']").on("submit", function(ev) {
	 	swal({
		  title: "Are you sure?",
		  text: "You Want to Proceed for Application Submission",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes",
		  cancelButtonText: "No",
		  closeOnConfirm: false,
		  closeOnCancel: true
		},
		function(isConfirm){
		  if (isConfirm) {
		  	//deleteMaster();
		    
		  } else {
			    //swal("Document", "News is safe ", "success");
		  }
		});
	 });	
    
});