<?php
	$reg_user_id = $this->session->userdata('reg_user_id');
	$application_no = $this->session->userdata('appl_no');
	foreach($institute_data as $row)
	{
		$institute_code_original = $row['institute_code'];
		$institute_name = $row['institute_name'];
		$inst = encrypt_decrypt('encrypt',$institute_code_original);
		$ins = $institute_code_original;
	}
	foreach($appl_status as $row)
	{
		$appl_status = $row['appl_status'];
	}
	foreach($program_data as $row)
	{
		$admname = $row['program_name'];
		$admcode = $row['program_code'];
	}
	foreach($applicant_data as $row)
	{
		$full_name = $row['full_name'];
		$first_name = $row['first_name'];
		$program_name = $row['program_name'];
		$program_code = $row['program_code'];
	}
	foreach($categorydt as $row)
	{
		$category = $row['category'];
	}
	$transactionalcharges = 0;
	foreach($transaction_data as $row)
	{
		$transactionalcharges = $row['transaction_charge'];
	}
	foreach($extra_amount_arr as $row_amt)
	{
		$extra_fee = $row_amt['extra_fee'];
	}
	foreach($amount_data as $row_amt)
	{
		$amount = $row_amt['amount'];
	}
	if($extra_fee != 0)
	{
		$amount = $extra_fee;
	}
	$amount_to_pay = ($amount + $transactionalcharges).'.00';
	$all_pg = array();
	foreach($payment_gateway_data as $row)
	{
		$all_pg[] = $row;
	}
	
?>
    
	<div class="container" style=" padding-bottom: 50px;">
		<div class="row">
			
		<form method="post" action="" onsubmit="return validate()">
		
		
		
		
		
			<div class="col-lg-12" style="padding-top:0px; margin-top: 120px; ">
				
				<h3>Online Payment Instructions</h3>
				<div class="col-lg-12" style="font-size: 14px; line-height: 200%">
					<ul>
						<li>
							The payment will be processed by 3rd party payment gateway.
						</li>
						<li>
							Click "Pay Now" to proceed for online payment.
							You can pay the amount using debit card / net banking / credit card.
						</li>
						<li>
							After the completion of online transaction, you will be redirected to this portal, 
							from where you can take a print out of the application.
						</li>
					</ul>
				</div>
				<div class="col-lg-12">
					<div class="panel panel-default">	
						<div class="panel-body">
							<div class="form-group">
								<label for="" class="col-sm-2 control-label" style="align:left;">Application Fee:</label>
								<div class="col-sm-2">
									<i class="fa fa-inr"></i> <?=$amount?>
								</div>
								<label for="" class="col-sm-3 control-label" style="align:left;">Transactional Charges:</label>
								<div class="col-sm-1">
									<i class="fa fa-inr"></i> <?=$transactionalcharges?>
								</div>
								<label for="" class="col-sm-2 control-label" style="align:left;">Amount to Pay:</label>
								<div class="col-sm-2">
									<i class="fa fa-inr"></i> <?=$amount_to_pay?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="panel panel-default">	
						<div class="panel-body">
							<h3>Select the payment gateway.</h3>
								<div class="cc-selector">
