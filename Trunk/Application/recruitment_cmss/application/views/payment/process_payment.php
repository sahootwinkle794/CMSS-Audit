<?php
$today_date = date("Y-m-d");
//print_r($param_val);die();
$merchat_id = $param_val['MERCHANTID'];
$customer_id = $student_code; 
$txn_amount = $amount_to_pay; 
$currency_type = $param_val['CURRENCY'];
$type_field1 = $param_val['TYPEFIELD1'];
$security_id = $param_val['SECURITYID'];
$typefield_2 = $param_val['TYPEFIELD2'];
$response_url = $param_val['RESPONSEURL'];
$post_url = $payment_process_url;
$ChecksumKey = $param_val['CHECKSUMKEY'];
$onlinepayment_transaction_number = $this->session->userdata('order_number');
$str = "$merchat_id|$customer_id|NA|$txn_amount|NA|NA|NA|$currency_type|NA|$type_field1|$security_id|NA|NA|$typefield_2|$onlinepayment_transaction_number|NA|NA|NA|NA|NA|NA|$response_url";
//$str = "$merchat_id|$onlinepayment_transaction_number|NA|$txn_amount|NA|NA|NA|$currency_type|NA|$type_field1|$security_id|NA|NA|$typefield_2|$today_date|NA|NA|NA|NA|NA|NA|$response_url";
$checksum = hash_hmac('sha256', $str, $ChecksumKey, false); 
$str = $str."|".strtoupper($checksum);

?>

<div >
<div class="container" style="margin-top: 150px; padding-bottom: 280px;text-align: center;">
	Processing... Please wait.Don't press back/refresh button.
</div>
<form action="<?php echo $post_url;?>" name="frmPayment" method="post">
<input type="hidden" value="<?php echo $str; ?>" name="msg"/>
</form>
</div>
<script language="javascript">
function onLoadSubmit() {
	document.frmPayment.submit();
}onLoadSubmit();
</script>