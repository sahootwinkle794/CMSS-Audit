<?php
date_default_timezone_set('Asia/Kolkata');
$now = date('Y-m-d h:i:s', now());
$mode = $this->session->userdata('mode');
$show = '';
$edit = "false";
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

$documentsPath = array();
$documentDetails = array();
$documentDetailsList = array();
$documentsReq = array();
$documentsDesc = array();
$documentsCode = array();
$documentsDescList = '';
$documentsCodeList = '';

foreach($document_data as $row)
{
	$documentsReq[] = $row;	
	$documentsDesc[] = $row['document_type'];
	$documentsCode[] = $row['document_type_code'];
}
if(count($documentsDesc) != 0)
{
	$documentsDescList = implode(',',$documentsDesc);
	$documentsCodeList = implode(',',$documentsCode);
}
foreach($appl_status as $row)
{
	$appl_status = $row['appl_status'];
}
if($appl_status == 'Fee Paid' || $appl_status == 'Verified')
{
	$show=1;
}
//echo $appl_status;
if( $appl_status == 'Document Uploaded' || $appl_status == 'Challan Generated' || $appl_status == 'Fee Paid' || $appl_status == 'Verified')
{
	if($mode == "edit")
	{
		$edit="true";
		foreach($doc_path as $row){
			$document_type = $row['document_type'];
			$documentsPath[$document_type] = $row['document_path'];
		}
	}
	else if($mode != "edit")
	{
		foreach($doc_path as $row){
			$document_type = $row['document_type'];
			$documentsPath[$document_type] = $row['document_path'];
		}
	}
}
foreach($documentsReq as $row)
{
	if(array_key_exists($row['document_type_code'],$documentsPath))
		$documentDetails[] = $row['document_type'].'@'.$documentsPath[$row['document_type_code']];
	else
		$documentDetails[] = $row['document_type'].'@';
}
if(count($documentDetails) != 0){
	$documentDetailsList = implode(',',$documentDetails);
}


