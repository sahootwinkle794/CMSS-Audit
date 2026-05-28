<?php

class Feedback_model extends CI_model {

   // private $role;

    function __construct() {
        parent::__construct();
        $this->load->helper('date');

        if (ENVIRONMENT == 'production') {
            $this->db->save_queries = FALSE;
        }
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s', now());
        //echo $this->group_data();
    }
    
     public function apply($data, $op, $stage = null) {
    
     switch ($op) {
     
    	case 'support_modal':
    		$ins_code =isset($_POST['ins_code'])?$_POST['ins_code']:'';
			$this->db->select("institute_email, contact_number");
			$this->db->from('institute_master');
			$this->db->where('institute_code' , $ins_code);
			$result = $this->db->get();
			foreach($result->result_array() AS $row)
			{
				$institute_email = $row['institute_email'];
				$contact_number = $row['contact_number'];
			}
			return $result->result_array();
		
		break;

		case 'latestinfo_modal':
			$this->db->select("link_description, link_name, record_status,link_path");
			$this->db->from('latest_information');
			$this->db->where('id',$this->input->post('info'));
			$result = $this->db->get();

			return $result->result_array();
		break;


		
		case 'quicklink_modal':
			$ins_code =isset($_POST['ins_code'])?$_POST['ins_code']:'';
			$this->db->select("institute_email, website_address");
			$this->db->from('institute_master');
			$this->db->where('institute_code' , $ins_code);
			$result = $this->db->get();
			foreach($result->result_array() AS $row)
			{
				$institute_email = $row['institute_email'];
				$contact_number = $row['website_address'];
			}
			return $result->result_array();
		break;
		
		
		case 'support_form_modal':
			$ins_code = $_POST['ins_code'];
			$this->db->select("institute_email, contact_number");
			$this->db->from('institute_master');
			$this->db->where('institute_code' , $ins_code);
			$result = $this->db->get();
			foreach($result->result_array() AS $row)
			{
				$institute_email = $row['institute_email'];
				$contact_number = $row['contact_number'];
			}
			
			$cust_name = $_POST['cust_name'];
			$cust_no = $_POST['cust_no'];
			$cust_email = $_POST['cust_email'];
			$grievance = $_POST['grievance'];
			
			
			$new_data = array(
						'applicant_name' => $cust_name,
	                    'applicant_mobile' =>$cust_no,
	                    'applicant_email' => $cust_email,
	                    'feedback' => $grievance,
	                    'created_by' => 'admin',
	                    'created_on' => date('Y-m-d H:i:s', now())
	               	);
           	if (!$this->db->insert('feedback_detail', $new_data))
			{
				$dbstatus = FALSE;
				$dbmessage = 'Error occur in Registred';
			}
			else{
				$dbstatus = TRUE;
				$dbmessage = 'Successfully Inserted';
			}
			//echo $cust_email; die();	
			//load email library
			$this->load->library('email');
			//$email_id
			$config['protocol']    = 'smtp';
			$config['smtp_host']    = 'mail.cipet.gov.in'; //'ssl://smtp.gmail.com';
			$config['smtp_port']    = '25';
			$config['smtp_timeout'] = '50';
			$config['smtp_user']    = "eadmission@cipet.gov.in";
			$config['smtp_pass']    = "AE*694!edgoin";
			$config['charset']    = 'utf-8';
			$config['newline']    = "\r\n";
			$config['mailtype'] = 'html'; // or text
			$config['validation'] = TRUE; // bool whether to validate email or not   
			$this->email->initialize($config);
			$this->email->from("eadmission@cipet.gov.in", 'CIPET ADMISSION 2018');
			$this->email->to($cust_email); 
			$this->email->subject('Feedback Received');
			$this->email->message('Dear '.$cust_name.' , <br />Your Message has beeen received. We will get back to you within 24hour. <br /><br />Thank you so much for helping us to provide a flawless solution.<br /><br /><br /><br /><b>Team PGET-2018,SVNIRTAR</b>');
			//$this->email->send();
			//echo $this->email->print_debugger();
			if($this->email->send()){
				$dbStatus = 'SUCCESS'; 
				$dbMessage = ' Mail Send Successfully';
				
			}else{
				
				$dbStatus = 'FAILURE'; 
				$dbMessage = 'Unable to sent Mail.Please Contact for Support';
			}
			
			$this->email->initialize($config);
			$this->email->from('eadmission@cipet.gov.in', 'CIPET ADMISSION 2018');
			//$this->email->to($institute_email);
			$this->email->to('rahul.patro@silicontechlab.com');
			$this->email->cc('linamohapatra27@gmail.com');
			$this->email->subject('New Message arrived from '.$cust_name);
			$this->email->message('Name: ' .$cust_name.'<br /><br />Mobile no: '.$cust_no.'<br /><br />Email id: '.$cust_email.'<br /> <br /><br />Grievance: '.$grievance);
			
			if($this->email->send()){
				
				$dbStatus = 'SUCCESS'; 
				$dbMessage = 'Saved Successfully';
			}else{
				
				$dbStatus = 'FAILURE'; 
				$dbMessage = 'Unable to sent Mail.Please Contact for Support';
			}
			return array('status' => $dbstatus, 'msg' => $dbmessage);
		
		break;
		
			default :
            	return array('status' => FALSE, 'msg' =>'Unable to load.Contact Support');
		}
		
		
		
	}
}
		/*default :
            	return array('status' => FALSE, 'msg' =>'Unable to load.Contact Support');
	}		
        }*/
?>