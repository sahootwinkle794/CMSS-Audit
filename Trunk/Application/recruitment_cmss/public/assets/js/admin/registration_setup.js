$(document).ready(function(){
	
	$('#txtRegStart').datepicker({
		format: 'dd-mm-yyyy',
		autoclose:true,
		
	}).on('changeDate', function (selected) {
	    var startDate = new Date(selected.date.valueOf());
	    $('#txtRegEnd').datepicker('setStartDate', startDate);
	});
    $('#txtRegEnd').datepicker({
		format: 'dd-mm-yyyy',
		autoclose:true,
		onSelect: function (date) {
            var date2 = $('#txtRegEnd').datepicker('getDate');
           // date2.setDate(date2.getDate() + 1);
           // $('#txtEnddate').datepicker('option', 'maxDate', date2);
			/*$('#txtAppStart').datetimepicker('option', 'maxDate', date2);
			$('#txtAppEnd').datetimepicker('option', 'maxDate', date2);*/
			//$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtEnddate', 'VALID', null);
        }
	});
	$( "#txtAppStart" ).datetimepicker({
			dateFormat: 'dd-mm-yy',
			onSelect: function (date) {
            var date2 = $('#txtAppStart').datetimepicker('getDate');
            date2.setDate(date2.getDate() + 1);
            $('#txtAppEnd').datetimepicker('option', 'minDate', date2);
            //$('#frmAddProgram').data('bootstrapValidator').updateStatus('txtAppStartdate', 'VALID', null);
			//$('#txtAppStartdate').datetimepicker('option', 'minDate', date2);
        	}
			/*minDate:'0',*/
		});
	$( "#txtAppEnd" ).datetimepicker({
		dateFormat: 'dd-mm-yy',
		/*minDate:'0',*/
		onSelect: function (date) {
            var date2 = $('#txtAppEnd').datepicker('getDate');
           // $('#txtEnddate').datepicker('option', 'maxDate', date2);
			$('#txtAppStart').datetimepicker('option', 'maxDate', date2);
	
           // $('#frmAddProgram').data('bootstrapValidator').updateStatus('txtAppEnddate', 'VALID', null);
			//$('#txtAppStartdate').datetimepicker('option', 'minDate', date2);
        	}
		
	});
	
	
	$('#txtEliFrom').datepicker({
		format: 'dd-mm-yyyy',
		autoclose: true,
		
	}).on('changeDate', function (selected) {
	    var startDate = new Date(selected.date.valueOf());
	     $('#txtEliUpto').datepicker('setStartDate', startDate);
	});
	
	$('#txtEliUpto').datepicker({
		format: 'dd-mm-yyyy',
		autoclose: true,
		onSelect: function (date) {
            var date2 = $('#txtEliUpto').datepicker('getDate');
        }
	});
	
	$('#programaddsave').click(function(){
		/*date1 = new Date($('#txtEliFrom').val());
		alert($('#txtEliFrom').val());
		date2 = new Date($('#txtEliUpto').val());
		alert(date2);*/
		var txtEliFrom = $('#txtEliFrom').val();
		var newdate = txtEliFrom.split("-").reverse().join("-");
		var txtEliUpto = $('#txtEliUpto').val();
		var newdate1 = txtEliUpto.split("-").reverse().join("-");
		date1 = new Date(newdate);
		date2 = new Date(newdate1);
		//$('#frmRegistrationSetup').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal
		if($('#txtRegStart').val() == '')
		{
			toastr.error('Please enter registration start date');
		}
		else if($('#txtRegEnd').val() == '')
		{
			toastr.error('Please enter registration end date');
		}
		else if($('#txtRegStart').val() > $('#txtRegEnd').val())
		{
			toastr.error('Registration start date should be greater than Registration end date');
		}
		
		else if(date1 >= date2)
		{ 
			toastr.error('Eligibility From date should be greater than Eligibility Upto date');
		}
		/*else if($('#txtAppStart').val()== '')
		{
			toastr.error('Please enter Apply start date');
		}
		else if($('#txtAppEnd').val() == '')
		{
			toastr.error('Please enter Apply end date');
		}*/
		/*else if($('#txtEliFrom').val() == '')
		{
			toastr.error('Please enter Eligibility From');
		}
		else if ($('#txtEliUpto').val() == '')
		{
			toastr.error('Please enter Eligibility Upto');
		}*/
		else
		{
			if($('#txtEliFrom').val() != '' && $('#txtEliUpto').val() != '')
			{
				/*alert($('#txtEliFrom').val());
				alert($('#txtEliUpto').val());*/
				if($('#txtEliFrom').val() > $('#txtEliUpto').val())
				{
					toastr.error('Eligibility From Date should be greater than Eligibility Upto Date');
					return false;
				}
				else
				{
					//alert("gfdgfd");
					var institutedata={
						txtRegStart:$('#txtRegStart').val(),
						txtRegEnd:$('#txtRegEnd').val(),
						txtAppStart:$('#txtAppStart').val(),
						txtAppEnd:$('#txtAppEnd').val(),
						txtEliFrom:$('#txtEliFrom').val(),
						txtEliUpto:$('#txtEliUpto').val()
					};
					//ajax call to server
					$.ajax({
						url:base_url+"ajax_controller/insert_registration_setup",
						type:"post",
						data:institutedata,
						success:function(response){  
							var obj = jQuery.parseJSON(response);
							//alert(obj.status);
							if(obj.status)
							{
								$("#spanProcessingProgram").hide();
								//$('#frmRegistrationSetup').data('bootstrapValidator').resetForm(true);	
								/*$('#txtRegStart').val("");
								$('#txtRegEnd').val("");
								$('#txtAppStart').val("");
								$('#txtAppEnd').val("");
								$('#txtEliFrom').val("");
								$('#txtEliUpto').val("");*/
								toastr.success(obj.msg);
							}
							else
							{
								toastr.error(result.dbMessage);
								//$('#frmRegistrationSetup').data('bootstrapValidator').resetForm(true);	
							}			
						},
						error:function(){
							toastr.error('Unable to process please contact support');
						}
					});
				}
			}
			else
			{
				var institutedata={
					txtRegStart:$('#txtRegStart').val(),
					txtRegEnd:$('#txtRegEnd').val(),
					txtAppStart:$('#txtAppStart').val(),
					txtAppEnd:$('#txtAppEnd').val(),
					txtEliFrom:$('#txtEliFrom').val(),
					txtEliUpto:$('#txtEliUpto').val()
				};
				//ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/insert_registration_setup",
					type:"post",
					data:institutedata,
					success:function(response){  
						var obj = jQuery.parseJSON(response);
						//alert(obj.status);
						if(obj.status)
						{
							$("#spanProcessingProgram").hide();
							//$('#frmRegistrationSetup').data('bootstrapValidator').resetForm(true);	
							/*$('#txtRegStart').val("");
							$('#txtRegEnd').val("");
							$('#txtAppStart').val("");
							$('#txtAppEnd').val("");
							$('#txtEliFrom').val("");
							$('#txtEliUpto').val("");*/
							toastr.success(obj.msg);
						}
						else
						{
							toastr.error(result.dbMessage);
							//$('#frmRegistrationSetup').data('bootstrapValidator').resetForm(true);	
						}			
					},
					error:function(){
						toastr.error('Unable to process please contact support');
					}
				});
			}
				
		}
		
	});
	

});