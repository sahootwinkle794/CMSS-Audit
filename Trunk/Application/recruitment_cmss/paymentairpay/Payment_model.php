<?php

class Payment_model extends CI_model {

   // private $role;

    function __construct() {
        parent::__construct();
        $this->load->helper('date');
        $this->load->helper('bridge_config');
        $this->load->helper('bridgepgutil');

        if (ENVIRONMENT == 'production') {
            $this->db->save_queries = FALSE;
        }
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s', now());
        //echo $this->group_data();
    }
    
    public function payment($data, $op, $stage = null) 
    {
    	switch ($op) 
    	{
    		case 'validate_institute':
				$ins =  encrypt_decrypt('decrypt', $data);
				if($ins == '0')
				{
					$ins = '';
				} 
				$this->db->select('ins.*');
				$this->db->from('institute_master as ins');
				$this->db->where('ins.institute_code',$ins);
				//print_r($query);
				$result = $this->db->get();
				//print_r($result);
				//echo $this->db->last_query();
				$result->result_array();
				if($result->num_rows() > 0) {
					  return array('status'=>true, 'msg'=>'Present');
				}
				else
				{
					return array('status'=>false, 'msg'=>'Not Present');
				}
			break;
			case 'validate_program':
				
				$this->db->select('p.*');
				$this->db->from('program_master as p');
				$this->db->where('p.program_code',$data);
				//print_r($query);
				$result = $this->db->get();
				//print_r($result);
				$result->result_array();
				if($result->num_rows() > 0) {
					  return array('status'=>true, 'msg'=>'Present');
				}
				else
				{
					return array('status'=>false, 'msg'=>'Not Present');
				}
			break;
			case 'get_institute_data':
				$ins =  encrypt_decrypt('decrypt', $data);
				if($ins == '0') 
					$ins = '';
				$this->db->select('institute_code,institute_name,image_url');
				$this->db->from('institute_master as ins');
				$this->db->where('ins.institute_code',$ins);
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_appl_status':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$ins =  encrypt_decrypt('decrypt', $data);
        		
        		
				$this->db->select('appl_status');
				$this->db->from('applicant_appl_overview');
				
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('STATUS','1');
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_program_detail':
				$program_code = $data;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select('id,program_name,program_code');
				$this->db->from('program_master');
				$this->db->where('program_code',$program_code);
				$this->db->where('STATUS','Active');
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_applicant_detail':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$ins =  encrypt_decrypt('decrypt', $data);
        		
        		
				$this->db->select('T1.full_name,T1.first_name,T2.program_name,T2.program_code');
				$this->db->from('applicant_master T1');
				$this->db->join('program_master T2','T1.applied_program = T2.program_code','LEFT');
				$this->db->where('T1.applied_program',$program_code);
				$this->db->where('T1.reg_user_id',$reg_user_id);
				$this->db->where('T1.status','1');
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_application_from_institute':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$ins =  $data;
        	
        		
				$this->db->select('*');
				$this->db->from('program_master');
				
				$this->db->where('program_code',$program_code);
				$this->db->where('institute_code',$ins);
				//print_r($query);
				$result1 = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				//$result->result_array();
				if($result1->num_rows() > 0) {
					$output_data = $result1->result_array();
					foreach($output_data as $row)
					{
						$prg_code = $row['program_code'];
						
					}
					$this->db->select('*');
					$this->db->from('applicant_appl_overview');
					
					$this->db->where('applied_program',$prg_code);
					$this->db->where('appl_no',$application_no);
					$result = $this->db->get();
					//$result->result_array();
					if($result->num_rows() > 0) {
						return array('status'=>true, 'msg'=>'Present');
					}
					else
					{
						return array('status'=>false, 'msg'=>'Not Present');
					}
				}
				else
				{
					return array('status'=>false, 'msg'=>'Not Present');
				}
			break;
			case 'categorydata':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$ins =  encrypt_decrypt('decrypt', $data);
        		
				$this->db->select('category');
				$this->db->from('applicant_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('STATUS','1');
				$this->db->where('applied_program',$program_code);
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_transaction_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$ins =  encrypt_decrypt('decrypt', $data);
        		
				$this->db->select('transaction_charge');
				$this->db->from('online_transaction_charge_setup');
				$this->db->where('program_code',$program_code);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_amount_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$ins =  encrypt_decrypt('decrypt', $data);
        		
        		$this->db->select('category,last_grade,physically_challenged,nationality');
				$this->db->from('applicant_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('STATUS','1');
				$this->db->where('applied_program',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$category = $row['category'];
					$ph = $row['physically_challenged'];
					$nationality = $row['nationality'];
				}
				
				$cat_val = $category;
				$this->db->select('amount');
				$this->db->from('program_fee_setup');
				$this->db->where('category_code',$cat_val);
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				
				return $result->result_array();
			break;
			case 'get_payment_gateway_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$ins =  encrypt_decrypt('decrypt', $data);
        		
        		
				$this->db->distinct("A.pg_code");
				$this->db->select("A.pg_code, B.pg_name, B.logo_url, B.remarks, B.payment_process_url");
				$this->db->from('pg_parameter_values A');
				$this->db->join('pg_master B','A.pg_code = B.pg_code','INNER');
				$this->db->where('A.school_code',$ins);
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'add_payment_gateway_data':
			
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now =date('Y-m-d H:i:s', now());
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$payment_option = isset($_POST['radPaymentGateway'])?$_POST['radPaymentGateway']:'';
        		$sel_pg = isset($_POST['radPaymentGateway']) ? $_POST['radPaymentGateway'] : '';
        		$sel_payment_process_url = '';
        		
        		$this->db->select('transaction_charge');
				$this->db->from('online_transaction_charge_setup');
				$this->db->where('program_code',$program_code);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$transactionalcharges =0;
				foreach ($output_data as $row) 
		        {
		        	$transactionalcharges = $row['transaction_charge'];
		        }
        		
        		$this->db->select('category,physically_challenged,nationality');
				$this->db->from('applicant_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('STATUS','1');
				$this->db->where('applied_program',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$category = $row['category'];
		        	$physically_challenged = $row['physically_challenged'];
					$nationality = $row['nationality'];
		        }
        		/*if($nationality == 'OTH')
				{
					$cat_val = 'OTH';
					$this->db->select('3350 AS amount');
					$result = $this->db->get();
				}
				else
				{*/
				$cat_val = $category;
				$this->db->select('amount');
				$this->db->from('program_fee_setup');
				$this->db->where('category_code',$cat_val);
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				/*}*/
				//$this->db->select('amount');
				//$this->db->from('program_fee_setup');
				//$this->db->where('program_code',$program_code);
				//$this->db->where('category_code',$cat_val);
				//$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$amount = $row['amount'];
		        }
        		$amount_to_pay = ($amount + $transactionalcharges).'.00';
        		
        		if($payment_option != '')
				{
					$this->db->trans_start();
					
					$this->db->distinct("A.pg_code");
					$this->db->select("A.pg_code, B.pg_name, B.logo_url, B.remarks, B.payment_process_url");
					$this->db->from('pg_parameter_values A');
					$this->db->join('pg_master B','A.pg_code = B.pg_code','INNER');
					$this->db->where('A.school_code',$ins);
					$result = $this->db->get();
					//echo $this->db->last_query();die;
					$output_data = $result->result_array();
					foreach ($output_data as $row) 
			        {
			        	if($row['pg_code'] == $sel_pg)
			        	{
							$sel_payment_process_url = $row['payment_process_url'];	
						}
			        }
			        $this->db->select('*');
					$this->db->from('applicant_form_fee_overview');
					$this->db->where('appl_no',$application_no);
					$result = $this->db->get();
					if($result->num_rows() == 0){
						 $applicant_form_fee_overview = array(
							'id' => NULL,
							'appl_no' => $application_no,
							'money_deposit_mode' => 'ONLINE',
							'amount' => $amount_to_pay,
							'institute_code' => $ins,
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$this->db->insert('applicant_form_fee_overview',$applicant_form_fee_overview);
					}else{
						$applicant_form_fee_overview = array(
							'amount' => $amount_to_pay,
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$this->db->where('appl_no',$application_no);
						$this->db->update('applicant_form_fee_overview',$applicant_form_fee_overview);
					}
			        
			        			        
			        if($this->db->affected_rows() == 0)
					{
						$dbStatus = FALSE;
						$dbMessage = 'Error inserting applicant_form_fee_overview';
					}
					else
					{
						$this->db->select('program_code, year, online_payment_transaction_no');
						$this->db->from('program_master');
						$this->db->where('program_code',$program_code);
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach ($output_data as $row) 
				        {
				        	$online_order_sl_no = $row['online_payment_transaction_no'];
							$program_code = $row['program_code'];
							$year = substr($row['year'],2,2);
				        }
						$new_sl_no = $online_order_sl_no + 1;
						$prg_code = str_replace("_",'',$program_code);
						$order_number = $prg_code.$year.$new_sl_no;
						$applicant_form_online_deposit = array(
							'id' => NULL,
							'appl_no' => $application_no,
							'money_deposit_mode' => 'ONLINE',
							'deposit_status' => 'INITIATED',
							'pg_code' => $sel_pg,
							'request_datetime' => $now,
							'institute_code' => $ins,
							'order_number' => $order_number,
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$this->db->insert('applicant_form_online_deposit',$applicant_form_online_deposit);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting applicant_form_online_deposit';
						}
						else
						{
							$program_master = array(
								'online_payment_transaction_no' => $new_sl_no
							);
							$this->db->where('program_code',$program_code);
							$update_applicant = $this->db->update('program_master',$program_master);
							if(!$update_applicant){
								$this->db->trans_rollback();
							}
							else
							{
								$this->db->trans_complete();
								$this->session->set_userdata('app_fee', $amount_to_pay);
								$this->session->set_userdata('order_number', $order_number);
								return array('status' => $dbStatus, 'msg' => $dbMessage,'sel_payment_process_url' => $sel_payment_process_url);
							}
						}
					}	
        		}
        		
			break;
			case 'process_payment_billdesk':
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$order_number = $this->session->userdata('order_number');
				$amount = $this->session->userdata('app_fee');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$strCurDate = date('d-m-Y');
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$parsedUrl = parse_url($url);
				
				$host = $parsedUrl['host'];
        		
        		//$onlinepayment_transaction_number = $_SESSION['online_payment_transaction_number'];
			//$encrpt_role_code = isset($_REQUEST['role_code'])?$_REQUEST['role_code']:'';
			//$con=new PostgreDB();
			//get customer id (sic), amount
			
			$this->db->select("afod.appl_no, affo.amount");
			$this->db->from('applicant_form_online_deposit afod');
			$this->db->join('applicant_form_fee_overview affo','afod.appl_no=affo.appl_no','INNER');
			$this->db->where('order_number',$order_number);
			$this->db->where('afod.institute_code',$ins);
			$result = $this->db->get();
			$output_data = $result->result_array();
			foreach($output_data as $row){
				$student_code = $row['appl_no'];
				$amount_to_pay = $row['amount'];
			}
			//MerchantID|CustomerID|NA|TxnAmount|NA|NA|NA|CurrencyType|NA|TypeField1|SecurityID|
			//NA|NA|TypeField2|txtadditional1| txtadditional2| txtadditional3| txtadditional4|
			//txtadditional5| txtadditional6| txtadditional7|RU

			//ABCD|ARP10234|NA|94.00|NA|NA|NA|INR|NA|R|abcd|NA|NA|F|NA|NA|NA|NA|NA|NA|NA|
			//http://www.domain.com/response.jsp

			//SILCONTEC|SITBBSFCS07412|NA|1.00|NA|NA|NA|INR|NA|R|silcontec|NA|NA|F|2016-17-17|NA|NA|NA|NA|NA|NA|http:
			//erp.silicon.ac.in/estcampus/finance/payment_response.php|5ba9b322553c80b1844c782ff7615c484918b9434
			//70a25e3bf77e9da8066f1de

			//SILCONTEC|SITBBSFCS07412|NA|100.00|NA|NA|NA|INR|NA|R|silcontec|NA|NA|F|121|NA|NA|NA|NA|NA|NA|http://erp.silicon
			//.ac.in/estcampus/finance/payment_response.php|101ce237306492d8e3d097c0b308f7cc34fb8b237a1bf08c9b9c41
			//fd026df6f8

			$pg = 'BILLDESK';
			//get pg action url
			$this->db->select("pg_action_url");
			$this->db->from('pg_master');
			$this->db->where('pg_code',$pg);
			$result = $this->db->get();
			$output = $result->result_array();
		 	foreach($output as $row){
				$pg_action_url = $row['pg_action_url'];
			}
			

			//get pg parameter values for this school
			$this->db->select("pg_parameter_code, pg_parameter_value");
			$this->db->from('pg_parameter_values');
			$this->db->where('pg_code',$pg);
			$this->db->where('institute_code',$ins);
			$result = $this->db->get();
			$output_param = $result->result_array();
			foreach($output_param as $row){
				$pg_parameter_values[$row['pg_parameter_code']] = $row['pg_parameter_value'];
			}
						
			/*$query = "SELECT pg_parameter_code, pg_parameter_value
				FROM pg_parameter_values
				WHERE pg_code = '$pg'
				AND institute_code = '$ins'";
			$result = mysqli_query($con, $query);
			if (!$con->ExecQuery($query)) // Execute query or die if error is occured
			{
			    $dbStatus = 'Failure'; 
			    $dbMessage = $con->Error();
			}
			else
			{
				if(pg_num_rows($con->result))
				{			
					for($i=0; $row = $con->FetchResult($i, PGSQL_BOTH); $i++)
						$pg_parameter_values[$row['pg_parameter_code']] = $row['pg_parameter_value'];
				}
			}*/
			
			
			
			
			
			   /*     return array('status' => $dbStatus, 'msg' => $dbMessage,'payment_process_url' => $response);
			        exit;
			    }
			    elseif(is_string($response) && preg_match('/^txn_status=/',$response))
			    {
			    	return array('status' => $dbStatus, 'msg' => $dbMessage,'payment_process_url' => $response);
			        exit;
				}*/
				return array('status' => $dbStatus, 'msg' => $dbMessage,'payment_process_url' => $pg_action_url,'student_code'=>$student_code,'amount_to_pay'=>$amount_to_pay,'param_val'=>$pg_parameter_values);
			break;
			case 'process_payment_payu':
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$order_number = $this->session->userdata('order_number');
				$amount = $this->session->userdata('app_fee');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$strCurDate = date('d-m-Y');
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$parsedUrl = parse_url($url);
				
				$host = $parsedUrl['host'];
        		
        		$this->db->select('institute_code');
				$this->db->from('program_master');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$institute_code = $row['institute_code'];
		        }
		        $this->session->set_userdata('institute_code', $institute_code);
		        $ins_enc =  encrypt_decrypt('encrypt', $institute_code);
		        $this->db->select('pg_action_url');
				$this->db->from('pg_master');
				$this->db->where('pg_code','PAYU');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$pg_action_url = $row['pg_action_url'];
		        }
		        
		        $this->db->select('pg_parameter_code, pg_parameter_value');
				$this->db->from('pg_parameter_values');
				$this->db->where('pg_code','PAYU');
				$this->db->where('school_code',$institute_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$pg_parameter_values[$row['pg_parameter_code']] = $row['pg_parameter_value'];
		        }
        		
				$this->db->select("address_1,city_name,post_office,dm.district_name,sm.state_name,pin,applicant_address.district_code,applicant_address.state_code");
				$this->db->from('applicant_address');
				$this->db->join('applicant_master appmas','applicant_address.address_ref_id=appmas.perm_address_ref_id ','LEFT');
				$this->db->join('applicant_appl_overview applov','applov.reg_user_id=appmas.reg_user_id','LEFT');
				$this->db->join('district_master dm','dm.district_code=applicant_address.district_code','LEFT');
				$this->db->join('state_master sm','sm.state_code=applicant_address.state_code','LEFT');
				$this->db->where('applov.reg_user_id',$reg_user_id);
				$this->db->where('applov.applied_program',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$permanentaddr1 = $row['address_1'];
					$permanentaddr2 = $row['city_name'];
					$permanentpostoffice = $row['post_office'];
					$permanentdistrictcode = $row['district_name'];
					$permanentstatecode = $row['state_name'];
					$permanentpin = $row['pin'];
					$chkpermanentotherdistrict = $row['district_code'];
					$chkpermanentotherstate = $row['state_code'];
		        }
		        
		        $this->db->select("T1.full_name,T1.first_name,T2.program_name,T2.program_code");
				$this->db->from('applicant_master T1');
				$this->db->join('program_master T2','T1.applied_program = T2.program_code','LEFT');
				$this->db->where('T1.reg_user_id',$reg_user_id);
				$this->db->where('T1.applied_program',$program_code);
				$this->db->where('T1.status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$full_name = $row['full_name'];
					$first_name = $row['first_name'];
					$program_name = $row['program_name'];
					$program_code = $row['program_code'];
		        }
		        
        		$full_name_size=strlen($full_name);
        		
        		$order_id = $order_number;        //your script should substitute the order description here in the quotes provided here
				if($full_name_size>=50){
					$billing_cust_name = $first_name;
					}         
				else{
					$billing_cust_name = $full_name;
				}
				$billing_cust_address = $permanentaddr1;
				$billing_cust_country = 'INDIA';
				$billing_cust_state = $permanentstatecode;
				$billing_city = $permanentaddr2;
				$billing_zip = $permanentpin;
				$billing_cust_tel = $reg_user_id;
				$billing_cust_email = 'escap@stlindia.com';
        		
        		
        		
        		if($full_name_size>=50){
					$delivery_cust_name = $first_name;
				}         
				else{
					$delivery_cust_name = $full_name;
				}
				//$delivery_cust_name = $full_name;
				$delivery_cust_address = $permanentaddr1;
				//$delivery_cust_country = $pg_parameter_values['BCC'];
				$delivery_cust_state = $permanentstatecode;
				$delivery_city = $permanentaddr2;
				$delivery_zip = $permanentpin;
				$delivery_cust_tel = $reg_user_id;

				$delivery_cust_notes = "Application Fee for".$program_name;
				
				$MERCHANT_KEY = $pg_parameter_values['MERCHANTKEY']; //Please change this value with live key for production
				$hash_string = '';
				// Merchant Salt as provided by Payu
				$SALT = $pg_parameter_values['MERCHANTSALT']; //Please change this value with live salt for production


				$action = '';

				$posted['key'] = $MERCHANT_KEY;
				$posted['txnid'] = $order_number;
				$posted['salt'] = $SALT;
				//echo "<br/>";
				$posted['amount'] = $amount;
				$posted['firstname'] = $billing_cust_name;
				$posted['email'] = $billing_cust_email;
				$posted['phone'] = $billing_cust_tel;
				$posted['productinfo'] = "Application Fee";

				$posted['lastname'] = $billing_cust_name;
				$posted['curl'] = "https://eapp.stlindia.com/staging2/dav_admission/Payment/process_payment";
				$posted['address1'] = $billing_cust_address;
				$posted['address2'] = '';
				$posted['city'] = $billing_city;
				$posted['state'] = $billing_cust_state;
				$posted['zipcode'] = $billing_zip;
				$posted['country'] = $billing_cust_country;
				$posted['udf1'] = "Application Fee for".$program_name;
				$posted['udf2'] = $application_no;
				$posted['udf3'] = $reg_user_id;
				$posted['udf4'] = $program_code;
				$posted['udf5'] = $program_name;
				$posted['pg'] = '';


				$formError = 0;
				$txnid = $order_number;

				$hash = '';
				// Hash Sequence sha512(key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5||||||SALT)
				$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|||||";
				if(empty($posted['hash']) && sizeof($posted) > 0) 
				{
				  	if(
				        empty($posted['key'])
				          || empty($posted['txnid'])
				          || empty($posted['amount'])
				          || empty($posted['productinfo'])
				          || empty($posted['firstname'])
				          || empty($posted['email'])
				  	) 
				  	{
				    	$formError = 1;
				  	} 
				  	else 
				  	{
						$hashVarsSeq = explode('|', $hashSequence);
				 		foreach($hashVarsSeq as $hash_var) {
					      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
					      $hash_string .= '|';
					    }
					   	$hash_string .= $SALT;
					   	//echo "<br/>";
				    	$hash = strtolower(hash('sha512', $hash_string));
				    	$action = $pg_action_url;
				    	
				  	}
				}
				elseif(!empty($posted['hash'])) 
				{
				  $hash = $posted['hash'];
				 
				  $action = $pg_action_url;
				  $posted['action'] = $action;
				}
				
				$posted['hash'] = $hash;
				$posted['action'] = $action;
				return array('status' => $dbStatus, 'msg' => $dbMessage,'payment_process_url' => $action,'data'=>$posted);
			break;
			case 'get_post_payment_data_payu':
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$order_number = $this->session->userdata('order_number');
				$amount = $this->session->userdata('app_fee');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$date_time = date('Y-m-d H:i:s', now());
        		//$strCurDate = date('d-m-Y');
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$this->db->select('A.institute_code,B.institute_name,logo_url');
				$this->db->from('program_master A');
				$this->db->join('institute_master B','A.institute_code = B.institute_code','INNER');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$ins_name = $row['institute_name'];
					$ins_code = $row['institute_code'];
					$institute_logo = $row['logo_url'];
					$institute_logo = "../build/images/logo/".$institute_logo;
		        }
		        $hex_ins_code =  encrypt_decrypt('encrypt', $ins_code);
		        $applshow=0;
				$show=0;
				$print=0;
				$noamount=0;
				$showChallanInfo=0;
				$edit="false";
				$editappl="false";
		        
		        $this->db->select('A.template_code,B.template_name,file_name');
				$this->db->from('program_master A');
				$this->db->join('form_template_master B','A.template_code = B.template_code','INNER');
				$this->db->where('A.program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$temp_code = $row['template_code'];
					$temp_name = explode(".",$row['file_name']);
					$file_name = $temp_name[0]."_pdf.php";
					$print_function = $temp_name[0]."_pdf";
		        }
		        
		        $this->db->select('appl_status');
				$this->db->from('applicant_appl_overview');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program_code);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$appl_status = $row['appl_status'];
		        }
		        

				$payment_status = "";
				$payment_id = "";
				
				$status = $_POST["status"];
				$firstname = $_POST["firstname"];
				$amount_paid = $_POST["amount"]; 
				$txnid = $_POST["txnid"];
				$pg_order_number = $txnid;
				$posted_hash = $_POST["hash"];
				$key = $_POST["key"];
				$productinfo = $_POST["productinfo"];
				$email = $_POST["email"];
				$mihpayid = $_POST["mihpayid"];
				$mode = $_POST["mode"];
				$error = $_POST["error"];
				$bankcode = $_POST["bankcode"];
				$bank_ref_num = $_POST["bank_ref_num"];
				$PG_TYPE = $_POST["PG_TYPE"];
				$udf1 = $_POST["udf1"];
				$udf2 = $_POST["udf2"];
				$udf3 = $_POST["udf3"];
				$udf4 = $_POST["udf4"];
				$udf5 = $_POST["udf5"];
				$additionalCharges = isset($_POST["additionalCharges"]) ? $_POST["additionalCharges"] : '';
				$response_log = '';
				foreach($_POST as $post_key => $post_value)
				{
					$response_log .= '|'.$post_key."=>".$post_value;
				}
			    $transactionResponseBean = new TransactionResponseBean();
			    $this->db->select("pg_parameter_code, pg_parameter_value");
				$this->db->from('pg_parameter_values');
				$this->db->where('pg_code','PAYU');
				$this->db->where('school_code',$ins);
				$result = $this->db->get();
				$output_param = $result->result_array();
				foreach($output_param as $row){
					$pg_parameter_values[$row['pg_parameter_code']] = $row['pg_parameter_value'];
				}

			    $salt = $pg_parameter_values['MERCHANTSALT'];
			    $salt = 'nmSrXLHD';
	
	  
				$hash_validated = TRUE;
				if($additionalCharges == '')
			    	$retHashSeq = $salt.'|'.$status.'||||||'.$udf5.'|'.$udf4.'|'.$udf3.'|'.$udf2.'|'.$udf1.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount_paid.'|'.$txnid.'|'.$key;
				else
					$retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'||||||'.$udf5.'|'.$udf4.'|'.$udf3.'|'.$udf2.'|'.$udf1.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount_paid.'|'.$txnid.'|'.$key;
				$hash = hash("sha512", $retHashSeq);
			    if($hash != $posted_hash) 
			    {
				   $hash_validated = FALSE;
				}
				
				$payment_status = "";
				$payment_id = "";
				$transaction_no = "";
				$today = date("Y-m-d");
				$response_count = 0;
				/*echo "hello";
				die();*/
				$this->db->select('A.appl_no,B.reg_user_id,B.applied_program,A.transaction_number,C.amount');
				$this->db->from('applicant_form_online_deposit A');
				$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no','LEFT');
				$this->db->join('applicant_form_fee_overview C','A.appl_no = C.appl_no','LEFT');
				$this->db->where('A.order_number',$pg_order_number);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$program_code = $row['applied_program'];
					$reg_user_id = $row['reg_user_id'];
					$application_no = $row['appl_no'];
					$amount_to_be_paid = $row['amount'];
					$order_number = $pg_order_number;
					$transaction_number = $row['transaction_number'];
		        }
				$this->db->select("count(*) as response_count");
				$this->db->from('applicant_form_online_deposit');
				$this->db->where('transaction_number',$mihpayid);
				
