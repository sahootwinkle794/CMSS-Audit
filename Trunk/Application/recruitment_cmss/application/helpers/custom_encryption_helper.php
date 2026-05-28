<?php
/**
 * CodeIgniter
 * @package	Admission
 * @author	Manas Kumar Panda
 */
$rules;

defined('BASEPATH') OR exit('No direct script access allowed');
if ( ! function_exists('encrypt_decrypt'))
{
	//echo 
   	function encrypt_decrypt($operation,$data){
		
		$output = false;
	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'STL PVT LTD';
	    $secret_iv = 'STL PVT LTD';
	    // hash
	    $key = hash('sha256', $secret_key);
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);

	    if( $operation == 'encrypt' ) {
	        $output = openssl_encrypt($data, $encrypt_method, $key, 0, $iv);
	        $output = base64_encode($output);
	    }
	    else if( $operation == 'decrypt' ){
	        $output = openssl_decrypt(base64_decode($data), $encrypt_method, $key, 0, $iv);
	    }

	    return $output;
	}

  
}

?>