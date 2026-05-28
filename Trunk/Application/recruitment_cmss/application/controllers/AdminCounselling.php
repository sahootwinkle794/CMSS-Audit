<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AdminCounselling extends CI_Controller
{
	public function __construct() 
	{
		parent::__construct();
		# helpers
		/*$this->load->helper(array('form'));
		# libraries
		$this->load->library('form_validation');
		$this->load->library('user_agent');
		$this->role = $this->session->userdata('role');
		# models
		$this->load->model('adminCounselling_model');
		$this->load->model('getter_model');
		$this->load->model('user_model');
		$this->load->model('setting_model');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');*/	
		# models
		$this->load->model('superadmin_model');
		$this->load->model('adminCounselling_model');
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
		if( !in_array($role, array('ADM','ADM1','CENTERADM','COUNTERADM','VERADM')) )
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
	/*public function dashboard()
	{
		//echo 'hi';die();
		$sidebar['menuitem'] = 'DASHBOARD';
		$sidebar['group'] = 'DASHBOARD';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
		$data['all_program_list'] = $this->adminCounselling_model->admin_counselling(NULL,'get_all_program_list');
		$data['active_program_list'] = $this->adminCounselling_model->admin_counselling(NULL,'get_active_program_list');
		$data['uploaded_document_list'] = $this->adminCounselling_model->admin_counselling(NULL,'get_uploaded_document_list');
		$data['online_paid_list'] = $this->adminCounselling_model->admin_counselling(NULL,'get_online_paid_list');
		
		//die();
		$data['challan_verified_list'] = $this->adminCounselling_model->admin_counselling(NULL,'get_challan_verified_list');
		$data['SCST_list'] = $this->adminCounselling_model->admin_counselling(NULL,'get_SCST_list');
		$data['OnCounter_list'] = $this->adminCounselling_model->admin_counselling(NULL,'get_OnCounter_list');
		
		//$data['inactive_institute_list'] = $this->superadmin_model->superadmin(NULL,'get_inactive_institute_list');
		//$data['get_users'] = $this->superadmin_model->superadmin(NULL,'get_users');
		//$data['get_user_loggedin'] = $this->superadmin_model->superadmin(NULL,'get_user_loggedin');
		//$data['total_collection'] = $this->superadmin_model->superadmin(NULL,'total_collection');
		//$this->load->view('template_config/admin_header');
		
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('admin_counselling/dashboard',$data);
		$this->load->view('template_config/admin_footer');
	}*/
	
	public function dashboard()
	{
		/*echo "ghjkjnkljnkl";
		die();*/
		$sidebar['menuitem'] = 'DASHBOARD';
		$sidebar['group'] = 'DASHBOARD';
		
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
		
		/*$data['only_registred'] = $this->adminCounselling_model->admin_counselling(NULL,'only_registred');
		$data['application_count'] = $this->adminCounselling_model->admin_counselling(NULL,'application_count');
		
		$data['scrutiny_count'] = $this->adminCounselling_model->admin_counselling(NULL,'scrutiny_count');*/
		
		//print_r($data['scrutiny_count']);
		
		$this->load->view('template_config/sidebar',$sidebar);
		$this->load->view('admin_counselling/dashboard');
		$this->load->view('template_config/admin_footer');
	}
	
	public function communication_setup()
	{
		$sidebar['menuitem'] = 'Communication';
  		$sidebar['group'] = 'PROGRAM SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/communication_setup');
  		$this->load->view('template_config/admin_footer');
		
	}
	public function admitcard_applicant(){
		$program_code = $this->uri->segment(3); // 1stsegment
		$exam_centre = $this->uri->segment(4); // 2ndsegment
		$date = $this->uri->segment(5); // 3rdsegment
		$data = array(
            'program_code' => $program_code,
            'exam_centre' => $exam_centre,
            'applied_date' => $date
        );
        $this->load->view('admin_counselling/admitcard_applicant',$data);
        //$validate = $this->adminCounselling_model->admin_counselling($data,'applicants_admit_setup');
	}
	public function admitcard_assigned_applicant(){
		$program_code = $this->uri->segment(3); // 1stsegment
		$exam_centre_code = $this->uri->segment(4); // 2ndsegment
		$exam_vanue = $this->uri->segment(5); // 3rdsegment
		$data = array(
            'program_code' => $program_code,
            'assigned_exam_center_code' => $exam_centre_code,
            'exam_vanue' => $exam_vanue
        );
        $this->load->view('admin_counselling/admitcard_assigned_applicant',$data);
        //$validate = $this->adminCounselling_model->admin_counselling($data,'applicants_admit_setup');
	}
	public function admitcard_published_applicants(){
		$program_code = $this->uri->segment(3); // 1stsegment
		$exam_centre_code = $this->uri->segment(4); // 2ndsegment
		$exam_vanue = $this->uri->segment(5); // 3rdsegment
		$data = array(
            'program_code' => $program_code,
            'assigned_exam_center_code' => $exam_centre_code,
            'exam_vanue' => $exam_vanue
        );
        $this->load->view('admin_counselling/admitcard_published_applicants',$data);
        //$validate = $this->adminCounselling_model->admin_counselling($data,'applicants_admit_setup');
	}
	public function program()
	{
		$sidebar['menuitem'] = 'PROGRAM';
  		$sidebar['group'] = 'COUNSELLING';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/program');
  		$this->load->view('template_config/admin_footer');
		
	}
	public function upload_program_branch_institute_seat()
	{
		$this->load->view('admin_counselling/upload_program_branch_institute_seat');
	}
	public function excel_program_branch_institute_seat(){
		/*$program_code = $this->uri->segment(3); // 1stsegment
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
        );*/
        $this->load->library('excel');
		require_once './application/third_party/phpexcel/PHPExcel.php';
		require_once './application/third_party/phpexcel/PHPExcel/IOFactory.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true)->setSize(14)->getColor()->applyFromArray(array("rgb" =>'BLACK'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$F=$objPHPExcel->getActiveSheet();

		$F->getColumnDimension('B')->setAutoSize(TRUE);
		$F->getColumnDimension('C')->setAutoSize(TRUE);
		$F->getColumnDimension('D')->setAutoSize(TRUE);
		
		$Line=1;
		$F->setCellValue('A'.$Line,'Slno')
			->setCellValue('B'.$Line,'Program')
			->setCellValue('C'.$Line,'Category')
			->setCellValue('D'.$Line,'No. of Seats');
			++$Line;
		$slno = 1;
		//$objDrawing = new PHPExcel_Worksheet_Drawing();
		$photo = "";
		$signature = "";
		$data = "";
		
		$data_excel1 = $this->adminCounselling_model->excel_program_branch_institute_seat($data);
		//$validate = $this->adminCounselling_model->excel1_report_admit_card($data);
		
		foreach ($data_excel1 as $value)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$Line, $slno);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$Line, $value->branch);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$Line, $value->category_code);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$Line, '');
			++$Line;
			$slno++;
		}
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Applicantlist.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		
	}
	
	public function save_programBranchInstituteSeat() {
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
            $createArray = array('Slno','Program', 'Category','No.ofSeats');
            $makeArray = array('Slno' => 'Slno', 'Program' => 'Program', 'Category' => 'Category', 
            					'No.ofSeats' => 'No.ofSeats');
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
          	/*print_r($data);
          	die();*/
          	$matches = 0;
          	$validate_seats = $SheetDataKey['No.ofSeats'];
          	for ($i = 2; $i <= $arrayCount; $i++) {
	          	$NoOfSeats = filter_var(trim($allDataInSheet[$i][$validate_seats]), FILTER_SANITIZE_STRING);
	          	//print_r($NoOfSeats);
				$regex = '/^\d+$/';
				$cnt = 0;
				
				//echo $NoOfSeats;
				if($NoOfSeats < 0)
				{
					$cnt++;
					$matches = $cnt;
				}
				
				
				
			}
			//echo $matches;
			
			
            if (empty($data)) {
                $flag = 1;
            }
            if($matches > 0)
			{
				$flag = -1;
			}
            /*echo $flag;
            die();*/
            //echo $arrayCount;
            if ($flag == 1) {
                for ($i = 2; $i <= $arrayCount; $i++) {
                    $addresses = array();
                    $Slno = $SheetDataKey['Slno'];
                    $Program = $SheetDataKey['Program'];
                    $Category = $SheetDataKey['Category'];
                    $NoOfSeats = $SheetDataKey['No.ofSeats'];
                    $Slno = filter_var(trim($allDataInSheet[$i][$Slno]), FILTER_SANITIZE_STRING);
                    $Program = filter_var(trim($allDataInSheet[$i][$Program]), FILTER_SANITIZE_STRING);
                    $Category = filter_var(trim($allDataInSheet[$i][$Category]), FILTER_SANITIZE_EMAIL);
                    $NoOfSeats = filter_var(trim($allDataInSheet[$i][$NoOfSeats]), FILTER_SANITIZE_STRING);
					
                    $fetchData[] = array('Slno' => $Slno, 'Program' => $Program, 'category_code' => $Category,
                    'no_of_seats' => $NoOfSeats);
                }      
                /*print_r($fetchData);
                die();*/        
                $data['employeeInfo'] = $fetchData;
                $this->adminCounselling_model->setBatchImport($fetchData);
                $this->adminCounselling_model->importData();
            } else if($flag == 0){
                echo "Please import correct file";
            }
            else if($flag == -1)
            {
				echo "No. Of Seats Should Be Integer Values Only";
			}
           // $this->load->view('superadmin/upload_payment_report_display', $data);
        }
        $this->load->view('admin_counselling/upload_program_branch_institute_seat_display', $data);
        
    }
    
	public function sheet_matrix()
	{
		$sidebar['menuitem'] = 'SEAT MATRIX';
  		$sidebar['group'] = 'COUNSELLING';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/sheet_matrix');
  		$this->load->view('template_config/admin_footer');
		
	}
	
	public function generic_setup()
	{
		$sidebar['menuitem'] = 'GENERIC SETUP';
  		$sidebar['group'] = 'COUNSELLING';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/generic_setup');
  		$this->load->view('template_config/admin_footer');
		
	}
	
	public function counselling_period_setup()
	{
		$sidebar['menuitem'] = 'COUNSELLING PERIOD';
  		$sidebar['group'] = 'COUNSELLING';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/counselling_period_setup');
  		$this->load->view('template_config/admin_footer');
		
	}
	
	public function nodal_centre_setup()
	{
		$sidebar['menuitem'] = 'NODAL CENTRE SETUP';
  		$sidebar['group'] = 'COUNSELLING';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/nodal_centre_setup');
  		$this->load->view('template_config/admin_footer');
	}
	
	public function counselling_setup()
	{
		$sidebar['menuitem'] = 'COUNSELLING SETUP';
  		$sidebar['group'] = 'COUNSELLING';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/counselling_setup');
  		$this->load->view('template_config/admin_footer');
	}
	
	public function candidate_list()
	{
		$sidebar['menuitem'] = 'CANDIDATE LIST';
  		$sidebar['group'] = 'COUNSELLING';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/candidate_list');
  		$this->load->view('template_config/admin_footer');
	}
	
	public function saveApplicantDetails() {
        $this->load->library('excel');
        $data = '';
        if ($this->input->post('importfile')) {
        	
            $path = ROOT_UPLOAD_IMPORT_PATH.'/';
 
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls';
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
            $createArray = array('JEERollNo', 'FullName','Course', 'ExamCenter','DOB','MobileNo',
			                      'Gender','Category','MarkObtained','Final_Year_%age','UG_%age',
			                     'NE','PH','CommonRank','GeneralRank','OBCRank','SCRank','STRank','NERank','PHRank');
            $makeArray = array('JEERollNo' => 'JEERollNo', 'FullName' => 'FullName','Course' => 'Course',
            					'ExamCenter' => 'ExamCenter','DOB' => 'DOB', 'MobileNo' => 'MobileNo',
            					'Gender' => 'Gender', 'Category' => 'Category','MarkObtained'=>'MarkObtained',
								'Final_Year_%age' => 'Final_Year_%age','UG_%age' => 'UG_%age',
								'NE' => 'NE','PH' => 'PH','CommonRank' => 'CommonRank',
								'GeneralRank' => 'GeneralRank','OBCRank' => 'OBCRank','SCRank' =>'SCRank','STRank' => 'STRank',
            					'NERank'=>'NERank','PHRank' => 'PHRank' );
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
          	/*print_r($data);
          	die();*/
            if (empty($data)) {
                $flag = 1;
            }
            if ($flag == 1) {
                for ($i = 2; $i <= $arrayCount; $i++) {
                    $JEERollNo = $SheetDataKey['JEERollNo'];
                    $FullName = $SheetDataKey['FullName'];
					$Course = $SheetDataKey['Course'];
					$ExamCenter = $SheetDataKey['ExamCenter'];
                    $DOB = $SheetDataKey['DOB'];
                    $MobileNo = $SheetDataKey['MobileNo'];
                    $Gender = $SheetDataKey['Gender'];
                    $Category = $SheetDataKey['Category'];
                    $MarkObtained = $SheetDataKey['MarkObtained'];
                    $Final_Year_percentage = $SheetDataKey['Final_Year_%age'];
                    $UG_percentage = $SheetDataKey['UG_%age'];
                    $NE = $SheetDataKey['NE'];
                    $PH = $SheetDataKey['PH'];
                    $CommonRank = $SheetDataKey['CommonRank'];
                    $GeneralRank = $SheetDataKey['GeneralRank'];
                    $OBCRank = $SheetDataKey['OBCRank'];
                    $SCRank = $SheetDataKey['SCRank'];
                    $STRank = $SheetDataKey['STRank'];
                    $PHRank = $SheetDataKey['PHRank'];
                    $NERank = $SheetDataKey['NERank'];
                   
                    $JEERollNo = filter_var(trim($allDataInSheet[$i][$JEERollNo]), FILTER_SANITIZE_STRING);
                    $FullName = filter_var(trim($allDataInSheet[$i][$FullName]), FILTER_SANITIZE_STRING);
					$Course = filter_var(trim($allDataInSheet[$i][$Course]), FILTER_SANITIZE_STRING);
					$ExamCenter = filter_var(trim($allDataInSheet[$i][$ExamCenter]), FILTER_SANITIZE_STRING);
                    $DOB = filter_var(trim($allDataInSheet[$i][$DOB]), FILTER_SANITIZE_STRING);
                    $MobileNo = filter_var(trim($allDataInSheet[$i][$MobileNo]), FILTER_SANITIZE_STRING);
                    $Gender = filter_var(trim($allDataInSheet[$i][$Gender]), FILTER_SANITIZE_STRING);
                    $Category = filter_var(trim($allDataInSheet[$i][$Category]), FILTER_SANITIZE_STRING);
                    $MarkObtained = filter_var(trim($allDataInSheet[$i][$MarkObtained]), FILTER_SANITIZE_STRING);
                    $Final_Year_percentage = filter_var(trim($allDataInSheet[$i][$Final_Year_percentage]), FILTER_SANITIZE_STRING);
                    $UG_percentage = filter_var(trim($allDataInSheet[$i][$UG_percentage]), FILTER_SANITIZE_STRING);
                    $NE = filter_var(trim($allDataInSheet[$i][$NE]), FILTER_SANITIZE_STRING);
                    $PH = filter_var(trim($allDataInSheet[$i][$PH]), FILTER_SANITIZE_STRING);
                    $CommonRank = filter_var(trim($allDataInSheet[$i][$CommonRank]), FILTER_SANITIZE_STRING);
                    $GeneralRank = filter_var(trim($allDataInSheet[$i][$GeneralRank]), FILTER_SANITIZE_STRING);
                    $OBCRank = filter_var(trim($allDataInSheet[$i][$OBCRank]), FILTER_SANITIZE_STRING);
                    $SCRank = filter_var(trim($allDataInSheet[$i][$SCRank]), FILTER_SANITIZE_STRING);
                    $STRank = filter_var(trim($allDataInSheet[$i][$STRank]), FILTER_SANITIZE_STRING);
                    $PHRank = filter_var(trim($allDataInSheet[$i][$PHRank]), FILTER_SANITIZE_STRING);
                    $NERank = filter_var(trim($allDataInSheet[$i][$NERank]), FILTER_SANITIZE_STRING);
                    
                    //$a = "04-05-1982";
					//$DOB = date('d-m-Y' , strtotime($a));
					//echo $DOB;
					$DOB = date('Y-m-d', strtotime($DOB) );
					//echo $DOB;
					//echo $FullName;
					//die();
					
                    $fetchData[] = array('jee_roll_no' => $JEERollNo, 'full_name' => $FullName,'course' => $Course,'exam_center_code' =>$ExamCenter, 'dob' => $DOB,'applicant_mobile' => $MobileNo,
                    'gender' => $Gender, 'category' => $Category,'mark_obtained' => $MarkObtained,'final_year_percentage' => $Final_Year_percentage,
					'ug_percentage' => $UG_percentage,'ph' =>$PH,'ne' =>$NE,'rank' => $CommonRank,'rank1' => $GeneralRank,'rank2' => $OBCRank,
                    'rank3' => $SCRank,'rank4' => $STRank,'rank5' => $PHRank,'rank6' => $NERank);
                    
                }      
                /*print_r($fetchData);
                die();*/        
                $data['applicantInfo'] = $fetchData;
                $this->adminCounselling_model->setBatchImport($fetchData);
                $this->adminCounselling_model->importApplicantsData();
            } else {
                echo "Please import correct file";
            }
           // $this->load->view('superadmin/upload_payment_report_display', $data);
        }
        $this->load->view('admin_counselling/upload_candidate_list', $data);
        
    }
	
	public function allotment()
	{
		$sidebar['menuitem'] = 'STUDENTS ALLOTMENT';
  		$sidebar['group'] = 'COUNSELLING';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/allotment');
  		$this->load->view('template_config/admin_footer');
	}
	
	public function attendance()
	{
		$sidebar['menuitem'] = 'STUDENTS ATTENDANCE';
  		$sidebar['group'] = 'COUNSELLING';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/attendance');
  		$this->load->view('template_config/admin_footer');
	}
	
	public function students_verification()
	{
		$sidebar['menuitem'] = 'STUDENTS VERIFICATION';
  		$sidebar['group'] = 'COUNSELLING';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/students_verification');
  		$this->load->view('template_config/admin_footer');
	}
	
	public function final_allotment()
	{
		$sidebar['menuitem'] = 'FINAL ALLOTMENT';
  		$sidebar['group'] = 'COUNSELLING';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/final_allotment');
  		$this->load->view('template_config/admin_footer');
	}
	
	public function excel_valid_students(){
		$counselling_code = $this->uri->segment(3); // 1stsegment
		$data = array(
            'counselling_code' => $counselling_code
        );
        $this->load->library('excel');
		require_once './application/third_party/phpexcel/PHPExcel.php';
		require_once './application/third_party/phpexcel/PHPExcel/IOFactory.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		//$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true)->setSize(14)->getColor()->applyFromArray(array("rgb" =>'BLACK'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$F=$objPHPExcel->getActiveSheet();

		/*$F->getColumnDimension('B')->setAutoSize(TRUE);
		$F->getColumnDimension('C')->setAutoSize(TRUE);
		$F->getColumnDimension('D')->setAutoSize(TRUE);*/
		
		$Line=1;
		$F->setCellValue('A'.$Line,'JEE Roll No')
			->setCellValue('B'.$Line,'Name');
			++$Line;
		$slno = 1;
		
		$header_data = $this->adminCounselling_model->excel_valid_students_header($data);
		$categories = $header_data['categories'];
		$choices = $header_data['count'];
		//$validate = $this->adminCounselling_model->excel1_report_admit_card($data);
		$col = 2;
		$excel_row = 1;
		$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '496CAD'))))->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'ffffff'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW;
		foreach ($categories as $value)
		{
			$F->setCellValueByColumnAndRow($col, $excel_row,$value['category_name'].' Rank');
			$val = chr(64 + ($col+1));
			$objPHPExcel->getActiveSheet()->getStyle($val.($excel_row-1).":" .$val.$excel_row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '496CAD'))))->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'ffffff'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW;
			//->getStyle($col, $excel_row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '496CAD'))))->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'ffffff'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW;
			/*$objPHPExcel->getActiveSheet()->setCellValue($col, $excel_row,$value->category_name);*/
			$col++;
		}
		for($i = 1;$i <= $choices; $i++)
		{
			$F->setCellValueByColumnAndRow($col, $excel_row,'Choice '.$i);
			$val = chr(64 + ($col+1));
			$objPHPExcel->getActiveSheet()->getStyle($val.($excel_row-1).":" .$val.$excel_row)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => '496CAD'))))->getFont()->setBold(true)->setSize(16)->getColor()->applyFromArray(array("rgb" =>'ffffff'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW;
			$col++;
		}
		for($j = 0; $j < $col; $j++) 
		{
		    $F->getColumnDimensionByColumn($j)->setAutoSize(true);
		}
		$excel_row++;
		$students_data = $this->adminCounselling_model->excel_valid_students($data);
		$categories = $students_data['categories'];
		$category_names = $students_data['category_names'];
		
		$student_arr = $students_data['student_data'];
		$ranks = $students_data['ranks'];
		/*print_r($ranks[0]['ranks']);
		die();*/
		$students = 0;
		$col = 0;
		if(!empty($student_arr))
		{
			foreach($student_arr as $row)
			{
				$student_details = array();
				$student_details[] = $slno;
				$student_details[] = $row['jee_roll_no'];
				$student_details[] = $row['full_name'];
				$F->setCellValueByColumnAndRow($col, $excel_row,$row['jee_roll_no']);
				$col++;
				$F->setCellValueByColumnAndRow($col, $excel_row,$row['full_name']);
				$col++;
				foreach($categories as $row2)
				{
					$category_arr = explode('@',$row2['description']);
				}
				$rank_arr = explode('@',$ranks[$students]['ranks']);
				print_r($rank_arr);
				/*print_r($rank_arr);
				die();*/
				//$cat = 0;
				foreach($category_names as $row1)
				{
					/*foreach($categories as $row2)
					{
						$category_arr = explode('@',$row2['description']);
					}*/
					//$category_arr = explode('@',$categories[$cat]['description']);
					if(in_array($row1['category_code'],$category_arr))
					{
						$key = array_search($row1['category_code'], $category_arr);
						print_r($rank_arr);
						die();
						$rank= array_key_exists($key,$rank_arr)?$rank_arr[$key]:'';
						$F->setCellValueByColumnAndRow($col, $excel_row,$rank);
						$col++;
						//$student_details[] ='<div style="text-align:center">'.$rank.'</div>';
					}
					else
					{
						$F->setCellValueByColumnAndRow($col, $excel_row,'');
						$col++;
						//$student_details[] = '';
					}
					//$cat++;
				}
				//print_r($student_details);
				//$output['aaData'][] = $student_details;
				$col = 0;
				$excel_row++;
				$slno++;
				/*
				
				
				
				
				
				
				
				
				$regn_no[] =  $row['regn_no'];
				$F->setCellValueByColumnAndRow($col, $excel_row,$row['regn_no']);
				$col++;
				$F->setCellValueByColumnAndRow($col, $excel_row,$row['user_display_name']);
				$col++;
				$subject_arr = explode('`',$row['subject_code']);
				$paper_arr = explode(',',$row['paper_code']);
				$grade_arr = explode(',',$row['grade']);
				foreach($header as $row1)
				{
					if(in_array($row1['subject_code'],$subject_arr))
					{
						$key = array_search($row1['subject_code'], $subject_arr);
						$grades = array_key_exists($key,$grade_arr)?$grade_arr[$key]:'';
						$F->setCellValueByColumnAndRow($col, $excel_row,$grades);
						$col++;
					}
					else
					{
						$F->setCellValueByColumnAndRow($col, $excel_row,'');
						$col++;
					}
				}
				$sgpa = $row['sgpa'];
				$sgpa_final = number_format($sgpa ,2);
				$F->setCellValueByColumnAndRow($col, $excel_row,$sgpa_final);
				$col++;
				if(array_key_exists($row['regn_no'],$cgpa_calc))
				{
					$cgpa = $cgpa_calc[$row['regn_no']];
					$cgpa_final = number_format($cgpa,2);
				}
				$F->setCellValueByColumnAndRow($col, $excel_row,$cgpa_final);
				$col = 0;
				$excel_row++;	*/
				$students++;
			}
			
		}
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Valid Students For Allotment.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		
	}
	
	
	public function nc_attendance()
	{
		$sidebar['menuitem'] = 'STUDENTS ATTENDANCE';
  		$sidebar['group'] = 'STUDENTS ATTENDANCE';
  		$order_id = 1;
  		$data['nc_nodal_centre_code'] = $this->adminCounselling_model->admin_counselling($order_id, 'nc_nodal_centre_code');
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/nc_attendance', $data);
  		$this->load->view('template_config/admin_footer');
	}
	
	public function nc_students_verification()
	{
		$sidebar['menuitem'] = 'STUDENTS VERIFICATION';
  		$sidebar['group'] = 'STUDENTS VERIFICATION';
  		$order_id = 1;
  		$data['nc_nodal_centre_code'] = $this->adminCounselling_model->admin_counselling($order_id, 'nc_nodal_centre_code');
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/nc_students_verification', $data);
  		$this->load->view('template_config/admin_footer');
	}
	
	public function attd_attendance()
	{
		$sidebar['menuitem'] = 'STUDENTS ATTENDANCE';
  		$sidebar['group'] = 'STUDENTS ATTENDANCE';
  		$order_id = 1;
  		$data['nc_nodal_centre_code'] = $this->adminCounselling_model->admin_counselling($order_id, 'attd_nodal_centre_code');
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/nc_attendance', $data);
  		$this->load->view('template_config/admin_footer');
	}
	
	public function attd_students_verification()
	{
		$sidebar['menuitem'] = 'STUDENTS VERIFICATION';
  		$sidebar['group'] = 'STUDENTS VERIFICATION';
  		$order_id = 1;
  		$data['nc_nodal_centre_code'] = $this->adminCounselling_model->admin_counselling($order_id, 'attd_nodal_centre_code');
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/nc_students_verification', $data);
  		$this->load->view('template_config/admin_footer');
	}
	
	public function ver_students_verification()
	{
		$sidebar['menuitem'] = 'STUDENTS VERIFICATION';
  		$sidebar['group'] = 'STUDENTS VERIFICATION';
  		$order_id = 1;
  		$data['ver_codes'] = $this->adminCounselling_model->admin_counselling($order_id, 'ver_codes');
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/ver_students_verification', $data);
  		$this->load->view('template_config/admin_footer');
	}
	
	public function program_menu_setup()
	{
		$sidebar['menuitem'] = 'Program Menu';
  		$sidebar['group'] = 'PROGRAM SETUP';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/program_menu_setup');
  		$this->load->view('template_config/admin_footer');
		
	}
	public function registration_field()
	{
		$sidebar['menuitem'] = 'Registration Field';
  		$sidebar['group'] = 'PROGRAM SETUP';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/registration_field');
  		$this->load->view('template_config/admin_footer');
		
	}
	public function applicant_result_details()
	{
		$sidebar['menuitem'] = 'Applicant Result Details';
  		$sidebar['group'] = 'Applicant Result Details';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/applicant_result_details');
  		$this->load->view('template_config/admin_footer');
		
	}
	

	public function profile()
	{
		$sidebar['menuitem'] = 'Profile';
  		$sidebar['group'] = 'PROGRAM SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/profile');
  		$this->load->view('template_config/admin_footer');
		
	}
	public function fee_setup()
	{
		$sidebar['menuitem'] = 'Fee';
  		$sidebar['group'] = 'PROGRAM SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/fee_setup');
  		$this->load->view('template_config/admin_footer');
		
	}
	public function applicant_list()
	{
		$sidebar['menuitem'] = 'APPLICANT LIST';
  		$sidebar['group'] = 'APPLICANT LIST';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/applicant_list');
  		$this->load->view('template_config/admin_footer');
		
	}
	
	public function registration()
	{
		$sidebar['menuitem'] = 'REGISTRATION DETAILS';
  		$sidebar['group'] = 'REGISTRATION DETAILS';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/registration');
  		$this->load->view('template_config/admin_footer');
		
	}
	public function document_setup()
	{
		$sidebar['menuitem'] = 'Document';
  		$sidebar['group'] = 'PROGRAM SETUP';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/document_setup');
  		$this->load->view('template_config/admin_footer');
		
	}
	public function payment_details()
	{
		$sidebar['menuitem'] = 'PAYMENT DETAILS';
  		$sidebar['group'] = 'PAYMENT DETAILS';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/payment_details');
  		$this->load->view('template_config/admin_footer');
		
	}
	public function scrutiny_verification()
	{
		$sidebar['menuitem'] = 'Scrutiny';
  		$sidebar['group'] = 'VERIFICATION';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/scrutiny_verification');
  		$this->load->view('template_config/admin_footer');
		
	}
	public function sbi_verification()
	{
		$sidebar['menuitem'] = 'Challan';
  		$sidebar['group'] = 'VERIFICATION';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/sbi_verification');
  		$this->load->view('template_config/admin_footer');
		
	}
	public function admitcard_setup()
	{
		$sidebar['menuitem'] = 'Setup';
  		$sidebar['group'] = 'ADMIT CARD';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/admitcard_setup');
  		$this->load->view('template_config/admin_footer');
		
	}
	public function admitcard_assign()
	{
		$sidebar['menuitem'] = 'Assign';
  		$sidebar['group'] = 'ADMIT CARD';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/admitcard_assign');
  		$this->load->view('template_config/admin_footer');
		
	}
	public function admitcard_review_publish()
	{
		$sidebar['menuitem'] = 'Review & Publish';
  		$sidebar['group'] = 'ADMIT CARD';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/admitcard_review_publish');
  		$this->load->view('template_config/admin_footer');
		
	}
	public function admitcard_report()
	{
		$sidebar['menuitem'] = 'Report';
  		$sidebar['group'] = 'ADMIT CARD';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/admitcard_report');
  		$this->load->view('template_config/admin_footer');
		
	}
	public function change_program()
	{
		$sidebar['menuitem'] = 'Registered Program';
  		$sidebar['group'] = 'CHANGE';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/change_program');
  		$this->load->view('template_config/admin_footer');
		
	}
	public function change_registered_mobile()
	{
		$sidebar['menuitem'] = 'Registered Mobile';
  		$sidebar['group'] = 'CHANGE';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/change_registered_mobile');
  		$this->load->view('template_config/admin_footer');
		
	}
	public function change_dob()
	{
		$sidebar['menuitem'] = 'Registered Date Of Birth';
  		$sidebar['group'] = 'CHANGE';
		//$data = 'hello';
		$sidebar['sidebar'] = $this->superadmin_model->superadmin($sidebar,'get_sidebar');
  		$this->load->view('template_config/sidebar',$sidebar);
  		$this->load->view('admin_counselling/change_dob');
  		$this->load->view('template_config/admin_footer');
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
		$pdf->Output($uploaddir.'/application_print.pdf', 'F');
		//$this->load->view('pdf/template008_pdf');	
		$pdf->Output($applicantNumber.".pdf",'I');	
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
						$data['institute_data'] = $this->adminCounselling_model->admin_counselling($institute,'get_institute_data');
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
									redirect('admin_counselling/apply_3/ins/'.$institute);
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
								$this->load->view('admin_counselling/template008',$data);
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
						$data['institute_data'] = $this->adminCounselling_model->admin_counselling($institute,'get_institute_data');
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
									redirect('admin_counselling/apply_4/ins/'.$institute);
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
								$this->load->view('admin_counselling/apply_3',$data);
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
						$data['institute_data'] = $this->adminCounselling_model->admin_counselling($institute,'get_institute_data');
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
									redirect('admin_counselling/apply_4');
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
								$this->load->view('admin_counselling/apply_4',$data);
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
		require_once './application/third_party/phpexcel/PHPExcel.php';
		require_once './application/third_party/phpexcel/PHPExcel/IOFactory.php';
		
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
		
		$data_excel1 = $this->adminCounselling_model->excel1_report_admit_card($data);
		//$validate = $this->adminCounselling_model->excel1_report_admit_card($data);
		
		foreach ($data_excel1 as $value)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$Line, $slno);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$Line, $value->omr_no);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$Line, $value->full_name);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$Line, $value->program_name);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$Line, $value->exam_centre_name);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$Line, $value->exam_vanue);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$Line, $value->reg_user_id);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$Line, $value->money_deposit_mode);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$Line, $value->amount);
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
		$to = $this->uri->segment(7); // 5thsegment
		$data = array(
            'program_code' => $program_code,
            'assigned_exam_center_code' => $exam_centre_code,
            'exam_vanue' => $exam_vanue,
            'from' => $from,
            'to' => $to
        );
        $this->load->library('excel');
		require_once './application/third_party/phpexcel/PHPExcel.php';
		require_once './application/third_party/phpexcel/PHPExcel/IOFactory.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true)->setSize(14)->getColor()->applyFromArray(array("rgb" =>'BLACK'));//APLLY BOLD LETTER FONT,SIZE AND COLOR FOR first ROW
		$F=$objPHPExcel->getActiveSheet();

		$F->getColumnDimension('B')->setAutoSize(TRUE);
		$F->getColumnDimension('C')->setAutoSize(TRUE);
		$F->getColumnDimension('D')->setAutoSize(TRUE);
		$F->getColumnDimension('E')->setAutoSize(TRUE);
		$F->getColumnDimension('F')->setAutoSize(TRUE);
		$F->getColumnDimension('G')->setWidth(10);
		$F->getColumnDimension('H')->setWidth(30);
		$F->getColumnDimension('I')->setAutoSize(TRUE);
		
		$Line=1;
		$F->setCellValue('A'.$Line,'Slno')
			->setCellValue('B'.$Line,'ID')
			->setCellValue('C'.$Line,'Applicant Name')
			->setCellValue('D'.$Line,'Program')
			->setCellValue('E'.$Line,'Exam Center')
			->setCellValue('F'.$Line,'Exam Venue')
			->setCellValue('G'.$Line,'Photo')
			->setCellValue('H'.$Line,'Specimen Signature')
			->setCellValue('I'.$Line,'Candidate\'s Signature');
		++$Line;
		$slno = 1;
		//$objDrawing = new PHPExcel_Worksheet_Drawing();
		$photo = "";
		$signature = "";
		
		$data_excel1 = $this->adminCounselling_model->excel2_report_admit_card($data);
		//$validate = $this->adminCounselling_model->excel1_report_admit_card($data);
		
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
		      $pho = DOCUMENT_UPLOAD_URL."/".$sel_program."/".$value->appl_no."/".$pho;
		    }
		    /*echo $pho;
		    die();*/
			if($value->signature_path != '')
		    {
		      $arr = explode('/',$value->signature_path);
		      $sign = end($arr);
		      $sign = DOCUMENT_UPLOAD_URL."/".$sel_program."/".$value->appl_no."/".$sign;
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
      	
		$uploaddir = DOCUMENT_UPLOAD_URL.'/'.$programcode.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/admit_card_print_008.pdf', 'I');
		//$this->load->view('pdf/template008_pdf');	
		/*$pdf->Output($applicantNumber.".pdf",'I');*/	
		//return true;
    } 
    public function download_application(){
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
       //$objMpdf = new Mpdf_controller();
		/*$controllerInstance = & get_instance();
		$return = $controllerInstance->*/
		$applicantNumber = $this->session->userdata('appl_no');
		
		$reg_user_id = $this->uri->segment(3); // 1stsegment
		$admcode = $this->uri->segment(4); // 2ndsegment
		
		$data = array(
            'admcode' => $admcode,
            'reg_user_id' => $reg_user_id
        );
        $this->session->set_userdata('reg_user_id',$reg_user_id);
        $this->session->set_userdata('admcode',$admcode);
		$this->template008_pdf();
       
        $reg_user_id = $this->uri->segment(3); // 1stsegment
		$admcode = $this->uri->segment(4); // 2ndsegment
		
		$data = array(
            'admcode' => $admcode,
            'reg_user_id' => $reg_user_id
        );
        $result = $this->m_pdf_model->application_data($data,'get_appln_no');
        
        
        //print_r($result['appl_no']);
        $appl_no = $result['appl_no'];
       
        $file_path = DOCUMENT_UPLOAD_URL."/".$admcode."/".$appl_no."/application_print_008.pdf";
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

	public function download_verification_application(){
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
       //$objMpdf = new Mpdf_controller();
		/*$controllerInstance = & get_instance();
		$return = $controllerInstance->*/
		
		
		$reg_user_id = $this->uri->segment(3); // 1stsegment
		$appl_no = $this->uri->segment(4); // 2ndsegment
		//$applicantNumber = $this->session->userdata('appl_no');
		/*echo $appl_no."vgbhjbj";
		die();*/
		
		$data = array(
            'reg_user_id' => $reg_user_id
        );
        $this->session->set_userdata('reg_user_id',$reg_user_id);
        $this->session->set_userdata('appl_no',$appl_no);
		$this->verification_pdf();
       
        $reg_user_id = $this->uri->segment(3); // 1stsegment
		
		$data = array(
            'reg_user_id' => $reg_user_id
        );
        //$result = $this->m_pdf_model->application_data($data,'get_appln_no');
        
        
        //print_r($result['appl_no']);
        //$appl_no = $result['appl_no'];
       
        $file_path = DOCUMENT_UPLOAD_URL."/".$appl_no."/applicant_verification_print.pdf";
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
	
	public function verification_pdf() {
		$this->load->driver('session');
     	$data = array();
        $view = '';
        $order_id = 1;
      	$params = array('c','A4', 0, 'Arial', 10, 10, 8, 5, 0, 0, 'P');
      	$this->load->library('m_pdf', $params);
        $this->load->model('m_pdf_model');
        $data['bank_data'] = $this->m_pdf_model->verification_pdf($order_id, 'get_bank_detail');
        $data['appl_status'] = $this->m_pdf_model->verification_pdf($order_id, 'get_appl_status');
        $data['nodal_centre_details'] = $this->m_pdf_model->counselling_letter_pdf($order_id, 'get_nodal_centre_details');
        $data['counselling_name'] = $this->m_pdf_model->counselling_letter_pdf($order_id, 'get_counselling_name');
        $data['institute_details'] = $this->m_pdf_model->counselling_letter_pdf($order_id, 'get_institute_details');
        $data['applicant_details'] = $this->m_pdf_model->counselling_letter_pdf($order_id, 'get_applicant_details');
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
                
		$html = $this->load->view('pdf/verification_pdf', $data,  true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        
        $pdfFilePath = "verification_pdf-" . time() . "-download.pdf";
		//actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //generate the PDF!
        $pdf->WriteHTML($html);
            
        $document_upload_url = 'test';
        $programcode = $this->session->userdata('admcode');
        $applicantNumber = $this->session->userdata('appl_no');
		$uploaddir = DOCUMENT_UPLOAD_URL.'/'.$applicantNumber;
		ob_clean();
		if(!is_dir($uploaddir))
			mkdir($uploaddir,0777,true);
		$pdf->Output($uploaddir.'/applicant_verification_print.pdf', 'F');
		//$this->load->view('pdf/template008_pdf');	
		$pdf->Output($applicantNumber.".pdf",'I');	
		return true;
    } 
}
