<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller
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
		$this->load->model('admin_model');
		//$data['role'] = $this->session->userdata('role');
		
		$this->load->helper(array('form'));
		# libraries
		$this->load->library('form_validation');
		$this->load->library('user_agent');
        $this->load->view('template_config/admin_header');
	}


	/*
	*	purpose : to check whether the method is correct or not
	*/
	
	public function _remap($method)
	{
		$class 	= $this->router->class;
		$role = $this->session->userdata('role');
		if( !in_array($role, array('ADMIN','TRAINEE')) )
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
	
	/**
	*	purpose : Entry point of user controller
	*/
	
	/*public function index()
	{
		$this->load->view('applicant/landing_page');
		$this->load->view('template_config/admin_footer');
	}*/

	public function index()
	{
		redirect('/dashboard');
		
	}	
	public function dashboard()
	{
		//echo 'hi';die();
		$sidebar['menu_item'] = 'Dashboard';
		$sidebar['menu_group'] = 'Dashboard';
		$sidebar['sidebar'] = $this->admin_model->admin($sidebar,'get_sidebar');
		$this->load->view('template_config/header');
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('admin_controller/dashboard');
		$this->load->view('template_config/template_setting');
		
		$this->load->view('template_config/admin_footer');
	}
	
	/**
	* Author   : lina Mohapatra, Ashish Narayan Barick
	* Function : operation_resourcedata,
	* purpose  : Resource & Role data operation, Menu data operation 
	* Date     : 11/09/2017
	* Remark   : load the view page and show the dropdown
	* 
	*/
	
 	public function manage_resource()
 	{
  		$sidebar['menu_item'] = 'Manage Resource';
  		$sidebar['menu_group'] = 'Manage Resource';
  		$sidebar['sidebar'] = $this->admin_model->admin($sidebar,'get_sidebar');
  		$this->load->view('template_config/header');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$data['all_role_data'] = $this->admin_model->admin(NULL,'get_role');
  		$data['all_link_url_data'] = $this->admin_model->admin(NULL,'get_url_link');
  		$data['all_resource_data'] = $this->admin_model->admin(NULL,'get_resource');
  		
  		$this->load->view('superadmin/manage_resource',$data);
  		$this->load->view('template_config/template_setting');
  		
  		$this->load->view('template_config/admin_footer');
 	}
 	
 	
	/**
	* Author   : lina Mohapatra, Rahul Patro
	* Function : operation_groupdata,
	* purpose  : Group data operation, 
	* Date     : 15/09/2017
	* Remark   : load the view page and show the dropdown
	* 
	*/

 	public function manage_group()
 	{
  		$sidebar['menu_item'] = 'Manage Group';
		$sidebar['menu_group'] = 'Manage Group';
		$sidebar['sidebar'] = $this->admin_model->admin($sidebar,'get_sidebar');
  		$this->load->view('template_config/header');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$viewdata['table_data'] = $this->admin_model->admin(NULL,'get_table');
		$viewdata['all_role_data'] = $this->admin_model->admin(NULL,'get_role');
  		$viewdata['all_group_data'] = $this->admin_model->admin(NULL,'get_group');
  		$viewdata['all_rolegroup_data'] = $this->admin_model->admin(NULL,'get_rolegroup_code');
  		$viewdata['all_user_data'] = $this->admin_model->admin(NULL,'get_user_code');
  		$this->load->view('superadmin/manage_group',$viewdata);
  		$this->load->view('template_config/template_setting');
  		
  		$this->load->view('template_config/admin_footer');
 	}
	public function manage_location()
	{
		//echo 'hi' ; die();
		$data['menu_item'] = 'Manage Location';
		$data['menu_group'] = '';
		$data['role'] = 'superadmin';
		$this->load->view('template_config/header',$data);
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('superadmin/manage_location');
		$this->load->view('template_config/template_setting');
		
		$this->load->view('template_config/admin_footer');
	}
	public function manage_user()
	{
		//echo 'hi' ; die();
		$sidebar['menu_item'] = 'Manage User';
		$sidebar['menu_group'] = 'Manage User';
		$sidebar['sidebar'] = $this->admin_model->admin($sidebar,'get_sidebar');
		$this->load->view('template_config/header');
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('superadmin/manage_user');
		$this->load->view('template_config/template_setting');
		
		$this->load->view('template_config/admin_footer');
	}

	public function account_profile()
	{
		$data['menu_item'] = '';
		$data['menu_group'] = '';
		$data['role'] = 'superadmin';
		$this->load->view('template_config/header',$data);
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('superadmin/account/account_setting');
		$this->load->view('template_config/template_setting');
		
		$this->load->view('template_config/admin_footer');
	}


}