				$result = $this->db->get();
				$output_count = $result->result_array();
				foreach($output_count as $row)
				{
					$response_count = $row['response_count'];
				}
				$this->db->select("program_name"); 	
				$this->db->from("program_master"); 	
				$this->db->where('program_code ',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				//echo $this->db->last_query();
				foreach($output_data as $row)
				{
					$program_name = $row['program_name'];
				}
				/*$write_file = fopen("pg_log/response_log_".date("d-m-Y").".txt", "a+");
				fputs($write_file, date("Y-m-d H:i:s").'|'.$institute_code.'|'.$response_log.'| CALCULATED HASH = '.$hash.' | POSTED HASH = '.$posted_hash."\n");
				fclose($write_file);*/
				$request_count = 0;
				$this->db->select("count(*) as request_count");
				$this->db->from('applicant_form_online_deposit');
				$this->db->where('order_number',$pg_order_number);
				$this->db->where('deposit_status','INITIATED');
				$result = $this->db->get();
				$output_count_req = $result->result_array();
				foreach($output_count_req as $row)
				{
					$request_count = $row['request_count'];
				}
				if($response_count == 0)
				{
					if($request_count == 1 )
					{
						if($hash_validated == '1' && $txnid == $order_number && number_format($amount_to_be_paid,2) == number_format($amount_paid,2)) //VALID RESPONSE
						{
							$pg_log = $response_log;
							$amount_paid = $amount_paid;
							$track_id = $mihpayid;
							$payment_id = $mihpayid;
							$txn_status = $status; //success, failure, pending
							$payment_status = $status; //success, failure, pending
							$txn_dt = date("d-m-Y H:i:s");	
							
							if($txn_status == 'success')
							{
								//1. generate index number
								$result =  $this->db->query("SELECT GET_LOCK('lockindexnumber',5) AS locked");
								//$res = $this->db->get();
				                $query = $result->result_array();
				                foreach ($query as $row) 
				                {
				                   	$locked = $row['locked'];
				                }
				                if($locked == 1)
								{
									$this->db->select('A.program_code,A.year,sequence_code,sequence_no');
									$this->db->from('index_sequence_setup A');
									$this->db->where('A.program_code',$program_code);
									$result = $this->db->get();
									$output_data = $result->result_array();
									foreach ($output_data as $row1) 
							        {
							        	$year = $row1['year'];
										$year_str = substr($year,'-2');
										$sequence_no = $row1['sequence_no'];
										$key = $row1['sequence_code'];
							        }
									
									if($sequence_no < 10)
										$changed_sl_no = '00'.$sequence_no;
									else if($sequence_no < 100)
										$changed_sl_no = '0'.$sequence_no;
									else
										$changed_sl_no = $sequence_no;
										
									$index_no = $year_str.'/'.$key.'/'.$changed_sl_no;
									
									$new_seq_no = $sequence_no + 1;
									
									$applicant_appl_overview = array(
										'sequence_no' => $new_seq_no
									);
									$this->db->where('program_code',$program_code);
									$regUpdate = $this->db->update('index_sequence_setup',$applicant_appl_overview);
									if(!$regUpdate){
										$dbStatus = FALSE;
									}
									$this->db->select('index_no');
									$this->db->from('applicant_appl_overview');
									$this->db->where('index_no',$index_no);
									$this->db->where('applied_program',$program_code);
									$result = $this->db->get();
									$output_data = $result->result_array();
									$idx_found = '';
									foreach ($output_data as $row) 
							        {
							        	$idx_found = 1;
							        }
							        if($idx_found == '')
							        {
										$applicant_appl_overview = array(
											'index_no' => $index_no,
											'updated_by' => $reg_user_id,
											'updated_on' => $date_time
										);
										$this->db->where('appl_no',$application_no);
										$regUpdate = $this->db->update('applicant_appl_overview',$applicant_appl_overview);
									}
									
								}

								$result =  $this->db->query("SELECT RELEASE_LOCK('lockindexnumber')");
								
								//3. update payment table
								
								
								//2. BEGIN TRANS
								$this->db->trans_start();
								$applicant_form_fee_overview = array(
									'depositdate' => $date_time,
									'money_receipt_no' => $payment_id,
									'modified_by' => $reg_user_id,
									'modified_on' => $date_time
								);
								$this->db->where('appl_no',$application_no);
								$regUpdate = $this->db->update('applicant_form_fee_overview',$applicant_form_fee_overview);
								if(!$regUpdate){
									$dbStatus = FALSE;
								}
								else
								{
									$applicant_form_online_deposit = array(
										'sub_category' => '',
										'depositdate' => $date_time,
										'deposit_status' => $payment_status,
										'response_datetime' => $date_time,
										'transaction_number' => $payment_id,
										'updated_by' => $reg_user_id,
										'updated_on' => $date_time,
										'serverside_responce'=>$response_log
									);
									$this->db->where('order_number',$order_number);
									$regUpdate = $this->db->update('applicant_form_online_deposit',$applicant_form_online_deposit);
									if(!$regUpdate){
										$dbStatus = FALSE;
									}
									else
									{
										$applicant_appl_overview = array(
											'appl_status' => 'Verified',
											'updated_by' => $reg_user_id,
											'updated_on' => $date_time
										);
										$this->db->where('appl_no',$application_no);
										$regUpdate = $this->db->update('applicant_appl_overview',$applicant_appl_overview);
										if(!$regUpdate){
											$dbStatus = FALSE;
										}
										
										$new_data = array(
											'id' 					=>NULL,
											'reg_user_id' 			=>$reg_user_id,
											'appl_no' 				=>$application_no,
											'form_no' 				=>$application_no,
											'applied_program' 		=>$program_code,
											'appl_status' 			=>'Verified',
											'created_by'			=>$reg_user_id,
											'created_on'			=>$date
										);
										
										
										$sql = $this->db->insert('applicant_appl_overview_history', $new_data);
										//echo $this->db->last_query();
										if(!$sql){
											$dbStatus = "FALSE";
											$dbMessage = "Error Inserting";
											$this->db->trans_rollback();
											//$dbError = ;	
										}
										else
										{
											$this->db->trans_complete();
											//$objMpdf = new Mpdf_controller();
											//5. COMMIt/ROLLBACK
											$controllerInstance = & get_instance();
											$return = $controllerInstance->$print_function();
											if($return == true)
											{
												if(file_exists(DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$program_code.'/'.$application_no.'/application_print.pdf'))
												{
													$this->db->select("program_name"); 	
													$this->db->from("program_master"); 	
													$this->db->where('program_code ',$program_code);
													$result = $this->db->get();
													$output_data = $result->result_array();
													//echo $this->db->last_query();
													foreach($output_data as $row)
													{
														$program_name = $row['program_name'];
													}
													$pro_code = 'PROG_'.$ins_code;
													$this->db->select("email_id,first_name,mid_name,last_name"); 	
													$this->db->from("applicant_reg_master"); 	
													$this->db->where('reg_user_id ',$reg_user_id);
													$this->db->where('applied_program',$pro_code);
													$result = $this->db->get();
													$output_data = $result->result_array();
													//echo $this->db->last_query();
													foreach($output_data as $row)
													{
														$email = $row['email_id'];
														$first_name = $row['first_name'];
														$mid_name = $row['mid_name'];
														$last_name = $row['last_name'];
													}
													$name = $first_name.' '.$mid_name.' '.$last_name;
													
													
													
													
													
													$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
													$this->db->from('sms_provider_setup A');
													$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
													$this->db->where('B.record_status','1');
													$this->db->where('A.record_status','1');
													$this->db->where('B.sms_type','SUBMISSION OF APPLICATION');
													$this->db->where('B.status','ACTIVE');
													$result = $this->db->get();
													
													$output_data = $result->result_array();
													foreach ($output_data as $row1) 
													{
														$sms_url = $row1['sms_url'];
														$user_name = $row1['user_name'];
														$password = addslashes($row1['password']);
														$sender = $row1['sender'];
														$content = $row1['content'];
														//$program = $row1['program_name'];
														//$institute_name = $row1['institute_name'];
														$find = array("[mobile_no]", "[subject]");
														$replace = array($phone_no, $content);
														$new_sms_url = str_replace($find, $replace, $sms_url);//find and replace uid and pwd in url
														
														$findappl = array("[program_code]");
														$replaceappl = array($program_name);
														//echo $content."<br>";
														$new_content = str_replace($findappl, $replaceappl, $content);
														$messageToSend = rawurlencode($new_content);
														//echo $new_sms_url."<br>";
														//echo $new_content."<br>";
														//echo $messageToSend;
														
														//find replace url with mobileno and message
														$findmobileNo = array("[mobile_no]","[subject]");
														$replacemobileNo = array($reg_user_id,$messageToSend);
														$smsURL = str_replace($findmobileNo,$replacemobileNo,$sms_url);	
													}
													$ch = curl_init($smsURL );
													curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
													$result = curl_exec($ch);
													curl_close($ch);
													
													
													$print = 1;
													$array['print'] = 1;
													$array['payment_id'] = $payment_id;
													$array['payment_status'] = $payment_status;
													$array['program_code'] = $program_code;
													$array['program_name'] = $program_name;
													$array['file_name'] = $file_name;
															return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
													//$print = 1;
													return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
												}
												else
												{
													return array('status' => $dbStatus, 'msg' => $dbMessage);
												}
											}
											else
											{
												
												return array('status' => $dbStatus, 'msg' => $dbMessage);
											}
										}
									}
									
								}
							}
							else if($txn_status == 'failure')
							{
								$array['print'] = 0;
								$array['payment_id'] = '';
								$array['payment_status'] = 'FAILURE';
								$array['program_code'] = $program_code;
								$array['program_name'] = $program_name;
								$array['file_name'] = '';
								return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
							}
							else
							{
								$array['print'] = 0;
								$array['payment_id'] = '';
								$array['payment_status'] = 'FAILURE';
								$array['program_code'] = $program_code;
								$array['program_name'] = $program_name;
								$array['file_name'] = '';
								return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
							}
						}
						else
						{
							$payment_status = "INVALID RESPONSE";
						}
					}
					else
					{
						$payment_status = "INVALID RESPONSE";
					}
				}
				else
				{
					$print = 1;
					$array['print'] = 1;
					$array['payment_id'] = $payment_id;
					$array['payment_status'] = $payment_status;
					$array['program_code'] = $program_code;
					$array['program_name'] = $program_name;
					$array['file_name'] = $file_name;
					return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
				}
				//echo $order_id;
			break;
			case 'process_payment_quikfee':
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$order_number = $this->session->userdata('order_number');
				$amount = $this->session->userdata('app_fee');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$strCurDate = date('d-m-Y');
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$parsedUrl = parse_url($url);
				
				$host = $parsedUrl['host'];
        		
        		$this->db->select('institute_code');
				$this->db->from('program_master');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$institute_code = $row['institute_code'];
		        }
		        $this->session->set_userdata('institute_code', $institute_code);
		        
		       
		        $pg_action_url = 'https://www.quikfee.com/PaymentStart?encData=';
		        
		        
		        $this->db->select('pg_parameter_code, pg_parameter_value');
				$this->db->from('pg_parameter_values');
				$this->db->where('pg_code','QUIKFEE');
				$this->db->where('school_code',$institute_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$pg_parameter_values[$row['pg_parameter_code']] = $row['pg_parameter_value'];
		        }
		        $client_id = $pg_parameter_values['CLIENTID'];
				$currency_code = $pg_parameter_values['CURRENCYCODE'];
				$response_url = $pg_parameter_values['RESPONSEURL'];
        		$this->db->select("T1.full_name,T1.first_name,T2.program_name,T2.program_code");
				$this->db->from('applicant_master T1');
				$this->db->join('program_master T2','T1.applied_program = T2.program_code','LEFT');
				$this->db->where('T1.reg_user_id',$reg_user_id);
				$this->db->where('T1.applied_program',$program_code);
				$this->db->where('T1.status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$full_name = $row['full_name'];
					$first_name = $row['first_name'];
					$program_name = $row['program_name'];
					$program_code = $row['program_code'];
		        }
		        
        		$full_name_size=strlen($full_name);
        		
        		$order_id = $order_number;        //your script should substitute the order description here in the quotes provided here
				if($full_name_size>=50){
					$billing_cust_name = $first_name;
					}         
				else{
					$billing_cust_name = $full_name;
				}
				$this->db->select("T1.email_id");
				$this->db->from('applicant_reg_master T1');
				$this->db->where('T1.reg_user_id',$reg_user_id);
				$this->db->where('T1.applied_program',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$applicant_email_id = $row['email_id'];
		        }
				$this->db->select("address_1,city_name,post_office,dm.district_name,sm.state_name,pin,applicant_address.district_code,applicant_address.state_code");
				$this->db->from('applicant_address');
				$this->db->join('applicant_master appmas','applicant_address.address_ref_id=appmas.perm_address_ref_id ','LEFT');
				$this->db->join('applicant_appl_overview applov','applov.reg_user_id=appmas.reg_user_id','LEFT');
				$this->db->join('district_master dm','dm.district_code=applicant_address.district_code','LEFT');
				$this->db->join('state_master sm','sm.state_code=applicant_address.state_code','LEFT');
				$this->db->where('applov.reg_user_id',$reg_user_id);
				$this->db->where('applov.applied_program',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$permanentaddr1 = $row['address_1'];
					$permanentaddr2 = $row['city_name'];
					$permanentpostoffice = $row['post_office'];
					$permanentdistrictcode = $row['district_name'];
					$permanentstatecode = $row['state_name'];
					$permanentpin = $row['pin'];
					$chkpermanentotherdistrict = $row['district_code'];
					$chkpermanentotherstate = $row['state_code'];
		        }
		        $billing_cust_address = $permanentaddr1;
				$billing_cust_country = 'IN';
				//$billing_cust_state = $permanentstatecode;
				$billing_city = $permanentaddr2;
				$billing_zip = $permanentpin;
				$billing_cust_tel = $reg_user_id;
				//$billing_cust_email = 'escap@stlindia.com';
				if($full_name_size>=50){
					$delivery_cust_name = $first_name;
				}         
				else{
					$delivery_cust_name = $full_name;
				}
				$delivery_cust_address = $permanentaddr1;
				$delivery_cust_country = 'IN';
				$delivery_cust_state = $permanentstatecode;
				$delivery_city = $permanentaddr2;
				$delivery_zip = $permanentpin;
				$delivery_cust_tel = $reg_user_id;

		        $this->db->select("T1.full_name,T1.first_name,T2.program_name,T2.program_code");
				$this->db->from('applicant_master T1');
				$this->db->join('program_master T2','T1.applied_program = T2.program_code','LEFT');
				$this->db->where('T1.reg_user_id',$reg_user_id);
				$this->db->where('T1.applied_program',$program_code);
				$this->db->where('T1.status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$full_name = $row['full_name'];
					$first_name = $row['first_name'];
					$program_name = $row['program_name'];
					$program_code = $row['program_code'];
		        }
		        
        		$full_name_size=strlen($full_name);

				$amount = $_SESSION['app_fee'];            // your script should substitute the amount here in the quotes provided here
				//$amount = 1;            // your script should substitute the amount here in the quotes provided here
				$order_id = $order_number;        //your script should substitute the order description here in the quotes provided here
				//$order_id ="1";        //your script should substitute the order description here in the quotes provided here
				if($full_name_size>=50){
					$billing_cust_name = $first_name;
					}         
				else{
					$billing_cust_name = $full_name;
				}


				$register_mobile_no = $reg_user_id;
				$student_id = $reg_user_id;

				//get father and mother name
				
				$fathers_name = "NA";
				$mothers_name = "NA";
				

				$full_name_size = strlen($full_name);

				$order_id = $order_number;        //your script should substitute the order description here in the quotes provided here
				if($full_name_size>=50){
					$applicant_name = $first_name;
				}         
				else{
					$applicant_name = $full_name;
				}
				$applicant_address = $permanentaddr1;
				$applicant_city = strlen($permanentaddr2) > 31 ? substr($permanentaddr2,0,31): $permanentaddr2;
				$billing_zip = $permanentpin;
				$applicant_mobile = $register_mobile_no;
				$applicant_email = $applicant_email_id;
				$applicant_id = $student_id;
				$applicant_father = $fathers_name;
				$applicant_mother = $mothers_name;
				$return_url = $response_url;

				$plain_data = "$amount|$applicant_id|$applicant_address|$applicant_city|$applicant_email|$applicant_name|$applicant_mobile|$applicant_father|$applicant_mother|$return_url|$client_id|$order_id";
				//die();
				$enc_date = base64_encode($plain_data);
				$ACTION_URL = $pg_action_url.$enc_date;
				$array['action_url']=$ACTION_URL;
				return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
			break;
			case 'process_payment_csc':
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$order_number = $this->session->userdata('order_number');
				$amount = $this->session->userdata('app_fee');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$strCurDate = date('d-m-Y');
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$parsedUrl = parse_url($url);
				
				$host = $parsedUrl['host'];
        		
