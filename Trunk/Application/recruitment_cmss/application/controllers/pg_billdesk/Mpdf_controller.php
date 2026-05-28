<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mpdf_controller extends CI_Controller
{
	public function __construct()
	{
	    parent::__construct();
	    
	}
	public function template008_pdf() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
        $url_data = $this->uri->uri_to_assoc();
		$app_prog = $url_data['app_prog'];
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['application_data'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_application_detail');
        $data['applicant_detail'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_applicant_detail');
        $data['applicant_father'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_applicant_father');
        $data['applicant_mother'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_applicant_mother');
        $data['qualification_detail'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_qualification_details');
        $data['fetchInst'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_institute_details');
        $data['addressDetail'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_present_address');
        $data['addressDetail2'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_permanent_address');
        $data['paymentDetail'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_payment_detail');
        $data['otherDetail'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_other_information');
        $data['otherDistrict'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_other_district');
        $data['otherpresentstate'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_other_p_state');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_other_p_district');
        $data['otherpresentdistrict'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_other_board');
        $data['othernationality'] = $this->m_pdf_model->template008_pdf($app_prog, 'get_other_nationality');
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
		$this->load->view('pdf/template008_pdf');	
		$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    }      
}