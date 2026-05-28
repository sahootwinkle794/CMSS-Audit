<?php defined('BASEPATH') OR exit('No direct script access allowed');
 error_reporting(E_ALL);
 ini_set("display_errors",1);

class Meeseva extends CI_Controller
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
	
	
	
	public function meeseva_logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
	
	public function xml2array ( $xmlObject, $out = array () )
	{
	    foreach ( (array) $xmlObject as $index => $node )
	        $out[$index] = ( is_object ( $node ) ) ? $this->xml2array ( $node ) : $node;
	    return $out;
	}
	
	public function authenticate_meeseva()
	{
		
	    $agcytype = $_POST['agcytype'];
	    $centrecode = $_POST['centrecode'];
	    $counter = $_POST['counter'];
	    $cspname = $_POST['cspname'];
	    $deptcode = $_POST['deptcode'];
	    $distcode = $_POST['distcode'];
	    $distreqid = $_POST['distreqid'];
	    $francode = $_POST['francode'];
	    
	    $servicecode = $_POST['servicecode'];
	    $shiftcode = $_POST['shiftcode'];
	    $staffCode = $_POST['staffCode'];
	    $userId = 'ESEVA';
		$password = 'ESEVA123#789';
		
        $soapUrl = "http://112.133.253.124:80/Paymentsapi/services/commonpg.commonpgHttpSoap12Endpoint/"; // asmx URL of WSDL
       

        // xml post structure

        $xml_post_string = "<soap:Envelope xmlns:soap=\"http://www.w3.org/2003/05/soap-envelope\" xmlns:com=\"http://commonpg.eseva.com\" xmlns:xsd=\"http://commonpg.eseva.com/xsd\">
				   <soap:Header/>
				   <soap:Body>
				      <com:CheckUserAuth>
				         <!--Optional:-->
				         <com:RequestBean>
				            <xsd:agcytype>$agcytype</xsd:agcytype>
				            <xsd:centrecode>$centrecode</xsd:centrecode>
				            <xsd:counter>$counter</xsd:counter>
				            <xsd:cspname>$cspname</xsd:cspname>
				            <xsd:deptcode>$deptcode</xsd:deptcode>
				            <xsd:distcode>$distcode</xsd:distcode>
				            <xsd:distreqid>$distreqid</xsd:distreqid>
				            <xsd:francode xsi:nil=\"true\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"/>
				            <xsd:password>$password</xsd:password>
				            <xsd:servicecode>$servicecode</xsd:servicecode>
				            <xsd:shiftcode>$shiftcode</xsd:shiftcode>
				            <xsd:staffCode>$staffCode</xsd:staffCode>
				            <xsd:userId>$userId</xsd:userId>
				         </com:RequestBean>
				      </com:CheckUserAuth>
				   </soap:Body>
				</soap:Envelope>";   // data from the form, e.g. some ID number

           $headers = array(
                        "Content-type: application/soap+xml;charset=\"utf-8\";action=\"urn:CheckUserAuth\"",
                        "Accept: application/xml;charset=\"utf-8\"",
                        "Accept-Encoding: gzip,deflate",
                        "Cache-Control: no-cache",
                        "Pragma: no-cache",
                        "Content-length: ".strlen($xml_post_string),
                        "Connection: Keep-Alive",
                        "User-Agent: Apache-HttpClient/4.5.2 (Java/1.8.0_152)"
                    ); //SOAPAction: your op URL

            $url = $soapUrl;

            // PHP cURL  for https connection with auth
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // converting
            try{
            	$response = curl_exec($ch); 
			}
			catch(Exception $e)
			{
				echo $e->getMessage(); 
			}
            curl_close($ch);
            
			$xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
			$xml = simplexml_load_string($xml);
			//echo($xml->soapenvBody->nsCheckUserAuthResponse->nsreturn->children()[0]);
			//echo($xml->soapenvBody->nsCheckUserAuthResponse->nsreturn->children()[1]);
			//echo($xml->soapenvBody->nsCheckUserAuthResponse->nsreturn->children()[2]);
			//echo($xml->soapenvBody->nsCheckUserAuthResponse->nsreturn->ax21strResCode[0]);
			//echo($xml->soapenvBody->nsCheckUserAuthResponse->nsreturn->ax21strResDesc[0]);
			//var_dump($xml->soapenvBody->nsCheckUserAuthResponse->nsreturn);

			//$json = json_encode($xml);
			
			//$responseArray = json_decode($json,true);
			//print_r($responseArray);
			$strRequestID = $xml->soapenvBody->nsCheckUserAuthResponse->nsreturn->children()[0];
			$strResCode = $xml->soapenvBody->nsCheckUserAuthResponse->nsreturn->children()[1];
			$strResDesc = $xml->soapenvBody->nsCheckUserAuthResponse->nsreturn->children()[2];
			
			if($strResCode == '000')
			{
				$_SESSION['mee_agcytype'] = $agcytype;
			    $_SESSION['mee_centrecode'] = $centrecode;
			    $_SESSION['mee_counter'] = $counter;
			    $_SESSION['mee_cspname'] = $cspname;
			    $_SESSION['mee_deptcode'] = $deptcode;
			    $_SESSION['mee_distcode'] = $distcode;
			    $_SESSION['mee_distreqid'] = $distreqid;
			    $_SESSION['mee_francode'] = $francode;
			    $_SESSION['mee_password'] = $password;
			    $_SESSION['mee_servicecode'] = $servicecode;
			    $_SESSION['mee_shiftcode'] = $shiftcode;
			    $_SESSION['mee_staffCode'] = $staffCode;
			    $_SESSION['mee_userId'] = $userId;
			    header("Location: ".base_url());
			}
			else
			{
				unset($_SESSION['mee_userId']);
				echo $strResDesc;
			}	
			
			
			

	}
	
	
}
