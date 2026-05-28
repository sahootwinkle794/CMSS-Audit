<?php

class Apply_model extends CI_model {

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
				//print_r($result->result_array());
				return $result->result_array();
			break;
			case 'get_program_group':
				$ins =  encrypt_decrypt('decrypt', $data);
				if($ins == '0') 
					$ins = '';
				$this->db->distinct('program_group_code');
				$this->db->select('program_group_code,program_group_name');
				$this->db->from('program_group_master A');
				$this->db->join('program_master B','A.program_group_name = B.program_group','inner');
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
        		$reg_user_id = $this->session->userdata('reg_user_id');
				$this->db->select('A.program_group,A.id,A.program_name,A.program_code,A.year,A.apply_start_date,A.apply_end_date,A.template_code,C.file_name,aao.appl_status');
				$this->db->from('program_master A');
				$this->db->join('program_group_master B','A.program_group = B.program_group_name','inner');
				$this->db->join('form_template_master C','A.template_code = C.template_code','inner');
				$this->db->join('applicant_appl_overview aao',"A.program_code = aao.applied_program AND reg_user_id = '$reg_user_id'",'LEFT');
				$this->db->where('A.institute_code',$ins);
				$this->db->where('A.record_status',1);
				$this->db->where('A.publish_status','YES');
				$this->db->where('A.program_start_date<=',$date);
				$this->db->where('A.program_end_date>=',$date);
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
				$this->db->from('program_master A');
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
				$this->db->select("reg_user_id,dob,first_name,mid_name,last_name,email_id");
				$this->db->from('applicant_reg_master');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_application_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
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
				$this->db->select("*,DATE_FORMAT(dob,'%d-%m-%Y') AS dob1,CASE WHEN comm_address_ref_id = perm_address_ref_id THEN 'Y' ELSE 'N' END AS addresscheck");
				$this->db->from('applicant_master');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('status','1');
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_present_communication_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("applicant_address.*");
				$this->db->from('applicant_address');
				$this->db->join('applicant_master','applicant_address.address_ref_id = applicant_master.comm_address_ref_id','left');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_permanent_communication_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("applicant_address.*");
				$this->db->from('applicant_address');
				$this->db->join('applicant_master','applicant_address.address_ref_id = applicant_master.perm_address_ref_id','left');
				$this->db->where('applied_program',$program_code);
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
				$this->db->select("rel_name, rel_occupation, rel_desig, nature_of_work,annual_income, place_work, email_id, res_no, mobile_no");
				$this->db->from('applicant_relation');
				$this->db->join('applicant_master','applicant_relation.reg_user_id=applicant_master.reg_user_id','left');
				$this->db->where('applicant_rel_flag','1');
				$this->db->where('applicant_relation.applied_program',$program_code);
				$this->db->where('applicant_relation.reg_user_id',$reg_user_id);
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_mother_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
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
				$this->db->select("qual_desc_1,year_of_passing,university_board,division_distinction,mark_secured,full_mark,percentage_mark");
				$this->db->from('applicant_qualification_detail');
				$this->db->join('applicant_master','applicant_master.applied_program = applicant_qualification_detail.applied_program AND applicant_master.reg_user_id = applicant_qualification_detail.reg_user_id','inner');
				$this->db->where('applicant_master.applied_program',$program_code);
				$this->db->where('applicant_master.reg_user_id',$reg_user_id);
				$this->db->order_by('applicant_qualification_detail.id');
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			//****************************************************************************************************// 
			
