<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller
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
		/*$this->load->helper('transactionRequestBean');		
		$this->load->helper('transactionResponseBean');*/		
		//$this->load->helper('custom_captcha');	
		$this->load->helper('captcha');	
		$this->load->helper('crypto');	
		
		
		# libraries
		$this->load->library('form_validation');
		$this->load->library('user_agent');
		$this->load->library('CryptAES');
		
		
		$this->role = $this->session->userdata('role');
		//$this->load->library('../controllers/Mpdf_controller');
		# models
		$this->load->model('payment_model');
		$this->load->model('admin_model');
		$this->load->model('m_pdf_model');
		$this->load->model('index_model');
		//$this->load->model('getter_model');
		
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		
		
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
		$institute_list['institute'] = $this->index_model->index_data('','get_institutes');
		//print_r($institute_list);
		$this->load->view('index/index',$institute_list);
		$this->load->view('index/pages/footer_index');
	}
	
	public function onlinepaymentinstruction()
	{
		$institute = $this->uri->segment(3); // 1stsegment
		
		$program = $this->session->userdata('admcode');
		$data = $this->uri->uri_to_assoc();
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
				$result = $this->payment_model->payment($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->payment_model->payment($program,'validate_program');
					
					if( $result['status'] )
					{
						$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
						$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
						$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
						$institute_list['header'] = '';
						$this->load->view('template_config/header_home',$institute_list);
						$this->session->set_userdata('institute_code', $institute);
						$data['institute_data'] = $this->payment_model->payment($institute,'get_institute_data');
						$data['appl_status'] = $this->payment_model->payment($program,'get_appl_status');
						$data['program_data'] = $this->payment_model->payment($program,'get_program_detail');
						$data['applicant_data'] = $this->payment_model->payment($program,'get_applicant_detail');
						$data['categorydt'] = $this->payment_model->payment($program,'categorydata');
						$data['extra_amount_arr'] = $this->payment_model->payment($program,'extra_amount');
						$data['transaction_data'] = $this->payment_model->payment($program,'get_transaction_data');
						$data['amount_data'] = $this->payment_model->payment($program,'get_amount_data');
						$data['payment_gateway_data'] = $this->payment_model->payment($institute,'get_payment_gateway_data');
						//$data['program_admit_card_setup'] = $this->apply_model->apply($program,'get_program_admitcard_setup');
						//$data['program_admit_card_detail'] = $this->apply_model->apply($program,'get_program_admitcard_detail');
					
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
								$result = $this->payment_model->payment($_POST,'add_payment_gateway_data');//print_r($result);die;
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect($result['sel_payment_process_url'].'/'.$institute);
									
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
							$this->load->view('payment/onlinepaymentinstruction',$data);
						}
						$this->load->view('index/pages/footer_index');
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
			redirect(BASE_URL);
		}
		
		//$this->load->model('index_model');
		//$institute_list['institute'] = $this->index_model->index_data('','get_institutes');
		//print_r($institute_list);
		//$this->load->view('index/index',$institute_list);
		//$this->load->view('template_config/footer');
	}
	public function process_payment_techprocess()
	{
		//echo "hello";
		$institute = $this->uri->segment(3); // 1stsegment
		$program = $this->session->userdata('admcode');
		$data = $this->uri->uri_to_assoc();
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
				$result = $this->payment_model->payment($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->payment_model->payment($program,'validate_program');
					
					if( $result['status'] )
					{
						/*echo "hiiiiiiii";
						die();*/
						$this->session->set_userdata('institute_code', $institute);
						$this->load->view('template_config/header');
						
						$result = $this->payment_model->payment($data,'process_payment_techprocess');
						if( $result['status'] )
						{
							$this->session->set_flashdata('info', $result['msg']);
							
							redirect($result['payment_process_url']);
							redirect('payment/postpayment');
							
						}
						$this->load->view('payment/process_payment',$data);
						$this->load->view('index/pages/footer_index');
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
	public function process_payment_quikfee()
	{
		//echo "hello";
		$institute = $this->uri->segment(3); // 1stsegment
		$program = $this->session->userdata('admcode');
		$data = $this->uri->uri_to_assoc();
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
				$result = $this->payment_model->payment($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->payment_model->payment($program,'validate_program');
					
					if( $result['status'] )
					{
						/*echo "hiiiiiiii";
						die();*/
						$this->session->set_userdata('institute_code', $institute);
						//$this->load->view('template_config/header');
						
						$result = $this->payment_model->payment($data,'process_payment_quikfee');
						/*if( $result['status'] )
						{
							$this->session->set_flashdata('info', $result['msg']);
							
							redirect($result['payment_process_url']);
							redirect('payment/postpayment');
							
						}*/
						//print_r($result['data']);
						$result_arr = array();
					    $result_arr['result'] = $result['data'];
						//print_r($result_arr);
						//die();
						$this->load->view('payment/process_payment_quikfee',$result_arr);
						//$this->load->view('template_config/footer');
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
	public function process_payment_hdfc()
	{
		//echo "hello";
		$institute = $this->uri->segment(3); // 1stsegment
		$program = $this->session->userdata('admcode');
		$data = $this->uri->uri_to_assoc();
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
				$result = $this->payment_model->payment($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->payment_model->payment($program,'validate_program');
					
					if( $result['status'] )
					{
						
						
						$result = $this->payment_model->payment($data,'process_payment_hdfc');
						/*print_r($result);
						die();*/
						$this->load->view('payment/process_payment_hdfc',$result);
						
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
    public function request_handler()
	{
		//echo "hello";
		$institute = $this->uri->segment(3); // 1stsegment
		$program = $this->session->userdata('admcode');
		$data = $this->uri->uri_to_assoc();
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
				$result = $this->payment_model->payment($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->payment_model->payment($program,'validate_program');
					
					if( $result['status'] )
					{
						
						
						$result = $this->payment_model->payment($data,'process_payment_hdfc');
						//print_r($result['payment_process_url']);
						$working_key = $result['parameter_values']['ENCKEY'];
						$access_code = $result['parameter_values']['ACCESS'];
						
						if($_POST)
						{
							foreach ($_POST as $key => $value){
								$merchant_data.=$key.'='.urlencode($value).'&';
							}
							//print_r($merchant_data);die();
							$encrypted_data=encrypt($merchant_data,$working_key);
						}
						$data['encrypted_data'] = $encrypted_data;
						$data['working_key'] = $working_key;
						$data['access_code'] = $access_code;
						$data['action_url'] = $result['payment_process_url'];
						$this->load->view('payment/request_handler_hdfc',$data);
						
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
			redirect(BASE_URL);
		}
	}
	public function postpayment_hdfc()
	{
		$program = $this->session->userdata('admcode');
		$institute = $this->session->userdata('institute_code');
		$data = $this->uri->uri_to_assoc();
		
		if($institute != '' && $program != '')
		{
			$data = array(
				'institute'=>$institute,
				'program'=>$program
			);
			
			
			$ins = encrypt_decrypt('encrypt',$institute);
			$result = $this->payment_model->payment($ins,'validate_institute');
			if( $result['status'] )
			{
				
				$result = $this->payment_model->payment($program,'validate_program');
				
				if( $result['status'] )
				{
					$this->session->set_userdata('institute_code', $institute);
					$institute_list['institute'] = $this->index_model->index_data($institute,'get_institutes');
					$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
					$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
					$institute_list['header'] = '';
					$this->load->view('template_config/header_home',$institute_list);
					if( $this->input->post())
					{
						$result = $this->payment_model->payment($_POST,'add_post_payment_data_hdfc');
						if( $result['status'] )
						{
							$result_arr['result'] = $result['data'];
							$this->session->set_flashdata('info', $result['msg']);
							$this->load->view('payment/success_payment_hdfc',$result_arr);
						}
						else
						{
							$this->session->set_flashdata('error', $result['msg']);
							redirect($this->agent->referrer());
						}
					}
					else
					{
						$this->load->view('payment/postpayment',$data);
					}
					$this->load->view('index/pages/footer_index');
				}
				else
				{
					redirect('apply/apply_logout/ins/'.$institute);
				}
				
			}
		}
		else
		{
			show_404();
		}
		
	}
	public function postpayment()
	{
		$program = $this->session->userdata('admcode');
		$institute = $this->session->userdata('institute_code');
		$data = $this->uri->uri_to_assoc();
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
				$result = $this->payment_model->payment($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->payment_model->payment($program,'validate_program');
					
					if( $result['status'] )
					{
						$this->session->set_userdata('institute_code', $institute);
						$this->load->view('template_config/header');
					
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
								$result = $this->payment_model->payment($_POST,'get_post_payment_data');
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('payment/postpayment');
									//redirect($result['sel_payment_process_url'].'/'.$institute);
									
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
							$this->load->view('payment/postpayment',$data);
						}
						$this->load->view('index/pages/footer_index');
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
	public function postpayment_quikfee()
	{
		//echo "hello";
		//$institute = $this->uri->segment(3); // 1stsegment
		$program = $this->session->userdata('admcode');
		$institute = $this->session->userdata('institute_code');
		//$data = $this->uri->uri_to_assoc();
		//$institute = $data['ins'];
		//echo $program;
		//echo $institute;
		//die();
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
				
				
				$result = $this->payment_model->payment($program,'validate_program');
				
				if( $result['status'] )
				{
					$this->session->set_userdata('institute_code', $institute);
					$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
					$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
					$institute_list['header'] = '';
					$this->load->view('template_config/header_home',$institute_list);$params   = $_SERVER['QUERY_STRING'];
					if( $params != '')
					{
						
						$POST =  explode('&',$params);
						$result = $this->payment_model->payment($POST,'get_post_payment_data_quikfee');
						//print_r($result);
						
						if( $result['status'] )
						{
							$result_arr = array();
							
					    	$result_arr['result'] = $result['data'];
							//print_r($result_arr);
							$this->session->set_flashdata('info', $result['msg']);
							$this->load->view('payment/postpayment',$result_arr);
							//redirect($result['sel_payment_process_url'].'/'.$institute);
							
						}
						else
						{
							//$this->session->set_flashdata('error', $result['msg']);
							//redirect($this->agent->referrer());
						}
						
					}
					else
					{
						$this->load->view('payment/postpayment',$data);
					}
					$this->load->view('index/pages/footer_index');
				}
				else
				{
					redirect('apply/apply_logout/ins/'.$institute);
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
	public function process_payment_sbi()
	{
		//echo "hello";
		$institute = $this->uri->segment(3); // 1stsegment
		$program = $this->session->userdata('admcode');
		$data = $this->uri->uri_to_assoc();
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
				$result = $this->payment_model->payment($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->payment_model->payment($program,'validate_program');
					
					if( $result['status'] )
					{
						
						
						$result = $this->payment_model->payment($data,'process_payment_sbi');
						/*print_r($result);
						die();*/
						$this->load->view('payment/process_payment_sbi',$result);
						
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
	public function success_payment_sbi()
	{
		/*echo "hello";
		die();*/
		//$institute = $this->uri->segment(3); // 1stsegment
		$program = $this->session->userdata('admcode');
		$institute = $this->session->userdata('institute_code');
		$data = $this->uri->uri_to_assoc();
		$ins1 = 'RECINS001';
		$institute = $data['ins'];
		
		$institute = encrypt_decrypt('encrypt',$ins1);
		//die();
		
		$data = array(
			'institute'=>$institute,
			'program'=>$program
		);
		
		
		$result = $this->payment_model->payment($program,'validate_program');
		
		if( $result['status'] )
		{
			$this->session->set_userdata('institute_code', $institute);
			$institute_list['institute'] = $this->index_model->index_data($institute,'get_institutes');
			$this->load->view('template_config/header_home',$institute_list);
			/*print_r($_POST);
			die();*/
			if( $this->input->post())
			{
				
				$result = $this->payment_model->payment($_POST,'get_post_payment_data_sbi');
				if( $result['status'] )
				{
					$result_arr['result'] = $result['data'];
					//print_r($result_arr);
					$this->session->set_flashdata('info', $result['msg']);
					$this->load->view('payment/success_payment_sbi',$result_arr);
					//redirect($result['sel_payment_process_url'].'/'.$institute);
					
				}
				else
				{
					$this->session->set_flashdata('error', $result['msg']);
					//redirect($this->agent->referrer());
				}
				
			}
			else
			{
				$this->load->view('payment/postpayment',$data);
			}
			$this->load->view('template_config/footer');
		}
		else
		{
			redirect('apply/apply_logout/ins/'.$institute);
		}
					
			
			
			
		
		
		//$this->load->model('index_model');
		//$institute_list['institute'] = $this->index_model->index_data('','get_institutes');
		//print_r($institute_list);
		//$this->load->view('index/index',$institute_list);
		//$this->load->view('template_config/footer');
	}
	public function template008pdf() {
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
		$data['applicant_documents'] = $this->m_pdf_model->template008_pdf($order_id, 'get_applicant_documents');
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
		$uploaddir = DOCUMENT_UPLOAD_URL.'/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print_008.pdf', 'F');
		//$this->load->view('pdf/template008_pdf');	
		/*$pdf->Output($applicantNumber.".pdf",'I');*/	
		return true;
    } 
    public function template014pdf() {
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
		$data['applicant_documents'] = $this->m_pdf_model->template008_pdf($order_id, 'get_applicant_documents');
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
		$uploaddir = DOCUMENT_UPLOAD_URL.'/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print_008.pdf', 'F');
		//$this->load->view('pdf/template008_pdf');	
		/*$pdf->Output($applicantNumber.".pdf",'I');*/	
		return true;
    } 

	public function process_payment_csc()
	{
		//echo "hello";
		$institute = $this->uri->segment(3); // 1stsegment
		$program = $this->session->userdata('admcode');
		$data = $this->uri->uri_to_assoc();
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
				$result = $this->payment_model->payment($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->payment_model->payment($program,'validate_program');
					
					if( $result['status'] )
					{
						
						$this->session->set_userdata('institute_code', $institute);

						
						$result = $this->payment_model->payment($data,'process_payment_csc');
						
						$result_arr = array();
					    $result_arr['result'] = $result['data'];

						$this->load->view('payment/process_payment_csc',$result_arr);

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

	public function postpayment_success_csc()
	{

		$program = $this->session->userdata('admcode');
		$institute = $this->session->userdata('institute_code');
		$data = $this->uri->uri_to_assoc();
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
				echo 'error validating institute and program';die();
				//redirect('error');
	         
			}
			else
			{
				
				$result = $this->payment_model->payment($program,'validate_program');
				if( $result['status'] )
				{
					$this->session->set_userdata('institute_code', $institute);
					$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
					$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
					$institute_list['header'] = '';
					$this->load->view('template_config/header_home',$institute_list);
					if( $this->input->post())
					{
						$temp_rule = Array(
							"&lt",
							"&gt",
							"<",
							">",
							"("
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
							$result = $this->payment_model->payment($_POST,'get_post_payment_data_csc');
							//print_r($result);//die();
							if( $result['status'] )
							{
								$result_arr = array();
						    	$result_arr['result'] = $result['data'];
								$this->session->set_flashdata('info', $result['msg']);
								$this->load->view('payment/postpayment',$result_arr);
								
							}
							else
							{
								echo 'error in updation';die();
								//$this->session->set_flashdata('error', $result['msg']);
								//redirect($this->agent->referrer());
							}
						}
					}
					else
					{
						$this->load->view('payment/postpayment',$data);
					}
					$this->load->view('index/pages/footer_index');
				}
				else
				{
					redirect('apply/apply_logout/ins/'.$institute);
				}
			}
		}
		else
		{
			show_404();
		}
		
		
	}
	
	public function postpayment_cancel_csc()
	{
		$program = $this->session->userdata('admcode');
		$institute = $this->session->userdata('institute_code');
		$data = $this->uri->uri_to_assoc();
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
				echo 'error validating institute and program';die();
				//redirect('error');
	         
			}
			else
			{
				
				$result = $this->payment_model->payment($program,'validate_program');
				if( $result['status'] )
				{
					$this->session->set_userdata('institute_code', $institute);
					$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
					$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
					$institute_list['header'] = '';
					$this->load->view('template_config/header_home',$institute_list);
					if( $this->input->post())
					{
						$temp_rule = Array(
							"&lt",
							"&gt",
							"<",
							">",
							"("
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
							$result = $this->payment_model->payment($_POST,'get_post_payment_data_csc');
							//print_r($result);//die();
							if( $result['status'] )
							{
								$result_arr = array();
						    	$result_arr['result'] = $result['data'];
								$this->session->set_flashdata('info', $result['msg']);
								$this->load->view('payment/postpayment',$result_arr);
								
							}
							else
							{
								echo 'error in updation';die();
							}
						}
					}
					else
					{
						$this->load->view('payment/postpayment',$data);
					}
					$this->load->view('index/pages/footer_index');
				}
				else
				{
					redirect('apply/apply_logout/ins/'.$institute);
				}
			}
		}
		else
		{
			show_404();
		}
		
		
		
	}
	
	//MEESEVA
	public function process_payment_meeseva()
	{
		//echo "hello";
		$institute = $this->uri->segment(3); // 1stsegment
		$program = $this->session->userdata('admcode');
		$data = $this->uri->uri_to_assoc();
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
				$result = $this->payment_model->payment($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->payment_model->payment($program,'validate_program');
					
					if( $result['status'] )
					{
						$this->session->set_userdata('institute_code', $institute);
						$result = $this->payment_model->payment($data,'process_payment_meeseva');
						$result_arr = array();
					    $result_arr['result'] = $result['data'];
						$this->load->view('payment/process_payment_meeseva',$result_arr);
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
	
	public function do_payment_meeseva()
	{
		$institute = $this->uri->segment(3); // 1stsegment
		$program = $this->session->userdata('admcode');
		$data = $this->uri->uri_to_assoc();
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
				$result = $this->payment_model->payment($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->payment_model->payment($program,'validate_program');
					
					if( $result['status'] )
					{
						$this->session->set_userdata('institute_code', $institute);
						$result = $this->payment_model->payment($data,'do_payment_meeseva');
					}
					else
					{
						redirect('apply/apply_logout/ins/'.$institute);
					}
					
				}
				else
				{
					echo 'error while validating institute';
				}
			}
		}
		else
		{
			show_404();
		}
	}
	

	public function postpayment_meeseva()
	{

		$program = $this->session->userdata('admcode');
		$institute = $this->session->userdata('institute_code');
		$data = $this->uri->uri_to_assoc();
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
				echo 'error validating institute and program';die();
				//redirect('error');
	         
			}
			else
			{
				
				$result = $this->payment_model->payment($program,'validate_program');
				if( $result['status'] )
				{
					$this->session->set_userdata('institute_code', $institute);
					$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
					$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
					$institute_list['header'] = '';
					$this->load->view('template_config/header_home',$institute_list);
					if( $this->input->post())
					{
						$temp_rule = Array(
							"&lt",
							"&gt",
							"<",
							">",
							"("
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
							$result = $this->payment_model->payment($_POST,'get_post_payment_data_meeseva');
							if( $result['status'] )
							{
								$result_arr = array();
						    	$result_arr['result'] = $result['data'];
								$this->session->set_flashdata('info', $result['msg']);
								$this->load->view('payment/postpayment',$result_arr);
								
							}
							else
							{
								echo 'error in updation';die();
								//$this->session->set_flashdata('error', $result['msg']);
								//redirect($this->agent->referrer());
							}
						}
					}
					else
					{
						$this->load->view('payment/postpayment',$data);
					}
					$this->load->view('index/pages/footer_index');
				}
				else
				{
					redirect('apply/apply_logout/ins/'.$institute);
				}
			}
		}
		else
		{
			show_404();
		}
		
		
	}
	
	//E-MITRA
	public function process_payment_emitra()
	{
		$institute = $this->uri->segment(3); // 1stsegment
		$program = $this->session->userdata('admcode');
		$data = $this->uri->uri_to_assoc();
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
				$result = $this->payment_model->payment($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->payment_model->payment($program,'validate_program');
					
					if( $result['status'] )
					{
						$this->session->set_userdata('institute_code', $institute);
						$result = $this->payment_model->payment($data,'process_payment_emitra');
						$result_arr = array();
					    $result_arr['result'] = $result['data'];
						$this->load->view('payment/process_payment_emitra',$result_arr);
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
	
	public function do_payment_emitra()
	{
		$institute = $this->uri->segment(3); // 1stsegment
		$program = $this->session->userdata('admcode');
		$data = $this->uri->uri_to_assoc();
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
				$result = $this->payment_model->payment($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->payment_model->payment($program,'validate_program');
					
					if( $result['status'] )
					{
						$this->session->set_userdata('institute_code', $institute);
						$result = $this->payment_model->payment($data,'do_payment_emitra');
					}
					else
					{
						redirect('apply/apply_logout/ins/'.$institute);
					}
					
				}
				else
				{
					echo 'error while validating institute';
				}
			}
		}
		else
		{
			show_404();
		}
	}
	

	public function postpayment_emitra()
	{

		$program = $this->session->userdata('admcode');
		$institute = $this->session->userdata('institute_code');
		$data = $this->uri->uri_to_assoc();
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
				echo 'error validating institute and program';die();
				//redirect('error');
	         
			}
			else
			{
				
				$result = $this->payment_model->payment($program,'validate_program');
				if( $result['status'] )
				{
					$this->session->set_userdata('institute_code', $institute);
					$institute_list['dateInfo'] = $this->index_model->index_data($institute,'get_dateInfo'); 
					$institute_list['eligibilityDate'] = $this->index_model->index_data($institute,'get_EligibilityDate');
					$institute_list['header'] = '';
					$this->load->view('template_config/header_home',$institute_list);
					if( $this->input->post())
					{
						$temp_rule = Array(
							"&lt",
							"&gt",
							"<",
							">",
							"("
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
							$result = $this->payment_model->payment($_POST,'get_post_payment_data_emitra');
							if( $result['status'] )
							{
								$result_arr = array();
						    	$result_arr['result'] = $result['data'];
								$this->session->set_flashdata('info', $result['msg']);
								$this->load->view('payment/postpayment',$result_arr);
								
							}
							else
							{
								echo 'error in updation';die();
							}
						}
					}
					else
					{
						$this->load->view('payment/postpayment',$data);
					}
					$this->load->view('index/pages/footer_index');
				}
				else
				{
					redirect('apply/apply_logout/ins/'.$institute);
				}
			}
		}
		else
		{
			show_404();
		}
		
		
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
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template002_pdf', $data,true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        //$pdfFilePath = "template008_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->pdf;
        //generate the PDF!
		$pdf->WriteHTML($html);
        /*$pdf->AddPage();
        $data['type'] = "TOP";
        $html = $this->load->view('pdf/template008_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html);*/        
       // $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//chmod($uploaddir.'/application_print.pdf',0777);	
		//$pdf->Output($applicantNumber.".pdf",'I');
		return true;
    } 
	
	public function template001_pdf() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
        $url_data = $this->uri->uri_to_assoc();
		$program = $url_data['program'];
		/*echo $program;
		die();*/
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	//echo $program ; die();
     // 	$this->load->library('m_pdf', $params);
      	$this->load->library('m_pdf', $params);
      	
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template001_pdf($program, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template001_pdf($program, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template001_pdf($program, 'get_applicant_father');
       // print_r($data['applicant_father']);die();
        $data['applicant_mother'] = $this->m_pdf_model->template001_pdf($program, 'get_applicant_mother');
        
        $data['qualification_detail'] = $this->m_pdf_model->template001_pdf($program, 'get_qualification_details');
        
        $data['fetchInst'] = $this->m_pdf_model->template001_pdf($program, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template001_pdf($program, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template001_pdf($program, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template001_pdf($program, 'get_payment_detail');
       
        $data['otherDetail'] = $this->m_pdf_model->template001_pdf($program, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template001_pdf($program, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template001_pdf($program, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template001_pdf($program, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template001_pdf($program, 'get_other_board');
        $data['research_employmen'] = $this->m_pdf_model->template001_pdf($program, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template001_pdf($program, 'reference_details');
       
        $data['applicant_documents'] = $this->m_pdf_model->template001_pdf($program, 'get_applicant_documents');

        $data['examcenter'] = $this->m_pdf_model->template001_pdf($program, 'get_exam_center');
        
     /* print_r($data['reference_details']);
		die();*/

        $data['othernationality'] = $this->m_pdf_model->template001_pdf($app_prog, 'get_other_nationality');
        $data['type'] = "TOP";
        
		$html = $this->load->view('pdf/template001_pdf', $data,true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        //$pdfFilePath = "template008_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->pdf;
        //generate the PDF!
		$pdf->WriteHTML($html);
        /*$pdf->AddPage();
        $data['type'] = "TOP";
        $html = $this->load->view('pdf/template008_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html);*/        
       // $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//chmod($uploaddir.'/application_print.pdf',0777);	
		//$pdf->Output($applicantNumber.".pdf",'I');
		return true;
    }  

	public function template002_pdf() {
		//echo 1299;die;
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
        $url_data = $this->uri->uri_to_assoc();
		$program = $url_data['program'];
		$program = $_SESSION['admcode'];
		
		$program = str_replace('%60','/',$program);
		$program = str_replace('`','/',$program);
		
		//echo $program;
		//die();
		
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	//echo $program ; die();
     // 	$this->load->library('m_pdf', $params);
      	$this->load->library('m_pdf', $params);
      	
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template001_pdf($program, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template001_pdf($program, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template001_pdf($program, 'get_applicant_father');
        //print_r($data['applicant_father']);die();
        $data['applicant_mother'] = $this->m_pdf_model->template001_pdf($program, 'get_applicant_mother');
        
        $data['qualification_detail'] = $this->m_pdf_model->template001_pdf($program, 'get_qualification_details');
        
        $data['fetchInst'] = $this->m_pdf_model->template001_pdf($program, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template001_pdf($program, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template001_pdf($program, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template001_pdf($program, 'get_payment_detail');
       
        $data['otherDetail'] = $this->m_pdf_model->template001_pdf($program, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template001_pdf($program, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template001_pdf($program, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template001_pdf($program, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template001_pdf($program, 'get_other_board');
        $data['research_employmen'] = $this->m_pdf_model->template001_pdf($program, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template001_pdf($program, 'reference_details');
       
        $data['applicant_documents'] = $this->m_pdf_model->template001_pdf($program, 'get_applicant_documents');
        $data['tech_qual_data_5'] = $this->m_pdf_model->template001_pdf($program,'get_tech_qual_data_5');
		$data['tech_qual_data_6'] = $this->m_pdf_model->template001_pdf($program,'get_tech_qual_data_6');
		$data['tech_qual_data_7'] = $this->m_pdf_model->template001_pdf($program,'get_tech_qual_data_7');
		
		$data['multiple_post'] = $this->m_pdf_model->template001_pdf($program,'get_post'); 
        $data['examcenter'] = $this->m_pdf_model->template001_pdf($program, 'get_exam_center');
        
     /* print_r($data['reference_details']);
		die();*/

        $data['othernationality'] = $this->m_pdf_model->template001_pdf($app_prog, 'get_other_nationality');
        $data['type'] = "TOP";
      
		$html = $this->load->view('pdf/template002_pdf', $data,true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        //$pdfFilePath = "template008_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->pdf;
        //generate the PDF!
		$pdf->WriteHTML($html);
        /*$pdf->AddPage();
        $data['type'] = "TOP";
        $html = $this->load->view('pdf/template008_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html);*/        
       // $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		//echo $uploaddir;die;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		  
		//$this->load->view('pdf/template002_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		//return true;
		//chmod($uploaddir.'/application_print.pdf',0777);	
		//$pdf->Output($applicantNumber.".pdf",'I');
		
		return true;
    }  
	public function download_print_application()
	{
		$admcode = $this->session->userdata('admcode');
		$appl_no = $this->session->userdata('appl_no');
		$file_path = BASE_ADM_URL."/DOCUMENTS/".$admcode."/".$appl_no."/application_print.pdf";
		header("location:$file_path");
	}
	public function process_payment_easebuzz()
	{
		//echo "hello";die;
		$this->load->library('Easebuzz');
		$institute = $this->uri->segment(3); // 1stsegment
		$program = $this->session->userdata('admcode');
		$data = $this->uri->uri_to_assoc();
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
				$result = $this->payment_model->payment($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->payment_model->payment($program,'validate_program');
					
					if( $result['status'] )
					{
						
						
						$result = $this->payment_model->payment($data,'process_payment_easebuzz');
						/*print_r($result);
						die();*/
						$this->load->view('payment/process_payment_easebuzz',$result);
						
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
	public function postpayment_success_easebuzz()
	{
		$this->load->library('Easebuzz');
		
		$institute = $this->session->userdata('institute_code');
		$data = $this->uri->uri_to_assoc();
		$institute_code = $this->uri->segment(3);
		//die();
		$this->load->model('index_model');
		
		$data = array(
			'institute'=>$institute
		);
		$ins = encrypt_decrypt('encrypt',$institute);
		$result = $this->payment_model->payment($ins,'validate_institute');
		
		$this->session->set_userdata('institute_code', $institute);
		//$ins = encrypt_decrypt('decrypt',$institute);
		$institute_list['institute'] = $this->index_model->index_data($institute,'get_institutes');
		$this->load->view('template_config/header_index',$institute_list);
						
		if($this->input->post())
		{
			$temp_rule = Array(
				"&lt",
				"&gt",
				"<",
				">",
				"(",
				"="
			);
							
			$result = $this->payment_model->payment($_POST,'get_post_payment_data_easebuzz');
			die;
			
			if( $result['status'] )
			{
				$this->session->set_flashdata('info', $result['msg']);
				
				$result_arr = array();
				
		    	$result_arr['result'] = $result['data'];
				
				$this->session->set_flashdata('info', $result['msg']);
				$this->load->view('payment/postpayment',$result_arr);
				
			}
			
		}
		else
		{
			echo 1;die;
			$this->load->view('payment/postpayment',$data);
		}
		$this->load->view('template_config/footer',$institute_list);
					
	}
	public function postpayment_failure_easebuzz()
	{
		$this->load->library('Easebuzz');
		
		$institute = $this->session->userdata('institute_code');
		$data = $this->uri->uri_to_assoc();
		$institute_code = $this->uri->segment(3);
		//die();
		$this->load->model('index_model');
		
		$data = array(
			'institute'=>$institute
		);
		$ins = encrypt_decrypt('encrypt',$institute);
		$result = $this->payment_model->payment($ins,'validate_institute');
			
			
		$this->session->set_userdata('institute_code', $institute);
		
		$institute_list['institute'] = $this->index_model->index_data($institute,'get_institutes');
		$this->load->view('template_config/header_index',$institute_list);
		
		if($this->input->post())
		{
			$temp_rule = Array(
				"&lt",
				"&gt",
				"<",
				">",
				"(",
				"="
			);
			
			$result = $this->payment_model->payment($_POST,'get_post_payment_data_easebuzz');
						
			if($result['status'])
			{
				$this->session->set_flashdata('info', $result['msg']);
				$result_arr = array();
		    	$result_arr['result'] = $result['data'];
				$this->session->set_flashdata('info', $result['msg']);
				$this->load->view('payment/postpayment',$result_arr);
			}
			
		}
		else
		{
							$this->load->view('payment/postpayment',$data);
						}
		$this->load->view('template_config/footer',$institute_list);
					
	}
	public function process_payment_airpay()
	{
		$this->load->library('checksum');
		$institute = $this->uri->segment(3); // 1stsegment
		$program = $this->session->userdata('admcode');
		$data = $this->uri->uri_to_assoc();
		
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
				$result = $this->payment_model->payment($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->payment_model->payment($program,'validate_program');
					
					if( $result['status'] )
					{
						/*echo "hiiiiiiii";
						die();*/
						$this->session->set_userdata('institute_code', $institute);
						/*$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
						$this->load->view('template_config/header_index',$institute_list);*/
						//$this->load->view('template_config/header');
						
						$result = $this->payment_model->payment($data,'process_payment_airpay');//print_r($result);die;echo 2;die;
						//echo 2;die;
						if($result['status'] == FALSE)
						{
							redirect('apply/apply_logout/ins/'.$institute);
						}
						else
						{
							$this->load->view('payment/process_payment_airpay',$result);
							//$this->load->view('template_config/footer');
						}
						
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
	public function postpayment_airpay()
	{
		//echo "hello";
		//$institute = $this->uri->segment(3); // 1stsegment
		//$program = $this->session->userdata('admcode');
		$institute = $this->session->userdata('institute_code');
		$data = $this->uri->uri_to_assoc();
		$institute_code = $this->uri->segment(3);
		//die();
		$this->load->model('index_model');
		//$institute = $data['ins'];
		//$institute = encrypt_decrypt('decrypt',$institute_code);
		//echo "hello";
		//die();
		//die();
		/*if($institute != '')
		{*/
			$data = array(
				'institute'=>$institute
			);
			$ins = encrypt_decrypt('encrypt',$institute);
			$result = $this->payment_model->payment($ins,'validate_institute');
			
			/*if( $result['status'] == true)
			{
					//$result = $this->payment_model->payment($program,'validate_program');
					
					if( $result['status'] )
					{*/
						$this->session->set_userdata('institute_code', $institute);
						//$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($institute,'get_institutes');
						$this->load->view('template_config/header_index',$institute_list);
						//$this->load->view('template_config/header');
						//print_r($this->input->post());
						//die();
						if($this->input->post())
						{
							$temp_rule = Array(
								"&lt",
								"&gt",
								"<",
								">",
								"(",
								"="
							);
							
							$result = $this->payment_model->payment($_POST,'get_post_payment_data_airpay');
							//print_r($result);
							//die();
							
							if( $result['status'] )
							{
								$this->session->set_flashdata('info', $result['msg']);
								//print_r($result);
								$result_arr = array();
								
						    	$result_arr['result'] = $result['data'];
								//print_r($result_arr);die;
								$this->session->set_flashdata('info', $result['msg']);
								$this->load->view('payment/postpayment',$result_arr);
								//$data[] = $result;
								//$this->load->view('payment/postpayment',$data);
								//redirect('payment/postpayment',$result);
								//redirect($result['sel_payment_process_url'].'/'.$institute);
								
							}
							/*else
							{
								$this->session->set_flashdata('error', $result['msg']);
								redirect($this->agent->referrer());
							}*/
							
						}
						else
						{
							$this->load->view('payment/postpayment',$data);
						}
						$this->load->view('template_config/footer',$institute_list);
					/*}
					else
					{
						$this->load->view('payment/postpayment_fail');
					}
					
				}
			else
			{
				$this->load->view('payment/postpayment_fail');
			}*/
			
		/*}
		else
		{
			$this->load->view('payment/postpayment_fail');
		}*/
		
		//$this->load->model('index_model');
		//$institute_list['institute'] = $this->index_model->index_data('','get_institutes');
		//print_r($institute_list);
		//$this->load->view('index/index',$institute_list);
		//$this->load->view('template_config/footer');
	}
}
