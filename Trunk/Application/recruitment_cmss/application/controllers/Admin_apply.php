<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_apply extends CI_Controller
{
	public function __construct() 
	{
		parent::__construct();
		// Clickjacking Attack
		$this->output->set_header('X-FRAME-OPTIONS: DENY'); 
		('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		# helpers
		/*$this->load->helper(array('form'));
		# libraries
		$this->load->library('form_validation');
		$this->load->library('user_agent');
		$this->role = $this->session->userdata('role');
		# models
		$this->load->model('admin_model');
		$this->load->model('getter_model');
		$this->load->model('user_model');
		$this->load->model('setting_model');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');*/	
		# models
		$this->load->model('superadmin_model');
		$this->load->model('apply_model');
		$this->load->model('index_model');
		$this->load->model('admin_model');
		$this->load->helper('custom_encryption');		
		//$data['role'] = $this->session->userdata('role');
		$this->load->helper('custom_security');	
		$this->load->helper(array('form'));
		# libraries
		$this->load->library('form_validation');
		$this->load->library('user_agent');
       /* $this->load->view('template_config/admin_header');*/
	}


	/*
	*	purpose : to check whether the method is correct or not
	*/
	
	public function _remap($method)
	{
		$class 	= $this->router->class;
		$role = $this->session->userdata('role');
		if( !in_array($role, array('ADM','DASHADM','ADM1')) )
		{
			redirect('logout');
		}
		
		if (in_array(strtolower($method), array_map('strtolower', get_class_methods($this))))
		{
			$uri = $this->uri->segment_array();
			unset($uri[1]);
			unset($uri[2]);
			call_user_func_array(array($this, $method), $uri);
		}
		else
		{
			self::page_not_found();
		}
	}
	public function page_not_found()
	{
		$this->load->view('templates/404.php');
		$this->load->view('templates/admin_footer');
	}
	public function index()
	{
		redirect('admin_controller/dashboard');
		
	}	
	public function template001_pdf() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template001_pdf($order_id, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template001_pdf($order_id, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template001_pdf($order_id, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template001_pdf($order_id, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template001_pdf($order_id, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template001_pdf($order_id, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template001_pdf($order_id, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template001_pdf($order_id, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template001_pdf($order_id, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template001_pdf($order_id, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template001_pdf($order_id, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template001_pdf($order_id, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template001_pdf($order_id, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template001_pdf($order_id, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template001_pdf($order_id, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template001_pdf($app_prog, 'get_applicant_documents');
		
        $data['type'] = "TOP";
                
		$html = $this->load->view('pdf/template001_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        $pdfFilePath = "template001_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        $pdf->AddPage();
        $data['type'] = "BOTTOM";
        $html = $this->load->view('pdf/template001_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html);        
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		$this->load->view('pdf/template001_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
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
        $data['type'] = "TOP";
                
		$html = $this->load->view('pdf/template008_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        
        $pdfFilePath = "template008_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        /*$pdf->AddPage();
        $data['type'] = "BOTTOM";
        $html = $this->load->view('pdf/template008_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html);      */  
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print_008.pdf', 'F');
		//$this->load->view('pdf/template008_pdf');	
		/*$pdf->Output($applicantNumber.".pdf",'I');*/	
		return true;
    } 

	public function template001()
	{
	
		//$result = $this->index_model->institute();
		//$program = $this->session->userdata('admcode');
		$program = $this->session->userdata('admcode');
		$institute = $this->session->userdata('institute_code');
		$institute =  encrypt_decrypt('encrypt', $institute);
		$reg_user_id = $this->session->userdata('reg_user_id');
		
		/*$data = $this->uri->uri_to_assoc();
		$reg_user_id = $data['reg_user_id'];*/
		$program = $program;
		$detail = array($reg_user_id,$program);
					
		
		
		if($institute != '' && $program != '')
		{
			$data = array(
				'institute'=>$institute,
				'program'=>$program
			);
			$temp_rule = Array(
				"&lt",
				"&gt",
				"<",
				">",
				"(",
				"="
			);
			
			if (hasXSS($data,$temp_rule)){
				echo "2";
				echo $institute ; die();
				//redirect('error');
	         
			}
			else
			{
				
				$result = $this->apply_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
						
					$result = $this->apply_model->apply($program,'validate_program');
					//echo $program;die();
					if( $result['status'] == true)
					{
						/*echo $institute."dsad";
						die();*/
						$ins = encrypt_decrypt('decrypt',$institute);
						/*$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
						$this->load->view('template_config/header_index',$institute_list);*/
						
						$data['choice_details_data'] = $this->apply_model->apply(NULL,'get_select_choice_details');
						//print_r($data['choice_details_data'][0]);
						$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
						//$data['course_data'] = $this->apply_model->apply($program,'get_course_detail');
						$data['registration_data'] = $this->apply_model->apply($program,'get_registration_data');
						$data['application_data'] = $this->apply_model->apply($program,'get_application_data');
						$data['applicant_data'] = $this->apply_model->apply($program,'get_applicant_data');
						$data['present_communication_data'] = $this->apply_model->apply($program,'get_present_communication_data');
						
						$data['permanent_communication_data'] = $this->apply_model->apply($program,'get_permanent_communication_data');
						$data['father_data'] = $this->apply_model->apply($program,'get_father_data');
						$data['mother_data'] = $this->apply_model->apply($program,'get_mother_data');
						$data['guardian_data'] = $this->apply_model->apply($program,'get_guardian_data');
						$data['academic_qual_data'] = $this->apply_model->apply($program,'get_academic_qual_data');
						$data['tech_qual_data_5'] = $this->apply_model->apply($program,'get_tech_qual_data_5');
						$data['tech_qual_data_6'] = $this->apply_model->apply($program,'get_tech_qual_data_6');
						$data['tech_qual_data_7'] = $this->apply_model->apply($program,'get_tech_qual_data_7');
						$data['get_research_data'] = $this->apply_model->apply($program,'get_research_data');
						
						
						$data['allNationalities'] = $this->apply_model->apply($program,'get_nationality_data');
						$data['allidproof'] = $this->apply_model->apply($program,'get_id_proof');
						
						$data['allCategories'] = $this->apply_model->apply($program,'get_category_data');
						$data['allReligions'] = $this->apply_model->apply($program,'get_religion_data');
						$data['allMinority'] = $this->apply_model->apply($program,'get_minority_data');
						//print_r($data['allMinority']);
						$data['allDistricts'] = $this->apply_model->apply($program,'get_district_data');
						$data['allStates'] = $this->apply_model->apply($program,'get_state_data');
						$data['documentsReq'] = $this->apply_model->apply($program,'get_documents_required');
						$data['allQualifications'] = $this->apply_model->apply($program,'get_qualification_data');
						$data['allHighestQualifications'] = $this->apply_model->apply($program,'get_highest_qualification');
						$data['select_graduation_course_temp'] = $this->apply_model->apply($detail,'select_graduation_course_temp');
						
						$data['want_program_group'] = $this->apply_model->apply($institute,'want_program_group');
						
						//print_r($data['select_graduation_course_temp']);
						
						//$data['cou'] = $this->apply_model->apply($program,'get_highest_qualification');
						//print_r($data['allQualifications']);
						//$data['allHonoursSubject'] = $this->apply_model->apply($program,'get_honours_subject');
						//$data['program_admit_card_setup'] = $this->apply_model->apply($program,'get_program_admitcard_setup');
						//$data['program_admit_card_detail'] = $this->apply_model->apply($program,'get_program_admitcard_detail');
						/*print_r($this->input->post());
						die();*/
						if( $this->input->post())
						{
							
							$temp_rule = Array(
								"&lt",
								"&gt",
								"<",
								">",
								"="
							);
							if (hasXSS($_POST,$temp_rule)){
								//echo "2";
								$data = array(
					                'status' => 'xsserror',
					                'msg' => 'Special chararacters like <,>,=,(,),&lt;,&gt; are not allowed'
					            );
								$this->session->set_flashdata('error', $data['msg']);
								redirect($this->agent->referrer());
							}
							else
							{
								
								$config = array(
									array(
					                     'field'   => 'txtFirstName',
					                     'label'   => 'First Name',
					                     'rules'   => 'trim|required'
					                  ),
									array(
					                     'field'   => 'txtLastName',
					                     'label'   => 'Middle Name',
					                     'rules'   => 'trim|required'
					                  ),
						        );
								
							}
							$this->form_validation->set_rules($config);
							if ($this->form_validation->run() == FALSE) 
							{
								$data = array(
					                'status' => 'validationerror',
					                'msg' => validation_errors()
					            );
					            $this->session->set_flashdata('error', $data['msg']);
							}
							else
							{			
								$result = $this->superadmin_model->superadmin($_POST,'add_application_data_01');	
								/*echo $result['status'];
								die();	*/
								//print_r($result);die();
								if( $result['status'] == 1 )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('Admin_apply/apply_3/ins/'.$institute);
								}
								else
								{
									$this->session->set_flashdata('error', $result['msg']);
									redirect($this->agent->referrer());
								}						
								
							}
						}
						else
						{						
							if($this->session->userdata('reg_user_id') != '')
							{
								//echo $result['status'] ; 
								//print_r($data);die();	
								$this->load->view('admin/template001',$data);
							}
							else
							{
								redirect('apply/apply_logout');
							}
							
						}
						//$this->load->view('index/pages/footer',$institute_list);
					}
					else
					{
						redirect('apply/apply_logout/ins/'.$institute);
					}
					
				}
				else
				{
					
					redirect('error');
				}
			}
		}
		else
		{
			//echo $institute ; die();
			redirect('error');
		}
		
		//$this->load->model('index_model');
		//$institute_list['institute'] = $this->index_model->index_data('','get_institutes');
		//print_r($institute_list);
		//$this->load->view('index/index',$institute_list);
		//$this->load->view('template_config/footer');
	}
	
	public function template002()
	{
	
		$program = $this->session->userdata('admcode');
		$institute = $this->session->userdata('institute_code');
		$institute =  encrypt_decrypt('encrypt', $institute);
		$reg_user_id = $this->session->userdata('reg_user_id');
		
		/*$data = $this->uri->uri_to_assoc();
		$reg_user_id = $data['reg_user_id'];*/
		$program = $program;
		$detail = array($reg_user_id,$program);
		
		
		if($institute != '' && $program != '')
		{
			$data = array(
				'institute'=>$institute,
				'program'=>$program
			);
			$temp_rule = Array(
				"&lt",
				"&gt",
				"<",
				">",
				"(",
				"="
			);
			
			if (hasXSS($data,$temp_rule)){
				echo "2";
				echo $institute ; die();
				//redirect('error');
	         
			}
			else
			{
				
				
				$result = $this->apply_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
						
					$result = $this->apply_model->apply($program,'validate_program');
					//echo $program;die();
					if( $result['status'] == true)
					{
						/*echo $institute."dsad";
						die();*/
						$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
        				$this->load->view('template_config/admin_header');
						//$this->load->view('template_config/header_apply_index',$institute_list);
						/*$this->load->view('template_config/header_index',$institute_list);*/
						
						$data['choice_details_data'] = $this->apply_model->apply(NULL,'get_select_choice_details');
						//print_r($data['choice_details_data'][0]);
						$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
						//$data['course_data'] = $this->apply_model->apply($program,'get_course_detail');
						$data['registration_data'] = $this->apply_model->apply($program,'get_registration_data');
						$data['application_data'] = $this->apply_model->apply($program,'get_application_data');
						$data['applicant_data'] = $this->apply_model->apply($program,'get_applicant_data');
						$data['present_communication_data'] = $this->apply_model->apply($program,'get_present_communication_data');
						
						$data['permanent_communication_data'] = $this->apply_model->apply($program,'get_permanent_communication_data');
						/*$data['allHomeDistricts'] = $this->apply_model->apply($program,'get_home_district_data');*/
						//$data['get_district_details'] = $this->apply_model->apply($program,'get_district_details');
						$data['father_data'] = $this->apply_model->apply($program,'get_father_data');
						$data['mother_data'] = $this->apply_model->apply($program,'get_mother_data');
						$data['guardian_data'] = $this->apply_model->apply($program,'get_guardian_data');
						$data['academic_qual_data'] = $this->apply_model->apply($program,'get_academic_qual_data');
						$data['tech_qual_data_5'] = $this->apply_model->apply($program,'get_tech_qual_data_5');
						$data['tech_qual_data_6'] = $this->apply_model->apply($program,'get_tech_qual_data_6');
						$data['tech_qual_data_7'] = $this->apply_model->apply($program,'get_tech_qual_data_7');
						$data['get_research_data'] = $this->apply_model->apply($program,'get_research_data');
						
						
						$data['allNationalities'] = $this->apply_model->apply($program,'get_nationality_data');
						$data['allidproof'] = $this->apply_model->apply($program,'get_id_proof');
						
						$data['allCategories'] = $this->apply_model->apply($program,'get_category_data');
						$data['allReligions'] = $this->apply_model->apply($program,'get_religion_data');
						$data['allMinority'] = $this->apply_model->apply($program,'get_minority_data');
						//print_r($data['allMinority']);
						$data['allHomeDistricts'] = $this->apply_model->apply($program,'get_home_district_data');
						$data['allDistricts'] = $this->apply_model->apply($program,'get_district_data');
						$data['allStates'] = $this->apply_model->apply($program,'get_state_data');
						$data['documentsReq'] = $this->apply_model->apply($program,'get_documents_required');
						$data['allQualifications'] = $this->apply_model->apply($program,'get_qualification_data');
						$data['allHighestQualifications'] = $this->apply_model->apply($program,'get_highest_qualification');
						$data['select_graduation_course_temp'] = $this->apply_model->apply($detail,'select_graduation_course_temp');
						$data['select_exam_centre'] = $this->apply_model->apply($program,'select_exam_centre');
						/*print_r($data['get_select_choice_details']);
						die();*/
						$data['want_program_group'] = $this->apply_model->apply($institute,'want_program_group');
						
						$data['examcentercheck'] = $this->apply_model->apply($program,'get_examcentercheck_data');
						$data['SRSECDEGREE'] = $this->apply_model->apply($program,'get_SRSEC_degree_data');
						$data['GRADUTIONDEGREE'] = $this->apply_model->apply($program,'get_GRADUTION_degree_data');
						$data['PGDEGREE'] = $this->apply_model->apply($program,'get_PG_degree_data');
						
						$data['SRSECCOURSE'] = $this->apply_model->apply($program,'get_SRSEC_COURSE_data');
						$data['GRADUTIONCOURSE'] = $this->apply_model->apply($program,'get_GRADUTION_COURSE_data');
						$data['PGCOURSE'] = $this->apply_model->apply($program,'get_PG_COURSE_data');
						$data['DECLARATION'] = $this->apply_model->apply($program,'get_DECLARATION_data');
						$data['program_experience'] = $this->apply_model->apply($program,'get_program_experience');
						
						$data['applicant_experience'] = $this->apply_model->apply($program,'get_program_applicant_experience');
						$data['post_detail'] = $this->apply_model->apply($program,'get_post');
						$data['total_experience_data'] = $this->apply_model->apply($program,'total_experience_data');
						
						//print_r($data['select_graduation_course_temp']);
						
						//$data['cou'] = $this->apply_model->apply($program,'get_highest_qualification');
						//print_r($data['allQualifications']);
						//$data['allHonoursSubject'] = $this->apply_model->apply($program,'get_honours_subject');
						//$data['program_admit_card_setup'] = $this->apply_model->apply($program,'get_program_admitcard_setup');
						//$data['program_admit_card_detail'] = $this->apply_model->apply($program,'get_program_admitcard_detail');
						/*print_r($this->input->post());
						die();*/
						if( $this->input->post())
						{
							
							$temp_rule = Array(
								"&lt",
								"&gt",
								"<",
								">",
								"="
							);
							if (hasXSS($_POST,$temp_rule)){
								//echo "2";
								$data = array(
					                'status' => 'xsserror',
					                'msg' => 'Special chararacters like <,>,=,(,),&lt;,&gt; are not allowed'
					            );
								$this->session->set_flashdata('error', $data['msg']);
								redirect($this->agent->referrer());
							}
							else
							{
								
								$config = array(
									array(
					                     'field'   => 'txtFirstName',
					                     'label'   => 'First Name',
					                     'rules'   => 'trim|required'
					                  ),
									array(
					                     'field'   => 'txtLastName',
					                     'label'   => 'Middle Name',
					                     'rules'   => 'trim|required'
					                  ),
						        );
								
							}
							$this->form_validation->set_rules($config);
							if ($this->form_validation->run() == FALSE) 
							{
								$data = array(
					                'status' => 'validationerror',
					                'msg' => validation_errors()
					            );
					            $this->session->set_flashdata('error', $data['msg']);
							}
							else
							{					
								$result = $this->admin_model->admin($_POST,'add_application_data_02');		
								/*echo $result['status'];
								die();	*/
								//print_r($result);die();
								if( $result['status'] == 1 )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('Admin_apply/apply_3/ins/'.$institute);
								}
								else
								{
									$this->session->set_flashdata('error', $result['msg']);
									redirect($this->agent->referrer());
								}						
								
							}
						}
						else
						{						
							if($this->session->userdata('reg_user_id') != '')
							{
								//echo $result['status'] ; 
								//print_r($data);die();	
								$this->load->view('admin/template002',$data);
							}
							else
							{
								redirect('apply/apply_logout');
							}
							
						}
						$this->load->view('index/pages/footer',$institute_list);
					}
					else
					{
						redirect('apply/apply_logout/ins/'.$institute);
					}
					
				}
				else
				{
					
					redirect('error');
				}
			}
		}
		else
		{
			//echo $institute ; die();
			redirect('error');
		}
		
		//$this->load->model('index_model');
		//$institute_list['institute'] = $this->index_model->index_data('','get_institutes');
		//print_r($institute_list);
		//$this->load->view('index/index',$institute_list);
		//$this->load->view('template_config/footer');
	}
	
	public function template004()
	{
	
		$program = $this->session->userdata('admcode');
		$institute = $this->session->userdata('institute_code');
		$institute =  encrypt_decrypt('encrypt', $institute);
		$reg_user_id = $this->session->userdata('reg_user_id');
		
		/*$data = $this->uri->uri_to_assoc();
		$reg_user_id = $data['reg_user_id'];*/
		$program = $program;
		$detail = array($reg_user_id,$program);
		
		
		if($institute != '' && $program != '')
		{
			$data = array(
				'institute'=>$institute,
				'program'=>$program
			);
			$temp_rule = Array(
				"&lt",
				"&gt",
				"<",
				">",
				"(",
				"="
			);
			
			if (hasXSS($data,$temp_rule)){
				echo "2";
				echo $institute ; die();
				//redirect('error');
	         
			}
			else
			{
				
				
				$result = $this->apply_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
						
					$result = $this->apply_model->apply($program,'validate_program');
					//echo $program;die();
					if( $result['status'] == true)
					{
						/*echo $institute."dsad";
						die();*/
						$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
        				$this->load->view('template_config/admin_header');
						//$this->load->view('template_config/header_apply_index',$institute_list);
						/*$this->load->view('template_config/header_index',$institute_list);*/
						
						$data['choice_details_data'] = $this->apply_model->apply(NULL,'get_select_choice_details');
						//print_r($data['choice_details_data'][0]);
						$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
						//$data['course_data'] = $this->apply_model->apply($program,'get_course_detail');
						$data['registration_data'] = $this->apply_model->apply($program,'get_registration_data');
						$data['application_data'] = $this->apply_model->apply($program,'get_application_data');
						$data['applicant_data'] = $this->apply_model->apply($program,'get_applicant_data');
						$data['present_communication_data'] = $this->apply_model->apply($program,'get_present_communication_data');
						
						$data['permanent_communication_data'] = $this->apply_model->apply($program,'get_permanent_communication_data');
						/*$data['allHomeDistricts'] = $this->apply_model->apply($program,'get_home_district_data');*/
						//$data['get_district_details'] = $this->apply_model->apply($program,'get_district_details');
						$data['father_data'] = $this->apply_model->apply($program,'get_father_data');
						$data['mother_data'] = $this->apply_model->apply($program,'get_mother_data');
						$data['guardian_data'] = $this->apply_model->apply($program,'get_guardian_data');
						$data['academic_qual_data'] = $this->apply_model->apply($program,'get_academic_qual_data');
						$data['tech_qual_data_5'] = $this->apply_model->apply($program,'get_tech_qual_data_5');
						$data['tech_qual_data_6'] = $this->apply_model->apply($program,'get_tech_qual_data_6');
						$data['tech_qual_data_7'] = $this->apply_model->apply($program,'get_tech_qual_data_7');
						$data['get_research_data'] = $this->apply_model->apply($program,'get_research_data');
						
						
						$data['allNationalities'] = $this->apply_model->apply($program,'get_nationality_data');
						$data['allidproof'] = $this->apply_model->apply($program,'get_id_proof');
						
						$data['allCategories'] = $this->apply_model->apply($program,'get_category_data');
						$data['allReligions'] = $this->apply_model->apply($program,'get_religion_data');
						$data['allMinority'] = $this->apply_model->apply($program,'get_minority_data');
						$data['allDCoffice'] = $this->apply_model->apply($program,'get_dc_data');
						//print_r($data['allMinority']);
						$data['allHomeDistricts'] = $this->apply_model->apply($program,'get_home_district_data');
						$data['allDistricts'] = $this->apply_model->apply($program,'get_district_data');
						$data['allStates'] = $this->apply_model->apply($program,'get_state_data');
						$data['documentsReq'] = $this->apply_model->apply($program,'get_documents_required');
						$data['allQualifications'] = $this->apply_model->apply($program,'get_qualification_data');
						$data['allHighestQualifications'] = $this->apply_model->apply($program,'get_highest_qualification');
						$data['select_graduation_course_temp'] = $this->apply_model->apply($detail,'select_graduation_course_temp');
						$data['select_exam_centre'] = $this->apply_model->apply($program,'select_exam_centre');
						/*print_r($data['get_select_choice_details']);
						die();*/
						$data['want_program_group'] = $this->apply_model->apply($institute,'want_program_group');
						
						//print_r($data['select_graduation_course_temp']);
						
						//$data['cou'] = $this->apply_model->apply($program,'get_highest_qualification');
						//print_r($data['allQualifications']);
						//$data['allHonoursSubject'] = $this->apply_model->apply($program,'get_honours_subject');
						//$data['program_admit_card_setup'] = $this->apply_model->apply($program,'get_program_admitcard_setup');
						//$data['program_admit_card_detail'] = $this->apply_model->apply($program,'get_program_admitcard_detail');
						/*print_r($this->input->post());
						die();*/
						if( $this->input->post())
						{
							
							$temp_rule = Array(
								"&lt",
								"&gt",
								"<",
								">",
								"="
							);
							if (hasXSS($_POST,$temp_rule)){
								//echo "2";
								$data = array(
					                'status' => 'xsserror',
					                'msg' => 'Special chararacters like <,>,=,(,),&lt;,&gt; are not allowed'
					            );
								$this->session->set_flashdata('error', $data['msg']);
								redirect($this->agent->referrer());
							}
							else
							{
								
								$config = array(
									array(
					                     'field'   => 'txtFirstName',
					                     'label'   => 'First Name',
					                     'rules'   => 'trim|required'
					                  ),
									array(
					                     'field'   => 'txtLastName',
					                     'label'   => 'Middle Name',
					                     'rules'   => 'trim|required'
					                  ),
						        );
								
							}
							$this->form_validation->set_rules($config);
							if ($this->form_validation->run() == FALSE) 
							{
								$data = array(
					                'status' => 'validationerror',
					                'msg' => validation_errors()
					            );
					            $this->session->set_flashdata('error', $data['msg']);
							}
							else
							{					
								$result = $this->admin_model->admin($_POST,'add_application_data_02');		
								/*echo $result['status'];
								die();	*/
								//print_r($result);die();
								if( $result['status'] == 1 )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('Admin_apply/apply_3/ins/'.$institute);
								}
								else
								{
									$this->session->set_flashdata('error', $result['msg']);
									redirect($this->agent->referrer());
								}						
								
							}
						}
						else
						{						
							if($this->session->userdata('reg_user_id') != '')
							{
								//echo $result['status'] ; 
								//print_r($data);die();	
								$this->load->view('admin/template004',$data);
							}
							else
							{
								redirect('apply/apply_logout');
							}
							
						}
						$this->load->view('index/pages/footer',$institute_list);
					}
					else
					{
						redirect('apply/apply_logout/ins/'.$institute);
					}
					
				}
				else
				{
					
					redirect('error');
				}
			}
		}
		else
		{
			//echo $institute ; die();
			redirect('error');
		}
		
		//$this->load->model('index_model');
		//$institute_list['institute'] = $this->index_model->index_data('','get_institutes');
		//print_r($institute_list);
		//$this->load->view('index/index',$institute_list);
		//$this->load->view('template_config/footer');
	}
	
	public function template008()
	{
	
		//$result = $this->index_model->institute();
		$program = $this->session->userdata('admcode');
		$institute = $this->session->userdata('institute_code');
		$data = $this->uri->uri_to_assoc();
		$reg_user_id = $data['reg_user_id'];
		$program = $program;
		$detail = array($reg_user_id,$program);
		
		if($institute != '' && $program != '')
		{
			$data = array(
				'institute'=>$institute,
				'program'=>$program
			);
			$temp_rule = Array(
				"&lt",
				"&gt",
				"<",
				">",
				"(",
				"="
			);
			
			
			if (hasXSS($data,$temp_rule)){
				
				echo "2";
				//redirect('error');
	         
			}
			else
			{
				
				$result = $this->superadmin_model->superadmin($institute,'validate_institute');
				
				if( $result['status'] == 1)
				{
					
					$result = $this->superadmin_model->superadmin($program,'validate_program');
					
					if( $result['status'] == 1 )
					{
						//$this->load->view('template_config/header');
						
					    $data['institute_data'] = $this->admin_model->admin($institute,'get_institute_data');
						$data['program_data'] = $this->superadmin_model->superadmin($program,'get_program_detail');
						$data['registration_data'] = $this->superadmin_model->superadmin($program,'get_registration_data');
						$data['application_data'] = $this->superadmin_model->superadmin($program,'get_application_data');
						$data['applicant_data'] = $this->superadmin_model->superadmin($program,'get_applicant_data');
						$data['present_communication_data'] = $this->superadmin_model->superadmin($program,'get_present_communication_data');
						$data['permanent_communication_data'] = $this->superadmin_model->superadmin($program,'get_permanent_communication_data');
						$data['father_data'] = $this->superadmin_model->superadmin($program,'get_father_data');
						$data['mother_data'] = $this->superadmin_model->superadmin($program,'get_mother_data');
						$data['guardian_data'] = $this->superadmin_model->superadmin($program,'get_guardian_data');
						$data['academic_qual_data'] = $this->superadmin_model->superadmin($program,'get_academic_qual_data');
						$data['allNationalities'] = $this->superadmin_model->superadmin($program,'get_nationality_data');
						$data['allCategories'] = $this->superadmin_model->superadmin($program,'get_category_data');
						$data['allReligions'] = $this->superadmin_model->superadmin($program,'get_religion_data');
						$data['allDistricts'] = $this->superadmin_model->superadmin($program,'get_district_data');
						$data['allStates'] = $this->superadmin_model->superadmin($program,'get_state_data');
						$data['documentsReq'] = $this->superadmin_model->superadmin($program,'get_documents_required');
						$data['allQualifications'] = $this->superadmin_model->superadmin($program,'get_qualification_data');
						$data['allHighestQualifications'] = $this->superadmin_model->superadmin($program,'get_highest_qualification');
						$data['course_data'] = $this->superadmin_model->superadmin($program,'get_course_detail');
						$data['select_graduation_course_temp'] = $this->apply_model->apply($detail,'select_graduation_course_temp');
						
						//$data['allHonoursSubject'] = $this->superadmin_model->superadmin($program,'get_honours_subject');
						//$data['program_admit_card_setup'] = $this->superadmin_model->superadmin($program,'get_program_admitcard_setup');
						//$data['program_admit_card_detail'] = $this->superadmin_model->superadmin($program,'get_program_admitcard_detail');
						//print_r($this->input->post());
						//die();
						
						if( $this->input->post())
						{
							//print_r("hiiiiiiiii");
							$temp_rule = Array(
								"&lt",
								"&gt",
								"<",
								">",
								"="
							);
							if (hasXSS($_POST,$temp_rule)){
								//echo "2";
								$data = array(
					                'status' => 'xsserror',
					                'msg' => 'Special chararacters like <,>,=,(,),&lt;,&gt; are not allowed'
					            );
								$this->session->set_flashdata('error', $data['msg']);
								redirect($this->agent->referrer());
							}
							else
							{
								//echo "2";
								$config = array(
									array(
					                     'field'   => 'txtFirstName',
					                     'label'   => 'First Name',
					                     'rules'   => 'trim|required'
					                  ),
									array(
					                     'field'   => 'txtLastName',
					                     'label'   => 'Last Name',
					                     'rules'   => 'trim|required'
					                  )
						        );
								
							}
							$this->form_validation->set_rules($config);
							if ($this->form_validation->run() == FALSE) 
							{
								$data = array(
					                'status' => 'validationerror',
					                'msg' => validation_errors()
					            );
					            $this->session->set_flashdata('error', $data['msg']);
								//redirect($this->agent->referrer());
							}
							else
							{
								//echo "hiiiiii";
								$result = $this->superadmin_model->superadmin($_POST,'add_application_data_temp008');
								
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									//echo "hi";
									redirect('Admin_apply/apply_3/ins/'.$institute);
								}
								else
								{
									$this->session->set_flashdata('error', $result['msg']);
									//redirect($this->agent->referrer());
								}
								
								
							}
						}
						else
						{			
							if($this->session->userdata('reg_user_id') != '')
							{
								$this->load->view('admin/template008',$data);
							}
							else
							{
								redirect('apply/apply_logout');
							}
							
						}
						$this->load->view('template_config/footer');
					}
					else
					{
						redirect('apply/apply_logout/ins/'.$institute);
					}
					
				}
				else
				{
					redirect('error');
				}
			}
		}
		else
		{
			redirect('error');
		}
		
		//$this->load->model('index_model');
		//$institute_list['institute'] = $this->index_model->index_data('','get_institutes');
		//print_r($institute_list);
		//$this->load->view('index/index',$institute_list);
		//$this->load->view('template_config/footer');
	}
	public function apply_3()
	{
		//$result = $this->index_model->institute();
		$program = $this->session->userdata('admcode');
		$data = $this->uri->uri_to_assoc();
		$institute = $data['ins'];
	
		if($institute != '' && $program != '')
		{
			$data = array(
				'institute'=>$institute,
				'program'=>$program
			);
			$temp_rule = Array(
				"&lt",
				"&gt",
				"<",
				">",
				"(",
				"="
			);
			
			if (hasXSS($data,$temp_rule)){
				//echo "2";
				redirect('error');
	         
			}
			else
			{
		
		/*echo $institute;
		die();*/
				$institute =  encrypt_decrypt('decrypt', $institute);
				$result = $this->superadmin_model->superadmin($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
					$result = $this->superadmin_model->superadmin($program,'validate_program');
					if( $result['status'] )
					{
						
        				$this->load->view('template_config/admin_header');
						//$this->load->view('template_config/header');
						/*$data['institute_data'] = $this->admin_model->admin($institute,'get_institute_data');
						$data['program_data'] = $this->superadmin_model->superadmin($program,'get_program_detail');
						$data['document_data'] = $this->superadmin_model->superadmin($program,'get_document_data');
						$data['appl_status'] = $this->superadmin_model->superadmin($program,'get_appl_status');
						$data['doc_path'] = $this->superadmin_model->superadmin($program,'get_doc_path');*/
						
						
						$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
						$data['document_data'] = $this->apply_model->apply('','get_document_data');
						$data['appl_status'] = $this->apply_model->apply($institute,'get_appl_status');
						$data['doc_path'] = $this->apply_model->apply($program,'get_doc_path');
						
						if( $this->input->post())
						{
							$temp_rule = Array(
								"&lt",
								"&gt",
								"<",
								">",
								"(",
								"="
							);
							if (hasXSS($_POST,$temp_rule)){
								//echo "2";
								$data = array(
					                'status' => 'xsserror',
					                'msg' => 'Special chararacters like <,>,=,(,),&lt;,&gt; are not allowed'
					            );
								$this->session->set_flashdata('error', $data['msg']);
								redirect($this->agent->referrer());
							}
							else
							{
								//$result = $this->apply_model->apply($_POST,'add_document_data');
								$result = $this->superadmin_model->superadmin($_POST,'add_document_data_apply3');
								if( $result['status'] )
								{
									//$this->session->set_flashdata('info', $result['msg']);
									redirect('Admin_apply/apply_4/ins/'.$institute);
								}
								else
								{
									$this->session->set_flashdata('error', $result['msg']);
									redirect($this->agent->referrer());
								}
							}
						}
						else
						{							
							if($this->session->userdata('reg_user_id') != '')
							{
								$this->load->view('admin/apply_3',$data);
							}
							else
							{
								redirect('apply/apply_logout/ins/'.$institute);
							}
						}
						$this->load->view('template_config/footer');
					}
					else
					{
						redirect('apply/apply_logout/ins/'.$institute);
					}
				}
				else
				{
					redirect('error');
				}
			}
		}
		else
		{
			show_404();
		}
		
		//$this->load->model('index_model');
		//$institute_list['institute'] = $this->index_model->index_data('','get_institutes');
		//print_r($institute_list);
		//$this->load->view('index/index',$institute_list);
		//$this->load->view('template_config/footer');
	}
	
	public function apply_4()
	{
		$program = $this->session->userdata('admcode');
		//$institute = $this->session->userdata('institute_code');
		//$data = $this->uri->uri_to_assoc();
		$institute = $this->session->userdata('institute_code');
		//$institute = $data['ins'];
		if($institute != '' && $program != '')
		{
			
			$data = array(
				'institute'=>$institute,
				'program'=>$program
			);
			$temp_rule = Array(
				"&lt",
				"&gt",
				"<",
				">",
				"(",
				"="
			);
			
			if (hasXSS($data,$temp_rule)){
				redirect('error');
			}
			else
			{
				
				$result = $this->superadmin_model->superadmin($institute,'validate_institute');
				if( $result['status'] )
				{
					
					$result = $this->superadmin_model->superadmin($program,'validate_program');
					if( $result['status'] )
					{
						
        				$this->load->view('template_config/admin_header');
						
						//$this->load->view('template_config/header');
						$data['institute_data'] = $this->admin_model->admin($institute,'get_institute_data');
						//$data['program_data'] = $this->superadmin_model->superadmin($program,'get_program_detail');
						$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
						$data['document_data'] = $this->superadmin_model->superadmin($program,'get_document_data');
						//$data['appl_status'] = $this->superadmin_model->superadmin($program,'get_appl_status');
						$data['appl_status'] = $this->apply_model->apply($program,'get_appl_status');
						$data['doc_path'] = $this->superadmin_model->superadmin($program,'get_doc_path');
						$data['regdata'] = $this->superadmin_model->superadmin($program,'get_reg_id');
						$data['paymodedata'] = $this->superadmin_model->superadmin($program,'payModeQuery');
						$data['tempcodedata'] = $this->superadmin_model->superadmin($program,'tempcode');
						$data['categorydt'] = $this->superadmin_model->superadmin($program,'categorydata');
						$data['amount'] = $this->superadmin_model->superadmin($program,'amount');
						$data['updatereg'] = $this->superadmin_model->superadmin($program,'update_reg_mode');
						$data['bankdata'] = $this->superadmin_model->superadmin($program,'bank_detail');
						$data['passstatus'] = $this->superadmin_model->superadmin($program,'pass_status');
						$data['challanData'] = $this->superadmin_model->superadmin($program,'get_challanData');
						$data['depositmode'] = $this->superadmin_model->superadmin($program,'deposit');
						$data['challandetails'] = $this->apply_model->apply($program,'get_challandetails');
						
						$data['extra_amount_arr'] = $this->apply_model->apply($program,'extra_amount');
						$data['amount_arr'] = $this->apply_model->apply($program,'amount');
						$data['registration_data'] = $this->apply_model->apply($program,'get_registration_data');
						$data['application_data'] = $this->apply_model->apply($program,'get_application_data');
						$data['applicant_data'] = $this->apply_model->apply($program,'get_applicant_data');
						$data['present_communication_data'] = $this->apply_model->apply($program,'get_present_communication_data');
						$data['permanent_communication_data'] = $this->apply_model->apply($program,'get_permanent_communication_data');
						$data['father_data'] = $this->apply_model->apply($program,'get_father_data');
						$data['mother_data'] = $this->apply_model->apply($program,'get_mother_data');
						$data['guardian_data'] = $this->apply_model->apply($program,'get_guardian_data');
						$data['academic_qual_data'] = $this->apply_model->apply($program,'get_academic_qual_data');
						$data['tech_qual_data_5'] = $this->apply_model->apply($program,'get_tech_qual_data_5');
						$data['tech_qual_data_6'] = $this->apply_model->apply($program,'get_tech_qual_data_6');
						$data['tech_qual_data_7'] = $this->apply_model->apply($program,'get_tech_qual_data_7');
						$data['get_research_data'] = $this->apply_model->apply($program,'get_research_data');
						
						if($this->input->post())
						{
							//print_r($_POST);die;
							$temp_rule = Array(
								"&lt",
								"&gt",
								"<",
								">",
								"(",
								"="
							);
							if (hasXSS($_POST,$temp_rule)){
								$data = array(
					                'status' => 'xsserror',
					                'msg' => 'Special chararacters like <,>,=,(,),&lt;,&gt; are not allowed'
					            );
								$this->session->set_flashdata('error', $data['msg']);
								redirect($this->agent->referrer());
							}
							else
							{
								$result = $this->superadmin_model->superadmin($_POST,'add_payment_data_apply4');
								//$result = $this->apply_model->apply($_POST,'Bank_challan_submit');
								/*echo $result['status'];
								die();*/
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('Admin_apply/apply_4');
								}
								else
								{
									$this->session->set_flashdata('error', $result['msg']);
									redirect($this->agent->referrer());
								}
							}
						}
						else
						{							
							if($this->session->userdata('reg_user_id') != '')
							{
								$this->load->view('admin/apply_4',$data);
							}
							else
							{
								redirect('apply/apply_logout/ins/'.$institute);
							}
						}
						$this->load->view('template_config/footer');
					}
					else
					{
						redirect('apply/apply_logout/ins/'.$institute);
					}
					
				}
				else
				{
					redirect('error');
				}
			}
		}
		else
		{
			show_404();
		}
	}
	
	public function template014()
	{
	
		//$result = $this->index_model->institute();
		$program = $this->session->userdata('admcode');
		$institute = $this->session->userdata('institute_code');
		
		//echo $institute ; die();
		
		if($institute != '' && $program != '')
		{
			$data = array(
				'institute'=>$institute,
				'program'=>$program
			);
			$temp_rule = Array(
				"&lt",
				"&gt",
				"<",
				">",
				"(",
				"="
			);
			
			if (hasXSS($data,$temp_rule)){
				//echo "2";
				//echo $institute ; die();
				redirect('error');
	         
			}
			else
			{
				
				$result = $this->superadmin_model->superadmin($institute,'validate_institute');
				
				if( $result['status'] == 1)
				{
					
					$result = $this->superadmin_model->superadmin($program,'validate_program');
					
					if( $result['status'] == 1 )
					{
						//$this->load->view('template_config/header_index');
						
						$data['institute_data'] = $this->admin_model->admin($institute,'get_institute_data');
						$data['program_data'] = $this->superadmin_model->superadmin($program,'get_program_detail');
						$data['registration_data'] = $this->superadmin_model->superadmin($program,'get_registration_data');
						$data['application_data'] = $this->superadmin_model->superadmin($program,'get_application_data');
						$data['applicant_data'] = $this->superadmin_model->superadmin($program,'get_applicant_data');
						$data['present_communication_data'] = $this->superadmin_model->superadmin($program,'get_present_communication_data');
						$data['permanent_communication_data'] = $this->superadmin_model->superadmin($program,'get_permanent_communication_data');
						$data['father_data'] = $this->superadmin_model->superadmin($program,'get_father_data');
						$data['mother_data'] = $this->superadmin_model->superadmin($program,'get_mother_data');
						$data['guardian_data'] = $this->superadmin_model->superadmin($program,'get_guardian_data');
						$data['academic_qual_data'] = $this->superadmin_model->superadmin($program,'get_academic_qual_data');
						$data['allNationalities'] = $this->superadmin_model->superadmin($program,'get_nationality_data');
						$data['allCategories'] = $this->superadmin_model->superadmin($program,'get_category_data');
						$data['allReligions'] = $this->superadmin_model->superadmin($program,'get_religion_data');
						$data['allDistricts'] = $this->superadmin_model->superadmin($program,'get_district_data');
						$data['allStates'] = $this->superadmin_model->superadmin($program,'get_state_data');
						$data['documentsReq'] = $this->superadmin_model->superadmin($program,'get_documents_required');
						$data['allQualifications'] = $this->superadmin_model->superadmin($program,'get_qualification_data');
						$data['allHighestQualifications'] = $this->superadmin_model->superadmin($program,'get_highest_qualification');
						$data['course_data'] = $this->superadmin_model->superadmin($program,'get_course_detail');
						//print_r($this->input->post());
						if( $this->input->post())
						{
							
							$temp_rule = Array(
								"&lt",
								"&gt",
								"<",
								">",
								"="
							);
							if (hasXSS($_POST,$temp_rule)){
								//echo "2";
								$data = array(
					                'status' => 'xsserror',
					                'msg' => 'Special chararacters like <,>,=,(,),&lt;,&gt; are not allowed'
					            );
								$this->session->set_flashdata('error', $data['msg']);
								redirect($this->agent->referrer());
							}
							else
							{
								
								
								$config = array(
									array(
					                     'field'   => 'txtFirstName',
					                     'label'   => 'First Name',
					                     'rules'   => 'trim|required'
					                  ),
									array(
					                     'field'   => 'txtLastName',
					                     'label'   => 'Middle Name',
					                     'rules'   => 'trim|required'
					                  ),
									/*array(
					                     'field'   => 'radiogender',
					                     'label'   => 'Gender',
					                     'rules'   => 'trim|required'
					                  ),
									array(
					                     'field'   => 'cmbNationality',
					                     'label'   => 'Nationality',
					                     'rules'   => 'trim|required'
					                  ),
									
									array(
					                     'field'   => 'radiomaritalstatus',
					                     'label'   => 'Marital Status',
					                     'rules'   => 'trim|required'
					                  ) ,
									array(
					                     'field'   => 'txtFatherName',
					                     'label'   => 'Father Name',
					                     'rules'   => 'trim|required'
					                  ) ,
									array(
					                     'field'   => 'txtMotherName',
					                     'label'   => 'Mother Name',
					                     'rules'   => 'trim|required'
					                  ) ,
									array(
					                     'field'   => 'txtPresentAddress',
					                     'label'   => 'Present Address',
					                     'rules'   => 'trim|required'
					                  ) ,
									array(
					                     'field'   => 'txtPresentLocality',
					                     'label'   => 'Locality',
					                     'rules'   => 'trim|required'
					                  ) ,
									array(
					                     'field'   => 'txtPresentPost',
					                     'label'   => 'Post office',
					                     'rules'   => 'trim|required'
					                  ) ,
									array(
					                     'field'   => 'cmbPresentDist',
					                     'label'   => 'District',
					                     'rules'   => 'trim|required'
					                  ) ,
									array(
					                     'field'   => 'cmbPresentState',
					                     'label'   => 'Present State',
					                     'rules'   => 'trim|required'
					                  ) ,
									array(
					                     'field'   => 'txtPresentPin',
					                     'label'   => 'PIN',
					                     'rules'   => 'trim|required'
					                  ) */
									
									
						        );
								
							}
							$this->form_validation->set_rules($config);
							if ($this->form_validation->run() == FALSE) 
							{
								$data = array(
					                'status' => 'validationerror',
					                'msg' => validation_errors()
					            );
					            $this->session->set_flashdata('error', $data['msg']);
							}
							else
							{								
								$result = $this->superadmin_model->superadmin($_POST,'add_application_data_014');
								//print_r($result);die();
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('Admin_apply/apply_3/ins/'.$institute);
								}
								else
								{
									$this->session->set_flashdata('error', $result['msg']);
									//redirect($this->agent->referrer());
								}						
								
							}
						}
						else
						{							
							if($this->session->userdata('reg_user_id') != '')
							{
								
								$this->load->view('admin/template014',$data);
							}
							else
							{
								redirect('apply/apply_logout');
							}
							
						}
						$this->load->view('index/pages/footer');
					}
					else
					{
						redirect('apply/apply_logout/ins/'.$institute);
					}
					
				}
				else
				{
					
					redirect('error');
				}
			}
		}
		else
		{
			//echo $institute ; die();
			redirect('error');
		}
		
		//$this->load->model('index_model');
		//$institute_list['institute'] = $this->index_model->index_data('','get_institutes');
		//print_r($institute_list);
		//$this->load->view('index/index',$institute_list);
		//$this->load->view('template_config/footer');
	}
	public function template014_pdf() {
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
        $data['applicant_documents'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_applicant_documents');
        $data['type'] = "TOP";
                
		$html = $this->load->view('pdf/template008_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        $pdfFilePath = "template008_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        $pdf->AddPage();
        $data['type'] = "BOTTOM";
        $html = $this->load->view('pdf/template008_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html);        
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print_008.pdf', 'F');
		$this->load->view('pdf/template008_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
	
}
