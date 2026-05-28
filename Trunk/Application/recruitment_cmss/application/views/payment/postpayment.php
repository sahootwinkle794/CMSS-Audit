<?php
	$show=0;
	$print=0;
	$payment_status = "";
	$payment_id = "";
	//print_r($result);
	//die();
	$payment_status = $result['payment_status'];
	$payment_id = $result['payment_id'];
	$print = $result['print'];
	$program_name = $result['program_name'];
	$program_code = $result['program_code'];
	
	
	
?>
<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:30px;margin-top: 50px;background: black;">
	<div class="row">
		<?php if($print==0) { ?>
			<div class="alert alert-success alert-dismissible" role="alert" >
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<div id="alertmessage1" style="color: white;">Error in Application Print Generation.</div>
			</div>
		<?php } ?>
		<div class="col-lg-12">
			<label for="" class="col-sm-3 control-label" style="align:left;color: white;">Online Payment Status :</label>
			<div class="col-sm-3" style="paddin-top:1%;font-weight:bold;color:#00ff00">
				<?=$payment_status?>
			</div>
		</div>
		<div class="col-lg-12">
			<label for="" class="col-sm-3 control-label" style="align:left;color: white;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transaction ID :</label>
			<div class="col-sm-3" style="color: white;">
				<?=$payment_id?>
			</div>
		</div>
	</div>
	<div class="col-sm-7 col-sm-offset-5">
		<?php
		
			if($print == 1)
			{
		?>
				<a href="<?=base_url()?>apply/download_print_application" target='_blank' class="btn btn-primary" style="background:#9D426B;">Print Application</a>
		<?php
			}
		?>
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