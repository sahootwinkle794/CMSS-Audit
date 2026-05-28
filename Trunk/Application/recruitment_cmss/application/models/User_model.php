<?php
class User_model extends CI_model
{
	private $role;

	function __construct()
    {
        parent::__construct();

        if (ENVIRONMENT == 'production')
		{
		    $this->db->save_queries = FALSE;
		}
		date_default_timezone_set('Asia/Kolkata');
    }
	
	// make md5 hash
	private function getHash($string)
	{
		return md5($string);
	}


	/**
	*	Generate random password 
	*/
	public function rand_string( $length ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		return substr(str_shuffle($chars),0,$length);
	}
	
	/**
	*	Forgot password 
	*/
	public function forgot_password()
	{
		$email = $this->input->post('email');
		$this->db->select('tbl_users.id');
		$this->db->from('tbl_users');
		$this->db->join('tbl_students', 'tbl_users.id = tbl_students.fk_user_id', 'left');
		$this->db->where('tbl_students.email', $email);	// for student
		$query = $this->db->get();
		
		if($query->num_rows == 1)
		{
			$result = $query->result_array()[0];
			$randomPassword = self::rand_string(8);;
			$data = array(
				'password'=>md5($randomPassword),
			);		
			
			$this->db->where('id', $result['id']);
			if( $this->db->update('tbl_users', $data) )
				return array('status'=>1, 'msg'=>$randomPassword);
			else
				return array('status'=>0, 'msg'=>'Your request can not be processed. Try again later');
		}
		else
		{
			return array('status'=>0, 'msg'=>"Please enter correct email id.");
		}
	}
	
	
	/*
	*	authenticate a user with username & password
	*/
	public function login()
	{
		//print_r($_POST);die();
		/*$userRecord = $this->db->get_where('user_master', array(
			'user_name'=>$this->db->escape_str($this->input->post('txtUsername')),
			'password'=>$this->input->post('txtPassword'),
		));*/
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s', now());
		$sha_password = $this->input->post('shapassword');
		$key = $this->session->userdata('key');
		$arr_institute = explode('@',$this->db->escape_str($this->input->post('txtUsername')));
		if(sizeof($arr_institute) != 2)
		{
			return array('status'=>false, 'msg'=>'You have entered invalid username and password');
		}
		$user_name = $arr_institute[0];
		$institute_code = $arr_institute[1];
		$this->db->from('user_master A');
        $this->db->select(' A.user_code,A.user_name,A.password,A.role, A.institute_code,C.institute_name,A.image_file_name,B.role_code,B.role_name,A.employee_name,B.index_page_url,B.profile_page_url,A.record_status,A.attempt_history');						
        $this->db->join('role_master B', 'A.role = B.role_code', 'inner');
        $this->db->join('institute_master C', 'A.institute_code = C.institute_code', 'inner');
        $this->db->where('A.record_status',1);
        $this->db->where('B.record_status',1);
        $this->db->where('A.user_name',$user_name);
        $this->db->where("SHA2(CONCAT(enc_password,'#','$key'),512)",$sha_password);
        $this->db->where('A.institute_code',$institute_code);
		$userRecord = $this->db->get();
		//echo $this->db->last_query();
		//print_r($userRecord);
		//die();
		$userDataArr = $userRecord->result_array();
		if($userRecord->num_rows() == 1)
		{
			//ECHO 1;
			//DIE();
			$this->db->select('*');
			$this->db->from('login_detail');
			$this->db->where('record_status',1);
			$this->db->where('login_id',$userDataArr[0]['user_name']);
			$this->db->where('login_role',$userDataArr[0]['role_code']);
			$get_status=$this->db->get();
			$check_user = $get_status->num_rows();
			
			if($check_user!=0){
				$this->session->unset_userdata('key');
				$this->session->set_userdata('key',uniqid());
				foreach($get_status->result_array() AS $row){
					$created_on = $row['created_on'];
				}
				$date_a = new DateTime($created_on);
				$date_b = new DateTime($date);

				$interval = date_diff($date_a,$date_b);

				$diff_h = $interval->format('%h'); 
				$diff_y = $interval->format('%y'); 
				$diff_m = $interval->format('%m'); 
				$diff_d = $interval->format('%d'); 
				$diff_mi = $interval->format('%i'); 
				if($diff_y < 1 && $diff_m < 1 && $diff_d < 1 && $diff_h < 1 && $diff_mi < 30){
					return array('status' => FALSE, 'msg' => 'You have already logged in.Kindly Logout.','logout'=>'NO');
				}else{
					return array('status'=>false, 'msg'=>'Your session is out , kindly login again!','logoutoptAdmin'=>'YES');
				}
			}
			if($userDataArr[0]['record_status'] == 0)
			{
				$this->session->unset_userdata('key');
				$this->session->set_userdata('key',uniqid());
				return array('status'=>false, 'msg'=>'Your account has been blocked please contact administrator');
			}
			if($userDataArr[0]['attempt_history'] == 0)
			{
				session_regenerate_id();
				$this->session->unset_userdata('key');
				$this->session->set_userdata('key',uniqid());
				
				$this->session->set_userdata('user_code', $userDataArr[0]['user_code']);
				$this->session->set_userdata('user_name', $userDataArr[0]['user_name']);
				$this->session->set_userdata('user_name', $userDataArr[0]['user_name']);
				$this->session->set_userdata('user_display_name', $userDataArr[0]['employee_name']);
				//$this->session->set_userdata('last_login', $userDataArr[0]['last_login']);
				$this->session->set_userdata('role', $userDataArr[0]['role_code']);
				$this->session->set_userdata('role_name', $userDataArr[0]['role_name']);
				$this->session->set_userdata('institute_name', $userDataArr[0]['institute_name']);
				$this->session->set_userdata('institute_code', $userDataArr[0]['institute_code']);
				$this->session->set_userdata('attempt_history', $userDataArr[0]['attempt_history']);
				//$this->session->unset_userdata('key');
				//$this->session->set_userdata('key',uniqid());
				return array('status'=>true, 'msg'=>'Login success','index_page'=>'user/force_change_password');
			}
		}
		else
		{
			$this->session->unset_userdata('key');
			$this->session->set_userdata('key',uniqid());
			return array('status'=>false, 'msg'=>'Invalid username or password');
		}
		//echo '1';die();	aiims	
		$ip = $_SERVER['REMOTE_ADDR'];     
		if($ip){
		    if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
			{
		        $ip = $_SERVER['HTTP_CLIENT_IP'];
		    } 
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		    }
		//echo $ip;
		}
		$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		
		$output = array();
		$new_data = array(
			'user_code' 					=>$userDataArr[0]['user_name'],
			'user_role' 					=>$userDataArr[0]['role_code'],
			'user_ip' 						=>$ip,
			'url'							=>$url, 
			'action_type'					=>'LOGIN',
			'institute_code'				=>$userDataArr[0]['institute_code'] ,
			'created_by' 					=>$userDataArr[0]['user_name'],
			'created_on'					=>$date
		);
		$insert_user = $this->db->insert('user_activity_details', $new_data);
		if(!$insert_user)
		{
			$this->session->unset_userdata('key');
				$this->session->set_userdata('key',uniqid());
			return array('status'=>false, 'msg'=>'Unable to login sorry!');
		}
		$output = array();
		$login_log = array('login_id'=>$userDataArr[0]['user_name'],
							'login_role'=>$userDataArr[0]['role_code'],
							'ip_address'=>$this->input->ip_address(),
							'sess_id'=>session_id(),
							'institute_code'=>$userDataArr[0]['institute_code'],
							'log_status'=>'login',
							'created_by'=>$userDataArr[0]['user_code'],
							'created_on'=>$date,
						);
				//echo '1';die();	
		$insert_user = $this->db->insert('login_detail',$login_log);
		//echo $insert_user;die();
		if(!$insert_user)
		{	
			$this->session->unset_userdata('key');
				$this->session->set_userdata('key',uniqid());
			return array('status'=>false, 'msg'=>'Unable to login sorry!','logoutopt'=>'NO');
		}
		$page_url = $_SERVER["HTTP_REFERER"];
		$ip_address = $_SERVER['REMOTE_ADDR'];

