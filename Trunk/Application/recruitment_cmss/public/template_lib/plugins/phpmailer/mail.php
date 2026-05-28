<?php
require_once("class.phpmailer.php");
$mail             = new PHPMailer();
    
$body             = "Hello";
$mail->IsSMTP(); // telling the class to use SMTP
//$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
             // 1 = errors and messages
             // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server 25 OR 465 OR 587
$mail->Username   = "info.davcsp@gmail.com";  // GMAIL username
$mail->Password   = "davchandrasekharpur";            // GMAIL password
$mail->SetFrom('paramenjaya.sahu@gmail.com');
$mail->Subject    = "Message from DAV";
$mail->MsgHTML($body);
$address = "sahu.paramenjaya@gmail.com"; //send address
$mail->AddAddress($address);
//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
if(!$mail->Send()) 
{
 $message = "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
 $message = "A mail has been sent to your specified email.<br/>";
 $message .= "Please follow the link from email to complete the process.";
}
?>