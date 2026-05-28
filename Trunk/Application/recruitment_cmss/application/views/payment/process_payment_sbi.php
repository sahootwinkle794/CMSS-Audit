<?php
$today_date = date("Y-m-d");

//require_once 'Crypt/AES.php';
//die();
$merchant_id = $parameter_values['MERCHANTID'];
$operating_mode = $parameter_values['OperatingMode'];
$merchant_country = $parameter_values['MerchantCountry'];
$merchant_currency = $parameter_values['MerchantCurrency'];
$other_details = $parameter_values['OtherDetails'];
$success_url = $parameter_values['SuccessURL'];
$fail_url = $parameter_values['FailURL'];
$aggregator_id = $parameter_values['AggregatorId'];
$merchant_customer_id = $parameter_values['MerchantCustomerID'];
$pay_mode = $parameter_values['Paymode'];
$acces_medium = $parameter_values['Accesmedium'];
$transaction_source = $parameter_values['TransactionSource'];
$key = $parameter_values['SBIKEY'];
//$uuid = $pg_parameter_values['UUID'];
$amount = $_SESSION['app_fee'];
$order_id = $_SESSION['order_number'];
$requestParameter  = "$merchant_id|$operating_mode|$merchant_country|$merchant_currency|$amount|$other_details|$success_url|$fail_url|$aggregator_id|$order_id|$merchant_customer_id|$pay_mode|$acces_medium|$transaction_source";
//echo $requestParameter;
$AESobj = new CryptAES();
//$secret = base64_decode($key);
//$aes->setKey($secret);
//$aes->set_key(base64_decode($key));
//$aes->require_pkcs5();
$PaymentDtls="aggGtwmapID| | | | | | |";
$EncryptTrans = $AESobj->encrypt($requestParameter,$key);
//$EncryptbillingDetails  = $aes->encrypt($billing_details);
//$EncryptbillingDetails  = $AESobj->encrypt($billing_details,$key); 
//$EncryptshippingDetais  = $AESobj->encrypt($shipping_details,$key);
//$EncryptpaymentDetails  = $AESobj->encrypt($PaymentDtls,$key);

?>

<div class="container" style="margin-top: 150px; padding-bottom: 280px;text-align: center;">
	<h3 style="color: #f5680a">Processing... Please wait.Don't press back/refresh button.</h3>
</div>
<body onLoad="document.payment.submit();">
	<form name="payment" method="post"   action="<?php echo $payment_process_url; ?>">
		<input type="hidden" name="EncryptTrans" value="<?php echo $EncryptTrans; ?>">
		<!--<input type="text" name="EncryptbillingDetails" value="<?php echo $EncryptbillingDetails; ?>">
		<input type="text" name="EncryptshippingDetais" value="<?php echo $EncryptshippingDetais; ?>">
		<input type="text" name="EncryptpaymentDetails" value="<?php echo $EncryptpaymentDetails; ?>">-->
		<input type="hidden" name="merchIdVal" value ="<?php echo $merchant_id; ?>"/>
	</form>
</body>