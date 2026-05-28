<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends CI_Controller
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
		//$data['role'] = $this->session->userdata('role');
		
		$this->load->helper(array('form'));
		# libraries
		$this->load->library('form_validation');
		$this->load->library('user_agent');
        //$this->load->view('template_config/admin_header');
	}
	public function template008_pdf() {
		$this->load->view('template_config/admin_header');
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
		$uploaddir = DOCUMENT_UPLOAD_URL.'/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template008_pdf');	
		/*$pdf->Output($applicantNumber.".pdf",'I');*/	
		return true;
    } 


	/*
	*	purpose : to check whether the method is correct or not
	*/
	
	public function _remap($method)
	{
		$class 	= $this->router->class;
		$role = $this->session->userdata('role');
		if( !in_array($role, array('SUPADM','EVALUATEADM','DASHBOARD','ADMITCARDADM','SETUPADM')) )
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
		
		$this->load->view('template_config/admin_header');
		$this->load->view('templates/404.php');
		//$this->load->view('templates/admin_footer');
	}
	public function index()
	{
		
		$this->load->view('template_config/admin_header');
		redirect('superadmin_controller/dashboard');
		
	}	
	public function dashboard()
	{
		//echo 'hi';die();
		$sidebar['menuitem'] = 'DASHBOARD';
		$sidebar['group'] = 'DASHBOARD';
		$data['title'] = "ESApplication | Dashboard";
		$this->load->view('template_config/admin_header',$data);
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
		$data['active_institute_list'] = $this->superadmin_model->superadmin(NULL,'get_active_institute_list');
		$data['inactive_institute_list'] = $this->superadmin_model->superadmin(NULL,'get_inactive_institute_list');
		$data['get_users_applicant'] = $this->superadmin_model->superadmin(NULL,'get_users_applicant');
		$data['get_users_admin'] = $this->superadmin_model->superadmin(NULL,'get_users_admin');
		$data['get_user_loggedin_applicant'] = $this->superadmin_model->superadmin(NULL,'get_user_loggedin_applicant');
		$data['get_user_loggedin_admin'] = $this->superadmin_model->superadmin(NULL,'get_user_loggedin_admin');
		$data['get_today_collection'] = $this->superadmin_model->superadmin(NULL,'get_today_collection');
		//$data['inactive_institute_list'] = $this->superadmin_model->superadmin(NULL,'get_inactive_institute_list');
		/*$data['get_users'] = $this->superadmin_model->superadmin(NULL,'get_users');
		$data['get_user_loggedin'] = $this->superadmin_model->superadmin(NULL,'get_user_loggedin');*/
		//$data['total_collection'] = $this->superadmin_model->superadmin(NULL,'total_collection');
		//$this->load->view('template_config/admin_header');
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('superadmin/dashboard',$data);
		/*$this->load->view('template_config/template_setting');*/
		
		//$this->load->view('template_config/admin_footer');
	}
	public function report_all_users()
	{
		$this->load->view('template_config/admin_header');
		$sidebar['menuitem'] = 'User Details';
  		$sidebar['group'] = 'SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$data['institute_data'] = $this->superadmin_model->superadmin(NULL,'get_institute_name_code');
		$this->load->view('superadmin/report_all_users', $data);
  		/*$this->load->view('template_config/admin_footer');*/
  		
		/*$sidebar['menuitem'] = 'DASHBOARD';
		$sidebar['group'] = 'DASHBOARD';
		$data['title'] = "ESApplication | Dashboard";
		$this->load->view('template_config/admin_header',$data);
  		$data['institute_data'] = $this->superadmin_model->superadmin(NULL,'get_institute_name_code');
		$this->load->view('superadmin/report_all_users', $data);
  		$this->load->view('template_config/admin_footer');*/
	}	
	public function report_all_logins()
	{ 	
		$this->load->view('template_config/admin_header');
		$sidebar['menuitem'] = 'Login Details';
  		$sidebar['group'] = 'SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('superadmin/report_login_details');
  		/*$this->load->view('template_config/admin_footer');*/
		
		
	}
	public function manage_institute()
	{
		
		$this->load->view('template_config/admin_header');
		$sidebar['menuitem'] = 'Organization Setup';
  		$sidebar['group'] = 'SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('superadmin/manage_institute');
  		//$this->load->view('template_config/admin_footer');
		
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
 		
		$this->load->view('template_config/admin_header');
  		$sidebar['menu_item'] = 'Manage Resource';
  		$sidebar['menu_group'] = 'Setting';
  		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/header');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$data['all_role_data'] = $this->superadmin_model->superadmin(NULL,'get_role');
  		$data['all_link_url_data'] = $this->superadmin_model->superadmin(NULL,'get_url_link');
  		$data['all_resource_data'] = $this->superadmin_model->superadmin(NULL,'get_resource');
  		
  		$this->load->view('superadmin/manage_resource',$data);
  		$this->load->view('template_config/template_setting');
  		
  		//$this->load->view('template_config/admin_footer');
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
 		
		$this->load->view('template_config/admin_header');
  		$sidebar['menu_item'] = 'Manage Group';
		$sidebar['menu_group'] = 'Setting';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/header');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$viewdata['table_data'] = $this->superadmin_model->superadmin(NULL,'get_table');
		$viewdata['all_role_data'] = $this->superadmin_model->superadmin(NULL,'get_role');
  		$viewdata['all_group_data'] = $this->superadmin_model->superadmin(NULL,'get_group');
  		$viewdata['all_rolegroup_data'] = $this->superadmin_model->superadmin(NULL,'get_rolegroup_code');
  		$viewdata['all_user_data'] = $this->superadmin_model->superadmin(NULL,'get_user_code');
  		$this->load->view('superadmin/manage_group',$viewdata);
  		$this->load->view('template_config/template_setting');
  		
  		/*$this->load->view('template_config/admin_footer');*/
 	}
	public function manage_location()
	{
		
		$this->load->view('template_config/admin_header');
		//echo 'hi' ; die();
		$data['menu_item'] = 'Manage Location';
		$data['menu_group'] = '';
		$data['role'] = 'superadmin';
		$this->load->view('template_config/header',$data);
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('superadmin/manage_location');
		$this->load->view('template_config/template_setting');
		
		/*$this->load->view('template_config/admin_footer');*/
	}
	public function manage_user()
	{
		
		$this->load->view('template_config/admin_header');
		//echo 'hi' ; die();
		$sidebar['menuitem'] = 'Manage User';
		$sidebar['group'] = 'SETUP';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('superadmin/manage_user');
		/*$this->load->view('template_config/admin_footer');*/
	}
	public function code_setup()
	{
		
		$this->load->view('template_config/admin_header');
		//echo 'hi' ; die();
		$sidebar['menuitem'] = 'Code Setup';
		$sidebar['group'] = 'SETUP';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('superadmin/code_setup');
		/*$this->load->view('template_config/admin_footer');*/
	}
	public function generic_setup1()
	{
		$this->load->view('template_config/admin_header');
		//echo 'hi' ; die();
		$sidebar['menuitem'] = 'Recruitment Drive Setup';
		$sidebar['group'] = 'SETUP';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
		$data['program_group'] = $this->superadmin_model->superadmin('', 'program_group_data');
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('superadmin/generic_setup1',$data);
		/*$this->load->view('template_config/admin_footer');*/
	}
	public function generic_setup2()
	{
		
		$this->load->view('template_config/admin_header');
		//echo 'hi' ; die();
		$sidebar['menuitem'] = 'Generic Setup';
		$sidebar['group'] = 'SETUP';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('superadmin/generic_setup2');
		/*$this->load->view('template_config/admin_footer');*/
	}
	public function generic_setup3()
	{
		
		$this->load->view('template_config/admin_header');
		//echo 'hi' ; die();
		$sidebar['menuitem'] = 'Generic Setup 3';
		$sidebar['group'] = 'SETUP';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('superadmin/generic_setup3');
		/*$this->load->view('template_config/admin_footer');*/
	}
	public function communication_setup()
	{
		
		$this->load->view('template_config/admin_header');
		//echo 'hi' ; die();
		$sidebar['menuitem'] = 'Communication Setup';
		$sidebar['group'] = 'SETUP';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('superadmin/communication_setup');
		/*$this->load->view('template_config/admin_footer');*/
	}
	public function user_program_mapping()
	{
		
		$this->load->view('template_config/admin_header');
		//echo 'hi' ; die();
		$sidebar['menuitem'] = 'User Program Mapping';
		$sidebar['group'] = 'SETUP';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('superadmin/user_program_mapping');
		/*$this->load->view('template_config/admin_footer');*/
	}
	public function manage_paymentgateway_setup()
	{
		
		$this->load->view('template_config/admin_header');
		//echo 'hi' ; die();
		$sidebar['menuitem'] = 'Payment Gateway Setup';
		$sidebar['group'] = 'SETUP';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('superadmin/manage_paymentgateway_setup');
		/*$this->load->view('template_config/admin_footer');*/
	}
	public function round_wise_status()
	{
		
		$this->load->view('template_config/admin_header');
		//echo 'hi' ; die();
		$sidebar['menuitem'] = 'Phase Wise Status';
		$sidebar['group'] = 'SETUP';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('superadmin/round_wise_status');
		/*$this->load->view('template_config/admin_footer');*/
	}
	public function payment_verification()
	{
		
		$this->load->view('template_config/admin_header');
		//echo 'hi' ; die();
		$sidebar['menuitem'] = 'PAYMENT VERIFICATION';
		$sidebar['group'] = 'DEFPAYMENT VERIFICATIONINE';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('superadmin/payment_verification');
		/*$this->load->view('template_config/admin_footer');*/
	}
	public function online_payment_details()
	{
		
		$institute = $this->uri->segment(3);
		$data['institute_name'] = $this->superadmin_model->superadmin($institute,'get_institute_name');
		
		$this->load->view('superadmin/online_payment_details',$data);
	}
	
	
	public function excel_online_payment_report_multiple_month(){
		$ins_code = $this->uri->segment(3); // 1stsegment
		$month = $this->uri->segment(4); // 1stsegment
		$year = $this->uri->segment(5); // 1stsegment
		$status = $this->uri->segment(6); // 1stsegment
		$data = array(
            'ins_code' => $ins_code,
            'month' => $month,
            'year' => $year,
            'status' => $status
        );
        $this->load->library('excel');
		/*require_once './application/third_party/phpexcel/PHPExcel.php';
		require_once './application/third_party/phpexcel/PHPExcel/IOFactory.php';
		*/
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'BLACK'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
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
		$F->getColumnDimension('J')->setAutoSize(TRUE);
		
		$Line=1;
		$F->setCellValue('A'.$Line,'Slno')
			->setCellValue('B'.$Line,'Appl. No')
			->setCellValue('C'.$Line,'Program Name')
			->setCellValue('D'.$Line,'Applicant Name')
			->setCellValue('E'.$Line,'Request Date')
			->setCellValue('F'.$Line,'Trans. Date')
			->setCellValue('G'.$Line,'Deposit Status')
			->setCellValue('H'.$Line,'Trans. No.')
			->setCellValue('I'.$Line,'Trans. Amount')
			->setCellValue('J'.$Line,'Refund Status');//write in the sheet
			++$Line;
		$slno = 1;
		//echo "hiiiii";
		$data_excel1 = $this->superadmin_model->excel_online_payment_report_multiple_month($data);
		//$validate = $this->admin_model->excel1_report_admit_card($data);
		
		foreach ($data_excel1 as $value)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$Line, $slno);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$Line, $value->appl_no);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$Line, $value->program_name);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$Line, $value->full_name);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$Line, $value->request_datetime);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$Line, $value->response_datetime);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$Line, $value->deposit_status);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$Line, $value->transaction_number);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$Line, $value->amount);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$Line, $value->refund_status);
			++$Line;
			$slno++;
		}
		
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="OnlinePaymentReport.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		
	}

	public function excel_online_payment_report_multiple(){
		$ins_code = $this->uri->segment(3); // 1stsegment
		$from_date1 = $this->uri->segment(4); // 1stsegment
		$from_date2 = $this->uri->segment(5); // 1stsegment
		$from_date3 = $this->uri->segment(6); // 1stsegment
		$to_date1 = $this->uri->segment(7); // 1stsegment
		$to_date2 = $this->uri->segment(8); // 1stsegment
		$to_date3 = $this->uri->segment(9); // 1stsegment
		//$status = $this->uri->segment(10); // 1stsegment
		$data = array(
            'ins_code' => $ins_code,
            'from_date1' => $from_date1,
            'from_date2' => $from_date2,
            'from_date3' => $from_date3,
            'to_date1' => $to_date1,
            'to_date2' => $to_date2,
            'to_date3' => $to_date3/*,
            'status' => $status*/
        );
        //print_r($data)
        $this->load->library('excel');
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'BLACK'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
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
		$F->getColumnDimension('J')->setAutoSize(TRUE);
		
		$Line=1;
		$F->setCellValue('A'.$Line,'Slno')
			->setCellValue('B'.$Line,'Appl. No')
			->setCellValue('C'.$Line,'Program Name')
			->setCellValue('D'.$Line,'Applicant Name')
			->setCellValue('E'.$Line,'Request Date')
			->setCellValue('F'.$Line,'Trans. Date')
			->setCellValue('G'.$Line,'Deposit Status')
			->setCellValue('H'.$Line,'Trans. No.')
			->setCellValue('I'.$Line,'Trans. Amount')
			->setCellValue('J'.$Line,'Refund Status');//write in the sheet
			++$Line;
		$slno = 1;
		/*echo "hiiiii";
		die();*/
		$data_excel1 = $this->superadmin_model->excel_online_payment_report_multiple($data);
		//$validate = $this->admin_model->excel1_report_admit_card($data);
		
		foreach ($data_excel1 as $value)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$Line, $slno);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$Line, $value->appl_no);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$Line, $value->program_name);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$Line, $value->full_name);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$Line, $value->request_datetime);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$Line, $value->response_datetime);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$Line, $value->deposit_status);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$Line, $value->transaction_number);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$Line, $value->amount);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$Line, $value->refund_status);
			++$Line;
			$slno++;
		}
		
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="OnlinePaymentReport.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		
	}
	
	public function excel_online_payment_report_month(){
		$ins_code = $this->uri->segment(3); // 1stsegment
		$month = $this->uri->segment(4); // 1stsegment
		$year = $this->uri->segment(5); // 1stsegment
		$status = $this->uri->segment(6); // 1stsegment
		$data = array(
            'ins_code' => $ins_code,
            'month' => $month,
            'year' => $year,
            'status' => $status
        );
        $this->load->library('excel');
		//require_once './application/third_party/phpexcel/PHPExcel.php';
		//require_once './application/third_party/phpexcel/PHPExcel/IOFactory.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'BLACK'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
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
		$F->getColumnDimension('J')->setAutoSize(TRUE);
		
		$Line=1;
		$F->setCellValue('A'.$Line,'Slno')
			->setCellValue('B'.$Line,'Appl. No')
			->setCellValue('C'.$Line,'Mobile No')
			->setCellValue('D'.$Line,'Program Name')
			->setCellValue('E'.$Line,'Applicant Name')
			->setCellValue('F'.$Line,'Request Date')
			->setCellValue('G'.$Line,'Trans. Date')
			->setCellValue('H'.$Line,'Deposit Status')
			->setCellValue('I'.$Line,'Trans. No.')
			->setCellValue('J'.$Line,'Trans. Amount');//write in the sheet
			++$Line;
		$slno = 1;
		//$Fval = 'ONLINE';
		$data_excel1 = $this->superadmin_model->excel_online_payment_report_month($data);
		//$validate = $this->admin_model->excel1_report_admit_card($data);
		
		foreach ($data_excel1 as $value)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$Line, $slno);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$Line, $value->appl_no);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$Line, $value->reg_user_id);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$Line, $value->program_name);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$Line, $value->full_name);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$Line, $value->request_datetime);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$Line, $value->response_datetime);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$Line, $value->deposit_status);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$Line, $value->transaction_number);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$Line, $value->amount);
			++$Line;
			$slno++;
		}
		
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Applicantlist.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		
	}

	public function excel_online_payment_report(){
		$ins_code = $this->uri->segment(3); // 1stsegment
		$from_date = $this->uri->segment(4); // 1stsegment
		$to_date = $this->uri->segment(5); // 1stsegment
		$status = $this->uri->segment(6); // 1stsegment
		$data = array(
            'ins_code' => $ins_code,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'status' => $status
        );
        $this->load->library('excel');
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'BLACK'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
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
		$F->getColumnDimension('J')->setAutoSize(TRUE);
		
		$Line=1;
		$F->setCellValue('A'.$Line,'Slno')
			->setCellValue('B'.$Line,'Appl. No')
			->setCellValue('C'.$Line,'Mobile No')
			->setCellValue('D'.$Line,'Program Name')
			->setCellValue('E'.$Line,'Applicant Name')
			->setCellValue('F'.$Line,'Request Date')
			->setCellValue('G'.$Line,'Trans. Date')
			->setCellValue('H'.$Line,'Deposit Status')
			->setCellValue('I'.$Line,'Trans. No.')
			->setCellValue('J'.$Line,'Trans. Amount');//write in the sheet
			++$Line;
		$slno = 1;
		//$Fval = 'ONLINE';
		$data_excel1 = $this->superadmin_model->excel_online_payment_report($data);
		//$validate = $this->admin_model->excel1_report_admit_card($data);
		
		foreach ($data_excel1 as $value)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$Line, $slno);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$Line, $value->appl_no);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$Line, $value->reg_user_id);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$Line, $value->program_name);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$Line, $value->full_name);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$Line, $value->request_datetime);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$Line, $value->response_datetime);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$Line, $value->deposit_status);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$Line, $value->transaction_number);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$Line, $value->amount);
			++$Line;
			$slno++;
		}
		
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Applicantlist.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		
	}
	
	public function upload_payment_report()
	{
		$this->load->view('superadmin/upload_payment_report');
	}
	public function save() {
        $this->load->library('excel');
        $data = '';
        if ($this->input->post('importfile')) {
        	
            $path = ROOT_UPLOAD_IMPORT_PATH.'/';
 
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls|jpg|png';
            $config['remove_spaces'] = TRUE;
           // $this->upload->initialize($config);
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }
            
            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;
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
            $createArray = array('Sr.No','TransactionDate', 'TransactionId', 'StudentName','EmailId', 'MobileNo', 'BankReferenceNo', 'ReceivedAmount', 
            					'TransactionCharges','SettelmentAmount', 'PaymentMode');
            $makeArray = array('Sr.No' => 'Sr.No', 'TransactionDate' => 'TransactionDate', 'TransactionId' => 'TransactionId', 
            					'StudentName' => 'StudentName', 'EmailId' => 'EmailId', 'MobileNo' => 'MobileNo',
            					'BankReferenceNo' => 'BankReferenceNo', 'ReceivedAmount' => 'ReceivedAmount',
            					'TransactionCharges' => 'TransactionCharges','SettelmentAmount' => 'SettelmentAmount', 'PaymentMode' => 'PaymentMode');
            $SheetDataKey = array();
            
            foreach ($allDataInSheet as $dataInSheet) {
                foreach ($dataInSheet as $key => $value) {
                	//echo $value;
                	$value = preg_replace('/\s+/', '', $value);
                    if (in_array($value, $createArray)) {
                        $value = preg_replace('/\s+/', '', $value);
                        $SheetDataKey[$value] = $key;
                    } else {
                        
                    }
                }
            }
            $data = array_diff_key($makeArray, $SheetDataKey);
          	//print_r($data);
            if (empty($data)) {
                $flag = 1;
            }
            //echo $flag;
            //echo $arrayCount;
			//$fetchData[] = array();        	
            if ($flag == 1) {
            	//echo"dfdg";die();
                for ($i = 2; $i <= $arrayCount; $i++) {
                    $addresses = array();
                    $Sr_No = $SheetDataKey['Sr.No'];
                    $Transaction_Date = $SheetDataKey['TransactionDate'];
                    $Transaction_Id = $SheetDataKey['TransactionId'];
                    $Student_Name = $SheetDataKey['StudentName'];
                    $Email_Id = $SheetDataKey['EmailId'];
                    $MobileNo = $SheetDataKey['MobileNo'];
                    $Bank_Reference_No = $SheetDataKey['BankReferenceNo'];
                    $Received_Amount = $SheetDataKey['ReceivedAmount'];
                    $Transaction_charges = $SheetDataKey['TransactionCharges'];
                    $Settelment_Amount = $SheetDataKey['SettelmentAmount'];
                    $Payment_Mode = $SheetDataKey['PaymentMode'];
                    $Sr_No = filter_var(trim($allDataInSheet[$i][$Sr_No]), FILTER_SANITIZE_STRING);
                    $Transaction_Date = filter_var(trim($allDataInSheet[$i][$Transaction_Date]), FILTER_SANITIZE_STRING);
                    $Transaction_Id = filter_var(trim($allDataInSheet[$i][$Transaction_Id]), FILTER_SANITIZE_EMAIL);
                    $Student_Name = filter_var(trim($allDataInSheet[$i][$Student_Name]), FILTER_SANITIZE_STRING);
                    $Email_Id = filter_var(trim($allDataInSheet[$i][$Email_Id]), FILTER_SANITIZE_STRING);
                    $MobileNo = filter_var(trim($allDataInSheet[$i][$MobileNo]), FILTER_SANITIZE_STRING);
                    $Bank_Reference_No = filter_var(trim($allDataInSheet[$i][$Bank_Reference_No]), FILTER_SANITIZE_STRING);
                    $Received_Amount = filter_var(trim($allDataInSheet[$i][$Received_Amount]), FILTER_SANITIZE_STRING);
                    $Transaction_charges = filter_var(trim($allDataInSheet[$i][$Transaction_charges]), FILTER_SANITIZE_STRING);
                    $Settelment_Amount = filter_var(trim($allDataInSheet[$i][$Settelment_Amount]), FILTER_SANITIZE_STRING);
                    $Payment_Mode = filter_var(trim($allDataInSheet[$i][$Payment_Mode]), FILTER_SANITIZE_STRING);
                    /*$var = "20/04/2012";*/
					$Transaction_Date = date("Y-m-d", strtotime($Transaction_Date) );
                    $fetchData[] = array('transaction_date' => $Transaction_Date, 'transaction_id' => $Transaction_Id, 'order_id' => $Transaction_Id,
                    'student_name' => $Student_Name, 'email_id' => $Email_Id, 'mobile_no' => $MobileNo,'bank_transaction_id' => $Bank_Reference_No,
                    'gross_amount' => $Received_Amount,	'payment_gateway_charge' => $Transaction_charges,'net_amount' => $Settelment_Amount, 
                    'bank_name' => $Payment_Mode);
                }      
                /*print_r(sizeof($fetchData));
                die();   */   
                if($arrayCount <= 1)
                {
					 echo "Please enter fields in the template";
				}
				else{
					//echo"sdfdg";
					$data['employeeInfo'] = $fetchData;
	                $this->superadmin_model->setBatchImport($fetchData);
	                $this->superadmin_model->importData();
	                $this->load->view('superadmin/upload_payment_report_display', $data);
				}
                
            } else {
                echo "Please import correct file";
            }
           // $this->load->view('superadmin/upload_payment_report_display', $data);
        }
        
        
    }
	
	public function account_profile()
	{
		
		$this->load->view('template_config/admin_header');
		$data['menu_item'] = '';
		$data['menu_group'] = '';
		$data['role'] = 'superadmin';
		$this->load->view('template_config/header',$data);
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('superadmin/account/account_setting');
		$this->load->view('template_config/template_setting');
		
		//$this->load->view('template_config/admin_footer');
	}
	
	public function menuPreview()
	{
		$sidebar['menuitem'] = 'Define Menu';
		$sidebar['group'] = 'SETUP';
		$cmbrole = $this->uri->segment(3);
		$this->session->set_userdata('role', 'SUPADM');
		$data = array(
		'cmbrole'=> $cmbrole
		);
		$data['preview'] = $this->superadmin_model->superadmin($data,'get_menu_design');
		$data['title'] = "ESApplication | Preview Menu";
		$this->load->view('template_config/admin_header');
		$this->load->view('superadmin/menuPreview',$data);
		//$this->load->view('template_config/admin_footer');

	}

	public function data_table()
	{
		
		$this->load->view('template_config/admin_header');
		$sidebar['menu_item'] = 'Demo Table';
		$sidebar['menu_group'] = 'Demo Table';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
		$this->load->view('template_config/header');
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('superadmin/datatable');
		$this->load->view('template_config/template_setting');
		//$this->load->view('template_config/admin_footer');
	}
	
}