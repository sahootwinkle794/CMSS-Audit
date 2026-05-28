<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mpdf_controller extends CI_Controller
{
	public function __construct()
	{
	    parent::__construct();
	    // Clickjacking Attack
		$this->output->set_header('X-FRAME-OPTIONS: DENY'); 
		('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
	    
	}
	
	public function template004_pdf() {
		//$admcode = $this->session->userdata('admcode');
		$url_data = $this->uri->uri_to_assoc();
		$admcode = $url_data['program'];
		$admcode =str_replace('`','/',$admcode);
		//echo $program;die();
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template001_pdf($admcode, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template001_pdf($admcode, 'get_applicant_detail');
      /*  print_r($data['applicant_detail']);return;*/
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
		$data['multiple_post'] = $this->m_pdf_model->template001_pdf($admcode,'get_post'); 
		
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
		$pdf->Output($applicantNumber.".pdf",'I');
		return true;
    } 
	
	public function template001_pdf() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
        $url_data = $this->uri->uri_to_assoc();
		$program = $url_data['program'];
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
		chmod($uploaddir.'/application_print.pdf',0777);	
		$pdf->Output($applicantNumber.".pdf",'I');
		return true;
    }  

	public function template002_pdf() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
        $url_data = $this->uri->uri_to_assoc();
		$program = $url_data['program'];
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
        $data['declaration_data'] = $this->m_pdf_model->template001_pdf($program, 'get_declaration_data');
        $data['program_data'] = $this->m_pdf_model->template001_pdf($program, 'get_program_details');
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
		$data['work_experience'] = $this->m_pdf_model->template001_pdf($program,'get_work_experience');
		$data['total_experience'] = $this->m_pdf_model->template001_pdf($program,'get_total_experience');
		$data['postwise_experience'] = $this->m_pdf_model->template001_pdf($program,'get_postwise_experience');
		
		$data['challandetails'] = $this->m_pdf_model->template001_pdf($program,'get_challandetails');
		$data['appl_status'] = $this->m_pdf_model->template001_pdf($program,'get_appl_status');
		
		
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
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		chmod($uploaddir.'/application_print.pdf',0777);	
		$pdf->Output($applicantNumber.".pdf",'I');
		return true;
    }  
	
	public function admit_card() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        
        //$program_code = $this->session->userdata('admcode');ECHO ("HI");DIE();
		$exam_centre_code = $this->session->userdata('exam_center_code');
		$exam_vanue = $this->session->userdata('exam_vanue_code');
		$reg_user_id = $this->session->userdata('reg_user_id');
		
		$appl_no = $this->session->userdata('appl_no');
		
		$from = '';
		$to = '';
		$program_code = $this->uri->segment(4); // 1stsegment
		/*$exam_centre_code = $this->uri->segment(4); // 2ndsegment
		$exam_vanue = $this->uri->segment(5); // 3rdsegment
		$from = $this->uri->segment(6); // 4thsegment
		$to = $this->uri->segment(7); // 5thsegment*/
		$data = array(
            'program_code' => $program_code,
           /* 'assigned_exam_center_code' => $exam_centre_code,
            'exam_vanue' => $exam_vanue,*/
            'reg_user_id' => $reg_user_id,
            'appl_no' => $appl_no
			
        );
        //print_r($data);die();
        $data['applicantSRow'] = $this->m_pdf_model->admit_card_pdf($data,'get_application_detail_individual');
        //print_r($data['applicantSRow']);die();
        $data['type'] = "ADMIT_CARD";
                
		$html = $this->load->view('pdf/admit_card', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        
        $pdfFilePath = "admit_card_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
       // $pdf = $this->m_pdf->load();
        $pdf = $this->m_pdf->pdf;
		/*$pdf->SetWatermarkImage(base_url().'upload/image/Cipet_logo_hd.png');
 		$pdf->showWatermarkImage = true;*/
        //generate the PDF!
        $pdf->WriteHTML($html);
        
        $data['type'] = "FOOTER";
        $html = $this->load->view('pdf/admit_card', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
      	$pdf->defaultfooterline = 0;
		$pdf->setFooter($footer);
      	$pdf->WriteHTML($html);        
      	
		//$uploaddir = DOCUMENT_UPLOAD_URL.'/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		
		//$this->load->view('pdf/template008_pdf');	
		$pdf->Output("Admit_Card.pdf",'I');	
		//return true;*/
    } 
	public function rank_card() {
		$url_data = $this->uri->uri_to_assoc();
		$app_reg_user_id = isset($url_data['reg_user_id'])?$url_data['reg_user_id']:'';
		$app_prog = $url_data['app_prog'];
		$reg_user_id = $app_reg_user_id!=''?$app_reg_user_id:$this->session->userdata('reg_user_id');
		if($reg_user_id==''){
			$this->session->set_flashdata('error', $data['msg']);
			redirect($this->agent->referrer());
		}
		$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('utf-8','A4', 0, 'mangal', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
		$data = array(
            'reg_user_id' => $reg_user_id,           
            'applied_program' => $app_prog           
        );
       		if($this->session->userdata('reg_user_id')!='' &&$app_reg_user_id==''){
				$this->m_pdf_model->application_data($data,'store_download_status');
			}
        
	        $data['applicant_data'] = $this->m_pdf_model->application_data($data,'get_rank_detail');
	       // $data['applicant_subject'] = $this->m_pdf_model->certificate_data($data,'get_certi_sub_detail');
	        //print_r( $data['applicantSRow']);die();
	        //$data['type'] = "CERTIFICATE";
	        /*if(sizeOf($data['applicant_data'])==0){
		        $this->session->set_flashdata('error', $data['msg']);
				redirect($this->agent->referrer());
	        } */    
			$html = $this->load->view('pdf/download_letter', $data,true); //load the pdf_output.php by passing our data and get all data in $html varriable.
	        
	        $pdfFilePath = $reg_user_id."_counsilling_letter_pdf-" . time() . "-download.pdf";
			
	        $pdf = $this->m_pdf->pdf;
	        //to set watermark
	        $pdf->SetWatermarkImage(base_url().'upload/image/Cipet_year_logo.jpg');
 			$pdf->showWatermarkImage = true;
 			//to set html header and footer
 			$pdf->SetHTMLHeader('<img src="' . base_url() . 'upload/image/cipet_rankcard_header.JPG"/>');

    		$pdf->SetHTMLFooter('<img src="' . base_url() . 'upload/image/cipet_rankcard_footer.JPG"/>');
    		//to set page design
    		$pdf->AddPage('', // L - landscape, P - portrait 
		        '', '', '', '',
		        10, // margin_left
		        10, // margin right
		       50, // margin top
		       20, // margin bottom
		        0, // margin header
		        0); // margin footer
	        //generate the PDF!
	        $pdf->WriteHTML($html);
	       
			$pdf->Output($pdfFilePath, 'I');
		
    } 

	public function template008_pdf() {
		
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
        $url_data = $this->uri->uri_to_assoc();
		//$app_prog = $url_data['app_prog'];
		$app_prog = '';
		$program = $url_data['program'];
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	//echo $program ; die();
     // 	$this->load->library('m_pdf', $params);
      	$this->load->library('m_pdf', $params);
      	
        $this->load->model('m_pdf_model');
        
        $data['application_data'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template008_pdf($program, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_other_board');
        $data['applicant_documents'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_applicant_documents');
        $data['examcenter'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_exam_center');
        $data['othernationality'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_other_nationality');
        $data['type'] = "TOP";
        
$html = $this->load->view('pdf/template008_pdf', $data,true); //load the pdf_output.php by passing our data and get all data in $html varriable.
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
$pdf->Output($uploaddir.'/application_print_008.pdf', 'F');
		chmod($uploaddir.'/application_print_008.pdf',0777);	
$pdf->Output($applicantNumber.".pdf",'I');
		return true;
    }     
	
	public function merit_list_pdf() {
		
     	
		$appl_no = $this->uri->segment(4); 
		$round_no = $this->uri->segment(3); 
		$program_code = $this->uri->segment(5);
		
		$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('utf-8','A4', 0, 'mangal', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
		$data = array(
            'reg_user_id' => $reg_user_id,           
            'applied_program' => $program_code ,        
            'round_no' => $round_no           
        );
   		if($this->session->userdata('reg_user_id')!='' &&$app_reg_user_id==''){
			$this->m_pdf_model->application_data($data,'store_download_status');
		}
    
        $data['applicant_data'] = $this->m_pdf_model->application_data($data,'get_merit_detail');
        $data['appiontment_data'] = $this->m_pdf_model->application_data($data,'get_appointment_detail');
         
		$html = $this->load->view('pdf/appointment_letter_pdf', $data,true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        //echo $html;die();
        $pdfFilePath = $appl_no."_appointment_letter_pdf-" . time() . "-download.pdf";
		
        $pdf = $this->m_pdf->pdf;
       
       
        $pdf->WriteHTML($html);
       
		$pdf->Output($pdfFilePath, 'I');
		
    } 
	public function merit_list_bulk_pdf() {
		
     	$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('utf-8','A4', 0, 'mangal', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $reg_user_id = $_SESSION['reg_user_id'];
		$program_code = $this->uri->segment(3);
		$round_no = $this->uri->segment(4); 
		$from = $this->uri->segment(5); // 4thsegment
		$to = $this->uri->segment(6);
		/*echo $round_no ;return;*/
		 $ins = $_SESSION['institute_code'];
		$data = array(
            'applied_program' => $program_code,
            'round_no' => $round_no,
            'from' => $from,
            'to' => $to,
            'reg_user_id' => $reg_user_id
        );
   		if($this->session->userdata('reg_user_id')!='' &&$app_reg_user_id==''){
			$this->m_pdf_model->application_data($data,'store_download_status');
		}
    
        $data['applicantSRow'] = $this->m_pdf_model->application_data($data,'get_merit_detail_1');
        //$data['appiontment_data'] = $this->m_pdf_model->application_data($data,'get_appointment_detail');
        $appiontment_data = $this->m_pdf_model->application_data($data,'get_appointment_detail');
        //print_r($data['appiontment_data']);return;
       	$html='';
        $mpdf = $this->m_pdf->pdf;
        $applicantSRow = array();
        $counter = 0;
        $appl_count = sizeof($data['applicantSRow']);
        //print_r($data['applicantSRow']);die();
        foreach($data['applicantSRow'] as $applicantRow)
		{
			$applicantSRow['applicant_data'] = $applicantRow;
			$applicantSRow['appiontment_data'] = $appiontment_data;
			$html = $this->load->view('pdf/appointment_letter_pdf', $applicantSRow,true); //load the pdf_output.php by passing our data and get all data in $html varriable.
	        $counter++;
	        $mpdf->WriteHTML($html);
    		if($counter < $appl_count)
		        $mpdf->AddPage();
	       
        }
		//$html = $this->load->view('pdf/appointment_letter_pdf', $data,true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        
        $pdfFilePath = $appl_no."_appointment_letter_pdf-" . time() . "-download.pdf";
		
        //$pdf = $this->m_pdf->pdf;
        
        //$pdf->WriteHTML($html);
        
       
		$mpdf->Output($pdfFilePath, 'I');
		
    } 

}