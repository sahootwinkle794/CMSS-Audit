<script type="text/javascript">
function validate(){
	//alert("Validate");
	var phone = $('#txtCandidatePhone').val();
	var errorMessage = "";
	var message = '<div>';
	if(document.getElementById("hidFirstNameStatus").value != '')
	{
		if(document.getElementById("txtFirstName").value == '')
		{
			errorMessage += "Please enter your First Name.<br/>";
		}
	}
	if(document.getElementById("hidMidNameStatus").value != '')
	{
		if(document.getElementById("txtMiddleName").value == '')
		{
			errorMessage += "Please enter your Middle Name.<br/>";
		}
	}
	if(document.getElementById("hidLastNameStatus").value != '')
	{
		if(document.getElementById("txtLastName").value == '')
		{
			errorMessage += "Please enter your Last Name.<br/>";
		}
	}
	if(document.getElementById("hidRegUserIdStatus").value != '')
	{
		if(document.getElementById("txtCandidatePhone").value == '')
		{
			errorMessage += "Please enter Phone No.<br/>";
		}
	}
	if(document.getElementById("hidEmailStatus").value != '')
	{
		if(document.getElementById("txtEmail").value == '')
		{
			errorMessage += "Please enter Email Id.<br/>";
		}
	}
	if(document.getElementById("hidDobStatus").value != '')
	{
		if(document.getElementById("txtdob").value == '')
		{
			errorMessage += "Please enter Date of Birth.<br />";
		}
	}
	if(document.getElementById("txtCaptcha").value == '')
	{
		errorMessage += "Please enter the security code.";
	}
	
	if (/[^a-zA-Z0-9\-\/]/.test(document.getElementById("txtFirstName").value) 
		|| /[^a-zA-Z0-9\-\/]/.test(document.getElementById("txtLastName").value)
		|| /[^a-zA-Z0-9\-\/]/.test(document.getElementById("txtCandidatePhone").value)
		|| /[^a-zA-Z0-9\-\/]/.test(document.getElementById("txtdob").value)
		|| /[^a-zA-Z0-9\-\/]/.test(document.getElementById("txtCaptcha").value)
		)
	{
		errorMessage += "<br/>Special characters are not allowed in any of the fields.<br/>";
	}
	if(errorMessage != "")
	{
		message += errorMessage + "</div>";
		//alertmessage.innerHTML = message;
		document.getElementById("alertmessage").innerHTML=message;
		$('.alert').show();
		return false;	 
	}
	else
		return true;
}
function validate1(){
	var phone = $('#txtCandidatePhone1').val();
	var errorMessage = "";
	var message = '<div>';
	if(document.getElementById("txtCandidatePhone1").value == '')
	{
		errorMessage += "Please enter Registered Mobile No / Email / Application No <br/>";
	}
	if(document.getElementById("txtdob1").value == '')
	{
		errorMessage += "Please enter Date of Birth.";
	}
	if(errorMessage != "")
	{
		message += errorMessage + "</div>";
		//alertmessage.innerHTML = message;
		document.getElementById("alertmessage").innerHTML=message;
		$('.alert').show();
		return false;	 
	}
	else
		return true;
}
function validate2(){
	var errorMessage = "";
	var message = '<div>';
	if(document.getElementById("txtVerifyCode").value == '')
	{
		errorMessage += "Please enter Verification Code.";
	}
	if(errorMessage != "")
	{
		message += errorMessage + "</div>";
		//alertmessage.innerHTML = message;
		document.getElementById("alertmessage").innerHTML=message;
		$('.alert').show();
		return false;	 
	}
	else
		return true;
}
</script>

  </head>

  <body>

    <!-- Fixed navbar -->
    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <?php include('include/header.php'); 
	  main_menu(2,$seladmcode);
	  ?>
    </div>
	<input type="hidden" name="hidPageCode" id="hidPageCode" value="REGISTRATION"/>
	<div class="container" style="margin-top: 90px; padding-bottom: 50px;">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">
					<div class="panel-heading project-heading" align="center">
