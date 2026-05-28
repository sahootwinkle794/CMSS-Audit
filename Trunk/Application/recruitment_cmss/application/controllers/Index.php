<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller
{
	private $role;
	
	public function __construct() {

		parent::__construct();
		
		# helpers
		$this->load->helper(array('form'));		
		$this->load->helper('custom_encryption');		
		$this->load->helper('custom_security');	
		# libraries
		$this->load->library('form_validation');
		$this->load->library('user_agent');
		
		$this->role = $this->session->userdata('role');
		
		# models
		$this->load->model('user_model');
		$this->load->model('apply_model');
		//$this->load->model('admin_model');
		//$this->load->model('getter_model');
		
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		$this->load->model('index_model');
		
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
		//echo phpinfo();die();
		redirect(BASE_URL.'Index/institute_index/ins/RECINS001');
		
		$this->load->model('index_model');
		$institute_list['institute'] = $this->index_model->index_data('','get_institutes_index');
		
		//print_r($institute_list);
		//echo encrypt_decrypt('encrypt', 'hello');
		$this->load->view('index/index_ins',$institute_list);
		$this->load->view('template_config/footer');
	}
	public function institute_not_found()
	{
		$this->load->view('index/institute_not_found');
	}
	public function document_not_found()
	{
		$this->load->view('index/document_not_found');
	}
	public function api_get_postname(){
		echo json_encode($this->index_model->index_data('RECINS001','get_postname')); 
	}
	public function institute_index()
	{
		$institute = $this->uri->segment(4); // 1stsegment
		/*if($institute =='DAVLRC' || $institute =='DAVRBC' || $institute =='DAVCDA' )
			redirect('Index/live_soon');*/
		$ins =  encrypt_decrypt('encrypt', $institute);
		//$result = $this->index_model->institute();
		//$result = $this->index_model->institute();
		/*$data = $this->uri->uri_to_assoc();
		$institute = $data['ins'];*/
		/*
		echo $data;
		die();*/
		if($institute != '')
		{
			$result = $this->apply_model->apply($ins,'validate_institute');
			if( $result['status'] == 1)
			{
				$institute_list['institute'] = $this->index_model->index_data($institute,'get_institutes');
				$this->load->view('template_config/header_index',$institute_list);
				$this->load->model('index_model');
				$institute_list['institute'] = $this->index_model->index_data($institute,'get_institutes');
				$institute_list['news_details'] = $this->index_model->index_data($institute,'get_newsevents');
				
				$institute_list['announcements'] = $this->index_model->index_data($institute,'get_announcements');
				$institute_list['latest_info'] = $this->index_model->index_data($institute,'get_latestinfo'); 
				$institute_list['ageMinDate'] = $this->index_model->index_data($institute,'get_ageMinDate'); 
				$institute_list['carouselData'] = $this->index_model->index_data($institute,'get_sliderImages'); 
				$institute_list['applicantResultCount'] = $this->index_model->index_data($institute,'get_applicant_result_count'); 
				$institute_list['program_data'] = $this->index_model->index_data($institute,'get_program_with_rank_data');
				$institute_list['notice_data'] = $this->index_model->index_data($institute,'get_notice_data');
				$institute_list['corrigendum_data'] = $this->index_model->index_data($institute,'get_corrigendum_data');
				$institute_list['advertise_data'] = $this->index_model->index_data($institute,'get_advertise_data');
				$institute_list['post_name'] = $this->index_model->index_data($institute,'get_post');
				/*$data['allStates'] = $this->apply_model->apply($program,'get_state_data');*/
				$this->load->view('index/index',$institute_list);
				 

				//$this->load->view('index/pages/home',$data);
				$this->load->view('index/pages/footer',$institute_list);
				if( $this->input->post())
				{
					if(isset($_POST['btnlogin'])){
						$inputCaptcha = $this->input->post('txtCaptcha');
		    			$sessCaptcha = $this->session->userdata('captchaCode');
		    			//echo $inputCaptcha . '#'.$sessCaptcha;
						if($inputCaptcha != '' && $inputCaptcha != $sessCaptcha )
						{
							$data = array(
				                'status' => 'captchaerror',
				                'msg' => 'Invalid Captcha. Please try again.'
				            );
							$this->session->set_flashdata('error', $data['msg']);
							$this->session->set_flashdata('post_data', $this->input->post());
							redirect($this->agent->referrer());
						}
						$config = array(
							array(
			                     'field'   => 'txtCandidatePhone',
			                     'label'   => 'Mobile Number',
			                     'rules'   => 'trim|required'
			                  ),
							array(
			                     'field'   => 'txtdob',
			                     'label'   => 'Date of Birth',
			                     'rules'   => 'trim|required'
			                  ) 
				        );
						$this->form_validation->set_rules($config);
						if ($this->form_validation->run() == FALSE) {
							$data = array(
				                'status' => 'validationerror',
				                'msg' => validation_errors()
				            );
				            $this->session->set_flashdata('error', $data['msg']);
				            $this->session->set_flashdata('post_data', $this->input->post());
							redirect($this->agent->referrer());
						}
						else
						{
							$result = $this->apply_model->apply($_POST,'verify_registration_data');
							if( $result['status'] )
							{
								$this->session->set_flashdata('info', $result['msg']);
								//redirect('apply/form_detail/ins/'.$result['enc_ins']);
								redirect('apply/institute_page/ins/'.$result['enc_ins']);
							}
							else
							{
								$this->session->set_flashdata('error', $result['msg']);
								$this->session->set_flashdata('post_data', $this->input->post());
								redirect($this->agent->referrer());
							}
						}
					}
					else if(isset($_POST['btnRegister']))
					{
					   	$program = $this->session->userdata('admcode');
						//$data = $this->uri->uri_to_assoc();
						$institute = encrypt_decrypt('encrypt',$institute);
					
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
							$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
							$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
							//print_r($data['institute_data']);die();
							$inputCaptcha = $this->input->post('txtCaptcha');
	        				$sessCaptcha = $this->session->userdata('captchaCode');
	        				//echo $inputCaptcha .'#'. $sessCaptcha; die();
	        				
							if($inputCaptcha != '' && $inputCaptcha != $sessCaptcha )
							{
								$data = array(
					                'status' => 'captchaerror',
					                'msg' => 'Security code did not match'
					            );
								$this->session->set_flashdata('error', $data['msg']);
								$this->session->set_flashdata('post_data', $this->input->post());
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
								//echo "2"; die();
								$data = array(
					                'status' => 'xsserror',
					                'msg' => 'Special chararacters like <,>,=,(,),&lt;,&gt; are not allowed'
					            );
								$this->session->set_flashdata('error', $data['msg']);
								$this->session->set_flashdata('post_data', $this->input->post());
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
					                     'field'   => 'txtdob1',
					                     'label'   => 'Date of Birth',
					                     'rules'   => 'trim|required'
					                ),
					                array(
					                     'field'   => 'cmbState',
					                     'label'   => 'State',
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
					            $this->session->set_flashdata('post_data', $this->input->post());
								redirect($this->agent->referrer());
							}
							else
							{
								$result = $this->apply_model->apply($_POST,'insert_registration_data');
								
								$data1['status'] = $result['status']; 
								
								if( $result['status'])
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect($this->agent->referrer());
								}
								else
								{
									$this->session->set_flashdata('error', $result['msg']);
									$this->session->set_flashdata('post_data', $this->input->post());
									redirect($this->agent->referrer());
								}
							}
						}
			    	}
				    else{
						
					}
					
				}
			}
			else
			{
				redirect('index/institute_not_found');
			}
		}
	}
	public function view_all()
	{
		$institute = $this->uri->segment(3); // 1stsegment
		/*if($institute =='DAVLRC' || $institute =='DAVRBC' || $institute =='DAVCDA' )
			redirect('Index/live_soon');*/
		$ins =  encrypt_decrypt('encrypt', $institute);
		//$result = $this->index_model->institute();
		//$result = $this->index_model->institute();
		/*$data = $this->uri->uri_to_assoc();
		$institute = $data['ins'];*/
		/*
		echo $data;
		die();*/
		if($institute != '')
		{
			$result = $this->apply_model->apply($ins,'validate_institute');
			if($result['status'] == 1)
			{
				$institute_list['institute'] = $this->index_model->index_data($institute,'get_institutes');
				$this->load->view('template_config/header_index',$institute_list);
				$this->load->model('index_model');
				$institute_list['institute'] = $this->index_model->index_data($institute,'get_institutes');
				$institute_list['news_details'] = $this->index_model->index_data($institute,'get_newsevents');
				$institute_list['announcements'] = $this->index_model->index_data($institute,'get_announcements');
				$institute_list['latest_info'] = $this->index_model->index_data($institute,'get_latestinfo'); 
				$institute_list['ageMinDate'] = $this->index_model->index_data($institute,'get_ageMinDate'); 
				$institute_list['carouselData'] = $this->index_model->index_data($institute,'get_sliderImages'); 
				$institute_list['applicantResultCount'] = $this->index_model->index_data($institute,'get_applicant_result_count'); 
				$institute_list['program_data'] = $this->index_model->index_data($institute,'get_program_with_rank_data');
				$institute_list['advertise_data'] = $this->index_model->index_data($institute,'get_advertise_data');
				$institute_list['post_name'] = $this->index_model->index_data($institute,'get_post');

				/*$data['allStates'] = $this->apply_model->apply($program,'get_state_data');*/
				$this->load->view('index/pages/view_all',$institute_list);
				 

				//$this->load->view('index/pages/home',$data);
				$this->load->view('index/pages/footer',$institute_list);
				if( $this->input->post())
				{
					if(isset($_POST['btnlogin'])){
						$inputCaptcha = $this->input->post('txtCaptcha');
		    			$sessCaptcha = $this->session->userdata('captchaCode');
		    			//echo $inputCaptcha . '#'.$sessCaptcha;
						if($inputCaptcha != '' && $inputCaptcha != $sessCaptcha )
						{
							$data = array(
				                'status' => 'captchaerror',
				                'msg' => 'Invalid Captcha. Please try again.'
				            );
							$this->session->set_flashdata('error', $data['msg']);
							$this->session->set_flashdata('post_data', $this->input->post());
							redirect($this->agent->referrer());
						}
						$config = array(
							array(
			                     'field'   => 'txtCandidatePhone',
			                     'label'   => 'Mobile Number',
			                     'rules'   => 'trim|required'
			                  ),
							array(
			                     'field'   => 'txtdob',
			                     'label'   => 'Date of Birth',
			                     'rules'   => 'trim|required'
			                  ) 
				        );
						$this->form_validation->set_rules($config);
						if ($this->form_validation->run() == FALSE) {
							$data = array(
				                'status' => 'validationerror',
				                'msg' => validation_errors()
				            );
				            $this->session->set_flashdata('error', $data['msg']);
				            $this->session->set_flashdata('post_data', $this->input->post());
							redirect($this->agent->referrer());
						}
						else
						{
							$result = $this->apply_model->apply($_POST,'verify_registration_data');
							if( $result['status'] )
							{
								$this->session->set_flashdata('info', $result['msg']);
								//redirect('apply/form_detail/ins/'.$result['enc_ins']);
								redirect('apply/institute_page/ins/'.$result['enc_ins']);
							}
							else
							{
								$this->session->set_flashdata('error', $result['msg']);
								$this->session->set_flashdata('post_data', $this->input->post());
								redirect($this->agent->referrer());
							}
						}
					}
					else if(isset($_POST['btnRegister']))
					{
					   	$program = $this->session->userdata('admcode');
						//$data = $this->uri->uri_to_assoc();
						$institute = encrypt_decrypt('encrypt',$institute);
					
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
							$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
							$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
							//print_r($data['institute_data']);die();
							$inputCaptcha = $this->input->post('txtCaptcha');
	        				$sessCaptcha = $this->session->userdata('captchaCode');
	        				//echo $inputCaptcha .'#'. $sessCaptcha; die();
	        				
							if($inputCaptcha != '' && $inputCaptcha != $sessCaptcha )
							{
								$data = array(
					                'status' => 'captchaerror',
					                'msg' => 'Security code did not match'
					            );
								$this->session->set_flashdata('error', $data['msg']);
								$this->session->set_flashdata('post_data', $this->input->post());
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
								//echo "2"; die();
								$data = array(
					                'status' => 'xsserror',
					                'msg' => 'Special chararacters like <,>,=,(,),&lt;,&gt; are not allowed'
					            );
								$this->session->set_flashdata('error', $data['msg']);
								$this->session->set_flashdata('post_data', $this->input->post());
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
					                     'field'   => 'txtdob1',
					                     'label'   => 'Date of Birth',
					                     'rules'   => 'trim|required'
					                ),
					                array(
					                     'field'   => 'cmbState',
					                     'label'   => 'State',
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
					            $this->session->set_flashdata('post_data', $this->input->post());
								redirect($this->agent->referrer());
							}
							else
							{
								$result = $this->apply_model->apply($_POST,'insert_registration_data');
								
								$data1['status'] = $result['status']; 
								
								if( $result['status'])
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect($this->agent->referrer());
								}
								else
								{
									$this->session->set_flashdata('error', $result['msg']);
									$this->session->set_flashdata('post_data', $this->input->post());
									redirect($this->agent->referrer());
								}
							}
						}
			    	}
				    else{
						
					}
					
				}
			}
			else
			{
				redirect('index/institute_not_found');
			}
		}
	}
	public function institute_login()
	{
		$institute = $this->uri->segment(4); // 1stsegment
		$ins =  encrypt_decrypt('decrypt', $institute);
		
		/*$ins = $this->uri->segment(3); // 1stsegment
		$institute = $this->uri->segment(4); // 1stsegment*/
		//$result = $this->index_model->institute();
		//$result = $this->index_model->institute();
		/*$data = $this->uri->uri_to_assoc();
		$institute = $data['ins'];*/
		
		/*echo $data;
		die();*/
		if($institute != '')
		{
			$result = $this->apply_model->apply($institute,'validate_institute');
			if( $result['status'] )
			{
				$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
				$this->load->view('template_config/header_index',$institute_list);
				$this->load->model('index_model');
				$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
				$institute_list['news_details'] = $this->index_model->index_data('','get_newsevents');
				$institute_list['latest_info'] = $this->index_model->index_data('','get_latestinfo'); 
				$institute_list['ageMinDate'] = $this->index_model->index_data('','get_ageMinDate'); 
				$institute_list['dateInfo'] = $this->index_model->index_data($ins,'get_dateInfo'); 
				$institute_list['eligibilityDate'] = $this->index_model->index_data($ins,'get_EligibilityDate'); 
				/*$data['allStates'] = $this->apply_model->apply($program,'get_state_data');*/
				$this->load->view('index/pages/login',$institute_list);
				 

				$this->load->view('index/pages/footer',$institute_list);
				if( $this->input->post())
				{
					if(isset($_POST['btnlogin']))
					{
						$inputCaptcha = $this->input->post('txtCaptcha');
		    			$sessCaptcha = $this->session->userdata('captchaCode');
		    			//echo $inputCaptcha . '#'.$sessCaptcha;
						if($inputCaptcha != '' && $inputCaptcha != $sessCaptcha )
						{
							$data = array(
				                'status' => 'captchaerror',
				                'msg' => 'Invalid Captcha. Please try again.'
				            );
							$this->session->set_flashdata('error', $data['msg']);
							$this->session->set_flashdata('post_data', $this->input->post());
							redirect($this->agent->referrer());
						}
						$config = array(
							array(
			                     'field'   => 'txtCandidatePhone',
			                     'label'   => 'Mobile Number',
			                     'rules'   => 'trim|required'
			                  ),
							array(
			                     'field'   => 'txtdob',
			                     'label'   => 'Date of Birth',
			                     'rules'   => 'trim|required'
			                  ) 
				        );
						$this->form_validation->set_rules($config);
						if ($this->form_validation->run() == FALSE) {
							$data = array(
				                'status' => 'validationerror',
				                'msg' => validation_errors()
				            );
				            $this->session->set_flashdata('error', $data['msg']);
				            $this->session->set_flashdata('post_data', $this->input->post());
							redirect($this->agent->referrer());
						}
						else
						{
							$result = $this->apply_model->apply($_POST,'verify_registration_data');
							if( $result['status'] )
							{
								$this->session->set_flashdata('info', $result['msg']);
								//redirect('apply/form_detail/ins/'.$result['enc_ins']);
								redirect('apply/institute_page/ins/'.$result['enc_ins']);
							}
							else
							{
								$this->session->set_flashdata('error', $result['msg']);
								$this->session->set_flashdata('post_data', $this->input->post());
								redirect($this->agent->referrer());
							}
						}
					}
				    else{
					}
				}
			}
		}
	}
	public function registration()
	{
		$institute = $_POST['insCode'];
		$program = $this->session->userdata('admcode');
		//$data = $this->uri->uri_to_assoc();
		$institute = encrypt_decrypt('encrypt',$institute);
	
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
			/*$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
			$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');*/
			//print_r($data['institute_data']);die();
			$inputCaptcha = $this->input->post('txtCaptcha');
			$sessCaptcha = $this->session->userdata('captchaCode');
			$this->session->unset_userdata('captchaCode');
			//echo $inputCaptcha .'#'. $sessCaptcha; die();
		
			if($inputCaptcha != '' && $inputCaptcha != $sessCaptcha )
			{
				$data = array(
	                'status' => 'captchaerror',
	                'msg' => 'Invalid Captcha. Please try again.'
	            );
				$this->session->set_flashdata('error', $data['msg']);
				$this->session->set_flashdata('post_data', $this->input->post());
				echo json_encode($data);
				exit;
				//redirect($this->agent->referrer());
			}
			$temp_rule = Array(
				"&lt",
				"&gt",
				"<",
				">",
				"="
			);
			if (hasXSS($_POST,$temp_rule)){
				//echo "2"; die();
				$data = array(
	                'status' => 'xsserror',
	                'msg' => 'Special chararacters like <,>,=,&lt;,&gt; are not allowed'
	            );
				$this->session->set_flashdata('error', $data['msg']);
				$this->session->set_flashdata('post_data', $this->input->post());
				//redirect($this->agent->referrer());
				echo json_encode($data);
				exit;
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
	                     'field'   => 'txtdob1',
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
	            $this->session->set_flashdata('post_data', $this->input->post());
				echo json_encode($data);
				exit;
				//redirect($this->agent->referrer());
			}
			else
			{
				$result = $this->apply_model->apply($_POST,'insert_registration_data');
				$data1['status'] = $result['status']; 
				if( $result['status'])
				{
					$this->session->set_flashdata('info', $result['msg']);
					echo json_encode($result);
					exit;
				}
				else
				{
					$this->session->set_flashdata('error', $result['msg']);
					$this->session->set_flashdata('post_data', $this->input->post());
					echo json_encode($result);
					exit;
				}
			}
		}
	}
	public function otp_verification()
	{
		
		
		
			/*$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
			$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');*/
			//print_r($data['institute_data']);die();
			
			$temp_rule = Array(
				"&lt",
				"&gt",
				"<",
				">",
				"="
			);
			if (hasXSS($_POST,$temp_rule)){
				//echo "2"; die();
				$data = array(
	                'status' => 'xsserror',
	                'msg' => 'Special chararacters like <,>,=,&lt;,&gt; are not allowed'
	            );
				$this->session->set_flashdata('error', $data['msg']);
				$this->session->set_flashdata('post_data', $this->input->post());
				//redirect($this->agent->referrer());
				echo json_encode($data);
				exit;
			}
			$result = $this->apply_model->apply($_POST,'verify_registration_otp');
			$data1['status'] = $result['status']; 
			if( $result['status'])
			{
				$this->session->set_flashdata('info', $result['msg']);
				echo json_encode($result);
				exit;
			}
			else
			{
				$this->session->set_flashdata('error', $result['msg']);
				$this->session->set_flashdata('post_data', $this->input->post());
				echo json_encode($result);
				exit;
			}
			
		
	}
	public function institute_register()
	{
		$institute = $this->uri->segment(4); // 1stsegment
		$ins =  encrypt_decrypt('decrypt', $institute);
		/*$this->load->model('index_model');
		$institute_list['institute'] = $this->index_model->index_data($institute,'get_institutes');
		$this->load->view('template_config/header_index',$institute_list);*/
		/*$ins = $this->uri->segment(3); // 1stsegment
		$institute = $this->uri->segment(4); // 1stsegment*/
		//$result = $this->index_model->institute();
		//$result = $this->index_model->institute();
		/*$data = $this->uri->uri_to_assoc();
		$institute = $data['ins'];*/
		
		/*echo $data;
		die();*/
		if($institute != '')
		{
			$result = $this->apply_model->apply($institute,'validate_institute');
			if($result['status'])
			{
				$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
				$this->load->view('template_config/header_index',$institute_list);
				//$institute_list['institute'] = $this->index_model->index_data($institute,'get_institutes');
				$institute_list['news_details'] = $this->index_model->index_data('','get_newsevents');
				$institute_list['latest_info'] = $this->index_model->index_data('','get_latestinfo'); 
				$institute_list['ageMinDate'] = $this->index_model->index_data('','get_ageMinDate'); 
				$institute_list['dateInfo'] = $this->index_model->index_data($ins,'get_dateInfo'); 
				$institute_list['eligibilityDate'] = $this->index_model->index_data($ins,'get_EligibilityDate'); 
				/*$data['allStates'] = $this->apply_model->apply($program,'get_state_data');*/
				$this->load->view('index/pages/registration',$institute_list);
				//print_r($institute_list) ;

				$this->load->view('index/pages/footer',$institute_list);
				if( $this->input->post())
				{
					if(isset($_POST['btnRegister']))
					{
					   	$program = $this->session->userdata('admcode');
						//$data = $this->uri->uri_to_assoc();
						//$ins = encrypt_decrypt('encrypt',$institute);
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
								$data['institute_data'] = $this->apply_model->apply($institute,'get_institute_data');
								$data['program_data'] = $this->apply_model->apply($program,'get_program_detail');
								//print_r($data['institute_data']);die();
								$inputCaptcha = $this->input->post('txtCaptcha');
		        				$sessCaptcha = $this->session->userdata('captchaCode');
		        				//echo $inputCaptcha .'#'. $sessCaptcha; die();
		        				
								if($inputCaptcha != '' && $inputCaptcha != $sessCaptcha )
								{
									$data = array(
						                'status' => 'captchaerror',
						                'msg' => 'Security code did not match'
						            );
									$this->session->set_flashdata('error', $data['msg']);
									$this->session->set_flashdata('post_data', $this->input->post());
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
									//echo "2"; die();
									$data = array(
						                'status' => 'xsserror',
						                'msg' => 'Special chararacters like <,>,=,(,),&lt;,&gt; are not allowed'
						            );
									$this->session->set_flashdata('error', $data['msg']);
									$this->session->set_flashdata('post_data', $this->input->post());
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
						                     'field'   => 'txtdob1',
						                     'label'   => 'Date of Birth',
						                     'rules'   => 'trim|required'
						                ),
						                array(
						                     'field'   => 'cmbState',
						                     'label'   => 'State',
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
						            $this->session->set_flashdata('post_data', $this->input->post());
									redirect($this->agent->referrer());
								}
								else
								{
									$result = $this->apply_model->apply($_POST,'insert_registration_data');
									
									$data1['status'] = $result['status']; 
									
									if( $result['status'])
									{
										$this->session->set_flashdata('info', $result['msg']);
										redirect($this->agent->referrer());
									}
									else
									{
										$this->session->set_flashdata('error', $result['msg']);
										$this->session->set_flashdata('post_data', $this->input->post());
										redirect($this->agent->referrer());
									}
								}
							}
				    }
				    else{
						
					}
					
				}
			}
		}
	}
		public function registration_login()
	{
		$inputCaptcha = $this->input->post('txtCaptcha');
		$sessCaptcha = $this->session->userdata('captchaCode');
		$this->session->unset_userdata('captchaCode');
		//echo $inputCaptcha . '#'.$sessCaptcha;die();
		if($inputCaptcha != '' && $inputCaptcha != $sessCaptcha )
		{
			$data = array(
                'status' => 'captchaerror',
                'msg' => 'Invalid Captcha. Please try again.'
            );
			$this->session->set_flashdata('error', $data['msg']);
			$this->session->set_flashdata('post_data1', $this->input->post());
			echo json_encode($data);
			exit;
			//redirect($this->agent->referrer());
		}
		$config = array(
			array(
                 'field'   => 'txtCandidatePhone',
                 'label'   => 'Mobile Number',
                 'rules'   => 'trim|required'
              ),
			array(
                 'field'   => 'txtPwd',
                 'label'   => 'Password',
                 'rules'   => 'trim|required'
              ) 
        );
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$data = array(
                'status' => 'validationerror',
                'msg' => validation_errors()
            );
            $this->session->set_flashdata('error', $data['msg']);
            $this->session->set_flashdata('post_data1', $this->input->post());
			echo json_encode($data);
			exit;
			//redirect($this->agent->referrer());
		}
		else
		{
			$result = $this->apply_model->apply($_POST,'verify_registration_data');
			if( $result['status'] == "SUCCESS")
			{
				$this->session->unset_userdata('key');
				$this->session->set_flashdata('info', $result['msg']);
				echo json_encode($result);
				exit;
				//redirect('apply/form_detail/ins/'.$result['enc_ins']);
				//redirect('apply/institute_page/ins/'.$result['enc_ins']);
			}
			else
			{
				$this->session->set_flashdata('logoutopt', $result['logoutopt']);
				$this->session->set_flashdata('error', $result['msg']);
				$this->session->set_flashdata('post_data1', $this->input->post());
				echo json_encode($result);
				exit;
				//redirect($this->agent->referrer());
			}
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
	public function Admin_login()
	{
		$inputCaptcha = $this->input->post('txtCaptcha');
		$sessCaptcha = $this->session->userdata('captchaCode');
		// echo $inputCaptcha . '#'.$sessCaptcha;die;
		if($inputCaptcha != '' && $inputCaptcha != $sessCaptcha )
		{
			$data = array(
                'status' => 'captchaerror',
                'msg' => 'Invalid Captcha. Please try again.'
            );
            $this->session->unset_userdata('key');
			$this->session->set_flashdata('error', $data['msg']);
			//$this->session->set_flashdata('post_data1', $this->input->post());
			echo json_encode($data);
			exit;
			//redirect($this->agent->referrer());
		}
		$config = array(
					array(
	                     'field'   => 'txtUsername',
	                     'label'   => 'User name',
	                     'rules'   => 'trim|required'
	                  ),
					array(
	                     'field'   => 'txtPassword',
	                     'label'   => 'Password',
	                     'rules'   => 'trim|required'
	                  ),
	                 array(
	                     'field'   => 'txtCaptcha',
	                     'label'   => 'Captcha',
	                     'rules'   => 'trim|required'
	                )
	                   
		        );
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$data = array(
                'status' => 'validationerror',
                'msg' => validation_errors()
            );
            $this->session->unset_userdata('key');
            $this->session->set_flashdata('error', $data['msg']);
            //$this->session->set_flashdata('post_data1', $this->input->post());
			echo json_encode($data);
			exit;
			//redirect($this->agent->referrer());
		}
		else
		{
			$result = $this->user_model->login();
			if( $result['msg'] == "SUCCESS")
			{
				//$this->session->unset_userdata('key');
				$this->session->set_flashdata('info', $result['msg']);
				echo json_encode($result);
				exit;
				//redirect('apply/form_detail/ins/'.$result['enc_ins']);
				//redirect('apply/institute_page/ins/'.$result['enc_ins']);
			}
			else
			{
				//$this->session->unset_userdata('key');
				$this->session->set_flashdata('error', $result['msg']);
				//$this->session->set_flashdata('post_data1', $this->input->post());
				echo json_encode($result);
				exit;
				//redirect($this->agent->referrer());
			}
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
				redirect('admin/dashboard');
			break;
			case 'SUPERADMIN':
				redirect('superadmin_controller/dashboard');
			break;
			
			break;
		}
		$this->load->view('templates/admin_footer');
	}
	/*public function send_email(){
        $this->load->library('email');


        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'mail.cipet.gov.in'; //'ssl://smtp.gmail.com';
        $config['smtp_port']    = '25';
        $config['smtp_timeout'] = '30';
        $config['smtp_user']    = "eadmission@cipet.gov.in";
        $config['smtp_pass']    = "AE*694!edgoin";
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or text
        $config['validation'] = TRUE; // bool whether to validate email or not
        $this->email->initialize($config);
        $this->email->from("eadmission@cipet.gov.in", 'CIPET ADMISSION 2018');
        $this->email->to("biswabhusan.ghosh@silicontechlab.com");

        $this->email->subject("Test mail from cipet");

        //$find = array("[name]","[phone_no]","[dob]");
        //$replace = array($name,$phone_no,$dob_mail);
       // $email_content = str_replace($find, $replace, $content);//find and replace uid and pwd in url

        $this->email->message("Yes it is working fine. In production server..");

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
        echo $dbMessage;
    }*/
	
        
	// logout user 
	public function logout()
	{
		$this->session->unset_userdata('user_code');
		$this->session->unset_userdata('user_name');
		$this->session->unset_userdata('user_display_name');
		$this->session->unset_userdata('role');
		$this->session->unset_userdata('group_code');
		$this->session->sess_destroy();
		// redirect to login
		$this->session->set_flashdata('info', 'User logout');
		redirect('user/login');
	}
	
	// logout  user 
	
	public function applicant_logout()
	{ 
		$institute = $this->uri->segment(4);
		$result = $this->user_model->logout();
		$url =  BASE_URL;
		$str_len = strlen($url);
		$str = substr($url, 0, $str_len-1);
		$right_slash_pos =  strrpos($str,"/");
		$final_url = substr($url,0,$right_slash_pos);
		$final_url = $url."Index/institute_index/ins/".$institute;
		//strpos()
		//die();
		// die();
		
		$this->session->unset_userdata('reg_user_id');
		$this->session->unset_userdata('institute_code');
		//$this->session->unset_userdata('ins_code');
		$this->session->unset_userdata('first_name');
		$this->session->unset_userdata('mode');
		$this->session->unset_userdata('step');
		$this->session->set_userdata('reg_user_id','');
		//$this->session->sess_destroy();
		
		$this->session->set_flashdata('info', 'User logout');
		
		redirect($final_url);
		
	}
	
	public function live_soon()
	{
		echo '<br/><br/><p style="text-align:center;color: red;font-size: 50px;">Will be live soon</p>';
		
	}
	public function registration_forgot_password()
	{
		
		$inputCaptcha = $this->input->post('txtCaptcha5');
		$mobile_no = $this->input->post('txtForgotCandidatePhone');
		$email_id = $this->input->post('txtForgotEmail');
		
		$sessCaptcha = $this->session->userdata('captchaCode');
		$this->session->unset_userdata('captchaCode');
		//echo $inputCaptcha . '#'.$sessCaptcha;
		if($inputCaptcha != '' && $inputCaptcha != $sessCaptcha )
		{
			$data = array(
                'status' => 'captchaerror',
                'msg' => 'Invalid Captcha. Please try again.'
            );
			$this->session->set_flashdata('error', $data['msg']);
			$this->session->set_flashdata('post_data1', $this->input->post());
			echo json_encode($data);
			exit;
			//redirect($this->agent->referrer());
		}
		$config = array(
			
			array(
                 'field'   => 'txtCaptcha5',
                 'label'   => 'Captcha',
                 'rules'   => 'trim|required'
              ) 
        );
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$data = array(
                'status' => 'validationerror',
                'msg' => validation_errors()
            );
            $this->session->set_flashdata('error', $data['msg']);
            $this->session->set_flashdata('post_data1', $this->input->post());
			echo json_encode($data);
			exit;
			//redirect($this->agent->referrer());
		}
		else
		{
			$result = $this->apply_model->apply($_POST,'send_otp_data_forgot_password');
			if( $result['status'] == "SUCCESS")
			{
				$this->session->set_flashdata('info', $result['msg']);
				/*$this->session->set_userdata('FPEmailId', $email_id);
				$this->session->set_userdata('FPMobileNo', $mobile_no);
		*/
				echo json_encode($result);
				exit;
				//redirect('apply/form_detail/ins/'.$result['enc_ins']);
				//redirect('apply/institute_page/ins/'.$result['enc_ins']);
			}
			else
			{
				$this->session->set_flashdata('error', $result['msg']);
				$this->session->set_flashdata('post_data1', $this->input->post());
				echo json_encode($result);
				exit;
				//redirect($this->agent->referrer());
			}
		}
		
	}



} 


?>