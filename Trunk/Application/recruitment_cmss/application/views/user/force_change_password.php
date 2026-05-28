<!DOCTYPE html>
<?php 

$user_name = $this->session->userdata('user_name');
$attempt_history = $this->session->userdata('attempt_history');
$key = $this->session->userdata('key');
//print_r($_SESSION);
//print_r($attempt_history);
if($user_name == '' || $attempt_history == '')
{
	redirect('index/institute_not_found');
}
?>
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
			<?php echo form_open(null, array('class'=>'frmApply', 'id'=>'frmApply', 'name'=>'frmApply' ,'enctype'=>"multipart/form-data")); ?>
			<!--<form class="form-horizontal frmApply" id="frmApply" name="frmApply" enctype="multipart/form-data" >-->
				<input type="hidden" name="shapasswordOld" id="shapasswordOld"/>
				<!--<input type="hidden" name="passwordNew" id="passwordNew"/>-->
				<input type="hidden" name="shapasswordNew" id="shapasswordNew"/>
				<input type="hidden" name="shapasswordNewOne" id="shapasswordNewOne"/>
				<input type="hidden" name="shapasswordConfirm" id="shapasswordConfirm"/>
				
				<input type="hidden" name="user_name" id="user_name" value="<?php echo $user_name ?>"/>
				<input type="hidden" name="key" id="key" value="<?php echo $key ?>"/>
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
					<button type="submit" class="btn btn-danger" onClick="return do_submit()" id="btnChangePassword" name= "btnChangePassword" >Change Password</button>
					<button type="button" class="btn btn-primary" onclick="window.location.href='<?=base_url()?>logout'">Logout</button>
				</div>
				<div style="color: red;">
					
				</div>
			</form>
		</div>	
	</div>
	<div class="col-lg-3">
		
	</div>
		<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery.min.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-ui.min.js"></script>
		<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
		<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrapValidator.js"></script>
		<script src="<?php echo base_url(); ?>public/assets/js/md5_5034.js"></script>
		<script src="<?php echo base_url(); ?>public/assets/js/profile_sha.js"></script>
		<script src="<?php echo base_url(); ?>public/assets/js/sha512.js"></script>
		<!--<script src="<?php echo base_url(); ?>public/template_lib/plugins/sweetalert/sweetalert.min.js"></script>-->
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/force_change_password.js"></script>
		<script type="text/javascript">
			
		
		/*function do_submit()
		{
			alert(document.getElementById('txtoldPassword').value);
			var md5KeyValue = "<?php echo $this->session->userdata('key');?>";
			if(md5KeyValue == ''){
				alert('Session Expired.Please Try Again!');
				window.location.reload();
				return;
			}
			if($("#txtUsername").val() == '' || $("#txtPassword").val() == '')
			{
				toastr.error("Please enter username and password");
				return false;
			}
			//added for CR 5034 - begin.
			//var username ="abcd@abcd";
			var username = document.frmApply.user_name.value;	
			var oldpassword = document.frmApply.txtoldPassword.value;
			var regexp = new RegExp("\\d{19}");	
			var newpassword = document.frmApply.txtNewPassword.value;
			var regexp = new RegExp("\\d{19}");
			var confirmpassword = document.frmApply.txtConfirmPassword.value;
			var regexp = new RegExp("\\d{19}");
			//document.frmApply.passwordNew.value = newpassword; //changed
			

	        //document.getElementById("btnCheck").disabled=true;
	        var md5keystring = md5KeyValue;//document.quickLookForm.md5key.value ;
	        console.log(oldpassword);
			console.log(username);
			console.log(md5keystring);
			alert(oldpassword);
			alert(username);
			alert(md5keystring);

			var encSaltPassOld = encryptLoginPassword(md5keystring,username,oldpassword);
			var encSaltSHAPassOld = encryptSha2LoginPassword(md5keystring,username,oldpassword);
			
			var encSaltPassNew = encryptLoginPassword(md5keystring,username,newpassword);
			var encSaltSHAPassNew = encryptSha2LoginPassword(md5keystring,username,newpassword);
			var encSaltSHAPassNewOne = encryptSha2ChangePassword(md5keystring,username,newpassword);
			
			var encSaltPassConfirm = encryptLoginPassword(md5keystring,username,confirmpassword);
			var encSaltSHAPassConfirm = encryptSha2LoginPassword(md5keystring,username,confirmpassword);
			//alert(username);
			document.frmApply.txtoldPassword.value = encSaltPassOld; //changed
			document.frmApply.shapasswordOld.value = encSaltSHAPassOld; //changed
			
			document.frmApply.txtNewPassword.value = encSaltPassNew; //changed
			document.frmApply.shapasswordNew.value = encSaltSHAPassNew; //changed
			document.frmApply.shapasswordNewOne.value = encSaltSHAPassNewOne; //changed
			
			document.frmApply.txtConfirmPassword.value = encSaltPassConfirm; //changed
			document.frmApply.shapasswordConfirm.value = encSaltSHAPassConfirm; //changed
			//document.frmApply.key.value = md5keystring; //changed
			//return false;
			document.frmApply.submit();
			var oldpassword ="";
			var newpassword ="";
			var confirmpassword ="";
			return true;
			
		}*/
		$(document).ready(function() {
			<?php if($this->session->flashdata('info')){ ?>
				swal({
					title: "Change Password",
					text: "Password Changed Successfully",
					//type: "success"
					},
					function(isConfirm) {
					  if (isConfirm) {
					  	window.location.href = ("<?=base_url() ?>logout");
					  }
					});
			<?php } ?>
			
			<?php if($this->session->flashdata('error')){ ?>
				swal({
					title: "Change Password",
					text: "Error in changing password",
					//type: "success"
					},
					function(isConfirm) {
					  if (isConfirm) {
					  	window.location.reload();	
					  	//window.location.href = ("<?php echo base_url() ?>index/institute_home/ins/<?php echo $ins; ?>");
					  }
					});
			<?php } ?>
		});
		</script>
	</body>
</html>