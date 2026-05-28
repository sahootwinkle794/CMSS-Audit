<?php	
class pdf_generete_model extends CI_model 
{
	
	/*$reg_user_id_array = array('9476692002','9425358017');
	$applicantNumber_array =array('DRP_CIPET2018000017','DRP_CIPET2018000018');*/
	
	public function template008_pdf($data, $op, $stage = null) {
        /**
		* logic: To print PDF Data
		* case:lov.appl_no,pm.program_name,pm.elective_subjects,aplov.applied_program,aplov.index_no,pm.compulsory_subjects,pm.year
		* author:Sailendranath Mansingh
		* date :03-11-2017
		*/
	/*	$reg_user_id = $this->session->userdata('reg_user_id');*/
	
		
		$seladmcode = $data[0];
		$reg_user_id =  $data[1];
        $applicantNumber = $data[2];
        
        //echo $data[0][]; die();
		
        switch ($op) {
			case 'get_application_detail':	
				$this->db->select('aplov.appl_no,pm.program_name,pm.elective_subjects,aplov.applied_program,aplov.index_no,pm.year');
				$this->db->from('applicant_appl_overview aplov');
				$this->db->join('program_master pm','pm.program_code=aplov.applied_program','left');
				$this->db->where('aplov.reg_user_id',$reg_user_id);
				$this->db->where('aplov.applied_program',$seladmcode);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break; 
			
			case 'get_applicant_detail':
				
				$this->db->select('appl_no');
				$this->db->from('applicant_appl_overview aao');
				$this->db->where('applied_program',$seladmcode);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				$Result = $result->result_array();
				//echo $this->db->last_query();
				//die();
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

				

				$this->db->select('appmas.master_name,appmas.first_name,appmas.mid_name,appmas.last_name,appmas.full_name,ex.centre_name,appmas.applicant_email,appmas.applicant_landline,appmas.applicant_mobile,appmas.marital_status,
					userimg.passportphoto,signature.SIGN,gm.gender,nm.nationality AS natinality,appmas.nationality AS nationalitycode,appr.dob,appmas.dob_in_word,catm.category_name,
					appmas.is_physically_challanged,appmas.is_minority_community,mcm.minority_community,appmas.hostel_facility,
					appmas.single_girl_child_flag,appmas.if_chronic_illness,appmas.chronic_illness,appmas.if_allergies,appmas.allergies,appmas.last_year_mark,
					appmas.last_school,appmas.other_university,bm.board_name,appmas.last_board,appmas.applicant_email,appmas.univ_regn_no,appmas.is_reserved_quota,
					appr.email_id,appmas.subject_offered1,appmas.subject_offered2,appmas.subject_offered3,appmas.subject_offered4,
					appmas.highest_qualification,hqm.qualification_name,subjects_offered,appmas.last_school,appmas.last_grade,appmas.adhar_no,appmas.physically_challenged,appmas.applied_program,appmas.exam_center_code,appmas.exam_center_code1,appmas.exam_center_code2,ex.centre_name as exam_centre_name,ex1.centre_name as exam_centre_name1,ex2.centre_name as exam_centre_name2,appmas.is_north_east,appmas.north_east_state,appmas.category,appmas.guardian_name,appmas.father_occupation,appmas.annual_parent_income,appmas.is_employed,appmas.employer_add,appmas.employer_from,appmas.employer_to,appmas.completion_date,appmas.center_name1,appmas.center_name2,appmas.center_name3,appmas.master_name,appmas.mothers_name,appmas.mothers_profession,appmas.mothers_income,appmas.fathers_adhar_no,appmas.mothers_adhar_no,
					appmas.total_mark,appmas.secured_mark,appmas.distinction,appmas.course_type,appmas.is_kashmiri_migrant,
					appmas.honours_total_mark,appmas.honours_secured_mark,appmas.other_subject,
					appmas.honours_division,appmas.honours_subject,hons.subject_name,appmas.are_parents_alive,"" AS GSIGN,"" AS blood_group_name,"" AS mother_tongue,"" AS mode_of_transport, "" AS is_alumnus, "" AS alumnus_name, ""  AS alumnus_year_of_passing, "" AS is_staff,
					"" AS staff_name, "" AS is_general, "" AS caste_name ');
				$this->db->from('applicant_master appmas');
				$this->db->join("applicant_appl_overview apovr",'appmas.reg_user_id=apovr.reg_user_id','left');
				$this->db->join("applicant_reg_master appr",'appmas.reg_user_id=appr.reg_user_id AND appmas.applied_program = appr.applied_program','left');
				$this->db->join("common_centre_master ex",'ex.centre_code=appmas.exam_center_code','left');
				$this->db->join("common_centre_master ex1",'ex1.centre_code=appmas.exam_center_code1','left');
				$this->db->join("common_centre_master ex2",'ex2.centre_code=appmas.exam_center_code2','left');
				$this->db->join("($subQuery1) userimg",'userimg.appl_no=apovr.appl_no','left');
				$this->db->join("($subQuery2) signature",'userimg.appl_no=apovr.appl_no','left');
				$this->db->join("gender_master gm",'gm.gender_code=appmas.gender','left');
				$this->db->join("nationality_master nm",'nm.nationality_code=appmas.nationality','left');
				$this->db->join("category_master catm",'catm.category_code=appmas.category','left');
				$this->db->join("highest_qualification_master hqm",'appmas.highest_qualification = hqm.qualification_code','left');
				$this->db->join("minority_community_master mcm",'mcm.minority_community_code =appmas.minority_community_details','left');
				$this->db->join("board_master bm",'bm.board_code=appmas.last_board','left');
				$this->db->join("honours_subject_master hons",'appmas.honours_subject=hons.subject_code','left');
				$this->db->where('apovr.applied_program',$seladmcode);
				$this->db->where('appmas.applied_program',$seladmcode);
				$this->db->where('appmas.reg_user_id',$reg_user_id);
				$this->db->limit(1);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break;  
			
			case 'get_applicant_father':	
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
				
				/*echo $this->db->last_query();
				die();*/
				
				return $result->result_array();
			break; 

			
			case 'get_applicant_mother':	
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
				//echo $this->db->last_query();
				
				return $result->result_array();
			break; 
			
			case 'get_qualification_details':
			
				$program = $data[0];
				//echo $program . 'hi';die();
				if($program == 'PGRT_CIPET' || $program == 'PGTR_CIPET' || $program == 'TGTR_CIPET' ){
					$this->db->where('gm.program_code',$program);
				}
			
				$this->db->select('IFNULL(gm.graduation_name,qual_desc_1) AS qual_desc_1,year_of_passing,university_board,division_distinction,mark_secured,full_mark,percentage_mark');
				$this->db->from('applicant_qualification_detail A');
				$this->db->join('applicant_master B','A.applied_program = B.applied_program AND A.reg_user_id = B.reg_user_id','inner');
				$this->db->join('graduation_master` gm','A.qual_desc_1 = gm.graduation_code','LEFT');
				$this->db->where('A.reg_user_id',$reg_user_id);
				$this->db->where('A.applied_program',$program);
				$this->db->where('A.qual_desc_1 !=','');
				$this->db->order_by ('A.year_of_passing', "ASC");
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
				
			break; 
			
			case 'get_institute_details':	
				$this->db->select('A.program_name,B.institute_name,A.department_name,A.institute_code,B.location,B.institute_address,B.logo_url');
				$this->db->from('program_master A');
				$this->db->join('institute_master B','A.institute_code=B.institute_code','inner');
				$this->db->where('A.program_code',$seladmcode);
				$result = $this->db->get();
			
				return $result->result_array();
			break; 
			
			case 'get_present_address':	
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
			
				return $result->result_array();
			break; 
			
			case 'get_permanent_address':	
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
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break; 
			
			case 'get_payment_detail':	
				$this->db->select('apov.money_deposit_mode,apov.amount,DATE_FORMAT(apov.depositdate,"%d-%m-%Y") AS depositdate,apov.money_receipt_no, apov.pg_charges');
				$this->db->from('applicant_form_fee_overview apov');
				$this->db->join('applicant_appl_overview','apov.appl_no=applicant_appl_overview.appl_no', 'left');
				$this->db->where('applicant_appl_overview.reg_user_id',$reg_user_id);
				$this->db->where('applicant_appl_overview.applied_program',$seladmcode);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break; 
		
			case 'get_other_information':	
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Permanent State');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				return $result->result_array();
			break; 
			
			case 'get_other_district':	
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Permanent District');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				return $result->result_array();
			break; 

			case 'get_applicant_documents':	
				$this->db->select('afd.appl_no,doc_id,document_path,dtm.document_type');
				$this->db->from('applicant_form_documents afd');
				$this->db->join('applicant_appl_overview','afd.appl_no=applicant_appl_overview.appl_no','inner');
				$this->db->join('document_type_master dtm','afd.document_type = dtm.document_type_code','inner');
				$this->db->where('afd.status',1);
				$this->db->where('applicant_appl_overview.reg_user_id',$reg_user_id);
				$this->db->where('applicant_appl_overview.applied_program',$seladmcode);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break; 
			
			case 'get_other_p_state':	
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Present State');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'get_other_p_district':	
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Present District');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'get_other_board':	
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Name of the Board');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				return $result->result_array();
			break; 
			
			case 'get_other_nationality':	
				$this->db->select('field_value');
				$this->db->from('applicant_other_info');
				$this->db->join('applicant_appl_overview appov','appov.reg_user_id=applicant_other_info.reg_user_id', 'left');
				$this->db->where('field_name','Name of the Board');
				$this->db->where('applicant_other_info.reg_user_id',$reg_user_id);
				$this->db->where('appov.applied_program',$seladmcode);
				$this->db->where('applicant_other_info.STATUS',1);
				$result = $this->db->get();
				return $result->result_array();
			break; 
			/* ===================XXXXXXXXXXXXXXXXXXX==================MY WORK==================XXXXXXXXXXXXXXXXXXXXXX======*/
			
            default :
            	return array('status' => FALSE, 'msg' =>'Unable to load.Contact Support');
        }
    }


}