			case 'get_documents_required':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
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
				$this->db->select("A.qualification_code, B.qualification_name, B.division");
				$this->db->from('program_qualification_setup A');
				$this->db->join('qualification_master B','A.qualification_code = B.qualification_code','inner');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.record_status',1);
				$this->db->order_by('B.id');
				
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
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
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.category_code, A.category_name");
				$this->db->from('category_master A');
				$this->db->join('program_category_setup B','A.category_code = B.category_code','inner');
				$this->db->where('B.program_code',$program_code);
				$this->db->where('A.category_code!=','GEN');
				$this->db->where('B.record_status',1);
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
				$this->db->join('program_master B','A.template_code = B.template_code','inner');
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
				$first_name =isset($_POST['txtFirstName'])?$_POST['txtFirstName']:'';
				$last_name =isset($_POST['txtLastName'])?$_POST['txtLastName']:'';
				$middle_name =isset($_POST['txtMiddleName'])?$_POST['txtMiddleName']:'';
				$phone_no =isset($_POST['txtCandidatePhone'])?$_POST['txtCandidatePhone']:'';
				$reg_user_id =isset($_POST['txtCandidatePhone'])?$_POST['txtCandidatePhone']:'';
				$email =isset($_POST['txtEmail'])?$_POST['txtEmail']:'';
				$dob =isset($_POST['txtdob1'])?$_POST['txtdob1']:'';
				$dob =date('Y-m-d', strtotime($dob));
				
				$this->db->select('COUNT(reg_user_id) AS counting,reg_status');
				$this->db->from('applicant_reg_master');
				$this->db->where('reg_user_id',$phone_no);
				$this->db->where('institute_code','NIRTAR');
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				
				$query = $result->result_array();
				foreach($result->result_array() AS $row1)
				{
					$present=$row1['counting'];
					$status=$row1['reg_status'];
				}
				
				if($present==0)
				{
					$this->session->set_userdata('count', 0);
					$new_data = array(
	                    'first_name' =>$first_name,
	                    'mid_name' =>$middle_name,
	                    'last_name' => $last_name,
	                    'email_id' => $email,
	                    'reg_user_id' => $phone_no,
	                    'institute_code' => 'NIRTAR',
	                    'reg_status' => 'Verified',
	                    'dob' => $dob,
	                    'applied_program' => 'NIRPROG1_NIRTAR',
	                    'created_by' => $phone_no,
	                    'created_on' => date('Y-m-d H:i:s', now())
	               	);
					if (!$this->db->insert('applicant_reg_master', $new_data))
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error occur in Registred';
					}
					
