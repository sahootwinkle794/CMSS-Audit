<?php
	
	
//echo $type ;die();
if($type == 'TOP')
{
	$now = date("d-m-Y h:i A");
	$today = date("d-m-Y");
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
	$firstName=$applicant_detail[0]['first_name'];
	$is_north_east=$applicant_detail[0]['is_north_east'];
	$midName=$applicant_detail[0]['mid_name'];
	$lastName=$applicant_detail[0]['last_name'];
	$fullName=$applicant_detail[0]['full_name'];
	$userPhoto=$applicant_detail[0]['passportphoto'];
	$app_email =$applicant_detail[0]['applicant_email'];
	$sign=$applicant_detail[0]['SIGN'];
	$master_name=$applicant_detail[0]['master_name'];
	$exservice=$applicant_detail[0]['exservice'];
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
	$applied_program = $applicant_detail[0]['applied_program'];
	$exam_center_code = $applicant_detail[0]['exam_center_code'];
	/*if($applicant_detail[0]['is_north_east'] == 'NO'){
		$north_east_state = $applicant_detail[0]['is_north_east'];
	}else{
		$north_east_state = $applicant_detail[0]['is_north_east'].','.$applicant_detail[0]['north_east_state'];
	}*/
	$north_east_state = $applicant_detail[0]['is_north_east'];
	
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
	
/*	echo  $is_north_east; die();
	*/
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============STUDENT DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
	/* ==================XXXXXXXXXXXXXXXXXXXXXXXX=============INSTITURE DETAILS==============XXXXXXXXXXXXXXXXXXX================*/
		$txtHonsDivision = $applicant_detail[0]['honours_division'];
		$radioCourseType = $applicant_detail[0]['course_type'];
		$father_name=isset($applicant_father[0]['rel_name'])?$applicant_father[0]['rel_name']:'';
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
		if($is_north_east == 'Yes')
		{
			$paymentMode = '';
			$amountPaid = 0;
			$depositDate = '';
			$transactionNo = '';
			$pg_charges = 0;
			$amountPaid = 0;
			
		}
		else{
			$paymentMode=isset($paymentDetail[0]['money_deposit_mode'])?$paymentDetail[0]['money_deposit_mode']:'';
			$amountPaid=isset($paymentDetail[0]['amount'])?$paymentDetail[0]['amount']:'';
			$depositDate=isset($paymentDetail[0]['depositdate'])?$paymentDetail[0]['depositdate']:'';
			$transactionNo=isset($paymentDetail[0]['money_receipt_no'])?$paymentDetail[0]['money_receipt_no']:'';
			$pg_charges=isset($paymentDetail[0]['pg_charges'])?$paymentDetail[0]['pg_charges']:'0';
			$amountPaid = $amountPaid + $pg_charges;
		}
		
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
	//$date1 = new DateTime($date1);

	echo '<table width="100%" style="border-collapse: collapse;font-family:Arial;">
					<tr>
						<td>
						</td>
						<td colspan="2" style="text-align: right;">
							Application No : '.$applicantNumber.'
						</td>
					</tr>
					<tr>
						<td colspan="3" style="text-align: center;padding-left:-30px;">
							<img style="vertical-align: top ;" src="'.base_url().'upload/image/cipet_header.jpg" />
						</td>
					</tr>
					<tr>
						<td style="width: 10%;text-align: right;vertical-align:middle;"></td>
						<td style="width: 80%;text-align: center;padding-left:-30px;">
							<h3>APPLICATION FORM FOR <br/>
							'.$programName.'</h3><br/>
							<h3>ACADEMIC SESSION '.$session.'</h3>
						</td>
						<td style="width: 10%;text-align: right;vertical-align:middle;"><img style="vertical-align: top" src="'.$userimg.'" height="150" width="117" /></td>
					
					</tr>
				</table>
				
				<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px; ">
						<tr >
							<td colspan="3" > <span style="font-size:17px;border-bottom:1px solid black;">Applicant\'s Information : </span></td>
						</tr>
						<tr>
							<td width="50%">
								1. Applicant Name (As in HSC Certificate)</td> <td width="5%">:</td> <td width="45%">'.$firstName.' '.$midName.' '.$lastName.'</td> 
						</tr>
						 <tr><td  colspan="3"></td></tr>
								<tr>
								 <td >
								2. (a) Gender </td> <td>:</td> <td>'.$gender.'</td>
								</tr>
								
								 
								<tr>
								  <td>
								&nbsp;&nbsp;&nbsp;&nbsp;(b) Nationality </td> <td>:</td> <td>'.$actual_nationality.'</td>
								</tr>
								<tr><td colspan="3"></td></tr>
								<tr>
								 <td>
								3. Date of Birth (In Figure)</td> <td>:</td> <td>'.$date.'-'.$month.'-'.$year.'  ('.$dobinWord.')</td>
								</tr>
								<tr><td colspan="3"></td></tr>
								<tr>
								 <td>
								4. Aadhaar Number </td> <td>: </td> <td>'.$adhar_no.'</td>
								</tr>
								<tr><td colspan="3"></td></tr>
								<tr>
								 <td>
								5. Category</td> <td>:</td> <td> '.$category.'</td>
								</tr>
								<tr><td colspan="3"></td></tr>
								<tr>
								 <td>
								6. Email Id</td> <td>:</td> <td>'.$email_id.'</td> 
								</tr>
								<tr><td colspan="3"></td></tr>
								<tr>
								 <td>
								7. Belongs to North East State </td><td>:</td> <td>'.$north_east_state.'</td>
								</tr>
								<tr><td colspan="3"></td></tr>
								<tr>
								 <td>
								8. Ex-Seviceman </td><td>:</td> <td>'.$exservice.'</td>
								</tr>
								<tr><td colspan="3"></td></tr>
								<tr>
								 <td>
								9. Father\'s/Guardian\'s Name </td>
		                          <td>:</td> <td>'.$father_name.'</td>
		                         </tr>
		                         <tr><td colspan="3"></td></tr>
		                         <tr>
		                          <td>
								10. PH Category </td> <td>:</td> <td>'.$physically_challenged.'</td>
								</tr>
								<tr><td colspan="3"></td></tr>
								<tr> 
								 <td>

								11. Application For </td> <td>:</td> <td>'.$master_name.'</td>
								</tr>
								
								<tr><td colspan="3"></td></tr>
                                 <tr>
                                 <td>
                                12.Center Code(1st Preference)</td> <td>:</td> <td> '.$center_code1.'.'.$center_name1.' </td>
								 </tr>
								 <tr><td colspan="3"></td></tr>
								 <tr>
								 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Center Code(2nd Preference) </td> <td>:</td> <td> '.$center_code2.'.'.$center_name2.' </td>
								 
								 </tr>
								 <tr><td colspan="3"></td></tr>
								 <tr>
                               
                               		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Center Code(3rd Preference) </td> <td>:</td> <td> '.$center_code3.'.'.$center_name3.'</td>
                               	</tr> 
                                 <tr><td colspan="3"></td></tr>
                                
                                
                                <tr>
                                 <td>
								13. Father&#8217;s / Mother&#8217;s Profession </td> <td> :</td> <td>'.$father_occupation.' </td>
								</tr>
								
								<tr>
								<td>
								14. Father&#8217;s / Mother&#8217;s Income </td> <td>:</td> <td>'.$annual_parent_income.'.00 </td>
								</tr>

																
								<tr>
								<td>
								15. Mother&#8217;s Name </td> <td>:</td> <td>'.$mothers_name.' </td>
								</tr>

								

					</table>
					<br>
					<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
					  <tr>
					   <td width="50%">
					<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
						<tr>
							<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;">15.(a) Present Address : </span></td>
						</tr>
						
						 
						   <tr><td  colspan="3"></td></tr>
						    	 <tr><td  colspan="3"></td></tr>
							<tr>
							   
							    <td> Locality/Street Name</td> <td>:</td> <td>'.$presentaddr1.'</td>
							    </tr>
							     <tr><td  colspan="3"></td></tr>
							    <tr>
								  <td>Post</td><td>:</td><td>'.$presentpostoffice.'</td>
								 </tr>
								  <tr><td  colspan="3"></td></tr>
								 <tr>
                               <td>City</td> <td>:</td> <td>'.$city_name.'</td>
                               </tr>
                               
                                 <tr><td  colspan="3"></td></tr>
								<tr>
								 <td> 
								 District </td> <td>:</td> <td>'.$presentdistrictcode.'</td> 
								 </tr>
								 
								 <tr>
								 <td>State</td> <td>:</td> <td>'.$presentstatecode.'</td>
								 </tr>
								   <tr><td  colspan="3"></td></tr>
								 <tr>
								 <td>
								 PIN </td> <td>:</td> <td>'.$presentpin.' </td> 
								 </tr>
								  <tr><td  colspan="3"></td></tr>
								  
							
					</table>
					 </td>
					<td width="50%" valign="top">
				<table width="100%"  style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;padding :2px 2px 2px 2px;">
						<tr>
							<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;">(b) Permanent Address : </span></td>
						</tr>
						 
							<tr><td  colspan="3"></td></tr>
							 <tr><td  colspan="3"></td></tr>
							 <tr>
							    <td>Locality/Street Name</td> <td>:</td><td>'.$permanentaddr1.'</td>
							  </tr>
							  <tr><td  colspan="3"></td></tr>
							   <tr>
								<td>Post </td> <td>:</td> <td>'.$permanentpostoffice.'</td>
                               </tr>
                               <tr><td  colspan="3"></td></tr>
                               <tr>
								 <td>City </td> <td>:</td> <td>'.$city_name1.'</td>
								</tr>
                             <tr><td  colspan="3"></td></tr>
							 <tr>
							  <td>
								District</td>
								<td>:</td>
								<td>'.$permanentdistrictcode.' </td>
								</tr>
								<tr><td  colspan="3"></td></tr>
								<tr>
								<td>State </td> <td>:</td><td>'.$permanentstatecode.'</td>
								</tr>
								<tr><td  colspan="3"></td></tr>
								<tr>
								 <td>
								PIN </td> <td>:</td><td>'.$permanentpin.'</td>
								</tr>
								
							
					</table>
					</td>
					</tr>
					</table>
					<br/>';
					
					echo '<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;">16.Educational Qualification</span> </td>
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
									<td style ="width:10%;">Mark <br/>Secured</td>
									<td style ="width:10%;">Maximum Marks</td>
									<td style ="width:10%;">% of Marks</td>
								</tr>';
				//print_r($qualification_detail)	; die();			
				
				foreach($qualification_detail as $row)
				{
					
					echo'<tr>
						<td style ="width:20%;">'.$row['qual_desc_1'].'</td>
						<td style ="width:20%;">'.$row['university_board'].'</td>
						<td style ="width:10%;">'.$row['year_of_passing'].'</td>										 
						<td style ="width:10%;">'.$row['mark_secured'].'</td>
						<td style ="width:10%;">'.$row['full_mark'].'</td>
						<td style ="width:10%;">'.$row['percentage_mark'].'</td>
					</tr>';
				}
				echo '</table>
						</td>
						<tr/>
					</table>';
					
				echo'<table width="100%" style="border-collapse: collapse; font-family:Arial;font-weight:bold;font-size:12px;">
						<tr>
							<td colspan="4"><span style="font-size:17px;border-bottom:1px solid black;">17. Payment Details :</span></td>
						</tr>
						 <tr><td colspan="4">&nbsp;</td></tr>
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
					<br>';
					echo '<h3 style="text-align:center;text-decoration:underline;">Document Details</h3></br></br>';
					$i=1;
					foreach($applicant_documents as $row){
						
						echo $i.'.'.$row['document_type'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>';
						$i++;
					};
		

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
	//echo $userSign ; die();
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
	$applied_program = $applicant_detail[0]['applied_program'];
	$exam_center_code = $applicant_detail[0]['exam_center_code'];
	$north_east_state = $applicant_detail[0]['north_east_state'];
	$category = $applicant_detail[0]['category'];
	$guardian_name = $applicant_detail[0]['guardian_name'];
	$father_occupation = $applicant_detail[0]['father_occupation'];
	$annual_parent_income = isset($applicant_detail[0]['annual_parent_income'])?$applicant_detail[0]['annual_parent_income']:0;


	$mothers_name = $applicant_detail[0]['mothers_name'];
	$mothers_profession = $applicant_detail[0]['mothers_profession'];
	$mothers_income = isset($applicant_detail[0]['mothers_income'])?$applicant_detail[0]['mothers_income']:0;
	$fathers_adhar_no = $applicant_detail[0]['fathers_adhar_no'];
	$mothers_adhar_no = $applicant_detail[0]['mothers_adhar_no'];

	$is_employed = $applicant_detail[0]['is_employed'];
	$employer_add = $applicant_detail[0]['employer_add'];
	$employer_from = $applicant_detail[0]['employer_from'];
	$employer_to = $applicant_detail[0]['employer_to'];
	$completion_date = $applicant_detail[0]['completion_date'];
	$center_name1 = $applicant_detail[0]['center_name1'];
	$center_name2 = $applicant_detail[0]['center_name2'];
	$center_name3 = $applicant_detail[0]['center_name3'];
	$master_name = $applicant_detail[0]['master_name'];
	$last_year_mark = isset($applicant_detail[0]['last_year_mark'])?$applicant_detail[0]['last_year_mark']:0;
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
	//$date1 = new DateTime($date1);
			echo '<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3"><span style="font-size:17px;border-bottom:1px solid black;">18.Educational Qualification</span> </td>
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
									<td style ="width:10%;">YOP/YOA</td>									 
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
										<td style ="width:10%;">'.$row['mark_secured'].'</td>
										<td style ="width:10%;">'.$row['full_mark'].'</td>
										<td style ="width:10%;">'.$row['percentage_mark'].'</td>
									</tr>';
				}
		echo '</table>
				</td>
				<tr/>
			</table>
			
			
			<table width="100%"  style="border-collapse: collapse; font-family:Arial;font-weight:bold;font-size:12px; margin-top:350px; ">
				<tr>
					<td width="50%">
						19. Graduation Final year Percentage </td> <td width="5%"> :</td> <td width="45%">'.$last_year_mark.'%</td> 
						</tr>
						<tr>
					<td width="50%">
						20. Whether Employed </td> <td width="5%"> :</td> <td width="45%">'.$is_employed.'</td> 
						</tr>
						
						<tr>
						<td>18. Name and Address Of Employer </td> <td>:</td> <td>'.$employer_add.' </td>
						</tr>
                          
                          <tr>
                          
						<td>19. From Year </td> <td>:</td> <td>'.$employer_from.'</td>
						</tr>
						
						 <tr>
						  <td>
						21. To Year and Address Of Employer </td> <td>:</td><td>'.$employer_to.'</td>
						</tr>
                          
                          <tr>
					<td width="50%">
						22. Date Of Completion Of Internship </td> <td width="5%">:</td> <td width="45%">'.$completion_date.'</td>
				</tr>
					
			</table>
			<br/>

			
			<table width="100%" style="border-collapse: collapse; font-family:Arial;font-weight:bold;font-size:12px;">
				<tr>
					<td colspan="4"><span style="font-size:17px;border-bottom:1px solid black;">23. Payment Details :</span></td>
				</tr>
				 <tr><td colspan="4">&nbsp;</td></tr>
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
			<br/>
				<br/>
				<br/>
				<br/>
			<table width="100%" style="border-collapse: collapse;font-family:Arial;font-weight:bold;font-size:12px;">
					<tr>
						<td colspan = "5" style="text-align:center;text-decoration:underline;"><h2>DECLARATION</h2></td>
					</tr>
					<tr>
						<td colspan = "5">&nbsp;</td>
					</tr>
					<tr>
						<td colspan = "5" style="font-weight:normal;">I declare that all the particulars stated in this application are true to the best of my knowledge and belief. In the event of suppression or distortion of any fact made in the above application form, I understand that I will be denied the opportunity to appear the ENTRANCE TEST/ADMISSION. If already admitted, my admission will be cancelled. I also understand that the decision of the authorities regarding the admission will be final. If admitted, it is assured that I will follow the rules and regulations of the Institute and University and if I am found guilty of any misconduct I shall be liable for punishment as deemed fit by the Institute authority.</td>
					</tr>
					 
				</table>
				<br/>
				<br/>
				<br/>
				<br/>
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
				';
				
				
				echo '<h3 style="text-align:center;text-decoration:underline;">Document Details</h3></br></br>';
				$i=1;
				foreach($applicant_documents as $row){
					
					echo $i.'.'.$row['document_type'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>';
					$i++;
				}


}
?>				