        		$this->db->select('institute_code');
				$this->db->from('program_master');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$institute_code = $row['institute_code'];
		        }
		        $this->session->set_userdata('institute_code', $institute_code);
		        
		       
		        $pg_action_url = 'https://payuat.csccloud.in/v1/payment/';
		               
				
				$bconn = new BridgePGUtil();
				$digit = 24;
				$seed = str_split('98789OPQRSXTUVWXYZABABCDXEFGHIJKLMXNCDXEXXFGHXIJKLMN'.'ABCDX879EFGXHIJKLMNABCXXDEXFGXHIJXXKLMNO9871PQRSTUVWXYZ'.'0123456789'); // and any other characters
				shuffle($seed); // probably optional since array_is randomized; this may be redundant
				$uniqCode = ''; 
				foreach (array_rand($seed, $digit) as $k) 
					$uniqCode .= $seed[$k];
				$UrlRoot = "http://eapp.stlindia.com/staging2/cipet/payment/";
				$pay_success_url = $UrlRoot.'postpayment_success_csc';
				$pay_cancel_url  = $UrlRoot.'postpayment_cancel_csc';

				$p = array(
					'csc_id' => $_SESSION['csc_username'],
					'merchant_id' => '28742',
					'merchant_receipt_no' =>  $order_number,
					'txn_amount' =>$amount,
					'return_url' => $pay_success_url,
					'cancel_url' => $pay_cancel_url,
					'product_id' =>'2874267172',
					'merchant_txn_date_time'=>date('Y-m-d H:i:s'),
					'merchant_txn' =>   $order_number
				);
				$bconn->set_params($p);
				$enc_text = $bconn->get_parameter_string(); 
				$frac = $bconn->get_fraction();	
		        
		        
		        $this->db->select('pg_parameter_code, pg_parameter_value');
				$this->db->from('pg_parameter_values');
				$this->db->where('pg_code','CSC');
				$this->db->where('school_code',$institute_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$pg_parameter_values[$row['pg_parameter_code']] = $row['pg_parameter_value'];
		        }
		        $client_id = $pg_parameter_values['MERCHANT_ID'];
				
        		$this->db->select("T1.full_name,T1.first_name,T2.program_name,T2.program_code");
				$this->db->from('applicant_master T1');
				$this->db->join('program_master T2','T1.applied_program = T2.program_code','LEFT');
				$this->db->where('T1.reg_user_id',$reg_user_id);
				$this->db->where('T1.applied_program',$program_code);
				$this->db->where('T1.status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$full_name = $row['full_name'];
					$first_name = $row['first_name'];
					$program_name = $row['program_name'];
					$program_code = $row['program_code'];
		        }
		        
        		$full_name_size=strlen($full_name);
        		
        		$order_id = $order_number;        //your script should substitute the order description here in the quotes provided here
				if($full_name_size>=50){
					$billing_cust_name = $first_name;
					}         
				else{
					$billing_cust_name = $full_name;
				}
				$this->db->select("T1.email_id");
				$this->db->from('applicant_reg_master T1');
				$this->db->where('T1.reg_user_id',$reg_user_id);
				$this->db->where('T1.applied_program',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$applicant_email_id = $row['email_id'];
		        }
				$this->db->select("address_1,city_name,post_office,dm.district_name,sm.state_name,pin,applicant_address.district_code,applicant_address.state_code");
				$this->db->from('applicant_address');
				$this->db->join('applicant_master appmas','applicant_address.address_ref_id=appmas.perm_address_ref_id ','LEFT');
				$this->db->join('applicant_appl_overview applov','applov.reg_user_id=appmas.reg_user_id','LEFT');
				$this->db->join('district_master dm','dm.district_code=applicant_address.district_code','LEFT');
				$this->db->join('state_master sm','sm.state_code=applicant_address.state_code','LEFT');
				$this->db->where('applov.reg_user_id',$reg_user_id);
				$this->db->where('applov.applied_program',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$permanentaddr1 = $row['address_1'];
					$permanentaddr2 = $row['city_name'];
					$permanentpostoffice = $row['post_office'];
					$permanentdistrictcode = $row['district_name'];
					$permanentstatecode = $row['state_name'];
					$permanentpin = $row['pin'];
					$chkpermanentotherdistrict = $row['district_code'];
					$chkpermanentotherstate = $row['state_code'];
		        }
		        $billing_cust_address = $permanentaddr1;
				$billing_cust_country = 'IN';
				//$billing_cust_state = $permanentstatecode;
				$billing_city = $permanentaddr2;
				$billing_zip = $permanentpin;
				$billing_cust_tel = $reg_user_id;
				//$billing_cust_email = 'escap@stlindia.com';
				if($full_name_size>=50){
					$delivery_cust_name = $first_name;
				}         
				else{
					$delivery_cust_name = $full_name;
				}
				$delivery_cust_address = $permanentaddr1;
				$delivery_cust_country = 'IN';
				$delivery_cust_state = $permanentstatecode;
				$delivery_city = $permanentaddr2;
				$delivery_zip = $permanentpin;
				$delivery_cust_tel = $reg_user_id;

		        $this->db->select("T1.full_name,T1.first_name,T2.program_name,T2.program_code");
				$this->db->from('applicant_master T1');
				$this->db->join('program_master T2','T1.applied_program = T2.program_code','LEFT');
				$this->db->where('T1.reg_user_id',$reg_user_id);
				$this->db->where('T1.applied_program',$program_code);
				$this->db->where('T1.status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$full_name = $row['full_name'];
					$first_name = $row['first_name'];
					$program_name = $row['program_name'];
					$program_code = $row['program_code'];
		        }
		        
        		$full_name_size=strlen($full_name);

				$amount = $_SESSION['app_fee'];            // your script should substitute the amount here in the quotes provided here
				//$amount = 1;            // your script should substitute the amount here in the quotes provided here
				$order_id = $order_number;        //your script should substitute the order description here in the quotes provided here
				//$order_id ="1";        //your script should substitute the order description here in the quotes provided here
				if($full_name_size>=50){
					$billing_cust_name = $first_name;
					}         
				else{
					$billing_cust_name = $full_name;
				}
				$register_mobile_no = $reg_user_id;
				$student_id = $reg_user_id;

				//get father and mother name
				
				$fathers_name = "NA";
				$mothers_name = "NA";
				

				$full_name_size = strlen($full_name);

				$order_id = $order_number;        //your script should substitute the order description here in the quotes provided here
				if($full_name_size>=50){
					$applicant_name = $first_name;
				}         
				else{
					$applicant_name = $full_name;
				}
				$applicant_address = $permanentaddr1;
				$applicant_city = strlen($permanentaddr2) > 31 ? substr($permanentaddr2,0,31): $permanentaddr2;
				$billing_zip = $permanentpin;
				$applicant_mobile = $register_mobile_no;
				$applicant_email = $applicant_email_id;
				$applicant_id = $student_id;
				$applicant_father = $fathers_name;
				$applicant_mother = $mothers_name;
				
				$ACTION_URL = $pg_action_url.$frac;
				$array['action_url'] = $ACTION_URL;
				$array['enc_text'] = $enc_text;
				return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
			break;
			case 'get_post_payment_data_csc':
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$order_number = $this->session->userdata('order_number');
				$amount = $this->session->userdata('app_fee');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date('Y-m-d H:i:s', now());
        		//$strCurDate = date('d-m-Y');
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$this->db->select('A.institute_code,B.institute_name,logo_url,A.program_name');
				$this->db->from('program_master A');
				$this->db->join('institute_master B','A.institute_code = B.institute_code','INNER');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$ins_name = $row['institute_name'];
		        	$program_name = $row['program_name'];
					$ins_code = $row['institute_code'];
					$institute_logo = $row['logo_url'];
					$institute_logo = "../build/images/logo/".$institute_logo;
		        }
		        $hex_ins_code =  encrypt_decrypt('encrypt', $ins_code);
		        $applshow=0;
				$show=0;
				$print=0;
				$noamount=0;
				$showChallanInfo=0;
				$edit="false";
				$editappl="false";
		        
				$this->db->select('pg_parameter_code, pg_parameter_value');
				$this->db->from('pg_parameter_values');
				$this->db->where('pg_code','CSC');
				$this->db->where('school_code',$ins_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				
				$bconn = new BridgePGUtil();
				$bridge_message = $bconn->get_bridge_message();
				$data_array = $bconn->decrypt_message($bridge_message);
				
				$csc_txn 		 = $data_array['csc_txn']; 
				$merchant_id 	 = $data_array['merchant_id']; 
				$csc_id		 = $data_array['csc_id']; 
				$merchant_txn	 = $data_array['merchant_txn']; 
				$txn_status	 = $data_array['txn_status']; 
				$txn_date_time  = $data_array['merchant_txn_date_time']; 
				$product_id	 = $data_array['product_id']; 
				$txn_amount	 = $data_array['txn_amount']; 
				$receipt_no 	 = $data_array['merchant_receipt_no']; 
				$txtstatus_message = $data_array['txn_status_message']; 
				$status_message 	= $data_array['status_message']; 
				$payment_data_all  = json_encode($data_array,true); 
				$order_number = $merchant_txn;
				
				
				$payment_status = $txn_status;
				$payment_id = $csc_txn;
				$amount = $txn_amount;
				$fee_amount = $txn_amount;
				$transaction_id = $csc_txn;
				if($txn_status == '100' && $txtstatus_message == 'Success')
					$payment_status_id = 'SUCCESS';
				else
					$payment_status_id = 'FAILURE';
				
				//die();
				if(isset($data))
				{
					
					if($payment_status_id == 'SUCCESS')
					{
						$payment_status = "SUCCESS";
						$payment_id = $transaction_id;
			
						$this->db->select('A.appl_no,B.reg_user_id,B.applied_program');
						$this->db->from('applicant_form_online_deposit A');
						$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no','INNER');
						$this->db->where('A.order_number',$order_number);
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach ($output_data as $row) 
				        {
				        	$appl_no = $row['appl_no'];
							$reg_user_id = $row['reg_user_id'];
							$applied_progam = $row['applied_program'];
							$program_code = $row['applied_program'];
				        }
				        
				        
				        $this->db->select("reg_mode,email_id,last_grade,pin");
						$this->db->from('applicant_reg_master A');
						$this->db->join('applicant_master B','A.reg_user_id = B.reg_user_id AND A.applied_program =  B.applied_program','INNER');
						$this->db->where('A.reg_user_id',$reg_user_id);
						$this->db->where('A.applied_program',$program_code);
						$result = $this->db->get();
						//echo $this->db->last_query();
						$output_data = $result->result_array();
						$output = array("aaData" => array());
						foreach ($output_data as $row4) 
			            {
			            	$dbstatus = TRUE;
							//$Email = $row4['email_id'];
							//$pass_status = $row4['last_grade'];
							$pin = $row4['pin'];
			            }
			
				        $this->db->select('A.template_code,B.template_name,file_name');
						$this->db->from('program_master A');
						$this->db->join('form_template_master B','A.template_code = B.template_code','INNER');
						$this->db->where('A.program_code',$program_code);
						$result = $this->db->get();
						
						$output_data = $result->result_array();
						foreach ($output_data as $row) 
				        {
				        	$temp_code = $row['template_code'];
							$temp_name = explode(".",$row['file_name']);
							$file_name = $temp_name[0]."pdf.php";
							$print_function = $temp_name[0]."pdf";
				        }
	        
				        $this->db->select('appl_status');
						$this->db->from('applicant_appl_overview');
						$this->db->where('reg_user_id',$reg_user_id);
						$this->db->where('applied_program',$program_code);
						$this->db->where('STATUS','1');
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach ($output_data as $row) 
				        {
				        	$appl_status = $row['appl_status'];
				        }
						if($payment_status_id == 'SUCCESS')
						{
							
							$payment_id = $payment_id;
							
							$this->db->trans_start();
							$applicant_form_fee_overview = array(
								'depositdate' => $date,
								'money_receipt_no' => $payment_id,
								'modified_by' => $reg_user_id,
								'modified_on' => $date
							);
							$this->db->where('appl_no',$application_no);
							$regUpdate = $this->db->update('applicant_form_fee_overview',$applicant_form_fee_overview);
							if(!$regUpdate){
								$dbStatus = FALSE;
							}
							else
							{
								$applicant_form_online_deposit = array(
									'sub_category' => $_SESSION['csc_username'],
									'depositdate' => $date,
									'deposit_status' => $payment_status,
									'response_datetime' => $date,
									'transaction_number' => $payment_id,
									'updated_by' => $reg_user_id,
									'updated_on' => $date
								);
								$this->db->where('order_number',$order_number);
								$regUpdate = $this->db->update('applicant_form_online_deposit',$applicant_form_online_deposit);
								if(!$regUpdate){
									$dbStatus = FALSE;
								}
								else
								{
									$applicant_appl_overview = array(
										'appl_status' => 'Verified',
										'updated_by' => $reg_user_id,
										'updated_on' => $now
									);
									$this->db->where('appl_no',$application_no);
									$regUpdate = $this->db->update('applicant_appl_overview',$applicant_appl_overview);
									if(!$regUpdate){
										$dbStatus = FALSE;
									}
									
									$new_data = array(
										'id' 					=>NULL,
										'reg_user_id' 			=>$reg_user_id,
										'appl_no' 				=>$application_no,
										'form_no' 				=>$application_no,
										'applied_program' 		=>$program_code,
										'appl_status' 			=>'Verified',
										'created_by'			=>$reg_user_id,
										'created_on'			=>$date
									);
									
									
									$sql = $this->db->insert('applicant_appl_overview_history', $new_data);
									//echo $this->db->last_query();
									if(!$sql){
										$dbStatus = "FALSE";
										$dbMessage = "Error Inserting";
										//$dbError = ;	
									}
									$this->db->select('index_no');
									$this->db->from('applicant_appl_overview');
									$this->db->where('appl_no',$application_no);
									$result = $this->db->get();
									$output_data = $result->result_array();
									foreach ($output_data as $row) 
							        {
							        	$index_no = $row['index_no'];
							        }
							        if($index_no == '')
									{
										$this->db->select('A.program_code,A.year,sequence_code,sequence_no');
										$this->db->from('index_sequence_setup A');
										$this->db->where('A.program_code',$program_code);
										$result = $this->db->get();
										$output_data = $result->result_array();
										foreach ($output_data as $row1) 
								        {
								        	$year = $row1['year'];
											$year_str = substr($year,'-2');
											$sequence_no = $row1['sequence_no'];
											$key = $row1['sequence_code'];
								        }
										
										if($sequence_no < 10)
											$changed_sl_no = '00'.$sequence_no;
										else if($sequence_no < 100)
											$changed_sl_no = '0'.$sequence_no;
										else
											$changed_sl_no = $sequence_no;
											
										$index_no = $year_str.'/'.$key.'/'.$changed_sl_no;
									}
									$applicant_appl_overview = array(
										'appl_status' => 'Verified',
										'index_no' => $index_no,
										'updated_by' => $reg_user_id,
										'updated_on' => $now
									);
									$this->db->where('appl_no',$application_no);
									$regUpdate = $this->db->update('applicant_appl_overview',$applicant_appl_overview);
									if(!$regUpdate){
										$dbStatus = FALSE;
									}
									else
									{
										
										$controllerInstance = & get_instance();
    									$return = $controllerInstance->$print_function();
										if($return == true)
										{
											if(file_exists(DOCUMENT_UPLOAD_URL.'/'.$program_code.'/'.$application_no.'/application_print_008.pdf'))
											{
												$new_seq_no = $sequence_no + 1;
												if($index == '')
												{
													$applicant_appl_overview = array(
														'sequence_no' => $new_seq_no
													);
													$this->db->where('program_code',$program_code);
													$regUpdate = $this->db->update('index_sequence_setup',$applicant_appl_overview);
													if(!$regUpdate){
														$dbStatus = FALSE;
													}
												}
												$this->db->select("program_name"); 	
												$this->db->from("program_master"); 	
												$this->db->where('program_code ',$program_code);
												$result = $this->db->get();
												$output_data = $result->result_array();
												//echo $this->db->last_query();
												foreach($output_data as $row)
												{
													$program_name = $row['program_name'];
												}
												
												$this->db->select("email_id,first_name,mid_name,last_name"); 	
												$this->db->from("applicant_reg_master"); 	
												$this->db->where('reg_user_id ',$reg_user_id);
												$result = $this->db->get();
												$output_data = $result->result_array();
												//echo $this->db->last_query();
												foreach($output_data as $row)
												{
													$email = $row['email_id'];
													$first_name = $row['first_name'];
													$mid_name = $row['mid_name'];
													$last_name = $row['last_name'];
												}
												$name = $first_name.' '.$mid_name.' '.$last_name;
												
												
												$this->db->select('host_name , port_no,email_id,password,smtp_auth,smtp_secure');
												$this->db->from('email_provider_setup');
												$this->db->where('record_status','1');
												$this->db->limit('1');
												$result = $this->db->get();
												$query = $result->result_array();
												
												$row_count = $result->num_rows();
												foreach($result->result_array() AS $row1)
												{
													$host_name = $row1['host_name'];
													$port_no = $row1['port_no'];
													$email_id = $row1['email_id'];
													$password = $row1['password'];
													$smtp_auth = $row1['smtp_auth'];
													$smtp_secure = $row1['smtp_secure'];
												}
												
												$this->db->select('es.email_type,es.subject,es.content');
												$this->db->from('email_setup es');
												$this->db->join('program_email_setup pes','es.email_type = pes.email_type','inner');
												$this->db->where('es.email_type','SUBMISSION');
												$this->db->where('pes.institute_code',HARDCODE_INSTITUTE_CODE);
												$this->db->limit('1');
												$result = $this->db->get();
												$query = $result->result_array();
												//echo $this->db->last_query();
												$row_count = $result->num_rows();
												foreach($result->result_array() AS $row1)
												{
													$email_type=$row1['email_type'];
													$subject=$row1['subject'];
													$content=$row1['content'];
												}
												$this->load->library('email');
													

												/*$body = "You have successfully Registered with mobile no as $phone_no and date of birth as $dob_mail for $admName program.";*/
												/*$txtSubject = "Registration Successful";*/
												
												//$find = array("[name]");
												//$replace = array($name);
												//$smsURL = str_replace($subject,$find,$replace);	
												
												$config['protocol']    = 'smtp';
												$config['smtp_host']    = 'ssl://smtp.gmail.com';
												$config['smtp_port']    = '465';
												$config['smtp_timeout'] = '10';
												$config['smtp_user']    = $email_id;
												$config['smtp_pass']    = $password;
												$config['charset']    = 'utf-8';
												$config['newline']    = "\r\n";
												$config['mailtype'] = 'html'; // or text
												$config['validation'] = TRUE; // bool whether to validate email or not   
												$this->email->initialize($config);
												$this->email->from($email_id, 'CIPET ADMISSION 2018');
												$this->email->to($email); 

												$this->email->subject($subject);
												
												$find = array("[name]", "[course_name]");
												$replace = array($name, $program_name);
												$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url

												$this->email->message($email_content);  

												//$this->email->send();
												//echo $this->email->print_debugger();;
												//print_r($this->email->send());
												//die();
												/*if($this->email->send()){
													$dbStatus = TRUE; 
													$dbMessage = 'A mail is forwarded to your registered mail id ';
												}
												else{
													$dbStatus = FALSE; 
													$dbMessage = 'Unable to sent Mail.Please Contact for Support';
													$this->email->print_debugger();
												}*/
												
												$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
												$this->db->from('sms_provider_setup A');
												$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
												$this->db->where('B.record_status','1');
												$this->db->where('A.record_status','1');
												$this->db->where('B.sms_type','SUBMISSION OF APPLICATION');
												$this->db->where('B.status','ACTIVE');
												$result = $this->db->get();
												/*ECHO $this->db->last_query();
												die();*/
												$output_data = $result->result_array();
												foreach ($output_data as $row1) 
												{
													$sms_url = $row1['sms_url'];
													$user_name = $row1['user_name'];
													$password = addslashes($row1['password']);
													$sender = $row1['sender'];
													$content = $row1['content'];
													//$program = $row1['program_name'];
													//$institute_name = $row1['institute_name'];
													$find = array("[mobile_no]", "[subject]");
													$replace = array($phone_no, $content);
													$new_sms_url = str_replace($find, $replace, $sms_url);//find and replace uid and pwd in url
													
													if($program_name == 'Diploma in Plastics Mould Technology (DPMT)')
													{
														$program = 'DPMT';
													}
													else if($program_name == 'Postgraduate Diploma in Plastics Processing & Testing (PGD-PPT)')
													{
														$program = 'PGD-PPT';
													}
													else if($program_name == 'Post Diploma in Plastics Mould Design with CAD&sol;CAM (PD-PMD with CAD / CAM)')
													{
														$program = 'PD-PMD with CAD / CAM';
													}
													else if($program_name == 'Diploma in Plastics Technology (DPT)')
													{
														$program = 'DPT';
													}
													else if($program_name == 'Postgraduate Diploma in Plastics Testing and Quality Control (PGD-PTQC)')
													{
														$program = 'PGD-PTQC';
													}
													
													$findappl = array("[program_code]");
													$replaceappl = array($program);
													//echo $content."<br>";
													$new_content = str_replace($findappl, $replaceappl, $content);
													$messageToSend = rawurlencode($new_content);
													//echo $new_sms_url."<br>";
													//echo $new_content."<br>";
													//echo $messageToSend;
													
													//find replace url with mobileno and message
													$findmobileNo = array("[mobile_no]","[subject]");
													$replacemobileNo = array($reg_user_id,$messageToSend);
													$smsURL = str_replace($findmobileNo,$replacemobileNo,$sms_url);	
												}
												if($pin !='71717'){
													$done = file_get_contents($smsURL);
												}
												
												
												$this->db->trans_complete();
												$print = 1;
												$array['print'] = 1;
												$array['payment_id'] = $payment_id;
												$array['payment_status'] = $payment_status;
												$array['program_code'] = $program_code;
												$array['program_name'] = $program_name;
												return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
											}
											else
											{
												$this->db->trans_rollback();
												return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => '');
											}
										}
										else
										{
											$this->db->trans_rollback();
											return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => '');
										}
									}
								}
								
							}
						}
					}
					
				}
				else
				{
					echo '<h1>Error!</h1>';
					echo '<p>Invalid response</p>';
					exit;
				}
			break;
			//=================Meeseva=====================
			case 'process_payment_meeseva':
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$order_number = $this->session->userdata('order_number');
				$amount = $this->session->userdata('app_fee');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$strCurDate = date('d-m-Y');
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		
        		$this->db->select('institute_code');
				$this->db->from('program_master');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$institute_code = $row['institute_code'];
		        }
		        $this->session->set_userdata('institute_code', $institute_code);
		        
        		$this->db->select("T1.full_name,T1.first_name,T2.program_name,T2.program_code");
				$this->db->from('applicant_master T1');
				$this->db->join('program_master T2','T1.applied_program = T2.program_code','LEFT');
				$this->db->where('T1.reg_user_id',$reg_user_id);
				$this->db->where('T1.applied_program',$program_code);
				$this->db->where('T1.status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$full_name = $row['full_name'];
					$first_name = $row['first_name'];
					$program_name = $row['program_name'];
					$program_code = $row['program_code'];
		        }
		        
        		$full_name_size=strlen($full_name);
        		
        		$order_id = $order_number;        //your script should substitute the order description here in the quotes provided here
				if($full_name_size>=50){
					$billing_cust_name = $first_name;
					}         
				else{
					$billing_cust_name = $full_name;
				}
				$this->db->select("T1.email_id");
				$this->db->from('applicant_reg_master T1');
				$this->db->where('T1.reg_user_id',$reg_user_id);
				$this->db->where('T1.applied_program',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$applicant_email_id = $row['email_id'];
		        }
				$this->db->select("address_1,city_name,post_office,dm.district_name,sm.state_name,pin,applicant_address.district_code,applicant_address.state_code");
				$this->db->from('applicant_address');
				$this->db->join('applicant_master appmas','applicant_address.address_ref_id=appmas.perm_address_ref_id ','LEFT');
				$this->db->join('applicant_appl_overview applov','applov.reg_user_id=appmas.reg_user_id','LEFT');
				$this->db->join('district_master dm','dm.district_code=applicant_address.district_code','LEFT');
				$this->db->join('state_master sm','sm.state_code=applicant_address.state_code','LEFT');
				$this->db->where('applov.reg_user_id',$reg_user_id);
				$this->db->where('applov.applied_program',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$permanentaddr1 = $row['address_1'];
					$permanentaddr2 = $row['city_name'];
					$permanentpostoffice = $row['post_office'];
					$permanentdistrictcode = $row['district_name'];
					$permanentstatecode = $row['state_name'];
					$permanentpin = $row['pin'];
					$chkpermanentotherdistrict = $row['district_code'];
					$chkpermanentotherstate = $row['state_code'];
		        }
		        $billing_cust_address = $permanentaddr1;
				$billing_cust_country = 'IN';
				$billing_city = $permanentaddr2;
				$billing_zip = $permanentpin;
				$billing_cust_tel = $reg_user_id;
				if($full_name_size>=50){
					$delivery_cust_name = $first_name;
				}         
				else{
					$delivery_cust_name = $full_name;
				}
				$delivery_cust_address = $permanentaddr1;
				$delivery_cust_country = 'IN';
				$delivery_cust_state = $permanentstatecode;
				$delivery_city = $permanentaddr2;
				$delivery_zip = $permanentpin;
				$delivery_cust_tel = $reg_user_id;

				
				$register_mobile_no = $reg_user_id;
				$student_id = $reg_user_id;

				//get father and mother name
				
				$fathers_name = "NA";
				$mothers_name = "NA";
				

				$applicant_address = $permanentaddr1;
				$applicant_city = strlen($permanentaddr2) > 31 ? substr($permanentaddr2,0,31): $permanentaddr2;
				$billing_zip = $permanentpin;
				$applicant_mobile = $register_mobile_no;
				$applicant_email = $applicant_email_id;
				$applicant_id = $student_id;
				$applicant_father = $fathers_name;
				$applicant_mother = $mothers_name;
				
				//API CALL
				$agcytype = $_SESSION['mee_agcytype'];
			    $centrecode = $_SESSION['mee_centrecode'];
			    $counter = $_SESSION['mee_counter'];
			    $cspname = $_SESSION['mee_cspname'];
			    $deptcode = $_SESSION['mee_deptcode'];
			    $distcode = $_SESSION['mee_distcode'];
			    $distreqid = $_SESSION['mee_distreqid'];
			    $francode = $_SESSION['mee_francode'];
			    $password = $_SESSION['mee_password'];
			    $servicecode = $_SESSION['mee_servicecode'];
			    $shiftcode = $_SESSION['mee_shiftcode'];
			    $staffCode = $_SESSION['mee_staffCode'];
			    $userId = $_SESSION['mee_userId'];
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
					$json = json_encode($xml);
					$responseArray = json_decode($json,true);
					
					$strRequestID = $responseArray['soapenvBody']['nsCheckUserAuthResponse']['nsreturn']['ax21strRequestId'];
					$strResCode = $responseArray['soapenvBody']['nsCheckUserAuthResponse']['nsreturn']['ax21strResCode'];
					$strResDesc = $responseArray['soapenvBody']['nsCheckUserAuthResponse']['nsreturn']['ax21strResDesc'];
					
					if($strResCode = '000')
					{
				        $array['strRequestId'] = $strRequestID;
				        $array['actionURL'] = "/staging2/cipet/payment/do_payment_meeseva/$institute";
						$dbStatus = TRUE;
					}
					else
					{
						$array['strRequestId'] = '';
						$dbStatus = FALSE;
						
					}	
					return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
			break;
			case 'do_payment_meeseva':
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$order_number = $this->session->userdata('order_number');
				$amount = $this->session->userdata('app_fee');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$strCurDate = date('d-m-Y');
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		
        		$this->db->select('institute_code');
				$this->db->from('program_master');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$institute_code = $row['institute_code'];
		        }
		        $this->session->set_userdata('institute_code', $institute_code);
		        
        		$this->db->select("T1.full_name,T1.first_name,T2.program_name,T2.program_code");
				$this->db->from('applicant_master T1');
				$this->db->join('program_master T2','T1.applied_program = T2.program_code','LEFT');
				$this->db->where('T1.reg_user_id',$reg_user_id);
				$this->db->where('T1.applied_program',$program_code);
				$this->db->where('T1.status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$full_name = $row['full_name'];
					$first_name = $row['first_name'];
					$program_name = $row['program_name'];
					$program_code = $row['program_code'];
		        }
		        
        		$full_name_size=strlen($full_name);
        		
        		$order_id = $order_number;        //your script should substitute the order description here in the quotes provided here
				if($full_name_size>=50){
					$billing_cust_name = $first_name;
					}         
				else{
					$billing_cust_name = $full_name;
				}
				$this->db->select("T1.email_id");
				$this->db->from('applicant_reg_master T1');
				$this->db->where('T1.reg_user_id',$reg_user_id);
				$this->db->where('T1.applied_program',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$applicant_email_id = $row['email_id'];
		        }
				$this->db->select("address_1,city_name,post_office,dm.district_name,sm.state_name,pin,applicant_address.district_code,applicant_address.state_code");
				$this->db->from('applicant_address');
				$this->db->join('applicant_master appmas','applicant_address.address_ref_id=appmas.perm_address_ref_id ','LEFT');
				$this->db->join('applicant_appl_overview applov','applov.reg_user_id=appmas.reg_user_id','LEFT');
				$this->db->join('district_master dm','dm.district_code=applicant_address.district_code','LEFT');
				$this->db->join('state_master sm','sm.state_code=applicant_address.state_code','LEFT');
				$this->db->where('applov.reg_user_id',$reg_user_id);
				$this->db->where('applov.applied_program',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$permanentaddr1 = $row['address_1'];
					$permanentaddr2 = $row['city_name'];
					$permanentpostoffice = $row['post_office'];
					$permanentdistrictcode = $row['district_name'];
					$permanentstatecode = $row['state_name'];
					$permanentpin = $row['pin'];
					$chkpermanentotherdistrict = $row['district_code'];
					$chkpermanentotherstate = $row['state_code'];
		        }
		        $billing_cust_address = $permanentaddr1;
				$billing_cust_country = 'IN';
				$billing_city = $permanentaddr2;
				$billing_zip = $permanentpin;
				$billing_cust_tel = $reg_user_id;
				if($full_name_size>=50){
					$delivery_cust_name = $first_name;
				}         
				else{
					$delivery_cust_name = $full_name;
				}
				$delivery_cust_address = $permanentaddr1;
				$delivery_cust_country = 'IN';
				$delivery_cust_state = $permanentstatecode;
				$delivery_city = $permanentaddr2;
				$delivery_zip = $permanentpin;
				$delivery_cust_tel = $reg_user_id;

				
				$register_mobile_no = $reg_user_id;
				$student_id = $reg_user_id;

				//get father and mother name
				
				$fathers_name = "NA";
				$mothers_name = "NA";
				

				$applicant_address = $permanentaddr1;
				$applicant_city = strlen($permanentaddr2) > 31 ? substr($permanentaddr2,0,31): $permanentaddr2;
				$billing_zip = $permanentpin;
				$applicant_mobile = $register_mobile_no;
				$applicant_email = $applicant_email_id;
				$applicant_id = $student_id;
				$applicant_father = $fathers_name;
				$applicant_mother = $mothers_name;
				
				//API CALL
				$strRequestID = $_POST['strRequestID'];
				$agcytype = $_SESSION['mee_agcytype'];
			    $centrecode = $_SESSION['mee_centrecode'];
			    $counter = $_SESSION['mee_counter'];
			    $cspname = $_SESSION['mee_cspname'];
			    $deptcode = $_SESSION['mee_deptcode'];
			    $distcode = $_SESSION['mee_distcode'];
			    $distreqid = $_SESSION['mee_distreqid'];
			    $francode = $_SESSION['mee_francode'];
			    $password = $_SESSION['mee_password'];
			    $servicecode = $_SESSION['mee_servicecode'];
			    $shiftcode = $_SESSION['mee_shiftcode'];
			    $staffCode = $_SESSION['mee_staffCode'];
			    $userId = $_SESSION['mee_userId'];
		        $soapUrl = "http://112.133.253.124:80/Paymentsapi/services/commonpg.commonpgHttpSoap12Endpoint/"; // asmx URL of WSDL
		        // xml post structure
		        $xml_post_string = "<soap:Envelope xmlns:soap=\"http://www.w3.org/2003/05/soap-envelope\" xmlns:com=\"http://commonpg.eseva.com\" xmlns:xsd=\"http://commonpg.eseva.com/xsd\">
									   <soap:Header/>
									   <soap:Body>
									      <com:PaymentConfirm>
									         <com:PayRequestBean>
									            <xsd:amount>$amount</xsd:amount>
									            <xsd:appRefNo>$order_number</xsd:appRefNo>
									            <xsd:password>$password</xsd:password>
									            <xsd:servicecode>$servicecode</xsd:servicecode>
									            <xsd:strApplName>CIPET</xsd:strApplName>
									            <xsd:strMobile>$applicant_mobile</xsd:strMobile>
									            <xsd:strRequestId>$strRequestID</xsd:strRequestId>
									            <xsd:userId>$userId</xsd:userId>
									         </com:PayRequestBean>
									      </com:PaymentConfirm>
									   </soap:Body>
									</soap:Envelope>";   // data from the form, e.g. some ID number

		           $headers = array(
		                        "Content-type: application/soap+xml;charset=\"utf-8\";action=\"urn:PaymentConfirm\"",
		                        "Accept: application/xml;charset=\"utf-8\"",
		                        "Accept-Encoding: gzip,deflate",
		                        "Cache-Control: no-cache",
		                        "Pragma: no-cache",
		                        "Content-length: ".strlen($xml_post_string),
		                        "Connection: Keep-Alive",
		                        "User-Agent: Apache-HttpClient/4.5.2 (Java/1.8.0_152)"
		                    ); 

		            $url = $soapUrl;

		            // PHP cURL  for https connection with auth
		            $ch = curl_init();
		            curl_setopt($ch, CURLOPT_URL, $url);
		            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		            curl_setopt($ch, CURLOPT_POST, true);
		            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
		            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		            try{
		            	$response = curl_exec($ch); 
					}
					catch(Exception $e)
					{
						echo $e->getMessage(); 
					}
		            curl_close($ch);
					if(isset($response))
					{
						$xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
						$xml = simplexml_load_string($xml);
						$json = json_encode($xml);
						$responseArray = json_decode($json,true);
						$strResCode = $responseArray['soapenvBody']['nsPaymentConfirmResponse']['nsreturn']['ax21strResCode'];
						$strResDesc = $responseArray['soapenvBody']['nsPaymentConfirmResponse']['nsreturn']['ax21strResDesc'];
						if($strResCode == '000')
						{
							$amount_paid = $responseArray['soapenvBody']['nsPaymentConfirmResponse']['nsreturn']['ax21amount'];
							$strTransno = $responseArray['soapenvBody']['nsPaymentConfirmResponse']['nsreturn']['ax21strTransno'];
							$ucamt = $responseArray['soapenvBody']['nsPaymentConfirmResponse']['nsreturn']['ax21ucamt'];	
							//post to payment/postpayment_success_meeseva
							echo '<form name="frmPayment"  method="post" action="/staging2/cipet/payment/postpayment_meeseva/'.$institute.'"><input type="hidden" name="pg_status" value="'.$strResCode.'"/><input type="hidden" name="pg_desc" value="'.$strResDesc.'"/><input type="hidden" name="pg_transaction_no" value="'.$strTransno.'"/><input type="hidden" name="pg_charges" value="'.$ucamt.'"/></form><script type="text/javascript">document.frmPayment.submit();</script>';
							
							
						}
						else
						{
							
			            	echo '<form name="frmPayment"  method="post" action="/staging2/cipet/payment/postpayment_meeseva/'.$institute.'"><input type="hidden" name="pg_status" value="'.$strResCode.'"/><input type="hidden" name="pg_desc" value="'.$strResDesc.'"/></form><script type="text/javascript">document.frmPayment.submit();</script>';
						}
					}
					else
					{
						redirect("/staging2/cipet/payment/postpayment_failure_meeseva/".$institute);
					}
			break;
			case 'get_post_payment_data_meeseva':
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$order_number = $this->session->userdata('order_number');
				$amount = $this->session->userdata('app_fee');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date('Y-m-d H:i:s', now());
        		//$strCurDate = date('d-m-Y');
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$this->db->select('A.institute_code,B.institute_name,logo_url,A.program_name');
				$this->db->from('program_master A');
				$this->db->join('institute_master B','A.institute_code = B.institute_code','INNER');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$ins_name = $row['institute_name'];
		        	$program_name = $row['program_name'];
					$ins_code = $row['institute_code'];
					$institute_logo = $row['logo_url'];
					$institute_logo = "../build/images/logo/".$institute_logo;
		        }
		        $hex_ins_code =  encrypt_decrypt('encrypt', $ins_code);
		        $applshow=0;
				$show=0;
				$print=0;
				$noamount=0;
				$showChallanInfo=0;
				$edit="false";
				$editappl="false";
		        
								
				$data_array 	 = $_POST;
				
				$txn_status 	 = $data_array['pg_status'];
				$txn_description 	 = $data_array['pg_desc'];
				
				$fee_amount = $amount;
				if($txn_status == '000')
					$payment_status_id = 'SUCCESS';
				else
					$payment_status_id = 'FAILURE';
				if(isset($data_array))
				{
					if($payment_status_id == 'SUCCESS')
					{
						$mee_txn 		 = $data_array['pg_transaction_no']; 
						$pg_charges		 = $data_array['pg_charges']; 
						$payment_id = $mee_txn;
						$transaction_id = $mee_txn;
						$payment_status = "SUCCESS";
						$payment_id = $transaction_id;
			
						$this->db->select('A.appl_no,B.reg_user_id,B.applied_program');
						$this->db->from('applicant_form_online_deposit A');
						$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no','INNER');
						$this->db->where('A.order_number',$order_number);
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach ($output_data as $row) 
				        {
				        	$appl_no = $row['appl_no'];
							$reg_user_id = $row['reg_user_id'];
							$applied_progam = $row['applied_program'];
							$program_code = $row['applied_program'];
				        }
			
				        $this->db->select('A.template_code,B.template_name,file_name');
						$this->db->from('program_master A');
						$this->db->join('form_template_master B','A.template_code = B.template_code','INNER');
						$this->db->where('A.program_code',$program_code);
						$result = $this->db->get();
						
						$output_data = $result->result_array();
						foreach ($output_data as $row) 
				        {
				        	$temp_code = $row['template_code'];
							$temp_name = explode(".",$row['file_name']);
							$file_name = $temp_name[0]."pdf.php";
							$print_function = $temp_name[0]."pdf";
				        }
	        
				        $this->db->select('appl_status');
						$this->db->from('applicant_appl_overview');
						$this->db->where('reg_user_id',$reg_user_id);
						$this->db->where('applied_program',$program_code);
						$this->db->where('STATUS','1');
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach ($output_data as $row) 
				        {
				        	$appl_status = $row['appl_status'];
				        }
						if($payment_status_id == 'SUCCESS')
						{
							
							$payment_id = $payment_id;
							
							$this->db->trans_start();
							$applicant_form_fee_overview = array(
								'depositdate' => $date,
								'money_receipt_no' => $payment_id,
								'modified_by' => $reg_user_id,
								'modified_on' => $date,
								'pg_charges' => $pg_charges
							);
							$this->db->where('appl_no',$application_no);
							$regUpdate = $this->db->update('applicant_form_fee_overview',$applicant_form_fee_overview);
							if(!$regUpdate){
								$dbStatus = FALSE;
							}
							else
							{
								$applicant_form_online_deposit = array(
									'sub_category' => $_SESSION['mee_centrecode'].'-'.$_SESSION['mee_staffCode'],
									'depositdate' => $date,
									'deposit_status' => $payment_status,
									'response_datetime' => $date,
									'transaction_number' => $payment_id,
									'updated_by' => $reg_user_id,
									'updated_on' => $date
								);
								$this->db->where('order_number',$order_number);
								$regUpdate = $this->db->update('applicant_form_online_deposit',$applicant_form_online_deposit);
								if(!$regUpdate){
									$dbStatus = FALSE;
								}
								else
								{
									$applicant_appl_overview = array(
										'appl_status' => 'Verified',
										'updated_by' => $reg_user_id,
										'updated_on' => $now
									);
									$this->db->where('appl_no',$application_no);
									$regUpdate = $this->db->update('applicant_appl_overview',$applicant_appl_overview);
									if(!$regUpdate){
										$dbStatus = FALSE;
									}
									
									$new_data = array(
										'id' 					=>NULL,
										'reg_user_id' 			=>$reg_user_id,
										'appl_no' 				=>$application_no,
										'form_no' 				=>$application_no,
										'applied_program' 		=>$program_code,
										'appl_status' 			=>'Verified',
										'created_by'			=>$reg_user_id,
										'created_on'			=>$date
									);
									
									
									$sql = $this->db->insert('applicant_appl_overview_history', $new_data);
									//echo $this->db->last_query();
									if(!$sql){
										$dbStatus = "FALSE";
										$dbMessage = "Error Inserting";
										//$dbError = ;	
									}
									$this->db->select('index_no');
									$this->db->from('applicant_appl_overview');
									$this->db->where('appl_no',$application_no);
									$result = $this->db->get();
									$output_data = $result->result_array();
									foreach ($output_data as $row) 
							        {
							        	$index_no = $row['index_no'];
							        }
							        if($index_no == '')
									{
										$this->db->select('A.program_code,A.year,sequence_code,sequence_no');
										$this->db->from('index_sequence_setup A');
										$this->db->where('A.program_code',$program_code);
										$result = $this->db->get();
										$output_data = $result->result_array();
										foreach ($output_data as $row1) 
								        {
								        	$year = $row1['year'];
											$year_str = substr($year,'-2');
											$sequence_no = $row1['sequence_no'];
											$key = $row1['sequence_code'];
								        }
										
										if($sequence_no < 10)
											$changed_sl_no = '00'.$sequence_no;
										else if($sequence_no < 100)
											$changed_sl_no = '0'.$sequence_no;
										else
											$changed_sl_no = $sequence_no;
											
										$index_no = $year_str.'/'.$key.'/'.$changed_sl_no;
									}
									$applicant_appl_overview = array(
										'appl_status' => 'Verified',
										'index_no' => $index_no,
										'updated_by' => $reg_user_id,
										'updated_on' => $now
									);
									$this->db->where('appl_no',$application_no);
									$regUpdate = $this->db->update('applicant_appl_overview',$applicant_appl_overview);
									if(!$regUpdate){
										$dbStatus = FALSE;
									}
									else
									{
										
										$controllerInstance = & get_instance();
    									$return = $controllerInstance->$print_function();
										if($return == true)
										{
											if(file_exists(DOCUMENT_UPLOAD_URL.'/'.$program_code.'/'.$application_no.'/application_print_008.pdf'))
											{
												$new_seq_no = $sequence_no + 1;
												if($index == '')
												{
													$applicant_appl_overview = array(
														'sequence_no' => $new_seq_no
													);
													$this->db->where('program_code',$program_code);
													$regUpdate = $this->db->update('index_sequence_setup',$applicant_appl_overview);
													if(!$regUpdate){
														$dbStatus = FALSE;
													}
												}
												$this->db->select("program_name"); 	
												$this->db->from("program_master"); 	
												$this->db->where('program_code ',$program_code);
												$result = $this->db->get();
												$output_data = $result->result_array();
												//echo $this->db->last_query();
												foreach($output_data as $row)
												{
													$program_name = $row['program_name'];
												}
												
												$this->db->select("email_id,first_name,mid_name,last_name"); 	
												$this->db->from("applicant_reg_master"); 	
												$this->db->where('reg_user_id ',$reg_user_id);
												$result = $this->db->get();
												$output_data = $result->result_array();
												//echo $this->db->last_query();
												foreach($output_data as $row)
												{
													$email = $row['email_id'];
													$first_name = $row['first_name'];
													$mid_name = $row['mid_name'];
													$last_name = $row['last_name'];
												}
												$name = $first_name.' '.$mid_name.' '.$last_name;
												
												
												$this->db->select('host_name , port_no,email_id,password,smtp_auth,smtp_secure');
												$this->db->from('email_provider_setup');
												$this->db->where('record_status','1');
												$this->db->limit('1');
												$result = $this->db->get();
												$query = $result->result_array();
												
												$row_count = $result->num_rows();
												foreach($result->result_array() AS $row1)
												{
													$host_name = $row1['host_name'];
													$port_no = $row1['port_no'];
													$email_id = $row1['email_id'];
													$password = $row1['password'];
													$smtp_auth = $row1['smtp_auth'];
													$smtp_secure = $row1['smtp_secure'];
												}
												
												$this->db->select('es.email_type,es.subject,es.content');
												$this->db->from('email_setup es');
												$this->db->join('program_email_setup pes','es.email_type = pes.email_type','inner');
												$this->db->where('es.email_type','SUBMISSION');
												$this->db->where('pes.institute_code',HARDCODE_INSTITUTE_CODE);
												$this->db->limit('1');
												$result = $this->db->get();
												$query = $result->result_array();
												//echo $this->db->last_query();
												$row_count = $result->num_rows();
												foreach($result->result_array() AS $row1)
												{
													$email_type=$row1['email_type'];
													$subject=$row1['subject'];
													$content=$row1['content'];
												}
												$this->load->library('email');
													

												/*$body = "You have successfully Registered with mobile no as $phone_no and date of birth as $dob_mail for $admName program.";*/
												/*$txtSubject = "Registration Successful";*/
												
												//$find = array("[name]");
												//$replace = array($name);
												//$smsURL = str_replace($subject,$find,$replace);	
												
												$config['protocol']    = 'smtp';
												$config['smtp_host']    = 'ssl://smtp.gmail.com';
												$config['smtp_port']    = '465';
												$config['smtp_timeout'] = '10';
												$config['smtp_user']    = $email_id;
												$config['smtp_pass']    = $password;
												$config['charset']    = 'utf-8';
												$config['newline']    = "\r\n";
												$config['mailtype'] = 'html'; // or text
												$config['validation'] = TRUE; // bool whether to validate email or not   
												$this->email->initialize($config);
												$this->email->from($email_id, 'CIPET ADMISSION 2018');
												$this->email->to($email); 

												$this->email->subject($subject);
												
												$find = array("[name]", "[course_name]");
												$replace = array($name, $program_name);
												$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url

												$this->email->message($email_content);  

												//$this->email->send();
												//echo $this->email->print_debugger();;
												//print_r($this->email->send());
												//die();
												/*if($this->email->send()){
													$dbStatus = TRUE; 
													$dbMessage = 'A mail is forwarded to your registered mail id ';
												}
												else{
													$dbStatus = FALSE; 
													$dbMessage = 'Unable to sent Mail.Please Contact for Support';
													$this->email->print_debugger();
												}*/
												
												$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
												$this->db->from('sms_provider_setup A');
												$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
												$this->db->where('B.record_status','1');
												$this->db->where('A.record_status','1');
												$this->db->where('B.sms_type','SUBMISSION OF APPLICATION');
												$this->db->where('B.status','ACTIVE');
												$result = $this->db->get();
												/*ECHO $this->db->last_query();
												die();*/
												$output_data = $result->result_array();
												foreach ($output_data as $row1) 
												{
													$sms_url = $row1['sms_url'];
													$user_name = $row1['user_name'];
													$password = addslashes($row1['password']);
													$sender = $row1['sender'];
													$content = $row1['content'];
													//$program = $row1['program_name'];
													//$institute_name = $row1['institute_name'];
													$find = array("[mobile_no]", "[subject]");
													$replace = array($phone_no, $content);
													$new_sms_url = str_replace($find, $replace, $sms_url);//find and replace uid and pwd in url
													
													if($program_name == 'Diploma in Plastics Mould Technology (DPMT)')
													{
														$program = 'DPMT';
													}
													else if($program_name == 'Postgraduate Diploma in Plastics Processing & Testing (PGD-PPT)')
													{
														$program = 'PGD-PPT';
													}
													else if($program_name == 'Post Diploma in Plastics Mould Design with CAD&sol;CAM (PD-PMD with CAD / CAM)')
													{
														$program = 'PD-PMD with CAD / CAM';
													}
													else if($program_name == 'Diploma in Plastics Technology (DPT)')
													{
														$program = 'DPT';
													}
													else if($program_name == 'Postgraduate Diploma in Plastics Testing and Quality Control (PGD-PTQC)')
													{
														$program = 'PGD-PTQC';
													}
													
													$findappl = array("[program_code]");
													$replaceappl = array($program);
													//echo $content."<br>";
													$new_content = str_replace($findappl, $replaceappl, $content);
													$messageToSend = rawurlencode($new_content);
													//echo $new_sms_url."<br>";
													//echo $new_content."<br>";
													//echo $messageToSend;
													
													//find replace url with mobileno and message
													$findmobileNo = array("[mobile_no]","[subject]");
													$replacemobileNo = array($reg_user_id,$messageToSend);
													$smsURL = str_replace($findmobileNo,$replacemobileNo,$sms_url);	
												}
												$done = file_get_contents($smsURL);
												$this->db->trans_complete();
												$print = 1;
												$array['print'] = 1;
												$array['payment_id'] = $payment_id;
												$array['payment_status'] = $payment_status;
												$array['program_code'] = $program_code;
												$array['program_name'] = $program_name;
												return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
											}
											else
											{
												$this->db->trans_rollback();
												return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => '');
											}
										}
										else
										{
											$this->db->trans_rollback();
											return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => '');
										}
									}
								}
								
							}
						}
					}
					else if($payment_status_id == 'FAILURE')
					{
						$payment_status = "FAILURE";
						$this->db->select('A.appl_no,B.reg_user_id,B.applied_program');
						$this->db->from('applicant_form_online_deposit A');
						$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no','INNER');
						$this->db->where('A.order_number',$order_number);
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach ($output_data as $row) 
				        {
				        	$appl_no = $row['appl_no'];
							$reg_user_id = $row['reg_user_id'];
							$applied_progam = $row['applied_program'];
							$program_code = $row['applied_program'];
				        }
						
						$applicant_form_online_deposit = array(
							'sub_category' => $_SESSION['mee_centrecode'].'-'.$_SESSION['mee_staffCode'],
							'deposit_status' => $payment_status,
							'response_datetime' => $date,
							'updated_by' => $reg_user_id,
							'updated_on' => $date,
							'remark' => $txn_description
						);
						$this->db->where('order_number',$order_number);
						$regUpdate = $this->db->update('applicant_form_online_deposit',$applicant_form_online_deposit);
						if(!$regUpdate){
							$dbStatus = FALSE;
						}
						else
						{
							$array['print'] = 0;
							$array['payment_id'] = $txn_description;
							$array['payment_status'] = $payment_status;
							$array['program_code'] = $program_code;
							$array['program_name'] = $program_name;
							return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
						}
					}
				}
				else
				{
					echo '<h1>Error!</h1>';
					echo '<p>Invalid response</p>';
					exit;
				}
			break;
			//=============================================
			//EMITRA
			case 'process_payment_emitra':
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$order_number = $this->session->userdata('order_number');
				$amount = $this->session->userdata('app_fee');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$strCurDate = date('d-m-Y');
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		
        		$this->db->select('institute_code');
				$this->db->from('program_master');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$institute_code = $row['institute_code'];
		        }
		        $this->session->set_userdata('institute_code', $institute_code);
		        
        		$this->db->select("T1.full_name,T1.first_name,T2.program_name,T2.program_code");
				$this->db->from('applicant_master T1');
				$this->db->join('program_master T2','T1.applied_program = T2.program_code','LEFT');
				$this->db->where('T1.reg_user_id',$reg_user_id);
				$this->db->where('T1.applied_program',$program_code);
				$this->db->where('T1.status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$full_name = $row['full_name'];
					$first_name = $row['first_name'];
					$program_name = $row['program_name'];
					$program_code = $row['program_code'];
		        }
		        
        		$full_name_size=strlen($full_name);
        		
        		$order_id = $order_number;        //your script should substitute the order description here in the quotes provided here
				if($full_name_size>=50){
					$billing_cust_name = $first_name;
					}         
				else{
					$billing_cust_name = $full_name;
				}
				$this->db->select("T1.email_id");
				$this->db->from('applicant_reg_master T1');
				$this->db->where('T1.reg_user_id',$reg_user_id);
				$this->db->where('T1.applied_program',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$applicant_email_id = $row['email_id'];
		        }
				$this->db->select("address_1,city_name,post_office,dm.district_name,sm.state_name,pin,applicant_address.district_code,applicant_address.state_code");
				$this->db->from('applicant_address');
				$this->db->join('applicant_master appmas','applicant_address.address_ref_id=appmas.perm_address_ref_id ','LEFT');
				$this->db->join('applicant_appl_overview applov','applov.reg_user_id=appmas.reg_user_id','LEFT');
				$this->db->join('district_master dm','dm.district_code=applicant_address.district_code','LEFT');
				$this->db->join('state_master sm','sm.state_code=applicant_address.state_code','LEFT');
				$this->db->where('applov.reg_user_id',$reg_user_id);
				$this->db->where('applov.applied_program',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$permanentaddr1 = $row['address_1'];
					$permanentaddr2 = $row['city_name'];
					$permanentpostoffice = $row['post_office'];
					$permanentdistrictcode = $row['district_name'];
					$permanentstatecode = $row['state_name'];
					$permanentpin = $row['pin'];
					$chkpermanentotherdistrict = $row['district_code'];
					$chkpermanentotherstate = $row['state_code'];
		        }
		        $billing_cust_address = $permanentaddr1;
				$billing_cust_country = 'IN';
				$billing_city = $permanentaddr2;
				$billing_zip = $permanentpin;
				$billing_cust_tel = $reg_user_id;
				if($full_name_size>=50){
					$delivery_cust_name = $first_name;
				}         
				else{
					$delivery_cust_name = $full_name;
				}
				$delivery_cust_address = $permanentaddr1;
				$delivery_cust_country = 'IN';
				$delivery_cust_state = $permanentstatecode;
				$delivery_city = $permanentaddr2;
				$delivery_zip = $permanentpin;
				$delivery_cust_tel = $reg_user_id;

				
				$register_mobile_no = $reg_user_id;
				$student_id = $reg_user_id;

				//get father and mother name
				
				$fathers_name = "NA";
				$mothers_name = "NA";
				

				$applicant_address = $permanentaddr1;
				$applicant_city = strlen($permanentaddr2) > 31 ? substr($permanentaddr2,0,31): $permanentaddr2;
				$billing_zip = $permanentpin;
				$applicant_mobile = $register_mobile_no;
				$applicant_email = $applicant_email_id;
				$applicant_id = $student_id;
				$applicant_father = $fathers_name;
				$applicant_mother = $mothers_name;
		        
		        $array['actionURL'] = "/staging2/cipet/payment/do_payment_emitra/$institute";
				$dbStatus = TRUE;	
				return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
			break;
			case 'do_payment_emitra':
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$order_number = $this->session->userdata('order_number');
				$amount = $this->session->userdata('app_fee');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$strCurDate = date('d-m-Y');
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		
        		$this->db->select('institute_code');
				$this->db->from('program_master');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$institute_code = $row['institute_code'];
		        }
		        $this->session->set_userdata('institute_code', $institute_code);
		        
        		$this->db->select("T1.full_name,T1.first_name,T2.program_name,T2.program_code");
				$this->db->from('applicant_master T1');
				$this->db->join('program_master T2','T1.applied_program = T2.program_code','LEFT');
				$this->db->where('T1.reg_user_id',$reg_user_id);
				$this->db->where('T1.applied_program',$program_code);
				$this->db->where('T1.status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$full_name = $row['full_name'];
					$first_name = $row['first_name'];
					$program_name = $row['program_name'];
					$program_code = $row['program_code'];
		        }
		        
        		$full_name_size=strlen($full_name);
        		
        		$order_id = $order_number;        //your script should substitute the order description here in the quotes provided here
				if($full_name_size>=50){
					$billing_cust_name = $first_name;
					}         
				else{
					$billing_cust_name = $full_name;
				}
				$this->db->select("T1.email_id");
				$this->db->from('applicant_reg_master T1');
				$this->db->where('T1.reg_user_id',$reg_user_id);
				$this->db->where('T1.applied_program',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$applicant_email_id = $row['email_id'];
		        }
				$this->db->select("address_1,city_name,post_office,dm.district_name,sm.state_name,pin,applicant_address.district_code,applicant_address.state_code");
				$this->db->from('applicant_address');
				$this->db->join('applicant_master appmas','applicant_address.address_ref_id=appmas.perm_address_ref_id ','LEFT');
				$this->db->join('applicant_appl_overview applov','applov.reg_user_id=appmas.reg_user_id','LEFT');
				$this->db->join('district_master dm','dm.district_code=applicant_address.district_code','LEFT');
				$this->db->join('state_master sm','sm.state_code=applicant_address.state_code','LEFT');
				$this->db->where('applov.reg_user_id',$reg_user_id);
				$this->db->where('applov.applied_program',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$permanentaddr1 = $row['address_1'];
					$permanentaddr2 = $row['city_name'];
					$permanentpostoffice = $row['post_office'];
					$permanentdistrictcode = $row['district_name'];
					$permanentstatecode = $row['state_name'];
					$permanentpin = $row['pin'];
					$chkpermanentotherdistrict = $row['district_code'];
					$chkpermanentotherstate = $row['state_code'];
		        }
		        $billing_cust_address = $permanentaddr1;
				$billing_cust_country = 'IN';
				$billing_city = $permanentaddr2;
				$billing_zip = $permanentpin;
				$billing_cust_tel = $reg_user_id;
				if($full_name_size>=50){
					$delivery_cust_name = $first_name;
				}         
				else{
					$delivery_cust_name = $full_name;
				}
				$delivery_cust_address = $permanentaddr1;
				$delivery_cust_country = 'IN';
				$delivery_cust_state = $permanentstatecode;
				$delivery_city = $permanentaddr2;
				$delivery_zip = $permanentpin;
				$delivery_cust_tel = $reg_user_id;

				
				$register_mobile_no = $reg_user_id;
				$student_id = $reg_user_id;

				//get father and mother name
				
				$fathers_name = "NA";
				$mothers_name = "NA";
				

				$applicant_address = $permanentaddr1;
				$applicant_city = strlen($permanentaddr2) > 31 ? substr($permanentaddr2,0,31): $permanentaddr2;
				$billing_zip = $permanentpin;
				$applicant_mobile = $register_mobile_no;
				$applicant_email = $applicant_email_id;
				$applicant_id = $student_id;
				$applicant_father = $fathers_name;
				$applicant_mother = $mothers_name;
				$pg_charges = '05.00';
				//API CALL
				$MERCHANTCODE = 'RISLTEST';
				$REQUESTID = $order_number;
				$REQTIMESTAMP = date('YmdHis');
				$SERVICEID = '4070';
				$SUBSERVICEID = '';
				$REVENUEHEAD = '863-'.$amount.'|865-'.$pg_charges;
				$CONSUMERKEY = $order_number;
				$CONSUMERNAME = $delivery_cust_name;
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
				
				//decrypt
				$url = "http://emitrauat.rajasthan.gov.in/webServicesRepositoryUat/backtobackTransactionWithEncryptionA";
				$ch = curl_init($url);
				$headers = array();
				$headers[] = 'Accept: application/json';
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array("encData"=>$enc_data)));
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
				    redirect("/staging2/cipet/payment/postpayment_failure_emitra/".$institute);
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
					echo '<form name="frmPayment"  method="post" action="/staging2/cipet/payment/postpayment_emitra/'.$institute.'"><input type="hidden" name="pg_status" value="'.$RES_TRANSACTIONSTATUSCODE.'"/><input type="hidden" name="pg_desc" value="'.$RES_MSG.'"/><input type="hidden" name="pg_transaction_no" value="'.$RES_TRANSACTIONID.'"/><input type="hidden" name="pg_charges" value="'.$pg_charges.'"/></form><script type="text/javascript">document.frmPayment.submit();</script>';
				}
				else
				{
					echo '<form name="frmPayment"  method="post" action="/staging2/cipet/payment/postpayment_emitra/'.$institute.'"><input type="hidden" name="pg_status" value="'.$RES_TRANSACTIONSTATUSCODE.'"/><input type="hidden" name="pg_desc" value="'.$RES_MSG.'"/></form><script type="text/javascript">document.frmPayment.submit();</script>';
				}
				
			break;
			case 'get_post_payment_data_emitra':
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$order_number = $this->session->userdata('order_number');
				$amount = $this->session->userdata('app_fee');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date('Y-m-d H:i:s', now());
        		//$strCurDate = date('d-m-Y');
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$this->db->select('A.institute_code,B.institute_name,logo_url,A.program_name');
				$this->db->from('program_master A');
				$this->db->join('institute_master B','A.institute_code = B.institute_code','INNER');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$ins_name = $row['institute_name'];
		        	$program_name = $row['program_name'];
					$ins_code = $row['institute_code'];
					$institute_logo = $row['logo_url'];
					$institute_logo = "../build/images/logo/".$institute_logo;
		        }
		        $hex_ins_code =  encrypt_decrypt('encrypt', $ins_code);
		        $applshow=0;
				$show=0;
				$print=0;
				$noamount=0;
				$showChallanInfo=0;
				$edit="false";
				$editappl="false";
		        
								
				$data_array 	 = $_POST;
				
				$txn_status 	 = $data_array['pg_status'];
				$txn_description 	 = $data_array['pg_desc'];
				
				$fee_amount = $amount;
				if($txn_status == '200')
					$payment_status_id = 'SUCCESS';
				else
					$payment_status_id = 'FAILURE';
				if(isset($data_array))
				{
					if($payment_status_id == 'SUCCESS')
					{
						$mee_txn 		 = $data_array['pg_transaction_no']; 
						$pg_charges		 = $data_array['pg_charges']; 
						$payment_id = $mee_txn;
						$transaction_id = $mee_txn;
						$payment_status = "SUCCESS";
						$payment_id = $transaction_id;
			
						$this->db->select('A.appl_no,B.reg_user_id,B.applied_program');
						$this->db->from('applicant_form_online_deposit A');
						$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no','INNER');
						$this->db->where('A.order_number',$order_number);
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach ($output_data as $row) 
				        {
				        	$appl_no = $row['appl_no'];
							$reg_user_id = $row['reg_user_id'];
							$applied_progam = $row['applied_program'];
							$program_code = $row['applied_program'];
				        }
			
				        $this->db->select('A.template_code,B.template_name,file_name');
						$this->db->from('program_master A');
						$this->db->join('form_template_master B','A.template_code = B.template_code','INNER');
						$this->db->where('A.program_code',$program_code);
						$result = $this->db->get();
						
						$output_data = $result->result_array();
						foreach ($output_data as $row) 
				        {
				        	$temp_code = $row['template_code'];
							$temp_name = explode(".",$row['file_name']);
							$file_name = $temp_name[0]."pdf.php";
							$print_function = $temp_name[0]."pdf";
				        }
	        
				        $this->db->select('appl_status');
						$this->db->from('applicant_appl_overview');
						$this->db->where('reg_user_id',$reg_user_id);
						$this->db->where('applied_program',$program_code);
						$this->db->where('STATUS','1');
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach ($output_data as $row) 
				        {
				        	$appl_status = $row['appl_status'];
				        }
						if($payment_status_id == 'SUCCESS')
						{
							
							$payment_id = $payment_id;
							
							$this->db->trans_start();
							$applicant_form_fee_overview = array(
								'depositdate' => $date,
								'money_receipt_no' => $payment_id,
								'modified_by' => $reg_user_id,
								'modified_on' => $date,
								'pg_charges' => $pg_charges
							);
							$this->db->where('appl_no',$application_no);
							$regUpdate = $this->db->update('applicant_form_fee_overview',$applicant_form_fee_overview);
							if(!$regUpdate){
								$dbStatus = FALSE;
							}
							else
							{
								$applicant_form_online_deposit = array(
									'sub_category' => $_SESSION['EMITRASSOID'].'-'.$_SESSION['KIOSKCODE'],
									'depositdate' => $date,
									'deposit_status' => $payment_status,
									'response_datetime' => $date,
									'transaction_number' => $payment_id,
									'updated_by' => $reg_user_id,
									'updated_on' => $date
								);
								$this->db->where('order_number',$order_number);
								$regUpdate = $this->db->update('applicant_form_online_deposit',$applicant_form_online_deposit);
								if(!$regUpdate){
									$dbStatus = FALSE;
								}
								else
								{
									$applicant_appl_overview = array(
										'appl_status' => 'Verified',
										'updated_by' => $reg_user_id,
										'updated_on' => $now
									);
									$this->db->where('appl_no',$application_no);
									$regUpdate = $this->db->update('applicant_appl_overview',$applicant_appl_overview);
									if(!$regUpdate){
										$dbStatus = FALSE;
									}
									
									$new_data = array(
										'id' 					=>NULL,
										'reg_user_id' 			=>$reg_user_id,
										'appl_no' 				=>$application_no,
										'form_no' 				=>$application_no,
										'applied_program' 		=>$program_code,
										'appl_status' 			=>'Verified',
										'created_by'			=>$reg_user_id,
										'created_on'			=>$date
									);
									
									
									$sql = $this->db->insert('applicant_appl_overview_history', $new_data);
									//echo $this->db->last_query();
									if(!$sql){
										$dbStatus = "FALSE";
										$dbMessage = "Error Inserting";
										//$dbError = ;	
									}
									$this->db->select('index_no');
									$this->db->from('applicant_appl_overview');
									$this->db->where('appl_no',$application_no);
									$result = $this->db->get();
									$output_data = $result->result_array();
									foreach ($output_data as $row) 
							        {
							        	$index_no = $row['index_no'];
							        }
							        if($index_no == '')
									{
										$this->db->select('A.program_code,A.year,sequence_code,sequence_no');
										$this->db->from('index_sequence_setup A');
										$this->db->where('A.program_code',$program_code);
										$result = $this->db->get();
										$output_data = $result->result_array();
										foreach ($output_data as $row1) 
								        {
								        	$year = $row1['year'];
											$year_str = substr($year,'-2');
											$sequence_no = $row1['sequence_no'];
											$key = $row1['sequence_code'];
								        }
										
										if($sequence_no < 10)
											$changed_sl_no = '00'.$sequence_no;
										else if($sequence_no < 100)
											$changed_sl_no = '0'.$sequence_no;
										else
											$changed_sl_no = $sequence_no;
											
										$index_no = $year_str.'/'.$key.'/'.$changed_sl_no;
									}
									$applicant_appl_overview = array(
										'appl_status' => 'Verified',
										'index_no' => $index_no,
										'updated_by' => $reg_user_id,
										'updated_on' => $now
									);
									$this->db->where('appl_no',$application_no);
									$regUpdate = $this->db->update('applicant_appl_overview',$applicant_appl_overview);
									if(!$regUpdate){
										$dbStatus = FALSE;
									}
									else
									{
										
										$controllerInstance = & get_instance();
    									$return = $controllerInstance->$print_function();
										if($return == true)
										{
											if(file_exists(DOCUMENT_UPLOAD_URL.'/'.$program_code.'/'.$application_no.'/application_print_008.pdf'))
											{
												$new_seq_no = $sequence_no + 1;
												if($index == '')
												{
													$applicant_appl_overview = array(
														'sequence_no' => $new_seq_no
													);
													$this->db->where('program_code',$program_code);
													$regUpdate = $this->db->update('index_sequence_setup',$applicant_appl_overview);
													if(!$regUpdate){
														$dbStatus = FALSE;
													}
												}
												$this->db->select("program_name"); 	
												$this->db->from("program_master"); 	
												$this->db->where('program_code ',$program_code);
												$result = $this->db->get();
												$output_data = $result->result_array();
												//echo $this->db->last_query();
												foreach($output_data as $row)
												{
													$program_name = $row['program_name'];
												}
												
												$this->db->select("email_id,first_name,mid_name,last_name"); 	
												$this->db->from("applicant_reg_master"); 	
												$this->db->where('reg_user_id ',$reg_user_id);
												$result = $this->db->get();
												$output_data = $result->result_array();
												//echo $this->db->last_query();
												foreach($output_data as $row)
												{
													$email = $row['email_id'];
													$first_name = $row['first_name'];
													$mid_name = $row['mid_name'];
													$last_name = $row['last_name'];
												}
												$name = $first_name.' '.$mid_name.' '.$last_name;
												
												
												$this->db->select('host_name , port_no,email_id,password,smtp_auth,smtp_secure');
												$this->db->from('email_provider_setup');
												$this->db->where('record_status','1');
												$this->db->limit('1');
												$result = $this->db->get();
												$query = $result->result_array();
												
												$row_count = $result->num_rows();
												foreach($result->result_array() AS $row1)
												{
													$host_name = $row1['host_name'];
													$port_no = $row1['port_no'];
													$email_id = $row1['email_id'];
													$password = $row1['password'];
													$smtp_auth = $row1['smtp_auth'];
													$smtp_secure = $row1['smtp_secure'];
												}
												
												$this->db->select('es.email_type,es.subject,es.content');
												$this->db->from('email_setup es');
												$this->db->join('program_email_setup pes','es.email_type = pes.email_type','inner');
												$this->db->where('es.email_type','SUBMISSION');
												$this->db->where('pes.institute_code',HARDCODE_INSTITUTE_CODE);
												$this->db->limit('1');
												$result = $this->db->get();
												$query = $result->result_array();
												//echo $this->db->last_query();
												$row_count = $result->num_rows();
												foreach($result->result_array() AS $row1)
												{
													$email_type=$row1['email_type'];
													$subject=$row1['subject'];
													$content=$row1['content'];
												}
												$this->load->library('email');
													

												/*$body = "You have successfully Registered with mobile no as $phone_no and date of birth as $dob_mail for $admName program.";*/
												/*$txtSubject = "Registration Successful";*/
												
												//$find = array("[name]");
												//$replace = array($name);
												//$smsURL = str_replace($subject,$find,$replace);	
												
												$config['protocol']    = 'smtp';
												$config['smtp_host']    = 'ssl://smtp.gmail.com';
												$config['smtp_port']    = '465';
												$config['smtp_timeout'] = '10';
												$config['smtp_user']    = $email_id;
												$config['smtp_pass']    = $password;
												$config['charset']    = 'utf-8';
												$config['newline']    = "\r\n";
												$config['mailtype'] = 'html'; // or text
												$config['validation'] = TRUE; // bool whether to validate email or not   
												$this->email->initialize($config);
												$this->email->from($email_id, 'CIPET ADMISSION 2018');
												$this->email->to($email); 

												$this->email->subject($subject);
												
												$find = array("[name]", "[course_name]");
												$replace = array($name, $program_name);
												$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url

												$this->email->message($email_content);  

												//$this->email->send();
												//echo $this->email->print_debugger();;
												//print_r($this->email->send());
												//die();
												/*if($this->email->send()){
													$dbStatus = TRUE; 
													$dbMessage = 'A mail is forwarded to your registered mail id ';
												}
												else{
													$dbStatus = FALSE; 
													$dbMessage = 'Unable to sent Mail.Please Contact for Support';
													$this->email->print_debugger();
												}*/
												
												$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
												$this->db->from('sms_provider_setup A');
												$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
												$this->db->where('B.record_status','1');
												$this->db->where('A.record_status','1');
												$this->db->where('B.sms_type','SUBMISSION OF APPLICATION');
												$this->db->where('B.status','ACTIVE');
												$result = $this->db->get();
												/*ECHO $this->db->last_query();
												die();*/
												$output_data = $result->result_array();
												foreach ($output_data as $row1) 
												{
													$sms_url = $row1['sms_url'];
													$user_name = $row1['user_name'];
													$password = addslashes($row1['password']);
													$sender = $row1['sender'];
													$content = $row1['content'];
													//$program = $row1['program_name'];
													//$institute_name = $row1['institute_name'];
													$find = array("[mobile_no]", "[subject]");
													$replace = array($phone_no, $content);
													$new_sms_url = str_replace($find, $replace, $sms_url);//find and replace uid and pwd in url
													
													if($program_name == 'Diploma in Plastics Mould Technology (DPMT)')
													{
														$program = 'DPMT';
													}
													else if($program_name == 'Postgraduate Diploma in Plastics Processing & Testing (PGD-PPT)')
													{
														$program = 'PGD-PPT';
													}
													else if($program_name == 'Post Diploma in Plastics Mould Design with CAD&sol;CAM (PD-PMD with CAD / CAM)')
													{
														$program = 'PD-PMD with CAD / CAM';
													}
													else if($program_name == 'Diploma in Plastics Technology (DPT)')
													{
														$program = 'DPT';
													}
													else if($program_name == 'Postgraduate Diploma in Plastics Testing and Quality Control (PGD-PTQC)')
													{
														$program = 'PGD-PTQC';
													}
													
													$findappl = array("[program_code]");
													$replaceappl = array($program);
													//echo $content."<br>";
													$new_content = str_replace($findappl, $replaceappl, $content);
													$messageToSend = rawurlencode($new_content);
													//echo $new_sms_url."<br>";
													//echo $new_content."<br>";
													//echo $messageToSend;
													
													//find replace url with mobileno and message
													$findmobileNo = array("[mobile_no]","[subject]");
													$replacemobileNo = array($reg_user_id,$messageToSend);
													$smsURL = str_replace($findmobileNo,$replacemobileNo,$sms_url);	
												}
												$done = file_get_contents($smsURL);
												$this->db->trans_complete();
												$print = 1;
												$array['print'] = 1;
												$array['payment_id'] = $payment_id;
												$array['payment_status'] = $payment_status;
												$array['program_code'] = $program_code;
												$array['program_name'] = $program_name;
												return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
											}
											else
											{
												$this->db->trans_rollback();
												return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => '');
											}
										}
										else
										{
											$this->db->trans_rollback();
											return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => '');
										}
									}
								}
								
							}
						}
					}
					else if($payment_status_id == 'FAILURE')
					{
						$payment_status = "FAILURE";
						$this->db->select('A.appl_no,B.reg_user_id,B.applied_program');
						$this->db->from('applicant_form_online_deposit A');
						$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no','INNER');
						$this->db->where('A.order_number',$order_number);
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach ($output_data as $row) 
				        {
				        	$appl_no = $row['appl_no'];
							$reg_user_id = $row['reg_user_id'];
							$applied_progam = $row['applied_program'];
							$program_code = $row['applied_program'];
				        }
						
						$applicant_form_online_deposit = array(
							'sub_category' => $_SESSION['EMITRASSOID'].'-'.$_SESSION['KIOSKCODE'],
							'deposit_status' => $payment_status,
							'response_datetime' => $date,
							'updated_by' => $reg_user_id,
							'updated_on' => $date,
							'remark' => $txn_description
						);
						$this->db->where('order_number',$order_number);
						$regUpdate = $this->db->update('applicant_form_online_deposit',$applicant_form_online_deposit);
						if(!$regUpdate){
							$dbStatus = FALSE;
						}
						else
						{
							$array['print'] = 0;
							$array['payment_id'] = $txn_description;
							$array['payment_status'] = $payment_status;
							$array['program_code'] = $program_code;
							$array['program_name'] = $program_name;
							return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
						}
					}
				}
				else
				{
					echo '<h1>Error!</h1>';
					echo '<p>Invalid response</p>';
					exit;
				}
			break;
			//=============================================
			//=============================================
			case 'process_payment_techprocess':
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$order_number = $this->session->userdata('order_number');
				$amount = $this->session->userdata('app_fee');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$strCurDate = date('d-m-Y');
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$parsedUrl = parse_url($url);
				
				$host = $parsedUrl['host'];
        		
        		$this->db->select('institute_code');
				$this->db->from('program_master');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$institute_code = $row['institute_code'];
		        }
		        $this->session->set_userdata('institute_code', $institute_code);
		        $ins_enc =  encrypt_decrypt('encrypt', $institute_code);
		        $this->db->select('pg_action_url');
				$this->db->from('pg_master');
				$this->db->where('pg_code','TECHPROCESS');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$pg_action_url = $row['pg_action_url'];
		        }
		        
		        $this->db->select('pg_parameter_code, pg_parameter_value');
				$this->db->from('pg_parameter_values');
				$this->db->where('pg_code','TECHPROCESS');
				$this->db->where('school_code',$institute_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$pg_parameter_values[$row['pg_parameter_code']] = $row['pg_parameter_value'];
		        }
        		
				$this->db->select("address_1,city_name,post_office,dm.district_name,sm.state_name,pin,applicant_address.district_code,applicant_address.state_code");
				$this->db->from('applicant_address');
				$this->db->join('applicant_master appmas','applicant_address.address_ref_id=appmas.perm_address_ref_id ','LEFT');
				$this->db->join('applicant_appl_overview applov','applov.reg_user_id=appmas.reg_user_id','LEFT');
				$this->db->join('district_master dm','dm.district_code=applicant_address.district_code','LEFT');
				$this->db->join('state_master sm','sm.state_code=applicant_address.state_code','LEFT');
				$this->db->where('applov.reg_user_id',$reg_user_id);
				$this->db->where('applov.applied_program',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$permanentaddr1 = $row['address_1'];
					$permanentaddr2 = $row['city_name'];
					$permanentpostoffice = $row['post_office'];
					$permanentdistrictcode = $row['district_name'];
					$permanentstatecode = $row['state_name'];
					$permanentpin = $row['pin'];
					$chkpermanentotherdistrict = $row['district_code'];
					$chkpermanentotherstate = $row['state_code'];
		        }
		        
		        $this->db->select("T1.full_name,T1.first_name,T2.program_name,T2.program_code");
				$this->db->from('applicant_master T1');
				$this->db->join('program_master T2','T1.applied_program = T2.program_code','LEFT');
				$this->db->where('T1.reg_user_id',$reg_user_id);
				$this->db->where('T1.applied_program',$program_code);
				$this->db->where('T1.status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$full_name = $row['full_name'];
					$first_name = $row['first_name'];
					$program_name = $row['program_name'];
					$program_code = $row['program_code'];
		        }
		        
        		$full_name_size=strlen($full_name);
        		
        		$order_id = $order_number;        //your script should substitute the order description here in the quotes provided here
				if($full_name_size>=50){
					$billing_cust_name = $first_name;
					}         
				else{
					$billing_cust_name = $full_name;
				}
				$billing_cust_address = $permanentaddr1;
				//$billing_cust_country = $pg_parameter_values['BCC'];
				$billing_cust_state = $permanentstatecode;
				$billing_city = $permanentaddr2;
				$billing_zip = $permanentpin;
				$billing_cust_tel = $reg_user_id;
				//$billing_cust_email = $pg_parameter_values['BCE'];
        		
        		
        		
        		if($full_name_size>=50){
					$delivery_cust_name = $first_name;
				}         
				else{
					$delivery_cust_name = $full_name;
				}
				//$delivery_cust_name = $full_name;
				$delivery_cust_address = $permanentaddr1;
				//$delivery_cust_country = $pg_parameter_values['BCC'];
				$delivery_cust_state = $permanentstatecode;
				$delivery_city = $permanentaddr2;
				$delivery_zip = $permanentpin;
				$delivery_cust_tel = $reg_user_id;

				$delivery_cust_notes = "Application Fee for".$program_name;
				
				//$_SESSION['iv'] = '2545346687TEBSMC';
			    //$_SESSION['iv'] = $pg_parameter_values['IV'];
			    $this->session->set_userdata('iv', $pg_parameter_values['IV']);
			    $this->session->set_userdata('key', $pg_parameter_values['KEY']);
			    //$_SESSION['key']   = '3398330990ARVIGY';
			    //$_SESSION['key']   = $pg_parameter_values['KEY'];
        		
        		$transactionRequestBean = new TransactionRequestBean();
        		$return_url = $pg_parameter_values['RTU']."/".$ins_enc;
        		//Setting all values here
			    //$transactionRequestBean->setMerchantCode('L47920');
			    $transactionRequestBean->setMerchantCode($pg_parameter_values['MERC']);
			    $transactionRequestBean->setAccountNo('');
			    $transactionRequestBean->setITC($pg_parameter_values['ITC']);
			    $transactionRequestBean->setMobileNumber('');
			    $transactionRequestBean->setCustomerName($billing_cust_name);
			    $transactionRequestBean->setRequestType('T');
			    $transactionRequestBean->setMerchantTxnRefNumber($order_id);
			    $transactionRequestBean->setAmount($amount);
			    $transactionRequestBean->setCurrencyCode('INR');
			    $transactionRequestBean->setReturnURL($return_url);
			    $transactionRequestBean->setS2SReturnURL('');
			    //$transactionRequestBean->setShoppingCartDetails('Edus_'.$amount.'_0.0');
			    $transactionRequestBean->setShoppingCartDetails($pg_parameter_values['SCP'].$amount.'_0.0');
			    $transactionRequestBean->setTxnDate($strCurDate);
			    $transactionRequestBean->setBankCode('');
			    $transactionRequestBean->setTPSLTxnID('');
			    //$transactionRequestBean->setCustId('19872627');
			    $transactionRequestBean->setCustId($pg_parameter_values['CUST']);
			    $transactionRequestBean->setCardId('');
			    //$transactionRequestBean->setKey('3398330990ARVIGY');
			    $transactionRequestBean->setKey($pg_parameter_values['KEY']);
			    //$transactionRequestBean->setIv('2545346687TEBSMC');
			    $transactionRequestBean->setIv($pg_parameter_values['IV']);
			    $transactionRequestBean->setWebServiceLocator($pg_action_url);
			    $transactionRequestBean->setMMID('');
			    $transactionRequestBean->setOTP('');
			    $transactionRequestBean->setCardName('');
			    $transactionRequestBean->setCardNo('');
			    $transactionRequestBean->setCardCVV('');
			    $transactionRequestBean->setCardExpMM('');
			    $transactionRequestBean->setCardExpYY('');
			    $transactionRequestBean->setTimeOut('');

			    $url = $transactionRequestBean->getTransactionToken();

			    $responseDetails = $transactionRequestBean->getTransactionToken();
			    $responseDetails = (array)$responseDetails;
			    $response = $responseDetails[0];
			   //	print_r($responseDetails);die;
			    if(is_string($response) && preg_match('/^msg=/',$response))
			    {
			        $outputStr = str_replace('msg=', '', $response);
			        $outputArr = explode('&', $outputStr);
			        $str = $outputArr[0];

			        $transactionResponseBean = new TransactionResponseBean();
			        $transactionResponseBean->setResponsePayload($str);
			        //$transactionResponseBean->setKey('3398330990ARVIGY');
			        $transactionResponseBean->setKey($pg_parameter_values['KEY']);
			        //$transactionResponseBean->setIv('2545346687TEBSMC');
			        $transactionResponseBean->setIv($pg_parameter_values['IV']);

			        $response = $transactionResponseBean->getResponsePayload();
			        return array('status' => $dbStatus, 'msg' => $dbMessage,'payment_process_url' => $response);
			        exit;
			    }
			    elseif(is_string($response) && preg_match('/^txn_status=/',$response))
			    {
			    	return array('status' => $dbStatus, 'msg' => $dbMessage,'payment_process_url' => $response);
			        exit;
				}
				return array('status' => $dbStatus, 'msg' => $dbMessage,'payment_process_url' => $response);
			break;
			///AIRPAY START
			case 'process_payment_airpay':
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$order_number = $this->session->userdata('order_number');
				$amount = $this->session->userdata('app_fee');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$strCurDate = date('d-m-Y');
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$parsedUrl = parse_url($url);
				
				$host = $parsedUrl['host'];
        		
        		$this->db->select('institute_code');
				$this->db->from('program_master');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$institute_code = $row['institute_code'];
		        }
		        $this->session->set_userdata('institute_code', $institute_code);
		        $ins_enc =  encrypt_decrypt('encrypt', $institute_code);
		        $this->db->select('pg_action_url');
				$this->db->from('pg_master');
				$this->db->where('pg_code','AIRPAY');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$pg_action_url = $row['pg_action_url'];
		        }
		        
		        $this->db->select('pg_parameter_code, pg_parameter_value');
				$this->db->from('pg_parameter_values');
				$this->db->where('pg_code','AIRPAY');
				$this->db->where('school_code',$institute_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$pg_parameter_values[$row['pg_parameter_code']] = $row['pg_parameter_value'];
		        }
        		if($institute_code == 'FBBSRS')
        		{
					$this->db->select("address_1,city_name,post_office,dm.district_name,sm.state_name,pin,applicant_address.district_code,applicant_address.state_code");
					$this->db->from('applicant_address');
					$this->db->join('applicant_master appmas','applicant_address.address_ref_id=appmas.comm_address_ref_id ','LEFT');
					$this->db->join('applicant_appl_overview applov','applov.reg_user_id=appmas.reg_user_id','LEFT');
					$this->db->join('district_master dm','dm.district_code=applicant_address.district_code','LEFT');
					$this->db->join('state_master sm','sm.state_code=applicant_address.state_code','LEFT');
					$this->db->where('applov.reg_user_id',$reg_user_id);
					$this->db->where('applov.applied_program',$program_code);
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $row) 
			        {
			        	$permanentaddr1 = $row['address_1'];
						$permanentaddr2 = $row['city_name'];
						$permanentpostoffice = $row['post_office'];
						$permanentdistrictcode = $row['district_name'];
						$permanentstatecode = $row['state_name'];
						$permanentpin = $row['pin'];
						$chkpermanentotherdistrict = $row['district_code'];
						$chkpermanentotherstate = $row['state_code'];
			        }
				}
				else 
				{
					$this->db->select("address_1,city_name,post_office,dm.district_name,sm.state_name,pin,applicant_address.district_code,applicant_address.state_code");
					$this->db->from('applicant_address');
					$this->db->join('applicant_master appmas','applicant_address.address_ref_id=appmas.perm_address_ref_id ','LEFT');
					$this->db->join('applicant_appl_overview applov','applov.reg_user_id=appmas.reg_user_id','LEFT');
					$this->db->join('district_master dm','dm.district_code=applicant_address.district_code','LEFT');
					$this->db->join('state_master sm','sm.state_code=applicant_address.state_code','LEFT');
					$this->db->where('applov.reg_user_id',$reg_user_id);
					$this->db->where('applov.applied_program',$program_code);
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $row) 
			        {
			        	$permanentaddr1 = $row['address_1'];
						$permanentaddr2 = $row['city_name'];
						$permanentpostoffice = $row['post_office'];
						$permanentdistrictcode = $row['district_name'];
						$permanentstatecode = $row['state_name'];
						$permanentpin = $row['pin'];
						$chkpermanentotherdistrict = $row['district_code'];
						$chkpermanentotherstate = $row['state_code'];
			        }
				}
				
		        
		        $this->db->select("T1.full_name,T1.first_name,T2.program_name,T2.program_code");
				$this->db->from('applicant_master T1');
				$this->db->join('program_master T2','T1.applied_program = T2.program_code','LEFT');
				$this->db->where('T1.reg_user_id',$reg_user_id);
				$this->db->where('T1.applied_program',$program_code);
				$this->db->where('T1.status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$full_name = $row['full_name'];
					$first_name = $row['first_name'];
					$program_name = $row['program_name'];
					$program_code = $row['program_code'];
		        }
		        
        		$full_name_size=strlen($full_name);
        		$order_id = $order_number;        //your script should substitute the order description here in the quotes provided here
				if($full_name_size>=50){
					$billing_cust_name = $first_name;
					}         
				else{
					$billing_cust_name = $full_name;
				}
        		if($full_name_size>=50){
					$delivery_cust_name = $first_name;
				}         
				else{
					$delivery_cust_name = $full_name;
				}
				
				
				$delivery_cust_address = $permanentaddr1;
				$delivery_cust_state = $permanentstatecode;
				$delivery_city = $permanentaddr2;
				$delivery_zip = $permanentpin;
				$delivery_cust_tel = $reg_user_id;
				$delivery_cust_notes = "Application Fee for".$program_name;
				
				$billing_cust_address = $permanentaddr1;
				$billing_cust_country = 'IND';
				$billing_cust_state = $permanentstatecode;
				$billing_city = $permanentaddr2;
				$billing_zip = $permanentpin;
				$billing_cust_tel = $reg_user_id;
				$billing_cust_email = 'aps.support@stlindia.com';

				/*if($pg_parameter_values['INTEGRATIONSTATUS'] == 'TESTING')
					$pg_action_url = $pg_test_url;*/

				$buyerEmail = $billing_cust_email;
				$buyerPhone = $billing_cust_tel;
				$buyerFirstName = $billing_cust_name;
				$buyerLastName = $billing_cust_name;
				//$buyerAddress = preg_replace('/[^A-Za-z0-9\-]/', ' ', $billing_cust_address);
				$buyerAddress = '';
				$amount = $_SESSION['app_fee'];
				$buyerCity = $billing_city;
				$buyerState = $billing_cust_state;
				$buyerPinCode = $billing_zip;
				$buyerCountry = 'INDIA';
				$buyerAdmissionNo = $order_id;
				$orderid = $order_number; //Your System Generated Order ID
				$customvar = $buyerFirstName.'|'.$buyerAdmissionNo.'|'.$amount;
				
				$_POST['buyerEmail'] = $buyerEmail;
				$_POST['buyerPhone'] = $buyerPhone;
				$_POST['buyerFirstName'] = $buyerFirstName;
				$_POST['buyerLastName'] = $buyerLastName;
				$_POST['buyerAddress'] = $buyerAddress;
				$_POST['buyerCity'] = $buyerCity;
				$_POST['buyerState'] = $buyerState;
				$_POST['buyerCountry'] = $buyerCountry;
				$_POST['buyerPinCode'] = $buyerPinCode;
				$_POST['buyerAdmissionNo'] = $buyerAdmissionNo;
				$_POST['orderid'] = $orderid;
				$_POST['amount'] = $amount;
				
				
				
				// Create an array having all required parameters for creating checksum.
				$secret = $pg_parameter_values['SECRETKEY'];
				$username = $pg_parameter_values['USERNAME'];
				$password = $pg_parameter_values['PASSWORD'];
				$mercid = $pg_parameter_values['MERCHANTID'];

				//include('checksum.php');
				//include('validation.php');
				
				$alldata   = $buyerEmail.$buyerFirstName.$buyerLastName.$buyerAddress.$buyerCity.$buyerState.$buyerCountry.$amount.$orderid;
				$alldata1   = $buyerEmail."-".$buyerFirstName."-".$buyerLastName."-".$buyerAddress."-".$buyerCity."-".$buyerState."-".$buyerCountry."-".$amount."-".$orderid;
				
				//$privatekey = Checksum::encrypt($username.":|:".$password, $secret);
				$privatekey = $this->checksum->encrypt($username.":|:".$password, $secret);
				//$checksum = Checksum::calculateChecksum($alldata.date('Y-m-d'),$privatekey);
				$checksum = $this->checksum->calculateChecksum($alldata.date('Y-m-d'),$privatekey);
				$hiddenmod = "";
				//ECHO $privatekey."--".$checksum;die;
					/*if($buyerEmail=='' && $buyerPhone =='' && $buyerFirstName =='' && $buyerLastName == '' && $amount == '')
					{
						$dbStatus = false;
						return array('status'=>$dbStatus);
					}
					if($buyerEmail=='')
					{
						$dbStatus = false;
						return array('status'=>$dbStatus);
					}
					else
					{	
						if (!filter_var($buyerEmail, FILTER_VALIDATE_EMAIL) ||  (strlen($buyerEmail) > 50) ){

							$dbStatus = false;
							return array('status'=>$dbStatus);
						}
					}
					if($buyerPhone=='')
					{
						$dbStatus = false;
						return array('status'=>$dbStatus);
					}
					else
					{
						$regex = '/^[0-9- ]{8,15}$/i'; 
						if(!preg_match($regex,$buyerPhone)) {
							$dbStatus = false;
							return array('status'=>$dbStatus);
						}
					}
					if($buyerFirstName=='')
					{
						$dbStatus = false;
						return array('status'=>$dbStatus);
					}
					else
					{
						$regex = '/^[a-z \d]{1,50}$/i'; 
						if(!preg_match($regex,$buyerFirstName)) {
							$dbStatus = false;
							return array('status'=>$dbStatus);
						}
					}
					if($buyerLastName=='')
					{
						$dbStatus = false;
						return array('status'=>$dbStatus);
					}
					else
					{
						$regex = '/^[a-z \d]{1,50}$/i'; 
						if(!preg_match($regex,$buyerLastName)) {
							$dbStatus = false;
							return array('status'=>$dbStatus);
						}
					}
					
					if($buyerAddress!='')
					{
						$regex =  '/^[a-z ,;.#$\/( )-_\d]{4,255}$/i';
						if(!preg_match($regex,$buyerAddress)) {
							$dbStatus = false;
							return array('status'=>$dbStatus);	
						}
					}
					if($buyerCity!='')
					{
						$regex =  '/^[a-z \d]{2,50}$/i';
						if(!preg_match($regex,$buyerCity)) {
							$dbStatus = false;
							return array('status'=>$dbStatus);
						}
					}
					if($buyerState!='')
					{
						$regex =  '/^[a-z \d]{2,50}$/i';
						if(!preg_match($regex,$buyerState)) {
							$dbStatus = false;
							return array('status'=>$dbStatus);
						}
					}
					if($buyerCountry!='')
					{
						$regex =  '/^[a-z \d]{2,50}$/i';
						if(!preg_match($regex,$buyerCountry)) {
							$dbStatus = false;
							return array('status'=>$dbStatus);
						}
					}

					if($buyerPinCode!='')
					{
						$regex = '/^[a-z\d]{4,8}$/i';
						if(!preg_match($regex,$buyerPinCode)) {
							$dbStatus = false;
							return array('status'=>$dbStatus);
						}
					}
					
					if($amount=='')
					{
						$dbStatus = false;
						return array('status'=>$dbStatus);	
					}
					else
					{
						$regex = '/^[0-9]{1,6}\.[0-9]{2,2}$/';
						if(!preg_match($regex,$amount)) {
							$dbStatus = false;
							return array('status'=>$dbStatus);	
						}
					}*/
				$output = array(
				'status' => $dbStatus,
				'msg' => $dbMessage,
				'privatekey' => $privatekey,
				'mercid' => $mercid,
				'orderid' => $orderid,
				'customvar' => $customvar,
				'chmod' => $hiddenmod,
				'pg_action_url' => $pg_action_url,
				'checksum' => $checksum,
				);
				//print_r($output);die;
				return $output;
			break;
			case 'get_post_payment_data_airpay':
				$dbStatus = TRUE;
				$dbMessage = "";
				$reg_user_id = '';
				$institute = '';
				$program_code = '';
				$seladmcode = '';
				$application_no = '';
				$order_number = '';
				//$program_code = $this->session->userdata('admcode');//ECHO 'DD'.$program_code;die;
				//$seladmcode = $this->session->userdata('admcode');//ECHO 'DD'.$program_code;die;
				//$reg_user_id = $this->session->userdata('reg_user_id');
				//$application_no = $this->session->userdata('appl_no');
				//$order_number = $this->session->userdata('order_number');
				//$amount = $this->session->userdata('app_fee');
				//$institute = $this->session->userdata('institute_code');
				if(isset($_POST) && $_POST["TRANSACTIONID"] != '' && $_POST["TRANSACTIONID"] != NULL){
					$order_number = $_POST["TRANSACTIONID"];
					$queryset = "SELECT b.`appl_no`, b.`reg_user_id`,c.`institute_code`,`applied_program` FROM 
								`applicant_form_online_deposit` a
								INNER JOIN `applicant_appl_overview`  b ON a.appl_no=b.appl_no
								INNER JOIN program_master c ON b.applied_program=c.program_code
								WHERE  order_number ='$order_number'";
					$res_data = $this->db->query($queryset);
					$query = $res_data->result_array();
					foreach($query as $row)
					{
						$reg_user_id = $row['reg_user_id'];
						$institute = $row['institute_code'];
						$program_code = $row['applied_program'];
						$seladmcode = $row['applied_program'];
						$application_no = $row['appl_no'];
					}
					
				}
				$this->session->set_userdata('appl_no', $application_no);
				$this->session->set_userdata('admcode', $program_code);
				$this->session->set_userdata('reg_user_id', $reg_user_id);
				//echo "hello",$reg_user_id,$institute,$program_code,$application_no;die;
				//hello 9040506551 TESTSC XIHUMN_TESTSC XIHUMN_TESTSC2022000006
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$date_time = date('Y-m-d H:i:s', now());
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$this->db->select('A.institute_code,B.institute_name,logo_url');
				$this->db->from('program_master A');
				$this->db->join('institute_master B','A.institute_code = B.institute_code','INNER');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$ins_name = $row['institute_name'];
					$ins_code = $row['institute_code'];
					$institute_logo = $row['logo_url'];
					$institute_logo = "../build/images/logo/".$institute_logo;
		        }
		      	$hex_ins_code =  encrypt_decrypt('encrypt', $ins_code);
			    
			    $applshow=0;
				$show=0;
				$print=0;
				$noamount=0;
				$showChallanInfo=0;
				$edit="false";
				$editappl="false";
		        
		        $this->db->select('A.template_code,B.template_name,file_name,program_name');
				$this->db->from('program_master A');
				$this->db->join('form_template_master B','A.template_code = B.template_code','INNER');
				$this->db->where('A.program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$temp_code = $row['template_code'];
		        	$program_name = $row['program_name'];
					$temp_name = explode(".",$row['file_name']);
					$file_name = $temp_name[0]."_pdf.php";
					$print_function = $temp_name[0]."_pdf";
		        }
		        
		        $this->db->select('appl_status');
				$this->db->from('applicant_appl_overview');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program_code);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$appl_status = '';
				foreach ($output_data as $row) 
		        {
		        	$appl_status = $row['appl_status'];
		        }
		        
				$payment_status = "";
				$payment_id = "";
				
				$transaction_number = '';
				$response_saved = FALSE; 
				$this->db->select('A.appl_no,B.reg_user_id,B.applied_program,A.transaction_number');
				$this->db->from('applicant_form_online_deposit A');
				$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no','LEFT');
				$this->db->where('A.order_number',$order_number);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
					$transaction_number = $row['transaction_number'];
		        }
				if($transaction_number != '')
				{
					$response_saved = TRUE;
				}
				
				$queryset2 = "SELECT pg_parameter_code, pg_parameter_value
							FROM pg_parameter_values
							WHERE pg_code = 'AIRPAY'
							AND school_code = '$institute'";
				$res_data2 = $this->db->query($queryset2);
				$query2 = $res_data2->result_array();
				foreach($query2 as $row)
				{
					$pg_parameter_values[$row['pg_parameter_code']] = $row['pg_parameter_value'];
				}
				
				$TRANSACTIONSTATUS  = trim($_POST['TRANSACTIONSTATUS']); 	
				if($TRANSACTIONSTATUS == 200)
				{
					$response_log = '';
					foreach($_POST as $post_key => $post_value)
					{
						$response_log .= '|'.$post_key."=>".$post_value;
					}
					if($response_saved == FALSE)
					{
							$TRANSACTIONID = trim($_POST['TRANSACTIONID']);
							$APTRANSACTIONID  = trim($_POST['APTRANSACTIONID']);
							$AMOUNT  = trim($_POST['AMOUNT']);
							$MESSAGE  = trim($_POST['MESSAGE']);
							$ap_SecureHash = trim($_POST['ap_SecureHash']); 
							$CUSTOMVAR  = trim($_POST['CUSTOMVAR']);
							
							$secret = $pg_parameter_values['SECRET'];
							$username = $pg_parameter_values['USERNAME'];
							$password = $pg_parameter_values['PASSWORD'];
							$mercid = $pg_parameter_values['MERCHANTID'];
							
							$merchant_secure_hash = sprintf("%u", crc32 ($TRANSACTIONID.':'.$APTRANSACTIONID.':'.$AMOUNT.':'.$TRANSACTIONSTATUS.':'.$MESSAGE.':'.$mercid.':'.$username));
							
							if($ap_SecureHash == $merchant_secure_hash)
							{
								$result =  $this->db->query("SELECT GET_LOCK('lockindexnumber',5) AS locked");
				                $query = $result->result_array();
				                foreach ($query as $row) 
				                {
				                   	$locked = $row['locked'];
				                }
				                if($locked == 1)
								{
									
									$this->db->select('A.program_code,A.year,sequence_code,sequence_no');
									$this->db->from('index_sequence_setup A');
									$this->db->where('A.program_code',$program_code);
									$result = $this->db->get();
									$output_data = $result->result_array();
									foreach ($output_data as $row1) 
							        {
							        	$year = $row1['year'];
										$year_str = substr($year,'-2');
										$sequence_no = $row1['sequence_no'];
										$key = $row1['sequence_code'];
							        }
									
									if($sequence_no < 10)
										$changed_sl_no = '00'.$sequence_no;
									else if($sequence_no < 100)
										$changed_sl_no = '0'.$sequence_no;
									else
										$changed_sl_no = $sequence_no;
										
									$index_no = $year_str.'/'.$key.'/'.$changed_sl_no;
									
									$new_seq_no = $sequence_no + 1;
									
									$this->db->select('index_no');
									$this->db->from('applicant_appl_overview');
									$this->db->where('index_no',$index_no);
									$this->db->where('applied_program',$program_code);
									$result = $this->db->get();
									$output_data = $result->result_array();
									$idx_found = '';
									foreach ($output_data as $row) 
							        {
							        	$idx_found = 1;
							        }
							        if($idx_found == '')
							        {
										$applicant_appl_overview = array(
											'sequence_no' => $new_seq_no
										);
										$this->db->where('program_code',$program_code);
										$regUpdate = $this->db->update('index_sequence_setup',$applicant_appl_overview);
										if(!$regUpdate){
											$dbStatus = FALSE;
										}
										
										$applicant_appl_overview_new = array(
											'index_no' => $index_no,
											'updated_by' => $reg_user_id,
											'updated_on' => $date_time
										);
										$this->db->where('appl_no',$application_no);
										$regUpdate = $this->db->update('applicant_appl_overview',$applicant_appl_overview_new);
									}
							        
								}
								$result =  $this->db->query("SELECT RELEASE_LOCK('lockindexnumber')");
								$payment_id = $APTRANSACTIONID;
								$SURCHARGE  = trim($_POST['SURCHARGE']);
								$paidAmount = $AMOUNT;
								$pg_log = $response_log;
								$total_paid_amount = $paidAmount;
								$payment_status = "SUCCESS";
								
								$this->db->trans_start();
								$applicant_form_fee_overview = array(
									'depositdate' => $date,
									'money_receipt_no' => $payment_id,
									'modified_by' => $reg_user_id,
									'modified_on' => $date
								);
								$this->db->where('appl_no',$application_no);
								$regUpdate = $this->db->update('applicant_form_fee_overview',$applicant_form_fee_overview);
								if(!$regUpdate){
									$dbStatus = FALSE;
								}
								else
								{
									$applicant_form_online_deposit = array(
										'sub_category' => '',
										'depositdate' => $date_time,
										'deposit_status' => $payment_status,
										'response_datetime' => $date_time,
										'transaction_number' => $payment_id,
										'updated_by' => $reg_user_id,
										'updated_on' => $date_time,
										'serverside_responce'=>$pg_log
									);
									$this->db->where('order_number',$order_number);
									$regUpdate1 = $this->db->update('applicant_form_online_deposit',$applicant_form_online_deposit);
									if(!$regUpdate1){
										$dbStatus = FALSE;
									}
									else
									{
										$applicant_appl_overview = array(
											'appl_status' => 'Verified',
											'updated_by' => $reg_user_id,
											'updated_on' => $date_time
										);
										$this->db->where('appl_no',$application_no);
										$regUpdate2 = $this->db->update('applicant_appl_overview',$applicant_appl_overview);
										if(!$regUpdate2){
											$dbStatus = FALSE;
										}
										
										$new_data = array(
											'id' 					=>NULL,
											'reg_user_id' 			=>$reg_user_id,
											'appl_no' 				=>$application_no,
											'form_no' 				=>$application_no,
											'applied_program' 		=>$program_code,
											'appl_status' 			=>'Verified',
											'created_by'			=>$reg_user_id,
											'created_on'			=>$date
										);
										$sql = $this->db->insert('applicant_appl_overview_history', $new_data);
										if(!$sql){
											$dbStatus = "FALSE";
											$dbMessage = "Error Inserting";
											$this->db->trans_rollback();
											//$dbError = ;	
										}
										else
										{
											$this->db->trans_complete();
											//5. COMMIt/ROLLBACK
											$email = '';
											$this->db->select('email_id');
											$this->db->from('applicant_reg_master');
											$this->db->where('reg_user_id',$reg_user_id);
											$this->db->where('applied_program',$program_code);
											
											$result = $this->db->get();
											$output_data = $result->result_array();
											foreach ($output_data as $row) 
									        {
									        	$email = $row['email_id'];
									        }
											$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
											$this->db->from('sms_provider_setup A');
											$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
											$this->db->where('B.record_status','1');
											$this->db->where('A.record_status','1');
											$this->db->where('B.sms_type','SUBMISSION OF APPLICATION');
											$this->db->where('B.status','ACTIVE');
											$result = $this->db->get();
											$output_data = $result->result_array();
											foreach ($output_data as $row1) 
											{
												$sms_url = $row1['sms_url'];
												$user_name = $row1['user_name'];
												$password = addslashes($row1['password']);
												$sender = $row1['sender'];
												$content = $row1['content'];
												$find = array("[mobile_no]", "[subject]");
												$replace = array($reg_user_id, $content);
												$new_sms_url = str_replace($find, $replace, $sms_url);//find and replace uid and pwd in url
												
												if($program_group == 'KG' || $program_group == 'PRIMARY' || $program_group == 'UKG' || $program_group == 'LKG' || $program_group == 'PRE SCHOOL' || $program_group == 'UPPER PRIMARY' || $program_group == 'SECONDARY'){
													$findappl = array("[program_code]","application","[applno]");
													$replaceappl = array($program_name,"index",$index_no);
													$index_data = '1';
												}
												else
												{
													$index_data = '';
													$findappl = array("[program_code]","[applno]");
													$replaceappl = array($program_name,$application_no);
												}
												$new_content = str_replace($findappl, $replaceappl, $content);
												$messageToSend = rawurlencode($new_content);
												//find replace url with mobileno and message
												$findmobileNo = array("[mobileno]","[message]","[username]","[password]","[sender]");
												$replacemobileNo = array($reg_user_id,$messageToSend,$user_name,$password,$sender);
												$smsURL = str_replace($findmobileNo,$replacemobileNo,$sms_url);	
												
											}
											$ch = curl_init($smsURL );
											curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
											$result = curl_exec($ch);
											curl_close($ch);
											$this->db->select('host_name , port_no,email_id,password,smtp_auth,smtp_secure');
											$this->db->from('email_provider_setup');
											$this->db->where('record_status','1');
											$this->db->limit('1');
											$result = $this->db->get();
											$query = $result->result_array();
											
											$row_count = $result->num_rows();
											foreach($result->result_array() AS $row1)
											{
												$host_name = $row1['host_name'];
												$port_no = $row1['port_no'];
												$email_id = $row1['email_id'];
												$password = $row1['password'];
												$smtp_auth = $row1['smtp_auth'];
												$smtp_secure = $row1['smtp_secure'];
											}
											
											$row_count = 0;
											$this->db->select('es.email_type,es.subject,es.content');
											$this->db->from('email_setup es');
											$this->db->join('program_email_setup pes','es.email_type = pes.email_type','inner');
											$this->db->where('es.email_type','SUBMISSION');
											$this->db->where('pes.institute_code',$ins_code);
											$this->db->limit('1');
											$result = $this->db->get();
											$query = $result->result_array();
											
											$row_count = $result->num_rows();
											foreach($result->result_array() AS $row1)
											{
												$email_type=$row1['email_type'];
												$subject=$row1['subject'];
												$content=$row1['content'];
											}
											if($ins_code == 'MIGTRA')
											{
												if($row_count > 0)
												{
													//echo 'hi';
													if($email != '')
													{
														$this->load->library('email');
														
														//$body = "You have successfully Registered with mobile no as $phone_no and date of birth as $dob for program.";
														$txtSubject = "Submission of Application";
														
														$config['protocol']    = 'smtp';
														$config['smtp_host']    = 'ssl://smtp.gmail.com';
														$config['smtp_port']    = $port_no;
														$config['smtp_timeout'] = '7';
														$config['smtp_user']    = $email_id;
														$config['smtp_pass']    = $password;
														$config['charset']    = 'utf-8';
														$config['newline']    = "\r\n";
														$config['mailtype'] = 'html'; // or text
														$config['validation'] = TRUE; // bool whether to validate email or not   
														$this->email->initialize($config);
														$this->email->from($email_id, 'IGTRA Admission');
														$this->email->to($email); 
														$this->email->subject($subject);
														$find = array("[name]","[course_name]");
														$replace = array($name,$program_name);
														$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url
														$this->email->message($email_content);
														$this->email->send();
													}
													
												}
											}
											$controllerInstance = & get_instance();
											$return = $controllerInstance->$print_function();
											//var_dump($return);die;
											if($return == true)
											{
												if(file_exists(DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$program_code.'/'.$application_no.'/application_print.pdf'))
												{
													$this->db->select("program_name"); 	
													$this->db->from("program_master"); 	
													$this->db->where('program_code ',$program_code);
													$result = $this->db->get();
													$output_data = $result->result_array();
													//echo $this->db->last_query();
													foreach($output_data as $row)
													{
														$program_name = $row['program_name'];
													}
													$pro_code = 'PROG_'.$ins_code;
													$this->db->select("email_id,first_name,mid_name,last_name"); 	
													$this->db->from("applicant_reg_master"); 	
													$this->db->where('reg_user_id ',$reg_user_id);
													$this->db->where('applied_program',$pro_code);
													$result = $this->db->get();
													$output_data = $result->result_array();
													//echo $this->db->last_query();
													foreach($output_data as $row)
													{
														$email = $row['email_id'];
														$first_name = $row['first_name'];
														$mid_name = $row['mid_name'];
														$last_name = $row['last_name'];
													}
													$name = $first_name.' '.$mid_name.' '.$last_name;
													
													
													
													$print = 1;
													$array['print'] = 1;
													$array['payment_id'] = $payment_id;
													$array['payment_status'] = $payment_status;
													$array['program_code'] = $program_code;
													$array['program_name'] = $program_name;
													$array['file_name'] = $file_name;
													return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
												}
												else
												{
													return array('status' => $dbStatus, 'msg' => $dbMessage);
												}
											}
											else
											{
												
												return array('status' => $dbStatus, 'msg' => $dbMessage);
											}
										}
									}
								}
								
								
								
							}
							else
							{
								$dbStatus = TRUE; 
								$array['print'] = 0;
								$array['payment_id'] = '';
								$array['payment_status'] = 'Hash validation failed';
								$array['program_code'] = $program_code;
								$array['program_name'] = $program_name;
								$array['file_name'] = '';
								return array('status' => $dbStatus, 'msg' => 'Hash validation failed','data' => $array);
							}
					}
					else
					{
						$dbStatus = TRUE; 
						$array['print'] = 1;
						$array['payment_id'] = $transaction_number;
						$array['payment_status'] = 'SUCCESS';
						$array['program_code'] = $program_code;
						$array['program_name'] = $program_name;
						$array['file_name'] = $file_name;
						return array('status' => $dbStatus, 'msg' => 'success','data' => $array);
					}
				}
				else
				{
					$dbStatus = TRUE; 
					$array['print'] = 0;
					$array['payment_id'] = '';
					$array['payment_status'] = 'Failure';
					$array['program_code'] = $program_code;
					$array['program_name'] = $program_name;
					$array['file_name'] = '';
					return array('status' => $dbStatus, 'msg' => 'Failure','data' => $array);
				}
				
				
			break;
			
			///AIRPAY END
			case 'get_post_payment_data_quikfee':
				//echo $data;
				//print_r($data);
				//die();
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$order_number = $this->session->userdata('order_number');
				$amount = $this->session->userdata('app_fee');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date('Y-m-d H:i:s', now());
        		//$strCurDate = date('d-m-Y');
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$this->db->select('A.institute_code,B.institute_name,logo_url,A.program_name');
				$this->db->from('program_master A');
				$this->db->join('institute_master B','A.institute_code = B.institute_code','INNER');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$ins_name = $row['institute_name'];
		        	$program_name = $row['program_name'];
					$ins_code = $row['institute_code'];
					$institute_logo = $row['logo_url'];
					$institute_logo = "../build/images/logo/".$institute_logo;
		        }
		        $hex_ins_code =  encrypt_decrypt('encrypt', $ins_code);
		        $applshow=0;
				$show=0;
				$print=0;
				$noamount=0;
				$showChallanInfo=0;
				$edit="false";
				$editappl="false";
		        
				$this->db->select('pg_parameter_code, pg_parameter_value');
				$this->db->from('pg_parameter_values');
				$this->db->where('pg_code','QUIKFEE');
				$this->db->where('school_code',$ins_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				$hashData = implode("|",$data);
				$data = explode('|',$hashData);
				$payment_status = explode('=',$data[0]);
				$payment_id = explode('=',$data[1]);
				$amount = explode('=',$data[3]);
				$fee_amount = $amount[1];
				$transaction_id = $payment_id[1];
				$payment_status_id = $payment_status[1];
				
				//die();
				if(isset($data))
				{
					
					if($payment_status_id == 'SUCCESS')
					{
							/*echo "hello";
							die();*/
						$payment_status = "SUCCESS";
						$payment_id = $transaction_id;
			
						$this->db->select('A.appl_no,B.reg_user_id,B.applied_program');
						$this->db->from('applicant_form_online_deposit A');
						$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no','INNER');
						$this->db->where('A.order_number',$order_number);
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach ($output_data as $row) 
				        {
				        	$appl_no = $row['appl_no'];
							$reg_user_id = $row['reg_user_id'];
							$applied_progam = $row['applied_program'];
							$program_code = $row['applied_program'];
				        }
			
				        $this->db->select('A.template_code,B.template_name,file_name');
						$this->db->from('program_master A');
						$this->db->join('form_template_master B','A.template_code = B.template_code','INNER');
						$this->db->where('A.program_code',$program_code);
						$result = $this->db->get();
						
						$output_data = $result->result_array();
						foreach ($output_data as $row) 
				        {
				        	$temp_code = $row['template_code'];
							$temp_name = explode(".",$row['file_name']);
							$file_name = $temp_name[0]."pdf.php";
							$print_function = $temp_name[0]."pdf";
				        }
				        
				        $this->db->select("reg_mode,email_id,last_grade,pin");
						$this->db->from('applicant_reg_master A');
						$this->db->join('applicant_master B','A.reg_user_id = B.reg_user_id AND A.applied_program =  B.applied_program','INNER');
						$this->db->where('A.reg_user_id',$reg_user_id);
						$this->db->where('A.applied_program',$program_code);
						$result = $this->db->get();
						//echo $this->db->last_query();
						$output_data = $result->result_array();
						$output = array("aaData" => array());
						foreach ($output_data as $row4) 
			            {
			            	$dbstatus = TRUE;
							//$Email = $row4['email_id'];
							//$pass_status = $row4['last_grade'];
							$pin = $row4['pin'];
			            }
	        			//echo $pin;
				        $this->db->select('appl_status');
						$this->db->from('applicant_appl_overview');
						$this->db->where('reg_user_id',$reg_user_id);
						$this->db->where('applied_program',$program_code);
						$this->db->where('STATUS','1');
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach ($output_data as $row) 
				        {
				        	$appl_status = $row['appl_status'];
				        }
						if($payment_status_id == 'SUCCESS')
						{
							
							$payment_id = $payment_id;
							
							$this->db->trans_start();
							$applicant_form_fee_overview = array(
								'depositdate' => $date,
								'money_receipt_no' => $payment_id,
								'modified_by' => $reg_user_id,
								'modified_on' => $date
							);
							$this->db->where('appl_no',$application_no);
							$regUpdate = $this->db->update('applicant_form_fee_overview',$applicant_form_fee_overview);
							if(!$regUpdate){
								$dbStatus = FALSE;
							}
							else
							{
								$applicant_form_online_deposit = array(
									'sub_category' => '',
									'depositdate' => $date,
									'deposit_status' => $payment_status,
									'response_datetime' => $date,
									'transaction_number' => $payment_id,
									'updated_by' => $reg_user_id,
									'updated_on' => $date
								);
								$this->db->where('order_number',$order_number);
								$regUpdate = $this->db->update('applicant_form_online_deposit',$applicant_form_online_deposit);
								if(!$regUpdate){
									$dbStatus = FALSE;
								}
								else
								{
									$applicant_appl_overview = array(
										'appl_status' => 'Verified',
										'updated_by' => $reg_user_id,
										'updated_on' => $now
									);
									$this->db->where('appl_no',$application_no);
									$regUpdate = $this->db->update('applicant_appl_overview',$applicant_appl_overview);
									if(!$regUpdate){
										$dbStatus = FALSE;
									}
									
									$new_data = array(
										'id' 					=>NULL,
										'reg_user_id' 			=>$reg_user_id,
										'appl_no' 				=>$application_no,
										'form_no' 				=>$application_no,
										'applied_program' 		=>$program_code,
										'appl_status' 			=>'Verified',
										'created_by'			=>$reg_user_id,
										'created_on'			=>$date
									);
									
									
									$sql = $this->db->insert('applicant_appl_overview_history', $new_data);
									//echo $this->db->last_query();
									if(!$sql){
										$dbStatus = "FALSE";
										$dbMessage = "Error Inserting";
										//$dbError = ;	
									}
									$this->db->select('index_no');
									$this->db->from('applicant_appl_overview');
									$this->db->where('appl_no',$application_no);
									$result = $this->db->get();
									$output_data = $result->result_array();
									foreach ($output_data as $row) 
							        {
							        	$index_no = $row['index_no'];
							        }
							        if($index_no == '')
									{
										$this->db->select('A.program_code,A.year,sequence_code,sequence_no');
										$this->db->from('index_sequence_setup A');
										$this->db->where('A.program_code',$program_code);
										$result = $this->db->get();
										$output_data = $result->result_array();
										foreach ($output_data as $row1) 
								        {
								        	$year = $row1['year'];
											$year_str = substr($year,'-2');
											$sequence_no = $row1['sequence_no'];
											$key = $row1['sequence_code'];
								        }
										
										if($sequence_no < 10)
											$changed_sl_no = '00'.$sequence_no;
										else if($sequence_no < 100)
											$changed_sl_no = '0'.$sequence_no;
										else
											$changed_sl_no = $sequence_no;
											
										$index_no = $year_str.'/'.$key.'/'.$changed_sl_no;
									}
									$applicant_appl_overview = array(
										'appl_status' => 'Verified',
										'index_no' => $index_no,
										'updated_by' => $reg_user_id,
										'updated_on' => $now
									);
									$this->db->where('appl_no',$application_no);
									$regUpdate = $this->db->update('applicant_appl_overview',$applicant_appl_overview);
									if(!$regUpdate){
										$dbStatus = FALSE;
									}
									else
									{
										
										$controllerInstance = & get_instance();
    									$return = $controllerInstance->$print_function();
										if($return == true)
										{
											if(file_exists(DOCUMENT_UPLOAD_URL.'/'.$program_code.'/'.$application_no.'/application_print_008.pdf'))
											{
												$new_seq_no = $sequence_no + 1;
												if($index == '')
												{
													$applicant_appl_overview = array(
														'sequence_no' => $new_seq_no
													);
													$this->db->where('program_code',$program_code);
													$regUpdate = $this->db->update('index_sequence_setup',$applicant_appl_overview);
													if(!$regUpdate){
														$dbStatus = FALSE;
													}
												}
												$this->db->select("program_name"); 	
												$this->db->from("program_master"); 	
												$this->db->where('program_code ',$program_code);
												$result = $this->db->get();
												$output_data = $result->result_array();
												//echo $this->db->last_query();
												foreach($output_data as $row)
												{
													$program_name = $row['program_name'];
												}
												
												$this->db->select("email_id,first_name,mid_name,last_name"); 	
												$this->db->from("applicant_reg_master"); 	
												$this->db->where('reg_user_id ',$reg_user_id);
												$result = $this->db->get();
												$output_data = $result->result_array();
												//echo $this->db->last_query();
												foreach($output_data as $row)
												{
													$email = $row['email_id'];
													$first_name = $row['first_name'];
													$mid_name = $row['mid_name'];
													$last_name = $row['last_name'];
												}
												$name = $first_name.' '.$mid_name.' '.$last_name;
												
												
												$this->db->select('host_name , port_no,email_id,password,smtp_auth,smtp_secure');
												$this->db->from('email_provider_setup');
												$this->db->where('record_status','1');
												$this->db->limit('1');
												$result = $this->db->get();
												$query = $result->result_array();
												
												$row_count = $result->num_rows();
												foreach($result->result_array() AS $row1)
												{
													$host_name = $row1['host_name'];
													$port_no = $row1['port_no'];
													$email_id = $row1['email_id'];
													$password = $row1['password'];
													$smtp_auth = $row1['smtp_auth'];
													$smtp_secure = $row1['smtp_secure'];
												}
												
												$this->db->select('es.email_type,es.subject,es.content');
												$this->db->from('email_setup es');
												$this->db->join('program_email_setup pes','es.email_type = pes.email_type','inner');
												$this->db->where('es.email_type','SUBMISSION');
												$this->db->where('pes.institute_code',HARDCODE_INSTITUTE_CODE);
												$this->db->limit('1');
												$result = $this->db->get();
												$query = $result->result_array();
												//echo $this->db->last_query();
												$row_count = $result->num_rows();
												foreach($result->result_array() AS $row1)
												{
													$email_type=$row1['email_type'];
													$subject=$row1['subject'];
													$content=$row1['content'];
												}
												$this->load->library('email');
													

												/*$body = "You have successfully Registered with mobile no as $phone_no and date of birth as $dob_mail for $admName program.";*/
												/*$txtSubject = "Registration Successful";*/
												
												//$find = array("[name]");
												//$replace = array($name);
												//$smsURL = str_replace($subject,$find,$replace);	
												
												$config['protocol']    = 'smtp';
												$config['smtp_host']    = 'ssl://smtp.gmail.com';
												$config['smtp_port']    = '465';
												$config['smtp_timeout'] = '10';
												$config['smtp_user']    = $email_id;
												$config['smtp_pass']    = $password;
												$config['charset']    = 'utf-8';
												$config['newline']    = "\r\n";
												$config['mailtype'] = 'html'; // or text
												$config['validation'] = TRUE; // bool whether to validate email or not   
												$this->email->initialize($config);
												$this->email->from($email_id, 'CIPET ADMISSION 2018');
												$this->email->to($email); 

												$this->email->subject($subject);
												
												$find = array("[name]", "[course_name]");
												$replace = array($name, $program_name);
												$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url

												$this->email->message($email_content);  

												//$this->email->send();
												//echo $this->email->print_debugger();;
												//print_r($this->email->send());
												//die();
												if($pin !='71717'){
													if($this->email->send()){
													$dbStatus = TRUE; 
													$dbMessage = 'A mail is forwarded to your registered mail id ';
													}
													else{
														$dbStatus = FALSE; 
														$dbMessage = 'Unable to sent Mail.Please Contact for Support';
														$this->email->print_debugger();
													}
												}
												
												
												$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
												$this->db->from('sms_provider_setup A');
												$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
												$this->db->where('B.record_status','1');
												$this->db->where('A.record_status','1');
												$this->db->where('B.sms_type','SUBMISSION OF APPLICATION');
												$this->db->where('B.status','ACTIVE');
												$result = $this->db->get();
												/*ECHO $this->db->last_query();
												die();*/
												$output_data = $result->result_array();
												foreach ($output_data as $row1) 
												{
													$sms_url = $row1['sms_url'];
													$user_name = $row1['user_name'];
													$password = addslashes($row1['password']);
													$sender = $row1['sender'];
													$content = $row1['content'];
													//$program = $row1['program_name'];
													//$institute_name = $row1['institute_name'];
													$find = array("[mobile_no]", "[subject]");
													$replace = array($phone_no, $content);
													$new_sms_url = str_replace($find, $replace, $sms_url);//find and replace uid and pwd in url
													
													if($program_name == 'Diploma in Plastics Mould Technology (DPMT)')
													{
														$program = 'DPMT';
													}
													else if($program_name == 'Postgraduate Diploma in Plastics Processing & Testing (PGD-PPT)')
													{
														$program = 'PGD-PPT';
													}
													else if($program_name == 'Post Diploma in Plastics Mould Design with CAD&sol;CAM (PD-PMD with CAD / CAM)')
													{
														$program = 'PD-PMD with CAD / CAM';
													}
													else if($program_name == 'Diploma in Plastics Technology (DPT)')
													{
														$program = 'DPT';
													}
													else if($program_name == 'Postgraduate Diploma in Plastics Testing and Quality Control (PGD-PTQC)')
													{
														$program = 'PGD-PTQC';
													}
													
													$findappl = array("[program_code]");
													$replaceappl = array($program);
													//echo $content."<br>";
													$new_content = str_replace($findappl, $replaceappl, $content);
													$messageToSend = rawurlencode($new_content);
													//echo $new_sms_url."<br>";
													//echo $new_content."<br>";
													//echo $messageToSend;
													
													//find replace url with mobileno and message
													$findmobileNo = array("[mobile_no]","[subject]");
													$replacemobileNo = array($reg_user_id,$messageToSend);
													$smsURL = str_replace($findmobileNo,$replacemobileNo,$sms_url);	
												}
												if($pin !='71717'){
													$done = file_get_contents($smsURL);
												}
												$this->db->trans_complete();
												$print = 1;
												$array['print'] = 1;
												$array['payment_id'] = $payment_id;
												$array['payment_status'] = $payment_status;
												$array['program_code'] = $program_code;
												$array['program_name'] = $program_name;
												return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
											}
											else
											{
												$this->db->trans_rollback();
												return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => '');
											}
										}
										else
										{
											$this->db->trans_rollback();
											return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => '');
										}
									}
								}
								
							}
						}
					}
					
				}
				else
				{
					echo '<h1>Error!</h1>';
					echo '<p>Invalid response</p>';
					exit;
				}
			break;
			case 'get_post_payment_data':
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');//ECHO 'DD'.$program_code;die;
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$order_number = $this->session->userdata('order_number');
				$amount = $this->session->userdata('app_fee');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$date_time = date('Y-m-d H:i:s', now());
        		//$strCurDate = date('d-m-Y');
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$this->db->select('A.institute_code,B.institute_name,logo_url');
				$this->db->from('program_master A');
				$this->db->join('institute_master B','A.institute_code = B.institute_code','INNER');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$ins_name = $row['institute_name'];
					$ins_code = $row['institute_code'];
					$institute_logo = $row['logo_url'];
					$institute_logo = "../build/images/logo/".$institute_logo;
		        }
		        $hex_ins_code =  encrypt_decrypt('encrypt', $ins_code);
		        $applshow=0;
				$show=0;
				$print=0;
				$noamount=0;
				$showChallanInfo=0;
				$edit="false";
				$editappl="false";
		        
		        $this->db->select('A.template_code,B.template_name,file_name');
				$this->db->from('program_master A');
				$this->db->join('form_template_master B','A.template_code = B.template_code','INNER');
				$this->db->where('A.program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$temp_code = $row['template_code'];
					$temp_name = explode(".",$row['file_name']);
					$file_name = $temp_name[0]."_pdf.php";
					$print_function = $temp_name[0]."_pdf";
		        }
		        
		        $this->db->select('appl_status');
				$this->db->from('applicant_appl_overview');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program_code);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$appl_status = $row['appl_status'];
		        }
		        

				$payment_status = "";
				$payment_id = "";
				
				$response = $_POST;
				//print_r($response);
				if(is_array($response)){
			        $str = $response['msg'];
			    }else if(is_string($response) && strstr($response, 'msg=')){
			        $outputStr = str_replace('msg=', '', $response);
			        $outputArr = explode('&', $outputStr);
			        $str = $outputArr[0];
			    }else {
			        $str = $response;
			    }
			    $transactionResponseBean = new TransactionResponseBean();
			    //echo $ins;
			 // echo  $ins_code;
			 // die();
			  //echo $str; die();
			    /*$this->db->select("pg_parameter_code, pg_parameter_value");
				$this->db->from('pg_parameter_values');
				$this->db->where('pg_code','TECHPROCESS');
				$this->db->where('school_code',$ins_code);
				$result = $this->db->get();
				$output_param = $result->result_array();
				foreach($output_param as $row){
					$pg_parameter_values[$row['pg_parameter_code']] = $row['pg_parameter_value'];
				}*/
				//print_r($pg_parameter_values);
			  //$key_i = '3398330990ARVIGY';
				//$iv_i = '2545346687TEBSMC';
				$key_i = '3311956426KGRMGO';
				$iv_i = '4690040130QNEPRR';
			    $transactionResponseBean->setResponsePayload($str);
			    
			    $transactionResponseBean->setKey($key_i);
			    $transactionResponseBean->setIv($iv_i);
				
			    $response = $transactionResponseBean->getResponsePayload();
			    $response;
			  //die();
			    $arr_res = explode("|", $response);
     			//update database
			    if($arr_res[1] == 'txn_msg=success')
			    	$payment_status = 'SUCCESS';
			    else
			    	$payment_status = 'FAILURE';
			    
			    $tpsl_txn_id = $arr_res[5];
			    $clnt_txn_ref = $arr_res[3];
				$id = explode('=', $clnt_txn_ref);
				$order_id = $id[1];
				//echo $order_id;
				$transaction_number = '';
				$response_saved = FALSE; 
				$this->db->select('A.appl_no,B.reg_user_id,B.applied_program,A.transaction_number');
				$this->db->from('applicant_form_online_deposit A');
				$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no','LEFT');
				$this->db->where('A.order_number',$order_id);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$program_code = $row['applied_program'];
					$reg_user_id = $row['reg_user_id'];
					$application_no = $row['appl_no'];
					$order_number = $order_id;
					$transaction_number = $row['transaction_number'];
		        }
				if($transaction_number != '')
					$response_saved = TRUE;
				
				$this->session->set_userdata('appl_no', $application_no);
				$this->session->set_userdata('admcode', $program_code);
				$this->session->set_userdata('reg_user_id', $reg_user_id);
				
				$this->db->select('A.institute_code,B.institute_name,logo_url');
				$this->db->from('program_master A');
				$this->db->join('institute_master B','A.institute_code = B.institute_code','INNER');
				$this->db->where('A.program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$ins_name = $row['institute_name'];
					$ins_code = $row['institute_code'];
					$institute_logo = $row['logo_url'];
					$institute_logo = "../build/images/logo/".$institute_logo;
		        }
		        $hex_ins_code =  encrypt_decrypt('encrypt', $ins_code);
		        $program_group = '';
		        $this->db->select('A.template_code,B.template_name,file_name,program_name,program_group');
				$this->db->from('program_master A');
				$this->db->join('form_template_master B','A.template_code = B.template_code','INNER');
				$this->db->where('A.program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$temp_code = $row['template_code'];
		        	$program_name = $row['program_name'];
		        	$program_group = $row['program_group'];
					$temp_name = explode(".",$row['file_name']);
					$file_name = $temp_name[0]."_pdf";
					$print_function = $temp_name[0]."_pdf";
		        }
				$this->db->select('appl_status');
				$this->db->from('applicant_appl_overview');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program_code);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$appl_status = $row['appl_status'];
		        }
				if($payment_status == 'SUCCESS')
				{
					if($response_saved == FALSE)
					{
						//1. generate index number
						$result =  $this->db->query("SELECT GET_LOCK('lockindexnumber',5) AS locked");
						//$res = $this->db->get();
		                $query = $result->result_array();
		                foreach ($query as $row) 
		                {
		                   	$locked = $row['locked'];
		                }
		                if($locked == 1)
						{
							$this->db->select('A.program_code,A.year,sequence_code,sequence_no');
							$this->db->from('index_sequence_setup A');
							$this->db->where('A.program_code',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							foreach ($output_data as $row1) 
					        {
					        	$year = $row1['year'];
								$year_str = substr($year,'-2');
								$sequence_no = $row1['sequence_no'];
								$key = $row1['sequence_code'];
					        }
							
							if($sequence_no < 10)
								$changed_sl_no = '00'.$sequence_no;
							else if($sequence_no < 100)
								$changed_sl_no = '0'.$sequence_no;
							else
								$changed_sl_no = $sequence_no;
								
							$index_no = $year_str.'/'.$key.'/'.$changed_sl_no;
							
							$new_seq_no = $sequence_no + 1;
							
							$this->db->select('index_no');
							$this->db->from('applicant_appl_overview');
							$this->db->where('index_no',$index_no);
							$this->db->where('applied_program',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$idx_found = '';
							foreach ($output_data as $row) 
					        {
					        	$idx_found = 1;
					        }
					        if($idx_found == '')
					        {
								$applicant_appl_overview = array(
									'sequence_no' => $new_seq_no
								);
								$this->db->where('program_code',$program_code);
								$regUpdate = $this->db->update('index_sequence_setup',$applicant_appl_overview);
								if(!$regUpdate){
									$dbStatus = FALSE;
								}
								
								$applicant_appl_overview_new = array(
									'index_no' => $index_no,
									'updated_by' => $reg_user_id,
									'updated_on' => $date_time
								);
								$this->db->where('appl_no',$application_no);
								$regUpdate = $this->db->update('applicant_appl_overview',$applicant_appl_overview_new);
							}
							
						}

						$result =  $this->db->query("SELECT RELEASE_LOCK('lockindexnumber')");
						
						//3. update payment table
						
						$x = explode('=', $tpsl_txn_id);
						$payment_id = $x[1];
						//2. BEGIN TRANS
						$this->db->trans_start();
						$applicant_form_fee_overview = array(
							'depositdate' => $date_time,
							'money_receipt_no' => $payment_id,
							'modified_by' => $reg_user_id,
							'modified_on' => $date_time
						);
						$this->db->where('appl_no',$application_no);
						$regUpdate = $this->db->update('applicant_form_fee_overview',$applicant_form_fee_overview);
						if(!$regUpdate){
							$dbStatus = FALSE;
						}
						else
						{
							$applicant_form_online_deposit = array(
								'sub_category' => '',
								'depositdate' => $date_time,
								'deposit_status' => $payment_status,
								'response_datetime' => $date_time,
								'transaction_number' => $payment_id,
								'updated_by' => $reg_user_id,
								'updated_on' => $date_time,
								'serverside_responce'=>$response
							);
							$this->db->where('order_number',$order_number);
							$regUpdate1 = $this->db->update('applicant_form_online_deposit',$applicant_form_online_deposit);
							if(!$regUpdate1){
								$dbStatus = FALSE;
							}
							else
							{
								$applicant_appl_overview = array(
									'appl_status' => 'Verified',
									'updated_by' => $reg_user_id,
									'updated_on' => $date_time
								);
								$this->db->where('appl_no',$application_no);
								$regUpdate2 = $this->db->update('applicant_appl_overview',$applicant_appl_overview);
								if(!$regUpdate2){
									$dbStatus = FALSE;
								}
								
								$new_data = array(
									'id' 					=>NULL,
									'reg_user_id' 			=>$reg_user_id,
									'appl_no' 				=>$application_no,
									'form_no' 				=>$application_no,
									'applied_program' 		=>$program_code,
									'appl_status' 			=>'Verified',
									'created_by'			=>$reg_user_id,
									'created_on'			=>$date
								);
								
								
								$sql = $this->db->insert('applicant_appl_overview_history', $new_data);
								//echo $this->db->last_query();
								if(!$sql){
									$dbStatus = "FALSE";
									$dbMessage = "Error Inserting";
									$this->db->trans_rollback();
									//$dbError = ;	
								}
								else
								{
									$this->db->trans_complete();
									//5. COMMIt/ROLLBACK
									$email = '';
									$this->db->select('email_id');
									$this->db->from('applicant_reg_master');
									$this->db->where('reg_user_id',$reg_user_id);
									$this->db->where('applied_program',$program_code);
									
									$result = $this->db->get();
									$output_data = $result->result_array();
									foreach ($output_data as $row) 
							        {
							        	$email = $row['email_id'];
							        }
									$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
									$this->db->from('sms_provider_setup A');
									$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
									$this->db->where('B.record_status','1');
									$this->db->where('A.record_status','1');
									$this->db->where('B.sms_type','SUBMISSION OF APPLICATION');
									$this->db->where('B.status','ACTIVE');
									$result = $this->db->get();
									$output_data = $result->result_array();
									foreach ($output_data as $row1) 
									{
										$sms_url = $row1['sms_url'];
										$user_name = $row1['user_name'];
										$password = addslashes($row1['password']);
										$sender = $row1['sender'];
										$content = $row1['content'];
										$find = array("[mobile_no]", "[subject]");
										$replace = array($reg_user_id, $content);
										$new_sms_url = str_replace($find, $replace, $sms_url);//find and replace uid and pwd in url
										
										if($program_group == 'KG' || $program_group == 'PRIMARY' || $program_group == 'UKG' || $program_group == 'LKG' || $program_group == 'PRE SCHOOL' || $program_group == 'UPPER PRIMARY' || $program_group == 'SECONDARY'){
											$findappl = array("[program_code]","application","[applno]");
											$replaceappl = array($program_name,"index",$index_no);
											$index_data = '1';
										}
										else
										{
											$index_data = '';
											$findappl = array("[program_code]","[applno]");
											$replaceappl = array($program_name,$application_no);
										}
										$new_content = str_replace($findappl, $replaceappl, $content);
										$messageToSend = rawurlencode($new_content);
										//find replace url with mobileno and message
										$findmobileNo = array("[mobileno]","[message]","[username]","[password]","[sender]");
										$replacemobileNo = array($reg_user_id,$messageToSend,$user_name,$password,$sender);
										$smsURL = str_replace($findmobileNo,$replacemobileNo,$sms_url);	
										
									}
									$ch = curl_init($smsURL );
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
									$result = curl_exec($ch);
									curl_close($ch);
									$this->db->select('host_name , port_no,email_id,password,smtp_auth,smtp_secure');
									$this->db->from('email_provider_setup');
									$this->db->where('record_status','1');
									$this->db->limit('1');
									$result = $this->db->get();
									$query = $result->result_array();
									
									$row_count = $result->num_rows();
									foreach($result->result_array() AS $row1)
									{
										$host_name = $row1['host_name'];
										$port_no = $row1['port_no'];
										$email_id = $row1['email_id'];
										$password = $row1['password'];
										$smtp_auth = $row1['smtp_auth'];
										$smtp_secure = $row1['smtp_secure'];
									}
									
									$row_count = 0;
									$this->db->select('es.email_type,es.subject,es.content');
									$this->db->from('email_setup es');
									$this->db->join('program_email_setup pes','es.email_type = pes.email_type','inner');
									$this->db->where('es.email_type','SUBMISSION');
									$this->db->where('pes.institute_code',$ins_code);
									$this->db->limit('1');
									$result = $this->db->get();
									$query = $result->result_array();
									
									$row_count = $result->num_rows();
									foreach($result->result_array() AS $row1)
									{
										$email_type=$row1['email_type'];
										$subject=$row1['subject'];
										$content=$row1['content'];
									}
									if($ins_code == 'MIGTRA')
									{
										if($row_count > 0)
										{
											//echo 'hi';
											if($email != '')
											{
												$this->load->library('email');
												
												//$body = "You have successfully Registered with mobile no as $phone_no and date of birth as $dob for program.";
												$txtSubject = "Submission of Application";
												
												$config['protocol']    = 'smtp';
												$config['smtp_host']    = 'ssl://smtp.gmail.com';
												$config['smtp_port']    = $port_no;
												$config['smtp_timeout'] = '7';
												$config['smtp_user']    = $email_id;
												$config['smtp_pass']    = $password;
												$config['charset']    = 'utf-8';
												$config['newline']    = "\r\n";
												$config['mailtype'] = 'html'; // or text
												$config['validation'] = TRUE; // bool whether to validate email or not   
												$this->email->initialize($config);
												$this->email->from($email_id, 'IGTRA Admission');
												$this->email->to($email); 

												$this->email->subject($subject);
												$find = array("[name]","[course_name]");
												$replace = array($name,$program_name);
												$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url

												$this->email->message($email_content);
												//$this->email->message($body);  

												$this->email->send();

												
												/*if($this->email->send()){
												    $dbStatus = TRUE; 
												    $dbMessage = 'A mail is forwarded to your registered mail id  ';
											    }
											    else{
												    $dbStatus = FALSE; 
												    $dbMessage = 'Unable to sent Mail.Please Contact for Support';
											    }*/
											}
											/*if($email != '')
											{
												$this->load->library('email');

												//$email_id
												$config['protocol']    = 'smtp';
												$config['smtp_host']    = 'smtp.gmail.com';  //$host_name; //'smtp.gmail.com'; //'ssl://smtp.gmail.com';
												$config['smtp_port']    = '465'; //$port_no; //'465';
												$config['smtp_timeout'] = '50';
												$config['smtp_user']    =  "testedusols@gmail.com"; //$email_id;// "testedusols@gmail.com";
												$config['smtp_pass']    = "edusols12345"; //$password; //"edusols12345";
												$config['charset']    = 'utf-8';
												$config['newline']    = "\r\n";
												$config['mailtype'] = 'html'; // or text
												$config['validation'] = TRUE; // bool whether to validate email or not   
												$this->email->initialize($config);
												//$this->email->from($email_id, 'REGISTRATION 2018');
												$this->email->from("testedusols@gmail.com", 'REGISTRATION 2018');
												$this->email->to($email); 

												$this->email->subject($subject);
												
												$find = array("[name]","[phone_no]","[dob]");
												$replace = array($name,$phone_no,$dob_mail);
												$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url

												$this->email->message($email_content);  

												//$this->email->send();
												print_r($this->email->send());
												//die();
												if($this->email->send()){
												    $dbStatus = TRUE; 
												    $dbMessage = 'A mail is forwarded to your registered mail id ';
											    }
											    else{
												    $dbStatus = FALSE; 
												    $dbMessage = 'Unable to sent Mail.Please Contact for Support';
													$this->email->print_debugger();
											    }
											  //  echo $dbStatus ; die();
											}*/
										}
									}
									$controllerInstance = & get_instance();
									$return = $controllerInstance->$print_function();
									//var_dump($return);die;
									if($return == true)
									{
										if(file_exists(DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$program_code.'/'.$application_no.'/application_print.pdf'))
										{
											$this->db->select("program_name"); 	
											$this->db->from("program_master"); 	
											$this->db->where('program_code ',$program_code);
											$result = $this->db->get();
											$output_data = $result->result_array();
											//echo $this->db->last_query();
											foreach($output_data as $row)
											{
												$program_name = $row['program_name'];
											}
											$pro_code = 'PROG_'.$ins_code;
											$this->db->select("email_id,first_name,mid_name,last_name"); 	
											$this->db->from("applicant_reg_master"); 	
											$this->db->where('reg_user_id ',$reg_user_id);
											$this->db->where('applied_program',$pro_code);
											$result = $this->db->get();
											$output_data = $result->result_array();
											//echo $this->db->last_query();
											foreach($output_data as $row)
											{
												$email = $row['email_id'];
												$first_name = $row['first_name'];
												$mid_name = $row['mid_name'];
												$last_name = $row['last_name'];
											}
											$name = $first_name.' '.$mid_name.' '.$last_name;
											
											
											
											$print = 1;
											$array['print'] = 1;
											$array['payment_id'] = $payment_id;
											$array['payment_status'] = $payment_status;
											$array['program_code'] = $program_code;
											$array['program_name'] = $program_name;
											$array['file_name'] = $file_name;
													return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
											//$print = 1;
											return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
										}
										else
										{
											return array('status' => $dbStatus, 'msg' => $dbMessage);
										}
									}
									else
									{
										
										return array('status' => $dbStatus, 'msg' => $dbMessage);
									}
								}
							}
							
						}
					}
					else
					{
						$dbStatus = TRUE; 
						$array['print'] = 1;
						$array['payment_id'] = $transaction_number;
						$array['payment_status'] = 'SUCCESS';
						$array['program_code'] = $program_code;
						$array['program_name'] = $program_name;
						$array['file_name'] = $file_name;
						return array('status' => $dbStatus, 'msg' => 'success','data' => $array);
					}
				}
				else
				{
					$dbStatus = TRUE; 
					$array['print'] = 0;
					$array['payment_id'] = '';
					$array['payment_status'] = 'Failure';
					$array['program_code'] = $program_code;
					$array['program_name'] = $program_name;
					$array['file_name'] = '';
					return array('status' => $dbStatus, 'msg' => 'Failure','data' => $array);
				}
			break;
			case 'get_post_payment_data_st':
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$order_number = $this->session->userdata('order_number');
				$amount = $this->session->userdata('app_fee');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$date_time = date('Y-m-d H:i:s', now());
        		//$strCurDate = date('d-m-Y');
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$this->db->select('A.institute_code,B.institute_name,logo_url');
				$this->db->from('program_master A');
				$this->db->join('institute_master B','A.institute_code = B.institute_code','INNER');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$ins_name = $row['institute_name'];
					$ins_code = $row['institute_code'];
					$institute_logo = $row['logo_url'];
					$institute_logo = "../build/images/logo/".$institute_logo;
		        }
		        $hex_ins_code =  encrypt_decrypt('encrypt', $ins_code);
		        $applshow=0;
				$show=0;
				$print=0;
				$noamount=0;
				$showChallanInfo=0;
				$edit="false";
				$editappl="false";
		        
		        $this->db->select('A.template_code,B.template_name,file_name');
				$this->db->from('program_master A');
				$this->db->join('form_template_master B','A.template_code = B.template_code','INNER');
				$this->db->where('A.program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$temp_code = $row['template_code'];
					$temp_name = explode(".",$row['file_name']);
					$file_name = $temp_name[0]."_pdf.php";
					$print_function = $temp_name[0]."_pdf";
		        }
		        
		        $this->db->select('appl_status');
				$this->db->from('applicant_appl_overview');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program_code);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$appl_status = $row['appl_status'];
		        }
		        

				$payment_status = "";
				$payment_id = "";
				
				$response = $_POST;
				//print_r($response);
				if(is_array($response)){
			        $str = $response['msg'];
			    }else if(is_string($response) && strstr($response, 'msg=')){
			        $outputStr = str_replace('msg=', '', $response);
			        $outputArr = explode('&', $outputStr);
			        $str = $outputArr[0];
			    }else {
			        $str = $response;
			    }
			    $transactionResponseBean = new TransactionResponseBean();
			    //echo $ins;
			  //echo  $ins_code;
			  //die();
			  //echo $str; die();
			    /*$this->db->select("pg_parameter_code, pg_parameter_value");
				$this->db->from('pg_parameter_values');
				$this->db->where('pg_code','TECHPROCESS');
				$this->db->where('school_code',$ins_code);
				$result = $this->db->get();
				$output_param = $result->result_array();
				foreach($output_param as $row){
					$pg_parameter_values[$row['pg_parameter_code']] = $row['pg_parameter_value'];
				}*/
				//print_r($pg_parameter_values);
				$key_i = '3311956426KGRMGO';
				$iv_i = '4690040130QNEPRR';
			    $transactionResponseBean->setResponsePayload($str);
			    
			    $transactionResponseBean->setKey($key_i);
			    $transactionResponseBean->setIv($iv_i);
				
			    $response = $transactionResponseBean->getResponsePayload();
			    $response;
			  //die();
			    $arr_res = explode("|", $response);
     			//update database
			    if($arr_res[1] == 'txn_msg=success')
			    	$payment_status = 'SUCCESS';
			    else
			    	$payment_status = 'FAILURE';
			    
			    $tpsl_txn_id = $arr_res[5];
			    $clnt_txn_ref = $arr_res[3];
				$id = explode('=', $clnt_txn_ref);
				$order_id = $id[1];
				//echo $order_id;
				$transaction_number = '';
				$response_saved = FALSE; 
				$this->db->select('A.appl_no,B.reg_user_id,B.applied_program,A.transaction_number');
				$this->db->from('applicant_form_online_deposit A');
				$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no','LEFT');
				$this->db->where('A.order_number',$order_id);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$program_code = $row['applied_program'];
					$reg_user_id = $row['reg_user_id'];
					$application_no = $row['appl_no'];
					$order_number = $order_id;
					$transaction_number = $row['transaction_number'];
		        }
				if($transaction_number != '')
					$response_saved = TRUE;
				
				$this->session->set_userdata('appl_no', $application_no);
				$this->session->set_userdata('admcode', $program_code);
				$this->session->set_userdata('reg_user_id', $reg_user_id);
				
				$this->db->select('A.institute_code,B.institute_name,logo_url');
				$this->db->from('program_master A');
				$this->db->join('institute_master B','A.institute_code = B.institute_code','INNER');
				$this->db->where('A.program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$ins_name = $row['institute_name'];
					$ins_code = $row['institute_code'];
					$institute_logo = $row['logo_url'];
					$institute_logo = "../build/images/logo/".$institute_logo;
		        }
		        $hex_ins_code =  encrypt_decrypt('encrypt', $ins_code);
		        $program_group = '';
		        $this->db->select('A.template_code,B.template_name,file_name,program_name,program_group');
				$this->db->from('program_master A');
				$this->db->join('form_template_master B','A.template_code = B.template_code','INNER');
				$this->db->where('A.program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$temp_code = $row['template_code'];
		        	$program_name = $row['program_name'];
		        	$program_group = $row['program_group'];
					$temp_name = explode(".",$row['file_name']);
					$file_name = $temp_name[0]."_pdf";
					$print_function = $temp_name[0]."_pdf";
		        }
				$this->db->select('appl_status');
				$this->db->from('applicant_appl_overview');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program_code);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$appl_status = $row['appl_status'];
		        }
				if($payment_status == 'SUCCESS')
				{
					if($response_saved == FALSE)
					{
						//1. generate index number
						$result =  $this->db->query("SELECT GET_LOCK('lockindexnumber',5) AS locked");
						//$res = $this->db->get();
		                $query = $result->result_array();
		                foreach ($query as $row) 
		                {
		                   	$locked = $row['locked'];
		                }
		                if($locked == 1)
						{
							$this->db->select('A.program_code,A.year,sequence_code,sequence_no');
							$this->db->from('index_sequence_setup A');
							$this->db->where('A.program_code',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							foreach ($output_data as $row1) 
					        {
					        	$year = $row1['year'];
								$year_str = substr($year,'-2');
								$sequence_no = $row1['sequence_no'];
								$key = $row1['sequence_code'];
					        }
							
							if($sequence_no < 10)
								$changed_sl_no = '00'.$sequence_no;
							else if($sequence_no < 100)
								$changed_sl_no = '0'.$sequence_no;
							else
								$changed_sl_no = $sequence_no;
								
							$index_no = $year_str.'/'.$key.'/'.$changed_sl_no;
							
							$new_seq_no = $sequence_no + 1;
							
							$this->db->select('index_no');
							$this->db->from('applicant_appl_overview');
							$this->db->where('index_no',$index_no);
							$this->db->where('applied_program',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$idx_found = '';
							foreach ($output_data as $row) 
					        {
					        	$idx_found = 1;
					        }
					        if($idx_found == '')
					        {
								$applicant_appl_overview = array(
									'sequence_no' => $new_seq_no
								);
								$this->db->where('program_code',$program_code);
								$regUpdate = $this->db->update('index_sequence_setup',$applicant_appl_overview);
								if(!$regUpdate){
									$dbStatus = FALSE;
								}
								
								$applicant_appl_overview_new = array(
									'index_no' => $index_no,
									'updated_by' => $reg_user_id,
									'updated_on' => $date_time
								);
								$this->db->where('appl_no',$application_no);
								$regUpdate = $this->db->update('applicant_appl_overview',$applicant_appl_overview_new);
							}
							
						}

						$result =  $this->db->query("SELECT RELEASE_LOCK('lockindexnumber')");
						
						//3. update payment table
						
						$x = explode('=', $tpsl_txn_id);
						$payment_id = $x[1];
						//2. BEGIN TRANS
						$this->db->trans_start();
						$applicant_form_fee_overview = array(
							'depositdate' => $date_time,
							'money_receipt_no' => $payment_id,
							'modified_by' => $reg_user_id,
							'modified_on' => $date_time
						);
						$this->db->where('appl_no',$application_no);
						$regUpdate = $this->db->update('applicant_form_fee_overview',$applicant_form_fee_overview);
						if(!$regUpdate){
							$dbStatus = FALSE;
						}
						else
						{
							$applicant_form_online_deposit = array(
								'sub_category' => '',
								'depositdate' => $date_time,
								'deposit_status' => $payment_status,
								'response_datetime' => $date_time,
								'transaction_number' => $payment_id,
								'updated_by' => $reg_user_id,
								'updated_on' => $date_time,
								'serverside_responce'=>$response
							);
							$this->db->where('order_number',$order_number);
							$regUpdate1 = $this->db->update('applicant_form_online_deposit',$applicant_form_online_deposit);
							if(!$regUpdate1){
								$dbStatus = FALSE;
							}
							else
							{
								$applicant_appl_overview = array(
									'appl_status' => 'Verified',
									'updated_by' => $reg_user_id,
									'updated_on' => $date_time
								);
								$this->db->where('appl_no',$application_no);
								$regUpdate2 = $this->db->update('applicant_appl_overview',$applicant_appl_overview);
								if(!$regUpdate2){
									$dbStatus = FALSE;
								}
								
								$new_data = array(
									'id' 					=>NULL,
									'reg_user_id' 			=>$reg_user_id,
									'appl_no' 				=>$application_no,
									'form_no' 				=>$application_no,
									'applied_program' 		=>$program_code,
									'appl_status' 			=>'Verified',
									'created_by'			=>$reg_user_id,
									'created_on'			=>$date
								);
								
								
								$sql = $this->db->insert('applicant_appl_overview_history', $new_data);
								//echo $this->db->last_query();
								if(!$sql){
									$dbStatus = "FALSE";
									$dbMessage = "Error Inserting";
									$this->db->trans_rollback();
									//$dbError = ;	
								}
								else
								{
									$this->db->trans_complete();
									//5. COMMIt/ROLLBACK
									$email = '';
									$this->db->select('email_id');
									$this->db->from('applicant_reg_master');
									$this->db->where('reg_user_id',$reg_user_id);
									$this->db->where('applied_program',$program_code);
									
									$result = $this->db->get();
									$output_data = $result->result_array();
									foreach ($output_data as $row) 
							        {
							        	$email = $row['email_id'];
							        }
									$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
									$this->db->from('sms_provider_setup A');
									$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
									$this->db->where('B.record_status','1');
									$this->db->where('A.record_status','1');
									$this->db->where('B.sms_type','SUBMISSION OF APPLICATION');
									$this->db->where('B.status','ACTIVE');
									$result = $this->db->get();
									$output_data = $result->result_array();
									foreach ($output_data as $row1) 
									{
										$sms_url = $row1['sms_url'];
										$user_name = $row1['user_name'];
										$password = addslashes($row1['password']);
										$sender = $row1['sender'];
										$content = $row1['content'];
										$find = array("[mobile_no]", "[subject]");
										$replace = array($reg_user_id, $content);
										$new_sms_url = str_replace($find, $replace, $sms_url);//find and replace uid and pwd in url
										
										if($program_group == 'KG' || $program_group == 'PRIMARY' || $program_group == 'UKG' || $program_group == 'LKG' || $program_group == 'PRE SCHOOL' || $program_group == 'UPPER PRIMARY' || $program_group == 'SECONDARY'){
											$findappl = array("[program_code]","application","[applno]");
											$replaceappl = array($program_name,"index",$index_no);
											$index_data = '1';
										}
										else
										{
											$index_data = '';
											$findappl = array("[program_code]","[applno]");
											$replaceappl = array($program_name,$application_no);
										}
										$new_content = str_replace($findappl, $replaceappl, $content);
										$messageToSend = rawurlencode($new_content);
										//find replace url with mobileno and message
										$findmobileNo = array("[mobileno]","[message]","[username]","[password]","[sender]");
										$replacemobileNo = array($reg_user_id,$messageToSend,$user_name,$password,$sender);
										$smsURL = str_replace($findmobileNo,$replacemobileNo,$sms_url);	
										
									}
									$ch = curl_init($smsURL );
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
									$result = curl_exec($ch);
									curl_close($ch);
									$this->db->select('host_name , port_no,email_id,password,smtp_auth,smtp_secure');
									$this->db->from('email_provider_setup');
									$this->db->where('record_status','1');
									$this->db->limit('1');
									$result = $this->db->get();
									$query = $result->result_array();
									
									$row_count = $result->num_rows();
									foreach($result->result_array() AS $row1)
									{
										$host_name = $row1['host_name'];
										$port_no = $row1['port_no'];
										$email_id = $row1['email_id'];
										$password = $row1['password'];
										$smtp_auth = $row1['smtp_auth'];
										$smtp_secure = $row1['smtp_secure'];
									}
									
									$row_count = 0;
									$this->db->select('es.email_type,es.subject,es.content');
									$this->db->from('email_setup es');
									$this->db->join('program_email_setup pes','es.email_type = pes.email_type','inner');
									$this->db->where('es.email_type','SUBMISSION');
									$this->db->where('pes.institute_code',$ins_code);
									$this->db->limit('1');
									$result = $this->db->get();
									$query = $result->result_array();
									
									$row_count = $result->num_rows();
									foreach($result->result_array() AS $row1)
									{
										$email_type=$row1['email_type'];
										$subject=$row1['subject'];
										$content=$row1['content'];
									}
									if($ins_code == 'MIGTRA')
									{
										if($row_count > 0)
										{
											//echo 'hi';
											if($email != '')
											{
												$this->load->library('email');
												
												//$body = "You have successfully Registered with mobile no as $phone_no and date of birth as $dob for program.";
												$txtSubject = "Submission of Application";
												
												$config['protocol']    = 'smtp';
												$config['smtp_host']    = 'ssl://smtp.gmail.com';
												$config['smtp_port']    = $port_no;
												$config['smtp_timeout'] = '7';
												$config['smtp_user']    = $email_id;
												$config['smtp_pass']    = $password;
												$config['charset']    = 'utf-8';
												$config['newline']    = "\r\n";
												$config['mailtype'] = 'html'; // or text
												$config['validation'] = TRUE; // bool whether to validate email or not   
												$this->email->initialize($config);
												$this->email->from($email_id, 'IGTRA Admission');
												$this->email->to($email); 

												$this->email->subject($subject);
												$find = array("[name]","[course_name]");
												$replace = array($name,$program_name);
												$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url

												$this->email->message($email_content);
												//$this->email->message($body);  

												$this->email->send();

												
												/*if($this->email->send()){
												    $dbStatus = TRUE; 
												    $dbMessage = 'A mail is forwarded to your registered mail id  ';
											    }
											    else{
												    $dbStatus = FALSE; 
												    $dbMessage = 'Unable to sent Mail.Please Contact for Support';
											    }*/
											}
											/*if($email != '')
											{
												$this->load->library('email');

												//$email_id
												$config['protocol']    = 'smtp';
												$config['smtp_host']    = 'smtp.gmail.com';  //$host_name; //'smtp.gmail.com'; //'ssl://smtp.gmail.com';
												$config['smtp_port']    = '465'; //$port_no; //'465';
												$config['smtp_timeout'] = '50';
												$config['smtp_user']    =  "testedusols@gmail.com"; //$email_id;// "testedusols@gmail.com";
												$config['smtp_pass']    = "edusols12345"; //$password; //"edusols12345";
												$config['charset']    = 'utf-8';
												$config['newline']    = "\r\n";
												$config['mailtype'] = 'html'; // or text
												$config['validation'] = TRUE; // bool whether to validate email or not   
												$this->email->initialize($config);
												//$this->email->from($email_id, 'REGISTRATION 2018');
												$this->email->from("testedusols@gmail.com", 'REGISTRATION 2018');
												$this->email->to($email); 

												$this->email->subject($subject);
												
												$find = array("[name]","[phone_no]","[dob]");
												$replace = array($name,$phone_no,$dob_mail);
												$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url

												$this->email->message($email_content);  

												//$this->email->send();
												print_r($this->email->send());
												//die();
												if($this->email->send()){
												    $dbStatus = TRUE; 
												    $dbMessage = 'A mail is forwarded to your registered mail id ';
											    }
											    else{
												    $dbStatus = FALSE; 
												    $dbMessage = 'Unable to sent Mail.Please Contact for Support';
													$this->email->print_debugger();
											    }
											  //  echo $dbStatus ; die();
											}*/
										}
									}
									$controllerInstance = & get_instance();
									$return = $controllerInstance->$print_function();
									if($return == true)
									{
										if(file_exists(DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$program_code.'/'.$application_no.'/application_print.pdf'))
										{
											$this->db->select("program_name"); 	
											$this->db->from("program_master"); 	
											$this->db->where('program_code ',$program_code);
											$result = $this->db->get();
											$output_data = $result->result_array();
											//echo $this->db->last_query();
											foreach($output_data as $row)
											{
												$program_name = $row['program_name'];
											}
											$pro_code = 'PROG_'.$ins_code;
											$this->db->select("email_id,first_name,mid_name,last_name"); 	
											$this->db->from("applicant_reg_master"); 	
											$this->db->where('reg_user_id ',$reg_user_id);
											$this->db->where('applied_program',$pro_code);
											$result = $this->db->get();
											$output_data = $result->result_array();
											//echo $this->db->last_query();
											foreach($output_data as $row)
											{
												$email = $row['email_id'];
												$first_name = $row['first_name'];
												$mid_name = $row['mid_name'];
												$last_name = $row['last_name'];
											}
											$name = $first_name.' '.$mid_name.' '.$last_name;
											
											
											
											$print = 1;
											$array['print'] = 1;
											$array['payment_id'] = $payment_id;
											$array['payment_status'] = $payment_status;
											$array['program_code'] = $program_code;
											$array['program_name'] = $program_name;
											$array['file_name'] = $file_name;
													return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
											//$print = 1;
											return array('status' => $dbStatus, 'msg' => $dbMessage,'data' => $array);
										}
										else
										{
											return array('status' => $dbStatus, 'msg' => $dbMessage);
										}
									}
									else
									{
										
										return array('status' => $dbStatus, 'msg' => $dbMessage);
									}
								}
							}
							
						}
					}
					else
					{
						$dbStatus = TRUE; 
						$array['print'] = 1;
						$array['payment_id'] = $transaction_number;
						$array['payment_status'] = 'SUCCESS';
						$array['program_code'] = $program_code;
						$array['program_name'] = $program_name;
						$array['file_name'] = $file_name;
						return array('status' => $dbStatus, 'msg' => 'success','data' => $array);
					}
				}
				else
				{
					$dbStatus = TRUE; 
					$array['print'] = 0;
					$array['payment_id'] = '';
					$array['payment_status'] = 'Failure';
					$array['program_code'] = $program_code;
					$array['program_name'] = $program_name;
					$array['file_name'] = '';
					return array('status' => $dbStatus, 'msg' => 'Failure','data' => $array);
				}
			break;
			case 'billdesk_payment_response':
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$order_number = $this->session->userdata('order_number');
				//$order_number = 'NIRPROG1NIRTAR1811';
				$amount = $this->session->userdata('app_fee');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date('Y-m-d H:i:s', now());
        		//$strCurDate = date('d-m-Y');
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
		        $hex_ins_code =  encrypt_decrypt('encrypt', $ins);
		        $applshow=0;
				$show=0;
				$print=0;
				$noamount=0;
				$showChallanInfo=0;
				$edit="false";
				$editappl="false";
		        
		      		        
		        $this->db->select('appl_status');
				$this->db->from('applicant_appl_overview');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program_code);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$appl_status = $row['appl_status'];
		        }
		        

				$payment_status = "";
				$payment_id = "";
				
				$response = $_POST;
				$str = $response['msg'];
			    
			    
			    $arr_res = explode("|", $str);
			    
     			
			    /*$tpsl_txn_id = $arr_res[5];
			    $clnt_txn_ref = $arr_res[3];
				$id = explode('=', $tpsl_txn_id);*/
				$order_id = $arr_res[16];
				$this->db->select('pg_parameter_value');
				$this->db->from('pg_parameter_values');
				$this->db->where('pg_code','BILLDESK');
				$this->db->where('pg_parameter_code','CHECKSUMKEY');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$pg_parameter_value = $row['pg_parameter_value'];
					//$order_number = $order_id;
		        }
		        $str1 = implode("|",array_slice($arr_res,0,25));
		        $calculated_checksum = strtoupper(hash_hmac('sha256',$str1,$pg_parameter_value, false)); 
		        if($arr_res[25]!=$calculated_checksum){
					return array('status' => false, 'msg' => 'Invalid merchant-Id');
				}
				
				/*$this->db->select('A.appl_no,B.reg_user_id,B.applied_program');
				$this->db->from('applicant_form_online_deposit A');
				$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no','LEFT');
				$this->db->where('A.order_number',$order_id);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$seladmcode = $row['applied_program'];
					$reg_user_id = $row['reg_user_id'];
					$application_no = $row['appl_no'];
					//$order_number = $order_id;
		        }*/
				$merchat_id = $arr_res[0];
				$customer_id = $arr_res[1];//application number(appl_no)
				$txn_ref_number = $arr_res[2];
				$bank_ref_number = $arr_res[3];
				$txn_amount = $arr_res[4];
				$bank_id = $arr_res[5];
				$bank_merchant_id = $arr_res[6];
				$txn_type = $arr_res[7];
				$currency_name = $arr_res[8];
				$item_code = $arr_res[9];
				$security_type = '';
				$security_id = $arr_res[10];
				$auth_status = $arr_res[14];
				$txt_date = $arr_res[13];
				$pg_onlinepayment_transaction_number = $arr_res[16];
				$online_transaction_remark = $arr_res[24];
				//update database
			    if($auth_status == '0300')
			    	$payment_status = 'SUCCESS';
			    else
			    	$payment_status = 'FAILURE';
			    
		        
				
				$this->db->select('appl_status');
				$this->db->from('applicant_appl_overview');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program_code);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$appl_status = $row['appl_status'];
		        }
		        
				$this->db->select('money_receipt_no');
				$this->db->from('applicant_form_fee_overview');
				$this->db->where('appl_no',$application_no);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$money_receipt_no_status = $row['money_receipt_no'];
		        }
		        
				
				if($payment_status == "SUCCESS")
				{
					$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content,D.program_name");
					$this->db->from('sms_provider_setup A');
					$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
					$this->db->join('program_sms_setup C','B.sms_type = C.sms_type','INNER');
					$this->db->join('program_master D','C.program_code = D.program_code','INNER');
					$this->db->where('C.program_code',$program_code);
					$this->db->where('C.record_status','1');
					$this->db->where('B.record_status','1');
					$this->db->where('B.sms_type','SUBMISSION OF APPLICATION');
					$this->db->where('B.status','ACTIVE');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $row1) 
			        {
			        	$sms_url = $row1['sms_url'];
						$user_name = $row1['user_name'];
						$password = addslashes($row1['password']);
						$sender = $row1['sender'];
						$content = $row1['content'];
						$program = $row1['program_name'];
						//$institute_name = $row1['institute_name'];
						$find = array("[username]", "[password]", "[sender]");
						$replace = array($user_name, $password, $sender);
						$new_sms_url = str_replace($find, $replace, $sms_url);//find and replace uid and pwd in url
						$findappl = array("[program name]", "[applno]");
						$replaceappl = array($program,$application_no);
						$new_content = str_replace($findappl, $replaceappl, $content);
						$messageToSend = urlencode($new_content);
						//find replace url with mobileno and message
						$findmobileNo = array("[mobileno]","[message]");
						$replacemobileNo = array($reg_user_id,$messageToSend);
						$smsURL = str_replace($findmobileNo,$replacemobileNo,$new_sms_url);	
			        }
			        $ch = curl_init($smsURL );
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$result = curl_exec($ch);
					curl_close($ch);
				}
				if($payment_status == 'SUCCESS' && $money_receipt_no_status=='')
				{
					
					/*$x = explode('=', $tpsl_txn_id);
					$payment_id = $x[1];*/
					$txndate_informat = date('Y-m-d H:i:s', strtotime($txt_date));
					$this->db->trans_start();
					$applicant_form_fee_overview = array(
						'depositdate' =>$txndate_informat ,
						'money_receipt_no' => $txn_ref_number,
						'modified_by' => $reg_user_id,
						'modified_on' => $now
					);
					$this->db->where('appl_no',$application_no);
					$regUpdate = $this->db->update('applicant_form_fee_overview',$applicant_form_fee_overview);
					if(!$regUpdate){
					
						$dbStatus = FALSE;
					}
					else
					{
						
						$applicant_form_online_deposit = array(
							'sub_category' 			=> '',
							'depositdate' 			=> $txndate_informat,
							'deposit_status'		=> $payment_status,
							'response_datetime' 	=> $now,
							'transaction_number'	=> $bank_ref_number,
							'remark'				=> $online_transaction_remark,
							'clientside_response' 	=> $str,
							'updated_by'		 	=> $reg_user_id,
							'updated_on' 			=> $now
						);
						$this->db->where('order_number',$order_number);
						$regUpdate = $this->db->update('applicant_form_online_deposit',$applicant_form_online_deposit);
						if(!$regUpdate){
							$dbStatus = FALSE;
						}
						else
						{
							$applicant_appl_overview = array(
								'appl_status' => 'Verified',
								'updated_by' => $reg_user_id,
								'updated_on' => $date
							);
							$this->db->where('appl_no',$application_no);
							$regUpdate = $this->db->update('applicant_appl_overview',$applicant_appl_overview);
							if(!$regUpdate){
								$dbStatus = FALSE;
							}
							
							$new_data = array(
								'id' 					=>NULL,
								'reg_user_id' 			=>$reg_user_id,
								'appl_no' 				=>$application_no,
								'form_no' 				=>$application_no,
								'applied_program' 		=>$program_code,
								'appl_status' 			=>'Verified',
								'created_by'			=>$reg_user_id,
								'created_on'			=>$date
							);
							
							
							$sql = $this->db->insert('applicant_appl_overview_history', $new_data);
							//echo $this->db->last_query();
							if(!$sql){
								$dbStatus = FALSE;
								$dbMessage = "Error Inserting";
								//$dbError = ;	
							}
							$this->db->select('index_no');
							$this->db->from('applicant_appl_overview');
							$this->db->where('appl_no',$application_no);
							$result = $this->db->get();
							$output_data = $result->result_array();
							foreach ($output_data as $row) 
					        {
					        	$index_no = $row['index_no'];
					        }
					        if($index_no == '')
							{
								$this->db->select('A.program_code,A.year,sequence_code,sequence_no');
								$this->db->from('index_sequence_setup A');
								$this->db->where('A.program_code',$program_code);
								$result = $this->db->get();
								$output_data = $result->result_array();
								foreach ($output_data as $row1) 
						        {
						        	$year = $row1['year'];
									$year_str = substr($year,'-2');
									$sequence_no = $row1['sequence_no'];
									$key = $row1['sequence_code'];
						        }
								
								if($sequence_no < 10)
									$changed_sl_no = '00'.$sequence_no;
								else if($sequence_no < 100)
									$changed_sl_no = '0'.$sequence_no;
								else
									$changed_sl_no = $sequence_no;
									
								$index_no = $year_str.'/'.$key.'/'.$changed_sl_no;
							}
							$applicant_appl_overview = array(
								'appl_status' => 'Verified',
								'index_no' => $index_no,
								'updated_by' => $reg_user_id,
								'updated_on' => $date
							);
							$this->db->where('appl_no',$application_no);
							$regUpdate = $this->db->update('applicant_appl_overview',$applicant_appl_overview);
							if(!$regUpdate){
								$dbStatus = FALSE;
							}
							else
							{
									
									
								/*$new_seq_no = $sequence_no + 1;
							
								$applicant_appl_overview = array(
									'sequence_no' => $new_seq_no
								);
								$this->db->where('program_code',$program_code);
								$regUpdate = $this->db->update('index_sequence_setup',$applicant_appl_overview);
								if(!$regUpdate){
									$dbStatus = FALSE;
								}*/
								
								
								
							}
						}
						
					}
				}
				else{
					$applicant_form_online_deposit = array(
						'deposit_status'	 => $payment_status,
						'response_datetime'	 => $now,
						'remark'			 => $online_transaction_remark,
						'clientside_response'=> $str,
						'updated_by' 		 => $reg_user_id,
						'updated_on'		 => $now
					);
					$this->db->where('order_number',$order_number);
					$regUpdate = $this->db->update('applicant_form_online_deposit',$applicant_form_online_deposit);
					if(!$regUpdate){
						$dbStatus = FALSE;
					}
					return array('status' => false, 'msg' => $online_transaction_remark);
				}
				if($dbStatus){
					$this->db->trans_complete();
					return array('status' => $dbStatus, 'msg' => $dbMessage);
				}else{
					$this->db->trans_rollback();
					return array('status' => $dbStatus, 'msg' => $dbMessage);
				}
			break;
			case 'billdesk_payment_serverside_response':
				$dbStatus = TRUE;
				$dbMessage = "";
				
				$response = $_POST;
				$str = $response['msg'];			    
			    $arr_res = explode("|", $str);
			    
			    $merchat_id = $arr_res[0];
				$customer_id = $arr_res[1];//application number(appl_no)
				$txn_ref_number = $arr_res[2];
				$bank_ref_number = $arr_res[3];
				$txn_amount = $arr_res[4];
				$bank_id = $arr_res[5];
				$bank_merchant_id = $arr_res[6];
				$txn_type = $arr_res[7];
				$currency_name = $arr_res[8];
				$item_code = $arr_res[9];
				$security_type = '';
				$security_id = $arr_res[10];
				$auth_status = $arr_res[14];
				$txt_date = $arr_res[13];
				$pg_onlinepayment_transaction_number = $arr_res[16];
				$online_transaction_remark = $arr_res[24];
				
				
				$application_no = $customer_id;
				//$order_number = $this->session->userdata('order_number');
				$order_number = $pg_onlinepayment_transaction_number;
				$amount = $txn_amount;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date('Y-m-d H:i:s', now());
        		//$strCurDate = date('d-m-Y');
        		//$ins =  encrypt_decrypt('decrypt', $institute);
        		
		        //+$hex_ins_code =  encrypt_decrypt('encrypt', $ins);
		        $applshow=0;
				$show=0;
				$print=0;
				$noamount=0;
				$showChallanInfo=0;
			
		        
		      		        
		        $this->db->select('appl_status,reg_user_id,applied_program');
				$this->db->from('applicant_appl_overview');
				$this->db->where('appl_no',$application_no);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$appl_status = $row['appl_status'];
		        	$reg_user_id = $row['reg_user_id'];
		        	$program_code = $row['applied_program'];
		        }
		        

				$payment_status = "";
				$payment_id = "";
				
				
			    
     			
			    /*$tpsl_txn_id = $arr_res[5];
			    $clnt_txn_ref = $arr_res[3];
				$id = explode('=', $tpsl_txn_id);*/
				$this->db->select('pg_parameter_value');
				$this->db->from('pg_parameter_values');
				$this->db->where('pg_code','BILLDESK');
				$this->db->where('pg_parameter_code','CHECKSUMKEY');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$pg_parameter_value = $row['pg_parameter_value'];
					//$order_number = $order_id;
		        }
		        $str1 = implode("|",array_slice($arr_res,0,25));
		        $calculated_checksum = strtoupper(hash_hmac('sha256',$str1,$pg_parameter_value, false)); 
		        if($arr_res[25]!=$calculated_checksum){
					return array('status' => false, 'msg' => 'Invalid merchant-Id');
				}
				
				/*$this->db->select('A.appl_no,B.reg_user_id,B.applied_program');
				$this->db->from('applicant_form_online_deposit A');
				$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no','LEFT');
				$this->db->where('A.order_number',$order_id);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$seladmcode = $row['applied_program'];
					$reg_user_id = $row['reg_user_id'];
					$application_no = $row['appl_no'];
					//$order_number = $order_id;
		        }*/
				
				//update database
			    if($auth_status == '0300')
			    	$payment_status = 'SUCCESS';
			    else
			    	$payment_status = 'FAILURE';
			    
		        
		        
				$this->db->select('money_receipt_no');
				$this->db->from('applicant_form_fee_overview');
				$this->db->where('appl_no',$application_no);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
		        {
		        	$money_receipt_no_status = $row['money_receipt_no'];
		        }
		        
		        
				$this->db->select('deposit_status');
				$this->db->from('applicant_form_online_deposit');
				$this->db->where('appl_no',$application_no);
				$this->db->where('order_number',$order_number);
				$result = $this->db->get();
				$output_online_deposite = $result->result_array();
				foreach ($output_online_deposite as $row) 
		        {
		        	$deposit_status = $row['deposit_status'];
		        }
		        
				if($deposit_status=='SUCCESS' ){
					$applicant_form_online_deposit = array(
						'serverside_responce'=> $str
					);
					$this->db->where('order_number',$order_number);
					$regUpdate = $this->db->update('applicant_form_online_deposit',$applicant_form_online_deposit);
					if(!$regUpdate){
						$dbStatus = FALSE;
					}
				}else{
					
					if($payment_status == 'SUCCESS')
					{
						
						/*$x = explode('=', $tpsl_txn_id);
						$payment_id = $x[1];*/
						$txndate_informat = date('Y-m-d H:i:s', strtotime($txt_date));
						$this->db->trans_start();
						$applicant_form_fee_overview = array(
							'depositdate' =>$txndate_informat ,
							'money_receipt_no' => $txn_ref_number,
							'modified_by' => $reg_user_id,
							'modified_on' => $now
						);
						$this->db->where('appl_no',$application_no);
						$regUpdate = $this->db->update('applicant_form_fee_overview',$applicant_form_fee_overview);
						if(!$regUpdate){
						
							$dbStatus = FALSE;
						}
						else
						{
							
							$applicant_form_online_deposit = array(
								'sub_category'		 => '',
								'depositdate'		 => $txndate_informat,
								'deposit_status'	 => $payment_status,
								'response_datetime'	 => $now,
								'transaction_number' => $bank_ref_number,
								'remark'			 => $online_transaction_remark,
								'serverside_responce'=> $str,
								'updated_by' 		 => $reg_user_id,
								'updated_on'		 => $now
							);
							$this->db->where('order_number',$order_number);
							$regUpdate = $this->db->update('applicant_form_online_deposit',$applicant_form_online_deposit);
							if(!$regUpdate){
								$dbStatus = FALSE;
							}
							else
							{
								$applicant_appl_overview = array(
									'appl_status' => 'Verified',
									'updated_by' => $reg_user_id,
									'updated_on' => $date
								);
								$this->db->where('appl_no',$application_no);
								$regUpdate = $this->db->update('applicant_appl_overview',$applicant_appl_overview);
								if(!$regUpdate){
									$dbStatus = FALSE;
								}
								
								$new_data = array(
									'id' 					=>NULL,
									'reg_user_id' 			=>$reg_user_id,
									'appl_no' 				=>$application_no,
									'form_no' 				=>$application_no,
									'applied_program' 		=>$program_code,
									'appl_status' 			=>'Verified',
									'created_by'			=>$reg_user_id,
									'created_on'			=>$date
								);
								
								
								$sql = $this->db->insert('applicant_appl_overview_history', $new_data);
								//echo $this->db->last_query();
								if(!$sql){
									$dbStatus = FALSE;
									$dbMessage = "Error Inserting";
									//$dbError = ;	
								}
								$this->db->select('index_no');
								$this->db->from('applicant_appl_overview');
								$this->db->where('appl_no',$application_no);
								$result = $this->db->get();
								$output_data = $result->result_array();
								foreach ($output_data as $row) 
						        {
						        	$index_no = $row['index_no'];
						        }
						        if($index_no == '')
								{
									$this->db->select('A.program_code,A.year,sequence_code,sequence_no');
									$this->db->from('index_sequence_setup A');
									$this->db->where('A.program_code',$program_code);
									$result = $this->db->get();
									$output_data = $result->result_array();
									foreach ($output_data as $row1) 
							        {
							        	$year = $row1['year'];
										$year_str = substr($year,'-2');
										$sequence_no = $row1['sequence_no'];
										$key = $row1['sequence_code'];
							        }
									
									if($sequence_no < 10)
										$changed_sl_no = '00'.$sequence_no;
									else if($sequence_no < 100)
										$changed_sl_no = '0'.$sequence_no;
									else
										$changed_sl_no = $sequence_no;
										
									$index_no = $year_str.'/'.$key.'/'.$changed_sl_no;
								}
								$applicant_appl_overview = array(
									'appl_status' => 'Verified',
									'index_no' => $index_no,
									'updated_by' => $reg_user_id,
									'updated_on' => $date
								);
								$this->db->where('appl_no',$application_no);
								$regUpdate = $this->db->update('applicant_appl_overview',$applicant_appl_overview);
								if(!$regUpdate){
									$dbStatus = FALSE;
								}
								else
								{
										
										
									/*$new_seq_no = $sequence_no + 1;
								
									$applicant_appl_overview = array(
										'sequence_no' => $new_seq_no
									);
									$this->db->where('program_code',$program_code);
									$regUpdate = $this->db->update('index_sequence_setup',$applicant_appl_overview);
									if(!$regUpdate){
										$dbStatus = FALSE;
									}*/
									
									
									
								}
							}
							
						}
					}
					else{
						$applicant_form_online_deposit = array(
							'deposit_status'	 => $payment_status,
							'response_datetime'	 => $now,
							'remark'			 => $online_transaction_remark,
							'serverside_responce'=> $str,
							'updated_by' 		 => $reg_user_id,
							'updated_on'		 => $now
						);
						$this->db->where('order_number',$order_number);
						$regUpdate = $this->db->update('applicant_form_online_deposit',$applicant_form_online_deposit);
						if(!$regUpdate){
							$dbStatus = FALSE;
						}
					}
				}
				if($dbStatus){
					$this->db->trans_complete();
					return array('status' => $dbStatus, 'msg' => $dbMessage);
				}else{
					$this->db->trans_rollback();
					return array('status' => $dbStatus, 'msg' => $dbMessage);
				}
			break;
			case 'billdesk_payment_response1':
				$dbStatus = TRUE;
				$dbMessage = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$order_number = $this->session->userdata('order_number');
				$amount = $this->session->userdata('app_fee');
				$institute = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		//$strCurDate = date('d-m-Y');
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$pg = 'BILLDESK';
				//1.get current financial year
				$fin_year_code = '';
				
				

				//get bank account code
				$bank_account_code = '';
				$query = "SELECT account_code
						FROM finance.onlinepayment_debit_account
						WHERE institute_code = '$institute_code'
						AND status = 1
						AND pg_code = '$pg'
						";	
				if (!$con->ExecQuery($query)) // Execute query or die if error is occured
				{
				    $dbStatus = 'Failure'; 
				    $dbMessage = $con->Error();
				}
				else
				{
					if(pg_num_rows($con->result))
					{			
						$i=0; $row = $con->FetchResult($i, PGSQL_BOTH); 
						$bank_account_code = $row['account_code'];
					}
				}


				//get pg parameter values for this school
				$query = "SELECT pg_parameter_code, pg_parameter_value
					FROM finance.pg_parameter_values
					WHERE pg_code = '$pg'
					AND school_code = '$institute_code'";
				$result = mysqli_query($con, $query);
				if (!$con->ExecQuery($query)) // Execute query or die if error is occured
				{
				    $dbStatus = 'Failure'; 
				    $dbMessage = $con->Error();
				}
				else
				{
					if(pg_num_rows($con->result))
					{			
						for($i=0; $row = $con->FetchResult($i, PGSQL_BOTH); $i++)
							$pg_parameter_values[$row['pg_parameter_code']] = $row['pg_parameter_value'];
					}
				}



				$merchat_id = $pg_parameter_values['MERCHANTID'];
				$customer_id = $student_code; 
				$txn_amount = $amount_to_pay; 
				$currency_type = $pg_parameter_values['CURRENCY'];
				$type_field1 = $pg_parameter_values['TYPEFIELD1'];
				$security_id = $pg_parameter_values['SECURITYID'];
				$typefield_2 = $pg_parameter_values['TYPEFIELD2'];
				$response_url = $pg_parameter_values['RESPONSEURL'].'?_s='.session_id();
				$post_url = $pg_action_url;
				$ChecksumKey = $pg_parameter_values['CHECKSUMKEY'];

				$total_due_amount = 0;

				$account_code = array(); //account codes on which payment is done
				$paid_amount = array(); //amount paid on each account codes
				$due_amount = array(); //amount to pay on each account codes

				//4.GET ALL account and amount from finance.onlinepayment_transaction_detail
				$query = "SELECT account_code, amount_to_pay, amount_paid
						FROM finance.onlinepayment_transaction_detail 
						WHERE transaction_no = '$onlinepayment_transaction_number'
						AND institute_code = '$institute_code'
						";	
				if (!$con->ExecQuery($query)) // Execute query or die if error is occured
				{
				    $dbStatus = 'Failure'; 
				    $dbMessage = $con->Error();
				}
				else
				{
					if(pg_num_rows($con->result))
					{			
						for($i=0; $row = $con->FetchResult($i, PGSQL_BOTH); $i++)
						{				
							$account_code[] = $row['account_code'];
							$paid_amount[] = $row['amount_paid'];
							$due_amount[] = $row['amount_to_pay'];
						}							
					}
				}
				$dbStatus = 'SUCCESS';
				$dbMessage = '';
				$dbError = '';
				$footer_message = '';
				$failure_reason = '';
				//$_POST['msg'] = "MERCHANTID|ARP10234|MSBI0412001668|NA|00000094.00|SBI|22270726|NA|INR|NA|NA|NA|NA|12-12-2004 16:08:56|0300|NA|232123|NA|NA|NA|NA|NA|NA|NA|NA|de68bcaf207ea99348c49c7575d81fb99aede697d0f9d8c8531115cefb333375";

				if(isset($_POST['msg']))
				{
					
					//check if page is refreshed
					$response_saved = FALSE;
					$query = "SELECT student_code, amount_paid, pg_tran_no, pg_remark
						FROM finance.onlinepayment_transaction_master
						WHERE transaction_no = '$onlinepayment_transaction_number'";
					if (!$con->ExecQuery($query)) // Execute query or die if error is occured
					{
					    $dbStatus = 'FAILURE'; 
					    $dbMessage = $con->Error();
					}
					else
					{
						if(pg_num_rows($con->result))
						{			
							$i=0; $row = $con->FetchResult($i, PGSQL_BOTH); 
							$student_code = $row["student_code"];
							if($row["pg_remark"] != '')
							{
								$response_saved = TRUE;
								$total_paid_amount = $row["amount_paid"];
								$PaymentID = $row["pg_tran_no"];
							}
							
						}
					}
					
					if($response_saved == FALSE)
					{
						$msg = $_POST['msg'];
						$arr_msg = explode("|",$msg);
						$pg_checksum = $arr_msg[25];
						
						$str = implode("|",array_slice($arr_msg,0,25));
						
						$calculated_checksum = strtoupper(hash_hmac('sha256',$str,$ChecksumKey, false)); 
						if($calculated_checksum == $pg_checksum)
						{
							$merchat_id = $arr_msg[0];
							$customer_id = $arr_msg[1];
							$txn_ref_number = $arr_msg[2];
							$bank_ref_number = '';
							$txn_amount = $arr_msg[4];
							$bank_id = $arr_msg[5];
							$bank_merchant_id = $arr_msg[6];
							$txn_type = '';
							$currency_name = '';
							$item_code = '';
							$security_type = '';
							$security_id = $arr_msg[10];
							$auth_status = $arr_msg[14];
							$txt_date = $arr_msg[13];
							$pg_onlinepayment_transaction_number = $arr_msg[16];
							
							if($onlinepayment_transaction_number == $pg_onlinepayment_transaction_number)
							{
								if($auth_status == '0300') //PG SUCCESS
								{
									$transaction_status = 'SUCCESS';
									$collection_date = date("Y-m-d");
									$collection_remark = 'Online payment';
									$total_paid_amount = $txn_amount;
									//BEGIN
									$con->ExecQuery("BEGIN");
									//=============================================================================================
									//do collection. 1. insert in collection master and detail 				
									$transaction_no = '';
									$receipt_no = '';
									
									//GET transaction sequence number
									$query = "SELECT transaction_no_seq, receipt_no_seq 
										FROM finance.receipt_transaction_seq_master 
										WHERE financial_year = '$fin_year_code' FOR UPDATE;";	
									if (!$con->ExecQuery($query)) // Execute query or die if error is occured
									{
									    $dbStatus = 'FAILURE'; 
									    $dbMessage = $con->Error();
									}
									else
									{
										if(pg_num_rows($con->result))
										{			
											for($i=0; $row = $con->FetchResult($i, PGSQL_BOTH); $i++)
											{				
												$transaction_no = $row['transaction_no_seq'];				
												$receipt_no = $row['receipt_no_seq'];				
											}							
										}
									}
									
									$update_transaction_no = $transaction_no;
									$update_receipt_no = $receipt_no;
									$transaction_no = 'COL-'.$fin_year_code.'/'.$transaction_no;				
									$receipt_no = 'COL-'.$fin_year_code.'/'.$receipt_no;
									
									$query = '';
									//INSERT INTO collection_master. 1 record
									$query = $query."INSERT INTO finance.collection_master(
							            collection_date, entity_type, entity_code, transaction_no, 
							            remark, amount, receipt_no, institute_code, created_by, created_on, 
							            updated_by, updated_on, status) VALUES(
							            '$collection_date', '$entity_type_code','$student_code', '$transaction_no',
							            '$collection_remark', '$total_paid_amount', '$receipt_no', '$institute_code','$user_code',NOW(),
							            '$user_code',NOW(),1);";
									//COLLECTION
									if(isset($account_code))
									{
										for($i=0;$i<count($account_code);$i++) //For each account
										{
											//1.Insert into collection_detail
											$query = $query."INSERT INTO finance.collection_detail(
							            		transaction_no, account_code, amount, transaction_type, institute_code, 
									            created_by, created_on, updated_by, updated_on, status, entity_type, entity_code,
									            collection_date, transaction_mode, transaction_date, financial_year) VALUES(
									            '$transaction_no', '$account_code[$i]', '$paid_amount[$i]', 'Cr', '$institute_code',
									            '$user_code',NOW(),'$user_code',NOW(),1, '$entity_type_code','$student_code',
									            '$collection_date', 'ONLINE_PAYMENT', '$collection_date', '$fin_year_code');";
										}
									}
									//INSERT INTO Bank (Dr)
									$query = $query."INSERT INTO finance.collection_detail(
					            		transaction_no, account_code, amount, transaction_type, institute_code, 
							            created_by, created_on, updated_by, updated_on, status, entity_type, entity_code, 
							            collection_date, transaction_mode, transaction_date, financial_year) VALUES(
							            '$transaction_no', '$bank_account_code', '$total_paid_amount', 'Dr', '$institute_code',
							            '$user_code','NOW()','$user_code','NOW()',1, '$inst_entity_type_code', '$institute_code',
							            '$collection_date','ONLINE_PAYMENT', '$collection_date', '$fin_year_code');";
									//UPDATE transaction sequence number
									$query = $query."UPDATE finance.receipt_transaction_seq_master 
										SET transaction_no_seq = $update_transaction_no+1,
										receipt_no_seq = $update_receipt_no + 1,
										updated_by = '$user_code',
										updated_on = NOW() 
										WHERE financial_year = '$fin_year_code';";
									//echo $query;
									if (!$con->ExecQuery($query)) 
									{
									    $status = 0;
									}
									else
									{
										$status = 1;
									}
									
									//==============================================================================================
									$transaction_date = date("Y-m-d");
									$query = "UPDATE finance.onlinepayment_transaction_master SET
										response_date_time = NOW(), 
										amount_paid = $txn_amount, 
										pg_status = '$auth_status', 
										transaction_status = '$transaction_status',
										pg_tran_no = '$txn_ref_number', 
										bank_ref_no = '',
										pg_remark = '$msg', 
										updated_by = '$user_code', 
										updated_on = NOW()
										WHERE transaction_no = '$onlinepayment_transaction_number'
										AND student_code = '$student_code'
										AND institute_code = '$institute_code'";
									if (!$con->ExecQuery($query)) 
									{
										$dbStatus = 'FAILURE';
									}
									//Check for final status
									if($dbStatus == 'SUCCESS' && $status == 1)
										$con->ExecQuery("COMMIT");
									else if($dbStatus == 'FAILURE' && $status == 0)
										$con->ExecQuery("ROLLBACK");
								}
								else //ERROR IN PG
								{
									$transaction_status = 'FAILED';
									if($auth_status == '0399')
										$failure_reason = 'Cancelled By User';
									else if($auth_status == 'NA')
										$failure_reason = 'Invalid Input in the Request Message';
									else if($auth_status == '0002')
										$failure_reason = 'BillDesk is waiting for Response from Bank';
									else if($auth_status == '0001')
										$failure_reason = 'Error at BillDesk';
									
									$transaction_date = date("Y-m-d");
									$query = "UPDATE finance.onlinepayment_transaction_master SET
										response_date_time = NOW(), 
										amount_paid = 0, 
										pg_status = '$auth_status', 
										transaction_status = '$transaction_status',
										pg_tran_no = '', 
										bank_ref_no = '',
										pg_remark = '$msg', 
										updated_by = '$user_code', 
										updated_on = NOW()
										WHERE transaction_no = '$onlinepayment_transaction_number'
										AND student_code = '$student_code'
										AND institute_code = '$institute_code'
										AND transaction_status = 'INITIATED'";
									//echo $query;
									if (!$con->ExecQuery($query)) 
									{
										$dbStatus = 'FAILURE';
										$dbMessage = 'Transaction Failed';
									}
								}
								
							}
							else
							{
								$dbStatus = 'FAILURE';
								$dbMessage = 'Invalid Transaction Number';
								$transaction_status = 'FAILED';
								$failure_reason = 'Invalid Transaction Number';
							}
						}
						else //checksum failed
						{
							$transaction_status = 'FAILED';
							$failure_reason = 'Invalid Checksum';
							$dbStatus = 'FAILURE';
							$dbMessage = 'Invalid Checksum';
						}
					}
					else
					{
						$transaction_status = 'FAILED';
						$failure_reason = 'Response from payment gateway already updated successfully.';
					}
				}
			break;
			
			default :
            	return array('status' => FALSE, 'msg' =>'Unable to load.Contact Support');
			
        }
    }
    
}
?>