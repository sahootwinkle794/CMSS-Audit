<?php
$today_date = date("Y-m-d");

//require_once 'Crypt/AES.php';
//die();


?>

<div class="container" style="margin-top: 150px; padding-bottom: 280px;text-align: center;">
	<h3 style="color: #f5680a">Processing... Please wait.Don't press back/refresh button.</h3>
</div>
<body onLoad="document.redirect.submit();">
	
	<form action="<?=$action_url?>" method="post" name="redirect">
		<input type="hidden" name="encRequest" value="<?=$encrypted_data?>"> 
		<input type="hidden" name="access_code" value="<?=$access_code?>">
	</form>
</body>