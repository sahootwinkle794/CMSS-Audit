<style>
	.modal-content  {
	    border-radius: 15px !important; 
	}
	.loadingRPimage {
	    position: fixed;
	    top: 0;
	    left: 0;
	    height: 100vh; /* to make it responsive */
	    width: 100vw; /* to make it responsive */
	    overflow: hidden; /*to remove scrollbars */
	    z-index: 99999; /*to make it appear on topmost part of the page */
	    display: none; /*to make it visible only on fadeIn() function */
	    background: none repeat scroll 0% 0% rgba(104, 136, 164, 0.44); /*to make background blur */
	    text-align:center;
	}
</style>
<body style="background: url(<?=base_url()?>public/photos/rink_background.jpg);background-attachment:fixed;">
	<section class="content-header" style="margin-top: 30px;">
      	<h1 style="text-align:center">
        	<u>Create Institute</u>
      	</h1>
    </section>
    <div class="loadingRPimage">
	    <img src="<?=base_url()?>upload/image/loader/loading.gif"/>
	</div>
	<form class="form-horizontal" style="margin-top: 30px;margin-right: 80px;" id="instmanageformid" enctype="multipart/form-data">
		<div id="errorlogInstitute" style="display: none; color: red; font-size: 12px;"></div>
		<div class="row">	
			<div class="col-sm-6">
				<div class="form-group">
					<input type="hidden" id="op_type" name="op_type" value="add_institute">
					<label for="inputname" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Name</label>
					<div class="col-sm-8">
						<input type="text" class="form-control tooltips" onkeyup="changeCase(this)" id="institutename" name="institutename" maxlength="150" title="Name of institute" placeholder="Name of institute">
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Name of Admin</label>
					<div class="col-sm-8">
						<input type="text" class="form-control tooltips" maxlength="30" id="instituteadmindisplayname" name="instituteadmindisplayname" title="Name of Admin" placeholder="Name of Admin">
					</div>
				</div>
			</div>
			
		</div>
		<div class="row">	
			<div class="col-sm-6">
				<div class="form-group">
					<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Institute Type</label>
					<div class="col-sm-6">
						<select class="form-control" id="cmbInstituteType" name="cmbInstituteType"  placeholder="Type of institute" title="Type Of Institute"> 
													
						</select>
					</div>
					<div class="col-sm-2">
						<button type="button" class="btn btn-info tooltips btn-circle" title="Add" id="btnAddType"><i class="fa fa-plus" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Contact No</label>
					<div class="col-sm-8">
						<input type="text" class="form-control tooltips" id="txtContactNo" name="txtContactNo" placeholder="Contact No" title="Contact No" maxlength="12">
					</div>
				</div>
			</div>
		</div>
		<div class="row">	
			<div class="col-sm-6">
				<div class="form-group">
					<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Location</label>
					<div class="col-sm-8">
						<input type="text" class="form-control tooltips" id="txtLocation" onkeyup="changeCase(this)"  name="txtLocation" maxlength="80" placeholder="Location" title="Location">
					</div>
				</div>
			</div>
			<div class="col-sm-6">	
				<div class="form-group">
					<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;E-Mail</label>
					<div class="col-sm-8">
						<input type="text" class="form-control tooltips" id="txtinstituteEmail" name="txtinstituteEmail" maxlength="50" placeholder="Email ID" title="Email ID Of Institute">
					</div>
				</div>
			</div>
			
		</div>
			
		<div class="row">	
			
			<div class="col-sm-6">
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Address</label>
					<div class="col-sm-8">
						<textarea class="form-control tooltips" id="txtAddress" onkeyup="changeCase(this)"  name="txtAddress" placeholder="Address of the Institute" title="Address Of the institute"></textarea>
					</div>
				</div>
			</div>
			<div class="col-sm-6">	
				<div class="form-group">
					<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Web Address</label>
					<div class="col-sm-8">
						<input type="text" class="form-control tooltips" id="txtWebaddress" name="txtWebaddress" placeholder="Web site Address" maxlength="100" title="Web site Address">
					</div>
				</div>
			</div>
			
		</div>	
				
			<!---->
		<div class="row">	
			<div class="col-sm-6">	
				<div class="form-group">
					<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Logo</label>
					<div class="col-sm-8">
						<input type="file" class="form-control" id="fileinstitutelogo" name="fileinstitutelogo" >
					</div>
					<label for="" class="col-sm-offset-4 control-label" style="color: red;">(Dimensions of Logo should be 400px*400px)</label>
				</div>
			</div>
		</div>		
			
		
		<!--<div class="row">	
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">Institute Image</label>
					<div class="col-sm-4">
						<input type="file" id="fileInstituteImage" name="fileInstituteImage" class="form-control"/>
						File-Type: jpg, jpeg, png<br />
						File-Size: 400kb Max<br />
						Dimension: 750*250 pixels
						<div id="signMessage" style="color:red;font-size:16px;"></div>
					</div>
					<div class="col-sm-6">
						<img id='imageDisplayarea' src='' style='margin-left:50px;margin-right:50px;margin-bottom: 20px;' width='200' height='100' />
					</div>
					
				</div>
		</div>-->
		<div class="row">	
			<div class="col-sm-10">
				
			</div>
			<div class="col-sm-2">	
				<div class="form-group">
				    <span id="spanProcessingInstitute" style="display: none">Processing... <img src="<?php echo base_url(); ?>public/assets/images/bx_loader.gif" /></span>
					<button type="submit" class="btn btn-success" id="institutemanageaddsave"><i class="fa fa-save"></i>  Create</button>
				</div>
			</div>
		</div>		
		
	</form>
	<div class="modal fade" id="instituteTypeAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content" style="background: url(<?=base_url()?>public/photos/rink_background.jpg);">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title" id="myModalLabel">Add Institute Type</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form"  id="frmAddInsType" name="frmAddInsType">
						
						<div class="form-group">
							<label for="inputname" class="col-sm-2 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Type</label>
							<div class="col-sm-10">
								<input type="text" class="form-control tooltips" id="txtInsType" name="txtInsType" title="Institute Type" maxlength="20" placeholder="Institute Type">
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-info" id="btnInsTypesave"><i class="fa fa-save"></i> Save</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>  
						</div>
					</form>
				</div>	
			</div>
		</div>
	</div>
	<script>
		$(document).ajaxSend(function(){
		    $('.loadingRPimage').fadeIn(250);
		});
		$(document).ajaxComplete(function(){
		    $('.loadingRPimage').fadeOut(250);
		});
		$('#imageDisplayarea').attr('src', '');
		$("#imageDisplayarea").attr('height','0');
		$("#imageDisplayarea").attr('width','0');
		
		$("#btnAddType").click(function(){
			$('#frmAddInsType').data('bootstrapValidator').resetForm(true);//Reseting the tick marks before opening add modal	
			$('#instituteTypeAdd').modal('show');
			$('#instituteTypeAdd').on('shown.bs.modal', function () 
			{ 
				$('#txtInsType').focus(); // Focusing the textbox
			})
		});
		instituteType();
		function instituteType()
		{
			$.ajax({
				url:base_url+"ajax_controller/select_institute_type",
				type:"post",
				success:function(response){  
					var options = "<option value=''>Select</option>";
					var res1 = JSON.parse(response);
					$.each(res1.aaData,function(i,data){
						options = options + "<option value="+data.code+">"+data.description+"</option>";
						
					});
					$('#cmbInstituteType').html(""); 
					$('#cmbInstituteType').append(options);	
					var insType = $("#txtInsType").val();
					if(insType != '')
					{
						$('#cmbInstituteType').val(insType.toUpperCase());
						$('#instmanageformid').data('bootstrapValidator').updateStatus('cmbInstituteType', 'NOT_VALIDATED', null).validateField('cmbInstituteType');
					}
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
			return true;
		}
		function changeCase(o){
			o.value=o.value.toUpperCase();
		}
		$('#frmAddInsType').bootstrapValidator({
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
				var formData = new FormData(document.getElementById("frmAddInsType"));
				//ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/operation_institute_type_add", 
					type:"post",
					enctype: 'multipart/form-data',
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response)
					{  
						var obj = JSON.parse(response);
						if(obj.status == "SUCCESS")
						{
							var res = instituteType();
							toastr.success(obj.msg);
							$('#instituteTypeAdd').modal('hide');
				    		
						}
						else 
						{
							toastr.error(obj.msg);
							$('#cmbInstituteType').val('');
							$('#instituteTypeAdd').modal('hide');
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
	            txtInsType: {							//form input type name
	                validators: {
	                    notEmpty: {
	                        message: 'The Institute type is required and cannot be empty'
	                    }
	                }
	            }
			}	
		});	

		$('#instmanageformid').bootstrapValidator({
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
				$("#spanProcessinginstitute").show();
				var formData = new FormData(document.getElementById("instmanageformid"));
				if($("#fileinstitutelogo").val() != '')
				{
					var fileUpload = $("#fileinstitutelogo")[0];
					//Initiate the FileReader object.
					var reader = new FileReader();
					//Read the contents of Image File.
					reader.readAsDataURL(fileUpload.files[0]);
					reader.onload = function (e) 
					{
						//Initiate the JavaScript Image object.
						var image = new Image();
						//Set the Base64 string return from FileReader as source.
						image.src = e.target.result;
						image.onload = function () 
						{
						//Determine the Height and Width.
							var height = this.height;
							var width = this.width;

							if (height > 400 || width > 400) 
							{
								toastr.error("Image dimension should be less than or equal to 400px X 400px");
								$("#institutemanageeditsave").removeAttr('disabled');
								$('#instmanageformid').data('bootstrapValidator').updateStatus('fileinstitutelogo', 'NOT_VALIDATED', null).validateField('fileinstitutelogo');
								$("#spanProcessinginstitute").hide();
							}
							else
							{
								$.ajax({
									url:base_url+"ajax_controller/operation_institute_create", 
									type:"post",
									enctype: 'multipart/form-data',
									data:formData,
									cache: false,
							        contentType: false,
							        processData: false,
									success:function(response)
									{  
										var obj = JSON.parse(response);
										if(obj.status == true)
										{
											toastr.success(obj.msg);
											var user = 'SUPERADMIN@'+obj.institute_code;
											swal({
												title: "Congratulations!!!",
												text: "Your Institute has been successfully created. Your Admin credentials are forwarded to your registered mail id. Kindly check and proceed to login",
												//type: "success"
											},
											function(isConfirm) {
											  if (isConfirm) {
											  	window.open(base_url+"user/login/ins/"+obj.enc_institute_code,"_self");
											  }
											});
											
								    		var role =  $('#cmbMenuRole').val();
											$('#errorlogInstitute').html('');
											$('#errorlogInstitute').show();
								    		
										}
										else if(obj.status === 'validationerror'){
						                	$('#errorlogInstitute').html(obj.msg);
						                	$('#errorlogInstitute').show();
						                }
										else if(obj.status === 'xsserror'){
						                	$('#errorlogInstitute').html(obj.msg);
						                	$('#errorlogInstitute').show();
						                }
										else 
										{
											sweetAlert("MENU",obj.msg, "error");	
										}
												
									},
									error:function()
									{
										toastr.error('We are unable to process please contact support');	
									}
								});
							}
						};
					}
				}		
				else
				{
					$.ajax({
						url:base_url+"ajax_controller/operation_institute_create", 
						type:"post",
						enctype: 'multipart/form-data',
						data:formData,
						cache: false,
				        contentType: false,
				        processData: false,
						success:function(response)
						{  
							var obj = JSON.parse(response);
							if(obj.status == true)
							{
								toastr.success(obj.msg);
								var user = 'SUPERADMIN@'+obj.institute_code;
								swal({
									title: "Congratulations!!!",
									text: "Your Institute has been successfully created. Your Admin credentials are forwarded to your registered mail id. Kindly check and proceed to login",
									//type: "success"
								},
								function(isConfirm) {
								  if (isConfirm) {
								  	window.open(base_url+"user/login/ins/"+obj.enc_institute_code,"_self");
								  }
								});
								
					    		var role =  $('#cmbMenuRole').val();
								$('#errorlogInstitute').html('');
								$('#errorlogInstitute').show();
					    		
							}
							else if(obj.status === 'validationerror'){
			                	$('#errorlogInstitute').html(obj.msg);
			                	$('#errorlogInstitute').show();
			                }
							else if(obj.status === 'xsserror'){
			                	$('#errorlogInstitute').html(obj.msg);
			                	$('#errorlogInstitute').show();
			                }
							else 
							{
								sweetAlert("MENU",obj.msg, "error");	
							}
									
						},
						error:function()
						{
							toastr.error('We are unable to process please contact support');	
						}
					});
				}
				//ajax call to server
				
			},
	    	//live: 'enabled',
	        fields:
	         {
	            institutename: {							//form input type name
	                validators: {
	                    notEmpty: {
	                        message: 'The Institute name is required'
	                    },
						stringLength: {
							max: 150,
							message: 'Institute name should not be more then 150 characters'
						}
	                }
	            },
	            txtWebaddress:{
	                validators: {
	                    notEmpty: {
	                        message: 'Website Address is required'
	                    },
	                    uri: {
							message: 'The input is not a valid URL'
						},
						stringLength: {
							max: 100,
							message: 'Website Address should not be more then 100 characters'
						}
	                }
	            },
	            txtContactNo: {
	                validators: {
	                    notEmpty: {
	                        message: 'Contact No is required'
	                    },
	                    digits: {
								message: 'The value can contain only digits'
							},
						stringLength: {
							min: 10,
							max: 12,
							message: 'Contact no must be less than 10 characters'
						}
	                }
	            },
	            txtinstituteEmail: {
	                validators: {
	                	notEmpty: {
							message: 'Email is required'
						},
						emailAddress: {
	                        message: 'The value is not a valid email address'
	                    },
						stringLength: {
							max: 50,
							message: 'Email should not be more then 50 characters'
						}
	                }
	            },
				cmbInstituteType: {
	                validators: {
	                    notEmpty: {
	                        message: 'Institute Type is required'
	                    }
	                }
	            },
				fileinstitutelogo: {
	                validators: {
	                    notEmpty: {
	                        message: 'Logo is required'
	                    }
	                }
	            },
				txtLocation: {
	                validators: {
	                    notEmpty: {
	                        message: 'Location is required'
	                    }
	                }
	            },
				instituteadmindisplayname: {
	                validators: {
	                    notEmpty: {
	                        message: 'Admin name is required'
	                    },
						stringLength: {
							max: 30,
							message: 'Admin name should not be more then 30 characters'
						}
	                }
	            }
			}	
		});	
		$('#fileInstituteImage').change(function()			
		{ 
			var file = document.getElementById("fileInstituteImage").files[0];
			//alert(file);
			var sFileName = file.name;
			//alert(sFileName);
			var file_path = file.path;
			//alert(file.mozFullPath);
	        var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
	        var iFileSize = file.size;
	        //var iConvert = (file.size / 1048576).toFixed(2);
	        if (sFileExtension == "jpg" || sFileExtension == "jpeg" || sFileExtension == "png" )
			{ 
				if(iFileSize <= 409600)
				{
				
				  document.getElementById("signMessage").innerHTML="";
				  $("#imageDisplayarea").attr('height','0');
				  $("#imageDisplayarea").attr('width','0');
				  readURLSig(this);
				  
				}
				else
				{
					//alert("File size exceeds 1 MB.");
					document.getElementById("signMessage").innerHTML="Error : File size exceeds 400 KB";
					$('#fileInstituteImage').val("");
					$('#imageDisplayarea').attr('src','');
					$("#imageDisplayarea").attr('height','0');
					$("#imageDisplayarea").attr('width','0');
				}
	        }
			else
			{
	            //alert("Invalid File Format");
				document.getElementById("signMessage").innerHTML="Error : Invalid File Format";
				$('#fileControllerSignature').val("");
				$('#imageDisplayarea').attr('src','');
				$("#imageDisplayarea").attr('height','0');
				$("#imageDisplayarea").attr('width','0');
			}
			
		});
		function readURLSig(input) {
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();
	            
	            reader.onload = function (e) {
	                $('#imageDisplayarea').attr('src', e.target.result);
					$("#imageDisplayarea").attr('height','100');
					$("#imageDisplayarea").attr('width','200');
	            }
	            
	            reader.readAsDataURL(input.files[0]);
	        }
	    }
	</script>
</body>