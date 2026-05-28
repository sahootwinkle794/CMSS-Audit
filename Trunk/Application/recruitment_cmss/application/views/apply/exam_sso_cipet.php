<?php
$username = $this->session->userdata('reg_user_id');
$first_name = $Name[0]['Name'];
$role_code = 'EXAMINEE';
$org_code = 'CIPET';
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
$salt = "CA7C4DCB-A328-11E5-A425-12D5BFFEEFE9";
$_POST['user_name'] = $username;
$_POST['first_name'] = $first_name;
$_POST['secretkey'] = $salt;
$_POST['org_code'] = $org_code;
$_POST['role_code'] = $role_code;



$HASHING_METHOD = 'sha512'; // md5,sha1
if($role_code == 'EXAMINEE')
{
	$ACTION_URL = "http://mockexam.edusols.com/sso_cipet.php";
}

	
$hashData = '';

ksort($_POST);
foreach ($_POST as $key => $value){
	if (strlen($value) > 0) {
		$hashData .= '|'.$value;
	}
}
if (strlen($hashData) > 0) {
	$secureHash = strtoupper(hash($HASHING_METHOD, $hashData));
}
?>

<html>
	<body onLoad="document.sso.submit();">
		<!--<body>-->
		<h3>Please wait, redirecting..</h3>
		<form action="<?php echo $ACTION_URL;?>" name="sso" method="POST">
		<?php
		foreach($_POST as $key => $value) 
		{
		?>
			<input type="hidden" value="<?php echo $value;?>" name="<?php echo $key;?>"/>
		<?php
		}
		?>
		<input type="hidden" value="<?php echo $secureHash; ?>" name="secure_hash"/>
		</form>
	</body>
</html>