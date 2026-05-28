<?php
date_default_timezone_set('Asia/Kolkata');
$now = date('Y-m-d h:i:s', now());
$data = $this->uri->uri_to_assoc();
$edit_status = isset($data['edit'])?$data['edit']:'';
//print_r($allQualifications);
//print_r($center_choice);die();
//echo ($choice_details_data['center_choice']);die();
//$choiceData = ($choice_details_data[0]['center_choice']);
//echo $choiceData;
$qualification_array_size = sizeof($allQualifications);
foreach($program_data as $row)
{
	$admcode = $row['program_code'];
	$program_group_name = $row['program_group_name'];
	$seladmcode = $row['program_code'];
	$admname = $row['program_name'];
	$file_name = $row['file_name'];
	$app_start_date = $row['apply_start_date'];
	$app_end_date = $row['apply_end_date'];
	//echo $app_start_date."-----------";
	//echo $app_end_date;
	$app_start_date = strtotime($app_start_date);
	$app_end_date = strtotime($app_end_date);
	//$now = date("d-m-Y, h:i A",$now);
	$apply_date1 = date("d-m-Y, h:i A",$app_start_date);
	$apply_date2 = date("d-m-Y, h:i A",$app_end_date);
	if($app_start_date > $now)
	{
		$time_to_apply = "Start date is:$apply_date1";
	}
	else if($app_start_date <= $now)
	{
		$time_to_apply = "Last date is: $apply_date2";
	}
}
foreach($institute_data as $row)
{
	$institute_code = $row['institute_code'];
	$institute_name = $row['institute_name'];
	$ins = encrypt_decrypt('encrypt',$institute_code);
}
$appl_status = '';
$txtFirstName = '';
$txtMiddleName = '';
$txtLastName = '';
$radiogender = '';
$radioID = '';
$radioJEE = 'COMMON';
$cmbNationality = '';
$cmbReligion = '';
//$allMinority = '';
$radiogender = '';
$radioResident = '';
$txtOtherNationality = '';
$id_proof_number = '';
$radioMigrant = '';
$radioPhysicallY = '';
$radioMinority = '';
$radioMarkSheet = '';
$mode = '';
$radioGradCert = '';
$radioGradMarkSheet = '';
$txtemail = '';
$radiobelong = '';
$txtOccupation = '';
$txtIncome = '';
$txtIndicate = '';
$txtKnowabout = '';
$course_code = '';
$course_name = '';
$radioSports = '';
$radioService = '';
$center_name1='';
$master_name='';
$center_code1='';
$center_name2='';
$center_code2='';
$center_name3='';
$center_code3='';
/*$cand_name = '';*/
$co_name = '';
$city_name = '';
/*$cand_name1 = '';*/	
$co_name1 = '';
$city_name1 = '';
$mobile='';

$is_employed='';
$chkInformed='';
$is_employe_disc='';
$employer_add='';
$employer_from='';
$employer_to='';
$employer_add1='';
$employer_from1='';
$employer_to1='';
$completion_date='';
$txtfinalpercentage = '';
$FathersProfession='';
$FathersIncome='';
$cmbNorthState='';
$radioComputer = '';

$MothersName='';
$MothersProfession='';

$FathersAdhar='';
$MothersAdhar='';

$cmbdc = '';
$graduation_quali='';
$txtphtype='';
$txtUid = '';
$txtFatherName = '';
$txtMaritalStatus = '';
$txtMotherName = '';
$txtPresentAddress = '';
$txtPresentLocality = '';
$txtPresentPost = '';
$cmbPresentState = '';
$cmbPresentDist = '';
$cmbHomeDist = '';
$txtPresentPin = '';
$txtPermenentAddress = '';
$chksameasresidential = '';
$txtPermenentLocality = '';
$txtPermanentPost = '';
$cmbPermanentState = '';
$cmbPermanentDist = '';
$txtPermanentPin = '';
$txtPermanentMobile = '';
$radiomaritalstatus = '';
$radioHostel = '';
$radioQuota = '';
$txtUnivRegNo = '';
$cmbReservedCategory = '';
$enclosuresdetails = '';

$txtQualification1 = '';
$txtYear1 = '';
$txtBoard1 = '';
$txtDivision1 = '';
$txtMS1 = '';
$txtFM1 ='';
$txtPercent1 = '';
$txtsubject1 = '';
$txtdistinct1 = '';

$txtQualification2 = '';
$txtYear2 = '';
$txtBoard2 = '';
$txtDivision2 = '';
$txtMS2 = '';
$txtFM2 ='';
$txtPercent2 = '';
$txtsubject2 = '';
$txtdistinct2 = '';
$txtOther_grad = '';
$txtOther_grad1 = '';
$txtOther_grad2 = '';
$txtOther_grad3 = '';
$txtOther_grad4 = '';
$txtOther_grad5 = '';
$txtOther_grad6 = '';
$txtOther_grad7 = '';
$txtOther_grad8 = '';
$txtOther_grad9 = '';
$txtQualification3 = '';
$txtYear3 = '';
$txtBoard3 = '';
$txtDivision3 = '';
$txtMS3 = '';
$txtFM3 ='';
$txtPercent3 = '';
$txtsubject3 = '';
$txtdistinct3 = '';

$txtQualification4 = '';
$txtYear4 = '';
$txtBoard4 = '';
$txtDivision4 = '';
$txtMS4 = '';
$txtFM4 ='';
$txtPercent4 = '';
$txtsubject4 = '';
$txtdistinct4 = '';

$txtQualification5 = '';
$txtYear5 = '';
$txtBoard5 = '';
$txtDivision5 = '';
$txtDivision6 = '';
$txtMS5 = '';
$txtFM5 ='';
$txtPercent5 = '';
$txtsubject5 = '';
$txtdistinct5 = '';

$txtQualification6 = '';
$txtYear6 = '';
$txtBoard6 = '';
$txtDivision6 = '';
$txtDivision7 = '';
$txtMS6 = '';
$txtFM6 ='';
$txtPercent6 = '';
$txtsubject6 = '';
$txtdistinct6 = '';

$txtQualification7 = '';
$txtYear7 = '';
$txtBoard7 = '';
$txtDivision7 = '';
$txtDivision7 = '';
$txtMS7 = '';
$txtFM7 ='';
$txtPercent7 = '';
$txtsubject7 = '';
$txtdistinct7 = '';


$txtQualification8 = '';
$txtYear8 = '';
$txtBoard8 = '';
$txtDivision8 = '';
$txtDivision8 = '';
$txtMS8 = '';
$txtFM8 ='';
$txtPercent8 = '';
$txtsubject8 = '';
$txtdistinct8 = '';

$txtQualification9 = '';
$txtYear9 = '';
$txtBoard9 = '';
$txtDivision9 = '';
$txtDivision9 = '';
$txtMS9 = '';
$txtFM9 ='';
$txtPercent9 = '';
$txtsubject9 = '';
$txtdistinct9 = '';

$txtQualification10 = '';
$txtYear10 = '';
$txtBoard10 = '';
$txtDivision10 = '';
$txtDivision10 = '';
$txtMS10 = '';
$txtFM10 ='';
$txtPercent10 = '';
$txtsubject10 = '';
$txtdistinct10 = '';

$txtQualification11 = '';
$txtYear11 = '';
$txtBoard11 = '';
$txtDivision11 = '';
$txtDivision11 = '';
$txtMS11 = '';
$txtFM11 ='';
$txtPercent11 = '';
$txtsubject11 = '';
$txtdistinct11 = '';

$txtQualification12 = '';
$txtYear12 = '';
$txtBoard12 = '';
$txtDivision12 = '';
$txtDivision12 = '';
$txtMS12 = '';
$txtFM12 ='';
$txtPercent12 = '';
$txtsubject12 = '';
$txtdistinct12 = '';

$txtQualification13 = '';
$txtYear13 = '';
$txtBoard13 = '';
$txtDivision13 = '';
$txtDivision13 = '';
$txtMS13 = '';
$txtFM13 ='';
$txtPercent13 = '';
$txtsubject13 = '';
$txtdistinct13 = '';

$txtQualification14 = '';
$txtYear14 = '';
$txtBoard14 = '';
$txtDivision14 = '';
$txtDivision14 = '';
$txtMS14 = '';
$txtFM14 ='';
$txtPercent14 = '';
$txtsubject14 = '';
$txtdistinct14 = '';

$txtQualification15 = '';
$txtYear15 = '';
$txtBoard15 = '';
$txtDivision15 = '';
$txtDivision15 = '';
$txtMS15 = '';
$txtFM15 ='';
$txtPercent15 = '';
$txtsubject15 = '';
$txtdistinct15 = '';

$txtQualification16 = '';
$txtYear16 = '';
$txtBoard16 = '';
$txtDivision16 = '';
$txtDivision16 = '';
$txtMS16 = '';
$txtFM16 ='';
$txtPercent16 = '';
$txtsubject16 = '';
$txtdistinct16 = '';

$empDisciplinaryInfo = '';
$empDisciplinary = '';
$relevantinfo = '';
$empsuspendedinfo = '';
$is_employe_disc = '';

$txtgrading1 = '';
$txtgrading2 = '';
$txtgrading3 = '';
$txtgrading4 = '';
$txtgrading5 = '';
$txtgrading6 = '';
$txtgrading7 = '';
$txtgrading8 = '';

$txtqual21 = '';
$txtqual22 = '';
$txtqual23 = '';
$txtqual24 = '';
$txtqual25 = '';
$txtqual26 = '';
$txtqual27 = '';
$txtqual28 = '';

$technical_5_1 = ''; //course
$technical_5_2 = ''; //institute
$technical_5_3 = ''; //affiliation
$technical_5_4 = ''; //duration

$technical_6_1 = ''; //course
$technical_6_2 = ''; //institute
$technical_6_3 = ''; //affiliation
$technical_6_4 = ''; //duration

$technical_7_1 = ''; //course
$technical_7_2 = ''; //institute
$technical_7_3 = ''; //affiliation
$technical_7_4 = ''; //duration

$txtPeriodOfDebar='';
$txtDateOfDebar='';
$txtNameOfPost='';
$txtDOJ='';
$txtNameOfOffice='';

$txtExamName1='';
$txtStream1='';
$txtYearQual1='';
$txtBoardOth1='';
$txtSub1='';
$txtCGPA1='';
$txtGradingOth1='';
$txtDiv1='';


$txtExamName2='';
$txtStream2='';
$txtYearQual2='';
$txtBoardOth2='';
$txtSub2='';
$txtCGPA2='';
$txtGradingOth2='';
$txtDiv2='';

$postcode=array();
$postname='';
$postsize='';
$i='';

$txtEmailId = '';
$exam_centre = '';

$txtPresentDistance = '';
$chkUndertaking1 = 1;
$chkUndertaking2 = 2;
$chkUndertaking3 = 3;
$declaration1 = "I declare that the particulars furnished in this form are true to the best of my knowledge and belief and as per my certificates and valid official documents. I further declare that in case any of the above information is found to be incorrect at any time, I shall be liable to forfeit my seat and to such penal action as the University may deem appropriate.";
$declaration2 = "I undertake to abide by the rules of the P.G. Council and P.G. Hostels, framed by the Berhampur University and if at any time, in any instance of breach of these rules, indiscipline, disobedience or misconduct or involvement in ragging is found against me, my name shall be struck off from the rolls of the University. ";
$declaration3 = "I have understood the various provisions and rules of eligibility and admission to various P.G. Departments of Berhampur University as mentioned in the Prospectus along with the application form and I undertake to abide by any decision taken by the University authorities in regard to my eligibility and admission into P.G. Departments.";
$chkApplicantUndertaking = '';
$show = 0;
$edit = "false";


//print_r($post_detail);die();
foreach($post_detail as $row)
{
	$postcode[]=$row['course_code'];
	$postname=implode(', ', $postcode);
}/*
$noteligible_post_codes = array();
$noteligible_post_names = array();
$post_codes_noteligible = '';
$post_names_noteligible = '';

foreach($course_wise_age as $row)
{
	$noteligible_post_codes[] = $row['course_code'];
	$noteligible_post_names[] = $row['course_name'];
	$post_codes_noteligible = implode(', ', $noteligible_post_codes);
	$post_names_noteligible = implode(', ', $noteligible_post_names);
}*/
foreach($registration_data as $row)
{
	$txtFirstName = $row['first_name'];
	$txtRegUserId = $row['reg_user_id'];
	$reg_user_id = $row['reg_user_id'];
	$txtMiddleName = $row['mid_name'];
	$txtLastName = $row['last_name'];
	$txtEmailId   = $row['email_id'];
	$txtDob = $row['dob'];
	$hidStateCode = $row['state'];
	$stateCode = $row['state_name'];
	
	$dob1 = explode('-',$txtDob);
	
}/*
foreach($application_data_temp as $row)
{
	$appl_status = $row['appl_status'];
}*/

//********************************************* Details in template *******************************//

foreach($applicant_data as $row)
{
	$appl_status = $row['appl_status'];
	$exam_centre = $row['exam_center_code'];
	$txtFirstName = $row['first_name'];
	$txtMiddleName = $row['mid_name'];
	$txtLastName = $row['last_name'];
	$fullname = $txtFirstName." ".$txtMiddleName." ".$txtLastName;
	$dob1 = explode("-",$row['dob1']);
	$radiogender = $row['gender'];
	$radioResident = $row['ap_resident'];
	$radio_prof = $row['id_proof'];
	$cmbHomeDist = $row['district_code'];
	
	$relevantinfo = $row['relevantinfo'];
	$enclosuresdetails = $row['enclosuresdetails'];
	
	$cmbdc = $row['dc_office'];
	/*echo $cmbHomeDist;
	die();*/
	
	$id_proof_number = $row['id_proof_number'];
	
	$radioComputer = $row['is_computer_education'];
	$radioJEE = $row['jee_place'];
	$radioHostel = $row['hostel_facility'];
	$radiomaritalstatus = $row['marital_status'];
	//$txtEmailId = $row['applicant_email'];
	$cmbNationality = $row['nationality'];
	$txtOtherNationality = $row['nationality_oth']; 
	$cmbReservedCategory = $row['category'];
	//$radioHandicapped = $row['is_physically_challanged'];
	$radioPhysicallY  = $row['physically_challenged'];
	$radioMinority   = $row['is_minority_community'];
	$radioMarkSheet   = $row['is_passed'];
	$radioSports   = $row['is_sports'];
	$radioService   = $row['is_ex_serviceman'];
	$mode = $row['payment_mode'];
	$radioGradCert   = $row['grad_cert'];
	$radioGradMarkSheet   = $row['grad_mark_sheet'];
	$radiobelong   = $row['is_north_east'];
	$txtOccupation   = $row['father_occupation'];
	$txtIncome   = $row['annual_parent_income'];
	$txtIndicate   = $row['indicate_choice'];
	$txtKnowabout   = $row['know_about_cipet'];
	//$radiominority = $row['is_minority_community'];
	$cmbCommunity = $row['minority_community_details'];
	$radioSingleGirlChild = $row['single_girl_child_flag'];
	$radioIllness = $row['if_chronic_illness'];
	$radioQuota = $row['is_reserved_quota'];
	$txtChronicIllness = $row['chronic_illness'];
	$radioAllergies = $row['if_allergies'];
	$txtAllergies = $row['allergies'];
	$chksameasresidential = ($row['comm_address_ref_id'] == $row['perm_address_ref_id'] ? 'Y' : 'N');
	$txtSchoolName = $row['last_school'];
	$cmbBoardName = $row['last_board'];
	$txtOtherBoard = isset($allOtherInfo["Name of the Board"]) ? $allOtherInfo["Name of the Board"] : ''; 
	$cmbReligion = $row['religion'];
	$txtphtype  = $row['phtype'];
	$txtUid = $row['adhar_no'];
	$master_name = $row['master_name'];
	$txtOtherSubject = $row['other_subject'];
	$txtOtherUniversity = $row['other_university'];
	$txtApplicantEmail = $row['applicant_email'];
	$txtApplicantLandLine = $row['applicant_landline'];
	$txtApplicantMobile = $row['applicant_mobile'];
	$radioExam = $row['entrance_exam_appeared'];
	$txtMotherTongue = $row['mother_tongue'];
	$txtUnivRegNo = $row['univ_regn_no'];
	$txtTotalMarks = $row['total_mark'];
	$txtSecuredMarks = $row['secured_mark'];
	$radioDistinction = $row['distinction'];
	$txtHonoursSubject = $row['honours_subject'];
	$txtHonsTotalMarks = $row['honours_total_mark'];
	$txtHonsSecuredMarks = $row['honours_secured_mark'];
	$txtHonsDivision = $row['honours_division'];
	$radioCourseType = $row['course_type'];
	$radioMigrant = $row['is_kashmiri_migrant'];
	$cmbHighestQualification = $row['highest_qualification'];
	$cmbPassStatus = $row['last_grade'];
	$txtUnivName = $row['last_school'];
	$txtSubject1 = $row['subject_offered1'];
	$txtSubject2 = $row['subject_offered2'];
	$txtSubject3 = $row['subject_offered3'];
	$txtSubject4 = $row['subject_offered4'];

	$center_name1=$row['exam_center_code'];
	$center_name2=$row['exam_center_code1'];
	$center_name3=$row['exam_center_code2'];

	$is_employed=$row['is_employed'];
	$chkInformed=$row['informed_govt'];
	$is_employe_disc=$row['is_employed'];
	$employer_add=$row['employer_add'];
	$employer_from=$row['employer_from'];
	$employer_to=$row['employer_to'];
	$employer_add1=$row['employer_add1'];
	$employer_from1=$row['employer_from1'];
	$employer_to1=$row['employer_to1'];
	
	$FathersProfession=$row['father_occupation'];
	$FathersIncome=$row['annual_parent_income'];
	$cmbNorthState=$row['north_east_state'];

	$MothersProfession=$row['mothers_profession'];
	$MothersIncome=$row['mothers_income'];
	$MothersName=$row['mothers_name'];
	$txtFatherName=$row['father_name'];
	$FathersAdhar=$row['fathers_adhar_no'];
	$MothersAdhar=$row['mothers_adhar_no'];

	$completion_date=$row['completion_date'];
	$txtfinalpercentage=$row['last_year_mark'];
	
	$empsuspended=$row['is_suspended'];
	$empsuspendedinfo=$row['suspendedInfo'];
	$empDisciplinary=$row['any_disciplinary_action'];
	$empDisciplinaryInfo=$row['disciplinaryInfo'];
	
	
	$txtPeriodOfDebar=$row['period_of_debar'];
	$txtDateOfDebar=$row['date_of_debar'];
	$txtNameOfPost=$row['name_of_post'];
	$txtDOJ=$row['govt_doj'];
	$txtNameOfOffice=$row['name_of_office'];
	
	$txtDOJ = date("d-m-Y", strtotime($txtDOJ));
	$txtDateOfDebar = date("d-m-Y", strtotime($txtDateOfDebar));
	
	
	/*$amount_paid=$row['amount_paid'];
	$draft_no=$row['draft_no'];
	$payment_date=$row['payment_date'];
	$bank_name=$row['bank_name'];*/
	
}
/*foreach($allDistricts as $row)
{
	if($cmbHomeDist == $row['district_code'])
	{
		echo "Fdafsafasf";
	}
}
die();*/
foreach($application_data as $row)
{
	$application_no = $row['appl_no'];
	$appl_status = $row['appl_status'];
	if($application_no != '')
		$edit = "true";
	if($edit_status != '')
	{
		$show = 0;
	}
	if($edit_status == '')
	{
		if($appl_status == 'Verified' || $appl_status == 'Fee Paid' )
			$show = 1;
	}
	/*if($appl_status == 'Verified' || $appl_status == 'Fee Paid' )
		$show = 1;*/
}
foreach($present_communication_data as $row)
{
	$txtPresentAddress = $row['address_1'];

	/*$cand_name = $row['cand_name'];*/
	$co_name = $row['co_name'];
	$city_name = $row['city_name'];


	$txtPresentLocality = $row['address_2'];
	$txtPresentPost = $row['post_office'];
	$cmbPresentDist = $row['district_code'];
	
	$cmbPresentState = $row['state_code'];
	$txtPresentPin = $row['pin'];
	$mobile = $row['mobile'];
	$txtOtherPresentDistrict = isset($allOtherInfo["Present District"]) ? $allOtherInfo["Present District"] : ''; 
	$txtOtherPresentState = isset($allOtherInfo["Present State"]) ? $allOtherInfo["Present State"] : ''; 
}
foreach($permanent_communication_data as $row)
{
	$txtPermenentAddress = $row['address_1'];

	/*$cand_name1 = $row['cand_name'];*/

	//$mobile1 = $row['mobile1'];
	$co_name1 = $row['co_name'];
	$city_name1 = $row['city_name'];

	$txtPermenentLocality = $row['address_2'];
	$txtPermanentPost = $row['post_office'];
	$cmbPermanentDist = $row['district_code'];
	$cmbPermanentState = $row['state_code'];
	$txtPermanentPin = $row['pin'];
	$txtPermanentMobile = $row['mobile']; 
	$txtOtherPermanentDist = isset($allOtherInfo["Permanent District"]) ? $allOtherInfo["Permanent District"] : ''; 
	$txtOtherPermanentState = isset($allOtherInfo["Permanent State"]) ? $allOtherInfo["Permanent State"] : ''; 
}
foreach($father_data as $row)
{
	$txtFatherName = $row['rel_name'];
	$txtFatherOccupation = $row['rel_occupation'];
	$txtFatherDesignation = $row['rel_desig'];
	$txtFatherDuties = $row['nature_of_work'];
	$txtareaFatherOffice = $row['place_work'];
	$txtFatherIncome = $row['annual_income'];
	$txtFatherPhoneRes = $row['res_no'];
	$txtFatherPhoneMob = $row['mobile_no'];
	$txtFatherEmail = $row['email_id']; 
}
foreach($mother_data as $row)
{
	$txtMotherName = $row['rel_name'];
	$txtMotherOccupation = $row['rel_occupation'];
	$txtMotherDesignation = $row['rel_desig'];
	$txtMotherDuties = $row['nature_of_work'];
	$txtareaMotherOffice = $row['place_work'];
	$txtMotherIncome = $row['annual_income'];
	$txtMotherPhoneRes = $row['res_no'];
	$txtMotherPhoneMob = $row['mobile_no'];
	$txtMotherEmail = $row['email_id'];
}
foreach($guardian_data as $row)
{
	$txtGuardianName = $row['rel_name'];
}

