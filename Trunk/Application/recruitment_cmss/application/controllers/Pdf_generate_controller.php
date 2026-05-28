<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf_generate_controller extends CI_Controller
{
	//private $role;
	
	public function __construct()
	{
	    parent::__construct();
	    
	}
   	/*
	*	purpose : to check whether the method is correct or not
	*/
	
	public function template008_pdf() {
		$this->load->driver('session');
     	
        $view = '';
        $order_id = 1;
        $url_data = $this->uri->uri_to_assoc();
		//$app_prog = $url_data['app_prog'];
		//$app_prog = '';
		$program = 'DRP_CIPET';
		$reg_user_id_array = array('9425358017','9476692002');
		$applicantNumber_array =array('DRP_CIPET2018000018','DRP_CIPET2018000017');
		$app_prog = array($program,$reg_user_id_array,$applicantNumber_array);
    
   		$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
   		$this->load->library('m_pdf', $params);
      	
        $this->load->model('pdf_generete_model');
        
        for($i = 0; $i< sizeof($reg_user_id_array); $i++){
        	$data = array();
        	$app_prog1 = array($program,$reg_user_id_array[$i],$applicantNumber_array[$i]);
        	
	        $data['application_data'] = $this->pdf_generete_model->template008_pdf($app_prog1, 'get_application_detail');
	        $data['applicant_detail'] = $this->pdf_generete_model->template008_pdf($app_prog1, 'get_applicant_detail');
	        $data['applicant_father'] = $this->pdf_generete_model->template008_pdf($app_prog1, 'get_applicant_father');
	        $data['applicant_mother'] = $this->pdf_generete_model->template008_pdf($app_prog1, 'get_applicant_mother');
	        $data['qualification_detail'] = $this->pdf_generete_model->template008_pdf($app_prog1, 'get_qualification_details');
	        $data['fetchInst'] = $this->pdf_generete_model->template008_pdf($app_prog1, 'get_institute_details');
	        $data['addressDetail'] = $this->pdf_generete_model->template008_pdf($app_prog1, 'get_present_address');
	        $data['addressDetail2'] = $this->pdf_generete_model->template008_pdf($app_prog1, 'get_permanent_address');
	        $data['paymentDetail'] = $this->pdf_generete_model->template008_pdf($app_prog1, 'get_payment_detail');
	        $data['otherDetail'] = $this->pdf_generete_model->template008_pdf($app_prog1, 'get_other_information');
	        $data['otherDistrict'] = $this->pdf_generete_model->template008_pdf($app_prog1, 'get_other_district');
	        $data['otherpresentstate'] = $this->pdf_generete_model->template008_pdf($app_prog1, 'get_other_p_state');
	        $data['otherpresentdistrict'] = $this->pdf_generete_model->template008_pdf($app_prog1, 'get_other_p_district');
	        $data['otherpresentdistrict'] = $this->pdf_generete_model->template008_pdf($app_prog1, 'get_other_board');
	        $data['applicant_documents'] = $this->pdf_generete_model->template008_pdf($app_prog1, 'get_applicant_documents');
	        $data['examcenter'] = $this->pdf_generete_model->template008_pdf($app_prog1, 'get_exam_center');
	        $data['othernationality'] = $this->pdf_generete_model->template008_pdf($app_prog1, 'get_other_nationality');
	        $data['type'] = "TOP";
	        //echo '<br />';print_r($data['applicant_detail']);
			$html = $this->load->view('pdf/template008_pdf', $data,true); //load the pdf_output.php by passing our data and get all data in $html varriable.
			$pdf = $this->m_pdf->get_mpdf(); //$this->m_pdf->pdf;
			$pdf->WriteHTML($html);
			$programcode = $program;
	        $applicantNumber = $applicantNumber_array[$i];
			$uploaddir = DOCUMENT_UPLOAD_URL.'/'.$programcode.'/'.$applicantNumber;
			 		//echo $uploaddir; die();
			//ob_clean();
			//if (ob_get_length()) ob_end_clean();//ob_end_clean() 
			//ob_end_clean();
			if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
			$pdf->Output($uploaddir.'/'.$applicantNumber.'.pdf', 'F');
			chmod($uploaddir.'/'.$applicantNumber.'.pdf',0777);
			
			$pdf= "";
				
		}
			
			
    } 
	
    
   
	

}