<?php
$count = 1;
foreach($all_pg as $row)
{
	if($row['pg_code'] == 'CSC')
	{
		if(isset($_SESSION['csc_username']) && $_SESSION['csc_username'] != '')
		{
			echo '<div class="panel panel-success">';
			echo '<div class="panel-body">';
			echo '<div class="col-md-2">';
			
			if($count == 1)
				echo '<input type="radio" value="'.$row['pg_code'].'" name="radPaymentGateway" id="rad'.$row['pg_code'].'" style="vertical-align:top;margin-top: 10%;" checked/>';
			else
				echo '<input type="radio" value="'.$row['pg_code'].'" name="radPaymentGateway" id="rad'.$row['pg_code'].'" style="vertical-align:top;margin-top: 10%;"/>';
			echo '<img src = "'.$row['logo_url'].'" class="drinkcard-cc" height = "100" width="200" ></img>';
			
			echo '</div>';
			echo '<div class="col-md-10">'.$row['remarks'].'</div>';
			echo '</div>';
			echo '</div>';
		}
	}
	else if($row['pg_code'] == 'MEESEVA')
	{
		if(isset($_SESSION['mee_userId']) && $_SESSION['mee_userId'] != '')
		{
			echo '<div class="panel panel-success">';
			echo '<div class="panel-body">';
			echo '<div class="col-md-2">';
			
			if($count == 1)
				echo '<input type="radio" value="'.$row['pg_code'].'" name="radPaymentGateway" id="rad'.$row['pg_code'].'" style="vertical-align:top;margin-top: 10%;" checked/>';
			else
				echo '<input type="radio" value="'.$row['pg_code'].'" name="radPaymentGateway" id="rad'.$row['pg_code'].'" style="vertical-align:top;margin-top: 10%;"/>';
			echo '<img src = "'.$row['logo_url'].'" class="drinkcard-cc" height = "100" width="200" ></img>';
			
			echo '</div>';
			echo '<div class="col-md-10">'.$row['remarks'].'</div>';
			echo '</div>';
			echo '</div>';
		}
	}
	else if($row['pg_code'] == 'EMITRA')
	{
		if(isset($_SESSION['EMITRASSOID']) && $_SESSION['EMITRASSOID'] != '')
		{
			echo '<div class="panel panel-success">';
			echo '<div class="panel-body">';
			echo '<div class="col-md-2">';
			
			if($count == 1)
				echo '<input type="radio" value="'.$row['pg_code'].'" name="radPaymentGateway" id="rad'.$row['pg_code'].'" style="vertical-align:top;margin-top: 10%;" checked/>';
			else
				echo '<input type="radio" value="'.$row['pg_code'].'" name="radPaymentGateway" id="rad'.$row['pg_code'].'" style="vertical-align:top;margin-top: 10%;"/>';
			echo '<img src = "'.$row['logo_url'].'" class="drinkcard-cc" height = "100" width="200" ></img>';
			
			echo '</div>';
			echo '<div class="col-md-10">'.$row['remarks'].'</div>';
			echo '</div>';
			echo '</div>';
		}
	}
	else
	{
		echo '<div class="panel panel-success">';
		echo '<div class="panel-body">';
		echo '<div class="col-md-2">';
		
		if($count == 1)
			echo '<input type="radio" value="'.$row['pg_code'].'" name="radPaymentGateway" id="rad'.$row['pg_code'].'" style="vertical-align:top;margin-top: 10%;height: 35px;width: 20px;" checked/> <br>';
		else
			echo '<input type="radio" value="'.$row['pg_code'].'" name="radPaymentGateway" id="rad'.$row['pg_code'].'" style="vertical-align:top;margin-top: 10%;height: 35px;width: 20px;"/> <br>';
		echo '<img src = "'.$row['logo_url'].'" class="drinkcard-cc" height = "200" width="200" style="margin-top: 8%;"></img>';
		
		echo '</div>';
		echo '<div class="col-md-10">'.$row['remarks'].'</div>';
		echo '</div>';
		echo '</div>';
	}
	$count++;
}
?>									
								</div>
 						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group col-lg-offset-5">
						<button type="submit" class="btn btn-success btn-lg" id="btnPayNow" name="btnPayNow">Pay Now</button>
					</div>
				</div>
				
				<div class="col-lg-12">
					<h3 style="color:#0914f7">Please do not press the back or refresh button 
					of the browser during the whole transaction.</h3>
				</div>
			</div><!--/col-lg-12-->
			
			<!--<div class="col-lg-12">
				<br>
				<center><h3>You don't have access to this page.</h3></center>
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			</div>-->
			
		</form>
		</div><!--/row-->
	  
	</div><!--/container-->
	
	
	<!-- FOOTER -->
	
