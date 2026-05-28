<?php
header('X-Frame-Options: SAMEORIGIN');
ob_start(); 
error_reporting(E_ALL);
ini_set("display_errors",1);
set_time_limit(0);
//
?>
<html>
	<body onLoad="document.payment.submit();">
		<h3>Please wait, redirecting to process payment..</h3>
		<form action="<?php echo $result['action_url']; ?>" name="payment" method="POST">
			<input type="hidden" name="message" value="<?=$result['enc_text'];?>" />
		</form>
	</body>
</html>