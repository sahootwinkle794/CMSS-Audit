<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Emitra extends CI_Controller
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
		//print_r($_POST);
		//Array ( 
		//[encData] => FNimIZTZIhwQBBCdhpdn/q8IoTJD6n5B/D/V09U6N8/AvVLzrYnQuTw+l7CSLw5OIZfAwHSK4EINdOdP3XLqE+2XkT2am2KdebqO6SpUCga8Fx/PjgoyNcbC4oB2j7r71oerjzEJvpogMPR3TV2cpPE6bXGryz9uv5eNjzGvIlksjBm2IeJuObouzkrGn4iLruDQIxDffUpBsjBocI8d0mdB/ZkZgLofnpHWeh7uGdDlS5CCQPatlrCpHrwbYMJL8UBe9G+a5q2e99T9vfvKT38HMq+IG1yaRjZHYlcZFf9D3ea9RJYMDcBRxE6z5EKmEl42/ei8dfDSy1qmp7lj0omFcylOC2w8Gsv0tlNhLBbUL0uo8MFWsMhTAgnIXxnd4Xqi2RhJM6MUUldbKcUEI2m8mnJQjda5Gm9EAY+T6ROIvs8njtqo8oGkZms+BPRd+mEcO2awOLzC1TOuktqWu3d2GVbEfh8p22ciznuTw4XcXW6+VSkHEN/wsK0ZkGtvk26EMU7JTRJQg/gUOJ49zETQ7h+kYslAmVlUVYtQetkM81XCiwIX21ntUsN8ElssnUkgb6JSiK/O447xvw9GqFtzOkcHMIKEzKF+kn6Iz8jhORJqfwrZGqrsZZ/LzI6bMuDudXVCPcdvfzkIOX99DbSYY/gYaijXtKVUNZIb1B6VA4gr3FgsvQivyJQrWlG0dsnSXUzS8RwB0wQT7S3JVCEUOZX/4L8yTJGKnv3fdKtxQ40OdHJ//wkakrb3eUBCF7NFEpoiZvVny64O3YUbiF+zILxGIgqDCNoqLSdWtqJCdIyP0aIcpd1zqdlfrk8T 
		//[logId] => me25oVEG1oajJbPvFyYwCA== 
		//[agCode] => RJeMitra 
		//[agKey] => spsj ) 
		$enc_data = $_POST['encData'];
		//$enc_data = 'FNimIZTZIhwQBBCdhpdn/q8IoTJD6n5B/D/V09U6N8/AvVLzrYnQuTw+l7CSLw5OIZfAwHSK4EINdOdP3XLqE+2XkT2am2KdebqO6SpUCga8Fx/PjgoyNcbC4oB2j7r71oerjzEJvpogMPR3TV2cpPE6bXGryz9uv5eNjzGvIlksjBm2IeJuObouzkrGn4iLruDQIxDffUpBsjBocI8d0mdB/ZkZgLofnpHWeh7uGdDlS5CCQPatlrCpHrwbYMJL8UBe9G+a5q2e99T9vfvKT38HMq+IG1yaRjZHYlcZFf9D3ea9RJYMDcBRxE6z5EKmEl42/ei8dfDSy1qmp7lj0omFcylOC2w8Gsv0tlNhLBbUL0uo8MFWsMhTAgnIXxnd4Xqi2RhJM6MUUldbKcUEI2m8mnJQjda5Gm9EAY+T6ROIvs8njtqo8oGkZms+BPRd+mEcO2awOLzC1TOuktqWu3d2GVbEfh8p22ciznuTw4XcXW6+VSkHEN/wsK0ZkGtvk26EMU7JTRJQg/gUOJ49zETQ7h+kYslAmVlUVYtQetkM81XCiwIX21ntUsN8ElssnUkgb6JSiK/O447xvw9GqFtzOkcHMIKEzKF+kn6Iz8jhORJqfwrZGqrsZZ/LzI6bMuDudXVCPcdvfzkIOX99DbSYY/gYaijXtKVUNZIb1B6VA4gr3FgsvQivyJQrWlG0dsnSXUzS8RwB0wQT7S3JVCEUOZX/4L8yTJGKnv3fdKtxQ40OdHJ//wkakrb3eUBCF7NFEpoiZvVny64O3YUbiF+zILxGIgqDCNoqLSdWtqJCdIyP0aIcpd1zqdlfrk8T';
		$key = 'E-m!tr@2016';
		$params = array("toBeDecrypt"=>$enc_data);
		$url = "http://emitrauat.rajasthan.gov.in/webServicesRepositoryUat/emitraAESDecryption";
		$ch = curl_init($url);
		$headers = array();
		$headers[] = 'Accept: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		if(curl_errno($ch)){
		    echo 'Request Error:' . curl_error($ch);
		}
		curl_close($ch);
		echo $result;
		$result = json_decode($result);
		
		//{"SSOID":"MANOJ.PANDIA",
		//"SERVICEID":"4070",
		//"EMSESSIONID":"WW2PVw3fcesZkDjOPHMwmxz",
		//"KIOSKCODE":"K11000142",
		//"OLDKIOSKCODE":"D97K0003",
		//"DISTRICTCD":"110",
		//"TEHSILCD":"D16T06",
		//"RETURNURL":"http://emitrauat.rajasthan.gov.in/emitraAppsUat/availService;jsessionid=WW2PVw3fcesZkDjOPHMwmxz?",
		//"EMITRATIMESTAMP":"20180615190843809",
		//"SSOTOKEN":"d2k4L0tvNUw0YzZMaHZ5ckdIc1JMZkJDL3A1NFQ4M0xwckgvQi9uVjVieFUyVHk5U1pNUE9RTTBEeG1vTzhMcG5IeHNvaWJENTFBTzlOTW51aU9LYjBmVmtRWXZqbWhybDRVNThQeHJoY2xjc1R0NEF3VzdyaEZEeUR2Y1ZyUUdkeURBL1lxaWkwbDQzZ1dIeTBaTWlpS1E5M1ZGdmJBYzNQYzRaVFlMNEFNPQ==",
		//"CHECKSUM":"f8927ef0e40626dcef643a21f70fabdf"}
		$SSOID = $result->SSOID;
		$SERVICEID = $result->SERVICEID;
		$EMSESSIONID = $result->EMSESSIONID;
		$KIOSKCODE = $result->KIOSKCODE;
		$OLDKIOSKCODE = $result->OLDKIOSKCODE;
		$DISTRICTCD = $result->DISTRICTCD;
		$TEHSILCD = $result->TEHSILCD;
		$RETURNURL = $result->RETURNURL;
		$EMITRATIMESTAMP = $result->EMITRATIMESTAMP;
		$SSOTOKEN = $result->SSOTOKEN;
		$CHECKSUM = $result->CHECKSUM;
		$_SESSION['EMITRASSOID'] = $SSOID;
		$_SESSION['SERVICEID'] = $SERVICEID;
		$_SESSION['EMSESSIONID'] = $EMSESSIONID;
		$_SESSION['KIOSKCODE'] = $KIOSKCODE;
		$_SESSION['OLDKIOSKCODE'] = $OLDKIOSKCODE;
		$_SESSION['DISTRICTCD'] = $DISTRICTCD;
		$_SESSION['TEHSILCD'] = $TEHSILCD;
		$_SESSION['EMITRAAPPURL'] = $RETURNURL;
		$_SESSION['SSOTOKEN'] = $SSOTOKEN;
		//calculate checksum
		header("Location: ".base_url());
		
		
	}
	
	function verify_sso_token()
	{
		
		$url = "http://ssotest.rajasthan.gov.in:8888/SSOREST/GetTokenDetailJSON/".$_SESSION['SSOTOKEN'];
		$ch = curl_init($url);
		$headers = array();
		$headers[] = 'Accept: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		if(curl_errno($ch)){
		    echo 'Request Error:' . curl_error($ch);
		}
		curl_close($ch);
		//echo $result; {"sAMAccountName":"MANOJ.PANDIA","Roles":["KIOSK"]}
		$result = json_decode($result);
		echo $result->sAMAccountName;
		echo $result->Roles[0];
	}
	
	function get_kiosk_detail()
	{
		
		$params = array("MERCHANTCODE"=>"RISLTEST","SSOID"=>$_SESSION['EMITRASSOID']);
		$url = "http://emitrauat.rajasthan.gov.in/webServicesRepositoryUat/getKioskDetailsJSON";
		$ch = curl_init($url);
		$headers = array();
		$headers[] = 'Accept: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		if(curl_errno($ch)){
		    echo 'Request Error:' . curl_error($ch);
		}
		curl_close($ch);
		//echo $result; //{"sAMAccountName":"MANOJ.PANDIA","Roles":["KIOSK"]}
		//{"REQUESTTIMESTAMP":"20180616154941724","REQUESTSTATUSCODE":200,"MSG":"SUCCESS","SSOID":"MANOJ.PANDIA","MERCHANTCODE":"RISLTEST","KIOSKCODE":"K11000142","OLDKIOSKCODE":"D97K0003CO01|D97K0003CO02|D97K0003CO03|D97K0003CO04|D97K0003CO05","KIOSKNAME":"TEST KIOSK EMITRA","ENTITYTYPE":"LSP KIOSK","DISTRICT":"JAIPUR","DISTRICTCD":"110","TEHSIL":"JAIPUR","TEHSILCD":"D16T06","VILLAGE":"NA","VILLAGECD":"NA","WARD":"WARD NO- 1","WARDCD":"C085W001","PINCODE":302013,"MOBILE":98989898989,"EMAIL":"TESTKIOSK@GMAIL.COM","LSPNAME":"SSOLSP","LSPCODE":"L0142","EMITRATIMESTAMP":"20180616154941754"}
		$result = json_decode($result);
		//echo $result->sAMAccountName;
		//echo $result->Roles[0];
		
	}
	
	function b2b_transaction()
	{
		$MERCHANTCODE = 'RISLTEST';
		$REQUESTID = 'REQ'.rand();
		$REQTIMESTAMP = date('YmdHis');
		$SERVICEID = '4070';
		$SUBSERVICEID = '';
		$REVENUEHEAD = '863-100.00|865-05.00';
		$CONSUMERKEY = '9338845287';
		$CONSUMERNAME = 'MANOJ KUMAR PANDIA';
		$COMMTYPE = '1';
		$SSOID = $_SESSION['EMITRASSOID'];
		$OFFICECODE = 'RISLTESTHQ';
		$SSOTOKEN = $_SESSION['SSOTOKEN'];
		$CHECKSUM = md5(json_encode(array("SSOID"=>$SSOID,"REQUESTID"=>$REQUESTID,"REQTIMESTAMP"=>$REQTIMESTAMP,"SSOTOKEN"=>$SSOTOKEN)));
		
		
		$params = array("MERCHANTCODE"=>$MERCHANTCODE,
						"REQUESTID"=>$REQUESTID,
						"REQTIMESTAMP"=>$REQTIMESTAMP,
						"SERVICEID"=>$SERVICEID,
						"SUBSERVICEID"=>$SUBSERVICEID,
						"REVENUEHEAD"=>$REVENUEHEAD,
						"CONSUMERKEY"=>$CONSUMERKEY,
						"CONSUMERNAME"=>$CONSUMERNAME,
						"COMMTYPE"=>$COMMTYPE,
						"SSOID"=>$SSOID,
						"OFFICECODE"=>$OFFICECODE,
						"SSOTOKEN"=>$SSOTOKEN,
						"CHECKSUM"=>$CHECKSUM
						);
		$plain_data = json_encode($params);
		//echo $plain_data.'<br/>';
		//GET ENCRYPTED DATA
		$params = array("toBeEncrypt"=>$plain_data);
		$url = "http://emitrauat.rajasthan.gov.in/webServicesRepositoryUat/emitraAESEncryption";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		if(curl_errno($ch)){
		    echo 'Request Error:' . curl_error($ch);
		}
		curl_close($ch);
		$enc_data = $result;
		
		//echo 'endData '.$enc_data;
		
		
		$url = "http://emitrauat.rajasthan.gov.in/webServicesRepositoryUat/backtobackTransactionWithEncryptionA";
		$ch = curl_init($url);
		$headers = array();
		$headers[] = 'Accept: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array("encData"=>$enc_data)));
		//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array("data"=>$plain_data)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		if(curl_errno($ch)){
		    echo 'Request Error:' . curl_error($ch);
		}
		curl_close($ch);
		$enc_response = $result;
		
		//decrypt response
		$params = array("toBeDecrypt"=>$enc_response);
		$url = "http://emitrauat.rajasthan.gov.in/webServicesRepositoryUat/emitraAESDecryption";
		$ch = curl_init($url);
		$headers = array();
		$headers[] = 'Accept: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		if(curl_errno($ch)){
		    echo 'Request Error:' . curl_error($ch);
		}
		curl_close($ch);
		$result = json_decode($result);
		$RES_REQUESTID = $result->REQUESTID;
		$RES_TRANSACTIONSTATUSCODE = $result->TRANSACTIONSTATUSCODE;
		$RES_RECEIPTNO = $result->RECEIPTNO;
		$RES_TRANSACTIONID = $result->TRANSACTIONID;
		$RES_TRANSAMT = $result->TRANSAMT;
		$RES_REMAININGWALLET = $result->REMAININGWALLET;
		$RES_EMITRATIMESTAMP = $result->EMITRATIMESTAMP;
		$RES_TRANSACTIONSTATUS = $result->TRANSACTIONSTATUS;
		$RES_MSG = $result->MSG;
		$RES_CHECKSUM = $result->CHECKSUM;
		if($RES_TRANSACTIONSTATUSCODE == '200')
		{
			echo 'SUCCESS';
		}
		else
		{
			echo $RES_TRANSACTIONSTATUS . '<br/>';
			echo $RES_MSG . '<br/>';
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
