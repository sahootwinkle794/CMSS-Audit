<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller
{
	private $role;
	
	public function __construct() 
	{
		parent::__construct();
		
		# helpers
		$this->load->helper(array('form'));		
		$this->load->helper('custom_encryption');		
		$this->load->helper('custom_security');		
		$this->load->helper('transactionrequestbean');		
		$this->load->helper('transactionresponsebean');	
		/*$this->load->helper('transactionRequestBean');		
		$this->load->helper('transactionResponseBean');*/		
		//$this->load->helper('custom_captcha');	
		$this->load->helper('captcha');	
		
		# libraries
		$this->load->library('form_validation');
		$this->load->library('user_agent');
		
		
		$this->role = $this->session->userdata('role');
		//$this->load->library('../controllers/Mpdf_controller');
		# models
		$this->load->model('payment_model');
		$this->load->model('admin_model');
		$this->load->model('m_pdf_model');
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
		$this->load->view('template_config/footer');
	}
	public function st_postpayment()
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
							
							$result = $this->payment_model->payment($_POST,'get_post_payment_data_st');
							//print_r($result);
							//die();
							
							if( $result['status'] )
							{
								$this->session->set_flashdata('info', $result['msg']);
								//print_r($result);
								$result_arr = array();
								
						    	$result_arr['result'] = $result['data'];
								//print_r($result_arr);
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
	public function onlinepaymentinstruction()
	{
		//echo "hello";die;
		$institute = $this->uri->segment(3); // 1stsegment
		$program = $this->session->userdata('admcode');
		$data = $this->uri->uri_to_assoc();
		$institute = $data['ins'];
		//echo $program,"hello";die;
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
				/*echo $result['status'];
				die();*/
				if( $result['status'] )
				{
					$result = $this->payment_model->payment($program,'validate_program');
					
					if( $result['status'] )
					{
						$this->load->model('index_model');
						$this->session->set_userdata('institute_code', $institute);
						$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
						$this->load->view('template_config/header_index',$institute_list);
						//$this->load->view('template_config/header_index');
						$data['institute_data'] = $this->payment_model->payment($institute,'get_institute_data');
						$data['appl_status'] = $this->payment_model->payment($program,'get_appl_status');
						$data['program_data'] = $this->payment_model->payment($program,'get_program_detail');
						$data['applicant_data'] = $this->payment_model->payment($program,'get_applicant_detail');
						$data['categorydt'] = $this->payment_model->payment($program,'categorydata');
						$data['transaction_data'] = $this->payment_model->payment($program,'get_transaction_data');
						$data['amount_data'] = $this->payment_model->payment($program,'get_amount_data');
						//$data['application_data_from_institute'] = $this->payment_model->payment($ins,'get_application_from_institute');
						$data['payment_gateway_data'] = $this->payment_model->payment($institute,'get_payment_gateway_data');
						$data['application_data_from_institute'] = $this->payment_model->payment($ins,'get_application_from_institute');
						//print_r($application_data_from_institute);
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
			show_404();
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
						/*$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
						$this->load->view('template_config/header_index',$institute_list);*/
						//$this->load->view('template_config/header');
						
						$result = $this->payment_model->payment($data,'process_payment_techprocess');
						if( $result['status'] )
						{
							$this->session->set_flashdata('info', $result['msg']);
							//echo $result['payment_process_url'];die;
							redirect($result['payment_process_url']);
							redirect('Payment/postpayment');
							
						}
						$this->load->view('payment/process_payment',$data);
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
	//airpay
	public function process_payment_airpay()
	{
		$this->load->library('checksum');
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
							$this->load->view('template_config/footer');
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
	//end airpay
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
	public function postpayment()
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
							
							$result = $this->payment_model->payment($_POST,'get_post_payment_data');
							//print_r($result);
							//die();
							
							if( $result['status'] )
							{
								$this->session->set_flashdata('info', $result['msg']);
								//print_r($result);
								$result_arr = array();
								
						    	$result_arr['result'] = $result['data'];
								//print_r($result_arr);
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
					$this->load->view('template_config/header_index');
					$params   = $_SERVER['QUERY_STRING'];
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
					$this->load->view('index/pages/footer');
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
					$this->load->view('template_config/header_index');
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
					$this->load->view('template_config/footer');
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
					$this->load->view('template_config/header_index');
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
					$this->load->view('template_config/footer');
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
	public function process_payment_payu()
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
						/*echo "hiiiiiiii";
						die();*/
						$this->session->set_userdata('institute_code', $institute);
						/*$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
						$this->load->view('template_config/header_index',$institute_list);*/
						//$this->load->view('template_config/header');
						
						$result = $this->payment_model->payment($data,'process_payment_payu');
						if( $result['status'] )
						{
						
							$result_arr['result'] = $result['data'];
							$this->session->set_flashdata('info', $result['msg']);
							
							$this->load->view('payment/process_payment_payu',$result_arr);
							
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
	public function postpayment_payu()
	{
		//print_r($_POST);
		//$institute = $this->uri->segment(3); // 1stsegment
		$program = $this->session->userdata('admcode');
		$institute = $this->session->userdata('institute_code');
		$data = $this->uri->uri_to_assoc();
		$institute_code = $this->uri->segment(3);
		//die();
		$this->load->model('index_model');
		//$institute = $data['ins'];
		$institute = encrypt_decrypt('decrypt',$institute_code);
		//die();
		/*if($institute != '' && $program != '')
		{*/
			$data = array(
				'institute'=>$institute,
				'program'=>$program
			);
			$ins = encrypt_decrypt('encrypt',$institute);
			$result = $this->payment_model->payment($ins,'validate_institute');
			
			/*if( $result['status'] == true)
			{
					$result = $this->payment_model->payment($program,'validate_program');
					
					if( $result['status'] )
					{*/
						$this->session->set_userdata('institute_code', $institute);
						//$ins = encrypt_decrypt('decrypt',$institute);
						$institute_list['institute'] = $this->index_model->index_data($institute,'get_institutes');
						$this->load->view('template_config/header_index',$institute_list);
						//$this->load->view('template_config/header');
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
							
							$result = $this->payment_model->payment($_POST,'get_post_payment_data_payu');
							//print_r($result);
							//die();
							
							if( $result['status'] )
							{
								$this->session->set_flashdata('info', $result['msg']);
								//print_r($result);
								$result_arr = array();
								
						    	$result_arr['result'] = $result['data'];
								//print_r($result_arr);
								$this->session->set_flashdata('info', $result['msg']);
								$this->load->view('payment/postpayment',$result_arr);
								
								
							}
							
							
						}
						else
						{	
							
							$this->load->view('payment/postpayment',$data);
						}
						$this->load->view('template_config/footer',$institute_list);
					/*}
					else
					{
						redirect('apply/apply_logout/ins/'.$institute);
					}*/
				/*	
				}*/
			/*else
			{
				redirect('error');
			}*/
			
		/*}*/
		/*else
		{
			show_404();
		}*/
		
		//$this->load->model('index_model');
		//$institute_list['institute'] = $this->index_model->index_data('','get_institutes');
		//print_r($institute_list);
		//$this->load->view('index/index',$institute_list);
		//$this->load->view('template_config/footer');
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
					$this->load->view('template_config/header_index');
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
					$this->load->view('template_config/footer');
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
					$this->load->view('template_config/header_index');
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
								echo 'error in updation';
							}
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
			}
		}
		else
		{
			show_404();
		}
		
		
	}
	public function template007_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template007_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template007_pdf($admcode, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template007_pdf($admcode, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template007_pdf($admcode, 'get_applicant_mother');
        $data['allSiblingInfo'] = $this->m_pdf_model->template007_pdf($admcode, 'get_allSiblingInfo');
        $data['qualification_detail'] = $this->m_pdf_model->template007_pdf($admcode, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template007_pdf($admcode, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template007_pdf($admcode, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template007_pdf($admcode, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template007_pdf($admcode, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template007_pdf($admcode, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template007_pdf($admcode, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template007_pdf($admcode, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template007_pdf($admcode, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template007_pdf($admcode, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template007_pdf($admcode, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template007_pdf($admcode, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template007_pdf($admcode, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template007_pdf($admcode, 'reference_details');
        $data['tech_qual_data_5'] = $this->m_pdf_model->template007_pdf($admcode,'get_tech_qual_data_5');
		$data['tech_qual_data_6'] = $this->m_pdf_model->template007_pdf($admcode,'get_tech_qual_data_6');
		$data['tech_qual_data_7'] = $this->m_pdf_model->template007_pdf($admcode,'get_tech_qual_data_7');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template007_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template007_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        /*$pdf->AddPage();*/
       /* $data['type'] = "BOTTOM";
        $html = $this->load->view('pdf/template009_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html); */       
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template009_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
    public function template032_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template007_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template007_pdf($admcode, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template007_pdf($admcode, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template007_pdf($admcode, 'get_applicant_mother');
        $data['allSiblingInfo'] = $this->m_pdf_model->template007_pdf($admcode, 'get_allSiblingInfo');
        $data['qualification_detail'] = $this->m_pdf_model->template007_pdf($admcode, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template007_pdf($admcode, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template007_pdf($admcode, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template007_pdf($admcode, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template007_pdf($admcode, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template007_pdf($admcode, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template007_pdf($admcode, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template007_pdf($admcode, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template007_pdf($admcode, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template007_pdf($admcode, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template007_pdf($admcode, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template007_pdf($admcode, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template007_pdf($admcode, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template007_pdf($admcode, 'reference_details');
        $data['tech_qual_data_5'] = $this->m_pdf_model->template007_pdf($admcode,'get_tech_qual_data_5');
		$data['tech_qual_data_6'] = $this->m_pdf_model->template007_pdf($admcode,'get_tech_qual_data_6');
		$data['tech_qual_data_7'] = $this->m_pdf_model->template007_pdf($admcode,'get_tech_qual_data_7');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template032_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template032_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        /*$pdf->AddPage();*/
       /* $data['type'] = "BOTTOM";
        $html = $this->load->view('pdf/template009_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html); */       
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template009_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
	public function template005_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template005_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template005_pdf($admcode, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template005_pdf($admcode, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template005_pdf($admcode, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template005_pdf($admcode, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template005_pdf($admcode, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template005_pdf($admcode, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template005_pdf($admcode, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template005_pdf($admcode, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template005_pdf($admcode, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template005_pdf($admcode, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template005_pdf($admcode, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template005_pdf($admcode, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template005_pdf($admcode, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template005_pdf($admcode, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template005_pdf($admcode, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template005_pdf($admcode, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template005_pdf($admcode, 'reference_details');
        $data['allSiblingInfo'] = $this->m_pdf_model->template009_pdf($admcode, 'get_allSiblingInfo');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template005_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template005_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        //$pdf->AddPage();
        //$data['type'] = "BOTTOM";
        //$html = $this->load->view('pdf/template005_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	//$pdf->WriteHTML($html);        
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$admcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template005_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
	public function download_print_application()
	{
		$admcode = $this->session->userdata('admcode');
		$appl_no = $this->session->userdata('appl_no');
		$file_path = BASE_ADM_URL."/DOCUMENTS/".$admcode."/".$appl_no."/application_print.pdf";
		//echo $admcode;
		//die();
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
	public function template009_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template009_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template009_pdf($admcode, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template009_pdf($admcode, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template009_pdf($admcode, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template009_pdf($admcode, 'reference_details');
        $data['tech_qual_data_5'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_5');
		$data['tech_qual_data_6'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_6');
		$data['tech_qual_data_7'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_7');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template009_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template009_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        //$pdf->AddPage();
       // $data['type'] = "BOTTOM";
       // $html = $this->load->view('pdf/template009_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	//$pdf->WriteHTML($html);        
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template009_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 

	public function template020_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template009_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template009_pdf($admcode, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template009_pdf($admcode, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template009_pdf($admcode, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template009_pdf($admcode, 'reference_details');
        $data['tech_qual_data_5'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_5');
		$data['tech_qual_data_6'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_6');
		$data['tech_qual_data_7'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_7');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template020_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template020_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        //$pdf->AddPage();
        //$data['type'] = "BOTTOM";
        //$html = $this->load->view('pdf/template020_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	//$pdf->WriteHTML($html);        
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template020_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
	public function template010_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template009_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template010_pdf($admcode, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_mother');
        $data['allSiblingInfo'] = $this->m_pdf_model->template009_pdf($admcode, 'get_allSiblingInfo');
        $data['qualification_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template009_pdf($admcode, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template009_pdf($admcode, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template009_pdf($admcode, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template009_pdf($admcode, 'reference_details');
        $data['tech_qual_data_5'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_5');
		$data['tech_qual_data_6'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_6');
		$data['tech_qual_data_7'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_7');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template010_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template009_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        /*$pdf->AddPage();*/
       /* $data['type'] = "BOTTOM";
        $html = $this->load->view('pdf/template009_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html); */       
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template009_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
    public function template034_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template009_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template010_pdf($admcode, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_mother');
        $data['allSiblingInfo'] = $this->m_pdf_model->template009_pdf($admcode, 'get_allSiblingInfo');
        $data['qualification_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template009_pdf($admcode, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template009_pdf($admcode, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template009_pdf($admcode, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template009_pdf($admcode, 'reference_details');
        $data['tech_qual_data_5'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_5');
		$data['tech_qual_data_6'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_6');
		$data['tech_qual_data_7'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_7');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template034_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template009_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        /*$pdf->AddPage();*/
       /* $data['type'] = "BOTTOM";
        $html = $this->load->view('pdf/template009_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html); */       
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template009_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
	public function template024_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template009_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template010_pdf($admcode, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_mother');
        $data['allSiblingInfo'] = $this->m_pdf_model->template009_pdf($admcode, 'get_allSiblingInfo');
        $data['qualification_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template009_pdf($admcode, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template009_pdf($admcode, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template009_pdf($admcode, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template009_pdf($admcode, 'reference_details');
        $data['tech_qual_data_5'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_5');
		$data['tech_qual_data_6'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_6');
		$data['tech_qual_data_7'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_7');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template024_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template009_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        /*$pdf->AddPage();*/
       /* $data['type'] = "BOTTOM";
        $html = $this->load->view('pdf/template009_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html); */       
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template009_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
    public function template021_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template005_pdf($order_id, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template005_pdf($order_id, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template005_pdf($order_id, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template005_pdf($order_id, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template005_pdf($order_id, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template005_pdf($order_id, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template005_pdf($order_id, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template005_pdf($order_id, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template005_pdf($order_id, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template005_pdf($order_id, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template005_pdf($order_id, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template005_pdf($order_id, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template005_pdf($order_id, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template005_pdf($order_id, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template005_pdf($order_id, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template005_pdf($order_id, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template005_pdf($order_id, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template005_pdf($order_id, 'reference_details');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template021_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template005_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
             
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template021_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
    public function template036_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template005_pdf($order_id, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template005_pdf($order_id, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template005_pdf($order_id, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template005_pdf($order_id, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template005_pdf($order_id, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template005_pdf($order_id, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template005_pdf($order_id, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template005_pdf($order_id, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template005_pdf($order_id, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template005_pdf($order_id, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template005_pdf($order_id, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template005_pdf($order_id, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template005_pdf($order_id, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template005_pdf($order_id, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template005_pdf($order_id, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template005_pdf($order_id, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template005_pdf($order_id, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template005_pdf($order_id, 'reference_details');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template036_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template005_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
             
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template021_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
    public function template031_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template005_pdf($order_id, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template005_pdf($order_id, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template005_pdf($order_id, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template005_pdf($order_id, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template005_pdf($order_id, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template005_pdf($order_id, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template005_pdf($order_id, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template005_pdf($order_id, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template005_pdf($order_id, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template005_pdf($order_id, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template005_pdf($order_id, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template005_pdf($order_id, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template005_pdf($order_id, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template005_pdf($order_id, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template005_pdf($order_id, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template005_pdf($order_id, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template005_pdf($order_id, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template005_pdf($order_id, 'reference_details');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template031_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template005_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
             
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template021_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
	public function template019_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template009_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template009_pdf($admcode, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template009_pdf($admcode, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template009_pdf($admcode, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template009_pdf($admcode, 'reference_details');
        $data['tech_qual_data_5'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_5');
		$data['tech_qual_data_6'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_6');
		$data['tech_qual_data_7'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_7');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template019_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template019_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        /*$pdf->AddPage();
        $data['type'] = "BOTTOM";
        $html = $this->load->view('pdf/template020_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html);  */      
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template019_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
    public function template035_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template009_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template009_pdf($admcode, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template009_pdf($admcode, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template009_pdf($admcode, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template009_pdf($admcode, 'reference_details');
        $data['tech_qual_data_5'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_5');
		$data['tech_qual_data_6'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_6');
		$data['tech_qual_data_7'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_7');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template035_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template019_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        /*$pdf->AddPage();
        $data['type'] = "BOTTOM";
        $html = $this->load->view('pdf/template020_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html);  */      
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template019_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
    public function template022_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template009_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template009_pdf($admcode, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template009_pdf($admcode, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template009_pdf($admcode, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template009_pdf($admcode, 'reference_details');
        $data['tech_qual_data_5'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_5');
		$data['tech_qual_data_6'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_6');
		$data['tech_qual_data_7'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_7');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template022_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template022_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        /*$pdf->AddPage();
        $data['type'] = "BOTTOM";
        $html = $this->load->view('pdf/template020_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html);  */      
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template022_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
    public function template023_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template009_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template009_pdf($admcode, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template009_pdf($admcode, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template009_pdf($admcode, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template009_pdf($admcode, 'reference_details');
        $data['tech_qual_data_5'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_5');
		$data['tech_qual_data_6'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_6');
		$data['tech_qual_data_7'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_7');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template023_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template023_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        /*$pdf->AddPage();
        $data['type'] = "BOTTOM";
        $html = $this->load->view('pdf/template020_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html);  */      
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template023_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
	public function template025_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template005_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template005_pdf($admcode, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template005_pdf($admcode, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template005_pdf($admcode, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template005_pdf($admcode, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template005_pdf($admcode, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template005_pdf($admcode, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template005_pdf($admcode, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template005_pdf($admcode, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template005_pdf($admcode, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template005_pdf($admcode, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template005_pdf($admcode, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template005_pdf($admcode, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template005_pdf($admcode, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template005_pdf($admcode, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template005_pdf($admcode, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template005_pdf($admcode, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template005_pdf($admcode, 'reference_details');
		$data['allSiblingInfo'] = $this->m_pdf_model->template005_pdf($admcode,'get_allSiblingInfo');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template025_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template025_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
             
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		$this->load->view('pdf/template025_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
	public function template026_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template009_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template010_pdf($admcode, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_mother');
        $data['allSiblingInfo'] = $this->m_pdf_model->template009_pdf($admcode, 'get_allSiblingInfo');
        $data['qualification_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template009_pdf($admcode, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template009_pdf($admcode, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template009_pdf($admcode, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template009_pdf($admcode, 'reference_details');
        $data['tech_qual_data_5'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_5');
		$data['tech_qual_data_6'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_6');
		$data['tech_qual_data_7'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_7');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template026_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template026_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        /*$pdf->AddPage();*/
       /* $data['type'] = "BOTTOM";
        $html = $this->load->view('pdf/template009_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html); */       
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template009_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
	public function template027_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template009_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template009_pdf($admcode, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template009_pdf($admcode, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template009_pdf($admcode, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template009_pdf($admcode, 'reference_details');
        $data['tech_qual_data_5'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_5');
		$data['tech_qual_data_6'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_6');
		$data['tech_qual_data_7'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_7');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template027_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template027_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        /*$pdf->AddPage();
        $data['type'] = "BOTTOM";
        $html = $this->load->view('pdf/template020_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html);  */      
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template019_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
	public function template037_pdf() {
		$admcode = $this->session->userdata('admcode');
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template009_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template009_pdf($admcode, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template009_pdf($admcode, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template009_pdf($admcode, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template009_pdf($admcode, 'get_applicant_documents');
        $data['research_employmen'] = $this->m_pdf_model->template009_pdf($admcode, 'research_employmen_details');
        $data['reference_details'] = $this->m_pdf_model->template009_pdf($admcode, 'reference_details');
        $data['tech_qual_data_5'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_5');
		$data['tech_qual_data_6'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_6');
		$data['tech_qual_data_7'] = $this->m_pdf_model->template009_pdf($admcode,'get_tech_qual_data_7');
		
        $data['type'] = "TOP";
		$html = $this->load->view('pdf/template037_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "template027_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->pdf;
        //generate the PDF!
        $pdf->WriteHTML($html);
        /*$pdf->AddPage();
        $data['type'] = "BOTTOM";
        $html = $this->load->view('pdf/template020_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->WriteHTML($html);  */      
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template019_pdf');
		//$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
}
