<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_response extends CI_Controller
{
	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper(array('form'));		
		$this->load->helper('custom_encryption');		
		$this->load->helper('custom_security');
	    # models
		$this->load->model('payment_model');
		# libraries
		$this->load->library('form_validation');
		$this->load->library('user_agent');
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
		//$_POST = Array ( 'msg' => 'SVNIRTAR|NIRPROG1_NIRTAR2018000011|LCIT6187782690|662155-822616|2.00|CIT|510372|03|INR|DIRECT|NA|NA|00000000.00|03-04-2018 19:07:20|0300|NA|NIRPROG1NIRTAR1811|NA|NA|NA|NA|NA|NA|NA|Success|BC60A8B9D338EB43E0566ACE184C078EE738A24AB8B2E3B7E6A99BA0980649F9', 'hidRequestId' => 'PGIBL1000', 'hidOperation' => 'B101' ); 
        //print_r($_POST);die(); 
      $data['update_status'] = $this->payment_model->payment($_POST, 'billdesk_payment_response');
      //$data['update_status']['status'] = false;
      //print_r($data['update_status']);die();
      if($data['update_status']['status']){
      	$this->session->set_flashdata('info', $data['update_status']['msg']);
	  	redirect('apply/apply_4/ins/'.$this->session->userdata('institute_code'));
	  }else{
	  	$this->session->set_flashdata('error', $data['update_status']['msg']);
	  	//echo $this->session->flashdata('error');die();
	  	redirect('apply/apply_4/ins/'.$this->session->userdata('institute_code'));
	  }
    }      
}