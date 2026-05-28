<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata');
$now = date('Y-m-d h:i:s', now());

//print_r($allQualifications);
//print_r($program_data);die();

foreach($program_data as $row)
{
	$admcode = $row['program_code'];
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
$NorthEast = '';
$radioJEE = 'COMMON';
$cmbNationality = '';
$cmbReligion = '';
//$allMinority = '';
$radiogender = '';
$txtOtherNationality = '';

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
	$MothersIncome='';
	$FathersAdhar='';
	$MothersAdhar='';

$graduation_quali='';
$txtphtype='';
$txtUid = '';
$txtFatherName = '';
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
$txtQualification1 = '';
$txtYear1 = '';
$txtBoard1 = '';
$txtDivision1 = '';
$txtMS1 = '';
$txtFM1 ='';
$txtPercent1 = '';
$txtQualification2 = '';
$txtYear2 = '';
$txtBoard2 = '';
$txtDivision2 = '';
$txtMS2 = '';
$txtFM2 ='';
$txtPercent2 = '';
$txtQualification3 = '';
$txtYear3 = '';
$txtBoard3 = '';
$txtDivision3 = '';
$txtMS3 = '';
$txtFM3 ='';
$txtPercent3 = '';

$txtQualification4 = '';
$txtYear4 = '';
$txtBoard4 = '';
$txtDivision4 = '';
$txtMS4 = '';
$txtFM4 ='';
$txtPercent4 = '';
$txtQualification5 = '';
$txtYear5 = '';
$txtBoard5 = '';
$txtDivision5 = '';
$txtMS5 = '';
$txtFM5 ='';
$txtPercent5 = '';
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
	$radioID = $row['id_proof'];
	$NorthEast = $row['is_north_east'];
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
	
	$radiobelong   = $row['exservice'];
	
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
//print_r($father_data);

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
	$sl++;
}
foreach($course_data as $row)
{
	$course_code = $row['course_code'];
	$course_name = $row['course_name'];
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
	
	if(document.getElementById("chksameasresidential").checked)
	{
		
	}
	else
	{
		
		
		/*if(document.getElementById("co_name").value == '')
		{
			errorMessage += "Please enter C/o in Permanent Address.<br/>";
		}
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
		}*/
	}
	if (document.getElementById('cmbNationality').value == 'OTH') {
		
		/*if(document.getElementById("txtOtherNationality").value == '')
		{
			errorMessage += "Please specify Nationality.<br/>";
		}*/
	}
	
	
	if(document.getElementById("txtMS1").value != '')
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
	}
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





<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.css" />
<div class="container-fluid" style="margin-top: 36px; padding-bottom: 50px;">

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
					<div class="panel panel-primary">
						<div class="panel-heading step-heading">

							<b><i class="fa fa-user"></i> Application Form</b>
						</div>
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
					<form action="" method="post" id="frmApply" name="frmApply">

						<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;margin-top: 5px;">
							<h3 style="text-align: center;margin-top: -6px;color: #666;"> Details</h3>
							<div class="form-group">
								<input type="hidden" name="hidDate" id="hidDate" >
							</div>
							<!--************START OF NAME ROW**********--> 


							            <div class="row">
							               	<div class="col-lg-12">
												<div class="form-group">
													<label for="" class="col-lg-5" ><i style="color:red;font-size:18px;">*</i> Application For/आवेदन पत्र:</label>
													<div class="col-lg-7">
														<!--<select class="form-control" name="master_name" id="master_name"   <?php echo $show==1?'disabled':''; ?>>
															<option value='' <?php if($master_name=="") {?> selected="selected" <?php } ?>>Select Course Category</option>
															<?php foreach($course_data as $row){ ?>
																<option value="<?=$row['course_code']?>" <?php if($master_name==$row['course_code']) {?> selected="selected" <?php } ?>><?=$row['course_name']?></option>
															<?php } ?>
															
															
																						 
														</select>-->
														<input type="hidden" id="master_name" name="master_name" value="<?= $course_code ?>"/>
														<input type="text" class="form-control" id="txtCourse" name="txtCourse" readonly="readonly"  value="<?= $course_name ?>" <?php echo $show==1?'disabled':''; ?>>
													</div>
												</div>
											</div>
										</div>	
										<!--<div class="row" style="margin-top: 20px;">
							               	<div class="col-lg-12">
												<div class="form-group">
													<label for="" class="col-lg-5" ><i style="color:red;font-size:18px;">*</i> Date Of JEE :</label>
													<div class="col-lg-7">
														<label class="radio-inline">
															<input type="radio" name="radioJEE" id="radioJEESouth" value="SOUTH" <?php if($radioJEE=="SOUTH") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> 17th June 2018
														</label>
														<label style="margin-left: 300px;" class="radio-inline">
															<input type="radio" name="radioJEE" id="radioJEECommon" value="COMMON" <?php if($radioJEE=="COMMON") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> 8th July 2018
														</label>
													</div>
												</div>
												<div style="margin-left: -10px;">
													&nbsp;&nbsp;  For Andhra Pradesh, Telangana, Tamil Nadu, Karnataka and Kerala.
												</div>
											</div>
										</div>	-->




							<!-- <div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label for="" class="col-lg-4" style="text-align:left; " ><i style="color:red;padding-bottom: 10px;" class="glyphicon glyphicon-asterisk"></i> Application For MPT/MOT/MPO :</label>
										<div class="col-sm-8" ">
											<input type="text" class="form-control"  id="master_name" name="master_name" value="<?=$master_name?>" <?php echo $show==1?'disabled':''; ?>/>
										</div>
									</div>
								</div>
							</div> -->
							<div class="row" style="margin-top: 20px;" id="COMMON">	

								<div class="col-lg-12">
									<!--<div class="form-group">-->
										<label for="" class="col-lg-4" style="text-align:left; " ><i style="color:red;font-size:18px;">*</i> Choice Of CIPET Center For Admission/प्रवेश के लिए सीआईपीईटी केंद्र का विकल्प :</label>
										<div class="col-sm-8">
											<div class="col-sm-4 form-group">
												<label>Choice 1</label>

												<select class="form-control" name="center_name1" id="center_name1COMMON"   <?php echo $show==1?'disabled':''; ?>>
													<option value="">Select Preference</option>							 
												</select>

											</div>

											<div class="col-sm-4 form-group">
												<label>Choice 2</label>

												<select class="form-control" name="center_name2" id="center_name2COMMON"   <?php echo $show==1?'disabled':''; ?>>
													<option value="">Select Preference</option>									 
												</select>
												<!-- <input type="text" class="form-control"    name="center_name2" value="<?=$center_name2?>" <?php echo $show==1?'disabled':''; ?>/> 
												<input type="text" class="form-control"    name="center_code2" value="<?=$center_code2?>" <?php echo $show==1?'disabled':''; ?>/>-->
											</div>

											<div class="col-sm-4 form-group">
												<label>Choice 3</label>
												<select class="form-control" name="center_name3" id="center_name3COMMON"   <?php echo $show==1?'disabled':''; ?>>
													<option value="">Select Preference</option>									 
												</select>
												<!-- <input type="text" class="form-control"    name="center_name3" value="<?=$center_name3?>" <?php echo $show==1?'disabled':''; ?>/> 
												<input type="text" class="form-control"    name="center_code3" value="<?=$center_code3?>" <?php echo $show==1?'disabled':''; ?>/>-->
											</div>
										</div>
									<!--</div>-->
								</div>

							</div>
						

						</div>

						<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;margin-top: 20px;">
							<h3 style="text-align: center;margin-top: -6px;color: #666;"> Personal Details</h3>
							<!--************START OF NAME ROW**********--> 
							<div class="row">
								<div class="col-lg-4">
									<div class="form-group">
										<label for="" class="col-lg-5" ><i class="fa fa-user" style="color:#E4791A"></i> First Name/पहला नाम</label>
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
										<label for="" class="col-lg-4" ><i class="fa fa-user" style="color:#E4791A"></i> Last Name</label>
										<div class="col-lg-8">
											<input type="text" class="form-control" id="txtLastName" name="txtLastName" placeholder="Enter Last Name"  value="<?=strtoupper($txtLastName)?>" readonly="readonly" <?php echo $show==1?'disabled':''; ?>>
										</div>
									</div>
								</div>
							</div>

							<!--***************END OF NAME************-->

