<?php
$institute_code_original = '';
$mode = $this->session->userdata('mode');
$noamount=0;
$edit = "false";
$applshow=0;
$show=0;
$print=0;
$noamount=0;
$showChallanInfo=0;
$edit="false";
$editappl="false";
$Referencno = '';
$challanbank_name = '';
$challan_path = '';


$data = $this->uri->uri_to_assoc();
$edit_status = isset($data['edit'])?$data['edit']:'';

$reg_user_id = $this->session->userdata('reg_user_id');
$application_no = $this->session->userdata('appl_no');
foreach($appl_status as $row)
{
	//echo "<pre>"; print_r($appl_status);die;
	$edit_appl_status = $row['edit_status'];
	$appl_status = $row['appl_status'];
	$appl_no = $row['appl_no'];
}
//$is_north_east1 = $is_north_east[0]['is_north_east'];	

foreach($institute_data as $row)
{
	$institute_code_original = $row['institute_code'];
	$institute_name = $row['institute_name'];
	$ins = encrypt_decrypt('encrypt',$institute_code_original);
}

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
}
/*foreach($document_data as $row)
{
	// echo "<pre>";
	//echo "<pre>"; print_r($document_data);die;
	$documentsReq[] = $row;	
	$documentsDesc[] = $row['document_type'];
	$documentsCode[] = $row['document_type_code'];
}*/
foreach($challandetails as $row1){
	//echo "<pre>"; print_r($challandetails);die; 
	$Referencno = $row1['challan_code'];
	$challanbank_name = $row1['bank_name'];
	$challan_path = $row1['challan_path'];
}

/*echo $file_name;
die();*/
$reg_mode = 'ONLINE';
foreach($regdata as $row)
{
	$reg_mode = $row['reg_mode'];
	$Email = $row['email_id'];
}
$count = 1;
$tmp_name = $file_name."_pdf";
//echo $file_name ; die();
//print_r($paymodedata);die();
foreach($paymodedata as $row)
{
	
	//$active_tab = $row['description'];
	//$payment_mode= $row['payment_mode'];
	if($count == 1)
		$active_tab = $row['description'];
	$payment_mode_detail[] = $row['description'];
	$count++;
	
}
/*echo $active_tab;
die();*/
foreach($tempcodedata as $row)
{
	$temp_code = $row['template_code'];
}
foreach($depositmode as $row1)
{
	$deposit_mode = $row1['money_deposit_mode'];
	$depositdate = $row1['depositdate'];
	$money_receipt_no = $row1['money_receipt_no'];
}
foreach($categorydt as $row)
{
	$category = $row['category'];
	$pass_status = $row['last_grade'];
}

if($appl_status == 'Fee Paid' || $appl_status == 'Verified')
{
	
	if($mode=="edit")
	{
		$applshow=1;
	}
	
	
}
$amount = 0;	
$extra_fee = 0;	
foreach($extra_amount_arr as $row)
{
	$extra_fee = $row['extra_fee'];
}
foreach($amount_arr as $row_amt )
{
	$amount = $row_amt['amount'];
}
if($edit_status != '')
{
	if($extra_fee != 0)
	{
		$amount = $extra_fee;
	}
}
	//echo $amount ; die();
	if($amount == 0)
	{
		$noamount=1;
	}
	else
	{
		$noamount=0;
	}
$bank_name = '';
$account_no = '';
$txtBankBranch = '';
$txtBankName = '';
$txtBankCode = '';
foreach($bankdata as $row)
{
	$bank_name=$row['bank_name'];
	$account_no=$row['account_no'];
}
foreach($passstatus as $row3)
{
	$category = $row3['category'];
	$pass_status = $row3['last_grade'];
}

$txtChallanNo = '';
$txtChallanDate = '';
foreach($challanData as $row3)
{
	$txtBankBranch = $row3['bank_branch'];
	$txtBankName = $row3['bank_code'];
	$txtChallanNo = $row3['challan_number'];
	$txtChallanDate = $row3['depositdate'];
}
/*$radioPayment = $_POST['hidPaymentMode'];
$txtChallanNo = trim($_POST['txtChallanNo']);
$txtChallanDate = $_POST['txtChallanDate'];
$txtSbiRefNo = $_POST['txtSbiRefNo'];
$txtCollectDate = $_POST['txtCollectDate'];
if($radioPayment == "ONLINE")
{
//show in .php
	//header("location: onlinepaymentinstruction.php?ins=$hex_ins_code&_s=$MY_SESSION_NAME"); 	

}*/

//echo $appl_status ; die();

