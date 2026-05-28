<?php

class Apply_model extends CI_model {

   // private $role;
	
    function __construct() {
        parent::__construct();
        $this->load->helper('date');

        if (ENVIRONMENT == 'development') {
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
	public function log_detail_record($page_url, $log_status, $log_message, $ip_address){
    	date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s', now());
		$reg_user_id = $this->session->userdata('reg_user_id');
		
		$new_array = array( 
			"page_url"  	=>$page_url,
			"log_status"  	=>$log_status,
			"log_message"  	=>$log_message,
			"ip_address"  	=>$ip_address,
			"user_id" 		=>$reg_user_id,
			"log_datetime" 	=>$date
		);
		$sql = $this->db->insert('db_log',$new_array);
		if(!$sql){
			$dbStatus = "ERROR";
			$dbMessage = "Error Inserting";
		}
	} 
    public function decodepostdata($data)
    {
		$encoded = $data;   // <-- encoded string from the request
		$decoded = "";
		for( $i = 0; $i < strlen($encoded); $i++ ) {
		    $b = ord($encoded[$i]);
		    $a = $b ^ 123;  // <-- must be same number used to encode the character
		    $decoded .= chr($a);
		}
		return $decoded;
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
				$this->db->where('ins.institute_code',$ins);
				//print_r($query);
				$result = $this->db->get();
				//print_r($result);
				/*echo $this->db->last_query();
				die();*/
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
				$program = $this->session->userdata('admcode');
				if($program == '' || $program == null)
				{
					$program = $data;
				}
				$this->db->select('p.*');
				$this->db->from('program_master as p');
				$this->db->where('p.program_code',$program);
				//print_r($query);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
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
			case 'logout_all_system':
				$txtPhoneNo=$this->input->post('txtPhoneNo');
				if(strpos($txtPhoneNo, '@') !== false)
				{
					$txtPhoneNo1 = explode('@',$txtPhoneNo);
					$txtPhoneNo = $txtPhoneNo1[0];
				}
				
				$page_url = $_SERVER["HTTP_REFERER"];
				$ip_address = $_SERVER['REMOTE_ADDR'];
				
				$new_array = array( 
					"page_url"  	=>$page_url,
					"log_status"  	=>"Logged Out",
					"log_message"  	=>"Logout Successfully",
					"ip_address"  	=>$ip_address,
					"user_id" 		=>$txtPhoneNo,
					"log_datetime" 	=>$date
				);
				$sql = $this->db->insert('db_log',$new_array);
				if(!$sql){
					$dbStatus = "ERROR";
					$dbMessage = "Error Inserting";
				}
				
				
				$update_data=array('record_status'=>0,'log_status'=>'logout');
				$this->db->where('login_id',$txtPhoneNo);
				$this->db->where('record_status',1);			
				$output = $this->db->update('login_detail',$update_data);
				
				return $output;
			break;
			case 'get_user_check':
				$num_rows=0;
				$this->db->select('*');
				$this->db->from('login_detail');
				$this->db->where('login_id',$this->session->userdata('reg_user_id'));
				$this->db->where('sess_id',$this->session->userdata('sess_id'));
				$this->db->where('record_status',1);
				$this->db->where('log_status','login');
				$get_result=$this->db->get();
				$num_rows=$get_result->num_rows();
				return $num_rows;
			break;
			case 'get_institute_data':
				$ins =  encrypt_decrypt('decrypt', $data);
				if($ins == '0') 
					$ins = '';
				$this->db->select('institute_code,institute_name,image_url,program_view_structure');
				$this->db->from('institute_master as ins');
				$this->db->where('ins.institute_code',$ins);
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//print_r($result->result_array());
				return $result->result_array();
			break;
			case 'get_course_detail':
			
				$program = $this->session->userdata('admcode');
				$this->db->select('course_code,course_name');
				$this->db->from('course_master');
				$this->db->where('program_code',$program);
				$this->db->where('record_status',1); 
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
	           	//return $result->result_array();
			break;
			case 'course_wise_date_eligibility':
			
				$year = '';
				$month = '';
				$date = '';
				//print_r($_SESSION);die;
				$program = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$category = $this->input->post('category');
				$physically_handicapped = $this->input->post('physically_handicapped');
				$service_man = $this->input->post('service_man');
				$no_of_year = $this->input->post('no_of_year');
				$is_exp = $this->input->post('is_exp');
				$exp_service = $this->input->post('exp_service');
				//echo "--".$exp_service;
				$eligibility = '';
				$this->db->select("DATE_FORMAT(dob,'%Y-%m-%d') AS dob");
				$this->db->from('applicant_reg_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
					$dob = $aRow['dob'];
	            }
	           // $dob = '1981-09-30';
				$course_names = array();
				$course_codes_eligib = array();
				$birth_start_date = '';
				$birth_end_date = '';
				$this->db->select("birth_start_date,birth_end_date");
				$this->db->from('program_category_eligible_date_setup');
				$this->db->where('program_code',$program);
				$this->db->where('category_code',$category); 
				$this->db->where('record_status',1);
				//$this->db->where("$dob BETWEEN eligible_start_date AND eligible_end_date");
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$output_data = $result->result_array();
				
				$count = 0;
				$eligible_date = 0; 
				foreach ($output_data as $aRow) 
	            {
	            	$count = 1;
					$birth_start_date = $aRow['birth_start_date'];
					$birth_end_date = $aRow['birth_end_date'];
	            }
	           // echo $birth_start_date;
	            if($birth_start_date != '')
	            {
					$date_arr = explode('-',$birth_start_date);
					$year = $date_arr[0];
					$month = $date_arr[1];
					$date = $date_arr[2];
				}
				/*if($category == 'GEN')
				{
					$eligible_date = 0;
				}
				else if($category == 'OBC')
				{
					$eligible_date = 3;
				}
				else if($category == 'SC' || $category == 'ST')
				{
					$eligible_date = 5;
				}*/
				//echo $service_man;
				
				/*if($service_man == 'YES')
				{
					//echo "hello";
					$service_year = 0;
					//echo $exp_service;
					$service_year_arr = explode('/',$exp_service);
					$service_year = $service_year_arr[0];
					$eligible_date = $eligible_date + 3 +$service_year;
				}*/
				/*if($physically_handicapped == 'YES')
				{
					$eligible_date = $eligible_date + 10;
				}*/
				/*if($is_exp == 'YES')
				{
					
					if($no_of_year > 0)
					{
						$eligible_date = $eligible_date + $no_of_year;
					}
				}*/
				//$eligible_date;
				
				//$year = $year - $eligible_date;
				//$eligible_start_dob = $year.'-'.$month.'-'.$date;
				//$eligible_start_dob = new DateTime($eligible_start_dob);
				$birth_start_date = new DateTime($birth_start_date);
				$birth_start_date = $birth_start_date->format("Y-m-d");
				
				$dob = new DateTime($dob);
				$dob = $dob->format("Y-m-d");
				
				$birth_end_date = new DateTime($birth_end_date);
				$birth_end_date = $birth_end_date->format("Y-m-d");
				//echo $eligible_start_dob;
				//echo $birth_start_date,'--',$birth_end_date,'--',$dob;die;
				if($birth_start_date != '' && $birth_end_date != '' )
				{
					if($dob < $birth_start_date || $dob > $birth_end_date)
					{
						$eligibility = '0';
						//die();
					}
					else
					{
						$eligibility = '1';
					}
					
				}
				else
				{
					$eligibility = '1';
				}
				//echo $eligibility;die();
				//echo '###'.$eligibility;echo 'ddd';die();
	            return array('eligibility' => $eligibility);
	            return $result->result_array();
			break;
			case 'course_wise_date_eligibility_001':
				$program = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$category = $this->input->post('category');
				$physically_handicapped = $this->input->post('physically_handicapped');
				$service_man = $this->input->post('service_man');
				$no_of_year = $this->input->post('no_of_year');
				$is_exp = $this->input->post('is_exp');
			
				$eligibility = '';
				$this->db->select("DATE_FORMAT(dob,'%Y-%m-%d') AS dob");
				$this->db->from('applicant_reg_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
					$dob = $aRow['dob'];
	            }
				$course_names = array();
				$course_codes_eligib = array();
				$birth_start_date = '';
				$birth_end_date = '';
				$this->db->select("birth_start_date,birth_end_date");
				$this->db->from('program_category_eligible_date_setup');
				$this->db->where('program_code',$program);
				$this->db->where('category_code','GEN'); 
				$this->db->where('record_status',1);
				//$this->db->where("$dob BETWEEN eligible_start_date AND eligible_end_date");
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$output_data = $result->result_array();
				$count = 0;
				$eligible_date = 0; 
				foreach ($output_data as $aRow) 
	            {
	            	$count = 1;
					$birth_start_date = $aRow['birth_start_date'];
					$birth_end_date = $aRow['birth_end_date'];
	            }
	            if($birth_start_date != '')
	            {
					$date_arr = explode('-',$birth_start_date);
					$year = $date_arr[0];
					$month = $date_arr[1];
					$date = $date_arr[2];
				}
				
				//echo $eligible_date;
				
				//$year = $year - $eligible_date;
				$eligible_start_dob = $year.'-'.$month.'-'.$date;
				/*echo $eligible_start_dob;
				die();*/ 
				if($birth_start_date != '' && $birth_end_date != '' )
				{
					if($dob < $eligible_start_dob || $dob > $birth_end_date)
					{
						$eligibility = '0';
						//die();
					}
					else
					{
						$eligibility = '1';
					}
					
				}
				else
				{
					$eligibility = '1';
				}
				
				
	            return array('eligibility' => $eligibility);
	            return $result->result_array();
			break;
			
			case 'select_graduation_course':
				$program = $this->session->userdata('admcode');
				$course_name = $this->input->post('course_name');
				$this->db->select('*');
				$this->db->from('graduation_master');
				$this->db->where('program_code',$program);
				$this->db->where('course_code',$course_name);
				$this->db->where('record_status',1);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//die();
				return $result->result_array();
			break;
			case 'select_count_experience':
				$program = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$this->db->select("COUNT(*) AS no_of_experience");
				$this->db->from('applicant_work_experience_detail');
				$this->db->where('applied_program',$program);
				$this->db->where('reg_user_id',$reg_user_id);
			
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$setup_count = $row['no_of_experience'];
	            }
	            
				//echo $this->db->last_query();
				//die();
				return $setup_count;
			break;
			case 'select_graduation_course_temp':
				
				$this->db->select('*');
				$this->db->from('graduation_master A');
				$this->db->join('applicant_qualification_detail B','A.program_code = B.applied_program AND  A.graduation_code = B.qual_desc_1','inner');
				$this->db->join('applicant_master C','B.applied_program = C.applied_program AND B.reg_user_id = C.reg_user_id','inner');
				$this->db->where('B.reg_user_id',$data[0]);
				$this->db->where('B.applied_program',$data[1]);
				$this->db->where('record_status',1);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break;
			
			case 'get_allOtherInfo':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("field_name, field_value");
				$this->db->from('applicant_other_info');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('status','1');
				$result = $this->db->get(); 
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break;
			
			
			case 'get_is_north_east':
				$reg_user_id = $this->session->userdata('reg_user_id');
				$program = $this->session->userdata('admcode');
				$this->db->select('IF(is_north_east="YES",1,0) AS is_north_east');
				$this->db->from('applicant_master');			
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program);
				$this->db->where('status',1);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break;
			
			case 'get_student_first_name':
				$reg_user_id = $this->session->userdata('reg_user_id');
				$program = $this->session->userdata('admcode');
				$this->db->select('first_name AS Name');
				$this->db->from('applicant_reg_master');			
				$this->db->where('reg_user_id',$reg_user_id);
				//$this->db->where('applied_program',$program);
				$this->db->where('status',1);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break;
			
			case 'get_program_group':
				$ins =  encrypt_decrypt('decrypt', $data);
				//echo  $ins ; die();
				if($ins == '0') 
					$ins = '';
				$this->db->distinct('program_group_code');
				$this->db->select('program_group_code,program_group_name,A.sl_no,GROUP_CONCAT(program_code) AS program_code,GROUP_CONCAT(program_name SEPARATOR "`") AS program_name');
				$this->db->from('program_group_master A');
				$this->db->join('program_master B','A.program_group_name = B.program_group','inner');
				$this->db->where('B.institute_code',$ins);
				$this->db->where('A.record_status',1);
				$this->db->group_by('A.program_group_code');
				$this->db->order_by('A.sl_no');
				$this->db->save_queries = TRUE;
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
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
				$this->db->select("IFNULL(`ap`.`record_status`,'0') AS record_status ,A.program_group,A.id,A.program_name,A.program_code,A.year,A.apply_start_date,DATE_FORMAT(A.apply_start_date,'%d/%m/%Y') AS date1, DATE_FORMAT(A.apply_end_date,'%d/%m/%Y') AS date2,A.apply_end_date,A.template_code,C.file_name,aao.appl_status,RIGHT (aao.appl_no,1) AS `B`");
				$this->db->from('program_master A');
				$this->db->join('program_group_master B','A.program_group = B.program_group_name','inner');
				$this->db->join('form_template_master C','A.template_code = C.template_code','inner');
				$this->db->join('applicant_appl_overview aao',"A.program_code = aao.applied_program AND reg_user_id = '$reg_user_id' ",'LEFT');
				$this->db->join('admitcard_published ap',"ap.appl_no = aao.appl_no",'LEFT');
				$this->db->where('A.institute_code',$ins);
				$this->db->where('A.record_status',1);
				$this->db->where('A.publish_status','YES');
				$this->db->where('A.apply_start_date<=',$now);
				$this->db->where('A.apply_end_date>=',$now);
				$this->db->order_by('A.id','desc');
				//print_r($query);
				$result = $this->db->get();
				/*echo $this->db->last_query(); die();
				die();*/
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_program_with_rank_data':
				$ins =  encrypt_decrypt('decrypt', $data);
				if($ins == '0') 
					$ins = '';
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s",now());
        		$reg_user_id = $this->session->userdata('reg_user_id');
				// echo "ins==>".$ins."<br>";
				// echo "date==>".$date."<br>";
				// echo "reg_user_id==>".$reg_user_id."<br>";
				// die;
				/*$this->db->select("IFNULL(`ap`.`record_status`, '0') AS record_status, `A`.`program_group`, `A`.`id`, `A`.`program_name`, 
								`A`.`program_code`, `A`.`year`, `A`.`apply_start_date`, DATE_FORMAT(A.apply_start_date, '%d/%m/%Y') AS date1, 
								DATE_FORMAT(A.apply_end_date, '%d/%m/%Y') AS date2, `A`.`apply_end_date`, `A`.`template_code`, `C`.`file_name`,
								ap.record_status AS admit_status,MAX(ap.round_no) AS round_no,
								SUBSTRING_INDEX(GROUP_CONCAT(IFNULL(adm_stp.admit_card_available_from,''),'@',
								IFNULL(adm_stp.admit_card_available_upto,''),'@',IFNULL(adm_stp.round,''),'@',
								IFNULL(adm_stp.template_code,''),'@',IFNULL(adm_stp.exam_center_code,''),
								'@',IFNULL(ap.assigned_exam_vanue,'') ORDER BY adm_stp.round DESC),',',1) AS admt_crd,
								`aao`.`appl_status`, RIGHT (aao.appl_no, 1) AS `B`");
				$this->db->from('program_master A');
				$this->db->join('program_group_master B','A.program_group = B.program_group_name','inner');
				$this->db->join('form_template_master C','A.template_code = C.template_code','inner');
				$this->db->join('applicant_appl_overview aao',"A.program_code = aao.applied_program AND reg_user_id = '$reg_user_id' ",'LEFT');
				$this->db->join('admitcard_published ap',"ap.appl_no = aao.appl_no",'LEFT');
				$this->db->join('admitcard_setup adm_stp',"ap.applied_program = adm_stp.program_code AND adm_stp.round = ap.round_no 
									AND adm_stp.exam_vanue_code = ap.assigned_exam_vanue AND ap.assigned_exam_center = adm_stp.exam_center_code",'LEFT');
				//$this->db->join('(SELECT arm.mobile,arm.applied_program,arm.record_status,arm.applicant_status FROM applicant_rank_master arm  WHERE arm.record_status=1 AND arm.reg_user_id = "'.$reg_user_id.'") R',"aao.reg_user_id = R.mobile AND aao.applied_program = R.applied_program",'LEFT');
				$this->db->where('A.institute_code',$ins);
				$this->db->where('A.record_status',1);
				$this->db->where('A.publish_status','YES');
				$this->db->where('A.apply_start_date<=',$now);
				$this->db->where('A.apply_end_date>=',$now);
				$this->db->group_by('ap.record_status,A.program_group,A.id,A.program_name,A.program_code,aao.appl_status,aao.appl_no');
				$this->db->order_by('A.id','desc');*/
				
				$result = $this->db->query("SELECT DISTINCT IFNULL(`ap`.`record_status`, '0') AS record_status,A.advt_no,aer.field ,usc.file_path,C.template_name,
				usc.file_name AS upload_file_name, `A`.`program_group`, `A`.`id`, `A`.`program_name`, `A`.`program_desc`,`A`.`program_code`,
				GROUP_CONCAT(IFNULL(cm.course_name, '')) AS course_name,
				 `A`.`year`, `A`.`apply_start_date`, DATE_FORMAT(A.apply_start_date, '%d/%m/%Y') AS date1, 
				 DATE_FORMAT(A.apply_end_date, '%d/%m/%Y') AS date2,`A`.`apply_end_date`, 
				 `action1`.`start_date` AS `action1_apply_start_date`, `action1`.`end_date` AS `action1_apply_end_date`, `A`.`template_code`, `C`.`file_name`,
				  ap.record_status AS admit_status,MAX(ap.round_no) AS round_no, 
				  SUBSTRING_INDEX(GROUP_CONCAT(IFNULL(adm_stp.admit_card_available_from, ''), '@', 
				  IFNULL(adm_stp.admit_card_available_upto, ''), '@', IFNULL(adm_stp.round, ''), '@', 
				  IFNULL(adm_stp.template_code, ''), '@', IFNULL(adm_stp.exam_center_code, ''), '@', 
				  IFNULL(ap.assigned_exam_vanue, '') 
				  ORDER BY adm_stp.round DESC), ',', 1) AS admt_crd, `aao`.`appl_status`,`aao`.`reeval_status`,`aao`.`appl_no`, 
				  RIGHT (aao.appl_no, 1) AS `B` 
				  FROM `program_master` `A` 
				  INNER JOIN `program_group_master` `B` ON `A`.`program_group` = `B`.`program_group_code` 
				  INNER JOIN `form_template_master` `C` ON `A`.`template_code` = `C`.`template_code` 
				  LEFT JOIN `applicant_appl_overview` `aao` ON `A`.`program_code` = `aao`.`applied_program` AND reg_user_id = '$reg_user_id' 
				  LEFT JOIN `admitcard_published` `ap` ON `ap`.`appl_no` = `aao`.`appl_no` AND `ap`. `applied_program` = `aao`.`applied_program`
				  LEFT JOIN `applicant_exam_result` `aer` ON `ap`.`omr_no` = `aer`.`applicant_id` AND `ap`. `applied_program` = `aer`.`program_code` AND ap.round_no = aer.round_no
				  LEFT JOIN `upload_scanned_copies` `usc` ON `ap`.`omr_no` = `usc`.`roll_no` AND `ap`. `appl_no` = `usc`.`appl_no` AND ap.round_no = aer.round_no
				  LEFT JOIN admitcard_setup `adm_stp` ON ap.applied_program = adm_stp.program_code AND adm_stp.round = ap.round_no AND adm_stp.exam_vanue_code = ap.assigned_exam_vanue 
				   AND ap.assigned_exam_center = adm_stp.exam_center_code
				  LEFT JOIN course_master cm ON cm.program_code = A.program_code
				  LEFT JOIN (SELECT * FROM action_master WHERE action_name='Apply date' AND record_status=1) AS action1 ON `action1`.`Program_code` = `A`.`program_code`
				   WHERE `A`.`institute_code` = '$ins '
				   AND `A`.`record_status` = 1 AND `A`.`publish_status` = 'YES' 
				   AND `A`.`program_start_date` <= '$date'
				   AND `A`.`program_end_date` >= '$date '
				   GROUP BY ap.record_status,A.program_group,A.id,A.program_name,A.program_code,aao.appl_status,aao.appl_no,aer.field,usc.file_path,usc.file_name,C.template_name 
				ORDER BY `A`.`id` ASC");
				//print_r($query);
				//$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				//print_r($result);
				return $result->result_array();
			break;  
			case 'get_old_post_applied': 
				$reg_user_id = $this->session->userdata("reg_user_id");
				$this->db->select("am.dob,am.gender,am.is_reserved_quota,am.category,aao.fillup_status,program_name, pm.program_code,pm.apply_start_date,pm.apply_end_date, DATE_FORMAT(aao.updated_on,'%d-%m-%Y') AS applied_date, amount, aao.appl_status,
				 adm_stp.admit_card_available_from, adm_stp.admit_card_available_upto, ap.record_status AS admit_status,adm_stp.template_code,adm_stp.exam_center_code,ap.assigned_exam_vanue");
				$this->db->from("applicant_appl_overview aao");
				$this->db->join("applicant_master am", "aao.reg_user_id = am.reg_user_id AND aao.applied_program = am.applied_program", "LEFT");
				$this->db->join("applicant_form_fee_overview affo", "aao.appl_no = affo.appl_no", "LEFT");
				$this->db->join("program_master pm", "aao.applied_program = pm.program_code", "LEFT");
				$this->db->join("admitcard_published ap", "ap.appl_no = aao.appl_no AND ap.applied_program = aao.applied_program", "LEFT");
				$this->db->join("admitcard_setup adm_stp", "ap.applied_program = adm_stp.program_code AND adm_stp.round = ap.round_no AND adm_stp.exam_vanue_code = ap.assigned_exam_vanue  AND ap.assigned_exam_center = adm_stp.exam_center_code", "LEFT");
				
				$this->db->where("aao.reg_user_id", $reg_user_id);
				$get_arr = $this->db->get();
				//echo $this->db->last_query();die(); 
				return $get_arr->result_array();
			break;
			case 'get_program_wise_status':
				$ins =  encrypt_decrypt('decrypt', $data);
				if($ins == '0') 
					$ins = '';
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s",now());
        		$reg_user_id = $this->session->userdata('reg_user_id');
				$this->db->select('applied_program');
				$this->db->from('applicant_appl_overview A');
				$this->db->join('program_master B','A.applied_program = B.program_code','INNER');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->order_by('A.created_on');
				//print_r($query);
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			
			case 'get_program_detail':
				$program_code = $data;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select('A.program_group,D.program_group_name,A.id,A.program_name,A.program_code,A.year,A.apply_start_date,A.apply_end_date,A.template_code,C.file_name,C.template_name');
				$this->db->from('program_master A');
				$this->db->join('form_template_master C','A.template_code = C.template_code','inner');
				$this->db->join('program_group_master D','A.program_group = D.program_group_code','inner');//lina V1
				$this->db->where('A.program_code',$program_code);
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
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
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("applied_program,reg_user_id,dob,first_name,mid_name,last_name,email_id,state,state_name");
				$this->db->from('applicant_reg_master');
				$this->db->join('state_master','state_master.state_code = applicant_reg_master.state','left');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('status',1);
				//print_r($query);
				$result = $this->db->get();
				$query = $result->result_array();
				//$count = $result->num_rows();
				foreach($query as $aRow){
					$applied_program = $aRow['applied_program'];
				}
				//$this->session->unset_userdata('admcode');
				//$this->session->set_userdata('admcode', $applied_program);
				/*echo $this->db->last_query();
				die();*/
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_application_data_temp':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("appl_status");
				$this->db->from('applicant_details_temp');
				$this->db->where('program_code',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$query = $result->result_array();
				foreach($query as $aRow){
					$appl_status = $aRow['appl_status'];
				}
				return $result->result_array();
			break;
			case 'get_application_data':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("appl_no,index_no,appl_status,reeval_status");
				$this->db->from('applicant_appl_overview');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				//print_r($query);
				//$result = $this->db->get();
				
				$result = $this->db->get();  //echo $this->db->last_query();die();
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
			
			case 'get_post':
			$program_code = $data;
			$reg_user_id = $this->session->userdata('reg_user_id');
			$inst_code = $this->session->userdata('institute_code');
			date_default_timezone_set('Asia/Kolkata');
			$date = date('Y-m-d', now());
			$this->db->select("course_code");
			$this->db->from('course_details');
			$this->db->where('inst_code',$inst_code);
			$this->db->where('prog_code',$program_code);
			$this->db->where('reg_user_id',$reg_user_id);
			$this->db->where('record_status','1');
			$result = $this->db->get();
			//echo $this->db->last_query();die();
			return $result->result_array();
			break;
			//********************************************************* Data to show in the template *******************************//
			case 'get_applicant_data_temp': 
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("*");
				$this->db->from('applicant_details_temp');
				$this->db->where('program_code',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('status','1');
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_profile_details':
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("*");
				$this->db->from('applicant_reg_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('status','1');
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_applicant_data':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("*,DATE_FORMAT(dob,'%d-%m-%Y') AS dob1,CASE WHEN comm_address_ref_id = perm_address_ref_id THEN 'Y' ELSE 'N' END AS addresscheck");
				$this->db->from('applicant_master');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('status','1');
				$result = $this->db->get(); 
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break;
			
			case 'get_present_communication_data':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("applicant_address.*");
				$this->db->from('applicant_address');
				$this->db->join('applicant_master','applicant_address.address_ref_id = applicant_master.comm_address_ref_id','left');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				// echo $this->db->last_query();
				// die();
				return $result->result_array();
			break;
			case 'get_permanent_communication_data':
				$program_code = $data;
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
			case 'get_dc_data':
				$program_code = $data;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.dc_code, A.dc_name");
				$this->db->from('dc_master A');
				$this->db->join('program_dc_setup B','A.dc_code = B.dc_code','inner');
				$this->db->where('B.program_code',$program_code);
				/*$this->db->where('A.category_code!=','GEN');*/
				$this->db->where('B.record_status',1);
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_father_data':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("rel_name,rel_qualification, rel_occupation, rel_desig, nature_of_work,annual_income, place_work, email_id, res_no, mobile_no");
				$this->db->from('applicant_relation');
				$this->db->join('applicant_master','applicant_relation.reg_user_id=applicant_master.reg_user_id','left');
				$this->db->where('applicant_rel_flag','1');
				$this->db->where('applicant_relation.applied_program',$program_code);
				$this->db->where('applicant_relation.reg_user_id',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();
				return $result->result_array();
			break;
			case 'get_mother_data':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("rel_name,rel_qualification,rel_occupation, rel_desig, nature_of_work,annual_income, place_work, email_id, res_no, mobile_no");
				$this->db->from('applicant_relation');
				$this->db->join('applicant_master','applicant_relation.reg_user_id=applicant_master.reg_user_id','left');
				$this->db->where('applicant_rel_flag','2');
				$this->db->where('applicant_relation.applied_program',$program_code);
				$this->db->where('applicant_relation.reg_user_id',$reg_user_id);
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_guardian_data':
				$program_code = $data;
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
			case 'get_academic_qual_data_temp':
				//$program_code = $this->session->userdata('admcode');
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("*");
				$this->db->from('applicant_qual_temp');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->order_by('applicant_qual_temp.id');
				$result = $this->db->get();
				//echo $this->db->last_query();
				return $result->result_array();
			break;
			case 'get_program_experience':
				//$program_code = $this->session->userdata('admcode');
				$program_code = $data;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("*");
				$this->db->from('program_wise_exp_validation');
				$this->db->where('program_code',$program_code);
				$this->db->where('program_wise_exp_validation.record_status',1);
				$this->db->order_by('program_wise_exp_validation.id');
				$result = $this->db->get();
				//echo $this->db->last_query();
				return $result->result_array();
			break;
			case 'get_program_applicant_experience':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("*");
				$this->db->from('applicant_postwise_experience');
				$this->db->join('program_wise_exp_validation','applicant_postwise_experience.experience_code = program_wise_exp_validation.experience_code','left');
				$this->db->where('program_wise_exp_validation.record_status',1);
				$this->db->where('applicant_postwise_experience.program_code',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->order_by('applicant_postwise_experience.sl_no');
				$result = $this->db->get();
				//echo $this->db->last_query();
				return $result->result_array();
			break;
			case 'get_academic_qual_data':
				//$program_code = $this->session->userdata('admcode');
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("qual_desc_1,qual_desc_2,other_stream,applicant_qualification_detail.honours_subject,grade,year_of_passing,university_board,division_distinction,mark_secured,full_mark,percentage_mark,applicant_qualification_detail.duration,applicant_qualification_detail.course");
				$this->db->from('applicant_qualification_detail');
				$this->db->join('applicant_master','applicant_master.applied_program = applicant_qualification_detail.applied_program AND applicant_master.reg_user_id = applicant_qualification_detail.reg_user_id','inner');
				$this->db->where('applicant_master.applied_program',$program_code);
				$this->db->where('applicant_master.reg_user_id',$reg_user_id);
				$this->db->order_by('applicant_qualification_detail.id');
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				return $result->result_array();
			break;
			///course
			case 'select_course_SRSEC':
				//$program_code = $this->session->userdata('admcode');
				$program_code = $this->input->post('programcode');
				$txtqual22 = $this->input->post('txtqual22');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("course_name");
				$this->db->from('program_qual_degree_course_mapping A');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.qualification','SRSEC');
				$this->db->where('A.degree_name',$txtqual22);
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.course_name');
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				return $result->result_array();
			break;
			
			case 'select_course_GRADUTION':
				//$program_code = $this->session->userdata('admcode');
				$program_code = $this->input->post('programcode');
				$txtqual23 = $this->input->post('txtqual23');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("course_name");
				$this->db->from('program_qual_degree_course_mapping A');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.qualification','GRADUTION');
				$this->db->where('A.degree_name',$txtqual23);
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.course_name');
				$result = $this->db->get();
				//echo 1, $this->db->last_query();die();
				return $result->result_array();
			break;
			
			case 'select_course_PG':
				//$program_code = $this->session->userdata('admcode');
				$program_code = $this->input->post('programcode');
				$txtqual24 = $this->input->post('txtqual24');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("course_name");
				$this->db->from('program_qual_degree_course_mapping A');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.qualification','PG');
				$this->db->where('A.degree_name',$txtqual24);
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.course_name');
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				return $result->result_array();
			break;
			////end of course
			case 'get_center_preference':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		if($this->input->post('preference1')){
					$this->db->where('ecm.exam_centre_code!=',$this->input->post('preference1'));
				}
        		if($this->input->post('preference2')){
					$this->db->where('ecm.exam_centre_code!=',$this->input->post('preference2'));
				}
				$this->db->select("ec.exam_centre_code,ec.exam_centre_name,ec.id");
				$this->db->from('exam_centre ec');
				$this->db->join('exam_centre_master ecm','ec.exam_centre_code = ecm.exam_centre_code','inner');
				$this->db->where('ecm.program_code',$program_code);
				$this->db->where('ec.record_status',1);
				$this->db->order_by('ec.id');
				$result = $this->db->get();
			    //echo $this->db->last_query();
				
				return $result->result_array();
			break;
			case 'get_center_preference_south':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		if($this->input->post('preference1')){
					$this->db->where('centre_code!=',$this->input->post('preference1'));
				}
        		if($this->input->post('preference2')){
					$this->db->where('centre_code!=',$this->input->post('preference2'));
				}
				$this->db->select("centre_code,centre_name,id");
				$this->db->from('south_centre_master');
				$this->db->where('record_status',1);
				$this->db->where('program_code',$program_code);
				$this->db->order_by('centre_code');
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_center_preference_common':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		if($this->input->post('preference1')){
					$this->db->where('centre_code!=',$this->input->post('preference1'));
				}
        		if($this->input->post('preference2')){
					$this->db->where('centre_code!=',$this->input->post('preference2'));
				}
				$this->db->select("centre_code,centre_name,id");
				$this->db->from('common_centre_master');
				$this->db->where('record_status',1);
				$this->db->where('program_code',$program_code);
				$this->db->order_by('centre_code');
				$result = $this->db->get();
				//echo $this->db->last_query();
				return $result->result_array();
			break;
			
			//****************************************************************************************************// 
			
			case 'get_documents_required':
				$program_code = $data;
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
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.qualification_code, B.qualification_name, B.division,A.program_code");
				$this->db->from('program_qualification_setup A');
				$this->db->join('qualification_master B','A.qualification_code = B.qualification_code','inner');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.record_status',1);
				$this->db->where('B.record_status',1);
				$this->db->order_by('B.id');
				
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//die();
				//print_r($result);
				return $result->result_array();
			break;
			
			case 'get_SRSEC_COURSE_data':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.course_name");
				$this->db->from('program_qual_degree_course_mapping A');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.qualification','SRSEC');
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.course_name');
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'get_GRADUTION_COURSE_data':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.course_name");
				$this->db->from('program_qual_degree_course_mapping A');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.qualification','GRADUTION');
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.course_name');
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'get_PG_COURSE_data':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.course_name");
				$this->db->from('program_qual_degree_course_mapping A');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.qualification','PG');
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.course_name');
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'get_DECLARATION_data':
				$program_code = $data;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("declaration");
				$this->db->from('program_declaration_data A');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.record_status',1);
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'get_SRSEC_degree_data':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.degree_name");
				$this->db->from('program_qual_degree_mapping A');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.qualification_code','SRSEC');
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.degree_name');
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'get_GRADUTION_degree_data':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.degree_name");
				$this->db->from('program_qual_degree_mapping A');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.qualification_code','GRADUTION');
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.degree_name');
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'get_PG_degree_data':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.degree_name");
				$this->db->from('program_qual_degree_mapping A');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.qualification_code','PG');
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.degree_name');
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'get_examcentercheck_data':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.exam_centre_code,A.exam_centre_name");
				$this->db->from('exam_centre_master A');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.record_status',1);
				$result = $this->db->get();
				return $result->result_array();
			break;
				
			case 'total_experience_data':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("total_experience_1");
				$this->db->from('applicant_total_experience A');
				
				$this->db->where('A.applied_program',$program_code);
				$this->db->where('A.reg_user_id',$reg_user_id);
			
				//$this->db->order_by('B.id');
				
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
			case 'get_highest_qualification':
				$program_code = $data;
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
			case 'get_challandetails':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("challan_code, bank_name, challan_path");
				$this->db->from('challan_detail');
				$this->db->where('appl_no',$application_no);
				$this->db->where('status','1');
				//$this->db->order_by('id');
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
			case 'get_id_proof':
				$ins =  encrypt_decrypt('decrypt', $data);
				
			
				$this->db->select('id_proof_code,id_proof_name');
				$this->db->from('id_proof_master');
				$this->db->where('record_status',1);
				$this->db->save_queries = TRUE;
				$result = $this->db->get();
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
				$this->db->where('record_status',1);
				$this->db->order_by('religion_name');
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
			case 'get_home_district_data':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$reg_user_id = $this->session->userdata('reg_user_id');
				$this->db->select("A.district_code,district_name");
				$this->db->from('district_master A');
				$this->db->join('applicant_reg_master B','A.state_code = B.state','inner');
				$this->db->where('B.reg_user_id',$reg_user_id);
				/*$this->db->where('A.category_code!=','GEN');*/
				/*$this->db->where('B.record_status',1);*/
				//print_r($query);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
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
				$program_code = $data;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.category_code, A.category_name");
				$this->db->from('category_master A');
				$this->db->join('program_category_setup B','A.category_code = B.category_code','inner');
				$this->db->where('B.program_code',$program_code);
				/*$this->db->where('A.category_code!=','GEN');*/
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
			
			case 'send_pro_otp':
				$dbstatus = 'SUCCESS';
				$dbmessage = "OTP sent successfully";
				$program = $this->session->userdata('admcode');
				$txtMobileNo = isset($_POST['txtCandidatePhone1'])?$_POST['txtCandidatePhone1']:'';
				$txtEmail =isset($_POST['txtEmail'])?$_POST['txtEmail']:'';
				$insCode =$this->session->userdata('institute_code');
				$txtFirstName =isset($_POST['txtFirstName'])?$_POST['txtFirstName']:'';
				$txtMiddleName =isset($_POST['txtMiddleName'])?$_POST['txtMiddleName']:'';
				$txtLastName =isset($_POST['txtLastName'])?$_POST['txtLastName']:'';
				$full_name = $txtFirstName." ".$txtMiddleName." ".$txtLastName;
				$name = $txtFirstName;
				$phone_no = $txtMobileNo; 
				$email = $txtEmail;
				$chars = "123456789";
				$otp = substr( str_shuffle( $chars ), 0, 4 );
				
				//$otp = '1234';
				$this->session->set_userdata('otp', $otp);
				//$name = $first_name.' '.$middle_name.' '.$last_name;
						// echo $name;die;
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
				$this->db->from('email_setup es');/*
				$this->db->join('program_email_setup pes','es.email_type = pes.email_type','inner');*/
				$this->db->where('es.email_type','SEND_OTP');
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
				if($row_count > 0)
				{
					/*if($email != '')
					{ 
						require(APPPATH . 'libraries/PHPMailer/class.phpmailer.php');
						$mail = new PHPMailer();
						//Tell PHPMailer to use SMTP
						$mail->isSMTP(TRUE);
						$mail->Mailer = "smtp";


						//Enable SMTP debugging
						// 0 = off (for production use)
						// 1 = client messages
						// 2 = client and server messages
						$mail->SMTPDebug = 0;

						//Ask for HTML-friendly debug output
						$mail->Debugoutput = 'html';

						//Set the hostname of the mail server
						$mail->Host = $host_name;

						//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
						$mail->Port = $port_no; //25, 465 or 587 

						//Set the encryption system to use - ssl (deprecated) or tls
						//$mail->SMTPSecure = 'ssl';
						$mail->SMTPSecure = false; // this is for NIC SERVER
						$mail->SMTPAutoTLS = false;// this is for NIC SERVER
						//Whether to use SMTP authentication
						//$mail->SMTPAuth = true;// this is for NIC SERVER


						//Username to use for SMTP authentication - use full email address for gmail
						$mail->Username = $email_id;

						//Password to use for SMTP authentication
						$mail->Password = $password;

						//Set who the message is to be sent from
						$mail->setFrom($email_id);

						
						//Set who the message is to be sent to
						$address = $email;
						$mail->AddAddress($address);
						
						
							
						$mail->Subject = $subject;
						//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
						$find = array("[name]","[otp]");
						$replace = array($full_name,$otp);
						$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url
						//$email_content = $content;
						//$this->email->message($email_content);
						$mail->MsgHTML($email_content);
						
						if(!$mail->Send())
						{
							$dbstatus = FALSE; 
						    $dbMessage = 'Unable to sent Mail.Please Contact for Support';
						}
						else
						{
							$dbstatus = true; 
						    $dbMessage = 'A mail is forwarded to your registered mail id  ';
						}
					    
					} */
					if($email != '')
					{
						
						$this->load->library('email');
						$content="Dear $full_name, You have registered successfully. $otp is your One time password for verification.";
						$content=$content;
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
						$this->email->from($email_id, 'CMSS Recruitment Portal');
						$this->email->to($email); 

						$this->email->subject($subject);
						$find = array("[otp]");
						$replace = array($otp);
						$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url

						$this->email->message($email_content);

						$this->email->send();

						
						if($this->email->send()){
						    $dbStatus = TRUE; 
						    $dbMessage = 'A mail is forwarded to your registered mail id  ';
					    }
					    else{
						    $dbStatus = FALSE; 
						    $dbMessage = 'Unable to sent Mail.Please Contact for Support';
					    }								    
					}
					
				}
				//echo"dfd";
				$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
				$this->db->from('sms_provider_setup A');
				$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
				$this->db->where('B.record_status','1');
				$this->db->where('A.record_status','1');
				$this->db->where('B.sms_type','SEND_OTP');
				$this->db->where('B.status','ACTIVE');
				$result = $this->db->get();
				//ECHO $this->db->last_query(); 
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
					$findappl = array("[name]","[otp]");
					$replaceappl = array($name,$otp);
					//echo $content."<br>";
					$new_content = str_replace($findappl, $replaceappl, $content);
					$messageToSend = rawurlencode($new_content);
					//echo $new_sms_url."<br>";
					//echo $new_content."<br>";
					//echo $messageToSend; 
					
					//find replace url with mobileno and message
					$findmobileNo = array("[mobileno]","[message]","[username]","[password]","[sender]");
					$replacemobileNo = array($phone_no,$messageToSend,$user_name,$password,$sender);
					$smsURL = str_replace($findmobileNo,$replacemobileNo,$sms_url);	
		        }
		        //echo $smsURL;
		     	$ch = curl_init($smsURL);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				$result = curl_exec($ch);
				curl_close($ch);
		      //  die();  
				//echo $smsURL;
				//$done = file_get_contents($smsURL);
				//print_r($done);die();
				/*$arrContextOptions=array(
				    "ssl"=>array(
				        "verify_peer"=>false,
				        "verify_peer_name"=>false,
				    ),
				); */ 

				//$response = file_get_contents($smsURL, false, stream_context_create($arrContextOptions));
				
				return array('status' => $dbstatus, 'msg' => $dbmessage,'otp' => $otp);
				//return array('status' => $dbstatus, 'msg' => $dbmessage);
				
			break;
			case 'send_pro_otp_login':
				$dbstatus = 'SUCCESS';
				$dbmessage = "OTP sent successfully";
				$program = $this->session->userdata('admcode');
				$txtMobileNo = isset($_POST['txtCandidatePhone'])?$_POST['txtCandidatePhone']:'';
				
				$phone_no = $txtMobileNo; 
				//$email = $txtEmail;
				$chars = "123456789";
				$otp = substr( str_shuffle( $chars ), 0, 4 );
				
				$otp = '1234';
				$this->session->set_userdata('otp', $otp);
				
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
				$this->db->from('email_setup es');/*
				$this->db->join('program_email_setup pes','es.email_type = pes.email_type','inner');*/
				$this->db->where('es.email_type','SEND_OTP');
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
				if($row_count > 0)
				{
					/*if($email != '')
					{ 
						require(APPPATH . 'libraries/PHPMailer/class.phpmailer.php');
						$mail = new PHPMailer();
						//Tell PHPMailer to use SMTP
						$mail->isSMTP(TRUE);
						$mail->Mailer = "smtp";


						//Enable SMTP debugging
						// 0 = off (for production use)
						// 1 = client messages
						// 2 = client and server messages
						$mail->SMTPDebug = 0;

						//Ask for HTML-friendly debug output
						$mail->Debugoutput = 'html';

						//Set the hostname of the mail server
						$mail->Host = $host_name;

						//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
						$mail->Port = $port_no; //25, 465 or 587 

						//Set the encryption system to use - ssl (deprecated) or tls
						//$mail->SMTPSecure = 'ssl';
						$mail->SMTPSecure = false; // this is for NIC SERVER
						$mail->SMTPAutoTLS = false;// this is for NIC SERVER
						//Whether to use SMTP authentication
						//$mail->SMTPAuth = true;// this is for NIC SERVER


						//Username to use for SMTP authentication - use full email address for gmail
						$mail->Username = $email_id;

						//Password to use for SMTP authentication
						$mail->Password = $password;

						//Set who the message is to be sent from
						$mail->setFrom($email_id);

						
						//Set who the message is to be sent to
						$address = $email;
						$mail->AddAddress($address);
						
						
							
						$mail->Subject = $subject;
						//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
						$find = array("[name]","[otp]");
						$replace = array($full_name,$otp);
						$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url
						//$email_content = $content;
						//$this->email->message($email_content);
						$mail->MsgHTML($email_content);
						
						if(!$mail->Send())
						{
							$dbstatus = FALSE; 
						    $dbMessage = 'Unable to sent Mail.Please Contact for Support';
						}
						else
						{
							$dbstatus = true; 
						    $dbMessage = 'A mail is forwarded to your registered mail id  ';
						}
					    
					} */
					
				}
				//echo"dfd";
				$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
				$this->db->from('sms_provider_setup A');
				$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
				$this->db->where('B.record_status','1');
				$this->db->where('A.record_status','1');
				$this->db->where('B.sms_type','SEND_OTP');
				$this->db->where('B.status','ACTIVE');
				$result = $this->db->get();
				//ECHO $this->db->last_query(); 
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
					$findappl = '';
					$replaceappl = '';
					//echo $content."<br>";
					$new_content = str_replace($findappl, $replaceappl, $content);
					$messageToSend = rawurlencode($new_content);
					//echo $new_sms_url."<br>";
					//echo $new_content."<br>";
					//echo $messageToSend; 
					
					//find replace url with mobileno and message
					$findmobileNo = array("[mobileno]","[message]","[username]","[password]","[sender]");
					$replacemobileNo = array($phone_no,$messageToSend,$user_name,$password,$sender);
					$smsURL = str_replace($findmobileNo,$replacemobileNo,$sms_url);	
		        }
		        //echo $smsURL;
		     	$ch = curl_init($smsURL);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				$result = curl_exec($ch);
				curl_close($ch);
		      //  die();  
				//echo $smsURL;
				//$done = file_get_contents($smsURL);
				//print_r($done);die();
				/*$arrContextOptions=array(
				    "ssl"=>array(
				        "verify_peer"=>false,
				        "verify_peer_name"=>false,
				    ),
				); */ 

				//$response = file_get_contents($smsURL, false, stream_context_create($arrContextOptions));
				
				return array('status' => $dbstatus, 'msg' => $dbmessage,'otp' => $otp);
				//return array('status' => $dbstatus, 'msg' => $dbmessage);
				
			break;
			case 'check_mobile_no':
				$dbstatus = true;
				$dbmessage = "Success";
				$mobile_no = isset($_POST['mobile_no'])?$_POST['mobile_no']:'';
				$this->db->select('count(*) AS cnt');
				$this->db->from('applicant_reg_master');
				$this->db->where('reg_user_id',$mobile_no);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$passarray =  $result->result_array();
				foreach($passarray as $row){
					$count = $row['cnt'];
				}
				
				if($count >= 1)
				{ 
					return array('status' => FALSE, 'msg' => 'You have already registered with this mobile no.');
				}
				else
				{
					return array('status' => $dbstatus, 'msg' => $dbmessage);
				}
			break;
			case 'check_email_id':
				$dbstatus = true;
				$dbmessage = "Success";
				$email_id = isset($_POST['email_id'])?$_POST['email_id']:'';
				$this->db->select('count(*) AS cnt');
				$this->db->from('applicant_reg_master');
				$this->db->where('email_id',$email_id);
				$result = $this->db->get();
				$passarray =  $result->result_array();
				foreach($passarray as $row){
					$count = $row['cnt'];
				}
				
				if($count >= 1)
				{
					return array('status' => FALSE, 'msg' => 'You have already registered with this Email Id.');
				}
				else
				{
					return array('status' => $dbstatus, 'msg' => $dbmessage);
				}
			break;
			case 'check_otp_data':
				$dbstatus = true;
				$dbmessage = "OTP sent successfully";
				$otp = $this->session->userdata('otp');
				//$otp = isset($_POST['hidOTP'])?$_POST['hidOTP']:'';
				$txtOTP = isset($_POST['txtOTP'])?$_POST['txtOTP']:'';
				if($otp != $txtOTP)
				{
					return array('status' => FALSE, 'msg' => 'You have entered incorrect OTP.');
				}
				else
				{
					return array('status' => $dbstatus, 'msg' => $dbmessage);
				}
			break;
			case 'verify_registration_otp':
				$dbstatus = true;
				$dbmessage = "OTP Verified successfully";
				$otp = $this->session->userdata('otp');
				//die();
				$reg_user_id =isset($_POST['txtCandidatePhone'])?$_POST['txtCandidatePhone']:'';
				//$otp = isset($_POST['hidOTP'])?$_POST['hidOTP']:'';
				$txtOTP = isset($_POST['txtOTP'])?$_POST['txtOTP']:'';
				//die();
				if($otp != $txtOTP)
				{
					return array('status' => 'ERROR', 'msg' => 'You have entered incorrect OTP.'); 
				}
				else
				{
						$new_data = array(
		                    'reg_status' => 'Verified',
		                    'updated_by' => $reg_user_id,
		                    'updated_on' => date('Y-m-d H:i:s', now())
		               	);
		               /*	$this->db->where('reg_user_id',$reg_user_id);
		               	$this->db->where('email_id',$email_id);*/
		               	if($reg_user_id != '')
						{
							$this->db->where('reg_user_id',$reg_user_id);
						}
						
						$regUpdate = $this->db->update('applicant_reg_master',$new_data);
					return array('status' => 'SUCCESS', 'msg' => $dbmessage);
				}
			break;
			case 'insert_registration_data':
				$dbstatus = "SUCCESS";
				$dbmessage = 'Successfully Registered';
				$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$birth_start_date = '1900-01-01';
				$birth_end_date = $date;
				$first_name =isset($_POST['txtFirstName'])?$_POST['txtFirstName']:'';
				$last_name =isset($_POST['txtLastName'])?$_POST['txtLastName']:'';
				$middle_name =isset($_POST['txtMiddleName'])?$_POST['txtMiddleName']:'';
				$phone_no =isset($_POST['txtCandidatePhone'])?$_POST['txtCandidatePhone']:'';
				$cmbState =isset($_POST['cmbState'])?$_POST['cmbState']:'';
				$reg_user_id =isset($_POST['txtCandidatePhone'])?$_POST['txtCandidatePhone']:'';
				$email =isset($_POST['txtEmail'])?$_POST['txtEmail']:'';
				$dob1 =isset($_POST['txtdob1'])?$_POST['txtdob1']:'';
				$insCode =isset($_POST['insCode'])?$_POST['insCode']:'';
				$txtPassword =isset($_POST['txtPassword'])?$_POST['txtPassword']:$_POST['txtPassword1'];
				//$txtOTP =isset($_POST['txtOTP'])?$_POST['txtOTP']:$_POST['txtOTP'];
				
				$dob_mail = date('d-m-Y', strtotime($dob1));
				$dob =date('Y-m-d', strtotime($dob1));
				$base_url =  base_url();
				
				
				$this->db->select('COUNT(reg_user_id) AS counting,reg_status');
				$this->db->from('applicant_reg_master');
				$this->db->where('reg_user_id',$phone_no);/*
				$this->db->or_where('email_id',$email);*/
				$this->db->where('institute_code',$insCode);
				$this->db->group_by('reg_status');
				$this->db->where('STATUS','1');
				$result = $this->db->get();
//				echo $this->db->last_query();die();
				$present = '';
				$query = $result->result_array();
				$reg_status = '';
				foreach($result->result_array() AS $row1)
				{
					
					$present=$row1['counting'];
					$reg_status=$row1['reg_status'];
					$status=$row1['reg_status'];
				}
				$this->db->select('website_address');
				$this->db->from('institute_master');
				$this->db->where('institute_code',$insCode);
				$result = $this->db->get();
				$query = $result->result_array();
				
				foreach($result->result_array() AS $row1)
				{
					
					$website_address = $row1['website_address'];
				}
				$app_pro = "PROG_".$insCode;
				
				if($present==0)
				{
					
					$this->db->select('COUNT(reg_user_id) AS counting');
					$this->db->from('applicant_reg_master');
					$this->db->where('email_id',$email);
					$this->db->where('institute_code',$insCode);
					$this->db->group_by('reg_status');
					$this->db->where('STATUS','1');
					
					$result = $this->db->get();
					$email_check = '0';
					$query = $result->result_array();
					foreach($result->result_array() AS $row1)
					{
						$email_check=$row1['counting'];
					}
					if($email_check==0)
					{
						
						$this->session->set_userdata('count', 0);
						$new_data = array(
		                    'first_name' =>$first_name,
		                    'mid_name' =>$middle_name,
		                    'last_name' => $last_name,
		                    'email_id' => $email,
		                    'reg_user_id' => $phone_no,
		                    'institute_code' => $insCode,
		                    'state' => $cmbState,
		                    'reg_status' => 'Pending',
		                    'dob' => $dob,
		                    'password' => $txtPassword,
		                    'applied_program' => $app_pro,
		                    'created_by' => $phone_no,
		                    'created_on' => date('Y-m-d H:i:s', now())
		               	);
						if (!$this->db->insert('applicant_reg_master', $new_data))
						{
							$dbstatus = FALSE;
							$dbmessage = 'Error occur in Registred';
						}
						$chars = "123456789";
   						//$otp = substr( str_shuffle( $chars ), 0, 4 );
						$otp = '1234';
						$this->session->set_userdata('otp', $otp);
						$name = $first_name.' '.$middle_name.' '.$last_name;
						if($dbstatus == "SUCCESS" )
						{
							
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
							//$this->db->join('program_email_setup pes','es.email_type = pes.email_type','inner');
							
							$this->db->where('es.email_type','REGISTRATION');
							
							
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
							if($row_count > 0)
							{
								
								if($email != '')
								{
									
									$this->load->library('email');
									$content="Dear $name,<br />
									Welcome to the Central Medical Services Society. The Mission of the Society is to procure high quality health sector goods in a transparent and cost-effective manner in line with the directives of the Government of India and ensure timely and un-interrupted supply of health sector goods & services for State Government and Union Territories. Before we get started, we would like to verify your mail id and create your individual password.<br /><br />

									 	You have registered successfully. $otp is your One time password for verification.<br /><br />

									 	With Thanks and Regards,<br />
									 	Central Medical Services Society (CMSS).";
									$content=$content;
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
									$this->email->from($email_id, 'CMSS Recruitment Portal');
									$this->email->to($email); 

									$this->email->subject($subject);
									$find = array("[OTP]");
									$replace = array($otp);
									// $find= array("[name]");
									// $replace = array($name);
									$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url

									$this->email->message($email_content);

									$this->email->send();

									
									if($this->email->send()){
									    $dbStatus = TRUE; 
									    $dbMessage = 'A mail is forwarded to your registered mail id  ';
								    }
								    else{
									    $dbStatus = FALSE; 
									    $dbMessage = 'Unable to sent Mail.Please Contact for Support';
								    }								    
								}
								
							}
							/*$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
							$this->db->from('sms_provider_setup A');
							$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
							$this->db->where('B.record_status','1');
							$this->db->where('A.record_status','1');
							$this->db->where('B.sms_type','REGISTRATION');
							$this->db->where('B.status','ACTIVE');
							$result = $this->db->get();*/
							/*ECHO $this->db->last_query();
							die();*/
							/*$output_data = $result->result_array();
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
								$findappl = '';
								$replaceappl = '';
								//echo $content."<br>";
								$content = 'You have successfully registered! Your OTP is '.$otp.' to verify.';
								$new_content = str_replace($findappl, $replaceappl, $content);
								$messageToSend = rawurlencode($new_content);
								//echo $new_sms_url."<br>";
								//echo $new_content."<br>";
								//echo $messageToSend;
								
								//find replace url with mobileno and message
								$findmobileNo = array("[mobileno]","[message]","[username]","[password]","[sender]");
								$replacemobileNo = array($reg_user_id,$messageToSend,$user_name,$password,$sender);
								$smsURL = str_replace($findmobileNo,$replacemobileNo,$sms_url);	
					        }*/
					        /*echo $smsURL;
					        die();*/
					     	/*$ch = curl_init($smsURL );
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							$result = curl_exec($ch);
							curl_close($ch);*/
							//echo $smsURL;
							//$done = file_get_contents($smsURL);
							//print_r($done);die();
						}
						
						$contact_no = $phone_no;
						return array('status' => $dbstatus, 'msg' => $dbmessage);
					}
					else
					{
						
						$dbstatus = FALSE;
						$dbmessage = 'You have already registered with this Email Id.';
					}
				
				}
				else if($reg_status == 'Verified')
				{
					$dbstatus = "ERROR";
					$dbmessage = 'You have already registered with this mobile no.';
					
				}
				else
				{
						$chars = "123456789";
	   					$otp = substr( str_shuffle( $chars ), 0, 4 );
						//$otp = '1234';
						$this->session->set_userdata('otp', $otp);
						$name = $first_name.' '.$middle_name.' '.$last_name;
						//echo $name;die;
							
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
							//$this->db->join('program_email_setup pes','es.email_type = pes.email_type','inner');
							
							$this->db->where('es.email_type','REGISTRATION');
							
							//$this->db->where('pes.institute_code',$insCode);
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
							if($row_count > 0)
							{
								
								if($email != '')
								{
									
									$this->load->library('email');
									$content="Dear $name, You have registered successfully. $otp is your One time password for verification.";
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
									$this->email->from($email_id, 'Registration');
									$this->email->to($email); 

									$this->email->subject($subject);
									$find = array("[name]");
									$replace = array($name);
									$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url

									$this->email->message($email_content);

									$this->email->send();

									
									if($this->email->send()){
									    $dbStatus = TRUE; 
									    $dbMessage = 'A mail is forwarded to your registered mail id  ';
								    }
								    else{
									    $dbStatus = FALSE; 
									    $dbMessage = 'Unable to sent Mail.Please Contact for Support';
								    }								    
								}
								
							}
							/*$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
							$this->db->from('sms_provider_setup A');
							$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
							$this->db->where('B.record_status','1');
							$this->db->where('A.record_status','1');
							$this->db->where('B.sms_type','REGISTRATION');
							$this->db->where('B.status','ACTIVE');
							$result = $this->db->get();*/
							/*ECHO $this->db->last_query();
							die();*/
							/*$output_data = $result->result_array();
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
								$findappl = array("[name]");
								$replaceappl = array($name);
								//echo $content."<br>";
								$content = 'You have successfully registered! Your OTP is '.$otp.' to verify.';
								$new_content = str_replace($findappl, $replaceappl, $content);
								$messageToSend = rawurlencode($new_content);
								//echo $new_sms_url."<br>";
								//echo $new_content."<br>";
								//echo $messageToSend;
								
								//find replace url with mobileno and message
								$findmobileNo = array("[mobileno]","[message]","[username]","[password]","[sender]");
								$replacemobileNo = array($reg_user_id,$messageToSend,$user_name,$password,$sender);
								$smsURL = str_replace($findmobileNo,$replacemobileNo,$sms_url);	
					        }*/
					        /*echo $smsURL;
					        die();*/
					     	/*$ch = curl_init($smsURL );
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							$result = curl_exec($ch);
							curl_close($ch);*/
						 
					$dbstatus = "ERROR1";
					$dbmessage = 'You have already registered with this mobile no Please check your Mobile and Email for OTP.';
				}
				return array('status' => $dbstatus, 'msg' => $dbmessage);
					
			break;
			case 'check_email':
				$dbstatus = "SUCCESS";
				$dbmessage = 'Successfully Registered';
				$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$email =isset($_POST['txtEmail'])?$_POST['txtEmail']:'';
        		$insCode =isset($_POST['insCode'])?$_POST['insCode']:'';
        		
        		$this->db->select('COUNT(reg_user_id) AS counting');
				$this->db->from('applicant_reg_master');
				$this->db->where('email_id',$email);
				$this->db->where('institute_code',$insCode);
				$this->db->group_by('reg_status');
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				$present = '0';
				$query = $result->result_array();
				foreach($result->result_array() AS $row1)
				{
					$present=$row1['counting'];
				}
				return array('present' => $present);
			break;
			case 'check_forgot_password_otp':
				$dbstatus = "SUCCESS";
				$dbmessage = "OTP sent successfully";
				$otp = $this->session->userdata('otp');
				/*echo $otp;die();
				$this->session->unset_userdata('otp');*/
				$txtOTP = isset($_POST['txtOTP'])?$_POST['txtOTP']:'';
				if($otp != $txtOTP)
				{
					return array('status' => FALSE, 'msg' => 'You have entered incorrect OTP.');
				}
				else
				{
					return array('status' => $dbstatus, 'msg' => $dbmessage);
				}
			break;
			case 'update_forgot_password':
				$dbstatus = "SUCCESS";
				$dbmessage = "OTP sent successfully";
				$txtPassword =isset($_POST['txtPassword2'])?$_POST['txtPassword2']:'';
				$reg_user_id =isset($_POST['hidRegUserId'])?$_POST['hidRegUserId']:'';
				$email_id =isset($_POST['hidMailId'])?$_POST['hidMailId']:'';
				$key = $this->session->userdata('key');
				$this->session->unset_userdata('key');
				//echo $txtPassword;
				//echo $reg_user_id;
				$new_data = array(
                    'password' => $txtPassword,
                    'updated_by' => $reg_user_id,
                    'updated_on' => date('Y-m-d H:i:s', now())
               	);
               /*	$this->db->where('reg_user_id',$reg_user_id);
               	$this->db->where('email_id',$email_id);*/
               	if($reg_user_id != '')
				{
					$this->db->where('reg_user_id',$reg_user_id);
				}
				if($email_id != '')
				{
					$this->db->where('email_id',$email_id);
				}
				$regUpdate = $this->db->update('applicant_reg_master',$new_data);
				/*echo $this->db->last_query();die();*/
				if(!$regUpdate){
					$dbstatus = FALSE;
					$dbmessage = 'Error occured';
				}
				return array('status' => $dbstatus, 'msg' => $dbmessage);
			break;
			case 'send_otp_data_forgot_password':
				$dbstatus = "SUCCESS";
				$dbmessage = "OTP sent successfully";
				$program = $this->session->userdata('admcode');
				$txtForgotCandidatePhone = isset($_POST['txtForgotCandidatePhone'])?$_POST['txtForgotCandidatePhone']:'';
				$txtForgotEmail =isset($_POST['txtForgotEmail'])?$_POST['txtForgotEmail']:'';
				
				$insCode =isset($_POST['insCode'])?$_POST['insCode']:'';
				
				$this->db->select('COUNT(reg_user_id) AS counting,email_id,reg_user_id');
				$this->db->from('applicant_reg_master');
				if($txtForgotCandidatePhone != '')
				{
					$this->db->where('reg_user_id',$txtForgotCandidatePhone);
				}
				if($txtForgotEmail != '')
				{
					$this->db->where('email_id',$txtForgotEmail);
				}
				
				$this->db->group_by('email_id,reg_user_id');
				/*$this->db->where('email_id',$txtForgotEmail);*/
				//$this->db->where('institute_code',$insCode);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				/*echo $this->db->last_query();die();*/
				$present = '';
				$query = $result->result_array();
				
				foreach($result->result_array() AS $row1)
				{
					$present = $row1['counting'];
					$txtForgotEmail = $row1['email_id'];
					$txtForgotCandidatePhone = $row1['reg_user_id'];
				}
				
				if($present == 0)
				{
					return array('status' => FALSE, 'msg' => 'You have entered incorrect data.');
				}
				else
				{
					$chars = "123456789";
   					$otp = substr( str_shuffle( $chars ), 0, 4 );
   					
   					
					$this->session->set_userdata('otp', $otp);
   					
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
					
					
					/*$this->db->select('es.email_type,es.subject,es.content');
					$this->db->from('email_setup es');
					$this->db->join('program_email_setup pes','es.email_type = pes.email_type','inner');
					$this->db->where('es.email_type','FORGOT_PASSWORD');
					$this->db->where('pes.institute_code',$insCode);
					$this->db->limit('1');
					$result = $this->db->get();*/
					/*ECHO $this->db->last_query();
							die();*/
					$this->db->select('es.email_type,es.subject,es.content');
					$this->db->from('email_setup es');
					$this->db->where('es.email_type','FORGOT_PASSWORD');
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
					if($row_count > 0)
					{
						if($txtForgotEmail != '')
						{
							
							$this->load->library('email');
							$content="Dear $name, You have registered successfully. $otp is your One time password for verification.";
							$content=$content;
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
							$this->email->from($email_id, 'CMSS Recruitment Portal');
							$this->email->to($txtForgotEmail); 

							$this->email->subject($subject);
							$find = array("[otp]");
							$replace = array($otp);
							$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url

							$this->email->message($email_content);

							$this->email->send();

							
							if($this->email->send()){
							    $dbStatus = TRUE; 
							    $dbMessage = 'A mail is forwarded to your registered mail id  ';
						    }
						    else{
							    $dbStatus = FALSE; 
							    $dbMessage = 'Unable to sent Mail.Please Contact for Support';
						    }								    
						}
						//echo $txtForgotEmail;die();
						/*if($txtForgotEmail != '')
						{
							$this->load->library('email');
							
							$body = "Your OTP is $otp. Please use this pin to change Password";
							$txtSubject = "OTP Received";
							
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
							$this->email->from($email_id, 'OTP');
							$this->email->to($txtForgotEmail); 

							$this->email->subject($subject);
							$find = array("[otp]");
							$replace = array($otp);
							$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url
							//$email_content = $content;
							$this->email->message($email_content);
							//$this->email->message($body);  

							//$this->email->send();

							//echo $this->email->send();die();
							if($this->email->send()){
							    $dbstatus = "SUCCESS"; 
							    $dbMessage = 'A mail is forwarded to your registered mail id  ';
						    }
						    else{
							    $dbstatus = FALSE; 
							    $dbMessage = 'Unable to sent Mail.Please Contact for Support';
						    }
						}
						if($txtForgotEmail != '')
						{
							require(APPPATH . 'libraries/PHPMailer/class.phpmailer.php');
							$mail = new PHPMailer();
							//Tell PHPMailer to use SMTP
							$mail->isSMTP(TRUE);
							$mail->Mailer = "smtp";


							//Enable SMTP debugging
							// 0 = off (for production use)
							// 1 = client messages
							// 2 = client and server messages
							$mail->SMTPDebug = 0;

							//Ask for HTML-friendly debug output
							$mail->Debugoutput = 'html';

							//Set the hostname of the mail server
							$mail->Host = $host_name;

							//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
							$mail->Port = $port_no; //25, 465 or 587 

							//Set the encryption system to use - ssl (deprecated) or tls
							//$mail->SMTPSecure = 'ssl';
							$mail->SMTPSecure = false; // this is for NIC SERVER
							$mail->SMTPAutoTLS = false;// this is for NIC SERVER
							//Whether to use SMTP authentication
							//$mail->SMTPAuth = true;// this is for NIC SERVER


							//Username to use for SMTP authentication - use full email address for gmail
							$mail->Username = $email_id;

							//Password to use for SMTP authentication
							$mail->Password = $password;

							//Set who the message is to be sent from
							$mail->setFrom($email_id);

							
							//Set who the message is to be sent to
							$address = $txtForgotEmail;
							$mail->AddAddress($address);
							
							
								
							$mail->Subject = $subject;
							//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
							$find = array("[otp]");
							$replace = array($otp);
							$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url
							//$email_content = $content;
							//$this->email->message($email_content);
							$mail->MsgHTML($email_content);
							//echo $email_content;
							if(!$mail->Send())
							{
								$dbstatus = FALSE; 
							    $dbMessage = 'Unable to sent Mail.Please Contact for Support';
							}
							else
							{
								$dbstatus = "SUCCESS"; 
							    $dbMessage = 'A mail is forwarded to your registered mail id  ';
							}
							
						}*/
						
					}
					
					$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
					$this->db->from('sms_provider_setup A');
					$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
					$this->db->where('B.record_status','1');
					$this->db->where('A.record_status','1');
					$this->db->where('B.sms_type','FORGOT_PASSWORD');
					$this->db->where('B.status','ACTIVE');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $row1) 
			        {
			        	$sms_url = $row1['sms_url'];
						$user_name = $row1['user_name'];
						$password = $row1['password'];
						$sender = $row1['sender'];
						$content = $row1['content'];
						$find = array("[mobile_no]", "[subject]");
						$replace = array($txtForgotCandidatePhone, $content);
						$new_sms_url = str_replace($find, $replace, $sms_url);//find and replace uid and pwd in url
						$findappl = array("[phone_no]", "[otp]");
						$replaceappl = array($txtForgotCandidatePhone,$otp);
						$new_content = str_replace($findappl, $replaceappl, $content);
						$messageToSend = rawurlencode($new_content);
						
						//find replace url with mobileno and message
						$findmobileNo = array("[mobileno]","[message]","[username]","[password]","[sender]");
						$replacemobileNo = array($txtForgotCandidatePhone,$messageToSend,$user_name,$password,$sender);
						$smsURL = str_replace($findmobileNo,$replacemobileNo,$sms_url);	
			        }
			        /*echo $smsURL;
			        die();*/
			       /*	$ch = curl_init($smsURL );
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$result = curl_exec($ch);
					curl_close($ch);*/
			       	/*$arrContextOptions=array(
						    "ssl"=>array(
						        "verify_peer"=>false,
						        "verify_peer_name"=>false,
						    ),
						);  

					$response = file_get_contents($smsURL, false, stream_context_create($arrContextOptions));*/
						/*$response = file_get_contents($smsURL);*/
					 
					return array('status' => $dbstatus, 'msg' => $dbmessage,'otp' => $otp);
				}
				
			break;
			case 'get_mobile_no':
				$mail_id =isset($_POST['mail_id'])?$_POST['mail_id']:'';
				$mobile = '';
				$this->db->select('reg_user_id');
				$this->db->from('applicant_reg_master');
				$this->db->where('email_id',$mail_id);
				$result = $this->db->get();
				foreach($result->result_array() AS $row2)
				{
					$mobile = $row2['reg_user_id'];
				} 
				return array('mobile' => $mobile);
			break;
			case 'verify_registration_data':
				$dbstatus = "SUCCESS";
				$dbmessage = "Logged In successfully";
				$program = $this->session->userdata('admcode');
				
				$key = $this->session->userdata('key');
				$this->session->unset_userdata('key');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				$phone_no =isset($_POST['txtCandidatePhone'])?$_POST['txtCandidatePhone']:'';
				//$dob =isset($_POST['txtdob'])?$_POST['txtdob']:'';
				$txtPwd =isset($_POST['txtPwd'])?$_POST['txtPwd']:'';
				$insCode =isset($_POST['insCode'])?$_POST['insCode']:'';
				//$txtdob =date('Y-m-d', strtotime($dob));
				$this->db->select('*');
				$this->db->from('applicant_reg_master');
				$this->db->where('reg_user_id',$phone_no);
				//$this->db->where('dob',$txtdob);
				$this->db->where("SHA2(CONCAT(password,'#','$key'),512)",$txtPwd);
				$this->db->where('institute_code',$insCode);
				$this->db->limit(1);
				//print_r($query);
				$reg_user_id = $phone_no;
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$present = $result->num_rows();
				$reg_status = 'Pending';
				foreach($result->result_array() AS $row2)
				{
					$institute_code = $row2['institute_code'];
					$first_name = $row2['first_name'];
					$reg_status = $row2['reg_status'];
					$email = $row2['email_id'];
					$full_name= $row2['first_name'].' '.$row2['mid_name'].' '.$row2['last_name'];
					if($row2['mid_name'] == '' || $row2['mid_name'] == null)
					{
						$full_name= $row2['first_name'].' '.$row2['last_name'];
					}
				}
				if($present==1) 
				{
					if($reg_status == 'Pending')
					{
						$otp = '1234';
						$this->session->set_userdata('otp', $otp);
						//$full_name
						//$name = $first_name.' '.$middle_name.' '.$last_name;
						if($dbstatus == "SUCCESS" )
						{
							
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
							//$this->db->join('program_email_setup pes','es.email_type = pes.email_type','inner');
							
							$this->db->where('es.email_type','REGISTRATION');
							
							//$this->db->where('pes.institute_code',$insCode);
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
							if($row_count > 0)
							{
								
								if($email != '')
								{
									
									$this->load->library('email');
									$content="Dear $name, You have registered successfully. $otp is your One time password for verification.";
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
									$this->email->from($email_id, 'Registration');
									$this->email->to($email); 
							
									$this->email->subject($subject);
									$find = '';
									$replace = '';
									$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url

									$this->email->message($email_content);

									$this->email->send();

									
									if($this->email->send()){
									    $dbStatus = TRUE; 
									    $dbMessage = 'A mail is forwarded to your registered mail id  ';
								    }
								    else{
									    $dbStatus = FALSE; 
									    $dbMessage = 'Unable to sent Mail.Please Contact for Support';
								    }								    
								}
								
							}
							$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
							$this->db->from('sms_provider_setup A');
							$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
							$this->db->where('B.record_status','1');
							$this->db->where('A.record_status','1');
							$this->db->where('B.sms_type','REGISTRATION');
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
								$findappl = '';
								$replaceappl = '';
								//echo $content."<br>";
								$content = 'You have successfully registered! Your OTP is '.$otp.' to verify.';
								$new_content = str_replace($findappl, $replaceappl, $content);
								$messageToSend = rawurlencode($new_content);
								//echo $new_sms_url."<br>";
								//echo $new_content."<br>";
								//echo $messageToSend;
								
								//find replace url with mobileno and message
								$findmobileNo = array("[mobileno]","[message]","[username]","[password]","[sender]");
								$replacemobileNo = array($reg_user_id,$messageToSend,$user_name,$password,$sender);
								$smsURL = str_replace($findmobileNo,$replacemobileNo,$sms_url);	
					        }
					        /*echo $smsURL;
					        die();*/
					     	$ch = curl_init($smsURL );
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							$result = curl_exec($ch);
							curl_close($ch);
						
						return array('status'=>'ERROR1', 'msg'=>'You havn\'t not verified your Mobile no /Email Id','logoutopt'=>'YES');
					}
					}
					else
					{
						$this->db->select('*');
						$this->db->from('login_detail');
						$this->db->where('record_status',1);
						$this->db->where('login_id',$phone_no);
						$this->db->where('login_role','Applicant');
						$get_status=$this->db->get();
						$check_user = $get_status->num_rows();
						if($check_user!=0){
							return array('status'=>false, 'msg'=>'You have loged-in in another system','logoutopt'=>'YES');
						}
						
						$login_log = array('login_id'=>$phone_no,
											'login_role'=>'Applicant',
											'ip_address'=>$this->input->ip_address(),
											'sess_id'=>session_id(),
											'institute_code'=>$insCode,
											'log_status'=>'login',
											'created_by'=>$phone_no,
											'created_on'=>$date,
											);
						//echo '1';die();	
						$this->db->insert('login_detail',$login_log);
						
						$this->session->set_userdata('sess_id', session_id());
						$this->session->set_userdata('reg_user_id', $phone_no);
						$this->session->set_userdata('institute_code', $institute_code);
						$this->session->set_userdata('first_name', $first_name);
						$this->session->set_userdata('full_name', $full_name);
						$this->session->set_userdata('mode', 'new');
						$this->session->set_userdata('step', 2);
						$ip = $_SERVER['REMOTE_ADDR'];     
						if($ip){
						    if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
							{
						        $ip = $_SERVER['HTTP_CLIENT_IP'];
						    } 
							elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
						        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
						    }
						//echo $ip;
						}
						$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
						
						$output = array();
						$new_data = array(
							'user_code' 					=>$phone_no,
							'user_role' 					=>'APPLICANT',
							'user_ip' 						=>$ip,
							'url'							=>$url, 
							'action_type'					=>'LOGIN',
							'institute_code'				=>$institute_code ,
							'created_by' 					=>$phone_no,
							'created_on'					=>$date
						);
						$insert_user = $this->db->insert('user_activity_details', $new_data);
						return array('status' => $dbstatus, 'msg' => $dbmessage, 'enc_ins'=>encrypt_decrypt('encrypt', $institute_code),'logoutopt'=>'NO');
					}
					
				}
				else
				{
					return array('status' => FALSE, 'msg' => 'Incorrect Mobile No or Password','logoutopt'=>'NO');
				}
			break;
			/*case 'verify_registration_data':
				$dbstatus = TRUE;
				$program = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$present = 0;
				$phone_no =isset($_POST['txtCandidatePhone'])?$_POST['txtCandidatePhone']:'';
				$dob =isset($_POST['txtdob'])?$_POST['txtdob']:'';
				$insCode =isset($_POST['insCode'])?$_POST['insCode']:'';
				$txtdob =date('Y-m-d', strtotime($dob));
				$this->db->select('*');
				$this->db->from('applicant_reg_master');
				$this->db->where('reg_user_id',$phone_no);
				$this->db->where('dob',$txtdob);
				$this->db->where('institute_code',$insCode);
				$this->db->limit(1);
				//print_r($query);
				$result = $this->db->get();;
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
			break;*/
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
			case 'gen_info':
				$seladmcode = $this->input->post('admcode');//echo $seladmcode;die();
				$this->db->select('general_info');
				$this->db->from('program_general_information');
				$this->db->where('record_status',1);
				$this->db->where('program_code',$seladmcode);
				$result = $this->db->get();
				//print_r($result);
				//echo $this->db->last_query();die;
				return $result->result_array();
			break;
			case 'general_info':
				$seladmcode = $this->input->post('admcode');//echo $seladmcode;die();
				$this->db->select('instruction');
				$this->db->from('general_instruction');
				$this->db->where('record_status',1);
				$result = $this->db->get();
				//print_r($result);
				return $result->result_array();
			break;
			case 'corrigendum_info':
				$seladmcode = $this->input->post('admcode');
				//echo $seladmcode;die();
				$this->db->select('corrigendum_name,corrigendum_path,corrigendum_type');
				$this->db->from('corrigendum_upload');
				$this->db->where('corrigendum_type','CORRIGENDUM');
				$this->db->where('record_status',1);
				$this->db->where('program_code',$seladmcode);
				$this->db->order_by('created_on','DESC');
				$result = $this->db->get();
				//print_r($result->result_array());die;
				//echo $this->db->last_query();die;
				return $result->result_array();
			break;
			case 'notice_info':
				$seladmcode = $this->input->post('admcode');
				//echo $seladmcode;die();
				$this->db->select('corrigendum_name,corrigendum_path,corrigendum_type');
				$this->db->from('corrigendum_upload');
				$this->db->where('corrigendum_type','NOTICE');
				$this->db->where('record_status',1);
				$this->db->where('program_code',$seladmcode);
				$this->db->order_by('created_on','DESC');
				$result = $this->db->get();
				//print_r($result->result_array());die;
				//echo $this->db->last_query();die;
				return $result->result_array();
			break;
			case 'temp_config':
				$seladmcode = $this->input->post('admcode');
				//echo $seladmcode;die();
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
				//print_r($result->result_array());die;
				foreach($result->result_array() as $row)
				{
					$file_name = $row['file_name'];
				    $app_end_date = $row['apply_end_date'];
				}
				
				$this->db->select('*');
				$this->db->from('applicant_reg_master');
				$this->db->where('reg_user_id',$reg_user_id);
				//$this->db->where('applied_program',$seladmcode);
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
							/*$data = Array (
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
									
							$r_query6=$this->db->insert ('applicant_reg_master', $data);*/
							/*echo $this->db->last_query();
							die();*/
						}
						
					}
				}
				/*if($r_query6){*/
					$counting1='';
					$prog = 'PROG_'.$ins_code;
					$this->db->select('COUNT(*) AS counting1,appl_no');
					$this->db->from('applicant_appl_overview');
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('institute_code',$ins_code);
					$this->db->where('applied_program',$prog);
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
				
				/*}else{
					$output['file'][] = 'error';
				}*/
				
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
			case 'get_rank_data':
				$seladmcode = $this->input->post('applied_program');
				$reg_user_id = $this->input->post('reg_user_id');
				if($seladmcode!=''){
					$this->db->where('R.applied_program',$seladmcode);
				}
				if($reg_user_id!=''){
					$this->db->where('R.mobile',$reg_user_id);
				}
				/*if($cmbState!=''){
					$this->db->where('A.state_code',$cmbState);
				}*/
				$this->db->select("R.full_name,jee_rollno,pm.program_name,marks_obtained,gcd.description as applicant_status_show,rank_sc,rank_st,rank_obc,rank_ph,rank_gen, 1st_center, 2nd_center, 3rd_center,state,R.reg_user_id,R.applied_program,R.appl_no,R.applicant_status");
				$this->db->from('applicant_rank_master R');
				$this->db->join('program_master pm','R.applied_program = pm.program_code','inner');
				$this->db->join('gen_code_description gcd','R.applicant_status = gcd.code','left');
				$this->db->where('R.record_status',1);
				$result = $this->db->get();
				/*echo $this->db->last_query();die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

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
			case 'get_call_list':
			
				$seladmcode = $this->input->post('applied_program');
				/*$reg_user_id = $this->input->post('reg_user_id');*/
				if($seladmcode!=''){
					$this->db->where('rd.applied_program',$seladmcode);
				}
				/*if($reg_user_id!=''){
					$this->db->where('R.mobile',$reg_user_id);
				}*/
				/*if($cmbState!=''){
					$this->db->where('A.state_code',$cmbState);
				}*/
				$this->db->select("rd.reg_user_id,pm.program_name,DATE_FORMAT (rd.`downloaded_date`,'%d-%m-%Y') AS downloaded_date");
				$this->db->from('`rankcard_downloadstatus` rd ');
				$this->db->join('`applicant_appl_overview` aao','rd.reg_user_id  = aao.reg_user_id AND rd.applied_program = aao.applied_program','left');
				$this->db->join('program_master pm','aao.applied_program = pm.program_code','left');
				$this->db->where('rd.record_status',1);
				$this->db->where('rd.last_updated > ','2018-07-16 18:51:27');
				
				$result = $this->db->get();
				/*echo $this->db->last_query();die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

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
				
				

				$FathersProfession = isset($_POST['FathersProfession']) ? trim($_POST['FathersProfession']) : '';
				$FathersIncome = isset($_POST['FathersIncome']) ? trim($_POST['FathersIncome']) : '';
				$cmbNorthState = isset($_POST['cmbNorthState']) ? trim($_POST['cmbNorthState']) : '';

				$txtMotherName = isset($_POST['txtMotherName']) ? trim($_POST['txtMotherName']) : '';
				$MothersProfession = isset($_POST['MothersProfession']) ? trim($_POST['MothersProfession']) : '';
				$MothersIncome = isset($_POST['MothersIncome']) ? trim($_POST['MothersIncome']) : '';
				$mothers_adhar_no = isset($_POST['txtUidM']) ? trim($_POST['txtUidM']) : '';
				$fathers_adhar_no = isset($_POST['txtUidF']) ? trim($_POST['txtUidF']) : '';
				 



				$employed = isset($_POST['employed']) ? trim($_POST['employed']) : 'NO';
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
				$radioID = isset($_POST['radioID']) ? $_POST['radioID'] : '';
				$NorthEast = isset($_POST['NorthEast']) ? $_POST['NorthEast'] : '';
				$radioJEE = isset($_POST['radioJEE']) ? $_POST['radioJEE'] : '';
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
				$txtPresentAddress = isset($_POST['txtPresentAddress']) ?  trim($_POST['txtPresentAddress']) : 'BBSR';
				$txtPresentLocality = isset($_POST['txtPresentLocality']) ? trim($_POST['txtPresentLocality']) : '';
				$txtPresentPost = isset($_POST['txtPresentPost']) ? trim($_POST['txtPresentPost']) : '';
				$cmbPresentDist = isset($_POST['cmbPresentDist']) ?  trim($_POST['cmbPresentDist']) : '';
				$txtPresentPin = isset($_POST['txtPresentPin']) ? trim($_POST['txtPresentPin']) : '761200';
				$cmbPresentState = isset($_POST['cmbPresentState']) ? trim($_POST['cmbPresentState']) : '';
				$txtPresentDistance = isset($_POST['txtPresentDistance']) ? trim($_POST['txtPresentDistance']) : '';

				//if permanent is same as present
				$chksameasresidential = isset($_POST['chksameasresidential']) ? $_POST['chksameasresidential']:'N';
				$txtPermenentAddress = isset($_POST['hidPermenentAddress']) ? trim($_POST['hidPermenentAddress']) : '';
				$txtPermenentLocality = isset($_POST['txtPermenentLocality']) ? trim($_POST['txtPermenentLocality']) : '';
				$txtPermanentPost = isset($_POST['txtPermanentPost']) ? trim($_POST['txtPermanentPost']) : 'PKD';
				$txtPermanentDist = isset($_POST['cmbPermanentDist']) ? trim($_POST['cmbPermanentDist']) : '';
				$txtPermanentState = isset($_POST['cmbPermanentState']) ?  trim($_POST['cmbPermanentState']) : '';
				$txtPermanentPin = isset($_POST['txtPermanentPin']) ? trim($_POST['txtPermanentPin']) : '761200';
				$txtPermanentMobile = isset($_POST['txtPermanentMobile']) ? trim($_POST['txtPermanentMobile']) : '';
				$txtUid = isset($_POST['txtUid']) ? trim($_POST['txtUid']) : '';
					
				$txtApplicantEmail = isset($_POST['txtemailid']) ? trim($_POST['txtemailid']) : '';
				/*ECHO $txtApplicantEmail;
				DIE();*/
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
				// District code
				$this->db->select("district_code");
				$this->db->from('district_master');
				$this->db->where('district_name',$cmbPresentDist);
				$result = $this->db->get();
				$cmbPresentDist= $result->result_array();
				foreach($cmbPresentDist as $row)
				{
					$cmbPresentDist=$row['district_code'];
				}
				$this->db->select("district_code");
				$this->db->from('district_master');
				$this->db->where('district_name',$cmbPermanentDist);
				$result = $this->db->get();
				$cmbPermanentDist= $result->result_array();
				foreach($cmbPermanentDist as $row)
				{
					$cmbPermanentDist=$row['district_code'];
				}

				$this->db->select("state_code");
				$this->db->from('state_master');
				$this->db->where('state_name',$cmbPresentState);
				$result = $this->db->get();
				$cmbPresentState= $result->result_array();
				foreach($cmbPresentState as $row)
				{
					$cmbPresentState=$row['state_code'];
				}

				$this->db->select("state_code");
				$this->db->from('state_master');
				$this->db->where('state_name',$cmbPermanentState);
				$result = $this->db->get();
				$cmbPermanentState= $result->result_array();
				foreach($cmbPermanentState as $row)
				{
					$cmbPermanentState=$row['state_code'];
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
				$radioMarkSheet = isset($_POST['radioMarkSheet']) ? $_POST['radioMarkSheet'] : '';
				if($NorthEast == 'Yes')
				{
					$pay_mode = 'Online';
				}
				else
				{
					$pay_mode = isset($_POST['mode']) ? $_POST['mode'] : '';
				}
				
				
				$radioGradCert = isset($_POST['radioGradCert']) ? $_POST['radioGradCert'] : 'No';
				$radioGradMarkSheet = isset($_POST['radioGradMarkSheet']) ? $_POST['radioGradMarkSheet'] : 'No';
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
				$this->db->save_queries = TRUE;
				$this->db->select("count(*) AS cnt");
				$this->db->from('applicant_appl_overview');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				echo "hiiiiiiiii";
				die();*/
				foreach($result->result_array() as $appl)
				{
					$count = $appl['cnt'];
				}
				if($count >= 1)
				{
					$this->session->set_userdata('mode', 'edit');
				}
				else
				{
					$this->session->set_userdata('mode', 'new');
				}
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
							'institute_code'=>HARDCODE_INSTITUTE_CODE, 
							'mobile'=>$reg_user_id, 
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
							'mobile'=>$reg_user_id, 
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
							'mobile'=>$reg_user_id, 
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
							'mobile'=>$reg_user_id, 
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
						'id_proof' => $radioID,
						'jee_place' => $radioJEE,
						'nationality' => $cmbNationality,
						'cmbrelationship' => $cmbrelationship,
						'adhar_no' => $txtUid,
						'dob_in_word' => $hidDate,
						'category' => $cmbReservedCategory,
						'phtype'=>$txtphtype,
						
						'is_minority_community' => $radioMinority,
						'is_passed' => $radioMarkSheet,
						'payment_mode' => $pay_mode,
						'grad_cert' => $radioGradCert,
						'grad_mark_sheet' => $radioGradMarkSheet,
						'minority_community_details' => $cmbCommunity,
						
						
						'father_occupation' => $txtOccupation,
						'annual_parent_income' => $txtIncome,
						'indicate_choice' => $txtIndicate,
						'know_about_cipet' => $txtKnowabout,
						'physically_challenged' => $radioPhysicallY ,
						
						'religion' => $cmbReligion,
						'applicant_email' => $txtApplicantEmail,
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
						
						'father_occupation'=>$FathersProfession, 
						'annual_parent_income'=>$FathersIncome,
						'north_east_state'=>$cmbNorthState, 
						'is_north_east'=>$NorthEast, 

						'mothers_profession'=>$MothersProfession, 
						'mothers_income'=>$MothersIncome,
						'mothers_name'=>$txtMotherName,
						'fathers_adhar_no'=>$fathers_adhar_no,
						'mothers_adhar_no'=>$mothers_adhar_no,
						'exservice'=>$radiobelong,

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
						$query = $this->db->update('applicant_master',$applicant_master_update_array);
						
						if(!$query)
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
								'id_proof' => $radioID,
								'jee_place' => $radioJEE,
								'nationality' => $cmbNationality,
								'cmbrelationship' => $cmbrelationship,
								'dob' => $dob,
								'adhar_no' => $txtUid,
								'dob_in_word' => $hidDate,
								'category' => $cmbReservedCategory,
								'phtype'=>$txtphtype,
								
								'is_minority_community' => $radioMinority,
								'is_passed' => $radioMarkSheet,
								'payment_mode' => $pay_mode,
								'grad_mark_sheet' => $radioGradMarkSheet,
								'minority_community_details' => $cmbCommunity,
								
								'is_north_east'=>$NorthEast, 
								'father_occupation' => $txtOccupation,
								'annual_parent_income' => $txtIncome,
								'indicate_choice' => $txtIndicate,
								'know_about_cipet' => $txtKnowabout,
								'physically_challenged' => $radioPhysicallY ,
								'last_year_mark' => $txtfinalpercentage,
								
								'religion' => $cmbReligion,
								'applicant_email' => $txtApplicantEmail,
								'applicant_landline' => $txtApplicantLandLine,
								'applicant_mobile' => $txtApplicantMobile,
								'mother_tongue' => $txtMotherTongue, 
								'hostel_facility' => $radioHostel,
								'marital_status' => $radiomaritalstatus,
								'is_reserved_quota' => $radioQuota,
								'created_by' => $reg_user_id,
								'created_on' => $now,
								'master_name'=>$master_name,
								'exservice'=>$radiobelong,
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
							'fathers_adhar_no'=>$fathers_adhar_no,
							'mothers_adhar_no'=>$mothers_adhar_no,
								
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
					/*echo $txtQualification3;
					die();*/
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
							/*echo $this->db->last_query();
							die();*/
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
							
							if($NorthEast == 'Yes'){
								$pay_mode = 'Online';
							}
							if($cmbReservedCategory == 'GEN' || $cmbReservedCategory == 'OBC'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
							}
							if($NorthEast == 'No'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'RECIDENCE');
								$pay_mode == 'Online';
							}
							
							if($radiobelong == 'NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DOMICILE');
							}
							if($radioPhysicallY == 'NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'PHC');
							}
							if($radioGradCert == 'No'  || $radioMarkSheet == 'No'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HQC');
							}
							if($radioGradMarkSheet == 'No' || $radioMarkSheet == 'No'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HDMS');
							}
							if($radioID == 'No'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DL');
							}
							if($employed == 'NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'NOC');
							}
							if($pay_mode == 'Online'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CHALLAN');
							}
							if($cmbNationality == 'OTH'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
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
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'institute_code'=>HARDCODE_INSTITUTE_CODE, 
							'created_by' => $reg_user_id,
							'distance_from' => $txtPresentDistance,
							'created_on' => $now 
						);
						$this->db->insert('applicant_address',$applicant_address_array1);
						/*echo $this->db->last_query();
						die();*/
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbmessage = 'Error inserting Applicant same address';
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
							'id_proof' => $radioID,
							'jee_place' => $radioJEE,
							'nationality' => $cmbNationality,
							'dob' => $dob,
							'adhar_no' => $txtUid,
							'dob_in_word' => $hidDate,
							'category' => $cmbReservedCategory,
							'phtype'=>$txtphtype,
							'religion' => $cmbReligion,
							'applicant_email' => $txtApplicantEmail,
							'applicant_landline' => $txtApplicantLandLine,
							'applicant_mobile' => $txtApplicantMobile,
							'mother_tongue' => $txtMotherTongue, 
							'hostel_facility' => $radioHostel,
							'marital_status' => $radiomaritalstatus,
							'is_reserved_quota' => $radioQuota,
							'last_year_mark' => $txtfinalpercentage,
							
							'is_minority_community' => $radioMinority,
							'is_passed' => $radioMarkSheet,
							'payment_mode' => $pay_mode,
							'grad_cert' => $radioGradCert,
							'grad_mark_sheet' => $radioGradMarkSheet,
							'minority_community_details' => $cmbCommunity,
							'is_north_east'=>$NorthEast, 
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
							'exservice'=>$radiobelong,
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
							'fathers_adhar_no'=>$fathers_adhar_no,
							'mothers_adhar_no'=>$mothers_adhar_no,
							
							
							'completion_date'=>$completion_date 
							);
						$this->db->insert('applicant_master',$applicant_master_insert_array);
						
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbmessage = 'Error inserting Applicant same address';
						}
						
						/*$applicant_history_insert_array=array('reg_user_id' => $reg_user_id,
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
							'adhar_no' => $txtUid,
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
							'fathers_adhar_no'=>$fathers_adhar_no,
							'mothers_adhar_no'=>$mothers_adhar_no,
							
							'completion_date'=>$completion_date );
						$this->db->insert('applicant_history',$applicant_history_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbmessage = 'Error inserting Applicant history same address';
						}*/
						
						
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
							'institute_code'=>HARDCODE_INSTITUTE_CODE,  
							'mobile'=>$reg_user_id, 
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
								'institute_code'=>HARDCODE_INSTITUTE_CODE, 
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
							'id_proof' => $radioID,
							'jee_place' => $radioJEE,
							'nationality' => $cmbNationality,
							'dob' => $dob,
							'adhar_no' => $txtUid,
							'dob_in_word' => $hidDate,
							'category' => $cmbReservedCategory,
							'phtype'=>$txtphtype,
							'religion' => $cmbReligion,
							'applicant_email' => $txtApplicantEmail,
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
							'is_passed' => $radioMarkSheet,
							'payment_mode' => $pay_mode,
							'grad_cert' => $radioGradCert,
							 'grad_mark_sheet' => $radioGradMarkSheet,
							'minority_community_details' => $cmbCommunity,
							'is_north_east'=>$NorthEast, 
							'father_occupation' => $txtOccupation,
							'annual_parent_income' => $txtIncome,
							'indicate_choice' => $txtIndicate,
							'know_about_cipet' => $txtKnowabout,
							'physically_challenged' => $radioPhysicallY ,
							
							'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$perm_address_ref_id,
							'master_name'=>$master_name,
							'exservice'=>$radiobelong,
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
							'fathers_adhar_no'=>$fathers_adhar_no,
							'mothers_adhar_no'=>$mothers_adhar_no,

							'completion_date'=>$completion_date 
						);
						$this->db->insert('applicant_master',$applicant_master_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant same address';
						}
						/*$applicant_history_insert_array=array(
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
							'adhar_no' => $txtUid,
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
							'fathers_adhar_no'=>$fathers_adhar_no,
							'mothers_adhar_no'=>$mothers_adhar_no,

							'annual_parent_income'=>$FathersIncome,
							'north_east_state'=>$cmbNorthState, 
							'completion_date'=>$completion_date 
						);
						$this->db->insert('applicant_history',$applicant_history_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant history different address';
						}*/
						
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
					//echo  $this->db->last_query(); die();
					
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
							if($this->db->affected_rows() == 0)
							{
								$dbstatus = FALSE;
								$dbmessage = 'Error updating applicant_qualification_detail';
							}
							
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
					/*echo $dbmessage;
							die();*/
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
							$split=explode("_",$program_code);
							$last_digit=substr($split[0], -3);
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
							
						$application_no = $last_digit.$year.$changed_sl_no;
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
							//$this->db->insert('applicant_appl_overview_history',$application_data);
							
							
							$this->db->where('program_code',$program_code);
							$this->db->update('program_master',$program_update_data);
							if($this->db->affected_rows() == 0)
							{
								$dbStatus = FALSE;
								$dbmessage = 'Error updating program';
							}
							//echo $this->db->last_query();
						}
						
						$this->db->select("document_type_code");
						$this->db->from('program_document_setup');
						$this->db->where('program_code',$program_code);
						$this->db->where('record_status',1);
						$result = $this->db->get();
						$documentsReq = $result->result_array();
						if($NorthEast == 'Yes'){
							$pay_mode = 'Online';
						}
							
						if($cmbReservedCategory == 'GEN' || $cmbReservedCategory == 'OBC'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
						}
						if($NorthEast == 'No'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'RECIDENCE');
						}
						if($radiobelong == 'NO'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DOMICILE');
						}
						if($radioPhysicallY == 'NO'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'PHC');
						}
						if($radioGradCert == 'No'  || $radioMarkSheet == 'No'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HQC');
						}
						if($radioGradMarkSheet == 'No' || $radioMarkSheet == 'No'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HDMS');
						}
						if($radioID == 'No'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DL');
						}
						if($employed == 'NO'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'NOC');
						}
						if($pay_mode == 'Online'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CHALLAN');
						}
						if($cmbNationality == 'OTH'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
						}
						
						foreach($documentsReq AS $row1)
						{
							$document_list_insert_array = array(
								'record_status'=>1,
								'application_no'=>$application_no,
								'document_type_code'=>$row1['document_type_code']
							);
							$this->db->insert('applicant_document_list',$document_list_insert_array);
							if($this->db->affected_rows() == 0)
							{
								$dbStatus = FALSE;
								$dbmessage = 'Error updating applicant_document_list';
							}
						}
						/*echo $dbmessage;
						die();*/
						$page_url = $_SERVER["HTTP_REFERER"];
						$ip_address = $_SERVER['REMOTE_ADDR'];
						$log_status = $dbStatus;
						$log_message = $dbmessage;
						$this->log_detail_record($page_url, $log_status, $log_message, $ip_address);
						if($dbStatus == TRUE)
						{
							$this->db->trans_complete();
							$this->session->set_userdata('admcode', $program_code);
							$this->session->set_userdata('reg_user_id', $reg_user_id);
							$this->session->set_userdata('appl_no', $application_no);
							$this->session->set_userdata('mode', $mode);
							$this->session->set_userdata('step', 3);
							/*if( $this->db->trans_status() === FALSE){
								$dbStatus = FALSE;
								$dbmessage = 'Error While Saving';
							}*/
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


















			
			case 'add_application_data_014':
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
				$NorthEast = isset($_POST['NorthEast']) ? $_POST['NorthEast'] : '';



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
				$radioID = isset($_POST['radioID']) ? $_POST['radioID'] : '';
				$radioJEE = isset($_POST['radioJEE']) ? $_POST['radioJEE'] : '';
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
				//echo $radiobelong; die();
				
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
				$txtPresentPost = isset($_POST['txtPresentPost']) ? trim($_POST['txtPresentPost']) : 'BBSR';
				$cmbPresentDist = isset($_POST['cmbPresentDist']) ?  trim($_POST['cmbPresentDist']) : '';
				$txtPresentPin = isset($_POST['txtPresentPin']) ? trim($_POST['txtPresentPin']) : '761200';
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
					
				$txtApplicantEmail = isset($_POST['txtemailid']) ? trim($_POST['txtemailid']) : '';
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
				
				$radioMarkSheet = isset($_POST['radioMarkSheet']) ? $_POST['radioMarkSheet'] : '';
				if($NorthEast == 'Yes')
				{
					$pay_mode = 'Online';
				}
				else
				{
					$pay_mode = isset($_POST['mode']) ? $_POST['mode'] : '';
				}
				//echo $pay_mode ; die();
				//$pay_mode = isset($_POST['mode']) ? $_POST['mode'] : '';
				$radioExam = isset($_POST['radioExam']) ? $_POST['radioExam'] : '';
				$radioGradCert = isset($_POST['radioGradCert']) ? $_POST['radioGradCert'] : 'No';
				$radioGradMarkSheet = isset($_POST['radioGradMarkSheet']) ? $_POST['radioGradMarkSheet'] : 'No';
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
						// District code
				$this->db->select("district_code");
				$this->db->from('district_master');
				$this->db->where('district_name',$cmbPresentDist);
				$result = $this->db->get();
				$cmbPresentDist= $result->result_array();
				foreach($cmbPresentDist as $row)
				{
					$cmbPresentDist=$row['district_code'];
				}
				$this->db->select("district_code");
				$this->db->from('district_master');
				$this->db->where('district_name',$cmbPermanentDist);
				$result = $this->db->get();
				$cmbPermanentDist= $result->result_array();
				foreach($cmbPermanentDist as $row)
				{
					$cmbPermanentDist=$row['district_code'];
				}

				$this->db->select("state_code");
				$this->db->from('state_master');
				$this->db->where('state_name',$cmbPresentState);
				$result = $this->db->get();
				$cmbPresentState= $result->result_array();
				foreach($cmbPresentState as $row)
				{
					$cmbPresentState=$row['state_code'];
				}

				$this->db->select("state_code");
				$this->db->from('state_master');
				$this->db->where('state_name',$cmbPermanentState);
				$result = $this->db->get();
				$cmbPermanentState= $result->result_array();
				foreach($cmbPermanentState as $row)
				{
					$cmbPermanentState=$row['state_code'];
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
							'institute_code'=>HARDCODE_INSTITUTE_CODE, 
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
						'id_proof' => $radioID,
						'jee_place' => $radioJEE,
						'nationality' => $cmbNationality,
						'cmbrelationship' => $cmbrelationship,
						'dob' => $dob,
						'adhar_no' => $txtUid,
						'dob_in_word' => $hidDate,
						'category' => $cmbReservedCategory,
						'phtype'=>$txtphtype,
						
						'is_minority_community' => $radioMinority,
						'is_passed' => $radioMarkSheet,
						'payment_mode' => $pay_mode,
						'grad_cert' => $radioGradCert,
						'grad_mark_sheet' => $radioGradMarkSheet,
						'minority_community_details' => $cmbCommunity,
						
						'is_north_east'=>$NorthEast, 
						'father_occupation' => $txtOccupation,
						'annual_parent_income' => $txtIncome,
						'indicate_choice' => $txtIndicate,
						'know_about_cipet' => $txtKnowabout,
						'physically_challenged' => $radioPhysicallY ,
						
						'religion' => $cmbReligion,
						'applicant_email' => $txtApplicantEmail,
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
						'exservice' => $radiobelong,
						
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
						'fathers_adhar_no'=>$fathers_adhar_no,
						'mothers_adhar_no'=>$mothers_adhar_no,

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
						$query = $this->db->update('applicant_master',$applicant_master_update_array);
						if(!$query)
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
								'id_proof' => $radioID,
								'jee_place' => $radioJEE,
								'nationality' => $cmbNationality,
								'cmbrelationship' => $cmbrelationship,
								'dob' => $dob,
								'adhar_no' => $txtUid,
								'dob_in_word' => $hidDate,
								'category' => $cmbReservedCategory,
								'phtype'=>$txtphtype,
								
								'is_minority_community' => $radioMinority,
								'is_passed' => $radioMarkSheet,
								'payment_mode' => $pay_mode,
								'grad_cert' => $radioGradCert,
								'grad_mark_sheet' => $radioGradMarkSheet,
								'minority_community_details' => $cmbCommunity,
								
								'is_north_east'=>$NorthEast, 
								'father_occupation' => $txtOccupation,
								'annual_parent_income' => $txtIncome,
								'indicate_choice' => $txtIndicate,
								'know_about_cipet' => $txtKnowabout,
								'physically_challenged' => $radioPhysicallY ,
								'last_year_mark' => $txtfinalpercentage,
								
								'religion' => $cmbReligion,
								'applicant_email' => $txtApplicantEmail,
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
								'exservice' => $radiobelong,
								'father_occupation'=>$FathersProfession, 
							'annual_parent_income'=>$FathersIncome,
							'north_east_state'=>$cmbNorthState, 
							'mothers_profession'=>$MothersProfession, 
							'mothers_income'=>$MothersIncome,
							'mothers_name'=>$txtMotherName,
							'fathers_adhar_no'=>$fathers_adhar_no,
							'mothers_adhar_no'=>$mothers_adhar_no,

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
							if($NorthEast == 'Yes'){
								$pay_mode = 'Online';
							}
							
							if($cmbReservedCategory=='GEN' || $cmbReservedCategory == 'OBC'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
							}
							if($NorthEast == 'No'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'RECIDENCE');
							}
							if($radiobelong=='NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DOMICILE');
							}
							if($radioPhysicallY=='NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'PHC');
							}
							if($radioGradCert=='No' || $radioMarkSheet == 'No'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HQC');
							}
							if($radioGradCert=='No' || $radioMarkSheet == 'No'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HDMS');
							}
							if($radioID=='No'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DL');
							}
							if($employed == 'NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'NOC');
							}
							if($pay_mode == 'Online'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CHALLAN');
							}
							if($cmbNationality == 'OTH'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
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
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'institute_code'=>HARDCODE_INSTITUTE_CODE, 
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
							'id_proof' => $radioID,
							'jee_place' => $radioJEE,
							'nationality' => $cmbNationality,
							'dob' => $dob,
							'adhar_no' => $txtUid,
							'dob_in_word' => $hidDate,
							'category' => $cmbReservedCategory,
							'phtype'=>$txtphtype,
							'religion' => $cmbReligion,
							'applicant_email' => $txtApplicantEmail,
							'applicant_landline' => $txtApplicantLandLine,
							'applicant_mobile' => $txtApplicantMobile,
							'mother_tongue' => $txtMotherTongue, 
							'hostel_facility' => $radioHostel,
							'marital_status' => $radiomaritalstatus,
							'is_reserved_quota' => $radioQuota,
							'last_year_mark' => $txtfinalpercentage,
							
							'is_minority_community' => $radioMinority,
							'is_passed' => $radioMarkSheet,
							'payment_mode' => $pay_mode,
							'grad_cert' => $radioGradCert,
							'grad_mark_sheet' => $radioGradMarkSheet,
							'minority_community_details' => $cmbCommunity,
							'is_north_east'=>$NorthEast, 
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
							'exservice' => $radiobelong,
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
							'fathers_adhar_no'=>$fathers_adhar_no,
							'mothers_adhar_no'=>$mothers_adhar_no,

							
							'completion_date'=>$completion_date 
							);
						$this->db->insert('applicant_master',$applicant_master_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant same address';
						}
							
							
						/*$applicant_history_insert_array=array('reg_user_id' => $reg_user_id,
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
							'adhar_no' => $txtUid,
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
							'fathers_adhar_no'=>$fathers_adhar_no,
							'mothers_adhar_no'=>$mothers_adhar_no,
							
							'completion_date'=>$completion_date );
						$this->db->insert('applicant_history',$applicant_history_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant history same address';
						}*/
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
							'institute_code'=>HARDCODE_INSTITUTE_CODE,  
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
							'institute_code'=>HARDCODE_INSTITUTE_CODE, 
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
							'id_proof' => $radioID,
							'jee_place' => $radioJEE,
							'nationality' => $cmbNationality,
							'dob' => $dob,
							'adhar_no' => $txtUid,
							'dob_in_word' => $hidDate,
							'category' => $cmbReservedCategory,
							'phtype'=>$txtphtype,
							'religion' => $cmbReligion,
							'applicant_email' => $txtApplicantEmail,
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
							'is_passed' => $radioMarkSheet,
							'payment_mode' => $pay_mode,
							'grad_cert' => $radioGradCert,
							'grad_mark_sheet' => $radioGradMarkSheet,
							'minority_community_details' => $cmbCommunity,
							'is_north_east'=>$NorthEast, 
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
							'fathers_adhar_no'=>$fathers_adhar_no,
							'mothers_adhar_no'=>$mothers_adhar_no,

							'completion_date'=>$completion_date 
						);
						$this->db->insert('applicant_master',$applicant_master_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant same address';
						}
						/*$applicant_history_insert_array=array(
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
							'adhar_no' => $txtUid,
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
							'fathers_adhar_no'=>$fathers_adhar_no,
							'mothers_adhar_no'=>$mothers_adhar_no,

							'annual_parent_income'=>$FathersIncome,
							'north_east_state'=>$cmbNorthState, 
							'completion_date'=>$completion_date 
						);
						$this->db->insert('applicant_history',$applicant_history_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant history different address';
						}*/
						
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
						
						$this->db->select("program_code,year,sl_no");
						$this->db->from('program_master');
						$this->db->where('program_code',$program_code);
						$result = $this->db->get();
						
						foreach($result->result_array() as $appl)
						{
							$sl_no = $appl['sl_no'];
							$program_code = $appl['program_code'];
							$split=explode("_",$program_code);
							$last_digit=substr($split[0], -3);
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
							
						$application_no = $last_digit.$year.$changed_sl_no;
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
						
							$this->db->insert('applicant_appl_overview_history',$application_data);
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
						if($NorthEast == 'Yes'){
							$pay_mode = 'Online';
						}
							
						if($cmbReservedCategory=='GEN'|| $cmbReservedCategory == 'OBC'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
						}
						if($NorthEast == 'No'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'RECIDENCE');
						}
						if($radiobelong=='NO'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DOMICILE');
						}
						if($radioPhysicallY=='NO'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'PHC');
						}
						if($radioGradCert=='No' || $radioMarkSheet == 'No'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HQC');
						}
						if($radioGradMarkSheet=='No' || $radioMarkSheet == 'No'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HDMS');
						}
						if($radioID=='No'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DL');
						}
						if($employed == 'NO'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'NOC');
						}
						if($pay_mode == 'Online'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CHALLAN');
						}
						if($cmbNationality == 'OTH'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
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
						
						$page_url = $_SERVER["HTTP_REFERER"];
						$ip_address = $_SERVER['REMOTE_ADDR'];
						$log_status = $dbStatus;
						$log_message = $dbmessage;
						$this->log_detail_record($page_url, $log_status, $log_message, $ip_address);
						
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
        		//$data = $this->uri->uri_to_assoc();
				//$institute = $data['ins'];
        		//$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$where = "(program_document_setup.record_status = 'Active' OR program_document_setup.record_status = '1')";
        		
				$this->db->select('applicant_document_list.document_type_code,document_type,document_extension_type,document_type_description,document_size_description,document_size_in_kb,document_preview_height,document_preview_width');
				$this->db->from('program_document_setup');
				$this->db->join('applicant_document_list', 'program_document_setup.document_type_code = applicant_document_list.document_type_code','inner');
				$this->db->join('document_type_master', 'program_document_setup.document_type_code = document_type_master.document_type_code','inner');
				
				$this->db->where('application_no',$application_no);
				$this->db->where('program_code',$program_code);
				$this->db->where('applicant_document_list.record_status','1');
				$this->db->where($where);
				$this->db->order_by('program_document_setup.sl_no');
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
        		if($program_code == '' || $program_code == null )
        		{
					$data = $this->uri->uri_to_assoc();
					$program_code = $data['admcode'];
				}
        		
        		
				$this->db->select('appl_status,appl_no,edit_status');
				$this->db->from('applicant_appl_overview');
				
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('STATUS','1');
				//print_r($query);
				$result = $this->db->get();/*echo $this->db->last_query();die();*/
				foreach($result->result_array() as $aRow){
					$appl_status = $aRow['appl_status'];
					$appl_no = $aRow['appl_no'];
				}
				
				if($appl_status == 'Document Uploaded' || $appl_status == 'Verified' || $appl_status == 'Fee Paid' || $appl_status == 'Payment Updated' ){
					$this->session->set_userdata('mode', 'edit');
					$this->session->set_userdata('appl_no', $appl_no);
					
				}
				else{
					$this->session->set_userdata('mode', 'new');
				}
				return $result->result_array();
			break;
			case 'get_appl_status_doc':
				//$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		//$ins =  encrypt_decrypt('decrypt', $data);
        		
					$data = $this->uri->uri_to_assoc();
					$program = $data['admcode'];
				
        		
        		
				$this->db->select('appl_status,appl_no,edit_status');
				$this->db->from('applicant_appl_overview');
				
				$this->db->where('applied_program',$program);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('STATUS','1');
				//print_r($query);
				$result = $this->db->get();/*echo $this->db->last_query();die();*/
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
        		//$ins =  encrypt_decrypt('decrypt', $data);
        		
        		
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

				// echo DOCUMENT_UPLOAD_URL.'/'.$program_code.'/'.$application_no;
                //     			die();
				$uploaddir = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$program_code."/".$application_no;//echo $uploaddir;die;
				$retrievedir = BASE_ADM_URL."/DOCUMENTS/".$program_code."/".$application_no;
				// echo $uploaddir;
				// echo $retrievedir;die();
				if(!is_dir($uploaddir))
					mkdir($uploaddir,0777,true);
				//exec("chmod -R 777 $uploaddir");//for giving folder permission to download that file 
				
				$allowed =  array('jpg','jpeg' ,'png','JPG','PNG','xls','xlsx','XLSX','XLS','PDF','DOC','pdf','doc','DOCX','docx');
				//echo $mode;die();
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
					/* echo '<pre>';print_r($output_data);die;
					foreach($output_data as $row)
					{
						$documentsReq[] = $row;	
						$documentsDesc[] = $row['document_type'];
						$documentsCode[] = $row['document_type_code'];
					}
					 */
					foreach($output_data as $row)
	  				{	
						if(!empty($_FILES['fileDocument']['tmp_name'][$i]))
				  		{
				  			$document_type_code = $row['document_type_code'];
							$doc_name= explode(".",$_FILES['fileDocument']["name"][$i]);
							$check = mime_content_type($_FILES['fileDocument']['tmp_name'][$i]);
							//echo $check;die();
							if($check != 'image/jpeg' && $check != 'image/jpg' && $check != 'image/png' && $check != 'application/pdf' && $check != 'application/vnd.ms-excel' && $check != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' && $check != 'application/msword' && $check != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' ) {
								return array('status'=>false, 'msg'=>"Invalid file type");
							}
							$ext_doc = strtolower(end($doc_name));
							$docImageFileName = $document_type_code.'.'.$ext_doc;
							$docImagePath = $retrievedir."/".$docImageFileName;
							$docimagetemp = $_FILES['fileDocument']['tmp_name'][$i];
							//ECHO $_FILES['fileDocument']['tmp_name'][$i];
							//echo $uploaddir."<br />";
							//echo $uploaddir."/".$docImageFileName;die;
							move_uploaded_file($docimagetemp,$uploaddir."/".$docImageFileName);	
						
							if(!in_array($ext_doc,$allowed) ) {
							    $error_count++;
							}
							else
							{
								//echo $uploaddir;die;
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
						/*$update_data = array(
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
						}*/
						
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
					//echo $output_data;die;
					 foreach($output_data as $row)
					{
						$documentsReq[] = $row;	
						$documentsDesc[] = $row['document_type'];
						$documentsCode[] = $row['document_type_code'];
					} 
					foreach($documentsReq as $row)
	  				{	
						if(!empty($_FILES['fileDocument']['tmp_name'][$i]))
				  		{
				  			$document_type_code = $row['document_type_code'];
							$doc_name= explode(".",$_FILES['fileDocument']["name"][$i]);
							$check = mime_content_type($_FILES['fileDocument']['tmp_name'][$i]);
							if($check != 'image/jpeg' && $check != 'image/jpg' && $check != 'image/png' && $check != 'application/pdf' && $check != 'application/vnd.ms-excel' && $check != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' && $check != 'application/msword' && $check != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' ) {
								return array('status'=>false, 'msg'=>"Invalid file type");
							}
							$ext_doc = strtolower(end($doc_name));
							$docImageFileName = $document_type_code.'.'.$ext_doc;
							$docImagePath = $retrievedir."/".$docImageFileName;
							$docimagetemp = $_FILES['fileDocument']['tmp_name'][$i];
							move_uploaded_file($docimagetemp,$uploaddir."/".$docImageFileName);	
						
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
						$page_url = $_SERVER["HTTP_REFERER"];
						$ip_address = $_SERVER['REMOTE_ADDR'];
						$log_status = $dbstatus;
						$log_message = $dbMessage;
						$this->log_detail_record($page_url, $log_status, $log_message, $ip_address);
					
					
				}
				return array('status' => $dbstatus, 'msg' =>$dbMessage);
				
			break;
			
			case 'Bank_challan_submit': 
				//echo "hi";die;
				$dbstatus = TRUE;
				$dbMessage = 'Data Submitted Successfully';
				$mode = $this->session->userdata('mode');
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				
				$Referenceno = $this->input->post('txtReferenceno');
				$BankName = $this->input->post('txtBankName');
				//echo  $BankName;die;
				/*if( $Referenceno="" || $Referenceno= null || $BankName="" || $BankName=null){
					$dbstatus = FALSE;
					$dbMessage = 'Please Enter Data';
				}*/	
				//echo  $Referenceno;die;
				//$data = $this->uri->uri_to_assoc();
				//$institute = $data['ins'];
        		//$ins =  encrypt_decrypt('decrypt', $institute);
        		date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d H:i:s', now());
        		$logged_user = $this->session->userdata('user_name');
        		//echo $logged_user;die;
				//$user = $logged_user.'_'.$institute;
				$documentsReq = '';

				// echo DOCUMENT_UPLOAD_URL.'/'.$program_code.'/'.$application_no;
                //     			die();
				$uploaddir = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$program_code."/".$application_no;//echo $uploaddir;die;
				$retrievedir = BASE_ADM_URL."/DOCUMENTS/".$program_code."/".$application_no;
				// echo $uploaddir;
				// echo $retrievedir;die();
				if(!is_dir($uploaddir))
					mkdir($uploaddir,0777,true);
				//exec("chmod -R 777 $uploaddir");//for giving folder permission to download that file 
				
				$allowed =  array('jpg','jpeg' ,'png','JPG','PNG');
				//echo $mode;die();
				
				
				$link_name = $_FILES['txtReceipt']['name'];
					//echo $link_name;die;
					$old_date = explode(' ', $date); 
					$onlydate = $old_date[0];
					$onlydatearray = str_replace('-', '',$onlydate);
					$onlydate1 = $old_date[1];
					$onlydatearray1 = str_replace(':', '',$onlydate1);
					$datetimeconvert = $onlydatearray.'_'.$onlydatearray1;
					//echo $datetimeconvert;die;
					
					$dotcount = strrpos( $_FILES['txtReceipt']['name'], '.');
					$ext = substr( $_FILES['txtReceipt']['name'], 0,$dotcount);
					$replacewithunderscore = str_replace(' ', '_',$ext);
					$allspecialremove = preg_replace('/[^A-Za-z0-9\_]/', '', $replacewithunderscore);
					
					//$newdocname = $allspecialremove.'_'.$datetimeconvert;
					$newdocname = $allspecialremove;
					//echo $newdocname;die;
					
					$check = mime_content_type($_FILES['txtReceipt']['tmp_name']);
					if($check != 'image/jpeg' && $check != 'image/jpg' && $check != 'image/png' ) {
						return array('status'=>false, 'msg'=>"Invalid file type");
					}
					//$pdfFileType = end((explode(".", $_FILES['txtReceipt']['name'])));
					$doc_name= explode(".",$_FILES['txtReceipt']['name']);
					//print_r($doc_name);die;
					$pdfFileType = strtolower(end($doc_name));
					//echo $pdfFileType;die;
					/*$uploaddir = FCPATH.'/downloads/latest_info';
					$retrievedir = 'downloads/latest_info';*/
					//$uploaddir = DOCUMENT_UPLOAD_URL.'/'.$institute_code;
					//$retrievedir = BASE_ADM_URL.'/'.$institute_code;
					//$docPdfFileName = str_replace(' ', '_',$link_name);
					$docPdfFileName = str_replace(' ', '_',$newdocname);
					//echo $docPdfFileName;die;
					$docfilename = $docPdfFileName.'.'.$pdfFileType;
					//echo $docfilename;die;
					//$docPdfPath = $retrievedir."/".$docPdfFileName;
					$docPdfPath = $retrievedir."/".$docfilename;
					//echo $docPdfPath;die;
					/*echo $retrievedir;
					echo $docPdfFileName;
					die();*/
							
							
					/*if(!is_dir($uploaddir)){
						mkdir($uploaddir,0777,true);
					}*/
						
					$config['upload_path'] = $uploaddir; 
					/*print_r($config);
					die();*/
					//$config['file_name'] = str_replace(' ', '_',$link_name);
					$config['file_name'] = str_replace(' ', '_',$docfilename);
					$config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg|JPEG';
					$config['overwrite'] = TRUE;
						        
					$this->load->library('upload', $config);
					$this->upload->initialize($config);   
					
					if (!$this->upload->do_upload('txtReceipt'))
					{   	//echo 'if';die();
						$error = $this->upload->display_errors();
						$dbstatus = FALSE;
						$dbMessage = $error;
					}
					else
					{
						$this->db->select('appl_no');
						$this->db->from('challan_detail');
						$this->db->where('appl_no',$application_no);
						$result = $this->db->get();
						$check_user = $result->num_rows();
						if($check_user!=1){
							
								$new_data = array(
								//'id' =>$max_id,
								'appl_no' 			=>$application_no,
								'challan_code' 		=>$Referenceno,
								//'Date'			=>date('Y-m-d', strtotime($txtDate)),
								'bank_name'			=>$BankName,
								'challan_path'		=>$docPdfPath,
								//'institute_code'	=>$institute_code,
								'program_code'		=>$program_code,
								'created_by'		=>$reg_user_id,
								'created_on'		=>$date
								);
							$insert_challan =  $this->db->insert('challan_detail', $new_data);
							//echo $this->db->last_query();die;
							if( ! $insert_challan){
								$dbstatus = FALSE;
								$dbMessage = 'Error While Saving';
							}else{
								
								$update_data = array(
									//'id' =>$max_id,
									//'edit_status'		=>'0',
									'appl_status' 		=>'Payment Updated',
									'updated_by'		=>$reg_user_id,
									'updated_on'		=>$date
									);
								$this->db->where('appl_no',$application_no);
								$update_appl_status =  $this->db->update('applicant_appl_overview', $update_data);
							}
							
						}else {
								$new_data = array(
								//'id' =>$max_id,
								//'appl_no' 			=>$application_no,
								'challan_code' 		=>$Referenceno,
								//'Date'			=>date('Y-m-d', strtotime($txtDate)),
								'bank_name'			=>$BankName,
								'challan_path'		=>$docPdfPath,
								//'institute_code'	=>$institute_code,
								//'program_code'		=>$program_code,
								'updated_by'		=>$reg_user_id,
								'updated_on'		=>$date
								);
							$this->db->where('appl_no',$application_no);
							$insert_challan =  $this->db->update('challan_detail', $new_data);
							//echo $this->db->last_query();die;
							if( ! $insert_challan){
								$dbstatus = FALSE;
								$dbMessage = 'Error While Saving';
							}/*else{
								
								$update_data = array(
									//'id' =>$max_id,
									//'edit_status'		=>'0',
									'appl_status' 		=>'Payment Updated',
									'updated_by'		=>$reg_user_id,
									'updated_on'		=>$date
									);
								$this->db->where('appl_no',$application_no);
								$update_appl_status =  $this->db->update('applicant_appl_overview', $update_data);
							}*/
						}
						
						
					}
					
				return array('status' => $dbstatus, 'msg' =>$dbMessage);
				
			break;
			
			case 'submit_application':
				$dbstatus = TRUE;
				$dbMessage = 'Application Submitted Successfully';
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		//$ins =  encrypt_decrypt('decrypt', $data);
        		$update_data = array(
					'appl_status' 		=>'Application Submitted',
					'updated_by'		=>$reg_user_id,
					'updated_on'		=>$date
					);
				$this->db->where('appl_no',$application_no);
				$update_appl_status =  $this->db->update('applicant_appl_overview', $update_data);
				if( ! $update_appl_status){
					$dbstatus = FALSE;
					$dbMessage = 'Error While Saving';
				}
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
        		if($program_code == '' || $program_code == null )
        		{
					$data = $this->uri->uri_to_assoc();
					$program_code = $data['admcode'];
				}
        		$this->db->select('category,last_grade,payment_mode');
				$this->db->from('applicant_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('STATUS','1');
				$this->db->where('applied_program',$program_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$category = $row['category'];
					$payment_mode = $row['payment_mode'];
				}
        		
        		if($payment_mode == 'Online')
        		{
					$this->db->select('payment_mode,description');
					$this->db->from('payment_mode_setup P');
					$this->db->join('gen_code_description G','P.payment_mode = G.code','inner');
					$this->db->where('P.institute_code',$ins);
					$this->db->where('P.record_status','1');
					$this->db->where('code_group','PAYMENT_MODE');
					$this->db->where('payment_mode!=','CHALLAN');
					$this->db->order_by('P.sl_no');
					$result = $this->db->get();
				}
				else
				{
					$this->db->select('payment_mode,description');
					$this->db->from('payment_mode_setup P');
					$this->db->join('gen_code_description G','P.payment_mode = G.code','inner');
					$this->db->where('P.institute_code',$ins);
					$this->db->where('P.record_status','1');
					$this->db->where('code_group','PAYMENT_MODE');
					$this->db->where('payment_mode!=','ONLINE');
					$this->db->order_by('P.sl_no');
					$result = $this->db->get();
				}
        		
				
				return $result->result_array();
			break;
			case 'get_PWD_type_data':
				$program_code = $data;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.code, A.description");
				$this->db->from('gen_code_description A');
				$this->db->where('A.code_group','PWD_TYPE');
				$this->db->where('A.record_status',1);
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_quota_data':
				$program_code = $data;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.code, A.description");
				$this->db->from('gen_code_description A');
				$this->db->where('A.code_group','QUOTA');
				$this->db->where('A.record_status',1);
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_applicant_documents':	
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$this->db->select('afd.appl_no,doc_id,document_path,dtm.document_type');
				$this->db->from('applicant_form_documents afd');
				$this->db->join('applicant_appl_overview','afd.appl_no=applicant_appl_overview.appl_no','inner');
				$this->db->join('document_type_master dtm','afd.document_type = dtm.document_type_code','inner');
				$this->db->where('afd.status',1);
				$this->db->where('applicant_appl_overview.reg_user_id',$reg_user_id);
				$this->db->where('applicant_appl_overview.applied_program',$program_code);
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
			case 'category_amount_change': 
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
			case 'extra_amount':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				
				$this->db->select('fee,extra_fee');
				$this->db->from('applicant_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program_code);
				$result = $this->db->get();
				
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
        		if($program_code == '' || $program_code == null )
        		{
					$data = $this->uri->uri_to_assoc();
					$program_code = $data['admcode'];
				}
        		
        		$this->db->select('category,last_grade,physically_challenged,nationality,is_north_east');
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
					$is_north_east = $row['is_north_east'];
				}
				if($nationality == 'OTH')
				{
					$cat_val = 'OTH';
					$this->db->select('3350 AS amount');
					$result = $this->db->get();
				}
				else if($is_north_east == 'Yes'){
					$cat_val = $category;
					$this->db->select('0 AS amount');
					$result = $this->db->get();
				}
				else
				{
					$cat_val = $category;
					$this->db->select('amount');
					$this->db->from('program_fee_setup');
					$this->db->where('category_code',$cat_val);
					$this->db->where('program_code',$program_code);
					$result = $this->db->get();
					
				}
				//print_r($result->result_array()); die();
				//echo $this->db->last_query(); die();
				return $result->result_array();
			break;
			case 'reeval_amount':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$data = $this->uri->uri_to_assoc();
				$institute = $data['ins'];
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		
        		$this->db->select('category,last_grade,physically_challenged,nationality,is_north_east');
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
					$is_north_east = $row['is_north_east'];
				}
				if($nationality == 'OTH')
				{
					$cat_val = 'OTH';
					$this->db->select('3350 AS amount');
					$result = $this->db->get();
				}
				else if($is_north_east == 'Yes'){
					$cat_val = $category;
					$this->db->select('0 AS amount');
					$result = $this->db->get();
				}
				else
				{
					$cat_val = $category;
					$this->db->select('amount');
					$this->db->from('reeval_fee_setup');
					$this->db->where('category_code',$cat_val);
					$this->db->where('program_code',$program_code);
					$result = $this->db->get();
					
				}
				//print_r($result->result_array()); die();
				//echo $this->db->last_query(); die();
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
        		if($program_code == '' || $program_code == null )
        		{
					$data = $this->uri->uri_to_assoc();
					$program_code = $data['admcode'];
				}
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
			case 'reeval_update_reg_mode':
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
					$this->db->from('reeval_fee_setup');
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
        		if($program_code == '' || $program_code == null )
        		{
					$data = $this->uri->uri_to_assoc();
					$program_code = $data['admcode'];
				}
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
				
				return $result->result_array();
			break;
			case 'reeval_bank_detail':
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
				$this->db->from('reeval_fee_setup');
				$this->db->where('category_code',$category);
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				
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
			case 'get_bankdetail':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				
				$this->db->select('bank_code,bank_name');
				$this->db->from('bank_details');
				$this->db->where('record_status','1');
				$result = $this->db->get();
				return $result->result_array();
			break;	
			case 'get_challanData':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				
				$this->db->select('depositdate,challan_number,bank_code,bank_branch');
				$this->db->from('applicant_form_challan_deposit');
				$this->db->where('appl_no',$application_no);
				$this->db->where('status','1');
				$result = $this->db->get();
				return $result->result_array();
			break;	
			case 'add_payment_data':
				
				$reg_user_id_session = isset($_POST['hidRegUserId']) ? $_POST['hidRegUserId'] : '';
				$regUser = $this->session->userdata('reg_user_id');
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$amount = '';
				$index = '';
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
				$program_name = '';
				$this->db->select('program_name');
				$this->db->from('program_master');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$program_name = $row['program_name'];
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
					
					$result =  $this->db->query("SELECT GET_LOCK('lockindexnumber',5) AS locked");
						//$res = $this->db->get();
		                $query = $result->result_array();
		                foreach ($query as $row) 
		                {
		                   	$locked = $row['locked'];
		                }
		                if($locked == 1)
						{
							/*$this->db->select('A.program_code,A.year,sequence_code,sequence_no');
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
							$regUpdate = $this->db->update('index_sequence_setup',$applicant_appl_overview);*/
								$this->db->select('A.program_code,A.year,sequence_code,sequence_no,D.advtn_seq_no,B.program_group_code,program_sl_no');
								$this->db->from('program_master A');
								$this->db->join('program_group_master B','A.program_group = B.program_group_code','left');
								$this->db->join('index_sequence_setup C','A.program_code = C.program_code','left');
								$this->db->join('advertisement_master D','A.advt_no = D.advt_no','left');
								$this->db->where('A.program_code',$program_code);
								$result = $this->db->get();
								//echo $this->db->last_query();die();
								$output_data = $result->result_array();
								foreach ($output_data as $row1) 
						        {
						        	$year = $row1['year'];
									$year_str = substr($year,'-2');
									$group_code = $row1['program_group_code'];
									$group_code_explode = explode("/",$group_code);
									$program_group_code = substr($group_code_explode[0],'-2');
									$advtn_seq_no = $row1['advtn_seq_no'];
									$program_sl_no = $row1['program_sl_no'];
									$sequence_no = $row1['sequence_no'];
									$key = $row1['sequence_code'];
						        }
						        
								if($sequence_no < 10)
								$changed_sl_no = '00000'.$sequence_no;
								else if($sequence_no < 100)
									$changed_sl_no = '0000'.$sequence_no;
								else if($sequence_no < 1000)
									$changed_sl_no = '000'.$sequence_no;
								else if($sequence_no < 10000)
									$changed_sl_no = '00'.$sequence_no;
								else if($sequence_no < 100000)
									$changed_sl_no = '0'.$sequence_no;
									
								
							$index_no = $year_str.$program_group_code.$advtn_seq_no.$program_sl_no.$changed_sl_no;//YEAR+PROGRAMGROUPCODE(DRIVE)+ADVERTISEMENT SERIALNO+POST SEQUENCE NO+ SERIAL NO(FORMAT OF APPLICATION NO)
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
									'updated_on' => $date
								);
								$this->db->where('appl_no',$application_no);
								$regUpdate = $this->db->update('applicant_appl_overview',$applicant_appl_overview);
							}
							
						}

						$result =  $this->db->query("SELECT RELEASE_LOCK('lockindexnumber')");
					
					
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
					
					$round = 0;
					$this->db->select('COUNT(appl_no) AS appl_no');
					$this->db->from('admitcard_round_data');
					$this->db->where('appl_no',$application_no);
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('round_no','1');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach($output_data as $row)
					{
						$round = $row['appl_no'];
					}
					if($round == 0)
					{
						$new_data1 = array(
		                    'appl_no' =>$application_no,
		                    'round_no' =>'1',
		                    'program_code' =>$program_code,
		                    'reg_user_id' => $reg_user_id,
		                    'created_by' => $reg_user_id,
		                    'created_on' => $date
		               	);   
			            $new_data_insert = $this->db->insert("admitcard_round_data",$new_data1); 	
			            //echo $this->db->last_query();die();
						if(!$new_data_insert)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting admitcard_round_data';
						}
						
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
					
					
					$controllerInstance = & get_instance();
        			$return = $controllerInstance->$print_function();
        			
					if($return == true)
					{
        			
						if(file_exists(DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$program_code.'/'.$application_no.'/application_print.pdf'))
						{
							
							$this->db->trans_complete();
							
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
							$this->db->where('pes.institute_code',$insCode);
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
							if($row_count > 0)
							{
								if($email != '')
								{
									$this->load->library('email');
									
									$body = "You have successfully Registered with mobile no as $phone_no and date of birth as $dob for $admName program.";
									$txtSubject = "Registration Successful";
									
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
									$this->email->from($email_id, 'REGISTRATION 2018');
									$this->email->to($email); 

									$this->email->subject($subject);
									$find = array("[name]","[phone_no]","[dob]");
									$replace = array($name,$phone_no,$dob_mail);
									$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url

									$this->email->message($email_content);
									//$this->email->message($body);  

									$this->email->send();

									
									if($this->email->send()){
									    $dbStatus = TRUE; 
									    $dbMessage = 'A mail is forwarded to your registered mail id  ';
								    }
								    else{
									    $dbStatus = FALSE; 
									    $dbMessage = 'Unable to sent Mail.Please Contact for Support';
								    }
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
								$findappl = array("[program_code]", "[dob]");
								$replaceappl = array($program_name,$dob_mail);
								//echo $content."<br>";
								$new_content = str_replace($findappl, $replaceappl, $content);
								$messageToSend = rawurlencode($new_content);
								//echo $new_sms_url."<br>";
								//echo $new_content."<br>";
								//echo $messageToSend;
								
								//find replace url with mobileno and message
								$findmobileNo = array("[mobileno]","[message]","[username]","[password]","[sender]");
								$replacemobileNo = array($reg_user_id,$messageToSend,$user_name,$password,$sender);
								$smsURL = str_replace($findmobileNo,$replacemobileNo,$sms_url);	
					        }
					         $arrContextOptions=array(
							    "ssl"=>array(
							        "verify_peer"=>false,
							        "verify_peer_name"=>false,
							    ),
							);  

							$response = file_get_contents($smsURL, false, stream_context_create($arrContextOptions));
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
						$this->db->trans_rollback();
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
									$print_function = $temp_name[0]."_pdf";
									$print_file_name = $temp_name[0]."pdf.php";
								}
							}
							$return = $print_function();
							if($return == true)
							{
								if(file_exists(DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$program_code.'/'.$application_no.'/application_print.pdf'))
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
				/*echo $dbstatus;
				echo $dbmessage;
				die();*/
						$page_url = $_SERVER["HTTP_REFERER"];
						$ip_address = $_SERVER['REMOTE_ADDR'];
						$log_status = $dbstatus;
						$log_message = $dbmessage;
						$this->log_detail_record($page_url, $log_status, $log_message, $ip_address);
				return array('status' => $dbstatus, 'msg' =>$dbmessage);
			break;	
			case 'reeval_add_payment_data':
				
				$reg_user_id_session = isset($_POST['hidRegUserId']) ? $_POST['hidRegUserId'] : '';
				$regUser = $this->session->userdata('reg_user_id');
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
				$this->db->from('reeval_fee_setup');
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
					//echo $this->db->last_query();
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
					$this->db->from('reeval_form_fee_overview');
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
		           	 $this->db->update("reeval_form_fee_overview",$update_data); 
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
			            $this->db->insert("reeval_form_fee_overview",$new_data); 
			            if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting';
						}
					}
					
		            $update_data = array(
		                    'reeval_status' =>'Verified',
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
		                    'reeval_status' => 'Verified',
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
					
					
					$controllerInstance = & get_instance();
        			$return = $controllerInstance->$print_function();
        			
        			
					if($return == true)
					{
						if(file_exists(DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$program_code.'/'.$application_no.'/application_print.pdf'))
						{
							$this->db->trans_complete();
							
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
							$this->db->where('es.email_type','ANSWER_KEY_CHALLENGE');
							$this->db->where('pes.institute_code',$insCode);
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
							if($row_count > 0)
							{
								//echo 'hi';
								if($email != '')
								{
									$this->load->library('email');

									//$email_id
									$config['protocol']    = 'smtp';
									$config['smtp_host']    = $host_name; //'smtp.gmail.com'; //'ssl://smtp.gmail.com';
									$config['smtp_port']    = $port_no; //'465';
									$config['smtp_timeout'] = '50';
									$config['smtp_user']    = $email_id;// "testedusols@gmail.com";
									$config['smtp_pass']    = $password; //"edusols12345";
									$config['charset']    = 'utf-8';
									$config['newline']    = "\r\n";
									$config['mailtype'] = 'html'; // or text
									$config['validation'] = TRUE; // bool whether to validate email or not   
									$this->email->initialize($config);
									$this->email->from($email_id, 'REGISTRATION 2018');
									$this->email->to($email); 

									$this->email->subject($subject);
									
									$find = array("[name]","[phone_no]","[dob]");
									$replace = array($name,$phone_no,$dob_mail);
									$email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url

									$this->email->message($email_content);  

									//$this->email->send();
									//print_r($this->email->send());
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
								}
							}
							
							$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
							$this->db->from('sms_provider_setup A');
							$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
							$this->db->where('B.record_status','1');
							$this->db->where('A.record_status','1');
							$this->db->where('B.sms_type','ANSWER_KEY_CHALLENGE');
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
								$findappl = array("[phone_no]", "[dob]");
								$replaceappl = array($phone_no,$dob_mail);
								//echo $content."<br>";
								$new_content = str_replace($findappl, $replaceappl, $content);
								$messageToSend = rawurlencode($new_content);
								//echo $new_sms_url."<br>";
								//echo $new_content."<br>";
								//echo $messageToSend;
								
								//find replace url with mobileno and message
								$findmobileNo = array("[mobileno]","[message]","[username]","[password]","[sender]");
								$replacemobileNo = array($reg_user_id,$messageToSend,$user_name,$password,$sender);
								$smsURL = str_replace($findmobileNo,$replacemobileNo,$sms_url);	
					        }
					        $arrContextOptions=array(
							    "ssl"=>array(
							        "verify_peer"=>false,
							        "verify_peer_name"=>false,
							    ),
							);  

							$response = file_get_contents($smsURL, false, stream_context_create($arrContextOptions));
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
						$this->db->trans_rollback();
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
				            $this->db->from("reeval_fee_setup"); 	
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
				            $this->db->from("reeval_form_fee_overview"); 	
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
						            $this->db->insert("reeval_form_fee_overview",$update_data); 	
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
						            $this->db->insert("reeval_form_fee_overview",$new_data); 	
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
			                    'reeval_status' =>'Fee Paid',
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
			                    'reeval_status' =>'Fee Paid',
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
									$print_function = $temp_name[0]."_pdf";
									$print_file_name = $temp_name[0]."pdf.php";
								}
							}
							$return = $print_function();
							if($return == true)
							{
								if(file_exists(DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$program_code.'/'.$application_no.'/application_print.pdf'))
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
							$this->db->from('reeval_fee_setup');
							$this->db->where('program_code',$program_code);
							$this->db->where('category_code',$category);
							$result = $this->db->get();
							$output_data = $result->result_array();
							foreach($output_data as $row_amt)
							{
								$amount = $row_amt['amount'];
							}
							
							
							$this->db->select("count(appl_no) AS appl_no");
							$this->db->from('reeval_form_fee_overview');
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
									$sql = $this->db->update('reeval_form_fee_overview', $update_data);
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
									$sql = $this->db->insert('reeval_form_fee_overview', $new_data);
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
								'reeval_status' 					=>'Fee Paid',
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
								'reeval_status' 				=>'Fee Paid',
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
						$page_url = $_SERVER["HTTP_REFERER"];
						$ip_address = $_SERVER['REMOTE_ADDR'];
						$log_status = $dbstatus;
						$log_message = $dbmessage;
						$this->log_detail_record($page_url, $log_status, $log_message, $ip_address);
				return array('status' => $dbstatus, 'msg' =>$dbmessage);
			break;
			
			// ****************************************************** Santhoshi *************************************************************//
			
			case 'get_program_group_status':
				$ins =  encrypt_decrypt('decrypt', $data);
				//echo  $ins ; die();
				if($ins == '0') 
					$ins = '';
				$reg_user_id = $this->session->userdata('reg_user_id');
				$this->db->distinct('program_group_code');
				//$this->db->select('program_group_code,program_group_name,A.sl_no,GROUP_CONCAT(program_start_date) AS program_start_date,GROUP_CONCAT(program_end_date) AS program_end_date,GROUP_CONCAT(program_code) AS program_code,GROUP_CONCAT(program_name SEPARATOR "`") AS program_name');
				$this->db->select('program_group_code,program_group_name,GROUP_CONCAT(IFNULL(ap.record_status, "0")) AS record_status,A.sl_no,GROUP_CONCAT(program_start_date) AS program_start_date,GROUP_CONCAT(program_end_date) AS program_end_date,GROUP_CONCAT(B.program_code) AS program_code,GROUP_CONCAT(program_name SEPARATOR "`") AS program_name,GROUP_CONCAT(IFNULL(C.appl_status,"-") SEPARATOR "@") AS appl_status');
				$this->db->from('program_group_master A');
				$this->db->join('program_master B','A.program_group_name = B.program_group','left');
				$this->db->join('applicant_appl_overview C','B.program_code = C.applied_program AND C.reg_user_id = '.$reg_user_id,'left');
				$this->db->join('admitcard_published ap','`ap`.`appl_no` = `C`.`appl_no`','left');
				$this->db->where('B.institute_code',$ins);
				$this->db->where('A.record_status',1);
				$this->db->where('B.publish_status','YES');
				$this->db->where('program_group_name !=','Default Program');
				$this->db->group_by('A.program_group_code');
				$this->db->order_by('A.sl_no');
				$this->db->save_queries = TRUE;
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
				//print_r($result);
				return $result->result_array();
			break;
			// ********************************************************* Result **************************************************************************//
			
			/*case 'get_reeval_status':
				$reg_user_id = $this->session->userdata('reg_user_id');
				$program_code = $this->session->userdata('admcode');
				$this->db->select('appl_no,appl_status,reeval_status');
				$this->db->from('applicant_appl_overview A');
				$this->db->where('A.reg_user_id',$reg_user_id);
				$this->db->where('A.applied_program',$program_code);
				$result = $this->db->get();
				
				return $result->result_array();
			break;*/
			case 'get_program_modal_data':
				$reg_user_id = $this->session->userdata('reg_user_id');
				$program_code = isset($_POST['pro_code']) ? $_POST['pro_code'] : '';
				
				$appl_status = '';
				$ins = isset($_POST['hidInsCode']) ? $_POST['hidInsCode'] : '';
				$institute =  encrypt_decrypt('decrypt', $ins);
				$base_url =  base_url();
				$base_adm_url =  BASE_ADM_URL;
				
				$menus = array();
				$scanned_copy_count = array();
				$result_data = array();
				$appl_no = '';
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$this->db->select('dob');
				$this->db->from('applicant_reg_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$appl_dob = $row['dob'];
				}
				
        		$this->db->select('appl_no,appl_status,reeval_status');
				$this->db->from('applicant_appl_overview A');
				$this->db->where('A.reg_user_id',$reg_user_id);
				$this->db->where('A.applied_program',$program_code);
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$reeval_status = $row['reeval_status'];
					$appl_status = $row['appl_status'];
					$appl_no = $row['appl_no'];
				}
				
				$this->db->select('A.menu_code,link_text,link_url,file_name');
				$this->db->from('program_menu_master A');
				$this->db->join('program_menu_setup B','B.menu_code = A.menu_code','left');
				$this->db->where('program_code',$program_code);
				$this->db->where('show_status','1');
				$this->db->where('is_document_upload','Yes');
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$menus[] = $row;
				}
				
				$admit_record_status = 0;
				
				$this->db->select('exam_center_code,exam_vanue_code,IFNULL(ap.record_status, "0") AS record_status, `as`.`template_code`, `E`.`template_name`');
				$this->db->from('admitcard_published ap');
				$this->db->join('admitcard_setup as','`ap`.`applied_program` = `as`.`program_code`','left');
				$this->db->join('`admitcard_template_master` `E`','`E`.`template_code` = `as`.`template_code`','left');
				$this->db->where('`ap`.`applied_program`',$program_code);
				$this->db->where('`ap`.`appl_no`',$appl_no);
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$admit_record_status = $row['record_status'];
					$admit_template_name = $row['template_name'];
					$exam_center_code = $row['exam_center_code'];
					$exam_vanue = $row['exam_vanue_code'];
				}
				
				$this->db->select("appl_no,file_path,file_name");
				$this->db->from('upload_scanned_copies');
				$this->db->where('appl_no',$appl_no);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
	            	$scanned_copy_count[] = $aRow; 
	            }
				
				$this->db->select("applicant_name,applicant_id,B.appl_no,field,value");
				$this->db->from('applicant_exam_result A');
				$this->db->join('admitcard_published B','A.applicant_id = B.omr_no and A.program_code = B.applied_program','left');
				$this->db->where('appl_no',$appl_no);
				$this->db->where('applied_program',$program_code);
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
	            	$result_data[] = $aRow; 
	            }
				
				
				$this->db->select('C.appl_no,A.program_code,program_name,apply_start_date,apply_end_date,program_start_date,program_end_date,birth_start_date,birth_end_date,program_desc,program_duration,C.appl_status,A.template_code,D.template_name');
				$this->db->from('program_master A');
				$this->db->join('program_eligibility_setup B','B.program_code = A.program_code','left');
				$this->db->join('applicant_appl_overview C','B.program_code = C.applied_program AND C.reg_user_id = '.$reg_user_id,'left');
				$this->db->join('form_template_master D','D.template_code = A.template_code','left');
				$this->db->where('A.program_code',$program_code);
				
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					//$program_code = $row['applied_program'];
					$program_name = $row['program_name'];
					$program_desc = $row['program_desc'];
					$program_duration = $row['program_duration'];
					$template_name = $row['template_name'];
					$apply_start_date = $row['apply_start_date'];
					$apply_end_date = $row['apply_end_date'];
					$A = $row['birth_start_date'];
					$B = $row['birth_end_date'];
				}
				$pro = explode("_", $program_code);
				//$pro = str_split('_');
				$pro_code = $pro[0];
				$this->session->set_userdata('admcode', $program_code);
 				$date1 = $A;
				$date2 = $date;

				$diff = abs(strtotime($date2) - strtotime($date1));

				$birth_start_date = floor($diff / (365*60*60*24));
				
				$date11 = $B;
				$date21 = $date;

				$diff1 = abs(strtotime($date21) - strtotime($date11));

				$birth_end_date = floor($diff1 / (365*60*60*24));
				
				if($birth_start_date == $birth_end_date)
				{
					$age = $birth_start_date.' years';
				}
				else if($birth_start_date != $birth_end_date)
				{
					$age = $birth_end_date.' to '.$birth_start_date.' years';
				}
				else
				{
					$age = 'No Age Bar';
				}
				
				$html = '';
				$html .= '<div class="panel panel-primary">
							<div class="panel-heading" style="height: 40px;">
								<center><p style="font-family:sans-serif; font-size:15px;"><b>Opening Details</b></p></center>
							</div>
							<div class="panel-body">
							<h5 style="font-family:sans-serif; ">&nbsp;&nbsp;&nbsp;<b> Program Name : </b> '.$program_name. ' <br />
							<h5 style="font-family:sans-serif; ">&nbsp;&nbsp;&nbsp;<b> Program Code : </b> '.$pro_code. ' <br />
							<h5 style="font-family:sans-serif; ">&nbsp;&nbsp;&nbsp;<b> Age Criteria : </b> '.$age. ' <br />
							<h5 style="font-family:sans-serif; ">&nbsp;&nbsp;&nbsp;<b> Description : </b> '.$program_desc.'<br />
							<hr />';
				/*$html .= '<h5 style="font-family:sans-serif; ">&nbsp;&nbsp;&nbsp;<b> Duration : </b> '.$program_duration. ' <br />';*/
				if(sizeof($menus) >= 1)
				{
					$html .= '<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;  margin-top: 35px; margin-bottom:30px; ">
									<h5 style="margin-top: -6px;"><u><b> Important Links </b></u> </h3>
									<div class="row">
										<div class="form-group">
											<div class="col-sm-12" align="justify">';
							foreach($menus as $row)
							{
					$html .= '<br />
								 <a href="'.$base_url.''.$row['link_url'].'/'.$row['file_name'].'/'.$program_code.'">&raquo;  <span style="color:red">'.$row['link_text'].'<br/></style></a>
							';				
							}
					$html .= '					</div>
											</div>
										</div>
									</div>	';
				}
				
					$html .= '<b>Current Application Status : </b><br />';	
						if($apply_start_date <= $date && $apply_end_date >= $date)
						{
							if($appl_status == '' || $appl_status == null)
							{
								if($appl_dob < $A || $appl_dob > $B)
								{
				$html .= '<br />
							<a href="'.$base_url.'apply/'.$template_name.'/ins/'.$ins.'">	<button  style="font-family:sans-serif; " type="button" class="btn btn-warning" id="btnProceed">
							  <i class="fa fa-edit"></i>Apply Now
						    </button> </a>';							
								}
								else
								{
				$html .= '<br />
							<a href="'.$base_url.'apply/'.$template_name.'/ins/'.$ins.'">	<button  style="font-family:sans-serif; " type="button" class="btn btn-warning" id="btnProceed">
							  <i class="fa fa-edit"></i><center>You are not eligible to apply this program.</center>
						    </button> </a>';					
								}
								
							}
							else if($appl_status == 'Fee Paid' || $appl_status == 'Verified')
							{
								$temp_name = $template_name.'_pdf';
								if($admit_record_status == 1)
								{
									$admit_temp_name = "admit_card_".$admit_template_name;
				$html .= '<br /><center>
							 <a href="'.$base_url.'mpdf_controller/'.$temp_name.'/reg_user_id/'.$reg_user_id.'/program/'.$program_code.'">	<button style="font-family:sans-serif; " type="button" class="btn btn-success" id="btnProceed">
							  <i class="fa fa-print"></i>	Print Application
						    </button></a>&nbsp;&nbsp;&nbsp;
							<a href="'.$base_url.'apply/'.$admit_temp_name.'/'.$exam_center_code.'/'.$exam_vanue.'/'.$program_code.'/'.$institute.'">	<button style="font-family:sans-serif; " type="button" class="btn btn-warning" id="btnProceed">
							  <i class="fa fa-print"></i>	Print Admit Card
						    </button></a></center>
						   ';								
								}
								else
								{
				$html .= '<br /><center>
							<a href="'.$base_url.'mpdf_controller/'.$temp_name.'/reg_user_id/'.$reg_user_id.'/program/'.$program_code.'">	<button style="font-family:sans-serif; " type="button" class="btn btn-success" id="btnProceed">
							  <i class="fa fa-print"></i>	Print Application
						    </button></a></center>';							
								}	
								
								if(sizeof($result_data) >= 1)
								{
									foreach($result_data as $row)
									{
										$status = $row['field'];
										if($status == 'Selected')
										{
											$html .= '<br />
												<center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$base_url.'apply/result_html/'.$program_code.'/'.$ins.'" target="_blank"> <button type="button" class="btn btn-info"><i class="fa fa-info-circle"></i>	View Result</button></a>&nbsp;&nbsp;&nbsp;
												 <button type="button" class="btn btn-danger" onclick="openForm();" >Upload Document</button><br /><br /></center>
											';
										}
										else
										{
											if($reeval_status == 'Fee Paid' || $reeval_status == 'Verified')
											{
												$html .= '<br />
													 <center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$base_url.'apply/result_html/'.$program_code.'/'.$ins.'" target="_blank"> <button type="button" class="btn btn-info"><i class="fa fa-info-circle"></i>	View Result</button></a>&nbsp;&nbsp;&nbsp;
													 <button style="font-family:sans-serif; " type="button" class="btn btn-primary" disabled>Apply Exam Copy</button><br /><br /></center>
												';
											}
											else
											{
												$html .= '<br />
													 <center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$base_url.'apply/result_html/'.$program_code.'/'.$ins.'" target="_blank"> <button type="button" class="btn btn-info"><i class="fa fa-info-circle"></i>	View Result</button></a>&nbsp;&nbsp;&nbsp;
													 <a href="'.$base_url.'apply/reeval_'.$template_name.'/ins/'.$ins.'"> <button style="font-family:sans-serif; " type="button" class="btn btn-primary">Apply Exam Copy</button></a><br /><br /></center>
												';
											}
											if(sizeof($scanned_copy_count) >= 1)
											{
												foreach($scanned_copy_count as $row)
												{
													$html .= '
														 <center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$base_adm_url.'/DOCUMENTS/'.$program_code.'/'.$appl_no.'/'.$row['file_name'].'" target="_blank"> <button style="font-family:sans-serif; " type="button" class="btn btn-danger"><i class="fa fa-print"></i>	Scan sheet of Exam Copy</button></a></center><br /><br />
													';	
												}
											}	
										}
										
										
									}
									
								}
							}
							else
							{
				$html .= '<br />
							<a href="'.$base_url.'apply/'.$template_name.'/ins/'.$ins.'">	<button type="button" class="btn btn-warning" id="btnProceed">
							  <i class="fa fa-edit"></i>	Not Completed
						    </button></a>';					
							}
						
						}
				$html .= '</div></div>';
				return array('html' => $html );
			break;
			
			case 'result_html':
				$reg_user_id = $this->session->userdata('reg_user_id');
				$program_code = isset($data['program']) ? $data['program'] : '';
				
				$appl_status = '';
				$ins = isset($data['institute']) ? $data['institute'] : '';
				$institute =  encrypt_decrypt('decrypt', $ins);
				$base_url =  base_url();
				$base_adm_url =  BASE_ADM_URL;
				
				$menus = array();
				$scanned_copy_count = array();
				$result_data = array();
				$appl_no = '';
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		
        		$this->db->select('appl_no,appl_status,reeval_status');
				$this->db->from('applicant_appl_overview A');
				$this->db->where('A.reg_user_id',$reg_user_id);
				$this->db->where('A.applied_program',$program_code);
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$reeval_status = $row['reeval_status'];
					$appl_status = $row['appl_status'];
					$appl_no = $row['appl_no'];
				}
				
				
				$this->db->select("applicant_name,applicant_id,B.appl_no,result as field,total_mark as value");
				$this->db->from('applicant_exam_result A');
				$this->db->join('admitcard_published B','A.applicant_id = B.omr_no and A.program_code = B.applied_program','left');
				$this->db->where('appl_no',$appl_no);
				$this->db->where('applied_program',$program_code);
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
				$output_data = $result->result_array();
				foreach ($output_data as $Row) 
	            {
	            	$result_data[] = $Row; 
	            	
	            }
	            $this->db->select('C.appl_no,A.program_code,program_name');
				$this->db->from('program_master A');
				//$this->db->join('program_eligibility_setup B','B.program_code = A.program_code','left');
				$this->db->join('applicant_appl_overview C','A.program_code = C.applied_program','left');
				//$this->db->join('form_template_master D','D.template_code = A.template_code','left');
				$this->db->where('A.program_code',$program_code);
				
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					//$program_code = $row['applied_program'];
					$program_name = $row['program_name'];
					
				}
				$html = '';
				if(sizeof($result_data) >= 1)
				{
					foreach($result_data as $row)
					{
						$html .= '<div class="panel panel-primary">
				        	   			<div class="jumbotron" style="height:8%">
					      					<h2 style="font-family:CenturyGothic, AppleGothic, sans-serif;margin-top:-3%"><b>'.$program_name.'</b></h2>
					        			</div>
				        				
					        				<table style="font-size:24px;margin-left:12%;margin-top:-10% ">
					        					<tr>
											        <td style="width:40% "><b>Name</b> </td>
											        <td style="width:20% "><b> :</b></td>
											        <td style="width:40%">'.$row['applicant_name'].'</td><br />
											    </tr> 
											    <tr>
											    	<td style="width:40% "><b>Roll No</b> </td>
											        <td style="width:20% "><b> :</b></td>
											        <td style="width:40%">'.$row['applicant_id'].'</td><br />
											    </tr>  
											    <tr>
											    	<td style="width:40% "><b>Appl No</b> </td>
											        <td style="width:20% "><b> :</b></td>
											        <td style="width:40%">'.$row['appl_no'].'</td><br />
											    </tr> 
											</table><br />
										
								        <div class="jumbotron" style="height:8%;">
				      						<h2 style="font-family:CenturyGothic, AppleGothic, sans-serif;margin-top:-3% ">Result Details</h2>
				        				</div></br></br></br>
				        				
									        <table style="font-size:25px;margin-top:-14%">
					        					<tr>
											        <td style="width:18%"><b>Mark</b> </td>
											        <td style="width:20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> :</b>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;</td>
											        <td style="width:30%">'.$row['value'].'</td>
											    </tr><br /> 
											    <tr>
											    	<td><b>Result</b> </td>
											        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> :</b>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</td>
											        <td>'.$row['field'].'</td>
											    </tr> 
											</table>  <br />
									  
									</div>
									<a href="'.$base_url.'apply/result_pdf/'.$program_code.'/'.$ins.'">	
      								<button style="font-family:sans-serif; " type="button" class="btn btn-warning" id="btnProceed">
									<i class="fa fa-print"></i>	Print</button></a><br /><br />';
					}
				}
				return array('html' => $html);
			break;
		// *********************************************************End of result query**************************************************************************//
			case 'get_tech_qual_data_5_temp':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("*");
				$this->db->from('applicant_tech_qual_temp');
				$this->db->where('applicant_tech_qual_temp.applied_program',$program_code);
				$this->db->where('applicant_tech_qual_temp.reg_user_id',$reg_user_id);
				$this->db->where('applicant_tech_qual_temp.sl_no','5');
				$result = $this->db->get();
				//echo $this->db->last_query();
				return $result->result_array();
			break;
			
			case 'get_tech_qual_data_6_temp':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("*");
				$this->db->from('applicant_tech_qual_temp');
				$this->db->where('applicant_tech_qual_temp.applied_program',$program_code);
				$this->db->where('applicant_tech_qual_temp.reg_user_id',$reg_user_id);
				$this->db->where('applicant_tech_qual_temp.sl_no','6');
				$result = $this->db->get();
				//echo $this->db->last_query();
				return $result->result_array();
			break;
			case 'get_tech_qual_data_5':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("qual_desc_1,year,institute_name,thesis,stream,affiliation_from,remark,applicant_technical_qualification_detail.subjects_offered,grade_cgpa,division");
				$this->db->from('applicant_technical_qualification_detail');
				$this->db->join('applicant_master','applicant_master.reg_user_id = applicant_technical_qualification_detail.reg_user_id','inner');
				$this->db->where('applicant_technical_qualification_detail.applied_program',$program_code);
				$this->db->where('applicant_technical_qualification_detail.reg_user_id',$reg_user_id);
				$this->db->where('applicant_technical_qualification_detail.sl_no','5');
				$result = $this->db->get();
				//echo $this->db->last_query();
				return $result->result_array();
			break;
			
			case 'get_tech_qual_data_6':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("qual_desc_1,year,institute_name,thesis,stream,affiliation_from,remark,applicant_technical_qualification_detail.subjects_offered,grade_cgpa,division");
				$this->db->from('applicant_technical_qualification_detail');
				$this->db->join('applicant_master','applicant_master.reg_user_id = applicant_technical_qualification_detail.reg_user_id','inner');
				$this->db->where('applicant_technical_qualification_detail.applied_program',$program_code);
				$this->db->where('applicant_technical_qualification_detail.reg_user_id',$reg_user_id);
				$this->db->where('applicant_technical_qualification_detail.sl_no','6');
				$result = $this->db->get();
				//echo $this->db->last_query();
				return $result->result_array();
			break;
			
			case 'get_tech_qual_data_7':
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("qual_desc_1,year,institute_name,thesis,stream,affiliation_from,remark,applicant_technical_qualification_detail.subjects_offered,grade_cgpa,division");
				$this->db->from('applicant_technical_qualification_detail');
				$this->db->join('applicant_master','applicant_master.reg_user_id = applicant_technical_qualification_detail.reg_user_id','inner');
				$this->db->where('applicant_technical_qualification_detail.applied_program',$program_code);
				$this->db->where('applicant_technical_qualification_detail.reg_user_id',$reg_user_id);
				$this->db->where('applicant_technical_qualification_detail.sl_no','7');
				$result = $this->db->get();
				//echo $this->db->last_query();
				return $result->result_array();
			break;
			case 'want_program_group':
				$ins =  encrypt_decrypt('decrypt', $data);
				if($ins == '0') 
					$ins = '';
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s",now());
        		$reg_user_id = $this->session->userdata('reg_user_id');
				$this->db->select("`code_group`,`code`,`description`");
				$this->db->from('gen_code_description');
				$this->db->where('institute_code',$ins);
				$this->db->where('code_group','PG_GROUP');
				$this->db->where('code','PG_GROUP');
				
				//print_r($query);
				$result = $this->db->get();
				/*echo $this->db->last_query(); die();
				die();*/
				
				return $result->result_array();
			break;
			
			case 'get_select_choice_details':
				$institute_code = $this->session->userdata('institute_code');	
				$program_code = $this->session->userdata('admcode');						
				//$this->db->where('program_code',$program_code);
				$this->db->distinct('A.exam_centre_code,A.exam_centre_name');				
				$this->db->select('A.exam_centre_code,A.exam_centre_name');				
				$this->db->from('exam_centre A');
				$this->db->join('exam_centre_master B','A.exam_centre_code = B.exam_centre_code','inner');
				$this->db->where('program_code',$program_code);
				$this->db->where('B.record_status','1');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
				//print_r($result->result_array(););die();
				
			break;
			case 'edit_status_apply4':
				$reg_user_id = $this->session->userdata('reg_user_id'); 
				$institute_code = $this->session->userdata('institute_code');
				$appl_no = isset($_POST['appl_no']) ? $_POST['appl_no'] : '';			
				//$this->db->where('program_code',$program_code);
				$applicant_address_array = array(
					'edit_status' => '1'
				);
				$this->db->where('appl_no',$appl_no);
				$this->db->where('reg_user_id',$reg_user_id);
				$update_applicant_address = $this->db->update('applicant_appl_overview',$applicant_address_array);
				if(!$update_applicant_address){
					$dbstatus = FALSE;
					$dbmessage = 'Error updating applicant_appl_overview';
				}
				
			break;
			case 'select_exam_centre':
				$program_code = $this->session->userdata('admcode');				
				$this->db->where('program_code',$program_code);
				$this->db->select('center_choice');				
				$this->db->from('program_master');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
				//print_r($result->result_array(););die();
				
			break;
			case 'get_research_data':
			
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("applicant_reference_detail.reg_user_id,applicant_reference_detail.applied_program,referenced_by,sl_no,contact_address,email_id,mobile_number");
				$this->db->from('applicant_reference_detail');
				$this->db->join('applicant_master','applicant_master.applied_program = applicant_reference_detail.applied_program AND applicant_master.reg_user_id = applicant_reference_detail.reg_user_id','inner');
				$this->db->where('applicant_master.applied_program',$program_code);
				$this->db->where('applicant_master.reg_user_id',$reg_user_id);
				$this->db->order_by('applicant_reference_detail.sl_no');
				$result = $this->db->get();
				//echo $this->db->last_query();
				return $result->result_array();
			break;
			
			case 'add_application_data_01':
			
				
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
				 



				$employed = isset($_POST['employed']) ? trim($_POST['employed']) : 'NO';
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
				$radioID = isset($_POST['radioID']) ? $_POST['radioID'] : '';
				$radioJEE = isset($_POST['radioJEE']) ? $_POST['radioJEE'] : '';
				$radioHostel = isset($_POST['radioHostel']) ? $_POST['radioHostel'] : '';
				$radiomaritalstatus = isset($_POST['radiomaritalstatus']) ? $_POST['radiomaritalstatus'] : '';
				$radioQuota = isset($_POST['radioQuota']) ? $_POST['radioQuota'] : '';
				
				$cmbidproof = isset($_POST['cmbidproof']) ? $_POST['cmbidproof'] : '';
				$txtidproof = isset($_POST['txtidproof']) ? $_POST['txtidproof'] : '';
				
				$relevantinfo = isset($_POST['relevantinfo']) ? $_POST['relevantinfo'] : '';
				$enclosuresdetails = isset($_POST['enclosuresdetails']) ? $_POST['enclosuresdetails'] : '';
				
				//echo $cmbidproof ; die();
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
				$txtphtype  = isset($_POST['cmbPH']) ? $_POST['cmbPH'] : '';
				
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
				$txtPresentAddress = isset($_POST['txtPresentAddress']) ?  trim($_POST['txtPresentAddress']) : 'BBSR';
				$txtPresentLocality = isset($_POST['txtPresentLocality']) ? trim($_POST['txtPresentLocality']) : '';
				$txtPresentPost = isset($_POST['txtPresentPost']) ? trim($_POST['txtPresentPost']) : '';
				$cmbPresentDist = isset($_POST['cmbPresentDist']) ?  trim($_POST['cmbPresentDist']) : '';
				$txtPresentPin = isset($_POST['txtPresentPin']) ? trim($_POST['txtPresentPin']) : '761200';
				$cmbPresentState = isset($_POST['cmbPresentState']) ? trim($_POST['cmbPresentState']) : '';
				$txtPresentDistance = isset($_POST['txtPresentDistance']) ? trim($_POST['txtPresentDistance']) : '';

				//if permanent is same as present
				$chksameasresidential = isset($_POST['chksameasresidential']) ? $_POST['chksameasresidential']:'N';
				$txtPermenentAddress = isset($_POST['hidPermenentAddress']) ? trim($_POST['hidPermenentAddress']) : '';
				$txtPermenentLocality = isset($_POST['txtPermenentLocality']) ? trim($_POST['txtPermenentLocality']) : '';
				$txtPermanentPost = isset($_POST['txtPermanentPost']) ? trim($_POST['txtPermanentPost']) : 'PKD';
				$txtPermanentDist = isset($_POST['cmbPermanentDist']) ? trim($_POST['cmbPermanentDist']) : '';
				$txtPermanentState = isset($_POST['cmbPermanentState']) ?  trim($_POST['cmbPermanentState']) : '';
				$txtPermanentPin = isset($_POST['txtPermanentPin']) ? trim($_POST['txtPermanentPin']) : '761200';
				$txtPermanentMobile = isset($_POST['txtPermanentMobile']) ? trim($_POST['txtPermanentMobile']) : '';
				$txtUid = isset($_POST['txtUid']) ? trim($_POST['txtUid']) : '';
				$empsuspended = isset($_POST['empsuspended']) ? trim($_POST['empsuspended']) : '';
				$empsuspendedinfo = isset($_POST['empsuspendedinfo']) ? trim($_POST['empsuspendedinfo']) : '';
				$empDisciplinary = isset($_POST['empDisciplinary']) ? trim($_POST['empDisciplinary']) : '';
				$empDisciplinaryInfo = isset($_POST['empDisciplinaryInfo']) ? trim($_POST['empDisciplinaryInfo']) : '';
				
				
				$technical_5_1 = isset($_POST['txtTechnical_5_1']) ? trim($_POST['txtTechnical_5_1']) : ''; //course
				$technical_5_2 = isset($_POST['txtTechnical_5_2']) && $_POST['txtTechnical_5_2'] != '' ? trim($_POST['txtTechnical_5_2']) : 'NULL'; //institute
				$technical_5_3 = isset($_POST['txtTechnical_5_3']) ? trim($_POST['txtTechnical_5_3']) : ''; //affiliation
				$technical_5_4 = isset($_POST['txtTechnical_5_4']) ? trim($_POST['txtTechnical_5_4']) : ''; //duration
				
				$technical_6_1 = isset($_POST['txtTechnical_6_1']) ? trim($_POST['txtTechnical_6_1']) : ''; //course
				$technical_6_2 = isset($_POST['txtTechnical_6_2']) && $_POST['txtTechnical_6_2'] != '' ? trim($_POST['txtTechnical_6_2']) : 'NULL'; //institute
				$technical_6_3 = isset($_POST['txtTechnical_6_3']) ? trim($_POST['txtTechnical_6_3']) : ''; //affiliation
				$technical_6_4 = isset($_POST['txtTechnical_6_4']) ? trim($_POST['txtTechnical_6_4']) : ''; //duration
				
				$technical_7_1 = isset($_POST['txtTechnical_7_1']) ? trim($_POST['txtTechnical_7_1']) : ''; //course
				$technical_7_2 = isset($_POST['txtTechnical_7_2']) && $_POST['txtTechnical_7_2'] != '' ? trim($_POST['txtTechnical_7_2']) : 'NULL'; //institute
				$technical_7_3 = isset($_POST['txtTechnical_7_3']) ? trim($_POST['txtTechnical_7_3']) : ''; //affiliation
				$technical_7_4 = isset($_POST['txtTechnical_7_4']) ? trim($_POST['txtTechnical_7_4']) : ''; //duration

					
				$txtApplicantEmail = isset($_POST['txtemailid']) ? trim($_POST['txtemailid']) : '';
				/*ECHO $txtApplicantEmail;
				DIE();*/
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
					${'txtYear'.$slno} = isset($_POST['txtYear'.$slno]) && trim($_POST['txtYear'.$slno]) != '' ? (int) trim($_POST['txtYear'.$slno]) : null;
					${'txtBoard'.$slno} = isset($_POST['txtBoard'.$slno]) && $_POST['txtBoard'.$slno] != '' ? $_POST['txtBoard'.$slno] : '';
					${'txtDivision'.$slno} = isset($_POST['txtDivision'.$slno]) && $_POST['txtDivision'.$slno] != '' ? $_POST['txtDivision'.$slno] : 'NULL';
					${'txtMS'.$slno} = isset($_POST['txtMS'.$slno]) && $_POST['txtMS'.$slno] != '' ? $_POST['txtMS'.$slno] : '';
					${'txtFM'.$slno} = isset($_POST['txtFM'.$slno]) && $_POST['txtFM'.$slno] != '' ? $_POST['txtFM'.$slno] : '';
					${'txtPercent'.$slno} = isset($_POST['txtPercent'.$slno]) && $_POST['txtPercent'.$slno] != '' ? $_POST['txtPercent'.$slno] : null;
					${'txtsubject'.$slno} = isset($_POST['txtsubject'.$slno]) && $_POST['txtsubject'.$slno] != '' ? $_POST['txtsubject'.$slno] : '';
					${'txtdistinct'.$slno} = isset($_POST['txtdistinct'.$slno]) && $_POST['txtdistinct'.$slno] != '' ? $_POST['txtdistinct'.$slno] : null;
					${'txtgrading'.$slno} = isset($_POST['txtgrading'.$slno]) && $_POST['txtgrading'.$slno] != '' ? $_POST['txtgrading'.$slno] : '';
					${'txtqual2'.$slno} = isset($_POST['txtqual2'.$slno]) && $_POST['txtqual2'.$slno] != '' ? $_POST['txtqual2'.$slno] : '';
					$slno++;
					//echo $_POST['txtQualification'.$slno];
				}
				$txtQualification3 = isset($_POST['txtQualification3']) && $_POST['txtQualification3'] != '' ? $_POST['txtQualification3'] : '';
				$txtYear3 = isset($_POST['txtYear3']) && trim($_POST['txtYear3']) != '' ? (int) trim($_POST['txtYear3']) : null;
				$txtBoard3 = isset($_POST['txtBoard3']) && $_POST['txtBoard3'] != '' ? $_POST['txtBoard3'] : '';
				$txtDivision3 = isset($_POST['txtDivision3']) && $_POST['txtDivision3'] != '' ? $_POST['txtDivision3'] : null;
				$txtMS3 = isset($_POST['txtMS3']) && $_POST['txtMS3'] != '' ? $_POST['txtMS3'] : '';
				$txtFM3 = isset($_POST['txtFM3']) && $_POST['txtFM3'] != '' ? $_POST['txtFM3'] : '';
				$txtPercent3 = isset($_POST['txtPercent3']) && $_POST['txtPercent3'] != '' ? $_POST['txtPercent3'] : null;
				//Entrance exam appeared
				  
				$txtQualification4 = isset($_POST['txtQualification4']) && $_POST['txtQualification4'] != '' ? $_POST['txtQualification4'] : '';
				$txtYear4 = isset($_POST['txtYear4']) && trim($_POST['txtYear4']) != '' ? (int) trim($_POST['txtYear4']) : null;
				$txtBoard4 = isset($_POST['txtBoard4']) && $_POST['txtBoard4'] != '' ? $_POST['txtBoard4'] : '';
				$txtDivision4 = isset($_POST['txtDivision4']) && $_POST['txtDivision4'] != '' ? $_POST['txtDivision4'] : null;
				$txtMS4 = isset($_POST['txtMS4']) && $_POST['txtMS4'] != '' ? $_POST['txtMS4'] : '';
				$txtFM4 = isset($_POST['txtFM4']) && $_POST['txtFM4'] != '' ? $_POST['txtFM4'] : '';
				$txtPercent4 = isset($_POST['txtPercent4']) && $_POST['txtPercent4'] != '' ? $_POST['txtPercent4'] : null;
				$txtOther_grad = isset($_POST['txtOther_grad']) && $_POST['txtOther_grad'] != '' ? $_POST['txtOther_grad'] : '';
				
				$txtQualification5 = isset($_POST['txtQualification5']) && $_POST['txtQualification5'] != '' ? $_POST['txtQualification5'] : '';
				$txtYear5 = isset($_POST['txtYear5']) && trim($_POST['txtYear5']) != '' ? (int) trim($_POST['txtYear5']) : '';
				$txtBoard5 = isset($_POST['txtBoard5']) && $_POST['txtBoard5'] != '' ? $_POST['txtBoard5'] : '';
				$txtDivision5 = isset($_POST['txtDivision5']) && $_POST['txtDivision5'] != '' ? $_POST['txtDivision5'] : null;
				$txtMS5 = isset($_POST['txtMS5']) && $_POST['txtMS5'] != '' ? $_POST['txtMS5'] : '';
				$txtFM5 = isset($_POST['txtFM5']) && $_POST['txtFM5'] != '' ? $_POST['txtFM5'] : '';
				$txtPercent5 = isset($_POST['txtPercent5']) && $_POST['txtPercent5'] != '' ? $_POST['txtPercent5'] : null;
				  
				//
				
				$radioExam = isset($_POST['radioExam']) ? $_POST['radioExam'] : '';
				$radioMarkSheet = isset($_POST['radioMarkSheet']) ? $_POST['radioMarkSheet'] : '';
				$pay_mode = isset($_POST['mode']) ? $_POST['mode'] : '';
				$radioGradCert = isset($_POST['radioGradCert']) ? $_POST['radioGradCert'] : 'No';
				$radioGradMarkSheet = isset($_POST['radioGradMarkSheet']) ? $_POST['radioGradMarkSheet'] : 'No';
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
				$this->db->save_queries = TRUE;
				$this->db->select("count(*) AS cnt");
				$this->db->from('applicant_appl_overview');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				echo "hiiiiiiiii";
				die();*/
				foreach($result->result_array() as $appl)
				{
					$count = $appl['cnt'];
				}
				if($count >= 1)
				{
					$this->session->set_userdata('mode', 'edit');
				}
				else
				{
					$this->session->set_userdata('mode', 'new');
				}
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
						// District code
				$this->db->select("district_code");
				$this->db->from('district_master');
				$this->db->where('district_name',$cmbPresentDist);
				$result = $this->db->get();
				$cmbPresentDist= $result->result_array();
				foreach($cmbPresentDist as $row)
				{
					$cmbPresentDist=$row['district_code'];
				}
				$this->db->select("district_code");
				$this->db->from('district_master');
				$this->db->where('district_name',$cmbPermanentDist);
				$result = $this->db->get();
				$cmbPermanentDist= $result->result_array();
				foreach($cmbPermanentDist as $row)
				{
					$cmbPermanentDist=$row['district_code'];
				}

				$this->db->select("state_code");
				$this->db->from('state_master');
				$this->db->where('state_name',$cmbPresentState);
				$result = $this->db->get();
				$cmbPresentState= $result->result_array();
				foreach($cmbPresentState as $row)
				{
					$cmbPresentState=$row['state_code'];
				}

				$this->db->select("state_code");
				$this->db->from('state_master');
				$this->db->where('state_name',$cmbPermanentState);
				$result = $this->db->get();
				$cmbPermanentState= $result->result_array();
				foreach($cmbPermanentState as $row)
				{
					$cmbPermanentState=$row['state_code'];
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
							'institute_code'=>HARDCODE_INSTITUTE_CODE, 
							'mobile'=>$reg_user_id, 
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
							'mobile'=>$reg_user_id, 
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
							'mobile'=>$reg_user_id, 
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
							'mobile'=>$reg_user_id, 
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
						'id_proof' => $cmbidproof,
						'id_proof_number' => $txtidproof,
						'jee_place' => $radioJEE,
						'nationality' => $cmbNationality,
						'cmbrelationship' => $cmbrelationship,
						'adhar_no' => $txtUid,
						'dob_in_word' => $hidDate,
						'category' => $cmbReservedCategory,
						'phtype'=>$txtphtype,
						
						'is_minority_community' => $radioMinority,
						'is_passed' => $radioMarkSheet,
						'payment_mode' => $pay_mode,
						'grad_cert' => $radioGradCert,
						'grad_mark_sheet' => $radioGradMarkSheet,
						'minority_community_details' => $cmbCommunity,
						
						'is_north_east' => $radiobelong,
						'father_occupation' => $txtOccupation,
						'annual_parent_income' => $txtIncome,
						'indicate_choice' => $txtIndicate,
						'know_about_cipet' => $txtKnowabout,
						'physically_challenged' => $radioPhysicallY ,
						'is_suspended' => $empsuspended ,
						'any_disciplinary_action' => $empDisciplinary ,
						
						'religion' => $cmbReligion,
						'applicant_email' => $txtApplicantEmail,
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
						'fathers_adhar_no'=>$fathers_adhar_no,
						'mothers_adhar_no'=>$mothers_adhar_no,
						'relevantinfo' => $relevantinfo,
						'suspendedInfo' => $empsuspendedinfo,
						'disciplinaryInfo' => $empDisciplinaryInfo,
						'enclosuresdetails' => $enclosuresdetails,

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
						$query = $this->db->update('applicant_master',$applicant_master_update_array);
						if(!$query)
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
								'id_proof' => $cmbidproof,
								'id_proof_number' => $txtidproof,
								'jee_place' => $radioJEE,
								'nationality' => $cmbNationality,
								'cmbrelationship' => $cmbrelationship,
								'dob' => $dob,
								'adhar_no' => $txtUid,
								'dob_in_word' => $hidDate,
								'category' => $cmbReservedCategory,
								'phtype'=>$txtphtype,
								
								'is_minority_community' => $radioMinority,
								'is_passed' => $radioMarkSheet,
								'payment_mode' => $pay_mode,
								'grad_mark_sheet' => $radioGradMarkSheet,
								'minority_community_details' => $cmbCommunity,
								
								'is_north_east' => $radiobelong,
								'father_occupation' => $txtOccupation,
								'annual_parent_income' => $txtIncome,
								'indicate_choice' => $txtIndicate,
								'know_about_cipet' => $txtKnowabout,
								'physically_challenged' => $radioPhysicallY ,
								'last_year_mark' => $txtfinalpercentage,
								
								'religion' => $cmbReligion,
								'applicant_email' => $txtApplicantEmail,
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
								'relevantinfo' => $relevantinfo,
								'enclosuresdetails' => $enclosuresdetails,
								'father_occupation'=>$FathersProfession, 
							'annual_parent_income'=>$FathersIncome,
							'north_east_state'=>$cmbNorthState, 
							'mothers_profession'=>$MothersProfession, 
							'mothers_income'=>$MothersIncome,
							'mothers_name'=>$txtMotherName,
							'fathers_adhar_no'=>$fathers_adhar_no,
							'mothers_adhar_no'=>$mothers_adhar_no,

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
					/*echo $txtQualification3;
					die();*/
					foreach($allQualifications as $row)
					{
						/*if(${'txtYear'.$slno} != 'NULL' )
						{*/
							$post_qualification = ${'txtQualification'.$slno};
							//echo $post_qualification; 
							 
						//	$qualification = $row['$qualification']
							$update_applicant_qualification_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'qual_desc_1' => trim($post_qualification),
								'year_of_passing' => ${'txtYear'.$slno},
								'university_board' => ${'txtBoard'.$slno},
								'mark_secured' => ${'txtMS'.$slno},
								'full_mark' => ${'txtFM'.$slno},
								'percentage_mark' => ${'txtPercent'.$slno},
								'honours_subject' => ${'txtsubject'.$slno},
								'division_distinction' => ${'txtdistinct'.$slno},
								'grade' => ${'txtgrading'.$slno},
								'qual_desc_2' => ${'txtqual2'.$slno},
								'other_stream' => $txtOther_grad,
								'created_by' => $reg_user_id,
								'created_on' => $now
							);
							//print_r($update_applicant_qualification_array);
							
							$this->db->insert('applicant_qualification_detail',$update_applicant_qualification_array);
							/*echo $this->db->last_query();
							die();*/
							$slno++;
						/*}*/ 
					}
					
					
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$update_applicant_technical_qualification_detail = $this->db->delete('applicant_technical_qualification_detail');
					//echo $this->db->last_query();
					if(!$update_applicant_technical_qualification_detail)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error deleting applicant_technical_qualification_detail';
					}
					
					//14. Technical qualifiation2
					if($technical_5_1 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $technical_5_1,
							'year' => $technical_5_2,
							'sl_no' => '5',
							'institute_name' => $technical_5_3,
							'thesis' => $technical_5_4,
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 5';
						}
						
					}
					//14. Technical qualifiation3
					if($technical_6_1 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $technical_6_1,
							'year' => $technical_6_2,
							'sl_no' => '6',
							'institute_name' => $technical_6_3,
							'thesis' => $technical_6_4,
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 6';
						}
					}
					if($technical_7_1 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $technical_7_1,
							'year' => $technical_7_2,
							'institute_name' => $technical_7_3,
							'sl_no' => '7',
							'thesis' => $technical_7_4,
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 7';
						}
					}
					
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$applicant_reference_detail = $this->db->delete('applicant_reference_detail');
					
					if(!$applicant_reference_detail)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error deleting applicant_reference_detail';
					}
					
					for($ref = 0 ;$ref< 2 ;$ref ++ ){
						$update_applicant_reference_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'referenced_by' => $_POST['refname'.$ref],
								'sl_no' => $ref,
								'contact_address' => $_POST['refaddress'.$ref],
								'email_id' => $_POST['refemail'.$ref],
								'mobile_number' => $_POST['refmobile'.$ref],
								'created_by' => $reg_user_id,
								'created_on' => $now
						);
						$this->db->insert('applicant_reference_detail',$update_applicant_reference_array);
						
						if($this->db->affected_rows() == 0)
						{
							$dbstatus = FALSE;
							$dbmessage = 'Error updating applicant_reference_detail';
						}
					}
					
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$applicant_research_experience_detaill = $this->db->delete('applicant_research_experience_detail');
					
					if(!$applicant_research_experience_detaill)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error deleting applicant_research_experience_detail';
					}
					
					//$insert_research_data=array();
					for($i=0;$i < sizeof($_POST['txtorganization']);$i++){
						if($_POST['txtorganization'][$i]!=''){
							
							//echo $_POST['txtdate_from'][$i];
							$from_date=date_create($_POST['txtdate_from'][$i]);
							$to_date=date_create($_POST['txtdate_to'][$i]);
							//echo date_format($from_date,"Y-m-d");
							//die();
							
							$insert_research_data=
							array("reg_user_id" => $reg_user_id,
								"applied_program" => $program_code,
								"sl_no"=>$i+1,
								"organization"=>$_POST['txtorganization'][$i],
								"post_held"=>$_POST['txtpost_held'][$i],
								"date_from"=>date_format($from_date,"Y-m-d"),
								"date_to"=> date_format($to_date,"Y-m-d"),
								"nature_of_job"=>$_POST['txtnature_of_job'][$i],
								"pay_band"=>$_POST['txtpay_band'][$i],
								"basic_pay"=>$_POST['txtbasic_pay'][$i],
								"created_by"=>$reg_user_id,
								"created_on"=>$now);
								$this->db->insert('applicant_research_experience_detail',$insert_research_data);
								if($this->db->affected_rows() == 0)
								{
									$dbstatus = FALSE;
									$dbmessage = 'Error updating applicant_research_experience_detail';
								}
						}
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
							if($cmbReservedCategory == 'GEN' || $cmbReservedCategory == 'OBC'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
							}
							if($radiobelong == 'NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DOMICILE');
							}
							if($radioPhysicallY == 'NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'PHC');
							}
							if($radioGradCert == 'No'  || $radioMarkSheet == 'No'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HQC');
							}
							if($radioGradMarkSheet == 'No' || $radioMarkSheet == 'No'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HDMS');
							}
							if($radioID == 'No'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DL');
							}
							if($employed == 'NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'NOC');
							}
							if($pay_mode == 'Online'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CHALLAN');
							}
							if($cmbNationality == 'OTH'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
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
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'institute_code'=>HARDCODE_INSTITUTE_CODE, 
							'created_by' => $reg_user_id,
							'distance_from' => $txtPresentDistance,
							'created_on' => $now 
						);
						$this->db->insert('applicant_address',$applicant_address_array1);
						/*echo $this->db->last_query();
						die();*/
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbmessage = 'Error inserting Applicant same address';
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
							'id_proof' => $cmbidproof,
							'id_proof_number' => $txtidproof,
							'relevantinfo' => $relevantinfo,
							'suspendedInfo' => $empsuspendedinfo,
							'disciplinaryInfo' => $empDisciplinaryInfo,
							'enclosuresdetails' => $enclosuresdetails,
							
							'jee_place' => $radioJEE,
							'nationality' => $cmbNationality,
							'dob' => $dob,
							'adhar_no' => $txtUid,
							'dob_in_word' => $hidDate,
							'category' => $cmbReservedCategory,
							'phtype'=>$txtphtype,
							'religion' => $cmbReligion,
							'applicant_email' => $txtApplicantEmail,
							'applicant_landline' => $txtApplicantLandLine,
							'applicant_mobile' => $txtApplicantMobile,
							'mother_tongue' => $txtMotherTongue, 
							'hostel_facility' => $radioHostel,
							'marital_status' => $radiomaritalstatus,
							'is_reserved_quota' => $radioQuota,
							'last_year_mark' => $txtfinalpercentage,
							
							'is_minority_community' => $radioMinority,
							'is_passed' => $radioMarkSheet,
							'payment_mode' => $pay_mode,
							'grad_cert' => $radioGradCert,
							'grad_mark_sheet' => $radioGradMarkSheet,
							'minority_community_details' => $cmbCommunity,
							'is_north_east' => $radiobelong,
							'father_occupation' => $txtOccupation,
							'annual_parent_income' => $txtIncome,
							'indicate_choice' => $txtIndicate,
							'know_about_cipet' => $txtKnowabout,
							'physically_challenged' => $radioPhysicallY ,
							'is_suspended' => $empsuspended ,
							'any_disciplinary_action' => $empDisciplinary ,
							
							'created_by' => $reg_user_id,
							'created_on' => $now,
							'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$comm_address_ref_id,
							'master_name'=>$master_name,
							
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
							'fathers_adhar_no'=>$fathers_adhar_no,
							'mothers_adhar_no'=>$mothers_adhar_no,
							
							'completion_date'=>$completion_date 
							);
						$this->db->insert('applicant_master',$applicant_master_insert_array);
						
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbmessage = 'Error inserting Applicant same address';
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
							'id_proof' => $cmbidproof,
							'id_proof_number' => $txtidproof,
							'relevantinfo' => $relevantinfo,
							'enclosuresdetails' => $enclosuresdetails,
							
							'jee_place' => $radioJEE,
							'nationality' => $cmbNationality,
							'dob' => $dob,
							'adhar_no' => $txtUid,
							'dob_in_word' => $hidDate,
							'category' => $cmbReservedCategory,
							'phtype'=>$txtphtype,
							'religion' => $cmbReligion,
							'applicant_email' => $txtApplicantEmail,
							'applicant_landline' => $txtApplicantLandLine,
							'applicant_mobile' => $txtApplicantMobile,
							'mother_tongue' => $txtMotherTongue, 
							'hostel_facility' => $radioHostel,
							'marital_status' => $radiomaritalstatus,
							'is_reserved_quota' => $radioQuota,
							'last_year_mark' => $txtfinalpercentage,
							
							'is_minority_community' => $radioMinority,
							'is_passed' => $radioMarkSheet,
							'payment_mode' => $pay_mode,
							'grad_cert' => $radioGradCert,
							'grad_mark_sheet' => $radioGradMarkSheet,
							'minority_community_details' => $cmbCommunity,
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
							'fathers_adhar_no'=>$fathers_adhar_no,
							'mothers_adhar_no'=>$mothers_adhar_no,
							
							'completion_date'=>$completion_date );
						$this->db->insert('applicant_history',$applicant_history_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbmessage = 'Error inserting Applicant history same address';
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
							'institute_code'=>HARDCODE_INSTITUTE_CODE,  
							'mobile'=>$reg_user_id, 
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
								'institute_code'=>HARDCODE_INSTITUTE_CODE, 
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
							'id_proof' => $cmbidproof,
							'id_proof_number' => $txtidproof,
							'jee_place' => $radioJEE,
							'nationality' => $cmbNationality,
							'dob' => $dob,
							'adhar_no' => $txtUid,
							'dob_in_word' => $hidDate,
							'category' => $cmbReservedCategory,
							'phtype'=>$txtphtype,
							'religion' => $cmbReligion,
							'applicant_email' => $txtApplicantEmail,
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
							'is_passed' => $radioMarkSheet,
							'payment_mode' => $pay_mode,
							'grad_cert' => $radioGradCert,
							 'grad_mark_sheet' => $radioGradMarkSheet,
							'minority_community_details' => $cmbCommunity,
							'is_north_east' => $radiobelong,
							'father_occupation' => $txtOccupation,
							'annual_parent_income' => $txtIncome,
							'indicate_choice' => $txtIndicate,
							'know_about_cipet' => $txtKnowabout,
							'physically_challenged' => $radioPhysicallY ,
							'is_suspended' => $empsuspended ,
							'any_disciplinary_action' => $empDisciplinary ,
							
							'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$perm_address_ref_id,
							'master_name'=>$master_name,
						
							'is_employed'=>$employed,
							'employer_add'=>$Employer_address,
							'employer_from'=>$Employer_from,
							'employer_to'=>$Employer_to,
							'employer_add1'=>$Employer_address1, 
							'employer_from1'=>$Employer_from1,
							'employer_to1'=>$Employer_to1, 
							'relevantinfo' => $relevantinfo,
							'suspendedInfo' => $empsuspendedinfo,
							'disciplinaryInfo' => $empDisciplinaryInfo,
							'enclosuresdetails' => $enclosuresdetails,
							

							'father_occupation'=>$FathersProfession, 
							'annual_parent_income'=>$FathersIncome,
							'north_east_state'=>$cmbNorthState, 

							'mothers_profession'=>$MothersProfession, 
							'mothers_income'=>$MothersIncome,
							'mothers_name'=>$txtMotherName,
							'fathers_adhar_no'=>$fathers_adhar_no,
							'mothers_adhar_no'=>$mothers_adhar_no,

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
							'id_proof' => $cmbidproof,
							'id_proof_number' => $txtidproof,
							'jee_place' => $radioJEE,
							'nationality' => $cmbNationality,
							'dob' => $dob,
							'adhar_no' => $txtUid,
							'dob_in_word' => $hidDate,
							'category' => $cmbReservedCategory,
							'phtype'=>$txtphtype,
							'religion' => $cmbReligion,
							'applicant_email' => $txtApplicantEmail,
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
							'is_passed' => $radioMarkSheet,
							'payment_mode' => $pay_mode,
							'grad_cert' => $radioGradCert,
							 'grad_mark_sheet' => $radioGradMarkSheet,
							'minority_community_details' => $cmbCommunity,
							'is_north_east' => $radiobelong,
							'father_occupation' => $txtOccupation,
							'annual_parent_income' => $txtIncome,
							'indicate_choice' => $txtIndicate,
							'know_about_cipet' => $txtKnowabout,
							'physically_challenged' => $radioPhysicallY ,
							
							'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$perm_address_ref_id,
							'master_name'=>$master_name,
						
							'is_employed'=>$employed,
							'employer_add'=>$Employer_address,
							'employer_from'=>$Employer_from,
							'employer_to'=>$Employer_to,
							'employer_add1'=>$Employer_address1, 
							'employer_from1'=>$Employer_from1,
							'employer_to1'=>$Employer_to1, 
							'relevantinfo' => $relevantinfo,
							'enclosuresdetails' => $enclosuresdetails,
							

							'father_occupation'=>$FathersProfession, 
							'annual_parent_income'=>$FathersIncome,
							'north_east_state'=>$cmbNorthState, 

							'mothers_profession'=>$MothersProfession, 
							'mothers_income'=>$MothersIncome,
							'mothers_name'=>$txtMotherName,
							'fathers_adhar_no'=>$fathers_adhar_no,
							'mothers_adhar_no'=>$mothers_adhar_no,

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
						/*if(${'txtYear'.$slno} != 'NULL' )
						{*/
							$post_qualification = ${'txtQualification'.$slno};
							//echo $post_qualification; 
							 
						//	$qualification = $row['$qualification']
							$update_applicant_qualification_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'qual_desc_1' => trim($post_qualification),
								'year_of_passing' => ${'txtYear'.$slno},
								'university_board' => ${'txtBoard'.$slno},
								'mark_secured' => ${'txtMS'.$slno},
								'full_mark' => ${'txtFM'.$slno},
								'percentage_mark' => ${'txtPercent'.$slno},
								'honours_subject' => ${'txtsubject'.$slno},
								'division_distinction' => ${'txtdistinct'.$slno},
								'grade' => ${'txtgrading'.$slno},
								'qual_desc_2' => ${'txtqual2'.$slno},
								'other_stream' => $txtOther_grad,
								'created_by' => $reg_user_id,
								'created_on' => $now
							);
							//print_r($update_applicant_qualification_array);
							
							$this->db->insert('applicant_qualification_detail',$update_applicant_qualification_array);
							/*echo $this->db->last_query();
							die();*/
							$slno++;
						/*} */
						
					}
					
					//14. Technical qualifiation2
					if($technical_5_1 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $technical_5_1,
							'year' => $technical_5_2,
							'institute_name' => $technical_5_3,
							'thesis' => $technical_5_4,
							'sl_no' => '5',
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 5';
						}
						
					}
					//14. Technical qualifiation3
					if($technical_6_1 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $technical_6_1,
							'year' => $technical_6_2,
							'sl_no' => '6',
							'institute_name' => $technical_6_3,
							'thesis' => $technical_6_4,
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 6';
						}
					}
					if($technical_7_1 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $technical_7_1,
							'year' => $technical_7_2,
							'institute_name' => $technical_7_3,
							'sl_no' => '7',
							'thesis' => $technical_7_4,
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 7';
						}
					}
					
					
					for($ref = 0 ;$ref< 2 ;$ref ++ ){
						$update_applicant_reference_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'referenced_by' => $_POST['refname'.$ref],
								'sl_no' => $ref,
								'contact_address' => $_POST['refaddress'.$ref],
								'email_id' => $_POST['refemail'.$ref],
								'mobile_number' => $_POST['refmobile'.$ref],
								'created_by' => $reg_user_id,
								'created_on' => $now
						);
						$this->db->insert('applicant_reference_detail',$update_applicant_reference_array);
						
						if($this->db->affected_rows() == 0)
						{
							$dbstatus = FALSE;
							$dbmessage = 'Error updating applicant_reference_detail';
						}
					}
					for($i=0;$i < sizeof($_POST['txtorganization']);$i++){
						if($_POST['txtorganization'][$i]!=''){
							//echo $_POST['txtdate_from'][$i];
							$from_date=date_create($_POST['txtdate_from'][$i]);
							$to_date=date_create($_POST['txtdate_to'][$i]);
							//echo date_format($from_date,"Y-m-d");
							//die();\
							$insert_research_data=
							array("reg_user_id" => $reg_user_id,
								"applied_program" => $program_code,
								"sl_no"=>$i+1,
								"organization"=>$_POST['txtorganization'][$i],
								"post_held"=>$_POST['txtpost_held'][$i],
								"date_from"=>date_format($from_date,"Y-m-d"),
								"date_to"=> date_format($to_date,"Y-m-d"),
								"nature_of_job"=>$_POST['txtnature_of_job'][$i],
								"pay_band"=>$_POST['txtpay_band'][$i],
								"basic_pay"=>$_POST['txtbasic_pay'][$i],
								"created_by"=>$reg_user_id,
								"created_on"=>$now);
								$this->db->insert('applicant_research_experience_detail',$insert_research_data);
								if($this->db->affected_rows() == 0)
								{
									$dbstatus = FALSE;
									$dbmessage = 'Error updating applicant_research_experience_detail';
								}
						}
						
						
					}
					
					
					/*$insert_research_data=array();
					for($i=0;$i < sizeof($_POST['txtorganization']);$i++){
						if($_POST['txtorganization'][$i]!=''){
							$data=Array("reg_user_id" => $reg_user_id,
								"applied_program" => $program_code,
								"organization"=>$i+1,
								"post_held"=>$_POST['txtorganization'][$i],
								"date_from"=>$_POST['txtdate_from'][$i],
								"date_to"=>$_POST['txtdate_to'][$i],
								"nature_of_job"=>$_POST['txtnature_of_job'][$i],
								"pay_band"=>$_POST['txtpay_band'][$i],
								"basic_pay"=>$_POST['txtbasic_pay'][$i],
								"created_by"=>$reg_user_id,
								"created_on"=>$now);
								array_push($insert_research_data,$data);
						}
					}
					$promoter_detail_inserted = $db->insertMulti('applicant_research_experience_detail' , $insert_research_data);
					if(!$promoter_detail_inserted){
						$dbStatus = "ERROR0";
						$dbMessage = "ERROR inserting applicant_research_experience_detail";
						$dbError = $db->getLastError();
					}*/
					
					
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
							$split=explode("_",$program_code);
							$last_digit=substr($split[0], -3);
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
							
						$application_no = $last_digit.$year.$changed_sl_no;
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
							//$this->db->insert('applicant_appl_overview_history',$application_data);
							
							
							$this->db->where('program_code',$program_code);
							$this->db->update('program_master',$program_update_data);
							if($this->db->affected_rows() == 0)
							{
								$dbStatus = FALSE;
								$dbmessage = 'Error updating program';
							}
							//echo $this->db->last_query();
						}
						
						$this->db->select("document_type_code");
						$this->db->from('program_document_setup');
						$this->db->where('program_code',$program_code);
						$this->db->where('record_status',1);
						$result = $this->db->get();
						$documentsReq = $result->result_array();
						if($cmbReservedCategory == 'GEN' || $cmbReservedCategory == 'OBC'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
						}
						if($radiobelong == 'NO'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DOMICILE');
						}
						if($radioPhysicallY == 'NO'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'PHC');
						}
						if($radioGradCert == 'No'  || $radioMarkSheet == 'No'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HQC');
						}
						if($radioGradMarkSheet == 'No' || $radioMarkSheet == 'No'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HDMS');
						}
						if($radioID == 'No'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DL');
						}
						if($employed == 'NO'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'NOC');
						}
						if($pay_mode == 'Online'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CHALLAN');
						}
						if($cmbNationality == 'OTH'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
						}
						
						foreach($documentsReq AS $row1)
						{
							$document_list_insert_array = array(
								'record_status'=>1,
								'application_no'=>$application_no,
								'document_type_code'=>$row1['document_type_code']
							);
							$this->db->insert('applicant_document_list',$document_list_insert_array);
							if($this->db->affected_rows() == 0)
							{
								$dbStatus = FALSE;
								$dbmessage = 'Error updating applicant_document_list';
							}
						}
						/*echo $dbmessage;
						die();*/
						$page_url = $_SERVER["HTTP_REFERER"];
						$ip_address = $_SERVER['REMOTE_ADDR'];
						$log_status = $dbStatus;
						$log_message = $dbmessage;
						$this->log_detail_record($page_url, $log_status, $log_message, $ip_address);
						
						if($dbStatus == TRUE)
						{
							$this->db->trans_complete();
							$this->session->set_userdata('admcode', $program_code);
							$this->session->set_userdata('reg_user_id', $reg_user_id);
							$this->session->set_userdata('appl_no', $application_no);
							$this->session->set_userdata('mode', $mode);
							$this->session->set_userdata('step', 3);
							/*if( $this->db->trans_status() === FALSE){
								$dbStatus = FALSE;
								$dbmessage = 'Error While Saving';
							}*/
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
			case 'select_category_eligibility_details':
				$reg_user_id = $this->session->userdata('reg_user_id');
				$program_code = $this->session->userdata('admcode');
				$institute_code = $this->session->userdata('institute_code');
				$category = $_POST['category'];
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("DATE_FORMAT(dob,'%d-%m-%Y') AS dob");
				$this->db->from('applicant_reg_master A');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('institute_code',$institute_code);
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//$this->db->last_query();
				//print_r($result);
				foreach($result->result_array() AS $row)
				{
					$dob = $row['dob'];
				}
				
				$this->db->select("DATE_FORMAT(birth_start_date,'%d-%m-%Y') AS birth_start_date,DATE_FORMAT(birth_end_date,'%d-%m-%Y') AS birth_end_date");
				$this->db->from('program_category_eligible_date_setup A');
				$this->db->where('category_code',$category);
				$this->db->where('program_code',$program_code);
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//print_r($result->result_array());
				$birth_start_date = '';
				$birth_end_date = '';
				foreach($result->result_array() AS $row)
				{
					$birth_start_date = $row['birth_start_date'];
					$birth_end_date = $row['birth_end_date'];
				}
				/*echo $dob;
				echo $birth_start_date;
				echo $birth_end_date;*/
				$dob = new DateTime($dob);
				$birth_start_date = ($birth_start_date != '') ? new DateTime($birth_start_date) : '';
				$birth_end_date = ($birth_end_date != '') ? new DateTime($birth_end_date) : '';
				if($birth_start_date != '' && $birth_end_date != '')
				{
					if($birth_start_date <= $dob)
					{
						if($birth_end_date >= $dob)
						{
							$eligible = '1';
						}
						else
						{
							//ECHO 'HI';
							$eligible = '0';
						}
					}
					else
					{
						//ECHO 'HELLO';
						$eligible = '0';
					}
				}
				else
				{
					$eligible = '1';
				}
				
				
				return $eligible;
			break;
			case 'save_applicant_details_temp':
				$dbStatus = TRUE;
				$dbMessage = "Data Saved Successfully";
				
				/*$program_code = $this->session->userdata('admcode');*/
				$program_code = isset($_POST['hidprogram']) ? trim($_POST['hidprogram']) : '';
				$program_code_arr = explode('_',$program_code);
				$institute_code = $program_code_arr[1];
				$reg_user_id = $this->session->userdata('reg_user_id');
				//echo($reg_user_id);die();
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s");
        		
				$program_code = isset($_POST['hidprogram']) ? trim($_POST['hidprogram']) : '';
				$txtFirstName = isset($_POST['txtFirstName']) ? trim($_POST['txtFirstName']) : '';
				$txtMiddleName = isset($_POST['txtMiddleName']) ?  trim($_POST['txtMiddleName']) : '';
				$txtLastName = isset($_POST['txtLastName']) ? trim($_POST['txtLastName']) : '';
				$fullname = $txtFirstName." ".$txtMiddleName." ".$txtLastName;

				$d = isset($_POST['cmbDay']) ? trim($_POST['cmbDay']) : '';
				$age = isset($_POST['hidAge']) ? trim($_POST['hidAge']) : '';
				$m = isset($_POST['cmbMonth']) ? trim($_POST['cmbMonth']) : '';
				$y = isset($_POST['cmbYear']) ? trim($_POST['cmbYear']) : '';
				$dob = isset($_POST['hidDateFormat']) ? trim($_POST['hidDateFormat']) : '';
				$dob = date("Y-m-d", strtotime($dob));
				
				$center_name1 = isset($_POST['center_name1']) ? trim($_POST['center_name1']) : '';
				$center_code1 = isset($_POST['center_code1']) ? trim($_POST['center_code1']) : '';
				$center_name2 = isset($_POST['center_name2']) ? trim($_POST['center_name2']) : '';
				$center_code2 = isset($_POST['center_code2']) ? trim($_POST['center_code2']) : '';
				$center_name3 = isset($_POST['center_name3']) ? trim($_POST['center_name3']) : '';
				$center_code3 = isset($_POST['center_code3']) ? trim($_POST['center_code3']) : '';
				
				$radiogender = isset($_POST['radiogender']) ? trim($_POST['radiogender']) : '';
				//$radioService = isset($_POST['radioService']) ? trim($_POST['radioService']) : '';
				$cmbExamCenter = isset($_POST['cmbExamCenter']) ? $_POST['cmbExamCenter'] : '';
				$txtFatherName = isset($_POST['txtFatherName']) ? $_POST['txtFatherName'] : '';
				$txtMotherName = isset($_POST['txtMotherName']) ? $_POST['txtMotherName'] : '';
				$txtidproofkey = isset($_POST['key']) ? $_POST['key'] : '';
				$txtidproofkey = explode("*",$txtidproofkey);
				$txtidproof = $this->decodepostdata($txtidproofkey[0]);
				$cmbCommunity = isset($_POST['cmbCommunity']) ? $_POST['cmbCommunity'] : '';
				$cmbReligion = isset($_POST['cmbReligion']) ? $_POST['cmbReligion'] : '';
				$radioResident = isset($_POST['radioResident']) ? $_POST['radioResident'] : '';
				$radioPhysicallY  = isset($_POST['radioPhysicallY']) ? $_POST['radioPhysicallY'] : '';
				$txtphtype  = isset($_POST['cmbPH']) ? $_POST['cmbPH'] : '';
			
				$txtPresentLocality = isset($_POST['txtPresentLocality']) ? $_POST['txtPresentLocality'] : '';
				$txtPresentPost = isset($_POST['txtPresentPost']) ? $_POST['txtPresentPost'] : '';
				$city_name = isset($_POST['city_name']) ? $_POST['city_name'] : '';
				$cmbPresentState = isset($_POST['cmbPresentState']) ? $_POST['cmbPresentState'] : '';
				$cmbPresentDist = isset($_POST['cmbPresentDist']) ? $_POST['cmbPresentDist'] : '';
				$txtPresentPin = isset($_POST['txtPresentPin']) ? $_POST['txtPresentPin'] : '';
				$chksameasresidential = isset($_POST['chksameasresidential']) ? $_POST['chksameasresidential']:'N';
				$radioSports = isset($_POST['radioSports']) ? trim($_POST['radioSports']) : '';
				$radioService = isset($_POST['radioService']) ? trim($_POST['radioService']) : '';
				$ex_doj = isset($_POST['txtdoj']) ? trim($_POST['txtdoj']) : '';
				$ex_dor = isset($_POST['txtdor']) ? trim($_POST['txtdor']) : '';
				$ex_total_service = isset($_POST['txtExp']) ? trim($_POST['txtExp']) : '';
				$cmbDcOffice = isset($_POST['cmbDcOffice']) ? $_POST['cmbDcOffice'] : '';
				$cmbidproof = isset($_POST['cmbidproof']) ? $_POST['cmbidproof'] : '';
				$radioews = isset($_POST['radioEWS']) ? $_POST['radioEWS'] : '';
				$radioExp = isset($_POST['radioExp']) ? $_POST['radioExp'] : '';
				$txtExpNirtar = isset($_POST['txtExpNirtar']) ? $_POST['txtExpNirtar'] : '';
				$ex_doj = date("Y-m-d", strtotime($ex_doj));
				$ex_dor = date("Y-m-d", strtotime($ex_dor));
				/*if($chksameasresidential == 'Y')
				{
					$txtPermenentLocality = isset($_POST['txtPresentLocality']) ? $_POST['txtPresentLocality'] : '';
					$txtPermanentPost = isset($_POST['txtPresentPost']) ? $_POST['txtPresentPost'] : '';
					$city_name1 = isset($_POST['city_name']) ? $_POST['city_name'] : '';
					$txtPermanentState = isset($_POST['cmbPresentState']) ? $_POST['cmbPresentState'] : '';
					$txtPermanentDist = isset($_POST['cmbPresentDist']) ? $_POST['cmbPresentDist'] : '';
					$txtPermanentPin = isset($_POST['txtPresentPin']) ? $_POST['txtPresentPin'] : '';
				}
				else
				{
					$txtPermenentLocality = isset($_POST['txtPermenentLocality']) ? $_POST['txtPermenentLocality'] : '';
					$txtPermanentPost = isset($_POST['txtPermanentPost']) ? $_POST['txtPermanentPost'] : '';
					$city_name1 = isset($_POST['city_name1']) ? $_POST['city_name1'] : '';
					$txtPermanentState = isset($_POST['cmbPermanentState']) ? $_POST['cmbPermanentState'] : '';
					$txtPermanentDist = isset($_POST['cmbPermanentDist']) ? $_POST['cmbPermanentDist'] : '';
					$txtPermanentPin = isset($_POST['txtPermanentPin']) ? $_POST['txtPermanentPin'] : '';
				}
				 */
				$txtPresentAddress = isset($_POST['txtPresentAddress']) ?  trim($_POST['txtPresentAddress']) : 'BBSR';
				$txtPresentLocality = isset($_POST['txtPresentLocality']) ? trim($_POST['txtPresentLocality']) : '';
				$txtPresentPost = isset($_POST['txtPresentPost']) ? trim($_POST['txtPresentPost']) : '';
				$cmbPresentDist = isset($_POST['cmbPresentDist']) ?  trim($_POST['cmbPresentDist']) : '';
				$txtPresentPin = isset($_POST['txtPresentPin']) ? trim($_POST['txtPresentPin']) : '761200';
				$cmbPresentState = isset($_POST['cmbPresentState']) ? trim($_POST['cmbPresentState']) : '';
				$txtPresentDistance = isset($_POST['txtPresentDistance']) ? trim($_POST['txtPresentDistance']) : '';

				//if permanent is same as present
				$chksameasresidential = isset($_POST['chksameasresidential']) ? $_POST['chksameasresidential']:'N';
				$txtPermenentAddress = isset($_POST['hidPermenentAddress']) ? trim($_POST['hidPermenentAddress']) : '';
				$txtPermenentLocality = isset($_POST['txtPermenentLocality']) ? trim($_POST['txtPermenentLocality']) : '';
				$txtPermanentPost = isset($_POST['txtPermanentPost']) ? trim($_POST['txtPermanentPost']) : 'PKD';
				$txtPermanentDist = isset($_POST['cmbPermanentDist']) ? trim($_POST['cmbPermanentDist']) : '';
				$txtPermanentState = isset($_POST['cmbPermanentState']) ?  trim($_POST['cmbPermanentState']) : '';
				$txtPermanentPin = isset($_POST['txtPermanentPin']) ? trim($_POST['txtPermanentPin']) : '761200';
				$txtPermanentMobile = isset($_POST['txtPermanentMobile']) ? trim($_POST['txtPermanentMobile']) : '';
				
				$cand_name = isset($_POST['cand_name']) ? trim($_POST['cand_name']) : '';
				$co_name = isset($_POST['co_name']) ? trim($_POST['co_name']) : '';
				$city_name = isset($_POST['city_name']) ? trim($_POST['city_name']) : '';
				$phone_no = $reg_user_id;
				$cand_name1 = isset($_POST['cand_name1']) ? trim($_POST['cand_name1']) : '';
				$co_name1 = isset($_POST['co_name1']) ? trim($_POST['co_name1']) : '';
				$city_name1 = isset($_POST['city_name1']) ? trim($_POST['city_name1']) : '';
				$phone_no1 = $reg_user_id;
				$txtemail = '';
				$txtemail1 = '';
				$edit = false;
				$fee = 0;
				$this->db->select("amount");
				$this->db->from('program_fee_setup');
				$this->db->where('program_code',$program_code);
				$this->db->where('category_code',$cmbCommunity);
				$result = $this->db->get();
				foreach($result->result_array() as $row)
				{
					$fee = $row['amount'];
				} 
				$this->db->select("count(*) AS cnt");
				$this->db->from('applicant_master');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				foreach($result->result_array() as $appl)
				{
					$count = $appl['cnt'];
				}
				if($count >= 1)
				{
					$edit = true;
				}
				else
				{
					$edit = false;
				}
				
				if($radioPhysicallY == 'NO')
				{
					$txtphtype='';
				}
				//echo $count.'</br>'.$edit.'</br>'.$reg_user_id.'</br>'.$program_code;
				if($edit)
				{
					$extra_fee = '0';
					$count_appl = '0';
					$this->db->select("count(*) AS cnt,appl_no");
					$this->db->from('applicant_appl_overview');
					$this->db->where('applied_program',$program_code);
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->group_by('appl_no');
					$result = $this->db->get();
					foreach($result->result_array() as $appl)
					{
						$count_appl = $appl['cnt'];
						$appl_no = $appl['appl_no'];
					}
					if($count_appl >= 1)
					{
						$paid_fee = 0;
						$cnt_paid_fee = 0;
						$this->db->select("count(*) as cnt,amount");
						$this->db->from('applicant_form_fee_overview');
						$this->db->where('appl_no',$appl_no);
						$this->db->group_by('appl_no');
						$result = $this->db->get();
						foreach($result->result_array() as $row)
						{
							$cnt_paid_fee = $row['cnt'];
							$paid_fee = $row['amount'];
						}
						if($cnt_paid_fee > 0)
						{
							if($fee > $paid_fee)
							{
								$extra_fee = $fee - $paid_fee;
							}
						}
						
					}
					
					$dbstatus = TRUE;
					$dbmessage = 'Data saved successfully';
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					
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
						// District code
				/*$this->db->select("district_code");
				$this->db->from('district_master');
				$this->db->where('district_name',$cmbPresentDist);
				$result = $this->db->get();
				$cmbPresentDist= $result->result_array();
				foreach($cmbPresentDist as $row)
				{
					$cmbPresentDist=$row['district_code'];
				}*/
				/*$this->db->select("district_code");
				$this->db->from('district_master');
				$this->db->where('district_name',$cmbPermanentDist);
				$result = $this->db->get();
				$cmbPermanentDist= $result->result_array();
				foreach($cmbPermanentDist as $row)
				{
					$cmbPermanentDist=$row['district_code'];
				}*/

				/*$this->db->select("state_code");
				$this->db->from('state_master');
				$this->db->where('state_name',$cmbPresentState);
				$result = $this->db->get();
				$cmbPresentState= $result->result_array();
				foreach($cmbPresentState as $row)
				{
					$cmbPresentState=$row['state_code'];
				}*/

				/*$this->db->select("state_code");
				$this->db->from('state_master');
				$this->db->where('state_name',$cmbPermanentState);
				$result = $this->db->get();
				$cmbPermanentState= $result->result_array();
				foreach($cmbPermanentState as $row)
				{
					$cmbPermanentState=$row['state_code'];
				}*/
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
							'institute_code'=>$institute_code, 
							'mobile'=>$reg_user_id, 
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
							'mobile'=>$reg_user_id, 
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
							'mobile'=>$reg_user_id, 
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
							'mobile'=>$reg_user_id, 
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
						'first_name' 				=> $txtFirstName,
							'mid_name' 				    => $txtMiddleName,
							'last_name' 				=> $txtLastName,
							'full_name' 				=> $fullname,
							'gender'					=> $radiogender, 
							'exam_center_code' 			=> $center_name1,
							'exam_center_code1' 		=> $center_name2,
							'exam_center_code2' 		=> $center_name3,
							'is_sports'					=>$radioSports,
							'dc_office' 				=> $cmbDcOffice,
							'is_ex_serviceman'			=>$radioService,
							'ex_doj'					=> $ex_doj,
							'ex_dor'					=> $ex_dor,
							'ex_total_service'			=> $ex_total_service,
							'father_name'				=> $txtFatherName, 
							'mothers_name'				=> $txtMotherName, 
							'dob'						=> $dob, 
							'age'						=> $age, 
							'id_proof' 					=> $cmbidproof,
							'id_proof_number'			=> $txtidproof, 
							'category'					=> $cmbCommunity, 
							'religion'					=> $cmbReligion, 
							'ap_resident'				=> $radioResident, 
							'physically_challenged'		=> $radioPhysicallY,
							'comm_address_ref_id'		=>$comm_address_ref_id,
							'perm_address_ref_id'		=>$perm_address_ref_id,
							'fee'						=> $fee,
							'extra_fee'					=> $extra_fee,
							'phtype'					=> $txtphtype,
							'is_ews'					=> $radioews,
							'is_exp'					=> $radioExp,
							'no_of_exp'					=> $txtExpNirtar
							
						);
						$this->db->where('reg_user_id' , $reg_user_id);
						$this->db->where('applied_program',$program_code);
						$query = $this->db->update('applicant_master',$applicant_master_update_array);
						/*echo $this->db->last_query();
						die();*/
						if(!$query)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error update Applicant Master';
						}
						else{
							$applicant_history_insert_array = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'mid_name' 				    => $txtMiddleName,
							'last_name' 				=> $txtLastName,
							'full_name' 				=> $fullname,
							'gender'					=> $radiogender, 
							'exam_center_code' 			=> $center_name1,
							'exam_center_code1' 		=> $center_name2,
							'exam_center_code2' 		=> $center_name3,
							'is_sports'					=>$radioSports,
							'dc_office' 				=> $cmbDcOffice,
							'is_ex_serviceman'			=>$radioService,
							'father_name'				=> $txtFatherName, 
							'mothers_name'				=> $txtMotherName, 
							'dob'						=> $dob, 
							'id_proof' 					=> $cmbidproof,
							'id_proof_number'			=> $txtidproof, 
							'category'					=> $cmbCommunity, 
							'ap_resident'				=> $radioResident, 
							'physically_challenged'		=> $radioPhysicallY,
							'comm_address_ref_id'		=>$comm_address_ref_id,
							'perm_address_ref_id'		=>$perm_address_ref_id,
							'phtype'					=> $txtphtype
							);
							$history_applicant = $this->db->insert('applicant_history',$applicant_history_insert_array);
							if(!$history_applicant){
								$dbStatus = FALSE;
								$dbMessage = 'Error inserting applicant_history';
							}
						}
						
						if($extra_fee != 0){
							$appl_overview = array(
								'appl_status'=>'Document Uploaded'
							);
							$this->db->where('appl_no',$appl_no);
							$this->db->where('applied_program',$program_code);
							$update_appl_overview = $this->db->update('applicant_appl_overview',$appl_overview);
							if(!$update_appl_overview)
							{
								$dbstatus = FALSE;
								$dbmessage = 'Error updating applicant_appl_overview';
							}
						}
				}
				else
				{ 
					
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
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'institute_code'=>$institute_code, 
							'created_by' => $reg_user_id,
							'distance_from' => $txtPresentDistance,
							'created_on' => $now 
						);
						$this->db->insert('applicant_address',$applicant_address_array1);
						
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbmessage = 'Error inserting Applicant same address';
						}
						else
							$comm_address_ref_id = $this->db->insert_id();
						
							//echo $comm_address_ref_id;die();
							$applicant_master_insert_array = array(
							'reg_user_id' 				=> $reg_user_id,
							'appl_status' 				=> 'Applicant_Details', 
							'applied_program' 			=> $program_code,
							'first_name' 				=> $txtFirstName,
							'mid_name' 				    => $txtMiddleName,
							'last_name' 				=> $txtLastName,
							'full_name' 				=> $fullname,
							'gender'					=> $radiogender, 
							'exam_center_code' 			=> $center_name1,
							'exam_center_code1' 		=> $center_name2,
							'exam_center_code2' 		=> $center_name3,
							'is_sports'					=>$radioSports,
							'dc_office' 				=> $cmbDcOffice,
							'is_ex_serviceman'			=>$radioService,
							'ex_doj'					=> $ex_doj,
							'ex_dor'					=> $ex_dor,
							'ex_total_service'			=> $ex_total_service,
							'father_name'				=> $txtFatherName, 
							'mothers_name'				=> $txtMotherName, 
							'dob'						=> $dob, 
							'age'						=> $age, 
							'id_proof' 					=> $cmbidproof,
							'id_proof_number'			=> $txtidproof, 
							'category'					=> $cmbCommunity, 
							'religion'					=> $cmbReligion, 
							'ap_resident'				=> $radioResident, 
							'physically_challenged'		=> $radioPhysicallY,
							'comm_address_ref_id'		=>$comm_address_ref_id,
							'perm_address_ref_id'		=>$comm_address_ref_id,
							'fee'						=> $fee, 
							'extra_fee'					=> '0', 
							'phtype'					=> $txtphtype,
							'is_ews'					=> $radioews,
							'is_exp'					=> $radioExp,
							'no_of_exp'					=> $txtExpNirtar
							);
						$this->db->insert('applicant_master',$applicant_master_insert_array);
						
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbmessage = 'Error inserting Applicant same address';
						}
						
						$applicant_history_insert_array=array(
							'reg_user_id' 				=> $reg_user_id,
							'applied_program' 			=> $program_code,
							'first_name' 				=> $txtFirstName,
							'mid_name' 				    => $txtMiddleName,
							'last_name' 				=> $txtLastName,
							'full_name' 				=> $fullname,
							'gender'					=> $radiogender, 
							'exam_center_code' 			=> $center_name1,
							'exam_center_code1' 		=> $center_name2,
							'exam_center_code2' 		=> $center_name3,
							'is_sports'					=>$radioSports,
							'dc_office' 				=> $cmbDcOffice,
							'is_ex_serviceman'			=>$radioService,
							'father_name'				=> $txtFatherName, 
							'mothers_name'				=> $txtMotherName, 
							'dob'						=> $dob, 
							'id_proof' 					=> $cmbidproof,
							'id_proof_number'			=> $txtidproof, 
							'category'					=> $cmbCommunity, 
							'ap_resident'				=> $radioResident, 
							'physically_challenged'		=> $radioPhysicallY, 
							'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$comm_address_ref_id,
							'phtype'					=> $txtphtype );
						$this->db->insert('applicant_history',$applicant_history_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbmessage = 'Error inserting Applicant history same address';
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
							'institute_code'=>$institute_code,  
							'mobile'=>$reg_user_id, 
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
								'institute_code'=>$institute_code, 
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
							'reg_user_id' 				=> $reg_user_id,
							'appl_status' 				=> 'Applicant_Details',
							'applied_program' 			=> $program_code,
							'first_name' 				=> $txtFirstName,
							'mid_name' 				    => $txtMiddleName,
							'last_name' 				=> $txtLastName,
							'full_name' 				=> $fullname,
							'gender'					=> $radiogender, 
							'exam_center_code' 			=> $center_name1,
							'exam_center_code1' 		=> $center_name2,
							'exam_center_code2' 		=> $center_name3,
							'is_sports'					=>$radioSports,
							'dc_office' 				=> $cmbDcOffice,
							'is_ex_serviceman'			=>$radioService,
							'ex_doj'					=> $ex_doj,
							'ex_dor'					=> $ex_dor,
							'ex_total_service'			=> $ex_total_service,
							'father_name'				=> $txtFatherName, 
							'mothers_name'				=> $txtMotherName, 
							'dob'						=> $dob, 
							'age'						=> $age, 
							'id_proof' 					=> $cmbidproof,
							'id_proof_number'			=> $txtidproof, 
							'category'					=> $cmbCommunity, 
							'religion'					=> $cmbReligion, 
							'ap_resident'				=> $radioResident, 
							'physically_challenged'		=> $radioPhysicallY, 
							
							'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$perm_address_ref_id,
							'fee'						=> $fee, 
							'extra_fee'					=> '0', 
							'phtype'					=> $txtphtype,
							'is_ews'					=> $radioews,
							'is_exp'					=> $radioExp,
							'no_of_exp'					=> $txtExpNirtar
							);
						$this->db->insert('applicant_master',$applicant_master_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant same address';
						}
						$applicant_history_insert_array=array(
							'reg_user_id' 				=> $reg_user_id,
							'applied_program' 			=> $program_code,
							'first_name' 				=> $txtFirstName,
							'mid_name' 				    => $txtMiddleName,
							'last_name' 				=> $txtLastName,
							'full_name' 				=> $fullname,
							'gender'					=> $radiogender, 
							'exam_center_code' 			=> $center_name1,
							'exam_center_code1' 		=> $center_name2,
							'exam_center_code2' 		=> $center_name3,
							'is_sports'					=>$radioSports,
							'dc_office' 				=> $cmbDcOffice,
							'is_ex_serviceman'			=>$radioService,
							'father_name'				=> $txtFatherName, 
							'mothers_name'				=> $txtMotherName, 
							'dob'						=> $dob, 
							'id_proof' 					=> $cmbidproof,
							'id_proof_number'			=> $txtidproof, 
							'category'					=> $cmbCommunity, 
							'ap_resident'				=> $radioResident, 
							'physically_challenged'		=> $radioPhysicallY, 
								'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$perm_address_ref_id,
							'phtype'					=> $txtphtype
							);
						$this->db->insert('applicant_history',$applicant_history_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant history different address';
						}
						
					}
					
					
				}
				
				return array('status' => $dbStatus, 'msg' => $dbMessage);
				
			break;
			case 'save_applicant_details_temp_001':
				$dbStatus = TRUE;
				$dbMessage = "Data Saved Successfully";
				
				/*$program_code = $this->session->userdata('admcode');*/
				$program_code = isset($_POST['hidprogram']) ? trim($_POST['hidprogram']) : '';
				$program_code_arr = explode('_',$program_code);
				$institute_code = $program_code_arr[1];
				$reg_user_id = $this->session->userdata('reg_user_id');
				//echo($reg_user_id);die();
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s");
        		
				$program_code = isset($_POST['hidprogram']) ? trim($_POST['hidprogram']) : '';
				$txtFirstName = isset($_POST['txtFirstName']) ? trim($_POST['txtFirstName']) : '';
				$txtMiddleName = isset($_POST['txtMiddleName']) ?  trim($_POST['txtMiddleName']) : '';
				$txtLastName = isset($_POST['txtLastName']) ? trim($_POST['txtLastName']) : '';
				$fullname = $txtFirstName." ".$txtMiddleName." ".$txtLastName;

				$d = isset($_POST['cmbDay']) ? trim($_POST['cmbDay']) : '';
				$m = isset($_POST['cmbMonth']) ? trim($_POST['cmbMonth']) : '';
				$y = isset($_POST['cmbYear']) ? trim($_POST['cmbYear']) : '';
				$dob = isset($_POST['hidDateFormat']) ? trim($_POST['hidDateFormat']) : '';
				$dob = date("Y-m-d", strtotime($dob));
				
				$center_name1 = isset($_POST['center_name1']) ? trim($_POST['center_name1']) : '';
				$center_code1 = isset($_POST['center_code1']) ? trim($_POST['center_code1']) : '';
				$center_name2 = isset($_POST['center_name2']) ? trim($_POST['center_name2']) : '';
				$center_code2 = isset($_POST['center_code2']) ? trim($_POST['center_code2']) : '';
				$center_name3 = isset($_POST['center_name3']) ? trim($_POST['center_name3']) : '';
				$center_code3 = isset($_POST['center_code3']) ? trim($_POST['center_code3']) : '';
				
				$radiogender = isset($_POST['radiogender']) ? trim($_POST['radiogender']) : '';
				//$radioService = isset($_POST['radioService']) ? trim($_POST['radioService']) : '';
				$cmbExamCenter = isset($_POST['cmbExamCenter']) ? $_POST['cmbExamCenter'] : '';
				$txtFatherName = isset($_POST['txtFatherName']) ? $_POST['txtFatherName'] : '';
				$txtMotherName = isset($_POST['txtMotherName']) ? $_POST['txtMotherName'] : '';
				$txtidproof = isset($_POST['txtidproof']) ? $_POST['txtidproof'] : '';
				$cmbCommunity = isset($_POST['cmbCommunity']) ? $_POST['cmbCommunity'] : '';
				$radioResident = isset($_POST['radioResident']) ? $_POST['radioResident'] : '';
				$radioPhysicallY  = isset($_POST['radioPhysicallY']) ? $_POST['radioPhysicallY'] : '';
				$txtphtype  = isset($_POST['cmbPH']) ? $_POST['cmbPH'] : '';
			
				$txtPresentLocality = isset($_POST['txtPresentLocality']) ? $_POST['txtPresentLocality'] : '';
				$txtPresentPost = isset($_POST['txtPresentPost']) ? $_POST['txtPresentPost'] : '';
				$txtPresentPanchayat = isset($_POST['txtPresentPanchayat']) ? $_POST['txtPresentPanchayat'] : '';
				$txtPresentBlock = isset($_POST['txtPresentBlock']) ? $_POST['txtPresentBlock'] : '';
				$city_name = isset($_POST['city_name']) ? $_POST['city_name'] : '';
				$cmbPresentState = isset($_POST['cmbPresentState']) ? $_POST['cmbPresentState'] : '';
				$cmbPresentDist = isset($_POST['cmbPresentDist']) ? $_POST['cmbPresentDist'] : '';
				$txtPresentPin = isset($_POST['txtPresentPin']) ? $_POST['txtPresentPin'] : '';
				$chksameasresidential = isset($_POST['chksameasresidential']) ? $_POST['chksameasresidential']:'N';
				$radioSports = isset($_POST['radioSports']) ? trim($_POST['radioSports']) : '';
				$radioService = isset($_POST['radioService']) ? trim($_POST['radioService']) : '';
				$cmbDcOffice = isset($_POST['cmbDcOffice']) ? $_POST['cmbDcOffice'] : '';
				$cmbidproof = isset($_POST['cmbidproof']) ? $_POST['cmbidproof'] : '';
				$radioews = isset($_POST['radioEWS']) ? $_POST['radioEWS'] : '';
				$radioExp = isset($_POST['radioExp']) ? $_POST['radioExp'] : '';
				$txtExpNirtar = isset($_POST['txtExpNirtar']) ? $_POST['txtExpNirtar'] : '';
				/*if($chksameasresidential == 'Y')
				{
					$txtPermenentLocality = isset($_POST['txtPresentLocality']) ? $_POST['txtPresentLocality'] : '';
					$txtPermanentPost = isset($_POST['txtPresentPost']) ? $_POST['txtPresentPost'] : '';
					$city_name1 = isset($_POST['city_name']) ? $_POST['city_name'] : '';
					$txtPermanentState = isset($_POST['cmbPresentState']) ? $_POST['cmbPresentState'] : '';
					$txtPermanentDist = isset($_POST['cmbPresentDist']) ? $_POST['cmbPresentDist'] : '';
					$txtPermanentPin = isset($_POST['txtPresentPin']) ? $_POST['txtPresentPin'] : '';
				}
				else
				{
					$txtPermenentLocality = isset($_POST['txtPermenentLocality']) ? $_POST['txtPermenentLocality'] : '';
					$txtPermanentPost = isset($_POST['txtPermanentPost']) ? $_POST['txtPermanentPost'] : '';
					$city_name1 = isset($_POST['city_name1']) ? $_POST['city_name1'] : '';
					$txtPermanentState = isset($_POST['cmbPermanentState']) ? $_POST['cmbPermanentState'] : '';
					$txtPermanentDist = isset($_POST['cmbPermanentDist']) ? $_POST['cmbPermanentDist'] : '';
					$txtPermanentPin = isset($_POST['txtPermanentPin']) ? $_POST['txtPermanentPin'] : '';
				}
				 */
				$txtPresentAddress = isset($_POST['txtPresentAddress']) ?  trim($_POST['txtPresentAddress']) : 'BBSR';
				$txtPresentLocality = isset($_POST['txtPresentLocality']) ? trim($_POST['txtPresentLocality']) : '';
				$txtPresentPost = isset($_POST['txtPresentPost']) ? trim($_POST['txtPresentPost']) : '';
				$cmbPresentDist = isset($_POST['cmbPresentDist']) ?  trim($_POST['cmbPresentDist']) : '';
				$txtPresentPin = isset($_POST['txtPresentPin']) ? trim($_POST['txtPresentPin']) : '761200';
				$cmbPresentState = isset($_POST['cmbPresentState']) ? trim($_POST['cmbPresentState']) : '';
				$txtPresentDistance = isset($_POST['txtPresentDistance']) ? trim($_POST['txtPresentDistance']) : '';
				$txtPresentPanchayat = isset($_POST['txtPresentPanchayat']) ? $_POST['txtPresentPanchayat'] : '';
				$txtPresentBlock = isset($_POST['txtPresentBlock']) ? $_POST['txtPresentBlock'] : '';
				$txtPermanentPanchayat = isset($_POST['txtPermanentPanchayat']) ? $_POST['txtPermanentPanchayat'] : '';
				$txtPermanentBlock = isset($_POST['txtPermanentBlock']) ? $_POST['txtPermanentBlock'] : '';
				

				//if permanent is same as present
				$chksameasresidential = isset($_POST['chksameasresidential']) ? $_POST['chksameasresidential']:'N';
				$txtPermenentAddress = isset($_POST['hidPermenentAddress']) ? trim($_POST['hidPermenentAddress']) : '';
				$txtPermenentLocality = isset($_POST['txtPermenentLocality']) ? trim($_POST['txtPermenentLocality']) : '';
				$txtPermanentPost = isset($_POST['txtPermanentPost']) ? trim($_POST['txtPermanentPost']) : 'PKD';
				$txtPermanentDist = isset($_POST['cmbPermanentDist']) ? trim($_POST['cmbPermanentDist']) : '';
				$txtPermanentState = isset($_POST['cmbPermanentState']) ?  trim($_POST['cmbPermanentState']) : '';
				$txtPermanentPin = isset($_POST['txtPermanentPin']) ? trim($_POST['txtPermanentPin']) : '761200';
				$txtPermanentMobile = isset($_POST['txtPermanentMobile']) ? trim($_POST['txtPermanentMobile']) : '';
				$radiomaritalstatus = isset($_POST['radiomaritalstatus']) ? trim($_POST['radiomaritalstatus']) : '';
				$txtHomeDist = isset($_POST['txtHomeDist']) ? trim($_POST['txtHomeDist']) : '';
				$txtPHPercent = isset($_POST['txtPHPercent']) ? trim($_POST['txtPHPercent']) : '';
				$cand_name = isset($_POST['cand_name']) ? trim($_POST['cand_name']) : '';
				$co_name = isset($_POST['co_name']) ? trim($_POST['co_name']) : '';
				$city_name = isset($_POST['city_name']) ? trim($_POST['city_name']) : '';
				$phone_no = $reg_user_id;
				$cand_name1 = isset($_POST['cand_name1']) ? trim($_POST['cand_name1']) : '';
				$co_name1 = isset($_POST['co_name1']) ? trim($_POST['co_name1']) : '';
				$city_name1 = isset($_POST['city_name1']) ? trim($_POST['city_name1']) : '';
				$phone_no1 = $reg_user_id;
				$txtemail = '';
				$txtemail1 = '';
				$edit = false;
				$fee = 0;
				$this->db->select("amount");
				$this->db->from('program_fee_setup');
				$this->db->where('program_code',$program_code);
				$this->db->where('category_code',$cmbCommunity);
				$result = $this->db->get();
				foreach($result->result_array() as $row)
				{
					$fee = $row['amount'];
				} 
				$this->db->select("count(*) AS cnt");
				$this->db->from('applicant_master');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				foreach($result->result_array() as $appl)
				{
					$count = $appl['cnt'];
				}
				if($count >= 1)
				{
					$edit = true;
				}
				else
				{
					$edit = false;
				}
				
				if($radioPhysicallY == 'NO')
				{
					$txtphtype='';
				}
				//echo $count.'</br>'.$edit.'</br>'.$reg_user_id.'</br>'.$program_code;
				if($edit)
				{
					$extra_fee = '0';
					$count_appl = '0';
					$this->db->select("count(*) AS cnt,appl_no");
					$this->db->from('applicant_appl_overview');
					$this->db->where('applied_program',$program_code);
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->group_by('appl_no');
					$result = $this->db->get();
					foreach($result->result_array() as $appl)
					{
						$count_appl = $appl['cnt'];
						$appl_no = $appl['appl_no'];
					}
					if($count_appl >= 1)
					{
						$paid_fee = 0;
						$cnt_paid_fee = 0;
						$this->db->select("count(*) as cnt,amount");
						$this->db->from('applicant_form_fee_overview');
						$this->db->where('appl_no',$appl_no);
						$this->db->group_by('appl_no');
						$result = $this->db->get();
						foreach($result->result_array() as $row)
						{
							$cnt_paid_fee = $row['cnt'];
							$paid_fee = $row['amount'];
						}
						if($cnt_paid_fee > 0)
						{
							if($fee > $paid_fee)
							{
								$extra_fee = $fee - $paid_fee;
							}
						}
						
					}
					
					$dbstatus = TRUE;
					$dbmessage = 'Data saved successfully';
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					
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
						// District code
				$this->db->select("district_code");
				$this->db->from('district_master');
				$this->db->where('district_name',$cmbPresentDist);
				$result = $this->db->get();
				$cmbPresentDist= $result->result_array();
				foreach($cmbPresentDist as $row)
				{
					$cmbPresentDist=$row['district_code'];
				}
				$this->db->select("district_code");
				$this->db->from('district_master');
				$this->db->where('district_name',$cmbPermanentDist);
				$result = $this->db->get();
				$cmbPermanentDist= $result->result_array();
				foreach($cmbPermanentDist as $row)
				{
					$cmbPermanentDist=$row['district_code'];
				}

				$this->db->select("state_code");
				$this->db->from('state_master');
				$this->db->where('state_name',$cmbPresentState);
				$result = $this->db->get();
				$cmbPresentState= $result->result_array();
				foreach($cmbPresentState as $row)
				{
					$cmbPresentState=$row['state_code'];
				}

				$this->db->select("state_code");
				$this->db->from('state_master');
				$this->db->where('state_name',$cmbPermanentState);
				$result = $this->db->get();
				$cmbPermanentState= $result->result_array();
				foreach($cmbPermanentState as $row)
				{
					$cmbPermanentState=$row['state_code'];
				}
					if($chksameasresidential == $sameaspresent && $chksameasresidential=='Y')
					{
						$applicant_address_array = array(
							'address_1' => $txtPresentLocality,
							'post_office' => $txtPresentPost,
							'panchayat' => $txtPresentPanchayat,
							'block' => $txtPresentBlock,
							'district_code' => $cmbPresentDist,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'cand_name'=>$cand_name, 
							'co_name'=>$co_name,
							'city_name'=>$city_name, 
							'institute_code'=>$institute_code, 
							'mobile'=>$reg_user_id, 
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
							'panchayat' => $txtPresentPanchayat,
							'block' => $txtPresentBlock,
							'district_code' => $cmbPresentDist,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'cand_name'=>$cand_name, 
							'co_name'=>$co_name,
							'city_name'=>$city_name, 
							'mobile'=>$reg_user_id, 
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
							'panchayat' => $txtPermanentPanchayat,
							'block' => $txtPermanentBlock,
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
							'panchayat' => $txtPresentPanchayat,
							'block' => $txtPresentBlock,
							'district_code' => $cmbPresentDist,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'cand_name'=>$cand_name, 
							'co_name'=>$co_name,
							'city_name'=>$city_name, 
							'mobile'=>$reg_user_id, 
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
							'panchayat' => $txtPresentPanchayat,
							'block' => $txtPresentBlock,
							'district_code' => $cmbPresentDist,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'cand_name'=>$cand_name, 
							'co_name'=>$co_name,
							'city_name'=>$city_name, 
							'mobile'=>$reg_user_id, 
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
								'panchayat' => $txtPermanentPanchayat,
								'block' => $txtPermanentBlock,
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
						'first_name' 				=> $txtFirstName,
							'mid_name' 				    => $txtMiddleName,
							'last_name' 				=> $txtLastName,
							'full_name' 				=> $fullname,
							'gender'					=> $radiogender, 
							'exam_center_code' 			=> $center_name1,
							'exam_center_code1' 		=> $center_name2,
							'exam_center_code2' 		=> $center_name3,
							'is_sports'					=>$radioSports,
							'dc_office' 				=> $cmbDcOffice,
							'is_ex_serviceman'			=>$radioService,
							'father_name'				=> $txtFatherName, 
							'mothers_name'				=> $txtMotherName, 
							'dob'						=> $dob, 
							'id_proof' 					=> $cmbidproof,
							'id_proof_number'			=> $txtidproof, 
							'category'					=> $cmbCommunity, 
							'ap_resident'				=> $radioResident, 
							'physically_challenged'		=> $radioPhysicallY,
							'comm_address_ref_id'		=>$comm_address_ref_id,
							'perm_address_ref_id'		=>$perm_address_ref_id,
							'fee'						=> $fee,
							'extra_fee'					=> $extra_fee,
							'marital_status'			=> $radiomaritalstatus,
							'district_code'				=> $txtHomeDist,
							'disability_percent'		=> $txtPHPercent,
							'phtype'					=> $txtphtype,
							'is_ews'					=> $radioews,
							'is_exp'					=> $radioExp,
							'no_of_exp'					=> $txtExpNirtar
							
						);
						$this->db->where('reg_user_id' , $reg_user_id);
						$this->db->where('applied_program',$program_code);
						$query = $this->db->update('applicant_master',$applicant_master_update_array);
						/*echo $this->db->last_query();
						die();*/
						if(!$query)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error update Applicant Master';
						}
						else{
							$applicant_history_insert_array = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'mid_name' 				    => $txtMiddleName,
							'last_name' 				=> $txtLastName,
							'full_name' 				=> $fullname,
							'gender'					=> $radiogender, 
							'exam_center_code' 			=> $center_name1,
							'exam_center_code1' 		=> $center_name2,
							'exam_center_code2' 		=> $center_name3,
							'is_sports'					=>$radioSports,
							'dc_office' 				=> $cmbDcOffice,
							'is_ex_serviceman'			=>$radioService,
							'father_name'				=> $txtFatherName, 
							'mothers_name'				=> $txtMotherName, 
							'dob'						=> $dob, 
							'id_proof' 					=> $cmbidproof,
							'id_proof_number'			=> $txtidproof, 
							'category'					=> $cmbCommunity, 
							'ap_resident'				=> $radioResident, 
							'physically_challenged'		=> $radioPhysicallY,
							'comm_address_ref_id'		=>$comm_address_ref_id,
							'perm_address_ref_id'		=>$perm_address_ref_id,
							'phtype'					=> $txtphtype
							);
							$history_applicant = $this->db->insert('applicant_history',$applicant_history_insert_array);
							if(!$history_applicant){
								$dbStatus = FALSE;
								$dbMessage = 'Error inserting applicant_history';
							}
						}
						
						if($extra_fee != 0){
							$appl_overview = array(
								'appl_status'=>'Document Uploaded'
							);
							$this->db->where('appl_no',$appl_no);
							$this->db->where('applied_program',$program_code);
							$update_appl_overview = $this->db->update('applicant_appl_overview',$appl_overview);
							if(!$update_appl_overview)
							{
								$dbstatus = FALSE;
								$dbmessage = 'Error updating applicant_appl_overview';
							}
						}
				}
				else
				{ 
					
					$dbStatus = TRUE;
					$dbmessage = 'Data saved Successfully';
					$comm_address_ref_id = '';
					if($chksameasresidential == 'Y')
					{
						
						$applicant_address_array1 = array(
							'address_1' => $txtPresentLocality,
							'post_office' => $txtPresentPost,
							'district_code' => $cmbPresentDist,
							'panchayat' => $txtPresentPanchayat,
							'block' => $txtPresentBlock,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'cand_name'=>$cand_name, 
							'co_name'=>$co_name,
							'city_name'=>$city_name, 
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'institute_code'=>$institute_code, 
							'created_by' => $reg_user_id,
							'distance_from' => $txtPresentDistance,
							'created_on' => $now 
						);
						$this->db->insert('applicant_address',$applicant_address_array1);
						
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbmessage = 'Error inserting Applicant same address';
						}
						else
							$comm_address_ref_id = $this->db->insert_id();
						
							//echo $comm_address_ref_id;die();
							$applicant_master_insert_array = array(
							'reg_user_id' 				=> $reg_user_id,
							'appl_status' 				=> 'Applicant_Details', 
							'applied_program' 			=> $program_code,
							'first_name' 				=> $txtFirstName,
							'mid_name' 				    => $txtMiddleName,
							'last_name' 				=> $txtLastName,
							'full_name' 				=> $fullname,
							'gender'					=> $radiogender, 
							'exam_center_code' 			=> $center_name1,
							'exam_center_code1' 		=> $center_name2,
							'exam_center_code2' 		=> $center_name3,
							'is_sports'					=>$radioSports,
							'dc_office' 				=> $cmbDcOffice,
							'is_ex_serviceman'			=>$radioService,
							'father_name'				=> $txtFatherName, 
							'mothers_name'				=> $txtMotherName, 
							'dob'						=> $dob, 
							'id_proof' 					=> $cmbidproof,
							'id_proof_number'			=> $txtidproof, 
							'category'					=> $cmbCommunity, 
							'ap_resident'				=> $radioResident, 
							'physically_challenged'		=> $radioPhysicallY,
							'comm_address_ref_id'		=>$comm_address_ref_id,
							'perm_address_ref_id'		=>$comm_address_ref_id,
							'fee'						=> $fee, 
							'marital_status'			=> $radiomaritalstatus,
							'district_code'				=> $txtHomeDist,
							'disability_percent'		=> $txtPHPercent,
							'extra_fee'					=> '0', 
							'phtype'					=> $txtphtype,
							'is_ews'					=> $radioews,
							'is_exp'					=> $radioExp,
							'no_of_exp'					=> $txtExpNirtar
							);
						$this->db->insert('applicant_master',$applicant_master_insert_array);
						
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbmessage = 'Error inserting Applicant same address';
						}
						
						$applicant_history_insert_array=array(
							'reg_user_id' 				=> $reg_user_id,
							'applied_program' 			=> $program_code,
							'first_name' 				=> $txtFirstName,
							'mid_name' 				    => $txtMiddleName,
							'last_name' 				=> $txtLastName,
							'full_name' 				=> $fullname,
							'gender'					=> $radiogender, 
							'exam_center_code' 			=> $center_name1,
							'exam_center_code1' 		=> $center_name2,
							'exam_center_code2' 		=> $center_name3,
							'is_sports'					=>$radioSports,
							'dc_office' 				=> $cmbDcOffice,
							'is_ex_serviceman'			=>$radioService,
							'father_name'				=> $txtFatherName, 
							'mothers_name'				=> $txtMotherName, 
							'dob'						=> $dob, 
							'id_proof' 					=> $cmbidproof,
							'id_proof_number'			=> $txtidproof, 
							'category'					=> $cmbCommunity, 
							'ap_resident'				=> $radioResident, 
							'physically_challenged'		=> $radioPhysicallY, 
							'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$comm_address_ref_id,
							'phtype'					=> $txtphtype );
						$this->db->insert('applicant_history',$applicant_history_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbmessage = 'Error inserting Applicant history same address';
						}
						
						
					}
					else
					{
						$applicant_address_array1 = array(
							'address_1' => $txtPresentLocality,
							'post_office' => $txtPresentPost,
							'panchayat' => $txtPresentPanchayat,
							'block' => $txtPresentBlock,
							'district_code' => $cmbPresentDist,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'cand_name'=>$cand_name, 
							'co_name'=>$co_name,
							'city_name'=>$city_name,
							'institute_code'=>$institute_code,  
							'mobile'=>$reg_user_id, 
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
								'panchayat' => $txtPermanentPanchayat,
								'block' => $txtPermanentBlock,
								'state_code' => $txtPermanentState,
								'pin' => $txtPermanentPin,
								'institute_code'=>$institute_code, 
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
							'reg_user_id' 				=> $reg_user_id,
							'appl_status' 				=> 'Applicant_Details',
							'applied_program' 			=> $program_code,
							'first_name' 				=> $txtFirstName,
							'mid_name' 				    => $txtMiddleName,
							'last_name' 				=> $txtLastName,
							'full_name' 				=> $fullname,
							'gender'					=> $radiogender, 
							'exam_center_code' 			=> $center_name1,
							'exam_center_code1' 		=> $center_name2,
							'exam_center_code2' 		=> $center_name3,
							'is_sports'					=>$radioSports,
							'dc_office' 				=> $cmbDcOffice,
							'is_ex_serviceman'			=>$radioService,
							'father_name'				=> $txtFatherName, 
							'mothers_name'				=> $txtMotherName, 
							'dob'						=> $dob, 
							'id_proof' 					=> $cmbidproof,
							'id_proof_number'			=> $txtidproof, 
							'category'					=> $cmbCommunity, 
							'ap_resident'				=> $radioResident, 
							'physically_challenged'		=> $radioPhysicallY, 
							 'marital_status'			=> $radiomaritalstatus,
							'district_code'				=> $txtHomeDist,
							'disability_percent'		=> $txtPHPercent,
							'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$perm_address_ref_id,
							'fee'						=> $fee, 
							'extra_fee'					=> '0', 
							'phtype'					=> $txtphtype,
							'is_ews'					=> $radioews,
							'is_exp'					=> $radioExp,
							'no_of_exp'					=> $txtExpNirtar
							);
						$this->db->insert('applicant_master',$applicant_master_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant same address';
						}
						$applicant_history_insert_array=array(
							'reg_user_id' 				=> $reg_user_id,
							'applied_program' 			=> $program_code,
							'first_name' 				=> $txtFirstName,
							'mid_name' 				    => $txtMiddleName,
							'last_name' 				=> $txtLastName,
							'full_name' 				=> $fullname,
							'gender'					=> $radiogender, 
							'exam_center_code' 			=> $center_name1,
							'exam_center_code1' 		=> $center_name2,
							'exam_center_code2' 		=> $center_name3,
							'is_sports'					=>$radioSports,
							'dc_office' 				=> $cmbDcOffice,
							'is_ex_serviceman'			=>$radioService,
							'father_name'				=> $txtFatherName, 
							'mothers_name'				=> $txtMotherName, 
							'dob'						=> $dob, 
							'id_proof' 					=> $cmbidproof,
							'id_proof_number'			=> $txtidproof, 
							'category'					=> $cmbCommunity, 
							'ap_resident'				=> $radioResident, 
							'physically_challenged'		=> $radioPhysicallY, 
								'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$perm_address_ref_id,
							'phtype'					=> $txtphtype
							);
						$this->db->insert('applicant_history',$applicant_history_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant history different address';
						}
						
					}
					
					
				}
				
				return array('status' => $dbStatus, 'msg' => $dbMessage);
				
			break;
			case 'save_applicant_academic_details_temp':
				$dbStatus = TRUE;
				$dbMessage = "Data Saved Successfully";
				
				$program_code = $this->session->userdata('admcode');
				$program_code_arr = explode('_',$program_code);
				$institute_code = $program_code_arr[1];
				$reg_user_id = $this->session->userdata('reg_user_id');
				
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s");
        		
				$this->db->select("A.qualification_code, B.qualification_name, B.division");
				$this->db->from('program_qualification_setup A');
				$this->db->join('qualification_master B','A.qualification_code = B.qualification_code','inner');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.record_status',1);
				$this->db->where('B.record_status',1);
				$this->db->order_by('A.id');
				
				$result = $this->db->get();
				
				$allQualifications = $result->result_array();
				
				$txtExamName1 = isset($_POST['txtExamName1']) ? $_POST['txtExamName1'] : '';
				$txtStream1 = isset($_POST['txtStream1']) ? $_POST['txtStream1'] : '';
				$txtYearQual1 = isset($_POST['txtYearQual1']) ? $_POST['txtYearQual1'] : '';
				$txtBoardOth1 = isset($_POST['txtBoardOth1']) ? $_POST['txtBoardOth1'] : '';
				$txtSub1 = isset($_POST['txtSub1']) ? $_POST['txtSub1'] : '';
				$txtCGPA1 = isset($_POST['txtCGPA1']) ? $_POST['txtCGPA1'] : '';
				$txtDiv1 = isset($_POST['txtDiv1']) ? $_POST['txtDiv1'] : '';
				$txtGradingOth1 = isset($_POST['txtGradingOth1']) ? $_POST['txtGradingOth1'] : '';
				
				$txtExamName2 = isset($_POST['txtExamName2']) ? $_POST['txtExamName2'] : '';
				$txtStream2 = isset($_POST['txtStream2']) ? $_POST['txtStream2'] : '';
				$txtYearQual2 = isset($_POST['txtYearQual2']) ? $_POST['txtYearQual2'] : '';
				$txtBoardOth2 = isset($_POST['txtBoardOth2']) ? $_POST['txtBoardOth2'] : '';
				$txtSub2 = isset($_POST['txtSub2']) ? $_POST['txtSub2'] : '';
				$txtCGPA2 = isset($_POST['txtCGPA2']) ? $_POST['txtCGPA2'] : '';
				$txtDiv2 = isset($_POST['txtDiv2']) ? $_POST['txtDiv2'] : '';
				$txtGradingOth2 = isset($_POST['txtGradingOth2']) ? $_POST['txtGradingOth2'] : '';
				
				$radioComputer = isset($_POST['radioComputer']) ?  trim($_POST['radioComputer']) : '';
				$slno = 1;
				foreach($allQualifications as $row)
				{
					${'txtQualification'.$slno} = isset($_POST['txtQualification'.$slno]) && $_POST['txtQualification'.$slno] != '' ? $_POST['txtQualification'.$slno] : '';
					${'txtYear'.$slno} = isset($_POST['txtYear'.$slno]) && trim($_POST['txtYear'.$slno]) != '' ? (int) trim($_POST['txtYear'.$slno]) : null;
					${'txtDuration'.$slno} = isset($_POST['txtDuration'.$slno]) && trim($_POST['txtDuration'.$slno]) != '' ? (int) trim($_POST['txtDuration'.$slno]) : null;
					${'txtCourse'.$slno} = isset($_POST['txtCourse'.$slno]) && $_POST['txtCourse'.$slno] != '' ? $_POST['txtCourse'.$slno] : '';
					${'txtBoard'.$slno} = isset($_POST['txtBoard'.$slno]) && $_POST['txtBoard'.$slno] != '' ? $_POST['txtBoard'.$slno] : '';
					${'txtDivision'.$slno} = isset($_POST['txtDivision'.$slno]) && $_POST['txtDivision'.$slno] != '' ? $_POST['txtDivision'.$slno] : 'NULL';
					${'txtMS'.$slno} = isset($_POST['txtMS'.$slno]) && $_POST['txtMS'.$slno] != '' ? $_POST['txtMS'.$slno] : '';
					${'txtFM'.$slno} = isset($_POST['txtFM'.$slno]) && $_POST['txtFM'.$slno] != '' ? $_POST['txtFM'.$slno] : '';
					${'txtPercent'.$slno} = isset($_POST['txtPercent'.$slno]) && $_POST['txtPercent'.$slno] != '' ? $_POST['txtPercent'.$slno] : null;
					${'txtsubject'.$slno} = isset($_POST['txtsubject'.$slno]) && $_POST['txtsubject'.$slno] != '' ? $_POST['txtsubject'.$slno] : '';
					${'txtdistinct'.$slno} = isset($_POST['txtdistinct'.$slno]) && $_POST['txtdistinct'.$slno] != '' ? $_POST['txtdistinct'.$slno] : null;
					${'txtgrading'.$slno} = isset($_POST['txtgrading'.$slno]) && $_POST['txtgrading'.$slno] != '' ? $_POST['txtgrading'.$slno] : '';
					${'txtqual2'.$slno} = isset($_POST['txtqual2'.$slno]) && $_POST['txtqual2'.$slno] != '' ? $_POST['txtqual2'.$slno] : '';
					${'txtOther_grad'.$slno} = isset($_POST['txtOther_grad'.$slno]) && $_POST['txtOther_grad'.$slno] != '' ? $_POST['txtOther_grad'.$slno] : '';
					$slno++;
					//echo $_POST['txtQualification'.$slno];
				}
				$txtQualification3 = isset($_POST['txtQualification3']) && $_POST['txtQualification3'] != '' ? $_POST['txtQualification3'] : '';
				$txtYear3 = isset($_POST['txtYear3']) && trim($_POST['txtYear3']) != '' ? (int) trim($_POST['txtYear3']) : null;
				$txtBoard3 = isset($_POST['txtBoard3']) && $_POST['txtBoard3'] != '' ? $_POST['txtBoard3'] : '';
				$txtDivision3 = isset($_POST['txtDivision3']) && $_POST['txtDivision3'] != '' ? $_POST['txtDivision3'] : null;
				$txtMS3 = isset($_POST['txtMS3']) && $_POST['txtMS3'] != '' ? $_POST['txtMS3'] : '';
				$txtFM3 = isset($_POST['txtFM3']) && $_POST['txtFM3'] != '' ? $_POST['txtFM3'] : '';
				$txtPercent3 = isset($_POST['txtPercent3']) && $_POST['txtPercent3'] != '' ? $_POST['txtPercent3'] : null;
				//Entrance exam appeared
				  
				$txtQualification4 = isset($_POST['txtQualification4']) && $_POST['txtQualification4'] != '' ? $_POST['txtQualification4'] : '';
				$txtYear4 = isset($_POST['txtYear4']) && trim($_POST['txtYear4']) != '' ? (int) trim($_POST['txtYear4']) : null;
				$txtBoard4 = isset($_POST['txtBoard4']) && $_POST['txtBoard4'] != '' ? $_POST['txtBoard4'] : '';
				$txtDivision4 = isset($_POST['txtDivision4']) && $_POST['txtDivision4'] != '' ? $_POST['txtDivision4'] : null;
				$txtMS4 = isset($_POST['txtMS4']) && $_POST['txtMS4'] != '' ? $_POST['txtMS4'] : '';
				$txtFM4 = isset($_POST['txtFM4']) && $_POST['txtFM4'] != '' ? $_POST['txtFM4'] : '';
				$txtPercent4 = isset($_POST['txtPercent4']) && $_POST['txtPercent4'] != '' ? $_POST['txtPercent4'] : null;
				$txtOther_grad = isset($_POST['txtOther_grad']) && $_POST['txtOther_grad'] != '' ? $_POST['txtOther_grad'] : '';
				
				$txtQualification5 = isset($_POST['txtQualification5']) && $_POST['txtQualification5'] != '' ? $_POST['txtQualification5'] : '';
				$txtYear5 = isset($_POST['txtYear5']) && trim($_POST['txtYear5']) != '' ? (int) trim($_POST['txtYear5']) : null;
				$txtBoard5 = isset($_POST['txtBoard5']) && $_POST['txtBoard5'] != '' ? $_POST['txtBoard5'] : '';
				$txtDivision5 = isset($_POST['txtDivision5']) && $_POST['txtDivision5'] != '' ? $_POST['txtDivision5'] : null;
				$txtMS5 = isset($_POST['txtMS5']) && $_POST['txtMS5'] != '' ? $_POST['txtMS5'] : '';
				$txtFM5 = isset($_POST['txtFM5']) && $_POST['txtFM5'] != '' ? $_POST['txtFM5'] : '';
				$txtPercent5 = isset($_POST['txtPercent5']) && $_POST['txtPercent5'] != '' ? $_POST['txtPercent5'] : null;
				  
				$edit = false;
				$this->db->select("count(*) AS cnt");
				$this->db->from('applicant_master');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				foreach($result->result_array() as $appl)
				{
					$count = $appl['cnt'];
				}
				if($count >= 1)
				{
					$edit = true;
				}
				else
				{
					$edit = false;
				}
				
				if($edit)
				{
					
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
						
							$update_applicant_qualification_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'qual_desc_1' => ${'txtQualification'.$slno},
								'other_stream' => ${'txtOther_grad'.$slno},
								'year_of_passing' => ${'txtYear'.$slno},
								'duration' => ${'txtDuration'.$slno},
								'course' => ${'txtCourse'.$slno},
								'university_board' => ${'txtBoard'.$slno},
								'percentage_mark' => ${'txtPercent'.$slno},
								'division_distinction' => ${'txtdistinct'.$slno},
								'grade' => ${'txtgrading'.$slno},
								'qual_desc_2' => ${'txtqual2'.$slno},
								'created_by' => $reg_user_id,
								'created_on' => $now
							);
							
							
							$this->db->insert('applicant_qualification_detail',$update_applicant_qualification_array);
							
							$slno++;
						
					}
					
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$update_applicant_technical_qualification_detail = $this->db->delete('applicant_technical_qualification_detail');
					if(!$update_applicant_technical_qualification_detail)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error deleting applicant_technical_qualification_detail';
					}
					//start qual
					if(isset($_POST['txtExamName']))
					{
						for($i=0;$i < sizeof($_POST['txtExamName']);$i++){
						//echo "hello";
							if($_POST['txtExamName'][$i]!=''){
								//echo $_POST['txtdate_from'][$i];
								/*$from_date=date_create($_POST['txtdate_from'][$i]);
								$to_date=date_create($_POST['txtdate_to'][$i]);*/
								//echo date_format($from_date,"Y-m-d");
								//die();\
								$insert_research_data=
								array('reg_user_id' => $reg_user_id,
									'applied_program' => $program_code,
									'qual_desc_1'=>$_POST['txtExamName'][$i],
									'stream'=>$_POST['txtStream'][$i],
									'year'=> $_POST['txtYearQual'][$i],
									'affiliation_from'=>$_POST['txtBoardOth'][$i],
									'division'=>$_POST['txtDiv'][$i],
									'remark'=>$_POST['txtGradingOth'][$i],
									'grade_cgpa'=>$_POST['txtCGPA'][$i],
									'sl_no'=>$i+1,
									'created_by'=>$reg_user_id,
									'created_on'=>$now);
									$this->db->insert('applicant_technical_qualification_detail',$insert_research_data);
									if($this->db->affected_rows() == 0)
									{
										$dbstatus = FALSE;
										$dbmessage = 'Error updating applicant_technical_qualification_detail';
									}
							}
							
							
						}
					}
					//end qual
					/*if($txtExamName1 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $txtExamName1,
							'year' => $txtYearQual1,
							'stream' => $txtStream1,
							'affiliation_from' => $txtBoardOth1,
							'subjects_offered' => $txtSub1,
							'grade_cgpa' => $txtCGPA1,
							'division' => $txtDiv1,
							'remark' => $txtGradingOth1,
							'sl_no' => '5',
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 5';
						}
						
					}*/
					/*if($txtExamName2 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $txtExamName2,
							'year' => $txtYearQual2,
							'stream' => $txtStream2,
							'affiliation_from' => $txtBoardOth2,
							'subjects_offered' => $txtSub2,
							'grade_cgpa' => $txtCGPA2,
							'division' => $txtDiv2,
							'remark' => $txtGradingOth2,
							'sl_no' => '6',
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 6';
						}
					}*/
					
					$applicant_details = array(
						'appl_status' 				=> 'Applicant_Academic_Details',
						'is_computer_education'		=>$radioComputer,
						'updated_by' 				=> $reg_user_id,
						'updated_on' 				=> $now 
					);
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$applicant_details_temp = $this->db->update('applicant_master',$applicant_details);
					if(!$applicant_details_temp)
					{
						$dbStatus = FALSE;
						$dbMessage = 'Error updating Applicant Details';
					}
				}
				else
				{
					$slno = 1;
					$qual_sl = 0;
					
					foreach($allQualifications as $row)
					{
							$update_applicant_qualification_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'qual_desc_1' => ${'txtQualification'.$slno},
								'other_stream' => ${'txtOther_grad'.$slno},
								'year_of_passing' => ${'txtYear'.$slno},
								'duration' => ${'txtDuration'.$slno},
								'course' => ${'txtCourse'.$slno},
								'university_board' => ${'txtBoard'.$slno},
								'percentage_mark' => ${'txtPercent'.$slno},
								'division_distinction' => ${'txtdistinct'.$slno},
								'grade' => ${'txtgrading'.$slno},
								'qual_desc_2' => ${'txtqual2'.$slno},
								'created_by' => $reg_user_id,
								'created_on' => $now
							);
							$this->db->insert('applicant_qualification_detail',$update_applicant_qualification_array);
							$slno++;
					}
					
					//start qual
					if(isset($_POST['txtExamName']))
					{
						for($i=0;$i < sizeof($_POST['txtExamName']);$i++){
						//echo "hello";
							if($_POST['txtExamName'][$i]!=''){
								//echo $_POST['txtdate_from'][$i];
								/*$from_date=date_create($_POST['txtdate_from'][$i]);
								$to_date=date_create($_POST['txtdate_to'][$i]);*/
								//echo date_format($from_date,"Y-m-d");
								//die();\
								$insert_research_data=
								array('reg_user_id' => $reg_user_id,
									'applied_program' => $program_code,
									'qual_desc_1'=>$_POST['txtExamName'][$i],
									'stream'=>$_POST['txtStream'][$i],
									'year'=> $_POST['txtYearQual'][$i],
									'affiliation_from'=>$_POST['txtBoardOth'][$i],
									'division'=>$_POST['txtDiv'][$i],
									'remark'=>$_POST['txtGradingOth'][$i],
									'grade_cgpa'=>$_POST['txtCGPA'][$i],
									'sl_no'=>$i+1,
									'created_by'=>$reg_user_id,
									'created_on'=>$now);
									$this->db->insert('applicant_technical_qualification_detail',$insert_research_data);
									if($this->db->affected_rows() == 0)
									{
										$dbstatus = FALSE;
										$dbmessage = 'Error updating applicant_technical_qualification_detail';
									}
							}
							
							
						}
					}
					//end qual
					/*if($txtExamName1 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $txtExamName1,
							'year' => $txtYearQual1,
							'stream' => $txtStream1,
							'affiliation_from' => $txtBoardOth1,
							'subjects_offered' => $txtSub1,
							'grade_cgpa' => $txtCGPA1,
							'division' => $txtDiv1,
							'remark' => $txtGradingOth1,
							'sl_no' => '5',
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 5';
						}
						
					}*/
					/*if($txtExamName2 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $txtExamName2,
							'year' => $txtYearQual2,
							'stream' => $txtStream2,
							'affiliation_from' => $txtBoardOth2,
							'subjects_offered' => $txtSub2,
							'grade_cgpa' => $txtCGPA2,
							'division' => $txtDiv2,
							'remark' => $txtGradingOth2,
							'sl_no' => '6',
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 6';
						}
					}*/
					
					$applicant_details = array(
						'appl_status' 				=> 'Applicant_Academic_Details',
						'is_computer_education'		=>$radioComputer,
						'reg_user_id' 				=> $reg_user_id,
						'applied_program' 				=> $program_code,
						'updated_by' 				=> $reg_user_id,
						'updated_on' 				=> $now 
					);
					$applicant_details_temp = $this->db->insert('applicant_master',$applicant_details);
					if(!$applicant_details_temp)
					{
						$dbStatus = FALSE;
						$dbMessage = 'Error updating Applicant Details';
					}
				}
				
				return array('status' => $dbStatus, 'msg' => $dbMessage);
				
			break;
			case 'save_applicant_academic_details_temp_001':
				$dbStatus = TRUE;
				$dbMessage = "Data Saved Successfully";
				
				$program_code = $this->session->userdata('admcode');
				$program_code_arr = explode('_',$program_code);
				$institute_code = $program_code_arr[1];
				$reg_user_id = $this->session->userdata('reg_user_id');
				
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s");
        		
				$this->db->select("A.qualification_code, B.qualification_name, B.division");
				$this->db->from('program_qualification_setup A');
				$this->db->join('qualification_master B','A.qualification_code = B.qualification_code','inner');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.record_status',1);
				$this->db->where('B.record_status',1);
				$this->db->order_by('A.id');
				
				$result = $this->db->get();
				
				$allQualifications = $result->result_array();
				
				$txtExamName1 = isset($_POST['txtExamName1']) ? $_POST['txtExamName1'] : '';
				$txtStream1 = isset($_POST['txtStream1']) ? $_POST['txtStream1'] : '';
				$txtYearQual1 = isset($_POST['txtYearQual1']) ? $_POST['txtYearQual1'] : '';
				$txtBoardOth1 = isset($_POST['txtBoardOth1']) ? $_POST['txtBoardOth1'] : '';
				$txtSub1 = isset($_POST['txtSub1']) ? $_POST['txtSub1'] : '';
				$txtCGPA1 = isset($_POST['txtCGPA1']) ? $_POST['txtCGPA1'] : '';
				$txtDiv1 = isset($_POST['txtDiv1']) ? $_POST['txtDiv1'] : '';
				$txtGradingOth1 = isset($_POST['txtGradingOth1']) ? $_POST['txtGradingOth1'] : '';
				
				$txtExamName2 = isset($_POST['txtExamName2']) ? $_POST['txtExamName2'] : '';
				$txtStream2 = isset($_POST['txtStream2']) ? $_POST['txtStream2'] : '';
				$txtYearQual2 = isset($_POST['txtYearQual2']) ? $_POST['txtYearQual2'] : '';
				$txtBoardOth2 = isset($_POST['txtBoardOth2']) ? $_POST['txtBoardOth2'] : '';
				$txtSub2 = isset($_POST['txtSub2']) ? $_POST['txtSub2'] : '';
				$txtCGPA2 = isset($_POST['txtCGPA2']) ? $_POST['txtCGPA2'] : '';
				$txtDiv2 = isset($_POST['txtDiv2']) ? $_POST['txtDiv2'] : '';
				$txtGradingOth2 = isset($_POST['txtGradingOth2']) ? $_POST['txtGradingOth2'] : '';
				
				$radioComputerEducation = isset($_POST['radioComputerEducation']) ?  trim($_POST['radioComputerEducation']) : '';
				$radioComputerType = isset($_POST['radioComputerType']) ?  trim($_POST['radioComputerType']) : '';
				$txtOtherComp = isset($_POST['txtOtherComp']) ?  trim($_POST['txtOtherComp']) : '';
				$slno = 1;
				$txtqual21='';
				$txtqual23='';
				
				foreach($allQualifications as $row)
				{
					${'txtQualification'.$slno} = isset($_POST['txtQualification'.$slno]) && $_POST['txtQualification'.$slno] != '' ? $_POST['txtQualification'.$slno] : '';
					${'txtqual2'.$slno} = isset($_POST['txtqual2'.$slno]) && $_POST['txtqual2'.$slno] != '' ? $_POST['txtqual2'.$slno] : '';
					${'txtYear'.$slno} = isset($_POST['txtYear'.$slno]) && trim($_POST['txtYear'.$slno]) != '' ? (int) trim($_POST['txtYear'.$slno]) : null;
					${'txtBoard'.$slno} = isset($_POST['txtBoard'.$slno]) && $_POST['txtBoard'.$slno] != '' ? $_POST['txtBoard'.$slno] : '';
					${'txtDivision'.$slno} = isset($_POST['txtDivision'.$slno]) && $_POST['txtDivision'.$slno] != '' ? $_POST['txtDivision'.$slno] : 'NULL';
					${'txtMS'.$slno} = isset($_POST['txtMS'.$slno]) && $_POST['txtMS'.$slno] != '' ? $_POST['txtMS'.$slno] : '';
					${'txtFM'.$slno} = isset($_POST['txtFM'.$slno]) && $_POST['txtFM'.$slno] != '' ? $_POST['txtFM'.$slno] : '';
					${'txtPercent'.$slno} = isset($_POST['txtPercent'.$slno]) && $_POST['txtPercent'.$slno] != '' ? $_POST['txtPercent'.$slno] : null;
					$slno++;
					//echo $_POST['txtQualification'.$slno];
				}
				
				$edit = false;
				$this->db->select("count(*) AS cnt");
				$this->db->from('applicant_master');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				foreach($result->result_array() as $appl)
				{
					$count = $appl['cnt'];
				}
				if($count >= 1)
				{
					$edit = true;
				}
				else
				{
					$edit = false;
				}
				
				if($edit)
				{
					
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
						
							$update_applicant_qualification_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'qual_desc_1' => ${'txtQualification'.$slno},
								
								'year_of_passing' => ${'txtYear'.$slno},
								'university_board' => ${'txtBoard'.$slno},
								'mark_secured' => ${'txtMS'.$slno},
								'full_mark' => ${'txtFM'.$slno},
								'percentage_mark' => ${'txtPercent'.$slno},
								'qual_desc_2' => ${'txtqual2'.$slno},
								'created_by' => $reg_user_id,
								'created_on' => $now
							);
							
							
							$this->db->insert('applicant_qualification_detail',$update_applicant_qualification_array);
							
							$slno++;
						
					}
					
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$update_applicant_technical_qualification_detail = $this->db->delete('applicant_technical_qualification_detail');
					if(!$update_applicant_technical_qualification_detail)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error deleting applicant_technical_qualification_detail';
					}
					
					if($txtExamName1 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $txtExamName1,
							'year' => $txtYearQual1,
							'stream' => $txtStream1,
							'affiliation_from' => $txtBoardOth1,
							'subjects_offered' => $txtSub1,
							'grade_cgpa' => $txtCGPA1,
							'division' => $txtDiv1,
							'remark' => $txtGradingOth1,
							'sl_no' => '5',
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 5';
						}
						
					}
					if($txtExamName2 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $txtExamName2,
							'year' => $txtYearQual2,
							'stream' => $txtStream2,
							'affiliation_from' => $txtBoardOth2,
							'subjects_offered' => $txtSub2,
							'grade_cgpa' => $txtCGPA2,
							'division' => $txtDiv2,
							'remark' => $txtGradingOth2,
							'sl_no' => '6',
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 6';
						}
					}
					
					$applicant_details = array(
						'appl_status' 				=> 'Applicant_Academic_Details',
						'is_computer_education'		=>$radioComputerEducation,
						'other_computer'			=>$txtOtherComp,
						'is_computer_type'			=>$radioComputerType,
						'updated_by' 				=> $reg_user_id,
						'updated_on' 				=> $now 
					);
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$applicant_details_temp = $this->db->update('applicant_master',$applicant_details);
					if(!$applicant_details_temp)
					{
						$dbStatus = FALSE;
						$dbMessage = 'Error updating Applicant Details';
					}
				}
				else
				{
					$slno = 1;
					$qual_sl = 0;
					
					foreach($allQualifications as $row)
					{
							$update_applicant_qualification_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'qual_desc_1' => ${'txtQualification'.$slno},
								
								'year_of_passing' => ${'txtYear'.$slno},
								'university_board' => ${'txtBoard'.$slno},
								'mark_secured' => ${'txtMS'.$slno},
								'full_mark' => ${'txtFM'.$slno},
								'percentage_mark' => ${'txtPercent'.$slno},
								'qual_desc_2' => ${'txtqual2'.$slno},
								'created_by' => $reg_user_id,
								'created_on' => $now
							);
							$this->db->insert('applicant_qualification_detail',$update_applicant_qualification_array);
							$slno++;
					}
					
					
					if($txtExamName1 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $txtExamName1,
							'year' => $txtYearQual1,
							'stream' => $txtStream1,
							'affiliation_from' => $txtBoardOth1,
							'subjects_offered' => $txtSub1,
							'grade_cgpa' => $txtCGPA1,
							'division' => $txtDiv1,
							'remark' => $txtGradingOth1,
							'sl_no' => '5',
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 5';
						}
						
					}
					if($txtExamName2 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $txtExamName2,
							'year' => $txtYearQual2,
							'stream' => $txtStream2,
							'affiliation_from' => $txtBoardOth2,
							'subjects_offered' => $txtSub2,
							'grade_cgpa' => $txtCGPA2,
							'division' => $txtDiv2,
							'remark' => $txtGradingOth2,
							'sl_no' => '6',
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 6';
						}
					}
					$applicant_details = array(
						'appl_status' 				=> 'Applicant_Academic_Details',
						'is_computer_education'		=>$radioComputerEducation,
						'other_computer'			=>$txtOtherComp,
						'is_computer_type'			=>$radioComputerType,
						'updated_by' 				=> $reg_user_id,
						'updated_on' 				=> $now 
					);
					$applicant_details_temp = $this->db->insert('applicant_master',$applicant_details);
					if(!$applicant_details_temp)
					{
						$dbStatus = FALSE;
						$dbMessage = 'Error updating Applicant Details';
					}
				}
				
				return array('status' => $dbStatus, 'msg' => $dbMessage);
				 
			break;
			
			case 'save_applicant_info_temp':
				$dbStatus = TRUE;
				$dbMessage = "Data Saved Successfully";
				
				$program_code = $this->session->userdata('admcode');
				$program_code_arr = explode('_',$program_code);
				$institute_code = $program_code_arr[1];
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s");
        		
        		$is_employed = isset($_POST['empGovt']) ? $_POST['empGovt'] : '';
        		$chkInformed = isset($_POST['chkInformed']) ? $_POST['chkInformed'] : '';
				$txtNameOfOffice = isset($_POST['txtNameOfOffice']) ? $_POST['txtNameOfOffice'] : '';
				$txtDOJ = isset($_POST['txtDOJ']) ? $_POST['txtDOJ'] : '';
				$txtNameOfPost = isset($_POST['txtNameOfPost']) ? trim($_POST['txtNameOfPost']) : '';
				
				$empDisciplinary = isset($_POST['empDisciplinary']) ? trim($_POST['empDisciplinary']) : '';
				$txtDateOfDebar = isset($_POST['txtDateOfDebar']) ? trim($_POST['txtDateOfDebar']) : '';
				$txtPeriodOfDebar = isset($_POST['txtPeriodOfDebar']) ? trim($_POST['txtPeriodOfDebar']) : '';
				$txtTotalExperience1 = isset($_POST['txtTotalExperience']) ? trim($_POST['txtTotalExperience']) : '';
				
				$presentation_details = isset($_POST['presentation_details']) ? trim($_POST['presentation_details']) : '';
				$any_other_info = isset($_POST['any_other_info']) ? trim($_POST['any_other_info']) : '';
				
				$txtDOJ = date("Y-m-d", strtotime($txtDOJ));
				$txtDateOfDebar = date("Y-m-d", strtotime($txtDateOfDebar));
				$countexp = '';
				$this->db->select("count(*) AS cnt");
				$this->db->from('program_wise_exp_validation');
				$this->db->where('program_code',$program_code);
				$this->db->where('program_wise_exp_validation.record_status',1);
				$this->db->order_by('program_wise_exp_validation.id');
				$result = $this->db->get();
				foreach($result->result_array() as $appl)
				{
					$countexp = $appl['cnt'];
				}
				
				$edit = false;
				$this->db->select("count(*) AS cnt");
				$this->db->from('applicant_master');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				foreach($result->result_array() as $appl)
				{
					$count = $appl['cnt'];
				}
				if($count >= 1)
				{
					$edit = true;
				}
				else
				{
					$edit = false;
				}
				
				if($edit)
				{
					$applicant_details = array(
						'appl_status' 				=> 'Applicant_Info',
						'is_employed' 				=> $is_employed,
						'presentation_details' 		=> $presentation_details,
						'any_other_info' 			=> $any_other_info,
						
						'updated_by' 				=> $reg_user_id,
						'updated_on' 				=> $now 
					);
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$applicant_details_temp = $this->db->update('applicant_master',$applicant_details);
					if(!$applicant_details_temp)
					{
						$dbStatus = FALSE;
						$dbMessage = 'Error updating Applicant Details';
					}
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$delete_applicant_work_experience_detail = $this->db->delete('applicant_work_experience_detail');
					if(!$delete_applicant_work_experience_detail)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error deleting applicant_work_experience_detail';
					}	
					if(isset($_POST['txtorganization']))
					{
						for($i=0;$i < sizeof($_POST['txtorganization']);$i++){
						//echo "hello";
							if($_POST['txtorganization'][$i]!=''){
								//echo $_POST['txtdate_from'][$i];
								$from_date=date_create($_POST['txtdate_from'][$i]);
								$to_date=date_create($_POST['txtdate_to'][$i]);
								//echo date_format($from_date,"Y-m-d");
								//die();\
								$insert_research_data=
								array("reg_user_id" => $reg_user_id,
									"applied_program" => $program_code,
									"sl_no"=>$i+1,
									"organization"=>$_POST['txtorganization'][$i],
									"post_held"=>$_POST['txtpost_held'][$i],
									"date_from"=>date_format($from_date,"Y-m-d"),
									"date_to"=> date_format($to_date,"Y-m-d"),
									"duration"=> $_POST['txtduration'][$i],
									"nature_of_job"=>$_POST['txtnature_of_job'][$i],
									"pay_band"=>$_POST['txtpay_band'][$i],
									/*"basic_pay"=>$_POST['txtbasic_pay'][$i],
									'gross_salary'=>$_POST['txtgross'][$i],*/
								
									"created_by"=>$reg_user_id,
									"created_on"=>$now);
									$this->db->insert('applicant_work_experience_detail',$insert_research_data);
									if($this->db->affected_rows() == 0)
									{
										$dbstatus = FALSE;
										$dbmessage = 'Error updating applicant_work_experience_detail';
									}
							}
							
							
						}
					}
					if($countexp > 0)
					{
						$this->db->where('reg_user_id',$reg_user_id);
						$this->db->where('program_code',$program_code);
						$delete_applicant_postwise_experience = $this->db->delete('applicant_postwise_experience');
						if(!$delete_applicant_postwise_experience)
						{
							$dbstatus = FALSE;
							$dbmessage = 'Error deleting applicant_work_experience_detail';
						}
						if(isset($_POST['radioExperience1']))
						{
							$j = 0;
							for($i=1;$i <= $countexp;$i++)
							{
							
								if($_POST['radioExperience'.$i] !=''){
									
									$this->db->select("*");
									$this->db->from('program_wise_exp_validation');
									$this->db->where('program_code',$program_code);
									$this->db->where('experience_code',$_POST['expcode'][$j]);
									$result = $this->db->get();
									foreach($result->result_array() as $appl)
									{
										$experience = $appl['experience'];
									}
									
									$insert_exp_data=
									array(
										"reg_user_id" => $reg_user_id,
										"program_code" => $program_code,
										"is_experienced" => $_POST['radioExperience'.$i],
										"sl_no"=>$i+1,
										"experience_code"=>$_POST['expcode'][$j],
										"experience_name"=>$experience,
										"created_by"=>$reg_user_id,
										"created_on"=>$now
										);
										$this->db->insert('applicant_postwise_experience',$insert_exp_data);
										if($this->db->affected_rows() == 0)
										{
											$dbstatus = FALSE;
											$dbmessage = 'Error updating applicant_work_experience_detail';
										}
								}
								$j++;
							}
						}
					}
					$this->db->select("count(reg_user_id) AS reg_user_id");
					$this->db->from('applicant_total_experience');
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$result = $this->db->get();
					$output_data = $result->result_array();
					
					foreach ($output_data as $aRow2) 
            		{
            			$result = $aRow2['reg_user_id'];
						if($result >= 1)
						{
							$update_data = array(
								'total_experience_1'				=>$txtTotalExperience1,
								
								'updated_by'						=>$reg_user_id,
								'updated_on'						=>$now
								
							);
							$this->db->where('reg_user_id',$reg_user_id);
							$this->db->where('applied_program',$program_code);
							$sql = $this->db->update('applicant_total_experience', $update_data);
							if(!$sql){
								$dbStatus = "ERROR";
								$dbmessage = "ERROR updating Total Experience";
							}
						}
						else
						{
							$new_data = array(
								'reg_user_id' 				=>$reg_user_id,
								'applied_program' 			=>$program_code,
								'total_experience_1'		=>$txtTotalExperience1,
								
								'created_by'				=>$reg_user_id,
								'created_on'				=>$now
							);
							$sql = $this->db->insert('applicant_total_experience', $new_data);
							$this->db->last_query();
							if(!$sql){
								$dbStatus = "ERROR";
								$dbmessage = "ERROR inserting Total Experience";
									
							}
						}
	                }
				}
				else 
				{  
					$applicant_details = array(
						'appl_status' 				=> 'Applicant_Info',
						'reg_user_id' 				=> $reg_user_id,
						'applied_program' 			=> $program_code,
						'presentation_details' 		=> $presentation_details,
						'any_other_info' 			=> $any_other_info,
						
						'updated_by' 				=> $reg_user_id,
						'updated_on' 				=> $now 
					);
					$applicant_details_temp = $this->db->insert('applicant_master',$applicant_details);
					if(!$applicant_details_temp)
					{
						$dbStatus = FALSE;
						$dbMessage = 'Error updating Applicant Details';
					}
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$delete_applicant_work_experience_detail = $this->db->delete('applicant_work_experience_detail');
					if(!$delete_applicant_work_experience_detail)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error deleting applicant_work_experience_detail';
					}	
					if(isset($_POST['txtorganization']))
					{
						for($i=0;$i < sizeof($_POST['txtorganization']);$i++){
						//echo "hello";
							if($_POST['txtorganization'][$i]!=''){
								//echo $_POST['txtdate_from'][$i];
								$from_date=date_create($_POST['txtdate_from'][$i]);
								$to_date=date_create($_POST['txtdate_to'][$i]);
								//echo date_format($from_date,"Y-m-d");
								//die();\
								$insert_research_data=
								array("reg_user_id" => $reg_user_id,
									"applied_program" => $program_code,
									"sl_no"=>$i+1,
									"organization"=>$_POST['txtorganization'][$i],
									"post_held"=>$_POST['txtpost_held'][$i],
									"date_from"=>date_format($from_date,"Y-m-d"),
									"date_to"=> date_format($to_date,"Y-m-d"),
									"duration"=> $_POST['txtduration'][$i],
									"nature_of_job"=>$_POST['txtnature_of_job'][$i],
									"pay_band"=>$_POST['txtpay_band'][$i],
									/*"basic_pay"=>$_POST['txtbasic_pay'][$i],
									'gross_salary'=>$_POST['txtgross'][$i],*/
								
									"created_by"=>$reg_user_id,
									"created_on"=>$now);
									$this->db->insert('applicant_work_experience_detail',$insert_research_data);
									if($this->db->affected_rows() == 0)
									{
										$dbstatus = FALSE;
										$dbmessage = 'Error updating applicant_work_experience_detail';
									}
							}
							
							
						}
					}
					if($countexp > 0)
					{
						$this->db->where('reg_user_id',$reg_user_id);
						$this->db->where('program_code',$program_code);
						$delete_applicant_postwise_experience = $this->db->delete('applicant_postwise_experience');
						if(!$delete_applicant_postwise_experience)
						{
							$dbstatus = FALSE;
							$dbmessage = 'Error deleting applicant_work_experience_detail';
						}
						if(isset($_POST['radioExperience1']))
						{
							$j = 0;
							for($i=1;$i <= $countexp;$i++)
							{
							
								if($_POST['radioExperience'.$i] !=''){
									
									$this->db->select("*");
									$this->db->from('program_wise_exp_validation');
									$this->db->where('program_code',$program_code);
									$this->db->where('experience_code',$_POST['expcode'][$j]);
									$result = $this->db->get();
									foreach($result->result_array() as $appl)
									{
										$experience = $appl['experience'];
									}
									
									$insert_exp_data=
									array(
										"reg_user_id" => $reg_user_id,
										"program_code" => $program_code,
										"is_experienced" => $_POST['radioExperience'.$i],
										"sl_no"=>$i+1,
										"experience_code"=>$_POST['expcode'][$j],
										"experience_name"=>$experience,
										"created_by"=>$reg_user_id,
										"created_on"=>$now
										);
										$this->db->insert('applicant_postwise_experience',$insert_exp_data);
										if($this->db->affected_rows() == 0)
										{
											$dbstatus = FALSE;
											$dbmessage = 'Error updating applicant_work_experience_detail';
										}
								}
								$j++;
							}
						}
					}
					$this->db->select("count(reg_user_id) AS reg_user_id");
					$this->db->from('applicant_total_experience');
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$result = $this->db->get();
					$output_data = $result->result_array();
					
					foreach ($output_data as $aRow2) 
            		{
            			$result = $aRow2['reg_user_id'];
						if($result >= 1)
						{
							$update_data = array(
								'total_experience_1'				=>$txtTotalExperience1,
								
								'updated_by'						=>$reg_user_id,
								'updated_on'						=>$now
								
							);
							$this->db->where('reg_user_id',$reg_user_id);
							$this->db->where('applied_program',$program_code);
							$sql = $this->db->update('applicant_total_experience', $update_data);
							if(!$sql){
								$dbStatus = "ERROR";
								$dbmessage = "ERROR updating Total Experience";
							}
						}
						else
						{
							$new_data = array(
								'reg_user_id' 				=>$reg_user_id,
								'applied_program' 			=>$program_code,
								'total_experience_1'		=>$txtTotalExperience1,
								
								'created_by'				=>$reg_user_id,
								'created_on'				=>$now
							);
							$sql = $this->db->insert('applicant_total_experience', $new_data);
							$this->db->last_query();
							if(!$sql){
								$dbStatus = "ERROR";
								$dbmessage = "ERROR inserting Total Experience";
									
							}
						}
	                }
					
				}
				
				
				
				return array('status' => $dbStatus, 'msg' => $dbMessage);
				
			break;
			case 'check_experience_validation':
			$program_code = $this->session->userdata('admcode');
			//$Experience = isset($_POST['Experience']) ? $_POST['Experience'] : '';
			$expcode = isset($_POST['expcode']) ? $_POST['expcode'] : '';
			$failed_year = '';
			$dbstatus = TRUE;
			$dbmessage = 'Success';
			$this->db->select('*');
			$this->db->from('program_wise_exp_validation');
			$this->db->where('program_wise_exp_validation.record_status',1);
			$this->db->where('program_wise_exp_validation.program_code',$program_code);
			$this->db->order_by('program_wise_exp_validation.id');
			$result = $this->db->get();
			$query = $result->result_array();
			$i = 0;
			$j = 1;
			foreach($query as $row)
			{
				if($_POST['expcode'][$i] != '')
				{
					if($_POST['expcode'][$i] == $row ['experience_code'])
					{
						$postdata = $_POST['radioExperience'.$j];
						//$getdata = (int)$row ['year'];
						if($postdata == 'NO')
						{
							$experiencename = $row ['experience'];
							
							$dbstatus = FALSE;
							$dbmessage = 'You are not eligible to apply for this post based on the required experience';
							return array('status'=>$dbstatus,'msg'=>$dbmessage);
						}
					}
				}
				$i++;
				$j++;
			}
			return array('status'=>$dbstatus,'msg'=>$dbmessage);
			break;
			case 'add_application_data_02':
			
				
				$dbStatus = TRUE;
				$cmbExamCenter = isset($_POST['cmbExamCenter']) ? $_POST['cmbExamCenter'] : '';
				$txtFirstName = isset($_POST['txtFirstName']) ? trim($_POST['txtFirstName']) : '';
				$radioews = isset($_POST['radioEWS']) ? $_POST['radioEWS'] : '';
				$radioExp = isset($_POST['radioExp']) ? $_POST['radioExp'] : '';
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
				 



				$employed = isset($_POST['employed']) ? trim($_POST['employed']) : 'NO';
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
				$dob = isset($_POST['hidDateFormat']) ? trim($_POST['hidDateFormat']) : '';
				$dob = date("Y-m-d", strtotime($dob));
				//$dob = $y.'-'.$m.'-'.$d;
				/*echo $dob;
				die();*/
				$dbStatus = "";
				$dbMessage = "";
				$dbError = "";

				$radiogender = isset($_POST['radiogender']) ? $_POST['radiogender'] : '';
				$age = isset($_POST['hidAge']) ? $_POST['hidAge'] : '';
				$radioID = isset($_POST['radioID']) ? $_POST['radioID'] : '';
				$radioJEE = isset($_POST['radioJEE']) ? $_POST['radioJEE'] : '';
				$radioHostel = isset($_POST['radioHostel']) ? $_POST['radioHostel'] : '';
				$radiomaritalstatus = isset($_POST['radiomaritalstatus']) ? $_POST['radiomaritalstatus'] : '';
				$radioQuota = isset($_POST['radioQuota']) ? $_POST['radioQuota'] : '';
				
				$cmbidproof = isset($_POST['cmbidproof']) ? $_POST['cmbidproof'] : '';
				//$txtidproof = isset($_POST['txtidproof']) ? $_POST['txtidproof'] : '';
				$txtidproofkey = isset($_POST['key']) ? $_POST['key'] : '';
				$txtidproofkey = explode("*",$txtidproofkey);
				$txtidproof = $this->decodepostdata($txtidproofkey[0]);
				$relevantinfo = isset($_POST['relevantinfo']) ? $_POST['relevantinfo'] : '';
				$enclosuresdetails = isset($_POST['enclosuresdetails']) ? $_POST['enclosuresdetails'] : '';
				
				//echo $cmbidproof ; die();
				$cmbReservedCategory = isset($_POST['cmbCommunity']) ? $_POST['cmbCommunity'] : '';
				
				$cmbNationality = isset($_POST['cmbNationality']) ? $_POST['cmbNationality'] : '';
				$cmbCommunity = isset($_POST['cmbCommunity1']) ? $_POST['cmbCommunity1'] : '';
				if($cmbReservedCategory == 'PH')
				{
					$cmbCommunity = 'YES';
				}
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
				$txtphtype  = isset($_POST['cmbPH']) ? $_POST['cmbPH'] : '';
				
				$txtOtherNationality = isset($_POST['txtOtherNationality']) ? trim($_POST['txtOtherNationality']) : '';
				$txtOtherRelations = isset($_POST['txtOtherRelations']) ? trim($_POST['txtOtherRelations']) : '';
				$txtMotherTongue = isset($_POST['txtMotherTongue']) ? trim($_POST['txtMotherTongue']) : '';
				$cmbCategory = isset($_POST['cmbCategory']) ? $_POST['cmbCategory'] : '';
				$cmbReligion = isset($_POST['cmbReligion']) ? $_POST['cmbReligion'] : '';
				$txtUnivRegNo = isset($_POST['txtUnivRegNo']) ? $_POST['txtUnivRegNo'] : '';
				//$cmbHighestQualification = isset($_POST['txtQualifyingDegree']) ? $_POST['txtQualifyingDegree'] : '';
				$txtDiv2 = isset($_POST['txtDiv2']) ? $_POST['txtDiv2'] : '';
				$txtGradingOth2 = isset($_POST['txtGradingOth2']) ? $_POST['txtGradingOth2'] : '';
				$txtDiv1 = isset($_POST['txtDiv1']) ? $_POST['txtDiv1'] : '';
				$txtGradingOth1 = isset($_POST['txtGradingOth1']) ? $_POST['txtGradingOth1'] : '';
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
				$txtPresentAddress = isset($_POST['txtPresentAddress']) ?  trim($_POST['txtPresentAddress']) : 'BBSR';
				$txtPresentLocality = isset($_POST['txtPresentLocality']) ? trim($_POST['txtPresentLocality']) : '';
				$txtPresentPost = isset($_POST['txtPresentPost']) ? trim($_POST['txtPresentPost']) : '';
				$cmbPresentDist = isset($_POST['cmbPresentDist']) ?  trim($_POST['cmbPresentDist']) : '';
				$txtPresentPin = isset($_POST['txtPresentPin']) ? trim($_POST['txtPresentPin']) : '761200';
				$cmbPresentState = isset($_POST['cmbPresentState']) ? trim($_POST['cmbPresentState']) : '';
				$txtPresentDistance = isset($_POST['txtPresentDistance']) ? trim($_POST['txtPresentDistance']) : '';

				//if permanent is same as present
				$chksameasresidential = isset($_POST['chksameasresidential']) ? $_POST['chksameasresidential']:'N';
				$txtPermenentAddress = isset($_POST['hidPermenentAddress']) ? trim($_POST['hidPermenentAddress']) : '';
				$txtPermenentLocality = isset($_POST['txtPermenentLocality']) ? trim($_POST['txtPermenentLocality']) : '';
				$txtPermanentPost = isset($_POST['txtPermanentPost']) ? trim($_POST['txtPermanentPost']) : 'PKD';
				$txtPermanentDist = isset($_POST['cmbPermanentDist']) ? trim($_POST['cmbPermanentDist']) : '';
				$txtPermanentState = isset($_POST['cmbPermanentState']) ?  trim($_POST['cmbPermanentState']) : '';
				$txtPermanentPin = isset($_POST['txtPermanentPin']) ? trim($_POST['txtPermanentPin']) : '761200';
				$txtPermanentMobile = isset($_POST['txtPermanentMobile']) ? trim($_POST['txtPermanentMobile']) : '';
				$txtUid = isset($_POST['txtUid']) ? trim($_POST['txtUid']) : '';
				$empsuspended = isset($_POST['empsuspended']) ? trim($_POST['empsuspended']) : '';
				$empsuspendedinfo = isset($_POST['empsuspendedinfo']) ? trim($_POST['empsuspendedinfo']) : '';
				$empDisciplinary = isset($_POST['empDisciplinary']) ? trim($_POST['empDisciplinary']) : '';
				$empDisciplinaryInfo = isset($_POST['empDisciplinaryInfo']) ? trim($_POST['empDisciplinaryInfo']) : '';
				
				
				$technical_5_1 = isset($_POST['txtTechnical_5_1']) ? trim($_POST['txtTechnical_5_1']) : ''; //course
				$technical_5_2 = isset($_POST['txtTechnical_5_2']) && $_POST['txtTechnical_5_2'] != '' ? trim($_POST['txtTechnical_5_2']) : 'NULL'; //institute
				$technical_5_3 = isset($_POST['txtTechnical_5_3']) ? trim($_POST['txtTechnical_5_3']) : ''; //affiliation
				$technical_5_4 = isset($_POST['txtTechnical_5_4']) ? trim($_POST['txtTechnical_5_4']) : ''; //duration
				
				$technical_6_1 = isset($_POST['txtTechnical_6_1']) ? trim($_POST['txtTechnical_6_1']) : ''; //course
				$technical_6_2 = isset($_POST['txtTechnical_6_2']) && $_POST['txtTechnical_6_2'] != '' ? trim($_POST['txtTechnical_6_2']) : 'NULL'; //institute
				$technical_6_3 = isset($_POST['txtTechnical_6_3']) ? trim($_POST['txtTechnical_6_3']) : ''; //affiliation
				$technical_6_4 = isset($_POST['txtTechnical_6_4']) ? trim($_POST['txtTechnical_6_4']) : ''; //duration
				
				$technical_7_1 = isset($_POST['txtTechnical_7_1']) ? trim($_POST['txtTechnical_7_1']) : ''; //course
				$technical_7_2 = isset($_POST['txtTechnical_7_2']) && $_POST['txtTechnical_7_2'] != '' ? trim($_POST['txtTechnical_7_2']) : 'NULL'; //institute
				$technical_7_3 = isset($_POST['txtTechnical_7_3']) ? trim($_POST['txtTechnical_7_3']) : ''; //affiliation
				$technical_7_4 = isset($_POST['txtTechnical_7_4']) ? trim($_POST['txtTechnical_7_4']) : ''; //duration
				
				
				$txtExamName1 = isset($_POST['txtExamName1']) ? $_POST['txtExamName1'] : '';
				$txtStream1 = isset($_POST['txtStream1']) ? $_POST['txtStream1'] : '';
				$txtYearQual1 = isset($_POST['txtYearQual1']) ? $_POST['txtYearQual1'] : '';
				$txtBoardOth1 = isset($_POST['txtBoardOth1']) ? $_POST['txtBoardOth1'] : '';
				$txtSub1 = isset($_POST['txtSub1']) ? $_POST['txtSub1'] : '';
				$txtCGPA1 = isset($_POST['txtCGPA1']) ? $_POST['txtCGPA1'] : '';
				
				$txtExamName2 = isset($_POST['txtExamName2']) ? $_POST['txtExamName2'] : '';
				$txtStream2 = isset($_POST['txtStream2']) ? $_POST['txtStream2'] : '';
				$txtYearQual2 = isset($_POST['txtYearQual2']) ? $_POST['txtYearQual2'] : '';
				$txtBoardOth2 = isset($_POST['txtBoardOth2']) ? $_POST['txtBoardOth2'] : '';
				$txtSub2 = isset($_POST['txtSub2']) ? $_POST['txtSub2'] : '';
				$txtCGPA2 = isset($_POST['txtCGPA2']) ? $_POST['txtCGPA2'] : '';

					
				$txtApplicantEmail = isset($_POST['txtemailid']) ? trim($_POST['txtemailid']) : '';
				/*echo $txtApplicantEmail;
				die();*/
				
				$MothersName = isset($_POST['txtMotherName']) ? trim($_POST['txtMotherName']) : '';
				$cmbHomeDist = isset($_POST['cmbHomeDist']) ? trim($_POST['cmbHomeDist']) : '';
				$radioSports = isset($_POST['radioSports']) ? trim($_POST['radioSports']) : '';
				$radioService = isset($_POST['radioService']) ? trim($_POST['radioService']) : '';
				$radioResident = isset($_POST['radioResident']) ? trim($_POST['radioResident']) : '';
				$is_employed = isset($_POST['empGovt']) ? $_POST['empGovt'] : '';
				$chkInformed = isset($_POST['chkInformed']) ? $_POST['chkInformed'] : '';
				$txtNameOfOffice = isset($_POST['txtNameOfOffice']) ? $_POST['txtNameOfOffice'] : '';
				$txtDOJ = isset($_POST['txtDOJ']) ? $_POST['txtDOJ'] : '';
				$txtNameOfPost = isset($_POST['txtNameOfPost']) ? trim($_POST['txtNameOfPost']) : '';
				$txtDateOfDebar = isset($_POST['txtDateOfDebar']) ? trim($_POST['txtDateOfDebar']) : '';
				$txtPeriodOfDebar = isset($_POST['txtPeriodOfDebar']) ? trim($_POST['txtPeriodOfDebar']) : '';
				$presentation_details = isset($_POST['presentation_details']) ? trim($_POST['presentation_details']) : '';
				$any_other_info = isset($_POST['any_other_info']) ? trim($_POST['any_other_info']) : '';
				
				$txtDOJ = date("Y-m-d", strtotime($txtDOJ));
				$txtDateOfDebar = date("Y-m-d", strtotime($txtDateOfDebar));
				/*ECHO $is_employed;
				ECHO $txtNameOfOffice;
				DIE();*/
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
				$program_code_arr = explode('_',$program_code);
				$institute_code = $program_code_arr[1];
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.qualification_code, B.qualification_name, B.division");
				$this->db->from('program_qualification_setup A');
				$this->db->join('qualification_master B','A.qualification_code = B.qualification_code','inner');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.record_status',1);
				$this->db->where('B.record_status',1);
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
					${'txtYear'.$slno} = isset($_POST['txtYear'.$slno]) && trim($_POST['txtYear'.$slno]) != '' ? (int) trim($_POST['txtYear'.$slno]) : null;
					${'txtDuration'.$slno} = isset($_POST['txtDuration'.$slno]) && trim($_POST['txtDuration'.$slno]) != '' ? (int) trim($_POST['txtDuration'.$slno]) : null;
					${'txtCourse'.$slno} = isset($_POST['txtCourse'.$slno]) && $_POST['txtCourse'.$slno] != '' ? $_POST['txtCourse'.$slno] : '';
					${'txtBoard'.$slno} = isset($_POST['txtBoard'.$slno]) && $_POST['txtBoard'.$slno] != '' ? $_POST['txtBoard'.$slno] : '';
					${'txtDivision'.$slno} = isset($_POST['txtDivision'.$slno]) && $_POST['txtDivision'.$slno] != '' ? $_POST['txtDivision'.$slno] : 'NULL';
					${'txtMS'.$slno} = isset($_POST['txtMS'.$slno]) && $_POST['txtMS'.$slno] != '' ? $_POST['txtMS'.$slno] : '';
					${'txtFM'.$slno} = isset($_POST['txtFM'.$slno]) && $_POST['txtFM'.$slno] != '' ? $_POST['txtFM'.$slno] : '';
					${'txtPercent'.$slno} = isset($_POST['txtPercent'.$slno]) && $_POST['txtPercent'.$slno] != '' ? $_POST['txtPercent'.$slno] : null;
					${'txtsubject'.$slno} = isset($_POST['txtsubject'.$slno]) && $_POST['txtsubject'.$slno] != '' ? $_POST['txtsubject'.$slno] : '';
					${'txtdistinct'.$slno} = isset($_POST['txtdistinct'.$slno]) && $_POST['txtdistinct'.$slno] != '' ? $_POST['txtdistinct'.$slno] : null;
					${'txtgrading'.$slno} = isset($_POST['txtgrading'.$slno]) && $_POST['txtgrading'.$slno] != '' ? $_POST['txtgrading'.$slno] : '';
					${'txtqual2'.$slno} = isset($_POST['txtqual2'.$slno]) && $_POST['txtqual2'.$slno] != '' ? $_POST['txtqual2'.$slno] : '';
					${'txtOther_grad'.$slno} = isset($_POST['txtOther_grad'.$slno]) && $_POST['txtOther_grad'.$slno] != '' ? $_POST['txtOther_grad'.$slno] : '';
					$slno++;
					//echo $_POST['txtQualification'.$slno];
				}
				$txtQualification3 = isset($_POST['txtQualification3']) && $_POST['txtQualification3'] != '' ? $_POST['txtQualification3'] : '';
				$txtYear3 = isset($_POST['txtYear3']) && trim($_POST['txtYear3']) != '' ? (int) trim($_POST['txtYear3']) : null;
				$txtBoard3 = isset($_POST['txtBoard3']) && $_POST['txtBoard3'] != '' ? $_POST['txtBoard3'] : '';
				$txtDivision3 = isset($_POST['txtDivision3']) && $_POST['txtDivision3'] != '' ? $_POST['txtDivision3'] : null;
				$txtMS3 = isset($_POST['txtMS3']) && $_POST['txtMS3'] != '' ? $_POST['txtMS3'] : '';
				$txtFM3 = isset($_POST['txtFM3']) && $_POST['txtFM3'] != '' ? $_POST['txtFM3'] : '';
				$txtPercent3 = isset($_POST['txtPercent3']) && $_POST['txtPercent3'] != '' ? $_POST['txtPercent3'] : null;
				//Entrance exam appeared
				  
				$txtQualification4 = isset($_POST['txtQualification4']) && $_POST['txtQualification4'] != '' ? $_POST['txtQualification4'] : '';
				$txtYear4 = isset($_POST['txtYear4']) && trim($_POST['txtYear4']) != '' ? (int) trim($_POST['txtYear4']) : null;
				$txtBoard4 = isset($_POST['txtBoard4']) && $_POST['txtBoard4'] != '' ? $_POST['txtBoard4'] : '';
				$txtDivision4 = isset($_POST['txtDivision4']) && $_POST['txtDivision4'] != '' ? $_POST['txtDivision4'] : null;
				$txtMS4 = isset($_POST['txtMS4']) && $_POST['txtMS4'] != '' ? $_POST['txtMS4'] : '';
				$txtFM4 = isset($_POST['txtFM4']) && $_POST['txtFM4'] != '' ? $_POST['txtFM4'] : '';
				$txtPercent4 = isset($_POST['txtPercent4']) && $_POST['txtPercent4'] != '' ? $_POST['txtPercent4'] : null;
				$txtOther_grad = isset($_POST['txtOther_grad']) && $_POST['txtOther_grad'] != '' ? $_POST['txtOther_grad'] : '';
				
				$txtQualification5 = isset($_POST['txtQualification5']) && $_POST['txtQualification5'] != '' ? $_POST['txtQualification5'] : '';
				$txtYear5 = isset($_POST['txtYear5']) && trim($_POST['txtYear5']) != '' ? (int) trim($_POST['txtYear5']) : null;
				$txtBoard5 = isset($_POST['txtBoard5']) && $_POST['txtBoard5'] != '' ? $_POST['txtBoard5'] : '';
				$txtDivision5 = isset($_POST['txtDivision5']) && $_POST['txtDivision5'] != '' ? $_POST['txtDivision5'] : null;
				$txtMS5 = isset($_POST['txtMS5']) && $_POST['txtMS5'] != '' ? $_POST['txtMS5'] : '';
				$txtFM5 = isset($_POST['txtFM5']) && $_POST['txtFM5'] != '' ? $_POST['txtFM5'] : '';
				$txtPercent5 = isset($_POST['txtPercent5']) && $_POST['txtPercent5'] != '' ? $_POST['txtPercent5'] : null;
				  
				//
				$txtTotalExperience1 = isset($_POST['txtTotalExperience']) ? trim($_POST['txtTotalExperience']) : '';//echo $txtTotalExperience1;die();
				$toatl_size = isset($_POST['txtorganization']) ? $_POST['txtorganization'] : '';
				if($toatl_size != '')
				{
					$toatl_size = sizeof($toatl_size);
				}
				
				$radioExam = isset($_POST['radioExam']) ? $_POST['radioExam'] : '';
				$radioMarkSheet = isset($_POST['radioMarkSheet']) ? $_POST['radioMarkSheet'] : '';
				$pay_mode = isset($_POST['mode']) ? $_POST['mode'] : '';
				$radioGradCert = isset($_POST['radioGradCert']) ? $_POST['radioGradCert'] : 'No';
				$radioGradMarkSheet = isset($_POST['radioGradMarkSheet']) ? $_POST['radioGradMarkSheet'] : 'No';
				$hidDate = isset($_POST['hidDate']) ? $_POST['hidDate'] : '';
				$txtExamMark = isset($_POST['txtExamMark']) && trim($_POST['txtExamMark']) != '' ? (float) trim($_POST['txtExamMark']) : 'NULL';
				$txtfinalpercentage = isset($_POST['txtfinalpercentage']) && trim($_POST['txtfinalpercentage']) != '' ? (float) trim($_POST['txtfinalpercentage']) : 'NULL';
				//$chkMAT = isset($_POST['chkMAT']) ? mysqli_real_escape_string($con, trim($_POST['chkMAT'])) : '';
				//$chkIACR = isset($_POST['chkIACR']) ? mysqli_real_escape_string($con, trim($_POST['chkIACR'])) : '';
				//$chkUU = isset($_POST['chkUU']) ? mysqli_real_escape_string($con, trim($_POST['chkUU'])) : '';
				$radioSports = isset($_POST['radioSports']) ? trim($_POST['radioSports']) : '';
				$radioService = isset($_POST['radioService']) ? trim($_POST['radioService']) : '';
				$radioResident = isset($_POST['radioResident']) ? trim($_POST['radioResident']) : '';
				//$is_employed = isset($_POST['empGovt']) ? $_POST['empGovt'] : '';
				$cmbReservedCategory = isset($_POST['cmbCommunity']) ? $_POST['cmbCommunity'] : '';
				$cmbDcOffice = isset($_POST['cmbDcOffice']) ? $_POST['cmbDcOffice'] : '';
				$radioComputer = isset($_POST['radioComputer']) ?  trim($_POST['radioComputer']) : '';
				//$cmbPostSelect = $_POST['cmbPostSelect'];
				//declaration
				$chkUndertaking1 = 1;
				$chkUndertaking2 = 2;
				$chkUndertaking3 = 3;
				$declaration1 = "I declare that the particulars furnished in this form are true to the best of my knowledge and belief and as per my certificates and valid official documents. I further declare that in case any of the above information is found to be incorrect at any time, I shall be liable to forfeit my seat and to such penal action as the University may deem appropriate.";
				$declaration2 = "I undertake to abide by the rules of the P.G. Council and P.G. Hostels, framed by the Berhampur University and if at any time, in any instance of breach of these rules, indiscipline, disobedience or misconduct or involvement in ragging is found against me, my name shall be struck off from the rolls of the University. ";
				$declaration3 = "I have understood the various provisions and rules of eligibility and admission to various P.G. Departments of Berhampur University as mentioned in the Prospectus along with the application form and I undertake to abide by any decision taken by the University authorities in regard to my eligibility and admission into P.G. Departments.";
				$chkApplicantUndertaking = isset($_POST['chkApplicantUndertaking']) ? mysqli_real_escape_string($con, trim($_POST['chkApplicantUndertaking'])) : '';
				$now = date("Y-m-d H:i:s");
				$this->db->save_queries = TRUE;
				$this->db->select("count(*) AS cnt");
				$this->db->from('applicant_appl_overview');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				echo "hiiiiiiiii";
				die();*/
				$countexp = '';
				$this->db->select("count(*) AS cnt");
				$this->db->from('program_wise_exp_validation');
				$this->db->where('program_code',$program_code);
				$this->db->where('program_wise_exp_validation.record_status',1);
				$this->db->order_by('program_wise_exp_validation.id');
				$result1 = $this->db->get();
				foreach($result1->result_array() as $appl)
				{
					$countexp = $appl['cnt'];
				}
				if($radioPhysicallY == 'NO')
				{
					$txtphtype='';
				}
				foreach($result->result_array() as $appl)
				{
					$count = $appl['cnt'];
				}
				if($count >= 1)
				{
					$this->session->set_userdata('mode', 'edit');
				}
				else
				{
					$this->session->set_userdata('mode', 'new');
				}
				$mode = $this->session->userdata('mode');
				$fee = 0;
				$this->db->select("amount");
				$this->db->from('program_fee_setup');
				$this->db->where('program_code',$program_code);
				$this->db->where('category_code',$cmbReservedCategory);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				foreach($result->result_array() as $row)
				{
					$fee = $row['amount'];
				}
				
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program_code);
				$update_applicant_relation2 = $this->db->delete('applicant_qual_temp');
				if(!$update_applicant_relation2)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error deleting applicant_qual_temp';
				}
				
				
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('program_code',$program_code);
				$update_applicant_relation2 = $this->db->delete('applicant_details_temp');
				if(!$update_applicant_relation2)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error deleting applicant_details_temp';
				}
				
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program_code);
				$update_applicant_relation2 = $this->db->delete('applicant_tech_qual_temp');
				if(!$update_applicant_relation2)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error deleting applicant_tech_qual_temp';
				}
				$this->db->select("A.email_id");
				$this->db->from('applicant_reg_master A');
				$this->db->where('A.reg_user_id',$reg_user_id);
				$result = $this->db->get();
				$get_data = $result->result_array();
				foreach($get_data as $row)
				{
					$txtApplicantEmail = $row['email_id'];
				}
				
				//echo $mode;die();
				if($mode == 'edit')
				{
					$this->db->trans_start();
					$dbStatus = TRUE;
					$dbmessage = 'Data saved successfully';
					$extra_fee = '0';
					$count_appl = '0';
					$this->db->select("count(*) AS cnt,appl_no");
					$this->db->from('applicant_appl_overview');
					$this->db->where('applied_program',$program_code);
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->group_by('appl_no');
					$result = $this->db->get();
					//ECHO $this->db->last_query();die();
					foreach($result->result_array() as $appl)
					{
						$count_appl = $appl['cnt'];
						$appl_no = $appl['appl_no'];
					}
					if($count_appl >= 1)
					{
						$paid_fee = 0;
						$cnt_paid_fee = 0;
						$this->db->select("count(*) as cnt,amount");
						$this->db->from('applicant_form_fee_overview');
						$this->db->where('appl_no',$appl_no);
						$this->db->group_by('appl_no');
						$result = $this->db->get();
						foreach($result->result_array() as $row)
						{
							$cnt_paid_fee = $row['cnt'];
							$paid_fee = $row['amount'];
						}
						if($cnt_paid_fee > 0)
						{
							if($fee > $paid_fee)
							{
								$extra_fee = $fee - $paid_fee;
							}
						}
						
					}
					
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
						// District code
				/*$this->db->select("district_code");
				$this->db->from('district_master');
				$this->db->where('district_name',$cmbPresentDist);
				$result = $this->db->get();
				$cmbPresentDist= $result->result_array();
				foreach($cmbPresentDist as $row)
				{
					$cmbPresentDist=$row['district_code'];
				}*/
				/*$this->db->select("district_code");
				$this->db->from('district_master');
				$this->db->where('district_name',$cmbPermanentDist);
				$result = $this->db->get();
				$cmbPermanentDist= $result->result_array();
				foreach($cmbPermanentDist as $row)
				{
					$cmbPermanentDist=$row['district_code'];
				}*/

				/*$this->db->select("state_code");
				$this->db->from('state_master');
				$this->db->where('state_name',$cmbPresentState);
				$result = $this->db->get();
				$cmbPresentState= $result->result_array();
				foreach($cmbPresentState as $row)
				{
					$cmbPresentState=$row['state_code'];
				}*/

				/*$this->db->select("state_code");
				$this->db->from('state_master');
				$this->db->where('state_name',$cmbPermanentState);
				$result = $this->db->get();
				$cmbPermanentState= $result->result_array();
				foreach($cmbPermanentState as $row)
				{
					$cmbPermanentState=$row['state_code'];
				}*/
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
							'institute_code'=>$institute_code, 
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant_address = $this->db->update('applicant_address',$applicant_address_array);
						if(!$update_applicant_address){
							$dbStatus = FALSE;
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
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant_address = $this->db->update('applicant_address',$applicant_address_array1);
						if(!$update_applicant_address){
							$dbStatus = FALSE;
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
							$dbStatus = FALSE;
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
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant = $this->db->update('applicant_address',$applicant_address_array3);
						if(!$update_applicant){
							$dbStatus = FALSE;
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
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant = $this->db->update('applicant_address',$applicant_address_array4);
						if(!$update_applicant){
							$dbStatus = FALSE;
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
				/*ECHO $dob;
				DIE();*/
					if($countexp > 0)
					{
						$this->db->where('reg_user_id',$reg_user_id);
						$this->db->where('program_code',$program_code);
						$delete_applicant_postwise_experience = $this->db->delete('applicant_postwise_experience');
						if(!$delete_applicant_postwise_experience)
						{
							$dbstatus = FALSE;
							$dbmessage = 'Error deleting applicant_work_experience_detail';
						}
						if(isset($_POST['radioExperience1']))
						{
							$j = 0;
							for($i=1;$i <= $countexp;$i++)
							{
							
								if($_POST['radioExperience'.$i] !=''){
									
									$this->db->select("*");
									$this->db->from('program_wise_exp_validation');
									$this->db->where('program_code',$program_code);
									$this->db->where('experience_code',$_POST['expcode'][$j]);
									$result = $this->db->get();
									foreach($result->result_array() as $appl)
									{
										$experience = $appl['experience'];
									}
									
									$insert_exp_data=
									array(
										"reg_user_id" => $reg_user_id,
										"program_code" => $program_code,
										"is_experienced" => $_POST['radioExperience'.$i],
										"sl_no"=>$i+1,
										"experience_code"=>$_POST['expcode'][$j],
										"experience_name"=>$experience,
										"created_by"=>$reg_user_id,
										"created_on"=>$now
										);
										$this->db->insert('applicant_postwise_experience',$insert_exp_data);
										if($this->db->affected_rows() == 0)
										{
											$dbstatus = FALSE;
											$dbmessage = 'Error updating applicant_work_experience_detail';
										}
								}
								$j++;
							}
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
						'dob' => $dob,
						'age'=>$age,
						'gender' => $radiogender,
						'id_proof' => $cmbidproof,
						'id_proof_number' => $txtidproof,
						'jee_place' => $radioJEE,
						'nationality' => $cmbNationality,
						'cmbrelationship' => $cmbrelationship,
						'adhar_no' => $txtUid,
						'dob_in_word' => $hidDate,
						'category' => $cmbReservedCategory,
						'dc_office' => $cmbDcOffice,
						'phtype'=>$txtphtype,
						'is_computer_education'=>$radioComputer,
						'is_minority_community' => $radioMinority,
						'is_passed' => $radioMarkSheet,
						'payment_mode' => $pay_mode,
						'grad_cert' => $radioGradCert,
						'grad_mark_sheet' => $radioGradMarkSheet,
						'minority_community_details' => $cmbCommunity,
						
						'is_north_east' => $radiobelong,
						'father_occupation' => $txtOccupation,
						'annual_parent_income' => $txtIncome,
						'indicate_choice' => $txtIndicate,
						'know_about_cipet' => $txtKnowabout,
						'physically_challenged' => $radioPhysicallY ,
						'is_suspended' => $empsuspended ,
						'any_disciplinary_action' => $empDisciplinary ,
						
						'religion' => $cmbReligion,
						'applicant_email' => $txtApplicantEmail,
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
						
						
						'district_code'=>$cmbHomeDist, 
						'ap_resident'=>$radioResident,
						'is_sports'=>$radioSports,
						'is_ex_serviceman'=>$radioService,
						'is_employed'=>$is_employed,
						'informed_govt'=> $chkInformed,
						'name_of_office'=>$txtNameOfOffice,
						'govt_doj'=>$txtDOJ,
						'name_of_post' => $txtNameOfPost,
						'date_of_debar' => $txtDateOfDebar,
						'period_of_debar' => $txtPeriodOfDebar,
						
						'father_occupation'=>$FathersProfession, 
						'annual_parent_income'=>$FathersIncome,
						'north_east_state'=>$cmbNorthState, 

						'mothers_profession'=>$MothersProfession, 
						'mothers_income'=>$MothersIncome,
						'mothers_name'=>$txtMotherName,
						'father_name'=>$txtFatherName,
						'fathers_adhar_no'=>$fathers_adhar_no,
						'mothers_adhar_no'=>$mothers_adhar_no,
						'relevantinfo' => $relevantinfo,
						'suspendedInfo' => $empsuspendedinfo,
						'disciplinaryInfo' => $empDisciplinaryInfo,
						'enclosuresdetails' => $enclosuresdetails,

						'employer_add'=>$Employer_address,
						'employer_from'=>$Employer_from,
						'employer_to'=>$Employer_to,
						'employer_add1'=>$Employer_address1, 
						'employer_from1'=>$Employer_from1,
						'employer_to1'=>$Employer_to1, 
						'completion_date'=>$completion_date, 
						
						'fee'=>$fee, 
						'extra_fee'=>$extra_fee, 
						'comm_address_ref_id'=>$comm_address_ref_id,
						'perm_address_ref_id'=>$perm_address_ref_id,
						'is_exp'=> $radioExp,
						'presentation_details'=> $presentation_details,
						'any_other_info'=> $any_other_info
						);
						$this->db->where('reg_user_id' , $reg_user_id);
						$this->db->where('applied_program',$program_code);
						$query = $this->db->update('applicant_master',$applicant_master_update_array);
						/*echo $this->db->last_query();
						die();*/
						if(!$query)
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
								'id_proof' => $cmbidproof,
								'id_proof_number' => $txtidproof,
								'jee_place' => $radioJEE,
								'nationality' => $cmbNationality,
								'cmbrelationship' => $cmbrelationship,
								'dob' => $dob,
								'adhar_no' => $txtUid,
								'dob_in_word' => $hidDate,
								'category' => $cmbReservedCategory,
								'phtype'=>$txtphtype,
								
								'father_name'=>$txtFatherName,
								'is_minority_community' => $radioMinority,
								'is_passed' => $radioMarkSheet,
								'payment_mode' => $pay_mode,
								'grad_mark_sheet' => $radioGradMarkSheet,
								'minority_community_details' => $cmbCommunity,
								
								'is_north_east' => $radiobelong,
								'father_occupation' => $txtOccupation,
								'annual_parent_income' => $txtIncome,
								'indicate_choice' => $txtIndicate,
								'know_about_cipet' => $txtKnowabout,
								'physically_challenged' => $radioPhysicallY ,
								'last_year_mark' => $txtfinalpercentage,
								
								'religion' => $cmbReligion,
								'applicant_email' => $txtApplicantEmail,
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
								'relevantinfo' => $relevantinfo,
								'enclosuresdetails' => $enclosuresdetails,
								'father_occupation'=>$FathersProfession, 
							'annual_parent_income'=>$FathersIncome,
							'north_east_state'=>$cmbNorthState, 
							'mothers_profession'=>$MothersProfession, 
							'mothers_income'=>$MothersIncome,
							'mothers_name'=>$txtMotherName,
							'fathers_adhar_no'=>$fathers_adhar_no,
							'mothers_adhar_no'=>$mothers_adhar_no,

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
						$dbStatus = FALSE;
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
						$dbStatus = FALSE;
						$dbmessage = 'Error updating applicant_relation_2';
					}
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$update_applicant_relation2 = $this->db->delete('applicant_qualification_detail');
					//echo $this->db->last_query();
					if(!$update_applicant_relation2)
					{
						$dbStatus = FALSE;
						$dbmessage = 'Error deleting applicant_qualification_detail';
					}
					
					$slno = 1;
					/*echo $txtQualification3;
					die();*/
					foreach($allQualifications as $row)
					{
						
							$update_applicant_qualification_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'qual_desc_1' => ${'txtQualification'.$slno},
								'other_stream' => ${'txtOther_grad'.$slno},
								'year_of_passing' => ${'txtYear'.$slno},
								'duration' => ${'txtDuration'.$slno},
								'course' => ${'txtCourse'.$slno},
								'university_board' => ${'txtBoard'.$slno},
								'percentage_mark' => ${'txtPercent'.$slno},
								'division_distinction' => ${'txtdistinct'.$slno},
								'grade' => ${'txtgrading'.$slno},
								'qual_desc_2' => ${'txtqual2'.$slno},
								'created_by' => $reg_user_id,
								'created_on' => $now
							);
							
							
							$this->db->insert('applicant_qualification_detail',$update_applicant_qualification_array);
							/*echo $this->db->last_query();
							die();*/
							$slno++;
						/*}*/ 
					}
					
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$update_applicant_technical_qualification_detail = $this->db->delete('applicant_technical_qualification_detail');
					//echo $this->db->last_query();
					if(!$update_applicant_technical_qualification_detail)
					{
						$dbStatus = FALSE;
						$dbmessage = 'Error deleting applicant_technical_qualification_detail';
					}
					
					//start qual
					if(isset($_POST['txtExamName']))
					{
						for($i=0;$i < sizeof($_POST['txtExamName']);$i++){
						
							if($_POST['txtExamName'][$i]!=''){
									$insert_research_data = array(
									'reg_user_id' => $reg_user_id,
									'applied_program' => $program_code,
									'qual_desc_1'=>$_POST['txtExamName'][$i],
									'stream'=>$_POST['txtStream'][$i],
									'year'=> $_POST['txtYearQual'][$i],
									'affiliation_from'=>$_POST['txtBoardOth'][$i],
									'division'=>$_POST['txtDiv'][$i],
									'remark'=>$_POST['txtGradingOth'][$i],
									'grade_cgpa'=>$_POST['txtCGPA'][$i],
									'sl_no'=>$i+1,
									'created_by'=>$reg_user_id,
									'created_on'=>$now
									);
									$this->db->insert('applicant_technical_qualification_detail',$insert_research_data);
									if($this->db->affected_rows() == 0)
									{
										$dbstatus = FALSE;
										$dbmessage = 'Error updating applicant_technical_qualification_detail';
									}
							}
							
							
						}
					}					
					//end qual	
					//14. Technical qualifiation2
					/*if($txtExamName1 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $txtExamName1,
							'year' => $txtYearQual1,
							'stream' => $txtStream1,
							'affiliation_from' => $txtBoardOth1,
							'subjects_offered' => $txtSub1,
							'grade_cgpa' => $txtCGPA1,
							'division' => $txtDiv1,
							'remark' => $txtGradingOth1,
							'sl_no' => '5',
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 5';
						}
						
					}*/
					//14. Technical qualifiation3
					/*if($txtExamName2 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $txtExamName2,
							'year' => $txtYearQual2,
							'stream' => $txtStream2,
							'affiliation_from' => $txtBoardOth2,
							'subjects_offered' => $txtSub2,
							'grade_cgpa' => $txtCGPA2,
							'division' => $txtDiv2,
							'remark' => $txtGradingOth2,
							'sl_no' => '6',
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 6';
						}
					}*/
						if($dbStatus == TRUE)
						{
							$this->db->select("appl_no");
							$this->db->from('applicant_appl_overview');
							$this->db->where('applied_program',$program_code);
							$this->db->where('reg_user_id',$reg_user_id);
							$result = $this->db->get();
							//echo $reg_user_id.$program_code;die;
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
									$dbStatus = FALSE;
									$dbmessage = 'Error updating applicant_document_list';
								}
								
							}
							
							if($extra_fee != 0){
								$appl_overview = array(
									'appl_status'=>'Document Uploaded'
								);
								$this->db->where('appl_no',$appl_no);
								$this->db->where('applied_program',$program_code);
								$update_appl_overview = $this->db->update('applicant_appl_overview',$appl_overview);
								if(!$update_appl_overview)
								{
									$dbstatus = FALSE;
									$dbmessage = 'Error updating applicant_appl_overview';
								}
							}
/*
							$this->db->select("A.document_type_code");
							$this->db->from('program_document_setup A');
							$this->db->join('course_document_setup B',"A.program_code = B.program_code  AND B.course_code IN('$cmbPostSelect') 
											AND A.document_type_code = B.document_type_code",'LEFT');
							$this->db->where_in('course_code',$cmbPostSelect);
							$this->db->where('program_code',$program_code);
							$this->db->where_not_in("A.document_type_code", $where_clause);
							$this->db->where('record_status',1);
							$result = $this->db->get();
							*/
							//$course_code = implode("','",$cmbPostSelect);
							$query = $this->db->query("SELECT A.document_type_code,B.category_code
															FROM `program_document_setup` `A`
															LEFT JOIN `course_document_setup` `B` ON `A`.`program_code` = `B`.`program_code` 
																AND A.document_type_code = B.document_type_code
															WHERE A.`program_code` = '$program_code'
															AND A.`document_type_code` NOT IN (SELECT B.document_type_code FROM `course_document_setup` B 
																WHERE `B`.`program_code`  = '$program_code')
															AND (B.category_code IN ('$cmbReservedCategory') OR B.category_code IS NULL)
															AND A.`record_status` = 1");

							$documentsReq = $query->result_array();
							//$documentsReq = $result->result_array();
							//echo $this->db->last_query();die();
							
							
							//print_r($documentsReq);die();
							if($cmbReservedCategory == 'GEN' || $cmbReservedCategory == 'OBC' || $cmbReservedCategory == 'PH' ){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
							}
							if($radiobelong == 'NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DOMICILE');
							}
							if($radioews == '' || $radioews == 'NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EWS');
							}
							if($radioPhysicallY == 'NO' || $cmbReservedCategory != 'PH'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'PHC');
							}
							if($radioGradCert == 'No'  || $radioMarkSheet == 'No'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HQC');
							}
							if($radioGradMarkSheet == 'No' || $radioMarkSheet == 'No'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HDMS');
							}
							if($radioID == 'No'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DL');
							}
							if($employed == 'NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'NOC');
							}
							if($pay_mode == 'Online'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CHALLAN');
							}
							if($cmbNationality == 'OTH'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
							}
							if(($txtTotalExperience1 == '' && $radioExp == 'NO' && $radioService == 'NO') ||($txtTotalExperience1 == '0 Years 0 months' && $radioExp == 'NO' && $radioService == 'NO')){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT');
							}
							if($toatl_size == '')
							{
								//$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT2');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT3');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT4');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT5');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT6');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT7');
							}
							if($toatl_size == 1)
							{
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT2');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT3');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT4');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT5');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT6');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT7');
							}
							if($toatl_size == 2)
							{
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT3');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT4');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT5');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT6');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT7');
							}
							if($toatl_size == 3)
							{
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT4');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT5');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT6');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT7');
							}
							if($toatl_size == 4)
							{
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT5');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT6');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT7');
							}
							if($toatl_size == 5)
							{
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT6');
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT7');
							}
							if($toatl_size == 6)
							{
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT7');
							}
							
							if($radioPhysicallY == 'NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'PWD');
							}
							
							//$documentsReq = array_merge($documentsReq, $documentsRequired); 
							//print_r($documentsReq);
							//print_r($documentsRequired);die();
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
										$dbStatus = FALSE;
										$dbmessage = 'Error updating applicant_document_list';
									}
								}
								else
								{
									$this->db->insert('applicant_document_list',$document_list_insert_array);
									if(!$update_applicant_relation2)
									{
										$dbStatus = FALSE;
										$dbmessage = 'Error updating applicant_document_list';
									}
								}
							}
							
							if($dbStatus == TRUE)
							{
								$this->db->trans_complete();
								$this->session->set_userdata('admcode', $program_code);
								$this->session->set_userdata('reg_user_id', $reg_user_id);
								$this->session->set_userdata('appl_no', $appl_no);
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
							'institute_code'=>$institute_code, 
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant_address = $this->db->update('applicant_address',$applicant_address_array);
						if(!$update_applicant_address){
							$dbStatus = FALSE;
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
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant_address = $this->db->update('applicant_address',$applicant_address_array1);
						if(!$update_applicant_address){
							$dbStatus = FALSE;
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
							$dbStatus = FALSE;
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
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant = $this->db->update('applicant_address',$applicant_address_array3);
						if(!$update_applicant){
							$dbStatus = FALSE;
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
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant = $this->db->update('applicant_address',$applicant_address_array4);
						if(!$update_applicant){
							$dbStatus = FALSE;
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
				/*ECHO $dob;
				DIE();*/
					if($countexp > 0)
					{
						$this->db->where('reg_user_id',$reg_user_id);
						$this->db->where('program_code',$program_code);
						$delete_applicant_postwise_experience = $this->db->delete('applicant_postwise_experience');
						if(!$delete_applicant_postwise_experience)
						{
							$dbstatus = FALSE;
							$dbmessage = 'Error deleting applicant_work_experience_detail';
						}
						if(isset($_POST['radioExperience1']))
						{
							$j = 0;
							for($i=1;$i <= $countexp;$i++)
							{
							
								if($_POST['radioExperience'.$i] !=''){
									
									$this->db->select("*");
									$this->db->from('program_wise_exp_validation');
									$this->db->where('program_code',$program_code);
									$this->db->where('experience_code',$_POST['expcode'][$j]);
									$result = $this->db->get();
									foreach($result->result_array() as $appl)
									{
										$experience = $appl['experience'];
									}
									
									$insert_exp_data=
									array(
										"reg_user_id" => $reg_user_id,
										"program_code" => $program_code,
										"is_experienced" => $_POST['radioExperience'.$i],
										"sl_no"=>$i+1,
										"experience_code"=>$_POST['expcode'][$j],
										"experience_name"=>$experience,
										"created_by"=>$reg_user_id,
										"created_on"=>$now
										);
										$this->db->insert('applicant_postwise_experience',$insert_exp_data);
										if($this->db->affected_rows() == 0)
										{
											$dbstatus = FALSE;
											$dbmessage = 'Error updating applicant_work_experience_detail';
										}
								}
								$j++;
							}
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
						'dob' => $dob,
						'age'=>$age,
						'gender' => $radiogender,
						'id_proof' => $cmbidproof,
						'id_proof_number' => $txtidproof,
						'jee_place' => $radioJEE,
						'nationality' => $cmbNationality,
						'cmbrelationship' => $cmbrelationship,
						'adhar_no' => $txtUid,
						'dob_in_word' => $hidDate,
						'category' => $cmbReservedCategory,
						'dc_office' => $cmbDcOffice,
						'phtype'=>$txtphtype,
						'is_computer_education'=>$radioComputer,
						'is_minority_community' => $radioMinority,
						'is_passed' => $radioMarkSheet,
						'payment_mode' => $pay_mode,
						'grad_cert' => $radioGradCert,
						'grad_mark_sheet' => $radioGradMarkSheet,
						'minority_community_details' => $cmbCommunity,
						
						'is_north_east' => $radiobelong,
						'father_occupation' => $txtOccupation,
						'annual_parent_income' => $txtIncome,
						'indicate_choice' => $txtIndicate,
						'know_about_cipet' => $txtKnowabout,
						'physically_challenged' => $radioPhysicallY ,
						'is_suspended' => $empsuspended ,
						'any_disciplinary_action' => $empDisciplinary ,
						
						'religion' => $cmbReligion,
						'applicant_email' => $txtApplicantEmail,
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
						
						
						'district_code'=>$cmbHomeDist, 
						'ap_resident'=>$radioResident,
						'is_sports'=>$radioSports,
						'is_ex_serviceman'=>$radioService,
						'is_employed'=>$is_employed,
						'informed_govt'=> $chkInformed,
						'name_of_office'=>$txtNameOfOffice,
						'govt_doj'=>$txtDOJ,
						'name_of_post' => $txtNameOfPost,
						'date_of_debar' => $txtDateOfDebar,
						'period_of_debar' => $txtPeriodOfDebar,
						
						'father_occupation'=>$FathersProfession, 
						'annual_parent_income'=>$FathersIncome,
						'north_east_state'=>$cmbNorthState, 

						'mothers_profession'=>$MothersProfession, 
						'mothers_income'=>$MothersIncome,
						'mothers_name'=>$txtMotherName,
						'father_name'=>$txtFatherName,
						'fathers_adhar_no'=>$fathers_adhar_no,
						'mothers_adhar_no'=>$mothers_adhar_no,
						'relevantinfo' => $relevantinfo,
						'suspendedInfo' => $empsuspendedinfo,
						'disciplinaryInfo' => $empDisciplinaryInfo,
						'enclosuresdetails' => $enclosuresdetails,

						'employer_add'=>$Employer_address,
						'employer_from'=>$Employer_from,
						'employer_to'=>$Employer_to,
						'employer_add1'=>$Employer_address1, 
						'employer_from1'=>$Employer_from1,
						'employer_to1'=>$Employer_to1, 
						'completion_date'=>$completion_date, 
						'comm_address_ref_id'=>$comm_address_ref_id,
						'fee'=>$fee, 
						'extra_fee'=>'0',
						'perm_address_ref_id'=>$perm_address_ref_id,
						'is_exp'=> $radioExp,
						'presentation_details'=> $presentation_details,
						'any_other_info'=> $any_other_info
						);
						$this->db->where('reg_user_id' , $reg_user_id);
						$this->db->where('applied_program',$program_code);
						$query = $this->db->update('applicant_master',$applicant_master_update_array);
						/*echo $this->db->last_query();
						die();*/
						if(!$query)
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
								'id_proof' => $cmbidproof,
								'id_proof_number' => $txtidproof,
								'jee_place' => $radioJEE,
								'nationality' => $cmbNationality,
								'cmbrelationship' => $cmbrelationship,
								'dob' => $dob,
								'adhar_no' => $txtUid,
								'dob_in_word' => $hidDate,
								'category' => $cmbReservedCategory,
								'phtype'=>$txtphtype,
								
								'father_name'=>$txtFatherName,
								'is_minority_community' => $radioMinority,
								'is_passed' => $radioMarkSheet,
								'payment_mode' => $pay_mode,
								'grad_mark_sheet' => $radioGradMarkSheet,
								'minority_community_details' => $cmbCommunity,
								
								'is_north_east' => $radiobelong,
								'father_occupation' => $txtOccupation,
								'annual_parent_income' => $txtIncome,
								'indicate_choice' => $txtIndicate,
								'know_about_cipet' => $txtKnowabout,
								'physically_challenged' => $radioPhysicallY ,
								'last_year_mark' => $txtfinalpercentage,
								
								'religion' => $cmbReligion,
								'applicant_email' => $txtApplicantEmail,
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
								'relevantinfo' => $relevantinfo,
								'enclosuresdetails' => $enclosuresdetails,
								'father_occupation'=>$FathersProfession, 
							'annual_parent_income'=>$FathersIncome,
							'north_east_state'=>$cmbNorthState, 
							'mothers_profession'=>$MothersProfession, 
							'mothers_income'=>$MothersIncome,
							'mothers_name'=>$txtMotherName,
							'fathers_adhar_no'=>$fathers_adhar_no,
							'mothers_adhar_no'=>$mothers_adhar_no,

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
						$dbStatus = FALSE;
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
						$dbStatus = FALSE;
						$dbmessage = 'Error updating applicant_relation_2';
					}
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$update_applicant_relation2 = $this->db->delete('applicant_qualification_detail');
					//echo $this->db->last_query();
					if(!$update_applicant_relation2)
					{
						$dbStatus = FALSE;
						$dbmessage = 'Error deleting applicant_qualification_detail';
					}
					
					$slno = 1;
					/*echo $txtQualification3;
					die();*/
					foreach($allQualifications as $row)
					{
						
							$update_applicant_qualification_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'qual_desc_1' => ${'txtQualification'.$slno},
								'other_stream' => ${'txtOther_grad'.$slno},
								'year_of_passing' => ${'txtYear'.$slno},
								'duration' => ${'txtDuration'.$slno},
								'course' => ${'txtCourse'.$slno},
								'university_board' => ${'txtBoard'.$slno},
								'percentage_mark' => ${'txtPercent'.$slno},
								'division_distinction' => ${'txtdistinct'.$slno},
								'grade' => ${'txtgrading'.$slno},
								'qual_desc_2' => ${'txtqual2'.$slno},
								'created_by' => $reg_user_id,
								'created_on' => $now
							);
							
							
							$this->db->insert('applicant_qualification_detail',$update_applicant_qualification_array);
							/*echo $this->db->last_query();
							die();*/
							$slno++;
						/*}*/ 
					}
					
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$update_applicant_technical_qualification_detail = $this->db->delete('applicant_technical_qualification_detail');
					//echo $this->db->last_query();
					if(!$update_applicant_technical_qualification_detail)
					{
						$dbStatus = FALSE;
						$dbmessage = 'Error deleting applicant_technical_qualification_detail';
					}
					//start qual
					if(isset($_POST['txtExamName']))
					{
						for($i=0;$i < sizeof($_POST['txtExamName']);$i++){
						
							if($_POST['txtExamName'][$i]!=''){
								
								$insert_research_data=
								array('reg_user_id' => $reg_user_id,
									'applied_program' => $program_code,
									'qual_desc_1'=>$_POST['txtExamName'][$i],
									'stream'=>$_POST['txtStream'][$i],
									'year'=> $_POST['txtYearQual'][$i],
									'affiliation_from'=>$_POST['txtBoardOth'][$i],
									'division'=>$_POST['txtDiv'][$i],
									'remark'=>$_POST['txtGradingOth'][$i],
									'grade_cgpa'=>$_POST['txtCGPA'][$i],
									'sl_no'=>$i+1,
									'created_by'=>$reg_user_id,
									'created_on'=>$now);
									$this->db->insert('applicant_technical_qualification_detail',$insert_research_data);
									if($this->db->affected_rows() == 0)
									{
										$dbstatus = FALSE;
										$dbmessage = 'Error updating applicant_technical_qualification_detail';
									}
							}
							
							
						}
					}					
					//end qual
					//14. Technical qualifiation2
					/*if($txtExamName1 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $txtExamName1,
							'year' => $txtYearQual1,
							'stream' => $txtStream1,
							'affiliation_from' => $txtBoardOth1,
							'subjects_offered' => $txtSub1,
							'grade_cgpa' => $txtCGPA1,
							'division' => $txtDiv1,
							'remark' => $txtGradingOth1,
							'sl_no' => '5',
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 5';
						}
						
					}*/
					//14. Technical qualifiation3
					/*if($txtExamName2 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $txtExamName2,
							'year' => $txtYearQual2,
							'stream' => $txtStream2,
							'affiliation_from' => $txtBoardOth2,
							'subjects_offered' => $txtSub2,
							'grade_cgpa' => $txtCGPA2,
							'division' => $txtDiv2,
							'remark' => $txtGradingOth2,
							'sl_no' => '6',
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 6';
						}
					}	*/
					/*if($technical_7_1 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $technical_7_1,
							'year' => $technical_7_2,
							'institute_name' => $technical_7_3,
							'sl_no' => '7',
							'thesis' => $technical_7_4,
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 7';
						}
					}*/
					
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$applicant_reference_detail = $this->db->delete('applicant_reference_detail');
					
					if(!$applicant_reference_detail)
					{
						$dbStatus = FALSE;
						$dbmessage = 'Error deleting applicant_reference_detail';
					}
					
					/*for($ref = 0 ;$ref< 2 ;$ref ++ ){
						$update_applicant_reference_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'referenced_by' => $_POST['refname'.$ref],
								'sl_no' => $ref,
								'contact_address' => $_POST['refaddress'.$ref],
								'email_id' => $_POST['refemail'.$ref],
								'mobile_number' => $_POST['refmobile'.$ref],
								'created_by' => $reg_user_id,
								'created_on' => $now
						);
						$this->db->insert('applicant_reference_detail',$update_applicant_reference_array);
						
						if($this->db->affected_rows() == 0)
						{
							$dbstatus = FALSE;
							$dbmessage = 'Error updating applicant_reference_detail';
						}
					}*/
					
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$applicant_research_experience_detaill = $this->db->delete('applicant_research_experience_detail');
					
					if(!$applicant_research_experience_detaill)
					{
						$dbStatus = FALSE;
						$dbmessage = 'Error deleting applicant_research_experience_detail';
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
							$split=explode("_",$program_code);
							$last_digit=substr($split[0], -3);
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
							
						$application_no = $last_digit.$year.$changed_sl_no;
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
							//$this->db->insert('applicant_appl_overview_history',$application_data);
							
							
							$this->db->where('program_code',$program_code);
							$this->db->update('program_master',$program_update_data);
							if($this->db->affected_rows() == 0)
							{
								$dbStatus = FALSE;
								$dbmessage = 'Error updating program';
							}
							//echo $this->db->last_query();
						}
						
						/*$this->db->select("document_type_code");
						$this->db->from('program_document_setup A');
						$this->db->join('course_document_setup B','A.program_code = B.program_code','LEFT');
						$this->db->where_in('course_code',$cmbPostSelect);
						$this->db->where('program_code',$program_code);
						$this->db->where('record_status',1);
						$result = $this->db->get();
						$documentsReq = $result->result_array();
						echo $this->db->last_query();die();*/
						//$course_code = implode("','",$cmbPostSelect);
							$query = $this->db->query("SELECT A.document_type_code,B.category_code
															FROM `program_document_setup` `A`
															LEFT JOIN `course_document_setup` `B` ON `A`.`program_code` = `B`.`program_code` 
																AND A.document_type_code = B.document_type_code
															WHERE A.`program_code` = '$program_code'
															AND A.`document_type_code` NOT IN (SELECT B.document_type_code FROM `course_document_setup` B 
																WHERE `B`.`program_code`  = '$program_code')
															AND (B.category_code IN ('$cmbReservedCategory') OR B.category_code IS NULL)
															AND A.`record_status` = 1");


						$documentsReq = $query->result_array();
						
						/*$this->db->select("document_type_code");
						$this->db->from('course_document_setup');
						$this->db->where('program_code',$program_code);
						$this->db->where_in('course_code',$cmbPostSelect);
						$this->db->where('record_status',1);
						$result = $this->db->get();
						//echo $this->db->last_query();die();
						$documentsRequired = $result->result_array();
						foreach($documentsReq as $row)
						{
							if(!in_array($row['document_type_code'],$documentsRequired) ){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', $row['document_type_code']);
							}
							
						}*/
						if($cmbReservedCategory == 'GEN' || $cmbReservedCategory == 'OBC' || $cmbReservedCategory == 'PH' ){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
						}
						if($radiobelong == 'NO'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DOMICILE');
						}
						if($radioPhysicallY == 'NO' || $cmbReservedCategory != 'PH'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'PHC');
						}
						if($radioGradCert == 'No'  || $radioMarkSheet == 'No'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HQC');
						}
						if($radioGradMarkSheet == 'No' || $radioMarkSheet == 'No'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HDMS');
						}
						if($radioID == 'No'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DL');
						}
						if($employed == 'NO'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'NOC');
						}
						if($pay_mode == 'Online'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CHALLAN');
						}
						if($cmbNationality == 'OTH'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
						}
						/*if($is_employed == 'NO'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT');
						}*/
						if(($txtTotalExperience1 == '' && $radioExp == 'NO' && $radioService == 'NO') ||($txtTotalExperience1 == '0 Years 0 months' && $radioExp == 'NO' && $radioService == 'NO')){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT');
							}
						if($toatl_size == '')
						{
							//$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT2');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT3');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT4');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT5');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT6');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT7');
						}
						if($toatl_size == 1)
						{
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT2');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT3');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT4');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT5');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT6');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT7');
						}
						if($toatl_size == 2)
						{
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT3');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT4');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT5');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT6');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT7');
						}
						if($toatl_size == 3)
						{
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT4');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT5');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT6');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT7');
						}
						if($toatl_size == 4)
						{
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT5');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT6');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT7');
						}
						if($toatl_size == 5)
						{
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT6');
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT7');
						}
						if($toatl_size == 6)
						{
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT7');
						}
						if($radioews == '' || $radioews == 'NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EWS');
							}
						if($radioPhysicallY == 'NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'PWD');
							}
						
						
						//$documentsReq = array_merge($documentsReq, $documentsRequired); 
						foreach($documentsReq AS $row1)
						{
							$document_list_insert_array = array(
								'record_status'=>1,
								'application_no'=>$application_no,
								'document_type_code'=>$row1['document_type_code']
							);
							$this->db->insert('applicant_document_list',$document_list_insert_array);
							if($this->db->affected_rows() == 0)
							{
								$dbStatus = FALSE;
								$dbmessage = 'Error updating applicant_document_list';
							}
						}
						/*echo $dbmessage;
						die();*/
						$page_url = $_SERVER["HTTP_REFERER"];
						$ip_address = $_SERVER['REMOTE_ADDR'];
						$log_status = $dbStatus;
						$log_message = $dbmessage;
						$this->log_detail_record($page_url, $log_status, $log_message, $ip_address);
						if($dbStatus == TRUE)
						{
							$this->db->trans_complete();
							$this->session->set_userdata('admcode', $program_code);
							$this->session->set_userdata('reg_user_id', $reg_user_id);
							$this->session->set_userdata('appl_no', $application_no);
							$this->session->set_userdata('mode', $mode);
							$this->session->set_userdata('step', 3);
							/*if( $this->db->trans_status() === FALSE){
								$dbStatus = FALSE;
								$dbmessage = 'Error While Saving';
							}*/
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
			case 'add_application_data_001':
			
				
				$dbStatus = TRUE;
				$cmbExamCenter = isset($_POST['cmbExamCenter']) ? $_POST['cmbExamCenter'] : '';
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
				 



				$employed = isset($_POST['employed']) ? trim($_POST['employed']) : 'NO';
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
				$radiomaritalstatus = isset($_POST['radiomaritalstatus']) ? trim($_POST['radiomaritalstatus']) : '';
				$txtHomeDist = isset($_POST['txtHomeDist']) ? trim($_POST['txtHomeDist']) : '';
				$txtPHPercent = isset($_POST['txtPHPercent']) ? trim($_POST['txtPHPercent']) : '';
				$radioComputerEducation = isset($_POST['radioComputerEducation']) ?  trim($_POST['radioComputerEducation']) : '';
				$radioComputerType = isset($_POST['radioComputerType']) ?  trim($_POST['radioComputerType']) : '';
				$txtOtherComp = isset($_POST['txtOtherComp']) ?  trim($_POST['txtOtherComp']) : '';
				
				/*te*/

				

				$txtMiddleName = isset($_POST['txtMiddleName']) ?  trim($_POST['txtMiddleName']) : '';
				$txtLastName = isset($_POST['txtLastName']) ? trim($_POST['txtLastName']) : '';
				$fullname = $txtFirstName." ".$txtMiddleName." ".$txtLastName;

				$d = isset($_POST['cmbDay']) ? trim($_POST['cmbDay']) : '';
				$m = isset($_POST['cmbMonth']) ? trim($_POST['cmbMonth']) : '';
				$y = isset($_POST['cmbYear']) ? trim($_POST['cmbYear']) : '';
				$dob = isset($_POST['hidDateFormat']) ? trim($_POST['hidDateFormat']) : '';
				$dob = date("Y-m-d", strtotime($dob));
				//$dob = $y.'-'.$m.'-'.$d;
				/*echo $dob;
				die();*/
				$dbStatus = "";
				$dbMessage = "";
				$dbError = "";

				$radiogender = isset($_POST['radiogender']) ? $_POST['radiogender'] : '';
				$radioID = isset($_POST['radioID']) ? $_POST['radioID'] : '';
				$radioJEE = isset($_POST['radioJEE']) ? $_POST['radioJEE'] : '';
				$radioHostel = isset($_POST['radioHostel']) ? $_POST['radioHostel'] : '';
				$radiomaritalstatus = isset($_POST['radiomaritalstatus']) ? $_POST['radiomaritalstatus'] : '';
				$radioQuota = isset($_POST['radioQuota']) ? $_POST['radioQuota'] : '';
				
				$cmbidproof = isset($_POST['cmbidproof']) ? $_POST['cmbidproof'] : '';
				$txtidproof = isset($_POST['txtidproof']) ? $_POST['txtidproof'] : '';
				
				$relevantinfo = isset($_POST['relevantinfo']) ? $_POST['relevantinfo'] : '';
				$enclosuresdetails = isset($_POST['enclosuresdetails']) ? $_POST['enclosuresdetails'] : '';
				
				//echo $cmbidproof ; die();
				$cmbReservedCategory = isset($_POST['cmbCommunity']) ? $_POST['cmbCommunity'] : '';
				
				$cmbNationality = isset($_POST['cmbNationality']) ? $_POST['cmbNationality'] : '';
				$cmbCommunity = isset($_POST['cmbCommunity1']) ? $_POST['cmbCommunity1'] : '';
				if($cmbReservedCategory == 'PH')
				{
					$cmbCommunity = 'YES';
				}
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
				$txtphtype  = isset($_POST['cmbPH']) ? $_POST['cmbPH'] : '';
				
				$txtOtherNationality = isset($_POST['txtOtherNationality']) ? trim($_POST['txtOtherNationality']) : '';
				$txtOtherRelations = isset($_POST['txtOtherRelations']) ? trim($_POST['txtOtherRelations']) : '';
				$txtMotherTongue = isset($_POST['txtMotherTongue']) ? trim($_POST['txtMotherTongue']) : '';
				$cmbCategory = isset($_POST['cmbCategory']) ? $_POST['cmbCategory'] : '';
				$cmbReligion = isset($_POST['cmbReligion']) ? $_POST['cmbReligion'] : '';
				$txtUnivRegNo = isset($_POST['txtUnivRegNo']) ? $_POST['txtUnivRegNo'] : '';
				//$cmbHighestQualification = isset($_POST['txtQualifyingDegree']) ? $_POST['txtQualifyingDegree'] : '';
				$txtDiv2 = isset($_POST['txtDiv2']) ? $_POST['txtDiv2'] : '';
				$txtGradingOth2 = isset($_POST['txtGradingOth2']) ? $_POST['txtGradingOth2'] : '';
				$txtDiv1 = isset($_POST['txtDiv1']) ? $_POST['txtDiv1'] : '';
				$txtGradingOth1 = isset($_POST['txtGradingOth1']) ? $_POST['txtGradingOth1'] : '';
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
				$txtPresentAddress = isset($_POST['txtPresentAddress']) ?  trim($_POST['txtPresentAddress']) : 'BBSR';
				$txtPresentLocality = isset($_POST['txtPresentLocality']) ? trim($_POST['txtPresentLocality']) : '';
				$txtPresentPost = isset($_POST['txtPresentPost']) ? trim($_POST['txtPresentPost']) : '';
				$cmbPresentDist = isset($_POST['cmbPresentDist']) ?  trim($_POST['cmbPresentDist']) : '';
				$txtPresentPin = isset($_POST['txtPresentPin']) ? trim($_POST['txtPresentPin']) : '761200';
				$cmbPresentState = isset($_POST['cmbPresentState']) ? trim($_POST['cmbPresentState']) : '';
				$txtPresentDistance = isset($_POST['txtPresentDistance']) ? trim($_POST['txtPresentDistance']) : '';
				$txtPresentPanchayat = isset($_POST['txtPresentPanchayat']) ? $_POST['txtPresentPanchayat'] : '';
				$txtPresentBlock = isset($_POST['txtPresentBlock']) ? $_POST['txtPresentBlock'] : '';
				
				//if permanent is same as present
				$txtPermanentPanchayat = isset($_POST['txtPermanentPanchayat']) ? $_POST['txtPermanentPanchayat'] : '';
				$txtPermanentBlock = isset($_POST['txtPermanentBlock']) ? $_POST['txtPermanentBlock'] : '';
				
				$chksameasresidential = isset($_POST['chksameasresidential']) ? $_POST['chksameasresidential']:'N';
				$txtPermenentAddress = isset($_POST['hidPermenentAddress']) ? trim($_POST['hidPermenentAddress']) : '';
				$txtPermenentLocality = isset($_POST['txtPermenentLocality']) ? trim($_POST['txtPermenentLocality']) : '';
				$txtPermanentPost = isset($_POST['txtPermanentPost']) ? trim($_POST['txtPermanentPost']) : 'PKD';
				$txtPermanentDist = isset($_POST['cmbPermanentDist']) ? trim($_POST['cmbPermanentDist']) : '';
				$txtPermanentState = isset($_POST['cmbPermanentState']) ?  trim($_POST['cmbPermanentState']) : '';
				$txtPermanentPin = isset($_POST['txtPermanentPin']) ? trim($_POST['txtPermanentPin']) : '761200';
				$txtPermanentMobile = isset($_POST['txtPermanentMobile']) ? trim($_POST['txtPermanentMobile']) : '';
				$txtUid = isset($_POST['txtUid']) ? trim($_POST['txtUid']) : '';
				$empsuspended = isset($_POST['empsuspended']) ? trim($_POST['empsuspended']) : '';
				$empsuspendedinfo = isset($_POST['empsuspendedinfo']) ? trim($_POST['empsuspendedinfo']) : '';
				$empDisciplinary = isset($_POST['empDisciplinary']) ? trim($_POST['empDisciplinary']) : '';
				$empDisciplinaryInfo = isset($_POST['empDisciplinaryInfo']) ? trim($_POST['empDisciplinaryInfo']) : '';
				
				
				$technical_5_1 = isset($_POST['txtTechnical_5_1']) ? trim($_POST['txtTechnical_5_1']) : ''; //course
				$technical_5_2 = isset($_POST['txtTechnical_5_2']) && $_POST['txtTechnical_5_2'] != '' ? trim($_POST['txtTechnical_5_2']) : 'NULL'; //institute
				$technical_5_3 = isset($_POST['txtTechnical_5_3']) ? trim($_POST['txtTechnical_5_3']) : ''; //affiliation
				$technical_5_4 = isset($_POST['txtTechnical_5_4']) ? trim($_POST['txtTechnical_5_4']) : ''; //duration
				
				$technical_6_1 = isset($_POST['txtTechnical_6_1']) ? trim($_POST['txtTechnical_6_1']) : ''; //course
				$technical_6_2 = isset($_POST['txtTechnical_6_2']) && $_POST['txtTechnical_6_2'] != '' ? trim($_POST['txtTechnical_6_2']) : 'NULL'; //institute
				$technical_6_3 = isset($_POST['txtTechnical_6_3']) ? trim($_POST['txtTechnical_6_3']) : ''; //affiliation
				$technical_6_4 = isset($_POST['txtTechnical_6_4']) ? trim($_POST['txtTechnical_6_4']) : ''; //duration
				
				$technical_7_1 = isset($_POST['txtTechnical_7_1']) ? trim($_POST['txtTechnical_7_1']) : ''; //course
				$technical_7_2 = isset($_POST['txtTechnical_7_2']) && $_POST['txtTechnical_7_2'] != '' ? trim($_POST['txtTechnical_7_2']) : 'NULL'; //institute
				$technical_7_3 = isset($_POST['txtTechnical_7_3']) ? trim($_POST['txtTechnical_7_3']) : ''; //affiliation
				$technical_7_4 = isset($_POST['txtTechnical_7_4']) ? trim($_POST['txtTechnical_7_4']) : ''; //duration
				
				
				$txtExamName1 = isset($_POST['txtExamName1']) ? $_POST['txtExamName1'] : '';
				$txtStream1 = isset($_POST['txtStream1']) ? $_POST['txtStream1'] : '';
				$txtYearQual1 = isset($_POST['txtYearQual1']) ? $_POST['txtYearQual1'] : '';
				$txtBoardOth1 = isset($_POST['txtBoardOth1']) ? $_POST['txtBoardOth1'] : '';
				$txtSub1 = isset($_POST['txtSub1']) ? $_POST['txtSub1'] : '';
				$txtCGPA1 = isset($_POST['txtCGPA1']) ? $_POST['txtCGPA1'] : '';
				
				$txtExamName2 = isset($_POST['txtExamName2']) ? $_POST['txtExamName2'] : '';
				$txtStream2 = isset($_POST['txtStream2']) ? $_POST['txtStream2'] : '';
				$txtYearQual2 = isset($_POST['txtYearQual2']) ? $_POST['txtYearQual2'] : '';
				$txtBoardOth2 = isset($_POST['txtBoardOth2']) ? $_POST['txtBoardOth2'] : '';
				$txtSub2 = isset($_POST['txtSub2']) ? $_POST['txtSub2'] : '';
				$txtCGPA2 = isset($_POST['txtCGPA2']) ? $_POST['txtCGPA2'] : '';

					
				$txtApplicantEmail = isset($_POST['txtemailid']) ? trim($_POST['txtemailid']) : '';
				/*echo $txtApplicantEmail;
				die();*/
				
				$MothersName = isset($_POST['txtMotherName']) ? trim($_POST['txtMotherName']) : '';
				$cmbHomeDist = isset($_POST['cmbHomeDist']) ? trim($_POST['cmbHomeDist']) : '';
				$radioSports = isset($_POST['radioSports']) ? trim($_POST['radioSports']) : '';
				$radioService = isset($_POST['radioService']) ? trim($_POST['radioService']) : '';
				$radioResident = isset($_POST['radioResident']) ? trim($_POST['radioResident']) : '';
				$is_employed = isset($_POST['empGovt']) ? $_POST['empGovt'] : '';
				$chkInformed = isset($_POST['chkInformed']) ? $_POST['chkInformed'] : '';
				$txtNameOfOffice = isset($_POST['txtNameOfOffice']) ? $_POST['txtNameOfOffice'] : '';
				$txtDOJ = isset($_POST['txtDOJ']) ? $_POST['txtDOJ'] : '';
				$txtNameOfPost = isset($_POST['txtNameOfPost']) ? trim($_POST['txtNameOfPost']) : '';
				$txtDateOfDebar = isset($_POST['txtDateOfDebar']) ? trim($_POST['txtDateOfDebar']) : '';
				$txtPeriodOfDebar = isset($_POST['txtPeriodOfDebar']) ? trim($_POST['txtPeriodOfDebar']) : '';
				
				$txtDOJ = date("Y-m-d", strtotime($txtDOJ));
				$txtDateOfDebar = date("Y-m-d", strtotime($txtDateOfDebar));
				/*ECHO $is_employed;
				ECHO $txtNameOfOffice;
				DIE();*/
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
				$program_code_arr = explode('_',$program_code);
				$institute_code = $program_code_arr[1];
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.qualification_code, B.qualification_name, B.division");
				$this->db->from('program_qualification_setup A');
				$this->db->join('qualification_master B','A.qualification_code = B.qualification_code','inner');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.record_status',1);
				$this->db->where('B.record_status',1);
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
					${'txtYear'.$slno} = isset($_POST['txtYear'.$slno]) && trim($_POST['txtYear'.$slno]) != '' ? (int) trim($_POST['txtYear'.$slno]) : null;
					${'txtBoard'.$slno} = isset($_POST['txtBoard'.$slno]) && $_POST['txtBoard'.$slno] != '' ? $_POST['txtBoard'.$slno] : '';
					${'txtDivision'.$slno} = isset($_POST['txtDivision'.$slno]) && $_POST['txtDivision'.$slno] != '' ? $_POST['txtDivision'.$slno] : 'NULL';
					${'txtMS'.$slno} = isset($_POST['txtMS'.$slno]) && $_POST['txtMS'.$slno] != '' ? $_POST['txtMS'.$slno] : '';
					${'txtFM'.$slno} = isset($_POST['txtFM'.$slno]) && $_POST['txtFM'.$slno] != '' ? $_POST['txtFM'.$slno] : '';
					${'txtPercent'.$slno} = isset($_POST['txtPercent'.$slno]) && $_POST['txtPercent'.$slno] != '' ? $_POST['txtPercent'.$slno] : null;
					${'txtsubject'.$slno} = isset($_POST['txtsubject'.$slno]) && $_POST['txtsubject'.$slno] != '' ? $_POST['txtsubject'.$slno] : '';
					${'txtdistinct'.$slno} = isset($_POST['txtdistinct'.$slno]) && $_POST['txtdistinct'.$slno] != '' ? $_POST['txtdistinct'.$slno] : null;
					${'txtgrading'.$slno} = isset($_POST['txtgrading'.$slno]) && $_POST['txtgrading'.$slno] != '' ? $_POST['txtgrading'.$slno] : '';
					${'txtqual2'.$slno} = isset($_POST['txtqual2'.$slno]) && $_POST['txtqual2'.$slno] != '' ? $_POST['txtqual2'.$slno] : '';
					${'txtOther_grad'.$slno} = isset($_POST['txtOther_grad'.$slno]) && $_POST['txtOther_grad'.$slno] != '' ? $_POST['txtOther_grad'.$slno] : '';
					$slno++;
					//echo $_POST['txtQualification'.$slno];
				}
				$txtQualification3 = isset($_POST['txtQualification3']) && $_POST['txtQualification3'] != '' ? $_POST['txtQualification3'] : '';
				$txtYear3 = isset($_POST['txtYear3']) && trim($_POST['txtYear3']) != '' ? (int) trim($_POST['txtYear3']) : null;
				$txtBoard3 = isset($_POST['txtBoard3']) && $_POST['txtBoard3'] != '' ? $_POST['txtBoard3'] : '';
				$txtDivision3 = isset($_POST['txtDivision3']) && $_POST['txtDivision3'] != '' ? $_POST['txtDivision3'] : null;
				$txtMS3 = isset($_POST['txtMS3']) && $_POST['txtMS3'] != '' ? $_POST['txtMS3'] : '';
				$txtFM3 = isset($_POST['txtFM3']) && $_POST['txtFM3'] != '' ? $_POST['txtFM3'] : '';
				$txtPercent3 = isset($_POST['txtPercent3']) && $_POST['txtPercent3'] != '' ? $_POST['txtPercent3'] : null;
				//Entrance exam appeared
				  
				$txtQualification4 = isset($_POST['txtQualification4']) && $_POST['txtQualification4'] != '' ? $_POST['txtQualification4'] : '';
				$txtYear4 = isset($_POST['txtYear4']) && trim($_POST['txtYear4']) != '' ? (int) trim($_POST['txtYear4']) : null;
				$txtBoard4 = isset($_POST['txtBoard4']) && $_POST['txtBoard4'] != '' ? $_POST['txtBoard4'] : '';
				$txtDivision4 = isset($_POST['txtDivision4']) && $_POST['txtDivision4'] != '' ? $_POST['txtDivision4'] : null;
				$txtMS4 = isset($_POST['txtMS4']) && $_POST['txtMS4'] != '' ? $_POST['txtMS4'] : '';
				$txtFM4 = isset($_POST['txtFM4']) && $_POST['txtFM4'] != '' ? $_POST['txtFM4'] : '';
				$txtPercent4 = isset($_POST['txtPercent4']) && $_POST['txtPercent4'] != '' ? $_POST['txtPercent4'] : null;
				$txtOther_grad = isset($_POST['txtOther_grad']) && $_POST['txtOther_grad'] != '' ? $_POST['txtOther_grad'] : '';
				
				$txtQualification5 = isset($_POST['txtQualification5']) && $_POST['txtQualification5'] != '' ? $_POST['txtQualification5'] : '';
				$txtYear5 = isset($_POST['txtYear5']) && trim($_POST['txtYear5']) != '' ? (int) trim($_POST['txtYear5']) : null;
				$txtBoard5 = isset($_POST['txtBoard5']) && $_POST['txtBoard5'] != '' ? $_POST['txtBoard5'] : '';
				$txtDivision5 = isset($_POST['txtDivision5']) && $_POST['txtDivision5'] != '' ? $_POST['txtDivision5'] : null;
				$txtMS5 = isset($_POST['txtMS5']) && $_POST['txtMS5'] != '' ? $_POST['txtMS5'] : '';
				$txtFM5 = isset($_POST['txtFM5']) && $_POST['txtFM5'] != '' ? $_POST['txtFM5'] : '';
				$txtPercent5 = isset($_POST['txtPercent5']) && $_POST['txtPercent5'] != '' ? $_POST['txtPercent5'] : null;
				  
				//
				
				$radioExam = isset($_POST['radioExam']) ? $_POST['radioExam'] : '';
				$radioMarkSheet = isset($_POST['radioMarkSheet']) ? $_POST['radioMarkSheet'] : '';
				$pay_mode = isset($_POST['mode']) ? $_POST['mode'] : '';
				$radioGradCert = isset($_POST['radioGradCert']) ? $_POST['radioGradCert'] : 'No';
				$radioGradMarkSheet = isset($_POST['radioGradMarkSheet']) ? $_POST['radioGradMarkSheet'] : 'No';
				$hidDate = isset($_POST['hidDate']) ? $_POST['hidDate'] : '';
				$txtExamMark = isset($_POST['txtExamMark']) && trim($_POST['txtExamMark']) != '' ? (float) trim($_POST['txtExamMark']) : 'NULL';
				$txtfinalpercentage = isset($_POST['txtfinalpercentage']) && trim($_POST['txtfinalpercentage']) != '' ? (float) trim($_POST['txtfinalpercentage']) : 'NULL';
				//$chkMAT = isset($_POST['chkMAT']) ? mysqli_real_escape_string($con, trim($_POST['chkMAT'])) : '';
				//$chkIACR = isset($_POST['chkIACR']) ? mysqli_real_escape_string($con, trim($_POST['chkIACR'])) : '';
				//$chkUU = isset($_POST['chkUU']) ? mysqli_real_escape_string($con, trim($_POST['chkUU'])) : '';
				$radioSports = isset($_POST['radioSports']) ? trim($_POST['radioSports']) : '';
				$radioService = isset($_POST['radioService']) ? trim($_POST['radioService']) : '';
				$radioResident = isset($_POST['radioResident']) ? trim($_POST['radioResident']) : '';
				//$is_employed = isset($_POST['empGovt']) ? $_POST['empGovt'] : '';
				$cmbReservedCategory = isset($_POST['cmbCommunity']) ? $_POST['cmbCommunity'] : '';
				$cmbDcOffice = isset($_POST['cmbDcOffice']) ? $_POST['cmbDcOffice'] : '';
				$radioComputer = isset($_POST['radioComputer']) ?  trim($_POST['radioComputer']) : '';
				//$cmbPostSelect = $_POST['cmbPostSelect'];
				//declaration
				$chkUndertaking1 = 1;
				$chkUndertaking2 = 2;
				$chkUndertaking3 = 3;
				$declaration1 = "I declare that the particulars furnished in this form are true to the best of my knowledge and belief and as per my certificates and valid official documents. I further declare that in case any of the above information is found to be incorrect at any time, I shall be liable to forfeit my seat and to such penal action as the University may deem appropriate.";
				$declaration2 = "I undertake to abide by the rules of the P.G. Council and P.G. Hostels, framed by the Berhampur University and if at any time, in any instance of breach of these rules, indiscipline, disobedience or misconduct or involvement in ragging is found against me, my name shall be struck off from the rolls of the University. ";
				$declaration3 = "I have understood the various provisions and rules of eligibility and admission to various P.G. Departments of Berhampur University as mentioned in the Prospectus along with the application form and I undertake to abide by any decision taken by the University authorities in regard to my eligibility and admission into P.G. Departments.";
				$chkApplicantUndertaking = isset($_POST['chkApplicantUndertaking']) ? mysqli_real_escape_string($con, trim($_POST['chkApplicantUndertaking'])) : '';
				$now = date("Y-m-d H:i:s");
				$this->db->save_queries = TRUE;
				$this->db->select("count(*) AS cnt");
				$this->db->from('applicant_appl_overview');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				echo "hiiiiiiiii";
				die();*/
				if($radioPhysicallY == 'NO')
				{
					$txtphtype='';
				}
				foreach($result->result_array() as $appl)
				{
					$count = $appl['cnt'];
				}
				if($count >= 1)
				{
					$this->session->set_userdata('mode', 'edit');
				}
				else
				{
					$this->session->set_userdata('mode', 'new');
				}
				$mode = $this->session->userdata('mode');
				$fee = 0;
				$this->db->select("amount");
				$this->db->from('program_fee_setup');
				$this->db->where('program_code',$program_code);
				$this->db->where('category_code',$cmbReservedCategory);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				foreach($result->result_array() as $row)
				{
					$fee = $row['amount'];
				}
				
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program_code);
				$update_applicant_relation2 = $this->db->delete('applicant_qual_temp');
				if(!$update_applicant_relation2)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error deleting applicant_qual_temp';
				}
				
				
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('program_code',$program_code);
				$update_applicant_relation2 = $this->db->delete('applicant_details_temp');
				if(!$update_applicant_relation2)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error deleting applicant_details_temp';
				}
				
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program_code);
				$update_applicant_relation2 = $this->db->delete('applicant_tech_qual_temp');
				if(!$update_applicant_relation2)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error deleting applicant_tech_qual_temp';
				}
				$this->db->select("A.email_id");
				$this->db->from('applicant_reg_master A');
				$this->db->where('A.reg_user_id',$reg_user_id);
				$result = $this->db->get();
				$get_data = $result->result_array();
				foreach($get_data as $row)
				{
					$txtApplicantEmail = $row['email_id'];
				}
				
				//echo $mode;die();
				if($mode == 'edit')
				{
					$this->db->trans_start();
					$dbStatus = TRUE;
					$dbmessage = 'Data saved successfully';
					$extra_fee = '0';
					$count_appl = '0';
					$this->db->select("count(*) AS cnt,appl_no");
					$this->db->from('applicant_appl_overview');
					$this->db->where('applied_program',$program_code);
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->group_by('appl_no');
					$result = $this->db->get();
					//ECHO $this->db->last_query();die();
					foreach($result->result_array() as $appl)
					{
						$count_appl = $appl['cnt'];
						$appl_no = $appl['appl_no'];
					}
					if($count_appl >= 1)
					{
						$paid_fee = 0;
						$cnt_paid_fee = 0;
						$this->db->select("count(*) as cnt,amount");
						$this->db->from('applicant_form_fee_overview');
						$this->db->where('appl_no',$appl_no);
						$this->db->group_by('appl_no');
						$result = $this->db->get();
						foreach($result->result_array() as $row)
						{
							$cnt_paid_fee = $row['cnt'];
							$paid_fee = $row['amount'];
						}
						if($cnt_paid_fee > 0)
						{
							if($fee > $paid_fee)
							{
								$extra_fee = $fee - $paid_fee;
							}
						}
						
					}
					
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
						// District code
				$this->db->select("district_code");
				$this->db->from('district_master');
				$this->db->where('district_name',$cmbPresentDist);
				$result = $this->db->get();
				$cmbPresentDist= $result->result_array();
				foreach($cmbPresentDist as $row)
				{
					$cmbPresentDist=$row['district_code'];
				}
				$this->db->select("district_code");
				$this->db->from('district_master');
				$this->db->where('district_name',$cmbPermanentDist);
				$result = $this->db->get();
				$cmbPermanentDist= $result->result_array();
				foreach($cmbPermanentDist as $row)
				{
					$cmbPermanentDist=$row['district_code'];
				}

				$this->db->select("state_code");
				$this->db->from('state_master');
				$this->db->where('state_name',$cmbPresentState);
				$result = $this->db->get();
				$cmbPresentState= $result->result_array();
				foreach($cmbPresentState as $row)
				{
					$cmbPresentState=$row['state_code'];
				}

				$this->db->select("state_code");
				$this->db->from('state_master');
				$this->db->where('state_name',$cmbPermanentState);
				$result = $this->db->get();
				$cmbPermanentState= $result->result_array();
				foreach($cmbPermanentState as $row)
				{
					$cmbPermanentState=$row['state_code'];
				}
					if($chksameasresidential == $sameaspresent && $chksameasresidential=='Y')
					{
						$applicant_address_array = array(
							'address_1' => $txtPresentLocality,
							'post_office' => $txtPresentPost,
							'panchayat' => $txtPresentPanchayat,
							'block' => $txtPresentBlock,
							'district_code' => $cmbPresentDist,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'cand_name'=>$cand_name, 
							'co_name'=>$co_name,
							'city_name'=>$city_name, 
							'institute_code'=>$institute_code, 
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant_address = $this->db->update('applicant_address',$applicant_address_array);
						if(!$update_applicant_address){
							$dbStatus = FALSE;
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
							'panchayat' => $txtPresentPanchayat,
							'block' => $txtPresentBlock,
							'pin' => $txtPresentPin,
							'cand_name'=>$cand_name, 
							'co_name'=>$co_name,
							'city_name'=>$city_name, 
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant_address = $this->db->update('applicant_address',$applicant_address_array1);
						if(!$update_applicant_address){
							$dbStatus = FALSE;
							$dbmessage = 'Error updating applicant_address_present';
						}
						$applicant_address_array2 = array(
							'address_1' => $txtPermenentLocality,
							'post_office' => $txtPermanentPost,
							'district_code' => $txtPermanentDist,
							'state_code' => $txtPermanentState,
							'panchayat' => $txtPermanentPanchayat,
							'block' => $txtPermanentBlock,
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
							$dbStatus = FALSE;
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
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant = $this->db->update('applicant_address',$applicant_address_array3);
						if(!$update_applicant){
							$dbStatus = FALSE;
							$dbmessage = 'Error updating applicant_address_present';
						}
						$perm_address_ref_id=$comm_address_ref_id;
					}
					else if($chksameasresidential != $sameaspresent && $chksameasresidential=='N')
					{
						$applicant_address_array4 = array(
							'address_1' => $txtPresentLocality,
							'post_office' => $txtPresentPost,
							'panchayat' => $txtPresentPanchayat,
							'block' => $txtPresentBlock,
							'district_code' => $cmbPresentDist,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'cand_name'=>$cand_name, 
							'co_name'=>$co_name,
							'city_name'=>$city_name, 
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant = $this->db->update('applicant_address',$applicant_address_array4);
						if(!$update_applicant){
							$dbStatus = FALSE;
							$dbmessage = 'Error updating applicant_address_present';
						}else{
							$applicant_address_array2 = array(
								'address_1' => $txtPermenentLocality,
								'post_office' => $txtPermanentPost,
								'district_code' => $txtPermanentDist,
								'panchayat' => $txtPermanentPanchayat,
								'block' => $txtPermanentBlock,
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
				/*ECHO $dob;
				DIE();*/
					
					$applicant_master_update_array = array(
						'first_name' => $txtFirstName,
						'mid_name' => $txtMiddleName,
						'last_name' => $txtLastName,
						'full_name' => $fullname,
						'exam_center_code' => $center_name1,
						'exam_center_code1' => $center_name2,
						'exam_center_code2' => $center_name3,
						'dob' => $dob,
						'gender' => $radiogender,
						'id_proof' => $cmbidproof,
						'id_proof_number' => $txtidproof,
						'jee_place' => $radioJEE,
						'nationality' => $cmbNationality,
						'cmbrelationship' => $cmbrelationship,
						'adhar_no' => $txtUid,
						'dob_in_word' => $hidDate,
						'category' => $cmbReservedCategory,
						'dc_office' => $cmbDcOffice,
						'phtype'=>$txtphtype,
						'is_computer_education'=>$radioComputer,
						'is_minority_community' => $radioMinority,
						'is_passed' => $radioMarkSheet,
						'payment_mode' => $pay_mode,
						'grad_cert' => $radioGradCert,
						'grad_mark_sheet' => $radioGradMarkSheet,
						'minority_community_details' => $cmbCommunity,
						
						'is_north_east' => $radiobelong,
						'father_occupation' => $txtOccupation,
						'annual_parent_income' => $txtIncome,
						'indicate_choice' => $txtIndicate,
						'know_about_cipet' => $txtKnowabout,
						'physically_challenged' => $radioPhysicallY ,
						'is_suspended' => $empsuspended ,
						'any_disciplinary_action' => $empDisciplinary ,
						'marital_status'			=> $radiomaritalstatus,
						'district_code'				=> $txtHomeDist,
						'disability_percent'		=> $txtPHPercent,
							
						'religion' => $cmbReligion,
						'applicant_email' => $txtApplicantEmail,
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
						
						
						
						'ap_resident'=>$radioResident,
						'is_sports'=>$radioSports,
						'is_ex_serviceman'=>$radioService,
						'is_employed'=>$is_employed,
						'informed_govt'=> $chkInformed,
						'name_of_office'=>$txtNameOfOffice,
						'govt_doj'=>$txtDOJ,
						'name_of_post' => $txtNameOfPost,
						'date_of_debar' => $txtDateOfDebar,
						'period_of_debar' => $txtPeriodOfDebar,
						
						'father_occupation'=>$FathersProfession, 
						'annual_parent_income'=>$FathersIncome,
						'north_east_state'=>$cmbNorthState, 

						'mothers_profession'=>$MothersProfession, 
						'mothers_income'=>$MothersIncome,
						'mothers_name'=>$txtMotherName,
						'father_name'=>$txtFatherName,
						'fathers_adhar_no'=>$fathers_adhar_no,
						'mothers_adhar_no'=>$mothers_adhar_no,
						'relevantinfo' => $relevantinfo,
						'suspendedInfo' => $empsuspendedinfo,
						'disciplinaryInfo' => $empDisciplinaryInfo,
						'enclosuresdetails' => $enclosuresdetails,

						'employer_add'=>$Employer_address,
						'employer_from'=>$Employer_from,
						'employer_to'=>$Employer_to,
						'employer_add1'=>$Employer_address1, 
						'employer_from1'=>$Employer_from1,
						'employer_to1'=>$Employer_to1, 
						'completion_date'=>$completion_date, 
						
						'fee'=>$fee, 
						'extra_fee'=>$extra_fee, 
						'comm_address_ref_id'=>$comm_address_ref_id,
						'perm_address_ref_id'=>$perm_address_ref_id,
						'is_computer_education'		=>$radioComputerEducation,
						'other_computer'			=>$txtOtherComp,
						'is_computer_type'			=>$radioComputerType
						);
						$this->db->where('reg_user_id' , $reg_user_id);
						$this->db->where('applied_program',$program_code);
						$query = $this->db->update('applicant_master',$applicant_master_update_array);
						/*echo $this->db->last_query();
						die();*/
						if(!$query)
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
								'id_proof' => $cmbidproof,
								'id_proof_number' => $txtidproof,
								'jee_place' => $radioJEE,
								'nationality' => $cmbNationality,
								'cmbrelationship' => $cmbrelationship,
								'dob' => $dob,
								'adhar_no' => $txtUid,
								'dob_in_word' => $hidDate,
								'category' => $cmbReservedCategory,
								'phtype'=>$txtphtype,
								
								'father_name'=>$txtFatherName,
								'is_minority_community' => $radioMinority,
								'is_passed' => $radioMarkSheet,
								'payment_mode' => $pay_mode,
								'grad_mark_sheet' => $radioGradMarkSheet,
								'minority_community_details' => $cmbCommunity,
								
								'is_north_east' => $radiobelong,
								'father_occupation' => $txtOccupation,
								'annual_parent_income' => $txtIncome,
								'indicate_choice' => $txtIndicate,
								'know_about_cipet' => $txtKnowabout,
								'physically_challenged' => $radioPhysicallY ,
								'last_year_mark' => $txtfinalpercentage,
								
								'religion' => $cmbReligion,
								'applicant_email' => $txtApplicantEmail,
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
								'relevantinfo' => $relevantinfo,
								'enclosuresdetails' => $enclosuresdetails,
								'father_occupation'=>$FathersProfession, 
							'annual_parent_income'=>$FathersIncome,
							'north_east_state'=>$cmbNorthState, 
							'mothers_profession'=>$MothersProfession, 
							'mothers_income'=>$MothersIncome,
							'mothers_name'=>$txtMotherName,
							'fathers_adhar_no'=>$fathers_adhar_no,
							'mothers_adhar_no'=>$mothers_adhar_no,

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
						$dbStatus = FALSE;
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
						$dbStatus = FALSE;
						$dbmessage = 'Error updating applicant_relation_2';
					}
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$update_applicant_relation2 = $this->db->delete('applicant_qualification_detail');
					//echo $this->db->last_query();
					if(!$update_applicant_relation2)
					{
						$dbStatus = FALSE;
						$dbmessage = 'Error deleting applicant_qualification_detail';
					}
					
					$slno = 1;
					/*echo $txtQualification3;
					die();*/
					foreach($allQualifications as $row)
					{
						
							$update_applicant_qualification_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'qual_desc_1' => ${'txtQualification'.$slno},
								'other_stream' => ${'txtOther_grad'.$slno},
								'year_of_passing' => ${'txtYear'.$slno},
								'university_board' => ${'txtBoard'.$slno},
								'mark_secured' => ${'txtMS'.$slno},
								'full_mark' => ${'txtFM'.$slno},
								'percentage_mark' => ${'txtPercent'.$slno},
								'division_distinction' => ${'txtdistinct'.$slno},
								'grade' => ${'txtgrading'.$slno},
								'qual_desc_2' => ${'txtqual2'.$slno},
								'created_by' => $reg_user_id,
								'created_on' => $now
							);
							
							
							$this->db->insert('applicant_qualification_detail',$update_applicant_qualification_array);
							/*echo $this->db->last_query();
							die();*/
							$slno++;
						/*}*/ 
					}
					
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$update_applicant_technical_qualification_detail = $this->db->delete('applicant_technical_qualification_detail');
					//echo $this->db->last_query();
					if(!$update_applicant_technical_qualification_detail)
					{
						$dbStatus = FALSE;
						$dbmessage = 'Error deleting applicant_technical_qualification_detail';
					}
					
					//14. Technical qualifiation2
					if($txtExamName1 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $txtExamName1,
							'year' => $txtYearQual1,
							'stream' => $txtStream1,
							'affiliation_from' => $txtBoardOth1,
							'subjects_offered' => $txtSub1,
							'grade_cgpa' => $txtCGPA1,
							'division' => $txtDiv1,
							'remark' => $txtGradingOth1,
							'sl_no' => '5',
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 5';
						}
						
					}
					//14. Technical qualifiation3
					if($txtExamName2 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $txtExamName2,
							'year' => $txtYearQual2,
							'stream' => $txtStream2,
							'affiliation_from' => $txtBoardOth2,
							'subjects_offered' => $txtSub2,
							'grade_cgpa' => $txtCGPA2,
							'division' => $txtDiv2,
							'remark' => $txtGradingOth2,
							'sl_no' => '6',
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 6';
						}
					}
					
						
						if($dbStatus == TRUE)
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
									$dbStatus = FALSE;
									$dbmessage = 'Error updating applicant_document_list';
								}
								
							}
							
							if($extra_fee != 0){
								$appl_overview = array(
									'appl_status'=>'Document Uploaded'
								);
								$this->db->where('appl_no',$appl_no);
								$this->db->where('applied_program',$program_code);
								$update_appl_overview = $this->db->update('applicant_appl_overview',$appl_overview);
								if(!$update_appl_overview)
								{
									$dbstatus = FALSE;
									$dbmessage = 'Error updating applicant_appl_overview';
								}
							}
/*
							$this->db->select("A.document_type_code");
							$this->db->from('program_document_setup A');
							$this->db->join('course_document_setup B',"A.program_code = B.program_code  AND B.course_code IN('$cmbPostSelect') 
											AND A.document_type_code = B.document_type_code",'LEFT');
							$this->db->where_in('course_code',$cmbPostSelect);
							$this->db->where('program_code',$program_code);
							$this->db->where_not_in("A.document_type_code", $where_clause);
							$this->db->where('record_status',1);
							$result = $this->db->get();
							*/
							//$course_code = implode("','",$cmbPostSelect);
							$query = $this->db->query("SELECT A.document_type_code,B.category_code
															FROM `program_document_setup` `A`
															LEFT JOIN `course_document_setup` `B` ON `A`.`program_code` = `B`.`program_code` 
																AND A.document_type_code = B.document_type_code
															WHERE A.`program_code` = '$program_code'
															AND A.`document_type_code` NOT IN (SELECT B.document_type_code FROM `course_document_setup` B 
																WHERE `B`.`program_code`  = '$program_code')
															AND (B.category_code IN ('$cmbReservedCategory') OR B.category_code IS NULL)
															AND A.`record_status` = 1");

							$documentsReq = $query->result_array();
							//$documentsReq = $result->result_array();
							//echo $this->db->last_query();die();
							
							
							//print_r($documentsReq);die();
							if($cmbReservedCategory == 'GEN' || $cmbReservedCategory == 'PH' ){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
							}
							if($radiobelong == 'NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DOMICILE');
							}
							if($radioPhysicallY == 'NO' || $cmbReservedCategory != 'PH'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'PHC');
							}
							if($radioGradCert == 'No'  || $radioMarkSheet == 'No'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HQC');
							}
							if($radioGradMarkSheet == 'No' || $radioMarkSheet == 'No'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HDMS');
							}
							if($radioID == 'No'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DL');
							}
							if($employed == 'NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'NOC');
							}
							if($pay_mode == 'Online'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CHALLAN');
							}
							if($cmbNationality == 'OTH'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
							}
							if($is_employed == 'NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT');
							}
							if($radioPhysicallY == 'NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'PWD');
							}
							
							//$documentsReq = array_merge($documentsReq, $documentsRequired); 
							//print_r($documentsReq);
							//print_r($documentsRequired);die();
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
										$dbStatus = FALSE;
										$dbmessage = 'Error updating applicant_document_list';
									}
								}
								else
								{
									$this->db->insert('applicant_document_list',$document_list_insert_array);
									if(!$update_applicant_relation2)
									{
										$dbStatus = FALSE;
										$dbmessage = 'Error updating applicant_document_list';
									}
								}
							}
							
							if($dbStatus == TRUE)
							{
								$this->db->trans_complete();
								$this->session->set_userdata('admcode', $program_code);
								$this->session->set_userdata('reg_user_id', $reg_user_id);
								$this->session->set_userdata('appl_no', $appl_no);
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
							'institute_code'=>$institute_code, 
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant_address = $this->db->update('applicant_address',$applicant_address_array);
						if(!$update_applicant_address){
							$dbStatus = FALSE;
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
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant_address = $this->db->update('applicant_address',$applicant_address_array1);
						if(!$update_applicant_address){
							$dbStatus = FALSE;
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
							$dbStatus = FALSE;
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
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant = $this->db->update('applicant_address',$applicant_address_array3);
						if(!$update_applicant){
							$dbStatus = FALSE;
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
							'mobile'=>$reg_user_id, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant = $this->db->update('applicant_address',$applicant_address_array4);
						if(!$update_applicant){
							$dbStatus = FALSE;
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
				/*ECHO $dob;
				DIE();*/
					
					$applicant_master_update_array = array(
						'first_name' => $txtFirstName,
						'mid_name' => $txtMiddleName,
						'last_name' => $txtLastName,
						'full_name' => $fullname,
						'exam_center_code' => $center_name1,
						'exam_center_code1' => $center_name2,
						'exam_center_code2' => $center_name3,
						'dob' => $dob,
						'gender' => $radiogender,
						'id_proof' => $cmbidproof,
						'id_proof_number' => $txtidproof,
						'jee_place' => $radioJEE,
						'nationality' => $cmbNationality,
						'cmbrelationship' => $cmbrelationship,
						'adhar_no' => $txtUid,
						'dob_in_word' => $hidDate,
						'category' => $cmbReservedCategory,
						'dc_office' => $cmbDcOffice,
						'phtype'=>$txtphtype,
						'is_computer_education'=>$radioComputer,
						'is_minority_community' => $radioMinority,
						'is_passed' => $radioMarkSheet,
						'payment_mode' => $pay_mode,
						'grad_cert' => $radioGradCert,
						'grad_mark_sheet' => $radioGradMarkSheet,
						'minority_community_details' => $cmbCommunity,
						
						'is_north_east' => $radiobelong,
						'father_occupation' => $txtOccupation,
						'annual_parent_income' => $txtIncome,
						'indicate_choice' => $txtIndicate,
						'know_about_cipet' => $txtKnowabout,
						'physically_challenged' => $radioPhysicallY ,
						'is_suspended' => $empsuspended ,
						'any_disciplinary_action' => $empDisciplinary ,
						
						'religion' => $cmbReligion,
						'applicant_email' => $txtApplicantEmail,
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
						
						
						'marital_status'			=> $radiomaritalstatus,
						'district_code'				=> $txtHomeDist,
						'disability_percent'		=> $txtPHPercent,
							
						'ap_resident'=>$radioResident,
						'is_sports'=>$radioSports,
						'is_ex_serviceman'=>$radioService,
						'is_employed'=>$is_employed,
						'informed_govt'=> $chkInformed,
						'name_of_office'=>$txtNameOfOffice,
						'govt_doj'=>$txtDOJ,
						'name_of_post' => $txtNameOfPost,
						'date_of_debar' => $txtDateOfDebar,
						'period_of_debar' => $txtPeriodOfDebar,
						
						'father_occupation'=>$FathersProfession, 
						'annual_parent_income'=>$FathersIncome,
						'north_east_state'=>$cmbNorthState, 

						'mothers_profession'=>$MothersProfession, 
						'mothers_income'=>$MothersIncome,
						'mothers_name'=>$txtMotherName,
						'father_name'=>$txtFatherName,
						'fathers_adhar_no'=>$fathers_adhar_no,
						'mothers_adhar_no'=>$mothers_adhar_no,
						'relevantinfo' => $relevantinfo,
						'suspendedInfo' => $empsuspendedinfo,
						'disciplinaryInfo' => $empDisciplinaryInfo,
						'enclosuresdetails' => $enclosuresdetails,

						'employer_add'=>$Employer_address,
						'employer_from'=>$Employer_from,
						'employer_to'=>$Employer_to,
						'employer_add1'=>$Employer_address1, 
						'employer_from1'=>$Employer_from1,
						'employer_to1'=>$Employer_to1, 
						'completion_date'=>$completion_date, 
						'comm_address_ref_id'=>$comm_address_ref_id,
						'fee'=>$fee, 
						'extra_fee'=>'0',
						'perm_address_ref_id'=>$perm_address_ref_id,
						'is_computer_education'		=>$radioComputerEducation,
						'other_computer'			=>$txtOtherComp,
						'is_computer_type'			=>$radioComputerType
						);
						$this->db->where('reg_user_id' , $reg_user_id);
						$this->db->where('applied_program',$program_code);
						$query = $this->db->update('applicant_master',$applicant_master_update_array);
						/*echo $this->db->last_query();
						die();*/
						if(!$query)
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
								'id_proof' => $cmbidproof,
								'id_proof_number' => $txtidproof,
								'jee_place' => $radioJEE,
								'nationality' => $cmbNationality,
								'cmbrelationship' => $cmbrelationship,
								'dob' => $dob,
								'adhar_no' => $txtUid,
								'dob_in_word' => $hidDate,
								'category' => $cmbReservedCategory,
								'phtype'=>$txtphtype,
								
								'father_name'=>$txtFatherName,
								'is_minority_community' => $radioMinority,
								'is_passed' => $radioMarkSheet,
								'payment_mode' => $pay_mode,
								'grad_mark_sheet' => $radioGradMarkSheet,
								'minority_community_details' => $cmbCommunity,
								
								'is_north_east' => $radiobelong,
								'father_occupation' => $txtOccupation,
								'annual_parent_income' => $txtIncome,
								'indicate_choice' => $txtIndicate,
								'know_about_cipet' => $txtKnowabout,
								'physically_challenged' => $radioPhysicallY ,
								'last_year_mark' => $txtfinalpercentage,
								
								'religion' => $cmbReligion,
								'applicant_email' => $txtApplicantEmail,
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
								'relevantinfo' => $relevantinfo,
								'enclosuresdetails' => $enclosuresdetails,
								'father_occupation'=>$FathersProfession, 
							'annual_parent_income'=>$FathersIncome,
							'north_east_state'=>$cmbNorthState, 
							'mothers_profession'=>$MothersProfession, 
							'mothers_income'=>$MothersIncome,
							'mothers_name'=>$txtMotherName,
							'fathers_adhar_no'=>$fathers_adhar_no,
							'mothers_adhar_no'=>$mothers_adhar_no,

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
						$dbStatus = FALSE;
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
						$dbStatus = FALSE;
						$dbmessage = 'Error updating applicant_relation_2';
					}
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$update_applicant_relation2 = $this->db->delete('applicant_qualification_detail');
					//echo $this->db->last_query();
					if(!$update_applicant_relation2)
					{
						$dbStatus = FALSE;
						$dbmessage = 'Error deleting applicant_qualification_detail';
					}
					
					$slno = 1;
					/*echo $txtQualification3;
					die();*/
					foreach($allQualifications as $row)
					{
						
							$update_applicant_qualification_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'qual_desc_1' => ${'txtQualification'.$slno},
								'other_stream' => ${'txtOther_grad'.$slno},
								'year_of_passing' => ${'txtYear'.$slno},
								'university_board' => ${'txtBoard'.$slno},
								'mark_secured' => ${'txtMS'.$slno},
								'full_mark' => ${'txtFM'.$slno},
								'percentage_mark' => ${'txtPercent'.$slno},
								'division_distinction' => ${'txtdistinct'.$slno},
								'grade' => ${'txtgrading'.$slno},
								'qual_desc_2' => ${'txtqual2'.$slno},
								'created_by' => $reg_user_id,
								'created_on' => $now
							);
							
							
							$this->db->insert('applicant_qualification_detail',$update_applicant_qualification_array);
							/*echo $this->db->last_query();
							die();*/
							$slno++;
						/*}*/ 
					}
					
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$update_applicant_technical_qualification_detail = $this->db->delete('applicant_technical_qualification_detail');
					//echo $this->db->last_query();
					if(!$update_applicant_technical_qualification_detail)
					{
						$dbStatus = FALSE;
						$dbmessage = 'Error deleting applicant_technical_qualification_detail';
					}
					
					//14. Technical qualifiation2
					if($txtExamName1 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $txtExamName1,
							'year' => $txtYearQual1,
							'stream' => $txtStream1,
							'affiliation_from' => $txtBoardOth1,
							'subjects_offered' => $txtSub1,
							'grade_cgpa' => $txtCGPA1,
							'division' => $txtDiv1,
							'remark' => $txtGradingOth1,
							'sl_no' => '5',
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 5';
						}
						
					}
					//14. Technical qualifiation3
					if($txtExamName2 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $txtExamName2,
							'year' => $txtYearQual2,
							'stream' => $txtStream2,
							'affiliation_from' => $txtBoardOth2,
							'subjects_offered' => $txtSub2,
							'grade_cgpa' => $txtCGPA2,
							'division' => $txtDiv2,
							'remark' => $txtGradingOth2,
							'sl_no' => '6',
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 6';
						}
					}
					if($technical_7_1 !='')
					{
						$applicant_technical_qualification_detail = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'qual_desc_1' => $technical_7_1,
							'year' => $technical_7_2,
							'institute_name' => $technical_7_3,
							'sl_no' => '7',
							'thesis' => $technical_7_4,
							'created_by' => $reg_user_id,
							'created_on' => $now
						);
						$history_applicant = $this->db->insert('applicant_technical_qualification_detail',$applicant_technical_qualification_detail);
						if(!$history_applicant){
							$dbStatus = FALSE;
							$dbMessage = 'ERROR updating Technical detail 7';
						}
					}
					
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$applicant_reference_detail = $this->db->delete('applicant_reference_detail');
					
					if(!$applicant_reference_detail)
					{
						$dbStatus = FALSE;
						$dbmessage = 'Error deleting applicant_reference_detail';
					}
					
					/*for($ref = 0 ;$ref< 2 ;$ref ++ ){
						$update_applicant_reference_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'referenced_by' => $_POST['refname'.$ref],
								'sl_no' => $ref,
								'contact_address' => $_POST['refaddress'.$ref],
								'email_id' => $_POST['refemail'.$ref],
								'mobile_number' => $_POST['refmobile'.$ref],
								'created_by' => $reg_user_id,
								'created_on' => $now
						);
						$this->db->insert('applicant_reference_detail',$update_applicant_reference_array);
						
						if($this->db->affected_rows() == 0)
						{
							$dbstatus = FALSE;
							$dbmessage = 'Error updating applicant_reference_detail';
						}
					}*/
					
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$applicant_research_experience_detaill = $this->db->delete('applicant_research_experience_detail');
					
					if(!$applicant_research_experience_detaill)
					{
						$dbStatus = FALSE;
						$dbmessage = 'Error deleting applicant_research_experience_detail';
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
							$split=explode("_",$program_code);
							$last_digit=substr($split[0], -3);
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
							
						$application_no = $last_digit.$year.$changed_sl_no;
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
							//$this->db->insert('applicant_appl_overview_history',$application_data);
							
							
							$this->db->where('program_code',$program_code);
							$this->db->update('program_master',$program_update_data);
							if($this->db->affected_rows() == 0)
							{
								$dbStatus = FALSE;
								$dbmessage = 'Error updating program';
							}
							//echo $this->db->last_query();
						}
						
						/*$this->db->select("document_type_code");
						$this->db->from('program_document_setup A');
						$this->db->join('course_document_setup B','A.program_code = B.program_code','LEFT');
						$this->db->where_in('course_code',$cmbPostSelect);
						$this->db->where('program_code',$program_code);
						$this->db->where('record_status',1);
						$result = $this->db->get();
						$documentsReq = $result->result_array();
						echo $this->db->last_query();die();*/
						//$course_code = implode("','",$cmbPostSelect);
							$query = $this->db->query("SELECT A.document_type_code,B.category_code
															FROM `program_document_setup` `A`
															LEFT JOIN `course_document_setup` `B` ON `A`.`program_code` = `B`.`program_code` 
																AND A.document_type_code = B.document_type_code
															WHERE A.`program_code` = '$program_code'
															AND A.`document_type_code` NOT IN (SELECT B.document_type_code FROM `course_document_setup` B 
																WHERE `B`.`program_code`  = '$program_code')
															AND (B.category_code IN ('$cmbReservedCategory') OR B.category_code IS NULL)
															AND A.`record_status` = 1");


						$documentsReq = $query->result_array();
						
						/*$this->db->select("document_type_code");
						$this->db->from('course_document_setup');
						$this->db->where('program_code',$program_code);
						$this->db->where_in('course_code',$cmbPostSelect);
						$this->db->where('record_status',1);
						$result = $this->db->get();
						//echo $this->db->last_query();die();
						$documentsRequired = $result->result_array();
						foreach($documentsReq as $row)
						{
							if(!in_array($row['document_type_code'],$documentsRequired) ){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', $row['document_type_code']);
							}
							
						}*/
						if($cmbReservedCategory == 'GEN' || $cmbReservedCategory == 'OBC' || $cmbReservedCategory == 'PH' ){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
						}
						if($radiobelong == 'NO'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DOMICILE');
						}
						if($radioPhysicallY == 'NO' || $cmbReservedCategory != 'PH'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'PHC');
						}
						if($radioGradCert == 'No'  || $radioMarkSheet == 'No'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HQC');
						}
						if($radioGradMarkSheet == 'No' || $radioMarkSheet == 'No'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'HDMS');
						}
						if($radioID == 'No'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DL');
						}
						if($employed == 'NO'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'NOC');
						}
						if($pay_mode == 'Online'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CHALLAN');
						}
						if($cmbNationality == 'OTH'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
						}
						if($is_employed == 'NO'){
							$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'EXPCERT');
						}
						if($radioPhysicallY == 'NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'PWD');
							}
						
						
						//$documentsReq = array_merge($documentsReq, $documentsRequired); 
						foreach($documentsReq AS $row1)
						{
							$document_list_insert_array = array(
								'record_status'=>1,
								'application_no'=>$application_no,
								'document_type_code'=>$row1['document_type_code']
							);
							$this->db->insert('applicant_document_list',$document_list_insert_array);
							if($this->db->affected_rows() == 0)
							{
								$dbStatus = FALSE;
								$dbmessage = 'Error updating applicant_document_list';
							}
						}
						/*echo $dbmessage;
						die();*/
						$page_url = $_SERVER["HTTP_REFERER"];
						$ip_address = $_SERVER['REMOTE_ADDR'];
						$log_status = $dbStatus;
						$log_message = $dbmessage;
						$this->log_detail_record($page_url, $log_status, $log_message, $ip_address);
						if($dbStatus == TRUE)
						{
							$this->db->trans_complete();
							$this->session->set_userdata('admcode', $program_code);
							$this->session->set_userdata('reg_user_id', $reg_user_id);
							$this->session->set_userdata('appl_no', $application_no);
							$this->session->set_userdata('mode', $mode);
							$this->session->set_userdata('step', 3);
							/*if( $this->db->trans_status() === FALSE){
								$dbStatus = FALSE;
								$dbmessage = 'Error While Saving';
							}*/
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
			
			case 'add_qual':
				
				$reg_user_id = $this->session->userdata('reg_user_id');
				$admcode = $this->session->userdata('admcode');
				$role = $this->session->userdata('role');
				//$admcode = $this->input->post('admcode');
				$appl_status = '';
				$this->db->select("appl_status");
				$this->db->from('applicant_appl_overview');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$admcode);
				$result = $this->db->get();
				$applicant_appl_overview = $result->result_array();
				foreach($applicant_appl_overview as $row){
					$appl_status = $row['appl_status'];
				}
				if($appl_status=='Verified'){
					$disable_status = 'disabled';
				}else{
					$disable_status = '';
				}
				
				$this->db->select("qual_desc_1,stream,year,affiliation_from,division,remark,grade_cgpa");
				$this->db->from('applicant_technical_qualification_detail ');
				$this->db->join('applicant_master', 'applicant_technical_qualification_detail.reg_user_id=applicant_master.reg_user_id and applicant_technical_qualification_detail.applied_program=applicant_master.applied_program  ','left');
				$this->db->where('applicant_master.reg_user_id',$reg_user_id);
				$this->db->where('applicant_master.applied_program',$admcode);
				//$this->db->where('applicant_work_experience_detail.sl_no','1');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$sl_no = 1;
				$i = 1;
				if($role == 'ADM')
				{
					$disable_status = '';
				}
				foreach($output_data as $aRow)
				{
					/*$row1[0] = $sl_no;
					$row1['sl_no'] = $sl_no;*/
					$i = 0;
					foreach ($aRow as $key=>$value) 
		            {
						if($key == 'qual_desc_1'){
							$row1[$i] = '<div class="col-md-12"><div class="form-group"><input type="text" class="form-control " maxlength="30" onkeypress=" return textvalidate(this.id)" id="txtExamName'.$sl_no.'" name="txtExamName[]" value="'.$value.'"'.$disable_status.'/></div></div>';
							$row1[$key] = $value;
						}
						else if($key == 'stream'){
							$row1[$i] = '<div class="col-md-12"><div class="form-group"><input type="text" class="form-control" maxlength="30" id="txtStream'.$sl_no.'" name="txtStream[]" value="'.$value.'"'.$disable_status.' /></div></div>';
							$row1[$key] = $value;
						}
						else if($key == 'year'){
							$row1[$i] = '<div class="col-md-12"><div class="form-group"><input type="text" class="form-control" maxlength="30" id="txtYearQual'.$sl_no.'" name="txtYearQual[]" value="'.$value.'"'.$disable_status.' /></div></div>';
							$row1[$key] = $value;
						}
						else if($key == 'affiliation_from'){
							$row1[$i] = '<div class="col-md-12"><div class="form-group"><input type="text" class="form-control" maxlength="30" id="txtBoardOth'.$sl_no.'" name="txtBoardOth[]" value="'.$value.'"'.$disable_status.' /></div></div>';
							$row1[$key] = $value;
						}
						else if($key == 'division'){
							$a = '';
							$b = '';
							$c = '';
							if($value == '1st') { $a = "selected";  }
							if($value == '2nd') { $b = "selected";  }
							if($value == '3rd') { $c = "selected";  }
							$row1[$i] = '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"><div class="form-group"><select class="form-control input-sm" name="txtDiv[]" id="txtDiv'.$sl_no.'">
																	<option value="">Select</option>
																	<option value="1st" '.$a.'>1st</option>
																	<option value="2nd"'.$b.'>2nd</option>
																	<option value="3rd"'.$c.'>3rd</option>
																</select>
							</div></div>';
							$row1[$key] = $value;
						}
						else if($key == 'remark'){
							$x = '';
							$y = '';
							if($value == 'CGPA') { $x = "selected";  }
							if($value == 'PERCENTAGE') { $y = "selected";  }
							$row1[$i] = '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"><div class="form-group"><select class="form-control input-sm" name="txtGradingOth[]" id="txtGradingOth'.$sl_no.'">
																	<option value="">Select</option>
																	<option value="CGPA" '.$x.'>CGPA</option>
																	<option value="PERCENTAGE"'.$y.'>PERCENTAGE</option>
																</select>
							</div></div>';
							$row1[$key] = $value;
						}	
						else if($key == 'grade_cgpa'){
							$row1[$i] = '<div class="col-md-12"><div class="form-group"><input type="text" class="form-control" maxlength="30" id="txtCGPA'.$sl_no.'" name="txtCGPA[]" value="'.$value.'"'.$disable_status.' /></div></div>';
							$row1[$key] = $value;
						}	
						
						/*$row1[$i] = 'remove';
						
				        $row1[$key] = 'ddd';*/
						//echo $i;
						$i++;
					}
					
					$output['aaData'][] = $row1;
					$sl_no++;
					unset($row1);
					
				}
	           	return $output;
	           	
			break;
			
			case 'add_table_research':
				
				$reg_user_id = $this->session->userdata('reg_user_id');
				$admcode = $this->session->userdata('admcode');
				$role = $this->session->userdata('role');
				//$admcode = $this->input->post('admcode');
				$appl_status = '';
				$this->db->select("appl_status");
				$this->db->from('applicant_appl_overview');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$admcode);
				$result = $this->db->get();
				$applicant_appl_overview = $result->result_array();
				foreach($applicant_appl_overview as $row){
					$appl_status = $row['appl_status'];
				}
				if($appl_status=='Verified'){
					$disable_status = 'disabled';
				}else{
					$disable_status = '';
				}
				
				$this->db->select("organization,post_held,date_format(date_from,'%d-%m-%Y') as from_date,
				date_format(date_to,'%d-%m-%Y') as to_date,duration,nature_of_job,pay_band,basic_pay,gross_salary");
				$this->db->from('applicant_work_experience_detail ');
				$this->db->join('applicant_master', 'applicant_work_experience_detail.reg_user_id=applicant_master.reg_user_id and applicant_work_experience_detail.applied_program=applicant_master.applied_program  ','left');
				$this->db->where('applicant_master.reg_user_id',$reg_user_id);
				$this->db->where('applicant_master.applied_program',$admcode);
				//$this->db->where('applicant_work_experience_detail.sl_no','1');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$sl_no = 1;
				$i = 1;
				//print_r($output_data);die();
				
				/*date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("organization,post_held,pay_band,basic_pay,date_from,date_to,nature_of_job");
				$this->db->from('applicant_research_experience_detail');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$admcode);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$sl_no = 1;
				$i = 1;*/
				if($role == 'ADM')
				{
					$disable_status = '';
				}
				foreach($output_data as $aRow)
				{
					/*$row1[0] = $sl_no;
					$row1['sl_no'] = $sl_no;*/
					$i = 0;
					foreach ($aRow as $key=>$value) 
		            {
						if($key == 'organization'){
							$row1[$i] = '<div class="col-md-12"><div class="form-group"><input type="text" class="form-control " maxlength="30" onkeypress=" return textvalidate(this.id)" id="txtorganization'.$sl_no.'" name="txtorganization[]" value="'.$value.'"'.$disable_status.'/></div></div>';
							$row1[$key] = $value;
						}
						else if($key == 'post_held'){
							$row1[$i] = '<div class="col-md-12"><div class="form-group"><input type="text" class="form-control" maxlength="30" id="txtpost_held'.$sl_no.'" name="txtpost_held[]" value="'.$value.'"'.$disable_status.' /></div></div>';
							$row1[$key] = $value;
						}
						else if($key == 'from_date'){
							$row1[$i] = '<div class="col-md-12"><div class="form-group"><input type="text" class="form-control date datepicker" readonly maxlength="30" id="txtdate_from'.$sl_no.'" name="txtdate_from[]" value="'.$value.'"'.$disable_status.' /></div></div>';
							$row1[$key] = $value;
						}
						else if($key == 'to_date'){
							$row1[$i] = '<div class="col-md-12"><div class="form-group"><input type="text" class="form-control date datepicker" readonly maxlength="30" id="txtdate_to'.$sl_no.'" name="txtdate_to[]" value="'.$value.'"'.$disable_status.' /></div></div>';
							$row1[$key] = $value;
						}
						else if($key == 'duration'){
							$row1[$i] = '<div class="col-md-12"><div class="form-group"><input type="text" class="form-control " readonly maxlength="30" id="txtduration'.$sl_no.'" name="txtduration[]" value="'.$value.'"'.$disable_status.' /></div></div>';
							$row1[$key] = $value;
						}
						else if($key == 'nature_of_job'){
							$row1[$i] = '<div class="col-md-12"><div class="form-group"><input type="text" class="form-control "  maxlength="30" id="txtnature_of_job'.$sl_no.'" name="txtnature_of_job[]" value="'.$value.'"'.$disable_status.' /></div></div>';
							$row1[$key] = $value;
						}
						else if($key == 'pay_band'){
							$row1[$i] = '<div class="col-md-12"><div class="form-group"><input type="text" class="form-control" maxlength="30" id="txtpay_band'.$sl_no.'" name="txtpay_band[]" value="'.$value.'"'.$disable_status.' /></div></div>';
							$row1[$key] = $value;
						}
						else if($key == 'basic_pay'){
							$row1[$i] = '<div class="col-md-12"><div class="form-group"><input type="text" class="form-control" maxlength="30" id="txtbasic_pay'.$sl_no.'" name="txtbasic_pay[]" value="'.$value.'"'.$disable_status.' /></div></div>';
							$row1[$key] = $value;
						}						
						else if($key == 'gross_salary'){
							$row1[$i] = '<div class="col-md-12"><div class="form-group"><input type="text" class="form-control" maxlength="30" id="txtgross'.$sl_no.'" name="txtgross[]" value="'.$value.'"'.$disable_status.' /></div></div>';
							$row1[$key] = $value;
						}
						
						/*$row1[$i] = 'remove';
						
				        $row1[$key] = 'ddd';*/
						//echo $i;
						$i++;
					}
					
					$output['aaData'][] = $row1;
					$sl_no++;
					unset($row1);
					
				}
	           	return $output;
	           	
			break;
				case 'preview_template002':
				/*ini_set('memory_limit', '-1');*/
				//echo 1;die();
				$program_code = $this->session->userdata('admcode');
				$program = $this->session->userdata('admcode');
				$seladmcode = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$now = date("d-m-Y h:i A");
				$today = date("d-m-Y");
				
				$declaration_array = array();
				
				$this->db->select("declaration");
				$this->db->from('program_declaration_data A');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.record_status',1);
				$result_decl = $this->db->get();
				foreach($result_decl->result_array() AS $row1)
				{
					$declaration_array[]=$row1;
				}
				
				$this->db->select('A.program_group,D.program_group_name,A.id,A.program_name,A.program_code,A.year,A.apply_start_date,A.apply_end_date,A.template_code,C.file_name,C.template_name');
				$this->db->from('program_master A');
				$this->db->join('form_template_master C','A.template_code = C.template_code','inner');
				$this->db->join('program_group_master D','A.program_group = D.program_group_code','inner');//lina V1
				$this->db->where('A.program_code',$program_code);
				$resultprog = $this->db->get();
				
				
				$program_detail = array();
				foreach($resultprog->result_array() AS $row1)
				{
					$program_detail[]=$row1;
				}
				
				
				
				$this->db->select('appl_no');
				$this->db->from('applicant_appl_overview aao');
				$this->db->where('applied_program',$seladmcode);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				$Result = $result->result_array();
				foreach($Result as $rrow){
					$applicantNumber = $rrow['appl_no'];
				}
				$this->session->set_userdata('appl_no',$applicantNumber);
				
				$this->db->select('photo.appl_no,photo.document_path AS passportphoto');
				$this->db->from('applicant_form_documents photo');
				$this->db->join('document_type_master doc', 'doc.document_type_code=photo.document_type', 'left');
				$this->db->where('photo.appl_no',$applicantNumber);
				$this->db->where('photo.document_type','PHO');
				$subQuery1 = $this->db->_compile_select();
				$this->db->_reset_select();
				
				$select =   array('photo.appl_no,photo.document_path AS SIGN');
				$this->db->select('photo.appl_no,photo.document_path AS SIGN');
				$this->db->from('applicant_form_documents photo');
				$this->db->join('document_type_master doc', 'doc.document_type_code=photo.document_type', 'left');
				$this->db->where('photo.appl_no',$applicantNumber);
				$this->db->where('photo.document_type','SIG');
				$subQuery2 = $this->db->_compile_select();
				$this->db->_reset_select();
				/*echo $this->db->last_query();
				die();*/
				
				// And now your main query

				$this->db->select('appmas.master_name,'.$reg_user_id.' as reg_user_id,appr.scrutiny_status,appr.scrutiny_remark,um.employee_name as scrutinised_by,date_format(appr.updated_on,"%d-%m-%Y %H:%i") as scrutinised_on,
				appmas.first_name,appmas.mid_name,appmas.last_name,appmas.full_name,ex.exam_centre_name,appmas.applicant_email,appmas.applicant_landline,appmas.applicant_mobile,appmas.marital_status,appmas.phtype,
					userimg.passportphoto,signature.SIGN,gm.gender,nm.nationality AS natinality,appmas.nationality AS nationalitycode,appr.dob,appmas.dob_in_word,catm.category_name,rm.religion_name as religion,
					appmas.is_physically_challanged,appmas.is_minority_community,mcm.minority_community,appmas.hostel_facility,appmas.ap_resident,appmas.father_name,appmas.presentation_details,appmas.any_other_info,
					appmas.single_girl_child_flag,appmas.if_chronic_illness,appmas.chronic_illness,appmas.if_allergies,appmas.allergies,appmas.last_year_mark,
					appmas.last_school,appmas.other_university,bm.board_name,appmas.last_board,appmas.applicant_email,appmas.univ_regn_no,appmas.is_reserved_quota,
					appr.email_id,appmas.subject_offered1,appmas.subject_offered2,appmas.subject_offered3,appmas.subject_offered4,gen.description,
					appmas.highest_qualification,hqm.qualification_name,subjects_offered,appmas.last_school,appmas.last_grade,appmas.adhar_no,appmas.physically_challenged,appmas.applied_program,appmas.exam_center_code,
					appmas.exam_center_code1,appmas.exam_center_code2,ex.exam_centre_name,ex1.exam_centre_name as exam_centre_name1,ex2.exam_centre_name as exam_centre_name2,
					appmas.is_north_east,appmas.north_east_state,appmas.category,appmas.guardian_name,appmas.father_occupation,appmas.annual_parent_income,appmas.is_employed,
					appmas.employer_add,appmas.employer_from,appmas.employer_to,appmas.completion_date,appmas.center_name1,appmas.center_name2,appmas.center_name3,appmas.master_name,
					appmas.mothers_name,appmas.mothers_profession,appmas.mothers_income,appmas.fathers_adhar_no,appmas.mothers_adhar_no,
					appmas.total_mark,appmas.secured_mark,appmas.distinction,appmas.course_type,appmas.is_kashmiri_migrant,appmas.is_ex_serviceman,appmas.is_sports,appmas.is_computer_education,
					appmas.honours_total_mark,appmas.honours_secured_mark,appmas.other_subject,appmas.period_of_debar,date_format(appmas.date_of_debar,"%d-%m-%Y") as date_of_debar,
					appmas.name_of_post,date_format(appmas.govt_doj,"%d-%m-%Y") as govt_doj,appmas.name_of_office,appmas.any_disciplinary_action,
					appmas.honours_division,appmas.honours_subject,hons.subject_name,appmas.are_parents_alive,"" AS GSIGN,"" AS blood_group_name,"" AS mother_tongue,"" AS mode_of_transport, "" AS is_alumnus, "" AS alumnus_name, ""  AS alumnus_year_of_passing, "" AS is_staff,
					"" AS staff_name, "" AS is_general, "" AS caste_name ,appmas.informed_govt,ipm.id_proof_name
					,appmas.id_proof_number,pm.program_name,ex.exam_centre_name as exam_centre_detail,
					is_ews,is_exp,no_of_exp,pm.advt_no,pm.advt_date');
				$this->db->from('applicant_master appmas');
				
				$this->db->join("applicant_appl_overview apovr",'appmas.reg_user_id=apovr.reg_user_id and appmas.applied_program=apovr.applied_program','left');
				$this->db->join("applicant_reg_master appr",'appmas.reg_user_id=appr.reg_user_id','left');
				$this->db->join("program_master pm",'appmas.applied_program = pm.program_code','left');
				$this->db->join("exam_centre ec",'ec.exam_centre_code=appmas.exam_center_code','left');
				$this->db->join("exam_centre ex",'ex.exam_centre_code=appmas.exam_center_code','left');
				$this->db->join("exam_centre ex1",'ex1.exam_centre_code=appmas.exam_center_code1','left');
				$this->db->join("exam_centre ex2",'ex2.exam_centre_code=appmas.exam_center_code2','left');
				$this->db->join("($subQuery1) userimg",'userimg.appl_no=apovr.appl_no','left');
				$this->db->join("($subQuery2) signature",'userimg.appl_no=apovr.appl_no','left');
				$this->db->join("gender_master gm",'gm.gender_code=appmas.gender','left');
				$this->db->join("nationality_master nm",'nm.nationality_code=appmas.nationality','left');
				$this->db->join("id_proof_master ipm",'appmas.id_proof=ipm.id_proof_code','left');
				$this->db->join("user_master um",'um.user_code=appr.updated_by','left');
				$this->db->join("category_master catm",'catm.category_code=appmas.category','left');
				$this->db->join("religion_master rm",'rm.religion_code=appmas.religion','left');
				$this->db->join("gen_code_description gen",'gen.code=appmas.phtype','left');
				$this->db->join("highest_qualification_master hqm",'appmas.highest_qualification = hqm.qualification_code','left');
				$this->db->join("minority_community_master mcm",'mcm.minority_community_code =appmas.minority_community_details','left');
				$this->db->join("board_master bm",'bm.board_code=appmas.last_board','left');
				$this->db->join("honours_subject_master hons",'appmas.honours_subject=hons.subject_code','left');
				$this->db->where('apovr.applied_program',$seladmcode);
				$this->db->where('appmas.applied_program',$seladmcode);
				$this->db->where('appmas.reg_user_id',$reg_user_id);
				$result = $this->db->get(); 
				/*echo $this->db->last_query();
				die();*/
				$applicant_detail = array();
				foreach($result->result_array() AS $row1)
				{
					$applicant_detail[]=$row1;
				}
				
				$application_data = array();
				$this->db->select('aplov.appl_no,pm.program_name,pm.elective_subjects,aplov.applied_program,aplov.index_no,pm.year');
				$this->db->from('applicant_appl_overview aplov');
				$this->db->join('program_master pm','pm.program_code=aplov.applied_program','left');
				$this->db->where('aplov.reg_user_id',$reg_user_id);
				$this->db->where('aplov.applied_program',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$application_data[]=$row1;
				}
				
				$applicant_father = array();
				$this->db->select('rel_name,rel_qualification,rel_occupation,rel_desig,nature_of_work,annual_income,place_work,email_id,res_no,mobile_no');
				$this->db->from('applicant_relation');
				$this->db->join('applicant_master','applicant_relation.reg_user_id=applicant_master.reg_user_id','left');
				$this->db->join('applicant_appl_overview apovr','applicant_master.reg_user_id=apovr.reg_user_id','left');
				$this->db->where('applicant_rel_flag',1);
				$this->db->where('applicant_relation.reg_user_id',$reg_user_id);
				$this->db->where('applicant_master.applied_program',$seladmcode);
				$this->db->where('applicant_relation.applied_program',$seladmcode);
				$this->db->where('apovr.applied_program',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$applicant_father[]=$row1;
				}
				
				$applicant_mother = array();
				$this->db->select('rel_name,rel_qualification,rel_occupation,rel_desig,nature_of_work,annual_income,place_work,email_id,res_no,mobile_no');
				$this->db->from('applicant_relation');
				$this->db->join('applicant_master','applicant_relation.reg_user_id=applicant_master.reg_user_id','left');
				$this->db->join('applicant_appl_overview apovr','applicant_master.reg_user_id=apovr.reg_user_id','left');
				$this->db->where('applicant_rel_flag',2);
				$this->db->where('applicant_relation.reg_user_id',$reg_user_id);
				$this->db->where('applicant_master.applied_program',$seladmcode);
				$this->db->where('applicant_relation.applied_program',$seladmcode);
				$this->db->where('apovr.applied_program',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$applicant_mother[]=$row1;
				}
				
				$qualification_detail = array();
				$this->db->select(' A.`qual_desc_1` AS qual_desc_1,qual_desc_2,other_stream,A.honours_subject,year_of_passing,university_board,division_distinction,mark_secured,full_mark,percentage_mark,A.duration,A.course');
				$this->db->from('applicant_qualification_detail A');
				$this->db->join('applicant_master B','A.applied_program = B.applied_program AND A.reg_user_id = B.reg_user_id','inner');
				$this->db->where('A.reg_user_id',$reg_user_id);
				$this->db->where('A.applied_program',$program);
				$this->db->where('A.qual_desc_1 is not null');
				$this->db->order_by('A.id');
				//$this->db->order_by ('A.year_of_passing', "ASC");
				$result = $this->db->get();
				/*echo $this*/
				foreach($result->result_array() AS $row1)
				{
					$qualification_detail[]=$row1;
				}
				$work_experience_detail = array();
				$this->db->select('A.*');
				$this->db->from('applicant_work_experience_detail A');
				$this->db->join('applicant_master B','A.applied_program = B.applied_program AND A.reg_user_id = B.reg_user_id','inner');
				$this->db->where('A.reg_user_id',$reg_user_id);
				$this->db->where('A.applied_program',$program);
				$this->db->order_by('A.id');
				//$this->db->order_by ('A.year_of_passing', "ASC");
				$result = $this->db->get();
				/*echo $this*/
				foreach($result->result_array() AS $row1)
				{
					$work_experience_detail[]=$row1;
				}
				
				$fetchInst = array();
				$this->db->select('A.program_name,B.institute_name,A.department_name,A.institute_code,B.location,B.institute_address,B.logo_url,A.advt_no,date_format(A.advt_date,"%d-%m-%Y") AS advt_date');
				$this->db->from('program_master A');
				$this->db->join('institute_master B','A.institute_code=B.institute_code','inner');
				$this->db->where('A.program_code',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$fetchInst[]=$row1;
				}
				
				$addressDetail = array();
				$this->db->select('address_1,address_2,cand_name,co_name,city_name,post_office,dm.district_name,sm.state_name,pin,applicant_address.district_code,applicant_address.state_code,distance_from');
				$this->db->from('applicant_address');
				$this->db->join('applicant_master appmas','applicant_address.address_ref_id=appmas.comm_address_ref_id','left');
				$this->db->join('applicant_appl_overview applov','applov.reg_user_id=appmas.reg_user_id','left');
				$this->db->join('district_master dm','dm.district_code=applicant_address.district_code','left');
				$this->db->join('state_master sm','sm.state_code=applicant_address.state_code','left');
				$this->db->where('applov.reg_user_id',$reg_user_id);
				$this->db->where('appmas.applied_program',$seladmcode);
				$this->db->where('applov.applied_program',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$addressDetail[]=$row1;
				}
				
				$addressDetail2 = array();
				$this->db->select('address_1,address_2,cand_name,co_name,city_name,post_office,dm.district_name,sm.state_name,pin,applicant_address.district_code,applicant_address.state_code,distance_from,
								mobile');
				$this->db->from('applicant_address');
				$this->db->join('applicant_master appmas','applicant_address.address_ref_id=appmas.perm_address_ref_id','left');
				$this->db->join('applicant_appl_overview applov','applov.reg_user_id=appmas.reg_user_id','left');
				$this->db->join('district_master dm','dm.district_code=applicant_address.district_code','left');
				$this->db->join('state_master sm','sm.state_code=applicant_address.state_code','left');
				$this->db->where('applov.reg_user_id',$reg_user_id);
				$this->db->where('appmas.applied_program',$seladmcode);
				$this->db->where('applov.applied_program',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$addressDetail2[]=$row1;
				}
				
				$paymentDetail = array();
				$this->db->select('apov.money_deposit_mode,apov.amount,DATE_FORMAT(apov.depositdate,"%d-%m-%Y") AS depositdate,apov.money_receipt_no, apov.pg_charges');
				$this->db->from('applicant_form_fee_overview apov');
				$this->db->join('applicant_appl_overview','apov.appl_no=applicant_appl_overview.appl_no', 'left');
				$this->db->where('applicant_appl_overview.reg_user_id',$reg_user_id);
				$this->db->where('applicant_appl_overview.applied_program',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$paymentDetail[]=$row1;
				}
				$tech_qual_data_5 = array();
				//$this->db->distinct("qual_desc_1,year,institute_name,thesis,stream,division,affiliation_from,applicant_technical_qualification_detail.subjects_offered,grade_cgpa");
				$this->db->select("qual_desc_1,year,institute_name,thesis,stream,division,affiliation_from,applicant_technical_qualification_detail.subjects_offered,grade_cgpa");
				$this->db->from('applicant_technical_qualification_detail');
				$this->db->join('applicant_master','applicant_master.reg_user_id = applicant_technical_qualification_detail.reg_user_id','inner');
				$this->db->where('applicant_technical_qualification_detail.applied_program',$seladmcode);
				$this->db->where('applicant_technical_qualification_detail.reg_user_id',$reg_user_id);
				//$this->db->where('applicant_technical_qualification_detail.sl_no','5');
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$tech_qual_data_5[]=$row1;
				}
				$tech_qual_data_6 = array();
				$this->db->distinct("qual_desc_1,year,institute_name,thesis,stream,division,affiliation_from,applicant_technical_qualification_detail.subjects_offered,grade_cgpa");
				$this->db->select("qual_desc_1,year,institute_name,thesis,stream,division,affiliation_from,applicant_technical_qualification_detail.subjects_offered,grade_cgpa");
				$this->db->from('applicant_technical_qualification_detail');
				$this->db->join('applicant_master','applicant_master.reg_user_id = applicant_technical_qualification_detail.reg_user_id','inner');
				$this->db->where('applicant_technical_qualification_detail.applied_program',$seladmcode);
				$this->db->where('applicant_technical_qualification_detail.reg_user_id',$reg_user_id);
				$this->db->where('applicant_technical_qualification_detail.sl_no','6');
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$tech_qual_data_6[]=$row1;
				}
				
				$applicant_postwise_experience = array();
				$this->db->select("experience_name,is_experienced");
				$this->db->from('applicant_postwise_experience');
				$this->db->where('applicant_postwise_experience.program_code',$seladmcode);
				$this->db->where('applicant_postwise_experience.reg_user_id',$reg_user_id);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$applicant_postwise_experience[]=$row1;
				}
			//echo sizeof($applicant_postwise_experience);die;
				$total_experience_1 = '';
				//$this->db->distinct("qual_desc_1,year,institute_name,thesis,stream,division,affiliation_from,applicant_technical_qualification_detail.subjects_offered,grade_cgpa");
				$this->db->select("total_experience_1");
				$this->db->from('applicant_total_experience');
				$this->db->where('applied_program',$seladmcode);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$total_experience_1=$row1['total_experience_1'];
				}
				
				$otherDetail = array();
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Permanent State');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$otherDetail[]=$row1;
				}
				
				$otherDistrict = array();
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Permanent District');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$otherDistrict[]=$row1;
				}
				
				$otherpresentstate = array();
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Present State');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$otherpresentstate[]=$row1;
				}
				
				$otherpresentdistrict = array();
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Present District');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$otherpresentdistrict[]=$row1;
				}
				
				$othernationality = array();
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Name of the Board');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$othernationality[]=$row1;
				}
				
				$applicant_documents = array();
				$this->db->select('afd.appl_no,doc_id,document_path,dtm.document_type');
				$this->db->from('applicant_form_documents afd');
				$this->db->join('applicant_appl_overview','afd.appl_no=applicant_appl_overview.appl_no','inner');
				$this->db->join('document_type_master dtm','afd.document_type = dtm.document_type_code','inner');
				$this->db->where('afd.status',1);
				$this->db->where('applicant_appl_overview.reg_user_id',$reg_user_id);
				$this->db->where('applicant_appl_overview.applied_program',$seladmcode);
				$this->db->where('dtm.document_type_code !=','PHO');
				$this->db->where('dtm.document_type_code !=','SIG');
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$applicant_documents[]=$row1;
				}
				/*$research_employment = array();
				$this->db->select('appo.applied_program,appo.reg_user_id,ared.organization,ared.post_held,ared.date_from,ared.date_to,ared.nature_of_job,ared.pay_band,ared.basic_pay');
				$this->db->from('applicant_research_experience_detail ared');
				$this->db->join('applicant_appl_overview appo','ared.applied_program = appo.applied_program  AND  ared.reg_user_id = appo.reg_user_id','inner');
				$this->db->join('program_master pm','appo.applied_program = pm.program_code ','inner');
				$this->db->where('appo.reg_user_id',$reg_user_id);
				$this->db->where('appo.applied_program',$program);
				$this->db->where('dtm.document_type_code !=','PHO');
				$this->db->where('dtm.document_type_code !=','SIG');
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$research_employment[]=$row1;
				}*/
				
				
				$this->db->select('appo.applied_program,appo.reg_user_id,ard.referenced_by,ard.contact_address,ard.email_id,ard.mobile_number');
				$this->db->from('applicant_reference_detail ard');
				$this->db->join('applicant_appl_overview appo','ard.applied_program = appo.applied_program  AND  ard.reg_user_id = appo.reg_user_id','inner');
				$this->db->join('program_master pm','appo.applied_program = pm.program_code ','inner');
				$this->db->where('appo.reg_user_id',$reg_user_id);
				$this->db->where('appo.applied_program',$program);
				$result = $this->db->get();
				$reference_details = array();
				foreach($result->result_array() AS $row1)
				{
					$reference_details[]=$row1;
				}
				$inst_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
				//$date = date('Y-m-d', now()); 
				$this->db->select("GROUP_CONCAT(IFNULL(course_name, '')) AS course_name");   
				//$this->db->select("course_name"); 
				$this->db->from('course_master');
				$this->db->join('course_details','course_master.course_code=course_details.course_code  AND course_master.program_code = course_details.prog_code','left'); 
				$this->db->where('inst_code',$inst_code);
				$this->db->where('prog_code',$program);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('course_master.record_status','1'); 
				$result = $this->db->get();
				$multiple_post = array();
				foreach($result->result_array() AS $row1)
				{
					$multiple_post[]=$row1;
				}
				//echo $this->db->last_query();die();
				
				//print_r($qualification_detail);die();
				//print_r($application_data);
				
				
				
				$selectedpost=$multiple_post[0]['course_name'];
				
				//print_r($qualification_detail);die();
				//print_r($application_data);
				$declaration_new=$declaration_array[0]['declaration'];
				
				
				$applicantNumber=$application_data[0]['appl_no'];
				$programName=htmlspecialchars_decode($application_data[0]['program_name']);
			    $programcode=$application_data[0]['applied_program'];
				$elective_subjects = $application_data[0]['elective_subjects'];
				$program_year = $application_data[0]['year'];
				$index_number = $application_data[0]['index_no'];
				
				$next_year = $program_year + 1;
				$next_year = substr($next_year, -2); 
				$session = $program_year.'-'.$next_year;
				$programName=htmlspecialchars_decode($application_data[0]['program_name']);
				
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============STUDENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				$examCenters=$applicant_detail[0]['exam_centre_name'];
				$regd_user_id=$applicant_detail[0]['reg_user_id'];
				$firstName=$applicant_detail[0]['first_name'];
				$midName=$applicant_detail[0]['mid_name'];
				$lastName=$applicant_detail[0]['last_name'];
				$fullName=$applicant_detail[0]['full_name'];
				$userPhoto=$applicant_detail[0]['passportphoto'];
				$app_email =$applicant_detail[0]['applicant_email'];
				$sign=$applicant_detail[0]['SIGN'];
				
				$program_name=$applicant_detail[0]['program_name'];
				
				$id_proof_number=$applicant_detail[0]['id_proof_number'];
				$id_proof_name=$applicant_detail[0]['id_proof_name'];
				$religion=$applicant_detail[0]['religion'];
				
				//echo $master_name;
				$userSign = $sign;
				//$motherSign=$applicant_detail[0]['MSIGN'];
				$are_parents_alive=$applicant_detail[0]['are_parents_alive'];
				$guardianSign=$applicant_detail[0]['GSIGN'];
				$gender=$applicant_detail[0]['gender'];
				$reg_no = $applicant_detail[0]['univ_regn_no'];
				$reserved_quota = $applicant_detail[0]['is_reserved_quota'];
				$bloodgroup=$applicant_detail[0]['blood_group_name'];
				$mothertongue=$applicant_detail[0]['mother_tongue'];
				$transport=$applicant_detail[0]['mode_of_transport'];
				$is_kashmiri_migrant=$applicant_detail[0]['is_kashmiri_migrant'];
				$is_alumnus=$applicant_detail[0]['is_alumnus'];
				$alumnus=$applicant_detail[0]['alumnus_name'];
				$alumnus_year=$applicant_detail[0]['alumnus_year_of_passing'];
				$is_staff=$applicant_detail[0]['is_staff'];
				$staff=$applicant_detail[0]['staff_name'];
				$is_general=$applicant_detail[0]['is_general'];
				$qualifying_degree=$applicant_detail[0]['qualification_name'];
				$university_name=$applicant_detail[0]['last_school'];
				$other_university=$applicant_detail[0]['other_university'];
				$subject_offered1=$applicant_detail[0]['subject_offered1'];
				$subject_offered2=$applicant_detail[0]['subject_offered2'];
				$subject_offered3=$applicant_detail[0]['subject_offered3'];
				$subject_offered4=$applicant_detail[0]['subject_offered4'];
				$last_grade=$applicant_detail[0]['last_grade'];
				$caste=$applicant_detail[0]['caste_name'];
				$subject_name=$applicant_detail[0]['subject_name'];
				$nationality=$applicant_detail[0]['natinality'];
				$nationalityCode=$applicant_detail[0]['nationalitycode'];
				$adhar_no = $applicant_detail[0]['adhar_no'];
				$ap_resident = $applicant_detail[0]['ap_resident'];
				$physically_challenged = $applicant_detail[0]['physically_challenged'];
				$phtype = $applicant_detail[0]['phtype'];
				//$phtype = $applicant_detail[0]['description'];
				
				$applied_program = $applicant_detail[0]['applied_program'];
				$exam_center_code = $applicant_detail[0]['exam_center_code'];
				if($applicant_detail[0]['is_north_east'] == 'NO'){
					$north_east_state = $applicant_detail[0]['is_north_east'];
				}else{
					$north_east_state = $applicant_detail[0]['is_north_east'].','.$applicant_detail[0]['north_east_state'];
				}
				
				$category = $applicant_detail[0]['category'];
				$guardian_name = $applicant_detail[0]['guardian_name'];
				$father_occupation = $applicant_detail[0]['father_occupation'];
				$annual_parent_income = $applicant_detail[0]['annual_parent_income'];
				
				$mothers_name = $applicant_detail[0]['mothers_name'];
				$mothers_profession = $applicant_detail[0]['mothers_profession'];
				$mothers_income = isset($applicant_detail[0]['mothers_income'])?$applicant_detail[0]['mothers_income']:0;
				$fathers_adhar_no = $applicant_detail[0]['fathers_adhar_no'];
				$mothers_adhar_no = $applicant_detail[0]['mothers_adhar_no'];

				$is_employed = $applicant_detail[0]['is_employed'];
				$chkInformed = $applicant_detail[0]['informed_govt'];
				$empDisciplinary = $applicant_detail[0]['any_disciplinary_action'];
				/*die();*/
				$employer_add = $applicant_detail[0]['employer_add'];
				$employer_from = $applicant_detail[0]['employer_from'];
				$employer_to = $applicant_detail[0]['employer_to'];
				$completion_date = $applicant_detail[0]['completion_date'];

				$center_name1 = $applicant_detail[0]['exam_centre_name'];
				$center_name2 = $applicant_detail[0]['exam_centre_name1'];
				$center_name3 = $applicant_detail[0]['exam_centre_name2'];
				$center_code1 = $applicant_detail[0]['exam_center_code'];
				$center_code2 = $applicant_detail[0]['exam_center_code1'];
				$center_code3 = $applicant_detail[0]['exam_center_code2'];
				$master_name = $applicant_detail[0]['master_name'];
				$last_year_mark = $applicant_detail[0]['last_year_mark'];

				//echo $center_name1 .'k'.$center_code1;
				
				$dob=$applicant_detail[0]['dob'];
				
				$apply_last_date = $program_detail[0]['apply_end_date'];
				$appl_end_date = strtotime($apply_last_date);
				$appl_format = date("d-m-Y",$appl_end_date);
				
				//$dob_one = strtotime($dob);
				$dobas1 = new DateTime($dob);
				$dobas2 = new DateTime($apply_last_date);
				$diffas3 = $dobas1->diff($dobas2);
				$ageas = $diffas3->format('%Y years,%m month,%d days');
				
//				die();
				$split=explode("-",$dob);
				$year=$split[0];$month=$split[1];$date=$split[2];
				$exam_centre_detail=$applicant_detail[0]['exam_centre_detail'];
				$dobinWord=$applicant_detail[0]['dob_in_word'];
				$category=$applicant_detail[0]['category_name'];
				$hostel_facility=$applicant_detail[0]['hostel_facility'];
				$is_physically_challanged=$applicant_detail[0]['is_physically_challanged'];
				$is_minority_community=$applicant_detail[0]['is_minority_community'];
				$minority_community_details=$applicant_detail[0]['minority_community'];
				$marital_status=$applicant_detail[0]['marital_status'];
				$single_girl_child_flag=$applicant_detail[0]['single_girl_child_flag'];
				$if_chronic_illness=$applicant_detail[0]['if_chronic_illness'];
				$chronic_illness=$applicant_detail[0]['chronic_illness'];
				$if_allergies=$applicant_detail[0]['if_allergies'];
				$allergies=$applicant_detail[0]['allergies'];
				$last_school=$applicant_detail[0]['last_school'];
				$is_ews=$applicant_detail[0]['is_ews'];
				$is_exp=$applicant_detail[0]['is_exp'];
				$no_of_exp=$applicant_detail[0]['no_of_exp'];
				if($is_exp == 'YES')
				{
					$is_exp = $is_exp."(".$no_of_exp." Years)";
				}
				$last_board=$applicant_detail[0]['board_name'];
				$boardCode=$applicant_detail[0]['last_board'];
				$txtTotalMarks = $applicant_detail[0]['total_mark'];
				$txtSecuredMarks = $applicant_detail[0]['secured_mark'];
				$radioDistinction = $applicant_detail[0]['distinction'];
				$txtHonoursSubject = $applicant_detail[0]['honours_subject'];
				$other_subject = $applicant_detail[0]['other_subject'];
				$txtHonsTotalMarks = $applicant_detail[0]['honours_total_mark'];
				$txtHonsSecuredMarks = $applicant_detail[0]['honours_secured_mark'];
				$email_id = $applicant_detail[0]['email_id'];
				$othernationality = 'Non-Indian';
				if($university_name=='OTH')
				{
					$university_name = $other_university;
				}
				if($txtHonoursSubject=='OTH')
				{
					$subject_name = $other_subject;
				}
				if($nationalityCode=='OTH')
				{
					$actual_nationality = $othernationality;
				}
				else
				{
					$actual_nationality = $nationality;
				}
				
				if($master_name=="DPMT") 
				{
					$master_name="Diploma in Plastics Mould Technology";
				}

				if($master_name=="PGDPP") 
				{
					$master_name="Postgraduate Diploma in Plastics Processing & Testing";
				}
				if($master_name=="DPMD") 
				{
					$master_name="Post Diploma in Plastics Mould Design with CAD/CAM";
				}
				if($master_name=="DEPT") 
				{
					$master_name="Diploma in Plastics Technology";
				}
				if($master_name=="PGDPQ") 
				{
					$master_name="Postgraduate Diploma in Plastics Testing & Quality Control";
				}

				

				if($txtHonsTotalMarks == 0)
				{
					$txtHonsTotalMarks = '';
				}
				if($txtHonsSecuredMarks == '0.00')
				{
					$txtHonsSecuredMarks = '';
				}
				if($reserved_quota == 'No')
				{
					$actual_category = '';
				}
				else if($reserved_quota == 'Yes')
				{
					$actual_category = '( '.$category.' )';
				}
				
				
				$name_of_office = isset($applicant_detail[0]['name_of_office'])?$applicant_detail[0]['name_of_office']:'';
				$govt_doj = isset($applicant_detail[0]['govt_doj'])?$applicant_detail[0]['govt_doj']:'';
				$name_of_post = isset($applicant_detail[0]['name_of_post'])?$applicant_detail[0]['name_of_post']:'';
				$date_of_debar = isset($applicant_detail[0]['date_of_debar'])?$applicant_detail[0]['date_of_debar']:'';
				$period_of_debar = isset($applicant_detail[0]['period_of_debar'])?$applicant_detail[0]['period_of_debar']:'';
				$is_ex_seviceman = $applicant_detail[0]['is_ex_serviceman'];
				$is_sports = $applicant_detail[0]['is_sports'];
				$is_computer = $applicant_detail[0]['is_computer_education'];
				$presentation_details = isset($applicant_detail[0]['presentation_details'])?$applicant_detail[0]['presentation_details']:'';
				$any_other_info = isset($applicant_detail[0]['any_other_info'])?$applicant_detail[0]['any_other_info']:'';
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============STUDENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============INSTITURE DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				$txtHonsDivision = $applicant_detail[0]['honours_division'];
				$radioCourseType = $applicant_detail[0]['course_type'];
				$father_name=isset($applicant_father[0]['rel_name'])?$applicant_father[0]['rel_name']:'';
				$relNameM=isset($applicant_mother[0]['rel_name'])?$applicant_mother[0]['rel_name']:'';
				$institute_name = isset($fetchInst[0]['institute_name'])?$fetchInst[0]['institute_name']:'';
				$department_name = isset($fetchInst[0]['department_name'])?$fetchInst[0]['department_name']:'';
				$institute_code = isset($fetchInst[0]['institute_code'])?$fetchInst[0]['institute_code']:'';
				$institute_location = isset($fetchInst[0]['location'])?$fetchInst[0]['location']:'';
				$institute_address = isset($fetchInst[0]['institute_address'])?$fetchInst[0]['institute_address']:'';
				$logo = isset($fetchInst[0]['logo_url'])?$fetchInst[0]['logo_url']:'';  
				$program_name = isset($fetchInst[0]['program_name'])?$fetchInst[0]['program_name']:'';
				$advt_no = isset($fetchInst[0]['advt_no'])?$fetchInst[0]['advt_no']:'';
				$advt_date = isset($fetchInst[0]['advt_date'])?$fetchInst[0]['advt_date']:'';
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============INSTITURE DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PRESENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				$presentaddr1=isset($addressDetail[0]['address_1'])?$addressDetail[0]['address_1']:'';
				$presentaddr2=isset($addressDetail[0]['address_2'])?$addressDetail[0]['address_2']:'';

				$father_name=isset($applicant_detail[0]['father_name'])?$applicant_detail[0]['father_name']:'';
				$cand_name=isset($addressDetail[0]['cand_name'])?$addressDetail[0]['cand_name']:'';
				$co_name=isset($addressDetail[0]['co_name'])?$addressDetail[0]['co_name']:'';
				$city_name=isset($addressDetail[0]['city_name'])?$addressDetail[0]['city_name']:'';

				$presentpostoffice=isset($addressDetail[0]['post_office'])?$addressDetail[0]['post_office']:'';
				$presentdistrictcode=isset($addressDetail[0]['district_name'])?$addressDetail[0]['district_name']:'';
				$presentstatecode=isset($addressDetail[0]['state_name'])?$addressDetail[0]['state_name']:'';
				$presentpin=isset($addressDetail[0]['pin'])?$addressDetail[0]['pin']:'';
				$presentdistance=isset($addressDetail[0]['distance_from'])?$addressDetail[0]['distance_from']:'';
				$chkpresentotherdistrict=isset($addressDetail[0]['district_code'])?$addressDetail[0]['district_code']:'';
				$chkpresentotherstate=isset($addressDetail[0]['state_code'])?$addressDetail[0]['state_code']:'';
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PRESENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PERMANENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				$permanentaddr1=isset($addressDetail2[0]['address_1'])?$addressDetail2[0]['address_1']:'';
				$permanentaddr2=isset($addressDetail2[0]['address_2'])?$addressDetail2[0]['address_2']:'';

				$cand_name1=isset($addressDetail2[0]['cand_name'])?$addressDetail2[0]['cand_name']:'';
				$co_name1=isset($addressDetail2[0]['co_name'])?$addressDetail2[0]['co_name']:'';
				$city_name1=isset($addressDetail2[0]['city_name'])?$addressDetail2[0]['city_name']:'';


				$permanentpostoffice=isset($addressDetail2[0]['post_office'])?$addressDetail2[0]['post_office']:'';
				$permanentdistrictcode=isset($addressDetail2[0]['district_name'])?$addressDetail2[0]['district_name']:'';
				$permanentstatecode=isset($addressDetail2[0]['state_name'])?$addressDetail2[0]['state_name']:'';
				$permanentpin=isset($addressDetail2[0]['pin'])?$addressDetail2[0]['pin']:'';
				$permanentmobile=isset($addressDetail2[0]['mobile'])?$addressDetail2[0]['mobile']:'';
				$permanentdistance=isset($addressDetail2[0]['distance_from'])?$addressDetail2[0]['distance_from']:'';
				$chkpermanentotherdistrict=isset($addressDetail2[0]['district_code'])?$addressDetail2[0]['district_code']:'';
				$chkpermanentotherstate=isset($addressDetail2[0]['state_code'])?$addressDetail2[0]['state_code']:'';
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PERMANENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PAYMENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				$paymentMode=isset($paymentDetail[0]['money_deposit_mode'])?$paymentDetail[0]['money_deposit_mode']:'';
				$amountPaid=isset($paymentDetail[0]['amount'])?$paymentDetail[0]['amount']:0;
				$depositDate=isset($paymentDetail[0]['depositdate'])?$paymentDetail[0]['depositdate']:'';
				$transactionNo=isset($paymentDetail[0]['money_receipt_no'])?$paymentDetail[0]['money_receipt_no']:'';
				$pg_charges=isset($paymentDetail[0]['pg_charges'])?$paymentDetail[0]['pg_charges']:0;
				$amountPaid = $amountPaid + $pg_charges;
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PAYMENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============OTHER DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				$otherpermanentstate = isset($otherDetail[0]['field_value'])?$otherDetail[0]['field_value']:'';
				$otherpermanentdistrict = isset($otherDistrict[0]['field_value'])?$otherDistrict[0]['field_value']:'';
				$otherpresentstate = isset($otherpresentstate[0]['field_value'])?$otherpresentstate[0]['field_value']:'';
				$otherpresentdistrict = isset($otherpresentdistrict[0]['field_value'])?$otherpresentdistrict[0]['field_value']:'';
				$othernationality = isset($othernationality[0]['field_value'])?$othernationality[0]['field_value']:'';
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============OTHER DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				
				
				$mSign = '';
			   	$fSign = '';
			   	$gSign = '';
			   	$userimg = '';   	
			   	$actual_category = '';
			   	$reg_user_id = '';
			   	$document_upload_url = '';
			   	$signature = '';
			   	$reg_user_id = $this->session->userdata('reg_user_id');
			   	//Logo
				if($userPhoto != '')
			    {
			      $arr = explode('/',$userPhoto);
			      $photo = end($arr);
			      $photo = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$programcode."/".$applicantNumber."/".$photo;
			    }
				if($userSign != '')
			    {
			      $arr = explode('/',$userSign);
			      $sign = end($arr);
			      $sign = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$programcode."/".$applicantNumber."/".$sign;
			    }
				

			    $logo = base_url()."public/assets/images/$logo";//BROWSE LOGO
			    $header_logo = base_url()."public/assets/images/CMSS.png";
			    if($userPhoto != '' && file_exists ($photo ))
			      $userimg="$userPhoto";//BROWSE USER IMAGE
			    if($userSign != '' && file_exists ($sign ))
			      $signature="$userSign";//BROWSE USER SIGNATURE
				//$date1 = $year.'-'.$month.'-'.$date;
				$date1 = new DateTime($dob);
				$date2 = new DateTime('2021-09-30');
				$diff = $date1->diff($date2);
				$age = $diff->format('%Y years,%m month,%d days');
				//$date1 = new DateTime($date1);
			$html = '';
			$html .= '<table width="100%" style="border-collapse: collapse;font-family:Arial;">
					<tr>
						<td>
						</td>
						<td colspan="2" style="text-align: right;">
							<b>Application No : </b>'.$applicantNumber.'
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td colspan="2" style="text-align: right;">
							<b>Mobile No : </b>'.$reg_user_id.'
						</td>
					</tr>
					
					<tr>
						
					</tr>
					<tr> 
					
						<td style="width:60%;text-align: left;vertical-align:middle;">
						<div>
				               <span> 
				                <img src="'.$header_logo.'" class="logo_img" style="vertical-align: top; max-width:27%;padding-left: 8%;float:left; ">
				                <span>
				              	<h3 style="font-weight:bold;font-size:22px;padding-top: 3%;">Central Medical Services Society</h3>
				                <h4 style="font-size: 14px;padding-left:25%;">An Autonomous Body under Ministry of Health & Family Welfare, Government of India</h4>
				            </span>
				    			</span> 
				              </div>
				            </td>
						
					</tr>
					
				</table>
				<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px; ">
					<tr >
						<br />
						<td width="38%" style="text-align: center;line-height:2;font-size:17px;">
							<b><u>Advertisement No. : '.$advt_no.' dated : '.$advt_date.'  </u></b></td> 
					</tr>
				</table>
				<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px; ">
					<tr >
						<br />
						<td width="38%" style="padding-left:10px;line-height:2;font-size:17px;">
							<b>Post Applied For</b> </td> 
						 <td width="5%">:</td> <td style = "font-size:17px;"width="45%"><b>'.$program_name.'</b></td> 
					</tr>
				</table>
				<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px; ">
						<tr >
							<td colspan="3" > <span style="font-size:17px;border-bottom:1px solid black;">Applicant\'s Information : </span></td>
						</tr>
						<tr>
						<td width="50%" style="padding-left:10px;line-height:2;">
							1. Applicant Name </td> <td width="5%">:</td> <td width="45%">'.$firstName.' '.$midName.' '.$lastName.'</td> 
							<td rowspan = "8" style="width:15%;text-align: center;">
								<img style="vertical-align: top" src="'.$userimg.'" width="100"  height="100" />
							</td>
						</tr>
					 	<tr>
					 	<td  colspan="3"></td></tr>
				 	
				 	
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						2. Father\'s/Husband\'s Name </td>
	                      <td>:</td> <td>'.$father_name.'</td>
	                     </tr>
	                     <tr><td colspan="3"></td></tr>
	                     
	                     <tr>
						 <td style="padding-left:10px;line-height:2;">
						3. Mother\'s Name </td>
	                      <td>:</td> <td>'.$mothers_name.'</td>
	                     </tr>
	                     <tr><td colspan="3"></td></tr>
	                     
	                     <tr>
						 <td style="padding-left:10px;line-height:2;">
						4. Date of Birth</td> <td>:</td> <td>'.$date.'-'.$month.'-'.$year.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						5. Age (as on '.$appl_format.')</td> <td>:</td> <td>'.$ageas.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						6. Gender</td> <td>:</td> <td>'.$gender.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						<tr>
						 <td style="padding-left:10px;line-height:2;"> 
						7. ID Proof Name </td> <td>: </td> <td>'.$id_proof_name.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						8. ID Number </td> <td>: </td> <td>'.$id_proof_number.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						9. Religion </td> <td>: </td> <td>'.$religion.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						10. Category</td> <td>:</td> <td> '.$category.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						';
						if($category == 'General')
						{
							$html.='<tr>
						 <td style="padding-left:10px;line-height:2;">
						Do you belong to Economically Weaker Section?</td> <td>:</td> <td> '.$is_ews.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>';
						}
						$html.='
						
						<tr>
						 <td style="padding-left:10px;line-height:2;" >
						11.  Nationality </td> <td>:</td> <td>'.$actual_nationality.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						12. Email Id</td> <td>:</td> <td>'.$email_id.'</td> 
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
	                     
	                     <tr>
	                      <td style="padding-left:10px;line-height:2;">
						13. Belongs To PwD </td> <td>:</td> <td>'.$physically_challenged.'&nbsp;&nbsp;'.$phtype.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						

								
					</table>
					
			<br>
			<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
			  <tr>
			   <td width="50%">
			<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
				<tr>
					<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;">Present Address : </span></td>
				</tr>
				
				 
				   <tr><td  colspan="3"></td></tr>
				    	 <tr><td  colspan="3"></td></tr>
					<tr>
					   
					    <td style="padding-left:10px;line-height:2;"> Locality/Street Name</td> <td>:</td> <td>'.$presentaddr1.'</td>
					    </tr>
					     <tr><td  colspan="3"></td></tr>
					    <tr>
						  <td style="padding-left:10px;line-height:2;">Post Office</td><td>:</td><td>'.$presentpostoffice.'</td>
						 </tr>
						  <tr><td  colspan="3"></td></tr>
						 <tr>
	                   <td style="padding-left:10px;line-height:2;">City/Town</td> <td>:</td> <td>'.$city_name.'</td>
	                   </tr>
	                   
	                     <tr><td  colspan="3"></td></tr>
						<tr>
						 <td style="padding-left:10px;line-height:2;"> 
						 District </td> <td>:</td> <td>'.$presentdistrictcode.'</td> 
						 </tr>
						 
						 <tr>
						 <td style="padding-left:10px;line-height:2;">State</td> <td>:</td> <td>'.$presentstatecode.'</td>
						 </tr>
						   <tr><td  colspan="3"></td></tr>
						 <tr>
						 <td style="padding-left:10px;line-height:2;">
						 PIN </td> <td>:</td> <td>'.$presentpin.' </td> 
						 </tr>
						  <tr><td  colspan="3"></td></tr>
						  
					
			</table>
			 </td>
			<td width="50%" valign="top">
		<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
				<tr>
					<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;"> Permanent Address : </span></td>
				</tr>
				 
					<tr><td  colspan="3"></td></tr>
					 <tr><td  colspan="3"></td></tr>
					 <tr>
					    <td style="padding-left:10px;line-height:2;">Locality/Street Name</td> <td>:</td><td>'.$permanentaddr1.'</td>
					  </tr>
					  <tr><td  colspan="3"></td></tr>
					   <tr>
						<td style="padding-left:10px;line-height:2;">Post Office </td> <td>:</td> <td>'.$permanentpostoffice.'</td>
	                   </tr>
	                   <tr><td  colspan="3"></td></tr>
	                   <tr>
						 <td style="padding-left:10px;line-height:2;">City/Town</td> <td>:</td> <td>'.$city_name1.'</td>
						</tr>
	                 <tr><td  colspan="3"></td></tr>
					 <tr>
					  <td style="padding-left:10px;line-height:2;">
						District</td>
						<td>:</td>
						<td>'.$permanentdistrictcode.' </td>
						</tr>
						<tr><td  colspan="3"></td></tr>
						<tr>
						<td style="padding-left:10px;line-height:2;">State </td> <td>:</td><td>'.$permanentstatecode.'</td>
						</tr>
						<tr><td  colspan="3"></td></tr>
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						PIN </td> <td>:</td><td>'.$permanentpin.'</td>
						</tr>
						
					
			</table>
			</td>
			</tr>
			</table>';
			
			$html .= '<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;">Educational Qualification</span> </td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
			<td colspan="5">
					<table width="100%" cellpadding="5" style="border-collapse: collapse;text-align:center;" border="1">
						<tr>
							<td style="text-align:center;width:20%;line-height:2;">Name Of The<br /> Examination passed  </td>
							<td style="text-align:center;width:10%;line-height:2;">Degree/Master in </td>
							<td style="text-align:center;width:10%;line-height:2;">Course</td>
							<td style="text-align:center;width:10%;line-height:2;">Year Of Passing/Appearing </td>
							<td style="text-align:center;width:10%;line-height:2;">Duration </td>
							<td style="text-align:center;width:20%;line-height:2;">Board/University</td>
							<td style="text-align:center;width:10%;line-height:2;">CGPA/% of Marks</td>
							<td style="text-align:center;width:10%;line-height:2;">Division/Class </td>
						</tr>';
		//print_r($qualification_detail)	; die();			
		
		foreach($qualification_detail as $row)
		{
			if($row['qual_desc_2'] == null || $row['qual_desc_2'] == '' || $row['qual_desc_2'] == 'NULL')
			{
				$qual_2 = '-';
			}
			else
			{
				$qual_2 = $row['qual_desc_2'];
			}
			
			if($row['course'] == null || $row['course'] == '' || $row['course'] == 'NULL')
			{
				$course = '-';
			}
			else
			{
				$course = $row['course'];
			}
			
			if($row['other_stream'] == null || $row['other_stream'] == '' || $row['other_stream'] == 'NULL' )
			{
				$other_stream = $row['other_stream'];
			}
			else
			{
				$other_stream = ','.$row['other_stream'];
			}
			$html .='<tr>
				<td style ="width:20%;line-height:2;">'.$row['qual_desc_1'].'</td>
				<td style ="width:20%;line-height:2;">'.$qual_2.''.$other_stream.'</td>
				<td style ="width:20%;line-height:2;">'.$course.'</td>
				<td style ="width:10%;line-height:2;">'.$row['year_of_passing'].'</td>
				<td style ="width:20%;line-height:2;">'.$row['duration'].'</td>
				<td style ="width:20%;line-height:2;">'.$row['university_board'].'</td>										 
				<td style ="width:10%;line-height:2;">'.$row['percentage_mark'].'</td>
				<td style ="width:10%;line-height:2;">'.$row['division_distinction'].'</td>
			</tr>';
		}
		$html .= '</table>
				</td>
				<tr/>
			</table> <br/>';
			
				$html .=  '<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;">Other Qualification</span> </td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
					<td colspan="3">
							<table width="100%" cellpadding="5" style="border-collapse: collapse;text-align:center;" border="1">
								<tr>
									<td style="width:20%;">Examination passed  </td>
									<td style="width:25%;">Degree/Master in </td>
									<td style="width:10%;">Year Of <br />Passing</td>
									<td style="width:15%;">Board/<br />University</td>
									<td style="width:15%;">CGPA/% <br />of Marks</td>
									<td style="width:15%;">Division/Class</td>
								</tr>';
				//print_r($tech_qual_data_5)	; die();			
				foreach($tech_qual_data_5 as $row)
				{
					$html .= '<tr>
						<td style ="width:20%;">'.$row['qual_desc_1'].'</td>
						<td style ="width:25%;">'.$row['stream'].'</td>
						<td style ="width:10%;">'.$row['year'].'</td>
						<td style ="width:20%;">'.$row['affiliation_from'].'</td>				 
						<td style ="width:10%;">'.$row['grade_cgpa'].'</td>
						<td style ="width:10%;">'.$row['division'].'</td>
					</tr>';
				}
				/*foreach($tech_qual_data_6 as $row)
				{
					$html .= '<tr>
						<td style ="width:20%;">'.$row['qual_desc_1'].'</td>
						<td style ="width:20%;">'.$row['stream'].'</td>
						<td style ="width:10%;">'.$row['year'].'</td>
						<td style ="width:20%;">'.$row['affiliation_from'].'</td>			 
						<td style ="width:10%;">'.$row['grade_cgpa'].'</td>
						<td style ="width:10%;">'.$row['division'].'</td>
					</tr>';
				}*/
				
				$html .=  '</table>
						</td>
						<tr/>
					</table> <br/><br/><br/>';
					//$pdf = $this->m_pdf->pdf;
        //generate the PDF!
        //$pdf->WriteHTML($html);
        //$pdf->AddPage();
				$html .= '<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;">Work Experience</span> </td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
			<td colspan="5">
					<table width="100%" cellpadding="5" style="border-collapse: collapse;text-align:center;" border="1">
						<tr>
							<td style="text-align:center;width:15%;line-height:2;">Department/Institute/Office</td>
							<td style="text-align:center;width:15%;line-height:2;">Post Held </td>
							<td style="text-align:center;width:10%;line-height:2;">From Date </td>
							<td style="text-align:center;width:10%;line-height:2;">To Date</td>
							<td style="text-align:center;width:10%;line-height:2;">Experience(In Year/Month)</td>
							<td style="text-align:center;width:10%;line-height:2;">Regular/Temporary/Permanent/Contract</td>
							<td style="text-align:center;width:10%;line-height:2;">Scale Of Pay/Gross Salary Per Month</td>
							
						</tr>';
		//print_r($qualification_detail)	; die();			
		
		foreach($work_experience_detail as $row)
		{
			$date_from = date('Y',strtotime($row['date_from']));
			$date_to = date('Y',strtotime($row['date_to']));
			$html .='<tr>
				<td style ="line-height:2;">'.$row['organization'].'</td>
				<td style ="line-height:2;">'.$row['post_held'].'</td>
				<td style ="line-height:2;">'.$date_from.'</td>
				<td style ="line-height:2;">'.$date_to.'</td>
				<td style ="line-height:2;">'.$row['duration'].'</td>
				<td style ="line-height:2;">'.$row['nature_of_job'].'</td>
				<td style ="line-height:2;">'.$row['pay_band'].'</td>										 
				 
			</tr>';
		}
		$html .= '</table>
				</td>
				<tr/>
			</table> <br/>';
			if(sizeof($applicant_postwise_experience) > 0)
			{
				$html .= '<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;">Experience</span> </td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
					<td colspan="5">
							<table width="100%" cellpadding="5" style="border-collapse: collapse;text-align:center;" border="1">
								<tr>
									<td style="text-align:center;width:15%;line-height:2;">Sl No</td>
									<td style="text-align:center;width:15%;line-height:2;">Name</td>
									<td style="text-align:center;width:10%;line-height:2;">YES/NO</td>
								</tr>';
				//print_r($qualification_detail)	; die();			
				$in = 1;
				foreach($applicant_postwise_experience as $row)
				{
					
					$html .='<tr>
						<td style ="line-height:2;">'.$in.'</td>
						<td style ="line-height:2;">'.$row['experience_name'].'</td>
						<td style ="line-height:2;">'.$row['is_experienced'].'</td>										 
						 
					</tr>';
					$in++;
				}
				$html .= '</table>
						</td>
						<tr/>
					</table> <br/>';
			}
				
				$html .=  '<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
						<tr>
							<td><span style="font-size:12px;">Total Experience : &nbsp;'.$total_experience_1.'</span></td>
							<td> </td>
							<td></td>
						</tr>
						<tr>
							<td style="line-height:2;><span style="font-size:12px;">Details of Scientific presentation in National/International Conference/Publications in any index journal : &nbsp;'.$presentation_details.'</span></td>
							<td> </td>
							<td></td>
						</tr>
						<tr>
							<td style="line-height:2;><span style="font-size:12px;">Any other information : &nbsp;'.$any_other_info.'</span></td>
							<td> </td>
							<td></td>
						</tr>
						</table> 
					<br>';
					$html .=  '<h3 style="text-align:center;text-decoration:underline;">Declaration</h3></br></br>';
					if($declaration_new != '')
					{
						$html .=  $declaration_new;
					}
					else
					{
						$html .=  'I  hereby declare that I have read the detail information/advertisement before submission of this application.I hereby certify that all statements made and information given by me in this application form are true, complete and correct to the best of my knowledge and belief. In the event of any information is being found false or incorrect before or after the interview or appointment, action can be taken against me by the board and my candidature/appointment shall automatically be cancelled/terminated.<br/>';
					}
					
					$html .=  '<img style="vertical-align: top ;margin-left:700px;" src="'.$signature.'" height="80" width="150" /><div style="text-align: right;vertical-align:middle;"><b>Signature of the candidate</b></div></br>';
					//$html .= sizeof($applicant_documents);
					if(sizeof($applicant_documents) >= 1)
					{
						$html .=  '<h3 style="text-align:center;text-decoration:underline;">Documents Uploaded</h3></br></br>';
					}
					
					$i=1;
					foreach($applicant_documents as $row){
						
						$html .=  $i.'.'.$row['document_type'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>';
						$i++;
					};
				return array('html' => $html);
			break;
			case 'preview_template001':
				/*ini_set('memory_limit', '-1');*/
				$program_code = $this->session->userdata('admcode');
				$program = $this->session->userdata('admcode');
				$seladmcode = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$now = date("d-m-Y h:i A");
				$today = date("d-m-Y");
				
				$this->db->select('appl_no');
				$this->db->from('applicant_appl_overview aao');
				$this->db->where('applied_program',$seladmcode);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				$Result = $result->result_array();
				foreach($Result as $rrow){
					$applicantNumber = $rrow['appl_no'];
				}
				$this->session->set_userdata('appl_no',$applicantNumber);
				
				$this->db->select('photo.appl_no,photo.document_path AS passportphoto');
				$this->db->from('applicant_form_documents photo');
				$this->db->join('document_type_master doc', 'doc.document_type_code=photo.document_type', 'left');
				$this->db->where('photo.appl_no',$applicantNumber);
				$this->db->where('photo.document_type','PHO');
				$subQuery1 = $this->db->_compile_select();
				$this->db->_reset_select();
				
				$select =   array('photo.appl_no,photo.document_path AS SIGN');
				$this->db->select('photo.appl_no,photo.document_path AS SIGN');
				$this->db->from('applicant_form_documents photo');
				$this->db->join('document_type_master doc', 'doc.document_type_code=photo.document_type', 'left');
				$this->db->where('photo.appl_no',$applicantNumber);
				$this->db->where('photo.document_type','SIG');
				$subQuery2 = $this->db->_compile_select();
				$this->db->_reset_select();
				/*echo $this->db->last_query();
				die();*/
				
				// And now your main query

				$this->db->select('appmas.master_name,'.$reg_user_id.' as reg_user_id,appr.scrutiny_status,appr.scrutiny_remark,um.employee_name as scrutinised_by,date_format(appr.updated_on,"%d-%m-%Y %H:%i") as scrutinised_on,
				appmas.first_name,appmas.mid_name,appmas.last_name,appmas.full_name,ex.exam_centre_name,appmas.applicant_email,appmas.applicant_landline,appmas.applicant_mobile,appmas.marital_status,
					userimg.passportphoto,signature.SIGN,gm.gender,nm.nationality AS natinality,appmas.nationality AS nationalitycode,appr.dob,appmas.dob_in_word,catm.category_name,
					appmas.is_physically_challanged,appmas.is_minority_community,mcm.minority_community,appmas.hostel_facility,appmas.ap_resident,appmas.father_name,
					appmas.single_girl_child_flag,appmas.if_chronic_illness,appmas.chronic_illness,appmas.if_allergies,appmas.allergies,appmas.last_year_mark,
					appmas.last_school,appmas.other_university,bm.board_name,appmas.last_board,appmas.applicant_email,appmas.univ_regn_no,appmas.is_reserved_quota,
					appr.email_id,appmas.subject_offered1,appmas.subject_offered2,appmas.subject_offered3,appmas.subject_offered4,appmas.phtype,
					appmas.highest_qualification,hqm.qualification_name,subjects_offered,appmas.last_school,appmas.last_grade,appmas.adhar_no,appmas.physically_challenged,
					appmas.applied_program,appmas.exam_center_code,appmas.disability_percent,
					appmas.exam_center_code1,appmas.exam_center_code2,ex.exam_centre_name,ex1.exam_centre_name as exam_centre_name1,ex2.exam_centre_name as exam_centre_name2,
					appmas.is_north_east,appmas.north_east_state,appmas.category,appmas.guardian_name,appmas.father_occupation,appmas.annual_parent_income,appmas.is_employed,
					appmas.employer_add,appmas.employer_from,appmas.employer_to,appmas.completion_date,appmas.center_name1,appmas.center_name2,appmas.center_name3,appmas.master_name,
					appmas.mothers_name,appmas.mothers_profession,appmas.mothers_income,appmas.fathers_adhar_no,appmas.mothers_adhar_no,
					appmas.total_mark,appmas.secured_mark,appmas.distinction,appmas.course_type,appmas.is_kashmiri_migrant,appmas.is_ex_serviceman,appmas.is_sports,
					appmas.is_computer_education,appmas.other_computer,appmas.is_computer_type, 
					appmas.honours_total_mark,appmas.honours_secured_mark,appmas.other_subject,appmas.period_of_debar,date_format(appmas.date_of_debar,"%d-%m-%Y") as date_of_debar,
					appmas.name_of_post,date_format(appmas.govt_doj,"%d-%m-%Y") as govt_doj,appmas.name_of_office,appmas.any_disciplinary_action,appmas.district_code,
					appmas.honours_division,appmas.honours_subject,hons.subject_name,appmas.are_parents_alive,"" AS GSIGN,"" AS blood_group_name,"" AS mother_tongue,"" AS mode_of_transport, "" AS is_alumnus, "" AS alumnus_name, ""  AS alumnus_year_of_passing, "" AS is_staff,
					"" AS staff_name, "" AS is_general, "" AS caste_name ,appmas.informed_govt,ipm.id_proof_name,appmas.id_proof_number,pm.program_name,ex.exam_centre_name as exam_centre_detail');
				$this->db->from('applicant_master appmas');
				
				$this->db->join("applicant_appl_overview apovr",'appmas.reg_user_id=apovr.reg_user_id and appmas.applied_program=apovr.applied_program','left');
				$this->db->join("applicant_reg_master appr",'appmas.reg_user_id=appr.reg_user_id','left');
				$this->db->join("program_master pm",'appmas.applied_program = pm.program_code','left');
				$this->db->join("exam_centre ec",'ec.exam_centre_code=appmas.exam_center_code','left');
				$this->db->join("exam_centre ex",'ex.exam_centre_code=appmas.exam_center_code','left');
				$this->db->join("exam_centre ex1",'ex1.exam_centre_code=appmas.exam_center_code1','left');
				$this->db->join("exam_centre ex2",'ex2.exam_centre_code=appmas.exam_center_code2','left');
				$this->db->join("($subQuery1) userimg",'userimg.appl_no=apovr.appl_no','left');
				$this->db->join("($subQuery2) signature",'userimg.appl_no=apovr.appl_no','left');
				$this->db->join("gender_master gm",'gm.gender_code=appmas.gender','left');
				$this->db->join("nationality_master nm",'nm.nationality_code=appmas.nationality','left');
				$this->db->join("id_proof_master ipm",'appmas.id_proof=ipm.id_proof_code','left');
				$this->db->join("user_master um",'um.user_code=appr.updated_by','left');
				$this->db->join("category_master catm",'catm.category_code=appmas.category','left');
				$this->db->join("highest_qualification_master hqm",'appmas.highest_qualification = hqm.qualification_code','left');
				$this->db->join("minority_community_master mcm",'mcm.minority_community_code =appmas.minority_community_details','left');
				$this->db->join("board_master bm",'bm.board_code=appmas.last_board','left');
				$this->db->join("honours_subject_master hons",'appmas.honours_subject=hons.subject_code','left');
				$this->db->where('apovr.applied_program',$seladmcode);
				$this->db->where('appmas.applied_program',$seladmcode);
				$this->db->where('appmas.reg_user_id',$reg_user_id);
				$result = $this->db->get(); 
				/*echo $this->db->last_query();
				die();*/
				$applicant_detail = array();
				foreach($result->result_array() AS $row1)
				{
					$applicant_detail[]=$row1;
				}
				
				$application_data = array();
				$this->db->select('aplov.appl_no,pm.program_name,pm.elective_subjects,aplov.applied_program,aplov.index_no,pm.year');
				$this->db->from('applicant_appl_overview aplov');
				$this->db->join('program_master pm','pm.program_code=aplov.applied_program','left');
				$this->db->where('aplov.reg_user_id',$reg_user_id);
				$this->db->where('aplov.applied_program',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$application_data[]=$row1;
				}
				
				$applicant_father = array();
				$this->db->select('rel_name,rel_qualification,rel_occupation,rel_desig,nature_of_work,annual_income,place_work,email_id,res_no,mobile_no');
				$this->db->from('applicant_relation');
				$this->db->join('applicant_master','applicant_relation.reg_user_id=applicant_master.reg_user_id','left');
				$this->db->join('applicant_appl_overview apovr','applicant_master.reg_user_id=apovr.reg_user_id','left');
				$this->db->where('applicant_rel_flag',1);
				$this->db->where('applicant_relation.reg_user_id',$reg_user_id);
				$this->db->where('applicant_master.applied_program',$seladmcode);
				$this->db->where('applicant_relation.applied_program',$seladmcode);
				$this->db->where('apovr.applied_program',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$applicant_father[]=$row1;
				}
				
				$applicant_mother = array();
				$this->db->select('rel_name,rel_qualification,rel_occupation,rel_desig,nature_of_work,annual_income,place_work,email_id,res_no,mobile_no');
				$this->db->from('applicant_relation');
				$this->db->join('applicant_master','applicant_relation.reg_user_id=applicant_master.reg_user_id','left');
				$this->db->join('applicant_appl_overview apovr','applicant_master.reg_user_id=apovr.reg_user_id','left');
				$this->db->where('applicant_rel_flag',2);
				$this->db->where('applicant_relation.reg_user_id',$reg_user_id);
				$this->db->where('applicant_master.applied_program',$seladmcode);
				$this->db->where('applicant_relation.applied_program',$seladmcode);
				$this->db->where('apovr.applied_program',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$applicant_mother[]=$row1;
				}
				
				$qualification_detail = array();
				$this->db->select(' A.`qual_desc_1` AS qual_desc_1,qual_desc_2,other_stream,A.honours_subject,year_of_passing,university_board,division_distinction,mark_secured,full_mark,percentage_mark');
				$this->db->from('applicant_qualification_detail A');
				$this->db->join('applicant_master B','A.applied_program = B.applied_program AND A.reg_user_id = B.reg_user_id','inner');
				$this->db->where('A.reg_user_id',$reg_user_id);
				$this->db->where('A.applied_program',$program);
				$this->db->where('A.qual_desc_1 is not null');
				$this->db->order_by('A.id');
				//$this->db->order_by ('A.year_of_passing', "ASC");
				$result = $this->db->get();
				/*echo $this*/
				foreach($result->result_array() AS $row1)
				{
					$qualification_detail[]=$row1;
				}
				
				$fetchInst = array();
				$this->db->select('A.program_name,B.institute_name,A.department_name,A.institute_code,B.location,B.institute_address,B.logo_url');
				$this->db->from('program_master A');
				$this->db->join('institute_master B','A.institute_code=B.institute_code','inner');
				$this->db->where('A.program_code',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$fetchInst[]=$row1;
				}
				
				$addressDetail = array();
				$this->db->select('address_1,address_2,cand_name,co_name,city_name,post_office,panchayat,block,dm.district_name,sm.state_name,pin,applicant_address.district_code,applicant_address.state_code,distance_from');
				$this->db->from('applicant_address');
				$this->db->join('applicant_master appmas','applicant_address.address_ref_id=appmas.comm_address_ref_id','left');
				$this->db->join('applicant_appl_overview applov','applov.reg_user_id=appmas.reg_user_id','left');
				$this->db->join('district_master dm','dm.district_code=applicant_address.district_code','left');
				$this->db->join('state_master sm','sm.state_code=applicant_address.state_code','left');
				$this->db->where('applov.reg_user_id',$reg_user_id);
				$this->db->where('appmas.applied_program',$seladmcode);
				$this->db->where('applov.applied_program',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$addressDetail[]=$row1;
				}
				
				$addressDetail2 = array();
				$this->db->select('address_1,address_2,cand_name,co_name,city_name,post_office,panchayat,block,dm.district_name,sm.state_name,pin,applicant_address.district_code,applicant_address.state_code,distance_from,
								mobile');
				$this->db->from('applicant_address');
				$this->db->join('applicant_master appmas','applicant_address.address_ref_id=appmas.perm_address_ref_id','left');
				$this->db->join('applicant_appl_overview applov','applov.reg_user_id=appmas.reg_user_id','left');
				$this->db->join('district_master dm','dm.district_code=applicant_address.district_code','left');
				$this->db->join('state_master sm','sm.state_code=applicant_address.state_code','left');
				$this->db->where('applov.reg_user_id',$reg_user_id);
				$this->db->where('appmas.applied_program',$seladmcode);
				$this->db->where('applov.applied_program',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$addressDetail2[]=$row1;
				}
				
				$paymentDetail = array();
				$this->db->select('apov.money_deposit_mode,apov.amount,DATE_FORMAT(apov.depositdate,"%d-%m-%Y") AS depositdate,apov.money_receipt_no, apov.pg_charges');
				$this->db->from('applicant_form_fee_overview apov');
				$this->db->join('applicant_appl_overview','apov.appl_no=applicant_appl_overview.appl_no', 'left');
				$this->db->where('applicant_appl_overview.reg_user_id',$reg_user_id);
				$this->db->where('applicant_appl_overview.applied_program',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$paymentDetail[]=$row1;
				}
				$tech_qual_data_5 = array();
				$this->db->distinct("qual_desc_1,year,institute_name,thesis,stream,division,affiliation_from,applicant_technical_qualification_detail.subjects_offered,grade_cgpa");
				$this->db->select("qual_desc_1,year,institute_name,thesis,stream,division,affiliation_from,applicant_technical_qualification_detail.subjects_offered,grade_cgpa");
				$this->db->from('applicant_technical_qualification_detail');
				$this->db->join('applicant_master','applicant_master.reg_user_id = applicant_technical_qualification_detail.reg_user_id','inner');
				$this->db->where('applicant_technical_qualification_detail.applied_program',$seladmcode);
				$this->db->where('applicant_technical_qualification_detail.reg_user_id',$reg_user_id);
				$this->db->where('applicant_technical_qualification_detail.sl_no','5');
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$tech_qual_data_5[]=$row1;
				}
				$tech_qual_data_6 = array();
				$this->db->distinct("qual_desc_1,year,institute_name,thesis,stream,division,affiliation_from,applicant_technical_qualification_detail.subjects_offered,grade_cgpa");
				$this->db->select("qual_desc_1,year,institute_name,thesis,stream,division,affiliation_from,applicant_technical_qualification_detail.subjects_offered,grade_cgpa");
				$this->db->from('applicant_technical_qualification_detail');
				$this->db->join('applicant_master','applicant_master.reg_user_id = applicant_technical_qualification_detail.reg_user_id','inner');
				$this->db->where('applicant_technical_qualification_detail.applied_program',$seladmcode);
				$this->db->where('applicant_technical_qualification_detail.reg_user_id',$reg_user_id);
				$this->db->where('applicant_technical_qualification_detail.sl_no','6');
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$tech_qual_data_6[]=$row1;
				}
				
				$otherDetail = array();
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Permanent State');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$otherDetail[]=$row1;
				}
				
				$otherDistrict = array();
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Permanent District');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$otherDistrict[]=$row1;
				}
				
				$otherpresentstate = array();
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Present State');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$otherpresentstate[]=$row1;
				}
				
				$otherpresentdistrict = array();
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Present District');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$otherpresentdistrict[]=$row1;
				}
				
				$othernationality = array();
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Name of the Board');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$othernationality[]=$row1;
				}
				
				$applicant_documents = array();
				$this->db->select('afd.appl_no,doc_id,document_path,dtm.document_type');
				$this->db->from('applicant_form_documents afd');
				$this->db->join('applicant_appl_overview','afd.appl_no=applicant_appl_overview.appl_no','inner');
				$this->db->join('document_type_master dtm','afd.document_type = dtm.document_type_code','inner');
				$this->db->where('afd.status',1);
				$this->db->where('applicant_appl_overview.reg_user_id',$reg_user_id);
				$this->db->where('applicant_appl_overview.applied_program',$seladmcode);
				$this->db->where('dtm.document_type_code !=','PHO');
				$this->db->where('dtm.document_type_code !=','SIG');
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$applicant_documents[]=$row1;
				}
				/*$research_employment = array();
				$this->db->select('appo.applied_program,appo.reg_user_id,ared.organization,ared.post_held,ared.date_from,ared.date_to,ared.nature_of_job,ared.pay_band,ared.basic_pay');
				$this->db->from('applicant_research_experience_detail ared');
				$this->db->join('applicant_appl_overview appo','ared.applied_program = appo.applied_program  AND  ared.reg_user_id = appo.reg_user_id','inner');
				$this->db->join('program_master pm','appo.applied_program = pm.program_code ','inner');
				$this->db->where('appo.reg_user_id',$reg_user_id);
				$this->db->where('appo.applied_program',$program);
				$this->db->where('dtm.document_type_code !=','PHO');
				$this->db->where('dtm.document_type_code !=','SIG');
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$research_employment[]=$row1;
				}*/
				
				
				$this->db->select('appo.applied_program,appo.reg_user_id,ard.referenced_by,ard.contact_address,ard.email_id,ard.mobile_number');
				$this->db->from('applicant_reference_detail ard');
				$this->db->join('applicant_appl_overview appo','ard.applied_program = appo.applied_program  AND  ard.reg_user_id = appo.reg_user_id','inner');
				$this->db->join('program_master pm','appo.applied_program = pm.program_code ','inner');
				$this->db->where('appo.reg_user_id',$reg_user_id);
				$this->db->where('appo.applied_program',$program);
				$result = $this->db->get();
				$reference_details = array();
				foreach($result->result_array() AS $row1)
				{
					$reference_details[]=$row1;
				}
				$inst_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
				//$date = date('Y-m-d', now()); 
				$this->db->select("GROUP_CONCAT(IFNULL(course_name, '')) AS course_name");   
				//$this->db->select("course_name"); 
				$this->db->from('course_master');
				$this->db->join('course_details','course_master.course_code=course_details.course_code  AND course_master.program_code = course_details.prog_code','left'); 
				$this->db->where('inst_code',$inst_code);
				$this->db->where('prog_code',$program);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('course_master.record_status','1'); 
				$result = $this->db->get();
				$multiple_post = array();
				foreach($result->result_array() AS $row1)
				{
					$multiple_post[]=$row1;
				}
				//echo $this->db->last_query();die();
				
				//print_r($qualification_detail);die();
				//print_r($application_data);
				
				$selectedpost=$multiple_post[0]['course_name'];
				
				//print_r($qualification_detail);die();
				//print_r($application_data);
				$applicantNumber=$application_data[0]['appl_no'];
				$programName=htmlspecialchars_decode($application_data[0]['program_name']);
			    $programcode=$application_data[0]['applied_program'];
				$elective_subjects = $application_data[0]['elective_subjects'];
				$program_year = $application_data[0]['year'];
				$index_number = $application_data[0]['index_no'];
				
				$next_year = $program_year + 1;
				$next_year = substr($next_year, -2); 
				$session = $program_year.'-'.$next_year;
				$programName=htmlspecialchars_decode($application_data[0]['program_name']);
				
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============STUDENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				$examCenters=$applicant_detail[0]['exam_centre_name'];
				$regd_user_id=$applicant_detail[0]['reg_user_id'];
				$firstName=$applicant_detail[0]['first_name'];
				$midName=$applicant_detail[0]['mid_name'];
				$lastName=$applicant_detail[0]['last_name'];
				$fullName=$applicant_detail[0]['full_name'];
				$userPhoto=$applicant_detail[0]['passportphoto'];
				$app_email =$applicant_detail[0]['applicant_email'];
				$sign=$applicant_detail[0]['SIGN'];
				
				$program_name=$applicant_detail[0]['program_name'];
				
				$id_proof_number=$applicant_detail[0]['id_proof_number'];
				$id_proof_name=$applicant_detail[0]['id_proof_name'];
				
				//echo $master_name;
				$userSign = $sign;
				//$motherSign=$applicant_detail[0]['MSIGN'];
				$are_parents_alive=$applicant_detail[0]['are_parents_alive'];
				$guardianSign=$applicant_detail[0]['GSIGN'];
				$gender=$applicant_detail[0]['gender'];
				$reg_no = $applicant_detail[0]['univ_regn_no'];
				$reserved_quota = $applicant_detail[0]['is_reserved_quota'];
				$bloodgroup=$applicant_detail[0]['blood_group_name'];
				$mothertongue=$applicant_detail[0]['mother_tongue'];
				$transport=$applicant_detail[0]['mode_of_transport'];
				$is_kashmiri_migrant=$applicant_detail[0]['is_kashmiri_migrant'];
				$is_alumnus=$applicant_detail[0]['is_alumnus'];
				$alumnus=$applicant_detail[0]['alumnus_name'];
				$alumnus_year=$applicant_detail[0]['alumnus_year_of_passing'];
				$is_staff=$applicant_detail[0]['is_staff'];
				$staff=$applicant_detail[0]['staff_name'];
				$is_general=$applicant_detail[0]['is_general'];
				$qualifying_degree=$applicant_detail[0]['qualification_name'];
				$university_name=$applicant_detail[0]['last_school'];
				$other_university=$applicant_detail[0]['other_university'];
				$subject_offered1=$applicant_detail[0]['subject_offered1'];
				$subject_offered2=$applicant_detail[0]['subject_offered2'];
				$subject_offered3=$applicant_detail[0]['subject_offered3'];
				$subject_offered4=$applicant_detail[0]['subject_offered4'];
				$last_grade=$applicant_detail[0]['last_grade'];
				$caste=$applicant_detail[0]['caste_name'];
				$subject_name=$applicant_detail[0]['subject_name'];
				$nationality=$applicant_detail[0]['natinality'];
				$nationalityCode=$applicant_detail[0]['nationalitycode'];
				$adhar_no = $applicant_detail[0]['adhar_no'];
				$ap_resident = $applicant_detail[0]['ap_resident'];
				$physically_challenged = $applicant_detail[0]['physically_challenged'];
				$disability_percent = $applicant_detail[0]['disability_percent'];
				$phtype = $applicant_detail[0]['phtype'];
				$home_district = $applicant_detail[0]['district_code'];
				
				$applied_program = $applicant_detail[0]['applied_program'];
				$exam_center_code = $applicant_detail[0]['exam_center_code'];
				if($applicant_detail[0]['is_north_east'] == 'NO'){
					$north_east_state = $applicant_detail[0]['is_north_east'];
				}else{
					$north_east_state = $applicant_detail[0]['is_north_east'].','.$applicant_detail[0]['north_east_state'];
				}
				
				$category = $applicant_detail[0]['category'];
				$guardian_name = $applicant_detail[0]['guardian_name'];
				$father_occupation = $applicant_detail[0]['father_occupation'];
				$annual_parent_income = $applicant_detail[0]['annual_parent_income'];
				
				$mothers_name = $applicant_detail[0]['mothers_name'];
				$mothers_profession = $applicant_detail[0]['mothers_profession'];
				$mothers_income = isset($applicant_detail[0]['mothers_income'])?$applicant_detail[0]['mothers_income']:0;
				$fathers_adhar_no = $applicant_detail[0]['fathers_adhar_no'];
				$mothers_adhar_no = $applicant_detail[0]['mothers_adhar_no'];

				$is_employed = $applicant_detail[0]['is_employed'];
				$chkInformed = $applicant_detail[0]['informed_govt'];
				$empDisciplinary = $applicant_detail[0]['any_disciplinary_action'];
				/*die();*/
				$employer_add = $applicant_detail[0]['employer_add'];
				$employer_from = $applicant_detail[0]['employer_from'];
				$employer_to = $applicant_detail[0]['employer_to'];
				$completion_date = $applicant_detail[0]['completion_date'];

				$center_name1 = $applicant_detail[0]['exam_centre_name'];
				$center_name2 = $applicant_detail[0]['exam_centre_name1'];
				$center_name3 = $applicant_detail[0]['exam_centre_name2'];
				$center_code1 = $applicant_detail[0]['exam_center_code'];
				$center_code2 = $applicant_detail[0]['exam_center_code1'];
				$center_code3 = $applicant_detail[0]['exam_center_code2'];
				$master_name = $applicant_detail[0]['master_name'];
				$last_year_mark = $applicant_detail[0]['last_year_mark'];

				//echo $center_name1 .'k'.$center_code1;
				
				$dob=$applicant_detail[0]['dob'];
//				die();
				$split=explode("-",$dob);
				$year=$split[0];$month=$split[1];$date=$split[2];
				$exam_centre_detail=$applicant_detail[0]['exam_centre_detail'];
				$dobinWord=$applicant_detail[0]['dob_in_word'];
				$category=$applicant_detail[0]['category_name'];
				$hostel_facility=$applicant_detail[0]['hostel_facility'];
				$is_physically_challanged=$applicant_detail[0]['is_physically_challanged'];
				$is_minority_community=$applicant_detail[0]['is_minority_community'];
				$minority_community_details=$applicant_detail[0]['minority_community'];
				$marital_status=$applicant_detail[0]['marital_status'];
				$marital_status=$applicant_detail[0]['marital_status'];
				$single_girl_child_flag=$applicant_detail[0]['single_girl_child_flag'];
				$if_chronic_illness=$applicant_detail[0]['if_chronic_illness'];
				$chronic_illness=$applicant_detail[0]['chronic_illness'];
				$if_allergies=$applicant_detail[0]['if_allergies'];
				$allergies=$applicant_detail[0]['allergies'];
				$last_school=$applicant_detail[0]['last_school'];
				$last_board=$applicant_detail[0]['board_name'];
				$boardCode=$applicant_detail[0]['last_board'];
				$txtTotalMarks = $applicant_detail[0]['total_mark'];
				$txtSecuredMarks = $applicant_detail[0]['secured_mark'];
				$radioDistinction = $applicant_detail[0]['distinction'];
				$txtHonoursSubject = $applicant_detail[0]['honours_subject'];
				$other_subject = $applicant_detail[0]['other_subject'];
				$txtHonsTotalMarks = $applicant_detail[0]['honours_total_mark'];
				$txtHonsSecuredMarks = $applicant_detail[0]['honours_secured_mark'];
				$email_id = $applicant_detail[0]['email_id'];
				$othernationality = 'Non-Indian';
				if($university_name=='OTH')
				{
					$university_name = $other_university;
				}
				if($txtHonoursSubject=='OTH')
				{
					$subject_name = $other_subject;
				}
				if($nationalityCode=='OTH')
				{
					$actual_nationality = $othernationality;
				}
				else
				{
					$actual_nationality = $nationality;
				}
				
				if($master_name=="DPMT") 
				{
					$master_name="Diploma in Plastics Mould Technology";
				}

				if($master_name=="PGDPP") 
				{
					$master_name="Postgraduate Diploma in Plastics Processing & Testing";
				}
				if($master_name=="DPMD") 
				{
					$master_name="Post Diploma in Plastics Mould Design with CAD/CAM";
				}
				if($master_name=="DEPT") 
				{
					$master_name="Diploma in Plastics Technology";
				}
				if($master_name=="PGDPQ") 
				{
					$master_name="Postgraduate Diploma in Plastics Testing & Quality Control";
				}

				

				if($txtHonsTotalMarks == 0)
				{
					$txtHonsTotalMarks = '';
				}
				if($txtHonsSecuredMarks == '0.00')
				{
					$txtHonsSecuredMarks = '';
				}
				if($reserved_quota == 'No')
				{
					$actual_category = '';
				}
				else if($reserved_quota == 'Yes')
				{
					$actual_category = '( '.$category.' )';
				}
				
				
				$name_of_office = isset($applicant_detail[0]['name_of_office'])?$applicant_detail[0]['name_of_office']:'';
				$govt_doj = isset($applicant_detail[0]['govt_doj'])?$applicant_detail[0]['govt_doj']:'';
				$name_of_post = isset($applicant_detail[0]['name_of_post'])?$applicant_detail[0]['name_of_post']:'';
				$date_of_debar = isset($applicant_detail[0]['date_of_debar'])?$applicant_detail[0]['date_of_debar']:'';
				$period_of_debar = isset($applicant_detail[0]['period_of_debar'])?$applicant_detail[0]['period_of_debar']:'';
				$is_ex_seviceman = $applicant_detail[0]['is_ex_serviceman'];
				$is_sports = $applicant_detail[0]['is_sports'];
				$is_computer = $applicant_detail[0]['is_computer_education'];
				$other_computer = $applicant_detail[0]['other_computer'];
				$computer_type = $applicant_detail[0]['is_computer_type'];
				if($is_computer == 'Other')
				{
					$is_computer = $other_computer;
				}
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============STUDENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============INSTITURE DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				$txtHonsDivision = $applicant_detail[0]['honours_division'];
				$radioCourseType = $applicant_detail[0]['course_type'];
				$father_name=isset($applicant_father[0]['rel_name'])?$applicant_father[0]['rel_name']:'';
				$relNameM=isset($applicant_mother[0]['rel_name'])?$applicant_mother[0]['rel_name']:'';
				$institute_name = isset($fetchInst[0]['institute_name'])?$fetchInst[0]['institute_name']:'';
				$department_name = isset($fetchInst[0]['department_name'])?$fetchInst[0]['department_name']:'';
				$institute_code = isset($fetchInst[0]['institute_code'])?$fetchInst[0]['institute_code']:'';
				$institute_location = isset($fetchInst[0]['location'])?$fetchInst[0]['location']:'';
				$institute_address = isset($fetchInst[0]['institute_address'])?$fetchInst[0]['institute_address']:'';
				$logo = isset($fetchInst[0]['logo_url'])?$fetchInst[0]['logo_url']:'';  
				$program_name = isset($fetchInst[0]['program_name'])?$fetchInst[0]['program_name']:'';
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============INSTITURE DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PRESENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				$presentaddr1=isset($addressDetail[0]['address_1'])?$addressDetail[0]['address_1']:'';
				$presentaddr2=isset($addressDetail[0]['address_2'])?$addressDetail[0]['address_2']:'';

				$father_name=isset($applicant_detail[0]['father_name'])?$applicant_detail[0]['father_name']:'';
				$cand_name=isset($addressDetail[0]['cand_name'])?$addressDetail[0]['cand_name']:'';
				$co_name=isset($addressDetail[0]['co_name'])?$addressDetail[0]['co_name']:'';
				$city_name=isset($addressDetail[0]['city_name'])?$addressDetail[0]['city_name']:'';

				$presentpostoffice=isset($addressDetail[0]['post_office'])?$addressDetail[0]['post_office']:'';
				$presentpanchayat=isset($addressDetail[0]['panchayat'])?$addressDetail[0]['panchayat']:'';
				$presentblock=isset($addressDetail[0]['block'])?$addressDetail[0]['block']:'';
				$presentpostoffice=isset($addressDetail[0]['post_office'])?$addressDetail[0]['post_office']:'';
				$presentdistrictcode=isset($addressDetail[0]['district_name'])?$addressDetail[0]['district_name']:'';
				$presentstatecode=isset($addressDetail[0]['state_name'])?$addressDetail[0]['state_name']:'';
				$presentpin=isset($addressDetail[0]['pin'])?$addressDetail[0]['pin']:'';
				$presentdistance=isset($addressDetail[0]['distance_from'])?$addressDetail[0]['distance_from']:'';
				$chkpresentotherdistrict=isset($addressDetail[0]['district_code'])?$addressDetail[0]['district_code']:'';
				$chkpresentotherstate=isset($addressDetail[0]['state_code'])?$addressDetail[0]['state_code']:'';
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PRESENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PERMANENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				$permanentaddr1=isset($addressDetail2[0]['address_1'])?$addressDetail2[0]['address_1']:'';
				$permanentaddr2=isset($addressDetail2[0]['address_2'])?$addressDetail2[0]['address_2']:'';

				$cand_name1=isset($addressDetail2[0]['cand_name'])?$addressDetail2[0]['cand_name']:'';
				$co_name1=isset($addressDetail2[0]['co_name'])?$addressDetail2[0]['co_name']:'';
				$city_name1=isset($addressDetail2[0]['city_name'])?$addressDetail2[0]['city_name']:'';


				$permanentpostoffice=isset($addressDetail2[0]['post_office'])?$addressDetail2[0]['post_office']:'';
				$permanentpanchayat=isset($addressDetail2[0]['panchayat'])?$addressDetail2[0]['panchayat']:'';
				$permanentblock=isset($addressDetail2[0]['block'])?$addressDetail2[0]['block']:'';
				$permanentdistrictcode=isset($addressDetail2[0]['district_name'])?$addressDetail2[0]['district_name']:'';
				$permanentstatecode=isset($addressDetail2[0]['state_name'])?$addressDetail2[0]['state_name']:'';
				$permanentpin=isset($addressDetail2[0]['pin'])?$addressDetail2[0]['pin']:'';
				$permanentmobile=isset($addressDetail2[0]['mobile'])?$addressDetail2[0]['mobile']:'';
				$permanentdistance=isset($addressDetail2[0]['distance_from'])?$addressDetail2[0]['distance_from']:'';
				$chkpermanentotherdistrict=isset($addressDetail2[0]['district_code'])?$addressDetail2[0]['district_code']:'';
				$chkpermanentotherstate=isset($addressDetail2[0]['state_code'])?$addressDetail2[0]['state_code']:'';
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PERMANENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PAYMENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				$paymentMode=isset($paymentDetail[0]['money_deposit_mode'])?$paymentDetail[0]['money_deposit_mode']:'';
				$amountPaid=isset($paymentDetail[0]['amount'])?$paymentDetail[0]['amount']:'';
				$depositDate=isset($paymentDetail[0]['depositdate'])?$paymentDetail[0]['depositdate']:'';
				$transactionNo=isset($paymentDetail[0]['money_receipt_no'])?$paymentDetail[0]['money_receipt_no']:'';
				$pg_charges=isset($paymentDetail[0]['pg_charges'])?$paymentDetail[0]['pg_charges']:'0';
				$amountPaid = $amountPaid + $pg_charges;
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PAYMENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============OTHER DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				$otherpermanentstate = isset($otherDetail[0]['field_value'])?$otherDetail[0]['field_value']:'';
				$otherpermanentdistrict = isset($otherDistrict[0]['field_value'])?$otherDistrict[0]['field_value']:'';
				$otherpresentstate = isset($otherpresentstate[0]['field_value'])?$otherpresentstate[0]['field_value']:'';
				$otherpresentdistrict = isset($otherpresentdistrict[0]['field_value'])?$otherpresentdistrict[0]['field_value']:'';
				$othernationality = isset($othernationality[0]['field_value'])?$othernationality[0]['field_value']:'';
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============OTHER DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				
				$mSign = '';
			   	$fSign = '';
			   	$gSign = '';
			   	$userimg = '';   	
			   	$actual_category = '';
			   	$reg_user_id = '';
			   	$document_upload_url = '';
			   	$signature = '';
			   	$reg_user_id = $this->session->userdata('reg_user_id');
			   	//Logo
				if($userPhoto != '')
			    {
			      $arr = explode('/',$userPhoto);
			      $photo = end($arr);
			      $photo = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$programcode."/".$applicantNumber."/".$photo;
			    }
				if($userSign != '')
			    {
			      $arr = explode('/',$userSign);
			      $sign = end($arr);
			      $sign = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$programcode."/".$applicantNumber."/".$sign;
			    }
				if($physically_challenged == 'YES')
				{
					$physically_challenged = $physically_challenged.'( Type : '.$phtype.') (Percent :'.$disability_percent.')';
				}
				
					
			    $logo = base_url()."public/assets/images/$logo";//BROWSE LOGO
			    $header_logo = base_url()."public/assets/images/icon/Header for APSSB.png";
			    if($userPhoto != '' && file_exists ($photo ))
			      $userimg="$userPhoto";//BROWSE USER IMAGE
			    if($userSign != '' && file_exists ($sign ))
			      $signature="$userSign";//BROWSE USER SIGNATURE
				$date1 = $year.'-'.$month.'-'.$date;
				$age = (date('Y') - date('Y',strtotime($dob)));
				//$date1 = new DateTime($date1);
			$html = '';
			$html .= '<table width="100%" style="border-collapse: collapse;font-family:Arial;">
					<tr>
						<td>
						</td>
						<td colspan="2" style="text-align: right;">
							<b>Application No : </b>'.$applicantNumber.'
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td colspan="2" style="text-align: right;">
							<b>Mobile No : </b>'.$reg_user_id.'
						</td>
					</tr>
					
					<tr>
						
					</tr>
					
					
				</table>
				<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px; ">
				<tr >
					<br />
					<td width="38%" style="padding-left:10px;line-height:2;font-size:17px;">
						<b>Post Applied For</b> </td> 
					 <td width="5%">:</td> <td style = "font-size:17px;"width="45%"><b>'.$program_name.'</b></td> 
				</tr>
		</table>
				<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px; ">
						<tr >
							<td colspan="3" > <span style="font-size:17px;border-bottom:1px solid black;">Applicant\'s Information : </span></td>
						</tr>
						<tr>
						<td width="50%" style="padding-left:10px;line-height:2;">
							1. Applicant Name </td> <td width="5%">:</td> <td width="45%">'.$firstName.' '.$midName.' '.$lastName.'</td> 
							<td rowspan = "8" style="width:15%;text-align: center;">
								<img style="vertical-align: top" src="'.$userimg.'" width="100"  height="100" />
							</td>
						</tr>
					 	<tr>
					 	<td  colspan="3"></td></tr>
				 	
				 	
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						2. Father\'s/Husband\'s Name </td>
	                      <td>:</td> <td>'.$father_name.'</td>
	                     </tr>
	                     <tr><td colspan="3"></td></tr>
	                     
	                  
	                     
	                     <tr>
						 <td style="padding-left:10px;line-height:2;">
						3. Date of Birth</td> <td>:</td> <td>'.$date.'-'.$month.'-'.$year.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						4. Age (as on 01-12-2018)</td> <td>:</td> <td>'.$age.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						5. Gender</td> <td>:</td> <td>'.$gender.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						6. Marital Status</td> <td>:</td> <td>'.$marital_status.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						7. District Where Applicant is Residing</td> <td>:</td> <td>'.$home_district.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						8. Nationality</td> <td>:</td> <td>Indian</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
						
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						9. Category</td> <td>:</td> <td> '.$category.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
						
						<tr>
						 <td style="padding-left:10px;line-height:2;" >
						10.  Nationality </td> <td>:</td> <td>'.$actual_nationality.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						11. Email Id</td> <td>:</td> <td>'.$email_id.'</td> 
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
	                     
	                     <tr>
	                      <td style="padding-left:10px;line-height:2;">
						12. Belongs To PwD </td> <td>:</td> <td>'.$physically_challenged.'</td>
						</tr>
						
						<tr><td colspan="3"></td></tr>
						
						
						<tr><td colspan="3"></td></tr>
						<tr> 
						 <td>

								
					</table>
					
			<br>
			<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
			  <tr>
			   <td width="50%">
			<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
				<tr>
					<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;">Present Address : </span></td>
				</tr>
				
				 
				   <tr><td  colspan="3"></td></tr>
				    	 <tr><td  colspan="3"></td></tr>
					<tr>
					   
					    <td style="padding-left:10px;line-height:2;"> Locality/Street Name</td> <td>:</td> <td>'.$presentaddr1.'</td>
					    </tr>
					     <tr><td  colspan="3"></td></tr>
					    <tr>
						  <td style="padding-left:10px;line-height:2;">Post Office</td><td>:</td><td>'.$presentpostoffice.'</td>
						 </tr>
						  <tr><td  colspan="3"></td></tr> 
						  <tr>
						  <td style="padding-left:10px;line-height:2;">Gram Panchayat</td><td>:</td><td>'.$presentpanchayat.'</td>
						 </tr>
						  <tr><td  colspan="3"></td></tr> 
						  <tr>
						  <td style="padding-left:10px;line-height:2;">Block</td><td>:</td><td>'.$presentblock.'</td>
						 </tr>
						  <tr><td  colspan="3"></td></tr>
						 <tr>
	                   <td style="padding-left:10px;line-height:2;">City/Town</td> <td>:</td> <td>'.$city_name.'</td>
	                   </tr>
	                   
	                     <tr><td  colspan="3"></td></tr>
						<tr>
						 <td style="padding-left:10px;line-height:2;"> 
						 District </td> <td>:</td> <td>'.$presentdistrictcode.'</td> 
						 </tr>
						 
						 <tr>
						 <td style="padding-left:10px;line-height:2;">State</td> <td>:</td> <td>'.$presentstatecode.'</td>
						 </tr>
						   <tr><td  colspan="3"></td></tr>
						 <tr>
						 <td style="padding-left:10px;line-height:2;">
						 PIN </td> <td>:</td> <td>'.$presentpin.' </td> 
						 </tr>
						  <tr><td  colspan="3"></td></tr>
						  
					
			</table>
			 </td>
			<td width="50%" valign="top">
		<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
				<tr>
					<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;"> Permanent Address : </span></td>
				</tr>
				 
					<tr><td  colspan="3"></td></tr>
					 <tr><td  colspan="3"></td></tr>
					 <tr>
					    <td style="padding-left:10px;line-height:2;">Locality/Street Name</td> <td>:</td><td>'.$permanentaddr1.'</td>
					  </tr>
					  <tr><td  colspan="3"></td></tr>
					   <tr>
						<td style="padding-left:10px;line-height:2;">Post Office </td> <td>:</td> <td>'.$permanentpostoffice.'</td>
	                   </tr>
	                   <tr><td  colspan="3"></td></tr> 
	                   <tr>
						<td style="padding-left:10px;line-height:2;">Gram Panchayat </td> <td>:</td> <td>'.$permanentpanchayat.'</td>
	                   </tr>
	                   <tr><td  colspan="3"></td></tr> 
	                   <tr>
						<td style="padding-left:10px;line-height:2;">Block </td> <td>:</td> <td>'.$permanentblock.'</td>
	                   </tr>
	                   <tr><td  colspan="3"></td></tr>
	                   <tr>
						 <td style="padding-left:10px;line-height:2;">City/Town</td> <td>:</td> <td>'.$city_name1.'</td>
						</tr>
	                 <tr><td  colspan="3"></td></tr>
					 <tr>
					  <td style="padding-left:10px;line-height:2;">
						District</td>
						<td>:</td>
						<td>'.$permanentdistrictcode.' </td>
						</tr>
						<tr><td  colspan="3"></td></tr>
						<tr>
						<td style="padding-left:10px;line-height:2;">State </td> <td>:</td><td>'.$permanentstatecode.'</td>
						</tr>
						<tr><td  colspan="3"></td></tr>
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						PIN </td> <td>:</td><td>'.$permanentpin.'</td>
						</tr>
						
					
			</table>
			</td>
			</tr>
			</table>';
			
			$html .= '<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;">Educational Qualification</span> </td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
			<td colspan="5">
					<table width="100%" cellpadding="5" style="border-collapse: collapse;text-align:center;" border="1">
						<tr>
							<td style="text-align:center;width:20%;line-height:2;">Name Of The<br /> Examination passed  </td>
							<td style="text-align:center;width:10%;line-height:2;">Degree/Master in </td>
							<td style="text-align:center;width:10%;line-height:2;">Year Of Passing </td>
							<td style="text-align:center;width:15%;line-height:2;">Board/University</td>
							<td style="text-align:center;width:15%;line-height:2;">Total Marks (Excluding 4th Optional Mark)</td>
							<td style="text-align:center;width:15%;line-height:2;">Marks Secured (Excluding 4th Optional Mark)</td>
							<td style="text-align:center;width:15%;line-height:2;">% of Marks</td>
						</tr>';
		//print_r($qualification_detail)	; die();			
		
		foreach($qualification_detail as $row)
		{
			if($row['qual_desc_2'] == null || $row['qual_desc_2'] == '' || $row['qual_desc_2'] == 'NULL')
			{
				$qual_2 = '-';
			}
			else
			{
				$qual_2 = $row['qual_desc_2'];
			}
			if($row['other_stream'] == null || $row['other_stream'] == '' || $row['other_stream'] == 'NULL' )
			{
				$other_stream = $row['other_stream'];
			}
			else
			{
				$other_stream = ','.$row['other_stream'];
			}
			$html .='<tr>
				<td style ="width:20%;line-height:2;">'.$row['qual_desc_1'].'</td>
				<td style ="width:20%;line-height:2;">'.$qual_2.''.$other_stream.'</td>
				<td style ="width:10%;line-height:2;">'.$row['year_of_passing'].'</td>
				<td style ="width:20%;line-height:2;">'.$row['university_board'].'</td>										 
				<td style ="width:15%;line-height:2;">'.$row['full_mark'].'</td>
				<td style ="width:15%;line-height:2;">'.$row['mark_secured'].'</td>
				<td style ="width:10%;line-height:2;">'.$row['percentage_mark'].'</td>
				
			</tr>';
		}
		$html .= '</table>
				</td>
				<tr/>
			</table> <br/>';
			$html .=  '<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px; ">
					<tr>
						<td width="50%"> Computer Education(O Level/Other)</td>
						
						<td>:</td>
						<td>'.$is_computer.'</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td width="50%"> Ability to Type Odia Language in Computer </td>
						
						<td>:</td>
						<td>'.$computer_type.' </td>
					</tr>
					</table>
					<br/>';	
				
					$html .=  '<h3 style="text-align:center;text-decoration:underline;">Declaration</h3></br>';
					$html .=  'I do hereby declare that the information furnished above are true to the best of my knowledge and belief. I will be liable for false information and misrepresentation of facts foundif any susequently.<br/>';
					$html .=  '<img style="vertical-align: top ;margin-left:700px;" src="'.$signature.'" height="80" width="150" /><div style="text-align: right;vertical-align:middle;"><b>Signature of the candidate</b></div></br>';
					//$html .= sizeof($applicant_documents);
					if(sizeof($applicant_documents) >= 1)
					{
						$html .=  '<h3 style="text-align:center;text-decoration:underline;">Documents Uploaded</h3></br></br>';
					}
					
					$i=1;
					foreach($applicant_documents as $row){
						
						$html .=  $i.'.'.$row['document_type'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>';
						$i++;
					};
				return array('html' => $html);
			break;
			case 'preview_template004':
				$program_code = $this->session->userdata('admcode');
				$program = $this->session->userdata('admcode');
				$seladmcode = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$now = date("d-m-Y h:i A");
				$today = date("d-m-Y");
				
				$this->db->select('appl_no');
				$this->db->from('applicant_appl_overview aao');
				$this->db->where('applied_program',$seladmcode);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				$Result = $result->result_array();
				foreach($Result as $rrow){
					$applicantNumber = $rrow['appl_no'];
				}
				$this->session->set_userdata('appl_no',$applicantNumber);
				
				$this->db->select('photo.appl_no,photo.document_path AS passportphoto');
				$this->db->from('applicant_form_documents photo');
				$this->db->join('document_type_master doc', 'doc.document_type_code=photo.document_type', 'left');
				$this->db->where('photo.appl_no',$applicantNumber);
				$this->db->where('photo.document_type','PHO');
				$subQuery1 = $this->db->_compile_select();
				$this->db->_reset_select();
				
				$select =   array('photo.appl_no,photo.document_path AS SIGN');
				$this->db->select('photo.appl_no,photo.document_path AS SIGN');
				$this->db->from('applicant_form_documents photo');
				$this->db->join('document_type_master doc', 'doc.document_type_code=photo.document_type', 'left');
				$this->db->where('photo.appl_no',$applicantNumber);
				$this->db->where('photo.document_type','SIG');
				$subQuery2 = $this->db->_compile_select();
				$this->db->_reset_select();
				/*echo $this->db->last_query();
				die();*/
				
				// And now your main query

				$this->db->select('appmas.master_name,'.$reg_user_id.' as reg_user_id,appr.scrutiny_status,appr.scrutiny_remark,um.employee_name as scrutinised_by,date_format(appr.updated_on,"%d-%m-%Y %H:%i") as scrutinised_on,appmas.first_name,appmas.mid_name,appmas.last_name,appmas.full_name,ex.exam_centre_name,appmas.applicant_email,appmas.applicant_landline,appmas.applicant_mobile,appmas.marital_status,
					userimg.passportphoto,signature.SIGN,gm.gender,nm.nationality AS natinality,appmas.nationality AS nationalitycode,appr.dob,appmas.dob_in_word,catm.category_name,
					appmas.is_physically_challanged,appmas.is_minority_community,mcm.minority_community,appmas.hostel_facility,appmas.ap_resident,appmas.father_name,
					appmas.single_girl_child_flag,appmas.if_chronic_illness,appmas.chronic_illness,appmas.if_allergies,appmas.allergies,appmas.last_year_mark,
					appmas.last_school,appmas.other_university,bm.board_name,appmas.last_board,appmas.applicant_email,appmas.univ_regn_no,appmas.is_reserved_quota,appmas.dc_office,
					appr.email_id,appmas.subject_offered1,appmas.subject_offered2,appmas.subject_offered3,appmas.subject_offered4,gen.description,dm.dc_name,
					appmas.highest_qualification,hqm.qualification_name,subjects_offered,appmas.last_school,appmas.last_grade,appmas.adhar_no,appmas.physically_challenged,appmas.applied_program,appmas.exam_center_code,appmas.exam_center_code1,appmas.exam_center_code2,ex.exam_centre_name,ex1.exam_centre_name as exam_centre_name1,ex2.exam_centre_name as exam_centre_name2,appmas.is_north_east,appmas.north_east_state,appmas.category,appmas.guardian_name,appmas.father_occupation,appmas.annual_parent_income,appmas.is_employed,appmas.employer_add,appmas.employer_from,appmas.employer_to,appmas.completion_date,appmas.center_name1,appmas.center_name2,appmas.center_name3,appmas.master_name,appmas.mothers_name,appmas.mothers_profession,appmas.mothers_income,appmas.fathers_adhar_no,appmas.mothers_adhar_no,
					appmas.total_mark,appmas.secured_mark,appmas.distinction,appmas.course_type,appmas.is_kashmiri_migrant,appmas.is_ex_serviceman,appmas.is_sports,appmas.is_computer_education,
					appmas.honours_total_mark,appmas.honours_secured_mark,appmas.other_subject,appmas.period_of_debar,date_format(appmas.date_of_debar,"%d-%m-%Y") as date_of_debar,appmas.name_of_post,date_format(appmas.govt_doj,"%d-%m-%Y") as govt_doj,appmas.name_of_office,appmas.any_disciplinary_action,
					appmas.honours_division,appmas.honours_subject,hons.subject_name,appmas.are_parents_alive,"" AS GSIGN,"" AS blood_group_name,"" AS mother_tongue,"" AS mode_of_transport, "" AS is_alumnus, "" AS alumnus_name, ""  AS alumnus_year_of_passing, "" AS is_staff,
					"" AS staff_name, "" AS is_general, "" AS caste_name ,ipm.id_proof_name,appmas.id_proof_number,pm.program_name,ex.exam_centre_name as exam_centre_detail');
				$this->db->from('applicant_master appmas');
				$this->db->join("program_master pm",'appmas.applied_program = pm.program_code','inner');
				$this->db->join("applicant_appl_overview apovr",'appmas.reg_user_id=apovr.reg_user_id','left');
				$this->db->join("applicant_reg_master appr",'appmas.reg_user_id=appr.reg_user_id','left');
				$this->db->join("exam_centre ec",'ec.exam_centre_code=appmas.exam_center_code','left');
				$this->db->join("exam_centre_master ex",'ex.exam_centre_code=appmas.exam_center_code AND ex.program_code = appmas.applied_program','left');
				$this->db->join("exam_centre_master ex1",'ex1.exam_centre_code=appmas.exam_center_code1 AND ex1.program_code = appmas.applied_program','left');
				$this->db->join("exam_centre_master ex2",'ex2.exam_centre_code=appmas.exam_center_code2 AND ex2.program_code = appmas.applied_program','left');
				$this->db->join("($subQuery1) userimg",'userimg.appl_no=apovr.appl_no','left');
				$this->db->join("($subQuery2) signature",'userimg.appl_no=apovr.appl_no','left');
				$this->db->join("gender_master gm",'gm.gender_code=appmas.gender','left');
				$this->db->join("dc_master dm",'dm.dc_code=appmas.dc_office','left');
				$this->db->join("nationality_master nm",'nm.nationality_code=appmas.nationality','left');
				$this->db->join("id_proof_master ipm",'appmas.id_proof=ipm.id_proof_code','left');
				$this->db->join("user_master um",'um.user_code=appr.updated_by','left');
				$this->db->join("category_master catm",'catm.category_code=appmas.category','left');
				$this->db->join("gen_code_description gen",'gen.code=appmas.phtype','left');
				$this->db->join("highest_qualification_master hqm",'appmas.highest_qualification = hqm.qualification_code','left');
				$this->db->join("minority_community_master mcm",'mcm.minority_community_code =appmas.minority_community_details','left');
				$this->db->join("board_master bm",'bm.board_code=appmas.last_board','left');
				$this->db->join("honours_subject_master hons",'appmas.honours_subject=hons.subject_code','left');
				$this->db->where('apovr.applied_program',$seladmcode);
				$this->db->where('appmas.applied_program',$seladmcode);
				$this->db->where('appmas.reg_user_id',$reg_user_id);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$applicant_detail = array();
				foreach($result->result_array() AS $row1)
				{
					$applicant_detail[]=$row1;
				}
				
				$application_data = array();
				$this->db->select('aplov.appl_no,pm.program_name,pm.elective_subjects,aplov.applied_program,aplov.index_no,pm.year');
				$this->db->from('applicant_appl_overview aplov');
				$this->db->join('program_master pm','pm.program_code=aplov.applied_program','left');
				$this->db->where('aplov.reg_user_id',$reg_user_id);
				$this->db->where('aplov.applied_program',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$application_data[]=$row1;
				}
				
				$applicant_father = array();
				$this->db->select('rel_name,rel_qualification,rel_occupation,rel_desig,nature_of_work,annual_income,place_work,email_id,res_no,mobile_no');
				$this->db->from('applicant_relation');
				$this->db->join('applicant_master','applicant_relation.reg_user_id=applicant_master.reg_user_id','left');
				$this->db->join('applicant_appl_overview apovr','applicant_master.reg_user_id=apovr.reg_user_id','left');
				$this->db->where('applicant_rel_flag',1);
				$this->db->where('applicant_relation.reg_user_id',$reg_user_id);
				$this->db->where('applicant_master.applied_program',$seladmcode);
				$this->db->where('applicant_relation.applied_program',$seladmcode);
				$this->db->where('apovr.applied_program',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$applicant_father[]=$row1;
				}
				
				$applicant_mother = array();
				$this->db->select('rel_name,rel_qualification,rel_occupation,rel_desig,nature_of_work,annual_income,place_work,email_id,res_no,mobile_no');
				$this->db->from('applicant_relation');
				$this->db->join('applicant_master','applicant_relation.reg_user_id=applicant_master.reg_user_id','left');
				$this->db->join('applicant_appl_overview apovr','applicant_master.reg_user_id=apovr.reg_user_id','left');
				$this->db->where('applicant_rel_flag',2);
				$this->db->where('applicant_relation.reg_user_id',$reg_user_id);
				$this->db->where('applicant_master.applied_program',$seladmcode);
				$this->db->where('applicant_relation.applied_program',$seladmcode);
				$this->db->where('apovr.applied_program',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$applicant_mother[]=$row1;
				}
				
				$qualification_detail = array();
				$this->db->select(' A.`qual_desc_1` AS qual_desc_1,qual_desc_2,other_stream,A.honours_subject,year_of_passing,university_board,division_distinction,mark_secured,full_mark,percentage_mark');
				$this->db->from('applicant_qualification_detail A');
				$this->db->join('applicant_master B','A.applied_program = B.applied_program AND A.reg_user_id = B.reg_user_id','inner');
				$this->db->where('A.reg_user_id',$reg_user_id);
				$this->db->where('A.applied_program',$program);
				$this->db->where('A.qual_desc_1 is not null');
				$this->db->order_by('A.id');
				//$this->db->order_by ('A.year_of_passing', "ASC");
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$qualification_detail[]=$row1;
				}
				
				$fetchInst = array();
				$this->db->select('A.program_name,B.institute_name,A.department_name,A.institute_code,B.location,B.institute_address,B.logo_url');
				$this->db->from('program_master A');
				$this->db->join('institute_master B','A.institute_code=B.institute_code','inner');
				$this->db->where('A.program_code',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$fetchInst[]=$row1;
				}
				
				$addressDetail = array();
				$this->db->select('address_1,address_2,cand_name,co_name,city_name,post_office,dm.district_name,sm.state_name,pin,applicant_address.district_code,applicant_address.state_code,distance_from');
				$this->db->from('applicant_address');
				$this->db->join('applicant_master appmas','applicant_address.address_ref_id=appmas.comm_address_ref_id','left');
				$this->db->join('applicant_appl_overview applov','applov.reg_user_id=appmas.reg_user_id','left');
				$this->db->join('district_master dm','dm.district_code=applicant_address.district_code','left');
				$this->db->join('state_master sm','sm.state_code=applicant_address.state_code','left');
				$this->db->where('applov.reg_user_id',$reg_user_id);
				$this->db->where('appmas.applied_program',$seladmcode);
				$this->db->where('applov.applied_program',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$addressDetail[]=$row1;
				}
				
				$addressDetail2 = array();
				$this->db->select('address_1,address_2,cand_name,co_name,city_name,post_office,dm.district_name,sm.state_name,pin,applicant_address.district_code,applicant_address.state_code,distance_from,
								mobile');
				$this->db->from('applicant_address');
				$this->db->join('applicant_master appmas','applicant_address.address_ref_id=appmas.perm_address_ref_id','left');
				$this->db->join('applicant_appl_overview applov','applov.reg_user_id=appmas.reg_user_id','left');
				$this->db->join('district_master dm','dm.district_code=applicant_address.district_code','left');
				$this->db->join('state_master sm','sm.state_code=applicant_address.state_code','left');
				$this->db->where('applov.reg_user_id',$reg_user_id);
				$this->db->where('appmas.applied_program',$seladmcode);
				$this->db->where('applov.applied_program',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$addressDetail2[]=$row1;
				}
				
				$paymentDetail = array();
				$this->db->select('apov.money_deposit_mode,apov.amount,DATE_FORMAT(apov.depositdate,"%d-%m-%Y") AS depositdate,apov.money_receipt_no, apov.pg_charges');
				$this->db->from('applicant_form_fee_overview apov');
				$this->db->join('applicant_appl_overview','apov.appl_no=applicant_appl_overview.appl_no', 'left');
				$this->db->where('applicant_appl_overview.reg_user_id',$reg_user_id);
				$this->db->where('applicant_appl_overview.applied_program',$seladmcode);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$paymentDetail[]=$row1;
				}
				$tech_qual_data_5 = array();
				$this->db->distinct("qual_desc_1,year,institute_name,division,thesis,stream,affiliation_from,applicant_technical_qualification_detail.subjects_offered,grade_cgpa");
				$this->db->select("qual_desc_1,year,institute_name,division,thesis,stream,affiliation_from,applicant_technical_qualification_detail.subjects_offered,grade_cgpa");
				$this->db->from('applicant_technical_qualification_detail');
				$this->db->join('applicant_master','applicant_master.reg_user_id = applicant_technical_qualification_detail.reg_user_id','inner');
				$this->db->where('applicant_technical_qualification_detail.applied_program',$seladmcode);
				$this->db->where('applicant_technical_qualification_detail.reg_user_id',$reg_user_id);
				$this->db->where('applicant_technical_qualification_detail.sl_no','5');
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$tech_qual_data_5[]=$row1;
				}
				$tech_qual_data_6 = array();
				$this->db->distinct("qual_desc_1,year,institute_name,division,thesis,stream,affiliation_from,applicant_technical_qualification_detail.subjects_offered,grade_cgpa");
				$this->db->select("qual_desc_1,year,institute_name,division,thesis,stream,affiliation_from,applicant_technical_qualification_detail.subjects_offered,grade_cgpa");
				$this->db->from('applicant_technical_qualification_detail');
				$this->db->join('applicant_master','applicant_master.reg_user_id = applicant_technical_qualification_detail.reg_user_id','inner');
				$this->db->where('applicant_technical_qualification_detail.applied_program',$seladmcode);
				$this->db->where('applicant_technical_qualification_detail.reg_user_id',$reg_user_id);
				$this->db->where('applicant_technical_qualification_detail.sl_no','6');
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$tech_qual_data_6[]=$row1;
				}
				
				$otherDetail = array();
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Permanent State');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$otherDetail[]=$row1;
				}
				
				$otherDistrict = array();
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Permanent District');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$otherDistrict[]=$row1;
				}
				
				$otherpresentstate = array();
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Present State');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$otherpresentstate[]=$row1;
				}
				
				$otherpresentdistrict = array();
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Present District');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$otherpresentdistrict[]=$row1;
				}
				
				$othernationality = array();
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Name of the Board');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$othernationality[]=$row1;
				}
				
				$applicant_documents = array();
				$this->db->select('afd.appl_no,doc_id,document_path,dtm.document_type');
				$this->db->from('applicant_form_documents afd');
				$this->db->join('applicant_appl_overview','afd.appl_no=applicant_appl_overview.appl_no','inner');
				$this->db->join('document_type_master dtm','afd.document_type = dtm.document_type_code','inner');
				$this->db->where('afd.status',1);
				$this->db->where('applicant_appl_overview.reg_user_id',$reg_user_id);
				$this->db->where('applicant_appl_overview.applied_program',$seladmcode);
				$this->db->where('dtm.document_type_code !=','PHO');
				$this->db->where('dtm.document_type_code !=','SIG');
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$applicant_documents[]=$row1;
				}
				$research_employment = array();
				$this->db->select('appo.applied_program,appo.reg_user_id,ared.organization,ared.post_held,ared.date_from,ared.date_to,ared.nature_of_job,ared.pay_band,ared.basic_pay');
				$this->db->from('applicant_research_experience_detail ared');
				$this->db->join('applicant_appl_overview appo','ared.applied_program = appo.applied_program  AND  ared.reg_user_id = appo.reg_user_id','inner');
				$this->db->join('program_master pm','appo.applied_program = pm.program_code ','inner');
				$this->db->where('appo.reg_user_id',$reg_user_id);
				$this->db->where('appo.applied_program',$program);
				$result = $this->db->get();
				foreach($result->result_array() AS $row1)
				{
					$research_employment[]=$row1;
				}
				
				
				$this->db->select('appo.applied_program,appo.reg_user_id,ard.referenced_by,ard.contact_address,ard.email_id,ard.mobile_number');
				$this->db->from('applicant_reference_detail ard');
				$this->db->join('applicant_appl_overview appo','ard.applied_program = appo.applied_program  AND  ard.reg_user_id = appo.reg_user_id','inner');
				$this->db->join('program_master pm','appo.applied_program = pm.program_code ','inner');
				$this->db->where('appo.reg_user_id',$reg_user_id);
				$this->db->where('appo.applied_program',$program);
				$result = $this->db->get();
				$reference_details = array();
				foreach($result->result_array() AS $row1)
				{
					$reference_details[]=$row1;
				}
				$inst_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
				//$date = date('Y-m-d', now()); 
				$this->db->select("GROUP_CONCAT(IFNULL(course_name, '')) AS course_name");   
				//$this->db->select("course_name"); 
				$this->db->from('course_master');
				$this->db->join('course_details','course_master.course_code=course_details.course_code  AND course_master.program_code = course_details.prog_code','left'); 
				$this->db->where('inst_code',$inst_code);
				$this->db->where('prog_code',$program);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('course_master.record_status','1'); 
				$result = $this->db->get();
				$multiple_post = array();
				foreach($result->result_array() AS $row1)
				{
					$multiple_post[]=$row1;
				}
				//echo $this->db->last_query();die();
				
				//print_r($qualification_detail);die();
				//print_r($application_data);
				
				$selectedpost=$multiple_post[0]['course_name'];//echo $selectedpost;die();  
	
				$applicantNumber=$application_data[0]['appl_no'];
				$programName=htmlspecialchars_decode($application_data[0]['program_name']);
			    $programcode=$application_data[0]['applied_program'];
				$elective_subjects = $application_data[0]['elective_subjects'];
				$program_year = $application_data[0]['year'];
				$index_number = $application_data[0]['index_no'];
				
				$next_year = $program_year + 1;
				$next_year = substr($next_year, -2); 
				$session = $program_year.'-'.$next_year;
				$programName=htmlspecialchars_decode($application_data[0]['program_name']);
				
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============STUDENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				$examCenters=$applicant_detail[0]['exam_centre_name'];
				$regd_user_id=$applicant_detail[0]['reg_user_id'];
				$firstName=$applicant_detail[0]['first_name'];
				$midName=$applicant_detail[0]['mid_name'];
				$lastName=$applicant_detail[0]['last_name'];
				$fullName=$applicant_detail[0]['full_name'];
				$userPhoto=$applicant_detail[0]['passportphoto'];
				$app_email =$applicant_detail[0]['applicant_email'];
				$sign=$applicant_detail[0]['SIGN'];
				
				$program_name=$applicant_detail[0]['program_name'];
				
				$id_proof_number=$applicant_detail[0]['id_proof_number'];
				$id_proof_name=$applicant_detail[0]['id_proof_name'];
				$father_name=isset($applicant_detail[0]['father_name'])?$applicant_detail[0]['father_name']:'';
				//echo $master_name;
				$userSign = $sign;
				//$motherSign=$applicant_detail[0]['MSIGN'];
				$are_parents_alive=$applicant_detail[0]['are_parents_alive'];
				$guardianSign=$applicant_detail[0]['GSIGN'];
				$gender=$applicant_detail[0]['gender'];
				$reg_no = $applicant_detail[0]['univ_regn_no'];
				$reserved_quota = $applicant_detail[0]['is_reserved_quota'];
				$bloodgroup=$applicant_detail[0]['blood_group_name'];
				$mothertongue=$applicant_detail[0]['mother_tongue'];
				$transport=$applicant_detail[0]['mode_of_transport'];
				$is_kashmiri_migrant=$applicant_detail[0]['is_kashmiri_migrant'];
				$is_alumnus=$applicant_detail[0]['is_alumnus'];
				$alumnus=$applicant_detail[0]['alumnus_name'];
				$alumnus_year=$applicant_detail[0]['alumnus_year_of_passing'];
				$is_staff=$applicant_detail[0]['is_staff'];
				$staff=$applicant_detail[0]['staff_name'];
				$is_general=$applicant_detail[0]['is_general'];
				$qualifying_degree=$applicant_detail[0]['qualification_name'];
				$university_name=$applicant_detail[0]['last_school'];
				$other_university=$applicant_detail[0]['other_university'];
				$subject_offered1=$applicant_detail[0]['subject_offered1'];
				$subject_offered2=$applicant_detail[0]['subject_offered2'];
				$subject_offered3=$applicant_detail[0]['subject_offered3'];
				$subject_offered4=$applicant_detail[0]['subject_offered4'];
				$last_grade=$applicant_detail[0]['last_grade'];
				$caste=$applicant_detail[0]['caste_name'];
				$subject_name=$applicant_detail[0]['subject_name'];
				$nationality=$applicant_detail[0]['natinality'];
				$nationalityCode=$applicant_detail[0]['nationalitycode'];
				$adhar_no = $applicant_detail[0]['adhar_no'];
				$ap_resident = $applicant_detail[0]['ap_resident'];

				$physically_challenged = $applicant_detail[0]['physically_challenged'];
				$phtype = $applicant_detail[0]['description'];
				$applied_program = $applicant_detail[0]['applied_program'];
				$exam_center_code = $applicant_detail[0]['exam_center_code'];
				if($applicant_detail[0]['is_north_east'] == 'NO'){
					$north_east_state = $applicant_detail[0]['is_north_east'];
				}else{
					$north_east_state = $applicant_detail[0]['is_north_east'].','.$applicant_detail[0]['north_east_state'];
				}
				
				$category = $applicant_detail[0]['category'];
				$guardian_name = $applicant_detail[0]['guardian_name'];
				$father_occupation = $applicant_detail[0]['father_occupation'];
				$annual_parent_income = $applicant_detail[0]['annual_parent_income'];
				
				$mothers_name = $applicant_detail[0]['mothers_name'];
				$mothers_profession = $applicant_detail[0]['mothers_profession'];
				$mothers_income = isset($applicant_detail[0]['mothers_income'])?$applicant_detail[0]['mothers_income']:0;
				$fathers_adhar_no = $applicant_detail[0]['fathers_adhar_no'];
				$mothers_adhar_no = $applicant_detail[0]['mothers_adhar_no'];

				$is_employed = $applicant_detail[0]['is_employed'];
				$empDisciplinary = $applicant_detail[0]['any_disciplinary_action'];
				/*die();*/
				$employer_add = $applicant_detail[0]['employer_add'];
				$employer_from = $applicant_detail[0]['employer_from'];
				$employer_to = $applicant_detail[0]['employer_to'];
				$completion_date = $applicant_detail[0]['completion_date'];

				$center_name1 = $applicant_detail[0]['exam_centre_name'];
				$center_name2 = $applicant_detail[0]['exam_centre_name1'];
				$center_name3 = $applicant_detail[0]['exam_centre_name2'];
				$center_code1 = $applicant_detail[0]['exam_center_code'];
				$center_code2 = $applicant_detail[0]['exam_center_code1'];
				$center_code3 = $applicant_detail[0]['exam_center_code2'];
				$master_name = $applicant_detail[0]['master_name'];
				$last_year_mark = $applicant_detail[0]['last_year_mark'];

				//echo $center_name1 .'k'.$center_code1;
				
				$dob=$applicant_detail[0]['dob'];
//				die();
				$split=explode("-",$dob);
				$year=$split[0];$month=$split[1];$date=$split[2];
				$exam_centre_detail=$applicant_detail[0]['exam_centre_detail'];
				$dobinWord=$applicant_detail[0]['dob_in_word'];
				$category=$applicant_detail[0]['category_name'];
				$hostel_facility=$applicant_detail[0]['hostel_facility'];
				$is_physically_challanged=$applicant_detail[0]['is_physically_challanged'];
				$is_minority_community=$applicant_detail[0]['is_minority_community'];
				$minority_community_details=$applicant_detail[0]['minority_community'];
				$marital_status=$applicant_detail[0]['marital_status'];
				$single_girl_child_flag=$applicant_detail[0]['single_girl_child_flag'];
				$if_chronic_illness=$applicant_detail[0]['if_chronic_illness'];
				$chronic_illness=$applicant_detail[0]['chronic_illness'];
				$if_allergies=$applicant_detail[0]['if_allergies'];
				$allergies=$applicant_detail[0]['allergies'];
				$last_school=$applicant_detail[0]['last_school'];
				$last_board=$applicant_detail[0]['board_name'];
				$boardCode=$applicant_detail[0]['last_board'];
				$txtTotalMarks = $applicant_detail[0]['total_mark'];
				$txtSecuredMarks = $applicant_detail[0]['secured_mark'];
				$radioDistinction = $applicant_detail[0]['distinction'];
				$txtHonoursSubject = $applicant_detail[0]['honours_subject'];
				$other_subject = $applicant_detail[0]['other_subject'];
				$txtHonsTotalMarks = $applicant_detail[0]['honours_total_mark'];
				$txtHonsSecuredMarks = $applicant_detail[0]['honours_secured_mark'];
				$email_id = $applicant_detail[0]['email_id'];
				$othernationality = 'Non-Indian';
				if($university_name=='OTH')
				{
					$university_name = $other_university;
				}
				if($txtHonoursSubject=='OTH')
				{
					$subject_name = $other_subject;
				}
				if($nationalityCode=='OTH')
				{
					$actual_nationality = $othernationality;
				}
				else
				{
					$actual_nationality = $nationality;
				}
				
				if($master_name=="DPMT") 
				{
					$master_name="Diploma in Plastics Mould Technology";
				}

				if($master_name=="PGDPP") 
				{
					$master_name="Postgraduate Diploma in Plastics Processing & Testing";
				}
				if($master_name=="DPMD") 
				{
					$master_name="Post Diploma in Plastics Mould Design with CAD/CAM";
				}
				if($master_name=="DEPT") 
				{
					$master_name="Diploma in Plastics Technology";
				}
				if($master_name=="PGDPQ") 
				{
					$master_name="Postgraduate Diploma in Plastics Testing & Quality Control";
				}

				

				if($txtHonsTotalMarks == 0)
				{
					$txtHonsTotalMarks = '';
				}
				if($txtHonsSecuredMarks == '0.00')
				{
					$txtHonsSecuredMarks = '';
				}
				if($reserved_quota == 'No')
				{
					$actual_category = '';
				}
				else if($reserved_quota == 'Yes')
				{
					$actual_category = '( '.$category.' )';
				}
				
				
				$name_of_office = isset($applicant_detail[0]['name_of_office'])?$applicant_detail[0]['name_of_office']:'';
				$govt_doj = isset($applicant_detail[0]['govt_doj'])?$applicant_detail[0]['govt_doj']:'';
				$name_of_post = isset($applicant_detail[0]['name_of_post'])?$applicant_detail[0]['name_of_post']:'';
				$date_of_debar = isset($applicant_detail[0]['date_of_debar'])?$applicant_detail[0]['date_of_debar']:'';
				$period_of_debar = isset($applicant_detail[0]['period_of_debar'])?$applicant_detail[0]['period_of_debar']:'';
				$is_ex_seviceman = $applicant_detail[0]['is_ex_serviceman'];
				$is_sports = $applicant_detail[0]['is_sports'];
				$is_computer = $applicant_detail[0]['is_computer_education'];
				/*$dc_office = $applicant_detail[0]['dc_office'];*/
				$dc_office = $applicant_detail[0]['dc_name'];
				
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============STUDENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============INSTITURE DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				$txtHonsDivision = $applicant_detail[0]['honours_division'];
				$radioCourseType = $applicant_detail[0]['course_type'];
				$father_name=isset($applicant_father[0]['rel_name'])?$applicant_father[0]['rel_name']:$father_name;
				$relNameM=isset($applicant_mother[0]['rel_name'])?$applicant_mother[0]['rel_name']:'';
				$institute_name = isset($fetchInst[0]['institute_name'])?$fetchInst[0]['institute_name']:'';
				$department_name = isset($fetchInst[0]['department_name'])?$fetchInst[0]['department_name']:'';
				$institute_code = isset($fetchInst[0]['institute_code'])?$fetchInst[0]['institute_code']:'';
				$institute_location = isset($fetchInst[0]['location'])?$fetchInst[0]['location']:'';
				$institute_address = isset($fetchInst[0]['institute_address'])?$fetchInst[0]['institute_address']:'';
				$logo = isset($fetchInst[0]['logo_url'])?$fetchInst[0]['logo_url']:'';
				$program_name = isset($fetchInst[0]['program_name'])?$fetchInst[0]['program_name']:'';
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============INSTITURE DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PRESENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				$presentaddr1=isset($addressDetail[0]['address_1'])?$addressDetail[0]['address_1']:'';
				$presentaddr2=isset($addressDetail[0]['address_2'])?$addressDetail[0]['address_2']:'';

				$cand_name=isset($addressDetail[0]['cand_name'])?$addressDetail[0]['cand_name']:'';
				$co_name=isset($addressDetail[0]['co_name'])?$addressDetail[0]['co_name']:'';
				$city_name=isset($addressDetail[0]['city_name'])?$addressDetail[0]['city_name']:'';

				$presentpostoffice=isset($addressDetail[0]['post_office'])?$addressDetail[0]['post_office']:'';
				$presentdistrictcode=isset($addressDetail[0]['district_name'])?$addressDetail[0]['district_name']:'';
				$presentstatecode=isset($addressDetail[0]['state_name'])?$addressDetail[0]['state_name']:'';
				$presentpin=isset($addressDetail[0]['pin'])?$addressDetail[0]['pin']:'';
				$presentdistance=isset($addressDetail[0]['distance_from'])?$addressDetail[0]['distance_from']:'';
				$chkpresentotherdistrict=isset($addressDetail[0]['district_code'])?$addressDetail[0]['district_code']:'';
				$chkpresentotherstate=isset($addressDetail[0]['state_code'])?$addressDetail[0]['state_code']:'';
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PRESENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PERMANENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				$permanentaddr1=isset($addressDetail2[0]['address_1'])?$addressDetail2[0]['address_1']:'';
				$permanentaddr2=isset($addressDetail2[0]['address_2'])?$addressDetail2[0]['address_2']:'';

				$cand_name1=isset($addressDetail2[0]['cand_name'])?$addressDetail2[0]['cand_name']:'';
				$co_name1=isset($addressDetail2[0]['co_name'])?$addressDetail2[0]['co_name']:'';
				$city_name1=isset($addressDetail2[0]['city_name'])?$addressDetail2[0]['city_name']:'';


				$permanentpostoffice=isset($addressDetail2[0]['post_office'])?$addressDetail2[0]['post_office']:'';
				$permanentdistrictcode=isset($addressDetail2[0]['district_name'])?$addressDetail2[0]['district_name']:'';
				$permanentstatecode=isset($addressDetail2[0]['state_name'])?$addressDetail2[0]['state_name']:'';
				$permanentpin=isset($addressDetail2[0]['pin'])?$addressDetail2[0]['pin']:'';
				$permanentmobile=isset($addressDetail2[0]['mobile'])?$addressDetail2[0]['mobile']:'';
				$permanentdistance=isset($addressDetail2[0]['distance_from'])?$addressDetail2[0]['distance_from']:'';
				$chkpermanentotherdistrict=isset($addressDetail2[0]['district_code'])?$addressDetail2[0]['district_code']:'';
				$chkpermanentotherstate=isset($addressDetail2[0]['state_code'])?$addressDetail2[0]['state_code']:'';
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PERMANENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PAYMENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				$paymentMode=isset($paymentDetail[0]['money_deposit_mode'])?$paymentDetail[0]['money_deposit_mode']:'';
				$amountPaid=isset($paymentDetail[0]['amount'])?$paymentDetail[0]['amount']:'';
				$depositDate=isset($paymentDetail[0]['depositdate'])?$paymentDetail[0]['depositdate']:'';
				$transactionNo=isset($paymentDetail[0]['money_receipt_no'])?$paymentDetail[0]['money_receipt_no']:'';
				$pg_charges=isset($paymentDetail[0]['pg_charges'])?$paymentDetail[0]['pg_charges']:'0';
				$amountPaid = $amountPaid + $pg_charges;
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PAYMENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============OTHER DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				$otherpermanentstate = isset($otherDetail[0]['field_value'])?$otherDetail[0]['field_value']:'';
				$otherpermanentdistrict = isset($otherDistrict[0]['field_value'])?$otherDistrict[0]['field_value']:'';
				$otherpresentstate = isset($otherpresentstate[0]['field_value'])?$otherpresentstate[0]['field_value']:'';
				$otherpresentdistrict = isset($otherpresentdistrict[0]['field_value'])?$otherpresentdistrict[0]['field_value']:'';
				$othernationality = isset($othernationality[0]['field_value'])?$othernationality[0]['field_value']:'';
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============OTHER DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				
				$mSign = '';
			   	$fSign = '';
			   	$gSign = '';
			   	$userimg = '';   	
			   	$actual_category = '';
			   	$reg_user_id = '';
			   	$document_upload_url = '';
			   	$signature = '';
			   	$reg_user_id = $this->session->userdata('reg_user_id');
			   	//Logo
				if($userPhoto != '')
			    {
			      $arr = explode('/',$userPhoto);
			      $photo = end($arr);
			      $photo = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$programcode."/".$applicantNumber."/".$photo;
			    }
				if($userSign != '')
			    {
			      $arr = explode('/',$userSign);
			      $sign = end($arr);
			      $sign = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$programcode."/".$applicantNumber."/".$sign;
			    }
				

			    $logo = base_url()."public/assets/images/$logo";//BROWSE LOGO
			    $header_logo = base_url()."public/assets/images/icon/Header for APSSB.png";
			    if($userPhoto != '' && file_exists ($photo ))
			      $userimg="$userPhoto";//BROWSE USER IMAGE
			    if($userSign != '' && file_exists ($sign ))
			      $signature="$userSign";//BROWSE USER SIGNATURE
				$date1 = $year.'-'.$month.'-'.$date;
				$age = (date('Y') - date('Y',strtotime($dob)));
				//$date1 = new DateTime($date1);
			$html = '';
			$html .= '<table width="100%" style="border-collapse: collapse;font-family:Arial;">
					<tr>
						<td>
						</td>
						<td colspan="2" style="text-align: right;">
							<b>Application No : </b>'.$applicantNumber.'
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td colspan="2" style="text-align: right;">
							<b>Mobile No : </b>'.$reg_user_id.'
						</td>
					</tr>
					
					<tr>
						
					</tr>
					<tr>
						<td style="width:10%;text-align: left;vertical-align:middle;"><img style="vertical-align: top ;" src="'.$header_logo.'" /></td>
						
					</tr>
					
				</table>
				<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px; ">
						<tr >
							<br />
							<td width="43%" style="padding-left:10px;line-height:2;font-size:17px;">
								<b>Post Applied For</b> </td> 
							 <td width="5%">:</td> <td style = "font-size:17px;"width="60%"><b>'.$selectedpost.'</b></td> 
						</tr>
				</table>
				<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px; ">
						<tr >
							<td colspan="3" > <span style="font-size:17px;border-bottom:1px solid black;">Applicant\'s Information : </span></td>
						</tr>
						<tr>
							<td width="50%" style="padding-left:10px;line-height:2;">
								1. Applicant Name </td> <td width="5%">:</td> <td width="45%">'.$firstName.' '.$midName.' '.$lastName.'</td> 
								<td rowspan = "8" style="width:15%;text-align: center;">
									<img style="vertical-align: top" src="'.$userimg.'" width="100"  height="100" />
								</td>
						</tr>
				 	<tr><td  colspan="3"></td></tr>
				 	
				 	
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						2. Father\'s/Husband\'s Name </td>
	                      <td>:</td> <td>'.$father_name.'</td>
	                     </tr>
	                     <tr><td colspan="3"></td></tr>
	                     
	                     <tr>
						 <td style="padding-left:10px;line-height:2;">
						3. Mother\'s Name </td>
	                      <td>:</td> <td>'.$mothers_name.'</td>
	                     </tr>
	                     <tr><td colspan="3"></td></tr>
	                     
	                     <tr>
						 <td style="padding-left:10px;line-height:2;">
						4. Date of Birth</td> <td>:</td> <td>'.$date.'-'.$month.'-'.$year.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						5. Age (as on 01-12-2018)</td> <td>:</td> <td>'.$age.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						6. Gender</td> <td>:</td> <td>'.$gender.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						7. ID Proof Name </td> <td>: </td> <td>'.$id_proof_name.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						8. Id proof number </td> <td>: </td> <td>'.$id_proof_number.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						9. Category</td> <td>:</td> <td> '.$category.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						10. Permanent Resident of Arunachal Pradesh</td> <td>:</td> <td> '.$ap_resident.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						<tr>
						 <td style="padding-left:10px;line-height:2;" >
						11.  Nationality </td> <td>:</td> <td>'.$actual_nationality.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						12. Email Id</td> <td>:</td> <td>'.$email_id.'</td> 
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
	                     
	                     <tr>
	                      <td style="padding-left:10px;line-height:2;">
						13. Belongs To PwD </td> <td>:</td> <td>'.$physically_challenged.'&nbsp;&nbsp;'.$phtype.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						<tr> 
						 <td> 
						
						 <tr>
	                      <td style="padding-left:10px;line-height:2;">
						14. Ex-Seviceman </td> <td>:</td> <td>'.$is_ex_seviceman.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						<tr> 
						 <td> 
						 
						 <tr>
	                      <td style="padding-left:10px;line-height:2;">
						15. Domicile district </td> <td>:</td> <td>'.$dc_office.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						<tr> 
						 <td> 
						 
						 <tr> 
	                      <td style="padding-left:10px;line-height:2;">
						16. Exam Centre Preference </td> <td>:</td> <td> (a)&nbsp;&nbsp;'.$center_name1.'</br> (b)&nbsp;&nbsp;'.$center_name2.'</br>(c)&nbsp;&nbsp;'.$center_name3.' </td>
						</tr>
						<tr><td colspan="3"></td></tr>
						<tr> 
						 <td>

								
					</table>
					
			<br>
			<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
			  <tr>
			   <td width="50%">
			<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
				<tr>
					<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;">Present Address : </span></td>
				</tr>
				
				 
				   <tr><td  colspan="3"></td></tr>
				    	 <tr><td  colspan="3"></td></tr>
					<tr>
					   
					    <td style="padding-left:10px;line-height:2;"> Locality/Street Name</td> <td>:</td> <td>'.$presentaddr1.'</td>
					    </tr>
					     <tr><td  colspan="3"></td></tr>
					    <tr>
						  <td style="padding-left:10px;line-height:2;">Post Office</td><td>:</td><td>'.$presentpostoffice.'</td>
						 </tr>
						  <tr><td  colspan="3"></td></tr>
						 <tr>
	                   <td style="padding-left:10px;line-height:2;">City/Town</td> <td>:</td> <td>'.$city_name1.'</td>
	                   </tr>
	                   
	                     <tr><td  colspan="3"></td></tr>
						<tr>
						 <td style="padding-left:10px;line-height:2;"> 
						 District </td> <td>:</td> <td>'.$presentdistrictcode.'</td> 
						 </tr>
						 
						 <tr>
						 <td style="padding-left:10px;line-height:2;">State</td> <td>:</td> <td>'.$presentstatecode.'</td>
						 </tr>
						   <tr><td  colspan="3"></td></tr>
						 <tr>
						 <td style="padding-left:10px;line-height:2;">
						 PIN </td> <td>:</td> <td>'.$presentpin.' </td> 
						 </tr>
						  <tr><td  colspan="3"></td></tr>
						  
					
			</table>
			 </td>
			<td width="50%" valign="top">
		<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
				<tr>
					<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;"> Permanent Address : </span></td>
				</tr>
				 
					<tr><td  colspan="3"></td></tr>
					 <tr><td  colspan="3"></td></tr>
					 <tr>
					    <td style="padding-left:10px;line-height:2;">Locality/Street Name</td> <td>:</td><td>'.$permanentaddr1.'</td>
					  </tr>
					  <tr><td  colspan="3"></td></tr>
					   <tr>
						<td style="padding-left:10px;line-height:2;">Post Office </td> <td>:</td> <td>'.$permanentpostoffice.'</td>
	                   </tr>
	                   <tr><td  colspan="3"></td></tr>
	                   <tr>
						 <td style="padding-left:10px;line-height:2;">City/Town </td> <td>:</td> <td>'.$city_name.'</td>
						</tr>
	                 <tr><td  colspan="3"></td></tr>
					 <tr>
					  <td style="padding-left:10px;line-height:2;">
						District</td>
						<td>:</td>
						<td>'.$permanentdistrictcode.' </td>
						</tr>
						<tr><td  colspan="3"></td></tr>
						<tr>
						<td style="padding-left:10px;line-height:2;">State </td> <td>:</td><td>'.$permanentstatecode.'</td>
						</tr>
						<tr><td  colspan="3"></td></tr>
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						PIN </td> <td>:</td><td>'.$permanentpin.'</td>
						</tr>
						
					
			</table>
			</td>
			</tr>
			</table>';
			
			$html .= '<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;">Educational Qualification</span> </td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
			<td colspan="5">
					<table width="100%" cellpadding="5" style="border-collapse: collapse;text-align:center;" border="1">
						<tr>
							<td style="text-align:center;width:20%;line-height:2;">Name of Examination Passed </td>
							<td style="text-align:center;width:10%;line-height:2;">Degree/Master in</td>
							<td style="text-align:center;width:10%;line-height:2;">Year Of Passing/Appearing </td>
							<td style="text-align:center;width:20%;line-height:2;">Board/University</td>
							<td style="text-align:center;width:10%;line-height:2;">CGPA/% of Marks</td>
							<td style="text-align:center;width:10%;line-height:2;">Division/Class </td>
						</tr>';
		//print_r($qualification_detail)	; die();			
		
		foreach($qualification_detail as $row)
		{
			if($row['qual_desc_2'] == null || $row['qual_desc_2'] == '' || $row['qual_desc_2'] == 'NULL')
			{
				$qual_2 = '-';
			}
			else
			{
				$qual_2 = $row['qual_desc_2'];
			}
			if($row['other_stream'] == null || $row['other_stream'] == '' || $row['other_stream'] == 'NULL' )
			{
				$other_stream = $row['other_stream'];
			}
			else
			{
				$other_stream = ','.$row['other_stream'];
			}
			$html .='<tr>
				<td style ="width:20%;line-height:2;">'.$row['qual_desc_1'].'</td>
				<td style ="width:20%;line-height:2;">'.$qual_2.''.$other_stream.'</td>
				<td style ="width:10%;line-height:2;">'.$row['year_of_passing'].'</td>
				<td style ="width:20%;line-height:2;">'.$row['university_board'].'</td>										 
				<td style ="width:10%;line-height:2;">'.$row['percentage_mark'].'</td>
				<td style ="width:10%;line-height:2;">'.$row['division_distinction'].'</td>
			</tr>';
		}
		$html .= '</table>
				</td>
				<tr/>
			</table> <br/>';
			$html .=  '<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
					<tr>
						<td><span style="font-size:16px;"> Computer Education : '.$is_computer.'</span></td>
						
						<td></td>
					</tr>
					</table>';	
				$html .=  '<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;">Other Qualification</span> </td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
					<td colspan="3">
							<table width="100%" cellpadding="5" style="border-collapse: collapse;text-align:center;" border="1">
								<tr>
									<td style="width:20%;">Examination passed  </td>
									<td style="width:25%;">Degree/Master in </td>
									<td style="width:10%;">Year Of <br />Passing</td>
									<td style="width:15%;">Board/<br />University</td>
									<td style="width:15%;">CGPA/% <br />of Marks</td>
									<td style="width:15%;">Division/Class</td>
								</tr>';
				//print_r($qualification_detail)	; die();			
				foreach($tech_qual_data_5 as $row)
				{
					$html .= '<tr>
						<td style ="width:20%;">'.$row['qual_desc_1'].'</td>
						<td style ="width:25%;">'.$row['stream'].'</td>
						<td style ="width:10%;">'.$row['year'].'</td>
						<td style ="width:20%;">'.$row['affiliation_from'].'</td>				 
						<td style ="width:10%;">'.$row['grade_cgpa'].'</td>
						<td style ="width:10%;">'.$row['division'].'</td>
					</tr>';
				}
				foreach($tech_qual_data_6 as $row)
				{
					$html .= '<tr>
						<td style ="width:20%;">'.$row['qual_desc_1'].'</td>
						<td style ="width:20%;">'.$row['stream'].'</td>
						<td style ="width:10%;">'.$row['year'].'</td>
						<td style ="width:20%;">'.$row['affiliation_from'].'</td>			 
						<td style ="width:10%;">'.$row['grade_cgpa'].'</td>
						<td style ="width:10%;">'.$row['division'].'</td>
					</tr>';
				}
				
				$html .=  '</table>
						</td>
						<tr/>
					</table> <br/><br/><br/>';
					//$pdf = $this->m_pdf->pdf;
        //generate the PDF!
        //$pdf->WriteHTML($html);
        //$pdf->AddPage();
				$html .=  '<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
						<tr>
							<td><span style="font-size:12px;">Whether working as a regular employee under the Government ? : &nbsp;&nbsp;'.$is_employed.'</span></td>
							<td> </td>
							<td></td>
						</tr>
						</table>';	
				if($is_employed == 'YES')
				{
					$html .=  '<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3"></td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr>
						<td colspan="5">
								<table width="100%" cellpadding="5" style="border-collapse: collapse;text-align:center;" border="1">
									<tr>
										<td style="text-align:center;width:20%;">Name Of Office </td>
										<td style="text-align:center;width:10%;">Date of joining </td>
										<td style="text-align:center;width:10%;">Name of the post </td>
									</tr>';
					//print_r($qualification_detail)	; die();			
					$html .= '<tr>
						<td style ="width:20%;">'.$name_of_office.'</td>
						<td style ="width:20%;">'.$govt_doj.'</td>
						<td style ="width:10%;">'.$name_of_post.'</td>
					</tr>';
					$html .=  '</table>
							</td>
							<tr/>
						</table> <br/>';
				}
				
				$html .=  '<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
						<tr>
							<td><span style="font-size:12px;">Have you ever been debarred by any service commission/board etc.? : &nbsp;'.$empDisciplinary.'</span></td>
							<td> </td>
							<td></td>
						</tr>
						</table>';	
				if($empDisciplinary == 'YES')
				{
					$html .=  '<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3"></td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr>
						<td colspan="5">
								<table width="100%" cellpadding="5" style="border-collapse: collapse;text-align:center;" border="1">
									<tr>
										<td style="text-align:center;width:20%;">Date </td>
										<td style="text-align:center;width:10%;">Period of debbarment </td>
									</tr>';
					//print_r($application_data)	; die();			
					$html .= '<tr>
						<td style ="width:20%;">'.$date_of_debar.'</td>
						<td style ="width:10%;">'.$period_of_debar.'</td>
					</tr>';
					$html .=  '</table>
							</td>
							<tr/>
						</table> <br/> <br/> <br/>';
				}
					
				$html .= '<br/> <br/><br/> <br/><table width="100%" style="border-collapse: collapse; font-family:Arial;font-weight:bold;font-size:12px;">
						<tr>
							<td colspan="4"><span style="font-size:17px;border-bottom:1px solid black;">Payment Details :</span></td>
						</tr>
						 <tr><td colspan="4">&nbsp;</td></tr>
						<tr>
							<td width="25%">
								Mode &nbsp;&nbsp; : '.$paymentMode.' 
							</td>
							<td width="20%">
								Amount &nbsp;&nbsp; : '.$amountPaid.' 
							</td>
							<td width="35%">
								Transaction Id &nbsp;&nbsp; : '.$transactionNo.' 
							</td>
							<td width="20%">
								Date &nbsp;&nbsp; : '.$depositDate.' 
							</td>
						</tr>
					</table>
					<br>';
					$html .=  '<h3 style="text-align:center;text-decoration:underline;">Declaration</h3></br></br>';
					$html .=  'I  hereby declare that I have read the detail information/advertisement before submission of this application.I hereby certify that all statements made and information given by me in this application form are true, complete and correct to the best of my knowledge and belief. In the event of any information is being found false or incorrect before or after the interview or appointment, action can be taken against me by the board and my candidature/appointment shall automatically be cancelled/terminated.<br/>';
					$html .=  '<img style="vertical-align: top ;margin-left:700px;" src="'.$signature.'" height="80" width="150" /><div style="text-align: right;vertical-align:middle;"><b>Signature of the candidate</b></div></br>';
					$html .=  '<h3 style="text-align:center;text-decoration:underline;">Documents Uploaded</h3></br></br>';
					$i=1;
					foreach($applicant_documents as $row){
						
						$html .=  $i.'.'.$row['document_type'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>';
						$i++;
					};
				return array('html' => $html);
			break;
			case 'save_apply_upload_program':
				$dbstatus = true;
				$dbMessage = "Successfully Submitted";
				$date = date('Y-m-d H:i:s', now());
				
				//$appl_no = $this->session->userdata('hidApplNo'); 
				//$hidProg = $this->session->userdata('hidProg');
				$program = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$program = isset($_POST['hidProCode']) ? $_POST['hidProCode'] : '';
				//echo $program;die();
				$hidProg=$program;
				$this->db->select('appl_no');
				$this->db->from('applicant_appl_overview');
				$this->db->where('reg_user_id', $reg_user_id);
				$this->db->where('applied_program', $program);
				$application_no = $this->db->get();
				$appl_no_array = $application_no->result_array();//print_r($appl_no_array);die();
				$appl_no = $appl_no_array[0]['appl_no'];
				$this->db->select("spds.document_type_code");
				$this->db->from('selected_program_document_setup AS spds'); 
				$this->db->join('selected_applicant_form_documents AS safd', 'safd.doc_id = spds.document_type_code AND safd.appl_no = "'.$appl_no.'"', 'left');
				$this->db->where('spds.program_code', $program);
				$this->db->order_by('spds.sl_no');
				$result = $this->db->get();//echo $this->db->last_query();die();
				$output_data = $result->result_array();
				
				$i=1;
				
				$uploaddir = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$hidProg."/".$appl_no;
				$retrievedir = BASE_ADM_URL."/DOCUMENTS/".$hidProg."/".$appl_no;
				if(!is_dir($uploaddir))
					mkdir($uploaddir,0777,true);
				//exec("chmod -R 777 $uploaddir");//for giving folder permission to downlad that file 
				
				//$allowed =  array('jpg','jpeg' ,'png','JPG','PNG','PDF','DOC','pdf','doc','DOCX','docx');
				
				foreach($output_data as $row)
  				{	
  					$document_type_code = $row['document_type_code']; 
  					$doc_name= explode(".",$_FILES['fileDocument'.$i]["name"]);
					$ext_doc = strtolower(end($doc_name));
					$docImageFileName = $document_type_code.'.'.$ext_doc;
					$docImagePath = $retrievedir."/".$docImageFileName;
					$doc_id = $appl_no.'_'.$document_type_code;
  					$config['upload_path'] = $uploaddir; 
					$config['file_name'] = $document_type_code.'.'.$ext_doc;
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['overwrite'] = TRUE;
						        
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if(isset($_FILES['fileDocument'.$i]["name"]) && $_FILES['fileDocument'.$i]["name"] != ''){
						$check = mime_content_type($_FILES['fileDocument'.$i]['tmp_name']);
							if($check != 'image/jpeg' && $check != 'image/jpg' && $check != 'image/png') {
								return array('status'=>false, 'msg'=>"Invalid file type");
							}
						 
						if (!$this->upload->do_upload('fileDocument'.$i))
						{   	//echo 'if';die();
							$error = $this->upload->display_errors();
							$dbstatus = FALSE;
							$dbMessage = $error;
						}
	  					else{
							$this->db->select("count(doc_id) AS doc_id");
							$this->db->from('selected_applicant_form_documents');
							$this->db->where('doc_id',$doc_id);
							
							$doc_result = $this->db->get();
							//echo $this->db->last_query();die();
							$output_doc_data = $doc_result->result_array();
							
							foreach ($output_doc_data as $aRow1) 
		            		{
		            			$doc_result = $aRow1['doc_id'];//echo $doc_result;
			                } 
			                if($doc_result >= 1)
							{ 
								$update_data = array(
									'document_submit_date' 			=>$date,
									'document_path' 				=>$docImagePath,
									'updated_by'					=>'',
									'updated_on'					=>$date,
									'status'						=>'1'
								);
								$this->db->where('doc_id',$doc_id);
								$sql = $this->db->update('selected_applicant_form_documents', $update_data);
								//echo $this->db->affected_rows();
								if(!$sql){
									$dbstatus = false;
									$dbMessage = "Error while Updating";
									//$dbError = ;	
								}
								
								$update_data11 = array(
									'reeval_status'		 			=>'Verified'
								);
								$this->db->where('appl_no',$appl_no);
								$this->db->where('applied_program',$program);
								$sql = $this->db->update('applicant_appl_overview', $update_data11);
								//echo $this->db->last_query();die();
								if(!$sql){
									$dbstatus = false;
									$dbMessage = "Error while Updating";
									//$dbError = ;	
								}
							}
							else
							{ //echo "hi";die();
								$new_data = array(
									'appl_no' 						=>$appl_no,
									'doc_id' 						=>$doc_id,
									'document_type' 				=>$document_type_code,
									'document_submit_status' 		=>'Submitted',
									'document_submit_date' 			=>$date,
									'submit_mode' 					=>'ONLINE',
									'document_path' 				=>$docImagePath,
									'created_by'					=>'',
									'created_on'					=>$date
								);
								
								
								$sql = $this->db->insert('selected_applicant_form_documents', $new_data);
								//echo $this->db->last_query();die();
								if(!$sql){
									$dbstatus = false;
									$dbMessage = "Error while Submitting";
									//$dbError = ;	
								}
								$update_data = array(
									'reeval_status'		 			=>'Verified'
								);
								$this->db->where('appl_no',$appl_no);
								$this->db->where('applied_program',$program);
								$sql = $this->db->update('applicant_appl_overview', $update_data);
								//echo $this->db->affected_rows();
								if(!$sql){
									$dbstatus = false;
									$dbMessage = "Error while Updating";
									//$dbError = ;	
								}
							}
						}
					}
					
  					
					$i++;
  				}
  				return array('status' => $dbstatus, 'msg' =>$dbMessage);
			break;
			case 'get_program_detail_upload':
				$program_code = $data;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select('A.program_group,D.program_group_name,A.id,A.program_name,A.program_code,A.year,A.apply_start_date,A.apply_end_date,A.template_code,C.file_name,C.template_name');
				$this->db->from('program_master A');
				$this->db->join('form_template_master C','A.template_code = C.template_code','inner');
				$this->db->join('program_group_master D','A.program_group = D.program_group_code','inner');//lina V1
				$this->db->where('A.program_code',$program_code);
				//print_r($query);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_document_data_upload':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		//$institute_code = $this->session->userdata('institute_code');
        		//$data = $this->uri->uri_to_assoc();
				//$institute = $data['ins'];
        		//$ins =  encrypt_decrypt('decrypt', $institute);
        		$data = $this->uri->uri_to_assoc();
				$program = $data['admcode'];
        		$where = "(selected_program_document_setup.record_status = 'Active' OR selected_program_document_setup.record_status = '1')";
        		
				$this->db->select('document_type_master.document_type_code,document_type,document_extension_type,document_type_description,document_size_description,document_size_in_kb,document_preview_height,document_preview_width');
				$this->db->from('selected_program_document_setup');
				$this->db->join('document_type_master', 'selected_program_document_setup.document_type_code = document_type_master.document_type_code','inner');
				
				//$this->db->where('application_no',$application_no);
				$this->db->where('program_code',$program);
				//$this->db->where('applicant_document_list.record_status','1');
				$this->db->where($where);
				$this->db->order_by('sl_no');
				//print_r($query);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				//print_r($result);
				return $result->result_array();
			break;
			case 'change_applicant_password':
				$user_name = $this->session->userdata('reg_user_id');
				$key = $this->session->userdata('key');
				$institute_code = $this->session->userdata('institute_code');
				//$old_password = md5($this->input->post('shapasswordOld'));
				$old_password11 = $this->input->post('shapasswordOld');
				$new_password = $this->input->post('shapasswordNewOne');
				$this->db->where('reg_user_id', $user_name);
				$this->db->where('institute_code', $institute_code);
				//$this->db->where('password', $old_password);
				$this->db->where("SHA2(CONCAT(password,'#','$key'),512)",$old_password11);
				if($this->db->count_all_results('applicant_reg_master') != 1)
				{  
					return array('status'=>0, 'msg'=>'Invalid current password.');
				}
				
				
				$check_data = $this->db->get_where('password_history', array('password'=>$new_password,'user_name'=>$user_name,'institute_code'=> $institute_code));
				if($check_data->num_rows()==0){
					//$new_pass =  $this->getHash($this->input->post('new_password'));
					$this->db->where('reg_user_id', $user_name);
					$this->db->where('institute_code', $institute_code);
					$this->db->update('applicant_reg_master', array('password'=>$new_password));
					 
					if($this->db->affected_rows())
					{
						/*case 1:
							$this->db->insert('password_history', array('password'=>$new_password,'user_name'=>$user_name,'institute_code'=> $institute_code,'created_by'=>$user_name));*/
							return array('status'=>true, 'msg'=>'Password changed successfully');
						/*break;
						default:*/
							 
					}
					else{
						return array('status'=>false, 'msg'=>'Sorry! Password could not be changed.');
					}
				}else{
					return array('status'=>false, 'msg'=>'Entered password is already used previously.Please try a new password');
				}
			break;
			case 'update_profile_details':
			    $dbstatus = TRUE;
				$dbStatus = "";
				$dbmessage = "";
				$dbError = "";
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s");
        		
        		$txtdateofbirth = isset($_POST['txtdateofbirth']) && $_POST['txtdateofbirth'] != '' ? $_POST['txtdateofbirth'] : 'NULL';
				$radiogender = isset($_POST['radiogender']) && $_POST['radiogender'] != '' ? $_POST['radiogender'] : 'NULL';
				$cmbCommunity = isset($_POST['cmbCommunity']) && $_POST['cmbCommunity'] != '' ? $_POST['cmbCommunity'] : 'NULL';
				$cmbQuota = isset($_POST['cmbQuota']) && $_POST['cmbQuota'] != '' ? $_POST['cmbQuota'] : 'NULL';
				$program_code = isset($_POST['hidprogram']) && $_POST['hidprogram'] != '' ? $_POST['hidprogram'] : 'NULL';
				$txtdateofbirth =date('Y-m-d', strtotime($txtdateofbirth));
				$this->db->select("count(*) AS cnt");
				$this->db->from('applicant_appl_overview');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				foreach($result->result_array() as $appl)
				{
					$count = $appl['cnt'];
				}
				if($count >= 1)
				{
					$this->session->set_userdata('mode', 'edit');
				}
				else
				{
					$this->session->set_userdata('mode', 'new');	
				}
				$mode = $this->session->userdata('mode');
				
				$this->db->select("appl_no");
				$this->db->from('applicant_appl_overview');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				foreach($result->result_array() as $appl)
				{
					$application_no = $appl['appl_no'];
				}
				
				if($mode == 'edit')
				{
					$this->db->trans_start();
					$dbstatus = TRUE;
					$dbmessage = 'Data saved successfully';
					
					
					$applicant_master_update_array = array(
							
						
						'gender' => $radiogender,
						'dob' => $txtdateofbirth,
						'category' => $cmbCommunity,
						'is_reserved_quota' => $cmbQuota,
						'updated_by' => $reg_user_id,
						'updated_on' => $now
						);
						$this->db->where('reg_user_id' , $reg_user_id);
						$this->db->where('applied_program',$program_code);
						$query = $this->db->update('applicant_master',$applicant_master_update_array);
						if(!$query)
						{
							$dbstatus = FALSE;
							$dbmessage = 'Error update Applicant Master';
						}
						else
						{
							$applicant_history_insert_array = array(
								'gender' => $radiogender,
								'dob' => $txtdateofbirth,
								'category' => $cmbCommunity,
								'is_reserved_quota' => $cmbQuota,
								'updated_by' => $reg_user_id,
								'updated_on' => $now
							);
							$history_applicant = $this->db->insert('applicant_history',$applicant_history_insert_array);
							if(!$history_applicant){
								$dbstatus = FALSE;
								$dbmessage = 'Error inserting applicant_history';
							}
						}
						$documentsReq = '';
						$program_code_URL = str_replace('/', '-', $program_code);//find and replace uid and pwd in url

						$uploaddir = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$program_code_URL."/".$application_no;
						$retrievedir = BASE_ADM_URL."/DOCUMENTS/".$program_code_URL."/".$application_no;
						//echo $uploaddir;die();
						if(!is_dir($uploaddir))
							mkdir($uploaddir,0777,true);
						exec("chmod -R 777 $uploaddir");//for giving folder permission to downlad that file 
						
						$allowed =  array('jpg','jpeg' ,'png','JPG','PNG');
						
						if(!empty($_FILES['filePHO']['tmp_name']))
				  		{
				  			$document_type_code = 'PHO';
							$doc_name= explode(".",$_FILES['filePHO']["name"]);
							$ext_doc = strtolower(end($doc_name));
							$docImageFileName = $document_type_code.'.'.$ext_doc;
							$docImagePath = $retrievedir."/".$docImageFileName;
							$docimagetemp = $_FILES['filePHO']['tmp_name'];
							move_uploaded_file($docimagetemp,$uploaddir."/".$docImageFileName);	
						
							if(!in_array($ext_doc,$allowed) ) {
							    $error_count++;
							}
							else
							{
								move_uploaded_file($_FILES['filePHO']['tmp_name'], $uploaddir);
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
											$dbstatus = FALSE;
											$dbmessage = "Error updating photo";
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
											$dbstatus = FALSE;
											$dbmessage = "Error Inserting photo";
											//$dbError = ;	
										}
									}
				                }
								
							}
							
						}
						if(!empty($_FILES['fileSIG']['tmp_name']) )
				  		{
				  			$document_type_code = 'SIG';
							$doc_name= explode(".",$_FILES['fileSIG']["name"]);
							$ext_doc = strtolower(end($doc_name));
							$docImageFileName = $document_type_code.'.'.$ext_doc;
							$docImagePath = $retrievedir."/".$docImageFileName;
							$docimagetemp = $_FILES['fileSIG']['tmp_name'];
							move_uploaded_file($docimagetemp,$uploaddir."/".$docImageFileName);	
						
							if(!in_array($ext_doc,$allowed) ) {
							    $error_count++;
							}
							else
							{
								move_uploaded_file($_FILES['fileSIG']['tmp_name'], $uploaddir);
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
											$dbstatus = FALSE;
											$dbmessage = "Error updating signature";
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
											$dbstatus = FALSE;
											$dbmessage = "Error Inserting signature";
											//$dbError = ;	
										}
									}
				                }
								
							}
							
						}
						if($dbstatus == TRUE)
						{
							$this->db->trans_complete();
							$this->session->set_userdata('admcode', $program_code);
							$this->session->set_userdata('reg_user_id', $reg_user_id);/*
							$this->session->set_userdata('appl_no', $appl_no);*/
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
							return array('status' => $dbstatus, 'msg' => $dbmessage);
						}
				}
        	break;
        	case 'get_document_path_PHO':
        		
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
        		$this->db->select("appl_no");
				$this->db->from('applicant_appl_overview');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				foreach($result->result_array() as $appl)
				{
					$application_no = $appl['appl_no'];
				} 
        		$this->db->select('photo.document_path AS passportphoto');
				$this->db->from('applicant_form_documents photo');
				$this->db->join('document_type_master doc', 'doc.document_type_code=photo.document_type', 'left');
				$this->db->where('photo.appl_no',$application_no);
				$this->db->where('photo.document_type','PHO');
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_document_path_SIG':
        		
				$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
        		$this->db->select("appl_no");
				$this->db->from('applicant_appl_overview');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				foreach($result->result_array() as $appl)
				{
					$application_no = $appl['appl_no'];
				} 
				
        		$this->db->select('photo.document_path AS signature');
				$this->db->from('applicant_form_documents photo');
				$this->db->join('document_type_master doc', 'doc.document_type_code=photo.document_type', 'left');
				$this->db->where('photo.appl_no',$application_no);
				$this->db->where('photo.document_type','SIG');
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'get_document_path':
        		
				$program_code = $this->input->post('admcode');
				if(!$program_code){
					$program_code = $data;
				}
				$reg_user_id = $this->session->userdata('reg_user_id');
        		$this->db->select("appl_no");
				$this->db->from('applicant_appl_overview');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				foreach($result->result_array() as $appl)
				{
					$application_no = $appl['appl_no'];
				} 
        		$this->db->select('photo.document_path AS passportphoto');
				$this->db->from('applicant_form_documents photo');
				$this->db->join('document_type_master doc', 'doc.document_type_code=photo.document_type', 'left');
				$this->db->where('photo.appl_no',$application_no);
				$this->db->where('photo.document_type','PHO');
				$result = $this->db->get();
				foreach($result->result_array() as $appl)
				{
					$photo = $appl['passportphoto'];
				} 
				$this->db->select('photo.document_path AS signature');
				$this->db->from('applicant_form_documents photo');
				$this->db->join('document_type_master doc', 'doc.document_type_code=photo.document_type', 'left');
				$this->db->where('photo.appl_no',$application_no);
				$this->db->where('photo.document_type','SIG');
				//echo $this->db->last_query();
				$result = $this->db->get();
				
				foreach($result->result_array() as $appl)
				{
					$signature = $appl['signature'];
				} 
				
				if (strpos($application_no, '_') !== false) {
				    $url = BASE_DOC_URL."upload/SSB_Old Data/new_apssb/";
				}
				else{
					  $url = BASE_DOC_URL."upload/SSB_Old Data/Old_apssb/";
				}
				
				$candidate_photo = "";
				$siganture_candidate = "";
				$pho = "";
				$sign = "";
				
       			$program = str_replace('/','-',$program_code);
				if($photo != '')
		        {
		          $arr = explode('/',$photo);
		          $pho = end($arr);
		          $candidate_pho = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$program."/".$application_no."/".$pho;
		          $pho = $url."candidate_photo/".$pho;
		          
		        }
		  		if($signature != '')
		        {
		          $arr = explode('/',$signature);
		          $sign = end($arr);
		          $cantidate_sign = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$program."/".$application_no."/".$sign;
		          $sign = $url."siganture_candidate/".$sign;
		        }
		        
				if(file_exists($pho))
					$candidate_photo = $photo;
					
				else if(file_exists($candidate_pho))
				{
				    $candidate_photo = $photo;
				}
				
				if(file_exists($sign))
					$siganture_candidate = $signature;
					
				else if(file_exists($cantidate_sign))
				{
				   $siganture_candidate = $signature;
				}	
					
				return array('photo' => $candidate_photo, 'signature' =>$siganture_candidate);
			break;
			case 'get_advertise_data':
				$this->db->select("am.*");
				$this->db->from('advertisement_master am');
				$this->db->join('program_master pm','am.advt_no=pm.advt_no','INNER');
				$this->db->where('am.record_status',1);
				$this->db->distinct('am.advt_no');
				//print_r($query);
				$result = $this->db->get();
				return $result->result_array();
			break;
			default :
            	return array('status' => FALSE, 'msg' =>'Unable to load.Contact Support');
			
        }
    }
}
