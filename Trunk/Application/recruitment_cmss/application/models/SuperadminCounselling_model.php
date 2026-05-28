<?php

class SuperadminCounselling_model extends CI_model {

    private $role;

    function __construct() {
        parent::__construct();
        $this->load->helper('date');

        if (ENVIRONMENT == 'production') {
            $this->db->save_queries = FALSE;
        }
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s', now());
        
        $this->role = $this->session->userdata('role');
        //echo $this->group_data();
    }
    
    private $_batchImport;

    public function setBatchImport($batchImport) {
        $this->_batchImport = $batchImport;
    }
    // save data
    public function importData() {
        $data = $this->_batchImport;
        //$this->db->on_duplicate_update($data);
        //print_r($data['0']['order_id']);
        $order_id = $data['0']['order_id'];
        $this->db->select('order_id');
        $this->db->from('payment_gateway_report');
        $this->db->where('order_id',$order_id);
    	$res = $this->db->get();
		$query = $res->result_array();
		//print_r($data);
        if($res->num_rows() > 0) {
        	$this->db->where('order_id', $order_id);
			$this->db->update_batch('payment_gateway_report', $data,'order_id');
		}
		else
		{
			$this->db->insert_batch('payment_gateway_report', $data);
		}
        
    }
    
	
    public function diff_in_month($from, $to) {
        $frmDate = date_create($from);
        $toDate = date_create($to);
        $difference = date_diff($toDate, $frmDate, true);
        $month = $difference->format("%a") / 30;
        return $month;
    }
	//to get group data
	public function group_data(){
        $this->db->select('*');
		$this->db->from('group_master');
		$this->db->where('group_code',$this->session->userdata('group_code'));
		$this->db->where('record_status',1);
		$result = $this->db->get();
		$row = $result->result_array();
		$operation_tbl = $row[0]['operation_tbl'];
		$operation_col = $row [0]['operation_col'];
		$exicution_col = $row [0]['exicution_col'];
		$this->db->select('d.'.$exicution_col);
		$this->db->from('group_master gm');
		$this->db->join('group_mapping gmap','gm.group_code = gmap.group_code','inner');
		$this->db->join($operation_tbl.' as d','gmap.map_value_code = d.'.$operation_col,'inner');
		$this->db->where('gm.record_status',1);
		$this->db->where('gm.group_code',$this->session->userdata('group_code'));
		$result1 = $this->db->get();
		$row_val = $result1->result_array();
		$id = '';
		foreach($row_val as $row1 ){
			$id = $id."'".$row1['id']."',";
		}
		$id=rtrim($id,", ");
		return $id;
	}
    /**
     * 	Generate random registration_no 
     */
    public function rand_number($length) {
        $chars = "0123456789";
        return substr(str_shuffle($chars), 0, $length);
    }

    public function superadmin($data, $op, $stage = null) {
		$today = date('Y-m-d', now());
        /**
		* logic: To operate data for superadmin master setup
		* date :11/09/2017
		*/
        switch ($op) {
        	/**
			* logic: To operate data for User Master
			* case:get_user_data,add_user,edit_user,delete_user,get_role
			* author:Rahul Patro
			* date :11/09/2017
			*/
			case 'validate_institute':
				$ins =  encrypt_decrypt('decrypt', $data);
				//$ins = $data;
				//echo $ins;
				if($ins == '0')
				{
					$ins = '';
				} 
				$this->db->select('ins.*');
				$this->db->from('institute_master as ins');
				$this->db->where('ins.institute_code',$ins);
				//print_r($query);
				$result = $this->db->get();
				//print_r($result);
				//echo $this->db->last_query();
				$result->result_array();
				if($result->num_rows() > 0) {
					  return array('status'=>true, 'msg'=>'Present');
				}
				else
				{
					return array('status'=>false, 'msg'=>'Not Present');
				}
			break;
			case 'validate_program':
				
				$this->db->select('p.*');
				$this->db->from('counselling_program_master as p');
				$this->db->where('p.program_code',$data);
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//print_r($result);
				$result->result_array();
				if($result->num_rows() > 0) {
					  return array('status'=>true, 'msg'=>'Present');
				}
				else
				{
					return array('status'=>false, 'msg'=>'Not Present');
				}
			break;
			case 'get_institute_name':
				$ins =  $data;
				$this->db->select('institute_code,institute_name');
				$this->db->from('institute_master');
				$this->db->where('institute_code',$ins);
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'select_program_for_online_details':
				//$program_type = $_POST['program_type'];
				$institute_code = $_POST['ins'];
				$this->db->select("program_code,program_name");
				$this->db->from('counselling_program_master');
				$this->db->where('institute_code',$institute_code);
				$this->db->where('record_status',1);
				$this->db->where('status','Active');
				$result = $this->db->get();
				/*echo $this->db->last_query();
				die();*/
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			
			case 'select_online_payment_verification':
				$inst_code =  isset($_POST['institute_code'])? $_POST['institute_code']:'';
				$from_date = isset($_POST['from_date'])? $_POST['from_date']:'';
				$to_date = isset($_POST['to_date'])? $_POST['to_date']:'';
				$deposit_status = isset($_POST['deposit_status'])? $_POST['deposit_status']:'';
				$programs = isset($_POST['programs'])? $_POST['programs']:'';
				$from_date = date('Y-m-d', strtotime($from_date));
				$to_date = date('Y-m-d', strtotime($to_date));
				//$arr_program_code = array();
				//$arr_program_code = explode(',', $programs);
				$arr_program_code = $programs;
				/*print_r($programs);
				print_r($arr_program_code);
				die();*/
				$program ='';
				for($i=0;$i<sizeof($arr_program_code);$i++)
				{
					if($arr_program_code[$i] != 'multiselect-all')
					{
						if($program =='')
						{
							$program = $arr_program_code[$i];
						}
						else
						{
							$program .= ",".$arr_program_code[$i]."";
						}
					}
					
				}
				$program = explode(',', $program);
				//print_r($program);
				//die();
				if(isset($_POST['month']))
				{
					$month = $_POST['month'];
					$year = $_POST['year'];
					$dt = $year.'-'.$month.'-1';
					$from_date = date('Y-m-01', strtotime($dt));
					$to_date = date('Y-m-t', strtotime($dt));
					
				}
				if($deposit_status == '')
				{
					$this->db->select("B.applied_program,B.appl_no,B.reg_user_id,F.full_name,D.program_name,amount,C.request_datetime,
							DATE_FORMAT(C.response_datetime,'%d-%m-%Y %h:%i') AS response_datetime,order_number,order_id,
							DATE_FORMAT(C.request_datetime,'%d-%m-%Y %h:%i') AS DATETIME,C.deposit_status,
							CASE WHEN transaction_id IS NULL THEN C.transaction_number ELSE transaction_id END AS transaction_id,
							C.refund_status,C.refunded_on", FALSE);
					$this->db->from('counselling_applicant_form_fee_overview A');
					$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no','left');
					$this->db->join('applicant_form_online_deposit C','A.appl_no = C.appl_no','left');
					$this->db->join('applicant_master F','B.reg_user_id = F.reg_user_id AND B.applied_program = F.applied_program','left');
					$this->db->join('counselling_program_master D','B.applied_program = D.program_code','left');
					$this->db->join('institute_master E','D.institute_code = E.institute_code','left');
					$this->db->join('payment_gateway_report G','C.order_number = G.order_id','left');
					$this->db->where('D.institute_code',$inst_code);
					$this->db->where_in('B.applied_program',$program);
					$this->db->where('A.money_deposit_mode','ONLINE');
					$this->db->where('date(request_datetime) BETWEEN"'. $from_date . '" and "'. $to_date .'"');
					//$this->db->where('date(request_datetime) BETWEEN '$from_date' AND '$to_date'');
					$this->db->order_by('B.appl_no,order_number');
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output = array("aaData" => array());
					$output_data = $result->result_array();
					$slno = 1;
					foreach ($output_data as $aRow) 
	            	{
	            		$row[0] = $slno;
		                $row['sl_no'] = $slno;
		                $i = 1;
		                foreach ($aRow as $key => $value) {

		                    $row[$i] = $value;
		                    $row[$key] = $value;
		                    $i++;
		                }
						$output['aaData'][] = $row;
		                $slno++;
		                unset($row);
	                
						/*array_unshift($aRow,$slno); //ADD SLNO ON FIRST CELL OF EVERY ROW 
						$output['aaData'][] = $aRow;
						$slno++;*/
					}
					//echo $output;
					//echo json_encode( $output );
				
					/*$query = "SELECT B.applied_program,B.appl_no,B.reg_user_id,F.full_name,D.program_name,amount,C.request_datetime,
					DATE_FORMAT(C.response_datetime,'%d-%m-%Y %h:%i') AS response_datetime,order_number,order_id,DATE_FORMAT(C.request_datetime,'%d-%m-%Y %h:%i')
					AS DATETIME,C.deposit_status,
					CASE WHEN transaction_id IS NULL THEN C.transaction_number
					ELSE transaction_id END AS transaction_id,
					C.refund_status,C.refunded_on FROM 
					counselling_applicant_form_fee_overview A 
					LEFT JOIN  applicant_appl_overview B ON A.appl_no = B.appl_no
					LEFT JOIN applicant_form_online_deposit C ON A.appl_no = C.appl_no
					LEFT JOIN applicant_master F ON B.reg_user_id = F.reg_user_id AND B.applied_program = F.applied_program
					LEFT JOIN counselling_program_master D ON B.applied_program = D.program_code
					LEFT JOIN institute_master E ON D.institute_code = E.institute_code
					LEFT JOIN payment_gateway_report G ON C.order_number = G.order_id
					WHERE D.institute_code ='$inst_code'
					AND date(request_datetime) BETWEEN '$from_date' AND '$to_date'
					AND B.applied_program IN($program)
					AND A.money_deposit_mode = 'ONLINE' ORDER BY B.appl_no,order_number";
					$rResult = mysqli_query($con,$query ) or fatal_error( 'MySQL Error: ' . mysqli_errno() );*/
					
				}
				else if($deposit_status == 'SUCCESS' || $deposit_status == 'INITIATED' )
				{
					$this->db->select('B.applied_program,B.appl_no,B.reg_user_id,F.full_name,D.program_name,amount,C.request_datetime,
						DATE_FORMAT(C.response_datetime,"%d-%m-%Y %h:%i") AS response_datetime,order_number,order_id,DATE_FORMAT(C.request_datetime,"%d-%m-%Y %h:%i")
						AS DATETIME,C.deposit_status,
						CASE WHEN transaction_id IS NULL THEN C.transaction_number
						ELSE transaction_id END AS transaction_id,
						C.refund_status,C.refunded_on', FALSE);
					$this->db->from('counselling_applicant_form_fee_overview A');
					$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no','left');
					$this->db->join('applicant_form_online_deposit C','A.appl_no = C.appl_no','left');
					$this->db->join('applicant_master F','B.reg_user_id = F.reg_user_id AND B.applied_program = F.applied_program','left');
					$this->db->join('counselling_program_master D','B.applied_program = D.program_code','left');
					$this->db->join('institute_master E','D.institute_code = E.institute_code','left');
					$this->db->join('payment_gateway_report G','C.order_number = G.order_id','left');
					$this->db->where('D.institute_code',$inst_code);
					$this->db->where_in('B.applied_program',$program);
					$this->db->where('C.deposit_status',$deposit_status);
					$this->db->where('A.money_deposit_mode','ONLINE');
					$this->db->where('date(request_datetime) BETWEEN"'. $from_date . '" and "'. $to_date .'"');
					//$this->db->where('date(request_datetime) BETWEEN '$from_date' AND '$to_date'');
					$this->db->order_by('B.appl_no,order_number');
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output = array("aaData" => array());
					$output_data = $result->result_array();
					$slno = 1;
					foreach ($output_data as $aRow) 
	            	{
	            		$row[0] = $slno;
		                $row['sl_no'] = $slno;
		                $i = 1;
		                foreach ($aRow as $key => $value) {

		                    $row[$i] = $value;
		                    $row[$key] = $value;
		                    $i++;
		                }
						$output['aaData'][] = $row;
		                $slno++;
		                unset($row);
	                
						/*array_unshift($aRow,$slno); //ADD SLNO ON FIRST CELL OF EVERY ROW 
						$output['aaData'][] = $aRow;
						$slno++;*/
					}
					//echo $output;
					//echo json_encode( $output );
					
					
					/*$query = "SELECT B.applied_program,B.appl_no,B.reg_user_id,F.full_name,D.program_name,amount,C.request_datetime,
					DATE_FORMAT(C.response_datetime,'%d-%m-%Y %h:%i') AS response_datetime,order_number,order_id,DATE_FORMAT(C.request_datetime,'%d-%m-%Y %h:%i')
					AS DATETIME,C.deposit_status,
					CASE WHEN transaction_id IS NULL THEN C.transaction_number
					ELSE transaction_id END AS transaction_id,
					C.refund_status,C.refunded_on FROM 
					counselling_applicant_form_fee_overview A 
					LEFT JOIN  applicant_appl_overview B ON A.appl_no = B.appl_no
					LEFT JOIN applicant_form_online_deposit C ON A.appl_no = C.appl_no
					LEFT JOIN applicant_master F ON B.reg_user_id = F.reg_user_id AND B.applied_program = F.applied_program
					LEFT JOIN counselling_program_master D ON B.applied_program = D.program_code
					LEFT JOIN institute_master E ON D.institute_code = E.institute_code
					LEFT JOIN payment_gateway_report G ON C.order_number = G.order_id
					WHERE D.institute_code ='$inst_code'
					AND B.applied_program IN($program)
					AND date(request_datetime) BETWEEN '$from_date' AND '$to_date'
					AND A.money_deposit_mode = 'ONLINE'
					AND C.deposit_status='$deposit_status' ORDER BY B.appl_no,order_number";*/
					
				}
				else if($deposit_status == 'NOT VERIFIED')
				{
					$this->db->select("B.applied_program,B.appl_no,B.reg_user_id,F.full_name,D.program_name,amount,C.request_datetime,
						DATE_FORMAT(C.response_datetime,'%d-%m-%Y %h:%i') AS response_datetime,order_number,order_id,DATE_FORMAT(C.request_datetime,'%d-%m-%Y %h:%i')
						AS DATETIME,C.deposit_status,
						CASE WHEN transaction_id IS NULL THEN C.transaction_number
						ELSE transaction_id END AS transaction_id,
						C.refund_status,C.refunded_on", FALSE);
					$this->db->from('counselling_applicant_form_fee_overview A');
					$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no','left');
					$this->db->join('applicant_form_online_deposit C','A.appl_no = C.appl_no','left');
					$this->db->join('applicant_master F','B.reg_user_id = F.reg_user_id AND B.applied_program = F.applied_program','left');
					$this->db->join('counselling_program_master D','B.applied_program = D.program_code','left');
					$this->db->join('institute_master E','D.institute_code = E.institute_code','left');
					$this->db->join('payment_gateway_report G','C.order_number = G.order_id','left');
					$this->db->where('D.institute_code',$inst_code);
					$this->db->where_in('B.applied_program',$program);
					$this->db->where('C.deposit_status','INITIATED');
					$this->db->where('A.money_deposit_mode','ONLINE');
					$this->db->where('date(request_datetime) BETWEEN"'. $from_date . '" and "'. $to_date .'"');
					//$this->db->where('date(request_datetime) BETWEEN '$from_date' AND '$to_date'');
					$this->db->order_by('B.appl_no,order_number');
					$result = $this->db->get();
					$output = array("aaData" => array());
					$output_data = $result->result_array();
					$slno = 1;
					foreach ($output_data as $row) 
	            	{
						$row1 = array();
						$row['order_id'];
						if($row['order_id'] != '')
						{
							$row1[0] = $slno;
							$row1['sl_no'] = $slno;
							$row1[1] = $row['applied_program']; 
							$row1['program_code'] = $row['applied_program'];
							$row1[2] = $row['appl_no']; 
							$row1['appl_no'] = $row['appl_no'];
							$row1[3] = $row['reg_user_id'];
							$row1['mobile_no'] = $row['reg_user_id'];
							$row1[4] = $row['full_name'];
							$row1['applicant_name'] = $row['full_name'];
							$row1[5] = $row['program_name'];
							$row1['program_name'] = $row['program_name'];
							$row1[6] = $row['amount'];
							$row1['amount'] = $row['amount'];
							$row1[7] = $row['request_datetime'];
							$row1['request_datetime'] = $row['request_datetime'];
							$row1[8] = $row['response_datetime'];
							$row1['response_datetime'] = $row['response_datetime'];
							$row1[9] = $row['order_number'];
							$row1['order_number'] = $row['order_number'];
							$row1[10] = $row['order_id'];
							$row1['order_id'] = $row['order_id'];
							$row1[11] = $row['DATETIME'];
							$row1['DATETIME'] = $row['DATETIME'];
							$row1[12] = 'NOT VERIFIED';
							$row1['deposit_status'] = 'NOT VERIFIED';
							$row1[13] = $row['transaction_id'];
							$row1['transaction_id'] = $row['transaction_id'];
							$row1[14] = $row['refund_status'];
							$row1['refund_status'] = $row['refund_status'];
							$row1[15] = $row['refunded_on'];
							$row1['refunded_on'] = $row['refunded_on'];
							$output['aaData'][] = $row1;
							$slno++;
						}
					}
					//echo json_encode( $output );
				}
				else if($deposit_status == 'MULTIPLE_PAYMENT')
				{
					$appl_no_arr = array();
					
					$this->db->select("count(appl_no),appl_no");
					$this->db->from('applicant_form_online_deposit');
					$this->db->where('deposit_status','SUCCESS');
					$this->db->group_by('appl_no');
					$this->db->having("count('appl_no')>=1");
					$result = $this->db->get();
					//echo $this->db->last_query();
					$output = array("aaData" => array());
					$output_data = $result->result_array();
					$slno = 1;
					foreach ($output_data as $aRow) 
	            	{
						$appl_no_arr[] = $aRow['appl_no'];
					}
					
					$app_no_array = $appl_no_arr;
					$app_no_arrays = implode(",",$app_no_array);
					//print_r($app_no_arrays);
					
					if($app_no_arrays != '')
					{
						$this->db->select("B.applied_program,B.appl_no,B.reg_user_id,F.full_name,D.program_name,G.net_amount,A.request_datetime,
							DATE_FORMAT(A.response_datetime,'%d-%m-%Y %h:%i') AS response_datetime,order_number,order_id,DATE_FORMAT(A.request_datetime,'%d-%m-%Y %h:%i')
							AS DATETIME,A.deposit_status,transaction_number,A.refund_status,A.refunded_on");
						$this->db->from('applicant_form_online_deposit A', FALSE);
						$this->db->join('payment_gateway_report G','A.order_number = G.order_id','left');
						$this->db->join('counselling_applicant_form_fee_overview C','A.appl_no = C.appl_no','left');
						$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no','left');
						$this->db->join('applicant_master F','B.reg_user_id = F.reg_user_id AND B.applied_program = F.applied_program','left');
						$this->db->join('counselling_program_master D','B.applied_program = D.program_code','left');
						$this->db->join('institute_master E','D.institute_code = E.institute_code','left');
						$this->db->where('D.institute_code',$inst_code);
						$this->db->where_in('B.applied_program',$program);
						$this->db->where_in('A.appl_no',$app_no_array);
						$this->db->where('A.deposit_status','SUCCESS');
						$this->db->where('date(request_datetime) BETWEEN"'. $from_date . '" and "'. $to_date .'"');
						//$this->db->where('date(request_datetime) BETWEEN '$from_date' AND '$to_date'');
						$this->db->order_by('B.appl_no,order_number');
						$result = $this->db->get();
						echo $this->db->last_query();
						$output = array("aaData" => array());
						$output_data = $result->result_array();
						$slno = 1;
						foreach ($output_data as $row) 
		            	{
							$row1 = array();
							//echo $row['order_id'];
							if($row['order_id'] != '')
							{
								$row1[0] = $slno;
								$row1['sl_no'] = $slno;
								$row1[1] = $row['applied_program']; 
								$row1['program_code'] = $row['applied_program'];
								$row1[2] = $row['appl_no']; 
								$row1['appl_no'] = $row['appl_no'];
								$row1[3] = $row['reg_user_id'];
								$row1['mobile_no'] = $row['reg_user_id'];
								$row1[4] = $row['full_name'];
								$row1['applicant_name'] = $row['full_name'];
								$row1[5] = $row['program_name'];
								$row1['program_name'] = $row['program_name'];
								$row1[6] = $row['net_amount'];
								$row1['amount'] = $row['net_amount'];
								$row1[7] = $row['request_datetime'];
								$row1['request_datetime'] = $row['request_datetime'];
								$row1[8] = $row['response_datetime'];
								$row1['response_datetime'] = $row['response_datetime'];
								$row1[9] = $row['order_number'];
								$row1['order_number'] = $row['order_number'];
								$row1[10] = $row['order_id'];
								$row1['order_id'] = $row['order_id'];
								$row1[11] = $row['DATETIME'];
								$row1['DATETIME'] = $row['DATETIME'];
								$row1[12] = $row['deposit_status'];
								$row1['deposit_status'] = $row['deposit_status'];
								$row1[13] = $row['transaction_number'];
								$row1['transaction_number'] = $row['transaction_number'];
								$row1[14] = $row['refund_status'];
								$row1['refund_status'] = $row['refund_status'];
								$row1[15] = $row['refunded_on'];
								$row1['refunded_on'] = $row['refunded_on'];
								$output['aaData'][] = $row1;
								$slno++;
							}
							
							
						}
						//echo json_encode( $output );
					}
				}
			
	           	return $output;
			break;
			
			case 'get_institute_data':
				$ins =  encrypt_decrypt('decrypt', $data);
				//$ins = $data;
				if($ins == '0') 
					$ins = '';
				$this->db->select('institute_code,institute_name,image_url');
				$this->db->from('institute_master as ins');
				$this->db->where('ins.institute_code',$ins);
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_institute_setup_data':
				$this->db->select("CONCAT(institute_name,'`',website_address) AS institute, A.institute_code, institute_type, 
							website_address, contact_number,  A.record_status as record, 
							CASE WHEN A.record_status = 1 THEN 'ACTIVE' ELSE 'INACTIVE' END AS record_status, logo_url,location,
							admin_name,admin_user_name,institute_address,image_url,A.institute_name");
				$this->db->from('institute_master A');
				//print_r($query);
				//echo $this->db->last_query();
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			case 'get_program_group':
				$ins =  encrypt_decrypt('decrypt', $data);
				if($ins == '0') 
					$ins = '';
				$this->db->distinct('program_group_code');
				$this->db->select('program_group_code,program_group_name');
				$this->db->from('program_group_master A');
				$this->db->join('counselling_program_master B','A.program_group_name = B.program_group','inner');
				$this->db->where('B.institute_code',$ins);
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.sl_no');
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_program':
				$ins =  encrypt_decrypt('decrypt', $data);
				if($ins == '0') 
					$ins = '';
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select('A.program_group,A.id,A.program_name,A.program_code,A.year,A.apply_start_date,A.apply_end_date,A.template_code,C.file_name');
				$this->db->from('counselling_program_master A');
				$this->db->join('program_group_master B','A.program_group = B.program_group_name','inner');
				$this->db->join('form_template_master C','A.template_code = C.template_code','inner');
				$this->db->where('A.institute_code',$ins);
				$this->db->where('A.record_status',1);
				$this->db->where('A.publish_status','YES');
				$this->db->where('A.program_start_date<=',$date);
				$this->db->where('A.program_end_date>=',$date);
				$this->db->order_by('A.sl_no');
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//die();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_program_detail':
				$program_code = $data;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select('A.program_group,A.id,A.program_name,A.program_code,A.year,A.apply_start_date,A.apply_end_date,A.template_code,C.file_name,C.template_name');
				$this->db->from('counselling_program_master A');
				$this->db->join('form_template_master C','A.template_code = C.template_code','inner');
				$this->db->where('A.program_code',$program_code);
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_program_name':
				$program_code = $data;
				$program_name = '';
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select('A.program_name');
				$this->db->from('counselling_program_master A');
				$this->db->where('A.program_code',$program_code);
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				foreach($result->result_array() AS $row)
				{
					$program_name = $row['program_name'];
				}
				return $program_name;
				
			break;
			case 'get_program_menu':
				$program_code = $data;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->distinct('A.menu_code');
				$this->db->select('A.menu_code,A.link_text,A.link_url,A.record_status');
				$this->db->from('program_menu_master A');
				$this->db->join('program_menu_setup B', 'A.menu_code = B.menu_code','inner');
				
				$this->db->where('B.program_code',$program_code);
				$this->db->where('B.show_status',1);
				$this->db->order_by('B.sl_no');
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_mandatory_fields':
				$program_code = $data;
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select('A.field_code,B.description,A.field_status');
				$this->db->from('program_registration_field_mapping A');
				$this->db->join('registration_field_setup B ', 'A.code_group = B.code_group AND A.field_code = B.code','inner');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.code_group','REGISTRATION_PAGE');
				$this->db->where('A.field_status','COMPULSORY');
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'check_birth_date':
				$program_code = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("DATE_FORMAT(birth_start_date,'%d-%m-%Y') as birth_start_date  ,DATE_FORMAT(birth_end_date,'%d-%m-%Y') as birth_end_date");
				$this->db->from('program_eligibility_setup');
				$this->db->where('program_code',$program_code);
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_registration_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("reg_user_id,dob,first_name,mid_name,last_name,email_id");
				$this->db->from('applicant_reg_master');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_application_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("appl_no,appl_status");
				$this->db->from('applicant_appl_overview');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			
			//********************************************************* Data to show in the template *******************************//
			
			case 'get_applicant_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("*,DATE_FORMAT(dob,'%d-%m-%Y') AS dob1,CASE WHEN comm_address_ref_id = perm_address_ref_id THEN 'Y' ELSE 'N' END AS addresscheck");
				$this->db->from('applicant_master');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('status','1');
				$result = $this->db->get();
				//echo $this->db->last_query();
				return $result->result_array();
			break;
			case 'get_present_communication_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("address_1, address_2, post_office, district_code,state_code, pin,distance_from");
				$this->db->from('applicant_address');
				$this->db->join('applicant_master','applicant_address.address_ref_id = applicant_master.comm_address_ref_id','left');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_permanent_communication_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("address_1, address_2, post_office, district_code,state_code, pin,mobile");
				$this->db->from('applicant_address');
				$this->db->join('applicant_master','applicant_address.address_ref_id = applicant_master.perm_address_ref_id','left');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_permanent_communication_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("address_1, address_2, post_office, district_code,state_code, pin,mobile");
				$this->db->from('applicant_address');
				$this->db->join('applicant_master','applicant_address.address_ref_id = applicant_master.perm_address_ref_id','left');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_father_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("rel_name, rel_occupation, rel_desig, nature_of_work,annual_income, place_work, email_id, res_no, mobile_no");
				$this->db->from('applicant_relation');
				$this->db->join('applicant_master','applicant_relation.reg_user_id=applicant_master.reg_user_id','left');
				$this->db->where('applicant_rel_flag','1');
				$this->db->where('applicant_relation.applied_program',$program_code);
				$this->db->where('applicant_relation.reg_user_id',$reg_user_id);
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_mother_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("rel_name, rel_occupation, rel_desig, nature_of_work,annual_income, place_work, email_id, res_no, mobile_no");
				$this->db->from('applicant_relation');
				$this->db->join('applicant_master','applicant_relation.reg_user_id=applicant_master.reg_user_id','left');
				$this->db->where('applicant_rel_flag','2');
				$this->db->where('applicant_relation.applied_program',$program_code);
				$this->db->where('applicant_relation.reg_user_id',$reg_user_id);
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_guardian_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("rel_name, rel_occupation, rel_desig, nature_of_work,annual_income, place_work, email_id, res_no, mobile_no");
				$this->db->from('applicant_relation');
				$this->db->join('applicant_master','applicant_relation.reg_user_id=applicant_master.reg_user_id','left');
				$this->db->where('applicant_rel_flag','3');
				$this->db->where('applicant_relation.applied_program',$program_code);
				$this->db->where('applicant_relation.reg_user_id',$reg_user_id);
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_academic_qual_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("qual_desc_1,year_of_passing,university_board,division_distinction,mark_secured,full_mark,percentage_mark");
				$this->db->from('applicant_qualification_detail');
				$this->db->join('applicant_master','applicant_master.applied_program = applicant_qualification_detail.applied_program AND applicant_master.reg_user_id = applicant_qualification_detail.reg_user_id','inner');
				$this->db->where('applicant_master.applied_program',$program_code);
				$this->db->where('applicant_master.reg_user_id',$reg_user_id);
				$this->db->order_by('applicant_qualification_detail.id');
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			//****************************************************************************************************// 
			
			case 'get_documents_required':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("document_type_code");
				$this->db->from('program_document_setup');
				$this->db->where('program_code',$program_code);
				$where = '(record_status="Active" or record_status = "1")';
				$this->db->where($where);
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_qualification_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.qualification_code, B.qualification_name, B.division");
				$this->db->from('program_qualification_setup A');
				$this->db->join('qualification_master B','A.qualification_code = B.qualification_code','inner');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.id');
				
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;	
			
			case 'get_district_details':
				$state = $_POST['state'];
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("district_code,district_name");
				$this->db->from('district_master');
				$this->db->where('state_code',$state);
				//print_r($query);
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
			break;
			case 'get_highest_qualification':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("qualification_code, qualification_name");
				$this->db->from('highest_qualification_master');
				$this->db->order_by('id');
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_nationality_data':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("nationality_code,nationality");
				$this->db->from('nationality_master');
				$this->db->where('record_status',1);
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_religion_data':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("religion_code,religion_name");
				$this->db->from('religion_master');
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_district_data':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("district_code,district_name");
				$this->db->from('district_master');
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_state_data':
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("state_code,state_name");
				$this->db->from('state_master');
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_category_data':
				$program_code = $this->session->userdata('admcode');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.category_code, A.category_name");
				$this->db->from('category_master A');
				$this->db->join('program_category_setup B','A.category_code = B.category_code','inner');
				$this->db->where('B.program_code',$program_code);
				$this->db->where('A.category_code!=','GEN');
				$this->db->where('B.record_status',1);
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_document_data':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$institute_code = $this->session->userdata('institute_code');
        		//$data = $this->uri->uri_to_assoc();
				//$institute = $data['ins'];
        		$ins =  $institute_code;
        		
        		$where = "(program_document_setup.record_status = 'Active' OR program_document_setup.record_status = '1')";
        		
				$this->db->select('applicant_document_list.document_type_code,document_type,document_type_description,document_size_description,document_size_in_kb,document_preview_height,document_preview_width');
				$this->db->from('program_document_setup');
				$this->db->join('applicant_document_list', 'program_document_setup.document_type_code = applicant_document_list.document_type_code','inner');
				$this->db->join('document_type_master', 'program_document_setup.document_type_code = document_type_master.document_type_code','inner');
				
				$this->db->where('application_no',$application_no);
				$this->db->where('program_code',$program_code);
				$this->db->where('applicant_document_list.record_status','1');
				$this->db->where($where);
				$this->db->order_by('sl_no');
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_appl_status':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$ins =  encrypt_decrypt('decrypt', $data);
        		
        		
				$this->db->select('appl_status');
				$this->db->from('applicant_appl_overview');
				
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('STATUS','1');
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_doc_path':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$ins =  encrypt_decrypt('decrypt', $data);
        		
        		
				$this->db->select('document_path,document_type');
				$this->db->from('applicant_form_documents');
				
				$this->db->where('appl_no',$application_no);
				$this->db->where('status','1');
				//print_r($query);
				$result = $this->db->get();
				//$this->db->last_query();
				//print_r($result);
				return $result->result_array();
			break;
			case 'get_reg_id':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$ins =  encrypt_decrypt('decrypt', $data);
        		
				$this->db->select('reg_mode,email_id');
				$this->db->from('applicant_reg_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('applied_program',$program_code);
				$this->db->where('STATUS','1');
				$result = $this->db->get();
				//$this->db->last_query();
				return $result->result_array();
			break;
			
			case 'payModeQuery':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$institute_code = $this->session->userdata('institute_code');
        		//$data = $this->uri->uri_to_assoc();
				//$institute = $data['ins'];
        		$ins =  $institute_code;
        		
				$this->db->select('payment_mode,description');
				$this->db->from('counselling_payment_mode_setup P');
				$this->db->join('gen_code_description G','P.payment_mode = G.code','inner');
				$this->db->where('P.institute_code',$ins);
				$this->db->where('P.record_status','1');
				$this->db->where('code_group','Payment Mode');
				$this->db->order_by('P.sl_no');
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'tempcode':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$institute_code = $this->session->userdata('institute_code');
        		//$data = $this->uri->uri_to_assoc();
				//$institute = $data['ins'];
        		$ins =  $institute_code;
        		
				$this->db->select('template_code');
				$this->db->from('counselling_program_master');
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'categorydata':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$institute_code = $this->session->userdata('institute_code');
        		//$data = $this->uri->uri_to_assoc();
				//$institute = $data['ins'];
        		$ins =  $institute_code;
        		
				$this->db->select('category,last_grade');
				$this->db->from('applicant_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('STATUS','1');
				$this->db->where('applied_program',$program_code);
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'deposit':
				$application_no = $this->session->userdata('appl_no');
				$this->db->select("money_deposit_mode,amount,DATE_FORMAT(depositdate,'%d-%m-%Y') AS depositdate,money_receipt_no");
				$this->db->from('counselling_applicant_form_fee_overview');
				$this->db->where('appl_no',$application_no);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$amt = $row['amount'];
					if($row['amount']=='0.00')
					{
						$noamount=1;
					}
					else
					{
						$noamount=0;
					}
				}
				return $result->result_array();
			break;
			case 'amount':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$institute_code = $this->session->userdata('institute_code');
        		//$data = $this->uri->uri_to_assoc();
				//$institute = $data['ins'];
        		$ins =  $institute_code;
        		
        		$this->db->select('category,last_grade');
				$this->db->from('applicant_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('STATUS','1');
				$this->db->where('applied_program',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				$category = '';
				foreach($output_data as $row)
				{
					$category = $row['category'];
				}
				
				$this->db->select('amount');
				$this->db->from('program_fee_setup');
				$this->db->where('category_code',$category);
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				return $result->result_array();
			break;
			
			case 'pass_status':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				
				$this->db->select('category,last_grade');
				$this->db->from('applicant_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('STATUS','1');
				$this->db->where('applied_program',$program_code);
				$result = $this->db->get();
				return $result->result_array();
			break;	
			
			case 'update_reg_mode':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$institute_code = $this->session->userdata('institute_code');
        		//$data = $this->uri->uri_to_assoc();
				//$institute = $data['ins'];
        		$ins =  $institute_code;
        		$mode = $this->session->userdata('mode');
        		
        		$this->db->select('appl_status');
				$this->db->from('applicant_appl_overview');
				$this->db->where('applied_program',$program_code);
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('STATUS','1');
				//print_r($query);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row){
					$appl_status = $row['appl_status'];
				}
        		
        		if($appl_status == 'Document Uploaded' || $appl_status == 'Challan Generated')
        		{
        			
					if($mode =="edit")
	        		{ 
	        			$update_data = array(
						'reg_mode' 			=>'ONLINE'
						);
						$this->db->where('reg_user_id',$reg_user_id);
						$this->db->where('STATUS','1');
						$this->db->where('applied_program',$program_code);
						$sql = $this->db->update('applicant_reg_master', $update_data);
						if(!$sql){
							$dbStatus = "ERROR";
							$dbMessage = "Error Inserting";
						}
					}
				}
				if($appl_status == 'Fee Paid' || $appl_status == 'Verified')
        		{
					if($mode =="edit")
	        		{ 
						$this->db->select("money_deposit_mode,amount,DATE_FORMAT(depositdate,'%d-%m-%Y') AS depositdate,money_receipt_no");
						$this->db->from('counselling_applicant_form_fee_overview');
						$this->db->where('appl_no',$application_no);
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row)
						{
							$amt = $row['amount'];
							if($row['amount']=='0.00')
							{
								$noamount=1;
							}
							else
							{
								$noamount=0;
							}
						}
					}
					else
					{
						$this->db->select("money_deposit_mode,amount,DATE_FORMAT(depositdate,'%d-%m-%Y') AS depositdate,money_receipt_no");
						$this->db->from('counselling_applicant_form_fee_overview');
						$this->db->where('appl_no',$application_no);
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row)
						{
							$amt = $row['amount'];
							if($row['amount']=='0.00')
							{
								$noamount=1;
							}
						}
					}
				}
				if($mode=="edit")
				{
					$this->db->select('category,last_grade');
					$this->db->from('applicant_master');
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('STATUS','1');
					$this->db->where('applied_program',$program_code);
					$result = $this->db->get();
					$output_data = $result->result_array();
					$category = '';
					foreach($output_data as $row)
					{
						$category = $row['category'];
					}
				
					$this->db->select("amount");
					$this->db->from('program_fee_setup');
					$this->db->where('program_code',$program_code);
					$this->db->where('category_code',$category);
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach($output_data as $row)
					{
						$amount = $row['amount'];
						if($amount == '0')
						{
							$noamount=1;
						}
						else
						{
							$noamount=0;
						}
						$edit="true";
					}
				}
				return $result->result_array();
			break;
			
			case 'add_payment_data_apply4':
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		$data = $this->uri->uri_to_assoc();
				$institute_code = $this->session->userdata('institute_code');
        		$ins =  $institute_code;
        		$mode = $this->session->userdata('mode');
        		
        		/*$dbStatus = "";
				$dbMessage = "";
				$dbError = "";*/
				
				$dbStatus = "SUCCESS";
				$dbMessage = 'Data saved successfully';
        		
        		$this->db->select('category,last_grade');
				$this->db->from('applicant_master');
				$this->db->where('reg_user_id',$reg_user_id);
				$this->db->where('STATUS','1');
				$this->db->where('applied_program',$program_code);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//print_r($query);
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$category = $row['category'];
				}
        		
        		$this->db->select('amount');
				$this->db->from('program_fee_setup');
				$this->db->where('category_code',$category);
				$this->db->where('program_code',$program_code);
				$result = $this->db->get();
				$output_data = $result->result_array();
				foreach($output_data as $row)
				{
					$amount = $row['amount'];
				}
        		if($amount == 0)
				{
					$noamount=1;
				}
				else
				{
					$noamount=0;
				}
        		
        		if($noamount == 1)
				{
					
					$this->db->select('index_no');
					$this->db->from('applicant_appl_overview');
					$this->db->where('appl_no',$application_no);
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach($output_data as $row)
					{
						$index_no = $row['index_no'];
					}
					$index = $index_no;
					$sequence_no = 0;
					if($index == '')
					{
						$this->db->select('A.program_code,A.year,A.sequence_code,sequence_no');
						$this->db->from('index_sequence_setup A');
						$this->db->where('A.program_code',$program_code);
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row)
						{
							$year = $row['year'];
							$sequence_no = $row['sequence_no'];
							$key = $row['sequence_code'];
						}
						$year_str = substr($year,'-2');
						if($sequence_no < 10)
							$changed_sl_no = '00'.$sequence_no;
						else if($sequence_no < 100)
							$changed_sl_no = '0'.$sequence_no;
						else
							$changed_sl_no = $sequence_no;
							
						$index_no = $year_str.'/'.$key.'/'.$changed_sl_no;
					}
					
					
					$this->db->trans_start();
					
					
					$this->db->select('COUNT(appl_no) AS appl_no');
					$this->db->from('counselling_applicant_form_fee_overview');
					$this->db->where('appl_no',$application_no);
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach($output_data as $row)
					{
						$appl = $row['appl_no'];
					}
					//echo $appl;
					if($appl >= 1)
					{
						$update_data = array(
		                    'id' =>'NULL',
		                    'appl_no' =>$application_no,
		                    'amount' => '0.00',
		                    'created_by' => $reg_user_id,
		                    'created_on' => $date
		               	);
						$this->db->where("appl_no",$application_no); 
						$update = $this->db->update("counselling_applicant_form_fee_overview",$update_data);
						if(!$update)
						{
							$dbStatus = "ERROR";
							$dbMessage = 'Error updating';
						} 
					}
					else
					{
						$new_data = array(
		                    'id' =>'NULL',
		                    'appl_no' =>$application_no,
		                    'amount' => '0.00',
		                    'created_by' => $reg_user_id,
		                    'created_on' => $date
		               	);
			            $this->db->insert("counselling_applicant_form_fee_overview",$new_data); 
			            if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting';
						}
					}
					
		            $update_data = array(
		                    'appl_status' =>'Verified',
		                    'index_no' =>$index_no,
		                    'updated_by' => $reg_user_id,
		                    'updated_on' => $date
		               	);
		            $this->db->where('appl_no',$application_no);   	
		            $update = $this->db->update("applicant_appl_overview",$update_data); 	
		            if(!$update)
					{
						$dbStatus = "ERROR";
						$dbMessage = 'Error updating';
					}
					/*echo $this->db->last_query();
					die();*/
					$new_data = array(
		                    'id' =>'NULL',
		                    'appl_no' =>$application_no,
		                    'form_no' =>$application_no,
		                    'applied_program' =>$program_code,
		                    'appl_status' => 'Verified',
		                    'reg_user_id' => $reg_user_id,
		                    'created_by' => $reg_user_id,
		                    'created_on' => $date
		               	);
		            $this->db->insert("applicant_appl_overview_history",$new_data); 	
					if($this->db->affected_rows() == 0)
					{
						$dbStatus = "ERROR";
						$dbMessage = 'Error inserting';
					}
					/*echo $this->db->last_query();
					die();*/
					$new_seq_no = $sequence_no + 1;
					//echo $index;
					if($index == '')
					{
						$update_data = array(
		                    'sequence_no' =>$new_seq_no
		               	);
			            $this->db->where('program_code',$program_code);   	
			            $update = $this->db->update("index_sequence_setup",$update_data);
			            if(!$update)
						{
							$dbStatus = "ERROR";
							$dbMessage = 'Error updating';
						} 	
					}
					
					$this->db->select("A.template_code,B.file_name,B.template_name"); 	
		            $this->db->from("counselling_program_master A"); 	
		            $this->db->join('form_template_master B ','A.template_code = B.template_code','inner');
		            $this->db->where('A.program_code ',$program_code);
					$result = $this->db->get();
					$output_data = $result->result_array();
					
					foreach($output_data as $row)
					{
						$file_name = $row['file_name'];
						$temp_code = $row['template_code'];
						$temp_name = explode(".",$file_name);
						$print_function = $temp_name[0]."_pdf";
						$print_file_name = $temp_name[0]."pdf.php";
					}
					//$objMpdf = new Mpdf_controller();
					/*echo $dbStatus;
        			die();*/
					$controllerInstance = & get_instance();
        			$return = $controllerInstance->$print_function();
        			
        			if($dbStatus == "SUCCESS")
					{
						if($return)
						{
							//echo DOCUMENT_UPLOAD_URL.'/'.$program_code.'/'.$application_no.'/application_print_008.pdf';
							if(file_exists(DOCUMENT_UPLOAD_URL.'/'.$program_code.'/'.$application_no.'/application_print.pdf'))
							{
								//echo "hiii";
							
								$this->db->trans_complete();
								$dbStatus = "SUCCESS";
								$dbMessage = 'Application Submitted Successfully';
							}
							else
							{
								$this->db->trans_rollback();
							}
						}
						else
						{
							$this->db->trans_rollback();
							$dbStatus = "ERROR";
							$dbMessage = 'Error in Application Submission';
						}
					}
				}
				else
				{
					$radioPayment = $_POST['hidPaymentMode'];
					$txtChallanNo = trim($_POST['txtChallanNo']);
					$txtChallanDate = $_POST['txtChallanDate'];
					$txtSbiRefNo = $_POST['txtSbiRefNo'];
					$txtCollectDate = $_POST['txtCollectDate'];
					/*if($radioPayment == "ONLINE")
					{
						//show in .php
						header("location: onlinepaymentinstruction.php?ins=$hex_ins_code&_s=$MY_SESSION_NAME"); 	
							
					}*/
					if($radioPayment == "CHALLAN")
					{
						
						$this->db->select('category,last_grade');
						$this->db->from('applicant_master');
						$this->db->where('reg_user_id',$reg_user_id);
						$this->db->where('STATUS','1');
						$this->db->where('applied_program',$program_code);
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row)
						{
							$category = $row['category'];
						}
				
						$this->db->select("amount"); 	
			            $this->db->from("program_fee_setup"); 	
			            $this->db->where('program_code ',$program_code);
			            $this->db->where('category_code ',$category);
			            $result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row)
						{
							$amount = $row_amt['amount'];
						}
						$this->db->trans_start();
						
						$this->db->select("COUNT(appl_no) as appl_no"); 	
			            $this->db->from("counselling_applicant_form_fee_overview"); 	
			            $this->db->where('appl_no ',$application_no);
			            $result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row)
						{
							$appl_no = $row_amt['appl_no'];
							if($appl_no >= 1)
							{
								$update_data = array(
			                    'money_deposit_mode' =>'CHALLAN',
			                    'amount' =>$amount,
			                    'depositdate' =>date('Y-m-d', strtotime($txtChallanDate)),
			                    'money_receipt_no' =>$txtChallanNo,
			                    'modified_by' => $reg_user_id,
			                    'modified_on' => $date
			               		);
					            $this->db->insert("counselling_applicant_form_fee_overview",$update_data); 	
								$result = $this->db->get();
							}
							else
							{
								$new_data = array(
			                    'id' =>'NULL',
			                    'appl_no' =>$application_no,
			                    'money_deposit_mode' =>'CHALLAN',
			                    'amount' =>$amount,
			                    'depositdate' =>date('Y-m-d', strtotime($txtChallanDate)),
			                    'money_receipt_no' =>$txtChallanNo,
			                    'created_by' => $reg_user_id,
			                    'created_on' => $date
				               	);
					            $this->db->insert("counselling_applicant_form_fee_overview",$new_data); 	
								$result = $this->db->get();
								
							}
						}
						$new_data = array(
		                    'id' =>'NULL',
		                    'appl_no' =>$application_no,
		                    'money_deposit_mode' =>'CHALLAN',
		                    'depositdate' =>date('Y-m-d', strtotime($txtChallanDate)),
		                    'challan_bank' =>$bank_name,
		                    'challan_number' =>$txtChallanNo,
		                    'deposit_status' =>'Pending',
		                    'created_by' => $reg_user_id,
		                    'created_on' => $date
		               	);
			            $this->db->insert("applicant_form_challan_deposit",$new_data); 	
						$result = $this->db->get();
						
						$new_data = array(
		                    'appl_status' =>'Fee Paid',
		                    'updated_by' => $reg_user_id,
		                    'updated_on' => $date
		               	);
			            $this->db->where('appl_no',$application_no); 	
			            $this->db->update("applicant_appl_overview",$new_data); 	
						$result = $this->db->get();
						
						$new_data = array(
		                    'id' =>'NULL',
		                    'reg_user_id' =>$reg_user_id,
		                    'appl_no' =>$application_no,
		                    'form_no' =>$application_no,
		                    'applied_program' =>$program_code,
		                    'appl_status' =>'Fee Paid',
		                    'created_by' => $reg_user_id,
		                    'created_on' => $date
		               	);
			            $this->db->insert("applicant_appl_overview_history",$new_data); 	
						$result = $this->db->get();
						
						$this->db->select("A.template_code,B.file_name,B.template_name"); 	
			            $this->db->from("counselling_program_master A"); 	
			            $this->db->join('form_template_master B ','A.template_code = B.template_code','inner');
			            $this->db->where('A.program_code ',$program_code);
						$sql = $this->db->get();
						$output_data = $result->result_array();
						if($sql)
						{
							foreach($output_data as $row)
							{
								$file_name = $row['file_name'];
								$temp_code = $row['template_code'];
								$temp_name = explode(".",$file_name);
								$print_function = $temp_name[0]."pdf";
								$print_file_name = $temp_name[0]."pdf.php";
							}
						}
						$return = $print_function();
						if($return == true)
						{
							if(file_exists($document_upload_url.'/'.$seladmcode.'/'.$application_no.'/application_print.pdf'))
							{
								$this->db->trans_complete();
							}
							else
							{
								$this->db->trans_rollback();
							}
						}
						else
						{
							$this->db->trans_rollback();
						}
							
							
					}
					else if($radioPayment == "SBI")
					{
						$this->db->select('category,last_grade');
						$this->db->from('applicant_master');
						$this->db->where('reg_user_id',$reg_user_id);
						$this->db->where('STATUS','1');
						$this->db->where('applied_program',$program_code);
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row)
						{
							$category = $row['category'];
						}
						
						$this->db->select("amount");
						$this->db->from('program_fee_setup');
						$this->db->where('program_code',$program_code);
						$this->db->where('category_code',$category);
						$result = $this->db->get();
						$output_data = $result->result_array();
						foreach($output_data as $row_amt)
						{
							$amount = $row_amt['amount'];
						}
						
						
						$this->db->select("count(appl_no) AS appl_no");
						$this->db->from('counselling_applicant_form_fee_overview');
						$this->db->where('appl_no',$application_no);
						$this->db->where('money_deposit_mode','SBI Collect');
						
						$result = $this->db->get();
						$output_data = $result->result_array();
						
						foreach ($output_data as $aRow1) 
	            		{
	            			$result = $aRow1['appl_no'];
							if($result >= 1)
							{
								$update_data = array(
									'money_deposit_mode' 			=>'SBI Collect',
									'amount' 						=>$amount,
									'depositdate' 					=>date('Y-m-d', strtotime($txtCollectDate)),
									'money_receipt_no'				=>$txtSbiRefNo,
									'modified_by'					=>$reg_user_id,
									'modified_on'					=>$date
								);
								$this->db->where('appl_no',$application_no );
								$this->db->where('money_deposit_mode','SBI Collect' );
								$sql = $this->db->update('counselling_applicant_form_fee_overview', $update_data);
								//echo $this->db->last_query();
								if(!$sql){
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									//$dbError = ;	
								}
							}
							else
							{
								$new_data = array(
									'id' 							=>'NULL',
									'appl_no' 						=>$application_no,
									'money_deposit_mode' 			=>'SBI Collect',
									'amount' 						=>$amount,
									'depositdate' 					=>date('Y-m-d', strtotime($txtCollectDate)),
									'money_receipt_no' 				=>$txtSbiRefNo,
									'created_by'					=>$reg_user_id,
									'created_on'					=>$date
								);
								$sql = $this->db->insert('counselling_applicant_form_fee_overview', $new_data);
								//echo $this->db->last_query();
								if(!$sql){
									$dbStatus = "ERROR";
									$dbMessage = "Error Inserting";
									//$dbError = ;	
								}
							}
		                }
						
						$new_data = array(
							'id' 							=>'NULL',
							'appl_no' 						=>$application_no,
							'money_deposit_mode' 			=>'SBI Collect',
							'depositdate' 					=>date('Y-m-d', strtotime($txtCollectDate)),
							'challan_bank' 					=>$bank_name,
							'challan_number' 				=>$txtSbiRefNo,
							'deposit_status' 				=>'Pending',
							'created_by'					=>$reg_user_id,
							'created_on'					=>$date
						);
						$sql = $this->db->insert('applicant_form_challan_deposit', $new_data);
						if(!$sql){
							$dbStatus = "ERROR";
							$dbMessage = "Error Inserting";
						}
						
						$update_data = array(
							'appl_status' 					=>'Fee Paid',
							'updated_by'					=>$reg_user_id,
							'updated_on'					=>$date
						);
						$this->db->where('appl_no', $application_no);
						$sql = $this->db->update('applicant_appl_overview', $update_data);
						if(!$sql){
							$dbStatus = "ERROR";
							$dbMessage = "Error Updating";
						}
						
						$new_data = array(
							'id' 							=>'NULL',
							'appl_no' 						=>$application_no,
							'reg_user_id' 			=>$reg_user_id,
							'form_no' 					=>$application_no,
							'applied_program' 					=>$program_code,
							'appl_status' 				=>'Fee Paid',
							'created_by'					=>$reg_user_id,
							'created_on'					=>$date
						);
						$sql = $this->db->insert('applicant_appl_overview_history', $new_data);
						if(!$sql){
							$dbStatus = "ERROR";
							$dbMessage = "Error Inserting";
						}
						
						$this->db->select("A.template_code,B.file_name,B.template_name"); 	
			            $this->db->from("counselling_program_master A"); 	
			            $this->db->join('form_template_master B ','A.template_code = B.template_code','inner');
			            $this->db->where('A.program_code ',$program_code);
						$sql = $this->db->get();
						$output_data = $result->result_array();
						if($sql)
						{
							foreach($output_data as $row)
							{
								$file_name = $row['file_name'];
								$temp_code = $row['template_code'];
								$temp_name = explode(".",$file_name);
								$print_function = $temp_name[0]."_pdf";
								$print_file_name = $temp_name[0]."pdf.php";
							}
						}
						$return = $this->$print_function();
						//$this->M$print_function;
						if($return == true)
						{
							echo "hello";
						}
						else
						{
							$this->db->trans_rollback();
						}
					}
				}
				return array('status' => $dbStatus, 'msg' =>$dbMessage);
			break;
			
			
			case 'add_document_data_apply3':
			
				$dbstatus = TRUE;
				$dbMessage = '';
				$mode = $this->session->userdata('mode');
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				$application_no = $this->session->userdata('appl_no');
				$data = $this->uri->uri_to_assoc();
				$institute = $data['ins'];
        		$ins =  encrypt_decrypt('decrypt', $institute);
        		date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d H:i:s', now());
        		$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute;
				$documentsReq = '';
				
				$uploaddir = DOCUMENT_UPLOAD_URL."/".$program_code."/".$application_no;
				//echo $uploaddir;die();
				$retrievedir = BASE_ADM_URL."/".$program_code."/".$application_no;
				if(!is_dir($uploaddir))
					mkdir($uploaddir,0777,true);
				exec("chmod -R 777 $uploaddir");//for giving folder permission to downlad that file 
				$allowed =  array('jpg','jpeg' ,'png','JPG','PNG');
				
			/*	function getMimeType($x)
				{
				    $mimetype = false;
				    if(function_exists('finfo_fopen')) {
				        // open with FileInfo
				    } elseif(function_exists('getimagesize')) {
				        // open with GD
				    } elseif(function_exists('exif_imagetype')) {
				       // open with EXIF
				    } elseif(function_exists('mime_content_type')) {
				       $mimetype = mime_content_type($x);
				    }
				    echo $mimetype;
				    return $mimetype;
				}*/
				
				//echo $mode; die();
				if($mode == "edit")
				{
					$error_count = 0;
					$i=0;
					$where = "(program_document_setup.record_status = 'Active' OR program_document_setup.record_status = '1')";
					
					$this->db->select('applicant_document_list.document_type_code,document_type,document_type_description,document_size_description,document_size_in_kb,document_preview_height,document_preview_width');
					$this->db->from('program_document_setup');
					$this->db->join('applicant_document_list', 'program_document_setup.document_type_code = applicant_document_list.document_type_code','inner');
					$this->db->join('document_type_master', 'program_document_setup.document_type_code = document_type_master.document_type_code','inner');
					$this->db->where('application_no',$application_no);
					$this->db->where('program_code',$program_code);
					$this->db->where('applicant_document_list.record_status','1');
					$this->db->where($where);
					$this->db->order_by('sl_no');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach($output_data as $row)
					{
						$documentsReq[] = $row;	
						$documentsDesc[] = $row['document_type'];
						$documentsCode[] = $row['document_type_code'];
					}
					foreach($documentsReq as $row)
	  				{
	  					if(isset($_FILES['fileDocument']['tmp_name'][$i]) && $_FILES['fileDocument']['tmp_name'][$i]!='')
				  		{
				  			$document_type_code = $row['document_type_code'];
				  			//$imageFileType = end(explode(".", $_FILES['fileDocument']['name'][$i]));
							
							$check = getimagesize($_FILES["fileDocument"]["tmp_name"][$i]);
							if($check['mime'] != 'image/jpeg' && $check['mime'] != 'image/jpg' && $check['mime'] != 'image/png' && $check['mime'] != 'image/gif') {
								return array('status'=>false, 'msg'=>"Invalid image Type");
							}
							
							//$check = getMimeType($_FILES["fileDocument"]["tmp_name"][$i]);
							
							//echo $check .'h'; die();
							
							// Check file size
							if($_FILES["fileDocument"]["size"][$i] > 1536000) {
								return array('status'=>false, 'msg'=>"Size of the image should be within 1MB");
							}
							// Allow certain file formats
							if(substr_count($_FILES['fileDocument']['name'][$i],".")==1 && substr_count($_FILES['fileDocument']['name'][$i],"%0")==0 ) {
								//echo 'success';
							}else{
								return array('status'=>false, 'msg'=>"Invalid document format or file name(file name should not contain multipe dot(.) or `%0`)");
							}
							if(isset($_FILES['fileDocument']['tmp_name'][$i]) && $_FILES['fileDocument']['tmp_name'][$i]!=''){
								//$image_name = base64_encode(file_get_contents($_FILES['fileinstitutelogo']['tmp_name']));
								//$pic_name = $this->session->userdata('user_id')."1".time().".png";//$_FILES['fileinstitutelogo']['name'];
								//$pic_name = $this->input->post('institutecode').md5(uniqid($user)).".".$imageFileType;//$_FILES['fileinstitutelogo']['name'];
								
								//echo $uploads_dir. base_url('public');
								$docimagetemp = $_FILES['fileDocument']['tmp_name'][$i];		
								//echo "PHoto upload status".$result.dirname(__FILE__) ;
								//echo FCPATH."#".APPPATH."##".BASEPATH;
								//die();
							}
							
							$docimagetemp = $_FILES['fileDocument']['tmp_name'][$i];
							$doc_name= explode(".",$_FILES['fileDocument']["name"][$i]);
							$ext_doc = strtolower(end($doc_name));
							$docImageFileName = $document_type_code.'.'.$ext_doc;
							move_uploaded_file($docimagetemp,$uploaddir."/".$docImageFileName);	
							$docImagePath = $retrievedir."/".$docImageFileName;
							//echo $docImagePath;
						
							if(!in_array($ext_doc,$allowed) ) {
							    $error_count++;
							}
							else
							{
								move_uploaded_file($_FILES['fileDocument']['tmp_name'][$i], $uploaddir);
								$doc_id = $application_no.'_'.$document_type_code;
								
								$this->db->select("count(doc_id) AS doc_id");
								$this->db->from('applicant_form_documents');
								$this->db->where('doc_id',$doc_id);
								
								$result = $this->db->get();
								$output_data = $result->result_array();
								
								foreach ($output_data as $aRow1) 
			            		{
			            			$result = $aRow1['doc_id'];
									if($result >= 1)
									{
										$update_data = array(
											'document_submit_date' 			=>$date,
											'document_path' 				=>$docImagePath,
											'updated_by'					=>$reg_user_id,
											'updated_on'					=>$date,
											'status'						=>'1'
										);
										$this->db->where('doc_id',$doc_id);
										$sql = $this->db->update('applicant_form_documents', $update_data);
										//echo $this->db->last_query();
										if(!$sql){
											$dbstatus = "ERROR";
											$dbMessage = "Error Inserting";
											//$dbError = ;	
										}
									}
									else
									{
										$new_data = array(
											//'id' 							=>'NULL',
											'appl_no' 						=>$application_no,
											'doc_id' 						=>$doc_id,
											'document_type' 				=>$document_type_code,
											'document_submit_status' 		=>'Submitted',
											'document_submit_date' 			=>$date,
											'submit_mode' 					=>'ONLINE',
											'document_path' 				=>$docImagePath,
											'created_by'					=>$reg_user_id,
											'created_on'					=>$date
										);
										
										
										$sql = $this->db->insert('applicant_form_documents', $new_data);
										//echo $this->db->last_query();
										if(!$sql){
											$dbstatus = "ERROR";
											$dbMessage = "Error Inserting";
											//$dbError = ;	
										}
									}
				                }
								
							}
							
						}
						$i++;
	  				}
	  				if($error_count == 0)
					{
						$update_data = array(
							//'appl_status' 					=>'Document Uploaded',
							'updated_by'					=>$reg_user_id,
							'updated_on'					=>$date,
							'status'						=>'1'
						);
						$this->db->where('appl_no',$application_no);
						$sql = $this->db->update('applicant_appl_overview', $update_data);
						echo $this->db->last_query();
						if(!$sql){
							$dbstatus = "ERROR";
							$dbMessage = "Error Inserting";
							//$dbError = ;	
						}
						
						$new_data = array(
							'id' 							=>'NULL',
							'reg_user_id' 					=>$reg_user_id,
							'appl_no' 						=>$application_no,
							'form_no' 						=>$application_no,
							'applied_program' 				=>$program_code,
							'appl_status' 					=>'Document Uploaded',
							'created_by'					=>$reg_user_id,
							'created_on'					=>$date
						);
						
						
						$sql = $this->db->insert('applicant_appl_overview_history', $new_data);
						//echo $this->db->last_query();
						if(!$sql){
							$dbstatus = "ERROR";
							$dbMessage = "Error Inserting";
							//$dbError = ;	
						}
					
					//header("location: apply-4.php?ins=$hex_ins_code&_s=$MY_SESSION_NAME");
					}
					else
					{
						if($error_count == $i)
						{
							$dbstatus = FALSE;
							$dbMessage = 'Error While Saving';
						}
						else
						{
							$dbstatus = FALSE;
							$dbMessage = 'Error While Saving';
						}
						
					}
					
				}
				else
				{
					$i=0;
					$error_count = 0;
					$where = "(program_document_setup.record_status = 'Active' OR program_document_setup.record_status = '1')";
					
					$this->db->select('applicant_document_list.document_type_code,document_type,document_type_description,document_size_description,document_size_in_kb,document_preview_height,document_preview_width');
					$this->db->from('program_document_setup');
					$this->db->join('applicant_document_list', 'program_document_setup.document_type_code = applicant_document_list.document_type_code','inner');
					$this->db->join('document_type_master', 'program_document_setup.document_type_code = document_type_master.document_type_code','inner');
					$this->db->where('application_no',$application_no);
					$this->db->where('program_code',$program_code);
					$this->db->where('applicant_document_list.record_status','1');
					$this->db->where($where);
					$this->db->order_by('sl_no');
					$result = $this->db->get();
					$output_data = $result->result_array();
					foreach($output_data as $row)
					{
						$documentsReq[] = $row;	
						$documentsDesc[] = $row['document_type'];
						$documentsCode[] = $row['document_type_code'];
					}
					foreach($documentsReq as $row)
	  				{
	  					if(isset($_FILES['fileDocument']['tmp_name'][$i]) && !empty($_FILES['fileDocument']['tmp_name'][$i]))
				  		{
				  			$document_type_code = $row['document_type_code'];
				  			$imageFileType = end((explode(".", $_FILES['fileDocument']['name'][$i])));
							$check = getimagesize($_FILES["fileDocument"]["tmp_name"][$i]);
							
							if($check !== false) {

							} 
							else 
							{
								return array('status'=>false, 'msg'=>"Not an Image");
							}
							
							// Check file size
							if($_FILES["fileDocument"]["size"][$i] > 1536000) {
								return array('status'=>false, 'msg'=>"Size of the image should be within 1MB");
							}
							// Allow certain file formats
							if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
								return array('status'=>false, 'msg'=>"Supported file types are jpg/png/jpeg/gif");
							}
							if(isset($_FILES['fileDocument']['tmp_name'][$i]) && !empty($_FILES['fileDocument']['tmp_name'][$i])){
								//$image_name = base64_encode(file_get_contents($_FILES['fileinstitutelogo']['tmp_name']));
								//$pic_name = $this->session->userdata('user_id')."1".time().".png";//$_FILES['fileinstitutelogo']['name'];
								$pic_name = $this->input->post('institutecode').md5(uniqid($user)).".".$imageFileType;//$_FILES['fileinstitutelogo']['name'];
					
								//echo $uploads_dir. base_url('public');
								/*$result = move_uploaded_file($_FILES['fileDocument']['tmp_name'][$i], $uploads_dir);*/
								//echo "PHoto upload status".$result.dirname(__FILE__) ;
								//echo FCPATH."#".APPPATH."##".BASEPATH;
								//die();
							}
							
							$docimagetemp = $_FILES['fileDocument']['tmp_name'][$i];
							$doc_name= explode(".",$_FILES['fileDocument']["name"][$i]);
							$ext_doc = strtolower(end($doc_name));
							$docImageFileName = $document_type_code.'.'.$ext_doc;
							move_uploaded_file($docimagetemp,$uploaddir."/".$docImageFileName);	
							$docImagePath = $retrievedir."/".$docImageFileName;
							
				  			
							if(!in_array($ext_doc,$allowed) ) {
							    $error_count++;
							}
							else
							{
								move_uploaded_file($_FILES['fileDocument']['tmp_name'][$i], $uploaddir);
								$doc_id = $application_no.'_'.$document_type_code;
								
								$this->db->select("count(doc_id) AS doc_id");
								$this->db->from('applicant_form_documents');
								$this->db->where('doc_id',$doc_id);
								
								$result = $this->db->get();
								$output_data = $result->result_array();
								
								foreach ($output_data as $aRow1) 
			            		{
			            			$result = $aRow1['doc_id'];
									if($result >= 1)
									{
										$update_data = array(
											'document_submit_date' 			=>$date,
											'document_path' 				=>$docImagePath,
											'updated_by'					=>$reg_user_id,
											'updated_on'					=>$date,
											'status'						=>'1'
										);
										$this->db->where('doc_id',$doc_id);
										$sql = $this->db->update('applicant_form_documents', $update_data);
										//echo $this->db->last_query();
										if(!$sql){
											$dbStatus = "ERROR";
											$dbMessage = "Error Inserting";
											//$dbError = ;	
										}
									}
									else
									{
										$new_data = array(
											'id' 							=>'NULL',
											'appl_no' 						=>$application_no,
											'doc_id' 						=>$doc_id,
											'document_type' 				=>$document_type_code,
											'document_submit_status' 		=>'Submitted',
											'document_submit_date' 			=>$date,
											'submit_mode' 					=>'ONLINE',
											'document_path' 				=>$docImagePath,
											'created_by'					=>$reg_user_id,
											'created_on'					=>$date
										);
										
										
										$sql = $this->db->insert('applicant_form_documents', $new_data);
										//echo $this->db->last_query();
										if(!$sql){
											$dbStatus = "ERROR";
											$dbMessage = "Error Inserting";
											//$dbError = ;	
										}
									}
				                }
								
							}
						}
						$i++;
					}
					
					if($error_count == 0)
					{
						$update_data = array(
							'appl_status' 					=>'Document Uploaded',
							'updated_by'					=>$reg_user_id,
							'updated_on'					=>$date,
							'status'						=>'1'
						);
						$this->db->where('appl_no',$application_no);
						$sql = $this->db->update('applicant_appl_overview', $update_data);
						//echo $this->db->last_query();
						if(!$sql){
							$dbStatus = "ERROR";
							$dbMessage = "Error Inserting";
							//$dbError = ;	
						}
						
						$new_data = array(
							'id' 							=>'NULL',
							'reg_user_id' 					=>$reg_user_id,
							'appl_no' 						=>$application_no,
							'form_no' 						=>$application_no,
							'applied_program' 				=>$program_code,
							'appl_status' 					=>'Document Uploaded',
							'created_by'					=>$reg_user_id,
							'created_on'					=>$date
						);
						
						
						$sql = $this->db->insert('applicant_appl_overview_history', $new_data);
						//echo $this->db->last_query();
						if(!$sql){
							$dbStatus = "ERROR";
							$dbMessage = "Error Inserting";
							//$dbError = ;	
						}
						//header("location: apply-4.php?ins=$hex_ins_code&_s=$MY_SESSION_NAME");
					}
					else
					{
						if($error_count == $i)
						{
							$dbstatus = FALSE;
							$dbMessage = 'Error While Saving';
						}
						else
						{
							$dbstatus = FALSE;
							$dbMessage = 'Error While Saving';
						}
						
					}
					
					
				}
				return array('status' => $dbstatus, 'msg' =>$dbMessage);
				
