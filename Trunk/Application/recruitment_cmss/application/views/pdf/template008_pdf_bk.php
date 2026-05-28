<?php
if($type == 'TOP')
{
	$now = date("d-m-Y h:i A");
	$today = date("d-m-Y");
	
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
	$firstName=$applicant_detail[0]['first_name'];
	$midName=$applicant_detail[0]['mid_name'];
	$lastName=$applicant_detail[0]['last_name'];
	$fullName=$applicant_detail[0]['full_name'];
	$userPhoto=$applicant_detail[0]['passportphoto'];
	$app_email =$applicant_detail[0]['applicant_email'];
	$sign=$applicant_detail[0]['SIGN'];
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
		$relName=isset($applicant_father[0]['rel_name'])?$applicant_father[0]['rel_name']:'';
		$relNameM=isset($applicant_mother[0]['rel_name'])?$applicant_mother[0]['rel_name']:'';
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
		$permanentpostoffice=isset($addressDetail2[0]['post_office'])?$addressDetail2[0]['post_office']:'';
		$permanentdistrictcode=isset($addressDetail2[0]['district_name'])?$addressDetail2[0]['district_name']:'';
		$permanentstatecode=isset($addressDetail2[0]['state_name'])?$addressDetail2[0]['state_name']:'';
		$permanentpin=isset($addressDetail2[0]['pin'])?$addressDetail2[0]['pin']:'';
		$permanentmobile=isset($addressDetail2[0]['mobile'])?$addressDetail2[0]['mobile']:'';
		$permanentdistance=isset($addressDetail[0]['distance_from'])?$addressDetail[0]['distance_from']:'';
		$chkpermanentotherdistrict=isset($addressDetail[0]['district_code'])?$addressDetail[0]['district_code']:'';
		$chkpermanentotherstate=isset($addressDetail[0]['state_code'])?$addressDetail[0]['state_code']:'';
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PERMANENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PAYMENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
		$paymentMode=isset($paymentDetail[0]['money_deposit_mode'])?$paymentDetail[0]['money_deposit_mode']:'';
		$amountPaid=isset($paymentDetail[0]['amount'])?$paymentDetail[0]['amount']:'';
		$depositDate=isset($paymentDetail[0]['depositdate'])?$paymentDetail[0]['depositdate']:'';
		$transactionNo=isset($paymentDetail[0]['money_receipt_no'])?$paymentDetail[0]['money_receipt_no']:'';
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
      $photo = DOCUMENT_UPLOAD_URL."/".$programcode."/".$applicantNumber."/".$photo;
    }
	if($userSign != '')
    {
      $arr = explode('/',$userSign);
      $sign = end($arr);
      $sign = DOCUMENT_UPLOAD_URL."/".$programcode."/".$applicantNumber."/".$sign;
    }
	

    $logo = base_url()."public/assets/images/logo/$logo";//BROWSE LOGO
    if($userPhoto != '' && file_exists ($photo ))
      $userimg="$userPhoto";//BROWSE USER IMAGE
    if($userSign != '' && file_exists ($sign ))
      $signature="$userSign";//BROWSE USER SIGNATURE
	$date1 = $year.'-'.$month.'-'.$date;
	$date1 = new DateTime($date1);

	
	echo '<table style="margin-top:30%;margin-left:30%">
		<thead>
			<tr>
				<td  style="text-align:center;font-size:10px;">Downloaded on : '.$now.'</td>
			</tr>
		</thead>
	</table>
	    
	<table width="100%" style="border-collapse: collapse;font-family:Arial;">
					<tr>
						<td>
						</td>
						<td colspan="2" style="text-align: right;">
							Application No : '.$applicantNumber.'
						</td>
					</tr>
					<tr>
						<td colspan="3" style="text-align: center;padding-left:-30px;">
							<h2><u>'.strtoupper($institute_name).'</u></h2>
						</td>
					</tr>
					<tr>
						<td style="width: 10%;text-align: right;vertical-align:middle;"><img style="vertical-align: top" src="'.$logo.'" width="117" /></td>
						<td style="width: 80%;text-align: center;padding-left:-30px;">
							<h3>APPLICATION FORM FOR ADMISSION INTO</h3><br/>
							<h3>'.$programName.'</h3><br/>
							<h3>ACADEMIC SESSION '.$session.'</h3>
						</td>
						<td style="width: 10%;text-align: right;vertical-align:middle;"><img style="vertical-align: top" src="'.$userimg.'" height="150" width="117" /></td>
					
					</tr>
				</table>
				
				<table width="100%" border="1" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
						<tr>
							<td>Applicant\'s Information :</td>
						</tr>
						<tr>
							<td>
								1. Applicant Name (As in HSC Certificate)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;'.$firstName.' '.$midName.' '.$lastName.'<br/><br/>
								2. (a) Gender&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;'.$gender.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(b)&nbsp;&nbsp;&nbsp; Nationality&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;'.$actual_nationality.'<br/><br/>
								3. Are you a Kashmiri Migrant?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;'.$is_kashmiri_migrant.'<br/><br/>
								4. Date of Birth (In Figure)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;'.$date.'-'.$month.'-'.$year.'<br/><br/>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(In words)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;'.$dobinWord.'<br/><br/>
								5. Aadhaar Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;'.$adhar_no.'<br/><br/>
								6. Mobile No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;'.$reg_user_id.'<br/><br/>
								7. Email Id&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;'.$email_id.'<br/><br/>
								8. Marital Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;'.$marital_status.'<br/><br/>
								9. Father\'s/Guardian\'s Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;'.$relName.'<br/><br/>
								10. Mother\'s Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;'.$relNameM.'<br/><br/>
							</td>
						</tr>
					</table><br>
					<table width="100%" border="1" style="border-collapse: collapse; font-family:Arial;font-weight:bold;font-size:12px;">
						<tr>
							<td>11.(a) Permanent Address :</td>
						</tr>
						<tr>
							<td>
								 Plot/House No/At/Apartment No.&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;'.$permanentaddr1.'<br/><br/>
							     Locality/Street Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;'.$permanentaddr2.'<br/><br/>
								 Post&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;'.$permanentpostoffice.'<br/><br/>
								 District&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;'.$permanentdistrictcode.'<br/><br/>
								 State&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;'.$permanentstatecode.'<br/><br/>
								 PIN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;'.$permanentpin.'<br/><br/>
								 Parent’s /Guardian’s Telephone / Mob. No : &nbsp;&nbsp;&nbsp;&nbsp;'.$permanentmobile.'<br/>
							</td>
						</tr>
					</table>
					<br/>
					<table width="100%" border="1" style="border-collapse: collapse; font-family:Arial;font-weight:bold;font-size:12px;">
						<tr>
							<td>(b) Residential Address :</td>
						</tr>
						<tr>
							<td>
								Plot/House No/At/Apartment No.&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;'.$presentaddr1.'<br/><br/>
							    Locality/Street Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;'.$presentaddr2.'<br/><br/>
								Post&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;'.$presentpostoffice.'<br/><br/>
								District&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;'.$presentdistrictcode.'<br/><br/>
								State&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;'.$presentstatecode.'<br/><br/>
								PIN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;'.$presentpin.'<br/><br/>
							</td>
						</tr>
					</table>
					<br/>
					<table width="100%" border="1" style="border-collapse: collapse; font-family:Arial;font-weight:bold;font-size:12px;">
						<tr>
							<td>
								12. Berhampur University Reg No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;'.$reg_no.'<br/><br/>
								13. Admission is Claimed Under Any Reserve Quota &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;'.$reserved_quota.' '.$actual_category.'<br/>
							</td>
						</tr>
					</table>
					<br/>';
		

}
if($type == 'BOTTOM')
{	
	$now = date("d-m-Y h:i A");
	$today = date("d-m-Y");
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
	$firstName=$applicant_detail[0]['first_name'];
	$midName=$applicant_detail[0]['mid_name'];
	$lastName=$applicant_detail[0]['last_name'];
	$fullName=$applicant_detail[0]['full_name'];
	$userPhoto=$applicant_detail[0]['passportphoto'];
	$app_email =$applicant_detail[0]['applicant_email'];
	$sign=$applicant_detail[0]['SIGN'];
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
		$relName=$applicant_father[0]['rel_name'];
		$relNameM=isset($applicant_mother[0]['rel_name'])?$applicant_mother[0]['rel_name']:'';
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
		$permanentpostoffice=isset($addressDetail2[0]['post_office'])?$addressDetail2[0]['post_office']:'';
		$permanentdistrictcode=isset($addressDetail2[0]['district_name'])?$addressDetail2[0]['district_name']:'';
		$permanentstatecode=isset($addressDetail2[0]['state_name'])?$addressDetail2[0]['state_name']:'';
		$permanentpin=isset($addressDetail2[0]['pin'])?$addressDetail2[0]['pin']:'';
		$permanentmobile=isset($addressDetail2[0]['mobile'])?$addressDetail2[0]['mobile']:'';
		$permanentdistance=isset($addressDetail[0]['distance_from'])?$addressDetail[0]['distance_from']:'';
		$chkpermanentotherdistrict=isset($addressDetail[0]['district_code'])?$addressDetail[0]['district_code']:'';
		$chkpermanentotherstate=isset($addressDetail[0]['state_code'])?$addressDetail[0]['state_code']:'';
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PERMANENT ADDRESS DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============PAYMENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
		$paymentMode=isset($paymentDetail[0]['money_deposit_mode'])?$paymentDetail[0]['money_deposit_mode']:'';
		$amountPaid=isset($paymentDetail[0]['amount'])?$paymentDetail[0]['amount']:'';
		$depositDate=isset($paymentDetail[0]['depositdate'])?$paymentDetail[0]['depositdate']:'';
		$transactionNo=isset($paymentDetail[0]['money_receipt_no'])?$paymentDetail[0]['money_receipt_no']:'';
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
      $photo = DOCUMENT_UPLOAD_URL."/".$programcode."/".$applicantNumber."/".$photo;
    }
	if($userSign != '')
    {
      $arr = explode('/',$userSign);
      $sign = end($arr);
      $sign = DOCUMENT_UPLOAD_URL."/".$programcode."/".$applicantNumber."/".$sign;
    }
	

    $logo = base_url()."public/assets/images/logo/$logo";//BROWSE LOGO
    if($userPhoto != '' && file_exists ($photo ))
      $userimg="$userPhoto";//BROWSE USER IMAGE
    if($userSign != '' && file_exists ($sign ))
      $signature="$userSign";//BROWSE USER SIGNATURE
	$date1 = $year.'-'.$month.'-'.$date;
	$date1 = new DateTime($date1);
			echo '<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
					<tr>
						<td colspan="3">14. Qualifying Degree: </td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">
							<table width="100%" cellpadding="5" border = "1" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
								<tr>
									<td colspan = "2">
										Honours / Pass &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$radioCourseType.'
									</td>
								</tr>
								<tr>
									<td>
										Status &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$last_grade.'
									</td>
									
									<td>
										Honours Subject &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$subject_name.'
									</td>
									
								</tr>
								<tr>
									<td>
										University &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$university_name.'
									</td>
									<td>
										Total Mark( Only Hons.) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$txtHonsTotalMarks.'
									</td>
									
								</tr>
								<tr>
									<td>
										Subjects (Incl. Hons.) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. '.$subject_offered1.'&nbsp;&nbsp;&nbsp;2. '.$subject_offered2.'&nbsp;&nbsp;&nbsp;3. '.$subject_offered3.'&nbsp;&nbsp;&nbsp;4. '.$subject_offered4.'
									</td>
									<td>
										Secured Mark( Only Hons.) :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$txtHonsSecuredMarks.'
									</td>
									
								</tr>
								<tr>
									<td>
										Total Marks (Incl. Hons.) &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$txtTotalMarks.'
									</td>
									<td>
										Division &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$txtHonsDivision.'
									</td>
								</tr>
								<tr>
									<td>
										Secured Marks (Incl. Hons.):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$txtSecuredMarks.'
									</td>
									<td>
										
									</td>
								</tr>
								<tr>
									<td>
										Distinction &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$radioDistinction.'
									</td>
									<td>
										
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>	
			
			<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">15.Educational Qualification </td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
					<td colspan="5">
							<table width="100%" cellpadding="5" style="border-collapse: collapse;text-align:center;" border="1">
								<tr>
									<td style ="width:20%;">Name of the Examination</td>
									<td style ="width:20%;">Board /Council/ <br>University</td>
									<td style ="width:10%;">YOP</td>
									<td style ="width:10%;">Division</td>
									<td style ="width:10%;">Mark <br/>Secured</td>
									<td style ="width:10%;">Maximum Marks</td>
									<td style ="width:10%;">% of Marks</td>
								</tr>';
				foreach($qualification_detail as $row)
				{
					echo'<tr>
										<td style ="width:20%;">'.$row['qual_desc_1'].'</td>
										<td style ="width:20%;">'.$row['university_board'].'</td>
										<td style ="width:10%;">'.$row['year_of_passing'].'</td>
										<td style ="width:10%;">'.$row['division_distinction'].'</td>
										<td style ="width:10%;">'.$row['mark_secured'].'</td>
										<td style ="width:10%;">'.$row['full_mark'].'</td>
										<td style ="width:10%;">'.$row['percentage_mark'].'</td>
									</tr>';
				}
		echo '</table>
				</td>
				<tr/>
			</table>
			<br/>
			<table width="100%" border="1" style="border-collapse: collapse; font-family:Arial;font-weight:bold;font-size:12px;">
				<tr>
					<td>
						16. Whether Interested to Apply for Hostel Accommodation &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;'.$hostel_facility.'<br/><br/>
						17. Distance between Berhampur University and your present address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;'.$presentdistance.'&nbsp;KM<br/>

					</td>
				</tr>
			</table>
			<br/>
			<table width="100%" border="1" style="border-collapse: collapse; font-family:Arial;font-weight:bold;font-size:12px;">
				<tr>
					<td colspan="4">18. Payment Details :</td>
				</tr>
				
				<tr>
					<td width="25%">
						Mode &nbsp;&nbsp; : '.$paymentMode.' 
					</td>
					<td width="20%">
						Amount &nbsp;&nbsp; : '.$amountPaid.' 
					</td>
					<td width="35%">
						Transaction Id &nbsp;&nbsp; : '.$transactionNo.' 
					</td>
					<td width="20%">
						Date &nbsp;&nbsp; : '.$depositDate.' 
					</td>
				</tr>
			</table>
			<br/>
			<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
					<tr>
						<td colspan = "5" style="text-align:center;text-decoration:underline;"><h2>DECLARATION</h2></td>
					</tr>
					<tr>
						<td colspan = "5">&nbsp;</td>
					</tr>
					<tr>
						<td colspan = "5" style="font-weight:normal;">(1) I declare that the particulars furnished in this form are true to the best of my knowledge and belief and as per my certificates and valid official documents. I further declare that in case any of the above information is found to be incorrect at any time, I shall be liable to forfeit my seat and to such penal action as the University may deem appropriate.</td>
					</tr>
					<tr>
						<td colspan = "5">&nbsp;</td>
					</tr>
					<tr>
						<td colspan = "5" style="font-weight:normal;">(2) I undertake to abide by the rules of the P.G. Council and P.G. Hostels, framed by the Berhampur University and if at any time, in any instance of breach of these rules, indiscipline, disobedience or misconduct or involvement in ragging is found against me, my name shall be struck off from the rolls of the University.</td>
					</tr>
					<tr>
						<td colspan = "5">&nbsp;</td>
					</tr>
					<tr>
						<td colspan = "5" style="font-weight:normal;">(3) I have understood the various provisions and rules of eligibility and admission to various P.G. Departments of Berhampur University as mentioned in the Prospectus along with the application form and I undertake to abide by any decision taken by the University authorities in regard to my eligibility and admission into P.G. Departments.</td>
					</tr>
				</table>
				<br/>
				<br/>
				<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
					<tr>
						<td style="width:10%;text-align:center;">Date:</td>
						<td style="width:20%;text-align:left;">'.$today.'</td>
						<td style="width:70%; text-align:right;"><img  src="'.$signature.'" width="180"  height="50" /> </td>
					</tr>
					<tr>
						<td style="width:10%;text-align:right;"></td>
						<td style="width:20%;text-align:right;"></td>
						<td style="width:70%; text-align:right;">Full Signature of the Aplicant</td>
					</tr>
				</table>
				<br/>
				<br/>
				<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
					<tr>
						<td style="width:100%;text-align:left;">Please send this Form to “The Head, Dept. of '.$department_name.', Berhampur University, Bhanjabihar, Ganjam, Odisha 760 007”, by REGD/SPEED POST ONLY within three days of online-submission of application form.</td>
					</tr>
					
				</table>';

}
?>				