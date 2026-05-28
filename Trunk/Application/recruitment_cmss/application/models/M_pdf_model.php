<?php

class M_pdf_model extends CI_model 
{
	
	public function template001_pdf($data, $op, $stage = null) {
        /**
		* logic: To print PDF Data
		* case:lov.appl_no,pm.program_name,pm.elective_subjects,aplov.applied_program,aplov.index_no,pm.compulsory_subjects,pm.year
		* author:S N Santhoshi
		* date :06-11-2018
		*/
		$reg_user_id = $this->session->userdata('reg_user_id');
		$seladmcode = '';
		$seladmcode = $data;
		//$seladmcode = $this->session->userdata('admcode');		
		if($seladmcode == '')
		{
			$seladmcode = $this->session->userdata('admcode');
		}
		
        $applicantNumber = $this->session->userdata('appl_no');
		//echo $seladmcode;
		//echo $applicantNumber;
		//die();
        switch ($op) {
        	
        	case 'get_program_details':	
				$seladmcode = $data;
				$this->db->select('A.program_group,D.program_group_name,A.id,A.program_name,A.program_code,A.year,A.apply_start_date,date_format(A.apply_end_date,"%Y-%m-%d") as apply_end_date  ,,A.template_code,C.file_name,C.template_name');
				$this->db->from('program_master A');
				$this->db->join('form_template_master C','A.template_code = C.template_code','inner');
				$this->db->join('program_group_master D','A.program_group = D.program_group_code','inner');//lina V1
				$this->db->where('A.program_code',$seladmcode);
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			
			case 'get_declaration_data':	
				$seladmcode = $data;
				$this->db->select("declaration");
				$this->db->from('program_declaration_data A');
				$this->db->where('A.program_code',$seladmcode);
				$this->db->where('A.record_status',1);
				$result_decl = $this->db->get();
				//echo $this->db->last_query();
				//print_r($result);
				return $result_decl->result_array();
			break; 
			
			case 'get_application_detail':	
				$seladmcode = $data;
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
			
			case 'get_postwise_experience':
			$this->db->select("experience_name,is_experienced");
			$this->db->from('applicant_postwise_experience');
			$this->db->where('applicant_postwise_experience.program_code',$seladmcode);
			$this->db->where('applicant_postwise_experience.reg_user_id',$reg_user_id);
			$result = $this->db->get();
			return $result->result_array();
			break;
			
			case 'get_challandetails':
				//$program_code = $data;
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
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
			
			case 'get_appl_status':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
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
				
				return $result->result_array();
			break;
			
		/*	case 'get_applicant_detail': 
				
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
				$result = $this->db->get();
				
				echo $this->db->last_query();
				die();
				
				return $result->result_array();
			break;  */
			case 'get_applicant_detail':
				$seladmcode = $data;
				//echo $data;die();
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

				$this->db->select('appmas.master_name,'.$reg_user_id.' as reg_user_id,appr.scrutiny_status,appr.scrutiny_remark,um.employee_name as scrutinised_by,date_format(appr.updated_on,"%d-%m-%Y %H:%i") as scrutinised_on,appmas.first_name,appmas.mid_name,appmas.last_name,appmas.full_name,appmas.applicant_email,appmas.applicant_landline,appmas.applicant_mobile,appmas.marital_status,
					userimg.passportphoto,signature.SIGN,gm.gender,nm.nationality AS natinality,appmas.nationality AS nationalitycode,appmas.dob,appmas.dob_in_word,catm.category_name,rm.religion_name as religion,
					appmas.is_physically_challanged,appmas.is_minority_community,mcm.minority_community,appmas.hostel_facility,appmas.ap_resident,appmas.father_name,appmas.presentation_details,appmas.any_other_info,
					appmas.single_girl_child_flag,appmas.if_chronic_illness,appmas.chronic_illness,appmas.if_allergies,appmas.allergies,appmas.last_year_mark,
					appmas.last_school,appmas.other_university,bm.board_name,appmas.last_board,appmas.applicant_email,appmas.univ_regn_no,appmas.is_reserved_quota,
					appr.email_id,appmas.subject_offered1,appmas.subject_offered2,appmas.subject_offered3,appmas.subject_offered4,gen.description,
					appmas.highest_qualification,hqm.qualification_name,subjects_offered,appmas.last_school,appmas.last_grade,appmas.adhar_no,appmas.physically_challenged,appmas.applied_program,appmas.exam_center_code,appmas.exam_center_code1,appmas.exam_center_code2,ex.exam_centre_name,ex1.exam_centre_name as exam_centre_name1,ex2.exam_centre_name as exam_centre_name2,appmas.is_north_east,appmas.north_east_state,appmas.category,appmas.guardian_name,appmas.father_occupation,appmas.annual_parent_income,appmas.is_employed,
					appmas.employer_add,appmas.employer_from,appmas.employer_to,appmas.completion_date,appmas.center_name1,appmas.center_name2,appmas.center_name3,appmas.master_name,appmas.mothers_name,appmas.mothers_profession,appmas.mothers_income,appmas.fathers_adhar_no,appmas.mothers_adhar_no,
					appmas.total_mark,appmas.secured_mark,appmas.distinction,appmas.course_type,appmas.is_kashmiri_migrant,appmas.is_ex_serviceman,appmas.is_sports,appmas.is_computer_education,dc_master.dc_name,
					appmas.honours_total_mark,appmas.honours_secured_mark,appmas.other_subject,appmas.period_of_debar,date_format(appmas.date_of_debar,"%d-%m-%Y") as date_of_debar,appmas.name_of_post,date_format(appmas.govt_doj,"%d-%m-%Y") as govt_doj,appmas.name_of_office,appmas.any_disciplinary_action,
					appmas.honours_division,appmas.honours_subject,hons.subject_name,appmas.are_parents_alive,"" AS GSIGN,"" AS blood_group_name,"" AS mother_tongue,"" AS mode_of_transport, "" AS is_alumnus, "" AS alumnus_name, ""  AS alumnus_year_of_passing, "" AS is_staff,
					"" AS staff_name, "" AS is_general, "" AS caste_name ,ipm.id_proof_name,appmas.id_proof_number,
					pm.program_name,pm.program_code,ex.exam_centre_name as exam_centre_detail,appmas.is_computer_education,appmas.other_computer,appmas.is_computer_type,
					appmas.disability_percent,appmas.district_code,appmas.phtype,is_ews,is_exp,no_of_exp
					');
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
				$this->db->join("dc_master",'dc_master.dc_code=appmas.dc_office','left'); 
				$this->db->where('apovr.applied_program',$seladmcode);
				$this->db->where('appmas.applied_program',$seladmcode);
				$this->db->where('appmas.reg_user_id',$reg_user_id);
				$result = $this->db->get(); 
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break;  
			
			case 'get_post':
			$program_code = $data;
			$reg_user_id = $this->session->userdata('reg_user_id');
			$inst_code = $this->session->userdata('institute_code');
			date_default_timezone_set('Asia/Kolkata');
			//$date = date('Y-m-d', now()); 
			$this->db->select("course_name"); 
			$this->db->from('course_master');
			$this->db->join('course_details','course_master.course_code=course_details.course_code  AND course_master.program_code = course_details.prog_code','left'); 
			$this->db->where('inst_code',$inst_code);
			$this->db->where('prog_code',$program_code);
			$this->db->where('reg_user_id',$reg_user_id);
			$this->db->where('course_master.record_status','1');
			$result = $this->db->get();
			if($result->num_rows() >= 1)
			{
				$this->db->select("GROUP_CONCAT(IFNULL(course_name, '')) AS course_name");   
				//$this->db->select("course_name"); 
				$this->db->from('course_master');
				$this->db->join('course_details','course_master.course_code=course_details.course_code  AND course_master.program_code = course_details.prog_code','left'); 
				$this->db->where('inst_code',$inst_code);
				$this->db->where('prog_code',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('course_master.record_status','1'); 
				$result = $this->db->get();
			}
			else
			{
				$this->db->select("A.program_name as course_name");   
				//$this->db->select("course_name"); 
				$this->db->from('program_master A');
				$this->db->join('applicant_master B','A.program_code = B.applied_program','left'); 
				//$this->db->where('inst_code',$inst_code);
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				//$this->db->where('course_master.record_status','1'); 
				$result = $this->db->get();
			}
			
			//echo $this->db->last_query();
			//$result->num_rows();
		
			
			
			//echo $this->db->last_query();die();
			return $result->result_array();
			break;
			
			
			case 'get_applicant_father':
			    $seladmcode = $data;	
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
			
			case 'get_tech_qual_data_5':
			    $seladmcode = $data;	
				$this->db->distinct("qual_desc_1,year,institute_name,division,thesis,stream,affiliation_from,applicant_technical_qualification_detail.subjects_offered,grade_cgpa");
				$this->db->select("qual_desc_1,year,institute_name,division,thesis,stream,affiliation_from,applicant_technical_qualification_detail.subjects_offered,grade_cgpa");
				$this->db->from('applicant_technical_qualification_detail');
				$this->db->join('applicant_master','applicant_master.reg_user_id = applicant_technical_qualification_detail.reg_user_id','inner');
				$this->db->where('applicant_technical_qualification_detail.applied_program',$seladmcode);
				$this->db->where('applicant_technical_qualification_detail.reg_user_id',$reg_user_id);
				//$this->db->where('applicant_technical_qualification_detail.sl_no','5');
				$result = $this->db->get();
				//echo $this->db->last_query();
				return $result->result_array();
			break;
			
			case 'get_tech_qual_data_6':
			    $seladmcode = $data;	
				$this->db->distinct("qual_desc_1,year,institute_name,division,thesis,stream,affiliation_from,applicant_technical_qualification_detail.subjects_offered,grade_cgpa");
				$this->db->select("qual_desc_1,year,institute_name,division,thesis,stream,affiliation_from,applicant_technical_qualification_detail.subjects_offered,grade_cgpa");
				$this->db->from('applicant_technical_qualification_detail');
				$this->db->join('applicant_master','applicant_master.reg_user_id = applicant_technical_qualification_detail.reg_user_id','inner');
				$this->db->where('applicant_technical_qualification_detail.applied_program',$seladmcode);
				$this->db->where('applicant_technical_qualification_detail.reg_user_id',$reg_user_id);
				$this->db->where('applicant_technical_qualification_detail.sl_no','6');
				$result = $this->db->get();
				//echo $this->db->last_query();
				return $result->result_array();
			break;
			
			case 'get_tech_qual_data_7':
				$this->db->distinct("qual_desc_1,year,institute_name,thesis,stream,affiliation_from,applicant_technical_qualification_detail.subjects_offered,grade_cgpa");
				$this->db->select("qual_desc_1,year,institute_name,thesis,stream,affiliation_from,applicant_technical_qualification_detail.subjects_offered,grade_cgpa");
				$this->db->from('applicant_technical_qualification_detail');
				$this->db->join('applicant_master','applicant_master.reg_user_id = applicant_technical_qualification_detail.reg_user_id','inner');
				$this->db->where('applicant_technical_qualification_detail.applied_program',$seladmcode);
				$this->db->where('applicant_technical_qualification_detail.reg_user_id',$reg_user_id);
				$this->db->where('applicant_technical_qualification_detail.sl_no','7');
				$result = $this->db->get();
				//echo $this->db->last_query();
				return $result->result_array();
			break;
			
			case 'get_applicant_mother':	
			$seladmcode = $data;	
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
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break; 
			
			case 'get_qualification_details':
			
				$program = $data;
				$this->db->select(' A.`qual_desc_1` AS qual_desc_1,qual_desc_2,other_stream,A.honours_subject,year_of_passing,university_board,division_distinction,mark_secured,full_mark,percentage_mark,A.duration,A.course');
				$this->db->from('applicant_qualification_detail A');
				$this->db->join('applicant_master B','A.applied_program = B.applied_program AND A.reg_user_id = B.reg_user_id','inner');
				$this->db->where('A.reg_user_id',$reg_user_id);
				$this->db->where('A.applied_program',$program);
				$this->db->where('A.qual_desc_1 is not null');
				$this->db->order_by('A.id');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break; 
			
			case 'research_employmen_details':
				$program = $data;
				$this->db->select('appo.applied_program,appo.reg_user_id,ared.organization,ared.post_held,ared.date_from,ared.date_to,ared.nature_of_job,ared.pay_band,ared.basic_pay');
				$this->db->from('applicant_research_experience_detail ared');
				$this->db->join('applicant_appl_overview appo','ared.applied_program = appo.applied_program  AND  ared.reg_user_id = appo.reg_user_id','inner');
				$this->db->join('program_master pm','appo.applied_program = pm.program_code ','inner');
				$this->db->where('appo.reg_user_id',$reg_user_id);
				$this->db->where('appo.applied_program',$program);
				$result = $this->db->get();
			/*	echo $this->db->last_query();
				die();*/
				
				return $result->result_array();
			break; 
			
			case 'reference_details':
				$program = $data;
				$this->db->select('appo.applied_program,appo.reg_user_id,ard.referenced_by,ard.contact_address,ard.email_id,ard.mobile_number');
				$this->db->from('applicant_reference_detail ard');
				$this->db->join('applicant_appl_overview appo','ard.applied_program = appo.applied_program  AND  ard.reg_user_id = appo.reg_user_id','inner');
				$this->db->join('program_master pm','appo.applied_program = pm.program_code ','inner');
				$this->db->where('appo.reg_user_id',$reg_user_id);
				$this->db->where('appo.applied_program',$program);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break; 
			
			case 'get_institute_details':	
				$this->db->select('A.program_name,B.institute_name,A.department_name,A.institute_code,B.location,B.institute_address,B.logo_url,A.advt_no,date_format(A.advt_date,"%d-%m-%Y") AS advt_date');
				$this->db->from('program_master A');
				$this->db->join('institute_master B','A.institute_code=B.institute_code','inner');
				$this->db->where('A.program_code',$seladmcode);
				
				$result = $this->db->get();
			
				return $result->result_array();
			break; 
			
			case 'get_present_address':	
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
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break; 
			
			case 'get_permanent_address':	
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
				$this->db->where('dtm.document_type_code !=','PHO');
				$this->db->where('dtm.document_type_code !=','SIG');
				$result = $this->db->get();
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
			case 'get_work_experience':	
				$work_experience_detail = array();
				$this->db->select('A.*');
				$this->db->from('applicant_work_experience_detail A');
				$this->db->join('applicant_master B','A.applied_program = B.applied_program AND A.reg_user_id = B.reg_user_id','inner');
				$this->db->where('A.reg_user_id',$reg_user_id);
				$this->db->where('A.applied_program',$seladmcode);
				$this->db->order_by('A.id');
				//$this->db->order_by ('A.year_of_passing', "ASC");
				
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				
				return $result->result_array();
			break; 
			case 'get_total_experience':	
				$this->db->select("total_experience_1");
				$this->db->from('applicant_total_experience');
				$this->db->where('applied_program',$seladmcode);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				
				return $result->result_array();
			break; 
			/* ===================XXXXXXXXXXXXXXXXXXX==================MY WORK==================XXXXXXXXXXXXXXXXXXXXXX======*/
			
            default :
            	return array('status' => FALSE, 'msg' =>'Unable to load.Contact Support');
        }
    }
   	public function template008_pdf($data, $op, $stage = null) {
        /**
		* logic: To print PDF Data
		* case:lov.appl_no,pm.program_name,pm.elective_subjects,aplov.applied_program,aplov.index_no,pm.compulsory_subjects,pm.year
		* author:Sailendranath Mansingh
		* date :03-11-2017
		*/
		$reg_user_id = $this->session->userdata('reg_user_id');
		$seladmcode = $this->session->userdata('admcode');		
		if($seladmcode == '')
		{
			$seladmcode = $data;

		}
		
        $applicantNumber = $this->session->userdata('appl_no');
		///echo $seladmcode;
		//echo $applicantNumber;
		//die();
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
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break; 
			
			case 'get_qualification_details':
				$program = $data;
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
    public function admit_card_pdf($data, $op, $stage = null) {
        /**
		* logic: To print PDF Data
		* case: To download admit card
		* author:S N Santhoshi
		* date :25-01-2018
		*/
		switch ($op) {
			case 'get_ins_detail':	
				$ins = $data['ins'];		
				$this->db->select('institute_name, logo_url');
				$this->db->from('institute_master');
				$this->db->where('institute_code',$ins);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break; 
			case 'get_course_detail':	
				$sel_program_code = $data['program_code'];	
				$result = $this->db->query("SELECT date_of_exam,MAX(course_morning_session) AS morning_session, 
						MAX(course_evening_session) AS evening_session FROM (
						SELECT program_code,date_of_exam,CASE WHEN SESSION = 'Morning Session' THEN course_name END AS course_morning_session,
						CASE WHEN SESSION = 'Evening Session' THEN course_name END AS course_evening_session 
						FROM course_program_mapping 
						WHERE program_code = '$sel_program_code') X
						GROUP BY X.date_of_exam");
				return $result->result_array();
			break;
			case 'get_subject_detail':	
				$sel_program_code = $data['program_code'];	
				$this->db->select("*");
				$this->db->from('course_program_mapping');
				$this->db->where('program_code',$sel_program_code);
				$result = $this->db->get();
				return $result->result_array();
			break; 
			case 'get_course_timing_detail':	
				$sel_program_code = $data['program_code'];	
				$result = $this->db->query("SELECT 
						MAX(timing_morning_session) AS timing_morning_session,
						MAX(timing_evening_session) AS timing_evening_session
						FROM (
						SELECT 
						CASE WHEN SESSION = 'Morning Session' THEN timing END AS timing_morning_session,
						CASE WHEN SESSION = 'Evening Session' THEN timing END AS timing_evening_session 
						FROM course_program_mapping 
						WHERE program_code = '$sel_program_code') X");
				return $result->result_array();
			break; 
			case 'get_application_detail_individual':	
				$sel_program_code = $data['program_code'];
				/*$exam_center_code = $data['assigned_exam_center_code'];
				$exam_vanue = $data['exam_vanue'];
				$appl_no = $data['appl_no'];*/
				$reg_user_id = $data['reg_user_id'];											
				
				$this->db->select("ADM.exam_center_contact,cm.course_name,A.master_name,A.full_name,A.dob, B.appl_no, B.form_no, 
									A.reg_user_id, E.updated_on, D.money_deposit_mode, amount, depositdate,
									F.document_path AS passport_path,G.document_path AS signature_path,
									money_receipt_no, A.exam_center_code AS applied_exam_center,EXM.exam_centre_name,
									E.assigned_exam_center AS assigned_exam_center, E.omr_no,E.roll_no, E.record_status AS publish_status,
									PM.program_name, ADM.exam_vanue,A.applied_program,PM.year,ADM.gate_closing_time,
									date_format(ADM.examination_date,'%d-%m-%Y') as examination_date, ADM.exam_schedule,ADM.exam_instructions,ADM.exam_center_address,
									ADM.controller_signature,ADM.controller_name,ADM.controller_mobile_no,ADM.controller_email,
									H.institute_name,H.institute_address,PM.department_name,E.assigned_exam_vanue,gm.gender");
				$this->db->from('applicant_master A');
				$this->db->join('applicant_appl_overview B','A.reg_user_id = B.reg_user_id AND A.applied_program = B.applied_program','INNER');
				$this->db->join('applicant_form_fee_overview D','B.appl_no = D.appl_no ','INNER');
				$this->db->join('admitcard_published E','B.appl_no = E.appl_no AND A.applied_program = E.applied_program','INNER');
				$this->db->join('program_master PM','A.applied_program = PM.program_code','INNER');
				$this->db->join('exam_centre_master EXM','E.assigned_exam_center = EXM.exam_centre_code AND A.applied_program = EXM.`program_code`','INNER');
				$this->db->join('admitcard_setup ADM','ADM.program_code = E.applied_program AND ADM.exam_center_code = E.assigned_exam_center AND ADM.exam_vanue_code = E.assigned_exam_vanue ','INNER');
				$this->db->join('institute_master H','PM.institute_code = H.institute_code','INNER');
				$this->db->join('gender_master gm','A.gender = gm.gender_code','INNER');
				$this->db->join('course_master cm','cm.course_code = A.master_name','INNER');
				$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='PHO') F",'B.appl_no = F.appl_no','INNER');
				$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='SIG') G",'B.appl_no = G.appl_no','INNER');
				$this->db->where('B.appl_status','Verified');
				$this->db->where('A.status','1');
				$this->db->where('E.record_status','1');
				$this->db->where('A.applied_program',$sel_program_code);
				//$this->db->where('E.assigned_exam_center',$exam_center_code);
				//$this->db->where('E.assigned_exam_vanue',$exam_vanue);
				//$this->db->where('E.appl_no','NIRPROG1_NIRTAR2018000003');
				$this->db->where('A.reg_user_id',$reg_user_id);
				$result = $this->db->get();
				//echo $this->db->last_query();die();
				
				return $result->result_array();
				
				
			break;
			case 'get_application_detail':	
				$sel_program_code = $data['program_code'];
				$exam_center_code = $data['assigned_exam_center_code'];
				$exam_vanue = $data['exam_vanue'];
				$from = $data['from'];
				$to = $data['to'];
				$reg_user_id = $data['reg_user_id'];
				
				if($from == '')
				{
					$from = 1;
				}
				$this->db->select("COUNT(*) AS total_count");
				$this->db->from('applicant_master A');
				$this->db->join('applicant_appl_overview B','A.reg_user_id = B.reg_user_id
									AND A.applied_program = B.applied_program','INNER');
				$this->db->join('applicant_form_fee_overview D','B.appl_no = D.appl_no ','INNER');
				$this->db->join('admitcard_published E','B.appl_no = E.appl_no AND A.applied_program = E.applied_program','INNER');
				$this->db->join('program_master PM','A.applied_program = PM.program_code','INNER');
				$this->db->join('exam_centre_master EXM','A.applied_program = EXM.program_code AND E.assigned_exam_center = EXM.exam_centre_code','INNER');
				$this->db->join('admitcard_setup ADM','ADM.program_code = E.applied_program AND ADM.exam_center_code = E.assigned_exam_center AND ADM.exam_vanue_code = E.assigned_exam_vanue ','INNER');
				$this->db->join('institute_master H','PM.institute_code = H.institute_code','INNER');
				$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='PHO') F",'B.appl_no = F.appl_no','INNER');
				$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='SIG') G",'B.appl_no = G.appl_no','INNER');
				$this->db->where('B.appl_status','Verified');
				$this->db->where('A.status','1');
				$this->db->where('E.record_status','1');
				$this->db->where('A.applied_program',$sel_program_code);
				$this->db->where('E.assigned_exam_center',$exam_center_code);
				$this->db->where('E.assigned_exam_vanue',$exam_vanue);
				$result = $this->db->get();
				$query = $result->result_array();
				foreach($result->result_array() AS $row1)
				{
					$total_count = $row['total_count'];
				}
				if($to == '')
				{
					$to = $total_count;
				}
				
				$x = $from - 1;
				$y = $to - $from + 1;
				
				
				
				/*$this->db->select("A.full_name,date_format( A.dob,'%d-%m-%Y') as dob, B.appl_no, B.form_no,  REL.rel_name, CAT.category_name,
									A.reg_user_id, E.updated_on, D.money_deposit_mode, amount, depositdate,
									F.document_path AS passport_path,G.document_path AS signature_path,
									money_receipt_no, A.exam_center_code AS applied_exam_center,EXM.exam_centre_name,
									E.assigned_exam_center AS assigned_exam_center, E.omr_no,E.roll_no, E.record_status AS publish_status,
									PM.program_name, ADM.exam_vanue,A.applied_program,PM.year,
									ADM.exam_schedule,ADM.exam_instructions,ADM.exam_center_address,
									ADM.controller_signature,ADM.controller_name,ADM.controller_mobile_no,ADM.controller_email,
									ADM.controller_signature,ADM.exam_shift,ADM.reporting_time,ADM.exam_start_time,date_format(ADM.examination_date,'%d-%m-%Y') as examination_date,
									H.institute_name,E.assigned_exam_vanue");*/
				$this->db->select("A.full_name,date_format( A.dob,'%d-%m-%Y') as dob,A.is_reserved_quota, B.appl_no, B.form_no, REL.rel_name, CAT.category_name,
									A.reg_user_id, E.updated_on, D.money_deposit_mode, amount, depositdate,
									F.document_path AS passport_path,G.document_path AS signature_path,
									money_receipt_no, A.exam_center_code AS applied_exam_center,EXM.exam_centre_name,
									E.assigned_exam_center AS assigned_exam_center, E.omr_no,E.roll_no, E.record_status AS publish_status,
									PM.program_name, ADM.exam_vanue,ADM.template_code,A.applied_program,PM.year,
									ADM.exam_schedule,ADM.exam_instructions,ADM.exam_center_address,
									ADM.controller_signature,ADM.controller_name,ADM.controller_mobile_no,ADM.controller_email,
									ADM.controller_signature,ADM.exam_shift,ADM.reporting_time,ADM.exam_start_time,ADM.gate_closing_time,date_format(ADM.examination_date,'%d-%m-%Y') as examination_date,
									H.institute_name,E.assigned_exam_vanue");
				$this->db->from('applicant_master A');
				$this->db->join('applicant_appl_overview B','A.reg_user_id = B.reg_user_id
									AND A.applied_program = B.applied_program','LEFT');
				$this->db->join('applicant_form_fee_overview D','B.appl_no = D.appl_no ','LEFT');
				$this->db->join('category_master CAT','A.category = CAT.category_code ','LEFT');
				$this->db->join('applicant_relation REL','A.reg_user_id = REL.reg_user_id AND A.applied_program = REL.applied_program AND REL.applicant_rel_flag = 1 ','LEFT');
				$this->db->join('admitcard_published E','B.appl_no = E.appl_no AND A.applied_program = E.applied_program','LEFT');
				$this->db->join('program_master PM','A.applied_program = PM.program_code','LEFT');
				$this->db->join('exam_centre_master EXM','A.applied_program = EXM.program_code AND E.assigned_exam_center = EXM.exam_centre_code','LEFT');
				$this->db->join('admitcard_setup ADM','ADM.program_code = E.applied_program AND ADM.exam_center_code = E.assigned_exam_center AND ADM.exam_vanue_code = E.assigned_exam_vanue ','LEFT');
				$this->db->join('institute_master H','PM.institute_code = H.institute_code','LEFT');
				$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='PHO') F",'B.appl_no = F.appl_no','LEFT');
				$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='SIG') G",'B.appl_no = G.appl_no','LEFT');
				$this->db->where('B.appl_status','Verified');
				$this->db->where('A.status','1');
				$this->db->where('E.record_status','1');
				$this->db->where('A.applied_program',$sel_program_code);
				$this->db->where('E.assigned_exam_center',$exam_center_code);
				$this->db->where('A.reg_user_id',$reg_user_id);
				$this->db->order_by("omr_no", "asc");
				$this->db->limit($y,$x);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break; 
			case 'get_attendance_sheet_detail':	
				$sel_program_code = $data['program_code'];
				$exam_center_code = $data['assigned_exam_center_code'];
				$exam_vanue = $data['exam_vanue'];
				$from = $data['from'];
				$to = $data['to'];
				$course = $data['course'];
				if($from == '')
				{
					$from = 1;
				}
				$this->db->select("COUNT(*) AS total_count");
				$this->db->from('applicant_master A');
				$this->db->join('applicant_appl_overview B','A.reg_user_id = B.reg_user_id
									AND A.applied_program = B.applied_program','INNER');
				$this->db->join('applicant_form_fee_overview D','B.appl_no = D.appl_no ','INNER');
				$this->db->join('admitcard_published E','B.appl_no = E.appl_no AND A.applied_program = E.applied_program','INNER');
				$this->db->join('program_master PM','A.applied_program = PM.program_code','INNER');
				$this->db->join('exam_centre_master EXM','A.applied_program = EXM.program_code AND E.assigned_exam_center = EXM.exam_centre_code','INNER');
				$this->db->join('admitcard_setup ADM','ADM.program_code = E.applied_program AND ADM.exam_center_code = E.assigned_exam_center AND ADM.exam_vanue_code = E.assigned_exam_vanue ','INNER');
				$this->db->join('institute_master H','PM.institute_code = H.institute_code','INNER');
				$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='PHO') F",'B.appl_no = F.appl_no','INNER');
				$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='SIG') G",'B.appl_no = G.appl_no','INNER');
				$this->db->where('B.appl_status','Verified');
				$this->db->where('A.status','1');
				$this->db->where('E.record_status','1');
				$this->db->where('A.applied_program',$sel_program_code);
				$this->db->where('E.assigned_exam_center',$exam_center_code);
				$this->db->where('E.assigned_exam_vanue',$exam_vanue);
				//$this->db->where('A.master_name',$course);
				$result = $this->db->get();
				
				$query = $result->result_array();
				foreach($result->result_array() AS $row1)
				{
					$total_count = $row1['total_count'];
				}
				if($to == '')
				{
					$to = $total_count;
				}
				
				$x = $from - 1;
				$y = $to - $from + 1;
				$this->db->DISTINCT();								
				$this->db->select("date_format( ADM.examination_date,'%d-%m-%Y') as examination_date,$y,ADM.exam_vanue,A.master_name,A.full_name, B.appl_no, B.form_no, 
									A.reg_user_id, E.updated_on, D.money_deposit_mode, amount, depositdate,
									F.document_path AS passport_path,G.document_path AS signature_path,
									money_receipt_no, A.exam_center_code AS applied_exam_center,EXM.exam_centre_name,
									E.assigned_exam_center AS assigned_exam_center, E.omr_no,E.roll_no, E.record_status AS publish_status,
									PM.program_name, ADM.exam_vanue,A.applied_program,PM.year,
									ADM.exam_schedule,ADM.exam_instructions,ADM.exam_center_address,
									ADM.controller_signature,
									H.institute_name,E.assigned_exam_vanue,gm.gender");
				$this->db->from('applicant_master A');
				$this->db->join('applicant_appl_overview B','A.reg_user_id = B.reg_user_id
									AND A.applied_program = B.applied_program','INNER');
				$this->db->join('applicant_form_fee_overview D','B.appl_no = D.appl_no ','INNER');
				$this->db->join('admitcard_published E','B.appl_no = E.appl_no AND A.applied_program = E.applied_program','INNER');
				$this->db->join('program_master PM','A.applied_program = PM.program_code','INNER');
				$this->db->join('exam_centre_master EXM','E.assigned_exam_center = EXM.exam_centre_code AND E.applied_program = EXM.program_code','INNER');
				$this->db->join('admitcard_setup ADM','ADM.program_code = E.applied_program AND ADM.exam_center_code = E.assigned_exam_center AND ADM.exam_vanue_code = E.assigned_exam_vanue ','INNER');
				$this->db->join('institute_master H','PM.institute_code = H.institute_code','INNER');
				$this->db->join('gender_master gm','A.gender = gm.gender_code','LEFT');
				//$this->db->join('course_master cm','A.master_name = cm.course_code','INNER');
				$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='PHO') F",'B.appl_no = F.appl_no','INNER');
				$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='SIG') G",'B.appl_no = G.appl_no','INNER');
				$this->db->where('B.appl_status','Verified');
				$this->db->where('A.status','1');
				$this->db->where('E.record_status','1');
				$this->db->where('A.applied_program',$sel_program_code);
				$this->db->where('E.assigned_exam_center',$exam_center_code);
				$this->db->where('E.assigned_exam_vanue',$exam_vanue);
				//$this->db->where('A.master_name',$course);
				$this->db->order_by("E.assigned_exam_center,A.master_name,E.omr_no,RIGHT(`roll_no`,3)");
				$this->db->limit($y,$x);
				$result = $this->db->get();
				/*echo $this->db->last_query();die();*/
				
				return $result->result_array();
			break;
			
			case 'get_application_detail_1':	
				$sel_program_code = $data['program_code'];
				$exam_center_code = $data['assigned_exam_center_code'];
				$exam_vanue = $data['exam_vanue'];
				$exam_vanue_new = str_replace('_', '/',$exam_vanue);
				$from = $data['from'];
				$to = $data['to'];
				$reg_user_id = $data['reg_user_id'];
				/*echo $from;
				echo $to;
				die();*/
				if($from == '')
				{
					$from = 1;
				}
				$this->db->select("COUNT(*) AS total_count");
				$this->db->from('applicant_master A');
				$this->db->join('applicant_appl_overview B','A.reg_user_id = B.reg_user_id
									AND A.applied_program = B.applied_program','INNER');
				$this->db->join('applicant_form_fee_overview D','B.appl_no = D.appl_no ','INNER');
				$this->db->join('admitcard_published E','B.appl_no = E.appl_no AND A.applied_program = E.applied_program','INNER');
				$this->db->join('program_master PM','A.applied_program = PM.program_code','INNER');
				$this->db->join('exam_centre_master EXM','A.applied_program = EXM.program_code AND E.assigned_exam_center = EXM.exam_centre_code','INNER');
				$this->db->join('admitcard_setup ADM','ADM.program_code = E.applied_program AND ADM.exam_center_code = E.assigned_exam_center AND ADM.exam_vanue_code = E.assigned_exam_vanue ','INNER');
				$this->db->join('institute_master H','PM.institute_code = H.institute_code','INNER');
				$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='PHO') F",'B.appl_no = F.appl_no','INNER');
				$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='SIG') G",'B.appl_no = G.appl_no','INNER');
				$this->db->where('B.appl_status','Verified');
				$this->db->where('A.status','1');
				$this->db->where('E.record_status','1');
				$this->db->where('A.applied_program',$sel_program_code);
				$this->db->where('E.assigned_exam_center',$exam_center_code);
				$this->db->where('E.assigned_exam_vanue',$exam_vanue_new);
				$result = $this->db->get();
				
				$query = $result->result_array();
				foreach($result->result_array() AS $row1)
				{
					$total_count = $row['total_count'];
				}
				if($to == '')
				{
					$to = $total_count;
				}
				
				$x = $from - 1;
				$y = $to - $from + 1;
				
				
				 
				$this->db->select("A.full_name,date_format( A.dob,'%d-%m-%Y') as dob,A.is_reserved_quota, B.appl_no, B.form_no, REL.rel_name, CAT.category_name,
									A.reg_user_id, E.updated_on, D.money_deposit_mode, amount, depositdate,
									F.document_path AS passport_path,G.document_path AS signature_path,
									money_receipt_no, A.exam_center_code AS applied_exam_center,EXM.exam_centre_name,
									E.assigned_exam_center AS assigned_exam_center, E.omr_no,E.roll_no, E.record_status AS publish_status,
									PM.program_name, ADM.exam_vanue,ADM.template_code,A.applied_program,PM.year,
									ADM.exam_schedule,ADM.exam_instructions,ADM.exam_center_address,
									ADM.controller_signature,ADM.controller_name,ADM.controller_mobile_no,ADM.controller_email,
									ADM.controller_signature,ADM.exam_shift,ADM.reporting_time,ADM.exam_start_time,ADM.gate_closing_time,date_format(ADM.examination_date,'%d-%m-%Y') as examination_date,
									H.institute_name,E.assigned_exam_vanue");
				$this->db->from('applicant_master A');
				$this->db->join('applicant_appl_overview B','A.reg_user_id = B.reg_user_id
									AND A.applied_program = B.applied_program','left');
				$this->db->join('applicant_form_fee_overview D','B.appl_no = D.appl_no ','left');
				$this->db->join('category_master CAT','A.category = CAT.category_code ','left');
				$this->db->join('applicant_relation REL','A.reg_user_id = REL.reg_user_id AND A.applied_program = REL.applied_program AND REL.applicant_rel_flag = 1 ','left');
				$this->db->join('admitcard_published E','B.appl_no = E.appl_no AND A.applied_program = E.applied_program','left');
				$this->db->join('program_master PM','A.applied_program = PM.program_code','left');
				$this->db->join('exam_centre_master EXM','A.applied_program = EXM.program_code AND E.assigned_exam_center = EXM.exam_centre_code','left');
				$this->db->join('admitcard_setup ADM','ADM.program_code = E.applied_program AND ADM.exam_center_code = E.assigned_exam_center AND ADM.exam_vanue_code = E.assigned_exam_vanue ','left');
				$this->db->join('institute_master H','PM.institute_code = H.institute_code','left');
				$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='PHO') F",'B.appl_no = F.appl_no','left');
				$this->db->join("(SELECT document_path,appl_no FROM applicant_form_documents WHERE document_type='SIG') G",'B.appl_no = G.appl_no','left');
				$this->db->where('B.appl_status','Verified');
				$this->db->where('A.status','1');
				$this->db->where('E.record_status','1');
			
				$this->db->where('A.applied_program',$sel_program_code);
				$this->db->where('E.assigned_exam_center',$exam_center_code);
				$this->db->where('E.assigned_exam_vanue',$exam_vanue_new);
				//$this->db->where('A.reg_user_id',$reg_user_id);
				$this->db->order_by("omr_no", "asc");
				$this->db->limit($y,$x);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break; 
			
			/*case 'get_appl_no':	
				$admcode = $data['admcode'];
				$reg_user_id = $data['reg_user_id'];
				
				$this->db->select("appl_no");
				$this->db->from('applicant_appl_overview');
				$this->db->where('applied_program',$admcode);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				
				return $result->result_array();
			break; */
			default :
            	return array('status' => FALSE, 'msg' =>'Unable to load.Contact Support');
        }
	}
	public function application_data($data, $op, $stage = null) {
		switch ($op) {
			case 'get_appln_no':	
				$admcode = $data['admcode'];
				$reg_user_id = $data['reg_user_id'];
				
				$this->db->select("appl_no");
				$this->db->from('applicant_appl_overview');
				$this->db->where('applied_program',$admcode);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$appl_no = $row['appl_no']; 	
	            }
				$output = array('appl_no'=>$appl_no);
				return $output;
			break; 
			case 'get_rank_detail':	
				$admcode = $data['applied_program'];
				$reg_user_id = $data['reg_user_id'];
				
				$this->db->select("R.jee_rollno,R.full_name,R.letter_slno,R.applied_program,R.appl_no,R.address,cm.category_name,R.state,pm.program_name,R.counselling_venue,date_format(R.publish_date,'%d-%m-%Y') as publish_date,TIME_FORMAT(R.publish_time,'%h:%i %p') as publish_time");
				$this->db->from('applicant_rank_master R');
				$this->db->join('program_master pm','R.applied_program=pm.program_code','INNER');
				$this->db->join('category_master cm','R.category=cm.category_code','left');
				$this->db->where('R.applied_program',$admcode);
				$this->db->where('R.mobile',$reg_user_id);
				$result = $this->db->get();
				/*$sql=$this->db->last_query();
				print_r($sql);die();*/
				$output_data = $result->result_array()[0];
				/*$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$appl_no = $row['appl_no']; 	
	            }
				$output = array('appl_no'=>$appl_no);*/
				return $output_data;
			break;
			//susmita
			case 'get_merit_detail':	
				$admcode = $data['applied_program'];
				$reg_user_id = $data['reg_user_id'];
				$round_no = $data['round_no'];
				
				$this->db->select("D.full_name,D.reg_user_id,B.omr_no,B.appl_no,P.program_name");
				$this->db->from('admitcard_published B');
				$this->db->join('admitcard_round_data E','B.omr_no = E.roll_no','left');
				$this->db->join('applicant_exam_result A','A.applicant_id = B.omr_no AND A.program_code = B.applied_program AND A.round_no = '.$round_no.'','left');
				$this->db->join('applicant_appl_overview C','B.appl_no = C.appl_no AND B.applied_program = C.applied_program','left');
				$this->db->join('applicant_master D','C.reg_user_id = D.reg_user_id AND C.applied_program = D.applied_program','left');
				$this->db->join('program_master P','P.program_code = D.applied_program','Inner');
				//$this->db->where("B.created_by",$institute_code);
				$this->db->where("E.round_no",$round_no);
				$this->db->where("B.record_status",'1');
				$this->db->where("A.field",'Selected');
				
				
				$result = $this->db->get();/*echo $this->db->last_query();
				die();*/
				/*$sql=$this->db->last_query();
				print_r($sql);die();*/
				$output_data = $result->result_array()[0];
				/*$output = array("aaData" => array());
				foreach ($output_data as $row) 
	            {
	            	$appl_no = $row['appl_no']; 	
	            }
				$output = array('appl_no'=>$appl_no);*/
				return $output_data;
			break;
			case 'get_appointment_detail':	
				$admcode = $data['applied_program'];
				$reg_user_id = $data['reg_user_id'];
				$round_no = $data['round_no'];
				
				$this->db->select("instructions,authorised_name,authorised_sign");
				$this->db->from('appointment_letter_setup ');
				$this->db->where("program_code",$admcode);
				$this->db->where("record_status",'1');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array()[0];
				
				return $output_data;
			break;
			case 'get_merit_detail_1':	
				$program = $data['applied_program'];
				$round_data = $data['round_no'];
				$from = $data['from'];
				$to = $data['to'];
				$reg_user_id = $data['reg_user_id'];
				/*echo $from;
				echo $to;
				echo $round_data;
				echo $program;
				die();*/
				if($from == '')
				{
					$from = 1;
				}
				$this->db->select("COUNT(*) AS total_count");
				$this->db->distinct("B.appl_no");
				$this->db->from('admitcard_published B');
				$this->db->join('admitcard_round_data E','B.omr_no = E.roll_no','left');
				$this->db->join('applicant_exam_result A','A.applicant_id = B.omr_no AND A.program_code = B.applied_program AND A.round_no = '.$round_data.'','left');
				$this->db->join('applicant_appl_overview C','B.appl_no = C.appl_no AND B.applied_program = C.applied_program','left');
				$this->db->join('applicant_master D','C.reg_user_id = D.reg_user_id AND C.applied_program = D.applied_program','left');
				//$this->db->where("B.created_by",$institute_code);
				$this->db->where("E.round_no",$round_data);
				$this->db->where("B.record_status",'1');
				$this->db->where("A.field",'Selected');
				$this->db->where('B.applied_program',$program);
				
				
				$result = $this->db->get();
				$query = $result->result_array();
				foreach($result->result_array() AS $row1)
				{
					$total_count = $row['total_count'];
				}
				if($to == '')
				{
					$to = $total_count;
				}
				
				$x = $from - 1;
				$y = $to - $from + 1;
				$this->db->distinct("B.appl_no");
				$this->db->select("D.full_name,D.reg_user_id,B.omr_no,B.appl_no,P.program_name");
				$this->db->from('admitcard_published B');
				$this->db->join('admitcard_round_data E','B.omr_no = E.roll_no','left');
				$this->db->join('applicant_exam_result A','A.applicant_id = B.omr_no AND A.program_code = B.applied_program AND A.round_no = '.$round_data.'','left');
				$this->db->join('applicant_appl_overview C','B.appl_no = C.appl_no AND B.applied_program = C.applied_program','left');
				$this->db->join('applicant_master D','C.reg_user_id = D.reg_user_id AND C.applied_program = D.applied_program','left');
				$this->db->join('program_master P','P.program_code = D.applied_program','Inner');
				//$this->db->where("B.created_by",$institute_code);
				$this->db->where("E.round_no",$round_data);
				$this->db->where("B.record_status",'1');
				$this->db->where("A.field",'Selected');
				$this->db->where("A.program_code",$program);
				/*$this->db->distinct("C.appl_no");
				$this->db->select("C.appl_no,A.applicant_id,C.reg_user_id,A.applicant_name,P.program_name");
				$this->db->from('applicant_exam_result A');
				$this->db->join('admitcard_round_data E','A.applicant_id = E.roll_no','left');
				$this->db->join('applicant_appl_overview C','C.appl_no = A.appl_no AND A.program_code = C.applied_program','left');
				$this->db->join('program_master P','P.program_code = A.program_code','Inner');
				//$this->db->where("B.created_by",$institute_code);
				$this->db->where("E.round_no",$round_data);
				$this->db->where("A.record_status",'1');
				$this->db->where("A.field",'Selected');
				$this->db->where("A.program_code",$program);*/
				
				//$this->db->where('A.reg_user_id',$reg_user_id);
				$this->db->order_by("B.omr_no", "asc");
				$this->db->limit($y,$x);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				return $result->result_array();
			break; 
			case 'store_download_status':	
				$admcode = $data['applied_program'];
				$reg_user_id = $data['reg_user_id'];
				$this->load->helper('date');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s",now());
				$insert_data = array('reg_user_id'=>$reg_user_id,
									'applied_program'=>$admcode,
									'record_status'=>1,
									'downloaded_date'=>$now,
				);
				$insert_query = $this->db->insert_string('rankcard_downloadstatus', $insert_data);
				$insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
				$output_data = $this->db->query($insert_query);
				return $output_data;
			break; 
			default :
           		return array('status' => FALSE, 'msg' =>'Unable to load.Contact Support');
        }
	}
	public function result_pdf($data, $op, $stage = null) {
        /**
		* logic: To print PDF Data
		* case:lov.appl_no,pm.program_name,pm.elective_subjects,aplov.applied_program,aplov.index_no,pm.compulsory_subjects,pm.year
		* author:Susmita Mohapatra
		* date :15-01-2019
		*/
				$reg_user_id = $this->session->userdata('reg_user_id');
				$program_code = $data;
				
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
        		
        switch ($op) {
			case 'get_applicant_detail':
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
					
				$this->db->select("applicant_name,applicant_id,B.appl_no,field,value");
				$this->db->from('applicant_exam_result A');
				$this->db->join('admitcard_published B','A.applicant_id = B.omr_no and A.program_code = B.applied_program','left');
				$this->db->where('appl_no',$appl_no);
				$this->db->where('applied_program',$program_code);
				$result = $this->db->get();
				
	            return $result->result_array();
			break; 
			
		
			case 'get_program_detail':
				$this->db->select('C.appl_no,A.program_code,program_name');
				$this->db->from('program_master A');
				//$this->db->join('program_eligibility_setup B','B.program_code = A.program_code','left');
				$this->db->join('applicant_appl_overview C','A.program_code = C.applied_program','left');
				//$this->db->join('form_template_master D','D.template_code = A.template_code','left');
				$this->db->where('A.program_code',$program_code);
				
				$result = $this->db->get();
				
				return $result->result_array();
			break; 
				
			
			
			
			
			
			/* ===================XXXXXXXXXXXXXXXXXXX==================MY WORK==================XXXXXXXXXXXXXXXXXXXXXX======*/
			
            default :
            	return array('status' => FALSE, 'msg' =>'Unable to load.Contact Support');
        }
    }
}
