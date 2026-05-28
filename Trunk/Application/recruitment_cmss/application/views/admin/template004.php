<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata');
$now = date('Y-m-d h:i:s', now());

//print_r($allQualifications);
//print_r($center_choice);die();
//echo ($choice_details_data['center_choice']);die();
//$choiceData = ($choice_details_data[0]['center_choice']);
//echo $choiceData;
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

$cmbdc='';
$txtExamName2='';
$txtStream2='';
$txtYearQual2='';
$txtBoardOth2='';
$txtSub2='';
$txtCGPA2='';
$txtGradingOth2='';
$txtDiv2='';

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
	$d = $dob1[2];
	$m = $dob1[1];
	$y = $dob1[0];
	$txtDobDateFormat = $d.'-'.$m.'-'.$y;
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
	$cmbdc = $row['dc_office'];
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
	$txtOther_grad = $row1['other_stream'];
	
	
	$sl++;
}

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
}
//$dob='1981-10-07';
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
	if ((document.getElementById('txtMotherName').value == '') || 
		((document.getElementById("txtidproof").value == '') ) || ((document.getElementById('radioPhysicallYY').checked) && 
		(document.getElementById("cmbPH").value == "")) || ((document.getElementById("chksameasresidential").checked  == false) 
		&& ((document.getElementById("txtPermanentPin").value == '') || (document.getElementById("city_name").value == '') || 
		(document.getElementById("cmbPermanentState").value == '') || (document.getElementById("cmbPresentDist").value == '') || 
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
		if((document.getElementById('cmbDcOffice').value == '' || document.getElementById('cmbDcOffice').value == null))
		{
			str += " Name of DC office,";
		}
		if((document.getElementById("txtPresentPin").value == '') || (document.getElementById("city_name").value == '') || (document.getElementById("cmbPresentState").value == '') || (document.getElementById("cmbPresentDist").value == '') || (document.getElementById("txtPresentPost").value == '') || (document.getElementById("txtPresentLocality").value == ''))
		{
			str += " all details of present address,";
		}
		if(((document.getElementById("chksameasresidential").checked  == false) && ((document.getElementById("txtPermanentPin").value == '') || (document.getElementById("city_name").value == '') || (document.getElementById("cmbPermanentState").value == '') || (document.getElementById("cmbPresentDist").value == '') || (document.getElementById("txtPermanentPost").value == '') || (document.getElementById("txtPermenentLocality").value == ''))))
		{
			str += " all details of permanent address,";
		}
		var str = str.substring(0, str.length - 1);
		errorMessage += str;
		errorMessage += " in Applicant Details Tab.<br/>";
	}
	if(((document.getElementById("txtYear8").value != '') && ((document.getElementById("txtBoard8").value == '') || (document.getElementById("txtgrading8").value == '') || (document.getElementById("txtPercent8").value == '') || (document.getElementById("txtdistinct8").value == ''))) || ((document.getElementById("txtYear7").value != '') && ((document.getElementById("txtBoard7").value == '') || (document.getElementById("txtgrading7").value == '') || (document.getElementById("txtPercent7").value == '') || (document.getElementById("txtdistinct7").value == ''))) || ((document.getElementById("txtYear6").value != '') && ((document.getElementById("txtBoard6").value == '') || (document.getElementById("txtgrading6").value == '') || (document.getElementById("txtPercent6").value == '') || (document.getElementById("txtdistinct6").value == ''))) || ((document.getElementById("txtYear5").value != '') && ((document.getElementById("txtBoard5").value == '') || (document.getElementById("txtgrading5").value == '') || (document.getElementById("txtPercent5").value == '') || (document.getElementById("txtdistinct5").value == ''))) || ((document.getElementById("txtExamName1").value != '') && ((document.getElementById("txtStream1").value == '') || (document.getElementById("txtYearQual1").value == '') || (document.getElementById("txtBoardOth1").value == '') || (document.getElementById("txtCGPA1").value == ''))) ||((document.getElementById("txtExamName2").value != '') && ((document.getElementById("txtStream2").value == '') || (document.getElementById("txtYearQual2").value == '') || (document.getElementById("txtBoardOth2").value == '') || (document.getElementById("txtCGPA2").value == ''))) || (document.getElementById("txtPercent1").value == '') || (document.getElementById("txtPercent2").value == '') || (document.getElementById("txtPercent4").value == '') || (document.getElementById("txtPercent3").value == '') || (document.getElementById("txtgrading1").value == '') || (document.getElementById("txtgrading2").value == '') || (document.getElementById("txtgrading4").value == '') || (document.getElementById("txtgrading3").value == '') || (document.getElementById("txtBoard1").value == '') || (document.getElementById("txtBoard2").value == '') || (document.getElementById("txtBoard4").value == '') || (document.getElementById("txtBoard3").value == '') || (document.getElementById("txtYear1").value == '') || (document.getElementById("txtYear2").value == '') || (document.getElementById("txtYear4").value == '') ||  (document.getElementById("txtYear3").value == '') || (document.getElementById("txtqual22").value == '') || (document.getElementById("txtqual23").value == '') || (document.getElementById("txtqual24").value == '') || ((document.getElementById("txtqual24").value == 'Other' && document.getElementById("txtOther_grad").value == '')) || (document.getElementById('radioComputerY').checked == false && document.getElementById('radioComputerN').checked == false))
	{
		
		var str = "Please enter - ";
		//errorMessage += "One / Some mandatory fields are not entered in Academic Details Tab.<br/>";
		
		if((document.getElementById("txtqual22").value == '') || (document.getElementById("txtqual23").value == '') || (document.getElementById("txtqual24").value == ''))
		{
			str += " stream for all qualifications till graduation,";
		}
		if(document.getElementById("txtqual24").value == 'Other' && document.getElementById("txtOther_grad").value == '')
		{
			str += " stream for graduation,";
		}
		if((document.getElementById("txtYear1").value == '') || (document.getElementById("txtYear2").value == '') || (document.getElementById("txtYear3").value == '') || (document.getElementById("txtYear4").value == '') )
		{
			str += " year for all qualifications till graduation,";
		}
		if((document.getElementById("txtBoard1").value == '') || (document.getElementById("txtBoard2").value == '') || (document.getElementById("txtBoard3").value == '') || (document.getElementById("txtBoard4").value == ''))
		{
			str += " board for all qualifications till graduation,";
		}
		/*if((document.getElementById("txtsubject1").value == '') || (document.getElementById("txtsubject2").value == '') || (document.getElementById("txtsubject3").value == '') || (document.getElementById("txtsubject4").value == ''))
		{
			str += " subjects for all qualifications till graduation,";
		}*/
		if((document.getElementById("txtgrading1").value == '') || (document.getElementById("txtgrading2").value == '') || (document.getElementById("txtgrading3").value == '') || (document.getElementById("txtgrading4").value == ''))
		{
			str += " grading system for all qualifications till graduation,";
		}
		if((document.getElementById("txtPercent1").value == '') || (document.getElementById("txtPercent2").value == '') || (document.getElementById("txtPercent3").value == '') || (document.getElementById("txtPercent4").value == ''))
		{
			str += " CGPA/ % of all qualifications till graduation,";
		}
		if(((document.getElementById("txtYear5").value != '') && ((document.getElementById("txtBoard5").value == '') || (document.getElementById("txtgrading5").value == '') || (document.getElementById("txtPercent5").value == '') || (document.getElementById("txtdistinct5").value == ''))))
		{
			str += " all details of Post Graduation,";
		}
		if(((document.getElementById("txtYear6").value != '') && ((document.getElementById("txtBoard6").value == '') || (document.getElementById("txtgrading6").value == '') || (document.getElementById("txtPercent6").value == '') || (document.getElementById("txtdistinct6").value == ''))))
		{
			str += " all details of MPhil,";
		}
		if(((document.getElementById("txtYear7").value != '') && ((document.getElementById("txtBoard7").value == '') || (document.getElementById("txtgrading7").value == '') || (document.getElementById("txtPercent7").value == '') || (document.getElementById("txtdistinct7").value == ''))))
		{
			str += " all details of PhD,";
		}
		if(((document.getElementById("txtYear8").value != '') && ((document.getElementById("txtBoard8").value == '') || (document.getElementById("txtgrading8").value == '') || (document.getElementById("txtPercent8").value == '') || (document.getElementById("txtdistinct8").value == ''))))
		{
			str += " all details of NET/SLET/SET,";
		}
		
		if(((document.getElementById("txtExamName1").value != '') && ((document.getElementById("txtStream1").value == '') || (document.getElementById("txtYearQual1").value == '') || (document.getElementById("txtBoardOth1").value == '') ||  (document.getElementById("txtCGPA1").value == ''))))
		{
			str += " all details of other qualification 1,";
		}
		if(((document.getElementById("txtExamName2").value != '') && ((document.getElementById("txtStream2").value == '') || (document.getElementById("txtYearQual2").value == '') || (document.getElementById("txtBoardOth2").value == '') ||  (document.getElementById("txtCGPA2").value == ''))))
		{
			str += " all details of other qualification 2,";
		}
		if((document.getElementById('radioComputerY').checked == false && document.getElementById('radioComputerN').checked == false))
		{
			str += " Computer Education,";
		}
		var str = str.substring(0, str.length - 1);
		errorMessage += str;
		errorMessage += " in Academic Details Tab.<br/>";
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
			width: 15%;
			margin-left: 43%;
			border-bottom: 0px;
			color:#fff;
			background: linear-gradient(to left, #ffb27a 30%, #ff805f 100%);
			border-radius: 6px;
			text-align: center;
		
		}
		.btn-pink{
			    background-color: #f7bcbc;
			    border: 1px solid #b9b9b9;
			    border-radius: 20px;
			    color: #000;
		}
		
	</style>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.css" />
<div class="container-fluid" style=" padding-bottom: 50px;">

	<div class="row" style="background: linear-gradient(to bottom, #484848 0%, #f2f2f2 40%,#fff 100%);" >
		<div class="col-sm-1 col-md-1 col-lg-1 col-xs-1" style="margin-top: 176px;margin-left: -15px;"><!--
			<?php include('sidebar/sidebar.php'); ?>-->
		</div>

		<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11" style="padding-top:0px;padding-right: 2%;">


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
<div id="page-wrapper" >
	<div class="row" >
		<br />
		<!--<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">	</div>-->
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">	
			<?php 
			$ins = encrypt_decrypt('encrypt',$institute_code);
			if($edit == 'true') 
			{ 
				if($appl_status == 'Student Details Submitted') 
				{ 
					?>
					
					<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/template002/ins/<?=$ins?>';"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style="background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
						<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
							Profile Details <span class="badge"> &raquo;</span>
						</div>
						<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Profile Details" data-placement="top" data-toggle="tooltip">
							1 <span class="badge"> &raquo;</span>
						</div>
					</button>

					<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
					
					<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/apply_3/ins/<?=$ins?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style="background-color: #E9CDCD;border: 1px solid #E9CDCD; border-radius: 5px;color: black">
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
					<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/template002/ins/<?=$ins?>';"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style="background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
						<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
							Profile Details <span class="badge"> &raquo;</span>
						</div>
						<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Profile Details" data-placement="top" data-toggle="tooltip">
							1 <span class="badge"> &raquo;</span>
						</div>
					</button>

					<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
					
					<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/apply_3/ins/<?=$ins?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style="background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
						<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
							Document Upload <span class="badge"> &raquo;</span>
						</div>
						<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl" title="Document Upload" data-placement="top" data-toggle="tooltip" >
							2 <span class="badge"> &raquo;</span>
						</div>
					</button>

					<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
					
					<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/apply_4/ins/<?=$ins?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg"  title="Payment" data-placement="top" data-toggle="tooltip" style="background-color: #E9CDCD;border: 1px solid #E9CDCD; border-radius: 5px;color: black">
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
					<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/template002/ins/<?=$ins?>';"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style="background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
						<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
							Profile Details <span class="badge"> &raquo;</span>
						</div>
						<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Profile Details" data-placement="top" data-toggle="tooltip">
							1 <span class="badge"> &raquo;</span>
						</div>
					</button>

					<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
					
					<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/apply_3/ins/<?=$ins?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style="background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
						<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
							Document Upload <span class="badge"> &raquo;</span>
						</div>
						<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl" title="Document Upload" data-placement="top" data-toggle="tooltip" >
							2 <span class="badge"> &raquo;</span>
						</div>
					</button>

					<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
					
					<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/apply_4/ins/<?=$ins?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg"  title="Payment" data-placement="top" data-toggle="tooltip" style="background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
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
					<button type="button" onclick="window.location.href = '<?=base_url()?>Admin_apply/template002/ins/<?=$ins?>';"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style="background-color: #E9CDCD;border: 1px solid #E9CDCD; border-radius: 5px;color: black">
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
		<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"> 	</div>
	</div>
	<br />
	<div class="row">
		<div class="col-lg-12">
					
			<!--<div class="panel panel-default">
					<div class="panel-heading project-heading" align="center" >
						<h2 class="panel-title project-title"><b><a href="#"><?php echo $admname; ?></a></b></h2>
					</div>
				
			</div>-->
			<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;"> <!-- Alert for error -->
				<div id="alertmessage"></div>
			</div>
			<div class="panel with-nav-tabs">
				<!--<div class="panel-heading step-heading " style="background: linear-gradient(to right, #fb5472 0%, #a541ff 100%);">
					<ul class="nav nav-tabs" role="tablist">
						<li id ="address_tab_div" class="active">
							<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
								<a href="#address_tab" style="color: white;" data-toggle='tab'>Applicant Details</a>
							</div>
							<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Applicant Details" data-placement="top" data-toggle="tooltip">
								<a href="#address_tab" style="color: white;" data-toggle='tab'>1</a>
							</div>
						</li>
						<li id ="academic_tab_div">
							<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
								<a href="#academic_tab" style="color: white;" data-toggle='tab'>Academic Details</a>
							</div>
							<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Academic Details" data-placement="top" data-toggle="tooltip">
								<a href="#academic_tab" style="color: white;" data-toggle='tab'>2</a>
							</div>
						</li>
						<li id ="info_tab_div">
							<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
								<a href="#info_tab" style="color: white;" data-toggle='tab'>Information</a>
							</div>
							<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl" title="Information" data-placement="top" data-toggle="tooltip">
								<a href="#info_tab" style="color: white;" data-toggle='tab'>3</a>
							</div>
						</li>
						<li id ="declaration_tab_div">
							<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
								<a href="#declaration_tab" style="color: white;" data-toggle='tab'>Declaration</a>
							</div>
							<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Declaration" data-placement="top" data-toggle="tooltip">
								<a href="#declaration_tab" style="color: white;" data-toggle='tab'>4</a>
							</div>
						</li>
						<span class="pull-right" style="margin-top:10px;margin-right: 10px;margin-bottom: 10px;"><b style="color: #FFF;"><?php echo $admname; ?></b></span>
					</ul>
				</div>-->
				<div class="col-lg-6 col-md-12" style="width: 60%;">
                    <div class="card">
                        <ul class="nav nav-tabs customtab" role="tablist" >
                            <li class="nav-item active"> <a class="nav-link " data-toggle="tab" href="#address_tab" role="tab" aria-selected="true"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Applicant Details</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#academic_tab" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Academic Details</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#info_tab" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Information</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#declaration_tab" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Declaration</span></a> </li>
                        </ul>
                    </div>
                </div>
				
				 <div class="panel-body" style="box-shadow: 1px 4px 7px black;">
					<form action="" method="post" id="frmApply" name="frmApply">
						<div class="tab-content">
						
							<input type="hidden" id="hidDateFormat" name="hidDateFormat" value="<?php echo $txtDobDateFormat; ?>"/>
							<!--<input type="hidden" id="hidEditStatus" name="hidEditStatus" value="<?php echo $edit_status; ?>"/>-->
							<!-- first tab-->
						
							<div class="tab-pane in active" id="address_tab">
								<div>
									<input type="hidden" name="hidCatElig" id="hidCatElig" >
									<input type="hidden" name="hidDate" id="hidDate" >
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 0px;margin-top: 10px;">
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
														<input type="text" class="form-control" id="txtFirstName" name="txtFirstName" placeholder="Enter First Name" readonly="readonly"  value="<?=strtoupper($txtFirstName)?>" >
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label for="" class="col-lg-5" ><i class="fa fa-user" style="color:#E4791A"></i> Middle Name</label>
													<div class="col-lg-7">
														<input type="text" class="form-control test" id="txtMiddleName" name="txtMiddleName" placeholder="Enter Middle Name" readonly="readonly" value="<?=strtoupper($txtMiddleName)?>" >
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label for="" class="col-lg-5" ><i class="fa fa-user" style="color:#E4791A"></i> Last Name</label>
													<div class="col-lg-7">
														<input type="text" class="form-control" id="txtLastName" name="txtLastName" placeholder="Enter Last Name"  value="<?=strtoupper($txtLastName)?>" readonly="readonly" >
													</div>
												</div>
											</div>
										</div>
										
										<div  class="row"  style="margin-top: 20px;">
											
											<div class="col-lg-6">
												<div class="form-group">
													<label for="" class="col-lg-5" style=""><i style="color:red;font-size:18px;">*</i> <i class="fa fa-male" aria-hidden="true" style="color:#E4791A"></i> Father's/Husband's Name </label>
													<div class="col-lg-7">
														<input type="text" class="form-control" id="txtFatherName" name="txtFatherName" placeholder="Enter Father's/Husband's Name" onkeyup="changeCase(this)" maxlength="50" value="<?=strtoupper($txtFatherName)?>" >
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label for="" class="col-lg-5" style=""><i style="color:red;font-size:18px;">*</i> <i class="fa fa-male" aria-hidden="true" style="color:#E4791A"></i> Mother's Name </label>
													<div class="col-lg-7">
														<input type="text" class="form-control" id="txtMotherName" name="txtMotherName" placeholder="Enter Mother's Name" onkeyup="changeCase(this)" maxlength="50" value="<?=strtoupper($MothersName)?>" >
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
												<div class="form-group">
													<label for="" class="col-lg-5" style="">&nbsp;&nbsp;<i class="fa fa-birthday-cake" aria-hidden="true" style="color:#E4791A"></i> Age (as on 01-12-2018)</label>
													<div class="col-lg-7">
														<input type="hidden" class="form-control" id="txtemailid" name="txtemailid" maxlength="250"  value="<?=$txtEmailId?>" >
														<input type="text" class="form-control" id="txtAge" name="txtAge" maxlength="250" disabled=""  value="<?=$age?>" data-placement="top" data-toggle="tooltip">
													</div>
												</div>
											</div>
										</div>
										<div  class="row"  style="margin-top: 20px;">
											<!--<div  class="row"  style="margin-top: 20px;">-->
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style=""><i style="color:red;font-size:18px;">*</i><i class="fa fa-credit-card" aria-hidden="true" style="color:#E4791A"></i> Aadhaar Number</label>
														<div class="col-lg-7">
															<input type="text" class="form-control test" id="txtidproof" name="txtidproof" onkeypress="return isNumberKey(event)"  placeholder="Enter Aadhaar Number " maxlength="12"  value="<?=$id_proof_number?>" data-placement="top" data-toggle="tooltip" title=" Enter ID Proof Number " >
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" ><i style="color:red;font-size:18px;">*</i> <i class="fa fa-users" aria-hidden="true" style="color:#E4791A"></i> Category</label>
														<div class="col-lg-7">
															<select class="form-control" name="cmbCommunity" id="cmbCommunity"   >
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
											<!--</div>-->
										</div>
										<!--<div  class="row"  style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5">&nbsp;&nbsp;<i class="fa fa-credit-card" aria-hidden="true" style="color:#E4791A"></i> State</label>
														<div class="col-lg-7">
															<input type="hidden" class="form-control test" id="hidState" name="hidState" value="<?=$hidStateCode?>" data-placement="top" data-toggle="tooltip">
															<input type="text" class="form-control test" value="<?=$stateCode?>" data-placement="top" data-toggle="tooltip" title="State"  disabled>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="padding-right: 35px;">&nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i><i class="fa fa-home" aria-hidden="true" style="color:#E4791A"></i> Home District</label>
														<div class="col-lg-7">
															<select name="cmbHomeDist" id="cmbHomeDist" class="form-control" >
																<option value=''>Select District</option>
																<?php
																/*echo $cmbHomeDist;
																die();*/
																foreach($allHomeDistricts as $row)
																{
																	if($cmbHomeDist == $row['district_code'])
																	{
																		$x = ' selected ';
																	}
																	else
																	{
																		$x = '';
																	}
																	//$x = ($cmbHomeDist == $row['district_code'] ? ' selected ' : '');
																	echo "<option value='".$row['district_code']."' $x>".$row['district_name']."</option>";
																} 
																?>	
															</select>
														</div>
													</div>
											</div>
										</div>
										</div>
										
										<!--**************START OF GENDER AND PHYSICAL FITNESS*********-->
										<div  class="row" style="margin-top: 20px;">
										<div class="col-lg-6">
											<div class="form-group" >
												<label for="" class="col-lg-5"  >&nbsp;&nbsp; <i class="fa fa-bookmark" aria-hidden="true" style="color:#E4791A;"></i> Permanent Resident of Arunachal Pradesh</label>
												<div class="col-lg-7">
													<label class="radio-inline">
														<input type="radio" name="radioResident" id="radioResidentY" value="YES" <?php if($radioResident=="YES") { echo "checked"; } ?> > Yes
													</label>
													<label class="radio-inline">
														<input type="radio" name="radioResident" id="radioResidentN" value="NO" <?php if($radioResident=="NO") { echo "checked"; } ?> > No
													</label>
													
												</div>
											</div>
										</div>
										<div class="col-lg-6">
										 	<div class="form-group">
												<label for="" class="col-lg-5" style="    padding-right: 35px;">&nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i> <i class="fa fa-globe" aria-hidden="true" style="color:#E4791A"></i> Nationality</label>
												<div class="col-lg-7">
													<input type="text" class="form-control test" id="txtNationality" name="txtNationality"  maxlength="12" value="Indian" data-placement="top" data-toggle="tooltip" title=" Enter Nationality" disabled>
													<input type="hidden" class="form-control test" id="cmbNationality" name="cmbNationality" value="IND">
													
												</div>
											</div>
										</div>
									</div>
										<!--**************END OF GENDER AND PHYSICAL FITNESS*********-->
										<div  class="row"  style="margin-top: 20px;">
										<div class="col-lg-6">
											<div class="row">
												<!--<div class="col-lg-8">-->
												<div class="form-group" >
													<label for="" class="col-lg-5 " >&nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i> <i class="fa fa-wheelchair" aria-hidden="true" style="color:#E4791A";></i> Belongs To PwD</label>
													<div class="col-lg-7" >
														<label class="radio-inline">
															<input type="radio"  name="radioPhysicallY" id="radioPhysicallYN" value="NO" <?php if($radioPhysicallY=="NO") { echo "checked"; } ?> > NO
														</label>
														<label class="radio-inline">
															<input type="radio" name="radioPhysicallY" id="radioPhysicallYY" value="YES" <?php if($radioPhysicallY=="YES") { echo "checked"; } ?> > YES
														</label>
													</div>
												</div>
											</div>
											
										</div>
										<div class="col-lg-6">
											<div class="row">
												<!--</div>-->
												<div style="margin-left: -200px;" class="col-lg-12" id="divPH">
													<div class="form-group">
														<div class="col-lg-12">
															<select class="form-control" name="cmbPH" id="cmbPH" >
																<option value=''>Select</option>
																<option value='OH' <?= $txtphtype == 'OH' ? ' selected="selected"' : '';?>>Blind and low vision</option>
																<option value='VH' <?= $txtphtype == 'VH' ? ' selected="selected"' : '';?>>Deaf and hard of hearing</option>
																<option value='HI' <?= $txtphtype == 'HI' ? ' selected="selected"' : '';?>>Locomotory disability including celebral palsy, leprosy cured, dwarfism, acid attack victim and muscular dystrophy</option>
																<option value='HI' <?= $txtphtype == 'AI' ? ' selected="selected"' : '';?>>Autism, intelectual disability, specific learning disability and mental illness</option>
																<option value='HI' <?= $txtphtype == 'MD' ? ' selected="selected"' : '';?>>Multiple disability from amongst persons under clauses (a) to (d) including deaf blindness in the post indenitfied for each disability</option>
															</select>
															
														</div>
													</div>
												</div>
											</div>
											
										</div>
										
									</div>
									<div  class="row" style="margin-top: 20px;">
										<div class="col-lg-6">
											<div class="form-group" >
												<label for="" class="col-lg-5"  >&nbsp;&nbsp; <i style="color:red;font-size:18px;">*</i> Sports</label>
												<div class="col-lg-7">
													<label class="radio-inline">
														<input type="radio" name="radioSports" id="radioSportsY" value="YES" <?php if($radioSports=="YES") { echo "checked"; } ?> > Yes
													</label>
													<label class="radio-inline">
														<input type="radio" name="radioSports" id="radioSportsN" value="NO" <?php if($radioSports=="NO") { echo "checked"; } ?> > No
													</label>
													
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group" >
												<label for="" class="col-lg-5"  >&nbsp;&nbsp; <i style="color:red;font-size:18px;">*</i> Ex-serviceman</label>
												<div class="col-lg-7">
													<label class="radio-inline">
														<input type="radio" name="radioService" id="radioServiceY" value="YES" <?php if($radioService=="YES") { echo "checked"; } ?> > Yes
													</label>
													<label class="radio-inline">
														<input type="radio" name="radioService" id="radioServiceN" value="NO" <?php if($radioService=="NO") { echo "checked"; } ?> > No
													</label>
													
												</div>
											</div>
										</div>
									</div>
									<div  class="row"  style="margin-top: 20px;">
									<!--<div  class="row"  style="margin-top: 20px;">-->
										<div class="col-lg-12">
											<div class="form-group">
												<label for="" class="col-lg-5" ><i style="color:red;font-size:18px;">*</i> <i class="fa fa-users" aria-hidden="true" style="color:#E4791A"></i>Name of DC office</label>
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
															<input type="text" class="form-control" name="txtPresentLocality" id="txtPresentLocality" onchange="uncheck();" onkeyup="changeCase(this)" maxlength="80" value="<?=$txtPresentAddress?>" >
														</div>

													</div>
												</div>
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
													<div class="form-group">
														<label for="" class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-5" style="    padding-right: 35px;">&nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i> Post</label>
														<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-7">
															<input type="text" class="form-control" name="txtPresentPost" id="txtPresentPost" onchange="uncheck();" onkeypress="return isAlphaKey(event)"   onkeyup="changeCase(this)" maxlength="80" value="<?=$txtPresentPost?>" >
														</div>
													</div>
												</div>
											</div>
											<!--************ROW END***************-->

											<!--********PLOT AND LOCALITY***********-->
											<div class="row"  style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="    padding-right: 35px;"> <i style="color:red;font-size:18px;">*</i>City</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="city_name" value="<?=$city_name?>" onchange="uncheck();" onkeypress="return isAlphaKey(event)"   onkeyup="changeCase(this)" maxlength="80" id="city_name" >
														</div>
													</div>
												</div>


												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> State</label>
														<div class="col-lg-7">
															<select name="cmbPresentState" onchange="uncheck();"  id="cmbPresentState" class="form-control" >
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
														<label for="" class="col-lg-5" onchange="uncheck();"  style="padding-right: 35px;"><i style="color:red;font-size:18px;">*</i> District</label>
														<div class="col-lg-7">
															<select name="cmbPresentDist" id="cmbPresentDist" class="form-control" >
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
															<input type="text" class="form-control" onchange="uncheck();"  name="txtPresentPin" id="txtPresentPin" onkeypress="return isNumberKey(event)" maxlength="6" value="<?=$txtPresentPin?>" data-placement="top" data-toggle="tooltip" title="Pin must be 6digit Ex:123456" >
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
										<legend style="width: 20%;">Permanent Address</legend>
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
														<input type="checkbox" id="chksameasresidential" name="chksameasresidential" value="Y" onclick="setSameAddress();" <?php if($chksameasresidential=="Y") { echo "checked"; } ?> > 
											Permanent Address Is Same As Present Address
													</div>
												</div>
											</div>
											<div class="row"  style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> H/No/Locality/Street Name/Village </label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="txtPermenentLocality" id="txtPermenentLocality" onkeyup="changeCase(this)" maxlength="80" value="<?=$txtPermenentAddress?>" >
														</div>
													</div>
												</div>
												 
													<div class="col-lg-6">
														<div class="form-group">
															<label for="" class="col-lg-5" style="    padding-right: 35px;">&nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i> Post</label>
															<div class="col-lg-7">
																<input type="hidden" name="hidPermanentPost" id="hidPermanentPost" value="<?=$txtPermanentPost?>" />
																<input type="text" class="form-control" name="txtPermanentPost"  onkeypress="return isAlphaKey(event)"  id="txtPermanentPost" onkeyup="changeCase(this)" maxlength="80" value="<?=$txtPermanentPost?>" >
															</div>
														</div>
													</div>

												</div>
											


											<div class="row" style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="    padding-right: 35px;"><i style="color:red;font-size:18px;">*</i> City</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="city_name1" id="city_name1" onkeypress="return isAlphaKey(event)"  value="<?=$city_name1?>" onkeyup="changeCase(this)" maxlength="80" >
														</div>
													</div>
												</div>
												 

												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> State</label>
														<div class="col-lg-7">
															<input type="hidden"  name="hidPermanentState" id="hidPermanentState" value="<?=$cmbPermanentState?>" >
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
													</div>
												</div>
													
												 
											</div>

                                          	<div class="row"  style="margin-top: 20px;">
												<div class="col-lg-6">

													<div class="form-group">
														<label for="" class="col-lg-5" style="    padding-right: 35px;"><i style="color:red;font-size:18px;">*</i> District</label>
														<div class="col-lg-7">
															<input type="hidden"  name="hidPermanentState" id="hidPermanentState" value="<?=$cmbPermanentState?>" />
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
													</div>

												</div>

												<div class="col-lg-6">
													<div class="form-group">
													<label for="" class="col-lg-5" > &nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i> PIN</label>
													<div class="col-lg-7">
														<input type="hidden"  name="hidPermanentPin" id="hidPermanentPin" value="<?=$txtPermanentPin?>" />
														<input type="text" class="form-control" name="txtPermanentPin" id="txtPermanentPin" value="<?=$txtPermanentPin?>" onkeypress="return isNumberKey(event)" maxlength="6" data-placement="top" data-toggle="tooltip" title="Pin must be 6digit Ex:123456">
													</div>
												</div>


												</div>
											</div>
										</fieldset>	
										</div>
							
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 " style="padding: 10px;    margin-top: 35px;">
											<fieldset class="">
												<legend style="width: 20%;">Choice Of Center</legend>
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

																<select class="form-control" name="center_name1" id="center_name1"   >
																	<option value="">Select Preference</option>							 
																</select>

															</div>

															<div class="col-sm-4 form-group">
																<label>Choice 2</label>

																<select class="form-control" name="center_name2" id="center_name2"   >
																	<option value="">Select Preference</option>									 
																</select>
																<!-- <input type="text" class="form-control"    name="center_name2" value="<?=$center_name2?>" /> 
																<input type="text" class="form-control"    name="center_code2" value="<?=$center_code2?>" />-->
															</div>

															<div class="col-sm-4 form-group">
																<label>Choice 3</label>
																<select class="form-control" name="center_name3" id="center_name3"   >
																	<option value="">Select Preference</option>									 
																</select>
																<!-- <input type="text" class="form-control"    name="center_name3" value="<?=$center_name3?>" /> 
																<input type="text" class="form-control"    name="center_code3" value="<?=$center_code3?>" />-->
															</div>
														</div>
													<!--</div>-->
												</div>

											</div>
											
											</fieldset>
											
										<!--	<?php if($show != 1) { ?>
											<div class="row"  style="margin-top: 20px;">
												<div class="form-group">
													<div>
														<br />
														<a class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 btn btn-warning btnNext" role="button">Next &raquo;</a>
														
													</div>
												</div>	
											</div>
											<?php } ?>  -->
										</div>
											
										
										<br />
									</div>
									
								</div>
								
							</div>

							<!-- second tab-->
							
							<div class="tab-pane" id="academic_tab"> 
							
								<!--***********START OF ACADEMIC INFORMATION SECTION************-->
										
								<div class="col-lg-12" id="divAcademicInfo" style="padding: 5px; margin-top: 10px;">
								<fieldset>
									<legend style="width: 20%;">Academic Information</legend>
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
																<select class="form-control input-sm" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>">
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
																<select class="form-control input-sm grad" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>">
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
															<div id="container_grad">
																<input type="text" class="form-control input-sm" name="txtOther_grad" id="txtOther_grad" value="<?= $txtOther_grad?>" />
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
																		<select class="form-control input-sm" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>">
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
																<select class="form-control input-sm" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>">
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
																<select class="form-control input-sm grad" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>">
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
															<div id="container_grad">
																<input type="text" class="form-control input-sm" name="txtOther_grad" id="txtOther_grad" value="<?= $txtOther_grad?>" />
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
																		<select class="form-control input-sm" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>">
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
																<select class="form-control input-sm" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>">
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
																<select class="form-control input-sm grad" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>">
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
															<div id="container_grad">
																<input type="text" class="form-control input-sm" name="txtOther_grad" id="txtOther_grad" value="<?= $txtOther_grad?>" />
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
																		<select class="form-control input-sm" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>">
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
																<select class="form-control input-sm" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>">
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
																<select class="form-control input-sm grad" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>">
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
															<div id="container_grad">
																<input type="text" class="form-control input-sm" name="txtOther_grad" id="txtOther_grad" value="<?= $txtOther_grad?>" />
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
																		<select class="form-control input-sm" name="txtqual2<?=$sl_no?>" id="txtqual2<?=$sl_no?>">
																			<option value='' <?php if(${'txtqual2'.$sl_no}=='') { echo "selected";  } ?>>Select</option>
																			<option value='Diploma in TV' <?php if(${'txtqual2'.$sl_no}=='Diploma in TV') { echo "selected";  } ?> >Diploma in TV</option>
																			<option value='Diploma in Radio/Sound System' <?php if(${'txtqual2'.$sl_no}=='Diploma in Radio/Sound System') { echo "selected"; } ?>>Diploma in Radio/Sound System</option>
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

															?>
															<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtYear<?=$sl_no?>" name="txtYear<?=$sl_no?>" onkeypress="return isNumberKey(event)" maxlength="4"   value="<?php echo ${'txtYear'.$sl_no} == 'NULL'?'':${'txtYear'.$sl_no}; ?>"  /></div></td>
															<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtBoard<?=$sl_no?>" name="txtBoard<?=$sl_no?>" maxlength="90"  value="<?=${'txtBoard'.$sl_no}?>"  onkeyup="changeCase(this)" maxlength="50"/></div></td>
															<td><div class="form-group">
																<select class="form-control input-sm" name="txtdistinct<?=$sl_no?>" id="txtdistinct<?=$sl_no?>">
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
																<select class="form-control input-sm" name="txtgrading<?=$sl_no?>" id="txtgrading<?=$sl_no?>">
																	<option value='' <?php if(${'txtgrading'.$sl_no}=='') { echo "selected";  } ?>>Select</option>
																	<option value='YES' <?php if(${'txtgrading'.$sl_no}=='YES') { echo "selected";  } ?> >Yes</option>
																	<option value='NO' <?php if(${'txtgrading'.$sl_no}=='NO') { echo "selected"; } ?>>No</option>
																</select>
															</div></td>
															<!--<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtMS<?=$sl_no?>" name="txtMS<?=$sl_no?>" value="<?php echo ${'txtMS'.$sl_no} == 'NULL'?'':${'txtMS'.$sl_no}; ?>" onkeypress="return isNumberKey(event)" onblur="calculatePercentage(<?=$sl_no?>)"  /></div></td>
															<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtFM<?=$sl_no?>" name="txtFM<?=$sl_no?>" value="<?php echo ${'txtFM'.$sl_no} == 'NULL'?'':${'txtFM'.$sl_no}; ?>" onkeypress="return isNumberKey(event)" onblur="calculatePercentage(<?=$sl_no?>)"  /></div></td>-->
															<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtPercent<?=$sl_no?>" onkeypress="return isNumberKey(event)" name="txtPercent<?=$sl_no?>" maxlength="5"  value="<?php echo ${'txtPercent'.$sl_no} == 'NULL'?'':${'txtPercent'.$sl_no}; ?>" /></div></td>
															
															<!--<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtdistinct<?=$sl_no?>" name="txtdistinct<?=$sl_no?>" value="<?=${'txtdistinct'.$sl_no}?>"  onkeyup="changeCase(this)" maxlength="50"/></div></td>
															-->
															
														</tr>
															<?php
															$sl_no++;
															}
															?>
															
													
														
													</tbody>
												</table>
												<!--<button class="btn btn-danger" id="btnAddQual" type="button" >Add</button>-->
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group" >
												<label for="" class="col-lg-5"  >&nbsp;&nbsp; <i style="color:red;font-size:18px;">*</i> <b>Computer Education</b></label>
												<div class="col-lg-7">
													<label class="radio-inline">
														<input type="radio" name="radioComputer" id="radioComputerY" value="YES" <?php if($radioComputer=="YES") { echo "checked"; } ?> > Yes
													</label>
													<label class="radio-inline">
														<input type="radio" name="radioComputer" id="radioComputerN" value="NO" <?php if($radioComputer=="NO") { echo "checked"; } ?> > No
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
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtExamName1" name="txtExamName1" value="<?=$txtExamName1?>" /></div></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtStream1" name="txtStream1" value="<?=$txtStream1?>" /></div></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtYearQual1" onkeypress="return isNumberKey(event)" name="txtYearQual1" maxlength="4" value="<?=$txtYearQual1?>" /></div></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtBoardOth1" name="txtBoardOth1" maxlength="500" value="<?=$txtBoardOth1?>" /></div></td>
														<!--<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtSub1" name="txtSub1" maxlength="500" value="<?=$txtSub1?>" /></div></td>-->
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtDiv1" name="txtDiv1" maxlength="500" value="<?=$txtDiv1?>" /></div></td>
														<td><div class="form-group">
															<select class="form-control input-sm" name="txtGradingOth1" id="txtGradingOth1">
																<option value='' <?php if($txtGradingOth1 == '') { echo "selected";  } ?>>Select</option>
																<option value='YES' <?php if($txtGradingOth1 == 'YES') { echo "selected";  } ?> >Yes</option>
																<option value='NO' <?php if($txtGradingOth1 == 'NO') { echo "selected"; } ?>>No</option>
															</select>
														</div></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtCGPA1" onkeypress="return isNumberKey(event)" name="txtCGPA1" maxlength="500" value="<?=$txtCGPA1?>" /></div></td>
														
													</tr>
													<tr>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtExamName2" name="txtExamName2" value="<?=$txtExamName2?>" /></div></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtStream2" name="txtStream2" value="<?=$txtStream2?>" /></div></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtYearQual2" onkeypress="return isNumberKey(event)" name="txtYearQual2" maxlength="4" value="<?=$txtYearQual2?>" /></div></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtBoardOth2" name="txtBoardOth2" maxlength="500" value="<?=$txtBoardOth2?>" /></div></td>
														<!--<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtSub2" name="txtSub2" maxlength="500" value="<?=$txtSub2?>" /></div></td>-->
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtDiv2" name="txtDiv2" maxlength="500" value="<?=$txtDiv2?>" /></div></td>
														<td><div class="form-group">
															<select class="form-control input-sm" name="txtGradingOth2" id="txtGradingOth2">
																<option value='' <?php if($txtGradingOth2 == '') { echo "selected";  } ?>>Select</option>
																<option value='YES' <?php if($txtGradingOth2 == 'YES') { echo "selected";  } ?> >Yes</option>
																<option value='NO' <?php if($txtGradingOth2 == 'NO') { echo "selected"; } ?>>No</option>
															</select>
														</div></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtCGPA2" name="txtCGPA2" maxlength="500" value="<?=$txtCGPA2?>" /></div></td>
														
													</tr>
												</table>													   
											</div>
										<!--</div>	-->
									</div>
								<br />
								</fieldset><br />
							<!--		<div class="form-group">
										<div>
											<br />
											<a class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5 btn btn-warning btnPrevious" > &laquo; Previous </a> 
											<a class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-5" ></a> 
											<a class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5 btn btn-warning btnNext" > Next &raquo; </a>
										</div>
									</div>-->
								</div>
								
								
							</div>

							<!-- third tab-->
							
							<div class="tab-pane" id="info_tab"> 
								<div class="col-lg-12" style="padding: 0px;    margin-top: 10px;">
								<fieldset>
									<legend>Information</legend>
								 		<div class="col-sm-12 form-group">
								        <div class="col-sm-7">
											<label for="" ><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Whether working as a regular employee under the Govt. of Arunachal Pradesh ?</label>
										</div>
										<div class="col-sm-5">
											<label class="radio-inline">
												<input type="radio" name="empGovt" id="empGovtno" value="NO" <?php if($is_employed=="NO") { echo "checked"; } ?> > NO
											</label>
											<label class="radio-inline">
												<input type="radio" name="empGovt" id="empGovtyes" value="YES" <?php if($is_employed=="YES") { echo "checked"; } ?> > YES
											</label>
										</div>
									</div>
									<div id="divEmpSuspendedInfo" class="col-sm-12">
								        <div class="col-sm-12 table-responsive">
											<table  class="table table-bordered table-striped">
											    <tr>
													<th class="header" style="text-align:center;">Name of the Office</th>
													<th class="header" style="text-align:center;">Date of Joining</th>
													<th class="header" style="text-align:center;">Name of Post</th>
												</tr>

												<tr>
													<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtNameOfOffice" name="txtNameOfOffice" maxlength="90" value="<?=$txtNameOfOffice?>" /></div></td>
													<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtDOJ" readonly="" name="txtDOJ" value="<?=$txtDOJ?>" /></div></td>
													<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtNameOfPost" name="txtNameOfPost" maxlength="500" value="<?=$txtNameOfPost?>" /></div></td>
												</tr>
												
											</table>													   
										</div>
									</div>
									
									<div class="col-sm-12 form-group">
								        <div class="col-sm-7">
											<label for="" ><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Have you ever been been debarred by State Public Service Commission ?</label>
										</div>
										<div class="col-sm-5">
											<label class="radio-inline">
												<input type="radio" name="empDisciplinary" id="empDisciplinaryno" value="NO" <?php if($empDisciplinary=="NO") { echo "checked"; } ?> > NO
											</label>
											<label class="radio-inline">
												<input type="radio" name="empDisciplinary" id="empDisciplinaryyes" value="YES" <?php if($empDisciplinary=="YES") { echo "checked"; } ?> > YES
											</label>
										</div>
									</div>
									<div id="divEmpDisciplinaryInfo" class="col-sm-12">
								       <div class="col-sm-12 table-responsive">
											<table  class="table table-bordered table-striped">
											    <tr>
													<th class="header" style="text-align:center;">Date</th>
													<th class="header" style="text-align:center;">Period of Debarrment</th>
												</tr>

												<tr>
													<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtDateOfDebar" name="txtDateOfDebar" value="<?=$txtDateOfDebar?>" readonly="" /></div></td>
													<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtPeriodOfDebar" name="txtPeriodOfDebar" maxlength="500" value="<?=$txtPeriodOfDebar?>" /></div></td>
												</tr>
												
											</table>													   
										</div>
									</div>
								 	
									<div class="col-sm-12 form-group"style="display: none;" >
								        <div class="col-sm-7">
											<label for="" ><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp; How Would You Pay The Application Fee? </label>
										</div>
										<div class="col-sm-5">
											
											<label class="radio-inline">
												<input type="radio" name="mode" id="modeOnline" value="Online" checked <?php if($mode=="Online") { echo "checked"; } ?>  > Online
											</label>
											<label class="radio-inline">
												<input type="radio" name="mode" id="modeOffline" value="Offline" <?php if($mode=="Offline") { echo "checked"; } ?>  > Offline (Challan)
											</label>
										</div>
									</div>
								</div>
								<div class="col-lg-12" id="forReservedQuota" style="box-shadow:  0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;margin-top: 35px;">
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
								</div>
							<!--	<div class="form-group">
									<div > 
										<br />
										<a class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5 btn btn-warning btnPrevious" > &laquo;    </a> 
										<a class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-5" ></a> 
										<a class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5 btn btn-warning btnNext" > Next &raquo; </a>
										
									</div>
								</div>-->
								<br />

							</div>

							<!-- fourth tab-->
							<div class="tab-pane" id="declaration_tab"> 
							
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
												<input type="checkbox" name="chkUndertaking1" id="chkUndertaking1" value="1"  >
												I  hereby declare that I have read the detail information/advertisement before submission of this application.I hereby certify that all statements made and information given by me in this application form are true, complete and correct to the best of my knowledge and belief. In the event of any information is being found false or incorrect before or after the interview or appointment, action can be taken against me by the Corporation and my candidature/appointment shall automatically cancelled/terminated.<br \>
											</div>
										</div>
									</div>
								<br />
									<a class="btn btn-warning btnPrevious" > &laquo; Previous </a>
								</fieldset>
							</div>	
							
							<!--	<div class="form-group" >
									<div class="col-lg-12">
										
										<button type="submit" class="btn btn-primary btn-block" id="btnPersonalInfo" name="btnPersonalInfo"  onclick="return validate();"   style="margin-top: 20px;font-size:16px;"><span class="glyphicon glyphicon-send" style="font-size:18px;"></span> Save & Next</button>
									</div>
								</div>	-->
							</div>
														
						
						</div>
					</form>
				</div>
				</div>
			</div>	
			</div>
			</div>
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



 prefernce1_drop="<?=$center_name1?>";
 prefernce2_drop="<?=$center_name2?>";
 prefernce3_drop="<?=$center_name3?>";
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