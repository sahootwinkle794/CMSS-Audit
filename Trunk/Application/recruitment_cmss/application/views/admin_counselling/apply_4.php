<?php
$institute_code_original = '';
$mode = $this->session->userdata('mode');
$noamount=0;
$edit = "false";
$applshow=0;
$show=0;
$print=0;
$noamount=0;
$showChallanInfo=0;
$edit="false";
$editappl="false";

$reg_user_id = $this->session->userdata('reg_user_id');
$application_no = $this->session->userdata('appl_no');
foreach($appl_status as $row)
{
	$appl_status = $row['appl_status'];
}

foreach($institute_data as $row)
{
	$institute_code_original = $row['institute_code'];
	$institute_name = $row['institute_name'];
	$ins = encrypt_decrypt('encrypt',$institute_code_original);
}

foreach($program_data as $row)
{
	$admcode = $row['program_code'];
	$seladmcode = $row['program_code'];
	$admname = $row['program_name'];
	$file_name = $row['file_name'];
	$app_start_date = $row['apply_start_date'];
	$app_end_date = $row['apply_end_date'];
	//echo $app_start_date."-----------";
	//echo $app_end_date;
	$app_start_date = strtotime($app_start_date);
	$app_end_date = strtotime($app_end_date);
}

foreach($regdata as $row)
{
	$reg_mode = $row['reg_mode'];
	$Email = $row['email_id'];
}
$count = 1;
//print_r($paymodedata);
foreach($paymodedata as $row)
{
	
	$active_tab = $row['description'];
	//$payment_mode= $row['payment_mode'];
	if($count == 1)
		$active_tab = $row['description'];
	$payment_mode_detail[] = $row['description'];
	$count++;
	
}

foreach($tempcodedata as $row)
{
	$temp_code = $row['template_code'];
}
foreach($depositmode as $row1)
{
	$deposit_mode = $row1['money_deposit_mode'];
	$depositdate = $row1['depositdate'];
	$money_receipt_no = $row1['money_receipt_no'];
}
foreach($categorydt as $row)
{
	$category = $row['category'];
	$pass_status = $row['last_grade'];
}

if($appl_status == 'Fee Paid' || $appl_status == 'Verified')
{
	
	if($mode=="edit")
	{
		$applshow=1;
	}
	
	
}
	
	foreach($amount as $row_amt )
	{
		$amount = $row_amt['amount'];
	}
	
	if($amount == 0)
	{
		$noamount=1;
	}
	else
	{
		$noamount=0;
	}

/*foreach($bankdata as $row)
{
	$bank_name=$row['bank_name'];
	$account_no=$row['account_no'];
}*/
foreach($passstatus as $row3)
{
	$category = $row3['category'];
	$pass_status = $row3['last_grade'];
}
/*$radioPayment = $_POST['hidPaymentMode'];
$txtChallanNo = trim($_POST['txtChallanNo']);
$txtChallanDate = $_POST['txtChallanDate'];
$txtSbiRefNo = $_POST['txtSbiRefNo'];
$txtCollectDate = $_POST['txtCollectDate'];
if($radioPayment == "ONLINE")
{
//show in .php
	//header("location: onlinepaymentinstruction.php?ins=$hex_ins_code&_s=$MY_SESSION_NAME"); 	

}*/


