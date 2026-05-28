<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
include_once APPPATH.'/third_party/mpdf7/vendor/autoload.php';
class m_pdf {
    public $param;
	public $pdf;
	public function __construct($param = "'c', 'A4-L'")
	{
	    $this->param =$param;
	    $this->pdf = new mPDF('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P'); 
	    //new mPDF($this->param);
	}
	public function get_mpdf(){
		return new mPDF('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P'); 
	}
	
}