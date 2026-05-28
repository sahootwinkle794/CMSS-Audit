<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Csc extends CI_Controller
{
	private $role;
	
	public function __construct() 
	{
		parent::__construct();
		
		$this->load->helper('connect_client');
		$this->role = $this->session->userdata('role');
		
		
   	}
	/*
	*	purpose : Handle page not found
	*/
	public function page_not_found()
	{
		$this->load->view('templates/404.php');
		$this->load->view('templates/admin_footer');
	}
	
	public function login()
	{
		if(isset($_SESSION['csc_username']) && $_SESSION['csc_username'] != '')
		{
			echo 'Welcome '. $_SESSION['csc_username'];
			header("location: ".base_url());
		}
		else
		{
			echo 'Not Logged In';
			$this->do_login();
			
		}
	}
	
	public function vle_logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
		
	}
	
	function do_login()
	{
		
		$obj = new Oauth_client();
		$client = $obj->get_client();
		$exparams = array(
			'state' => rand(10000, 99999)
		);
		$auth_url = $client->getAuthenticationUrl(AUTHORIZATION_ENDPOINT, REDIRECT_URI, $exparams);
		$_SESSION[CSC_CURR_URL]= $_SERVER['REQUEST_URI'];
		header('Location: ' . $auth_url);
		die('Redirect');	
	}
	
	
	public function authenticate_csc()
	{
		/*$csc_username = $_GET['csc_username'];
		$csc_user_id = $_GET['csc_user_id'];
		$csc_email = $_GET['csc_email'];
		$csc_aadhaar = $_GET['csc_aadhaar'];
		$csc_user_type = $_GET['csc_user_type'];
		$data = array(
            'csc_username' => $csc_username,
            'csc_user_id' => $csc_user_id,
            'csc_email' => $csc_email,
            'csc_aadhaar' => $csc_aadhaar,
            'csc_user_type' => $csc_user_type
        );
		$this->session->set_userdata($data);*/
	    
		//print_r($_SESSION);
		$this->callback();
		
		
		
	}
	
	function callback()
	{ 
		//$start1 = date('Y-m-d H:i:s', time());
		$start1 = microtime(true);
		//$client = $this->oauth_client->get_client();
		$obj = new Oauth_client();
		$client = $obj->get_client();

		$params = array('code' => $_GET['code'], 'redirect_uri' => REDIRECT_URI);
		  
		//$start2 = date('Y-m-d H:i:s', time());
		$start2 = microtime(true);
		$response = $client->getAccessToken(TOKEN_ENDPOINT, 'authorization_code', $params);
		//$start3 = date('Y-m-d H:i:s', time());
		$start3 = microtime(true);
		//print_r($response);die();
		$res = $response['result'];
		  
		$client->setAccessToken($res['access_token']);
		//$start4 = date('Y-m-d H:i:s', time());
		$start4 = microtime(true);
		$response = $client->fetch(RESOURCE_URL);
		//$start5 = date('Y-m-d H:i:s', time());
		$start5 = microtime(true);
		 
		//echo "<pre>"; 
		//print_r($response['result']['User']);

		$username=$response['result']['User']['username'];
		//$user_id=$response['result']['User']['user_id'];
		$email=$response['result']['User']['email'];
		//$aadhaar=$response['result']['User']['aadhar_number'];
		$user_type=$response['result']['User']['user_type'];

		$_SESSION['csc_username']=$username;
		//$_SESSION['csc_user_id']=$user_id;
		$_SESSION['csc_email']=$email;
		//$_SESSION['csc_aadhaar']=$aadhaar;
		$_SESSION['csc_user_type']=$user_type;
		//$start6 = date('Y-m-d H:i:s', time());
		$start6 = microtime(true);
		$log_srt = 
			"1> " . $start1 . "\n" . 
			"2> " . $start2 . "\n" . 
			"3> " . $start3 . "\n" . 
			"4> " . $start4 . "\n" . 
			"5> " . $start5 . "\n" . 
			"6> " . $start6 . "\n";
		//file_put_contents(__DIR__ . '/log/abc.log', $log_srt, FILE_APPEND);
		print_r($_SESSION);
		//echo($log_srt);die;
		//header("Location: /staging2/cipet/csc/authenticate_csc?csc_username=$username&csc_user_id=$user_id&csc_email=$email&csc_aadhaar=$aadhaar&csc_user_type=$user_type");
		header("Location: ".base_url());
		//redirect(base_url());
	}
	
}