			break;
			
			case 'add_application_data_temp008':
				
				$dbstatus = TRUE;
				$cmbExamCenter = isset($_POST['cmbExamCenter']) ? $_POST['cmbExamCenter'] : 'C001';
				$txtFirstName = isset($_POST['txtFirstName']) ? trim($_POST['txtFirstName']) : '';

				$master_name = isset($_POST['master_name']) ? trim($_POST['master_name']) : '';
				$center_name1 = isset($_POST['center_name1']) ? trim($_POST['center_name1']) : '';
				$center_code1 = isset($_POST['center_code1']) ? trim($_POST['center_code1']) : '';
				$center_name2 = isset($_POST['center_name2']) ? trim($_POST['center_name2']) : '';
				$center_code2 = isset($_POST['center_code2']) ? trim($_POST['center_code2']) : '';
				$center_name3 = isset($_POST['center_name3']) ? trim($_POST['center_name3']) : '';
				$center_code3 = isset($_POST['center_code3']) ? trim($_POST['center_code3']) : '';

				$FathersProfession = isset($_POST['FathersProfession']) ? trim($_POST['FathersProfession']) : '';
				$FathersIncome = isset($_POST['FathersIncome']) ? trim($_POST['FathersIncome']) : '';
				$cmbNorthState = isset($_POST['cmbNorthState']) ? trim($_POST['cmbNorthState']) : '';

				$txtMotherName = isset($_POST['txtMotherName']) ? trim($_POST['txtMotherName']) : '';
				$MothersProfession = isset($_POST['MothersProfession']) ? trim($_POST['MothersProfession']) : '';
				$MothersIncome = isset($_POST['MothersIncome']) ? trim($_POST['MothersIncome']) : '';
				
				$mothers_adhar_no = isset($_POST['txtUidM']) ? trim($_POST['txtUidM']) : '';
				$fathers_adhar_no = isset($_POST['txtUidF']) ? trim($_POST['txtUidF']) : '';
				$txtUid = isset($_POST['txtUid']) ? trim($_POST['txtUid']) : '';
				 



				$employed = isset($_POST['employed']) ? trim($_POST['employed']) : '';
				$Employer_address = isset($_POST['Employer_address']) ? trim($_POST['Employer_address']) : '';
				$Employer_from = isset($_POST['Employer_from']) ? trim($_POST['Employer_from']) : '';
				$Employer_to = isset($_POST['Employer_to']) ? trim($_POST['Employer_to']) : '';
				$Employer_address1 = isset($_POST['Employer_address1']) ? trim($_POST['Employer_address1']) : '';
				$Employer_from1 = isset($_POST['Employer_from1']) ? trim($_POST['Employer_from1']) : '';
				$Employer_to1 = isset($_POST['Employer_to1']) ? trim($_POST['Employer_to1']) : '';




				$cand_name = isset($_POST['cand_name']) ? trim($_POST['cand_name']) : '';
				$co_name = isset($_POST['co_name']) ? trim($_POST['co_name']) : '';
				$city_name = isset($_POST['city_name']) ? trim($_POST['city_name']) : '';
				$phone_no = isset($_POST['phone_no']) ? trim($_POST['phone_no']) : '';
				$cand_name1 = isset($_POST['cand_name1']) ? trim($_POST['cand_name1']) : '';
				$co_name1 = isset($_POST['co_name1']) ? trim($_POST['co_name1']) : '';
				$city_name1 = isset($_POST['city_name1']) ? trim($_POST['city_name1']) : '';
				$phone_no1 = isset($_POST['phone_no1']) ? trim($_POST['phone_no1']) : '';
				$completion_date = isset($_POST['completion_date']) ? trim($_POST['completion_date']) : '';
				$amount_paid = isset($_POST['amount_paid']) ? trim($_POST['amount_paid']) : '';
				$draft_no = isset($_POST['draft_no']) ? trim($_POST['draft_no']) : '';
				$payment_date = isset($_POST['payment_date']) ? trim($_POST['payment_date']) : '';
				$bank_name = isset($_POST['bank_name']) ? trim($_POST['bank_name']) : '';

