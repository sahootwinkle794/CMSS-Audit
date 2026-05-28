<?php

class cand_apply extends CI_Controller {

function __construct() {
parent::__construct();
$this->load->model('cand_model');
}
function index() {
//Including validation library
$this->load->library('form_validation');

$this->form_validation->set_error_delimiters('<div class="error">', '</div>');


if ($this->form_validation->run() == FALSE) {
$this->load->view('template008');
} else {
//Setting values for tabel columns
$data = array(
'master_name' => $this->input->post('master_name'),
 
);
//Transfering data to Model
$this->cand_model->form_insert($data);
$data['message'] = 'Data Inserted Successfully';
//Loading View
$this->load->view('template008', $data);
}
}

}

?>