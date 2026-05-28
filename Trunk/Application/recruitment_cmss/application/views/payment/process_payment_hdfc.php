<?php
$today_date = date("Y-m-d");

//require_once 'Crypt/AES.php';
//die();
$merchant_id = $parameter_values['MERCHANTID'];
$operating_mode = $parameter_values['OperatingMode'];

$success_url = $parameter_values['RTU'];
$fail_url = $parameter_values['RTU'];
$aggregator_id = $parameter_values['AggregatorId'];
$merchant_customer_id = $parameter_values['MerchantCustomerID'];
$pay_mode = $parameter_values['Paymode'];
$acces_medium = $parameter_values['Accesmedium'];
$transaction_source = $parameter_values['TransactionSource'];
$key = $parameter_values['SBIKEY'];
//$uuid = $pg_parameter_values['UUID'];
$amount = $_SESSION['app_fee'];
$order_id = $_SESSION['order_number'];
$billing_details_arr = explode('|',$billing_details);



?>
<script>
window.onload = function() {
		var d = new Date().getTime();
		document.getElementById("tid").value = d;
	};
</script>

<body onLoad="document.payment.submit();">
	<form name="payment" method="post"   action="<?php echo BASE_URL.payment.'/request_handler/'.$this->uri->segment(3);?>">
		<input type="hidden" name="tid" value=""> 
		<input type="hidden" name="order_id" value="<?= $order_id;?>">
		<input type="hidden" name="amount" value="<?= number_format($amount, 2, '.', '');?>"> 
		<input type="hidden" name="currency" value="INR">
		<input type="hidden" name="merchant_id" value="<?=$merchant_id?>">
		<input type="hidden" name="redirect_url" value="<?= $success_url?>"> 
		<input type="hidden" name="cancel_url" value="<?=$success_url?>">
		<input type="hidden" name="language" value="EN">
		<input type="hidden" name="billing_name" value="<?= $billing_details_arr[0]?>">
		<input type="hidden" name="billing_address" value="<?= $billing_details_arr[1]?>">
		<input type="hidden" name="billing_city" value="<?= $billing_details_arr[2]?>">
		<input type="hidden" name="billing_state" value="<?= $billing_details_arr[3]?>">
		<input type="hidden" name="billing_zip" value="<?= $billing_details_arr[4]?>">
		<input type="hidden" name="billing_country" value="<?= $billing_details_arr[5]?>">
		<input type="hidden" name="billing_tel" value="<?= $billing_details_arr[6]?>">
		<input type="hidden" name="billing_email" value="<?= $billing_details_arr[7]?>">
		<input type="hidden" name="delivery_name" value="<?= $billing_details_arr[0]?>">
		<input type="hidden" name="delivery_address" value="<?= $billing_details_arr[1]?>">
		<input type="hidden" name="delivery_city" value="<?= $billing_details_arr[2]?>">
		<input type="hidden" name="delivery_state" value="<?= $billing_details_arr[3]?>">
		<input type="hidden" name="delivery_zip" value="<?= $billing_details_arr[4]?>">
		<input type="hidden" name="delivery_country" value="<?= $billing_details_arr[5]?>">
		<input type="hidden" name="delivery_tel" value="<?= $billing_details_arr[6]?>">
		<input type="hidden" name="merchant_param1" value="">
		<input type="hidden" name="merchant_param2" value="">
		<input type="hidden" name="merchant_param3" value="">
		<input type="hidden" name="merchant_param4" value="">
		<input type="hidden" name="merchant_param5" value="">
	</form>
</body>