				/*te*/

				

				$txtMiddleName = isset($_POST['txtMiddleName']) ?  trim($_POST['txtMiddleName']) : '';
				$txtLastName = isset($_POST['txtLastName']) ? trim($_POST['txtLastName']) : '';
				$fullname = $txtFirstName." ".$txtMiddleName." ".$txtLastName;

				$d = isset($_POST['cmbDay']) ? trim($_POST['cmbDay']) : '';
				$m = isset($_POST['cmbMonth']) ? trim($_POST['cmbMonth']) : '';
				$y = isset($_POST['cmbYear']) ? trim($_POST['cmbYear']) : '';
				$dob = $y.'-'.$m.'-'.$d;

				$dbStatus = "";
				$dbMessage = "";
				$dbError = "";

				$radiogender = isset($_POST['radiogender']) ? $_POST['radiogender'] : '';
				$radioHostel = isset($_POST['radioHostel']) ? $_POST['radioHostel'] : '';
				$radiomaritalstatus = isset($_POST['radiomaritalstatus']) ? $_POST['radiomaritalstatus'] : '';
				$radioQuota = isset($_POST['radioQuota']) ? $_POST['radioQuota'] : '';
				
				$cmbReservedCategory = isset($_POST['cmbCommunity']) ? $_POST['cmbCommunity'] : '';
				
				$cmbNationality = isset($_POST['cmbNationality']) ? $_POST['cmbNationality'] : '';
				$cmbCommunity = isset($_POST['cmbCommunity1']) ? $_POST['cmbCommunity1'] : '';

				$cmbrelationship = isset($_POST['cmbrelationship']) ? $_POST['cmbrelationship'] : '';
				$radioMinority = isset($_POST['radioMinority']) ? $_POST['radioMinority'] : '';
				$txtemail = isset($_POST['txtemail']) ? $_POST['txtemail'] : '';
				$txtemail1 = isset($_POST['txtemail1']) ? $_POST['txtemail1'] : '';
				$radiobelong = isset($_POST['radiobelong']) ? $_POST['radiobelong'] : '';
				$txtOccupation = isset($_POST['txtOccupation']) ? $_POST['txtOccupation'] : '';
				$txtIncome = isset($_POST['txtIncome']) ? $_POST['txtIncome'] : '';
				$txtIndicate = isset($_POST['txtIndicate']) ? $_POST['txtIndicate'] : '';
				$txtKnowabout = isset($_POST['txtKnowabout']) ? $_POST['txtKnowabout'] : '';
				$radioPhysicallY  = isset($_POST['radioPhysicallY']) ? $_POST['radioPhysicallY'] : '';
				$txtphtype  = isset($_POST['txtphtype']) ? $_POST['txtphtype'] : '';
				
				$txtOtherNationality = isset($_POST['txtOtherNationality']) ? trim($_POST['txtOtherNationality']) : '';
				$txtOtherRelations = isset($_POST['txtOtherRelations']) ? trim($_POST['txtOtherRelations']) : '';
				$txtMotherTongue = isset($_POST['txtMotherTongue']) ? trim($_POST['txtMotherTongue']) : '';
				$cmbCategory = isset($_POST['cmbCategory']) ? $_POST['cmbCategory'] : '';
				$cmbReligion = isset($_POST['cmbReligion']) ? $_POST['cmbReligion'] : '';
				$txtUnivRegNo = isset($_POST['txtUnivRegNo']) ? $_POST['txtUnivRegNo'] : '';
				//$cmbHighestQualification = isset($_POST['txtQualifyingDegree']) ? $_POST['txtQualifyingDegree'] : '';
				$cmbPassStatus = isset($_POST['cmbPassStatus']) ? $_POST['cmbPassStatus'] : '';
				$txtSubject1 = isset($_POST['txtSubject1']) ? $_POST['txtSubject1'] : '';
				$txtSubject2 = isset($_POST['txtSubject2']) ? $_POST['txtSubject2'] : '';
				$txtSubject3 = isset($_POST['txtSubject3']) ? $_POST['txtSubject3'] : '';
				$txtSubject4 = isset($_POST['txtSubject4']) ? $_POST['txtSubject4'] : '';
				$txtUnivName = isset($_POST['txtUnivName']) ? $_POST['txtUnivName'] : '';
				$txtTotalMarks = isset($_POST['txtTotalMarks']) ? $_POST['txtTotalMarks'] : '';
				$txtHonsTotalMarks = isset($_POST['txtHonsTotalMarks']) ? $_POST['txtHonsTotalMarks'] : '';
				$txtHonoursSubject = isset($_POST['txtHonoursSubject']) ? $_POST['txtHonoursSubject'] : '';
				$txtSecuredMarks = isset($_POST['txtSecuredMarks']) ? $_POST['txtSecuredMarks'] : '';
				$txtHonsSecuredMarks = isset($_POST['txtHonsSecuredMarks']) ? $_POST['txtHonsSecuredMarks'] : '';
				$radioDistinction = isset($_POST['radioDistinction']) ? $_POST['radioDistinction'] : '';
				$radioCourseType = isset($_POST['radioCourseType']) ? $_POST['radioCourseType'] : '';
				$cmbHighestQualification = isset($_POST['cmbHighestQualification']) ? trim($_POST['cmbHighestQualification']) : '';
				$txtHonsDivision = isset($_POST['txtHonsDivision']) ?  trim($_POST['txtHonsDivision']) : '';
				$radioMigrant = isset($_POST['radioMigrant']) ?  trim($_POST['radioMigrant']) : 'NO';
				//Parent Information
				$txtFatherName = isset($_POST['txtFatherName']) ?  trim($_POST['txtFatherName']) : '';
				$txtFatherOccupation = isset($_POST['txtFatherOccupation']) ?  trim($_POST['txtFatherOccupation']) : '';
				$txtMotherName = isset($_POST['txtMotherName']) ? trim($_POST['txtMotherName']) : '';
				$txtMotherOccupation = isset($_POST['txtMotherOccupation']) ?  trim($_POST['txtMotherOccupation']) : '';
				$txtGuardianName = isset($_POST['txtGuardianName']) ?  trim($_POST['txtGuardianName']) : '';
				$txtGuardianOccupation = isset($_POST['txtGuardianOccupation']) ?  trim($_POST['txtGuardianOccupation']) : '';
				//Address
				//present
				$txtPresentAddress = isset($_POST['txtPresentAddress']) ?  trim($_POST['txtPresentAddress']) : '';
				$txtPresentLocality = isset($_POST['txtPresentLocality']) ? trim($_POST['txtPresentLocality']) : '';
				$txtPresentPost = isset($_POST['txtPresentPost']) ? trim($_POST['txtPresentPost']) : '';
				$cmbPresentDist = isset($_POST['cmbPresentDist']) ?  trim($_POST['cmbPresentDist']) : '';
				$txtPresentPin = isset($_POST['txtPresentPin']) ? trim($_POST['txtPresentPin']) : '';
				$cmbPresentState = isset($_POST['cmbPresentState']) ? trim($_POST['cmbPresentState']) : '';
				$txtPresentDistance = isset($_POST['txtPresentDistance']) ? trim($_POST['txtPresentDistance']) : '';

				//if permanent is same as present
				$chksameasresidential = isset($_POST['chksameasresidential']) ? $_POST['chksameasresidential']:'N';
				$txtPermenentAddress = isset($_POST['hidPermenentAddress']) ? trim($_POST['hidPermenentAddress']) : '';
				$txtPermenentLocality = isset($_POST['txtPermenentLocality']) ? trim($_POST['txtPermenentLocality']) : '';
				$txtPermanentPost = isset($_POST['txtPermanentPost']) ? trim($_POST['txtPermanentPost']) : '';
				$txtPermanentDist = isset($_POST['cmbPermanentDist']) ? trim($_POST['cmbPermanentDist']) : '';
				$txtPermanentState = isset($_POST['cmbPermanentState']) ?  trim($_POST['cmbPermanentState']) : '';
				$txtPermanentPin = isset($_POST['txtPermanentPin']) ? trim($_POST['txtPermanentPin']) : '';
				$txtPermanentMobile = isset($_POST['txtPermanentMobile']) ? trim($_POST['txtPermanentMobile']) : '';
				
					
				$txtApplicantEmail = isset($_POST['txtApplicantEmail']) ? trim($_POST['txtApplicantEmail']) : '';
				$txtApplicantLandLine = isset($_POST['txtApplicantLandLine']) ?  trim($_POST['txtApplicantLandLine']) : '';
				$txtApplicantMobile = isset($_POST['txtApplicantMobile']) ?  trim($_POST['txtApplicantMobile']) : '';
				$txtOtherUniversity = isset($_POST['txtOtherUniversity']) ?  trim($_POST['txtOtherUniversity']) : '';
				if($txtUnivName != 'OTH')
				{
					$txtOtherUniversity = '';
				}
				$txtOtherSubject = isset($_POST['txtOtherSubject']) ? trim($_POST['txtOtherSubject']) : '';
				if($txtHonoursSubject != 'OTH')
				{
					$txtOtherSubject = '';
				}
				//Academic Details
				$program_code = $this->session->userdata('admcode');
				$reg_user_id = $this->session->userdata('reg_user_id');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("A.qualification_code, B.qualification_name, B.division");
				$this->db->from('program_qualification_setup A');
				$this->db->join('qualification_master B','A.qualification_code = B.qualification_code','inner');
				$this->db->where('A.program_code',$program_code);
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.id');
				
				
				//print_r($query);
				$result = $this->db->get();
				//echo $this->db->last_query();
				//print_r($result);
				$allQualifications = $result->result_array();
				$slno = 1;
				foreach($allQualifications as $row)
				{
					${'txtQualification'.$slno} = isset($_POST['txtQualification'.$slno]) && $_POST['txtQualification'.$slno] != '' ? $_POST['txtQualification'.$slno] : '';
					${'txtYear'.$slno} = isset($_POST['txtYear'.$slno]) && trim($_POST['txtYear'.$slno]) != '' ? (int) trim($_POST['txtYear'.$slno]) : 'NULL';
					${'txtBoard'.$slno} = isset($_POST['txtBoard'.$slno]) && $_POST['txtBoard'.$slno] != '' ? $_POST['txtBoard'.$slno] : '';
					${'txtDivision'.$slno} = isset($_POST['txtDivision'.$slno]) && $_POST['txtDivision'.$slno] != '' ? $_POST['txtDivision'.$slno] : '';
					${'txtMS'.$slno} = isset($_POST['txtMS'.$slno]) && $_POST['txtMS'.$slno] != '' ? $_POST['txtMS'.$slno] : 'NULL';
					${'txtFM'.$slno} = isset($_POST['txtFM'.$slno]) && $_POST['txtFM'.$slno] != '' ? $_POST['txtFM'.$slno] : 'NULL';
					${'txtPercent'.$slno} = isset($_POST['txtPercent'.$slno]) && $_POST['txtPercent'.$slno] != '' ? $_POST['txtPercent'.$slno] : 'NULL';
					$slno++;
					//echo $_POST['txtQualification'.$slno];
				}
				$txtQualification3 = isset($_POST['txtQualification3']) && $_POST['txtQualification3'] != '' ? $_POST['txtQualification3'] : '';
				$txtYear3 = isset($_POST['txtYear3']) && trim($_POST['txtYear3']) != '' ? (int) trim($_POST['txtYear3']) : 'NULL';
				$txtBoard3 = isset($_POST['txtBoard3']) && $_POST['txtBoard3'] != '' ? $_POST['txtBoard3'] : '';
				$txtDivision3 = isset($_POST['txtDivision3']) && $_POST['txtDivision3'] != '' ? $_POST['txtDivision3'] : '';
				$txtMS3 = isset($_POST['txtMS3']) && $_POST['txtMS3'] != '' ? $_POST['txtMS3'] : 'NULL';
				$txtFM3 = isset($_POST['txtFM3']) && $_POST['txtFM3'] != '' ? $_POST['txtFM3'] : 'NULL';
				$txtPercent3 = isset($_POST['txtPercent3']) && $_POST['txtPercent3'] != '' ? $_POST['txtPercent3'] : 'NULL';
				//Entrance exam appeared
				  
				$txtQualification4 = isset($_POST['txtQualification4']) && $_POST['txtQualification4'] != '' ? $_POST['txtQualification4'] : '';
				$txtYear4 = isset($_POST['txtYear4']) && trim($_POST['txtYear4']) != '' ? (int) trim($_POST['txtYear4']) : 'NULL';
				$txtBoard4 = isset($_POST['txtBoard4']) && $_POST['txtBoard4'] != '' ? $_POST['txtBoard4'] : '';
				$txtDivision4 = isset($_POST['txtDivision4']) && $_POST['txtDivision4'] != '' ? $_POST['txtDivision4'] : '';
				$txtMS4 = isset($_POST['txtMS4']) && $_POST['txtMS4'] != '' ? $_POST['txtMS4'] : 'NULL';
				$txtFM4 = isset($_POST['txtFM4']) && $_POST['txtFM4'] != '' ? $_POST['txtFM4'] : 'NULL';
				$txtPercent4 = isset($_POST['txtPercent4']) && $_POST['txtPercent4'] != '' ? $_POST['txtPercent4'] : 'NULL';
				
				$txtQualification5 = isset($_POST['txtQualification5']) && $_POST['txtQualification5'] != '' ? $_POST['txtQualification5'] : '';
				$txtYear5 = isset($_POST['txtYear5']) && trim($_POST['txtYear5']) != '' ? (int) trim($_POST['txtYear5']) : 'NULL';
				$txtBoard5 = isset($_POST['txtBoard5']) && $_POST['txtBoard5'] != '' ? $_POST['txtBoard5'] : '';
				$txtDivision5 = isset($_POST['txtDivision5']) && $_POST['txtDivision5'] != '' ? $_POST['txtDivision5'] : '';
				$txtMS5 = isset($_POST['txtMS5']) && $_POST['txtMS5'] != '' ? $_POST['txtMS5'] : 'NULL';
				$txtFM5 = isset($_POST['txtFM5']) && $_POST['txtFM5'] != '' ? $_POST['txtFM5'] : 'NULL';
				$txtPercent5 = isset($_POST['txtPercent5']) && $_POST['txtPercent5'] != '' ? $_POST['txtPercent5'] : 'NULL';
				  
				//
				
				$radioExam = isset($_POST['radioExam']) ? $_POST['radioExam'] : '';
				$hidDate = isset($_POST['hidDate']) ? $_POST['hidDate'] : '';
				$txtExamMark = isset($_POST['txtExamMark']) && trim($_POST['txtExamMark']) != '' ? (float) trim($_POST['txtExamMark']) : 'NULL';
				$txtfinalpercentage = isset($_POST['txtfinalpercentage']) && trim($_POST['txtfinalpercentage']) != '' ? (float) trim($_POST['txtfinalpercentage']) : 'NULL';
				//$chkMAT = isset($_POST['chkMAT']) ? mysqli_real_escape_string($con, trim($_POST['chkMAT'])) : '';
				//$chkIACR = isset($_POST['chkIACR']) ? mysqli_real_escape_string($con, trim($_POST['chkIACR'])) : '';
				//$chkUU = isset($_POST['chkUU']) ? mysqli_real_escape_string($con, trim($_POST['chkUU'])) : '';

				//declaration
				$chkUndertaking1 = 1;
				$chkUndertaking2 = 2;
				$chkUndertaking3 = 3;
				$declaration1 = "I declare that the particulars furnished in this form are true to the best of my knowledge and belief and as per my certificates and valid official documents. I further declare that in case any of the above information is found to be incorrect at any time, I shall be liable to forfeit my seat and to such penal action as the University may deem appropriate.";
				$declaration2 = "I undertake to abide by the rules of the P.G. Council and P.G. Hostels, framed by the Berhampur University and if at any time, in any instance of breach of these rules, indiscipline, disobedience or misconduct or involvement in ragging is found against me, my name shall be struck off from the rolls of the University. ";
				$declaration3 = "I have understood the various provisions and rules of eligibility and admission to various P.G. Departments of Berhampur University as mentioned in the Prospectus along with the application form and I undertake to abide by any decision taken by the University authorities in regard to my eligibility and admission into P.G. Departments.";
				$chkApplicantUndertaking = isset($_POST['chkApplicantUndertaking']) ? mysqli_real_escape_string($con, trim($_POST['chkApplicantUndertaking'])) : '';
				$now = date("Y-m-d H:i:s");
				$mode = $this->session->userdata('mode');
				
				//echo $mode;die();
				if($mode == 'edit')
				{
					$this->db->trans_start();
					$dbstatus = TRUE;
					$dbmessage = 'Data saved successfully';
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					//print_r($applicant_master_update_array);die();
					/*$update_applicant = $this->db->update('applicant_master',$applicant_master_update_array);
					if(!$update_applicant){
						$dbstatus = FALSE;
						$dbmessage = 'Error updating applicant_master';
					}*/
					$this->db->select("CASE WHEN comm_address_ref_id = perm_address_ref_id THEN 'Y' ELSE 'N' END AS addresscheck,comm_address_ref_id, perm_address_ref_id");
					$this->db->from('applicant_master');
					$this->db->where('applied_program',$program_code);
					$this->db->where('reg_user_id',$reg_user_id);
					$result = $this->db->get();
					foreach($result->result_array() as $row)
					{
						$sameaspresent = $row['addresscheck'];
						$comm_address_ref_id = $row['comm_address_ref_id'];
						$perm_address_ref_id = $row['perm_address_ref_id'];
						
		
					}
					if($chksameasresidential == $sameaspresent && $chksameasresidential=='Y')
					{
						$applicant_address_array = array(
							'address_1' => $txtPresentLocality,
							'post_office' => $txtPresentPost,
							'district_code' => $cmbPresentDist,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'cand_name'=>$cand_name, 
							'co_name'=>$co_name,
							'city_name'=>$city_name, 
							'mobile'=>$phone_no, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant_address = $this->db->update('applicant_address',$applicant_address_array);
						if(!$update_applicant_address){
							$dbstatus = FALSE;
							$dbmessage = 'Error updating applicant_address_all';
						}
					}
					else if($chksameasresidential == $sameaspresent && $chksameasresidential=='N')
					{
						$applicant_address_array1 = array(
							'address_1' => $txtPresentLocality,
							'post_office' => $txtPresentPost,
							'district_code' => $cmbPresentDist,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'cand_name'=>$cand_name, 
							'co_name'=>$co_name,
							'city_name'=>$city_name, 
							'mobile'=>$phone_no, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant_address = $this->db->update('applicant_address',$applicant_address_array1);
						if(!$update_applicant_address){
							$dbstatus = FALSE;
							$dbmessage = 'Error updating applicant_address_present';
						}
						$applicant_address_array2 = array(
							'address_1' => $txtPermenentLocality,
							'post_office' => $txtPermanentPost,
							'district_code' => $txtPermanentDist,
							'state_code' => $txtPermanentState,
							'pin' => $txtPermanentPin,
							'email_id'=>$txtemail1, 
							'cand_name'=>$cand_name1, 
							'co_name'=>$co_name1, 
							'city_name'=>$city_name1, 
							'mobile'=>$phone_no1, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$perm_address_ref_id);
						$update_applicant_address = $this->db->update('applicant_address',$applicant_address_array2);
						if(!$update_applicant_address){
							$dbstatus = FALSE;
							$dbmessage = 'Error updating applicant_address_permanent';
						}
						
					}
					else if($chksameasresidential != $sameaspresent && $chksameasresidential=='Y')
					{
						$applicant_address_array3 = array(
							'address_1' => $txtPresentLocality,
							'post_office' => $txtPresentPost,
							'district_code' => $cmbPresentDist,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'cand_name'=>$cand_name, 
							'co_name'=>$co_name,
							'city_name'=>$city_name, 
							'mobile'=>$phone_no, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant = $this->db->update('applicant_address',$applicant_address_array3);
						if(!$update_applicant){
							$dbstatus = FALSE;
							$dbmessage = 'Error updating applicant_address_present';
						}
						$perm_address_ref_id=$comm_address_ref_id;
					}
					else if($chksameasresidential != $sameaspresent && $chksameasresidential=='N')
					{
						$applicant_address_array4 = array(
							'address_1' => $txtPresentLocality,
							'post_office' => $txtPresentPost,
							'district_code' => $cmbPresentDist,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'cand_name'=>$cand_name, 
							'co_name'=>$co_name,
							'city_name'=>$city_name, 
							'mobile'=>$phone_no, 
							'email_id'=>$txtemail, 
							'updated_by' => $reg_user_id,
							'updated_on' => $now 
						);
						$this->db->where('address_ref_id',$comm_address_ref_id);
						$update_applicant = $this->db->update('applicant_address',$applicant_address_array4);
						if(!$update_applicant){
							$dbstatus = FALSE;
							$dbmessage = 'Error updating applicant_address_present';
						}else{
							$applicant_address_array2 = array(
								'address_1' => $txtPermenentLocality,
								'post_office' => $txtPermanentPost,
								'district_code' => $txtPermanentDist,
								'state_code' => $txtPermanentState,
								'pin' => $txtPermanentPin,
								'email_id'=>$txtemail1, 
								'cand_name'=>$cand_name1, 
								'co_name'=>$co_name1, 
								'city_name'=>$city_name1, 
								'mobile'=>$phone_no1, 
								'updated_by' => $reg_user_id,
								'updated_on' => $now 
							);
							$this->db->insert('applicant_address',$applicant_address_array2);
							if($this->db->affected_rows() == 0)
							{
								$dbStatus = FALSE;
								$dbMessage = 'Error inserting Applicant Permanent';
							}
							else
								$perm_address_ref_id = $this->db->insert_id();
							
							
						}
					}
					
					
					$applicant_master_update_array = array(
							
						'first_name' => $txtFirstName,
						'mid_name' => $txtMiddleName,
						'last_name' => $txtLastName,
						'full_name' => $fullname,
						'exam_center_code' => $center_name1,
						'exam_center_code1' => $center_name2,
						'exam_center_code2' => $center_name3,
						'gender' => $radiogender,
						'nationality' => $cmbNationality,
						'cmbrelationship' => $cmbrelationship,
						'dob' => $dob,
						//'adhar_no' => $txtUid,
						'dob_in_word' => $hidDate,
						'category' => $cmbReservedCategory,
						'phtype'=>$txtphtype,
						
						'is_minority_community' => $radioMinority,
						'minority_community_details' => $cmbCommunity,
						
						'is_north_east' => $radiobelong,
						'father_occupation' => $txtOccupation,
						'annual_parent_income' => $txtIncome,
						'indicate_choice' => $txtIndicate,
						'know_about_cipet' => $txtKnowabout,
						'physically_challenged' => $radioPhysicallY ,
						
						'religion' => $cmbReligion,
						//'applicant_email' => $txtApplicantEmail,
						'applicant_landline' => $txtApplicantLandLine,
						'applicant_mobile' => $txtApplicantMobile,
						'mother_tongue' => $txtMotherTongue, 
						'hostel_facility' => $radioHostel,
						'marital_status' => $radiomaritalstatus,
						'is_reserved_quota' => $radioQuota,
						'updated_by' => $reg_user_id,
						'updated_on' => $now,
						'master_name'=>$master_name,
						'last_year_mark' => $txtfinalpercentage,
						/*'center_name1'=>$center_name1,
						'center_code1'=>$center_code1,
						'center_name2'=>$center_name2,
						'center_code2'=>$center_code2, 
						'center_name3'=>$center_name3,
						'center_code3'=>$center_code3,*/ 

						'father_occupation'=>$FathersProfession, 
							'annual_parent_income'=>$FathersIncome,
							'north_east_state'=>$cmbNorthState, 

							'mothers_profession'=>$MothersProfession, 
							'mothers_income'=>$MothersIncome,
							'mothers_name'=>$txtMotherName,
							//'fathers_adhar_no'=>$fathers_adhar_no,
							//'mothers_adhar_no'=>$mothers_adhar_no,

						'is_employed'=>$employed,
						'employer_add'=>$Employer_address,
						'employer_from'=>$Employer_from,
						'employer_to'=>$Employer_to,
						'employer_add1'=>$Employer_address1, 
						'employer_from1'=>$Employer_from1,
						'employer_to1'=>$Employer_to1, 
						'completion_date'=>$completion_date, 
						'comm_address_ref_id'=>$comm_address_ref_id,
						'perm_address_ref_id'=>$perm_address_ref_id 
						);
						$this->db->where('reg_user_id' , $reg_user_id);
						$this->db->where('applied_program',$program_code);
						$this->db->update('applicant_master',$applicant_master_update_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error update Applicant Master';
						}else{
							$applicant_history_insert_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'first_name' => $txtFirstName,
								'mid_name' => $txtMiddleName,
								'last_name' => $txtLastName,
								'full_name' => $fullname,
								'exam_center_code' => $center_name1,
								'exam_center_code1' => $center_name2,
								'exam_center_code2' => $center_name3,
								'gender' => $radiogender,
								'nationality' => $cmbNationality,
								'cmbrelationship' => $cmbrelationship,
								'dob' => $dob,
								//'adhar_no' => $txtUid,
								'dob_in_word' => $hidDate,
								'category' => $cmbReservedCategory,
								'phtype'=>$txtphtype,
								
								'is_minority_community' => $radioMinority,
								'minority_community_details' => $cmbCommunity,
								
								'is_north_east' => $radiobelong,
								'father_occupation' => $txtOccupation,
								'annual_parent_income' => $txtIncome,
								'indicate_choice' => $txtIndicate,
								'know_about_cipet' => $txtKnowabout,
								'physically_challenged' => $radioPhysicallY ,
								'last_year_mark' => $txtfinalpercentage,
								
								'religion' => $cmbReligion,
								//'applicant_email' => $txtApplicantEmail,
								'applicant_landline' => $txtApplicantLandLine,
								'applicant_mobile' => $txtApplicantMobile,
								'mother_tongue' => $txtMotherTongue, 
								'hostel_facility' => $radioHostel,
								'marital_status' => $radiomaritalstatus,
								'is_reserved_quota' => $radioQuota,
								'created_by' => $reg_user_id,
								'created_on' => $now,
								'master_name'=>$master_name,
								/*'center_name1'=>$center_name1,
								'center_code1'=>$center_code1,
								'center_name2'=>$center_name2,
								'center_code2'=>$center_code2, 
								'center_name3'=>$center_name3,
								'center_code3'=>$center_code3, */

								'father_occupation'=>$FathersProfession, 
							'annual_parent_income'=>$FathersIncome,
							'north_east_state'=>$cmbNorthState, 
							'mothers_profession'=>$MothersProfession, 
							'mothers_income'=>$MothersIncome,
							'mothers_name'=>$txtMotherName,
							//'fathers_adhar_no'=>$fathers_adhar_no,
							//'mothers_adhar_no'=>$mothers_adhar_no,

								'is_employed'=>$employed,
								'employer_add'=>$Employer_address,
								'employer_from'=>$Employer_from,
								'employer_to'=>$Employer_to,
								'employer_add1'=>$Employer_address1, 
								'employer_from1'=>$Employer_from1,
								'employer_to1'=>$Employer_to1, 
								'completion_date'=>$completion_date, 
								'comm_address_ref_id'=>$comm_address_ref_id,
								'perm_address_ref_id'=>$perm_address_ref_id  
							);
							$history_applicant = $this->db->insert('applicant_history',$applicant_history_insert_array);
							if(!$history_applicant){
								$dbStatus = FALSE;
								$dbMessage = 'Error inserting applicant_history';
							}
						}
					
					
					
					$update_applicant_relation_1_array = array(
						'rel_name' => $txtFatherName,
						'updated_by' => $reg_user_id,
						'updated_on' => $now 
					);
					$update_applicant_relation_2_array = array(
						'rel_name' => $txtMotherName,
						'updated_by' => $reg_user_id,
						'updated_on' => $now 
					);
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$this->db->where('applicant_rel_flag',1);
					$update_applicant_relation1 = $this->db->update('applicant_relation',$update_applicant_relation_1_array);
					if(!$update_applicant_relation1)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error updating applicant_relation_1';
					}
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$this->db->where('applicant_rel_flag',2);
					$update_applicant_relation2 = $this->db->update('applicant_relation',$update_applicant_relation_2_array);
					//echo $update_applicant_relation2;
					//print_r($this->db);
					//print_r($this->db->_error_message());
					if(!$update_applicant_relation2)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error updating applicant_relation_2';
					}
					$this->db->where('reg_user_id',$reg_user_id);
					$this->db->where('applied_program',$program_code);
					$update_applicant_relation2 = $this->db->delete('applicant_qualification_detail');
					//echo $this->db->last_query();
					if(!$update_applicant_relation2)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error deleting applicant_qualification_detail';
					}
					
