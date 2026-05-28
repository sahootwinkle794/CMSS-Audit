<?php

class ApplyCounselling_model extends CI_model {

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
        function removeElementWithValue($array, $key, $value){
		     foreach($array as $subKey => $subArray){
		          if($subArray[$key] == $value){
		               unset($array[$subKey]);
		          }
		     }
		     return $array;
		}
    }
	 
	
							
    public function apply($data, $op, $stage = null) {
		
		//require(APPPATH.'controllers/Mpdf_controller.php');
        /**
		* logic: To operate data for superadmin master setup
		* date :11/09/2017
		*/
		//echo $data;
        switch ($op) {
        	/**
			* logic: To operate data for User Master
			* case:get_user_data,add_user,edit_user,delete_user,get_role
			* author:Rahul Patro
			* date :11/09/2017
			*/
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
				$this->db->from('counselling_program_master as p');
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
			case 'validate_counselling_code':
				
				$this->db->select('p.*');
				$this->db->from('counselling_master as p');
				$this->db->where('p.counselling_code',$data);
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
				/*echo $this->db->last_query();
				die();*/
				//print_r($result->result_array());
				return $result->result_array();
			break;
			case 'get_course_detail':
				$this->db->select('*');
				$this->db->from('course_master');
				$this->db->where('record_status',1);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break;
			case 'select_graduation_course':
				$program = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$course_name = $this->input->post('course_name');
				
				$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				foreach($result->result_array() AS $row1)
				{
					$reg_user_id = $row1['reg_user_id'];
					$program_code = $row1['applied_program'];
				}
				
				$this->db->select('*');
				$this->db->from('graduation_master');
				$this->db->where('program_code',$program_code);
				$this->db->where('course_code',$course_name);
				$this->db->where('record_status',1);
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_program_group':
				$ins =  encrypt_decrypt('decrypt', $data);
				if($ins == '0') 
					$ins = '';
				$this->db->distinct('program_group_code');
				$this->db->select('program_group_code,program_group_name,A.sl_no');
				$this->db->from('program_group_master A');
				$this->db->join('counselling_program_master B','A.program_group_name = B.program_group','inner');
				$this->db->where('B.institute_code',$ins);
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.sl_no');
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_program':
				$ins =  encrypt_decrypt('decrypt', $data);
				if($ins == '0') 
					$ins = '';
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s",now());
        		$reg_user_id = $this->session->userdata('reg_user_id');
				$this->db->select('A.program_group,A.id,A.program_name,A.program_code,A.year,A.apply_start_date,A.apply_end_date,A.template_code,C.file_name,aao.appl_status');
				$this->db->from('counselling_program_master A');
				$this->db->join('program_group_master B','A.program_group = B.program_group_name','inner');
				$this->db->join('form_template_master C','A.template_code = C.template_code','inner');
				$this->db->join('applicant_appl_overview aao',"A.program_code = aao.applied_program AND reg_user_id = '$reg_user_id'",'LEFT');
				$this->db->where('A.institute_code',$ins);
				$this->db->where('A.record_status',1);
				$this->db->where('A.publish_status','YES');
				$this->db->where('A.apply_start_date<=',$now);
				$this->db->where('A.apply_end_date>=',$now);
				$this->db->order_by('A.id');
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//die();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_program_detail':
				$program_code = $data;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select('A.program_group,A.id,A.program_name,A.program_code,A.year,A.apply_start_date,A.apply_end_date,A.template_code,C.file_name,C.template_name');
				$this->db->from('program_master A');
				$this->db->join('form_template_master C','A.template_code = C.template_code','inner');
				$this->db->where('A.program_code',$program_code);
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_program_admit_card_count': 
            	
            	$program_code = $data;
            	date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
			 	
				$this->db->select("COUNT(*) AS adm_setup_cnt");
				$this->db->from('admitcard_setup');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$setup_count = $row['adm_setup_cnt'];
	            }
	            
	            if($setup_count >=1)
				{
					$this->db->select("DATE_FORMAT(admit_card_available_from,'%d-%m-%Y') AS admit_card_available ");
					$this->db->from('admitcard_setup');
					$this->db->where('program_code',$program_code);
					$this->db->where('record_status','1');
					$this->db->order_by('admit_card_available_from','asc');
					$this->db->limit('1');
					$result = $this->db->get();
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					foreach ($output_data as $row1) 
		            {
		            	$admit_card_available_date = $row1['admit_card_available'];
		            }
					
					$this->db->select("COUNT(*) AS adm_cnt");
					$this->db->from('admitcard_published');
					$this->db->where('applied_program',$program_code);
					$this->db->where('record_status','1');
					$results = $this->db->get();
					//$output_data = $results->result_array();
					//$output = array("aaData" => array());
				}
	            
	            return $output_data;
				
			break;
			case 'get_program_name':
				$program_code = $data;
				$program_name = '';
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select('A.program_name');
				$this->db->from('counselling_program_master A');
				$this->db->where('A.program_code',$program_code);
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				foreach($result->result_array() AS $row)
				{
					$program_name = $row['program_name'];
				}
				return $program_name;
				
			break;
			case 'get_program_menu':
				$program_code = $data;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->distinct('A.menu_code');
				$this->db->select('A.menu_code,A.link_text,A.link_url,A.record_status');
				$this->db->from('program_menu_master A');
				$this->db->join('program_menu_setup B', 'A.menu_code = B.menu_code','inner');
				
				$this->db->where('B.program_code',$program_code);
				$this->db->where('B.show_status',1);
				$this->db->order_by('B.sl_no');
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_mandatory_fields':
				$program_code = $data;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select('A.field_code,B.description,A.field_status');
				$this->db->from('program_registration_field_mapping A');
				$this->db->join('registration_field_setup B ', 'A.code_group = B.code_group AND A.field_code = B.code','inner');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.code_group','REGISTRATION_PAGE');
				$this->db->where('A.field_status','COMPULSORY');
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'check_birth_date':
				$program_code = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("DATE_FORMAT(birth_start_date,'%d-%m-%Y') as birth_start_date  ,DATE_FORMAT(birth_end_date,'%d-%m-%Y') as birth_end_date");
				$this->db->from('program_eligibility_setup');
				$this->db->where('program_code',$program_code);
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_registration_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$reg_user_id = $row1['reg_user_id'];
					$program_code = $row1['applied_program'];
				}
				
        		
				$this->db->select("reg_user_id,dob,first_name,mid_name,last_name,email_id");
				$this->db->from('applicant_reg_master');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				//print_r($query);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_application_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$reg_user_id = $row1['reg_user_id'];
					$program_code = $row1['course_code'];
				}
        		
				$this->db->select("appl_no,appl_status");
				$this->db->from('applicant_appl_overview');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				//print_r($query);
				//$result = $this->db->get();
				
				$result = $this->db->get();
				$query = $result->result_array();
				//$count = $result->num_rows();
				foreach($query as $aRow){
					$appl_status = $aRow['appl_status'];
					$appl_no = $aRow['appl_no'];
				}
				if($result->num_rows() == 1){
					
						$this->session->set_userdata('mode', 'edit');
						$this->session->set_userdata('appl_no', $appl_no);
					
				}
				else{
					$this->session->set_userdata('mode', 'new');
				}
				return $result->result_array();
			break;
			
			//********************************************************* Data to show in the template *******************************//
			
			case 'get_applicant_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$reg_user_id = $row1['reg_user_id'];
					$program_code = $row1['course_code'];
				}
        		
				$this->db->select("*,DATE_FORMAT(dob,'%d-%m-%Y') AS dob1");
				$this->db->from('applicant_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('status','1');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break;
			case 'get_present_communication_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$reg_user_id = $row1['reg_user_id'];
					$program_code = $row1['course_code'];
				}
        		
				$this->db->select("applicant_address.*");
				$this->db->from('applicant_address');
				$this->db->join('applicant_master','applicant_address.address_ref_id = applicant_master.comm_address_ref_id','left');
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_permanent_communication_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$reg_user_id = $row1['reg_user_id'];
					$program_code = $row1['course_code'];
				}
				$this->db->select("applicant_address.*");
				$this->db->from('applicant_address');
				$this->db->join('applicant_master','applicant_address.address_ref_id = applicant_master.perm_address_ref_id','left');
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				return $result->result_array();
			break;
			/*case 'get_permanent_communication_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("address_1, address_2, post_office, district_code,state_code, pin,mobile");
				$this->db->from('applicant_address');
				$this->db->join('applicant_master','applicant_address.address_ref_id = applicant_master.perm_address_ref_id','left');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				return $result->result_array();
			break;*/
			case 'get_father_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$reg_user_id = $row1['reg_user_id'];
					$program_code = $row1['course_code'];
				}
        		
				$this->db->select("rel_name, rel_occupation, rel_desig, nature_of_work,annual_income, place_work, email_id, res_no, mobile_no");
				$this->db->from('applicant_relation');
				$this->db->join('applicant_master','applicant_relation.reg_user_id=applicant_master.reg_user_id','left');
				$this->db->where('applicant_rel_flag','1');
				$this->db->where('applicant_relation.reg_user_id',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				return $result->result_array();
			break;
			case 'get_mother_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$reg_user_id = $row1['reg_user_id'];
					$program_code = $row1['course_code'];
				}
        		
				$this->db->select("rel_name, rel_occupation, rel_desig, nature_of_work,annual_income, place_work, email_id, res_no, mobile_no");
				$this->db->from('applicant_relation');
				$this->db->join('applicant_master','applicant_relation.reg_user_id=applicant_master.reg_user_id','left');
				$this->db->where('applicant_rel_flag','2');
				$this->db->where('applicant_relation.applied_program',$program_code);
				$this->db->where('applicant_relation.reg_user_id',$reg_user_id);
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_guardian_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$reg_user_id = $row1['reg_user_id'];
					$program_code = $row1['course_code'];
				}
        		
				$this->db->select("rel_name, rel_occupation, rel_desig, nature_of_work,annual_income, place_work, email_id, res_no, mobile_no");
				$this->db->from('applicant_relation');
				$this->db->join('applicant_master','applicant_relation.reg_user_id=applicant_master.reg_user_id','left');
				$this->db->where('applicant_rel_flag','3');
				$this->db->where('applicant_relation.applied_program',$program_code);
				$this->db->where('applicant_relation.reg_user_id',$reg_user_id);
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'get_academic_qual_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$reg_user_id = $row1['reg_user_id'];
					$program_code = $row1['applied_program'];
				}
        		
				$this->db->select("qual_desc_1,year_of_passing,university_board,division_distinction,mark_secured,full_mark,percentage_mark");
				$this->db->from('applicant_qualification_detail');
				$this->db->join('applicant_master','applicant_master.applied_program = applicant_qualification_detail.applied_program AND applicant_master.reg_user_id = applicant_qualification_detail.reg_user_id','inner');
				$this->db->where('applicant_master.applied_program',$program_code);
				$this->db->where('applicant_master.reg_user_id',$reg_user_id);
				$this->db->order_by('applicant_qualification_detail.id');
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_center_preference':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				foreach($result->result_array() AS $row1)
				{
					$reg_user_id = $row1['reg_user_id'];
					$program_code = $row1['applied_program'];
				}
				
        		if($this->input->post('preference1')){
					$this->db->where('ecm.exam_centre_code!='.$this->input->post('preference1'));
				}
        		if($this->input->post('preference2')){
					$this->db->where('ecm.exam_centre_code!='.$this->input->post('preference2'));
				}
				
				
				$present = 0;
				$this->db->select("ec.exam_centre_code,ec.exam_centre_name,ec.id");
				$this->db->from('exam_centre ec');
				$this->db->join('exam_centre_master ecm','ec.exam_centre_code = ecm.exam_centre_code','inner');
				$this->db->where('ecm.program_code',$program_code);
				$this->db->where('ec.record_status',1);
				$this->db->order_by('ec.id');
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				return $result->result_array();
			break;
			
			//****************************************************************************************************// 
			
			case 'get_documents_required':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$reg_user_id = $row1['reg_user_id'];
					$program_code = $row1['course_code'];
				}
				
				$this->db->select("document_type_code");
				$this->db->from('program_document_setup');
				$this->db->where('program_code',$program_code);
				$where = '(record_status="Active" or record_status = "1")';
				$this->db->where($where);
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_qualification_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$reg_user_id = $row1['reg_user_id'];
					$program_code = $row1['applied_program'];
				}
        		
				$this->db->select("A.qualification_code, B.qualification_name, B.division");
				$this->db->from('program_qualification_setup A');
				$this->db->join('qualification_master B','A.qualification_code = B.qualification_code','inner');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.record_status',1);
				$this->db->order_by('B.id');
				
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//die();
				//print_r($result);
				return $result->result_array();
			break;	
			
			case 'get_district_details':
				$state = $_POST['state'];
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("district_code,district_name");
				$this->db->from('district_master');
				$this->db->where('state_code',$state);
				//print_r($query);
				$result = $this->db->get();
				$query = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach($query as $aRow)
				{
					$row[0] = $slno;
					$row['sl_no'] = $slno;
					$i = 1;
					foreach($aRow as $key=>$value)
					{
						
						$row[$i] = $value;
						$row[$key] = $value;
						$i++;
					}
					
					$output['aaData'][] = $row;
					$slno++;
					unset($row);
				}
				return $output;
			break;
			case 'get_cmbInstituteFilter_data':
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("institute_code,institute_name");
				$this->db->from('institute_master');
				//print_r($query);
				$result = $this->db->get();
				$query = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach($query as $aRow)
				{
					$row[0] = $slno;
					$row['sl_no'] = $slno;
					$i = 1;
					foreach($aRow as $key=>$value)
					{
						
						$row[$i] = $value;
						$row[$key] = $value;
						$i++;
					}
					
					$output['aaData'][] = $row;
					$slno++;
					unset($row);
				}
				return $output;
			break;
			case 'get_cmbProgramFilter_data':
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$institute_code =isset($_POST['institute_code'])?$_POST['institute_code']:'';
        		
				$this->db->distinct("A.program_code,program_name");
				$this->db->select("A.program_code,program_name");
				$this->db->from('counselling_program_master A');
				$this->db->join('counselling_program_branch_institute_mapping B','B.program_code = A.program_code','LEFT');
				
				if($institute_code != '')
				{
					$this->db->where('B.institute_code',$institute_code);
				}
				/*if($institute_code != '')
				{
					$this->db->where('institute_code',$institute_code);
				}*/
				
				//print_r($query);
				$result = $this->db->get();
				$query = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach($query as $aRow)
				{
					$row[0] = $slno;
					$row['sl_no'] = $slno;
					$i = 1;
					foreach($aRow as $key=>$value)
					{
						
						$row[$i] = $value;
						$row[$key] = $value;
						$i++;
					}
					
					$output['aaData'][] = $row;
					$slno++;
					unset($row);
				}
				return $output;
			break;
			case 'get_cmbBranchFilter_data':
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$program_code =isset($_POST['program_code'])?$_POST['program_code']:'';
        		
        		$this->db->distinct('B.branch_code');
				$this->db->select('B.branch_code,A.branch');
				$this->db->from('counselling_branch_master A');
				$this->db->join('counselling_program_branch_institute_mapping B','B.branch_code = A.branch_code','LEFT');
				
				if($program_code != '')
				{
					$this->db->where('program_code',$program_code);
				}
        		
				
				//print_r($query);
				$result = $this->db->get();
				$query = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach($query as $aRow)
				{
					$row[0] = $slno;
					$row['sl_no'] = $slno;
					$i = 1;
					foreach($aRow as $key=>$value)
					{
						
						$row[$i] = $value;
						$row[$key] = $value;
						$i++;
					}
					
					$output['aaData'][] = $row;
					$slno++;
					unset($row);
				}
				return $output;
			break;
			case 'get_highest_qualification':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("qualification_code, qualification_name");
				$this->db->from('highest_qualification_master');
				$this->db->order_by('id');
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_nationality_data':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("nationality_code,nationality");
				$this->db->from('nationality_master');
				$this->db->where('record_status',1);
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;

			case 'get_relationship_data':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("relationship_code,relationship");
				$this->db->from('relationship_master');
				$this->db->where('record_status',1);
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;


			case 'get_religion_data':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("religion_code,religion_name");
				$this->db->from('religion_master');
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_minority_data':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("minority_community_code,minority_community");
				$this->db->from('minority_community_master');
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_district_data':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("district_code,district_name");
				$this->db->from('district_master');
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_state_data':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("state_code,state_name");
				$this->db->from('state_master');
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_category_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$reg_user_id = $row1['reg_user_id'];
					$program_code = $row1['course_code'];
				}
        		
				$this->db->select("A.category_code, A.category_name");
				$this->db->from('category_master A');
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_program_template':
				$program_code = $data;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.file_name");
				$this->db->from('form_template_master A');
				$this->db->join('counselling_program_master B','A.template_code = B.template_code','inner');
				$this->db->where('B.program_code',$program_code);
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				foreach($result->result_array() AS $row)
				{
					$temp_file_name = $row['file_name'];
				}
				return $temp_file_name;
			break;
			
			case 'insert_registration_data':
				$dbstatus = TRUE;
				$dbmessage = 'Successfully Registered';
				//$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$birth_start_date = '1900-01-01';
				$birth_end_date = $date;
				$txtJEENo =isset($_POST['txtJEENo'])?$_POST['txtJEENo']:'';
				$dob2 =isset($_POST['txtdob1'])?$_POST['txtdob1']:'';
				$dob1 = date("Y-m-d", strtotime($dob2) );
				$dob =date('Y-m-d', strtotime($dob1));
				
				$this->session->set_userdata('jee_roll_no', $txtJEENo);
				$this->session->set_userdata('dob',$dob );
				
				$present = 0;
				$txtJEENo =isset($_POST['txtJEENo'])?$_POST['txtJEENo']:'';
				$txtPassword =isset($_POST['txtPassword'])?$_POST['txtPassword']:'';
			
				$this->db->select('*');
				$this->db->from('counselling_applicant_reg_master');
				$this->db->where('reg_user_id',$txtJEENo);
				$this->db->where('institute_code','NIRTAR');
				$this->db->limit(1);
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$present = $result->num_rows();
				
				if($present == 0)
				{
					$this->db->select('COUNT(jee_roll_no) AS counting');
					$this->db->from('applicant_detail');
					$this->db->where('jee_roll_no',$txtJEENo);
					$this->db->where('dob',$dob);
					$result = $this->db->get();
					//echo $this->db->last_query();die();
					$query = $result->result_array();
					$present = 0;
					foreach($result->result_array() AS $row1)
					{
						$present=$row1['counting'];
					}
					
					if($present!=0)
					{
						$this->session->set_userdata('count', 0);
						
						$chars = "123456789";
		   				$otp = substr( str_shuffle( $chars ), 0, 4 );
		   				
						$this->session->set_userdata('otp', $otp);
						
						$this->db->select('jee_roll_no,full_name, first_name, mid_name, last_name, dob, applicant_email, applicant_mobile, gender, category');
						$this->db->from('applicant_detail');
						$this->db->where('jee_roll_no',$txtJEENo);
						$this->db->where('dob',$dob1);
						$result = $this->db->get();
						//echo $this->db->last_query();die();
						$query = $result->result_array();
						$present = 0;
						foreach($result->result_array() AS $row1)
						{
							$full_name = $row1['full_name'];
							$first_name = $row1['first_name'];
							$mid_name = $row1['mid_name'];
							$last_name = $row1['last_name'];
							$dob = $row1['dob'];
							$email_id = $row1['applicant_email'];
							$mobile_no = $row1['applicant_mobile'];
							$gender = $row1['gender'];
							$category = $row1['category'];
							$jee_roll_no = $row1['jee_roll_no'];
						}
						
						/*$this->db->select('count(reg_user_id) AS jee_roll_no');
						$this->db->from('counselling_applicant_reg_master');
						$this->db->where('reg_user_id',$txtJEENo);
						$this->db->where('dob',$dob1);
						$this->db->where('mobile',$mobile_no);
						$result = $this->db->get();
						//echo $this->db->last_query();die();
						$query = $result->result_array();
						$count = 0;
						foreach($result->result_array() AS $row1)
						{
							$count = $row1['jee_roll_no'];
						} 
						if($count == 0)
						{*/
		   					
	   					$this->db->select('es.email_type,es.subject,es.content');
						$this->db->from('email_setup es');
						$this->db->join('counselling_email_setup pes','es.email_type = pes.email_type','inner');
						$this->db->limit(1);
						$this->db->where('es.email_type','COUNSELLING REGISTRATION');
						$this->db->where('pes.institute_code',HARDCODE_INSTITUTE_CODE);
						
						
						
						$result = $this->db->get();
						$query = $result->result_array();
						$row_count = $result->num_rows();
						//echo $this->db->last_query(); die();
						foreach($result->result_array() AS $row1)
						{
							$email_type=$row1['email_type'];
							$subject=$row1['subject'];
							$content=$row1['content'];
						}
						$msgContent = $content;
				        $msgContent = str_replace("[jee_no]",$txtJEENo,$msgContent );
				        $msgContent = str_replace("[name]",$full_name,$msgContent );
				        $msgContent = str_replace("[otp]",$otp,$msgContent );
						if($row_count > 0){
						    $this->load->library('email');
					     
								
						     $this->email->set_newline("\r\n");
						     $this->email->set_mailtype("html");
						     //set email information and content
						     $this->email->from('svnirtar.pget2018@gmail.com', 'NIRTAR ADMIN');
						     $this->email->to($email_id);
						     $this->email->subject($subject);
						     $this->email->message($msgContent);
						    if($this->email->send()){
							    $dbStatus = TRUE; 
							    $dbMessage = 'A mail is forwarded to your registered mail id  ';
						    }
						    else{
							    $dbStatus = FALSE; 
							    $dbMessage = 'Unable to sent Mail.Please Contact for Support';
						    }
						    //print_r($this->email->print_debugger());die();
					    }
						//$otp = "1234";
						$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
						$this->db->from('sms_provider_setup A');
						$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
						//$this->db->where('C.program_code',$program_code);
						$this->db->where('B.record_status','1');
						$this->db->where('B.sms_type','JEE REGISTRATION');
						$this->db->where('B.status','ACTIVE');
						$result = $this->db->get();
						
						
						$output_data = $result->result_array();
						foreach ($output_data as $row1) 
				        {
				        	$sms_url = $row1['sms_url'];
							$user_name = $row1['user_name'];
							$password = urlencode($row1['password']);
							$sender = $row1['sender'];
							$content = $row1['content'];
							//$institute_name = $row1['institute_name'];
							$find = array("[username]", "[password]", "[sender]");
							$replace = array($user_name, $password, $sender);
							$new_sms_url = str_replace($find, $replace, $sms_url);//find and replace uid and pwd in url
							/*$findappl = array("[program name]", "[applno]");
							$replaceappl = array($program,$application_no);*/
							$findappl = array("[otp]");
							$replaceappl = array($otp);
							$new_content = str_replace($findappl, $replaceappl, $content);
							$messageToSend = urlencode($new_content);
							//find replace url with mobileno and message
							$findmobileNo = array("[mobileno]","[message]");
							$replacemobileNo = array($mobile_no,$messageToSend);
							$smsURL = str_replace($findmobileNo,$replacemobileNo,$new_sms_url);	
				        }
				       	/*echo $smsURL;
						die();*/
						$result =  file_get_contents($smsURL);
				        /*$ch = curl_init($smsURL );
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$result = curl_exec($ch);
						curl_close($ch);*/
							
							
							
							
						return array('status' => $dbstatus, 'msg' => $dbmessage);
						/*}
						
						else
						{
							return array('status' => FALSE, 'msg' => 'You Have Already Registered');
						}*/
					}
					else{
						return array('status' => FALSE, 'msg' => 'Your PGET Roll No. or Date Of Birth Is Incorrect');
					}	
				}
				else
				{
					return array('status' => FALSE, 'msg' => 'You Have Already Registered');
				}
				
				
			break;
			case 'check_otp_data':
				$dbstatus = TRUE;
				$dbmessage = 'Successfully Registered';
				$jee_roll_no = $this->session->userdata('jee_roll_no');
				$dob = $this->session->userdata('dob');
				//die();
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$birth_start_date = '1900-01-01';
				$birth_end_date = $date;
				$otp =isset($_POST['txtOTP'])?$_POST['txtOTP']:'';
				
				
				
				/*$this->db->select('pin,password,mobile');
				$this->db->from('counselling_applicant_reg_master');
				$this->db->where('reg_user_id',$jee_roll_no);
				$this->db->where('dob',$dob);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					//$pin=$row1['pin'];
					$user_password=$row1['password'];
					$mobile_no=$row1['mobile'];
				}*/
				
				$this->db->select('jee_roll_no,full_name, first_name, mid_name, last_name, dob, applicant_email, applicant_mobile, gender, category');
				$this->db->from('applicant_detail');
				$this->db->where('jee_roll_no',$jee_roll_no);
				$this->db->where('dob',$dob);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$full_name = $row1['full_name'];
					$first_name = $row1['first_name'];
					$mid_name = $row1['mid_name'];
					$last_name = $row1['last_name'];
					$dob = $row1['dob'];
					$email_id = $row1['applicant_email'];
					$mobile_no = $row1['applicant_mobile'];
					$gender = $row1['gender'];
					$category = $row1['category'];
					$jee_roll_no = $row1['jee_roll_no'];
				}
				$pin = $this->session->userdata('otp');
				if($pin == $otp)
				{
					// generate password
					
					 
					// $length - the length of the generated password
					// $count - number of passwords to be generated
					// $characters - types of characters to be used in the password
					 
					// define variables used within the function    
				    $symbols = array();
				    $passwords = array();
				    $used_symbols = '';
				    $user_password = '';
				    $pass = '';
					$characters = array("lower_case","upper_case","numbers","special_symbols");
   
					
					// an array of different character types    
				    $symbols["lower_case"] = 'abcdefghjkmnpqrstuvwxyz';
				    $symbols["upper_case"] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
				    $symbols["numbers"] = '23456789';
				    $symbols["special_symbols"] = '@?_-';
				 
				    //$characters = split(",",$characters); // get characters types to be used for the passsword
				    foreach ($characters as $key=>$value) {
				        $used_symbols .= $symbols[$value]; // build a string with all characters
				    }
				    $symbols_length = strlen($used_symbols) - 1; //strlen starts from 0 so to get number of characters deduct 1
				     
				    for ($p = 0; $p < 1; $p++) {
				        $pass = '';
				        for ($i = 0; $i < 6; $i++) {
				            $n = rand(0, $symbols_length); // get a random character from the string with all characters
				            $pass .= $used_symbols[$n]; // add the character to the password string
				        }
				        $user_password = $pass;
				    }
					$chars = "abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789@";
   					$password = substr( str_shuffle( $chars ), 0, 7 );
					//$password = "123AAA";
					$this->db->select('counselling_code');
					$this->db->from('counselling_schedule_master');
					$this->db->where('counselling_end_date >=',$date);
					$result = $this->db->get();
					//echo $this->db->last_query();die();
					$query = $result->result_array();
					$count = 0;
					foreach($result->result_array() AS $row1)
					{
						$counselling_code = $row1['counselling_code'];
					}
					
					$this->db->select('appl_no');
					$this->db->from('applicant_appl_overview');
					$this->db->where('reg_user_id',$mobile_no);
					$result = $this->db->get();
					//echo $this->db->last_query();die();
					$query = $result->result_array();
					$count = 0;
					foreach($result->result_array() AS $row1)
					{
						$form_no = $row1['appl_no'];
					}
					
					
					$new_data = array(
	                    'first_name' =>$full_name,
	                    'email_id' => $email_id,
	                    'reg_user_id' => $jee_roll_no,
	                    'password' => $user_password,
	                    'pin' => $otp,
	                    'mobile' => $mobile_no,
	                    'counselling_code' => $counselling_code,
	                    'institute_code' => HARDCODE_INSTITUTE_CODE,
	                    'dob' => $dob,
	                    'created_by' => $mobile_no,
	                    'created_on' => date('Y-m-d H:i:s', now())
	               	);
	               	
					if (!$this->db->insert('counselling_applicant_reg_master', $new_data))
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error occur in Registred';
					}
					
					$this->db->select("counselling_code,year,sl_no");
					$this->db->from('counselling_master');
					$this->db->where('counselling_code',$counselling_code);
					$result = $this->db->get();
					foreach($result->result_array() as $appl)
					{
						$sl_no = $appl['sl_no'];
						$counselling_code = $appl['counselling_code'];
						$year = $appl['year'];
						$new_sl_no = $sl_no + 1;
						$changed_sl_no = '';
						if($new_sl_no < 10)
							$changed_sl_no = '00000'.$new_sl_no;
						else if($new_sl_no < 100)
							$changed_sl_no = '0000'.$new_sl_no;
						else if($new_sl_no < 1000)
							$changed_sl_no = '000'.$new_sl_no;
						else if($new_sl_no < 10000)
							$changed_sl_no = '00'.$new_sl_no;
						else if($new_sl_no < 100000)
							$changed_sl_no = '0'.$new_sl_no;
					}
						
					$application_no = $counselling_code.$year.$changed_sl_no;
					
					
					$new_data = array(
						'reg_user_id' => $jee_roll_no,
						'appl_no' => $application_no,
	                    'counselling_code' =>$counselling_code,
	                    'form_no' => $form_no,
	                    'appl_status' =>'Verified',
	                    'institute_code' => HARDCODE_INSTITUTE_CODE,
	                    'created_by' => $mobile_no,
	                    'created_on' => date('Y-m-d H:i:s', now())
	               	);
	               	
					if (!$this->db->insert('counselling_applicant_appl_overview', $new_data))
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error occur in Registred';
					}
					
					$counselling_master = array(
						'sl_no' => $new_sl_no
					);
					$this->db->where('counselling_code',$counselling_code);
					$query = $this->db->update('counselling_master',$counselling_master);
					
					$this->db->select('form_no');
					$this->db->from('counselling_applicant_appl_overview');
					$this->db->where('reg_user_id',$mobile_no);
					$this->db->where('counselling_code',$counselling_code);
					$result = $this->db->get();
					//echo $this->db->last_query();die();
					$query = $result->result_array();
					$count = 0;
					foreach($result->result_array() AS $row1)
					{
						$form_no = $row1['appl_no'];
					}
					
					$this->db->select('*');
					$this->db->from('applicant_form_documents');
					$this->db->where('appl_no',$form_no);
					$result = $this->db->get();
					//echo $this->db->last_query();die();
					$query = $result->result_array();
					$count = 0;
					foreach($result->result_array() AS $row1)
					{
						$form_no = $row1['appl_no'];
						$doc_id = $row1['doc_id'];
						$document_type = $row1['document_type'];
						$document_category = $row1['document_category'];
						$document_submit_status = $row1['document_submit_status'];
						$document_submit_date = $row1['document_submit_date'];
						$submit_mode = $row1['submit_mode'];
						$document_path = $row1['document_path'];
						
						$new_data = array(
							'appl_no' => $application_no,
							'doc_id' => $doc_id,
		                    'document_type' =>$document_type,
		                    'document_category' => $document_category,
		                    'document_submit_status' => $document_submit_status,
		                    'submit_mode' => $submit_mode,
		                    'document_path' => $document_path,
		                    'document_submit_date' => $document_submit_date,
		                    'institute_code' => HARDCODE_INSTITUTE_CODE,
		                    'created_by' => $mobile_no,
		                    'created_on' => date('Y-m-d H:i:s', now())
		               	);
		               	
						if (!$this->db->insert('counselling_applicant_form_documents', $new_data))
						{
							$dbstatus = FALSE;
							$dbmessage = 'Error occur in Registred';
						}
					}
					
					$this->db->select('es.email_type,es.subject,es.content');
					$this->db->from('email_setup es');
					$this->db->join('counselling_email_setup pes','es.email_type = pes.email_type','inner');
					$this->db->limit(1);
					$this->db->where('es.email_type','COUNSELLING PASSWORD');
					$this->db->where('pes.institute_code',HARDCODE_INSTITUTE_CODE);
					
					
					
					$result = $this->db->get();
					$query = $result->result_array();
					$row_count = $result->num_rows();
					//echo $this->db->last_query(); die();
					foreach($result->result_array() AS $row1)
					{
						$email_type=$row1['email_type'];
						$subject=$row1['subject'];
						$content=$row1['content'];
					}
					$msgContent = $content;
			        $msgContent = str_replace("[jee_no]",$jee_roll_no,$msgContent );
			        $msgContent = str_replace("[name]",$full_name,$msgContent );
			        $msgContent = str_replace("[password]",$user_password,$msgContent );
					if($row_count > 0){
					    $this->load->library('email');
				     
							
					     $this->email->set_newline("\r\n");
					     $this->email->set_mailtype("html");
					     //set email information and content
					     $this->email->from('svnirtar.pget2018@gmail.com', 'NIRTAR ADMIN');
					     $this->email->to($email_id);
					     $this->email->subject($subject);
					     $this->email->message($msgContent);
					    if($this->email->send()){
						    $dbStatus = TRUE; 
						    $dbMessage = 'A mail is forwarded to your registered mail id  ';
					    }
					    else{
						    $dbStatus = FALSE; 
						    $dbMessage = 'Unable to sent Mail.Please Contact for Support';
					    }
					    //print_r($this->email->print_debugger());die();
				    }
					
					
					$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
					$this->db->from('sms_provider_setup A');
					$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
					//$this->db->where('C.program_code',$program_code);
					$this->db->where('B.record_status','1');
					$this->db->where('B.sms_type','JEE PASSWORD ACCESS');
					$this->db->where('B.status','ACTIVE');
					$result = $this->db->get();
					
					$output_data = $result->result_array();
					foreach ($output_data as $row1) 
			        {
			        	$sms_url = $row1['sms_url'];
						$user_name = $row1['user_name'];
						$password = urlencode($row1['password']);
						$sender = $row1['sender'];
						$content = $row1['content'];
						//$institute_name = $row1['institute_name'];
						$find = array("[username]", "[password]", "[sender]");
						$replace = array($user_name, $password, $sender);
						$new_sms_url = str_replace($find, $replace, $sms_url);//find and replace uid and pwd in url
						/*$findappl = array("[program name]", "[applno]");
						$replaceappl = array($program,$application_no);*/
						$findappl = array("[user_password]","[jee_roll_no]");
						$replaceappl = array($user_password,$jee_roll_no);
						$new_content = str_replace($findappl, $replaceappl, $content);
						$messageToSend = urlencode($new_content);
						//find replace url with mobileno and message
						$findmobileNo = array("[mobileno]","[message]");
						$replacemobileNo = array($mobile_no,$messageToSend);
						$smsURL = str_replace($findmobileNo,$replacemobileNo,$new_sms_url);	
			        }
			        $result =  file_get_contents($smsURL);
			        /*$ch = curl_init($smsURL );
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$result = curl_exec($ch);
					curl_close($ch);*/
					//echo $smsURL;
					
					
					
					return array('status' => $dbstatus, 'msg' => $dbmessage);
					
				}
				else
				{
					return array('status' => FALSE, 'msg' => 'You Have Entered Invalid OTP. Please Enter Again');
				}
				
			break;
			
			case 'resend_otps':
				$dbstatus = TRUE;
				$dbmessage = 'Successfully Registered';
				/*echo "hiiiii";
				die();*/
				//$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$birth_start_date = '1900-01-01';
				$birth_end_date = $date;
				
				$jee_roll_no = $this->session->userdata('jee_roll_no');
				$dob = $this->session->userdata('dob');
				//die();
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$pin = '';
				
				$this->db->select('jee_roll_no,full_name, first_name, mid_name, last_name, dob, applicant_email, applicant_mobile, gender, category');
				$this->db->from('applicant_detail');
				$this->db->where('jee_roll_no',$jee_roll_no);
				$this->db->where('dob',$dob);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$full_name = $row1['full_name'];
					$first_name = $row1['first_name'];
					$mid_name = $row1['mid_name'];
					$last_name = $row1['last_name'];
					$dob = $row1['dob'];
					$email_id = $row1['applicant_email'];
					$mobile_no = $row1['applicant_mobile'];
					$gender = $row1['gender'];
					$category = $row1['category'];
					$jee_roll_no = $row1['jee_roll_no'];
				}
				
				/*$this->db->select('pin,mobile');
				$this->db->from('counselling_applicant_reg_master');
				$this->db->where('reg_user_id',$jee_roll_no);
				$this->db->where('dob',$dob);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$pin=$row1['pin'];
					$mobile_no=$row1['mobile'];
				}*/
				$pin = $this->session->userdata('otp');
				
				if($pin != '')
				{
   					$otp = $pin;
   					//$otp = "1234";
   					
					$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
					$this->db->from('sms_provider_setup A');
					$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
					//$this->db->where('C.program_code',$program_code);
					$this->db->where('B.record_status','1');
					$this->db->where('B.sms_type','JEE REGISTRATION');
					$this->db->where('B.status','ACTIVE');
					$result = $this->db->get();
					
					$output_data = $result->result_array();
					foreach ($output_data as $row1) 
			        {
			        	$sms_url = $row1['sms_url'];
						$user_name = $row1['user_name'];
						$password = urlencode($row1['password']);
						$sender = $row1['sender'];
						$content = $row1['content'];
						//$institute_name = $row1['institute_name'];
						$find = array("[username]", "[password]", "[sender]");
						$replace = array($user_name, $password, $sender);
						$new_sms_url = str_replace($find, $replace, $sms_url);//find and replace uid and pwd in url
						/*$findappl = array("[program name]", "[applno]");
						$replaceappl = array($program,$application_no);*/
						$findappl = array("[otp]");
						$replaceappl = array($otp);
						$new_content = str_replace($findappl, $replaceappl, $content);
						$messageToSend = urlencode($new_content);
						//find replace url with mobileno and message
						$findmobileNo = array("[mobileno]","[message]");
						$replacemobileNo = array($mobile_no,$messageToSend);
						$smsURL = str_replace($findmobileNo,$replacemobileNo,$new_sms_url);	
			        }
			        /*$ch = curl_init($smsURL );
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$result = curl_exec($ch);
					curl_close($ch);*/
			        $result =  file_get_contents($smsURL);
   					
   					$this->db->select('es.email_type,es.subject,es.content');
					$this->db->from('email_setup es');
					$this->db->join('counselling_email_setup pes','es.email_type = pes.email_type','inner');
					$this->db->limit(1);
					$this->db->where('es.email_type','COUNSELLING REGISTRATION');
					$this->db->where('pes.institute_code',HARDCODE_INSTITUTE_CODE);
					
					
					
					$result = $this->db->get();
					$query = $result->result_array();
					$row_count = $result->num_rows();
					//echo $this->db->last_query(); die();
					foreach($result->result_array() AS $row1)
					{
						$email_type=$row1['email_type'];
						$subject=$row1['subject'];
						$content=$row1['content'];
					}
					$msgContent = $content;
			        $msgContent = str_replace("[jee_no]",$jee_roll_no,$msgContent );
			        $msgContent = str_replace("[name]",$full_name,$msgContent );
			        $msgContent = str_replace("[otp]",$otp,$msgContent );
					if($row_count > 0){
					    $this->load->library('email');
				     
							
					     $this->email->set_newline("\r\n");
					     $this->email->set_mailtype("html");
					     //set email information and content
					     $this->email->from('svnirtar.pget2018@gmail.com', 'NIRTAR ADMIN');
					     $this->email->to($email_id);
					     $this->email->subject($subject);
					     $this->email->message($msgContent);
					    if($this->email->send()){
						    $dbStatus = TRUE; 
						    $dbMessage = 'A mail is forwarded to your registered mail id  ';
					    }
					    else{
						    $dbStatus = FALSE; 
						    $dbMessage = 'Unable to sent Mail.Please Contact for Support';
					    }
					    //print_r($this->email->print_debugger());die();
				    }
					
			        /*$ch = curl_init($smsURL );
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$result = curl_exec($ch);
					curl_close($ch);*/
					/*echo $smsURL;
				die();*/
					return array('status' => $dbstatus, 'msg' => $dbmessage);
				}
					
				else
				{
					return array('status' => FALSE, 'msg' => 'Please Register First');
				}
			break;
			
			case 'forgot_password':
				$dbstatus = "SUCCESS";
				$dbmessage = 'Successfully Registered';
				/*echo "hiiiii";
				die();*/
				//$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$jee_roll_no =isset($_POST['jee_roll_no'])?$_POST['jee_roll_no']:'';
				//die();
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$pin = '';
        		
        		$this->db->select('count(*) as cnt');
				$this->db->from('counselling_applicant_reg_master');
				$this->db->where('reg_user_id',$jee_roll_no);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$cnt = $row1['cnt'];
				}
        		if($cnt <= 0)
        		{
					return array('status' => 'error', 'msg' => 'Invalid PGET Roll No.');
				}
				else
				{
					$this->db->select('jee_roll_no,full_name, first_name, mid_name, last_name, dob, applicant_email, applicant_mobile, gender, category');
					$this->db->from('applicant_detail');
					$this->db->where('jee_roll_no',$jee_roll_no);
					$result = $this->db->get();
					//echo $this->db->last_query();die();
					$query = $result->result_array();
					$present = 0;
					foreach($result->result_array() AS $row1)
					{
						$full_name = $row1['full_name'];
						$first_name = $row1['first_name'];
						$mid_name = $row1['mid_name'];
						$last_name = $row1['last_name'];
						$dob = $row1['dob'];
						$email_id = $row1['applicant_email'];
						$mobile_no = $row1['applicant_mobile'];
						$gender = $row1['gender'];
						$category = $row1['category'];
						$jee_roll_no = $row1['jee_roll_no'];
					}
					
					$this->db->select('password,pin,mobile');
					$this->db->from('counselling_applicant_reg_master');
					$this->db->where('reg_user_id',$jee_roll_no);
					$this->db->where('dob',$dob);
					$result = $this->db->get();
					//echo $this->db->last_query();die();
					$query = $result->result_array();
					$present = 0;
					foreach($result->result_array() AS $row1)
					{
						$user_password=$row1['password'];
					}
	   					
					$this->db->select('es.email_type,es.subject,es.content');
					$this->db->from('email_setup es');
					$this->db->limit(1);
					$this->db->where('es.email_type','COUNSELLING_CHANGE_PASSWORD');
					
					
					
					$result = $this->db->get();
					$query = $result->result_array();
					$row_count = $result->num_rows();
					//echo $this->db->last_query(); die();
					foreach($result->result_array() AS $row1)
					{
						$email_type=$row1['email_type'];
						$subject=$row1['subject'];
						$content=$row1['content'];
					}
					$msgContent = $content;
			        $msgContent = str_replace("[jee_no]",$jee_roll_no,$msgContent );
			        $msgContent = str_replace("[name]",$full_name,$msgContent );
			        $msgContent = str_replace("[password]",$user_password,$msgContent );
					if($row_count > 0){
					    $this->load->library('email');
				     
							
					     $this->email->set_newline("\r\n");
					     $this->email->set_mailtype("html");
					     //set email information and content
					     $this->email->from('svnirtar.pget2018@gmail.com', 'NIRTAR ADMIN');
					     $this->email->to($email_id);
					     $this->email->subject($subject);
					     $this->email->message($msgContent);
					    if($this->email->send()){
						    $dbStatus = TRUE; 
						    $dbMessage = 'A mail is forwarded to your registered mail id  ';
					    }
					    else{
						    $dbStatus = FALSE; 
						    $dbMessage = 'Unable to sent Mail.Please Contact for Support';
					    }
					    //print_r($this->email->print_debugger());die();
				    }
					
					
					$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
					$this->db->from('sms_provider_setup A');
					$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
					//$this->db->where('C.program_code',$program_code);
					$this->db->where('B.record_status','1');
					$this->db->where('B.sms_type','JEE PASSWORD CHANGE');
					$this->db->where('B.status','ACTIVE');
					$result = $this->db->get();
					
					$output_data = $result->result_array();
					foreach ($output_data as $row1) 
			        {
			        	$sms_url = $row1['sms_url'];
						$user_name = $row1['user_name'];
						$password = urlencode($row1['password']);
						$sender = $row1['sender'];
						$content = $row1['content'];
						//$institute_name = $row1['institute_name'];
						$find = array("[username]", "[password]", "[sender]");
						$replace = array($user_name, $password, $sender);
						$new_sms_url = str_replace($find, $replace, $sms_url);//find and replace uid and pwd in url
						/*$findappl = array("[program name]", "[applno]");
						$replaceappl = array($program,$application_no);*/
						$findappl = array("[user_password]","[jee_roll_no]");
						$replaceappl = array($user_password,$jee_roll_no);
						$new_content = str_replace($findappl, $replaceappl, $content);
						$messageToSend = urlencode($new_content);
						//find replace url with mobileno and message
						$findmobileNo = array("[mobileno]","[message]");
						$replacemobileNo = array($mobile_no,$messageToSend);
						$smsURL = str_replace($findmobileNo,$replacemobileNo,$new_sms_url);	
			        }
			       //$result =  file_get_contents($smsURL);
			        $ch = curl_init($smsURL );
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$result = curl_exec($ch);
					curl_close($ch);
					/*echo $smsURL;
				die();*/
					return array('status' => $dbstatus, 'msg' => $dbmessage);
				}
				
				
			break;
			
			case 'change_password':
				$dbStatus = "SUCCESS";
				$dbMessage = 'Changed Password Successfully';
				
				//$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$txtoldPassword =isset($_POST['txtoldPassword'])?$_POST['txtoldPassword']:'';
				$txtNewPassword =isset($_POST['txtNewPassword'])?$_POST['txtNewPassword']:'';
				$jee_roll_no = $this->session->userdata('reg_user_id');
				//die();
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				
				$this->db->select('password,pin,mobile');
				$this->db->from('counselling_applicant_reg_master');
				$this->db->where('reg_user_id',$jee_roll_no);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$user_password=$row1['password'];
				}
				/*echo $user_password;
				die();*/
   				
   				if($user_password != $txtoldPassword)
   				{
					$dbStatus = FALSE; 
					$dbMessage = 'Old Password is Incorrect';
					return array('status' => $dbStatus, 'msg' => $dbMessage);
				}
				else
				{
					$counselling_applicant_form_fee_overview = array(
						'password' => $txtNewPassword,
						'updated_by' => $jee_roll_no,
						'updated_on' => date('Y-m-d H:i:s', now())
					);
					$this->db->where('reg_user_id',$jee_roll_no);
					$regUpdate = $this->db->update('counselling_applicant_reg_master',$counselling_applicant_form_fee_overview);
					if(!$regUpdate){
						$dbStatus = FALSE;
						$dbMessage = 'Error occur in Locking';
					}
					return array('status' => $dbStatus, 'msg' => $dbMessage);
				}
			break;
			
			case 'select_linkfile_distribution':
				$dbStatus = "SUCCESS";
				$dbMessage = 'Changed Password Successfully';
				
				//$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$jee_roll_no = $this->session->userdata('reg_user_id');
				//die();
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$link_path = '';
				$this->db->select('link_path');
				$this->db->from('latest_information');
				$this->db->where('link_name','Distribution of Seats');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$link_path=$row1['link_path'];
				}
				return array('path' => $link_path);
			break;
			
			
			case 'verify_registration_data':
				$dbstatus = TRUE;
				$dbmessage = 'Successfully Logged In';
				$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				$txtJEENo =isset($_POST['txtJEENo'])?$_POST['txtJEENo']:'';
				$txtPassword =isset($_POST['txtPassword'])?$_POST['txtPassword']:'';
			
				$this->db->select('*');
				$this->db->from('counselling_applicant_reg_master');
				$this->db->where('reg_user_id',$txtJEENo);
				$this->db->where('password',$txtPassword);
				$this->db->where('institute_code','NIRTAR');
				$this->db->limit(1);
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$present = $result->num_rows();
				/*echo $present;
				die();*/
				foreach($result->result_array() AS $row2)
				{
					$institute_code = $row2['institute_code'];
					$first_name = $row2['first_name'];
					$counselling_code = $row2['counselling_code'];
				}
				
				$this->db->select('COUNT(*) AS counting1,appl_no,status');
				$this->db->from('counselling_applicant_appl_overview');
				$this->db->where('counselling_code',$counselling_code);
				$this->db->where('reg_user_id',$txtJEENo);
				$this->db->group_by('appl_no,status');
				$result = $this->db->get();
				$query = $result->result_array();
				foreach($result->result_array() AS $row1)
				{
					$appl_status = $row1['appl_status'];
					$appl_no = $row1['appl_no'];
				}
					
				
				if($present==1) 
				{
					$this->session->set_userdata('reg_user_id', $txtJEENo);
					$this->session->set_userdata('institute_code', $institute_code);
					$this->session->set_userdata('first_name', $first_name);
					$this->session->set_userdata('appl_no', $appl_no);
					$this->session->set_userdata('admcode', $counselling_code);
					$this->session->set_userdata('mode', 'new');
					$this->session->set_userdata('step', 2);
					return array('status' => $dbstatus, 'msg' => $dbmessage, 'enc_ins'=>encrypt_decrypt('encrypt', $institute_code));
				}
				else
				{
					return array('status' => FALSE, 'msg' => 'Your PGET Roll No. or Password Is Incorrect');
				}
			break;
			case 'get_branch_data_old':
				$dbstatus = TRUE;
				$dbmessage = 'Successfully Logged In';
				$program = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				$institute_code =isset($_POST['institute_code'])?$_POST['institute_code']:'';
				$program_code =isset($_POST['program_code'])?$_POST['program_code']:'';
				$branch_code =isset($_POST['branch_code'])?$_POST['branch_code']:'';
				
				$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				$course_name = $result->result_array()[0]['course_code'];
				
				$where = 'CONCAT(E.institute_name, " - ", C.program_name, " - ",  D.branch) IS NOT NULL';
				$this->db->distinct('B.branch_code');
				$this->db->select('A.branch_code, CONCAT(E.institute_name, " - ", C.program_name, " - ",  D.branch) AS branch, ipb_code ');
					$this->db->from('counselling_branch_master A');
				$this->db->join('counselling_program_branch_institute_mapping B','B.branch_code = A.branch_code','LEFT');
				$this->db->join('counselling_program_master C','C.program_code = B.program_code','LEFT');
				$this->db->join('counselling_branch_master D','D.branch_code = B.branch_code','LEFT');
				$this->db->join('institute_master E','E.institute_code = B.institute_code','LEFT');
				$this->db->where($where);
				$this->db->where('B.program_code',$course_name);
				if($institute_code != '')
				{
					$this->db->where('B.institute_code',$institute_code);
				}
				if($program_code != '')
				{
					$this->db->where('B.program_code',$program_code);
				}
				if($branch_code != '')
				{
					$this->db->where('B.branch_code',$branch_code);
				}
				$branch_code = array();
				$branch = array();
				$ipb_code = array();
				$result = $this->db->get();
				//echo $this->db->last_query();
				//die();
				foreach($result->result_array() AS $row2)
				{
					$branch_code[] = $row2['branch_code'];
					$branch[] = $row2['branch'];
					$ipb_code[] = $row2['ipb_code'];
				}
				//return $result->result_array();
				return array('branch_code' => $branch_code, 'branch' => $branch, 'ipb_code' => $ipb_code);
			break;
			
			case 'get_branch_data':
				$dbstatus = TRUE;
				$dbmessage = 'Successfully Logged In';
				$program = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				$institute_code =isset($_POST['institute_code'])?$_POST['institute_code']:'';
				$program_code =isset($_POST['program_code'])?$_POST['program_code']:'';
				$branch_code =isset($_POST['branch_code'])?$_POST['branch_code']:'';
				$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				$course_name = $result->result_array()[0]['course_code'];
				
				//$where = 'SELECT ipb_code from counselling_applicant_choice_details_temp where reg_user_id = "'.$reg_user_id.'" AND counselling_code = "'.$program.'"';
				$this->db->select('B.ipb_code,E.institute_name,C.program_name,A.branch');
				$this->db->from('counselling_branch_master A');
				$this->db->join('counselling_program_branch_institute_mapping B','B.branch_code = A.branch_code','LEFT');
				$this->db->join('counselling_program_master C','C.program_code = B.program_code','LEFT');
				$this->db->join('institute_master E','E.institute_code = B.institute_code','LEFT');
				$this->db->where('ipb_code not in(SELECT ipb_code from counselling_applicant_choice_details_temp where reg_user_id = "'.$reg_user_id.'" AND counselling_code = "'.$program.'")');
				$this->db->where('B.program_code',$course_name);
				if($institute_code != '')
				{
					$this->db->where('B.institute_code',$institute_code);
				}
				if($program_code != '')
				{
					$this->db->where('B.program_code',$program_code);
				}
				if($branch_code != '')
				{
					$this->db->where('B.branch_code',$branch_code);
				}
				
				$allApplicants = array();
				$html = '';
        		$html .= '<table class="table table-bordered table-striped" id="tblChoiceDetails">
							<thead>
								<tr>
									<th>
										<input class="Allcheckbox" type="checkbox" id="chkSelectAll" name="chkSelectAll" onclick="allcheck(\'Allcheckbox\',\'checkbox1\')"/>
									</th>
									<th class="text-center">Institute Name</th>
									<th class="text-center">Course</th>
									<th class="text-center">Branch</th>
								</tr>
							</thead>
							<tbody id="tbodyChoiceDetails">';
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	                $allApplicants[] = $row;
	            }
	            $sl_no = 1;
	            $style= '';
	            
	            foreach($allApplicants as $row)
				{
					
					$html .= '<tr'.$style.'>';
							$s = ($style == '' ? ' checked ' : '');
					$html .= '<td>
							<input type="checkbox" onclick="check()" class="checkbox1" id="chk'.$sl_no.'" name="chkChoice[]"	value="'.$row['ipb_code'].'"/>
							<td>'.$row['institute_name'].'</td>
							<td>'.$row['program_name'].'</td>
							<td>'.$row['branch'].'</td>
							</tr>';
					$sl_no++;
				}
				
			
            	$html .= '</tbody>
						</table>';
	            return array('html' => $html);
				
			break;
			
			case 'delete_temporary_data':
				$dbstatus = "SUCCESS";
				$dbmessage = "SUCCESS";
				$program = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('counselling_code',$program);
				$update_applicant_choice = $this->db->delete('counselling_applicant_choice_details_temp');
				$this->db->select('*');
				$this->db->from('counselling_applicant_choice_details');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('counselling_code',$program);
				$select = $this->db->get();
				//print_r($select->result_array());
				if($select->num_rows())
				{
					$output_data = $select->result_array();
					foreach ($output_data as $row2) 
		            {
						$ipb_code = $row2['ipb_code'];
						$sl_no = $row2['sl_no'];
						$created_by = $row2['created_by'];
						$created_on = $row2['created_on'];
						$record_status = $row2['record_status'];
						$swap_choice_2 = $row2['ipb_code'];
						$new_data = array(
							'reg_user_id' => $reg_user_id,
							'counselling_code' => $program,
							'ipb_code' => $ipb_code,
							'sl_no' => $sl_no,
							'created_by' => $created_by,
							'created_on' => $created_on,
							'record_status' => 1,
						);
						$insert = $this->db->insert('counselling_applicant_choice_details_temp',$new_data);
								
					}
				}
				return array('status' => $dbstatus, 'msg' => $dbmessage);
			break;
			case 'get_applicant_wise_institute_data':
				$dbstatus = TRUE;
				$dbmessage = 'Successfully Logged In';
				$program = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				$course_name = $result->result_array()[0]['course_code'];
			
				$this->db->distinct('B.institute_code');
				$this->db->select('B.institute_code,E.institute_name');
				$this->db->from('counselling_program_branch_institute_mapping B');
				$this->db->join('institute_master E','E.institute_code = B.institute_code','LEFT');
				$this->db->where('B.program_code',$course_name);
				$result = $this->db->get();
				//echo $this->db->last_query();
				return $result->result_array();
			break;
			case 'get_program_data_applicant':
				$institute_code = $_POST['institute'];
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				$course_name = $result->result_array()[0]['course_code'];
			
				$this->db->distinct('B.program_code');
				$this->db->select('B.program_code,E.program_name');
				$this->db->from('counselling_program_branch_institute_mapping B');
				$this->db->join('counselling_program_master E','E.program_code = B.program_code','LEFT');
				$this->db->where('B.institute_code',$institute_code);
				$this->db->where('B.program_code',$course_name);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$query = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach($query as $aRow)
				{
					$row[0] = $slno;
					$row['sl_no'] = $slno;
					$i = 1;
					foreach($aRow as $key=>$value)
					{
						
						$row[$i] = $value;
						$row[$key] = $value;
						$i++;
					}
					
					$output['aaData'][] = $row;
					$slno++;
					unset($row);
				}
				return $output;
			break;
			case 'get_final_saved_data':
				$dbstatus = TRUE;
				$dbmessage = 'Successfully Logged In';
				$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				
				$institute_code =isset($_POST['institute_code'])?$_POST['institute_code']:'';
				$program_code =isset($_POST['program_code'])?$_POST['program_code']:'';
				$branch_code =isset($_POST['branch_code'])?$_POST['branch_code']:'';
				$jee_roll_no = $this->session->userdata('reg_user_id');
			
				
				$this->db->distinct('E.ipb_code');
				$this->db->select('sl_no,C.institute_name,D.program_name,A.branch');
				$this->db->from('counselling_branch_master A');
				$this->db->join('counselling_program_branch_institute_mapping B','B.branch_code = A.branch_code','LEFT');
				$this->db->join('counselling_applicant_choice_details E','B.ipb_code = E.ipb_code ','LEFT');
				$this->db->join('institute_master C','C.institute_code = B.institute_code','LEFT');
				$this->db->join('counselling_program_master D','D.program_code = B.program_code','LEFT');
				$this->db->where('reg_user_id',$jee_roll_no);
				$this->db->order_by('sl_no');
				if($institute_code != '')
				{
					$this->db->where('B.institute_code',$institute_code);
				}
				if($program_code != '')
				{
					$this->db->where('B.program_code',$program_code);
				}
				if($branch_code != '')
				{
					$this->db->where('B.branch_code',$branch_code);
				}
				$html = '';
				$allApplicants = array();
				$html .= '<table class="table table-bordered table-striped" id="tblChoiceDetails">
							<thead>
								<tr>
									
									<th class="text-center">Choice No</th>
									<th class="text-center">Institute Name</th>
									<th class="text-center">Course</th>
									<th class="text-center">Branch</th>
								</tr>
							</thead>
							<tbody id="tbodyChoiceDetails">';
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	                $allApplicants[] = $row;
	            }
	            
	            $style= '';
	            $sl_no = 1;
	            foreach($allApplicants as $row)
				{
					
					$html .= '<tr'.$style.'>';
							$s = ($style == '' ? ' checked ' : '');
					$html .= '<td>'.$row['sl_no'].'</td>
							<td>'.$row['institute_name'].'</td>
							<td>'.$row['program_name'].'</td>
							<td>'.$row['branch'].'</td>
							</tr>';
					$sl_no++;
				}
				
            	$html .= '</tbody>
						</table>';
	            return array('html' => $html);
			break;
			case 'get_saved_data':
				$dbstatus = TRUE;
				$dbmessage = 'Successfully Logged In';
				$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				
				$institute_code =isset($_POST['institute_code'])?$_POST['institute_code']:'';
				$program_code =isset($_POST['program_code'])?$_POST['program_code']:'';
				$branch_code =isset($_POST['branch_code'])?$_POST['branch_code']:'';
				$jee_roll_no = $this->session->userdata('reg_user_id');
			
				
				$this->db->distinct('E.ipb_code');
				$this->db->select('E.ipb_code,sl_no,C.institute_name,D.program_name,A.branch');
				$this->db->from('counselling_branch_master A');
				$this->db->join('counselling_program_branch_institute_mapping B','B.branch_code = A.branch_code','LEFT');
				$this->db->join('counselling_applicant_choice_details_temp E','B.ipb_code = E.ipb_code ','LEFT');
				$this->db->join('institute_master C','C.institute_code = B.institute_code','LEFT');
				$this->db->join('counselling_program_master D','D.program_code = B.program_code','LEFT');
				$this->db->where('reg_user_id',$jee_roll_no);
				$this->db->order_by('sl_no');
				if($institute_code != '')
				{
					$this->db->where('B.institute_code',$institute_code);
				}
				if($program_code != '')
				{
					$this->db->where('B.program_code',$program_code);
				}
				if($branch_code != '')
				{
					$this->db->where('B.branch_code',$branch_code);
				}
				$html = '';
				$allApplicants = array();
				$html .= '<table class="table table-bordered table-striped" id="tblChoiceDetails">
							<thead>
								<tr>
									<th>
										<input class="Allcheckbox" type="checkbox" id="chkSelectAll" name="chkSelectAll" onclick="allcheck(\'Allcheckbox\',\'checkbox2\')"/>
									</th>
									<th class="text-center">Choice No</th>
									<th class="text-center">Institute Name</th>
									<th class="text-center">Course</th>
									<th class="text-center">Branch</th>
								</tr>
							</thead>
							<tbody id="tbodyChoiceDetails">';
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	                $allApplicants[] = $row;
	            }
	            
	            $style= '';
	            $sl_no = 1;
	            foreach($allApplicants as $row)
				{
					
					$html .= '<tr'.$style.'>';
							$s = ($style == '' ? ' checked ' : '');
					$html .= '<td>
							<input type="checkbox" onclick="check()" class="checkbox2" id="chkChoice'.$sl_no.'" name="chkChoiceSaved[]"	value="'.$row['ipb_code'].'"/>
							<td>'.$row['sl_no'].'</td>
							<td>'.$row['institute_name'].'</td>
							<td>'.$row['program_name'].'</td>
							<td>'.$row['branch'].'</td>
							</tr>';
					$sl_no++;
				}
				
            	$html .= '</tbody>
						</table>';
	            return array('html' => $html);
			break;
			case 'operation_save_data_temporary':
            	$jee_roll_no = $this->session->userdata('reg_user_id');
				$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
            	$dbstatus = true;
            	$dbmessage = 'Successfully saved';
            	
            	
			 	$arr_chkChoice = $_POST['chkChoice'];
			 	
			 	/*echo $verificationDate;
			 	die();*/
			 	
				$this->db->select_max('id');
				$query = $this->db->from('counselling_applicant_choice_details_temp');
				$this->db->where('counselling_code',$program);
				$this->db->where('reg_user_id',$jee_roll_no);
				$result = $this->db->get();
				$this->db->last_query();
				$result->num_rows();
				
				if($result->num_rows() >=1)
				{
					$output_data = $result->result_array();
					foreach ($output_data as $row) 
		            {
		            	$id = $row['id'];
						if($id != '')
						{
							$this->db->select('sl_no');
							$query = $this->db->from('counselling_applicant_choice_details_temp');
							$this->db->where('id',$id);
							$result = $this->db->get();
							$output_data = $result->result_array();
							foreach ($output_data as $row1) 
				            {
								$sl_no = $row1['sl_no'];
								$sl_no++;
							}
						}
						else
						{
							$sl_no = 1;
						}
						
						
		            }
				}
				
	            
				foreach($arr_chkChoice as $ipb_code)
				{
					$new_data = array(
						'reg_user_id' => $jee_roll_no,
						'counselling_code' => $program,
						'ipb_code' => $ipb_code,
	                    'sl_no' =>$sl_no,
	                    'created_by' => $jee_roll_no,
	                    'record_status' => 1,
	                    'created_on' => date('Y-m-d H:i:s', now())
	               	);
	               	
					if (!$this->db->insert('counselling_applicant_choice_details_temp', $new_data))
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error occur in Inserting';
					}
		            
					$sl_no++;
				}
	           	$output = array('status'=>$dbstatus,'message'=>$dbmessage);
	           	
	           	return $output; 
			break;
			case 'operation_delete_data_temporary':
            	$jee_roll_no = $this->session->userdata('reg_user_id');
				$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
            	$dbstatus = true;
            	$dbmessage = 'Successfully saved';
            	
            	
			 	$arr_chkChoice = $_POST['chkChoice'];
			 	
			 	
	            
				foreach($arr_chkChoice as $ipb_code)
				{
					$this->db->select('sl_no');
					$query = $this->db->from('counselling_applicant_choice_details_temp');
					$this->db->where('ipb_code',$ipb_code);
					$sl_no = '';
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output_data = $result->result_array();
					foreach ($output_data as $row1) 
		            {
						$sl_no = $row1['sl_no'];
					}
					if($sl_no != '')
					{
						$this->db->where('ipb_code',$ipb_code);
						$this->db->delete('counselling_applicant_choice_details_temp');
						$result = $this->db->query("UPDATE counselling_applicant_choice_details_temp SET sl_no = sl_no-1 
						                  WHERE sl_no > $sl_no AND reg_user_id = '$jee_roll_no' AND counselling_code = '$program'");
		               	
						if (!$result)
						{
							$dbstatus = FALSE;
							$dbmessage = 'Error occur in Inserting';
						}
					}
					
				}
	           	$output = array('status'=>$dbstatus,'message'=>$dbmessage);
	           	
	           	return $output; 
			break;
			case 'operation_swap_data_temporary':
            	$jee_roll_no = $this->session->userdata('reg_user_id');
				$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
            	$dbstatus = true;
            	$dbmessage = 'Successfully saved';
            	
            	
			 	$arr_chkChoice = $_POST['chkChoice'];
			 	
			 	
	            $swap_choice_1 = $arr_chkChoice[0];
	            $swap_choice_2 = $arr_chkChoice[1];
				$this->db->select('sl_no');
				$query = $this->db->from('counselling_applicant_choice_details_temp');
				$this->db->where('ipb_code',$swap_choice_1);
				$sl_no1 = '';
				$sl_no2 = '';
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				foreach ($output_data as $row1) 
	            {
					$sl_no1 = $row1['sl_no'];
				}
				$this->db->select('sl_no');
				$query = $this->db->from('counselling_applicant_choice_details_temp');
				$this->db->where('ipb_code',$swap_choice_2);
				$sl_no = '';
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				foreach ($output_data as $row2) 
	            {
					$sl_no2 = $row2['sl_no'];
				}
				$new_data1 = array(
						
	                'sl_no' =>$sl_no2
	                    
	            );
				$new_data2 = array(
						
	                'sl_no' =>$sl_no1
	                    
	            );
				$this->db->where('ipb_code',$swap_choice_1);
				$regUpdate1 = $this->db->update('counselling_applicant_choice_details_temp',$new_data1);
				$this->db->where('ipb_code',$swap_choice_2);
				$regUpdate2 = $this->db->update('counselling_applicant_choice_details_temp',$new_data2);
				if(!$regUpdate1 && !$regUpdate2)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error occur in Updating';
				}
	           	$output = array('status'=>$dbstatus,'message'=>$dbmessage);
	           	
	           	return $output; 
			break;
			case 'operation_move_up_data_temporary':
            	$jee_roll_no = $this->session->userdata('reg_user_id');
				$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
            	$dbstatus = true;
            	$dbmessage = 'Successfully saved';
            	
            	
			 	$arr_chkChoice = $_POST['chkChoice'];
			 	
			 	
	            $swap_choice_1 = $arr_chkChoice[0];
				$this->db->select('sl_no');
				$query = $this->db->from('counselling_applicant_choice_details_temp');
				$this->db->where('ipb_code',$swap_choice_1);
				$sl_no1 = '';
				$sl_no2 = '';
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				foreach ($output_data as $row1) 
	            {
					$sl_no1 = $row1['sl_no'];
				}
				$sl_no2 = $sl_no1-1;
				$this->db->select('ipb_code');
				$query = $this->db->from('counselling_applicant_choice_details_temp');
				$this->db->where('sl_no',$sl_no2);
				$this->db->where('reg_user_id',$jee_roll_no);
				$this->db->where('counselling_code',$program);
				$sl_no = '';
				$result1 = $this->db->get();
				//echo $this->db->last_query();
				$swap_choice_2 = '';
				if($result1->num_rows() >= 1)
				{
					$output_data = $result1->result_array();
					foreach ($output_data as $row2) 
		            {
						$swap_choice_2 = $row2['ipb_code'];
					}
				}
				
				$new_data1 = array(
						
	                'sl_no' =>$sl_no2
	                    
	            );
				$new_data2 = array(
						
	                'sl_no' =>$sl_no1
	                    
	            );
				if($swap_choice_2 != '')
				{
					$this->db->where('ipb_code',$swap_choice_1);
					$regUpdate1 = $this->db->update('counselling_applicant_choice_details_temp',$new_data1);
					$this->db->where('ipb_code',$swap_choice_2);
					$regUpdate2 = $this->db->update('counselling_applicant_choice_details_temp',$new_data2);
					if(!$regUpdate1 && !$regUpdate2)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error occur in Updating';
					}
				}
				
	           	$output = array('status'=>$dbstatus,'message'=>$dbmessage,'sl_no'=>$sl_no2);
	           	
	           	return $output; 
			break;
			case 'operation_move_down_data_temporary':
            	$jee_roll_no = $this->session->userdata('reg_user_id');
				$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
            	$dbstatus = true;
            	$dbmessage = 'Successfully saved';
            	
            	
			 	$arr_chkChoice = $_POST['chkChoice'];
			 	
			 	
	            $swap_choice_1 = $arr_chkChoice[0];
				$this->db->select('sl_no');
				$query = $this->db->from('counselling_applicant_choice_details_temp');
				$this->db->where('ipb_code',$swap_choice_1);
				$sl_no1 = '';
				$sl_no2 = '';
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				foreach ($output_data as $row1) 
	            {
					$sl_no1 = $row1['sl_no'];
				}
				$sl_no2 = $sl_no1+1;
				$this->db->select('ipb_code');
				$query = $this->db->from('counselling_applicant_choice_details_temp');
				$this->db->where('sl_no',$sl_no2);
				$this->db->where('reg_user_id',$jee_roll_no);
				$this->db->where('counselling_code',$program);
				$sl_no = '';
				$result1 = $this->db->get();
				//echo $this->db->last_query();
				$swap_choice_2 = '';
				if($result1->num_rows() >= 1)
				{
					$output_data = $result1->result_array();
					foreach ($output_data as $row2) 
		            {
						$swap_choice_2 = $row2['ipb_code'];
					}
				}
				
				$new_data1 = array(
						
	                'sl_no' =>$sl_no2
	                    
	            );
				$new_data2 = array(
						
	                'sl_no' =>$sl_no1
	                    
	            );
				if($swap_choice_2 != '')
				{
					$this->db->where('ipb_code',$swap_choice_1);
					$regUpdate1 = $this->db->update('counselling_applicant_choice_details_temp',$new_data1);
					$this->db->where('ipb_code',$swap_choice_2);
					$regUpdate2 = $this->db->update('counselling_applicant_choice_details_temp',$new_data2);
					if(!$regUpdate1 && !$regUpdate2)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error occur in Updating';
					}
				}
				
	           	$output = array('status'=>$dbstatus,'message'=>$dbmessage,'sl_no'=>$sl_no2);
	           	
	           	return $output; 
			break;
			
			case 'insert_branch_data':
				$dbstatus = TRUE;
				$dbmessage = 'Data Successfully Saved';
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				$jee_roll_no = $this->session->userdata('reg_user_id');
				$program = $this->session->userdata('admcode');
				
				$this->db->where('reg_user_id',$jee_roll_no);
				$this->db->where('counselling_code',$program);
				$query = $this->db->delete("counselling_applicant_choice_details");
				if($query)
				{
					$this->db->select('*');
					$this->db->from('counselling_applicant_choice_details_temp');
					$this->db->where('reg_user_id',$jee_roll_no);
					$this->db->where('counselling_code',$program);
					$select = $this->db->get();
					//print_r($select->result_array());
					if($select->num_rows())
					{
						$output_data = $select->result_array();
						foreach ($output_data as $row2) 
			            {
							$ipb_code = $row2['ipb_code'];
							$sl_no = $row2['sl_no'];
							$created_by = $row2['created_by'];
							$created_on = $row2['created_on'];
							$record_status = $row2['record_status'];
							$swap_choice_2 = $row2['ipb_code'];
							$new_data = array(
								'reg_user_id' => $jee_roll_no,
								'counselling_code' => $program,
								'ipb_code' => $ipb_code,
								'sl_no' => $sl_no,
								'created_by' => $created_by,
								'created_on' => $created_on,
								'record_status' => 1,
							);
							$insert = $this->db->insert('counselling_applicant_choice_details',$new_data);
									
						}
					}
				}
				
				return array('status' => $dbstatus, 'msg' => $dbmessage);
			break;
			
			
			case 'select_not_saved_branch_data':
				$dbstatus = TRUE;
				$dbmessage = 'Successfully Logged In';
				$program = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				$institute_code =isset($_POST['institute_code'])?$_POST['institute_code']:'';
				$program_code =isset($_POST['program_code'])?$_POST['program_code']:'';
				$branch_code =isset($_POST['branch_code'])?$_POST['branch_code']:'';
				
				$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				$course_name = $result->result_array()[0]['course_code'];
				
				$where = 'CONCAT(C.institute_name, " - ", `D`.`program_name`, " - ", A.branch) IS NOT NULL';
				$this->db->distinct('B.program_code');
				$this->db->select('sl_no,B.program_code,CONCAT(C.institute_name," - ",D.program_name," - ",A.branch) AS branch,E.ipb_code');
				$this->db->from('counselling_branch_master A');
				$this->db->join('counselling_program_branch_institute_mapping B','B.branch_code = A.branch_code','LEFT');
				$this->db->join('counselling_applicant_choice_details E','B.ipb_code = E.ipb_code ','LEFT');
				$this->db->join('institute_master C','C.institute_code = B.institute_code','LEFT');
				$this->db->join('counselling_program_master D','D.program_code = B.program_code','LEFT');
				$this->db->where($where);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->order_by('sl_no');
				$branch_code = array();
				$branch = array();
				$ipb_code = array();
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				/*echo $this->db->last_query();
				die();*/
				foreach($result->result_array() AS $row2)
				{
					$branch_code[] = $row2['program_code'];
					$branch[] = $row2['branch'];
					$ipb_code[] = $row2['ipb_code'];
				}
				
				$where = 'CONCAT(E.institute_name, " - ", C.program_name, " - ",  D.branch) IS NOT NULL';
				$this->db->distinct('B.branch_code');
				$this->db->select('A.branch_code, CONCAT(E.institute_name, " - ", C.program_name, " - ",  D.branch) AS branch, ipb_code ');
					$this->db->from('counselling_branch_master A');
				$this->db->join('counselling_program_branch_institute_mapping B','B.branch_code = A.branch_code','LEFT');
				$this->db->join('counselling_program_master C','C.program_code = B.program_code','LEFT');
				$this->db->join('counselling_branch_master D','D.branch_code = B.branch_code','LEFT');
				$this->db->join('institute_master E','E.institute_code = B.institute_code','LEFT');
				$this->db->where($where);
				$this->db->where_not_in('B.ipb_code',$ipb_code);
				$this->db->where('B.program_code',$course_name);
				
				$branch_code = array();
				$branch = array();
				$ipb_code = array();
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				foreach($result->result_array() AS $row2)
				{
					$branch_code[] = $row2['branch_code'];
					$branch[] = $row2['branch'];
					$ipb_code[] = $row2['ipb_code'];
				}
				//return $result->result_array();
				return array('branch_code' => $branch_code, 'branch' => $branch, 'ipb_code' => $ipb_code);
			break;
			
			case 'get_choices_count':
				$dbstatus = TRUE;
				$dbmessage = 'Successfully Logged In';
				$program = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				$institute_code =isset($_POST['institute_code'])?$_POST['institute_code']:'';
				$program_code =isset($_POST['program_code'])?$_POST['program_code']:'';
				$branch_code =isset($_POST['branch_code'])?$_POST['branch_code']:'';
				
				$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				$course_name = $result->result_array()[0]['course_code'];
				
				$where = 'CONCAT(E.institute_name, " - ", C.program_name, " - ",  D.branch) IS NOT NULL';
				$this->db->distinct('B.branch_code');
				$this->db->select('count(ipb_code) AS  ipb_code');
					$this->db->from('counselling_branch_master A');
				$this->db->join('counselling_program_branch_institute_mapping B','B.branch_code = A.branch_code','LEFT');
				$this->db->join('counselling_program_master C','C.program_code = B.program_code','LEFT');
				$this->db->join('counselling_branch_master D','D.branch_code = B.branch_code','LEFT');
				$this->db->join('institute_master E','E.institute_code = B.institute_code','LEFT');
				$this->db->where($where);
				$this->db->where('B.program_code',$course_name);
				$branch_code = array();
				$branch = array();
				$ipb_code = array();
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				foreach($result->result_array() AS $row2)
				{
					$count = $row2['ipb_code'];
				}
				//return $result->result_array();
				return $result->result_array();
			break;
			
			case 'select_branch_data_saved':
				$dbstatus = TRUE;
				$dbmessage = 'Successfully Logged In';
				$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				$institute_code =isset($_POST['institute_code'])?$_POST['institute_code']:'';
				$program_code =isset($_POST['program_code'])?$_POST['program_code']:'';
				$branch_code =isset($_POST['branch_code'])?$_POST['branch_code']:'';
				$jee_roll_no = $this->session->userdata('reg_user_id');
				
				$this->db->select('ipb_code');
				$this->db->from('counselling_applicant_choice_details');
				$this->db->where('reg_user_id',$jee_roll_no);
				$result = $this->db->get();
				foreach($result->result_array() AS $row2)
				{
					$ipb_code[] = $row2['ipb_code'];
				}
				
				$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$jee_roll_no);
				$result = $this->db->get();
				$course_name = $result->result_array()[0]['course_code'];
			
				$where = 'CONCAT(E.institute_name, " - ", C.program_name, " - ",  D.branch) IS NOT NULL';
				$this->db->distinct('B.branch_code');
				$this->db->select('A.branch_code, CONCAT(E.institute_name, " - ", C.program_name, " - ",  D.branch) AS branch, ipb_code ');
					$this->db->from('counselling_branch_master A');
				$this->db->join('counselling_program_branch_institute_mapping B','B.branch_code = A.branch_code','LEFT');
				$this->db->join('counselling_program_master C','C.program_code = B.program_code','LEFT');
				$this->db->join('counselling_branch_master D','D.branch_code = B.branch_code','LEFT');
				$this->db->join('institute_master E','E.institute_code = B.institute_code','LEFT');
				$this->db->where($where);
				$this->db->where('B.program_code',$course_name);
				$this->db->where_not_in('B.ipb_code', $ipb_code);
				if($institute_code != '')
				{
					$this->db->where('B.institute_code',$institute_code);
				}
				if($program_code != '')
				{
					$this->db->where('B.program_code',$program_code);
				}
				if($branch_code != '')
				{
					$this->db->where('B.branch_code',$branch_code);
				}
				$branch_code = array();
				$branch = array();
				$ipb_code = array();
				$result = $this->db->get();
				foreach($result->result_array() AS $row2)
				{
					$branch_code[] = $row2['branch_code'];
					$branch[] = $row2['branch'];
					$ipb_code[] = $row2['ipb_code'];
				}
				//return $result->result_array();
				return array('branch_code' => $branch_code, 'branch' => $branch, 'ipb_code' => $ipb_code);
			break;
			
			case 'get_saved_data_old':
				$dbstatus = TRUE;
				$dbmessage = 'Successfully Logged In';
				$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				
				$institute_code =isset($_POST['institute_code'])?$_POST['institute_code']:'';
				$program_code =isset($_POST['program_code'])?$_POST['program_code']:'';
				$branch_code =isset($_POST['branch_code'])?$_POST['branch_code']:'';
				$jee_roll_no = $this->session->userdata('reg_user_id');
			
				$where = 'CONCAT(C.institute_name, " - ", `D`.`program_name`, " - ", A.branch) IS NOT NULL';
				$this->db->distinct('B.program_code');
				$this->db->select('sl_no,B.program_code,CONCAT(C.institute_name," - ",D.program_name," - ",A.branch) AS branch,E.ipb_code');
				$this->db->from('counselling_branch_master A');
				$this->db->join('counselling_program_branch_institute_mapping B','B.branch_code = A.branch_code','LEFT');
				$this->db->join('counselling_applicant_choice_details E','B.ipb_code = E.ipb_code ','LEFT');
				$this->db->join('institute_master C','C.institute_code = B.institute_code','LEFT');
				$this->db->join('counselling_program_master D','D.program_code = B.program_code','LEFT');
				$this->db->where($where);
				$this->db->where('reg_user_id',$jee_roll_no);
				$this->db->order_by('sl_no');
				
				if($institute_code != '')
				{
					$this->db->where('B.institute_code',$institute_code);
				}
				if($program_code != '')
				{
					$this->db->where('B.program_code',$program_code);
				}
				if($branch_code != '')
				{
					$this->db->where('B.branch_code',$branch_code);
				}
				$branch_code = array();
				$branch = array();
				$ipb_code = array();
				$result = $this->db->get();
				
				foreach($result->result_array() AS $row2)
				{
					$branch_code[] = $row2['program_code'];
					$branch[] = $row2['branch'];
					$ipb_code[] = $row2['ipb_code'];
				}
				//return $result->result_array();
				return array('branch_code' => $branch_code, 'branch' => $branch, 'ipb_code' => $ipb_code);
			break;
			case 'verify_application_data':
				$dbstatus = TRUE;
				$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				$phone_no =isset($_POST['txtCandidatePhone'])?$_POST['txtCandidatePhone']:'';
				$dob =isset($_POST['txtdob'])?$_POST['txtdob']:'';
				$dob =date('Y-m-d', strtotime($dob));
				$this->db->select('A.template_code,C.file_name');
				$this->db->from('counselling_program_master A');
				$this->db->join('form_template_master C','A.template_code = C.template_code','inner');
				$this->db->where('A.program_code',$program);
				//print_r($query);
				$result = $this->db->get();
				foreach($result->result_array() AS $row2)
				{
					$file_name = $row2['file_name'];
					$template_code = $row2['template_code'];
				}
				$this->db->select('count(A.reg_user_id) AS counting');
				$this->db->from('applicant_reg_master A');
				$this->db->join('applicant_appl_overview B','A.reg_user_id = B.reg_user_id AND A.applied_program = B.applied_program','left');
				$this->db->where('A.applied_program',$program);
				$this->db->where('A.reg_user_id',$phone_no);
				$this->db->where('appl_status','Verified');
				$this->db->where('dob',$dob);
				//print_r($query);
				$result = $this->db->get();
				foreach($result->result_array() AS $row2)
				{
					$present = $row2['counting'];
					
				}
				if($present==1) 
				{
					$dbstatus = TRUE;
					$this->db->select('COUNT(*) AS counting1,appl_no,status');
					$this->db->from('applicant_appl_overview');
					$this->db->where('applied_program',$program);
					$this->db->where('reg_user_id',$phone_no);
					$this->db->group_by('appl_no,status');
					$result = $this->db->get();
					$query = $result->result_array();
					foreach($result->result_array() AS $row1)
					{
						$appl_status = $row1['appl_status'];
						$appl_no = $row1['appl_no'];
						$this->session->set_userdata('admcode', $program);
						$this->session->set_userdata('reg_user_id', $phone_no);
						$this->session->set_userdata('appl_no', $appl_no);
						$this->session->set_userdata('mode', 'edit');
						$this->session->set_userdata('step', 2);
						return array('status' => $dbstatus, 'msg' => $dbmessage,'template_file'=>'apply/'.$file_name);

					}
					return array('status' => $dbstatus, 'msg' => $dbmessage);
				}
				else
				{
					return array('status' => FALSE, 'msg' => 'Incorrect Mobile No or Date of Birth','template_file'=>'');
				}
			break;
			case 'insert_branch_data_old':
				$dbstatus = TRUE;
				$dbmessage = 'Data Successfully Saved';
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				$jee_roll_no = $this->session->userdata('reg_user_id');
				$program = $this->session->userdata('admcode');
				$ipb_codes =isset($_POST['branches'])?$_POST['branches']:array();
				
				
				$this->db->select('count(ipb_code) AS counting');
				$this->db->from('counselling_applicant_choice_details');
				$this->db->where('reg_user_id',$jee_roll_no);
				$this->db->where('counselling_code',$program);
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				foreach($result->result_array() AS $row2)
				{
					$present = $row2['counting'];
					
				}
				if($present >= 1)
				{
					$this->db->where('reg_user_id',$jee_roll_no);
					$this->db->where('counselling_code',$program);
					$update_applicant_relation2 = $this->db->delete('counselling_applicant_choice_details');
				}
				
				for($i = 0; $i < sizeof($ipb_codes); $i++)
				{
					$sl_no = $i+1;
					$present = 0;
						
					$new_data = array(
						'reg_user_id' => $jee_roll_no,
						'counselling_code' => $program,
						'ipb_code' => $ipb_codes[$i],
	                    'sl_no' =>$sl_no,
	                    'created_by' => $jee_roll_no,
	                    'record_status' => 1,
	                    'created_on' => date('Y-m-d H:i:s', now())
	               	);
	               	
					if (!$this->db->insert('counselling_applicant_choice_details', $new_data))
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error occur in Inserting';
					}
					
					
				}
				return array('status' => $dbstatus, 'msg' => $dbmessage);
			break;
			case 'lock_branch_data':
				$dbstatus = TRUE;
				$dbmessage = 'Data Successfully Locked';
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				$jee_roll_no = $this->session->userdata('reg_user_id');
				$program = $this->session->userdata('admcode');
				$ipb_codes =isset($_POST['branches'])?$_POST['branches']:array();
				
				$counselling_applicant_form_fee_overview = array(
					'appl_status' => 'Choice Locking',
					'updated_by' => $jee_roll_no,
					'updated_on' => date('Y-m-d H:i:s', now())
				);
				$this->db->where('reg_user_id',$jee_roll_no);
				$regUpdate = $this->db->update('counselling_applicant_appl_overview',$counselling_applicant_form_fee_overview);
				if(!$regUpdate){
					$dbstatus = FALSE;
					$dbmessage = 'Error occur in Locking';
				}
				
				return array('status' => $dbstatus, 'msg' => $dbmessage);
			break;
			case 'get_lock_status':
				$jee_roll_no = $this->session->userdata('reg_user_id');
				$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("count(counselling_code) AS count");
				$this->db->from('counselling_applicant_choice_details');
				$this->db->where('reg_user_id',$jee_roll_no);
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_lock_statuses':
				$jee_roll_no = $this->session->userdata('reg_user_id');
				$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("count(counselling_code) AS count");
				$this->db->from('counselling_applicant_choice_details');
				$this->db->where('reg_user_id',$jee_roll_no);
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				foreach($result->result_array() AS $row2)
				{
					$count = $row2['count'];
					
				}
				//$this->db->last_query();
				//print_r($result);
				return array('count' => $count);
			break;
			case 'get_lock_status':
				$dbstatus = TRUE;
				$dbmessage = 'Data Successfully Locked';
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				$jee_roll_no = $this->session->userdata('reg_user_id');
				$program = $this->session->userdata('admcode');
				
				$counselling_applicant_form_fee_overview = array(
					'appl_status' => 'Choice Locking',
					'updated_by' => $jee_roll_no,
					'updated_on' => date('Y-m-d H:i:s', now())
				);
				$this->db->where('reg_user_id',$jee_roll_no);
				$regUpdate = $this->db->update('counselling_applicant_appl_overview',$counselling_applicant_form_fee_overview);
				if(!$regUpdate){
					$dbstatus = FALSE;
					$dbmessage = 'Error occur in Locking';
				}
				
				return array('status' => $dbstatus, 'msg' => $dbmessage);
			break;
			case 'otp_choice_locking':
				$dbstatus = TRUE;
				$dbmessage = 'Successfully Registered';
				//$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				
				$jee_roll_no = $this->session->userdata('reg_user_id');
				$dob = $this->session->userdata('dob');
				
				$this->db->select('pin,password,mobile');
				$this->db->from('counselling_applicant_reg_master');
				$this->db->where('reg_user_id',$jee_roll_no);
				$result = $this->db->get();
				/*echo $this->db->last_query();die();
				die();*/
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$pin=$row1['pin'];
					$user_password=$row1['password'];
					$mobile_no=$row1['mobile'];
				}
				/*echo "hiiiiii";
				die();*/
				$chars = "123456789";
				$otp = substr( str_shuffle( $chars ), 0, 4 );
				
				//$otp = '1234';
				
				$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
				$this->db->from('sms_provider_setup A');
				$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
				//$this->db->where('C.program_code',$program_code);
				$this->db->where('B.record_status','1');
				$this->db->where('B.sms_type','CHOICE LOCKING ACCESS');
				$this->db->where('B.status','ACTIVE');
				$result = $this->db->get();
				
				$output_data = $result->result_array();
				foreach ($output_data as $row1) 
		        {
		        	$sms_url = $row1['sms_url'];
					$user_name = $row1['user_name'];
					$password = urlencode($row1['password']);
					$sender = $row1['sender'];
					$content = $row1['content'];
					//$institute_name = $row1['institute_name'];
					$find = array("[username]", "[password]", "[sender]");
					$replace = array($user_name, $password, $sender);
					$new_sms_url = str_replace($find, $replace, $sms_url);//find and replace uid and pwd in url
					/*$findappl = array("[program name]", "[applno]");
					$replaceappl = array($program,$application_no);*/
					$findappl = array("[otp]");
					$replaceappl = array($otp);
					$new_content = str_replace($findappl, $replaceappl, $content);
					$messageToSend = urlencode($new_content);
					//find replace url with mobileno and message
					$findmobileNo = array("[mobileno]","[message]");
					$replacemobileNo = array($mobile_no,$messageToSend);
					$smsURL = str_replace($findmobileNo,$replacemobileNo,$new_sms_url);	
		        }
		       	/*echo $smsURL;
		       	die();*/
		       	$result =  file_get_contents($smsURL);
		        /*$ch = curl_init($smsURL );
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$result = curl_exec($ch);
				curl_close($ch);*/
				
				
				
				
				$new_data = array(
	                'pin' => $otp,
	                'updated_by' => $mobile_no,
	                'updated_on' => date('Y-m-d H:i:s', now())
	           	);
	           	$this->db->where('reg_user_id',$jee_roll_no);
				if (!$this->db->update('counselling_applicant_reg_master', $new_data))
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error occur in Registred';
				}
				
				return array('status' => $dbstatus, 'msg' => $dbmessage);
					
					
					
			break;
			
			case 'otp_choice_locking_submit':
				$dbstatus = TRUE;
				$dbmessage = 'Successfully Registered';
				$jee_roll_no = $this->session->userdata('reg_user_id');
				$dob = $this->session->userdata('dob');
				//die();
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$birth_start_date = '1900-01-01';
				$birth_end_date = $date;
				$otp =isset($_POST['txtOTP'])?$_POST['txtOTP']:'';
				
				$this->db->select('pin,password,mobile');
				$this->db->from('counselling_applicant_reg_master');
				$this->db->where('reg_user_id',$jee_roll_no);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				$present = 0;
				foreach($result->result_array() AS $row1)
				{
					$pin=$row1['pin'];
					$user_password=$row1['password'];
					$mobile_no=$row1['mobile'];
				}
				
				if($pin == $otp)
				{
					return array('status' => $dbstatus, 'msg' => $dbmessage);
				}
				else
				{
					return array('status' => FALSE, 'msg' => 'You Have Entered Invalid OTP. Please Enter Again');
				}
				
			break;
			case 'temp_config':
				$seladmcode = $this->input->post('admcode');
				$expo=explode('_',$seladmcode);
				$ins_code = $expo[1];
				$ins = encrypt_decrypt('encrypt', $ins_code);
				$reg_user_id = $this->session->userdata('reg_user_id');
				$r_query6='';
				
				$this->db->select('A.template_code,B.file_name,A.apply_end_date');
				$this->db->from('counselling_program_master A');
				$this->db->join('form_template_master B','A.template_code = B.template_code','inner');
				$this->db->where('A.program_code',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() as $row)
				{
					$file_name = $row['file_name'];
				    $app_end_date = $row['apply_end_date'];
				}
				
				$this->db->select('*');
				$this->db->from('applicant_reg_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$seladmcode);
				$res1 = $this->db->get();
				
				if($res1->num_rows()){
					$r_query6 = 1;
				}
				else{
					//echo 'hi';
					$this->db->select('*');
					$this->db->from('applicant_reg_master');
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program','');
					$this->db->where('institute_code',$ins_code);
					$res2 = $this->db->get();
					if($res2->num_rows()){
						
						$data = Array (
							'applied_program' => $seladmcode
						);
						$this->db->where ('applied_program', '');
						$this->db->where ('reg_user_id', $reg_user_id);
						$this->db->update ('applicant_reg_master',$data);
					}else{
						$this->db->select('*');
						$this->db->from('applicant_reg_master');
						$this->db->where('reg_user_id',$reg_user_id);
						$this->db->where('institute_code',$ins_code);
						$this->db->limit(1);
						$res = $this->db->get();
						
						//$res = $db->rawQuery('select reg_user_id,first_name,mid_name,last_name,dob,email_id,institute_code,password from applicant_reg_master where reg_user_id=? limit 1',Array ($reg_user_id));
						$pin = rand(1000, 9999);
						//print_r($res);
						foreach($res->result_array() as $row)
						{
							$first_name= $row['first_name'];
							$mid_name= $row['mid_name'];
							$last_name= $row['last_name'];
							$email_id = $row['email_id'];
							$category_code = $row['category_code'];
							$dob = $row['dob'];
							$data = Array (
								   "reg_user_id" => $reg_user_id,
								   "first_name" => $first_name,
								   "mid_name" => $mid_name,
								   "last_name" => $last_name,
								   "email_id" => $email_id,
								   "communication_flag" => 1,
								   "category_code" => $category_code,
								   "mobile"=>$reg_user_id,
								   "dob"=>$dob,
								   "pin" => $pin,
								   "applied_program" => $seladmcode,
								   "applied_date" => date('Y-m-d H:i:s', now()),
								   "reg_mode" => 'ONLINE',
								   "reg_status" => 'Verified',
								   "institute_code" => $ins_code,
								   "created_by" => $reg_user_id,
								   "created_on" => date('Y-m-d H:i:s', now()),
								   "updated_by" => $reg_user_id,
								   "updated_on" => date('Y-m-d H:i:s', now())
									);
									
							$r_query6=$this->db->insert ('applicant_reg_master', $data);
						
						}
						
					}
				}
				if($r_query6){
					$counting1='';
					$this->db->select('COUNT(*) AS counting1,appl_no');
					$this->db->from('applicant_appl_overview');
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('institute_code',$ins_code);
					$this->db->where('applied_program',$seladmcode);
					$this->db->group_by('appl_no');
					$result1=$this->db->get();
					foreach($result1->result_array() as $row){
						$counting1 = $row['counting1'];
					}
					
					if($counting1==1){
						$this->session->set_userdata('application_no', $row6['appl_no']);
					}
					$this->session->set_userdata('admcode', $seladmcode);
					$this->session->set_userdata('step', 2);
					
					$data = Array (
								   "login_id" => $reg_user_id,
								   "login_role" => 'applicant',
								   "ip_address" => $this->input->ip_address(),
								   "created_by" => $reg_user_id,
								   "created_on" => date('Y-m-d H:i:s', now()),
								   "record_status"=>'Active'
									);
									$inserted_login_detail = $this->db->insert ('login_detail', $data);
									//------------------------------------------------
									if(!$inserted_login_detail){
										$dbStatus = "ERROR";
										$dbMessage = "ERROR inserting login_detail";
										$dbError = $db->getLastError();
									}
					
					$output['file'][] = $file_name;
					$output['ins'][] = $ins;
				
				}else{
					$output['file'][] = 'error';
				}
				
				return $output;
			break;
			
			case 'course_modal':
				 $seladmcode = $this->input->post('admcode');
					$this->db->select("A.prog_code, B.program_name , A.description");
					$this->db->from('course_details A ');
					$this->db->join('counselling_program_master B','A.prog_code = B.program_code','inner');
					$this->db->where('B.program_code',$seladmcode);
					$result = $this->db->get();
					foreach($result->result_array() AS $row)
					{
						$temp_prog_code = $row['prog_code'];
					}
					return $result->result_array();
					
			break;
			
			case 'chk_admt_card_data':
				$dbstatus = TRUE;
				$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$today = date('Y-m-d');
				$present = 0;
				$phone_no =isset($_POST['txtCandidatePhone'])?$_POST['txtCandidatePhone']:'';
				$dob =isset($_POST['txtdob'])?$_POST['txtdob']:'';
				$dob =date('Y-m-d', strtotime($dob));
				$this->db->select('A.template_code,C.file_name');
				$this->db->from('counselling_program_master A');
				$this->db->join('form_template_master C','A.template_code = C.template_code','inner');
				$this->db->where('A.program_code',$program);
				//print_r($query);
				$result = $this->db->get();
				foreach($result->result_array() AS $row2)
				{
					$file_name = $row2['file_name'];
					$template_code = $row2['template_code'];
				}
				$this->db->select('count(A.reg_user_id) AS counting');
				$this->db->from('applicant_reg_master A');
				$this->db->join('applicant_appl_overview B','A.reg_user_id = B.reg_user_id AND A.applied_program = B.applied_program','left');
				$this->db->where('A.applied_program',$program);
				$this->db->where('A.reg_user_id',$phone_no);
				$this->db->where('appl_status','Verified');
				$this->db->where('dob',$dob);
				//print_r($query);
				$result = $this->db->get();
				foreach($result->result_array() AS $row2)
				{
					$present = $row2['counting'];
					
				}
				
				$this->db->select('appl_status,reg_user_id');
				$this->db->from('applicant_appl_overview');
				$this->db->where('reg_user_id',$phone_no);
				$this->db->where('applied_program',$program);
				//print_r($query);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				foreach($result->result_array() AS $row2)
				{
					$status = $row2['appl_status'];
					
				}
				
				if($present==1 && $status == 'Verified') 
				{
					$dbstatus = TRUE;
					$this->db->select('A.appl_no,A.applied_program,A.assigned_exam_center,A.assigned_exam_vanue ');
					$this->db->from('admitcard_published A');
					$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no AND A.applied_program = B.applied_program','inner');
					$this->db->where('A.applied_program',$program);
					$this->db->where('B.reg_user_id',$phone_no);
					//print_r($query);
					$result = $this->db->get();
					/*echo $this->db->last_query();
					die();*/
					foreach($result->result_array() AS $row)
					{
						$applied_program = $row['applied_program'];
						$assigned_exam_center = $row['assigned_exam_center'];
						$assigned_exam_vanue = $row['assigned_exam_vanue'];
						
					}
					
					$this->db->select('count(program_code) as count');
					$this->db->from('admitcard_setup ');
					$this->db->where('program_code',$applied_program);
					$this->db->where('exam_center_code',$assigned_exam_center);
					$this->db->where('exam_vanue_code',$assigned_exam_vanue);
					$this->db->where('admit_card_available_from <=',$today);
					$this->db->where('admit_card_available_upto >=',$today);
					$result = $this->db->get();
					/*echo $this->db->last_query();
					die();*/
					foreach($result->result_array() AS $row)
					{
						$count = $row['count'];
					}
					
					if($count == 1)
					{
						$this->db->select('COUNT(*) AS counting1,appl_no,status,appl_status');
						$this->db->from('applicant_appl_overview');
						$this->db->where('applied_program',$program);
						$this->db->where('reg_user_id',$phone_no);
						$result = $this->db->get();
						/*echo $this->db->last_query();
						die();*/
						$query = $result->result_array();
						foreach($result->result_array() AS $row1)
						{
							$appl_status = $row1['appl_status'];
							$appl_no = $row1['appl_no'];
							$this->session->set_userdata('admcode', $program);
							$this->session->set_userdata('reg_user_id', $phone_no);
							$this->session->set_userdata('appl_no', $appl_no);
							$this->session->set_userdata('exam_center_code', $assigned_exam_center);
							$this->session->set_userdata('exam_vanue_code', $assigned_exam_vanue);
							$this->session->set_userdata('mode', 'edit');
							$this->session->set_userdata('step', 2);
						}
						return array('status' => $dbstatus, 'msg' => $dbmessage);
						//header("location: admitcard.php?_s=$MY_SESSION_NAME");
						//echo "<script>window.open('admitcard.php','_blank').focus();</script>";
					}
					else
					{
						$this->db->select('count(program_code) as count');
						$this->db->from('admitcard_setup ');
						$this->db->where('program_code',$applied_program);
						$this->db->where('exam_center_code',$assigned_exam_center);
						$this->db->where('exam_vanue_code',$assigned_exam_vanue);
						$this->db->where('admit_card_available_from <=',$today);
						$result = $this->db->get();
						foreach($result->result_array() AS $row)
						{
							$count_date = $row['count'];
						}
						if($count_date == 1)
						{
							return array('status' => FALSE, 'msg' => 'Admit Card Available Date has not Started.','template_file'=>'');
						}
						else
						{
							$this->db->select('count(program_code) as count');
							$this->db->from('admitcard_setup ');
							$this->db->where('program_code',$applied_program);
							$this->db->where('exam_center_code',$assigned_exam_center);
							$this->db->where('exam_vanue_code',$assigned_exam_vanue);
							$this->db->where('admit_card_available_upto >=',$today);
							$result = $this->db->get();
							foreach($result->result_array() AS $row)
							{
								$count_end_date = $row['count'];
							}
							if($count_end_date == 1)
							{
								return array('status' => FALSE, 'msg' => 'Admit Card Available Date has Expired.','template_file'=>'');
								//$show1=11;
							}
							else
							{
								return array('status' => FALSE, 'msg' => 'Your Admit Card is not Published','template_file'=>'');
							}
						}	
					
					}
					
					
					//return array('status' => $dbstatus, 'msg' => $dbmessage);
				}
				else
				{
					return array('status' => FALSE, 'msg' => 'Incorrect Mobile No or Date of Birth','template_file'=>'');
				}
			break;
			case 'add_application_data':
				$dbstatus = TRUE;
				$cmbExamCenter = isset($_POST['cmbExamCenter']) ? $_POST['cmbExamCenter'] : 'C001';
				$txtFirstName = isset($_POST['txtFirstName']) ? trim($_POST['txtFirstName']) : '';

				$master_name = isset($_POST['master_name']) ? trim($_POST['master_name']) : '';
				$center_name1 = isset($_POST['center_name1']) ? trim($_POST['center_name1']) : '';
				$center_code1 = isset($_POST['center_code1']) ? trim($_POST['center_code1']) : '';
				$center_name2 = isset($_POST['center_name2']) ? trim($_POST['center_name2']) : '';
				$center_code2 = isset($_POST['center_code2']) ? trim($_POST['center_code2']) : '';
				$center_name3 = isset($_POST['center_name3']) ? trim($_POST['center_name3']) : '';
				$center_code3 = isset($_POST['center_code3']) ? trim($_POST['center_code3']) : '';

				$FathersProfession = isset($_POST['FathersProfession']) ? trim($_POST['FathersProfession']) : '';
				$FathersIncome = isset($_POST['FathersIncome']) ? trim($_POST['FathersIncome']) : '';
				$cmbNorthState = isset($_POST['cmbNorthState']) ? trim($_POST['cmbNorthState']) : '';

				$txtMotherName = isset($_POST['txtMotherName']) ? trim($_POST['txtMotherName']) : '';
				$MothersProfession = isset($_POST['MothersProfession']) ? trim($_POST['MothersProfession']) : '';
				$MothersIncome = isset($_POST['MothersIncome']) ? trim($_POST['MothersIncome']) : '';
				
				$mothers_adhar_no = isset($_POST['txtUidM']) ? trim($_POST['txtUidM']) : '';
				$fathers_adhar_no = isset($_POST['txtUidF']) ? trim($_POST['txtUidF']) : '';
				$txtUid = isset($_POST['txtUid']) ? trim($_POST['txtUid']) : '';
				 



				$employed = isset($_POST['employed']) ? trim($_POST['employed']) : '';
				$Employer_address = isset($_POST['Employer_address']) ? trim($_POST['Employer_address']) : '';
				$Employer_from = isset($_POST['Employer_from']) ? trim($_POST['Employer_from']) : '';
				$Employer_to = isset($_POST['Employer_to']) ? trim($_POST['Employer_to']) : '';
				$Employer_address1 = isset($_POST['Employer_address1']) ? trim($_POST['Employer_address1']) : '';
				$Employer_from1 = isset($_POST['Employer_from1']) ? trim($_POST['Employer_from1']) : '';
				$Employer_to1 = isset($_POST['Employer_to1']) ? trim($_POST['Employer_to1']) : '';




				$cand_name = isset($_POST['cand_name']) ? trim($_POST['cand_name']) : '';
				$co_name = isset($_POST['co_name']) ? trim($_POST['co_name']) : '';
				$city_name = isset($_POST['city_name']) ? trim($_POST['city_name']) : '';
				$phone_no = isset($_POST['phone_no']) ? trim($_POST['phone_no']) : '';
				$cand_name1 = isset($_POST['cand_name1']) ? trim($_POST['cand_name1']) : '';
				$co_name1 = isset($_POST['co_name1']) ? trim($_POST['co_name1']) : '';
				$city_name1 = isset($_POST['city_name1']) ? trim($_POST['city_name1']) : '';
				$phone_no1 = isset($_POST['phone_no1']) ? trim($_POST['phone_no1']) : '';
				$completion_date = isset($_POST['completion_date']) ? trim($_POST['completion_date']) : '';
				$amount_paid = isset($_POST['amount_paid']) ? trim($_POST['amount_paid']) : '';
				$draft_no = isset($_POST['draft_no']) ? trim($_POST['draft_no']) : '';
				$payment_date = isset($_POST['payment_date']) ? trim($_POST['payment_date']) : '';
				$bank_name = isset($_POST['bank_name']) ? trim($_POST['bank_name']) : '';

				/*te*/

				

				$txtMiddleName = isset($_POST['txtMiddleName']) ?  trim($_POST['txtMiddleName']) : '';
				$txtLastName = isset($_POST['txtLastName']) ? trim($_POST['txtLastName']) : '';
				$fullname = $txtFirstName." ".$txtMiddleName." ".$txtLastName;

				$d = isset($_POST['cmbDay']) ? trim($_POST['cmbDay']) : '';
				$m = isset($_POST['cmbMonth']) ? trim($_POST['cmbMonth']) : '';
				$y = isset($_POST['cmbYear']) ? trim($_POST['cmbYear']) : '';
				$dob = $y.'-'.$m.'-'.$d;

				$dbStatus = "";
				$dbMessage = "";
				$dbError = "";

				$radiogender = isset($_POST['radiogender']) ? $_POST['radiogender'] : '';
				$radioHostel = isset($_POST['radioHostel']) ? $_POST['radioHostel'] : '';
				$radiomaritalstatus = isset($_POST['radiomaritalstatus']) ? $_POST['radiomaritalstatus'] : '';
				$radioQuota = isset($_POST['radioQuota']) ? $_POST['radioQuota'] : '';
				
				$cmbReservedCategory = isset($_POST['cmbCommunity']) ? $_POST['cmbCommunity'] : '';
				
				$cmbNationality = isset($_POST['cmbNationality']) ? $_POST['cmbNationality'] : '';
				$cmbCommunity = isset($_POST['cmbCommunity1']) ? $_POST['cmbCommunity1'] : '';

				$cmbrelationship = isset($_POST['cmbrelationship']) ? $_POST['cmbrelationship'] : '';
				$radioMinority = isset($_POST['radioMinority']) ? $_POST['radioMinority'] : '';
				$txtemail = isset($_POST['txtemail']) ? $_POST['txtemail'] : '';
				$txtemail1 = isset($_POST['txtemail1']) ? $_POST['txtemail1'] : '';
				$radiobelong = isset($_POST['radiobelong']) ? $_POST['radiobelong'] : '';
				$txtOccupation = isset($_POST['txtOccupation']) ? $_POST['txtOccupation'] : '';
				$txtIncome = isset($_POST['txtIncome']) ? $_POST['txtIncome'] : '';
				$txtIndicate = isset($_POST['txtIndicate']) ? $_POST['txtIndicate'] : '';
				$txtKnowabout = isset($_POST['txtKnowabout']) ? $_POST['txtKnowabout'] : '';
				$radioPhysicallY  = isset($_POST['radioPhysicallY']) ? $_POST['radioPhysicallY'] : '';
				$txtphtype  = isset($_POST['txtphtype']) ? $_POST['txtphtype'] : '';
				
				$txtOtherNationality = isset($_POST['txtOtherNationality']) ? trim($_POST['txtOtherNationality']) : '';
				$txtOtherRelations = isset($_POST['txtOtherRelations']) ? trim($_POST['txtOtherRelations']) : '';
				$txtMotherTongue = isset($_POST['txtMotherTongue']) ? trim($_POST['txtMotherTongue']) : '';
				$cmbCategory = isset($_POST['cmbCategory']) ? $_POST['cmbCategory'] : '';
				$cmbReligion = isset($_POST['cmbReligion']) ? $_POST['cmbReligion'] : '';
				$txtUnivRegNo = isset($_POST['txtUnivRegNo']) ? $_POST['txtUnivRegNo'] : '';
				//$cmbHighestQualification = isset($_POST['txtQualifyingDegree']) ? $_POST['txtQualifyingDegree'] : '';
				$cmbPassStatus = isset($_POST['cmbPassStatus']) ? $_POST['cmbPassStatus'] : '';
				$txtSubject1 = isset($_POST['txtSubject1']) ? $_POST['txtSubject1'] : '';
				$txtSubject2 = isset($_POST['txtSubject2']) ? $_POST['txtSubject2'] : '';
				$txtSubject3 = isset($_POST['txtSubject3']) ? $_POST['txtSubject3'] : '';
				$txtSubject4 = isset($_POST['txtSubject4']) ? $_POST['txtSubject4'] : '';
				$txtUnivName = isset($_POST['txtUnivName']) ? $_POST['txtUnivName'] : '';
				$txtTotalMarks = isset($_POST['txtTotalMarks']) ? $_POST['txtTotalMarks'] : '';
				$txtHonsTotalMarks = isset($_POST['txtHonsTotalMarks']) ? $_POST['txtHonsTotalMarks'] : '';
				$txtHonoursSubject = isset($_POST['txtHonoursSubject']) ? $_POST['txtHonoursSubject'] : '';
				$txtSecuredMarks = isset($_POST['txtSecuredMarks']) ? $_POST['txtSecuredMarks'] : '';
				$txtHonsSecuredMarks = isset($_POST['txtHonsSecuredMarks']) ? $_POST['txtHonsSecuredMarks'] : '';
				$radioDistinction = isset($_POST['radioDistinction']) ? $_POST['radioDistinction'] : '';
				$radioCourseType = isset($_POST['radioCourseType']) ? $_POST['radioCourseType'] : '';
				$cmbHighestQualification = isset($_POST['cmbHighestQualification']) ? trim($_POST['cmbHighestQualification']) : '';
				$txtHonsDivision = isset($_POST['txtHonsDivision']) ?  trim($_POST['txtHonsDivision']) : '';
				$radioMigrant = isset($_POST['radioMigrant']) ?  trim($_POST['radioMigrant']) : 'NO';
				//Parent Information
				$txtFatherName = isset($_POST['txtFatherName']) ?  trim($_POST['txtFatherName']) : '';
				$txtFatherOccupation = isset($_POST['txtFatherOccupation']) ?  trim($_POST['txtFatherOccupation']) : '';
				$txtMotherName = isset($_POST['txtMotherName']) ? trim($_POST['txtMotherName']) : '';
				$txtMotherOccupation = isset($_POST['txtMotherOccupation']) ?  trim($_POST['txtMotherOccupation']) : '';
				$txtGuardianName = isset($_POST['txtGuardianName']) ?  trim($_POST['txtGuardianName']) : '';
				$txtGuardianOccupation = isset($_POST['txtGuardianOccupation']) ?  trim($_POST['txtGuardianOccupation']) : '';
				//Address
				//present
				$txtPresentAddress = isset($_POST['txtPresentAddress']) ?  trim($_POST['txtPresentAddress']) : '';
				$txtPresentLocality = isset($_POST['txtPresentLocality']) ? trim($_POST['txtPresentLocality']) : '';
				$txtPresentPost = isset($_POST['txtPresentPost']) ? trim($_POST['txtPresentPost']) : '';
				$cmbPresentDist = isset($_POST['cmbPresentDist']) ?  trim($_POST['cmbPresentDist']) : '';
				$txtPresentPin = isset($_POST['txtPresentPin']) ? trim($_POST['txtPresentPin']) : '';
				$cmbPresentState = isset($_POST['cmbPresentState']) ? trim($_POST['cmbPresentState']) : '';
				$txtPresentDistance = isset($_POST['txtPresentDistance']) ? trim($_POST['txtPresentDistance']) : '';

				//if permanent is same as present
				$chksameasresidential = isset($_POST['chksameasresidential']) ? $_POST['chksameasresidential']:'N';
				$txtPermenentAddress = isset($_POST['hidPermenentAddress']) ? trim($_POST['hidPermenentAddress']) : '';
				$txtPermenentLocality = isset($_POST['txtPermenentLocality']) ? trim($_POST['txtPermenentLocality']) : '';
				$txtPermanentPost = isset($_POST['txtPermanentPost']) ? trim($_POST['txtPermanentPost']) : '';
				$txtPermanentDist = isset($_POST['cmbPermanentDist']) ? trim($_POST['cmbPermanentDist']) : '';
				$txtPermanentState = isset($_POST['cmbPermanentState']) ?  trim($_POST['cmbPermanentState']) : '';
				$txtPermanentPin = isset($_POST['txtPermanentPin']) ? trim($_POST['txtPermanentPin']) : '';
				$txtPermanentMobile = isset($_POST['txtPermanentMobile']) ? trim($_POST['txtPermanentMobile']) : '';
				
					
				$txtApplicantEmail = isset($_POST['txtApplicantEmail']) ? trim($_POST['txtApplicantEmail']) : '';
				$txtApplicantLandLine = isset($_POST['txtApplicantLandLine']) ?  trim($_POST['txtApplicantLandLine']) : '';
				$txtApplicantMobile = isset($_POST['txtApplicantMobile']) ?  trim($_POST['txtApplicantMobile']) : '';
				$txtOtherUniversity = isset($_POST['txtOtherUniversity']) ?  trim($_POST['txtOtherUniversity']) : '';
				if($txtUnivName != 'OTH')
				{
					$txtOtherUniversity = '';
				}
				$txtOtherSubject = isset($_POST['txtOtherSubject']) ? trim($_POST['txtOtherSubject']) : '';
				if($txtHonoursSubject != 'OTH')
				{
					$txtOtherSubject = '';
				}
				//Academic Details
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.qualification_code, B.qualification_name, B.division");
				$this->db->from('program_qualification_setup A');
				$this->db->join('qualification_master B','A.qualification_code = B.qualification_code','inner');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.id');
				
				
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//print_r($result);
				$allQualifications = $result->result_array();
				$slno = 1;
				foreach($allQualifications as $row)
				{
					${'txtQualification'.$slno} = isset($_POST['txtQualification'.$slno]) && $_POST['txtQualification'.$slno] != '' ? $_POST['txtQualification'.$slno] : '';
					${'txtYear'.$slno} = isset($_POST['txtYear'.$slno]) && trim($_POST['txtYear'.$slno]) != '' ? (int) trim($_POST['txtYear'.$slno]) : 'NULL';
					${'txtBoard'.$slno} = isset($_POST['txtBoard'.$slno]) && $_POST['txtBoard'.$slno] != '' ? $_POST['txtBoard'.$slno] : '';
					${'txtDivision'.$slno} = isset($_POST['txtDivision'.$slno]) && $_POST['txtDivision'.$slno] != '' ? $_POST['txtDivision'.$slno] : '';
					${'txtMS'.$slno} = isset($_POST['txtMS'.$slno]) && $_POST['txtMS'.$slno] != '' ? $_POST['txtMS'.$slno] : 'NULL';
					${'txtFM'.$slno} = isset($_POST['txtFM'.$slno]) && $_POST['txtFM'.$slno] != '' ? $_POST['txtFM'.$slno] : 'NULL';
					${'txtPercent'.$slno} = isset($_POST['txtPercent'.$slno]) && $_POST['txtPercent'.$slno] != '' ? $_POST['txtPercent'.$slno] : 'NULL';
					$slno++;
					//echo $_POST['txtQualification'.$slno];
				}
				$txtQualification3 = isset($_POST['txtQualification3']) && $_POST['txtQualification3'] != '' ? $_POST['txtQualification3'] : '';
				$txtYear3 = isset($_POST['txtYear3']) && trim($_POST['txtYear3']) != '' ? (int) trim($_POST['txtYear3']) : 'NULL';
				$txtBoard3 = isset($_POST['txtBoard3']) && $_POST['txtBoard3'] != '' ? $_POST['txtBoard3'] : '';
				$txtDivision3 = isset($_POST['txtDivision3']) && $_POST['txtDivision3'] != '' ? $_POST['txtDivision3'] : '';
				$txtMS3 = isset($_POST['txtMS3']) && $_POST['txtMS3'] != '' ? $_POST['txtMS3'] : 'NULL';
				$txtFM3 = isset($_POST['txtFM3']) && $_POST['txtFM3'] != '' ? $_POST['txtFM3'] : 'NULL';
				$txtPercent3 = isset($_POST['txtPercent3']) && $_POST['txtPercent3'] != '' ? $_POST['txtPercent3'] : 'NULL';
				//Entrance exam appeared
				  
				$txtQualification4 = isset($_POST['txtQualification4']) && $_POST['txtQualification4'] != '' ? $_POST['txtQualification4'] : '';
				$txtYear4 = isset($_POST['txtYear4']) && trim($_POST['txtYear4']) != '' ? (int) trim($_POST['txtYear4']) : 'NULL';
				$txtBoard4 = isset($_POST['txtBoard4']) && $_POST['txtBoard4'] != '' ? $_POST['txtBoard4'] : '';
				$txtDivision4 = isset($_POST['txtDivision4']) && $_POST['txtDivision4'] != '' ? $_POST['txtDivision4'] : '';
				$txtMS4 = isset($_POST['txtMS4']) && $_POST['txtMS4'] != '' ? $_POST['txtMS4'] : 'NULL';
				$txtFM4 = isset($_POST['txtFM4']) && $_POST['txtFM4'] != '' ? $_POST['txtFM4'] : 'NULL';
				$txtPercent4 = isset($_POST['txtPercent4']) && $_POST['txtPercent4'] != '' ? $_POST['txtPercent4'] : 'NULL';
				
				$txtQualification5 = isset($_POST['txtQualification5']) && $_POST['txtQualification5'] != '' ? $_POST['txtQualification5'] : '';
				$txtYear5 = isset($_POST['txtYear5']) && trim($_POST['txtYear5']) != '' ? (int) trim($_POST['txtYear5']) : 'NULL';
				$txtBoard5 = isset($_POST['txtBoard5']) && $_POST['txtBoard5'] != '' ? $_POST['txtBoard5'] : '';
				$txtDivision5 = isset($_POST['txtDivision5']) && $_POST['txtDivision5'] != '' ? $_POST['txtDivision5'] : '';
				$txtMS5 = isset($_POST['txtMS5']) && $_POST['txtMS5'] != '' ? $_POST['txtMS5'] : 'NULL';
				$txtFM5 = isset($_POST['txtFM5']) && $_POST['txtFM5'] != '' ? $_POST['txtFM5'] : 'NULL';
				$txtPercent5 = isset($_POST['txtPercent5']) && $_POST['txtPercent5'] != '' ? $_POST['txtPercent5'] : 'NULL';
				  
				//
				
				$radioExam = isset($_POST['radioExam']) ? $_POST['radioExam'] : '';
				$hidDate = isset($_POST['hidDate']) ? $_POST['hidDate'] : '';
				$txtExamMark = isset($_POST['txtExamMark']) && trim($_POST['txtExamMark']) != '' ? (float) trim($_POST['txtExamMark']) : 'NULL';
				$txtfinalpercentage = isset($_POST['txtfinalpercentage']) && trim($_POST['txtfinalpercentage']) != '' ? (float) trim($_POST['txtfinalpercentage']) : 'NULL';
				//$chkMAT = isset($_POST['chkMAT']) ? mysqli_real_escape_string($con, trim($_POST['chkMAT'])) : '';
				//$chkIACR = isset($_POST['chkIACR']) ? mysqli_real_escape_string($con, trim($_POST['chkIACR'])) : '';
				//$chkUU = isset($_POST['chkUU']) ? mysqli_real_escape_string($con, trim($_POST['chkUU'])) : '';

				//declaration
				$chkUndertaking1 = 1;
				$chkUndertaking2 = 2;
				$chkUndertaking3 = 3;
				$declaration1 = "I declare that the particulars furnished in this form are true to the best of my knowledge and belief and as per my certificates and valid official documents. I further declare that in case any of the above information is found to be incorrect at any time, I shall be liable to forfeit my seat and to such penal action as the University may deem appropriate.";
				$declaration2 = "I undertake to abide by the rules of the P.G. Council and P.G. Hostels, framed by the Berhampur University and if at any time, in any instance of breach of these rules, indiscipline, disobedience or misconduct or involvement in ragging is found against me, my name shall be struck off from the rolls of the University. ";
				$declaration3 = "I have understood the various provisions and rules of eligibility and admission to various P.G. Departments of Berhampur University as mentioned in the Prospectus along with the application form and I undertake to abide by any decision taken by the University authorities in regard to my eligibility and admission into P.G. Departments.";
				$chkApplicantUndertaking = isset($_POST['chkApplicantUndertaking']) ? mysqli_real_escape_string($con, trim($_POST['chkApplicantUndertaking'])) : '';
				$now = date("Y-m-d H:i:s");
				$mode = $this->session->userdata('mode');
				
				//echo $mode;die();
				if($mode == 'edit')
				{
					$this->db->trans_start();
					$dbstatus = TRUE;
					$dbmessage = 'Data saved successfully';
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					//print_r($applicant_master_update_array);die();
					/*$update_applicant = $this->db->update('applicant_master',$applicant_master_update_array);
					if(!$update_applicant){
						$dbstatus = FALSE;
						$dbmessage = 'Error updating applicant_master';
					}*/
					$this->db->select("CASE WHEN comm_address_ref_id = perm_address_ref_id THEN 'Y' ELSE 'N' END AS addresscheck,comm_address_ref_id, perm_address_ref_id");
					$this->db->from('applicant_master');
					$this->db->where('applied_program',$program_code);
					$this->db->where('reg_user_id',$reg_user_id);
					$result = $this->db->get();
					foreach($result->result_array() as $row)
					{
						$sameaspresent = $row['addresscheck'];
						$comm_address_ref_id = $row['comm_address_ref_id'];
						$perm_address_ref_id = $row['perm_address_ref_id'];
						
		
					}
					if($chksameasresidential == $sameaspresent && $chksameasresidential=='Y')
					{
						$applicant_address_array = array(
							'address_1' => $txtPresentLocality,
							'post_office' => $txtPresentPost,
							'district_code' => $cmbPresentDist,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'cand_name'=>$cand_name, 
							'co_name'=>$co_name,
							'city_name'=>$city_name, 
							'mobile'=>$phone_no, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant_address = $this->db->update('applicant_address',$applicant_address_array);
						if(!$update_applicant_address){
							$dbstatus = FALSE;
							$dbmessage = 'Error updating applicant_address_all';
						}
					}
					else if($chksameasresidential == $sameaspresent && $chksameasresidential=='N')
					{
						$applicant_address_array1 = array(
							'address_1' => $txtPresentLocality,
							'post_office' => $txtPresentPost,
							'district_code' => $cmbPresentDist,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'cand_name'=>$cand_name, 
							'co_name'=>$co_name,
							'city_name'=>$city_name, 
							'mobile'=>$phone_no, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant_address = $this->db->update('applicant_address',$applicant_address_array1);
						if(!$update_applicant_address){
							$dbstatus = FALSE;
							$dbmessage = 'Error updating applicant_address_present';
						}
						$applicant_address_array2 = array(
							'address_1' => $txtPermenentLocality,
							'post_office' => $txtPermanentPost,
							'district_code' => $txtPermanentDist,
							'state_code' => $txtPermanentState,
							'pin' => $txtPermanentPin,
							'email_id'=>$txtemail1, 
							'cand_name'=>$cand_name1, 
							'co_name'=>$co_name1, 
							'city_name'=>$city_name1, 
							'mobile'=>$phone_no1, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$perm_address_ref_id);
						$update_applicant_address = $this->db->update('applicant_address',$applicant_address_array2);
						if(!$update_applicant_address){
							$dbstatus = FALSE;
							$dbmessage = 'Error updating applicant_address_permanent';
						}
						
					}
					else if($chksameasresidential != $sameaspresent && $chksameasresidential=='Y')
					{
						$applicant_address_array3 = array(
							'address_1' => $txtPresentLocality,
							'post_office' => $txtPresentPost,
							'district_code' => $cmbPresentDist,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'cand_name'=>$cand_name, 
							'co_name'=>$co_name,
							'city_name'=>$city_name, 
							'mobile'=>$phone_no, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant = $this->db->update('applicant_address',$applicant_address_array3);
						if(!$update_applicant){
							$dbstatus = FALSE;
							$dbmessage = 'Error updating applicant_address_present';
						}
						$perm_address_ref_id=$comm_address_ref_id;
					}
					else if($chksameasresidential != $sameaspresent && $chksameasresidential=='N')
					{
						$applicant_address_array4 = array(
							'address_1' => $txtPresentLocality,
							'post_office' => $txtPresentPost,
							'district_code' => $cmbPresentDist,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'cand_name'=>$cand_name, 
							'co_name'=>$co_name,
							'city_name'=>$city_name, 
							'mobile'=>$phone_no, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant = $this->db->update('applicant_address',$applicant_address_array4);
						if(!$update_applicant){
							$dbstatus = FALSE;
							$dbmessage = 'Error updating applicant_address_present';
						}else{
							$applicant_address_array2 = array(
								'address_1' => $txtPermenentLocality,
								'post_office' => $txtPermanentPost,
								'district_code' => $txtPermanentDist,
								'state_code' => $txtPermanentState,
								'pin' => $txtPermanentPin,
								'email_id'=>$txtemail1, 
								'cand_name'=>$cand_name1, 
								'co_name'=>$co_name1, 
								'city_name'=>$city_name1, 
								'mobile'=>$phone_no1, 
								'updated_by' => $reg_user_id,
								'updated_on' => $now 
							);
							$this->db->insert('applicant_address',$applicant_address_array2);
							if($this->db->affected_rows() == 0)
							{
								$dbStatus = FALSE;
								$dbMessage = 'Error inserting Applicant Permanent';
							}
							else
								$perm_address_ref_id = $this->db->insert_id();
							
							
						}
					}
					
					
					$applicant_master_update_array = array(
							
						'first_name' => $txtFirstName,
						'mid_name' => $txtMiddleName,
						'last_name' => $txtLastName,
						'full_name' => $fullname,
						'exam_center_code' => $center_name1,
						'exam_center_code1' => $center_name2,
						'exam_center_code2' => $center_name3,
						'gender' => $radiogender,
						'nationality' => $cmbNationality,
						'cmbrelationship' => $cmbrelationship,
						'dob' => $dob,
						//'adhar_no' => $txtUid,
						'dob_in_word' => $hidDate,
						'category' => $cmbReservedCategory,
						'phtype'=>$txtphtype,
						
						'is_minority_community' => $radioMinority,
						'minority_community_details' => $cmbCommunity,
						
						'is_north_east' => $radiobelong,
						'father_occupation' => $txtOccupation,
						'annual_parent_income' => $txtIncome,
						'indicate_choice' => $txtIndicate,
						'know_about_cipet' => $txtKnowabout,
						'physically_challenged' => $radioPhysicallY ,
						
						'religion' => $cmbReligion,
						//'applicant_email' => $txtApplicantEmail,
						'applicant_landline' => $txtApplicantLandLine,
						'applicant_mobile' => $txtApplicantMobile,
						'mother_tongue' => $txtMotherTongue, 
						'hostel_facility' => $radioHostel,
						'marital_status' => $radiomaritalstatus,
						'is_reserved_quota' => $radioQuota,
						'updated_by' => $reg_user_id,
						'updated_on' => $now,
						'master_name'=>$master_name,
						'last_year_mark' => $txtfinalpercentage,
						/*'center_name1'=>$center_name1,
						'center_code1'=>$center_code1,
						'center_name2'=>$center_name2,
						'center_code2'=>$center_code2, 
						'center_name3'=>$center_name3,
						'center_code3'=>$center_code3,*/ 

						'father_occupation'=>$FathersProfession, 
							'annual_parent_income'=>$FathersIncome,
							'north_east_state'=>$cmbNorthState, 

							'mothers_profession'=>$MothersProfession, 
							'mothers_income'=>$MothersIncome,
							'mothers_name'=>$txtMotherName,
							//'fathers_adhar_no'=>$fathers_adhar_no,
							//'mothers_adhar_no'=>$mothers_adhar_no,

						'is_employed'=>$employed,
						'employer_add'=>$Employer_address,
						'employer_from'=>$Employer_from,
						'employer_to'=>$Employer_to,
						'employer_add1'=>$Employer_address1, 
						'employer_from1'=>$Employer_from1,
						'employer_to1'=>$Employer_to1, 
						'completion_date'=>$completion_date, 
						'comm_address_ref_id'=>$comm_address_ref_id,
						'perm_address_ref_id'=>$perm_address_ref_id 
						);
						$this->db->where('reg_user_id' , $reg_user_id);
						$this->db->where('applied_program',$program_code);
						$this->db->update('applicant_master',$applicant_master_update_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error update Applicant Master';
						}else{
							$applicant_history_insert_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'first_name' => $txtFirstName,
								'mid_name' => $txtMiddleName,
								'last_name' => $txtLastName,
								'full_name' => $fullname,
								'exam_center_code' => $center_name1,
								'exam_center_code1' => $center_name2,
								'exam_center_code2' => $center_name3,
								'gender' => $radiogender,
								'nationality' => $cmbNationality,
								'cmbrelationship' => $cmbrelationship,
								'dob' => $dob,
								//'adhar_no' => $txtUid,
								'dob_in_word' => $hidDate,
								'category' => $cmbReservedCategory,
								'phtype'=>$txtphtype,
								
								'is_minority_community' => $radioMinority,
								'minority_community_details' => $cmbCommunity,
								
								'is_north_east' => $radiobelong,
								'father_occupation' => $txtOccupation,
								'annual_parent_income' => $txtIncome,
								'indicate_choice' => $txtIndicate,
								'know_about_cipet' => $txtKnowabout,
								'physically_challenged' => $radioPhysicallY ,
								'last_year_mark' => $txtfinalpercentage,
								
								'religion' => $cmbReligion,
								//'applicant_email' => $txtApplicantEmail,
								'applicant_landline' => $txtApplicantLandLine,
								'applicant_mobile' => $txtApplicantMobile,
								'mother_tongue' => $txtMotherTongue, 
								'hostel_facility' => $radioHostel,
								'marital_status' => $radiomaritalstatus,
								'is_reserved_quota' => $radioQuota,
								'created_by' => $reg_user_id,
								'created_on' => $now,
								'master_name'=>$master_name,
								/*'center_name1'=>$center_name1,
								'center_code1'=>$center_code1,
								'center_name2'=>$center_name2,
								'center_code2'=>$center_code2, 
								'center_name3'=>$center_name3,
								'center_code3'=>$center_code3, */

								'father_occupation'=>$FathersProfession, 
							'annual_parent_income'=>$FathersIncome,
							'north_east_state'=>$cmbNorthState, 
							'mothers_profession'=>$MothersProfession, 
							'mothers_income'=>$MothersIncome,
							'mothers_name'=>$txtMotherName,
							//'fathers_adhar_no'=>$fathers_adhar_no,
							//'mothers_adhar_no'=>$mothers_adhar_no,

								'is_employed'=>$employed,
								'employer_add'=>$Employer_address,
								'employer_from'=>$Employer_from,
								'employer_to'=>$Employer_to,
								'employer_add1'=>$Employer_address1, 
								'employer_from1'=>$Employer_from1,
								'employer_to1'=>$Employer_to1, 
								'completion_date'=>$completion_date, 
								'comm_address_ref_id'=>$comm_address_ref_id,
								'perm_address_ref_id'=>$perm_address_ref_id  
							);
							$history_applicant = $this->db->insert('applicant_history',$applicant_history_insert_array);
							if(!$history_applicant){
								$dbStatus = FALSE;
								$dbMessage = 'Error inserting applicant_history';
							}
						}
					
					
					
					$update_applicant_relation_1_array = array(
						'rel_name' => $txtFatherName,
						'updated_by' => $reg_user_id,
						'updated_on' => $now 
					);
					$update_applicant_relation_2_array = array(
						'rel_name' => $txtMotherName,
						'updated_by' => $reg_user_id,
						'updated_on' => $now 
					);
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$this->db->where('applicant_rel_flag',1);
					$update_applicant_relation1 = $this->db->update('applicant_relation',$update_applicant_relation_1_array);
					if(!$update_applicant_relation1)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error updating applicant_relation_1';
					}
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$this->db->where('applicant_rel_flag',2);
					$update_applicant_relation2 = $this->db->update('applicant_relation',$update_applicant_relation_2_array);
					//echo $update_applicant_relation2;
					//print_r($this->db);
					//print_r($this->db->_error_message());
					if(!$update_applicant_relation2)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error updating applicant_relation_2';
					}
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$update_applicant_relation2 = $this->db->delete('applicant_qualification_detail');
					//echo $this->db->last_query();
					if(!$update_applicant_relation2)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error deleting applicant_qualification_detail';
					}
					
					$slno = 1;
					foreach($allQualifications as $row)
					{
						if(${'txtYear'.$slno} != 'NULL' )
						{
							$post_qualification = ${'txtQualification'.$slno};
							//echo $post_qualification; 
							 
						//	$qualification = $row['$qualification']
							$update_applicant_qualification_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'qual_desc_1' => trim($post_qualification),
								'year_of_passing' => ${'txtYear'.$slno},
								'university_board' => ${'txtBoard'.$slno},
								'division_distinction' => ${'txtDivision'.$slno},
								'mark_secured' => ${'txtMS'.$slno},
								'full_mark' => ${'txtFM'.$slno},
								'percentage_mark' => ${'txtPercent'.$slno},
								'created_by' => $reg_user_id,
								'created_on' => $now
							);
							//print_r($update_applicant_qualification_array);
							
							$this->db->insert('applicant_qualification_detail',$update_applicant_qualification_array);
							//echo $this->db->last_query();
							$slno++;
						} 
					}
						/*if($txtYear5 != '')
						{
							$post_qualification5 = $txtQualification5;
								//$qualification = $row['$qualification']
								$update_applicant_qualification_array5 = array(
									'reg_user_id' => $reg_user_id,
									'applied_program' => $program_code,
									'qual_desc_1' => trim($post_qualification5),
									'year_of_passing' => $txtYear5,
									'university_board' => $txtDivision5,
									'division_distinction' => $txtBoard5,
									'mark_secured' => $txtMS5,
									'full_mark' => $txtFM5,
									'percentage_mark' => $txtPercent5,
									'created_by' => $reg_user_id,
									'created_on' => $now
								);
								//print_r($update_applicant_qualification_array4);
								$this->db->insert('applicant_qualification_detail',$update_applicant_qualification_array5);
						}*/
						
						if($dbstatus == TRUE)
						{
							$this->db->select("appl_no");
							$this->db->from('applicant_appl_overview');
							$this->db->where('applied_program',$program_code);
							$this->db->where('reg_user_id',$reg_user_id);
							$result = $this->db->get();
							foreach($result->result_array() as $appl)
							{
								$appl_no = $appl['appl_no'];
								$document_list_array = array(
									'record_status'=>0
								);
								$this->db->where('application_no',$appl_no);
								$update_applicant_relation2 = $this->db->update('applicant_document_list',$document_list_array);
								if(!$update_applicant_relation2)
								{
									$dbstatus = FALSE;
									$dbmessage = 'Error updating applicant_document_list';
								}
								
							}
							$this->db->select("document_type_code");
							$this->db->from('program_document_setup');
							$this->db->where('program_code',$program_code);
							$this->db->where('record_status',1);
							$result = $this->db->get();
							$documentsReq = $result->result_array();
							if($cmbReservedCategory=='GEN'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
							}
							if($radiobelong=='NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DOMICILE');
							}
							if($radioPhysicallY=='NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'PHC');
							}
							foreach($documentsReq AS $row1)
							{
								$document_list_array = array(
									'record_status'=>1
								);
								$document_list_insert_array = array(
									'record_status'=>1,
									'application_no'=>$appl_no,
									'document_type_code'=>$row1['document_type_code']
								);
								$this->db->select("application_no");
								$this->db->from('applicant_document_list');
								$this->db->where('application_no',$appl_no);
								$this->db->where('document_type_code',$row1['document_type_code']);
								$result = $this->db->get();
								$documentsReq = $result->result_array();
								if($result->num_rows() == 1)
								{
									$this->db->where('application_no',$appl_no);
									$this->db->where('document_type_code',$row1['document_type_code']);
									$update_applicant_relation2 = $this->db->update('applicant_document_list',$document_list_array);
									if(!$update_applicant_relation2)
									{
										$dbstatus = FALSE;
										$dbmessage = 'Error updating applicant_document_list';
									}
								}
								else
								{
									$this->db->insert('applicant_document_list',$document_list_insert_array);
									if(!$update_applicant_relation2)
									{
										$dbstatus = FALSE;
										$dbmessage = 'Error updating applicant_document_list';
									}
								}
							}
							
							if($dbstatus == TRUE)
							{
								$this->db->trans_complete();
								$this->session->set_userdata('admcode', $program_code);
								$this->session->set_userdata('reg_user_id', $reg_user_id);
								$this->session->set_userdata('appl_no', $appl_no);
								$this->session->set_userdata('mode', $mode);
								$this->session->set_userdata('step', 3);
								if( $this->db->trans_status() === FALSE){
									$dbstatus = FALSE;
									$dbmessage = 'Error While Saving';
								}
								
								return array('status' => $dbstatus, 'msg' => $dbmessage);
							}
							else
							{
								$this->db->trans_rollback();
							}
						}
						else
						{
							$this->db->trans_rollback();
						}
						
					}
					
				else
				{
					
					$this->db->trans_start();
					$dbStatus = TRUE;
					$dbmessage = 'Data saved Successfully';
					$comm_address_ref_id = '';
					if($chksameasresidential == 'Y')
					{
						$applicant_address_array1 = array(
							'address_1' => $txtPresentLocality,
							'post_office' => $txtPresentPost,
							'district_code' => $cmbPresentDist,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'cand_name'=>$cand_name, 
							'co_name'=>$co_name,
							'city_name'=>$city_name, 
							'mobile'=>$phone_no, 
							'email_id'=>$txtemail, 
							'created_by' => $reg_user_id,
							'distance_from' => $txtPresentDistance,
							'created_on' => $now 
						);
						$this->db->insert('applicant_address',$applicant_address_array1);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant same address';
						}
						else
							$comm_address_ref_id = $this->db->insert_id();
							
							
							$applicant_master_insert_array = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'first_name' => $txtFirstName,
							'mid_name' => $txtMiddleName,
							'last_name' => $txtLastName,
							'full_name' => $fullname,
							'exam_center_code' => $center_name1,
							'exam_center_code1' => $center_name2,
							'exam_center_code2' => $center_name3,
							'gender' => $radiogender,
							'nationality' => $cmbNationality,
							'dob' => $dob,
							//'adhar_no' => $txtUid,
							'dob_in_word' => $hidDate,
							'category' => $cmbReservedCategory,
							'phtype'=>$txtphtype,
							'religion' => $cmbReligion,
							//'applicant_email' => $txtApplicantEmail,
							'applicant_landline' => $txtApplicantLandLine,
							'applicant_mobile' => $txtApplicantMobile,
							'mother_tongue' => $txtMotherTongue, 
							'hostel_facility' => $radioHostel,
							'marital_status' => $radiomaritalstatus,
							'is_reserved_quota' => $radioQuota,
							'last_year_mark' => $txtfinalpercentage,
							
							'is_minority_community' => $radioMinority,
							'minority_community_details' => $cmbCommunity,
							'applicant_email' => $txtemail,
							'is_north_east' => $radiobelong,
							'father_occupation' => $txtOccupation,
							'annual_parent_income' => $txtIncome,
							'indicate_choice' => $txtIndicate,
							'know_about_cipet' => $txtKnowabout,
							'physically_challenged' => $radioPhysicallY ,
							
							'created_by' => $reg_user_id,
							'created_on' => $now,
							'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$comm_address_ref_id,
							'master_name'=>$master_name,
							/*'center_name1'=>$center_name1,
							'center_code1'=>$center_code1,
							'center_name2'=>$center_name2,
							'center_code2'=>$center_code2, 
							'center_name3'=>$center_name3,
							'center_code3'=>$center_code3, */
							'is_employed'=>$employed,
							'employer_add'=>$Employer_address,
							'employer_from'=>$Employer_from,
							'employer_to'=>$Employer_to,
							'employer_add1'=>$Employer_address1, 
							'employer_from1'=>$Employer_from1,
							'employer_to1'=>$Employer_to1, 

							'father_occupation'=>$FathersProfession, 
							'annual_parent_income'=>$FathersIncome,
							'north_east_state'=>$cmbNorthState, 

							'mothers_profession'=>$MothersProfession, 
							'mothers_income'=>$MothersIncome,
							'mothers_name'=>$txtMotherName,
							//'fathers_adhar_no'=>$fathers_adhar_no,
							//'mothers_adhar_no'=>$mothers_adhar_no,

							
							'completion_date'=>$completion_date 
							);
						$this->db->insert('applicant_master',$applicant_master_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant same address';
						}
						$applicant_history_insert_array=array('reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'first_name' => $txtFirstName,
							'mid_name' => $txtMiddleName,
							'last_name' => $txtLastName,
							'full_name' => $fullname,
							'exam_center_code' => $center_name1,
							'exam_center_code1' => $center_name2,
							'exam_center_code2' => $center_name3,
							'gender' => $radiogender,
							'nationality' => $cmbNationality,
							'dob' => $dob,
							//'adhar_no' => $txtUid,
							'dob_in_word' => $hidDate,
							'category' => $cmbReservedCategory,
							'phtype'=>$txtphtype,
							'religion' => $cmbReligion,
							//'applicant_email' => $txtApplicantEmail,
							'applicant_landline' => $txtApplicantLandLine,
							'applicant_mobile' => $txtApplicantMobile,
							'mother_tongue' => $txtMotherTongue, 
							'hostel_facility' => $radioHostel,
							'marital_status' => $radiomaritalstatus,
							'is_reserved_quota' => $radioQuota,
							'last_year_mark' => $txtfinalpercentage,
							
							'is_minority_community' => $radioMinority,
							'minority_community_details' => $cmbCommunity,
							'applicant_email' => $txtemail,
							'is_north_east' => $radiobelong,
							'father_occupation' => $txtOccupation,
							'annual_parent_income' => $txtIncome,
							'indicate_choice' => $txtIndicate,
							'know_about_cipet' => $txtKnowabout,
							'physically_challenged' => $radioPhysicallY ,
							
							'created_by' => $reg_user_id,
							'created_on' => $now,
							'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$comm_address_ref_id,
							'master_name'=>$master_name,
							/*'center_name1'=>$center_name1,
							'center_code1'=>$center_code1,
							'center_name2'=>$center_name2,
							'center_code2'=>$center_code2, 
							'center_name3'=>$center_name3,
							'center_code3'=>$center_code3,*/ 
							'is_employed'=>$employed,
							'employer_add'=>$Employer_address,
							'employer_from'=>$Employer_from,
							'employer_to'=>$Employer_to,
							'employer_add1'=>$Employer_address1, 
							'employer_from1'=>$Employer_from1,
							'employer_to1'=>$Employer_to1, 

							'father_occupation'=>$FathersProfession, 
							'annual_parent_income'=>$FathersIncome,
							'north_east_state'=>$cmbNorthState, 

							'mothers_profession'=>$MothersProfession, 
							'mothers_income'=>$MothersIncome,
							'mothers_name'=>$txtMotherName,
							//'fathers_adhar_no'=>$fathers_adhar_no,
							//'mothers_adhar_no'=>$mothers_adhar_no,
							
							'completion_date'=>$completion_date );
						$this->db->insert('applicant_history',$applicant_history_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant history same address';
						}
					}
					else
					{
						$applicant_address_array1 = array(
							'address_1' => $txtPresentLocality,
							'post_office' => $txtPresentPost,
							'district_code' => $cmbPresentDist,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'cand_name'=>$cand_name, 
							'co_name'=>$co_name,
							'city_name'=>$city_name, 
							'mobile'=>$phone_no, 
							'email_id'=>$txtemail, 
							'created_by' => $reg_user_id,
							'created_on' => $now 
						);
						$this->db->insert('applicant_address',$applicant_address_array1);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant Present';
						}
						else
							$comm_address_ref_id = $this->db->insert_id();
							
							$applicant_address_array2 = array(
							'address_1' => $txtPermenentLocality,
							'post_office' => $txtPermanentPost,
							'district_code' => $txtPermanentDist,
							'state_code' => $txtPermanentState,
							'pin' => $txtPermanentPin,
							
							'email_id'=>$txtemail1, 
							'cand_name'=>$cand_name1, 
							'co_name'=>$co_name1, 
							'city_name'=>$city_name1, 
							'mobile'=>$phone_no1, 
							'created_by' => $reg_user_id,
							'created_on' => $now 
						);//print_r($applicant_address_array2);die();
						$this->db->insert('applicant_address',$applicant_address_array2);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant Permanent';
						}
						else
							$perm_address_ref_id = $this->db->insert_id();
						
						$applicant_master_insert_array = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'first_name' => $txtFirstName,
							'mid_name' => $txtMiddleName,
							'last_name' => $txtLastName,
							'full_name' => $fullname,
							'exam_center_code' => $center_name1,
							'exam_center_code1' => $center_name2,
							'exam_center_code2' => $center_name3,
							'gender' => $radiogender,
							'nationality' => $cmbNationality,
							'dob' => $dob,
							//'adhar_no' => $txtUid,
							'dob_in_word' => $hidDate,
							'category' => $cmbReservedCategory,
							'phtype'=>$txtphtype,
							'religion' => $cmbReligion,
							//'applicant_email' => $txtApplicantEmail,
							'applicant_landline' => $txtApplicantLandLine,
							'applicant_mobile' => $txtApplicantMobile,
							'mother_tongue' => $txtMotherTongue, 
							'hostel_facility' => $radioHostel,
							'marital_status' => $radiomaritalstatus,
							'is_reserved_quota' => $radioQuota,
							'created_by' => $reg_user_id,
							'created_on' => $now,
							'last_year_mark' => $txtfinalpercentage,
							
							'is_minority_community' => $radioMinority,
							'minority_community_details' => $cmbCommunity,
							'applicant_email' => $txtemail,
							'is_north_east' => $radiobelong,
							'father_occupation' => $txtOccupation,
							'annual_parent_income' => $txtIncome,
							'indicate_choice' => $txtIndicate,
							'know_about_cipet' => $txtKnowabout,
							'physically_challenged' => $radioPhysicallY ,
							
							'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$perm_address_ref_id,
							'master_name'=>$master_name,
							/*'center_name1'=>$center_name1,
							'center_code1'=>$center_code1,
							'center_name2'=>$center_name2,
							'center_code2'=>$center_code2, 
							'center_name3'=>$center_name3,
							'center_code3'=>$center_code3, */
							'is_employed'=>$employed,
							'employer_add'=>$Employer_address,
							'employer_from'=>$Employer_from,
							'employer_to'=>$Employer_to,
							'employer_add1'=>$Employer_address1, 
							'employer_from1'=>$Employer_from1,
							'employer_to1'=>$Employer_to1, 
							

							'father_occupation'=>$FathersProfession, 
							'annual_parent_income'=>$FathersIncome,
							'north_east_state'=>$cmbNorthState, 

							'mothers_profession'=>$MothersProfession, 
							'mothers_income'=>$MothersIncome,
							'mothers_name'=>$txtMotherName,
							//'fathers_adhar_no'=>$fathers_adhar_no,
							//'mothers_adhar_no'=>$mothers_adhar_no,

							'completion_date'=>$completion_date 
						);
						$this->db->insert('applicant_master',$applicant_master_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant same address';
						}
						$applicant_history_insert_array=array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'first_name' => $txtFirstName,
							'mid_name' => $txtMiddleName,
							'last_name' => $txtLastName,
							'full_name' => $fullname,
							'exam_center_code' => $center_name1,
							'exam_center_code1' => $center_name2,
							'exam_center_code2' => $center_name3,
							'gender' => $radiogender,
							'nationality' => $cmbNationality,
							'dob' => $dob,
							//'adhar_no' => $txtUid,
							'dob_in_word' => $hidDate,
							'category' => $cmbReservedCategory,
							'phtype'=>$txtphtype,
							'religion' => $cmbReligion,
							//'applicant_email' => $txtApplicantEmail,
							'applicant_landline' => $txtApplicantLandLine,
							'applicant_mobile' => $txtApplicantMobile,
							'mother_tongue' => $txtMotherTongue, 
							'hostel_facility' => $radioHostel,
							'marital_status' => $radiomaritalstatus,
							'is_reserved_quota' => $radioQuota,
							'created_by' => $reg_user_id,
							'created_on' => $now,
							'last_year_mark' => $txtfinalpercentage,
							
							'is_minority_community' => $radioMinority,
							'minority_community_details' => $cmbCommunity,
							'applicant_email' => $txtemail,
							'is_north_east' => $radiobelong,
							'father_occupation' => $txtOccupation,
							'annual_parent_income' => $txtIncome,
							'indicate_choice' => $txtIndicate,
							'know_about_cipet' => $txtKnowabout,
							'physically_challenged' => $radioPhysicallY ,
							
							'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$perm_address_ref_id,
							'master_name'=>$master_name,
							/*'center_name1'=>$center_name1,
							'center_code1'=>$center_code1,
							'center_name2'=>$center_name2,
							'center_code2'=>$center_code2, 
							'center_name3'=>$center_name3,
							'center_code3'=>$center_code3,*/ 
							'is_employed'=>$employed,
							'employer_add'=>$Employer_address,
							'employer_from'=>$Employer_from,
							'employer_to'=>$Employer_to,
							'employer_add1'=>$Employer_address1, 
							'employer_from1'=>$Employer_from1,
							'employer_to1'=>$Employer_to1, 
							'father_occupation'=>$FathersProfession, 

							'mothers_profession'=>$MothersProfession, 
							'mothers_income'=>$MothersIncome,
							'mothers_name'=>$txtMotherName,
							//'fathers_adhar_no'=>$fathers_adhar_no,
							//'mothers_adhar_no'=>$mothers_adhar_no,

							'annual_parent_income'=>$FathersIncome,
							'north_east_state'=>$cmbNorthState, 
							'completion_date'=>$completion_date 
						);
						$this->db->insert('applicant_history',$applicant_history_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant history different address';
						}
						
					}
					$update_applicant_relation_1_array = array(
						'reg_user_id' => $reg_user_id,
						'applied_program' => $program_code,
						'applicant_rel_flag' => 1,
						'rel_name' => $txtFatherName,
						'created_by' => $reg_user_id,
						'created_on' => $now 
					);
					$update_applicant_relation_2_array = array(
						'reg_user_id' => $reg_user_id,
						'applied_program' => $program_code,
						'applicant_rel_flag' => 2,
						'rel_name' => $txtMotherName,
						'updated_by' => $reg_user_id,
						'updated_on' => $now 
					);
					$update_applicant_relation1 = $this->db->insert('applicant_relation',$update_applicant_relation_1_array);
					if($this->db->affected_rows() == 0)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error updating applicant_relation_1';
					}
					$update_applicant_relation2 = $this->db->insert('applicant_relation',$update_applicant_relation_2_array);
					if($this->db->affected_rows() == 0)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error updating applicant_relation_2';
					}
					$slno = 1;
					//print_r($allQualifications); 
					$slno = 1;
					foreach($allQualifications as $row)
					{
						if(${'txtYear'.$slno} != 'NULL' )
						{
							$post_qualification = ${'txtQualification'.$slno};
							//$qualification = $row['$qualification']
							$update_applicant_qualification_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'qual_desc_1' => trim($post_qualification),
								'year_of_passing' => ${'txtYear'.$slno},
								'university_board' => ${'txtBoard'.$slno},
								'division_distinction' => ${'txtDivision'.$slno},
								'mark_secured' => ${'txtMS'.$slno},
								'full_mark' => ${'txtFM'.$slno},
								'percentage_mark' => ${'txtPercent'.$slno},
								'created_by' => $reg_user_id,
								'created_on' => $now
							);
							$this->db->insert('applicant_qualification_detail',$update_applicant_qualification_array);
							//echo $this->db->last_query();
							$slno++;
						}
					}
					
					
					/*if($txtYear4 != '')
					{
						$post_qualification4 = $txtQualification4;
							//$qualification = $row['$qualification']
							$update_applicant_qualification_array4 = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'qual_desc_1' => trim($post_qualification4),
								'year_of_passing' => $txtYear4,
								'university_board' => $txtDivision4,
								'division_distinction' => $txtBoard4,
								'mark_secured' => $txtMS4,
								'full_mark' => $txtFM4,
								'percentage_mark' => $txtPercent4,
								'created_by' => $reg_user_id,
								'created_on' => $now
							);
							$this->db->insert('applicant_qualification_detail',$update_applicant_qualification_array4);
					}*/
					if($dbStatus == TRUE)
					{
						$this->db->select("course_id");
						$this->db->from('course_master');
						$this->db->where('course_code',$master_name);
						$result = $this->db->get();
						foreach($result->result_array() as $course)
						{
							$course_id = $course['course_id'];
						}
						//echo $course_id;
						
						//echo $this->db->last_query(); die();
						
						$this->db->select("program_code,year,sl_no,program_id");
						$this->db->from('counselling_program_master');
						$this->db->where('program_code',$program_code);
						$result = $this->db->get();
						foreach($result->result_array() as $appl)
						{
							$sl_no = $appl['sl_no'];
							$program_id = $appl['program_id'];
							$program_code = $appl['program_code'];
							$year = $appl['year'];
							$new_sl_no = $sl_no + 1;
							$changed_sl_no = '';
							if($new_sl_no < 10)
								$changed_sl_no = '00000'.$new_sl_no;
							else if($new_sl_no < 100)
								$changed_sl_no = '0000'.$new_sl_no;
							else if($new_sl_no < 1000)
								$changed_sl_no = '000'.$new_sl_no;
							else if($new_sl_no < 10000)
								$changed_sl_no = '00'.$new_sl_no;
							else if($new_sl_no < 100000)
								$changed_sl_no = '0'.$new_sl_no;
						}
						$application_no = $program_code.$year.$changed_sl_no;
						$application_no1 = $year.$program_id.$course_id.$changed_sl_no;
						//echo $application_no;die();
						
						$application_data = array(
							'reg_user_id'	=>$reg_user_id,
							'appl_no'		=>$application_no,
							//'new_appl_no'	=>$application_no1,
							'form_no'		=>$application_no,
							'applied_program'=>$program_code,
							'appl_status'	=>'Student Details Submitted',
							'created_by'	=>$reg_user_id,
							'created_on'	=>$now
						);
						$program_update_data = array(
							'sl_no'=>$new_sl_no
						);
						$this->db->insert('applicant_appl_overview',$application_data);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbmessage = 'Error inserting applicant_appl_overview';
						}
						else
						{
							$this->db->insert('applicant_appl_overview_history',$application_data);
							
							
							$this->db->where('program_code',$program_code);
							$this->db->update('counselling_program_master',$program_update_data);
							if($this->db->affected_rows() == 0)
							{
								$dbStatus = FALSE;
								$dbmessage = 'Error updating program';
							}
						}
						$this->db->select("document_type_code");
						$this->db->from('program_document_setup');
						$this->db->where('program_code',$program_code);
						$this->db->where('record_status',1);
						$result = $this->db->get();
						$documentsReq = $result->result_array();
						if($cmbReservedCategory=='GEN'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
						}
						if($radiobelong=='NO'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DOMICILE');
						}
						if($radioPhysicallY=='NO'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'PHC');
						}
						foreach($documentsReq AS $row1)
						{
							$document_list_insert_array = array(
								'record_status'=>1,
								'application_no'=>$application_no,
								'document_type_code'=>$row1['document_type_code']
							);
							$this->db->insert('applicant_document_list',$document_list_insert_array);
						}
						if($dbStatus == TRUE)
						{
							$this->db->trans_complete();
							$this->session->set_userdata('admcode', $program_code);
							$this->session->set_userdata('reg_user_id', $reg_user_id);
							$this->session->set_userdata('appl_no', $application_no);
							$this->session->set_userdata('mode', $mode);
							$this->session->set_userdata('step', 3);
							if( $this->db->trans_status() === FALSE){
								$dbStatus = FALSE;
								$dbmessage = 'Error While Saving';
							}
							return array('status' => $dbStatus, 'msg' => $dbmessage);
						}
						else
						{
							$this->db->trans_rollback();
							return array('status' => $dbStatus, 'msg' => $dbmessage);
						}
						
					}
					else
					{
						$this->db->trans_rollback();
						return array('status' => $dbStatus, 'msg' => $dbmessage);
					}
					
					
				}
			break;
			
			case 'get_document_data':
				$counselling_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		//$institute_code = $this->session->userdata('institute_code');
        		$data = $this->uri->uri_to_assoc();
				$institute = $data['ins'];
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$where = "(counselling_document_setup.record_status = 'Active' OR counselling_document_setup.record_status = '1')";
        		$where1 = "(counselling_document_setup.document_type_code = 'PHO' OR counselling_document_setup.document_type_code = 'SIG')";
        		
				$this->db->select('counselling_document_setup.document_type_code,document_type_master.document_type,document_type_description,document_size_description,document_size_in_kb,document_preview_height,document_preview_width');
				$this->db->from('counselling_document_setup');
				$this->db->join('document_type_master', 'counselling_document_setup.document_type_code = document_type_master.document_type_code','inner');
				$this->db->join('counselling_applicant_form_documents', 'document_type_master.document_type_code = counselling_applicant_form_documents.document_type','inner');
				
				$this->db->where('appl_no',$application_no);
				$this->db->where('counselling_code',$counselling_code);
				$this->db->where($where);
				$this->db->where($where1);
				$this->db->order_by('sl_no');
				//print_r($query);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				//print_r($result);
				return $result->result_array();
			break;
			
			case 'get_appl_status':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		//$ins =  encrypt_decrypt('decrypt', $data);
        		$appl_status = '';
        		
				$this->db->select('appl_status,appl_no');
				$this->db->from('counselling_applicant_appl_overview');
				$this->db->where('counselling_code',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('STATUS','1');
				//print_r($query);
				$result = $this->db->get();
				foreach($result->result_array() as $aRow){
					$appl_status = $aRow['appl_status'];
					$appl_no = $aRow['appl_no'];
				}
				
				if($appl_status == 'Document Uploaded' || $appl_status == 'Verified' || $appl_status == 'Fee Paid' ){
					$this->session->set_userdata('mode', 'edit');
					$this->session->set_userdata('appl_no', $appl_no);
					
				}
				else{
					$this->session->set_userdata('mode', 'new');
				}
				return $result->result_array();
			break;
			
			case 'get_applicant_program':
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				
				$this->db->select('*,A.master_name AS course_code');
				$this->db->from('applicant_master A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.applicant_mobile','INNER');
				$this->db->where('jee_roll_no',$reg_user_id);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				//$course_name = $result->result_array()[0]['course_code'];
				return $result->result_array();
			break;
			case 'get_appl_date':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$ins =  encrypt_decrypt('decrypt', $data);
        		$appl_status = '';
        		
				$this->db->select('counselling_start_date,counselling_end_date,apply_start_date,apply_end_date,choice_lock_start_date,choice_lock_end_date');
				$this->db->from('counselling_schedule_master');
				$this->db->where('counselling_code',$program_code);
				$this->db->where('record_status','1');
				//print_r($query);
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'get_doc_path':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		//$ins =  encrypt_decrypt('decrypt', $data);
        		
        		
				$this->db->select('document_path,document_type');
				$this->db->from('counselling_applicant_form_documents');
				
				$this->db->where('appl_no',$application_no);
				$this->db->where('status','1');
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			
			case 'add_document_data': 
				$dbstatus = TRUE;
				$dbMessage = '';
				$mode = $this->session->userdata('mode');
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$data = $this->uri->uri_to_assoc();
				$institute = $data['ins'];
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d H:i:s', now());
        		$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute;
				$documentsReq = '';
				
				$uploaddir = DOCUMENT_UPLOAD_URL."/".$program_code."/".$application_no;
				//echo $uploaddir;die();
				$retrievedir = BASE_ADM_URL."/".$program_code."/".$application_no;
				if(!is_dir($uploaddir))
					mkdir($uploaddir,0777,true);
				exec("chmod -R 777 $uploaddir");//for giving folder permission to downlad that file 
				$allowed =  array('jpg','jpeg' ,'png','JPG','PNG');
				
				//echo $mode;
				if($mode == "edit")
				{
					$error_count = 0;
					$i=0;
					$where = "(program_document_setup.record_status = 'Active' OR program_document_setup.record_status = '1')";
					
					$this->db->select('applicant_document_list.document_type_code,document_type,document_type_description,document_size_description,document_size_in_kb,document_preview_height,document_preview_width');
					$this->db->from('program_document_setup');
					$this->db->join('applicant_document_list', 'program_document_setup.document_type_code = applicant_document_list.document_type_code','inner');
					$this->db->join('document_type_master', 'program_document_setup.document_type_code = document_type_master.document_type_code','inner');
					$this->db->where('application_no',$application_no);
					$this->db->where('program_code',$program_code);
					$this->db->where('applicant_document_list.record_status','1');
					$this->db->where($where);
					$this->db->order_by('sl_no');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach($output_data as $row)
					{
						$documentsReq[] = $row;	
						$documentsDesc[] = $row['document_type'];
						$documentsCode[] = $row['document_type_code'];
					}
					foreach($documentsReq as $row)
	  				{
	  					if(isset($_FILES['fileDocument']['tmp_name'][$i]) && $_FILES['fileDocument']['tmp_name'][$i]!='')
				  		{
				  			$document_type_code = $row['document_type_code'];
				  			//$imageFileType = end(explode(".", $_FILES['fileDocument']['name'][$i]));
							
							$check = getimagesize($_FILES["fileDocument"]["tmp_name"][$i]);
							if($check['mime'] != 'image/jpeg' && $check['mime'] != 'image/jpg' && $check['mime'] != 'image/png' && $check['mime'] != 'image/gif') {
								return array('status'=>false, 'msg'=>"Invalid image Type");
							}
							
							//$check = getMimeType($_FILES["fileDocument"]["tmp_name"][$i]);
							
							//echo $check .'h'; die();
							
							// Check file size
							if($_FILES["fileDocument"]["size"][$i] > 1536000) {
								return array('status'=>false, 'msg'=>"Size of the image should be within 1MB");
							}
							// Allow certain file formats
							if(substr_count($_FILES['fileDocument']['name'][$i],".")==1 && substr_count($_FILES['fileDocument']['name'][$i],"%0")==0 ) {
								//echo 'success';
							}else{
								return array('status'=>false, 'msg'=>"Invalid document format or file name(file name should not contain multipe dot(.) or `%0`)");
							}
							if(isset($_FILES['fileDocument']['tmp_name'][$i]) && $_FILES['fileDocument']['tmp_name'][$i]!=''){
								//$image_name = base64_encode(file_get_contents($_FILES['fileinstitutelogo']['tmp_name']));
								//$pic_name = $this->session->userdata('user_id')."1".time().".png";//$_FILES['fileinstitutelogo']['name'];
								//$pic_name = $this->input->post('institutecode').md5(uniqid($user)).".".$imageFileType;//$_FILES['fileinstitutelogo']['name'];
								
								//echo $uploads_dir. base_url('public');
								$docimagetemp = $_FILES['fileDocument']['tmp_name'][$i];		
								//echo "PHoto upload status".$result.dirname(__FILE__) ;
								//echo FCPATH."#".APPPATH."##".BASEPATH;
								//die();
							}
							
							$docimagetemp = $_FILES['fileDocument']['tmp_name'][$i];
							$doc_name= explode(".",$_FILES['fileDocument']["name"][$i]);
							$ext_doc = strtolower(end($doc_name));
							$docImageFileName = $document_type_code.'.'.$ext_doc;
							move_uploaded_file($docimagetemp,$uploaddir."/".$docImageFileName);	
							$docImagePath = $retrievedir."/".$docImageFileName;
							//echo $docImagePath;
						
							if(!in_array($ext_doc,$allowed) ) {
							    $error_count++;
							}
							else
							{
								move_uploaded_file($_FILES['fileDocument']['tmp_name'][$i], $uploaddir);
								$doc_id = $application_no.'_'.$document_type_code;
								
								$this->db->select("count(doc_id) AS doc_id");
								$this->db->from('applicant_form_documents');
								$this->db->where('doc_id',$doc_id);
								
								$result = $this->db->get();
								$output_data = $result->result_array();
								
								foreach ($output_data as $aRow1) 
			            		{
			            			$result = $aRow1['doc_id'];
									if($result >= 1)
									{
										$update_data = array(
											'document_submit_date' 			=>$date,
											'document_path' 				=>$docImagePath,
											'updated_by'					=>$reg_user_id,
											'updated_on'					=>$date,
											'status'						=>'1'
										);
										$this->db->where('doc_id',$doc_id);
										$sql = $this->db->update('applicant_form_documents', $update_data);
										//echo $this->db->last_query();
										if(!$sql){
											$dbstatus = "ERROR";
											$dbMessage = "Error Inserting";
											//$dbError = ;	
										}
									}
									else
									{
										$new_data = array(
											'id' 							=>'NULL',
											'appl_no' 						=>$application_no,
											'doc_id' 						=>$doc_id,
											'document_type' 				=>$document_type_code,
											'document_submit_status' 		=>'Submitted',
											'document_submit_date' 			=>$date,
											'submit_mode' 					=>'ONLINE',
											'document_path' 				=>$docImagePath,
											'created_by'					=>$reg_user_id,
											'created_on'					=>$date
										);
										
										
										$sql = $this->db->insert('applicant_form_documents', $new_data);
										echo $this->db->last_query();
										if(!$sql){
											$dbstatus = "ERROR";
											$dbMessage = "Error Inserting";
											//$dbError = ;	
										}
									}
				                }
								
							}
							
						}
						$i++;
	  				}
	  				if($error_count == 0)
					{
						$update_data = array(
							'appl_status' 					=>'Document Uploaded',
							'updated_by'					=>$reg_user_id,
							'updated_on'					=>$date,
							'status'						=>'1'
						);
						$this->db->where('appl_no',$application_no);
						$sql = $this->db->update('applicant_appl_overview', $update_data);
						echo $this->db->last_query();
						if(!$sql){
							$dbstatus = "ERROR";
							$dbMessage = "Error Inserting";
							//$dbError = ;	
						}
						
						$new_data = array(
							'id' 							=>'NULL',
							'reg_user_id' 					=>$reg_user_id,
							'appl_no' 						=>$application_no,
							'form_no' 						=>$application_no,
							'applied_program' 				=>$program_code,
							'appl_status' 					=>'Document Uploaded',
							'created_by'					=>$reg_user_id,
							'created_on'					=>$date
						);
						
						
						$sql = $this->db->insert('applicant_appl_overview_history', $new_data);
						//echo $this->db->last_query();
						if(!$sql){
							$dbstatus = "ERROR";
							$dbMessage = "Error Inserting";
							//$dbError = ;	
						}
					
					//header("location: apply-4.php?ins=$hex_ins_code&_s=$MY_SESSION_NAME");
					}
					else
					{
						if($error_count == $i)
						{
							$dbstatus = FALSE;
							$dbMessage = 'Error While Saving';
						}
						else
						{
							$dbstatus = FALSE;
							$dbMessage = 'Error While Saving';
						}
						
					}
					
				}
				else
				{
					$i=0;
					$error_count = 0;
					$where = "(program_document_setup.record_status = 'Active' OR program_document_setup.record_status = '1')";
					
					$this->db->select('applicant_document_list.document_type_code,document_type,document_type_description,document_size_description,document_size_in_kb,document_preview_height,document_preview_width');
					$this->db->from('program_document_setup');
					$this->db->join('applicant_document_list', 'program_document_setup.document_type_code = applicant_document_list.document_type_code','inner');
					$this->db->join('document_type_master', 'program_document_setup.document_type_code = document_type_master.document_type_code','inner');
					$this->db->where('application_no',$application_no);
					$this->db->where('program_code',$program_code);
					$this->db->where('applicant_document_list.record_status','1');
					$this->db->where($where);
					$this->db->order_by('sl_no');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach($output_data as $row)
					{
						$documentsReq[] = $row;	
						$documentsDesc[] = $row['document_type'];
						$documentsCode[] = $row['document_type_code'];
					}
					foreach($documentsReq as $row)
	  				{
	  					if(isset($_FILES['fileDocument']['tmp_name'][$i]) && $_FILES['fileDocument']['tmp_name'][$i]!='')
				  		{
				  			$document_type_code = $row['document_type_code'];
				  			//$imageFileType = end(explode(".", $_FILES['fileDocument']['name'][$i]));
				  			//print_r($check);die();
							
							$check = getimagesize($_FILES["fileDocument"]["tmp_name"][$i]);
							
							if($check['mime'] != 'image/jpeg' && $check['mime'] != 'image/jpg' && $check['mime'] != 'image/png' && $check['mime'] != 'image/gif') {
								return array('status'=>false, 'msg'=>"Invalid image Type");
							}
							
							//$check = getMimeType($_FILES["fileDocument"]["tmp_name"][$i]);
							
							//echo $check .'h'; die();
							
							
							// Check file size
							if($_FILES["fileDocument"]["size"][$i] > 1536000) {
								return array('status'=>false, 'msg'=>"Size of the image should be within 1MB");
							}
							// Allow certain file formats
							if(substr_count($_FILES['fileDocument']['name'][$i],".")==1 && substr_count($_FILES['fileDocument']['name'][$i],"%0")==0 ) {
								//echo 'success';
							}else{
								return array('status'=>false, 'msg'=>"Invalid document format or file name(file name should not contain multipe dot(.) or `%0`)");
							}
							if(isset($_FILES['fileDocument']['tmp_name'][$i]) && $_FILES['fileDocument']['tmp_name'][$i]!=''){
								//$image_name = base64_encode(file_get_contents($_FILES['fileinstitutelogo']['tmp_name']));
								//$pic_name = $this->session->userdata('user_id')."1".time().".png";//$_FILES['fileinstitutelogo']['name'];
								//$pic_name = $this->input->post('institutecode').md5(uniqid($user)).".".$imageFileType;//$_FILES['fileinstitutelogo']['name'];
					
								//echo $uploads_dir. base_url('public');
								/*$result = move_uploaded_file($_FILES['fileDocument']['tmp_name'][$i], $uploads_dir);*/
								//echo "PHoto upload status".$result.dirname(__FILE__) ;
								//echo FCPATH."#".APPPATH."##".BASEPATH;
								//die();
							}
							
							$docimagetemp = $_FILES['fileDocument']['tmp_name'][$i];
							$doc_name= explode(".",$_FILES['fileDocument']["name"][$i]);
							$ext_doc = strtolower(end($doc_name));
							$docImageFileName = $document_type_code.'.'.$ext_doc;
							move_uploaded_file($docimagetemp,$uploaddir."/".$docImageFileName);	
							$docImagePath = $retrievedir."/".$docImageFileName;
							
				  			
							if(!in_array($ext_doc,$allowed) ) {
							    $error_count++;
							}
							else
							{
								move_uploaded_file($_FILES['fileDocument']['tmp_name'][$i], $uploaddir);
								$doc_id = $application_no.'_'.$document_type_code;
								
								$this->db->select("count(doc_id) AS doc_id");
								$this->db->from('applicant_form_documents');
								$this->db->where('doc_id',$doc_id);
								
								$result = $this->db->get();
								$output_data = $result->result_array();
								
								foreach ($output_data as $aRow1) 
			            		{
			            			$result = $aRow1['doc_id'];
									if($result >= 1)
									{
										$update_data = array(
											'document_submit_date' 			=>$date,
											'document_path' 				=>$docImagePath,
											'updated_by'					=>$reg_user_id,
											'updated_on'					=>$date,
											'status'						=>'1'
										);
										$this->db->where('doc_id',$doc_id);
										$sql = $this->db->update('applicant_form_documents', $update_data);
										//echo $this->db->last_query();
										if(!$sql){
											$dbstatus = "ERROR";
											$dbMessage = "Error Inserting";
											//$dbError = ;	
										}
									}
									else
									{
										$new_data = array(
											'id' 							=>'NULL',
											'appl_no' 						=>$application_no,
											'doc_id' 						=>$doc_id,
											'document_type' 				=>$document_type_code,
											'document_submit_status' 		=>'Submitted',
											'document_submit_date' 			=>$date,
											'submit_mode' 					=>'ONLINE',
											'document_path' 				=>$docImagePath,
											'created_by'					=>$reg_user_id,
											'created_on'					=>$date
										);
										
										
										$sql = $this->db->insert('applicant_form_documents', $new_data);
										//echo $this->db->last_query();
										if(!$sql){
											$dbstatus = "ERROR";
											$dbMessage = "Error Inserting";
											//$dbError = ;	
										}
									}
				                }
								
							}
						}
						$i++;
					}
					//echo $dbstatus.$dbMessage.$error_count;
					if($error_count == 0)
					{
						$update_data = array(
							'appl_status' 					=>'Document Uploaded',
							'updated_by'					=>$reg_user_id,
							'updated_on'					=>$date,
							'status'						=>'1'
						);
						$this->db->where('appl_no',$application_no);
						$sql = $this->db->update('applicant_appl_overview', $update_data);
						//echo $this->db->last_query();
						if(!$sql){
							$dbstatus = "ERROR";
							$dbMessage = "Error Inserting";
							//$dbError = ;	
						}
						
						$new_data = array(
							'id' 							=>'NULL',
							'reg_user_id' 					=>$reg_user_id,
							'appl_no' 						=>$application_no,
							'form_no' 						=>$application_no,
							'applied_program' 				=>$program_code,
							'appl_status' 					=>'Document Uploaded',
							'created_by'					=>$reg_user_id,
							'created_on'					=>$date
						);
						
						
						$sql = $this->db->insert('applicant_appl_overview_history', $new_data);
						//echo $this->db->last_query();
						if(!$sql){
							$dbstatus = "ERROR";
							$dbMessage = "Error Inserting";
							//$dbError = ;	
						}
						//header("location: apply-4.php?ins=$hex_ins_code&_s=$MY_SESSION_NAME");
					}
					else
					{
						if($error_count == $i)
						{
							$dbstatus = FALSE;
							$dbMessage = 'Error While Saving';
						}
						else
						{
							$dbstatus = FALSE;
							$dbMessage = 'Error While Saving';
						}
						
					}
					
					
				}//die();
				return array('status' => $dbstatus, 'msg' =>$dbMessage);
				
			break;
			
			case 'get_reg_id':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		//$ins =  encrypt_decrypt('decrypt', $data);
        		
				$this->db->select('reg_mode,email_id');
				$this->db->from('counselling_applicant_reg_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('counselling_code',$program_code);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				//$this->db->last_query();
				return $result->result_array();
			break;
			
			case 'payModeQuery':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$data = $this->uri->uri_to_assoc();
				$institute = $data['ins'];
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
				$this->db->select('payment_mode,description');
				$this->db->from('counselling_payment_mode_setup P');
				$this->db->join('gen_code_description G','P.payment_mode = G.code','inner');
				$this->db->where('P.institute_code',$ins);
				$this->db->where('P.record_status','1');
				$this->db->where('code_group','Payment Mode');
				$this->db->order_by('P.sl_no');
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'tempcode':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$data = $this->uri->uri_to_assoc();
				$institute = $data['ins'];
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
				$this->db->select('template_code');
				$this->db->from('counselling_program_master');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'categorydata':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$data = $this->uri->uri_to_assoc();
				$institute = $data['ins'];
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
				$this->db->select('category,last_grade');
				$this->db->from('applicant_detail');
				$this->db->where('jee_roll_no',$reg_user_id);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'deposit':
				$application_no = $this->session->userdata('appl_no');
				$this->db->select("money_deposit_mode,amount,DATE_FORMAT(depositdate,'%d-%m-%Y') AS depositdate,money_receipt_no");
				$this->db->from('counselling_applicant_form_fee_overview');
				$this->db->where('appl_no',$application_no);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$amt = $row['amount'];
					if($row['amount']=='0.00')
					{
						$noamount=1;
					}
					else
					{
						$noamount=0;
					}
				}
				return $result->result_array();
			break;
			case 'amount':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$data = $this->uri->uri_to_assoc();
				$institute = $data['ins'];
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$this->db->select('category,last_grade,physically_challenged');
				$this->db->from('applicant_detail');
				$this->db->where('jee_roll_no',$reg_user_id);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$category = $row['category'];
					$ph = $row['physically_challenged'];
				}
				if($ph=='YES'){
					$cat_val = 'PH';
				}else{
					$cat_val = $category;
				}
				$this->db->select('amount');
				$this->db->from('counselling_fee_setup');
				$this->db->where('category_code',$cat_val);
				$this->db->where('counselling_code',$program_code);
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'update_reg_mode':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$data = $this->uri->uri_to_assoc();
				$institute = $data['ins'];
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		$mode = $this->session->userdata('mode');
        		
        		$this->db->select('appl_status');
				$this->db->from('applicant_appl_overview');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('STATUS','1');
				//print_r($query);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row){
					$appl_status = $row['appl_status'];
				}
        		
        		if($appl_status == 'Document Uploaded' || $appl_status == 'Challan Generated')
        		{
        			
					if($mode =="edit")
	        		{ 
	        			$update_data = array(
						'reg_mode' 			=>'ONLINE'
						);
						$this->db->where('reg_user_id',$reg_user_id);
						$this->db->where('STATUS','1');
						$this->db->where('applied_program',$program_code);
						$sql = $this->db->update('applicant_reg_master', $update_data);
						if(!$sql){
							$dbStatus = "ERROR";
							$dbMessage = "Error Inserting";
						}
					}
				}
				if($appl_status == 'Fee Paid' || $appl_status == 'Verified')
        		{
					if($mode =="edit")
	        		{ 
						$this->db->select("money_deposit_mode,amount,DATE_FORMAT(depositdate,'%d-%m-%Y') AS depositdate,money_receipt_no");
						$this->db->from('counselling_applicant_form_fee_overview');
						$this->db->where('appl_no',$application_no);
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row)
						{
							$amt = $row['amount'];
							if($row['amount']=='0.00')
							{
								$noamount=1;
							}
							else
							{
								$noamount=0;
							}
						}
					}
					else
					{
						$this->db->select("money_deposit_mode,amount,DATE_FORMAT(depositdate,'%d-%m-%Y') AS depositdate,money_receipt_no");
						$this->db->from('counselling_applicant_form_fee_overview');
						$this->db->where('appl_no',$application_no);
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row)
						{
							$amt = $row['amount'];
							if($row['amount']=='0.00')
							{
								$noamount=1;
							}
						}
					}
				}
				if($mode=="edit")
				{
					$this->db->select('category,last_grade');
					$this->db->from('applicant_detail');
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('STATUS','1');
					$this->db->where('applied_program',$program_code);
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach($output_data as $row)
					{
						$category = $row['category'];
					}
				
					$this->db->select("amount");
					$this->db->from('program_fee_setup');
					$this->db->where('program_code',$program_code);
					$this->db->where('category_code',$category);
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach($output_data as $row)
					{
						$amount = $row['amount'];
						if($amount == '0')
						{
							$noamount=1;
						}
						else
						{
							$noamount=0;
						}
						$edit="true";
					}
				}
				return $result->result_array();
			break;
			
			case 'bank_detail':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$data = $this->uri->uri_to_assoc();
				$institute = $data['ins'];
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$this->db->select('category,last_grade');
				$this->db->from('applicant_detail');
				$this->db->where('jee_roll_no',$reg_user_id);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$category = $row['category'];
				}
				/*
        		$this->db->select('bank_name, account_no');
				$this->db->from('challan_detail');
				$this->db->where('STATUS','1');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$bank_name=$row['bank_name'];
					$account_no=$row['account_no'];
				}*/
				$this->db->select('amount');
				$this->db->from('counselling_fee_setup');
				$this->db->where('category_code',$category);
				$this->db->where('counselling_code',$program_code);
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'pass_status':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				
				$this->db->select('category,last_grade');
				$this->db->from('applicant_detail');
				$this->db->where('jee_roll_no',$reg_user_id);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				return $result->result_array();
			break;	
			case 'add_payment_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$data = $this->uri->uri_to_assoc();
				$institute = $data['ins'];
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		$mode = $this->session->userdata('mode');
        		
        		$dbStatus = "";
				$dbMessage = "";
				$dbError = "";
        		
        		$this->db->select('category,last_grade');
				$this->db->from('applicant_detail');
				$this->db->where('jee_roll_no',$reg_user_id);
				$this->db->where('STATUS','1');
				//$this->db->where('applied_program',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$category = $row['category'];
				}
        		$this->db->select('email_id');
				$this->db->from('counselling_applicant_reg_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('status','1');
				$this->db->where('counselling_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				
				$row_email = $result->num_rows();
				 
				foreach($output_data as $row)
				{
					$email_id = $row['email_id'];
				}
				$amount = 0;
        		$this->db->select('amount');
				$this->db->from('counselling_fee_setup');
				$this->db->where('category_code',$category);
				$this->db->where('counselling_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$amount = $row['amount'];
				}
        		if($amount == 0)
				{
					$noamount=1;
				}
				else
				{
					$noamount=0;
				}
        		
        		if($noamount == 1)
				{
					$this->db->trans_start();
					$dbstatus = TRUE;
					$dbmessage = 'Data saved successfully';
					
					$this->db->select('COUNT(appl_no) AS appl_no');
					$this->db->from('counselling_applicant_form_fee_overview');
					$this->db->where('appl_no',$application_no);
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach($output_data as $row)
					{
						$appl = $row['appl_no'];
					}
					if($appl >= 1)
					{
						$update_data = array(
		                    'id' =>'NULL',
		                    'appl_no' =>$application_no,
		                    'amount' => '0.00',
		                    'created_by' => $reg_user_id,
		                    'created_on' => $date
		               	);
		           	 $this->db->where("appl_no",$application_no); 
		           	 $this->db->update("counselling_applicant_form_fee_overview",$update_data); 
					}
					else
					{
						$new_data = array(
		                    'id' =>'NULL',
		                    'appl_no' =>$application_no,
		                    'amount' => '0.00',
		                    'created_by' => $reg_user_id,
		                    'created_on' => $date
		               	);
			            $this->db->insert("counselling_applicant_form_fee_overview",$new_data); 
			            if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting';
						}
					}
					
		            $update_data = array(
		                    'appl_status' =>'Verified',
		                    'updated_by' => $reg_user_id,
		                    'updated_on' => $date
		               	);
		            $this->db->where('appl_no',$application_no);   	
		            $update = $this->db->update("counselling_applicant_appl_overview",$update_data); 	
		            if(!$update)
					{
						$dbStatus = FALSE;
						$dbMessage = 'Error updating';
					}
					
					/*$this->db->select("A.template_code,B.file_name,B.template_name"); 	
		            $this->db->from("counselling_program_master A"); 	
		            $this->db->join('form_template_master B ','A.template_code = B.template_code','inner');
		            $this->db->where('A.program_code ',$program_code);
					$result = $this->db->get();
					$output_data = $result->result_array();
					
					foreach($output_data as $row)
					{
						$file_name = $row['file_name'];
						$temp_code = $row['template_code'];
						$temp_name = explode(".",$file_name);
						$print_function = $temp_name[0]."_pdf";
						$print_file_name = $temp_name[0]."pdf.php";
					}*/
					//$objMpdf = new Mpdf_controller();
					//$controllerInstance = & get_instance();
					
        			//$return = $controllerInstance->$print_function();
        			$return = true;
					if($return == true)
					{
						$this->db->trans_complete();
						$dbstatus = TRUE;
						$dbmessage = 'Application Submitted Successfully';
					}
					else
					{
						$this->db->trans_rollback();
						$dbstatus = FALSE;
						$dbmessage = 'Error in Application Submission';
					}
					
				}
				else
				{
					$radioPayment = $_POST['hidPaymentMode'];
					$txtChallanNo = trim($_POST['txtChallanNo']);
					$txtChallanDate = $_POST['txtChallanDate'];
					$txtSbiRefNo = $_POST['txtSbiRefNo'];
					$txtCollectDate = $_POST['txtCollectDate'];
					/*if($radioPayment == "ONLINE")
					{
						//show in .php
						header("location: onlinepaymentinstruction.php?ins=$hex_ins_code&_s=$MY_SESSION_NAME"); 	
							
					}*/
					if($radioPayment == "CHALLAN")
					{
						
						$this->db->select('category,last_grade');
						$this->db->from('applicant_master');
						$this->db->where('reg_user_id',$reg_user_id);
						$this->db->where('STATUS','1');
						$this->db->where('applied_program',$program_code);
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row)
						{
							$category = $row['category'];
						}
				
						$this->db->select("amount"); 	
			            $this->db->from("program_fee_setup"); 	
			            $this->db->where('program_code ',$program_code);
			            $this->db->where('category_code ',$category);
			            $result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row)
						{
							$amount = $row_amt['amount'];
						}
						$this->db->trans_start();
						
						$this->db->select("COUNT(appl_no) as appl_no"); 	
			            $this->db->from("counselling_applicant_form_fee_overview"); 	
			            $this->db->where('appl_no ',$application_no);
			            $result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row)
						{
							$appl_no = $row_amt['appl_no'];
							if($appl_no >= 1)
							{
								$update_data = array(
			                    'money_deposit_mode' =>'CHALLAN',
			                    'amount' =>$amount,
			                    'depositdate' =>date('Y-m-d', strtotime($txtChallanDate)),
			                    'money_receipt_no' =>$txtChallanNo,
			                    'modified_by' => $reg_user_id,
			                    'modified_on' => $date
			               		);
					            $this->db->insert("counselling_applicant_form_fee_overview",$update_data); 	
								$result = $this->db->get();
							}
							else
							{
								$new_data = array(
			                    'id' =>'NULL',
			                    'appl_no' =>$application_no,
			                    'money_deposit_mode' =>'CHALLAN',
			                    'amount' =>$amount,
			                    'depositdate' =>date('Y-m-d', strtotime($txtChallanDate)),
			                    'money_receipt_no' =>$txtChallanNo,
			                    'created_by' => $reg_user_id,
			                    'created_on' => $date
				               	);
					            $this->db->insert("counselling_applicant_form_fee_overview",$new_data); 	
								$result = $this->db->get();
								
							}
						}
						$new_data = array(
		                    'id' =>'NULL',
		                    'appl_no' =>$application_no,
		                    'money_deposit_mode' =>'CHALLAN',
		                    'depositdate' =>date('Y-m-d', strtotime($txtChallanDate)),
		                    'challan_bank' =>$bank_name,
		                    'challan_number' =>$txtChallanNo,
		                    'deposit_status' =>'Pending',
		                    'created_by' => $reg_user_id,
		                    'created_on' => $date
		               	);
			            $this->db->insert("applicant_form_challan_deposit",$new_data); 	
						$result = $this->db->get();
						
						$new_data = array(
		                    'appl_status' =>'Fee Paid',
		                    'updated_by' => $reg_user_id,
		                    'updated_on' => $date
		               	);
			            $this->db->where('appl_no',$application_no); 	
			            $this->db->update("applicant_appl_overview",$new_data); 	
						$result = $this->db->get();
						
						$new_data = array(
		                    'id' =>'NULL',
		                    'reg_user_id' =>$reg_user_id,
		                    'appl_no' =>$application_no,
		                    'form_no' =>$application_no,
		                    'applied_program' =>$program_code,
		                    'appl_status' =>'Fee Paid',
		                    'created_by' => $reg_user_id,
		                    'created_on' => $date
		               	);
			            $this->db->insert("applicant_appl_overview_history",$new_data); 	
						$result = $this->db->get();
						
						$this->db->select("A.template_code,B.file_name,B.template_name"); 	
			            $this->db->from("counselling_program_master A"); 	
			            $this->db->join('form_template_master B ','A.template_code = B.template_code','inner');
			            $this->db->where('A.program_code ',$program_code);
						$sql = $this->db->get();
						$output_data = $result->result_array();
						if($sql)
						{
							foreach($output_data as $row)
							{
								$file_name = $row['file_name'];
								$temp_code = $row['template_code'];
								$temp_name = explode(".",$file_name);
								$print_function = $temp_name[0]."pdf";
								$print_file_name = $temp_name[0]."pdf.php";
							}
						}
						$return = $print_function();
						if($return == true)
						{
							if(file_exists($document_upload_url.'/'.$seladmcode.'/'.$application_no.'/application_print.pdf'))
							{
								$this->db->trans_complete();
							}
							else
							{
								$this->db->trans_rollback();
							}
						}
						else
						{
							$this->db->trans_rollback();
						}
							
							
					}
					else if($radioPayment == "SBI")
					{
						$this->db->select('category,last_grade');
						$this->db->from('applicant_master');
						$this->db->where('reg_user_id',$reg_user_id);
						$this->db->where('STATUS','1');
						$this->db->where('applied_program',$program_code);
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row)
						{
							$category = $row['category'];
						}
						
						$this->db->select("amount");
						$this->db->from('program_fee_setup');
						$this->db->where('program_code',$program_code);
						$this->db->where('category_code',$category);
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row_amt)
						{
							$amount = $row_amt['amount'];
						}
						
						
						$this->db->select("count(appl_no) AS appl_no");
						$this->db->from('counselling_applicant_form_fee_overview');
						$this->db->where('appl_no',$application_no);
						$this->db->where('money_deposit_mode','SBI Collect');
						
						$result = $this->db->get();
						$output_data = $result->result_array();
						
						foreach ($output_data as $aRow1) 
	            		{
	            			$result = $aRow1['appl_no'];
							if($result >= 1)
							{
								$update_data = array(
									'money_deposit_mode' 			=>'SBI Collect',
									'amount' 						=>$amount,
									'depositdate' 					=>date('Y-m-d', strtotime($txtCollectDate)),
									'money_receipt_no'				=>$txtSbiRefNo,
									'modified_by'					=>$reg_user_id,
									'modified_on'					=>$date
								);
								$this->db->where('appl_no',$application_no );
								$this->db->where('money_deposit_mode','SBI Collect' );
								$sql = $this->db->update('counselling_applicant_form_fee_overview', $update_data);
								//echo $this->db->last_query();
								if(!$sql){
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									//$dbError = ;	
								}
							}
							else
							{
								$new_data = array(
									'id' 							=>'NULL',
									'appl_no' 						=>$application_no,
									'money_deposit_mode' 			=>'SBI Collect',
									'amount' 						=>$amount,
									'depositdate' 					=>date('Y-m-d', strtotime($txtCollectDate)),
									'money_receipt_no' 				=>$txtSbiRefNo,
									'created_by'					=>$reg_user_id,
									'created_on'					=>$date
								);
								$sql = $this->db->insert('counselling_applicant_form_fee_overview', $new_data);
								//echo $this->db->last_query();
								if(!$sql){
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									//$dbError = ;	
								}
							}
		                }
						
						$new_data = array(
							'id' 							=>'NULL',
							'appl_no' 						=>$application_no,
							'money_deposit_mode' 			=>'SBI Collect',
							'depositdate' 					=>date('Y-m-d', strtotime($txtCollectDate)),
							'challan_bank' 					=>$bank_name,
							'challan_number' 				=>$txtSbiRefNo,
							'deposit_status' 				=>'Pending',
							'created_by'					=>$reg_user_id,
							'created_on'					=>$date
						);
						$sql = $this->db->insert('applicant_form_challan_deposit', $new_data);
						if(!$sql){
							$dbStatus = "ERROR";
							$dbMessage = "Error Inserting";
						}
						
						$update_data = array(
							'appl_status' 					=>'Fee Paid',
							'updated_by'					=>$reg_user_id,
							'updated_on'					=>$date
						);
						$this->db->where('appl_no', $application_no);
						$sql = $this->db->update('applicant_appl_overview', $update_data);
						if(!$sql){
							$dbStatus = "ERROR";
							$dbMessage = "Error Updating";
						}
						
						$new_data = array(
							'id' 							=>'NULL',
							'appl_no' 						=>$application_no,
							'reg_user_id' 			=>$reg_user_id,
							'form_no' 					=>$application_no,
							'applied_program' 					=>$program_code,
							'appl_status' 				=>'Fee Paid',
							'created_by'					=>$reg_user_id,
							'created_on'					=>$date
						);
						$sql = $this->db->insert('applicant_appl_overview_history', $new_data);
						if(!$sql){
							$dbStatus = "ERROR";
							$dbMessage = "Error Inserting";
						}
						
						$this->db->select("A.template_code,B.file_name,B.template_name"); 	
			            $this->db->from("counselling_program_master A"); 	
			            $this->db->join('form_template_master B ','A.template_code = B.template_code','inner');
			            $this->db->where('A.program_code ',$program_code);
						$sql = $this->db->get();
						$output_data = $result->result_array();
						if($sql)
						{
							foreach($output_data as $row)
							{
								$file_name = $row['file_name'];
								$temp_code = $row['template_code'];
								$temp_name = explode(".",$file_name);
								$print_function = $temp_name[0]."_pdf";
								$print_file_name = $temp_name[0]."pdf.php";
							}
						}
						$return = $this->$print_function();
						//$this->M$print_function;
						if($return == true)
						{
							echo "hello";
						}
						else
						{
							$this->db->trans_rollback();
						}
					}
				}
		
				if($dbstatus == TRUE && $row_email > 0 &&  $email_id != ''){
				//echo $email_id;die();
					$this->db->select('es.email_type,es.subject,es.content');
					$this->db->from('email_setup es');
					$this->db->join('counselling_email_setup pes','es.email_type = pes.email_type','inner');
					$this->db->where('pes.counselling_code',$program_code);
					$this->db->where('es.email_type','SUBMISSION');
					
					$result = $this->db->get();
					$query = $result->result_array();
					$row_count = $result->num_rows();
					foreach($result->result_array() AS $row1)
					{
						$email_type=$row1['email_type'];
						$subject=$row1['subject'];
						$content=$row1['content'];
					}
					
					
					 if($row_count > 0) {
					 	$this->load->library('email');
					    $this->email->set_newline("\r\n");
					    $this->email->set_mailtype("html");
					     //set email information and content
					    $this->email->from('svnirtar.pget2018@gmail.com', 'NIRTAR ADMIN');
					    $this->email->to($email_id);
					    $this->email->subject($subject);
					    $this->email->message($content);
					    if($this->email->send()){
						    $dbStatus = TRUE; 
						    $dbMessage = 'A mail is forwarded to your registered mail id  ';
					    }else{
						    $dbStatus = FALSE; 
						    $dbMessage = 'Unable to sent Mail.Please Contact for Support';
					    }
					}
				}
				return array('status' => $dbstatus, 'msg' =>$dbmessage);
			break;
			
			default :
            	return array('status' => FALSE, 'msg' =>'Unable to load.Contact Support');
			
        }
    }
}