$sl = 1;//print_r($academic_qual_data);die();
foreach($academic_qual_data as $row1)
{
	${'txtYear'.$sl} = $row1['year_of_passing'];
	${'txtQualification'.$sl} = $row1['qual_desc_1'];
	${'txtBoard'.$sl} = $row1['university_board'];
	${'txtDivision'.$sl} = $row1['division_distinction'];
	${'txtMS'.$sl} = $row1['mark_secured'];
	${'txtFM'.$sl} = $row1['full_mark'];
	${'txtPercent'.$sl} = $row1['percentage_mark'];
	
	${'txtsubject'.$sl} =$row1['honours_subject'];
	${'txtdistinct'.$sl} =$row1['division_distinction'];
	${'txtgrading'.$sl} = $row1['grade'];
	${'txtqual2'.$sl} = $row1['qual_desc_2'];
	${'txtOther_grad'.$sl} = $row1['other_stream'];
	//$txtOther_grad = $row1['other_stream'];
	$sl++;
}
//echo $row1['other_stream'];die();
foreach($tech_qual_data_5 as $row)
{
	$txtExamName1 = $row['qual_desc_1'];
	$txtYearQual1= $row['year'];
	$txtStream1 = $row['stream'];
	$txtBoardOth1 = $row['affiliation_from'];
	$txtSub1 = $row['subjects_offered'];
	$txtCGPA1 = $row['grade_cgpa'];
	$txtGradingOth1 = $row['remark'];
	$txtDiv1 = $row['division'];
}
foreach($tech_qual_data_6 as $row)
{
	$txtExamName2 = $row['qual_desc_1'];
	$txtYearQual2= $row['year'];
	$txtStream2 = $row['stream'];
	$txtBoardOth2 = $row['affiliation_from'];
	$txtSub2 = $row['subjects_offered'];
	$txtCGPA2 = $row['grade_cgpa'];
	$txtGradingOth2 = $row['remark'];
	$txtDiv2 = $row['division'];
}
foreach($tech_qual_data_7 as $row)
{
	$technical_7_1 = $row['qual_desc_1'];
	$technical_7_2= $row['year'];
	$technical_7_3 = $row['institute_name'];
	$technical_7_4 = $row['thesis'];
}/*
foreach($applicant_data_temp as $row)
{
	$txtFirstName = $row['first_name'];
	$txtMiddleName = $row['middle_name'];
	$txtLastName = $row['last_name'];
	$radiogender = $row['gender'];
	$exam_centre = $row['exam_center'];
	$txtFatherName = $row['father_name'];
	$MothersName = $row['mother_name'];
	$dob = $row['dob'];
	$radio_prof = $row['id_proof'];
	$cmbdc = $row['dc_office'];
	$radioSports   = $row['is_sports'];
	$radioService   = $row['is_ex_serviceman'];
	$radioComputer = $row['is_computer_education'];
	$id_proof_number = $row['aadhaar_no'];
	$cmbReservedCategory = $row['category'];
	$radioResident = $row['resident_ap'];
	$nationality = $row['nationality'];
	$radioPhysicallY = $row['pwd'];
	$txtphtype = $row['pwd_type'];
	$txtPresentAddress = $row['present_locality'];
	$txtPresentPost = $row['present_post'];
	$city_name = $row['present_city'];
	$cmbPresentState = $row['present_state'];
	$cmbPresentDist = $row['present_district'];
	$txtPresentPin = $row['present_pin'];
	$chksameasresidential = $row['chksameasresidential'];
	$txtPermenentAddress = $row['locality'];
	$txtPermanentPost = $row['post'];
	$city_name1 = $row['city'];
	$cmbPermanentState = $row['state'];
	$cmbPermanentDist = $row['district'];
	$txtPermanentPin = $row['pin'];
	$center_name1=$row['exam_center_code'];
	$center_name2=$row['exam_center_code1'];
	$center_name3=$row['exam_center_code2'];
	$is_employed = $row['govt_emp'];
	$chkInformed=$row['informed_govt'];
	$txtNameOfOffice = $row['office_name'];
	$txtDOJ = $row['joining_date'];
	$txtNameOfPost = $row['post_name'];
	$empDisciplinary = $row['emp_debarred'];
	$txtDateOfDebar = $row['debarred_date'];
	$txtPeriodOfDebar = $row['debarred_period'];
	$txtDOJ = date("d-m-Y", strtotime($txtDOJ));
	$txtDateOfDebar = date("d-m-Y", strtotime($txtDateOfDebar));
}

$sl = 1;
foreach($academic_qual_data_temp as $row1)
{
	${'txtQualification'.$sl} = $row1['examination_name'];
	${'txtYear'.$sl} = $row1['passing_year'];
	${'txtBoard'.$sl} = $row1['university'];
	${'txtdistinct'.$sl} = $row1['class'];
	${'txtgrading'.$sl} = $row1['grading'];
	${'txtPercent'.$sl} = $row1['cgpa'];
	${'txtqual2'.$sl} = $row1['degree'];
	${'txtDivision'.$sl} = $row1['class'];
	$sl++;
}
foreach($tech_qual_data_5_temp as $row)
{
	$txtExamName1 = $row['examination_name'];
	$txtStream1 = $row['degree'];
	$txtYearQual1= $row['passing_year'];
	$txtBoardOth1 = $row['university'];
	$txtDiv1 = $row['class'];
	$txtGradingOth1 = $row['grading'];
	$txtCGPA1 = $row['cgpa'];
}
foreach($tech_qual_data_6_temp as $row)
{
	$txtExamName2 = $row['examination_name'];
	$txtYearQual2= $row['passing_year'];
	$txtStream2 = $row['degree'];
	$txtBoardOth2 = $row['university'];
	$txtCGPA2 = $row['cgpa'];
	$txtGradingOth2 = $row['grading'];
	$txtDiv2 = $row['class'];
}*/
//$dob='1981-10-07';
if($dob1 != ''){
	
$d = $dob1[2];
$m = $dob1[1];
$y = $dob1[0];
}
$txtDobDateFormat = $d.'-'.$m.'-'.$y;
$date1 = new DateTime($txtDob);
$date2 = new DateTime('2018-12-01');
$diff = $date1->diff($date2);
$age = $diff->format('%Y years,%m month,%d days');
//$age = (date('Y') - date('Y',strtotime($txtDob)));
/*echo $age;
die();*/
?>
<style>
/* Tooltip */
.tooltip > .tooltip-inner {
	background-color: rgb(252, 243, 207);
	color: #000;
	border: 1px solid black;
	    /*padding: 15px;
	    font-size: 20px;*/
	}

	/* Tooltip on top */
	.tooltip.top > .tooltip-arrow {
		border-top: 5px solid green;
	}

	/* Tooltip on bottom */
	.tooltip.bottom > .tooltip-arrow {
		border-bottom: 5px solid blue;
	}

	/* Tooltip on left */
	.tooltip.left > .tooltip-arrow {
		border-left: 5px solid red;
	}

	/* Tooltip on right */
	.tooltip.right > .tooltip-arrow {
		border-right: 5px solid black;
	} 
	.form-control {
		border-radius: 5px 5px 5px 5px;
	}
</style>

<script type="text/javascript">
	function changeCase(o){
		o.value=o.value.toUpperCase();
	}
	function isAlphaKey(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode >= 48 && charCode <= 57 
			&& (charCode >= 96 || charCode <= 105))
			return false;

		return true;
	}
	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode != 46 && charCode > 31 
			&& (charCode < 48 || charCode > 57))
			return false;

		return true;
	}
	
	function isNumberKeyInteger(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		 // alert(charCode);
		if (charCode != 8 && charCode != 37 && charCode != 39 && (charCode < 48 || charCode > 57))
		 return false;

		return true;
	}

function calculatePercentage(event)
{	
	//alert(event);
	//document.getElementById("divMessage").innerHTML = '';
	var totalMarks = 0.0;
	var securedMarks = 0.0;
	var percent = 0.0;

	
	securedMarks = document.getElementById('txtMS'+event).value;
	//alert(securedMarks);
	totalMarks = document.getElementById('txtFM'+event).value;
	if(securedMarks != '' && totalMarks != '' && totalMarks !=0)
	{
		percent = (securedMarks/totalMarks)*100;
	}
	else
	{
		percent = 0;
	}
	document.getElementById('txtPercent'+event).value = parseFloat(percent).toFixed(2);
	
}
function setSameAddress()
{
	var regex = /^([a-zA-Z0-9-\n\r \/.,();]+)$/;
	var regexPin = /^\d{6}$/;
	
	if(document.getElementById("txtPresentLocality").value == '' || document.getElementById("city_name").value == '' || document.getElementById("txtPresentPost").value == '' || document.getElementById("cmbPresentState").value == '' || document.getElementById("cmbPresentDist").value == '' || document.getElementById("txtPresentPin").value == '')
	{
		
		toastr.error("Please enter all the fields of present address");
		$('#chksameasresidential').prop('checked', false);
		return false;
	}
	else if(regex.test(document.getElementById("txtPresentLocality").value ) == false)
	{
		toastr.error("Please enter valid locality");
		$('#chksameasresidential').prop('checked', false);
		return false;
	}
	else if(regex.test(document.getElementById("city_name").value ) == false)
	{
		toastr.error("Please enter valid city");
		$('#chksameasresidential').prop('checked', false);
		return false;
	}
	else if(regex.test(document.getElementById("txtPresentPost").value ) == false)
	{
		toastr.error("Please enter valid Post");
		$('#chksameasresidential').prop('checked', false);
		return false;
	}
	else if(regexPin.test(document.getElementById("txtPresentPin").value ) == false)
	{
		toastr.error("Please enter valid pin");
		$('#chksameasresidential').prop('checked', false);
		return false;
	}
	else if(document.getElementById("chksameasresidential").checked)
	{
		$('#frmApplicantDetails').data('bootstrapValidator').updateStatus('txtPermenentLocality', 'VALID',null).validateField('txtPermenentLocality');;
		$('#frmApplicantDetails').data('bootstrapValidator').updateStatus('txtPermanentPost', 'VALID',null);
		$('#frmApplicantDetails').data('bootstrapValidator').updateStatus('cmbPermanentDist', 'VALID',null);
		/*$('#frmApply').data('bootstrapValidator').updateStatus('cand_name1', 'VALID',null);*/
		$('#frmApplicantDetails').data('bootstrapValidator').updateStatus('city_name1', 'VALID',null);
		/*$('#frmApply').data('bootstrapValidator').updateStatus('co_name1', 'VALID',null);*/
		/*$('#frmApply').data('bootstrapValidator').updateStatus('phone_no1', 'VALID',null);*/
		$('#frmApplicantDetails').data('bootstrapValidator').updateStatus('cmbPermanentState', 'VALID',null);
		$('#frmApplicantDetails').data('bootstrapValidator').updateStatus('txtPermanentPin', 'VALID',null);
		
		
		document.getElementById("txtPermenentLocality").value=document.getElementById("txtPresentLocality").value;
		document.getElementById("txtPermanentPost").value=document.getElementById("txtPresentPost").value;
		document.getElementById("cmbPermanentState").value=document.getElementById("cmbPresentState").value;
		permanentStateChange(document.getElementById("cmbPresentDist").value);
		
		/*document.getElementById("cand_name1").value=document.getElementById("cand_name").value;*/
		/*document.getElementById("co_name1").value=document.getElementById("co_name").value;*/
		document.getElementById("city_name1").value=document.getElementById("city_name").value;
		/*document.getElementById("phone_no1").value=document.getElementById("phone_no").value;*/

		document.getElementById("txtPermanentPin").value=document.getElementById("txtPresentPin").value;
		/*$('#cand_name1').attr('disabled', true);*/
		$('#city_name1').attr('disabled', true);
		/*$('#co_name1').attr('disabled', true);*/
		/*$('#phone_no1').attr('disabled', true);*/
		$('#txtPermenentLocality').attr('disabled', true);
		$('#txtPermanentPost').attr('disabled', true);
		$('#cmbPermanentDist').attr('disabled', true);
		$('#cmbPermanentState').attr('disabled', true);
		$('#txtPermanentPin').attr('disabled', true);
		$('#txtOtherPermanentState').attr('disabled', true);
		$('#txtOtherPermanentDist').attr('disabled', true);
	}
	else
	{
		
		
		document.getElementById("city_name1").value = "";
		document.getElementById("txtPermenentLocality").value = "";
		document.getElementById("txtPermanentPost").value = "";
		document.getElementById("cmbPermanentDist").value = "";
		document.getElementById("cmbPermanentState").value = "";
		document.getElementById("txtPermanentPin").value = "";
		$("#forStatePermanent").hide();
		$("#forDistPermanent").hide();
		$('#city_name1').removeAttr('disabled', false);
		$('#txtPermenentLocality').removeAttr('disabled', false);
		$('#txtPermanentPost').removeAttr('disabled', false);
		$('#cmbPermanentDist').removeAttr('disabled', false);
		$('#cmbPermanentState').removeAttr('disabled', false);
		$('#txtPermanentPin').removeAttr('disabled', false);
		$('#txtOtherPermanentState').removeAttr('disabled', false);
		$('#txtOtherPermanentDist').removeAttr('disabled', false);
		$('#frmApplicantDetails').data('bootstrapValidator').updateStatus('txtPermenentLocality', 'NOT_VALIDATED',null).validateField('txtPermenentLocality');
		$('#frmApplicantDetails').data('bootstrapValidator').updateStatus('txtPermanentPost', 'NOT_VALIDATED',null).validateField('txtPermanentPost');
		$('#frmApplicantDetails').data('bootstrapValidator').updateStatus('cmbPermanentDist', 'NOT_VALIDATED',null).validateField('cmbPermanentDist');
		$('#frmApplicantDetails').data('bootstrapValidator').updateStatus('city_name1', 'NOT_VALIDATED',null).validateField('city_name1');
		$('#frmApplicantDetails').data('bootstrapValidator').updateStatus('cmbPermanentState', 'NOT_VALIDATED',null).validateField('cmbPermanentState');
		$('#frmApplicantDetails').data('bootstrapValidator').updateStatus('txtPermanentPin', 'NOT_VALIDATED',null).validateField('txtPermanentPin');
	
	}
}


