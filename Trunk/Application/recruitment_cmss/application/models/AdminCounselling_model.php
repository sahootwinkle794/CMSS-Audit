<?php

class AdminCounselling_model extends CI_model {

    private $role;
    private $user_code;

    function __construct() {
        parent::__construct();
        $this->load->helper('date');

        if (ENVIRONMENT == 'production') {
            $this->db->save_queries = FALSE;
        }
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s', now());
        $this->role = $this->session->userdata('role');
    }
    
    public function template008_pdf() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template008_pdf($order_id, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template008_pdf($order_id, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template008_pdf($order_id, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template008_pdf($order_id, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template008_pdf($order_id, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template008_pdf($order_id, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template008_pdf($order_id, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template008_pdf($order_id, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template008_pdf($order_id, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template008_pdf($order_id, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template008_pdf($order_id, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template008_pdf($order_id, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template008_pdf($order_id, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template008_pdf($order_id, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template008_pdf($order_id, 'get_other_nationality');
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
        $data['type'] = "TOP";
                
		$html = $this->load->view('pdf/template008_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        
        $pdfFilePath = "template008_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //generate the PDF!
        $pdf->WriteHTML($html);
        $pdf->AddPage();
        $data['type'] = "BOTTOM";
        $html = $this->load->view('pdf/template008_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html);        
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print_008.pdf', 'F');
		//$this->load->view('pdf/template008_pdf');	
		/*$pdf->Output($applicantNumber.".pdf",'I');*/	
		return true;
    } 
    public function recurse_copy($src,$dst) { 
	    $dir = opendir($src); 
	    @mkdir($dst,0777,true); 
	    while(false !== ( $file = readdir($dir)) ) { 
	        if (( $file != '.' ) && ( $file != '..' )) { 
	            if ( is_dir($src . '/' . $file) ) { 
	                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
	            } 
	            else { 
	                copy($src . '/' . $file,$dst . '/' . $file); 
	            } 
	        } 
	    } 
	    closedir($dir); 
	} 
	
    public function diff_in_month($from, $to) {
        $frmDate = date_create($from);
        $toDate = date_create($to);
        $difference = date_diff($toDate, $frmDate, true);
        $month = $difference->format("%a") / 30;
        return $month;
    }
	
	public function excel1_report_admit_card($data)
	{
		$institute_code = $this->session->userdata('institute_code');
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d', now());
		$year = date('Y', now());
		$logged_user = $this->session->userdata('user_code');
		$user_name = $this->session->userdata('user_name');
		$user_role = $this->session->userdata('role');
		
		$sel_program_code = $data['program_code'];
		$exam_center_code = $data['assigned_exam_center_code'];
		$exam_vanue = $data['exam_vanue'];
		$from = $data['from'];
		$to = $data['to'];
		
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
			'user_code' 					=>$user_name,
			'user_role' 					=>$user_role,
			'user_ip' 						=>$ip,
			'url'							=>$url, 
			'action_type'					=>'DOWNLOAD',
			'institute_code'					=>$institute_code ,
			'created_by' 					=>$user_name,
			'created_on'					=>$date
		);
		$insert_user = $this->db->insert('user_activity_details', $new_data);
		/*echo $this->db->last_query();
		die();*/
		
		
		
		$this->db->select('COUNT(*) AS total_count');	
        $this->db->from('applicant_master A');
        $this->db->join('applicant_appl_overview B', 'A.reg_user_id = B.reg_user_id AND A.applied_program = B.applied_program', 'INNER');
        $this->db->join('counselling_applicant_form_fee_overview D', 'B.appl_no = D.appl_no', 'INNER');
        $this->db->join('admitcard_published E', 'B.appl_no = E.appl_no AND A.applied_program = E.applied_program', 'INNER');
        $this->db->join('exam_centre_master EXM', 'A.applied_program = EXM.program_code AND E.assigned_exam_center = EXM.exam_centre_code', 'INNER');
        $this->db->join('counselling_program_master PM', 'A.applied_program = PM.program_code', 'INNER');
        $this->db->where('B.appl_status','Verified');
        $this->db->where('A.applied_program',$sel_program_code);
        $this->db->where('E.assigned_exam_center',$exam_center_code);
        $this->db->where('E.assigned_exam_vanue',$exam_vanue);
        $this->db->where('A.status',1);
        $this->db->where('E.RECORD_STATUS',1);
        
        $result = $this->db->get();
		//echo $this->db->last_query();
		$output_data = $result->result_array();
		$output = array("aaData" => array());
		foreach ($output_data as $row) 
        {
        	$total_count = $row['total_count'];
        }
		
		$x = $from - 1;
		$y = $to - $from + 1;
		
		$this->db->select("A.full_name, B.appl_no, B.form_no, A.reg_user_id, B.updated_on, D.money_deposit_mode, amount,
							depositdate, F.document_path AS passport_path,G.document_path AS signature_path, money_receipt_no, 
							A.exam_center_code AS applied_exam_center,EXM.exam_centre_name, E.assigned_exam_center AS assigned_exam_center, 
							E.omr_no, E.record_status AS publish_status, PM.program_name, ADM.exam_vanue");
		$this->db->from('applicant_master A');
		$this->db->join('applicant_appl_overview B','A.reg_user_id = B.reg_user_id
							AND A.applied_program = B.applied_program','LEFT');
		$this->db->join('counselling_applicant_form_fee_overview D','B.appl_no = D.appl_no ','LEFT');
		$this->db->join('admitcard_published E','B.appl_no = E.appl_no AND A.applied_program = E.applied_program','LEFT');
		$this->db->join('counselling_program_master PM','A.applied_program = PM.program_code','LEFT');
		$this->db->join('exam_centre_master EXM','A.applied_program = EXM.program_code AND E.assigned_exam_center = EXM.exam_centre_code','LEFT');
		$this->db->join('admitcard_setup ADM','ADM.program_code = E.applied_program AND ADM.exam_center_code = E.assigned_exam_center AND ADM.exam_vanue_code = E.assigned_exam_vanue ','LEFT');
		$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='PHO') F",'B.appl_no = F.appl_no','LEFT');
		$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='SIG') G",'B.appl_no = G.appl_no','LEFT');
		$this->db->where('B.appl_status','Verified');
		$this->db->where('A.status','1');
		$this->db->where('E.record_status','1');
		$this->db->where('A.applied_program',$sel_program_code);
		$this->db->where('E.assigned_exam_center',$exam_center_code);
		$this->db->where('E.assigned_exam_vanue',$exam_vanue);
		$this->db->order_by("omr_no", "asc");
		$this->db->limit($y,$x);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function excel2_report_admit_card($data)
	{
		$institute_code = $this->session->userdata('institute_code');
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d', now());
		$year = date('Y', now());
		$logged_user = $this->session->userdata('user_code');
		$user_name = $this->session->userdata('user_name');
		$user_role = $this->session->userdata('role');
		
		$sel_program_code = $data['program_code'];
		$exam_center_code = $data['assigned_exam_center_code'];
		$exam_vanue = $data['exam_vanue'];
		$from = $data['from'];
		$to = $data['to'];
		
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
			'user_code' 					=>$user_name,
			'user_role' 					=>$user_role,
			'user_ip' 						=>$ip,
			'url'							=>$url, 
			'action_type'					=>'DOWNLOAD',
			'institute_code'					=>$institute_code ,
			'created_by' 					=>$user_name,
			'created_on'					=>$date
		);
		$insert_user = $this->db->insert('user_activity_details', $new_data);
		/*echo $this->db->last_query();
		die();*/
		
		$x = $from - 1;
		$y = $to - $from + 1;
		
		$this->db->select("A.full_name, B.appl_no, B.form_no, A.reg_user_id, B.updated_on, D.money_deposit_mode, amount,
							depositdate, F.document_path AS passport_path,G.document_path AS signature_path, money_receipt_no, 
							A.exam_center_code AS applied_exam_center,EXM.exam_centre_name, E.assigned_exam_center AS assigned_exam_center, 
							E.omr_no, E.record_status AS publish_status, PM.program_name, ADM.exam_vanue");
		$this->db->from('applicant_master A');
		$this->db->join('applicant_appl_overview B','A.reg_user_id = B.reg_user_id
							AND A.applied_program = B.applied_program','LEFT');
		$this->db->join('counselling_applicant_form_fee_overview D','B.appl_no = D.appl_no ','LEFT');
		$this->db->join('admitcard_published E','B.appl_no = E.appl_no AND A.applied_program = E.applied_program','LEFT');
		$this->db->join('counselling_program_master PM','A.applied_program = PM.program_code','LEFT');
		$this->db->join('exam_centre_master EXM','A.applied_program = EXM.program_code AND E.assigned_exam_center = EXM.exam_centre_code','LEFT');
		$this->db->join('admitcard_setup ADM','ADM.program_code = E.applied_program AND ADM.exam_center_code = E.assigned_exam_center AND ADM.exam_vanue_code = E.assigned_exam_vanue ','LEFT');
		$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='PHO') F",'B.appl_no = F.appl_no','LEFT');
		$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='SIG') G",'B.appl_no = G.appl_no','LEFT');
		$this->db->where('B.appl_status','Verified');
		$this->db->where('A.status','1');
		$this->db->where('E.record_status','1');
		$this->db->where('A.applied_program',$sel_program_code);
		$this->db->where('E.assigned_exam_center',$exam_center_code);
		$this->db->where('E.assigned_exam_vanue',$exam_vanue);
		$this->db->order_by("omr_no", "asc");
		$this->db->limit($y,$x);
		$query = $this->db->get();
		/*echo $this->db->last_query();
		die();*/
		
		return $query->result();
	}
	
	public function excel_program_branch_institute_seat($data)
	{
		$institute_code = $this->session->userdata('institute_code');
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d', now());
		$year = date('Y', now());
		$logged_user = $this->session->userdata('user_code');
		$user_name = $this->session->userdata('user_name');
		$user_role = $this->session->userdata('role');
		
		$where = "institute_name IS NOT NULL";
		$this->db->select('CONCAT(C.institute_name," - ",D.program_name," - ",A.branch) AS branch,category_code');	
        $this->db->from('counselling_branch_master A');
        $this->db->join('counselling_program_branch_institute_mapping B', 'B.branch_code = A.branch_code', 'LEFT');
        $this->db->join('institute_master C', 'C.institute_code = B.institute_code', 'LEFT');
        $this->db->join('counselling_program_master D', 'D.program_code = B.program_code', 'LEFT');
        $this->db->join('category_master E','E.category_code = E.category_code', 'INNER');
        $this->db->where($where);
        $this->db->where('E.record_status','1');
        $this->db->order_by('branch');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function excel_valid_students_header($data)
	{
		$institute_code = $this->session->userdata("institute_code");
		$user_code = $this->session->userdata("user_code");
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d', now());
		$logged_user = $this->session->userdata('user_name');
		$counselling_code = isset($_POST['counselling_code'])?$_POST['counselling_code']:'';
		$student_arr = array();
		$subject_name = array();
	
		$this->db->select("category_code,category_name");
		$this->db->from('category_master');
		$this->db->where('record_status','1');
		$this->db->order_by('category_name');
		$result = $this->db->get();
		$output_data = $result->result_array();
		$output = array("aaData" => array());
		$slno = 1;
		foreach ($output_data as $aRow) 
        {
            $category_names[] = $aRow;
        }
        
        $this->db->select('COUNT(*) AS cnt');
		$this->db->from('counselling_applicant_choice_details');
		$this->db->group_by('reg_user_id');
		$sub_query = $this->db->get_compiled_select();

		$this->db->select('MAX(cnt) AS count');
		$this->db->from("($sub_query) X");
		$result = $this->db->get();
		$output_data = $result->result_array();
		foreach ($output_data as $aRow) 
        {
            $count = $aRow['count'];
        }
		
		$output = array('categories'=>$category_names, 'count'=>$count);
		return $output;
	}
	
	public function excel_valid_students($data)
	{
		$institute_code = $this->session->userdata("institute_code");
		$user_code = $this->session->userdata("user_code");
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d', now());
		$logged_user = $this->session->userdata('user_name');
		$counselling_code = isset($_POST['counselling_code'])?$_POST['counselling_code']:'';
		$counselling_code = $data['counselling_code'];
		$student_arr = array();
		$subject_name = array();
		
        $this->db->select("category_code,category_name");
		$this->db->from('category_master');
		$this->db->where('record_status','1');
		$this->db->order_by('category_name');
		$result = $this->db->get();
		$output_data = $result->result_array();
		$output = array("aaData" => array());
		$slno = 1;
		foreach ($output_data as $aRow) 
        {
            $category_names[] = $aRow;
        }
		
        $this->db->select("jee_roll_no,full_name");
		$this->db->from('applicant_detail A');
		$this->db->join('counselling_applicant_appl_overview D','D.reg_user_id = A.jee_roll_no','left');
		$this->db->where('D.appl_status','Valid');
		$this->db->where('D.counselling_code',$counselling_code);
		$this->db->group_by('jee_roll_no');
		$this->db->order_by('rank1');
		$result = $this->db->get();
		//echo $this->db->last_query();
		$output_data = $result->result_array();
		foreach ($output_data as $aRow) 
        {
            $student_arr[] = $aRow;
        }
         
         
        $this->db->select("GROUP_CONCAT(CODE ORDER BY sl_no) AS code, GROUP_CONCAT(description ORDER BY sl_no SEPARATOR '@') AS description");
		$this->db->from('gen_code_description');
		$this->db->where('code_group','RANK');
		$result = $this->db->get();
		//echo $this->db->last_query();
		$output_data = $result->result_array();
		foreach ($output_data as $aRow) 
        {
            $categories[] = $aRow;
            $codes = $aRow['code'];
        }
        
        $codes = str_replace(",",",'@',", $codes);
       // echo $codes;
        $this->db->select("concat($codes) AS ranks");
		$this->db->from('applicant_detail');
		$this->db->group_by('jee_roll_no');
		$this->db->order_by('rank1');
		$result = $this->db->get();
		//echo $this->db->last_query();
		$output_data = $result->result_array();
		foreach ($output_data as $aRow) 
        {
            $ranks[] = $aRow;
        }
       /* print_r($ranks);
        die();*/
        
        
        /*$slno = 1;
        foreach($student_arr as $row)
		{
			$student_details = array();
			$student_details[] = $slno;
			$student_details[] = $row['jee_roll_no'];
			$student_details[] = $row['full_name'];
			$category_arr = explode('@',$row['category_name']);
			$rank_arr = explode('@',$row['rank']);
			foreach($category_names as $row1)
			{
				if(in_array($row1['category_name'],$category_arr))
				{
					$key = array_search($row1['category_name'], $category_arr);
					$rank= array_key_exists($key,$rank_arr)?$rank_arr[$key]:'';
					$student_details[] ='<div style="text-align:center">'.$rank.'</div>';
				}
				else
				{
					$student_details[] = '';
				}
			}
			//print_r($student_details);
			$output['aaData'][] = $student_details;
			$slno++;
		}*/
		$output = array('categories'=>$categories, 'student_data'=>$student_arr,'ranks'=>$ranks,'category_names'=>$category_names);
		return $output;
	}
	
	private $_batchImport;

    public function setBatchImport($batchImport) {
        $this->_batchImport = $batchImport;
    }
    // save data
    public function importData() {
        $data = $this->_batchImport;
        //$this->db->on_duplicate_update($data);
      /*  print_r(sizeof($data));
        die();*/
		
        for($i=0;$i<sizeof($data);$i++)
		{
			
			$Program = $data[$i]['Program'];
			$where = "institute_name IS NOT NULL";
			$this->db->select('ipb_code,A.branch_code,D.program_code,C.institute_code');
        	$this->db->from('counselling_branch_master A');
	        $this->db->join('counselling_program_branch_institute_mapping B', 'B.branch_code = A.branch_code', 'LEFT');
	        $this->db->join('institute_master C', 'C.institute_code = B.institute_code', 'LEFT');
	        $this->db->join('counselling_program_master D', 'D.program_code = B.program_code', 'LEFT');
	        $this->db->join('category_master E','E.category_code = E.category_code', 'INNER');
	        $this->db->where($where);
	        $this->db->where('CONCAT(C.institute_name," - ",D.program_name," - ",A.branch) = ',$Program);
        	$this->db->where('E.record_status','1');
	        $this->db->group_by('ipb_code');
	        $this->db->order_by('branch');
			$res = $this->db->get();
			$output_data = $res->result_array();
			$output = array("aaData" => array());
			foreach ($output_data as $row) 
	        {
	        	$ipb_code = $row['ipb_code'];
	        	$branch_code = $row['branch_code'];
	        	$program_code = $row['program_code'];
	        	$ins_code = $row['institute_code'];
	        }
			$query = $res->result_array();
			if($data[$i]['no_of_seats'] != '')
			{
				$this->db->select('count(ipb_code) as cnt');
		        $this->db->from('counselling_program_branch_institute_seat_master');
		        $this->db->where('ipb_code',$ipb_code);
	        	$this->db->where('branch_code', $branch_code);
	        	$this->db->where('program_code', $program_code);
	        	$this->db->where('institute_code', $ins_code);
	        	$this->db->where('category_code', $data[$i]['category_code']);
				$res = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $res->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
		        {
		        	$cnt = $row['cnt'];
		        }
				
				/*print_r($cnt);
				die(); */
		        if($cnt > 0) {
		        	$makeArray1 = array('no_of_seats' => $data[$i]['no_of_seats']);
		        	$this->db->where('ipb_code', $ipb_code);
		        	$this->db->where('branch_code', $branch_code);
		        	$this->db->where('program_code', $program_code);
		        	$this->db->where('institute_code', $ins_code);
		        	$this->db->where('category_code', $data[$i]['category_code']);
					$this->db->update('counselling_program_branch_institute_seat_master', $makeArray1);
					
				}
				else
				{
					$makeArray = array('ipb_code' => $ipb_code,'branch_code' => $branch_code,'program_code' => $program_code,'institute_code' => $ins_code,'category_code' => $data[$i]['category_code'], 'no_of_seats' => $data[$i]['no_of_seats']);
					$this->db->insert('counselling_program_branch_institute_seat_master', $makeArray);
				}
			}
			
		}
        
    }
    
    // get employee list
    public function employeeList() {
    	$where = "institute_name IS NOT NULL";
        $this->db->select('CONCAT(C.institute_name," - ",D.program_name," - ",A.branch) as branch,category_name,no_of_seats');
    	$this->db->from('counselling_branch_master A');
        $this->db->join('counselling_program_branch_institute_seat_master B', 'B.branch_code = A.branch_code', 'LEFT');
        $this->db->join('institute_master C', 'C.institute_code = B.institute_code', 'LEFT');
        $this->db->join('counselling_program_master D', 'D.program_code = B.program_code', 'LEFT');
        $this->db->join('category_master E','B.category_code = E.category_code', 'INNER');
        $this->db->where($where);
        $this->db->where('E.record_status','1');
        $this->db->order_by('branch');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    // save data
    public function importApplicantsData() {
        $data = $this->_batchImport;
        //$this->db->on_duplicate_update($data);
      /*  print_r(sizeof($data));
        die();*/
		
        for($i=0;$i<sizeof($data);$i++)
		{
			$JEERollNo = $data[$i]['jee_roll_no'];
			$this->db->select('jee_roll_no');
        	$this->db->from('applicant_detail');
			$this->db->where('jee_roll_no', $JEERollNo);
			$res = $this->db->get();
			
			$query = $res->result_array();
			$makeArray = array('jee_roll_no' => $data[$i]['jee_roll_no'], 'full_name' => $data[$i]['full_name'],'course' => $data[$i]['course'],
					'exam_center_code' => $data[$i]['exam_center_code'],'dob' => $data[$i]['dob'],'applicant_mobile' => $data[$i]['applicant_mobile'],
                    'gender' => $data[$i]['gender'], 'category' => $data[$i]['category'],
					'mark_obtained' => $data[$i]['mark_obtained'],'final_year_percentage' => $data[$i]['final_year_percentage'],
					'ug_percentage' => $data[$i]['ug_percentage'],'ph' => $data[$i]['ph'],'ne' => $data[$i]['ne'],
					'rank' => $data[$i]['rank'],'rank1' => $data[$i]['rank1'],'rank2' => $data[$i]['rank2'],'rank3' => $data[$i]['rank3'],
                    'rank4' => $data[$i]['rank4'],'rank5' => $data[$i]['rank5'],'rank6' => $data[$i]['rank6']);
			if($res->num_rows() > 0) {
	        	$this->db->where('jee_roll_no', $JEERollNo);
				$this->db->update('applicant_detail', $makeArray);
				
			}
			else
			{
				$this->db->insert('applicant_detail', $makeArray);
			}				
		}
        
    }
    
    /**
     * 	Generate random registration_no 
     */
    public function rand_number($length) {
        $chars = "0123456789";
        return substr(str_shuffle($chars), 0, $length);
    }

    public function admin($data, $op, $stage = null) {
        /**
		* logic: To operate data for superadmin master setup
		* date :11/09/2017
		*/
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
			case 'get_institute_data':
				//$ins = $data;
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
			case 'get_sidebar':
				$this->db->select('A.*');
				$this->db->from('menu_master as A');
				$this->db->where('A.role_code',$this->session->userdata('role'));
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.sl_no','asc');
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_active_program_list':
				$this->db->select('program_name, program_code,program_group');
				$this->db->from('counselling_program_master');
				$this->db->where('status','Active');
				$result = $this->db->get();
				//echo $this->db->last_query();
				return $result1 = $result->result_array();
			case 'get_uploaded_document_list':
				$this->db->select('applied_program, COUNT(*) AS cnt');
				$this->db->from('applicant_appl_overview');
				$this->db->where('appl_status','Document Uploaded');
				$this->db->group_by('applied_program');
				$result = $this->db->get();
				return $result1 = $result->result_array();
			break;
			case 'get_online_paid_list':
				$this->db->select('applied_program, COUNT(*) AS cnt');
				$this->db->from('counselling_applicant_form_fee_overview A');
				$this->db->join("applicant_appl_overview B","B.appl_no = A.appl_no","inner");
				$this->db->join("applicant_form_online_deposit C","B.appl_no = C.appl_no","inner");
				$this->db->where('C.deposit_status','SUCCESS');
				$this->db->where('money_receipt_no !=','');
				$this->db->where('A.money_deposit_mode','ONLINE');
				$this->db->group_by('applied_program');
				$result = $this->db->get();
				return $result1 = $result->result_array();
			break;
			case 'get_challan_verified_list':
				$this->db->select('applied_program, COUNT(*) AS cnt');
				$this->db->from('counselling_applicant_form_fee_overview A');
				$this->db->join("applicant_appl_overview B","B.appl_no = A.appl_no","inner");
				$this->db->join("applicant_form_challan_deposit C","A.appl_no = C.appl_no","inner");
				$this->db->where('appl_status','Verified');
				$this->db->where('deposit_status','Deposited');
				$this->db->where('money_receipt_no !=','');
				$this->db->where('A.money_deposit_mode','CHALLAN');
				$this->db->group_by('applied_program');
				$result = $this->db->get();
				return $result1 = $result->result_array();
			break;
			case 'get_SCST_list':
				$this->db->select('A.applied_program, COUNT(*) AS cnt');
				$this->db->from('applicant_master A');
				$this->db->join("applicant_appl_overview B","A.reg_user_id = B.reg_user_id","inner");
				$this->db->where_in("category" ,'("SC", "ST", "EBC")');
				$this->db->where('appl_status','Verified');
				$this->db->group_by('A.applied_program');
				$result = $this->db->get();
				return $result1 = $result->result_array();
			break;
			case 'get_OnCounter_list':
				$this->db->select('applied_program, COUNT(*) AS cnt');
				$this->db->from('counselling_applicant_form_fee_overview A');
				$this->db->join("applicant_appl_overview B","B.appl_no = A.appl_no","inner");
				$this->db->where('A.money_deposit_mode','ON THE COUNTER');
				$this->db->group_by('applied_program');
				$result = $this->db->get();
				return $result1 = $result->result_array();
			break;
			
			case 'get_all_program_list':
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$sel_program_group = $this->session->flashdata('sel_program_group');
				//echo $sel_program_group;
				//die();
				$user = $logged_user.'_'.$institute_code;
				$this->db->distinct(" P.program_group ");
				$this->db->select("A.sl_no, P.program_group ");
				$this->db->from('counselling_program_master P');
				$this->db->join("user_program_mapping U","P.program_code = U.program_code","inner");
				$this->db->join("program_group_master A","P.program_group = A.program_group_name ","inner");
				$this->db->where('P.record_status','1');
				$this->db->where('U.record_status','1');
				$this->db->where('A.record_status','1');
				$this->db->where('P.institute_code',$institute_code);
				$this->db->where('U.institute_code',$institute_code);
				$this->db->where('U.user_code',$user);
				$this->db->order_by('A.sl_no');
				
				$result = $this->db->get();
				return $result1 = $result->result_array();
			break;
			case 'only_registred':
				$this->db->select("COUNT(*) AS Registered ");
				$this->db->from('applicant_reg_master arm ');
				$this->db->join('counselling_program_master pm','arm.applied_program = pm.program_code','inner');
				$this->db->join('applicant_appl_overview aao','arm.applied_program = aao.applied_program AND arm.reg_user_id = aao.reg_user_id','left');
				$this->db->where('pm.program_code',HARDCODE_PROGRAM_CODE);
				//$this->db->where('arm.reg_user_id NOT IN (SELECT reg_user_id FROM applicant_appl_overview )');
				$result = $this->db->get();
				//echo $this->db->last_query();
				return $result1 = $result->result_array();
			break;
			case 'application_count':
				$logged_user_code = $this->session->userdata('user_code');
				$user_code_array=explode('_',$logged_user_code);
				$course_code = $user_code_array[0];
				$searchstring='';
				if($course_code!='NIRTAR'){
					$searchstring = "and am.master_name='".$course_code."'";
				}
				$qry ="SELECT SUM(CASE WHEN A.appl_status='Verified' THEN application_count  END ) AS 'Fee_Paid',
					SUM(CASE WHEN  A.appl_status='Student Details Submitted' || A.appl_status='Document Uploaded' || A.appl_status='Verified' THEN application_count END) AS 'Profile_Submitted' ,
					SUM(CASE WHEN A.appl_status='Document Uploaded' || A.appl_status='Verified' THEN application_count END)  AS 'Document_Uploaded' ,course_code ,course_name,course_id FROM
					(SELECT COUNT(aao.reg_user_id) AS application_count,aao.appl_status,cm.course_code,cm.course_id ,cm.course_name FROM applicant_reg_master arm 
					INNER JOIN counselling_program_master pm ON arm.applied_program = pm.program_code
					INNER JOIN applicant_appl_overview aao 
					ON arm.applied_program = aao.applied_program AND arm.reg_user_id = aao.reg_user_id
					INNER JOIN applicant_master am ON arm.applied_program = am.applied_program AND arm.reg_user_id = am.reg_user_id
					INNER JOIN course_master cm ON am.master_name = cm.course_code
					WHERE pm.program_code ='".HARDCODE_PROGRAM_CODE."'  $searchstring
					GROUP BY aao.appl_status,cm.course_code,cm.course_id ,cm.course_name) A
					GROUP BY course_code,course_name,course_id ORDER BY course_id  ";
				$result = $this->db->query($qry);
				/*$sql=$this->db->last_query();
				print_r($sql);die();*/
				return $result1 = $result->result_array();
			break;
			case 'scrutiny_count':
				$logged_user_code = $this->session->userdata('user_code');
				$user_code_array=explode('_',$logged_user_code);
				$course_code = $user_code_array[0];
				$searchstring='';
				if($course_code!='NIRTAR'){
					$searchstring = "and am.master_name='".$course_code."'";
				}
				$result1=array();
				$qry ="SELECT B.course_code,B.course_name,B.Rejected,B.Accepted ,(B.Rejected + B.Accepted)AS Total FROM
					(SELECT A.course_code,A.course_name, 
					 IFNULL(SUM(CASE WHEN A.scrutiny_status = 'Invalid' THEN A.scrutiny_count END),0) AS 'Rejected',
					IFNULL(SUM(CASE WHEN A.scrutiny_status = 'Valid' THEN A.scrutiny_count END),0) AS 'Accepted',course_id
					FROM
					(SELECT COUNT(*) AS scrutiny_count ,cm.course_code,arm.scrutiny_status,cm.course_name,cm.course_id
					FROM applicant_reg_master arm 
					INNER JOIN counselling_program_master pm ON arm.applied_program = pm.program_code
					INNER JOIN applicant_appl_overview aao 
					ON arm.applied_program = aao.applied_program AND arm.reg_user_id = aao.reg_user_id
					INNER JOIN applicant_master am ON arm.applied_program = am.applied_program AND arm.reg_user_id = am.reg_user_id
					INNER JOIN course_master cm ON am.master_name = cm.course_code
					LEFT JOIN counselling_applicant_form_fee_overview affo ON aao.appl_no = affo.appl_no
					WHERE pm.program_code = '".HARDCODE_PROGRAM_CODE."' $searchstring AND (arm.scrutiny_status = 'Invalid' OR arm.scrutiny_status = 'Valid')
					GROUP BY cm.course_code,arm.scrutiny_status,cm.course_name) A
					GROUP BY course_code,course_name,course_id order by course_id )B";
				$result = $this->db->query($qry);
				/*$sql=$this->db->last_query();
				print_r($sql);die();*/
				return $result1 = $result->result_array();
			break;
			case 'dashboard_registration_report':
				$appl_status = isset($_POST['appl_status'])?$_POST['appl_status']:'';
				$course_code = isset($_POST['course_code'])?$_POST['course_code']:'';
				
				$join = 'inner';
				if($appl_status !='' && $appl_status !='Only Registred')
				{
					if($appl_status == 'Document Uploaded'){
						$this->db->where("aao.appl_status in ('Document Uploaded','Verified')");
					}else if($appl_status == 'Student Details Submitted'){
						$this->db->where("aao.appl_status in ('Student Details Submitted','Document Uploaded','Verified')");
					}else{
						$this->db->where('aao.appl_status',$appl_status);
					}
				}
				if($course_code !='')
				{
					$this->db->where('am.master_name',$course_code);
				}
				
				if($appl_status == 'Only Registred'){
					$join = 'left';
					//$this->db->where('arm.reg_user_id NOT IN (SELECT reg_user_id FROM applicant_appl_overview )');
				}
				
				$this->db->select("CONCAT(arm.first_name, ' ' , arm.mid_name , ' ',arm.last_name) AS applicant_name, SUBSTRING(aao.appl_no,-10)as appl_no ,arm.reg_user_id AS mobile,cm.course_name,aao.created_on AS application_date,ecm.exam_centre_name AS center_1, ecm1.exam_centre_name AS center_2, ecm2.exam_centre_name AS center_3,CASE WHEN aao.appl_status = 'Verified' THEN 'Fee Paid' ELSE aao.appl_status END as appl_status ,affo.money_deposit_mode  ,CASE WHEN affo.money_receipt_no != '' THEN 'SUCCESS' ELSE ' ' END AS payment_status");
				$this->db->from('applicant_reg_master arm');
				$this->db->join('counselling_program_master pm','arm.applied_program = pm.program_code','inner');
				$this->db->join('applicant_appl_overview aao','arm.applied_program = aao.applied_program AND arm.reg_user_id = aao.reg_user_id',$join);
				$this->db->join('applicant_master am','arm.applied_program = am.applied_program AND arm.reg_user_id = am.reg_user_id',$join);
				$this->db->join('course_master cm','am.master_name = cm.course_code',$join);
				$this->db->join('counselling_applicant_form_fee_overview affo','aao.appl_no = affo.appl_no','left');
				$this->db->join('exam_centre_master ecm','am.exam_center_code = ecm.exam_centre_code','left');
				$this->db->join('exam_centre_master ecm1','am.exam_center_code1 = ecm1.exam_centre_code','left');
				$this->db->join('exam_centre_master ecm2','am.exam_center_code2 = ecm2.exam_centre_code','left');
				$this->db->where('arm.status','1');
				$this->db->where('pm.program_code',HARDCODE_PROGRAM_CODE);
				
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
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
			case 'dashboard_registration_report_scrutiny':
				$appl_status = isset($_POST['appl_status'])?$_POST['appl_status']:'';
				$course_code = isset($_POST['course_code'])?$_POST['course_code']:'';
				
				$join = 'inner';
				
				if($appl_status !='' && $appl_status =='Total')
				{
					$this->db->where('(arm.scrutiny_status = "Invalid" OR arm.scrutiny_status = "Valid")');
				}
				else if($appl_status !='' && $appl_status =='Rejected'){
					$this->db->where('arm.scrutiny_status = "Invalid" AND arm.scrutiny_remark != " "');
				}
				else if($appl_status !='' && $appl_status =='Accepted'){
					$this->db->where('arm.scrutiny_status = "Valid"');
				}
				
				if($course_code !='')
				{
					$this->db->where('am.master_name',$course_code);
				}
				
				$this->db->select("CONCAT(arm.first_name, ' ' , arm.mid_name , ' ',arm.last_name) AS applicant_name, aao.appl_no,arm.reg_user_id AS mobile,cm.course_name,aao.created_on AS application_date,ecm.exam_centre_name AS center_1, ecm1.exam_centre_name AS center_2, ecm2.exam_centre_name AS center_3,aao.appl_status,affo.money_deposit_mode,CASE WHEN affo.money_receipt_no != '' THEN 'SUCCESS' ELSE 'FAILURE' END AS payment_status");
				$this->db->from('applicant_reg_master arm');
				$this->db->join('counselling_program_master pm','arm.applied_program = pm.program_code','inner');
				$this->db->join('applicant_appl_overview aao','arm.applied_program = aao.applied_program AND arm.reg_user_id = aao.reg_user_id',$join);
				$this->db->join('applicant_master am','arm.applied_program = am.applied_program AND arm.reg_user_id = am.reg_user_id',$join);
				$this->db->join('course_master cm','am.master_name = cm.course_code',$join);
				$this->db->join('counselling_applicant_form_fee_overview affo','aao.appl_no = affo.appl_no','left');
				$this->db->join('exam_centre_master ecm','am.exam_center_code = ecm.exam_centre_code','left');
				$this->db->join('exam_centre_master ecm1','am.exam_center_code1 = ecm1.exam_centre_code','left');
				$this->db->join('exam_centre_master ecm2','am.exam_center_code2 = ecm2.exam_centre_code','left');
				$this->db->where('arm.status','1');
				$this->db->where('pm.program_code',HARDCODE_PROGRAM_CODE);
				
				
				$result = $this->db->get();
				//echo $this->db->last_query();
				
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
			
            case 'get_userdata':
                $order = '';
                $Ocolumn = '';
                $Odir = '';
                $order = $this->input->post('order');
                if ($order) {
                    foreach ($order as $row) {
                        $Ocolumn = $row['column'];
                        $Odir = $row['dir'];
                    }
                    $this->db->order_by($Ocolumn, $Odir);
                } else {
                    $this->db->order_by(1, "ASC");
                }
                $search = $this->input->post('search');
                $header = array('user_name', 'user_display_name');//search filter will work on this column
                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }

                $iDisplayLength = $this->input->post('length');//to shw number of record to be shown
                $iDisplayStart = $this->input->post('start');//to start from that position (ex: offset)

                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->from('user_master');
                $this->db->select("user_code,user_name,user_display_name,password,profile_img,record_status");
               	
               	$res = $this->db->get();
                $query = $res->result_array();
                $output = array("aaData" => array());
				/*----FOR PAGINATION-----*/
                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }

                $this->db->from('user_master');
                $this->db->select("user_code,user_name,user_display_name,password,profile_img,record_status");
                
                $res1 = $this->db->get();
                
                $output["draw"] = intval($this->input->post('draw'));
                $output['iTotalRecords'] = $res1->num_rows();
                $output['iTotalDisplayRecords'] = $res1->num_rows();
                $slno = 1;
                foreach ($query as $aRow) {
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
            case 'add_user':
            	$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	$qry = $this->db->query("SELECT MAX(id)+1 AS max_id FROM user_master");
				$Sresult = $qry->result_array();
				$row2 = array_shift($Sresult);
				$data = array( "user_code" =>$row2['max_id'].rand(1000,99999),
								"user_name" => $this->input->post('txtUserName'),
								"password" => $this->input->post('txtPassword'),
								"user_display_name" => $this->input->post('txtDisplayName'),
								"record_status" => $this->input->post('user_status'),
								"created_by" => 'superadmin',
								"created_on" => date('Y-m-d H:i:s', now())
							);
				$insert_user = $this->db->insert('user_master',$data);
				if( ! $insert_user){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
				return array('status'=>$dbstatus,'msg'=>$dbmessage);
			break;
			case 'edit_user':
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
				$data = array( "user_name" => $this->input->post('txtUserName'),
								"password" => $this->input->post('txtPassword'),
								"user_display_name" => $this->input->post('txtDisplayName'),
								"record_status" => $this->input->post('user_status'),
								"updated_by" => 'superadmin'
							);
				$this->db->where('user_code',$this->input->post('hiduser_code'));
				$insert_user = $this->db->update('user_master',$data);
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
			    return array('status'=>$dbstatus,'msg'=>$dbmessage);
            break;
            case 'delete_user':
                $dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
                $new_data = array(
                    "record_status" => 0,
					"updated_by" => 'superadmin'
                );
                //print_r($new_data);die();
                $this->db->where('user_code',$this->input->post('user_code'));
                $deleteuser = $this->db->update('user_master', $new_data);
                if ($this->db->affected_rows() ==0){
                    $dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
				return array('status' => $dbstatus, 'msg' => $dbmessage);
            break;
            /**
			* logic: To operate data for menu master
			* case:get_role,get_url_link,get_parent_menu,get_menudata,add_menu,edit_menu,delete_menu,copy_menu
			* author:Ashish narayan barick
			* date :11/09/2017
			*/
            case 'get_role' :
            	$this->db->select('*');
            	$this->db->from('role_master');
            	$this->db->where("record_status",1);
				$role_res = $this->db->get();
				$role_data ='';
				if ($role_res->num_rows() > 0) {
					$role_data = $role_res->result_array();
					foreach ($role_data as $key => $role):
						$this->db->select('menu_id,resource_code');
						$this->db->where("role_code",$role['role_code']);
						$parent_res = $this->db->get('menu_master');
						if ($parent_res->num_rows() > 0) {
							$parent_data = $parent_res->result_array();
							$role_data[$key]['parent_data'] = $parent_data;
						}
					endforeach;
				}
				return $role_data;
				
				
			break;
			case 'get_url_link':
				$output = array("aaData" => array());
				$this->db->select("resource_code,resource_name");
				$this->db->from("resource_master");
				$this->db->where("record_status",1);
				$this->db->order_by("id");
				$result = $this->db->get();
				$output_data = $result->result_array();
				return $output_data;
			break;
			case 'check_duplicate_course':
				$program = $data['txtCourseCodeAdd'];
				$output = array("aaData" => array());
				$this->db->select("program_code");
				$this->db->from("counselling_program_master");
				$this->db->where("record_status",1);
				$this->db->where("program_code",$program);
				$this->db->order_by("id");
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				return $output_data;
			break;
			case 'get_parent_menu' :
				$output = array("aaData" => array());
				$role = $data['cmbRole'];
				$this->db->select("menu_id,resource_code");
				$this->db->from("menu_master");
				$this->db->where("record_status",1);
				$this->db->where("role_code",$role);
				$this->db->where("parent_id",0);
				$result = $this->db->get();
				$output_data = $result->result_array();
				return $output_data;
			break;
            case 'get_menudata':
				$order = '';
                $Ocolumn = '';
                $Odir = '';
                $order = $this->input->post('order');
                if ($order) {
                    foreach ($order as $row) {
                        $Ocolumn = $row['column'];
                        $Odir = $row['dir'];
                    }
                    $this->db->order_by($Ocolumn, $Odir);
                } else {
                    $this->db->order_by(1, "ASC");
                }
                $search = $this->input->post('search');
                $header = array('user_name', 'user_display_name');//search filter will work on this column
                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }
				if($data['menu_role'])
					$this->db->where(" m1.role_code",$data['menu_role']);
                $iDisplayLength = $this->input->post('length');//to shw number of record to be shown
                $iDisplayStart = $this->input->post('start');//to start from that position (ex: offset)

                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->select("r.role_name,m1.menu_name,m1.resource_code,m1.parent_id,
									m1.sl_no,
									CASE WHEN m1.has_child = 1 THEN 'Yes' 
									WHEN m1.has_child = 0 THEN 'No' 
									ELSE '' END AS has_child,
									CASE WHEN m1.is_last_child = 1 THEN 'Yes' 
									WHEN m1.is_last_child = 0 THEN 'No' 
									ELSE '' END AS is_last_child,m1.access_type,m1.icon_class,
									m1.menu_id,m1.role_code,m1.target");
				$this->db->from("role_master r,menu_master m1");
				$this->db->join("(SELECT menu_name,parent_id,menu_id 
							FROM menu_master 
							WHERE record_status=1) b","b.menu_id = m1.parent_id", "LEFT");
				$this->db->where("m1.role_code = r.role_code");
				$this->db->where("m1.record_status",1);
				
				$res = $this->db->get();
                $query = $res->result_array();
                $output = array("aaData" => array());
                /*----FOR PAGINATION -----*/
                if ($search['value'] != '') 
                {
                    for ($i = 0; $i < count($header); $i++) 
                    {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }
                if($data['menu_role'])
					$this->db->where(" m1.role_code",$data['menu_role']);
				$this->db->select("r.role_name,m1.menu_name,m1.resource_code,m1.parent_id,
									m1.sl_no,
									CASE WHEN m1.has_child = 1 THEN 'Yes' 
									WHEN m1.has_child = 0 THEN 'No' 
									ELSE '' END AS has_child,
									CASE WHEN m1.is_last_child = 1 THEN 'Yes' 
									WHEN m1.is_last_child = 0 THEN 'No' 
									ELSE '' END AS is_last_child,m1.access_type,m1.icon_class,
									m1.menu_id,m1.role_code,m1.target");
				$this->db->from("role_master r,menu_master m1");
				$this->db->join("(SELECT menu_name,parent_id,menu_id 
							FROM menu_master 
							WHERE record_status=1) b","b.menu_id = m1.parent_id", "LEFT");
				$this->db->where("m1.role_code = r.role_code");
				$this->db->where("m1.record_status",1);
				 
                $res1 = $this->db->get();
                
                $output["draw"] = intval($this->input->post('draw'));
                $output['iTotalRecords'] = $res1->num_rows();
                $output['iTotalDisplayRecords'] = $res1->num_rows();
                $slno = 1;
                foreach ($query as $aRow) 
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
               	return $output; // Data Send to the controller then datatable
			break;
			case 'add_institute':
            	$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	$image_name = "";
            	
				if(isset($_FILES['fileinstitutelogo']['tmp_name']) && !empty($_FILES['fileinstitutelogo']['tmp_name']))
				{
					$imageFileType = end((explode(".", $_FILES['fileinstitutelogo']['name'])));
					$check = getimagesize($_FILES["fileinstitutelogo"]["tmp_name"]);
					if($check !== false) {

					} 
					else 
					{
						return array('status'=>false, 'msg'=>"Not an Image");
					}
					// Check file size
					if($_FILES["fileinstitutelogo"]["size"] > 1536000) {
						return array('status'=>false, 'msg'=>"Size of the image should be within 1MB");
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
						return array('status'=>false, 'msg'=>"Supported file types are jpg/png/jpeg/gif");
					}
					if(isset($_FILES['fileinstitutelogo']['tmp_name']) && !empty($_FILES['fileinstitutelogo']['tmp_name'])){
					//$image_name = base64_encode(file_get_contents($_FILES['fileinstitutelogo']['tmp_name']));
					//$pic_name = $this->session->userdata('user_id')."1".time().".png";//$_FILES['fileinstitutelogo']['name'];
					$pic_name = $this->input->post('institutecode').".".$imageFileType;//$_FILES['fileinstitutelogo']['name'];
					$uploads_dir = APPPATH."../public/assets/images/logo/".$pic_name;
					//echo $uploads_dir. base_url('public');
					$result = move_uploaded_file($_FILES['fileinstitutelogo']['tmp_name'], $uploads_dir);
					//echo "PHoto upload status".$result.dirname(__FILE__) ;
					//echo FCPATH."#".APPPATH."##".BASEPATH;
					//die();
					}
				}
				else
				{
					$pic_name = '';
				}
				if(isset($_FILES['fileInstituteImage']['tmp_name']) && !empty($_FILES['fileInstituteImage']['tmp_name']))
				{
					$imageFileType = end((explode(".", $_FILES['fileInstituteImage']['name'])));
					$check = getimagesize($_FILES["fileInstituteImage"]["tmp_name"]);
					if($check !== false) {

					} 
					else 
					{
						return array('status'=>false, 'msg'=>"Not an Image");
					}
					// Check file size
					if($_FILES["fileInstituteImage"]["size"] > 1536000) {
						return array('status'=>false, 'msg'=>"Size of the image should be within 1MB");
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
						return array('status'=>false, 'msg'=>"Supported file types are jpg/png/jpeg/gif");
					}
					if(isset($_FILES['fileInstituteImage']['tmp_name']) && !empty($_FILES['fileInstituteImage']['tmp_name'])){
					//$image_name = base64_encode(file_get_contents($_FILES['fileInstituteImage']['tmp_name']));
					//$pic_name = $this->session->userdata('user_id')."1".time().".png";//$_FILES['fileInstituteImage']['name'];
					$img_file_name = $this->input->post('institutecode').".".$imageFileType;//$_FILES['fileInstituteImage']['name'];
					$uploads_dir = APPPATH."../public/assets/images/".$pic_name;
					//echo $uploads_dir. base_url('public');
					$result = move_uploaded_file($_FILES['fileInstituteImage']['tmp_name'], $uploads_dir);
					//echo "PHoto upload status".$result.dirname(__FILE__) ;
					//echo FCPATH."#".APPPATH."##".BASEPATH;
					//die();
					}
				}
				else
				{
					$img_file_name = '';
				}

				$data_institute = array( "institute_name" =>$this->input->post('institutename'),
								"institute_code" =>$this->input->post('institutecode'),
								"institute_type" =>$this->input->post('txtinstituteType'),
								"website_address" =>$this->input->post('txtWebaddress'),
								"contact_number" =>$this->input->post('txtContactNo'),
								"location" =>$this->input->post('txtLocation'),
								"logo_url" =>$pic_name,
								"image_url" =>$img_file_name,
								"admin_name" =>$this->input->post('instituteadmindisplayname'),
								"admin_user_name" =>$this->input->post('instituteadminusername'),
								"institute_address" =>$this->input->post('txtAddress'),
								"created_by" => 'SUPADM001',
								"created_on" => date('Y-m-d H:i:s', now())
							);
			
				$this->db->trans_start();
				$insert_institute = $this->db->insert('institute_master',$data_institute);
			
				    
				$this->db->trans_complete();
				
				return array('status'=>$dbstatus,'msg'=>$dbmessage);
			break;
			case 'edit_institute':
				if(isset($_FILES['fileinstitutelogoEdit']['tmp_name']) && !empty($_FILES['fileinstitutelogoEdit']['tmp_name']))
				{
					$imageFileType = end((explode(".", $_FILES['fileinstitutelogoEdit']['name'])));
					$check = getimagesize($_FILES["fileinstitutelogoEdit"]["tmp_name"]);
					if($check !== false) {

					} 
					else 
					{
						return array('status'=>false, 'msg'=>"Not an Image");
					}
					// Check file size
					if($_FILES["fileinstitutelogoEdit"]["size"] > 1536000) {
						return array('status'=>false, 'msg'=>"Size of the image should be within 1MB");
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
						return array('status'=>false, 'msg'=>"Supported file types are jpg/png/jpeg/gif");
					}
					if(isset($_FILES['fileinstitutelogoEdit']['tmp_name']) && !empty($_FILES['fileinstitutelogoEdit']['tmp_name'])){
					//$image_name = base64_encode(file_get_contents($_FILES['fileinstitutelogoEdit']['tmp_name']));
					//$pic_name = $this->session->userdata('user_id')."1".time().".png";//$_FILES['fileinstitutelogoEdit']['name'];
					$pic_name = $this->input->post('institutecode').".".$imageFileType;//$_FILES['fileinstitutelogoEdit']['name'];
					$uploads_dir = APPPATH."../public/assets/images/logo/".$pic_name;
					//echo $uploads_dir. base_url('public');
					$result = move_uploaded_file($_FILES['fileinstitutelogoEdit']['tmp_name'], $uploads_dir);
					//echo "PHoto upload status".$result.dirname(__FILE__) ;
					//echo FCPATH."#".APPPATH."##".BASEPATH;
					//die();
					}
				}
				else
				{
					$pic_name = '';
				}
				if(isset($_FILES['fileInstituteImageEdit']['tmp_name']) && !empty($_FILES['fileInstituteImageEdit']['tmp_name']))
				{
					$imageFileType = end((explode(".", $_FILES['fileInstituteImageEdit']['name'])));
					$check = getimagesize($_FILES["fileInstituteImageEdit"]["tmp_name"]);
					if($check !== false) {

					} 
					else 
					{
						return array('status'=>false, 'msg'=>"Not an Image");
					}
					// Check file size
					if($_FILES["fileInstituteImageEdit"]["size"] > 1536000) {
						return array('status'=>false, 'msg'=>"Size of the image should be within 1MB");
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
						return array('status'=>false, 'msg'=>"Supported file types are jpg/png/jpeg/gif");
					}
					if(isset($_FILES['fileInstituteImageEdit']['tmp_name']) && !empty($_FILES['fileInstituteImageEdit']['tmp_name'])){
					//$image_name = base64_encode(file_get_contents($_FILES['fileInstituteImageEdit']['tmp_name']));
					//$pic_name = $this->session->userdata('user_id')."1".time().".png";//$_FILES['fileInstituteImageEdit']['name'];
					$img_file_name = $this->input->post('institutecode').".".$imageFileType;//$_FILES['fileInstituteImageEdit']['name'];
					$uploads_dir = APPPATH."../public/assets/images/".$pic_name;
					//echo $uploads_dir. base_url('public');
					$result = move_uploaded_file($_FILES['fileInstituteImageEdit']['tmp_name'], $uploads_dir);
					//echo "PHoto upload status".$result.dirname(__FILE__) ;
					//echo FCPATH."#".APPPATH."##".BASEPATH;
					//die();
					}
				}
				else
				{
					$img_file_name = '';
				}
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
				$data_edit_institute = array( "institute_name" => $this->input->post('instituteeditname'),
								"institute_type" =>$this->input->post('txtinstituteTypeEdit'),
								"website_address" =>$this->input->post('txtWebaddressEdit'),
								"contact_number" =>$this->input->post('txtContactNoEdit'),
								"location" =>$this->input->post('txtLocationEdit'),
								"admin_name" =>$this->input->post('instituteadmindisplaynameEdit'),
								"admin_user_name" =>$this->input->post('instituteadminusernameEdit'),
								"institute_address" =>$this->input->post('txtAddress'),
								"record_status" => $this->input->post('cmbRecordStatusEdit'),
								"updated_by" => 'SUPADM001',
								"updated_on" => date('Y-m-d H:i:s', now())
							);
				
				$this->db->where('institute_code',$this->input->post('instituteeditcode'));
				$insert_user = $this->db->update('institute_master',$data_edit_institute);
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
				
			    return array('status'=>$dbstatus,'msg'=>$dbmessage);
            break;
			case 'get_institute_setup_data':
				$this->db->select("CONCAT(institute_name,'`',website_address) AS institute, A.institute_code, institute_type, 
							website_address, contact_number,  A.record_status as record, 
							CASE WHEN A.record_status = 1 THEN 'ACTIVE' ELSE 'INACTIVE' END AS record_status, logo_url,location,
							institute_address,image_url,A.institute_name");
				$this->db->from('institute_master A');
				$this->db->where('counselling_status','YES');
				//print_r($query);
				echo $this->db->last_query();
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			case 'add_course':
            	$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
				$data_course = array( "program_code" =>$this->input->post('txtCourseCodeAdd'),
								"program_name" =>$this->input->post('txtCourseNameAdd'),
								"created_by" => 'SUPADM001',
								"created_on" => date('Y-m-d H:i:s', now()),
								"institute_code" => $this->session->userdata("institute_code")
							);
				
				$insert_course = $this->db->insert('counselling_program_master',$data_course);    
				//echo $this->db->last_query();
				if( $this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
				return array('status'=>$dbstatus,'msg'=>$dbmessage);
			break;
			case 'add_course_discipline':
            	$status = TRUE;
            	$message = 'Data saved successfully';
				$CourseCodeAdd=$_POST['cmbCourseAdd'];
				$cmbDisciplineAdd=$_POST['cmbDisciplineAdd'];
				$txtDisciplineEdit=$_POST['txtDisciplineEdit'];
				$cmbDisciplineAddSizeof = sizeof($cmbDisciplineAdd);
				$count=array();
				$error_count = 0;
				$success_count = 0;
				for($i=0;$i<$cmbDisciplineAddSizeof;$i++)
		 	 	{
					$disciplineCode = $cmbDisciplineAdd[$i];
					$DisciplineEdit = $txtDisciplineEdit[$i];
					if($disciplineCode != 'multiselect-all')
					{
						$data_course_discipline = array( 
								"program_code" => $CourseCodeAdd,
								"branch_code" =>$disciplineCode,
								"created_by" => 'SUPADM001',
								"created_on" => date('Y-m-d H:i:s', now()),
								"institute_code" => $this->session->userdata("institute_code")
							);
					
					
					//echo $QUERY;		
						$insert_course = $this->db->insert('counselling_program_branch_mapping',$data_course_discipline);
						if($this->db->affected_rows() !=0)
						{	
							$success_count++; 
						}		
						else
						{
							$error_count++;
							
						}	
					}		
				
				}
				if($error_count == 0)
				{
					$status = true;
					$msg = 'Successfully Inserted';
				}
				else if($error_count != 0 && $error_count != $cmbDisciplineAddSizeof)
				{
					$status =true;
					$msg = 'Successfully Inserted';
				}
				else if($error_count != 0 && $error_count == $cmbDisciplineAddSizeof)
				{
					$status = false;
					$msg = 'Insertion failed';
				}
				
	
				return array('status'=>$status,'msg'=>$msg);
			break;
			case 'update_course_discipline':
            	$status = TRUE;
            	$message = 'Data saved successfully';
				
				$data_course_discipline = array( 
					"branch_code" => $_REQUEST['disciplineCodeEdit'],
					"updated_by" => 'SUPADM001',
					"updated_on" => date('Y-m-d H:i:s', now())
				);
					
					
					//echo $QUERY;	\
				$this->db->where('program_code', $_POST['hidcourseCodeEdit']);	
				$this->db->where('branch_code', $_POST['hiddiscCodeEdit']);	
				$this->db->update('counselling_program_branch_mapping',$data_course_discipline);
				
						
				
				if($this->db->affected_rows() !=0)
				{
					$status = true;
					$msg = 'Successfully saved';
				}
				
				else 
				{
					$status = false;
					$msg = 'Error in update';
				}
				
	
				return array('status'=>$status,'msg'=>$msg);
			break;
			case 'update_course':
            	$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
				$data_course = array( "program_code" =>$this->input->post('txtCourseCodeAdd'),
								"program_name" =>$this->input->post('txtCourseNameAdd'),
								"updated_by" => 'SUPADM001',
								"updated_on" => date('Y-m-d H:i:s', now())
							);
				//$this->db->trans_start();
				$this->db->where('id', $this->input->post('hidUniqueid'));
                $this->db->update('counselling_program_master', $data_course); 
				//echo $this->db->last_query();
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
				return array('status'=>$dbstatus,'msg'=>$dbmessage);
			break;
			case 'delete_course':
            	$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	$this->db->where('id', $this->input->post('transData'));
				$this->db->delete('counselling_program_master');
				
				//echo $this->db->last_query(); 	
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting'.$this->db->_error_message();
				}
				
				
				return array('status'=>$dbstatus,'msg'=>$dbmessage);
			break;
			case 'delete_course_discipline':
            	$dbstatus = true;
            	$dbmessage = 'Data saved successfully';
            	$this->db->where('id', $this->input->post('transData'));
				$this->db->delete('counselling_program_branch_mapping');
				//echo $this->db->last_query(); 	
				if($this->db->affected_rows() ==0){
					$dbstatus = false;
					$dbmessage = 'Error While Deleting'.$this->db->_error_message();
				}
				
				
				return array('status'=>$dbstatus,'msg'=>$dbmessage);
			break;
			case 'add_discipline':
            	$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
				$data_discipline = array( "branch_code" =>$this->input->post('txtDisciplineCodeAdd'),
								"branch" =>$this->input->post('txtDisciplineAdd'),
								"created_by" => 'SUPADM001',
								"created_on" => date('Y-m-d H:i:s', now()),
								"institute_code" => $this->session->userdata("institute_code")
							);
				
				$insert_discipline = $this->db->insert('counselling_branch_master',$data_discipline);    
				//echo $this->db->last_query();
				if( $this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
				return array('status'=>$dbstatus,'msg'=>$dbmessage);
			break;
			case 'update_discipline':
            	$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
				$data_course = array( "branch_code" =>$this->input->post('txtDisciplineCodeAdd'),
								"branch" =>$this->input->post('txtDisciplineAdd'),
								"updated_by" => 'SUPADM001',
								"updated_on" => date('Y-m-d H:i:s', now())
							);
				//$this->db->trans_start();
				$this->db->where('id', $this->input->post('hidDiscid'));
                $this->db->update('counselling_branch_master', $data_course); 
				//echo $this->db->last_query();
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
				return array('status'=>$dbstatus,'msg'=>$dbmessage);
			break;
			case 'delete_discipline':
            	$dbstatus = TRUE;
            	$dbmessage = 'Data Deleted successfully';
            	$this->db->where('id', $this->input->post('transData'));
				$this->db->delete('counselling_branch_master');
				
				//echo $this->db->last_query(); 	
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting'.$this->db->_error_message();
				}
				
				
				return array('status'=>$dbstatus,'msg'=>$dbmessage);
			break;
			case 'add_menu':
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
				$linktext = ($this->input->post('txtmenulinktext')!= null)?$this->input->post('txtmenulinktext'):'';
				$role = ($this->input->post('cmbMenuRole')!= null)?$this->input->post('cmbMenuRole'):'';
				$resource = ($this->input->post('cmbMenuLinkURL')!= null)?$this->input->post('cmbMenuLinkURL'):'';
				$parent_id = ($this->input->post('cmbMenuParent')!= null)?$this->input->post('cmbMenuParent'):'';
				$sl_no = ($this->input->post('txtMenuslno')!= null)?$this->input->post('txtMenuslno'):'';
				$chkHasChild = ($this->input->post('txtHaschild')!= null)?$this->input->post('txtHaschild'):'';
				$chkIsLastChild = ($this->input->post('txtislastchild')!= null)?$this->input->post('txtislastchild'):'';
				$iconClass = ($this->input->post('txtIconClass')!= null)?$this->input->post('txtIconClass'):'';
				$menuAccess = ($this->input->post('cmbMenuAccess')!= null)?$this->input->post('cmbMenuAccess'):'';
				$target = ($this->input->post('txtNewWindow')!= null)?$this->input->post('txtNewWindow'):'';
				
				$hasChild = ($chkHasChild == "Yes")?"1":"0";
				$isLastChild = ($chkIsLastChild == "Yes")?"1":"0";
				$new_data = array(
                    'menu_name' =>$linktext,
                    'role_code' =>$role,
                    'resource_code' => $resource,
                    'parent_id' => $parent_id,
                    'sl_no' => $sl_no,
                    'has_child' => $hasChild,
                    'is_last_child' => $isLastChild,
                    'icon_class' =>$iconClass,
                    'access_type' => $menuAccess,
                    'target' => $target,
                    'created_by' => 'superadmin',
                    'created_on' => 'NOW()'
               	);
               if ($this->db->insert('menu_master', $new_data))
                	return array('status' => $dbstatus, 'msg' => $dbmessage);
            	else 
            		return array('status' => FALSE, 'msg' => 'Error While Saving');
			break;
			case 'edit_menu':
				$dbstatus = TRUE;
            	$dbmessage = 'Data updated successfully';
				$linktext = ($this->input->post('txtmenulinktext')!= null)?$this->input->post('txtmenulinktext'):'';
				$role = ($this->input->post('cmbMenuRole')!= null)?$this->input->post('cmbMenuRole'):'';
				$resource = ($this->input->post('cmbMenuLinkURL')!= null)?$this->input->post('cmbMenuLinkURL'):'';
				$parent_id = ($this->input->post('cmbMenuParent')!= null)?$this->input->post('cmbMenuParent'):'';
				$sl_no = ($this->input->post('txtMenuslno')!= null)?$this->input->post('txtMenuslno'):'';
				$chkHasChild = ($this->input->post('txtHaschild')!= null)?$this->input->post('txtHaschild'):'';
				$chkIsLastChild = ($this->input->post('txtislastchild')!= null)?$this->input->post('txtislastchild'):'';
				$iconClass = ($this->input->post('txtIconClass')!= null)?$this->input->post('txtIconClass'):'';
				$menuAccess = ($this->input->post('cmbMenuAccess')!= null)?$this->input->post('cmbMenuAccess'):'';
				$target = ($this->input->post('txtNewWindow')!= null)?$this->input->post('txtNewWindow'):'';
				$hasChild = ($chkHasChild == "Yes")?"1":"0";
				$isLastChild = ($chkIsLastChild == "Yes")?"1":"0";
				$new_data = array(
                    'menu_name' =>$linktext,
                    'role_code' =>$role,
                    'resource_code' => $resource,
                    'parent_id' => $parent_id,
                    'sl_no' => $sl_no,
                    'has_child' => $hasChild,
                    'is_last_child' => $isLastChild,
                    'icon_class' =>$iconClass,
                    'access_type' => $menuAccess,
                    'target' => $target,
                    'updated_by' => 'superadmin',
                    'updated_on' => 'NOW()'
               	);
				$this->db->where('menu_id', $this->input->post('hidMenuId'));
                $this->db->update('menu_master', $new_data);
                if ($this->db->affected_rows())
                    return array('status' => $dbstatus, 'msg' => $dbmessage);
                else 
                	return array('status' => 'FAILURE', 'msg' => 'Error while updating');
	        break;
	        case 'delete_menu':
	        	$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
           		$data_delete = array('record_status'=>0);
				$this->db->where('menu_id', $this->input->post('menu_id'));
				$this->db->update('menu_master',$data_delete);
				if ($this->db->affected_rows())
	                return array('status' => $dbstatus, 'msg' => $dbmessage);
                else 
                	return array('status' => 'FAILURE', 'msg' => 'Error while deleting');
			break;
			case 'copy_menu':
				$dbstatus = TRUE;
            	$dbmessage = 'Data copied successfully';
				$cmbRole = ($this->input->get('cmbRole')!= null)?$this->input->get('cmbRole'):'';
				$cmbCopyRole = ($this->input->get('cmbCopyRole')!= null)?$this->input->get('cmbCopyRole'):'';
				$sql = "SELECT COUNT(menu_id) AS counting
						FROM 
						menu_master
						WHERE 
						role_code = '$cmbCopyRole'
						AND record_status = 1"; 
		        $query = $this->db->query($sql);
				$result = $query->row_array();
				$counting = $result['counting'];
				if($counting == 0)
				{
					$sql = "INSERT INTO menu_master 
					(role_code,menu_name,resource_code,parent_id,sl_no,has_child,
					is_last_child,icon_class,target,access_type,created_by,created_on)
					SELECT '$cmbCopyRole' AS role_code,menu_name,resource_code,parent_id,sl_no,has_child,
					is_last_child,icon_class,target,access_type,created_by,created_on FROM menu_master
					WHERE 
						record_status= 1 
						AND role_code = '$cmbRole'";
					$query = $this->db->query($sql);
					//var_dump($query->num_rows());
					if ($this->db->affected_rows())
	                    return array('status' => $dbstatus, 'dbMessage' => $dbmessage);
	                else 
	                	return array('status' => 'FAILURE', 'dbMessage' => "Data already exists for this role. Please delete all the data to copy from other role.");
				}
			break;
			/**
			* logic: To operate data for Role Master
			* case:get_roledata,edit_role,add_role,delete_role,get_resource combo box
			* author:Lina Mohapatra
			* date :11/09/2017
			*/
			
			case 'get_resource':
				$output = array("aaData" => array());
				$this->db->select("resource_code,resource_name");
				$this->db->from("resource_master");
				$this->db->where("record_status",1);
				$this->db->group_by("resource_code",1);
				$this->db->order_by("id");
				$result = $this->db->get();
				$output_data = $result->result_array();
				return $output_data;
			break;
			
			case 'get_roledata':            
			 	$order = ''; 
			    $Ocolumn = '';
			    $Odir = '';
				$order = $this->input->post('order');
				if ( $order )
					{
						foreach($order as $row) {
							$Ocolumn= $row['column'];
							$Odir=  $row['dir'];
						}
						$this->db->order_by($Ocolumn,$Odir);
					}else{
						$this->db->order_by(1,"ASC");
					}
			 	$search = $this->input->post('search');
			 	$header = array('role_code', 'role_name', 'index_page_url');
			 	
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
				
			    $iDisplayLength = $this->input->post('length');
				$iDisplayStart = $this->input->post('start');
				
                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->select('rom.`role_code`,rom.`role_name`, rem.resource_name  `index_page_url`, rem.resource_code  `index_page_code`');	
                $this->db->from('role_master rom');
                $this->db->join('resource_master rem', 'rom.index_page_url = rem.resource_code', 'LEFT');
                $this->db->where('rom.`record_status`',1);
                $this->db->where('rem.`record_status`',1);
                $this->db->group_by('role_code');
                
				$res = $this->db->get();
				$query = $res->result_array();
				
				$output = array("aaData" => array());
				$header = array('role_code', 'role_name', 'index_page_url');
				
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
                $this->db->select('rom.`role_code`,rom.`role_name`, rem.resource_name  `index_page_url`,rem.resource_code  `index_page_code`');	
                $this->db->from('role_master rom');
                $this->db->join('resource_master rem', 'rom.index_page_url = rem.resource_code', 'LEFT');
                $this->db->where('rom.`record_status`',1);
                $this->db->where('rem.`record_status`',1);
                $this->db->group_by('role_code');
				$res1 = $this->db->get();
				$output["draw"] = intval( $this->input->post('draw') );
				$output['iTotalRecords'] = $res1->num_rows(); 
				$output['iTotalDisplayRecords'] =  $res1->num_rows();
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
			
			case 'edit_role':  
			
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtrolecode = $_POST['txtrolecode'];
			 	$txtroleName = $_POST['txtroleName'];
			 	$txtLandingPage = $_POST['txtLandingPage'];
			 	$op_type = '';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				$output = array();
					$new_data = array(
					'role_name' 					=>$txtroleName,
					'index_page_url' 				=>$txtLandingPage,
					'created_by'					=>'SUPERADMIN', 
					'created_on'					=>$date,
					'updated_by'					=>'SUPERADMIN' ,
					'updated_on' 					=>$date,
					'record_status'					=>1
					);
					$this->db->where('role_code', $txtrolecode);
					$insert_user = $this->db->update('role_master', $new_data);
					
					if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
					}
					
					$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output; 
			break;
			
			case 'add_role':
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtrolecode = $_POST['txtrolecode'];
			 	$txtroleName = $_POST['txtroleName'];
			 	$txtLandingPage = $_POST['txtLandingPage'];
			 	$op_type = '';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
					$new_data = array(
					'role_code' 					=>$txtrolecode,
					'role_name' 					=>$txtroleName,
					'index_page_url' 				=>$txtLandingPage,
					'created_by'					=>'SUPERADMIN', 
					'created_on'					=>$date,
					'updated_by'					=>'SUPERADMIN' ,
					'updated_on' 					=>$date,
					'record_status'					=>1
					);
					$insert_user = $this->db->insert('role_master', $new_data);
					if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
					}
				    $output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output; 
			break;
			
			case 'delete_role':  
			
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
			 	$rolecode = $_POST['rolecode'];
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('role_code', $rolecode);
				$insert_user = $this->db->update('role_master', $new_data);
				
					
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting'.$this->db->_error_message();
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			
			/**
			* logic: To operate data for Resource Master
			* case:get_resourcedata,add_resource,add_role,delete_role,edit_resource,delete_resource
			* author:Lina Mohapatra
			* date :11/09/2017
			*/
			case 'get_resourcedata':            
			 	
			 	$order = ''; 
			    $Ocolumn = '';
			    $Odir = '';
				$order = $this->input->post('order');
				if ( $order )
					{
						foreach($order as $row) {
							$Ocolumn= $row['column'];
							$Odir=  $row['dir'];
						}
						$this->db->order_by($Ocolumn,$Odir);
					}else{
						$this->db->order_by(1,"ASC");
					}
			 	$search = $this->input->post('search');
			 	$header = array('resource_code', 'resource_name');
			 	
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
				
			    $iDisplayLength = $this->input->post('length');
				$iDisplayStart = $this->input->post('start');
				
                $this->db->limit($iDisplayLength, $iDisplayStart);
				$this->db->from('resource_master');
                $this->db->select('`resource_code`,`resource_link`,`resource_name`,`id`');	
                $this->db->where('record_status',1);
                $this->db->group_by('resource_code');
				$res = $this->db->get();
				$query = $res->result_array();
				$output = array("aaData" => array());
				
				$header = array('resource_code', 'resource_name');
				
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
              	$this->db->from('resource_master');
                $this->db->select('`resource_code`, `resource_name`');	
                $this->db->where('record_status',1);
                $this->db->group_by('resource_code');
                
				$res1 = $this->db->get();
				$output["draw"] = intval( $this->input->post('draw') );
				$output['iTotalRecords'] = $res1->num_rows(); 
				$output['iTotalDisplayRecords'] =  $res1->num_rows();
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
			 
			 
			case 'add_resource': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtresourcelink = $_POST['txtresourcelink'];
			 	$txtresourceName = $_POST['txtresourceName'];
			 	$op_type = $_POST['op_type_resource'];
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$qry = $this->db->query("SELECT MAX(id)+1 AS max_id FROM resource_master");
			    $Sresult = $qry->result_array();
			    $row2 = array_shift($Sresult);
			    $txtresourcecode = "R".$row2['max_id'].rand(1000,9999);
				
				$output = array();
				$new_data = array(
				'resource_code' 				=>$txtresourcecode,
				'resource_link' 				=>$txtresourcelink,
				'resource_name' 				=>$txtresourceName,
				'created_by'					=>'SUPERADMIN', 
				'created_on'					=>$date,
				'updated_by'					=>'SUPERADMIN' ,
				'updated_on' 					=>$date,
				'record_status'					=>1
				);
				$insert_user =  $this->db->insert('resource_master', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'edit_resource':  
			
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtresourcecode = $_POST['resource_code'];
			 	$txtresourcelink = $_POST['txtresourcelink'];
			 	$txtresourceName = $_POST['txtresourceName'];
			 	
			 	$op_type = $_POST['op_type_resource'];
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				$output = array();
				
				$new_data = array(
				'resource_name' 				=>$txtresourceName,
				'resource_link' 				=>$txtresourcelink,
				'created_by'					=>'SUPERADMIN', 
				'created_on'					=>$date,
				'updated_by'					=>'SUPERADMIN' ,
				'updated_on' 					=>$date,
				'record_status'					=>1
				);
				$this->db->where('resource_code', $txtresourcecode);
				$this->db->update('resource_master', $new_data);
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output; 
				
			break;
			
			case 'delete_resource':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$resourcecode = $_POST['resourcecode'];
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('resource_code', $resourcecode);
				$this->db->update('resource_master', $new_data);
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting'.$this->db->_error_message();
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			/**
			* logic: To operate data for Group Master
			* case:get_groupdata,get_table,get_tablevalue,get_tablemapvalue,delete_group,delete_groupmapdata,add_group
			* author:Rahul Patro
			* date :15/09/2017
			*/
			case 'get_groupdata':  
				$order = ''; 
			    $Ocolumn = '';
			    $Odir = '';
				$order = $this->input->post('order');
				if ( $order )
					{
						foreach($order as $row) {
							$Ocolumn= $row['column'];
							$Odir=  $row['dir'];
						}
						$this->db->order_by($Ocolumn,$Odir);
					}else{
						$this->db->order_by(1,"ASC");
					}
			 	$search = $this->input->post('search');
			 	$header = array('gm.group_name', 'tblop.table_name','gm.group_code','tblop.table_code');
			 	
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
				
			    $iDisplayLength = $this->input->post('length');
				$iDisplayStart = $this->input->post('start');
				
                $this->db->limit($iDisplayLength, $iDisplayStart);
				$this->db->from('group_master as gm');
                $this->db->select('`gm.group_code`, `gm.group_name`,`tblop.table_name`,`tblop.table_code`');	
                $this->db->join('table_operation as tblop','gm.table_code = tblop.table_code','inner');
                $this->db->where('gm.record_status',1);
				$res = $this->db->get();
				$query = $res->result_array();
				$output = array("aaData" => array());
				
				
				
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
              	$this->db->from('group_master as gm');
                $this->db->select('`gm.group_code`, `gm.group_name`,`tblop.table_name`,`tblop.table_code`');	
                $this->db->join('table_operation as tblop','gm.table_code = tblop.table_code','inner');
                $this->db->where('gm.record_status',1);
                
				$res1 = $this->db->get();
				$output["draw"] = intval( $this->input->post('draw') );
				$output['iTotalRecords'] = $res1->num_rows(); 
				$output['iTotalDisplayRecords'] =  $res1->num_rows();
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
			case 'get_table':
				$result = $this->db->get('table_operation');
				return $result->result_array();;
			break;
			case 'admin_dashboard' :
			
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d H:i:s', now());
        		
				$sel_program_group = $_POST['program_group'];
				
                $this->db->select('program_name, P.program_code,program_group');
                $this->db->from('counselling_program_master P');	
                $this->db->join('user_program_mapping U','P.program_code = U.program_code','inner');
                $this->db->where('STATUS','Active');
                $this->db->where('program_end_date >=',$date);
                $this->db->where('publish_status','YES');
                $this->db->where('P.record_status','1');
                $this->db->where('U.record_status','1');
                $this->db->where('P.institute_code',$institute_code);
                $this->db->where('U.institute_code',$institute_code);
                $this->db->where('U.user_code',$user);
                $this->db->where('program_group',$sel_program_group);
                $result = $this->db->get();
                //echo $this->db->last_query();
                $output_data = $result->result_array();
				foreach ($output_data as $row) 
        		{
        			$allProgrammes[] = $row;
        		}
        		
        		$this->db->select('applied_program, COUNT(*) AS cnt');
                $this->db->from('applicant_appl_overview A');	
                $this->db->join('counselling_applicant_form_fee_overview B','A.appl_no = B.appl_no','inner');
                $this->db->where('A.appl_status','Verified');
                $this->db->group_by('applied_program');
                $result = $this->db->get();
                $output_data = $result->result_array();
				foreach ($output_data as $row) 
        		{
        			$allApplied[$row['applied_program']] = $row['cnt'];
        		}
        		
        		$this->db->select('applied_program, COUNT(A.appl_no) AS cnt');
                $this->db->from('counselling_applicant_form_fee_overview A');	
                $this->db->join('applicant_appl_overview B','B.appl_no = A.appl_no','LEFT');
                $this->db->join('applicant_form_online_deposit C','B.appl_no = C.appl_no AND A.money_receipt_no = C.transaction_number','LEFT');
                $this->db->where('C.transaction_number !=','');
                $this->db->where('A.money_deposit_mode','ONLINE');
                $this->db->where('C.deposit_status','SUCCESS');
                $this->db->group_by('applied_program');
                $result = $this->db->get();
                $output_data = $result->result_array();
				foreach ($output_data as $row) 
        		{
        			$allOnlinePaid[$row['applied_program']] = $row['cnt'];
        		}
        		
        		$this->db->select('applied_program, COUNT(*) AS cnt');
                $this->db->from('counselling_applicant_form_fee_overview A');	
                $this->db->join('applicant_appl_overview B','B.appl_no = A.appl_no','INNER');
                $this->db->where('money_receipt_no !=','');
                $this->db->where('A.money_deposit_mode','ONLINE');
                $this->db->where('A.money_deposit_mode !=','ON THE COUNTER');
                $this->db->where('appl_status !=','Verified');
                $this->db->group_by('applied_program');
                $result = $this->db->get();
                $output_data = $result->result_array();
				foreach ($output_data as $row) 
        		{
        			$allPaymodePending[$row['applied_program']] = $row['cnt'];
        		}
        		
        		$this->db->select('applied_program, COUNT(*) AS cnt');
                $this->db->from('counselling_applicant_form_fee_overview A');	
                $this->db->join('applicant_appl_overview B','B.appl_no = A.appl_no','INNER');
                $this->db->where('money_receipt_no !=','');
                $this->db->where('A.money_deposit_mode !=','ONLINE');
                $this->db->where('A.money_deposit_mode !=','ON THE COUNTER');
                $this->db->where('appl_status','Verified');
                $this->db->group_by('applied_program');
                $result = $this->db->get();
                $output_data = $result->result_array();
				foreach ($output_data as $row) 
        		{
        			$allPaymodeVerified[$row['applied_program']] = $row['cnt'];
        		}
        		
        		$this->db->select('A.applied_program, COUNT(*) AS cnt');
                $this->db->from('applicant_master A');	
                $this->db->join('applicant_appl_overview B','A.reg_user_id = B.reg_user_id AND A.applied_program = B.applied_program','INNER');
                $this->db->where_in('category','("SC", "ST", "EBC")');
                $this->db->where('appl_status','Verified');
                $this->db->group_by('A.applied_program');
                $result = $this->db->get();
                $output_data = $result->result_array();
				foreach ($output_data as $row) 
        		{
        			$allSCST[$row['applied_program']] = $row['cnt'];
        		}
        		
        		$this->db->select('B.applied_program, COUNT(*) AS cnt');
                $this->db->from('counselling_applicant_form_fee_overview A');	
                $this->db->join('applicant_appl_overview B','B.appl_no = A.appl_no','INNER');
                $this->db->join('applicant_master C','B.reg_user_id = C.reg_user_id AND B.applied_program = C.applied_program','INNER');
                $this->db->where_in('C.category','("SC", "ST", "EBC")');
                $this->db->where('A.money_deposit_mode','ON THE COUNTER');
                $this->db->group_by('B.applied_program');
                $result = $this->db->get();
                $output_data = $result->result_array();
				foreach ($output_data as $row) 
        		{
        			$allOnCounterSCST[$row['applied_program']] = $row['cnt'];
        		}
        		
        		$this->db->select('A.applied_program, COUNT(*) AS cnt');
                $this->db->from('applicant_master A');	
                $this->db->join('applicant_appl_overview B','A.reg_user_id = B.reg_user_id AND A.applied_program = B.applied_program','INNER');
                $this->db->join('applicant_reg_master C','A.reg_user_id = C.reg_user_id AND A.applied_program = C.applied_program','INNER');
                $this->db->join('counselling_applicant_form_fee_overview D','B.appl_no = D.appl_no','INNER');
                $this->db->where('C.reg_mode','ONLINE');
                $this->db->where('D.amount','0.00');
                $this->db->where('appl_status','Verified');
                $this->db->group_by('A.applied_program');
                $result = $this->db->get();
                $output_data = $result->result_array();
				foreach ($output_data as $row) 
        		{
        			$allOtherSCST[$row['applied_program']] = $row['cnt'];
        		}
        		
        		$this->db->select('B.applied_program, COUNT(*) AS cnt');
                $this->db->from('counselling_applicant_form_fee_overview A');	
                $this->db->join('applicant_appl_overview B','B.appl_no = A.appl_no','INNER');
                $this->db->join('applicant_master C','B.reg_user_id = C.reg_user_id AND B.applied_program = C.applied_program','INNER');
                $this->db->where_not_in('C.category','("SC", "ST", "EBC")');
                $this->db->where('A.money_deposit_mode','ON THE COUNTER');
                $this->db->group_by('B.applied_program');
                $result = $this->db->get();
                $output_data = $result->result_array();
				foreach ($output_data as $row) 
        		{
        			$allOnCounter[$row['applied_program']] = $row['cnt'];
        		}
    			
    			$html = ''; 
    			$count = 0;
				if(isset($allProgrammes))
				{
					$count = 0;
					foreach($allProgrammes as $row)
					{
						if($row['program_group'] == $sel_program_group)
						{
							$allPaymodePending = isset($allPaymodePending[$row['program_code']]) ? $allPaymodePending[$row['program_code']] : 0;
							$allPaymodeVerified = isset($allPaymodeVerified[$row['program_code']]) ? $allPaymodeVerified[$row['program_code']] : 0;
							$allOtherSCST = isset($allOtherSCST[$row['program_code']]) ? $allOtherSCST[$row['program_code']] : 0;
							$allOnCounterSCST = isset($allOnCounterSCST[$row['program_code']]) ? $allOnCounterSCST[$row['program_code']] : 0;
							$allOnCounter = isset($allOnCounter[$row['program_code']]) ? $allOnCounter[$row['program_code']] : 0;
							$allApplied = isset($allApplied[$row['program_code']]) ? $allApplied[$row['program_code']] : 0;
							$count++;
							
							$html .= '<h3>'.$row['program_name'].'( All Applicants -'.$allApplied.')</h3>
										<div class="row">
											<div class="col-lg-3 col-xs-6">
							                    <div class="panel panel-primary">
							                        <div class="panel-heading">
							                            <div class="row">
							                                <div class="col-xs-2">
							                                </div>
								                            <div class="col-xs-10 text-right">
					                                    		<h3>'.$allOnlinePaid[$row['program_code']].'</h3>
						                        				<h4>Total Online Paid</h4>
			                                				</div>
			                            				</div>
			                        				</div>
			                        				<a href="javascript:void(0);">
							                            <div class="panel-footer">
							                                <span class="pull-left">View Details</span>
							                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							                                <div class="clearfix"></div>
							                            </div>
						                       		</a>
						                    	</div>
						                    </div>
						                    
						                    <div class="col-lg-3 col-xs-6">
							                    <div class="panel panel-green">
							                        <div class="panel-heading">
							                            <div class="row">
							                                <div class="col-xs-12 text-right">
																<h5>Pending:'.$allPaymodePending.'</h5>
																<h5>Verified:'.$allPaymodeVerified.'</h5>
																<h4>Other Payment Modes</h4>
							                                </div>
							                            </div>
							                        </div>
							                        <a href="javascript:void(0);">
							                            <div class="panel-footer">
							                                <span class="pull-left">View Details</span>
							                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							                                <div class="clearfix"></div>
							                            </div>
							                        </a>
							                    </div>
							                </div>
							                
							                <div class="col-lg-3 col-xs-6">
							                    <div class="panel panel-yellow">
							                        <div class="panel-heading">
							                            <div class="row">
							                                <div class="col-xs-2">
							                                </div>
							                                <div class="col-xs-10 text-right">
								                               <h5>Online:'.$allOtherSCST.'</h5>
															<h5>Offline:'.$allOnCounterSCST.'</h5>
									                            <h4>
									                                Zero Paid Applicant
								                            	</h4>
							                                </div>
							                            </div>
							                        </div>
							                         <a href="javascript:void(0);">
							                            <div class="panel-footer">
							                                <span class="pull-left">View Details</span>
							                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							                                <div class="clearfix"></div>
							                            </div>
							                        </a>
							                    </div>
							                </div>
							                
							                <div class="col-lg-3 col-xs-6">
							                    <div class="panel panel-red">
							                        <div class="panel-heading">
							                            <div class="row">
							                                <div class="col-xs-2">
							                                </div>
							                                <div class="col-xs-10 text-right">
								                               <h3>'.$allOnCounter.'</h3>
									                            <h4>
									                                On the Counter
									                            </h4>
							                                </div>
							                            </div>
							                        </div>
							                        <a href="javascript:void(0);">
							                            <div class="panel-footer">
							                                <span class="pull-left">View Details</span>
							                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							                                <div class="clearfix"></div>
							                            </div>
							                        </a>
							                    </div>
							                </div>
							            </div>';
						}
					}
				}
				return array('html' => $html,'count' => $count);
			break;
			case 'get_applicant_details_payment' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$program =  isset($_POST['program'])? $_POST['program']:'';
				
				
				$this->db->select("SUBSTRING(C.appl_no,-10) as appl_no,A.reg_user_id,B.full_name,D.order_number,D.deposit_status,
				CASE WHEN D.deposit_status = 'SUCCESS' THEN D.transaction_number ELSE '' END AS money_receipt_no,CASE WHEN D.deposit_status = 'SUCCESS' THEN DATE_FORMAT(E.depositdate,'%d-%m-%Y') ELSE '' END as depositdate,E.amount");
				$this->db->from('applicant_reg_master A');
				$this->db->join('applicant_master B','A.reg_user_id = B.reg_user_id AND A.applied_program = B.applied_program','inner');
				$this->db->join('applicant_appl_overview C ','A.reg_user_id = C.reg_user_id AND A.applied_program = C.applied_program','inner');
				$this->db->join('applicant_form_online_deposit D ','C.appl_no = D.appl_no','INNER');
				$this->db->join('counselling_applicant_form_fee_overview E ','C.appl_no = E.appl_no','inner');
				$this->db->where('A.applied_program',$program);
				$this->db->where('D.money_deposit_mode','ONLINE');
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			case 'db_get_json':            
			 	
			 	$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d H:i:s', now());
        		
				$program_group = $_POST['program_group'];
				
				$array = array();
				$a_total = 0;
				$aa_total = 0;
				$ba_total = 0;
				$ca_total = 0;
				$b_total = 0;
				$c_total = 0;
				$days_ago = date('Y-m-d', strtotime('-3 days', strtotime($date)));
			 	
			 	/*$this->db->query("SELECT CASE WHEN DATE(last_updated) = 'Document Uploaded' THEN 1 END,DATE(last_updated) AS apply_date, 
									COUNT(CASE WHEN appl_status = 'Document Uploaded' THEN 1 END) 'document',
									COUNT(CASE WHEN appl_status = 'Verified' THEN 1 END) 'payment'
									FROM applicant_appl_overview
										WHERE  applied_program IN (SELECT program_code FROM counselling_program_master WHERE program_end_date > '$date' AND publish_status = 'YES' AND institute_code = '$institute_code' AND program_group = '$program_group')
										AND DATE(last_updated) > '$days_ago'
										GROUP BY DATE(last_updated)
										ORDER BY DATE(last_updated) ASC UNION
									SELECT
									COUNT(CASE WHEN appl_status = 'Student Details Submitted' THEN 1 END) 'profile',
									FROM applicant_appl_overview
										WHERE  applied_program IN (SELECT program_code FROM counselling_program_master WHERE program_end_date > '$date' AND publish_status = 'YES' AND institute_code = '$institute_code' AND program_group = '$program_group')
										AND DATE(updated_on) > '$days_ago'
										GROUP BY DATE(updated_on)
										ORDER BY DATE(updated_on) ASC");
			 	$result = $this->db->get();
                $output_data = $result->result_array();
				foreach ($output_data as $row) 
        		{
        			$array [] = array('x' => date("d-M",strtotime($row['apply_date'])), 'a' => $row['profile'], 'b' => $row['document'], 'c' => $row['payment']);
					$a_total += $row['profile'];
					$b_total += $row['document'];
					$c_total += $row['payment'];
        		}
        		*/
        		$this->db->select("DATE(last_updated) AS apply_date, 
						COUNT(CASE WHEN appl_status = 'Document Uploaded' THEN 1 END) 'document', 
						COUNT(CASE WHEN appl_status = 'Student Details Submitted' THEN 1 END) 'profile', 
						COUNT(CASE WHEN appl_status = 'Verified' THEN 1 END) 'payment'");
                $this->db->from('applicant_appl_overview');	
                $this->db->where("applied_program IN (SELECT program_code FROM counselling_program_master WHERE program_end_date > NOW() AND publish_status = 'YES' AND institute_code = '$institute_code' AND program_group = '$program_group')");
                $this->db->group_by('DATE(last_updated)');
                $this->db->order_by('DATE(last_updated)', "ASC");
                
                $result = $this->db->get();
                //echo $this->db->last_query();
                $output_data = $result->result_array();
				foreach ($output_data as $row) 
        		{
        			$aa_total += $row['profile'];
					$ba_total += $row['document'];
					$ca_total += $row['payment'];
        		}
        		$array [] = array('x' => "TOTAL", 'a' => $aa_total, 'b' => $ba_total, 'c' => $ca_total);
			 	
			 	
				
				return $array; 
			break;
			case 'delete_groupmapdata':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
			 	$id = $data['id'];
				$output = array();
				$this->db->where('id', $id);
				$this->db->delete('group_mapping'); 
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting'.$this->db->_error_message();
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			case 'add_group':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
			 	$txtGroupName = $data['txtGroupName'];
			 	$cmbtable = $data['cmbtable'];
			 	$cmbtablevalue = array();
			 	$cmbtablevalue = isset($data['cmbtablevalue'])?$data['cmbtablevalue']:[];
			 	if (in_array('multiselect-all', $cmbtablevalue)) 
				{ 
					$index = array_search('multiselect-all',$cmbtablevalue);
					if($index !== FALSE){
						unset($cmbtablevalue[$index]);
						$cmbtablevalue = array_values($cmbtablevalue);
					}
					
				}
				$qry = $this->db->query("SELECT MAX(id)+1 AS max_id FROM group_master");
				$Sresult = $qry->result_array();
				$row2 = array_shift($Sresult);
				$newid = "G".$row2['max_id'].rand(1000,9999);
				$data = array( "group_code" =>$newid,
								"group_name" => $this->input->post('txtGroupName'),
								"table_code" => $this->input->post('cmbtable'),
								"created_by" => 'superadmin',
								"created_on" => date('Y-m-d H:i:s', now())
							);
				$insert_group = $this->db->insert('group_master',$data);
				if( ! $insert_group){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}else{
					$newarray=array();
					$insert_group_map =TRUE;
					for($i = 0;$i < sizeof($cmbtablevalue);$i++)
					{
						$newarray[] = array(
								      'group_code' => $newid ,
								      'map_value_code' => $cmbtablevalue[$i] ,
								      'created_by' => 'superadmin',
									  'created_on' => date('Y-m-d H:i:s', now())
								   );
					}
					if(sizeof($cmbtablevalue) != 0)
						$insert_group_map = $this->db->insert_batch('group_mapping',$newarray);
					if( ! $insert_group_map){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
					}
				}
				$output = array();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			case 'edit_group':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
			 	$txtGroupName = $data['txtGroupName'];
			 	$cmbtable = $data['cmbtable'];
			 	$hidgroupcode = $data['hidgroupcode'];
			 	$cmbtablevalue = array();
			 	$cmbtablevalue = isset($data['cmbtablevalue'])?$data['cmbtablevalue']:[];
			 	if (in_array('multiselect-all', $cmbtablevalue)) 
				{ 
					$index = array_search('multiselect-all',$cmbtablevalue);
					if($index !== FALSE){
						unset($cmbtablevalue[$index]);
						$cmbtablevalue = array_values($cmbtablevalue);
					}
					
				}
				
				$data = array( "group_name" => $this->input->post('txtGroupName'),
								"updated_by" => 'superadmin'
							);
							$this->db->where("group_code",$hidgroupcode);
				$insert_group = $this->db->update('group_master',$data);
				if( ! $insert_group){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}else{
					$newarray=array();
					$insert_group_map =TRUE;
					for($i = 0;$i < sizeof($cmbtablevalue);$i++)
					{
						$newarray[] = array(
								      'group_code' => $hidgroupcode ,
								      'map_value_code' => $cmbtablevalue[$i] ,
								      'created_by' => 'superadmin',
									  'created_on' => date('Y-m-d H:i:s', now())
								   );
					}
					if(sizeof($cmbtablevalue) != 0)
						$insert_group_map = $this->db->insert_batch('group_mapping',$newarray);
					if( ! $insert_group_map){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
					}
				}
				$output = array();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			/**
			* logic: Operations for  Manage Group 
			* case:Group Code Combo Box ,Role-Group datatable, add role_group data
			* author:Lina Mohapatra
			* date :13/09/2017
			*/
			case 'get_group':
				$output = array("aaData" => array());
				$this->db->select("group_code,group_name");
				$this->db->from("group_master");
				$this->db->where("record_status",1);
				$this->db->group_by("group_code",1);
				$this->db->order_by("id");
				$result = $this->db->get();
				$output_data = $result->result_array();
				return $output_data;
			break;
			
			case 'get_role_group_data':            
			 	
			 	$order = ''; 
			    $Ocolumn = '';
			    $Odir = '';
				$order = $this->input->post('order');
				if ( $order )
					{
						foreach($order as $row) {
							$Ocolumn= $row['column'];
							$Odir=  $row['dir'];
						}
						$this->db->order_by($Ocolumn,$Odir);
					}else{
						$this->db->order_by(1,"ASC");
					}
			 	$search = $this->input->post('search');
			 	$header = array('rm.role_name', 'gm.group_name','rgm.name');
			 	
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
				
			    $iDisplayLength = $this->input->post('length');
				$iDisplayStart = $this->input->post('start');
				
                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->select('rm.role_name,gm.group_name,rgm.name,rm.role_code,gm.group_code,rgm.role_group_code');
                $this->db->from('role_group_mapping  rgm');	
                $this->db->join('role_master rm', 'rgm.role_code = rm.role_code', 'LEFT');
                $this->db->join('group_master gm', 'rgm.group_code = gm.group_code', 'LEFT');
                $this->db->where('rgm.record_status',1);
                $this->db->where('rm.record_status',1);
                $this->db->where('gm.record_status',1);
                $this->db->group_by('rm.role_code');
                $this->db->group_by('gm.group_code');
				$res = $this->db->get();
				$query = $res->result_array();
				$output = array("aaData" => array());
				
				$header = array('rm.role_name', 'gm.group_name','rgm.name');
				
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
				
              	$this->db->select('`rm.role_name`, `gm.group_name`,`rgm.name`,`rm.role_code`,`gm.group_code`');
                $this->db->from('role_group_mapping  rgm');	
                $this->db->join('role_master rm', 'rgm.role_code = rm.role_code', 'LEFT');
                $this->db->join('group_master gm', 'rgm.group_code = gm.group_code', 'LEFT');
                $this->db->where('rgm.record_status',1);
                $this->db->where('rm.record_status',1);
                $this->db->where('gm.record_status',1);
                $this->db->group_by('rm.role_code');
                $this->db->group_by('gm.group_code');
                
				$res1 = $this->db->get();
				$output["draw"] = intval( $this->input->post('draw') );
				$output['iTotalRecords'] = $res1->num_rows(); 
				$output['iTotalDisplayRecords'] =  $res1->num_rows();
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
			
			case 'add_role_group': 
			
				date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$role_code = $_POST['cmbrolecode'];
			 	$group_code = $_POST['cmbgroupcode'];
			 	$role_group_name = $_POST['txtRoleGroup'];
			 	
			 	$this->db->select('`role_code`, `group_code`');
                $this->db->from('role_group_mapping');	
                $this->db->where('role_code',$role_code);
                $this->db->where('group_code',$group_code);
                $this->db->where('record_status',1);
               	$res = $this->db->get();
			 	$query = $res->result_array();
			 	
			 	if($res->num_rows() > 0) {
					$dbstatus = FALSE;
					$dbmessage = 'Error Duplicate Record Entry';
				}
			 	else{
			 		$this->db->select_max('id');
	                $this->db->from('role_group_mapping');	
				 	$res = $this->db->get();
				 	$query = $res->result_array();
				 	
				 	foreach($query as $aRow)
					{
						$max_id = $aRow['id'];
					}
				 	if($max_id == ''){
						$max_id = 0;
					}
					else{
						$max_id = $max_id ;
					}
					
					$role_group_code = $role_code .'_'.$group_code.$max_id;
					
					$output = array();
					$new_data = array(
					'role_group_code' 				=>$role_group_code,
					'name' 							=>$role_group_name,
					'role_code' 					=>$role_code,
					'group_code' 					=>$group_code,
					'created_by'					=>'SUPERADMIN', 
					'created_on'					=>$date,
					'updated_by'					=>'SUPERADMIN' ,
					'updated_on' 					=>$date,
					'record_status'					=>1
					);
					$insert_user =  $this->db->insert('role_group_mapping', $new_data);
					if( ! $insert_user){
							$dbstatus = FALSE;
							$dbmessage = 'Error While Saving';
					}	
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output; 
			break;
			
			case 'edit_role_group':  
			
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$hidtxtRole_group_code = $_POST['hidtxtRole_group_code'];
			 	$role_code = $_POST['cmbrolecode'];
			 	$group_code = $_POST['cmbgroupcode'];
			 	$role_group_name = $_POST['txtRoleGroup'];
			 	
			 	
			 	$this->db->select('`role_code`, `group_code`');
                $this->db->from('role_group_mapping');	
                $this->db->where('role_code',$role_code);
                $this->db->where('group_code',$group_code);
                $this->db->where('record_status',1);
               	$res = $this->db->get();
			 	$query = $res->result_array();
			 	
			 	if($res->num_rows() > 0) {
					$dbstatus = FALSE;
					$dbmessage = 'Error Duplicate Record ';
				}
			 	else{
			 		date_default_timezone_set('Asia/Kolkata');
					$date = date('Y-m-d H:i:s', time());
					$output = array();
					
					$new_data = array(
					'name' 							=>$role_group_name,
					'role_code' 					=>$role_code,
					'group_code' 					=>$group_code,
					'created_by'					=>'SUPERADMIN', 
					'created_on'					=>$date,
					'updated_by'					=>'SUPERADMIN' ,
					'updated_on' 					=>$date,
					'record_status'					=>1
					);
					$this->db->where('role_group_code', $hidtxtRole_group_code);
					$this->db->update('role_group_mapping', $new_data);
					
					if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
					}
				}
				
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output; 
				
			break;
			
			case 'delete_role_group':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$role_group_code = $_POST['rolegroupcode'];
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('role_group_code', $role_group_code);
				$this->db->update('role_group_mapping', $new_data);
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			
			/**
			* logic: Operations for  Manage User-to-RoleGroup 
			* case:Group Code Combo Box ,Role-Group datatable, add role_group data
			* author:Lina Mohapatra
			* date :15/09/2017
			*/
			
			case 'get_rolegroup_code':
				$output = array("aaData" => array());
				$this->db->select("role_group_code,name");
				$this->db->from("role_group_mapping");
				$this->db->where("record_status",1);
				$this->db->group_by("role_group_code",1);
				$this->db->order_by("id");
				$result = $this->db->get();
				$output_data = $result->result_array();
				return $output_data;
			break;
			
			case 'get_user_code':
				$output = array("aaData" => array());
				$this->db->select("user_code,user_name");
				$this->db->from("user_master");
				$this->db->where("record_status",1);
				$this->db->group_by("user_code",1);
				$this->db->order_by("id");
				$result = $this->db->get();
				$output_data = $result->result_array();
				return $output_data;
			break;
			
			case 'get_user_role_group_data':            
			 	
			 	$order = ''; 
			    $Ocolumn = '';
			    $Odir = '';
				$order = $this->input->post('order');
				if ( $order )
					{
						foreach($order as $row) {
							$Ocolumn= $row['column'];
							$Odir=  $row['dir'];
						}
						$this->db->order_by($Ocolumn,$Odir);
					}else{
						$this->db->order_by(1,"ASC");
					}
			 	$search = $this->input->post('search');
			 	$header = array('urgp.`user_rolegroup_code', 'um.user_name','rgm.`name`');
			 	
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
				if($this->input->post('cmbrolegroup')){
					$this->db->where('urgp.role_group_code',$this->input->post('cmbrolegroup'));
				}
			    $iDisplayLength = $this->input->post('length');
				$iDisplayStart = $this->input->post('start');
				
                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->select('um.`user_code`,rgm.`role_group_code`,um.user_name,rgm.`name`,urgp.`user_rolegroup_code`');
                $this->db->from('user_role_group_map urgp ');	
                $this->db->join('user_master um', 'urgp.user_code = um.user_code', 'LEFT');
                $this->db->join('role_group_mapping rgm', 'urgp.role_group_code = rgm.role_group_code', 'LEFT');
                $this->db->where('rgm.record_status',1);
                $this->db->where('um.record_status',1);
                $this->db->where('urgp.record_status',1);
                $this->db->group_by('urgp.`user_rolegroup_code`');
                $this->db->group_by('um.user_code');
				$res = $this->db->get();
				$query = $res->result_array();
				$output = array("aaData" => array());
				
				$header = array('urgp.`user_rolegroup_code', 'um.user_name','rgm.`name`');
				
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
				if($this->input->post('cmbrolegroup')){
					$this->db->where('urgp.role_group_code',$this->input->post('cmbrolegroup'));
				}
                $this->db->select('um.`user_code`,rgm.`role_group_code`,urgp.`user_rolegroup_code`,um.user_name,rgm.`name`');
                $this->db->from('user_role_group_map urgp ');	
                $this->db->join('user_master um', 'urgp.user_code = um.user_code', 'LEFT');
                $this->db->join('role_group_mapping rgm', 'urgp.role_group_code = rgm.role_group_code', 'LEFT');
                $this->db->where('rgm.record_status',1);
                $this->db->where('um.record_status',1);
                $this->db->where('urgp.record_status',1);
                $this->db->group_by('urgp.`user_rolegroup_code`');
                $this->db->group_by('um.user_code');
                
				$res1 = $this->db->get();
				$output["draw"] = intval( $this->input->post('draw') );
				$output['iTotalRecords'] = $res1->num_rows(); 
				$output['iTotalDisplayRecords'] =  $res1->num_rows();
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
			
			case 'add_user_role_group': 
			
				date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtrole_group = $_POST['txtrole_group'];
			 	$cmbuser_name = $_POST['cmbuser_name'];
			 	if (in_array('multiselect-all', $cmbuser_name)) 
				{ 
					$index = array_search('multiselect-all',$cmbuser_name);
					if($index !== FALSE){
						unset($cmbuser_name[$index]);
						$cmbuser_name = array_values($cmbuser_name);
					}
					
				}
			 	$newarray=array();
			    $insert_user_role_group_map =TRUE;
			   // print_r($cmbuser_name);die();
			    for($i = 0;$i < sizeof($cmbuser_name);$i++)
			    {
			     	$user_rolegroup_code = $txtrole_group.'#'.$cmbuser_name[$i];
			     	
			      	$newarray[] = array(
			              'user_rolegroup_code' 		=> $user_rolegroup_code ,
			              'user_code' 					=> $cmbuser_name[$i] ,
			              'role_group_code' 			=> $txtrole_group,
			           	  'created_by'					=>'SUPERADMIN', 
						  'created_on'					=>$date,
						  'updated_by'					=>'SUPERADMIN' ,
						  'updated_on' 					=>$date,
						  'record_status'				=>1
			        );
			        
			    }
			     if(sizeof($cmbuser_name) != 0)
				      $insert_user_role_group_map = $this->db->insert_batch('user_role_group_map',$newarray);
				 if( ! $insert_user_role_group_map){
				      $dbstatus = FALSE;
				      $dbmessage = 'Error While Saving';
			     }
			     
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output; 
			break;
			
			case 'delete_user_rolegroup':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$user_role_group_code = $data['userrolegroupcode'];
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				$output = array();
				$this->db->where('user_rolegroup_code', $user_role_group_code);
				$this->db->delete('user_role_group_map'); 
								
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			case 'delete_rolegroup':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$rolegroupcode = $data['rolegroupcode'];
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				$output = array(); 
				$new_data = array(
					'record_status'	=>0
				);
				$this->db->where('role_group_code', $rolegroupcode);
				$this->db->update('role_group_mapping', $new_data);			
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			case 'get_program_email' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("SUBSTRING_INDEX(program_code,'_',1) AS progcode,program_name,DATE_FORMAT(program_start_date,'%d-%m-%Y') AS program_start_date,
					DATE_FORMAT(program_end_date,'%d-%m-%Y') AS program_end_date,counselling_program_master.id,program_code");
				$this->db->from('counselling_program_master');
				$this->db->where('institute_code',$institute_code);
				$this->db->where('program_end_date>=',$date);
				$this->db->where('record_status', 1);
				$this->db->order_by("id");
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'get_program_sms' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$program = $_POST['program'];				
				$this->db->select("A.sms_type as id, A.sms_type as type, CASE WHEN B.record_status IS NULL THEN 0 WHEN B.record_status = 0 THEN 0 ELSE 1 END AS record_status", FALSE);
				$this->db->from('sms_setup A');
				$this->db->join('program_sms_setup B', 'A.sms_type = B.sms_type', 'B.program_code = '.$program, 'LEFT');
				//$this->db->group_by('A.sms_type');				
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'get_all_sms' :
				$this->db->select("sms_type as id,sms_type as name,sms_type");
				$this->db->from('sms_setup');
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'get_communication_sms' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$program = $_POST['program_code'];				
				$this->db->select("A.sms_type, A.sms_type as sms, CASE WHEN B.record_status IS NULL THEN 0 WHEN B.record_status = 0 THEN 0 ELSE 1 END AS record_status", FALSE);
				$this->db->from('sms_setup A');
				$this->db->join('program_sms_setup B', 'A.sms_type = B.sms_type', 'B.program_code = '.$program, 'LEFT');
				$this->db->where('B.program_code',$program);
				$this->db->group_by('A.sms_type');				
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'update_multiple_sms' :
				$dbStatus = "SUCCESS";
				$dbMessage = "Assigned Successfully";
				$dbError = "";
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d H:i:s', now());
				$arr_program_code = array();
				$category_codes = array();
				$arr_show_status = array();
				$program_codes = $_POST['program_codes'];
				$category_codes = $_POST['category_codes']?$_POST['category_codes']:'';
				//print_r($category_codes);
				$show_status = $_POST['show_status']?$_POST['show_status']:'';
				$arr_program_code = call_user_func_array('array_merge', $program_codes);	
				
				
				
				for($i=0;$i<sizeof($arr_program_code);$i++)
				{
					$this->db->select('COUNT(program_code) AS program_code');
					$this->db->from('program_sms_setup');
					$this->db->where('program_code',$arr_program_code[$i]);
					$this->db->where('record_status','1');
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
		            	$count = $aRow['program_code'];
		            }
					for($j=0;$j<sizeof($category_codes);$j++)
					{
						if($count >= 1)
		            	{
							$data = array(
								'record_status' 				=>$show_status[$j],
								'updated_by'					=>$user,
								'updated_on'					=>$date
							);
							$this->db->where('program_code',$arr_program_code[$i]);
							$this->db->where('sms_type',$category_codes[$j]);
							$update_user = $this->db->update('program_sms_setup',$data);
							if(! $update_user){
								$dbStatus = "ERROR";
								$dbMessage = "Error Assigning";
							}
						}
						else
						{
							$new_data = array(
								'program_code' 					=>$arr_program_code[$i],
								'sms_type' 						=>$category_codes[$j],
								'record_status' 				=>$show_status[$j],
								'institute_code' 				=>$institute_code,
								'created_by'					=>$user,
								'created_on'					=>$date
							);
							$insert_user = $this->db->insert('program_sms_setup',$new_data);
							if($insert_user){
								$dbStatus = "SUCCESS";
								$dbMessage = "Data successfully saved";
							}
							else
							{	
								$dbStatus = "ERROR";
								$dbMessage ="Error in saving";
								
							}
						}
						
					}
				}
		
				if($dbStatus == "SUCCESS")
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				else
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				return $output;
			break;
			case 'update_single_sms' :
				$dbStatus = "SUCCESS";
				$dbMessage = "Updated Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d H:i:s', now());
				$arr_menu_code = array();
				$program_code = $_POST['program_code'];
				$show_status = $_POST['show_status']?$_POST['show_status']:'';
				$this->db->select("sms_type");
				$this->db->from('sms_setup');
				$this->db->order_by('sms_type');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$i = 0;
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
	            {
	            	$sms_type = $row['sms_type'];
	            	$this->db->select("count(program_code) AS program_code");
					$this->db->from('program_sms_setup');
					$this->db->where('program_code',$program_code);
					$this->db->where('sms_type',$sms_type);
					
					$result = $this->db->get();
					$output_data = $result->result_array();
					
					foreach ($output_data as $aRow1) 
            		{
            			$result = $aRow1['program_code'];
						if($result >= 1)
						{
							$update_data = array(
								'record_status' 				=>$show_status[$i],
								'updated_by'					=>$user,
								'updated_on'					=>$date
							);
							$this->db->where('program_code',$program_code );
							$this->db->where('sms_type',$sms_type );
							$sql = $this->db->update('program_sms_setup', $update_data);
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
								'program_code' 					=>$program_code,
								'sms_type' 						=>$sms_type,
								'record_status' 				=>$show_status[$i],
								'institute_code' 				=>$institute_code,
								'created_by'					=>$user,
								'created_on'					=>$date
							);
							
							
							$sql = $this->db->insert('program_sms_setup', $new_data);
							//echo $this->db->last_query();
							if(!$sql){
								$dbStatus = "ERROR";
								$dbMessage = "Error Inserting";
								//$dbError = ;	
							}
						}
	                }
	                $i++;
	            }
	            if($dbStatus == "SUCCESS")
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				else
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				return $output;
			break;
			
			case 'get_communication_menu' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$cmbProgramFilter = $_POST['program'];				
				$this->db->select("A.email_type,CASE WHEN B.record_status IS NULL THEN 0 WHEN B.record_status = 0 THEN 0 ELSE 1 END AS record_status", FALSE);
				$this->db->from('email_setup A');
				$this->db->join('program_email_setup B', 'A.email_type = B.email_type', 'LEFT');
				$this->db->where('B.program_code',$cmbProgramFilter);			
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'get_communication_assign' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$this->db->select("DISTINCT email_type,email_type as email", FALSE);
				$this->db->from('program_email_setup');
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			
			case 'update_multiple_email' :
				$dbStatus = "SUCCESS";
				$dbMessage = "Assigned Successfully";
				$dbError = "";
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d H:i:s', now());
				$arr_program_code = array();
				$email_codes = array();
				$arr_show_status_email = array();
				$program_codes = $_POST['program_codes'];
				$email_codes = $_POST['email_codes']?$_POST['email_codes']:'';
				//print_r($category_codes);
				$show_status = $_POST['show_status_email']?$_POST['show_status_email']:'';
				$arr_program_code = call_user_func_array('array_merge', $program_codes);	
				
				
				
				for($i=0;$i<sizeof($arr_program_code);$i++)
				{
					$this->db->select('COUNT(program_code) AS program_code');
					$this->db->from('program_email_setup');
					$this->db->where('program_code',$arr_program_code[$i]);
					$this->db->where('record_status','1');
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
		            	$count = $aRow['program_code'];
		            }
					for($j=0;$j<sizeof($email_codes);$j++)
					{
						if($count >= 1)
		            	{
							$data = array(
								'record_status' 				=>$show_status[$j],
								'updated_by'					=>$user,
								'updated_on'					=>$date
							);
							$this->db->where('program_code',$arr_program_code[$i]);
							$this->db->where('email_type',$email_codes[$j]);
							$update_user = $this->db->update('program_email_setup',$data);
							if(! $update_user){
								$dbStatus = "ERROR";
								$dbMessage = "Error Assigning";
							}
						}
						else
						{
							$new_data = array(
								'program_code' 					=>$arr_program_code[$i],
								'email_type' 					=>$email_codes[$j],
								'record_status' 				=>$show_status[$j],
								'institute_code' 				=>$institute_code,
								'created_by'					=>$user,
								'created_on'					=>$date
							);
							$insert_user = $this->db->insert('program_email_setup',$new_data);
							if($insert_user){
								$dbStatus = "SUCCESS";
								$dbMessage = "Data successfully saved";
							}
							else
							{	
								$dbStatus = "ERROR";
								$dbMessage ="Error in saving";
								
							}
						}
						
					}
				}
		
				if($dbStatus == "SUCCESS")
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				else
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				return $output;
			break;
			
			case 'update_communication_email' :
				$dbStatus = "SUCCESS";
				$dbMessage = "Updated Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d H:i:s', now());
				$arr_menu_code = array();
				$arr_menu_code = array();
				$show_status = array();
				$program_code = $_POST['program'];
				$arr_menu_code = $_POST['arr_menu_code']?$_POST['arr_menu_code']:'';
				$show_status = $_POST['arr_field_status']?$_POST['arr_field_status']:'';
				$this->db->select("email_type");
				$this->db->from('email_setup');	
				$this->db->order_by('email_type');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$i = 0;
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
	            {
	            	$this->db->select("count(program_code) AS program_code");
					$this->db->from('program_email_setup');
					$this->db->where('program_code',$program_code);
					$this->db->where('email_type',$arr_menu_code[$i]);
					
					$result = $this->db->get();
					$output_data = $result->result_array();
					
					foreach ($output_data as $aRow1) 
            		{
            			$result = $aRow1['program_code'];
						if($result >= 1)
						{
							$update_data = array(
								'record_status' 				=>$show_status[$i],
								'updated_by'					=>$user,
								'updated_on'					=>$date
							);
							$this->db->where('program_code',$program_code );
							$this->db->where('email_type',$arr_menu_code[$i] );
							$sql = $this->db->update('program_email_setup', $update_data);
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
								'program_code' 					=>$program_code,
								'email_type' 					=>$arr_menu_code[$i] ,
								'record_status' 				=>$show_status[$i],
								'institute_code' 				=>$institute_code,
								'created_by'					=>$user,
								'created_on'					=>$date
							);
							
							
							$sql = $this->db->insert('program_email_setup', $new_data);
							//echo $this->db->last_query();
							if(!$sql){
								$dbStatus = "ERROR";
								$dbMessage = "Error Inserting";
								//$dbError = ;	
							}
						}
	                }
	                $i++;
	            }
	            if($dbStatus == "SUCCESS")
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				else
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				return $output;
			break;
			
			
			case 'get_program_tabledata':
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("program_group,SUBSTRING_INDEX(counselling_program_master.program_code,'_',1) AS progcode,program_name,
					counselling_program_master.YEAR,sl_no,form_template_master.file_name,registration_template_master.file_name as reg_file_name,
					program_start_date AS p_start_date,
					program_end_date AS p_end_date,publish_status,online_payment_transaction_no,
					omr_no,counselling_program_master.template_code,counselling_program_master.registration_template_code as reg_template_code,
					apply_start_date AS a_start_date,apply_end_date AS a_end_date,
					DATE_FORMAT(program_start_date,'%d-%m-%Y') AS program_start_date,
					DATE_FORMAT(program_end_date,'%d-%m-%Y') AS program_end_date,
					DATE_FORMAT(apply_start_date,'%d-%m-%Y %h:%i') AS apply_start_date,
					DATE_FORMAT(apply_end_date,'%d-%m-%Y %h:%i') AS apply_end_date,
					counselling_program_master.program_code,elective_subjects,sequence_code,sequence_no,
					DATE_FORMAT(birth_start_date,'%d-%m-%Y') AS birth_start_date,
					DATE_FORMAT(birth_end_date,'%d-%m-%Y') AS birth_end_date,status");
				$this->db->from('counselling_program_master');
				$this->db->join('form_template_master','counselling_program_master.template_code = form_template_master.template_code','left');
				$this->db->join('registration_template_master','counselling_program_master.template_code = registration_template_master.template_code','left');
				$this->db->join('program_eligibility_setup','counselling_program_master.program_code = program_eligibility_setup.program_code','left');
				$this->db->join('index_sequence_setup','counselling_program_master.program_code = index_sequence_setup.program_code','left');
				$this->db->where('counselling_program_master.institute_code',$institute_code);
				$this->db->where('counselling_program_master.record_status','1');
				$this->db->where('form_template_master.record_status','1');
				$this->db->where('program_end_date>=',$date);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$sl_no = 1;
				foreach ($output_data as $row) 
	            {
	                $row1 = array();
	                $row1[0] = $sl_no;
					$row1['sl_no'] = $sl_no;
					$row1[1] = $row['program_group']; 
					$row1['program_group'] = $row['program_group'];
					$row1[2] = $row['progcode']; 
					$row1['progcode'] = $row['progcode'];
					$row1[3] = $row['program_name']; 
					$row1['program_name'] = $row['program_name'];
					$row1[4] = $row['YEAR'];
					$row1['year'] = $row['YEAR'];
					$row1[5] = $row['sl_no'];
					$row1['order'] = $row['sl_no'];
					$file_name = $row['file_name'];
					$view_file = explode(".", $file_name);
					$file_name = "view_".$file_name;
					$row1[6] = $file_name;
					$row1['file_name'] = $file_name;
					$row1[7] = $row['program_start_date'];
					$row1['program_start_date'] = $row['program_start_date'];
					$row1[8] = $row['program_end_date'];
					$row1['program_end_date'] = $row['program_end_date'];
					if($row['publish_status'] == 'YES')
					{
						$row1[9] = "ACTIVE";
					    $row1['publish_status'] = "ACTIVE";
					}
					else if($row['publish_status'] == 'NO')
					{
						$row1[9] = "INACTIVE";
					    $row1['publish_status'] = "INACTIVE";
					}
					$row1[10] = $row['online_payment_transaction_no'];
					$row1['online_payment_transaction_no'] = $row['online_payment_transaction_no'];
					$row1[11] = $row['omr_no'];
					$row1['omr_no'] = $row['omr_no'];
					$row1[12] = "From ".date('d-m-Y', strtotime($row['program_start_date']))."<br/> To ".date('d-m-Y', strtotime($row['program_end_date']));
					$row1['program_date'] = "From ".date('d-m-Y', strtotime($row['program_start_date']))."<br/> To ".date('d-m-Y', strtotime($row['program_end_date']));
					$row1[13] = $row['apply_start_date'];
					$row1['apply_start_date'] = $row['apply_start_date'];
					$row1[14] = $row['apply_end_date'];
					$row1['apply_end_date'] = $row['apply_end_date'];
					$row1[15] = "From ".$row['apply_start_date']."<br/> To ".$row['apply_end_date'];
					$row1['apply_date'] = "From ".$row['apply_start_date']."<br/> To ".$row['apply_end_date'];
					$row1[16] = $row['program_code'];
					$row1['program_code'] = $row['program_code'];
					$row1[17] = $row['template_code'];
					$row1['template_code'] = $row['template_code'];
					$row1[18] = $row['program_group'];
					$row1['program_group'] = $row['program_group'];
					$row1[19] = $row['elective_subjects'];
					$row1['elective_subjects'] = $row['elective_subjects'];
					$row1[20] = $row['sequence_code'];
					$row1['sequence_code'] = $row['sequence_code'];
					$row1[21] = $row['sequence_no'];
					$row1['sequence_no'] = $row['sequence_no'];
					$row1[22] = $row['birth_start_date'];
					$row1['birth_start_date'] = $row['birth_start_date'];
					$row1[23] = $row['birth_end_date'];
					$row1['birth_end_date'] = $row['birth_end_date'];
					$row1[24] = $row['reg_template_code'];
					$row1['reg_template_code'] = $row['reg_template_code'];
					$row1[26] = $row['status'];
					$row1['status'] = $row['status'];
					$reg_file_name = $row['reg_file_name'];
					if($reg_file_name != ''){
						$view_reg_file = explode(".", $reg_file_name);
						$reg_file_name = $view_reg_file[0]; // piece1
						$reg_file_name = "view-".$reg_file_name.".".$view_reg_file[1];
						$row1[25] = $reg_file_name;
					}
					else{
						$row1[25] = $reg_file_name;
					}
					$row1['file_name'] = $reg_file_name;
					$output['aaData'][] = $row1;
	                $sl_no++;
	                unset($row1);
	            }
	           	return $output;
			break;
			
			// to get profile old datatable data //
			
			case 'get_program_tableold_data':
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
				$this->db->select("program_group,SUBSTRING_INDEX(counselling_program_master.program_code,'_',1) AS progcode,program_name,
					counselling_program_master.YEAR,sl_no,form_template_master.file_name,program_start_date AS p_start_date,registration_template_master.file_name as reg_file_name,
					program_end_date AS p_end_date,publish_status,online_payment_transaction_no,
					omr_no,counselling_program_master.template_code,counselling_program_master.registration_template_code as reg_template_code,
					apply_start_date AS a_start_date,apply_end_date AS a_end_date,
					DATE_FORMAT(program_start_date,'%d-%m-%Y') AS program_start_date,
					DATE_FORMAT(program_end_date,'%d-%m-%Y') AS program_end_date,
					DATE_FORMAT(apply_start_date,'%d-%m-%Y %h:%i') AS apply_start_date,
					DATE_FORMAT(apply_end_date,'%d-%m-%Y %h:%i') AS apply_end_date,
					counselling_program_master.program_code,elective_subjects,sequence_code,sequence_no,
					DATE_FORMAT(birth_start_date,'%d-%m-%Y') AS birth_start_date,
					DATE_FORMAT(birth_end_date,'%d-%m-%Y') AS birth_end_date,counselling_program_master.status");
				$this->db->from('counselling_program_master');
				$this->db->join('form_template_master','counselling_program_master.template_code = form_template_master.template_code','left');
				$this->db->join('registration_template_master','counselling_program_master.template_code = registration_template_master.template_code','left');
				$this->db->join('program_eligibility_setup','counselling_program_master.program_code = program_eligibility_setup.program_code','left');
				$this->db->join('index_sequence_setup','counselling_program_master.program_code = index_sequence_setup.program_code','left');
				$this->db->where('counselling_program_master.institute_code',$institute_code);
				$this->db->where('counselling_program_master.year',$year);
				$this->db->where('counselling_program_master.record_status','1');
				$this->db->where('form_template_master.record_status','1');
				$this->db->where('program_end_date>=',$date);
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			// to get cmb group names data //
			
			case 'select_cmbgroupdata':
				$this->db->distinct('A.program_group_code, A.program_group_name');
				$this->db->from('program_group_master A');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $aRow) 
	            {
					$output['aaData'][] = $aRow;
	                
	            }
	           	return $output;
			break;
			
			// to get cmb registration template data //
			
			case 'select_cmbtemplatereg_data':
				$this->db->select('template_code,template_name');
				$this->db->from('registration_template_master');
				$this->db->where('record_status','1');
				$this->db->order_by('id');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $aRow) 
	            {
					$output['aaData'][] = $aRow;
	                
	            }
	           	return $output;
			break;
			
			// to get cmbtemplate data //
			
			case 'select_cmbtemplatedata':
				$this->db->select('template_code,template_name,template_description,file_name,id');
				$this->db->from('form_template_master');
				$this->db->where('record_status','1');
				$this->db->order_by('id');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $aRow) 
	            {
					$output['aaData'][] = $aRow;
	                
	            }
	           	return $output;
			break;
			
			case 'insert_programdata': 
			 	$dbStatus = "SUCCESS";
				$dbMessage = "Successfully inserted";
				$dbError = '';
            	$dbError = '';
            	$logged_user_code = '';
            	$menuInsert = '';
            	
            	$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
				$logged_user = $this->session->userdata('user_name');
				
				$arr_apply_date = array();
				$arr_eligible_date = array();
				$arr_program_date = array();
            	$txtProgramCode = $_POST['txtProgramCode'];
				$cmbProgramGroup = $_POST['cmbProgramGroup'];
				$taElectiveSubjects = isset($_POST['taElectiveSubjects'])?$_POST['taElectiveSubjects']:'';
				$txtProgramName = $_POST['txtProgramName'];
				$txtYear = $_POST['txtYear'];
				$txtSlno = $_POST['txtSlno'];
				$txtSeqno = $_POST['txtSeqno'];
				$txtSeqCode = $_POST['txtSeqCode'];
				$txtOnlineTransactionNo = $_POST['txtOnlineTransactionNo'];
				$txtOmrNo = $_POST['txtOmrNo'];
				$cmbRegistrationTemplate = $_POST['cmbRegistrationTemplate'];
				$cmbTemplate = $_POST['cmbTemplate'];
				$txtStartdate = $_POST['txtStartdate'];
				$txtAppStartdate = $_POST['txtAppStartdate'];
				$txtEligibledate = $_POST['txtEligibledate'];
				
				
				
				$program_code = "$txtProgramCode"."_"."$institute_code";
				$logged_user_code = "$logged_user"."_"."$institute_code";
				if($txtEligibledate != '')
				{
					$arr_eligible_date = $this->split_string($txtEligibledate,'-',3);
					$txtAgeStartdate = trim($arr_eligible_date[0]);
					$txtAgeEnddate = trim($arr_eligible_date[1]);
				}
				else
				{
					$txtAgeStartdate = '';
					$txtAgeEnddate = '';
				}
				/*echo $txtAgeStartdate;
				die();*/
				$arr_apply_date = $this->split_string($txtAppStartdate,'-',3);
				$arr_program_date = $this->split_string($txtStartdate,'-',3);
				$txtStartdate = trim($arr_program_date[0]);
				$txtEnddate = trim($arr_program_date[1]);
				$txtAppStartdate = trim($arr_apply_date[0]);
				$txtAppEnddate = trim($arr_apply_date[1]);
				
				//mysqli_autocommit($con, FALSE);
				
			 	$op_type = 'insert_programdata';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				
						
				$output = array();
				$new_data = array(
				'program_code' 						=>$program_code,
				'program_group' 					=>$cmbProgramGroup,
				'program_name'						=>$txtProgramName, 
				'elective_subjects'					=>$taElectiveSubjects,
				'year'								=>$txtYear,
				'sl_no'								=>$txtSlno,
				'online_payment_transaction_no'		=>$txtOnlineTransactionNo,
				'omr_no'							=>$txtOmrNo,
				'registration_template_code'		=>$cmbRegistrationTemplate,
				'template_code'						=>$cmbTemplate,
				'program_start_date'				=>date('Y-m-d', strtotime($txtStartdate)),
				'program_end_date'					=>date('Y-m-d', strtotime($txtEnddate)),
				'apply_start_date'					=>date('Y-m-d', strtotime($txtAppStartdate)),
				'apply_end_date'					=>date('Y-m-d', strtotime($txtAppEnddate)),
				'status'							=>'Active',
				'institute_code'					=>$institute_code,
				'created_by'						=>$logged_user_code,
				'created_on'						=>$date
				);
				$insert_user =  $this->db->insert('counselling_program_master', $new_data);
				if( ! $insert_user){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
						$dbError = mysqli_error($con);	
				}
				if($txtAgeStartdate != '' || $txtAgeEnddate != '')
				{
					$new_data1 = array(
					'program_code' 						=>$program_code,
					'birth_start_date'                   =>date('Y-m-d', strtotime($txtAgeStartdate)),
					'birth_END_date'                      =>date('Y-m-d', strtotime($txtAgeEnddate)),
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date
					);
					$insert_user =  $this->db->insert('program_eligibility_setup', $new_data1);
					/*echo $this->db->last_query();
					die(); */
					if(! $insert_user)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
						$dbError = mysqli_error($con);	
					}
				}
				if($txtSeqCode != '')
				{
					$sequence_query = "INSERT INTO index_sequence_setup
							(program_code,year,sequence_code,sequence_no,institute_code,created_by,created_on)
						  VALUES('$program_code',$txtYear,'$txtSeqCode',$txtSeqno,
								'$institute_code','$logged_user',NOW())";
						
					$new_data = array(
					'program_code' 						=>$program_code,
					'year'								=>$txtYear,
					'sequence_code'						=>$txtSeqCode,
					'sequence_no'						=>$txtSeqno,
					'institute_code'					=>$institute_code,
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date
					);
					$insert_user =  $this->db->insert('index_sequence_setup', $new_data); 
					//echo $this->db->last_query();		
					if(! $insert_user)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
						$dbError = mysqli_error($con);	
					}
				}
						
				$this->db->select('menu_code,prog_sl_no,record_status,created_by,created_on');
				$this->db->from('program_menu_master');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $aRow1) 
	            {
	                $new_data = array(
					'program_code' 						=>$program_code,
					'menu_code'							=>$aRow1['menu_code'],
					'sl_no'								=>$aRow1['prog_sl_no'],
					'record_status'						=>$aRow1['record_status'],
					'show_status'						=>'1',
					'institute_code'					=>$institute_code,
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date
					);
					$menu_Insert =  $this->db->insert('program_menu_setup', $new_data);
					if(! $menu_Insert)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
						$dbError = mysqli_error($con);	
					}
					
	            }
				
				$this->db->select('qualification_code,1,created_by,created_on');
				$this->db->from('qualification_master');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $aRow2) 
	            {
	                $new_data = array(
					'program_code' 						=>$program_code,
					'qualification_code'				=>$aRow2['qualification_code'],
					'record_status'						=>$aRow2['1'],
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date
					);
					$qualificationInsert =  $this->db->insert('program_qualification_setup', $new_data);
					if(! $qualificationInsert)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
						$dbError = mysqli_error($con);	
					}
					
	            }		
	            	
				$this->db->select('category_code,record_status,created_by,created_on');
				$this->db->from('category_master');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());		
				foreach ($output_data as $aRow3) 
	            {
	                $new_data = array(
					'program_code' 						=>$program_code,
					'category_code'						=>$aRow3['category_code'],
					'record_status'						=>$aRow3['record_status'],
					'institute_code'					=>$institute_code,
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date
					);
					$feeInsert =  $this->db->insert('program_fee_setup', $new_data);
					if(! $feeInsert)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
						$dbError = mysqli_error($con);	
					}
					
	            }	
	            
				$this->db->select('document_type_code,record_status,created_by,created_on');
				$this->db->from('document_type_master');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());		
				foreach ($output_data as $aRow4) 
	            {
	                $new_data = array(
					'program_code' 						=>$program_code,
					'document_type_code'				=>$aRow4['document_type_code'],
					'record_status'						=>$aRow4['record_status'],
					'institute_code'					=>$institute_code,
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date
					);
					$documentInsert =  $this->db->insert('program_document_setup', $new_data);
					if(! $documentInsert)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
						$dbError = mysqli_error($con);	
					}
					
	            }
							
	           	$this->db->select('sms_type,1,created_by,created_on');
				$this->db->from('sms_setup');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());		
				foreach ($output_data as $aRow5) 
	            {
	                $new_data = array(
					'program_code' 						=>$program_code,
					'sms_type'							=>$aRow5['sms_type'],
					'record_status'						=>$aRow5['1'],
					'institute_code'					=>$institute_code,
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date
					);
					$smsInsert =  $this->db->insert('program_sms_setup', $new_data);
					if(! $smsInsert)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
						$dbError = mysqli_error($con);	
					}
					
	            }	
				$this->db->select('email_type,1,created_by,created_on');
				$this->db->from('email_setup');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());		
				foreach ($output_data as $aRow6) 
	            {
	                $new_data = array(
					'program_code' 						=>$program_code,
					'email_type'						=>$aRow6['email_type'],
					'record_status'						=>$aRow6['1'],
					'institute_code'					=>$institute_code,
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date
					);
					$email_Insert =  $this->db->insert('program_email_setup', $new_data);
					if(! $email_Insert)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
						$dbError = mysqli_error($con);	
					}
					
	            }
	            	
				$this->db->select('category_code,1,created_by,created_on');
				$this->db->from('category_master');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());		
				foreach ($output_data as $aRow7) 
	            {
	                $new_data = array(
					'program_code' 						=>$program_code,
					'category_code'						=>$aRow7['category_code'],
					'record_status'						=>$aRow7['1'],
					'institute_code'					=>$institute_code,
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date
					);
					$categoryInsert =  $this->db->insert('program_category_setup', $new_data);
					if(! $categoryInsert)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
						$dbError = mysqli_error($con);	
					}
					
	            }	
	            				
	            $this->db->select('code_group,code,created_by,created_on');
				$this->db->from('registration_field_setup');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());		
				foreach ($output_data as $aRow8) 
	            {
	                $new_data = array(
					'program_code' 						=>$program_code,
					'code_group'						=>$aRow8['code_group'],
					'field_code'						=>$aRow8['code'],
					'field_status'						=>'COMPULSORY',
					'institute_code'					=>$institute_code,
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date
					);
					$registrationFieldInsert =  $this->db->insert('program_registration_field_mapping', $new_data);
					if(! $registrationFieldInsert)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
						$dbError = mysqli_error($con);	
					}
					
	            }	
				$output = array('dbStatus'=>$dbStatus,'dbMessage'=>$dbMessage);
				return $output; 
			break;
			
			// to check duplicate program code //
			case 'CHKDUCPLICATE_data':
				$dbstatus = '';
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				if($_POST['validateprogramcode'])
				{
					$getProgramCode = $_POST['txtProgramCode']."_".$institute_code;
					
					$this->db->select('COUNT(program_code) AS program_code');
					$this->db->from('counselling_program_master');
					$this->db->where('program_code',$getProgramCode);
					$this->db->where('record_status','1');
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					foreach ($output_data as $aRow) 
		            {
						$output['aaData'][] = $aRow['program_code'];
						$dbstatus = $aRow['program_code'];
		                
		            }
		            $output = array('status'=>$dbstatus);
		           	return $output;
				}
				
			break;
			
			case 'get_program_groupdata':
				$this->db->distinct('A.program_group_code, A.program_group_name');
				$this->db->from('program_group_master A');
				$this->db->order_by(' A.sl_no');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $aRow) 
	            {
					$output['aaData'][] = $aRow;
	                
	            }
	           	return $output;
			break;
			
			case 'get_copyformdata':
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->distinct('program_code');
				$this->db->select("program_code,CONCAT(program_name,' (',SUBSTRING_INDEX(program_code,'_',1),')') AS program_name ");
				$this->db->from('counselling_program_master A');
				$this->db->where('record_status','1');
				$this->db->where('institute_code',$institute_code);
				$this->db->order_by(' A.sl_no');
				$result = $this->db->get();
				$output_data = $result->result_array();
				//echo $this->db->last_query();
				$output = array("aaData" => array());
				foreach ($output_data as $aRow) 
	            {
					$output['aaData'][] = $aRow;
	                
	            }
	           	return $output;
			break;
			
			case 'CHKDUCPLICATECOPY_data':
				$dbstatus = '';
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				if($_POST['validateprogramcode'])
				{
					$getProgramCode = $_POST['txtProgramCodeCopy']."_".$institute_code;
					
					$this->db->select('COUNT(program_code) AS program_code');
					$this->db->from('counselling_program_master');
					$this->db->where('program_code',$getProgramCode);
					$this->db->where('record_status','1');
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					foreach ($output_data as $aRow) 
		            {
						$output['aaData'][] = $aRow['program_code'];
						$dbstatus = $aRow['program_code'];
		                
		            }
		            $output = array('status'=>$dbstatus);
		           	return $output;
				}
				
			break;
			
			case 'insert_copydata': 
				$dbStatus = "SUCCESS";
				$dbMessage = "Successfully Copied";
				$dbError = '';
            	
            	$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
				$logged_user = $this->session->userdata('user_name');
            	$cmbProgramGroupCopy = $_POST['cmbProgramGroupCopy'];
				$txtProgramCodeCopy = $_POST['txtProgramCodeCopy'];
				$txtProgramNameCopy = $_POST['txtProgramNameCopy'];
				$cmbCopyFrom = $_POST['cmbCopyFrom'];
				$txtStartdateCopy = $_POST['txtStartdateCopy'];
				$txtEnddateCopy = $_POST['txtEnddateCopy'];
				$txtAppStartdateCopy = $_POST['txtAppStartdateCopy'];
				$txtAppEnddateCopy = $_POST['txtAppEnddateCopy'];
				$program_code = $txtProgramCodeCopy."_".$institute_code;
				$logged_user_code = "$logged_user"."_"."$institute_code";
				
			 	//$op_type = 'insert_copydata';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$this->db->select('program_code,program_group,program_name,elective_subjects,
						YEAR,sl_no,online_payment_transaction_no,omr_no,registration_template_code,template_code,
						program_start_date,program_end_date,
						apply_start_date,apply_end_date,
						STATUS');
				$this->db->from('counselling_program_master');
				$this->db->where('program_group',$cmbProgramGroupCopy);
				$this->db->where('program_code',$cmbCopyFrom);
				$this->db->where('record_status','1');
				$this->db->where('institute_code',$institute_code);
				$result = $this->db->get();
				
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
	            	$resultee = $aRow['elective_subjects'];
	                $new_data = array(
					'program_code' 						=>$program_code,
					'program_group'						=>$cmbProgramGroupCopy,
					'program_name'						=>$txtProgramNameCopy,
					'elective_subjects'					=>$resultee,
					'YEAR'								=>$aRow['YEAR'],
					'sl_no'								=>$aRow['sl_no'],
					'online_payment_transaction_no'		=>$aRow['online_payment_transaction_no'],
					'omr_no'							=>$aRow['omr_no'],
					'registration_template_code'		=>$aRow['registration_template_code'],
					'template_code'						=>$aRow['template_code'],
					'program_start_date'				=>$aRow['program_start_date'],
					'program_end_date'					=>$aRow['program_end_date'],
					'apply_start_date'					=>$aRow['apply_start_date'],
					'apply_end_date'					=>$aRow['apply_end_date'],
					'STATUS'							=>$aRow['STATUS'],
					'institute_code'					=>$institute_code,
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date
					);
					$insert_user = $this->db->insert('counselling_program_master', $new_data);
					//echo $insert_user;
					if(! $insert_user)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
					
					/*$output = array('status'=>$dbStatus,'msg'=>$dbMessage);
					return $output; */
					
				}	
				$this->db->select('program_code,birth_start_date,birth_END_date,created_by,created_on');
				$this->db->from('program_eligibility_setup');
				$this->db->where('program_code',$cmbCopyFrom);
				$this->db->where('record_status','1');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
	                $new_data = array(
					'program_code' 						=>$program_code,
					'birth_start_date'					=>$aRow['birth_start_date'],
					'birth_END_date'					=>$aRow['birth_END_date'],
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date,
					);
					$age_query = $this->db->insert('program_eligibility_setup', $new_data);
					if(! $age_query)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
					
					/*$output = array('status'=>$dbStatus,'msg'=>$dbMessage);
					return $output; */
	            }
		        //echo $cmbCopyFrom; 
				$this->db->select('program_code,YEAR,sequence_code,sequence_no,institute_code,created_by,created_on');
				$this->db->from('index_sequence_setup');
				$this->db->where('institute_code',$institute_code);
				$this->db->where('program_code',$cmbCopyFrom);
				$this->db->where('record_status','1');
				
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
	                $new_data = array(
					'program_code' 						=>$program_code,
					'YEAR'								=>$aRow['YEAR'],
					'sequence_code'						=>$aRow['sequence_code'],
					'sequence_no'						=>$aRow['sequence_no'],
					'institute_code'					=>$institute_code,
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date,
					);
					
					$sequence_query = $this->db->insert('index_sequence_setup', $new_data);
					if(! $sequence_query)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
					/*$output = array('status'=>$dbStatus,'msg'=>$dbMessage);
					return $output; */
	            }	
		            
				$this->db->select('program_code,menu_code,sl_no,show_status,file_path,file_name,record_status,
									institute_code,created_by,created_on');
				$this->db->from('program_menu_setup');
				$this->db->where('institute_code',$institute_code);
				$this->db->where('program_code',$cmbCopyFrom);
				$this->db->where('record_status','Active');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
	                $new_data = array(
					'program_code' 						=>$program_code,
					'menu_code'							=>$aRow['menu_code'],
					'sl_no'								=>$aRow['sl_no'],
					'show_status'						=>$aRow['show_status'],
					'file_path'							=>$aRow['file_path'],
					'file_name'							=>$aRow['file_name'],
					'record_status'						=>$aRow['record_status'],
					'institute_code'					=>$institute_code,
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date,
					);
					
					$menuInsert = $this->db->insert('program_menu_setup', $new_data);
					if(! $menuInsert)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
					/*$output = array('status'=>$dbStatus,'msg'=>$dbMessage);
					return $output; */
	            }
	            
				$this->db->select('program_code,qualification_code,record_status,created_by,created_on');
				$this->db->from('program_qualification_setup');
				$this->db->where('program_code',$cmbCopyFrom);
				$this->db->where('record_status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
	                $new_data = array(
					'program_code' 						=>$program_code,
					'qualification_code'				=>$aRow['qualification_code'],
					'record_status'						=>$aRow['record_status'],
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date,
					);
					
					$qualificationInsert = $this->db->insert('program_qualification_setup', $new_data);
					if(! $qualificationInsert)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
					/*$output = array('status'=>$dbStatus,'msg'=>$dbMessage);
					return $output; */
	            }	
	            
				$this->db->select('program_code,category_code,amount,record_status,institute_code,created_by,created_on');
				$this->db->from('program_fee_setup');
				$this->db->where('institute_code',$institute_code);
				$this->db->where('program_code',$cmbCopyFrom);
				$this->db->where('record_status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
	                $new_data = array(
					'program_code' 						=>$program_code,
					'category_code'						=>$aRow['category_code'],
					'amount'							=>$aRow['amount'],
					'record_status'						=>$aRow['record_status'],
					'institute_code'					=>$institute_code,
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date,
					);
					
					$feeInsert = $this->db->insert('program_fee_setup', $new_data);
					if(! $feeInsert)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
					/*$output = array('status'=>$dbStatus,'msg'=>$dbMessage);
					return $output; */
	            }
	            
				$this->db->select('program_code,document_type_code,sl_no,record_status,institute_code,created_by,created_on');
				$this->db->from('program_document_setup');
				$this->db->where('institute_code',$institute_code);
				$this->db->where('program_code',$cmbCopyFrom);
				$this->db->where('record_status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
	                $new_data = array(
					'program_code' 						=>$program_code,
					'document_type_code'				=>$aRow['document_type_code'],
					'sl_no'								=>$aRow['sl_no'],
					'record_status'						=>$aRow['record_status'],
					'institute_code'					=>$institute_code,
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date,
					);
					
					$documentInsert = $this->db->insert('program_document_setup', $new_data);
					if(! $documentInsert)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
					/*$output = array('status'=>$dbStatus,'msg'=>$dbMessage);
					return $output; */
	            }	
	            
				$this->db->select('sms_type,program_code,record_status,institute_code,created_by,created_on');
				$this->db->from('program_sms_setup');
				$this->db->where('institute_code',$institute_code);
				$this->db->where('program_code',$cmbCopyFrom);
				$this->db->where('record_status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
	                $new_data = array(
					'program_code' 						=>$program_code,
					'sms_type'							=>$aRow['sms_type'],
					'record_status'						=>$aRow['record_status'],
					'institute_code'					=>$institute_code,
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date,
					);
					$smsInsert = $this->db->insert('program_sms_setup', $new_data);
					if(! $smsInsert)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
					/*$output = array('status'=>$dbStatus,'msg'=>$dbMessage);
					return $output; */
	            }			
				
				$this->db->select('program_code,email_type,record_status,institute_code,created_by,created_on');
				$this->db->from('program_email_setup');
				$this->db->where('institute_code',$institute_code);
				$this->db->where('program_code',$cmbCopyFrom);
				$this->db->where('record_status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
	                $new_data = array(
					'program_code' 						=>$program_code,
					'email_type'						=>$aRow['email_type'],
					'record_status'						=>$aRow['record_status'],
					'institute_code'					=>$institute_code,
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date,
					);
					$emailInsert = $this->db->insert('program_email_setup', $new_data);
					if(! $emailInsert)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
					/*$output = array('status'=>$dbStatus,'msg'=>$dbMessage);
					return $output; */
	            }	
	            
	            
				$this->db->select('program_code,category_code,record_status,institute_code,created_by,created_on');
				$this->db->from('program_category_setup');
				$this->db->where('institute_code',$institute_code);
				$this->db->where('program_code',$cmbCopyFrom);
				$this->db->where('record_status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
	                $new_data = array(
					'program_code' 						=>$program_code,
					'category_code'						=>$aRow['category_code'],
					'record_status'						=>$aRow['record_status'],
					'institute_code'					=>$institute_code,
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date,
					);
					$categoryInsert = $this->db->insert('program_category_setup', $new_data);
					if(! $categoryInsert)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
					/*$output = array('status'=>$dbStatus,'msg'=>$dbMessage);
					return $output; */
	            }			
						
				$this->db->select('program_code,code_group,field_code,field_status,institute_code,created_by,created_on,record_status');
				$this->db->from('program_registration_field_mapping');
				$this->db->where('institute_code',$institute_code);
				$this->db->where('program_code',$cmbCopyFrom);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
	                $new_data = array(
					'program_code' 						=>$program_code,
					'code_group'						=>$aRow['code_group'],
					'field_code'						=>$aRow['field_code'],
					'field_status'						=>$aRow['field_status'],
					'record_status'						=>$aRow['record_status'],
					'institute_code'					=>$institute_code,
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date,
					);
					$registrationFieldInsert = $this->db->insert('program_registration_field_mapping', $new_data);
					if(! $registrationFieldInsert)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
					/*$output = array('status'=>$dbStatus,'msg'=>$dbMessage);
					return $output; */
	            }	
	            
	            
				$this->db->select('program_code,exam_centre_code,exam_centre_name,record_status,created_by,created_on,record_status');
				$this->db->from('exam_centre_master');
				$this->db->where('program_code',$cmbCopyFrom);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
	                $new_data = array(
					'program_code' 						=>$program_code,
					'exam_centre_code'					=>$aRow['exam_centre_code'],
					'exam_centre_name'					=>$aRow['exam_centre_name'],
					'record_status'						=>$aRow['record_status'],
					'institute_code'					=>$institute_code,
					'created_by'						=>$logged_user_code,
					'created_on'						=>$date,
					);
					$exam_center = $this->db->insert('exam_centre_master', $new_data);
					if(! $exam_center)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
					/*$output = array('status'=>$dbStatus,'msg'=>$dbMessage);
					return $output;*/ 
	            }	
	            
	            $this->db->select('program_code,transaction_charge,status,institute_code,created_by,created_on');
				$this->db->from('counselling_online_transaction_charge_setup ');
				$this->db->where('institute_code',$institute_code);
				$this->db->where('program_code',$cmbCopyFrom);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
	                $new_data = array(
					'program_code' 							=>$program_code,
					'transaction_charge'					=>$aRow['transaction_charge'],
					'status'								=>$aRow['status'],
					'record_status'							=>$aRow['record_status'],
					'institute_code'						=>$institute_code,
					'created_by'							=>$logged_user_code,
					'created_on'							=>$date,
					);
					$online_transaction = $this->db->insert('counselling_online_transaction_charge_setup ', $new_data);
					if(! $online_transaction)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
					/*$output = array('status'=>$dbStatus,'msg'=>$dbMessage);
					return $output; */
	            }
	            
	            
				$bank_code = '';
	            $this->db->select('bank_code');
				$this->db->from('challan_detail');
				$this->db->where('institute_code',$institute_code);
				$this->db->where('program_code',$cmbCopyFrom);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
					$bank_code = $aRow['bank_code'];
	            }
	            $challan_code = $program_code.$bank_code;
	            $this->db->select('program_code,bank_code,bank_name,branch_name,account_no,transaction_charge,
							status,challan_code,institute_code,created_by,created_on');
				$this->db->from('challan_detail');
				$this->db->where('institute_code',$institute_code);
				$this->db->where('program_code',$cmbCopyFrom);
				$this->db->where('challan_code',$challan_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
	               $new_data = array(
					'program_code' 							=>$program_code,
					'bank_code'								=>$aRow['bank_code'],
					'bank_name'								=>$aRow['bank_name'],
					'branch_name'							=>$aRow['branch_name'],
					'account_no'							=>$aRow['account_no'],
					'transaction_charge'					=>$aRow['transaction_charge'],
					'status'								=>$aRow['status'],
					'institute_code'						=>$institute_code,
					'created_by'							=>$logged_user_code,
					'created_on'							=>$date,
					);
					$challan_setup = $this->db->insert('challan_detail', $new_data);
					if(! $challan_setup)
					{
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
					/*$output = array('status'=>$dbStatus,'msg'=>$dbMessage);
					return $output; */
	            }
	            if($dbStatus == "SUCCESS")
				{
					$output = array("dbStatus"=>$dbStatus,"dbMessage"=>$dbMessage,"dbError"=>$dbError);
					return $output; 
				}
				else
				{
					$output = array("dbStatus"=>$dbStatus,"dbMessage"=>$dbMessage,"dbError"=>$dbError);
					return $output; 
				}			
	        break; 
	        
	        case 'select_yeardata':
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
					
				$this->db->distinct('A.year as year');
				$this->db->select('A.year as year');
				$this->db->from('counselling_program_master A,institute_master B');
				$this->db->where('B.institute_code',$institute_code);
				$this->db->where('program_end_date<',$date);
				$this->db->where(' B.record_status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $aRow) 
	            {
					$output['aaData'][] = $aRow;
	                
	            }
	           	return $output;
			break;
			
			case 'edit_currentdata':
				$dbstatus = "SUCCESS";
				$dbmessage = "Updated Successfully";
				$dbError = "";
				
				$arr_apply_date = array();
				$arr_eligible_date = array();
				$arr_program_date = array();
				
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
        		$logged_user = $this->session->userdata('user_name');
        		
				$hidUniqueidEdit = $_POST['hidUniqueidEdit'];
				$txtProgramCodeEdit = $_POST['txtProgramCodeEdit'];
				$txtProgramNameEdit = $_POST['txtProgramNameEdit'];
				$cmbProgramGroupEdit = $_POST['cmbProgramGroupEdit'];
				$taElectiveSubjectsEdit = isset($_POST['taElectiveSubjectsEdit'])?$_POST['taElectiveSubjectsEdit']:'';
				$txtYearEdit = $_POST['txtYearEdit'];
				$txtSlnoEdit = $_POST['txtSlnoEdit'];
				$txtSeqnoEdit = $_POST['txtSeqnoEdit'];
				$txtSeqCodeEdit = $_POST['txtSeqCodeEdit'];
				$txtOnlineTransactionNoEdit = $_POST['txtOnlineTransactionNoEdit'];
				$txtOmrNoEdit = $_POST['txtOmrNoEdit'];
				$cmbStatusEdit = $_POST['cmbStatusEdit'];
				$cmbRegistrationTemplateEdit = $_POST['cmbRegistrationTemplateEdit'];
				$cmbTemplateEdit = $_POST['cmbTemplateEdit'];
				
				
				$txtStartdate = $_POST['txtStartdate'];
				$txtAppStartdate = $_POST['txtAppStartdate'];
				$txtEligibledate = $_POST['txtEligibledate'];
				
				if($txtEligibledate != '')
				{
					$arr_eligible_date = $this->split_string($txtEligibledate,'-',3);
					$txtAgeStartdateEdit = trim($arr_eligible_date[0]);
					$txtAgeEnddateEdit = trim($arr_eligible_date[1]);
				}
				else
				{
					$txtAgeStartdateEdit = '';
					$txtAgeEnddateEdit = '';
				}
				$arr_apply_date = $this->split_string($txtAppStartdate,'-',3);
				$arr_program_date = $this->split_string($txtStartdate,'-',3);
				$txtStartdateEdit = trim($arr_program_date[0]);
				$txtEnddateEdit = trim($arr_program_date[1]);
				$txtAppStartdateEdit = trim($arr_apply_date[0]);
				$txtAppEnddateEdit = trim($arr_apply_date[1]);
				
				
				
				$program_code = "$txtProgramCodeEdit"."_"."$institute_code";
				$program_code_edit = "$hidUniqueidEdit"."_"."$institute_code";
        		$logged_user_code = "$logged_user"."_"."$institute_code";
			
        		$op_type = 'edit_currentdata';
				$data = array( 
						"program_code" 	=>$program_code,
						"program_group" => $cmbProgramGroupEdit,
						"elective_subjects" => $taElectiveSubjectsEdit,
						"program_name" => $txtProgramNameEdit,
						"year" => $txtYearEdit,
						"sl_no" => $txtSlnoEdit,
						"online_payment_transaction_no" => $txtOnlineTransactionNoEdit,
						"omr_no" => $txtOmrNoEdit,
						"status" => $cmbStatusEdit,
						"template_code" => $cmbTemplateEdit,
						"registration_template_code" => $cmbRegistrationTemplateEdit,
						"program_start_date"  =>date('Y-m-d', strtotime($txtStartdateEdit)),
						"program_end_date" =>date('Y-m-d', strtotime($txtEnddateEdit)),
						"apply_start_date" =>date('Y-m-d', strtotime($txtAppStartdateEdit)),
						"apply_end_date" =>date('Y-m-d', strtotime($txtAppEnddateEdit)),
						"updated_by" => $logged_user_code,
						"updated_on" => $date,
					);
				$this->db->where('program_code',$program_code_edit);
				$this->db->where('institute_code',$institute_code);
				$this->db->where('record_status','1');
				$update_user = $this->db->update('counselling_program_master',$data);
				if(! $update_user){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
				
				if($txtAgeStartdateEdit != '' || $txtAgeEnddateEdit )
				{
					$this->db->select('COUNT(program_code) AS program_code');
					$this->db->from('program_eligibility_setup');
					$this->db->where('record_status','1');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
		            	$count = $aRow['program_code'];
		            	if($count>=1)
		            	{
							$data = array( 
							"birth_start_date"  =>date('Y-m-d', strtotime($txtAgeStartdateEdit)),
							"birth_end_date" =>date('Y-m-d', strtotime($txtAgeEnddateEdit)),
							"updated_by" => $logged_user_code,
							"updated_on" => $date,
							);
							$this->db->where('updated_by',$logged_user_code);
							$this->db->where('program_code',$program_code_edit);
							$update_user = $this->db->update('program_eligibility_setup',$data);
							if(! $update_user){
								$dbstatus = FALSE;
								$dbmessage = 'Error While Saving';
							}
						}
						else
						{
							$new_array = array( 
							"program_code"  =>date('Y-m-d', strtotime($txtAgeStartdateEdit)),
							"birth_start_date"  =>date('Y-m-d', strtotime($txtAgeStartdateEdit)),
							"birth_end_date" =>date('Y-m-d', strtotime($txtAgeEnddateEdit)),
							"created_by" => $logged_user_code,
							"created_on" => $date,
							);
							$this->db->insert('program_eligibility_setup',$new_array);
							$this->db->where('program_code',$program_code_edit);
							if(! $insert_user){
								$dbstatus = FALSE;
								$dbmessage = 'Error While Saving';
							}
							
						}
		            }
				}
				
				if($txtSeqCodeEdit != '')
				{
					$data = array( 
						"year"  =>$txtYearEdit,
						"sequence_code"  =>$txtSeqCodeEdit,
						"sequence_no"  =>$txtSeqnoEdit,
						"updated_by" => $logged_user_code,
						"updated_on" => $date,
					);
					$this->db->where('program_code',$program_code);
					$update_user = $this->db->update('index_sequence_setup',$data);
					if(! $update_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Updating';
					}
				}
				if($dbstatus == TRUE)
				{
					$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
					return $output;
				}
				else
				{
					$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
					return $output;
				}
				
            break;
            
            case 'edit_old_data':
				$dbstatus = "SUCCESS";
				$dbmessage = "Updated Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
        		$logged_user = $this->session->userdata('user_name');
        		
				$hidUniqueidEdit = $_POST['hidUniqueidEdit'];
				$txtProgramCodeEdit = $_POST['txtProgramCodeEdit'];
				$txtProgramNameEdit = $_POST['txtProgramNameEdit'];
				$cmbProgramGroupEdit = $_POST['cmbProgramGroupEdit'];
				$taElectiveSubjectsEdit = isset($_POST['taElectiveSubjectsEdit'])?$_POST['taElectiveSubjectsEdit']:'';
				$txtYearEdit = $_POST['txtYearEdit'];
				$txtSlnoEdit = $_POST['txtSlnoEdit'];
				$txtSeqnoEdit = $_POST['txtSeqnoEdit'];
				$txtSeqCodeEdit = $_POST['txtSeqCodeEdit'];
				$txtOnlineTransactionNoEdit = $_POST['txtOnlineTransactionNoEdit'];
				$txtOmrNoEdit = $_POST['txtOmrNoEdit'];
				$cmbStatusEdit = $_POST['cmbStatusEdit'];
				$cmbRegistrationTemplateEdit = $_POST['cmbRegistrationTemplateEdit'];
				$cmbTemplateEdit = $_POST['cmbTemplateEdit'];
				$txtStartdateEdit = $_POST['txtStartdateEdit'];
				$txtEnddateEdit = $_POST['txtEnddateEdit'];
				$txtAppStartdateEdit = $_POST['txtAppStartdateEdit'];
				$txtAppEnddateEdit = $_POST['txtAppEnddateEdit'];
				$txtAgeStartdateEdit = isset($_POST['txtAgeStartdateEdit'])?$_POST['txtAgeStartdateEdit']:'';
				$txtAgeEnddateEdit = isset($_POST['txtAgeEnddateEdit'])?$_POST['txtAgeEnddateEdit']:'';
				$program_code = "$txtProgramCodeEdit"."_"."$institute_code";
				$program_code_edit = "$hidUniqueidEdit"."_"."$institute_code";
        		$logged_user_code = "$logged_user"."_"."$institute_code";
			
        		$op_type = 'edit_currentdata';
				$data = array( 
						"program_code" 	=>$program_code,
						"program_group" => $cmbProgramGroupEdit,
						"elective_subjects" => $taElectiveSubjectsEdit,
						"program_name" => $txtProgramNameEdit,
						"year" => $txtYearEdit,
						"sl_no" => $txtSlnoEdit,
						"online_payment_transaction_no" => $txtOnlineTransactionNoEdit,
						"omr_no" => $txtOmrNoEdit,
						"status" => $cmbStatusEdit,
						"template_code" => $cmbTemplateEdit,
						"registration_template_code" => $cmbRegistrationTemplateEdit,
						"program_start_date"  =>date('Y-m-d', strtotime($txtStartdateEdit)),
						"program_end_date" =>date('Y-m-d', strtotime($txtEnddateEdit)),
						"apply_start_date" =>date('Y-m-d', strtotime($txtAppStartdateEdit)),
						"apply_end_date" =>date('Y-m-d', strtotime($txtAppEnddateEdit)),
						"updated_by" => $logged_user_code,
						"updated_on" => $date,
					);
				$this->db->where('program_code',$program_code_edit);
				$this->db->where('institute_code',$institute_code);
				$this->db->where('record_status','1');
				$update_user = $this->db->update('counselling_program_master',$data);
				if(! $update_user){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
				
				if($txtAgeStartdateEdit != '' || $txtAgeEnddateEdit )
				{
					$this->db->select('COUNT(program_code) AS program_code');
					$this->db->from('program_eligibility_setup');
					$this->db->where('record_status','1');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
		            	$count = $aRow['program_code'];
		            	if($count>=1)
		            	{
							$data = array( 
							"birth_start_date"  =>date('Y-m-d', strtotime($txtAgeStartdateEdit)),
							"birth_end_date" =>date('Y-m-d', strtotime($txtAgeEnddateEdit)),
							"updated_by" => $logged_user_code,
							"updated_on" => $date,
							);
							$this->db->where('updated_by',$logged_user_code);
							$this->db->where('program_code',$program_code_edit);
							$update_user = $this->db->update('program_eligibility_setup',$data);
							if(! $update_user){
								$dbstatus = FALSE;
								$dbmessage = 'Error While Saving';
							}
						}
						else
						{
							$new_array = array( 
							"program_code"  =>date('Y-m-d', strtotime($txtAgeStartdateEdit)),
							"birth_start_date"  =>date('Y-m-d', strtotime($txtAgeStartdateEdit)),
							"birth_end_date" =>date('Y-m-d', strtotime($txtAgeEnddateEdit)),
							"created_by" => $logged_user_code,
							"created_on" => $date,
							);
							$this->db->insert('program_eligibility_setup',$new_array);
							$this->db->where('program_code',$program_code_edit);
							if(! $insert_user){
								$dbstatus = FALSE;
								$dbmessage = 'Error While Saving';
							}
							
						}
		            }
				}
				
				if($txtSeqCodeEdit != '')
				{
					$data = array( 
						"year"  =>$txtYearEdit,
						"sequence_code"  =>$txtSeqCodeEdit,
						"sequence_no"  =>$txtSeqnoEdit,
						"updated_by" => $logged_user_code,
						"updated_on" => $date,
					);
					$this->db->where('program_code',$program_code);
					$update_user = $this->db->update('index_sequence_setup',$data);
					if(! $update_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Updating';
					}
				}
				if($dbstatus == TRUE)
				{
					$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
					return $output;
				}
				else
				{
					$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
					return $output;
				}
				
            break;
            
            
            case 'CHKEDITDUCPLICATE_data':
				$dbstatus = '';
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
				if($_POST['validateprogramcode'])
				{
					$getProgramCode = $_POST['txtProgramCodeEdit']."_".$institute_code;
					$this->db->select('COUNT(program_code) AS program_code');
					$this->db->from('counselling_program_master');
					$this->db->where('program_code',$getProgramCode);
					$this->db->where('record_status','1');
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					foreach ($output_data as $aRow) 
		            {
						$output['aaData'][] = $aRow['program_code'];
						$dbstatus = $aRow['program_code'];
		                
		            }
		            $output = array('status'=>$dbstatus);
		           	return $output;
				}
				
			break;
			
			
			case 'delete_currentdata': 
				$dbstatus = 'SUCCESS';
            	$dbmessage = 'Data deleted successfully';
            	$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$output = array();
				$id = $_POST['programCode'];
				$code = $id."_".$institute_code;
				$this->db->where('program_code', $code);
				$delete = $this->db->delete('counselling_program_master'); 
				if(! $delete){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			
            case 'publish_currentdata':
				$dbstatus = "SUCCESS";
				$dbmessage = "Published Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
        		$logged_user = $this->session->userdata('user_name');
        		
        		$id = $_POST['programCode'];
				$prog_code = $id."_".$institute_code;
				$data = array( 
						"publish_status"  =>'YES',
					);
				$this->db->where('program_code',$prog_code);
				$update_user = $this->db->update('counselling_program_master',$data);
					
				if(! $update_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Updating';
					}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output; 
			break;	
			
			case 'count_program_menu_data':
				$dbstatus = TRUE;
				$dbmessage = "Updated Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
        		$logged_user = $this->session->userdata('user_name');
        		
        		if($_POST['program_code'])
				{
					$program_code = $_POST['program_code'];
					$prog_code = $program_code."_".$institute_code;
					$this->db->select('count(record_status) as total_record_count');
	                $this->db->from('program_menu_setup');	
	                $this->db->where('program_code',$prog_code);
	               
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
						$output = $aRow['total_record_count'];
		            }
				}
		        return $output;
			break;		
			
			case 'count_active_program_menu_data':
				$dbstatus = TRUE;
				$dbmessage = "Updated Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
        		$logged_user = $this->session->userdata('user_name');
        		
        		if($_POST['program_code'])
				{
					$program_code = $_POST['program_code'];
					$prog_code = $program_code."_".$institute_code;
					$this->db->select('count(record_status) as active_record_count');
	                $this->db->from('program_menu_setup');	
	                $this->db->where('record_status','Active');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
						$output = $aRow['active_record_count'];
		            }
				}
		        return $output;
			break;
			
			case 'count_show_menu_data':
				$dbstatus = TRUE;
				$dbmessage = "Updated Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
        		$logged_user = $this->session->userdata('user_name');
        		
        		if($_POST['program_code'])
				{
					$program_code = $_POST['program_code'];
					$prog_code = $program_code."_".$institute_code;
					$this->db->select('count(record_status) as active_record_count');
	                $this->db->from('program_menu_setup');	
	                $this->db->where('program_code',$prog_code);
	                $this->db->where('record_status','Active');
	                $this->db->where('show_status','1');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
						$output = $aRow['active_record_count'];
		            }
				}
		        return $output;
			break;
			
			case 'count_zero_data':
				$dbstatus = TRUE;
				$dbmessage = "Updated Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
        		$logged_user = $this->session->userdata('user_name');
        		
        		if($_POST['program_code'])
				{
					$program_code = $_POST['program_code'];
					$prog_code = $program_code."_".$institute_code;
					$this->db->select('count(program_code) as zero_fee_program');
	                $this->db->from('program_fee_setup');	
	                $this->db->where('program_code',$prog_code);
	                $this->db->where('amount','0');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
						$output = $aRow['zero_fee_program'];
		            }
				}
		        return $output;
			break;
			
			case 'inactive_documents_data':
				$dbstatus = TRUE;
				$dbmessage = "Updated Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
        		$logged_user = $this->session->userdata('user_name');
        		
        		if($_POST['program_code'])
				{
					$program_code = $_POST['program_code'];
					$prog_code = $program_code."_".$institute_code;
					$this->db->select('count(program_code) as inactive_documents');
	                $this->db->from('program_document_setup');	
	                $this->db->where('record_status','0');
	                $where = '(record_status="Active" or record_status = "1")';
					$this->db->where($where);
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
						$output = $aRow['inactive_documents'];
		            }
				}
		        return $output;
			break;
			
			case 'count_challandata':
				$dbstatus = TRUE;
				$dbmessage = "Updated Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
        		$logged_user = $this->session->userdata('user_name');
        		
        		if($_POST['program_code'])
				{
					$program_code = $_POST['program_code'];
					$prog_code = $program_code."_".$institute_code;
					$this->db->select('count(challan_code) as challan_count');
	                $this->db->from('challan_detail');	
	                $this->db->where('program_code',$prog_code);
	                $this->db->where('status','1');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
						$output = $aRow['challan_count'];
		            }
				}
		        return $output;
			break;
			
			case 'count_examcenter_data':
				$dbstatus = TRUE;
				$dbmessage = "Updated Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
        		$logged_user = $this->session->userdata('user_name');
        		
        		if($_POST['program_code'])
				{
					$program_code = $_POST['program_code'];
					$prog_code = $program_code."_".$institute_code;
					$this->db->select('count(exam_centre_code) as count_exam_centre');
	                $this->db->from('exam_centre_master');	
	                $this->db->where('program_code',$prog_code);
	                $this->db->where('record_status','1');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
						$output = $aRow['count_exam_centre'];
		            }
				}
		        return $output;
			break;
			case 'count_inactive_sms_data':
				$dbstatus = TRUE;
				$dbmessage = "Updated Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
        		$logged_user = $this->session->userdata('user_name');
        		
        		if($_POST['program_code'])
				{
					$program_code = $_POST['program_code'];
					$prog_code = $program_code."_".$institute_code;
					$this->db->select('count(program_code) as count_sms');
	                $this->db->from('program_sms_setup');	
	                $this->db->where('program_code',$prog_code);
	                $this->db->where('record_status','0');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
						$output = $aRow['count_sms'];
		            }
				}
		        return $output;
			break;
			case 'count_inactive_cat_data':
				$dbstatus = TRUE;
				$dbmessage = "Updated Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
        		$logged_user = $this->session->userdata('user_name');
        		
        		if($_POST['program_code'])
				{
					$program_code = $_POST['program_code'];
					$prog_code = $program_code."_".$institute_code;
					$this->db->select('count(program_code) as count_category');
	                $this->db->from('program_category_setup');	
	                $this->db->where('program_code',$prog_code);
	                $this->db->where('record_status','0');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
						$output = $aRow['count_category'];
		            }
				}
		        return $output;
			break;
			
			case 'SELECT_OLD_data':
				$dbstatus = TRUE;
				$dbmessage = "Updated Successfully";
				$dbError = "";
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
        		$output = array("aaData" => array());
        		$year = isset($_POST['y'])?$_POST['y']:'';
				if($year != '')
				{
					$this->db->select("program_group,SUBSTRING_INDEX(counselling_program_master.program_code,'_',1) AS progcode,program_name,
						counselling_program_master.YEAR,sl_no,form_template_master.file_name,program_start_date AS p_start_date,registration_template_master.file_name as reg_file_name,
						program_end_date AS p_end_date,publish_status,online_payment_transaction_no,
						omr_no,counselling_program_master.template_code,counselling_program_master.registration_template_code as reg_template_code,
						apply_start_date AS a_start_date,apply_end_date AS a_end_date,
						DATE_FORMAT(program_start_date,'%d-%m-%Y') AS program_start_date,
						DATE_FORMAT(program_end_date,'%d-%m-%Y') AS program_end_date,
						DATE_FORMAT(apply_start_date,'%d-%m-%Y %h:%i') AS apply_start_date,
						DATE_FORMAT(apply_end_date,'%d-%m-%Y %h:%i') AS apply_end_date,
						counselling_program_master.program_code,elective_subjects,sequence_code,sequence_no,
						DATE_FORMAT(birth_start_date,'%d-%m-%Y') AS birth_start_date,
						DATE_FORMAT(birth_end_date,'%d-%m-%Y') AS birth_end_date,status");
					$this->db->from('counselling_program_master');
					$this->db->join('form_template_master','counselling_program_master.template_code = form_template_master.template_code','left');
					$this->db->join('registration_template_master','counselling_program_master.template_code = registration_template_master.template_code','left');
					$this->db->join('program_eligibility_setup','counselling_program_master.program_code = program_eligibility_setup.program_code','left');
					$this->db->join('index_sequence_setup','counselling_program_master.program_code = index_sequence_setup.program_code','left');
					$this->db->where('counselling_program_master.institute_code',$institute_code);
					$this->db->where('counselling_program_master.year',$year);
					$this->db->where('counselling_program_master.record_status','1');
					$this->db->where('form_template_master.record_status','1');
					$this->db->where('program_end_date<',$date);
					//$result = $this->db->get();
					//echo $this->db->last_query();
				}
				else
				{
					$this->db->select("program_group,SUBSTRING_INDEX(counselling_program_master.program_code,'_',1) AS progcode,program_name,
						counselling_program_master.YEAR,sl_no,form_template_master.file_name,program_start_date AS p_start_date,registration_template_master.file_name as reg_file_name,
						program_end_date AS p_end_date,publish_status,online_payment_transaction_no,
						omr_no,counselling_program_master.template_code,counselling_program_master.registration_template_code as reg_template_code,
						apply_start_date AS a_start_date,apply_end_date AS a_end_date,
						DATE_FORMAT(program_start_date,'%d-%m-%Y') AS program_start_date,
						DATE_FORMAT(program_end_date,'%d-%m-%Y') AS program_end_date,
						DATE_FORMAT(apply_start_date,'%d-%m-%Y %h:%i') AS apply_start_date,
						DATE_FORMAT(apply_end_date,'%d-%m-%Y %h:%i') AS apply_end_date,
						counselling_program_master.program_code,elective_subjects,sequence_code,sequence_no,
						DATE_FORMAT(birth_start_date,'%d-%m-%Y') AS birth_start_date,
						DATE_FORMAT(birth_end_date,'%d-%m-%Y') AS birth_end_date,status");
					$this->db->from('counselling_program_master');
					$this->db->join('form_template_master','counselling_program_master.template_code = form_template_master.template_code','left');
					$this->db->join('registration_template_master','counselling_program_master.template_code = registration_template_master.template_code','left');
					$this->db->join('program_eligibility_setup','counselling_program_master.program_code = program_eligibility_setup.program_code','left');
					$this->db->join('index_sequence_setup','counselling_program_master.program_code = index_sequence_setup.program_code','left');
					$this->db->where('counselling_program_master.institute_code',$institute_code);
					$this->db->where('counselling_program_master.record_status','1');
					$this->db->where('form_template_master.record_status','1');
					$this->db->where('program_end_date<',$date);
					//$result = $this->db->get();
				}
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				//$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $row) 
	            {
	                $row1 = array();
					$row1[0] = $slno;
					$row1['sl_no'] = $slno;
					$row1[1] = $row['program_group']; 
					$row1['program_group'] = $row['program_group'];
					$row1[2] = $row['progcode']; 
					$row1['progcode'] = $row['progcode'];
					$row1[3] = $row['program_name']; 
					$row1['program_name'] = $row['program_name'];
					$row1[4] = $row['YEAR'];
					$row1['year'] = $row['YEAR'];
					$row1[5] = $row['sl_no'];
					$row1['order'] = $row['sl_no'];
					$file_name = $row['file_name'];
					$view_file = explode(".", $file_name);
					$file_name = "view_".$file_name;
					$row1[6] = $file_name;
					$row1['file_name'] = $file_name;
					$row1['file_name'] = $file_name;
					$row1[7] = $row['program_start_date'];
					$row1['program_start_date'] = $row['program_start_date'];
					$row1[8] = $row['program_end_date'];
					$row1['program_end_date'] = $row['program_end_date'];
					if($row['publish_status'] == 'YES')
					{
						$row1[9] = "ACTIVE";
					    $row1['publish_status'] = "ACTIVE";
					}
					else if($row['publish_status'] == 'NO')
					{
						$row1[9] = "INACTIVE";
					    $row1['publish_status'] = "INACTIVE";
					}
					$row1[10] = $row['online_payment_transaction_no'];
					$row1['online_payment_transaction_no'] = $row['online_payment_transaction_no'];
					$row1[11] = $row['omr_no'];
					$row1['omr_no'] = $row['omr_no'];
					$row1[12] = "From ".date('d-m-Y', strtotime($row['program_start_date']))."<br/> To ".date('d-m-Y', strtotime($row['program_end_date']));
					$row1['program_date'] = "From ".date('d-m-Y', strtotime($row['program_start_date']))."<br/> To ".date('d-m-Y', strtotime($row['program_end_date']));
					$row1[13] = $row['apply_start_date'];
					$row1['apply_start_date'] = $row['apply_start_date'];
					$row1[14] = $row['apply_end_date'];
					$row1['apply_end_date'] = $row['apply_end_date'];
					$row1[15] = "From ".$row['apply_start_date']."<br/> To ".$row['apply_end_date'];
					$row1['apply_date'] = "From ".$row['apply_start_date']."<br/> To ".$row['apply_end_date'];
					$row1[16] = $row['program_code'];
					$row1['program_code'] = $row['program_code'];
					$row1[17] = $row['template_code'];
					$row1['template_code'] = $row['template_code'];
					$row1[18] = $row['program_group'];
					$row1['program_group'] = $row['program_group'];
					$row1[19] = $row['elective_subjects'];
					$row1['elective_subjects'] = $row['elective_subjects'];
					$row1[20] = $row['sequence_code'];
					$row1['sequence_code'] = $row['sequence_code'];
					$row1[21] = $row['sequence_no'];
					$row1['sequence_no'] = $row['sequence_no'];
					$row1[22] = $row['birth_start_date'];
					$row1['birth_start_date'] = $row['birth_start_date'];
					$row1[23] = $row['birth_end_date'];
					$row1['birth_end_date'] = $row['birth_end_date'];
					$row1[26] = $row['status'];
					$row1['status'] = $row['status'];
					$row1[24] = $row['reg_template_code'];
					$row1['reg_template_code'] = $row['reg_template_code'];
					$reg_file_name = $row['reg_file_name'];
					if($reg_file_name != ''){
						$view_reg_file = explode(".", $reg_file_name);
						$reg_file_name = $view_reg_file[0]; // piece1
						$reg_file_name = "view-".$reg_file_name.".".$view_reg_file[1];
						$row1[25] = $reg_file_name;
					}
					else{
						$row1[25] = $reg_file_name;
					}
					$row1['file_name'] = $reg_file_name;
					$output['aaData'][] = $row1;
	                $slno++;
	                unset($row1);
	            }
	          	//$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output;
			break;
			
			case 'count_inactive_cat_data':
				$dbstatus = TRUE;
				$dbmessage = "Updated Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
        		$logged_user = $this->session->userdata('user_name');
        		$template = $_POST['template_code'];
        		
				$this->db->select('template_code,file_name');
                $this->db->from('form_template_master');	
                $this->db->where('template_code',$template);
                $this->db->where('record_status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $aRow) 
	            {
					$file_name = $aRow['file_name'];
					$view_file_opt = explode("/", $file_name);
					$file_name = $view_file_opt[1]; // piece1
					$view_file = explode(".", $file_name);
					$file_name = $view_file_opt[0]."/view_".$file_name;
					$output['aaData'][] = $file_name;
	            }
		        return $output;
			break;
			
			
			case 'archievedata': 
			 
				$dbstatus = "SUCCESS";
            	$dbmessage = 'Data saved successfully';
            	$dbError = '';
            	$logged_user_code = '';
            	$menuInsert = '';
            	
            	$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
				$logged_user = $this->session->userdata('user_name');
				
				$program = $_REQUEST['program_code'];
				$program_code = $program.'_'.$institute_code;
				//$op_type = 'archievedata';
				if($program != '')
				{
					$this->db->select('id, program_group, program_name, program_code, compulsory_subjects,
					 elective_subjects, year,sl_no, program_start_date, program_end_date, 
					apply_start_date, apply_end_date, status, created_by, created_on, 
					updated_by, updated_on, online_payment_transaction_no, omr_no, publish_status, 
					institute_code, template_code, record_status');
	                $this->db->from('counselling_program_master');	
	                $this->db->where('program_code',$program_code);
	                $this->db->where('record_status','1');
					$result = $this->db->get();
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					foreach ($output_data as $aRow) 
		            {
						$output = array();
						$new_data = array(
						'id' 						=>$aRow['id'],
						'program_group' 			=>$aRow['program_group'],
						'program_name' 				=>$aRow['program_name'],
						'program_code' 				=>$aRow['program_code'],
						'compulsory_subjects' 		=>$aRow['compulsory_subjects'],
						'elective_subjects' 		=>$aRow['elective_subjects'],
						'year' 						=>$aRow['year'],
						'sl_no' 					=>$aRow['sl_no'],
						'program_start_date' 		=>$aRow['program_start_date'],
						'program_end_date' 			=>$aRow['program_end_date'],
						'apply_start_date' 			=>$aRow['apply_start_date'],
						'apply_end_date' 			=>$aRow['apply_end_date'],
						'status' 					=>$aRow['status'],
						'created_by' 				=>$aRow['created_by'],
						'created_on' 				=>$aRow['created_on'],
						'updated_by' 				=>$aRow['updated_by'],
						'updated_on' 				=>$aRow['updated_on'],
						'online_payment_transaction_no' 	=>$aRow['online_payment_transaction_no'],
						'omr_no'                    =>$aRow['omr_no'],
						'publish_status' 			=>$aRow['publish_status'],
						'institute_code' 			=>$aRow['institute_code'],
						'template_code' 			=>$aRow['template_code'],
						'record_status' 			=>$aRow['record_status'],
						);
						$insert_user =  $this->db->insert('counselling_program_master', $new_data);
						if( ! $insert_user)
						{
							$dbStatus = "ERROR";
							$dbMessage = "Error Inserting";
							$dbError = mysqli_error($con);	
						}
						else
						{	 
							//$program_menu_query
							$this->db->select('id,program_code, menu_code, sl_no, record_status, show_status, 
								file_path, file_name,institute_code, created_by, created_on, 
								updated_by,updated_on');
			                $this->db->from('program_menu_setup');	
			                $this->db->where('program_code',$program_code);
			                $this->db->where('record_status','1');
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'program_code' 				=>$aRow['program_code'],
								'menu_code' 		=>$aRow['menu_code'],
								'show_status' 		=>$aRow['show_status'],
								'sl_no' 					=>$aRow['sl_no'],
								'file_path' 		=>$aRow['file_path'],
								'file_name' 			=>$aRow['file_name'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'institute_code' 			=>$aRow['institute_code'],
								'record_status' 			=>$aRow['record_status'],
								);
								$program_menu_query =  $this->db->insert('program_menu_setup', $new_data);
								if( ! $program_menu_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							//$program_category_query
							$this->db->select('id,program_code, category_code, record_status, 
								institute_code, created_by, created_on, 
								updated_by,updated_on');
			                $this->db->from('program_category_setup');	
			                $this->db->where('program_code',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'program_code' 				=>$aRow['program_code'],
								'category_code' 		=>$aRow['category_code'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'institute_code' 			=>$aRow['institute_code'],
								'record_status' 			=>$aRow['record_status'],
								);
								$program_category_query =  $this->db->insert('program_category_setup', $new_data);
								if( ! $program_category_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							
							//$program_fee_query
							$this->db->select('id,program_code, category_code,amount, record_status, 
								institute_code, created_by, created_on, 
								updated_by,updated_on');
			                $this->db->from('program_fee_setup');	
			                $this->db->where('program_code',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'program_code' 				=>$aRow['program_code'],
								'category_code' 		=>$aRow['category_code'],
								'amount' 				=>$aRow['amount'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'institute_code' 			=>$aRow['institute_code'],
								'record_status' 			=>$aRow['record_status'],
								);
								$program_fee_query =  $this->db->insert('program_fee_setup', $new_data);
								if( ! $program_fee_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							
							//$program_document_query
							$this->db->select('id,program_code, document_type_code, record_status,sl_no,
								institute_code, created_by, created_on, 
								updated_by,updated_on');
			                $this->db->from('program_document_setup');	
			                $this->db->where('program_code',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'program_code' 				=>$aRow['program_code'],
								'document_type_code' 		=>$aRow['document_type_code'],
								'sl_no' 				=>$aRow['sl_no'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'institute_code' 			=>$aRow['institute_code'],
								'record_status' 			=>$aRow['record_status'],
								);
								$program_document_query =  $this->db->insert('program_document_setup', $new_data);
								if( ! $program_document_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							//$program_eligibility_query
							$this->db->select('id,birth_start_date, birth_end_date,program_code, record_status,sl_no,
											 created_by, created_on, 
											updated_by,updated_on');
			                $this->db->from('program_eligibility_setup');	
			                $this->db->where('program_code',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'program_code' 				=>$aRow['program_code'],
								'birth_start_date' 		=>$aRow['birth_start_date'],
								'birth_end_date' 		=>$aRow['birth_end_date'],
								'sl_no' 				=>$aRow['sl_no'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'record_status' 			=>$aRow['record_status'],
								);
								$program_eligibility_query =  $this->db->insert('program_eligibility_setup', $new_data);
								if( ! $program_eligibility_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							//$index_sequence_query
							$this->db->select('id,year, sequence_code,program_code,sequence_no,institute_code, record_status,
											 created_by, created_on, 
											updated_by,updated_on');
			                $this->db->from('index_sequence_setup');	
			                $this->db->where('program_code',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'program_code' 				=>$aRow['program_code'],
								'year' 		=>$aRow['year'],
								'sequence_code' 		=>$aRow['sequence_code'],
								'sequence_no' 				=>$aRow['sequence_no'],
								'institute_code' 				=>$aRow['institute_code'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'record_status' 			=>$aRow['record_status'],
								);
								$index_sequence_query =  $this->db->insert('index_sequence_setup', $new_data);
								if( ! $index_sequence_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							//$qualification_setup_query
							$this->db->select('id,qualification_code,program_code, record_status,
											 created_by, created_on, 
											updated_by,updated_on');
			                $this->db->from('program_qualification_setup');	
			                $this->db->where('program_code',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'program_code' 				=>$aRow['program_code'],
								'qualification_code' 		=>$aRow['qualification_code'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'record_status' 			=>$aRow['record_status'],
								);
								$qualification_setup_query =  $this->db->insert('index_sequence_setup', $new_data);
								if( ! $qualification_setup_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							//$exam_centre_query
							$this->db->select('id,exam_centre_code,exam_centre_name,program_code, record_status,
											 created_by, created_on, 
											updated_by,updated_on');
			                $this->db->from('exam_centre_master');	
			                $this->db->where('program_code',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'program_code' 				=>$aRow['program_code'],
								'exam_centre_code' 		=>$aRow['exam_centre_code'],
								'exam_centre_name' 		=>$aRow['exam_centre_name'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'record_status' 			=>$aRow['record_status'],
								);
								$exam_centre_query =  $this->db->insert('exam_centre_master', $new_data);
								if( ! $exam_centre_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							//$program_sms_query
							$this->db->select('id,sms_type,institute_code,program_code, record_status,
											 created_by, created_on, 
											updated_by,updated_on');
			                $this->db->from('program_sms_setup');	
			                $this->db->where('program_code',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'program_code' 				=>$aRow['program_code'],
								'sms_type' 		=>$aRow['sms_type'],
								'institute_code' 		=>$aRow['institute_code'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'record_status' 			=>$aRow['record_status'],
								);
								$program_sms_query =  $this->db->insert('program_sms_setup', $new_data);
								if( ! $program_sms_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							//$program_email_query
							$this->db->select('id,email_type,institute_code,program_code, record_status,
											 created_by, created_on, 
											updated_by,updated_on');
			                $this->db->from('program_email_setup');	
			                $this->db->where('program_code',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'program_code' 				=>$aRow['program_code'],
								'email_type' 		=>$aRow['sms_type'],
								'institute_code' 		=>$aRow['institute_code'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'record_status' 			=>$aRow['record_status'],
								);
								$program_email_query =  $this->db->insert('program_email_setup', $new_data);
								if( ! $program_email_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							//$challan_detail_query
							$this->db->select('id,challan_code,bank_code,bank_name,branch_name,account_no,transaction_charge
											institute_code,program_code, status,
											 created_by, created_on, 
											updated_by,updated_on');
			                $this->db->from('challan_detail');	
			                $this->db->where('program_code',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'program_code' 				=>$aRow['program_code'],
								'challan_code' 		=>$aRow['challan_code'],
								'bank_code' 		=>$aRow['bank_code'],
								'bank_name' 		=>$aRow['bank_name'],
								'branch_name' 		=>$aRow['branch_name'],
								'account_no' 		=>$aRow['account_no'],
								'transaction_charge' 		=>$aRow['transaction_charge'],
								'institute_code' 		=>$aRow['institute_code'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'status' 			=>$aRow['status'],
								);
								$challan_detail_query =  $this->db->insert('challan_detail', $new_data);
								if( ! $challan_detail_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							//$online_transaction_charge_setup_query
							$this->db->select('id,transaction_charge,institute_code,program_code, status,
											created_by, created_on, modified_by,modified_on');
			                $this->db->from('counselling_online_transaction_charge_setup ');	
			                $this->db->where('program_code',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'program_code' 				=>$aRow['program_code'],
								'modified_by' 		=>$aRow['modified_by'],
								'modified_on' 		=>$aRow['modified_on'],
								'transaction_charge' 		=>$aRow['transaction_charge'],
								'institute_code' 		=>$aRow['institute_code'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'status' 			=>$aRow['status'],
								);
								$online_transaction_charge_setup_query =  $this->db->insert('counselling_online_transaction_charge_setup ', $new_data);
								if( ! $online_transaction_charge_setup_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							//$user_program_mapping
							$this->db->select('user_program_mapping_id,user_code,institute_code,program_code, record_status,
											created_by, created_on, updated_by,updated_on');
			                $this->db->from('user_program_mapping');	
			                $this->db->where('program_code',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'user_program_mapping_id' 		=>$aRow['user_program_mapping_id'],
								'program_code' 				=>$aRow['program_code'],
								'modified_by' 		=>$aRow['modified_by'],
								'modified_on' 		=>$aRow['modified_on'],
								'user_code' 		=>$aRow['user_code'],
								'institute_code' 		=>$aRow['institute_code'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'record_status' 			=>$aRow['record_status'],
								);
								$user_program_mapping =  $this->db->insert('user_program_mapping', $new_data);
								if( ! $user_program_mapping)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							//$admit_card_setup_query
							$this->db->select('id,exam_center_code,exam_vanue_code,exam_vanue,capacity,
											exam_center_address,admit_card_available_from,admit_card_available_upto,
											exam_schedule,exam_instructions,controller_signature,program_code, record_status,
											created_by, created_on, updated_by,updated_on');
			                $this->db->from('admitcard_setup');	
			                $this->db->where('program_code',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'exam_center_code' 				=>$aRow['exam_center_code'],
								'exam_vanue_code' 				=>$aRow['exam_vanue_code'],
								'exam_vanue' 				=>$aRow['exam_vanue'],
								'capacity' 				=>$aRow['capacity'],
								'exam_center_address' 		=>$aRow['exam_center_address'],
								'admit_card_available_from' 		=>$aRow['admit_card_available_from'],
								'admit_card_available_upto' 		=>$aRow['admit_card_available_upto'],
								'exam_schedule' 		=>$aRow['exam_schedule'],
								'exam_instructions' 		=>$aRow['exam_instructions'],
								'controller_signature' 		=>$aRow['controller_signature'],
								'program_code' 		=>$aRow['program_code'],
								'institute_code' 		=>$aRow['institute_code'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'record_status' 			=>$aRow['record_status'],
								);
								$admit_card_setup_query =  $this->db->insert('admitcard_setup', $new_data);
								if( ! $admit_card_setup_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							//applicant_reg_master
							$this->db->select('id,reg_user_id,first_name,mid_name,last_name,dob,
											communication_flag,email_id,mobile,pin,applied_program,applied_date,reg_mode,
											scrutiny_status,scrutiny_remark,reg_status,institute_code,status,
											created_by, created_on, updated_by,updated_on');
			                $this->db->from('applicant_reg_master');	
			                $this->db->where('applied_program',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'reg_user_id' 				=>$aRow['reg_user_id'],
								'first_name' 				=>$aRow['first_name'],
								'mid_name' 					=>$aRow['mid_name'],
								'last_name' 				=>$aRow['last_name'],
								'dob' 						=>$aRow['dob'],
								'communication_flag' 		=>$aRow['communication_flag'],
								'email_id' 					=>$aRow['email_id'],
								'mobile' 					=>$aRow['mobile'],
								'pin' 						=>$aRow['pin'],
								'applied_program' 			=>$aRow['applied_program'],
								'applied_date' 				=>$aRow['applied_date'],
								'reg_mode' 					=>$aRow['reg_mode'],
								'scrutiny_status' 			=>$aRow['scrutiny_status'],
								'scrutiny_remark' 			=>$aRow['scrutiny_remark'],
								'reg_status' 			=>$aRow['reg_status'],
								'status' 					=>$aRow['status'],
								'institute_code' 			=>$aRow['institute_code'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								);
								$applicant_reg_master =  $this->db->insert('applicant_reg_master', $new_data);
								if( ! $applicant_reg_master)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							//$applicant_master_query
							$this->db->select('id,reg_user_id,first_name,mid_name,last_name,full_name,applied_class,exam_center_code,dob,
											gender,nationality,dob_in_word,blood_group,caste,second_language,univ_regn_no,is_reserved_quota,
											mode_of_transport,category,is_alumnus,alumnus_name,alumnus_year_of_passing,is_staff,staff_name,
											is_general,are_parents_alive,is_physically_challanged,is_minority_community,minority_community_details,
											is_transfer,is_single_child,single_girl_child_flag,if_chronic_illness,chronic_illness,if_allergies,
											allergies,is_school_attended,last_school,last_grade,last_board,subjects_offered,is_adhar_available,
											adhar_no,present_status,employer_address,comm_address_ref_id, 
											perm_address_ref_id, institute_code, created_by, 
											created_on, updated_by, updated_on, status, religion, 
											applicant_email, admission_reason, session_last_attended, 
											applicant_landline, applicant_mobile, entrance_exam_appeared,
											highest_qualification, secured_mark, mother_tongue, source_about_institute, 
											guardian_name, hostel_facility, marital_status');
			                $this->db->from('applicant_master');	
			                $this->db->where('applied_program',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'reg_user_id' 				=>$aRow['reg_user_id'],
								'first_name' 				=>$aRow['first_name'],
								'mid_name' 					=>$aRow['mid_name'],
								'last_name' 				=>$aRow['last_name'],
								'full_name' 				=>$aRow['full_name'],
								'applied_class' 				=>$aRow['applied_class'],
								'exam_center_code' 				=>$aRow['exam_center_code'],
								'dob' 				=>$aRow['dob'],
								'gender' 				=>$aRow['gender'],
								'nationality' 				=>$aRow['nationality'],
								'dob_in_word' 				=>$aRow['dob_in_word'],
								'blood_group' 				=>$aRow['blood_group'],
								'caste' 				=>$aRow['caste'],
								'second_language' 				=>$aRow['second_language'],
								'univ_regn_no' 				=>$aRow['univ_regn_no'],
								'is_reserved_quota' 				=>$aRow['is_reserved_quota'],
								'mode_of_transport' 				=>$aRow['mode_of_transport'],
								'category' 				=>$aRow['category'],
								'is_alumnus' 				=>$aRow['is_alumnus'],
								'alumnus_name' 				=>$aRow['alumnus_name'],
								'alumnus_year_of_passing' 				=>$aRow['alumnus_year_of_passing'],
								'is_staff' 				=>$aRow['is_staff'],
								'staff_name' 				=>$aRow['staff_name'],
								'is_transfer' 				=>$aRow['is_transfer'],
								'is_single_child' 				=>$aRow['is_single_child'],
								'single_girl_child_flag' 				=>$aRow['single_girl_child_flag'],
								'if_chronic_illness' 				=>$aRow['if_chronic_illness'],
								'chronic_illness' 				=>$aRow['chronic_illness'],
								'if_allergies' 				=>$aRow['if_allergies'],
								'allergies' 				=>$aRow['allergies'],
								'is_school_attended' 				=>$aRow['is_school_attended'],
								'last_school' 				=>$aRow['last_school'],
								'last_grade' 				=>$aRow['last_grade'],
								'last_board' 				=>$aRow['last_board'],
								'subjects_offered' 				=>$aRow['subjects_offered'],
								'is_adhar_available' 				=>$aRow['is_adhar_available'],
								'adhar_no' 				=>$aRow['adhar_no'],
								'present_status' 				=>$aRow['present_status'],
								'employer_address' 				=>$aRow['employer_address'],
								'comm_address_ref_id' 				=>$aRow['comm_address_ref_id'],
								'perm_address_ref_id' 				=>$aRow['perm_address_ref_id'],
								'institute_code' 			=>$aRow['institute_code'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'status' 				=>$aRow['status'],
								'religion' 				=>$aRow['religion'],
								'applicant_email' 				=>$aRow['applicant_email'],
								'admission_reason' 				=>$aRow['admission_reason'],
								'session_last_attended' 				=>$aRow['session_last_attended'],
								'applicant_landline' 				=>$aRow['applicant_landline'],
								'applicant_mobile' 				=>$aRow['applicant_mobile'],
								'entrance_exam_appeared' 				=>$aRow['entrance_exam_appeared'],
								'highest_qualification' 				=>$aRow['highest_qualification'],
								'secured_mark' 				=>$aRow['secured_mark'],
								'mother_tongue' 				=>$aRow['mother_tongue'],
								'source_about_institute' 				=>$aRow['source_about_institute'],
								'guardian_name' 				=>$aRow['guardian_name'],
								'hostel_facility' 				=>$aRow['hostel_facility'],
								'marital_status' 				=>$aRow['marital_status'],
								);
								$applicant_master_query =  $this->db->insert('applicant_master', $new_data);
								if( ! $applicant_master_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							//$applicant_relation_query
							$this->db->select('id,reg_user_id,applicant_rel_flag,applied_program, 
												rel_name, rel_qualification, rel_occupation, rel_desig, 
												rel_adhar_no, nature_of_work, annual_income, place_work, 
												email_id, res_no, mobile_no, institute_code, 
												created_by, created_on, updated_by, updated_on, status');
			                $this->db->from('applicant_relation');	
			                $this->db->where('applied_program',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'reg_user_id' 				=>$aRow['reg_user_id'],
								'applicant_rel_flag' 				=>$aRow['applicant_rel_flag'],
								'applied_program' 				=>$aRow['applied_program'],
								'rel_name' 				=>$aRow['rel_name'],
								'rel_qualification' 		=>$aRow['rel_qualification'],
								'rel_occupation' 		=>$aRow['rel_occupation'],
								'rel_desig' 		=>$aRow['rel_desig'],
								'rel_adhar_no' 		=>$aRow['rel_adhar_no'],
								'nature_of_work' 		=>$aRow['nature_of_work'],
								'annual_income' 		=>$aRow['annual_income'],
								'place_work' 		=>$aRow['place_work'],
								'email_id' 		=>$aRow['email_id'],
								'res_no' 		=>$aRow['res_no'],
								'mobile_no' 		=>$aRow['mobile_no'],
								'institute_code' 		=>$aRow['institute_code'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'status' 			=>$aRow['status'],
								);
								$applicant_relation_query =  $this->db->insert('applicant_relation', $new_data);
								if( ! $applicant_relation_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							//$applicant_relation_query
							$this->db->select('id, reg_user_id, applied_program, applied_class, qual_desc_1, 
												qual_desc_2, year_of_passing, institute_name, university_board, 
												grade_mark_flag, percentage_mark, grade, math_grade, math_mark,
												institute_code, created_by, created_on, updated_by, updated_on, 
												status, division_distinction, subjects_offered, mark_secured, full_mark');
			                $this->db->from('applicant_qualification_detail');	
			                $this->db->where('applied_program',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'reg_user_id' 				=>$aRow['reg_user_id'],
								'applied_class' 				=>$aRow['applied_class'],
								'applied_program' 				=>$aRow['applied_program'],
								'qual_desc_1' 				=>$aRow['qual_desc_1'],
								'qual_desc_2' 		=>$aRow['qual_desc_2'],
								'year_of_passing' 		=>$aRow['year_of_passing'],
								'institute_name' 		=>$aRow['institute_name'],
								'university_board' 		=>$aRow['university_board'],
								'grade_mark_flag' 		=>$aRow['grade_mark_flag'],
								'percentage_mark' 		=>$aRow['percentage_mark'],
								'grade' 		=>$aRow['grade'],
								'math_grade' 		=>$aRow['math_grade'],
								'math_mark' 		=>$aRow['math_mark'],
								'mobile_no' 		=>$aRow['mobile_no'],
								'institute_code' 		=>$aRow['institute_code'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'status' 			=>$aRow['status'],
								'division_distinction' 			=>$aRow['division_distinction'],
								'subjects_offered' 			=>$aRow['subjects_offered'],
								'mark_secured' 			=>$aRow['mark_secured'],
								'full_mark' 			=>$aRow['full_mark'],
								);
								$applicant_relation_query =  $this->db->insert('applicant_qualification_detail', $new_data);
								if( ! $applicant_relation_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							//$applicant_other_info_query
							$this->db->select('id, table_name, field_name, reg_user_id,applied_program,field_value,institute_code, 
												created_by, created_on, updated_by,updated_on,status');
			                $this->db->from('applicant_other_info');	
			                $this->db->where('applied_program',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'table_name' 				=>$aRow['table_name'],
								'field_name' 				=>$aRow['field_name'],
								'reg_user_id' 				=>$aRow['reg_user_id'],
								'applied_program' 				=>$aRow['applied_program'],
								'field_value' 		=>$aRow['field_value'],
								'institute_code' 		=>$aRow['institute_code'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'status' 			=>$aRow['status'],
								);
								$applicant_other_info =  $this->db->insert('applicant_other_info', $new_data);
								if( ! $applicant_other_info)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							
							//applicant_declaration
							$this->db->select('id,reg_user_id,applied_program,declaration_flag, 
													declaration_sl_no,declaration_remark, institute_code, 
													created_by,created_on,updated_by,updated_on,status');
			                $this->db->from('applicant_declaration');	
			                $this->db->where('applied_program',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'declaration_flag' 				=>$aRow['declaration_flag'],
								'declaration_sl_no' 				=>$aRow['declaration_sl_no'],
								'reg_user_id' 				=>$aRow['reg_user_id'],
								'applied_program' 				=>$aRow['applied_program'],
								'declaration_remark' 		=>$aRow['declaration_remark'],
								'institute_code' 		=>$aRow['institute_code'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'status' 			=>$aRow['status'],
								);
								$applicant_declaration =  $this->db->insert('applicant_declaration', $new_data);
								if( ! $applicant_declaration)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							
							//$applicant_tech_qualification_query
							$this->db->select('id,reg_user_id,applied_program,qual_desc_1,institute_name,year, affiliation_from,
												subjects_offered, duration, grade_cgpa, division,remark,created_by,
												created_on, updated_by, updated_on, record_status, sl_no');
			                $this->db->from('applicant_technical_qualification_detail');	
			                $this->db->where('applied_program',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'qual_desc_1' 				=>$aRow['qual_desc_1'],
								'institute_name' 			=>$aRow['institute_name'],
								'reg_user_id' 				=>$aRow['reg_user_id'],
								'applied_program' 			=>$aRow['applied_program'],
								'year' 						=>$aRow['year'],
								'affiliation_from' 			=>$aRow['affiliation_from'],
								'subjects_offered' 			=>$aRow['subjects_offered'],
								'duration' 					=>$aRow['duration'],
								'grade_cgpa' 				=>$aRow['grade_cgpa'],
								'division' 					=>$aRow['division'],
								'remark' 					=>$aRow['remark'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'record_status' 			=>$aRow['record_status'],
								'sl_no' 			=>$aRow['sl_no'],
								);
								$applicant_tech_qualification_query =  $this->db->insert('applicant_technical_qualification_detail', $new_data);
								if( ! $applicant_tech_qualification_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							
							//$applicant_total_experience_query
							$this->db->select('id,reg_user_id,applied_program,total_experience_1, total_experience_2,
												total_experience_3,created_by,created_on,updated_by,
												updated_on,record_status');
			                $this->db->from('applicant_total_experience');	
			                $this->db->where('applied_program',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'total_experience_1' 				=>$aRow['total_experience_1'],
								'total_experience_2' 			=>$aRow['total_experience_2'],
								'reg_user_id' 				=>$aRow['reg_user_id'],
								'applied_program' 			=>$aRow['applied_program'],
								'total_experience_3' 						=>$aRow['total_experience_3'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'record_status' 			=>$aRow['record_status'],
								'sl_no' 			=>$aRow['sl_no'],
								);
								$applicant_total_experience_query =  $this->db->insert('applicant_total_experience', $new_data);
								if( ! $applicant_total_experience_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							
							//$applicant_prev_appl_query
							$this->db->select('id,reg_user_id,applied_program,post_applied, institute_details,interview_appear_status,
												 selection_status, sl_no,created_by,created_on, updated_by, updated_on, record_status');
			                $this->db->from('applicant_previous_application');	
			                $this->db->where('applied_program',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'post_applied' 				=>$aRow['post_applied'],
								'institute_details' 			=>$aRow['institute_details'],
								'reg_user_id' 				=>$aRow['reg_user_id'],
								'applied_program' 			=>$aRow['applied_program'],
								'interview_appear_status' 						=>$aRow['interview_appear_status'],
								'selection_status' 				=>$aRow['selection_status'],
								'sl_no' 				=>$aRow['sl_no'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'record_status' 			=>$aRow['record_status'],
								);
								$applicant_prev_appl_query =  $this->db->insert('applicant_previous_application', $new_data);
								if( ! $applicant_prev_appl_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
							
							//$applicant_prev_appl_query
							$this->db->select('id,reg_user_id,applied_program,post_applied, institute_details,interview_appear_status,
												 selection_status, sl_no,created_by,created_on, updated_by, updated_on, record_status');
			                $this->db->from('applicant_previous_application');	
			                $this->db->where('applied_program',$program_code);
							$result = $this->db->get();
							$output_data = $result->result_array();
							$output = array("aaData" => array());
							foreach ($output_data as $aRow) 
				            {
								$output = array();
								$new_data = array(
								'id' 						=>$aRow['id'],
								'post_applied' 				=>$aRow['post_applied'],
								'institute_details' 			=>$aRow['institute_details'],
								'reg_user_id' 				=>$aRow['reg_user_id'],
								'applied_program' 			=>$aRow['applied_program'],
								'interview_appear_status' 						=>$aRow['interview_appear_status'],
								'selection_status' 				=>$aRow['selection_status'],
								'sl_no' 				=>$aRow['sl_no'],
								'created_by' 				=>$aRow['created_by'],
								'created_on' 				=>$aRow['created_on'],
								'updated_by' 				=>$aRow['updated_by'],
								'updated_on' 				=>$aRow['updated_on'],
								'record_status' 			=>$aRow['record_status'],
								);
								$applicant_prev_appl_query =  $this->db->insert('applicant_previous_application', $new_data);
								if( ! $applicant_prev_appl_query)
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									$dbError = mysqli_error($con);	
								}
							}
						}	
		            }
				}
			break;
			
			
			
			
			case 'edit_olddata':
				$dbstatus = "SUCCESS";
				$dbmessage = "Updated Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
        		$logged_user = $this->session->userdata('user_name');
        		
				$hidUniqueidEdit = $_POST['hidUniqueidEdit'];
				$txtProgramCodeEdit = $_POST['txtProgramCodeEdit'];
				$txtProgramNameEdit = $_POST['txtProgramNameEdit'];
				$cmbProgramGroupEdit = $_POST['cmbProgramGroupEdit'];
				$taElectiveSubjectsEdit = isset($_POST['taElectiveSubjectsEdit'])?$_POST['taElectiveSubjectsEdit']:'';
				$txtYearEdit = $_POST['txtYearEdit'];
				$txtSlnoEdit = $_POST['txtSlnoEdit'];
				$txtSeqnoEdit = $_POST['txtSeqnoEdit'];
				$txtSeqCodeEdit = $_POST['txtSeqCodeEdit'];
				$txtOnlineTransactionNoEdit = $_POST['txtOnlineTransactionNoEdit'];
				$txtOmrNoEdit = $_POST['txtOmrNoEdit'];
				$cmbStatusEdit = $_POST['cmbStatusEdit'];
				$cmbRegistrationTemplateEdit = $_POST['cmbRegistrationTemplateEdit'];
				$cmbTemplateEdit = $_POST['cmbTemplateEdit'];
				$txtStartdate = $_POST['txtStartdate'];
				$txtAppStartdate = $_POST['txtAppStartdate'];
				$txtEligibledate = $_POST['txtEligibledate'];
				
				if($txtEligibledate != '')
				{
					$arr_eligible_date = $this->split_string($txtEligibledate,'-',3);
					$txtAgeStartdateEdit = trim($arr_eligible_date[0]);
					$txtAgeEnddateEdit = trim($arr_eligible_date[1]);
				}
				else
				{
					$txtAgeStartdateEdit = '';
					$txtAgeEnddateEdit = '';
				}
				$arr_apply_date = $this->split_string($txtAppStartdate,'-',3);
				$arr_program_date = $this->split_string($txtStartdate,'-',3);
				$txtStartdateEdit = trim($arr_program_date[0]);
				$txtEnddateEdit = trim($arr_program_date[1]);
				$txtAppStartdateEdit = trim($arr_apply_date[0]);
				$txtAppEnddateEdit = trim($arr_apply_date[1]);
				
				$program_code = "$txtProgramCodeEdit"."_"."$institute_code";
				$program_code_edit = "$hidUniqueidEdit"."_"."$institute_code";
        		$logged_user_code = "$logged_user"."_"."$institute_code";
			
        		$op_type = 'edit_olddata';
				$data = array( 
						"program_code" 	=>$program_code,
						"program_group" => $cmbProgramGroupEdit,
						"elective_subjects" => $taElectiveSubjectsEdit,
						"program_name" => $txtProgramNameEdit,
						"year" => $txtYearEdit,
						"sl_no" => $txtSlnoEdit,
						"online_payment_transaction_no" => $txtOnlineTransactionNoEdit,
						"omr_no" => $txtOmrNoEdit,
						"status" => $cmbStatusEdit,
						"template_code" => $cmbTemplateEdit,
						"registration_template_code" => $cmbRegistrationTemplateEdit,
						"program_start_date"  =>date('Y-m-d', strtotime($txtStartdateEdit)),
						"program_end_date" =>date('Y-m-d', strtotime($txtEnddateEdit)),
						"apply_start_date" =>date('Y-m-d', strtotime($txtAppStartdateEdit)),
						"apply_end_date" =>date('Y-m-d', strtotime($txtAppEnddateEdit)),
						"updated_by" => $logged_user_code,
						"updated_on" => $date,
					);
				$this->db->where('program_code',$program_code_edit);
				$this->db->where('institute_code',$institute_code);
				$this->db->where('record_status','1');
				$update_user = $this->db->update('counselling_program_master',$data);
				if(! $update_user){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
				
				if($txtAgeStartdateEdit != '' || $txtAgeEnddateEdit )
				{
					$this->db->select('COUNT(program_code) AS program_code');
					$this->db->from('program_eligibility_setup');
					$this->db->where('record_status','1');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
		            	$count = $aRow['program_code'];
		            	if($count>=1)
		            	{
							$data = array( 
							"birth_start_date"  =>date('Y-m-d', strtotime($txtAgeStartdateEdit)),
							"birth_end_date" =>date('Y-m-d', strtotime($txtAgeEnddateEdit)),
							"updated_by" => $logged_user_code,
							"updated_on" => $date,
							);
							$this->db->where('updated_by',$logged_user_code);
							$this->db->where('program_code',$program_code_edit);
							$update_user = $this->db->update('program_eligibility_setup',$data);
							if(! $update_user){
								$dbstatus = FALSE;
								$dbmessage = 'Error While Saving';
							}
						}
						else
						{
							$new_array = array( 
							"program_code"  =>date('Y-m-d', strtotime($txtAgeStartdateEdit)),
							"birth_start_date"  =>date('Y-m-d', strtotime($txtAgeStartdateEdit)),
							"birth_end_date" =>date('Y-m-d', strtotime($txtAgeEnddateEdit)),
							"created_by" => $logged_user_code,
							"created_on" => $date,
							);
							$this->db->insert('program_eligibility_setup',$new_array);
							$this->db->where('program_code',$program_code_edit);
							if(! $insert_user){
								$dbstatus = FALSE;
								$dbmessage = 'Error While Saving';
							}
							
						}
		            }
				}
				
				if($txtSeqCodeEdit != '')
				{
					$data = array( 
						"year"  =>$txtYearEdit,
						"sequence_code"  =>$txtSeqCodeEdit,
						"sequence_no"  =>$txtSeqnoEdit,
						"updated_by" => $logged_user_code,
						"updated_on" => $date,
					);
					$this->db->where('program_code',$program_code);
					$update_user = $this->db->update('index_sequence_setup',$data);
					if(! $update_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Updating';
					}
				}
				if($dbstatus == TRUE)
				{
					$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
					return $output;
				}
				else
				{
					$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
					return $output;
				}
				
            break;
            case 'delete_olddata': 
				$dbstatus = "SUCCESS";
            	$dbmessage = 'Data deleted successfully';
            	$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$output = array();
				$id = $_POST['programCode'];
				$code = $id."_".$institute_code;
				$this->db->where('program_code', $code);
				$delete = $this->db->delete('counselling_program_master'); 
				if(! $delete){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output; 
			break;
			
			case 'SELECT_ALL_MENU_data' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("pmm.link_text,pmm.menu_code,pmm.menu_code AS menu,
					CONCAT(pmm.is_document_upload,'-',pmm.menu_code) AS is_document_upload,
					CONCAT(pmm.is_document_upload,'-',pmm.menu_code) AS is_document_upload1");
				$this->db->from('program_menu_master pmm');
				$this->db->join('program_menu_setup as pms','pmm.menu_code = pms.menu_code','left');
				$this->db->where('pms.record_status','Active');
				$this->db->where('pmm.record_status','Active');
				$this->db->group_by('pmm.menu_code');
				$this->db->order_by('pmm.prog_sl_no');
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'SELECT_MENU_data' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$program = $_POST['program'];
				$this->db->select('A.link_text,
						CASE WHEN B.sl_no IS NULL THEN CONCAT("-",A.menu_code) ELSE sl_no END AS sl_no,
						CASE WHEN B.show_status IS NULL THEN CONCAT(0,"-",A.menu_code) ELSE show_status END AS show_status,
						A.is_document_upload,
						CASE WHEN B.file_path IS NULL THEN CONCAT(A.is_document_upload1,"`") 
						ELSE CONCAT(A.is_document_upload1,"`",B.file_path) END AS is_document_upload1');
				$this->db->from('(SELECT pmm.menu_code,pmm.link_text,
					CONCAT(pmm.is_document_upload,"-",pmm.menu_code) AS is_document_upload,
					CONCAT(pmm.is_document_upload,"`",pmm.menu_code) AS is_document_upload1
					FROM program_menu_master pmm
					ORDER BY pmm.prog_sl_no) A');
				$this->db->join('(SELECT pmm.menu_code,CONCAT(pms.sl_no,"-",pmm.menu_code) AS sl_no,pms.file_name,
					CONCAT(pms.show_status,"-",pmm.menu_code) AS show_status,
					CONCAT(pmm.is_document_upload,"-",pmm.menu_code) AS is_document_upload,
					CONCAT(pmm.is_document_upload,"`",pmm.menu_code) AS is_document_upload1,
					pms.file_path
					FROM program_menu_master pmm
					LEFT JOIN program_menu_setup pms ON pmm.menu_code = pms.menu_code
					AND pms.program_code = "'.$program.'" AND pms.institute_code = "'.$institute_code.'"
					ORDER BY pmm.prog_sl_no) B','A.menu_code = B.menu_code','left');
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
			break;
			
			case 'UPDATE_MULTIPLE_data':
				$dbStatus = "SUCCESS";
				$dbMessage = "Updated Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
        		$logged_user = $this->session->userdata('user_name');
        		
				$errorArray = array();
				$temporary_file_list = array();
				$document = $_POST['hidDocumentCodeAssign']?$_POST['hidDocumentCodeAssign']:array();
				$document_upload_status = $_POST['hidDocumentStatusAssign']?$_POST['hidDocumentStatusAssign']:array();
				$success_count = 0;
				$error_count = 0;
				$arr_program_code = array();
				$arr_menu_code = array();
				$arr_sl_no = array();
				$arr_show_status = array();
				$program_codes = $_POST['cmbProgramSelect'];
				$show_status = $_POST['chkShow']?$_POST['chkShow']:array();
				$sl_nos = $_POST['txtSeqNo']?$_POST['txtSeqNo']:array();
        		$logged_user_code = "$logged_user"."_"."$institute_code";
        		$op_type = 'UPDATE_MULTIPLE_data';
        		for($i=0;$i < sizeof($program_codes);$i++)
				{
					$uploaddir = "../DOCUMENTS/".$program_codes[$i];
					if(!is_dir($uploaddir))
						mkdir($uploaddir,0777,true);
					$data = array( 
						"sl_no" => 'NULL',
						"show_status" => '0',
					);
					$this->db->where('program_code',$program_codes[$i]);
					$update_user = $this->db->update('program_menu_setup',$data);
					if($update_user){
						$dbStatus = "SUCCESS";
						$dbMessage = "Data successfully saved";
					}
					else
					{
						$dbStatus = "ERROR";
						$dbMessage = mysqli_error($con);
					}
					$this->db->select('COUNT(program_code) AS program_code');
					$this->db->from('program_menu_setup');
					$this->db->where('program_code',$program_codes[$i]);
					$this->db->where('record_status','Active');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
		            	$count = $aRow['program_code'];
		            }
		            //echo $this->db->last_query();
					for($k = 0; $k < sizeof($document);$k++)
					{
						if(in_array($document[$k],$show_status))
						{
							if($document_upload_status[$k] == "Yes")
							{
								if(isset($_FILES['file'.$document[$k]]) && $_FILES['file'.$document[$k]]['name'] != '')
								{
									$uploaded_DocFile = explode(".",$_FILES['file'.$document[$k]]['name']);
									$ext = end($uploaded_DocFile);
									$renameDocument = $document[$k].'.'.$ext;
									$temp_file = $_FILES['file'.$document[$k]]['tmp_name'];
									$docfilepath = "$uploaddir/$renameDocument";
									$temporary_file_list[$document[$k]] = $temp_file;
									if(copy($temp_file, "$uploaddir/$renameDocument"))
									{
										
						            	if($count >= 1)
						            	{
											$data = array( 
												"sl_no"  =>$sl_nos[$k],
												"show_status" =>'1',
												"file_path" => $docfilepath,
												"updated_by" => $logged_user_code,
												"updated_on" => $date,
											);
											$this->db->where('program_code',$program_codes[$i]);
											$this->db->where('menu_code',$document[$k]);
											$update_user = $this->db->update('program_menu_setup',$data);
											if(! $update_user){
												$dbstatus = FALSE;
												$dbMessage = 'Error While Saving';
											}
											else
											{
												$success_count++;
											}
										}
										else
										{
											$new_array = array( 
												"program_code"  =>$program_codes[$i],
												"menu_code"  =>$document[$k],
												"sl_no" =>$sl_nos[$k],
												"record_status" =>'Active',
												"file_path" =>$docfilepath,
												"file_name" =>$renameDocument,
												"institute_code" =>$institute_code,
												"created_by" => $logged_user_code,
												"created_on" => $date,
												"show_status"=> '1',
											);
											$insert_user = $this->db->insert('program_menu_setup',$new_array);
											if($insert_user){
												$dbStatus = "SUCCESS";
												$dbMessage = "Data successfully saved";
												$success_count++;
											}
											else
											{	
												$dbStatus = "ERROR";
												$dbMessage = mysqli_error($con);
												$error_count++;
												$errorArray[] = $document[$i];
												
											}
											
										}
									}
									else
									{
										$dbStatus = "ERROR";
										$dbMessage = "Error in document upload";
									}
								}
								else
								{
					            	if($count>=1)
					            	{
										$data = array( 
										"sl_no"  =>$sl_nos[$k],
										"show_status" =>'1',
										"updated_by" => $logged_user_code,
										"updated_on" => $date,
										);
										$this->db->where('program_code',$program_codes[$i]);
										$this->db->where('menu_code',$document[$k]);
										$update_user = $this->db->update('program_menu_setup',$data);
										if(! $update_user){
											$dbstatus = FALSE;
											$dbMessage = 'Error While Saving';
										}
										else
										{
											$success_count++;
										}
									}
									else
									{
										$new_array = array( 
											"program_code"  =>$program_codes[$i],
											"menu_code"  =>$document[$k],
											"sl_no" =>$sl_nos[$k],
											"record_status" =>'Active',
											"institute_code" =>$institute_code,
											"created_by" => $logged_user_code,
											"created_on" => $date,
											"show_status"=> '1'
										);
										$insert_user = $this->db->insert('program_menu_setup',$new_array);
										if($insert_user){
											$dbStatus = "SUCCESS";
											$dbMessage = "Data successfully saved";
											$success_count++;
										}
										else
										{	
											$dbStatus = "ERROR";
											$dbMessage = mysqli_error($con);
											$error_count++;
											$errorArray[] = $document[$i];
										}
										
									}
								}
							}
							else
							{
								
				            	if($count>=1)
				            	{
									$data = array( 
										"sl_no"  =>$sl_nos[$k],
										"show_status" =>'1',
										"updated_by" => $logged_user_code,
										"updated_on" => $date
									);
									$this->db->where('program_code',$program_codes[$i]);
									$this->db->where('menu_code',$document[$k]);
									$update_user = $this->db->update('program_menu_setup',$data);
									if(! $update_user){
										$dbstatus = FALSE;
										$dbMessage = 'Error While Saving';
									}
									else
									{
										$success_count++;
									}
								}
								else
								{
									$new_array = array( 
										"program_code"  =>$program_codes[$i],
										"menu_code"  =>$document[$k],
										"sl_no" =>$sl_nos[$k],
										"record_status" =>'Active',
										"institute_code" =>$institute_code,
										"created_by" => $logged_user_code,
										"created_on" => $date,
										"show_status"=> '1'
									);
									$insert_user = $this->db->insert('program_menu_setup',$new_array);
									if($insert_user){
										$dbStatus = "SUCCESS";
										$dbMessage = "Data successfully saved";
										$success_count++;
									}
									else
									{	
										$dbStatus = "ERROR";
										$dbMessage = mysqli_error($con);
										$error_count++;
										$errorArray[] = $document[$i];
									}
									
								}
							}
						}
					}
				}
				//Delete all the uploaded files
				foreach ($temporary_file_list as $filename) {
				  	unlink($filename);
				}
				if($success_count == 0)
				{
					$dbStatus = 'ERROR';
					$dbMessage ='All Combinations Are Already Exists';
				}
				else
				{
					$dbStatus = 'SUCCESS';
					$dbMessage = "Files Uploaded Successfully";
				}
				$output = array("dbStatus"=>$dbStatus,"dbMessage"=>$dbMessage,"dbError"=>$errorArray);
				return $output;
            break;
            
            
            
            case 'UPDATE_data':
				$dbStatus = "SUCCESS";
				$dbMessage = "Updated Successfully";
				$dbError = "";
				$temporary_file_list = array();
				
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
        		$logged_user = $this->session->userdata('user_name');
        		
				$arr_menu_code = array();
				$program = $_POST['cmbProgramFilter'];
				$sl_nos = $_POST['txtSeqNoEdit']?$_POST['txtSeqNoEdit']:array();
				$show_status = $_POST['chkShowSingle']?$_POST['chkShowSingle']:array();
				$menu_codes = $_POST['hidMenuCode']?$_POST['hidMenuCode']:array();
				$document_upload_status = $_POST['hidDocumentStatus']?$_POST['hidDocumentStatus']:array();
				$program_code = $program;
        		$logged_user_code = "$logged_user"."_"."$institute_code";
        		$op_type = 'UPDATE_data';
        		
        		$success_count = 0;
				$error_count = 0;
				$uploaddir = "../DOCUMENTS/".$program;
				
				if(!is_dir($uploaddir))
					mkdir($uploaddir,0777,true);
				$errorArray = array();
				$data = array( 
						"sl_no" => 'NULL',
						"show_status" => '0',
					);
					$this->db->where('program_code',$program_code);
					$update_user = $this->db->update('program_menu_setup',$data);
					if($update_user)
					{
						$dbStatus = "SUCCESS";
						$dbMessage = "Data successfully Updated";
					}
					else
					{
						$dbStatus = "ERROR";
						$dbMessage = "ERROR in Updation";
					}
        		for($j=0;$j<sizeof($menu_codes);$j++)
				{
					if(in_array($menu_codes[$j],$show_status))
					{
						if($document_upload_status[$j] == "Yes")
						{
		  					if(isset($_FILES['fileEdit'.$menu_codes[$j]]) && $_FILES['fileEdit'.$menu_codes[$j]]['name'] != '')
		  					{
								$uploaded_DocFile = explode(".",$_FILES['fileEdit'.$menu_codes[$j]]['name']);
								$ext = end($uploaded_DocFile);
								$renameDocument = "$menu_codes[$j]".'.'."$ext";
								$temp_file = $_FILES['fileEdit'.$menu_codes[$j]]['tmp_name'];
								$docfilepath = "$uploaddir/$renameDocument";
								$temporary_file_list[$menu_codes[$j]] = $temp_file;
								
								$$uploaded_DocFile = end((explode(".", $_FILES['fileEdit'.$menu_codes[$j]]['name'])));
								$check = getimagesize($_FILES['fileEdit'.$menu_codes[$j]]["tmp_name"]);
								if($check !== false) {

								} 
								else 
								{
									return array('status'=>false, 'msg'=>"Not an Image");
								}
								if($_FILES['fileEdit'.$menu_codes[$j]]["size"] > 1536000) {
									return array('status'=>false, 'msg'=>"Size of the image should be within 1MB");
								}
								// Allow certain file formats
								if($uploaded_DocFile != "jpg" && $uploaded_DocFile != "png" && $uploaded_DocFile != "jpeg" ) {
									return array('status'=>false, 'msg'=>"Supported file types are jpg/png/jpeg/gif");
								}
								if(isset($_FILES['fileEdit'.$menu_codes[$j]]['tmp_name']) && !empty($_FILES['fileEdit'.$menu_codes[$j]]['tmp_name'])){
									$pic_name = $this->input->post('institutecode').".".$uploaded_DocFile;//$_FILES['fileinstitutelogo']['name'];
									$uploads_dir = APPPATH."../public/assets/images/logo/".$pic_name;
									$result = move_uploaded_file($_FILES['fileEdit'.$menu_codes[$j]]['tmp_name'], $uploads_dir);
								}

								if(copy($temp_file, "$uploaddir/$renameDocument"))
								{
									$data = array( 
										"sl_no"  =>$sl_nos[$j],
										"show_status" =>'1',
										"file_path" =>$docfilepath,
										"file_name" =>$renameDocument,
										);
										$this->db->where('program_code',$program_code);
										$this->db->where('menu_code',$menu_codes[$j]);
										$this->db->update('program_menu_setup',$data);
										//echo $this->db->last_query();
									if($update_user)
									{
										$dbStatus = "SUCCESS";
										$dbMessage = "Data successfully saved";
									}
									else
									{
										$dbStatus = "ERROR";
										$dbMessage = "ERROR in data updation";
									}
								}
								else
								{
									$dbStatus = "ERROR";
									$dbMessage = "Error in document upload";
								}
							}
							else
							{
								$data = array( 
										"sl_no"  =>$sl_nos[$j],
										"show_status" =>'1',
										"updated_by" =>$logged_user_code,
										"updated_on" =>$date,
										);
										$this->db->where('program_code',$program_code);
										$this->db->where('menu_code',$menu_codes[$j]);
										$update_user = $this->db->update('program_menu_setup',$data);
								if($update_user)
								{
									$dbStatus = "SUCCESS";
									$dbMessage = "Data successfully saved";
									$success_count++;
								}
								else
								{
									$error_count++;
									$errorArray[] = $menu_codes[$j];
								}
							}
						}
						else
						{
							$data = array( 
								"sl_no"  =>$sl_nos[$j],
								"show_status" =>'1',
								"updated_by" =>$logged_user_code,
								"updated_on" =>$date,
							);
							$this->db->where('program_code',$program_code);
							$this->db->where('menu_code',$menu_codes[$j]);
							$update_user = $this->db->update('program_menu_setup',$data);
							//echo $this->db->last_query();
							if($update_user)
							{
								$dbStatus = "SUCCESS";
								$dbMessage = "Data successfully saved";
								$success_count++;
							}
							else
							{
								$error_count++;
								$errorArray[] = $menu_codes[$j];
							}
						}
					}
				}
				//Delete all the uploaded files
				foreach ($temporary_file_list as $filename) {
				  	unlink($filename);
				}
				if($error_count == sizeof($errorArray )&&( $error_count!=0 && sizeof($errorArray )!=0))
				{
					$dbStatus = 'ERROR';
					$dbMessage ='Combinations is Already  Exist';
				}
				else
				{
					$dbStatus = 'SUCCESS';
					$dbMessage = "Menu Successfully Updated";
				}
				$output = array("dbStatus"=>$dbStatus,"dbMessage"=>$dbMessage,"dbError"=>$errorArray);
				return $output;
            break;
            
            case 'SELECT_data' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$program = $_POST['program'];
				$this->db->select("CONCAT(description,'@',CODE) AS description,CONCAT(g_code,'`',g_desc,'`',field_status)");
				$this->db->from('(SELECT A.code_group, A.code, A.description, A.sl_no,
						CASE WHEN B.field_status IS NULL THEN "OPTIONAL" ELSE B.field_status END AS field_status 
						FROM registration_field_setup A
						LEFT JOIN program_registration_field_mapping B ON A.code = B.field_code 
						AND B.program_code = "'.$program.'"
						ORDER BY A.sl_no) A,(SELECT GROUP_CONCAT(CODE) AS g_code,GROUP_CONCAT(description) AS g_desc
					FROM gen_code_description
					WHERE code_group = "FIELD_STATUS") B');
				$result = $this->db->get();
				$this->db->save_queries = TRUE;
				//echo  $this->db->last_query();
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
			
			case 'SELECT_ALL_data' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
				$this->db->select("CONCAT(description,'`',CODE) AS description,
								CONCAT(g_code,'`',g_desc,'`',field_status) AS field_status");
				$this->db->from('(SELECT code_group,CODE,description,sl_no,field_status
						FROM registration_field_setup
						WHERE code_group = "REGISTRATION_PAGE"
						ORDER BY sl_no) A,(SELECT GROUP_CONCAT(CODE) AS g_code,GROUP_CONCAT(description) AS g_desc
						FROM gen_code_description
						WHERE code_group = "FIELD_STATUS") B');
				$result = $this->db->get();
				//echo  $this->db->last_query();
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
			
			case 'CMB_STATUS_data':
				$this->db->select('code');
				$this->db->from('gen_code_description');
				$this->db->where('code_group','FIELD_STATUS');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $aRow) 
	            {
					$output['aaData'][] = $aRow;
	                
	            }
	           	return $output;
			break;
			case 'CMB_CODE_data':
				$this->db->select('COLUMN_NAME');
				$this->db->from('INFORMATION_SCHEMA.COLUMNS ');
				$this->db->where('TABLE_SCHEMA','es_admission');
				$this->db->where('TABLE_NAME','applicant_reg_master');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $aRow) 
	            {
					$output['aaData'][] = $aRow;
	                
	            }
	           	return $output;
			break;
			
			case 'UPDATE_MULTIPLE_reg_data':
				$dbStatus = 'SUCCESS';
				$dbMessage = "Assigned Successfully";
				$dbError = '';
				
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
        		$logged_user = $this->session->userdata('user_name');
        		
				$arr_program_code = array();
				$arr_menu_code = array();
				$arr_sl_no = array();
				$arr_show_status = array();
				$program_codes = $_POST['program_codes'];
				$field_code = $_POST['field_code']?$_POST['field_code']:'';
				$field_status = $_POST['field_status']?$_POST['field_status']:'';
				$arr_program_code = call_user_func_array('array_merge', $program_codes);
        		$logged_user_code = "$logged_user"."_"."$institute_code";
        		$op_type = 'UPDATE_MULTIPLE_reg_data';
        		
        		for($i=0;$i<sizeof($arr_program_code);$i++)
				{
					$this->db->select('COUNT(program_code) AS program_code');
					$this->db->from('program_registration_field_mapping');
					$this->db->where('program_code',$arr_program_code[$i]);
					$this->db->where('record_status','1');
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
		            	$count = $aRow['program_code'];
		            }
					for($j=0;$j<sizeof($field_code);$j++)
					{
						
		            	if($count >= 1)
		            	{
							$data = array( 
								"field_code"  =>$field_code[$j],
								"field_status" =>$field_status[$j],
								"institute_code" => $institute_code,
								"updated_by" => $logged_user_code,
								"updated_on" => $date
							);
							$this->db->where('program_code',$arr_program_code[$i]);
							$this->db->where('field_code',$field_code[$j]);
							$update_user = $this->db->update('program_registration_field_mapping',$data);
							if(! $update_user){
								$dbStatus = "ERROR";
								$dbMessage = "Error Assigning";
							}
						}
						else
						{
							$new_array = array( 
								"program_code"  =>$arr_program_code[$i],
								"code_group"  =>'REGISTRATION_PAGE',
								"field_code" =>$field_code[$j],
								"field_status" =>$field_status[$j],
								"institute_code" =>$institute_code,
								"created_by" => $logged_user_code,
								"created_on" => $date
							);
							$insert_user = $this->db->insert('program_registration_field_mapping',$new_array);
							if($insert_user){
								$dbStatus = "SUCCESS";
								$dbMessage = "Data successfully saved";
							}
							else
							{	
								$dbStatus = "ERROR";
								$dbMessage ="Error in saving";
								
							}
						}
			            
						
					}
				}
				if($dbStatus == "SUCCESS")
				{
					$output = array("dbStatus"=>$dbStatus,"dbMessage"=>$dbMessage,"dbError"=>$dbError);
					return $output;
				}
				else
				{
					$output = array("dbStatus"=>$dbStatus,"dbMessage"=>$dbMessage,"dbError"=>$dbError);
					return $output;
				}
            break;
            
            
            case 'UPDATE_reg_data':
				$dbStatus = 'SUCCESS';
				$dbMessage = "Updated Successfully";
				$dbError = '';
				
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$year = date('Y', now());
        		$logged_user = $this->session->userdata('user_name');
        		
				$arr_program_code = array();
				$arr_menu_code = array();
				$arr_sl_no = array();
				$arr_show_status = array();
				$program_codes = array();
				$program_codes = $_POST['program_codes'];
				//$arr_program_code = call_user_func_array('array_merge', $program_codes);
				$field_code = $_POST['field_code']?$_POST['field_code']:'';
				$field_status = $_POST['field_status']?$_POST['field_status']:'';
        		$logged_user_code = "$logged_user"."_"."$institute_code";
        		$op_type = 'UPDATE_reg_data';
        		for($i=0;$i<sizeof($field_code);$i++)
				{
					$this->db->select('COUNT(program_code) AS program_code');
					$this->db->from('program_registration_field_mapping');
					$this->db->where('program_code',$program_codes);
					$this->db->where('record_status','1');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
		            	$count = $aRow['program_code'];
		            	if($count>=1)
		            	{
							$data = array( 
							"field_code"  =>$field_code[$i],
							"field_status" =>$field_status[$i],
							"institute_code" => $institute_code,
							"created_by" => $logged_user_code,
							"created_on" => $date,
							);
							$this->db->where('program_code',$program_codes);
							$this->db->where('field_code',$field_code[$i]);
							$update_user = $this->db->update('program_registration_field_mapping',$data);
							if(! $update_user){
								$dbStatus = "ERROR";
								$dbMessage = "Error Assigning";
							}
						}
						else
						{
							$new_array = array( 
							"program_code"  =>$program_codes,
							"code_group"  =>'REGISTRATION_PAGE',
							"field_code" =>$field_code[$i],
							"field_status" =>$field_status[$i],
							"institute_code" =>$institute_code,
							"created_by" => $logged_user_code,
							"created_on" => $date,
							);
							$insert_user = $this->db->insert('program_registration_field_mapping',$new_array);
							//echo $this->db->last_query();
							if($insert_user){
								$dbStatus = "SUCCESS";
								$dbMessage = "Data successfully saved";
							}
							else
							{	
								$dbStatus = "ERROR";
								$dbMessage ="Error in saving";
								
							}
						}
		            }
				}
				if($dbStatus == "SUCCESS")
				{
					$output = array("dbStatus"=>$dbStatus,"dbMessage"=>$dbMessage,"dbError"=>$dbError);
					return $output;
				}
				else
				{
					$output = array("dbStatus"=>$dbStatus,"dbMessage"=>$dbMessage,"dbError"=>$dbError);
					return $output;
				}
            break;     
            
            case 'select_prog_all_data' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$logged_user_code = "$logged_user"."_"."$institute_code";
        		
				$this->db->select("program_name, P.program_code,program_group");
				$this->db->from(' counselling_program_master P');
				$this->db->join('user_program_mapping U ','P.program_code = U.program_code','inner');
				$this->db->where('STATUS','Active');
				$this->db->where('publish_status','YES');
				$this->db->where('P.record_status','1');
				$this->db->where('U.record_status','1');
				$this->db->where('P.institute_code',$institute_code);
				$this->db->where('U.institute_code',$institute_code);
				$this->db->where('U.user_code',$logged_user_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'select_institute_course_disc' :
				$institute_code = $this->input->post('ins');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
      			$case_query ="(SELECT CONCAT(E.program_code,'-',E.branch_code) AS program_branch 
				FROM counselling_program_branch_institute_mapping E WHERE E.institute_code =  '$institute_code')";
				//$result1 = $this->db->get();
				$this->db->select("CONCAT(A.program_code,'-',A.branch_code) AS program_branch,B.program_name,C.branch,CASE WHEN CONCAT(B.program_code,'-',C.branch_code) 
				IN $case_query THEN '1'
				ELSE '0' END AS status");
				$this->db->from('counselling_program_branch_mapping A');
				$this->db->join('counselling_program_master B','A.program_code = B.program_code','inner');
				$this->db->join('counselling_branch_master C','A.branch_code = C.branch_code','inner');
				$this->db->where('A.record_status','1');
				$this->db->where('B.record_status','1');
				$this->db->where('C.record_status','1');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'select_institute_course_seat_disc' :
				$institute_code = $this->input->post('ins');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				//$result1 = $this->db->get();
				$this->db->select("ipb_code,CONCAT(B.program_name,'-',A.branch_code) AS program_branch,C.branch,D.institute_name,category_name,no_of_seats");
				$this->db->from('counselling_program_branch_institute_seat_master A');
				$this->db->join('counselling_program_master B','A.program_code = B.program_code','inner');
				$this->db->join('counselling_branch_master C','A.branch_code = C.branch_code','inner');
				$this->db->join('institute_master D','A.institute_code = D.institute_code','inner');
				$this->db->join('category_master E','E.category_code = A.category_code','inner');
				$this->db->where('A.record_status','1');
				$this->db->where('B.record_status','1');
				$this->db->where('C.record_status','1');
				$this->db->where('D.record_status','1');
				$this->db->where('E.record_status','1');
				$this->db->where('D.institute_code',$institute_code);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'get_program_branch_institute' :
				$institute_code = $this->input->post('ins');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				//$result1 = $this->db->get();
				$this->db->distinct('B.branch_code');
				$this->db->select('CONCAT(C.institute_name," - ",D.program_name," - ",A.branch) AS branch,ipb_code');
				$this->db->from('counselling_branch_master A');
				$this->db->join('counselling_program_branch_institute_mapping B','B.branch_code = A.branch_code','LEFT');
				$this->db->join('institute_master C','C.institute_code = B.institute_code','LEFT');
				$this->db->join('counselling_program_master D','D.program_code = B.program_code','LEFT');
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
			break; 
			case 'get_program_branch_institute_category' :
				$institute_code = $this->input->post('ins');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				//$result1 = $this->db->get();
				$this->db->distinct('B.branch_code');
				$this->db->select('category_code,category_name');
				$this->db->from('category_master');
				$this->db->where('record_status','1');
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
			break; 
			
			case 'get_program_branch_institute_seat_matrix_header1' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$user_code = $this->session->userdata('user_code');
				//$result1 = $this->db->get();
				
				$this->db->select("category_code,category_name,1 AS cat");
				$this->db->from('category_master');
				$this->db->where('record_status','1');
			    $query1 = $this->db->get_compiled_select(); // It resets the query just like a get()

			    $this->db->select("category_code,category_name,2 AS cat");
				$this->db->from('counselling_special_category_master');
				$this->db->where('record_status','1');
			    $query2 = $this->db->get_compiled_select(); 

			    $result = $this->db->query($query1." UNION ".$query2);
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			case 'select_program_branch_institute_seat_matrix_details' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$user_code = $this->session->userdata('user_code');
        		$counselling_period_code = $_REQUEST['counselling_period_code'];
        		$institute_code = $_REQUEST['ins'];
        		$data_arr = array();
        		$header_arr = array();
        		$output = array("aaData" => array());      
				
				
				$this->db->select("CONCAT(A.program_code,'_',program_name) AS program_name,
									CONCAT(A.branch_code,'`',branch) AS branch,GROUP_CONCAT(category_code) AS category_code,
									GROUP_CONCAT(no_of_seats SEPARATOR '@') AS no_of_seats");
				$this->db->from('counselling_program_branch_institute_seat_master A');
				$this->db->join('counselling_program_master B','A.program_code = B.program_code','LEFT');
				$this->db->join('counselling_branch_master C','A.branch_code = C.branch_code','LEFT');
				$this->db->where('A.institute_code',$institute_code);
				$this->db->where('A.counselling_period_code',$counselling_period_code);
				$this->db->group_by('A.branch_code');
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
	            {
	            	$data_arr[] = $row;
	            }
	            
				$this->db->select("category_code,category_name,1 AS cat");
				$this->db->from('category_master');
				$this->db->where('record_status','1');
			    $query1 = $this->db->get_compiled_select(); // It resets the query just like a get()

			    $this->db->select("category_code,category_name,2 AS cat");
				$this->db->from('counselling_special_category_master');
				$this->db->where('record_status','1');
			    $query2 = $this->db->get_compiled_select(); 

			    $result = $this->db->query($query1." UNION ".$query2);
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
	            	$header_arr[] = $aRow;
	            }
	            $slno = 1;
				foreach($data_arr as $row)
				{
					$student_details = array();
					$student_details[] = $slno;
					$program = explode('_',$row['program_name']);
					$program_code = $program[0];
					$program_name = $program[1];
					$student_details[] = '<input type="hidden" class= "form-control" name="txtProgramCode[]" value="'.$program_code.'">'.$program_name.'';
					$branch = explode('`',$row['branch']);
					$branch_code = $branch[0];
					$branch = $branch[1];
					$student_details[] = '<input type="hidden" class= "form-control" name="txtBranchCode[]" value="'.$branch_code.'">'.$branch.'';
					//$student_details[] = $branch;
					
					$category_arr = explode(',',$row['category_code']);
					$seats_arr = explode('@',$row['no_of_seats']);
					foreach($header_arr as $row1)
					{
						if(in_array($row1['category_code'],$category_arr))
						{
							$key = array_search($row1['category_code'], $category_arr);
							$seats = array_key_exists($key,$seats_arr)?$seats_arr[$key]:'';
							$student_details[] = '<input type="text" size="5" class= "form-control" name="txtSeats'.$row1['category_code'].'[]" value="'.$seats.'">';
							//$student_details[] ='<div style="text-align:center">'.$seats.'</div>';
						}
						else
						{
							$student_details[] = '<input type="text" size="5" class= "form-control" name="txtSeats'.$row1['category_code'].'[]" value="">';
						}
					}
					
					$output['aaData'][] = $student_details;
					$slno++;
				}
	           	return $output;
			break; 
			
			case 'AddprogramBranchInstituteSeatMatrix' :
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Inserted";
				$cmbInstituteFilterIns = isset($_POST['hidInstituteFilterIns'])?$_POST['hidInstituteFilterIns']:'';
				$cmbCounsellingPeriod = isset($_POST['hidCounsellingPeriod'])?$_POST['hidCounsellingPeriod']:'';
				$arr_prog_code = isset($_POST['txtProgramCode'])?$_POST['txtProgramCode']:'';
				$arr_branch_code = isset($_POST['txtBranchCode'])?$_POST['txtBranchCode']:'';
				//$txtSeats = isset($_POST['arr_seats'])?$_POST['arr_seats']:'';
				$date = date('Y-m-d H:i:s', now());
				$header_arr = array();
				
				
				
				$this->db->select("category_code,category_name,1 AS cat");
				$this->db->from('category_master');
				$this->db->where('record_status','1');
			    $query1 = $this->db->get_compiled_select(); // It resets the query just like a get()

			    $this->db->select("category_code,category_name,2 AS cat");
				$this->db->from('counselling_special_category_master');
				$this->db->where('record_status','1');
			    $query2 = $this->db->get_compiled_select(); 

			    $result = $this->db->query($query1." UNION ".$query2);
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
	            	$header_arr[] = $aRow;
	            }
	            
	            foreach($header_arr as $row)
	            {
					$arr_seats[$row['category_code']] = isset($_POST['txtSeats'.$row['category_code']])?$_POST['txtSeats'.$row['category_code']]:'0';
					
				}
				
				for($i = 0; $i < sizeof($arr_prog_code); $i++)
				{
					$branch_code = $arr_branch_code[$i];
					$program_code = $arr_prog_code[$i];
					
					$this->db->where("program_code",$program_code);
					$this->db->where("branch_code",$branch_code);
					$this->db->where("institute_code",$cmbInstituteFilterIns);
					$this->db->select("ipb_code");
					$this->db->from("counselling_program_branch_institute_mapping");
					
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach($output_data as $row)
					{
						$ipb_code = $row['ipb_code'];
					}
					
					
					foreach($header_arr as $row)
					{
						$category_code = $row['category_code'];
						
						if($arr_seats[$row['category_code']] == '')
						{
							$arr_seats[$row['category_code']] = 0;
						}
						$no_seats = $arr_seats[$row['category_code']][$i];
						
						$this->db->where("ipb_code",$ipb_code);
						$this->db->where("category_code",$category_code);
						$this->db->select("count(ipb_code) as ipb_code");
						$this->db->from("counselling_program_branch_institute_seat_master");
						
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row)
						{
							$cnt = $row['ipb_code'];
						}
						if($no_seats != 0)
						{
							if($cnt == 0)
							{
								$new_array = array( 
									"counselling_period_code"  =>$cmbCounsellingPeriod,
									"ipb_code"  =>$ipb_code,
									"institute_code" =>$cmbInstituteFilterIns,
									"program_code" => $program_code,
									"branch_code" => $branch_code,
									"category_code" => $category_code,
									"no_of_seats" => $no_seats,
									"created_by" => 'SUPADM001',
									"created_on" => $date,
								);
								$sql = $this->db->insert('counselling_program_branch_institute_seat_master',$new_array);
								if(!$sql){
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
								}
							}
							else
							{
								$update_data = array(
									"no_of_seats" => $no_seats,
									"updated_by" => 'SUPADM001',
									"updated_on" => $date,
								);
								$this->db->where('ipb_code',$ipb_code);
								$this->db->where('category_code',$category_code);
								$sql = $this->db->update('counselling_program_branch_institute_seat_master', $update_data);
								/*echo $this->db->last_query();
								die();*/
								if(!$sql){
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
								}
							}
						}
						
					}
				}
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			case 'AddprogramBranchInstituteSeat' :
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Inserted";
				$cmbprogramBranchInstitute=isset($_POST['cmbprogramBranchInstitute'])?$_POST['cmbprogramBranchInstitute']:'';
				$cmbCategoryCode=isset($_POST['cmbCategoryCode'])?$_POST['cmbCategoryCode']:'';
				$txtSeats = isset($_POST['txtSeats'])?$_POST['txtSeats']:'';
				$cmbInstituteFilterIns = isset($_POST['cmbInstituteFilterIns'])?$_POST['cmbInstituteFilterIns']:'';
				$cmbCounsellingPeriod = isset($_POST['cmbCounsellingPeriod'])?$_POST['cmbCounsellingPeriod']:'';
				$date = date('Y-m-d H:i:s', now());
				$count_checked_element = 0;
				$success_count = 0;
				
				$this->db->where("ipb_code",$cmbprogramBranchInstitute);
				$this->db->select("count(ipb_code) as ipb_code");
				$this->db->from("counselling_program_branch_institute_seat_master");
				
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$cnt = $row['ipb_code'];
				}
				
				
				if($cnt == '0')
				{
					$this->db->select("program_code,branch_code,institute_code");
					$this->db->from("counselling_program_branch_institute_mapping");
					$this->db->where("ipb_code",$cmbprogramBranchInstitute);
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach($output_data as $row)
					{
						$program_code = $row['program_code'];
						$branch_code = $row['branch_code'];
						$institute_code = $row['institute_code'];
					}
					
					$new_array = array( 
						"counselling_period_code"  =>$cmbCounsellingPeriod,
						"program_code"  =>$program_code,
						"branch_code"  =>$branch_code,
						"institute_code" =>$institute_code,
						"category_code" => $cmbCategoryCode,
						"no_of_seats" => $txtSeats,
						"ipb_code" =>$cmbprogramBranchInstitute,
						"created_by" => 'SUPADM001',
						"created_on" => $date,
					);
					$sql = $this->db->insert('counselling_program_branch_institute_seat_master',$new_array);
					if(!$sql){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
				}
				else
				{
					
					$this->db->select("program_code,branch_code,institute_code");
					$this->db->from("counselling_program_branch_institute_mapping");
					$this->db->where("ipb_code",$cmbprogramBranchInstitute);
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach($output_data as $row)
					{
						$program_code = $row['program_code'];
						$branch_code = $row['branch_code'];
						$institute_code = $row['institute_code'];
					}
					
					$update_data = array(
						"program_code"  =>$program_code,
						"branch_code"  =>$branch_code,
						"institute_code" =>$institute_code,
						"category_code" => $cmbCategoryCode,
						"no_of_seats" => $txtSeats,
						"updated_by" => 'SUPADM001',
						"updated_on" => $date,
					);
					$this->db->where('ipb_code',$cmbprogramBranchInstitute);
					$sql = $this->db->update('counselling_program_branch_institute_seat_master', $update_data);
					if(!$sql){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
				}
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			case 'UpdateprogramBranchInstituteSeat' :
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Updated";
				$cmbprogramBranchInstitute=isset($_POST['cmbprogramBranchInstitute'])?$_POST['cmbprogramBranchInstitute']:'';
				$txtSeats = isset($_POST['txtSeats'])?$_POST['txtSeats']:'';
				$date = date('Y-m-d H:i:s', now());
				$count_checked_element = 0;
				$success_count = 0;
				
				
				$this->db->select("program_code,branch_code,institute_code");
				$this->db->from("counselling_program_branch_institute_mapping");
				$this->db->where("ipb_code",$cmbprogramBranchInstitute);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$program_code = $row['program_code'];
					$branch_code = $row['branch_code'];
					$institute_code = $row['institute_code'];
				}
				
				$update_data = array(
					"no_of_seats" => $txtSeats,
					"updated_by" => 'SUPADM001',
					"updated_on" => $date,
				);
				$this->db->where('ipb_code',$cmbprogramBranchInstitute);
				$sql = $this->db->update('counselling_program_branch_institute_seat_master', $update_data);
				if(!$sql){
					$dbStatus = "ERROR";
					$dbMessage = "Error Inserting";
				}
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break;
			
			case 'ProgramBranchInstituteSeatDelete' :
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Deleted";
				$cmbprogramBranchInstitute=isset($_POST['ipb_code'])?$_POST['ipb_code']:'';
				$date = date('Y-m-d H:i:s', now());
				
				$this->db->where("ipb_code",$cmbprogramBranchInstitute);
				$update_applicant_relation2 = $this->db->delete('counselling_program_branch_institute_seat_master');
				//echo $this->db->last_query();
				if(!$update_applicant_relation2)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error deleting';
				}
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			//FOR COPY BUTTON
 			case 'get_from'	:
 				$this->db->	select("counselling_period_code,counselling_period_name");
 				$this->db-> from('counselling_period_master');
 				$result = $this->db->get();
 				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'get_to'	:
			
				$from=isset($_POST['from'])?$_POST['from']:'';
				
 				$this->db->	select("counselling_period_code,counselling_period_name");
 				$this->db-> from('counselling_period_master');
 				$this->db-> where('counselling_period_code!=',$from);
 				$result = $this->db->get();
 				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'AddMatrixData' :
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Inserted";
				$cmbInstituteFilterIns = isset($_POST['hidInstituteFilterInsCopy'])?$_POST['hidInstituteFilterInsCopy']:'';
				$cmbCounsellingPeriod = isset($_POST['hidCounsellingPeriodCopy'])?$_POST['hidCounsellingPeriodCopy']:'';
				$cmbCounsellingPeriodFrom = isset($_POST['hidCounsellingPeriodFromCopy'])?$_POST['hidCounsellingPeriodFromCopy']:'';
				$cmbCounsellingPeriodTo = isset($_POST['hidCounsellingPeriodToCopy'])?$_POST['hidCounsellingPeriodToCopy']:'';
				$arr_prog_code = isset($_POST['txtProgramCode'])?$_POST['txtProgramCode']:'';
				$arr_branch_code = isset($_POST['txtBranchCode'])?$_POST['txtBranchCode']:'';
				//$txtSeats = isset($_POST['arr_seats'])?$_POST['arr_seats']:'';
				$date = date('Y-m-d H:i:s', now());
				$header_arr = array();
				
				$this->db->select("category_code,category_name,1 AS cat");
				$this->db->from('category_master');
				$this->db->where('record_status','1');
			    $query1 = $this->db->get_compiled_select(); // It resets the query just like a get()

			    $this->db->select("category_code,category_name,2 AS cat");
				$this->db->from('counselling_special_category_master');
				$this->db->where('record_status','1');
			    $query2 = $this->db->get_compiled_select(); 

			    $result = $this->db->query($query1." UNION ".$query2);
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				foreach ($output_data as $aRow) 
	            {
	            	$header_arr[] = $aRow;
	            }
	            
	            foreach($header_arr as $row)
	            {
					$arr_seats[$row['category_code']] = isset($_POST['txtSeats'.$row['category_code']])?$_POST['txtSeats'.$row['category_code']]:'0';
					
				}
				
				for($i = 0; $i < sizeof($arr_prog_code); $i++)
				{
					$branch_code = $arr_branch_code[$i];
					$program_code = $arr_prog_code[$i];
					
					$this->db->where("program_code",$program_code);
					$this->db->where("branch_code",$branch_code);
					$this->db->where("institute_code",$cmbInstituteFilterIns);
					$this->db->select("ipb_code");
					$this->db->from("counselling_program_branch_institute_mapping");
					
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach($output_data as $row)
					{
						$ipb_code = $row['ipb_code'];
					}
					
					
					foreach($header_arr as $row)
					{
						$category_code = $row['category_code'];
						
						if($arr_seats[$row['category_code']] == '')
						{
							$arr_seats[$row['category_code']] = 0;
						}
						$no_seats = $arr_seats[$row['category_code']][$i];
						
						$this->db->where("ipb_code",$ipb_code);
						$this->db->where("counselling_period_code",$cmbCounsellingPeriodTo);
						$this->db->where("category_code",$category_code);
						$this->db->select("count(ipb_code) as ipb_code");
						$this->db->from("counselling_program_branch_institute_seat_master");
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row)
						{
							$cnt = $row['ipb_code'];
						}
						if($no_seats != 0)
						{
							if($cnt == 0)
							{
								$new_array = array( 
									"counselling_period_code"  =>$cmbCounsellingPeriodTo,
									"ipb_code"  =>$ipb_code,
									"institute_code" =>$cmbInstituteFilterIns,
									"program_code" => $program_code,
									"branch_code" => $branch_code,
									"category_code" => $category_code,
									"no_of_seats" => $no_seats,
									"created_by" => 'SUPADM001',
									"created_on" => $date,
								);
								$sql = $this->db->insert('counselling_program_branch_institute_seat_master',$new_array);
								/*echo $this->db->last_query();
								die();*/
								if(!$sql){
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
								}
							}
							else
							{
								$update_data = array(
									"no_of_seats" => $no_seats,
									"updated_by" => 'SUPADM001',
									"updated_on" => $date,
								);
								$this->db->where('ipb_code',$ipb_code);
								$this->db->where('category_code',$category_code);
								$this->db->where("counselling_period_code",$cmbCounsellingPeriodTo);
								$sql = $this->db->update('counselling_program_branch_institute_seat_master', $update_data);
								/*echo $this->db->last_query();
								die();*/
								if(!$sql){
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
								}
							}
						}
						
					}
				}
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			   
			//************************************************* document setup************************************************* 
			
			case 'select_DocumentSetup' :
				$institute_code = $this->input->post('ins');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$user_code = $this->session->userdata('user_code');
				//$result1 = $this->db->get();
				$this->db->select("document_type_code,document_type,type");
				$this->db->from('document_type_master A');
				$this->db->where('A.record_status','1');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			case 'ADD_DOCUMENT_SETUP' :
				$txtDocumentCode = isset($_POST['txtDocumentCode'])?$_POST['txtDocumentCode']:'';
				$txtDocumentName = isset($_POST['txtDocumentName'])?$_POST['txtDocumentName']:'';
				$cmbDocumentType = isset($_POST['cmbDocumentType'])?$_POST['cmbDocumentType']:'';
				
				$date = date('Y-m-d H:i:s', now());
				$institute_code = $this->session->userdata("institute_code");
				
				$dbStatus = "SUCCESS";
				$dbMessage = "Data Successfully Inserted";
				
				
				$new_array = array( 
					"document_type_code"  =>$txtDocumentCode,
					"document_type"  =>$txtDocumentName,
					"type"  =>$cmbDocumentType,
					"record_status" => '1',
					"created_by" => 'SUPADM001',
					"created_on" => $date,
				);
				$sql = $this->db->insert('document_type_master',$new_array);
				if(!$sql){
					$dbStatus = "ERROR";
					$dbMessage = "Error Inserting";
				}
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			case 'UPDATE_DOCUMENT_SETUP' :
				
				$institute_code = $this->session->userdata("institute_code");
				$dbStatus = "SUCCESS";
				$dbMessage = "Data Successfully Updated";
				$txtDocumentCode = isset($_POST['hidDocumentCode'])?$_POST['hidDocumentCode']:'';
				$txtDocumentName = isset($_POST['txtDocumentName'])?$_POST['txtDocumentName']:'';
				$cmbDocumentType = isset($_POST['cmbDocumentType'])?$_POST['cmbDocumentType']:'';
				$date = date('Y-m-d H:i:s', now());
				
				$update_data = array(
					"document_type_code"  =>$txtDocumentCode,
					"document_type"  =>$txtDocumentName,
					"type"  =>$cmbDocumentType,
					"updated_by" => 'SUPADM001',
					"updated_on" => $date,
				);
				$this->db->where('document_type_code',$txtDocumentCode);
				$sql = $this->db->update('document_type_master', $update_data);
				//echo $this->db->last_query();
				if(!$sql){
					$dbStatus = "ERROR";
					$dbMessage = "Error Inserting";
				}
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break;
			
			case 'operation_delete_document_setup' :
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Deleted";
				$document_code = isset($_POST['document_code'])?$_POST['document_code']:'';
				$date = date('Y-m-d H:i:s', now());
				
				$this->db->where("document_type_code",$document_code);
				$update_applicant_relation2 = $this->db->delete('document_type_master');
				//echo $this->db->last_query();
				if(!$update_applicant_relation2)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error deleting';
				}
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			//************************************************* category setup************************************************* 
			
			case 'select_CategorySetup' :
				$institute_code = $this->input->post('ins');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$user_code = $this->session->userdata('user_code');
				//$result1 = $this->db->get();
				$this->db->select("category_code,category_name");
				$this->db->from('category_master A');
				$this->db->where('A.record_status','1');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			case 'ADD_CATEGORY' :
				$txtCategoryCode = isset($_POST['txtCategoryCode'])?$_POST['txtCategoryCode']:'';
				$txtCategoryName = isset($_POST['txtCategoryName'])?$_POST['txtCategoryName']:'';
				
				$date = date('Y-m-d H:i:s', now());
				$institute_code = $this->session->userdata("institute_code");
				
				$dbStatus = "SUCCESS";
				$dbMessage = "Data Successfully Inserted";
				
				
				$new_array = array( 
					"category_code"  =>$txtCategoryCode,
					"category_name"  =>$txtCategoryName,
					"record_status" => '1',
					"created_by" => 'SUPADM001',
					"created_on" => $date,
				);
				$sql = $this->db->insert('category_master',$new_array);
				if(!$sql){
					$dbStatus = "ERROR";
					$dbMessage = "Error Inserting";
				}
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			case 'UPDATE_CATEGORY' :
				
				$institute_code = $this->session->userdata("institute_code");
				$dbStatus = "SUCCESS";
				$dbMessage = "Data Successfully Updated";
				$hidCategory = isset($_POST['hidCategory'])?$_POST['hidCategory']:'';
				$txtCategoryName = isset($_POST['txtCategoryName'])?$_POST['txtCategoryName']:'';
				$cmbDocumentType = isset($_POST['cmbDocumentType'])?$_POST['cmbDocumentType']:'';
				$date = date('Y-m-d H:i:s', now());
				
				$update_data = array(
					"category_code"  =>$hidCategory,
					"category_name"  =>$txtCategoryName,
					"updated_by" => 'SUPADM001',
					"updated_on" => $date,
				);
				$this->db->where('category_code',$hidCategory);
				$sql = $this->db->update('category_master', $update_data);
				//echo $this->db->last_query();
				if(!$sql){
					$dbStatus = "ERROR";
					$dbMessage = "Error Inserting";
				}
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break;
			
			case 'operation_delete_category' :
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Deleted";
				$category_code = isset($_POST['category_code'])?$_POST['category_code']:'';
				$date = date('Y-m-d H:i:s', now());
				
				$this->db->where("category_code",$category_code);
				$update_applicant_relation2 = $this->db->delete('category_master');
				//echo $this->db->last_query();
				if(!$update_applicant_relation2)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error deleting';
				}
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			
			//************************************************* special category setup************************************************* 
			
			case 'select_specialCategorySetup' :
				$institute_code = $this->input->post('ins');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$user_code = $this->session->userdata('user_code');
				//$result1 = $this->db->get();
				$this->db->select("category_code,category_name");
				$this->db->from('counselling_special_category_master A');
				$this->db->where('A.record_status','1');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			case 'ADD_SPECIAL_CATEGORY' :
				$txtSpecialCategoryCode = isset($_POST['txtSpecialCategoryCode'])?$_POST['txtSpecialCategoryCode']:'';
				$txtSpecialCategoryName = isset($_POST['txtSpecialCategoryName'])?$_POST['txtSpecialCategoryName']:'';
				
				$date = date('Y-m-d H:i:s', now());
				$institute_code = $this->session->userdata("institute_code");
				
				$dbStatus = "SUCCESS";
				$dbMessage = "Data Successfully Inserted";
				
				
				$new_array = array( 
					"category_code"  =>$txtSpecialCategoryCode,
					"category_name"  =>$txtSpecialCategoryName,
					"record_status" => '1',
					"created_by" => 'SUPADM001',
					"created_on" => $date,
				);
				$sql = $this->db->insert('counselling_special_category_master',$new_array);
				if(!$sql){
					$dbStatus = "ERROR";
					$dbMessage = "Error Inserting";
				}
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			case 'UPDATE_SPECIAL_CATEGORY' :
				
				$institute_code = $this->session->userdata("institute_code");
				$dbStatus = "SUCCESS";
				$dbMessage = "Data Successfully Updated";
				$hidSpecialCategory = isset($_POST['hidSpecialCategory'])?$_POST['hidSpecialCategory']:'';
				$txtSpecialCategoryName = isset($_POST['txtSpecialCategoryName'])?$_POST['txtSpecialCategoryName']:'';
				$date = date('Y-m-d H:i:s', now());
				
				$update_data = array(
					"category_code"  =>$hidSpecialCategory,
					"category_name"  =>$txtSpecialCategoryName,
					"updated_by" => 'SUPADM001',
					"updated_on" => $date,
				);
				$this->db->where('category_code',$hidSpecialCategory);
				$sql = $this->db->update('counselling_special_category_master', $update_data);
				//echo $this->db->last_query();
				if(!$sql){
					$dbStatus = "ERROR";
					$dbMessage = "Error Inserting";
				}
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break;
			
			case 'operation_delete_special_category' :
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Deleted";
				$category_code = isset($_POST['category_code'])?$_POST['category_code']:'';
				$date = date('Y-m-d H:i:s', now());
				
				$this->db->where("category_code",$category_code);
				$update_applicant_relation2 = $this->db->delete('counselling_special_category_master');
				//echo $this->db->last_query();
				if(!$update_applicant_relation2)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error deleting';
				}
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			//************************************************* FOR CATEGORY TO DOCUMENT MAPPING ************************************
			
			
			case 'select_CategoryDocument' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				//$result1 = $this->db->get();
				$this->db->select("A.category_code,IFNULL(B.category_name,D.category_name) AS category_name,C.document_type,A.document_code");
				$this->db->from('category_document_mapping A');
				$this->db->join('category_master B','A.category_code = B.category_code','left');
				$this->db->join('document_type_master C','A.document_code = C.document_type_code','left');
				$this->db->join('counselling_special_category_master D','A.category_code = D.category_code','left');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'select_cmbCategoryCode' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$user_code = $this->session->userdata('user_code');
				//$result1 = $this->db->get();
				
				$this->db->select("category_code,category_name");
				$this->db->from('category_master');
				$this->db->where('record_status','1');
			    $query1 = $this->db->get_compiled_select(); // It resets the query just like a get()

			    $this->db->select("category_code,category_name");
				$this->db->from('counselling_special_category_master');
				$this->db->where('record_status','1');
			    $query2 = $this->db->get_compiled_select(); 

			    $result = $this->db->query($query1." UNION ".$query2);
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'select_cmbDocumentCode' :
				$institute_code = $this->input->post('ins');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				//$result1 = $this->db->get();
				$this->db->select("document_type_code,document_type");
				$this->db->from('document_type_master');
				$this->db->where('record_status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'ADD_CategoryDocumentMapping' :
				$cmbCategoryCode = isset($_POST['cmbCategoryCode'])?$_POST['cmbCategoryCode']:'';
				$cmbDocumentCode = isset($_POST['cmbDocumentCode'])?$_POST['cmbDocumentCode']:'';
				$date = date('Y-m-d H:i:s', now());
				$institute_code = $this->session->userdata("institute_code");
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Inserted";
				
				$cmbDocumentCodeSize = sizeof($cmbDocumentCode);
				
				for($i = 0;$i < $cmbDocumentCodeSize; $i++)
				{
					if($cmbDocumentCode[$i] != 'multiselect-all')
					{
						$this->db->where("document_code",$cmbDocumentCode[$i]);
						$this->db->where("category_code",$cmbCategoryCode);
						$this->db->select("count(category_code) as category_code");
						$this->db->from("category_document_mapping");
						
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row)
						{
							$cnt = $row['category_code'];
						}
						
						
						if($cnt == '0')
						{
							$new_array = array( 
								"category_code"  =>$cmbCategoryCode,
								"document_code"  =>$cmbDocumentCode[$i],
								"institute_code" => $institute_code,
								"created_by" => 'SUPADM001',
								"created_on" => $date,
							);
							$sql = $this->db->insert('category_document_mapping',$new_array);
							if(!$sql){
								$dbStatus = "ERROR";
								$dbMessage = "Error Inserting";
							}
						}
					}
				}
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			case 'UPDATE_CategoryDocumentMapping' :
				
				$institute_code = $this->session->userdata("institute_code");
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Updated";
				$cmbCategoryCode = isset($_POST['hidCategoryCode'])?$_POST['hidCategoryCode']:'';
				$cmbDocumentCodeEdit = isset($_POST['cmbDocumentCodeEdit'])?$_POST['cmbDocumentCodeEdit']:'';
				$hidDocumentCode = isset($_POST['hidCatDocumentCode'])?$_POST['hidCatDocumentCode']:'';
				$date = date('Y-m-d H:i:s', now());
				
				$this->db->where("document_code",$cmbDocumentCodeEdit);
				$this->db->where("category_code",$cmbCategoryCode);
				$this->db->select("count(category_code) as category_code");
				$this->db->from("category_document_mapping");
				
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$cnt = $row['category_code'];
				}
				
				
				if($cnt == '0')
				{
				
					$update_data = array(
						"document_code"  =>$cmbDocumentCodeEdit,
						"institute_code" => $institute_code,
						"updated_by" => 'SUPADM001',
						"updated_on" => $date,
					);
					$this->db->where("document_code",$hidDocumentCode);
					$this->db->where("category_code",$cmbCategoryCode);
					$sql = $this->db->update('category_document_mapping', $update_data);
					//echo $this->db->last_query();
					if(!$sql){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
				}
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break;
			
			case 'operation_delete_CategoryDocumentMapping' :
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Deleted";
				$category_code=isset($_POST['category_code'])?$_POST['category_code']:'';
				$document_code=isset($_POST['document_code'])?$_POST['document_code']:'';
				$date = date('Y-m-d H:i:s', now());
				
				$this->db->where("category_code",$category_code);
				$this->db->where("document_code",$document_code);
				$update_applicant_relation2 = $this->db->delete('category_document_mapping');
				//echo $this->db->last_query();
				if(!$update_applicant_relation2)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error deleting';
				}
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			
			
			//************************************************* FOR CATEGORY TO DOCUMENT MAPPING ************************************
			
			
			case 'select_CategoryFee' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				//$result1 = $this->db->get();
				$this->db->select("A.category_code,IFNULL(B.category_name,D.category_name) AS category_name,amount");
				$this->db->from('category_fee_setup A');
				$this->db->join('category_master B','A.category_code = B.category_code','left');
				$this->db->join('counselling_special_category_master D','A.category_code = D.category_code','left');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'ADD_CategoryFee' :
				$cmbCategoryCode = isset($_POST['cmbCategoryFeeCode'])?$_POST['cmbCategoryFeeCode']:'';
				$txtFee = isset($_POST['txtFee'])?$_POST['txtFee']:'';
				$date = date('Y-m-d H:i:s', now());
				$institute_code = $this->session->userdata("institute_code");
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Inserted";
				
				$this->db->where("category_code",$cmbCategoryCode);
				$this->db->select("count(category_code) as category_code");
				$this->db->from("category_fee_setup");
				
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$cnt = $row['category_code'];
				}
				
				
				if($cnt == '0')
				{
					$new_array = array( 
						"category_code"  =>$cmbCategoryCode,
						"amount"  =>$txtFee,
						"institute_code" => $institute_code,
						"created_by" => 'SUPADM001',
						"created_on" => $date,
					);
					$sql = $this->db->insert('category_fee_setup',$new_array);
					if(!$sql){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
				}
				else
				{
					$update_data = array(
						"amount"  =>$txtFee,
						"institute_code" => $institute_code,
						"updated_by" => 'SUPADM001',
						"updated_on" => $date,
					);
					$this->db->where("category_code",$cmbCategoryCode);
					$sql = $this->db->update('category_fee_setup', $update_data);
					//echo $this->db->last_query();
					if(!$sql){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
				}
					
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			case 'UPDATE_CategoryFee' :
				
				$institute_code = $this->session->userdata("institute_code");
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Updated";
				$cmbCategoryCode = isset($_POST['hidCategoryFeeCode'])?$_POST['hidCategoryFeeCode']:'';
				$txtFee = isset($_POST['txtFee'])?$_POST['txtFee']:'';
				$date = date('Y-m-d H:i:s', now());
				
				$this->db->where("category_code",$cmbCategoryCode);
				$this->db->select("count(category_code) as category_code");
				$this->db->from("category_fee_setup");
				
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$cnt = $row['category_code'];
				}
				
				if($cnt != '0')
				{
				
					$update_data = array(
						"amount"  =>$txtFee,
						"institute_code" => $institute_code,
						"updated_by" => 'SUPADM001',
						"updated_on" => $date,
					);
					$this->db->where("category_code",$cmbCategoryCode);
					$sql = $this->db->update('category_fee_setup', $update_data);
					//echo $this->db->last_query();
					if(!$sql){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
				}
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break;
			
			case 'operation_delete_CategoryFee' :
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Deleted";
				$category_code=isset($_POST['category_code'])?$_POST['category_code']:'';
				$date = date('Y-m-d H:i:s', now());
				
				$this->db->where("category_code",$category_code);
				$update_applicant_relation2 = $this->db->delete('category_fee_setup');
				//echo $this->db->last_query();
				if(!$update_applicant_relation2)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error deleting';
				}
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
		//******************************************** REMARK SETUP*********************************************************
			case 'select_Remark':
				$this->db->select("remarks");
				$this->db->from('counselling_rejection_remarks');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
		
			case 'ADD_remarks':
				$date = date('Y-m-d H:i:s', now());
				$dbStatus = "SUCCESS";
				$dbMessage = "Inserted Successfully";
				$remark = isset($_POST['txtRemark'])?$_POST['txtRemark']:'';
				$new_array = array( 
					"remarks"  => $remark,
					"record_status" => '1',
					"created_by" => 'SUPADM001',
					"created_on" => $date,
				);
				$sql = $this->db->insert('counselling_rejection_remarks',$new_array);
				if(!$sql){
					$dbStatus = "ERROR";
					$dbMessage = "Error Inserting";
				}
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			case 'operation_delete_remark':
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Deleted";
				$remarks = isset($_POST['remark'])?$_POST['remark']:'';
				$date = date('Y-m-d H:i:s', now());
				
				$this->db->where("remarks",$remarks);
				$update_applicant_relation2 = $this->db->delete('counselling_rejection_remarks');
				//echo $this->db->last_query();
				if(!$update_applicant_relation2)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error deleting';
				}
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
		
			
			//************************************************* COUNSELLING PERIOD SETUP************************************************* 
			case 'select_counselling_period_data':
            	$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$logged_user_code = "$logged_user"."_"."$institute_code";
        		
				$this->db->select("counselling_period_code,counselling_period_name");
				$this->db->from('counselling_period_master');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			case 'select_CounsellingPeriod' :
				$institute_code = $this->input->post('ins');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$user_code = $this->session->userdata('user_code');
				//$result1 = $this->db->get();
				$this->db->select("counselling_period_code,counselling_period_name,status");
				$this->db->from('counselling_period_master A');
				$this->db->where('A.record_status','1');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			case 'ADD_CounsellingPeriod' :
				$txtCounsellingPeriodCode = isset($_POST['txtCounsellingPeriodCode'])?$_POST['txtCounsellingPeriodCode']:'';
				$txtCounsellingPeriodName = isset($_POST['txtCounsellingPeriodName'])?$_POST['txtCounsellingPeriodName']:'';
				$cmbCounsellingPeriodStatus = isset($_POST['cmbCounsellingPeriodStatus'])?$_POST['cmbCounsellingPeriodStatus']:'';
				
				$date = date('Y-m-d H:i:s', now());
				$institute_code = $this->session->userdata("institute_code");
				
				$dbStatus = "SUCCESS";
				$dbMessage = "Data Successfully Inserted";
				
	            if($cmbCounsellingPeriodStatus == 'Active')
	            {
	            	$this->db->select("COUNT(counselling_period_code) as status");
					$this->db->from('counselling_period_master A');
					$this->db->where('status','Active');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
		            	$status = $aRow['status'];
		            }
	            
					if($status == 0)
					{
						$new_array = array( 
							"counselling_period_code"  =>$txtCounsellingPeriodCode,
							"counselling_period_name"  =>$txtCounsellingPeriodName,
							"status"  =>$cmbCounsellingPeriodStatus,
							"record_status" => '1',
							"created_by" => 'SUPADM001',
							"created_on" => $date,
						);
						$sql = $this->db->insert('counselling_period_master',$new_array);
						if(!$sql){
							$dbStatus = "ERROR";
							$dbMessage = "Error Inserting";
						}
					}
					else
					{
						$dbStatus = "ERROR";
						$dbMessage = "Only single Counselling Period should be active";
					}
				}
				else
				{
					$new_array = array( 
						"counselling_period_code"  =>$txtCounsellingPeriodCode,
						"counselling_period_name"  =>$txtCounsellingPeriodName,
						"status"  =>$cmbCounsellingPeriodStatus,
						"record_status" => '1',
						"created_by" => 'SUPADM001',
						"created_on" => $date,
					);
					$sql = $this->db->insert('counselling_period_master',$new_array);
					if(!$sql){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
				}
				
				
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			case 'UPDATE_CounsellingPeriod' :
				
				$institute_code = $this->session->userdata("institute_code");
				$dbStatus = "SUCCESS";
				$dbMessage = "Data Successfully Updated";
				$hidCounsellingPeriod = isset($_POST['hidCounsellingPeriod'])?$_POST['hidCounsellingPeriod']:'';
				$txtCounsellingPeriodName = isset($_POST['txtCounsellingPeriodName'])?$_POST['txtCounsellingPeriodName']:'';
				$cmbCounsellingPeriodStatus = isset($_POST['cmbCounsellingPeriodStatus'])?$_POST['cmbCounsellingPeriodStatus']:'';
				$date = date('Y-m-d H:i:s', now());
				
				if($cmbCounsellingPeriodStatus == 'Active')
	            {
	            	$this->db->select("COUNT(counselling_period_code) as status");
					$this->db->from('counselling_period_master A');
					$this->db->where('status','Active');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
		            	$status = $aRow['status'];
		            }
	            
					if($status == 0)
					{
						$update_data = array(
							"counselling_period_code"  =>$hidCounsellingPeriod,
							"counselling_period_name"  =>$txtCounsellingPeriodName,
							"status"  =>$cmbCounsellingPeriodStatus,
							"updated_by" => 'SUPADM001',
							"updated_on" => $date,
						);
						$this->db->where('counselling_period_code',$hidCounsellingPeriod);
						$sql = $this->db->update('counselling_period_master', $update_data);
						//echo $this->db->last_query();
						if(!$sql){
							$dbStatus = "ERROR";
							$dbMessage = "Error Inserting";
						}
					}
					else
					{
						$dbStatus = "ERROR";
						$dbMessage = "Only single Counselling Period should be active";
					}
				}
				else
				{
					$update_data = array(
						"counselling_period_code"  =>$hidCounsellingPeriod,
						"counselling_period_name"  =>$txtCounsellingPeriodName,
						"status"  =>$cmbCounsellingPeriodStatus,
						"updated_by" => 'SUPADM001',
						"updated_on" => $date,
					);
					$this->db->where('counselling_period_code',$hidCounsellingPeriod);
					$sql = $this->db->update('counselling_period_master', $update_data);
					//echo $this->db->last_query();
					if(!$sql){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
				}
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break;
			
			case 'operation_delete_CounsellingPeriod' :
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Deleted";
				$hidCounsellingPeriod = isset($_POST['hidCounsellingPeriod'])?$_POST['hidCounsellingPeriod']:'';
				$date = date('Y-m-d H:i:s', now());
				
				$this->db->where("counselling_period_code",$hidCounsellingPeriod);
				$update_applicant_relation2 = $this->db->delete('counselling_period_master');
				//echo $this->db->last_query();
				if(!$update_applicant_relation2)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error deleting';
				}
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			//*************************************************  sheet matrix************************************************* 
			
			case 'get_sheetMatrix' :
				$institute_code = $this->input->post('ins');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				//$result1 = $this->db->get();
				$this->db->select("A.ipb_code,B.program_name,C.branch,D.institute_name");
				$this->db->from('counselling_program_branch_institute_mapping A');
				$this->db->join('counselling_program_master B','A.program_code = B.program_code','inner');
				$this->db->join('counselling_branch_master C','A.branch_code = C.branch_code','inner');
				$this->db->join('institute_master D','A.institute_code = D.institute_code','inner');
				$this->db->where('A.record_status','1');
				$this->db->where('B.record_status','1');
				$this->db->where('C.record_status','1');
				$this->db->where('D.record_status','1');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'get_checkAvailability' :
				$institute_code = $this->input->post('ins');
				$ipbCode = isset($_POST['ipbCode'])?$_POST['ipbCode']:'';
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				//$result1 = $this->db->get();
				$this->db->select("category_name,A.no_of_seats AS availability,COUNT(C.appl_no) AS alloted,(A.no_of_seats - COUNT(C.appl_no)) AS vacancy,coalesce(sum(attended),0)as attended");
				$this->db->from('counselling_program_branch_institute_seat_master A');
				$this->db->join('category_master B','A.category_code = B.category_code','left');
				$this->db->join('counselling_applicant_allotment_details C','A.program_code = C.alloted_program AND A.branch_code = C.alloted_branch AND A.institute_code = C.alloted_institute AND A.category_code = C.alloted_seat_category ','left');
				$this->db->join('counselling_applicant_details D','A.category_code=D.category_code and attended=1','left');
				$this->db->where('A.record_status','1');
				$this->db->where('A.ipb_code',$ipbCode);
				//$this->db->where('attended','1');
				$this->db->group_by('B.category_code,A.no_of_seats');
				$result = $this->db->get();
				
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			//************************************************* nodal center setup************************************************* 
			
			case 'select_nodalCentre' :
				$institute_code = $this->input->post('ins');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$user_code = $this->session->userdata('user_code');
				//$result1 = $this->db->get();
				$this->db->select("nodal_centre_code,nodal_centre_name,nodal_centre_address,nodal_centre_capacity,B.user_name,A.nodal_centre_user_code,C.user_name AS attendance_user,A.attendance_user_code");
				$this->db->from('counselling_nodal_centre_master A');
				$this->db->join('user_master B','A.nodal_centre_user_code = B.user_code','left');
				$this->db->join('user_master C','A.attendance_user_code = C.user_code','left');
				$this->db->where('A.record_status','1');
				$this->db->where('B.record_status','1');
				$this->db->where('C.record_status','1');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			case 'select_cmbUserCode' :
				$institute_code = $this->input->post('ins');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				//$result1 = $this->db->get();
				$this->db->select("user_code");
				$this->db->from('counselling_nodal_centre_master');
				$this->db->where('record_status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $user_code[] = $aRow['user_code'];
	            }
				
				//print_r($user_code);
				$user_codes = implode('","', $user_code);
				$users = '"'.$user_codes.'"';
				/*echo $users;
				die();*/
				$this->db->select("user_code,user_name");
				$this->db->from('user_master');
				$this->db->where('record_status','1');
				$this->db->where('role','ADM1');
				//$this->db->where_in('user_code',$users);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'ADD_NODAL_CENTER' :
				$txtCenterCode = isset($_POST['txtCenterCode'])?$_POST['txtCenterCode']:'';
				$txtCenterName = isset($_POST['txtCenterName'])?$_POST['txtCenterName']:'';
				$txtCenterAddress = isset($_POST['txtCenterAddress'])?$_POST['txtCenterAddress']:'';
				$txtCenterCapacity = isset($_POST['txtCenterCapacity'])?$_POST['txtCenterCapacity']:'';
				
				$date = date('Y-m-d H:i:s', now());
				$institute_code = $this->session->userdata("institute_code");
				
				$dbStatus = "SUCCESS";
				$dbMessage = "Data Successfully Inserted";
				
				$cnt = '';
				
				$this->db->where("nodal_centre_code",$txtCenterCode);
				$this->db->select("count(nodal_centre_code) as nodal_centre_code");
				$this->db->from("counselling_nodal_centre_master");
				
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$cnt = $row['nodal_centre_code'];
				}	
				if($cnt == '0')
				{
					$this->db->select("description");
					$this->db->from("gen_code_description");
					$this->db->where("code",'ADMIN_SLNO');
					$this->db->where("code_group",'SL_NO');
					$this->db->where("record_status",'1');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach($output_data as $row)
					{
						$admin_slno = $row['description'];
					}	
					
					if($admin_slno < 10)
						$changed_sl_no = '00'.$admin_slno;
					else if($admin_slno < 100)
						$changed_sl_no = '0'.$admin_slno;
					
					$admin_code = 'NCADM'.$changed_sl_no;
					//$nodal_center_password = SHA2(CONCAT($admin_code,'#','password'),512);
					
					
					
					$this->db->select("description");
					$this->db->from("gen_code_description");
					$this->db->where("code",'ATTENDANCE_SLNO');
					$this->db->where("code_group",'SL_NO');
					$this->db->where("record_status",'1');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach($output_data as $row)
					{
						$attendance_slno = $row['description'];
					}	
					
					if($attendance_slno < 10)
						$changed_sl_no = '00'.$attendance_slno;
					else if($attendance_slno < 100)
						$changed_sl_no = '0'.$attendance_slno;
						
					$attendance_admin_code = 'ATTENDANCE'.$changed_sl_no;
					//$attendance_admin_password = SHA2(CONCAT($attendance_admin_code,'#','password'),512);
					$user = $admin_code.'_'.$institute_code;
					$sql = "INSERT INTO user_master (user_code,employee_name,user_name,enc_password,role,
					institute_code,created_by,created_on) 
					VALUES ('$user','$admin_code','$admin_code',SHA2(CONCAT('$admin_code','#','password'),512),'CENTERADM',
					'$institute_code','SUPADM001','$date')";
					
					
					/*$new_array = array( 
						"user_code"  =>$admin_code.'_'.$institute_code,
						"employee_name"  =>$admin_code,
						"user_name" =>$admin_code,
						"enc_password" => "SHA2(CONCAT($admin_code,'#','password'),512)",
						"role" => 'CENTERADM',
						"institute_code" => $institute_code,
						"created_by" => 'SUPADM001',
						"created_on" => $date,
					);*/
					//$sql = $this->db->insert('user_master',$new_array);
					$sql = $this->db->query($sql);
					if(!$sql){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting Nodal Center Admin";
					}
					
					$usercodee = $attendance_admin_code.'_'.$institute_code;
					$sql = "INSERT INTO user_master (user_code,employee_name,user_name,enc_password,role,
					institute_code,created_by,created_on) 
					VALUES ('$usercodee','$attendance_admin_code','$attendance_admin_code',SHA2(CONCAT('$attendance_admin_code','#','password'),512),'COUNTERADM',
					'$institute_code','SUPADM001','$date')";
					
					/*$new_array = array( 
						"user_code"  =>$attendance_admin_code.'_'.$institute_code,
						"employee_name"  =>$attendance_admin_code,
						"user_name" =>$attendance_admin_code,
						"enc_password" => "SHA2(CONCAT($attendance_admin_code,'#','password'),512)",
						"role" => 'COUNTERADM',
						"institute_code" => $institute_code,
						"created_by" => 'SUPADM001',
						"created_on" => $date,
					);
					
					$sql = $this->db->insert('user_master',$new_array);*/
					
					$sql = $this->db->query($sql);
					if(!$sql){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting Nodal Center Admin";
					}
					
					
					$new_array = array( 
						"nodal_centre_code"  =>$txtCenterCode,
						"nodal_centre_name"  =>$txtCenterName,
						"nodal_centre_address" =>$txtCenterAddress,
						"nodal_centre_capacity" => $txtCenterCapacity,
						"nodal_centre_user_code" => $user,
						"attendance_user_code" => $usercodee,
						"institute_code" => $institute_code,
						"created_by" => 'SUPADM001',
						"created_on" => $date,
					);
					$sql = $this->db->insert('counselling_nodal_centre_master',$new_array);
					if(!$sql){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
					$attendance_slnos = $attendance_slno + 1;
					$update_data = array(
						"description" => $attendance_slnos,
						"updated_by" => 'SUPADM001',
						"updated_on" => $date,
					);
					$this->db->where('code','ATTENDANCE_SLNO');
					$sql = $this->db->update('gen_code_description', $update_data);
					if(!$sql){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
					
					$admin_slnos = $admin_slno + 1;
					$update_data = array(
						"description" => $admin_slnos,
						"updated_by" => 'SUPADM001',
						"updated_on" => $date,
					);
					$this->db->where('code','ADMIN_SLNO');
					$sql = $this->db->update('gen_code_description', $update_data);
					if(!$sql){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
					
					
					
				}
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage,"cnt"=>$cnt);
				return $output;
			break; 
			
			case 'UPDATE_NODAL_CENTER' :
				
				$institute_code = $this->session->userdata("institute_code");
				$dbStatus = "SUCCESS";
				$dbMessage = "Data Successfully Updated";
				$txtCenterCode = isset($_POST['hidNodalCentre'])?$_POST['hidNodalCentre']:'';
				$txtCenterName = isset($_POST['txtCenterName'])?$_POST['txtCenterName']:'';
				$cmbUserCode = isset($_POST['hidUserCode'])?$_POST['hidUserCode']:'';
				$cmbUserCodeEdit = isset($_POST['cmbUserCodeEdit'])?$_POST['cmbUserCodeEdit']:'';
				$txtCenterAddress = isset($_POST['txtCenterAddress'])?$_POST['txtCenterAddress']:'';
				$txtCenterCapacity = isset($_POST['txtCenterCapacity'])?$_POST['txtCenterCapacity']:'';
				$date = date('Y-m-d H:i:s', now());
				$count_checked_element = 0;
				$success_count = 0;
				
				$this->db->where("nodal_centre_code",$txtCenterCode);
				$this->db->select("count(nodal_centre_code) as nodal_centre_code");
				$this->db->from("counselling_nodal_centre_master");
				
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$cnt = $row['nodal_centre_code'];
				}	
				
				if($cnt != '0')
				{
					$update_data = array(
						"nodal_centre_code"  =>$txtCenterCode,
						"nodal_centre_name"  =>$txtCenterName,
						"nodal_centre_address" =>$txtCenterAddress,
						"nodal_centre_capacity" => $txtCenterCapacity,
						"institute_code" => $institute_code,
						"updated_by" => 'SUPADM001',
						"updated_on" => $date,
					);
					$this->db->where('nodal_centre_code',$txtCenterCode);
					$sql = $this->db->update('counselling_nodal_centre_master', $update_data);
					//echo $this->db->last_query();
					if(!$sql){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
				}
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break;
			
			case 'operation_delete_nodal_centre' :
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Deleted";
				$nodal_centre_code=isset($_POST['nodal_centre_code'])?$_POST['nodal_centre_code']:'';
				$user_code=isset($_POST['user_code'])?$_POST['user_code']:'';
				$date = date('Y-m-d H:i:s', now());
				
				$this->db->where("nodal_centre_code",$nodal_centre_code);
				$update_applicant_relation2 = $this->db->delete('counselling_nodal_centre_master');
			//	echo $this->db->last_query();
				if(!$update_applicant_relation2)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error deleting';
				}
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			
			//************************************************* counter setup********************************************************
			
			
			case 'select_Counter' :
				$institute_code = $this->input->post('ins');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				//$result1 = $this->db->get();
				$this->db->select("counter_code,counter_name");
				$this->db->from('counselling_counter_master');
				$this->db->where('record_status','1');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'ADD_COUNTER' :
				$txtCounterCode = isset($_POST['txtCounterCode'])?$_POST['txtCounterCode']:'';
				$txtCounterName = isset($_POST['txtCounterName'])?$_POST['txtCounterName']:'';
				$date = date('Y-m-d H:i:s', now());
				$institute_code = $this->session->userdata("institute_code");
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Inserted";
				
				$this->db->where("counter_code",$txtCounterCode);
				$this->db->select("count(counter_code) as counter_code");
				$this->db->from("counselling_counter_master");
				
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$cnt = $row['counter_code'];
				}
				
				
				if($cnt == '0')
				{
					$new_array = array( 
						"counter_code"  =>$txtCounterCode,
						"counter_name"  =>$txtCounterName,
						"institute_code" => $institute_code,
						"created_by" => 'SUPADM001',
						"created_on" => $date,
					);
					$sql = $this->db->insert('counselling_counter_master',$new_array);
					if(!$sql){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
				}
				else
				{
					$update_data = array(
						"counter_code"  =>$txtCounterCode,
						"counter_name"  =>$txtCounterName,
						"institute_code" => $institute_code,
						"updated_by" => 'SUPADM001',
						"updated_on" => $date,
					);
					$this->db->where('counter_code',$txtCounterCode);
					$sql = $this->db->update('counselling_counter_master', $update_data);
					if(!$sql){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
				}
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			case 'UPDATE_COUNTER' :
				
				$institute_code = $this->session->userdata("institute_code");
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Updated";
				$txtCounterCode = isset($_POST['hidCounter'])?$_POST['hidCounter']:'';
				$txtCounterName = isset($_POST['txtCounterName'])?$_POST['txtCounterName']:'';
				$date = date('Y-m-d H:i:s', now());
				
				$update_data = array(
					"counter_code"  =>$txtCounterCode,
					"counter_name"  =>$txtCounterName,
					"institute_code" => $institute_code,
					"updated_by" => 'SUPADM001',
					"updated_on" => $date,
				);
				$this->db->where('counter_code',$txtCounterCode);
				$sql = $this->db->update('counselling_counter_master', $update_data);
				
				/*echo $this->db->last_query();
				die();*/
				if(!$sql){
					$dbStatus = "ERROR";
					$dbMessage = "Error Inserting";
				}
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break;
			
			case 'operation_delete_counter' :
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Deleted";
				$counter_code=isset($_POST['counter_code'])?$_POST['counter_code']:'';
				$date = date('Y-m-d H:i:s', now());
				
				$this->db->where("counter_code",$counter_code);
				$update_applicant_relation2 = $this->db->delete('counselling_counter_master');
				//echo $this->db->last_query();
				if(!$update_applicant_relation2)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error deleting';
				}
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			//************************************************* FOR NODAL CENTER TO COUNTER MAPPING ************************************
			
			
			case 'select_NodalCounter' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				//$result1 = $this->db->get();
				$this->db->select("A.nodal_centre_code,nodal_centre_name,counter_name,A.counter_code,D.user_name,counter_slno,token_no");
				$this->db->from('counselling_nodal_centre_to_counter_mapping A');
				$this->db->join('counselling_nodal_centre_master B','A.nodal_centre_code = B.nodal_centre_code AND A.institute_code = B.institute_code','left');
				$this->db->join('counselling_counter_master C','A.counter_code = C.counter_code AND A.institute_code = C.institute_code','left');
				$this->db->join('user_master D','D.user_code = A.ver_adm_code','left');
				$this->db->where('A.record_status','1');
				$this->db->where('B.record_status','1');
				$this->db->where('C.record_status','1');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'select_cmbNodalCode' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$user_code = $this->session->userdata('user_code');
				//$result1 = $this->db->get();
				$this->db->select("nodal_centre_code,nodal_centre_name");
				$this->db->from('counselling_nodal_centre_master');
				$this->db->where('record_status','1');
				$this->db->where('institute_code',$institute_code);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'nc_nodal_centre_code' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$user_code = $this->session->userdata('user_code');
				//$result1 = $this->db->get();
				$this->db->select("nodal_centre_code");
				$this->db->from('counselling_nodal_centre_master');
				$this->db->where('record_status','1');
				$this->db->where('institute_code',$institute_code);
				$this->db->where('nodal_centre_user_code',$user_code);
				$query = $this->db->get();
				
        		return $query->result_array();
			break; 
			
			case 'attd_nodal_centre_code' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$user_code = $this->session->userdata('user_code');
				//$result1 = $this->db->get();
				$this->db->select("nodal_centre_code");
				$this->db->from('counselling_nodal_centre_master');
				$this->db->where('record_status','1');
				$this->db->where('institute_code',$institute_code);
				$this->db->where('attendance_user_code',$user_code);
				$query = $this->db->get();
				echo $this->db->last_query();
				die();
				/*echo $this->db->last_query();
				die();*/
        		return $query->result_array();
			break; 
			
			case 'ver_codes' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$user_code = $this->session->userdata('user_code');
				//$result1 = $this->db->get();
				$this->db->select("nodal_centre_code,counter_code");
				$this->db->from('counselling_nodal_centre_to_counter_mapping');
				$this->db->where('record_status','1');
				$this->db->where('institute_code',$institute_code);
				$this->db->where('ver_adm_code',$user_code);
				$query = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
        		return $query->result_array();
			break; 
			
			case 'select_cmbCounterCode' :
				$institute_code = $this->input->post('ins');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				//$result1 = $this->db->get();
				$this->db->select("counter_code,counter_name");
				$this->db->from('counselling_counter_master');
				$this->db->where('record_status','1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'ADD_NodalCounterMapping' :
				$cmbNodalCode = isset($_POST['cmbNodalCode'])?$_POST['cmbNodalCode']:'';
				$cmbCounterCode = isset($_POST['cmbCounterCode'])?$_POST['cmbCounterCode']:'';
				$date = date('Y-m-d H:i:s', now());
				$institute_code = $this->session->userdata("institute_code");
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Inserted";
				
				$cmbCounterCodeSize = sizeof($cmbCounterCode);
				
				for($i = 0;$i < $cmbCounterCodeSize; $i++)
				{
					if($cmbCounterCode[$i] != 'multiselect-all')
					{
						$this->db->where("counter_code",$cmbCounterCode[$i]);
						$this->db->where("nodal_centre_code",$cmbNodalCode);
						$this->db->select("count(counter_code) as counter_code");
						$this->db->from("counselling_nodal_centre_to_counter_mapping");
						
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row)
						{
							$cnt = $row['counter_code'];
						}
						
						
						if($cnt == '0')
						{
							$this->db->select("description");
							$this->db->from("gen_code_description");
							$this->db->where("code",'VERIFICATION_SLNO');
							$this->db->where("code_group",'SL_NO');
							$this->db->where("record_status",'1');
							$result = $this->db->get();
							$output_data = $result->result_array();
							foreach($output_data as $row)
							{
								$verification_slno = $row['description'];
							}	
							
							if($verification_slno < 10)
								$changed_sl_no = '00'.$verification_slno;
							else if($verification_slno < 100)
								$changed_sl_no = '0'.$verification_slno;
								
							$verification_admin_code = 'VER'.$cmbNodalCode.$changed_sl_no;
							//$attendance_admin_password = SHA2(CONCAT($attendance_admin_code,'#','password'),512);
							$user = $verification_admin_code.'_'.$institute_code;
							$sql = "INSERT INTO user_master (user_code,employee_name,user_name,enc_password,role,
							institute_code,created_by,created_on) 
							VALUES ('$user','$verification_admin_code','$verification_admin_code',SHA2(CONCAT('$verification_admin_code','#','password'),512),'VERADM',
							'$institute_code','SUPADM001','$date')";
							
							$sql = $this->db->query($sql);
							if(!$sql){
								$dbStatus = "ERROR";
								$dbMessage = "Error Inserting Nodal Center Admin";
							}
					
							$new_array = array( 
								"nodal_centre_code"  =>$cmbNodalCode,
								"counter_code"  =>$cmbCounterCode[$i],
								"ver_adm_code"  =>$user,
								"institute_code" => $institute_code,
								"created_by" => 'SUPADM001',
								"created_on" => $date,
							);
							$sql = $this->db->insert('counselling_nodal_centre_to_counter_mapping',$new_array);
							if(!$sql){
								$dbStatus = "ERROR";
								$dbMessage = "Error Inserting";
							}
							$verification_slnos = $verification_slno + 1;
							$update_data = array(
								"description" => $verification_slnos,
								"updated_by" => 'SUPADM001',
								"updated_on" => $date,
							);
							$this->db->where('code','VERIFICATION_SLNO');
							$sql = $this->db->update('gen_code_description', $update_data);
							if(!$sql){
								$dbStatus = "ERROR";
								$dbMessage = "Error Inserting";
							}
						}
					}
					/*
					else
					{
						$update_data = array(
							"counter_code"  =>$cmbCounterCode[$i]
							"institute_code" => $institute_code,
							"updated_by" => 'SUPADM001',
							"updated_on" => $date,
						);
						$this->db->where("counter_code",$cmbCounterCode[$i]);
						$this->db->where("nodal_centre_code",$cmbNodalCode);
						$sql = $this->db->update('counselling_nodal_centre_to_counter_mapping', $update_data);
						if(!$sql){
							$dbStatus = "ERROR";
							$dbMessage = "Error Inserting";
						}
					}*/
				}
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			case 'UPDATE_NodalCounterMapping' :
				
				$institute_code = $this->session->userdata("institute_code");
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Updated";
				$cmbNodalCode = isset($_POST['cmbNodalCode'])?$_POST['cmbNodalCode']:'';
				$cmbCounterCode = isset($_POST['cmbCounterCodeEdit'])?$_POST['cmbCounterCodeEdit']:'';
				$hidCounterCode = isset($_POST['hidCounterCode'])?$_POST['hidCounterCode']:'';
				$txtCounterNumber = isset($_POST['txtCounterNumber'])?$_POST['txtCounterNumber']:'';
				$txtTokenNumber = isset($_POST['txtTokenNumber'])?$_POST['txtTokenNumber']:'';
				$date = date('Y-m-d H:i:s', now());
				
				$update_data = array(
					"counter_code"  =>$cmbCounterCode,
					"institute_code" => $institute_code,
					"updated_by" => 'SUPADM001',
					"updated_on" => $date,
				);
				$this->db->where("counter_code",$hidCounterCode);
				$this->db->where("nodal_centre_code",$cmbNodalCode);
				$sql = $this->db->update('counselling_nodal_centre_to_counter_mapping', $update_data);
				if(!$sql){
					$dbStatus = "ERROR";
					$dbMessage = "Error Inserting";
				}
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break;
			
			case 'operation_delete_NodalCounterMapping' :
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Deleted";
				$counter_code=isset($_POST['counter_code'])?$_POST['counter_code']:'';
				$nodal_center_code=isset($_POST['nodal_code'])?$_POST['nodal_code']:'';
				$date = date('Y-m-d H:i:s', now());
				
				$this->db->where("counter_code",$counter_code);
				$this->db->where("nodal_centre_code",$nodal_center_code);
				$update_applicant_relation2 = $this->db->delete('counselling_nodal_centre_to_counter_mapping');
				//echo $this->db->last_query();
				if(!$update_applicant_relation2)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error deleting';
				}
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			//************************************************* FOR COUNSELLING SETUP ************************************
			
			case 'get_counsellingSetup' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				//$result1 = $this->db->get();
				$this->db->select("A.counselling_code,counselling_name,YEAR,sl_no,
						DATE_FORMAT(counselling_start_date,'%d-%m-%Y') AS counselling_start_date,
						DATE_FORMAT(counselling_end_date,'%d-%m-%Y') AS counselling_end_date,publish_status,letter_number,department_name,status,
						online_payment_transaction_no,
						DATE_FORMAT(apply_start_date,'%d-%m-%Y') AS apply_start_date,
						DATE_FORMAT(apply_end_date,'%d-%m-%Y') AS apply_end_date,
						DATE_FORMAT(choice_lock_start_date,'%d-%m-%Y') AS choice_lock_start_date,
						DATE_FORMAT(choice_lock_end_date,'%d-%m-%Y') AS choice_lock_end_date");
				$this->db->from('counselling_master A');
				$this->db->join('counselling_schedule_master B','A.counselling_code = B.counselling_code','left');
				$this->db->where('A.record_status','1');
				$this->db->where('B.record_status','1');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'Add_counselling_setup' :
				$txtProgramCode = isset($_POST['txtProgramCode'])?$_POST['txtProgramCode']:'';
				$txtProgramName = isset($_POST['txtProgramName'])?$_POST['txtProgramName']:'';
				$txtLetterNumber = isset($_POST['txtLetterNumber'])?$_POST['txtLetterNumber']:'';
				$txtDeptName = isset($_POST['txtDeptName'])?$_POST['txtDeptName']:'';
				$txtYear = isset($_POST['txtYear'])?$_POST['txtYear']:'';
				$txtSlno = isset($_POST['txtSlno'])?$_POST['txtSlno']:'100';
				$txtOnlineTransactionNo = isset($_POST['txtOnlineTransactionNo'])?$_POST['txtOnlineTransactionNo']:'100';
				$txtCounsellingDate = isset($_POST['txtCounsellingDate'])?$_POST['txtCounsellingDate']:'';
				$txtAppDate = isset($_POST['txtAppDate'])?$_POST['txtAppDate']:'';
				$txtChoiceLockDate = isset($_POST['txtChoiceLockDate'])?$_POST['txtChoiceLockDate']:'';
				$cmbStatus = isset($_POST['cmbStatus'])?$_POST['cmbStatus']:'';
				$cmbPublishStatus = isset($_POST['cmbPublishStatus'])?$_POST['cmbPublishStatus']:'';
				$date = date('Y-m-d H:i:s', now());
				$institute_code = $this->session->userdata("institute_code");
				
				$arr_apply_date = array();
				$arr_eligible_date = array();
				$arr_program_date = array();
				
				$arr_apply_date = $this->split_string($txtAppDate,'-',3);
				$arr_program_date = $this->split_string($txtCounsellingDate,'-',3);
				$txtCounsellingStartDate = trim($arr_program_date[0]);
				$txtCounsellingEndDate = trim($arr_program_date[1]);
				$txtAppStartdate = trim($arr_apply_date[0]);
				$txtAppEnddate = trim($arr_apply_date[1]);
				
				if($txtChoiceLockDate != '')
				{
					$arr_eligible_date = $this->split_string($txtChoiceLockDate,'-',3);
					$txtChoiceLockStartdate = trim($arr_eligible_date[0]);
					$txtChoiceLockEnddate = trim($arr_eligible_date[1]);
				}
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Inserted";
				
				$new_data = array(
					'counselling_name'						=>$txtProgramName, 
					'year'									=>$txtYear,
					'sl_no'									=>$txtSlno,
					'online_payment_transaction_no'			=>$txtOnlineTransactionNo,
					'publish_status'						=>$cmbPublishStatus,
					'institute_code'						=>$institute_code,
					'created_by'							=>'SUPADM001',
					'created_on'							=>$date
				);
				$this->db->set('counselling_code', 'UUID()',FALSE);
				$insert_user =  $this->db->insert('counselling_master', $new_data);
				if( ! $insert_user){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
						$dbError = mysqli_error($con);	
				}
				
				
				$this->db->select("A.counselling_code");
				$this->db->from('counselling_master A');
				$this->db->where('counselling_name',$txtProgramName);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	            	$txtProgramCode = $aRow['counselling_code'];
	            }
				$new_data = array(
					'counselling_code' 						=>$txtProgramCode,
					'counselling_start_date'				=>date('Y-m-d', strtotime($txtCounsellingStartDate)),
					'counselling_end_date'					=>date('Y-m-d', strtotime($txtCounsellingEndDate)),
					'apply_start_date'						=>date('Y-m-d', strtotime($txtAppStartdate)),
					'apply_end_date'						=>date('Y-m-d', strtotime($txtAppEnddate)),
					'choice_lock_start_date'				=>date('Y-m-d', strtotime($txtChoiceLockStartdate)),
					'choice_lock_end_date'					=>date('Y-m-d', strtotime($txtChoiceLockEnddate)),
					'created_by'							=>'SUPADM001',
					'created_on'							=>$date
				);
				$insert_user =  $this->db->insert('counselling_schedule_master', $new_data);
				if( ! $insert_user){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
						$dbError = mysqli_error($con);	
				}
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			case 'Update_counselling_setup' :
				
				$institute_code = $this->session->userdata("institute_code");
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Updated";
				$date = date('Y-m-d H:i:s', now());
				
				$txtProgramCode = isset($_POST['hidUniqueid'])?$_POST['hidUniqueid']:'';
				$txtProgramName = isset($_POST['txtProgramName'])?$_POST['txtProgramName']:'';
				$txtLetterNumber = isset($_POST['txtLetterNumber'])?$_POST['txtLetterNumber']:'';
				$txtDeptName = isset($_POST['txtDeptName'])?$_POST['txtDeptName']:'';
				$txtYear = isset($_POST['txtYear'])?$_POST['txtYear']:'';
				$txtSlno = isset($_POST['txtSlno'])?$_POST['txtSlno']:'';
				$txtOnlineTransactionNo = isset($_POST['txtOnlineTransactionNo'])?$_POST['txtOnlineTransactionNo']:'';
				$txtCounsellingDate = isset($_POST['txtCounsellingDate'])?$_POST['txtCounsellingDate']:'';
				$txtAppDate = isset($_POST['txtAppDate'])?$_POST['txtAppDate']:'';
				$txtChoiceLockDate = isset($_POST['txtChoiceLockDate'])?$_POST['txtChoiceLockDate']:'';
				$cmbStatus = isset($_POST['cmbStatus'])?$_POST['cmbStatus']:'';
				$cmbPublishStatus = isset($_POST['cmbPublishStatus'])?$_POST['cmbPublishStatus']:'';
				
				$arr_apply_date = array();
				$arr_eligible_date = array();
				$arr_program_date = array();
				
				$arr_apply_date = $this->split_string($txtAppDate,'-',3);
				$arr_program_date = $this->split_string($txtCounsellingDate,'-',3);
				$arr_choice_date = $this->split_string($txtChoiceLockDate,'-',3);
				$txtCounsellingStartDate = trim($arr_program_date[0]);
				$txtCounsellingEndDate = trim($arr_program_date[1]);
				$txtAppStartdate = trim($arr_apply_date[0]);
				$txtAppEnddate = trim($arr_apply_date[1]);
				$txtChoiceStartDate = trim($arr_choice_date[0]);
				$txtChoiceEndDate = trim($arr_choice_date[1]);
				
				$update_data = array(
					'counselling_name'						=>$txtProgramName, 
					'letter_number'							=>$txtLetterNumber,
					'department_name'						=>$txtDeptName,
					'year'									=>$txtYear,
					'sl_no'									=>$txtSlno,
					'status'								=>$cmbStatus,
					'online_payment_transaction_no'			=>$txtOnlineTransactionNo,
					'publish_status'						=>$cmbPublishStatus,
					'institute_code'						=>$institute_code,
					'created_by'							=>'SUPADM001',
					'created_on'							=>$date
				);
				$this->db->where("counselling_code",$txtProgramCode);
				$sql = $this->db->update('counselling_master', $update_data);
				if(!$sql){
					$dbStatus = "ERROR";
					$dbMessage = "Error Updating";
				}
				
				$update_data = array(
					'counselling_start_date'				=>date('Y-m-d', strtotime($txtCounsellingStartDate)),
					'counselling_end_date'					=>date('Y-m-d', strtotime($txtCounsellingEndDate)),
					'apply_start_date'						=>date('Y-m-d', strtotime($txtAppStartdate)),
					'apply_end_date'						=>date('Y-m-d', strtotime($txtAppEnddate)),
					'choice_lock_start_date'				=>date('Y-m-d', strtotime($txtChoiceStartDate)),
					'choice_lock_end_date'					=>date('Y-m-d', strtotime($txtChoiceEndDate)),
					'created_by'							=>'SUPADM001',
					'created_on'							=>$date
				);
				$this->db->where("counselling_code",$txtProgramCode);
				$sql = $this->db->update('counselling_schedule_master', $update_data);
				if(!$sql){
					$dbStatus = "ERROR";
					$dbMessage = "Error Updating";
				}
				
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break;
			
			case 'operation_delete_counsellingSetup' :
				
				$dbStatus = TRUE;
				$dbMessage = "Data Successfully Deleted";
				$counselling_code=isset($_POST['counselling_code'])?$_POST['counselling_code']:'';
				$date = date('Y-m-d H:i:s', now());
				
				$this->db->where("counselling_code",$counselling_code);
				$update_applicant_relation2 = $this->db->delete('counselling_master');
				//echo $this->db->last_query();
				if(!$update_applicant_relation2)
				{
					$dbstatus = FALSE;
					$dbmessage = 'Error deleting';
				}
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			//************************************************* FOR STUDENTS ALLOTMENT ************************************
			
			
			//************************************************* FOR STUDENTS ALLOTMENT ************************************
			
			
			case 'get_counselling_code' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$year=isset($_POST['year'])?$_POST['year']:'';
				//$result1 = $this->db->get();
				$this->db->select("counselling_code,counselling_name");
				$this->db->from('counselling_master');
				$this->db->where('record_status','1');
				$this->db->where('year',$year);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'get_allotment_program' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				//$result1 = $this->db->get();
				$this->db->select("program_code,program_name");
				$this->db->from('counselling_program_master');
				$this->db->where('record_status','1');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'get_allotment_branch' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$program = isset($_POST['program'])?$_POST['program']:'';
				//$result1 = $this->db->get();
				$this->db->select("B.branch_code,A.branch");
				$this->db->from('counselling_branch_master A');
				$this->db->join('counselling_program_branch_mapping B', 'A.branch_code = B.branch_code', 'LEFT');
				$this->db->where('program_code',$program);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'get_counselling_year' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				//$result1 = $this->db->get();
				$this->db->distinct("year");
				$this->db->select("year");
				$this->db->from('counselling_master A');
				$this->db->join('counselling_schedule_master B','A.counselling_code = B.counselling_code','left');
				$this->db->where('counselling_start_date<=',$date);
				$this->db->where('counselling_end_date>=',$date);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'get_generic_year' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				//$result1 = $this->db->get();
				$this->db->select("description");
				$this->db->from('gen_code_description');
				$this->db->where('code_group','YEAR');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'get_verification_dates' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$counselling_code = isset($_POST['counselling_code']) ? $_POST['counselling_code'] : '';
				//$result1 = $this->db->get();
				$this->db->select("apply_start_date,apply_end_date");
				$this->db->from('counselling_schedule_master');
				$this->db->where('counselling_code',$counselling_code);
				$this->db->where('record_status','1');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	            	$start_date = $aRow['apply_start_date'];
	            	$end_date = $aRow['apply_end_date'];
	            }
	           	$output = array("start_date"=>$start_date,"end_date"=>$end_date);
				return $output;
			break; 
			
			case 'get_applicants_allotment_details' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$phoDoc = 0;
				$sigDoc = 0;
        		$counselling_code = isset($_POST['counselling_code']) ? $_POST['counselling_code'] : '';
        		$jee_no = isset($_POST['jee_no']) ? $_POST['jee_no'] : '';
        		$branch = isset($_POST['branch']) ? $_POST['branch'] : '';
        		$program = isset($_POST['program']) ? $_POST['program'] : '';
        		
        		$html = '';
        		$html .= '<table class="table table-bordered" id="tblApplicantDetails">
								<thead>
									<tr>
										<th>
											#
											<input class="Allcheckbox" type="checkbox" id="chkSelectAll" name="chkSelectAll" onclick="allcheck(\'Allcheckbox\',\'checkbox1\')"/>
										</th>
										<th class="text-center">Name</th>
										<th class="text-center">Jee Roll No</th>
										<th class="text-center">Category</th>
									</tr>
								</thead>
								<tbody id="applicantBody">';
        		
        		
        		
        		
				$this->db->select("counselling_code, counselling_name");
				$this->db->from('counselling_master');
				$this->db->where('counselling_code',$counselling_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$counselling_code = $row['counselling_code'];
					$counselling_name = $row['counselling_name'];
	            }
	            
	            
	            
	            $allApplicants = array();
	            if($counselling_code != '')
				{
					//get set up details for selected program and exam center
					
					$this->db->select("A.full_name,A.jee_roll_no,A.category, B.appl_no,C.ipb_code");
					$this->db->from('applicant_detail A');
					$this->db->join('counselling_applicant_appl_overview B','A.jee_roll_no = B.reg_user_id','left');
					$this->db->join('counselling_applicant_choice_details C','A.jee_roll_no = C.reg_user_id','left');
					$this->db->join('counselling_program_branch_institute_mapping D','D.ipb_code = C.ipb_code','left');
					$this->db->where('B.counselling_code',$counselling_code);
					$this->db->where('D.program_code',$program);
					$this->db->where('D.branch_code',$branch);
					$this->db->where('B.appl_status','Choice Locking');
					if($jee_no != '')
					{
						$this->db->where('B.reg_user_id',$jee_no);
					}
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
						$html .= '<td>'.$sl_no.'
								<input type="checkbox" onclick="check()" class="checkbox1" id="chk'.$sl_no.'" name="chkApplicant[]"	value="'.$row['appl_no'].'"@"'.$row['ipb_code'].'"/>
								<td>'.$row['full_name'].'</td>
								<td>'.$row['jee_roll_no'].'</td>
								<td>'.$row['category'].'</td>
								</tr>';
						$sl_no++;
					}
					
				}
	            $html .= '</tbody>
							</table>';
	            return array('html' => $html);
	           
			break;
			
			case 'get_applicants_allotment_details_percentage' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$phoDoc = 0;
				$sigDoc = 0;
        		$counselling_code = isset($_POST['counselling_code']) ? $_POST['counselling_code'] : '';
        		$percentage = isset($_POST['txtPercentage']) ? $_POST['txtPercentage'] : '';
        		$branch = isset($_POST['branch']) ? $_POST['branch'] : '';
        		$program = isset($_POST['program']) ? $_POST['program'] : '';
        		
        		$html = '';
        		$html .= '<table class="table table-bordered" id="tblApplicantDetails">
								<thead>
									<tr>
										<th>
											#
											<input class="Allcheckbox" type="checkbox" id="chkSelectAll" name="chkSelectAll" onclick="allcheck(\'Allcheckbox\',\'checkbox1\')"/>
										</th>
										<th class="text-center">Name</th>
										<th class="text-center">Jee Roll No</th>
										<th class="text-center">Category</th>
									</tr>
								</thead>
								<tbody id="applicantBody">';
        		
        		
        		
        		
				$this->db->select("counselling_code, counselling_name");
				$this->db->from('counselling_master');
				$this->db->where('counselling_code',$counselling_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$counselling_code = $row['counselling_code'];
					$counselling_name = $row['counselling_name'];
	            }
	            
	            /*$this->db->select("SUM(no_of_seats) AS spl_no_of_seats");
				$this->db->from('counselling_special_category_master');
				$result = $this->db->get();
				
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	                $spl_no_of_seats = $row['spl_no_of_seats'];
	            }*/
	            
	            $sum_no_of_seats = 0;
	            $no_of_seats['GEN'] = 0;
	            $no_of_seats['OBC'] = 0;
	            $no_of_seats['SC'] = 0;
	            $no_of_seats['ST'] = 0;
	            $no_of_seats['ph'] = 0;
	            $no_of_seats['ne'] = 0;
	            $this->db->select("category_code,SUM(no_of_seats) AS no_of_seats");
				$this->db->from('counselling_program_branch_institute_seat_master');
				$this->db->group_by('category_code');
				$result = $this->db->get();
				
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	                $no_of_seats[$row['category_code']] = $row['no_of_seats'];
	                $category_code_of_seats = $row['category_code'];
	                $sum_no_of_seats += $row['no_of_seats'];
	            }
	            
	            $percentage = $percentage/100;
	            
	            $applicants_count_gen = $no_of_seats['GEN'] * $percentage;
	            $applicants_count_obc = $no_of_seats['OBC'] * $percentage;
	            $applicants_count_sc = $no_of_seats['SC'] * $percentage;
	            $applicants_count_st = $no_of_seats['ST'] * $percentage;
	            $applicants_count_spl = ($no_of_seats['ph'] + $no_of_seats['ne']) * $percentage;
	            
	            
	            //echo $applicants_count_spl;
		        $sl_no = 1;
	            $allApplicantsGen = array();
	            $allApplicantsOBC = array();
	            $allApplicantsSC = array();
	            $allApplicantsST = array();
	            $allPHNEApplicants = array();
	            if($counselling_code != '')
				{
					//get set up details for selected program and exam center
					$where1 = "(ph = 'YES' OR ne = 'YES')";
					$this->db->select("A.full_name,A.jee_roll_no, B.appl_no,category,C.ipb_code");
					$this->db->from('applicant_detail A');
					$this->db->join('counselling_applicant_appl_overview B','A.jee_roll_no = B.reg_user_id','left');
					$this->db->join('counselling_applicant_choice_details C','A.jee_roll_no = C.reg_user_id','left');
					$this->db->join('counselling_program_branch_institute_mapping D','D.ipb_code = C.ipb_code','left');
					$this->db->where('B.counselling_code',$counselling_code);
					$this->db->where('D.program_code',$program);
					$this->db->where('D.branch_code',$branch);
					$this->db->where($where1);
					$this->db->where('B.appl_status','Choice Locking');
					$this->db->order_by('rank');
					$this->db->limit($applicants_count_spl);
					$result = $this->db->get();
					/*echo $this->db->last_query();
					die();*/
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					foreach ($output_data as $row) 
		            {
		                $allPHNEApplicants[] = $row;
		            }
		            
		            foreach($allPHNEApplicants as $row)
		            {
						if($row['category'] == 'GEN')
						{
							$applicants_count_gen--;
						}
						if($row['category'] == 'OBC')
						{
							$applicants_count_obc--;
						}
						if($row['category'] == 'SC')
						{
							$applicants_count_sc--;
						}
						if($row['category'] == 'ST')
						{
							$applicants_count_st--;
						}
					}
					
		            /*echo $applicants_count_gen;
		            echo $applicants_count_obc;
		            echo $applicants_count_sc;
		            echo $applicants_count_st;*/
		            //$applicants_count_gen = $applicants_count_gen - $applicants_count_spl;
		            if($applicants_count_gen > 0)
		            {
						$where2 = "(ph != 'YES' AND ne != 'YES')";
			            $this->db->select("A.full_name,A.jee_roll_no, B.appl_no,category,C.ipb_code");
						$this->db->from('applicant_detail A');
						$this->db->join('counselling_applicant_appl_overview B','A.jee_roll_no = B.reg_user_id','left');
						$this->db->join('counselling_applicant_choice_details C','A.jee_roll_no = C.reg_user_id','left');
						$this->db->join('counselling_program_branch_institute_mapping D','D.ipb_code = C.ipb_code','left');
						$this->db->where('B.counselling_code',$counselling_code);
						$this->db->where('D.program_code',$program);
						$this->db->where('D.branch_code',$branch);
						$this->db->where($where2);
						$this->db->where('B.appl_status','Choice Locking');
						$this->db->order_by('rank');
						$this->db->limit($applicants_count_gen);
						$result = $this->db->get();
						/*echo $this->db->last_query();
						die();*/
						$output_data = $result->result_array();
						$output = array("aaData" => array());
						foreach ($output_data as $row) 
			            {
			                $allApplicantsGen[] = $row;
			            }
			            	//$allApplicantsGen =  implode(',',$allApplicantsGen);
			           	$x = 0;
			           	foreach($allApplicantsGen as $row)
			           	{
			           		$applicants[] = $allApplicantsGen[$x]['jee_roll_no'];
							$x++;
						}
						$applicants = implode(',',$applicants);
						$applicants = str_replace(',',"','",$applicants);
					}
		            
		            
		           
		           
		            if($applicants_count_obc > 0)
		            {
			            $where2 = "category = 'OBC' AND (ph != 'YES' AND ne != 'YES')";
			            $where3 = "";
			            $this->db->select("A.full_name,A.jee_roll_no, B.appl_no,category,C.ipb_code");
						$this->db->from('applicant_detail A');
						$this->db->join('counselling_applicant_appl_overview B','A.jee_roll_no = B.reg_user_id','left');
						$this->db->join('counselling_applicant_choice_details C','A.jee_roll_no = C.reg_user_id','left');
						$this->db->join('counselling_program_branch_institute_mapping D','D.ipb_code = C.ipb_code','left');
						$this->db->where('B.counselling_code',$counselling_code);
						$this->db->where('D.program_code',$program);
						$this->db->where('D.branch_code',$branch);
						$this->db->where($where2);
						//$this->db->where_not_in($applicants);
						$this->db->where('B.appl_status','Choice Locking');
						$this->db->order_by('rank');
						$this->db->limit($applicants_count_obc);
						$result = $this->db->get();
						/*echo $this->db->last_query();
						die();*/
						$output_data = $result->result_array();
						$output = array("aaData" => array());
						foreach ($output_data as $row) 
			            {
			                $allApplicantsOBC[] = $row;
			            }
			        }
		            
		            if($applicants_count_sc > 0)
		            {
			            $where2 = "category = 'SC' AND (ph != 'YES' AND ne != 'YES')";
			            $this->db->select("A.full_name,A.jee_roll_no, B.appl_no,category,C.ipb_code");
						$this->db->from('applicant_detail A');
						$this->db->join('counselling_applicant_appl_overview B','A.jee_roll_no = B.reg_user_id','left');
						$this->db->join('counselling_applicant_choice_details C','A.jee_roll_no = C.reg_user_id','left');
						$this->db->join('counselling_program_branch_institute_mapping D','D.ipb_code = C.ipb_code','left');
						$this->db->where('B.counselling_code',$counselling_code);
						$this->db->where('D.program_code',$program);
						$this->db->where('D.branch_code',$branch);
						$this->db->where($where2);
						$this->db->where('B.appl_status','Choice Locking');
						$this->db->order_by('rank');
						$this->db->limit($applicants_count_sc);
						$result = $this->db->get();
						/*echo $this->db->last_query();
						die();*/
						$output_data = $result->result_array();
						$output = array("aaData" => array());
						foreach ($output_data as $row) 
			            {
			                $allApplicantsSC[] = $row;
			            }
			        }
		            
		            if($applicants_count_st > 0)
		            {
			            $where2 = "category = 'ST' AND (ph != 'YES' AND ne != 'YES')";
			            $this->db->select("A.full_name,A.jee_roll_no, B.appl_no,category,C.ipb_code");
						$this->db->from('applicant_detail A');
						$this->db->join('counselling_applicant_appl_overview B','A.jee_roll_no = B.reg_user_id','left');
						$this->db->join('counselling_applicant_choice_details C','A.jee_roll_no = C.reg_user_id','left');
						$this->db->join('counselling_program_branch_institute_mapping D','D.ipb_code = C.ipb_code','left');
						$this->db->where('B.counselling_code',$counselling_code);
						$this->db->where('D.program_code',$program);
						$this->db->where('D.branch_code',$branch);
						$this->db->where($where2);
						$this->db->where('B.appl_status','Choice Locking');
						$this->db->order_by('rank');
						$this->db->limit($applicants_count_st);
						$result = $this->db->get();
						/*echo $this->db->last_query();
						die();*/
						$output_data = $result->result_array();
						$output = array("aaData" => array());
						foreach ($output_data as $row) 
			            {
			                $allApplicantsST[] = $row;
			            }
			        }
		            
		            $style= '';
		            //print_r($allPHNEApplicants);
		            foreach($allPHNEApplicants as $row)
					{
						
						$html .= '<tr'.$style.'>';
								$s = ($style == '' ? ' checked ' : '');
						$html .= '<td>'.$sl_no.'
								<input type="checkbox" class="checkbox1" disabled id="chk'.$sl_no.'" name="chkApplicant[]" checked	value="'.$row['appl_no'].'@'.$row['ipb_code'].'"/>
								<td>'.$row['full_name'].'</td>
								<td>'.$row['jee_roll_no'].'</td>
								<td>'.$row['category'].'</td>
								</tr>';
						$sl_no++;
					}
					foreach($allApplicantsGen as $row)
					{
						$html .= '<tr'.$style.'>';
								$s = ($style == '' ? ' checked ' : '');
						$html .= '<td>'.$sl_no.'
								<input type="checkbox" class="checkbox1" disabled id="chk'.$sl_no.'" name="chkApplicant[]" checked	value="'.$row['appl_no'].'@'.$row['ipb_code'].'"/>
								<td>'.$row['full_name'].'</td>
								<td>'.$row['jee_roll_no'].'</td>
								<td>'.$row['category'].'</td>
								</tr>';
						$sl_no++;
					}
					foreach($allApplicantsOBC as $row)
					{
						$html .= '<tr'.$style.'>';
								$s = ($style == '' ? ' checked ' : '');
						$html .= '<td>'.$sl_no.'
								<input type="checkbox" class="checkbox1" disabled id="chk'.$sl_no.'" name="chkApplicant[]" checked	value="'.$row['appl_no'].'"/>
								<td>'.$row['full_name'].'</td>
								<td>'.$row['jee_roll_no'].'</td>
								<td>'.$row['category'].'</td>
								</tr>';
						$sl_no++;
					}
					foreach($allApplicantsSC as $row)
					{
						$html .= '<tr'.$style.'>';
								$s = ($style == '' ? ' checked ' : '');
						$html .= '<td>'.$sl_no.'
								<input type="checkbox" class="checkbox1" disabled id="chk'.$sl_no.'" name="chkApplicant[]" checked	value="'.$row['appl_no'].'"/>
								<td>'.$row['full_name'].'</td>
								<td>'.$row['jee_roll_no'].'</td>
								<td>'.$row['category'].'</td>
								</tr>';
						$sl_no++;
					}
					foreach($allApplicantsST as $row)
					{
						$html .= '<tr'.$style.'>';
								$s = ($style == '' ? ' checked ' : '');
						$html .= '<td>'.$sl_no.'
								<input type="checkbox" class="checkbox1" disabled id="chk'.$sl_no.'" name="chkApplicant[]" checked	value="'.$row['appl_no'].'"/>
								<td>'.$row['full_name'].'</td>
								<td>'.$row['jee_roll_no'].'</td>
								<td>'.$row['category'].'</td>
								</tr>';
						$sl_no++;
					}
					
				}
	            $html .= '</tbody>
							</table>';
	            return array('html' => $html);
	           
			break;
			
			case 'get_centre_capacity' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$nodal_centre_code = isset($_POST['nodal_center_code']) ? $_POST['nodal_center_code'] : '';
				//$result1 = $this->db->get();
				$this->db->select("nodal_centre_capacity,COUNT(B.reg_user_id) AS no_of_assign");
				$this->db->from('counselling_nodal_centre_master A');
				$this->db->join('counselling_applicant_details B','A.nodal_centre_code = B.nodal_centre_code','LEFT');
				$this->db->where('A.nodal_centre_code',$nodal_centre_code);
				$this->db->where('A.record_status','1');
				$this->db->group_by('nodal_centre_capacity');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'assign_applicants_centre': 
            	$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
            	$dbstatus = '';
            	
            	$counselling_code = isset($_POST['counselling_code']) ? $_POST['counselling_code'] : '';
            	$nodalCenter = isset($_POST['nodalCenter']) ? $_POST['nodalCenter'] : '';
            	$verificationDate = isset($_POST['verificationDate']) ? $_POST['verificationDate'] : '';
            	$txtFromDate = isset($_POST['txtFromDate']) ? $_POST['txtFromDate'] : '';
            	$txtToDate = isset($_POST['txtToDate']) ? $_POST['txtToDate'] : '';
			 	$arr_sel_applicants = $_POST['chkApplicant'];
			 	$verificationDate = date("Y-m-d", strtotime($verificationDate) );
			 	$txtFromDate = date("Y-m-d", strtotime($txtFromDate) );
			 	$txtToDate = date("Y-m-d", strtotime($txtToDate) );
			 	/*echo $verificationDate;
			 	die();*/
			 	
				$this->db->select("counselling_name, counselling_code");
				$this->db->from('counselling_master');
				$this->db->where('counselling_code',$counselling_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$counselling_code = $row['counselling_code'];
					$counselling_name = $row['counselling_name'];
	            }
	            
	            
	            
				foreach($arr_sel_applicants as $appl_no)
				{
					$applicants = explode("@",$appl_no);
					$appl_no = $applicants[0];
					$ipb_code = $applicants[1];
					
		            $this->db->select("reg_user_id");
					$this->db->from('counselling_applicant_appl_overview');
					$this->db->where('counselling_code',$counselling_code);
					$this->db->where('appl_no',$appl_no);
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					foreach ($output_data as $row) 
		            {
		            	$reg_user_id = $row['reg_user_id'];
		            }
		            
		            $this->db->select("category");
					$this->db->from('applicant_detail');
					$this->db->where('jee_roll_no',$reg_user_id);
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					foreach ($output_data as $row) 
		            {
		            	$category_code = $row['category'];
		            }
		            
		            $this->db->select("document_type_code");
					$this->db->from('counselling_document_setup');
					$this->db->where('counselling_code',$counselling_code);
	       			$where = '(record_status = "Active" OR record_status="1")';
	       			$this->db->where($where);
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					$documentsReq = array();
					foreach ($output_data as $row) 
		            {
		            	$documentsReq[] = $row;
		            }
		            foreach($documentsReq as $row)
					{
						if(in_array('SIG',$row))
						{
							$sigDoc = 1;
							//echo $sigDoc;
						}
						if(in_array('PHO',$row))
						{
							$phoDoc = 1;
							//echo $sigDoc;
						}
					}
					$new_data = array(
						'reg_user_id' 						=>$reg_user_id,
						'appl_no' 							=>$appl_no,
						'ipb_code' 							=>$ipb_code,
						'category_code' 					=>$category_code,
						'nodal_centre_code' 				=>$nodalCenter,
						'verification_date' 				=>$verificationDate,
						'from_date' 						=>$txtFromDate,
						'to_date' 							=>$txtToDate,
						'created_by' 						=>$user,
						'created_on' 						=>$date,
						'record_status'						=>'1'
					);
								
					$sql = $this->db->insert('counselling_applicant_details', $new_data);
					/*echo $this->db->last_query();
					die();*/
					if(!$sql){
						$dbstatus = "ERROR";
						$dbMessage = "Error Updating";
					}
					
					
					$update_data = array(
						'appl_status'							=>'Alloted',
						'updated_by'							=>$user,
						'created_on'							=>$date
					);
					$this->db->where("reg_user_id",$reg_user_id);
					$sql = $this->db->update('counselling_applicant_appl_overview', $update_data);
					if(!$sql){
						$dbstatus = "ERROR";
						$dbMessage = "Error Updating";
					}
					
					if($dbstatus != "ERROR")
					{
						$this->db->select('jee_roll_no, first_name, mid_name, last_name, dob, applicant_email, applicant_mobile, gender, category');
						$this->db->from('applicant_detail');
						$this->db->where('jee_roll_no',$reg_user_id);
						$result = $this->db->get();
						//echo $this->db->last_query();die();
						$query = $result->result_array();
						$present = 0;
						foreach($result->result_array() AS $row1)
						{
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
					
						$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
						$this->db->from('sms_provider_setup A');
						$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
						//$this->db->where('C.program_code',$program_code);
						$this->db->where('B.record_status','1');
						$this->db->where('B.sms_type','STUDENT ALLOTMENT');
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
							$new_content = $content;
							$messageToSend = urlencode($new_content);
							//find replace url with mobileno and message
							$findmobileNo = array("[mobileno]","[message]");
							$replacemobileNo = array($mobile_no,$messageToSend);
							$smsURL = str_replace($findmobileNo,$replacemobileNo,$new_sms_url);	
				        }
				        $result =  file_get_contents($smsURL);
				        $ch = curl_init($smsURL );
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$result = curl_exec($ch);
						curl_close($ch);
					}
					
				}
	           	$output = array('status'=>$dbstatus);
	           	
	           	return $output; 
			break;
			
			//************************************************* FOR STUDENTS ATTENDANCE ************************************
			
			case 'get_applicants_attendance_details' :
				$institute_code = $this->session->userdata('institute_code');
				$user_code = $this->session->userdata('user_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$phoDoc = 0;
				$sigDoc = 0;
        		$counselling_code = isset($_POST['counselling_code']) ? $_POST['counselling_code'] : '';
        		$nodal_centre_code = isset($_POST['nodal_centre_code']) ? $_POST['nodal_centre_code'] : '';
        		$jee_no = isset($_POST['jee_no']) ? $_POST['jee_no'] : '';
        		$veification_date = isset($_POST['veification_date']) ? $_POST['veification_date'] : '';
        		$verificationDate = date("Y-m-d", strtotime($veification_date) );
        		
        		$html = '';
        		$html .= '<table class="table table-bordered" id="tblApplicantDetails">
								<thead>
									<tr>
										<th class="text-center">Sl No</th>
										<th class="text-center">Jee Roll No</th>
										<th class="text-center">Name</th>
										<th>
											<input class="Allcheckbox" type="checkbox" id="chkSelectAll" name="chkSelectAll" onclick="allcheck(\'Allcheckbox\',\'checkbox1\')"/>
											&nbsp;&nbsp;Attendance
										</th>
										<th class="text-center">Token</th>
										<th class="text-center">Counter Name</th>
										<th class="text-center">Assign</th>
									</tr>
								</thead>
								<tbody id="applicantBody">';
        		
        		
        		
        		
				$this->db->select("counselling_code, counselling_name");
				$this->db->from('counselling_master');
				$this->db->where('counselling_code',$counselling_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$counselling_code = $row['counselling_code'];
					$counselling_name = $row['counselling_name'];
	            }
	            
	            
	            
	            $allApplicants = array();
	            if($counselling_code != '')
				{
					//get set up details for selected program and exam center
					$this->db->select("A.counter_code,counter_name");
					$this->db->from('counselling_counter_master A');
					$this->db->join('counselling_nodal_centre_to_counter_mapping B','A.counter_code = B.counter_code','LEFT');
					$this->db->where('B.nodal_centre_code',$nodal_centre_code);
					$this->db->where('A.record_status','1');
					$result = $this->db->get();
					/*echo $this->db->last_query();
					die();*/
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					$slno = 1;
					foreach ($output_data as $aRow) 
		            {
		                $counters[] = $aRow;
		            }
	            
					$this->db->select("full_name,jee_roll_no,A. appl_no,A.token_no");
					$this->db->from('counselling_applicant_details A');
					$this->db->join('applicant_detail B','A.reg_user_id = B.jee_roll_no','left');
					$this->db->join('counselling_applicant_appl_overview C','A.reg_user_id = C.reg_user_id AND A.appl_no = C.appl_no','left');
					$this->db->where('counselling_code',$counselling_code);
					$this->db->where('nodal_centre_code',$nodal_centre_code);
					$this->db->where('verification_date',$verificationDate);
					$this->db->where('A.attended','0');
					if($jee_no != '')
					{
						$this->db->where('B.jee_roll_no',$jee_no);
					}
					$result = $this->db->get();
					/*echo $this->db->last_query();
					die();*/
					
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
						$html .= '<td>'.$sl_no.'</td>
								<td>'.$row['jee_roll_no'].'</td>
								<td>'.$row['full_name'].'</td>
								<td><input type="checkbox" onclick="check(\''.$sl_no.'\')" class="checkbox1" id="chk'.$sl_no.'" name="chkApplicant[]"	value="'.$row['jee_roll_no'].'"/></td>
								<td><span id="spanNowAssign'.$row['jee_roll_no'].'"></span></td>
					                    	
								<td><select class="form-control tooltips" name="cmbStatus[]" id="cmbStatus">
									<option value = "">Select Counter</option>';
								foreach($counters as $row1)
								{
									$html .='<option value='.$row1['counter_code'].'>'.$row1['counter_name'].'</option>';
								}
						$html .='</td>
								<td><button type="button" class="btn btn-info tooltipTable" onclick="rowCheckList(event)" title="Verify"><i class="fa fa-check">&nbsp;Assign</i></button></td>
								</tr>';
						$sl_no++;
					}
					
				}
	            $html .= '</tbody>
							</table>';
	            return array('html' => $html);
	           
			break;
			
			case 'get_assigned_counter_details' :
				$institute_code = $this->session->userdata('institute_code');
				$user_code = $this->session->userdata('user_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$nodal_centre_code = isset($_POST['nodal_centre_code']) ? $_POST['nodal_centre_code'] : '';
        		$veification_date = isset($_POST['veification_date']) ? $_POST['veification_date'] : '';
        		$verificationDate = date("Y-m-d", strtotime($veification_date) );
        		$phoDoc = 0;
				$sigDoc = 0;
        		
        		$html = '';
        		$html .= '<table class="table table-bordered" id="tblCounterApplicantDetails">
								<thead>
									<tr>
										<th class="text-center">Counters</th>
										<th class="text-center">Assigned</th>
									</tr>
								</thead>
								<tbody id="counterApplicantDetailsBody">';
        		
	            $allApplicants = array();
				//get set up details for selected program and exam center
				
				$this->db->select("A.counter_name,A.counter_code,COUNT(B.counter_code) AS assigned");
				$this->db->from('counselling_counter_master A');
				$this->db->join('counselling_applicant_details B',"A.counter_code = B.counter_code",'left');
				$this->db->join('counselling_nodal_centre_to_counter_mapping C',"A.counter_code = C.counter_code",'left');
				$this->db->where('C.nodal_centre_code',$nodal_centre_code);
				$this->db->where('B.verification_date',$verificationDate);
				$this->db->group_by('counter_code');
				//$this->db->_protect_identifiers=false;
				$result = $this->db->get();
				//echo $this->db->last_query();
				
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
					
					$html .= '<tr>';
					$html .= '<td>'.$row['counter_name'].'</td>
							<td>'.$row['assigned'].'</td>
							</tr>';
					$sl_no++;
				}
	            $html .= '</tbody>
							</table>';
	            return array('html' => $html);
	           
			break;
			
			case 'get_counter_name' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$nodal_centre_code = isset($_POST['nodal_center_code']) ? $_POST['nodal_center_code'] : '';
        		
				//$result1 = $this->db->get();
				$this->db->select("A.counter_code,counter_name");
				$this->db->from('counselling_counter_master A');
				$this->db->join('counselling_nodal_centre_to_counter_mapping B','A.counter_code = B.counter_code','LEFT');
				$this->db->where('B.nodal_centre_code',$nodal_centre_code);
				$this->db->where('A.record_status','1');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'assign_applicants_attendance': 
            	$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
            	$dbstatus = '';
            	
            	$counselling_code = isset($_POST['counselling_code']) ? $_POST['counselling_code'] : '';
            	$nodalCenter = isset($_POST['nodalCenter']) ? $_POST['nodalCenter'] : '';
            	$counter_code = isset($_POST['counter_code']) ? $_POST['counter_code'] : '';
			 	$arr_sel_applicants = $_POST['regn_no'];
			 	$veification_date = isset($_POST['veification_date']) ? $_POST['veification_date'] : '';
        		$verificationDate = date("Y-m-d", strtotime($veification_date) );
			 	/*echo $arr_sel_applicants;
			 	die();*/
			 	
				$this->db->select("counselling_name, counselling_code");
				$this->db->from('counselling_master');
				$this->db->where('counselling_code',$counselling_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$counselling_code = $row['counselling_code'];
					$counselling_name = $row['counselling_name'];
	            }
	            
	            /*$this->db->select("appl_no");
				$this->db->from('counselling_applicant_appl_overview');
				$this->db->where('appl_no',$nodalCenter);
				$this->db->where('counter_code',$counter_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$counter_slno = $row['counter_slno'];
					$token_no = $row['token_no'];
	            }*/
	            
	            $this->db->select("count(*) as token");
				$this->db->from('counselling_applicant_details');
				$this->db->where('verification_date',$verificationDate);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$token = $row['token'];
	            }
	            
            	$reg_user_id = $arr_sel_applicants;
				$update_data = array(
					'counter_code'							=>$counter_code,
					'attended'								=>'1',
					'updated_by'							=>$user,
					'updated_on'							=>$date
				);
				$this->db->where("reg_user_id",$reg_user_id);
				$sql = $this->db->update('counselling_applicant_details', $update_data);
				if(!$sql){
					$dbstatus = "ERROR";
					$dbMessage = "Error Updating";
				}
				
				/*$token_no1 = $token + 1;
				$update_data = array(
					'token_no'								=>$token_no1,
					'updated_by'							=>$logged_user,
					'updated_on'							=>$date
				);
				$this->db->where("nodal_centre_code",$nodalCenter);
				$this->db->where("counter_code",$counter_code);
				$sql = $this->db->update('counselling_nodal_centre_to_counter_mapping', $update_data);
				if(!$sql){
					$dbstatus = "ERROR";
					$dbMessage = "Error Updating";
				}
				
				$update_data = array(
					'token_no'								=>$token_no1,
					'updated_by'							=>$logged_user,
					'updated_on'							=>$date
				);
				$this->db->where("reg_user_id",$reg_user_id);
				$sql = $this->db->update('counselling_applicant_details', $update_data);
				if(!$sql){
					$dbstatus = "ERROR";
					$dbMessage = "Error Updating";
				}*/
	           	$output = array('status'=>$dbstatus);
	           	
	           	return $output; 
			break;
			
			case 'get_token_no': 
            	$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
            	$dbstatus = '';
            	$reg_user_id = $_POST['reg_user_id'];
            	$veification_date = isset($_POST['veification_date']) ? $_POST['veification_date'] : '';
        		$verificationDate = date("Y-m-d", strtotime($veification_date) );
	            
	            $this->db->select("count(token_no) as token");
				$this->db->from('counselling_applicant_details');
				$this->db->where('verification_date',$verificationDate);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$token = $row['token'];
	            }
				
				$token_no1 = $token + 1;
				
				$update_data = array(
					'token_no'								=>$token_no1,
					'updated_by'							=>$user,
					'updated_on'							=>$date
				);
				$this->db->where("reg_user_id",$reg_user_id);
				$sql = $this->db->update('counselling_applicant_details', $update_data);
				if(!$sql){
					$dbstatus = "ERROR";
					$dbMessage = "Error Updating";
				}
				
	           	$output = array('token'=>$token_no1);
	           	
	           	return $output; 
			break;
			
			case 'change_token_no': 
            	$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
            	$dbstatus = '';
            	$reg_user_id = $_POST['reg_user_id'];
            	$veification_date = isset($_POST['veification_date']) ? $_POST['veification_date'] : '';
        		$verificationDate = date("Y-m-d", strtotime($veification_date) );
	            
	           
				
				$update_data = array(
					'token_no'								=>NULL,
					'updated_by'							=>$user,
					'updated_on'							=>$date
				);
				$this->db->where("reg_user_id",$reg_user_id);
				$sql = $this->db->update('counselling_applicant_details', $update_data);
				if(!$sql){
					$dbstatus = "ERROR";
					$dbMessage = "Error Updating";
				}
				
	           	$output = array('token'=>'0');
	           	
	           	return $output; 
			break;
			
			//************************************************* FOR STUDENTS ATTENDANCE ************************************
			
			case 'get_applicants_attendance_details' :
				$institute_code = $this->session->userdata('institute_code');
				$user_code = $this->session->userdata('user_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$phoDoc = 0;
				$sigDoc = 0;
        		$counselling_code = isset($_POST['counselling_code']) ? $_POST['counselling_code'] : '';
        		$nodal_centre_code = isset($_POST['nodal_centre_code']) ? $_POST['nodal_centre_code'] : '';
        		$jee_no = isset($_POST['jee_no']) ? $_POST['jee_no'] : '';
        		$veification_date = isset($_POST['veification_date']) ? $_POST['veification_date'] : '';
        		$verificationDate = date("Y-m-d", strtotime($veification_date) );
        		
        		$html = '';
        		$html .= '<table class="table table-bordered" id="tblApplicantDetails">
								<thead>
									<tr>
										<th class="text-center">Sl No</th>
										<th class="text-center">Jee Roll No</th>
										<th class="text-center">Name</th>
										<th>
											<input class="Allcheckbox" type="checkbox" id="chkSelectAll" name="chkSelectAll" onclick="allcheck(\'Allcheckbox\',\'checkbox1\')"/>
											&nbsp;&nbsp;Attendance
										</th>
										<th class="text-center">Token</th>
										<th class="text-center">Counter Name</th>
										<th class="text-center">Assign</th>
									</tr>
								</thead>
								<tbody id="applicantBody">';
        		
        		
        		
        		
				$this->db->select("counselling_code, counselling_name");
				$this->db->from('counselling_master');
				$this->db->where('counselling_code',$counselling_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$counselling_code = $row['counselling_code'];
					$counselling_name = $row['counselling_name'];
	            }
	            
	            
	            
	            $allApplicants = array();
	            if($counselling_code != '')
				{
					//get set up details for selected program and exam center
					$this->db->select("A.counter_code,counter_name");
					$this->db->from('counselling_counter_master A');
					$this->db->join('counselling_nodal_centre_to_counter_mapping B','A.counter_code = B.counter_code','LEFT');
					$this->db->where('B.nodal_centre_code',$nodal_centre_code);
					$this->db->where('A.record_status','1');
					$result = $this->db->get();
					/*echo $this->db->last_query();
					die();*/
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					$slno = 1;
					foreach ($output_data as $aRow) 
		            {
		                $counters[] = $aRow;
		            }
	            
					$this->db->select("full_name,jee_roll_no,A. appl_no,A.token_no");
					$this->db->from('counselling_applicant_details A');
					$this->db->join('applicant_detail B','A.reg_user_id = B.jee_roll_no','left');
					$this->db->join('counselling_applicant_appl_overview C','A.reg_user_id = C.reg_user_id AND A.appl_no = C.appl_no','left');
					$this->db->where('counselling_code',$counselling_code);
					$this->db->where('nodal_centre_code',$nodal_centre_code);
					$this->db->where('verification_date',$verificationDate);
					$this->db->where('A.attended','0');
					if($jee_no != '')
					{
						$this->db->where('B.jee_roll_no',$jee_no);
					}
					$result = $this->db->get();
					/*echo $this->db->last_query();
					die();*/
					
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
						$html .= '<td>'.$sl_no.'</td>
								<td>'.$row['jee_roll_no'].'</td>
								<td>'.$row['full_name'].'</td>
								<td><input type="checkbox" onclick="check(\''.$sl_no.'\')" class="checkbox1" id="chk'.$sl_no.'" name="chkApplicant[]"	value="'.$row['jee_roll_no'].'"/></td>
								<td><span id="spanNowAssign'.$row['jee_roll_no'].'"></span></td>
					                    	
								<td><select class="form-control tooltips" name="cmbStatus[]" id="cmbStatus">
									<option value = "">Select Counter</option>';
								foreach($counters as $row1)
								{
									$html .='<option value='.$row1['counter_code'].'>'.$row1['counter_name'].'</option>';
								}
						$html .='</td>
								<td><button type="button" class="btn btn-info tooltipTable" onclick="rowCheckList(event)" title="Verify"><i class="fa fa-check">&nbsp;Assign</i></button></td>
								</tr>';
						$sl_no++;
					}
					
				}
	            $html .= '</tbody>
							</table>';
	            return array('html' => $html);
	           
			break;
			
			case 'get_assigned_counter_details' :
				$institute_code = $this->session->userdata('institute_code');
				$user_code = $this->session->userdata('user_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$nodal_centre_code = isset($_POST['nodal_centre_code']) ? $_POST['nodal_centre_code'] : '';
        		$veification_date = isset($_POST['veification_date']) ? $_POST['veification_date'] : '';
        		$verificationDate = date("Y-m-d", strtotime($veification_date) );
        		$phoDoc = 0;
				$sigDoc = 0;
        		
        		$html = '';
        		$html .= '<table class="table table-bordered" id="tblCounterApplicantDetails">
								<thead>
									<tr>
										<th class="text-center">Counters</th>
										<th class="text-center">Assigned</th>
									</tr>
								</thead>
								<tbody id="counterApplicantDetailsBody">';
        		
	            $allApplicants = array();
				//get set up details for selected program and exam center
				
				$this->db->select("A.counter_name,A.counter_code,COUNT(B.counter_code) AS assigned");
				$this->db->from('counselling_counter_master A');
				$this->db->join('counselling_applicant_details B',"A.counter_code = B.counter_code",'left');
				$this->db->join('counselling_nodal_centre_to_counter_mapping C',"A.counter_code = C.counter_code",'left');
				$this->db->where('C.nodal_centre_code',$nodal_centre_code);
				$this->db->where('B.verification_date',$verificationDate);
				$this->db->group_by('counter_code');
				//$this->db->_protect_identifiers=false;
				$result = $this->db->get();
				//echo $this->db->last_query();
				
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
					
					$html .= '<tr>';
					$html .= '<td>'.$row['counter_name'].'</td>
							<td>'.$row['assigned'].'</td>
							</tr>';
					$sl_no++;
				}
	            $html .= '</tbody>
							</table>';
	            return array('html' => $html);
	           
			break;
			
			case 'get_counter_name' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$nodal_centre_code = isset($_POST['nodal_center_code']) ? $_POST['nodal_center_code'] : '';
        		
				//$result1 = $this->db->get();
				$this->db->select("A.counter_code,counter_name");
				$this->db->from('counselling_counter_master A');
				$this->db->join('counselling_nodal_centre_to_counter_mapping B','A.counter_code = B.counter_code','LEFT');
				$this->db->where('B.nodal_centre_code',$nodal_centre_code);
				$this->db->where('A.record_status','1');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'assign_applicants_attendance': 
            	$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
            	$dbstatus = '';
            	
            	$counselling_code = isset($_POST['counselling_code']) ? $_POST['counselling_code'] : '';
            	$nodalCenter = isset($_POST['nodalCenter']) ? $_POST['nodalCenter'] : '';
            	$counter_code = isset($_POST['counter_code']) ? $_POST['counter_code'] : '';
			 	$arr_sel_applicants = $_POST['regn_no'];
			 	$veification_date = isset($_POST['veification_date']) ? $_POST['veification_date'] : '';
        		$verificationDate = date("Y-m-d", strtotime($veification_date) );
			 	/*echo $arr_sel_applicants;
			 	die();*/
			 	
				$this->db->select("counselling_name, counselling_code");
				$this->db->from('counselling_master');
				$this->db->where('counselling_code',$counselling_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$counselling_code = $row['counselling_code'];
					$counselling_name = $row['counselling_name'];
	            }
	            
	            /*$this->db->select("appl_no");
				$this->db->from('counselling_applicant_appl_overview');
				$this->db->where('appl_no',$nodalCenter);
				$this->db->where('counter_code',$counter_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$counter_slno = $row['counter_slno'];
					$token_no = $row['token_no'];
	            }*/
	            
	            $this->db->select("count(*) as token");
				$this->db->from('counselling_applicant_details');
				$this->db->where('verification_date',$verificationDate);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$token = $row['token'];
	            }
	            
            	$reg_user_id = $arr_sel_applicants;
				$update_data = array(
					'counter_code'							=>$counter_code,
					'attended'								=>'1',
					'verification_date'						=>$verificationDate,
					'updated_by'							=>$user,
					'updated_on'							=>$date
				);
				$this->db->where("reg_user_id",$reg_user_id);
				$sql = $this->db->update('counselling_applicant_details', $update_data);
				if(!$sql){
					$dbstatus = "ERROR";
					$dbMessage = "Error Updating";
				}
				
				/*$token_no1 = $token + 1;
				$update_data = array(
					'token_no'								=>$token_no1,
					'updated_by'							=>$logged_user,
					'updated_on'							=>$date
				);
				$this->db->where("nodal_centre_code",$nodalCenter);
				$this->db->where("counter_code",$counter_code);
				$sql = $this->db->update('counselling_nodal_centre_to_counter_mapping', $update_data);
				if(!$sql){
					$dbstatus = "ERROR";
					$dbMessage = "Error Updating";
				}
				
				$update_data = array(
					'token_no'								=>$token_no1,
					'updated_by'							=>$logged_user,
					'updated_on'							=>$date
				);
				$this->db->where("reg_user_id",$reg_user_id);
				$sql = $this->db->update('counselling_applicant_details', $update_data);
				if(!$sql){
					$dbstatus = "ERROR";
					$dbMessage = "Error Updating";
				}*/
	           	$output = array('status'=>$dbstatus);
	           	
	           	return $output; 
			break;
			
			case 'get_token_no': 
            	$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
            	$dbstatus = '';
            	$reg_user_id = $_POST['reg_user_id'];
            	$veification_date = isset($_POST['veification_date']) ? $_POST['veification_date'] : '';
        		$verificationDate = date("Y-m-d", strtotime($veification_date) );
	            
	            $this->db->select("count(token_no) as token");
				$this->db->from('counselling_applicant_details');
				$this->db->where('verification_date',$verificationDate);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$token = $row['token'];
	            }
				
				$token_no1 = $token + 1;
				
				$update_data = array(
					'token_no'								=>$token_no1,
					'updated_by'							=>$user,
					'updated_on'							=>$date
				);
				$this->db->where("reg_user_id",$reg_user_id);
				$sql = $this->db->update('counselling_applicant_details', $update_data);
				if(!$sql){
					$dbstatus = "ERROR";
					$dbMessage = "Error Updating";
				}
				
	           	$output = array('token'=>$token_no1);
	           	
	           	return $output; 
			break;
			
			case 'change_token_no': 
            	$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
            	$dbstatus = '';
            	$reg_user_id = $_POST['reg_user_id'];
            	$veification_date = isset($_POST['veification_date']) ? $_POST['veification_date'] : '';
        		$verificationDate = date("Y-m-d", strtotime($veification_date) );
	            
	           
				
				$update_data = array(
					'token_no'								=>NULL,
					'updated_by'							=>$user,
					'updated_on'							=>$date
				);
				$this->db->where("reg_user_id",$reg_user_id);
				$sql = $this->db->update('counselling_applicant_details', $update_data);
				if(!$sql){
					$dbstatus = "ERROR";
					$dbMessage = "Error Updating";
				}
				
	           	$output = array('token'=>'0');
	           	
	           	return $output; 
			break;
			
			//************************************************* FOR STUDENTS VERIFICATION ************************************
			
			case 'get_applicants_verification_details' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$phoDoc = 0;
				$sigDoc = 0;
        		$counselling_code = isset($_POST['counselling_code']) ? $_POST['counselling_code'] : '';
        		$cmbNodalCenter = isset($_POST['cmbNodalCenter']) ? $_POST['cmbNodalCenter'] : '';
        		$cmbCounter = isset($_POST['cmbCounter']) ? $_POST['cmbCounter'] : '';
        		$jee_no = isset($_POST['jee_no']) ? $_POST['jee_no'] : '';
        		$verification_date = isset($_POST['verification_date']) ? $_POST['verification_date'] : '';
        		$verificationDate = date("Y-m-d", strtotime($verification_date) );
        		
				$this->db->select("counselling_code, counselling_name");
				$this->db->from('counselling_master');
				$this->db->where('counselling_code',$counselling_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$counselling_code = $row['counselling_code'];
					$counselling_name = $row['counselling_name'];
	            }
	            
	            
	            $output = array("aaData" => array());
	            $allApplicants = array();
	            if($counselling_code != '')
				{
					$this->db->select("A.reg_user_id, full_name, A.token_no,CASE WHEN (appl_status = 'Valid' OR appl_status = 'Invalid' OR appl_status = 'Seat Alloted') THEN 'YES' ELSE 'NO' END AS print,C.appl_no");
					$this->db->from('counselling_applicant_details A');
					$this->db->join('applicant_detail B','A.reg_user_id = B.jee_roll_no','left');
					$this->db->join('counselling_applicant_appl_overview C','A.reg_user_id = C.reg_user_id AND A.appl_no = C.appl_no','left');
					$this->db->join('counselling_nodal_centre_to_counter_mapping D','A.nodal_centre_code = D.nodal_centre_code AND A.counter_code = D.counter_code','left');
					$this->db->where('counselling_code',$counselling_code);
					$this->db->where('A.nodal_centre_code',$cmbNodalCenter);
					$this->db->where('D.counter_code',$cmbCounter);
					$this->db->where('A.attended','1');
					$this->db->where('A.verification_date',$verificationDate);
					if($jee_no != '')
					{
						$this->db->where('B.reg_user_id',$jee_no);
					}
					$result = $this->db->get();
					/*echo $this->db->last_query();
					die();*/
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					$slno = 1;
					foreach ($output_data as $aRow) 
		            {
		                $row[0] = $slno;
		                $row['sl_no'] = $slno;
		                $i = 1;
		                foreach ($aRow as $key => $value) 
		                {
		                    $row[$i] = $value;
		                    $row[$key] = $value;
		                    $i++;
		                }
						$output['aaData'][] = $row;
		                $slno++;
		                unset($row);
		            }
		           	
					
				}
				return $output;
	           
			break;
			
			case 'get_rejection_reasons' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		
				$this->db->select("remarks");
				$this->db->from('counselling_rejection_remarks');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'get_applicantFeeDetails' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$appl_no = isset($_POST['appl_no']) ? $_POST['appl_no'] : '';
        		
				$this->db->select("amount,depositdate,money_receipt_no");
				$this->db->from('counselling_applicant_form_fee_overview');
				$this->db->where('appl_no',$appl_no);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$amount = '';
				$depositdate = '';
				$money_receipt_no = '';
				$dbStatus = 'Failed';
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $dbStatus = "Success";
	                $amount = $aRow['amount'];
	                $depositdate = $aRow['depositdate'];
	                $money_receipt_no = $aRow['money_receipt_no'];
	            }
	            $output = array("dbStatus" => $dbStatus, "amount" => $amount, "depositdate" => $depositdate, "money_receipt_no" => $money_receipt_no);
				return $output;
	           
			break;
			
			case 'valid_applicant' :
				$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$user = $logged_user.'_'.$institute_code;
        		$dbstatus = "Success";
        		$dbMessage = "Student Successfully Validated";
        		$reg_user_id = isset($_POST['hidRegUserId']) ? $_POST['hidRegUserId'] : '';
        		$appl_no = isset($_POST['hidApplNo']) ? $_POST['hidApplNo'] : '';
        		$txtDDNo = isset($_POST['txtDDNo']) ? $_POST['txtDDNo'] : '';
        		$txtAmount = isset($_POST['txtAmount']) ? $_POST['txtAmount'] : '';
        		$txtAppDate = isset($_POST['txtAppDate']) ? $_POST['txtAppDate'] : '';
        		$txtBank = isset($_POST['txtBank']) ? $_POST['txtBank'] : '';
        		$txtBranch = isset($_POST['txtBranch']) ? $_POST['txtBranch'] : '';
        		$arr_sel_documents = isset($_POST['chkApplicant']) ? $_POST['txtBranch'] : array();
        		$txtAppDate = date("Y-m-d", strtotime($txtAppDate) );
        		/*print_r($arr_sel_documents);
        		die();*/
        		foreach($arr_sel_documents as $document_type_code)
				{
					$this->db->select("count(*) as cnt");
					$this->db->from('counselling_document_details');
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('document_type_code',$document_type_code);
					$result = $this->db->get();
					
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					foreach ($output_data as $row) 
		            {
		                $cnt = $row['cnt'];
		            }
		            
		            if($cnt == 0)
		            {
						$new_data = array(
							'reg_user_id' 						=>$reg_user_id,
							'document_type_code'				=>$document_type_code,
							'institute_code' 					=>$institute_code,
							'created_by' 						=>$user,
							'created_on' 						=>$date
						);
									
						$sql = $this->db->insert('counselling_document_details', $new_data);
						/*echo $this->db->last_query();
						die();*/
						if(!$sql){
							$dbstatus = "ERROR";
							$dbMessage = "Error Updating";
						}
					}
		            
					
				}
				$this->db->select("count(*) as cnt");
				$this->db->from('counselling_fee_details');
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	                $cnt = $row['cnt'];
	            }
		        if($cnt == 0)
		        {
		            	
	        		$new_data = array(
						'reg_user_id' 						=>$reg_user_id,
						'dd_no'								=>$txtDDNo,
						'date'								=>$txtAppDate,
						'amount'							=>$txtAmount,
						'issued_bank'						=>$txtBank,
						'branch'							=>$txtBranch,
						'institute_code' 					=>$institute_code,
						'created_by' 						=>$user,
						'created_on' 						=>$date
					);
								
					$sql = $this->db->insert('counselling_fee_details', $new_data);
					/*echo $this->db->last_query();
					die();*/
					if(!$sql){
						$dbstatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
				}
				else
				{
					$new_data = array(
						'dd_no'								=>$txtDDNo,
						'date'								=>$txtAppDate,
						'amount'							=>$txtAmount,
						'issued_bank'						=>$txtBank,
						'branch'							=>$txtBranch,
						'institute_code' 					=>$institute_code,
						'updated_by' 						=>$user,
						'updated_on' 						=>$date
					);
					$this->db->where("reg_user_id",$reg_user_id);			
					$sql = $this->db->update('counselling_fee_details', $new_data);
					/*echo $this->db->last_query();
					die();*/
					if(!$sql){
						$dbstatus = "ERROR";
						$dbMessage = "Error Inserting";
					}
				}
        		
        		$update_data = array(
					'appl_status'							=>'Valid',
					'verification_status'					=>'Valid',
					'updated_by'							=>$user,
					'updated_on'							=>$date
				);
				$this->db->where("reg_user_id",$reg_user_id);
				$sql = $this->db->update('counselling_applicant_appl_overview', $update_data);
				/*echo $this->db->last_query();
				die();*/
				if(!$sql){
					$dbstatus = "ERROR";
					$dbMessage = "Error Updating";
				}
				$output = array("status"=>$dbstatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			case 'invalid_applicant': 
            	$institute_code = $this->session->userdata("institute_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$user = $logged_user.'_'.$institute_code;
        		$dbstatus = "Success";
        		$dbMessage = "Student Invalid";$reg_user_id = isset($_POST['hidRegUserId']) ? $_POST['hidRegUserId'] : '';
        		$appl_no = isset($_POST['hidApplNo']) ? $_POST['hidApplNo'] : '';
        		$txtDDNo = isset($_POST['txtDDNo']) ? $_POST['txtDDNo'] : '';
        		$txtAmount = isset($_POST['txtAmount']) ? $_POST['txtAmount'] : '';
        		$txtAppDate = isset($_POST['txtAppDate']) ? $_POST['txtAppDate'] : '';
        		$txtBank = isset($_POST['txtBank']) ? $_POST['txtBank'] : '';
        		$txtBranch = isset($_POST['txtBranch']) ? $_POST['txtBranch'] : '';
        		$arr_sel_documents = isset($_POST['chkApplicant']) ? $_POST['txtBranch'] : array();
        		$reason = isset($_POST['taRemark']) ? $_POST['taRemark'] : '';
        		$cmbReason = isset($_POST['cmbReason']) ? $_POST['cmbReason'] : '';
        		$txtAppDate = date("Y-m-d", strtotime($txtAppDate) );
        		/*print_r($arr_sel_documents);
        		die();*/
        		foreach($arr_sel_documents as $document_type_code)
				{
					$this->db->select("count(*) as cnt");
					$this->db->from('counselling_document_details');
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('document_type_code',$document_type_code);
					$result = $this->db->get();
					
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					foreach ($output_data as $row) 
		            {
		                $cnt = $row['cnt'];
		            }
		            
		            if($cnt == 0)
		            {
						$new_data = array(
							'reg_user_id' 						=>$reg_user_id,
							'document_type_code'				=>$document_type_code,
							'institute_code' 					=>$institute_code,
							'created_by' 						=>$user,
							'created_on' 						=>$date
						);
									
						$sql = $this->db->insert('counselling_document_details', $new_data);
						/*echo $this->db->last_query();
						die();*/
						if(!$sql){
							$dbstatus = "ERROR";
							$dbMessage = "Error Updating";
						}
					}
				}
				$this->db->select("count(*) as cnt");
				$this->db->from('counselling_fee_details');
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	                $cnt = $row['cnt'];
	            }
	            if($txtDDNo != '')
	            {
					if($cnt == 0)
		            {
						$new_data = array(
							'reg_user_id' 						=>$reg_user_id,
							'dd_no'								=>$txtDDNo,
							'date'								=>$txtAppDate,
							'amount'							=>$txtAmount,
							'issued_bank'						=>$txtBank,
							'branch'							=>$txtBranch,
							'institute_code' 					=>$institute_code,
							'created_by' 						=>$user,
							'created_on' 						=>$date
						);
									
						$sql = $this->db->insert('counselling_fee_details', $new_data);
						/*echo $this->db->last_query();
						die();*/
						if(!$sql){
							$dbstatus = "ERROR";
							$dbMessage = "Error Inserting";
						}
					}
					else
					{
						$new_data = array(
							'dd_no'								=>$txtDDNo,
							'date'								=>$txtAppDate,
							'amount'							=>$txtAmount,
							'issued_bank'						=>$txtBank,
							'branch'							=>$txtBranch,
							'institute_code' 					=>$institute_code,
							'updated_by' 						=>$user,
							'updated_on' 						=>$date
						);
						$this->db->where("reg_user_id",$reg_user_id);			
						$sql = $this->db->update('counselling_fee_details', $new_data);
						/*echo $this->db->last_query();
						die();*/
						if(!$sql){
							$dbstatus = "ERROR";
							$dbMessage = "Error Inserting";
						}
					}
				}
	            
        		
        		
        		
        		$update_data = array(
					'appl_status'							=>'Invalid',
					'rejected_reason'						=>$cmbReason,
					'verification_status'					=>'Invalid',
					'verification_remark'					=>$reason,
					'updated_by'							=>$user,
					'updated_on'							=>$date
				);
				$this->db->where("reg_user_id",$reg_user_id);
				$sql = $this->db->update('counselling_applicant_appl_overview', $update_data);
				if(!$sql){
					$dbstatus = "ERROR";
					$dbMessage = "Error Updating";
				}
				$output = array("status"=>$dbstatus,"msg"=>$dbMessage);
				return $output;
			break;
			case 'get_checkList' :
				$institute_code = $this->session->userdata("institute_code");
				$user_code = $this->session->userdata("user_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$regn_no = isset($_POST['regn_no']) ? $_POST['regn_no'] : '';
        		$logged_user = $this->session->userdata('user_name');
				//$result1 = $this->db->get();
				$html = '';
				$html .= '<h4>Generic Documents:</h4>';
				$html .= '<table class="table table-bordered" id="tblApplicantDetails">
								<thead>
									<tr>
										<th class="text-center">Sl No</th>
										<th class="text-center">Documents</th>
										<th>
											<input class="Allcheckbox" type="checkbox" id="chkSelectAll" name="chkSelectAll" onclick="allcheck(\'Allcheckbox\',\'checkbox1\')"/>
										</th>
									</tr>
								</thead>
								<tbody id="applicantBody">';
        		
        		
        		
        		
				$this->db->select("document_type,document_type_code");
				$this->db->from('document_type_master');
				$this->db->where('record_status','1');
				$this->db->where('document_type_code !=','PHO');
				$this->db->where('document_type_code !=','SIG');
				$this->db->where('type','Generic');
				$result = $this->db->get();
				
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	                $allCheckList[] = $row;
	            }
	          
	            $style= '';
	            $sl_no =1;
	            foreach($allCheckList as $row)
				{
					
					$html .= '<tr>';
					$html .= '<td>'.$sl_no.'</td>
							<td>'.$row['document_type'].'</td>
							<td>
							<input type="checkbox" class="checkbox1" id="chk'.$sl_no.'" name="chkApplicant[]"	value="'.$row['document_type_code'].'"/>
							</tr>';
					$sl_no++;
				}
	            $html .= '</tbody>
							</table>';
							
				$this->db->select("category");
				$this->db->from('applicant_detail');
				$this->db->where('jee_roll_no',$regn_no);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	                $category = $row['category'];
	            }
	            
	            $this->db->select("document_type,document_code");
				$this->db->from('category_document_mapping A');
				$this->db->join('document_type_master B','A.document_code = B.document_type_code','LEFT');
				$this->db->where('category_code',$category);
				$this->db->where('type','Specific');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$result->result_array();
				
				if($result->num_rows() > 0) {
					$html .= '<h4>Specific Documents:</h4>';
					$html .= '<table class="table table-bordered" id="tblApplicantDetails">
									<thead>
										<tr>
											<th class="text-center">Sl No</th>
											<th class="text-center">Documents</th>
											<th>
												<input class="Allcheckbox1" type="checkbox" id="chkSelectAll" name="chkSelectAll" onclick="allcheck1(\'Allcheckbox1\',\'checkbox2\')"/>
											</th>
										</tr>
									</thead>
									<tbody id="applicantBody">';
					$sl_no = 1;
					foreach ($result->result_array() as $row) 
		            {
		                $html .= '<tr>';
						$html .= '<td>'.$sl_no.'</td>
								<td>'.$row['document_type'].'</td>
								<td>
								<input type="checkbox" class="checkbox2" id="chk'.$sl_no.'" name="chkApplicant[]"	value="'.$row['document_code'].'"/>
								</tr>';
						$sl_no++;
		            }
		           	$html .= '</tbody>
							</table>';
				}
				
				/*$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	                $category = $row['category'];
	            }*/
	            
	            
	            return array('html' => $html);
			break; 
			
			//************************************************* FOR STUDENTS FINAL ALLOTMENT ************************************
			case 'get_headers_final_allotment':
				$institute_code = $this->session->userdata("institute_code");
				$user_code = $this->session->userdata("user_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
			
				$this->db->select("category_code,category_name");
				$this->db->from('category_master');
				$this->db->where('record_status','1');
				$this->db->order_by('category_name');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'get_details_final_allotment':
				$institute_code = $this->session->userdata("institute_code");
				$user_code = $this->session->userdata("user_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
        		$counselling_code = isset($_POST['counselling_code'])?$_POST['counselling_code']:'';
        		
	            $this->db->select("reg_user_id,full_name,category_name,institute_name,program_name,branch");
				$this->db->from('counselling_temporary_allotment_details A');
				$this->db->join('applicant_detail B','A.reg_user_id = B.jee_roll_no','left');
				$this->db->join('institute_master C','A.alloted_institute = C.institute_code','left');
				$this->db->join('counselling_program_master D','A.alloted_program = D.program_code','left');
				$this->db->join('counselling_branch_master E','A.alloted_branch = E.branch_code','left');
				$this->db->join('category_master F','A.alloted_seat_category = F.category_code','left');
				$this->db->where('A.counselling_code',$counselling_code);
				$this->db->where('A.status','1');
				$this->db->order_by('reg_user_id');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) 
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
			
			case 'temporary_allotment':
				$institute_code = $this->session->userdata("institute_code");
				$user_code = $this->session->userdata("user_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				$output = array("aaData" => array());
        		$counselling_code = isset($_POST['counselling_code'])?$_POST['counselling_code']:'';
        		$reg_user_id = '';
        		$dbstatus = 'SUCCESS';
        		$dbMessage = 'Student Alloted Successfully';
        		// for all category codes rank wise
        		//$this->db->distinct("A.reg_user_id,A.appl_no,A.category_code AS alloted_seat_category,B.program_code,B.branch_code,B.institute_code,D.counselling_code");
        		$this->db->select("A.reg_user_id,A.appl_no,A.category_code AS alloted_seat_category,'Alloted' AS allotment_status,B.program_code AS alloted_program,B.branch_code AS alloted_branch,B.institute_code,B.institute_code AS alloted_institute,D.counselling_code");
        		$this->db->from('counselling_applicant_details A');
        		$this->db->join('counselling_program_branch_institute_mapping B','A.ipb_code=B.ipb_code','left');
        		$this->db->join('counselling_applicant_appl_overview C','A.appl_no=C.appl_no','left');
        		$this->db->join('counselling_applicant_choice_details D','A.reg_user_id=D.reg_user_id','left');
        		$this->db->where('appl_status','Valid');
        		$this->db->group_by('A.reg_user_id');
	        	$select = $this->db->get();
	        	/*echo $this->db->last_query();
				die();*/
	        	$output_data = $select->result_array();
	        	//print_r($select->num_rows());
        		for($i=0;$i<$select->num_rows();$i++)
				{
				    $insert = $this->db->insert('counselling_temporary_allotment_details', $output_data[$i]);
				   /* echo $this->db->last_query();
				    die();*/
				}
				if(!$insert)
				{
					$dbstatus = "ERROR";
					$dbMessage = "Error Updating";
				}        		
        		$output = array("status"=>$dbstatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			
			case 'final_allotment':
				$institute_code = $this->session->userdata("institute_code");
				$user_code = $this->session->userdata("user_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				$output = array("aaData" => array());
        		$counselling_code = isset($_POST['counselling_code'])?$_POST['counselling_code']:'';
        		$reg_user_id = '';
        		$dbstatus = 'SUCCESS';
        		$dbMessage = 'Student Alloted Successfully';
        		// for all category codes rank wise
        		$this->db->select("reg_user_id,appl_no,counselling_code,allotment_status,alloted_institute,alloted_program,alloted_branch,institute_code,alloted_seat_category ");
        		$this->db->from('counselling_temporary_allotment_details');
        		$this->db->where('status','1');
        		$select = $this->db->get();
        		$output_data = $select->result_array();
				for($i=0;$i<$select->num_rows();$i++)
				{
				    $insert = $this->db->insert('counselling_applicant_allotment_details', $output_data[$i]);
				   /* echo $this->db->last_query();
				    die();*/
				}
				if(!$insert)
				{
					$dbstatus = "ERROR";
					$dbMessage = "Error Updating";
				}        		
        		$output = array("status"=>$dbstatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			case 'publish_applicants':
				$institute_code = $this->session->userdata("institute_code");
				$user_code = $this->session->userdata("user_code");
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				$output = array("aaData" => array());
        		$counselling_code = isset($_POST['counselling_code'])?$_POST['counselling_code']:'';
        		$reg_user_id = '';
        		$applicants = array();
        		$dbstatus = 'SUCCESS';
        		$dbMessage = 'Student Alloted Successfully';
        		
	            // for all applicants data
	            $this->db->select("reg_user_id,rank1,appl_no");
				$this->db->from('applicant_detail A');
				$this->db->join('counselling_applicant_appl_overview B','B.reg_user_id = A.jee_roll_no','left');
				$this->db->where('B.appl_status','Valid');
				$this->db->where('B.counselling_code',$counselling_code);
				$this->db->order_by('rank1');
				$result = $this->db->get();
				$output_data = $result->result_array();
				/*echo $this->db->last_query();
				die();*/
				foreach ($output_data as $aRow) 
	            {
	                $applicants[] = $aRow;
	            }
	            foreach($applicants as $row)
	            {
	            	$reg_user_id = $row['reg_user_id'];
	            	$this->db->select("count(*) as cnt");
					$this->db->from('counselling_applicant_allotment_details');
					$this->db->where('reg_user_id',$reg_user_id);
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
		            {
		                $cnt = $aRow['cnt'];
		            }
		            if($cnt != 0)
		            {
		            	$update_data = array(
							'appl_status'							=>'Seat Alloted',
							'updated_by'							=>$user_code,
							'updated_on'							=>$date
						);
						$this->db->where("reg_user_id",$reg_user_id);
						$sql = $this->db->update('counselling_applicant_appl_overview', $update_data);
						if(!$sql){
							$dbstatus = "ERROR";
							$dbMessage = "Error Updating";
						}
						
					}
					else
					{
						$this->db->select('jee_roll_no, first_name, mid_name, last_name, dob, applicant_email, applicant_mobile, gender, category');
						$this->db->from('applicant_detail');
						$this->db->where('jee_roll_no',$reg_user_id);
						$result = $this->db->get();
						//echo $this->db->last_query();die();
						$query = $result->result_array();
						$present = 0;
						foreach($result->result_array() AS $row1)
						{
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


						$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content");
						$this->db->from('sms_provider_setup A');
						$this->db->join('sms_setup B','A.provider_name = B.provider_name','INNER');
						//$this->db->where('C.program_code',$program_code);
						$this->db->where('B.record_status','1');
						$this->db->where('B.sms_type','SEAT ALLOTMENT');
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
							/*$findappl = array("[otp]");
							$replaceappl = array($otp);
							$new_content = str_replace($findappl, $replaceappl, $content);
							$messageToSend = urlencode($new_content);*/
							$messageToSend = urlencode($content);
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
					}
					$update1 = array(
						'status' => 0
					);
					$this->db->where("reg_user_id",$reg_user_id);
					$sql = $this->db->update('counselling_temporary_allotment_details', $update1);
						if(!$sql){
							$dbstatus = "ERROR";
							$dbMessage = "Error Updating";
						}
					
				}
				$output = array("status"=>$dbstatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			
			
			
			
			
			
			
			case 'add_course_discipline_ins' :
				$institute=isset($_POST['ins'])?$_POST['ins']:'';
				$course_disc=isset($_POST['course_discipline'])?$_POST['course_discipline']:'';
				$status = isset($_POST['arr_status'])?$_POST['arr_status']:'';
				$date = date('Y-m-d H:i:s', now());
				$course_disc_count = sizeof($course_disc);
				$count_checked_element = 0;
				$success_count = 0;
				for($i=0;$i<sizeof($course_disc);$i++)
				{
					$course_discipline = explode('-',$course_disc[$i]);
					$course = $course_discipline[0];
					$discipline = $course_discipline[1];
					$this->db->where("program_code",$course);
					$this->db->where("branch_code",$discipline);
					$this->db->where("institute_code",$institute);
					$this->db->delete("counselling_program_branch_institute_mapping");
					
					
					if($status[$i] == '1')
					{
						
						$count_checked_element++;
						$new_array = array( 
							"program_code"  =>$course,
							"branch_code"  =>$discipline,
							"institute_code" =>$institute,
							"created_by" => 'SUPADM001',
							"created_on" => $date,
						);
						$this->db->set('ipb_code', 'UUID()',FALSE);
						$this->db->insert('counselling_program_branch_institute_mapping',$new_array);
						if($this->db->affected_rows() ==0){
							$success_count++;
						}
					}
				}
				if($count_checked_element != 0 && $success_count == $count_checked_element)
				{
					$dbStatus = 'SUCCESS';
					$dbMessage = 'Program and Branch Assigned Successfully';
					$dbErrMessage = '';
				}
				else if($count_checked_element != 0 && $success_count < $count_checked_element)
				{
					$dbStatus = 'SUCCESS';
					$dbMessage = 'Program and Branch Assigned Successfully';
					$dbErrMessage = 'Some Program and Branch not Assigned';
				}
				else if($success_count == 0)
				{
					$dbStatus = 'ERROR';
					$dbMessage = 'Insertion Failure';
					$dbErrMessage = '';
				}
				$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				return $output;
			break; 
			
			/////*************************************** Santhoshi *****************************************//// 

			
			
			// to get all category in multiselect
			
			case 'get_program_data' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("program_code,REPLACE(program_name,'&amp;','&') AS program_name");
				$this->db->from('counselling_program_master');
				$this->db->where('institute_code',$institute_code);
				//$this->db->where('program_end_date>=',$date);
				$this->db->order_by("id");
				$result = $this->db->get();
				//echo $this->db->last_query();
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
	            /*print_r( $output);
	            die();*/
	           	return $output;
			break;
			
			// to get data for assign multiple category datatable
			
			case 'get_category_multiple':
				//$institute = $_POST['institute'];
				$this->db->select("category_code,category_name,category_code as category");
				$this->db->from('category_master');
				$this->db->where('record_status','1');
				$this->db->order_by('id');
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			// assigning multiple data
			
			case 'assign_multiple_category' :
				$dbStatus = "SUCCESS";
				$dbMessage = "Assigned Successfully";
				$dbError = "";
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d H:i:s', now());
				$arr_program_code = array();
				$category_codes = array();
				$arr_show_status = array();
				$program_codes = $_POST['program_codes'];
				$category_codes = $_POST['category_codes']?$_POST['category_codes']:'';
				//print_r($category_codes);
				$show_status = $_POST['show_status']?$_POST['show_status']:'';
				$arr_program_code = call_user_func_array('array_merge', $program_codes);
				
				for($i=0;$i<sizeof($arr_program_code);$i++)
				{
					for($j=0;$j<sizeof($category_codes);$j++)
					{
						$count = 0;
						if($arr_program_code[$i] != "multiselect-all")
						{
							$this->db->select("count(program_code) AS program_code");
							$this->db->from('program_category_setup');
							$this->db->where('program_code',$arr_program_code[$i]);
							$this->db->where('category_code',$category_codes[$j]);
							
							$result = $this->db->get();
							//echo $this->db->last_query();
							$output_data = $result->result_array();
							foreach ($output_data as $aRow) 
		            		{
		            			$result = $aRow['program_code'];
								if($result >= 1){
									if($arr_program_code[$i] != "multiselect-all")
									{
										$update_data = array(
											'record_status' 				=>$show_status[$j],
											'institute_code' 				=>$institute_code,
											'updated_by'					=>$user,
											'updated_on'					=>$date
										);
										$this->db->where('program_code',$arr_program_code[$i] );
										$this->db->where('category_code',$category_codes[$j] );
										$sql = $this->db->update('program_category_setup', $update_data);
										//echo $this->db->last_query();
										if(!$sql){
											$dbStatus = "ERROR";
											$dbMessage = "Error Inserting";
											//$dbError = ;	
										}
									}
									else{
										$dbStatus = "ERROR";
										$dbMessage = "Error Inserting";
										//$dbError = mysqli_error($con);	
									}
									
								}
								else{
									$new_data = array(
										'program_code' 					=>$arr_program_code[$i],
										'category_code' 				=>$category_codes[$j],
										'record_status' 				=>$show_status[$j],
										'institute_code' 				=>$institute_code,
										'created_by'					=>$user,
										'created_on'					=>$date
									);
									
									if($arr_program_code[$i] != "multiselect-all"){
										$sql = $this->db->insert('program_category_setup', $new_data);
										//echo $this->db->last_query();
										if(!$sql){
											$dbStatus = "ERROR";
											$dbMessage = "Error Inserting";
											//$dbError = ;	
										}
									}
									else{
										$dbStatus = "ERROR";
										$dbMessage = "Error Inserting";
										//$dbError = mysqli_error($con);	
									}
								}
							}
						}
					}
				}
				if($dbStatus == "SUCCESS")
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				else
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				return $output;
			break;
			
			// to get data for assign single category datatable
			
			case 'get_category_one':
				//$institute = $_POST['institute'];
				$program = $_POST['program'];
				$this->db->select("B.category_code,B.category_name,CASE WHEN A.record_status IS NULL THEN '0' WHEN A.record_status = '1'THEN 1 ELSE 0 END AS record_status");
				$this->db->from('category_master B');
				$this->db->join('program_category_setup A','A.category_code = B.category_code','left');
				$this->db->where('A.program_code',$program);
				$this->db->order_by('B.id');
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			// assigning single data
			
			case 'assign_single_category' :
				$dbStatus = "SUCCESS";
				$dbMessage = "Updated Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d H:i:s', now());
				$arr_menu_code = array();
				$program_code = $_POST['program_code'];
				$show_status = $_POST['show_status']?$_POST['show_status']:'';
				$this->db->select("B.category_code,B.category_name,CASE WHEN A.record_status IS NULL THEN '0' WHEN A.record_status = '1'THEN 1 ELSE 0 END AS record_status");
				$this->db->from('category_master B');
				$this->db->join('program_category_setup A','A.category_code = B.category_code','left');
				$this->db->where('A.program_code',$program_code);
				$this->db->group_by('B.category_code');
				$this->db->order_by('B.id');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$i = 0;
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
	            {
	            	$category = $row['category_code'];
	            	$this->db->select("count(program_code) AS program_code");
					$this->db->from('program_category_setup');
					$this->db->where('program_code',$program_code);
					$this->db->where('category_code',$category);
					
					$result = $this->db->get();
					$output_data = $result->result_array();
					
					foreach ($output_data as $aRow1) 
            		{
            			$result = $aRow1['program_code'];
						if($result >= 1)
						{
							$update_data = array(
								'category_code' 				=>$category,
								'record_status' 				=>$show_status[$i],
								'institute_code' 				=>$institute_code,
								'updated_by'					=>$user,
								'updated_on'					=>$date
							);
							$this->db->where('program_code',$program_code );
							$this->db->where('category_code',$category );
							$sql = $this->db->update('program_category_setup', $update_data);
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
								'program_code' 					=>$program_code,
								'category_code' 				=>$category,
								'record_status' 				=>$show_status[$i],
								'institute_code' 				=>$institute_code,
								'created_by'					=>$user,
								'created_on'					=>$date
							);
							
							
							$sql = $this->db->insert('program_category_setup', $new_data);
							//echo $this->db->last_query();
							if(!$sql){
								$dbStatus = "ERROR";
								$dbMessage = "Error Inserting";
								//$dbError = ;	
							}
						}
	                }
	                $i++;
	            }
	            if($dbStatus == "SUCCESS")
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				else
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				return $output;
			break;
			
			// to get data for assign multiple exam centre datatable
			
			case 'get_exam_centre_all':
				//$institute = $_POST['institute'];
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				$this->db->distinct("A.exam_centre_code,B.exam_centre_name");
				$this->db->from('institute_exam_centre_setup A');
				$this->db->join('exam_centre B','A.exam_centre_code = B.exam_centre_code','left');
				$this->db->where('A.institute_code',$institute_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			// to get data for assign multiple qualification datatable
			
			case 'get_qualification_multiple':
				//$institute = $_POST['institute'];
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				$this->db->distinct("CONCAT(program_qualification_setup.qualification_code,'`',qualification_name) AS qualification_code");
				$this->db->select("CONCAT(program_qualification_setup.qualification_code,'`',qualification_name) AS qualification_code");
				$this->db->from('program_qualification_setup ');
				$this->db->join('counselling_program_master','counselling_program_master.program_code = program_qualification_setup.program_code','left');
				$this->db->join('qualification_master','qualification_master.qualification_code = program_qualification_setup.qualification_code','left');
				//$this->db->order_by('program_qualification_setup.id');
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			// assigning multiple data
			
			case 'assign_multiple_centre' :
				$dbStatus = "SUCCESS";
				$dbMessage = "Assigned Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d H:i:s', now());
        		
				$arr_program_code = array();
				$qualification_codes = array();
				$arr_show_status = array();
				$program_codes = $_POST['program_codes'];
				$qualification_codes = $_POST['qualification_codes']?$_POST['qualification_codes']:'';
				$show_status = $_POST['show_status']?$_POST['show_status']:'';
				$arr_program_code = call_user_func_array('array_merge', $program_codes);
				
				for($i=0;$i<sizeof($arr_program_code);$i++)
				{
					for($j=0;$j<sizeof($qualification_codes);$j++)
					{
						$count = 0;
						if($arr_program_code[$i] != "multiselect-all")
						{
							$this->db->select("count(program_code) AS program_code");
							$this->db->from('program_qualification_setup');
							$this->db->where('program_code',$arr_program_code[$i]);
							$this->db->where('qualification_code',$qualification_codes[$j]);
							
							$result = $this->db->get();
							//echo $this->db->last_query();
							$output_data = $result->result_array();
							foreach ($output_data as $aRow) 
		            		{
		            			$result = $aRow['program_code'];
								if($result >= 1){
									$update_data = array(
										'record_status' 				=>$show_status[$j],
										'updated_by'					=>$user,
										'updated_on'					=>$date
									);
									$this->db->where('program_code',$arr_program_code[$i] );
									$this->db->where('qualification_code',$qualification_codes[$j] );
									$sql = $this->db->update('program_qualification_setup', $update_data);
									//echo $this->db->last_query();
									if(!$sql){
										$dbStatus = "ERROR";
										$dbMessage = "Error Inserting";
										//$dbError = ;	
									}
									
								}
								else{
									$new_data = array(
										'program_code' 					=>$arr_program_code[$i],
										'qualification_code' 			=>$qualification_codes[$j],
										'record_status' 				=>$show_status[$j],
										'created_by'					=>$user,
										'created_on'					=>$date
									);
									$sql = $this->db->insert('program_qualification_setup', $new_data);
									//echo $this->db->last_query();
									if(!$sql){
										$dbStatus = "ERROR";
										$dbMessage = "Error Inserting";
										//$dbError = ;	
									}
								}
							}
						}
					}
				}
				if($dbStatus == "SUCCESS")
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				else
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				return $output;
			break;
			
			// to get data for assign single category datatable
			
			case 'get_qualification_one':
				//$institute = $_POST['institute'];
				$program = $_POST['program'];
				$this->db->distinct("CONCAT(A.qualification_code,'`',A.qualification_name) AS qualification_code");
				$this->db->select("CONCAT(A.qualification_code,'`',A.qualification_name) AS qualification_code,CASE WHEN B.record_status IS NULL THEN '0' WHEN B.record_status = '1' THEN 1 ELSE '0' END AS record_status,A.qualification_name,A.id ");
				$this->db->from('qualification_master A ');
				$this->db->join('program_qualification_setup B','A.qualification_code = B.qualification_code','left');
				$this->db->where('B.program_code',$program);
				$this->db->order_by('A.id');
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			// assigning single data
			
			case 'assign_single_qualification' :
				$dbStatus = "SUCCESS";
				$dbMessage = "Updated Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d H:i:s', now());
				$arr_menu_code = array();
				$program_code = $_POST['program_code'];
				$show_status = $_POST['show_status']?$_POST['show_status']:'';
				$this->db->select("qualification_code,qualification_name");
				$this->db->from('qualification_master');
				$this->db->order_by('id');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$i = 0;
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
	            {
	            	$qualification_code = $row['qualification_code'];
	            	$this->db->select("count(program_code) AS program_code");
					$this->db->from('program_qualification_setup');
					$this->db->where('program_code',$program_code);
					$this->db->where('qualification_code',$qualification_code);
					
					$result = $this->db->get();
					$output_data = $result->result_array();
					
					foreach ($output_data as $aRow1) 
            		{
            			$result = $aRow1['program_code'];
						if($result >= 1)
						{
							$update_data = array(
								'qualification_code' 			=>$qualification_code,
								'record_status' 				=>$show_status[$i],
								'updated_by'					=>$user,
								'updated_on'					=>$date
							);
							$this->db->where('program_code',$program_code );
							$this->db->where('qualification_code',$qualification_code );
							$sql = $this->db->update('program_qualification_setup', $update_data);
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
								'program_code' 					=>$program_code,
								'qualification_code' 			=>$qualification_code,
								'record_status' 				=>$show_status[$i],
								'created_by'					=>$user,
								'created_on'					=>$date
							);
							
							
							$sql = $this->db->insert('program_qualification_setup', $new_data);
							//echo $this->db->last_query();
							if(!$sql){
								$dbStatus = "ERROR";
								$dbMessage = "Error Inserting";
								//$dbError = ;	
							}
						}
	                }
	                $i++;
	            }
	            if($dbStatus == "SUCCESS")
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				else
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				return $output;
			break;
			
			// to get data for assign multiple qualification datatable
			
			case 'get_fee_assign_multiple':
				//$institute = $_POST['institute'];
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				$this->db->select("category_code,category_name,category_code as category");
				$this->db->from('category_master ');
				$this->db->where('record_status','1');
				$this->db->order_by('id');
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			// assigning multiple data
			
			case 'assign_multiple_fee' :
				$dbStatus = "SUCCESS";
				$dbMessage = "Assigned Successfully";
				$dbError = "";
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d H:i:s', now());
        		
        		$arr_program_code = array();
				$arr_category_code = array();
				$category_codes = array();
				$arr_amt = array();
				$program_codes = $_POST['program_codes'];
				$category_codes = $_POST['category_codes']?$_POST['category_codes']:'';
				//print_r($category_codes);
				$amts = $_POST['amts']?$_POST['amts']:'';
				$arr_program_code = call_user_func_array('array_merge', $program_codes);
				
				for($i=0;$i<sizeof($arr_program_code);$i++)
				{
					for($j=0;$j<sizeof($category_codes);$j++)
					{
						$count = 0;
						if($arr_program_code[$i] != "multiselect-all")
						{
							$this->db->select("count(program_code) AS program_code");
							$this->db->from('program_fee_setup');
							$this->db->where('program_code',$arr_program_code[$i]);
							$this->db->where('category_code',$category_codes[$j]);
							
							$result = $this->db->get();
							//echo $this->db->last_query();
							$output_data = $result->result_array();
							foreach ($output_data as $aRow) 
		            		{
		            			$result = $aRow['program_code'];
								if($result >= 1){
									if($arr_program_code[$i] != "multiselect-all")
									{
										$update_data = array(
											'category_code'					=>$category_codes[$j],
											'amount' 						=>$amts[$j],
											'updated_by'					=>$user,
											'updated_on'					=>$date
										);
										$this->db->where('program_code',$arr_program_code[$i] );
										$this->db->where('category_code',$category_codes[$j] );
										$sql = $this->db->update('program_fee_setup', $update_data);
										//echo $this->db->last_query();
										if(!$sql){
											$dbStatus = "ERROR";
											$dbMessage = "Error Inserting";
											//$dbError = ;	
										}
									}
									else{
										$dbStatus = "ERROR";
										$dbMessage = "Error Inserting";
										//$dbError = mysqli_error($con);	
									}
									
								}
								else{
									$new_data = array(
										'program_code' 					=>$arr_program_code[$i],
										'category_code' 				=>$category_codes[$j],
										'amount' 						=>$amts[$j],
										'created_by'					=>$user,
										'created_on'					=>$date
									);
									
									if($arr_program_code[$i] != "multiselect-all"){
										$sql = $this->db->insert('program_fee_setup', $new_data);
										//echo $this->db->last_query();
										if(!$sql){
											$dbStatus = "ERROR";
											$dbMessage = "Error Inserting";
											//$dbError = ;	
										}
									}
									else{
										$dbStatus = "ERROR";
										$dbMessage = "Error Inserting";
										//$dbError = mysqli_error($con);	
									}
								}
							}
						}
					}
				}
				if($dbStatus == "SUCCESS")
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				else
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				return $output;
			break;
			
			// to get data for assign single category datatable
			
			case 'get_fee_one':
				//$institute = $_POST['institute'];
				$program = $_POST['program'];
				$this->db->select("CONCAT(A.category_name,'`',A.category_code) AS category_name,CASE WHEN B.amount IS NULL THEN '0' ELSE B.amount END AS amount");
				$this->db->from('category_master A');
				$this->db->join('program_fee_setup B','A.category_code = B.category_code','left');
				$this->db->where('B.program_code',$program);
				$this->db->where('B.record_status','1');
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			// assigning single data
			
			case 'assign_single_fee' :
				$dbStatus = "SUCCESS";
				$dbMessage = "Updated Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d H:i:s', now());
				$cmbProgramNameEdit = $_POST['cmbProgramFilter'];
				$cmbCategoryEdit = $_POST['cmbCategoryEdit'];
				$txtAmountEdit = $_POST['txtAmountEdit'];
				
				for($i = 0; $i < sizeof($cmbCategoryEdit); $i++)
	            {
	            	$this->db->select("count(program_code) AS program_code");
					$this->db->from('program_fee_setup');
					$this->db->where('program_code',$cmbProgramNameEdit);
					$this->db->where('category_code',$cmbCategoryEdit[$i]);
					
					$result = $this->db->get();
					$output_data = $result->result_array();
					
					foreach ($output_data as $aRow1) 
            		{
            			$result = $aRow1['program_code'];
						if($result >= 1)
						{
							$update_data = array(
								'category_code' 				=>$cmbCategoryEdit[$i],
								'amount' 						=>$txtAmountEdit[$i],
								'updated_by'					=>$user,
								'updated_on'					=>$date
							);
							$this->db->where('program_code',$cmbProgramNameEdit );
							$this->db->where('category_code',$cmbCategoryEdit[$i] );
							$sql = $this->db->update('program_fee_setup', $update_data);
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
								'program_code' 					=>$cmbProgramNameEdit,
								'category_code' 				=>$cmbCategoryEdit[$i],
								'amount' 						=>$txtAmountEdit[$i],
								'institute_code' 				=>$institute_code,
								'created_by'					=>$user,
								'created_on'					=>$date
							);
							
							
							$sql = $this->db->insert('program_fee_setup', $new_data);
							//echo $this->db->last_query();
							if(!$sql){
								$dbStatus = "ERROR";
								$dbMessage = "Error Inserting";
								//$dbError = ;	
							}
						}
	                }
	            }
	            if($dbStatus == "SUCCESS")
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				else
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				return $output;
			break;
			
			// to get data for charge datatable
			
			case 'get_charge_data':
				//$institute = $_POST['institute'];
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				$this->db->select("A.program_code,B.program_name,A.transaction_charge,CASE WHEN A.status = '1' THEN 'ACTIVE' WHEN A.status = '0' THEN 'INACTIVE' END AS status ");
				$this->db->from('counselling_online_transaction_charge_setup  A ');
				$this->db->join('counselling_program_master B','A.program_code = B.program_code','left');
				$this->db->where('A.institute_code',$institute_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'add_fee': 
			 
				$dbStatus = "TRUE";
				$dbMessage = "Inserted Successfully";
            	
			 	$program_codes = $_POST['programCodes'];
				$txtCharge = $_POST['txtCharge'];
				$cmbStatus = $_POST['cmbStatus'];
				$arr_program_code = call_user_func_array('array_merge', $program_codes);
				
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
			 	$op_type = 'add_fee';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				for($i = 0; $i < sizeof($arr_program_code); $i++)
	            {
	            	if($arr_program_code[$i] != "multiselect-all")
					{
		            	$this->db->select("count(program_code) AS program_code");
						$this->db->from('counselling_online_transaction_charge_setup ');
						$this->db->where('program_code',$arr_program_code[$i]);
						
						$result = $this->db->get();
						$output_data = $result->result_array();
						
						foreach ($output_data as $aRow1) 
	            		{
	            			$result = $aRow1['program_code'];
							if($result >= 1)
							{
								$update_data = array(
									'transaction_charge' 			=>$txtCharge,
									'status' 						=>$cmbStatus,
									'modified_by'					=>$user,
									'modified_on'					=>$date
								);
								$this->db->where('program_code',$arr_program_code[$i] );
								$sql = $this->db->update('counselling_online_transaction_charge_setup ', $update_data);
								//echo $this->db->last_query();
								if(!$sql){
									$dbStatus = "FALSE";
									$dbMessage = "Error Inserting";
									//$dbError = ;	
								}
							}
							else
							{
								$new_data = array(
									'program_code' 					=>$arr_program_code[$i],
									'transaction_charge' 			=>$txtCharge,
									'status' 						=>$cmbStatus,
									'institute_code' 				=>$institute_code,
									'created_by'					=>$user,
									'created_on'					=>$date
								);
								
								
								$sql = $this->db->insert('counselling_online_transaction_charge_setup ', $new_data);
								//echo $this->db->last_query();
								if(!$sql){
									$dbStatus = "FALSE";
									$dbMessage = "Error Inserting";
									//$dbError = ;	
								}
							}
		                }
		            }
	            }
				if($dbStatus == "TRUE")
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				else
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				return $output;	
			break;
			
			case 'edit_fee': 
			 
				$dbStatus = "SUCCESS";
				$dbMessage = "Updated Successfully";
            	
			 	$hidUniqueidEdit = $_POST['hidUniqueidEdit'];
				$cmbProgramCodeEdit = $_POST['cmbProgramCodeEdit'];
				$txtChargeEdit = $_POST['txtChargeEdit'];
				$cmbStatusEdit = $_POST['cmbStatusEdit'];
				
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
			 	$op_type = 'edit_fee';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$update_data = array(
					'program_code' 					=>$cmbProgramCodeEdit,
					'transaction_charge' 			=>$txtChargeEdit,
					'status' 						=>$cmbStatusEdit,
					'modified_by'					=>$user,
					'modified_on'					=>$date
				);
				$this->db->where('program_code',$hidUniqueidEdit);
				$this->db->where('institute_code',$institute_code);
				$sql = $this->db->update('counselling_online_transaction_charge_setup ', $update_data);
				//echo $this->db->last_query();
				if(!$sql){
					$dbStatus = "ERROR";
					$dbMessage = "Error Inserting";
					//$dbError = ;	
				}
				if($dbStatus == "SUCCESS")
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				else
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				return $output;	
			break;
			
			case 'delete_feedata':  
			
				$dbStatus = "SUCCESS";
				$dbMessage = "Deleted Successfully";
				$dbError = "";
				
				$id = $_POST['programCode'];
				
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				$output = array();
				
				$this->db->where('program_code', $id);
				$this->db->delete('counselling_online_transaction_charge_setup ');
				
					
				if($this->db->affected_rows() ==0){
					$dbStatus = "ERROR";
					$dbMessage = "Error Deleting";
				}
				$output = array('status'=>$dbStatus,'msg'=>$dbMessage);
				
				return $output; 
			break;
			
			// to get all category in multiselect
			
			case 'get_program_data_manage_app' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->distinct("A.program_group_code, A.program_group_name");
				$this->db->select("A.program_group_code, A.program_group_name");
				$this->db->from('program_group_master A');
				$this->db->join('counselling_program_master B','A.program_group_name = B.program_group','left');
				$this->db->where('B.institute_code',$institute_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'select_applications' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
				$applicant_name = isset($_POST['applicant_name'])?$_POST['applicant_name']:'';
				$reg_user_id = isset($_POST['reg_user_id'])?$_POST['reg_user_id']:'';
				
				
				
				$this->db->select("A.full_name,jee_roll_no,B.gender,C.category_name,A.mobile,A.email_id");
				$this->db->from('applicant_detail A');
				$this->db->join('gender_master B','A.gender=B.gender_code','left');
				$this->db->join('category_master C','A.category=C.category_code','left');
				if($applicant_name !='')
				{
					$this->db->where('applicant_detail.full_name',$applicant_name);
				}
				if($reg_user_id !='')
				{
					$this->db->where('applicant_detail.jee_roll_no',$reg_user_id);
				}
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			case 'get_course' :
				
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("program_code,program_name,id");
				$this->db->from('counselling_program_master');
				$this->db->where('record_status',1);
				
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
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
			case 'get_course_discipline' :
				
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("B.program_name,C.branch,A.program_code,A.branch_code,A.id");
				$this->db->from('counselling_program_branch_mapping A');
				$this->db->join('counselling_program_master B','A.program_code = B.program_code','inner');
				$this->db->join('counselling_branch_master C','A.branch_code = C.branch_code','inner');
				$this->db->where('A.record_status',1);
				
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			case 'get_discipline' :
				
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("branch_code,branch,id");
				$this->db->from('counselling_branch_master');
				$this->db->where('record_status',1);
				
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'select_program_manage_application' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
        		
        		$program_group = $_POST['program_group'];
				$program_type = $_POST['program_type'];
        		if($program_type == 'Old')
				{
					$this->db->select('P.program_code,program_name');
					$this->db->from('counselling_program_master P');
					$this->db->join('user_program_mapping U ',' P.program_code = U.program_code','inner');
					$this->db->where('P.institute_code',$institute_code);
					$this->db->where('program_group',$program_group);
					$this->db->where('program_end_date <',$date);
					$this->db->where('status','Active');
					$this->db->where('P.record_status','1');
					$this->db->where('U.record_status','1');
					$this->db->where('U.institute_code',$institute_code);
					$this->db->where('U.user_code',$user);
				}
				if($program_type == 'Current')
				{
					$this->db->select('P.program_code,program_name');
					$this->db->from('counselling_program_master P');
					$this->db->join('user_program_mapping U ',' P.program_code = U.program_code','inner');
					$this->db->where('P.institute_code',$institute_code);
					$this->db->where('program_group',$program_group);
					$this->db->where('program_end_date >=',$date);
					$this->db->where('status','Active');
					$this->db->where('P.record_status','1');
					$this->db->where('U.record_status','1');
					$this->db->where('U.institute_code',$institute_code);
					$this->db->where('U.user_code',$user);
				}
				
				
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
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
			
			case 'edit_manage_applications': 
			 
				$dbStatus = "SUCCESS";
				$dbMessage = "Updated Successfully";
            	
            	$program = $_POST['program'];
				$reg_user_id = $_POST['reg_user_id'];
				$mode = $_POST['mode'];
				
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				if($program != ''){
					$this->db->select('B.file_name');
					$this->db->from('counselling_program_master A');
					$this->db->join('form_template_master B ',' A.template_code = B.template_code','inner');
					$this->db->where('A.program_code',$program);
					$result = $this->db->get();
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					foreach ($output_data as $aRow) 
	            	{
	            		$output['aaData'][] = $aRow;
	            	}
	            	$this->session->set_userdata('admcode', $program);
	            	$this->session->set_userdata('reg_user_id', $reg_user_id);
	            	$this->session->set_userdata('mode', $mode);
				}
				return $output;	
			break;
			
			case 'get_applicant_details_scrutiny' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$logged_user_code = $this->session->userdata('user_code');
        		$program =  isset($_POST['program'])? $_POST['program']:'';
				$app_date = isset($_POST['app_date'])? $_POST['app_date']:'';
				$status = isset($_POST['status'])? $_POST['status']:'';
				$user_code_array=explode('_',$logged_user_code);
				$course_code = $user_code_array[0];
				if($course_code!='NIRTAR'){
					$this->db->where('B.master_name',$course_code);
				}
				if($app_date != '')
					$app_date = date('Y-m-d', strtotime($app_date));
				
				if($status != ''){
					$this->db->where('A.scrutiny_status',$status);	
					$this->db->order_by('A.updated_on desc');
				}
				else{
					$this->db->order_by('C.updated_on');
					$this->db->where('A.scrutiny_status is NULL');
				}	
				
					
				$this->db->select("SUBSTRING(C.appl_no,-10) as appl_no,A.reg_user_id,B.full_name,case when A.scrutiny_status='Valid' then 'Approved' when A.scrutiny_status='Invalid' then 'Rejected' when A.scrutiny_status is null then 'Applied' else A.scrutiny_status end as scrutiny_status ,A.scrutiny_remark,C.index_no,date_format(C.updated_on,'%d-%m-%Y %H:%i') as submission_date,date_format(A.updated_on,'%d-%m-%Y %H:%i') as scrutinized_date");
				$this->db->from('applicant_reg_master A');
				$this->db->join('applicant_master B','A.reg_user_id = B.reg_user_id AND A.applied_program = B.applied_program','inner');
				$this->db->join('applicant_appl_overview C ','A.reg_user_id = C.reg_user_id AND A.applied_program = C.applied_program','inner');
				$this->db->where('A.applied_program',$program);
				$this->db->where('C.appl_status','Verified');
				
				
				/*if($app_date == '' && $status == '' )
				{
					$this->db->select("C.appl_no,A.reg_user_id,B.full_name,case when A.scrutiny_status='Valid' then 'Approved' when A.scrutiny_status='Invalid' then 'Rejected' when A.scrutiny_status is null then 'Applied' else A.scrutiny_status end as scrutiny_status ,A.scrutiny_remark,C.index_no,date_format(C.updated_on,'%d-%m-%Y %H:%i') as submission_date");
					$this->db->from('applicant_reg_master A');
					$this->db->join('applicant_master B','A.reg_user_id = B.reg_user_id AND A.applied_program = B.applied_program','inner');
					$this->db->join('applicant_appl_overview C ','A.reg_user_id = C.reg_user_id AND A.applied_program = C.applied_program','inner');
					$this->db->where('A.applied_program',$program);
					$this->db->where('A.scrutiny_status is NULL');
					$this->db->where('C.appl_status','Verified');
					$this->db->order_by('C.updated_on');
				}
				else if($app_date == '' && $status != '')
				{
					$this->db->select("C.appl_no,A.reg_user_id,B.full_name,case when A.scrutiny_status='Valid' then 'Approved' when A.scrutiny_status='Invalid' then 'Rejected' when A.scrutiny_status is null then 'Applied' else A.scrutiny_status end as scrutiny_status ,A.scrutiny_remark,C.index_no,date_format(C.updated_on,'%d-%m-%Y %H:%i') as submission_date");
					$this->db->from('applicant_reg_master A');
					$this->db->join('applicant_master B','A.reg_user_id = B.reg_user_id AND A.applied_program = B.applied_program','inner');
					$this->db->join('applicant_appl_overview C ','A.reg_user_id = C.reg_user_id AND A.applied_program = C.applied_program','inner');
					$this->db->where('A.applied_program',$program);
					
					$this->db->where('C.appl_status','Verified');
					$this->db->order_by('C.updated_on');
				}
				else if($app_date != '' && $status == '')
				{
					$this->db->select("C.appl_no,A.reg_user_id,B.full_name,case when A.scrutiny_status='Valid' then 'Approved' when A.scrutiny_status='Invalid' then 'Rejected' when A.scrutiny_status is null then 'Applied' else A.scrutiny_status end as scrutiny_status ,A.scrutiny_remark,C.index_no,date_format(C.updated_on,'%d-%m-%Y %H:%i') as submission_date");
					$this->db->from('applicant_reg_master A');
					$this->db->join('applicant_master B','A.reg_user_id = B.reg_user_id AND A.applied_program = B.applied_program','inner');
					$this->db->join('applicant_appl_overview C ','A.reg_user_id = C.reg_user_id AND A.applied_program = C.applied_program','inner');
					$this->db->where('A.applied_program',$program);
					$this->db->where('DATE(C.updated_on)',$app_date);
					$this->db->where('A.scrutiny_status is NULL');
					$this->db->where('C.appl_status','Verified');
					$this->db->order_by('C.updated_on');
				}
				else
				{
					$this->db->select("C.appl_no,A.reg_user_id,B.full_name,case when A.scrutiny_status='Valid' then 'Approved' when A.scrutiny_status='Invalid' then 'Rejected' when A.scrutiny_status is null then 'Applied' else A.scrutiny_status end as scrutiny_status ,A.scrutiny_remark,C.index_no,date_format(C.updated_on,'%d-%m-%Y %H:%i') as submission_date");
					$this->db->from('applicant_reg_master A');
					$this->db->join('applicant_master B','A.reg_user_id = B.reg_user_id AND A.applied_program = B.applied_program','inner');
					$this->db->join('applicant_appl_overview C ','A.reg_user_id = C.reg_user_id AND A.applied_program = C.applied_program','inner');
					$this->db->where('A.applied_program',$program);
					$this->db->where('DATE(C.updated_on)',$app_date);
					$this->db->where('A.scrutiny_status',$status);
					$this->db->where('C.appl_status','Verified');
					$this->db->order_by('C.updated_on');
				}*/
				
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'get_program_group_scrutiny_applicants' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
				$this->db->distinct("P.program_group");
				$this->db->select("P.program_group");
				$this->db->from('counselling_program_master P');
				$this->db->join('user_program_mapping U','P.program_code = U.program_code ','inner');
				$this->db->join('program_group_master A ','P.program_group = A.program_group_name','inner');
				$this->db->where('P.institute_code',$institute_code);
				$this->db->where('U.institute_code',$institute_code);
				$this->db->where('U.user_code',$user);
				$this->db->where('P.record_status','1');
				$this->db->where('U.record_status','1');
				$this->db->where('A.record_status','1');
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'get_program_scrutiny_applicants' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$program_group =  isset($_POST['program_group'])? $_POST['program_group']:'';
        		
				$this->db->select("P.program_code,program_name");
				$this->db->from('counselling_program_master P');
				$this->db->join('user_program_mapping U','P.program_code = U.program_code ','inner');
				$this->db->where('P.institute_code',$institute_code);
				$this->db->where('program_group',$program_group);
				$this->db->where('U.institute_code',$institute_code);
				$this->db->where('U.user_code',$user);
				$this->db->where('status','Active');
				$this->db->where('U.record_status','1');
				$this->db->where('P.record_status','1');
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'program_group_sbi_applicants' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$program_group =  isset($_POST['program_group'])? $_POST['program_group']:'';
        		
				$this->db->distinct("A.program_group_code");
				$this->db->select("A.program_group_code, A.program_group_name");
				$this->db->from('program_group_master A');
				$this->db->join('counselling_program_master B','A.program_group_name = B.program_group','inner');
				$this->db->where('B.institute_code',$institute_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'program_sbi_applicants' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$program_group =  isset($_POST['program_group'])? $_POST['program_group']:'';
        		
				$this->db->select("P.program_code,program_name");
				$this->db->from('counselling_program_master P');
				$this->db->join('user_program_mapping U ','P.program_code = U.program_code ','inner');
				$this->db->where('P.institute_code',$institute_code);
				$this->db->where('P.program_end_date >=',$date);
				$this->db->where('P.program_group',$program_group);
				$this->db->where('P.status','Active');
				$this->db->where('P.record_status','1');
				$this->db->where('U.record_status','1');
				$this->db->where('U.institute_code',$institute_code);
				$this->db->where('U.user_code',$user);
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'applnt_details_sbi' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$selProgram =  isset($_POST['program'])? $_POST['program']:'';
        		$this->session->set_userdata('program', $selProgram);
        		
				$this->db->select("CONCAT(first_name,' ',IFNULL('',mid_name),' ',last_name) AS full_name,applicant_reg_master.reg_user_id AS reg_user_id,money_receipt_no,amount,DATE_FORMAT(depositdate,'%d-%m-%Y') AS depositdate ");
				$this->db->from('applicant_reg_master');
				$this->db->join('applicant_appl_overview ','applicant_reg_master.reg_user_id=applicant_appl_overview.reg_user_id AND applicant_reg_master.applied_program=applicant_appl_overview.applied_program','LEFT');
				$this->db->join('counselling_applicant_form_fee_overview','applicant_appl_overview.appl_no=counselling_applicant_form_fee_overview.appl_no','LEFT');
				$this->db->where('reg_status','verified');
				$this->db->where('appl_status','Fee Paid');
				$this->db->where('money_deposit_mode','CHALLAN');
				$this->db->where('applicant_reg_master.applied_program',$selProgram);
				$this->db->where('applicant_reg_master.status','1');
				$this->db->order_by('applicant_reg_master.id');
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'verify_sbi_applnts' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s");
        		$dbstatus = FALSE;
        		
        		$reg_id =  isset($_POST['reg_user_id'])? $_POST['reg_user_id']:'';
        		$selProgram = $this->session->userdata('program');
        		
				$this->db->select("id,program_name,program_code,DATE_FORMAT(program_end_date,'%d-%m-%Y') AS program_end_date");
				$this->db->from('counselling_program_master');
				$this->db->where('program_code',$selProgram);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$dbstatus = TRUE;
					$admname = $row['program_name'];
					$admcode = $row['program_code'];
					$program_end_date = $row['program_end_date'];
	            }
	            
	            $this->db->select("reg_mode,email_id,last_grade");
				$this->db->from('applicant_reg_master A');
				$this->db->join('applicant_master B','A.reg_user_id = B.reg_user_id AND A.applied_program =  B.applied_program','INNER');
				$this->db->where('A.reg_user_id',$reg_id);
				$this->db->where('A.applied_program',$selProgram);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row4) 
	            {
	            	$dbstatus = TRUE;
					$Email = $row4['email_id'];
					$pass_status = $row4['last_grade'];
	            }
	            
	            $this->db->select("index_no");
				$this->db->from('applicant_appl_overview');
				$this->db->where('reg_user_id',$reg_id);
				$this->db->where('applied_program',$selProgram);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row1) 
	            {
	            	$dbstatus = TRUE;
					$index_no = $row1['index_no'];
	            }
	            $index = $index_no;
				$sequence_no = 0;
				
				if($index_no == '')
				{
					$this->db->select("A.program_code,A.year,A.sequence_code,sequence_no");
					$this->db->from('index_sequence_setup A');
					$this->db->where('A.program_code',$selProgram);
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					foreach ($output_data as $row1) 
		            {
		            	$dbstatus = TRUE;
						$year = $row1['year'];
						$sequence_no = $row1['sequence_no'];
						$key = $row1['sequence_code'];
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
	            
	            $applicant_address_array4 = array(
					'appl_status' => 'Verified',
					'index_no' => $index_no,
					'updated_by' => $reg_id,
					'updated_on' => $now
				);
				$this->db->where('reg_user_id',$reg_id);
				$this->db->where('applied_program',$selProgram);
				$update_applicant = $this->db->update('applicant_appl_overview',$applicant_address_array4);
				
				$this->db->select("appl_no");
				$this->db->from('applicant_appl_overview');
				$this->db->where('reg_user_id',$reg_id);
				$this->db->where('applied_program',$selProgram);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row1) 
	            {
	            	$dbstatus = TRUE;
					$application_no = $row1['appl_no'];
	            }
				
				$update_applicant_qualification_array = array(
					'id' => NULL,
					'reg_user_id' => $reg_id,
					'appl_no' => $application_no,
					'form_no' => $application_no,
					'applied_program' => $selProgram,
					'appl_status' => 'Verified',
					'created_by' => $reg_id,
					'created_on' => $now
				);
				$this->db->insert('applicant_appl_overview_history',$update_applicant_qualification_array);
				$new_seq_no = $sequence_no + 1;
				
				if($index == '')
				{
					$applicant_address_array5 = array(
						'sequence_no' => $new_seq_no
					);
					$this->db->where('program_code',$selProgram);
					$update_applicant = $this->db->update('index_sequence_setup',$applicant_address_array5);
					$dbstatus = TRUE;
				}
				
				
				$applicant_address_array6 = array(
					'collectiondate' => $date,
					'deposit_status' => 'Deposited',
					'updated_by' => $reg_id,
					'updated_on' => $now,
				);
				$this->db->where('appl_no',$application_no);
				$update_applicant = $this->db->update('applicant_form_challan_deposit',$applicant_address_array6);
				
				$contact_no = $reg_id;  //$contact_no .= ','.$row['people_contact_no'];(for comma separated mobile no)
			
				return array('status' => $dbstatus);
			break;
			
			case 'disqualify_scrutiny_applicants': 
			 
				$dbStatus = "SUCCESS";
				$dbMessage = "Updated Successfully";
            	
            	$program =  isset($_POST['hidProgram'])? $_POST['hidProgram']:'';
				$reg_user_id =  isset($_POST['hidRegUserId'])? $_POST['hidRegUserId']:'';
				$remark =  isset($_POST['taRemark'])? $_POST['taRemark']:'';
				
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$logged_user_code = $this->session->userdata('user_code');
				$user = $logged_user.'_'.$institute_code;
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$update_data = array(
					'scrutiny_status' 				=>'Invalid',
					'scrutiny_remark' 				=>$remark,
					'updated_by'					=>$logged_user_code,
					'updated_on'					=>$date
				);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program);
				$sql = $this->db->update('applicant_reg_master', $update_data);
				//echo $this->db->last_query();
				if(!$sql){
					$dbStatus = "ERROR";
					$dbMessage = "Error Inserting";
					//$dbError = ;	
				}
				$this->db->select('*');
				$this->db->from('applicant_reg_master arm');
				$this->db->join('applicant_master am','am.reg_user_id = am.reg_user_id and am.applied_program =arm.applied_program','INNER');
				$this->db->join('applicant_appl_overview aao','am.reg_user_id = aao.reg_user_id and am.applied_program =aao.applied_program','INNER');
				$this->db->join('course_master cm','cm.course_code = am.master_name','INNER');
				$this->db->where('arm.reg_user_id',$reg_user_id);
				$this->db->where('arm.applied_program',$program);
				$result_output = $this->db->get();
				
				foreach ($result_output->result_array() as $row5) 
		            {
		            	
						$full_name = $row5['full_name'];
						$course_name = $row5['course_name'];
						$appl_no = $row5['appl_no'];
						$email_id = $row5['email_id'];
		            }
				if($dbStatus == "SUCCESS")
				{
						$this->db->select('es.email_type,es.subject,es.content');
						$this->db->from('email_setup es');
						$this->db->join('program_email_setup pes','es.email_type = pes.email_type','inner');
						$this->db->limit(1);
						$this->db->where('es.email_type','DISQUALIFY');
						$this->db->where('pes.institute_code',HARDCODE_INSTITUTE_CODE);
						
						//echo $this->db->last_query(); die();
						
						$result = $this->db->get();
						$query = $result->result_array();
						$row_count = $result->num_rows();
						foreach($result->result_array() AS $row1)
						{
							$email_type=$row1['email_type'];
							$subject=$row1['subject'];
							$content=$row1['content'];
						}
						$msgContent = $content;
				        $msgContent = str_replace("[name]",$full_name,$msgContent );
				        $msgContent = str_replace("[course_name]",$course_name,$msgContent );
				        $msgContent = str_replace("[appl_no]",$appl_no,$msgContent );
				        $msgContent = str_replace("[scrutiniser_name]",$course_name.' department head',$msgContent );
				        $msgContent = str_replace("[remark]",$remark,$msgContent );
						if($row_count > 0){
						     $this->load->library('email');
						     $this->email->set_newline("\r\n");
						     $this->email->set_mailtype("html");
						     //set email information and content
						     $this->email->from('svnirtar.pget2018@gmail.com', 'NIRTAR ADMIN');
						     $this->email->to($email_id);
						     //$this->email->to('rahul.patro@silicontechlab.com');
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
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				else
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				return $output;	
			break;
			
			case 'qualify_scrutiny_applicants': 
			 
				$dbStatus = "SUCCESS";
				$dbMessage = "Updated Successfully";
            	
				$program =  isset($_POST['program'])? $_POST['program']:'';
				$reg_user_id =  isset($_POST['reg_user_id'])? $_POST['reg_user_id']:'';
				
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$logged_user_code = $this->session->userdata('user_code');
				$user = $logged_user.'_'.$institute_code;
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$update_data = array(
					'scrutiny_status' 			=>'Valid',
					'scrutiny_remark' 			=>'',
					'updated_by' 				=>$logged_user_code,
					'updated_on' 				=>$date
				);
				
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program);
				$sql = $this->db->update('applicant_reg_master', $update_data);
				//echo $this->db->last_query(); die();
				if(!$sql){
					$dbStatus = "ERROR";
					$dbMessage = "Error Inserting";
					//$dbError = ;	
				}
				if($dbStatus == "SUCCESS")
				{
					$this->db->select('*');
					$this->db->from('applicant_reg_master arm');
					$this->db->join('applicant_master am','am.reg_user_id = am.reg_user_id and am.applied_program =arm.applied_program','INNER');
					$this->db->join('applicant_appl_overview aao','am.reg_user_id = aao.reg_user_id and am.applied_program =aao.applied_program','INNER');
					$this->db->join('course_master cm','cm.course_code = am.master_name','INNER');
					$this->db->where('arm.reg_user_id',$reg_user_id);
					$this->db->where('arm.applied_program',$program);
					$result_output = $this->db->get();
					
					foreach ($result_output->result_array() as $row5) 
		            {
		            	
						$full_name = $row5['full_name'];
						$course_name = $row5['course_name'];
						$appl_no = $row5['appl_no'];
						$email_id = $row5['email_id'];
		            }
		            
					$this->db->select('es.email_type,es.subject,es.content');
					$this->db->from('email_setup es');
					$this->db->join('program_email_setup pes','es.email_type = pes.email_type','inner');
					$this->db->limit(1);
					$this->db->where('es.email_type','QUALIFY');
					$this->db->where('pes.institute_code',HARDCODE_INSTITUTE_CODE);
					
					//echo $this->db->last_query(); die();
					
					$result = $this->db->get();
					$query = $result->result_array();
					$row_count = $result->num_rows();
					foreach($result->result_array() AS $row1)
					{
						$email_type=$row1['email_type'];
						$subject=$row1['subject'];
						$content=$row1['content'];
					}
					$msgContent = $content;
			        $msgContent = str_replace("[name]",$full_name,$msgContent );
			        $msgContent = str_replace("[course_name]",$course_name,$msgContent );
			        $msgContent = str_replace("[appl_no]",$appl_no,$msgContent );
			        $msgContent = str_replace("[scrutiniser_name]",$course_name.' department head',$msgContent );
					if($row_count > 0){
					     $this->load->library('email');
					     $this->email->set_newline("\r\n");
					     $this->email->set_mailtype("html");
					     //set email information and content
					     $this->email->from('svnirtar.pget2018@gmail.com', 'NIRTAR ADMIN');
					     $this->email->to($email_id);
					     //$this->email->to('rahul.patro@silicontechlab.com');
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
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				else
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				return $output;	
			break;
			
			case 'get_template_scrutiny_applicants' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$program =  isset($_POST['program'])? $_POST['program']:'';
        		
				$this->db->select("A.template_code,B.file_name,B.template_name");
				$this->db->from('counselling_program_master A');
				$this->db->join('form_template_master B','A.template_code = B.template_code','inner');
				$this->db->where('A.program_code',$program);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	            	$file_name = $aRow['file_name'];
					$temp_code = $aRow['template_code'];
					$temp = explode(".",$file_name);
					$temp_name = $temp[0];
					$output = $temp_name;
	                unset($row);
	            }
	           	return $output;
			break;
			
			case 'program_group_admit_setup' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		
				$this->db->distinct("A.program_group_code, A.program_group_name");
				$this->db->select("A.program_group_code, A.program_group_name");
				$this->db->from('program_group_master A');
				$this->db->join('counselling_program_master B','A.program_group_name = B.program_group','inner');
				$this->db->where('B.institute_code',$institute_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'program_admit_setup' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$program_type = $_POST['program_type'];
				$program_group = $_POST['program_group'];
				
				if($program_type == 'Old')
				{
					$this->db->select("program_code,program_name");
					$this->db->from('counselling_program_master');
					$this->db->where('institute_code',$institute_code);
					$this->db->where('program_group',$program_group);
					$this->db->where('program_end_date <',$date);
					$this->db->where('record_status','1');
					$this->db->where('status','Active');
				}
				else
				{
					$this->db->select("program_code,program_name");
					$this->db->from('counselling_program_master');
					$this->db->where('institute_code',$institute_code);
					$this->db->where('program_group',$program_group);
					$this->db->where('program_end_date >=',$date);
					$this->db->where('record_status','1');
					$this->db->where('status','Active');
				}
				
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'exam_centre_admit_setup' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
				$program_code = $_POST['program_code'];
				
				$this->db->select("A.exam_centre_code,B.exam_centre_name");
				$this->db->from('exam_centre_master A ');
				$this->db->join('exam_centre B','A.exam_centre_code = B.exam_centre_code','left');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.record_status','1');
				
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'exam_venue_admit_setup' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
				$program_code = $_POST['program_code'];
				$exam_center_code = $_POST['exam_centre_code'];
				
				$this->db->select("exam_vanue_code,exam_vanue");
				$this->db->from('admitcard_setup');
				$this->db->where('program_code',$program_code);
				$this->db->where('exam_center_code',$exam_center_code);
				$this->db->where('record_status','1');
				
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'change_program_setup' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$program_code = $_POST['program_code'];
				$reg_user_id = $_POST['reg_user_id'];
        		
				$this->db->select("A.appl_no,B.full_name,DATE_FORMAT(C.dob,'%d-%m-%Y') as dob");
				$this->db->from('applicant_appl_overview A');
				$this->db->join('applicant_reg_master C','C.reg_user_id = A.reg_user_id AND C.applied_program = A.applied_program','inner');
				$this->db->join('applicant_master B','C.reg_user_id = B.reg_user_id AND C.applied_program = B.applied_program','inner');
				$this->db->where('C.reg_user_id',$reg_user_id);
				$this->db->where('C.applied_program',$program_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			case 'change_program' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
				$program_group = $_POST['program_group'];
				$program_code = $_POST['program_code'];
        		
				$this->db->select("program_code,program_name");
				$this->db->from('counselling_program_master');
				$this->db->where('program_group',$program_group);
				$this->db->where('program_code!=',$program_code);
				$this->db->where('institute_code',$institute_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'change_program_admit_card_setup' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$program_code = $_POST['program_code'];
				$reg_user_id = $_POST['reg_user_id'];
				$appl_no = $_POST['appl_no'];
				$change_program_code = $_POST['change_program_code'];
        		
				$this->db->select("A.template_code,B.file_name,B.template_name");
				$this->db->from('counselling_program_master A');
				$this->db->join('form_template_master B','A.template_code = B.template_code','inner');
				$this->db->where('A.program_code',$program_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	                $file_name = $row['file_name'];
					$temp_code = $row['template_code'];
					$temp_name = explode(".",$file_name);
					$print_function = $temp_name[0]."_pdf";
	            }
	            
	            $this->db->select("program_code,year,sl_no");
				$this->db->from('counselling_program_master');
				$this->db->where('program_code',$change_program_code);
				$this->db->where('STATUS','Active');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $result) 
	            {
	                $sl_no = $result['sl_no'];
					$new_program_code = $result['program_code'];
					$year = $result['year'];
	            }
	            
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
				
				$application_no = $new_program_code.$year.$changed_sl_no;
		
				$src = DOCUMENT_UPLOAD_URL."/$program_code/$appl_no";
				$dst = DOCUMENT_UPLOAD_URL."/$change_program_code/$application_no";
				$this->recurse_copy($src,$dst);
				
				
				
				$this->db->trans_start();
				
				$applicant_reg_master = array(
					'applied_program' => $change_program_code
				);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program_code);
				$regUpdate = $this->db->update('applicant_reg_master',$applicant_reg_master);
				
				$applicant_appl_overview = array(
					'appl_no' => $application_no
				);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$change_program_code);
				$this->db->where('appl_no',$appl_no);
				$applUpdate = $this->db->update('applicant_appl_overview',$applicant_appl_overview);
				
				$counselling_program_master = array(
					'sl_no' => $new_sl_no
				);
				$this->db->where('program_code',$change_program_code);
				$this->db->where('STATUS','Active');
				$query = $this->db->update('counselling_program_master',$counselling_program_master);
	            
	            
	            if($regUpdate and $applUpdate and $query)
				{
					
					$db_application_log = array(
									'reg_user_id' => $reg_user_id,
									'change_from_program' => $program_code,
									'change_to_program' => $change_program_code,
									'change_from_appl_no' => $appl_no,
									'change_to_appl_no' => $application_no,
									'change_status' => 'SUCCESS',
									'log_datetime' => $date
								);
					$this->db->insert('db_application_log',$db_application_log);
					
					$this->db->select("document_path,document_type");
					$this->db->from('applicant_form_documents');
					$this->db->where('appl_no',$application_no);
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					$allDocs = array();
					foreach ($output_data as $row) 
		            {
		               $allDocs[] = $row;
		            }
					
					foreach($allDocs as $row)
					{
						$arr = '';
						$document_type = $row['document_type'];
						$arr = explode('/',$row['document_path']);
						$file_name = end($arr);
						$new_path = BASE_ADM_URL."/esdocuments/admission/$change_program_code/$application_no/$file_name";
						$new_doc_id = $application_no.'_'.$document_type;
						
						$applicant_form_documents = array(
							'doc_id' => $new_doc_id,
							'document_path' => $new_path
						);
						$this->db->where('document_type',$document_type);
						$this->db->where('appl_no',$application_no);
						$uQuery = $this->db->update('applicant_form_documents',$applicant_form_documents);
					}
					//$_SESSION['reg_user_id'] = $reg_user_id;
					//$_SESSION['admcode'] = $change_program_code;
					$this->session->set_userdata('reg_user_id',$reg_user_id);
		            $this->session->set_userdata('admcode',$change_program_code);
					
					//$objMpdf = new Mpdf_controller();
					$controllerInstance = & get_instance();
	    			$return = $controllerInstance->$print_function();
					if($return == true)
					{
						if(file_exists(DOCUMENT_UPLOAD_URL.'/'.$change_program_code.'/'.$application_no.'/application_print_008.pdf'))
						{
							$this->db->trans_complete();
							$output = "Successfully Changed";
							$this->session->set_userdata('reg_user_id','');
		           			$this->session->set_userdata('admcode','');
							//$_SESSION['reg_user_id'] = '';
							//$_SESSION['admcode'] = '';
						}
						else
						{
							$this->db->trans_rollback();
							$output = "Error_in_pdf_save";
							$this->session->set_userdata('reg_user_id','');
		           			$this->session->set_userdata('admcode','');
						}
					}
					else
					{
						$this->db->trans_rollback();
						$output = "Error_in_pdf_generate";
						$_SESSION['reg_user_id'] = '';
						$_SESSION['admcode'] = '';
					}
					
					
				}	
				else 
				{
					
					$db_application_log = array(
									'reg_user_id' => $reg_user_id,
									'change_from_program' => $program_code,
									'change_to_program' => $change_program_code,
									'change_from_appl_no' => $appl_no,
									'change_to_appl_no' => $application_no,
									'change_status' => 'FAILURE'
								);
					$this->db->insert('db_application_log',$db_application_log);
					
					$this->db->trans_rollback();
					$output = "Something is wrong. Program Not Changed";
				}
	            
				return $output;
	           
			break;
			case 'check_mobile_admit_card_setup' :
			
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$program_code = $_POST['program_code'];
				$reg_user_id = $_POST['reg_user_id'];
				$change_reg_user_id = $_POST['change_reg_user_id'];
				
				$this->db->select("count(reg_user_id) as cnt");
				$this->db->from('applicant_reg_master');
				$this->db->where('reg_user_id',$change_reg_user_id);
				$this->db->where('applied_program',$program_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $row) 
	            {
	                $output['aaData'][] = $row['cnt'];
	            }
				return $output;
	           
			break;
			
			case 'change_mobile_admit_card_setup' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$program_code = $_POST['program_code'];
				$reg_user_id = $_POST['reg_user_id'];
				$change_reg_user_id = $_POST['change_reg_user_id'];
				
				$this->db->select("appl_no");
				$this->db->from('applicant_appl_overview');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	                $application_no = $row['appl_no'];
	            }
	            
	            $this->db->select("A.template_code,B.file_name,B.template_name");
				$this->db->from('counselling_program_master A');
				$this->db->join('form_template_master B','A.template_code = B.template_code','inner');
				$this->db->where('A.program_code',$program_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	                $file_name = $row['file_name'];
					$temp_code = $row['template_code'];
					$temp_name = explode(".",$file_name);
					$print_function = $temp_name[0]."_pdf";
	            }
	            
	            $applicant_reg_master = array(
					'reg_user_id' => $change_reg_user_id
				);
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$query = $this->db->update('applicant_reg_master',$applicant_reg_master);
				//echo $this->db->last_query();
	            $output = "Registered Mobile Successfully Changed";
	            $this->session->set_userdata('reg_user_id',$change_reg_user_id);
	            $this->session->set_userdata('admcode',$program_code);
	            $this->session->set_userdata('appl_no',$application_no);
            	//$objMpdf = new Mpdf_controller();
				$controllerInstance = & get_instance();
    			$return = $controllerInstance->$print_function();
	            //$return = $print_function();
	            
				if($return == true)
				{
					if(file_exists(DOCUMENT_UPLOAD_URL.'/'.$program_code.'/'.$application_no.'/application_print_008.pdf'))
					{
						//mysqli_commit($con);
						$output = "Successfully Changed";
						$this->session->set_userdata('reg_user_id','');
			            $this->session->set_userdata('admcode','');
			            $this->session->set_userdata('appl_no','');
						//$_SESSION['reg_user_id'] = '';
						//$_SESSION['admcode'] = '';
					}
					else
					{
						//mysqli_rollback($con);
						$output = "Error_in_pdf_save";
						$this->session->set_userdata('reg_user_id','');
			            $this->session->set_userdata('admcode','');
			            $this->session->set_userdata('appl_no','');
						//$_SESSION['reg_user_id'] = '';
						//$_SESSION['admcode'] = '';
					}
				}
				else
				{
					//mysqli_rollback($con);
					$output = "Error_in_pdf_generate";
					//$_SESSION['reg_user_id'] = '';
					//$_SESSION['admcode'] = '';
				}
	            
				return $output;
	           
			break;
			case 'get_change_dob' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$program_code = $_POST['program_code'];
				$reg_user_id = $_POST['reg_user_id'];
				$change_dob = $_POST['change_dob'];
				$change_dob1 = date('Y-m-d', strtotime($change_dob));
				
				
				$this->db->select("appl_no");
				$this->db->from('applicant_appl_overview');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	                $application_no = $row['appl_no'];
	            }
	            
	            $this->db->select("A.template_code,B.file_name,B.template_name");
				$this->db->from('counselling_program_master A');
				$this->db->join('form_template_master B','A.template_code = B.template_code','inner');
				$this->db->where('A.program_code',$program_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	                $file_name = $row['file_name'];
					$temp_code = $row['template_code'];
					$temp_name = explode(".",$file_name);
					$print_function = $temp_name[0]."_pdf";
	            }
	            
	            $applicant_reg_master = array(
					'dob' => $change_dob1
				);
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$query = $this->db->update('applicant_reg_master',$applicant_reg_master);
				//echo $this->db->last_query();
	            $output = "Registered DOB Successfully Changed";
	            
	            $this->session->set_userdata('reg_user_id',$reg_user_id);
	            $this->session->set_userdata('admcode',$program_code);
	            $this->session->set_userdata('appl_no',$application_no);
            	//$objMpdf = new Mpdf_controller();
				$controllerInstance = & get_instance();
    			$return = $controllerInstance->$print_function();
	            //$return = $print_function();
	            
				if($return == true)
				{
					if(file_exists(DOCUMENT_UPLOAD_URL.'/'.$program_code.'/'.$application_no.'/application_print_008.pdf'))
					{
						//mysqli_commit($con);
						$output = "Successfully Changed";
						$this->session->set_userdata('reg_user_id','');
			            $this->session->set_userdata('admcode','');
			            $this->session->set_userdata('appl_no','');
						//$_SESSION['reg_user_id'] = '';
						//$_SESSION['admcode'] = '';
					}
					else
					{
						//mysqli_rollback($con);
						$output = "Error_in_pdf_save";
						$this->session->set_userdata('reg_user_id','');
			            $this->session->set_userdata('admcode','');
			            $this->session->set_userdata('appl_no','');
						//$_SESSION['reg_user_id'] = '';
						//$_SESSION['admcode'] = '';
					}
				}
				else
				{
					//mysqli_rollback($con);
					$output = "Error_in_pdf_generate";
					//$_SESSION['reg_user_id'] = '';
					//$_SESSION['admcode'] = '';
				}
	            
				return $output;
	           
			break;
			
			case 'get_check_mobile_number_change_dob' :
			
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$program_code = $_POST['program_code'];
				$reg_user_id = $_POST['reg_user_id'];
				//$change_reg_user_id = $_POST['change_reg_user_id'];
				
				$this->db->select("count(reg_user_id) as cnt");
				$this->db->from('applicant_reg_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $row) 
	            {
	                $output['aaData'][] = $row['cnt'];
	            }
				return $output;
	           
			break;
			
			
			case 'applicants_program_name_admit_setup': 
            	
            	$sel_program = isset($_POST['program_code']) ? $_POST['program_code'] : '';
				$sel_exam_center = isset($_POST['applied_exam_center_code']) ? $_POST['applied_exam_center_code'] : '';
				$application_date = isset($_POST['applied_date']) ? $_POST['applied_date'] : '';
			 	
				$this->db->select("program_name, program_code");
				$this->db->from('counselling_program_master');
				$this->db->where('program_code',$sel_program);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$sel_program_code = $row['program_code'];
					$sel_program_name = $row['program_name'];
	            }
				$output = array('program_code'=>$sel_program_code,'program_name'=>$sel_program_name);
			
				return $output; 
			break;
			
			case 'applicants_exam_centre_name_admit_setup': 
            	
            	$sel_program = isset($_POST['program_code']) ? $_POST['program_code'] : '';
				$sel_exam_center = isset($_POST['applied_exam_center_code']) ? $_POST['applied_exam_center_code'] : '';
				$application_date = isset($_POST['applied_date']) ? $_POST['applied_date'] : '';
			 	
				$this->db->select("exam_centre_code, exam_centre_name");
				$this->db->from('exam_centre_master');
				$this->db->where('program_code',$sel_program);
				$this->db->where('exam_centre_code',$sel_exam_center);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$sel_exam_center_code = $row['exam_centre_code'];
					$sel_exam_center_name = $row['exam_centre_name'];
	            }
				$output = array('exam_center_code'=>$sel_exam_center_code,'exam_center_name'=>$sel_exam_center_name);
			
				return $output; 
			break;
			
			case 'applicants_centre_admit_setup': 
            	
            	$sel_program = isset($_POST['program_code']) ? $_POST['program_code'] : '';
			 	
				$this->db->select("A.exam_centre_code,B.exam_centre_name");
				$this->db->from('exam_centre_master A ');
				$this->db->join('exam_centre B','A.exam_centre_code = B.exam_centre_code','LEFT');
				$this->db->where('program_code',$sel_program);
				$this->db->where('A.record_status','1');
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'applicants_capacity_admit_setup': 
            	
            	$sel_program = isset($_POST['program_code']) ? $_POST['program_code'] : '';
				$exam_vanue = isset($_POST['vanue']) ? $_POST['vanue'] : '';
				$exam_center_code = isset($_POST['center']) ? $_POST['center'] : '';
			 	
				$this->db->select("A.capacity,COUNT(B.id) AS no_of_assign");
				$this->db->from('admitcard_setup A');
				$this->db->join('admitcard_published B','A.program_code = B.applied_program 
				AND A.exam_center_code = B.assigned_exam_center AND A.exam_vanue_code = B.assigned_exam_vanue','LEFT');
				$this->db->where('A.program_code',$sel_program);
				$this->db->where('A.exam_center_code',$exam_center_code);
				$this->db->where('A.exam_vanue_code',$exam_vanue);
				$this->db->where('A.record_status','1');
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'applicants_venue_admit_setup': 
            	
            	$sel_program = isset($_POST['program_code']) ? $_POST['program_code'] : '';
            	$sel_exam_center = isset($_POST['applied_exam_center_code']) ? $_POST['applied_exam_center_code'] : '';
			 	
				$this->db->select("exam_vanue_code,exam_vanue");
				$this->db->from('admitcard_setup');
				$this->db->where('program_code',$sel_program);
				$this->db->where('exam_center_code',$sel_exam_center);
				$this->db->where('record_status','1');
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'get_assign_applicants_centre_admit_setup': 
            	$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
            	$dbstatus = '';
            	
            	$sel_program = isset($_POST['program_code']) ? $_POST['program_code'] : '';
            	$sel_exam_center = isset($_POST['applied_exam_center_code']) ? $_POST['applied_exam_center_code'] : '';
            	$application_date = isset($_POST['applied_date']) ? $_POST['applied_date'] : '';
            	$assigned_exam_center = isset($_POST['examCenter']) ? $_POST['examCenter'] : '';
	
				$assigned_exam_vanue = isset($_POST['examVanue']) ? $_POST['examVanue'] : '';
			 	$arr_sel_applicants = $_POST['chkApplicant'];
			 	
				$this->db->select("program_name, program_code");
				$this->db->from('counselling_program_master');
				$this->db->where('program_code',$sel_program);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$sel_program_code = $row['program_code'];
					$sel_program_name = $row['program_name'];
	            }
	            
	            $this->db->select("document_type_code");
				$this->db->from('program_document_setup');
				$this->db->where('program_code',$sel_program);
       			$where = '(record_status = "Active" OR record_status="1")';
       			$this->db->where($where);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$documentsReq = array();
				foreach ($output_data as $row) 
	            {
	            	$documentsReq[] = $row;
	            }
	            foreach($documentsReq as $row)
				{
					if(in_array('SIG',$row))
					{
						$sigDoc = 1;
						//echo $sigDoc;
					}
					if(in_array('PHO',$row))
					{
						$phoDoc = 1;
						//echo $sigDoc;
					}
				}
	            
	            $this->db->select("exam_centre_code, exam_centre_name");
				$this->db->from('exam_centre_master');
				$this->db->where('program_code',$sel_program);
				$this->db->where('exam_centre_code',$sel_exam_center);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$sel_exam_center_code = $row['exam_centre_code'];
					$sel_exam_center_name = $row['exam_centre_name'];
	            }
	            
	            $this->db->select("exam_centre_code, exam_centre_name");
				$this->db->from('admitcard_exam_centre_master');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$allAdmitcardExamCenters[] = $row;
	            }
	            
	            //get the latest OMR NO
				$last_omr_no = 0;
				
				$this->db->select("MAX(omr_no) AS last_omr_no ");
				$this->db->from('admitcard_published');
				$this->db->where('applied_program',$sel_program);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$last_omr_no = $row['last_omr_no'];
	            }
	            
	            if($last_omr_no == 0 ||$last_omr_no == '' )
				{
					$this->db->select("omr_no");
					$this->db->from('counselling_program_master');
					$this->db->where('program_code',$sel_program);
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					foreach ($output_data as $row) 
		            {
		            	$omr_no = $row['omr_no'];
		            }
				}
				else
					$omr_no = $last_omr_no+1;
				
				foreach($arr_sel_applicants as $appl_no)
				{
					$new_data = array(
						'appl_no' 							=>$appl_no,
						'applied_program' 					=>$sel_program,
						'applied_exam_center' 				=>$sel_exam_center,
						'assigned_exam_center' 				=>$assigned_exam_center,
						'assigned_exam_vanue' 				=>$assigned_exam_vanue,
						'omr_no' 							=>$omr_no,
						'created_by' 						=>$logged_user,
						'created_on' 						=>$date,
						'record_status'						=>'1'
					);
								
					$sql = $this->db->insert('admitcard_published', $new_data);
					$dbstatus = 'SUCCESS';
					$omr_no++;
				}
	           	$output = array('status'=>$dbstatus);
	           	
	           	return $output; 
			break;
			
			
			case 'applicants_admit_setup' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		/*$sel_program = $data['program_code'];
        		$sel_exam_center = $data['exam_centre'];
        		$application_date = $data['applied_date'];*/
        		/*echo $sel_program;
        		die();*/
        		
        		$sel_program = isset($_POST['program_code']) ? $_POST['program_code'] : '';
				$sel_exam_center = isset($_POST['applied_exam_center_code']) ? $_POST['applied_exam_center_code'] : '';
				$application_date = isset($_POST['applied_date']) ? $_POST['applied_date'] : '';
        		
        		$html = '';
        		$html .= '<table class="table table-bordered" id="tblApplicantDetails">
								<thead>
									<tr>
										<th>
											#
											<input class="Allcheckbox" type="checkbox" id="chkSelectAll" name="chkSelectAll" onclick="allcheck(\'Allcheckbox\',\'checkbox1\')"/>
										</th>
										<th class="text-center">Name</th>
										<th class="text-center">Mobile No</th>
										<th class="text-center">Appl No</th>
										<th class="text-center">Applied On</th>
										<th class="text-center">Fee Paid Mode</th>
										<th class="text-center">Amount</th>
										<th class="text-center">Fee Paid On</th>
										<th class="text-center">Receipt No</th>
										<th class="text-center">Photo</th>
										<th class="text-center">Signature</th>
									</tr>
								</thead>
								<tbody id="applicantBody">';
        		
        		
        		
        		
				$this->db->select("program_name, program_code");
				$this->db->from('counselling_program_master');
				$this->db->where('program_code',$sel_program);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$sel_program_code = $row['program_code'];
					$sel_program_name = $row['program_name'];
	            }
	            
	            $this->db->select("document_type_code");
				$this->db->from('program_document_setup');
				$this->db->where('program_code',$sel_program);
       			$where = '(record_status = "Active" OR record_status="1")';
       			$this->db->where($where);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$documentsReq = array();
				foreach ($output_data as $row) 
	            {
	            	$documentsReq[] = $row;
	            }
	            foreach($documentsReq as $row)
				{
					if(in_array('SIG',$row))
					{
						$sigDoc = 1;
						//echo $sigDoc;
					}
					if(in_array('PHO',$row))
					{
						$phoDoc = 1;
						//echo $sigDoc;
					}
				}
	            
	            $this->db->select("exam_centre_code, exam_centre_name");
				$this->db->from('exam_centre_master');
				$this->db->where('program_code',$sel_program);
				$this->db->where('exam_centre_code',$sel_exam_center);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$sel_exam_center_code = $row['exam_centre_code'];
					$sel_exam_center_name = $row['exam_centre_name'];
	            }
	            
	            $this->db->select("exam_centre_code, exam_centre_name");
				$this->db->from('admitcard_exam_centre_master');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$allAdmitcardExamCenters[] = $row;
	            }
	            
	            //get the latest OMR NO
				$last_omr_no = 0;
				
				$this->db->select("MAX(omr_no) AS last_omr_no ");
				$this->db->from('admitcard_published');
				$this->db->where('applied_program',$sel_program);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$last_omr_no = $row['last_omr_no'];
	            }
	            $dt = date("Y-m-d H:i:s",strtotime($application_date."23:59:59"));
	            $allApplicants = array();
	            if($sel_program != '' && $sel_exam_center != '' && $application_date != '')
				{
					//get set up details for selected program and exam center
					
					$where = "(B.updated_on <= '$dt' OR B.created_on <= '$dt')";
					$where1 = "B.appl_no NOT IN (SELECT appl_no FROM admitcard_published WHERE applied_program='$sel_program'
						AND applied_exam_center = '$sel_exam_center')";
					$this->db->select("A.full_name, B.appl_no, B.form_no, A.reg_user_id, B.updated_on, B.created_on, D.money_deposit_mode, 
						amount, depositdate, money_receipt_no,E.document_path AS passport_path,F.document_path AS signature_path");
					$this->db->from('applicant_master A');
					$this->db->join('applicant_appl_overview B','A.applied_program = B.applied_program','inner');
					$this->db->join('counselling_applicant_form_fee_overview D','B.appl_no = D.appl_no ','inner');
					$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='PHO') E",'B.appl_no = E.appl_no','inner');
					$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='SIG') F",'B.appl_no = F.appl_no','inner');
					$this->db->where('B.appl_status','Verified');
					$this->db->where('A.applied_program',$sel_program);
					$this->db->where('A.exam_center_code',$sel_exam_center);
					$this->db->where($where);
					$this->db->where($where1);
					$this->db->order_by("B.updated_on", "asc");
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					foreach ($output_data as $row) 
		            {
		                $allApplicants[] = $row;
		            }
		            $sl_no = 1;
		            
		            foreach($allApplicants as $row)
					{
						if($row['money_deposit_mode'] == 'ON THE COUNTER')
							$appl_date = $row['created_on'];
						else
							$appl_date = $row['updated_on'];
						$applNo = $row['appl_no'];
						
						$this->db->select("A.category");
						$this->db->from('applicant_master A');
						$this->db->join('applicant_appl_overview B','A.reg_user_id = B.reg_user_id','inner');
						$this->db->where('B.appl_no',$applNo);
						$this->db->where('B.applied_program',$sel_program);
						$result = $this->db->get();
						//echo $this->db->last_query();
						$output_data = $result->result_array();
						$output = array("aaData" => array());
						$category = '';
						foreach ($output_data as $row1) 
			            {
			            	$category = $row1['category'];
			            }
						
						$required_amount = '';
						$this->db->select("amount");
						$this->db->from('program_fee_setup');
						$this->db->where('program_code',$sel_program);
						$this->db->where('category_code',$category);
						$result = $this->db->get();
						//echo $this->db->last_query();
						$output_data = $result->result_array();
						$output = array("aaData" => array());
						foreach ($output_data as $row2) 
			            {
			            	$required_amount = $row2['amount'];
			            }
						
						
						//$query3 = "SELECT COUNT(program_code) AS photo_count FROM  WHERE PROGR"
						$datetime1 = date_create($appl_date);
						$datetime2 = date_create($dt);
						if($datetime1 <= $datetime2)
						{
						
							$photo = "";
							$signature = "";
							if($row['passport_path'] != '')
					        {
					          $arr = explode('/',$row['passport_path']);
					          $pho = end($arr);
					          $pho = DOCUMENT_UPLOAD_URL."/".$sel_program_code."/".$row['appl_no']."/".$photo;
					        }
					  		if($row['signature_path'] != '')
					        {
					          $arr = explode('/',$row['signature_path']);
					          $sign = end($arr);
					          $sign = DOCUMENT_UPLOAD_URL."/".$sel_program_code."/".$row['appl_no']."/".$sign;
					        }
							if(file_exists($pho))
								$photo = $row['passport_path'];
							
							if(file_exists($sign))
								$signature = $row['signature_path'];
							
							$style = '';
							if($row['money_deposit_mode'] == 'ONLINE' && $row['amount'] < "$required_amount")
								$style = "style='background-color:rgb(255,120,120)'";
							else if($row['money_deposit_mode'] == 'CHALLAN' && $row['amount'] < "$required_amount")
								$style = "style='background-color:rgb(255,120,120)'";
							else if($row['money_deposit_mode'] == 'ON THE COUNTER' && $row['amount'] < "$required_amount")
								$style = "style='background-color:rgb(255,120,120)'";
							if($row['money_deposit_mode'] == 'ONLINE' && $row['money_receipt_no'] == '')
								$style = "style='background-color:rgb(255,120,120);'";
							if($row['money_deposit_mode'] == 'CHALLAN' && $row['money_receipt_no'] == '')
								$style = "style='background-color:rgb(255,120,120)'";
							if($phoDoc == 1)
							{
								if($photo == '')
									$style = "style='background-color:rgb(255,120,120)'";
							}
							if($sigDoc == 1)
							{
								if($signature == '')
								$style = "style='background-color:rgb(255,120,120)'";
							}
							
							$html .= '<tr'.$style.'>';
									$s = ($style == '' ? ' checked ' : '');
							$html .= '<td>'.$sl_no.'
									<input type="checkbox" onclick="check()" class="checkbox1" id="chk'.$sl_no.'" name="chkApplicant[]"	value="'.$row['appl_no'].'" '.$s.'/>
									<td>'.$row['full_name'].'</td>
									<td>'.$row['reg_user_id'].'</td>
									<td>'.$row['appl_no'].'</td>
									<td>'.$appl_date.'</td>
									<td>'.$row['money_deposit_mode'].'</td>
									<td>'.$row['amount'].'</td>
									<td>'.$row['depositdate'].'</td>
									<td>'.$row['money_receipt_no'].'</td>
									<td><img src='.$photo.' style="width:100px;height:120px"/></td>
									<td><img src='.$signature.' style="width:100px;height:80px"/></td>
									</tr>';
							$sl_no++;
						}
					}
					
				}
	            $html .= '</tbody>
							</table>';
	            return array('html' => $html);
	           
			break;
			
			case 'get_assign_published_applicants_admit_setup' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$message = '';
        		
        		$sel_program = isset($_POST['program_code']) ? $_POST['program_code'] : '';
				$sel_exam_center = isset($_POST['assigned_exam_center_code']) ? $_POST['assigned_exam_center_code'] : '';
				$sel_exam_vanue = isset($_POST['exam_vanue']) ? $_POST['exam_vanue'] : '';
				$arr_sel_applicants = $_POST['chkApplicant'];
				
				$this->db->select("DATE_FORMAT(admit_card_available_from,'%d-%m-%Y') AS admit_card_available_from , 
				       DATE_FORMAT(admit_card_available_upto,'%d-%m-%Y') AS admit_card_available_upto");
				$this->db->from('admitcard_setup');
				$this->db->where('program_code',$sel_program);
       			$this->db->where('exam_center_code',$sel_exam_center);
       			$this->db->where('exam_vanue_code',$sel_exam_vanue);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$start_date = $row['admit_card_available_from'];
					$end_date = $row['admit_card_available_upto'];
	            }
				
        		$this->db->select("REPLACE (A.sms_url,'amp;','') AS sms_url,A.user_name,A.password,A.sender,B.content,D.program_name");
				$this->db->from('sms_provider_setup A');
				$this->db->join('sms_setup B','A.provider_name = B.provider_name','inner');
				$this->db->join('program_sms_setup C','B.sms_type = C.sms_type','inner');
				$this->db->join('counselling_program_master D','C.program_code = D.program_code','inner');
				$this->db->where('C.record_status','1');
				$this->db->where('B.sms_type','ADMIT CARD GENERATION');
				$this->db->where('B.status','ACTIVE');
				$this->db->where('B.record_status','1');
				$this->db->where('C.program_code',$sel_program);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row1) 
	            {
	                $sms_url = $row1['sms_url'];
					$user_name = $row1['user_name'];
					$password = urlencode($row1['password']);
					$sender = $row1['sender'];
					$content = $row1['content'];
					$program = $row1['program_name'];
					$find = array("[username]", "[password]", "[sender]");
					$replace = array($user_name, $password, $sender);
					$new_sms_url = str_replace($find, $replace, $sms_url);//find and replace uid and pwd in url
					$findappl = array("[program name]","[start date]","[end date]");
					$replaceappl = array($program,$start_date,$end_date);
					$new_content = str_replace($findappl, $replaceappl, $content);
					$messageToSend = urlencode($new_content);
	            }
				
				foreach($arr_sel_applicants as $appl_no)
				{
					$this->db->select("reg_user_id");
					$this->db->from('applicant_appl_overview');
					$this->db->where('appl_no',$appl_no);
					$this->db->where('applied_program',$sel_program);
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					foreach ($output_data as $row) 
		            {
		            	$contact_no  = $row['reg_user_id'];
		            }
					$update_data = array(
						'updated_by'					=>$logged_user,
						'updated_on'					=>$date,
						'record_status'						=>'1'
					);
					$this->db->where('appl_no',$appl_no);
					$this->db->where('applied_program',$sel_program);
					$this->db->where('assigned_exam_center',$sel_exam_center);
					$this->db->where('assigned_exam_vanue',$sel_exam_vanue);
					$sql = $this->db->update('admitcard_published', $update_data);
					
					$message = 'success';
					//find replace url with mobileno and message
					$findmobileNo = array("[mobileno]","[message]");
					$replacemobileNo = array($contact_no,$messageToSend);
					$smsURL = str_replace($findmobileNo,$replacemobileNo,$new_sms_url);
					$result =  file_get_contents($smsURL);	
					/*$ch = curl_init($smsURL );
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$result = curl_exec($ch);
					curl_close($ch);*/
				}
				
				$output = array('status'=>$message);
	           	
	           	return $output; 
				
			break;
			
			
			
			case 'published_applicants_admit_setup' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$sel_program = isset($_POST['program_code']) ? $_POST['program_code'] : '';
				$sel_exam_center = isset($_POST['assigned_exam_center_code']) ? $_POST['assigned_exam_center_code'] : '';
				$sel_exam_vanue = isset($_POST['exam_vanue']) ? $_POST['exam_vanue'] : '';
        		
        		$html = '';
        		$html .= '<table class="table table-bordered" id="tblApplicantDetails">
								<thead>
									<tr>
										<th>
											#
											<input class="Allcheckbox" type="checkbox" id="chkSelectAll" name="chkSelectAll" onclick="allcheck(\'Allcheckbox\',\'checkbox1\')"/>
										</th>
										<th class="text-center">Name</th>
										<th>Appl No</th>
										<th>Applied On</th>
										<th>Fee Paid Mode</th>
										<th>Amount</th>
										<th>Fee Paid On</th>
										<th>Receipt No</th>
										<th>Applied</th>
										<th>Assigned</th>
										<th>OMR</th>
										<th>Photo</th>
										<th>Signature</th>
									</tr>
								</thead>
								<tbody id="applicantBody">';
								
				$this->db->select("document_type_code");
				$this->db->from('program_document_setup');
				$this->db->where('program_code',$sel_program);
       			$where = '(record_status = "Active" OR record_status="1")';
       			$this->db->where($where);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$documentsReq = array();
				foreach ($output_data as $row) 
	            {
	            	$documentsReq[] = $row;
	            }
	            foreach($documentsReq as $row)
				{
					if(in_array('SIG',$row))
					{
						$sigDoc = 1;
						//echo $sigDoc;
					}
					if(in_array('PHO',$row))
					{
						$phoDoc = 1;
						//echo $sigDoc;
					}
				}
        		
	            $allApplicants = array();
	            if($sel_program != '' && $sel_exam_center != '')
				{
					//get set up details for selected program and exam center
					
					$this->db->select("A.full_name, B.appl_no, B.form_no, 
										A.reg_user_id, B.updated_on, D.money_deposit_mode, amount, depositdate,
										money_receipt_no, A.exam_center_code AS applied_exam_center,
										E.assigned_exam_center AS assigned_exam_center, omr_no, E.record_status AS publish_status,
										F.document_path AS passport_path,G.document_path AS signature_path");
					$this->db->from('applicant_master A');
					$this->db->join('applicant_appl_overview B','A.reg_user_id = B.reg_user_id
										AND A.applied_program = B.applied_program','inner');
					$this->db->join('counselling_applicant_form_fee_overview D','B.appl_no = D.appl_no ','inner');
					$this->db->join('admitcard_published E','B.appl_no = E.appl_no AND A.applied_program = E.applied_program','inner');
					$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='PHO') F",'B.appl_no = F.appl_no','inner');
					$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='SIG') G",'B.appl_no = G.appl_no','inner');
					$this->db->where('B.appl_status','Verified');
					$this->db->where('A.applied_program',$sel_program);
					$this->db->where('E.assigned_exam_center',$sel_exam_center);
					$this->db->where('E.assigned_exam_vanue',$sel_exam_vanue);
					$this->db->order_by("B.updated_on", "asc");
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					foreach ($output_data as $row) 
		            {
		                $allApplicants[] = $row;
		            }
		            $sl_no = 1;
		            
		            foreach($allApplicants as $row)
					{
						$photo = "";
						$signature = "";
						$applNo = $row['appl_no'];
						
						$this->db->select("A.category");
						$this->db->from('applicant_master A');
						$this->db->join('applicant_appl_overview B','A.reg_user_id = B.reg_user_id','inner');
						$this->db->where('B.appl_no',$applNo);
						$this->db->where('B.applied_program',$sel_program);
						$result = $this->db->get();
						//echo $this->db->last_query();
						$output_data = $result->result_array();
						$output = array("aaData" => array());
						$category = '';
						foreach ($output_data as $row1) 
			            {
			            	$category = $row1['category'];
			            }
						
						$required_amount = '';
						$this->db->select("amount");
						$this->db->from('program_fee_setup');
						$this->db->where('program_code',$sel_program);
						$this->db->where('category_code',$category);
						$result = $this->db->get();
						//echo $this->db->last_query();
						$output_data = $result->result_array();
						$output = array("aaData" => array());
						foreach ($output_data as $row2) 
			            {
			            	$required_amount = $row2['amount'];
			            }
						
						if($row['passport_path'] != '')
				        {
				          $arr = explode('/',$row['passport_path']);
				          $pho = end($arr);
				          $pho = DOCUMENT_UPLOAD_URL."/".$sel_program."/".$row['appl_no']."/".$photo;
				        }
				  		if($row['signature_path'] != '')
				        {
				          $arr = explode('/',$row['signature_path']);
				          $sign = end($arr);
				          $sign = DOCUMENT_UPLOAD_URL."/".$sel_program."/".$row['appl_no']."/".$sign;
				        }
						if(file_exists($pho))
							$photo = $row['passport_path'];
						
						if(file_exists($sign))
							$signature = $row['signature_path'];
						
						$style = '';
						if($row['money_deposit_mode'] == 'ONLINE' && $row['amount'] < "$required_amount")
							$style = "style='background-color:rgb(255,120,120)'";
						else if($row['money_deposit_mode'] == 'CHALLAN' && $row['amount'] < "$required_amount")
							$style = "style='background-color:rgb(255,120,120)'";
						else if($row['money_deposit_mode'] == 'ON THE COUNTER' && $row['amount'] < "$required_amount")
							$style = "style='background-color:rgb(255,120,120)'";
						if($row['money_deposit_mode'] == 'ONLINE' && $row['money_receipt_no'] == '')
							$style = "style='background-color:rgb(255,120,120);'";
						if($row['money_deposit_mode'] == 'CHALLAN' && $row['money_receipt_no'] == '')
							$style = "style='background-color:rgb(255,120,120)'";
						if($phoDoc == 1)
						{
							if($photo == '')
								$style = "style='background-color:rgb(255,120,120)'";
						}
						if($sigDoc == 1)
						{
							if($signature == '')
							$style = "style='background-color:rgb(255,120,120)'";
						}
						
						$html .= '<tr'.$style.'>';
						if($row['publish_status'] == 1)
						{
							$html .= "<td>$sl_no<img src=\"../../public/assets/images/correct.png\"/></td>";
						}
						else
						{
							$s = ($style == '' ? ' checked ' : '');
							$html .= "<td>$sl_no<input type=\"checkbox\" onclick='check()' id=\"chk$sl_no\" name=\"chkApplicant[]\" value=\"".$row['appl_no']."\" class='checkbox1' $s/></td>";
						}
								$s = ($style == '' ? ' checked ' : '');
						$html .='<td>'.$row['full_name'].'</td>
								<td>'.$row['appl_no'].'</td>
								<td>'.$row['updated_on'].'</td>
								<td>'.$row['money_deposit_mode'].'</td>
								<td>'.$row['amount'].'</td>
								<td>'.$row['depositdate'].'</td>
								<td>'.$row['money_receipt_no'].'</td>
								<td>'.$row['applied_exam_center'].'</td>
								<td>'.$row['assigned_exam_center'].'</td>
								<td>'.$row['omr_no'].'</td>
								<td><img src='.$photo.' style="width:100px;height:120px"/></td>
								<td><img src='.$signature.' style="width:100px;height:80px"/></td>
								</tr>';
						$sl_no++;
					}
					
				}
	            $html .= '</tbody>
							</table>';
	            return array('html' => $html);
	           
			break;
			
			case 'published_applicants_exam_centre_name_admit_setup': 
            	
            	$sel_program = isset($_POST['program_code']) ? $_POST['program_code'] : '';
				$sel_exam_center = isset($_POST['assigned_exam_center_code']) ? $_POST['assigned_exam_center_code'] : '';
			 	
				$this->db->select("exam_centre_code, exam_centre_name");
				$this->db->from('exam_centre_master');
				$this->db->where('program_code',$sel_program);
				$this->db->where('exam_centre_code',$sel_exam_center);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$sel_exam_center_code = $row['exam_centre_code'];
					$sel_exam_center_name = $row['exam_centre_name'];
	            }
				$output = array('exam_center_code'=>$sel_exam_center_code,'exam_center_name'=>$sel_exam_center_name);
			
				return $output; 
			break;
			
			case 'published_applicants_exam_venue_name_admit_setup': 
            	
            	$sel_program = isset($_POST['program_code']) ? $_POST['program_code'] : '';
				$sel_exam_center = isset($_POST['assigned_exam_center_code']) ? $_POST['assigned_exam_center_code'] : '';
				$sel_exam_vanue = isset($_POST['exam_vanue']) ? $_POST['exam_vanue'] : '';
			 	
				$this->db->select("exam_vanue");
				$this->db->from('admitcard_setup');
				$this->db->where('program_code',$sel_program);
				$this->db->where('exam_center_code',$sel_exam_center);
				$this->db->where('exam_vanue_code',$sel_exam_vanue);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$sel_exam_center_name = $row['exam_vanue'];
	            }
				$output = array('exam_venue_name'=>$sel_exam_center_name);
			
				return $output; 
			break;
			
			case 'published_applicants_report_admit_setup' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$sel_program = isset($_POST['program_code']) ? $_POST['program_code'] : '';
				$sel_exam_center = isset($_POST['assigned_exam_center_code']) ? $_POST['assigned_exam_center_code'] : '';
				$sel_exam_vanue = isset($_POST['exam_vanue']) ? $_POST['exam_vanue'] : '';
        		
        		$html = '';
        		$html .= '<table class="table table-bordered" id="tblApplicantDetails">
								<thead>
									<tr>
										<th>
											Sl No
										</th>
										<th>Name</th>
										<th>Appl No</th>
										<th>Applied On</th>
										<th>Fee Paid Mode</th>
										<th>Amount</th>
										<th>Fee Paid On</th>
										<th>Receipt No</th>
										<th>Applied</th>
										<th>Assigned</th>
										<th>OMR</th>
									</tr>
								</thead>
								<tbody id="applicantBody">';
								
				$this->db->select("document_type_code");
				$this->db->from('program_document_setup');
				$this->db->where('program_code',$sel_program);
       			$where = '(record_status = "Active" OR record_status="1")';
       			$this->db->where($where);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$documentsReq = array();
				foreach ($output_data as $row) 
	            {
	            	$documentsReq[] = $row;
	            }
	            foreach($documentsReq as $row)
				{
					if(in_array('SIG',$row))
					{
						$sigDoc = 1;
						//echo $sigDoc;
					}
					if(in_array('PHO',$row))
					{
						$phoDoc = 1;
						//echo $sigDoc;
					}
				}
        		
	            $allApplicants = array();
	            if($sel_program != '' && $sel_exam_center != '')
				{
					//get set up details for selected program and exam center
					
					$this->db->select("A.full_name, B.appl_no, B.form_no, 
										A.reg_user_id, B.updated_on, D.money_deposit_mode, amount, depositdate,
										F.document_path AS passport_path,G.document_path AS signature_path,
										money_receipt_no, A.exam_center_code AS applied_exam_center,
										E.assigned_exam_center AS assigned_exam_center, omr_no, E.record_status AS publish_status");
					$this->db->from('applicant_master A');
					$this->db->join('applicant_appl_overview B','A.reg_user_id = B.reg_user_id
										AND A.applied_program = B.applied_program','inner');
					$this->db->join('counselling_applicant_form_fee_overview D','B.appl_no = D.appl_no ','inner');
					$this->db->join('admitcard_published E','B.appl_no = E.appl_no AND A.applied_program = E.applied_program','inner');
					$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='PHO') F",'B.appl_no = F.appl_no','inner');
					$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='SIG') G",'B.appl_no = G.appl_no','inner');
					$this->db->where('A.status','1');
					$this->db->where('B.appl_status','Verified');
					$this->db->where('A.applied_program',$sel_program);
					$this->db->where('E.assigned_exam_center',$sel_exam_center);
					$this->db->where('E.assigned_exam_vanue',$sel_exam_vanue);
					$this->db->order_by("omr_no", "asc");
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output_data = $result->result_array();
					$output = array("aaData" => array());
					foreach ($output_data as $row) 
		            {
		                $allApplicants[] = $row;
		            }
		            $sl_no = 1;
		            
		            foreach($allApplicants as $row)
					{
						$photo = "";
						$signature = "";
						$applNo = $row['appl_no'];
						
						$this->db->select("A.category");
						$this->db->from('applicant_master A');
						$this->db->join('applicant_appl_overview B','A.reg_user_id = B.reg_user_id','inner');
						$this->db->where('B.appl_no',$applNo);
						$this->db->where('B.applied_program',$sel_program);
						$result = $this->db->get();
						//echo $this->db->last_query();
						$output_data = $result->result_array();
						$output = array("aaData" => array());
						$category = '';
						foreach ($output_data as $row1) 
			            {
			            	$category = $row1['category'];
			            }
						
						$required_amount = '';
						$this->db->select("amount");
						$this->db->from('program_fee_setup');
						$this->db->where('program_code',$sel_program);
						$this->db->where('category_code',$category);
						$result = $this->db->get();
						//echo $this->db->last_query();
						$output_data = $result->result_array();
						$output = array("aaData" => array());
						foreach ($output_data as $row2) 
			            {
			            	$required_amount = $row2['amount'];
			            }
						
						if($row['passport_path'] != '')
				        {
				          $arr = explode('/',$row['passport_path']);
				          $pho = end($arr);
				          $pho = DOCUMENT_UPLOAD_URL."/".$sel_program."/".$row['appl_no']."/".$photo;
				        }
				  		if($row['signature_path'] != '')
				        {
				          $arr = explode('/',$row['signature_path']);
				          $sign = end($arr);
				          $sign = DOCUMENT_UPLOAD_URL."/".$sel_program."/".$row['appl_no']."/".$sign;
				        }
						if(file_exists($pho))
							$photo = $row['passport_path'];
						
						if(file_exists($sign))
							$signature = $row['signature_path'];
						
						$style = '';
						if($row['money_deposit_mode'] == 'ONLINE' && $row['amount'] < "$required_amount")
							$style = "style='background-color:rgb(255,120,120)'";
						else if($row['money_deposit_mode'] == 'CHALLAN' && $row['amount'] < "$required_amount")
							$style = "style='background-color:rgb(255,120,120)'";
						else if($row['money_deposit_mode'] == 'ON THE COUNTER' && $row['amount'] < "$required_amount")
							$style = "style='background-color:rgb(255,120,120)'";
						if($row['money_deposit_mode'] == 'ONLINE' && $row['money_receipt_no'] == '')
							$style = "style='background-color:rgb(255,120,120)'";
						if($row['money_deposit_mode'] == 'CHALLAN' && $row['money_receipt_no'] == '')
							$style = "style='background-color:rgb(255,120,120)'";
						if($phoDoc == 1)
						{
							if($photo == '')
								$style = "style='background-color:rgb(255,120,120)'";
						}
						if($sigDoc == 1)
						{
							if($signature == '')
							$style = "style='background-color:rgb(255,120,120)'";
						}
						
						$html .= '<tr'.$style.'>';
						$html .='<td>'.$sl_no.'</td>
								<td>'.$row['full_name'].'</td>
								<td>'.$row['appl_no'].'</td>
								<td>'.$row['updated_on'].'</td>
								<td>'.$row['money_deposit_mode'].'</td>
								<td>'.$row['amount'].'</td>
								<td>'.$row['depositdate'].'</td>
								<td>'.$row['money_receipt_no'].'</td>
								<td>'.$row['applied_exam_center'].'</td>
								<td>'.$row['assigned_exam_center'].'</td>
								<td>'.$row['omr_no'].'</td>
								</tr>';
						$sl_no++;
					}
					
				}
	            $html .= '</tbody>
							</table>';
	            return array('html' => $html);
	           
			break;
			
			case 'centre_address_admit_setup' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
				$program_code = $_POST['program_code'];
				$exam_centre_code = $_POST['exam_centre_code'];
				
				if($exam_centre_code == '')
				{
					$this->db->select("A.program_code,A.exam_center_code,A.exam_vanue,A.capacity,
										A.exam_center_address,A.exam_schedule,
										DATE_FORMAT(A.admit_card_available_from,'%d-%m-%Y') AS admit_card_available_from,
										DATE_FORMAT(A.admit_card_available_upto,'%d-%m-%Y') AS admit_card_available_upto,
										A.exam_instructions,A.controller_signature,
										CASE WHEN A.record_status = '1' THEN 'ACTIVE' ELSE 'INACTIVE' END AS record_status,
										C.exam_centre_name");
					$this->db->from('admitcard_setup A');
					$this->db->join('exam_centre_master C','A.exam_center_code = C.exam_centre_code AND A.program_code = C.program_code','left');
					$this->db->where('A.program_code',$program_code);
				}
				else
				{
					$this->db->select("A.program_code,A.exam_center_code,A.exam_vanue,A.capacity,A.exam_center_address,A.exam_schedule,DATE_FORMAT(A.admit_card_available_from,'%d-%m-%Y') AS admit_card_available_from,DATE_FORMAT(A.admit_card_available_upto,'%d-%m-%Y') AS admit_card_available_upto,A.exam_instructions,A.controller_signature,CASE WHEN A.record_status = '1' THEN 'ACTIVE' ELSE 'INACTIVE' END AS record_status ,C.exam_centre_name");
					$this->db->from('admitcard_setup A');
					$this->db->join('exam_centre_master C','A.exam_center_code = C.exam_centre_code AND A.program_code = C.program_code','left');
					$this->db->where('A.program_code',$program_code);
					$this->db->where('A.exam_center_code',$exam_centre_code);
				}
				
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'apply_date_admit_setup' :
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
				$program_code = $_POST['program_code'];
				
				$this->db->select("date(apply_end_date) as apply_end_date ");
				$this->db->from('counselling_program_master');
				$this->db->where('program_code',$program_code);
				
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'chkDuplicate_admit_setup' :
				$dbstatus = '';
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$output = array("aaData" => array());
        		if($_POST['validatevanuecode'])
				{
					$program_code = $_POST['program_code'];
					$exam_center = $_POST['exam_centre'];
					$txtExamVanueCode = $_POST['txtExamVanueCode'];
					
					$this->db->select("count(exam_vanue_code) AS exam_vanue_code");
					$this->db->from('admitcard_setup');
					$this->db->where('program_code',$program_code);
					$this->db->where('exam_center_code',$exam_center);
					$this->db->where('exam_vanue_code',$txtExamVanueCode);
					$this->db->where('record_status','1');
					
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach ($output_data as $aRow) 
	            	{
	            		$output['aaData'][] = $aRow['exam_vanue_code'];
	            		$dbstatus = $aRow['exam_vanue_code'];
	            	}
				}
				$output = array("status"=>$dbstatus);
				return $output;
			break;
			
			case 'add_centre': 
			 
				$dbStatus = "SUCCESS";
				$dbMessage = "Inserted Successfully";
            	
			 	$hidProgramCode = $_POST['hidProgramCode'];
				$hidExamCentreCode = $_POST['cmbExamCentreAdd'];
				$cmbStatus = $_POST['cmbStatus'];
				$txtCapacity = $_POST['txtCapacity'];
				$txtExamVanue = $_POST['txtExamVanue'];
				$txtExamVanueCode = $_POST['txtExamVanueCode'];
				$txtCentreAddress = $_POST['txtCentreAddress'];
				$txtAvailableFrom = $_POST['txtAvailableFrom'];
				$txtAvailableUpto = $_POST['txtAvailableUpto'];
				$txtExamInstructions = trim($_POST['txtExamInstructions']);
				$taExamSchedule = trim($_POST['taExamSchedule']);
				
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
			 	$op_type = 'add_centre';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				if(isset($_FILES['fileControllerSignature']['tmp_name']) && !empty($_FILES['fileControllerSignature']['tmp_name']))
				{
					$imageFileType = end((explode(".", $_FILES['fileControllerSignature']['name'])));
					$check = getimagesize($_FILES["fileControllerSignature"]["tmp_name"]);
					if($check !== false) {

					} 
					else 
					{
						return array('status'=>false, 'msg'=>"Not an Image");
					}
					// Check file size
					if($_FILES["fileControllerSignature"]["size"] > 1536000) {
						return array('status'=>false, 'msg'=>"Size of the image should be within 1MB");
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
						return array('status'=>false, 'msg'=>"Supported file types are jpg/png/jpeg/gif");
					}
					if(isset($_FILES['fileControllerSignature']['tmp_name']) && !empty($_FILES['fileControllerSignature']['tmp_name'])){
					//$image_name = base64_encode(file_get_contents($_FILES['fileControllerSignature']['tmp_name']));
					//$pic_name = $this->session->userdata('user_id')."1".time().".png";//$_FILES['fileControllerSignature']['name'];
					$pic_name = $this->input->post('institutecode').md5(uniqid($user)).".".$imageFileType;//$_FILES['fileControllerSignature']['name'];
					$uploads_dir = APPPATH."../public/assets/images/logo/".$pic_name;
					//echo $uploads_dir. base_url('public');
					move_uploaded_file($_FILES['fileControllerSignature']['tmp_name'], $uploads_dir);
					//echo "PHoto upload status".$result.dirname(__FILE__) ;
					//echo FCPATH."#".APPPATH."##".BASEPATH;
					//die();
					}
					$this->db->select("count(program_code) AS program_code");
					$this->db->from('admitcard_setup');
					$this->db->where('program_code',$hidProgramCode);
					$this->db->where('exam_center_code',$hidExamCentreCode );
					$this->db->where('exam_vanue_code',$txtExamVanueCode );
							
					$result = $this->db->get();
					$output_data = $result->result_array();
					
					foreach ($output_data as $aRow1) 
            		{
            			$result = $aRow1['program_code'];
						if($result >= 1)
						{
							$update_data = array(
								'capacity' 						=>$txtCapacity,
								'exam_center_address' 			=>$txtCentreAddress,
								'exam_instructions'				=>$txtExamInstructions,
								'exam_schedule' 				=>$taExamSchedule,
								'controller_signature'			=>$pic_name,
								'updated_by'					=>$user,
								'updated_on'					=>$date,
								'exam_vanue_code' 				=>$txtExamVanueCode,
								'exam_vanue' 					=>$txtExamVanue,
								'admit_card_available_from' 	=>date('Y-m-d', strtotime($txtAvailableFrom)),
								'admit_card_available_upto' 	=>date('Y-m-d', strtotime($txtAvailableUpto))
							);
							$this->db->where('program_code',$hidProgramCode );
							$this->db->where('exam_center_code',$hidExamCentreCode );
							$this->db->where('exam_vanue_code',$txtExamVanueCode );
							$sql = $this->db->update('admitcard_setup', $update_data);
							//echo $this->db->last_query();
							if(!$sql){
								$dbStatus = "FALSE";
								$dbMessage = "Error Inserting";
								//$dbError = ;	
							}
						}
						else
						{
							$new_data = array(
								'program_code' 					=>$hidProgramCode,
								'exam_center_code' 				=>$hidExamCentreCode,
								'exam_vanue_code' 				=>$txtExamVanueCode,
								'exam_vanue' 					=>$txtExamVanue,
								'capacity' 						=>$txtCapacity,
								'exam_center_address' 			=>$txtCentreAddress,
								'exam_schedule' 				=>$taExamSchedule,
								'admit_card_available_from' 	=>date('Y-m-d', strtotime($txtAvailableFrom)),
								'admit_card_available_upto' 	=>date('Y-m-d', strtotime($txtAvailableUpto)),
								'exam_instructions' 			=>$txtExamInstructions,
								'controller_signature' 			=>$pic_name,
								'created_by'					=>$user,
								'created_on'					=>$date
							);
							
							
							$sql = $this->db->insert('admitcard_setup', $new_data);
							//echo $this->db->last_query();
							if(!$sql){
								$dbStatus = "FALSE";
								$dbMessage = "Error Inserting";
								//$dbError = ;	
							}
						}
	                }
	            }
	            else
				{
					$this->db->select("count(program_code) AS program_code");
					$this->db->from('admitcard_setup');
					$this->db->where('program_code',$hidProgramCode);
					
					$result = $this->db->get();
					$output_data = $result->result_array();
					
					foreach ($output_data as $aRow1) 
            		{
            			$result = $aRow1['program_code'];
						if($result >= 1)
						{
							$update_data = array(
								'capacity' 						=>$txtCapacity,
								'exam_center_address' 			=>$txtCentreAddress,
								'exam_instructions'				=>$txtExamInstructions,
								'updated_by'					=>$user,
								'updated_on'					=>$date
							);
							$this->db->where('program_code',$hidProgramCode );
							$this->db->where('exam_center_code',$hidExamCentreCode );
							$this->db->where('exam_vanue_code',$txtExamVanueCode );
							$sql = $this->db->update('admitcard_setup', $update_data);
							//echo $this->db->last_query();
							if(!$sql){
								$dbStatus = "FALSE";
								$dbMessage = "Error Inserting";
								//$dbError = ;	
							}
						}
						else
						{
							$new_data = array(
								'program_code' 					=>$hidProgramCode,
								'exam_center_code' 				=>$hidExamCentreCode,
								'exam_vanue_code' 				=>$txtExamVanueCode,
								'exam_vanue' 					=>$txtExamVanue,
								'capacity' 						=>$txtCapacity,
								'exam_center_address' 			=>$txtCentreAddress,
								'exam_schedule' 				=>$taExamSchedule,
								'admit_card_available_from' 	=>date('Y-m-d', strtotime($txtAvailableFrom)),
								'admit_card_available_upto' 	=>date('Y-m-d', strtotime($txtAvailableUpto)),
								'exam_instructions' 			=>$txtExamInstructions,
								'created_by'					=>$user,
								'created_on'					=>$date
							);
							
							
							$sql = $this->db->insert('admitcard_setup', $new_data);
							//echo $this->db->last_query();
							if(!$sql){
								$dbStatus = "FALSE";
								$dbMessage = "Error Inserting";
								//$dbError = ;	
							}
						}
	                }
				}
				
				
				if($dbStatus == "SUCCESS")
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				else
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				return $output;	
			break;
			
			case 'edit_centre': 
			 
				$dbStatus = "SUCCESS";
				$dbMessage = "Updated Successfully";
            	
			 	$hidUniqueidEdit = $_POST['hidUniqueidEdit'];
				$hidProgramCodeEdit = $_POST['hidProgramCodeEdit'];
				$hidExamCentreCodeEdit = $_POST['hidExamCentreCodeEdit'];
				//$challan_code = $cmbProgramCode.$txtBankCode;
				//$txtExamCentreName = $_GET['txtExamCentreName'];
				$cmbStatusEdit = $_POST['cmbStatusEdit'];
				$txtCapacityEdit = $_POST['txtCapacityEdit'];
				$txtExamVanueEdit = $_POST['txtExamVanueEdit'];
				$txtCentreAddressEdit = $_POST['txtCentreAddressEdit'];
				$txtAvailableFromEdit = $_POST['txtAvailableFromEdit'];
				$txtAvailableUptoEdit = $_POST['txtAvailableUptoEdit'];
				$txtExamInstructionsEdit = trim($_POST['txtExamInstructionsEdit']);
				$taExamScheduleEdit = trim($_POST['taExamScheduleEdit']);
				
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
			 	$op_type = 'edit_centre';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				if(isset($_FILES['fileControllerSignatureEdit']['tmp_name']) && !empty($_FILES['fileControllerSignatureEdit']['tmp_name']))
				{
					$imageFileType = end((explode(".", $_FILES['fileControllerSignatureEdit']['name'])));
					$check = getimagesize($_FILES["fileControllerSignatureEdit"]["tmp_name"]);
					if($check !== false) {

					} 
					else 
					{
						return array('status'=>false, 'msg'=>"Not an Image");
					}
					// Check file size
					if($_FILES["fileControllerSignatureEdit"]["size"] > 1536000) {
						return array('status'=>false, 'msg'=>"Size of the image should be within 1MB");
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
						return array('status'=>false, 'msg'=>"Supported file types are jpg/png/jpeg/gif");
					}
					if(isset($_FILES['fileControllerSignatureEdit']['tmp_name']) && !empty($_FILES['fileControllerSignatureEdit']['tmp_name'])){
					//$image_name = base64_encode(file_get_contents($_FILES['fileControllerSignature']['tmp_name']));
					//$pic_name = $this->session->userdata('user_id')."1".time().".png";//$_FILES['fileControllerSignature']['name'];
					$pic_name = $this->input->post('institutecode').md5(uniqid($user)).".".$imageFileType;//$_FILES['fileControllerSignature']['name'];
					$uploads_dir = APPPATH."../public/assets/images/logo/".$pic_name;
					//echo $uploads_dir. base_url('public');
					move_uploaded_file($_FILES['fileControllerSignatureEdit']['tmp_name'], $uploads_dir);
					//echo "PHoto upload status".$result.dirname(__FILE__) ;
					//echo FCPATH."#".APPPATH."##".BASEPATH;
					//die();
					}
				
				
					$update_data = array(
						'exam_vanue' 					=>$txtExamVanueEdit,
						'capacity' 						=>$txtCapacityEdit,
						'exam_center_address' 			=>$txtCentreAddressEdit,
						'exam_schedule'					=>$taExamScheduleEdit,
						'admit_card_available_from' 	=>date('Y-m-d', strtotime($txtAvailableFromEdit)),
						'admit_card_available_upto' 	=>date('Y-m-d', strtotime($txtAvailableUptoEdit)),
						'controller_signature'			=>$pic_name,
						'exam_instructions'				=>$txtExamInstructionsEdit,
						'updated_by'					=>$user,
						'updated_on'					=>$date,
						'record_status'					=>$cmbStatusEdit
						
					);
					$this->db->where('exam_vanue',$hidUniqueidEdit);
					$this->db->where('program_code',$hidProgramCodeEdit);
					$this->db->where('exam_center_code',$hidExamCentreCodeEdit);
					$sql = $this->db->update('admitcard_setup', $update_data);
					//echo $this->db->last_query();
					if(!$sql){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
						//$dbError = ;	
					}
				}
				else
				{
					$update_data = array(
						'exam_vanue' 					=>$txtExamVanueEdit,
						'capacity' 						=>$txtCapacityEdit,
						'exam_center_address' 			=>$txtCentreAddressEdit,
						'exam_schedule'					=>$taExamScheduleEdit,
						'admit_card_available_from' 	=>date('Y-m-d', strtotime($txtAvailableFromEdit)),
						'admit_card_available_upto' 	=>date('Y-m-d', strtotime($txtAvailableUptoEdit)),
						'exam_instructions'				=>$txtExamInstructionsEdit,
						'updated_by'					=>$user,
						'updated_on'					=>$date,
						'record_status'					=>$cmbStatusEdit
						
					);
					$this->db->where('exam_vanue',$hidUniqueidEdit);
					$this->db->where('program_code',$hidProgramCodeEdit);
					$this->db->where('exam_center_code',$hidExamCentreCodeEdit);
					$sql = $this->db->update('admitcard_setup', $update_data);
					//echo $this->db->last_query();
					if(!$sql){
						$dbStatus = "ERROR";
						$dbMessage = "Error Inserting";
						//$dbError = ;	
					}
				}
				if($dbStatus == "SUCCESS")
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				else
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				return $output;	
			break;
			
			case 'get_document_multiple':
				//$institute = $_POST['institute'];
				$this->db->select("document_type_code,document_type,document_type_code as document");
				$this->db->from('document_type_master');
				$this->db->where('record_status','1');
				$this->db->order_by('id');
				$result = $this->db->get();
				//echo $this->db->last_query();
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
			
			case 'get_document_one':
				//$institute = $_POST['institute'];
				$program = $_POST['program'];
				$this->db->select("A.document_type_code,A.document_type,CASE WHEN B.sl_no IS NULL THEN '0' ELSE B.sl_no END AS sl_no,CASE WHEN B.record_status IS NULL THEN '0' WHEN B.record_status = '1'THEN 1 ELSE 0 END AS record_status");
				$this->db->from('document_type_master A');
				$this->db->join('program_document_setup B','A.document_type_code = B.document_type_code','left');
				$this->db->where('B.program_code',$program);
				$this->db->order_by('A.id');
				$result = $this->db->get();
				$this->db->save_queries = TRUE;
				//echo $this->db->last_query();
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
			
			case 'assign_multiple_document' :
				$dbStatus = "SUCCESS";
				$dbMessage = "Assigned Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d H:i:s', now());
        		
        		$arr_program_code = array();
				$arr_menu_code = array();
				$arr_sl_no = array();
				$arr_show_status = array();
				$program_codes = $_POST['program_codes'];
				$menu_codes = $_POST['document_codes']?$_POST['document_codes']:'';
				$sl_nos = $_POST['sl_nos']?$_POST['sl_nos']:'';
				$show_status = $_POST['show_status']?$_POST['show_status']:'';
				$arr_program_code = call_user_func_array('array_merge', $program_codes);
				
				
				for($i=0;$i<sizeof($arr_program_code);$i++)
				{
					for($j=0;$j<sizeof($menu_codes);$j++)
					{
						$count = 0;
						if($arr_program_code[$i] != "multiselect-all")
						{
							$this->db->select("count(program_code) AS program_code");
							$this->db->from('program_document_setup');
							$this->db->where('program_code',$arr_program_code[$i]);
							$this->db->where('document_type_code',$menu_codes[$j]);
							
							$result = $this->db->get();
							//echo $this->db->last_query();
							$output_data = $result->result_array();
							foreach ($output_data as $aRow) 
		            		{
		            			$result = $aRow['program_code'];
								if($result >= 1){
									$update_data = array(
										'sl_no'							=>$sl_nos[$j],
										'record_status' 				=>$show_status[$j],
										'updated_by'					=>$user,
										'updated_on'					=>$date,
										'institute_code'				=>$institute_code
									);
									$this->db->where('program_code',$arr_program_code[$i] );
									$this->db->where('document_type_code',$menu_codes[$j]);
									$sql = $this->db->update('program_document_setup', $update_data);
									//echo $this->db->last_query();
									if(!$sql){
										$dbStatus = "ERROR";
										$dbMessage = "Error Inserting";
										//$dbError = ;	
									}
									
								}
								else{
									$new_data = array(
										'program_code' 					=>$arr_program_code[$i],
										'document_type_code' 			=>$menu_codes[$j],
										'sl_no' 						=>$sl_nos[$j],
										'record_status' 				=>$show_status[$j],
										'created_by'					=>$user,
										'created_on'					=>$date,
										'institute_code'				=>$institute_code
									);
									$sql = $this->db->insert('program_document_setup', $new_data);
									//echo $this->db->last_query();
									if(!$sql){
										$dbStatus = "ERROR";
										$dbMessage = "Error Inserting";
										//$dbError = ;	
									}
								}
							}
						}
					}
				}
				if($dbStatus == "SUCCESS")
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				else
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				return $output;
			break;
			
			case 'assign_single_document' :
				$dbStatus = "SUCCESS";
				$dbMessage = "Updated Successfully";
				$dbError = "";
				
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d H:i:s', now());
        		
        		$arr_document_code = array();
				$program_code = $_POST['program_code'];
				$sl_nos = $_POST['sl_nos']?$_POST['sl_nos']:'';
				$show_status = $_POST['show_status']?$_POST['show_status']:'';
				
				$this->db->select("document_type_code");
				$this->db->from('document_type_master');
				$this->db->order_by('id');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$i = 0;
				$output_data = $result->result_array();
				foreach ($output_data as $row) 
	            {
	            	$document_type_code = $row['document_type_code'];
	            	$this->db->select("count(program_code) AS program_code");
					$this->db->from('program_document_setup');
					$this->db->where('program_code',$program_code);
					$this->db->where('document_type_code',$document_type_code);
					
					$result = $this->db->get();
					$output_data = $result->result_array();
					
					foreach ($output_data as $aRow1) 
            		{
            			$result = $aRow1['program_code'];
						if($result >= 1)
						{
							$update_data = array(
								'sl_no' 						=>$sl_nos[$i],
								'record_status' 				=>$show_status[$i],
								'institute_code' 				=>$institute_code,
								'updated_by'					=>$user,
								'updated_on'					=>$date
							);
							$this->db->where('program_code',$program_code );
							$this->db->where('document_type_code',$document_type_code );
							$sql = $this->db->update('program_document_setup', $update_data);
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
								'program_code' 					=>$program_code,
								'document_type_code' 			=>$document_type_code,
								'sl_no' 						=>$sl_nos[$i],
								'record_status' 				=>$show_status[$i],
								'institute_code' 				=>$institute_code,
								'created_by'					=>$user,
								'created_on'					=>$date
							);
							
							
							$sql = $this->db->insert('program_document_setup', $new_data);
							//echo $this->db->last_query();
							if(!$sql){
								$dbStatus = "ERROR";
								$dbMessage = "Error Inserting";
								//$dbError = ;	
							}
						}
	                }
	                $i++;
	            }
	            if($dbStatus == "SUCCESS")
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				else
				{
					$output = array("status"=>$dbStatus,"msg"=>$dbMessage);
				}
				return $output;
			break;
			
            default :
            	return array('status' => FALSE, 'msg' =>'Unable to load.Contact Support');
        }
    }
    public function split_string($string,$needle,$nth){
		$max = strlen($string);
		$n = 0;
		for($i=0;$i<$max;$i++){
		    if($string[$i]==$needle){
		        $n++;
		        if($n>=$nth){
		            break;
		        }
		    }
		}
		$arr[] = substr($string,0,$i);
		$arr[] = substr($string,$i+1,$max);

		return $arr;
	}	
	
}