///********************************************** For Template modal **********************************************************///
$now = date('Y-m-d h:i:s', now());
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
if($dob1 != ''){
	
$d = $dob1[2];
$m = $dob1[1];
$y = $dob1[0];
}
$txtDobDateFormat = $d.'-'.$m.'-'.$y;
//*********************************************************** completed *******************************************/
?>
<script type="text/javascript">
function isAlphaKey(evt)
{
    var keyCode = (evt.which) ? evt.which : evt.keyCode
    if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
     
    return false;
        return true;
}
function isAlphaNumKey(evt)
{
  var charCode = (evt.which) ? evt.which : evt.keyCode;
 // alert(charCode);
  if (charCode != 8 && charCode != 37 && charCode != 39 && (charCode < 48 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 123) && charCode != 32)
     return false;

  return true;
}
function isAlphaNumKeyfdsfds(evt)
{
	var key = (evt.which) ? evt.which : evt.keyCode;
    if (key >= 48 && key <= 57) {
        return false;
    }
     return true;
}
function preview(temp_code){
	var institutedata=
	{
		temp_code:temp_code
	};	
	var template_case = 'preview_'+temp_code;
	$.ajax({
		url:base_url+"/ajax_controller/"+template_case,
		type:"post",
		data : institutedata,
		success:function(response){  
			var res = JSON.parse(response);
			$('#exampleModal').modal('show');
			$("#tempPreview").html(res.html);
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
}
function preview_online(temp_code){
	var institutedata=
	{
		temp_code:temp_code
	};	
	var template_case = 'preview_'+temp_code;
	$.ajax({
		url:base_url+"/ajax_controller/"+template_case,
		type:"post",
		data : institutedata,
		success:function(response){  
			var res = JSON.parse(response);
			$('#exampleModalOnline').modal('show');
			$("#tempPreviewOnline").html(res.html);
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
}
function edit_template(temp_code){
	//window.location.href = ("<?php echo base_url() ?>apply/institute_page/ins/<?=$ins?>");
	var institutedata=
	{
		appl_no:"<?=$appl_no?>"
	};	
	$.ajax({
		url:base_url+"/ajax_controller/edit_status_apply4",
		type:"post",
		data : institutedata,
		success:function(response){  
			var res = JSON.parse(response);
			window.location.href = base_url+ "/apply/"+temp_code+"/ins/<?=$ins?>";
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
}

function proceed_template(){
	//window.location.href = ("<?php echo base_url() ?>apply/institute_page/ins/<?=$ins?>");
	var institutedata=
	{
		appl_no:"<?=$appl_no?>"
	};	
	$.ajax({
		url:base_url+"/ajax_controller/edit_status_apply4",

		// alert(url);return false;
		type:"post",
		data : institutedata,
		success:function(response){  
			var res = JSON.parse(response);
			window.location.href = base_url+ "/apply/apply_4/ins/<?=$ins?>";
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
}
/*function Banksubmit(){
	//alert(1);
	var Referenceno = $("#txtReferenceno").val();
	var BankName = $("#txtBankName").val();
	var UploadReceipt = $("#txtReceipt").val();
	//var formData = new FormData(document.getElementById("BankSubmitForm"));
	var institutedata=
	{
		Referenceno : Referenceno,
		BankName : BankName,
		UploadReceipt : UploadReceipt
	};	
	$.ajax({
		url:base_url+"/ajax_controller/Bank_challan_submit",

		// alert(url);return false;
		type:"post",
		data : institutedata,
		success:function(response){  
			var res = JSON.parse(response);
			alert(res);
			//window.location.href = base_url+ "/apply/apply_4/ins/<?=$ins?>";
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	
}*/

//$("form[name='BankSubmitForm']").on("submit", function(ev) {
/*$("#btnBanksubmit").click(function(){
  //ev.preventDefault(); // Prevent browser default submit.
alert(123);
  var formData = new FormData(this);
  	$.ajax({
		url:base_url+"/ajax_controller/Bank_challan_submit",

		// alert(url);return false;
		type:"post",
		data : formData, 
		success:function(response){  
			var res = JSON.parse(response);
			alert(res);
			//window.location.href = base_url+ "/apply/apply_4/ins/<?=$ins?>";
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
 });*/
/*$('#BankSubmitForm').bootstrapValidator({
	excluded:[':disabled',':hidden'],
	message: 'This value is not valid',
    feedbackIcons: 
    {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
	submitButtons: 'button[type="submit"]',
	submitHandler: function(validator, form, submitButton) 
	{
		
		var formData = new FormData(document.getElementById("BankSubmitForm"));
		//console.log(formData);return;
		//ajax call to server
		$.ajax({
			url:base_url+"ajax_controller/Bank_challan_submit",
			type:"post",
			data:formData,
			cache: false,
	        contentType: false,
	        processData: false,
			success:function(response)
			{  
				
					var obj = jQuery.parseJSON(response);
					alert(obj);
				
			},
			error:function()
			{
				toastr.error('Unable to Save.Please Try Again ');	
			}
		});
	},
	
});*/

function validate(){
	var errorMessage = "";
	var message = '<div>';
	
	if(document.getElementById("hidChallan").value == "challan")
	{
		if(document.getElementById("txtChallanNo").value == "")
		{
			errorMessage += "Please Enter Challan No.<br/>";
		}
		if(document.getElementById("txtdate").value == "")
		{
			errorMessage += "Please enter Challan Date.<br/>";
		}
		
		if(document.getElementById("txtBankName").value == "")
		{
			errorMessage += "Please Enter Bank Name.<br/>";
		}
		if(document.getElementById("txtBankBranch").value == "")
		{
			errorMessage += "Please enter Branch Name.<br/>";
		}
	}
	
	if(errorMessage != "")
	{
		message += errorMessage + "</div>";
		//alertmessage.innerHTML = message;
		document.getElementById("alertmessage").innerHTML=message;
		$('.alert').show();
		return false;	 
	}
	else
	{
		swal({
		  title: "Are you sure?",
		  text: "You Want to Proceed for Application Submission",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes",
		  cancelButtonText: "No",
		  closeOnConfirm: false,
		  closeOnCancel: true
		},
		function(isConfirm){
		  if (isConfirm) {
		  	$.ajax({
				url:base_url+"/ajax_controller/submit_application",

				// alert(url);return false;
				type:"post",
				//data : data,
				cache: false,
		        contentType: false,
		        processData: false, 
				success:function(response){  
					var obj = jQuery.parseJSON(response);
					//console.log(obj); 
					if(obj.status == true)
					{
						toastr.success(obj.msg);
						window.location.href = base_url+ "/apply//institute_page/ins/<?=$ins?>";
						//window.location.reload();
						//window.location.href = base_url+ "/apply/apply_4/ins/<?=$ins?>";
					}
					else{
						toastr.error(obj.msg);
					}
					//alert(res);
					//window.location.href = base_url+ "/apply/apply_4/ins/<?=$ins?>";
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		  } else {
			    //swal("Document", "News is safe ", "success");
		  }
		});
		return true;
	}	
}
</script>
<style>
	.btn-warning:hover{
			color: #fff;
			background-color: #2897b9;
		    border-color: #2897b9;
		 
		}
		.btn-warning:focus,
		.btn-warning:active,
		.btn-warning.active,
		.btn-warning {
		  	color: #fff;
		    background-color: #20505f;
		    border-color: #20505f;
		}
		.btn-warning[disabled]{
		  	color: #fff;
		    background-color: #20505f;
		    border-color: #20505f;
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
	.btn.btn-sm {
	    padding: .5rem 1.6rem;
	    cursor: pointer;
	}
	.panel-primary > .panel-heading {
	    color: #fff;
	    background: linear-gradient(to left, #36a3c5 30%, #2ea1c4 100%);
	}
	.panel-primary {
	   border-color: #32a2c4;
	}
	
	fieldset {
		    min-width: 0;
		    padding: 15px;
		    margin: 0;
		    border: 1px solid black;
		    border-color:#20505f85;
			margin-top: 10px;
		}
		legend {
		    width: auto;
		    border-bottom: 0px;
		    color: #fff;
		    background: linear-gradient(to left, #35a3c5 30%, #258bab 100%);
		    border-radius: 6px;
		    text-align: center;
		    padding: 5px;
		}

	
	
	.panel-primary a {
	    color: #fff;
	}
	@media screen and (max-width: 1165px){
		.top-pad{
			padding-top: 55px;
		}
	}
	</style>
<!--<link href="<?=base_url()?>public/assets/css/extra-style.css" rel="stylesheet">-->
<!--<link href="<?=base_url()?>public/assets/css/datepicker3.css" rel="stylesheet" />-->
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.css" />-->
<link href="<?php echo base_url(); ?>public/template_lib/plugins/jquery.datepick/css/jquery.datepick.css" rel="stylesheet" />
<div class="container-fluid" style=" padding-bottom: 50px;">

	<div class="row" style="" >
		<div class="hidden-sm col-md-1 col-lg-1 hidden-xs" style="margin-top: 200px;margin-left: -15px;z-index: 1000;">
			<?php include('sidebar/sidebar.php'); ?>
		</div>

	<div class="container col-xl-11 col-lg-11 col-md-11 col-sm-12 col-xs-12" style="margin-top: 120px; padding-bottom: 93px;">
		 <input type="hidden" name="hidPageCode" id="hidPageCode" value="PAYMENT"/>
		<div class="row">
		<?php 
		$ins = encrypt_decrypt('encrypt',$institute_code);
		
		if($appl_status == 'Fee Paid' || $appl_status == 'Verified' || $appl_status == 'Payment Updated' || $appl_status == 'Application Submitted')
		{
			$edit="true";
		}
		if($appl_status == 'Document Uploaded' || $appl_status == 'Challan Generated' || $appl_status == 'Fee Paid' || $appl_status == 'Verified' || $appl_status == 'Payment Updated' || $appl_status == 'Application Submitted' )
		   {
		   	$sl_no = 1;
		   ?>
		    <div class="hidden-xs col-sm-1 col-md-1 col-lg-1 col-xl-1">	</div>
				<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-xl-10">	
				
				
						
				
					
				<?php if($edit=="true") { 
						if($appl_status == 'Document Uploaded' || $appl_status == 'Challan Generated' ) 
							{ ?>
							<button type="button" onclick="window.location.href = '<?=base_url()?>apply/<?=$file_name?>/ins/<?=$ins?>/edit/<?=$edit_status?>';"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
								<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
									Profile Details <span class="badge"> &raquo;</span>
								</div>
								<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Profile Details" data-placement="top" data-toggle="tooltip">
									1 <span class="badge"> &raquo;</span>
								</div>
							</button>

							<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
							
							<button type="button" onclick="window.location.href = '<?=base_url()?>apply/apply_3/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
								<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
									Document Upload <span class="badge"> &raquo;</span>
								</div>
								<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl" title="Document Upload" data-placement="top" data-toggle="tooltip" >
									2 <span class="badge"> &raquo;</span>
								</div>
							</button>

							<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
							
							<button type="button" onclick="window.location.href = '<?=base_url()?>apply/apply_4/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg"  title="Payment" data-placement="top" data-toggle="tooltip" style="  background-color: #E9CDCD;border: 1px solid #E9CDCD; border-radius: 5px;color: black">
								<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
									Payment
								</div>
								<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"> 
									3 
									<!--<span class="tooltiptext">Payment</span>-->
								</div>
							</button>
							
							<!--<a href="<?=base_url()?>apply/<?=$file_name?>/ins/<?=$ins?>" ><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
							
							<a href="<?=base_url()?>apply/apply_3/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/documentupload.png" /></a>
							<img src="<?=base_url()?>public/assets/images/payment1.png" />-->
					<?php } 
						else if($appl_status == 'Fee Paid' || $appl_status == 'Verified' || $appl_status == 'Payment Updated') { ?>
							<button type="button" onclick="window.location.href = '<?=base_url()?>apply/<?=$file_name?>/ins/<?=$ins?>/edit/<?=$edit_status?>';"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
								<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
									Profile Details <span class="badge"> &raquo;</span>
								</div>
								<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Profile Details" data-placement="top" data-toggle="tooltip">
									1 <span class="badge"> &raquo;</span>
								</div>
							</button>

							<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
							
							<button type="button" onclick="window.location.href = '<?=base_url()?>apply/apply_3/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
								<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
									Document Upload <span class="badge"> &raquo;</span>
								</div>
								<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl" title="Document Upload" data-placement="top" data-toggle="tooltip" >
									2 <span class="badge"> &raquo;</span>
								</div>
							</button>

							<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
							
							<button type="button" onclick="window.location.href = '<?=base_url()?>apply/apply_4/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg"  title="Payment" data-placement="top" data-toggle="tooltip" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
								<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
									Payment
								</div>
								<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"> 
									3 
									<!--<span class="tooltiptext">Payment</span>-->
								</div>
							</button>
							
							
							<!--<a href="<?=base_url()?>apply/<?=$file_name?>/ins/<?=$ins?>" ><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
							
							<a href="<?=base_url()?>apply/apply_3/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/documentupload.png" /></a>
							<img src="<?=base_url()?>public/assets/images/payment.png" />-->
					<?php }  
						else if( $appl_status == 'Payment Updated' || $appl_status == 'Application Submitted' ) { ?>
							<button type="button" onclick="window.location.href = '<?=base_url()?>apply/<?=$file_name?>/ins/<?=$ins?>/edit/<?=$edit_status?>';"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
								<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
									Profile Details <span class="badge"> &raquo;</span>
								</div>
								<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"  title="Profile Details" data-placement="top" data-toggle="tooltip">
									1 <span class="badge"> &raquo;</span>
								</div>
							</button>

							<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
							
							<button type="button" onclick="window.location.href = '<?=base_url()?>apply/apply_3/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
								<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
									Document Upload <span class="badge"> &raquo;</span>
								</div>
								<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl" title="Document Upload" data-placement="top" data-toggle="tooltip" >
									2 <span class="badge"> &raquo;</span>
								</div>
							</button>

							<a class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 smpl-step-icon" style="background-color:#1d1d1d;margin-top: 25px;"></a>
							
							<button type="button" onclick="window.location.href = '<?=base_url()?>apply/apply_4/ins/<?=$ins?>/edit/<?=$edit_status?>';" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 btn btn-primary btn-rounded btn-lg"  title="Payment" data-placement="top" data-toggle="tooltip" style=" background-color: #BBFEAE;border: 1px solid #BBFEAE; border-radius: 5px;color: black">
								<div class="hidden-xs hidden-sm col-md-12 col-lg-12 col-xl-12">
									Payment
								</div>
								<div class="col-xs-12 col-sm-12 hidden-md hidden-lg hidden-xl"> 
									3 
									<!--<span class="tooltiptext">Payment</span>-->
								</div>
							</button>
							
							
							<!--<a href="<?=base_url()?>apply/<?=$file_name?>/ins/<?=$ins?>" ><img src="<?=base_url()?>public/assets/images/studentdetails.png" /></a>
							
							<a href="<?=base_url()?>apply/apply_3/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/documentupload.png" /></a>
							<img src="<?=base_url()?>public/assets/images/payment.png" />-->
					<?php } ?>
						
					<?php
							if($appl_status == 'Verified') { 
						?>
				
						<?php 
						} 
						else{
							?>
							
						<!--<div id ="preview" class="col-sm-1 col-sm-offset-11" style="margin-left: 87%;margin-top: -3.5%"><a href="preview.php?ins=<?=$ins?>" class="btn btn-primary">Preview / Modify</a></div>-->
						<?php } ?>
						
							<br /><br /><br />
							</div>
				<div class="col-lg-12 top-pad">
				
				<div class="panel panel-primary panel-payment1">
					<div class="panel-heading step-heading">
						<b><i class="fa fa-money"></i> Payment</b>						
					</div>
					<!--<div class="" align="right" >
						<h2 class="panel-title" style="margin-top:10px;color: #802d06;"><b><?php echo $admname; ?></b></h2>
					</div>-->	
		<?php 
			if($appl_status == 'Verified') { 
				
			?>
				
				<div class="col-sm-1" style="margin-top: 40px;margin-bottom: 15px;">
					<a href="<?=base_url()?>mpdf_controller/<?= $tmp_name; ?>/reg_user_id/<?= $reg_user_id; ?>/program/<?= $admcode;?>"  target='_blank' class="btn btn-primary" >Print Application</a>
				</div>
			<?php 
			} 
		?>
					<!--<a href="#" class="pull-right" style="margin-top: -4.0%;margin-right: 0.2%" id="btnInstruction" name="btnInstruction" title="Help"><img type="button" src="<?php echo base_url(); ?>public/assets/images/helpicon.png" name="btnInstruction" title="Help" id="btnInstruction" style="width:40px;height:40px;cursor:pointer;margin-top: 5px;"></img></a>-->
				<?php } 
				if($print==3)
				{
				?>
					<div class="alert alert-success alert-dismissible" role="alert" >
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<div id="alertmessage1">Error in Generating Print application.Try again.</div>
					</div>
				<?php	     
				}
				?>
				<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;"> <!-- Alert for error -->
					<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
					<div id="alertmessage"></div>
				</div>
				<?php if($show==1) { ?>
				<div class="alert alert-success alert-dismissible" role="alert" style="padding: 0px;" >
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div id="alertmessage1">Your Application is under Payment Verification.</div>
				</div>
				<?php } ?>
				<input type="hidden" id="hidAppNo" name="hidAppNo" value="<?php echo $application_no; ?>" />
				<input type="hidden" id="hidInsCode" name="hidInsCode" value="<?php echo $ins; ?>" />
				<input type="hidden" id="hidProgNo" name="hidProgNo" value="<?php echo $admcode; ?>" />
				<input type="hidden" id="hidRegNo" name="hidRegNo" value="<?php echo $reg_user_id; ?>" />
				<input type="hidden" id="hidAppStatus" name="hidAppStatus" value="<?php echo $appl_status; ?>" />
				<input type="hidden" id="hidFileName" name="hidFileName" value="<?php echo $file_name; ?>" />
				<input type="hidden" id="hidOnlineTab" name="hidOnlineTab" value="" />
				<input type="hidden" id="hidChallan" value="" />
					<div class="panel-body panel-payment" style="margin-top: -0.3%" >
					
					
						<?php if($show==0) { ?>
						<?php
						if($applshow == 1 && $noamount != 1 )
						{
						?>
						<div >Thanks for your payment towards <b> <?Php echo $admname ; ?> </b> .The payment details as follows.</div>
						<?php
						}
						?>
						
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
						  <form class="form-horizontal" method="post" role="form" id="challanfrmApply" name="challanfrmApply" >
						  	<div id="exampleModal" class="modal fade" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog modal-lg ">

							    <!-- Modal content-->
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">View Form</h4>
							      </div>
							      <div class="modal-body">
							      	<!--<iframe src="<?= base_url(); ?>/application/views/apply/preview_temp009.php" />-->
							        <div id="tempPreview"></div>
							      </div>
							      <div class="modal-footer">
							      	<button type="button" class="btn btn-warning" id="btnEdit" name="btnEdit" onclick="edit_template('<?php echo $file_name; ?>')">Edit</button>
							      	<button type="button" class="btn btn-primary" id="btnProc" name="btnProc" onclick="proceed_template();">Proceed</button>
							      </div>
							    </div>

							  </div>
							</div>
							
							<div id="exampleModalOnline" class="modal fade" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog modal-lg ">

							    <!-- Modal content-->
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">View Form</h4>
							      </div>
							      <div class="modal-body">
							      	<!--<iframe src="<?= base_url(); ?>/application/views/apply/preview_temp009.php" />-->
							        <div id="tempPreviewOnline"></div>
							      </div>
							      <div class="modal-footer">
							      	<button type="button" class="btn btn-warning" id="btnEdit" name="btnEdit" onclick="edit_template('<?php echo $file_name; ?>')">Edit</button>
							      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      	<button type="submit" class="btn btn-primary" id="btnPay" name="btnPayment"  onClick="return validate();" >Proceed</button>
							      </div>
							    </div>

							  </div>
							</div>
						  	<input  type="hidden" id="hidCsrfToken" name="hidCsrfToken" value="aecfghil2157rthukli2472222"/>
							<input type="hidden" name="hidPaymentMode" id="hidPaymentMode" value=""/>
								<!--<div><span style="color: red;"><b> Note: </b></span>To continue for payment, please click on the proceed button in Preview Application.		</div>
							<div class="form-group">
							
								<label for="" class="col-sm-2 control-label" style="align:left;">Amount :</label>
								<?php 
								if($applshow != 1 && $noamount != 1) { 
									if($edit_appl_status == 0){?>
								
									<button type="button" id="btnPayView" class="btn btn-warning" onclick="preview_online('<?php echo $file_name; ?>');">Review</button>
								<?php }
								else
								{ ?>
									<button type="submit" class="btn btn-primary" id="btnPay" name="btnPayment"  onClick="return validate();" >Proceed</button>
								<?php } } ?>
								<div class="col-sm-3" style="margin-top: 6px;">
									<img src="http://i.stack.imgur.com/nGbfO.png" width="8" height="10">&nbsp;<span><?php echo $noamount==1?'0.00':$amount.'.00'; ?></span>
									<input type="hidden" class="form-control" id="txtChallanAmount" name="txtChallanAmount" placeholder="Amount" value="<?php echo $noamount==1?'0.00':$amount; ?>" disabled >
								</div>
								<div class="col-sm-3" id="mod">
									
								</div>
								
							</div>-->
							<form class="Form" method="post" role="form" action="" id="BankSubmitForm" name="BankSubmitForm" enctype="multipart/form-data">
							<div class="row" style="margin-top: 20px;">
								<div class="col-lg-6">
									<div class="col-lg-12">
										<div class="form-group">
											<label for="" class="" > <i style="color:red;font-size:18px;">*</i> Reference No:- </label>	
											<div class="input-group">
												<div class="input-group-addon">
													<span class="input-group-text">
														<i class="fa fa-credit-card" style="color:#E4791A"></i>
													</span>                    
												</div>
												<input type="text" class="form-control test" id="txtReferenceno" name="txtReferenceno" placeholder="Enter Reference No"  value="<?= $Referencno ?>" >
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-lg-6">
									<div class="col-lg-12">
										
										<div class="form-group">
											<label class=""><i style="color:red;font-size:18px;">*</i> Bank Name:- </label>										
												<div class="input-group">
													<div class="input-group-addon">
														<span class="input-group-text">
															<i class="fa fa-bank" style="color:#E4791A"></i>
														</span>                    
													</div>
													<input type="text" class="form-control test" id="txtBankName" name="txtBankName" placeholder="Enter Bank Name"  value="<?= $challanbank_name ?>" >
												</div>										
										</div>
									</div>
								</div>
							</div>
							<div class="row" style="margin-top: 20px;">
								<div class="col-lg-6">
									<div class="col-lg-12">
										<div class="form-group">
											<label for="" class="" ><i style="color:red;font-size:18px;">*</i> Upload Receipt:- </label>
												<div class="input-group">
													<div class="input-group-addon">
														<span class="input-group-text">
															<i class="fa fa-file-text" style="color:#E4791A"></i>
														</span>                    
													</div>
													<input type="file" class="form-control" id="txtReceipt" name="txtReceipt" placeholder="Upload Receipt"  value="<?= $challan_path ?>" >
												</div>
										</div>
										
									</div>
								</div>
								<div class="col-lg-6" >
									<div class="form-group" style="text-align: center;">
										<?php
											if($challan_path!='' || $challan_path!= null) 
											{ 
												echo "<a  target='_blank' href = '".$challan_path."'><img id='' src='".$challan_path."'  width='100' height='120' /></a>";
											} 
											else 
											{ 
												echo "<img id=''  />"; 
											} 
										?>
									</div>
								</div>	
							</div>
							<!--<div class=" col-lg-5 ">
								<button type="button" id="btnBanksubmit"  class="btn btn-warning" style="margin-left: 775px;" onclick="Banksubmit()" > Submit </button>
								<button type="button" id="btnBanksubmit"  class="btn btn-warning" style="margin-left: 775px;"  > Submit </button>
							</div>-->
							</form>
							
							<?php if($noamount != 1){ ?>
			
								<?php if($reg_mode=='OFFLINE') { ?>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label" style="align:left;">Payment Mode :</label>
									<div class="col-sm-3">
											<label class="radio-inline">
												<input type="radio" name="radioPayment" id="radioCounter" value="ON THE COUNTER" checked <?php if(($editappl=="true")&&($row6['money_deposit_mode']=="ON THE COUNTER")) { echo "checked"." disabled"; } ?> <?php echo $editappl=="true"?'disabled':''; ?>> On The Counter
											</label>
											
									</div>
								</div>
								<?php } 
								else {
									
							
								
									
									
									if($appl_status != 'Verified' && $appl_status != 'Fee Paid') { 
								   ?>
								  <br />
								
								<div class="form-group" id="divPaymentModes">
									<?php 
									if($editappl == "true" && $deposit_mode =='ONLINE')
									{
									?>
									<div style="padding-left: 3%">
										<div class="form-group">
											<h4 style="color: #85803b">Online Payment Details:</h4>
											<label for="" class="col-sm-3 control-label" style="align:left;">Transaction No:</label>
											<div class="col-sm-3">
												<input type="text" class="form-control"   value="<?= $row6['money_receipt_no']?>" disabled="disabled">
											</div>
										</div>
										<div class="form-group">
											<label for="" class="col-sm-3 control-label" style="align:left;">Transaction Date:</label>
											<div class="col-sm-3">
												<input type="text" class="form-control" value="<?=$row6['depositdate']?>" disabled="disabled">
											</div>
										</div>
									</div>
									<?php
									}
									?>
									<?php 
									if($applshow != 1 && $noamount != 1) { ?>
									
									<div id="onlineSubmit">
										<div class="form-group">
											
											<div class=" col-lg-5 col-lg-offset-1">
												<button type="button" id="btnPayView"  class="btn btn-warning" onclick="preview('<?php echo $file_name; ?>');"><i class="fa fa-file-o"></i> Preview Application</button>
												<a href=" <?= base_url() ?>payment/onlinepaymentinstruction/<?= $ins?>" class="btn btn-primary" id="btnOnline" name="btnOnline" ><i class="fa fa-money"></i> Proceed for Online Payment</a>
											</div>
										</div>
									</div>
									<?php } ?>
														
													
												   
								</div>
								<?php } else{     ?>
									
									<div class="form-group">
										<label for="" class="col-sm-2 control-label" style="align:left;">Payment Mode :</label>
										<div class="col-sm-3">
											<span><?=$deposit_mode?></span>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label" style="align:left;">Transaction No :</label>
										<div class="col-sm-3">
											<span><?=$money_receipt_no?></span>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label" style="align:left;">Payment Date :</label>
										<div class="col-sm-3">
											<span><?=$depositdate?></span>
										</div>
									</div>
								<?php }
										?>
								<?php } ?>
							<?php } 
								 else{
								 	//echo 'hi';
								 	?>
								 	<?php 
									if($appl_status == 'Verified') { 
										
									?>
										<div class="col-sm-3 col-sm-offset-5">
											<a href="<?=base_url()?>apply/download_print_application" target='_blank' class="btn btn-primary" >Print Application</a>
										</div>
									<?php 
									} 
									else{
										?>
										<?php if($appl_status != 'Verified' && $appl_status != 'Fee Paid'  ){ 
										?>
										<?php if( $appl_status == 'Application Submitted')
										{ ?>
											<button type="button" id="btnBanksubmit"  class="btn btn-warning" > Submit</button>
											<button type="button" id="btnPayView"  class="btn btn-warning" onclick="preview('<?php echo $file_name; ?>');">Preview Application</button>
										<?php }
										else if( $appl_status == 'Document Uploaded')
										{ ?>
											<button type="button" id="btnBanksubmit"  class="btn btn-warning" > Submit</button>
										<?php }
										else if( $appl_status == 'Payment Updated')
										{ ?>
											<button type="button" id="btnBanksubmit"  class="btn btn-warning" > Submit</button>
											<button type="button" id="btnPayView"  class="btn btn-warning" onclick="preview('<?php echo $file_name; ?>');">Preview Application</button>
											<button type="submit" class="btn btn-primary" id="btnPay" name="btnPayment"  onClick="return validate();" >Proceed to Complete</button>
										<?php }
										else
										{ ?>
											<button type="button" id="btnBanksubmit"  class="btn btn-warning" > Submit</button>
											<button type="button" id="btnPayView"  class="btn btn-warning" onclick="preview('<?php echo $file_name; ?>');">Preview Application</button>
											<?php if($noamount == 1){?>
												<button type="submit" class="btn btn-primary" id="btnPay" name="btnPayment"  onClick="return validate();" >Proceed to Complete</button>
												
										<?php }
										} ?>
										
										<div class="col-sm-2">
											<!--<button type="button" class="btn btn-primary" onclick="preview('<?php echo $file_name; ?>');" id="btnView">
											  Preview Application
											</button>-->

											<!--<button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal" id="btnView" name="btnView"  onClick="return validate();" >View</button>-->
											<!--<button type="button" class="btn btn-primary" id="btnPay" name="btnPayment"  onClick="return validate();" >Submit</button>-->
										</div>
										<?php } ?>
								
									<?php } ?>
												
									<?php
							}
							?>
							<?php if($applshow != 1 && $noamount != 1) { ?>
							
							<?php } ?>
							<?php
							if($applshow == 1 && $noamount != 1 )
							{
								if($appl_status == 'Fee Paid')
								{
							?>
									<div class="form-group" style="margin-top: 5%">
										<label for="" class="col-sm-2 control-label" style="align:left;">Challan No :</label>
										<div class="col-sm-3">
											<input type="text" class="form-control" id="txtChallanNo" name="txtChallanNo" value="<?= $txtChallanNo ?>" disabled="" >
										</div>
										<label for="" class="col-sm-2 control-label" style="align:left;">Date :</label>
										<div class="col-sm-2">
											<input class="form-control" type="text" name="txtdate" id="txtdate" value="<?= $txtChallanDate ?>" placeholder="Date of Challan(dd-mm-yyyy)" data-placement="top" data-toggle="tooltip"  disabled=""  title="Date of Birth ex:01-01-2000" value="<?=isset($txtdate)?$txtdate:''?>" readonly/>
											<!--<input type="text" class="form-control" id="txtAccountNo" name="txtAccountNo" value="<?php echo $account_no; ?>" >-->
										</div>
										
										<!--<div class="col-sm-2"  >
											<a href="PDF/challangenerationpdf.php?app=<?=$application_no?>&amount=<?=$amount?>" target="_blank" class="btn btn-primary"  id="download" <?php echo $editappl=="true"?'disabled':''; ?>>Generate Challan</a>
										</div>-->
									</div>
									<div class="form-group" style="margin-top: 5%">
										<label for="" class="col-sm-2 control-label" style="align:left;">Bank Name :</label>
										<div class="col-sm-3">
											<input class="form-control" type="text" name="txtBankName" id="txtBankName" value="<?= $txtBankName ?>" placeholder="Bank Name" data-placement="top" data-toggle="tooltip" <?php if($appl_status == 'Verified' || $appl_status == 'Fee Paid'){ ?> disabled="" <?php } ?>  title="Bank Name"/>
											
										</div>
										<label for="" class="col-sm-2 control-label" style="align:left;">Branch Name :</label>
										<div class="col-sm-2">
											<input class="form-control" type="text" name="txtBankBranch" id="txtBankBranch" value="<?= $txtBankBranch ?>" placeholder="Branch Name" data-placement="top" data-toggle="tooltip" <?php if($appl_status == 'Verified' || $appl_status == 'Fee Paid'){ ?> disabled="" <?php } ?>  title="Branch Name"/>
											<!--<input type="text" class="form-control" id="txtAccountNo" name="txtAccountNo" value="<?php echo $account_no; ?>" >-->
										</div>
										<?php if($appl_status != 'Verified' && $appl_status != 'Fee Paid'){ 
										if($edit_appl_status == 0){?>
								
											<button type="button" id="btnPayView" class="btn btn-warning" onclick="preview('<?php echo $file_name; ?>');">Preview Application</button>
										<?php }
										else
										{ ?>
											<!--<button type="submit" class="btn btn-primary" id="btnPay" name="btnPayment"  onClick="return validate();" >Proceed</button>-->
										<?php } ?>
										
										<div class="col-sm-2">
											<!--<button type="button" class="btn btn-primary" onclick="preview('<?php echo $file_name; ?>');" id="btnView">
											  Preview Application
											</button>-->
											<!--<button type="button" class="btn btn-primary" id="btnView" data-toggle="modal" data-target="#exampleModal" name="btnView"  onClick="return validate();" >View</button>-->
											<!--<button type="submit" class="btn btn-primary" id="btnPay" name="btnPayment"  onClick="return validate();" >Submit</button>-->
										</div>
										<?php } ?>
										<!--<div class="col-sm-2"  >
											<a href="PDF/challangenerationpdf.php?app=<?=$application_no?>&amount=<?=$amount?>" target="_blank" class="btn btn-primary"  id="download" <?php echo $editappl=="true"?'disabled':''; ?>>Generate Challan</a>
										</div>-->
									</div>
									<div class="col-sm-offset-2"><h4 style="color: yellowgreen">Payment has already been done.</h4></div>
							<?php		
								}
								else
								{
								?>
									<div class="col-sm-offset-2"><h4 style="color: yellowgreen">Payment has already been done.</h4></div>
								
							
							
							<?php
							}
							}
							?>
						  </form>
						</div>
						<?php }  ?>
						<?php if($print==1) {  ?>
						<!--<label for="" class="col-sm-8 control-label col-sm-offset-4" style="text-align:left;">Do you want to print the application?</label>-->
						<div class="col-sm-7 col-sm-offset-5">
							<!--<a href="PDF/applicationFormPDF.php" target='_blank' class="btn btn-primary" style="background:#9D426B;">Print Application</a>-->
							<!--<a href="projectIndex.php?admcode=<?php echo $program_code;?>" class="btn btn-primary" style="background:#9D426B;">No</a>-->
						</div>
						<label for="" class="col-sm-8 control-label col-sm-offset-4" style="text-align:left;"><br><a href="projectIndex.php?admcode=<?php echo $program_code;?>&ins=<?=$hex_ins_code?>" style="color:#9D426B;">Click here</a> to go back to the home page.</label>
						<?php } ?>
						<?php if($print==2) {  ?>
						<!--<label for="" class="col-sm-8 control-label col-sm-offset-4" style="text-align:left;">Do you want to print the application?</label>-->
						<div class="col-sm-7 col-sm-offset-5">
							<?php
							if($temp_name != '')
							{
							?>
								<a href="PDF/download_application.php?" target='_blank' class="btn btn-primary" >Print Application</a>
							<?php		
								}
							
							?>
						</div>
						<label for="" class="col-sm-8 control-label col-sm-offset-4" style="text-align:left;"><br><a href="projectIndex.php?admcode=<?php echo $program_code;?>&ins=<?=$ins?>" style="color:#9D426B;">Click here</a> to go back to the home page.</label>
						<?php } ?>
					</div><!--Panel Body-->
				</div><!--background div-->
				<br><br><br>
			</div><!--/col-lg-12-->
			<?php } 
			else
			{ ?>
			<div class="col-lg-12">
				<br>
				<center><h3>You don't have access to this page.</h3></center>
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			</div>
			<?php } ?>
		</div><!--/row-->
	  
	</div><!--/container-->
	<!--Alert Modal -->
	<!-- Modal -->
	
	<div class="modal fade bs-example-modal-sm" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop= "static" >
	  <div class="modal-dialog modal-sm">
		<div class="modal-content">
		  <div class="modal-header">
			<!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
			</button>-->
			<h4 class="modal-title" id="myModalLabel">Message</h4>
			</div>
			<div class="modal-body" id="failurebody">
				Your application is pending for payment confirmation! <br/>
				<b>Please Note:</b> Once submitted you will not be able to modify any data. Do you want to submit?
			</div>
			<div class="modal-footer">
				<button type="button" id = "SUBMIT" class="btn btn-primary submitbtn" data-dismiss="modal">
					Submit
				</button>
				<button type="button" id = "CANCEL" class="btn btn-primary cancelbtn" id="btnCancel" data-dismiss="modal">
					Cancel
				</button>		
			</div>
		</div>
	  </div>
	</div>

	
	
		<div class="modal fade" id="modalInstruction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header" style="background-color: #496cad;color: white;">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" style="color: white;" id="myModalLabel">Instruction</h4>
		      </div>
				<div class="modal-body" id="divInstruction">
					<p><span style="text-decoration: underline;"><strong>Online Payment</strong></span></p>
						<ul>
						<li>Click Proceed For Online Payment.</li>
						<li>It&rsquo;ll take you to the payment page.</li>
						<li>Then click Pay Now,It&rsquo;ll take you to the payment gateway.</li>
						<li>Choose your mode of payment from Credit Card, Debit Card or Net banking.</li>
						</ul>
						<p><br /><span style="text-decoration: underline;"><strong>Offline (Challan Payment)</strong></span></p>
						<ul>
						<li>Enter the challan number, bank name, branch name and challan date in the fields provided in the payment section.</li>
						</ul>
				</div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</div>

<!--<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrapValidator.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.bootstrap.min.js"></script>-->
<!--<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>-->
<script src="<?php echo base_url(); ?>public/assets/js/apply_4.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/jquery.datepick/js/jquery.plugin.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/jquery.datepick/js/jquery.datepick.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/jquery.datepick/js/jquery.plugin.js"></script> 

<script>


	var app_no = $('#hidAppNo').val();
	var ins_code = $('#hidInsCode').val();
	var result = '';
	result = '<?=$this->session->flashdata('info'); ?>';
	if(result){
		swal({
			title: "Application",
			text: "Successfully Submitted with Application No: "+app_no,
			//type: "success"
			},
			function(isConfirm) {
			  if (isConfirm) {
			  	//alert("<?php echo base_url() ?>apply/institute_page/ins/"+ins_code);
			  	//console.log(base_url+"apply/institute_page/ins/".<?=$ins?>);
			  	window.location=( "<?php echo base_url() ?>apply/institute_page/ins/<?=$ins?>");
			    //window.location.href = ("<?php echo base_url() ?>apply/institute_page/ins/<?=$ins?>");
			    //window.location.href = ("<?php echo base_url() ?>apply/apply_4/ins/<?=$ins?>");
			  }
		});
			
	}
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!

	var yyyy = today.getFullYear();
	if(dd<10){
	    dd='0'+dd;
	} 
	if(mm<10){
	    mm='0'+mm;
	} 
	var today = dd+'-'+mm+'-'+yyyy;
	$('#txtdate').datepick({ 
		dateFormat: 'dd-mm-yyyy',
		minDate:'31-07-1988',
		maxDate: today,
		yearRange: '1980:2020'
	});/*
	$('#txtdate').datepicker({
		    format: "dd-mm-yyyy",
			todayHighlight:true,
			autoclose:true,
			endDate:"+0d"
	    }).on('changeDate', function(e) { 
			//$('#frm_login').data('bootstrapValidator').updateStatus('txtdob', 'VALID', null);
		});*/
</script>