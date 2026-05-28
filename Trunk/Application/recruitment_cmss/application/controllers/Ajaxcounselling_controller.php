<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajaxcounselling_controller extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		# helpers
		$this->load->helper(array('form'));
		$this->load->helper('custom_encryption');
		$this->load->helper('custom_security');
		$this->load->helper('captcha');	
		# library
		$this->load->library('form_validation');
		#models
		$this->load->model('SuperadminCounselling_model');
		$this->load->model('adminCounselling_model');
		$this->load->model('ApplyCounselling_model');
		$this->load->model('Feedback_model');
		
		
	}
	
	/*
	*	purpose : if request is not an ajax request then show error
	*/
	public function _remap($method){
		self::$method();		
	}
	
	/**
	*	purpose : get extension 
	*/
	private function getExtension($pFileName = null) 
	{
		 $i = strrpos($pFileName,".");
		 if( !$i ) {
			return false;
		 }			 
		 $nameLength = strlen($pFileName) - $i;
		 return substr($pFileName,$i+1,$nameLength);
	}

	/**
	*	purpose : Generate unique id
	*/
	private function get_unique_id()
	{
		return $id = md5(strtotime(date('Y-m-d H:i:s'))).uniqid();
	}
	
	/*
	*	Return data to the user data
	*/
	
	/**
	* Author   		: Rahul Patro,Ashish Narayan Barick,Lina Mohapatra  
	* Function 		: get_datatable_data,
	* purpose  		: To show data in datatable, 
	* List of data 	:User, Menu, Role, Resource, Group
	* Date     		: 11/09/2017
	* Remark   		:  Get data from model and forward data as JSON 
	*/
	
    public function get_datatable_data()
    {
		$type = $this->uri->segment(3);
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $type));
	}  
	public function select_institute_setup_data(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_institute_setup_data'));
	}
	
	public function create_captcha()
	{
		$config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path' 	=> FCPATH.'public/assets/fonts/captcha.ttf',
            'img_width'     => '150',
            'img_height'    => 50,
            'word_length'   => 6,
            'font_size'     => 20,
            'pool'			=>'23456789ABCDEFGHJKLMNPQRSTUVWXYZ',
            'colors'	=> array(
				'background'=> array(17,26,69),
				'border'	=> array(255,255,255),
				'text'		=> array(255,255,255),
				'grid'		=> array(0,80,108)
			)
        );
        $captcha = create_captcha($config);
        
        // Unset previous captcha and store new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
		echo $captcha['image'];
	}
    public function refresh_captcha(){
        // Captcha configuration
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path' 	=> FCPATH.'public/assets/fonts/captcha.ttf',
            'img_width'     => '150',
            'img_height'    => 50,
            'word_length'   => 6,
            'font_size'     => 20,
            'pool'			=>'23456789ABCDEFGHJKLMNPQRSTUVWXYZ',
            'colors'	=> array(
				'background'=> array(17,26,69),
				'border'	=> array(255,255,255),
				'text'		=> array(255,255,255),
				'grid'		=> array(0,80,108)
			)
        );
        $captcha = create_captcha($config);
        
        // Unset previous captcha and store new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
        
        // Display captcha image
        echo $captcha['image'];
    }
	
	public function create_captcha_feedback()
	{
		$config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path' 	=> FCPATH.'public/assets/fonts/captcha.ttf',
            'img_width'     => '150',
            'img_height'    => 50,
            'word_length'   => 6,
            'font_size'     => 20,
            'pool'			=>'23456789ABCDEFGHJKLMNPQRSTUVWXYZ',
            'colors'	=> array(
				'background'=> array(17,26,69),
				'border'	=> array(255,255,255),
				'text'		=> array(255,255,255),
				'grid'		=> array(0,80,108)
			)
        );
        $captcha = create_captcha_feedback($config);
        
        // Unset previous captcha and store new captcha word
        $this->session->unset_userdata('captchaCodefeedback');
        $this->session->set_userdata('captchaCodefeedback',$captcha['word']);
		echo $captcha['image'];
	}
    public function refresh_captcha_feedback(){
        // Captcha configuration
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path' 	=> FCPATH.'public/assets/fonts/captcha.ttf',
            'img_width'     => '150',
            'img_height'    => 50,
            'word_length'   => 6,
            'font_size'     => 20,
            'pool'			=>'23456789ABCDEFGHJKLMNPQRSTUVWXYZ',
            'colors'	=> array(
				'background'=> array(17,26,69),
				'border'	=> array(255,255,255),
				'text'		=> array(255,255,255),
				'grid'		=> array(0,80,108)
			)
        );
        $captcha = create_captcha_feedback($config);
        
        // Unset previous captcha and store new captcha word
        $this->session->unset_userdata('captchaCodefeedback');
        $this->session->set_userdata('captchaCodefeedback',$captcha['word']);
        // Display captcha image
        echo $captcha['image'];
    }
	
	
	
	
	/**
	* Author   : Rahul Patro, 
	* Function : operation_userdata,
	* purpose  : user data operation, 
	* Date     : 11/09/2017
	* Remark   : server-side validation,data operation 
	* 			 send to model side
	*/
   
    public function operation_userdata(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			if($_POST['hiduser_name'] == $_POST['txtUserName'] && $_POST['op_type'] == 'edit_user'){
				$config = array(
	               
	               array(
	                     'field'   => 'txtDisplayName',
	                     'label'   => 'Display Name',
	                     'rules'   => 'required'
	                  )
	            );
			}else{
				$config = array(
	               array(
	                     'field'   => 'txtUserName',
	                     'label'   => 'User Name',
	                     'rules'   => 'trim|required|is_unique[user_master.user_name]'
	                  ),
	               array(
	                     'field'   => 'txtDisplayName',
	                     'label'   => 'Display Name',
	                     'rules'   => 'required'
	                  )
	            );
			}
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}else{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['op_type']));
			}
		}
    	 
		
	}
	public function operation_institute_edit(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			if($_POST['op_type_institute'] == 'edit_institute'){
				$optype = 'edit_institute';
				$config = array(
	               
	                array(
	                     'field'   => 'instituteeditcode',
	                     'label'   => 'Institute Code',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'instituteeditname',
	                     'label'   => 'Institute Name',
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'txtinstituteTypeEdit',
	                     'label'   => 'Institute Type',
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'instituteadmindisplaynameEdit',
	                     'label'   => 'Display Name',
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'instituteadminusernameEdit',
	                     'label'   => 'Admin User Name',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtContactNoEdit',
	                     'label'   => 'Contact No',
	                     'rules'   => 'required'
	                  )
	            );
			}
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $optype));
			} 
			
		}
    	
	}
	
	public function admin_dashboard(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'admin_dashboard'));
	}
	public function db_get_json(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'db_get_json'));
	}
	public function select_program_email(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_program_email'));
	}
	
	public function select_program_sms(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_program_sms'));
	}
	
	public function select_all_sms(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_all_sms'));
	}
	
	public function select_communication_sms(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_communication_sms'));
	}
	
	public function update_multiple_sms(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'update_multiple_sms'));
	}
	public function update_single_sms(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'update_single_sms'));
	}
	
	public function select_communication_menu(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_communication_menu'));
	}
	
	public function select_communication_assign(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_communication_assign'));
	}
	
	public function update_multiple_email(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'update_multiple_email'));
	}
	
	public function update_communication_email(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'update_communication_email'));
	}
	
	public function operation_institute_add(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'add_institute';
			$config = array(
	           array(
	                 'field'   => 'institutecode',
	                 'label'   => 'Institute Code',
	                 'rules'   => 'trim|required|is_unique[institute_master.institute_code]'
	              ),
	           array(
	                 'field'   => 'institutename',
	                 'label'   => 'Institute Name',
	                 'rules'   => 'required'
	              ),
	           array(
	                 'field'   => 'txtinstituteType',
	                 'label'   => 'Institute Type',
	                 'rules'   => 'required'
	              ),
	           array(
	                 'field'   => 'instituteadmindisplayname',
	                 'label'   => 'Display Name',
	                 'rules'   => 'required'
	              ),
	           array(
	                 'field'   => 'instituteadminusername',
	                 'label'   => 'Admin User Name',
	                 'rules'   => 'trim|required'
	              ),
	           array(
	                 'field'   => 'txtContactNo',
	                 'label'   => 'Contact No',
	                 'rules'   => 'required'
	              )
	           
	        );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $optype));
			} 
		}
		
	} 
	public function operation_application_mode(){	
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
            echo json_encode($data);
			//die();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['op_type_application']));
		}
	}
	
	
	public function operation_payment_mode(){	
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
            echo json_encode($data);
			//die();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'edit_payment_mode'));
		}
	}
	public function select_resource(){	
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
            echo json_encode($data);
			//die();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin('', 'get_resource'));
		}
	}
	public function select_role(){	
		
		echo json_encode($this->SuperadminCounselling_model->superadmin('', 'get_role'));
	}
	public function get_payment_mode(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_payment_mode'));
	}
	public function select_copy_role(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_copy_role'));
	}
	public function select_menu(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin('', 'get_menu'));
	}
	public function select_parent(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin('', 'get_parent'));
	}
	public function select_institute(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin('', 'get_institute'));
	}
	public function select_exam_center(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_exam_center'));
	}
	public function select_exam_center_edit(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_exam_center_edit'));
	}
	public function SELECT_EXAM_FOR_EXAM_CENTER_SETUP(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_exam_for_exam_center_setup'));
	}
	public function get_add_exam_center(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'add_exam_centre'));
	}
	public function delete_exam_centerdata(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_exam_center'));
	}
	public function select_institute_center(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_institute_center'));
	}
	public function select_user(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin('', 'get_user_data'));
	}
	public function select_code(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin('', 'get_code'));
	}
	public function select_code_desc(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_code_desc'));
	}
	public function select_template(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin('', 'get_template'));
	}
	public function select_program_menu(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_program_menu_generic_setup1'));
	}
	public function select_program_group(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_program_group_generic_setup1'));
	}
	public function select_program_document(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin('', 'get_document_master'));
	}
	public function select_category(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin('', 'get_category_master'));
	}
	public function select_religion(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin('', 'get_religion'));
	}
	public function select_caste(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin('', 'get_caste'));
	}
	public function select_instruction(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin('', 'get_instruction'));
	}
	public function select_minority(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin('', 'get_minority_community'));
	}
	public function select_sms_provider(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin('', 'get_sms_provider'));
	}
	public function select_sms_setup(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin('', 'get_sms_setup'));
	}
	public function select_email_provider(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin('', 'get_email_provider'));
	}
	public function select_email_setup(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin('', 'get_email_setup'));
	}	
	public function select_institute_user(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_user_institutewise'));
	}
	public function select_institute_program(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_program_institutewise'));
	}
	public function select_user_program_mapping(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_user_program_mapping'));
	}
	public function select_user_program_manage(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_user_program_manage'));
	}
	public function select_payment_verification(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_payment_verification'));
	}
	public function select_pg_report(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_pg_report'));
	}
	public function select_payment_gateway_master(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_payment_gateway_master'));
	}
	public function add_payment_gateway_master(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'add_payment_gateway_master'));
	}
	public function edit_payment_gateway_master(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'edit_payment_gateway_master'));
	}
	public function get_pg_code_list(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_pg_code_list'));
	}
	public function get_pg_parameter(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_pg_parameter'));
	}
	public function add_pg_parameter(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'add_pg_parameter'));
	}
	public function edit_pg_parameter(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'edit_pg_parameter'));
	}
	public function select_institutes(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'select_institutes'));
	}
	public function select_pgcodes(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'select_pgcodes'));
	}
	public function get_pg_parameter_values(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_pg_parameter_values'));
	}
	public function select_pgparameter_codes(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'select_pgparameter_codes'));
	}
	public function add_pg_parameter_values(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'add_pg_parameter_values'));
	}
	public function edit_pg_parameter_values(){	
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'edit_pg_parameter_values'));
	}
	
	
	
	/**
	* Author   : Ashish Narayan Barick, 
	* Function : operation_menudata,
	* purpose  : Menu data operation, 
	* Date     : 11/09/2017
	* Remark   : server-side validation,data operation 
	* 			 send to model side
	*/
	
	public function operation_menudata(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	               array(
	                     'field'   => 'txtLinkText',
	                     'label'   => 'Link Text',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'cmbLinkUrl',
	                     'label'   => 'Link Url',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'cmbParent',
	                     'label'   => 'Parent',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtMenuSl',
	                     'label'   => 'Menu Sl No',
	                     'rules'   => 'trim|required'
	                  )
	            );
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) 
			{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($error_data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperTypeMenu']));
			} 	
		}
	} 
	public function delete_menudata(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_menu'));
		}
	}
	public function copy_menudata(){
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'copy_menu'));
	}
	/**
	* Author   : lina Mohapatra, 
	* Function : operation_roledata,
	* purpose  : Role data operation, 
	* Date     : 12/09/2017
	* Remark   : server-side validation,data operation 
	* 			 send to model side
	*/
	public function operation_roledata(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			if($_POST['hidOperTypeRole'] == 'edit_role'){
				$config = array(
	               array(
	                     'field'   => 'txtRoleName',
	                     'label'   => 'Role Name',
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'cmbLandingPageUrl',
	                     'label'   => 'Landing Page',
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'cmbProfilePageUrl',
	                     'label'   => 'Profile Page',
	                     'rules'   => 'required'
	                  )
	            );
				
			}
			else{
				$config = array(
	               array(
	                     'field'   => 'txtRoleCode',
	                     'label'   => 'Role Code',
	                     'rules'   => 'trim|required|is_unique[role_master.role_code]'
	                  ),
	               array(
	                     'field'   => 'txtRoleName',
	                     'label'   => 'Role Name',
	                     'rules'   => 'required'
	                  ),
	               array(
	                     'field'   => 'cmbLandingPageUrl',
	                     'label'   => 'Landing Page',
	                     'rules'   => 'required'
	                  ),
					array(
	                     'field'   => 'cmbProfilePageUrl',
	                     'label'   => 'Profile Page',
	                     'rules'   => 'required'
	                  )
	            );
			}
			
			$this->form_validation->set_rules($config); 
		    if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}else{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperTypeRole']));
			} 
		}
		
	}	
	public function delete_roledata(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_roledata'));
		}
	}
	
	/**
	* Author   : lina Mohapatra, 
	* Function : operation_resourcedata,
	* purpose  : Resource data operation, 
	* Date     : 11/09/2017
	* Remark   : server-side validation,data operation 
	* 			 send to model side
	*/
	
	public function operation_resourcedata(){
		//echo $_POST['hidOperTypeResource'];
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	           array(
	                 'field'   => 'txtResourceCode',
	                 'label'   => 'Resource Code',
	                 'rules'   => 'required'
	              ),
	           array(
	                 'field'   => 'txtResourceName',
	                 'label'   => 'Resource Name',
	                 'rules'   => 'required'
	              )
	        );
		
		
			$this->form_validation->set_rules($config); 
			
		    if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    
			}else{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperTypeResource']));
			} 
		}
		
	}
	public function check_duplicate_resource(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_resource'));
		}
	}
	public function check_duplicate_role(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_role'));
		}
	}
	public function check_duplicate_code(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_code'));
		}
	}
	public function check_duplicate_code_desc(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_code_desc'));
		}
	}
	public function check_program_menu_code(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_program_menu_add'));
		}
	}
	public function check_program_menu_code_edit(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_program_menu_edit'));
		}
	}
	public function check_program_group_code(){
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_program_group_add'));	
	}
	public function check_program_group_code_edit(){
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_program_group_edit'));	
	}
	public function check_document(){
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_document'));	
	}
	public function check_document_edit(){
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_document_edit'));	
	}
	public function check_category(){
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_category'));	
	}
	public function check_category_edit(){
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_category_edit'));	
	}
	public function check_minority(){
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_minority'));	
	}
	public function check_minority_edit(){
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_minority_edit'));	
	}
	public function check_birth_date(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'check_birth_date'));	
	}
	public function resend_otp(){	
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'resend_otps'));
	}
	public function forgot_password(){	
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'forgot_password'));
	}
	public function check_email(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'check_email'));	
	}
	public function change_password(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'change_password'));	
	}
	public function select_linkfile_distribution(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'select_linkfile_distribution'));	
	}
	public function select_district_details(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'get_district_details'));	
	}
	public function select_cmbInstituteFilter_data(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'get_cmbInstituteFilter_data'));	
	}
	public function select_cmbProgramFilter_data(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'get_cmbProgramFilter_data'));	
	}
	public function select_cmbBranchFilter_data(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'get_cmbBranchFilter_data'));	
	}
	public function select_branch_data(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'get_branch_data'));	
	}
	public function select_branch_data_old(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'get_branch_data_old'));	
	}
	public function select_not_saved_branch_data(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'select_not_saved_branch_data'));	
	}
	/*public function select_branch_data_saved(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'select_branch_data_saved'));	
	}*/
	public function get_saved_data_old(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'get_saved_data_old'));	
	}
	public function save_branch_data_old(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'insert_branch_data_old'));	
	}
	public function select_saved_data(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'get_saved_data'));	
	}
	public function select_program_data_applicant(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'get_program_data_applicant'));	
	}
	public function lock_branch_data(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'lock_branch_data'));	
	}
	
	public function select_branch_data_saved(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'select_branch_data_saved'));	
	}
	public function get_saved_data(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'get_final_saved_data'));	
	}
	public function save_branch_data(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'insert_branch_data'));	
	}
	public function save_data_temporary(){
		
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'operation_save_data_temporary';
			
			echo json_encode($this->ApplyCounselling_model->apply($_POST, $optype)); 
		}
		
	} 
	public function delete_data_temporary(){
		
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'operation_delete_data_temporary';
			
			echo json_encode($this->ApplyCounselling_model->apply($_POST, $optype)); 
		}
		
	} 
	public function swap_data_temporary(){
		
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'operation_swap_data_temporary';
			
			echo json_encode($this->ApplyCounselling_model->apply($_POST, $optype)); 
		}
		
	} 
	public function move_up_data_temporary(){
		
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'operation_move_up_data_temporary';
			
			echo json_encode($this->ApplyCounselling_model->apply($_POST, $optype)); 
		}
		
	}
	public function move_down_data_temporary(){
		
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'operation_move_down_data_temporary';
			
			echo json_encode($this->ApplyCounselling_model->apply($_POST, $optype)); 
		}
		
	} 	
	
	
	public function get_lock_status(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'get_lock_status'));	
	}
	public function get_lock_statuses(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'get_lock_statuses'));	
	}
	public function otp_choice_locking_submit(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'otp_choice_locking_submit'));	
	}
	public function otp_choice_locking()
	{
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'otp_choice_locking'));
			
	}
	public function get_course(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_course'));
	}
	public function get_discipline(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_discipline'));
	}
	public function get_course_discipline(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_course_discipline'));
	}
	public function select_institute_course_disc(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_institute_course_disc'));
	}
	public function select_institute_course_seat_disc(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_institute_course_seat_disc'));
	}
	public function get_program_branch_institute(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_program_branch_institute'));
	}
	public function get_program_branch_institute_category(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_program_branch_institute_category'));
	}
	public function get_program_branch_institute_seat_matrix_header1(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_program_branch_institute_seat_matrix_header1'));
	}
	public function select_program_branch_institute_seat_matrix_details(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_program_branch_institute_seat_matrix_details'));
	}
	public function get_from(){
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_from'));
	}
	public function get_to(){
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_to'));
	}
	public function AddMatrixData(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'AddMatrixData'));
	}
	//************************************************* generic setup ************************************************* 
	public function select_DocumentSetup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_DocumentSetup'));
	}
	
	public function ADD_DOCUMENT_SETUP(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'ADD_DOCUMENT_SETUP';
			
			$config = array(
	            array(
	                 'field'   => 'txtDocumentCode',
	                 'label'   => 'Document Code',
	                 'rules'   => 'trim|required|is_unique[document_type_master.document_type_code]'
	            ),
				array(
					'field'   => 'txtDocumentName',
					'label'   => 'Document Name',
					'rules'   => 'trim|required'
				)
	           
	        );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			} 
		}
		
	} 
	public function UPDATE_DOCUMENT_SETUP(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'UPDATE_DOCUMENT_SETUP';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
		}
		
	} 
	public function operation_delete_document_setup(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'operation_delete_document_setup';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype)); 
		}
		
	} 

	//************************************************* remark setup ************************************************* 
	public function select_Remark(){
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_Remark'));	
	}
	public function ADD_remarks(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'ADD_remarks';
			
			$config = array(
	            array(
	                 'field'   => 'txtRemark',
	                 'label'   => 'Remark',
	                 'rules'   => 'trim|required|is_unique[counselling_rejection_remarks.remarks]'
	            )
	           
	        );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			} 
		}
		
	} 
	
	public function operation_delete_remark(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'operation_delete_remark';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype)); 
		}
		
	} 
	//************************************************* category setup ************************************************* 

	public function select_CategorySetup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_CategorySetup'));
	}
	public function ADD_CATEGORY(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'ADD_CATEGORY';
			
			$config = array(
	            array(
	                 'field'   => 'txtCategoryCode',
	                 'label'   => 'Category Code',
	                 'rules'   => 'trim|required|is_unique[category_master.category_code]'
	            ),
				array(
					'field'   => 'txtCategoryName',
					'label'   => 'Category Name',
					'rules'   => 'trim|required'
				)
	           
	        );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			} 
		}
		
	} 
	public function UPDATE_CATEGORY(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'UPDATE_CATEGORY';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
		}
		
	} 
	public function operation_delete_category(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'operation_delete_category';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype)); 
		}
		
	} 

	//************************************************* special category setup *******************************************

	public function select_specialCategorySetup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_specialCategorySetup'));
	}
	public function ADD_SPECIAL_CATEGORY(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'ADD_SPECIAL_CATEGORY';
			
			$config = array(
	            array(
	                 'field'   => 'txtSpecialCategoryCode',
	                 'label'   => 'Category Code',
	                 'rules'   => 'trim|required|is_unique[category_master.category_code]'
	            ),
				array(
					'field'   => 'txtSpecialCategoryName',
					'label'   => 'Category Name',
					'rules'   => 'trim|required'
				)
	           
	        );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			} 
		}
		
	} 
	public function UPDATE_SPECIAL_CATEGORY(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'UPDATE_SPECIAL_CATEGORY';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
		}
		
	} 
	public function operation_delete_special_category(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'operation_delete_special_category';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype)); 
		}
		
	} 

	//*************************************************  CATEGORY TO DOCUMENT MAPPING *******************************
	public function select_CategoryDocument(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_CategoryDocument'));
	}
	public function select_cmbCategoryCode(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_cmbCategoryCode'));
	}
	public function select_cmbDocumentCode(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_cmbDocumentCode'));
	}
	public function ADD_CategoryDocumentMapping(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'ADD_CategoryDocumentMapping';
			
			$config = array(
	            array(
	                 'field'   => 'cmbCategoryCode',
	                 'label'   => 'Category',
	                 'rules'   => 'trim|required'
	            )
	           
	        );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			} 
		}
		
	} 
	public function UPDATE_CategoryDocumentMapping(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'UPDATE_CategoryDocumentMapping';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
		}
		
	} 
	public function operation_delete_CategoryDocumentMapping(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'operation_delete_CategoryDocumentMapping';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype)); 
		}
		
	} 

	//*************************************************  CATEGORY FEE SETUP ******************************************
	public function select_CategoryFee(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_CategoryFee'));
	}
	public function ADD_CategoryFee(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'ADD_CategoryFee';
			
			$config = array(
	            array(
	                 'field'   => 'cmbCategoryFeeCode',
	                 'label'   => 'Category',
	                 'rules'   => 'trim|required'
	            ),
	            array(
	                 'field'   => 'txtFee',
	                 'label'   => 'Amount',
	                 'rules'   => 'trim|required'
	            )
	           
	        );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			} 
		}
		
	} 
	public function UPDATE_CategoryFee(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'UPDATE_CategoryFee';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
		}
		
	} 
	public function operation_delete_CategoryFee(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'operation_delete_CategoryFee';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype)); 
		}
		
	} 
	public function select_counselling_period_data(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_counselling_period_data'));
	}
	
	//************************************************* COUNSELLING PERIOD SETUP ***************************************** 

	public function select_CounsellingPeriod(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_CounsellingPeriod'));
	}
	public function ADD_CounsellingPeriod(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'ADD_CounsellingPeriod';
			
			$config = array(
	            array(
	                 'field'   => 'txtCounsellingPeriodCode',
	                 'label'   => 'Counselling Period Code',
	                 'rules'   => 'trim|required|is_unique[counselling_period_master.counselling_period_code]'
	            ),
				array(
					'field'   => 'txtCounsellingPeriodName',
					'label'   => 'Counselling Period Name',
					'rules'   => 'trim|required'
				)
	           
	        );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			} 
		}
		
	} 
	public function UPDATE_CounsellingPeriod(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'UPDATE_CounsellingPeriod';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
		}
		
	} 
	public function operation_delete_CounsellingPeriod(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'operation_delete_CounsellingPeriod';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype)); 
		}
		
	} 

	
	//*************************************************  sheet matrix ************************************************* 
	public function get_sheetMatrix(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_sheetMatrix'));
	}
	public function get_checkAvailability(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_checkAvailability'));
	}
	//************************************************* nodal center setup ************************************************* 
	public function select_nodalCentre(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_nodalCentre'));
	}
	public function ADD_NODAL_CENTER(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'ADD_NODAL_CENTER';
			
			$config = array(
	            array(
	                 'field'   => 'txtCenterCode',
	                 'label'   => 'Center Code',
	                 'rules'   => 'trim|required'
	            ),
				array(
					'field'   => 'txtCenterCapacity',
					'label'   => 'Program Branch Institute',
					'rules'   => 'trim|required'
				),
				array(
					'field'   => 'txtCenterAddress',
					'label'   => 'Program Branch Institute',
					'rules'   => 'trim|required'
				),
	            array(
	                 'field'   => 'txtCenterName',
	                 'label'   => 'Category',
	                 'rules'   => 'required'
	            )
	           
	        );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			} 
		}
		
	} 
	public function UPDATE_NODAL_CENTER(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'UPDATE_NODAL_CENTER';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
		}
		
	} 
	public function operation_delete_nodal_centre(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'operation_delete_nodal_centre';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype)); 
		}
		
	} 
	public function select_cmbUserCode(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_cmbUserCode'));
	}
	
	//*************************************************  counter setup************************************************* 
	public function select_Counter(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_Counter'));
	}
	public function ADD_COUNTER(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'ADD_COUNTER';
			
			$config = array(
	            array(
	                 'field'   => 'txtCounterCode',
	                 'label'   => 'Counter Code',
	                 'rules'   => 'trim|required|is_unique[counselling_counter_master.counter_code]'
	            ),
				array(
					'field'   => 'txtCounterName',
					'label'   => 'Program Branch Institute',
					'rules'   => 'trim|required'
				)
	           
	        );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			} 
		}
		
	} 
	public function UPDATE_COUNTER(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'UPDATE_COUNTER';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
		}
		
	} 
	public function operation_delete_counter(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'operation_delete_counter';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype)); 
		}
		
	} 

	//*************************************************  NODAL CENTER TO COUNTER MAPPING *******************************
	public function select_NodalCounter(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_NodalCounter'));
	}
	public function select_cmbNodalCode(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_cmbNodalCode'));
	}
	public function select_cmbCounterCode(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_cmbCounterCode'));
	}
	public function ADD_NodalCounterMapping(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'ADD_NodalCounterMapping';
			
			$config = array(
	            array(
	                 'field'   => 'cmbNodalCode',
	                 'label'   => 'Counter Code',
	                 'rules'   => 'trim|required'
	            )
	           
	        );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			} 
		}
		
	} 
	public function UPDATE_NodalCounterMapping(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'UPDATE_NodalCounterMapping';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
		}
		
	} 
	public function operation_delete_NodalCounterMapping(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'operation_delete_NodalCounterMapping';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype)); 
		}
		
	} 

	//*************************************************  COUNSELLING setup************************************************* 
	public function get_counsellingSetup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_counsellingSetup'));
	}
	public function Add_counselling_setup(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'Add_counselling_setup';
			
			$config = array(
	            array(
	                 'field'   => 'txtProgramCode',
	                 'label'   => 'Counselling Code',
	                 'rules'   => 'trim|is_unique[counselling_master.counselling_code]'
	            )
	           
	        );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			} 
		}
		
	} 
	public function Update_counselling_setup(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'Update_counselling_setup';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
		}
		
	} 
	public function operation_delete_counsellingSetup(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'operation_delete_counsellingSetup';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype)); 
		}
		
	} 

	//*************************************************  STUDENTS ALLOTMENT *******************************
	public function get_counselling_code(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_counselling_code'));
	}
	public function get_allotment_program(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_allotment_program'));
	}
	public function get_allotment_branch(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_allotment_branch'));
	}
	public function get_counselling_year(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_counselling_year'));
	}
	public function get_generic_year(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_generic_year'));
	}
	public function get_verification_dates(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_verification_dates'));
	}
	public function get_applicants_allotment_details(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_applicants_allotment_details'));
	}
	public function get_applicants_allotment_details_percentage(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_applicants_allotment_details_percentage'));
	}
	public function get_centre_capacity(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_centre_capacity'));
	}
	public function assign_applicants_centre(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'assign_applicants_centre'));
	}
	
	//*************************************************  STUDENTS ASSIGNMENT *******************************
	
	/*public function get_counselling_code(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_counselling_code'));
	}*/
	public function get_applicants_attendance_details(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_applicants_attendance_details'));
	}
	public function get_assigned_counter_details(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_assigned_counter_details'));
	}
	public function get_counter_name(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_counter_name'));
	}
	public function assign_applicants_attendance(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'assign_applicants_attendance'));
	}
	public function get_token_no(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_token_no'));
	}
	public function change_token_no(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'change_token_no'));
	}
	
	//*************************************************  STUDENTS VERIFICATION *******************************
	
	public function get_applicants_verification_details(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_applicants_verification_details'));
	}
	public function valid_applicant(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'valid_applicant'));
	}
	public function invalid_applicant(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'invalid_applicant'));
	}
	public function get_checkList(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_checkList'));
	}
	public function get_rejection_reasons(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_rejection_reasons'));
	}
	public function get_applicantFeeDetails(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_applicantFeeDetails'));
	}
	
	//*************************************************  STUDENTS Final Allotment *******************************
	public function get_headers_final_allotment(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_headers_final_allotment'));
	}
	public function get_details_final_allotment(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_details_final_allotment'));
	}
	public function temporary_allotment(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'temporary_allotment'));
	}
	public function final_allotment(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'final_allotment'));
	}
	public function publish_applicants(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'publish_applicants'));
	}
	
	
	
	
	
	
	
	
	
	
	
	public function AddprogramBranchInstituteSeatMatrix(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'AddprogramBranchInstituteSeatMatrix'));
	}
	public function AddprogramBranchInstituteSeat(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'AddprogramBranchInstituteSeat';
			
			$config = array(
	           array(
	                 'field'   => 'cmbprogramBranchInstitute',
	                 'label'   => 'Program Branch Institute',
	                 'rules'   => 'trim|required'
	              ),
	           array(
	                 'field'   => 'cmbCategoryCode',
	                 'label'   => 'Category',
	                 'rules'   => 'required'
	              )
	           
	        );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			} 
		}
		
	} 
	public function UpdateprogramBranchInstituteSeat(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'UpdateprogramBranchInstituteSeat';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
		}
		
	} 
	public function ProgramBranchInstituteSeatDelete(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'ProgramBranchInstituteSeatDelete';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype)); 
		}
		
	} 
	public function operation_insert_course(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'add_course';
			$config = array(
	           array(
	                 'field'   => 'txtCourseCodeAdd',
	                 'label'   => 'Program Code',
	                 'rules'   => 'trim|required|is_unique[counselling_program_master.program_code]'
	              ),
	           array(
	                 'field'   => 'txtCourseNameAdd',
	                 'label'   => 'Program Name',
	                 'rules'   => 'required'
	              )
	           
	        );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			} 
		}
		
	} 
	public function operations_add_course_discipline(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'add_course_discipline';
			$config = array(
	           array(
	                 'field'   => 'cmbCourseAdd',
	                 'label'   => 'Program Code',
	                 'rules'   => 'trim|required'
	              ),
	           array(
	                 'field'   => 'cmbDisciplineAdd[]',
	                 'label'   => 'Discipline',
	                 'rules'   => 'required'
	              )
	           
	        );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			} 
		}
		
	} 
	public function operations_update_course_discipline(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'update_course_discipline';
			$config = array(
	           array(
	                 'field'   => 'cmbCourseAdd',
	                 'label'   => 'Program Code',
	                 'rules'   => 'trim|required'
	              ),
	           array(
	                 'field'   => 'cmbDisciplineAdd[]',
	                 'label'   => 'Discipline',
	                 'rules'   => 'required'
	              )
	           
	        );
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype)); 
		}
		
	} 
	public function operations_delete_course_discipline(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'delete_course_discipline';
			
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype)); 
		}
		
	} 
	public function operation_update_course(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'update_course';
			$config = array(
	           array(
	                 'field'   => 'txtCourseCodeAdd',
	                 'label'   => 'Program Code',
	                 'rules'   => 'trim|required'
	              ),
	           array(
	                 'field'   => 'txtCourseNameAdd',
	                 'label'   => 'Program Name',
	                 'rules'   => 'required'
	              )
	           
	        );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			} 
		}
		
	} 
	public function operation_delete_course(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'delete_course';
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			 
		}
		
	} 
	public function operation_insert_discipline(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'add_discipline';
			$config = array(
	           array(
	                 'field'   => 'txtDisciplineCodeAdd',
	                 'label'   => 'Branch Code',
	                 'rules'   => 'trim|required|is_unique[counselling_branch_master.branch_code]'
	              ),
	           array(
	                 'field'   => 'txtDisciplineAdd',
	                 'label'   => 'Branch Name',
	                 'rules'   => 'required'
	              )
	           
	        );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			} 
		}
		
	} 
	public function operation_update_discipline(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'update_discipline';
			$config = array(
	           array(
	                 'field'   => 'txtDisciplineCodeAdd',
	                 'label'   => 'Branch Code',
	                 'rules'   => 'trim|required'
	              ),
	           array(
	                 'field'   => 'txtDisciplineAdd',
	                 'label'   => 'Branch Name',
	                 'rules'   => 'required'
	              )
	           
	        );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			} 
		}
		
	} 
	public function operation_delete_discipline(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'delete_discipline';
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			 
		}
		
	} 
	public function operation_insert_course_discipline_ins(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'add_course_discipline_ins';
			echo json_encode($this->adminCounselling_model->admin($_POST, $optype));
			 
		}
		
	} 
	public function operation_code(){
		//echo $_POST['hidOperTypeResource'];
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	           array(
	                 'field'   => 'txtCodeGroup',
	                 'label'   => 'Code Group',
	                 'rules'   => 'required'
	              ),
	           array(
	                 'field'   => 'txtSequenceNo',
	                 'label'   => 'Code Name',
	                 'rules'   => 'required'
	              )
	        );
			
			$this->form_validation->set_rules($config); 
			
		    if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    
			}else{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperTypeCode']));
			} 
		}
		
	}
	public function operation_code_desc(){
		//echo $_POST['hidOperTypeResource'];
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	           array(
	                 'field'   => 'txtCode',
	                 'label'   => 'Code',
	                 'rules'   => 'required'
	              ),
	           array(
	                 'field'   => 'txtCodeDesc',
	                 'label'   => 'Code Description',
	                 'rules'   => 'required'
	              ),
	           array(
	                 'field'   => 'txtCodeSequenceNo',
	                 'label'   => 'Sequence No',
	                 'rules'   => 'required'
	              )
				
	        );
			
			$this->form_validation->set_rules($config); 
			
		    if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    
			}else{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperTypeCodeDesc']));
			} 
		}
		
	}
	public function delete_code(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_code'));
		}
	}
	public function delete_code_desc(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_code_desc'));
		}
	}
	public function operation_program_menu_add(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	               array(
	                     'field'   => 'txtMenuCode',
	                     'label'   => 'Menu Code',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtLinkText',
	                     'label'   => 'Link Text',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtLinkURL',
	                     'label'   => 'Link Url',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'cmbNewWindow',
	                     'label'   => 'New window',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'cmbDocumentUpload',
	                     'label'   => 'Document Upload',
	                     'rules'   => 'trim|required'
	                  ),
					array(
	                     'field'   => 'cmbRecordStatus',
	                     'label'   => 'Status',
	                     'rules'   => 'trim|required'
	                  ),
					array(
	                     'field'   => 'txtProgramMenuSlno',
	                     'label'   => 'Menu Sl No',
	                     'rules'   => 'trim|required'
	                  )  
	            );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) 
			{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($error_data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperProgramMenu']));
			} 
		}
	} 
	public function operation_program_menu_edit(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	               array(
	                     'field'   => 'txtMenuCode',
	                     'label'   => 'Menu Code',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtLinkText',
	                     'label'   => 'Link Text',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtLinkURL',
	                     'label'   => 'Link Url',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'cmbNewWindow',
	                     'label'   => 'New window',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'cmbDocumentUpload',
	                     'label'   => 'Document Upload',
	                     'rules'   => 'trim|required'
	                  ),
					array(
	                     'field'   => 'cmbRecordStatus',
	                     'label'   => 'Status',
	                     'rules'   => 'trim|required'
	                  ),
					array(
	                     'field'   => 'txtProgramMenuSlno',
	                     'label'   => 'Menu Sl No',
	                     'rules'   => 'trim|required'
	                  )  
	            );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) 
			{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($error_data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperProgramGroupEdit']));
			} 
		}	
	}	
	public function operation_program_group_add(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	               array(
	                     'field'   => 'txtProgramGroupCode',
	                     'label'   => 'Menu Code',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtProgramGroupName',
	                     'label'   => 'Link Text',
	                     'rules'   => 'trim|required'
	                  )
	            );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) 
			{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($error_data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperProgramGroup']));
			} 
		}	
	}
	
	public function operation_program_group_edit(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	               array(
	                     'field'   => 'txtProgramGroupCodeEdit',
	                     'label'   => 'Menu Code',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtProgramGroupNameEdit',
	                     'label'   => 'Link Text',
	                     'rules'   => 'trim|required'
	                  )
	            );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) 
			{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($error_data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperProgramGroupEdit']));
			} 
		}	
	}
	public function operation_program_document_add(){
		
		$config = array(
               array(
                     'field'   => 'txtDocumentCode',
                     'label'   => 'Document Code',
                     'rules'   => 'trim|required'
                  ),
               array(
                     'field'   => 'txtDocumentName',
                     'label'   => 'Document Name',
                     'rules'   => 'trim|required'
                  )
            );
		
  		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) 
		{
			$error_data = array(
                'status' => 'validationerror',
                'msg' => validation_errors()
            );
            echo json_encode($error_data);
		    //echo validation_errors();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperDocument']));
		} 
			
	}
	public function operation_program_document_edit(){
		
		$config = array(
               array(
                     'field'   => 'txtDocumentCodeEdit',
                     'label'   => 'Document Code',
                     'rules'   => 'trim|required'
                  ),
               array(
                     'field'   => 'txtDocumentNameEdit',
                     'label'   => 'Document Name',
                     'rules'   => 'trim|required'
                  )
            );
		
  		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) 
		{
			$error_data = array(
                'status' => 'validationerror',
                'msg' => validation_errors()
            );
            echo json_encode($error_data);
		    //echo validation_errors();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperDocumentEdit']));
		} 
			
	}
	public function operation_program_menu_delete(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_program_menu'));
		}
	}
	public function operation_program_group_delete(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_program_group'));
		}
	}
	public function operation_program_document_delete(){
			
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_document'));
		
	}
	public function operation_category_add(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	               array(
	                     'field'   => 'txtCategoryCode',
	                     'label'   => 'Category Code',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtCategoryName',
	                     'label'   => 'Category Name',
	                     'rules'   => 'trim|required'
	                  )
	            );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) 
			{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($error_data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperCategory']));
			} 
		}
	}
	public function operation_category_edit(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	               array(
	                     'field'   => 'txtCategoryCodeEdit',
	                     'label'   => 'Category Code',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtCategoryNameEdit',
	                     'label'   => 'Category Name',
	                     'rules'   => 'trim|required'
	                  )
	            );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) 
			{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($error_data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperCategoryEdit']));
			} 
		}
	} 
	public function operation_category_delete(){
			
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_category'));
		
	}
	public function operation_minority_add(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	               array(
	                     'field'   => 'txtMinoritycommunityCode',
	                     'label'   => 'Minority Community Code',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtMinoritycommunityName',
	                     'label'   => 'Minority Community Name',
	                     'rules'   => 'trim|required'
	                  )
	            );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) 
			{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($error_data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperMinority']));
			} 
		}
	}
	public function operation_minority_edit(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	               array(
	                     'field'   => 'txtMinoritycommunityCodeEdit',
	                     'label'   => 'Minority Community Code',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtMinoritycommunityNameEdit',
	                     'label'   => 'Minority Community Name',
	                     'rules'   => 'trim|required'
	                  )
	            );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) 
			{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($error_data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperMinorityEdit']));
			}  
		}
	} 
	public function operation_minority_delete(){
			
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_minority'));
		
	}
	public function operation_caste_add(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	               array(
	                     'field'   => 'txtCasteCode',
	                     'label'   => 'Caste Code',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtCasteName',
	                     'label'   => 'Caste Name',
	                     'rules'   => 'trim|required'
	                  )
	            );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) 
			{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($error_data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperCaste']));
			} 
		}
	}
	public function operation_caste_edit(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	               array(
	                     'field'   => 'txtCasteCodeEdit',
	                     'label'   => 'Caste Code',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtCasteNameEdit',
	                     'label'   => 'Caste Name',
	                     'rules'   => 'trim|required'
	                  )
	            );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) 
			{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($error_data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperCasteEdit']));
			} 
		}
	}
	public function operation_caste_delete(){
			
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_caste'));
		
	}
	public function operation_religion_add(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			":",
			"(",
			"="
		);
		if (hasXSS($_POST,$temp_rule)){
			//echo "2";
			$data = array(
                'status' => 'xsserror',
                'msg' => 'Special chararacters like <,>,=,(,),&lt;,&gt;,: are not allowed'
            );
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	               array(
	                     'field'   => 'txtReligionCode',
	                     'label'   => 'Caste Code',
	                     'rules'   => 'trim|required|is_unique[religion_master.religion_code]'
	                  ),
	               array(
	                     'field'   => 'txtReligionName',
	                     'label'   => 'Caste Name',
	                     'rules'   => 'trim|required'
	                  )
	            );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) 
			{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($error_data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperReligion']));
			} 
		}
	}
	public function operation_religion_edit(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			":",
			"(",
			"="
		);
		if (hasXSS($_POST,$temp_rule)){
			//echo "2";
			$data = array(
                'status' => 'xsserror',
                'msg' => 'Special chararacters like <,>,=,(,),&lt;,&gt;,: are not allowed'
            );
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	               array(
	                     'field'   => 'txtReligionCodeEdit',
	                     'label'   => 'Religion Code',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtReligionNameEdit',
	                     'label'   => 'Religion Name',
	                     'rules'   => 'trim|required'
	                  )
	            );
			
	  		$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) 
			{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($error_data);
			    //echo validation_errors();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperReligionEdit']));
			} 
		}
	}
	public function operation_religion_delete(){
			
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_religion'));
		
	}
	public function operation_instruction_add(){
		
		$config = array(
               array(
                     'field'   => 'txtPageCode',
                     'label'   => 'Page Code',
                     'rules'   => 'trim|required|is_unique[instruction_master.page_code]'
                  ),
               array(
                     'field'   => 'taInstruction',
                     'label'   => 'Instruction',
                     'rules'   => 'trim|required'
                  )
            );
		
  		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) 
		{
			$error_data = array(
                'status' => 'validationerror',
                'msg' => validation_errors()
            );
            echo json_encode($error_data);
		    //echo validation_errors();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperInstruction']));
		} 
		
	}
	public function operation_user_program(){
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'add_user_program'));
	}
	public function operation_instruction_edit(){
		
		$config = array(
               array(
                     'field'   => 'txtPageCodeEdit',
                     'label'   => 'Page Code',
                     'rules'   => 'trim|required'
                  ),
               array(
                     'field'   => 'taInstructionEdit',
                     'label'   => 'Instruction',
                     'rules'   => 'trim|required'
                  )
            );
		
  		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) 
		{
			$error_data = array(
                'status' => 'validationerror',
                'msg' => validation_errors()
            );
            echo json_encode($error_data);
		    //echo validation_errors();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperInstructionEdit']));
		} 
		
	}
	public function operation_instruction_delete(){
			
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_instruction'));
		
	}
	
	public function operation_sms_provider_add(){
		
		$config = array(
               	array(
                     'field'   => 'txtprovider',
                     'label'   => 'Provider',
                     'rules'   => 'trim|required'
                  ),
               	array(
                     'field'   => 'txtsmsUrl',
                     'label'   => 'SMS URL',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'txtUserName',
                     'label'   => 'Username',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'txtsmspassword',
                     'label'   => 'Password',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'txtSender',
                     'label'   => 'Sender Name',
                     'rules'   => 'trim|required'
                  )
            );
		
  		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) 
		{
			$error_data = array(
                'status' => 'validationerror',
                'msg' => validation_errors()
            );
            echo json_encode($error_data);
		    //echo validation_errors();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperProvider']));
		} 
		
	}
	public function operation_sms_provider_edit(){
		
		$config = array(
               	array(
                     'field'   => 'txtproviderEdit',
                     'label'   => 'Provider',
                     'rules'   => 'trim|required'
                  ),
               	array(
                     'field'   => 'txtsmsUrlEdit',
                     'label'   => 'SMS URL',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'txtUserNameEdit',
                     'label'   => 'Username',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'txtsmspasswordEdit',
                     'label'   => 'Password',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'txtSenderEdit',
                     'label'   => 'Sender Name',
                     'rules'   => 'trim|required'
                  )
            );
		
  		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) 
		{
			$error_data = array(
                'status' => 'validationerror',
                'msg' => validation_errors()
            );
            echo json_encode($error_data);
		    //echo validation_errors();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperProviderEdit']));
		} 
		
	}
	public function operation_provider_delete(){
			
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_sms_provider'));
		
	}
	public function operation_email_provider_add(){
		
		$config = array(
               	array(
                     'field'   => 'txtprovider',
                     'label'   => 'Provider',
                     'rules'   => 'trim|required'
                  ),
               	array(
                     'field'   => 'txtHost',
                     'label'   => 'Host',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'txtMailPort',
                     'label'   => 'Port',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'txtemailID',
                     'label'   => 'Email Id',
                     'rules'   => 'trim|required'
                  ),
				  array(
                     'field'   => 'txtmailpassword',
                     'label'   => 'Password',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'txtSmtpauth',
                     'label'   => 'SMTP Auth',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'txtSmtpsecure',
                     'label'   => 'SMTP Secure',
                     'rules'   => 'trim|required'
                  )
            );
		
  		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) 
		{
			$error_data = array(
                'status' => 'validationerror',
                'msg' => validation_errors()
            );
            echo json_encode($error_data);
		    //echo validation_errors();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperEmailProvider']));
		} 
		
	}
	public function operation_email_provider_edit(){
		
		$config = array(
               	array(
                     'field'   => 'txtMailProviderEdit',
                     'label'   => 'Provider',
                     'rules'   => 'trim|required'
                  ),
               	array(
                     'field'   => 'txtMailHostEdit',
                     'label'   => 'Host',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'txtMailPortEdit',
                     'label'   => 'Port',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'txtemailIDEdit',
                     'label'   => 'Email Id',
                     'rules'   => 'trim|required'
                  ),
				  array(
                     'field'   => 'txtmailpasswordEdit',
                     'label'   => 'Password',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'txtSmtpauthEdit',
                     'label'   => 'SMTP Auth',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'txtSmtpsecureEdit',
                     'label'   => 'SMTP Secure',
                     'rules'   => 'trim|required'
                  )
            );
		
  		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) 
		{
			$error_data = array(
                'status' => 'validationerror',
                'msg' => validation_errors()
            );
            echo json_encode($error_data);
		    //echo validation_errors();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperEmailProviderEdit']));
		} 
		
	}
	public function operation_email_provider_delete(){
			
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_email_provider'));
		
	}
	public function operation_sms_add(){
		
		$config = array(
               	array(
                     'field'   => 'cmbsmsType',
                     'label'   => 'SMS Type',
                     'rules'   => 'trim|required'
                  ),
               	array(
                     'field'   => 'txtSubject',
                     'label'   => 'SMS URL',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'txtContent',
                     'label'   => 'Content',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'cmbsmsProvider',
                     'label'   => 'Provider',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'cmbStatus',
                     'label'   => 'Status',
                     'rules'   => 'trim|required'
                  )
            );
		
  		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) 
		{
			$error_data = array(
                'status' => 'validationerror',
                'msg' => validation_errors()
            );
            echo json_encode($error_data);
		    //echo validation_errors();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperSmsSetup']));
		} 
		
	}
	public function operation_sms_edit(){
		
		$config = array(
               	array(
                     'field'   => 'cmbsmsTypeEdit',
                     'label'   => 'SMS Type',
                     'rules'   => 'trim|required'
                  ),
               	array(
                     'field'   => 'txtSubjectEdit',
                     'label'   => 'SMS URL',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'txtContentEdit',
                     'label'   => 'Content',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'cmbsmsProviderEdit',
                     'label'   => 'Provider',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'cmbStatusEdit',
                     'label'   => 'Status',
                     'rules'   => 'trim|required'
                  )
            );
		
  		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) 
		{
			$error_data = array(
                'status' => 'validationerror',
                'msg' => validation_errors()
            );
            echo json_encode($error_data);
		    //echo validation_errors();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperSmsSetupEdit']));
		} 
		
	}
	public function operation_sms_delete(){
			
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_sms'));
		
	}
	public function operation_email_add(){
		
		$config = array(
               	array(
                     'field'   => 'cmbMailType',
                     'label'   => 'SMS Type',
                     'rules'   => 'trim|required'
                  ),
               	array(
                     'field'   => 'txtSubject',
                     'label'   => 'Subject',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'txtContent',
                     'label'   => 'Content',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'cmbEmailProvider',
                     'label'   => 'Provider',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'cmbStatus',
                     'label'   => 'Status',
                     'rules'   => 'trim|required'
                  )
            );
		
  		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) 
		{
			$error_data = array(
                'status' => 'validationerror',
                'msg' => validation_errors()
            );
            echo json_encode($error_data);
		    //echo validation_errors();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperEmail']));
		} 
		
	}
	public function operation_email_edit(){
		
		$config = array(
               	array(
                     'field'   => 'cmbMailTypeEdit',
                     'label'   => 'Mail Type',
                     'rules'   => 'trim|required'
                  ),
               	array(
                     'field'   => 'txtemailSubjectEdit',
                     'label'   => 'Subject',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'txtemailContentEdit',
                     'label'   => 'Content',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'cmbEmailProviderEdit',
                     'label'   => 'Provider',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'cmbStatusEdit',
                     'label'   => 'Status',
                     'rules'   => 'trim|required'
                  )
            );
		
  		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) 
		{
			$error_data = array(
                'status' => 'validationerror',
                'msg' => validation_errors()
            );
            echo json_encode($error_data);
		    //echo validation_errors();
		}
		else
		{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperEmailEdit']));
		} 
		
	}
	public function operation_email_delete(){
			
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_email'));
		
	}
	public function delete_user_program(){
			
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_user_program'));
		
	}
	/**
	* Author   : Rahul Patro, 
	* Function : Show table data,
	* purpose  : to show table data in dropdown, 
	* Date     : 11/09/2017
	* Remark   : it will get the table name and 
	* 			 fetch the code and name from that table			 
	*/
	public function get_tablevalue(){
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'get_tablevalue'));
	}
	public function operation_groupdata(){
		$config = array(
           array(
                 'field'   => 'txtGroupName',
                 'label'   => 'User Name',
                 'rules'   => 'trim|required'
              ),
           array(
                 'field'   => 'cmbtable',
                 'label'   => 'Display Name',
                 'rules'   => 'trim|required'
              )
        );
	
  		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$data = array(
                'status' => 'validationerror',
                'msg' => validation_errors()
            );
            echo json_encode($data);
		    //echo validation_errors();
		}else{
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['op_type_group']));
		} 
		
	} 
	/**
	* Author   : Ashish Narayan Barick, Rahul Patro, Lina Mohapatro
	* Function : delete_data
	* purpose  : Menu data delete operation, User Data delete operation, role and resoarce delete operation
	* Date     : 11/09/2017
	* Remark   : Delete data
	*/
	
	public function delete_data()
	{
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['op_type']));
	}
	
	/**
	* Author   : lina Mohapatra, 
	* Function : operation_role_group_data,
	* purpose  : role_group data operation, 
	* Date     : 14/09/2017
	* Remark   : server-side validation,data operation 
	* 			 send to model side
	*/
	
		public function operation_role_group_data(){
	
			$config = array(
               array(
                     'field'   => 'cmbrolecode',
                     'label'   => 'Role Name',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'cmbgroupcode',
                     'label'   => 'Group Name',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'txtRoleGroup',
                     'label'   => 'Role Group Name',
                     'rules'   => 'required'
                  )
            );
			
			$this->form_validation->set_rules($config); 
		    if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}else{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['op_type_role_group']));
			} 
			
		}
	/**
	* Author   : lina Mohapatra, 
	* Function : operation_user_rolegroup_data,
	* purpose  : role_group data operation, 
	* Date     : 14/09/2017
	* Remark   : server-side validation,data operation 
	* 			 send to model side
	*/
	
		public function operation_user_rolegroup_data(){
	
			$config = array(
               array(
                     'field'   => 'txtrole_group',
                     'label'   => 'Role-Group Name',
                     'rules'   => 'required'
                  ),
            
            );
			
			$this->form_validation->set_rules($config); 
		    if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    //echo validation_errors();
			}else{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['op_type_user_role_group']));
			} 
			
		}
		//Country
		//Country
		public function select_country(){	
			echo json_encode($this->SuperadminCounselling_model->superadmin('', 'select_country'));
		}
		public function insert_country(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtCountryCode',
		                     'label'   => 'Country Code',
		                     'rules'   => 'trim|required|max_length[8]|regex_match[/^([A-Za-z0-9\s]+)$/i]'
		                ),
		               	array(
		                     'field'   => 'txtCountryName',
		                     'label'   => 'Country Name',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperCountry']));
				} 
			}
		}		
		
		
		public function update_country(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtCountryCodeEdit',
		                     'label'   => 'Country Code',
		                     'rules'   => 'trim|required|max_length[8]|regex_match[/^([A-Za-z0-9\s]+)$/i]'
		                ),
		               	array(
		                     'field'   => 'txtCountryNameEdit',
		                     'label'   => 'Country Name',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperCountryEdit']));
				} 
			}
		} 
		
		public function delete_country(){			
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_country'));			
		}
		
		//State
		public function select_state(){	
			echo json_encode($this->SuperadminCounselling_model->superadmin('', 'select_state'));
		}
		public function insert_state(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtStateCode',
		                     'label'   => 'State Code',
		                     'rules'   => 'trim|required|max_length[8]|regex_match[/^([A-Za-z0-9\s]+)$/i]'
		                ),
		               	array(
		                     'field'   => 'txtStateName',
		                     'label'   => 'State Name',
		                     'rules'   => 'trim|required'
		                ),
		                array(
		                     'field'   => 'cmbCountryName_State',
		                     'label'   => 'Country Name',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperAddState']));
				} 
			}
		}		
		
		
		public function update_state(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtStateCodeEdit',
		                     'label'   => 'State Code',
		                     'rules'   => 'trim|required|max_length[8]|regex_match[/^([A-Za-z0-9\s]+)$/i]'
		                ),
		               	array(
		                     'field'   => 'txtStateNameEdit',
		                     'label'   => 'State Name',
		                     'rules'   => 'trim|required'
		                ),
		                array(
		                     'field'   => 'cmbCountryNameEdit_State',
		                     'label'   => 'Country Name',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperEditState']));
				} 
			}
		} 
		
		public function delete_state(){			
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_state'));			
		}
		//District
		public function select_district(){	
			echo json_encode($this->SuperadminCounselling_model->superadmin('', 'select_district'));
		}
		public function insert_district(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtDistrictCode',
		                     'label'   => 'District Code',
		                     'rules'   => 'trim|required|max_length[8]|regex_match[/^([A-Za-z0-9\s]+)$/i]'
		                ),
		               	array(
		                     'field'   => 'txtDistrictName',
		                     'label'   => 'District Name',
		                     'rules'   => 'trim|required'
		                ),
		                array(
		                     'field'   => 'cmbStateName_District',
		                     'label'   => 'State Name',
		                     'rules'   => 'trim|required'
		                ),
		                array(
		                     'field'   => 'cmbCountryName_District',
		                     'label'   => 'Country Name',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperAddDistrict']));
				} 
			}
		}		
		
		
		public function update_district(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtDistrictCodeEdit',
		                     'label'   => 'District Code',
		                     'rules'   => 'trim|required|max_length[8]|regex_match[/^([A-Za-z0-9\s]+)$/i]'
		                ),
		               	array(
		                     'field'   => 'txtDistrictNameEdit',
		                     'label'   => 'District Name',
		                     'rules'   => 'trim|required'
		                ),
		                array(
		                     'field'   => 'cmbStateNameEdit_District',
		                     'label'   => 'State Name',
		                     'rules'   => 'trim|required'
		                ),
		               	array(
		                     'field'   => 'cmbCountryNameEdit_District',
		                     'label'   => 'Country Name',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperEditDistrict']));
				} 
			}
		} 
		
		public function delete_district(){			
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_district'));			
		}
		//Nationality
		public function select_nationality(){	
			echo json_encode($this->SuperadminCounselling_model->superadmin('', 'select_nationality'));
		}
		public function insert_nationality(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtNationalityCode',
		                     'label'   => 'Nationality Code',
		                     'rules'   => 'trim|required|max_length[8]|regex_match[/^([A-Za-z0-9\s]+)$/i]'
		                ),
		               	array(
		                     'field'   => 'txtNationalityName',
		                     'label'   => 'Nationality Name',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperAddNationality']));
				} 
			}
		}		
		
		
		public function update_nationality(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtNationalityCodeEdit',
		                     'label'   => 'Nationality Code',
		                     'rules'   => 'trim|required|max_length[8]|regex_match[/^([A-Za-z0-9\s]+)$/i]'
		                ),
		               	array(
		                     'field'   => 'txtNationalityNameEdit',
		                     'label'   => 'Nationality Name',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperEditNationality']));
				} 
			}
		} 
		
		public function delete_nationality(){			
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_nationality'));			
		}
		
		//Board
		public function select_board(){	
			echo json_encode($this->SuperadminCounselling_model->superadmin('', 'select_board'));
		}
		public function insert_board(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtBoardCode',
		                     'label'   => 'Board Code',
		                     'rules'   => 'trim|required|max_length[8]|regex_match[/^([A-Za-z0-9\s]+)$/i]'
		                ),
		               	array(
		                     'field'   => 'txtBoardName',
		                     'label'   => 'Board Name',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperAddBoard']));
				} 
			}
		}		
		
		
		public function update_board(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtBoardCodeEdit',
		                     'label'   => 'Board Code',
		                     'rules'   => 'trim|required|max_length[8]|regex_match[/^([A-Za-z0-9\s]+)$/i]'
		                ),
		               	array(
		                     'field'   => 'txtBoardNameEdit',
		                     'label'   => 'Board Name',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperEditBoard']));
				} 
			}
		} 
		
		public function delete_board(){			
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_board'));			
		}
		//Standard
		public function select_standard(){	
			echo json_encode($this->SuperadminCounselling_model->superadmin('', 'select_standard'));
		}
		public function insert_standard(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtStandardCode',
		                     'label'   => 'Standard Code',
		                     'rules'   => 'trim|required|max_length[8]|regex_match[/^([A-Za-z0-9\s]+)$/i]'
		                ),
		               	array(
		                     'field'   => 'txtStandardName',
		                     'label'   => 'Standard Name',
		                     'rules'   => 'trim|required'
		                ),
		                array(
		                     'field'   => 'txtPreviousStandard',
		                     'label'   => 'Previous Standard',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperAddStandard']));
				} 
			}
		}		
		
		
		public function update_standard(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtStandardCodeEdit',
		                     'label'   => 'Standard Code',
		                     'rules'   => 'trim|required|max_length[8]|regex_match[/^([A-Za-z0-9\s]+)$/i]'
		                ),
		               	array(
		                     'field'   => 'txtStandardNameEdit',
		                     'label'   => 'Standard Name',
		                     'rules'   => 'trim|required'
		                ),
		                array(
		                     'field'   => 'txtPreviousStandardEdit',
		                     'label'   => 'Previous Standard',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperEditStandard']));
				} 
			}
		} 
		
		public function delete_standard(){			
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_standard'));			
		}
		//Qualification
		public function select_qualification(){	
			echo json_encode($this->SuperadminCounselling_model->superadmin('', 'select_qualification'));
		}
		public function insert_qualification(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtQualificationCode',
		                     'label'   => 'Qualification Code',
		                     'rules'   => 'trim|required'
		                ),
		               	array(
		                     'field'   => 'txtQualificationName',
		                     'label'   => 'Qualification Name',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperAddQualification']));
				} 
			}
		}		
		
		
		public function update_qualification(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtQualificationCodeEdit',
		                     'label'   => 'Qualification Code',
		                     'rules'   => 'trim|required'
		                ),
		               	array(
		                     'field'   => 'txtQualificationNameEdit',
		                     'label'   => 'Qualification Name',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperEditQualification']));
				} 
			}
		} 
		
		public function delete_qualification(){			
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_qualification'));			
		}
		//Exam Center
		public function select_center(){	
			echo json_encode($this->SuperadminCounselling_model->superadmin('', 'select_center'));
		}
		public function insert_center(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtCenterCode',
		                     'label'   => 'Center Code',
		                     'rules'   => 'trim|required'
		                ),
		               	array(
		                     'field'   => 'txtCenterName',
		                     'label'   => 'Center Name',
		                     'rules'   => 'trim|required'
		                ),
		               	array(
		                     'field'   => 'cmbCenterStatus',
		                     'label'   => 'Center Status',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperAddExamCenter']));
				} 
			}
		}		
		
		
		public function update_centre(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtCenterCodeEdit',
		                     'label'   => 'Center Code',
		                     'rules'   => 'trim|required'
		                ),
		               	array(
		                     'field'   => 'txtCenterNameEdit',
		                     'label'   => 'Center Name',
		                     'rules'   => 'trim|required'
		                ),
		                array(
		                     'field'   => 'cmbCenterStatusEdit',
		                     'label'   => 'Center Status',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperEditExamCenter']));
				} 
			}
		} 
		
		public function delete_center(){			
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_center'));			
		}
		//Field
		public function select_field(){	
			echo json_encode($this->SuperadminCounselling_model->superadmin('', 'select_field'));
		}
		public function insert_field(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'cmbCode',
		                     'label'   => 'Code',
		                     'rules'   => 'trim|required|max_length[20]|regex_match[/^[a-zA-Z_]+$/i]'
		                ),
		               	array(
		                     'field'   => 'txtDescription',
		                     'label'   => 'Description',
		                     'rules'   => 'trim|required'
		                ),
		                array(
		                     'field'   => 'txtSlNo',
		                     'label'   => 'Sl No',
		                     'rules'   => 'trim|required|regex_match[/^[0-9]+$/i]'
		                ),
		               	array(
		                     'field'   => 'cmbFieldStatus',
		                     'label'   => 'Field Status',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperAddFields']));
				} 
			}
		}		
		
		
		public function update_field(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				
				$config = array(
		               	array(
		                     'field'   => 'cmbCodeEdit',
		                     'label'   => 'Code',
		                     'rules'   => 'trim|required|max_length[20]|regex_match[/^[a-zA-Z_]+$/i]'
		                ),
		               	array(
		                     'field'   => 'txtDescriptionEdit',
		                     'label'   => 'Description',
		                     'rules'   => 'trim|required'
		                ),
		                array(
		                     'field'   => 'txtSlNoEdit',
		                     'label'   => 'Sl No',
		                     'rules'   => 'trim|required|regex_match[/^[0-9]+$/i]'
		                ),
		               	array(
		                     'field'   => 'cmbFieldStatusEdit',
		                     'label'   => 'Field Status',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidOperEditFields']));
				} 
			}
		} 
		
		public function delete_field(){			
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_religion'));			
		}		
		
		public function cmb_status_centre(){	
			echo json_encode($this->SuperadminCounselling_model->superadmin('', 'cmb_status_centre'));
		}
		
		public function cmb_code(){	
			echo json_encode($this->SuperadminCounselling_model->superadmin('', 'cmb_code'));
		}
		
		public function cmb_status(){	
			echo json_encode($this->SuperadminCounselling_model->superadmin('', 'cmb_status'));
		}
		
		// =================XXXXXXXXXXXXXXX===========CHECK DUPLICATE===================XXXXXXXXXXXXXXXXXXXXXX=======//
		//Country
		public function check_country_code(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_country_code'));
			}
		}
		
		public function check_duplicate_country_edit(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_country_edit'));
			}
		}
		
		//State
		public function check_duplicate_state(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_state'));
			}
		}
		
		public function check_duplicate_state_edit(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_state_edit'));
			}
		}
		
		//District
		public function check_duplicate_district(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_district'));
			}
		}
		
		public function check_duplicate_district_edit(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_district_edit'));
			}
		}
		
		//Nationality
		public function check_duplicate_nationality(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_nationality'));
			}
		}
		
		public function check_duplicate_nationality_edit(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_nationality_edit'));
			}
		}
		
		//Board
		public function check_duplicate_board(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_board'));
			}
		}
		
		public function check_duplicate_board_edit(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_board_edit'));
			}
		}
		
		//Standard
		public function check_duplicate_standard(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_standard'));
			}
		}
		
		public function check_duplicate_standard_edit(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_standard_edit'));
			}
		}
		
		//Qualification
		public function check_duplicate_qualification(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_qualification'));
			}
		}
		
		public function check_duplicate_qualification_edit(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_qualification_edit'));
			}
		}
		
		//Exam Center
		public function check_duplicate_center(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_center'));
			}
		}
		
		public function check_duplicate_master_code(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_code'));
			}
		}
		
		public function check_duplicate_code_edit(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_code_edit'));
			}
		}
		
		//Registration Field
		public function check_duplicate_field(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_field'));
			}
		}
		
		public function check_duplicate_field_edit(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_field_edit'));
			}
		}
		
		/*======================XXXXXXXXXXXXXXXXX========GENERIC SETUP 2=======XXXXXXXXXXXXXXXXXXXX============== */
		/*======================XXXXXXXXXXXXXXXXX========GENERIC SETUP 3=======XXXXXXXXXXXXXXXXXXXX============== */
		public function select_file_name(){	
			echo json_encode($this->SuperadminCounselling_model->superadmin('', 'select_file_name'));
		}
		
		public function select_file_template_name(){	
			echo json_encode($this->SuperadminCounselling_model->superadmin('', 'select_file_template_name'));
		}
		
		//Registration Template
		public function select_registration_template(){	
			echo json_encode($this->SuperadminCounselling_model->superadmin('', 'select_registration_template'));
		}
		
		public function insert_registration_template(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtRegistrationTemplateCode',
		                     'label'   => 'Template Code',
		                     'rules'   => 'trim|required|max_length[10]|regex_match[/^([A-Za-z0-9\s]+)$/i]'
		                ),
		               	array(
		                     'field'   => 'txtRegistrationTemplateName',
		                     'label'   => 'Template Name',
		                     'rules'   => 'trim|required'
		                ),
		               	array(
		                     'field'   => 'textRegistrationTemplateDescription',
		                     'label'   => 'Template Description',
		                     'rules'   => 'trim|required'
		                ),
		               	array(
		                     'field'   => 'txtRegistrationFileName',
		                     'label'   => 'File Name',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidRegdTempAdd']));
				} 
			}
		}		
		
		
		public function update_registration_template(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtRegistrationTemplateCodeEdit',
		                     'label'   => 'Template Code',
		                     'rules'   => 'trim|required|max_length[10]|regex_match[/^([A-Za-z0-9\s]+)$/i]'
		                ),
		               	array(
		                     'field'   => 'txtRegistrationTemplateNameEdit',
		                     'label'   => 'Template Name',
		                     'rules'   => 'trim|required'
		                ),
		                array(
		                     'field'   => 'textRegistrationTemplateDescriptionEdit',
		                     'label'   => 'Template Description',
		                     'rules'   => 'trim|required'
		                ),
		                /*array(
		                     'field'   => 'txtRegistrationFileNameEdit',
		                     'label'   => 'File Name',
		                     'rules'   => 'trim|required'
		                )*/
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidRegdTempEdit']));
				} 
			}
		} 
		
		public function delete_registration_template(){			
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_registration_template'));			
		}
		
		//Profile Template
		public function select_template_master(){	
			echo json_encode($this->SuperadminCounselling_model->superadmin('', 'select_template_master'));
		}
		public function insert_profile_template(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtTemplateCode',
		                     'label'   => 'Template Code',
		                     'rules'   => 'trim|required|max_length[8]|regex_match[/^([A-Za-z0-9\s]+)$/i]'
		                ),
		               	array(
		                     'field'   => 'txtTemplateName',
		                     'label'   => 'Template Name',
		                     'rules'   => 'trim|required'
		                ),
		               	array(
		                     'field'   => 'textTemplateDescription',
		                     'label'   => 'Template Description',
		                     'rules'   => 'trim|required'
		                ),
		               	array(
		                     'field'   => 'txtFileName',
		                     'label'   => 'File Name',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidProfTempAdd']));
				} 
			}
		}		
		
		
		public function update_profile_template(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				$config = array(
		               	array(
		                     'field'   => 'txtTemplateCodeEdit',
		                     'label'   => 'Template Code',
		                     'rules'   => 'trim|required|max_length[8]|regex_match[/^([A-Za-z0-9\s]+)$/i]'
		                ),
		               	array(
		                     'field'   => 'txtTemplateNameEdit',
		                     'label'   => 'Template Name',
		                     'rules'   => 'trim|required'
		                ),
		                array(
		                     'field'   => 'textTemplateDescriptionEdit',
		                     'label'   => 'Template Description',
		                     'rules'   => 'trim|required'
		                ),
		                array(
		                     'field'   => 'txtFileNameEdit',
		                     'label'   => 'File Name',
		                     'rules'   => 'trim|required'
		                )
		            );
				
		  		$this->form_validation->set_rules($config);
				if ($this->form_validation->run() == FALSE) 
				{
					$error_data = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($error_data);
				    //echo validation_errors();
				}
				else
				{
					echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, $_POST['hidProfTempEdit']));
				} 
			}
		} 
		
		public function delete_profile_template(){			
			echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'delete_profile_template'));			
		}
		
		//Check Duplicate
		public function check_duplicate_template_code(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_template_code'));
			}
		}
		public function check_duplicate_template_code_edit(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_template_code_edit'));
			}
		}
		
		public function check_duplicate_registration_code(){
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
	            echo json_encode($data);
				//die();
			}
			else
			{
				echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'check_duplicate_registration_code'));
			}
		}
	public function get_program_table_data(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_program_tabledata'));
	}
	public function get_program_table_old_data(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_program_tableold_data'));
	}
	public function select_cmbgroup_data(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_cmbgroupdata'));
	}
	public function select_cmbtemplate_reg_data(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_cmbtemplatereg_data'));
	}
	public function select_cmbtemplate_data(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_cmbtemplatedata'));
	}
	public function insert_program_data(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'insert_programdata'));
	}
	public function CHKDUCPLICATE(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'CHKDUCPLICATE_data'));
	}
	public function get_program_group_data(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_program_groupdata'));
	}
	public function get_copyform_data(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_copyformdata'));
	}
	public function CHKDUCPLICATECOPY(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'CHKDUCPLICATECOPY_data'));
	}
	public function insert_copy_data(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'insert_copydata'));
	}
	public function select_year(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_yeardata'));
	}
	public function edit_current(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'edit_currentdata'));
	}
	public function edit_old_data(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'edit_old_data'));
	}
	public function CHKEDITDUCPLICATE(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'CHKEDITDUCPLICATE_data'));
	}
	public function delete_current(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'delete_currentdata'));
	}
	public function publish(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'publish_currentdata'));
	}
	public function count_program_menu(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'count_program_menu_data'));
	}
	public function count_active_program_menu(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'count_active_program_menu_data'));
	}
	public function count_show_menu(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'count_show_menu_data'));
	}
	public function count_zero(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'count_zero_data'));
	}
	public function inactive_documents(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'inactive_documents_data'));
	}
	public function count_challan(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'count_challandata'));
	}
	public function count_examcenter(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'count_examcenter_data'));
	}
	public function count_inactive_sms(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'count_inactive_sms_data'));
	}
	public function count_inactive_cat(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'count_inactive_cat_data'));
	}
	public function SELECT_OLD(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'SELECT_OLD_data'));
	}
	public function select_template_data(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_templatedata'));
	}
	public function archieve(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'archievedata'));
	}
	public function edit_old(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'edit_olddata'));
	}
	public function delete_old(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'delete_olddata'));
	}
	public function SELECT_ALL_MENU(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'SELECT_ALL_MENU_data'));
	}
	public function SELECTMENU(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'SELECT_MENU_data'));
	}
	public function UPDATE_MULTIPLE(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'UPDATE_MULTIPLE_data'));
	}
	public function UPDATE(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'UPDATE_data'));
	}
	public function SELECT(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'SELECT_data'));
	}
	public function SELECT_ALL(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'SELECT_ALL_data'));
	}
	public function CMB_STATUS_dt(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'CMB_STATUS_data'));
	}
	public function CMB_CODE_dt(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'CMB_CODE_data'));
	}
	public function UPDATE_MULTIPLE_reg(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'UPDATE_MULTIPLE_reg_data'));
	}
	public function UPDATE_reg(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'UPDATE_reg_data'));
	}
	public function select_prog_all(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_prog_all_data'));
	}
	public function select_category_all(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_category_all_data'));
	}
	public function get_save_admit_card(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'save_admit_card'));
	}

	
	
	
	
	
	
	
	public function select_program_data(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_program_data'));
	}
	public function get_category_all(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_category_multiple'));
	}
	public function update_multiple_category(){
		echo json_encode($this->adminCounselling_model->admin($_POST, 'assign_multiple_category'));
	}
	public function get_category_single(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_category_one'));
	}
	public function update_single_category(){
		echo json_encode($this->adminCounselling_model->admin($_POST, 'assign_single_category'));
	}
	public function get_exam_centre_multiple(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_exam_centre_all'));
	}
	public function get_qualification_all(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_qualification_multiple'));
	}
	public function update_multiple_centre(){
		echo json_encode($this->adminCounselling_model->admin($_POST, 'assign_multiple_centre'));
	}
	public function get_qualification_single(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_qualification_one'));
	}
	public function update_single_qualification(){
		echo json_encode($this->adminCounselling_model->admin($_POST, 'assign_single_qualification'));
	}
	public function get_fee_assign_all(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_fee_assign_multiple'));
	}
	public function update_multiple_fee(){
		echo json_encode($this->adminCounselling_model->admin($_POST, 'assign_multiple_fee'));
	}
	public function get_fee_single(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_fee_one'));
	}
	public function update_single_fee(){
		echo json_encode($this->adminCounselling_model->admin($_POST, 'assign_single_fee'));
	}
	public function get_charge(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_charge_data'));
	}
	public function operation_feedata(){
		//echo $_POST['hidOperTypeResource'];
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	           array(
	                 'field'   => 'txtCharge',
	                 'label'   => 'Transaction Charge',
	                 'rules'   => 'required'
	              )
	        );
		
		
			$this->form_validation->set_rules($config); 
			
		    if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    
			}else{
				echo json_encode($this->adminCounselling_model->admin($_POST, $_POST['hidOperTypeFeeAdd']));
			} 
		}
		
	}
	
	public function operation_feeeditdata(){
		//echo $_POST['hidOperTypeResource'];
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	           array(
	                 'field'   => 'txtChargeEdit',
	                 'label'   => 'Transaction Charge',
	                 'rules'   => 'required'
	              )
	        );
		
		
			$this->form_validation->set_rules($config); 
			
		    if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    
			}else{
				echo json_encode($this->adminCounselling_model->admin($_POST, $_POST['hidOperTypeFeeEdit']));
			} 
		}
		
	}
	public function delete_feedata(){
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
            echo json_encode($data);
			//die();
		}
		else
		{
			echo json_encode($this->adminCounselling_model->admin($_POST, 'delete_feedata'));
		}
	}
	public function select_program_data_manage_app(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_program_data_manage_app'));
	}
	public function select_applns(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_applications'));
	}
	public function get_applnt_details_payment(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_applicant_details_payment'));
	}
	public function select_program_manage_app(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'select_program_manage_application'));
	}
	public function edit_manage_appns(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'edit_manage_applications'));
	}
	public function get_applnt_details_scrutiny(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_applicant_details_scrutiny'));
	}
	public function get_program_group_scrutiny_applnts(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_program_group_scrutiny_applicants'));
	}
	public function get_program_scrutiny_applnts(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_program_scrutiny_applicants'));
	}
	public function get_program_group_sbi_applnts(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'program_group_sbi_applicants'));
	}
	public function get_program_sbi_applnts(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'program_sbi_applicants'));
	}
	public function get_applicants_centre_admit_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'applicants_centre_admit_setup'));
	}
	public function get_applnt_details_sbi(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'applnt_details_sbi'));
	}
	public function get_verify_sbi_applnts(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'verify_sbi_applnts'));
	}
	public function disqualify_scrutiny_applnts(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'disqualify_scrutiny_applicants'));
	}
	public function qualify_scrutiny_applnts(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'qualify_scrutiny_applicants'));
	}
	public function get_template_scrutiny_applnts(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_template_scrutiny_applicants'));
	}
	public function get_program_group_admit_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'program_group_admit_setup'));
	}
	public function get_program_admit_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'program_admit_setup'));
	}
	public function get_exam_centre_admit_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'exam_centre_admit_setup'));
	}
	public function get_exam_venue_admit_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'exam_venue_admit_setup'));
	}
	public function get_centre_address_admit_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'centre_address_admit_setup'));
	}
	public function get_apply_date_admit_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'apply_date_admit_setup'));
	}
	public function get_change_program_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'change_program_setup'));
	}
	public function get_applicants_admit_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'applicants_admit_setup'));
	}
	public function get_applicants_program_name_admit_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'applicants_program_name_admit_setup'));
	}
	public function get_published_applicants_exam_centre_name_admit_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'published_applicants_exam_centre_name_admit_setup'));
	}
	public function assign_published_applicants_admit_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_assign_published_applicants_admit_setup'));
	}
	public function get_applicants_exam_centre_name_admit_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'applicants_exam_centre_name_admit_setup'));
	}
	public function get_published_applicants_exam_venue_name_admit_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'published_applicants_exam_venue_name_admit_setup'));
	}
	public function get_applicants_venue_admit_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'applicants_venue_admit_setup'));
	}
	public function get_applicants_capacity_admit_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'applicants_capacity_admit_setup'));
	}
	public function assign_applicants_centre_admit_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_assign_applicants_centre_admit_setup'));
	}
	public function get_published_applicants_admit_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'published_applicants_admit_setup'));
	}
	public function get_published_applicants_report_admit_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'published_applicants_report_admit_setup'));
	}
	public function get_change_program(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'change_program'));
	}
	public function get_change_program_admit_card_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'change_program_admit_card_setup'));
	}
	
	public function get_check_mobile_number_change_dob(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_check_mobile_number_change_dob'));
	}
	public function get_change_DOB(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_change_dob'));
	}
	public function get_check_mobile_admit_card_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'check_mobile_admit_card_setup'));
	}
	public function get_change_mobile_admit_card_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'change_mobile_admit_card_setup'));
	}
	public function chk_duplicate_admit_setup(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'chkDuplicate_admit_setup'));
	}
	public function operation_add_centre(){
		echo json_encode($this->adminCounselling_model->admin($_POST, $_POST['hidOperTypeCentreAdd']));
	}
	public function operation_edit_centre(){
		echo json_encode($this->adminCounselling_model->admin($_POST, $_POST['hidOperTypeCentreEdit']));
	}
	public function get_document_all(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_document_multiple'));
	}
	public function get_document_single(){	
		echo json_encode($this->adminCounselling_model->admin($_POST, 'get_document_one'));
	}
	public function update_multiple_document(){
		echo json_encode($this->adminCounselling_model->admin($_POST, 'assign_multiple_document'));
	}
	public function update_single_document(){
		echo json_encode($this->adminCounselling_model->admin($_POST, 'assign_single_document'));
	}
	public function dashboard_registration_report(){
		echo json_encode($this->adminCounselling_model->admin($_POST, 'dashboard_registration_report'));
	}
	public function dashboard_registration_report_scrutiny(){
		echo json_encode($this->adminCounselling_model->admin($_POST, 'dashboard_registration_report_scrutiny'));
	}
	
	public function template008_pdf() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $reg_user_id = $this->session->userdata('reg_user_id');
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
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
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print_008.pdf', 'F');
		//$this->load->view('pdf/template008_pdf');	
		/*$pdf->Output($applicantNumber.".pdf",'I');*/	
		return true;
    } 
	public function temp_config(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'temp_config'));
	}
	public function course_modal(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'course_modal'));
	}
	public function select_center_preference(){
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'get_center_preference'));
	}
	public function support_modal(){
		echo json_encode($this->Feedback_model->apply($_POST, 'support_modal'));
	}
	public function quicklink_modal(){
		echo json_encode($this->Feedback_model->apply($_POST, 'quicklink_modal'));
	}
	
	public function support_form_modal(){
		if( $this->input->post())
		{
			$config = array(
					array(
	                     'field'   => 'cust_name',
	                     'label'   => 'Applicant Name',
	                     'rules'   => 'trim|required'
	                  ),
					array(
	                     'field'   => 'cust_no',
	                     'label'   => 'Applicant Mobile No',
	                     'rules'   => 'trim|required|numeric|max_length[10]'
	                  ),
                  	array(
                     'field'   => 'cust_email',
                     'label'   => 'Applicant Email',
                     'rules'   => 'trim|required|valid_email'
                  	),
                  	array(
                     'field'   => 'grievance',
                     'label'   => 'Grievance',
                     'rules'   => 'trim|required'
                  	)
                  	  
		        );
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	           $output = array('status' => FALSE, 'msg' =>$data['msg']);
	           echo json_encode($output);
			}
			else
			{
				echo json_encode($this->Feedback_model->apply($_POST, 'support_form_modal'));
			}
		}
		/*else
		{*/
			//redirect($this->agent->referrer());
			//echo json_encode($this->Feedback_model->apply($_POST, 'support_form_modal'));
		/*}*/
		
	}
	

	public function latestinfo_modal(){
		echo json_encode($this->Feedback_model->apply($_POST, 'latestinfo_modal'));
	}
	public function select_graduation_course(){
		
		echo json_encode($this->ApplyCounselling_model->apply($_POST, 'select_graduation_course'));
			
	}
	public function select_program_for_online_details()
	{
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'select_program_for_online_details'));
			
	}
	public function select_online_payment_verification()
	{
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'select_online_payment_verification'));
			
	}
	public function update_online_payment_verification()
	{
		echo json_encode($this->SuperadminCounselling_model->superadmin($_POST, 'update_online_payment_verifications'));
			
	}
	
	
	
}
