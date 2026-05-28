<?php
/*foreach($result_arr as $row)
{
	$hash = $row[0];	
	$secureHash = $row[1];	
}*/
//echo $result['action_url'];
?>
<html>
	<body onLoad="document.payment.submit();">
		<h3>Please wait, redirecting to process payment..</h3>
		<form action="<?php echo $result['action_url']; ?>" name="payment" method="POST">

		</form>
	</body>
</html>