?>
<script type="text/javascript">
function validate(){
	var errorMessage = "";
	var message = '<div>';
	if(document.getElementById("hidPaymentMode").value == "SBI")
	{
		if(document.getElementById("txtSbiRefNo").value == "")
		{
			errorMessage += "Please enter SBI Ref no.<br/>";
		}
		if(document.getElementById("txtCollectDate").value == "")
		{
			errorMessage += "Please enter SBI Collect Date.";
		}
	}
	else if(document.getElementById("hidPaymentMode").value == "CHALLAN")
	{
		if(document.getElementById("txtChallanNo").value == "")
		{
			errorMessage += "Please enter Challan no.<br/>";
		}
		if(document.getElementById("txtChallanDate").value == "")
		{
			errorMessage += "Please enter Challan Date.";
		}
	}
	else if(document.getElementById("hidPaymentMode").value == "" && document.getElementById("txtChallanAmount").value !='0.00' )
	{
		errorMessage += "Please Choose a Payment Option And then proceed.<br/>";
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
	{
		return true;
	}	
}
</script>
<!--<link href="<?=base_url()?>public/assets/css/extra-style.css" rel="stylesheet">-->
<link href="<?=base_url()?>public/assets/css/datepicker3.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.css" />
<div class="row" style="">
	<!--<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="margin-top: 30px;height:467px;">
		<?php include('sidebar/sidebar.php'); ?>
	</div>-->

	<div class="container col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 36px; padding-bottom: 50px;">
      <input type="hidden" name="hidPageCode" id="hidPageCode" value="PAYMENT"/>
		<div class="row">
	
		<?php 
		if($appl_status == 'Fee Paid' || $appl_status == 'Verified')
		{
			$edit="true";
		}
		if($appl_status == 'Document Uploaded' || $appl_status == 'Challan Generated' || $appl_status == 'Fee Paid' || $appl_status == 'Verified')
		   {
		   	$sl_no = 1;
		   ?>
				<div class="col-lg-12" style="padding-top:0px;padding-right: 40px;">
				<!--<div class="panel panel-primary">
					<div class="panel-heading project-heading" align="center" >
						<h2 class="panel-title project-title"><b><a href="projectIndex.php?admcode=<?=$admcode?>&ins=<?=$hex_ins_code?>&_s=<?=$MY_SESSION_NAME?>"><?php echo $admname; ?></a></b></h2>
						<h2 class="panel-title project-title"><b style="color: #FFF"><?php echo $admname; ?></b></h2>				
					</div>
				
				</div>-->
					
				<?php if($edit=="true") { 
						if($appl_status == 'Document Uploaded' || $appl_status == 'Challan Generated' ) { ?>
							
							<a href="<?=base_url()?>Admin_apply/<?=$file_name?>/ins/<?=$ins?>" ><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
							
							<a href="<?=base_url()?>Admin_apply/apply_3/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/documentupload.png" /></a>
							<img src="<?=base_url()?>public/assets/images/payment1.png" />
					<?php } else if($appl_status == 'Fee Paid' || $appl_status == 'Verified') { ?>
					
							<a href="<?=base_url()?>Admin_apply/<?=$file_name?>/ins/<?=$ins?>" ><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
							
							<a href="<?=base_url()?>Admin_apply/apply_3/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/documentupload.png" /></a>
							<img src="<?=base_url()?>public/assets/images/payment.png" />
					<?php } ?>
						
					<?php
							if($appl_status == 'Verified') { 
						?>
				
						<?php 
						} 
						else{
							?>
							
						<!--<div id ="preview" class="col-sm-1 col-sm-offset-11" style="margin-left: 87%;margin-top: -3.5%"><a href="preview.php?ins=<?=$ins?>" class="btn btn-primary">Preview / Modify</a></div>-->
						<?php } ?>
						<div class="panel panel-primary panel-payment">
							<div class="panel-heading step-heading">
								<b><i class="fa fa-money"></i> Payment</b>
								<span class="pull-right"><b style="color: #FFF;"><?php echo $admname; ?></b></span>
							</div>
							<!--<a href="#" class="pull-right" style="margin-top: -4.0%;margin-right: 0.2%" id="btnInstruction" name="btnInstruction" title="Help"><img type="button" src="<?php echo base_url(); ?>public/assets/images/helpicon.png" name="btnInstruction" title="Help" id="btnInstruction" style="width:50px;height:50px;cursor:pointer"></img></a>-->
				<?php } 
				else { ?>
				<?php
							if($appl_status == 'Verified') { 
						?>
							
						<?php 
						} 
						else{
							?>
							<a href="<?=base_url()?>Admin_apply/<?=$file_name?>/ins/<?=$ins?>" ><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
							
							<a href="<?=base_url()?>Admin_apply/apply_3/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/documentupload.png" /></a>
							<img src="<?=base_url()?>public/assets/images/payment1.png" />
						<!--<div id ="preview" class="col-sm-1 col-sm-offset-11" style="margin-left: 87%;margin-top: -3.5%"><a href="preview.php?ins=<?=$ins?>" class="btn btn-primary">Preview / Modify</a></div>-->
						<?php } ?>
				<div class="panel panel-primary panel-payment1">
					<div class="panel-heading step-heading">
							<span><b><i class="fa fa-money"></i> Payment</b></span>
							<span class="pull-right"><b style="color: #FFF;"><?php echo $admname; ?></b></span>
					</div>
					<!--<a href="#" class="pull-right" style="margin-top: -4.0%;margin-right: 0.2%" id="btnInstruction" name="btnInstruction" title="Help"><img type="button" src="<?php echo base_url(); ?>public/assets/images/helpicon.png" name="btnInstruction" title="Help" id="btnInstruction" style="width:50px;height:50px;cursor:pointer"></img></a>-->
				<?php } 
				if($print==3)
				{
				?>
					<div class="alert alert-success alert-dismissible" role="alert" >
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<div id="alertmessage1">Error in Generating Print application.Try again.</div>
					</div>
				<?php	
				}
				?>
				<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;"> <!-- Alert for error -->
					<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
					<div id="alertmessage"></div>
				</div>
				<?php if($this->session->flashdata('info')): ?>
					<div class="alert1 alert-success" align="center">
						<!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
						<?php echo $this->session->flashdata('info'); ?>
					</div>
					<?php endif; ?>

					<?php if($this->session->flashdata('error')): ?>
					<div class="alert1 alert-danger" align="center">
						<!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
						<?php echo $this->session->flashdata('error'); ?>
					</div>
				<?php endif; ?>
				<?php if($show==1) { ?>
				<div class="alert alert-success alert-dismissible" role="alert" >
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div id="alertmessage1">Your Application is under Payment Verification.</div>
				</div>
				<?php } ?>
				<input type="hidden" id="hidAppNo" name="hidAppNo" value="<?php echo $application_no; ?>" />
				<input type="hidden" id="hidProgNo" name="hidProgNo" value="<?php echo $admcode; ?>" />
				<input type="hidden" id="hidRegNo" name="hidRegNo" value="<?php echo $reg_user_id; ?>" />
				<input type="hidden" id="hidOnlineTab" name="hidOnlineTab" value="" />
					<div class="panel-body panel-payment" style="margin-top: -0.3%" >
						<?php if($show==0) { ?>
						<?php
						if($applshow == 1 && $noamount != 1 )
						{
						?>
						<div >Thanks for your payment towards PGET-2018.The payment details as follows.</div>
						<?php
						}
						?>
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
						  <form class="form-horizontal" method="post" role="form" id="frmApply" name="frmApply" >
							<input type="hidden" name="hidPaymentMode" id="hidPaymentMode" value=""/>
							<div class="form-group">
								<label for="" class="col-sm-2 control-label" style="align:left;">Amount :</label>
								<div class="col-sm-3" style="margin-top: 6px;">
									<img src="http://i.stack.imgur.com/nGbfO.png" width="8" height="10">&nbsp;<span><?php echo $noamount==1?'0.00':$amount.'.00'; ?></span>
									<input type="hidden" class="form-control" id="txtChallanAmount" name="txtChallanAmount" placeholder="Amount" value="<?php echo $noamount==1?'0.00':$amount; ?>" disabled >
								</div>
								<div class="col-sm-3" id="mod">
									
								</div>
								
							</div>
							<?php if($noamount != 1) { ?>
								<?php if($reg_mode=='OFFLINE') { ?>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label" style="align:left;">Payment Mode :</label>
									<div class="col-sm-3">
											<label class="radio-inline">
												<input type="radio" name="radioPayment" id="radioCounter" value="ON THE COUNTER" checked <?php if(($editappl=="true")&&($row6['money_deposit_mode']=="ON THE COUNTER")) { echo "checked"." disabled"; } ?> <?php echo $editappl=="true"?'disabled':''; ?>> On The Counter
											</label>
											
									</div>
								</div>
								<?php } 
								else { 
									if($appl_status != 'Verified' && $appl_status != 'Fee Paid'  ) {
								   ?>
								<div class="form-group">
									<!--<label for="" class="col-sm-2 control-label" style="align:left;">Payment Mode :</label>-->
								
									<div class="col-lg-10" style="margin-bottom: 10px;">
										
				                                <!-- Tabs within a box -->
				                                
												
													<?php
														if($editappl == "true" && $deposit_mode =='ONLINE')
														{
														?>
														<div style="padding-left: 3%">
															<div class="form-group">
																<h4 style="color: #85803b">Online Payment Details:</h4>
																<label for="" class="col-sm-3 control-label" style="align:left;">Transaction No:</label>
																<div class="col-sm-3">
																	<input type="text" class="form-control"   value="<?= $money_receipt_no?>" disabled="disabled">
																</div>
															</div>
															<div class="form-group">
																<label for="" class="col-sm-3 control-label" style="align:left;">Transaction Date:</label>
																<div class="col-sm-3">
																	<input type="text" class="form-control" value="<?=$depositdate?>" disabled="disabled">
																</div>
															</div>
														</div>
														<?php
														}
														?>
														<?php 
															if($applshow != 1 && $noamount != 1) { ?>
															
															<div id="onlineSubmit">
																<div class="form-group">
																	<div class="col-lg-offset-5 col-lg-3">
																		<a href=" <?= base_url() ?>payment/onlinepaymentinstruction/<?= $ins?>" class="btn btn-primary" id="btnOnline" name="btnOnline" >Proceed for Online Payment</a>
																	</div>
																</div>
															</div>
															<?php } ?>
											 
									</div>
								</div>
								<?php }
								 else
										{
										?>								
												<div class="form-group">
													<label for="" class="col-sm-2 control-label" style="align:left;">Payment Mode :</label>
													<div class="col-sm-3">
														<span><?=$deposit_mode?></span>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label" style="align:left;">Transaction No :</label>
													<div class="col-sm-3">
														<span><?=$money_receipt_no?></span>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label" style="align:left;">Payment Date :</label>
													<div class="col-sm-3">
														<span><?=$depositdate?></span>
													</div>
												</div>
										<?php										
										}
										?>
									<!--<div class="col-sm-3">
											<label class="radio-inline">
												<input type="radio" name="radioPayment" id="radioOnline" value="ONLINE" checked="checked" <?php if(($editappl=="true")&&($row6['money_deposit_mode']=="ONLINE")) { echo "checked"." disabled"; } ?> <?php echo $editappl=="true"?'disabled':''; ?>> Online
											</label>
											<label class="radio-inline">
												<input type="radio" name="radioPayment" id="radioOffline" value="CHALLAN" <?php if(($editappl=="true")&&($row6['money_deposit_mode']=="CHALLAN")) { echo "checked"." disabled"; } ?> <?php echo $editappl=="true"?'disabled':''; ?>> Challan
											</label>
									</div>
									<div class="col-sm-3 col-sm-offset-1" style="display:none;" id="challan">
										<input type="button" value="Generate Challan" class="btn btn-primary" id="generateChallan" name="generateChallan" style="background:#9D426B;" />
									</div>-->

								<?php } ?>
							<?php } 
								 else{
								 	?>
								 	<?php
							if($appl_status == 'Verified') { 
						?>
							<div class="col-sm-3 col-sm-offset-5">
								<a href="<?=base_url()?>mpdf_controller/template008_pdf/app_prog/<?=$admcode?>" target='_blank'  ><span class="btn btn-info">Print Application</span></a>
							</div>
						<?php 
						} 
						else{
							?>
							
						<div class="form-group">
									<div class="col-lg-offset-5 col-lg-3">
										<button type="submit" class="btn btn-info" id="btnPay" name="btnPayment"  onClick="return validate();" >Submit</button>
									</div>
								</div>
						<?php } ?>
									
									<?php
								 }
							?>
							<?php if($applshow != 1 && $noamount != 1) { ?>
							<div id="offlieSubmit" style="display:none;">
								<div class="form-group">
									<div class="col-lg-offset-5 col-lg-3">
										<button type="submit" class="btn btn-primary" id="btnPayment" name="btnPayment"  onClick="return validate();" >Submit</button>
									</div>
								</div>
							</div>
							
							<?php } ?>
							<?php
						if($applshow == 1 && $noamount != 1 )
						{
						?>
						<div >Your application is successfully submitted.</div>
						<?php
						}
						?>
						  </form>
						</div>
						<?php }  ?>
						<?php if($print==1) {  ?>
						<!--<label for="" class="col-sm-8 control-label col-sm-offset-4" style="text-align:left;">Do you want to print the application?</label>-->
						<div class="col-sm-7 col-sm-offset-5">
							<!--<a href="PDF/applicationFormPDF.php" target='_blank' class="btn btn-primary" style="background:#9D426B;">Print Application</a>-->
							<!--<a href="projectIndex.php?admcode=<?php echo $program_code;?>" class="btn btn-primary" style="background:#9D426B;">No</a>-->
						</div>
						<label for="" class="col-sm-8 control-label col-sm-offset-4" style="text-align:left;"><br><a href="projectIndex.php?admcode=<?php echo $program_code;?>&ins=<?=$hex_ins_code?>" style="color:#9D426B;">Click here</a> to go back to the home page.</label>
						<?php } ?>
						<?php if($print==2) {  ?>
						<!--<label for="" class="col-sm-8 control-label col-sm-offset-4" style="text-align:left;">Do you want to print the application?</label>-->
						<div class="col-sm-7 col-sm-offset-5">
							<?php
							if($temp_name != '')
							{
							?>
								<a href="<?=base_url()?>mpdf_controller/template008_pdf/app_prog/<?=$admcode?>" target='_blank' class="btn btn-primary" >Print Application</a>
							<?php		
								}
							
							?>
						</div>
						<label for="" class="col-sm-8 control-label col-sm-offset-4" style="text-align:left;"><br><a href="projectIndex.php?admcode=<?php echo $program_code;?>&ins=<?=$ins?>" style="color:#9D426B;">Click here</a> to go back to the home page.</label>
						<?php } ?>
					</div><!--Panel Body-->
				</div><!--background div-->
				<br><br><br>
			</div><!--/col-lg-12-->
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
	<!--Alert Modal -->
	<div class="modal fade bs-example-modal-sm" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop= "static" >
	  <div class="modal-dialog modal-sm">
		<div class="modal-content">
		  <div class="modal-header">
			<!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
			</button>-->
			<h4 class="modal-title" id="myModalLabel">Message</h4>
			</div>
			<div class="modal-body" id="failurebody">
				You will not be able to modify any data after submit. Do you want to submit?
			</div>
			<div class="modal-footer">
				<button type="button" id = "SUBMIT" class="btn btn-primary submitbtn" data-dismiss="modal">
					Submit
				</button>
				<button type="button" id = "CANCEL" class="btn btn-primary cancelbtn" id="btnCancel" data-dismiss="modal">
					Cancel
				</button>		
			</div>
		</div>
	  </div>
	</div>
		<div class="modal fade" id="modalInstruction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header" style="background-color: #496cad;color: white;">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" style="color: white;" id="myModalLabel">Instruction</h4>
		      </div>
		      <div class="modal-body" id="divInstruction">
		     
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</div>

	<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrapValidator.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/apply_4.js"></script>

<script>
	var result = <?=$this->session->flashdata('info'); ?>;
	if(result){
		swal({
			title: "Application",
			text: "Successfully Submitted",
			//type: "success"
			},
			function(isConfirm) {
			  if (isConfirm) {
			  	//console.log(base_url+"apply/institute_page/ins/".<?=$ins?>);
			  	//window.location=( "<?php echo base_url() ?>apply/institute_page/ins/<?=$ins?>");
			    window.location.href = ("<?php echo base_url() ?>apply/institute_page/ins/<?=$ins?>");
			  }
		});
			
	}
</script>