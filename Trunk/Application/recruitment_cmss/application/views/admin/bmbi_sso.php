<?php
session_start();
$username=isset($_SESSION['username']) ? $_SESSION['username'] : '';
//echo $username;
if($_REQUEST['req'] == 12)
{
	//echo session_id();
	//echo $_COOKIE["PHPSESSID"];
	if(session_id() == $_COOKIE["PHPSESSID"] and $username != '')
		echo "true";
	else
		echo "session :false";	
}
else
{
	echo "Invalid Request ID";
}
?>