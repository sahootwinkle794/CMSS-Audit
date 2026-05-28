<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Server_response extends CI_Controller
{
	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper(array('form'));		
		$this->load->helper('custom_encryption');		
		$this->load->helper('custom_security');
	    # models
		$this->load->model('payment_model');
	}
	public function index() {
		//$_POST = Array ( 'msg' => 'SVNIRTAR|NIRPROG1_NIRTAR2018000011|LCIT6187782690|662155-822616|2.00|CIT|510372|03|INR|DIRECT|NA|NA|00000000.00|03-04-2018 19:07:20|0300|NA|NIRPROG1NIRTAR1811|NA|NA|NA|NA|NA|NA|NA|Success|BC60A8B9D338EB43E0566ACE184C078EE738A24AB8B2E3B7E6A99BA0980649F9', 'hidRequestId' => 'PGIBL1000', 'hidOperation' => 'B101' ); 
		$data['update_status'] = $this->payment_model->payment($_POST, 'billdesk_payment_serverside_response');
        $this->load->view('pg_billdesk/server_response'); //load the pdf_output.php by passing our data and get all data in $html varriable.
      
    }      
}