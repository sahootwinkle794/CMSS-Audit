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
	//$radioHandicapped = $row['is_physically_challanged'];
	$radioPhysicallY  = $row['physically_challenged'];
	$radioMinority   = $row['is_minority_community'];
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
	
	
	/*$amount_paid=$row['amount_paid'];
	$draft_no=$row['draft_no'];
	$payment_date=$row['payment_date'];
	$bank_name=$row['bank_name'];*/
	
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
		
		
	</style>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.css" />
<div class="container-fluid" style=" padding-bottom: 50px;">

	<div class="row" >
		<div class="col-sm-1 col-md-1 col-lg-1 col-xs-1" style="margin-top: 30px;margin-left: -15px;">
			<?php include('sidebar/sidebar.php'); ?>
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
					<form action="" method="post" id="frmApply" name="frmApply">
						<div class="tab-content">
						
						
							<!-- first tab-->
						
							<div class="tab-pane in active" id="address_tab">
								<div>
								

									

									<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;">
										<h3 style="text-align: center;margin-top: -6px;color: #666;"> </h3>
										<!--************START OF NAME ROW**********--> 
										<div class="row">
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
														<input type="text" class="form-control test" id="txtMiddleName" name="txtMiddleName" placeholder="Enter Middle Name" readonly="readonly" data-placement="right" data-toggle="tooltip" title="Middle Name" value="<?=strtoupper($txtMiddleName)?>" <?php echo $show==1?'disabled':''; ?>>
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
											<div class="col-lg-6">
												<div class="form-group">
													<label for="" class="col-lg-5" style=""><i style="color:red;font-size:18px;">*</i> <i class="fa fa-male" aria-hidden="true" style="color:#E4791A"></i> Father's Name </label>
													<div class="col-lg-7">
														<input type="text" class="form-control" id="txtFatherName" name="txtFatherName" placeholder="Enter Father's Name" onkeyup="changeCase(this)" maxlength="50" value="<?=strtoupper($txtFatherName)?>" <?php echo $show==1?'disabled':''; ?>>
													</div>
												</div>
											</div>
										</div>
										<div  class="row"  style="margin-top: 20px;">
											<div  class="row"  style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="m">&nbsp;&nbsp;<i class="fa fa-credit-card" aria-hidden="true" style="color:#E4791A"></i> ID Proof Number</label>
														<div class="col-lg-7">
															<input type="text" class="form-control test" id="txtidproof" name="txtidproof" placeholder="Enter ID Proof Number " maxlength="12" onkeypress="return isNumberKey(event)"   value="<?=$id_proof_number?>" data-placement="top" data-toggle="tooltip" title=" Enter ID Proof Number " <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="    padding-right: 35px;"><i style="color:red;font-size:18px;">*</i> <i class="fa fa-globe" aria-hidden="true" style="color:#E4791A"></i> Nationality</label>
														<div class="col-lg-7">
															<input type="text" class="form-control test" id="txtNationality" name="txtNationality"  maxlength="12" value="Indian" data-placement="top" data-toggle="tooltip" title=" Enter Nationality" disabled>
															<input type="hidden" class="form-control test" id="cmbNationality" name="cmbNationality" value="IND">
															<input type="hidden" id="insCode" name="insCode" value="<?php echo $institute_code; ?>">
															<!--<select class="form-control" name="cmbNationality" id="cmbNationality" <?php echo $show==1?'disabled':''; ?>>
																<?php
																foreach($allNationalities as $row)
																{
																	$x = ($cmbNationality == $row['nationality_code'] ? ' selected ' : '');
																	echo "<option value='".$row['nationality_code']."' $x>".$row['nationality']."</option>";
																} 
																?>
															</select>-->
															
														</div>
													</div>
												</div>
											</div>
										<div class="row" style="margin-top: 20px;">
										<div class="col-lg-6">
											<div class="form-group">
												<label for="txtDOB" class="col-lg-5" style="text-align:left;">&nbsp;&nbsp;<i class="fa fa-birthday-cake" aria-hidden="true" style="color:#E4791A"></i> Date Of Birth</label>
												<div class="col-lg-7">
													Day <select id="cmbDay" name="cmbDay" disabled="disabled">
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
													Month <select id="cmbMonth" name="cmbMonth" disabled="disabled">
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
													Year <select id="cmbYear" name="cmbYear" disabled="disabled">
														<?php
														for($i=1900;$i<=2050;$i++)
														{
															$s = ($i == $y ? ' selected ' : '');
															echo "<option value='$i' $s>$i</option>	";
														}
														?>														
													</select>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label for="" class="col-lg-5" style="m">&nbsp;&nbsp;<span class="glyphicon glyphicon-envelope" style="color:#E4791A"></span> Email Id</label>
												<div class="col-lg-7">
													<input type="email" class="form-control" id="txtemailid" name="txtemailid" maxlength="250" disabled=""  value="<?=$txtEmailId?>" data-placement="top" data-toggle="tooltip" title="Your Email-id. Ex: xyz@gmail.com">
												</div>
											</div>
										</div>
									</div>
									
									</div>

										
										<div class="form-group" >
											<div class="col-lg-12">
												
												<button type="submit" class="btn btn-info btn-block" id="btnPersonalInfo" name="btnPersonalInfo"  style="margin-top: 20px;font-size:16px;"><span class="glyphicon glyphicon-send" style="font-size:18px;"></span> Next</button>
											</div>
										</div>	
									</div>
									
								</div>
								
							</div>
														
						
						</div>
					</form>
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
<!--<script src="<?php echo base_url(); ?>public/assets/js/template001.js?v=<?php rand()?>"></script>-->
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