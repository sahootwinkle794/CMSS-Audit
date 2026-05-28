<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header('X-Frame-Options: SAMEORIGIN');
//header('Access-Control-Allow-Origin: *');
header('Access-Control-Max-Age: 3628800');
//header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
class Ajax_controller extends CI_Controller 
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
		$this->load->model('Superadmin_model');
		$this->load->model('admin_model');
		$this->load->model('User_model');
		$this->load->model('admin_model_1');
		$this->load->model('Index_model');
		$this->load->model('Apply_model');
		$this->load->model('Feedback_model');
		/*if(!parameterPrevent()){
			echo json_encode(array('status' => FALSE, 'msg' =>'Invalid Request.Please Try Again'));
		}*/
		
	}
	
	/*
	*	purpose : if request is not an ajax request then show error
	*/
	public function _remap($method){
		//echo $method;die;
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
		echo json_encode($this->Superadmin_model->superadmin($_POST, $type));
	}  
	public function select_institute_setup_data(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_institute_setup_data'));
	}
	public function select_institute_image_setup_data(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_institute_image_setup_data'));
	}
	public function footer_logo(){	
		echo json_encode($this->Index_model->index_data($_POST, 'get_footer_logo'));
	}
	 public function template002_pdf() {
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
        $data['tech_qual_data_5'] = $this->m_pdf_model->template001_pdf($program,'get_tech_qual_data_5');
		$data['tech_qual_data_6'] = $this->m_pdf_model->template001_pdf($program,'get_tech_qual_data_6');
		$data['tech_qual_data_7'] = $this->m_pdf_model->template001_pdf($program,'get_tech_qual_data_7');

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
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		chmod($uploaddir.'/application_print.pdf',0777);	
		return true;
    }
    public function get_captcha(){
		echo json_encode($this->admin_model->admin('', 'get_captcha'));
	}
	public function add_update_captcha(){
		echo json_encode($this->admin_model->admin('', 'add_update_captcha'));
	}
    
	public function create_captcha()
	
	{
		$captcha_result = $this->admin_model->admin('', 'get_captcha');
		$this->load->helper('captcha');
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
       //$this->session->set_userdata('captchaCode',$captcha['word']);
       //$this->session->set_userdata('captchaCode','098765');
       if((count($captcha_result)>0) && ($captcha_result[0]['captcha_status'] == 1)) 
		{
			$this->session->set_userdata('captchaCode', $captcha['word']);
		}
		else if((count($captcha_result)>0) && $captcha_result[0]['captcha_status'] == 0)
		{
			$this->session->set_userdata('captchaCode', $captcha_result[0]['captcha_text']);
		}
		else
		{
			$this->session->set_userdata('captchaCode', $captcha['word']);
		}
		echo $captcha['image'];		
	}
    public function refresh_captcha(){
        // Captcha configuration
        //echo base_url();die;
        $captcha_result = $this->admin_model->admin('', 'get_captcha');
		$this->load->helper('captcha');
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
        //var_dump($captcha);
      //  echo $captcha['word'];die;
        // Unset previous captcha and store new captcha word
        $this->session->unset_userdata('captchaCode');
        //$this->session->set_userdata('captchaCode',$captcha['word']);
        
     // $this->session->set_userdata('captchaCode','098765');
	     if((count($captcha_result)>0) && ($captcha_result[0]['captcha_status'] == 1)) 
			{
				$this->session->set_userdata('captchaCode', $captcha['word']);
			}
			else if((count($captcha_result)>0) && $captcha_result[0]['captcha_status'] == 0)
			{
				$this->session->set_userdata('captchaCode', $captcha_result[0]['captcha_text']);
			}
			else
			{
				$this->session->set_userdata('captchaCode', $captcha['word']);
			}
        // Display captcha image
        echo $captcha['image'];
    }
    
    public function create_captcha_feedback()
	{
		$config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path' 	=> 'public/assets/fonts/captcha.ttf',
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
        $this->session->unset_userdata('captchaCodefeedback');
        $this->session->set_userdata('captchaCodefeedback',$captcha['word']);
		echo $captcha['image'];
	}
    public function refresh_captcha_feedback(){
        // Captcha configuration
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path' 	=> 'public/assets/fonts/captcha.ttf',
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['op_type']));
			}
		}
    	 
		
	}
	public function operation_institute_edit(){
		$temp_rule = Array(
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
	               
	               /* array(
	                     'field'   => 'instituteeditcode',
	                     'label'   => 'Institute Code',
	                     'rules'   => 'trim|required'
	                  ),*/
	               array(
	                     'field'   => 'instituteeditname',
	                     'label'   => 'Institute Name',
	                     'rules'   => 'required'
	                  ),
	              /* array(
	                     'field'   => 'txtinstituteTypeEdit',
	                     'label'   => 'Institute Type',
	                     'rules'   => 'required'
	                  ),*/
	               array(
	                     'field'   => 'instituteadmindisplaynameEdit',
	                     'label'   => 'Display Name',
	                     'rules'   => 'required'
	                  ),
	               /*array(
	                     'field'   => 'instituteadminusernameEdit',
	                     'label'   => 'Admin User Name',
	                     'rules'   => 'trim|required'
	                  ),*/
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $optype));
			} 
			
		}
    	
	}
	public function admin_dashboard(){	
		echo json_encode($this->admin_model->admin($_POST, 'admin_dashboard'));
	}
	public function db_get_json(){	
		echo json_encode($this->admin_model->admin($_POST, 'db_get_json'));
	}
	public function get_pie_category(){	
		$gender = $this->uri->segment(3);
		echo json_encode($this->admin_model->admin($gender, 'get_pie_category'));
	}
	public function get_profile(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_profile'));
	}
	public function select_program_email(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_program_email'));
	}
	
	public function select_program_sms(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_program_sms'));
	}		
	public function check_email_provider(){
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_email_provider'));	
		}	
		
	}
	
	public function check_email_providerEdit(){
			
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_email_providerEdit'));	
	}
	public function select_all_sms(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_all_sms'));
	}
	
	public function select_communication_sms(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_communication_sms'));
	}
	
	public function update_multiple_sms(){	
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'update_multiple_sms'));
		}
	}
	public function update_single_sms(){	
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'update_single_sms'));
		}
	}
	
	public function select_communication_menu(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_communication_menu'));
	}
	public function get_applnt_details_payment(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_applicant_details_payment'));
	
	}
	public function get_applnt_details_payment_pgCode(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_applnt_details_payment_pgCode'));
	}
	public function get_status_scrutiny_applnts(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_status_scrutiny_applnts'));
	}
	public function get_pgCode_scrutiny_applnts(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_pgcode_scrutiny_applnts'));
	}
	public function select_communication_assign(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_communication_assign'));
	}
	
	public function update_multiple_email(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'update_multiple_email'));
		}
	}
	
	public function update_communication_email(){	
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'update_communication_email'));
		}
	}
	
	public function get_admitcardTemplates(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_admitcardTemplates'));
	}
	public function get_admitcard_templateCode(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_admitcardTemplates'));
	}
	public function check_news_announcement(){	
		echo json_encode($this->admin_model->admin($_POST, 'check_news_announcement'));
	}
	public function select_qual_wise_degree(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_qual_wise_degree'));
	}
	public function get_declaration_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_declaration_data'));
	}
	public function add_declaration(){	
		echo json_encode($this->admin_model->admin($_POST, 'add_declaration'));
	}
	public function edit_declaration(){	
		echo json_encode($this->admin_model->admin($_POST, 'edit_declaration'));
	}
	public function delete_declaration(){	
		echo json_encode($this->admin_model->admin($_POST, 'delete_declaration'));
	}
	public function Add_template_setup(){	
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
	                 'field'   => 'txtTemplateCode',
	                 'label'   => 'Template Code',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtTemplateName',
	                 'label'   => 'Name',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'taTemplateDesc',
	                 'label'   => 'Description',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtFileName',
	                 'label'   => 'File Name',
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
				echo json_encode($this->admin_model->admin($_POST, 'Add_template_setup'));
			} 
		}
		
	}
	public function Update_template_setup(){	
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
	                 'field'   => 'txtTemplateName',
	                 'label'   => 'Name',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'taTemplateDesc',
	                 'label'   => 'Description',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtFileName',
	                 'label'   => 'File Name',
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
				echo json_encode($this->admin_model->admin($_POST, 'Update_template_setup'));
			} 
		}
		
	}
	public function operation_delete_admitcard_templateSetup(){	
		echo json_encode($this->admin_model->admin($_POST, 'operation_delete_admitcard_templateSetup'));
	}
	
	
	public function operation_institute_type_add(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'operation_institute_type_add'));
	}
	public function select_institute_type(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'select_institute_type'));
	}
	
	public function operation_institute_create(){
		$temp_rule = Array(
			"(",
			")",
			"="
		);
		if (hasXSS($_POST,$temp_rule)){
			//echo "2";
			$data = array(
                'status' => 'xsserror',
                'msg' => 'Special chararacters like =,(,) are not allowed'
            );
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'create_institute';
			$config = array(
	           array(
	                 'field'   => 'institutename',
	                 'label'   => 'Institute Name',
	                 'rules'   => 'required'
	              ),
	            array(
	                 'field'   => 'txtinstituteEmail',
	                 'label'   => 'E-Mail',
	                 'rules'   => 'required'
	              ),
	           array(
	                 'field'   => 'cmbInstituteType',
	                 'label'   => 'Institute Type',
	                 'rules'   => 'required'
	              ),
	           array(
	                 'field'   => 'instituteadmindisplayname',
	                 'label'   => 'Display Name',
	                 'rules'   => 'required'
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $optype));
			} 
		}
		
	} 

	public function operation_institute_add(){
		$temp_rule = Array(
			"(",
			")",
			"="
		);
		if (hasXSS($_POST,$temp_rule)){
			//echo "2";
			$data = array(
                'status' => 'xsserror',
                'msg' => 'Special chararacters like =,(,) are not allowed'
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
	                 'field'   => 'txtinstituteEmail',
	                 'label'   => 'E-Mail',
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $optype));
			} 
		}
		
	} 
	public function operation_image_to_slide_add(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			$optype = 'add_image_to_institute';
			
				echo json_encode($this->Superadmin_model->superadmin($_POST, $optype));
			
		}
		
	} 
	public function operation_image_to_slide_edit(){
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
			$optype = 'edit_added_image_to_institute';
			
				echo json_encode($this->Superadmin_model->superadmin($_POST, $optype));
			
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['op_type_application']));
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'edit_payment_mode'));
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
			echo json_encode($this->Superadmin_model->superadmin('', 'get_resource'));
		}
	}
	public function select_role(){	
		
		echo json_encode($this->Superadmin_model->superadmin('', 'get_role'));
	}
	public function get_payment_mode(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_payment_mode'));
	}
	public function select_copy_role(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_copy_role'));
	}
	public function select_menu(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'get_menu'));
	}
	public function select_parent(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'get_parent'));
	}
	public function select_institute(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'get_institute'));
	}
	public function select_exam_center(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_exam_center'));
	}
	public function select_exam_center_edit(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_exam_center_edit'));
	}
	public function SELECT_EXAM_FOR_EXAM_CENTER_SETUP(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_exam_for_exam_center_setup'));
	}
	public function get_add_exam_center(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'add_exam_centre'));
	}
	public function delete_exam_centerdata(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_exam_center'));
	}
	public function select_institute_center(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_institute_center'));
	}
	public function select_institute_names_list_dropdown(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_institute_names_for_dropdown'));
	}
	public function select_document_type_list_dropdown(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_document_type_list_for_dropdown'));
	}
	public function program_group_data(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'program_group_data'));
	}
	/*public function select_sdocument_type_list_dropdown(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_sdocument_type_list_for_dropdown'));
	}*/
	public function select_user(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'get_user_data'));
	}
	public function select_code(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'get_code'));
	}
	public function select_code_desc(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_code_desc'));
	}
	public function select_template(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'get_template'));
	}
	public function select_template_file(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_template_file'));
	}
	public function select_program_menu(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_program_menu_generic_setup1'));
	}
	public function select_program_group(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_program_group_generic_setup1'));
	}
	public function select_program_document(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'get_document_master'));
	}
	public function select_program_sdocument(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'get_sdocument_master'));
	}
	public function select_category(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'get_category_master'));
	}
	public function select_religion(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'get_religion'));
	}
	public function select_caste(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'get_caste'));
	}
	public function select_instruction(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'get_instruction'));
	}
	public function select_minority(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'get_minority_community'));
	}
	public function select_sms_provider(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'get_sms_provider'));
	}
	public function select_sms_setup(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'get_sms_setup'));
	}
	public function select_email_provider(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'get_email_provider'));
	}
	public function select_email_setup(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'get_email_setup'));
	}	
	public function select_institute_user(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_user_institutewise'));
	}
	public function select_institute_program(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_program_institutewise'));
	}
	public function select_user_program_mapping(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_user_program_mapping'));
	}
	public function select_user_program_manage(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_user_program_manage'));
	}
	public function select_payment_verification(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_payment_verification'));
	}
	public function select_pg_report(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_pg_report'));
	}
	public function select_payment_gateway_master(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_payment_gateway_master'));
	}
	public function add_payment_gateway_master(){	
	
		$config = array(
               	array(
                     'field'   => 'txtPgMasterCode',
                     'label'   => ' Payment Gateway Code',
                     'rules'   => 'trim|required'
                  ),
               	array(
                     'field'   => 'txtPgMasterName',
                     'label'   => ' Payment Gateway Name',
                     'rules'   => 'trim|required'
                  ),
				
				array(
                     'field'   => 'txtRemarks',
                     'label'   => ' Remarks',
                     'rules'   => 'trim|required'
                  ),
	              array(
	                 'field'   => 'txtPaymentProcessURL',
	                 'label'   => '  Payment Process URL',
	                 'rules'   => 'trim|required'
	              ),
				array(
                     'field'   => 'txtActionURL',
                     'label'   => ' Action URL',
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
		else{
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'add_payment_gateway_master'));
		}
		
		
	}

	public function edit_payment_gateway_master(){
		$config = array(
               	/*array(
                     'field'   => 'txtPgMasterCode',
                     'label'   => ' Payment Gateway Code',
                     'rules'   => 'trim|required'
                  ),*/
               	array(
                     'field'   => 'txtPgMasterName',
                     'label'   => ' Payment Gateway Name',
                     'rules'   => 'trim|required'
                  ),
				
				array(
                     'field'   => 'txtRemarks',
                     'label'   => ' Remarks',
                     'rules'   => 'trim|required'
                  ),
	              array(
	                 'field'   => 'txtPaymentProcessURL',
	                 'label'   => '  Payment Process URL',
	                 'rules'   => 'trim|required'
	              ),
				array(
                     'field'   => 'txtActionURL',
                     'label'   => ' Action URL',
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'edit_payment_gateway_master'));	
			}
	    }
	    
	public function get_pg_code_list(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_pg_code_list'));
	}
	public function get_pg_parameter(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_pg_parameter'));
	}
	/*public function add_pg_parameter(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'add_pg_parameter'));
	}*/
	/*public function edit_pg_parameter(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'edit_pg_parameter'));
	}*/
	public function select_institutes(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'select_institutes'));
	}
	public function select_pgcodes(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'select_pgcodes'));
	}
	public function get_pg_parameter_values(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_pg_parameter_values'));
	}
	public function select_pgparameter_codes(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'select_pgparameter_codes'));
	}
	public function add_pg_parameter(){
		
		$config = array(
               	array(
                     'field'   => 'txtPgParameterCode',
                     'label'   => '  Parameter Code',
                     'rules'   => 'trim|required'
                  ),
               	array(
                     'field'   => 'txtPgParameterName',
                     'label'   => '  Parameter Name',
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
		else{
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'add_pg_parameter'));
		}
			
		
	}

	public function edit_pg_parameter(){
		$config = array(
               	array(
                     'field'   => 'txtPgParameterCode',
                     'label'   => '  Parameter Code',
                     'rules'   => 'trim|required'
                  ),
               	array(
                     'field'   => 'txtPgParameterName',
                     'label'   => '  Parameter Name',
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
		else{
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'edit_pg_parameter'));
		}
			
		
	}

	public function add_pg_parameter_values(){	
		
		
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'add_pg_parameter_values'));
		
	}

	public function edit_pg_parameter_values(){	
	
		
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'edit_pg_parameter_values'));	
		
		
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperTypeMenu']));
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_menu'));
		}
	}
	public function copy_menudata(){
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'copy_menu'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperTypeRole']));
			} 
		}
		
	}	
	public function check_user_username(){
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_user_username'));
		}
	}
	public function reset_password(){	
		//print_r($_POST);die();
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'reset_password'));
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_roledata'));
		}
	}
	
	
	
	public function delete_institute_image_data(){
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_institute_image_data'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperTypeResource']));
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_resource'));
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_role'));
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_code'));
		}
	}
	public function insert_manageUser_User(){
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
	                     'field'   => 'txtEmployeeName',
	                     'label'   => 'Employee Name',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtUserName',
	                     'label'   => 'User Name',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'cmbRoleUser',
	                     'label'   => 'Role',
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'insert_manageUser_User'));
			} 
		}
	} 
	public function update_manageUser_User(){
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
	                     'field'   => 'txtEmployeeName',
	                     'label'   => 'Employee Name',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtUserName',
	                     'label'   => 'User Name',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'cmbRoleUser',
	                     'label'   => 'Role',
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'update_manageUser_User'));
			} 
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_code_desc'));
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_program_menu_add'));
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_program_menu_edit'));
		}
	}
	public function check_program_group_code(){
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_program_group_add'));	
	}
	public function check_program_group_code_edit(){
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_program_group_edit'));	
	}
	public function check_document(){
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_document'));	
	}
	public function check_document_edit(){
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_document_edit'));	
	}
	
	public function check_sdocument(){
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_sdocument'));	
	}
	public function check_sdocument_edit(){
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_sdocument_edit'));	
	}
	
	public function check_category(){
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_category'));	
	}
	public function check_category_edit(){
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_category_edit'));	
	}
	public function check_minority(){
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_minority'));	
	}
	public function check_minority_edit(){
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_minority_edit'));	
	}
	public function check_birth_date(){
		echo json_encode($this->Apply_model->apply($_POST, 'check_birth_date'));	
	}
	public function check_email(){
		echo json_encode($this->Apply_model->apply($_POST, 'check_email'));	
	}
	public function select_district_details(){
		echo json_encode($this->Apply_model->apply($_POST, 'get_district_details'));	
	}
	public function edit_status_apply4(){
		echo json_encode($this->Apply_model->apply($_POST, 'edit_status_apply4'));	
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperTypeCode']));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperTypeCodeDesc']));
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_code'));
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_code_desc'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperProgramMenu']));
			} 
		}
	} 
	public function operation_program_menu_edit(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"("
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
			/*$config = array(
	               array(
	                     'field'   => 'txtMenuCodeEdit',
	                     'label'   => 'Menu Code',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtLinkTextEdit',
	                     'label'   => 'Link Text',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtLinkURLEdit',
	                     'label'   => 'Link Url',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'cmbNewWindowEdit',
	                     'label'   => 'New window',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'cmbDocumentUploadEdit',
	                     'label'   => 'Document Upload',
	                     'rules'   => 'trim|required'
	                  ),
					array(
	                     'field'   => 'cmbRecordStatusEdit',
	                     'label'   => 'Status',
	                     'rules'   => 'trim|required'
	                  ),
					array(
	                     'field'   => 'txtProgramMenuSlnoEdit',
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
			{*/
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'edit_program_menu'));
			/*}*/ 
		}	
	}	
	public function operation_program_group_add(){
		$inputCsrfToken = $_POST['hidfrmAddProgramGroupToken'];
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
			else if(!checkToken( $inputCsrfToken, 'frmAddProgramGroup' ))
			{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => "Invalid Request"
	            );
	            echo json_encode($error_data);
			}
			else
			{
				
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperProgramGroup']));
			} 
		}	
	}
	
	public function operation_program_group_edit(){
		$inputCsrfToken = $_POST['hidfrmEditProgramGroupToken'];
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
			else if(!checkToken( $inputCsrfToken, 'frmEditProgramGroup' ))
			{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => "Invalid Request"
	            );
	            echo json_encode($error_data);
			}
			else
			{
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperProgramGroupEdit']));
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
			/*echo $_POST['hidOperDocument'];
			die();	*/
			echo json_encode($this->Superadmin_model->superadmin($_POST, "add_document"));
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperDocumentEdit']));
		} 
			
	}
	public function operation_program_sdocument_add(){
			
			$config = array(
	               array(
	                     'field'   => 'txtsDocumentCode',
	                     'label'   => 'Document Code',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtsDocumentName',
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
				/*echo $_POST['hidOperDocument'];
				die();	*/
				echo json_encode($this->Superadmin_model->superadmin($_POST, "add_sdocument"));
			} 
				
		}
		public function operation_program_sdocument_edit(){
			
			$config = array(
	               array(
	                     'field'   => 'txtsDocumentCodeEdit',
	                     'label'   => 'Document Code',
	                     'rules'   => 'trim|required'
	                  ),
	               array(
	                     'field'   => 'txtsDocumentNameEdit',
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOpersDocumentEdit']));
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_program_menu'));
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_program_group'));
		}
	}
	public function operation_program_document_delete(){
			
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_document'));
		
	}
	public function operation_program_sdocument_delete(){
			
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_sdocument'));
		
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperCategory']));
			} 
		}
	}
	
	// ************************* LATEST NEWS AND ANNOUNCEMENTS ADDED BY ME *************************************
	public function news_events()
	{
		echo json_encode($this->admin_model->admin($_POST, 'news_events'));
			
	}
	public function get_faq()
	{
		echo json_encode($this->admin_model->admin($_POST, 'get_faq'));
			
	}
	public function get_telephony()
	{
		echo json_encode($this->admin_model->admin($_POST, 'get_telephony'));
			
	}
	public function latest_information()
	{
		echo json_encode($this->admin_model->admin($_POST, 'latest_information'));
			
	}
	public function get_prev_ques()
	{
		echo json_encode($this->admin_model->admin($_POST, 'get_prev_ques'));
			
	}
	public function get_chairman()
	{
		echo json_encode($this->admin_model->admin($_POST, 'get_chairman'));
			
	}
	public function get_right_menu()
	{
		echo json_encode($this->admin_model->admin($_POST, 'get_right_menu'));
			
	}
	public function get_document_details()
	{
		echo json_encode($this->admin_model->admin($_POST, 'get_document_details'));
			
	}
	public function operation_right_menu(){
		$inputCsrfToken = $_POST['hidCsrfToken'];
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
	         
	                 'field'   => 'txtMenu',
	                 'label'   => 'Menu Name',
	                 'rules'   => 'trim|required'),
	           
        		array(
         
                 'field'   => 'cmbRecordStatus',
                 'label'   => 'Status',
                 'rules'   => 'trim|required'),
			);
			$this->form_validation->set_rules($config); 
			//echo hi;
			if ($this->form_validation->run() == FALSE) {
			 	
				$data1 = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data1);
	            //echo validation_errors();
			    
			}
			else if(!checkToken( $inputCsrfToken, 'menuForm' )) 
			{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => "Invalid Request"
	            );
	            echo json_encode($error_data);
			    //echo validation_errors();
			}
			else{
				echo json_encode($this->admin_model->admin($_POST, $_POST['hidOperType']));
			} 
		}
	}
	public function operation_document_details(){
		//print $_POST['hidOperType'];die();
		$inputCsrfToken = $_POST['hidCsrfToken'];
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
            echo json_encode($data);
			//die();
		}
		else
		{	
			$config = array(
				array(
	                 'field'   => 'txtNewsEvents',
	                 'label'   => 'News',
	                 'rules'   => 'trim|required'
	                 ),
	        		array(
	                 'field'   => 'radioUpload',
	                 'label'   => 'Upload',
	                 'rules'   => 'trim|required'
	                 )
	        		
	        		);
		
			$this->form_validation->set_rules($config); 
			//echo hi;
			 if ($this->form_validation->run() == FALSE) {
			 	
				$data1 = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data1);
	            //echo validation_errors();
			    
			}
			else if(!checkToken( $inputCsrfToken, 'newsEventsForm' )) 
			{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => "Invalid Request"
	            );
	            echo json_encode($error_data);
			    //echo validation_errors();
			}
			else{
				echo json_encode($this->admin_model->admin($_POST, $_POST['hidOperType']));
			} 
		} 
			
		
	}
	public function operation_newsEventsData(){
		//print $_POST['hidOperType'];die();
		
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
	                 'field'   => 'txtNewsEvents',
	                 'label'   => 'News',
	                 'rules'   => 'trim|required'
	                 ),
	        		array(
	                 'field'   => 'radioUpload',
	                 'label'   => 'Upload',
	                 'rules'   => 'trim|required'
	                 )
	        		
	        		);
		
			$this->form_validation->set_rules($config); 
			//echo hi;
			 if ($this->form_validation->run() == FALSE) {
			 	
				$data1 = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data1);
	            //echo validation_errors();
			    
			}
			else{
				echo json_encode($this->admin_model->admin($_POST, $_POST['hidOperType']));
			} 
		} 
			
		
	}
	public function operation_faq(){
		//print $_POST['hidOperType'];die();
		
				
			$config = array(
				array(
	         
	                 'field'   => 'txtQues',
	                 'label'   => 'Question',
	                 'rules'   => 'trim|required'),
	            array(
	         
	                 'field'   => 'txtAns',
	                 'label'   => 'Answer',
	                 'rules'   => 'trim|required'),
	        		);
		
			$this->form_validation->set_rules($config); 
			//echo hi;
			 if ($this->form_validation->run() == FALSE) {
			 	
				$data1 = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data1);
	            //echo validation_errors();
			    
			}
			else{
				echo json_encode($this->admin_model->admin($_POST, $_POST['hidOperType']));
			} 
			
		
	}
	public function operation_telephony(){
		//print $_POST['hidOperType'];die();
		
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
	         
	                 'field'   => 'txtName',
	                 'label'   => 'Name',
	                 'rules'   => 'trim|required'),
	            array(
	         
	                 'field'   => 'txtDesg',
	                 'label'   => 'Designation',
	                 'rules'   => 'trim|required'),
	        		
	        	array(
	         
	                 'field'   => 'txtMobile',
	                 'label'   => 'mobile',
	                 'rules'   => 'trim|required')
	        		);
		
			$this->form_validation->set_rules($config); 
			//echo hi;
			 if ($this->form_validation->run() == FALSE) {
			 	
				$data1 = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data1);
	            //echo validation_errors();
			    
			}
			else{
				echo json_encode($this->admin_model->admin($_POST, $_POST['hidOperType']));
			} 
		} 
			
		
	}	
	public function operation_chairman(){
		//print $_POST['hidOperType'];die();
		
			$config = array(
				array(
	         
	                 'field'   => 'txtName',
	                 'label'   => 'Name',
	                 'rules'   => 'trim|required'),
	            array(
	         
	                 'field'   => 'txtMessage',
	                 'label'   => 'Message',
	                 'rules'   => 'trim|required'),
	        		);
		
			$this->form_validation->set_rules($config); 
			//echo hi;
			 if ($this->form_validation->run() == FALSE) {
			 	
				$data1 = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data1);
	            //echo validation_errors();
			    
			}
			else{
				echo json_encode($this->admin_model->admin($_POST, $_POST['hidOperType']));
			} 
			
		
	}
	public function delete_news_events(){
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
			echo json_encode($this->admin_model->admin($_POST, 'delete_news_events'));
		}
	}
	public function delete_faq(){
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
			echo json_encode($this->admin_model->admin($_POST, 'delete_faq'));
		}
	}
	public function delete_chairman(){
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
			echo json_encode($this->admin_model->admin($_POST, 'delete_chairman'));
		}
	}
	public function delete_telephony(){
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
			echo json_encode($this->admin_model->admin($_POST, 'delete_telephony'));
		}
	}
	public function operation_latestInfoData(){
		
		$temp_rule = Array(
			"&lt",
			"&gt",
			"(",
			")",
			"="
		);
		if (hasXSS($_POST,$temp_rule)){
			//echo "2";
			$data = array(
                'status' => 'xsserror',
                'msg' => 'Special chararacters like =,(,),&lt;,&gt; are not allowed'
            );
            echo json_encode($data);
			//die();
		}
		else
		{	
			$config = array(
					array(
	         
	                 'field'   => 'txtLinkName',
	                 'label'   => 'Link Name',
	                 'rules'   => 'trim|required'),
	                 array(
	         
	                 'field'   => 'radioUpload',
	                 'label'   => 'Upload',
	                 'rules'   => 'trim|required'),
	        		);
	        if($this->input->post('radioUpload') == 'PDF')	
	        {
		        	if (empty($_FILES['filePdf']['name']))
					{
					    $array1 = array(
		         
		                 'field'   => 'filePdf',
		                 'label'   => 'upload Pdf',
		                 'rules'   => 'trim|required');
		            	array_push($config, $array1); 
					}
				}	
			else
			{
					$array2 = array(
		         
		                 'field'   => 'textareaLink',
		                 'label'   => 'Insert Code',
		                 'rules'   => 'trim|required');
		            array_push($config, $array2);      
				}
			//print_r($config);exit;
			$this->form_validation->set_rules($config); 
			//echo hi;
			 if ($this->form_validation->run() == FALSE) {
				 	
					$data1 = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($data1);
		            //echo validation_errors();
				    
				}
			else{
				echo json_encode($this->admin_model->admin($_POST, $_POST['hidOperType']));
			} 
		} 
			
		
	}
	
	public function operation_prev_ques(){
		
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
	         
	                 'field'   => 'txtQuesSet',
	                 'label'   => 'Question Set',
	                 'rules'   => 'trim|required'),
	                 
	                
	        		);
	      
			//print_r($config);exit;
			$this->form_validation->set_rules($config); 
			//echo hi;
			 if ($this->form_validation->run() == FALSE) {
				 	
					$data1 = array(
		                'status' => 'validationerror',
		                'msg' => validation_errors()
		            );
		            echo json_encode($data1);
		            //echo validation_errors();
				    
				}
			else{
				echo json_encode($this->admin_model->admin($_POST, $_POST['hidOperType']));
			} 
		}	
		
	}
	public function delete_latest_information(){
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
			echo json_encode($this->admin_model->admin($_POST, 'delete_latest_information'));
		}
	}
	public function delete_prev_ques(){
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
			echo json_encode($this->admin_model->admin($_POST, 'delete_prev_ques'));
		}
	}
	
	// *************************** UPTO THIS ************************************************
	
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperCategoryEdit']));
			} 
		}
	} 
	public function operation_category_delete(){
			
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_category'));
		
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperMinority']));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperMinorityEdit']));
			}  
		}
	} 
	public function operation_minority_delete(){
			
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_minority'));
		
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperCaste']));
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
				/*echo $_POST['hidOperCasteEdit'];
				die();*/
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperCasteEdit']));
			} 
		}
	}
	public function operation_caste_delete(){
			
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_caste'));
		
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperReligion']));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperReligionEdit']));
			} 
		}
	}
	public function operation_religion_delete(){
			
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_religion'));
		
	}
	public function operation_instruction_add(){
		
		/*$config = array(
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
            );*/
		
  		/*$this->form_validation->set_rules($config);
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
		{*/
			echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperInstruction']));
		/*}*/ 
		
	}
	public function operation_user_program(){
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'add_user_program'));
	}
	public function operation_instruction_edit(){
		
		/*$config = array(
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
		{*/
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'edit_instruction'));
		/*} */
		
	}
	public function check_caste(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'check_caste'));
	}
	public function check_casteEdit(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'check_casteEdit'));
	}
	public function check_religion(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'check_religion'));
	}
	public function check_religion_edit(){	
		echo json_encode($this->Superadmin_model->superadmin('', 'check_religion_edit'));
	}
	public function check_mailType(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_mailType'));
	}
	public function check_smsType(){	
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_smsType'));
	}
	public function check_instruction(){	
		echo json_encode($this->admin_model->admin($_POST, 'check_instruction'));
	}
	public function operation_instruction_delete(){
			
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_instruction'));
		
	}
	public function check_instructionEdit(){	
		echo json_encode($this->admin_model->admin($_POST, 'check_instructionEdit'));
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperProvider']));
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'edit_provider'));
		} 
		
	}
	public function operation_provider_delete(){
			
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_sms_provider'));
		
	}
	public function operation_email_provider_add(){
		
		$config = array(
               	array(
                     'field'   => 'txtproviderEmail',
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperEmailProvider']));
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperEmailProviderEdit']));
		} 
		
	}
	public function operation_email_provider_delete(){
			
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_email_provider'));
		
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperSmsSetup']));
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperSmsSetupEdit']));
		} 
		
	}
	public function operation_sms_delete(){
			
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_sms'));
		
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperEmail']));
		} 
		
	}
	public function operation_email_edit(){
		
		$config = array(
               
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
                     'field'   => 'cmbStatusEdit1',
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperEmailEdit']));
		} 
		
	}
	public function operation_email_delete(){
			
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_email'));
		
	}
	public function delete_user_program(){
			
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_user_program'));
		
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
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_tablevalue'));
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['op_type_group']));
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
		echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['op_type']));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['op_type_role_group']));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['op_type_user_role_group']));
			} 
			
		}
		//Country
		//Country
		public function select_country(){	
			echo json_encode($this->Superadmin_model->superadmin('', 'select_country'));
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperCountry']));
				} 
			}
		}	
		// *******************  REGISTRATION SETUP ADDED BY ME******************************************************
		public function insert_registration_setup(){
			$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
	                 'field'   => 'txtRegStart',
	                 'label'   => 'Registration Start Date',
	                 'rules'   => 'trim|required'
	              ),
	              array(
	                 'field'   => 'txtRegEnd',
	                 'label'   => 'Registration End Date',
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
			    
			}
			else
			{
				echo json_encode($this->admin_model->admin($_POST, 'insert_registration_setup'));
			} 
		}
			
		}	
		// ****************************** UPTO THIS******************************************************************
		
		
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperCountryEdit']));
				} 
			}
		} 
		
		public function delete_country(){			
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_country'));			
		}
		
		//State
		public function select_state(){	
			echo json_encode($this->Superadmin_model->superadmin('', 'select_state'));
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperAddState']));
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperEditState']));
				} 
			}
		} 
		
		public function delete_state(){			
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_state'));			
		}
		//District
		public function select_district(){	
			echo json_encode($this->Superadmin_model->superadmin('', 'select_district'));
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
		                     'rules'   => 'trim|required|max_length[8]|regex_match[/^([A-Za-z0-9\s\-]+)$/i]'
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperAddDistrict']));
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
		                     'rules'   => 'trim|required|max_length[8]|regex_match[/^([A-Za-z0-9\s\-]+)$/i]'
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperEditDistrict']));
				} 
			}
		} 
		
		public function delete_district(){			
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_district'));			
		}
		//Nationality
		public function select_nationality(){	
			echo json_encode($this->Superadmin_model->superadmin('', 'select_nationality'));
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperAddNationality']));
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperEditNationality']));
				} 
			}
		} 
		
		public function delete_nationality(){			
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_nationality'));			
		}
		
		//Board
		public function select_board(){	
			echo json_encode($this->Superadmin_model->superadmin('', 'select_board'));
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperAddBoard']));
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperEditBoard']));
				} 
			}
		} 
		
		public function delete_board(){			
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_board'));			
		}
		//Standard
		public function select_standard(){	
			echo json_encode($this->Superadmin_model->superadmin('', 'select_standard'));
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperAddStandard']));
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperEditStandard']));
				} 
			}
		} 
		
		public function delete_standard(){			
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_standard'));			
		}
		//Qualification
		public function select_qualification(){	
			echo json_encode($this->Superadmin_model->superadmin('', 'select_qualification'));
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperAddQualification']));
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperEditQualification']));
				} 
			}
		} 
		
		public function delete_qualification(){			
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_qualification'));			
		}
		//Exam Center
		public function select_center(){	
			echo json_encode($this->Superadmin_model->superadmin('', 'select_center'));
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperAddExamCenter']));
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperEditExamCenter']));
				} 
			}
		} 
		
		public function delete_center(){			
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_center'));			
		}
		//Field
		public function select_field(){	
			echo json_encode($this->Superadmin_model->superadmin('', 'select_field'));
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
					
					echo json_encode($this->Superadmin_model->superadmin($_POST, 'insert_field'));
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidOperEditFields']));
				} 
			}
		} 
		
		public function delete_field(){			
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_field'));			
		}		
		
		public function cmb_status_centre(){	
			echo json_encode($this->Superadmin_model->superadmin('', 'cmb_status_centre'));
		}
		
		public function cmb_code(){	
			echo json_encode($this->Superadmin_model->superadmin('', 'cmb_code'));
		}
		
		public function cmb_status(){	
			echo json_encode($this->Superadmin_model->superadmin('', 'cmb_status'));
		}
		
		// =================XXXXXXXXXXXXXXX===========CHECK DUPLICATE===================XXXXXXXXXXXXXXXXXXXXXX=======//
		//Template
		public function check_duplicacy_code(){
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicacy_code'));
			}
		}
		//Menu
		public function check_duplicacy_menu_code(){
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicacy_menu_code'));
			}
		}
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_country_code'));
			}
		}
			/*public function check_country_code(){
			$temp_rule = Array(
				"&lt",
				"&gt",
				"<",
				">",
				"(",
				")",
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_country_code'));
			}
		}*/

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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_country_edit'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_state'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_state_edit'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_district'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_district_edit'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_nationality'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_nationality_edit'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_board'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_board_edit'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_standard'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_standard_edit'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_qualification'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_qualification_edit'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_center'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_code'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_code_edit'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_field'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_field_edit'));
			}
		}
		
		/*======================XXXXXXXXXXXXXXXXX========GENERIC SETUP 1=======XXXXXXXXXXXXXXXXXXXX============== */
		public function get_file_name1(){	
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_file_name'));
		}
		public function insert_template(){
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
		                     'rules'   => 'trim|required|max_length[10]|regex_match[/^([A-Za-z0-9\s]+)$/i]'
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, 'insert_template'));
				} 
			}
		}
		
		
		public function update_generic_template(){
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
		                     'rules'   => 'trim|required|max_length[10]|regex_match[/^([A-Za-z0-9\s]+)$/i]'
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, 'update_generic_template'));
				} 
			}
		}
		
		public function deletion_template_record(){	
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'deletion_template_record'));
		}
			
		/*======================XXXXXXXXXXXXXXXXX========GENERIC SETUP 3=======XXXXXXXXXXXXXXXXXXXX============== */
		public function select_file_name(){	
			echo json_encode($this->Superadmin_model->superadmin('', 'select_file_name'));
		}
		
		public function select_file_template_name(){	
			echo json_encode($this->Superadmin_model->superadmin('', 'select_file_template_name'));
		}
		
		//Registration Template
		public function select_registration_template(){	
			echo json_encode($this->Superadmin_model->superadmin('', 'select_registration_template'));
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidRegdTempAdd']));
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidRegdTempEdit']));
				} 
			}
		} 
		
		public function delete_registration_template(){			
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_registration_template'));			
		}
		
		//Profile Template
		public function select_template_master(){	
			echo json_encode($this->Superadmin_model->superadmin('', 'select_template_master'));
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidProfTempAdd']));
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
					echo json_encode($this->Superadmin_model->superadmin($_POST, $_POST['hidProfTempEdit']));
				} 
			}
		} 
		
		public function delete_profile_template(){			
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'delete_profile_template'));			
		}
		public function get_exam_centre_single(){	
			echo json_encode($this->admin_model->admin($_POST, 'get_exam_centre_single'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_template_code'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_template_code_edit'));
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
				echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_duplicate_registration_code'));
			}
		}
	public function get_program_table_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_program_tabledata'));
	}
	
	public function get_program_additional_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_program_additional_data'));
	}
	public function get_program_advertisement_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_program_advertisement_data'));
	}
	public function get_program_table_old_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_program_tableold_data'));
	}
	public function select_cmbgroup_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_cmbgroupdata'));
	}
	// public function select_post_data(){	
	// 	echo json_encode($this->admin_model->admin($_POST, 'select_postdata'));
	// }

	public function select_cmbtemplate_reg_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_cmbtemplatereg_data'));
	}
	public function select_cmbtemplate_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_cmbtemplatedata'));
	}
	public function insert_program_data(){
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
                'msg' => 'Special chararacters like <,>,=,&lt;,&gt; are not allowed'
            );
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	           array(
	                 'field'   => 'cmbProgramGroup',
	                 'label'   => 'Post Code',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtProgramName',
	                 'label'   => 'Post Name',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtStartdate',
	                 'label'   => 'Application Start Date',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtEnddate',
	                 'label'   => 'Application End Date',
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
			    
			}else{
				echo json_encode($this->admin_model->admin($_POST, 'insert_programdata'));
			} 
		}
		
	}
	public function insert_additional_data(){	
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
                'msg' => 'Special chararacters like <,>,=,&lt;,&gt; are not allowed'
            );
            echo json_encode($data);
			//die();
		}
		else
		{
			
			$config = array(
	           array(
	                 'field'   => 'cmbAdditionalProgram',
	                 'label'   => 'Post',
	                 'rules'   => 'trim|required|is_unique[additional_program_setup.program_code]'
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
				echo json_encode($this->admin_model->admin($_POST, 'insert_additional_data'));
			} 
		}
		
	}
	public function insert_advertisement_data(){	
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
                'msg' => 'Special chararacters like <,>,=,&lt;,&gt; are not allowed'
            );
            echo json_encode($data);
			//die();
		}
		else
		{
			
			// $config = array(
	  //          array(
	  //                'field'   => 'cmbAdditionalProgram',
	  //                'label'   => 'Post',
	  //                'rules'   => 'trim|required|is_unique[additional_program_setup.program_code]'
	  //             )
	  //       );
		
		
			// $this->form_validation->set_rules($config); 
			
		 //    if ($this->form_validation->run() == FALSE) {
			// 	$data = array(
	  //               'status' => 'validationerror',
	  //               'msg' => validation_errors()
	  //           );
	  //           echo json_encode($data);
			    
			// }else{
				echo json_encode($this->admin_model->admin($_POST, 'insert_advertisement_data'));
			// } 
		}
		
	}
	public function update_advertisement_data(){	
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"="
		);
		if (hasXSS($_POST,$temp_rule)){
			$data = array(
                'status' => 'xsserror',
                'msg' => 'Special chararacters like <,>,=,&lt;,&gt; are not allowed'
            );
            echo json_encode($data);
		}
		else
		{
			echo json_encode($this->admin_model->admin($_POST, 'update_advertisement_data'));
		}
		
	}
	public function delete_advertisement_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'delete_advertisement_data'));
	}
	public function update_additional_data(){	
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
                'msg' => 'Special chararacters like <,>,=,&lt;,&gt; are not allowed'
            );
            echo json_encode($data);
			//die();
		}
		else
		{
			
			
				echo json_encode($this->admin_model->admin($_POST, 'update_additional_data'));
			
		}
		
	}
	public function delete_additional_info(){	
		echo json_encode($this->admin_model->admin($_POST, 'delete_additional_data'));
	}
	public function CHKDUCPLICATE(){	
		echo json_encode($this->admin_model->admin($_POST, 'CHKDUCPLICATE_data'));
	}
	public function CHKDUCPLICATE_program_name(){	
		echo json_encode($this->admin_model->admin($_POST, 'CHKDUCPLICATE_program_name'));
	}
	public function get_program_group_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_program_groupdata'));
	}
	public function get_copyform_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_copyformdata'));
	}
	public function CHKDUCPLICATECOPY(){	
		echo json_encode($this->admin_model->admin($_POST, 'CHKDUCPLICATECOPY_data'));
	}
	public function insert_copy_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'insert_copydata'));
	}
	public function select_year(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_yeardata'));
	}
	public function edit_current(){	
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
                'msg' => 'Special chararacters like <,>,=,&lt;,&gt; are not allowed'
            );
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	           array(
	                 'field'   => 'cmbProgramGroupEdit',
	                 'label'   => 'Post',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtProgramNameEdit',
	                 'label'   => 'Post Name',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtStartdateEdit',
	                 'label'   => 'Application Start Date',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtEnddateEdit',
	                 'label'   => 'Application End Date',
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
			    
			}else{
				echo json_encode($this->admin_model->admin($_POST, 'edit_currentdata'));
			} 
		}
		
	}
	public function edit_old_data(){
		
		echo json_encode($this->admin_model->admin($_POST, 'edit_old_data'));
	}
	public function CHKEDITDUCPLICATE(){	
		echo json_encode($this->admin_model->admin($_POST, 'CHKEDITDUCPLICATE_data'));
	}
	public function delete_current(){	
		echo json_encode($this->admin_model->admin($_POST, 'delete_currentdata'));
	}
	public function publish(){	
		echo json_encode($this->admin_model->admin($_POST, 'publish_currentdata'));
	}
	public function count_program_menu(){	
		echo json_encode($this->admin_model->admin($_POST, 'count_program_menu_data'));
	}
	public function count_active_program_menu(){	
		echo json_encode($this->admin_model->admin($_POST, 'count_active_program_menu_data'));
	}
	public function count_show_menu(){	
		echo json_encode($this->admin_model->admin($_POST, 'count_show_menu_data'));
	}
	public function count_zero(){	
		echo json_encode($this->admin_model->admin($_POST, 'count_zero_data'));
	}
	public function inactive_documents(){	
		echo json_encode($this->admin_model->admin($_POST, 'inactive_documents_data'));
	}
	public function count_challan(){	
		echo json_encode($this->admin_model->admin($_POST, 'count_challandata'));
	}
	public function count_examcenter(){	
		echo json_encode($this->admin_model->admin($_POST, 'count_examcenter_data'));
	}
	public function count_inactive_sms(){	
		echo json_encode($this->admin_model->admin($_POST, 'count_inactive_sms_data'));
	}
	public function check_sms_provider(){
			
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_sms_provider'));	
	}
	public function check_sms_provider_edit(){
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
			echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_sms_provider_edit'));	
		}	
		
	}
	public function count_inactive_cat(){	
		echo json_encode($this->admin_model->admin($_POST, 'count_inactive_cat_data'));
	}
	public function SELECT_OLD(){	
		echo json_encode($this->admin_model->admin($_POST, 'SELECT_OLD_data'));
	}
	public function get_admitcard_date(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_admitcard_date'));
	}
	public function select_template_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_templatedata'));
	}
	public function archieve(){	
		echo json_encode($this->admin_model->admin($_POST, 'archievedata'));
	}
	public function edit_old(){	
		echo json_encode($this->admin_model->admin($_POST, 'edit_olddata'));
	}
	public function delete_old(){	
		echo json_encode($this->admin_model->admin($_POST, 'delete_olddata'));
	}
	public function get_report_admit_assign(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_report_admit_assign'));
	}
	public function get_cons_report_admit_assign(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_cons_report_admit_assign'));
	}
	// dms by santhoshi
	public function select_dms_applns(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_dms_applns'));
	}
	public function get_dms_modal_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_dms_modal_data'));
	}
	public function get_scrutiny_modal_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_scrutiny_modal_data'));
	}
	public function get_scrutiny_modal_data_template002(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_scrutiny_modal_data_template002'));
		
	}
	public function get_scrutiny_modal_data_template004(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_scrutiny_modal_data_template004'));
	}
	// upload scanned copy by santhoshi
	public function select_published_applicants(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_published_applicants'));
	}
	public function insert_scanned_copies(){	
		echo json_encode($this->admin_model->admin($_POST, 'insert_scanned_copies'));
	}
	public function insert_bulk_scanned_copies(){	
		echo json_encode($this->admin_model->admin($_POST, 'insert_bulk_scanned_copies'));
	}
	public function filepath_scanned_copies(){	
		echo json_encode($this->admin_model->admin($_POST, 'filepath_scanned_copies'));
	}
	////////
	public function SELECT_ALL_MENU(){	
		echo json_encode($this->admin_model->admin($_POST, 'SELECT_ALL_MENU_data'));
	}
	public function SELECTMENU(){	
		echo json_encode($this->admin_model->admin($_POST, 'SELECT_MENU_data'));
	}
	public function UPDATE_MULTIPLE(){	
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'UPDATE_MULTIPLE_data'));
		}
	}
	public function UPDATE(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'UPDATE_data'));
		}
	}
	public function SELECT(){	
		echo json_encode($this->admin_model->admin($_POST, 'SELECT_data'));
	}
	public function SELECT_ALL(){	
		echo json_encode($this->admin_model->admin($_POST, 'SELECT_ALL_data'));
	}
	public function CMB_STATUS_dt(){	
		echo json_encode($this->admin_model->admin($_POST, 'CMB_STATUS_data'));
	}
	public function CMB_CODE_dt(){	
		echo json_encode($this->admin_model->admin($_POST, 'CMB_CODE_data'));
	}
	public function UPDATE_MULTIPLE_reg(){	
		echo json_encode($this->admin_model->admin($_POST, 'UPDATE_MULTIPLE_reg_data'));
	}
	public function UPDATE_reg(){	
		echo json_encode($this->admin_model->admin($_POST, 'UPDATE_reg_data'));
	}
	public function select_prog_all(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_prog_all_data'));
	}
	public function select_category_all(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_category_all_data'));
	}
	public function get_save_admit_card(){	
		echo json_encode($this->admin_model->admin($_POST, 'save_admit_card'));
	}

	public function select_category_temp005(){	
		echo json_encode($this->Apply_model->apply($_POST, 'select_category_temp005'));
	}
	public function select_class_temp005(){	
		echo json_encode($this->Apply_model->apply($_POST, 'select_class_temp005'));
	}
	
	public function select_program_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_program_data'));
	}
	
	public function select_program_cutoff_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_program_cutoff_data'));
	}
	public function selected_assign_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_assign_data'));
	}
	public function get_category_all(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_category_multiple'));
	}
	public function update_multiple_category(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'assign_multiple_category'));
	
		}
	}
	public function get_category_single(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_category_one'));
	}
	public function update_single_category(){
	$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'assign_single_category'));
		}

	}
	public function get_dc_all(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_dc_multiple'));
	}
	public function update_multiple_dc(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'assign_multiple_dc'));
		}
		
	}
	public function get_dc_single(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_dc_one'));
	}
	public function update_single_dc(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'assign_single_dc'));
		}
		
	}
	public function get_exam_centre_multiple(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_exam_centre_all'));
	}
	public function get_qualification_all(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_qualification_multiple'));
	}
	public function update_multiple_centre(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'assign_multiple_centre'));
		}
	}
	public function get_qualification_single(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_qualification_one'));
	}
	public function update_single_qualification(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'assign_single_qualification'));
		}
	}
	public function get_fee_assign_all(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_fee_assign_multiple'));
	}
	public function get_fee_assign_all_reeval(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_fee_assign_all_reeval'));
	}
	public function update_multiple_fee(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'assign_multiple_fee'));
		}
	}
	public function update_multiple_cutoff_vacancy(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'update_multiple_cutoff_vacancy'));
		}
	}
	public function update_single_vacancy(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'assign_single_vacancy'));
		}	
	}
	public function update_multiple_vacancy(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'assign_multiple_vacancy'));
		}
	}
	public function assign_single_cutoff_vacancy(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			
		echo json_encode($this->admin_model->admin($_POST, 'assign_single_cutoff_vacancy'));
		}
	}
	public function update_multiple_fee_reeval(){
		echo json_encode($this->admin_model->admin($_POST, 'update_multiple_fee_reeval'));
	}
	public function get_fee_single(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_fee_one'));
	}
	public function get_vacancy_assign_all(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_vacancy_all'));
	}
	public function get_vacancy_single(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_vacancy_single'));
	}
	public function get_vacancy_cutoff_single(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_vacancy_cutoff_single'));
	}
	public function get_fee_single_reeval(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_fee_single_reeval'));
	}
	public function update_single_fee(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'assign_single_fee'));
		}
	}
	public function update_single_fee_reeval(){
		echo json_encode($this->admin_model->admin($_POST, 'update_single_fee_reeval'));
	}
	public function get_charge(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_charge_data'));
	}
	public function get_test(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_test_data'));
	}
	public function get_add(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_add_data'));
	}
	public function get_edit(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_edit_data'));
	}
	public function get_delete(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_delete_data'));
	}
	public function operation_feedata(){
		//echo $_POST['hidOperTypeResource'];
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
	                 'rules'   => 'required|numeric|greater_than[1]'
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
				echo json_encode($this->admin_model->admin($_POST, $_POST['hidOperTypeFeeAdd']));
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
			")",
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
	                 'rules'   => 'required|numeric|greater_than[1]'
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
				echo json_encode($this->admin_model->admin($_POST, $_POST['hidOperTypeFeeEdit']));
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
			echo json_encode($this->admin_model->admin($_POST, 'delete_feedata'));
		}
	}
	public function publish_result(){	
		echo json_encode($this->admin_model->admin($_POST, 'publish_result'));
	}
	public function select_program_data_manage_app(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_program_data_manage_app'));
	}
	public function get_general_information_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_general_information_data'));
	}
	public function Add_generalinfo_setup(){	
		/*$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
		{*/
			$optype = 'Add_generalinfo_setup';
			$config = array(
	           array(
	                 'field'   => 'cmbRecruitmentType',
	                 'label'   => 'Recruitment Type',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'cmbProgramName',
	                 'label'   => 'Program Name',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtDeclaration',
	                 'label'   => 'Declaration',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'cmbRecordStatus',
	                 'label'   => 'Status',
	                 'rules'   => 'trim|required'
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
			}
			else
			{
				echo json_encode($this->admin_model->admin($_POST, 'Add_generalinfo_setup'));
			} 
		/*}*/
		
	}
	public function Update_generalinfo_setup(){	
		/*$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
		{*/
			$optype = 'Update_generalinfo_setup';
			$config = array(
	           /*array(
	                 'field'   => 'cmbRecruitmentType',
	                 'label'   => 'Recruitment Type',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'cmbProgramName',
	                 'label'   => 'Program Name',
	                 'rules'   => 'trim|required'
	              ),*/
	            array(
	                 'field'   => 'txtDeclaration',
	                 'label'   => 'Declaration',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'cmbRecordStatus',
	                 'label'   => 'Status',
	                 'rules'   => 'trim|required'
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
			}
			else
			{
				echo json_encode($this->admin_model->admin($_POST, 'Update_generalinfo_setup'));
			} 
		/*}*/		
	}
	public function delete_generalinfo_Setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'delete_generalinfo_Setup'));
	}
	
	public function get_program_declaration_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_program_declaration_data'));
	}
	public function Add_programdeclaration_setup(){	
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			$optype = 'Add_programdeclaration_setup';
			$config = array(
	           array(
	                 'field'   => 'cmbRecruitmentType',
	                 'label'   => 'Recruitment Type',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'cmbProgramName',
	                 'label'   => 'Program Name',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtDeclaration',
	                 'label'   => 'Declaration',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'cmbRecordStatus',
	                 'label'   => 'Status',
	                 'rules'   => 'trim|required'
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
			}
			else
			{
				echo json_encode($this->admin_model->admin($_POST, 'Add_programdeclaration_setup'));
			} 
		}
		
	}
	public function Update_programdeclaration_setup(){	
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			$optype = 'Update_programdeclaration_setup';
			$config = array(
	           /*array(
	                 'field'   => 'cmbRecruitmentType',
	                 'label'   => 'Recruitment Type',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'cmbProgramName',
	                 'label'   => 'Program Name',
	                 'rules'   => 'trim|required'
	              ),*/
	            array(
	                 'field'   => 'txtDeclaration',
	                 'label'   => 'Declaration',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'cmbRecordStatus',
	                 'label'   => 'Status',
	                 'rules'   => 'trim|required'
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
			}
			else
			{
				echo json_encode($this->admin_model->admin($_POST, 'Update_programdeclaration_setup'));
			} 
		}		
	}
	public function delete_programdeclaration_Setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'delete_programdeclaration_Setup'));
	}
	
	public function select_Admin_user(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_Admin_user'));
	}
	public function get_program_name(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_program_name'));
	}
	public function get_user_program_mapping_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_user_program_mapping_data'));
	}
	public function Add_user_program_maping_setup(){	
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			$optype = 'Add_user_program_maping_setup';
			$config = array(
	           array(
	                 'field'   => 'cmbadmin',
	                 'label'   => 'Admin Name',
	                 'rules'   => 'trim|required'
	              ),
	           /*array(
	                 'field'   => 'program_codes',
	                 'label'   => 'Admin Name',
	                 'rules'   => 'trim|required'
	              ), */     	           
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
				echo json_encode($this->admin_model->admin($_POST, 'Add_user_program_maping_setup'));
			} 
		}
		
	}
	/*public function Update_user_program_maping_setup(){	
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			$optype = 'Update_user_program_maping_setup';
			$config = array(
	            array(
	                 'field'   => 'cmbadmin',
	                 'label'   => 'Admin Name',
	                 'rules'   => 'trim|required'
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
			}
			else
			{
				echo json_encode($this->admin_model->admin($_POST, 'Update_user_program_maping_setup'));
			} 
		}	
	}*/
	public function Delete_user_program_maping_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'Delete_user_program_maping_setup'));
	}
	
	public function select_recruitment_drive(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_recruitment_drive'));
	}
	public function select_program_name(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_program_name'));
	}
	public function update_multiple_exam_centre(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'assign_multiple_exam_centre'));
		}
	}
	public function update_exam_centre(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'update_centre'));
		}
	}
	public function select_applns(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_applications'));
	}
	public function select_applns_report(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_applications_report'));
	}
	public function select_registrations(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_registrations'));
	}
	
	public function select_program_manage_app(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_program_manage_application'));
	}
	public function save_apply_upload_program(){	
		echo json_encode($this->Apply_model->apply($_POST, 'save_apply_upload_program'));
	}
	public function edit_manage_appns(){	
		echo json_encode($this->admin_model->admin($_POST, 'edit_manage_applications'));
	}
	public function get_scrutiny_dates(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_scrutiny_dates'));
	}
	public function get_applnt_details_scrutiny(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_applicant_details_scrutiny'));
	}
	public function get_program_group_scrutiny_applnts(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_program_group_scrutiny_applicants'));
	}
	public function get_program_scrutiny_applnts(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_program_scrutiny_applicants'));
	}
	public function get_program_group_sbi_applnts(){	
		echo json_encode($this->admin_model->admin($_POST, 'program_group_sbi_applicants'));
	}
	public function get_program_sbi_applnts(){	
		echo json_encode($this->admin_model->admin($_POST, 'program_sbi_applicants'));
	}
	public function get_applicants_centre_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'applicants_centre_admit_setup'));
	}
	public function get_applnt_details_sbi(){	
		echo json_encode($this->admin_model->admin($_POST, 'applnt_details_sbi'));
	}
	public function get_verify_sbi_applnts(){	 
		echo json_encode($this->admin_model->admin($_POST, 'verify_sbi_applnts'));
	}
	public function get_reject_sbi_applnts(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_reject_sbi_applnts'));
	}
	public function disqualify_scrutiny_applnts(){	
		echo json_encode($this->admin_model->admin($_POST, 'disqualify_scrutiny_applicants'));
	}
	public function qualify_scrutiny_applnts(){	
		echo json_encode($this->admin_model->admin($_POST, 'qualify_scrutiny_applicants'));
	}
	public function get_template_scrutiny_applnts(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_template_scrutiny_applicants'));
	}
	
	public function get_location_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'location_admit_setup'));
	}
	
	public function get_program_group_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'program_group_admit_setup'));
	}
	public function get_program_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'program_admit_setup'));
	}
	public function get_exam_centre_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'exam_centre_admit_setup'));
	}
	public function get_exam_venue_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'exam_venue_admit_setup'));
	}
	public function get_centre_address_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'centre_address_admit_setup'));
	}
	public function get_apply_date_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'apply_date_admit_setup'));
	}
	public function get_change_program_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'change_program_setup'));
	}
	public function get_applicants_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'applicants_admit_setup'));
	}
	public function get_total_count_applicant(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_total_count_applicant'));
	}
	public function applicants_randomize_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'applicants_randomize_admit_setup'));
	}
	public function get_applicants_program_name_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'applicants_program_name_admit_setup'));
	}
	public function get_published_applicants_exam_centre_name_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'published_applicants_exam_centre_name_admit_setup'));
	}
	public function assign_published_applicants_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_assign_published_applicants_admit_setup'));
	}
	public function get_applicants_exam_centre_name_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'applicants_exam_centre_name_admit_setup'));
	}
	public function get_published_applicants_exam_venue_name_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'published_applicants_exam_venue_name_admit_setup'));
	}
	public function get_published_applicants_exam_venue_name_admit_setup_1(){	
		echo json_encode($this->admin_model->admin($_POST, 'published_applicants_exam_venue_name_admit_setup_1'));
	}
	public function get_applicants_venue_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'applicants_venue_admit_setup'));
	}
	public function get_applicants_capacity_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'applicants_capacity_admit_setup'));
	}
	public function assign_applicants_centre_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_assign_applicants_centre_admit_setup'));
	}
	public function get_published_applicants_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'published_applicants_admit_setup'));
	}
	public function get_published_applicants_report_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'published_applicants_report_admit_setup'));
	}
	public function get_change_program(){	
		echo json_encode($this->admin_model->admin($_POST, 'change_program'));
	}
	public function get_change_program_admit_card_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'change_program_admit_card_setup'));
	}
	
	public function get_check_mobile_number_change_dob(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_check_mobile_number_change_dob'));
	}
	public function get_change_DOB(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_change_dob'));
	}
	public function get_check_mobile_admit_card_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'check_mobile_admit_card_setup'));
	}
	public function get_change_mobile_admit_card_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'change_mobile_admit_card_setup'));
	}
	public function chk_duplicate_admit_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'chkDuplicate_admit_setup'));
	}
	public function chk_duplicate_admit_setup_sl_no(){	
		echo json_encode($this->admin_model->admin($_POST, 'chk_duplicate_admit_setup_sl_no'));
	}
	public function operation_add_centre(){
		$config = array(
	          
	            array(
	                 'field'   => 'cmbExamCentreAdd',
	                 'label'   => 'Exam Center',
	                 'rules'   => 'trim|required'
	              ),
	       		array(
	                 'field'   => 'txtExamVanueCode',
	                 'label'   => 'Exam Venue Code',
	                 'rules'   => 'trim|required'
	              ),
	       		array(
	                 'field'   => 'txtExamVanue',
	                 'label'   => 'Exam Venue Name',
	                 'rules'   => 'trim|required'
	              ),
	             array(
	                 'field'   => 'cmbRound',
	                 'label'   => 'Round',
	                 'rules'   => 'trim|required'
	              )/*,
	             array(
	                 'field'   => 'cmbTemplate',
	                 'label'   => 'Exam Type',
	                 'rules'   => 'trim|required'
	              )*/,
	             array(
	                 'field'   => 'txtCapacity',
	                 'label'   => 'Capacity',
	                 'rules'   => 'trim|required'
	              ),
	             array(
	                 'field'   => 'cmbStatus',
	                 'label'   => 'Status',
	                 'rules'   => 'trim|required'
	              )/*,
	             array(
	                 'field'   => 'txtAvailableFrom',
	                 'label'   => 'Admit Card Available From',
	                 'rules'   => 'trim|required'
	              ),
	             array(
	                 'field'   => 'txtAvailableUpto',
	                 'label'   => 'Admit Card Available Up To',
	                 'rules'   => 'trim|required'
	              )*/
	               
	        );
		
		
			$this->form_validation->set_rules($config); 
			
		    if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    
			}
			else
			{
				echo json_encode($this->admin_model->admin($_POST, $_POST['hidOperTypeCentreAdd']));
			}
		
	}
	public function operation_edit_centre(){
		$config = array(
	           array(
	                 'field'   => 'cmbExamCentreEdit',
	                 'label'   => 'Exam Center',
	                 'rules'   => 'trim|required'
	              ),
	       		array(
	                 'field'   => 'txtExamVanueEdit',
	                 'label'   => 'Exam Venue Name',
	                 'rules'   => 'trim|required'
	              ),
	             array(
	                 'field'   => 'txtExamRoundEdit',
	                 'label'   => 'Round',
	                 'rules'   => 'trim|required'
	              ),
	            /* array(
	                 'field'   => 'cmbTemplateEdit',
	                 'label'   => 'Exam Type',
	                 'rules'   => 'trim|required'
	              ),*/
	             array(
	                 'field'   => 'txtCapacityEdit',
	                 'label'   => 'Capacity',
	                 'rules'   => 'trim|required'
	              ),
	             /*array(
	                 'field'   => 'txtCentreAddressEdit',
	                 'label'   => 'Center Address',
	                 'rules'   => 'trim|required'
	              ),*/
	             array(
	                 'field'   => 'cmbStatusEdit',
	                 'label'   => 'Status',
	                 'rules'   => 'trim|required'
	              )/*,
	             array(
	                 'field'   => 'txtAvailableFromEdit',
	                 'label'   => 'Admit Card Available From',
	                 'rules'   => 'trim|required'
	              ),
	             array(
	                 'field'   => 'txtAvailableUptoEdit',
	                 'label'   => 'Admit Card Available Up To',
	                 'rules'   => 'trim|required'
	              )  */
	        );
		
		
			$this->form_validation->set_rules($config); 
			
		    if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    
			}
			else
			{
				echo json_encode($this->admin_model->admin($_POST, $_POST['hidOperTypeCentreEdit']));
			} 
		
	}
	public function get_document_all(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_document_multiple'));
	}
	public function get_assign_document_all(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_assign_document_multiple'));
	}
	public function get_document_single(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_document_one'));
	}
	public function get_selected_assigned_single(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_selected_assigned_one'));
	}
	public function update_multiple_document(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'assign_multiple_document'));
		}
	}
	public function select_assign_document(){
		echo json_encode($this->admin_model->admin($_POST, 'select_assign_document_one'));
	}
	public function update_single_document(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			echo json_encode($this->admin_model->admin($_POST, 'assign_single_document'));
		}
	}
	
	//----------------------- selected update--------------------------------
	public function get_sdocument_single(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_sdocument_one'));
	}
	public function update_single_sdocument(){
		echo json_encode($this->admin_model->admin($_POST, 'assign_single_sdocument'));
	}
	
	public function select_streams(){
		echo json_encode($this->admin_model->admin($_POST, 'select_streams'));
	}
	public function ADD_Stream(){
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
	                 'field'   => 'txtCenterCode',
	                 'label'   => 'Stream code',
	                 'rules'   => 'trim|required|is_unique[stream_master.stream_code]'
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
				echo json_encode($this->admin_model->admin($_POST, 'ADD_Stream'));
			} 
		}
		
	}
	
	public function UPDATE_Stream(){
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
			
			echo json_encode($this->admin_model->admin($_POST, 'UPDATE_Stream'));
		}
		
	}
	public function operation_delete_stream(){
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
			echo json_encode($this->admin_model->admin($_POST, 'operation_delete_stream'));
		}
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
		$uploaddir = DOCUMENT_UPLOAD_URL.'/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print_008.pdf', 'F');
		//$this->load->view('pdf/template008_pdf');	
		/*$pdf->Output($applicantNumber.".pdf",'I');*/	
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
	public function temp_config(){
		echo json_encode($this->Apply_model->apply($_POST, 'temp_config'));
	}
	
	public function course_modal(){
		echo json_encode($this->Apply_model->apply($_POST, 'course_modal'));
	}
	public function select_center_preference(){
		echo json_encode($this->Apply_model->apply($_POST, 'get_center_preference'));
	}
	public function select_center_preference_south(){
		echo json_encode($this->Apply_model->apply($_POST, 'get_center_preference_south'));
	}
	public function select_center_preference_common(){
		echo json_encode($this->Apply_model->apply($_POST, 'get_center_preference_common'));
	}
	public function support_modal(){
		echo json_encode($this->Feedback_model->apply($_POST, 'support_modal'));
	}
	public function quicklink_modal(){
		echo json_encode($this->Feedback_model->apply($_POST, 'quicklink_modal'));
	}
	public function select_course_data(){
		echo json_encode($this->Apply_model->apply($_POST, 'get_course_detail')); 
	}
	/*public function support_form_modal(){
		echo json_encode($this->Feedback_model->apply($_POST, 'support_form_modal'));
	}*/
	
	public function support_form_modal(){
		
		if( $this->input->post())
		{
			$inputCaptcha = $this->input->post('txtCaptcha1');
    		$sessCaptcha = $this->session->userdata('captchaCodefeedback');
    		//echo $inputCaptcha .'#'. $sessCaptcha ; die();
			if($inputCaptcha != '' && $inputCaptcha != $sessCaptcha )
			{
				$data = array(
	                'status' => 'captchaerror',
	                'msg' => 'Invalid Captcha. Please try again.'
	            );
				$this->session->set_flashdata('error', $data['msg']);
				$this->session->set_flashdata('post_data', $this->input->post());
				
				$output = array('status' => FALSE, 'msg' =>$data['msg']);
	           	echo json_encode($output);
				//redirect($this->agent->referrer());
			}
			else{
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
                  	),
                  	array(
                     'field'   => 'txtCaptcha1',
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
		           $output = array('status' => FALSE, 'msg' =>$data['msg']);
		           echo json_encode($output);
				}
				else
				{
					echo json_encode($this->Feedback_model->apply($_POST, 'support_form_modal'));
				}
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
		
		echo json_encode($this->Apply_model->apply($_POST, 'select_graduation_course'));
			
	}
	public function select_program_for_online_details()
	{
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'select_program_for_online_details'));
			
	}
	public function select_online_payment_verification()
	{
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'select_online_payment_verification'));
			
	}
	public function update_online_payment_verification()
	{
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'update_online_payment_verifications'));
			
	}
	
	public function get_roundWiseStatus()
	{
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_roundWiseStatus'));
			
	}
	
	public function check_publish_status()
	{
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'check_publish_status'));
			
	}
	public function check_folder_name()
	{
		echo json_encode($this->admin_model->admin($_POST, 'check_folder_name'));
			
	}
	
	public function change_publish_status()
	{
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'change_publish_status'));
			
	}
	
	public function update_refund_online_payment_verification()
	{
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'update_refund_online_payment_verification'));
			
	}
	
	public function select_state_details()
	{
		echo json_encode($this->Apply_model->apply(null,'get_state_data'));
	}
	public function get_rank_data()
	{
		echo json_encode($this->admin_model->admin(null,'get_rank_data'));
	}
	
	public function get_call_list()
	{
		echo json_encode($this->admin_model->admin(null,'get_call_list'));
	}
	
	// ********************************************************* Santhoshi **************************************************************************//
	
	public function get_program_modal_data()
	{
		echo json_encode($this->Apply_model->apply($_POST,'get_program_modal_data'));
	}
	// ********************************************************* Result **************************************************************************//
	
	public function result_html()
	{
		$program_code = $this->uri->segment(3); // 2ndsegment
		$institute_code = $this->uri->segment(4); // 3rdsegment
		$data = array(
			'institute'=>$institute_code,
			'program'=>$program_code
		);
		$data['result'] = $this->Apply_model->apply($data,'result_html');
		$this->load->view('apply/result',$data);
	}
	// ********************************************************* End Result **************************************************************************//
	//start qual
	public function add_qual()
	{
		echo json_encode($this->Apply_model->apply($_POST, 'add_qual'));
			
	}
	//end qual
	public function add_table_research()
	{
		echo json_encode($this->Apply_model->apply($_POST, 'add_table_research'));
			
	}
	public function select_count_experience()
	{
		
		echo json_encode($this->Apply_model->apply($_POST, 'select_count_experience'));		
	}
	public function get_file_name()
	{
		echo json_encode($this->admin_model->admin($_POST, 'get_file_name'));
			
	}
	public function preview_template001(){
		$order_id = 1;
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template001_pdf($order_id, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template001_pdf($order_id, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template001_pdf($order_id, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template001_pdf($order_id, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template001_pdf($order_id, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template001_pdf($order_id, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template001_pdf($order_id, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template001_pdf($order_id, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template001_pdf($order_id, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template001_pdf($order_id, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template001_pdf($order_id, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template001_pdf($order_id, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template001_pdf($order_id, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template001_pdf($order_id, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template001_pdf($order_id, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template001_pdf($order_id, 'get_applicant_documents');
        
		echo json_encode($this->Apply_model->apply($data, 'preview_template001'));	
	}
	
	public function preview_template002(){
		$order_id = 1;
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template001_pdf($order_id, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template001_pdf($order_id, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template001_pdf($order_id, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template001_pdf($order_id, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template001_pdf($order_id, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template001_pdf($order_id, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template001_pdf($order_id, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template001_pdf($order_id, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template001_pdf($order_id, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template001_pdf($order_id, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template001_pdf($order_id, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template001_pdf($order_id, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template001_pdf($order_id, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template001_pdf($order_id, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template001_pdf($order_id, 'get_other_nationality');
        $data['applicant_documents'] = $this->m_pdf_model->template001_pdf($order_id, 'get_applicant_documents');
        
		echo json_encode($this->Apply_model->apply($data, 'preview_template002'));	
	}
	
	public function preview_template009(){
		$order_id = 1;
		echo json_encode($this->Apply_model->apply($order_id, 'preview_template009'));	
	}
	
	public function preview_template004(){
		$order_id = 1;
		echo json_encode($this->Apply_model->apply($order_id, 'preview_template004'));	
	}
	
	//************************************************* CATEGORY ELIGIBILITY PERIOD SETUP ***************************************** 

	public function select_category_eligibility_details(){	
		echo json_encode($this->Apply_model->apply($_POST, 'select_category_eligibility_details'));
	}
	public function select_eligible_cat(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_eligible_cat'));
	}
	public function select_course(){
		echo json_encode($this->admin_model->admin($_POST, 'select_course')); 
	}
	public function get_program_elig_cat(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_program_elig_cat'));
	}
	public function get_cat_elig_cat(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_cat_elig_cat'));
	}
	public function ADD_CatElig(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
	                 'field'   => 'cmbProgram',
	                 'label'   => 'Post',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'cmbCategory',
	                 'label'   => 'Category',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtAgeStartdate',
	                 'label'   => 'From Date',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtAgeEnddate',
	                 'label'   => 'To Date',
	                 'rules'   => 'trim|required'
	              ),
	              
	        );
		
		
			$this->form_validation->set_rules($config); 
			
		    if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    
			}
			else
			{
				$optype = 'ADD_CatElig';
				echo json_encode($this->admin_model->admin($_POST, $optype));
			} 
			
		}
		
	} 
	public function UPDATE_CatElig(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
	                 'field'   => 'txtAgeStartdate',
	                 'label'   => 'From Date',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtAgeEnddate',
	                 'label'   => 'To Date',
	                 'rules'   => 'trim|required'
	              ),
	              
	        );
		
		
			$this->form_validation->set_rules($config); 
			
		    if ($this->form_validation->run() == FALSE) {
				$data = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data);
			    
			}
			else
			{
				$optype = 'UPDATE_CatElig';
				echo json_encode($this->admin_model->admin($_POST, $optype));
			} 
			
		}
	} 
	public function operation_delete_CatElig(){
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
			$optype = 'operation_delete_CatElig';
			
			echo json_encode($this->admin_model->admin($_POST, $optype)); 
		}
		
	}
	public function ADD_Course(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
	                 'field'   => 'cmbProgram',
	                 'label'   => 'Post',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtCourseName',
	                 'label'   => 'Name',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtCoursecode',
	                 'label'   => 'Code',
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
			    
			}
			else
			{
				$optype = 'ADD_Course';
				echo json_encode($this->admin_model->admin($_POST, $optype));
			} 
			
		}
		
	} 
	public function UPDATE_Course(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
	                 'field'   => 'cmbProgram',
	                 'label'   => 'Post',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtCourseName',
	                 'label'   => 'Name',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtCoursecode',
	                 'label'   => 'Code',
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
			    
			}
			else
			{
				$optype = 'UPDATE_Course';
				echo json_encode($this->admin_model->admin($_POST, $optype));
			} 
			
		}
		
	} 
	public function add_degree_wise_course(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
	                 'field'   => 'cmbProgramGroupQual2',
	                 'label'   => 'Drive',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'cmbSelectProgram2',
	                 'label'   => 'Post',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'cmbQualificationcourse',
	                 'label'   => 'Qualification',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'cmbdegree',
	                 'label'   => 'Degree',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtcourse',
	                 'label'   => 'Course',
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
			}
			else
			{
				$optype = 'add_degree_wise_course';
				echo json_encode($this->admin_model->admin($_POST, $optype));
			} 
		}
	}
	public function edit_degree_wise_course(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
	                 'field'   => 'cmbProgramGroupQual2',
	                 'label'   => 'Drive',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'cmbSelectProgram2',
	                 'label'   => 'Post',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'cmbQualificationcourse',
	                 'label'   => 'Qualification',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'cmbdegree',
	                 'label'   => 'Degree',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtcourse',
	                 'label'   => 'Course',
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
			}
			else
			{
				$optype = 'edit_degree_wise_course';
				echo json_encode($this->admin_model->admin($_POST, $optype));
			} 
		}
	}
	public function delete_course(){
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
			
			echo json_encode($this->admin_model->admin($_POST, $optype)); 
		}
		
	}
	//*************************************************  NODAL CENTER TO COUNTER MAPPING *******************************
	public function select_program_qual_stream(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_program_qual_stream'));
	}
	public function select_program_Stream_Code(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_program_Stream_Code'));
	}
	public function select_qual_Stream_Code(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_qual_Stream_Code'));
	}
	public function select_Stream_Code(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_Stream_Code'));
	}
	public function ADD_ProgQualStreamMapping(){
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
			$optype = 'ADD_ProgQualStreamMapping';
			
			echo json_encode($this->admin_model->admin($_POST, $optype));
		}
		
	} 
	public function UPDATE_ProgQualStreamMapping(){
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
			$optype = 'UPDATE_ProgQualStreamMapping';
			
			echo json_encode($this->admin_model->admin($_POST, $optype));
		}
		
	} 
	public function operation_deleteQualStreamMapping(){
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
			$optype = 'operation_deleteQualStreamMapping';
			
			echo json_encode($this->admin_model->admin($_POST, $optype)); 
		}
		
	} 
	public function preview_template005(){
		$order_id = 1;
		/*echo "HIEEEEEE";
		die();*/
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
        
		echo json_encode($this->Apply_model->apply($data, 'preview_template005'));	
	}
	
	//*************************************************  RESULT DETAILS *******************************
	public function select_resultDetails(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_resultDetails'));
	}
	//susmita
	public function select_meritDetails(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_meritDetails'));
	}
	public function ADD_Result(){
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
			$optype = 'ADD_Result';
			
			echo json_encode($this->admin_model->admin($_POST, $optype));
		}
		
	} 
	public function save_Result(){
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
			$optype = 'save_Result';
			
			echo json_encode($this->admin_model->admin($_POST, $optype));
		}
		
	}
	public function UPDATE_Result(){
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
			$optype = 'UPDATE_Result';
			
			echo json_encode($this->admin_model->admin($_POST, $optype));
		}
		
	} 
	public function operation_deleteResult()
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'operation_deleteResult';
			
			echo json_encode($this->admin_model->admin($_POST, $optype)); 
		}
		
	} 
	public function INSERTtest_table()
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'INSERTtest_table';
			
			echo json_encode($this->admin_model->admin($_POST, $optype));
		}
		
	}
	
	public function UPDATEtest_table()
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
            echo json_encode($data);
			//die();
		}
		else
		{
			$optype = 'UPDATETtest_table';
			
			echo json_encode($this->admin_model->admin($_POST, $optype));
		}
		
	}
	/**
	* Author: Rahul Patro
	* Date: 22-12-2018
	* Module Name: Dossier Module
	* Purpose: ADD_NEW_FOLDER,ADD_NEW_FILE
	* 
	* @return
	*/ 
	public function ADD_NEW_FOLDER(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
	                 'field'   => 'txtFolderName',
	                 'label'   => 'Folder Name',
	                 'rules'   => 'trim|required'
	              ),
	      		 array(
	                 'field'   => 'txtFolderDesc',
	                 'label'   => 'Folder Description',
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
			    
			}
			else
			{
				echo json_encode($this->admin_model->admin($_POST, 'ADD_NEW_FOLDER')); 
			}
		}
		
	} 
	public function ADD_NEW_FILE(){
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
	                 'field'   => 'txtFileName',
	                 'label'   => 'File Name',
	                 'rules'   => 'trim|required'
	              ),
	              array(
	                 'field'   => 'txtFileDesc',
	                 'label'   => 'File Description',
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
			    
			}
			else
			{
				echo json_encode($this->admin_model->admin($_POST, 'ADD_NEW_FILE')); 
			}
		}
		
	} 
	public function GET_FILE_DATA(){
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
			echo json_encode($this->admin_model->admin($_POST, 'GET_FILE_DATA')); 
		}
		
	} 
	public function GET_FILE_DETAIL_INFO(){
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
			echo json_encode($this->admin_model->admin($_POST, 'GET_FILE_DETAIL_INFO')); 
		}
		
	} 
	public function get_folder_detail(){
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
			echo json_encode($this->admin_model->admin($_POST, 'get_folder_detail')); 
		}
		
	}
	public function get_doc_down_list(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_doc_down_list'));
	} 
	public function add_document(){	
		echo json_encode($this->admin_model->admin($_POST, 'add_document'));
	}
	public function get_courseSetup(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_courseSetup'));
	}
	public function activity_details(){	
		echo json_encode($this->admin_model->admin($_POST, 'activity_details'));
	}
	public function Add_course_setup(){
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
                'msg' => 'Special chararacters like <,>,=,&lt;,&gt; are not allowed'
            );
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	           array(
	                 'field'   => 'cmbProgram',
	                 'label'   => 'Post',
	                 'rules'   => 'trim|required'
	              ),
	              array(
	                 'field'   => 'txtCourseName',
	                 'label'   => 'Subject Name',
	                 'rules'   => 'trim|required'
	              ),
	              array(
	                 'field'   => 'txtExamDate',
	                 'label'   => 'Exam Date',
	                 'rules'   => 'trim|required'
	              ),
	              array(
	                 'field'   => 'cmbSession',
	                 'label'   => 'Session',
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
			    
			}
			else
			{
				$optype = 'Add_course_setup';
				echo json_encode($this->admin_model->admin($_POST, $optype));
			} 
		}
		
	} 
	public function Update_course_setup(){
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
                'msg' => 'Special chararacters like <,>,=,&lt;,&gt; are not allowed'
            );
            echo json_encode($data);
			//die();
		}
		else
		{
			$config = array(
	         
	              array(
	                 'field'   => 'txtCourseName',
	                 'label'   => 'Subject Name',
	                 'rules'   => 'trim|required'
	              ),
	              array(
	                 'field'   => 'txtExamDate',
	                 'label'   => 'Exam Date',
	                 'rules'   => 'trim|required'
	              ),
	              array(
	                 'field'   => 'cmbSession',
	                 'label'   => 'Session',
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
			    
			}
			else
			{
				$optype = 'Update_course_setup';
				echo json_encode($this->admin_model->admin($_POST, $optype));
			} 
		}
		
	} 
	public function operation_delete_courseSetup(){
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
			$optype = 'operation_delete_courseSetup';
			
			echo json_encode($this->admin_model->admin($_POST, $optype)); 
		}
		
	} 
	
	public function get_round_no(){
		$optype = 'get_round_no';
		echo json_encode($this->admin_model->admin($_POST, $optype));
	} 
	public function get_vacancy_details()
	{
		echo json_encode($this->Index_model->index_data($_POST,'get_vacancy_details')); 
	}
	public function check_forgot_password_otp()
	{
		echo json_encode($this->Apply_model->apply($_POST,'check_forgot_password_otp')); 
	}
	public function exam_venue_data()
	{
		echo json_encode($this->admin_model->admin($_POST,'exam_venue_data')); 
	}
	public function get_applicant_details(){	
		//print_r($_POST);die();
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_applicant_details'));
	}
	public function get_admin_details(){	
		//print_r($_POST);die();
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_Admin_details'));
	}
	public function get_login(){	
		//print_r($_POST);die();
		echo json_encode($this->Superadmin_model->superadmin($_POST, 'get_login'));
	}
	
	
	public function save_applicant_details_temp(){	
		//print_r($_POST);die();
		$inputCsrfToken = $_POST['hidApplicantDetailToken'];
		$temp_rule = Array(
			"(",
			"=",
			"<",
			">",
			")",
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
		elseif(!checkToken( $inputCsrfToken, 'frmApplicantDetails' ))
		{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => "Invalid Request !"
	            );
	            echo json_encode($error_data);
		}
		else
		{
			echo json_encode($this->Apply_model->apply($_POST, 'save_applicant_details_temp'));
		}
		
	}
	public function save_applicant_details_temp_001(){	
		//print_r($_POST);die();
		echo json_encode($this->Apply_model->apply($_POST, 'save_applicant_details_temp_001'));
	}
	public function save_applicant_academic_details_temp(){	
		//print_r($_POST);die();
			$config = array( 
	              array(
	                 'field'   => 'txtYear1',
	                 'label'   => 'Year',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtYear2',
	                 'label'   => 'Year',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtYear3',
	                 'label'   => 'Year',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtYear4',
	                 'label'   => 'Year',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtBoard1',
	                 'label'   => 'Board',
	                 'rules'   => 'required'
	              ),array(
	                 'field'   => 'txtBoard2',
	                 'label'   => 'Board',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtBoard3',
	                 'label'   => 'Board',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtBoard4',
	                 'label'   => 'Board',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtdistinct1',
	                 'label'   => 'Division',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtdistinct2',
	                 'label'   => 'Division',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtdistinct3',
	                 'label'   => 'Division',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtdistinct4',
	                 'label'   => 'Division',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtgrading1',
	                 'label'   => 'Grade',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtgrading2',
	                 'label'   => 'Grade',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtgrading3',
	                 'label'   => 'Grade',
	                 'rules'   => 'required'
	              ), 
	              array(
	                 'field'   => 'txtgrading4',
	                 'label'   => 'Grade',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtPercent1',
	                 'label'   => 'Percent',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtPercent2',
	                 'label'   => 'Percent',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtPercent3',
	                 'label'   => 'Percent',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtPercent4',
	                 'label'   => 'Percent',
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
				echo json_encode($this->Apply_model->apply($_POST, 'save_applicant_academic_details_temp'));
			}
		
	}
	public function save_applicant_academic_details_temp_001(){	
		//print_r($_POST);die();
		echo json_encode($this->Apply_model->apply($_POST, 'save_applicant_academic_details_temp_001'));
	}
	public function save_applicant_info_temp(){	
		//print_r($_POST);die();
		echo json_encode($this->Apply_model->apply($_POST, 'save_applicant_info_temp'));
	}
	public function add_application_data_02(){	
		//print_r($_POST);die();
		$temp_rule = Array(
			"&"
			
		);
		if (hasXSS($_POST,$temp_rule)){
			//echo "2";
			$data = array(
                'status' => 'xsserror',
                'msg' => 'Special chararacter like & is not allowed'
            );
            echo json_encode($data);
			//die();
		}
		else
		{
			
			$config = array( 
	           array(
	                 'field'   => 'txtFatherName',
	                 'label'   => 'Father Name',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtMotherName',
	                 'label'   => 'Mother Name',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'radiogender',
	                 'label'   => 'Gender',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'cmbidproof',
	                 'label'   => 'Id Proof Type',
	                 'rules'   => 'required'
	              ),
	               
	               array(
	                 'field'   => 'txtidproof',
	                 'label'   => 'Id Proof',
	                 'rules'   => 'required'
	              ),
	               
	               array(
	                 'field'   => 'cmbCommunity',
	                 'label'   => 'Category',
	                 'rules'   => 'required'
	              ),
	               
	               array(
	                 'field'   => 'radioPhysicallY',
	                 'label'   => 'Select any of this',
	                 'rules'   => 'required'
	              ),
	              /* array(
	                 'field'   => 'radioSports',
	                 'label'   => 'Select any of this',
	                 'rules'   => 'required'
	              ),*/ 
	              
	               array(
	                 'field'   => 'txtPresentLocality',
	                 'label'   => 'Locality',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtPresentPost',
	                 'label'   => 'Present Post',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'city_name',
	                 'label'   => 'City Name',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtPresentPin',
	                 'label'   => 'Pin',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtYear1',
	                 'label'   => 'Year',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtYear2',
	                 'label'   => 'Year',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtYear3',
	                 'label'   => 'Year',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtBoard1',
	                 'label'   => 'Board',
	                 'rules'   => 'required'
	              ),array(
	                 'field'   => 'txtBoard2',
	                 'label'   => 'Board',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtBoard3',
	                 'label'   => 'Board',
	                 'rules'   => 'required'
	              ),
	              
	               array(
	                 'field'   => 'txtdistinct1',
	                 'label'   => 'Division',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtdistinct2',
	                 'label'   => 'Division',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtdistinct3',
	                 'label'   => 'Division',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtgrading1',
	                 'label'   => 'Grade',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtgrading2',
	                 'label'   => 'Grade',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtgrading3',
	                 'label'   => 'Grade',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtPercent1',
	                 'label'   => 'Percent',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtPercent2',
	                 'label'   => 'Percent',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtPercent3',
	                 'label'   => 'Percent',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtqual22',
	                 'label'   => 'Degree / Master In',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtqual23',
	                 'label'   => 'Degree / Master In',
	                 'rules'   => 'required'
	              ),
	             /* array(
	                 'field'   => 'txtStream1',
	                 'label'   => 'Stream',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtStream2',
	                 'label'   => 'Stream',
	                 'rules'   => 'required'
	              ),*/
	             /* array(
	                 'field'   => 'txtYearQual1',
	                 'label'   => 'Year',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtYearQual2',
	                 'label'   => 'Year',
	                 'rules'   => 'required'
	              ),*/
	             /* array(
	                 'field'   => 'txtDiv1',
	                 'label'   => 'Division',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtDiv2',
	                 'label'   => 'Division',
	                 'rules'   => 'required'
	              ),*/
	             /* array(
	                 'field'   => 'txtGradingOth1',
	                 'label'   => 'Grading',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtGradingOth2',
	                 'label'   => 'Grading',
	                 'rules'   => 'required'
	              ),*/
	              
	             /* array(
	                 'field'   => 'txtYear1',
	                 'label'   => 'Year',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtYear2',
	                 'label'   => 'Year',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtYear3',
	                 'label'   => 'Year',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtYear4',
	                 'label'   => 'Year',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtYear5',
	                 'label'   => 'Year',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtYear6',
	                 'label'   => 'Year',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtYear7',
	                 'label'   => 'Year',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtYear8',
	                 'label'   => 'Year',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtTechnical_5_2',
	                 'label'   => 'Technical',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtTechnical_6_2',
	                 'label'   => 'Technical',
	                 'rules'   => 'required'
	              ),array(
	                 'field'   => 'txtBoard1',
	                 'label'   => 'Board',
	                 'rules'   => 'required'
	              ),array(
	                 'field'   => 'txtBoard2',
	                 'label'   => 'Board',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtBoard3',
	                 'label'   => 'Board',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtBoard4',
	                 'label'   => 'Board',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtFM1',
	                 'label'   => 'Full mark',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtFM2',
	                 'label'   => 'Full Mark',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtFM3',
	                 'label'   => 'Full Mark',
	                 'rules'   => 'required'
	              ),
	              array(
	                 'field'   => 'txtFM4',
	                 'label'   => 'Full Mark',
	                 'rules'   => 'required'
	              ),*/
	              /* array(
	                 'field'   => 'txtqual21',
	                 'label'   => 'Qualification',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtqual22',
	                 'label'   => 'Qualification',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtqual23',
	                 'label'   => 'Qualification',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtqual24',
	                 'label'   => 'Qualification',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtOther_grad1',
	                 'label'   => 'Other',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtOther_grad2',
	                 'label'   => 'Other',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtOther_grad3',
	                 'label'   => 'Other',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtOther_grad4',
	                 'label'   => 'Other',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtOther_grad5',
	                 'label'   => 'Other',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtgrading1',
	                 'label'   => 'Grade',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtgrading2',
	                 'label'   => 'Grade',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtgrading3',
	                 'label'   => 'Grade',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtgrading4',
	                 'label'   => 'Grade',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtdistinct1',
	                 'label'   => 'Full',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtdistinct2',
	                 'label'   => 'Division',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtgrading2',
	                 'label'   => 'Division',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtdistinct3',
	                 'label'   => 'Division',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtdistinct4',
	                 'label'   => 'Division',
	                 'rules'   => 'required'
	              ),*/
	              /* array(
	                 'field'   => 'txtPercent1',
	                 'label'   => 'Percent',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtPercent2',
	                 'label'   => 'Percent',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtPercent3',
	                 'label'   => 'Percent',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtPercent4',
	                 'label'   => 'Percent',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtPercent5',
	                 'label'   => 'Percent',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtPercent6',
	                 'label'   => 'Percent',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtPercent7',
	                 'label'   => 'Percent',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtPercent8',
	                 'label'   => 'Percent',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtCGPA1',
	                 'label'   => 'CGPA',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtCGPA2',
	                 'label'   => 'CGPA',
	                 'rules'   => 'required'
	              ),
	               array(
	                 'field'   => 'txtCGPA2',
	                 'label'   => 'CGPA',
	                 'rules'   => 'required'
	              ),*/
	              
	             /*  array(
	                 'field'   => 'txtNameOfOffice',
	                 'label'   => 'Name',
	                 'rules'   => 'required'
	              ),*/
	              /* array(
	                 'field'   => 'txtDOJ',
	                 'label'   => 'Date of Joining',
	                 'rules'   => 'required'
	              ),*/
	              /* array(
	                 'field'   => 'txtNameOfPost',
	                 'label'   => 'Name of Post',
	                 'rules'   => 'required'
	              ),*/
	               
	              /* array(
	                 'field'   => 'txtDateOfDebar',
	                 'label'   => 'Date of Debar',
	                 'rules'   => 'required'
	              ),*/
	              /* array(
	                 'field'   => 'txtPeriodOfDebar',
	                 'label'   => 'Period',
	                 'rules'   => 'required'
	              ),*/
	              
	           
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
				echo json_encode($this->Apply_model->apply($_POST, 'add_application_data_02'));
		}
	}
	
}	
public function add_application_data_001(){	
		//print_r($_POST);die();
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
	                 'field'   => 'txtFatherName',
	                 'label'   => 'Father Name',
	                 'rules'   => 'required'
	              ),
	               
	               array(
	                 'field'   => 'radiogender',
	                 'label'   => 'Gender',
	                 'rules'   => 'required'
	              ),
	             
	               
	               array(
	                 'field'   => 'radioPhysicallY',
	                 'label'   => 'Select any of this',
	                 'rules'   => 'required'
	              ),
	             
	             
	               array(
	                 'field'   => 'txtPresentLocality',
	                 'label'   => 'Locality',
	                 'rules'   => 'required'
	              ),
	              
	              array(
	                 'field'   => 'city_name',
	                 'label'   => 'City Name',
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
				echo json_encode($this->Apply_model->apply($_POST, 'add_application_data_001'));
		}
	}
	
}	
	// for invigilator setup
	
	
	
	public function get_InvigilatorData(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_InvigilatorData'));
	}
	public function Add_Invigilator_setup(){	
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
			$optype = 'Add_Invigilator_setup';
			$config = array(
	           array(
	                 'field'   => 'txtInvigilatorCode',
	                 'label'   => 'Invigilator Code',
	                 'rules'   => 'trim|required|is_unique[invigilator_setup.code]'
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
				echo json_encode($this->admin_model->admin($_POST, 'Add_Invigilator_setup'));
			} 
		}
		
	}
	public function Update_Invigilator_setup(){	
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
			
				echo json_encode($this->admin_model->admin($_POST, 'Update_Invigilator_setup'));
			
		}
		
	}
	public function operation_delete_Invigilator_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'operation_delete_Invigilator_setup'));
	}
	public function invigilator_code(){
		echo json_encode($this->admin_model->admin($_POST,'invigilator_code')); 
	}
	
	
	// venue wise invigilator setup
	
	public function randomize_invigilators(){	
		echo json_encode($this->admin_model->admin($_POST, 'randomize_invigilators'));
	}
	public function get_InvigilatorVenueData(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_InvigilatorVenueData'));
	}
	
	
		
	// appointment letter data
	
	public function get_AppointmentData(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_AppointmentData'));
	}
	
	public function add_appointmentLetter(){	
		$config = array(
	           array(
	                 'field'   => 'txtAuthorisedName',
	                 'label'   => 'Authorised Name',
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
			    
			}
			else{
				echo json_encode($this->admin_model->admin($_POST, 'add_appointmentLetter'));
			} 
		
		
	}
	public function edit_appointmentLetter(){
		$config = array(
	           array(
	                 'field'   => 'txtAuthorisedName',
	                 'label'   => 'Authorised Name',
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
			    
			}
			else
			{
				echo json_encode($this->admin_model->admin($_POST, 'edit_appointmentLetter'));
			} 
	}
	public function operation_delete_AppointmentLetter(){	
		echo json_encode($this->admin_model->admin($_POST, 'operation_delete_AppointmentLetter'));
	}
	public function change_password(){	
		//print_r($_POST);die();
		echo json_encode($this->User_model->change_password($_POST, 'change_password'));
	}
	public function logout_all_system(){	
		echo json_encode($this->Apply_model->apply($_POST, 'logout_all_system'));
	}
	public function change_applicant_password(){	
		echo json_encode($this->Apply_model->apply($_POST, 'change_applicant_password'));
	}
	    
	// OMR data reports by Santhoshi
	
	// Consolidated Report
	public function getConsolidatedReport(){
		echo json_encode($this->admin_model->admin($_POST,'getConsolidatedReport'));
	}
	// Subject Wise Report Header
	public function getSWReportHeader(){
		echo json_encode($this->admin_model->admin($_POST,'getSWReportHeader'));
	}
	// Subject Wise Report
	public function getSWReport(){
		echo json_encode($this->admin_model->admin($_POST,'getSWReport'));
	}
	// Consolidated with Count Report
	public function getConsolidatedCountReport(){
		echo json_encode($this->admin_model->admin($_POST,'getConsolidatedCountReport'));
	}
	// Subject Wise Count Report
	public function getSWCReport(){
		echo json_encode($this->admin_model->admin($_POST,'getSWCReport')); 
	}
	public function send_pro_otp(){
		
		 echo json_encode($this->Apply_model->apply($_POST, 'send_pro_otp'));
		
	}
	public function send_pro_otp_login(){
		
		 echo json_encode($this->Apply_model->apply($_POST, 'send_pro_otp_login'));
		
	}
	public function check_otp_data(){
		echo json_encode($this->Apply_model->apply($_POST, 'check_otp_data'));
	}
	public function insert_registration_data(){
		echo json_encode($this->Apply_model->apply($_POST, 'insert_registration_data'));
	} 
	public function check_mobile_no(){
		echo json_encode($this->Apply_model->apply($_POST, 'check_mobile_no'));
	} 
	public function check_email_id(){
		echo json_encode($this->Apply_model->apply($_POST, 'check_email_id'));
	}
	public function get_mobile_no(){ 
		echo json_encode($this->Apply_model->apply($_POST, 'get_mobile_no'));
	} 
	public function course_wise_date_eligibility(){ 
		echo json_encode($this->Apply_model->apply($_POST, 'course_wise_date_eligibility'));
	} 	
	public function course_wise_date_eligibility_001(){ 
		echo json_encode($this->Apply_model->apply($_POST, 'course_wise_date_eligibility_001'));
	} 
	public function get_document_path(){ 
		echo json_encode($this->Apply_model->apply($_POST, 'get_document_path'));
	} 
	//************************************************** Admit Card Generic Setup ***********************************************************//
	
	public function get_admit_genericData(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_admit_genericData'));
	}
	public function Add_admit_generic_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'Add_admit_generic_setup'));
	}
	public function Update_admit_generic_setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'Update_admit_generic_setup'));		
	}
	public function operation_delete_admitcard_genericSetup(){	
		echo json_encode($this->admin_model->admin($_POST, 'operation_delete_admitcard_genericSetup'));
	}
	public function get_advertisement(){	
		//print_r($_POST);die();
		echo json_encode($this->admin_model->admin($_POST, 'get_advertisement'));
	}
	public function get_advertisement_date(){	
		//print_r($_POST);die();
		echo json_encode($this->admin_model->admin($_POST, 'get_advertisement_date'));
	}
	public function get_corgendum_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_corgendum_data'));
	}
	public function update_corgiendum_data(){	
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
                'msg' => 'Special chararacters like <,>,=,&lt;,&gt; are not allowed'
            );
            echo json_encode($data);
			//die();
		}
		else
		{
			
			
				echo json_encode($this->admin_model->admin($_POST, 'update_corgiendum_data'));
			
		}
		
	}
	public function insert_corgiendum_data(){	 
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
	                'msg' => 'Special chararacters like <,>,=,&lt;,&gt; are not allowed'
	            );
	            echo json_encode($data);
				//die();
			}
			else
			{
				
				$config = array(
		           array(
		                 'field'   => 'cmbAdditionalProgram',
		                 'label'   => 'Post',
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
				    
				}else{
					echo json_encode($this->admin_model->admin($_POST, 'insert_corgiendum_data'));
				} 
			}
		
	}
	public function delete_corgiendum(){	
		echo json_encode($this->admin_model->admin($_POST, 'delete_corgiendum'));
	}
	public function get_general_info_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_general_info_data'));
	}
	public function insert_general_info_data(){	
		//print_r($_POST);die;
		echo json_encode($this->admin_model->admin($_POST, 'insert_general_info_data'));
	}
	public function update_general_info_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'update_general_info_data'));
	}
	public function delete_general_info(){	
		echo json_encode($this->admin_model->admin($_POST, 'delete_general_info'));
	}
	public function get_general_instruction_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_general_instruction_data'));
	}
	public function insert_instruction_data(){	
		//print_r($_POST);die;
		echo json_encode($this->admin_model->admin($_POST, 'insert_instruction_data'));
	}
	public function update_instruction_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'update_instruction_data'));
	}
	public function delete_instruction(){	
		echo json_encode($this->admin_model->admin($_POST, 'delete_instruction'));
	}
	public function get_experience_validation_data(){	
		//print_r($_POST);die;
		echo json_encode($this->admin_model->admin($_POST, 'get_experience_validation_data'));
	}
	public function insert_exp_validation_data(){	
		//print_r($_POST);die;
		$inputCsrfToken = $_POST['hidfrmAdditionalDataToken'];
		$temp_rule = Array(
			"(",
			"=",
			"<",
			">",
			")",
		);
		if (hasXSS($_POST,$temp_rule)){
			//echo "2";
			$data = array(
                'status' => 'xsserror',
                'msg' => 'Special chararacters like <,>,=,(,),&lt;,&gt; are not allowed'
            );
            echo json_encode($data);die;
			//die();
		}
		elseif(!checkToken( $inputCsrfToken, 'frmAdditionalData' ))
		{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => "Invalid Request !"
	            );
	            echo json_encode($error_data);die;
		}
		else
		{
			echo json_encode($this->admin_model->admin($_POST, 'insert_exp_validation_data'));
		}
		
		
	}
	public function update_exp_validation_data(){	  
		echo json_encode($this->admin_model->admin($_POST, 'update_exp_validation_data'));
	}
	public function delete_exp_validation_data(){	
		echo json_encode($this->admin_model->admin($_POST, 'delete_exp_validation_data'));
	}
	
	public function gen_info(){
		echo json_encode($this->Apply_model->apply($_POST, 'gen_info'));  
	}
	public function check_experience_validation(){
		if(isset($_POST['radioExperience1']))
		{
			
			echo json_encode($this->Apply_model->apply($_POST, 'check_experience_validation')); 
			
		}
		else
		{
			$data = array(
	                'status' => TRUE,
	                'msg' => 'No experience'
	            );
	         echo json_encode($data);exit;
		}	
		 
	}
	public function general_info(){
		echo json_encode($this->Apply_model->apply($_POST, 'general_info'));
	}
	public function get_religion(){
		echo json_encode($this->admin_model->admin($_POST, 'get_religion'));
	}
	public function add_religion(){
		echo json_encode($this->admin_model->admin($_POST, 'add_religion'));
	}
	public function edit_religion(){
		echo json_encode($this->admin_model->admin($_POST, 'edit_religion'));
	}
	public function get_qual_degree_data(){
		echo json_encode($this->admin_model->admin($_POST, 'get_qual_degree_data'));
	}
	public function corrigendum_info(){
		echo json_encode($this->Apply_model->apply($_POST, 'corrigendum_info'));
	}
	public function notice_info(){
		echo json_encode($this->Apply_model->apply($_POST, 'notice_info'));
	}
	public function add_degree(){
		echo json_encode($this->admin_model->admin($_POST, 'add_degree')); 
	}
	public function edit_degree(){
		echo json_encode($this->admin_model->admin($_POST, 'edit_degree'));
	}
	public function delete_degree(){
		echo json_encode($this->admin_model->admin($_POST, 'delete_degree'));
	}
	public function get_degree_course_data(){
		echo json_encode($this->admin_model->admin($_POST, 'get_degree_course_data'));
	}
	public function select_course_SRSEC(){
		echo json_encode($this->Apply_model->apply($_POST, 'select_course_SRSEC'));
	}
	public function select_course_GRADUTION(){
		echo json_encode($this->Apply_model->apply($_POST, 'select_course_GRADUTION'));
	}
	public function select_course_PG(){
		echo json_encode($this->Apply_model->apply($_POST, 'select_course_PG'));
	}
	public function Bank_challan_submit(){
		echo json_encode($this->Apply_model->apply($_POST, 'Bank_challan_submit'));
	}
	public function submit_application(){
		echo json_encode($this->Apply_model->apply($_POST, 'submit_application'));
	}
	
	public function select_programname(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_programname'));
	}
	public function select_action_name(){	
		echo json_encode($this->admin_model->admin($_POST, 'select_action_name'));
	}
	public function get_actionmaster(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_actionmaster'));
	}
	public function get_action_round_no(){	
		echo json_encode($this->admin_model->admin($_POST, 'get_action_round_no'));
	}
	public function Add_actionmaster_setup(){	
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			$optype = 'Add_actionmaster_setup';
			$config = array(
	           array(
	                 'field'   => 'cmbProgramName',
	                 'label'   => 'Program Name',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtactionname',
	                 'label'   => 'Action Name',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtstartdate',
	                 'label'   => 'Start Date',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtenddate',
	                 'label'   => 'End Date',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'cmbRecordStatus',
	                 'label'   => 'Status',
	                 'rules'   => 'trim|required'
	              ),
	           	           
	        );
	        if ($this->input->post('txtactionname') == 'other') {
				if ($this->input->post('txtactionname2') == '') {
					$array1 = array(

						'field'   => 'txtactionname2',
						'label'   => 'Action Name',
						'rules'   => 'trim|required'
					);
					array_push($config, $array1);
				}
			} /*else {
				$array2 = array(

					'field'   => 'txtactionname',
					'label'   => 'Action Name',
					'rules'   => 'trim|required'
				);
				array_push($config, $array2);
			}*/
			
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
				echo json_encode($this->admin_model->admin($_POST, 'Add_actionmaster_setup'));
			} 
		}
		
	}
	
	public function Update_actionmaster_setup(){	
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
			$optype = 'Update_actionmaster_setup';
			$config = array(
				/*array(
	                 'field'   => 'cmbProgramName',
	                 'label'   => 'Program Name',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtactionname',
	                 'label'   => 'Action Name',
	                 'rules'   => 'trim|required'
	              ),*/
	            array(
	                 'field'   => 'txtstartdate',
	                 'label'   => 'Start Date',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'txtenddate',
	                 'label'   => 'End Date',
	                 'rules'   => 'trim|required'
	              ),
	            array(
	                 'field'   => 'cmbRecordStatus',
	                 'label'   => 'Status',
	                 'rules'   => 'trim|required'
	              ),
	          
	        );
	        if ($this->input->post('txtactionname') == 'other') {
				if ($this->input->post('txtactionname2') == '') {
					$array1 = array(

						'field'   => 'txtactionname2',
						'label'   => 'Action Name',
						'rules'   => 'trim|required'
					);
					array_push($config, $array1);
				}
			} /*else {
				$array2 = array(

					'field'   => 'txtactionname',
					'label'   => 'Action Name',
					'rules'   => 'trim|required'
				);
				array_push($config, $array2);
			}*/
			
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
				echo json_encode($this->admin_model->admin($_POST, 'Update_actionmaster_setup'));
			} 
		}
	}
	public function delete_actionmaster_Setup(){	
		echo json_encode($this->admin_model->admin($_POST, 'delete_actionmaster_Setup'));
	}
	public function add_checked_value(){
		echo json_encode($this->admin_model->admin($_POST, 'add_checked_value'));
	}
	public function remove_checked_value(){
		echo json_encode($this->admin_model->admin($_POST, 'remove_checked_value'));
	}
	
	public function get_information_type_menu()
	{
		echo json_encode($this->admin_model->admin($_POST, 'get_information_type_menu'));			
	}
	public function operation_information_type_menu(){
		//$inputCsrfToken = $_POST['hidCsrfToken'];
		$temp_rule = Array(
			"&lt",
			"&gt",
			"<",
			">",
			"(",
			")",
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
	         
	                 'field'   => 'txtMenu',
	                 'label'   => 'Menu Name',
	                 'rules'   => 'trim|required'),
	           
        		array(
         
                 'field'   => 'cmbRecordStatus',
                 'label'   => 'Status',
                 'rules'   => 'trim|required'),
			);
			$this->form_validation->set_rules($config); 
			//echo hi;
			if ($this->form_validation->run() == FALSE) {
			 	
				$data1 = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data1);
	            //echo validation_errors();
			    
			}
			/*else if(!checkToken( $inputCsrfToken, 'menuForm' )) 
			{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => "Invalid Request"
	            );
	            echo json_encode($error_data);
			    //echo validation_errors();
			}*/
			else{
				echo json_encode($this->admin_model->admin($_POST, $_POST['hidOperType']));
			} 
		}
	}
	
	public function get_information_details()
	{
		echo json_encode($this->admin_model->admin($_POST, 'get_information_details'));			
	}
	public function update_information_details()
	{
		echo json_encode($this->admin_model->admin($_POST, 'update_information_details'));			
	}
	public function get_informationtype()
	{
		echo json_encode($this->admin_model->admin($_POST, 'get_informationtype'));			
	}
	public function operation_informaion_details(){
		//print $_POST['hidOperType'];die();
		//$inputCsrfToken = $_POST['hidCsrfToken'];
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
            echo json_encode($data);
			//die();
		}
		else
		{	
			$config = array(
				
	        	array(
	                 'field'   => 'txtMenu',
	                 'label'   => 'Information Type',
	                 'rules'   => 'trim|required'
	                 ),
	            array(
	                 'field'   => 'txtSubMenu',
	                 'label'   => 'Information Details',
	                 'rules'   => 'trim|required'
	                 ),
	           array(
	                 'field'   => 'txtDate',
	                 'label'   => 'Date',
	                 'rules'   => 'trim|required'
	                 ),
	           array(
	                 'field'   => 'radioUpload',
	                 'label'   => 'Upload Type',
	                 'rules'   => 'trim|required'
	                 ),
	          array(
	                 'field'   => 'cmbRecordStatus',
	                 'label'   => 'Record Status',
	                 'rules'   => 'trim|required'
	                 ),
	        		
	        		);
		
			$this->form_validation->set_rules($config); 
			//echo hi;
			 if ($this->form_validation->run() == FALSE) {
			 	
				$data1 = array(
	                'status' => 'validationerror',
	                'msg' => validation_errors()
	            );
	            echo json_encode($data1);
	            //echo validation_errors();
			    
			}
			/*else if(!checkToken( $inputCsrfToken, 'newsEventsForm' )) 
			{
				$error_data = array(
	                'status' => 'validationerror',
	                'msg' => "Invalid Request"
	            );
	            echo json_encode($error_data);
			    //echo validation_errors();
			}*/
			else{
				echo json_encode($this->admin_model->admin($_POST, $_POST['hidOperType']));
			} 
		} 		
		
	}
	public function delete_information_details(){
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
			echo json_encode($this->admin_model->admin($_POST, 'delete_information_details'));
		}
	}
	
	
}