function validate(){
	
	var errorMessage = "";
	var message='<div>';
	var d=document.getElementById("cmbDay").value;
	//alert(d);
	var m=document.getElementById("cmbMonth").value;
	//alert(m);
	var y=document.getElementById("cmbYear").value;
	var dobInWord=dateToWord(d,m,y);
	//alert(dobInWord);
	document.getElementById("hidDate").value=dobInWord;
	qualification5 = document.getElementById("txtQualification5").value;
	if(document.getElementById("hidCatElig").value == '0')
	{
		document.getElementById("#cmbCommunity").value = '';
		swal({
			title: "Sorry",
			text: "You are not eligible to apply this program under the selected category",
			type: "error"
		},
		function(isConfirm) {
		  if (isConfirm) {
		  	return false;	 
		  	//window.location.href = ("<?php echo base_url() ?>index/institute_login/ins/<?php echo $ins; ?>");
		  }
		});
	};
	//alert(document.getElementById('txtFatherName').value); txtidproof
	if ((document.getElementById('txtMotherName').value == '') || (document.getElementById('radiomale').checked == false && 
		document.getElementById('radiofemale').checked == false && document.getElementById('radiotrans').checked == false ) || 
		((document.getElementById("txtidproof").value == '') ) || ((document.getElementById('radioPhysicallYY').checked) && 
		(document.getElementById("cmbPH").value == "")) || ((document.getElementById("chksameasresidential").checked  == false) 
		&& ((document.getElementById("txtPermanentPin").value == '') || (document.getElementById("city_name").value == '') || 
		(document.getElementById("cmbPermanentState").value == '') || (document.getElementById("cmbPermanentDist").value == '') || 
		(document.getElementById("txtPermanentPost").value == '') || (document.getElementById("txtPermenentLocality").value == '')))
		|| (document.getElementById("txtPresentPin").value == '') || (document.getElementById("city_name").value == '') || 
		(document.getElementById("cmbPresentState").value == '') || (document.getElementById("cmbPresentDist").value == '') || 
		(document.getElementById("txtPresentPost").value == '') || (document.getElementById("txtPresentLocality").value == '') || 
		(document.getElementById('txtFatherName').value == '') || (document.getElementById('txtMotherName').value == '') || 
		(document.getElementById('cmbCommunity').value == null) ||  (document.getElementById('radioPhysicallYN').checked == false && 
		document.getElementById('radioPhysicallYY').checked == false) || (document.getElementById('radioSportsY').checked == false 
		&& document.getElementById('radioSportsN').checked == false) || (document.getElementById('radioServiceY').checked == false 
		&& document.getElementById('radioServiceN').checked == false) || (document.getElementById('cmbCommunity').value == '' || 
		document.getElementById('cmbCommunity').value == null) ) {
		var str = "Please enter - ";
		/*if((document.getElementById('cmbExamCenter').value == ''))
		{
			str += " exam center,";
		}*/
		if((document.getElementById('txtFatherName').value == ''))
		{
			str += " father name,";
		}
		if((document.getElementById('radiomale').checked == false && document.getElementById('radiofemale').checked == false && document.getElementById('radiotrans').checked == false))
		{
			str += " gender,";
		}
		if((document.getElementById('txtMotherName').value == ''))
		{
			str += " mother name,";
		}
		if(((document.getElementById("txtidproof").value == '') ))
		{
			str += " aadhaar number,";
		}
		if((document.getElementById('cmbCommunity').value == '' || document.getElementById('cmbCommunity').value == null))
		{
			str += " category,";
		}/*
		if((document.getElementById('cmbHomeDist').value == '' || document.getElementById('cmbHomeDist').value == null))
		{
			str += " home district,";
		}*/
		if((document.getElementById('radioPhysicallYN').checked == false && document.getElementById('radioPhysicallYY').checked == false))
		{
			str += " PwD,";
		}
		if(((document.getElementById('radioPhysicallYY').checked) && (document.getElementById("cmbPH").value == "")))
		{
			str += " PwD,";
		}
		if((document.getElementById('radioSportsY').checked == false && document.getElementById('radioSportsN').checked == false))
		{
			str += " Sports,";
		}
		if((document.getElementById('radioServiceY').checked == false && document.getElementById('radioServiceN').checked == false))
		{
			str += " Ex-Serviceman,";
		}
		/*if((document.getElementById('radioComputerY').checked == false && document.getElementById('radioComputerY').checked == false))
		{
			str += " Computer Education,";
		}*/
		if((document.getElementById("txtPresentPin").value == '') || (document.getElementById("city_name").value == '') || (document.getElementById("cmbPresentState").value == '') || (document.getElementById("cmbPresentDist").value == '') || (document.getElementById("txtPresentPost").value == '') || (document.getElementById("txtPresentLocality").value == ''))
		{
			str += " all details of present address,";
		}
		if(((document.getElementById("chksameasresidential").checked  == false) && ((document.getElementById("txtPermanentPin").value == '') || (document.getElementById("city_name").value == '') || (document.getElementById("cmbPermanentState").value == '') || (document.getElementById("cmbPermanentDist").value == '') || (document.getElementById("txtPermanentPost").value == '') || (document.getElementById("txtPermenentLocality").value == ''))))
		{
			str += " all details of permanent address,";
		}
		var str = str.substring(0, str.length - 1);
		errorMessage += str;
		errorMessage += " in Applicant Details Tab.<br/>";
	}
	
	var qual_array='<?=$qualification_array_size?>';
	//quali_length = qual_array.length;
	//alert(quali_length);return false;
	/*str2='';
	for(i=1;i<=qual_array;i++){
		if((document.getElementById("txtQualification"+i).value == '') ||  (document.getElementById("txtYear"+i).value == '') || (document.getElementById("txtBoard"+i).value == '') || (document.getElementById("txtdistinct"+i).value == '') || (document.getElementById("txtgrading"+i).value == '') || (document.getElementById("txtPercent"+i).value == ''))
		//if((document.getElementById("txtQualification"+i).value == '') || (document.getElementById("txtqual2"+i).value == '') )
		{
			str2 += 'Enter '+document.getElementById("txtQualification"+i).value+ ' details,';
		}
		
	}
	if(str2!=''){
		var str2 = str2.substring(0, str2.length - 1);
		errorMessage += str2;
		errorMessage += " in Academic Details Tab.<br/>";
	}*/
	if(document.getElementById("txtExamName1").value != '' )
	{
		if((document.getElementById("txtStream1").value == '') || (document.getElementById("txtYearQual1").value == '') || (document.getElementById("txtDiv1").value == '') || (document.getElementById("txtBoardOth1").value == '') || (document.getElementById("txtGradingOth1").value == '') || (document.getElementById("txtCGPA1").value == '') )
		{
			errorMessage += 'Enter all the details of '+document.getElementById("txtExamName1").value+ ' in other qualification<br/>';
		}
	}
	if(document.getElementById("txtExamName2").value != '' )
	{
		if((document.getElementById("txtStream2").value == '') || (document.getElementById("txtYearQual2").value == '') || (document.getElementById("txtDiv2").value == '') || (document.getElementById("txtBoardOth2").value == '') || (document.getElementById("txtGradingOth2").value == '') || (document.getElementById("txtCGPA2").value == '') )
		{
			errorMessage += 'Enter all the details of '+document.getElementById("txtExamName2").value+ ' in other qualification<br/>';
		}
	}
	
	if((document.getElementById('empDisciplinaryno').checked == false && document.getElementById('empDisciplinaryyes').checked == false) || ((document.getElementById('empDisciplinaryyes').checked) && ((document.getElementById("txtPeriodOfDebar").value == "") || (document.getElementById("txtDateOfDebar").value == "") )) || (document.getElementById('empGovtyes').checked == false && document.getElementById('empGovtno').checked == false) || ((document.getElementById('empGovtyes').checked) && ((document.getElementById("txtNameOfOffice").value == "") || (document.getElementById("txtNameOfPost").value == "") || (document.getElementById("txtDOJ").value == "") )) )
	{
		//errorMessage += "One / Some mandatory fields are not entered in Information Tab.<br/>";
		var str = "Please enter - ";
		 
		if((document.getElementById('empGovtyes').checked == false && document.getElementById('empGovtno').checked == false))
		{
			str += " working under Govt.,";
		}
		if(((document.getElementById('empGovtyes').checked)))
		{
			if((document.getElementById("txtNameOfOffice").value == ""))
			{
				str += " name of office,";
			}
			if((document.getElementById("txtNameOfPost").value == ""))
			{
				str += " name of post,";
			}
			if((document.getElementById("txtDOJ").value == ""))
			{
				str += " date of joining,";
			}
		}
		if((document.getElementById('empDisciplinaryno').checked == false && document.getElementById('empDisciplinaryyes').checked == false))
		{
			str += " debarred,";
		}
		if(((document.getElementById('empDisciplinaryyes').checked)))
		{
			if((document.getElementById("txtPeriodOfDebar").value == ""))
			{
				str += " period of debarrment,";
			}
			if((document.getElementById("txtDateOfDebar").value == ""))
			{
				str += " date of debarrment,";
			}
		}
		
		var str = str.substring(0, str.length - 1);
		errorMessage += str;
		errorMessage += " in Information Tab.<br/>";
	}
	
	if(parseInt(document.getElementById("txtYear1").value) > parseInt(document.getElementById("txtYear2").value ))
	{
		errorMessage += "Senior Secondary Qualification Year must be greater then Secondary Qualification Year<br/>";
	}
	if(parseInt(document.getElementById("txtYear2").value) > parseInt(document.getElementById("txtYear3").value ))
	{
		errorMessage += "Graduation Qualification Year must be greater then Secondary Qualification Year<br/>";
	}
	
	if(document.getElementById("txtgrading1").value == 'YES')
	{
		var totalMarkX=document.getElementById("txtPercent1").value;
		var numX = parseFloat(totalMarkX);
		if(numX > 10.00)
			errorMessage += "CGPA in Class X should be less than 10.<br>";
	}
	else if(document.getElementById("txtgrading1").value == 'NO')
	{
		var totalMarkX=document.getElementById("txtPercent1").value;
		
		var mX = parseFloat(totalMarkX);
		//alert(mx);
		if(mX > 100.00)
		{
			errorMessage += "Percentage of Mark in Class X should be less than 100.<br>";
		}
	}
	if (document.getElementById('radioPhysicallYY').checked) {
	  	if(document.getElementById('cmbPH').value == '')
	  	{
			errorMessage += "Select the PwD Type.<br/>";
		}
	}
	if(document.getElementById("txtgrading2").value == 'YES')
	{
		var totalMarkX=document.getElementById("txtPercent2").value;
		var numX = parseFloat(totalMarkX);
		if(numX > 10.00)
			errorMessage += "CGPA in Class 12th should be less than 10.<br>";
	}
	else if(document.getElementById("txtgrading2").value == 'NO')
	{
		var totalMarkX=document.getElementById("txtPercent2").value;
		
		var mX = parseFloat(totalMarkX);
		//alert(mx);
		if(mX > 100.00)
		{
			errorMessage += "Percentage of Mark in Class 12th should be less than 100.<br>";
		}
	}
	if(document.getElementById("txtgrading3").value == 'YES')
	{
		var totalMarkX=document.getElementById("txtPercent3").value;
		var numX = parseFloat(totalMarkX);
		if(numX > 10.00)
			errorMessage += "CGPA in Diploma should be less than 10.<br>";
	}
	
	else if(document.getElementById("txtgrading3").value == 'NO')
	{
		var totalMarkX=document.getElementById("txtPercent3").value;
		
		var mX = parseFloat(totalMarkX);
		//alert(mx);
		if(mX > 100.00)
		{
			errorMessage += "Percentage of Mark in Diploma should be less than 100.<br>";
		}
	}
	
	if(document.getElementById("txtgrading4").value == 'YES')
	{
		var totalMarkX=document.getElementById("txtPercent4").value;
		var numX = parseFloat(totalMarkX);
		if(numX > 10.00)
			errorMessage += "CGPA in Graduation should be less than 10.<br>";
	}
	else if(document.getElementById("txtgrading4").value == 'NO')
	{
		var totalMarkX=document.getElementById("txtPercent4").value;
		
		var mX = parseFloat(totalMarkX);
		//alert(mx);
		if(mX > 100.00)
		{
			errorMessage += "Percentage of Mark in Graduation should be less than 100.<br>";
		}
	}
	
	
	//alert(errorMessage);
	if(errorMessage != "")
	{
		message += errorMessage + "</div>";
		//alertmessage.innerHTML = message;
		document.getElementById("alertmessage").innerHTML=message;
		$('.alert').show();
		document.getElementById('alertmessage').focus();
		window.scrollTo(0, 0);
		return false;	 
	}
	else
		return true;
}//alert(errorMessage);
function dateToWord(d,m,y)
{
	var wDays=['First','Second','Third','Fourth','Fifth','Sixth','Seventh','Eighth','Ninth','Tenth','Eleventh','Twelfth','Thirteenth','Fourteenth','Fifteenth','Sixteenth','Seventeenth','Eighteenth','Nineteenth','Twentieth','Twenty-first','Twenty-second','Twenty-third','Twenty-fourth','Twenty-fifth','Twenty-sixth','Twenty-seventh','Twenty-eighth','Twenty-ninth','Thirtieth','Thirty-first']

	var wMonths=['January','February','March','April','May','June','July','August','September','October','November','December']
	var wNumbers=['Zero','One','Two','Three','Four','Five','Six','Seven','Eight','Nine','Ten','Eleven','Twelve','Thirteen','Fourteen','Fifteen','Sixteen','Seventeen','Eighteen','Nineteen','Twenty','Twentyone','Twentytwo','Twentythree','Twentyfour','Twentyfive','Twentysix','Twentyseven','Twentyeight','Twentynine','Thirty','Thirtyone','Thirtytwo','Thirtythree','Thirtyfour','Thirtyfive','Thirtysix','Thirtyseven','Thirtyeight','Thirtynine','Fourty',
	'Fourtyone','Fourtytwo','Fourtythree','Fourtyfour','Fourtyfive','Fourtysix','Fourtyseven','Fourtyeight','Fourtynine','Fifty','Fiftyone','Fiftytwo','Fiftythree','Fiftyfour','Fiftyfive','Fiftysix','Fiftyseven','Fiftyeight','Fiftynine','Sixty','Sixtyone','Sixtytwo','Sixtythree','Sixtyfour','Sixtyfive','Sixtysix','Sixtyseven','Sixtyeight','Sixtynine','Seventy',
	'Seventyone','Seventytwo','Seventythree','Seventyfour','Seventyfive','Seventysix','Seventyseven','Seventyeight','Seventynine','Eighty','Eightyone','Eightytwo','Eightythree','Eightyfour','Eightyfive','Eightysix','Eightyseven','Eightyeight','Eightynine','Ninety','Ninetyone','Ninetytwo','Ninetythree','Ninetyfour','Ninetyfive','Ninetysix','Ninetyseven','Ninetyeight','Ninetynine']
	var dt1   = parseInt(d);
	//alert(dt1);
	var mon1  = parseInt(m);
	//alert(mon1);
	var yr1   = parseInt(y);
	var year = y.toString(); 

	var x=year.charAt(0)
	var xx=year.charAt(1)
	var xxx=year.charAt(2)
	var xxxx=year.charAt(3)
	
	var a=  parseInt(x+xx);
	if(xxx == '0')
	{
		var b=parseInt(xxx);
		var c=parseInt(xxxx);
		var dateInWord=wDays[dt1-1]+' '+wMonths[mon1-1]+' '+wNumbers[a]+' '+wNumbers[b]+' '+wNumbers[c];
	}
	else
	{
		var b=parseInt(xxx+xxxx);
		var dateInWord=wDays[dt1-1]+' '+wMonths[mon1-1]+' '+wNumbers[a]+' '+wNumbers[b];
	}
	return dateInWord;
}

</script>



