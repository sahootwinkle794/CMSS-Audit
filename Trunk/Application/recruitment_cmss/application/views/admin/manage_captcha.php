<div class="content-wrapper">
	<!--<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">News and Announcements</h1>
        </div>
    </div>-->
    <section class="content-header">
      	<h1>
        	Manage Captcha
      	</h1>
    </section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-default">
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
						
							<form class="form-horizontal" id="captchaForm" name="captchaForm">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group" >
											<label for="cmbStatus" class="col-sm-3 control-label" style="color: red; ">Captcha :</label>
											<div class="col-sm-6">
												<label class="radio-inline" >
													<input type="radio" name="captchaenable" id="captchaenableY" value="1" > Enable
												</label>
												<label class="radio-inline">
													<input type="radio" name="captchaenable" id="captchaenableN" value="0" > Disable
												</label>
											</div>
										</div>
									</div>
								</div>
								<div class="row" id = "disablecaptcha">
									<div class="col-lg-6">
										<div class="form-group" >
											<label for="txtentercaptcha" class="col-sm-6 control-label">Enter Captcha :</label>
											<div class="col-sm-6">
												<input type="textbox" class="form-control" name="txtcaptcha" id="txtcaptcha" maxlength="6" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()">
											</div>
										</div>
									</div>
								</div>
								<div style="text-align: right;">
									<button type="submit" class="btn btn-primary" id="programaddsave"><i class="fa fa-save"></i>  Save</button>
									<button type="button" class="btn btn-danger" ><i class="fa fa-close"></i>  Close</button>  
								</div>
							</form>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script type="text/javascript">
	$(document).ready(function()
	{
		$("#disablecaptcha").hide();
		$("#captchaenableN").click(function () { 
			$("#disablecaptcha").show();	
		});
		$("#captchaenableY").click(function () {
			$("#disablecaptcha").hide();	
		});
		get_current_captcha();
		
	});	
	function get_current_captcha() {
		$.ajax({
			url:base_url+"ajax_controller/get_captcha",
			type:"get",
			cache: false,
	        contentType: false,
	        processData: false,
			success:function(response)
			{
				var obj = JSON.parse(response);
				if(obj[0].captcha_status == 1)
				{
					$("#captchaenableY").trigger('click');
				}
				else if(obj[0].captcha_status == 0)
				{
					$("#captchaenableN").trigger('click');
					$("#txtcaptcha").val(obj[0].captcha_text);
				}
			},
			error:function()
			{
				toastr.error('Unable to Save.Please Try Again ');	
			}
		});	
	}
	$('#captchaForm').bootstrapValidator({
		excluded:[':disabled'],
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
			var formData = new FormData(document.getElementById("captchaForm"));
			
			//ajax call to server
			swal({
				title: "Are you sure?",
				// text: " Thank you",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#ee8123",
				confirmButtonText: "Yes, Continue!",
				cancelButtonText: "No",
				closeOnConfirm: true,
				closeOnCancel: true
			},
			function(isConfirm){
			  if (isConfirm) {
				$.ajax({
					url:base_url+"ajax_controller/add_update_captcha",
					type:"post",
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response)
					{  
						console.log(response);
						var obj = JSON.parse(response); 
						if(obj.status == "SUCCESS")
						{
							sweetAlert("Success",obj.msg);		
				 			$('#captchaForm').data('bootstrapValidator').resetForm(true);
				 			get_current_captcha();
						}
						else if(obj.status == "FAILED")
						{
							sweetAlert("Status",obj.msg, "error");
							get_current_captcha();
						}
					},
					error:function()
					{
						toastr.error('Unable to Save.Please Try Again ');	
					}
				});						    
			  } 
			});
		},
	});  	
</script>   