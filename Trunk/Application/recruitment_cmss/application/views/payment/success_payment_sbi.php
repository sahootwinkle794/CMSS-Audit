<?php
	$show=0;
	$print=0;
	$payment_status = "";
	$payment_id = "";
	//print_r($result[0]);
	//die();
	$payment_status = isset($result['payment_status'])?$result['payment_status']:''; 
	$payment_id = isset($result['payment_id'])?$result['payment_id']:''; 
	$print = isset($result['print'])?$result['print']:''; 
	$program_name = isset($result['program_name'])?$result['program_name']:''; 
	$program_code = isset($result['program_code'])?$result['program_code']:'';
	$file_name = isset($result['file_name'])?$result['file_name']:'';
	$institute_code = $this->session->userdata('institute_code');
	$ins = encrypt_decrypt('encrypt',$institute_code);
	//echo $program_code;
	
?>
<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:30px;margin-top: 50px;">
	<div class="row">
		<?php if($print==0) { ?>
			<div class="alert alert-success alert-dismissible" role="alert" >
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<div id="alertmessage1">Error in Application Print Generation.</div>
			</div>
		<?php } ?>
		<div class="panel panel-default">
				<div class="panel-heading project-heading" align="center" >
					<h2 class="panel-title project-title" style="color: black;"><b><?php echo $program_name; ?></b></h2>
				</div>
			
		</div>
		<div class="col-lg-12">
			<label for="" class="col-sm-3 control-label" style="align:left;">Online Payment Status :</label>
			<div class="col-sm-3" style="paddin-top:1%;font-weight:bold;color:#00ff00">
				<?=$payment_status?>
			</div>
		</div>
		<div class="col-lg-12">
			<label for="" class="col-sm-3 control-label" style="align:left;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transaction ID :</label>
			<div class="col-sm-3">
				<?=$payment_id?>
			</div>
		</div>
	</div>
	<div class="col-sm-7 col-sm-offset-5">
		<?php
		
			if($print == 1)
			{
		?>
				<a href="<?=base_url()?>Payment/download_print_application" target='_blank' class="btn btn-primary" style="background:#9D426B;">Print Application</a>
		<?php
			}
		?>
		<br/>
		<a  href="<?=BASE_URL?>" style="color:blue;">Click Here</a> to go back to the home page.
							
	</div>
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br /><br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br /><br />
</div>