<!DOCTYPE html>
<html>
	<head>
		<link href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/css/bootstrapValidator.css" rel="stylesheet" type="text/css"/>
		<style type="text/css">
			body {
			 	background:url(<?php echo base_url(); ?>public/assets/images/background.png) no-repeat center fixed;
			    -webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
			 	background-size: cover;
			 	background-size: 100% 100%;
			}
		</style>
	</head>
	<body>
	<div class="col-lg-3">
		
	</div>
	<div class="col-lg-6">
		<?php include_once(dirname(dirname(__FILE__)) . '/template_config/alerts.php');?>
		<div class="well" style="margin-top: 150px;padding: 40px;">
			<?php echo form_open(null, array('class'=>'formchangepassword', 'id'=>'formchangepassword' ,'enctype'=>"multipart/form-data")); ?>
				<div class="form-group">
					<label for="inputname" class="col-lg-5 control-label"><i style="color:red;font-size:15px;">*</i> Current Password</label>
					<div class="col-lg-7">
						<input type="password" class="form-control" id="txtoldPassword" name="txtoldPassword" placeholder="Current Password">
					</div>
					<br/><br/>
				</div>
				
				<div class="form-group">
					<label for="" class="col-lg-5 control-label"><i style="color:red;font-size:15px;">*</i> New Password</label>
					<div class="col-lg-7">
						<input type="password" id="txtNewPassword"class="form-control tooltips"name="txtNewPassword" placeholder="New Password" title="Enter New Password"></input>
					</div>
					<br/><br/>
				</div>
				
				
				<div class="form-group">
					<label for="" class="col-lg-5 control-label"><i style="color:red;font-size:15px;">*</i> Confirm Password</label>
					<div class="col-lg-7">
						<input type="password" id="txtConfirmPassword"class="form-control tooltips"name="txtConfirmPassword" placeholder="Confirm Password" title="Enter Confirm Password"></input>
					</div>
					<br/><br/>
				</div>
				<div class="col-lg-offset-4">
					<button type="submit" class="btn btn-danger" id="btnChangePassword" name= "btnChangePassword" >Change Password</button>
					<button type="button" class="btn btn-primary" onclick="history.back();">Close</button>
				</div>
				<div style="color: red;">
					
				</div>
			</form>
		</div>	
	</div>
	<div class="col-lg-3">
		
	</div>
		<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
		<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrapValidator.js"></script>
		<script type="text/javascript">
			$('#formchangepassword').bootstrapValidator({
				message: 'This value is not valid',
		        feedbackIcons: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },
			submitButtons: 'button[type="submit"]',
			fields: {	
					txtoldPassword: {
							validators: {
								notEmpty: {
									message: 'This field can\'t left blank'
								}
							}
						},
					txtNewPassword: {
							validators: {
								notEmpty: {
									message: 'This field can\'t left blank'
								},
								stringLength: {
			                        min: 6,
			                        max: 25,
			                        message: 'Password Should be between 6 to 25 characters'
                        		},
								identical: {
				                    field: 'txtconfirmpassword',
				                    message: 'New password and its confirm are not the same'
			                	}
							}
						},
						txtConfirmPassword: {
							validators: {
								notEmpty: {
									message: 'This field can\'t left blank'
								},
								stringLength: {
			                        min: 6,
			                        max: 25,
			                        message: 'Password Should be between 6 to 25 characters'
                        		},
								identical: {
				                    field: 'txtNewPassword',
				                    message: 'New password and its confirm are not the same'
			                	}
							}
						}	
				}
		} );
		</script>
	</body>
</html>