					$slno = 1;
					foreach($allQualifications as $row)
					{
						if(${'txtYear'.$slno} != 'NULL' )
						{
							$post_qualification = ${'txtQualification'.$slno};
							//echo $post_qualification; 
							 
						//	$qualification = $row['$qualification']
							$update_applicant_qualification_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'qual_desc_1' => trim($post_qualification),
								'year_of_passing' => ${'txtYear'.$slno},
								'university_board' => ${'txtBoard'.$slno},
								'division_distinction' => ${'txtDivision'.$slno},
								'mark_secured' => ${'txtMS'.$slno},
								'full_mark' => ${'txtFM'.$slno},
								'percentage_mark' => ${'txtPercent'.$slno},
								'created_by' => $reg_user_id,
								'created_on' => $now
							);
							//print_r($update_applicant_qualification_array);
							
							$this->db->insert('applicant_qualification_detail',$update_applicant_qualification_array);
							//echo $this->db->last_query();
							$slno++;
						} 
					}
						/*if($txtYear5 != '')
						{
							$post_qualification5 = $txtQualification5;
								//$qualification = $row['$qualification']
								$update_applicant_qualification_array5 = array(
									'reg_user_id' => $reg_user_id,
									'applied_program' => $program_code,
									'qual_desc_1' => trim($post_qualification5),
									'year_of_passing' => $txtYear5,
									'university_board' => $txtDivision5,
									'division_distinction' => $txtBoard5,
									'mark_secured' => $txtMS5,
									'full_mark' => $txtFM5,
									'percentage_mark' => $txtPercent5,
									'created_by' => $reg_user_id,
									'created_on' => $now
								);
								//print_r($update_applicant_qualification_array4);
								$this->db->insert('applicant_qualification_detail',$update_applicant_qualification_array5);
						}*/
						
						if($dbstatus == TRUE)
						{
							$this->db->select("appl_no");
							$this->db->from('applicant_appl_overview');
							$this->db->where('applied_program',$program_code);
							$this->db->where('reg_user_id',$reg_user_id);
							$result = $this->db->get();
							foreach($result->result_array() as $appl)
							{
								$appl_no = $appl['appl_no'];
								$document_list_array = array(
									'record_status'=>0
								);
								$this->db->where('application_no',$appl_no);
								$update_applicant_relation2 = $this->db->update('applicant_document_list',$document_list_array);
								if(!$update_applicant_relation2)
								{
									$dbstatus = FALSE;
									$dbmessage = 'Error updating applicant_document_list';
								}
								
							}
							$this->db->select("document_type_code");
							$this->db->from('program_document_setup');
							$this->db->where('program_code',$program_code);
							$this->db->where('record_status',1);
							$result = $this->db->get();
							$documentsReq = $result->result_array();
							if($cmbReservedCategory=='GEN'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'CASTE');
							}
							if($radiobelong=='NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'DOMICILE');
							}
							if($radioPhysicallY=='NO'){
								$documentsReq = removeElementWithValue($documentsReq, 'document_type_code', 'PHC');
							}
							foreach($documentsReq AS $row1)
							{
								$document_list_array = array(
									'record_status'=>1
								);
								$document_list_insert_array = array(
									'record_status'=>1,
									'application_no'=>$appl_no,
									'document_type_code'=>$row1['document_type_code']
								);
								$this->db->select("application_no");
								$this->db->from('applicant_document_list');
								$this->db->where('application_no',$appl_no);
								$this->db->where('document_type_code',$row1['document_type_code']);
								$result = $this->db->get();
								$documentsReq = $result->result_array();
								if($result->num_rows() == 1)
								{
									$this->db->where('application_no',$appl_no);
									$this->db->where('document_type_code',$row1['document_type_code']);
									$update_applicant_relation2 = $this->db->update('applicant_document_list',$document_list_array);
									if(!$update_applicant_relation2)
									{
										$dbstatus = FALSE;
										$dbmessage = 'Error updating applicant_document_list';
									}
								}
								else
								{
									$this->db->insert('applicant_document_list',$document_list_insert_array);
									if(!$update_applicant_relation2)
									{
										$dbstatus = FALSE;
										$dbmessage = 'Error updating applicant_document_list';
									}
								}
							}
							
							if($dbstatus == TRUE)
							{
								$this->db->trans_complete();
								$this->session->set_userdata('admcode', $program_code);
								$this->session->set_userdata('reg_user_id', $reg_user_id);
								$this->session->set_userdata('appl_no', $appl_no);
								$this->session->set_userdata('mode', $mode);
								$this->session->set_userdata('step', 3);
								if( $this->db->trans_status() === FALSE){
									$dbstatus = FALSE;
									$dbmessage = 'Error While Saving';
								}
								
								return array('status' => $dbstatus, 'msg' => $dbmessage);
							}
							else
							{
								$this->db->trans_rollback();
							}
						}
						else
						{
							$this->db->trans_rollback();
						}
						
					}
					
					
				else
				{
					
					$this->db->trans_start();
					$dbStatus = TRUE;
					$dbmessage = 'Data saved Successfully';
					$comm_address_ref_id = '';
					if($chksameasresidential == 'Y')
					{
						$applicant_address_array1 = array(
							'address_1' => $txtPresentAddress,
							'address_2' => $txtPresentLocality,
							'post_office' => $txtPresentPost,
							'district_code' => $cmbPresentDist,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'mobile' => $txtPermanentMobile,
							'created_by' => $reg_user_id,
							'distance_from' => $txtPresentDistance,
							'created_on' => $now 
						);
						$this->db->insert('applicant_address',$applicant_address_array1);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant same address';
						}
						else
							$comm_address_ref_id = $this->db->insert_id();
							$applicant_master_insert_array = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'first_name' => $txtFirstName,
							'mid_name' => $txtMiddleName,
							'last_name' => $txtLastName,
							'full_name' => $fullname,
							'exam_center_code' => $cmbExamCenter,
							'gender' => $radiogender,
							'nationality' => $cmbNationality,
							'dob' => $dob,
							'adhar_no' => $txtUid,
							'dob_in_word' => $hidDate,
							'category' => $cmbReservedCategory,
							'highest_qualification' => $cmbHighestQualification,
							'last_grade' => $cmbPassStatus,
							'last_school' => $txtUnivName,
							'total_mark' => $txtTotalMarks,
							'secured_mark' => $txtSecuredMarks,
							'distinction' => $radioDistinction,
							'honours_subject' => $txtHonoursSubject,
							'honours_total_mark' => $txtHonsTotalMarks,
							'honours_secured_mark' => $txtHonsSecuredMarks,
							'honours_division' => $txtHonsDivision,
							'course_type' => $radioCourseType,
							'religion' => $cmbReligion,
							'applicant_email' => $txtApplicantEmail,
							'applicant_landline' => $txtApplicantLandLine,
							'applicant_mobile' => $txtApplicantMobile,
							'mother_tongue' => $txtMotherTongue, 
							'hostel_facility' => $radioHostel,
							'marital_status' => $radiomaritalstatus,
							'is_kashmiri_migrant' => $radioMigrant,
							'is_reserved_quota' => $radioQuota,
							'other_university' => $txtOtherUniversity,
							'other_subject' => $txtOtherSubject,
							'created_by' => $reg_user_id,
							'created_on' => $now,
							'univ_regn_no' => $txtUnivRegNo,
							'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$comm_address_ref_id 
						);
						$this->db->insert('applicant_master',$applicant_master_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant same address';
						}
					}
					else
					{
						$applicant_address_array1 = array(
							'address_1' => $txtPresentAddress,
							'address_2' => $txtPresentLocality,
							'post_office' => $txtPresentPost,
							'district_code' => $cmbPresentDist,
							'state_code' => $cmbPresentState,
							'pin' => $txtPresentPin,
							'mobile' => $txtPermanentMobile,
							'created_by' => $reg_user_id,
							'distance_from' => $txtPresentDistance,
							'created_on' => $now 
						);
						$this->db->insert('applicant_address',$applicant_address_array1);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant Present';
						}
						else
							$comm_address_ref_id = $this->db->insert_id();
							$applicant_address_array2 = array(
							'address_1' => $txtPermenentAddress,
							'address_2' => $txtPermenentLocality,
							'post_office' => $txtPermenentPost,
							'district_code' => $txtPermanentDist,
							'state_code' => $txtPermanentState,
							'pin' => $txtPermanentPin,
							'distance_from' => $txtPresentDistance,
							'mobile' => $txtPermanentMobile,
							'created_by' => $reg_user_id,
							'created_on' => $now 
						);
						$this->db->insert('applicant_address',$applicant_address_array2);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant Permanent';
						}
						else
							$perm_address_ref_id = $this->db->insert_id();
						
						$applicant_master_insert_array = array(
							'reg_user_id' => $reg_user_id,
							'applied_program' => $program_code,
							'first_name' => $txtFirstName,
							'mid_name' => $txtMiddleName,
							'last_name' => $txtLastName,
							'full_name' => $fullname,
							'exam_center_code' => $cmbExamCenter,
							'gender' => $radiogender,
							'nationality' => $cmbNationality,
							'dob' => $dob,
							'adhar_no' => $txtUid,
							'dob_in_word' => $hidDate,
							'category' => $cmbReservedCategory,
							'highest_qualification' => $cmbHighestQualification,
							'last_grade' => $cmbPassStatus,
							'last_school' => $txtUnivName,
							'total_mark' => $txtTotalMarks,
							'secured_mark' => $txtSecuredMarks,
							'distinction' => $radioDistinction,
							'honours_subject' => $txtHonoursSubject,
							'honours_total_mark' => $txtHonsTotalMarks,
							'honours_secured_mark' => $txtHonsSecuredMarks,
							'honours_division' => $txtHonsDivision,
							'course_type' => $radioCourseType,
							'religion' => $cmbReligion,
							'applicant_email' => $txtApplicantEmail,
							'applicant_landline' => $txtApplicantLandLine,
							'applicant_mobile' => $txtApplicantMobile,
							'mother_tongue' => $txtMotherTongue, 
							'hostel_facility' => $radioHostel,
							'marital_status' => $radiomaritalstatus,
							'is_kashmiri_migrant' => $radioMigrant,
							'is_reserved_quota' => $radioQuota,
							'other_university' => $txtOtherUniversity,
							'other_subject' => $txtOtherSubject,
							'created_by' => $reg_user_id,
							'created_on' => $now,
							'univ_regn_no' => $txtUnivRegNo,
							'comm_address_ref_id'=>$comm_address_ref_id,
							'perm_address_ref_id'=>$perm_address_ref_id 
						);
						$this->db->insert('applicant_master',$applicant_master_insert_array);
						if($this->db->affected_rows() == 0)
						{
							$dbStatus = FALSE;
							$dbMessage = 'Error inserting Applicant same address';
						}
						
					}
					$update_applicant_relation_1_array = array(
						'reg_user_id' => $reg_user_id,
						'applied_program' => $program_code,
						'applicant_rel_flag' => 1,
						'rel_name' => $txtFatherName,
						'created_by' => $reg_user_id,
						'created_on' => $now 
					);
					$update_applicant_relation_2_array = array(
						'reg_user_id' => $reg_user_id,
						'applied_program' => $program_code,
						'applicant_rel_flag' => 2,
						'rel_name' => $txtMotherName,
						'updated_by' => $reg_user_id,
						'updated_on' => $now 
					);
					$update_applicant_relation1 = $this->db->insert('applicant_relation',$update_applicant_relation_1_array);
					if($this->db->affected_rows() == 0)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error updating applicant_relation_1';
					}
					$update_applicant_relation2 = $this->db->insert('applicant_relation',$update_applicant_relation_2_array);
					if($this->db->affected_rows() == 0)
					{
						$dbstatus = FALSE;
						$dbmessage = 'Error updating applicant_relation_2';
					}
					$slno = 1;
					//print_r($allQualifications); 
					$slno = 1;
					foreach($allQualifications as $row)
					{
						if(${'txtYear'.$slno} != 'NULL' )
						{
							$post_qualification = ${'txtQualification'.$slno};
							//$qualification = $row['$qualification']
							$update_applicant_qualification_array = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'qual_desc_1' => trim($post_qualification),
								'year_of_passing' => ${'txtYear'.$slno},
								'university_board' => ${'txtBoard'.$slno},
								'division_distinction' => ${'txtDivision'.$slno},
								'mark_secured' => ${'txtMS'.$slno},
								'full_mark' => ${'txtFM'.$slno},
								'percentage_mark' => ${'txtPercent'.$slno},
								'created_by' => $reg_user_id,
								'created_on' => $now
							);
							$this->db->insert('applicant_qualification_detail',$update_applicant_qualification_array);
							//echo $this->db->last_query();
							$slno++;
						}
					}
					
					
					if($txtYear3 != '')
					{
						$post_qualification3 = $txtQualification3;
							//$qualification = $row['$qualification']
							$update_applicant_qualification_array3 = array(
								'reg_user_id' => $reg_user_id,
								'applied_program' => $program_code,
								'qual_desc_1' => trim($post_qualification3),
								'year_of_passing' => $txtYear3,
								'university_board' => $txtDivision3,
								'division_distinction' => $txtBoard3,
								'mark_secured' => $txtMS3,
								'full_mark' => $txtFM3,
								'percentage_mark' => $txtPercent3,
								'created_by' => $reg_user_id,
								'created_on' => $now
							);
							$this->db->insert('applicant_qualification_detail',$update_applicant_qualification_array3);
					}
					
					if($dbStatus == TRUE)
					{
						
						$this->db->select("program_code,year,sl_no");
						$this->db->from('counselling_program_master');
						$this->db->where('program_code',$program_code);
						$result = $this->db->get();
						foreach($result->result_array() as $appl)
						{
							$sl_no = $appl['sl_no'];
							$program_code = $appl['program_code'];
							$year = $appl['year'];
							$new_sl_no = $sl_no + 1;
							$changed_sl_no = '';
							if($new_sl_no < 10)
								$changed_sl_no = '00000'.$new_sl_no;
							else if($new_sl_no < 100)
								$changed_sl_no = '0000'.$new_sl_no;
							else if($new_sl_no < 1000)
								$changed_sl_no = '000'.$new_sl_no;
							else if($new_sl_no < 10000)
								$changed_sl_no = '00'.$new_sl_no;
							else if($new_sl_no < 100000)
								$changed_sl_no = '0'.$new_sl_no;
						}
							
						$application_no = $program_code.$year.$changed_sl_no;
						$application_data = array(
							'reg_user_id'	=>$reg_user_id,
							'appl_no'		=>$application_no,
							'form_no'		=>$application_no,
							'applied_program'=>$program_code,
							//'appl_status'	=>'Student Details Submitted',
							'created_by'	=>$reg_user_id,
							'created_on'	=>$now
						);
						$program_update_data = array(
							'sl_no'=>$new_sl_no
						);
						$this->db->insert('applicant_appl_overview',$application_data);
						if($this->db->affected_rows() == 0)
						{
							$dbstatus = FALSE;
							$dbmessage = 'Error inserting applicant_appl_overview';
						}
						else
						{
							$this->db->where('program_code',$program_code);
							$this->db->update('counselling_program_master',$program_update_data);
							if($this->db->affected_rows() == 0)
							{
								$dbstatus = FALSE;
								$dbmessage = 'Error updating program';
							}
						}
						$this->db->select("document_type_code");
						$this->db->from('program_document_setup');
						$this->db->where('program_code',$program_code);
						$this->db->where('record_status',1);
						$result = $this->db->get();
						$documentsReq = $result->result_array();
						foreach($documentsReq AS $row1)
						{
							$document_list_insert_array = array(
								'record_status'=>1,
								'application_no'=>$application_no,
								'document_type_code'=>$row1['document_type_code']
							);
							$this->db->insert('applicant_document_list',$document_list_insert_array);
						}
						if($dbStatus == TRUE)
						{
							$this->db->trans_complete();
							$this->session->set_userdata('admcode', $program_code);
							$this->session->set_userdata('reg_user_id', $reg_user_id);
							$this->session->set_userdata('appl_no', $application_no);
							$this->session->set_userdata('mode', $mode);
							$this->session->set_userdata('step', 3);
							if( $this->db->trans_status() === FALSE){
								$dbstatus = FALSE;
								$dbmessage = 'Error While Saving';
							}
							return array('status' => $dbstatus, 'msg' => $dbmessage);
						}
						else
						{
							$this->db->trans_rollback();
							return array('status' => $dbstatus, 'msg' => $dbmessage);
						}
						
					}
					else
					{
						$this->db->trans_rollback();
						return array('status' => $dbstatus, 'msg' => $dbmessage);
					}
					
					
				}
			break;
			case 'get_sidebar':
				$this->db->select('A.*');
				$this->db->from('menu_master as A');
				$this->db->where('A.role_code',$this->session->userdata('role'));
				$this->db->where('A.record_status',1);
				$this->db->order_by('A.sl_no','asc');
				$result = $this->db->get();
				return $result->result_array();
			break;
			case 'get_active_institute_list':
				$this->db->select('COUNT(*) AS active_institute_count');
				$this->db->from('institute_master as A');
				$this->db->where('record_status',1);
				$result = $this->db->get();
				return $result1 = $result->result_array();
			case 'get_inactive_institute_list':
				$this->db->select('COUNT(*) AS active_institute_count');
				$this->db->from('institute_master as A');
				$this->db->where('record_status',0);
				$result = $this->db->get();
				return $result1 = $result->result_array();
			break;
			case 'get_users_applicant':
				$this->db->select('COUNT(*) AS applicant_count');
				$this->db->from('applicant_master as A');
				$result = $this->db->get();
				return $result1 = $result->result_array();
			break;
			case 'get_users_admin':
				$this->db->select('COUNT(*) AS user_count');
				$this->db->from('user_master as A');
				$this->db->where('A.record_status',1);
				$result = $this->db->get();
				return $result2 = $result->result_array();
			break;
			case 'get_user_loggedin_applicant':
				$this->db->select('COUNT(*) AS login_count_applicant');
				$this->db->from('login_detail as A');
				$this->db->where('A.login_role','applicant');
				$this->db->like('A.created_on',$today,'after');
				$result = $this->db->get();
				
				return $result1 = $result->result_array();
			
			break;	
			case 'get_user_loggedin_admin':
				$this->db->select('COUNT(*) AS login_count');
				$this->db->from('login_detail as A');
				$this->db->where('A.login_role','admin');
				$this->db->like('A.created_on',$today,'after');
				$result = $this->db->get();
				return $result2 = $result->result_array();
			break;
			case 'get_institute_data':
				$order = '';
                $Ocolumn = '';
                $Odir = '';
                $order = $this->input->post('order');
                if ($order) {
                    foreach ($order as $row) {
                        $Ocolumn = $row['column'];
                        $Odir = $row['dir'];
                    }
                    $this->db->order_by($Ocolumn, $Odir);
                } else {
                    $this->db->order_by(1, "ASC");
                }
                $search = $this->input->post('search');
                $header = array('institute_code', 'institute_name','institute_type','location');//search filter will work on this column
                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }
					
                $iDisplayLength = $this->input->post('length');//to shw number of record to be shown
                $iDisplayStart = $this->input->post('start');//to start from that position (ex: offset)

                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->select("CONCAT(institute_name,'`',website_address) AS institute, A.institute_code, institute_type, 
								website_address, contact_number,  A.record_status as record, 
								CASE WHEN A.record_status = 1 THEN 'ACTIVE' ELSE 'INACTIVE' END AS record_status, logo_url,location,
								admin_name,admin_user_name,institute_address,image_url,A.institute_name");
				$this->db->from("institute_master A");
				$res = $this->db->get();
				//echo $res1 = $this->db->last_query();
                $query = $res->result_array();
                $output = array("aaData" => array());
                /*----FOR PAGINATION -----*/
                if ($search['value'] != '') 
                {
                    for ($i = 0; $i < count($header); $i++) 
                    {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }
				 $this->db->select("CONCAT(institute_name,'`',website_address) AS institute, A.institute_code, institute_type, 
								website_address, contact_number,  A.record_status as record, 
								CASE WHEN A.record_status = 1 THEN 'ACTIVE' ELSE 'INACTIVE' END AS record_status, logo_url,location,
								admin_name,admin_user_name,institute_address,image_url,A.institute_name");
				$this->db->from("institute_master A");
				 
                $res1 = $this->db->get();
                
                $output["draw"] = intval($this->input->post('draw'));
                $output['iTotalRecords'] = $res1->num_rows();
                $output['iTotalDisplayRecords'] = $res1->num_rows();
                $slno = 1;
                foreach ($query as $aRow) 
                {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
               	return $output; // Data Send to the controller then datatable
			break;
			case 'add_institute':
            	$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	$image_name = "";
            	
				if(isset($_FILES['fileinstitutelogo']['tmp_name']) && !empty($_FILES['fileinstitutelogo']['tmp_name']))
				{
					$imageFileType = end((explode(".", $_FILES['fileinstitutelogo']['name'])));
					$check = getimagesize($_FILES["fileinstitutelogo"]["tmp_name"]);
					if($check !== false) {

					} 
					else 
					{
						return array('status'=>false, 'msg'=>"Not an Image");
					}
					// Check file size
					if($_FILES["fileinstitutelogo"]["size"] > 1536000) {
						return array('status'=>false, 'msg'=>"Size of the image should be within 1MB");
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
						return array('status'=>false, 'msg'=>"Supported file types are jpg/png/jpeg/gif");
					}
					if(isset($_FILES['fileinstitutelogo']['tmp_name']) && !empty($_FILES['fileinstitutelogo']['tmp_name'])){
					//$image_name = base64_encode(file_get_contents($_FILES['fileinstitutelogo']['tmp_name']));
					//$pic_name = $this->session->userdata('user_id')."1".time().".png";//$_FILES['fileinstitutelogo']['name'];
					$pic_name = $this->input->post('institutecode').".".$imageFileType;//$_FILES['fileinstitutelogo']['name'];
					$uploads_dir = APPPATH."../public/assets/images/logo/".$pic_name;
					//echo $uploads_dir. base_url('public');
					$result = move_uploaded_file($_FILES['fileinstitutelogo']['tmp_name'], $uploads_dir);
					//echo "PHoto upload status".$result.dirname(__FILE__) ;
					//echo FCPATH."#".APPPATH."##".BASEPATH;
					//die();
					}
				}
				else
				{
					$pic_name = '';
				}
				if(isset($_FILES['fileInstituteImage']['tmp_name']) && !empty($_FILES['fileInstituteImage']['tmp_name']))
				{
					$imageFileType = end((explode(".", $_FILES['fileInstituteImage']['name'])));
					$check = getimagesize($_FILES["fileInstituteImage"]["tmp_name"]);
					if($check !== false) {

					} 
					else 
					{
						return array('status'=>false, 'msg'=>"Not an Image");
					}
					// Check file size
					if($_FILES["fileInstituteImage"]["size"] > 1536000) {
						return array('status'=>false, 'msg'=>"Size of the image should be within 1MB");
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
						return array('status'=>false, 'msg'=>"Supported file types are jpg/png/jpeg/gif");
					}
					if(isset($_FILES['fileInstituteImage']['tmp_name']) && !empty($_FILES['fileInstituteImage']['tmp_name'])){
					//$image_name = base64_encode(file_get_contents($_FILES['fileInstituteImage']['tmp_name']));
					//$pic_name = $this->session->userdata('user_id')."1".time().".png";//$_FILES['fileInstituteImage']['name'];
					$img_file_name = $this->input->post('institutecode').".".$imageFileType;//$_FILES['fileInstituteImage']['name'];
					$uploads_dir = APPPATH."../public/assets/images/".$pic_name;
					//echo $uploads_dir. base_url('public');
					$result = move_uploaded_file($_FILES['fileInstituteImage']['tmp_name'], $uploads_dir);
					//echo "PHoto upload status".$result.dirname(__FILE__) ;
					//echo FCPATH."#".APPPATH."##".BASEPATH;
					//die();
					}
				}
				else
				{
					$img_file_name = '';
				}

				$data_institute = array( "institute_name" =>$this->input->post('institutename'),
								"institute_code" =>$this->input->post('institutecode'),
								"institute_type" =>$this->input->post('txtinstituteType'),
								"website_address" =>$this->input->post('txtWebaddress'),
								"contact_number" =>$this->input->post('txtContactNo'),
								"location" =>$this->input->post('txtLocation'),
								"logo_url" =>$pic_name,
								"image_url" =>$img_file_name,
								"admin_name" =>$this->input->post('instituteadmindisplayname'),
								"admin_user_name" =>$this->input->post('instituteadminusername'),
								"institute_address" =>$this->input->post('txtAddress'),
								"created_by" => 'SUPADM001',
								"created_on" => date('Y-m-d H:i:s', now())
							);
				$data_appmode = array( "institute_code" =>$this->input->post('institutecode'),
								"online_mode" =>1,
								"offline_mode" =>0,
								"record_status" =>1,
								"created_by" => 'SUPADM001',
								"created_on" => date('Y-m-d H:i:s', now())
							);
				$data_user = array( "institute_code" =>$this->input->post('institutecode'),
								"user_code" =>$this->input->post('instituteadminusername')."_".$this->input->post('institutecode'),
								"user_name" =>$this->input->post('instituteadminusername'),
								"employee_name" =>$this->input->post('instituteadmindisplayname'),
								"role" =>'ADM',
								"created_by" => 'SUPADM001',
								"created_on" => date('Y-m-d H:i:s', now())
							);
				$this->db->trans_start();
				$insert_institute = $this->db->insert('institute_master',$data_institute);
				$insert_user = $this->db->insert('user_master',$data_user);
				$select = $this->db->select('code','description');
				$this->db->from('gen_code_description');
				$this->db->where('code_group', 'Payment Mode');
				$res = $this->db->get();
				$sl_no = 1;
				$result_array = $res->result_array();
				foreach ($result_array as $row)
				{
					
					$data_paymode = array("institute_code" =>$this->input->post('institutecode'),
										  "payment_mode" =>$row['code'],
										  "sl_no" =>$sl_no,
										  "created_by" => 'SUPADM001',
										  "created_on" => date('Y-m-d H:i:s', now()));
					$insert_paymode = $this->db->insert('counselling_payment_mode_setup',$data_paymode);
					$sl_no++;
				}
				    
				$this->db->trans_complete();
				$insert_application_mode = $this->db->insert('application_mode_setup',$data_appmode);
				if( $this->db->trans_status() === FALSE){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
				return array('status'=>$dbstatus,'msg'=>$dbmessage);
			break;
			case 'edit_institute':
				if(isset($_FILES['fileinstitutelogoEdit']['tmp_name']) && !empty($_FILES['fileinstitutelogoEdit']['tmp_name']))
				{
					$imageFileType = end((explode(".", $_FILES['fileinstitutelogoEdit']['name'])));
					$check = getimagesize($_FILES["fileinstitutelogoEdit"]["tmp_name"]);
					if($check !== false) {

					} 
					else 
					{
						return array('status'=>false, 'msg'=>"Not an Image");
					}
					// Check file size
					if($_FILES["fileinstitutelogoEdit"]["size"] > 1536000) {
						return array('status'=>false, 'msg'=>"Size of the image should be within 1MB");
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
						return array('status'=>false, 'msg'=>"Supported file types are jpg/png/jpeg/gif");
					}
					if(isset($_FILES['fileinstitutelogoEdit']['tmp_name']) && !empty($_FILES['fileinstitutelogoEdit']['tmp_name'])){
					//$image_name = base64_encode(file_get_contents($_FILES['fileinstitutelogoEdit']['tmp_name']));
					//$pic_name = $this->session->userdata('user_id')."1".time().".png";//$_FILES['fileinstitutelogoEdit']['name'];
					$pic_name = $this->input->post('institutecode').".".$imageFileType;//$_FILES['fileinstitutelogoEdit']['name'];
					$uploads_dir = APPPATH."../public/assets/images/logo/".$pic_name;
					//echo $uploads_dir. base_url('public');
					$result = move_uploaded_file($_FILES['fileinstitutelogoEdit']['tmp_name'], $uploads_dir);
					//echo "PHoto upload status".$result.dirname(__FILE__) ;
					//echo FCPATH."#".APPPATH."##".BASEPATH;
					//die();
					}
				}
				else
				{
					$pic_name = '';
				}
				if(isset($_FILES['fileInstituteImageEdit']['tmp_name']) && !empty($_FILES['fileInstituteImageEdit']['tmp_name']))
				{
					$imageFileType = end((explode(".", $_FILES['fileInstituteImageEdit']['name'])));
					$check = getimagesize($_FILES["fileInstituteImageEdit"]["tmp_name"]);
					if($check !== false) {

					} 
					else 
					{
						return array('status'=>false, 'msg'=>"Not an Image");
					}
					// Check file size
					if($_FILES["fileInstituteImageEdit"]["size"] > 1536000) {
						return array('status'=>false, 'msg'=>"Size of the image should be within 1MB");
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
						return array('status'=>false, 'msg'=>"Supported file types are jpg/png/jpeg/gif");
					}
					if(isset($_FILES['fileInstituteImageEdit']['tmp_name']) && !empty($_FILES['fileInstituteImageEdit']['tmp_name'])){
					//$image_name = base64_encode(file_get_contents($_FILES['fileInstituteImageEdit']['tmp_name']));
					//$pic_name = $this->session->userdata('user_id')."1".time().".png";//$_FILES['fileInstituteImageEdit']['name'];
					$img_file_name = $this->input->post('institutecode').".".$imageFileType;//$_FILES['fileInstituteImageEdit']['name'];
					$uploads_dir = APPPATH."../public/assets/images/".$pic_name;
					//echo $uploads_dir. base_url('public');
					$result = move_uploaded_file($_FILES['fileInstituteImageEdit']['tmp_name'], $uploads_dir);
					//echo "PHoto upload status".$result.dirname(__FILE__) ;
					//echo FCPATH."#".APPPATH."##".BASEPATH;
					//die();
					}
				}
				else
				{
					$img_file_name = '';
				}
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
				$data_edit_institute = array( "institute_name" => $this->input->post('instituteeditname'),
								"institute_type" =>$this->input->post('txtinstituteTypeEdit'),
								"website_address" =>$this->input->post('txtWebaddressEdit'),
								"contact_number" =>$this->input->post('txtContactNoEdit'),
								"location" =>$this->input->post('txtLocationEdit'),
								"admin_name" =>$this->input->post('instituteadmindisplaynameEdit'),
								"admin_user_name" =>$this->input->post('instituteadminusernameEdit'),
								"institute_address" =>$this->input->post('txtAddress'),
								"record_status" => $this->input->post('cmbRecordStatusEdit'),
								"updated_by" => 'SUPADM001',
								"updated_on" => date('Y-m-d H:i:s', now())
							);
				$data_edit_user = array( "user_name" => $this->input->post('txtUserName'),
								 "user_name" => $this->input->post('txtUserName')."_".$this->input->post('instituteeditcode'),
								"employee_name" => $this->input->post('instituteadmindisplaynameEdit'),
								"record_status" => $this->input->post('cmbRecordStatusEdit'),
								"updated_by" => 'SUPADM001',
								"updated_on" => date('Y-m-d H:i:s', now())
							);
				$this->db->where('institute_code',$this->input->post('instituteeditcode'));
				$insert_user = $this->db->update('institute_master',$data_edit_institute);
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
				$this->db->where('institute_code',$this->input->post('instituteeditcode'));
				$this->db->where('role','ADM');
				$insert_user = $this->db->update('user_master',$data_edit_user);
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
			    return array('status'=>$dbstatus,'msg'=>$dbmessage);
            break;
			case 'edit_application_mode':
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
				$data_edit_application = array( "online_mode" => $this->input->post('chkOnlineMode'),
								"offline_mode" =>$this->input->post('chkOfflineMode'),
								"updated_by" => 'SUPADM001',
								"updated_on" => date('Y-m-d H:i:s', now())
							);
			
				$this->db->where('institute_code',$this->input->post('hidInstituteCode'));
				$insert_user = $this->db->update('application_mode_setup',$data_edit_application);
				//$this->db->last_query();
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
			    return array('status'=>$dbstatus,'msg'=>$dbmessage);
            break;
			case 'get_institute_application_mode':
				$order = '';
                $Ocolumn = '';
                $Odir = '';
                $order = $this->input->post('order');
                if ($order) {
                    foreach ($order as $row) {
                        $Ocolumn = $row['column'];
                        $Odir = $row['dir'];
                    }
                    $this->db->order_by($Ocolumn, $Odir);
                } else {
                    $this->db->order_by(1, "ASC");
                }
                $search = $this->input->post('search');
                $header = array('institute_name');//search filter will work on this column
                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }
					
                $iDisplayLength = $this->input->post('length');//to shw number of record to be shown
                $iDisplayStart = $this->input->post('start');//to start from that position (ex: offset)

                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->select("A.institute_code,B.institute_name,A.online_mode,A.offline_mode,
								   CASE WHEN online_mode = 1  THEN 'Online' 
								    WHEN online_mode = 0 THEN ''
								   END AS online_app_mode,
								    CASE WHEN offline_mode = 1  THEN 'Offline' 
								    WHEN offline_mode = 0 THEN ''
								   END AS offline_app_mode");
				$this->db->from("application_mode_setup AS A");
				$this->db->join("institute_master AS B","A.institute_code = B.institute_code","left");
				//echo $this->db->last_query();
				//die();
				$res = $this->db->get();
				//echo $res1 = $this->db->last_query();
                $query = $res->result_array();
                $output = array("aaData" => array());
                /*----FOR PAGINATION -----*/
                if ($search['value'] != '') 
                {
                    for ($i = 0; $i < count($header); $i++) 
                    {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }
				$this->db->select("A.institute_code,B.institute_name,A.online_mode,A.offline_mode,
								   CASE WHEN online_mode = 1  THEN 'Online' 
								    WHEN online_mode = 0 THEN ''
								   END AS online_app_mode,
								    CASE WHEN offline_mode = 1  THEN 'Offline' 
								    WHEN offline_mode = 0 THEN ''
								   END AS offline_app_mode");
				$this->db->from("application_mode_setup AS A");
				$this->db->join("institute_master AS B","A.institute_code = B.institute_code","left");
				 
                $res1 = $this->db->get();
                
                $output["draw"] = intval($this->input->post('draw'));
                $output['iTotalRecords'] = $res1->num_rows();
                $output['iTotalDisplayRecords'] = $res1->num_rows();
                $slno = 1;
                foreach ($query as $aRow) 
                {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
               	return $output; // Data Send to the controller then datatable
			break;
			case 'get_institute_payment_mode':
				$order = '';
                $Ocolumn = '';
                $Odir = '';
                $order = $this->input->post('order');
                if ($order) {
                    foreach ($order as $row) {
                        $Ocolumn = $row['column'];
                        $Odir = $row['dir'];
                    }
                    $this->db->order_by($Ocolumn, $Odir);
                } else {
                    $this->db->order_by(1, "ASC");
                }
                $search = $this->input->post('search');
                $header = array('institute_name');//search filter will work on this column
                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }
					
                $iDisplayLength = $this->input->post('length');//to shw number of record to be shown
                $iDisplayStart = $this->input->post('start');//to start from that position (ex: offset)

                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->select("A.institute_code,B.institute_name,GROUP_CONCAT(payment_mode),GROUP_CONCAT(description)");
				$this->db->from("counselling_payment_mode_setup AS A");
				$this->db->join("institute_master AS B","A.institute_code = B.institute_code","left");
				$this->db->join("gen_code_description AS C","A.payment_mode = C.code","left");
				$this->db->where("C.code_group","Payment Mode");
				$this->db->where("A.record_status",1);
				$this->db->group_by('A.institute_code'); 
				
				//die();
				$res = $this->db->get();
				//echo $res1 = $this->db->last_query();
                $query = $res->result_array();
                $output = array("aaData" => array());
                /*----FOR PAGINATION -----*/
                if ($search['value'] != '') 
                {
                    for ($i = 0; $i < count($header); $i++) 
                    {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }
				$this->db->select("A.institute_code,B.institute_name,GROUP_CONCAT(payment_mode),GROUP_CONCAT(description)");
				$this->db->from("counselling_payment_mode_setup AS A");
				$this->db->join("institute_master AS B","A.institute_code = B.institute_code","left");
				$this->db->join("gen_code_description AS C","A.payment_mode = C.code","left");
				$this->db->where("C.code_group","Payment Mode");
				$this->db->where("A.record_status",1);
				$this->db->group_by('A.institute_code'); 
				 
                $res1 = $this->db->get();
                
                $output["draw"] = intval($this->input->post('draw'));
                $output['iTotalRecords'] = $res1->num_rows();
                $output['iTotalDisplayRecords'] = $res1->num_rows();
                $slno = 1;
                foreach ($query as $aRow) 
                {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
               	return $output; // Data Send to the controller then datatable
			break;
			case 'get_payment_mode':
				$this->db->select('code','description');
				$this->db->from('gen_code_description');
				$this->db->where('code_group','Payment Mode');
               	$res = $this->db->get();
				//echo $this->db->last_query();
                $query = $res->result_array();
                $output = array("aaData" => array());
				foreach ($query as $aRow) 
                {
					$output['aaData'][] = $aRow;
				}
               	return $output; // Data Send to the controller then datatable
			break;
			case 'edit_payment_mode':
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
				$instituteeditcode = $_POST['hidPaymentCode'];
				$checked_values = $_POST['checked_values'];
				$payment_mode = explode(",",$checked_values);
				$no_of_payment_mode = count($payment_mode);
				$data = array(
					'record_status'=>0
				);
				$this->db->where('institute_code',$instituteeditcode);
				$insert_user = $this->db->update('counselling_payment_mode_setup',$data);
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving1';
				}
				else
				{
					for($j=0;$j < $no_of_payment_mode; $j++)
					{
						$data_payment = array(
							'record_status'=>1
						);
						$this->db->where('institute_code',$instituteeditcode);
						$this->db->where('payment_mode',$payment_mode[$j]);
						$insert_user = $this->db->update('counselling_payment_mode_setup',$data_payment);
						echo $this->db->last_query();
						if($this->db->affected_rows() ==0){
							$dbstatus = FALSE;
							$dbmessage = 'Error While Saving2';
						}
					}
				}
				return array('status'=>$dbstatus,'msg'=>$dbmessage);
               	//return $output; // Data Send to the controller then datatable
			break;
            case 'get_userdata':
            	$order = '';
                $Ocolumn = '';
                $Odir = '';
                $order = $this->input->post('order');
                if ($order) {
                    foreach ($order as $row) {
                        $Ocolumn = $row['column'];
                        $Odir = $row['dir'];
                    }
                    $this->db->order_by($Ocolumn, $Odir);
                } else {
                    $this->db->order_by(1, "ASC");
                }
                $search = $this->input->post('search');
                $header = array('user_name', 'user_display_name');//search filter will work on this column
                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }

                $iDisplayLength = $this->input->post('length');//to shw number of record to be shown
                $iDisplayStart = $this->input->post('start');//to start from that position (ex: offset)

                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->from('user_master');
                $this->db->select("user_name,user_display_name,password,profile_img,record_status");
                $this->db->select("code,description");
               	
               	$res = $this->db->get();
                $query = $res->result_array();
                $output = array("aaData" => array());
				/*----FOR PAGINATION-----*/
                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }

                $this->db->from('user_master');
                $this->db->select("user_code,user_name,user_display_name,password,profile_img,record_status");
                
                $res1 = $this->db->get();
                
                $output["draw"] = intval($this->input->post('draw'));
                $output['iTotalRecords'] = $res1->num_rows();
                $output['iTotalDisplayRecords'] = $res1->num_rows();
                $slno = 1;
                foreach ($query as $aRow) {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
                return $output;
			break;
            case 'add_user':
            	$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	$qry = $this->db->query("SELECT MAX(id)+1 AS max_id FROM user_master");
				$Sresult = $qry->result_array();
				$row2 = array_shift($Sresult);
				$data = array( "user_code" =>$row2['max_id'].rand(1000,99999),
								"user_name" => $this->input->post('txtUserName'),
								"user_display_name" => $this->input->post('txtDisplayName'),
								"record_status" => $this->input->post('user_status'),
								"created_by" => 'superadmin',
								"created_on" => date('Y-m-d H:i:s', now())
							);
				$insert_user = $this->db->insert('user_master',$data);
				if( ! $insert_user){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
				return array('status'=>$dbstatus,'msg'=>$dbmessage);
			break;
			case 'edit_user':
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
				$data = array( "user_name" => $this->input->post('txtUserName'),
								"user_display_name" => $this->input->post('txtDisplayName'),
								"record_status" => $this->input->post('user_status'),
								"updated_by" => 'superadmin'
							);
				$this->db->where('user_code',$this->input->post('hiduser_code'));
				$insert_user = $this->db->update('user_master',$data);
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
			    return array('status'=>$dbstatus,'msg'=>$dbmessage);
            break;  
            case 'delete_user':
                $dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
                $new_data = array(
                    "record_status" => 0,
					"updated_by" => 'superadmin'
                );
                //print_r($new_data);die();
                $this->db->where('user_code',$this->input->post('user_code'));
                $deleteuser = $this->db->update('user_master', $new_data);
                if ($this->db->affected_rows() ==0){
                    $dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
				return array('status' => $dbstatus, 'msg' => $dbmessage);
            break;
            /**
			* logic: To operate data for menu master
			* case:get_role,get_url_link,get_parent_menu,get_menudata,add_menu,edit_menu,delete_menu,copy_menu
			* author:Ashish narayan barick
			* date :11/09/2017
			*/
           
			case 'get_resource':
				$output = array("aaData" => array());
				$this->db->select("resource_code,resource_name,is_instruction_applicable");
				$this->db->from("resource_master");
				$this->db->where("record_status",1);
				$this->db->order_by("resource_code");
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
                {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
               	return $output;
			break;
			case 'get_dashboard_page':
				$output = array("aaData" => array());
				$this->db->select("resource_code,resource_name,is_instruction_applicable");
				$this->db->from("resource_master");
				$this->db->where("record_status",1);
				$this->db->order_by("resource_code");
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
                {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
               	return $output;
			break;
			case 'get_role' :
            	
				$this->db->select('role_id,role_code, role_name,index_page_url,profile_page_url');
				$this->db->from('role_master');
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
                {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
               	return $output;
				
				
				
			break;
			case 'get_copy_role' :
            	
				$this->db->select('role_id,role_code, role_name,index_page_url,profile_page_url');
				$this->db->from('role_master');
				$this->db->where_not_in('role_code',$this->input->post('cmbRole'));
				$result = $this->db->get();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
                {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
               	return $output;
				
				
				
			break;
			case 'get_menu' :
            	
				$this->db->select("m1.link_text,m1.link_url,b.link_text as parent,m1.sl_no AS menu_sl,
					CASE WHEN m1.has_child = 1 THEN 'Yes' WHEN m1.has_child = 0 THEN 'No' ELSE '' END AS has_child,
					CASE WHEN m1.is_last_child = 1 THEN 'Yes' WHEN m1.is_last_child = 0 THEN 'No' ELSE '' END AS is_last_child,m1.icon_class,
					m1.parent_id,m1.menu_id");
				$this->db->from('role_master r');
				$this->db->join('menu_master m1','r.role_code = m1.role_code','left');
				$this->db->join('(SELECT link_text,parent_id,menu_id FROM menu_master WHERE record_status=1) b','b.menu_id = m1.parent_id','left');
				$this->db->where('r.role_code',$this->input->post('cmbRole'));
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
                {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
               	return $output;
				
				
				
			break;
			case 'get_parent' :
				$this->db->select("m.menu_id,m.link_text");
				$this->db->from('menu_master m');
				$this->db->where('m.role_code',$this->input->post('cmbRole'));
				$where = '(m.link_url="#" OR m.link_url ="")';
				$this->db->where($where);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
                {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
               	return $output;
			break;
			case 'get_institute' :
				$this->db->select("institute_code,institute_name");
				$this->db->from('institute_master i');
				$this->db->where('i.record_status',1);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
                {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
               	return $output;
			break;
			case 'get_user_data' :
				$this->db->select("i.employee_name,i.user_name, i.role,i.image_file_name,i. record_status");
				$this->db->from('user_master i');
				$this->db->where('i.record_status',1);
				$this->db->where('i.institute_code',$this->input->post('institute_code'));
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
                {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
               	return $output;
			break;
			case 'get_parent_menu' :
				$output = array("aaData" => array());
				$role = $data['cmbRole'];
				$this->db->select("menu_id,resource_code");
				$this->db->from("menu_master");
				$this->db->where("record_status",1);
				$this->db->where("role_code",$role);
				$this->db->where("parent_id",0);
				$result = $this->db->get();
				$output_data = $result->result_array();
				return $output_data;
			break;
            case 'get_menudata':
				$order = '';
                $Ocolumn = '';
                $Odir = '';
                $order = $this->input->post('order');
                if ($order) {
                    foreach ($order as $row) {
                        $Ocolumn = $row['column'];
                        $Odir = $row['dir'];
                    }
                    $this->db->order_by($Ocolumn, $Odir);
                } else {
                    $this->db->order_by(1, "ASC");
                }
                $search = $this->input->post('search');
                $header = array('user_name', 'user_display_name');//search filter will work on this column
                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }
					
                $iDisplayLength = $this->input->post('length');//to shw number of record to be shown
                $iDisplayStart = $this->input->post('start');//to start from that position (ex: offset)

                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->select("m1.menu_name,IFNULL(rm.resource_name,'#') AS resource_name,m1.parent_id,IFNULL(b.menu_name, '#') AS parent_name,
									m1.sl_no,
									CASE WHEN m1.has_child = 1 THEN 'Yes' 
									WHEN m1.has_child = 0 THEN 'No' 
									ELSE '' END AS has_child,
									CASE WHEN m1.is_last_child = 1 THEN 'Yes' 
									WHEN m1.is_last_child = 0 THEN 'No' 
									ELSE '' END AS is_last_child,m1.access_type,m1.icon_class,
									m1.menu_id,m1.role_code,m1.target,m1.resource_code");
				$this->db->from("role_master r,menu_master m1");
				$this->db->join("(SELECT menu_name,parent_id,menu_id 
							FROM menu_master 
							WHERE record_status=1) b","b.menu_id = m1.parent_id", "LEFT");
				$this->db->join("resource_master rm","m1.resource_code = rm.resource_code","LEFT");
				$this->db->where(" m1.role_code",$data['menu_role']);
				$this->db->where("m1.role_code = r.role_code");
				$this->db->where("m1.record_status",1);
				$res = $this->db->get();
                $query = $res->result_array();
                $output = array("aaData" => array());
                /*----FOR PAGINATION -----*/
                if ($search['value'] != '') 
                {
                    for ($i = 0; $i < count($header); $i++) 
                    {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }
				$this->db->select("m1.menu_name,IFNULL(rm.resource_name,'#') AS resource_name,m1.parent_id,IFNULL(b.menu_name, '#') AS parent_name,
									m1.sl_no,
									CASE WHEN m1.has_child = 1 THEN 'Yes' 
									WHEN m1.has_child = 0 THEN 'No' 
									ELSE '' END AS has_child,
									CASE WHEN m1.is_last_child = 1 THEN 'Yes' 
									WHEN m1.is_last_child = 0 THEN 'No' 
									ELSE '' END AS is_last_child,m1.access_type,m1.icon_class,
									m1.menu_id,m1.role_code,m1.target,m1.resource_code");
				$this->db->from("role_master r,menu_master m1");
				$this->db->join("(SELECT menu_name,parent_id,menu_id 
							FROM menu_master 
							WHERE record_status=1) b","b.menu_id = m1.parent_id", "LEFT");
				$this->db->join("resource_master rm","m1.resource_code = rm.resource_code","LEFT");
				$this->db->where(" m1.role_code",$data['menu_role']);
				$this->db->where("m1.role_code = r.role_code");
				$this->db->where("m1.record_status",1);
				 
                $res1 = $this->db->get();
                
                $output["draw"] = intval($this->input->post('draw'));
                $output['iTotalRecords'] = $res1->num_rows();
                $output['iTotalDisplayRecords'] = $res1->num_rows();
                $slno = 1;
                foreach ($query as $aRow) 
                {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
               	return $output; // Data Send to the controller then datatable
			break;
			case 'add_menu':
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
				$linktext = ($this->input->post('txtLinkText')!= null)?$this->input->post('txtLinkText'):'';
				$role = ($this->input->post('hidRole')!= null)?$this->input->post('hidRole'):'';
				$resource = ($this->input->post('cmbLinkUrl')!= null)?$this->input->post('cmbLinkUrl'):'';
				$parent_id = ($this->input->post('cmbParent')!= null)?$this->input->post('cmbParent'):'';
				$sl_no = ($this->input->post('txtMenuSl')!= null)?$this->input->post('txtMenuSl'):'';
				$chkHasChild = ($this->input->post('txtHasChild')!= null)?$this->input->post('txtHasChild'):'';
				$chkIsLastChild = ($this->input->post('chkIsLastChild')!= null)?$this->input->post('chkIsLastChild'):'';
				$iconClass = ($this->input->post('txtIconClass')!= null)?$this->input->post('txtIconClass'):'';
				
				
				$hasChild = ($chkHasChild == "Yes")?"1":"0";
				$isLastChild = ($chkIsLastChild == "Yes")?"1":"0";
				$new_data = array(
                    'link_text' =>$linktext,
                    'role_code' =>$role,
                    'link_url' => $resource,
                    'parent_id' => $parent_id,
                    'sl_no' => $sl_no,
                    'has_child' => $hasChild,
                    'is_last_child' => $isLastChild,
                    'icon_class' =>$iconClass,
                    'created_by' => 'SUPADM001',
                    'created_on' => 'NOW()'
               	);
               if ($this->db->insert('menu_master', $new_data))
                	return array('status' => $dbstatus, 'msg' => $dbmessage);
            	else 
            		return array('status' => FALSE, 'msg' => 'Error While Saving');
			break;
			case 'edit_menu':
				$dbstatus = TRUE;
            	$dbmessage = 'Data updated successfully';
				$linktext = ($this->input->post('txtLinkText')!= null)?$this->input->post('txtLinkText'):'';
				$role = ($this->input->post('hidRole')!= null)?$this->input->post('hidRole'):'';
				$resource = ($this->input->post('cmbLinkUrl')!= null)?$this->input->post('cmbLinkUrl'):'';
				$parent_id = ($this->input->post('cmbParent')!= null)?$this->input->post('cmbParent'):'';
				$sl_no = ($this->input->post('txtMenuSl')!= null)?$this->input->post('txtMenuSl'):'';
				$chkHasChild = ($this->input->post('txtHasChild')!= null)?$this->input->post('txtHasChild'):'';
				$chkIsLastChild = ($this->input->post('chkIsLastChild')!= null)?$this->input->post('chkIsLastChild'):'';
				$iconClass = ($this->input->post('txtIconClass')!= null)?$this->input->post('txtIconClass'):'';
				$hasChild = ($chkHasChild == "Yes")?"1":"0";
				$isLastChild = ($chkIsLastChild == "Yes")?"1":"0";
				$new_data = array(
                    'link_text' =>$linktext,
                    'role_code' =>$role,
                    'link_url' => $resource,
                    'parent_id' => $parent_id,
                    'sl_no' => $sl_no,
                    'has_child' => $hasChild,
                    'is_last_child' => $isLastChild,
                    'icon_class' =>$iconClass,
                    'updated_by' => 'SUPADM001',
                    'updated_on' => 'NOW()'
               	);
				$this->db->where('menu_id', $this->input->post('hidMenuId'));
                $this->db->update('menu_master', $new_data);
                if ($this->db->affected_rows())
                    return array('status' => $dbstatus, 'msg' => $dbmessage);
                else 
                	return array('status' => 'FAILURE', 'msg' => 'Error while updating');
	        break;
	        case 'delete_menu':
	        	$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
           		$data_delete = array('record_status'=>0);
				$this->db->where('menu_id', $this->input->post('menuid'));
				$this->db->update('menu_master',$data_delete);
				if ($this->db->affected_rows())
	                return array('status' => $dbstatus, 'msg' => $dbmessage);
                else 
                	return array('status' => 'FAILURE', 'msg' => 'Error while deleting');
			break;
			case 'copy_menu':
				$dbstatus = TRUE;
            	$dbmessage = 'Data copied successfully';
				$cmbRole = ($this->input->post('cmbRole')!= null)?$this->input->post('cmbRole'):'';
				$cmbCopyRole = ($this->input->post('cmbCopyRole')!= null)?$this->input->post('cmbCopyRole'):'';
				$sql = "SELECT COUNT(menu_id) AS counting
						FROM 
						menu_master
						WHERE 
						role_code = '$cmbCopyRole'
						AND record_status = 1"; 
		        $query = $this->db->query($sql);
				$result = $query->row_array();
				$counting = $result['counting'];
				if($counting == 0)
				{
					$sql = "INSERT INTO menu_master 
					(role_code,link_text,link_url,parent_id,sl_no,has_child,
					is_last_child,icon_class,created_by,created_on)
					SELECT '$cmbCopyRole' AS role_code,link_text,link_url,parent_id,sl_no,has_child,
					is_last_child,icon_class,created_by,created_on FROM menu_master
					WHERE 
						record_status= 1 
						AND role_code = '$cmbRole'";
					$query = $this->db->query($sql);
					//echo $this->db->last_query();
					//var_dump($query->num_rows());
					if ($this->db->affected_rows())
	                    return array('status' => $dbstatus, 'dbMessage' => $dbmessage);
	                else 
	                	return array('status' => 'FAILURE', 'dbMessage' => "Data already exists for this role. Please delete all the data to copy from other role.");
					
				}
			break;
			/**
			* logic: To operate data for Role Master
			* case:get_roledata,edit_role,add_role,delete_role,get_resource combo box
			* author:Lina Mohapatra
			* date :11/09/2017
			*/
			
			case 'get_resource':
				$output = array("aaData" => array());
				$this->db->select("resource_code,resource_name");
				$this->db->from("resource_master");
				$this->db->where("record_status",1);
				$this->db->group_by("resource_code",1);
				$this->db->order_by("id");
				$result = $this->db->get();
				$output_data = $result->result_array();
				return $output_data;
			break;
			
			case 'get_roledata':            
			 	$order = ''; 
			    $Ocolumn = '';
			    $Odir = '';
				$order = $this->input->post('order');
				if ( $order )
					{
						foreach($order as $row) {
							$Ocolumn= $row['column'];
							$Odir=  $row['dir'];
						}
						$this->db->order_by($Ocolumn,$Odir);
					}else{
						$this->db->order_by(1,"ASC");
					}
			 	$search = $this->input->post('search');
			 	$header = array('role_code', 'role_name', 'index_page_url');
			 	
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
				
			    $iDisplayLength = $this->input->post('length');
				$iDisplayStart = $this->input->post('start');
				
                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->select('rom.`role_code`,rom.`role_name`, rem.resource_name  `index_page_url`, rem.resource_code  `index_page_code`');	
                $this->db->from('role_master rom');
                $this->db->join('resource_master rem', 'rom.index_page_url = rem.resource_code', 'LEFT');
                $this->db->where('rom.`record_status`',1);
                $this->db->where('rem.`record_status`',1);
                $this->db->group_by('role_code');
                
				$res = $this->db->get();
				$query = $res->result_array();
				
				$output = array("aaData" => array());
				$header = array('role_code', 'role_name', 'index_page_url');
				
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
                $this->db->select('rom.`role_code`,rom.`role_name`, rem.resource_name  `index_page_url`,rem.resource_code  `index_page_code`');	
                $this->db->from('role_master rom');
                $this->db->join('resource_master rem', 'rom.index_page_url = rem.resource_code', 'LEFT');
                $this->db->where('rom.`record_status`',1);
                $this->db->where('rem.`record_status`',1);
                $this->db->group_by('role_code');
				$res1 = $this->db->get();
				$output["draw"] = intval( $this->input->post('draw') );
				$output['iTotalRecords'] = $res1->num_rows(); 
				$output['iTotalDisplayRecords'] =  $res1->num_rows();
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
			break;
			
			case 'edit_role':  
			
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtRoleCode = $_POST['hidRoleId'];
			 	$txtRoleName = $_POST['txtRoleName'];
			 	$txtLandingPageUrl = $_POST['cmbLandingPageUrl'];
			 	$txtProfilePageUrl = $_POST['cmbProfilePageUrl'];
			 	$op_type = '';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				$output = array();
					$new_data = array(
					'role_name' 					=>$txtRoleName,
					'index_page_url' 				=>$txtLandingPageUrl,
					'profile_page_url' 				=>$txtProfilePageUrl,
					'updated_by'					=>'SUPADM001' ,
					'updated_on' 					=>$date,
					'record_status'					=>1
					);
					$this->db->where('role_id', $txtRoleCode);
					$insert_user = $this->db->update('role_master', $new_data);
					
					if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
					}
					
					//echo $this->db->last_query();
					$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output; 
			break;
			
			case 'add_role':
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtRoleCode = $_POST['txtRoleCode'];
			 	$txtRoleName = $_POST['txtRoleName'];
			 	$txtLandingPageUrl = $_POST['cmbLandingPageUrl'];
			 	$txtProfilePageUrl = $_POST['cmbProfilePageUrl'];
			 	$op_type = '';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
					$new_data = array(
					'role_code' 					=>$txtRoleCode,
					'role_name' 					=>$txtRoleName,
					'index_page_url' 				=>$txtLandingPageUrl,
					'profile_page_url' 				=>$txtProfilePageUrl,
					'created_by'					=>'SUPADM001', 
					'created_on'					=>$date,
					'updated_by'					=>'SUPADM001' ,
					'updated_on' 					=>$date,
					'record_status'					=>1
					);
					$insert_user = $this->db->insert('role_master', $new_data);
					if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
					}
				    $output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output; 
			break;
			case 'check_role': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$getcode = $_POST['txtCode'];
			 	$role_code ='';
				$this->db->select('role_code');
				$this->db->from('role_master');
				$this->db->where('role_code',$getcode);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$role_code = $row['role_code'];
				}
				if( $role_code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'delete_roledata':  
			
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
			 	$rolecode = $_POST['hidRoleId'];
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('role_id', $rolecode);
				$insert_user = $this->db->delete('role_master');
				
					
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting'.$this->db->_error_message();
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			/**
			* logic: To operate data for Resource Master
			* case:get_resourcedata,add_resource,add_role,delete_role,edit_resource,delete_resource
			* author:Lina Mohapatra
			* date :11/09/2017
			*/
			case 'get_resourcedata':            
			 	
			 	$order = ''; 
			    $Ocolumn = '';
			    $Odir = '';
				$order = $this->input->post('order');
				if ( $order )
					{
						foreach($order as $row) {
							$Ocolumn= $row['column'];
							$Odir=  $row['dir'];
						}
						$this->db->order_by($Ocolumn,$Odir);
					}else{
						$this->db->order_by(1,"ASC");
					}
			 	$search = $this->input->post('search');
			 	$header = array('resource_code', 'resource_name');
			 	
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
				
			    $iDisplayLength = $this->input->post('length');
				$iDisplayStart = $this->input->post('start');
				
                $this->db->limit($iDisplayLength, $iDisplayStart);
				$this->db->from('resource_master');
                $this->db->select('`resource_code`,`resource_link`,`resource_name`,`id`');	
                $this->db->where('record_status',1);
                $this->db->group_by('resource_code');
				$res = $this->db->get();
				$query = $res->result_array();
				$output = array("aaData" => array());
				
				$header = array('resource_code', 'resource_name');
				
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
              	$this->db->from('resource_master');
                $this->db->select('`resource_code`, `resource_name`');	
                $this->db->where('record_status',1);
                $this->db->group_by('resource_code');
                
				$res1 = $this->db->get();
				$output["draw"] = intval( $this->input->post('draw') );
				$output['iTotalRecords'] = $res1->num_rows(); 
				$output['iTotalDisplayRecords'] =  $res1->num_rows();
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
			break;
			 
			 
			case 'add_resource': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtResourceCode = $_POST['txtResourceCode'];
			 	$txtResourceName = $_POST['txtResourceName'];
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_resource';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'resource_code' 				=>$txtResourceCode,
				'resource_name' 				=>$txtResourceName,
				'created_by'					=>'SUPADM001', 
				'created_on'					=>$date,
				'record_status'					=>1
				);
				$insert_user =  $this->db->insert('resource_master', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'check_resource': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$getcode = $_POST['txtCode'];
			 	
				$this->db->select('resource_code');
				$this->db->from('resource_master');
				$this->db->where('resource_code',$getcode);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$resource_code = $row['resource_code'];
				}
				if( $resource_code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'edit_resource':  
			
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	$logged_user = $this->session->userdata('user_name');
			 	$txtResourceCode = $_POST['txtResourceCode'];
			 	$hidResourceCode = $_POST['hidResourceCode'];
			 	$txtResourceName = $_POST['txtResourceName'];
			 	
			 	$op_type = 'edit_resource';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				$output = array();
				
				$new_data = array(
				'resource_code' 				=>$txtResourceCode,
				'resource_name' 				=>$txtResourceName,
				'updated_by'					=>'SUPADM001',
				'updated_on' 					=>$date,
				'record_status'					=>1
				);
				$this->db->where('resource_code', $hidResourceCode);
				$this->db->update('resource_master', $new_data);
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output; 
				
			break;
			case 'get_code' :
				$this->db->select("code_group,sequence_no");
				$this->db->from('gen_code_group i');
				$this->db->where('i.record_status',1);
				$this->db->order_by('i.sequence_no');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
                {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
               	return $output;
			break;
			case 'get_code_desc' :
				$this->db->select("gen_code_id,code_group , code, description,sl_no");
				$this->db->from('gen_code_description i');
				$this->db->where('i.record_status',1);
				$this->db->where('i.code_group',$this->input->post('cmbCodeGroup'));
				$this->db->order_by('i.sl_no');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
                {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
               	return $output;
			break;
			case 'check_code': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$getcode = $_POST['txtCode'];
			 	
				$this->db->select('code_group');
				$this->db->from('gen_code_group');
				$this->db->where('code_group',$getcode);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code_group = $row['code_group'];
				}
				if( $code_group != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'check_code_desc': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$getcode = $_POST['txtCode'];
			 	
				$this->db->select('code');
				$this->db->from('gen_code_description');
				$this->db->where('code',$getcode);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'add_code': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtCodeGroup = $_POST['txtCodeGroup'];
			 	$txtSequenceNo = $_POST['txtSequenceNo'];
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_code';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'code_group' 				=>$txtCodeGroup,
				'sequence_no' 				=>$txtSequenceNo,
				'institute_code' 				=>'EDUSOLS',
				'created_by'					=>'SUPADM001', 
				'created_on'					=>$date,
				'record_status'					=>1
				);
				$insert_user =  $this->db->insert('gen_code_group', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'edit_code':  
			
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	$logged_user = $this->session->userdata('user_name');
			 	$txtCodeGroup = $_POST['txtCodeGroup'];
			 	$hidCodeGroup = $_POST['hidCodeGroup'];
			 	$txtSequenceNo = $_POST['txtSequenceNo'];
			 	
			 	$op_type = 'edit_resource';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				$output = array();
				
				$new_data = array(
				'code_group' 				=>$txtCodeGroup,
				'sequence_no' 				=>$txtSequenceNo,
				'institute_code' 				=>'EDUSOLS',
				'updated_by'					=>'SUPADM001', 
				'updated_on'					=>$date,
				'record_status'					=>1
				);
				$this->db->where('code_group', $hidCodeGroup);
				$this->db->update('gen_code_group', $new_data);
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output; 
				
			break;
			case 'add_code_desc': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtCode = $_POST['txtCode'];
			 	$txtCodeDescGroup = $_POST['txtCodeDesc'];
			 	$hidCodeGroupDesc = $_POST['hidCodeGroupDesc'];
			 	$txtCodeSequenceNo = $_POST['txtCodeSequenceNo'];
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_code';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'code' 							=>$txtCode,
				'description' 					=>$txtCodeDescGroup,
				'code_group' 					=>$hidCodeGroupDesc,
				'sl_no' 						=>$txtCodeSequenceNo,
				'institute_code' 				=>'EDUSOLS',
				'created_by'					=>'SUPADM001', 
				'created_on'					=>$date,
				'record_status'					=>1
				);
				$insert_user =  $this->db->insert('gen_code_description', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'edit_code_desc':  
			
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	$logged_user = $this->session->userdata('user_name');
			 	$txtCode = $_POST['txtCode'];
			 	$txtCodeDescGroup = $_POST['txtCodeDesc'];
			 	$hidGenCodeId = $_POST['hidGenCodeId'];
			 	$hidCodeGroupDesc = $_POST['hidCodeGroupDesc'];
			 	$txtCodeSequenceNo = $_POST['txtCodeSequenceNo'];
			 	
			 	$op_type = 'edit_resource';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				$output = array();
				
				$new_data = array(
				'code' 							=>$txtCode,
				'description' 					=>$txtCodeDescGroup,
				'sl_no' 						=>$txtCodeSequenceNo,
				'institute_code' 				=>'EDUSOLS',
				'created_by'					=>'SUPADM001', 
				'created_on'					=>$date,
				'record_status'					=>1
				);
				$this->db->where('gen_code_id', $hidGenCodeId);
				$this->db->update('gen_code_description', $new_data);
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output; 
				
			break;
			case 'delete_code':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$hidCode = $data['hidCode'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('code_group', $hidCode);
				$this->db->delete('gen_code_group');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting'.$this->db->_error_message();
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			case 'delete_code_desc':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$hidCode = $data['hidCode'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('gen_code_id', $hidCode);
				$this->db->delete('gen_code_description');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting'.$this->db->_error_message();
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			case 'get_exam_center' :
				$this->db->distinct('ins.institute_code');
				$this->db->select("ins.institute_code,ins.institute_name,GROUP_CONCAT(ecm.exam_centre_code) AS exam_centre_code,
									GROUP_CONCAT(ecm.exam_centre_name) AS exam_centre_name,im.id");
				$this->db->from('institute_master ins');
				$this->db->join('institute_exam_centre_setup im', 'ins.institute_code = im.institute_code','LEFT');
				$this->db->join('exam_centre ecm', 'im.exam_centre_code = ecm.exam_centre_code','LEFT');
				$this->db->where('im.record_status','1');
				$this->db->where('ins.record_status', '1');
				$this->db->where('ecm.record_status', '1');
				$this->db->group_by('ins.institute_code');
				$this->db->order_by('ins.institute_name');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
                {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
               	return $output;
			break;
			case 'get_exam_center_edit' :
				$institute_code = $_POST['institute'];
				
				$this->db->select("ecm.exam_centre_name,ins.id");
				$this->db->from('institute_exam_centre_setup ins');
				$this->db->join('exam_centre ecm', 'ins.exam_centre_code = ecm.exam_centre_code','INNER');
				$this->db->where('ins.institute_code', $institute_code);
				$this->db->where('ins.record_status', '1');
				$this->db->where('ecm.record_status', '1');
				$result = $this->db->get();
				//echo $this->db->last_query();
				//die();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
                {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
               	return $output;
			break;
			case 'get_institute_center' :
				
				$this->db->select("institute_code,institute_name");
				$this->db->from('institute_master');
				$this->db->where('record_status', '1');
				$result = $this->db->get();
				//echo $this->db->last_query();
				//die();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
                {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
               	return $output;
			break;
			case 'get_exam_for_exam_center_setup' :
				
				$this->db->select("exam_centre_code,exam_centre_name");
				$this->db->from('exam_centre');
				$this->db->where('record_status', '1');
				$this->db->order_by('id');
				$result = $this->db->get();
				//echo $this->db->last_query();
				//die();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
                {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
               	return $output;
			break;
			
			case 'add_exam_centre': 
				$this->db->trans_start();
				$institute_code = $this->session->userdata('institute_code');
				$logged_user = $this->session->userdata('user_name');
				$user = $logged_user.'_'.$institute_code;
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
			 
				$dbStatus = "SUCCESS";
				$dbMessage = "Inserted Successfully";
            	
            	$cmbInstituteforExamAdd = $_POST['cmbInstituteforExamAdd'];
				$cmbExamCenterAdd = $_POST['cmbExamCenterAdd'];
				
				$cmbInstituteforExamAddSizeof = sizeof($cmbInstituteforExamAdd);
				$cmbExamCenterAddSizeof = sizeof($cmbExamCenterAdd);
				$examCenterArray=array();
				$success_count = 0;
				$error_count = 0;
				$error_check = array();
				
				for($i = 0; $i < $cmbInstituteforExamAddSizeof; $i++)
	            {
	            	if($cmbInstituteforExamAdd[$i] != "multiselect-all")
					{
	            		$cmbInstituteforExam = $cmbInstituteforExamAdd[$i];
	            		for($j=0;$j<$cmbExamCenterAddSizeof;$j++)
	            		{
	            			if($cmbExamCenterAdd[$j] != "multiselect-all")
							{
								$cmbExamCenter = $cmbExamCenterAdd[$j];
								$new_data = array(
									'institute_code' 			=>$cmbInstituteforExam,
									'exam_centre_code' 			=>$cmbExamCenter,
									'created_on' 				=>$date,
									'record_status'				=>'1'
								);
								
								$sql = $this->db->insert('institute_exam_centre_setup', $new_data);
								$examCenterArray[] = $cmbExamCenter;
								
								if(!$sql){
									$error_count++;
									$error_check[] = $cmbExamCenter;
									//$dbStatus ='ERROR';
								}
								else{
									$success_count++;
								}
								
							}
	            			
	            		}
	            	}
	            }
	            if($error_count == sizeof($examCenterArray )&&( $error_count!=0 && sizeof($examCenterArray )!=0))
				{
					$dbStatus = 'ERROR';
					$dbMessage ='All Combinations Are Already Exist';
				}
				else
				{
					$dbStatus = 'SUCCESS';
					$dbMessage = "Data Successfully Saved";
				}
				if($dbStatus == "SUCCESS")
				{
					$this->db->trans_complete();
				}
				else
				{
					$this->db->trans_rollback();
				}
	            $output = array("status"=>$dbStatus,"msg"=>$dbMessage);		
				
				return $output;	
			break;
			
			case 'delete_exam_center':  
			
				$dbStatus = "SUCCESS";
				$dbMessage = "Deleted Successfully";
				$dbError = "";
				
				$hidExamCenterId = isset($_POST['hidExamCenterId'])?$_POST['hidExamCenterId']:'';
				
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				$output = array();
				
				$this->db->where('id', $hidExamCenterId);
				$this->db->delete('institute_exam_centre_setup');
				
					
				if($this->db->affected_rows() ==0){
					$dbStatus = "ERROR";
					$dbMessage = "Error Deleting";
				}
				$output = array('status'=>$dbStatus,'msg'=>$dbMessage);
				
				return $output; 
			break;
			
			case 'get_template':
				$this->db->select('template_code,template_name,template_description,file_name,id');
				$this->db->from('form_template_master');
				$this->db->where('record_status',1);
               	$res = $this->db->get();
				//echo $this->db->last_query();
                $query = $res->result_array();
                $output = array("aaData" => array());
				$sl_no = 1;
				foreach ($query as $row) 
                {
					$row1 = array();
					$row1[0] = $sl_no;
					$row1['sl_no'] = $sl_no;
					$row1[1] = $row['template_code']; 
					$row1['template_code'] = $row['template_code'];
					$row1[2] = $row['template_name']; 
					$row1['template_name'] = $row['template_name'];
					$row1[3] = $row['template_description']; 
					$row1['template_description'] = $row['template_description'];
					$file_name = $row['file_name'];
					/*$view_file = explode(".", $file_name);
					$file_name = $view_file[0]; // piece1
					$file_name = "view-".$file_name.".".$view_file[1];*/
					$row1[4] = $file_name;
					$row1['file_name'] = $file_name;
					$row1[5] = $row['id'];
					$row1['id'] = $row['id']; 
					$output['aaData'][] = $row1;
					$sl_no++;
				}
               	return $output; // Data Send to the controller then datatable
			break;
			case 'get_program_menu_generic_setup1' :
				$this->db->select("menu_code,link_text,link_url,is_new_window,is_document_upload,CASE WHEN record_status = 'Active' THEN 'ACTIVE' ELSE 'INACTIVE' END AS record_status,prog_sl_no,id");
				$this->db->from('program_menu_master');
				$this->db->order_by('id');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
                {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
               	return $output;
			break;
			case 'add_program_menu': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtMenuCode = $_POST['txtMenuCode'];
			 	$txtLinkText = $_POST['txtLinkText'];
			 	$txtLinkURL = $_POST['txtLinkURL'];
			 	$cmbNewWindow = $_POST['cmbNewWindow'];
			 	$cmbDocumentUpload = $_POST['cmbDocumentUpload'];
			 	$cmbRecordStatus = $_POST['cmbRecordStatus'];
			 	$txtProgramMenuSlno = $_POST['txtProgramMenuSlno'];
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_code';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'menu_code' 					=>$txtMenuCode,
				'link_text' 					=>$txtLinkText,
				'link_url' 						=>$txtLinkURL,
				'is_new_window' 				=>$cmbNewWindow,
				'is_document_upload' 			=>$cmbDocumentUpload,
				'record_status' 				=>$cmbRecordStatus,
				'prog_sl_no' 						=>$txtProgramMenuSlno,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$insert_user =  $this->db->insert('program_menu_master', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'edit_program_menu': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$id = $_POST['hidUniqueidEdit'];
			 	$txtMenuCode = $_POST['txtMenuCodeEdit'];
			 	$txtLinkText = $_POST['txtLinkTextEdit'];
			 	$txtLinkURL = $_POST['txtLinkURLEdit'];
			 	$cmbNewWindow = $_POST['cmbNewWindowEdit'];
			 	$cmbDocumentUpload = $_POST['cmbDocumentUploadEdit'];
			 	$cmbRecordStatus = $_POST['cmbRecordStatusEdit'];
			 	$txtProgramMenuSlno = $_POST['txtProgramMenuSlnoEdit'];
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_code';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'menu_code' 					=>$txtMenuCode,
				'link_text' 					=>$txtLinkText,
				'link_url' 						=>$txtLinkURL,
				'is_new_window' 				=>$cmbNewWindow,
				'is_document_upload' 			=>$cmbDocumentUpload,
				'record_status' 				=>$cmbRecordStatus,
				'prog_sl_no' 						=>$txtProgramMenuSlno,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$this->db->where('id',$id );
				$this->db->update('program_menu_master', $new_data);
				if( $this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'delete_program_menu':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$menuID = $data['menuID'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('id', $menuID);
				$this->db->delete('gen_code_description');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting'.$this->db->_error_message();
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			case 'check_program_menu_add': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtMenuCode = $_POST['txtMenuCode'];
			 	
				$this->db->select('menu_code');
				$this->db->from('program_menu_master');
				$this->db->where('menu_code',$txtMenuCode);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['menu_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'check_program_menu_edit': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtMenuCodeEdit = $_POST['txtMenuCodeEdit'];
			 	
				$this->db->select('menu_code');
				$this->db->from('program_menu_master');
				$this->db->where('menu_code',$txtMenuCodeEdit);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['menu_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'check_program_group_add': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtProgramGroupCode = $_POST['txtProgramGroupCode'];
			 	
				$this->db->select('program_group_code');
				$this->db->from('program_group_master');
				$this->db->where('program_group_code',$txtProgramGroupCode);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['program_group_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'get_program_group_generic_setup1' :
			$this->db->select("program_group_code,program_group_name,CASE WHEN record_status = 1 THEN 'ACTIVE' 
					WHEN record_status = 0 THEN 'INACTIVE' END AS record_status");
			$this->db->from('program_group_master');
			$this->db->where('record_status',1);
			$this->db->order_by('id');
			$result = $this->db->get();
			//echo $this->db->last_query();
			$output_data = $result->result_array();
			$output = array("aaData" => array());
			$slno = 1;
			foreach ($output_data as $aRow) 
            {
                $row[0] = $slno;
                $row['sl_no'] = $slno;
                $i = 1;
                foreach ($aRow as $key => $value) {

                    $row[$i] = $value;
                    $row[$key] = $value;
                    $i++;
                }
				$output['aaData'][] = $row;
                $slno++;
                unset($row);
            }
           	return $output;
			break;
			case 'add_program_group': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtProgramGroupCode = $_POST['txtProgramGroupCode'];
			 	$txtProgramGroupName = $_POST['txtProgramGroupName'];
			 	$cmbRecordStatus = $_POST['cmbStatus'];
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'program_group_code' 			=>$txtProgramGroupCode,
				'program_group_name' 			=>$txtProgramGroupName,
				'record_status' 				=>$cmbRecordStatus,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$insert_user =  $this->db->insert('program_group_master', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'edit_program_group': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$code = $_POST['hidProgramGroupCodeEdit'];
			 	$txtProgramGroupCode = $_POST['txtProgramGroupCodeEdit'];
			 	$txtProgramGroupName = $_POST['txtProgramGroupNameEdit'];
			 	$cmbRecordStatus = $_POST['cmbStatusEdit'];
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'edit_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'program_group_code' 			=>$txtProgramGroupCode,
				'program_group_name' 			=>$txtProgramGroupName,
				'record_status' 				=>$cmbRecordStatus,
				'updated_by'					=>'SUPADM001',
				'updated_on'					=>$date
				);
				$this->db->where('program_group_code',$code );
				$this->db->update('program_group_master', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'delete_program_group':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$menuID = $_POST['hidProgramGroupCodeEdit'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('program_group_code', $menuID);
				$this->db->delete('program_group_master');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting'.$this->db->_error_message();
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			case 'add_document': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtProgramDocumentCode = $_POST['txtDocumentCode'];
			 	$txtProgramDcoumentName = $_POST['txtDocumentName'];
			 	$txtDocumentDesc = $_POST['txtDocumentDesc'];
			 	$txtDocumentSizeDesc = $_POST['txtDocumentSizeDesc'];
			 	$txtDocumentSize = $_POST['txtDocumentSize'];
			 	$txtDocumentHeight = $_POST['txtDocumentHeight'];
			 	$txtDocumentWidth = $_POST['txtDocumentWidth'];
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'document_type_code' 		=>$txtProgramDocumentCode,
				'document_type' 			=>$txtProgramDcoumentName,
				'document_type_description' 			=>$txtDocumentDesc,
				'document_size_description' 			=>$txtDocumentSizeDesc,
				'document_size_in_kb' 			=>$txtDocumentSize,
				'document_preview_height' 			=>$txtDocumentHeight,
				'document_preview_width' 			=>$txtDocumentWidth,
				'record_status' 				=>1,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$insert_user =  $this->db->insert('document_type_master', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'edit_document': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtProgramDocumentCode = $_POST['txtDocumentCodeEdit'];
			 	$txtProgramDcoumentName = $_POST['txtDocumentNameEdit'];
			 	$txtDocumentDesc = $_POST['txtDocumentDescEdit'];
			 	$txtDocumentSizeDesc = $_POST['txtDocumentSizeDescEdit'];
			 	$txtDocumentSize = $_POST['txtDocumentSizeEdit'];
			 	$txtDocumentHeight = $_POST['txtDocumentHeightEdit'];
			 	$txtDocumentWidth = $_POST['txtDocumentWidthEdit'];
			 	$code = $_POST['hidDUniqueidEdit'];
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'document_type_code' 		=>$txtProgramDocumentCode,
				'document_type' 			=>$txtProgramDcoumentName,
				'document_type_description' 			=>$txtDocumentDesc,
				'document_size_description' 			=>$txtDocumentSizeDesc,
				'document_size_in_kb' 			=>$txtDocumentSize,
				'document_preview_height' 			=>$txtDocumentHeight,
				'document_preview_width' 			=>$txtDocumentWidth,
				'record_status' 				=>1,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$this->db->where('id',$code );
				$this->db->update('document_type_master', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//$this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'delete_document':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$documentID = $_POST['documentID'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('id', $documentID);
				$this->db->delete('document_type_master');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			case 'check_document_edit': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtDocumentCodeEdit = $_POST['txtDocumentCodeEdit'];
			 	
				$this->db->select('document_code');
				$this->db->from('program_document_master');
				$this->db->where('document_type_code',$txtDocumentCodeEdit);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['document_type_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'check_document': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtDocumentCode = $_POST['txtDocumentCode'];
			 	
				$this->db->select('document_code');
				$this->db->from('program_document_master');
				$this->db->where('document_type_code',$txtDocumentCode);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['document_type_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output; 
			break;
			case 'get_document_master' :
			$this->db->select("document_type_code,document_type,document_type_description,document_size_description,
							document_size_in_kb,document_preview_height,document_preview_width,id");
			$this->db->from('document_type_master');
			$this->db->where('record_status',1);
			$this->db->order_by('id');
			$result = $this->db->get();
			//echo $this->db->last_query();
			$output_data = $result->result_array();
			$output = array("aaData" => array());
			$slno = 1;
			foreach ($output_data as $aRow) 
            {
                $row[0] = $slno;
                $row['sl_no'] = $slno;
                $i = 1;
                foreach ($aRow as $key => $value) {

                    $row[$i] = $value;
                    $row[$key] = $value;
                    $i++;
                }
				$output['aaData'][] = $row;
                $slno++;
                unset($row);
            }
           	return $output;
			break;
			case 'get_category_master' :
			$this->db->select("category_code,category_name,id");
			$this->db->from('category_master');
			$this->db->order_by('id');
			$result = $this->db->get();
			//echo $this->db->last_query();
			$output_data = $result->result_array();
			$output = array("aaData" => array());
			$slno = 1;
			foreach ($output_data as $aRow) 
            {
                $row[0] = $slno;
                $row['sl_no'] = $slno;
                $i = 1;
                foreach ($aRow as $key => $value) {

                    $row[$i] = $value;
                    $row[$key] = $value;
                    $i++;
                }
				$output['aaData'][] = $row;
                $slno++;
                unset($row);
            }
           	return $output;
			break;
			case 'add_category': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtCategoryCode = $_POST['txtCategoryCode'];
			 	$txtCategoryName = $_POST['txtCategoryName'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'category_code' 			=>$txtCategoryCode,
				'category_name' 			=>$txtCategoryName,
				'record_status' 				=>$cmbRecordStatus,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$insert_user =  $this->db->insert('category_master', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'edit_category': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$id = $_POST['hidCUniqueidEdit'];
			 	$txtCategoryCodeEdit = $_POST['txtCategoryCodeEdit'];
			 	$txtCategoryNameEdit = $_POST['txtCategoryNameEdit'];
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'edit_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'category_code' 			=>$txtCategoryCodeEdit,
				'category_name' 			=>$txtCategoryNameEdit,
				'updated_by'					=>'SUPADM001',
				'updated_on'					=>$date
				);
				$this->db->where('id',$id );
				$this->db->update('category_master', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'delete_category':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$catID = $_POST['categoryID'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('id', $catID);
				$this->db->delete('category_master');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			case 'check_category': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtCategoryCode = $_POST['txtCategoryCode'];
			 	
				$this->db->select('category_code');
				$this->db->from('category_master');
				$this->db->where('category_code',$txtCategoryCode);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['category_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'check_program_menu_edit': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtCategoryCodeEdit = $_POST['txtCategoryCodeEdit'];
			 	
				$this->db->select('category_code');
				$this->db->from('category_master');
				$this->db->where('category_code',$txtCategoryCodeEdit);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['category_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'get_minority_community' :
			$this->db->select("minority_community_code,minority_community,id");
			$this->db->from('minority_community_master');
			$this->db->order_by('id');
			$result = $this->db->get();
			//echo $this->db->last_query();
			$output_data = $result->result_array();
			$output = array("aaData" => array());
			$slno = 1;
			foreach ($output_data as $aRow) 
            {
                $row[0] = $slno;
                $row['sl_no'] = $slno;
                $i = 1;
                foreach ($aRow as $key => $value) {

                    $row[$i] = $value;
                    $row[$key] = $value;
                    $i++;
                }
				$output['aaData'][] = $row;
                $slno++;
                unset($row);
            }
           	return $output;
			break;
			case 'add_minority': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtMinoritycommunityCode = $_POST['txtMinoritycommunityCode'];
			 	$txtMinoritycommunityName = $_POST['txtMinoritycommunityName'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'minority_community_code' 			=>$txtMinoritycommunityCode,
				'minority_community' 			=>$txtMinoritycommunityName,
				'record_status' 				=>$cmbRecordStatus,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$insert_user =  $this->db->insert('minority_community_master', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'edit_minority': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$id = $_POST['hidMUniqueidEdit'];
			 	$txtMinoritycommunityCode = $_POST['txtMinoritycommunityCodeEdit'];
			 	$txtMinoritycommunityName = $_POST['txtMinoritycommunityNameEdit'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'minority_community_code' 		=>$txtMinoritycommunityCode,
				'minority_community' 			=>$txtMinoritycommunityName,
				'record_status' 				=>$cmbRecordStatus,
				'updated_by'					=>'SUPADM001',
				'updated_on'					=>$date
				);
				$this->db->where('id',$id );
				$this->db->update('minority_community_master', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'delete_minority':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$id = $_POST['minoritycommunityID'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('id', $id);
				$this->db->delete('minority_community_master');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			case 'check_minority': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtMinoritycommunityCode = $_POST['txtMinoritycommunityCode'];
			 	
				$this->db->select('minority_community_code');
				$this->db->from('minority_community_master');
				$this->db->where('minority_community_code',$txtMinoritycommunityCode);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['minority_community_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'check_minority_edit': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtMinoritycommunityCodeEdit = $_POST['txtMinoritycommunityCodeEdit'];
			 	
				$this->db->select('minority_community_code');
				$this->db->from('minority_community_master');
				$this->db->where('minority_community_code',$txtMinoritycommunityCodeEdit);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['minority_community_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'get_caste' :
			$this->db->select("caste_code,caste_name,CASE WHEN record_status = 1 THEN 'ACTIVE' 
					WHEN record_status = 0 THEN 'INACTIVE' END AS record_status");
			$this->db->from('caste_master');
			$this->db->order_by('id');
			$result = $this->db->get();
			//echo $this->db->last_query();
			$output_data = $result->result_array();
			$output = array("aaData" => array());
			$slno = 1;
			foreach ($output_data as $aRow) 
            {
                $row[0] = $slno;
                $row['sl_no'] = $slno;
                $i = 1;
                foreach ($aRow as $key => $value) {

                    $row[$i] = $value;
                    $row[$key] = $value;
                    $i++;
                }
				$output['aaData'][] = $row;
                $slno++;
                unset($row);
            }
           	return $output;
			break;
			case 'add_caste': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtCasteCode = $_POST['txtCasteCode'];
			 	$txtCasteName = $_POST['txtCasteName'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'caste_code' 					=>$txtCasteCode,
				'caste_name' 					=>$txtCasteName,
				'record_status' 				=>$cmbRecordStatus,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$insert_user =  $this->db->insert('caste_master', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'edit_caste': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$code = $_POST['hidCasteCodeEdit'];
			 	$txtCasteCode = $_POST['txtCasteCodeEdit'];
			 	$txtCasteName = $_POST['txtCasteNameEdit'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'caste_code' 					=>$txtCasteCode,
				'caste_name' 					=>$txtCasteName,
				'record_status' 				=>$cmbRecordStatus,
				'updated_by'					=>'SUPADM001',
				'updated_on'					=>$date
				);
				$this->db->where('caste_code',$code );
				$this->db->update('caste_master', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'delete_caste':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$hidCasteCodeEdit = $_POST['hidCasteCodeEdit'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('caste_code', $hidCasteCodeEdit);
				$this->db->delete('caste_master');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			case 'get_religion' :
			$this->db->select("religion_code,religion_name,id");
			$this->db->from('religion_master');
			$this->db->order_by('id');
			$result = $this->db->get();
			//echo $this->db->last_query();
			$output_data = $result->result_array();
			$output = array("aaData" => array());
			$slno = 1;
			foreach ($output_data as $aRow) 
            {
                $row[0] = $slno;
                $row['sl_no'] = $slno;
                $i = 1;
                foreach ($aRow as $key => $value) {

                    $row[$i] = $value;
                    $row[$key] = $value;
                    $i++;
                }
				$output['aaData'][] = $row;
                $slno++;
                unset($row);
            }
           	return $output;
			break;
			case 'add_religion': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtCasteCode = $_POST['txtReligionCode'];
			 	$txtCasteName = $_POST['txtReligionName'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'religion_code' 					=>$txtCasteCode,
				'religion_name' 					=>$txtCasteName,
				'record_status' 				=>$cmbRecordStatus,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$insert_user =  $this->db->insert('religion_master', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'edit_religion': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$id = $_POST['hidRUniqueidEdit'];
			 	$txtCasteCode = $_POST['txtReligionCodeEdit'];
			 	$txtCasteName = $_POST['txtReligionNameEdit'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'religion_code' 					=>$txtCasteCode,
				'religion_name' 					=>$txtCasteName,
				'record_status' 				=>$cmbRecordStatus,
				'updated_by'					=>'SUPADM001',
				'updated_on'					=>$date
				);
				$this->db->where('id',$id );
				$this->db->update('religion_master', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'delete_religion':  	
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$religionID = $_POST['religionID'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('id', $religionID);
				$this->db->delete('religion_master');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			case 'get_instruction' :
			$this->db->select("page_code,instruction,record_status");
			$this->db->from('instruction_setup');
			$this->db->order_by('id');
			$result = $this->db->get();
			//echo $this->db->last_query();
			$output_data = $result->result_array();
			$output = array("aaData" => array());
			$slno = 1;
			foreach ($output_data as $row) 
            {
                $row[0] = $slno;
                $row['sl_no'] = $slno;
                $i = 1;
               	$row1 = array();
				$row1[0] = $slno;
				$row1['sl_no'] = $slno;
				$row1[1] = $row['page_code']; 
				$row1['page_code'] = $row['page_code'];
				$row1[2] = $row['instruction']; 
				$row1['instruction_text'] = $row['instruction'];
				
				$pos=strpos($row['instruction'], ' ', 200);
		 		$instruction = substr($row['instruction'], 0, $pos);
				$row1[3] = $instruction; 
				$row1['instruction'] = $instruction;
				if($row['record_status'] == 1)
				{
					$row1[4] = 'ACTIVE'; 
				    $row1['status'] = 'ACTIVE';
				}
				if($row['record_status'] == 0)
				{
					$row1[4] = 'INACTIVE'; 
				    $row1['status'] = 'INACTIVE';
				}
				$output['aaData'][] = $row1;
				$slno++;
                unset($row);
                unset($row1);
            }
           	return $output;
			break;
			case 'add_instruction': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$cmbPageCode = $_POST['cmbPageCode'];
			 	$taInstruction = $_POST['taInstruction'];
			 	$cmbRecordStatus = $_POST['cmbInsStatus'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'page_code' 					=>$cmbPageCode,
				'instruction' 					=>$taInstruction,
				'record_status' 				=>$cmbRecordStatus,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$insert_user =  $this->db->insert('instruction_setup', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'edit_instruction': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
				$cmbPageCode = $_POST['cmbPageCodeEdit'];
			 	$taInstruction = $_POST['taInstructionEdit'];
			 	$cmbRecordStatus = $_POST['cmbInsStatusEdit'];
			 	$hidInstructionCodeEdit = $_POST['hidInstructionCodeEdit'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'religion_code' 					=>$txtCasteCode,
				'religion_name' 					=>$txtCasteName,
				'record_status' 				=>$cmbRecordStatus,
				'updated_by'					=>'SUPADM001',
				'updated_on'					=>$date
				);
				$this->db->where('id',$id );
				$this->db->update('page_code', $hidInstructionCodeEdit);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'delete_instruction':  	
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$religionID = $_POST['religionID'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('id', $religionID);
				$this->db->delete('religion_master');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			case 'get_religion' :
				$this->db->select("religion_code,religion_name,id");
				$this->db->from('religion_master');
				$this->db->order_by('id');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			case 'get_sms_provider' :
				$this->db->select("SUBSTRING_INDEX(provider_name,'_',1) AS providername,sms_url,user_name,password,sender,sms_provider_id,provider_name");
				$this->db->from('sms_provider_setup');
				$this->db->where('record_status',1);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			case 'add_sms_provider': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtProvider = $_POST['txtprovider'];
			 	$txtsmsUrl = $_POST['txtsmsUrl'];
			 	$txtUserName = $_POST['txtUserName'];
			 	$txtsmspassword = $_POST['txtsmspassword'];
			 	$txtSender = $_POST['txtSender'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
				$institute_code = $this->session->userdata('institute_code');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				
				$instsmsProvider = "$txtProvider"."_"."$institute_code";
				$new_data = array(
				'provider_name' 				=>$instsmsProvider,
				'sms_url' 						=>$txtsmsUrl,
				'user_name' 					=>$txtUserName,
				'password' 						=>$txtsmspassword,
				'sender' 						=>$txtSender,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$insert_user =  $this->db->insert('sms_provider_setup', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'edit_provider': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$id = $_POST['hidprovideridEdit'];
			 	$txtProvider = $_POST['txtproviderEdit'];
			 	$txtsmsUrl = $_POST['txtsmsUrlEdit'];
			 	$txtUserName = $_POST['txtUserNameEdit'];
			 	$txtsmspassword = $_POST['txtsmspasswordEdit'];
			 	$txtSender = $_POST['txtSenderEdit'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
				$institute_code = $this->session->userdata('institute_code');
			 	$op_type = 'edit_sms_provider';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				
				$instsmsProvider = "$txtProvider"."_"."$institute_code";
				$new_data = array(
				'provider_name' 				=>$instsmsProvider,
				'sms_url' 						=>$txtsmsUrl,
				'user_name' 					=>$txtUserName,
				'password' 						=>$txtsmspassword,
				'sender' 						=>$txtSender,
				'updated_by'					=>'SUPADM001',
				'updated_on'					=>$date
				);
				$this->db->where('sms_provider_id',$id );
				$this->db->update('sms_provider_setup', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'delete_sms_provider': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$hidprovideridEdit = $_POST['hidprovideridEdit'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('sms_provider_id', $hidprovideridEdit);
				$this->db->delete('sms_provider_setup');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output;  
			break;
			
			case 'get_sms_setup' :
				$this->db->select("sms_type,subject,content,SUBSTRING_INDEX(provider_name,'_',1) AS provider_name,status,status as status_image,sms_setup_id");
				$this->db->from('sms_setup');
				$this->db->where('record_status',1);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			case 'add_sms': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$cmbsmsType = $_POST['cmbsmsType'];
			 	$txtSubject = $_POST['txtSubject'];
			 	$txtContent = $_POST['txtContent'];
			 	$cmbsmsProvider = $_POST['cmbsmsProvider'];
			 	$cmbStatus = $_POST['cmbStatus'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
				$institute_code = $this->session->userdata('institute_code');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'sms_type' 						=>$cmbsmsType,
				'subject' 						=>$txtSubject,
				'content' 						=>$txtContent,
				'provider_name' 				=>$cmbsmsProvider,
				'status' 						=>$cmbStatus,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$insert_user =  $this->db->insert('sms_setup', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'edit_sms': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$id = $_POST['hidsmsidEdit'];
			 	$cmbsmsType = $_POST['cmbsmsTypeEdit'];
			 	$txtSubject = $_POST['txtSubjectEdit'];
			 	$txtContent = $_POST['txtContentEdit'];
			 	$cmbsmsProvider = $_POST['cmbsmsProviderEdit'];
			 	$cmbStatus = $_POST['cmbStatusEdit'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
				$institute_code = $this->session->userdata('institute_code');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'sms_type' 						=>$cmbsmsType,
				'subject' 						=>$txtSubject,
				'content' 						=>$txtContent,
				'provider_name' 				=>$cmbsmsProvider,
				'status' 						=>$cmbStatus,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$this->db->where('sms_setup_id',$id );
				$this->db->update('sms_setup', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output;
			break;
			case 'delete_sms': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$hidsmsidEdit = $_POST['hidsmsidEdit'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('sms_setup_id', $hidsmsidEdit);
				$this->db->delete('sms_setup');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output;  
			break;
			case 'get_email_setup' :
				$this->db->select("email_type,subject,content,SUBSTRING_INDEX(provider_name,'_',1) AS provider_name,status,status as status_image,email_setup_id");
				$this->db->from('email_setup');
				$this->db->where('record_status',1);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			case 'get_email_provider' :
				$this->db->select("SUBSTRING_INDEX(provider_name,'_',1) AS providername,host_name,port_no,email_id,password,smtp_auth,smtp_secure,email_provider_id,provider_name");
				$this->db->from('email_provider_setup');
				$this->db->where('record_status',1);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			
			case 'add_email_provider': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtProvider = $_POST['txtprovider'];
			 	$txtHost = $_POST['txtHost'];
			 	$txtMailPort = $_POST['txtMailPort'];
			 	$txtemailID = $_POST['txtemailID'];
			 	$txtmailpassword = $_POST['txtmailpassword'];
			 	$txtSmtpauth = $_POST['txtSmtpauth'];
			 	$txtSmtpsecure = $_POST['txtSmtpsecure'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
				$institute_code = $this->session->userdata('institute_code');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				
				$instsmsProvider = "$txtProvider"."_"."$institute_code";
				$new_data = array(
				'provider_name' 				=>$instsmsProvider,
				'host_name' 						=>$txtHost,
				'port_no' 					=>$txtMailPort,
				'email_id' 						=>$txtemailID,
				'password' 						=>$txtmailpassword,
				'smtp_auth' 						=>$txtSmtpauth,
				'smtp_secure' 						=>$txtSmtpsecure,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$insert_user =  $this->db->insert('email_provider_setup', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'edit_email_provider': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$id = $_POST['hidEprovideridEdit'];
			 	$txtProvider = $_POST['txtMailProviderEdit'];
			 	$txtHost = $_POST['txtMailHostEdit'];
			 	$txtMailPort = $_POST['txtMailPortEdit'];
			 	$txtemailID = $_POST['txtemailIDEdit'];
			 	$txtmailpassword = $_POST['txtmailpasswordEdit'];
			 	$txtSmtpauth = $_POST['txtSmtpauthEdit'];
			 	$txtSmtpsecure = $_POST['txtSmtpsecureEdit'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
				$institute_code = $this->session->userdata('institute_code');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				
				$instsmsProvider = "$txtProvider"."_"."$institute_code";
				$new_data = array(
				'provider_name' 			=>$instsmsProvider,
				'host_name' 				=>$txtHost,
				'port_no' 					=>$txtMailPort,
				'email_id' 					=>$txtemailID,
				'password' 					=>$txtmailpassword,
				'smtp_auth' 				=>$txtSmtpauth,
				'smtp_secure' 				=>$txtSmtpsecure,
				'created_by'				=>'SUPADM001',
				'created_on'				=>$date
				);
				$this->db->where('email_provider_id',$id );
				$this->db->update('email_provider_setup', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'delete_email_provider': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$hidprovideridEdit = $_POST['hidEprovideridEdit'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('email_provider_id', $hidprovideridEdit);
				$this->db->delete('email_provider_setup');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output;  
			break;
			case 'add_email': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$cmbsmsType = $_POST['cmbMailType'];
			 	$txtSubject = $_POST['txtSubject'];
			 	$txtContent = $_POST['txtContent'];
			 	$cmbsmsProvider = $_POST['cmbEmailProvider'];
			 	$cmbStatus = $_POST['cmbStatus'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
				$institute_code = $this->session->userdata('institute_code');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'email_type' 						=>$cmbsmsType,
				'subject' 						=>$txtSubject,
				'content' 						=>$txtContent,
				'provider_name' 				=>$cmbsmsProvider,
				'status' 						=>$cmbStatus,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$insert_user =  $this->db->insert('email_setup', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'edit_email': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$id = $_POST['hidemailidEdit'];
			 	$cmbsmsType = $_POST['cmbMailTypeEdit'];
			 	$txtSubject = $_POST['txtemailSubjectEdit'];
			 	$txtContent = $_POST['txtemailContentEdit'];
			 	$cmbsmsProvider = $_POST['cmbEmailProviderEdit'];
			 	$cmbStatus = $_POST['cmbStatusEdit'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
				$institute_code = $this->session->userdata('institute_code');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'email_type' 						=>$cmbsmsType,
				'subject' 						=>$txtSubject,
				'content' 						=>$txtContent,
				'provider_name' 				=>$cmbsmsProvider,
				'status' 						=>$cmbStatus,
				'updated_by'					=>'SUPADM001',
				'updated_on'					=>$date
				);
				$this->db->where('email_setup_id',$id );
				$this->db->update('email_setup', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output;
			break;
			case 'delete_email': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$hidemailidEdit = $_POST['hidemailidEdit'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('email_setup_id', $hidemailidEdit);
				$this->db->delete('email_setup');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output;  
			break;
			case 'delete_user_program': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$user_code = $_POST['user_code'];
			 	$program_code = $_POST['program_code'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('user_code', $user_code);
				$this->db->where('program_code', $program_code);
				$this->db->delete('user_program_mapping');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output;  
			break;
			case 'get_user_institutewise' :
				$institute = $_POST['institute'];
				$this->db->select("user_code,CONCAT(employee_name,'(',user_name,')') AS user");
				$this->db->from('user_master');
				$this->db->where('institute_code',$institute);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			case 'get_program_institutewise' :
				$institute = $_POST['institute'];
				$this->db->select("program_code,program_name");
				$this->db->from('counselling_program_master');
				$this->db->where('institute_code',$institute);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			case 'get_user_program_mapping' :
				$institute = $_POST['institute'];
				$this->db->select("A.user_code,CONCAT(B.employee_name,'(',B.user_name,')') AS user,GROUP_CONCAT(C.program_name) AS program_name");
				$this->db->from('user_program_mapping A');
				$this->db->join('user_master B','A.user_code = B.user_code','left');
				$this->db->join('counselling_program_master C','A.program_code = C.program_code','left');
				$this->db->where('A.institute_code',$institute);
				$this->db->group_by('A.user_code');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			case 'get_user_program_manage' :
				$user_code = $_POST['user_code'];
				$this->db->select(" A.program_code,C.program_name");
				$this->db->from('user_program_mapping A');
				$this->db->join('user_master B','A.user_code = B.user_code','left');
				$this->db->join('counselling_program_master C','A.program_code = C.program_code','left');
				$this->db->where('A.user_code',$user_code);
				$this->db->order_by('A.program_code');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			case 'get_pg_report' :
				$date = $_POST['date'];
				$this->db->select("order_id,transaction_id,DATE_FORMAT(transaction_date,'%d-%m-%Y') as transaction_date,
							DATE_FORMAT(payment_date,'%d-%m-%Y') as payment_date, customer_details,bank_transaction_id,
							gross_amount,payment_gateway_charge,net_amount,bank_name,transaction_status,merchant_name,payment_remark,
							refund_date,refund_status,refund_amount");
				$this->db->from('payment_gateway_report');
				$this->db->where('transaction_date',$date);
				$this->db->where('record_status',1);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			case 'get_payment_verification' :
				//$user_code = $_POST['user_code'];
				$slno = 1;
				$count = 0;
				$total_amount = array();
				$net_amount = array();
				$this->db->select("D.institute_code,E.institute_name,SUM(A.amount) AS success_amount");
				$this->db->from('counselling_applicant_form_fee_overview A');
				$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no','left');
				$this->db->join('applicant_form_online_deposit C','A.appl_no = C.appl_no','left');
				$this->db->join('counselling_program_master D','B.applied_program = D.program_code','left');
				$this->db->join('institute_master E','D.institute_code = E.institute_code','left');
				$this->db->where(' A.money_deposit_mode','ONLINE');
				$this->db->where(' D.institute_code !=','');
				$this->db->where(' C.deposit_status','SUCCESS');
				$this->db->group_by('D.institute_code');
				$result1 = $this->db->get();
				$this->db->select("SUM(A.amount) AS amount");
				$this->db->from('counselling_applicant_form_fee_overview A');
				$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no','left');
				$this->db->join('applicant_form_online_deposit C','A.appl_no = C.appl_no','left');
				$this->db->join('counselling_program_master D','B.applied_program = D.program_code','left');
				$this->db->join('institute_master E','D.institute_code = E.institute_code','left');
				$this->db->where(' A.money_deposit_mode','ONLINE');
				$this->db->where(' D.institute_code !=','');
				$this->db->group_by('D.institute_code');
				$result2 = $this->db->get();
				$output_data2 = $result2->result_array();
				foreach ($output_data2 as $aRow2) 
	            {
	                $total_amount[] = $aRow2;
	            }
				//echo $this->db->last_query();
				$this->db->select("SUM(F.net_amount) AS net_amount");
				$this->db->from('counselling_applicant_form_fee_overview A');
				$this->db->join('applicant_appl_overview B','A.appl_no = B.appl_no','left');
				$this->db->join('applicant_form_online_deposit C','A.appl_no = C.appl_no','left');
				$this->db->join('counselling_program_master D','B.applied_program = D.program_code','left');
				$this->db->join('institute_master E','D.institute_code = E.institute_code','left');
				$this->db->join('(SELECT order_id,net_amount,transaction_status FROM  payment_gateway_report WHERE transaction_status = "Success")F','C.order_number = F.order_id','left');
				$this->db->join('(SELECT A.amount,A.appl_no FROM counselling_applicant_form_fee_overview A,applicant_appl_overview B WHERE A.appl_no = B.appl_no AND A.money_deposit_mode = "ONLINE" AND B.appl_status = "Verified")G','A.appl_no = G.appl_no','left');
				$this->db->where(' A.money_deposit_mode','ONLINE');
				$this->db->where(' D.institute_code !=','');
				$this->db->group_by('D.institute_code');
				$result3 = $this->db->get();
				//echo $this->db->last_query();
				$output_data3 = $result3->result_array();
				$output_data1 = $result1->result_array();
				foreach ($output_data3 as $aRow3) 
	            {
	                $net_amount[] = $aRow3;
	            }
				//$output = array()
				$copyData = array();
				foreach ($output_data1 as $aRow1) 
	            {
	                //array_unshift($aRow1,$slno);
					$row[0] = $slno;
					$row['institute_code'] = $slno;
					$row[1] = $aRow1['institute_code'];
					$row['institute_code'] = $aRow1['institute_code'];
					$row[2] = $aRow1['institute_name'];
					$row['institute_name'] = $aRow1['institute_name'];
					$row[3] = $aRow1['success_amount'];
					$row['amount'] = $aRow1['success_amount'];
					$row[4] = $net_amount[$count]['net_amount'];
					$row['net_amount'] =$net_amount[$count]['net_amount'];
					$row[5] = $total_amount[$count]['amount'];
					$row['total_amount'] =$total_amount[$count]['amount'];
					$output['aaData'][] = $row;
					$slno++;
					$count++;
	            }
				//echo $this->db->last_query
	           	return $output;
			break;
			case 'add_user_program' :
				$arr_program_code = array();
				$arr_user_code = array();
				$program_codes = $_POST['program_codes'];
				$user_codes = $_POST['users'];
				$institute = $_POST['institute'];
				$arr_program_code = call_user_func_array('array_merge', $program_codes);
				$arr_user_code = call_user_func_array('array_merge', $user_codes);
				$dbStatus = 'ERROR';
				$dbMessage = '';
				$success_count = 0;
				$output = array();
				date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				for($i=0;$i<sizeof($arr_user_code);$i++)
				{
					for($j=0;$j<sizeof($arr_program_code);$j++)
					{
						
						$new_data = array(
							'user_code' 					=>$arr_user_code[$i],
							'program_code' 					=>$arr_program_code[$j],
							'institute_code' 				=>$institute,
							'created_by'					=>'SUPADM001',
							'created_on'					=>$date
						);
						$insert_user =  $this->db->insert('user_program_mapping', $new_data);
						if($insert_user){
							$success_count++;
						}
					}
				}
				if($success_count != 0)
				{
					$dbStatus = TRUE;
					$dbMessage = 'Data saved successfully';
				}
				else
				{
					$dbStatus = FALSE;
					$dbMessage = 'Error in saving';
				}
				$output = array('status'=>$dbStatus,'msg'=>$dbMessage);
	           	return $output;
			break;
			/**
			* logic: To operate data for Group Master
			* case:get_groupdata,get_table,get_tablevalue,get_tablemapvalue,delete_group,delete_groupmapdata,add_group
			* author:Rahul Patro
			* date :15/09/2017
			*/
			case 'get_groupdata':  
				$order = ''; 
			    $Ocolumn = '';
			    $Odir = '';
				$order = $this->input->post('order');
				if ( $order )
					{
						foreach($order as $row) {
							$Ocolumn= $row['column'];
							$Odir=  $row['dir'];
						}
						$this->db->order_by($Ocolumn,$Odir);
					}else{
						$this->db->order_by(1,"ASC");
					}
			 	$search = $this->input->post('search');
			 	$header = array('gm.group_name', 'tblop.table_name','gm.group_code','tblop.table_code','gm.operation_tbl','gm.operation_col','gm.exicution_col');
			 	
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
				
			    $iDisplayLength = $this->input->post('length');
				$iDisplayStart = $this->input->post('start');
				
                $this->db->limit($iDisplayLength, $iDisplayStart);
				$this->db->from('group_master as gm');
                $this->db->select('`gm.group_code`, `gm.group_name`,`tblop.table_name`,`tblop.table_code`,gm.operation_tbl,gm.operation_col,gm.exicution_col');	
                $this->db->join('table_operation as tblop','gm.table_code = tblop.table_code','inner');
                $this->db->where('gm.record_status',1);
				$res = $this->db->get();
				$query = $res->result_array();
				$output = array("aaData" => array());
				
				
				
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
              	$this->db->from('group_master as gm');
                $this->db->select('`gm.group_code`, `gm.group_name`,`tblop.table_name`,`tblop.table_code`,gm.operation_tbl,gm.operation_col,gm.exicution_col');	
                $this->db->join('table_operation as tblop','gm.table_code = tblop.table_code','inner');
                $this->db->where('gm.record_status',1);
                
				$res1 = $this->db->get();
				$output["draw"] = intval( $this->input->post('draw') );
				$output['iTotalRecords'] = $res1->num_rows(); 
				$output['iTotalDisplayRecords'] =  $res1->num_rows();
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
			break;
			case 'get_table':
				$result = $this->db->get('table_operation');
				return $result->result_array();;
			break;
			case 'get_tablevalue':
				$table_code = $this->input->post('table_name');
				$group_code = $this->input->post('group_code');
				$this->db->from('table_operation');
                $this->db->select('`column_code`, `column_name`');	
                $this->db->where('table_code',$table_code);
                $result = $this->db->get();
                foreach($result->result_array() as $row){
					 $column_code = $row['column_code'];
					 $column_name = $row['column_name'];
				}
				$output = array("optiondata" => array());
				$this->db->from($table_code);
                $this->db->select($column_code." as 'code',".$column_name." as 'name'");	
                $this->db->where('record_status',1);
                $this->db->where($column_code.' not in (SELECT map_value_code FROM group_mapping WHERE group_code = "'.$group_code.'")');
                $result1 = $this->db->get();
                $output['optiondata'] = $result1->result_array();
				return $output;
			break;
			case 'get_tablemapvalue':  
				$order = ''; 
			    $Ocolumn = '';
			    $Odir = '';
				$order = $this->input->post('order');
				if ( $order )
					{
						foreach($order as $row) {
							$Ocolumn= $row['column'];
							$Odir=  $row['dir'];
						}
						$this->db->order_by($Ocolumn,$Odir);
					}else{
						$this->db->order_by(1,"ASC");
					}
			 	$search = $this->input->post('search');
			 	$header = array('gmas.group_name', 'map_value_code');
			 	
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
				if($this->input->post('group_code')){
					$this->db->where('gmap.group_code',$this->input->post('group_code'));
				}
			    $iDisplayLength = $this->input->post('length');
				$iDisplayStart = $this->input->post('start');
				
                $this->db->limit($iDisplayLength, $iDisplayStart);
				$this->db->from('group_mapping AS gmap');
                $this->db->select('gmas.group_name,map_value_code,gmap.id');	
                $this->db->join('group_master AS gmas','gmap.group_code = gmas.group_code','inner');
				$res = $this->db->get();
				$query = $res->result_array();
				$output = array("aaData" => array());
				
				
				
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
				if($this->input->post('group_code')){
					$this->db->where('gmap.group_code',$this->input->post('group_code'));
				}
              	$this->db->from('group_mapping AS gmap');
                $this->db->select('gmas.group_name,map_value_code,gmap.id');	
                $this->db->join('group_master AS gmas','gmap.group_code = gmas.group_code','inner');
                
				$res1 = $this->db->get();
				$output["draw"] = intval( $this->input->post('draw') );
				$output['iTotalRecords'] = $res1->num_rows(); 
				$output['iTotalDisplayRecords'] =  $res1->num_rows();
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
			break;
			case 'delete_group':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$group_code = $data['group_code'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('group_code', $group_code);
				$this->db->update('group_master', $new_data);
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting'.$this->db->_error_message();
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			case 'delete_groupmapdata':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
			 	$id = $data['id'];
				$output = array();
				$this->db->where('id', $id);
				$this->db->delete('group_mapping'); 
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting'.$this->db->_error_message();
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			case 'add_group':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
			 	$txtGroupName = $data['txtGroupName'];
			 	$cmbtable = $data['cmbtable'];
			 	$cmbtablevalue = array();
			 	$cmbtablevalue = isset($data['cmbtablevalue'])?$data['cmbtablevalue']:[];
			 	if (in_array('multiselect-all', $cmbtablevalue)) 
				{ 
					$index = array_search('multiselect-all',$cmbtablevalue);
					if($index !== FALSE){
						unset($cmbtablevalue[$index]);
						$cmbtablevalue = array_values($cmbtablevalue);
					}
					
				}
				$qry = $this->db->query("SELECT MAX(id)+1 AS max_id FROM group_master");
				$Sresult = $qry->result_array();
				$row2 = array_shift($Sresult);
				$newid = "G".$row2['max_id'].rand(1000,9999);
				$data = array( "group_code" =>$newid,
								"group_name" => $this->input->post('txtGroupName'),
								"table_code" => $this->input->post('cmbtable'),
								"operation_tbl" => $this->input->post('txtoperTable'),
								"operation_col" => $this->input->post('txtoperColumn'),
								"exicution_col" => $this->input->post('txtExColumn'),
								"created_by" => 'superadmin',
								"created_on" => date('Y-m-d H:i:s', now())
							);
				$insert_group = $this->db->insert('group_master',$data);
				if( ! $insert_group){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}else{
					$newarray=array();
					$insert_group_map =TRUE;
					for($i = 0;$i < sizeof($cmbtablevalue);$i++)
					{
						$newarray[] = array(
								      'group_code' => $newid ,
								      'map_value_code' => $cmbtablevalue[$i] ,
								      'created_by' => 'superadmin',
									  'created_on' => date('Y-m-d H:i:s', now())
								   );
					}
					if(sizeof($cmbtablevalue) != 0)
						$insert_group_map = $this->db->insert_batch('group_mapping',$newarray);
					if( ! $insert_group_map){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
					}
				}
				$output = array();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			case 'edit_group':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
			 	$txtGroupName = $data['txtGroupName'];
			 	$cmbtable = $data['cmbtable'];
			 	$hidgroupcode = $data['hidgroupcode'];
			 	$cmbtablevalue = array();
			 	$cmbtablevalue = isset($data['cmbtablevalue'])?$data['cmbtablevalue']:[];
			 	if (in_array('multiselect-all', $cmbtablevalue)) 
				{ 
					$index = array_search('multiselect-all',$cmbtablevalue);
					if($index !== FALSE){
						unset($cmbtablevalue[$index]);
						$cmbtablevalue = array_values($cmbtablevalue);
					}
					
				}
				
				$data = array( "group_name" => $this->input->post('txtGroupName'),
								"operation_tbl" => $this->input->post('txtoperTable'),
								"operation_col" => $this->input->post('txtoperColumn'),
								"exicution_col" => $this->input->post('txtExColumn'),
								"updated_by" => 'superadmin'
							);
							$this->db->where("group_code",$hidgroupcode);
				$insert_group = $this->db->update('group_master',$data);
				if( ! $insert_group){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Saving';
				}else{
					$newarray=array();
					$insert_group_map =TRUE;
					for($i = 0;$i < sizeof($cmbtablevalue);$i++)
					{
						$newarray[] = array(
								      'group_code' => $hidgroupcode ,
								      'map_value_code' => $cmbtablevalue[$i] ,
								      'created_by' => 'superadmin',
									  'created_on' => date('Y-m-d H:i:s', now())
								   );
					}
					if(sizeof($cmbtablevalue) != 0)
						$insert_group_map = $this->db->insert_batch('group_mapping',$newarray);
					if( ! $insert_group_map){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
					}
				}
				$output = array();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			/**
			* logic: Operations for  Manage Group 
			* case:Group Code Combo Box ,Role-Group datatable, add role_group data
			* author:Lina Mohapatra
			* date :13/09/2017
			*/
			case 'get_group':
				$output = array("aaData" => array());
				$this->db->select("group_code,group_name");
				$this->db->from("group_master");
				$this->db->where("record_status",1);
				$this->db->group_by("group_code",1);
				$this->db->order_by("id");
				$result = $this->db->get();
				$output_data = $result->result_array();
				return $output_data;
			break;
			
			case 'get_role_group_data':            
			 	
			 	$order = ''; 
			    $Ocolumn = '';
			    $Odir = '';
				$order = $this->input->post('order');
				if ( $order )
					{
						foreach($order as $row) {
							$Ocolumn= $row['column'];
							$Odir=  $row['dir'];
						}
						$this->db->order_by($Ocolumn,$Odir);
					}else{
						$this->db->order_by(1,"ASC");
					}
			 	$search = $this->input->post('search');
			 	$header = array('rm.role_name', 'gm.group_name','rgm.name');
			 	
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
				
			    $iDisplayLength = $this->input->post('length');
				$iDisplayStart = $this->input->post('start');
				
                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->select('rgm.name,rm.role_name,gm.group_name,rm.role_code,gm.group_code,rgm.role_group_code');
                $this->db->from('role_group_mapping  rgm');	
                $this->db->join('role_master rm', 'rgm.role_code = rm.role_code', 'LEFT');
                $this->db->join('group_master gm', 'rgm.group_code = gm.group_code', 'LEFT');
                $this->db->where('rgm.record_status',1);
                $this->db->where('rm.record_status',1);
                $this->db->where('gm.record_status',1);
                $this->db->group_by('rm.role_code');
                $this->db->group_by('gm.group_code');
				$res = $this->db->get();
				$query = $res->result_array();
				$output = array("aaData" => array());
				
				$header = array('rm.role_name', 'gm.group_name','rgm.name');
				
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
				
              	$this->db->select('`rm.role_name`, `gm.group_name`,`rgm.name`,`rm.role_code`,`gm.group_code`');
                $this->db->from('role_group_mapping  rgm');	
                $this->db->join('role_master rm', 'rgm.role_code = rm.role_code', 'LEFT');
                $this->db->join('group_master gm', 'rgm.group_code = gm.group_code', 'LEFT');
                $this->db->where('rgm.record_status',1);
                $this->db->where('rm.record_status',1);
                $this->db->where('gm.record_status',1);
                $this->db->group_by('rm.role_code');
                $this->db->group_by('gm.group_code');
                
				$res1 = $this->db->get();
				$output["draw"] = intval( $this->input->post('draw') );
				$output['iTotalRecords'] = $res1->num_rows(); 
				$output['iTotalDisplayRecords'] =  $res1->num_rows();
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
			break;
			
			case 'add_role_group': 
			
				date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$role_code = $_POST['cmbrolecode'];
			 	$group_code = $_POST['cmbgroupcode'];
			 	$role_group_name = $_POST['txtRoleGroup'];
			 	
			 	$this->db->select('`role_code`, `group_code`');
                $this->db->from('role_group_mapping');	
                $this->db->where('role_code',$role_code);
                $this->db->where('group_code',$group_code);
                $this->db->where('record_status',1);
               	$res = $this->db->get();
			 	$query = $res->result_array();
			 	
			 	if($res->num_rows() > 0) {
					$dbstatus = FALSE;
					$dbmessage = 'Error Duplicate Record Entry';
				}
			 	else{
			 		$this->db->select_max('id');
	                $this->db->from('role_group_mapping');	
				 	$res = $this->db->get();
				 	$query = $res->result_array();
				 	
				 	foreach($query as $aRow)
					{
						$max_id = $aRow['id'];
					}
				 	if($max_id == ''){
						$max_id = 0;
					}
					else{
						$max_id = $max_id ;
					}
					
					$role_group_code = $role_code .'_'.$group_code.$max_id;
					
					$output = array();
					$new_data = array(
					'role_group_code' 				=>$role_group_code,
					'name' 							=>$role_group_name,
					'role_code' 					=>$role_code,
					'group_code' 					=>$group_code,
					'created_by'					=>'SUPERADMIN', 
					'created_on'					=>$date,
					'updated_by'					=>'SUPERADMIN' ,
					'updated_on' 					=>$date,
					'record_status'					=>1
					);
					$insert_user =  $this->db->insert('role_group_mapping', $new_data);
					if( ! $insert_user){
							$dbstatus = FALSE;
							$dbmessage = 'Error While Saving';
					}	
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output; 
			break;
			
			case 'edit_role_group':  
			
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$hidtxtRole_group_code = $_POST['hidtxtRole_group_code'];
			 	$role_code = $_POST['cmbrolecode'];
			 	$group_code = $_POST['cmbgroupcode'];
			 	$role_group_name = $_POST['txtRoleGroup'];
			 	
			 	$hid_role_code = $_POST['hidtxtrolecode'];
			 	$hid_group_code = $_POST['hidtxtgroupcode'];
			 	
			 	
		 		date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				$output = array();
				
				if( $hid_role_code == $role_code && $hid_group_code == $group_code ){
					$new_data = array(
					'name' 							=>$role_group_name,
					'created_by'					=>'SUPERADMIN', 
					'created_on'					=>$date,
					'updated_by'					=>'SUPERADMIN' ,
					'updated_on' 					=>$date,
					'record_status'					=>1
					);
					$this->db->where('role_group_code', $hidtxtRole_group_code);
					$update_data = $this->db->update('role_group_mapping', $new_data);
					if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
					}
				}
				else{
					$this->db->select('`role_code`, `group_code`');
	                $this->db->from('role_group_mapping');	
	                $this->db->where('role_code',$role_code);
	                $this->db->where('group_code',$group_code);
	                $this->db->where('record_status',1);
	               	$res = $this->db->get();
				 	$query = $res->result_array();
				 	
				 	if($res->num_rows() > 0) {
						$dbstatus = FALSE;
						$dbmessage = 'Error Duplicate Record ';
					}
					else{
						$new_data = array(
						'name' 							=>$role_group_name,
						'role_code' 					=>$role_code,
						'group_code' 					=>$group_code,
						'created_by'					=>'SUPERADMIN', 
						'created_on'					=>$date,
						'updated_by'					=>'SUPERADMIN' ,
						'updated_on' 					=>$date,
						'record_status'					=>1
						);
						$this->db->where('role_group_code', $hidtxtRole_group_code);
						$update_data = $this->db->update('role_group_mapping', $new_data);
						if($this->db->affected_rows() == 0){
							$dbstatus = FALSE;
							$dbmessage = 'Error While Saving';
						}
					}
					
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output; 
				
			break;
			
			case 'delete_role_group':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$role_group_code = $_POST['rolegroupcode'];
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('role_group_code', $role_group_code);
				$this->db->update('role_group_mapping', $new_data);
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			
			/**
			* logic: Operations for  Manage User-to-RoleGroup 
			* case:Group Code Combo Box ,Role-Group datatable, add role_group data
			* author:Lina Mohapatra
			* date :15/09/2017
			*/
			
			case 'get_rolegroup_code':
				$output = array("aaData" => array());
				$this->db->select("role_group_code,name");
				$this->db->from("role_group_mapping");
				$this->db->where("record_status",1);
				$this->db->group_by("role_group_code",1);
				$this->db->order_by("id");
				$result = $this->db->get();
				$output_data = $result->result_array();
				return $output_data;
			break;
			
			case 'get_user_code':
				$output = array("aaData" => array());
				$this->db->select("user_code,user_name");
				$this->db->from("user_master");
				$this->db->where("record_status",1);
				$this->db->group_by("user_code",1);
				$this->db->order_by("id");
				$result = $this->db->get();
				$output_data = $result->result_array();
				return $output_data;
			break;
			
			case 'get_user_role_group_data':            
			 	
			 	$order = ''; 
			    $Ocolumn = '';
			    $Odir = '';
				$order = $this->input->post('order');
				if ( $order )
					{
						foreach($order as $row) {
							$Ocolumn= $row['column'];
							$Odir=  $row['dir'];
						}
						$this->db->order_by($Ocolumn,$Odir);
					}else{
						$this->db->order_by(1,"ASC");
					}
			 	$search = $this->input->post('search');
			 	$header = array('urgp.`user_rolegroup_code', 'um.user_name','rgm.`name`');
			 	
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
				if($this->input->post('cmbrolegroup')){
					$this->db->where('urgp.role_group_code',$this->input->post('cmbrolegroup'));
				}
			    $iDisplayLength = $this->input->post('length');
				$iDisplayStart = $this->input->post('start');
				
                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->select('um.`user_code`,rgm.`role_group_code`,um.user_name,rgm.`name`,urgp.`user_rolegroup_code`');
                $this->db->from('user_role_group_map urgp ');	
                $this->db->join('user_master um', 'urgp.user_code = um.user_code', 'LEFT');
                $this->db->join('role_group_mapping rgm', 'urgp.role_group_code = rgm.role_group_code', 'LEFT');
                $this->db->where('rgm.record_status',1);
                $this->db->where('um.record_status',1);
                $this->db->where('urgp.record_status',1);
                $this->db->group_by('urgp.`user_rolegroup_code`');
                $this->db->group_by('um.user_code');
				$res = $this->db->get();
				$query = $res->result_array();
				$output = array("aaData" => array());
				
				$header = array('urgp.`user_rolegroup_code', 'um.user_name','rgm.`name`');
				
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
				if($this->input->post('cmbrolegroup')){
					$this->db->where('urgp.role_group_code',$this->input->post('cmbrolegroup'));
				}
                $this->db->select('um.`user_code`,rgm.`role_group_code`,urgp.`user_rolegroup_code`,um.user_name,rgm.`name`');
                $this->db->from('user_role_group_map urgp ');	
                $this->db->join('user_master um', 'urgp.user_code = um.user_code', 'LEFT');
                $this->db->join('role_group_mapping rgm', 'urgp.role_group_code = rgm.role_group_code', 'LEFT');
                $this->db->where('rgm.record_status',1);
                $this->db->where('um.record_status',1);
                $this->db->where('urgp.record_status',1);
                $this->db->group_by('urgp.`user_rolegroup_code`');
                $this->db->group_by('um.user_code');
                
				$res1 = $this->db->get();
				$output["draw"] = intval( $this->input->post('draw') );
				$output['iTotalRecords'] = $res1->num_rows(); 
				$output['iTotalDisplayRecords'] =  $res1->num_rows();
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
			break;
			
			case 'add_user_role_group': 
			
				date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtrole_group = $_POST['txtrole_group'];
			 	$cmbuser_name = $_POST['cmbuser_name'];
			 	if (in_array('multiselect-all', $cmbuser_name)) 
				{ 
					$index = array_search('multiselect-all',$cmbuser_name);
					if($index !== FALSE){
						unset($cmbuser_name[$index]);
						$cmbuser_name = array_values($cmbuser_name);
					}
					
				}
			 	$newarray=array();
			    $insert_user_role_group_map =TRUE;
			   // print_r($cmbuser_name);die();
			    for($i = 0;$i < sizeof($cmbuser_name);$i++)
			    {
			    	$qry = $this->db->query("SELECT MAX(id)+1 AS max_id FROM user_role_group_map");
					$Sresult = $qry->result_array();
					$row2 = array_shift($Sresult);
			     	
			     	
			      	$newarray[] = array(
			              'user_rolegroup_code' 		=> 'urg'.$row2['max_id'].rand(100,9999),
			              'user_code' 					=> $cmbuser_name[$i] ,
			              'role_group_code' 			=> $txtrole_group,
			           	  'created_by'					=>'SUPERADMIN', 
						  'created_on'					=>$date,
						  'updated_by'					=>'SUPERADMIN' ,
						  'updated_on' 					=>$date,
						  'record_status'				=>1
			        );
			        
			    }
			     if(sizeof($cmbuser_name) != 0)
				      $insert_user_role_group_map = $this->db->insert_batch('user_role_group_map',$newarray);
				 if( ! $insert_user_role_group_map){
				      $dbstatus = FALSE;
				      $dbmessage = 'Error While Saving';
			     }
			     
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				return $output; 
			break;
			
			case 'delete_user_rolegroup':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$user_role_group_code = $data['userrolegroupcode'];
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				$output = array();
				$this->db->where('user_rolegroup_code', $user_role_group_code);
				$this->db->delete('user_role_group_map'); 
								
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			case 'delete_rolegroup':  
				
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$rolegroupcode = $data['rolegroupcode'];
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				$output = array(); 
				$new_data = array(
					'record_status'	=>0
				);
				$this->db->where('role_group_code', $rolegroupcode);
				$this->db->update('role_group_mapping', $new_data);			
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			case 'get_datatabledata': 
				$order = ''; 
			    $Ocolumn = '';
			    $Odir = '';
			    
			    $id = $this->group_data();
				//echo $id;
				
				$order = $this->input->post('order');
				if ( $order )
					{
						foreach($order as $row) {
							$Ocolumn= $row['column'];
							$Odir=  $row['dir'];
						}
						$this->db->order_by($Ocolumn,$Odir);
					}else{
						$this->db->order_by(1,"ASC");
					}
			 	$search = $this->input->post('search');
			 	$header = array('`id`,`name`,`country`,`department`,`qualification`');
			 	
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
			    $iDisplayLength = $this->input->post('length');
				$iDisplayStart = $this->input->post('start');
				
                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->select('id,name,country,department,qualification');
                $this->db->from('datatable');
                //$this->db->join('datatable');
                //$this->db->where_in('id',$id);	
                $this->db->where('id in ('.$id.')');
                
				$res = $this->db->get();
				$query = $res->result_array();
				$output = array("aaData" => array());
				
				$header = array('`id`,`name`,`country`,`department`,`qualification`');
				
			 	if($search['value'] != ''){
					for($i=0;$i <count($header);$i++ ){
						$this->db->or_like($header[$i], $search['value']);
					}
				}
				
                $this->db->select('id,name,country,department,qualification');
                $this->db->from('datatable');
                $this->db->where('id in ('.$id.')');	
              
                
				$res1 = $this->db->get();
				$output["draw"] = intval( $this->input->post('draw') );
				$output['iTotalRecords'] = $res1->num_rows(); 
				$output['iTotalDisplayRecords'] =  $res1->num_rows();
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
			break;
			case 'get_Organisationdata':
            	$order = '';
                $Ocolumn = '';
                $Odir = '';
                $order = $this->input->post('order');
                if ($order) {
                    foreach ($order as $row) {
                        $Ocolumn = $row['column'];
                        $Odir = $row['dir'];
                    }
                    $this->db->order_by($Ocolumn, $Odir);
                } else {
                    $this->db->order_by(1, "ASC");
                }
                $search = $this->input->post('search');
                $header = array('org_name', 'org_display_name');//search filter will work on this column
                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }

                $iDisplayLength = $this->input->post('length');//to shw number of record to be shown
                $iDisplayStart = $this->input->post('start');//to start from that position (ex: offset)

                $this->db->limit($iDisplayLength, $iDisplayStart);
                $this->db->from('org_master');
                $this->db->select("org_code,org_name,org_display_name,website_address,logo_url,location");
               	
               	$res = $this->db->get();
                $query = $res->result_array();
                $output = array("aaData" => array());
				/*----FOR PAGINATION-----*/
                if ($search['value'] != '') {
                    for ($i = 0; $i < count($header); $i++) {
                        $this->db->or_like($header[$i], $search['value']);
                    }
                }

                $this->db->from('org_master');
                $this->db->select("org_code,org_name,org_display_name,website_address,logo_url,location");
                $res1 = $this->db->get();
                
                $output["draw"] = intval($this->input->post('draw'));
                $output['iTotalRecords'] = $res1->num_rows();
                $output['iTotalDisplayRecords'] = $res1->num_rows();
                $slno = 1;
                foreach ($query as $aRow) {
                    $row[0] = $slno;
                    $row['sl_no'] = $slno;
                    $i = 1;
                    foreach ($aRow as $key => $value) {

                        $row[$i] = $value;
                        $row[$key] = $value;
                        $i++;
                    }
					$output['aaData'][] = $row;
                    $slno++;
                    unset($row);
                }
                return $output;
			break;
			/*==========XXXXXXXXXXX========GENERIC SETUP2==========XXXXXXXXXXXXXXXXXX=============== */
			//Country
			case 'select_country':
				$this->db->select("country_code,country_name,id");
				$this->db->from('country_master');
				$this->db->where('record_status', 1);
				$this->db->order_by("id");
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			
			case 'insert_country': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	$txtCountryCode = isset($_POST['txtCountryCode'])?strtoupper($_POST['txtCountryCode']):'';
			 	$txtCountryName = $_POST['txtCountryName'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'country_code' 					=>$txtCountryCode,
				'country_name' 					=>$txtCountryName,
				'record_status' 				=>$cmbRecordStatus,
				'created_by'					=>$logged_user,
				'created_on'					=>$date
				);
				$insert_user =  $this->db->insert('country_master', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'update_country': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
            	$id = $_POST['hidUniqueidEdit'];
			 	$txtCountryCodeEdit = isset($_POST['txtCountryCodeEdit'])?strtoupper($_POST['txtCountryCodeEdit']):'';
			 	$txtCountryNameEdit = $_POST['txtCountryNameEdit'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'country_code' 					=>$txtCountryCodeEdit,
				'country_name' 					=>$txtCountryNameEdit,
				'record_status' 				=>$cmbRecordStatus,
				'updated_by'					=>$logged_user,
				'updated_on'					=>$date
				);
				$this->db->where('id',$id );
				$this->db->update('country_master', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'delete_country':  	
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$countryID = $_POST['countryID'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('id', $countryID);
				$this->db->delete('country_master');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			
			//State
			case 'select_state' :
			$this->db->select("country_name,state_code,state_name,state_master.id ");
			$this->db->from('state_master');
			$this->db->join('country_master', 'country_master.country_code = state_master.country_code', 'LEFT');
			$this->db->where('state_master.record_status',1);
			$this->db->order_by('state_master.id');
			$result = $this->db->get();
			//echo $this->db->last_query();
			$output_data = $result->result_array();
			$output = array("aaData" => array());
			$slno = 1;
			foreach ($output_data as $aRow) 
            {
                $row[0] = $slno;
                $row['sl_no'] = $slno;
                $i = 1;
                foreach ($aRow as $key => $value) {

                    $row[$i] = $value;
                    $row[$key] = $value;
                    $i++;
                }
				$output['aaData'][] = $row;
                $slno++;
                unset($row);
            }
           	return $output;
			break;
			
			case 'insert_state': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
            	$txtStateCode = isset($_POST['txtStateCode'])?strtoupper($_POST['txtStateCode']):'';
			 	$txtStateName = $_POST['txtStateName'];
			 	$cmbCountryName = $_POST['cmbCountryName'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'state_code' 					=>$txtStateCode,
				'state_name' 					=>$txtStateName,
				'country_code' 					=>$cmbCountryName,
				'record_status' 				=>$cmbRecordStatus,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$insert_user =  $this->db->insert('state_master', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'update_state': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
            	$id = $_POST['hidUniqueidEdit'];
            	$txtStateCodeEdit = isset($_POST['txtStateCodeEdit'])?strtoupper($_POST['txtStateCodeEdit']):'';
			 	$txtStateNameEdit = $_POST['txtStateNameEdit'];
			 	$cmbCountryNameEdit = $_POST['cmbCountryNameEdit'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'state_code' 					=>$txtStateCodeEdit,
				'state_name' 					=>$txtStateNameEdit,
				'country_code' 					=>$cmbCountryNameEdit,
				'record_status' 				=>$cmbRecordStatus,
				'updated_by'					=>'SUPADM001',
				'updated_on'					=>$date
				);
				$this->db->where('id',$id );
				$this->db->update('state_master', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'delete_state':  	
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$religionID = $_POST['religionID'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('id', $religionID);
				$this->db->delete('state_master');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			
			//District
			case 'select_district' :
			$this->db->select("country_master.country_name,state_master.state_name,district_code,district_name,district_master.id ");
			$this->db->from('district_master');
			$this->db->join('state_master','state_master.state_code = district_master.state_code','LEFT');
			$this->db->join('country_master','district_master.country_code = country_master.country_code','LEFT');
			$this->db->where('district_master.record_status', 1);
			$this->db->order_by('district_master.id');
			$result = $this->db->get();
			//echo $this->db->last_query();
			$output_data = $result->result_array();
			$output = array("aaData" => array());
			$slno = 1;
			foreach ($output_data as $aRow) 
            {
                $row[0] = $slno;
                $row['sl_no'] = $slno;
                $i = 1;
                foreach ($aRow as $key => $value) {

                    $row[$i] = $value;
                    $row[$key] = $value;
                    $i++;
                }
				$output['aaData'][] = $row;
                $slno++;
                unset($row);
            }
           	return $output;
			break;
			
			case 'insert_district': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	            	
			 	$txtDistrictCode = isset($_POST['txtDistrictCode'])?strtoupper($_POST['txtDistrictCode']):'';
			 	$txtDistrictName = $_POST['txtDistrictName'];
			 	$cmbStateName = $_POST['cmbStateName'];
			 	$cmbCountryName = $_POST['cmbCountryName'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'district_code' 					=>$txtDistrictCode,
				'district_name' 					=>$txtDistrictName,
				'state_code' 						=>$cmbStateName,
				'country_code' 						=>$cmbCountryName,
				'record_status' 					=>$cmbRecordStatus,
				'created_by'						=>'SUPADM001',
				'created_on'						=>$date
				);
				$insert_user =  $this->db->insert('district_master', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'update_district': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$id = $_POST['hidUniqueidEdit'];
			 	$txtDistrictCodeEdit = isset($_POST['txtDistrictCodeEdit'])?strtoupper($_POST['txtDistrictCodeEdit']):'';
			 	$txtDistrictNameEdit = $_POST['txtDistrictNameEdit'];
			 	$cmbStateNameEdit = $_POST['cmbStateNameEdit'];
			 	$cmbCountryNameEdit = $_POST['cmbCountryNameEdit'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'district_code' 				=>$txtDistrictCodeEdit,
				'district_name' 				=>$txtDistrictNameEdit,
				'state_code' 					=>$cmbStateNameEdit,
				'country_code' 					=>$cmbCountryNameEdit,
				'record_status' 				=>$cmbRecordStatus,
				'updated_by'					=>'SUPADM001',
				'updated_on'					=>$date
				);
				$this->db->where('id',$id );
				$this->db->update('district_master', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'delete_district':  	
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	$districtID = $_POST['districtID'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('id', $districtID);
				$this->db->delete('district_master');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			
			//Nationality
			case 'select_nationality' :
			$this->db->select("nationality_code,nationality,id");
			$this->db->from('nationality_master');
			$this->db->where('record_status',1);
			$this->db->order_by('id');
			$result = $this->db->get();
			//echo $this->db->last_query();
			$output_data = $result->result_array();
			$output = array("aaData" => array());
			$slno = 1;
			foreach ($output_data as $aRow) 
            {
                $row[0] = $slno;
                $row['sl_no'] = $slno;
                $i = 1;
                foreach ($aRow as $key => $value) {

                    $row[$i] = $value;
                    $row[$key] = $value;
                    $i++;
                }
				$output['aaData'][] = $row;
                $slno++;
                unset($row);
            }
           	return $output;
			break;
			
			case 'insert_nationality': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	$txtNationalityCode = isset($_POST['txtNationalityCode'])?strtoupper($_POST['txtNationalityCode']):'';
			 	$txtNationalityName = $_POST['txtNationalityName'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
					
				$output = array();
				$new_data = array(
				'nationality_code' 				=>$txtNationalityCode,
				'nationality' 					=>$txtNationalityName,
				'record_status' 				=>$cmbRecordStatus,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$insert_user =  $this->db->insert('nationality_master', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'update_nationality': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	$id = $_POST['hidUniqueidEdit'];
			 	$txtNationalityCodeEdit = isset($_POST['txtNationalityCodeEdit'])?strtoupper($_POST['txtNationalityCodeEdit']):'';
			 	$txtNationalityNameEdit = $_POST['txtNationalityNameEdit'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'nationality_code' 				=>$txtNationalityCodeEdit,
				'nationality' 					=>$txtNationalityNameEdit,
				'record_status' 				=>$cmbRecordStatus,
				'updated_by'					=>'SUPADM001',
				'updated_on'					=>$date
				);
				$this->db->where('id',$id );
				$this->db->update('nationality_master', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'delete_nationality':  	
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$nationalityID = $_POST['nationalityID'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('id', $nationalityID);
				$this->db->delete('nationality_master');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			
			//Board
			case 'select_board' :
			$this->db->select("board_code,board_name,id");
			$this->db->from('board_master');
			$this->db->where('record_status',1);
			$this->db->order_by('id');
			$result = $this->db->get();
			//echo $this->db->last_query();
			$output_data = $result->result_array();
			$output = array("aaData" => array());
			$slno = 1;
			foreach ($output_data as $aRow) 
            {
                $row[0] = $slno;
                $row['sl_no'] = $slno;
                $i = 1;
                foreach ($aRow as $key => $value) {

                    $row[$i] = $value;
                    $row[$key] = $value;
                    $i++;
                }
				$output['aaData'][] = $row;
                $slno++;
                unset($row);
            }
           	return $output;
			break;
			
			case 'insert_board': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	$txtBoardCode = isset($_POST['txtBoardCode'])?strtoupper($_POST['txtBoardCode']):'';
			 	$txtBoardName = $_POST['txtBoardName'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'board_code' 						=>$txtBoardCode,
				'board_name' 						=>$txtBoardName,
				'record_status' 					=>$cmbRecordStatus,
				'created_by'						=>'SUPADM001',
				'created_on'						=>$date
				);
				$insert_user =  $this->db->insert('board_master', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'update_board': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	$id = $_POST['hidUniqueidEdit'];
			 	$txtBoardCodeEdit = isset($_POST['txtBoardCodeEdit'])?strtoupper($_POST['txtBoardCodeEdit']):'';
			 	$txtBoardNameEdit = $_POST['txtBoardNameEdit'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'board_code' 					=>$txtBoardCodeEdit,
				'board_name' 					=>$txtBoardNameEdit,
				'record_status' 				=>$cmbRecordStatus,
				'updated_by'					=>'SUPADM001',
				'updated_on'					=>$date
				);
				$this->db->where('id',$id );
				$this->db->update('board_master', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'delete_board':  	
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$boardID = $_POST['boardID'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('id', $boardID);
				$this->db->delete('board_master');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			
			//Standard
			case 'select_standard' :
			$this->db->select("standard_code,standard_name,previous_standard,id");
			$this->db->from('standard_master');
			$this->db->where('record_status',1);
			$this->db->order_by('id');
			$result = $this->db->get();
			//echo $this->db->last_query();
			$output_data = $result->result_array();
			$output = array("aaData" => array());
			$slno = 1;
			foreach ($output_data as $aRow) 
            {
                $row[0] = $slno;
                $row['sl_no'] = $slno;
                $i = 1;
                foreach ($aRow as $key => $value) {

                    $row[$i] = $value;
                    $row[$key] = $value;
                    $i++;
                }
				$output['aaData'][] = $row;
                $slno++;
                unset($row);
            }
           	return $output;
			break;
			
			case 'insert_standard': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	$txtStandardCode = isset($_POST['txtStandardCode'])?strtoupper($_POST['txtStandardCode']):'';
			 	$txtStandardName = $_POST['txtStandardName'];
			 	$txtPreviousStandard = $_POST['txtPreviousStandard'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
					
				$output = array();
				$new_data = array(
				'standard_code' 				=>$txtStandardCode,
				'standard_name' 				=>$txtStandardName,
				'previous_standard' 			=>$txtPreviousStandard,
				'record_status' 				=>$cmbRecordStatus,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$insert_user =  $this->db->insert('standard_master', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'update_standard': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$id = $_POST['hidUniqueidEdit'];
			 	$txtStandardCodeEdit = isset($_POST['txtStandardCodeEdit'])?strtoupper($_POST['txtStandardCodeEdit']):'';
			 	$txtStandardNameEdit = $_POST['txtStandardNameEdit'];
			 	$txtPreviousStandardEdit = $_POST['txtPreviousStandardEdit'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'standard_code' 				=>$txtStandardCodeEdit,
				'standard_name' 				=>$txtStandardNameEdit,
				'previous_standard' 			=>$txtPreviousStandardEdit,
				'record_status' 				=>$cmbRecordStatus,
				'updated_by'					=>'SUPADM001',
				'updated_on'					=>$date
				);
				$this->db->where('id',$id );
				$this->db->update('standard_master', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'delete_standard':  	
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$standardID = $_POST['standardID'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('id', $standardID);
				$this->db->delete('standard_master');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			
			//Qualification
			case 'select_qualification' :
			$this->db->select("qualification_code,qualification_name,record_status");
			$this->db->from('qualification_master');
			$this->db->order_by('id');
			$result = $this->db->get();
			//echo $this->db->last_query();
			$output_data = $result->result_array();
			$output = array("aaData" => array());
			$slno = 1;
			foreach ($output_data as $aRow) 
            {
                $row[0] = $slno;
                $row['sl_no'] = $slno;
                $i = 1;
                foreach ($aRow as $key => $value) {

                    $row[$i] = $value;
                    $row[$key] = $value;
                    $i++;
                }
				$output['aaData'][] = $row;
                $slno++;
                unset($row);
            }
           	return $output;
			break;
			
			case 'insert_qualification': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	$txtQualificationCode = isset($_POST['txtQualificationCode'])?strtoupper($_POST['txtQualificationCode']):'';
			 	$txtQualificationName = $_POST['txtQualificationName'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'qualification_code' 			=>$txtQualificationCode,
				'qualification_name' 			=>$txtQualificationName,
				'record_status' 				=>$cmbRecordStatus,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$insert_user =  $this->db->insert('qualification_master', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'update_qualification': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$id = $_POST['hidQualificationCodeEdit'];
			 	$txtQualificationCodeEdit = isset($_POST['txtQualificationCodeEdit'])?strtoupper($_POST['txtQualificationCodeEdit']):'';
			 	$txtQualificationNameEdit = $_POST['txtQualificationNameEdit'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'qualification_code' 			=>$txtQualificationCodeEdit,
				'qualification_name' 			=>$qualification_name,
				'record_status' 				=>$cmbRecordStatus,
				'updated_by'					=>'SUPADM001',
				'updated_on'					=>$date
				);
				$this->db->where('id',$id );
				$this->db->update('qualification_master', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'delete_qualification':  	
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$hidQualificationCodeEdit = $_POST['hidQualificationCodeEdit'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('id', $hidQualificationCodeEdit);
				$this->db->delete('qualification_master');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			
			//Exam Center
			case 'select_center' :
			$this->db->select("exam_centre_code,exam_centre_name,CASE WHEN record_status = 1 THEN 'ACTIVE' ELSE 'INACTIVE' END AS record_status",FALSE);
			$this->db->from('exam_centre');
			$this->db->order_by('id');
			$result = $this->db->get();
			//echo $this->db->last_query();
			$output_data = $result->result_array();
			$output = array("aaData" => array());
			$slno = 1;
			foreach ($output_data as $aRow) 
            {
                $row[0] = $slno;
                $row['sl_no'] = $slno;
                $i = 1;
                foreach ($aRow as $key => $value) {

                    $row[$i] = $value;
                    $row[$key] = $value;
                    $i++;
                }
				$output['aaData'][] = $row;
                $slno++;
                unset($row);
            }
           	return $output;
			break;
			
			case 'insert_center': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
            	$centrecode = isset($_POST['centrecode'])?strtoupper($_POST['centrecode']):'';
			 	$centrename = $_POST['centrename'];
			 	$cmbRecordStatus = $_POST['cmbCenterStatus'];
				$logged_user = $this->session->userdata('user_name');
				$institute_code = $this->session->userdata('institute_code');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'exam_centre_code' 					=>$centrecode,
				'exam_centre_name' 					=>$centrename,
				'institute_code' 					=>$institute_code,
				'record_status' 					=>$cmbRecordStatus,
				'created_by'						=>'SUPADM001',
				'created_on'						=>$date
				);
				$insert_user =  $this->db->insert('exam_centre', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'update_centre': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
            	$id = $_POST['txtCenterCodeEdit'];
			 	$txtCenterNameEdit = $_POST['txtCenterNameEdit'];
			 	$txtCasteName = $_POST['txtReligionNameEdit'];
			 	$cmbCenterStatusEdit = $_POST['cmbCenterStatusEdit'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				if($cmbCenterStatusEdit == 'ACTIVE'){
					$output = array();
					$new_data = array(
					'exam_centre_name' 				=>$txtCenterNameEdit,
					'institute_code' 				=>$institute_code,
					'record_status' 				=>1,
					'updated_by'					=>'SUPADM001',
					'updated_on'					=>$date
					);
					$this->db->where('exam_centre_code',$txtCenterCodeEdit );
					$this->db->update('exam_centre', $new_data);
					if($this->db->affected_rows() ==0){
							$dbstatus = FALSE;
							$dbmessage = 'Error While Saving';
					}
				}
				else{
					$output = array();
					$new_data = array(
					'exam_centre_name' 				=>$txtCenterNameEdit,
					'institute_code' 				=>$institute_code,
					'record_status' 				=>0,
					'updated_by'					=>'SUPADM001',
					'updated_on'					=>$date
					);
					$this->db->where('exam_centre_code',$txtCenterCodeEdit );
					$this->db->update('exam_centre', $new_data);
					if($this->db->affected_rows() ==0){
							$dbstatus = FALSE;
							$dbmessage = 'Error While Saving';
					}
					
				}
		
				
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'delete_center':  	
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	$txtCenterCode = $_GET['centrecode'];
				
				$centrecode = $_POST['centrecode'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('exam_centre_code', $centrecode);
				$this->db->delete('exam_centre');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			
			// Field
			case 'select_field' :
			$this->db->select("code,description,sl_no,field_status,id");
			$this->db->from('registration_field_setup');
			$this->db->order_by('sl_no');
			$result = $this->db->get();
			//echo $this->db->last_query();
			$output_data = $result->result_array();
			$output = array("aaData" => array());
			$slno = 1;
			foreach ($output_data as $aRow) 
            {
                $row[0] = $slno;
                $row['sl_no'] = $slno;
                $i = 1;
                foreach ($aRow as $key => $value) {

                    $row[$i] = $value;
                    $row[$key] = $value;
                    $i++;
                }
				$output['aaData'][] = $row;
                $slno++;
                unset($row);
            }
           	return $output;
			break;
			
			case 'insert_field': 
				$dbstatus = TRUE;
            	
		
		
				
			 	$cmbCode = $_POST['cmbCode'];
			 	$txtDescription = $_POST['txtDescription'];
			 	$txtSlNo = $_POST['txtSlNo'];
			 	$cmbFieldStatus = $_POST['cmbFieldStatus'];
			 	$cmbRecordStatus = 1;
			 	$sl_no = '';		
				$this->db->select('sl_no');
				$this->db->from('registration_field_setup');
				$this->db->where('sl_no',$txtSlNo);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$sl_no = $row['sl_no'];
				}
		
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				if($sl_no =='')
				{
					$output = array();
					$new_data = array(
					'code' 							=>$cmbCode,
					'description' 					=>$txtDescription,
					'sl_no' 						=>$txtSlNo,
					'field_status' 					=>$cmbFieldStatus,
					'code_group' 					=>'REGISTRATION_PAGE',
					'record_status' 				=>$cmbRecordStatus,
					'created_by'					=>'SUPADM001',
					'created_on'					=>$date
					);
					$insert_user =  $this->db->insert('registration_field_setup', $new_data);
					if( ! $insert_user){
							$dbstatus = FALSE;
							$dbmessage = 'Error While Saving';
					}				
					
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = 'Sl No Already Exist';
				}				
				
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'update_field': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';            	
				$sl_no = '';
				$cmbcode='';
		
			 	$id = $_POST['hidUniqueidEdit'];
			 	$cmbCodeEdit = $_POST['cmbCodeEdit'];
			 	$txtDescriptionEdit = $_POST['txtDescriptionEdit'];
			 	$txtSlNoEdit = $_POST['txtSlNoEdit'];
			 	$cmbFieldStatusEdit = $_POST['cmbFieldStatusEdit'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'code' 						=>$cmbCodeEdit,
				'description' 				=>$txtDescriptionEdit,
				'sl_no' 					=>$txtSlNoEdit,
				'field_status' 				=>$cmbFieldStatusEdit,
				'code_group' 				=>'REGISTRATION_PAGE',
				'record_status' 			=>$cmbRecordStatus,
				'updated_by'				=>'SUPADM001',
				'updated_on'				=>$date
				);
				$this->db->where('id',$id );
				$this->db->update('registration_field_setup', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'delete_field':  	
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$ID = $_POST['ID'];
				$output = array();
				$new_data = array(
				'record_status'					=>0
				);
				$this->db->where('id', $religionID);
				$this->db->delete('registration_field_setup');
				
				if($this->db->affected_rows() ==0){
					$dbstatus = FALSE;
					$dbmessage = 'Error While Deleting';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			
			// Field
			case 'cmb_status_centre' :
			$this->db->select("code,description");
			$this->db->from('gen_code_description');
			$this->db->where('code_group', 'RECORD_STATUS');
			$result = $this->db->get();
			//echo $this->db->last_query();
			$output_data = $result->result_array();
			$output = array("aaData" => array());
			$slno = 1;
			foreach ($output_data as $aRow) 
            {
                $row[0] = $slno;
                $row['sl_no'] = $slno;
                $i = 1;
                foreach ($aRow as $key => $value) {

                    $row[$i] = $value;
                    $row[$key] = $value;
                    $i++;
                }
				$output['aaData'][] = $row;
                $slno++;
                unset($row);
            }
           	return $output;
			break;
			
			// Field
			case 'cmb_code' :
			$this->db->select("COLUMN_NAME");
			$this->db->from('INFORMATION_SCHEMA.COLUMNS ');
			$this->db->where('TABLE_SCHEMA', 'es_admission');
			$this->db->where('TABLE_NAME', 'applicant_reg_master');
			$result = $this->db->get();
			//echo $this->db->last_query();
			$output_data = $result->result_array();
			$output = array("aaData" => array());
			$slno = 1;
			foreach ($output_data as $aRow) 
            {
                $row[0] = $slno;
                $row['sl_no'] = $slno;
                $i = 1;
                foreach ($aRow as $key => $value) {

                    $row[$i] = $value;
                    $row[$key] = $value;
                    $i++;
                }
				$output['aaData'][] = $row;
                $slno++;
                unset($row);
            }
           	return $output;
			break;
			
			// Field
			case 'cmb_status' :
			$this->db->select("code,description");
			$this->db->from('gen_code_description');
			$this->db->where('code_group', 'FIELD_STATUS');
			$result = $this->db->get();
			//echo $this->db->last_query();
			$output_data = $result->result_array();
			$output = array("aaData" => array());
			$slno = 1;
			foreach ($output_data as $aRow) 
            {
                $row[0] = $slno;
                $row['sl_no'] = $slno;
                $i = 1;
                foreach ($aRow as $key => $value) {

                    $row[$i] = $value;
                    $row[$key] = $value;
                    $i++;
                }
				$output['aaData'][] = $row;
                $slno++;
                unset($row);
            }
           	return $output;
			break;
			
			//=========================XXXXXXXXXX====================Check Duplicate==========XXXXXXXXXXXX===========//
			//Country
			case 'check_country_code': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtCountryCode = $_POST['txtCountryCode'];
			 	
				$this->db->select('country_code');
				$this->db->from('country_master');
				$this->db->where('country_code',$txtCountryCode);
				$this->db->where('record_status',1);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['country_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'check_duplicate_country_edit': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtCountryCode = $_POST['txtCountryCode'];
			 	$this->db->select('country_code');
				$this->db->from('country_master');
				$this->db->where('country_code',$txtCountryCode);
				$this->db->where('record_status',1);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['country_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			//State
			case 'check_duplicate_state': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$this->db->select('state_code');
				$this->db->from('state_master');
				$this->db->where('state_code',$txtStateCode);
				$this->db->where('record_status',1);				
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['state_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'check_duplicate_state_edit': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtStateCodeEdit = $_POST['txtStateCodeEdit'];
			 	$this->db->select('state_code');
				$this->db->from('state_master');
				$this->db->where('state_code',$txtStateCodeEdit);
				$this->db->where('record_status',1);				
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['state_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			//District
			case 'check_duplicate_district': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtDistrictCode = $_POST['txtDistrictCode'];
			 	$this->db->select('district_code');
				$this->db->from('district_master');
				$this->db->where('district_code',$txtDistrictCode);
				$this->db->where('record_status',1);				
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['district_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'check_duplicate_district_edit': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtDistrictCodeEdit = $_POST['txtDistrictCodeEdit'];
			 	$this->db->select('district_code');
				$this->db->from('district_master');
				$this->db->where('district_code',$txtDistrictCodeEdit);
				$this->db->where('record_status',1);				
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['district_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			//Nationality
			case 'check_duplicate_nationality': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtNationalityCode = $_POST['txtNationalityCode'];
			 	$this->db->select('nationality_code');
				$this->db->from('nationality_master');
				$this->db->where('nationality_code',$txtNationalityCode);
				$this->db->where('record_status',1);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['nationality_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'check_duplicate_nationality_edit': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtNationalityCodeEdit = $_POST['txtNationalityCodeEdit'];
			 	$this->db->select('nationality_code');
				$this->db->from('nationality_master');
				$this->db->where('nationality_code',$txtNationalityCodeEdit);
				$this->db->where('record_status',1);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['nationality_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			//Board
			case 'check_duplicate_board': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtBoardCode = $_POST['txtBoardCode'];
			 	$this->db->select('board_code');
				$this->db->from('board_master');
				$this->db->where('board_code',$txtBoardCode);
				$this->db->where('record_status',1);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['board_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'check_duplicate_board_edit': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtBoardCodeEdit = $_POST['txtBoardCodeEdit'];
			 	$this->db->select('board_code');
				$this->db->from('board_master');
				$this->db->where('board_code',$txtBoardCodeEdit);
				$this->db->where('record_status',1);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['board_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			//Standard
			case 'check_duplicate_standard': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtStandardCode = $_POST['txtStandardCode'];
			 	$this->db->select('standard_code');
				$this->db->from('standard_master');
				$this->db->where('standard_code',$txtStandardCode);
				$this->db->where('record_status',1);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['standard_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'check_duplicate_standard_edit': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtStandardCode = $_POST['txtStandardCode'];
			 	$this->db->select('standard_code');
				$this->db->from('standard_master');
				$this->db->where('standard_code',$txtStandardCode);
				$this->db->where('record_status',1);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['standard_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			//Qualification
			case 'check_duplicate_qualification': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtQualificationCode = $_POST['txtQualificationCode'];
			 	$this->db->select('qualification_code');
				$this->db->from('qualification_master');
				$this->db->where('qualification_code',$txtQualificationCode);
				$this->db->where('record_status',1);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['qualification_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'check_duplicate_qualification_edit': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtQualificationCodeEdit = $_POST['txtQualificationCodeEdit'];
			 	$this->db->select('qualification_code');
				$this->db->from('qualification_master');
				$this->db->where('qualification_code',$txtQualificationCodeEdit);
				$this->db->where('record_status',1);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['qualification_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			//Exam Center
			case 'check_duplicate_center': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtCenterCode = $_POST['txtCenterCode'];
			 	$this->db->select('exam_centre_code');
				$this->db->from('exam_centre');
				$this->db->where('exam_centre_code',$txtCenterCode);
				$this->db->where('record_status',1);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['exam_centre_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			//Registration Field			
			case 'check_duplicate_code': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$cmbCode = $_POST['cmbCode'];
			 	
				$this->db->select('code');
				$this->db->from('registration_field_setup');
				$this->db->where('code',$cmbCode);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'check_duplicate_code_edit': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$cmbCodeEdit = $_POST['cmbCodeEdit'];
			 	
				$this->db->select('code');
				$this->db->from('registration_field_setup');
				$this->db->where('code',$cmbCodeEdit);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'check_duplicate_field': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
			 	$txtSlNo = $_POST['txtSlNo'];
			 	
				$this->db->select('sl_no');
				$this->db->from('registration_field_setup');
				$this->db->where('sl_no',$txtSlNo);
				$this->db->where('record_status',1);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['sl_no'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'check_duplicate_field_edit': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
            	$txtSlNoEdit = $_POST['txtSlNoEdit'];
			 	$cmbCodeEdit = $_POST['cmbCodeEdit'];
			
				$this->db->select('sl_no,code ');
				$this->db->from('registration_field_setup');
				$this->db->where('sl_no',$txtSlNoEdit);
				$this->db->where('code !=',$cmbCodeEdit, FALSE);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['sl_no'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			
			/*==========XXXXXXXXXXX========GENERIC SETUP2==========XXXXXXXXXXXXXXXXXX=============== */
			/*==========XXXXXXXXXXX========GENERIC SETUP3==========XXXXXXXXXXXXXXXXXX=============== */
			//Select File Name
			case 'select_file_name':
				$this->db->select("CONCAT(resource_name,' (',resource_code,')') AS resource,resource_code,resource_name", FALSE);
				$this->db->from('resource_master');
				$this->db->like('resource_code', 'registration_template/%');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			
			//Select File Name
			case 'select_file_template_name':
				$this->db->select("CONCAT(resource_name,' (',resource_code,')') AS resource, resource_code,resource_name", FALSE);
				$this->db->from('resource_master');
				$this->db->like('resource_code', 'form_template/%');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			
			//Select Registration Template
			case 'select_registration_template':
				$this->db->select("A.template_code,A.template_name,A.template_description,B.resource_name,B.resource_code,A.id", FALSE);
				$this->db->from('registration_template_master A');
				$this->db->join('resource_master B', 'A.file_name = B.resource_code', 'B.record_status = 1', 'LEFT');
				$this->db->where('A.record_status', 1);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			
			case 'insert_registration_template': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	$txtRegistrationTemplateCode = isset($_POST['txtRegistrationTemplateCode'])?strtoupper($_POST['txtRegistrationTemplateCode']):'';
			 	$txtRegistrationTemplateName = $_POST['txtRegistrationTemplateName'];
			 	$textRegistrationTemplateDescription = $_POST['textRegistrationTemplateDescription'];
			 	$txtRegistrationFileName = $_POST['txtRegistrationFileName'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'template_code' 				=>$txtRegistrationTemplateCode,
				'template_name' 				=>$txtRegistrationTemplateName,
				'template_description' 			=>$textRegistrationTemplateDescription,
				'file_name' 					=>$txtRegistrationFileName,
				'record_status' 				=>$cmbRecordStatus,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$insert_user =  $this->db->insert('registration_template_master', $new_data);
				$this->db->last_query();
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'update_registration_template': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';           	
            	
			 	$id = $_POST['hidUniqueidEditRegistration'];
			 	$txtRegistrationTemplateCodeEdit = isset($_POST['txtRegistrationTemplateCodeEdit'])?strtoupper($_POST['txtRegistrationTemplateCodeEdit']):'';
			 	$txtRegistrationTemplateNameEdit = $_POST['txtRegistrationTemplateNameEdit'];
			 	$textRegistrationTemplateDescriptionEdit = $_POST['textRegistrationTemplateDescriptionEdit'];
			 	$txtRegistrationFileNameEdit = $_POST['txtRegistrationFileNameEdit'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'template_code' 					=>$txtRegistrationTemplateCodeEdit,
				'qualificationtemplate_name_name'	=>$txtRegistrationTemplateNameEdit,
				'template_description' 				=>$textRegistrationTemplateDescriptionEdit,
				'file_name' 						=>$txtRegistrationFileNameEdit,
				'record_status' 					=>$cmbRecordStatus,
				'updated_by'						=>'SUPADM001',
				'updated_on'						=>$date
				);
				$this->db->where('template_code',$id );
				$this->db->update('registration_template_master', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'delete_registration_template':  	
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$templateID = $_POST['templateID'];
			 	$this->db->select('registration_template_code');
				$this->db->from('counselling_program_master');
				$this->db->where('registration_template_code',$templateID);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$template_code[] =  $row['registration_template_code'];
				}
				
				if(in_array($templateID,$template_code)){
					$dbStatus ='ERROR';
					echo $dbStatus;
				}
				else
				{
					$output = array();
					$new_data = array(
					'record_status'					=>0
					);
					$this->db->where('template_code', $templateID);
					$this->db->delete('registration_template_master');
					
					if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Deleting';
					}			
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			
			//Select Profile Template
			case 'select_template_master':
				$this->db->select("A.template_code,A.template_name,A.template_description,B.resource_name,	B.resource_code,A.id", FALSE);
				$this->db->from('form_template_master A');
				$this->db->join('resource_master B ', 'A.file_name = B.resource_code', 'B.record_status = 1', 'LEFT');
				$this->db->where('A.record_status', 1);
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			
			case 'insert_profile_template': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	$txtTemplateCode = isset($_POST['txtTemplateCode'])?strtoupper($_POST['txtTemplateCode']):'';
			 	$txtTemplateName = $_POST['txtTemplateName'];
			 	$textTemplateDescription = $_POST['textTemplateDescription'];
			 	$txtFileName = $_POST['txtFileName'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'template_code' 				=>$txtTemplateCode,
				'template_name' 				=>$txtTemplateName,
				'template_description' 			=>$textTemplateDescription,
				'file_name' 					=>$txtFileName,
				'record_status' 				=>$cmbRecordStatus,
				'created_by'					=>'SUPADM001',
				'created_on'					=>$date
				);
				$insert_user =  $this->db->insert('form_template_master', $new_data);
				if( ! $insert_user){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'update_profile_template': 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';            	
            	$id = $_POST['hidUniqueidEdit'];
			 	$txtTemplateCodeEdit = isset($_POST['txtTemplateCodeEdit'])?strtoupper($_POST['txtTemplateCodeEdit']):'';
			 	$txtTemplateNameEdit = $_POST['txtTemplateNameEdit'];
			 	$textTemplateDescriptionEdit = $_POST['textTemplateDescriptionEdit'];
			 	$txtFileNameEdit = $_POST['txtFileNameEdit'];
			 	$cmbRecordStatus = 1;
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$output = array();
				$new_data = array(
				'template_code' 				=>$txtTemplateCodeEdit,
				'template_name' 				=>$txtTemplateNameEdit,
				'template_description' 			=>$textTemplateDescriptionEdit,
				'file_name' 					=>$txtFileNameEdit,
				'record_status' 				=>$cmbRecordStatus,
				'updated_by'					=>'SUPADM001',
				'updated_on'					=>$date
				);
				$this->db->where('template_code',$id );
				$this->db->update('form_template_master', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Saving';
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'delete_profile_template':  	
				$dbstatus = TRUE;
            	$dbmessage = 'Data deleted successfully';
            	
			 	$templateID = $_POST['templateID'];
			 	$this->db->select('template_code');
				$this->db->from('counselling_program_master');
				$this->db->where('template_code',$templateID);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$template_code[] =  $row['template_code'];
				}
				
				if(in_array($templateID,$template_code)){
					$dbStatus ='ERROR';
					echo $dbStatus;
				}
				else
				{
					$output = array();
					$new_data = array(
						'record_status'					=>0
					);
					$this->db->where('template_code', $templateID);
					$this->db->delete('form_template_master');
					
					if($this->db->affected_rows() ==0){
						$dbstatus = FALSE;
						$dbmessage = 'Error While Deleting';
					}			
				}
				//echo $this->db->last_query();
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
				
				return $output; 
			break;
			//Check Duplicate
			case 'check_duplicate_template_code': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
            	$txtCode = $_POST['txtCode'];
			 	
				$this->db->select('template_code');
				$this->db->from('form_template_master');
				$this->db->where('template_code',$txtCode);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['template_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'check_duplicate_template_code_edit': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';
            	
            	$txtMenuCodeEdit = $_POST['txtMenuCodeEdit'];
			 	
				$this->db->select('template_code');
				$this->db->from('form_template_master');
				$this->db->where('template_code',$txtSlNoEdit);
				$this->db->where('code !=',$cmbCodeEdit, FALSE);
				$res = $this->db->get();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['template_code'];
				}
				if( $code != ''){
						$dbstatus = TRUE;
						$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'check_duplicate_registration_code': 
			 
				$dbstatus = TRUE;
            	$dbmessage = 'Data saved successfully';            	
            	$txtCode = $_POST['txtCode'];
			 	$code = '';
				$this->db->select('template_code');
				$this->db->from('registration_template_master');
				$this->db->where('template_code',$txtCode);
				$res = $this->db->get();
				//echo $this->db->last_query();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$code = $row['template_code'];
				}
				if( $code != ''){
					$dbstatus = TRUE;
					$dbmessage = '';
				}
				else
				{
					$dbstatus = FALSE;
					$dbmessage = '';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			
			case 'get_payment_gateway_master':
				$this->db->select("pg_code,pg_name,logo_url,remarks,payment_process_url,
									pg_action_url,pg_master_id,record_status,record_status AS status");
				$this->db->from('counselling_pg_master');
				$this->db->order_by('pg_master_id');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			case 'add_payment_gateway_master': 
				$dbstatus = "Inserted";
            	$dbmessage = 'Data Inserted successfully';
            	$institute_code = $this->session->userdata('institute_code');
            	
            	$pg_code = $_POST['txtPgMasterCode'];
				$pg_name = ucwords($_POST['txtPgMasterName']);
				$pg_status = $_POST['cmbPGCodeStatus'];
				$pg_remarks = $_POST['txtRemarks'];
				$pg_processurl = $_POST['txtPaymentProcessURL'];
				$pg_actionurl = $_POST['txtActionURL'];
				$filelogo = $_FILES['fileLogo']['name'];
				
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$this->db->select('COUNT(*) AS cnt');
				$this->db->from('counselling_pg_master');
				$this->db->where('pg_code',$pg_code);
				$res = $this->db->get();
				//echo $this->db->last_query();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$count = $row['cnt'];
				}
				if( $count > 0){
					$dbstatus = "Error";
					$dbmessage = 'Error while Saving';
				}
				else
				{
					if($filelogo != '')
					{
						$filename = $_FILES['fileLogo']['tmp_name'];
						$fileextension = explode(".",$filelogo);
						$strextension = $fileextension[sizeof($fileextension)-1]; 
						$newfile = $pg_code.".".$strextension;
						$newpath = BASE_ADM_URL."/images/logo/".$newfile;
						$uploadpathss = DOCUMENT_UPLOAD_URL."/images/logo/".$newfile;
						$uploadFile = move_uploaded_file($filename, $uploadpathss);
						if($uploadFile)
						{
							$new_data = array(
								'pg_code' 				=>$pg_code,
								'pg_name' 				=>$pg_name,
								'logo_url' 			=>$newpath,
								'remarks' 					=>$pg_remarks,
								'payment_process_url' 				=>$pg_processurl,
								'pg_action_url'					=>$pg_actionurl,
								'institute_code'					=>$institute_code,
								'created_by'					=>'SUPADM001',
								'created_on'					=>$date,
								'record_status'					=>$pg_status
								);
								$insert_user =  $this->db->insert('counselling_pg_master', $new_data);
								if( ! $insert_user){
										$dbstatus = "Error";
										$dbmessage = 'Error While Saving';
								}
						}
					}
				}
				
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'edit_payment_gateway_master': 
				$dbstatus = "Updated";
            	$dbmessage = 'Data saved successfully'; 
            	$institute_code = $this->session->userdata('institute_code');   
            	        	
            	$pg_master_id = $_POST['hidPgMasterId'];
				$pg_code = $_POST['txtPgMasterCode'];
				$pg_name = ucwords($_POST['txtPgMasterName']);
				$pg_status = $_POST['cmbPGCodeStatus'];
				$pg_remarks = $_POST['txtRemarks'];
				$pg_processurl =$_POST['txtPaymentProcessURL'];
				$pg_actionurl = $_POST['txtActionURL'];
				$filelogo = $_FILES['fileLogo']['name'];
			
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				if($filelogo != '')
				{
					$filename = $_FILES['fileLogo']['tmp_name'];
					$fileextension = explode(".",$filelogo);
					$strextension = $fileextension[sizeof($fileextension)-1]; 
					$newfile = $pg_code.".".$strextension;
					$newpath = BASE_ADM_URL."/images/logo/".$newfile;
					$uploaddir = DOCUMENT_UPLOAD_URL.'/images/logo/';
					if(!is_dir($uploaddir))
						mkdir($uploaddir,0777,true);
					$uploadpathss = $uploaddir.$newfile;
					$uploadFile = move_uploaded_file($filename, $uploadpathss);
					if($uploadFile)
					{
						$new_data = array(
							'pg_code' 				=>$pg_code,
							'pg_name' 				=>$pg_name,
							'logo_url' 				=>$newpath,
							'remarks' 				=>$pg_remarks,
							'payment_process_url' 	=>$pg_processurl,
							'pg_action_url'			=>$pg_actionurl,
							'updated_by'			=>'SUPADM001',
							'updated_on'			=>$date,
							'record_status'			=>$pg_status
						);
						$this->db->where('pg_master_id',$pg_master_id );
						$this->db->update('counselling_pg_master', $new_data);
						if($this->db->affected_rows() ==0){
								$dbstatus = "Failure";
								$dbmessage = 'Error While Saving';
						}
					}
					elseif($filelogo == '')
					{
						$new_data = array(
							'pg_code' 				=>$pg_code,
							'pg_name' 				=>$pg_name,
							'remarks' 				=>$pg_remarks,
							'payment_process_url' 	=>$pg_processurl,
							'pg_action_url'			=>$pg_actionurl,
							'updated_by'			=>'SUPADM001',
							'updated_on'			=>$date,
							'record_status'			=>$pg_status
						);
						$this->db->where('pg_master_id',$pg_master_id );
						$this->db->update('counselling_pg_master', $new_data);
						if($this->db->affected_rows() ==0){
								$dbstatus = "Failure";
								$dbmessage = 'Error While Saving';
						}
					}
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'get_pg_code_list' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
				$this->db->select("pg_code, pg_name");
				$this->db->from('counselling_pg_master');
				$this->db->where('record_status','1');
				$this->db->order_by("pg_name");
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			case 'get_pg_parameter' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$pg_code = $_POST['pg_code'];
				$this->db->select("pg_parameters_id, counselling_pg_master.pg_code AS pg_code , pg_name, pg_parameter_code, pg_parameter_name,
									counselling_pg_parameters.record_status,counselling_pg_parameters.record_status AS status");
				$this->db->from('counselling_pg_parameters');
				$this->db->join('counselling_pg_master','counselling_pg_parameters.pg_code = counselling_pg_master.pg_code','INNER');
				$this->db->where('counselling_pg_parameters.pg_code',$pg_code);
				$this->db->order_by("pg_parameters_id");
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			case 'add_pg_parameter': 
				$dbstatus = "Inserted";
            	$dbmessage = 'Data Inserted successfully';
            	$institute_code = $this->session->userdata('institute_code');
            	
            	$pg_code = $_POST['hidPgCode'];
				$parameter_name = $_POST['txtPgParameterName'];
				$parameter_code = $_POST['txtPgParameterCode'];
				$parameter_status = $_POST['cmbPGParameterStatus'];
				
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$this->db->select('COUNT(*) AS cnt');
				$this->db->from('counselling_pg_parameters');
				$this->db->where('pg_code',$pg_code);
				$this->db->where('pg_parameter_code',$parameter_code);
				$res = $this->db->get();
				//echo $this->db->last_query();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$count = $row['cnt'];
				}
				if( $count > 0){
					$dbstatus = "Exist";
					$dbmessage = 'Error while Saving';
				}
				else
				{
					$this->db->select('COUNT(*) AS cnt');
					$this->db->from('counselling_pg_parameters');
					$this->db->where('pg_code',$pg_code);
					$this->db->where('pg_parameter_name',$parameter_name);
					$res = $this->db->get();
					//echo $this->db->last_query();
					$query = $res->result_array();
					foreach($query as $row)
					{
						$count = $row['cnt'];
					}
					if( $count > 0){
						$dbstatus = "Error";
						$dbmessage = 'Error while Saving';
					}
					else
					{
						$new_data = array(
							'pg_parameter_code' 				=>$parameter_code,
							'pg_code' 							=>$pg_code,
							'pg_parameter_name' 				=>$parameter_name,
							'institute_code'					=>$institute_code,
							'created_by'						=>'SUPADM001',
							'created_on'						=>$date,
							'record_status'						=>$parameter_status
							);
						$insert_user =  $this->db->insert('counselling_pg_parameters', $new_data);
						if( ! $insert_user){
								$dbstatus = "Error";
								$dbmessage = 'Error While Saving';
						}
					}
				}
					
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'edit_pg_parameter': 
				$dbstatus = "Updated";
            	$dbmessage = 'Data saved successfully'; 
            	$institute_code = $this->session->userdata('institute_code');   
            	        	
            	$pg_code = $_POST['hidPgCode'];
				$hid_parameter_code = $_POST['hidPgParameterCode'];
				$hid_parameterid = $_POST['hidPgParameterId'];
				$hid_parameter_name = $_POST['hidPgParameterName'];
				$parameter_name = $_POST['txtPgParameterName'];
				$parameter_code = $_POST['txtPgParameterCode'];
				$parameter_status = $_POST['cmbPGParameterStatus'];
			
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				if($hid_parameter_code != $parameter_code)
				{
					$this->db->select('COUNT(*) AS cnt');
					$this->db->from('counselling_pg_parameters');
					$this->db->where('pg_parameter_code',$parameter_code);
					$res = $this->db->get();
					//echo $this->db->last_query();
					$query = $res->result_array();
					foreach($query as $row)
					{
						$count = $row['cnt'];
					}
					
					if($count > 0)
					{
						$dbstatus = "Exist";
						$dbmessage = 'Error while Saving';
					}
					else
					{
						$new_data = array(
							'pg_parameter_code' 	=>$parameter_code,
							'pg_code' 				=>$pg_code,
							'pg_parameter_name' 	=>$parameter_name,
							'updated_by'			=>'SUPADM001',
							'updated_on'			=>$date,
							'record_status'			=>$parameter_status
						);
						$this->db->where('pg_parameters_id',$hid_parameterid );
						$this->db->update('counselling_pg_parameters', $new_data);
						if($this->db->affected_rows() ==0){
								$dbstatus = "Error";
								$dbmessage = 'Error While Saving';
						}
					}
				}
				else
				{
					$new_data = array(
						'pg_parameter_code' 	=>$parameter_code,
						'pg_code' 				=>$pg_code,
						'pg_parameter_name' 	=>$parameter_name,
						'updated_by'			=>'SUPADM001',
						'updated_on'			=>$date,
						'record_status'			=>$parameter_status
					);
					$this->db->where('pg_parameters_id',$hid_parameterid );
					$this->db->update('counselling_pg_parameters', $new_data);
					if($this->db->affected_rows() ==0){
							$dbstatus = "Error";
							$dbmessage = 'Error While Saving';
					}
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			case 'select_institutes' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		//$pg_code = $_POST['pg_code'];
				$this->db->select("institute_code, institute_name");
				$this->db->from('institute_master');
				$this->db->where('record_status','1');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			case 'select_pgcodes' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		//$pg_code = $_POST['pg_code'];
				$this->db->select("pg_code, pg_name");
				$this->db->from('counselling_pg_master');
				$this->db->where('record_status','1');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			case 'get_pg_parameter_values' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		//$pg_code = $_POST['pg_code'];
        		$pg_code = isset($_POST['pg_code'])?$_POST['pg_code']:'';
				$school_code = $_POST['school_code'];
				
				$this->db->select("pg_parameter_values_id,counselling_pg_parameter_values.pg_code AS pg_code,counselling_pg_parameter_values.pg_parameter_code AS pg_parameter_code,
					counselling_pg_parameter_values.school_code AS school_code,
					institute_name,pg_name,pg_parameter_name ,pg_parameter_value,counselling_pg_parameter_values.record_status, 
					counselling_pg_parameter_values.record_status AS status");
				$this->db->from('counselling_pg_parameter_values');
				$this->db->join('institute_master','counselling_pg_parameter_values.school_code = institute_master.institute_code','INNER');
				$this->db->join('counselling_pg_master','counselling_pg_parameter_values.pg_code = counselling_pg_master.pg_code','INNER');
				$this->db->join('counselling_pg_parameters','counselling_pg_parameter_values.pg_parameter_code = counselling_pg_parameters.pg_parameter_code  AND counselling_pg_parameters.pg_code = counselling_pg_master.pg_code','INNER');
				$this->db->where('counselling_pg_parameter_values.school_code',$school_code);
				$this->db->where('counselling_pg_parameters.record_status','1');
				if($pg_code != '')
				{
					$this->db->where('counselling_pg_parameter_values.pg_code',$pg_code);
				}
				$this->db->order_by('pg_parameter_values_id');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			case 'select_pgparameter_codes' :
				$institute_code = $this->session->userdata('institute_code');
				date_default_timezone_set('Asia/Kolkata');
        		$date = date('Y-m-d', now());
        		
        		$pg_code = $_POST['pg_code'];
        		////$pg_code = isset($_POST['pg_code'])?$_POST['pg_code']:'';
				//$school_code = $_POST['school_code'];
				
				$this->db->select("pg_parameter_code, pg_parameter_name");
				$this->db->from('counselling_pg_parameters');
				$this->db->where('pg_code',$pg_code);
				$this->db->where('record_status','1');
				$result = $this->db->get();
				//echo $this->db->last_query();
				$output_data = $result->result_array();
				$output = array("aaData" => array());
				$slno = 1;
				foreach ($output_data as $aRow) 
	            {
	                $row[0] = $slno;
	                $row['sl_no'] = $slno;
	                $i = 1;
	                foreach ($aRow as $key => $value) {

	                    $row[$i] = $value;
	                    $row[$key] = $value;
	                    $i++;
	                }
					$output['aaData'][] = $row;
	                $slno++;
	                unset($row);
	            }
	           	return $output;
			break;
			case 'add_pg_parameter_values': 
				$institutes = implode("','",$_POST['schools']);
				$pg_code = $_POST['pg_code'];
				$parameter_code = $_POST['parameter_code'];
				$parameter_value_status = $_POST['parameter_value_status'];
				$parameter_value = $_POST['parameter_value']; 	
				$response = '';
				$dbmessage = '';
				$institute_details_arr = array();	
				$dbstatus = '';
            	$institute_code = $this->session->userdata('institute_code');
				
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$this->db->select('institute_code,institute_name');
				$this->db->from('institute_master');
				$this->db->where_in('institute_code',$_POST['schools']);
				$res = $this->db->get();
				//echo $this->db->last_query();
				$query = $res->result_array();
				foreach($query as $row)
				{
					$institute_details_arr[$row['institute_code']] = $row['institute_name'];
				}
				foreach($institute_details_arr as $key => $value)
				{
					$new_data = array(
						'school_code' 						=>$key,
						'pg_code' 							=>$pg_code,
						'pg_parameter_code' 				=>$parameter_code,
						'pg_parameter_value' 				=>$parameter_value,
						'institute_code'					=>$institute_code,
						'created_by'						=>'SUPADM001',
						'created_on'						=>$date,
						'record_status'						=>$parameter_value_status
						);
					$insert_user =  $this->db->insert('counselling_pg_parameter_values', $new_data);
					if( ! $insert_user){
						$dbstatus .= "Failed";
						$response .= "Failed!!! Duplicate entry of PG name & Parameter Name for school ".$value.". Try a new one.\r\n";
					}
					else
					{
						$dbstatus .= "Success";
						$response .="Record inserted successfully for Institute ".$value.".\r\n";
					}
				}
					
				$output = array('status'=>$dbstatus,'msg'=>$response);
			
				return $output; 
			break;
			case 'edit_pg_parameter_values': 
				$dbstatus = "Updated";
            	$dbmessage = 'Data saved successfully'; 
            	$institute_code = $this->session->userdata('institute_code');   
            	        	
            	$parameter_value_status = $_POST['parameter_value_status'];
				$parameter_value = $_POST['parameter_value']; 
				$hidPgParameterValueId =$_POST['hidPgParameterValueId'];
			
				$logged_user = $this->session->userdata('user_name');
			 	$op_type = 'add_program_group';
			 	date_default_timezone_set('Asia/Kolkata');
				$date = date('Y-m-d H:i:s', time());
				
				$new_data = array(
					'pg_parameter_value' 	=>$parameter_value,
					'updated_by'			=>'SUPADM001',
					'updated_on'			=>$date,
					'record_status'			=>$parameter_value_status
				);
				$this->db->where('pg_parameter_values_id',$hidPgParameterValueId );
				$this->db->update('counselling_pg_parameter_values', $new_data);
				if($this->db->affected_rows() ==0){
						$dbstatus = "Error";
						$dbmessage = 'Error While Saving';
				}
				$output = array('status'=>$dbstatus,'msg'=>$dbmessage);
			
				return $output; 
			break;
			/*==========XXXXXXXXXXX========GENERIC SETUP3==========XXXXXXXXXXXXXXXXXX=============== */
            default :
            	return array('status' => FALSE, 'msg' =>'Unable to load.Contact Support');
        }
    }
}

