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
		<h3>Please wait, processing your payment..</h3>
		<form action="<?=$result['actionURL']?>" name="payment" method="post">
			<input type="hidden" name="strRequestID" value="<?=$result['strRequestId'];?>" />
		</form>
	</body>
</html>