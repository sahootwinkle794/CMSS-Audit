<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata');
$now = date('Y-m-d h:i:s', now());

$ones = array('','One','Two','Three','Four','Five','Six','Seven','Eight','Nine','Ten','Eleven','Twelve','Thirteen','Fourteen','Fifteen','Sixteen','Seventeen','Eighteen','Nineteen','Twenty','Twenty-one','Twenty-two','Twenty-three','Twenty-four','Twenty-five','Twenty-six','Twenty-seven','Twenty-eight','Twenty-nine','Thirty','Thirty-one','Thirty-two','Thirty-three','Thirty-four','Thirty-five','Thirty-six','Thirty-seven','Thirty-eight','Thirty-nine','Fourty',
      'Fourty-one','Fourty-two','Fourty-three','Fourty-four','Fourty-five','Fourty-six','Fourty-seven','Fourty-eight','Fourty-nine','Fifty','Fifty-one','Fifty-two','Fifty-three','Fifty-four','Fifty-five','Fifty-six','Fifty-seven','Fifty-eight','Fifty-nine','Sixty','Sixty-one','Sixty-two','Sixty-three','Sixty-four','Sixty-five','Sixty-six','Sixty-seven','Sixty-eight','Sixty-nine','Seventy',
      'Seventy-one','Seventy-two','Seventy-three','Seventy-four','Seventy-five','Seventy-six','Seventy-seven','Seventy-eight','Seventy-nine','Eighty','Eighty-one','Eighty-two','Eighty-three','Eighty-four','Eighty-five','Eighty-six','Eighty-seven','Eighty-eight','Eighty-nine','Ninety','Ninety-one','Ninety-two','Ninety-three','Ninety-four','Ninety-five','Ninety-six','Ninety-seven','Ninety-eight','Ninety-nine');
$oneswords = array(
"",
 " first",
 " second",
 " third",
 " fourth",
 " fiveth",
 " sixth",
 " seventh",
 " eighth",
 " nineth",
 " tenth",
 " eleventh",
 " twelveth",
 " thirteenth",
 " fourteenth",
 " fifteenth",
 " sixteenth",
 " seventeenth",
 " eighteenth",
 " nineteenth",
 "twentiethth",
 "thirtieth"
);
 
$tens = array(
 "",
 "",
 " twenty",
 " thirty",
 " forty",
 " fifty",
 " sixty",
 " seventy",
 " eighty",
 " ninety"
);


function convertBirthdateToText($date){
	 global $ones, $oneswords, $tens, $triplets;
    list( $day,$month,$year) = preg_split('[-]', $date);
   	" Day: $day; Month: $month; Year: $year<br />\n";
	$str = "";
	$year1 ="";
	$year2 = "";
	//CONVERT DAY INTO WORDS
	if($day < '10'){
		$day = ltrim($day, "0");
	}
	if($day == '20'){
		 $str =  'Twentieth of ';
	}
	elseif($day == '30'){
		 $str =  'Thirtieth of ';
	}
	elseif($day < '20'){
		 $str = ucwords($oneswords[$day]);
	}
	elseif($day > '20' && $day < '30' ){
		$str .= 'Twenty' . ucwords($oneswords[$day % 10]).' of ';
	}
	elseif($day > '30'){
		 $str .= 'Thirty' . ucwords($oneswords[$day % 10]).' of ';
	}
	//CONVERT MONTH INTO WORDS
	 $monthName = date('F', mktime(0, 0, 0, $month, 10));
	 $str .=  " " .$monthName." ";
	 //CONVERT YEAR INTO WORDS
	 $year1 = substr($year,0,2);
	$year2 = ltrim(substr($year,2,4), '0');
	if($year2 != '')
	{
		$year_second = substr($year,1,1);
		if($year_second == 0)
		{
			$str .= ucwords($ones[substr($year,0,1)]).' Thousand '.ucwords($ones[$year2]);
		}
		else
		{
			$str .= ucwords($ones[$year1]).' Hundred '.ucwords($ones[$year2]);
		}
		return $str;
	}
	else
	{
		$str .= ucwords($ones[$year1]).' Hundred ';
		return $str;
	}
	 //$str .= $ones[$year1].' Hundred '.$ones[$year2];
	  
	
}



//print_r($allQualifications);
//print_r($center_choice);die();
//echo ($choice_details_data['center_choice']);die();
$choiceData = ($choice_details_data[0]['center_choice']);
//echo $choiceData;
foreach($program_data as $row)
{
	$admcode = $row['program_code'];
	$program_group_name = $row['program_group_name'];
	$seladmcode = $row['program_code'];
	$prog = explode('_',$seladmcode);
	$abs_program_code = $prog[0];
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


$MothersName='';
$MothersProfession='';

$FathersAdhar='';
$MothersAdhar='';

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
$txtMS5 = '';
$txtFM5 ='';
$txtPercent5 = '';
$txtsubject5 = '';
$txtdistinct5 = '';
$empDisciplinaryInfo = '';
$empDisciplinary = '';
$relevantinfo = '';
$empsuspendedinfo = '';
$is_employe_disc = '';

$txtgrading1 = '';
$txtgrading2 = '';
$txtgrading3 = '';
$txtgrading4 = '';

$txtqual21 = '';
$txtqual22 = '';
$txtqual23 = '';
$txtqual24 = '';

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

$cmbSecondLanguage = '';
$txtMotherTongue = '';
$radioIllness = '';
$radioIllness = '';
$radioSingleChild = '';
$radiotransfer = '';
$txtChronicIllness = '';
$cmbTransportMode = '';
$radioPreviousSchool = '';
$taPreviousSchool = '';
$txtGrade = '';
$txtLastSession = '';
$cmbAdmissionReason = '';
$txtMotherQualification = '';
$txtFatherQualification = '';
$txtMotherOccupation = '';
$txtFatherOccupation = '';
$txtFatherDesignation = '';
$txtMotherDesignation = '';
$txtFatherDuties = '';
$txtMotherDuties = '';
$txtareaMotherOffice = '';
$txtareaFatherOffice = '';
$txtFatherIncome = '';
$txtMotherIncome = '';
$txtFatherPhoneRes = '';
$txtMotherPhoneRes = '';
$txtFatherPhoneMob = '';
$txtMotherPhoneMob = '';
$txtFatherEmail = '';
$txtMotherEmail = '';
$txtFatherAdhar = '';
$txtMotherAdhar = '';
$txtOtherPresentDistrict = '';
$txtOtherPermanentDist = '';
$txtOtherPermanentState = '';
$chkParentAlive = '';
$txtGuardian = '';


$txtEmailId = '';

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
foreach($registration_data as $row)
{
	$txtFirstName = $row['first_name'];
	$txtRegUserId = $row['reg_user_id'];
	$reg_user_id = $row['reg_user_id'];
	$txtMiddleName = $row['mid_name'];
	$txtLastName = $row['last_name'];
	$txtEmailId   = $row['email_id'];
	$txtDob = $row['dob'];
	
	$dob1 = explode('-',$txtDob);
	$d = $dob1[2];
	$m = $dob1[1];
	$y = $dob1[0];
	$txtDobDateFormat = $d.'-'.$m.'-'.$y;
	$date_of_birth = date("d-m-Y", strtotime($txtDob) );
	$date_in_word = trim(convertBirthdateToText($date_of_birth));
}
foreach($application_data as $row)
{
	$application_no = $row['appl_no'];
	$appl_status = $row['appl_status'];
	if($application_no != '')
		$edit = "true";
	if($appl_status == 'Verified' || $appl_status == 'Fee Paid' )
		$show = 1;
}
//********************************************* Details in template *******************************//

foreach($applicant_data as $row)
{
	$cmbExamCenter = $row['exam_center_code'];
	$txtFirstName = $row['first_name'];
	$txtMiddleName = $row['mid_name'];
	$txtLastName = $row['last_name'];
	$fullname = $txtFirstName." ".$txtMiddleName." ".$txtLastName;
	$dob1 = explode("-",$row['dob1']);
	$radiogender = $row['gender'];
	$radio_prof = $row['id_proof'];
	$chkParentAlive = $row['are_parents_alive'];
	
	$relevantinfo = $row['relevantinfo'];
	$enclosuresdetails = $row['enclosuresdetails'];
	
	//echo $radio_prof;
	
	$id_proof_number = $row['id_proof_number'];
	
	$radioJEE = $row['jee_place'];
	$radioHostel = $row['hostel_facility'];
	$radiomaritalstatus = $row['marital_status'];
	//$txtEmailId = $row['applicant_email'];
	$cmbNationality = $row['nationality'];
	$txtOtherNationality = $row['nationality_oth']; 
	$cmbReservedCategory = $row['category'];
	$radioPreviousSchool = $row['is_school_attended'];
	$taPreviousSchool = $row['last_school'];
	$txtGrade = $row['last_grade'];
	$txtLastSession = $row['session_last_attended'];
	$cmbAdmissionReason = $row['admission_reason'];
	//$radioHandicapped = $row['is_physically_challanged'];
	$radioPhysicallY  = $row['physically_challenged'];
	$radioMinority   = $row['is_minority_community'];
	$cmbSecondLanguage = $row['second_language'];
	$txtMotherTongue = $row['mother_tongue'];
	$radioMarkSheet   = $row['is_passed'];
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
	$cmbTransportMode = $row['mode_of_transport'];
	$radioSingleGirlChild = $row['single_girl_child_flag'];
	$radioIllness = $row['if_chronic_illness'];
	$radioQuota = $row['is_reserved_quota'];
	$txtChronicIllness = $row['chronic_illness'];
	$radioAllergies = $row['if_allergies'];
	$txtAllergies = $row['allergies'];
	$radiotransfer = $row['is_transfer'];
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
	$radioSingleChild = $row['is_single_child'];
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

	$is_employed=$row['is_suspended'];
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
	$FathersAdhar=$row['fathers_adhar_no'];
	$MothersAdhar=$row['mothers_adhar_no'];

	$completion_date=$row['completion_date'];
	$txtfinalpercentage=$row['last_year_mark'];
	
	$empsuspended=$row['is_suspended'];
	$empsuspendedinfo=$row['suspendedInfo'];
	$empDisciplinary=$row['any_disciplinary_action'];
	$empDisciplinaryInfo=$row['disciplinaryInfo'];
	
	$txtGuardian = $row['guardian_name'];
	
	
	/*$amount_paid=$row['amount_paid'];
	$draft_no=$row['draft_no'];
	$payment_date=$row['payment_date'];
	$bank_name=$row['bank_name'];*/
	
}
foreach($allOtherInfo as $row)
{
	$allOtherInfos[$row['field_name']] = $row['field_value'];
}

$txtOtherBoard = isset($allOtherInfos["Name of the Board"]) ? $allOtherInfos["Name of the Board"] : '';  
$txtOtherReason = isset($allOtherInfos["Reason of Admission"]) ? $allOtherInfos["Reason of Admission"] : '';  

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
	$txtOtherPresentDistrict = isset($allOtherInfos["Present District"]) ? $allOtherInfos["Present District"] : ''; 
	$txtOtherPresentState = isset($allOtherInfos["Present State"]) ? $allOtherInfos["Present State"] : ''; 
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
	$txtOtherPermanentDist = isset($allOtherInfos["Permanent District"]) ? $allOtherInfos["Permanent District"] : ''; 
	$txtOtherPermanentState = isset($allOtherInfos["Permanent State"]) ? $allOtherInfos["Permanent State"] : ''; 
}
foreach($father_data as $row)
{
	$txtFatherName = $row['rel_name'];
	$txtFatherOccupation = $row['rel_occupation'];
	$txtFatherQualification = $row['rel_qualification'];
	$txtFatherDesignation = $row['rel_desig'];
	$txtFatherDuties = $row['nature_of_work'];
	$txtareaFatherOffice = $row['place_work'];
	$txtFatherIncome = $row['annual_income'];
	$txtFatherPhoneRes = $row['res_no'];
	$txtFatherPhoneMob = $row['mobile_no'];
	$txtFatherAdhar = $row['rel_adhar_no'];
	$txtFatherEmail = $row['email_id']; 
}
foreach($mother_data as $row)
{
	$txtMotherName = $row['rel_name'];
	$txtMotherQualification = $row['rel_qualification'];
	$txtMotherOccupation = $row['rel_occupation'];
	$txtMotherDesignation = $row['rel_desig'];
	$txtMotherDuties = $row['nature_of_work'];
	$txtMotherAdhar = $row['rel_adhar_no'];
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

$sl = 1;
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
	
	$sl++;
}