					$contact_no = $phone_no;
					return array('status' => $dbstatus, 'msg' => $dbmessage);
				}
					
			break;
			case 'verify_registration_data':
				$dbstatus = TRUE;
				$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				$phone_no =isset($_POST['txtCandidatePhone'])?$_POST['txtCandidatePhone']:'';
				$dob =isset($_POST['txtdob'])?$_POST['txtdob']:'';
				$txtdob =date('Y-m-d', strtotime($dob));
				$this->db->select('*');
				$this->db->from('applicant_reg_master');
				$this->db->where('reg_user_id',$phone_no);
				$this->db->where('dob',$txtdob);
				$this->db->where('institute_code','NIRTAR');
				$this->db->limit(1);
				//print_r($query);
				$result = $this->db->get();
				$present = $result->num_rows();
				foreach($result->result_array() AS $row2)
				{
					$institute_code = $row2['institute_code'];
					$first_name = $row2['first_name'];
				}
				if($present==1) 
				{
					$this->session->set_userdata('reg_user_id', $phone_no);
					$this->session->set_userdata('institute_code', $institute_code);
					$this->session->set_userdata('first_name', $first_name);
					$this->session->set_userdata('mode', 'new');
					$this->session->set_userdata('step', 2);
					return array('status' => $dbstatus, 'msg' => $dbmessage, 'enc_ins'=>encrypt_decrypt('encrypt', $institute_code));
				}
				else
				{
					return array('status' => FALSE, 'msg' => 'Incorrect Mobile No or Date of Birth');
				}
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
				$this->db->from('program_master A');
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
			case 'temp_config':
				$seladmcode = $this->input->post('admcode');
				$expo=explode('_',$seladmcode);
				$ins_code = $expo[1];
				$ins = encrypt_decrypt('encrypt', $ins_code);
				$reg_user_id = $this->session->userdata('reg_user_id');
				$r_query6='';
				
				$this->db->select('A.template_code,B.file_name,A.apply_end_date');
				$this->db->from('program_master A');
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
					$this->db->join('program_master B','A.prog_code = B.program_code','inner');
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
				$this->db->from('program_master A');
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
				if($radioQuota == 'Yes')
				{
					$cmbReservedCategory = isset($_POST['cmbReservedCategory']) ? $_POST['cmbReservedCategory'] : '';
				}
				else
				{
					$cmbReservedCategory = 'GEN';
				}
				$cmbNationality = isset($_POST['cmbNationality']) ? $_POST['cmbNationality'] : '';
				$cmbCommunity = isset($_POST['cmbCommunity']) ? $_POST['cmbCommunity'] : '';
				
				$radioMinority = isset($_POST['radioMinority']) ? $_POST['radioMinority'] : '';
				$txtemail = isset($_POST['txtemail']) ? $_POST['txtemail'] : '';
				$txtemail1 = isset($_POST['txtemail1']) ? $_POST['txtemail1'] : '';
				$radiobelong = isset($_POST['radiobelong']) ? $_POST['radiobelong'] : '';
				$txtOccupation = isset($_POST['txtOccupation']) ? $_POST['txtOccupation'] : '';
				$txtIncome = isset($_POST['txtIncome']) ? $_POST['txtIncome'] : '';
				$txtIndicate = isset($_POST['txtIndicate']) ? $_POST['txtIndicate'] : '';
				$txtKnowabout = isset($_POST['txtKnowabout']) ? $_POST['txtKnowabout'] : '';
				$radioPhysicallY  = isset($_POST['radioPhysicallY']) ? $_POST['radioPhysicallY'] : '';
				
				$txtOtherNationality = isset($_POST['txtOtherNationality']) ? trim($_POST['txtOtherNationality']) : '';
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
				$txtUid = isset($_POST['txtUid']) ? trim($_POST['txtUid']) : '';
					
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
				  
				//
				
				$radioExam = isset($_POST['radioExam']) ? $_POST['radioExam'] : '';
				$hidDate = isset($_POST['hidDate']) ? $_POST['hidDate'] : '';
				$txtExamMark = isset($_POST['txtExamMark']) && trim($_POST['txtExamMark']) != '' ? (float) trim($_POST['txtExamMark']) : 'NULL';
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
				$applicant_master_update_array = array(
						'first_name' => $txtFirstName,
						'mid_name' => $txtMiddleName,
						'last_name' => $txtLastName,
						'full_name' => $fullname,
						'exam_center_code' => $cmbExamCenter,
						'gender' => $radiogender,
						'nationality' => $cmbNationality,
						'dob' => $dob,
						'adhar_no' => $txtUid,
						'dob_in_word' => $hidDate,
						'category' => $cmbReservedCategory,
						'highest_qualification' => $cmbHighestQualification,
						'last_grade' => $cmbPassStatus,
						'last_school' => $txtUnivName,
						
						'total_mark' => $txtTotalMarks,
						'secured_mark' => $txtSecuredMarks,
						'distinction' => $radioDistinction,
						'honours_subject' => $txtHonoursSubject,
						'honours_total_mark' => $txtHonsTotalMarks,
						'honours_secured_mark' => $txtHonsSecuredMarks,
						'honours_division' => $txtHonsDivision,
						'course_type' => $radioCourseType,
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
						'is_kashmiri_migrant' => $radioMigrant,
						'is_reserved_quota' => $radioQuota,
						'other_university' => $txtOtherUniversity,
						'other_subject' => $txtOtherSubject,
						'updated_by' => $reg_user_id,
						'updated_on' => $now,
						'univ_regn_no' => $txtUnivRegNo,
						'created_by' => $reg_user_id,
							'created_on' => $now,
							'univ_regn_no' => $txtUnivRegNo,
							/*'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$comm_address_ref_id,*/
							'master_name'=>$master_name,
							'center_name1'=>$center_name1,
							'center_code1'=>$center_code1,
							'center_name2'=>$center_name2,
							'center_code2'=>$center_code2, 
							'center_name3'=>$center_name3,
							'center_code3'=>$center_code3, 

							'is_employed'=>$employed,
							'employer_add'=>$Employer_address,
							'employer_from'=>$Employer_from,
							'employer_to'=>$Employer_to,
							'employer_add1'=>$Employer_address1, 
							'employer_from1'=>$Employer_from1,
							'employer_to1'=>$Employer_to1, 
							
							'completion_date'=>$completion_date 
							/*'amount_paid'=>$amount_paid, 
							'draft_no'=>$draft_no, 
							'payment_date'=>$payment_date, 
							'bank_name'=>$bank_name */


					);
					$applicant_history_insert_array = array(
						'reg_user_id' => $reg_user_id,
						'applied_program' => $program_code,
						'first_name' => $txtFirstName,
						'mid_name' => $txtMiddleName,
						'last_name' => $txtLastName,
						'full_name' => $fullname,
						'exam_center_code' => $cmbExamCenter,
						'gender' => $radiogender,
						'nationality' => $cmbNationality,
						'dob' => $dob,
						//'applicant_email' => $txtApplicantEmail,
						'applicant_landline' => $txtApplicantLandLine,
						'applicant_mobile' => $txtApplicantMobile,
						'created_by' => $reg_user_id,
						'created_on' => $now,
						'is_minority_community' => $radioMinority,
						'minority_community_details' => $cmbCommunity,
						
						'is_north_east' => $radiobelong,
						'father_occupation' => $txtOccupation,
						'annual_parent_income' => $txtIncome,
						'indicate_choice' => $txtIndicate,
						'know_about_cipet' => $txtKnowabout,
						'physically_challenged' => $radioPhysicallY ,
						'univ_regn_no' => $txtUnivRegNo,
						'created_by' => $reg_user_id,
							'created_on' => $now,
							'univ_regn_no' => $txtUnivRegNo,
							/*'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$comm_address_ref_id,*/
							'master_name'=>$master_name,
							'center_name1'=>$center_name1,
							'center_code1'=>$center_code1,
							'center_name2'=>$center_name2,
							'center_code2'=>$center_code2, 
							'center_name3'=>$center_name3,
							'center_code3'=>$center_code3, 
							
							'is_employed'=>$employed,
							'employer_add'=>$Employer_address,
							'employer_from'=>$Employer_from,
							'employer_to'=>$Employer_to,
							'employer_add1'=>$Employer_address1, 
							'employer_from1'=>$Employer_from1,
							'employer_to1'=>$Employer_to1, 
							
							'completion_date'=>$completion_date 
							/*'amount_paid'=>$amount_paid, 
							'draft_no'=>$draft_no, 
							'payment_date'=>$payment_date, 
							'bank_name'=>$bank_name  */
					);
					$applicant_master_insert_array = array(
						'reg_user_id' => $reg_user_id,
						'applied_program' => $program_code,
						'first_name' => $txtFirstName,
						'mid_name' => $txtMiddleName,
						'last_name' => $txtLastName,
						'full_name' => $fullname,
						'exam_center_code' => $cmbExamCenter,
						'gender' => $radiogender,
						'nationality' => $cmbNationality,
						'dob' => $dob,
						'adhar_no' => $txtUid,
						'dob_in_word' => $hidDate,
						'category' => $cmbReservedCategory,
						'highest_qualification' => $cmbHighestQualification,
						'last_grade' => $cmbPassStatus,
						'last_school' => $txtUnivName,
						'total_mark' => $txtTotalMarks,
						'secured_mark' => $txtSecuredMarks,
						'distinction' => $radioDistinction,
						'honours_subject' => $txtHonoursSubject,
						'honours_total_mark' => $txtHonsTotalMarks,
						'honours_secured_mark' => $txtHonsSecuredMarks,
						'honours_division' => $txtHonsDivision,
						'course_type' => $radioCourseType,
						'religion' => $cmbReligion,
						//'applicant_email' => $txtApplicantEmail,
						'applicant_landline' => $txtApplicantLandLine,
						'applicant_mobile' => $txtApplicantMobile,
						'mother_tongue' => $txtMotherTongue, 
						'hostel_facility' => $radioHostel,
						'marital_status' => $radiomaritalstatus,
						'is_kashmiri_migrant' => $radioMigrant,
						'is_reserved_quota' => $radioQuota,
						'other_university' => $txtOtherUniversity,
						'other_subject' => $txtOtherSubject,
						
						'is_minority_community' => $radioMinority,
						'minority_community_details' => $cmbCommunity,
						
						'is_north_east' => $radiobelong,
						'father_occupation' => $txtOccupation,
						'annual_parent_income' => $txtIncome,
						'indicate_choice' => $txtIndicate,
						'know_about_cipet' => $txtKnowabout,
						'physically_challenged' => $radioPhysicallY ,
						
						
						'updated_by' => $reg_user_id,
						'updated_on' => $now,
						'univ_regn_no' => $txtUnivRegNo,
						'created_by' => $reg_user_id,
							'created_on' => $now,
							'univ_regn_no' => $txtUnivRegNo,
							/*'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$comm_address_ref_id,*/
							'master_name'=>$master_name,
							'center_name1'=>$center_name1,
							'center_code1'=>$center_code1,
							'center_name2'=>$center_name2,
							'center_code2'=>$center_code2, 
							'center_name3'=>$center_name3,
							'center_code3'=>$center_code3, 
							
							'is_employed'=>$employed,
							'employer_add'=>$Employer_address,
							'employer_from'=>$Employer_from,
							'employer_to'=>$Employer_to,
							'employer_add1'=>$Employer_address1, 
							'employer_from1'=>$Employer_from1,
							'employer_to1'=>$Employer_to1, 
							
							'completion_date'=>$completion_date 
							/*'amount_paid'=>$amount_paid, 
							'draft_no'=>$draft_no, 
							'payment_date'=>$payment_date, 
							'bank_name'=>$bank_name */
					);
				//echo $mode;die();
				if($mode == 'edit')
				{
					$this->db->trans_start();
					$dbstatus = TRUE;
					$dbmessage = 'Data saved successfully';
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					//print_r($applicant_master_update_array);die();
					$update_applicant = $this->db->update('applicant_master',$applicant_master_update_array);
					if(!$update_applicant){
						$dbstatus = FALSE;
						$dbmessage = 'Error updating applicant_master';
					}
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
							'post_office' => $txtPermenentPost,
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
						if($txtYear4 != '')
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
								//print_r($update_applicant_qualification_array4);
								$this->db->insert('applicant_qualification_detail',$update_applicant_qualification_array4);
						}
						
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
							'exam_center_code' => $cmbExamCenter,
							'gender' => $radiogender,
							'nationality' => $cmbNationality,
							'dob' => $dob,
							'adhar_no' => $txtUid,
							'dob_in_word' => $hidDate,
							'category' => $cmbReservedCategory,
							'highest_qualification' => $cmbHighestQualification,
							'last_grade' => $cmbPassStatus,
							'last_school' => $txtUnivName,
							'total_mark' => $txtTotalMarks,
							'secured_mark' => $txtSecuredMarks,
							'distinction' => $radioDistinction,
							'honours_subject' => $txtHonoursSubject,
							'honours_total_mark' => $txtHonsTotalMarks,
							'honours_secured_mark' => $txtHonsSecuredMarks,
							'honours_division' => $txtHonsDivision,
							'course_type' => $radioCourseType,
							'religion' => $cmbReligion,
							//'applicant_email' => $txtApplicantEmail,
							'applicant_landline' => $txtApplicantLandLine,
							'applicant_mobile' => $txtApplicantMobile,
							'mother_tongue' => $txtMotherTongue, 
							'hostel_facility' => $radioHostel,
							'marital_status' => $radiomaritalstatus,
							'is_kashmiri_migrant' => $radioMigrant,
							'is_reserved_quota' => $radioQuota,
							'other_university' => $txtOtherUniversity,
							'other_subject' => $txtOtherSubject,
							
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
							'univ_regn_no' => $txtUnivRegNo,
							'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$comm_address_ref_id,
							'master_name'=>$master_name,
							'center_name1'=>$center_name1,
							'center_code1'=>$center_code1,
							'center_name2'=>$center_name2,
							'center_code2'=>$center_code2, 
							'center_name3'=>$center_name3,
							'center_code3'=>$center_code3, 
							'is_employed'=>$employed,
							'employer_add'=>$Employer_address,
							'employer_from'=>$Employer_from,
							'employer_to'=>$Employer_to,
							'employer_add1'=>$Employer_address1, 
							'employer_from1'=>$Employer_from1,
							'employer_to1'=>$Employer_to1, 
							
							'completion_date'=>$completion_date 
							);
						$this->db->insert('applicant_master',$applicant_master_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant same address';
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
							'exam_center_code' => $cmbExamCenter,
							'gender' => $radiogender,
							'nationality' => $cmbNationality,
							'dob' => $dob,
							'adhar_no' => $txtUid,
							'dob_in_word' => $hidDate,
							'category' => $cmbReservedCategory,
							'highest_qualification' => $cmbHighestQualification,
							'last_grade' => $cmbPassStatus,
							'last_school' => $txtUnivName,
							'total_mark' => $txtTotalMarks,
							'secured_mark' => $txtSecuredMarks,
							'distinction' => $radioDistinction,
							'honours_subject' => $txtHonoursSubject,
							'honours_total_mark' => $txtHonsTotalMarks,
							'honours_secured_mark' => $txtHonsSecuredMarks,
							'honours_division' => $txtHonsDivision,
							'course_type' => $radioCourseType,
							'religion' => $cmbReligion,
							//'applicant_email' => $txtApplicantEmail,
							'applicant_landline' => $txtApplicantLandLine,
							'applicant_mobile' => $txtApplicantMobile,
							'mother_tongue' => $txtMotherTongue, 
							'hostel_facility' => $radioHostel,
							'marital_status' => $radiomaritalstatus,
							'is_kashmiri_migrant' => $radioMigrant,
							'is_reserved_quota' => $radioQuota,
							'other_university' => $txtOtherUniversity,
							'other_subject' => $txtOtherSubject,
							'created_by' => $reg_user_id,
							'created_on' => $now,
							
							'is_minority_community' => $radioMinority,
							'minority_community_details' => $cmbCommunity,
							'applicant_email' => $txtemail,
							'is_north_east' => $radiobelong,
							'father_occupation' => $txtOccupation,
							'annual_parent_income' => $txtIncome,
							'indicate_choice' => $txtIndicate,
							'know_about_cipet' => $txtKnowabout,
							'physically_challenged' => $radioPhysicallY ,
							
							'univ_regn_no' => $txtUnivRegNo,
							'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$perm_address_ref_id,
							'created_by' => $reg_user_id,
							'created_on' => $now,
							'univ_regn_no' => $txtUnivRegNo,
							'master_name'=>$master_name,
							'center_name1'=>$center_name1,
							'center_code1'=>$center_code1,
							'center_name2'=>$center_name2,
							'center_code2'=>$center_code2, 
							'center_name3'=>$center_name3,
							'center_code3'=>$center_code3, 
							'is_employed'=>$employed,
							'employer_add'=>$Employer_address,
							'employer_from'=>$Employer_from,
							'employer_to'=>$Employer_to,
							'employer_add1'=>$Employer_address1, 
							'employer_from1'=>$Employer_from1,
							'employer_to1'=>$Employer_to1, 
							
							'completion_date'=>$completion_date 
						);
						$this->db->insert('applicant_master',$applicant_master_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant same address';
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
					
					
					if($txtYear4 != '')
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
					}
					if($dbStatus == TRUE)
					{
						
						$this->db->select("program_code,year,sl_no");
						$this->db->from('program_master');
						$this->db->where('program_code',$program_code);
						$result = $this->db->get();
						foreach($result->result_array() as $appl)
						{
							$sl_no = $appl['sl_no'];
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
						$application_data = array(
							'reg_user_id'	=>$reg_user_id,
							'appl_no'		=>$application_no,
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
							$this->db->where('program_code',$program_code);
							$this->db->update('program_master',$program_update_data);
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
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		//$institute_code = $this->session->userdata('institute_code');
        		$data = $this->uri->uri_to_assoc();
				$institute = $data['ins'];
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
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
        		
        		
				$this->db->select('appl_status,appl_no');
				$this->db->from('applicant_appl_overview');
				
				$this->db->where('applied_program',$program_code);
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
			
			case 'get_doc_path':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$ins =  encrypt_decrypt('decrypt', $data);
        		
        		
				$this->db->select('document_path,document_type');
				$this->db->from('applicant_form_documents');
				
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
				$retrievedir = BASE_ADM_URL."/".$program_code."/".$application_no;
				if(!is_dir($uploaddir))
					mkdir($uploaddir,0777,true);
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
	  					if(isset($_FILES['fileDocument']['tmp_name'][$i]) && !empty($_FILES['fileDocument']['tmp_name'][$i]))
				  		{
				  			$document_type_code = $row['document_type_code'];
				  			$imageFileType = end((explode(".", $_FILES['fileDocument']['name'][$i])));
							$check = getimagesize($_FILES["fileDocument"]["tmp_name"][$i]);
							
							if($check['mime'] != 'image/jpeg' && $check['mime'] != 'image/jpg' && $check['mime'] != 'image/png' && $check['mime'] != 'image/gif') {
								return array('status'=>false, 'msg'=>"Not an Image");
							}
							
							// Check file size
							if($_FILES["fileDocument"]["size"][$i] > 1536000) {
								return array('status'=>false, 'msg'=>"Size of the image should be within 1MB");
							}
							// Allow certain file formats
							if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
								return array('status'=>false, 'msg'=>"Supported file types are jpg/png/jpeg/gif");
							}
							if(isset($_FILES['fileDocument']['tmp_name'][$i]) && !empty($_FILES['fileDocument']['tmp_name'][$i])){
								//$image_name = base64_encode(file_get_contents($_FILES['fileinstitutelogo']['tmp_name']));
								//$pic_name = $this->session->userdata('user_id')."1".time().".png";//$_FILES['fileinstitutelogo']['name'];
								$pic_name = $this->input->post('institutecode').md5(uniqid($user)).".".$imageFileType;//$_FILES['fileinstitutelogo']['name'];
								
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
	  					if(isset($_FILES['fileDocument']['tmp_name'][$i]) && !empty($_FILES['fileDocument']['tmp_name'][$i]))
				  		{
				  			$document_type_code = $row['document_type_code'];
				  			$imageFileType = end((explode(".", $_FILES['fileDocument']['name'][$i])));
							$check = getimagesize($_FILES["fileDocument"]["tmp_name"][$i]);
							//print_r($check);die();
							if($check['mime'] != 'image/jpeg' && $check['mime'] != 'image/jpg' && $check['mime'] != 'image/png' && $check['mime'] != 'image/gif') {
								return array('status'=>false, 'msg'=>"Not an Image");
							}
							
							// Check file size
							if($_FILES["fileDocument"]["size"][$i] > 1536000) {
								return array('status'=>false, 'msg'=>"Size of the image should be within 1MB");
							}
							// Allow certain file formats
							if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
								return array('status'=>false, 'msg'=>"Supported file types are jpg/png/jpeg/gif");
							}
							if(isset($_FILES['fileDocument']['tmp_name'][$i]) && !empty($_FILES['fileDocument']['tmp_name'][$i])){
								//$image_name = base64_encode(file_get_contents($_FILES['fileinstitutelogo']['tmp_name']));
								//$pic_name = $this->session->userdata('user_id')."1".time().".png";//$_FILES['fileinstitutelogo']['name'];
								$pic_name = $this->input->post('institutecode').md5(uniqid($user)).".".$imageFileType;//$_FILES['fileinstitutelogo']['name'];
					
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
        		$ins =  encrypt_decrypt('decrypt', $data);
        		
				$this->db->select('reg_mode,email_id');
				$this->db->from('applicant_reg_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program_code);
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
				$this->db->from('payment_mode_setup P');
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
				$this->db->from('program_master');
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
				$this->db->from('applicant_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('STATUS','1');
				$this->db->where('applied_program',$program_code);
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'deposit':
				$application_no = $this->session->userdata('appl_no');
				$this->db->select("money_deposit_mode,amount,DATE_FORMAT(depositdate,'%d-%m-%Y') AS depositdate,money_receipt_no");
				$this->db->from('applicant_form_fee_overview');
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
				$this->db->select('amount');
				$this->db->from('program_fee_setup');
				$this->db->where('category_code',$category);
				$this->db->where('program_code',$program_code);
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
						$this->db->from('applicant_form_fee_overview');
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
						$this->db->from('applicant_form_fee_overview');
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
				}
				$this->db->select('amount');
				$this->db->from('program_fee_setup');
				$this->db->where('category_code',$category);
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'pass_status':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				
				$this->db->select('category,last_grade');
				$this->db->from('applicant_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('STATUS','1');
				$this->db->where('applied_program',$program_code);
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
        		
        		$this->db->select('amount');
				$this->db->from('program_fee_setup');
				$this->db->where('category_code',$category);
				$this->db->where('program_code',$program_code);
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
					
					$this->db->select('index_no');
					$this->db->from('applicant_appl_overview');
					$this->db->where('appl_no',$application_no);
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach($output_data as $row)
					{
						$index_no = $row['index_no'];
					}
					$index = $index_no;
					$sequence_no = 0;
					if($index == '')
					{
						$this->db->select('A.program_code,A.year,A.sequence_code,sequence_no');
						$this->db->from('index_sequence_setup A');
						$this->db->where('A.program_code',$program_code);
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row)
						{
							$year = $row['year'];
							$sequence_no = $row['sequence_no'];
							$key = $row['sequence_code'];
						}
						$year_str = substr($year,'-2');
						if($sequence_no < 10)
							$changed_sl_no = '00'.$sequence_no;
						else if($sequence_no < 100)
							$changed_sl_no = '0'.$sequence_no;
						else
							$changed_sl_no = $sequence_no;
							
						$index_no = $year_str.'/'.$key.'/'.$changed_sl_no;
					}
					
					
					$this->db->trans_start();
					$dbstatus = TRUE;
					$dbmessage = 'Data saved successfully';
					
					$this->db->select('COUNT(appl_no) AS appl_no');
					$this->db->from('applicant_form_fee_overview');
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
		           	 $this->db->update("applicant_form_fee_overview",$update_data); 
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
			            $this->db->insert("applicant_form_fee_overview",$new_data); 
			            if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting';
						}
					}
					
		            $update_data = array(
		                    'appl_status' =>'Verified',
		                    'index_no' =>$index_no,
		                    'updated_by' => $reg_user_id,
		                    'updated_on' => $date
		               	);
		            $this->db->where('appl_no',$application_no);   	
		            $update = $this->db->update("applicant_appl_overview",$update_data); 	
		            if(!$update)
					{
						$dbStatus = FALSE;
						$dbMessage = 'Error updating';
					}
					
					$new_data = array(
		                    'id' =>'NULL',
		                    'appl_no' =>$application_no,
		                    'form_no' =>$application_no,
		                    'applied_program' =>$program_code,
		                    'appl_status' => 'Verified',
		                    'reg_user_id' => $reg_user_id,
		                    'created_by' => $reg_user_id,
		                    'created_on' => $date
		               	);
		            $this->db->insert("applicant_appl_overview_history",$new_data); 	
					if($this->db->affected_rows() == 0)
					{
						$dbStatus = FALSE;
						$dbMessage = 'Error inserting';
					}
					$new_seq_no = $sequence_no + 1;
					
					if($index == '')
					{
						$update_data = array(
		                    'sequence_no' =>$new_seq_no
		               	);
			            $this->db->where('program_code',$program_code);   	
			            $update = $this->db->update("index_sequence_setup",$update_data);
			            if(!$update)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error updating';
						} 	
					}
					
					$this->db->select("A.template_code,B.file_name,B.template_name"); 	
		            $this->db->from("program_master A"); 	
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
					}
					//$objMpdf = new Mpdf_controller();
					$controllerInstance = & get_instance();
					
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
			            $this->db->from("applicant_form_fee_overview"); 	
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
					            $this->db->insert("applicant_form_fee_overview",$update_data); 	
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
					            $this->db->insert("applicant_form_fee_overview",$new_data); 	
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
			            $this->db->from("program_master A"); 	
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
						$this->db->from('applicant_form_fee_overview');
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
								$sql = $this->db->update('applicant_form_fee_overview', $update_data);
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
								$sql = $this->db->insert('applicant_form_fee_overview', $new_data);
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
			            $this->db->from("program_master A"); 	
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
				return array('status' => $dbstatus, 'msg' =>$dbmessage);
			break;
			
			default :
            	return array('status' => FALSE, 'msg' =>'Unable to load.Contact Support');
			
        }
    }
}
