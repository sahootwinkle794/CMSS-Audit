<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Process_payment extends CI_Controller
{
	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper(array('form'));		
		$this->load->helper('custom_encryption');		
		$this->load->helper('custom_security');
		# libraries
		$this->load->library('form_validation');
		$this->load->library('user_agent');
		# models
		$this->load->model('payment_model');
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
	public function index() {
		$institute = HARDCODE_INSTITUTE_CODE; // 1stsegment
		$program = $this->session->userdata('admcode');
		//$data = $this->uri->uri_to_assoc();
		//$institute = $data['ins'];
		$institute = $institute = $this->uri->segment(4);
		
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
						$this->load->view('template_config/header_index');
						
						$result = $this->payment_model->payment($data,'process_payment_billdesk');
						if( $result['status'] )
						{
							$this->session->set_flashdata('info', $result['msg']);
							
							/*redirect($result['payment_process_url']);
							redirect('payment/postpayment');*/
							//print_r($result);die();
							$this->load->view('payment/process_payment',$result);
							$this->load->view('index/pages/footer');
							
						}
						/*$this->load->view('payment/process_payment',$data);
						$this->load->view('index/pages/footer');*/
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
}