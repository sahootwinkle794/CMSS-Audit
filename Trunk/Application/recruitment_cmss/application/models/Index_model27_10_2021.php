<?php

class index_model extends CI_model {

   // private $role;

    function __construct() {
        parent::__construct();
        $this->load->helper('date');

        if (ENVIRONMENT == 'production') {
            $this->db->save_queries = FALSE;
        }
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s', now());
        //echo $this->group_data();
    }
	

    public function index_data($data, $op, $stage = null) {
        /**
		* logic: To operate data for superadmin master setup
		* date :11/09/2017
		*/
		//echo $data;
        switch ($op) {
        	/**
			* logic: To operate data for User Master
			* case:get_user_data,add_user,edit_user,delete_user,get_role
			* author:Rahul Patro
			* date :11/09/2017
			*/
			case 'insert_omr_data':
			$newData=json_decode($data['data']); 
				//print_r($newData);echo $newData[0]->evaluation_name;die();
				$inserted_count = 0; 
				$updated_count = 0; 
				for($i=0;$i<sizeof($newData);$i++)
				{
					$evaluation_time = $newData[$i]->evaluation_name;
					$test_name = $newData[$i]->test_name;
					$class_name = $newData[$i]->class_name;
					$roll_no = $newData[$i]->roll_no;
					$scan_file_name = $newData[$i]->scan_file_name;
					$scan_file_pageno = $newData[$i]->scan_file_pageno;
					$scan_file_orientation = $newData[$i]->scan_file_orientation;
					$scan_file_success = $newData[$i]->scan_file_success;
					$reading_mode = $newData[$i]->reading_mode;
					$in_error = $newData[$i]->in_error;
					$total_marks= $newData[$i]->total_marks;
					$right_count = $newData[$i]->right_count;
					$wrong_count = $newData[$i]->wrong_count;
					$blank_count = $newData[$i]->blank_count;
					$set_code = $newData[$i]->set_code;
					$answers = $newData[$i]->answers;
					$generic_fields = $newData[$i]->generic_fields;
					$subject_names = $newData[$i]->subject_names;
					$subject_total_marks = $newData[$i]->subject_total_marks;
					$subject_right_count = $newData[$i]->subject_right_count;
					$subject_wrong_count = $newData[$i]->subject_wrong_count;
					$subject_blank_count = $newData[$i]->subject_blank_count;
					
					$this->db->select('COUNT(*) AS cnt');
					$this->db->from('sheet_table');
					$this->db->where('test_name',$test_name);
					$this->db->where('roll_no',$roll_no);
					$result = $this->db->get();
					$res = $result->result_array();
					foreach($res as $row)
					{
						$cnt = $row['cnt'];
					}
					if($cnt == '0')
					{
						$new_array = array( 
							"evaluation_name"  			=>$evaluation_time,
							"test_name"  				=>$test_name,
							"class_name"  				=>$class_name,
							"roll_no"  					=>$roll_no,
							"scan_file_name"  			=>$scan_file_name,
							"scan_file_pageno"  		=>$scan_file_pageno,
							"scan_file_orientation" 	=>$scan_file_orientation,
							"scan_file_success" 		=>$scan_file_success,
							"reading_mode" 				=>$reading_mode,
							"in_error" 					=>$in_error,
							"total_marks" 				=>$total_marks,
							"right_count" 				=>$right_count,
							"wrong_count" 				=>$wrong_count,
							"blank_count" 				=>$blank_count,
							"set_code" 					=>$set_code,
							"answers" 					=>$answers,
							"generic_fields" 			=>$generic_fields,
							"subject_names" 			=>$subject_names,
							"subject_total_marks" 		=>$subject_total_marks,
							"subject_right_count" 		=>$subject_right_count,
							"subject_wrong_count" 		=>$subject_wrong_count,
							"subject_blank_count" 		=>$subject_blank_count
						);
						$sql = $this->db->insert('sheet_table',$new_array);
						if(!$sql){
							$dbStatus = "ERROR";
							$dbMessage = "Error Inserting sheet_table";
						}
						else
						{
							$inserted_count++;
						}
						
					}
					else
					{
						$new_array = array( 
							"evaluation_name"  			=>$evaluation_time,
							"class_name"  				=>$class_name,
							"scan_file_name"  			=>$scan_file_name,
							"scan_file_pageno"  		=>$scan_file_pageno,
							"scan_file_orientation" 	=>$scan_file_orientation,
							"scan_file_success" 		=>$scan_file_success,
							"reading_mode" 				=>$reading_mode,
							"in_error" 					=>$in_error,
							"total_marks" 				=>$total_marks,
							"right_count" 				=>$right_count,
							"wrong_count" 				=>$wrong_count,
							"blank_count" 				=>$blank_count,
							"set_code" 					=>$set_code,
							"answers" 					=>$answers,
							"generic_fields" 			=>$generic_fields,
							"subject_names" 			=>$subject_names,
							"subject_total_marks" 		=>$subject_total_marks,
							"subject_right_count" 		=>$subject_right_count,
							"subject_wrong_count" 		=>$subject_wrong_count,
							"subject_blank_count" 		=>$subject_blank_count
						);
						$this->db->where('test_name',$test_name);
						$this->db->where('roll_no',$roll_no);
						$sql = $this->db->update('sheet_table',$new_array);
						if(!$sql){
							$dbStatus = "ERROR";
							$dbMessage = "Error Updating sheet_table";
						}
						else
						{
							$updated_count++;
						}
					}
					
				}
				$count = 0;
				$count = $inserted_count + $updated_count;
				$output = "The total no. of applicant result synced are :".$count;
				//echo $output;
				return $output;
			break;
			case 'get_institutes_index':
				$this->db->select('ins.*');
				$this->db->from('institute_master as ins');
				$this->db->where('ins.record_status',1);
				$this->db->order_by('ins.institute_id','asc');
				//print_r($query);
				$result = $this->db->get();/*
				echo $this->db->last_query(); die();*/
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_footer_logo':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s",now());
        		/*$id1 = $_POST['id1'];
        		$id2 = $_POST['id2'];
				*/
				$this->db->select("logo_image,logo_details,logo_url,logo_id");
				$this->db->from('dbtbl_govt_logo');
				$this->db->where('delete_status',0);/*
				$this->db->limit($id1,$id2);*/
				$result = $this->db->get();
				$query = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach($query as $aRow)
				{
					$row[0] = $slno;
					$row['sl_no'] = $slno;
					$i = 1;
					foreach($aRow as $key=>$value)
					{
						
						$row[$i] = $value;
						$row[$key] = $value;
						$i++;
					}
					
					$output['aaData'][] = $row;
					$slno++;
					unset($row);
				}
				return $output;
				//echo $this->db->last_query(); die();
				//print_r($result);
				
			break;
			case 'get_institutes':
				$this->db->select('ins.*');
				$this->db->from('institute_master as ins');
				$this->db->where('ins.record_status',1);
				$this->db->where('ins.institute_code',$data);
				$this->db->order_by('ins.institute_id','asc');
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_postname':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s",now());
        		//$data = $institute;
				$this->db->select("B.program_group_code,B.program_group_name,DATE_FORMAT(B.application_last_date,'%d-%m-%Y') AS application_last_date,GROUP_CONCAT(IFNULL(A.program_name,''),'`',IFNULL(A.program_code,''),'`',IFNULL(A.year,'')) AS program_data");
				$this->db->from('program_master A');
				$this->db->join('program_group_master B','A.program_group = B.program_group_code','LEFT');
				$this->db->where('A.institute_code',$data);
				$this->db->where('A.record_status',1);
				$this->db->where('B.record_status',1);
				$this->db->where('A.publish_status','YES');
				$this->db->where('A.program_start_date<=',$date);
				$this->db->where('A.program_end_date>=',$date);
				$this->db->group_by('program_group_code');
				$this->db->order_by('B.id','desc');
				//$this->db->where('ins.record_status',1);
				//$this->db->where('pm.program_group',$data);
				//$this->db->order_by('ins.institute_id','asc');
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_postname1':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s",now());
        		//$data = $institute;
				$this->db->select("A.id,A.program_name,A.program_code,A.year,A.apply_start_date");
				$this->db->from('program_master A');
				$this->db->where('A.institute_code',$data);
				$this->db->where('A.record_status',1);
				$this->db->where('A.publish_status','YES');
				$this->db->where('A.apply_start_date<=',$now);
				$this->db->where('A.apply_end_date>=',$now);
				$this->db->order_by('A.id','desc');
				$result = $this->db->get();
			return $result->result_array();
			break;
			case 'get_vacancy_details':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s",now());
        		$program_code=$this->input->post('program_code');
				$this->db->select("A.id,A.classification,A.ministry,A.department,A.organisation,A.pay_scale,A.age,A.desired_qualification,A.duties,A.qualification,A.probotion_period,A.head_quarter,A.other_details, pm.program_name, A.file_path");
				$this->db->from('additional_program_setup A');
				$this->db->join('program_master pm','A.program_code=pm.program_code','INNER');
				$this->db->where('A.record_status',1);
				$this->db->where('pm.program_code', $program_code);
				$this->db->order_by('A.id','desc');
				$result = $this->db->get();
				//echo $this->db->get();die();
				$res = $result->result_array();
				$code = '';
				$classification = '';
				$ministry = '';
				$department = '';
				$organisation = '';
				$pay_scale = '';
				$age = '';
				$desired_qualification = '';
				$duties = '';
				$qualification = '';
				$probotion_period = '';
				$head_quarter = '';
				$other_details = '';
				$program_name = '';
				$file_path = '';
				foreach($res as $row)
				{
					$classification=$row['classification'];
					$ministry=$row['ministry'];
					$department=$row['department'];
					$organisation=$row['organisation'];
					$pay_scale=$row['pay_scale'];
					$age=$row['age'];
					$desired_qualification=$row['desired_qualification'];
					$duties=$row['duties'];
					$qualification=$row['qualification'];
					$probotion_period=$row['probotion_period'];
					$head_quarter=$row['head_quarter'];
					$other_details=$row['other_details'];
					$program_name=$row['program_name'];
					$file_path=$row['file_path'];
				}
				$code = explode('_', $program_code)[0];
				$res2='';
				$res3='';
				$res4='';
				$res5='';
				if($file_path==''){					
					$res2 .= "<table class='front'>
							    <tr>
								  <td  width='30%' align='left'><strong>Vacancy Number</strong> </td>
								  <td width='70%' align='left'>".$code."</td>
								</tr>
								<tr>
								  <td align='left'><strong>Post</strong> </td>
								  <td align='left'>".$program_name."</td>
								</tr>
								
								<tr>
								  <td align='left'><strong>Classification</strong>  </td>
								  <td>".$classification."</td>
								</tr>
								
								<tr>
								  <td align='left'><strong>Ministry/Administration</strong>  </td>
								  <td align='left'>".$ministry."</td>
								</tr>
								
								 <tr>
								  <td align='left'><strong>Department/Office</strong></td>
								  <td align='left'>".$department."</td>
								</tr>
								
								 <tr>
								  <td align='left'><strong>Organisation</strong></td>
								  <td align='left'>".$organisation."</td>
								</tr>
							</table>";
							
						$res3 .="<table class='front' >
	  		
	  		
										<tr align='center'>
											<td valign='middle'  width='30%' align='left'><strong>Pay Scale</strong> </td>
											<td valign='middle' width='70%' align='left'>".$pay_scale."</td>
										</tr>
									
										
										
										<tr align='center'>
										    <td align='left'><strong>Age</strong> </td>
										    <td align='left' style='text-align:justify'>".$age."</td>
								   		 </tr>
								   		 
								   		 
								   		
										<tr align='center'>
										    <td align='left'><strong>Essential Qualificaiton (s)</strong> </td>
										    <td align='left'>".$qualification." </td>
								   		 </tr>
								   		
								   		
								   		
										<tr height='22' align='center'>
										    <td align='left'><strong>Desirable Qualificaiton (s)</strong>  </strong></td>
										    <td align='left' style='text-align:justify'>".$desired_qualification."</td>
										</tr>
										
											
											
										  <tr align='center'>
										    <td height='22' align='left'> <strong>Duty(ies)</strong></td>
										    <td align='left' style='text-align:justify'>".$duties."</td>
										  </tr>
										 
										
										
										<tr align='center'>
										    <td height='22' align='left'><strong>Probation</strong></td>
										    <td align='left' style='text-align:justify'>".$probotion_period."</td>
										</tr>
										
										
										<tr align='center'>
										   <td height='22' align='left'><strong>Head Quarter</strong> </td>
										   <td align='left' style='text-align:justify'>".$head_quarter." </td>
										</tr>
										
										<tr align='center'>
										    <td height='22' align='left'><strong>Other Details</strong></td>
										    <td align='left' style='text-align:justify'>".$other_details."</td>
										</tr>
										
										<tr align='center'>
										    <td align='left'><strong>Any Other Conditions </strong></td>
										    <td align='left' style='text-align:justify'>".$other_details."</td>
										</tr>
								    
								    
								   </table>";
					$this->db->select("category_code,vacancy_no");									
					$this->db->from('program_vacancy_details A');
					$this->db->where('A.program_code',$program_code);
					$this->db->where('A.record_status',1);
					//$this->db->group_by('A.program_code');
					$result = $this->db->get();
					//echo $this->db->last_query(); die();
					//print_r($result);
					$count_data = $result->num_rows();
					$header='<tr>';
					$data='';
					$sum=0;
					$res4 = "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
					if($count_data!=0){ 
						foreach($result->result_array() as $r){
							$header .="<td>".$r['category_code']."</td>";
							$data .="<td>".$r['vacancy_no']."</td>";
							$sum+=$r['vacancy_no'];
						}
						$header.="<td>Total</td></tr>";
						$data.="<td>".$sum."</td></tr>";
						$res4 = $header.$data;
					}
				}
				else{
					$res5.= "<iframe src='$file_path' style='min-height:755px' width='100%'></iframe>";
				}
				//echo $res4;die();			   
				//echo $this->db->last_query(); die();
				//print_r($result);
				return array('res2'=>$res2, 'res3'=>$res3,'res4'=>$res4,'res5'=>$res5);
			break;
			case 'get_faq_data':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s",now());
        		//$data = $institute;
				$this->db->select("A.id,A.question,A.answer");
				$this->db->from('faq_setup A');
				$this->db->where('A.institute_code',$data);
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.id');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
			return $result->result_array();
			break;
			case 'get_telephone_details':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s",now());
        		//$data = $institute;
				$this->db->select("A.id,A.name,A.designation,A.office_no,A.mobile_no");
				$this->db->from('telephony_setup A');
				$this->db->where('A.institute_code',$data);
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.id');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
			return $result->result_array();
			break;
			case 'get_question_details':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s",now());
        		//$data = $institute;
				$this->db->select("A.id,A.ques_set,A.link_path,A.institute_code");
				$this->db->from('previous_ques_setup A');
				$this->db->where('A.institute_code',$data);
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.id');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
			return $result->result_array();
			break;
			case 'get_chairman_details':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s",now());
        		//$data = $institute;
				$this->db->select("A.id,A.name,A.message,A.profile_photo");
				$this->db->from('chairman_setup A');
				//$this->db->where('A.institute_code',$data);
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.id');
				$this->db->limit(1);
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
			return $result->result_array();
			break;
			
			//dynamic menu 
			
			case 'get_menu':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s",now());
				$this->db->select("menu_name,external_url, menu_url, status, menu_id, submenu_status, content_status, content_english");
				$this->db->from('dbtbl_dynamic_menu');
				$this->db->where('status',1);
				$this->db->where('delete_status',0);
				$this->db->order_by('menu_id');
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			//dynamic menu
			
			case 'get_reservation_details':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s",now());
				$this->db->select("A.id,A.program_code,A.category_code,A.vacancy_no");
				$this->db->from('program_vacancy_details A');
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.id','desc');
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
				//print_r($result);
				return $result->result_array();
			break;
			
			case 'get_newsevents':
				$this->db->select("id, news_details, type, link_path, DATE_FORMAT(published_date,'%d-%b-%Y') AS created_on");
				$this->db->from('news_events as inss');
				$this->db->where('inss.record_status',1);
				$this->db->where('inss.type !=','ANNOUNCEMENT');
				$this->db->order_by('inss.published_date','desc');
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_announcements':
				$this->db->select('inss.*');
				$this->db->from('news_events as inss');
				$this->db->where('inss.record_status',1);
				$this->db->where('inss.type','ANNOUNCEMENT');
				$this->db->order_by('inss.id','desc');
				//print_r($query);
				$result = $this->db->get();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_ageMinDate':
				$this->db->select("DATE_FORMAT(MIN(birth_start_date),'%d-%m-%Y') AS birth_start_date,DATE_FORMAT(MIN(birth_end_date),'%d-%m-%Y') AS birth_end_date");
				$this->db->from('program_eligibility_setup pes');
				$this->db->join('program_master pm','pes.program_code=pm.program_code','INNER');
				$this->db->where('pm.record_status',1);
				$this->db->where('pm.institute_code',$data);
				//print_r($query);
				$result = $this->db->get();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_sliderImages':
				$this->db->select("slider_name,image_url");
				$this->db->from('institute_image_setup');
				$this->db->where('institute_code',$data);
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_EligibilityDate':
				$ins_code = $data;
				$program_code = "PROG_".$ins_code;
				$this->db->select("DATE_FORMAT(MIN(birth_start_date),'%d-%m-%Y') AS birth_start_date,DATE_FORMAT(MIN(birth_end_date),'%d-%m-%Y') AS birth_end_date");
				$this->db->from('program_eligibility_setup');
				$this->db->where('program_code',$program_code);
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
				//print_r($result);
				return $result->result_array();
			break;
			
			case 'get_dateInfo':
				$ins_code = $data;
				$program_code = "PROG_".$ins_code;
				$this->db->select("DATE_FORMAT(MIN(program_start_date),'%Y-%m-%d') AS program_start_date,DATE_FORMAT(MIN(program_end_date),'%Y-%m-%d') AS program_end_date,DATE_FORMAT(MIN(apply_start_date),'%Y-%m-%d %H:%i:%s') AS apply_start_date,DATE_FORMAT(MIN(apply_end_date),'%Y-%m-%d %H:%i:%s') AS apply_end_date");
				$this->db->from('program_master');
				$this->db->where('program_code',$program_code);
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
				//print_r($result);
				return $result->result_array();
			break;


			case 'get_latestinfo':
				$this->db->select('inst.*');
				$this->db->from('latest_information as inst');
				$this->db->order_by('inst.id','asc');
				//print_r($query);
				$result = $this->db->get();
				//print_r($result);
				return $result->result_array();
			break;
			//---------------------susmita----------------------------------------------------------------------
			case 'get_right_menu':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s",now());
				$this->db->select("menu_code,menu_name");
				$this->db->from('right_menu_master D');
				$this->db->where('record_status',1);
				$this->db->order_by('menu_id','asc');
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_right_menu_data':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$now = date("Y-m-d H:i:s",now());
				$this->db->select("D.document_title,D.link_path,DATE_FORMAT(D.created_on,'%d-%m-%Y') AS created_on");
				$this->db->from('document_details D');
				$this->db->where('D.record_status',1);
				$this->db->where('D.document_type',$data);
				$this->db->order_by('D.id','desc');
				$result = $this->db->get();
				//echo $this->db->last_query(); die();
				//print_r($result);
				return $result->result_array();
			break;
			//---------------------end susmita----------------------------------------------------------------------
			default :
            	return array('status' => FALSE, 'msg' =>'Unable to load.Contact Support');
			
        }
    }
}