<?php if(isset($_SESSION['admcode']) && $institute_code_original != '')
{ ?>
					<h2 class="panel-title project-title" style="font-size: 20px"><b><a  href="projectIndex.php?admcode=<?=$admcode?>&ins=<?=$hex_ins_code?>&_s=<?=$MY_SESSION_NAME?>"><?php echo $admname; ?></a></b></h2>
				</div>
				
			</div>	
			
				
		</div>		
	</div>		
<?php
if(!$can_apply)
{
	echo "<p style=\"font:20px bold tahoma; color:red; text-align:center\">APPLICATION TIME IS OVER</p>";
}
else
{
?>		
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">		
				<div class="panel panel-primary">
					<div class="panel-heading step-heading">
<?php if($mode=="edit") { ?>
							<b><i class="fa fa-user"></i> Verification</b>
<?php } else if($mode=="new") { ?>
							<b><i class="fa fa-user"></i> Registration</b>
<?php } ?>
					
					<a href="#" class="pull-right" style="margin-top: -0.5%;margin-right: 0.2%" id="btnInstruction" name="btnInstruction" title="Help"><i class="fa fa-question-circle fa-2x" ></i></a>
					
					</div>
				
				<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;"> <!-- Alert for error -->
					<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
					<div id="alertmessage"></div>
				</div>
				<?php if($show==2) { ?>
				<div class="alert alert-danger alert-dismissible" role="alert"> <!-- Alert for error -->
					<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
					<div id="alertmessage1">Invalid Security Code! You can not proceed to next step.</div>
				</div>
				<?php } ?>
				<?php if($show==10) { ?>
				<div class="alert alert-danger alert-dismissible" role="alert"> <!-- Alert for error -->
					<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
					<div id="alertmessage1">Please Check All Mendatory Fields.</div>
				</div>
				<?php } ?>
				<?php if($show1==3) { ?>
				<div class="alert alert-danger alert-dismissible" role="alert"> <!-- Alert for error -->
					<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
					<div id="alertmessage2">Incorrect Verification Code.</div>
				</div>
				<?php } ?>
				<?php if($show1==4) { ?>
				<div class="alert alert-danger alert-dismissible" role="alert"> <!-- Alert for error -->
					<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
					<div id="alertmessage3">You have already registered with this mobile no. Please enter your Verification Code.</div>
				</div>
				<?php } ?>
				<?php if($show1==5) { ?>
				<div class="alert alert-danger alert-dismissible" role="alert"> <!-- Alert for error -->
					<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
					<div id="alertmessage4">You have already registered with this mobile no. Try with another one.</div>
				</div>
				<?php } ?>
				<?php if($show1==6) { ?>
				<div class="alert alert-danger alert-dismissible" role="alert"> <!-- Alert for error -->
					<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
					<div id="alertmessage5">The Mobile no / Email / Application No or Date of Birth is incorrect or you mayn't have verified your Mobile no / Email / Application No.</div>
				</div>
				<?php } ?>
				<?php if($show1==7) { ?>
				<div class="alert alert-danger alert-dismissible" role="alert"> <!-- Alert for error -->
					<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
					<div id="alertmessage5">You don't have access to edit your data as you have submitted the payment information.</div>
				</div>
				<?php } ?>
				<?php if($show1==8) { ?>
				<div class="alert alert-danger alert-dismissible" role="alert"> <!-- Alert for error -->
					<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
					<div id="alertmessage5">You have completed 2 attempts on Resend button. You aren't allowed for further attempt.</div>
				</div>
				<?php } ?>
				<?php if($show1==9) { ?>
				<div class="alert alert-danger alert-dismissible" role="alert"> <!-- Alert for error -->
					<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
					<div id="alertmessage5">You have already registered, but your Date of birth is incorrect.</div>
				</div>
				<?php } ?>
				<?php if($show==11) { ?>
				<div class="alert alert-danger alert-dismissible" role="alert"> <!-- Alert for error -->
					<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
					<div id="alertmessage5">Invalid Date of Birth..Please enter in DD-MM-YYYY Format (e.g. 20-02-2000)</div>
				</div>
				<?php } ?>
				<?php if($show==12) { ?>
				<div class="alert alert-danger alert-dismissible" role="alert"> <!-- Alert for error -->
					<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
					<div id="alertmessage5">Date of Birth is Before <?=$birth_start_date?> or After <?=$birth_end_date?></div>
				</div>
				<?php } ?>
				<?php if($show==13) { ?>
				<div class="alert alert-danger alert-dismissible" role="alert"> <!-- Alert for error -->
					<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
					<div id="alertmessage5">The Mobile no / Email / Application No or Date of Birth is incorrect or you mayn't have paid for your application.</div>
				</div>
				<?php } ?>
				<div class="modal fade" id="modalInstruction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header" style="background-color: #496cad;color: white;">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" style="color: white;" id="myModalLabel">Help</h4>
				      </div>
				      <div class="modal-body" id="divInstruction">
				     
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				      </div>
				    </div>
				  </div>
				</div>
				<?php if($mode=="new") { ?>
							<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:20px;">
							  <?php if($remove != 1) { ?>
							  <form class="form-horizontal" method="post" role="form" id="frmApplyNew" name="frmApplyNew">
							  	<input  type="hidden" id="hidProgram" name="hidProgram" value="<?=$seladmcode?>"/>
								<table class="table table-striped tblRegistration" align="center">
									<tr style="height:10px;">
										<td>
											<label for="" class="control-label" style="align:left;"><i style="color:red;font-size:18px;">*</i> First Name :</label>
										</td>
										<td colspan="2">
											<div class="form-group">
												<input type="text" class="form-control" id="txtFirstName"  name="txtFirstName" placeholder="First Name" value="<?php echo $first_name; ?>" style="text-transform: uppercase; width: 40%">
											</div>
											<input  type="hidden" value="<?=$first_name_status?>" name="hidFirstNameStatus" id="hidFirstNameStatus"/>
										</td>
										
									</tr>
									<tr>
										<td>
											<label for="" class="control-label" style="align:left;"> Middle Name :</label>
										</td>
										<td colspan="2">
											<div class="form-group">
												<input type="text" class="form-control" id="txtMiddleName" name="txtMiddleName"  placeholder="Middle Name" value="<?php echo $middle_name; ?>"  style="text-transform: uppercase;width: 40%">
											</div>
											<input  type="hidden" value="<?=$mid_name_status?>" name="hidMidNameStatus" id="hidMidNameStatus"/>
										</td>
										
									</tr>
									<tr>
										<td>
											<label for="" class="control-label" style="align:left;"><i style="color:red;font-size:18px;">*</i> Last Name :</label>
										</td>
										<td colspan="2">
											<div class="form-group">
												<input type="text" class="form-control" id="txtLastName" name="txtLastName" placeholder="Last Name" value="<?php echo $last_name; ?>"  style="text-transform: uppercase;width: 40%">
											</div>
											<input  type="hidden" value="<?=$last_name_status?>" name="hidLastNameStatus" id="hidLastNameStatus"/>
										</td>
										
									</tr>
									<tr>
										<td>
											<label for="" class="control-label" style="align:left;"><i style="color:red;font-size:18px;">*</i> Mobile No :</label>
										</td>
										<td style="width: 35%">
											<div class="form-group">
												<input type="text" class="form-control" id="txtCandidatePhone" name="txtCandidatePhone" placeholder="Enter Your Mobile No" maxlength="10" style="width: 74%" value="<?php echo $phone_no; ?>" >
											</div>
											<input  type="hidden" value="<?=$reg_user_id_status?>" name="hidRegUserIdStatus" id="hidRegUserIdStatus"/>
										</td>
										
										<td>
											<span class="text-info">10 digits (e.g. 9876543217)</span>
										</td>
									</tr>
									<tr>
										<td>
											<label for="" class="control-label" style="align:left;"> Email :</label>
										</td>
										<td>
											<div class="form-group">
												<input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="Enter Your Email"  value="<?php echo $email; ?>" style="width:90%">
											</div>
											<input  type="hidden" value="<?=$email_status?>" name="hidEmailStatus" id="hidEmailStatus"/>
										</td>
										<td>
											<span id="spanEmail" style="color: red; font-size:12px"></span>
										</td>
									</tr>
									<tr>
										<td>
											<label for="" class="control-label" style="align:left;"><i style="color:red;font-size:18px;">*</i> Date of Birth :</label>
										</td>
										<td>
											<div class="form-group">
												<input type="text" class="form-control" id="txtdob" autocomplete="off" name="txtdob" style="width: 40%" placeholder="Pick Date" value="<?php echo $dob; ?>" >
											</div>
											<input  type="hidden" value="<?=$dob_status?>" name="hidDobStatus" id="hidDobStatus"/>
										</td>
										<td>
											<span class="text-info">dd-mm-yyyy (e.g. 20-02-2000)</span>
										</td>
									</tr>
									<tr>
										<td>
								
										</td>
										<td>
											<div class="form-group">
												<input type="hidden" id="hidInfo" value="" name="hidInfo" />
												<img src="include/captchaimages.php?width=200&height=40&characters=5" id="captcha" alt="captcha" />
												<button type="submit"  value="" name="btnReload" id="btnReload" onclick="reload()"><i class="fa fa-refresh"></i></button>
											</div>										
										</td>
										<td>
											
											
										</td>
									</tr>
									<tr>
										<td>
											<label for="" class="control-label" style="align:left;">Enter Above Security Code :</label>
										</td>
										<td>
											<div class="form-group">
												<input type="text" id="txtCaptcha" class="form-control" name="txtCaptcha" size="14" maxlength="6" onkeydown="tolower(this);"  onkeyup="tolower(this);" style="width:30%" />
											</div>
										</td>
										<td>
											
										</td>
									</tr>
								</table>
								<div class="form-group" style="margin-bottom: 1%">
									<div class="col-lg-12" align="center">
										<button type="submit" class="btn btn-primary" id="btnSubmit" name="btnSubmit"  onClick="return validate();">Submit</button>
									</div>
								</div>
								
								
							  </form>
							  <?php } ?>
							  <?php if($show==1) { ?>
							  <form class="form-horizontal" method="post" role="form" id="frmResend1" name="frmResend1" >
									
										<div class="form-group">
											<label for="" class="col-sm-12 control-label" style="text-align:left;">A verification code has been sent to your mobile no. Please enter the code below.
											</label>
											
										</div>
							   </form>
							   <form class="form-horizontal" method="post" role="form" id="frmVerify" name="frmVerify" >
										<div class="form-group">
											<label for="" class="col-sm-2 control-label col-sm-offset-2" style="align:left;">Verification Code :</label>
											<div class="col-sm-3">
												<input type="text" class="form-control" id="txtVerifyCode" name="txtVerifyCode" placeholder="Enter Code" >
											</div>
											<div class="col-lg-3">
												<button type="submit" class="btn btn-primary" id="btnVerify" name="btnVerify" style="background:#9D426B;" onclick="return validate2();">Verify</button>
											</div>
										</div>
							   </form>
							   <form class="form-horizontal" method="post" role="form" id="frmResend" name="frmResend" >
									
										<div class="form-group">
											<label for="" class="col-sm-12 control-label" style="text-align:left;">
											If you have not received any code, please click on the Resend button. <button type="submit" class="btn btn-primary" id="btnResend" name="btnResend" style="background:#9D426B;" >Resend</button></label>
											
										</div>
							   </form>
							  <?php } ?>
							</div>
						<?php } 
					  else if($mode=="edit") { ?>
							<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:20px;">
							  <form class="form-horizontal" method="post" role="form" id="frmApply" name="frmApply" >
								<input type="hidden" id="hidInput" name="hidInput" value=""/>
								<table class="table table-striped tblRegistration" style="" align="center">
									<tr>
										<td>
											<label for="" class="control-label" style="align:left;">Registered Mobile No / Email / Application No :</label>
										</td>
										<td>
											<input type="text" class="form-control" id="txtCandidatePhone1" name="txtCandidatePhone1" placeholder="Mobile No / Email / Application No" >
										</td>
										<td>
											<span id="spanPhone" style="color: red; font-size:12px"></span>
										</td>
									</tr>
									<tr>
										<td>
											<label for="" class="control-label " style="align:left;">Date of Birth :</label>
										</td>
										<td>
											<input type="text" class="form-control" id="txtdob1" name="txtdob1" placeholder="Pick Date" >
										</td>
										<td>
											<p class="text-info" style="margin-top:2.5%;">dd-mm-yyyy (e.g. 20-02-2000)</p>
										</td>
									</tr>
								</table>
								<div class="form-group">
									<div class="col-lg-12" align="center">
										<button type="submit" class="btn btn-primary" id="btnCheck" name="btnCheck"  onClick="return validate1();">Proceed</button>
									</div>
								</div>
							  </form>
							</div>
						<?php } ?>
						
					</div>
				</div>
<?php
}
?>			
			<?php } 
			else
			{ ?>
			<div class="col-lg-12">
				<br>
				<center><h3>You don't have access to this page.</h3></center>
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			</div>
			<?php } ?>
		</div><!--/row-->
	  
	</div><!--/container-->