<!--**************START OF EMAIL ID AND Aadhaar NUMBER*********-->
											<div  class="row"  style="margin-top: 20px;">
												<div class="col-lg-12">
													<div class="form-group">
														<label for="" class="col-lg-9" style="m"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-credit-card" aria-hidden="true" style="color:#E4791A"></i> Do You Have Any Of The ID Proof (Aadhaar / Driving Licence / Passport / Student ID Card / Bank Passbook )/क्या आपके पास आईडी सबूत है (आधार / ड्राइविंग लाइसेंस / पासपोर्ट / छात्र आईडी कार्ड / बैंक पासबुक)</label>
														<div class="col-lg-3">
															<label class="radio-inline">
																<input type="radio" name="radioID" id="radioIDYes" value="Yes" <?php if($radioID=="Yes") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Yes
															</label>
															<label class="radio-inline">
																<input type="radio" name="radioID" id="radioIDNo" value="No" <?php if($radioID=="No") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> No
															</label>
														</div>
													</div>
												</div>
											</div>
											<div  class="row"  style="margin-top: 20px;">
												<div class="col-lg-12">
													<div class="form-group">
														<label for="" class="col-lg-9" style="m"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-credit-card" aria-hidden="true" style="color:#E4791A"></i> Do You Belong to the Following North East States of Arunachal Pradesh, Assam, Manipur, Meghalaya, Mizoram, Nagaland, Sikkim and Tripura?</label>
														<div class="col-lg-3">
															<label class="radio-inline">
																<input type="radio" name="NorthEast" id="NorthEastYes" value="Yes" <?php if($NorthEast=="Yes") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Yes
															</label>
															<label class="radio-inline">
																<input type="radio" name="NorthEast" id="NorthEastNo" value="No"  <?php if($NorthEast=="No") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> No
															</label>
														</div>
													</div>
												</div>
											</div>
											<div  class="row"  style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="m">&nbsp;&nbsp;<i class="fa fa-credit-card" aria-hidden="true" style="color:#E4791A"></i> Candidate Aadhaar No./अभ्यर्थी आधार संख्या</label>
														<div class="col-lg-7">
															<input type="text" class="form-control test" id="txtUid" name="txtUid" placeholder="Enter Aadhaar No" maxlength="12" onkeypress="return isNumberKey(event)"   value="<?=$txtUid?>" data-placement="top" data-toggle="tooltip" title="Aadhaar No must be a digit. Ex:123456789012" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>

												
											</div>
											
											<!--**************END OF EMAIL ID AND Aadhaar NUMBER*********-->
                              

                             <!--  <div  class="row"  style="margin-top: 20px;">
												
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="m"><i style="color:red;font-size:18px;">*</i> <i class="fa fa-credit-card" aria-hidden="true" style="color:#E4791A"></i> Fathers Profession</label>
														<div class="col-lg-7">
															<input type="text" class="form-control test" id="FathersProfession" name="FathersProfession" placeholder="Enter Fathers Profession" maxlength="80"  onkeyup="changeCase(this)" data-placement="top" data-toggle="tooltip" value="<?=$FathersProfession;?>" title="" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>

														<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style=""><i style="color:red;font-size:18px;">*</i> <i class="fa fa-male" aria-hidden="true" style="color:#E4791A"></i> Fathers Income</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" id="FathersIncome" name="FathersIncome" onkeypress="return isNumberKey(event)" placeholder="Enter Fathers Income"   value="<?=$FathersIncome;?>" maxlength="8" data-placement="top" data-toggle="tooltip" title="Your Father's Annual Income. Ex:20000000" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>
											</div> -->

							<div class="row" style="margin-top: 20px;">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="txtDOB" class="col-lg-5" style="text-align:left;">&nbsp;&nbsp;<i class="fa fa-birthday-cake" aria-hidden="true" style="color:#E4791A"></i> Date Of Birth/जन्म की तारीख</label>
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
									<label for="" class="col-lg-5" style="m">&nbsp;&nbsp;<span class="glyphicon glyphicon-envelope" style="color:#E4791A"></span> Email Id/ईमेल आईडी</label>
									<div class="col-lg-7">
										<input type="email" class="form-control" id="txtemailid" name="txtemailid" disabled=""  value="<?=$txtEmailId?>" data-placement="top" data-toggle="tooltip" title="Your Email-id. Ex: xyz@gmail.com">
									</div>
								</div>
							</div>
						</div>

 

							<!--**************START OF GENDER AND PHYSICAL FITNESS*********-->
							<div  class="row" style="margin-top: 20px;">
								<div class="col-lg-6">
									<div class="form-group" >
										<label for="" class="col-lg-5"  ><i style="color:red;font-size:18px;">*</i> <i class="fa fa-venus-mars" aria-hidden="true" style="color:#E4791A;"></i> Gender/लिंग</label>
										<div class="col-lg-7">
											<label class="radio-inline">
												<input type="radio" name="radiogender" id="radiomale" value="M" <?php if($radiogender=="M") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Male
											</label>
											<label class="radio-inline">
												<input type="radio" name="radiogender" id="radiofemale" value="F" <?php if($radiogender=="F") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Female
											</label>
											<label class="radio-inline">
												<input type="radio" name="radiogender" id="radiofemale" value="F" <?php if($radiogender=="T") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Transgender
											</label>

										</div>
									</div>
								</div>
								<div class="col-lg-6">
								 <div class="row">
								<div class="col-lg-8">
									<div class="form-group" >
										<label for="" class="col-lg-6 " ><i style="color:red;font-size:18px;">*</i> <i class="fa fa-wheelchair" aria-hidden="true" style="color:#E4791A";></i> Belongs To Physically Handicapped (PH)/शारीरिक रूप से विकलांग (पीएच) से संबंधित</label>
										<div class="col-lg-6" style="padding-left: 30px;">
											<label class="radio-inline">
												<input type="radio"  name="radioPhysicallY" id="radioPhysicallY" value="NO" <?php if($radioPhysicallY=="NO") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>  onclick="hide('divphtype');"> NO
											</label>
											<label class="radio-inline">
												<input type="radio" name="radioPhysicallY" id="radioPhysicallY" value="YES" <?php if($radioPhysicallY=="YES") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>  onclick="show('divphtype');"> YES
											</label>
										</div>
									</div>
								</div>
								<!--<div class="col-lg-4" id="divphtype" <?php if($radioPhysicallY=="YES") { echo ""; } else { echo 'hidden'; }?> >
									<div class="form-group" >
										<div class="col-lg-12" style="padding-left: 0px;">
											<input type="text" class="form-control" id="txtphtype" name="txtphtype" maxlength="30" onkeyup="changeCase(this)" placeholder="Specify PH Type" value="<?=$txtphtype?>" <?php echo $show==1?'disabled':''; ?>>
										</div>
									</div>
									
								</div>-->
								</div>
								</div>
							</div>
							<!--**************END OF GENDER AND PHYSICAL FITNESS*********-->

							
											<!--**************START OF NATIONALITY ID AND COMMUNITY*********-->
											<div  class="row"  style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="    padding-right: 35px;"><i style="color:red;font-size:18px;">*</i> <i class="fa fa-globe" aria-hidden="true" style="color:#E4791A"></i> Nationality/राष्ट्रीयता</label>
														<div class="col-lg-7">
															<select class="form-control" name="cmbNationality" id="cmbNationality" <?php echo $show==1?'disabled':''; ?>>
																<?php
																foreach($allNationalities as $row)
																{
																	$x = ($cmbNationality == $row['nationality_code'] ? ' selected ' : '');
																	echo "<option value='".$row['nationality_code']."' $x>".$row['nationality']."</option>";
																} 
																?>
															</select>
															
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" ><i style="color:red;font-size:18px;">*</i> <i class="fa fa-users" aria-hidden="true" style="color:#E4791A"></i> Category/वर्ग</label>
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

											<!--<div  class="row"  style="margin-top: 20px;display:none;" id="forNationality">
												<div class="col-lg-6">
													<div class="form-group">

														<label for="" class="col-lg-5" style="    padding-right: 35px;"><i class="fa fa-globe" aria-hidden="true" style="color:#E4791A"></i> Specify the Nation:</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" id="txtOtherNationality" name="txtOtherNationality" placeholder="Please Specify" value="<?=$txtOtherNationality?>" <?php echo $show==1?'disabled':''; ?>>
															
														</div>
													</div>
												</div>
												
											</div>-->

											<!--**************END OF MARITAL STATUS AND CATEGORY*********-->


											


											<!--**************START OF FATHER'S NAME AND MOTHER'S NAME*********-->
											
											<!--**************START OF WHETHER CANDIDATE BELONGS TO NORTH EAST REGION ?*********-->
											<div  class="row" style="margin-top: 20px;">
												<div class="col-sm-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style=""><i style="color:red;font-size:18px;">*</i> <i class="fa fa-map-marker" aria-hidden="true" style="color:#E4791A"></i> Candidate Belongs to Ex-Sevicemen Category ?/अभ्यर्थी पूर्व सेविकमेन श्रेणी के अधीन हैं?</label>
														<div class="col-lg-7">
															<label class="radio-inline">
																<input type="radio"  name="radiobelong" id="radiobelong" value="NO" <?php if($radiobelong=="NO") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?> > NO
															</label>
															<label class="radio-inline">
																<input type="radio" name="radiobelong" id="radiobelong" value="YES" <?php if($radiobelong=="YES") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?> > YES
															</label>
														</div>
													</div>
												</div>

												

											</div>
											<!--**************END OF WHETHER CANDIDATE BELONGS TO NORTH EAST REGION ?*********-->


										</div>
										
										<!--***********END OF PERSONAL DETAILS SECTION************-->



										<!--**************START OF FATHERS DETAILS*********-->


						<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;margin-top: 20px;">
							<h3 style="text-align: center;margin-top: -6px;color: #666;"> Parent/Guardian Details/अभिभावक / अभिभावक विवरण</h3>
											<div  class="row"  style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style=""><i style="color:red;font-size:18px;">*</i> <i class="fa fa-male" aria-hidden="true" style="color:#E4791A"></i> Father's Name / पिता का नाम</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" id="txtFatherName" name="txtFatherName" placeholder="Enter Father's Name" maxlength="80"  onkeyup="changeCase(this)"  value="<?=strtoupper($txtFatherName)?>" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>

												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style=""> <i class="fa fa-credit-card" aria-hidden="true" style="color:#E4791A"></i> Father's / Mother's Profession / पिता / माता का पेशा</label>
														<div class="col-lg-7">
															<input type="text" class="form-control test" id="FathersProfession" name="FathersProfession" placeholder="Enter The Profession" maxlength="80"  onkeyup="changeCase(this)" data-placement="top" data-toggle="tooltip" value="<?=$FathersProfession;?>" title="" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>						
											</div>
										    <div  class="row"  style="margin-top: 20px;">
											   <div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style=""><i style="color:red;font-size:18px;">*</i> <i class="fa fa-male" aria-hidden="true" style="color:#E4791A"></i> Family Annual Income/पारिवारिक वार्षिक आय</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" id="FathersIncome" name="FathersIncome" onkeypress="return isNumberKey(event)" placeholder="Enter The Income"   value="<?=$FathersIncome;?>" maxlength="8" data-placement="top" data-toggle="tooltip" title="Your Father's Annual Income. Put 0(zero) if no Income. Ex:20000000 or 0" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>

												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style=""> <i class="fa fa-male" aria-hidden="true" style="color:#E4791A"></i> Mother's Name/मां का नाम</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" id="txtMotherName" name="txtMotherName" placeholder="Enter Mother's Name" maxlength="80"  onkeyup="changeCase(this)"  value="<?=strtoupper($MothersName)?>" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>

											</div>
											<div  class="row"  style="margin-top: 20px;">
											 	<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="">&nbsp;&nbsp;<i class="fa fa-credit-card" aria-hidden="true" style="color:#E4791A"></i> Guardian Name/अभिभावक का नाम</label>
														<div class="col-lg-7">
															<input type="text" class="form-control test" id="MothersProfession" name="MothersProfession" placeholder="Enter Guardian Name" maxlength="80"  onkeyup="changeCase(this)" data-placement="top" data-toggle="tooltip" value="<?=$MothersProfession?>" title="" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>

											</div>
										</div>

										<!--**************END OF FATHERS DETAILS*********-->

										<!--**************START OF MOTHERS DETAILS*********-->

										<!--<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;margin-top: 20px;">
											<h3 style="text-align: center;margin-top: -6px;color: #666;"> Mother Details</h3>
											<div  class="row"  style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style=""><i style="color:red;font-size:18px;">*</i> <i class="fa fa-male" aria-hidden="true" style="color:#E4791A"></i> Mother's Name</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" id="txtMotherName" name="txtMotherName" placeholder="Enter Mother's Name" maxlength="80"  onkeyup="changeCase(this)"  value="<?=strtoupper($MothersName)?>" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>

												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="">&nbsp;&nbsp;<i class="fa fa-credit-card" aria-hidden="true" style="color:#E4791A"></i> Guardian Name</label>
														<div class="col-lg-7">
															<input type="text" class="form-control test" id="MothersProfession" name="MothersProfession" placeholder="Enter Guardian Name" maxlength="80"  onkeyup="changeCase(this)" data-placement="top" data-toggle="tooltip" value="<?=$MothersProfession?>" title="" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>

													

												</div>

											</div>
											<!--<div  class="row"  style="margin-top: 20px;">												

														<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style=""><i style="color:red;font-size:18px;">*</i> <i class="fa fa-male" aria-hidden="true" style="color:#E4791A"></i> Guardian Name</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" id="MothersIncome" name="MothersIncome" onkeyup="changeCase(this)"  value="<?=strtoupper($MothersIncome)?>" <?php echo $show==1?'disabled':''; ?> >
														</div>
													</div>
												</div>

												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="m">&nbsp;&nbsp;<i class="fa fa-credit-card" aria-hidden="true" style="color:#E4791A"></i> Mother's Aadhaar No</label>
														<div class="col-lg-7">
															<input type="text" class="form-control test" id="txtUid" name="txtUidM" placeholder="Enter Aadhaar No" maxlength="12" onkeypress="return isNumberKey(event)"   value="<?=$MothersAdhar?>" data-placement="top" data-toggle="tooltip" title="Aadhaar No must be a digit. Ex:123456789012" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>
											</div>
										</div>-->

										<!--**************END OF MOTHERS DETAILS*********-->



										<!--***********START OF PRESENT ADDRESS SECTION************-->

										<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;    margin-top: 35px;">
											<h3 style="text-align: center;margin-top: -6px;color: #666;"> Present Address / वर्तमान पता </h3>

											<!--********PLOT AND LOCALITY***********-->
											<!--<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> C/O</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="co_name" id="co_name" value="<?=$co_name?>"  onkeyup="changeCase(this)" maxlength="80"  <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>
											</div>-->
											<!--************ROW END***************-->

											<!--********PLOT AND LOCALITY***********-->
											<div class="row"  style="margin-top: 20px;">

												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> H/No/Locality/Street Name/Village / एच / नहीं / लोकैलिटी / स्ट्रीट नाम / गांव</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="txtPresentLocality" id="txtPresentLocality" onkeyup="changeCase(this)" maxlength="80" value="<?=$txtPresentAddress?>" <?php echo $show==1?'disabled':''; ?>>
														</div>

													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="    padding-right: 35px;">&nbsp;&nbsp; Post/पद</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="txtPresentPost" id="txtPresentPost"  onkeyup="changeCase(this)" maxlength="80" value="<?=$txtPresentPost?>" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>

											</div>
											<!--************ROW END***************-->

											<!--********PLOT AND LOCALITY***********-->
											<div class="row"  style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="    padding-right: 35px;"> <i style="color:red;font-size:18px;">*</i>City/शहर</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="city_name" value="<?=$city_name?>" onkeyup="changeCase(this)" maxlength="80" id="city_name" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>


												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> State/राज्य</label>
														<div class="col-lg-7">
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
													</div>
												</div>
												
											</div>
											<!--************ROW END***************-->

											<!--********STATE AND DITRICT***********-->
											<div class="row"  style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="    padding-right: 35px;"><i style="color:red;font-size:18px;">*</i> District/जिला</label>
														<div class="col-lg-7">
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
													</div>
												</div>

												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" >&nbsp;&nbsp; PIN/पिन</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="txtPresentPin" id="txtPresentPin" onkeypress="return isNumberKey(event)" maxlength="6" value="<?=$txtPresentPin?>" data-placement="top" data-toggle="tooltip" title="Pin must be 6digit Ex:123456" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>

											</div>
											<!--************ROW END***************-->
 

											<!--********POST AND PIN CODE***********-->
											 <!-- <div class="row" style="margin-top: 20px;">

												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> Phone No</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="phone_no" id="phone_no" onkeypress="return isNumberKey(event)" maxlength="10" value="<?=$mobile?>"  <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>
												



											</div>  -->
											<!--************ROW END***************-->

										</div>	
										<!--</div>-->	
										<!--</div>	-->
										<!--***********END OF PERMANENT ADDRESS SECTION************-->

										<!--***********START OF PRESENT ADDRESS SECTION************-->

										<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;    margin-top: 35px;">
											<h3 style="text-align: center;margin-top: -6px;color: #666;"> Permanent  Address / स्थाई पता</h3>
											<div class="row">
												<div class="form-group">
													<div class="col-sm-8">
														<input type="checkbox" id="chksameasresidential" name="chksameasresidential" value="Y" onclick="setSameAddress();" <?php if($chksameasresidential=="Y") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> 
											Permanent Address Is Same As Present Address /स्थायी पता वर्तमान पते के समान है
													</div>
												</div>
											</div>


											<!--<div class="row">
												 
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> C/O</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="co_name1" id="co_name1" onkeyup="changeCase(this)" maxlength="80" value="<?=$co_name1?>" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>
											</div>-->

											<div class="row"  style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> H/No/Locality/Street Name/Village / एच / नहीं / लोकैलिटी / स्ट्रीट नाम / गांव</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="txtPermenentLocality" id="txtPermenentLocality" onkeyup="changeCase(this)" maxlength="80" value="<?=$txtPermenentAddress?>" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>
												 
													<div class="col-lg-6">
														<div class="form-group">
															<label for="" class="col-lg-5" style="    padding-right: 35px;">&nbsp;&nbsp; Post/पद</label>
															<div class="col-lg-7">
																<input type="hidden" name="hidPermanentPost" id="hidPermanentPost" value="<?=$txtPermanentPost?>" />
																<input type="text" class="form-control" name="txtPermanentPost" id="txtPermanentPost" onkeyup="changeCase(this)" maxlength="80" value="<?=$txtPermanentPost?>" >
															</div>
														</div>
													</div>

												</div>
											


											<div class="row" style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="    padding-right: 35px;"><i style="color:red;font-size:18px;">*</i> City/शहर</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="city_name1" id="city_name1" value="<?=$city_name1?>" onkeyup="changeCase(this)" maxlength="80" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>
												 

												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> State/राज्य</label>
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
														<label for="" class="col-lg-5" style="    padding-right: 35px;"><i style="color:red;font-size:18px;">*</i> District/जिला</label>
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
													<label for="" class="col-lg-5" > &nbsp;&nbsp; PIN/पिन</label>
													<div class="col-lg-7">
														<input type="hidden"  name="hidPermanentPin" id="hidPermanentPin" value="<?=$txtPermanentPin?>" />
														<input type="text" class="form-control" name="txtPermanentPin" id="txtPermanentPin" value="<?=$txtPermanentPin?>" onkeypress="return isNumberKey(event)" maxlength="6" data-placement="top" data-toggle="tooltip" title="Pin must be 6digit Ex:123456">
													</div>
												</div>


											</div>
										</div>

											<!-- <div class="row" style="margin-top: 20px;">

												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> Phone No</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="phone_no1" id="phone_no1" onkeypress="return isNumberKey(event)" maxlength="10" value="<?=$txtPermanentMobile?>"  <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>
											</div> -->

										</div>

									<!--***********START OF ACADEMIC INFORMATION SECTION************-->

										<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;    margin-top: 35px;">
										 	<div class="col-sm-12 form-group">
										        <div class="col-sm-7">
													<label for="" >Whether Employed : (Please Tick In The Appropriate Box)</label>
												</div>
												<div class="col-sm-5">
													
													<label class="radio-inline">
														<input type="radio" name="employed" id="employed" value="NO" <?php if($is_employed=="NO") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?> onclick="hide('employer_id');"> NO
													</label>
													<label class="radio-inline">
														<input type="radio" name="employed" id="employed" value="YES" <?php if($is_employed=="YES") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?> onclick="show('employer_id');"> YES
													</label>

												</div>
											</div>
	 									</div>
 										<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;margin-top: 20px;">
											<div  class="row"  style="margin-top: 20px;">
												<div class="col-lg-12">
													<div class="form-group" >
														<label for="" class="col-lg-7"  ><i style="color:red;font-size:18px;">*</i> <i class="fa fa-graduation-cap" aria-hidden="true" style="color:#E4791A;"></i><?php if($course_code == 'DPMD'){echo "Diploma"; } else {echo "Graduation"; } ?> </label>
														<div class="col-lg-5">
															<label class="radio-inline">
																<input type="radio" name="radioMarkSheet" id="radioYesMarks" value="Yes" <?php if($radioMarkSheet=="Yes") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Passed
															</label>
															<label class="radio-inline">
																<input type="radio" name="radioMarkSheet" id="radioNoMarks" value="No" <?php if($radioMarkSheet=="No") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Appeared
															</label>

														</div>
													</div>
												</div>
											</div>
											<div id="radioNoGradCert"  class="row"  style="margin-top: 20px;">
												<div class="col-lg-12">
													<div class="form-group" >
														<label for="" class="col-lg-7"  ><i style="color:red;font-size:18px;">*</i> <i class="fa fa-certificate" aria-hidden="true" style="color:#E4791A;"></i> Whether <?php if($course_code == 'DPMD'){echo "Diploma"; } else {echo "Graduation"; } ?> Certificate Arrived?/क्या <?php if($course_code == 'DPMD'){echo "Diploma"; } else {echo "Graduation"; } ?> प्रमाणपत्र पहुंचे?</label>
														<div class="col-lg-5">
															<label class="radio-inline">
																<input type="radio" name="radioGradCert" id="radioYesGradCert" value="Yes" <?php if($radioGradCert=="Yes") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Yes
															</label>
															<label class="radio-inline">
																<input type="radio" name="radioGradCert" id="radioNoGradCert" value="No" <?php if($radioGradCert=="No") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> No
															</label>

														</div>
													</div>
												</div>
											</div>
											<div  id="radioGradMarkSheet" class="row"  style="margin-top: 20px;">
												<div class="col-lg-12">
													<div class="form-group" >
														<label for="" class="col-lg-7"  ><i style="color:red;font-size:18px;">*</i> <i class="fa fa-certificate" aria-hidden="true" style="color:#E4791A;"></i> Whether <?php if($course_code == 'DPMD'){echo "Diploma"; } else {echo "Graduation"; } ?> Mark Sheet Arrived? / क्या <?php if($course_code == 'DPMD'){echo "Diploma"; } else {echo "Graduation"; } ?>  मार्क शीट पहुंची?</label>
														<div class="col-lg-5">
															<label class="radio-inline">
																<input type="radio" name="radioGradMarkSheet" id="radioYesGradMarkSheet" value="Yes" <?php if($radioGradMarkSheet=="Yes") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Yes
															</label>
															<label class="radio-inline">
																<input type="radio" name="radioGradMarkSheet" id="radioNoGradMarkSheet" value="No" <?php if($radioGradMarkSheet=="No") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> No
															</label>

														</div>
													</div>
												</div>
											</div>

											
										</div>


									<!--***********START OF ACADEMIC INFORMATION SECTION************-->

									<div class="col-lg-12" id="divAcademicInfo" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;    margin-top: 35px;">
										<h3 style="text-align: center;margin-top: -6px;color: #666;"> Academic Information / शैक्षणिक सूचना</h3>
										<div class="row">
											

												<div class="col-sm-12">
													<h4><b><i class="glyphicon glyphicon-asterisk" style="color:red;font-size:10px;"></i> Educational Qualification / शैक्षिक योग्यता</b></h4>
												</div>
												<div class="col-sm-12">
													<div class="table-responsive">
														<table  class="table table-bordered table-striped">
															<tr>
																<th style="text-align:center;">Name Of The Examination / परीक्षा का नाम</th>
																<th style="text-align:center;">Year Of Passing/Appearing / उत्तीर्ण होने का वर्ष /प्रदर्शित होने</th>
																<th style="text-align:center;">Board/University / बोर्ड / विश्वविद्यालय</th>
																<th style="text-align:center;">Marks Secured / CGPA / सुरक्षित सुरक्षित</th>
																<th style="text-align:center;">Maximum Marks / CGPA अधिकतम अंक</th>
																<th style="text-align:center;">% Of Marks / अंक का%</th>
															</tr>
															<?php
																$sl_no =1;
																//print_r($allQualifications); 
																//echo $txtQualification1;
																foreach($allQualifications as $row)
																{
																	$division = $row['division'];
																	$all_division = explode(',',$division);
																	$graduation_code=$row['qualification_code'];
																	$graduation_quali=$row['qualification_name'];
																?>
																<tr id="<?php echo $row['qualification_code']; ?>">
																	<?php if($row['qualification_name'] == 'Graduation'){ ?>
																	<td><div class="form-group">
																		<select class="form-control input-sm" name="txtQualification<?=$sl_no?>" id="txtQualification<?=$sl_no?>">
																			<?php
																				
																				foreach($select_graduation_course_temp as $row1)
																				{
																					echo "<option value='".$row1['graduation_code']."' ".$x.">".$row1['graduation_name']."</option>";
																				}
																			?>	
																		</select>
																	</div></td>
																	<?php } 
																	else {   ?>
																	
																		<td><input type="text" class="form-control input-sm" name="txtQualification<?=$sl_no?>" id="txtQualification<?=$sl_no?>" value="<?=$row['qualification_name']?>"  readonly="readonly"/></td>
																	<?php } ?>
																	<input type="hidden" id="selecting_value" value="$graduation_code" />
																	<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtYear<?=$sl_no?>" name="txtYear<?=$sl_no?>" onkeypress="return isNumberKey(event)" maxlength="4"   value="<?php echo ${'txtYear'.$sl_no} == 'NULL'?'':${'txtYear'.$sl_no}; ?>" <?php echo $show==1?'disabled':''; ?> /></div></td>
																	<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtBoard<?=$sl_no?>" name="txtBoard<?=$sl_no?>" value="<?=${'txtBoard'.$sl_no}?>" <?php echo $show==1?'disabled':''; ?> onkeyup="changeCase(this)" maxlength="50"/></div></td>
																	
																	
																	<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtMS<?=$sl_no?>" name="txtMS<?=$sl_no?>" value="<?php echo ${'txtMS'.$sl_no} == 'NULL'?'':${'txtMS'.$sl_no}; ?>" onkeypress="return isNumberKey(event)" onblur="calculatePercentage(<?=$sl_no?>)"  <?php echo $show==1?'disabled':''; ?>/></div></td>
																	<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtFM<?=$sl_no?>" name="txtFM<?=$sl_no?>" value="<?php echo ${'txtFM'.$sl_no} == 'NULL'?'':${'txtFM'.$sl_no}; ?>" onkeypress="return isNumberKey(event)" onblur="calculatePercentage(<?=$sl_no?>)"  <?php echo $show==1?'disabled':''; ?>/></div></td>
																	<td><div class="form-group"><input type="text" class="form-control input-sm" readonly id="txtPercent<?=$sl_no?>" name="txtPercent<?=$sl_no?>" value="<?php echo ${'txtPercent'.$sl_no} == 'NULL'?'':${'txtPercent'.$sl_no}; ?>" /></div></td>
																</tr>
																	<?php
																	$sl_no++;
																	}
																	?>
			
																<!--<tr>
																	<td><input type="text" class="form-control input-sm" placeholder="Any Other" name="txtQualification5" id="txtQualification5" value="<?=$txtQualification5?>"  /></td>
																	<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtYear5" name="txtYear5" onkeypress="return isNumberKey(event)"   value="<?php echo $txtYear5 == 'NULL'?'':$txtYear5; ?>" <?php echo $show==1?'disabled':''; ?> /></div></td>
																	<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtBoard5" name="txtBoard5" value="<?=$txtBoard5 ?>" <?php echo $show==1?'disabled':''; ?> onkeydown="changeCase(this)" onkeyup="changeCase(this)" onblur="changeCase(this)" onclick="changeCase(this)"/></div></td>
																	
																			
																<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtMS5" name="txtMS5" value="<?php echo $txtMS5 == 'NULL'?'':$txtMS5; ?>" onkeypress="return isNumberKey(event)" onblur="calculatePercentage(5)" <?php echo $show==1?'disabled':''; ?>/></div></td>
																<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtFM5" name="txtFM5" value="<?php echo $txtFM5 == 'NULL'?'':$txtFM5; ?>" onkeypress="return isNumberKey(event)" onblur="calculatePercentage(5)" <?php echo $show==1?'disabled':''; ?>/></div></td>
																<td><div class="form-group"><input type="text" readonly class="form-control input-sm" id="txtPercent5" name="txtPercent5" value="<?php echo $txtPercent5 == 'NULL'?'':$txtPercent5 ;?>" onfocus="calculatePercentage(5)" <?php echo $show==1?'disabled':''; ?>/></div></td>
																
															</tr>-->
														</table>
													</div>
												</div>


										

										</div>
										<!--<div class="row" >

											<div class="col-md-12">
												<div class="form-group col-md-9 ">
													<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> Graduation Final year Percentage(%)</label>
													<div class="col-lg-7">
														<input type="text" class="form-control " name="txtfinalpercentage" maxlength="5" max="101" value="<?=$txtfinalpercentage?>" id="txtfinalpercentage"  <?php echo $show==1?'disabled':''; ?> >
													</div>
												</div>
											</div>
										</div>-->

										<!--<div class="row" >

											<div class="col-md-12">
												<div class="form-group col-md-9 ">
													<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> Date Of Completion Of Internship</label>
													<div class="col-lg-7">
														<input type="text" class="form-control datepicker" name="completion_date" value="<?=$completion_date?>" id="completion_date"  <?php echo $show==1?'disabled':''; ?> readonly>
													</div>
												</div>
											</div>
										</div>-->


                     <!-- <div class="row" style="margin-top: 20px;">
										<div class="col-sm-12">
											<div class="col-sm-12">
												<label for="" >Details Of Payments :</label>
											</div>

											<div class="col-sm-3">
												<label>Amount Rs.</label>
												<input type="text" class="form-control" name="amount_paid" id="amount_paid" value="<?=$amount_paid?>"  <?php echo $show==1?'disabled':''; ?>>
											</div>

											<div class="col-sm-3">
												<label>Bank Draft No..</label>
												<input type="Number" class="form-control" name="draft_no" id="draft_no" value="<?=$draft_no?>"  <?php echo $show==1?'disabled':''; ?>>
											</div>

											<div class="col-sm-3">
												<label>Dated</label>
												<input type="date" class="form-control" name="payment_date" id="payment_date" value="<?=$payment_date?>"  <?php echo $show==1?'disabled':''; ?>>
											</div>

											<div class="col-sm-3">
												<label>Name Of the Bank</label>
												<input type="text" class="form-control" name="bank_name" id="bank_name" value="<?=$bank_name?>"  <?php echo $show==1?'disabled':''; ?>>
											</div>
										</div>

                                      </div>
 -->

									</div>
									
								
								<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;    margin-top: 35px;">
								 	<div class="col-sm-12 form-group">
								        <div class="col-sm-7">
											<label for="" ><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp; How Would You Pay The Application Fee? / आप आवेदन शुल्क का भुगतान कैसे करेंगे?</label>
										</div>
										    
										<div class="col-sm-5">
											
											<label class="radio-inline">
												<input type="radio" name="mode" id="modeOnline" value="Online" <?php if($mode=="Online") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?> > Online
											</label>
											<label class="radio-inline">
												<input type="radio" name="mode" id="modeOffline" value="Offline" <?php if($mode=="Offline") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?> > Offline (Challan)
											</label>

										</div>
									</div>
									<div id="offlineMode"  class="row"  style="margin-top: 20px;">
										<div class="col-lg-12">
											<div class="form-group" >
												<p>
													<b> Please note: </b><br />

														Step 1. Deposit the fee( as per your category) in the below A/c in a challan in the bank, <br />

														Step 2. Scan the challan receipt and upload it in the document upload section, <br />

														Step 3. Enter the challan number, bank name, branch name and challan date in the fields provided in the payment section.<br />

														<b>Bank Name : </b>  STATE BANK OF INDIA <br />
														<b>Branch Name :</b>  CHENNAI, COMMERCIAL BRANCH GUINDY (04327), CHENNAI.<br />
														<b>Name of Payee  :</b> CIPET TRAINING <br />
														<b>A/c No.</b>33003659524<br />
														<b>IFSC Code  :</b>  SBIN0004327<br />
														
														<b>IMP to note:</b> Offline payment verification and confirmation will take at least 3 working days! <br />
														
														

												</p>
												
											</div>
										</div>
									</div>
									<div  id="onlineMode" class="row"  style="margin-top: 20px;">
										<div class="col-lg-12">
											<div class="form-group" >
												<p>You can use Debit Card, Credit Card and Net banking./आप डेबिट कार्ड, क्रेडिट कार्ड और नेट बैंकिंग का उपयोग कर सकते हैं।</p>
											</div>
										</div>
									</div>
								</div>
									
								
								<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;    margin-top: 35px;">
									<h3 style="text-align: center;margin-top: -6px;color: #666;"> Declaration / घोषणा</h3>
									<div class="row">
										<div class="form-group">
											<div class="col-sm-12" align="justify">
												<input type="checkbox" name="chkUndertaking1" id="chkUndertaking1" value="1"  >
												I declare that all the particulars stated in this application are true to the best of my knowledge and belief. In
												the event of suppression or distortion of any fact made in the above application form, I understand that I will
												be denied the opportunity to appear the ENTRANCE TEST/ADMISSION. I also understand that the decision of the authorities regarding the admission will be final. If
												admitted, it is assured that I will follow the rules and regulations of the Institute and University and if I am
												found guilty of any misconduct I shall be liable for punishment as deemed fit by the Institute authority.<br \>
												मैं घोषणा करता हूं कि इस एप्लिकेशन में बताए गए सभी विवरण मेरे ज्ञान और विश्वास के सर्वोत्तम हैं। उपर्युक्त आवेदन पत्र में किए गए किसी भी तथ्य के दमन या विरूपण की स्थिति में, मैं समझता हूं कि मुझे प्रवेश परीक्षा / प्रवेश प्रकट करने का अवसर अस्वीकार कर दिया जाएगा। मैं यह भी समझता हूं कि प्रवेश के संबंध में अधिकारियों का निर्णय अंतिम होगा। अगर भर्ती कराया जाता है, तो यह आश्वासन दिया जाता है कि मैं संस्थान और विश्वविद्यालय के नियमों और विनियमों का पालन करूंगा और यदि मुझे किसी भी दुर्व्यवहार का दोषी पाया गया है तो मैं संस्थान प्राधिकरण द्वारा समझा जाने वाला दंड के लिए उत्तरदायी होगा।
											</div>
										</div>
									</div>

								</div>	

								
											<?php if($show != 1) { ?>
											<div class="form-group" >
												<div class="col-lg-12">
													<button type="submit" class="btn btn-primary btn-block" id="btnPersonalInfo" name="btnPersonalInfo"  onclick="return validate();"   style="margin-top: 20px;font-size:16px;"><span class="glyphicon glyphicon-send" style="font-size:18px;"></span> Save & Next</button>
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
						<script src="<?php echo base_url(); ?>public/assets/js/template008.js?v=<?php rand()?>"></script>
						<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.js"></script>

						<!--  <link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet"> -->
						<script type="text/javascript">
							var birthyear = "<?=$y?>";
							var todayyear = (new Date()).getFullYear();
							function show(x) { 
								document.getElementById(x).style.display = 'block';
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
								document.getElementById(x).style.display = 'none';
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
/*.login-box-body, .register-box-body {
	    padding-right: 41px;
	    padding-top: 22px;
	}
	.box button:hover{
	    background: none repeat scroll 0% 0% #CFD8DC;
		color: #009688;
	}
	.box button{
	    background: #009688;
	  	color: #FFF;
	  	}*/
	  	.login-box-body, .register-box-body {

	  	}

	  </style>
	  <script>
	  var selecting_value = "<?=$graduation_quali?>";
	  	
	  </script>