		$new_array = array( 
		"page_url"  	=>$page_url,
		"log_status"  	=>"Admin",
		"log_message"  	=>"Admin Login Successfully",
		"ip_address"  	=>$ip_address,
		"user_id" 		=>$userDataArr[0]['user_name'],
		"log_datetime" 	=>$date
		);
		$sql = $this->db->insert('db_log',$new_array);
		if(!$sql){
		$dbstatus = "ERROR";
		$dbmessage = "Error Inserting";
		}
		//echo $userDataArr[0]['index_page_url'];
		session_regenerate_id();
		$this->session->unset_userdata('key');
		$this->session->set_userdata('key',uniqid());
		//$this->session->set_userdata('key','');
		$this->session->set_userdata('logged_in', 'yes');
		$this->session->set_userdata('user_code', $userDataArr[0]['user_code']);
		$this->session->set_userdata('user_name', $userDataArr[0]['user_name']);
		$this->session->set_userdata('user_name', $userDataArr[0]['user_name']);
		$this->session->set_userdata('user_display_name', $userDataArr[0]['employee_name']);
		//$this->session->set_userdata('last_login', $userDataArr[0]['last_login']);
		$this->session->set_userdata('role', $userDataArr[0]['role_code']);
		$this->session->set_userdata('role_name', $userDataArr[0]['role_name']);
		$this->session->set_userdata('institute_name', $userDataArr[0]['institute_name']);
		$this->session->set_userdata('institute_code', $userDataArr[0]['institute_code']);
		$this->session->set_userdata('index_page_url', $userDataArr[0]['index_page_url']);
		$this->session->set_userdata('profile_page_url', $userDataArr[0]['profile_page_url']);
		return array('status'=>true, 'msg'=>'Login success','index_page'=>$userDataArr[0]['index_page_url']);
	}
	
	
	public function logout()
	{
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s', now());
		//$user_code = $this->session->userdata('user_code');
		$user_code = $this->session->userdata('user_name');
		
		$user_name = $this->session->userdata('reg_user_id'); 
		$role = $this->session->userdata('role');
		if($user_code == '')
		{
			$user_code = $this->session->userdata('reg_user_id');
			$user_name = $this->session->userdata('reg_user_id');
			$role = 'APPLICANT';
		}
		$institute_code = $this->session->userdata('institute_code');
		$ip = $_SERVER['REMOTE_ADDR'];     
		if($ip){
		    if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
			{
		        $ip = $_SERVER['HTTP_CLIENT_IP'];
		    } 
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		    }
		//echo $ip;
		}
		$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		
		$output = array();
		$login_log = array('log_status'=>'logout',
						'updated_on'=>$date,
						'record_status'=>0,
						);
		$this->db->where('login_id',$user_code);
		$this->db->where('record_status',1);
		$output = $this->db->update('login_detail',$login_log);
		//echo $this->db->last_query();die;
		
		if(!$this->db->update('login_detail',$login_log))
		{
			return array('status'=>false, 'msg'=>'Unable to logout sorry!');
		}
		else{
			return array('status'=>true, 'msg'=>'Logged out Successfully');
		}
	}


	/**
	*	purpose : Change password for the user 
	*/
	
	public function change_password()
	{
		$user_name = $this->session->userdata('user_name');
		$key = $this->session->userdata('key');
		//echo $key;die;
		$institute_code = $this->session->userdata('institute_code');
		//$old_password = md5($this->input->post('shapasswordOld'));
		$txtoldPassword = $this->input->post('txtoldPassword');
		
		$old_password11 = $this->input->post('shapasswordOld');
		$new_password = $this->input->post('shapasswordNewOne');
		//echo $old_password11;die;
		$this->db->select("*");
		$this->db->from("user_master");
		$this->db->where('user_name', $user_name);
		$this->db->where('institute_code', $institute_code);
		//$this->db->where('password', $old_password);
		$this->db->where("SHA2(CONCAT(enc_password,'#','$key'),512)",$old_password11);
		$result = $this->db->get();
		$output_data = $result->num_rows();
		//echo $this->db->last_query();die;
		//echo $output_data;die;
		//echo $this->db->last_query();die;
		//echo $this->db->count_all_results('user_master');die;
		//echo $this->db->last_query();die;
		/*echo $user_name."fdsfsdf";
		echo $institute_code."fdsfsdf";
		echo $old_password11."fdsfsdf";
		echo $key."fdsfsdf";
		echo "fdsfsdf";
		echo $this->db->count_all_results('user_master');die();*/
		/*if($this->db->count_all_results('user_master') != 1)
		{
			return array('status'=>0, 'msg'=>'Invalid current password.');
		}
		*/if($output_data != 1)
		{
			return array('status'=>0, 'msg'=>'Invalid current password.');
		}
		else{
			
		
		$check_data = $this->db->get_where('password_history', array('password'=>$new_password,'user_name'=>$user_name,'institute_code'=> $institute_code));
		if($check_data->num_rows()==0){
			$new_pass =  $this->getHash($this->input->post('new_password'));
			$this->db->where('user_name', $user_name);
			$this->db->where('institute_code', $institute_code);
			$this->db->update('user_master', array('enc_password'=>$new_password,'attempt_history'=>1));
			
			switch($this->db->affected_rows())
			{
				case 1:
					$this->db->insert('password_history', array('password'=>$new_password,'user_name'=>$user_name,'institute_code'=> $institute_code,'created_by'=>$user_name));
					return array('status'=>true, 'msg'=>'Password changed successfully');
				break;
				default:
					return array('status'=>false, 'msg'=>'Sorry! Password could not be changed.');
			}
		}else{
			return array('status'=>false, 'msg'=>'Entered password is already used previously.Please try a new password');
		}
		
		
		}
	}

	
	public function users($data, $op)
	{
		switch ($op) 
		{
			case 'ADD_USER':
				$new_data = array(
					'id'		=> NULL,
					'username'	=> $data['username'],
					'password'	=> md5('test'),
					'name'		=> ucwords($data['full_name']),
					'email'		=> strtolower($data['email']),
					'address'	=> addslashes($data['address']),
					'phone'		=> $data['phone'],
					'role'		=> $data['role'],
					'hash'		=> '',
					'created_on'=> strtotime(date('Y-m-d H:i:s')),
					'last_login'=> NULL,
					'user_ip'	=> $this->input->ip_address(),
					'status'	=> 1,
					'created_by'=> $this->username,
				);
				if($this->db->insert('tbl_users', $new_data))
					return array('status'=>true, 'msg'=>OP_SUCCESS);
				else
					return array('status'=>false, 'msg'=>ERR_101);
			break;			

			case 'UPDATE_USER':
				$new_data = array(
					'name'		=> ucwords($data['full_name']),
					'email'		=> strtolower($data['email']),
					'address'	=> addslashes($data['address']),
					'phone'		=> $data['phone'],
					'role'		=> $data['role'],
					'user_ip'	=> $this->input->ip_address(),
					'status'	=> $data['status']
				);
				$this->db->where('id', $data['user_id']);
				$this->db->update('tbl_users', $new_data);
				switch($this->db->affected_rows())
				{
					case 0: case 1:
						return array('status'=>true, 'msg'=>OP_SUCCESS);
					break;
					default:
						return array('status'=>false, 'msg'=>ERR_101);
				}
			break;

			case 'BLOCK_USER':				
				$this->db->where('id', $data);
				$this->db->update('tbl_users', array('status'=>0));
				switch($this->db->affected_rows())
				{
					case 1:
						return array('status'=>true, 'msg'=>OP_SUCCESS);
					break;
					default:
						return array('status'=>false, 'msg'=>ERR_101);
				}
			break;
			case 'UNBLOCK_USER':
				$this->db->where('id', $data);
				$this->db->update('tbl_users', array('status'=>1));
				switch($this->db->affected_rows())
				{
					case 1:
						return array('status'=>true, 'msg'=>OP_SUCCESS);
					break;
					default:
						return array('status'=>false, 'msg'=>ERR_101);
				}
			break;
			case 'RESET_PASSWORD':
				$this->db->where('id', $data);
				$this->db->update('tbl_users', array('password'=>md5("hotel")));
				switch($this->db->affected_rows())
				{
					case 1:
						return array('status'=>true, 'msg'=>OP_SUCCESS);
					break;
					default:
						return array('status'=>false, 'msg'=>ERR_101);
				}
			break;
			default:
				return array('status'=>false, 'msg'=>NO_OPERATION);
		}
	}
	
	public function ticket($data, $op)
	{
		switch($op)
		{
			case 'NEW':
				$ticket_data = array(
					'ticket_type'	=>$data['issue_type'],
					'ticket_description'=>$data['description'],
					'file'	=>!empty($data['attachment']) ? $data['attachment'] : '',
					'timestamp'	=>time(),
					'status'	=>'OPEN',
					'raised_by' =>$this->session->userdata('role')
				);

			if($this->db->insert('tbl_tickets', $ticket_data))
				return array('status'=>true, 'msg'=>OP_SUCCESS);
			else
				return array('status'=>false, 'msg'=>OP_FAILED);
			break;
		}
	}	

	

	
	
}