<style>
		/*.dataTables_scrollHeadInner {
			width:100% !important;
		}
		.dataTable {
			width:100% !important;
		}
		#dtblPromoter {
			width:100% !important;
		}*/
		ul { padding-left:20px; list-style:none; }
		.news li { margin-bottom:35px; font-size:19px;}
		.news li:before {    
			font-family: 'FontAwesome';
			content: "\f101";
			margin:0 5px 0 -15px;
			color:#9D426B;
			font-size:19px;
		}
		label {
		    font-weight: normal !important;
		}
		
		.panel.with-nav-tabs .panel-heading{
		    padding: 5px 5px 0 5px;
		}
		.panel.with-nav-tabs .nav-tabs{
			border-bottom: none;
		}
		.panel.with-nav-tabs .nav-justified{
			margin-bottom: -1px;
		}

		/********************************************************************/
		/*** PANEL PRIMARY ***/
		.with-nav-tabs.panel-primary .nav-tabs > li > a,
		.with-nav-tabs.panel-primary .nav-tabs > li > a:hover,
		.with-nav-tabs.panel-primary .nav-tabs > li > a:focus {
		    color: #fff;
		}
		.with-nav-tabs.panel-primary .nav-tabs > .open > a,
		.with-nav-tabs.panel-primary .nav-tabs > .open > a:hover,
		.with-nav-tabs.panel-primary .nav-tabs > .open > a:focus,
		.with-nav-tabs.panel-primary .nav-tabs > li > a:hover,
		.with-nav-tabs.panel-primary .nav-tabs > li > a:focus {
			color: #fff;
			background-color: #3071a9;
			border-color: transparent;
		}
		.with-nav-tabs.panel-primary .nav-tabs > li.active > a,
		.with-nav-tabs.panel-primary .nav-tabs > li.active > a:hover,
		.with-nav-tabs.panel-primary .nav-tabs > li.active > a:focus {
			color: #428bca;
			background-color: #fff;
			border-color: #428bca;
			border-bottom-color: transparent;
		}
		 .nav-tabs > li.active > a,
		.nav-tabs > li.active > a:hover,
		.nav-tabs > li.active > a:focus {
			 border-bottom: 2px solid #f62d51;
		    color: #f62d51;
		}
		.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu {
		    background-color: #428bca;
		    border-color: #3071a9;
		}
		.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a {
		    color: #fff;   
		}
		.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
		.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
		    background-color: #3071a9;
		}
		.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a,
		.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
		.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
		    background-color: #4a9fe9;
		}
		.nav-tabs > li > a {
		  margin-right: 2px;
		  line-height: 1.42857143;
		  border: 0px solid transparent;
		  border-radius: 0px 0px 0 0;
		  color: #7fc372; 
		}
		.nav-tabs > li.active > a,
		.nav-tabs > li.active > a:hover,
		.nav-tabs > li.active > a:focus {
		  color: #f62d51;
		  cursor: default;
		  background-color: #fff;
		  border: 1px solid #fff;
		  border-bottom: 2px solid #f62d51;
		}
		.nav > li > a:hover, .nav > li > a:active, .nav > li > a:focus {
		    color: #444;
		    background: #fff;
		}
		
		.btn-warning:hover{
			color: #fff;
			background-color: #ffb27a;
		    border-color: #ffb27a;
		 
		}
		.btn-warning:focus,
		.btn-warning:active,
		.btn-warning.active,
		.btn-warning {
		  	color: #fff;
		     background-color: #ff8260;
		  border-color: #ff8260;
		}
		
		.btn-primary:hover{
		  color: #fff;
		  background-color: #7a3b2c;
		  border-color: #7a3b2c;
		}
		.btn-primary:focus,
		.btn-primary:active,
		.btn-primary.active,
		.btn-primary {
		   color: #fff;
		  background-color: #0d87b8;
			border-color: #0d87b8;
		}
		/********************************************************************/
		#tooltip {
		  position: relative;
		  display: inline-block;
		  border-bottom: 1px dotted black;
		}

		#tooltip .tooltiptext {
		  visibility: hidden;
		  width: 120px;
		  background-color: black;
		  color: #fff;
		  text-align: center;
		  border-radius: 6px;
		  padding: 5px 0;

		   /*Position the tooltip */
		  position: absolute;
		  z-index: 1;
		}

		#tooltip:hover .tooltiptext {
		  visibility: visible;
		}
		.customtab li a.nav-link:hover {
  		 	 color: #5ec58c;
			}
		 li .nav-item.active, {
		    border-bottom: 2px solid #5ec58c;
		    color: #5ec58c;
		}
		
		fieldset {
		    min-width: 0;
		    padding: 15px;
		    margin: 0;
		    border: 1px solid black;
		    border-color:#f2c1a4;
			margin-top: 10px;
		}
		legend{
			width: auto;
			border-bottom: 0px;
			color:#fff;
			background: linear-gradient(to left, #ffb27a 30%, #ff805f 100%);
			border-radius: 6px;
			text-align: center;
			padding: 7px;
		
		}
		.btn-pink{
			    background-color: #f7bcbc;
			    border: 1px solid #b9b9b9;
			    border-radius: 20px;
			    color: #000;
		}
		.help-block {
		    display: block;
		    margin-top: 5px;
		    margin-bottom: 10px;
		    color: #dd4b39;
		}
		.background{
			 padding-bottom: 50px;
			 background: linear-gradient(to bottom, #c5875a 0%, #ffb27a45 20%,#fff 100%);
		}
		@media (max-width: 990px)
		{
			.background{
				 padding-bottom: 50px;
				 background: unset;
			}
			.pad{
				margin-left: -30px;
    			margin-right: -30px;
			}
		}
	</style>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.css" />
<div class="container-fluid" style=" padding-bottom: 50px;">

	<div class="row background"  >
		<div class="hidden-xs hidden-sm col-md-1 col-lg-1 col-xl-1" style="margin-top: 15%; margin-left: -15px;margin-right: 15px;">
			<?php include('sidebar/sidebar.php'); ?>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
			<div class="panel-body"> 
					<?php if($this->session->flashdata('info')): ?>
						<div class="alert1 alert-success">
							<!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
							<?php echo $this->session->flashdata('info'); ?>
						</div>
					<?php endif; ?>

					<?php if($this->session->flashdata('error')): ?>
						<div class="alert1 alert-danger">
							<!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
							<?php echo $this->session->flashdata('error'); ?>
						</div>
					<?php endif; ?>
					<div id="page-wrapper" style="padding-top: 80px;">
						<div class="row">
							<br />
							<div class="hidden-xs col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
							<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-xl-10 fpad">	
								<?php 
								$ins = encrypt_decrypt('encrypt',$institute_code);
								if($edit == 'true') 
								{ 
									if($appl_status == 'Student Details Submitted') 
									{ 
										?>
										
										<button type="button" onclick="window.location.href = '<?=base_url()?>apply/template002/ins/<?=$ins?>/edit/<?=$edit_status?>';"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style="background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
											<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
												Profile Details <span class="badge"> &raquo;</span>
											</div>
											<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Profile Details" data-placement="top" data-toggle="tooltip">
												1 <span class="badge"> &raquo;</span>
											</div>
										</button>

										<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
										
										<button type="button" onclick="window.location.href = '<?=base_url()?>apply/apply_3/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style="background-color: #E9CDCD;border: 1px solid #E9CDCD; border-radius: 5px;color: black">
											<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
												Document Upload <span class="badge"> &raquo;</span>
											</div>
											<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl" title="Document Upload" data-placement="top" data-toggle="tooltip" >
												2 <span class="badge"> &raquo;</span>
											</div>
										</button>

										<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
										
										<button type="button" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg"  style="background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px;color: black">
											<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
												Payment
											</div>
											<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Payment" data-placement="top" data-toggle="tooltip"> 
												3 
												<!--<span class="tooltiptext">Payment</span>-->
											</div>
										</button>
										
										<!--<a href="<?=base_url()?>apply/template002/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
										<a href="<?=base_url()?>apply/apply_3/ins/<?=$ins?>" ><img src="<?=base_url()?>public/assets/images/documentupload1.png" /></a>
										<img src="<?=base_url()?>public/assets/images/payment1.png" />-->

										<?php 
									} 
									else if($appl_status == 'Document Uploaded' || $appl_status == 'Challan Generated' ) 
									{ 
										?>
										<button type="button" onclick="window.location.href = '<?=base_url()?>apply/template002/ins/<?=$ins?>/edit/<?=$edit_status?>';"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style="background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
											<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
												Profile Details <span class="badge"> &raquo;</span>
											</div>
											<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Profile Details" data-placement="top" data-toggle="tooltip">
												1 <span class="badge"> &raquo;</span>
											</div>
										</button>

										<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
										
										<button type="button" onclick="window.location.href = '<?=base_url()?>apply/apply_3/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style="background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
											<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
												Document Upload <span class="badge"> &raquo;</span>
											</div>
											<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl" title="Document Upload" data-placement="top" data-toggle="tooltip" >
												2 <span class="badge"> &raquo;</span>
											</div>
										</button>

										<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
										
										<button type="button" onclick="window.location.href = '<?=base_url()?>apply/apply_4/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg"  title="Payment" data-placement="top" data-toggle="tooltip" style="background-color: #E9CDCD;border: 1px solid #E9CDCD; border-radius: 5px;color: black">
											<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
												Payment
											</div>
											<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"> 
												3 
												<!--<span class="tooltiptext">Payment</span>-->
											</div>
										</button>
										
										<!--<a href="<?=base_url()?>apply/template002/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
										<a href="<?=base_url()?>apply/apply_3/ins/<?=$ins?>" ><img src="<?=base_url()?>public/assets/images/documentupload.png" /></a>
										<a href="<?=base_url()?>apply/apply_4/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/payment1.png" /></a>-->

										<?php 
									} 
									else if($appl_status == 'Fee Paid' || $appl_status == 'Verified') 
									{ 
										?>
										<button type="button" onclick="window.location.href = '<?=base_url()?>apply/template002/ins/<?=$ins?>/edit/<?=$edit_status?>';"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style="background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
											<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
												Profile Details <span class="badge"> &raquo;</span>
											</div>
											<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Profile Details" data-placement="top" data-toggle="tooltip">
												1 <span class="badge"> &raquo;</span>
											</div>
										</button>

										<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
										
										<button type="button" onclick="window.location.href = '<?=base_url()?>apply/apply_3/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style="background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
											<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
												Document Upload <span class="badge"> &raquo;</span>
											</div>
											<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl" title="Document Upload" data-placement="top" data-toggle="tooltip" >
												2 <span class="badge"> &raquo;</span>
											</div>
										</button>

										<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
										
										<button type="button" onclick="window.location.href = '<?=base_url()?>apply/apply_4/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg"  title="Payment" data-placement="top" data-toggle="tooltip" style="background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
											<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
												Payment
											</div>
											<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"> 
												3 
												<!--<span class="tooltiptext">Payment</span>-->
											</div>
										</button>

										
										<?php 
									}  
								}
								else //edit = false
								{ 
									?>
										<button type="button" onclick="window.location.href = '<?=base_url()?>apply/template002/ins/<?=$ins?>/edit/<?=$edit_status?>';"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style="background-color: #E9CDCD;border: 1px solid #E9CDCD; border-radius: 5px;color: black">
											<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
												Profile Details <span class="badge"> &raquo;</span>
											</div>
											<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Profile Details" data-placement="top" data-toggle="tooltip">
												1 <span class="badge"> &raquo;</span>
											</div>
										</button>
										<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
										<button type="button" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style="background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px;color: black">
											<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
												Document Upload <span class="badge"> &raquo;</span>
											</div>
											<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl" title="Document Upload" data-placement="top" data-toggle="tooltip" >
												2 <span class="badge"> &raquo;</span>
											</div>
										</button>
										<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
										<button type="button" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg"  title="Payment" data-placement="top" data-toggle="tooltip" style="background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px;color: black">
											<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
												Payment
											</div>
											<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"> 
												3 
												<!--<span class="tooltiptext">Payment</span>-->
											</div>
										</button>
										
										
									<?php 
								} 
								?>
							</div>
							<div class="hidden-xs col-sm-1 col-md-1 col-lg-1 col-xl-1"> 	</div>
						</div>
						<br />
						<div class="row">
						<div class="col-lg-12 pad">
							<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;"> <!-- Alert for error -->
								<div id="alertmessage"></div>
							</div>
							<div class="panel with-nav-tabs">
								<div class="col-lg-12 col-md-12 col-xs-8 "> 
				                    <div class="card" id="tabs">
				                        <ul class="nav nav-tabs customtab" role="tablist" >
				                            <li class="nav-item active"> <a class="nav-link "  id="tab_a" data-toggle="tab" href="#address_tab" role="tab" aria-selected="true"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Applicant Details</span></a> </li>
				                            <li class="nav-item" id="tab_b"> <a class="nav-link" data-toggle="tab" href="#academic_tab" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Academic Details</span></a> </li>
				                            <li class="nav-item" id="tab_c"> <a class="nav-link" data-toggle="tab" href="#info_tab" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Information</span></a> </li>
				                            <li class="nav-item" id="tab_d"> <a class="nav-link" data-toggle="tab" href="#declaration_tab" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Declaration</span></a> </li>
				                        </ul>
				                    </div>
				                </div>
					            <span class="pull-right post-name" style="margin-top:10px;margin-right: 10px;margin-bottom: 10px;margin-left: 15px;">
				                <b style="color: #37806c;"><?php echo $admname; ?></b></span>       
					                
									
									
									<div class="panel-body" style="box-shadow: 1px 4px 7px black;">
										<!--<form action="" method="post" id="frmApply" name="frmApply">-->
											<div class="tab-content">
											
												<input type="hidden" id="hidEditStatus" name="hidEditStatus" value="<?php echo $edit_status; ?>"/>
												<!-- first tab-->
											
												<div class="tab-pane in active" id="address_tab">
													<form action="" method="post" id="frmApplicantDetails" name="frmApplicantDetails">
														<div>
															<input type="hidden" name="hidCatElig" id="hidCatElig" >
															<input type="hidden" name="hidInsCode" id="hidInsCode" value="<?php echo $ins; ?>">
															<input type="hidden" name="hidApplStatus" id="hidApplStatus" value="<?php echo $appl_status; ?>">
															<input type="hidden" name="hidDate" id="hidDate" >
															<input type="hidden" name="hiddenPost" id="hiddenPost" value="<?php echo $postname;  ?>"><!--
															<input type="hidden" name="hidNotEligCodes" id="hidNotEligCodes" value="<?php echo $post_codes_noteligible;  ?>">
															<input type="hidden" name="hidNotEligNames" id="hidNotEligNames" value="<?php echo $post_names_noteligible;  ?>">-->
															<input type="hidden" name="hidprogram" id="hidprogram" value="<?php echo $admcode;  ?>"> 
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px;margin-top: 10px;">
															 <fieldset class=""> 
															    <legend>Multiple Post</legend>
															    <div class="col-lg-12">
																	<label for="" class="col-lg-3" style="font-size: 15px;"><i class="fa fa-user" style="color:#E4791A"></i> Select Post</label>
																	<div class="col-sm-4">
																		<select class="form-control"  name="cmbPostSelect[]" title="Select Post" id="cmbPostSelect" multiple="multiple">
																		</select>
																	</div>
																</div>
															    
														     </fieldset>    
																<fieldset class="">
																<legend>Personal Details</legend>
																<!--<h3 style="text-align: center;margin-top: -6px;color: #666;"> Personal Details</h3>-->
																<!--<div style="width: 100%; height: 20px; border-bottom: 1px solid #c2b7b7; text-align: center">
																  <span style="font-size: 16px;  padding: 0 10px;">
																    <b>Personal Details</b> 
																  </span>
																</div>-->
																<!--<hr style="margin-top: 10px;margin-bottom: 16px;border-color: #aabdce;" />-->
																
																<!--************START OF NAME ROW**********--> 
															
																<div class="row" style="margin-top: 20px;">
																	<div class="col-lg-4">
																		<div class="form-group">
																			<label for="" class="col-lg-5" ><i class="fa fa-user" style="color:#E4791A"></i> First Name</label>
																			<div class="col-lg-7">
																				<input type="text" class="form-control" id="txtFirstName" name="txtFirstName" placeholder="Enter First Name" readonly="readonly"  value="<?=strtoupper($txtFirstName)?>" <?php echo $show==1?'disabled':''; ?>>
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-4">
																		<div class="form-group">
																			<label for="" class="col-lg-5" ><i class="fa fa-user" style="color:#E4791A"></i> Middle Name</label>
																			<div class="col-lg-7">
																				<input type="text" class="form-control test" id="txtMiddleName" name="txtMiddleName" placeholder="Enter Middle Name" readonly="readonly" value="<?=strtoupper($txtMiddleName)?>" <?php echo $show==1?'disabled':''; ?>>
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-4">
																		<div class="form-group">
																			<label for="" class="col-lg-5" ><i class="fa fa-user" style="color:#E4791A"></i> Last Name</label>
																			<div class="col-lg-7">
																				<input type="text" class="form-control" id="txtLastName" name="txtLastName" placeholder="Enter Last Name"  value="<?=strtoupper($txtLastName)?>" readonly="readonly" <?php echo $show==1?'disabled':''; ?>>
																			</div>
																		</div>
																	</div>
																</div>
																
																<div  class="row"  style="margin-top: 20px;">
																	
																	<div class="col-lg-6">
																		<div class="form-group">
																			<label for="" class="col-lg-5" style=""><i style="color:red;font-size:18px;">*</i> <i class="fa fa-male" aria-hidden="true" style="color:#E4791A"></i> Father's/Husband's Name </label>
																			<div class="col-lg-7">
																				<input type="text" class="form-control" id="txtFatherName" name="txtFatherName" placeholder="Enter Father's/Husband's Name" onkeyup="changeCase(this)" maxlength="50" value="<?=strtoupper($txtFatherName)?>" <?php echo $show==1?'disabled':''; ?>>
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-6">
																		<div class="form-group">
																			<label for="" class="col-lg-5" style=""><i style="color:red;font-size:18px;">*</i> <i class="fa fa-male" aria-hidden="true" style="color:#E4791A"></i> Mother's Name </label>
																			<div class="col-lg-7">
																				<input type="text" class="form-control" id="txtMotherName" name="txtMotherName" placeholder="Enter Mother's Name" onkeyup="changeCase(this)" maxlength="50" value="<?=strtoupper($MothersName)?>" <?php echo $show==1?'disabled':''; ?>>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="row" style="margin-top: 20px;">
																	<div class="col-lg-6">
																		<div class="form-group">
																			<label for="txtDOB" class="col-lg-5" style="text-align:left;"><i class="fa fa-birthday-cake" aria-hidden="true" style="color:#E4791A"></i> Date Of Birth</label>
																			<div class="col-lg-7">
																				
																				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
																					<input type="text" class="form-control" id="cmbDay" name="cmbDay"  disabled="disabled" title="Day" data-placement="top" data-toggle="tooltip" value="<?php echo $d; ?>">
																				</div>
																				
																				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
																					<input type="text" class="form-control" id="cmbMonth" name="cmbMonth"  disabled="disabled" title="Month" data-placement="top" data-toggle="tooltip" value="<?php echo $m; ?>"> 
																				</div>
																				
																				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
																					<input type="text" class="form-control" id="cmbYear" name="cmbYear"  disabled="disabled" title="Year" data-placement="top" data-toggle="tooltip" value="<?php echo $y; ?>">
																				</div>
																				
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-6">
																		<div class="form-group" >
																			<label for="" class="col-lg-5 control-label"  ><i style="color:red;font-size:18px;">*</i> <i class="fa fa-venus-mars" aria-hidden="true" style="color:#E4791A;"></i> Gender</label>
																			<div class="col-lg-7">
																				<label class="radio-inline">
																					<input type="radio" name="radiogender" id="radiomale" value="M" <?php if($radiogender=="M") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Male
																				</label>
																				<label class="radio-inline">
																					<input type="radio" name="radiogender" id="radiofemale" value="F" <?php if($radiogender=="F") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Female
																				</label>
																				<label class="radio-inline">
																					<input type="radio" name="radiogender" id="radiotrans" value="T" <?php if($radiogender=="T") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Transgender
																				</label>

																			</div>
																		</div>
																	</div>
																
																	<!--<div class="col-lg-6">
																		<div class="form-group">
																			<label for="" class="col-lg-5" style="">&nbsp;&nbsp;<i class="fa fa-birthday-cake" aria-hidden="true" style="color:#E4791A"></i> Age (as on 01-12-2018)</label>
																			<div class="col-lg-7">
																				<input type="hidden" class="form-control" id="txtemailid" name="txtemailid" maxlength="250"  value="<?=$txtEmailId?>" >
																				<input type="text" class="form-control" id="txtAge" name="txtAge" maxlength="250" disabled=""  value="<?=$age?>" data-placement="top" data-toggle="tooltip">
																			</div>
																		</div>
																	</div>-->
																</div>
																<div  class="row"  style="margin-top: 20px;margin-left: -2%;">
																	<div class="col-lg-6">
																		<div class="form-group">
																			<label for="" class="col-lg-5" style="m">&nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i> <i class="fa fa-credit-card" aria-hidden="true" style="color:#E4791A"></i> ID Proof.</label>
																			<div class="col-lg-7">
																				<select class="form-control" name="cmbidproof" id="cmbidproof"   <?php echo $show==1?'disabled':''; ?>>
																					<option value="">Select Id Proof </option>	
																					<!--<?php foreach ($allidproof as $row){ ?>
																						<option value="<?=$row['id_proof_code']?>"><?=$row['id_proof_name']?></option>	
																					<?php } ?>-->
																					<?php
																					foreach($allidproof as $row)
																					{
																						$x = ($radio_prof == $row['id_proof_code'] ? ' selected ' : '');
																						echo "<option value='".$row['id_proof_code']."' $x>".$row['id_proof_name']."</option>";
																					} 
																					?>				 
																				</select>
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-6">
																		<div class="form-group">
																			<label for="" class="col-lg-5" style="m">&nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i> <i class="fa fa-credit-card" aria-hidden="true" style="color:#E4791A"></i> ID Proof Number</label>
																			<div class="col-lg-7">
																				<input type="text" class="form-control test" id="txtidproof" name="txtidproof" placeholder="Enter ID Proof Number " maxlength="20"  value="<?=$id_proof_number?>" data-placement="top" data-toggle="tooltip" title=" Enter ID Proof Number " <?php echo $show==1?'disabled':''; ?>>
																			</div>
																		</div>
																	</div>
																</div>
																<div  class="row"  style="margin-top: 20px;margin-left: -2%;">
																	
																		<div class="col-lg-6">
																		 	<div class="form-group">
																				<label for="" class="col-lg-5" style="    padding-right: 35px;">&nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i> <i class="fa fa-globe" aria-hidden="true" style="color:#E4791A"></i> Nationality</label>
																				<div class="col-lg-7">
																					<input type="text" class="form-control test" id="txtNationality" name="txtNationality"  maxlength="12" value="Indian" data-placement="top" data-toggle="tooltip" title=" Enter Nationality" disabled>
																					<input type="hidden" class="form-control test" id="cmbNationality" name="cmbNationality" value="IND">
																					
																				</div>
																			</div>
																		</div>
																		<div class="col-lg-6">
																			<div class="form-group">
																				<label for="" class="col-lg-5" ><i style="color:red;font-size:18px;">*</i> <i class="fa fa-users" aria-hidden="true" style="color:#E4791A"></i> Category</label>
																				<div class="col-lg-7">
																					<select class="form-control" name="cmbCommunity" id="cmbCommunity"   <?php echo $show==1?'disabled':''; ?>>
																						<option value=''>Select Category</option>
																						<?php 
																						foreach($allCategories as $row)
																						{
																							$x = ($cmbReservedCategory == $row['category_code'] ? ' selected ' : '');
																							echo "<option value='".$row['category_code']."' $x>".$row['category_name']."</option>";
																						} 
																						?>
																					</select>
																				</div>
																			</div>
																		</div>
																</div>
																
																
																<!--**************START OF GENDER AND PHYSICAL FITNESS*********-->
															<div  class="row" style="margin-top: 20px;margin-left: -1%;">
																<div class="col-lg-6">
																	<div class="form-group" >
																		<label for="" class="col-lg-8"  ><i class="fa fa-bookmark" aria-hidden="true" style="color:#E4791A;"></i> Permanent Resident of Arunachal Pradesh</label>
																		<div class="col-lg-4">
																			<label class="radio-inline">
																				<input type="radio" name="radioResident" id="radioResidentY" value="YES" <?php if($radioResident=="YES") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Yes
																			</label>
																			<label class="radio-inline">
																				<input type="radio" name="radioResident" id="radioResidentN" value="NO" <?php if($radioResident=="NO") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> No
																			</label>
																			
																		</div>
																	</div>
																</div>
																<!--<div class="col-lg-6">
																 	<div class="form-group">
																		<label for="" class="col-lg-5" style="    padding-right: 35px;">&nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i> <i class="fa fa-globe" aria-hidden="true" style="color:#E4791A"></i> Nationality</label>
																		<div class="col-lg-7">
																			<input type="text" class="form-control test" id="txtNationality" name="txtNationality"  maxlength="12" value="Indian" data-placement="top" data-toggle="tooltip" title=" Enter Nationality" disabled>
																			<input type="hidden" class="form-control test" id="cmbNationality" name="cmbNationality" value="IND">
																			
																		</div>
																	</div>
																</div>-->
															</div>
																<!--**************END OF GENDER AND PHYSICAL FITNESS*********-->
															<div  class="row"  style="margin-top: 20px;margin-left: -2%;">
																<div class="col-lg-6">
																	<div class="row">
																		<!--<div class="col-lg-8">-->
																		<div class="form-group" >
																			<label for="" class="col-lg-8 " >&nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i> <i class="fa fa-wheelchair" aria-hidden="true" style="color:#E4791A";></i> Belongs To PwD</label>
																			<div class="col-lg-4" >
																				<label class="radio-inline">
																					<input type="radio"  name="radioPhysicallY" id="radioPhysicallYN" value="NO" <?php if($radioPhysicallY=="NO") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> NO
																				</label>
																				<label class="radio-inline">
																					<input type="radio" name="radioPhysicallY" id="radioPhysicallYY" value="YES" <?php if($radioPhysicallY=="YES") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> YES
																				</label>
																			</div>
																		</div>
																	</div>
																	
																</div>
																<div class="col-lg-6">
																	<div class="row">
																		<!--</div>-->
																		<div style="" class="col-lg-12" id="divPH">
																			<div class="form-group">
																				<div class="col-lg-12">
																					<select class="form-control" name="cmbPH" id="cmbPH" <?php echo $show==1?'disabled':''; ?>>
																					<option value=''>Select PWD Type</option>
																					<?php 
																					foreach($allPwdType as $row)
																					{
																						$x = ($txtphtype == $row['code'] ? ' selected ' : '');
																						echo "<option value='".$row['code']."' $x>".$row['description']."</option>";
																					} 
																					?>
																					</select>
																					
																				</div>
																			</div>
																		</div>
																	</div>
																	
																</div>
																
															</div>
															<div  class="row" style="margin-top: 20px;margin-left: -2%;">
																<!--<div class="col-lg-6">
																	<div class="form-group" >
																		<label for="" class="col-lg-5"  >&nbsp;&nbsp; <i style="color:red;font-size:18px;">*</i> Sports</label>
																		<div class="col-lg-7">
																			<label class="radio-inline">
																				<input type="radio" name="radioSports" id="radioSportsY" value="YES" <?php if($radioSports=="YES") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Yes
																			</label>
																			<label class="radio-inline">
																				<input type="radio" name="radioSports" id="radioSportsN" value="NO" <?php if($radioSports=="NO") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> No
																			</label>
																			
																		</div>
																	</div>
																</div>--> 
																<div class="col-lg-6">
																	<div class="form-group" >
																		<label for="" class="col-lg-5"  >&nbsp;&nbsp; <i style="color:red;font-size:18px;">*</i> Ex-serviceman</label>
																		<div class="col-lg-7">
																			<label class="radio-inline">
																				<input type="radio" name="radioService" id="radioServiceY" value="YES" <?php if($radioService=="YES") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Yes
																			</label>
																			<label class="radio-inline">
																				<input type="radio" name="radioService" id="radioServiceN" value="NO" <?php if($radioService=="NO") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> No
																			</label>
																			
																		</div>
																	</div>
																</div>
															</div>
															<div  class="row"  style="margin-top: 20px;">
														<!--<div  class="row"  style="margin-top: 20px;">-->
															<div class="col-lg-12">
																<div class="form-group">
																	<label for="" class="col-lg-5" ><i style="color:red;font-size:18px;">*</i> <i class="fa fa-users" aria-hidden="true" style="color:#E4791A"></i>Name of Domicile district</label>
																	<div class="col-lg-7">
																		<select class="form-control" name="cmbDcOffice" id="cmbDcOffice"   <?php echo $show==1?'disabled':''; ?>>
																			<option value=''>Select</option>
																			<?php 
																			foreach($allDCoffice as $row)
																			{
																				$x = ($cmbdc == $row['dc_code'] ? ' selected ' : '');
																				echo "<option value='".$row['dc_code']."' $x>".$row['dc_name']."</option>";
																			} 
																			?>
																		</select>
																	</div>
																</div>
															</div>
														<!--</div>-->
														</div>
														</fieldset>
															<!--</div>-->
																<!--***********START OF PRESENT ADDRESS SECTION************-->
																<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 " style="padding: 10px;    margin-top: 35px;">
																<fieldset class="">
																<legend>Present Address </legend>
																	<!--<h3 style="text-align: center;margin-top: -6px;color: #666;"> Present Address  </h3>-->
																	<!--<div style="width: 100%; height: 20px; border-bottom: 1px solid #c2b7b7; text-align: center">
																	  <span style="font-size: 16px;padding: 0 10px;">
																	    <b>Present Address </b>
																	  </span>
																	</div>-->
																	<div class="row"  style="margin-top: 20px;">
																		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
																			<div class="form-group">
																				<label for="" class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-5" ><i style="color:red;font-size:18px;">*</i> H/No/Locality/Street Name/Village </label>
																				<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-7">
																					<input type="text" class="form-control" name="txtPresentLocality" id="txtPresentLocality" onchange="uncheck();" onkeyup="changeCase(this)" maxlength="80" value="<?=$txtPresentAddress?>" <?php echo $show==1?'disabled':''; ?>>
																				</div>

																			</div>
																		</div>
																		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
																			<div class="form-group">
																				<label for="" class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-5" style="    padding-right: 35px;">&nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i> Post Office</label>
																				<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-7">
																					<input type="text" class="form-control" name="txtPresentPost" id="txtPresentPost" onchange="uncheck();"    onkeyup="changeCase(this)" maxlength="80" value="<?=$txtPresentPost?>" <?php echo $show==1?'disabled':''; ?>>
																				</div>
																			</div>
																		</div>
																	</div>
																	<!--************ROW END***************-->

																	<!--********PLOT AND LOCALITY***********-->
																	<div class="row"  style="margin-top: 20px;">
																		<div class="col-lg-6">
																			<div class="form-group">
																				<label for="" class="col-lg-5" style="    padding-right: 35px;"> <i style="color:red;font-size:18px;">*</i>City/Town</label>
																				<div class="col-lg-7">
																					<input type="text" class="form-control" name="city_name" value="<?=$city_name?>" onchange="uncheck();"   onkeyup="changeCase(this)" maxlength="80" id="city_name" <?php echo $show==1?'disabled':''; ?>>
																				</div>
																			</div>
																		</div>


																		<div class="col-lg-6">
																			<div class="form-group">
																				<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> State</label>
																				<div class="col-lg-7">
																					<select name="cmbPresentState" onchange="uncheck();"  id="cmbPresentState" class="form-control" <?php echo $show==1?'disabled':''; ?>>
																						<option value=''>Select State</option>
																						<?php
																						foreach($allStates as $row)
																						{
																							$x = ($cmbPresentState == $row['state_code'] ? ' selected ' : '');
																							echo "<option value='".$row['state_code']."' $x>".$row['state_name']."</option>";
																						} 
																						?>													
																					</select>
																				</div>
																			</div>
																		</div>
																		
																	</div>
																	<!--************ROW END***************-->

																	<!--********STATE AND DITRICT***********-->
																	<div class="row"  style="margin-top: 20px;">
																		<div class="col-lg-6">
																			<div class="form-group">
																				<label for="" class="col-lg-5" style="padding-right: 35px;"><i style="color:red;font-size:18px;">*</i> District</label>
																				<div class="col-lg-7">
																					<select onchange="uncheck();"   name="cmbPresentDist" id="cmbPresentDist" class="form-control" <?php echo $show==1?'disabled':''; ?>>
																						<option value=''>Select District</option>
																						<?php
																						foreach($allDistricts as $row)
																						{
																							$x = ($cmbPresentDist == $row['district_code'] ? ' selected ' : '');
																							echo "<option value='".$row['district_code']."' $x>".$row['district_name']."</option>";
																						} 
																						?>	
																					</select>
																				</div>
																			</div>
																		</div>

																		<div class="col-lg-6">
																			<div class="form-group">
																				<label for="" class="col-lg-5" >&nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i> PIN</label>
																				<div class="col-lg-7">
																					<input type="text" class="form-control" onchange="uncheck();"  name="txtPresentPin" id="txtPresentPin" onkeypress="return isNumberKey(event)" maxlength="6" value="<?=$txtPresentPin?>" data-placement="top" data-toggle="tooltip" title="Pin must be 6digit Ex:123456" <?php echo $show==1?'disabled':''; ?>>
																				</div>
																			</div>
																		</div>

																	</div>
																	</fieldset>
																</div>	
																<!--</div>-->	
																<!--</div>	-->
																<!--***********END OF PERMANENT ADDRESS SECTION************-->

																<!--***********START OF PRESENT ADDRESS SECTION************-->

																<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 " style="padding: 10px;    margin-top: 35px;">
																<fieldset class="">
																<legend >Permanent Address</legend>
																	<!--<h3 style="text-align: center;margin-top: -6px;color: #666;"> Permanent  Address </h3>-->
																	<!--<div style="width: 100%; height: 20px; border-bottom: 1px solid #c2b7b7; text-align: center">
																	  <span style="font-size: 16px; padding: 0 10px;">
																	    <b>Permanent Address</b>
																	  </span>
																	</div>-->
																	<br />
																	<div class="row">
																		<div class="form-group">
																			<div class="col-sm-8">
																				<input type="checkbox" id="chksameasresidential" name="chksameasresidential" value="Y" onclick="setSameAddress();" <?php if($chksameasresidential=="Y") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> 
																	Permanent Address Is Same As Present Address
																			</div>
																		</div>
																	</div>
																	<div class="row"  style="margin-top: 20px;">
																		<div class="col-lg-6">
																			<div class="form-group">
																				<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> H/No/Locality/Street Name/Village </label>
																				<div class="col-lg-7">
																					<input type="text" class="form-control" name="txtPermenentLocality" id="txtPermenentLocality" onkeyup="changeCase(this)" maxlength="80" value="<?=$txtPermenentAddress?>" <?php echo $show==1?'disabled':''; ?>>
																				</div>
																			</div>
																		</div>
																		 
																			<div class="col-lg-6">
																				<div class="form-group">
																					<label for="" class="col-lg-5" style="padding-right: 35px;">&nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i> Post Office</label>
																					<div class="col-lg-7">
																						<input type="hidden" name="hidPermanentPost" id="hidPermanentPost" value="<?=$txtPermanentPost?>" />
																						<input type="text" class="form-control" name="txtPermanentPost"    id="txtPermanentPost" onkeyup="changeCase(this)" maxlength="80" <?php echo $show==1?'disabled':''; ?> value="<?=$txtPermanentPost?>" >
																					</div>
																				</div>
																			</div>

																		</div>
																	


																	<div class="row" style="margin-top: 20px;">
																		<div class="col-lg-6">
																			<div class="form-group">
																				<label for="" class="col-lg-5" style="    padding-right: 35px;"><i style="color:red;font-size:18px;">*</i> City/Town</label>
																				<div class="col-lg-7">
																					<input type="text" class="form-control" name="city_name1" id="city_name1"   value="<?=$city_name1?>" onkeyup="changeCase(this)" maxlength="80" <?php echo $show==1?'disabled':''; ?>>
																				</div>
																			</div>
																		</div>
																		 

																		<div class="col-lg-6">
																			<div class="form-group">
																				<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> State</label>
																				<div class="col-lg-7">
																					<input type="hidden"  name="hidPermanentState" id="hidPermanentState" value="<?=$cmbPermanentState?>"  >
																					<select name="cmbPermanentState" id="cmbPermanentState" class="form-control" <?php echo $show==1?'disabled':''; ?>>
																						<option value=''>Select State</option>
																						<?php
																						foreach($allStates as $row)
																						{
																							$x = ($cmbPermanentState == $row['state_code'] ? ' selected ' : '');
																							echo "<option value='".$row['state_code']."' $x>".$row['state_name']."</option>";
																						} 
																						?>													
																					</select>
																				</div>
																			</div>
																		</div>
																			
																		 
																	</div>

						                                          	<div class="row"  style="margin-top: 20px;">
																		<div class="col-lg-6">

																			<div class="form-group">
																				<label for="" class="col-lg-5" style="    padding-right: 35px;"><i style="color:red;font-size:18px;">*</i> District</label>
																				<div class="col-lg-7">
																					<input type="hidden"  name="hidPermanentState" id="hidPermanentState" value="<?=$cmbPermanentState?>" />
																					<select id="cmbPermanentDist" name="cmbPermanentDist" class="form-control" <?php echo $show==1?'disabled':''; ?> >
																						<option value=''>Select District</option>
																						<?php
																						foreach($allDistricts as $row)
																						{
																							$x = ($cmbPermanentDist == $row['district_code'] ? ' selected ' : '');
																							echo "<option value='".$row['district_code']."' $x>".$row['district_name']."</option>";
																						} 
																						?>													
																					</select>
																				</div>
																			</div>

																		</div>

																		<div class="col-lg-6">
																			<div class="form-group">
																			<label for="" class="col-lg-5" > &nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i> PIN</label>
																			<div class="col-lg-7">
																				<input type="hidden"  name="hidPermanentPin" id="hidPermanentPin" value="<?=$txtPermanentPin?>" />
																				<input type="text" class="form-control" name="txtPermanentPin" id="txtPermanentPin" value="<?=$txtPermanentPin?>" onkeypress="return isNumberKey(event)" <?php echo $show==1?'disabled':''; ?> maxlength="6" data-placement="top" data-toggle="tooltip" title="Pin must be 6digit Ex:123456">
																			</div>
																		</div>


																		</div>
																	</div>
																	
																</fieldset>	
																</div>
													
																<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 " style="padding: 10px;    margin-top: 35px;">
																	<fieldset class="">
																		<legend >Choice Of Center</legend>
																	<!--<h3 style="text-align: center;margin-top: -6px;color: #666;"> Permanent  Address </h3>-->
																	<!--<div style="width: 100%; height: 20px; border-bottom: 1px solid #c2b7b7; text-align: center">
																	  <span style="font-size: 16px; padding: 0 10px;">
																	    <b>Choice Of Center</b>
																	  </span>
																	</div>-->
																	<div class="row" style="margin-top: 20px;">	

																		<div class="col-lg-12">
																			<!--<div class="form-group">-->
																				<label for="" class="col-lg-4" style="text-align:left; " ><i style="color:red;font-size:18px;">*</i> Choice Of Center :</label>
																				<div class="col-sm-8">
																					<div class="col-sm-4 form-group">
																						<label>Choice 1</label>

																						<select class="form-control" name="center_name1" id="center_name1"   <?php echo $show==1?'disabled':''; ?>>
																							<option value="">Select Preference</option>							 
																						</select>

																					</div>

																					<div class="col-sm-4 form-group">
																						<label>Choice 2</label>

																						<select class="form-control" name="center_name2" id="center_name2"   <?php echo $show==1?'disabled':''; ?>>
																							<option value="">Select Preference</option>									 
																						</select>
																						<!-- <input type="text" class="form-control"    name="center_name2" value="<?=$center_name2?>" <?php echo $show==1?'disabled':''; ?>/> 
																						<input type="text" class="form-control"    name="center_code2" value="<?=$center_code2?>" <?php echo $show==1?'disabled':''; ?>/>-->
																					</div>

																					<div class="col-sm-4 form-group">
																						<label>Choice 3</label>
																						<select class="form-control" name="center_name3" id="center_name3"   <?php echo $show==1?'disabled':''; ?>>
																							<option value="">Select Preference</option>									 
																						</select>
																						<!-- <input type="text" class="form-control"    name="center_name3" value="<?=$center_name3?>" <?php echo $show==1?'disabled':''; ?>/> 
																						<input type="text" class="form-control"    name="center_code3" value="<?=$center_code3?>" <?php echo $show==1?'disabled':''; ?>/>-->
																					</div>
																				</div>
																			<!--</div>-->
																		</div>
																	</div>
																	
																	</fieldset>
																	</div>
																	<?php if($show != 1) { ?>
																	<div class="row"  style="margin-top: 20px;">
																		<div class="form-group">
																			<div>
																				<br />
																				<button type="submit" class="col-xs-11 col-sm-11 col-md-11 col-lg-11 col-xl-11 btn btn-warning btnNext1" style="margin-left: 45px;">Save &amp; Next »</button>
																			</div>
																		</div>	
																	</div>
																	<?php } ?>
																	
																
																<br />
															</div>
															
														</div>
													</form>
												</div>

												<!-- second tab-->
												
												<div class="tab-pane" id="academic_tab"> 
												<form action="" method="post" id="frmAcademicInfo" name="frmAcademicInfo">
													<!--***********START OF ACADEMIC INFORMATION SECTION************-->
															
													<div class="col-lg-12" id="divAcademicInfo" style="padding: 5px; margin-top: 10px;">
													<fieldset>
														<legend>Academic Information</legend>
														<!--<h3 style="text-align: center;margin-top: -6px;color: #666;"> Academic Information </h3>-->
														<!--<div style="width: 100%; height: 20px; border-bottom: 1px solid #c2b7b7; text-align: center">
														  <span style="font-size: 16px; padding: 0 10px;">
														    <b>Academic Information </b>
														  </span>
														</div>-->
														<div class="row">
															<div class="col-sm-12">
																<h4><b><i class="glyphicon glyphicon-asterisk" style="color:red;font-size:10px;"></i> Educational Qualification </b></h4>
															</div>
															<div class="col-sm-12">
																<div class="table-responsive">
																	
																	<table  class="table table-bordered table-striped">
																		<thead>
																		<tr>
																			<th style="text-align:center;" width="16%">Name of Examination Passed</th>
																			<th style="text-align:center;" width="10%">Degree/Master in </th>
																			<th style="text-align:center;" width="15%">Year of Passing/Appearing</th>
																			<th style="text-align:center;" width="10%">Board/University</th>
																			<!--<th style="text-align:center;" width="10%">Subject</th>-->
																			<th style="text-align:center;" width="10%">Division/Class</th>
																			<th style="text-align:center;" width="10%">Grading System</th>
																			<th style="text-align:center;" width="10%">CGPA/% of Marks</th>
																		</tr>
																		</thead>
																		<tbody>
																		<?php
																			$sl_no =1;
																			foreach($allQualifications as $row)
																			{
																				$division = $row['division'];
																				$all_division = explode(',',$division);
																				//print_r($all_division);
																				$graduation_code=$row['qualification_code'];
																				$graduation_quali=$row['qualification_name'];
																				$program_code=$row['program_code'];
																				$program_code_arr=explode('_',$program_code);
																				$program_code_arr = $program_code_arr[0];
																			?>
																			<tr id="<?php echo $row['qualification_code']; ?>">
																			
																				<td><input type="text" class="form-control input-sm" name="txtQualification<?=$sl_no?>" id="txtQualification<?=$sl_no?>" value="<?=$row['qualification_name']?>"  readonly="readonly"/></td>
																				<input type="hidden" id="selecting_value" value="$graduation_code" />
																				
																				<?php 
																					
																					if($program_code_arr == 'PGT')
																					{
																						if($row['qualification_code'] == 'SRSEC')
																						{
																				?>
																				<td><div class="form-group">
																					<select class="form-control input-sm" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>" <?php echo $show==1?'disabled':''; ?>>
																						<option value='' <?php if(${'txtqual2'.$sl_no}=='') { echo "selected";  } ?>>Select</option>
																						<option value='Arts' <?php if(${'txtqual2'.$sl_no}=='Arts') { echo "selected";  } ?> >Arts</option>
																						<option value='Science' <?php if(${'txtqual2'.$sl_no}=='Science') { echo "selected"; } ?>>Science</option>
																						<option value='Commerce' <?php if(${'txtqual2'.$sl_no}=='Commerce') { echo "selected"; } ?>>Commerce</option>
																						<option value='Diploma' <?php if(${'txtqual2'.$sl_no}=='Diploma') { echo "selected"; } ?>>Diploma</option>
																					
																					</select>
																				</div></td>
																				<?php 		
																						}
																						else if($row['qualification_code'] == 'GRADUTION')
																						{
																				?>
																				<td><div class="form-group">
																					<select class="form-control input-sm grad" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>" <?php echo $show==1?'disabled':''; ?>>
																						<option value='' <?php if(${'txtqual2'.$sl_no}=='') { echo "selected";  } ?>>Select</option>
																						<option value='BA' <?php if(${'txtqual2'.$sl_no}=='BA') { echo "selected";  } ?> >BA</option>
																						<option value='B.Sc.' <?php if(${'txtqual2'.$sl_no}=='B.Sc.') { echo "selected"; } ?>>B.Sc.</option>
																						<option value='B.Com' <?php if(${'txtqual2'.$sl_no}=='B.Com') { echo "selected"; } ?>>B.Com</option>
																						<option value='LLB' <?php if(${'txtqual2'.$sl_no}=='LLB') { echo "selected"; } ?>>LLB</option>
																						<option value='BBA' <?php if(${'txtqual2'.$sl_no}=='BBA') { echo "selected"; } ?>>BBA</option>
																						<option value='BCA' <?php if(${'txtqual2'.$sl_no}=='BCA') { echo "selected"; } ?>>BCA</option>
																						<option value='B.Tech' <?php if(${'txtqual2'.$sl_no}=='B.Tech') { echo "selected"; } ?>>B.Tech</option>
																						<option value='BE' <?php if(${'txtqual2'.$sl_no}=='BE') { echo "selected"; } ?>>BE</option>
																						<option value='Other' <?php if(${'txtqual2'.$sl_no}=='Other') { echo "selected"; } ?>>Other</option>
																					</select>
																					
																					
																				</div><div class="form-group">
																				<div id="container_grad">
																					<input type="text" class="form-control input-sm" name="txtOther_grad<?=$sl_no?>" id="txtOther_grad<?=$sl_no?>" value="<?=${'txtOther_grad'.$sl_no}?>" <?php echo $show==1?'disabled':''; ?>/>
																				</div>
																				</div>
																				<!--<div class="form-group" id="">
																					<input type="text" class="form-control input-sm" name="txtQualification<?=$sl_no?>" id="txtQualification<?=$sl_no?>" value="<?=$row['qualification_name']?>" />
																				</div>-->
																				</td>
																				<?php 
																						}	
																						else if($row['qualification_code'] == 'SRSEC_DIPLOMA')
																						{
																							
																				?>
																						<td><div class="form-group">
																							<select class="form-control input-sm" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>" <?php echo $show==1?'disabled':''; ?>>
																								<option value='' <?php if(${'txtqual2'.$sl_no}=='') { echo "selected";  } ?>>Select</option>
																								<option value='x' <?php if(${'txtqual2'.$sl_no}=='x') { echo "selected";  } ?> >Diploma x</option>
																								<option value='y' <?php if(${'txtqual2'.$sl_no}=='y') { echo "selected"; } ?>>Diploma y</option>
																								<option value='z' <?php if(${'txtqual2'.$sl_no}=='z') { echo "selected"; } ?>>Diploma z</option>
																							</select>
																						</div></td>
																				<?php 
																						}
																						else
																						{
																				?>
																							<td></td>
																				<?php
																						}
																					}
																					else if($program_code_arr == 'HELPER')
																					{
																						if($row['qualification_code'] == 'SRSEC')
																						{
																				?>
																				<td><div class="form-group">
																					<select class="form-control input-sm" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>" <?php echo $show==1?'disabled':''; ?>>
																						<option value='' <?php if(${'txtqual2'.$sl_no}=='') { echo "selected";  } ?>>Select</option>
																						<option value='Arts' <?php if(${'txtqual2'.$sl_no}=='Arts') { echo "selected";  } ?> >Arts</option>
																						<option value='Science' <?php if(${'txtqual2'.$sl_no}=='Science') { echo "selected"; } ?>>Science</option>
																						<option value='Commerce' <?php if(${'txtqual2'.$sl_no}=='Commerce') { echo "selected"; } ?>>Commerce</option>
																						<option value='Diploma' <?php if(${'txtqual2'.$sl_no}=='Diploma') { echo "selected"; } ?>>Diploma</option>
																					
																					</select>
																				</div></td>
																				<?php 		
																						}
																						else if($row['qualification_code'] == 'GRADUTION')
																						{
																				?>
																				<td><div class="form-group">
																					<select class="form-control input-sm grad" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>" <?php echo $show==1?'disabled':''; ?>>
																						<option value='' <?php if(${'txtqual2'.$sl_no}=='') { echo "selected";  } ?>>Select</option>
																						<option value='BA' <?php if(${'txtqual2'.$sl_no}=='BA') { echo "selected";  } ?> >BA</option>
																						<option value='B.Sc.' <?php if(${'txtqual2'.$sl_no}=='B.Sc.') { echo "selected"; } ?>>B.Sc.</option>
																						<option value='B.Com' <?php if(${'txtqual2'.$sl_no}=='B.Com') { echo "selected"; } ?>>B.Com</option>
																						<option value='LLB' <?php if(${'txtqual2'.$sl_no}=='LLB') { echo "selected"; } ?>>LLB</option>
																						<option value='BBA' <?php if(${'txtqual2'.$sl_no}=='BBA') { echo "selected"; } ?>>BBA</option>
																						<option value='BCA' <?php if(${'txtqual2'.$sl_no}=='BCA') { echo "selected"; } ?>>BCA</option>
																						<option value='B.Tech' <?php if(${'txtqual2'.$sl_no}=='B.Tech') { echo "selected"; } ?>>B.Tech</option>
																						<option value='BE' <?php if(${'txtqual2'.$sl_no}=='BE') { echo "selected"; } ?>>BE</option>
																						<option value='Other' <?php if(${'txtqual2'.$sl_no}=='Other') { echo "selected"; } ?>>Other</option>
																					</select>
																					
																					
																				</div><div class="form-group">
																				<div id="container_grad">
																					<input type="text" class="form-control input-sm" name="txtOther_grad<?=$sl_no?>" id="txtOther_grad<?=$sl_no?>" value="<?=${'txtOther_grad'.$sl_no}?>" <?php echo $show==1?'disabled':''; ?>/>
																				</div>
																				</div>
																				<!--<div class="form-group" id="">
																					<input type="text" class="form-control input-sm" name="txtQualification<?=$sl_no?>" id="txtQualification<?=$sl_no?>" value="<?=$row['qualification_name']?>" />
																				</div>-->
																				</td>
																				<?php 
																						}	
																						else if($row['qualification_code'] == 'SRSEC_DIPLOMA')
																						{
																							
																				?>
																						<td><div class="form-group">
																							<select class="form-control input-sm" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>" <?php echo $show==1?'disabled':''; ?>>
																								<option value='' <?php if(${'txtqual2'.$sl_no}=='') { echo "selected";  } ?>>Select</option>
																								<option value='Diploma in Sound System' <?php if(${'txtqual2'.$sl_no}=='Diploma in Sound System or TV and Radio') { echo "selected";  } ?> >Diploma in Sound System</option>
																								<option value='Diploma in TV and Radio' <?php if(${'txtqual2'.$sl_no}=='Diploma in TV and Radio') { echo "selected"; } ?>>Diploma in TV and Radio</option>
																								<option value='Diploma in Electrical or Electronics' <?php if(${'txtqual2'.$sl_no}=='Diploma in Electrical or Electronics') { echo "selected"; } ?>>Diploma in Electrical or Electronics</option>
																							</select>
																						</div></td>
																				<?php 
																						}
																						else
																						{
																				?>
																							<td></td>
																				<?php
																						}
																					}
																					else if($program_code_arr == 'RADMEC')
																					{
																						if($row['qualification_code'] == 'SRSEC')
																						{
																				?>
																				<td><div class="form-group">
																					<select class="form-control input-sm" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>" <?php echo $show==1?'disabled':''; ?>>
																						<option value='' <?php if(${'txtqual2'.$sl_no}=='') { echo "selected";  } ?>>Select</option>
																						<option value='Arts' <?php if(${'txtqual2'.$sl_no}=='Arts') { echo "selected";  } ?> >Arts</option>
																						<option value='Science' <?php if(${'txtqual2'.$sl_no}=='Science') { echo "selected"; } ?>>Science</option>
																						<option value='Commerce' <?php if(${'txtqual2'.$sl_no}=='Commerce') { echo "selected"; } ?>>Commerce</option>
																						<option value='Diploma' <?php if(${'txtqual2'.$sl_no}=='Diploma') { echo "selected"; } ?>>Diploma</option>
																					
																					</select>
																				</div></td>
																				<?php 		
																						}
																						else if($row['qualification_code'] == 'GRADUTION')
																						{
																				?>
																				<td><div class="form-group">
																					<select class="form-control input-sm grad" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>" <?php echo $show==1?'disabled':''; ?>>
																						<option value='' <?php if(${'txtqual2'.$sl_no}=='') { echo "selected";  } ?>>Select</option>
																						<option value='BA' <?php if(${'txtqual2'.$sl_no}=='BA') { echo "selected";  } ?> >BA</option>
																						<option value='B.Sc.' <?php if(${'txtqual2'.$sl_no}=='B.Sc.') { echo "selected"; } ?>>B.Sc.</option>
																						<option value='B.Com' <?php if(${'txtqual2'.$sl_no}=='B.Com') { echo "selected"; } ?>>B.Com</option>
																						<option value='LLB' <?php if(${'txtqual2'.$sl_no}=='LLB') { echo "selected"; } ?>>LLB</option>
																						<option value='BBA' <?php if(${'txtqual2'.$sl_no}=='BBA') { echo "selected"; } ?>>BBA</option>
																						<option value='BCA' <?php if(${'txtqual2'.$sl_no}=='BCA') { echo "selected"; } ?>>BCA</option>
																						<option value='B.Tech' <?php if(${'txtqual2'.$sl_no}=='B.Tech') { echo "selected"; } ?>>B.Tech</option>
																						<option value='BE' <?php if(${'txtqual2'.$sl_no}=='BE') { echo "selected"; } ?>>BE</option>
																						<option value='Other' <?php if(${'txtqual2'.$sl_no}=='Other') { echo "selected"; } ?>>Other</option>
																					</select>
																					
																					
																				</div>
																				<div class="form-group">
																				<div id="container_grad">
																					<input type="text" class="form-control input-sm" name="txtOther_grad<?=$sl_no?>" id="txtOther_grad<?=$sl_no?>" value="<?=${'txtOther_grad'.$sl_no}?>" <?php echo $show==1?'disabled':''; ?> />
																				</div>
																				</div>
																				<!--<div class="form-group" id="">
																					<input type="text" class="form-control input-sm" name="txtQualification<?=$sl_no?>" id="txtQualification<?=$sl_no?>" value="<?=$row['qualification_name']?>" />
																				</div>-->
																				</td>
																				<?php 
																						}	
																						else if($row['qualification_code'] == 'SRSEC_DIPLOMA')
																						{
																							
																				?>
																						<td><div class="form-group">
																							<select class="form-control input-sm" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>" <?php echo $show==1?'disabled':''; ?>>
																								<option value='' <?php if(${'txtqual2'.$sl_no}=='') { echo "selected";  } ?>>Select</option>
																								<option value='Diploma in Electronics' <?php if(${'txtqual2'.$sl_no}=='Diploma in Electronics') { echo "selected";  } ?> >Diploma in Electronics</option>
																								<option value='Diploma in Sound Engineering' <?php if(${'txtqual2'.$sl_no}=='Diploma in Sound Engineering') { echo "selected"; } ?>>Diploma in Sound Engineering</option>
																								<option value='Diploma in Radio & TV Engineering' <?php if(${'txtqual2'.$sl_no}=='Diploma in Radio & TV Engineering') { echo "selected"; } ?>>Diploma in Radio & TV Engineering</option>
																								<option value='Diploma in Radio Mechanism' <?php if(${'txtqual2'.$sl_no}=='Diploma in Radio Mechanism') { echo "selected"; } ?>>Diploma in Radio Mechanism</option>
																							</select>
																						</div></td>
																				<?php 
																						}
																						else
																						{
																				?>
																							<td></td>
																				<?php
																						}
																					}
																					
																					else 
																					{
																						if($row['qualification_code'] == 'SRSEC')
																						{
																				?>
																				<td><div class="form-group">
																					<select class="form-control input-sm" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>" <?php echo $show==1?'disabled':''; ?>>
																						<option value='' <?php if(${'txtqual2'.$sl_no}=='') { echo "selected";  } ?>>Select</option>
																						<option value='Arts' <?php if(${'txtqual2'.$sl_no}=='Arts') { echo "selected";  } ?> >Arts</option>
																						<option value='Science' <?php if(${'txtqual2'.$sl_no}=='Science') { echo "selected"; } ?>>Science</option>
																						<option value='Commerce' <?php if(${'txtqual2'.$sl_no}=='Commerce') { echo "selected"; } ?>>Commerce</option>
																						<option value='Diploma' <?php if(${'txtqual2'.$sl_no}=='Diploma') { echo "selected"; } ?>>Diploma</option>
																					
																					</select>
																				</div></td>
																				<?php 		
																						}
																						else if($row['qualification_code'] == 'GRADUTION')
																						{
																				?>
																				<td><div class="form-group">
																					<select class="form-control input-sm grad" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>" <?php echo $show==1?'disabled':''; ?>>
																						<option value='' <?php if(${'txtqual2'.$sl_no}=='') { echo "selected";  } ?>>Select</option>
																						<option value='BA' <?php if(${'txtqual2'.$sl_no}=='BA') { echo "selected";  } ?> >BA</option>
																						<option value='B.Sc.' <?php if(${'txtqual2'.$sl_no}=='B.Sc.') { echo "selected"; } ?>>B.Sc.</option>
																						<option value='B.Com' <?php if(${'txtqual2'.$sl_no}=='B.Com') { echo "selected"; } ?>>B.Com</option>
																						<option value='LLB' <?php if(${'txtqual2'.$sl_no}=='LLB') { echo "selected"; } ?>>LLB</option>
																						<option value='BBA' <?php if(${'txtqual2'.$sl_no}=='BBA') { echo "selected"; } ?>>BBA</option>
																						<option value='BCA' <?php if(${'txtqual2'.$sl_no}=='BCA') { echo "selected"; } ?>>BCA</option>
																						<option value='B.Tech' <?php if(${'txtqual2'.$sl_no}=='B.Tech') { echo "selected"; } ?>>B.Tech</option>
																						<option value='BE' <?php if(${'txtqual2'.$sl_no}=='BE') { echo "selected"; } ?>>BE</option>
																						<option value='Other' <?php if(${'txtqual2'.$sl_no}=='Other') { echo "selected"; } ?>>Other</option>
																					</select>
																					
																					
																				</div>
																				<div class="form-group">
																				<div id="container_grad">
																					<input type="text" class="form-control input-sm" name="txtOther_grad<?=$sl_no?>" id="txtOther_grad<?=$sl_no?>" value="<?=${'txtOther_grad'.$sl_no}?>" <?php echo $show==1?'disabled':''; ?>/>
																				</div>
																				</div>
																				<!--<div class="form-group" id="">
																					<input type="text" class="form-control input-sm" name="txtQualification<?=$sl_no?>" id="txtQualification<?=$sl_no?>" value="<?=$row['qualification_name']?>" />
																				</div>-->
																				</td>
																				<?php 
																						}	
																						else if($row['qualification_code'] == 'SRSEC_DIPLOMA')
																						{
																							
																				?>
																						<td><div class="form-group">
																							<select class="form-control input-sm" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>" <?php echo $show==1?'disabled':''; ?>>
																								<option value='' <?php if(${'txtqual2'.$sl_no}=='') { echo "selected";  } ?>>Select</option>
																								<option value='Diploma in TV' <?php if(${'txtqual2'.$sl_no}=='Diploma in TV') { echo "selected";  } ?> >Diploma in TV</option>
																								<option value='Diploma in Radio/Sound System' <?php if(${'txtqual2'.$sl_no}=='Diploma in Radio/Sound System') { echo "selected"; } ?>>Diploma in Radio/Sound System</option>
																								<option value='Diploma in Electrical or Electronics' <?php if(${'txtqual2'.$sl_no}=='Diploma in Electrical or Electronics') { echo "selected"; } ?>>Diploma in Electrical or Electronics</option>
																							</select>
																						</div></td>
																				<?php 
																						}
																						else if($row['qualification_code'] == 'PG')
																						{
																							
																				?>
																						<td><div class="form-group">
																						<input type="text" class="form-control input-sm" id="txtqual2<?=$sl_no?>" name="txtqual2<?=$sl_no?>" value="<?php echo ${'txtqual2'.$sl_no} == 'NULL'?'':${'txtqual2'.$sl_no}; ?>" <?php echo $show==1?'disabled':''; ?> />
																							<!--<select class="form-control input-sm" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>">
																								<option value='' <?php if(${'txtqual2'.$sl_no}=='') { echo "selected";  } ?>>Select</option>
																								<option value='Diploma in TV' <?php if(${'txtqual2'.$sl_no}=='Diploma in TV') { echo "selected";  } ?> >Diploma in TV</option>
																								<option value='Diploma in Radio/Sound System' <?php if(${'txtqual2'.$sl_no}=='Diploma in Radio/Sound System') { echo "selected"; } ?>>Diploma in Radio/Sound System</option>
																								<option value='Diploma in Electrical or Electronics' <?php if(${'txtqual2'.$sl_no}=='Diploma in Electrical or Electronics') { echo "selected"; } ?>>Diploma in Electrical or Electronics</option>
																							</select>-->
																						</div></td>
																				<?php 
																						}
																						else
																						{
																				?>
																							<td></td>
																				<?php
																						}
																					}

																				?>
																				<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtYear<?=$sl_no?>" name="txtYear<?=$sl_no?>" onkeypress="return isNumberKey(event)" maxlength="4"   value="<?php echo ${'txtYear'.$sl_no} == 'NULL'?'':${'txtYear'.$sl_no}; ?>" <?php echo $show==1?'disabled':''; ?> /></div></td>
																				<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtBoard<?=$sl_no?>" name="txtBoard<?=$sl_no?>" maxlength="90"  value="<?=${'txtBoard'.$sl_no}?>" <?php echo $show==1?'disabled':''; ?> onkeyup="changeCase(this)" maxlength="50"/></div></td>
																				<td><div class="form-group">
																					<select class="form-control input-sm" name="txtdistinct<?=$sl_no?>" id="txtdistinct<?=$sl_no?>" <?php echo $show==1?'disabled':''; ?>>
																						<option value="">Select</option>
																							<?php 
																							for($i = 0; $i< count($all_division); $i++ )
																							{
																							?>
																								<option value="<?=$all_division[$i]?>" <?php if(${'txtDivision'.$sl_no} == "$all_division[$i]") echo 'selected';?>><?=$all_division[$i]?></option>
																							<?php
																							}
																							?>
																						<!--<option value=''>select</option>
																						<?php
																							$x = "selected";
																							$i = 1;
																							for($div_count=0 ; $div_count < count($all_division);$div_count++)
																							{
																								//echo ${'txtDivision'.$i};
																								if(${'txtDivision'.$i} == '' || ${'txtDivision'.$i} == null || ${'txtDivision'.$i} == 'NULL')
																								{
																									echo "<option value='".$all_division[$div_count]."'>".$all_division[$div_count]."</option>";
																								}
																								else
																								{
																									echo "<option value='".$all_division[$div_count]."' ".$x.">".$all_division[$div_count]."</option>";
																								}
																								$i++ ;
																								
																							}
																							//die();
																						?>	-->
																					</select>
																				</div></td>
																				<td><div class="form-group">
																					<select class="form-control input-sm" data-bv-callback-callback="true"  data-bv-callback-message="true" <?php echo $show==1?'disabled':''; ?> name="txtgrading<?=$sl_no?>" id="txtgrading<?=$sl_no?>">
																						<option value='' <?php if(${'txtgrading'.$sl_no}=='') { echo "selected";  } ?>>Select</option>
																						<option value='YES' <?php if(${'txtgrading'.$sl_no}=='YES') { echo "selected";  } ?> >Yes</option>
																						<option value='NO' <?php if(${'txtgrading'.$sl_no}=='NO') { echo "selected"; } ?>>No</option>
																					</select>
																				</div></td>
																				<!--<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtMS<?=$sl_no?>" name="txtMS<?=$sl_no?>" value="<?php echo ${'txtMS'.$sl_no} == 'NULL'?'':${'txtMS'.$sl_no}; ?>" onkeypress="return isNumberKey(event)" onblur="calculatePercentage(<?=$sl_no?>)"  <?php echo $show==1?'disabled':''; ?>/></div></td>
																				<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtFM<?=$sl_no?>" name="txtFM<?=$sl_no?>" value="<?php echo ${'txtFM'.$sl_no} == 'NULL'?'':${'txtFM'.$sl_no}; ?>" onkeypress="return isNumberKey(event)" onblur="calculatePercentage(<?=$sl_no?>)"  <?php echo $show==1?'disabled':''; ?>/></div></td>-->
																				<td><div class="form-group"><input type="text" data-bv-callback-callback="true" data-bv-callback-message="true" class="form-control input-sm" id="txtPercent<?=$sl_no?>" onkeypress="return isNumberKey(event)" name="txtPercent<?=$sl_no?>" <?php echo $show==1?'disabled':''; ?> maxlength="5"  value="<?php echo ${'txtPercent'.$sl_no} == 'NULL'?'':${'txtPercent'.$sl_no}; ?>" /></div></td>
																				
																				<!--<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtdistinct<?=$sl_no?>" name="txtdistinct<?=$sl_no?>" value="<?=${'txtdistinct'.$sl_no}?>" <?php echo $show==1?'disabled':''; ?> onkeyup="changeCase(this)" maxlength="50"/></div></td>
																				-->
																				
																			</tr>
																				<?php
																				$sl_no++;
																				}
																				?>
																				
																		
																			
																		</tbody>
																	</table>
																	<!--<button class="btn btn-danger" id="btnAddQual" type="button" <?php echo $show==1?'disabled':''; ?>>Add</button>-->
																</div>
															</div>
															<div class="col-lg-12">
																<div class="form-group" >
																	<label for="" class="col-lg-5"  >&nbsp;&nbsp; <i style="color:red;font-size:18px;">*</i> <b>Computer Education</b></label>
																	<div class="col-lg-7">
																		<label class="radio-inline">
																			<input type="radio" name="radioComputer" id="radioComputerY" value="YES" <?php if($radioComputer=="YES") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Yes
																		</label>
																		<label class="radio-inline">
																			<input type="radio" name="radioComputer" id="radioComputerN" value="NO" <?php if($radioComputer=="NO") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> No
																		</label>
																		
																	</div>
																</div>
															</div>
															<!--<div class="row">-->
																<div class="col-sm-12">
																	<h4><b> Other Qualification</b></h4>
																</div>
																<div class="col-sm-12 table-responsive">
																	<table  class="table table-bordered table-striped">
																	    <tr>
																			<th style="text-align:center;" width="15%">Examination Passed</th>
																			<th style="text-align:center;" width="10%">Degree/Master in </th>
																			<th style="text-align:center;" width="10%">Year Of Passing</th>
																			<th style="text-align:center;" width="10%">Board/University</th>
																			<!--<th style="text-align:center;" width="10%">Subject</th>-->
																			<th style="text-align:center;" width="10%">Division/Class</th>
																			<th style="text-align:center;" width="10%">Grading System</th>
																			<th style="text-align:center;" width="10%">CGPA/% of Marks</th>
																			
																		</tr>

																		<tr>
																			<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtExamName1" name="txtExamName1" value="<?=$txtExamName1?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
																			<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtStream1" name="txtStream1" value="<?=$txtStream1?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
																			<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtYearQual1" onkeypress="return isNumberKey(event)" name="txtYearQual1" maxlength="4" value="<?=$txtYearQual1?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
																			<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtBoardOth1" name="txtBoardOth1" maxlength="500" value="<?=$txtBoardOth1?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
																			<!--<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtSub1" name="txtSub1" maxlength="500" value="<?=$txtSub1?>" <?php echo $show==1?'disabled':''; ?>/></div></td>-->
																			<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtDiv1" name="txtDiv1" maxlength="500" value="<?=$txtDiv1?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
																			<td><div class="form-group">
																				<select class="form-control input-sm" name="txtGradingOth1" id="txtGradingOth1" <?php echo $show==1?'disabled':''; ?>>
																					<option value='' <?php if($txtGradingOth1 == '') { echo "selected";  } ?>>Select</option>
																					<option value='YES' <?php if($txtGradingOth1 == 'YES') { echo "selected";  } ?> >Yes</option>
																					<option value='NO' <?php if($txtGradingOth1 == 'NO') { echo "selected"; } ?>>No</option>
																				</select>
																			</div></td>
																			<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtCGPA1" onkeypress="return isNumberKey(event)" name="txtCGPA1" maxlength="500" value="<?=$txtCGPA1?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
																			
																		</tr>
																		<tr>
																			<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtExamName2" name="txtExamName2" value="<?=$txtExamName2?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
																			<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtStream2" name="txtStream2" value="<?=$txtStream2?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
																			<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtYearQual2" onkeypress="return isNumberKey(event)" name="txtYearQual2" maxlength="4" value="<?=$txtYearQual2?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
																			<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtBoardOth2" name="txtBoardOth2" maxlength="500" value="<?=$txtBoardOth2?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
																			<!--<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtSub2" name="txtSub2" maxlength="500" value="<?=$txtSub2?>" <?php echo $show==1?'disabled':''; ?>/></div></td>-->
																			<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtDiv2" name="txtDiv2" maxlength="500" value="<?=$txtDiv2?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
																			<td><div class="form-group">
																				<select class="form-control input-sm" name="txtGradingOth2" id="txtGradingOth2" <?php echo $show==1?'disabled':''; ?>>
																					<option value='' <?php if($txtGradingOth2 == '') { echo "selected";  } ?>>Select</option>
																					<option value='YES' <?php if($txtGradingOth2 == 'YES') { echo "selected";  } ?> >Yes</option>
																					<option value='NO' <?php if($txtGradingOth2 == 'NO') { echo "selected"; } ?>>No</option>
																				</select>
																			</div></td>
																			<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtCGPA2" onkeypress="return isNumberKey(event)" name="txtCGPA2" maxlength="500" value="<?=$txtCGPA2?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
																			
																		</tr>
																	</table>													   
																</div>
															<!--</div>	-->
														</div>
														
														<br />
													</fieldset><br />
													<?php if($show != 1) { ?>
													<div class="form-group">
																<div>
																	<br />
																	<a class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5 btn btn-warning btnPrevious" > &laquo; Previous </a> 
																	<a class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-5" ></a> 
																	<button type="submit" onclick="return validate_academic();" class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5 btn btn-warning" >Save & Next &raquo; </button>
																</div>
														</div>
													<?php } ?>	
													</div>
												</form>	
												</div>

												<!-- third tab-->
												
												<div class="tab-pane" id="info_tab"> 
													<form action="" method="post" id="frmInfoDetails" name="frmInfoDetails">
													<div class="col-lg-12" style="padding: 0px;    margin-top: 10px;">
													<fieldset>
														<legend>Information</legend>
													 		<div class="col-sm-12 form-group">
													        <div class="col-sm-7">
																<label for="" ><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Whether working as a regular employee under the Government ?</label>
															</div>
															<div class="col-sm-5">
																<label class="radio-inline">
																	<input type="radio" name="empGovt" id="empGovtno" value="NO" <?php if($is_employed=="NO") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> NO
																</label>
																<label class="radio-inline">
																	<input type="radio" name="empGovt" id="empGovtyes" value="YES" <?php if($is_employed=="YES") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> YES
																</label>
															</div>
														</div>
														<div id="divEmpSuspendedInfo" class="col-sm-12">
															<div class="col-sm-12 form-group">
														        <div class="col-sm-7">
																	<input type="checkbox" name="chkInformed" id="chkInformed" value="1"  <?php if($chkInformed == "1") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?> >&nbsp;&nbsp; Informed to my concern department
														        </div>
													        </div>
													        <div class="col-sm-12 table-responsive">
																<table  class="table table-bordered table-striped">
																    <tr>
																		<th class="" style="text-align:center;">Name of the Office</th>
																		<th class="" style="text-align:center;">Date of Joining</th>
																		<th class="" style="text-align:center;">Name of Post</th>
																	</tr>

																	<tr>
																		<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtNameOfOffice" name="txtNameOfOffice" maxlength="90" value="<?=$txtNameOfOffice?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
																		<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtDOJ" readonly="" name="txtDOJ" value="<?=$txtDOJ?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
																		<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtNameOfPost" name="txtNameOfPost" maxlength="500" value="<?=$txtNameOfPost?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
																	</tr>
																	
																</table>													   
															</div>
														</div>
														
														<div class="col-sm-12 form-group">
													        <div class="col-sm-7">
													        <label for="" ><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Have you ever been debarred by any service commission/board etc. ?</label>
															</div>
															<div class="col-sm-5">
																<label class="radio-inline">
																	<input type="radio" name="empDisciplinary" id="empDisciplinaryno" value="NO" <?php if($empDisciplinary=="NO") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> NO
																</label>
																<label class="radio-inline">
																	<input type="radio" name="empDisciplinary" id="empDisciplinaryyes" value="YES" <?php if($empDisciplinary=="YES") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> YES
																</label>
															</div>
														</div>
														<div id="divEmpDisciplinaryInfo" class="col-sm-12">
													       <div class="col-sm-12 table-responsive">
																<table  class="table table-bordered table-striped">
																    <tr>
																		<th class="" style="text-align:center;">Date</th>
																		<th class="" style="text-align:center;">Period of Debarrment</th>
																	</tr>

																	<tr>
																		<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtDateOfDebar" name="txtDateOfDebar" value="<?=$txtDateOfDebar?>" readonly="" <?php echo $show==1?'disabled':''; ?>/></div></td>
																		<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtPeriodOfDebar" name="txtPeriodOfDebar" maxlength="500" value="<?=$txtPeriodOfDebar?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
																	</tr>
																	
																</table>													   
															</div>
														</div>
													 	
														<!--<div class="col-sm-12 form-group"style="display: none;" >
													        <div class="col-sm-7">
																<label for="" ><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp; How Would You Pay The Application Fee? </label>
															</div>
															<div class="col-sm-5">
																
																<label class="radio-inline">
																	<input type="radio" name="mode" id="modeOnline" value="Online" checked <?php if($mode=="Online") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?> > Online
																</label>
																<label class="radio-inline">
																	<input type="radio" name="mode" id="modeOffline" value="Offline" <?php if($mode=="Offline") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?> > Offline (Challan)
																</label>
															</div>
														</div>-->
													</fieldset><br /><br />
													</div>
													<!--<div class="col-lg-12" id="forReservedQuota" style="box-shadow:  0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;margin-top: 35px;">
													 	<div id="offlineMode"  class="row"  style="margin-top: 20px;">
															<div class="col-lg-12">
																<div class="form-group" >
																	<p>
																		<b> Please note: </b><br />

																			Step 1. Deposit the fee( as per your category) in the below A/c in a challan in the bank, <br />

																			Step 2. Scan the challan receipt and upload it in the document upload section, <br />

																			Step 3. Enter the challan number, bank name, branch name and challan date in the fields provided in the payment section.<br />

																			<b>Bank Name : </b>   <br />
																			<b>Branch Name :</b>  <br />
																			<b>Name of Payee  :</b> KORAPUT <br />
																			<b>A/c No.</b> <br />
																			<b>IFSC Code  :</b> <br />
																			
																			<b>IMP to note:</b> Offline payment verification and confirmation will take at least 3 working days! <br />
																	</p>
																</div>
															</div>
														</div>
														<div  id="onlineMode" class="row"  style="margin-top: 20px;">
															<div class="col-lg-12">
																<div class="form-group" >
																	<p>You can use Debit Card, Credit Card and Net banking.</p>
																</div>
															</div>
														</div>
													</div>-->
												<?php if($show != 1) { ?>
													<div class="form-group">
															<div >
																<br />
																<a class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5 btn btn-warning btnPrevious" > &laquo; Previous </a> 
																<a class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-5" ></a> 
																<button class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5 btn btn-warning" type="submit"> Save & Next &raquo; </button>
																<!--<a class="btn btn-primary btnPrevious" > &laquo; Previous </a>
																<a class="btn btn-primary btnNext" > Next &raquo; </a>-->
															</div>
														</div>
														<?php } ?>
														<br />
													</form>	
												</div>

												<!-- fourth tab-->
												
												<div class="tab-pane" id="declaration_tab"> 
												<form action="" method="post" id="frmDeclaration" name="frmDeclaration">
													
													<div class="col-lg-12" style="padding: 21px;margin-top: 5px;">
													<fieldset>
														<legend>Declaration</legend>
														<!--<h3 style="text-align: center;margin-top: -6px;color: #666;"> Declaration </h3>-->
														<!--<div style="width: 100%; height: 20px; border-bottom: 1px solid #c2b7b7; text-align: center">
														  <span style="font-size: 16px; padding: 0 10px;">
														    <b>Declaration</b>
														  </span>
														</div>-->
														<br />
														<div class="row">
															<div class="form-group">
																<div class="col-sm-12" align="justify">
																	<input type="checkbox" name="chkUndertaking1" id="chkUndertaking1" value="1" <?php if($edit == 'true'){ echo "checked";} ?>  >
																	I  hereby declare that I have read the detail information/advertisement before submission of this application.I hereby certify that all statements made and information given by me in this application form are true, complete and correct to the best of my knowledge and belief. In the event of any information is being found false or incorrect before or after the interview or appointment, action can be taken against me by the board and my candidature/appointment shall automatically be cancelled/terminated.<br \>
																</div>
															</div>
														</div>
														<br />
														<a class="btn btn-warning btnPrevious" > &laquo; Previous </a>
													</fieldset>
													</div>	

													
													<?php if($show != 1) { ?>
														<div class="form-group" >
															<div class="col-lg-12">
																
																<button type="submit" class="btn btn-warning btn-block btnNext" id="btnPersonalInfo" name="btnPersonalInfo"  onclick="return validate();"   style="margin-top: 20px;font-size:16px;"><span class="glyphicon glyphicon-send" style="font-size:18px;"></span> Save & Next</button>
															</div>
														</div>	
														<?php } ?>
												</form>
												</div>
											</div>
										<!--</form>-->
									</div>
									</div>
								</div>	
								</div>
								</div>
			</div>
		</div>
		<div class="hidden-xs hidden-sm col-md-1 col-lg-1 col-xl-1" >
		
		</div>
	</div><!--/col-lg-12-->
</div>
	

<!--<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrapValidator.js"></script>-->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/selectize_master/dist/js/standalone/selectize.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
<script>
	 prefernce1_drop="<?=$center_name1?>";
	 prefernce2_drop="<?=$center_name2?>";
	 prefernce3_drop="<?=$center_name3?>";
</script>
<script src="<?php echo base_url(); ?>public/assets/js/template004.js?v=<?php rand()?>"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.js"></script>

<!--  <link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet"> -->
<script type="text/javascript">

function uncheck(){
	$('#chksameasresidential').prop('checked', false); // Unchecks it
	$('#city_name1').attr('disabled', false);
	/*$('#co_name1').attr('disabled', true);*/
	/*$('#phone_no1').attr('disabled', true);*/
	$('#txtPermenentLocality').attr('disabled', false);
	$('#txtPermanentPost').attr('disabled', false);
	$('#cmbPermanentDist').attr('disabled', false);
	$('#cmbPermanentState').attr('disabled', false);
	$('#txtPermanentPin').attr('disabled', false);
	$('#txtOtherPermanentState').attr('disabled', false);
	$('#txtOtherPermanentDist').attr('disabled', false);
}
var birthyear = "<?=$y?>";
var todayyear = (new Date()).getFullYear();
function show(x) { 
	//document.getElementById(x).style.display = 'block';
	
	$('#'+x).find('input:text').val('');  
	$('#'+x).find('select').val('');  
	if(x == 'belongsto'){
		$('#frmApply').data('bootstrapValidator').updateStatus('cmbNorthState', 'INVALID',null);
	}
	if(x=='employer_id'){
		$('#frmApply').data('bootstrapValidator').updateStatus('Employer_address', 'INVALID',null);
		$('#frmApply').data('bootstrapValidator').updateStatus('Employer_from', 'INVALID',null);
		//$('#frmApply').data('bootstrapValidator').updateStatus('Employer_to', 'INVALID',null);
	}
}
function hide(x) { 
	//document.getElementById(x).style.display = 'none';
	
	$('#'+x).find('input:text').val('');
	$('#'+x).find('select').val(''); 
	//$('#frmApply').data('bootstrapValidator').resetField($('#cmbNorthState'));
	if(x == 'belongsto'){
		$('#frmApply').data('bootstrapValidator').updateStatus('cmbNorthState', 'INVALID',null);
	}
	if(x=='employer_id'){
		$('#frmApply').data('bootstrapValidator').updateStatus('Employer_address', 'INVALID',null);
		$('#frmApply').data('bootstrapValidator').updateStatus('Employer_from', 'INVALID',null);
		//$('#frmApply').data('bootstrapValidator').updateStatus('Employer_to', 'INVALID',null);
	}
}
$('#Employer_from').datepicker({
    format: "dd-mm-yyyy",
  	todayHighlight:true,
  	autoclose:true,
  	startDate:"<?=$txtDobDateFormat?>",
  	endDate:"+0d",
}).on('changeDate', function(e) { 
	$('#frmApply').data('bootstrapValidator').updateStatus('Employer_from', 'VALID', null);
	$('#emp_to').show();
	$('#Employer_to').datepicker('setStartDate', $('#Employer_from').val());
});
$('#Employer_to').datepicker({
    format: "dd-mm-yyyy",
  	todayHighlight:true,
  	autoclose:true,
  	startDate:$('#Employer_from').val(),
  	endDate:"+0d",
});
$('#completion_date').datepicker({
    format: "dd-mm-yyyy",
  	todayHighlight:true,
  	autoclose:true,
  	startDate:"<?=$txtDobDateFormat?>",
  	endDate:"27-09-2018",
}).on('changeDate', function(e) { 
	$('#frmApply').data('bootstrapValidator').updateStatus('completion_date', 'VALID', null);
});




if($('.grad').val() == 'Other')
{
	$('#container_grad').show();
}
else
{
	$('#container_grad').hide();	
}
 $('.grad').change(function () {
    var value = $(this).val(); 
    if (value == 'Other') {
       $('#container_grad').show();
    }
    else
    {
	   $('#container_grad').hide();	
	   $('#txtOther_grad').val('');
       $('#txtOther_grad').html('');
	}
    

});			 
					 
var admcode = '<?php echo $seladmcode ?>'	
var institutedata = {
		admcode:admcode
	};
		 
var dtblPromoter = $('#dtblPromoter').dataTable({
    "ajax":
	{
		"url": base_url+"/ajax_controller/add_table_research",
		"type": "POST",
		"data": institutedata,
	},
	"bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bSort": false,
    "bInfo": false,
    "bAutoWidth": true,
    "bDestroy": true,
    "scrollX":true ,
    //"sDom":"<'row'<'col-xs-5'i><'col-xs-7'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-4 ' >>><'col-xs-6'>>",
	"aoColumns": [
	   	{ "sName": "sl_no","sWidth": "5%","sClass":"alignCenter", mRender:function(data,type,full){
	   		return '<span class="serial_no">'+data+'</span>';
	   	}},    
       	{ "sName": "organization","sWidth": "15%","sClass":"alignCenter" },
       	{ "sName": "post_held","sWidth": "15%","sClass":"alignCenter" },
	   	{ "sName": "pay_band","sWidth": "15%","sClass":"alignCenter"},
	    { "sName": "basic_pay","sWidth":"15%" },
       	{ "sName": "date_from","sWidth": "15%","sClass":"alignCenter"},
       	{ "sName": "date_to","sWidth": "15%","sClass":"alignCenter"},
       	{ "sName": "nature_of_job","sWidth": "15%","sClass":"alignCenter" },
       	{ "sName": "remove","sWidth": "5%","sClass":"alignCenter","mRender": function( data, type, full ) {
				return '<button type="button" class="btn btn-danger btn-circle" id="rowDelete" <?php echo $show==1?"disabled":""; ?>><i class="fa fa-trash-o"></i></button>';
							        
		} },
    ] 
});

var tblQual = $('#tblQual').dataTable({
	"bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bSort": false,
    "bInfo": false,
    "bAutoWidth": false,
    "bDestroy": true
});
//datatable to show header properly after adding scrollX 
$('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
   $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust()
      .responsive.recalc();
});
	//Add EL/CL in Datatable
$('#btnPromoter').click(function(){
	
		

    var sl_no_count = 1;
    var add_status = true;
    $('input[name="txtorganization[]"]').each(function(){
	    var organization = $(this).val();
	    if(organization == '')
	    {
	    	toastr.error("Please enter the Institute Name");
	    	add_status = false;
	    }
	    else
	    	add_status = true;
    });
    if(add_status == true){
		$('input[name="txtpost_held[]"]').each(function(){
        var post_held = $(this).val();
	        if(post_held == '')
	        {
	    		toastr.error("Please enter the Post Held No");
	    		add_status = false;
	    	}
	   		else
	     	add_status = true;
	    });
	}
    if(add_status == true){
	    $('input[name="txtpay_band[]"]').each(function(){
	        var pay_band = $(this).val();
	        if(pay_band == '')
	        {
		    	toastr.error("Please enter the Scale of Pay");
		    	add_status = false;
			}
		    else
		    	add_status = true;
	    });
	}
	if(add_status == true){
	    $('select[name="txtbasic_pay[]"]').each(function(){
	        var basic_pay = $(this).val();
	        if(basic_pay == '')
	        {
		    	toastr.error("Please select the Basic Pay");
		    	add_status = false;
			}
		    else
		    	add_status = true;
	    });
	}
	if(add_status == true){
	    $('select[name="txtdate_from[]"]').each(function(){
	        var date_from = $(this).val();
	        if(date_from == '')
	        {
		    	toastr.error("Please enter the From Period");
		    	add_status = false;
			}
		    else
		    	add_status = true;
	    });
	}
	if(add_status == true){
		$('select[name="txtdate_to[]"]').each(function(){
	        var date_to = $(this).val();
	        if(date_to == '')
	        {
		    	toastr.error("Please enter the To Period");
		    	add_status = false;
			}
		    else
		    	add_status = true;
	    });
	}
	if(add_status == true){
	    $('input[name="txtnature_of_job[]"]').each(function(){
	        var nature_of_job = $(this).val();
	        if(nature_of_job == '')
	        {
		    	toastr.error("Please enter the nature of duties/work");
		    	add_status = false;
			}
		    else
		    	add_status = true;
	    });
	}
	if(add_status == true)
	{
		re_assign();
	    $('#dtblPromoter').DataTable().row.add
	     ([
	       '<span class="serial_no">'+sl_no_count+'</span>', 
	       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control promoterInput" id="txtorganization'+sl_no_count+'" name="txtorganization[]" onkeypress=" return textvalidate(this.id)" onblur="this.value=this.value.toUpperCase()" ></div></div>', 
	       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control " id="txtpost_held'+sl_no_count+'" name="txtpost_held[]"  required></div></div>', 
	       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control " id="txtpay_band'+sl_no_count+'" name="txtpay_band[]" ></div></div>', 
	       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control " id="txtbasic_pay'+sl_no_count+'" name="txtbasic_pay[]" ></div></div>', 
	       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control date " id="txtdate_from'+sl_no_count+'" name="txtdate_from[]" ></div></div>',
	       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control date " id="txtdate_to'+sl_no_count+'" name="txtdate_to[]" ></div></div>',
	       '<div class="col-md-12"><div class="form-group"><input type="text" maxlength="30" class="form-control " id="txtnature_of_job'+sl_no_count+'" name="txtnature_of_job[]" ></div></div>',
	       '<button type="button" class="btn btn-danger btn-circle" id="rowDelete"><i class="fa fa-trash-o"></i></button>' 
	     ]).draw();
     	
     	
     	$(".date").datepicker({
			format: "dd-mm-yyyy",
			todayHighlight:true,
			autoclose:true,
		});
		
     	re_assign();
      	sl_no_count ++;
	}
					//Remove Refund Data from table
});

$('#btnAddQual').click(function(){
	alert("dsadas");
    var sl_no_count = 9;
    var add_status = true;
    
	if(add_status == true)
	{
		re_assign();
	    $('#tblQual').DataTable().row.add
	     ([
	       '<td><div class="form-group"><input type="text" width="10%" maxlength="30" class="form-control input-sm" id="txtQualification'+sl_no_count+'" name="txtQualification[]" onkeypress=" return textvalidate(this.id)" onblur="this.value=this.value.toUpperCase()" ></div></td>', 
	       '<td><div class="form-group"><input type="text" width="10%" maxlength="30" class="form-control " id="txtqual2'+sl_no_count+'" name="txtqual2[]"  required></div></td>', 
	       '<td><div class="form-group"><input type="text" width="10%" maxlength="30" class="form-control " id="txtYear'+sl_no_count+'" name="txtYear[]" ></div></td>', 
	       '<td><div class="form-group"><input type="text" width="10%" maxlength="30" class="form-control " id="txtBoard'+sl_no_count+'" name="txtBoard[]" ></div></td>', 
	       '<td><div class="form-group"><input type="text" width="10%" maxlength="30" class="form-control " id="txtsubject'+sl_no_count+'" name="txtsubject[]" ></div></td>',
	       '<td><div class="form-group"><input type="text" width="10%" maxlength="30" class="form-control " id="txtgrading'+sl_no_count+'" name="txtgrading[]" ></div></td>',
	       '<td><div class="form-group"><input type="text" width="10%" maxlength="30" class="form-control " id="txtPercent'+sl_no_count+'" name="txtPercent[]" ></div></td>',
	       '<td><div class="form-group"><input type="text" width="10%" maxlength="30" class="form-control " id="txtdistinct'+sl_no_count+'" name="txtdistinct[]" ></div></td>'
	     ]).draw();
		
     	re_assign();
      	sl_no_count ++;
	}
					//Remove Refund Data from table
});

$(".date").datepicker({
	format: "dd-mm-yyyy",
	todayHighlight:true,
	autoclose:true,
});

yr = "<?=$txtDobDateFormat?>";
	$("#txtDOJ").datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
		startDate:yr,
		/*startDate:"<?=$txtDobDateFormat?>",*/
    });
	//alert(yr);
	yre = "<?=$txtDobDateFormat?>";
	$("#txtDateOfDebar").datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
		startDate:yre,
		/*startDate:"<?=$txtDobDateFormat?>",*/
    });	
