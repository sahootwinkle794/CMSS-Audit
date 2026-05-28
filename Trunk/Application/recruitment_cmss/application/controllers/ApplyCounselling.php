<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ApplyCounselling extends CI_Controller
{
	private $role;
	
	public function __construct() 
	{
		parent::__construct();
		
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
		$this->load->model('ApplyCounselling_model');
		$this->load->model('m_pdf_model');
		$this->load->model('index_model');
		
		//$this->load->model('admin_model');
		//$this->load->model('getter_model');
		
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		
		//echo $this->session->userdata('reg_user_id');
   	}
   	/*
	*	purpose : to check whether the method is correct or not
	*/
	
	public function _remap($method)
	{
		$class 	= $this->router->class;
		//$role = $this->session->userdata('role');
		if( !$this->session->userdata('reg_user_id'))
		{
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
/*	public function index()
	{
		//$result = $this->index_model->institute();
		$this->load->model('index_model');
		$institute_list['institute'] = $this->index_model->index_data('','get_institutes');
		//print_r($institute_list);
		$this->load->view('index/index',$institute_list);
		$this->load->view('template_config/footer');
	}*/
	public function institute_page()
	{
		//$result = $this->index_model->institute();
		/*echo "hiiiiiiii";
		die();*/
		$data = $this->uri->uri_to_assoc();
		$institute = $data['ins'];
		/*echo $institute;
		die();*/
		
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
				
				$result = $this->ApplyCounselling_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					$ann_info['announcements'] = $this->index_model->index_data('','get_announcements');
					$this->load->view('template_config/header_index', $ann_info);
					$data1['counselling_dates'] = $this->ApplyCounselling_model->apply($institute,'get_counselling_dates');
					$data['institute_data'] = $this->ApplyCounselling_model->apply($institute,'get_institute_data');
					$data['appl_status'] = $this->ApplyCounselling_model->apply($institute,'get_appl_status');
					$data['appl_date'] = $this->ApplyCounselling_model->apply($institute,'get_appl_date');
					$data['program_data'] = $this->ApplyCounselling_model->apply($institute,'get_applicant_program');
					//$data['program_data'] = $this->ApplyCounselling_model->apply($institute,'get_program');
					//$this->load->view('template_config/header_index',$data1);
					$this->load->view('applyCounselling/institute_page',$data);
					$this->load->view('index/pages/footer');
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
				$result = $this->ApplyCounselling_model->apply($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->ApplyCounselling_model->apply($program,'validate_program');
					if( $result['status'] )
					{
						$this->load->view('template_config/header');
						if($this->session->userdata('admcode') != '')
						{
							$program = $this->session->userdata('admcode');
							$this->session->set_userdata('inscode', $institute_code);
							//$this->session->set_userdata('admcode', $program);
							$program_name = $this->ApplyCounselling_model->apply($program,'get_program_name');
							$this->session->set_userdata('admname', $program_name);
							$data['institute_data'] = $this->ApplyCounselling_model->apply($institute,'get_institute_data');
							$data['program_data'] = $this->ApplyCounselling_model->apply($program,'get_program_detail');
							$data['program_menu_data'] = $this->ApplyCounselling_model->apply($program,'get_program_menu');
							$data['program_admit_card_count'] = $this->ApplyCounselling_model->apply($program,'get_program_admit_card_count');
							//$data['program_admit_card_detail'] = $this->ApplyCounselling_model->apply($program,'get_program_admitcard_detail');
							$this->load->view('applyCounselling/project_index',$data);
							$this->load->view('template_config/footer');
						}
						else
						{
							//$program = $this->session->userdata('admcode');
							$this->session->set_userdata('inscode', $institute_code);
							$this->session->set_userdata('admcode', $program);
							$program_name = $this->ApplyCounselling_model->apply($program,'get_program_name');
							$this->session->set_userdata('admname', $program_name);
							$data['institute_data'] = $this->ApplyCounselling_model->apply($institute,'get_institute_data');
							$data['program_data'] = $this->ApplyCounselling_model->apply($program,'get_program_detail');
							$data['program_menu_data'] = $this->ApplyCounselling_model->apply($program,'get_program_menu');
							$data['program_admit_card_count'] = $this->ApplyCounselling_model->apply($program,'get_program_admit_card_count');
							//$data['program_admit_card_setup'] = $this->ApplyCounselling_model->apply($program,'get_program_admitcard_setup');
							//$data['program_admit_card_detail'] = $this->ApplyCounselling_model->apply($program,'get_program_admitcard_detail');
							$this->load->view('applyCounselling/project_index',$data);
							$this->load->view('template_config/footer');
						}
						
					}
					
				}
				else
				{
					redirect('applyCounselling/apply_logout');
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
				$result = $this->ApplyCounselling_model->apply($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->ApplyCounselling_model->apply($program,'validate_program');
					if( $result['status'] )
					{
						$this->load->view('template_config/header');
						$data['institute_data'] = $this->ApplyCounselling_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->ApplyCounselling_model->apply($program,'get_program_detail');
						$template_file = $this->ApplyCounselling_model->apply($program,'get_program_template');
						$data['mandatory_field'] = $this->ApplyCounselling_model->apply($program,'get_mandatory_fields');
						//$data['program_admit_card_setup'] = $this->ApplyCounselling_model->apply($program,'get_program_admitcard_setup');
						//$data['program_admit_card_detail'] = $this->ApplyCounselling_model->apply($program,'get_program_admitcard_detail');
					
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
								$result = $this->ApplyCounselling_model->apply($_POST,'insert_registration_data');
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
								redirect('applyCounselling/'.$template_file.'/ins/'.$institute);
							}
							else
							{
								$this->load->view('applyCounselling/apply_1',$data);
							}
							
						}
						$this->load->view('template_config/footer');
					}
					else
					{
						redirect('applyCounselling/apply_logout/ins/'.$institute);
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
				
				$result = $this->ApplyCounselling_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
					$result = $this->ApplyCounselling_model->apply($program,'validate_program');
					if( $result['status'] )
					{
						$this->load->view('template_config/header');
						$template_file = $this->ApplyCounselling_model->apply($program,'get_program_template');
						$data['institute_data'] = $this->ApplyCounselling_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->ApplyCounselling_model->apply($program,'get_program_detail');
						//$data['program_admit_card_setup'] = $this->ApplyCounselling_model->apply($program,'get_program_admitcard_setup');
						//$data['program_admit_card_detail'] = $this->ApplyCounselling_model->apply($program,'get_program_admitcard_detail');
						
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
								$result = $this->ApplyCounselling_model->apply($_POST,'verify_registration_data');
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
								redirect('applyCounselling/'.$template_file.'/ins/'.$institute);
							}
							else
							{
								$this->load->view('applyCounselling/apply_2',$data);
							}
						}
						$this->load->view('template_config/footer');
					}
					else
					{
						redirect('applyCounselling/apply_logout/ins/'.$institute);
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
				
				$result = $this->ApplyCounselling_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
					$result = $this->ApplyCounselling_model->apply($program,'validate_program');
					if( $result['status'] )
					{
						$this->load->view('template_config/header');
						$data['institute_data'] = $this->ApplyCounselling_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->ApplyCounselling_model->apply($program,'get_program_detail');
						//$data['program_admit_card_setup'] = $this->ApplyCounselling_model->apply($program,'get_program_admitcard_setup');
						//$data['program_admit_card_detail'] = $this->ApplyCounselling_model->apply($program,'get_program_admitcard_detail');
						
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
								$result = $this->ApplyCounselling_model->apply($_POST,'verify_application_data');
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('applyCounselling/download_print_application');
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
							
							$this->load->view('applyCounselling/download_application',$data);
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
				
				$result = $this->ApplyCounselling_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
					$result = $this->ApplyCounselling_model->apply($program,'validate_program');
					if( $result['status'] )
					{
						$this->load->view('template_config/header');
						$data['institute_data'] = $this->ApplyCounselling_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->ApplyCounselling_model->apply($program,'get_program_detail');
						
						//$data['program_admit_card_count'] = $this->ApplyCounselling_model->apply($program,'get_program_admit_card_count');
						$data['program_admit_card_count'] = $this->ApplyCounselling_model->apply($program,'get_program_admit_card_count');
						
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
								$result = $this->ApplyCounselling_model->apply($_POST,'chk_admt_card_data');
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('applyCounselling/admit_card');
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
							
							$this->load->view('applyCounselling/download_application',$data);
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
	public function admit_card() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        
        $program_code = $this->session->userdata('admcode');
		$exam_centre_code = $this->session->userdata('exam_center_code');
		$exam_vanue = $this->session->userdata('exam_vanue_code');
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
            'from' => $from,
            'to' => $to
        );
        $data['applicantSRow'] = $this->m_pdf_model->admit_card_pdf($data,'get_application_detail');
        
        $data['type'] = "ADMIT_CARD";
                
		$html = $this->load->view('pdf/admit_card', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        
        $pdfFilePath = "admit_card_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //generate the PDF!
        $pdf->WriteHTML($html);
        
        $data['type'] = "FOOTER";
        $html = $this->load->view('pdf/admit_card', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->defaultfooterline = 0;
		$pdf->setFooter($footer);
      	$pdf->WriteHTML($html);        
      	
		$uploaddir = DOCUMENT_UPLOAD_URL.'/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/admit_card_print_008.pdf', 'I');
		//$this->load->view('pdf/template008_pdf');	
		/*$pdf->Output($applicantNumber.".pdf",'I');*/	
		//return true;
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
				
				$result = $this->ApplyCounselling_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
					$result = $this->ApplyCounselling_model->apply($program,'validate_program');
					if( $result['status'] )
					{
						$this->load->view('template_config/header_index');
						
						$data['institute_data'] = $this->ApplyCounselling_model->apply($institute,'get_institute_data');
						$data['program_data'] = $this->ApplyCounselling_model->apply($program,'get_program_detail');
						$data['registration_data'] = $this->ApplyCounselling_model->apply($program,'get_registration_data');
						$data['application_data'] = $this->ApplyCounselling_model->apply($program,'get_application_data');
						$data['applicant_data'] = $this->ApplyCounselling_model->apply($program,'get_applicant_data');
						$data['present_communication_data'] = $this->ApplyCounselling_model->apply($program,'get_present_communication_data');

						$data['permanent_communication_data'] = $this->ApplyCounselling_model->apply($program,'get_permanent_communication_data');
						$data['father_data'] = $this->ApplyCounselling_model->apply($program,'get_father_data');
						$data['mother_data'] = $this->ApplyCounselling_model->apply($program,'get_mother_data');
						$data['guardian_data'] = $this->ApplyCounselling_model->apply($program,'get_guardian_data');
						$data['academic_qual_data'] = $this->ApplyCounselling_model->apply($program,'get_academic_qual_data');
						$data['allNationalities'] = $this->ApplyCounselling_model->apply($program,'get_nationality_data');
						$data['allRelationship'] = $this->ApplyCounselling_model->apply($program,'get_relationship_data');
						$data['allCategories'] = $this->ApplyCounselling_model->apply($program,'get_category_data');
						$data['allReligions'] = $this->ApplyCounselling_model->apply($program,'get_religion_data');
						$data['allMinority'] = $this->ApplyCounselling_model->apply($program,'get_minority_data');
						//print_r($data['allMinority']);
						$data['allDistricts'] = $this->ApplyCounselling_model->apply($program,'get_district_data');
						$data['allStates'] = $this->ApplyCounselling_model->apply($program,'get_state_data');
						$data['documentsReq'] = $this->ApplyCounselling_model->apply($program,'get_documents_required');
						$data['allQualifications'] = $this->ApplyCounselling_model->apply($program,'get_qualification_data');
						$data['allHighestQualifications'] = $this->ApplyCounselling_model->apply($program,'get_highest_qualification');
						//$data['allHonoursSubject'] = $this->ApplyCounselling_model->apply($program,'get_honours_subject');
						//$data['program_admit_card_setup'] = $this->ApplyCounselling_model->apply($program,'get_program_admitcard_setup');
						//$data['program_admit_card_detail'] = $this->ApplyCounselling_model->apply($program,'get_program_admitcard_detail');
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
								$result = $this->ApplyCounselling_model->apply($_POST,'add_application_data');
								//print_r($result);die();
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('applyCounselling/apply_3/ins/'.$institute);
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
								
								$this->load->view('applyCounselling/template003',$data);
							}
							else
							{
								redirect('applyCounselling/apply_logout');
							}
							
						}
						$this->load->view('index/pages/footer');
					}
					else
					{
						redirect('applyCounselling/apply_logout/ins/'.$institute);
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











	public function template008()
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
				
				$result = $this->ApplyCounselling_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
					$result = $this->ApplyCounselling_model->apply($program,'validate_counselling_code');
					/*echo $result['status'];
					echo "hiii";
					die();*/
					if( $result['status'] )
					{
						$ann_info['announcements'] = $this->index_model->index_data('','get_announcements');
						$this->load->view('template_config/header_index', $ann_info);
						
						$data['institute_data'] = $this->ApplyCounselling_model->apply($institute,'get_institute_data');
						$data['applicant_data'] = $this->ApplyCounselling_model->apply($program,'get_applicant_data');
						$data['appl_status'] = $this->ApplyCounselling_model->apply($institute,'get_appl_status');
						$data['registration_data'] = $this->ApplyCounselling_model->apply($program,'get_registration_data');
						
						
						$data['program_data'] = $this->ApplyCounselling_model->apply($program,'get_program_detail');
						$data['course_data'] = $this->ApplyCounselling_model->apply($program,'get_course_detail');
						
						$data['application_data'] = $this->ApplyCounselling_model->apply($program,'get_application_data');
						//$data['applicant_data'] = $this->ApplyCounselling_model->apply($program,'get_applicant_data');
						$data['present_communication_data'] = $this->ApplyCounselling_model->apply($program,'get_present_communication_data');
						$data['permanent_communication_data'] = $this->ApplyCounselling_model->apply($program,'get_permanent_communication_data');
						$data['father_data'] = $this->ApplyCounselling_model->apply($program,'get_father_data');
						$data['mother_data'] = $this->ApplyCounselling_model->apply($program,'get_mother_data');
						$data['mother_data'] = $this->ApplyCounselling_model->apply($program,'get_mother_data');
						$data['guardian_data'] = $this->ApplyCounselling_model->apply($program,'get_guardian_data');
						$data['academic_qual_data'] = $this->ApplyCounselling_model->apply($program,'get_academic_qual_data');
						$data['allNationalities'] = $this->ApplyCounselling_model->apply($program,'get_nationality_data');
						$data['allCategories'] = $this->ApplyCounselling_model->apply($program,'get_category_data');
						$data['allReligions'] = $this->ApplyCounselling_model->apply($program,'get_religion_data');
						$data['allMinority'] = $this->ApplyCounselling_model->apply($program,'get_minority_data');
						//print_r($data['allMinority']);
						$data['allDistricts'] = $this->ApplyCounselling_model->apply($program,'get_district_data');
						$data['allStates'] = $this->ApplyCounselling_model->apply($program,'get_state_data');
						$data['documentsReq'] = $this->ApplyCounselling_model->apply($program,'get_documents_required');
						$data['allQualifications'] = $this->ApplyCounselling_model->apply($program,'get_qualification_data');
						$data['allHighestQualifications'] = $this->ApplyCounselling_model->apply($program,'get_highest_qualification');
					
						
						if( $this->input->post())
						{
							redirect('applyCounselling/apply_3/ins/'.$institute);					
							
						}
						else
						{							
							if($this->session->userdata('reg_user_id') != '')
							{
								
								$this->load->view('applyCounselling/template008',$data);
							}
							else
							{
								redirect('applyCounselling/apply_logout');
							}
							
						}
						$this->load->view('index/pages/footer');
					}
					else
					{
						redirect('applyCounselling/apply_logout/ins/'.$institute);
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
				
				$result = $this->ApplyCounselling_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
					$result = $this->ApplyCounselling_model->apply($program,'validate_counselling_code');
					if( $result['status'] )
					{
						$ann_info['announcements'] = $this->index_model->index_data('','get_announcements');
						$this->load->view('template_config/header_index', $ann_info);
						$data['institute_data'] = $this->ApplyCounselling_model->apply($institute,'get_institute_data');
						$data['appl_status'] = $this->ApplyCounselling_model->apply($institute,'get_appl_status');
						$data['document_data'] = $this->ApplyCounselling_model->apply($program,'get_document_data');
						//$data['program_data'] = $this->ApplyCounselling_model->apply($program,'get_program_detail');
						$data['doc_path'] = $this->ApplyCounselling_model->apply($program,'get_doc_path');
						
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
								$result = $this->ApplyCounselling_model->apply($_POST,'add_document_data');
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('applyCounselling/apply_4/ins/'.$institute);
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
								$this->load->view('applyCounselling/apply_3',$data);
							}
							else
							{
								redirect('applyCounselling/apply_logout/ins/'.$institute);
							}
						}
						$this->load->view('index/pages/footer');
					}
					else
					{
						redirect('applyCounselling/apply_logout/ins/'.$institute);
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
				$result = $this->ApplyCounselling_model->apply($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->ApplyCounselling_model->apply($program,'validate_counselling_code');
					if( $result['status'] )
					{
						$ann_info['announcements'] = $this->index_model->index_data('','get_announcements');
						$this->load->view('template_config/header_index', $ann_info);
						$data['institute_data'] = $this->ApplyCounselling_model->apply($institute,'get_institute_data');
						//$data['program_data'] = $this->ApplyCounselling_model->apply($program,'get_program_detail');
						$data['document_data'] = $this->ApplyCounselling_model->apply($program,'get_document_data');
						$data['appl_status'] = $this->ApplyCounselling_model->apply($program,'get_appl_status');
						$data['doc_path'] = $this->ApplyCounselling_model->apply($program,'get_doc_path');
						$data['regdata'] = $this->ApplyCounselling_model->apply($program,'get_reg_id');
						$data['paymodedata'] = $this->ApplyCounselling_model->apply($program,'payModeQuery');
						$data['categorydt'] = $this->ApplyCounselling_model->apply($program,'categorydata');
						$data['amount'] = $this->ApplyCounselling_model->apply($program,'amount');
						$data['passstatus'] = $this->ApplyCounselling_model->apply($program,'pass_status');
						$data['bankdata'] = $this->ApplyCounselling_model->apply($program,'bank_detail');
						$data['depositmode'] = $this->ApplyCounselling_model->apply($program,'deposit');
						//$data['tempcodedata'] = $this->ApplyCounselling_model->apply($program,'tempcode');
						//$data['updatereg'] = $this->ApplyCounselling_model->apply($program,'update_reg_mode');
						//$data['bankdata'] = $this->ApplyCounselling_model->apply($program,'bank_detail');
						//$data['passstatus'] = $this->ApplyCounselling_model->apply($program,'pass_status');
						//$data['depositmode'] = $this->ApplyCounselling_model->apply($program,'deposit');
						//$data['challanData'] = $this->ApplyCounselling_model->apply($program,'get_challanData');
						//$data['bankdetail'] = $this->ApplyCounselling_model->apply($program,'get_bankdetail');
						
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
								$result = $this->ApplyCounselling_model->apply($_POST,'add_payment_data');
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['status']);
									redirect('applyCounselling/apply_4/ins/'.$institute);
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
								$this->load->view('applyCounselling/apply_4',$data);
							}
							else
							{
								redirect('applyCounselling/apply_logout/ins/'.$institute);
							}
						}
						$this->load->view('index/pages/footer');
					}
					else
					{
						redirect('applyCounselling/apply_logout/ins/'.$institute);
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
	
	public function payment_page()
	{
		$program = $this->session->userdata('admcode');
		
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
				$result = $this->ApplyCounselling_model->apply($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->ApplyCounselling_model->apply($program,'validate_counselling_code');
					if( $result['status'] )
					{
						$ann_info['announcements'] = $this->index_model->index_data('','get_announcements');
						$this->load->view('template_config/header_index', $ann_info);
						$data['institute_data'] = $this->ApplyCounselling_model->apply($institute,'get_institute_data');
						//$data['program_data'] = $this->ApplyCounselling_model->apply($program,'get_program_detail');
						$data['document_data'] = $this->ApplyCounselling_model->apply($program,'get_document_data');
						$data['appl_status'] = $this->ApplyCounselling_model->apply($program,'get_appl_status');
						$data['doc_path'] = $this->ApplyCounselling_model->apply($program,'get_doc_path');
						$data['regdata'] = $this->ApplyCounselling_model->apply($program,'get_reg_id');
						$data['paymodedata'] = $this->ApplyCounselling_model->apply($program,'payModeQuery');
						$data['categorydt'] = $this->ApplyCounselling_model->apply($program,'categorydata');
						$data['amount'] = $this->ApplyCounselling_model->apply($program,'amount');
						$data['passstatus'] = $this->ApplyCounselling_model->apply($program,'pass_status');
						$data['bankdata'] = $this->ApplyCounselling_model->apply($program,'bank_detail');
						$data['depositmode'] = $this->ApplyCounselling_model->apply($program,'deposit');
						//$data['tempcodedata'] = $this->ApplyCounselling_model->apply($program,'tempcode');
						//$data['updatereg'] = $this->ApplyCounselling_model->apply($program,'update_reg_mode');
						//$data['bankdata'] = $this->ApplyCounselling_model->apply($program,'bank_detail');
						//$data['passstatus'] = $this->ApplyCounselling_model->apply($program,'pass_status');
						//$data['depositmode'] = $this->ApplyCounselling_model->apply($program,'deposit');
						//$data['challanData'] = $this->ApplyCounselling_model->apply($program,'get_challanData');
						//$data['bankdetail'] = $this->ApplyCounselling_model->apply($program,'get_bankdetail');
						
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
								$result = $this->ApplyCounselling_model->apply($_POST,'add_payment_data');
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['status']);
									redirect('applyCounselling/apply_4/ins/'.$institute);
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
								$this->load->view('applyCounselling/payment_page',$data);
							}
							else
							{
								redirect('applyCounselling/apply_logout/ins/'.$institute);
							}
						}
						$this->load->view('index/pages/footer');
					}
					else
					{
						redirect('applyCounselling/apply_logout/ins/'.$institute);
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
	
	public function choice_locking_page()
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
				
				$result = $this->ApplyCounselling_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
					$result = $this->ApplyCounselling_model->apply($program,'validate_counselling_code');
					
					if( $result['status'] )
					{
						$ann_info['announcements'] = $this->index_model->index_data('','get_announcements');
						$this->load->view('template_config/header_index', $ann_info);
						
						$data['institute_data'] = $this->ApplyCounselling_model->apply($institute,'get_institute_data');
						$data['applicant_data'] = $this->ApplyCounselling_model->apply($program,'get_applicant_data');
						$data['appl_status'] = $this->ApplyCounselling_model->apply($institute,'get_appl_status');
						$data['registration_data'] = $this->ApplyCounselling_model->apply($program,'get_registration_data');
						$data['appl_date'] = $this->ApplyCounselling_model->apply($institute,'get_appl_date');
						$data['lock_status'] = $this->ApplyCounselling_model->apply($program,'get_lock_status');
						$data['choices_count'] = $this->ApplyCounselling_model->apply($program,'get_choices_count');
					
						
						if( $this->input->post())
						{
							redirect('applyCounselling/apply_3/ins/'.$institute);					
							
						}
						else
						{							
							if($this->session->userdata('reg_user_id') != '')
							{
								
								$this->load->view('applyCounselling/choice_locking',$data);
							}
							else
							{
								redirect('applyCounselling/apply_logout');
							}
							
						}
						$this->load->view('index/pages/footer');
					}
					else
					{
						redirect('applyCounselling/apply_logout/ins/'.$institute);
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
	public function manually_choice_locking_page()
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
				
				$result = $this->ApplyCounselling_model->apply($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
					$result = $this->ApplyCounselling_model->apply($program,'validate_counselling_code');
					
					if( $result['status'] )
					{
						$ann_info['announcements'] = $this->index_model->index_data('','get_announcements');
						$this->load->view('template_config/header_index', $ann_info);
						
						$data['institute_data'] = $this->ApplyCounselling_model->apply($institute,'get_institute_data');
						$data['applicant_data'] = $this->ApplyCounselling_model->apply($program,'get_applicant_data');
						$data['appl_status'] = $this->ApplyCounselling_model->apply($institute,'get_appl_status');
						$data['registration_data'] = $this->ApplyCounselling_model->apply($program,'get_registration_data');
						$data['appl_date'] = $this->ApplyCounselling_model->apply($institute,'get_appl_date');
						$data['lock_status'] = $this->ApplyCounselling_model->apply($program,'get_lock_status');
						$data['choices_count'] = $this->ApplyCounselling_model->apply($program,'get_choices_count');
					
						
						if( $this->input->post())
						{
							redirect('applyCounselling/apply_3/ins/'.$institute);					
							
						}
						else
						{							
							if($this->session->userdata('reg_user_id') != '')
							{
								$reg_user_id = $this->session->userdata('reg_user_id');
								
								$data['temporay_details'] = $this->ApplyCounselling_model->apply($reg_user_id,'delete_temporary_data');
								$data['institute_data_applicant'] = $this->ApplyCounselling_model->apply($reg_user_id,'get_applicant_wise_institute_data');
								$this->load->view('applyCounselling/manually_choice_locking',$data);
							}
							else
							{
								redirect('applyCounselling/apply_logout');
							}
							
						}
						$this->load->view('index/pages/footer');
					}
					else
					{
						redirect('applyCounselling/apply_logout/ins/'.$institute);
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
		$this->session->sess_destroy();
		
		//echo "apply/institute_page/ins/$ins";
		redirect("applyCounselling/institute_page/ins/$ins");
	}
	public function error()
	{
		$this->load->view('applyCounselling/error');
	}
	public function download_print_application()
	{
		$admcode = $this->session->userdata('admcode');
		$appl_no = $this->session->userdata('appl_no');
		$file_path = BASE_ADM_URL."/".$admcode."/".$appl_no."/application_print.pdf";
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
		/*if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print_008.pdf', 'F');
		$this->load->view('pdf/template008_pdf');*/	
		$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 

	public function download_choice_locking_application(){
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
       //$objMpdf = new Mpdf_controller();
		/*$controllerInstance = & get_instance();
		$return = $controllerInstance->*/
		
		$reg_user_id = $this->session->userdata('reg_user_id');
		$appl_no = $this->session->userdata('appl_no');
		
		
		$this->choice_locking_pdf();
       
		
		$data = array(
            'reg_user_id' => $reg_user_id
        );
        //$result = $this->m_pdf_model->application_data($data,'get_appln_no');
        
        
        //print_r($result['appl_no']);
        //$appl_no = $result['appl_no'];
       
        $file_path = DOCUMENT_UPLOAD_URL."/".$admcode."/".$appl_no."/application_print_008.pdf";
        /*ECHO $file_path;
        die();*/
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
	
	public function choice_locking_pdf() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $institute_code = $this->session->userdata('institute_code');
       
        $data['locked_data'] = $this->m_pdf_model->choice_locking_pdf($order_id, 'get_locked_data');
        $data['counselling_name'] = $this->m_pdf_model->choice_locking_pdf($order_id, 'get_counselling_name');
        $data['institute_details'] = $this->m_pdf_model->choice_locking_pdf($order_id, 'get_institute_details');
        $data['applicant_details'] = $this->m_pdf_model->choice_locking_pdf($order_id, 'get_applicant_details');
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
        $pdfFilePath = "choice_locking_pdf-" . time() . "-download.pdf";
                
		$html = $this->load->view('pdf/choice_locking_pdf', $data); //load the pdf_output.php by passing our data and get all data in $html varriable.
        
       
        
		//actually, you can pass mPDF parameter on this load() function
        /*$pdf = $this->m_pdf->load();
        //generate the PDF!
        $pdf->WriteHTML($html);*/
            
       /* $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/'.$applicantNumber;*/
		ob_clean();
		/*if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/applicant_choice_locking_print.pdf', 'F');
		//$this->load->view('pdf/template008_pdf');	
		$pdf->Output($applicantNumber.".pdf",'I');	*/
		/*return true;*/
    } 

	public function download_counselling_letter() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $institute_code = $this->session->userdata('institute_code');
       
        $data['nodal_centre_details'] = $this->m_pdf_model->counselling_letter_pdf($order_id, 'get_nodal_centre_details');
        $data['counselling_name'] = $this->m_pdf_model->counselling_letter_pdf($order_id, 'get_counselling_name');
        $data['institute_details'] = $this->m_pdf_model->counselling_letter_pdf($order_id, 'get_institute_details');
        $data['applicant_details'] = $this->m_pdf_model->counselling_letter_pdf($order_id, 'get_applicant_details');
        $data['document_details'] = $this->m_pdf_model->counselling_letter_pdf($order_id, 'get_document_details');
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
        
                
		$html = $this->load->view('pdf/counselling_letter_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        
        $pdfFilePath = "counselling_letter_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //generate the PDF!
        $pdf->WriteHTML($html);
            
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/applicant_counselling_letter_print.pdf', 'F');
		//$this->load->view('pdf/template008_pdf');	
		$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 

	public function download_allotment_letter() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $institute_code = $this->session->userdata('institute_code');
       
        $data['seat_allotment_details'] = $this->m_pdf_model->allotment_letter_pdf($order_id, 'get_seat_allotment_details');
        $data['institute_details'] = $this->m_pdf_model->allotment_letter_pdf($order_id, 'get_institute_details');
        $data['applicant_details'] = $this->m_pdf_model->allotment_letter_pdf($order_id, 'get_applicant_details');
        $data['document_details'] = $this->m_pdf_model->allotment_letter_pdf($order_id, 'get_document_details');
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
        
                
		$html = $this->load->view('pdf/allotment_letter_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        
        $pdfFilePath = "allotment_letter_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //generate the PDF!
        $pdf->WriteHTML($html);
            
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/applicant_allotment_letter_print.pdf', 'F');
		//$this->load->view('pdf/template008_pdf');	
		$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
	

}