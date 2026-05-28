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
	//$ins = encrypt_decrypt('encrypt',$institute_code);
	$ins = $institute_code;
}
$txtFirstName = '';
$txtMiddleName = '';
$txtLastName = '';
$radiogender = '';
$cmbNationality = '';
$cmbReligion = '';
$radiogender = '';
$txtOtherNationality = '';
$radioMigrant = '';
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
	$txtOtherNationality = isset($allOtherInfo['Nationality']) ? $allOtherInfo['Nationality'] : ''; 
	$cmbReservedCategory = $row['category'];
	$radioHandicapped = $row['is_physically_challanged'];
	$radiominority = $row['is_minority_community'];
	$cmbMinority = $row['minority_community_details'];
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
}
foreach($present_communication_data as $row)
{
	$txtPresentAddress = $row['address_1'];
	$txtPresentLocality = $row['address_2'];
	$txtPresentPost = $row['post_office'];
	$cmbPresentDist = $row['district_code'];
	$cmbPresentState = $row['state_code'];
	$txtPresentPin = $row['pin'];
	$txtPresentDistance = $row['distance_from'];
	$txtOtherPresentDistrict = isset($allOtherInfo["Present District"]) ? $allOtherInfo["Present District"] : ''; 
	$txtOtherPresentState = isset($allOtherInfo["Present State"]) ? $allOtherInfo["Present State"] : ''; 
}
foreach($permanent_communication_data as $row)
{
	$txtPermenentAddress = $row['address_1'];
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
	//alert(securedMarks);
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
		document.getElementById("txtPermenentAddress").value=document.getElementById("txtPresentAddress").value;
		document.getElementById("txtPermenentLocality").value=document.getElementById("txtPresentLocality").value;
		document.getElementById("txtPermanentPost").value=document.getElementById("txtPresentPost").value;
		document.getElementById("cmbPermanentDist").value=document.getElementById("cmbPresentDist").value;
		document.getElementById("cmbPermanentState").value=document.getElementById("cmbPresentState").value;
		document.getElementById("txtPermanentPin").value=document.getElementById("txtPresentPin").value;
		if(document.getElementById("cmbPermanentState").value == 'OTH')
		{
			$("#forStatePermanent").show();
			document.getElementById("txtOtherPermanentState").value=document.getElementById("txtOtherPresentState").value;
		}
		else
		{
			$("#forStatePermanent").hide();
			document.getElementById("txtOtherPermanentState").value='';
		}
		if(document.getElementById("cmbPermanentDist").value == 'OTH')
		{
			$("#forDistPermanent").show();
			document.getElementById("txtOtherPermanentDist").value=document.getElementById("txtOtherPresentDistrict").value;
		}
		else
		{
			$("#forDistPermanent").hide();
			document.getElementById("txtOtherPermanentDist").value='';
		}
		$('#txtPermenentAddress').attr('disabled', true);
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
		document.getElementById("txtPermenentAddress").value = "";
		document.getElementById("txtPermenentLocality").value = "";
		document.getElementById("txtPermanentPost").value = "";
		document.getElementById("cmbPermanentDist").value = "";
		document.getElementById("cmbPermanentState").value = "";
		document.getElementById("txtPermanentPin").value = "";
		$("#forStatePermanent").hide();
		$("#forDistPermanent").hide();
		document.getElementById("txtOtherPermanentState").value = "";
		document.getElementById("txtOtherPermanentDist").value = "";
		$('#txtPermenentAddress').removeAttr("disabled");
		$('#txtPermenentLocality').removeAttr("disabled");
		$('#txtPermanentPost').removeAttr("disabled");
		$('#cmbPermanentDist').removeAttr("disabled");
		$('#cmbPermanentState').removeAttr("disabled");
		$('#txtPermanentPin').removeAttr("disabled");
		$('#txtOtherPermanentState').removeAttr("disabled");
		$('#txtOtherPermanentDist').removeAttr("disabled");
	}
}
function validate()
{
	var errorMessage = "";
	var message = '<div>';
	var d=document.getElementById("cmbDay").value;
	//alert(d);
	var m=document.getElementById("cmbMonth").value;
	//alert(m);
	var y=document.getElementById("cmbYear").value;
	var dobInWord=dateToWord(d,m,y);
	//alert(dobInWord);
	document.getElementById("hidDate").value=dobInWord;
	if (document.getElementById('radioyes').checked) {
		if(document.getElementById("cmbReservedCategory").value == "")
		{
			errorMessage += "Please select Reserved Category from the dropdown.<br/>";
		}
	}
	if(document.getElementById("chksameasresidential").checked)
	{
		
	}
	else
	{
		//alert("hello");
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
	if(document.getElementById("txtMS1").value != '')
	{
		//alert(document.getElementById("txtMS1").value);
		//alert(document.getElementById("txtFM1").value);
		if(parseInt(document.getElementById("txtMS1").value) > parseInt(document.getElementById("txtFM1").value) )
		{
			errorMessage += "Secured marrk can not be greater than Total mark for 1st Qualification<br/>";
		}
	}
	if(document.getElementById("txtMS2").value != '')
	{
		if(parseInt(document.getElementById("txtMS2").value) > parseInt(document.getElementById("txtFM2").value ))
		{
			errorMessage += "Secured mark can not be greater than Total mark for 2nd Qualification<br/>";
		}
	}
	if(document.getElementById("txtMS3").value != '')
	{
		if(parseInt(document.getElementById("txtMS3").value) > parseInt(document.getElementById("txtFM3").value ))
		{
			errorMessage += "Secured marrk can not be greater than Total mark for 3rd Qualification<br/>";
		}
	}
	/*if(document.getElementById("txtSecuredMarks").value != '')
	{
		if(parseInt(document.getElementById("txtSecuredMarks").value) > parseInt(document.getElementById("txtTotalMarks").value ))
		{
			errorMessage += "Secured marrk can not be greater than Total mark for Qualifying degree<br/>";
		}
	}*/
	/*if(document.getElementById("txtHonsSecuredMarks").value != '')
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
		window.scrollTo(0,0);
		return false;	 
	}
	else
	{
		return true;
	}
		
}
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
  
	<link href="<?=base_url()?>public/assets/css/extra-style.css" rel="stylesheet" />
	<link href="<?=base_url()?>public/assets/css/datepicker3.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.css" />
	<div class="container" style="margin-top: 20px; padding-bottom: 50px;">
	  
		<div class="row">

			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">
					<div class="panel-heading project-heading" align="center" >
						<h2 class="panel-title" style="font-size: 20px"><b><a href="<?=base_url()?>apply/project_index/program/<?=$admcode?>/ins/<?=$ins?>"><?php echo $admname; ?></a></b></h2>
					</div>
				
				</div>
				
<?php 
	if($edit == 'true') 
	{ 
		if($appl_status == 'Student Details Submitted') 
		{ 
?>
			<img src="<?=base_url()?>public/assets/images/studentdetails.png" />
			<a href="<?=base_url()?>Admin_apply/apply_3/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/documentupload1.png" /></a>
						
<?php 
		} 
		else if($appl_status == 'Document Uploaded' || $appl_status == 'Challan Generated' ) 
		{ 
?>
							
							<img src="<?=base_url()?>public/assets/images/studentdetails.png" />
							<a href="<?=base_url()?>Admin_apply/apply_3/ins/<?=$ins?>" ><img src="<?=base_url()?>public/assets/images/documentupload.png" /></a>
							<a href="<?=base_url()?>Admin_apply/apply_4/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/payment1.png" /></a>
						
<?php 
		} 
		else if($appl_status == 'Fee Paid' || $appl_status == 'Verified') 
		{ 
?>
							<img src="<?=base_url()?>public/assets/images/studentdetails.png" />
							<a href="<?=base_url()?>Admin_apply/apply_3/ins/<?=$ins?>" ><img src="<?=base_url()?>public/assets/images/documentupload.png" /></a>
							<a href="<?=base_url()?>Admin_apply/apply_4/ins/<?=$ins?>"><img src="<?=base_url()?>public/assets/images/payment.png" /></a>
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

							<b><i class="fa fa-user"></i> Applications Form</b>
					</div>
					<a href="#" class="pull-right" style="margin-top: -4.3%;margin-right: 0.2%" id="btnInstruction" name="btnInstruction" title="Help"><img type="button" src="<?=base_url()?>public/assets/images/helpicon.png" name="btnInstruction" title="Help" id="btnInstruction" style="width:50px;height:50px;cursor:pointer"></img></a>
					<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;"> <!-- Alert for error -->
						<div id="alertmessage"></div>
					</div>
			
					
				<div class="panel panel-default">	
					<div class="panel-body">
								<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
								   <?php include_once(dirname(dirname(__FILE__)) . '/template_config/alerts.php');?>
								  <form class="form-horizontal" method="post" role="form" id="frmApply" name="frmApply" >
										<div class="form-group">
											<input type="hidden" name="hidDate" id="hidDate" >
										</div>
										<div class="form-group">
								
											<label for="" class="col-sm-3 control-label" style="text-align:left;" ><i style="color:red;" class="glyphicon glyphicon-asterisk"></i> Registered Mobile Number :</label>
											<div class="col-sm-2">
												<input type="text" class="form-control"  value="<?=$reg_user_id?>" disabled/>
											</div>
											<label for="txtDOB" class="col-sm-2 control-label" style="margin-top:-5px;text-align:left;">Date of Birth :</label>
											<div class="col-sm-5">
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
										<div style="border:1px solid #ddd; background-color: #fcf3cf;color:black;font-size:14px;font-weight:normal">
											<div class="form-group" style="margin-top: -20px" >
												<div class="col-sm-12 panel-heading" style="margin-top: -15px">
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
																<input type="text" class="form-control" id="txtFirstName" name="txtFirstName" placeholder="Enter First Name" readonly="readonly"  value="<?=strtoupper($txtFirstName)?>">
															</div>
														</td>
														<td>
															<label for="" class="control-label" >Middle Name</label>
														</td>
														<td>
															<div class="form-group">
																<input type="text" class="form-control" id="txtMiddleName" name="txtMiddleName" placeholder="Enter Middle Name" readonly="readonly" value="<?=strtoupper($txtMiddleName)?>">
															</div>
														</td>
														<td>
															
															<label for="" class="control-label" ><i style="color:red;font-size:18px;">*</i> Last Name</label>
															
														</td>
														<td>
															<div class="form-group">
																<input type="text" class="form-control" id="txtLastName" name="txtLastName" placeholder="Enter Last Name"  value="<?=strtoupper($txtLastName)?>" readonly="readonly">
															</div>
														</td>	
													</tr>
													<tr>
														<td>
															<label for="" class="control-label" ><i style="color:red;font-size:18px;">*</i> Sex</label>
														</td>
														<td colspan="2">
															<div class="form-group">
															<label class="radio-inline">
																<input type="radio" name="radiogender" id="radiomale" value="M" <?php if($radiogender=="M") { echo "checked"; } ?>> Male
															</label>
															<label class="radio-inline">
																<input type="radio" name="radiogender" id="radiofemale" value="F" <?php if($radiogender=="F") { echo "checked"; } ?> > Female
															</label>
															<label class="radio-inline">
																<input type="radio" name="radiogender" id="radiofemale" value="F" <?php if($radiogender=="T") { echo "checked"; } ?>> Transgender
															</label>
															</div>
														</td>
														<td>
															<label for="" class="control-label" ><i style="color:red;font-size:18px;">*</i> Nationality</label>
														</td>
														<td>
															<div class="form-group">
																<select class="form-control" name="cmbNationality" id="cmbNationality" >
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
															<div id="forNationality" style="display:none;">
																<input type="text" class="form-control" id="txtOtherNationality" name="txtOtherNationality" placeholder="Please Specify" value="<?=$txtOtherNationality?>">
															</div>
														</td>
													</tr>
													<tr>
														<td colspan="2">
															<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:18px;">*</i> Are you a Kashmiri Migrant? :</label>
														</td>
														<td colspan="2">
															<label class="radio-inline">
																<input type="radio"  name="radioMigrant" id="radioMigrant" value="NO" <?php if($radioMigrant=="NO") { echo "checked"; } ?>> No
															</label>
															<label class="radio-inline">
																<input type="radio" name="radioMigrant" id="radioMigrant" value="YES" <?php if($radioMigrant=="YES") { echo "checked"; } ?>> Yes
															</label>
														</td>
														<td></td>
														<td></td>
														<td></td>
													</tr>
													<tr id="forAdharNo">
														<td>
															<label for="" class="control-label" style="text-align:left;"> Aadhaar No :</label>
														</td>
														<td colspan="3">
															<div class="form-group">
																<input type="text" class="form-control" id="txtUid" name="txtUid" placeholder="Aadhaar No" maxlength="12"  value="<?=$txtUid?>">
															</div>
														</td>
														<td></td>
														<td></td>
													</tr>
													<tr>
														<td>
															<label for="marital" class="control-label" style="margin-top:-5px;" ><i style="color:red;font-size:18px;">*</i> Marital Status :</label>
														</td>
														<td colspan="3">
															<div class="form-group">
																<label class="radio-inline">
																	<input type="radio" name="radiomaritalstatus" id="radioMarried" value="Married" <?php if($radiomaritalstatus=="Married") { echo "checked"; } ?>> Married
																</label>
																<label class="radio-inline">
																	<input type="radio" name="radiomaritalstatus" id="radioUnmarried" value="Unmarried" <?php if($radiomaritalstatus=="Unmarried") { echo "checked"; } ?>> Unmarried
																</label>
															</div>
														</td>
														<td>
															
														</td>
														<td>
															
														</td>
													</tr>
													<tr>
														<td>
															<label for="" class="control-label" ><i style="color:red;font-size:18px;">*</i> Father/Guardian's Name</label>
														</td>
														<td colspan="3">
															<div class="form-group">
																<input type="text" class="form-control" id="txtFatherName" name="txtFatherName" placeholder="Enter Father Name" onkeydown="changeCase(this)" onkeyup="changeCase(this)" onblur="changeCase(this)" onclick="changeCase(this)" value="<?=strtoupper($txtFatherName)?>">
															</div>
														</td>
														<td>
															
														</td>
														<td>
															
														</td>
													</tr>
													<tr>
														<td>
															<label for="" class="control-label" ><i style="color:red;font-size:18px;">*</i> Mother's Name</label>
														</td>
														<td colspan="3">
															<div class="form-group">
																<input type="text" class="form-control" id="txtMotherName" name="txtMotherName" placeholder="Enter Mother Name" onkeydown="changeCase(this)" onkeyup="changeCase(this)" onblur="changeCase(this)" onclick="changeCase(this)" value="<?=strtoupper($txtMotherName)?>">
															</div>
														</td>
														<td>
															
														</td>
														<td>
															
														</td>
													</tr>
												</table>
											</div>
										</div>
										
										<div style="border:1px solid #ddd; background-color:#e8fac5;color:black;font-size:14px;font-weight:normal;">
											<div class="form-group" style="margin-top: -20px" >
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
													<label for="" class="control-label" >Plot/House No/At/Apartment Name</label>
												</td>
												<td>
													<div class="form-group col-sm-9">
														<input type="text" class="form-control" name="txtPresentAddress" id="txtPresentAddress" value="<?=$txtPresentAddress?>">
													</div>												
												</td>
												<td>
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												</td>
												<td>
													<label for="" class="control-label" >Locality/Street Name</label>
												</td>
												<td>
													<div class="form-group ">
														<input type="text" class="form-control" name="txtPresentLocality" id="txtPresentLocality" value="<?=$txtPresentLocality?>">
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
														<input type="text" class="form-control" name="txtPresentPost" id="txtPresentPost" value="<?=$txtPresentPost?>">
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
														<select name="cmbPresentState" id="cmbPresentState" class="form-control">
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
													<span id="spanState" hidden><img src="<?=base_url()?>public/assets/images/bx_loader.gif"/></span>
												</td>
											</tr>
											<tr>
												<td>
													<label for="" class="control-label" >District</label>
												</td>
												<td>
													<div class="form-group col-sm-9">
														<select name="cmbPresentDist" id="cmbPresentDist" class="form-control">
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
														<input type="text" class="form-control" id="txtOtherPresentDistrict" name="txtOtherPresentDistrict" placeholder="Please Specify" value="">
													</div>
												</td>
												<td>
													<label for="" class="control-label" >PIN</label>
												</td>
												<td>
													<div class="form-group">
														<input type="text" class="form-control" name="txtPresentPin" id="txtPresentPin" onkeypress="return isNumberKey(event)" maxlength="6" value="<?=$txtPresentPin?>">
													</div>												
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
													
														<input type="checkbox" id="chksameasresidential" name="chksameasresidential" value="Y" onclick="setSameAddress();" <?php if($chksameasresidential=="Y") { echo "checked"; } ?>> 
														Permanent address is same as Present address
													
												</div>
											</div>
												<table class="table table-striped">
											<tr>
												<td>
													<label for="" class="control-label" >Plot/House No/At/Apartment Name</label>
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
													<label for="" class="control-label" >Locality/ Street Name</label>
												</td>
												<td>
													<div class="form-group ">
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
														<input type="hidden"  name="hidOtherPermanentState" id="hidOtherPermanentState" value="" />
														<input type="text" class="form-control" id="txtOtherPermanentState" name="txtOtherPermanentState" placeholder="Please Specify" value="" >
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
														<div class="form-group">
															<input type="hidden"  name="hidOtherPermanentDist" id="hidOtherPermanentDist" value="" />
															<input type="text" class="form-control" id="txtOtherPermanentDist" name="txtOtherPermanentDist" placeholder="Please Specify" value="" >
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
											<tr>
												<td>
													<label for="" class="control-label" >Parent\'s /Guardian\'s Telephone / Mob. No </label>
												</td>
												<td>
													<div class="form-group col-sm-9">
														<input type="text" class="form-control" maxlength="12" onkeypress="return isNumberKey(event)"  name="txtPermanentMobile" id="txtPermanentMobile" value="<?=$txtPermanentMobile?>" />
														
													</div>												
												</td>
												<td>
													
												</td>
												<td>
													
												</td>
												<td>
																									
												</td>
												<td>
													
												</td>
											</tr>
										</table>
											</div>																																																																																																									
										</div>
										<div style="border:1px solid #ddd; background-color:#d6dbdf;color:black;font-size:14px;font-weight:normal;">
											<div class="form-group" style="margin-top: -20px" >
												<div class="col-sm-12" style="margin-top: -5px">
													<h3 class="section-header">3. Academic Information</h3>
												</div>
											</div>
											<div class="panel-body">
												<table class="table table-striped" >
													<tr>
														<td>
															<label for="" class="control-label" style="text-align:left;">Berhampur University Registration No. :</label>
														</td>
														<td>
															<div class="form-group">
																<input type="text" class="form-control" id="txtUnivRegNo" name="txtUnivRegNo" placeholder="University Registration No" onkeydown="changeCase(this)"  value="<?=$txtUnivRegNo?>">
																
															</div>
														</td>
														<td>
															<label for="" class="control-label" style="text-align:left;"> (Applicable for students of Berhampur University)</label>
														</td>
													</tr>
													<tr>
														<td>
															<label for="" class="control-label" style="text-align:left;">Whether Admission is Claimed Under Any Reserved Quota?</label>
														</td>
														<td>
															<div class="form-group">
																<label class="radio-inline">
															<input type="radio" name="radioQuota" id="radiono" value="No" <?php if($radioQuota=="No") { echo "checked"; } ?>> No
														</label>
														<label class="radio-inline">
															<input type="radio" name="radioQuota" id="radioyes" value="Yes" <?php if($radioQuota=="Yes") { echo "checked"; } ?>> Yes
														</label>
															</div>
														</td>
														<td>
															<div id="forReservedQuota">
																<select class="form-control" id="cmbReservedCategory" name="cmbReservedCategory" placeholder="Reserved Category">
																	<option value=''>Select Reserved Category</option>
				<?php
					foreach($allCategories as $row)
					{
						$x = ($cmbReservedCategory == $row['category_code'] ? ' selected ' : '');
						echo "<option value='".$row['category_code']."' $x>".$row['category_name']."</option>";
					} 
				?>													
																</select>
															</div>
														</td>
													</tr>
												</table>																																																																																								
																																																						
																																																																																										
												<div class="form-group">
													
													<div class="col-sm-12">
														 <h4><b><i class="glyphicon glyphicon-asterisk" style="color:red;font-size:10px;"></i> Educational Qualification</b></h4>
													</div>
													<div class="col-sm-12">
														
														<table  class="table table-bordered table-striped">
															<tr>
																<th style="text-align:center;">Name of the Examination</th>
																<th style="text-align:center;">Year</th>
																<th style="text-align:center;">Board/University</th>
																<th style="text-align:center;">Division</th>
																<th style="text-align:center;">Mark Secured</th>
																<th style="text-align:center;">Maximum Marks</th>
																<th style="text-align:center;">% of Marks</th>
															</tr>
		<?php
		$sl_no =1;
		foreach($allQualifications as $row)
		{
			$division = $row['division'];
			$all_division = explode(',',$division);
		?>
															<tr>
																<td><input type="text" class="form-control input-sm" name="txtQualification<?=$sl_no?>" id="txtQualification<?=$sl_no?>" value="<?=$row['qualification_name']?>"  readonly="readonly"/></td>
																<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtYear<?=$sl_no?>" name="txtYear<?=$sl_no?>" onkeypress="return isNumberKey(event)" maxlength="4"   value="<?php echo ${'txtYear'.$sl_no} == 'NULL'?'':${'txtYear'.$sl_no}; ?>" /></div></td>
																<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtBoard<?=$sl_no?>" name="txtBoard<?=$sl_no?>" value="<?=${'txtBoard'.$sl_no}?>" onkeydown="changeCase(this)" onkeyup="changeCase(this)" onblur="changeCase(this)" onclick="changeCase(this)"/></div></td>
																<td>
																	<div class="form-group">
																	<select name="txtDivision<?=$sl_no?>" class="form-control" id="txtDivision<?=$sl_no?>">
																		<option value="">Select</option>
			<?php 
			for($i = 0; $i< count($all_division); $i++ )
			{
			?>
																			<option value="<?=$all_division[$i]?>" <?php if(${'txtDivision'.$sl_no} == "$all_division[$i]") echo 'selected';?>><?=$all_division[$i]?></option>
			<?php
			}
			?>

																	</select>
																	</div>
																</td>
																
																<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtMS<?=$sl_no?>" name="txtMS<?=$sl_no?>" value="<?php echo ${'txtMS'.$sl_no} == 'NULL'?'':${'txtMS'.$sl_no}; ?>" onkeypress="return isNumberKey(event)" onblur="calculatePercentage(<?=$sl_no?>)" /></div></td>
																<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtFM<?=$sl_no?>" name="txtFM<?=$sl_no?>" value="<?php echo ${'txtFM'.$sl_no} == 'NULL'?'':${'txtFM'.$sl_no}; ?>" onkeypress="return isNumberKey(event)" onblur="calculatePercentage(<?=$sl_no?>)" /></div></td>
																<td><div class="form-group"><input type="text" class="form-control input-sm" readonly id="txtPercent<?=$sl_no?>" name="txtPercent<?=$sl_no?>" value="<?php echo ${'txtPercent'.$sl_no} == 'NULL'?'':${'txtPercent'.$sl_no}; ?>" onfocus="calculatePercentage(<?=$sl_no?>)"/></div></td>
																
															</tr>
		<?php
		$sl_no++;
		}
		?>
		
															<tr>
																<td><input type="text" class="form-control input-sm" placeholder="Any Other" name="txtQualification3" id="txtQualification3" value="<?=$txtQualification3?>"  /></td>
																<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtYear3" name="txtYear3" onkeypress="return isNumberKey(event)" maxlength="4"   value="<?php echo $txtYear3 == 'NULL'?'':$txtYear3; ?>" /></div></td>
																<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtBoard3" name="txtBoard3" value="<?=$txtBoard3 ?>" onkeydown="changeCase(this)" onkeyup="changeCase(this)" onblur="changeCase(this)" onclick="changeCase(this)"/></div></td>
																<td>
																	<div class="form-group">
																		<select name="txtDivision3" class="form-control" id="txtDivision3">
																			<option value="">Select</option>
																			<option value="1st" <?php if($txtDivision3 == '1st') echo "selected";?> >1st</option>
																			<option value="2nd" <?php if($txtDivision3 == '2nd') echo "selected";?> >2nd</option>
																			<option value="3rd" <?php if($txtDivision3 == '3rd') echo "selected";?> >3rd</option>
																		</select>
																	</div>
																</td>
																
																<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtMS3" name="txtMS3" value="<?php echo $txtMS3 == 'NULL'?'':$txtMS3; ?>" onkeypress="return isNumberKey(event)" onblur="calculatePercentage(3)"/></div></td>
																<td><div class="form-group"><input type="text" class="form-control input-sm" id="txtFM3" name="txtFM3" value="<?php echo $txtFM3 == 'NULL'?'':$txtFM3; ?>" onkeypress="return isNumberKey(event)" onblur="calculatePercentage(3)"/></div></td>
																<td><div class="form-group"><input type="text" readonly class="form-control input-sm" id="txtPercent3" name="txtPercent3" value="<?php echo $txtPercent3 == 'NULL'?'':$txtPercent3 ;?>" onfocus="calculatePercentage(3)"/></div></td>
																
															</tr>
														</table>
													</div>
												</div>
												<table class="table table-striped" >
													<tr>
														<td >
															<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:18px;">*</i> Whether Interested to Apply for Hostel Accommodation ? :</label>
														</td>
														<td>
															<div class="form-group" style="text-align:left;">
																<label class="radio-inline">
																	<input type="radio" name="radioHostel" id="radioYesHostel" value="Yes" <?php if($radioHostel=="Yes") { echo "checked"; } ?>> Yes
																</label>
																<label class="radio-inline">
																	<input type="radio" name="radioHostel" id="radioNoHostel" value="No" <?php if($radioHostel=="No") { echo "checked"; } ?>> No
																</label>
															</div>
														</td>
														<td>
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														</td>
													</tr>
													<tr>
														<td>
															<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:18px;">*</i> Distance between Berhampur University and your present address :</label>
														</td>
														<td>
															<div class="form-group">
																<input type="text" class="form-control" maxlength="12"  onkeypress="return isNumberKey(event)"  name="txtPresentDistance" id="txtPresentDistance" value="<?=$txtPresentDistance?>" />
															</div>
															
														</td>
														<td>
															<label for="" class="control-label" >(in KMs)</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														</td>
													</tr>
												</table>																																																				
											</div>																																																				
										</div>
										<div style="border:1px solid #ddd; background-color:#ebdef0;color:black;font-size:14px;font-weight:normal;">
										<div class="form-group" style="margin-top: -20px">
											<div class="col-sm-12" style="margin-top: -5px">
												<h3 class="section-header">4. Declaration</h3>
											</div>
										</div>
										<!-- <div class="form-group">
											<div class="col-sm-12">
													<input type="checkbox" hidden="hidden" name="chkUndertaking1" id="chkUndertaking1" value="1" checked="checked" >
														 1. I declare that the particulars furnished in this form are true to the best of my knowledge and belief and as per my certificates and valid official documents. I further declare that in case any of the above information is found to be incorrect at any time, I shall be liable to forfeit my seat and to such penal action as the University may deem appropriate.
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-12">
													<input type="checkbox" hidden="hidden" name="chkUndertaking2" id="chkUndertaking2" value="2" checked="checked" >
														2. I undertake to abide by the rules of the P.G. Council and P.G. Hostels, framed by the Berhampur University and if at any time, in any instance of breach of these rules, indiscipline, disobedience or misconduct or involvement in ragging is found against me, my name shall be struck off from the rolls of the University.
											</div>									
										</div> -->
										<div class="form-group">
											<div class="col-sm-12">
													<input type="checkbox" hidden="hidden" name="chkUndertaking3" id="chkUndertaking3" value="3" checked="checked" >
														3. I have understood the various provisions and rules of eligibility and admission to various P.G. Departments of Berhampur University as mentioned in the Prospectus along with the application form and I undertake to abide by any decision taken by the University authorities in regard to my eligibility and admission into P.G. Departments.
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-12" id="divDecGuardian">
													<input type="checkbox"  name="chkUndertakingAll" id="chkUndertakingAll"  checked>
														  <b>I Accept All the Above Terms & Conditions .</b>
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
										<?php if($show == 1) { ?>
										<div class="form-group">
											<div class="col-lg-offset-5 col-lg-3">
												<button type="submit" class="btn btn-primary" id="btnPersonalInfoEdit" name="btnPersonalInfoEdit"  onclick="return validate();" >Save & Next</button>
											</div>
										</div>	
										<?php } ?>
									</form>
								</div>
							
					</div><!--Panel Body-->
				</div><!--Panel Default-->
			</div><!--/col-lg-12-->
		</div>
	</div>
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