?>
<script type="text/javascript">
		function validate(){
			var errorMessage = "";
			var message = '<div>';
			var document_desc_list = "<?php echo $documentsDescList;?>";
			var document_desc_lists = document_desc_list.split(",");
			var document_code_list = "<?php echo $documentsCodeList;?>";
			var document_code_lists = document_code_list.split(",");
			var i = 0;
			var is_error = 0;
			$('input[name="fileDocument[]"]').each(function(){
			  	if($(this).val() == '')
			  	{
					errorMessage += document_desc_lists[i]+" is required.<br />";
			  	}
			  	i++;
			});
			
			for(j=0;j<document_code_lists.length;j++)
			{
				if(document.getElementById("divMessage"+document_code_lists[j]).innerHTML != '')
				{
					is_error = 1;
				}
			}
			
			if(errorMessage != "")
			{
				message += errorMessage + "</div>";
				document.getElementById("alertmessage").innerHTML=message;
				$('.alert').show();
				window.scrollTo(0,0);
				return false;	 
			}
			else if(is_error == 1)
			{
				document.getElementById("alertmessage").innerHTML = "Please first clear up the errors.";
				$('.alert').show();
				window.scrollTo(0,0);
				return false;
			}
			else
			{
				document.getElementById("alertmessage").innerHTML = '';
				return true;
			}
		}
		
		function validate_edit()
		{
			var errorMessage = "";
			var message = '<div>';
			var document_details_list = "<?php echo $documentDetailsList;?>";
			var document_details_lists = document_details_list.split(",");
			var document_code_list = "<?php echo $documentsCodeList;?>";
			var document_code_lists = document_code_list.split(",");
			var i = 0;
			var is_error = 0;
			$('input[name="fileDocument[]"]').each(function(){
				document_details = document_details_lists[i].split("@");
			  	if(document_details[1] == '')
			  	{
			  		if($(this).val() == '')
						errorMessage += document_details[0]+" is required.<br />";
			  	}
			  	i++;
			});
			//alert("hello1");
			for(j=0;j<document_code_lists.length;j++)
			{
				//alert("hello");
				if(document.getElementById("divMessage"+document_code_lists[j]).innerHTML != '')
				{
					//alert(document.getElementById("divMessage"+document_code_lists[j]).innerHTML);
					is_error = 1;
				}
			}
			
			if(errorMessage != "")
			{
				message += errorMessage + "</div>";
				document.getElementById("alertmessage").innerHTML=message;
				$('.alert').show();
				window.scrollTo(0,0);
				return false;	 
			}
			else if(is_error == 1)
			{
				document.getElementById("alertmessage").innerHTML = "Please first clear up the errors.";
				$('.alert').show();
				window.scrollTo(0,0);
				return false;
			}
			else
			{
				document.getElementById("alertmessage").innerHTML = '';
				return true;
			}
		}
	</script>
	<link href="<?=base_url()?>public/assets/css/extra-style.css" rel="stylesheet">
	<link href="<?=base_url()?>public/assets/css/datepicker3.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.css" />
	<div class="row" style="">
		<div class="col-sm-2" style="margin-top: 30px;height:467px;padding-left: 2%;">
			<?php include('sidebar/sidebar.php'); ?>
		</div>
		<div class="container col-sm-10" style="margin-top: 36px; padding-bottom: 50px;">
		  <input type="hidden" name="hidPageCode" id="hidPageCode" value="DOCUMENT UPLOAD"/>
			<div class="row">
			<?php if($appl_status == 'Student Details Submitted' || $appl_status == 'Challan Generated' || $appl_status == 'Document Uploaded' || $appl_status == 'Fee Paid' || $appl_status == 'Verified')
			   { 
			   $sl_no = 1;
			   ?>
				<div class="col-lg-12" style="padding-top:0px;padding-right: 40px;">
					<div class="panel panel-default">
						<div class="panel-heading project-heading" align="center" >
							<h2 class="panel-title project-title"><b style="color: #FFF"><?php echo $admname; ?></b></h2>
						</div>
					
					</div>
	              	
					<?php if($mode=="edit") { 
							if(($appl_status == 'Document Uploaded' || $appl_status == 'Challan Generated')) { ?>
								
								<a href="<?=base_url()?>apply/<?=$file_name?>/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
								<img src="<?=base_url()?>public/assets/images/documentupload.png" />
								<a href="<?=base_url()?>apply/apply_4/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/payment1.png" /></a>
							
						<?php } 
								else if($appl_status == 'Student Details Submitted') {?>
								<a href="<?=base_url()?>apply/<?=$file_name?>/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
								<img src="<?=base_url()?>public/assets/images/documentupload1.png" />
						<?php } else if($appl_status == 'Fee Paid' || $appl_status == 'Verified') { ?>
								<a href="<?=base_url()?>apply/<?=$file_name?>/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
								<img src="<?=base_url()?>public/assets/images/documentupload.png" />
								<a href="<?=base_url()?>apply/apply_4/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/payment.png" /></a>
						<?php } ?>
						<div class="panel panel-primary panel-document">
							<div class="panel-heading step-heading">
									<b><i class="fa fa-file"></i> Document Upload</b>
							</div>
							<a href="#" class="pull-right" style="margin-top: -4.0%;margin-right: 0.2%" id="btnInstruction" name="btnInstruction" title="Help"><img type="button" src="<?=base_url()?>public/assets/images/helpicon.png" name="btnInstruction" title="Help" id="btnInstruction" style="width:50px;height:50px;cursor:pointer"></img></a>
							<!--<img class="pull-right" type="button" src="assets/img/helpicon.png" name="btnInstruction" title="Help" id="btnInstruction" style="width:50px;height:50px;cursor:pointer;margin-top: -4%"></img>-->
					<?php } 
					else { 
							if($appl_status == 'Document Uploaded' || $appl_status == 'Challan Generated')
							{
							?>
								<a href="<?=base_url()?>apply/<?=$file_name?>/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
								<img src="<?=base_url()?>public/assets/images/documentupload.png" />
								<a href="<?=base_url()?>apply/apply_4/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/payment1.png" /></a>
							<?php
							}
							else if($appl_status == 'Fee Paid' || $appl_status == 'Verified')
							{
							?>
								<a href="<?=base_url()?>apply/<?=$file_name?>/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
								<img src="<?=base_url()?>public/assets/images/documentupload.png" />
								<a href="<?=base_url()?>apply/apply_4/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/payment.png" /></a>	
							<?php	
							}
						?>
						<div class="panel panel-primary panel-document">
							<div class="panel-heading step-heading">
									<b><i class="fa fa-file"></i> Document Upload</b>
							</div>
						<a href="#" class="pull-right" style="margin-top: -4.0%;margin-right: 0.2%" id="btnInstruction" name="btnInstruction" title="Help"><img type="button" src="<?=base_url()?>public/assets/images/helpicon.png" name="btnInstruction" title="Help" id="btnInstruction" style="width:50px;height:50px;cursor:pointer"></img></a>
						<?php } ?>
						<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;"> <!-- Alert for error -->
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<div id="alertmessage"></div>
						</div>

						<div class="panel-body">
								<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
								  <form class="form-horizontal" method="post" role="form" id="frmApply" name="frmApply" enctype="multipart/form-data" >
									<div class="table-responsive">
									  <table class="table table-bordered table-striped">
										<tr>
											<th style="text-align:center;">Sl.No</th>
											<th style="text-align:center;width: 300px">Document Type</th>
											<th style="text-align:center;">Browse</th>
											<th style="text-align:center;">Preview</th>
										</tr>
<?php 
	if(count($documentsReq) == 0) 
	{
?>    
										  
										  <h3>No Documents needed</h3>
										 
<?php 
	} 
	else
	{
		$sl_no = 1;
		foreach($documentsReq as $row)
		{
?>
										
										<tr style="text-align:center;">
											<td><?=$sl_no?></td>
											<th><?=$row['document_type']?><br/><br/>
											<p style="font-size: 12px;"><?=$row['document_type_description']?></p></th>
											<td style="text-align:left;">
												<input type="file" id="file<?=$row['document_type_code']?>" name="fileDocument[]" style="width:80%" class="form-control"  onchange = "showImage('<?=$row['document_type_code']?>',<?=$row['document_preview_width']?>,<?=$row['document_preview_height']?>,<?=$row['document_size_in_kb']?>);"  <?php echo $show==1?'disabled':''; ?>/>
												<?=$row['document_size_description']?>
												<div id="divMessage<?=$row['document_type_code']?>" style="color:red;font-size:16px;"></div>
											</td>
											<td><?php 	
													//echo $mode;
													if($mode == "edit" || $appl_status == 'Document Uploaded' || $appl_status == 'Fee Paid' || $appl_status == 'Verified') 
												  	{ 
													  	if(array_key_exists($row['document_type_code'],$documentsPath)) 
														{ 
															echo "<img id='img".$row['document_type_code']."' src='".$documentsPath[$row['document_type_code']]."' style='margin-left:50px;margin-right:50px;' width='".$row['document_preview_width']."' height='".$row['document_preview_height']."' />"; 
														} 
														else 
														{ 
															echo "<img id='img".$row['document_type_code']."' style='margin-left:50px;margin-right:50px;' />"; 
														} 
													} 
													else 
													{ 
														echo "<img id='img".$row['document_type_code']."' style='margin-left:50px;margin-right:50px;' />"; 
													}
												?>
													
											</td>
										</tr>
<?php 
			$sl_no++; 
		}
	} 
?>
										
										
									 </table>
									</div>
									<?php if($show !=1) { ?>
									<div class="form-group">
										<div class="col-lg-offset-5 col-lg-3">
											<button type="submit" class="btn btn-primary" id="btndocumentUpload" name="btndocumentUpload" <?php if($edit=='true'){ echo "onclick='return validate_edit();'"; } else { echo "onclick='return validate();'"; }?> >Save & Next</button>
										</div>
									</div>
									<?php } ?>
								  </form>
								</div>
						</div><!--Panel Body-->
				</div>
				
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
			</div>
		</div><!--/row-->
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
	</div><!--/container-->
	</div>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrapValidator.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/apply_3.js"></script>	
	
