<?php
session_start();
error_reporting(E_ALL);
$phpsessionid = session_id();


$user_name = isset($_SESSION['username'])?$_SESSION['username']:'';

$lower_user_name = strtolower($user_name);

$userid = "$lower_user_name";
$organizationid = "1";
$bmbi_server_url = "http://localhost:8080/BMBI_HLC/BI/sso-viewer.html?ssoIn=true&orgId=".$organizationid."&userId=".$userid."&PHPSESSID=".$phpsessionid;
//echo $bmbi_server_url;
header("location: $bmbi_server_url");
?>