foreach($tech_qual_data_5 as $row)
{
	$technical_5_1 = $row['qual_desc_1'];
	$technical_5_2= $row['year'];
	$technical_5_3 = $row['institute_name'];
	$technical_5_4 = $row['thesis'];
}
foreach($tech_qual_data_6 as $row)
{
	$technical_6_1 = $row['qual_desc_1'];
	$technical_6_2= $row['year'];
	$technical_6_3 = $row['institute_name'];
	$technical_6_4 = $row['thesis'];
}
foreach($tech_qual_data_7 as $row)
{
	$technical_7_1 = $row['qual_desc_1'];
	$technical_7_2= $row['year'];
	$technical_7_3 = $row['institute_name'];
	$technical_7_4 = $row['thesis'];
}

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
	
	if(document.getElementById("chksameasresidential").checked)
	{
		$('#frmApply').data('bootstrapValidator').updateStatus('txtPermenentLocality', 'VALID',null);
		$('#frmApply').data('bootstrapValidator').updateStatus('txtPermanentPost', 'VALID',null);
		$('#frmApply').data('bootstrapValidator').updateStatus('cmbPermanentDist', 'VALID',null);
		/*$('#frmApply').data('bootstrapValidator').updateStatus('cand_name1', 'VALID',null);*/
		$('#frmApply').data('bootstrapValidator').updateStatus('city_name1', 'VALID',null);
		/*$('#frmApply').data('bootstrapValidator').updateStatus('co_name1', 'VALID',null);*/
		/*$('#frmApply').data('bootstrapValidator').updateStatus('phone_no1', 'VALID',null);*/
		$('#frmApply').data('bootstrapValidator').updateStatus('cmbPermanentState', 'VALID',null);
		$('#frmApply').data('bootstrapValidator').updateStatus('txtPermanentPin', 'VALID',null);
		
		
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
		$('#frmApply').data('bootstrapValidator').updateStatus('txtPermenentLocality', 'INVALID',null);
		$('#frmApply').data('bootstrapValidator').updateStatus('txtPermanentPost', 'INVALID',null);
		$('#frmApply').data('bootstrapValidator').updateStatus('cmbPermanentDist', 'INVALID',null);
		/*$('#frmApply').data('bootstrapValidator').updateStatus('cand_name1', 'INVALID',null);*/
		$('#frmApply').data('bootstrapValidator').updateStatus('city_name1', 'INVALID',null);
		/*$('#frmApply').data('bootstrapValidator').updateStatus('co_name1', 'INVALID',null);*/
		/*$('#frmApply').data('bootstrapValidator').updateStatus('phone_no1', 'INVALID',null);*/
		$('#frmApply').data('bootstrapValidator').updateStatus('cmbPermanentState', 'INVALID',null);
		$('#frmApply').data('bootstrapValidator').updateStatus('txtPermanentPin', 'INVALID',null);
		/*document.getElementById("cand_name1").value = "";*/
		document.getElementById("city_name1").value = "";
		/*document.getElementById("co_name1").value = "";*/
		/*document.getElementById("phone_no1").value = "";*/
		document.getElementById("txtPermenentLocality").value = "";
		document.getElementById("txtPermanentPost").value = "";
		document.getElementById("cmbPermanentDist").value = "";
		document.getElementById("cmbPermanentState").value = "";
		document.getElementById("txtPermanentPin").value = "";
		$("#forStatePermanent").hide();
		$("#forDistPermanent").hide();
		

		/*$('#cand_name1').removeAttr('disabled', false);*/
		$('#city_name1').removeAttr('disabled', false);
		/*$('#co_name1').removeAttr('disabled', false);*/
		/*$('#phone_no1').removeAttr('disabled', false);*/
		$('#txtPermenentLocality').removeAttr('disabled', false);
		$('#txtPermanentPost').removeAttr('disabled', false);
		$('#cmbPermanentDist').removeAttr('disabled', false);
		$('#cmbPermanentState').removeAttr('disabled', false);
		$('#txtPermanentPin').removeAttr('disabled', false);
		$('#txtOtherPermanentState').removeAttr('disabled', false);
		$('#txtOtherPermanentDist').removeAttr('disabled', false);
		/*$('#cand_name1').removeAttr("disabled");
		$('#city_name1').removeAttr("disabled");
		$('#co_name1').removeAttr("disabled");
		$('#phone_no1').removeAttr("disabled");
		$('#txtemail1').removeAttr("disabled");
		
		$('#txtPermenentLocality').removeAttr("disabled");
		$('#txtPermanentPost').removeAttr("disabled");
		$('#cmbPermanentDist').removeAttr("disabled");
		$('#cmbPermanentState').removeAttr("disabled");
		$('#txtPermanentPin').removeAttr("disabled");
		$('#txtOtherPermanentState').removeAttr("disabled");
		$('#txtOtherPermanentDist').removeAttr("disabled");*/
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
	
	//alert(document.getElementById('txtFatherName').value); txtidproof
	if (((document.getElementById("cmbidproof").value != '') &&  (document.getElementById("txtidproof").value == '') ) || ((document.getElementById('radioPhysicallYY').checked) && (document.getElementById("cmbPH").value == "")) || ((document.getElementById("chksameasresidential").checked  == false) && ((document.getElementById("txtPermanentPin").value == '') || (document.getElementById("city_name").value == '') || (document.getElementById("cmbPermanentState").value == '') || (document.getElementById("cmbPresentDist").value == '') || (document.getElementById("txtPermanentPost").value == '') || (document.getElementById("txtPermenentLocality").value == ''))) || (document.getElementById("txtPresentPin").value == '') || (document.getElementById("city_name").value == '') || (document.getElementById("cmbPresentState").value == '') || (document.getElementById("cmbPresentDist").value == '') || (document.getElementById("txtPresentPost").value == '') || (document.getElementById("txtPresentLocality").value == '') || (document.getElementById('txtFatherName').value == '') || (document.getElementById('cmbCommunity').value == null) ||  (document.getElementById('radiomale').checked == false && document.getElementById('radiofemale').checked == false && document.getElementById('radiotrans').checked == false) || (document.getElementById('radioPhysicallYN').checked == false && document.getElementById('radioPhysicallYY').checked == false) || (document.getElementById('cmbCommunity').value == '' || document.getElementById('cmbCommunity').value == null) ) {
		errorMessage += "One / Some mandatory fields are not entered in Applicant Details Tab.<br/>";
	}
	if(((document.getElementById("txtTechnical_5_2").value != '') && ((document.getElementById("txtTechnical_5_3").value == '') || (document.getElementById("txtTechnical_5_4").value == ''))) ||((document.getElementById("txtTechnical_6_2").value != '') && ((document.getElementById("txtTechnical_6_3").value == '') || (document.getElementById("txtTechnical_6_4").value == ''))) || (document.getElementById("txtPercent1").value == '') || (document.getElementById("txtPercent2").value == '') || (document.getElementById("txtPercent3").value == '') || (document.getElementById("txtPercent4").value == '') || (document.getElementById("txtgrading1").value == '') || (document.getElementById("txtgrading2").value == '') || (document.getElementById("txtgrading3").value == '') || (document.getElementById("txtgrading4").value == '') || (document.getElementById("txtsubject1").value == '') || (document.getElementById("txtsubject2").value == '') || (document.getElementById("txtsubject3").value == '') || (document.getElementById("txtsubject4").value == '') || (document.getElementById("txtBoard1").value == '') || (document.getElementById("txtBoard2").value == '') || (document.getElementById("txtBoard3").value == '') || (document.getElementById("txtBoard4").value == '') || (document.getElementById("txtYear1").value == '') || (document.getElementById("txtYear2").value == '') || (document.getElementById("txtYear3").value == '') || (document.getElementById("txtYear4").value == '') || (document.getElementById("txtqual22").value == '') || (document.getElementById("txtqual24").value == ''))
	{
		errorMessage += "One / Some mandatory fields are not entered in Academic Details Tab.<br/>";
	}
	if((document.getElementById('empDisciplinaryno').checked == false && document.getElementById('empDisciplinaryyes').checked == false) || ((document.getElementById('empDisciplinaryyes').checked) && (document.getElementById("empDisciplinaryInfo").value == "")) || (document.getElementById('empsuspendedno').checked == false && document.getElementById('empsuspendedyes').checked == false) || ((document.getElementById('empsuspendedyes').checked) && (document.getElementById("empsuspendedinfo").value == "")) || (document.getElementById("refmobile1").value == '') || (document.getElementById("refmobile0").value == '') || (document.getElementById("refemail1").value == '') || (document.getElementById("refemail0").value == '') || (document.getElementById("refaddress1").value == '') || (document.getElementById("refaddress0").value == '') || (document.getElementById("refname0").value == '') || (document.getElementById("refname1").value == ''))
	{
		errorMessage += "One / Some mandatory fields are not entered in Information Tab.<br/>";
	}
	
	/*if((document.getElementById('empDisciplinaryno').checked == false && document.getElementById('empDisciplinaryyes').checked == false) || ((document.getElementById('empDisciplinaryyes').checked) && (document.getElementById("empDisciplinaryInfo").value == "")) || (document.getElementById('empsuspendedno').checked == false && document.getElementById('empsuspendedyes').checked == false) || ((document.getElementById('empsuspendedyes').checked) && (document.getElementById("empsuspendedinfo").value == "")))
	{
		errorMessage += "One / Some mandatory fields are not entered in Information Tab.<br/>";
	}*/
	/*if (document.getElementById('cmbCommunity').value == '' || document.getElementById('cmbCommunity'.value) == null) {
		errorMessage += "Please select category.<br/>";
	}
	if (document.getElementById('radiomale').checked == false && document.getElementById('radiofemale').checked == false && document.getElementById('radiotrans').checked == false) {
		errorMessage += "Please check gender.<br/>";
	}
	if (document.getElementById('radioPhysicallYN').checked == false && document.getElementById('radioPhysicallYY').checked == false) {
		errorMessage += "Please check PwD.<br/>";
	}
	if (document.getElementById('empsuspendedno').checked == false && document.getElementById('empsuspendedyes').checked == false) {
		errorMessage += "Please select whether suspended/dismissed from service.<br/>";
	}
	else
	{
		if (document.getElementById('empsuspendedyes').checked) {
			if(document.getElementById("empsuspendedinfo").value == "")
			{
				errorMessage += "Please Enter the information regarding suspended/dismissed from service.<br/>";
			}
		}
	}
	if (document.getElementById('empDisciplinaryno').checked == false && document.getElementById('empDisciplinaryyes').checked == false) {
		errorMessage += "Please select whether subjected to any disciplinary action.<br/>";
	}
	else
	{
		if (document.getElementById('empDisciplinary').checked) {
			if(document.getElementById("empDisciplinaryInfo").value == "")
			{
				errorMessage += "Please Enter the information regarding disciplinary action.<br/>";
			}
		}
	}
	
	if (document.getElementById('radioPhysicallYY').checked) {
		if(document.getElementById("cmbPH").value == "")
		{
			errorMessage += "Please select PwD from the dropdown.<br/>";
		}
	}
	
	
	if(document.getElementById("txtPresentLocality").value == '')
	{
		errorMessage += "Please enter Locality in Present Address.<br/>";
	}
	if(document.getElementById("txtPresentPost").value == '')
	{
		errorMessage += "Please enter Post in Present Address.<br/>";
	}
	if(document.getElementById("cmbPresentDist").value == '')
	{
		errorMessage += "Please enter Dist in Present Address.<br/>";
	}
	if(document.getElementById("cmbPresentState").value == '')
	{
		errorMessage += "Please select State in Present Address.<br/>";
	}
	if(document.getElementById("city_name").value == '')
	{
		errorMessage += "Please enter City in Present Address.<br/>";
	}
	if(document.getElementById("txtPresentPin").value == '')
	{
		errorMessage += "Please enter Pin in Present Address.<br>";
	}
	
	if(document.getElementById("chksameasresidential").checked  == false)
	{
		if(document.getElementById("txtPermenentLocality").value == '')
		{
			errorMessage += "Please enter Locality in Permanent Address.<br/>";
		}
		if(document.getElementById("txtPermanentPost").value == '')
		{
			errorMessage += "Please enter Post in Permanent Address.<br/>";
		}
		if(document.getElementById("cmbPermanentDist").value == '')
		{
			errorMessage += "Please enter Dist in Permanent Address.<br/>";
		}
		if(document.getElementById("cmbPermanentState").value == '')
		{
			errorMessage += "Please select State in Permanent Address.<br/>";
		}
		if(document.getElementById("city_name").value == '')
		{
			errorMessage += "Please enter City in Permanent Address.<br/>";
		}
		if(document.getElementById("txtPermanentPin").value == '')
		{
			errorMessage += "Please enter Pin in Permanent Address.<br>";
		}
	}*/
	
	/*if(document.getElementById("txtMS1").value != '')
	{
		//alert(document.getElementById("txtMS1").value);
		//alert(document.getElementById("txtFM1").value);
		if(parseInt(document.getElementById("txtMS1").value) > parseInt(document.getElementById("txtFM1").value) )
		{
			
			errorMessage += "Marks Secured can not be greater than Maximum marks for 1st Qualification<br/>";
		}
	}
	if(document.getElementById("txtMS2").value != '')
	{
		if(parseInt(document.getElementById("txtMS2").value) > parseInt(document.getElementById("txtFM2").value ))
		{
			errorMessage += "Marks Secured can not be greater than Maximum marks for 2nd Qualification<br/>";
		}
	}
	if(document.getElementById("txtMS3").value != '')
	{
		if(parseInt(document.getElementById("txtMS3").value) > parseInt(document.getElementById("txtFM3").value ))
		{
			errorMessage += "Marks Secured can not be greater than Maximum marks for 3rd Qualification<br/>";
		}
	}*/
	if(parseInt(document.getElementById("txtYear1").value) > parseInt(document.getElementById("txtYear2").value ))
	{
		errorMessage += "Senior Secondary Qualification Year must be greater then Secondary Qualification Year<br/>";
	}
	if(parseInt(document.getElementById("txtYear2").value) > parseInt(document.getElementById("txtYear3").value ))
	{
		errorMessage += "Graduation Qualification Year must be greater then Secondary Qualification Year<br/>";
	}
	/*var birthyear = "<?=$y?>";
	var todayyear = (new Date()).getFullYear();*/
	/*if(document.getElementById("txtYear1").value != '')
	{
		if(parseInt(todayyear) < parseInt(document.getElementById("txtYear1").value))
		{
			errorMessage += "Secondary Qualification Year must be less than current year<br/>";
		}
		if( parseInt(document.getElementById("txtYear1").value) < parseInt(birthyear))
		{
			errorMessage += "Secondary Qualification Year must be greater than your birth year<br/>";
		}
	}
	if(document.getElementById("txtYear2").value != '')
	{
		if(parseInt(todayyear) < parseInt(document.getElementById("txtYear2").value))
		{
			errorMessage += "Senior Secondary Qualification Year must be less than current year<br/>";
		}
		if(parseInt(document.getElementById("txtYear2").value) < parseInt(birthyear))
		{
			errorMessage += "Senior Secondary Qualification Year must be greater than your birth year<br/>";
		}
	}
	if(document.getElementById("txtYear3").value != '')
	{
		if(parseInt(todayyear) < parseInt(document.getElementById("txtYear3").value))
		{
			errorMessage += "Graduation Qualification Year must be less than current year<br/>";
		}
		if(parseInt(document.getElementById("txtYear3").value) < parseInt(birthyear))
		{
			errorMessage += "Graduation Qualification Year must be greater than your birth year<br/>";
		}
	}*/
	/*if(document.getElementById("radioHonours").checked == true )
	{
		if(document.getElementById("txtHonoursSubject").value == '')
		{
			errorMessage += "Please enter Honours Subject<br/>";
		}
		if(document.getElementById("txtHonsTotalMarks").value == '')
		{
			errorMessage += "Please enter Maximum marks in honours<br/>";
		}
		if(document.getElementById("radioPassed").checked == true)
		{
			if(document.getElementById("txtHonsSecuredMarks").value == '')
			{
				errorMessage += "Please enter Total mark secured in honours<br/>";
			}
			if(document.getElementById("txtHonsDivision").value == "")
			{
				errorMessage += "Please enter Division in Honours<br/>";
			}
		}
		
	}*/
	
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
		//var mX = totalMarkX.match('(^100(\.0{1,2})?$)|(^([1-9]([0-9])?|0)(\.[0-9]{1,2})?$)');
		//var mX1 = mathMarkX.match('(^100(\.0{1,2})?$)|(^([1-9]([0-9])?|0)(\.[0-9]{1,2})?$)');
		
		var mX = parseFloat(totalMarkX);
		//alert(mx);
		if(mX > 100.00)
		{
			errorMessage += "Percentage of Mark in Class X should be less than 100.<br>";
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
		//var mX = totalMarkX.match('(^100(\.0{1,2})?$)|(^([1-9]([0-9])?|0)(\.[0-9]{1,2})?$)');
		//var mX1 = mathMarkX.match('(^100(\.0{1,2})?$)|(^([1-9]([0-9])?|0)(\.[0-9]{1,2})?$)');
		
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
		//var mX = totalMarkX.match('(^100(\.0{1,2})?$)|(^([1-9]([0-9])?|0)(\.[0-9]{1,2})?$)');
		//var mX1 = mathMarkX.match('(^100(\.0{1,2})?$)|(^([1-9]([0-9])?|0)(\.[0-9]{1,2})?$)');
		
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
		//var mX = totalMarkX.match('(^100(\.0{1,2})?$)|(^([1-9]([0-9])?|0)(\.[0-9]{1,2})?$)');
		//var mX1 = mathMarkX.match('(^100(\.0{1,2})?$)|(^([1-9]([0-9])?|0)(\.[0-9]{1,2})?$)');
		
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
		/********************************************************************/
	</style>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.css" />
<div class="container-fluid" style=" padding-bottom: 50px;">

	<div class="row" >
		<div class="col-sm-1 col-md-1 col-lg-1 col-xs-1" style="margin-top: 30px;margin-left: -15px;">
			<?php include('sidebar/sidebar.php'); ?>
		</div>

		<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11" style="padding-top:0px;padding-right: 2%;">


			<?php 
			if($edit == 'true') 
			{ 
				if($appl_status == 'Student Details Submitted') 
				{ 
					?>
					<img src="<?=base_url()?>public/assets/images/studentdetails.png" />
					<a href="<?=base_url()?>apply/apply_3/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/documentupload1.png" /></a>

					<?php 
				} 
				else if($appl_status == 'Document Uploaded' || $appl_status == 'Challan Generated' ) 
				{ 
					?>

					<img src="<?=base_url()?>public/assets/images/studentdetails.png" />
					<a href="<?=base_url()?>apply/apply_3/ins/<?=$ins?>" ><img src="<?=base_url()?>public/assets/images/documentupload.png" /></a>
					<a href="<?=base_url()?>apply/apply_4/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/payment1.png" /></a>

					<?php 
				} 
				else if($appl_status == 'Fee Paid' || $appl_status == 'Verified') 
				{ 
					?>
					<img src="<?=base_url()?>public/assets/images/studentdetails.png" />
					<a href="<?=base_url()?>apply/apply_3/ins/<?=$ins?>" ><img src="<?=base_url()?>public/assets/images/documentupload.png" /></a>
					<a href="<?=base_url()?>apply/apply_4/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/payment.png" /></a>
					<?php 
				}  
			}
					else //edit = false
					{ 
						?>
						<?php 
					} 
					?>
					<div class="panel " >
						<!--<div class="panel-heading step-heading" style="text-align: center" >
							<b><?php if($want_program_group[0]['description']=='SHOW'){echo $program_group_name.' ('.$admname.')' ; } else{echo $admname; } ?> </b>
						</div>-->
						<!--<div class="panel-body">
						</div>-->
					</div>
					
					<!--<div class="panel panel-primary">
						<div class="panel-heading step-heading">

							<b><i class="fa fa-user"></i> Application Form</b>
						</div>-->
						<!--<a href="#" class="pull-right" style="margin-top: -4.3%;margin-right: 0.2%" id="btnInstruction" name="btnInstruction" title="Help"><img type="button" src="<?=base_url()?>public/assets/images/helpicon.png" name="btnInstruction" title="Help" id="btnInstruction" style="width:50px;height:50px;cursor:pointer"></img></a>-->
						<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;"> <!-- Alert for error -->
							<div id="alertmessage"></div>
						</div>

					
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
<div id="page-wrapper">
	<div class="row">
		<br />
		<div class="col-lg-12">
			<div class="panel-body">
				<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
				  <form class="form-horizontal" method="post" role="form" id="frmApply" name="frmApply" >
						<div class="form-group">
							<input type="hidden" name="hidDate" id="hidDate" value="<?=$date_in_word?>" >
							<input type="hidden" name="hidProgram" id="hidProgram"  value="<?=$seladmcode?>">
							<input type="hidden" name="hidProgramCode" id="hidProgramCode"  value="<?=$abs_program_code?>">
							<label for="" class="col-sm-3 control-label" style="text-align:left;" ><i class="glyphicon glyphicon-asterisk" style="color:red;font-size:10px;"></i> Registered Mobile No :</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" disabled="disabled" value="<?=$reg_user_id?>" />
							</div>
						</div>
						<div class="divPersonal">
							<div class="form-group" style="margin-top: -20px" >
								<div class="col-sm-12" style="margin-top: -5px">
									<h3 class="section-header">1. Personal Information</h3>
								</div>
							</div>
							<div class="panel-body">
								<table class="table table-striped" id="tblPersonal">
								<tr>
									<td>
										<label for="" class="control-label" ><i style="color:red;font-size:18px;">*</i> First Name</label>
									</td>
									<td>
										<div class="form-group">
											<input type="text" class="form-control" id="txtFirstName" name="txtFirstName" placeholder="Enter First Name" readonly="readonly"  value="<?=strtoupper($txtFirstName)?>" <?php echo $show==1?'disabled':''; ?>>
										</div>
									</td>
									<td>
										<label for="" class="control-label" >Middle Name</label>
									</td>
									<td>
										<div class="form-group">
											<input type="text" class="form-control" id="txtMiddleName" name="txtMiddleName" placeholder="Enter Middle Name" readonly="readonly" value="<?=strtoupper($txtMiddleName)?>" <?php echo $show==1?'disabled':''; ?>>
										</div>
									</td>
									<td>
										
										<label for="" class="control-label" style="margin-left: -2%" ><i style="color:red;font-size:18px;">*</i> Last Name </label>
										
									</td>
									<td>
										<div class="form-group">
											<input type="text" class="form-control" id="txtLastName" name="txtLastName" placeholder="Enter Last Name"  value="<?=strtoupper($txtLastName)?>" readonly="readonly" <?php echo $show==1?'disabled':''; ?>>
										</div>
									</td>	
								</tr>
								<tr>
									<td>
										<label for="" class="control-label" ><i style="color:red;font-size:18px;">*</i> Gender</label>
									</td>
									<td>
										<div class="form-group">
										<label class="radio-inline">
											<input type="radio" name="radiogender" id="radiomale" value="M" <?php if($radiogender=="M") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Male
										</label>
										<label class="radio-inline">
											<input type="radio" name="radiogender" id="radiofemale" value="F" <?php if($radiogender=="F") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Female
										</label>
										</div>
									</td>
									<td>
										<label for="" class="control-label" ><i style="color:red;font-size:18px;">*</i> Nationality</label>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control" name="cmbNationality" id="cmbNationality" <?php echo $show==1?'disabled':''; ?>>
												<option value=''>Select Nationality</option>
<?php
foreach($allNationalities as $row)
{
	$x = ($cmbNationality == $row['nationality_code'] ? ' selected ' : '');
	echo "<option value='".$row['nationality_code']."' $x>".$row['nationality']."</option>";
} 
?>
											</select>
										</div>
									</td>
									<td>
										
									</td>
									<td>
										<div id="forNationality" style="display:none;">
											<input type="text" class="form-control" id="txtOtherNationality" name="txtOtherNationality" placeholder="Please Specify" value="<?=$txtOtherNationality?>" <?php echo $show==1?'disabled':''; ?>>
										</div>
									</td>	
								</tr>
								<tr>
									<td>
										<label for="txtDOB" class="control-label" style="margin-top:-5px;" >Date of Birth :</label>
									</td>
									<td colspan="2">
										Day <select id="cmbDay" name="cmbDay" disabled="disabled" <?php echo $show==1?'disabled':''; ?>>
<?php
for($i=1;$i<=31;$i++)
{
if($i<10)
	$x = '0'.$i;
else
	$x = $i;
$s = ($x == $d ? ' selected ' : '');
echo "<option value='$x' $s>$x</option>	";
}
?>
											</select>
										Month <select id="cmbMonth" name="cmbMonth" disabled="disabled" <?php echo $show==1?'disabled':''; ?>>
<?php
for($i=1;$i<=12;$i++)
{
if($i<10)
	$x = '0'.$i;
else
	$x = $i;
$s = ($x == $m ? ' selected ' : '');
echo "<option value='$x' $s>$x</option>	";
}
?>														
											</select>
										Year <select id="cmbYear" name="cmbYear" disabled="disabled" <?php echo $show==1?'disabled':''; ?>>
<?php
for($i=1900;$i<=2050;$i++)
{
$s = ($i == $y ? ' selected ' : '');
echo "<option value='$i' $s>$i</option>	";
}
?>														
										</select>
									</td>
									<td>
										
									</td>
									<td>
										
									</td>
									<td>
									</td>
								</tr>
								<tr>
									<td>
										<label for="" class="control-label" ><i style="color:red;font-size:18px;">*</i> Category</label>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control" id="cmbCategory" name="cmbCategory" >
												<option value=''>Select Category</option>
<?php
foreach($allCategories as $row)
{
$x = ($hidCategory == $row['category_code'] ? ' selected ' : '');
echo "<option value='".$row['category_code']."' $x>".$row['category_name']."</option>";
} 
?>													
											</select>
										</div>
									</td>
									<td>
										
									</td>
									
									<td colspan="2">
										
										<label for="" class="control-label" style="text-align: right" ><i style="color:red;font-size:18px;">*</i> Second Language</label>
										
									</td>
									<td>
										<div class="form-group">
											<select class="form-control" id="cmbSecondLanguage" name="cmbSecondLanguage">

												<option value="">Select Second Language</option>
												<option value="Hindi" <?php if($cmbSecondLanguage == 'Hindi') echo "selected"?>>Hindi</option>
												<option value="Odia" <?php if($cmbSecondLanguage == 'Odia') echo "selected"?>>Odia</option>
									
											</select>
										</div>
									</td>	
								</tr>
								<tr>
									<td>
										<label for="" class="control-label" ><i style="color:red;font-size:18px;">*</i> Blood Group</label>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control" id="cmbBloodGroup" name="cmbBloodGroup" <?php echo $show==1?'disabled':''; ?>>
												<option value=''>Select Blood Group</option>
<?php
foreach($allBloodGroups as $row)
{
$x = ($cmbBloodGroup == $row['blood_group_code'] ? ' selected ' : '');
echo "<option value='".$row['blood_group_code']."' $x>".$row['blood_group_name']."</option>";
} 
?>													
											</select>
										</div>
									</td>
									<td>
										
									</td>
									
									<td colspan="2">
										
										<label for="" class="control-label" ><i style="color:red;font-size:18px;">*</i> Mother Tongue</label>
										
									</td>
									<td>
										<div class="form-group">
											<input type="text" class="form-control" id="txtMotherTongue" name="txtMotherTongue" placeholder="Enter Mother Tongue" value="<?=$txtMotherTongue?>" <?php echo $show==1?'disabled':''; ?>>
										</div>
									</td>	
								</tr>
								<tr>
									<td colspan="2">
										<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:18px;">*</i>Chronic/serious Illness, if any :</label>
									</td>
									<td>
										<div class="form-group">
										<label class="radio-inline">
											<input type="radio" name="radioIllness" id="radioNoIllness" value="No" <?php if($radioIllness=="No") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> No
										</label>
										<label class="radio-inline">
											 <input type="radio" name="radioIllness" id="radioYesIllness" value="Yes" <?php if($radioIllness=="Yes") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Yes
										</label>
										</div>
									</td>
									<td>
										<div  id="forillness" style="display:none;">
											<input type="text" class="form-control" id="txtChronicIllness" name="txtChronicIllness" placeholder="Enter Chronic illness" maxlength="200" value="<?=$txtChronicIllness?>" <?php echo $show==1?'disabled':''; ?>>
										</div>
									</td>
									<td>
									</td>
									<td>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:18px;">*</i> Whether Parents of Applicant have Come to Bhubaneswar on Transfer?</label>
									</td>
									<td>
										<div class="form-group">
											<label class="radio-inline">
												<input type="radio" name="radiotransfer" id="radiono" value="No" <?php if($radiotransfer=="No") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> No
											</label>
											<label class="radio-inline">
												<input type="radio" name="radiotransfer" id="radioyes" value="Yes" <?php if($radiotransfer=="Yes") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Yes
											</label>
										</div>
									</td>
									<td>
										
									</td>
									<td>
									</td>
									<td>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:18px;">*</i> Whether the Applicant a Single Girl Child of the Parent ?</label>
									</td>
									<td>
										<input type="hidden" id="hidSingleGirl" name="hidSingleGirl" value="<?=$radioSingleChild?>"/>
										<div class="form-group">
											<label class="radio-inline">
												<input type="radio" name="radioSingleChild" id="radioNoSingleChild" value="No" <?php if($radioSingleChild=="No") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?> > No
											</label>
											<label class="radio-inline">
												 <input type="radio" name="radioSingleChild" id="radioYesSingleChild" value="Yes" <?php if($radioSingleChild=="Yes") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?> > Yes
											</label>
										</div>
									</td>
									<td>
										
									</td>
									<td>
									</td>
									<td>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:18px;">*</i> Mode of Transport for Attending School :</label>
									</td>
									<td>
										<div class="form-group">
										<select class="form-control" id="cmbTransportMode" name="cmbTransportMode">
											<option value=''>Select</option>
											<option value='Own Arrangement' <?php if($cmbTransportMode == 'Own Arrangement') echo "selected"?>>Own Arrangement</option>
											<option value='School Bus' <?php if($cmbTransportMode == 'School Bus') echo "selected"?>>School Bus</option>
										</select>
										</div>
									</td>
									<td>
										
									</td>
									<td>
									</td>
									<td>
									</td>
								</tr>

								<tr >
									<td colspan="2">
										<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:18px;">*</i> Whether Candidate Studied in any School Before?</label>
									</td>
									<td>
										<div class="form-group">
											<label class="radio-inline">
												<input type="radio"  name="radioPreviousSchool" id="radionoSchool" value="No" <?php if($radioPreviousSchool=="No") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> No
											</label>
											<label class="radio-inline">
												<input type="radio" name="radioPreviousSchool" id="radioyesSchool" value="Yes" <?php if($radioPreviousSchool=="Yes" ) { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Yes
											</label>
										</div>
									</td>
									<td>
										
									</td>
									<td>
									</td>
									<td>
									</td>
								</tr>
								<tr  id="forschool">
									<td colspan="2">
										<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:18px;">*</i> Name and Address of Previous School Where Candidate Studied :</label>
									</td>
									<td colspan="2">
										<div class="form-group">
											
											<textarea name="taPreviousSchool" class="form-control" maxlength="150" id="taPreviousSchool" cols="10" rows="2" <?php echo $show==1?'disabled':''; ?>><?=$taPreviousSchool?></textarea>
											
										</div>
									</td>
									<td>
										
									</td>
									<td>
										<div class="form-group">
											
										</div>
									</td>
								</tr>
								<tr  id="forgrade">
									<td colspan="2">
										<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:18px;">*</i> Overall Grade/Percenage in Previous Class:</label>
									</td>
									<td>
										<div class="form-group">
											
											<input type="text" class="form-control" id="txtGrade" name="txtGrade" placeholder="Enter Grade" value="<?=$txtGrade?>" <?php echo $show==1?'disabled':''; ?>>
											
										</div>
									</td>
									<td>
										<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:18px;">*</i> Session attended:</label>
									</td>
									<td colspan="2">
										<input type="text" class="form-control" id="txtLastSession" name="txtLastSession" placeholder="Enter Session" value="<?=$txtLastSession?>" <?php echo $show==1?'disabled':''; ?>>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<label for="" class="control-label" style="text-align:left;"> Aadhaar No / Aadhaar Enrollment No :</label>
									</td>
									<td colspan="2">
										<div class="form-group">
											<input type="text" class="form-control" id="txtUid" name="txtUid" placeholder="Aadhaar No / Aadhaar Enrollment No :" value="<?=$txtUid?>" <?php echo $show==1?'disabled':''; ?>>
										</div>
									</td>
									<!--<td colspan="2">
										<label class="radio-inline">
											<input type="radio"  name="radioAdharCard" id="radioNotAvailable" value="NO" <?php if($radioAdharCard=="NO") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Not Available
										</label>
										<label class="radio-inline">
											<input type="radio" name="radioAdharCard" id="radioAvailable" value="YES" <?php if($radioAdharCard=="YES") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Available
										</label>
									</td>-->
									<td></td>
									<td></td>
									
								</tr>
								<!--<tr id="forAdharNo" style="display:none;">
									<td colspan="2">
										<label for="" class="control-label" style="text-align:left;"> Aadhaar No :</label>
									</td>
									<td colspan="2">
										<div class="form-group">
											<input type="text" class="form-control" id="txtUid" name="txtUid" placeholder="Aadhaar No" maxlength="12"  value="<?=$txtUid?>" <?php echo $show==1?'disabled':''; ?>>
										</div>
									</td>
									<td></td>
									<td></td>
								</tr>-->
								<tr>
									<td colspan="2">
										<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:18px;">*</i> Application saught on the ground of :</label>
									</td>
									<td colspan="2">
										<div class="form-group">
											<select class="form-control" id="cmbAdmissionReason" name="cmbAdmissionReason">
												<option value=''>Select</option>
												<option value='Transfer' <?php if($cmbAdmissionReason == 'Transfer') echo "selected"?>>Transfer</option>
												<option value='Change of residence' <?php if($cmbAdmissionReason == 'Change of residence') echo "selected"?>>Change of residence</option>
												<option value='Other' <?php if($cmbAdmissionReason == 'Other') echo "selected"?>>Other</option>
											</select>
										</div>
									</td>
									<td colspan="2">
										<div class="form-group" id="divOtherReason" style="display:none;">
											<input type="text" class="form-control" id="txtOtherReason" name="txtOtherReason" placeholder="Specify Other Reason" maxlength="20"  value="<?=$txtOtherReason?>" <?php echo $show==1?'disabled':''; ?>>
										</div>
									</td>
									
								</tr>
							</table>
								<div class="form-group">
									<div class="col-sm-12">
										 <label> Name of real brother and sister  studying in this school:</label>
									</div>
								</div>
								<table class="table table-bordered table-striped" id="customFields">
									<tr valign="top">
										<th scope="row" width="28%"><label for="customFieldName">Enrollment No / Admission No</label></th>
										<th scope="row" width="30%"><label for="customFieldName">Name</label></th>
										<th scope="row" width="20%"><label for="customFieldName">Class</label></th>
										<th scope="row" width="20%"><label for="customFieldName">Section</label></th>
										<th scope="row" width="2%"></th>
									</tr>
<?php
if($edit == 'true')
{
$sl1 =1;
if(sizeof($allSiblingInfo) >= 1)
{
foreach($allSiblingInfo as $row)
{
?>

										<tr>
											<td width="10%">
												<div class="form-group">
													<input type="text" class="form-control" id="txtAdmNo" name="txtAdmNo[]" value="<?=$row['adm_no']?>" />
												</div>
											</td>
											<td width="40%">
												<div class="form-group">
													<input type="text" class="form-control" id="txtName" name="txtName[]" value="<?=$row['name']?>" style="width: 100%" />
												</div>
											</td>
											<td width="20%">
												<div class="form-group">
													<select class="form-control"  name="txtClass[]">
														<option value="">Select</option>
<?php
foreach($allStandards as $row1)
{

$x = ($row['class'] == $row1['standard_name'] ? ' selected ' : '');
echo "<option value='".$row1['standard_name']."' $x>".$row1['standard_name']."</option>";

}	
?>
													</select>
												</div>
											</td>
											<td width="10%">
												<div class="form-group">
													<input type="text" class="form-control" id="txtSection" name="txtSection[]" value="<?=$row['section']?>" />
												</div>
											</td>
											<td>
												
											</td>
										</tr>
<?php
$sl1++;
}	
}
else
{
?>
									<tr>
										<td width="10%">
											<div class="form-group">
												<input type="text" class="form-control" id="txtAdmNo" name="txtAdmNo[]" value="" />
											</div>
										</td>
										<td width="40%">
											<div class="form-group">
												<input type="text" class="form-control" id="txtName" name="txtName[]" value="" style="width: 100%" />
											</div>
										</td>
										<td width="20%">
											<div class="form-group">
												<select class="form-control" id="txtClass" name="txtClass[]">
													
												</select>
												<!--<input type="text" class="form-control" id="txtClass" name="txtClass[]" value="" />-->
											</div>
										</td>
										<td width="10%">
											<div class="form-group">
												<input type="text" class="form-control" id="txtSection" name="txtSection[]" value="" />
											</div>
										</td>
										
										<td width="20%">
											<a href="javascript:void(0);" class="addCF" title="Add Row"> <i class="fa fa-plus-circle"></i> </a>
										</td>
											
										
									</tr>
<?php	
}

}
else
{
?>

									<tr>
										<td width="10%">
											<div class="form-group">
												<input type="text" class="form-control" id="txtAdmNo" name="txtAdmNo[]" value="" />
											</div>
										</td>
										<td width="40%">
											<div class="form-group">
												<input type="text" class="form-control" id="txtName" name="txtName[]" value="" style="width: 100%" />
											</div>
										</td>
										<td width="20%">
											<div class="form-group">
												<select class="form-control " id="txtClass" name="txtClass[]">
<?php
foreach($allStandards as $row1)
{


echo "<option value='".$row1['standard_name']."'>".$row1['standard_name']."</option>";

}	
?>
												</select>
												<!--<input type="text" class="form-control" id="txtClass" name="txtClass[]" value="" />-->
											</div>
										</td>
										<td width="10%">
											<div class="form-group">
												<input type="text" class="form-control" id="txtSection" name="txtSection[]" value="" />
											</div>
										</td>
										
										<td width="20%">
											<a href="javascript:void(0);" class="addCF" title="Add Row"> <i class="fa fa-plus-circle"></i> </a>
										</td>
											
										
									</tr>
								

<?php
}
?>
								</table>																																																																																																																																																																																																																																																																																																																																																																																								
							</div>
							
						</div>
						<div class="divParents">
							<div class="form-group" style="margin-top: -20px">
								<div class="col-sm-12" style="margin-top: -5px">
									<h3 class="section-header">2. Detailed Information of Parents</h3>
								</div>
							</div>
							<div class="panel-body">
								<table class="table table-bordered table-striped" >
									<tr>
										<th style="text-align:center;">Mother</th>
										<th style="text-align:center;">Father</th>
									</tr>
									<tr>
										<td>
											
												<label for="" class="col-sm-4 control-label" style="align:left;"><i style="color:red;font-size:18px;">*</i> Name</label>
											<div class="form-group">	
												<div class="col-sm-8">
													<input type="text" class="form-control" id="txtMotherName" name="txtMotherName" placeholder="Your Mother's Name" value="<?=$txtMotherName?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
										<td>
											
											<label for="" class="col-sm-4 control-label" style="align:left;"><i style="color:red;font-size:18px;">*</i> Name</label>
											<div class="form-group">
												<div class="col-sm-8">
													<input type="text" class="form-control" id="txtFatherName" name="txtFatherName" placeholder="Your Father's Name" value="<?=$txtFatherName?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											
											<label for="" class="col-sm-4 control-label" ><i style="color:red;font-size:18px;">*</i> Qualification</label>
											<div class="form-group">	
												<div class="col-sm-7">
													<input type="text" class="form-control" id="txtMotherQualification" name="txtMotherQualification" value="<?=$txtMotherQualification?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
										<td>
											<label for="" class="col-sm-4 control-label" ><i style="color:red;font-size:18px;">*</i> Qualification</label>
											<div class="form-group">	
												<div class="col-sm-7">
													<input type="text" class="form-control" id="txtFatherQualification" name="txtFatherQualification" value="<?=$txtFatherQualification?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											
											<label for="" class="col-sm-4 control-label" ><i style="color:red;font-size:18px;">*</i> Occupation</label>
											<div class="form-group">	
												<div class="col-sm-7">
													<input type="text" class="form-control" id="txtMotherOccupation" name="txtMotherOccupation" value="<?=$txtMotherOccupation?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
										<td>
											<label for="" class="col-sm-4 control-label" ><i style="color:red;font-size:18px;">*</i> Occupation</label>
											<div class="form-group">	
												<div class="col-sm-7">
													<input type="text" class="form-control" id="txtFatherOccupation" name="txtFatherOccupation" value="<?=$txtFatherOccupation?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
										
											<label for="" class="col-sm-4 control-label" ><i style="color:red;font-size:18px;">*</i> Designation</label>
											<div class="form-group">	
												<div class="col-sm-7">
													<input type="text" class="form-control" id="txtMotherDesignation" name="txtMotherDesignation" value="<?=$txtMotherDesignation?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
										<td>
											
											<label for="" class="col-sm-4 control-label" ><i style="color:red;font-size:18px;">*</i> Designation</label>
											<div class="form-group">	
												<div class="col-sm-7">
													<input type="text" class="form-control" id="txtFatherDesignation" name="txtFatherDesignation" value="<?=$txtFatherDesignation?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											
											<label for="" class="col-sm-4 control-label" >Organization</label>
											<div class="form-group">	
												<div class="col-sm-7">
													<input type="text" class="form-control" id="txtMotherDuties" name="txtMotherDuties" value="<?=$txtMotherDuties?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
										<td>
											
											<label for="" class="col-sm-4 control-label" >Organization</label>
											<div class="form-group">	
												<div class="col-sm-7">
													<input type="text" class="form-control" id="txtFatherDuties" name="txtFatherDuties" value="<?=$txtFatherDuties?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											
											<label for="" class="col-sm-4 control-label" >Office Address</label>
											<div class="form-group">	
												<div class="col-sm-7">
													<textarea class="form-control" rows="3" maxlength="150" name="txtareaMotherOffice" id="txtareaMotherOffice" <?php echo $show==1?'disabled':''; ?>><?=$txtareaMotherOffice?></textarea>
												</div>
											</div>
										</td>
										<td>
											
											<label for="" class="col-sm-4 control-label" >Office Address</label>
											<div class="form-group">	
												<div class="col-sm-7">
													<textarea class="form-control" maxlength="150" rows="3" name="txtareaFatherOffice" id="txtareaFatherOffice" <?php echo $show==1?'disabled':''; ?>><?=$txtareaFatherOffice?></textarea>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											
											<label for="" class="col-sm-4 control-label" ><i style="color:red;font-size:18px;">*</i> Annual Income(<i class="fa fa-inr"></i>)</label>
											<div class="form-group">	
												<div class="col-sm-7">
													<input type="text" class="form-control" id="txtMotherIncome" name="txtMotherIncome" value="<?=$txtMotherIncome?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
										<td>
											
											<label for="" class="col-sm-4 control-label" ><i style="color:red;font-size:18px;">*</i> Annual Income(<i class="fa fa-inr"></i>)</label>
											<div class="form-group">	
												<div class="col-sm-7">
													<input type="text" class="form-control" id="txtFatherIncome" name="txtFatherIncome" value="<?=$txtFatherIncome?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											
											<label for="" class="col-sm-4 control-label" >Tel No (Res)</label>
											<div class="form-group">	
												<div class="col-sm-7">
													<input type="text" class="form-control" id="txtMotherPhoneRes" name="txtMotherPhoneRes" value="<?=$txtMotherPhoneRes?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
										<td>
											<label for="" class="col-sm-4 control-label" >Tel No (Res)</label>
											<div class="form-group">	
												<div class="col-sm-7">
													<input type="text" class="form-control" id="txtFatherPhoneRes" name="txtFatherPhoneRes" value="<?=$txtFatherPhoneRes?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											
											<label for="" class="col-sm-4 control-label" >Tel No (Mob)</label>
											<div class="form-group">	
												<div class="col-sm-7">
													<input type="text" class="form-control" id="txtMotherPhoneMob" name="txtMotherPhoneMob" value="<?=$txtMotherPhoneMob?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
										<td>
											
											<label for="" class="col-sm-4 control-label" > Tel No (Mob)</label>
											<div class="form-group">
												<div class="col-sm-7">
													<input type="text" class="form-control" id="txtFatherPhoneMob" name="txtFatherPhoneMob" value="<?=$txtFatherPhoneMob?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
									</tr>	
									<tr>
										<td>
											
											<label for="" class="col-sm-4 control-label" >E-mail</label>
											<div class="form-group">
												<div class="col-sm-7">
													<input type="text" class="form-control" id="txtMotherEmail" name="txtMotherEmail" value="<?=$txtMotherEmail?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
										<td>
											
											<label for="" class="col-sm-4 control-label" >E-mail</label>
											<div class="form-group">	
												<div class="col-sm-7">
													<input type="text" class="form-control" id="txtFatherEmail" name="txtFatherEmail" value="<?=$txtFatherEmail?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<label for="" class="col-sm-4 control-label" >Aadhaar Number</label>
											<div class="form-group">	
												<div class="col-sm-7">
													<input type="text" class="form-control" id="txtMotherAdhar" name="txtMotherAdhar" value="<?=$txtMotherAdhar?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
										<td>
											
											<label for="" class="col-sm-4 control-label" >Aadhaar Number</label>
											<div class="form-group">	
												<div class="col-sm-7">
													<input type="text" class="form-control" id="txtFatherAdhar" name="txtFatherAdhar" value="<?=$txtFatherAdhar?>" <?php echo $show==1?'disabled':''; ?>>
												</div>
											</div>
										</td>
									</tr>		
								</table>
							</div>
						</div>
						<div class="divContacts">
							<div class="form-group" style="margin-top: -20px">
								<div class="col-sm-12" style="margin-top: -5px">
									<h3 class="section-header">3. Contact Information</h3>
								</div>
							</div>				
							<div class="form-group">
								<div class="col-sm-12">
									 <h4><b><i style="color:red;font-size:18px;">*</i> Present Address:</b></h4>
								</div>
							</div>
							<div class="panel-body">
								<table class="table table-striped">
							<tr>
								<td>
									<label for="" class="control-label" >Plot/House No/At</label>
								</td>
								<td>
									<div class="form-group col-sm-9">
										<input type="text" class="form-control" name="txtPresentAddress" id="txtPresentAddress" value="<?=$txtPresentAddress?>" <?php echo $show==1?'disabled':''; ?>>
									</div>												
								</td>
								<td>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</td>
								<td>
									<label for="" class="control-label" >Locality</label>
								</td>
								<td>
									<div class="form-group ">
										<input type="text" class="form-control" name="txtPresentLocality" id="txtPresentLocality" value="<?=$txtPresentLocality?>" <?php echo $show==1?'disabled':''; ?>>
									</div>												
								</td>
								<td>
									
								</td>
							</tr>
							<tr>
								<td>
									<label for="" class="control-label" >Post</label>
								</td>
								<td>
									<div class="form-group col-sm-9">
										<input type="text" class="form-control" name="txtPresentPost" id="txtPresentPost" value="<?=$txtPresentPost?>" <?php echo $show==1?'disabled':''; ?>>
									</div>												
								</td>
								<td>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</td>
								<td>
									<label for="" class="control-label" >State</label>
								</td>
								<td>
									<div class="form-group">
										<select name="cmbPresentState" id="cmbPresentState" class="form-control" <?php echo $show==1?'disabled':''; ?>>
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
								</td>
								<td>
									<span id="spanState" hidden><img src="build/images/bx_loader.gif"/></span>
								</td>
							</tr>
							<tr>
								<td>
									<label for="" class="control-label" >District</label>
								</td>
								<td>
									<div class="form-group col-sm-9">
										<select name="cmbPresentDist" id="cmbPresentDist" class="form-control" <?php echo $show==1?'disabled':''; ?>>
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
								</td>
								<td>
									<div id="forDistrictPresent" style="display:none;">
										<input type="text" class="form-control" id="txtOtherPresentDistrict" name="txtOtherPresentDistrict" placeholder="Please Specify" value="<?=$txtOtherPresentDistrict?>" <?php echo $show==1?'disabled':''; ?>>
									</div>
								</td>
								<td>
									<label for="" class="control-label" >PIN</label>
								</td>
								<td>
									<div class="form-group">
										<input type="text" class="form-control" name="txtPresentPin" id="txtPresentPin" onkeypress="return isNumberKey(event)" maxlength="6" value="<?=$txtPresentPin?>" <?php echo $show==1?'disabled':''; ?>>
									</div>												
								</td>
								<td>
									
								</td>
							</tr>
							<tr>
								<td>
									<label for="" class="control-label" >Distance From <br/> School</label>
								</td>
								<td>
									<div class="form-group col-sm-9">
										<input type="text" class="form-control" name="txtPresentDistance" id="txtPresentDistance" value="<?=$txtPresentDistance?>" <?php echo $show==1?'disabled':''; ?>>
									</div>												
								</td>
								<td>
									<!--<div id="forDistrictPresent" style="display:none;">
										<input type="text" class="form-control" id="txtOtherPresentDistrict" name="txtOtherPresentDistrict" placeholder="Please Specify" value="<?=$txtOtherPresentDistrict?>" <?php echo $show==1?'disabled':''; ?>>
									</div>-->
								</td>
								
								<td>
																				
								</td>
								<td>
									
								</td>
							</tr>
						</table>																																																																																																																																																																																																																																						
								<div class="form-group">
									<div class="col-sm-12">
									<h4><b><i style="color:red;font-size:18px;">*</i> Permanent Address:</b></h4>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-8">
										
											<input type="checkbox" id="chksameasresidential" name="chksameasresidential" value="Y" onclick="setSameAddress();" <?php if($chksameasresidential=="Y") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> 
											Permanent address is same as Present address
										
									</div>
								</div>
								<table class="table table-striped">
							<tr>
								<td>
									<label for="" class="control-label" >Plot/House No/At</label>
								</td>
								<td>
									<div class="form-group col-sm-9">
										<input type="hidden" name="hidPermenentAddress" id="hidPermenentAddress" value="<?=$txtPermenentAddress?>" />
										<input type="text" class="form-control" name="txtPermenentAddress" id="txtPermenentAddress" value="<?=$txtPermenentAddress?>" >
									</div>												
								</td>
								<td>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</td>
								<td>
									<label for="" class="control-label" >Locality</label>
								</td>
								<td>
									<div class="form-group">
										<input type="hidden" name="hidPermenentLocality" id="hidPermenentLocality" value="<?=$txtPermenentLocality?>" />
										<input type="text" class="form-control" name="txtPermenentLocality" id="txtPermenentLocality" value="<?=$txtPermenentLocality?>" >
									</div>												
								</td>
								<td>
									
								</td>
							</tr>
							<tr>
								<td>
									<label for="" class="control-label" >Post</label>
								</td>
								<td>
									<div class="form-group col-sm-9">
										<input type="hidden" name="hidPermanentPost" id="hidPermanentPost" value="<?=$txtPermanentPost?>" />
										<input type="text" class="form-control" name="txtPermanentPost" id="txtPermanentPost" value="<?=$txtPermanentPost?>" >
									</div>												
								</td>
								<td>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</td>
								<td>
									<label for="" class="control-label" >State</label>
								</td>
								<td>
									<div class="form-group">
										<input type="hidden"  name="hidPermanentState" id="hidPermanentState" value="<?=$cmbPermanentState?>" />
										<select name="cmbPermanentState" id="cmbPermanentState" class="form-control">
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
								</td>
								<td>
									<div id="forStatePermanent" style="display:none;">
										<input type="hidden"  name="hidOtherPermanentState" id="hidOtherPermanentState" value="<?=$txtOtherPermanentState?>" />
										<input type="text" class="form-control" id="txtOtherPermanentState" name="txtOtherPermanentState" placeholder="Please Specify" value="<?=$txtOtherPermanentState?>" >
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<label for="" class="control-label" >District</label>
								</td>
								<td>
									<div class="form-group col-sm-9">
										<input type="hidden" name="hidPermanentDist" id="hidPermanentDist" value="<?=$cmbPermanentDist?>" />
										<select id="cmbPermanentDist" name="cmbPermanentDist" class="form-control" >
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
								</td>
								<td>
									<div class="col-sm-2" id="forDistPermanent" style="display:none;">
										<div class="form-group ">
											<input type="hidden"  name="hidOtherPermanentDist" id="hidOtherPermanentDist" value="<?=$txtOtherPermanentDist?>" />
											<input type="text" class="form-control" id="txtOtherPermanentDist" name="txtOtherPermanentDist" placeholder="Please Specify" value="<?=$txtOtherPermanentDist?>" >
										</div>
									</div>
								</td>
								<td>
									<label for="" class="control-label" >PIN</label>
								</td>
								<td>
									<div class="form-group">
										<input type="hidden"  name="hidPermanentPin" id="hidPermanentPin" value="<?=$txtPermanentPin?>" />
										<input type="text" class="form-control" name="txtPermanentPin" id="txtPermanentPin" value="<?=$txtPermanentPin?>" >
									</div>												
								</td>
								<td>
									
								</td>
							</tr>
						</table>																																																																																																																																																																																																																		
							</div>
						</div>
						<div class="divDeclaration">
							<div class="form-group" style="margin-top: -20px">
								<div class="col-sm-12" style="margin-top: -5px">
									<h3 class="section-header">4. Declaration</h3>
								</div>
							</div>
							<div class="panel-body">
								<div class="form-group">
									<div class="col-sm-12">
											<input type="checkbox" hidden="hidden" name="chkUndertaking1" id="chkUndertaking1" value="1" checked="checked" <?php echo $show==1?'disabled':''; ?>>
												 (1) I/ We, hereby certify that the above information is correct to the best of my/our knowledge and belief. If any information is found to be contrary to the facts, the admission of my/our ward may be cancelled at any stage.
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
											<input type="checkbox" hidden="hidden" name="chkUndertaking2" id="chkUndertaking2" value="2" checked="checked" <?php echo $show==1?'disabled':''; ?>>
												(2) Further,  I/We fully understand that filling up this Registration  Form does not confirm the admission of the child.
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
											<input type="checkbox" hidden="hidden" name="chkUndertaking3" id="chkUndertaking3" value="3" checked="checked" <?php echo $show==1?'disabled':''; ?>>
												(3) I/We declare that I/We am/are in  a position to pay the prescribed fees as finalized by the school from time to time.  
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
											<input type="checkbox" hidden="hidden" name="chkUndertaking4" id="chkUndertaking4" value="4" checked="checked" <?php echo $show==1?'disabled':''; ?>>
												(4) The name & date of birth of my/our ward as spelt out is correct and I/We shall not request for change at a later stage.
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
											<input type="checkbox" hidden="hidden" name="chkUndertaking5" id="chkUndertaking5" value="5" checked="checked" <?php echo $show==1?'disabled':''; ?>>
												(5) I/We hereby certify that my/our ward and myself/ourself shall follow all the rules, regulations and procedures as laid down by the School from time to time.
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
											<input type="checkbox" hidden="hidden" name="chkUndertaking6" id="chkUndertaking6" value="6" checked="checked" <?php echo $show==1?'disabled':''; ?>>
												  (6) I/we understand that the decision of the Management of the school shall be final & binding on me/us
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12" id="divDecGuardian">
											<input type="checkbox"  name="chkUndertaking7" hidden="hidden" id="chkUndertaking7" value="7" <?php if($chkParentAlive == 'N') { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>>
												(7) I/we certify that I/We am/are the bonafide Guardian/guardian(s) of the child.
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label" style="text-align:left;"><i class="glyphicon glyphicon-asterisk" style="color:red;font-size:10px;"></i> Declaration By :</label><br/>
									<br />
										<div class="col-sm-4" style="margin-left: 2%">
										<label>
											<input style="font: bold" type="radio" name="chkParentAlive" id="radioParentAlive" value="Y" <?php if($chkParentAlive == 'Y' || $chkParentAlive == '') { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>>Parents
										</label>
										<br />
										<label>
											<input type="radio" name="chkParentAlive" id="radioParentNotAlive" value="N" <?php if($chkParentAlive == 'N') { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>>Legal Guardian(Incase parents aren't alive)
										</label>
										</div>
									
									<div class="col-sm-6" style="margin-left:-60px; display:none;margin-top: 2%" id="divForGuardian">
										<label class="control-label col-xs-5">Name of Legal Guardian</label>
										<div class="col-xs-7">	
											<input type="text" name="txtGuardian" class="form-control" id="txtGuardian" value="<?=$txtGuardian?>" <?php echo $show==1?'disabled':''; ?>>	
										</div>	
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12" id="divDecGuardian">
											<input type="checkbox"  name="chkUndertakingAll" id="chkUndertakingAll" <?php if($edit == 'true') echo "checked"; ?><?php echo $show==1?'disabled':''; ?>>
												  <b>I/we Accept All the Above Terms & Conditions .</b>
									</div>
								</div>
							</div>
						</div>
						<?php if($show != 1) { ?>
						<div class="form-group">
							<div class="col-lg-offset-5 col-lg-3">
								<button type="submit" class="btn btn-primary" id="btnPersonalInfo" name="btnPersonalInfo"  onclick="return validate();" >Save & Next</button>
							</div>
						</div>	
						<?php } ?>
					</form>
				</div>
			</div>
			<!--Panel Body-->
			<!--Panel Default-->
		</div><!--/col-lg-12-->
	</div>
	<?php //include('sidebar/modal_data.php'); ?>
</div>

<!--<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrapValidator.js"></script>-->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/template010.js?v=<?php rand()?>"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.js"></script>

<!--  <link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet"> -->
<script type="text/javascript">

var birthyear = "<?=$y?>";
var todayyear = (new Date()).getFullYear();
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



 prefernce1_drop="<?=$center_name1?>";
 prefernce2_drop="<?=$center_name2?>";
 prefernce3_drop="<?=$center_name3?>";
					 
					 
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

$(".date").datepicker({
	format: "dd-mm-yyyy",
	todayHighlight:true,
	autoclose:true,
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