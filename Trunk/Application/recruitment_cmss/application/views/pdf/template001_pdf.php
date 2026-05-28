<?php
	
	
//echo $type ;die();
if($type == 'TOP')
{
	$now = date("d-m-Y h:i A");
	$today = date("d-m-Y");
	$today1 = date("Y-m-d");
	//print_r($qualification_detail);die();

	$applicantNumber=$application_data[0]['appl_no'];
	$programName=htmlspecialchars_decode($application_data[0]['program_name']);
    $programcode=$application_data[0]['applied_program'];
	$elective_subjects = $application_data[0]['elective_subjects'];
	$program_year = $application_data[0]['year'];
	$index_number = $application_data[0]['index_no'];
	
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
	
	$id_proof_number=$applicant_detail[0]['id_proof_number'];
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
	$last_grade=$applicant_detail[0]['last_grade'];
	$caste=$applicant_detail[0]['caste_name'];
	$subject_name=$applicant_detail[0]['subject_name'];
	$nationality=$applicant_detail[0]['natinality'];
	$nationalityCode=$applicant_detail[0]['nationalitycode'];
	$adhar_no = $applicant_detail[0]['adhar_no'];

	$physically_challenged = $applicant_detail[0]['physically_challenged'];
	$disability_percent = $applicant_detail[0]['disability_percent'];
	$phtype = $applicant_detail[0]['phtype'];
	//die();
	$home_district = $applicant_detail[0]['district_code'];
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
	$is_computer = $applicant_detail[0]['is_computer_education'];
	$other_computer = $applicant_detail[0]['other_computer'];
	$computer_type = $applicant_detail[0]['is_computer_type'];
	if($is_computer == 'Other')
	{
		$is_computer = $other_computer;
	}
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
	
	if($physically_challenged == 'YES')
	{
		$physically_challenged = $physically_challenged.'( Type : '.$phtype.') (Percent :'.$disability_percent.')';
	}
	
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============STUDENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============INSTITURE DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
		$txtHonsDivision = $applicant_detail[0]['honours_division'];
		$radioCourseType = $applicant_detail[0]['course_type'];
		$father_name = $applicant_detail[0]['father_name'];
		//$father_name=isset($applicant_father[0]['rel_name'])?$applicant_father[0]['rel_name']:'';
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
		$logo = isset($fetchInst[0]['logo_url'])?$fetchInst[0]['logo_url']:'';
		$program_name = isset($fetchInst[0]['program_name'])?$fetchInst[0]['program_name']:'';
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============INSTITURE DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PRESENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
			$presentaddr1=isset($addressDetail[0]['address_1'])?$addressDetail[0]['address_1']:'';
				$presentaddr2=isset($addressDetail[0]['address_2'])?$addressDetail[0]['address_2']:'';

				$father_name=isset($applicant_detail[0]['father_name'])?$applicant_detail[0]['father_name']:'';
				$cand_name=isset($addressDetail[0]['cand_name'])?$addressDetail[0]['cand_name']:'';
				$co_name=isset($addressDetail[0]['co_name'])?$addressDetail[0]['co_name']:'';
				$city_name=isset($addressDetail[0]['city_name'])?$addressDetail[0]['city_name']:'';
				
				$presentpostoffice=isset($addressDetail[0]['post_office'])?$addressDetail[0]['post_office']:'';
				$presentpanchayat=isset($addressDetail[0]['panchayat'])?$addressDetail[0]['panchayat']:'';
				$presentblock=isset($addressDetail[0]['block'])?$addressDetail[0]['block']:'';
				$presentpostoffice=isset($addressDetail[0]['post_office'])?$addressDetail[0]['post_office']:'';
				$presentdistrictcode=isset($addressDetail[0]['district_name'])?$addressDetail[0]['district_name']:'';
				$presentstatecode=isset($addressDetail[0]['state_name'])?$addressDetail[0]['state_name']:'';
				$presentpin=isset($addressDetail[0]['pin'])?$addressDetail[0]['pin']:'';
				$presentdistance=isset($addressDetail[0]['distance_from'])?$addressDetail[0]['distance_from']:'';
				$chkpresentotherdistrict=isset($addressDetail[0]['district_code'])?$addressDetail[0]['district_code']:'';
				$chkpresentotherstate=isset($addressDetail[0]['state_code'])?$addressDetail[0]['state_code']:'';
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PRESENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PERMANENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
				$permanentaddr1=isset($addressDetail2[0]['address_1'])?$addressDetail2[0]['address_1']:'';
				$permanentaddr2=isset($addressDetail2[0]['address_2'])?$addressDetail2[0]['address_2']:'';

				$cand_name1=isset($addressDetail2[0]['cand_name'])?$addressDetail2[0]['cand_name']:'';
				$co_name1=isset($addressDetail2[0]['co_name'])?$addressDetail2[0]['co_name']:'';
				$city_name1=isset($addressDetail2[0]['city_name'])?$addressDetail2[0]['city_name']:'';


				$permanentpostoffice=isset($addressDetail2[0]['post_office'])?$addressDetail2[0]['post_office']:'';
				$permanentpanchayat=isset($addressDetail2[0]['panchayat'])?$addressDetail2[0]['panchayat']:'';
				$permanentblock=isset($addressDetail2[0]['block'])?$addressDetail2[0]['block']:'';
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
	$date2 = new DateTime('2018-12-01');
	$diff = $date1->diff($date2);
	$age = $diff->format('%Y years,%m month,%d days');
	//$age = (date('Y') - date('Y',strtotime($dob)));
	//$date1 = new DateTime($date1);
	
	
	if (strpos($applicantNumber, '_') !== false) {
	    $arr_appl = explode('_',$applicantNumber);
	    $applicantNumber = $arr_appl[1];
	}
	$header_logo = base_url()."public/assets/images/icon/Header for APSSB.png";
	/*<tr>
				<td colspan="3" style="text-align: left;padding-left:-30px;">
					<img style="vertical-align: top ;" src="'.$header_logo.'" />
				</td>
			</tr>*/
	echo '<table width="100%" style="border-collapse: collapse;font-family:Arial;">
			<tr>
				<td>
				</td>
				<td colspan="2" style="text-align: right;">
					<b>Application No : </b>'.$applicantNumber.'
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
				<td style="width:10%;text-align: left;vertical-align:middle;"></td>
				
			</tr>
		</table>
				<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px; ">
				<tr >
					<br />
					<td width="43%" style="padding-left:10px;line-height:2;font-size:17px;">
						<b>Post Applied For</b> </td> 
					 <td width="5%">:</td> <td style = "font-size:17px;"width="60%"><b>'.$selectedpost.'</b></td> 
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
					 	<tr>
					 	<td  colspan="3"></td></tr>
				 	
				 	
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						2. Father\'s/Husband\'s Name </td>
	                      <td>:</td> <td>'.$father_name.'</td>
	                     </tr>
	                     <tr><td colspan="3"></td></tr>
	                     
	                  
	                     
	                     <tr>
						 <td style="padding-left:10px;line-height:2;">
						3. Date of Birth</td> <td>:</td> <td>'.$date.'-'.$month.'-'.$year.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						4. Age (as on 01-12-2018)</td> <td>:</td> <td>'.$age.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						5. Gender</td> <td>:</td> <td>'.$gender.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						6. Marital Status</td> <td>:</td> <td>'.$marital_status.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						7. District Where Applicant is Residing</td> <td>:</td> <td>'.$home_district.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						8. Nationality</td> <td>:</td> <td>Indian</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
						
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						9. Category</td> <td>:</td> <td> '.$category.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
						
						<tr>
						 <td style="padding-left:10px;line-height:2;" >
						10.  Nationality </td> <td>:</td> <td>'.$actual_nationality.'</td>
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
						<tr>
						 <td style="padding-left:10px;line-height:2;">
						11. Email Id</td> <td>:</td> <td>'.$email_id.'</td> 
						</tr>
						<tr><td colspan="3"></td></tr>
						
						
	                     
	                     <tr>
	                      <td style="padding-left:10px;line-height:2;">
						12. Belongs To PwD </td> <td>:</td> <td>'.$physically_challenged.'</td>
						</tr>
						
						<tr><td colspan="3"></td></tr>
						
						
						<tr><td colspan="3"></td></tr>
						<tr> 
						 <td>

								
					</table>
					
			
					<br>
					<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
					  <tr>
					   <td width="50%">
					<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
				<tr>
					<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;">Present Address : </span></td>
				</tr>
				
				 
				   <tr><td  colspan="3"></td></tr>
				    	 <tr><td  colspan="3"></td></tr>
					<tr>
					   
					    <td style="padding-left:10px;line-height:2;"> Locality/Street Name</td> <td>:</td> <td>'.$presentaddr1.'</td>
					    </tr>
					     <tr><td  colspan="3"></td></tr>
					    <tr>
						  <td style="padding-left:10px;line-height:2;">Post Office</td><td>:</td><td>'.$presentpostoffice.'</td>
						 </tr>
						  <tr><td  colspan="3"></td></tr> 
						  <tr>
						  <td style="padding-left:10px;line-height:2;">Gram Panchayat</td><td>:</td><td>'.$presentpanchayat.'</td>
						 </tr>
						  <tr><td  colspan="3"></td></tr> 
						  <tr>
						  <td style="padding-left:10px;line-height:2;">Block</td><td>:</td><td>'.$presentblock.'</td>
						 </tr>
						  <tr><td  colspan="3"></td></tr>
						 <tr>
	                   <td style="padding-left:10px;line-height:2;">City/Town</td> <td>:</td> <td>'.$city_name.'</td>
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
					    <td style="padding-left:10px;line-height:2;">Locality/Street Name</td> <td>:</td><td>'.$permanentaddr1.'</td>
					  </tr>
					  <tr><td  colspan="3"></td></tr>
					   <tr>
						<td style="padding-left:10px;line-height:2;">Post Office </td> <td>:</td> <td>'.$permanentpostoffice.'</td>
	                   </tr>
	                   <tr><td  colspan="3"></td></tr> 
	                   <tr>
						<td style="padding-left:10px;line-height:2;">Gram Panchayat </td> <td>:</td> <td>'.$permanentpanchayat.'</td>
	                   </tr>
	                   <tr><td  colspan="3"></td></tr> 
	                   <tr>
						<td style="padding-left:10px;line-height:2;">Block </td> <td>:</td> <td>'.$permanentblock.'</td>
	                   </tr>
	                   <tr><td  colspan="3"></td></tr>
	                   <tr>
						 <td style="padding-left:10px;line-height:2;">City/Town</td> <td>:</td> <td>'.$city_name1.'</td>
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
				';
					
					echo '<br/><table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
				
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
									<td style="text-align:center;width:20%;line-height:2;">Name Of The<br /> Examination passed  </td>
									<td style="text-align:center;width:10%;line-height:2;">Degree/Master in </td>
									<td style="text-align:center;width:10%;line-height:2;">Year Of Passing </td>
									<td style="text-align:center;width:15%;line-height:2;">Board/University</td>
									<td style="text-align:center;width:15%;line-height:2;">Total Marks (Excluding 4th Optional Mark)</td>
									<td style="text-align:center;width:15%;line-height:2;">Marks Secured (Excluding 4th Optional Mark)</td>
									<td style="text-align:center;width:15%;line-height:2;">% of Marks</td>
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
					if($row['other_stream'] == null || $row['other_stream'] == '' || $row['other_stream'] == 'NULL' )
					{
						$other_stream = $row['other_stream'];
					}
					else
					{
						$other_stream = ','.$row['other_stream'];
					}
					echo'<tr>
							<td style ="width:20%;line-height:2;">'.$row['qual_desc_1'].'</td>
							<td style ="width:20%;line-height:2;">'.$qual_2.''.$other_stream.'</td>
							<td style ="width:10%;line-height:2;">'.$row['year_of_passing'].'</td>
							<td style ="width:20%;line-height:2;">'.$row['university_board'].'</td>										 
							<td style ="width:15%;line-height:2;">'.$row['full_mark'].'</td>
							<td style ="width:15%;line-height:2;">'.$row['mark_secured'].'</td>
							<td style ="width:10%;line-height:2;">'.$row['percentage_mark'].'</td>
						</tr>';
				}
				echo '</table>
						</td>
						<tr/>
					</table><br />';
					
				echo '<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
					<tr>
						
						<td width="50%"> Computer Education(O Level/Other)</td>
						
						<td>:</td>
						<td>'.$is_computer.'</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td width="50%"> Ability to Type Odia Language in Computer </td>
						
						<td>:</td>
						<td>'.$computer_type.' </td>
					</tr>
					
					</table>';	
				 
					echo '<h3 style="text-align:center;text-decoration:underline;">Declaration</h3></br>';
					echo 'I '.$firstName.' '.$midName.' '.$lastName.' S/D/O of '.$father_name.' do hereby declare that the information furnished above are true to the best of my knowledge and belief. I will be liable for false information and misrepresentation of facts foundif any susequently.<br/>';
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