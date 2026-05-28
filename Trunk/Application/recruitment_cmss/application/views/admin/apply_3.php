<?php
date_default_timezone_set('Asia/Kolkata');
$now = date('Y-m-d h:i:s', now());
$mode = $this->session->userdata('mode');
$show = '';
$edit = "false";

$data = $this->uri->uri_to_assoc();
$edit_status = isset($data['edit'])?$data['edit']:'';
//echo "pre";

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
$docs[] = '';
foreach($document_data as $row)
{
	// echo "<pre>";
	// print_r($document_data);die;
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
if($edit_status != '')
{
	$show = 0;
}
if($edit_status == '')
{
	if($appl_status == 'Verified' || $appl_status == 'Fee Paid' )
		$show = 1;
}/*
if($appl_status == 'Fee Paid' || $appl_status == 'Verified')
{
	$show=1;
}*/
//echo $appl_status;
if( $appl_status == 'Document Uploaded' || $appl_status == 'Challan Generated' || $appl_status == 'Fee Paid' || $appl_status == 'Verified' || $appl_status == 'Payment Updated' || $appl_status == 'Application Submitted')
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
		
	$docs[] =  $row['document_type_code'];
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
				
				//$('#btndocumentUpload').attr('disabled', true);
				document.getElementById("alertmessage").innerHTML = "Please first clear all the errors.";
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
				document.getElementById("alertmessage").innerHTML = "Please first clear all the errors.";
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
		
		function check_errors()
		{
			var err_cnt = 0;
			var document_code_list = "<?php echo $documentsCodeList;?>";
			var document_code_lists = document_code_list.split(",");
			for(j=0;j<document_code_lists.length;j++)
			{
				if(document.getElementById("divMessage"+document_code_lists[j]).innerHTML != '')
				{
					err_cnt++;
				}
			}
			
			if(err_cnt == '0')
			{
				$('#btndocumentUpload').attr('disabled', false);
			}
			else
			{
				$('#btndocumentUpload').attr('disabled', true);
			}
		}
	</script>
	<!--<link href="<?=base_url()?>public/assets/css/extra-style.css" rel="stylesheet">-->
	
	<link href="<?=base_url()?>public/assets/css/datepicker3.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.css" />
	
	<style>
	.btn-warning:hover{
			color: #fff;
			background-color: #2897b9;
		    border-color: #2897b9;
		 
		}
		.btn-warning:focus,
		.btn-warning:active,
		.btn-warning.active,
		.btn-warning {
		  	color: #fff;
		    background-color: #20505f;
		    border-color: #20505f;
		}
		.btn-warning[disabled]{
		  	color: #fff;
		    background-color: #20505f;
		    border-color: #20505f;
		}
		
		.btn-primary:hover{
		  color: #fff;
		  background-color: #7a3b2c;
		  border-color: #7a3b2c;
		}
		.btn-primary:focus,
		.btn-primary:active,
		.btn-primary.active,
		.btn-primary {
		   color: #fff;
		  background-color: #0d87b8;
			border-color: #0d87b8;
		}
	.btn.btn-sm {
	    padding: .5rem 1.6rem;
	    cursor: pointer;
	}
	.panel-primary > .panel-heading {
	    color: #fff;
	    background: linear-gradient(to left, #36a3c5 30%, #2ea1c4 100%);
	}
	.panel-primary {
	   border-color: #32a2c4;
	}
	
	fieldset {
		    min-width: 0;
		    padding: 15px;
		    margin: 0;
		    border: 1px solid black;
		    border-color:#20505f85;
			margin-top: 10px;
		}
		legend {
		    width: auto;
		    border-bottom: 0px;
		    color: #fff;
		    background: linear-gradient(to left, #35a3c5 30%, #258bab 100%);
		    border-radius: 6px;
		    text-align: center;
		    padding: 5px;
		}

	</style>
	
	
		<div class="container-fluid" style=" padding-bottom: 50px;">

		<div class="row" style="" >
			<div class="hidden-sm col-md-1 col-lg-1 hidden-xs" style="margin-top: 200px;margin-left: -15px;z-index: 1000;">
				<!-- <?php include('sidebar/sidebar.php'); ?> -->
			</div>

		<div class="container col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12" style="margin-top: 100px; padding-bottom: 50px;">
		 <input type="hidden" name="hidPageCode" id="hidPageCode" value="DOCUMENT UPLOAD"/>
			<div class="row">
			<?php 
				$ins = encrypt_decrypt('encrypt',$institute_code);
				if($appl_status == 'Student Details Submitted' || $appl_status == 'Challan Generated' || $appl_status == 'Document Uploaded' || $appl_status == 'Fee Paid' || $appl_status == 'Verified' || $appl_status == 'Payment Updated' || $appl_status == 'Application Submitted')
			    { 
			   $sl_no = 1;
			   ?>
			   <div class="row">
						<br />
						<div class="hidden-xs col-sm-1 col-md-1 col-lg-1 col-xl-1">	</div>
						<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-xl-10">	
					<?php if($mode=="edit") { 
							if(($appl_status == 'Document Uploaded' || $appl_status == 'Challan Generated')) { ?>
								<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/<?=$file_name?>/ins/<?=$ins?>/edit/<?=$edit_status?>';"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Profile Details <span class="badge"> &raquo;</span>
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Profile Details" data-placement="top" data-toggle="tooltip">
										1 <span class="badge"> &raquo;</span>
									</div>
								</button>

								<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
								
								<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/apply_3/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Document Upload <span class="badge"> &raquo;</span>
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl" title="Document Upload" data-placement="top" data-toggle="tooltip" >
										2 <span class="badge"> &raquo;</span>
									</div>
								</button>

								<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
								
								<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/apply_4/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg"  title="Payment" data-placement="top" data-toggle="tooltip" style="  background-color: #E9CDCD;border: 1px solid #E9CDCD; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Payment
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"> 
										3 
										<!--<span class="tooltiptext">Payment</span>-->
									</div>
								</button>
								
								<!--<a href="<?=base_url()?>apply/<?=$file_name?>/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
								<a href="<?=base_url()?>apply/apply_3/ins/<?=$ins?>" ><img src="<?=base_url()?>public/assets/images/documentupload.png" /></a>
								<a href="<?=base_url()?>apply/apply_4/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/payment1.png" /></a>-->
							
						<?php } 
								else if($appl_status == 'Student Details Submitted') {?>
									
									<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/<?=$file_name?>/ins/<?=$ins?>/edit/<?=$edit_status?>';"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
										<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
											Profile Details <span class="badge"> &raquo;</span>
										</div>
										<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Profile Details" data-placement="top" data-toggle="tooltip">
											1 <span class="badge"> &raquo;</span>
										</div>
									</button>

									<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
									
									<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/apply_3/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style="  background-color: #E9CDCD;border: 1px solid #E9CDCD; border-radius: 5px;color: black">
										<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
											Document Upload <span class="badge"> &raquo;</span>
										</div>
										<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl" title="Document Upload" data-placement="top" data-toggle="tooltip" >
											2 <span class="badge"> &raquo;</span>
										</div>
									</button>

									<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
									
									<button type="button" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg"  title="Payment" data-placement="top" data-toggle="tooltip" style=" background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px;color: black">
										<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
											Payment
										</div>
										<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"> 
											3 
											<!--<span class="tooltiptext">Payment</span>-->
										</div>
									</button>
									
									<!--<a href="<?=base_url()?>apply/<?=$file_name?>/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
									<img src="<?=base_url()?>public/assets/images/documentupload1.png" />
									<img src="<?=base_url()?>public/assets/images/payment1.png" />-->
						<?php } 
								else if($appl_status == 'Fee Paid' || $appl_status == 'Verified') { ?>
								<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/<?=$file_name?>/ins/<?=$ins?>/edit/<?=$edit_status?>';"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Profile Details <span class="badge"> &raquo;</span>
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Profile Details" data-placement="top" data-toggle="tooltip">
										1 <span class="badge"> &raquo;</span>
									</div>
								</button>

								<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
								
								<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/apply_3/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Document Upload <span class="badge"> &raquo;</span>
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl" title="Document Upload" data-placement="top" data-toggle="tooltip" >
										2 <span class="badge"> &raquo;</span>
									</div>
								</button>

								<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
								
								<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/apply_4/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg"  title="Payment" data-placement="top" data-toggle="tooltip" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Payment
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"> 
										3 
										<!--<span class="tooltiptext">Payment</span>-->
									</div>
								</button>
								<!--<a href="<?=base_url()?>apply/<?=$file_name?>/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
								<img src="<?=base_url()?>public/assets/images/documentupload.png" />
								<a href="<?=base_url()?>apply/apply_4/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/payment.png" /></a>-->
						<?php } 
							else if($appl_status == 'Payment Updated' || $appl_status == 'Application Submitted') { ?>
								<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/<?=$file_name?>/ins/<?=$ins?>/edit/<?=$edit_status?>';"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Profile Details <span class="badge"> &raquo;</span>
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Profile Details" data-placement="top" data-toggle="tooltip">
										1 <span class="badge"> &raquo;</span>
									</div>
								</button>

								<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
								
								<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/apply_3/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Document Upload <span class="badge"> &raquo;</span>
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl" title="Document Upload" data-placement="top" data-toggle="tooltip" >
										2 <span class="badge"> &raquo;</span>
									</div>
								</button>

								<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
								
								<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/apply_4/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg"  title="Payment" data-placement="top" data-toggle="tooltip" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Payment
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"> 
										3 
										<!--<span class="tooltiptext">Payment</span>-->
									</div>
								</button>
								<!--<a href="<?=base_url()?>apply/<?=$file_name?>/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
								<img src="<?=base_url()?>public/assets/images/documentupload.png" />
								<a href="<?=base_url()?>apply/apply_4/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/payment.png" /></a>-->
						<?php } ?><br />
						
							<br /><br /><br />
						
							<!--<a href="#" class="pull-right" style="margin-top: -4.0%;margin-right: 0.2%" id="btnInstruction" name="btnInstruction" title="Help"><img type="button" src="<?=base_url()?>public/assets/images/helpicon.png" name="btnInstruction" title="Help" id="btnInstruction" style="width:50px;height:50px;cursor:pointer"></img></a>-->
							<!--<img class="pull-right" type="button" src="assets/img/helpicon.png" name="btnInstruction" title="Help" id="btnInstruction" style="width:50px;height:50px;cursor:pointer;margin-top: -4%"></img>-->
					<?php } 
					else { 
							 if($appl_status == 'Student Details Submitted') {?>
								<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/<?=$file_name?>/ins/<?=$ins?>/edit/<?=$edit_status?>';"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Profile Details <span class="badge"> &raquo;</span>
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Profile Details" data-placement="top" data-toggle="tooltip">
										1 <span class="badge"> &raquo;</span>
									</div>
								</button>

								<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
								
								<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/apply_3/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style="  background-color: #E9CDCD;border: 1px solid #E9CDCD; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Document Upload <span class="badge"> &raquo;</span>
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl" title="Document Upload" data-placement="top" data-toggle="tooltip" >
										2 <span class="badge"> &raquo;</span>
									</div>
								</button>

								<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
								
								<button type="button" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg"  title="Payment" data-placement="top" data-toggle="tooltip" style=" background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Payment
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"> 
										3 
										<!--<span class="tooltiptext">Payment</span>-->
									</div>
								</button>
								
								
								<!--<a href="<?=base_url()?>apply/template002/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
								<a href="<?=base_url()?>apply/apply_3/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/documentupload1.png" /></a>
								<img src="<?=base_url()?>public/assets/images/payment1.png" />-->
						<?php }
						 else if($appl_status == 'Document Uploaded' || $appl_status == 'Student Details Submitted') {?>
						 		<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/<?=$file_name?>/ins/<?=$ins?>/edit/<?=$edit_status?>';"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Profile Details <span class="badge"> &raquo;</span>
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Profile Details" data-placement="top" data-toggle="tooltip">
										1 <span class="badge"> &raquo;</span>
									</div>
								</button>

								<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
								
								<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/apply_3/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Document Upload <span class="badge"> &raquo;</span>
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl" title="Document Upload" data-placement="top" data-toggle="tooltip" >
										2 <span class="badge"> &raquo;</span>
									</div>
								</button>

								<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
								
								<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/apply_4/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg"  title="Payment" data-placement="top" data-toggle="tooltip" style="  background-color: #E9CDCD;border: 1px solid #E9CDCD; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Payment
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"> 
										3 
										<!--<span class="tooltiptext">Payment</span>-->
									</div>
								</button>
								<!--<a href="<?=base_url()?>apply/<?=$file_name?>/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
								<img src="<?=base_url()?>public/assets/images/documentupload.png" />
								<a href="<?=base_url()?>apply/apply_4/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/payment1.png" /></a>-->
							<?php
							}
							else if($appl_status == 'Fee Paid' || $appl_status == 'Verified')
							{
							?>
								<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/<?=$file_name?>/ins/<?=$ins?>/edit/<?=$edit_status?>';"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Profile Details <span class="badge"> &raquo;</span>
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Profile Details" data-placement="top" data-toggle="tooltip">
										1 <span class="badge"> &raquo;</span>
									</div>
								</button>

								<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
								
								<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/apply_3/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Document Upload <span class="badge"> &raquo;</span>
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl" title="Document Upload" data-placement="top" data-toggle="tooltip" >
										2 <span class="badge"> &raquo;</span>
									</div>
								</button>

								<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
								
								<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/apply_4/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg"  title="Payment" data-placement="top" data-toggle="tooltip" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Payment
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"> 
										3 
										<!--<span class="tooltiptext">Payment</span>-->
									</div>
								</button>
								
								<!--<a href="<?=base_url()?>apply/<?=$file_name?>/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
								<img src="<?=base_url()?>public/assets/images/documentupload.png" />
								<a href="<?=base_url()?>apply/apply_4/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/payment.png" /></a>	-->
							<?php }
						
							else if($appl_status == 'Payment Updated' || $appl_status == 'Application Submitted')
							{
							?>
								<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/<?=$file_name?>/ins/<?=$ins?>/edit/<?=$edit_status?>';"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Profile Details <span class="badge"> &raquo;</span>
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Profile Details" data-placement="top" data-toggle="tooltip">
										1 <span class="badge"> &raquo;</span>
									</div>
								</button>

								<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
								
								<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/apply_3/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Document Upload <span class="badge"> &raquo;</span>
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl" title="Document Upload" data-placement="top" data-toggle="tooltip" >
										2 <span class="badge"> &raquo;</span>
									</div>
								</button>

								<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
								
								<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/apply_4/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg"  title="Payment" data-placement="top" data-toggle="tooltip" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
									<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
										Payment
									</div>
									<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"> 
										3 
										<!--<span class="tooltiptext">Payment</span>-->
									</div>
								</button>
								
								<!--<a href="<?=base_url()?>apply/<?=$file_name?>/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
								<img src="<?=base_url()?>public/assets/images/documentupload.png" />
								<a href="<?=base_url()?>apply/apply_4/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/payment.png" /></a>	-->
							<?php	
							}
						?>
						
						<!--<div class="panel panel-default">
						
							<div class="panel-heading project-heading" align="center" >
								<h2 class="panel-title project-title"><b><a href="#"><?php echo $admname; ?></a></b></h2>
							</div>
							
						</div>-->
							<br /><br /><br />
						
					
						<!--<a href="#" class="pull-right" style="margin-top: -4.0%;margin-right: 0.2%" id="btnInstruction" name="btnInstruction" title="Help"><img type="button" src="<?=base_url()?>public/assets/images/helpicon.png" name="btnInstruction" title="Help" id="btnInstruction" style="width:50px;height:50px;cursor:pointer"></img></a>-->
						<?php } ?>
					
					</div>
						
					</div>
				<div class="col-lg-12 fpad">
					
					<div class="panel panel-primary panel-document">
						
						<div class="panel-heading step-heading">
								<b><i class="fa fa-file"></i> Document Upload</b>
								</div>
							
						<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;"> <!-- Alert for error -->
						<div id="alertmessage"></div>
						</div>
						<?php include_once(dirname(dirname(__FILE__)) . '/template_config/alerts.php');?>
						<div class="panel-body">
						<div class="" align="right" >
								<h2 class="panel-title" style="margin-top:10px;color: #802d06;"><b><?php echo $admname; ?></b></h2>
							</div>
							<fieldset>
							<legend >DOCUMENT DETAILS</legend>
							<div class="col-lg-12">
								<span style="color: red">* All the Documents are Mandatory.</span>
								<!--<h3 style="text-align: center;margin-top: -6px;color: #666;"> DOCUMENT DETAILS:</h3>-->
								<!--<form class="form-horizontal" method="post" role="form" id="frmApply" name="frmApply" enctype="multipart/form-data" >-->
								
								<input type="hidden" id="documentDetailsList" name="documentDetailsList" value="<?php print_r($docs) ; ?>"/>
								
								<!--<div class="table-responsive">
									<table class="table table-bordered table-striped">
										<tr>
											<th style="width: 100px;">Sl.No</th>
											<th style="width: 300px;">Document Type</th>
											<th style="">Browse</th>
											<th style="text-align:center;">Preview</th>
										</tr>
									</table>
								</div>-->
									 
								
										
								<form  class="md-form login-box-body" method="post" role="form" action="" id="frmApply" name="frmApply" enctype="multipart/form-data" style="background: #fff;padding: 0px;border-top: 0;color: #666;">
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
									<div class="row">
											<div class="col-lg-4 col-xl-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 10px;">
													<div class="form-group">
														<label for=""><?=$row['document_type']?></label>
														<p style="font-size: 12px;"><b><?=$row['document_type_description']?></b></p></th>
													</div>
											</div>
											<div class="col-lg-4 col-xl-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 10px;">
													<div class="form-group" >
														<div class="input-group input-file" >
												    		<input type="file" class="form-control" style="width:85%;margin-left: 12px;"  id="file<?=$row['document_type_code']?>" name="fileDocument[]" onchange = "showImage('<?=$row['document_type_code']?>',<?=$row['document_preview_width']?>,<?=$row['document_preview_height']?>,<?=$row['document_size_in_kb']?>,'<?=$row['document_extension_type']?>');"  <?php echo $show==1?'disabled':''; ?>/>
												    	</div>	
													</div>
													<!-- <div style="color: red;"> -->
													<?=$row['document_size_description']?>
													<div id="divMessage<?=$row['document_type_code']?>" style="color:red;font-size:16px;"></div>	
											</div>
										<div class="col-lg-4 col-xl-4 col-md-4 col-sm-4 col-xs-12" >
											<div class="form-group" style="text-align: center;">
												<?php 	
													if($row['document_extension_type'] == 'IMG')
													{
														if($mode=='edit' || $appl_status == 'Document Uploaded' || $appl_status == 'Fee Paid' || $appl_status == 'Verified' || $appl_status == 'Payment Updated' || $appl_status == 'Application Submitted') 
													  	{ 
														  	if(array_key_exists($row['document_type_code'],$documentsPath)) 
															{ 
																echo "<img id='img".$row['document_type_code']."' src='".$documentsPath[$row['document_type_code']]."'  width='".$row['document_preview_width']."' height='".$row['document_preview_height']."' />"; 
															} 
															else 
															{ 
																echo "<img id='img".$row['document_type_code']."'  />"; 
															} 
														} 
														else 
														{ 
															echo "<img id='img".$row['document_type_code']."' />"; 
														}
													} 
													else
													{
														
														if($mode=='edit' || $appl_status == 'Document Uploaded' || $appl_status == 'Fee Paid' || $appl_status == 'Verified' || $appl_status == 'Payment Updated' || $appl_status == 'Application Submitted') 
													  	{ 
													  		$path_info = pathinfo($documentsPath[$row['document_type_code']] );
													  		
															$sFileExtension = $path_info['extension'];
															if($sFileExtension == "pdf" || $sFileExtension == "PDF")
												        	{
																$base_url = base_url()."downloads/doc_icon.png";
															}
															else if($sFileExtension == "xls" || $sFileExtension == "xlsx")
															{
																$base_url = base_url().'downloads/excel.png';
															}
															else if($sFileExtension == "DOC"  || $sFileExtension == "doc" || $sFileExtension == "docx" || $sFileExtension == "DOCX")
															{
																$base_url = base_url().'downloads/word.png';
															}
															else
															{
																$base_url =  base_url()."downloads/doc_icon.png";
															}
														  	if(array_key_exists($row['document_type_code'],$documentsPath)) 
															{ 
																echo "<a  target='_blank' href = '".$documentsPath[$row['document_type_code']]."'><img id='img".$row['document_type_code']."' src='".$base_url."' width='100px' height='100px' /></a>"; 
															} 
															else 
															{ 
																echo "<img id='img".$row['document_type_code']."'  />"; 
															} 
														} 
														else 
														{ 
															echo "<img id='img".$row['document_type_code']."'  />";
														}
													}	
													
													?>
											</div>
										</div>
										
										
									</div>
										
									<?php 
											$sl_no++; 
											}
										} 
										?>
									<?php if($show !=1) { ?>
										<div class="form-group" style="margin-top: 10px;">
											<div class="col-lg-12" style="text-align: center;">
												<button type="submit" class="btn1 btn btn-warning btn-block" id="btndocumentUpload" name="btndocumentUpload"  <?php if($edit=='true'){ echo "onclick='return validate_edit();'"; } else { echo "onclick='return validate();'"; }?>> <span class="glyphicon glyphicon-send" style="font-size:18px;"></span> Save & Next</button>
											</div>
										</div>
									<?php } ?>
							
								</form>
								
							</div> 
						</fieldset>	
															
								
										
								<!--<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
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
												<td>
													<?php 	
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
								</div>-->
						</div><!--Panel Body-->
						
				
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


		<div class="hidden-xs hidden-sm col-md-1 col-lg-1 col-xl-1" style="margin-top: 30px;margin-left: 0px;"></div>
		
	</div>
	</div>

<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/apply_3.js"></script>	
<script>
$(":file").filestyle({classButton: "btn btn-primary"});//for file execution
	
</script>	
