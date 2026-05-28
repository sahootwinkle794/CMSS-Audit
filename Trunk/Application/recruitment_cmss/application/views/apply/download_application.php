<?php
	date_default_timezone_set('Asia/Kolkata');
    $now = date('Y-m-d h:i:s', now());
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
		//$now = date("d-m-Y, h:i A",$now);
		$apply_date1 = date("d-m-Y, h:i A",$app_start_date);
		$apply_date2 = date("d-m-Y, h:i A",$app_end_date);
	    if($app_start_date > $now)
		{
			$time_to_apply = "Start date is:$apply_date1";
		}
		else if($app_start_date <= $now)
		{
			$time_to_apply = "Last date is: $apply_date2";
		}
	}
	foreach($institute_data as $row)
	{
		$institute_code = $row['institute_code'];
		$institute_name = $row['institute_name'];
		$ins = encrypt_decrypt('encrypt',$institute_code);
	}
	
	
?>
<link href="<?=base_url()?>public/assets/css/extra-style.css" rel="stylesheet" />
<link href="<?=base_url()?>public/assets/css/datepicker3.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.css" />
<script type="text/javascript">
function validate1(){
	var phone = $('#txtCandidatePhone1').val();
	var errorMessage = "";
	var message = '<div>';
	if(document.getElementById("txtCandidatePhone").value == '')
	{
		errorMessage += "Please enter Registered Mobile No<br/>";
	}
	if(document.getElementById("txtdob").value == '')
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
</script>


   
	<input type="hidden" name="hidPageCode" id="hidPageCode" value="REGISTRATION"/>
	<div class="container" style="margin-top: 90px; padding-bottom: 50px;">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">
					<div class="panel-heading project-heading" align="center">
						<h2 class="panel-title" style="font-size: 20px"><b><a href="<?=base_url()?>apply/project_index/program/<?=$admcode?>/ins/<?=$ins?>"><?php echo $admname; ?></a></b></h2>
					</div>
				
			</div>	
			
				
		</div>		
	</div>		
	
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">		
				<div class="panel panel-primary">
					<div class="panel-heading step-heading">

							<b><i class="fa fa-file"></i> Download</b>

					
					<a href="#" class="pull-right" style="margin-top: -0.5%;margin-right: 0.2%" id="btnInstruction" name="btnInstruction" title="Help"><i class="fa fa-question-circle fa-2x" ></i></a>
					
					</div>
				
				<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;"> <!-- Alert for error -->
					<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
					<div id="alertmessage"></div>
				</div>
				
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
				
							<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:20px;">
							  <?php include_once(dirname(dirname(__FILE__)) . '/template_config/alerts.php');?>
							  <form class="form-horizontal" method="post" role="form" id="frmApply" name="frmApply" >
								<input type="hidden" id="hidInput" name="hidInput" value=""/>
								<table class="table table-striped tblRegistration" style="" align="center">
									<tr>
										<td>
											<label for="" class="control-label" style="align:left;">Registered Mobile No :</label>
										</td>
										<td>
											<input type="text" class="form-control" id="txtCandidatePhone" name="txtCandidatePhone" placeholder="Mobile No" >
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
											<input type="text" class="form-control" id="txtdob" name="txtdob" placeholder="Pick Date" >
										</td>
										<td>
											<p class="text-info" style="margin-top:2.5%;">dd-mm-yyyy (e.g. 20-02-2000)</p>
										</td>
									</tr>
									<tr>
										<td>
								
										</td>
										<td>
											<div class="form-group">
												<p id="captImg">
    											<a href="javascript:void(0);" class="refreshCaptcha" id="refreshCaptcha" ><img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
												</p>
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
												<input type="text" id="txtCaptcha" class="form-control" name="txtCaptcha" size="14" maxlength="10" style="width:50%" />
											</div>
										</td>
										<td>
											
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
					</div>
				</div>

		</div><!--/row-->
	  
	</div><!--/container-->
	</div>
	<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrapValidator.js"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.responsive.min.js"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/js/apply-1.js?v=5"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.js"></script>