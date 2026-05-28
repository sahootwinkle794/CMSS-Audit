<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
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
		$this->load->model('superadmin_model');
		$this->load->model('admin_model');
		$this->load->model('apply_model');
		$this->load->model('index_model');
		$this->load->helper('custom_encryption');		
		//$data['role'] = $this->session->userdata('role');
		$this->load->helper('custom_security');	
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
		if(!$this->session->userdata('user_code'))
		{
			$check_user = $this->apply_model->apply('','get_user_check');//echo $this->session->userdata('reg_user_id');die();
			if( !$this->session->userdata('reg_user_id') || !$check_user)
			{
				redirect('user_logout');
			}
		}
		
		if( !in_array($role, array('ADM','DASHADM','ADM1','EVALUATEADM','DASHBOARD','ADMITCARDADM','SETUPADM')))
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
	public function index()
	{
		redirect('admin_controller/dashboard');
		
	}	
	public function pdfreport12() {
		 $this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $program_code = $this->uri->segment(3); // 1stsegment
		$exam_centre_code = $this->uri->segment(4); // 2ndsegment
		$exam_vanue1 = $this->uri->segment(5); // 3rdsegment
		$from = $this->uri->segment(6); // 4thsegment
		$to = $this->uri->segment(7); // 5thsegment
		$course = $this->uri->segment(8); // 5thsegment
		$exam_vanue = str_replace("_","/",$exam_vanue1);
		
		$program_code_new = str_replace('%60','/',$program_code);
		$data = array(
            'program_code' => $program_code_new,
            'assigned_exam_center_code' => $exam_centre_code,
            'exam_vanue' => $exam_vanue,
            'from' => $from,
            'to' => $to,
            'course' => $course
        );
        $data['applicantSRow'] = $this->m_pdf_model->admit_card_pdf($data,'get_attendance_sheet_detail');
        
        $data['type'] = "ADMIT_CARD";
                
		$html = $this->load->view('pdf/attendance_sheet', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
          
        $pdfFilePath = "attendance_sheet_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $mpdf = $this->m_pdf->pdf;
        $mpdf->showImageErrors = true;
        //generate the PDF!
       	$mpdf->WriteHTML($html);
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$mpdf->Output($uploaddir.'/attendance_sheet_print.pdf', 'I'); 
    } 
   
    public function excel_admitcard12(){
		$program_code = $this->uri->segment(3); // 1stsegment
		$exam_centre_code = $this->uri->segment(4); // 2ndsegment
		$exam_vanue1 = $this->uri->segment(5); // 3rdsegment
		$from = $this->uri->segment(6); // 4thsegment
		$to = $this->uri->segment(7); // 5thsegment
		$course = $this->uri->segment(8); // 6thsegment
		$exam_vanue = str_replace("_","/",$exam_vanue1);
		$program_code_new = str_replace('%60','/',$program_code);
		$data = array(
            'program_code' => $program_code_new,
            'assigned_exam_center_code' => $exam_centre_code,
            'exam_vanue' => $exam_vanue,
            'from' => $from,
            'to' => $to,
            'course' => $course
        );
        $this->load->library('excel');
		/*require_once './application/third_party/phpexcel/PHPExcel.php';
		require_once './application/third_party/phpexcel/PHPExcel/IOFactory.php';*/
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true)->setSize(14)->getColor()->applyFromArray(array("rgb" =>'BLACK'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$F=$objPHPExcel->getActiveSheet();

		$F->getColumnDimension('B')->setAutoSize(TRUE);
		$F->getColumnDimension('C')->setAutoSize(TRUE);
		$F->getColumnDimension('D')->setAutoSize(TRUE);
		$F->getColumnDimension('E')->setAutoSize(TRUE);
		$F->getColumnDimension('F')->setAutoSize(TRUE);
		$F->getColumnDimension('G')->setAutoSize(TRUE);
		
		$Line=1;
		$F->setCellValue('A'.$Line,'Slno')
			->setCellValue('B'.$Line,'Appl no')
			->setCellValue('C'.$Line,'Applicant Name')
			->setCellValue('D'.$Line,'Post')
			->setCellValue('E'.$Line,'Exam Center')
			->setCellValue('F'.$Line,'Assigned Exam Venue')
			->setCellValue('G'.$Line,'Roll No');
			++$Line;
		$slno = 1;
		//$objDrawing = new PHPExcel_Worksheet_Drawing();
		$photo = "";
		$signature = "";
		
		$data_excel1 = $this->admin_model->excel1_report_admit_card($data);
		//$validate = $this->admin_model->excel1_report_admit_card($data);
		
		foreach ($data_excel1 as $value)
		{
			$F->getStyle('G'.$Line)
		    ->getNumberFormat()
		    ->setFormatCode(
		        PHPExcel_Style_NumberFormat::FORMAT_TEXT
		    );
			$roll_no = $value->omr_no;
			$F->setCellValueExplicit(
		        'G'.$Line, 
		        $roll_no, 
		        PHPExcel_Cell_DataType::TYPE_STRING
		    );
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$Line, $slno);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$Line, $value->appl_no);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$Line, $value->full_name);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$Line, $value->program_name);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$Line, $value->exam_centre_name);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$Line, $value->exam_vanue);
			//$objPHPExcel->getActiveSheet()->setCellValue('G'.$Line, $value->roll_no);
			++$Line;
			$slno++;
		}
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Applicantlist.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		
	}
	public function dashboard()
	{
		$key = $this->session->userdata('key');
		if($key == '')
		{
			$this->session->set_userdata('key',uniqid());
		}
		/*echo $this->session->userdata('key');die();*/
		//echo 'hi';die();
		$sidebar['menuitem'] = 'DASHBOARD';
		$sidebar['group'] = 'DASHBOARD';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
		$data['all_program_list'] = $this->admin_model->admin(NULL,'get_all_program_list');
		$data['active_program_list'] = $this->admin_model->admin(NULL,'get_active_program_list');
		$data['uploaded_document_list'] = $this->admin_model->admin(NULL,'get_uploaded_document_list');
		$data['online_paid_list'] = $this->admin_model->admin(NULL,'get_online_paid_list');
		//$sel_program_group = $this->session->userdata('sel_program_group');
		//echo $sel_program_group;
		//die();
		$data['challan_verified_list'] = $this->admin_model->admin(NULL,'get_challan_verified_list');
		$data['SCST_list'] = $this->admin_model->admin(NULL,'get_SCST_list');
		$data['OnCounter_list'] = $this->admin_model->admin(NULL,'get_OnCounter_list');
		//$data['inactive_institute_list'] = $this->superadmin_model->superadmin(NULL,'get_inactive_institute_list');
		/*$data['get_users'] = $this->superadmin_model->superadmin(NULL,'get_users');
		$data['get_user_loggedin'] = $this->superadmin_model->superadmin(NULL,'get_user_loggedin');*/
		//$data['total_collection'] = $this->superadmin_model->superadmin(NULL,'total_collection');
		//$this->load->view('template_config/admin_header');
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('admin/dashboard',$data);
		/*$this->load->view('template_config/admin_footer');*/
	}
	
	public function registration_setup()
	{
		$sidebar['menuitem'] = 'Registration Setup';
  		$sidebar['group'] = 'RECRUITMENT SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		
  		$data['date_apply'] = $this->admin_model->admin(NULL,'get_allDates');
  		$data['eligible_date'] = $this->admin_model->admin(NULL,'get_allDates_eligibility');
  		$this->load->view('admin/registration_setup',$data);
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	
	public function news_announcements()
	{
		$sidebar['menuitem'] = 'News & Announcements';
  		$sidebar['group'] = 'MANAGE INFORMATION';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/news_announcements');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	
	public function latest_information()
	{
		$sidebar['menuitem'] = 'Latest Information';
  		$sidebar['group'] = 'MANAGE INFORMATION';
		//$data = 'hello';
		$data['get_url'] = $this->admin_model->admin(NULL,'latest_information');
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/latest_information', $data);
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function faq()
	{
		$sidebar['menuitem'] = 'FAQ';
  		$sidebar['group'] = 'MANAGE INFORMATION';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/faq');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function telephony_directory()
	{
		$sidebar['menuitem'] = 'Telephony Directory';
  		$sidebar['group'] = 'MANAGE INFORMATION';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/telephony_directory');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function previous_ques()
	{
		$sidebar['menuitem'] = 'Previous Question Paper';
  		$sidebar['group'] = 'MANAGE INFORMATION';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/previous_ques');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function chairman_setup()
	{
		$sidebar['menuitem'] = 'Chairman Setup';
  		$sidebar['group'] = 'MANAGE INFORMATION';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/chairman_setup');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function manage_document_type()
	{
		$sidebar['menuitem'] = 'Manage Document Type';
  		$sidebar['group'] = 'MANAGE INFORMATION';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/right_menu');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function manage_document()
	{
		$sidebar['menuitem'] = 'Manage Document';
  		$sidebar['group'] = 'MANAGE INFORMATION';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/right_menu_setup');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	/*public function registration_setup()
	{
		//echo 'hi';die();
		$sidebar['menuitem'] = 'PROGRAM SETUP';
		$sidebar['group'] = 'PROGRA SETUP';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
		$data['all_program_list'] = $this->admin_model->admin(NULL,'get_all_program_list');
		$data['active_program_list'] = $this->admin_model->admin(NULL,'get_active_program_list');
		$data['uploaded_document_list'] = $this->admin_model->admin(NULL,'get_uploaded_document_list');
		$data['online_paid_list'] = $this->admin_model->admin(NULL,'get_online_paid_list');
		//$sel_program_group = $this->session->userdata('sel_program_group');
		//echo $sel_program_group;
		//die();
		$data['challan_verified_list'] = $this->admin_model->admin(NULL,'get_challan_verified_list');
		$data['SCST_list'] = $this->admin_model->admin(NULL,'get_SCST_list');
		$data['OnCounter_list'] = $this->admin_model->admin(NULL,'get_OnCounter_list');
		//$data['inactive_institute_list'] = $this->superadmin_model->superadmin(NULL,'get_inactive_institute_list');
		/*$data['get_users'] = $this->superadmin_model->superadmin(NULL,'get_users');
		$data['get_user_loggedin'] = $this->superadmin_model->superadmin(NULL,'get_user_loggedin');*/
		//$data['total_collection'] = $this->superadmin_model->superadmin(NULL,'total_collection');
		//$this->load->view('template_config/admin_header');
		/*$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('admin/registration_setup',$data);
		$this->load->view('template_config/admin_footer');*/
	
	public function report_sc_st_detail(){
		$program_code = $this->uri->segment(3); // 1stsegment
		$data = array(
            'program_code' => $program_code
        );
        $data['all_sc_st'] = $this->admin_model->admin($data,'get_all_sc_st');
        //echo $program_code;
		//die();
        $this->load->view('admin/report_sc_st_detail',$data);
        //$validate = $this->admin_model->admin($data,'applicants_admit_setup');
	}
	
	public function report_onlinepayment(){
		$program_code = $this->uri->segment(3); // 1stsegment
		$txtTransDate = '';
		$data = array(
            'program_code' => $program_code,
	        'txtTransDate' => $txtTransDate
        );
		$data['allOnlinePayments'] = $this->admin_model->admin($program_code,'get_allOnlinePayments');
        if( $this->input->post())
		{
			$txtTransDate = $this->input->post('txtTransDate');
			$data = array(
	            'program_code' => $program_code,
	            'txtTransDate' => $txtTransDate
	        );
	        $data['allOnlinePayments'] = $this->admin_model->admin($program_code,'get_allOnlinePayments');
	        //$this->load->view('admin/report_onlinepayment',$data);
		}
		//print_r($data);
		$this->load->view('admin/report_onlinepayment',$data);
        //echo $program_code;
		//die();
        
        //$validate = $this->admin_model->admin($data,'applicants_admit_setup');
	}
	
	public function excel_onlinepayment(){
		$program_code = $this->uri->segment(3); // 1stsegment
		$selDate = $this->uri->segment(4); // 2ndsegment
		$data = array(
            'program_code' => $program_code,
            'selDate' => $selDate
        );
        $this->load->library('excel');
		require_once './application/third_party/PHPExcel-1.8/Classes/PHPExcel.php';
		require_once './application/third_party/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'BLACK'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$F=$objPHPExcel->getActiveSheet();

		$F->getColumnDimension('A')->setAutoSize(TRUE);
		$F->getColumnDimension('B')->setAutoSize(TRUE);
		$F->getColumnDimension('C')->setAutoSize(TRUE);
		$F->getColumnDimension('D')->setAutoSize(TRUE);
		$F->getColumnDimension('E')->setAutoSize(TRUE);
		$F->getColumnDimension('F')->setAutoSize(TRUE);
		$F->getColumnDimension('G')->setAutoSize(TRUE);
		$F->getColumnDimension('H')->setAutoSize(TRUE);
		$F->getColumnDimension('I')->setAutoSize(TRUE);
		
		$Line=1;
		$F->setCellValue('A'.$Line,'Slno')
			->setCellValue('B'.$Line,'Trans. Date')
			->setCellValue('C'.$Line,'Appl. No')
			->setCellValue('D'.$Line,'Applicant Name')
			->setCellValue('E'.$Line,'Mobile No.')
			->setCellValue('F'.$Line,'Payment Mode')
			->setCellValue('G'.$Line,'Order. No.')
			->setCellValue('H'.$Line,'Trans. No.')
			->setCellValue('I'.$Line,'Trans. Amount');//write in the sheet
			++$Line;
		$slno = 1;
		$Fval = 'ONLINE';
		$data_excel1 = $this->admin_model->excel_onlinepayment($data);
		//$validate = $this->admin_model->excel1_report_admit_card($data);
		
		foreach ($data_excel1 as $value)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$Line, $slno);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$Line, $value->response_datetime);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$Line, $value->appl_no);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$Line, $value->full_name);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$Line, $value->created_by);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$Line, $Fval);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$Line, $value->order_number);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$Line, $value->transaction_number);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$Line, $value->amount);
			++$Line;
			$slno++;
		}
		
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Applicantlist.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		
	}
	
	public function excel_sc_st_obc(){
		$program_code = $this->uri->segment(3); // 1stsegment
		$data = array(
            'program_code' => $program_code
        );
        $this->load->library('excel');
		require_once './application/third_party/PHPExcel-1.8/Classes/PHPExcel.php';
		require_once './application/third_party/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'BLACK'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$F=$objPHPExcel->getActiveSheet();

		$F->getColumnDimension('A')->setAutoSize(TRUE);
		$F->getColumnDimension('B')->setAutoSize(TRUE);
		$F->getColumnDimension('C')->setAutoSize(TRUE);
		$F->getColumnDimension('D')->setAutoSize(TRUE);
		$F->getColumnDimension('E')->setAutoSize(TRUE);
		$F->getColumnDimension('F')->setAutoSize(TRUE);
		
		$Line=1;
		$F->setCellValue('A'.$Line,'Slno')
			->setCellValue('B'.$Line,'Appl. No')
			->setCellValue('C'.$Line,'Applicant Name')
			->setCellValue('D'.$Line,'Mobile No.')
			->setCellValue('E'.$Line,'Payment Mode')
			->setCellValue('F'.$Line,'Trans. Amount');
			++$Line;
		$slno = 1;
		
		$data_excel1 = $this->admin_model->excel_sc_st($data);
		//$validate = $this->admin_model->excel1_report_admit_card($data);
		
		foreach ($data_excel1 as $value)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$Line, $slno);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$Line, $value->appl_no);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$Line, $value->full_name);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$Line, $value->created_by);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$Line, $value->money_deposit_mode);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$Line, $value->amount);
			++$Line;
			$slno++;
		}
		
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Applicantlist.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		
	}
	
	public function communication_setup()
	{
		$sidebar['menuitem'] = 'Communication';
  		$sidebar['group'] = 'RECRUITMENT SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/communication_setup');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function send_email()
	{
		
		//$data = 'hello';
		$data['send_email'] = $this->admin_model->admin(NULL,'send_email');
  		/*$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/communication_setup');
  		$this->load->view('template_config/admin_footer');*/
		
	}
	public function admitcard_applicant(){
		$program_code = $this->uri->segment(3); // 1stsegment
		//$exam_centre = $this->uri->segment(4); // 2ndsegment
		$date = $this->uri->segment(4); // 3rdsegment
		$round_data = $this->uri->segment(5); // 3rdsegment
        $program_code_new = str_replace('%60','/',$program_code);
		//echo $program_code_new;die();
		$data = array(
            'program_code' => $program_code_new,/*
            'exam_centre' => $exam_centre,*/
            'applied_date' => $date,
            'round_data' => $round_data,
        );
        $this->load->view('admin/admitcard_applicant',$data);
        //$validate = $this->admin_model->admin($data,'applicants_admit_setup');
	}
	public function admitcard_assigned_applicant(){
		$program_code = $this->uri->segment(3); // 1stsegment
		$exam_centre_code = $this->uri->segment(4); // 2ndsegment
		$exam_vanue = $this->uri->segment(5); // 3rdsegment
		$round_data = $this->uri->segment(6); // 3rdsegment
		$program_code_new = str_replace('%60','/',$program_code);
		
		$data = array(
            'program_code' => $program_code_new,
            'assigned_exam_center_code' => $exam_centre_code,
            'round_data' => $round_data,
            'exam_vanue' => $exam_vanue
        );
        $this->load->view('admin/admitcard_assigned_applicant',$data);
        //$validate = $this->admin_model->admin($data,'applicants_admit_setup');
	}
	public function admitcard_published_applicants(){
		$program_code = $this->uri->segment(3); // 1stsegment
		$exam_centre_code = $this->uri->segment(4); // 2ndsegment
		$exam_vanue = $this->uri->segment(5); // 3rdsegment
		$round_data = $this->uri->segment(6); // 4thsegment
		$program_code_new = str_replace('%60','/',$program_code);
		
		$data = array(
            'program_code' => $program_code_new,
             'assigned_exam_center_code' => $exam_centre_code,
            'round_data' => $round_data,
            'exam_vanue' => $exam_vanue
        );
        $this->load->view('admin/admitcard_published_applicants',$data);
        //$validate = $this->admin_model->admin($data,'applicants_admit_setup');
	}
	public function upload_scanned_copy(){
		$sidebar['menuitem'] = 'UPLOAD SCANNED COPY';
  		$sidebar['group'] = 'UPLOAD SCANNED COPY';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/upload_scanned_copy');
  		/*$this->load->view('template_config/admin_footer');*/
	}
	public function upload_results(){
		$sidebar['menuitem'] = 'RESULT UPLOAD';
  		$sidebar['group'] = 'RESULT UPLOAD';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/upload_results');
  		/*$this->load->view('template_config/admin_footer');*/
	}
	public function upload_excel_result()
	{
		$program_code = $this->uri->segment(3); // 1stsegment
		$round_data = $this->uri->segment(4);
		$msg = $this->uri->segment(5);
		if($msg != '')
		{
			$data = array(
	            'program_code' => $program_code,
	            'round_data' => $round_data,
	            'msg' => "There is no any scanned files to sync the result."
	        );
		}
		else
		{
			$data = array(
	            'program_code' => $program_code,
	            'round_data' => $round_data
	        );
		}
		
		$this->load->view('admin/upload_excel_result',$data);
	}
	public function upload_result()
	{
		$program_code = $this->uri->segment(3); // 1stsegment
		$round_data = $this->uri->segment(4); // 2ndsegment
		$data = array(
            'program_code' => $program_code,
            'round_data' => $round_data
        );
		$this->load->library('excel');
		require_once './application/third_party/PHPExcel-1.8/Classes/PHPExcel.php';
		require_once './application/third_party/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true)->setSize(14)->getColor()->applyFromArray(array("rgb" =>'BLACK'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$F=$objPHPExcel->getActiveSheet();

		$F->getColumnDimension('A')->setAutoSize(TRUE);
		$F->getColumnDimension('B')->setAutoSize(TRUE);
		$F->getColumnDimension('C')->setAutoSize(TRUE);
		$F->getColumnDimension('D')->setAutoSize(TRUE);
		$F->getColumnDimension('E')->setAutoSize(TRUE);
		//$F->getColumnDimension('F')->setAutoSize(TRUE);
		
		$Line=1;
		$F->setCellValue('A'.$Line,'Name')
			->setCellValue('B'.$Line,'Roll No')
			->setCellValue('C'.$Line,'Application No')
			->setCellValue('D'.$Line,'Mark')
			/*->setCellValue('E'.$Line,'Result')*/
			->setCellValue('E'.$Line,'Round No');
			++$Line;
		$slno = 1;
		
		$data_excel1 = $this->admin_model->excel_upload_result($data);
		$objPHPExcel->setActiveSheetIndex(0);

		foreach ($data_excel1 as $value)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$Line, $value->full_name);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$Line, $value->omr_no);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$Line, $value->appl_no);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$Line, '');
			/*$objPHPExcel->getActiveSheet()->setCellValue('E'.$Line, '');*/
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$Line, $value->round_no);


			/*$configs = "Selected, Not Selected";

			$objValidation = $objPHPExcel->getActiveSheet()->getCell('E'.$Line)->getDataValidation();
			$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
			$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
			$objValidation->setAllowBlank(false);
			$objValidation->setShowInputMessage(true);
			$objValidation->setShowErrorMessage(true);
			$objValidation->setShowDropDown(true);
			$objValidation->setErrorTitle('Input error');
			$objValidation->setError('Value is not in list.');
			$objValidation->setPromptTitle('Pick from list');
			$objValidation->setPrompt('Please pick a value from the drop-down list.');
			$objValidation->setFormula1('"'.$configs.'"');*/
			
			++$Line;
			$slno++;
		}
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Applicantlist.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}
	
	public function save_applicantResult_bk() {
		
		$file = "file:///D:/scanned_files/applicant_scanned_copy.xlsx";
		$path = ROOT_UPLOAD_IMPORT_PATH.'/';
		$file = strip_tags(trim($file));
        $this->load->library('excel');
        $data = '';
        $path = $path.'applicant_scanned_copy'.rand().'.xlsx';
        /*echo file_exists($file);
        die();*/
       	if(file_exists($file))
       	{
			$program_code = $this->uri->segment(3);
			$round_data = $this->uri->segment(4);
	        copy($file,$path);
	        $inputFileName = $path;
	        try {
	            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
	            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
	            $objPHPExcel = $objReader->load($inputFileName);
	        } catch (Exception $e) {
	            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
	                    . '": ' . $e->getMessage());
	        }
	        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
	        
	        $arrayCount = count($allDataInSheet);
	        $flag = 0;
	        $createArray = array('h1','scanno','h2', 'barcode','series','lang','Mark','answer');
	        $makeArray = array('h1' => 'h1', 'scanno' => 'scanno', 'h2' => 'h2','barcode' => 'barcode','series' => 'series','lang' => 'lang', 
	        					'Mark' => 'Mark','answer' => 'answer');
	        $SheetDataKey = array();
	        
	        foreach ($allDataInSheet as $dataInSheet) {
	            foreach ($dataInSheet as $key => $value) {
	            	//echo $value;
	            	$value = preg_replace('/\s+/', '', $value);
	            	//print_r($value);
	            	//print_r($createArray);
	                if (in_array($value, $createArray)) {
	                	//print_r($createArray);
	                    $value = preg_replace('/\s+/', '', $value);
	                    $SheetDataKey[$value] = $key;
	                } else {
	                    
	                }
	            }
	        }
	        $data = array_diff_key($makeArray, $SheetDataKey);
	      	$matches = 0;
	      	
	        if (empty($data)) {
	            $flag = 1;
	        }
	        if ($flag == 1) {
	            for ($i = 2; $i <= $arrayCount; $i++) {
	                $addresses = array();
	                $h1 = $SheetDataKey['h1'];
	                $h2 = $SheetDataKey['h2'];
	                $scanno = $SheetDataKey['scanno'];
	                $barcode = $SheetDataKey['barcode'];
	                $series = $SheetDataKey['series'];
	                $lang = $SheetDataKey['lang'];
	                $answer = $SheetDataKey['answer'];
	               
	                $Mark = $SheetDataKey['Mark'];
	                //$Result = $SheetDataKey['Result'];
	                $round_data = $round_data;
	                $h1 = filter_var(trim($allDataInSheet[$i][$h1]), FILTER_SANITIZE_STRING);
	                $h2 = filter_var(trim($allDataInSheet[$i][$h2]), FILTER_SANITIZE_STRING);
	                $scanno = filter_var(trim($allDataInSheet[$i][$scanno]), FILTER_SANITIZE_STRING);
	                $barcode = filter_var(trim($allDataInSheet[$i][$barcode]), FILTER_SANITIZE_STRING);
	                $series = filter_var(trim($allDataInSheet[$i][$series]), FILTER_SANITIZE_STRING);
	                $lang = filter_var(trim($allDataInSheet[$i][$lang]), FILTER_SANITIZE_STRING);
	                $answer = filter_var(trim($allDataInSheet[$i][$answer]), FILTER_SANITIZE_STRING);
	                $Mark = filter_var(trim($allDataInSheet[$i][$Mark]), FILTER_SANITIZE_STRING);
	                
					
	                $fetchData[] = array('header_1' => $h1, 'header_2' => $h2, 'applicant_id' => $scanno,
	                'barcode' => $barcode,'series' => $series,'lang' => $lang,'answer' => $answer,'total_mark'=>$Mark,'program_code'=>$program_code,'round_data'=>$round_data);
	            }      
	            /*print_r($fetchData);
	            die();*/        
	            $data['employeeInfo'] = $fetchData;
	            $this->admin_model->setBatchImport($fetchData);
	            $this->admin_model->importData();
	        } else if($flag == 0){
	            echo "Please import correct file";
	        }
	        $this->load->view('admin/upload_result_display', $data);
		}
		else
		{
			$program_code = $this->uri->segment(3);
			$round_data = $this->uri->segment(4);
			$data = array(
	            'program_code' => $program_code,
	            'round_data' => $round_data
	        );
			$this->load->view('admin/upload_result_fail', $data);
			//die();
		}
        //$path = ROOT_UPLOAD_IMPORT_PATH.'/';

       
        
    }
    public function save_applicantResult() {
    	

# Declare Files
    $local_file = "1.xlsx";
    $remote_file = "staging2/recruitment-apssb/upload/2.xlsx";

    # FTP
    $server = "sftp://eapp.stlindia.com/".$remote_file;

    # FTP Credentials
    $ftp_user = "staging2";
    $ftp_password = "OuRte@m@#2016";

    # Upload File
    $ch = curl_init();
    $ftp_file = fopen($local_file, 'r','D:/');
    curl_setopt($ch, CURLOPT_URL, $server);
    curl_setopt($ch, CURLOPT_USERPWD, $ftp_user.":".$ftp_password);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_UPLOAD, 1);
    curl_setopt($ch, CURLOPT_INFILE, $ftp_file);
    curl_setopt($ch, CURLOPT_INFILESIZE, filesize($local_file));
   echo  $result = curl_exec($ch);
    	
    	
    	
    	
    	
    	
    	
    	
    	
		
		//$file = "file:///D:/scanned_files/applicant_scanned_copy.xlsx";
		echo $file = file_get_contents('D:\1.xlsx');
		die();
		$fp = fopen($file, 'r');
		
		$path = ROOT_UPLOAD_IMPORT_PATH.'/';
		$file = strip_tags(trim($file));
        $this->load->library('excel');
        $data = '';
        $path = $path.'applicant_scanned_copy'.rand().'.xlsx';
        /*echo file_exists($file);
        die();*/
       	if(file_exists($file))
       	{
			$program_code = $this->uri->segment(3);
			$round_data = $this->uri->segment(4);
	        copy($file,$path);
	        $inputFileName = $path;
	        try {
	            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
	            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
	            $objPHPExcel = $objReader->load($inputFileName);
	        } catch (Exception $e) {
	            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
	                    . '": ' . $e->getMessage());
	        }
	        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
	        
	        $arrayCount = count($allDataInSheet);
	        $flag = 0;
	        $createArray = array('h1','scanno','h2', 'barcode','series','lang','Mark','answer');
	        $makeArray = array('h1' => 'h1', 'scanno' => 'scanno', 'h2' => 'h2','barcode' => 'barcode','series' => 'series','lang' => 'lang', 
	        					'Mark' => 'Mark','answer' => 'answer');
	        $SheetDataKey = array();
	        
	        foreach ($allDataInSheet as $dataInSheet) {
	            foreach ($dataInSheet as $key => $value) {
	            	//echo $value;
	            	$value = preg_replace('/\s+/', '', $value);
	            	//print_r($value);
	            	//print_r($createArray);
	                if (in_array($value, $createArray)) {
	                	//print_r($createArray);
	                    $value = preg_replace('/\s+/', '', $value);
	                    $SheetDataKey[$value] = $key;
	                } else {
	                    
	                }
	            }
	        }
	        $data = array_diff_key($makeArray, $SheetDataKey);
	      	$matches = 0;
	      	
	        if (empty($data)) {
	            $flag = 1;
	        }
	        if ($flag == 1) {
	            for ($i = 2; $i <= $arrayCount; $i++) {
	                $addresses = array();
	                $h1 = $SheetDataKey['h1'];
	                $h2 = $SheetDataKey['h2'];
	                $scanno = $SheetDataKey['scanno'];
	                $barcode = $SheetDataKey['barcode'];
	                $series = $SheetDataKey['series'];
	                $lang = $SheetDataKey['lang'];
	                $answer = $SheetDataKey['answer'];
	               
	                $Mark = $SheetDataKey['Mark'];
	                //$Result = $SheetDataKey['Result'];
	                $round_data = $round_data;
	                $h1 = filter_var(trim($allDataInSheet[$i][$h1]), FILTER_SANITIZE_STRING);
	                $h2 = filter_var(trim($allDataInSheet[$i][$h2]), FILTER_SANITIZE_STRING);
	                $scanno = filter_var(trim($allDataInSheet[$i][$scanno]), FILTER_SANITIZE_STRING);
	                $barcode = filter_var(trim($allDataInSheet[$i][$barcode]), FILTER_SANITIZE_STRING);
	                $series = filter_var(trim($allDataInSheet[$i][$series]), FILTER_SANITIZE_STRING);
	                $lang = filter_var(trim($allDataInSheet[$i][$lang]), FILTER_SANITIZE_STRING);
	                $answer = filter_var(trim($allDataInSheet[$i][$answer]), FILTER_SANITIZE_STRING);
	                $Mark = filter_var(trim($allDataInSheet[$i][$Mark]), FILTER_SANITIZE_STRING);
	                
					
	                $fetchData[] = array('header_1' => $h1, 'header_2' => $h2, 'applicant_id' => $scanno,
	                'barcode' => $barcode,'series' => $series,'lang' => $lang,'answer' => $answer,'total_mark'=>$Mark,'program_code'=>$program_code,'round_data'=>$round_data);
	            }      
	            /*print_r($fetchData);
	            die();*/        
	            $data['employeeInfo'] = $fetchData;
	            $this->admin_model->setBatchImport($fetchData);
	            $this->admin_model->importData();
	        } else if($flag == 0){
	            echo "Please import correct file";
	        }
	        $this->load->view('admin/upload_result_display', $data);
		}
		else
		{
			$program_code = $this->uri->segment(3);
			$round_data = $this->uri->segment(4);
			$data = array(
	            'program_code' => $program_code,
	            'round_data' => $round_data
	        );
			$this->load->view('admin/upload_result_fail', $data);
			//die();
		}
        //$path = ROOT_UPLOAD_IMPORT_PATH.'/';

       
        
    }
	//For OMR Data
	public function generate_report(){
		$sidebar['menuitem'] = 'Generate Report';
  		$sidebar['group'] = 'Generate Report';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/generate_report');
	}
	public function consolidated_report()
	{
		$program_code = $this->uri->segment(3); // 1stsegment
		$data = array(
            'program' => $program_code
        );
        $this->load->library('excel');
		require_once './application/third_party/PHPExcel-1.8/Classes/PHPExcel.php';
		require_once './application/third_party/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		
		$objPHPExcel->getActiveSheet()->setTitle('Consolidated Report');//EXCEL SHEET NAME

		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'#000000'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'#000000'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR second ROW
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A2:E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$F=$objPHPExcel->getActiveSheet();
		$excel_row = 1;
		$F->setCellValue('A'.$excel_row,'Consolidated Report');
		$F->mergeCells('A1:E1');
		$excel_row++;
		$F->getColumnDimension('B')->setAutoSize(TRUE);
		$F->getColumnDimension('C')->setAutoSize(TRUE);
		$F->getColumnDimension('D')->setAutoSize(TRUE);
		$F->getColumnDimension('E')->setAutoSize(TRUE);
		
		$F->setCellValue('A'.$excel_row,'Sl.No')
			->setCellValue('B'.$excel_row,'Name')
			->setCellValue('C'.$excel_row,'Roll No')
			->setCellValue('D'.$excel_row,'Marks')
			->setCellValue('E'.$excel_row,'Rank');
		
		$objPHPExcel->getActiveSheet()->getStyle('A'.$excel_row.':E'.$excel_row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '5B5554'))))->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'ffffff'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW

		$excel_row++;
		$slno = 1;
		$data_excel1 = $this->admin_model->excel_consolidated_report($data);
		foreach($data_excel1 as $Trs)
		{
			$F->setCellValue('A'.$excel_row,$slno)
				->setCellValue('B'.$excel_row,$Trs->full_name)
				->setCellValue('C'.$excel_row,$Trs->roll_no)
				->setCellValue('D'.$excel_row,$Trs->total_marks)
				->setCellValue('E'.$excel_row,$Trs->rank);
			
		   	$slno++;
			$excel_row++;
		}
		$excel_row++;
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Consolidated_Report.xls"');//EXCEL FILE NAME
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		
	}
	public function subjectWise_report()
	{
		$program_code = $this->uri->segment(3); // 1stsegment
		$data = array(
            'program' => $program_code
        );
        $this->load->library('excel');
		require_once './application/third_party/PHPExcel-1.8/Classes/PHPExcel.php';
		require_once './application/third_party/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		
		$objPHPExcel->getActiveSheet()->setTitle('Subject Wise Report');//EXCEL SHEET NAME

		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'#000000'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'#000000'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR second ROW
		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$F=$objPHPExcel->getActiveSheet();
		$excel_row = 1;
		$F->setCellValue('A'.$excel_row,'Subject Wise Report');
		$F->mergeCells('A1:R1');
		$excel_row++;
		$F->getColumnDimension('B')->setAutoSize(TRUE);
		$F->getColumnDimension('C')->setAutoSize(TRUE);
		$F->getColumnDimension('D')->setAutoSize(TRUE);
		$F->getColumnDimension('E')->setAutoSize(TRUE);
		$data_excel1 = $this->admin_model->excel_subject_wise_header_report($data);
		$col = 0;
		$F->setCellValueByColumnAndRow($col, $excel_row,'Sl.No');
		$col++;
		$F->setCellValueByColumnAndRow($col, $excel_row,'Name');
		$col++;
		$F->setCellValueByColumnAndRow($col, $excel_row,'Roll No');
		$col++;
		
		foreach($data_excel1 as $row)
		{
			$subject_names = $row->subject_names;
			$subjects = explode(':',$subject_names);
			foreach($subjects as $row1)
			{
				$F->setCellValueByColumnAndRow($col,$excel_row,$row1);
				$col++;
			}
			
		}
		$F->setCellValueByColumnAndRow($col, $excel_row,'Total');
		$col++;
		$F->setCellValueByColumnAndRow($col, $excel_row,'Rank');
		
		$excel_row++;
		$slno = 1;
		$col = 0;
		$data_excel2 = $this->admin_model->excel_subject_wise_report($data);
		foreach($data_excel2 as $row)
		{
			$F->setCellValueByColumnAndRow($col, $excel_row,$slno);
			$col++;
			$F->setCellValueByColumnAndRow($col, $excel_row,$row->full_name);
			$col++;
			$F->setCellValueByColumnAndRow($col, $excel_row,$row->roll_no);
			$col++;
			$subject_arr = explode(':',$row->subject_total_marks);
			foreach($subject_arr as $row1)
			{
				$F->setCellValueByColumnAndRow($col,$excel_row,$row1);
				$col++;
			}
			$F->setCellValueByColumnAndRow($col, $excel_row,$row->total_marks);
			$col++;
			$F->setCellValueByColumnAndRow($col, $excel_row,$row->rank);
			$col++;
			
		   	$slno++;
			$excel_row++;
			$col = 0;
		}
		$excel_row++;
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Subject_Wise_Report.xls"');//EXCEL FILE NAME
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		
	}
	public function consolidatedCount_report()
	{
		$program_code = $this->uri->segment(3); // 1stsegment
		$data = array(
            'program' => $program_code
        );
        $this->load->library('excel');
		require_once './application/third_party/PHPExcel-1.8/Classes/PHPExcel.php';
		require_once './application/third_party/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		
		$objPHPExcel->getActiveSheet()->setTitle('Consolidated With Count Report');//EXCEL SHEET NAME

		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'#000000'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'#000000'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR second ROW
		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A2:H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$F=$objPHPExcel->getActiveSheet();
		$excel_row = 1;
		$F->setCellValue('A'.$excel_row,'Consolidated With Count Report');
		$F->mergeCells('A1:H1');
		$excel_row++;
		$F->getColumnDimension('B')->setAutoSize(TRUE);
		$F->getColumnDimension('C')->setAutoSize(TRUE);
		$F->getColumnDimension('D')->setAutoSize(TRUE);
		$F->getColumnDimension('E')->setAutoSize(TRUE);
		$F->getColumnDimension('F')->setAutoSize(TRUE);
		$F->getColumnDimension('G')->setAutoSize(TRUE);
		$F->getColumnDimension('H')->setAutoSize(TRUE);
		$next_line = $excel_row+1;
		
		$F->setCellValue('A'.$excel_row,'Sl.No')
			->setCellValue('B'.$excel_row,'Name')
			->setCellValue('C'.$excel_row,'Roll No')
			->setCellValue('D'.$excel_row,'Total')
			->setCellValue('D'.$next_line,'Right Count')
			->setCellValue('E'.$next_line,'Wrong Count')
			->setCellValue('F'.$next_line,'Blank Count')
			->setCellValue('G'.$next_line,'Marks')
			->setCellValue('H'.$excel_row,'Rank');
		
		$F->mergeCells('D'.$excel_row.':G'.$excel_row);
		$F->mergeCells('A'.$excel_row.':A'.$next_line);
		$F->mergeCells('B'.$excel_row.':B'.$next_line);
		$F->mergeCells('C'.$excel_row.':C'.$next_line);
		$F->mergeCells('H'.$excel_row.':H'.$next_line);
		
		$objPHPExcel->getActiveSheet()->getStyle('A'.$excel_row.':H'.$next_line)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '5B5554'))))->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'ffffff'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW

		$excel_row++;
		$excel_row++;
		$slno = 1;
		$data_excel1 = $this->admin_model->excel_consolidated_count_report($data);
		foreach($data_excel1 as $Trs)
		{
			$F->setCellValue('A'.$excel_row,$slno)
				->setCellValue('B'.$excel_row,$Trs->full_name)
				->setCellValue('C'.$excel_row,$Trs->roll_no)
				->setCellValue('D'.$excel_row,$Trs->right_count)
				->setCellValue('E'.$excel_row,$Trs->wrong_count)
				->setCellValue('F'.$excel_row,$Trs->blank_count)
				->setCellValue('G'.$excel_row,$Trs->total_marks)
				->setCellValue('H'.$excel_row,$Trs->rank);
			
		   	$slno++;
			$excel_row++;
		}
		$excel_row++;
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Consolidated_With_Count_Report.xls"');//EXCEL FILE NAME
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		
	}
	public function subjectWiseCount_report()
	{
		$program_code = $this->uri->segment(3); // 1stsegment
		$data = array(
            'program' => $program_code
        );
        $this->load->library('excel');
		require_once './application/third_party/PHPExcel-1.8/Classes/PHPExcel.php';
		require_once './application/third_party/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		
		$objPHPExcel->getActiveSheet()->setTitle('Subject Wise With Count Report');//EXCEL SHEET NAME

		$objPHPExcel->getActiveSheet()->getStyle('A1:R1')->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'#000000'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$objPHPExcel->getActiveSheet()->getStyle('A2:R2')->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'#000000'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR second ROW
		$objPHPExcel->getActiveSheet()->getStyle('A3:R3')->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'#000000'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR second ROW
		$objPHPExcel->getActiveSheet()->getStyle('A1:R1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A2:R2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A3:R3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$F=$objPHPExcel->getActiveSheet();
		$excel_row = 1;
		$F->setCellValue('A'.$excel_row,'Subject Wise With Count Report');
		$F->mergeCells('A1:R1');
		$excel_row++;
		$F->getColumnDimension('B')->setAutoSize(TRUE);
		$F->getColumnDimension('C')->setAutoSize(TRUE);
		$F->getColumnDimension('D')->setAutoSize(TRUE);
		$F->getColumnDimension('E')->setAutoSize(TRUE);
		$data_excel1 = $this->admin_model->excel_subject_wise_header_report($data);
		$col = 0;
		$F->setCellValueByColumnAndRow($col, $excel_row,'Sl.No');
		$col++;
		$F->setCellValueByColumnAndRow($col, $excel_row,'Name');
		$col++;
		$F->setCellValueByColumnAndRow($col, $excel_row,'Roll No');
		$col++;
		$next_line = $excel_row+1;
		foreach($data_excel1 as $row)
		{
			$subject_names = $row->subject_names;
			$subjects = explode(':',$subject_names);
			foreach($subjects as $row1)
			{
				$F->setCellValueByColumnAndRow($col,$excel_row,$row1);
				$F->mergeCellsByColumnAndRow($col,$excel_row,$col+3,$excel_row);
				$F->setCellValueByColumnAndRow($col,$next_line,'R');
				$col++;
				$F->setCellValueByColumnAndRow($col,$next_line,'W');
				$col++;
				$F->setCellValueByColumnAndRow($col,$next_line,'B');
				$col++;
				$F->setCellValueByColumnAndRow($col,$next_line,'Marks');
				$col++;
			}
			
		}
		$F->setCellValueByColumnAndRow($col, $excel_row,'Total');
		$F->mergeCellsByColumnAndRow($col,$excel_row,$col,$next_line);
		$col++;
		$F->setCellValueByColumnAndRow($col, $excel_row,'Rank');
		$F->mergeCellsByColumnAndRow($col,$excel_row,$col,$next_line);
		$F->mergeCells('A'.$excel_row.':A'.$next_line);
		$F->mergeCells('B'.$excel_row.':B'.$next_line);
		$F->mergeCells('C'.$excel_row.':C'.$next_line);
		
		$excel_row++;
		$excel_row++;
		$slno = 1;
		$col = 0;
		$data_excel2 = $this->admin_model->excel_subject_wise_count_report($data);
		foreach($data_excel2 as $row)
		{
			$F->setCellValueByColumnAndRow($col, $excel_row,$slno);
			$col++;
			$F->setCellValueByColumnAndRow($col, $excel_row,$row->full_name);
			$col++;
			$F->setCellValueByColumnAndRow($col, $excel_row,$row->roll_no);
			$col++;
			$subject_arr = explode(':',$row->subject_total_marks);
			$subject_right_arr = explode(':',$row->subject_right_count);
			$subject_wrong_arr = explode(':',$row->subject_wrong_count);
			$subject_blank_arr = explode(':',$row->subject_blank_count);
			$subject_blank_arr = explode(':',$row->subject_total_marks);
			for($i = 0;$i < sizeof($subject_arr);$i++)
			{
				$F->setCellValueByColumnAndRow($col,$excel_row,$subject_right_arr[$i]);
				$col++;
				$F->setCellValueByColumnAndRow($col,$excel_row,$subject_wrong_arr[$i]);
				$col++;
				$F->setCellValueByColumnAndRow($col,$excel_row,$subject_blank_arr[$i]);
				$col++;
				$F->setCellValueByColumnAndRow($col,$excel_row,$subject_arr[$i]);
				$col++;
			}
			$F->setCellValueByColumnAndRow($col, $excel_row,$row->total_marks);
			$col++;
			$F->setCellValueByColumnAndRow($col, $excel_row,$row->rank);
			$col++;
			
		   	$slno++;
			$excel_row++;
			$col = 0;
		}
		$excel_row++;
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Subject_Wise_Count_Report.xls"');//EXCEL FILE NAME
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		
	}
	public function dms(){
		$sidebar['menuitem'] = 'DOCUMENT MANAGEMENT';
  		$sidebar['group'] = 'DOCUMENT MANAGEMENT';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/dms');
  		/*$this->load->view('template_config/admin_footer');*/
	}
	public function program_declaration_data(){
		$sidebar['menuitem'] = 'Program Declaration Data';
  		$sidebar['group'] = 'Program Declaration Data';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/program_declaration_data');
  		/*$this->load->view('template_config/admin_footer');*/
	}
	public function program_general_info(){
		$sidebar['menuitem'] = 'Program General Information';
  		$sidebar['group'] = 'Program General Information';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/program_general_info');
  		/*$this->load->view('template_config/admin_footer');*/
	}
	public function user_program_mapping(){
		$sidebar['menuitem'] = 'User Program Mapping';
  		$sidebar['group'] = 'User Program Mapping';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/user_program_mapping');
  		/*$this->load->view('template_config/admin_footer');*/
	}
	public function manageadvertisement()
	{
		$sidebar['menuitem'] = 'Advertisement';
  		$sidebar['group'] = 'RECRUITMENT SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/manageadvertisement');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function generic_setup1()
	{
		//$this->load->view('template_config/admin_header');
		//echo 'hi' ; die();
		$sidebar['menuitem'] = 'Recruitment Drive Setup';
		$sidebar['group'] = 'RECRUITMENT SETUP';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
		$data['program_group'] = $this->superadmin_model->superadmin('', 'program_group_data');
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('admin/generic_setup1',$data);
		/*$this->load->view('template_config/admin_footer');*/
	}
	public function program()
	{
		$sidebar['menuitem'] = 'Manage Post';
  		$sidebar['group'] = 'RECRUITMENT SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/program');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function generic_setup2()
	{
		
		//echo 'hi' ; die();
		$sidebar['menuitem'] = 'Generic Setup';
		$sidebar['group'] = 'RECRUITMENT SETUP';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('admin/generic_setup2');
		/*$this->load->view('template_config/admin_footer');*/
	}
	public function post_date_setup()
	{
		$sidebar['menuitem'] = 'Manage Post';
  		$sidebar['group'] = 'RECRUITMENT SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/post_date_setup');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function course()
	{
		$sidebar['menuitem'] = 'Manage Course';
  		$sidebar['group'] = 'RECRUITMENT SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/course');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function program_cat_eligibility()
	{
		$sidebar['menuitem'] = 'Category Wise Age Validation';
  		$sidebar['group'] = 'RECRUITMENT SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/program_cat_eligibility');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function program_exp_validation()
	{
		$sidebar['menuitem'] = 'Experience Validation';
  		$sidebar['group'] = 'RECRUITMENT SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/program_exp_validation');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function program_menu_setup()
	{
		$sidebar['menuitem'] = 'Post Menu';
  		$sidebar['group'] = 'RECRUITMENT SETUP';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/program_menu_setup');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function registration_field()
	{
		$sidebar['menuitem'] = 'Registration Field';
  		$sidebar['group'] = 'RECRUITMENT SETUP';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/registration_field');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function applicant_result_details()
	{
		$sidebar['menuitem'] = 'Applicant Result Details';
  		$sidebar['group'] = 'Applicant Result Details';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/applicant_result_details');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	

	public function profile()
	{
		$sidebar['menuitem'] = 'Configure Post';
  		$sidebar['group'] = 'RECRUITMENT SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/profile');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	
	public function category_wise_cutoff()
	{
		$sidebar['menuitem'] = 'Category Wise Cutoff';
  		$sidebar['group'] = 'RECRUITMENT SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/category_wise_cutoff');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function program_course_mapping()
	{
		$sidebar['menuitem'] = 'Post Examination Mapping';
  		$sidebar['group'] = 'ADMIT CARD';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/program_course_mapping');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function fee_setup()
	{
		$sidebar['menuitem'] = 'Fee';
  		$sidebar['group'] = 'RECRUITMENT SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/fee_setup');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function action_master()
	{
		$sidebar['menuitem'] = 'Action Master';
  		$sidebar['group'] = 'RECRUITMENT SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/action_master');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function manage_captcha()
	{
		$sidebar['menuitem'] = 'Manage Captcha';
  		$sidebar['group'] = 'RECRUITMENT SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/manage_captcha');
  		//$this->load->view('template_config/admin_footer'); 
		
	}
	public function invigilator_setup()
	{
		$sidebar['menuitem'] = 'Invigilator Setup';
  		$sidebar['group'] = 'RECRUITMENT SETUP';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/invigilator_setup');
		
	}
	public function manageApplication()
	{
		$sidebar['menuitem'] = 'MANAGE APPLICATION';
  		$sidebar['group'] = 'MANAGE APPLICATION';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/manageApplication');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function sms_send()
	{
		$sidebar['menuitem'] = 'SMS SEND';
  		$sidebar['group'] = 'SMS SEND';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
		$this->load->view('template_config/sidebar',$sidebar);
		if(isset($_POST['btnsendall'])){
			$data['send_sms_status'] = $this->admin_model->admin($_POST,'SEND_SMS_ALL');
			//print_r($data);
			$this->load->view('admin/sms_view',$data);
		}else if(isset($_POST['btnsubmit'])){
			$data['send_sms_status'] = $this->admin_model->admin($_POST,'SEND_SMS_MULTIPE');
			$this->load->view('admin/sms_view',$data);
		}else{
			
	  		$this->load->view('admin/send_sms');
	  		
		}
  		//$this->load->view('template_config/admin_footer');
		
	}
	public function manageRegistration()
	{
		$sidebar['menuitem'] = 'MANAGE REGISTRATION';
  		$sidebar['group'] = 'MANAGE REGISTRATION';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/manageRegistration');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function document_setup()
	{
		$sidebar['menuitem'] = 'Document';
  		$sidebar['group'] = 'RECRUITMENT SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/document_setup');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function payment_details()
	{
		$sidebar['menuitem'] = 'PAYMENT DETAILS';
  		$sidebar['group'] = 'PAYMENT DETAILS';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/payment_details');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function scrutiny_verification()
	{
		$sidebar['menuitem'] = 'Scrutiny';
  		$sidebar['group'] = 'VERIFICATION';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/scrutiny_verification');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function marit_list()
	{
		$sidebar['menuitem'] = 'MERIT LIST';
  		$sidebar['group'] = 'MERIT LIST';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/marit_list');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function merit_list()
	{
		$sidebar['menuitem'] = 'Download';
  		$sidebar['group'] = 'APPOINTMENT LETTER';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/merit_list');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function call_list()
	{
		$sidebar['menuitem'] = 'Download';
  		$sidebar['group'] = 'CALL LIST';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/call_list');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function sbi_verification()
	{
		$sidebar['menuitem'] = 'Challan';
  		$sidebar['group'] = 'VERIFICATION';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/sbi_verification');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function admitcard_template_setup()
	{
		$sidebar['menuitem'] = 'Exam Type Setup';
  		$sidebar['group'] = 'ADMIT CARD';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/admitcard_template_setup');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function admitcard_generic_setup()
	{
		$sidebar['menuitem'] = 'Generic Setup';
  		$sidebar['group'] = 'ADMIT CARD';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/admitcard_generic_setup');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function admitcard_setup()
	{
		$sidebar['menuitem'] = 'Exam Venue Setup';
  		$sidebar['group'] = 'ADMIT CARD';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/admitcard_setup');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function venue_wise_invigilators()
	{
		$sidebar['menuitem'] = 'Venue Wise Invigilators';
  		$sidebar['group'] = 'ADMIT CARD';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/venue_wise_invigilators');
		
	}
	public function admitcard_assign()
	{
		$sidebar['menuitem'] = 'Exam Venue Mapping';
  		$sidebar['group'] = 'ADMIT CARD';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/admitcard_assign');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function admitcard_review_publish()
	{
		$sidebar['menuitem'] = 'Review & Publish';
  		$sidebar['group'] = 'ADMIT CARD';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/admitcard_review_publish');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function admitcard_report()
	{
		$sidebar['menuitem'] = 'Download Admit Card';
  		$sidebar['group'] = 'ADMIT CARD';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/admitcard_report');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function change_program()
	{
		$sidebar['menuitem'] = 'Registered Program';
  		$sidebar['group'] = 'CHANGE';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/change_program');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function change_registered_mobile()
	{
		$sidebar['menuitem'] = 'Registered Mobile';
  		$sidebar['group'] = 'CHANGE';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/change_registered_mobile');
  		/*$this->load->view('template_config/admin_footer');*/
		
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
		$data['applicant_documents'] = $this->m_pdf_model->template008_pdf($order_id, 'get_applicant_documents');
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
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
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template008_pdf');	
		/*$pdf->Output($applicantNumber.".pdf",'I');*/	
		return true;
    } 
	public function template008()
	{
	
		//$result = $this->index_model->institute();
		$program = $this->session->userdata('admcode');
		$institute = $this->session->userdata('institute_code');
		//$data = $this->uri->uri_to_assoc();
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
				
				echo "2";
				//redirect('error');
	         
			}
			else
			{
				
				$result = $this->superadmin_model->superadmin($institute,'validate_institute');
				
				if( $result['status'] == 1)
				{
					
					$result = $this->superadmin_model->superadmin($program,'validate_program');
					
					if( $result['status'] == 1 )
					{
						//$this->load->view('template_config/header');
						$data['institute_data'] = $this->admin_model->admin($institute,'get_institute_data');
						$data['program_data'] = $this->superadmin_model->superadmin($program,'get_program_detail');
						$data['registration_data'] = $this->superadmin_model->superadmin($program,'get_registration_data');
						$data['application_data'] = $this->superadmin_model->superadmin($program,'get_application_data');
						$data['applicant_data'] = $this->superadmin_model->superadmin($program,'get_applicant_data');
						$data['present_communication_data'] = $this->superadmin_model->superadmin($program,'get_present_communication_data');
						$data['permanent_communication_data'] = $this->superadmin_model->superadmin($program,'get_permanent_communication_data');
						$data['father_data'] = $this->superadmin_model->superadmin($program,'get_father_data');
						$data['mother_data'] = $this->superadmin_model->superadmin($program,'get_mother_data');
						$data['guardian_data'] = $this->superadmin_model->superadmin($program,'get_guardian_data');
						$data['academic_qual_data'] = $this->superadmin_model->superadmin($program,'get_academic_qual_data');
						$data['allNationalities'] = $this->superadmin_model->superadmin($program,'get_nationality_data');
						$data['allCategories'] = $this->superadmin_model->superadmin($program,'get_category_data');
						$data['allReligions'] = $this->superadmin_model->superadmin($program,'get_religion_data');
						$data['allDistricts'] = $this->superadmin_model->superadmin($program,'get_district_data');
						$data['allStates'] = $this->superadmin_model->superadmin($program,'get_state_data');
						$data['documentsReq'] = $this->superadmin_model->superadmin($program,'get_documents_required');
						$data['allQualifications'] = $this->superadmin_model->superadmin($program,'get_qualification_data');
						$data['allHighestQualifications'] = $this->superadmin_model->superadmin($program,'get_highest_qualification');
						//$data['allHonoursSubject'] = $this->superadmin_model->superadmin($program,'get_honours_subject');
						//$data['program_admit_card_setup'] = $this->superadmin_model->superadmin($program,'get_program_admitcard_setup');
						//$data['program_admit_card_detail'] = $this->superadmin_model->superadmin($program,'get_program_admitcard_detail');
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
					                     'field'   => 'txtMiddleName',
					                     'label'   => 'Middle Name',
					                     'rules'   => 'trim|required'
					                  ),
									array(
					                     'field'   => 'txtLastName',
					                     'label'   => 'Middle Name',
					                     'rules'   => 'trim|required'
					                  ),
									array(
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
					                     'field'   => 'radioMigrant',
					                     'label'   => 'Ksahmiri Migrant',
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
					                  ) ,
									array(
					                     'field'   => 'radioHostel',
					                     'label'   => 'Hostel accomodation',
					                     'rules'   => 'trim|required'
					                  ) ,
									array(
					                     'field'   => 'txtPresentDistance',
					                     'label'   => 'Present Distance',
					                     'rules'   => 'trim|required'
					                  ) 
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
								//redirect($this->agent->referrer());
							}
							else
							{
								
								$result = $this->superadmin_model->superadmin($_POST,'add_application_data');
								
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									//echo "hi";
									redirect('admin/apply_3/ins/'.$institute);
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
								$this->load->view('admin/template008',$data);
							}
							else
							{
								redirect('apply/apply_logout');
							}
							
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
				
				$result = $this->superadmin_model->superadmin($institute,'validate_institute');
				
				if( $result['status'] )
				{
					
					$result = $this->superadmin_model->superadmin($program,'validate_program');
					if( $result['status'] )
					{
						$this->load->view('template_config/header');
						$data['institute_data'] = $this->admin_model->admin($institute,'get_institute_data');
						$data['program_data'] = $this->superadmin_model->superadmin($program,'get_program_detail');
						$data['document_data'] = $this->superadmin_model->superadmin($program,'get_document_data');
						$data['appl_status'] = $this->superadmin_model->superadmin($program,'get_appl_status');
						$data['doc_path'] = $this->superadmin_model->superadmin($program,'get_doc_path');
						
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
								$result = $this->superadmin_model->superadmin($_POST,'add_document_data');
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('admin/apply_4/ins/'.$institute);
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
								$this->load->view('admin/apply_3',$data);
							}
							else
							{
								redirect('apply/apply_logout/ins/'.$institute);
							}
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
	public function apply_4()
	{
		$program = $this->session->userdata('admcode');
		
		//$institute = $this->session->userdata('institute_code');
		//$data = $this->uri->uri_to_assoc();
		$institute = $this->session->userdata('institute_code');
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
				$result = $this->superadmin_model->superadmin($institute,'validate_institute');
				if( $result['status'] )
				{
					$result = $this->superadmin_model->superadmin($program,'validate_program');
					if( $result['status'] )
					{
						$this->load->view('template_config/header');
						$data['institute_data'] = $this->admin_model->admin($institute,'get_institute_data');
						$data['program_data'] = $this->superadmin_model->superadmin($program,'get_program_detail');
						$data['document_data'] = $this->superadmin_model->superadmin($program,'get_document_data');
						$data['appl_status'] = $this->superadmin_model->superadmin($program,'get_appl_status');
						$data['doc_path'] = $this->superadmin_model->superadmin($program,'get_doc_path');
						$data['regdata'] = $this->superadmin_model->superadmin($program,'get_reg_id');
						$data['paymodedata'] = $this->superadmin_model->superadmin($program,'payModeQuery');
						$data['tempcodedata'] = $this->superadmin_model->superadmin($program,'tempcode');
						$data['categorydt'] = $this->superadmin_model->superadmin($program,'categorydata');
						$data['amount'] = $this->superadmin_model->superadmin($program,'amount');
						$data['updatereg'] = $this->superadmin_model->superadmin($program,'update_reg_mode');
						$data['bankdata'] = $this->superadmin_model->superadmin($program,'bank_detail');
						$data['passstatus'] = $this->superadmin_model->superadmin($program,'pass_status');
						$data['depositmode'] = $this->superadmin_model->superadmin($program,'deposit');
						
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
								$result = $this->superadmin_model->superadmin($_POST,'add_payment_data');
								if( $result['status'] )
								{
									$this->session->set_flashdata('info', $result['msg']);
									redirect('admin/apply_4');
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
								$this->load->view('admin/apply_4',$data);
							}
							else
							{
								redirect('apply/apply_logout/ins/'.$institute);
							}
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
	}
	public function excel_admitcard_setup()
	{
        $this->load->library('excel');
		//require_once './application/third_party/phpexcel/PHPExcel.php';
		//require_once './application/third_party/phpexcel/PHPExcel/IOFactory.php';
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true)->setSize(14)->getColor()->applyFromArray(array("rgb" =>'BLACK'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$F=$objPHPExcel->getActiveSheet();
		$F->getColumnDimension('B')->setAutoSize(TRUE);
		$F->getColumnDimension('C')->setAutoSize(TRUE);
		$F->getColumnDimension('D')->setAutoSize(TRUE);
		$F->getColumnDimension('E')->setAutoSize(TRUE);
		$F->getColumnDimension('F')->setAutoSize(TRUE);
		$F->getColumnDimension('G')->setAutoSize(TRUE);
		$F->getColumnDimension('H')->setAutoSize(TRUE);
		$F->getColumnDimension('I')->setAutoSize(TRUE);
		$Line=1;
		
		// THIS IS HEADER PART
		$F->setCellValue('A'.$Line,'Slno')
			->setCellValue('B'.$Line,'Program Name')
			->setCellValue('C'.$Line,'Exam Venue')
			->setCellValue('D'.$Line,'Capacity')
			->setCellValue('E'.$Line,'Exam Center Address')
			->setCellValue('F'.$Line,'Exam Schedule')
			->setCellValue('G'.$Line,'Exam Center Contact Name')
			->setCellValue('H'.$Line,'Contact Person Mobile No')
			->setCellValue('I'.$Line,'Contact Person Email');
			++$Line;
		$slno = 1;
		//$objDrawing = new PHPExcel_Worksheet_Drawing();
		$photo = "";
		$signature = "";
		$data_excel1 = $this->admin_model->excel1_report_admit_card_setup();
		//$validate = $this->admin_model->excel1_report_admit_card_setup($data);
		
		foreach ($data_excel1 as $value)
		{
			$exam_schedule = $value->exam_schedule;
			$exam_schedule1 = str_replace('<p>','',$exam_schedule);
			$exam_schedule2 = str_replace('</p>','',$exam_schedule1);
			//print_r($exam_schedule2);
  
			//echo $exam_schedule2
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$Line, $slno);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$Line, $value->program_name);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$Line, $value->exam_vanue);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$Line, $value->capacity);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$Line, $value->exam_center_address);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$Line, $exam_schedule2);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$Line, $value->controller_name);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$Line, $value->controller_mobile_no);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$Line, $value->controller_email);
			++$Line;
			$slno++;
		}
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Admit Card Details.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');	
	}
	public function excel_admitcard1(){
		$program_code = $this->uri->segment(3); // 1stsegment
		$exam_centre_code = $this->uri->segment(4); // 2ndsegment
		$exam_vanue = $this->uri->segment(5); // 3rdsegment
		$from = $this->uri->segment(6); // 4thsegment
		$to = $this->uri->segment(7); // 5thsegment
		$data = array(
            'program_code' => $program_code,
            'assigned_exam_center_code' => $exam_centre_code,
            'exam_vanue' => $exam_vanue,
            'from' => $from,
            'to' => $to
        );
        $this->load->library('excel');
		//require_once './application/third_party/phpexcel/PHPExcel.php';
		//require_once './application/third_party/phpexcel/PHPExcel/IOFactory.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true)->setSize(14)->getColor()->applyFromArray(array("rgb" =>'BLACK'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$F=$objPHPExcel->getActiveSheet();
		$F->getColumnDimension('B')->setAutoSize(TRUE);
		$F->getColumnDimension('C')->setAutoSize(TRUE);
		$F->getColumnDimension('D')->setAutoSize(TRUE);
		$F->getColumnDimension('E')->setAutoSize(TRUE);
		$F->getColumnDimension('F')->setAutoSize(TRUE);
		$F->getColumnDimension('G')->setAutoSize(TRUE);
		$F->getColumnDimension('H')->setAutoSize(TRUE);
		$F->getColumnDimension('I')->setAutoSize(TRUE);
		
		$Line=1;
		$F->setCellValue('A'.$Line,'Slno')
			->setCellValue('B'.$Line,'ID')
			->setCellValue('C'.$Line,'Applicant Name')
			->setCellValue('D'.$Line,'Program')
			->setCellValue('E'.$Line,'Exam Center')
			->setCellValue('F'.$Line,'Exam Venue')
			->setCellValue('G'.$Line,'Mobile No.')
			->setCellValue('H'.$Line,'Payment Mode')
			->setCellValue('I'.$Line,'Amount');
			++$Line;
		$slno = 1;
		//$objDrawing = new PHPExcel_Worksheet_Drawing();
		$photo = "";
		$signature = "";
		
		$data_excel1 = $this->admin_model->excel1_report_admit_card($data);
		//$validate = $this->admin_model->excel1_report_admit_card($data);
		
		foreach ($data_excel1 as $value)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$Line, $slno);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$Line, $value->omr_no);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$Line, $value->full_name);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$Line, $value->program_name);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$Line, $value->exam_centre_name);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$Line, $value->exam_vanue);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$Line, $value->reg_user_id);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$Line, $value->money_deposit_mode);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$Line, $value->amount);
			++$Line;
			$slno++;
		}
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Applicantlist.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		
	}
	
	public function excel_admitcardexcel()
	{
		
        $this->load->library('excel');
		
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true)->setSize(14)->getColor()->applyFromArray(array("rgb" =>'BLACK'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$F=$objPHPExcel->getActiveSheet();

		$F->getColumnDimension('B')->setAutoSize(TRUE);
		$F->getColumnDimension('C')->setAutoSize(TRUE);
		$F->getColumnDimension('D')->setAutoSize(TRUE);
		$F->getColumnDimension('E')->setAutoSize(TRUE);
		$F->getColumnDimension('F')->setAutoSize(TRUE);
		$F->getColumnDimension('G')->setAutoSize(TRUE);
		$F->getColumnDimension('H')->setAutoSize(TRUE);
		$F->getColumnDimension('I')->setAutoSize(TRUE);
	
		
		$Line=1;
		$F->setCellValue('A'.$Line,'Slno')
			->setCellValue('B'.$Line,'Program code')
			->setCellValue('C'.$Line,'Exam schedule')
			->setCellValue('D'.$Line,'Capacity')
			->setCellValue('E'.$Line,'Exam Center address')
			->setCellValue('F'.$Line,'Exam Venue')
			->setCellValue('G'.$Line,'Controller name')
			->setCellValue('H'.$Line,'Controller Email id')
			->setCellValue('I'.$Line,'Controller mobile number');
			
			++$Line;
		$slno = 1;
		
		$data_excel1 = $this->admin_model->excel1_report_admit_card_excel();
		//$validate = $this->admin_model->excel1_report_admit_card($data);
		
		foreach ($data_excel1 as $value)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$Line, $slno);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$Line, $value->program_code);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$Line, $value->exam_vanue);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$Line, $value->capacity);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$Line, $value->exam_center_address);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$Line, $value->exam_schedule);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$Line, $value->controller_name);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$Line, $value->controller_mobile_no);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$Line, $value->controller_email);
			++$Line;
			$slno++;
		}
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Applicantlist.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		
	}
	
	public function excel_scrutiny_verification_excel()
	{
		
        $this->load->library('excel');
		
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true)->setSize(14)->getColor()->applyFromArray(array("rgb" =>'BLACK'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$F=$objPHPExcel->getActiveSheet();

		$F->getColumnDimension('B')->setAutoSize(TRUE);
		$F->getColumnDimension('C')->setAutoSize(TRUE);
		$F->getColumnDimension('D')->setAutoSize(TRUE);
		$F->getColumnDimension('E')->setAutoSize(TRUE);
		$F->getColumnDimension('F')->setAutoSize(TRUE);
		
		
		$Line=1;
		$F->setCellValue('A'.$Line,'Slno')
		    ->setCellValue('B'.$Line,'index_no')
			->setCellValue('C'.$Line,'status')
			->setCellValue('D'.$Line,'applicant_mobile')
			->setCellValue('E'.$Line,'full_name');
			
			
						
			++$Line;
		$slno = 1;
		
		$data_excel1 = $this->admin_model->excel_report_scrutiny_excel();
		//$validate = $this->admin_model->excel1_report_admit_card($data);
		
		foreach ($data_excel1 as $value)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$Line, $slno);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$Line, $value->index_no);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$Line, $value->status);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$Line, $value->applicant_mobile);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$Line, $value->full_name);
			++$Line;
			$slno++;
		}
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Applicantlist.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		
	}
	
	public function excel_admitcard2(){
		$program_code = $this->uri->segment(3); // 1stsegment
		$exam_centre_code = $this->uri->segment(4); // 2ndsegment
		$exam_vanue = $this->uri->segment(5); // 3rdsegment
		$from = $this->uri->segment(6); // 4thsegment
		$to = $this->uri->segment(7); // 5thsegment$program_code_new = str_replace('%60','/',$program_code);
		$data = array(
            'program_code' => $program_code_new,
        
            'assigned_exam_center_code' => $exam_centre_code,
            'exam_vanue' => $exam_vanue,
            'from' => $from,
            'to' => $to
        );
        $this->load->library('excel');
		//require_once './application/third_party/phpexcel/PHPExcel.php';
		//require_once './application/third_party/phpexcel/PHPExcel/IOFactory.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true)->setSize(14)->getColor()->applyFromArray(array("rgb" =>'BLACK'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$F=$objPHPExcel->getActiveSheet();

		$F->getColumnDimension('B')->setAutoSize(TRUE);
		$F->getColumnDimension('C')->setAutoSize(TRUE);
		$F->getColumnDimension('D')->setAutoSize(TRUE);
		$F->getColumnDimension('E')->setAutoSize(TRUE);
		$F->getColumnDimension('F')->setAutoSize(TRUE);
		$F->getColumnDimension('G')->setWidth(10);
		$F->getColumnDimension('H')->setWidth(30);
		$F->getColumnDimension('I')->setAutoSize(TRUE);
		$F->getColumnDimension('J')->setAutoSize(TRUE);
		
		$Line=1;
		$F->setCellValue('A'.$Line,'Slno')
			->setCellValue('B'.$Line,'ID')
			->setCellValue('C'.$Line,'Applicant Name')
			->setCellValue('D'.$Line,'Program')
			->setCellValue('E'.$Line,'Exam Center')
			->setCellValue('F'.$Line,'Exam Venue')
			->setCellValue('G'.$Line,'Photo')
			->setCellValue('H'.$Line,'Specimen Signature')
			->setCellValue('I'.$Line,'Candidate\'s Signature')
			->setCellValue('J'.$Line,'Mobile No.');
		++$Line;
		$slno = 1;
		//$objDrawing = new PHPExcel_Worksheet_Drawing();
		$photo = "";
		$signature = "";
		
		$data_excel1 = $this->admin_model->excel2_report_admit_card($data);
		//$validate = $this->admin_model->excel1_report_admit_card($data);
		
		foreach ($data_excel1 as $value)
		{
			$photo = "";
			$signature = "";
			$sel_program = $program_code;
		    $pho = "";
		    $sign = "";
			if($value->passport_path != '')
		    {
		      $arr = explode('/',$value->passport_path);
		      $pho = end($arr);
		      $pho = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$sel_program."/".$value->appl_no."/".$pho;
		    }
		    /*echo $pho;
		    die();*/
			if($value->signature_path != '')
		    {
		      $arr = explode('/',$value->signature_path);
		      $sign = end($arr);
		      $sign = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$sel_program."/".$value->appl_no."/".$sign;
		    }
			if(file_exists($pho) && filesize($pho) != 0)
				$photo = $value->passport_path;
				
			
			if(file_exists($sign) && filesize($sign) != 0)
				$signature = $value->signature_path;
			
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$Line, $slno);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$Line, $value->omr_no);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$Line, $value->full_name);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$Line, $value->program_name);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$Line, $value->exam_centre_name);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$Line, $value->exam_vanue);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$Line, '');
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$Line, '');
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$Line, '');
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$Line, $value->reg_user_id);
			
			$F->getRowDimension($Line)->setRowHeight(50);
			
			if($photo != '')
			{
				$objDrawing = new PHPExcel_Worksheet_Drawing();
				$objDrawing->setPath($pho);	
				$objDrawing->setResizeProportional(false);
				$objDrawing->setHeight(60);
				$objDrawing->setWidth(70);
				$objDrawing->setWorksheet($F);
				$objDrawing->setCoordinates('G'.$Line);
				$objDrawing = null;
			}
			else
			{
				
			}
			
			if($signature != '')
			{
				$objDrawing2 = new PHPExcel_Worksheet_Drawing();
				$objDrawing2->setPath($sign);	
				$objDrawing2->setResizeProportional(false);
				$objDrawing2->setHeight(60);
				$objDrawing2->setWidth(170);
				$objDrawing2->setCoordinates('H'.$Line);
				$objDrawing2->setWorksheet($F);
				$objDrawing2 = null;	
			}
			else
			{
				
			}
			++$Line;
			$slno++;
			
		}
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Applicantlist.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		
	}
	public function split_string($string,$needle,$nth){
		$max = strlen($string);
		$n = 0;
		for($i=0;$i<$max;$i++){
		    if($string[$i]==$needle){
		        $n++;
		        if($n>=$nth){
		            break;
		        }
		    }
		}
		$arr[] = substr($string,0,$i);
		$arr[] = substr($string,$i+1,$max);

		return $arr;
	}	
	public function admit_card() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $reg_user_id = $_SESSION['reg_user_id'];
        $program_code = $this->uri->segment(3);
        $assigned_exam_center_code = $this->uri->segment(4);
        
     	$exam_vanue = $this->uri->segment(5);
        
		$program_code_new = str_replace('%60','/',$program_code);
        
       	$ins = $_SESSION['institute_code'];
      // die();
        
        //$program_code = $this->session->userdata('admcode');
        /*echo $program_code;
        echo $exam_centre_code;
        echo $exam_vanue;
        die();*/
		/*$exam_centre_code = $this->session->userdata('exam_center_code');
		$exam_vanue = $this->session->userdata('exam_vanue_code');*/
		
		$program_code = $this->uri->segment(3); // 1stsegment
		$exam_centre_code = $this->uri->segment(4); // 2ndsegment
		$exam_vanue = $this->uri->segment(5); // 3rdsegment
		$from = $this->uri->segment(6); // 4thsegment
		$to = $this->uri->segment(7); // 5thsegment
		$data = array(
            'program_code' => $program_code_new,
            'assigned_exam_center_code' => $assigned_exam_center_code,
            'exam_vanue' => $exam_vanue,
            'ins' => $ins,
            'from' => $from,
            'to' => $to,
            'reg_user_id' => $reg_user_id
        );
        
        
        $data['instituteDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_ins_detail');
        $data['courseTimingDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_course_timing_detail');
        $data['courseDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_course_detail');
        $data['subjectDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_subject_detail');
        $data['applicantSRow'] = $this->m_pdf_model->admit_card_pdf($data,'get_application_detail_1');
        
        $data['type'] = "ADMIT_CARD";
                
		$html = $this->load->view('pdf/admit_card', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        /*echo $html;
        die();*/
        $pdfFilePath = "admit_card_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $mpdf = $this->m_pdf->pdf;
        //generate the PDF!
       $mpdf->WriteHTML($html);
        
        /*$data['type'] = "FOOTER";
        $html = $this->load->view('pdf/admit_card', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$mpdf->defaultfooterline = 0;
		$mpdf->setFooter($footer);
      	$mpdf->WriteHTML($html);    */    
      	
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$mpdf->Output($uploaddir.'/admit_card_print.pdf', 'I');
		//$this->load->view('pdf/template008_pdf');	
		/*$pdf->Output($applicantNumber.".pdf",'I');*/	
		//return true;
    } 

	/*public function admit_card() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $program_code = $this->uri->segment(3); // 1stsegment
		$exam_centre_code = $this->uri->segment(4); // 2ndsegment
		$exam_vanue = $this->uri->segment(5); // 3rdsegment
		$from = $this->uri->segment(6); // 4thsegment
		$to = $this->uri->segment(7); // 5thsegment
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
      	
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/admit_card_print_008.pdf', 'I');
		//$this->load->view('pdf/template008_pdf');	
		//$pdf->Output($applicantNumber.".pdf",'I');	
		//return true;
    } */
    public function download_application() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
       
        $reg_user_id = $this->uri->segment(3); // 1stsegment
		$admcode = $this->uri->segment(4); // 2ndsegment
		
		$data = array(
            'admcode' => $admcode,
            'reg_user_id' => $reg_user_id
        );
        $result = $this->m_pdf_model->application_data($data,'get_appln_no');
        
        
        //print_r($result['appl_no']);
        $appl_no = $result['appl_no'];
       
        $file_path = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$admcode."/".$appl_no."/application_print_008.pdf";
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
	
	
	public function change_dob()
	{
		$sidebar['menuitem'] = 'Registered Date of Birth';
  		$sidebar['group'] = 'CHANGE';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/change_dob');
  		/*$this->load->view('template_config/admin_footer');*/
	}
	public function admit_card_template001() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
       // $reg_user_id = $_SESSION['reg_user_id'];
        $exam_centre_code = $this->uri->segment(3);
        $exam_vanue = $this->uri->segment(4);
        $program_code = $this->uri->segment(5);
        $reg_user_id = $this->uri->segment(6);
        $ins = $this->uri->segment(7);
        
        //$program_code = $this->session->userdata('admcode');
        /*echo $reg_user_id;
        echo $program_code;
        echo $exam_centre_code;
        echo $exam_vanue;
        die();*/
		/*$exam_centre_code = $this->session->userdata('exam_center_code');
		$exam_vanue = $this->session->userdata('exam_vanue_code');*/
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
            'ins' => $ins,
            'from' => $from,
            'to' => $to,
            'reg_user_id' => $reg_user_id
        );
        $data['instituteDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_ins_detail');
        $data['applicantSRow'] = $this->m_pdf_model->admit_card_pdf($data,'get_application_detail');
        
        $data['type'] = "ADMIT_CARD";
                
		$html = $this->load->view('pdf/admit_card', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
       /* echo $html;
        die();*/
        $pdfFilePath = "admit_card_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $mpdf = $this->m_pdf->pdf;
        //generate the PDF!
       $mpdf->WriteHTML($html);
        
        $data['type'] = "FOOTER";
        $html = $this->load->view('pdf/admit_card', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$mpdf->defaultfooterline = 0;
		$mpdf->setFooter($footer);
      	$mpdf->WriteHTML($html);        
      	
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$mpdf->Output($uploaddir.'/admit_card_print.pdf', 'I');
		$this->load->view('pdf/template008_pdf');	
		/*$pdf->Output($applicantNumber.".pdf",'I');*/	
		//return true;
    }
    public function folder_list()
	{
		$sidebar['menuitem'] = 'DOSSIER';
  		$sidebar['group'] = 'DOSSIER';
		//$data = 'hello';
		$data['role'] = $this->admin_model->admin('', 'get_role_detail');//print_r($data['role']);die();
		//$data['get_folder_detail'] = $this->admin_model->admin('', 'get_folder_detail');//print_r($data['role']);die();
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/folder_list', $data);
  		/*$this->load->view('template_config/admin_footer');*/
	}
	public function important_notice()
	{
		$sidebar['menuitem'] = 'Important Notice';
  		$sidebar['group'] = 'MANAGE INFORMATION';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/important_notice');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function general_information()
	{
		$sidebar['menuitem'] = 'General Information';
  		$sidebar['group'] = 'MANAGE INFORMATION';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/general_information');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function general_instruction()
	{
		$sidebar['menuitem'] = 'Instruction';
  		$sidebar['group'] = 'MANAGE INFORMATION';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/general_instruction');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function manage_information_type()
	{
		$sidebar['menuitem'] = 'Manage Information Type';
  		$sidebar['group'] = 'MANAGE INFORMATION';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/manage_information_type');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function manage_information()
	{
		$sidebar['menuitem'] = 'Manage Information';
  		$sidebar['group'] = 'MANAGE INFORMATION';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/manage_information');
  		/*$this->load->view('template_config/admin_footer');*/
		
	}
	public function appointment_letter_template()
	{
		$sidebar['menuitem'] = 'Setup';
  		$sidebar['group'] = 'APPOINTMENT LETTER';
		
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/appointment_template');
	} 
    public function doc_download()
	{
		$sidebar['menuitem'] = 'DOCUMENT DOWNLOAD';
  		$sidebar['group'] = 'DOCUMENT DOWNLOAD';
		//$data = 'hello';
		$data = array();
		//$data['get_folder_detail'] = $this->admin_model->admin('', 'get_folder_detail');//print_r($data['role']);die();
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/doc_download', $data);
  		/*$this->load->view('template_config/admin_footer');*/
	} 
	public function view_document()
	{
		$sidebar['menuitem'] = 'DOCUMENT DOWNLOAD';
  		$sidebar['group'] = 'DOCUMENT DOWNLOAD';
		$appl_no = $this->uri->segment(3); 
		$program = $this->uri->segment(4); 
		$seg_data['prog'] = $program;
		$seg_data['appl_no'] = $appl_no;//echo $program;die();
		$data['get_document_list'] = $this->admin_model->admin($seg_data, 'get_document_list');//print_r($data['get_document_list']);die();
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin/view_document', $data);
  		/*$this->load->view('template_config/admin_footer');*/
	}
	public function zip_doc()
	{
		$this->load->library('zip');
		$appl_no = $this->uri->segment(3); 
		$program = $this->uri->segment(4);
		 
		//$appl_document = $this->getter_model->get($data,'appl_document_download'); 
		//foreach($appl_document as $key=>$app_doc):
		//echo FCPATH;
		$filePath = FCPATH."DOCUMENTS/".$program."/".$appl_no.'/';
		
		$this->zip->read_dir($filePath, FALSE);
		//endforeach;
		$this->zip->download($appl_no.'.zip');
		
	}
	public function admit_card_WRITTEN() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $reg_user_id = $_SESSION['reg_user_id'];
        $exam_centre_code = $this->uri->segment(3);
        $exam_vanue1 = $this->uri->segment(4);
        $program_code = $this->uri->segment(5);
        $ins = $this->uri->segment(6);
        $exam_vanue = str_replace('_','/',$exam_vanue1);
		$from = '';
		$to = '';
		
		$data = array(
            'program_code' => $program_code,
            'assigned_exam_center_code' => $exam_centre_code,
            'exam_vanue' => $exam_vanue,
            'ins' => $ins,
            'from' => $from,
            'to' => $to,
            'reg_user_id' => $reg_user_id
        );
        $data['instituteDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_ins_detail');
        $data['courseTimingDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_course_timing_detail');
        $data['courseDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_course_detail');
        $data['applicantSRow'] = $this->m_pdf_model->admit_card_pdf($data,'get_application_detail');
        
        $data['type'] = "ADMIT_CARD";
                
		$html = $this->load->view('pdf/admit_card_WRITTEN', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
       	//echo $html;die();
        $pdfFilePath = "admit_card_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $mpdf = $this->m_pdf->pdf;
        //generate the PDF!
       	$mpdf->WriteHTML($html);
        
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$mpdf->Output($uploaddir.'/admit_card_print.pdf', 'I');
		$this->load->view('pdf/admit_card_WRITTEN');	
		/*$pdf->Output($applicantNumber.".pdf",'I');*/	
		//return true;
    } 
    
	public function admit_card_VIVA() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $reg_user_id = $_SESSION['reg_user_id'];
        $exam_centre_code = $this->uri->segment(3);
        $exam_vanue1 = $this->uri->segment(4);
        $program_code = $this->uri->segment(5);
        $ins = $this->uri->segment(7);
        $reg_user_id = $this->uri->segment(6);
        $exam_vanue = str_replace('/','_',$exam_vanue1);
		$from = '';
		$to = '';
		
		$data = array(
            'program_code' => $program_code,
            'assigned_exam_center_code' => $exam_centre_code,
            'exam_vanue' => $exam_vanue,
            'ins' => $ins,
            'from' => $from,
            'to' => $to,
            'reg_user_id' => $reg_user_id
        );
        $data['instituteDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_ins_detail');
        $data['courseTimingDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_course_timing_detail');
        $data['courseDetails'] = $this->m_pdf_model->admit_card_pdf($data,'get_course_detail');
        $data['applicantSRow'] = $this->m_pdf_model->admit_card_pdf($data,'get_application_detail');
        
        $data['type'] = "ADMIT_CARD";
                
		$html = $this->load->view('pdf/admit_card_VIVA', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
       	//echo $html;die();
        $pdfFilePath = "admit_card_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $mpdf = $this->m_pdf->pdf;
        //generate the PDF!
       	$mpdf->WriteHTML($html);
        
		$uploaddir = DOCUMENT_UPLOAD_URL.'/DOCUMENTS/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$mpdf->Output($uploaddir.'/admit_card_print.pdf', 'I');
		$this->load->view('pdf/template008_pdf');	
		/*$pdf->Output($applicantNumber.".pdf",'I');*/	
		//return true;
    } 

	//Scrutiny Synopsis Report
	//Santhoshi
	//Dated : 21-12-2020
	
	
	public function excel_synopsis_report()
	{
        $program_code = $this->uri->segment(3); // 1stsegment
		$data = array(
            'program_code' => $program_code
        );
        
        $program_data = array();
        $program_data = $this->admin_model->scrutiny_program_details($data);
        foreach($program_data as $row)
		{
			$program_group = $row['program_group'];
			$program_name = $row['program_name'];
			$advt_no = $row['advt_no'];
			$advt_date = $row['advt_date'];
		} 
		
        $this->load->library('excel');
		require_once './application/third_party/PHPExcel-1.8/Classes/PHPExcel.php';
		require_once './application/third_party/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		
		$objPHPExcel->getActiveSheet()->setTitle('Synopsis Sheet');//EXCEL SHEET NAME

		$objPHPExcel->getActiveSheet()->getStyle('A1:BZ1')->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'#000000'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$objPHPExcel->getActiveSheet()->getStyle('A2:BZ2')->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'#000000'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR second ROW
		$objPHPExcel->getActiveSheet()->getStyle('A3:BZ3')->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'#000000'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR second ROW
		$objPHPExcel->getActiveSheet()->getStyle('A1:BZ1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A2:BZ2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A3:BZ3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$F=$objPHPExcel->getActiveSheet();
		$excel_row = 1;
		$F->setCellValue('A'.$excel_row,'Application for the post of '.$program_name.' for SVNIRTAR');
		$F->mergeCells('A1:E1');
		$excel_row++;
		$F->setCellValue('A'.$excel_row,'Advertisement No. '.$advt_no.' Dated : '.$advt_date);
		$F->mergeCells('A2:E2');
		$excel_row++;
		$excel_row++;
		$styleArray = array(
		       'borders' => array(
		        'allborders' => array(
		            'style' => PHPExcel_Style_Border::BORDER_THICK,
		            'color' => array('rgb' => '#000000')
		        )
		    )
		);
		  
		$F->getColumnDimension('A')->setAutoSize(TRUE);
		$F->getColumnDimension('B')->setAutoSize(TRUE);
		$F->getColumnDimension('C')->setAutoSize(TRUE);
		$F->getColumnDimension('D')->setAutoSize(TRUE);
		$F->getColumnDimension('E')->setAutoSize(TRUE);
		$F->getColumnDimension('F')->setAutoSize(TRUE);
		$F->getColumnDimension('G')->setAutoSize(TRUE);
		$F->getColumnDimension('H')->setAutoSize(TRUE);
		$F->getColumnDimension('I')->setAutoSize(TRUE);
		$F->getColumnDimension('J')->setAutoSize(TRUE);
		$F->getColumnDimension('K')->setAutoSize(TRUE);
		$F->getColumnDimension('L')->setAutoSize(TRUE);
		$F->getColumnDimension('M')->setAutoSize(TRUE);
		$F->getColumnDimension('N')->setAutoSize(TRUE);
		$F->getColumnDimension('O')->setAutoSize(TRUE);
		$F->getColumnDimension('P')->setAutoSize(TRUE);
		$F->getColumnDimension('Q')->setAutoSize(TRUE);
		$F->getColumnDimension('R')->setAutoSize(TRUE);
		
		$next_line = $excel_row+1;
		
		$F->setCellValue('A'.$excel_row,'Sl.No')
			->setCellValue('B'.$excel_row,'Form Received')
			->setCellValue('C'.$excel_row,'Name')
			->setCellValue('D'.$excel_row,'Father / Husband Name')
			->setCellValue('E'.$excel_row,'Address')
			->setCellValue('F'.$excel_row,'Mobile No')
			->setCellValue('G'.$excel_row,'Email Id')
			->setCellValue('H'.$excel_row,'Category')
			
			->setCellValue('I'.$excel_row,'Age Detail')
			->setCellValue('I'.$next_line,'Date Of Birth')
			->setCellValue('J'.$next_line,'Cut Off Date')
			->setCellValue('K'.$next_line,'Age')
			
			->setCellValue('L'.$excel_row,'Essential Qualification')
			->setCellValue('M'.$excel_row,'Experience')
			
			->setCellValue('N'.$excel_row,'Bank Details')
			->setCellValue('N'.$next_line,'DD No.')
			->setCellValue('O'.$next_line,'Date')
			->setCellValue('P'.$next_line,'Name of the Bank')
			->setCellValue('Q'.$next_line,'Amount in (Rs.)')
			
			->setCellValue('R'.$excel_row,'Remarks');
		
		$F->mergeCells('I'.$excel_row.':K'.$excel_row);
		$F->mergeCells('N'.$excel_row.':Q'.$excel_row);
		$F->getStyle('I'.$excel_row.':K'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		$F->getStyle('N'.$excel_row.':Q'.$excel_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		$objPHPExcel->getActiveSheet()->getStyle('I'.$next_line.':K'.$next_line)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '5B5554'))))->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'ffffff'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$objPHPExcel->getActiveSheet()->getStyle('I'.$excel_row.':K'.$excel_row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'E64F4F'))))->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'ffffff'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$objPHPExcel->getActiveSheet()->getStyle('N'.$next_line.':Q'.$next_line)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '5B5554'))))->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'ffffff'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$objPHPExcel->getActiveSheet()->getStyle('N'.$excel_row.':Q'.$excel_row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'E64F4F'))))->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'ffffff'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		
		$objPHPExcel->getActiveSheet()->getStyle('A'.$excel_row.':H'.$excel_row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '5B5554'))))->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'ffffff'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$objPHPExcel->getActiveSheet()->getStyle('L'.$excel_row.':M'.$excel_row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '5B5554'))))->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'ffffff'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$objPHPExcel->getActiveSheet()->getStyle('R'.$excel_row.':R'.$excel_row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '5B5554'))))->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'ffffff'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$excel_row.':A'.$next_line);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.$excel_row.':B'.$next_line);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$excel_row.':C'.$next_line);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D'.$excel_row.':D'.$next_line);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E'.$excel_row.':E'.$next_line);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('F'.$excel_row.':F'.$next_line);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$excel_row.':G'.$next_line);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('H'.$excel_row.':H'.$next_line);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('L'.$excel_row.':L'.$next_line);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('M'.$excel_row.':M'.$next_line);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('R'.$excel_row.':R'.$next_line);
		
		$excel_row++;
		$excel_row++;
		$slno = 1;
		
		$data_excel1 = $this->admin_model->excel_synopsis_report($data);
		$photo = "";
		$signature = "";
		$applicant_count = 0;
		foreach($data_excel1 as $Trs)
		{
			$range = 'A'.$excel_row.':R'.$excel_row;
			$objPHPExcel->getActiveSheet()
			    ->getStyle($range)
			    ->getNumberFormat()
			    ->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
			    
				$F->setCellValue('A'.$excel_row,$slno)
				->setCellValue('B'.$excel_row,$Trs['appl_no'])
				->setCellValue('C'.$excel_row,$Trs['full_name'])
				->setCellValue('D'.$excel_row,$Trs['father_name'])
				->setCellValue('E'.$excel_row,$Trs['address'])
				->setCellValue('F'.$excel_row,$Trs['mobile_no'])
				->setCellValue('G'.$excel_row,$Trs['email_id'])
				->setCellValue('H'.$excel_row,$Trs['category_name'])
				->setCellValue('I'.$excel_row,$Trs['dob'])
				->setCellValue('J'.$excel_row,'')
				->setCellValue('K'.$excel_row,$Trs['age'])
				->setCellValue('L'.$excel_row,$Trs['qual'])
				->setCellValue('M'.$excel_row,$Trs['experience'])
				->setCellValue('N'.$excel_row,$Trs['dd_no'])
				->setCellValue('O'.$excel_row,$Trs['depositdate'])
				->setCellValue('P'.$excel_row,'')
				->setCellValue('Q'.$excel_row,$Trs['amount'])
				->setCellValue('R'.$excel_row,$Trs['scrutiny_remark']);
				$F->getStyle('L'.$excel_row)->getAlignment()->setWrapText(true);
				$F->getStyle('M'.$excel_row)->getAlignment()->setWrapText(true);
				
			/*}*/
			
		   	$slno++;
			$excel_row++;
		}
		$excel_row++;
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Synopsis_sheet.xls"');//EXCEL FILE NAME
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		
	}
}
