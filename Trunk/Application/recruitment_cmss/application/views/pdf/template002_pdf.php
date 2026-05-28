<?php
// print_r($_REQUEST);die;
//echo $type ;die();
if($type == 'TOP')
{
	$now = date("d-m-Y h:i A");
	$today = date("d-m-Y");
	$today1 = date("Y-m-d");

	// echo "<pre>";
	// print_r($application_data);
	//echo "<pre>";
	//print_r($challandetails);die;
	//echo "<pre>";
	//print_r($appl_status);die;
	// echo "----------";
	// echo "<pre>";
	// print_r($applicant_detail);
	// echo "----------";
	// echo "<pre>";
	// print_r($fetchInst);
	// echo "----------";
	// echo "<pre>";
	// print_r($addressDetail);
	// echo "----------";
	// echo "<pre>";
	// print_r($addressDetail2);
	// echo "----------";
	// echo "<pre>";
	// print_r($applicant_documents);
	// // echo "----------";
	// // echo "<pre>";
	// // print_r($userPhoto);
	// // echo "<pre>";
	// // print_r($userSign);die();



	$declaration_new=$declaration_data[0]['declaration'];
	$applicantNumber=$application_data[0]['appl_no'];
	$programName=htmlspecialchars_decode($application_data[0]['program_name']);
    $programcode=$application_data[0]['applied_program'];
	$elective_subjects = $application_data[0]['elective_subjects'];
	$program_year = $application_data[0]['year'];
	//$index_number = $application_data[0]['index_no'];
	$index_number = $application_data[0]['appl_no'];
	
	$next_year = $program_year + 1;
	$next_year = substr($next_year, -2); 
	$session = $program_year.'-'.$next_year;
	$programName=htmlspecialchars_decode($application_data[0]['program_name']);
	
	
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============STUDENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
	$examCenters=$applicant_detail[0]['exam_centre_name'];
	$regd_user_id=$applicant_detail[0]['reg_user_id'];
	$firstName=$applicant_detail[0]['first_name'];
	$midName=$applicant_detail[0]['mid_name'];
	$lastName=$applicant_detail[0]['last_name'];
	$fullName=$applicant_detail[0]['full_name'];
	$userPhoto=$applicant_detail[0]['passportphoto'];
	$app_email =$applicant_detail[0]['applicant_email'];
	$sign=$applicant_detail[0]['SIGN'];
	
	$program_name=$applicant_detail[0]['program_name'];
	$program_code=$applicant_detail[0]['program_code'];
	$location = '';
	if($program_code == 'P687510_RECINS001' || $program_code == 'P726511_RECINS001' || $program_code == 'P720512_RECINS001' || $program_code == 'P940513_RECINS001' || $program_code == 'P106514_RECINS001' || $program_code == 'P529515_RECINS001')
	{
		$location = 'CRC,BALANGIR';
	}
	else
	{
		$location = 'CMSS,New Delhi';
	}
	
	$id_proof_number=$applicant_detail[0]['id_proof_number'];
	$mask_id = str_pad(substr($id_proof_number, -4), strlen($id_proof_number), 'X', STR_PAD_LEFT);
	$id_proof_name=$applicant_detail[0]['id_proof_name'];
	
	$selectedpost=$multiple_post[0]['course_name'];//echo $selectedpost;die();  
	$dcoffice=$applicant_detail[0]['dc_name'];//echo $dcoffice;die();
	//echo $master_name;
	$userSign = $sign;
	//$motherSign=$applicant_detail[0]['MSIGN'];
	$are_parents_alive=$applicant_detail[0]['are_parents_alive'];
	$guardianSign=$applicant_detail[0]['GSIGN'];
	$gender=$applicant_detail[0]['gender'];
	$reg_no = $applicant_detail[0]['univ_regn_no'];
	$reserved_quota = $applicant_detail[0]['is_reserved_quota'];
	$bloodgroup=$applicant_detail[0]['blood_group_name'];
	$mothertongue=$applicant_detail[0]['mother_tongue'];
	$transport=$applicant_detail[0]['mode_of_transport'];
	$is_kashmiri_migrant=$applicant_detail[0]['is_kashmiri_migrant'];
	$is_alumnus=$applicant_detail[0]['is_alumnus'];
	$alumnus=$applicant_detail[0]['alumnus_name'];
	$alumnus_year=$applicant_detail[0]['alumnus_year_of_passing'];
	$is_staff=$applicant_detail[0]['is_staff'];
	$staff=$applicant_detail[0]['staff_name'];
	$is_general=$applicant_detail[0]['is_general'];
	$qualifying_degree=$applicant_detail[0]['qualification_name'];
	$university_name=$applicant_detail[0]['last_school'];
	$other_university=$applicant_detail[0]['other_university'];
	$subject_offered1=$applicant_detail[0]['subject_offered1'];
	$subject_offered2=$applicant_detail[0]['subject_offered2'];
	$subject_offered3=$applicant_detail[0]['subject_offered3'];
	$subject_offered4=$applicant_detail[0]['subject_offered4'];
	$is_ews=$applicant_detail[0]['is_ews'];
	$is_exp=$applicant_detail[0]['is_exp'];
	$no_of_exp=$applicant_detail[0]['no_of_exp'];
	$total_experience=$total_experience[0]['total_experience_1'];
	if($is_exp == 'YES')
	{
		$is_exp = $is_exp."(".$no_of_exp." Years)";
	}
	$last_grade=$applicant_detail[0]['last_grade'];
	$caste=$applicant_detail[0]['caste_name'];
	$subject_name=$applicant_detail[0]['subject_name'];
	$nationality=$applicant_detail[0]['natinality'];
	$nationalityCode=$applicant_detail[0]['nationalitycode'];
	$adhar_no = $applicant_detail[0]['adhar_no'];
	$religion = $applicant_detail[0]['religion'];

	$physically_challenged = $applicant_detail[0]['physically_challenged'];
	$phtype = $applicant_detail[0]['phtype'];
	//$phtype = $applicant_detail[0]['description'];
	$applied_program = $applicant_detail[0]['applied_program'];
	$exam_center_code = $applicant_detail[0]['exam_center_code'];
	if($applicant_detail[0]['is_north_east'] == 'NO'){
		$north_east_state = $applicant_detail[0]['is_north_east'];
	}else{
		$north_east_state = $applicant_detail[0]['is_north_east'].','.$applicant_detail[0]['north_east_state'];
	}
	
	$exam_centre_detail = $applicant_detail[0]['exam_centre_detail'];
	$category = $applicant_detail[0]['category'];
	$guardian_name = $applicant_detail[0]['guardian_name'];
	$father_occupation = $applicant_detail[0]['father_occupation'];
	$annual_parent_income = $applicant_detail[0]['annual_parent_income'];
	
	$mothers_name = $applicant_detail[0]['mothers_name'];
	$mothers_profession = $applicant_detail[0]['mothers_profession'];
	$mothers_income = isset($applicant_detail[0]['mothers_income'])?$applicant_detail[0]['mothers_income']:0;
	$fathers_adhar_no = $applicant_detail[0]['fathers_adhar_no'];
	$mothers_adhar_no = $applicant_detail[0]['mothers_adhar_no'];

	$is_employed = $applicant_detail[0]['is_employed'];
	$empDisciplinary = $applicant_detail[0]['any_disciplinary_action'];
	/*die();*/
	$employer_add = $applicant_detail[0]['employer_add'];
	$employer_from = $applicant_detail[0]['employer_from']; 
	$employer_to = $applicant_detail[0]['employer_to'];
	$completion_date = $applicant_detail[0]['completion_date'];

	$center_name1 = $applicant_detail[0]['exam_centre_name'];
	$center_name2 = $applicant_detail[0]['exam_centre_name1'];
	$center_name3 = $applicant_detail[0]['exam_centre_name2'];
	$center_code1 = $applicant_detail[0]['exam_center_code'];
	$center_code2 = $applicant_detail[0]['exam_center_code1'];
	$center_code3 = $applicant_detail[0]['exam_center_code2'];
	$master_name = $applicant_detail[0]['master_name'];
	$last_year_mark = $applicant_detail[0]['last_year_mark'];

	//echo $center_name1 .'k'.$center_code1;
	$dob=$applicant_detail[0]['dob'];
	//print_r($program_data);die;
	$apply_last_date = $program_data[0]['apply_end_date'];
	$appl_end_date = strtotime($apply_last_date);
	$appl_format = date("d-m-Y",$appl_end_date);
	
	//$dob_one = strtotime($dob);
	$dobas1 = new DateTime($dob);
	$dobas2 = new DateTime($apply_last_date);
	$diffas3 = $dobas1->diff($dobas2);
	$ageas = $diffas3->format('%Y years,%m month,%d days');
	
	$split=explode("-",$dob);
	$year=$split[0];$month=$split[1];$date=$split[2];
	$dobinWord=$applicant_detail[0]['dob_in_word'];
	$category=$applicant_detail[0]['category_name'];
	$hostel_facility=$applicant_detail[0]['hostel_facility'];
	$is_physically_challanged=$applicant_detail[0]['is_physically_challanged'];
	$is_minority_community=$applicant_detail[0]['is_minority_community'];
	$minority_community_details=$applicant_detail[0]['minority_community'];
	$marital_status=$applicant_detail[0]['marital_status'];
	$single_girl_child_flag=$applicant_detail[0]['single_girl_child_flag'];
	$if_chronic_illness=$applicant_detail[0]['if_chronic_illness'];
	$chronic_illness=$applicant_detail[0]['chronic_illness'];
	$if_allergies=$applicant_detail[0]['if_allergies'];
	$allergies=$applicant_detail[0]['allergies'];
	$last_school=$applicant_detail[0]['last_school'];
	$last_board=$applicant_detail[0]['board_name'];
	$boardCode=$applicant_detail[0]['last_board'];
	$txtTotalMarks = $applicant_detail[0]['total_mark'];
	$txtSecuredMarks = $applicant_detail[0]['secured_mark'];
	$radioDistinction = $applicant_detail[0]['distinction'];
	$txtHonoursSubject = $applicant_detail[0]['honours_subject'];
	$other_subject = $applicant_detail[0]['other_subject'];
	$txtHonsTotalMarks = $applicant_detail[0]['honours_total_mark'];
	$txtHonsSecuredMarks = $applicant_detail[0]['honours_secured_mark'];
	$email_id = $applicant_detail[0]['email_id'];
	$name_of_office = isset($applicant_detail[0]['name_of_office'])?$applicant_detail[0]['name_of_office']:'';
	$govt_doj = isset($applicant_detail[0]['govt_doj'])?$applicant_detail[0]['govt_doj']:'';
	$name_of_post = isset($applicant_detail[0]['name_of_post'])?$applicant_detail[0]['name_of_post']:'';
	$date_of_debar = isset($applicant_detail[0]['date_of_debar'])?$applicant_detail[0]['date_of_debar']:'';
	$period_of_debar = isset($applicant_detail[0]['period_of_debar'])?$applicant_detail[0]['period_of_debar']:'';
	$is_ex_seviceman = $applicant_detail[0]['is_ex_serviceman'];
	$is_sports = $applicant_detail[0]['is_sports'];
	$is_computer = $applicant_detail[0]['is_computer_education'];
	$ap_resident = $applicant_detail[0]['ap_resident'];
	$othernationality = 'Non-Indian';
	if($university_name=='OTH')
	{
		$university_name = $other_university;
	}
	if($txtHonoursSubject=='OTH')
	{
		$subject_name = $other_subject;
	}
	if($nationalityCode=='OTH')
	{
		$actual_nationality = $othernationality;
	}
	else
	{
		$actual_nationality = $nationality;
	}
	
	if($master_name=="DPMT") 
	{
		$master_name="Diploma in Plastics Mould Technology";
	}

	if($master_name=="PGDPP") 
	{
		$master_name="Postgraduate Diploma in Plastics Processing & Testing";
	}
	if($master_name=="DPMD") 
	{
		$master_name="Post Diploma in Plastics Mould Design with CAD/CAM";
	}
	if($master_name=="DEPT") 
	{
		$master_name="Diploma in Plastics Technology";
	}
	if($master_name=="PGDPQ") 
	{
		$master_name="Postgraduate Diploma in Plastics Testing & Quality Control";
	}

	

	if($txtHonsTotalMarks == 0)
	{
		$txtHonsTotalMarks = '';
	}
	if($txtHonsSecuredMarks == '0.00')
	{
		$txtHonsSecuredMarks = '';
	}
	if($reserved_quota == 'No')
	{
		$actual_category = '';
	}
	else if($reserved_quota == 'Yes')
	{
		$actual_category = '( '.$category.' )';
	}
	
	
	
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============STUDENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============INSTITURE DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
		$txtHonsDivision = $applicant_detail[0]['honours_division'];
		$radioCourseType = $applicant_detail[0]['course_type'];
		$father_name=isset($applicant_father[0]['rel_name'])?$applicant_father[0]['rel_name']:'';
		$relNameM=isset($applicant_mother[0]['rel_name'])?$applicant_mother[0]['rel_name']:'';
		if($mothers_name == '')
		{
			$mothers_name = $relNameM;
		}
		$institute_name = isset($fetchInst[0]['institute_name'])?$fetchInst[0]['institute_name']:'';
		$department_name = isset($fetchInst[0]['department_name'])?$fetchInst[0]['department_name']:'';
		$institute_code = isset($fetchInst[0]['institute_code'])?$fetchInst[0]['institute_code']:'';
		$institute_location = isset($fetchInst[0]['location'])?$fetchInst[0]['location']:'';
		$institute_address = isset($fetchInst[0]['institute_address'])?$fetchInst[0]['institute_address']:'';
		$advt_no = isset($fetchInst[0]['advt_no'])?$fetchInst[0]['advt_no']:'';
		$advt_date = isset($fetchInst[0]['advt_date'])?$fetchInst[0]['advt_date']:'';
		$logo = isset($fetchInst[0]['logo_url'])?$fetchInst[0]['logo_url']:'';
		$program_name = isset($fetchInst[0]['program_name'])?$fetchInst[0]['program_name']:'';
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============INSTITURE DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PRESENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
		$presentaddr1=isset($addressDetail[0]['address_1'])?$addressDetail[0]['address_1']:'';
		$presentaddr2=isset($addressDetail[0]['address_2'])?$addressDetail[0]['address_2']:'';
		if($father_name == '')
		{
			$father_name=isset($applicant_detail[0]['father_name'])?$applicant_detail[0]['father_name']:'';
		
		}
		$cand_name=isset($addressDetail[0]['cand_name'])?$addressDetail[0]['cand_name']:'';
		$co_name=isset($addressDetail[0]['co_name'])?$addressDetail[0]['co_name']:'';
		$city_name=isset($addressDetail[0]['city_name'])?$addressDetail[0]['city_name']:'';

		$presentpostoffice=isset($addressDetail[0]['post_office'])?$addressDetail[0]['post_office']:'';
		$presentdistrictcode=isset($addressDetail[0]['district_name'])?$addressDetail[0]['district_name']:'';
		$presentstatecode=isset($addressDetail[0]['state_name'])?$addressDetail[0]['state_name']:'';
		$presentpin=isset($addressDetail[0]['pin'])?$addressDetail[0]['pin']:'';
		$presentdistance=isset($addressDetail[0]['distance_from'])?$addressDetail[0]['distance_from']:'';
		$chkpresentotherdistrict=isset($addressDetail[0]['district_code'])?$addressDetail[0]['district_code']:'';
		$chkpresentotherstate=isset($addressDetail[0]['state_code'])?$addressDetail[0]['state_code']:'';
		$presentation_details = isset($applicant_detail[0]['presentation_details'])?$applicant_detail[0]['presentation_details']:'';
		$any_other_info = isset($applicant_detail[0]['any_other_info'])?$applicant_detail[0]['any_other_info']:'';
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PRESENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PERMANENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
		$permanentaddr1=isset($addressDetail2[0]['address_1'])?$addressDetail2[0]['address_1']:'';
		$permanentaddr2=isset($addressDetail2[0]['address_2'])?$addressDetail2[0]['address_2']:'';

		$cand_name1=isset($addressDetail2[0]['cand_name'])?$addressDetail2[0]['cand_name']:'';
		$co_name1=isset($addressDetail2[0]['co_name'])?$addressDetail2[0]['co_name']:'';
		$city_name1=isset($addressDetail2[0]['city_name'])?$addressDetail2[0]['city_name']:'';


		$permanentpostoffice=isset($addressDetail2[0]['post_office'])?$addressDetail2[0]['post_office']:'';
		$permanentdistrictcode=isset($addressDetail2[0]['district_name'])?$addressDetail2[0]['district_name']:'';
		$permanentstatecode=isset($addressDetail2[0]['state_name'])?$addressDetail2[0]['state_name']:'';
		$permanentpin=isset($addressDetail2[0]['pin'])?$addressDetail2[0]['pin']:'';
		$permanentmobile=isset($addressDetail2[0]['mobile'])?$addressDetail2[0]['mobile']:'';
		$permanentdistance=isset($addressDetail2[0]['distance_from'])?$addressDetail2[0]['distance_from']:'';
		$chkpermanentotherdistrict=isset($addressDetail2[0]['district_code'])?$addressDetail2[0]['district_code']:'';
		$chkpermanentotherstate=isset($addressDetail2[0]['state_code'])?$addressDetail2[0]['state_code']:'';
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PERMANENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PAYMENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
		$paymentMode=isset($paymentDetail[0]['money_deposit_mode'])?$paymentDetail[0]['money_deposit_mode']:'';
		$amountPaid=isset($paymentDetail[0]['amount'])?$paymentDetail[0]['amount']:'';
		$depositDate=isset($paymentDetail[0]['depositdate'])?$paymentDetail[0]['depositdate']:'';
		$transactionNo=isset($paymentDetail[0]['money_receipt_no'])?$paymentDetail[0]['money_receipt_no']:'';
		$pg_charges=isset($paymentDetail[0]['pg_charges'])?$paymentDetail[0]['pg_charges']:'0';
		$amountPaid = $amountPaid + $pg_charges;
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PAYMENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============OTHER DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
		$otherpermanentstate = isset($otherDetail[0]['field_value'])?$otherDetail[0]['field_value']:'';
		$otherpermanentdistrict = isset($otherDistrict[0]['field_value'])?$otherDistrict[0]['field_value']:'';
		$otherpresentstate = isset($otherpresentstate[0]['field_value'])?$otherpresentstate[0]['field_value']:'';
		$otherpresentdistrict = isset($otherpresentdistrict[0]['field_value'])?$otherpresentdistrict[0]['field_value']:'';
		$othernationality = isset($othernationality[0]['field_value'])?$othernationality[0]['field_value']:'';
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============OTHER DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============Challan DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
		
		$ChallanReferenece_no = isset($challandetails[0]['challan_code'])?$challandetails[0]['challan_code']:'';
		$ChallanBank_name = isset($challandetails[0]['bank_name'])?$challandetails[0]['bank_name']:'';
	
		$appl_status = isset($appl_status[0]['appl_status'])?$appl_status[0]['appl_status']:'';
	
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============Challan DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
	
	$mSign = '';
   	$fSign = '';
   	$gSign = '';
   	$userimg = '';   	
   	$actual_category = '';
   	$reg_user_id = '';
   	$document_upload_url = '';
   	$reg_user_id = $this->session->userdata('reg_user_id');
   	//Logo
	if($userPhoto != '')
    {
      $arr = explode('/',$userPhoto);
      $photo = end($arr);
      $photo = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$programcode."/".$applicantNumber."/".$photo;
  
    }
	if($userSign != '')
    {
      $arr = explode('/',$userSign);
      $sign = end($arr);
      $sign = DOCUMENT_UPLOAD_URL."/DOCUMENTS/".$programcode."/".$applicantNumber."/".$sign;
    }
	
	
    $logo = base_url()."public/assets/images/logo/$logo";//BROWSE LOGO
    //if($userPhoto != '' && file_exists ($photo ))
      $userimg="$userPhoto";//BROWSE USER IMAGE
    //if($userSign != '' && file_exists ($sign ))
      $signature="$userSign";//BROWSE USER SIGNATURE
	//$date1 = $year.'-'.$month.'-'.$date;
	//$from = DATE('Y-m-d',strtotime($from));
	$date1 = new DateTime($dob);
	$date2 = new DateTime('2021-09-30');
	$diff = $date1->diff($date2);
	$age = $diff->format('%Y years,%m month,%d days');
	//$age = (date('Y') - date('Y',strtotime($dob)));
	//$date1 = new DateTime($date1);
	
	
	if (strpos($applicantNumber, '_') !== false) {
	    $arr_appl = explode('_',$applicantNumber);
	    $applicantNumber = $arr_appl[1];
	}
	$header_logo = base_url()."public/assets/images/CMSS Logo.png";

	echo '<table width="100%" style="border-collapse: collapse;font-family:Arial;">
			<tr>
				<td>
				</td>
				<td colspan="2" style="text-align: right;">
					<b>Application No : </b>'.$index_number.'
				</td>
				
			</tr>
			<tr>
				<td>
				</td>
				<td colspan="2" style="text-align: right;">
					<b>Mobile No : </b>'.$reg_user_id.'
				</td>
			</tr>
			
			<tr>
				<td colspan="3" style="text-align: left;">
					<img src="'.$header_logo.'"style="vertical-align: top; width:70%;float:left; ">
						
				</td>
			</tr>
			
			
			<tr>
				<td style="width:10%;text-align: left;vertical-align:middle;"></td>
				
			</tr>
		</table>
		<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px; ">
					<tr >
						<br />
						<td width="38%" style="text-align: center;line-height:2;font-size:17px;">
							<b><u>Advertisement No. : '.$advt_no.' dated : '.$advt_date.'  </u></b></td> 
					</tr>
				</table>
				
				<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px; ">
				<tr >
					<br />
					<td width="43%" style="padding-left:10px;line-height:2;font-size:17px;">
						<b>Post Applied For</b> </td> 
					 <td width="5%">:</td> <td style = "font-size:17px;"width="30%"><b>'.$program_name.'</b></td> <td "font-size:17px;float:right;"width="30%">'.$location.'</td>
				</tr>
		</table>
				
				<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px; ">
						<tr >
							<td colspan="3" > <span style="font-size:17px;border-bottom:1px solid black;">Applicant\'s Information : </span></td>
						</tr>
						<tr>
							<td width="50%" style="padding-left:10px;line-height:2;">
						1. Applicant Name </td> <td width="5%">:</td> <td width="45%">'.$firstName.' '.$midName.' '.$lastName.'</td> 
						<td rowspan = "8" style="width:15%;text-align: center;">
								<img style="vertical-align: top" src="'.$userimg.'" width="100"  height="100" />
							</td>
					</tr>
				 	<tr><td  colspan="3"></td></tr>
				 	
				 	
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						2. Father\'s/Husband\'s Name </td>
	                      <td>:</td> <td>'.$father_name.'</td>
	                     </tr>
	                     <tr><td colspan="3"></td></tr>
	                     
	                     <tr>
						 <td style="padding-left:10px;line-height:2;">
						3. Mother\'s Name </td>
	                      <td>:</td> <td>'.$mothers_name.'</td>
	                     </tr>
	                     <tr><td colspan="3"></td></tr>
	                     
	                     <tr>
						 <td style="padding-left:10px;line-height:2;">
						4. Date of Birth</td> <td>:</td> <td>'.$date.'-'.$month.'-'.$year.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						5. Age (as on '.$appl_format.')</td> <td>:</td> <td>'.$ageas.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						6. Gender</td> <td>:</td> <td>'.$gender.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						7. ID Proof Name </td> <td>: </td> <td>'.$id_proof_name.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						8. Id proof number </td> <td>: </td> <td>'.$mask_id.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						9. Religion </td> <td>: </td> <td>'.$religion.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						10. Category</td> <td>:</td> <td> '.$category.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>	';
						if($category == 'General')
						{
							echo'<tr>
						 <td style="padding-left:10px;line-height:2;">
						Do you belong to Economically Weaker Section?</td> <td>:</td> <td> '.$is_ews.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>';
						}
						
						echo'
						
						<tr>
						 <td style="padding-left:10px;line-height:2;" >
						11.  Nationality </td> <td>:</td> <td>'.$actual_nationality.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						12. Email Id</td> <td>:</td> <td>'.$email_id.'</td> 
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
	                     
	                     <tr>
	                      <td style="padding-left:10px;line-height:2;">
						13. Belongs To PwD </td> <td>:</td> <td>'.$physically_challenged.'&nbsp;&nbsp;'.$phtype.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
						

								
					</table>
					<br>
					<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
					  <tr>
					   <td width="50%">
					<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
						<tr>
							<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;"> Present Address : </span></td>
						</tr>
						
						 
						   <tr><td  colspan="3"></td></tr>
						    	 <tr><td  colspan="3"></td></tr>
							<tr> 
							 <tr><td  colspan="3"></td></tr>
						    	 <tr><td  colspan="3"></td></tr>
							<tr><tr><td  colspan="3"></td></tr>
						    	 <tr><td  colspan="3"></td></tr>
							<tr> 
							 <tr><td  colspan="3"></td></tr>
						    	 <tr><td  colspan="3"></td></tr>
							<tr>
							   
							    <td style="padding-left:10px;line-height:2;"> H/No/Locality/Street Name/Village </td> <td>:</td> <td>'.$presentaddr1.'</td>
							    </tr>
							     <tr><td  colspan="3"></td></tr>
							    <tr>
								  <td style="padding-left:10px;line-height:2;">Post</td><td>:</td><td>'.$presentpostoffice.'</td>
								 </tr>
								  <tr><td  colspan="3"></td></tr>
								 <tr>
                               <td style="padding-left:10px;line-height:2;">City</td> <td>:</td> <td>'.$city_name.'</td>
                               </tr>
                               
                                 <tr><td  colspan="3"></td></tr>
								<tr>
								 <td style="padding-left:10px;line-height:2;">  
								 District </td> <td>:</td> <td>'.$presentdistrictcode.'</td> 
								 </tr>
								 
								 <tr>
								 <td style="padding-left:10px;line-height:2;">State</td> <td>:</td> <td>'.$presentstatecode.'</td>
								 </tr>
								   <tr><td  colspan="3"></td></tr>
								 <tr>
								 <td style="padding-left:10px;line-height:2;">
								 PIN </td> <td>:</td> <td>'.$presentpin.' </td> 
								 </tr>
								  <tr><td  colspan="3"></td></tr>
								  
							
					</table>
					 </td>
					<td width="50%" valign="top">
				<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
						<tr>
							<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;"> Permanent Address : </span></td>
						</tr>
						 
							 <tr><td  colspan="3"></td></tr>
						    	 <tr><td  colspan="3"></td></tr>
							<tr> 
							 <tr><td  colspan="3"></td></tr>
						    	 <tr><td  colspan="3"></td></tr>
							<tr><tr><td  colspan="3"></td></tr>
						    	 <tr><td  colspan="3"></td></tr>
							<tr> 
							 <tr><td  colspan="3"></td></tr>
						    	 <tr><td  colspan="3"></td></tr>
							<tr>
							 <tr>
							    <td style="padding-left:10px;line-height:2;">H/No/Locality/Street Name/Village </td> <td>:</td><td>'.$permanentaddr1.'</td>
							  </tr>
							  <tr><td  colspan="3"></td></tr>
							   <tr>
								<td style="padding-left:10px;line-height:2;">Post </td> <td>:</td> <td>'.$permanentpostoffice.'</td>
                               </tr>
                               <tr><td  colspan="3"></td></tr>
                               <tr>
								 <td style="padding-left:10px;line-height:2;">City </td> <td>:</td> <td>'.$city_name1.'</td>
								</tr>
                             <tr><td  colspan="3"></td></tr>
							 <tr>
							  <td style="padding-left:10px;line-height:2;">
								District</td>
								<td>:</td>
								<td>'.$permanentdistrictcode.' </td>
								</tr>
								<tr><td  colspan="3"></td></tr>
								<tr>
								<td style="padding-left:10px;line-height:2;">State </td> <td>:</td><td>'.$permanentstatecode.'</td>
								</tr>
								<tr><td  colspan="3"></td></tr>
								<tr>
								 <td style="padding-left:10px;line-height:2;">
								PIN </td> <td>:</td><td>'.$permanentpin.'</td>
								</tr>
								
							
					</table>
					</td>
					</tr>
					</table>
					<br/>';
					
					echo '<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
					
					<tr>
						<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;">Educational Qualification</span> </td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
					<td colspan="5">
							<table width="100%" cellpadding="5" style="border-collapse: collapse;text-align:center;" border="1">
								<tr>
									<td style ="width:20%;">Name of Examination<br /> Passed</td>
									<td style ="width:20%;">Degree/<br />Master in </td>
									<td style ="width:20%;">Course</td>
									<td style ="width:10%;">Year of Passing/<br />Appearing</td>									 
									<td style ="width:10%;">Duration</td>									 
									<td style ="width:10%;">Board/<br />University</td>
									<td style ="width:10%;">CGPA/<br />% of Marks</td>
									<td style ="width:10%;">Division/<br /> Class</td>
								</tr>';
				//print_r($qualification_detail)	; die();			
				
				foreach($qualification_detail as $row)
				{
					if($row['qual_desc_2'] == null || $row['qual_desc_2'] == '' || $row['qual_desc_2'] == 'NULL')
					{
						$qual_2 = '-';
					}
					else
					{
						$qual_2 = $row['qual_desc_2'];
					}
					
					if($row['course'] == null || $row['course'] == '' || $row['course'] == 'NULL')
					{
						$course = '-';
					}
					else
					{
						$course = $row['course'];
					}
					
					if($row['other_stream'] == null || $row['other_stream'] == '' || $row['other_stream'] == 'NULL' )
					{
						$other_stream = $row['other_stream'];
					}
					else
					{
						$other_stream = ','.$row['other_stream'];
					}
					echo'<tr>
						<td style ="width:20%;">'.$row['qual_desc_1'].'</td>
						<td style ="width:20%;">'.$qual_2.''.$other_stream.'</td>
						<td style ="width:20%;">'.$course.'</td>
						<td style ="width:10%;">'.$row['year_of_passing'].'</td>	
						<td style ="width:20%;">'.$row['duration'].'</td>									 
						<td style ="width:10%;">'.$row['university_board'].'</td>
						<td style ="width:10%;">'.$row['percentage_mark'].'</td>
						<td style ="width:10%;">'.$row['division_distinction'].'</td>
					</tr>';
				}
				echo '</table>
						</td>
						<tr/>
					</table><br />';
					
				echo '<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					
					<tr>
						<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;">Other Qualification</span> </td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
					<td colspan="3">
							<table width="100%" cellpadding="5" style="border-collapse: collapse;text-align:center;" border="1">
								<tr>
									<td style="width:20%;">Examination Passed </td>
									<td style="width:30%;">Degree/<br />Master in </td>
									<td style="width:20%;">Year Of <br />Passing</td>
									<td style="width:15%;">Board/<br />University</td>
									<td style="width:15%;">CGPA/% <br />of Marks</td>
									<td style="width:10%;">Division<br />/Class</td>
								</tr>';
				//print_r($qualification_detail)	; die();			
				foreach($tech_qual_data_5 as $row)
				{
					echo'<tr>
						<td style ="width:20%;">'.$row['qual_desc_1'].'</td>
						<td style ="width:20%;">'.$row['stream'].'</td>
						<td style ="width:10%;">'.$row['year'].'</td>
						<td style ="width:20%;">'.$row['affiliation_from'].'</td>				 
						<td style ="width:10%;">'.$row['grade_cgpa'].'</td>
						<td style ="width:10%;">'.$row['division'].'</td>
					</tr>';
				}
				foreach($tech_qual_data_6 as $row)
				{
					echo'<tr>
						<td style ="width:20%;">'.$row['qual_desc_1'].'</td>
						<td style ="width:20%;">'.$row['stream'].'</td>
						<td style ="width:10%;">'.$row['year'].'</td>
						<td style ="width:20%;">'.$row['affiliation_from'].'</td>			 
						<td style ="width:10%;">'.$row['grade_cgpa'].'</td>
						<td style ="width:10%;">'.$row['division'].'</td>
					</tr>';
				}
				
				echo '</table>
						</td>
						<tr/>
					</table> <br/>';
				
					
			echo '<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;">Work Experience</span> </td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
			<td colspan="5">
					<table width="100%" cellpadding="5" style="border-collapse: collapse;text-align:center;" border="1">
						<tr>
							<td style="text-align:center;line-height:2;">Department/Institute/Office</td>
							<td style="text-align:center;line-height:2;">Post Held </td>
							<td style="text-align:center;line-height:2;">From Date </td>
							<td style="text-align:center;line-height:2;">To Date</td>
							<td style="text-align:center;line-height:2;">Experience(In Year/Month)</td>
							<td style="text-align:center;line-height:2;">Regular/Temporary/Permanent/Contract</td>
							<td style="text-align:center;line-height:2;">Scale Of Pay/Gross Salary Per Month</td>
							
						</tr>';
		//print_r($qualification_detail)	; die();			
		
		foreach($work_experience as $row)
		{
			$date_from = date('d-m-Y',strtotime($row['date_from']));
			$date_to = date('d-m-Y',strtotime($row['date_to']));
			echo'<tr>
				<td style ="line-height:2;">'.$row['organization'].'</td>
				<td style ="line-height:2;">'.$row['post_held'].'</td>
				<td style ="line-height:2;">'.$date_from.'</td>
				<td style ="line-height:2;">'.$date_to.'</td>
				<td style ="line-height:2;">'.$row['duration'].'</td>
				<td style ="line-height:2;">'.$row['nature_of_job'].'</td>
				<td style ="line-height:2;">'.$row['pay_band'].'</td>										 
				
			</tr>';
		}
		echo '</table>
				</td>
				<tr/>
			</table> <br/>';
			if(sizeof($postwise_experience) > 0)
			{
				echo '<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;">Experience</span> </td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
					<td colspan="5">
							<table width="100%" cellpadding="5" style="border-collapse: collapse;text-align:center;" border="1">
								<tr>
									<td style="text-align:center;line-height:2;">Sl No</td>
									<td style="text-align:center;line-height:2;">Name</td>
									<td style="text-align:center;line-height:2;">YES/NO</td>
								</tr>';
				//print_r($qualification_detail)	; die();			
				$inc = 1;
				foreach($postwise_experience as $row)
				{
					
					echo'<tr>
						<td style ="line-height:2;">'.$inc.'</td>
						<td style ="line-height:2;">'.$row['experience_name'].'</td>
						<td style ="line-height:2;">'.$row['is_experienced'].'</td>
					</tr>';
					$inc++;
				}
				echo '</table>
						</td>
						<tr/>
					</table> <br/>';
			}
			echo'<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
						<tr>
							<td><span style="font-size:12px;">Total Experience : &nbsp;'.$total_experience.'</span></td>
							<td> </td>
							<td></td>
						</tr>
						<tr>
							<td style="line-height:2;"><span style="font-size:12px;">Details of Scientific presentation in National/International Conference/Publications in any index journal : &nbsp;'.$presentation_details.'</span></td>
							<td> </td>
							<td></td>
						</tr>
						<tr>
							<td style="line-height:2;"><span style="font-size:12px;">Any other information : &nbsp;'.$any_other_info.'</span></td>
							<td> </td>
							<td></td>
						</tr>
						</table> 
					<br>'; 
				echo'<table width="100%" style="border-collapse: collapse; font-family:Arial;font-weight:bold;font-size:12px;">
						<tr>
							<td colspan="4"><span style="font-size:17px;border-bottom:1px solid black;">Payment Details :</span></td>
						</tr>
						 <tr><td colspan="4">&nbsp;</td></tr>
						<tr>
							<td width="50%" colspan="2">
								Reference No. &nbsp;&nbsp; : '.$ChallanReferenece_no.' 
							</td>
							<td width="50%" colspan="2">
								Bank Name &nbsp;&nbsp; : '.$ChallanBank_name.'  
							</td>							
						</tr>
						<tr><td colspan="4">&nbsp;</td></tr>
					</table>';
						if($appl_status != 'Verified')
						{
							echo '<tr><td colspan="4">Payment Status &nbsp;&nbsp; : &nbsp;&nbsp; Not Verified</td></tr>';
						}
						else
						{
							echo '<tr><td colspan="4">Payment Status &nbsp;&nbsp; : &nbsp;&nbsp; Verified</td></tr>';
						}
					
					echo '<h3 style="text-align:center;text-decoration:underline;">Declaration</h3></br>';
					if($declaration_new != '')
					{
						echo '<p style="text-align:justify;font-size:13px">'.$declaration_new.'<br/></p>';
					}
					else
					{
						echo '<p style="text-align:justify;font-size:13px">I  hereby declare that I have read the detail information/advertisement before submission of this application.I hereby certify that all statements made and information given by me in this application form are true, complete and correct to the best of my knowledge and belief. In the event of any information is being found false or incorrect before or after the interview or appointment, action can be taken against me by the board and my candidature/appointment shall automatically be cancelled/terminated.<br/></p>';
					}
					
					echo '<img style="vertical-align: top ;margin-left:550px;" src="'.$signature.'" height="60" width="150" /><div style="text-align: right;vertical-align:middle;"><b>Signature of the candidate</b></div></br>';
					if(sizeof($applicant_documents) >= 1)
					{
						echo '<h3 style="text-align:center;text-decoration:underline;">Documents Uploaded</h3></br>';
					}
					$i=1;
					foreach($applicant_documents as $row){
						
						echo $i.'.'.$row['document_type'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>';
						$i++;
					};
					echo '<br/>
						<p style="text-align: right;">Date of Printing: '.$now.' </p>										
						<br />';
		

}
?>				