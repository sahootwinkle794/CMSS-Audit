<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
	private $role;
	
	public function __construct() 
	{
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
		//$this->load->model('admin_model');
		//$this->load->model('getter_model');
		
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		$this->load->model('index_model');
		//$this->load->view('template_config/admin_header');
		
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
		redirect('login');
	}

	
	/**
	*	purpose : Authenticate user
	*/
	public function login()
	{
		$institute_list = array();
		$institute = $this->uri->segment(4); // 1stsegment
		$ins =  encrypt_decrypt('decrypt', $institute);
		/*ECHO $ins;
		DIE();*/
		$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');
		$institute_list['header'] = '';
		$this->load->view('template_config/header_index',$institute_list);
		# if post is not empty
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
	            $this->session->set_flashdata('error', $data['msg']);
	            $this->session->set_flashdata('post_data', $this->input->post());
				redirect($this->agent->referrer());
			}
			else
			{
				$result = $this->user_model->login();
				//print_r($result);die();
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
			}
		}
		else
		{
			$key = $this->session->userdata('key');
			if($key == '')
			{
				$this->session->set_userdata('key',uniqid());
			}
			$this->load->view('user/login');
			$this->load->view('index/pages/footer');
		}
	}
	public function force_change_password()
	{
		$institute_list = array();
		/*$institute = $this->uri->segment(4); // 1stsegment
		$ins =  encrypt_decrypt('decrypt', $institute);
		$institute_list['institute'] = $this->index_model->index_data($ins,'get_institutes');*/
		if( $this->input->post())
		{
			//print_r($_POST);die;
			$result = $this->user_model->change_password();
			//print_r($result);
			if( $result['status'] )
			{
				$this->session->set_flashdata('info', $result['msg']);
				//echo json_encode($result);
				echo "<script>
				alert('Your Password Changed Successfully.');
				window.location.href='logout';
				</script>";
				//redirect($this->agent->referrer());
				//redirect('user/logout');
			}
			else
			{
				//echo "error";
				$this->session->set_flashdata('error', $result['msg']);
				redirect($this->agent->referrer());
			}
			
			//redirect('superadmin_controller');
		}
		else
		{
			
			$this->load->view('user/force_change_password');
		}
		
	}
	
	/**
	*	purpose : Show dashboard
	*/	
	public function dashboard()
	{
		$this->load->view('template_config/admin_header');
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
	
        
	// logout user 
	public function logout()
	{
		//echo "hii";die;
		$institute_code = $this->session->userdata('institute_code');
		if($institute_code == '')
		{
			$institute_code = 'RECINS001';
		}
		
		
		$result = $this->user_model->logout();
		//echo json_encode($this->user_model->logout());
		//print_r($result);die;
		if($result['status']== true){
			$this->session->unset_userdata('user_code');
			$this->session->unset_userdata('user_name');
			$this->session->unset_userdata('user_display_name');
			$this->session->unset_userdata('role');
			$this->session->unset_userdata('group_code');
			$this->session->sess_destroy();
			redirect('Index/institute_index/ins/'.$institute_code);
		}else if($result['status']== false){
			redirect($this->agent->referrer());
			
		}
		
		/*$this->session->unset_userdata('user_code');
		$this->session->unset_userdata('user_name');
		$this->session->unset_userdata('user_display_name');
		$this->session->unset_userdata('role');
		$this->session->unset_userdata('group_code');
		$this->session->sess_destroy();
		// redirect to login
		$ins =  encrypt_decrypt('encrypt', $institute_code);
		$this->session->set_flashdata('info', 'User logout');
		//echo $institute_code."fsafasffs";die();
		if($institute_code == '')
		{
			$institute_code = 'RECINS001';
		}*/
		/*echo $ins;
		die();*/
		//redirect('Index/institute_index/ins/'.$institute_code);
		
	}
	public function change_password()
	{
		if( $this->input->post())
		{
			$result = $this->user_model->change_password();
			print_r($result);
			if( $result['status'] )
			{
				$this->session->set_flashdata('info', $result['msg']);
				redirect('user/login');
			}
			else
			{
				//echo "error";
				$this->session->set_flashdata('error', $result['msg']);
				redirect($this->agent->referrer());
			}
			
			//redirect('superadmin_controller');
		}
		else
		{
			
			$this->load->view('user/change_password');
		}
		
	}

}