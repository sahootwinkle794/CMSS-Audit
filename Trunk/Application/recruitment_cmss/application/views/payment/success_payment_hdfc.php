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
	$paid_amount = isset($result['paid_amount'])?$result['paid_amount']:'';
	$institute_code = $this->session->userdata('institute_code');
	$ins = encrypt_decrypt('encrypt',$institute_code);
	//echo $program_code;
	
?>
<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:30px;">
	<div class="row">
		<?php if($print==0) { ?>
			<div class="alert alert-success alert-dismissible" role="alert" >
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<div id="alertmessage1">Error in Application Print Generation.</div>
			</div>
		<?php } ?>
		<?php if($payment_status=='Failure'){
			?>
			
        	   	<div class="panel-heading" style="background: linear-gradient(to left, #ffb27a 30%, #ff805f 100%);color: #ffffff;text-align: center;padding: 54px 15px;">
	      			<h4 style="font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">The transaction is failed/tempered.Please Try Again.</h4>
	      			<button type="button" class="btn btn-success" onclick="window.location.href='<?=BASE_URL?>'"> <i class="fa fa-home"></i>  Home</button>
	        	</div>
	        	
		<?php }else{ ?>
		
		<div class="col-sm-12" style="margin-top: 120px;">
			<div class="col-sm-2"></div>
		    <div class="col-sm-8" align="center">
   			<div class="panel panel-default" >
        	   	<div class="panel-heading" style="background: linear-gradient(to left, #ffb27a 30%, #ff805f 100%);color: #ffffff;text-align: center;padding: 2px 15px;">
	      			<h4 style="font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">PAYMENT DETAILS</h4>
	        	</div>
	        	<div class="panel-body">
					<div class="row">	
			       		<div class="col-md-12" style="margin-top: 10px;">
			       			<table class="table table-bordered table-responsieve" style="color: #000; box-shadow: 1px 1px 3px black;">
							
								<tbody style="background: white; font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">
									<tr>
										<td>
											Post Name
										</td>
										<td style="font-size: 16px;">
											<b><?=$program_name?></b>
										</td>
									</tr>
									<tr>
										<td>
											Payment Status
										</td>
										<td>
											<b><?=$payment_status?></b>
										</td>
									</tr>
									<tr>
										<td>
											Payment ID
										</td>
										<td>
											<b><?=$payment_id?></b>
										</td>
									</tr>
									<tr>
										<td>
											Amount Paid
										</td>
										<td>
											<b><?=$paid_amount?></b>
										</td>
									</tr>
									
								</tbody>
							</table>
							<div align="center" style="font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">
							<?php
		
								if($print == 1)
								{
							?>
									<a href="<?=base_url()?>Payment/download_print_application" target='_blank' class="btn btn-success" >Print Application</a>
							<?php
								}
							?>
							<br/>
							<a  href="<?=BASE_URL?>" style="color:blue;">Click Here</a> to go back to the home page.
							</div>
			       		</div>
			       	</div>
			    </div>
			</div>
			</div>
			<div class="col-sm-2"></div>
		</div>
		<?php } ?>
		
	</div>
	<div class="col-sm-7 col-sm-offset-5">
		
							
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