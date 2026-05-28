<?php
date_default_timezone_set('Asia/Kolkata');
$now = date('Y-m-d h:i:s', now());
//print_r($allQualifications);
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
$cmbNationality = '';
$cmbrelationship='';
$txtOtherRelations='';
$cmbReligion = '';
//$allMinority = '';
$radiogender = '';
$txtOtherNationality = '';
$txtOtherRelations='';

$radioMigrant = '';
$radioPhysicallY = '';
$radioMinority = '';
$txtemail = '';
$radiobelong = '';
$txtOccupation = '';
$txtIncome = '';
$txtIndicate = '';
$txtKnowabout = '';

$center_name1='';
$master_name='';
$center_code1='';
$center_name2='';
$center_code2='';
$center_name3='';
$center_code3='';
$cand_name = '';
$co_name = '';
$city_name = '';
$cand_name1 = '';	
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
$cmbrelationship='';
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
	$txtDob = $row['dob'];
	$dob1 = explode('-',$txtDob);
	$txtEmailId = $row['email_id'];
	$d = $dob1[2];
	$m = $dob1[1];
	$y = $dob1[0];
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
	$radioHostel = $row['hostel_facility'];
	$radiomaritalstatus = $row['marital_status'];
	$cmbNationality = $row['nationality'];
	$txtOtherNationality = $row['nationality_oth']; 

	$cmbrelationship = $row['cmbrelationship'];
	$txtOtherRelations = $row['txtOtherRelations']; 


	$cmbReservedCategory = $row['category'];
	//$radioHandicapped = $row['is_physically_challanged'];
	$radioPhysicallY  = $row['physically_challenged'];
	$radioMinority   = $row['is_minority_community'];
	$txtemail   = $row['applicant_email'];
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
	$cmbReservedCategory = $row['category'];
	$txtChronicIllness = $row['chronic_illness'];
	$radioAllergies = $row['if_allergies'];
	$txtAllergies = $row['allergies'];
	$chksameasresidential = ($row['comm_address_ref_id'] == $row['perm_address_ref_id'] ? 'Y' : 'N');
	$txtSchoolName = $row['last_school'];
	$cmbBoardName = $row['last_board'];
	$txtOtherBoard = isset($allOtherInfo["Name of the Board"]) ? $allOtherInfo["Name of the Board"] : ''; 
	$cmbReligion = $row['religion'];
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

	$center_name1=$row['center_name1'];
	$center_code1=$row['center_code1'];
	$center_name2=$row['center_name2'];
	$center_code2=$row['center_code2'];
	$center_name3=$row['center_name3'];
	$center_code3=$row['center_code3'];

	$is_employed=$row['is_employed'];
	$employer_add=$row['employer_add'];
	$employer_from=$row['employer_from'];
	$employer_to=$row['employer_to'];
	$employer_add1=$row['employer_add1'];
	$employer_from1=$row['employer_from1'];
	$employer_to1=$row['employer_to1'];
	


	$completion_date=$row['completion_date'];
	 
	
}
foreach($present_communication_data as $row)
{
	$txtPresentAddress = $row['address_1'];

	$cand_name = $row['cand_name'];
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

	$cand_name1 = $row['cand_name'];

	
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
	$sl++;
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
 
function setSameAddress()
{
	if(document.getElementById("chksameasresidential").checked)
	{
		 
		document.getElementById("txtPermenentLocality").value=document.getElementById("txtPresentLocality").value;
		document.getElementById("txtPermanentPost").value=document.getElementById("txtPresentPost").value;
		document.getElementById("cmbPermanentDist").value=document.getElementById("cmbPresentDist").value;
		document.getElementById("cmbPermanentState").value=document.getElementById("cmbPresentState").value;

		document.getElementById("cand_name1").value=document.getElementById("cand_name").value;
		document.getElementById("co_name1").value=document.getElementById("co_name").value;
		document.getElementById("city_name1").value=document.getElementById("city_name").value;
		document.getElementById("phone_no1").value=document.getElementById("phone_no").value;
		document.getElementById("txtemail1").value=document.getElementById("txtemail").value;

		document.getElementById("txtPermanentPin").value=document.getElementById("txtPresentPin").value;
		 
		
		$('#cand_name1').attr('disabled', true);
		$('#city_name1').attr('disabled', true);
		$('#co_name1').attr('disabled', true);
		$('#phone_no1').attr('disabled', true);
		$('#txtemail1').attr('disabled', true);
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
		document.getElementById("cand_name1").value = "";
		document.getElementById("city_name1").value = "";
		document.getElementById("co_name1").value = "";
		document.getElementById("phone_no1").value = "";
		document.getElementById("txtemail1").value = "";




		document.getElementById("txtPermenentLocality").value = "";
		document.getElementById("txtPermanentPost").value = "";
		document.getElementById("cmbPermanentDist").value = "";
		document.getElementById("cmbPermanentState").value = "";
		document.getElementById("txtPermanentPin").value = "";
		$("#forStatePermanent").hide();
		$("#forDistPermanent").hide();
		

		$('#cand_name1').removeAttr('disabled');
		$('#city_name1').removeAttr('disabled');
		$('#co_name1').removeAttr('disabled');
		$('#phone_no1').removeAttr('disabled');
		$('#txtemail1').removeAttr('disabled');
		$('#txtPermenentLocality').removeAttr('disabled');
		$('#txtPermanentPost').removeAttr('disabled');
		$('#cmbPermanentDist').removeAttr('disabled');
		$('#cmbPermanentState').removeAttr('disabled');
		$('#txtPermanentPin').removeAttr('disabled');
		$('#txtOtherPermanentState').removeAttr('disabled');
		$('#txtOtherPermanentDist').removeAttr('disabled');
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
		
		if(document.getElementById("txtPermenentAddress").value == '')
		{
			errorMessage += "Please enter Plot/House No./Village in Permanent Address.<br/>";
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
		if(document.getElementById("txtPermanentPin").value == '')
		{
			errorMessage += "Please enter Pin in Permanent Address.<br>";
		}
	}
	if (document.getElementById('cmbNationality').value == 'OTH') {
		
		if(document.getElementById("txtOtherNationality").value == '')
		{
			errorMessage += "Please specify Nationality.<br/>";
		}
	}
	
	if(document.getElementById("radioHonours").checked == true )
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
		
	}
	/*if(document.getElementById("txtSubject1").value == '' || document.getElementById("txtSubject2").value == '' || document.getElementById("txtSubject3").value == '' || document.getElementById("txtSubject4").value == '')
	{
		
		errorMessage += "Please enter all Subjects of Qualifying Degree";
		
	}
	if(document.getElementById("radioPassed").checked == true)
	{
		if(document.getElementById("txtSecuredMarks").value == '')
		{
			errorMessage += "Please enter Secured Marks (Including Honours)<br/>";
		}
	}*/
	
	 
	/*if(document.getElementById("txtSecuredMarks").value != '')
	{
		if(parseInt(document.getElementById("txtSecuredMarks").value) > parseInt(document.getElementById("txtTotalMarks").value ))
		{
			errorMessage += "Secured marrk can not be greater than Total mark for Qualifying degree<br/>";
		}
	}
	if(document.getElementById("txtHonsSecuredMarks").value != '')
	{
		
		//alert(document.getElementById("txtHonsTotalMarks").value);
		if(parseInt(document.getElementById("txtHonsSecuredMarks").value) > parseInt(document.getElementById("txtHonsTotalMarks").value ))
		{
			errorMessage += "Secured marrk can not be greater than Total mark for Qualifying degree (Honours)<br/>";
		}
	}*/
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

<link href="<?=base_url()?>public/assets/css/datepicker3.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.css" />
<div class="container-fluid" style="margin-top: 36px; padding-bottom: 50px;">

	<div class="row">
		<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1" style="margin-top: 30px; padding-right:-15px;">
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

							<b><i class="fa fa-user"></i>  Application Form for CET-2018 For BPT/BOT/BPO Courses At SVNIRTAR, NILD & NIEPMD</b>
				 
							<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;"> <!-- Alert for error -->
								<div id="alertmessage"></div>
							</div>

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

						<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;margin-top: 20px;">
							<h3 style="text-align: center;margin-top: -6px;color: #666;"> PERSONAL DETAILS</h3>
							
							<div class="row">
								<div class="col-lg-4">
									<div class="form-group">
										<label for="" class="col-lg-4" ><i class="fa fa-user" style="color:#E4791A"></i> First Name</label>
										<div class="col-lg-8">
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


							<div class="row" style="margin-top: 20px;">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="txtDOB" class="col-lg-4" style="margin-top:-5px;text-align:left;">Date of Birth :</label>
										<div class="col-lg-8">
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
							</div>


							<div  class="row" style="margin-top: 20px;">
								<div class="col-lg-6">
									<div class="form-group" >
										<label for="" class="col-lg-5"  ><i class="fa fa-venus-mars" aria-hidden="true" style="color:#E4791A;"></i> Gender</label>
										<div class="col-lg-7">
											<label class="radio-inline">
												<input type="radio" name="radiogender" id="radiomale" value="M" <?php if($radiogender=="M") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Male
											</label>
											<label class="radio-inline">
												<input type="radio" name="radiogender" id="radiofemale" value="F" <?php if($radiogender=="F") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Female
											</label>
											<!--<label class="radio-inline">
												<input type="radio" name="radiogender" id="radiofemale" value="F" <?php if($radiogender=="T") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Transgender
											</label>-->

										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group" >
										<label for="" class="col-lg-7 " ><i class="fa fa-wheelchair" aria-hidden="true" style="color:#E4791A";></i>Whether belongs to PH Category</label>
										<div class="col-lg-5">
											<label class="radio-inline">
												<input type="radio"  name="radioPhysicallY" id="radioPhysicallY" value="NO" <?php if($radioPhysicallY=="NO") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> No
											</label>
											<label class="radio-inline">
												<input type="radio" name="radioPhysicallY" id="radioPhysicallY" value="YES" <?php if($radioPhysicallY=="YES") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Yes
											</label>
										</div>
									</div>
								</div>
							</div>

							<div  class="row"  style="margin-top: 20px;">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="" class="col-lg-5" style="padding-right: 35px;"><i class="fa fa-globe" aria-hidden="true" style="color:#E4791A"></i> Nationality</label>
										<div class="col-lg-7">
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
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="" class="col-lg-5" ><i class="fa fa-users" aria-hidden="true" style="color:#E4791A"></i> Category</label>
										<div class="col-lg-7">
											<select class="form-control" name="cmbCommunity" id="cmbCommunity"   <?php echo $show==1?'disabled':''; ?>>
												<option value=''>Select Category</option>
												<?php 
												foreach($allCategories as $row)
												{
													$x = ($cmbCommunity == $row['category_code'] ? ' selected ' : '');
													echo "<option value='".$row['category_code']."' $x>".$row['category_name']."</option>";
												} 
												?>
											</select>
										</div>
									</div>
								</div>
							</div>

							<div  class="row"  style="margin-top: 20px;display:none;" id="forNationality">
								<div class="col-lg-6">
									<div class="form-group">

										<label for="" class="col-lg-5" style="    padding-right: 35px;"><i class="fa fa-globe" aria-hidden="true" style="color:#E4791A"></i> Specify the Nation:</label>
										<div class="col-lg-7">
											<input type="text" class="form-control" id="txtOtherNationality" name="txtOtherNationality" placeholder="Please Specify" value="<?=$txtOtherNationality?>" <?php echo $show==1?'disabled':''; ?>>

										</div>
									</div>
								</div>

							</div>
							
													<div  class="row" style="margin-top: 20px;">
								<div class="col-lg-12">
									<div class="form-group">
										<label for="" class="col-lg-5" style=""><i class="fa fa-map-marker" aria-hidden="true" style="color:#E4791A"></i> Whether belongs to NE States ?</label>
										<div class="col-lg-7">
											<label class="radio-inline">
												<input type="radio"  name="radiobelong" id="radiobelong" value="NO" <?php if($radiobelong=="NO") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Belongs to North East Region
											</label>
											<label class="radio-inline">
												<input type="radio" name="radiobelong" id="radiobelong" value="YES" <?php if($radiobelong=="YES") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> Belongs to State/ Union Territory
											</label>
										</div>
									</div>
								</div>
							</div>



							<div  class="row"  style="margin-top: 20px;">

								<div class="col-lg-6">
									<div class="form-group">
										<label for="" class="col-lg-5" style="m"><i class="fa fa-credit-card" aria-hidden="true" style="color:#E4791A"></i> Aadhaar No :</label>
										<div class="col-lg-7">
											<input type="text" class="form-control test" id="txtUid" name="txtUid" placeholder="Enter Aadhaar No" maxlength="12"  value="<?=$txtUid?>" data-placement="top" data-toggle="tooltip" title="Aadhaar No must be a digit. ex:123456789012" <?php echo $show==1?'disabled':''; ?>>
										</div>
									</div>
								</div>

								
							</div>

							<div class="row" style="margin-top: 20px;">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="" class="col-lg-5" style=""><i class="fa fa-male" aria-hidden="true" style="color:#E4791A"></i> Father/Guardian's Name</label>
										<div class="col-lg-7">
											<input type="text" class="form-control" id="txtFatherName" name="txtFatherName" placeholder="Enter Father Name" onkeydown="changeCase(this)" onkeyup="changeCase(this)" onblur="changeCase(this)" onclick="changeCase(this)" value="<?=strtoupper($txtFatherName)?>" <?php echo $show==1?'disabled':''; ?>>
										</div>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-group">
										<label for="" class="col-lg-5" style=""><i class="fa fa-male" aria-hidden="true" style="color:#E4791A"></i> Select Relationship</label>
										<div class="col-lg-7">
											<select class="form-control" name="cmbrelationship" id="cmbrelationship" <?php echo $show==1?'disabled':''; ?>>
												<option value=''>Select Relationship</option>
												<?php
												foreach($allRelationship as $row)
												{
													$x = ($cmbrelationship == $row['relationship_code'] ? ' selected ' : '');
													echo "<option value='".$row['relationship_code']."' $x>".$row['relationship']."</option>";
												} 
												?>
											</select>
										</div>
									</div>
								</div>
							</div>


							<div class="row" style="margin-top: 20px;display: none;" id="forRelationship">
								<div class="col-lg-6">
									<div class="form-group">

										<label for="" class="col-lg-5" style="    padding-right: 35px;"><i class="fa fa-globe" aria-hidden="true" style="color:#E4791A"></i> Specify the Relationship:</label>
										<div class="col-lg-7">
											<input type="text" class="form-control" id="txtOtherRelations" name="txtOtherRelations" placeholder="Please Specify" value="<?=$txtOtherRelations?>" <?php echo $show==1?'disabled':''; ?>>

										</div>
									</div>
								</div>

								 
							</div>

							 	

							 
	

							<div class="row">	

								<div class="col-lg-12" style="margin-top: 20px;">
									<div class="form-group">
										<label for="" class="col-lg-4" style="text-align:left; " ><i style="color:red;padding-bottom: 10px;" class="glyphicon glyphicon-asterisk"></i> Choice Of Center &amp;Center Code :</label>
										<div class="col-sm-8">
											<div class="col-sm-4">
												<label>1st Prefernce</label>

												<select class="form-control" name="center_name1" id="center_name1"   <?php echo $show==1?'disabled':''; ?>>
													<option value='BHUBANESWAR' <?php if($center_name1=="BHUBANESWAR") {?> selected="selected" <?php } ?>>BHUBANESWAR</option>
													<option value='CUTTACK' <?php if($center_name1=="CUTTACK") {?> selected="selected" <?php } ?>>CUTTACK</option>
													<option value='PURI' <?php if($center_name1=="PURI") {?> selected="selected" <?php } ?>>PURI</option>							 
												</select>
												 
												  </div>

												  <div class="col-sm-4">
												  	<label>2nd Prefernce</label>

												  	<select class="form-control" name="center_name2" id="center_name2"   <?php echo $show==1?'disabled':''; ?>>
												  		<option value='BHUBANESWAR' <?php if($center_name2=="BHUBANESWAR") {?> selected="selected" <?php } ?>>BHUBANESWAR</option>
												  		<option value='CUTTACK' <?php if($center_name2=="CUTTACK") {?> selected="selected" <?php } ?>>CUTTACK</option>
												  		<option value='PURI' <?php if($center_name2=="PURI") {?> selected="selected" <?php } ?>>PURI</option>							 
												  	</select>
												
												</div>

												<div class="col-sm-4">
													<label>3rd Prefernce</label>
													<select class="form-control" name="center_name3" id="center_name3"   <?php echo $show==1?'disabled':''; ?>>
														<option value='BHUBANESWAR' <?php if($center_name3=="BHUBANESWAR") {?> selected="selected" <?php } ?>>BHUBANESWAR</option>
														<option value='CUTTACK' <?php if($center_name3=="CUTTACK") {?> selected="selected" <?php } ?>>CUTTACK</option>
														<option value='PURI' <?php if($center_name3=="PURI") {?> selected="selected" <?php } ?>>PURI</option>							 
													</select>
												 
												 </div>
												</div>
											</div>
										</div>

									</div>


								</div>

								<!--***********START OF PRESENT ADDRESS SECTION************-->

								<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;    margin-top: 35px;">
											<h3 style="text-align: center;margin-top: -6px;color: #666;"> PRESENT ADDRESS:</h3>

											<!--********PLOT AND LOCALITY***********-->
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="    padding-right: 35px;"><i class="fa fa-home" aria-hidden="true" style="color:#E4791A;"></i> Name</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="cand_name" id="cand_name" value="<?=$cand_name?>" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> C/O</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="co_name" id="co_name" value="<?=$co_name?>"  <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>
											</div>
											<!--************ROW END***************-->

											<!--********PLOT AND LOCALITY***********-->
											<div class="row"  style="margin-top: 20px;">

												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> Locality/Street Name</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="txtPresentLocality" id="txtPresentLocality" value="<?=$txtPresentAddress?>" <?php echo $show==1?'disabled':''; ?>>
														</div>

													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="    padding-right: 35px;"><i style="color:red;font-size:18px;">*</i> Post</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="txtPresentPost" id="txtPresentPost" value="<?=$txtPresentPost?>" <?php echo $show==1?'disabled':''; ?>>
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
															<input type="text" class="form-control" name="city_name" value="<?=$city_name?>" id="city_name" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>


												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> State</label>
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
														<label for="" class="col-lg-5" style="    padding-right: 35px;"><i style="color:red;font-size:18px;">*</i> District</label>
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
														<label for="" class="col-lg-5" ><i style="color:red;font-size:18px;">*</i> PIN</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="txtPresentPin" id="txtPresentPin" onkeypress="return isNumberKey(event)" maxlength="6" value="<?=$txtPresentPin?>" data-placement="top" data-toggle="tooltip" title="Pin must be 6digit ex:123456" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>

											</div>
											<!--************ROW END***************-->
 

											<!--********POST AND PIN CODE***********-->
											<div class="row" style="margin-top: 20px;">

												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> Phone No</label>
														<div class="col-lg-7">
															<input type="Number" class="form-control" name="phone_no" id="phone_no" value="<?=$mobile?>"  <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="m"><span class="glyphicon glyphicon-envelope" style="color:#E4791A"></span> Email Id</label>
														<div class="col-lg-7">
															<input type="email" class="form-control" id="txtemail" name="txtemail" placeholder="Email id" value="<?=$txtemail?>" data-placement="right" data-toggle="tooltip" title="Your Email-id. ex: xyz@gmail.com" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>



											</div>
											<!--************ROW END***************-->

										</div>	
										<!--</div>-->	
										<!--</div>	-->
										<!--***********END OF PERMANENT ADDRESS SECTION************-->

										<!--***********START OF PRESENT ADDRESS SECTION************-->

										<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;    margin-top: 35px;">
											<h3 style="text-align: center;margin-top: -6px;color: #666;"> PERMANENT ADDRESS:</h3>
											<div class="row">
												<div class="form-group">
													<div class="col-sm-8">
														<input type="checkbox" id="chksameasresidential" name="chksameasresidential" value="Y" onclick="setSameAddress();" <?php if($chksameasresidential=="Y") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> 
											Permanent address is same as Present address
													</div>
												</div>
											</div>


											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="    padding-right: 35px;"><i class="fa fa-home" aria-hidden="true" style="color:#E4791A;"></i> Name</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="cand_name1" id="cand_name1" value="<?=$cand_name1?>"  <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> C/O</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="co_name1" id="co_name1" value="<?=$co_name1?>"   <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>
											</div>

											<div class="row"  style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> Locality/Street Name</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="txtPermenentLocality" id="txtPermenentLocality" value="<?=$txtPermenentAddress?>" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>
												 
													<div class="col-lg-6">
														<div class="form-group">
															<label for="" class="col-lg-5" style="    padding-right: 35px;"><i style="color:red;font-size:18px;">*</i> Post</label>
															<div class="col-lg-7">
																<input type="hidden" name="hidPermanentPost" id="hidPermanentPost" value="<?=$txtPermanentPost?>" />
																<input type="text" class="form-control" name="txtPermanentPost" id="txtPermanentPost" value="<?=$txtPermanentPost?>" >
															</div>
														</div>
													</div>

												</div>
											


											<div class="row" style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="    padding-right: 35px;"><i style="color:red;font-size:18px;">*</i> City</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="city_name1" id="city_name1" value="<?=$city_name1?>"  <?php echo $show==1?'disabled':''; ?>>
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
													<label for="" class="col-lg-5" ><i style="color:red;font-size:18px;">*</i> PIN</label>
													<div class="col-lg-7">
														<input type="hidden"  name="hidPermanentPin" id="hidPermanentPin" value="<?=$txtPermanentPin?>" />
														<input type="text" class="form-control" name="txtPermanentPin" id="txtPermanentPin" value="<?=$txtPermanentPin?>" data-placement="top" data-toggle="tooltip" title="Pin must be 6digit ex:123456">
													</div>
												</div>


											</div>
										</div>

 



											<div class="row" style="margin-top: 20px;">

												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> Phone No</label>
														<div class="col-lg-7">
															<input type="Number" class="form-control" name="phone_no1" id="phone_no1" value="<?=$mobile?>"  <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="m"><span class="glyphicon glyphicon-envelope" style="color:#E4791A"></span> Email Id</label>
														<div class="col-lg-7">
															<input type="email" class="form-control" id="txtemail1" name="txtemail1" placeholder="Email id" value="<?=$txtemail?>" data-placement="right" data-toggle="tooltip" title="Your Email-id. ex: xyz@gmail.com" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>



											</div>

										</div>

										<!--***********START OF ACADEMIC INFORMATION SECTION************-->

										<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;    margin-top: 35px;">
											<h3 style="text-align: center;margin-top: -6px;color: #666;"> Academic Information</h3>
											<div class="row">
												<div class="form-group">

													<div class="col-sm-12">
														<h4><b><i class="glyphicon glyphicon-asterisk" style="color:red;font-size:10px;"></i> Educational Qualification</b></h4>
													</div>
													<div class="col-sm-12">
														<div class="table-responsive">
															<table  class="table table-bordered table-striped">
																<tr>
																	<th style="text-align:center;">Board/University</th>
																    <th style="text-align:center;">Name of the Examination</th>
																	<th style="text-align:center;">Year</th>
																	<th style="text-align:center;">Percentage Of Marks</th>


																</tr>
																<?php
																$sl_no =1;
																foreach($allQualifications as $row)
																{
																	$division = $row['division'];
																	$all_division = explode(',',$division);
																	?>
																	<tr>

																		<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtBoard<?=$sl_no?>" name="txtBoard<?=$sl_no?>" value="<?=${'txtBoard'.$sl_no}?>" <?php echo $show==1?'disabled':''; ?> onkeydown="changeCase(this)" onkeyup="changeCase(this)" onblur="changeCase(this)" onclick="changeCase(this)"/></div></td>

																	 
																		<td><input type="text" class="form-control input-sm" name="txtQualification<?=$sl_no?>" id="txtQualification<?=$sl_no?>" value="<?=$row['qualification_name']?>"   /></td>

																		<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtYear<?=$sl_no?>" name="txtYear<?=$sl_no?>" onkeypress="return isNumberKey(event)" maxlength="4"   value="<?php echo ${'txtYear'.$sl_no} == 'NULL'?'':${'txtYear'.$sl_no}; ?>" <?php echo $show==1?'disabled':''; ?> /></div></td>


																		<td><div class="form-group"><input type="text" class="form-control input-sm"  id="txtPercent<?=$sl_no?>" name="txtPercent<?=$sl_no?>" value="<?php echo ${'txtPercent'.$sl_no} == 'NULL'?'':${'txtPercent'.$sl_no}; ?>" /></div></td>
																	</tr>
																	<?php
																	$sl_no++;
																}
																?>

																<tr>

																	<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtBoard4" name="txtBoard4" value="<?=$txtBoard4 ?>" <?php echo $show==1?'disabled':''; ?> onkeydown="changeCase(this)" onkeyup="changeCase(this)" onblur="changeCase(this)" onclick="changeCase(this)"/></div></td>

																 
																	<td><input type="text" class="form-control input-sm" placeholder="Any Other" name="txtQualification4" id="txtQualification4" value="<?=$txtQualification4?>"  /></td>


																	<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtYear4" name="txtYear4" onkeypress="return isNumberKey(event)" maxlength="4"   value="<?php echo $txtYear4 == 'NULL'?'':$txtYear4; ?>" <?php echo $show==1?'disabled':''; ?> /></div></td>

																	<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtPercent4" name="txtPercent4" value="<?php echo $txtPercent4 == 'NULL'?'':$txtPercent4 ;?>" onfocus="calculatePercentage(4)" <?php echo $show==1?'disabled':''; ?>/></div></td>
																</tr>
															</table>
														</div>
													</div>


												</div>

											</div>
									 </div>


											

                     


                              <div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;    margin-top: 35px;">
                              	<h3 style="text-align: center;margin-top: -6px;color: #666;"> Declaration</h3>
                              	<div class="row">
                              		<div class="form-group">
                              			<div class="col-sm-12" align="justify">
                              				<input type="checkbox" hidden="hidden" name="chkUndertaking1" id="chkUndertaking1" value="1" checked="checked" >
                              				We declare that all the particulars stated in this application are true to best of our knowledge and
                              				belief. In the event of suppression or distortion of any fact, made in above application form,
                              				we understand that the candidate will be denied the opportunity to appear in the COMMON
                              				ENTRANCE TEST/ADMISSION. If already admitted, the candidate’s admission will be
                              				cancelled. We also understand that the decision of the authorities of CET-2017, regarding the
                              				admission will be final. If admitted, it is assured that the candidate will follow the rules and
                              				regulations of the Institute and University and if the candidate is found guilty of any misconduct
                              				the candidate shall be liable for punishment as deemed fit by the Institute authority.
                              			</div>
                              		</div>
                              	</div>

                              </div>	


                              <?php if($show != 1) { ?>
                              <div class="form-group" >
                              	<div class="col-lg-12">
                              		<button type="submit" class="btn btn-primary btn-block" id="btnPersonalInfo" name="btnPersonalInfo"    style="margin-top: 20px;font-size:16px;"><span class="glyphicon glyphicon-send" style="font-size:18px;"></span> Save & Next</button>
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

          <script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
          <script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
          <script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrapValidator.js"></script>
          <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jquery.dataTables.min.js"></script>
          <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.responsive.min.js"></script>
          <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.bootstrap.min.js"></script>
          <script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
          <script src="<?php echo base_url(); ?>public/assets/js/template008.js?v=5"></script>
          <script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.js"></script>

          <!--  <link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet"> -->
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