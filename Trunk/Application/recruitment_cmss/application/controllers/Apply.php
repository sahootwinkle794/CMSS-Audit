<?php defined('BASEPATH') OR exit('No direct script access allowed');

class apply extends CI_Controller
{
	private $role;
	
	public function __construct() 
	{
		parent::__construct();
		// Clickjacking Attack
		$this->output->set_header('X-FRAME-OPTIONS: DENY'); 
		('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		
		# helpers
		$this->load->helper(array('form'));		
		$this->load->helper('custom_encryption');		
		$this->load->helper('custom_security');		
		//$this->load->helper('custom_captcha');	
		$this->load->helper('captcha');	
		
		# libraries
		$this->load->library('form_validation');
		$this->load->library('user_agent');
		
		
		$this->role = $this->session->userdata('role');
		//$this->load->library('../controllers/Mpdf_controller');
		# models
		$this->load->model('apply_model');
		$this->load->model('m_pdf_model');
		//$this->load->model('admin_model');
		//$this->load->model('getter_model');
		
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		$this->load->model('index_model');
		
		
   	}
   	/*
	*	purpose : to check whether the method is correct or not
	*/
	
	public function _remap($method)
	{
		//echo $method;
		$class 	= $this->router->class;
		//$role = $this->session->userdata('role');
		if(!$this->session->userdata('user_code'))
		{
			$check_user = $this->apply_model->apply('','get_user_check');//echo $this->session->userdata('reg_user_id');die();
			if( !$this->session->userdata('reg_user_id') || !$check_user)
			{
				//echo 1;die;
				redirect('user_logout');
			}
		}
		
		if( !$this->session->userdata('reg_user_id'))
		{
			//echo 2;die;
			redirect('user_logout');
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
	/*
	*	purpose : Handle page not found
	*/
	public function page_not_found()
	{
		$this->load->view('templates/404.php');
		$this->load->view('templates/admin_footer');
	}
	
	/**
	*	purpose : Entry point of user controller
	*/
	public function index()
	{
		//$result = $this->index_model->institute();
		$this->load->model('index_model');
		//$institute_list['institute'] = $this->index_model->index_data('','get_institutes');
		//$this->load->view('index/index',$institute_list);
		$this->load->view('template_config/footer');
	}
	public function institute_page()
	{
		//$result = $this->index_model->institute();
		$data = $this->uri->uri_to_assoc();
		$institute = $data['ins'];
		
		
		if($institute != '')
		{
			$data = array(
				'institute'=>$institute
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
				$result = $this->apply_model->apply($institute,'validate_institute');
				if( $result['status'] )
				{
					$ins = encrypt_decrypt('decrypt',$institute);
					$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
					$institute_list['faq_data'] = $this->index_model->index_data($ins,'get_faq_data'); 
					$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
					$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
					$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
					$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
					$institute_list['header'] = '';
					
					$institute_list['profile'] = $this->apply_model->apply($institute,'get_profile_details'); 
					$institute_list['main_menu'] = $this->index_model->index_data($institute,'get_menu'); 
					$this->load->view('template_config/header_home',$institute_list);
					$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
					$data['program_group_data'] = $this->apply_model->apply($institute,'get_program_group_status');
					$data['admit_card_data'] = $this->apply_model->apply($institute,'get_admit_card_data');
					$data['program_data'] = $this->apply_model->apply($institute,'get_program_with_rank_data');
					$data['advertise_data'] = $this->apply_model->apply($institute,'get_advertise_data');
					
					$data['old_post_applied'] = $this->apply_model->apply($institute,'get_old_post_applied');
					$data['course_data'] = $this->apply_model->apply($institute,'get_course_data');
					$data['program_wise_status'] = $this->apply_model->apply($institute,'get_program_wise_status');
					 
					
					/*print_r($data['reeval_status']); die();*/
					
				/*	$this->load->view('template_config/header_applicant',$institute_list);*/
					$this->load->view('apply/institute_page',$data);
					//$this->load->view('index/pages/footer_index',$institute_list);
					$this->load->view('index/pages/footer',$institute_list);
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
	public function institute_page1()
	{
		//$result = $this->index_model->institute();
		$data = $this->uri->uri_to_assoc();
		$institute = $data['ins'];
		
		
		if($institute != '')
		{
			$data = array(
				'institute'=>$institute
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
				$result = $this->apply_model->apply($institute,'validate_institute');
				if( $result['status'] )
				{
					$ins = encrypt_decrypt('decrypt',$institute);
					$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
					$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
					$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
					
					$institute_list['header'] = '';
					
					$institute_list['profile'] = $this->apply_model->apply($institute,'get_profile_details'); 
					$institute_list['main_menu'] = $this->index_model->index_data($institute,'get_menu'); 
					$this->load->view('template_config/header_home',$institute_list);
					$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
					$data['program_group_data'] = $this->apply_model->apply($institute,'get_program_group');
					$data['program_data'] = $this->apply_model->apply($institute,'get_program_with_rank_data');
					
					
					//print_r($data); die();
					
					$this->load->view('apply/institute_page1',$data);
					$this->load->view('index/pages/footer_index',$institute_list);
				}
				else
				{
					//echo "3";
					redirect('error');
				}
			}
		}
		else
		{
			show_404();
		}
		
		 
	}
	public function project_index()
	{
		//$result = $this->index_model->institute();
		$data = $this->uri->uri_to_assoc();
		$institute = $data['ins'];
		$institute_code = encrypt_decrypt('decrypt',$institute);
		$program = $data['program'];
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
				$result = $this->apply_model->apply($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->apply_model->apply($program,'validate_program');
					if( $result['status'] )
					{
						$this->load->view('template_config/header');
						if($this->session->userdata('admcode') != '')
						{
							$program = $this->session->userdata('admcode');
							$this->session->set_userdata('inscode', $institute_code);
							//$this->session->set_userdata('admcode', $program);
							$program_name = $this->apply_model->apply($program,'get_program_name');
							$this->session->set_userdata('admname', $program_name);
							$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
							$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
							$data['program_menu_data'] = $this->apply_model->apply($program,'get_program_menu');
							$data['program_admit_card_count'] = $this->apply_model->apply($program,'get_program_admit_card_count');
							//$data['program_admit_card_detail'] = $this->apply_model->apply($program,'get_program_admitcard_detail');
							$this->load->view('apply/project_index',$data);
							$this->load->view('template_config/footer');
						}
						else
						{
							//$program = $this->session->userdata('admcode');
							$this->session->set_userdata('inscode', $institute_code);
							$this->session->set_userdata('admcode', $program);
							$program_name = $this->apply_model->apply($program,'get_program_name');
							$this->session->set_userdata('admname', $program_name);
							$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
							$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
							$data['program_menu_data'] = $this->apply_model->apply($program,'get_program_menu');
							$data['program_admit_card_count'] = $this->apply_model->apply($program,'get_program_admit_card_count');
							//$data['program_admit_card_setup'] = $this->apply_model->apply($program,'get_program_admitcard_setup');
							//$data['program_admit_card_detail'] = $this->apply_model->apply($program,'get_program_admitcard_detail');
							$this->load->view('apply/project_index',$data);
							$this->load->view('template_config/footer');
						}
						
					}
					
				}
				else
				{
					redirect('apply/apply_logout');
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
	public function form_detail(){
		$data = $this->uri->uri_to_assoc();
		$institute = $data['ins'];
		echo $institute;
	}
	public function result_html()
	{
		$program_code = $this->uri->segment(3); // 2ndsegment
		$institute_code = $this->uri->segment(4); // 3rdsegment
		$data = array(
			'institute'=>$institute_code,
			'program'=>$program_code
		);
		$data['result'] = $this->apply_model->apply($data,'result_html');
		$this->load->view('apply/result',$data);
		$html = $this->load->view('pdf/result_pdf', $data,  true); 
	}
	public function apply_1()
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
				$result = $this->apply_model->apply($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->apply_model->apply($program,'validate_program');
					if( $result['status'] )
					{
						$this->load->view('template_config/header');
						$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
						$template_file = $this->apply_model->apply($program,'get_program_template');
						$data['mandatory_field'] = $this->apply_model->apply($program,'get_mandatory_fields');
						//$data['program_admit_card_setup'] = $this->apply_model->apply($program,'get_program_admitcard_setup');
						//$data['program_admit_card_detail'] = $this->apply_model->apply($program,'get_program_admitcard_detail');
					
						if( $this->input->post())
						{
							$inputCaptcha = $this->input->post('txtCaptcha');
            				$sessCaptcha = $this->session->userdata('captchaCode');
							if($inputCaptcha != '' && $inputCaptcha != $sessCaptcha )
							{
								$data = array(
					                'status' => 'captchaerror',
					                'msg' => 'Security code did not match'
					            );
								$this->session->set_flashdata('error', $data['msg']);
								redirect($this->agent->referrer());
							}
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
					                  ),
									array(
					                     'field'   => 'txtCandidatePhone',
					                     'label'   => 'Last Name',
					                     'rules'   => 'trim|required'
					                  ),
									array(
					                     'field'   => 'txtdob',
					                     'label'   => 'Date of Birth',
					                     'rules'   => 'trim|required'
					                  ) 
						        );
								
							}
							$this->form_validation->set_rules($config);
							if ($this->form_validation->run() == FALSE) {
								$data = array(
					                'status' => 'validationerror',
					                'msg' => validation_errors()
					            );
					            $this->session->set_flashdata('error', $data['msg']);
								redirect($this->agent->referrer());
							}
							else
							{
								$result = $this->apply_model->apply($_POST,'insert_registration_data');
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect($result['template_file'].'/ins/'.$institute);
									
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
								redirect('apply/'.$template_file.'/ins/'.$institute);
							}
							else
							{
								$this->load->view('apply/apply_1',$data);
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
	
	public function apply_2()
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
				
				$result = $this->apply_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
					$result = $this->apply_model->apply($program,'validate_program');
					if( $result['status'] )
					{
						$this->load->view('template_config/header');
						$template_file = $this->apply_model->apply($program,'get_program_template');
						$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
						//$data['program_admit_card_setup'] = $this->apply_model->apply($program,'get_program_admitcard_setup');
						//$data['program_admit_card_detail'] = $this->apply_model->apply($program,'get_program_admitcard_detail');
						
						if( $this->input->post())
						{
							$inputCaptcha = $this->input->post('txtCaptcha');
	            			$sessCaptcha = $this->session->userdata('captchaCode');
							if($inputCaptcha != '' && $inputCaptcha != $sessCaptcha )
							{
								$data = array(
					                'status' => 'captchaerror',
					                'msg' => 'Security code did not match'
					            );
								$this->session->set_flashdata('error', $data['msg']);
								redirect($this->agent->referrer());
							}
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
								
								$config = array(
									array(
					                     'field'   => 'txtCandidatePhone',
					                     'label'   => 'Last Name',
					                     'rules'   => 'trim|required'
					                  ),
									array(
					                     'field'   => 'txtdob',
					                     'label'   => 'Date of Birth',
					                     'rules'   => 'trim|required'
					                  ) 
						        );
								
							}
							$this->form_validation->set_rules($config);
							if ($this->form_validation->run() == FALSE) {
								$data = array(
					                'status' => 'validationerror',
					                'msg' => validation_errors()
					            );
					            $this->session->set_flashdata('error', $data['msg']);
								redirect($this->agent->referrer());
							}
							else
							{
								$result = $this->apply_model->apply($_POST,'verify_registration_data');
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect($result['template_file'].'/ins/'.$institute);
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
								redirect('apply/'.$template_file.'/ins/'.$institute);
							}
							else
							{
								$this->load->view('apply/apply_2',$data);
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
	public function verify_application()
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
				
				$result = $this->apply_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
					$result = $this->apply_model->apply($program,'validate_program');
					if( $result['status'] )
					{
						$this->load->view('template_config/header');
						$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
						//$data['program_admit_card_setup'] = $this->apply_model->apply($program,'get_program_admitcard_setup');
						//$data['program_admit_card_detail'] = $this->apply_model->apply($program,'get_program_admitcard_detail');
						
						if( $this->input->post())
						{
							$inputCaptcha = $this->input->post('txtCaptcha');
	            			$sessCaptcha = $this->session->userdata('captchaCode');
							if($inputCaptcha != '' && $inputCaptcha != $sessCaptcha )
							{
								$data = array(
					                'status' => 'captchaerror',
					                'msg' => 'Security code did not match'
					            );
								$this->session->set_flashdata('error', $data['msg']);
								redirect($this->agent->referrer());
							}
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
								
								$config = array(
									array(
					                     'field'   => 'txtCandidatePhone',
					                     'label'   => 'Registered Mobile No',
					                     'rules'   => 'trim|required'
					                  ),
									array(
					                     'field'   => 'txtdob',
					                     'label'   => 'Date of Birth',
					                     'rules'   => 'trim|required'
					                  ) 
						        );
								
							}
							$this->form_validation->set_rules($config);
							if ($this->form_validation->run() == FALSE) {
								$data = array(
					                'status' => 'validationerror',
					                'msg' => validation_errors()
					            );
					            $this->session->set_flashdata('error', $data['msg']);
								redirect($this->agent->referrer());
							}
							else
							{
								$result = $this->apply_model->apply($_POST,'verify_application_data');
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('apply/download_print_application');
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
							
							$this->load->view('apply/download_application',$data);
						}
						$this->load->view('template_config/footer');
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
	public function download_admt_card()
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
				
				$result = $this->apply_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
					$result = $this->apply_model->apply($program,'validate_program');
					if( $result['status'] )
					{
						$this->load->view('template_config/header');
						$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
						
						//$data['program_admit_card_count'] = $this->apply_model->apply($program,'get_program_admit_card_count');
						$data['program_admit_card_count'] = $this->apply_model->apply($program,'get_program_admit_card_count');
						
						if( $this->input->post())
						{
							$inputCaptcha = $this->input->post('txtCaptcha');
	            			$sessCaptcha = $this->session->userdata('captchaCode');
							if($inputCaptcha != '' && $inputCaptcha != $sessCaptcha )
							{
								$data = array(
					                'status' => 'captchaerror',
					                'msg' => 'Security code did not match'
					            );
								$this->session->set_flashdata('error', $data['msg']);
								redirect($this->agent->referrer());
							}
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
								
								$config = array(
									array(
					                     'field'   => 'txtCandidatePhone',
					                     'label'   => 'Registered Mobile No',
					                     'rules'   => 'trim|required'
					                  ),
									array(
					                     'field'   => 'txtdob',
					                     'label'   => 'Date of Birth',
					                     'rules'   => 'trim|required'
					                  ) 
						        );
								
							}
							$this->form_validation->set_rules($config);
							if ($this->form_validation->run() == FALSE) {
								$data = array(
					                'status' => 'validationerror',
					                'msg' => validation_errors()
					            );
					            $this->session->set_flashdata('error', $data['msg']);
								redirect($this->agent->referrer());
							}
							else
							{
								$result = $this->apply_model->apply($_POST,'chk_admt_card_data');
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('apply/admit_card');
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
							
							$this->load->view('apply/download_application',$data);
						}
						$this->load->view('template_config/footer');
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
	public function admit_card_template001() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $reg_user_id = $_SESSION['reg_user_id'];
        $exam_centre_code = $this->uri->segment(3);
        $exam_vanue = $this->uri->segment(4);
        $program_code = $this->uri->segment(5);
        $ins = $this->uri->segment(6);
        
        //$program_code = $this->session->userdata('admcode');
        /*echo $program_code;
        echo $exam_centre_code;
        echo $exam_vanue;
        die();*/
		/*$exam_centre_code = $this->session->userdata('exam_center_code');
		$exam_vanue = $this->session->userdata('exam_vanue_code');*/
		$from = '';
		$to = '';
		/* $program_code = $this->uri->segment(3); // 1stsegment
		$exam_centre_code = $this->uri->segment(4); // 2ndsegment
		$exam_vanue = $this->uri->segment(5); // 3rdsegment
		$from = $this->uri->segment(6); // 4thsegment
		$to = $this->uri->segment(7); // 5thsegment*/
		$data = array(
            'program_code' => $program_code,
            'assigned_exam_center_code' => $exam_centre_code,
            'exam_vanue' => $exam_vanue,
            'ins' => $ins,
            'from' => $from,
            'to' => $to,
            'reg_user_id' => $reg_user_id
        );
        $data['instituteDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_ins_detail');
        $data['applicantSRow'] = $this->m_pdf_model->admit_card_pdf($data,'get_application_detail');
        
        $data['type'] = "ADMIT_CARD";
                
		$html = $this->load->view('pdf/admit_card', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
       /* echo $html;
        die();*/
        $pdfFilePath = "admit_card_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $mpdf = $this->m_pdf->pdf;
        //generate the PDF!
       $mpdf->WriteHTML($html);
        
        $data['type'] = "FOOTER";
        $html = $this->load->view('pdf/admit_card', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$mpdf->defaultfooterline = 0;
		$mpdf->setFooter($footer);
      	$mpdf->WriteHTML($html);        
      	
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$mpdf->Output($uploaddir.'/admit_card_print.pdf', 'I');
		$this->load->view('pdf/template008_pdf');	
		/*$pdf->Output($applicantNumber.".pdf",'I');*/	
		//return true;
    } 

	public function admit_card_WRITTEN() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $reg_user_id = $_SESSION['reg_user_id'];
        $exam_centre_code = $this->uri->segment(3);
        $exam_vanue1 = $this->uri->segment(4);
        $program_code = $this->uri->segment(5);
        $ins = $this->uri->segment(6);
        $exam_vanue = str_replace('_','/',$exam_vanue1);
		$from = '';
		$to = '';
		
		
		$program_code_new = str_replace('%60','/',$program_code);
		$data = array(
            'program_code' => $program_code_new,
            'assigned_exam_center_code' => $exam_centre_code,
            'exam_vanue' => $exam_vanue,
            'ins' => $ins,
            'from' => $from,
            'to' => $to,
            'reg_user_id' => $reg_user_id
        );
        $data['instituteDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_ins_detail');
        $data['courseTimingDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_course_timing_detail');
        $data['courseDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_course_detail');
        $data['subjectDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_subject_detail');
        $data['applicantSRow'] = $this->m_pdf_model->admit_card_pdf($data,'get_application_detail');
        
        $data['type'] = "ADMIT_CARD";
                
		$html = $this->load->view('pdf/admit_card_WRITTEN', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
       	//echo $html;die();
        $pdfFilePath = "admit_card_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $mpdf = $this->m_pdf->pdf;
        //generate the PDF!
       	$mpdf->WriteHTML($html);
        
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$mpdf->Output($uploaddir.'/admit_card_print.pdf', 'I');
		$this->load->view('pdf/admit_card_WRITTEN');	
		/*$pdf->Output($applicantNumber.".pdf",'I');*/	
		//return true;
    } 
    
	public function admit_card_VIVA() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $reg_user_id = $_SESSION['reg_user_id'];
        $exam_centre_code = $this->uri->segment(3);
        $exam_vanue = $this->uri->segment(4);
        $program_code = $this->uri->segment(5);
        $ins = $this->uri->segment(6);
        
		$from = '';
		$to = '';
		
		$program_code_new = str_replace('%60','/',$program_code);
		$data = array(
            'program_code' => $program_code_new,
            'assigned_exam_center_code' => $exam_centre_code,
            'exam_vanue' => $exam_vanue,
            'ins' => $ins,
            'from' => $from,
            'to' => $to,
            'reg_user_id' => $reg_user_id
        );
        $data['instituteDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_ins_detail');
        $data['courseTimingDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_course_timing_detail');
        $data['courseDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_course_detail');
        $data['subjectDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_subject_detail');
        $data['applicantSRow'] = $this->m_pdf_model->admit_card_pdf($data,'get_application_detail');
        
        $data['type'] = "ADMIT_CARD";
                
		$html = $this->load->view('pdf/admit_card_WRITTEN', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
       	//echo $html;die();
        $pdfFilePath = "admit_card_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $mpdf = $this->m_pdf->pdf;
        //generate the PDF!
       	$mpdf->WriteHTML($html);
        
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$mpdf->Output($uploaddir.'/admit_card_print.pdf', 'I');
		$this->load->view('pdf/template008_pdf');	
		/*$pdf->Output($applicantNumber.".pdf",'I');*/	
		//return true;
    } 

	public function admit_card_Skill() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $reg_user_id = $_SESSION['reg_user_id'];
        $exam_centre_code = $this->uri->segment(3);
        $exam_vanue = $this->uri->segment(4);
        $program_code = $this->uri->segment(5);
        $ins = $this->uri->segment(6);
        
		$from = '';
		$to = '';
		
		$program_code_new = str_replace('%60','/',$program_code);
		$data = array(
            'program_code' => $program_code_new,
            'assigned_exam_center_code' => $exam_centre_code,
            'exam_vanue' => $exam_vanue,
            'ins' => $ins,
            'from' => $from,
            'to' => $to,
            'reg_user_id' => $reg_user_id
        );
        $data['instituteDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_ins_detail');
        $data['courseTimingDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_course_timing_detail');
        $data['courseDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_course_detail');
        $data['subjectDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_subject_detail');
        $data['applicantSRow'] = $this->m_pdf_model->admit_card_pdf($data,'get_application_detail');
        
        $data['type'] = "ADMIT_CARD";
                
		$html = $this->load->view('pdf/admit_card_WRITTEN', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
       	//echo $html;die();
        $pdfFilePath = "admit_card_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $mpdf = $this->m_pdf->pdf;
        //generate the PDF!
       	$mpdf->WriteHTML($html);
        
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$mpdf->Output($uploaddir.'/admit_card_print.pdf', 'I');
		$this->load->view('pdf/template008_pdf');	
		/*$pdf->Output($applicantNumber.".pdf",'I');*/	
		//return true;
    } 



	public function document()
	{
		$document_type = $this->uri->segment(3);
		$file_name = $this->uri->segment(4);
		$program_code = $this->uri->segment(5);
		
		if($file_name == '')
		{
			exit("File Not found");
		}
		$file_path = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$program_code."/".$file_name;
		$photoname= explode(".",$file_name);
		$ext = strtolower(end($photoname));
		//$file_name = basename($file_path); 
		//echo $file_path;
		function output_file($file, $name, $mime_type='')
		{
			if(!is_readable($file)) die('File not found or inaccessible!');

			$size = filesize($file);
			$name = rawurldecode($name);
			$known_mime_types=array(
			"pdf" => "application/pdf",
			"txt" => "text/plain",
			"html" => "text/html",
			"htm" => "text/html",
			"exe" => "application/octet-stream",
			"zip" => "application/zip",
			"doc" => "application/msword",
			"xls" => "application/vnd.ms-excel",
			"ppt" => "application/vnd.ms-powerpoint",
			"gif" => "image/gif",
			"png" => "image/png",
			"jpeg"=> "image/jpg",
			"jpg" => "image/jpg",
			"php" => "text/plain"
			);
			if($mime_type=='')
			{
				$file_extension = strtolower(substr(strrchr($file,"."),1));
				if(array_key_exists($file_extension, $known_mime_types)){
					$mime_type=$known_mime_types[$file_extension];
					$known_mime_type=$known_mime_types[$file_extension];
				} else 
				{
					$mime_type="application/force-download";
				};
			};

			@ob_end_clean();


			if(ini_get('zlib.output_compression'))
			ini_set('zlib.output_compression', 'Off');
			header('Content-Type: ' . $mime_type);
			header('Content-Disposition: attachment; filename="'.$name.'"');
			header("Content-Transfer-Encoding: binary");
			header('Accept-Ranges: bytes');
			header("Cache-control: private");
			header('Pragma: private');
			//header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			if(isset($_SERVER['HTTP_RANGE']))
			{
			list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
			list($range) = explode(",",$range,2);
			list($range, $range_end) = explode("-", $range);
			$range=intval($range);
			if(!$range_end) {
			$range_end=$size-1;
			} else {
			$range_end=intval($range_end);
			}
			$new_length = $range_end-$range+1;
			header("HTTP/1.1 206 Partial Content");
			header("Content-Length: $new_length");
			header("Content-Range: bytes $range-$range_end/$size");
			} else {
			$new_length=$size;
			header("Content-Length: ".$size);
			}
			$chunksize = 1*(1024*1024);
			$bytes_send = 0;
			if ($file = fopen($file, 'r'))
			{
			if(isset($_SERVER['HTTP_RANGE']))
			fseek($file, $range);

			while(!feof($file) &&
			(!connection_aborted()) &&
			($bytes_send<$new_length)
			)
			{
			$buffer = fread($file, $chunksize);
			print($buffer);
			flush();
			$bytes_send += strlen($buffer);
			}
			fclose($file);
			} else

			die('Error - can not open file.');
			die();
		}
		set_time_limit(0);
		$file_path=$file_path;

		  $file = $file_path;
		  $filename = $file_name;
		  if($ext == 'pdf')
		  {
		  	header('Content-type: application/pdf');
		  }
		  else if($ext == 'doc')
		  {
		  	header('Content-type: application/msword');
		  }
		  else if($ext == 'docx')
		  {
		  	header('Content-type: application/msword');
		  }
		  else if($ext == 'png')
		  {
		  	header('Content-type: image/png');
		  }
		  else if($ext == 'jpg')
		  {
		  	header('Content-type: image/jpg');
		  }
		  
		  header('Content-Disposition: inline; filename="' . $filename . '"');
		  header('Content-Transfer-Encoding: binary');
		  header('Accept-Ranges: bytes');
		  @readfile($file);
	}
	
    public function template003()
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
				
				$result = $this->apply_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
					$result = $this->apply_model->apply($program,'validate_program');
					if( $result['status'] )
					{
						$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
						$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
						$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
						
					$institute_list['profile'] = $this->apply_model->apply($institute,'get_profile_details'); 
						$institute_list['main_menu'] = $this->index_model->index_data($institute,'get_menu'); 
						$institute_list['header'] = '';
						$this->load->view('template_config/header_home',$institute_list);
						
						$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
						$data['registration_data'] = $this->apply_model->apply($program,'get_registration_data');
						$data['application_data'] = $this->apply_model->apply($program,'get_application_data');
						$data['applicant_data'] = $this->apply_model->apply($program,'get_applicant_data');
						$data['present_communication_data'] = $this->apply_model->apply($program,'get_present_communication_data');

						$data['permanent_communication_data'] = $this->apply_model->apply($program,'get_permanent_communication_data');
						$data['father_data'] = $this->apply_model->apply($program,'get_father_data');
						$data['mother_data'] = $this->apply_model->apply($program,'get_mother_data');
						$data['guardian_data'] = $this->apply_model->apply($program,'get_guardian_data');
						$data['academic_qual_data'] = $this->apply_model->apply($program,'get_academic_qual_data');
						$data['allNationalities'] = $this->apply_model->apply($program,'get_nationality_data');
						$data['allRelationship'] = $this->apply_model->apply($program,'get_relationship_data');
						$data['allCategories'] = $this->apply_model->apply($program,'get_category_data');
						$data['allReligions'] = $this->apply_model->apply($program,'get_religion_data');
						$data['allMinority'] = $this->apply_model->apply($program,'get_minority_data');
						//print_r($data['allMinority']);
						$data['allDistricts'] = $this->apply_model->apply($program,'get_district_data');
						$data['allStates'] = $this->apply_model->apply($program,'get_state_data');
						$data['documentsReq'] = $this->apply_model->apply($program,'get_documents_required');
						$data['allQualifications'] = $this->apply_model->apply($program,'get_qualification_data');
						$data['allHighestQualifications'] = $this->apply_model->apply($program,'get_highest_qualification');
						//$data['allHonoursSubject'] = $this->apply_model->apply($program,'get_honours_subject');
						//$data['program_admit_card_setup'] = $this->apply_model->apply($program,'get_program_admitcard_setup');
						//$data['program_admit_card_detail'] = $this->apply_model->apply($program,'get_program_admitcard_detail');
						//print_r($this->input->post());
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
								$result = $this->apply_model->apply($_POST,'add_application_data');
								//print_r($result);die();
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('apply/apply_3/ins/'.$institute);
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
								
								$this->load->view('apply/template003',$data);
							}
							else
							{
								redirect('apply/apply_logout');
							}
							
						}
						$this->load->view('index/pages/footer_index',$institute_list);
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

	
	public function template002()
	{
		//$result = $this->index_model->institute();
		//$program = $this->session->userdata('admcode');
		$program = $this->session->userdata('admcode');//echo $program;die;
		$reg_user_id = $this->session->userdata('reg_user_id');
		
		$detail = array($reg_user_id,$program);
		
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
						$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
						$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
						$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
						$institute_list['main_menu'] = $this->index_model->index_data($institute,'get_menu'); 
						
						$institute_list['profile'] = $this->apply_model->apply($institute,'get_profile_details'); 
						$institute_list['header'] = '';
						$this->load->view('template_config/header_home',$institute_list);
						
						$data['choice_details_data'] = $this->apply_model->apply(NULL,'get_select_choice_details');
						$data['post_detail'] = $this->apply_model->apply($program,'get_post');
						//print_r($data['choice_details_data'][0]);
						$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
						//$data['course_data'] = $this->apply_model->apply($program,'get_course_detail');
						$data['registration_data'] = $this->apply_model->apply($program,'get_registration_data');
						$data['application_data'] = $this->apply_model->apply($program,'get_application_data');
						/*echo $institute."dsad";
						die();*/
						$data['applicant_data'] = $this->apply_model->apply($program,'get_applicant_data');
						$data['present_communication_data'] = $this->apply_model->apply($program,'get_present_communication_data');
						$data['allPwdType'] = $this->apply_model->apply($program,'get_PWD_type_data');
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
						$data['SRSECDEGREE'] = $this->apply_model->apply($program,'get_SRSEC_degree_data');
						$data['GRADUTIONDEGREE'] = $this->apply_model->apply($program,'get_GRADUTION_degree_data');
						$data['PGDEGREE'] = $this->apply_model->apply($program,'get_PG_degree_data');
						$data['examcentercheck'] = $this->apply_model->apply($program,'get_examcentercheck_data');
						
						$data['SRSECCOURSE'] = $this->apply_model->apply($program,'get_SRSEC_COURSE_data');
						$data['GRADUTIONCOURSE'] = $this->apply_model->apply($program,'get_GRADUTION_COURSE_data');
						$data['PGCOURSE'] = $this->apply_model->apply($program,'get_PG_COURSE_data');
						$data['DECLARATION'] = $this->apply_model->apply($program,'get_DECLARATION_data');
						
						$data['allHighestQualifications'] = $this->apply_model->apply($program,'get_highest_qualification');
						$data['select_graduation_course_temp'] = $this->apply_model->apply($detail,'select_graduation_course_temp');
						$data['select_exam_centre'] = $this->apply_model->apply($program,'select_exam_centre');
						$data['want_program_group'] = $this->apply_model->apply($institute,'want_program_group');
						$data['total_experience_data'] = $this->apply_model->apply($program,'total_experience_data');
						
						$data['applicant_data_temp'] = $this->apply_model->apply($program,'get_applicant_data_temp');
						$data['program_experience'] = $this->apply_model->apply($program,'get_program_experience');
						$data['applicant_experience'] = $this->apply_model->apply($program,'get_program_applicant_experience');
						$data['academic_qual_data_temp'] = $this->apply_model->apply($program,'get_academic_qual_data_temp');
						$data['tech_qual_data_5_temp'] = $this->apply_model->apply($program,'get_tech_qual_data_5_temp');
						$data['tech_qual_data_6_temp'] = $this->apply_model->apply($program,'get_tech_qual_data_6_temp');
						$data['application_data_temp'] = $this->apply_model->apply($program,'get_application_data_temp');
						
						
						if($this->session->userdata('reg_user_id') != '')
						{
							//echo $result['status'] ; 
							//print_r($data);die();	
							$this->load->view('apply/template002',$data);
						}
						else
						{
							redirect('apply/apply_logout');
						}
							
						
						$this->load->view('index/pages/footer_index',$institute_list);
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
	public function template001()
	{
		//$result = $this->index_model->institute();
		//$program = $this->session->userdata('admcode');
		$program = $this->session->userdata('admcode');
		$reg_user_id = $this->session->userdata('reg_user_id');
		
		$detail = array($reg_user_id,$program);
		
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
						$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
						$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
						$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
						$institute_list['main_menu'] = $this->index_model->index_data($institute,'get_menu'); 
						
						$institute_list['profile'] = $this->apply_model->apply($institute,'get_profile_details'); 
						$institute_list['header'] = '';
						$this->load->view('template_config/header_home',$institute_list);
						
						$data['choice_details_data'] = $this->apply_model->apply(NULL,'get_select_choice_details');
						$data['post_detail'] = $this->apply_model->apply($program,'get_post');
						//print_r($data['choice_details_data'][0]);
						$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
						//$data['course_data'] = $this->apply_model->apply($program,'get_course_detail');
						$data['registration_data'] = $this->apply_model->apply($program,'get_registration_data');
						$data['application_data'] = $this->apply_model->apply($program,'get_application_data');
						/*echo $institute."dsad";
						die();*/
						$data['applicant_data'] = $this->apply_model->apply($program,'get_applicant_data');
						$data['present_communication_data'] = $this->apply_model->apply($program,'get_present_communication_data');
						$data['allPwdType'] = $this->apply_model->apply($program,'get_PWD_type_data');
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
						$data['want_program_group'] = $this->apply_model->apply($institute,'want_program_group');
						$data['total_experience_data'] = $this->apply_model->apply($program,'total_experience_data');
						
						$data['applicant_data_temp'] = $this->apply_model->apply($program,'get_applicant_data_temp');
						$data['academic_qual_data_temp'] = $this->apply_model->apply($program,'get_academic_qual_data_temp');
						$data['tech_qual_data_5_temp'] = $this->apply_model->apply($program,'get_tech_qual_data_5_temp');
						$data['tech_qual_data_6_temp'] = $this->apply_model->apply($program,'get_tech_qual_data_6_temp');
						$data['application_data_temp'] = $this->apply_model->apply($program,'get_application_data_temp');
						
						
						if($this->session->userdata('reg_user_id') != '')
						{
							//echo $result['status'] ; 
							//print_r($data);die();	
							$this->load->view('apply/template001',$data);
						}
						else
						{
							redirect('apply/apply_logout');
						}
							
						
						$this->load->view('index/pages/footer_index',$institute_list);
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
	public function fillup_missing_data()
	{ 
		//$result = $this->index_model->institute();
		//$program = $this->session->userdata('admcode');
		//$program = $this->session->userdata('admcode');
		$reg_user_id = $this->session->userdata('reg_user_id');
		
        $program_code = $this->uri->segment(6);
       	$program = str_replace('%60','/',$program_code);
		$detail = array($reg_user_id,$program);
		
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
					if($result['status'])
					{
						$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
						$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
						$institute_list['eligibilityDate'] = $this->index_model->index_data($ins,'get_EligibilityDate');
						$institute_list['main_menu'] = $this->index_model->index_data($institute,'get_menu'); 
						
						$institute_list['profile'] = $this->apply_model->apply($institute,'get_profile_details'); 
						$institute_list['header'] = '';
						$this->load->view('template_config/header_home',$institute_list);
						
						$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
						$data['allQuota'] = $this->apply_model->apply($program,'get_quota_data');
						$data['allCategories'] = $this->apply_model->apply($program,'get_category_data');
						$data['applicant_data'] = $this->apply_model->apply($program,'get_applicant_data');
						
						$data['application_data'] = $this->apply_model->apply($program,'get_application_data');
						$data['document_path'] = $this->apply_model->apply($program,'get_document_path');
						
						$data['document_path_PHO'] = $this->apply_model->apply($program,'get_document_path_PHO');
						//print_r($data['document_path']);
						$data['document_path_SIG'] = $this->apply_model->apply($program,'get_document_path_SIG');
						
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
								$result = $this->apply_model->apply($_POST,'update_profile_details');
								//print_r($result);die();
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									//echo ('apply/fillup_missing_data/ins/'.$institute.'/admcode/'.$program_code); die();
									redirect('apply/fillup_missing_data/ins/'.$institute.'/admcode/'.$program_code); 
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
								
								$this->load->view('apply/fillup_missing_data',$data);
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
		
		
	}

						
	public function template004()
	{
	
		//$result = $this->index_model->institute();
		//$program = $this->session->userdata('admcode');
		$program = $this->session->userdata('admcode');
		$reg_user_id = $this->session->userdata('reg_user_id');
		
		$detail = array($reg_user_id,$program);
		
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
						$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
						$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
						
						$institute_list['profile'] = $this->apply_model->apply($institute,'get_profile_details'); 
						$institute_list['main_menu'] = $this->index_model->index_data($institute,'get_menu'); 
						$institute_list['header'] = '';
						$this->load->view('template_config/header_home',$institute_list);
						$data['choice_details_data'] = $this->apply_model->apply(NULL,'get_select_choice_details');
						//print_r($data['choice_details_data'][0]);
						$data['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
						print_r($data['eligibilityDate']);return;
						$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
						//$data['course_data'] = $this->apply_model->apply($program,'get_course_detail');
						$data['registration_data'] = $this->apply_model->apply($program,'get_registration_data');
						$data['application_data'] = $this->apply_model->apply($program,'get_application_data');
						$data['applicant_data'] = $this->apply_model->apply($program,'get_applicant_data');
						$data['present_communication_data'] = $this->apply_model->apply($program,'get_present_communication_data');
						$data['allDCoffice'] = $this->apply_model->apply($program,'get_dc_data');
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
						
						
						$data['allPwdType'] = $this->apply_model->apply($program,'get_PWD_type_data');
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
						$data['want_program_group'] = $this->apply_model->apply($institute,'want_program_group');
						
						$data['applicant_data_temp'] = $this->apply_model->apply($program,'get_applicant_data_temp');
						$data['academic_qual_data_temp'] = $this->apply_model->apply($program,'get_academic_qual_data_temp');
						$data['tech_qual_data_5_temp'] = $this->apply_model->apply($program,'get_tech_qual_data_5_temp');
						$data['tech_qual_data_6_temp'] = $this->apply_model->apply($program,'get_tech_qual_data_6_temp');
						$data['application_data_temp'] = $this->apply_model->apply($program,'get_application_data_temp');
						$data['post_detail'] = $this->apply_model->apply($program,'get_post');//print_r($data['post_detail']);
						
						
						if($this->session->userdata('reg_user_id') != '')
						{
							//echo $result['status'] ; 
							//print_r($data);die();	
							$this->load->view('apply/template004',$data);
						}
						else
						{
							redirect('apply/apply_logout');
						}
							
						
						$this->load->view('index/pages/footer_index',$institute_list);
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
    public function view_template002()
	{
		$this->load->view('apply/view_template002');
	}
	public function template010()
	{
		$program = $this->session->userdata('admcode');
		$reg_user_id = $this->session->userdata('reg_user_id');
		
		$detail = array($reg_user_id,$program);
		
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
						$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
						$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
						$institute_list['main_menu'] = $this->index_model->index_data($institute,'get_menu'); 
						$institute_list['profile'] = $this->apply_model->apply($institute,'get_profile_details'); 
						$institute_list['header'] = '';
						$this->load->view('template_config/header_home',$institute_list);
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
						$data['allOtherInfo'] = $this->apply_model->apply($program,'get_allOtherInfo');
						
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
								$result = $this->apply_model->apply($_POST,'add_application_data_01');		
								/*echo $result['status'];
								die();	*/
								//print_r($result);die();
								if( $result['status'] == 1 )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('apply/apply_3/ins/'.$institute);
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
								$this->load->view('apply/template010',$data);
							}
							else
							{
								redirect('apply/apply_logout');
							}
							
						}
						$this->load->view('index/pages/footer_index',$institute_list);
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

	public function reeval_template001()
	{
	
		//$result = $this->index_model->institute();
		//$program = $this->session->userdata('admcode');
		$program = $this->session->userdata('admcode');
		$reg_user_id = $this->session->userdata('reg_user_id');
		
		$detail = array($reg_user_id,$program);
		
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
						$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
						$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
						$institute_list['main_menu'] = $this->index_model->index_data($institute,'get_menu'); 
						$institute_list['profile'] = $this->apply_model->apply($institute,'get_profile_details'); 
						$institute_list['header'] = '';
						$this->load->view('template_config/header_home',$institute_list);
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
						
						if( $this->input->post())
						{
							//$this->session->set_flashdata('info', $result['msg']);
							redirect('apply/reeval_apply_4/ins/'.$institute);
						}
						else
						{						
							if($this->session->userdata('reg_user_id') != '')
							{
								$this->load->view('apply/reeval_template001',$data);
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
		
	}

	public function reeval_template002()
	{
	
		
		//$result = $this->index_model->institute();
		//$program = $this->session->userdata('admcode');
		$program = $this->session->userdata('admcode');
		$reg_user_id = $this->session->userdata('reg_user_id');
		
		$detail = array($reg_user_id,$program);
		
		$data = $this->uri->uri_to_assoc();
		$ins = $data['ins'];
		$institute = encrypt_decrypt('decrypt',$ins);
		$program = $data['admcode'];
		//ECHO $institute;echo $program;DIE();
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
				
				$ins = encrypt_decrypt('encrypt',$institute);
				$result = $this->apply_model->apply($ins,'validate_institute');
				if( $result['status'] )
				{
					
					$result = $this->apply_model->apply($program,'validate_program');
					//print_r($result);die();
					//echo $program;die();
					if( $result['status'] == true)
					{
						/*echo $institute."dsad";
						die();*/
						$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
						$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
						$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
						
						//print_r($institute_list);die();
						$institute_list['profile'] = $this->apply_model->apply($institute,'get_profile_details'); 
						$institute_list['main_menu'] = $this->index_model->index_data($institute,'get_menu'); 
						$institute_list['header'] = '';
						$this->load->view('template_config/header_home',$institute_list);
						
						$data['choice_details_data'] = $this->apply_model->apply(NULL,'get_select_choice_details');
						$data['institute'] = $this->index_model->index_data($ins,'get_institutes');
						$data['institute_data'] = $this->apply_model->apply($ins,'get_institutes');	//					print_r($data['institute']);die();
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
						$data['allDCoffice'] = $this->apply_model->apply($program,'get_dc_data');
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
							$ins = encrypt_decrypt('encrypt',$institute);
							$this->session->set_userdata('admcode', $program);
							//$this->session->set_flashdata('info', $result['msg']);
							redirect('apply/reeval_apply_4/ins/'.$ins);
						}
						else
						{						
							if($this->session->userdata('reg_user_id') != '')
							{
								//echo $result['status'] ; 
								//print_r($data);die();	
								$this->load->view('apply/reeval_template002',$data);
							}
							else
							{
								redirect('apply/apply_logout');
							}
							
						}
						$this->load->view('index/pages/footer_index',$institute_list);
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
		
		
	}
	public function reeval_template004()
	{
	
		//$result = $this->index_model->institute();
		//$program = $this->session->userdata('admcode');
		$program = $this->session->userdata('admcode');
		$reg_user_id = $this->session->userdata('reg_user_id');
		
		$detail = array($reg_user_id,$program);
		
		$data = $this->uri->uri_to_assoc();
		$institute = $data['ins'];
		$program = $data['admcode'];
		//ECHO $institute;echo $program;DIE();
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
				
				$ins = encrypt_decrypt('encrypt',$institute);
				$result = $this->apply_model->apply($ins,'validate_institute');
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
						$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
						$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
					
						//print_r($institute_list);die();
						$institute_list['profile'] = $this->apply_model->apply($institute,'get_profile_details'); 
						$institute_list['main_menu'] = $this->index_model->index_data($institute,'get_menu'); 
						$institute_list['header'] = '';
						$this->load->view('template_config/header_home',$institute_list);
						
						$data['choice_details_data'] = $this->apply_model->apply(NULL,'get_select_choice_details');
						$data['institute'] = $this->index_model->index_data($ins,'get_institutes');
						$data['institute_data'] = $this->apply_model->apply($ins,'get_institutes');	//					print_r($data['institute']);die();
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
						$data['allDCoffice'] = $this->apply_model->apply($program,'get_dc_data');
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
							$ins = encrypt_decrypt('encrypt',$institute);
							$this->session->set_userdata('admcode', $program);
							//$this->session->set_flashdata('info', $result['msg']);
							redirect('apply/reeval_apply_4/ins/'.$ins);
						}
						else
						{						
							if($this->session->userdata('reg_user_id') != '')
							{
								//echo $result['status'] ; 
								//print_r($data);die();	
								$this->load->view('apply/reeval_template002',$data);
							}
							else
							{
								redirect('apply/apply_logout');
							}
							
						}
						$this->load->view('index/pages/footer_index',$institute_list);
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
		
		
	}
	public function reeval_apply_4()
	{
		$program = $this->session->userdata('admcode');
		$reg_user_id = $this->session->userdata('reg_user_id');
		
		//$institute = $this->session->userdata('institute_code');
		$data = $this->uri->uri_to_assoc();
		$institute = $data['ins'];
		//$program = $data['admcode'];
		
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
				
				$result = $this->apply_model->apply($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->apply_model->apply($program,'validate_program');
					if( $result['status'] )
					{	
						$detail = array($reg_user_id,$program);
						$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
						$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
					$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
					
						$institute_list['profile'] = $this->apply_model->apply($institute,'get_profile_details'); 
						$institute_list['main_menu'] = $this->index_model->index_data($institute,'get_menu'); 
						$institute_list['header'] = '';
						$this->load->view('template_config/header_home',$institute_list);
						$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
						$data['document_data'] = $this->apply_model->apply($program,'get_document_data');
						$data['appl_status'] = $this->apply_model->apply($program,'get_appl_status');// print_r($data['appl_status']);die();
						$data['doc_path'] = $this->apply_model->apply($program,'get_doc_path');
						$data['regdata'] = $this->apply_model->apply($program,'get_reg_id');
						$data['paymodedata'] = $this->apply_model->apply($program,'payModeQuery');
						$data['tempcodedata'] = $this->apply_model->apply($program,'tempcode');
						$data['categorydt'] = $this->apply_model->apply($program,'categorydata');
						$data['amount_arr'] = $this->apply_model->apply($program,'amount');
						$data['updatereg'] = $this->apply_model->apply($program,'update_reg_mode');
						$data['bankdata'] = $this->apply_model->apply($program,'bank_detail');
						$data['passstatus'] = $this->apply_model->apply($program,'pass_status');
						$data['depositmode'] = $this->apply_model->apply($program,'deposit');
						$data['challanData'] = $this->apply_model->apply($program,'get_challanData');
						$data['bankdetail'] = $this->apply_model->apply($program,'get_bankdetail');
						$data['want_program_group'] = $this->apply_model->apply($institute,'want_program_group');
						
						/////// template modal //////////////////////
						
						$data['choice_details_data'] = $this->apply_model->apply(NULL,'get_select_choice_details');
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
								$data = array(
					                'status' => 'xsserror',
					                'msg' => 'Special chararacters like <,>,=,(,),&lt;,&gt; are not allowed'
					            );
								$this->session->set_flashdata('error', $data['msg']);
								redirect($this->agent->referrer());
							}
							else
							{
								$result = $this->apply_model->apply($_POST,'reeval_add_payment_data');
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('apply/reeval_apply_4/ins/'.$institute);
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
							//echo 'hi5', die();						
							if($this->session->userdata('reg_user_id') != '')
							{
								
								$this->load->view('apply/reeval_apply_4',$data);
							}
							else
							{
								redirect('apply/apply_logout/ins/'.$institute);
							}
						}
						$this->load->view('index/pages/footer_index',$institute_list);
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
	






	public function template008()
	{
	
		//$result = $this->index_model->institute();
		//$program = $this->session->userdata('admcode');
		$program = $this->session->userdata('admcode');
		$reg_user_id = $this->session->userdata('reg_user_id');
		
		$detail = array($reg_user_id,$program);
		
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
				//echo $institute ; die();
				redirect('error');
	         
			}
			else
			{
				
				$result = $this->apply_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
					$result = $this->apply_model->apply($program,'validate_program');
					if( $result['status'] )
					{
						$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
						$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
						$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
						$institute_list['profile'] = $this->apply_model->apply($institute,'get_profile_details'); 
						$institute_list['main_menu'] = $this->index_model->index_data($institute,'get_menu'); 
						$institute_list['header'] = '';
						$this->load->view('template_config/header_home',$institute_list);
						
						$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
						$data['course_data'] = $this->apply_model->apply($program,'get_course_detail');
						$data['registration_data'] = $this->apply_model->apply($program,'get_registration_data');
						$data['application_data'] = $this->apply_model->apply($program,'get_application_data');
						$data['applicant_data'] = $this->apply_model->apply($program,'get_applicant_data');
						$data['present_communication_data'] = $this->apply_model->apply($program,'get_present_communication_data');

						$data['permanent_communication_data'] = $this->apply_model->apply($program,'get_permanent_communication_data');
						$data['father_data'] = $this->apply_model->apply($program,'get_father_data');
						$data['mother_data'] = $this->apply_model->apply($program,'get_mother_data');
						$data['guardian_data'] = $this->apply_model->apply($program,'get_guardian_data');
						$data['academic_qual_data'] = $this->apply_model->apply($program,'get_academic_qual_data');
						$data['allNationalities'] = $this->apply_model->apply($program,'get_nationality_data');
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
						
						//print_r($data['select_graduation_course_temp']);
						
						//$data['cou'] = $this->apply_model->apply($program,'get_highest_qualification');
						//print_r($data['allQualifications']);
						//$data['allHonoursSubject'] = $this->apply_model->apply($program,'get_honours_subject');
						//$data['program_admit_card_setup'] = $this->apply_model->apply($program,'get_program_admitcard_setup');
						//$data['program_admit_card_detail'] = $this->apply_model->apply($program,'get_program_admitcard_detail');
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
								$data1 = array(
					                'status' => 'xsserror',
					                'msg' => 'Special chararacters like <,>,=,(,),&lt;,&gt; are not allowed'
					            );
								$this->session->set_flashdata('error', $data1['msg']);
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
					                  
									array(
					                     'field'   => 'NorthEast',
					                     'label'   => ' Belong to North East Region',
					                     'rules'   => 'trim|required'
					                  ),
					                 array(
					                     'field'   => 'center_name1',
					                     'label'   => 'Choice 1',
					                     'rules'   => 'trim|required'
					                  ),
									array(
					                     'field'   => 'center_name2',
					                     'label'   => 'Choice 2',
					                     'rules'   => 'trim|required'
					                  ),
					                array(
					                     'field'   => 'center_name3',
					                     'label'   => 'Choice 3',
					                     'rules'   => 'trim|required'
					                  )
									
									
						        );
								
							}
							$this->form_validation->set_rules($config);
							if ($this->form_validation->run() == FALSE) 
							{
								//echo 1; die();
								$data1 = array(
					                'status' => 'validationerror',
					                'msg' => validation_errors()
					            );
					            $this->session->set_flashdata('error', $data1['msg']);
					            redirect($this->agent->referrer());
					           // $this->load->view('apply/template008',$data);
					            
					         // echo $this->session->flashdata('error'); die();
							}
							else
							{	
								//echo 'hi'; 				
								$result = $this->apply_model->apply($_POST,'add_application_data');		
							
								if( $result['status'] == 1 )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('apply/apply_3/ins/'.$institute);
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
								$this->load->view('apply/template008',$data);
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

	public function template014()
	{
	
		//$result = $this->index_model->institute();
		$program = $this->session->userdata('admcode');
		$data = $this->uri->uri_to_assoc();
		$institute = $data['ins'];
		
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
				
				$result = $this->apply_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
					$result = $this->apply_model->apply($program,'validate_program');
					if( $result['status'] )
					{
						$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
						$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
						$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
						$institute_list['profile'] = $this->apply_model->apply($institute,'get_profile_details'); 
						$institute_list['main_menu'] = $this->index_model->index_data($institute,'get_menu'); 
						$institute_list['header'] = '';
						$this->load->view('template_config/header_home',$institute_list);
						
						$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
						$data['course_data'] = $this->apply_model->apply($program,'get_course_detail');
						$data['registration_data'] = $this->apply_model->apply($program,'get_registration_data');
						$data['application_data'] = $this->apply_model->apply($program,'get_application_data');
						$data['applicant_data'] = $this->apply_model->apply($program,'get_applicant_data');
						$data['present_communication_data'] = $this->apply_model->apply($program,'get_present_communication_data');

						$data['permanent_communication_data'] = $this->apply_model->apply($program,'get_permanent_communication_data');
						$data['father_data'] = $this->apply_model->apply($program,'get_father_data');
						$data['mother_data'] = $this->apply_model->apply($program,'get_mother_data');
						$data['guardian_data'] = $this->apply_model->apply($program,'get_guardian_data');
						$data['academic_qual_data'] = $this->apply_model->apply($program,'get_academic_qual_data');
						$data['allNationalities'] = $this->apply_model->apply($program,'get_nationality_data');
						$data['allCategories'] = $this->apply_model->apply($program,'get_category_data');
						$data['allReligions'] = $this->apply_model->apply($program,'get_religion_data');
						$data['allMinority'] = $this->apply_model->apply($program,'get_minority_data');
						//print_r($data['allMinority']);
						$data['allDistricts'] = $this->apply_model->apply($program,'get_district_data');
						$data['allStates'] = $this->apply_model->apply($program,'get_state_data');
						$data['documentsReq'] = $this->apply_model->apply($program,'get_documents_required');
						$data['allQualifications'] = $this->apply_model->apply($program,'get_qualification_data');
						$data['allHighestQualifications'] = $this->apply_model->apply($program,'get_highest_qualification');
						//$data['allHonoursSubject'] = $this->apply_model->apply($program,'get_honours_subject');
						//$data['program_admit_card_setup'] = $this->apply_model->apply($program,'get_program_admitcard_setup');
						//$data['program_admit_card_detail'] = $this->apply_model->apply($program,'get_program_admitcard_detail');
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
					                  array(
					                     'field'   => 'NorthEast',
					                     'label'   => ' Belong to North East Region',
					                     'rules'   => 'trim|required'
					                  ),
					                 array(
					                     'field'   => 'center_name1',
					                     'label'   => 'Choice 1',
					                     'rules'   => 'trim|required'
					                  ),
									array(
					                     'field'   => 'center_name2',
					                     'label'   => 'Choice 2',
					                     'rules'   => 'trim|required'
					                  ),
					                array(
					                     'field'   => 'center_name3',
					                     'label'   => 'Choice 3',
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
					              redirect($this->agent->referrer());
							}
							else
							{								
								$result = $this->apply_model->apply($_POST,'add_application_data_014');
								//print_r($result);die();
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('apply/apply_3/ins/'.$institute);
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
								
								$this->load->view('apply/template014',$data);
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
	
	
	public function apply_3()
	{
	
		//$result = $this->index_model->institute();
		$program = $this->session->userdata('admcode');
		$data = $this->uri->uri_to_assoc();
		$institute = $data['ins'];
		$edit_status = isset($data['edit'])?$data['edit']:'';
		
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
				
				$result = $this->apply_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
					$result = $this->apply_model->apply($program,'validate_program');
					if( $result['status'] )
					{
						$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
						$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
						$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
						$institute_list['profile'] = $this->apply_model->apply($institute,'get_profile_details'); 
						$institute_list['main_menu'] = $this->index_model->index_data($institute,'get_menu'); 
						$institute_list['header'] = '';
						$this->load->view('template_config/header_home',$institute_list);
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
								$result = $this->apply_model->apply($_POST,'add_document_data');
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('apply/apply_4/ins/'.$institute.'/edit/'.$edit_status);
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
								$this->load->view('apply/apply_3',$data);
							}
							else
							{
								redirect('apply/apply_logout/ins/'.$institute);
							}
						}
						$this->load->view('index/pages/footer_index',$institute_list);
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
	
	
	public function apply_upload()
	{
		
		//$result = $this->index_model->institute();
		//$program = $this->session->userdata('admcode');
		$data = $this->uri->uri_to_assoc();
		$institute = $data['ins'];
		$program = $data['admcode'];
		/*print_r($data);
		echo($program);die();*/
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
				
				$result = $this->apply_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					/*echo($program);die();*/
					$result = $this->apply_model->apply($program,'validate_program');
					//print_r($result);
					if( $result['status'] )
					{ 
						$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
						$institute_list['profile'] = $this->apply_model->apply($institute,'get_profile_details'); 
						$institute_list['main_menu'] = $this->index_model->index_data($institute,'get_menu'); 
						$institute_list['header'] = '';
						$this->load->view('template_config/header_home',$institute_list);
						$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->apply_model->apply($program,'get_program_detail_upload');
						$data['document_data'] = $this->apply_model->apply('','get_document_data_upload');
						$data['appl_status'] = $this->apply_model->apply($institute,'get_appl_status_doc');
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
							/*else
							{
								$result = $this->apply_model->apply($_POST,'add_document_data');
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('apply/apply_4/ins/'.$institute);
								}
								else
								{
									$this->session->set_flashdata('error', $result['msg']);
									redirect($this->agent->referrer());
								}
							}*/
						}
						else
						{							
							if($this->session->userdata('reg_user_id') != '')
							{
								
								$this->load->view('apply/apply_upload',$data);
							}
							else
							{
								redirect('apply/apply_logout/ins/'.$institute);
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
		$reg_user_id = $this->session->userdata('reg_user_id');
		
		//$institute = $this->session->userdata('institute_code');
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
				redirect('error');
			}
			else
			{
				$result = $this->apply_model->apply($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->apply_model->apply($program,'validate_program');
					if( $result['status'] )
					{
						$detail = array($reg_user_id,$program);
						$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
						$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
						$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
						$institute_list['profile'] = $this->apply_model->apply($institute,'get_profile_details'); 
						$institute_list['main_menu'] = $this->index_model->index_data($institute,'get_menu'); 
						$institute_list['header'] = '';
						$this->load->view('template_config/header_home',$institute_list);
						$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
						$data['document_data'] = $this->apply_model->apply($program,'get_document_data');
						$data['appl_status'] = $this->apply_model->apply($program,'get_appl_status');
						$data['doc_path'] = $this->apply_model->apply($program,'get_doc_path');
						$data['regdata'] = $this->apply_model->apply($program,'get_reg_id');
						$data['paymodedata'] = $this->apply_model->apply($program,'payModeQuery');
						$data['tempcodedata'] = $this->apply_model->apply($program,'tempcode');
						$data['categorydt'] = $this->apply_model->apply($program,'categorydata');
						$data['category_amount'] = $this->apply_model->apply($program,'category_amount_change');
						$data['amount_arr'] = $this->apply_model->apply($program,'amount');
						$data['extra_amount_arr'] = $this->apply_model->apply($program,'extra_amount');
						$data['updatereg'] = $this->apply_model->apply($program,'update_reg_mode');
						$data['bankdata'] = $this->apply_model->apply($program,'bank_detail');
						$data['passstatus'] = $this->apply_model->apply($program,'pass_status');
						$data['depositmode'] = $this->apply_model->apply($program,'deposit');
						$data['challanData'] = $this->apply_model->apply($program,'get_challanData');
						$data['bankdetail'] = $this->apply_model->apply($program,'get_bankdetail');
						$data['want_program_group'] = $this->apply_model->apply($institute,'want_program_group');
						
						/////// template modal //////////////////////
						
						$data['choice_details_data'] = $this->apply_model->apply(NULL,'get_select_choice_details');
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
						$data['challandetails'] = $this->apply_model->apply($program,'get_challandetails');
						$data['select_graduation_course_temp'] = $this->apply_model->apply($detail,'select_graduation_course_temp');
						
						if( $this->input->post())
						{
							/*echo "hi";
							print_r($_POST);*/
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
								$result = $this->apply_model->apply($_POST,'add_payment_data');
								//$result = $this->apply_model->apply($_POST,'Bank_challan_submit');
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['status']);
									redirect('apply/apply_4/ins/'.$institute);
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
							//echo 'hi5', die();						
							if($this->session->userdata('reg_user_id') != '')
							{
								
								$this->load->view('apply/apply_4',$data);
							}
							else
							{
								redirect('apply/apply_logout/ins/'.$institute);
							}
						}
						$this->load->view('index/pages/footer_index',$institute_list);
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
	
	/**
	*	purpose : Authenticate user
	*/
	public function login()
	{
		# if post is not empty
		if( $this->input->post())
		{
			$result = $this->user_model->login();
			if( $result['status'] )
			{
				$this->session->set_flashdata('info', $result['msg']);
				redirect($result['index_page']);
			}
			else
			{
				$this->session->set_flashdata('error', $result['msg']);
				redirect($this->agent->referrer());
			}
			
			//redirect('superadmin_controller');
		}
		else
		{
			
			$this->load->view('user/login');
		}
	}
	/**
	*	purpose : Show dashboard
	*/	
	public function dashboard()
	{
		switch($this->role)
		{
			case 'ADMIN': 
				redirect('admin_controller/dashboard');
			break;
			case 'SUPERADMIN':
				redirect('superadmin_controller/dashboard');
			break;
			
			break;
		}
		$this->load->view('templates/admin_footer');
	}
	
	
	public function asseso()
	{				
     	$data = array();    	      	     
		
		$data['Name'] = $this->apply_model->apply(null,'get_student_first_name');
		$this->load->view('apply/exam_sso_cipet',$data);
	}
        
	// logout user 
	public function apply_logout()
	{
		$institute_code = $this->session->userdata('inscode');
		$ins = encrypt_decrypt('encrypt',$institute_code);
		if($institute_code == '')
		{
			$data = $this->uri->uri_to_assoc();
			$ins = $data['ins'];
		}
		$array_items = array('reg_user_id' => '', 'admcode' => '','inscode'=>'','appl_no'=>'','mode'=>'','step'=>'');
 		$this->session->unset_userdata($array_items);
		//$this->session->sess_destroy();
		
		//echo "apply/institute_page/ins/$ins";die();
		redirect("apply/institute_page/ins/$ins");
	}
	public function error()
	{
		$this->load->view('apply/error');
	}
	public function download_print_application()
	{
		$admcode = $this->session->userdata('admcode');
		$appl_no = $this->session->userdata('appl_no');
		$file_path = BASE_ADM_URL."/DOCUMENTS/".$admcode."/".$appl_no."/application_print.pdf";echo $file_path;die;
		/*echo $admcode;
		die();*/
		//die();
		$ext = 'pdf';
		
		function output_file($file, $name, $mime_type='')
		{
			if(!is_readable($file)) die('File not found or inaccessible!');

			$size = filesize($file);
			$name = rawurldecode($name);
			$known_mime_types=array(
			"pdf" => "application/pdf",
			"txt" => "text/plain",
			"html" => "text/html",
			"htm" => "text/html",
			"exe" => "application/octet-stream",
			"zip" => "application/zip",
			"doc" => "application/msword",
			"xls" => "application/vnd.ms-excel",
			"ppt" => "application/vnd.ms-powerpoint",
			"gif" => "image/gif",
			"png" => "image/png",
			"jpeg"=> "image/jpg",
			"jpg" => "image/jpg",
			"php" => "text/plain"
			);
			if($mime_type=='')
			{
				$file_extension = strtolower(substr(strrchr($file,"."),1));
				if(array_key_exists($file_extension, $known_mime_types)){
					$mime_type=$known_mime_types[$file_extension];
					$known_mime_type=$known_mime_types[$file_extension];
				} else 
				{
					$mime_type="application/force-download";
				};
			};

			@ob_end_clean();


			if(ini_get('zlib.output_compression'))
			ini_set('zlib.output_compression', 'Off');
			header('Content-Type: ' . $mime_type);
			header('Content-Disposition: attachment; filename="'.$name.'"');
			header("Content-Transfer-Encoding: binary");
			header('Accept-Ranges: bytes');
			header("Cache-control: private");
			header('Pragma: private');
			//header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			if(isset($_SERVER['HTTP_RANGE']))
			{
			list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
			list($range) = explode(",",$range,2);
			list($range, $range_end) = explode("-", $range);
			$range=intval($range);
			if(!$range_end) {
			$range_end=$size-1;
			} else {
			$range_end=intval($range_end);
			}
			$new_length = $range_end-$range+1;
			header("HTTP/1.1 206 Partial Content");
			header("Content-Length: $new_length");
			header("Content-Range: bytes $range-$range_end/$size");
			} else {
			$new_length=$size;
			header("Content-Length: ".$size);
			}
			$chunksize = 1*(1024*1024);
			$bytes_send = 0;
			if ($file = fopen($file, 'r'))
			{
			if(isset($_SERVER['HTTP_RANGE']))
			fseek($file, $range);

			while(!feof($file) &&
			(!connection_aborted()) &&
			($bytes_send<$new_length)
			)
			{
			$buffer = fread($file, $chunksize);
			print($buffer);
			flush();
			$bytes_send += strlen($buffer);
			}
			fclose($file);
			} else

			die('Error - can not open file.');
			die();
		}
			set_time_limit(0);
			$file_path=$file_path;

		  $file = $file_path;
		  $filename = $file_name;
		  if($ext == 'pdf')
		  {
		  	header('Content-type: application/pdf');
		  }
		 
		  
		  header('Content-Disposition: inline; filename="' . $filename . '"');
		  header('Content-Transfer-Encoding: binary');
		  header('Accept-Ranges: bytes');
		  @readfile($file);
	}
	
	public function template001_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template001_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template001_pdf($admcode, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template001_pdf($admcode, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template001_pdf($admcode, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template001_pdf($admcode, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template001_pdf($admcode, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template001_pdf($admcode, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template001_pdf($admcode, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template001_pdf($admcode, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template001_pdf($admcode, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template001_pdf($admcode, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template001_pdf($admcode, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template001_pdf($admcode, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template001_pdf($admcode, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template001_pdf($admcode, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template001_pdf($admcode, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template001_pdf($admcode, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template001_pdf($admcode, 'reference_details');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template001_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
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
    // ********************************************************* Result Pdf **************************************************************************//
    public function result_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['applicant_detail'] = $this->m_pdf_model->result_pdf($admcode, 'get_applicant_detail');
        $data['program_detail'] = $this->m_pdf_model->result_pdf($admcode, 'get_program_detail');
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/result_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        
        $pdfFilePath = "result_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/result_print.pdf', 'F');
		$this->load->view('pdf/result_pdf');
		$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
	// ********************************************************* End of Result Pdf **************************************************************************//
	public function template002_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template001_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template001_pdf($admcode, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template001_pdf($admcode, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template001_pdf($admcode, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template001_pdf($admcode, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template001_pdf($admcode, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template001_pdf($admcode, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template001_pdf($admcode, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template001_pdf($admcode, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template001_pdf($admcode, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template001_pdf($admcode, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template001_pdf($admcode, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template001_pdf($admcode, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template001_pdf($admcode, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template001_pdf($admcode, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template001_pdf($admcode, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template001_pdf($admcode, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template001_pdf($admcode, 'reference_details');
        $data['tech_qual_data_5'] = $this->m_pdf_model->template001_pdf($admcode,'get_tech_qual_data_5');
		$data['tech_qual_data_6'] = $this->m_pdf_model->template001_pdf($admcode,'get_tech_qual_data_6');
		$data['tech_qual_data_7'] = $this->m_pdf_model->template001_pdf($admcode,'get_tech_qual_data_7');
		
		
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template001_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template001_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        $pdf->AddPage();
        /*$data['type'] = "BOTTOM";
        $html = $this->load->view('pdf/template002_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html); */       
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		$this->load->view('pdf/template002_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
	public function template004_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template001_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template001_pdf($admcode, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template001_pdf($admcode, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template001_pdf($admcode, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template001_pdf($admcode, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template001_pdf($admcode, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template001_pdf($admcode, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template001_pdf($admcode, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template001_pdf($admcode, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template001_pdf($admcode, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template001_pdf($admcode, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template001_pdf($admcode, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template001_pdf($admcode, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template001_pdf($admcode, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template001_pdf($admcode, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template001_pdf($admcode, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template001_pdf($admcode, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template001_pdf($admcode, 'reference_details');
        $data['tech_qual_data_5'] = $this->m_pdf_model->template001_pdf($admcode,'get_tech_qual_data_5');
		$data['tech_qual_data_6'] = $this->m_pdf_model->template001_pdf($admcode,'get_tech_qual_data_6');
		$data['tech_qual_data_7'] = $this->m_pdf_model->template001_pdf($admcode,'get_tech_qual_data_7');
		$data['multiple_post'] = $this->m_pdf_model->template001_pdf($admcode,'get_post'); 
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template001_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template004_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        /*$pdf->AddPage();
        $data['type'] = "BOTTOM";
        $html = $this->load->view('pdf/template002_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html);  */      
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		$this->load->view('pdf/template002_pdf');
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
    
    
    public function applicant_logout()
	{
	 echo 'hi';
	/*	$this->session->unset_userdata('reg_user_id');
		$this->session->unset_userdata('institute_code');
		$this->session->unset_userdata('first_name');
		$this->session->unset_userdata('mode');
		$this->session->unset_userdata('step');
		$this->session->set_userdata('reg_user_id','');
		$this->session->sess_destroy();
		
		$this->session->set_flashdata('info', 'User logout');
		redirect('Index');*/
		
	}
	

}