/*function textvalidate(event) {
	
	
	value = document.getElementById(event).value;
	alert(value);
	
    if (!/^[a-zA-Z]*$/g.test(document.myForm.name.value)) {
        alert("Invalid characters");
        document.myForm.name.focus();
        return false;
    }
}*/
	
	$('#dtblPromoter tbody').on( 'click', '#rowDelete', function () {
		//var dtblPromoter =  $('#dtblPromoter').dataTable();
		var aPos = dtblPromoter.fnGetPosition( $(this).closest('tr').get(0));
		// Delete the row
		dtblPromoter.fnDeleteRow(aPos);
		add_status = true;
		re_assign();
	});
	//when delete the row, it will re-assign the sl_no.
	function re_assign()
	{
		var renum = 1;
		$("tr td .serial_no").each(function(){
		  	$(this).text(renum);
		  	renum++;
		});
		sl_no_count = renum;
	}
					 
					
</script>

<style>
	#tblPersonal {
		/* border: 1px solid #e0e0e0; */
		/* border-top: 1px solid !important; */
	}
	@media only screen and (max-width: 320px) {
		/* For mobile phones: */
		[class*="col-xs-12"] {
			width: 100%;
		}
	}

  	.login-box-body, .register-box-body {

  	}
</style>
<script>
var selecting_value = "<?=$graduation_quali?>";

</script>