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
$admname='';
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
$allQualifications='';
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

//********************************************* Details in template *******************************//


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="https://gov.silicontechlab.com/cmss_new/wp-content/themes/suppliers/favicon.png">
    
    <meta http-equiv="Content-Language" content="hi">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Online Recruitment</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <!-- Bootstrap 3.3.7 -->
	  <!-- Bootstrap core CSS -->
	<link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/css/AdminLTE.min.css">
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/animate.css">
   	<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/font-awesome/css/font-awesome.min.css">
   	<link href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/css/bootstrapValidator.css" rel="stylesheet" type="text/css"/>
   	<!--<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/datepicker3.css">-->
   	<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/sweetalert/sweetalert.css"></link>
   	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.css" />
	<!-- Custom styles for this template -->
    <script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
    
	<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/bootstrap-datepicker.js" ></script>
	<!-- Sweet Alert Plugin -->
	<script src="<?php echo base_url(); ?>public/template_lib/plugins/sweetalert/sweetalert.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="<?=base_url()?>public/assets/css/datepicker3.css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrapValidator.js"></script>
    <!-- Toaster Plugin -->
	<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.js"></script>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118010124-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-118010124-1');
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
		.panel-primary > .panel-heading{
			background-color : #a94442;
			border-color : #a94442;
		}
		.panel-primary{
			border-color : #a94442;
		}
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
		  background-color: #318f94;
		  border-color: #318f94;
		}
		.btn-warning:focus,
		.btn-warning:active,
		.btn-warning.active,
		.btn-warning {
		  color: #fff;
		  background-color: #5ec58c;
		  border-color: #5ec58c;
		}
		
		.btn-primary:hover{
		  color: #fff;
		  background-color: #8f1799;
		  border-color: #8f1799;
		}
		.btn-primary:focus,
		.btn-primary:active,
		.btn-primary.active,
		.btn-primary {
		   color: #fff;
		  background-color: #8f1799;
		  border-color: #8f1799;
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
		    border-color:#5ec58c;
			margin-top: 10px;
		}
		legend{
			width: 15%;
			margin-left: 43%;
			border-bottom: 0px;
			color:#fff;
			background: linear-gradient(to right, #318f94 0%, #5ec58c 100%);
			border-radius: 6px;
			text-align: center;
		
		}
		label {
		  display: inline-block;
		  max-width: 100%;
		  margin-bottom: 5px;
		  font-weight:normal;
		}
		.control-label {

		    color: #000;
		    padding-top: 3px;

		}
		fieldset:hover {
		    background-color: #fff;;
		    box-shadow: 0 4px 6px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
		}
		ul { padding-left:20px; list-style:none; }
		.news li { margin-bottom:35px; font-size:19px;}
		.news li:before {    
			font-family: 'FontAwesome';
			content: "\f101";
			margin:0 5px 0 -15px;
			color:#9D426B;
			font-size:19px;
		}
		.btn-primary
		{
			background-color:#002364;
		}
		.box
		{
		 
		  margin: 0px 0px 30px 0px;
		  float: left;
		  width: 90%;
		  height:140px;
		  font-size: 14px;
		  margin:14% 0 -58% 0px;
		  background-color: #EDB604;
		  overflow:hidden;
		  opacity:0.9;
		  border: 1px groove;
		  
		}
		.img-circle 
		{
    		border-radius: 50%;
			background-color:#ffffff;
		}
		.msgbox
		{
		 
		  margin: 0px 0px 30px 0px;
		  float: left;
		  width: 98%;
		  height:100px;
		  font-size: 14px;
		  margin:0px 0 -58% 0px;
		  background-color: #EDB604;
		  overflow:hidden;
		  opacity:0.5;
		  border: 1px groove;
		  
		}
		.box-content
		{
		  color: #000000;
		  padding: 3px;
		  z-index: 20;
		}
		.control-label
		{
			 color: #002364;
			 padding-top:3px;
		}
		.horizontalsearchbar {
		    background: #ABED04 none repeat scroll 0 0;
		    border-bottom: 1px solid #dedede;
		    height: 50px;
		    opacity: 0.7;
		    padding: 10px 0 0 17px;
		    width: 94%;
			z-index:10;
			margin-left:3%;
			border-radius:10px; 
			border:1px solid #d3d3d3;
		}
		#loginBarHandle {
		    color: #f2faf7;
		    font-size: 11px;
		    line-height: 20px;
		    text-align: center;
		}
		#loginBarHandle {
		    background-color: #022a17;
		    border-bottom-left-radius: 10px;
		    border-bottom-right-radius: 10px;
		    bottom: -20px;
		    box-shadow: 0 2px 5px #022a17;
		    color: #f2faf7;
		    font-size: 13px;
		    line-height: 20px;
		    margin-right: 20px;
		    padding: 0 10px;
		    position: absolute;
		    right: 0;
		    text-align: center;
		    z-index: 1;
		}
		#loginBar {
		    background-color: #022a17;
		    color: #f2faf7;
		    font-size: 13px;
		    line-height: 20px;
		    margin-right: 20px;
		    padding: 0 10px;
		    position: absolute;
		    right: 0;
		    text-align: center;
		    z-index: 1;
		}
		#header-data{
		    padding-top: -20px;
		}
		/*login flash error show*/
		.alert-danger {
			color: #E4791A;
			background-color: rgba(242, 222, 222, 0);
			border-color: rgba(242, 222, 222, 0);
		}
		.alert-success {
		    color: #3C763D;
			background-color: rgba(242, 222, 222, 0);
			border-color: rgba(242, 222, 222, 0);
		}
		.alert {
		    padding: 0px;
		    margin-bottom: 20px;
		    border: 1px solid transparent;
		    border-radius: 4px;
		    text-align: center;
		}
		.link a:hover{
			color:#FFF;
		}
		.nav > li > a:hover, .nav > li > a:active, .nav > li > a:focus {
		    color: #444;
		    background: none !important;
		}
		.nav > li > a:hover, .nav > li > a:active, .nav > li > a:focus {
		    color: #444;
		    background: none !important;
		}
		.nav > li > a:hover, .nav > li > a:focus {
		    text-decoration: none;
		    background-color: none !important;
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
	if ((document.getElementById('cmbExamCenter').value == '') || (document.getElementById('cmbHomeDist').value == '') || (document.getElementById('txtMotherName').value == '') || ((document.getElementById("txtidproof").value == '') ) || ((document.getElementById('radioPhysicallYY').checked) && (document.getElementById("cmbPH").value == "")) || ((document.getElementById("chksameasresidential").checked  == false) && ((document.getElementById("txtPermanentPin").value == '') || (document.getElementById("city_name").value == '') || (document.getElementById("cmbPermanentState").value == '') || (document.getElementById("cmbPresentDist").value == '') || (document.getElementById("txtPermanentPost").value == '') || (document.getElementById("txtPermenentLocality").value == ''))) || (document.getElementById("txtPresentPin").value == '') || (document.getElementById("city_name").value == '') || (document.getElementById("cmbPresentState").value == '') || (document.getElementById("cmbPresentDist").value == '') || (document.getElementById("txtPresentPost").value == '') || (document.getElementById("txtPresentLocality").value == '') || (document.getElementById('txtFatherName').value == '') || (document.getElementById('txtMotherName').value == '') || (document.getElementById('cmbCommunity').value == null) ||  (document.getElementById('radioPhysicallYN').checked == false && document.getElementById('radioPhysicallYY').checked == false) || (document.getElementById('cmbCommunity').value == '' || document.getElementById('cmbCommunity').value == null) ) {
		var str = "Please enter - ";
		if((document.getElementById('cmbExamCenter').value == ''))
		{
			str += " exam center,";
		}
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
		}
		if((document.getElementById('cmbHomeDist').value == '' || document.getElementById('cmbHomeDist').value == null))
		{
			str += " home district,";
		}
		if((document.getElementById('radioPhysicallYN').checked == false && document.getElementById('radioPhysicallYY').checked == false))
		{
			str += " PwD,";
		}
		if(((document.getElementById('radioPhysicallYY').checked) && (document.getElementById("cmbPH").value == "")))
		{
			str += " PwD,";
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
	if(((document.getElementById("txtYear8").value != '') && ((document.getElementById("txtBoard8").value == '') || (document.getElementById("txtgrading8").value == '') || (document.getElementById("txtPercent8").value == '') || (document.getElementById("txtdistinct8").value == ''))) || ((document.getElementById("txtYear7").value != '') && ((document.getElementById("txtBoard7").value == '') || (document.getElementById("txtgrading7").value == '') || (document.getElementById("txtPercent7").value == '') || (document.getElementById("txtdistinct7").value == ''))) || ((document.getElementById("txtYear6").value != '') && ((document.getElementById("txtBoard6").value == '') || (document.getElementById("txtgrading6").value == '') || (document.getElementById("txtPercent6").value == '') || (document.getElementById("txtdistinct6").value == ''))) || ((document.getElementById("txtYear5").value != '') && ((document.getElementById("txtBoard5").value == '') || (document.getElementById("txtgrading5").value == '') || (document.getElementById("txtPercent5").value == '') || (document.getElementById("txtdistinct5").value == ''))) || ((document.getElementById("txtExamName1").value != '') && ((document.getElementById("txtStream1").value == '') || (document.getElementById("txtYearQual1").value == '') || (document.getElementById("txtBoardOth1").value == '') || (document.getElementById("txtCGPA1").value == ''))) ||((document.getElementById("txtExamName2").value != '') && ((document.getElementById("txtStream2").value == '') || (document.getElementById("txtYearQual2").value == '') || (document.getElementById("txtBoardOth2").value == '') || (document.getElementById("txtCGPA2").value == ''))) || (document.getElementById("txtPercent1").value == '') || (document.getElementById("txtPercent2").value == '') || (document.getElementById("txtPercent4").value == '') || (document.getElementById("txtPercent3").value == '') || (document.getElementById("txtgrading1").value == '') || (document.getElementById("txtgrading2").value == '') || (document.getElementById("txtgrading4").value == '') || (document.getElementById("txtgrading3").value == '') || (document.getElementById("txtBoard1").value == '') || (document.getElementById("txtBoard2").value == '') || (document.getElementById("txtBoard4").value == '') || (document.getElementById("txtBoard3").value == '') || (document.getElementById("txtYear1").value == '') || (document.getElementById("txtYear2").value == '') || (document.getElementById("txtYear4").value == '') ||  (document.getElementById("txtYear3").value == '') || (document.getElementById("txtqual22").value == '') || (document.getElementById("txtqual23").value == '') || (document.getElementById("txtqual24").value == ''))
	{
		
		var str = "Please enter - ";
		//errorMessage += "One / Some mandatory fields are not entered in Academic Details Tab.<br/>";
		
		if((document.getElementById("txtqual22").value == '') || (document.getElementById("txtqual23").value == '') || (document.getElementById("txtqual24").value == ''))
		{
			str += " stream for all qualifications till graduation,";
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
		a
		{
		    color: white;
		}
		/********************************************************************/
	</style>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.css" />
<head>
	    <meta charset="UTF-8">
	    <title>Superadmin | Dashboard</title>
	    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	    <link href="<?php echo base_url(); ?>public/assets/css/bootstrap_new.min.css" rel="stylesheet">
	    <link href="<?php echo base_url(); ?>public/template_lib/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
	    <link href="<?php echo base_url(); ?>public/assets/css/sb-admin.css" rel="stylesheet">
	    <link href="<?=base_url()?>public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?=base_url()?>public/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="<?=base_url()?>public/assets/css/datepicker3.css" rel="stylesheet" type="text/css" />
		<link href="<?=base_url()?>public/template_lib/plugins/jquery-ui-1.11.4/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
	    
	    <link href="<?=base_url()?>public/template_lib/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	    <link href="<?=base_url()?>public/template_lib/plugins/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	    <script src="<?php echo base_url(); ?>public/template_lib/plugins/metisMenu/jquery.metisMenu.js"></script>
		<script src="<?php echo base_url(); ?>public/assets/js/sb-admin.js"></script>
  </head>
<div class="container" style="margin-top: 90px; padding-bottom: 50px;">
	  
		<div class="row">
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
		
			<div class="panel with-nav-tabs panel-primary">
				<div class="panel-heading step-heading">
					
					<ul class="nav nav-tabs" role="tablist">
						<li id ="address_tab_div" class="active"><a href="#address_tab" data-toggle='tab'>Applicant Details</a></li>
						<li id ="academic_tab_div"><a href="#academic_tab" data-toggle='tab'>Academic Details</a></li>
						<li id ="info_tab_div"><a href="#info_tab" data-toggle='tab'>Information</a></li>
						<li id ="declaration_tab_div"><a href="#declaration_tab" data-toggle='tab'>Declaration</a></li>
					</ul>
					
				</div>
				
				<div class="panel-body">
					<form action="" method="post" id="frmApply" name="frmApply">
						<div class="tab-content">
						
							<input type="hidden" id="hidDateFormat" name="hidDateFormat" value=""/>
							<!-- first tab-->
						
							<div class="tab-pane in active" id="address_tab">
								<div>
									<input type="hidden" name="hidCatElig" id="hidCatElig" >
									<input type="hidden" name="hidDate" id="hidDate" >
									<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;margin-top: 20px;">
										<h3 style="text-align: center;margin-top: -6px;color: #666;"> Personal Details</h3>
										<div  class="row"  style="margin-top: 20px;">
											
											<div class="col-lg-4">
												<div class="form-group">
													<label for="" class="col-lg-5" style=""><i style="color:red;font-size:18px;">*</i> <i class="fa fa-globe" aria-hidden="true" style="color:#E4791A"></i> Exam Centre </label>
													<div class="col-lg-7">
														<select class="form-control" name="cmbExamCenter" id="cmbExamCenter"   <?php echo $show==1?'disabled':''; ?>>
															<option value=''>Select Exam Center</option>
															<?php 
															//print_r($select_exam_centre);die();
															/*foreach($choice_details_data as $row)
															{
																$x = ($exam_centre == $row['exam_centre_code'] ? ' selected ' : '');
																echo "<option value='".$row['exam_centre_code']."' $x>".$row['exam_centre_name']."</option>";
															} */
															?>
														</select>
													</div>
												</div>
											</div>
											
										</div>
										<!--************START OF NAME ROW**********--> 
										<div class="row" style="margin-top: 20px;">
											<div class="col-lg-4">
												<div class="form-group">
													<label for="" class="col-lg-5" ><i class="fa fa-user" style="color:#E4791A"></i> First Name</label>
													<div class="col-lg-7">
														<input type="text" class="form-control" id="txtFirstName" name="txtFirstName" placeholder="Enter First Name" readonly="readonly"  value="" <?php echo $show==1?'disabled':''; ?>>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label for="" class="col-lg-5" ><i class="fa fa-user" style="color:#E4791A"></i> Middle Name</label>
													<div class="col-lg-7">
														<input type="text" class="form-control test" id="txtMiddleName" name="txtMiddleName" placeholder="Enter Middle Name" readonly="readonly" value="" <?php echo $show==1?'disabled':''; ?>>
													</div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label for="" class="col-lg-5" ><i class="fa fa-user" style="color:#E4791A"></i> Last Name</label>
													<div class="col-lg-7">
														<input type="text" class="form-control" id="txtLastName" name="txtLastName" placeholder="Enter Last Name"  value="" readonly="readonly" <?php echo $show==1?'disabled':''; ?>>
													</div>
												</div>
											</div>
										</div>
										
										<div  class="row"  style="margin-top: 20px;">
											
											<div class="col-lg-6">
												<div class="form-group">
													<label for="" class="col-lg-5" style=""><i style="color:red;font-size:18px;">*</i> <i class="fa fa-male" aria-hidden="true" style="color:#E4791A"></i> Father's/Husband's Name </label>
													<div class="col-lg-7">
														<input type="text" class="form-control" id="txtFatherName" name="txtFatherName" placeholder="Enter Father's Name" onkeyup="changeCase(this)" maxlength="50" value="" <?php echo $show==1?'disabled':''; ?>>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label for="" class="col-lg-5" style=""><i style="color:red;font-size:18px;">*</i> <i class="fa fa-male" aria-hidden="true" style="color:#E4791A"></i> Mother's Name </label>
													<div class="col-lg-7">
														<input type="text" class="form-control" id="txtMotherName" name="txtMotherName" placeholder="Enter Mother's Name" onkeyup="changeCase(this)" maxlength="50" value="" <?php echo $show==1?'disabled':''; ?>>
													</div>
												</div>
											</div>
										</div>
										<div class="row" style="margin-top: 20px;">
											<div class="col-lg-6">
												<div class="form-group">
													<label for="txtDOB" class="col-lg-5" style="text-align:left;"><i class="fa fa-birthday-cake" aria-hidden="true" style="color:#E4791A"></i> Date Of Birth</label>
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
													<label for="" class="col-lg-5" style="m">&nbsp;&nbsp;<i class="fa fa-birthday-cake" aria-hidden="true" style="color:#E4791A"></i> Age</label>
													<div class="col-lg-7">
														<input type="hidden" class="form-control" id="txtemailid" name="txtemailid" maxlength="250"  value="" >
														<input type="text" class="form-control" id="txtAge" name="txtAge" maxlength="250" disabled=""  value="" data-placement="top" data-toggle="tooltip">
													</div>
												</div>
											</div>
										</div>
										<div  class="row"  style="margin-top: 20px;">
											<div  class="row"  style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="m"><i style="color:red;font-size:18px;">*</i><i class="fa fa-credit-card" aria-hidden="true" style="color:#E4791A"></i> Aadhaar Number</label>
														<div class="col-lg-7">
															<input type="text" class="form-control test" id="txtidproof" name="txtidproof" onkeypress="return isNumberKey(event)"  placeholder="Enter Aadhaar Number " maxlength="12"  value="" data-placement="top" data-toggle="tooltip" title=" Enter ID Proof Number " <?php echo $show==1?'disabled':''; ?>>
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
																/*foreach($allCategories as $row)
																{
																	$x = ($cmbReservedCategory == $row['category_code'] ? ' selected ' : '');
																	echo "<option value='".$row['category_code']."' $x>".$row['category_name']."</option>";
																} */
																?>
															</select>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div  class="row"  style="margin-top: 20px;">
											<div  class="row"  style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="m">&nbsp;&nbsp;<i class="fa fa-credit-card" aria-hidden="true" style="color:#E4791A"></i> State</label>
														<div class="col-lg-7">
															<input type="hidden" class="form-control test" id="hidState" name="hidState" value="" data-placement="top" data-toggle="tooltip">
															<input type="text" class="form-control test" value="" data-placement="top" data-toggle="tooltip" title=" Enter ID Proof Number " <?php echo $show==1?'disabled':''; ?> disabled>
														</div>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5"  style="padding-right: 35px;">&nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i><i class="fa fa-home" aria-hidden="true" style="color:#E4791A"></i> Home District</label>
														<div class="col-lg-7">
															<select name="cmbHomeDist" id="cmbHomeDist" class="form-control" <?php echo $show==1?'disabled':''; ?>>
																<option value=''>Select District</option>
																<?php
																/*echo $cmbHomeDist;
																die();*/
																/*foreach($allDistricts as $row)
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
																} */
																?>	
															</select>
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
														<input type="radio" name="radioResident" id="radioResidentY" value="YES" <?php echo $show==1?'disabled':''; ?>> Yes
													</label>
													<label class="radio-inline">
														<input type="radio" name="radioResident" id="radioResidentN" value="NO"  <?php echo $show==1?'disabled':''; ?>> No
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
															<input type="radio"  name="radioPhysicallY" id="radioPhysicallYN" value="NO" <?php echo $show==1?'disabled':''; ?>> NO
														</label>
														<label class="radio-inline">
															<input type="radio" name="radioPhysicallY" id="radioPhysicallYY" value="YES" <?php echo $show==1?'disabled':''; ?>> YES
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
															<select class="form-control" name="cmbPH" id="cmbPH" <?php echo $show==1?'disabled':''; ?>>
																<option value=''>Select</option>
																<option value='OH' >Blind and low vision</option>
																<option value='VH' >Deaf and hard of hearing</option>
																<option value='HI' >Locomotory disability including celebral palsy, leprosy cured, dwarfism, acid attack victim and muscular dystrophy</option>
																<option value='HI' >Autism, intelectual disability, specific learning disability and mental illness</option>
																<option value='HI' >Multiple disability from amongst persons under clauses (a) to (d) including deaf blindness in the post indenitfied for each disability</option>
															</select>
															
														</div>
													</div>
												</div>
											</div>
											
										</div>
										<!--<div class="col-lg-6">
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
										</div>-->
									</div>
									</div>
										<!--***********START OF PRESENT ADDRESS SECTION************-->
										<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;    margin-top: 35px;">
											<h3 style="text-align: center;margin-top: -6px;color: #666;"> Present Address  </h3>
											<div class="row"  style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> H/No/Locality/Street Name/Village </label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="txtPresentLocality" id="txtPresentLocality" onchange="uncheck();" onkeyup="changeCase(this)" maxlength="80" value="" <?php echo $show==1?'disabled':''; ?>>
														</div>

													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="    padding-right: 35px;">&nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i> Post</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="txtPresentPost" id="txtPresentPost" onchange="uncheck();"   onkeyup="changeCase(this)" maxlength="80" value="" <?php echo $show==1?'disabled':''; ?>>
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
															<input type="text" class="form-control" name="city_name" value="" onchange="uncheck();"  onkeyup="changeCase(this)" maxlength="80" id="city_name" <?php echo $show==1?'disabled':''; ?>>
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
																/*foreach($allStates as $row)
																{
																	$x = ($cmbPresentState == $row['state_code'] ? ' selected ' : '');
																	echo "<option value='".$row['state_code']."' $x>".$row['state_name']."</option>";
																} */
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
															<select name="cmbPresentDist" id="cmbPresentDist" class="form-control" <?php echo $show==1?'disabled':''; ?>>
																<option value=''>Select District</option>
																<?php
																/*foreach($allDistricts as $row)
																{
																	$x = ($cmbPresentDist == $row['district_code'] ? ' selected ' : '');
																	echo "<option value='".$row['district_code']."' $x>".$row['district_name']."</option>";
																} */
																?>	
															</select>
														</div>
													</div>
												</div>

												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" >&nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i> PIN</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" onchange="uncheck();"  name="txtPresentPin" id="txtPresentPin" onkeypress="return isNumberKey(event)" maxlength="6" value="" data-placement="top" data-toggle="tooltip" title="Pin must be 6digit Ex:123456" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>

											</div>
										</div>	
										<!--</div>-->	
										<!--</div>	-->
										<!--***********END OF PERMANENT ADDRESS SECTION************-->

										<!--***********START OF PRESENT ADDRESS SECTION************-->

										<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;    margin-top: 35px;">
											<h3 style="text-align: center;margin-top: -6px;color: #666;"> Permanent  Address </h3>
											<div class="row">
												<div class="form-group">
													<div class="col-sm-8">
														<input type="checkbox" id="chksameasresidential" name="chksameasresidential" value="Y" onclick="setSameAddress();" <?php echo $show==1?'disabled':''; ?>> 
											Permanent Address Is Same As Present Address
													</div>
												</div>
											</div>
											<div class="row"  style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> H/No/Locality/Street Name/Village </label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="txtPermenentLocality" id="txtPermenentLocality" onkeyup="changeCase(this)" maxlength="80" value="" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>
												 
													<div class="col-lg-6">
														<div class="form-group">
															<label for="" class="col-lg-5" style="    padding-right: 35px;">&nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i> Post</label>
															<div class="col-lg-7">
																<input type="hidden" name="hidPermanentPost" id="hidPermanentPost" value="" />
																<input type="text" class="form-control" name="txtPermanentPost" id="txtPermanentPost" onkeyup="changeCase(this)" maxlength="80" value="" >
															</div>
														</div>
													</div>

												</div>
											


											<div class="row" style="margin-top: 20px;">
												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5" style="    padding-right: 35px;"><i style="color:red;font-size:18px;">*</i> City</label>
														<div class="col-lg-7">
															<input type="text" class="form-control" name="city_name1" id="city_name1" value="" onkeyup="changeCase(this)" maxlength="80" <?php echo $show==1?'disabled':''; ?>>
														</div>
													</div>
												</div>
												 

												<div class="col-lg-6">
													<div class="form-group">
														<label for="" class="col-lg-5 " ><i style="color:red;font-size:18px;">*</i> State</label>
														<div class="col-lg-7">
															<input type="hidden"  name="hidPermanentState" id="hidPermanentState" value="" >
															<select name="cmbPermanentState" id="cmbPermanentState" class="form-control">
																<option value=''>Select State</option>
																<?php
																/*foreach($allStates as $row)
																{
																	$x = ($cmbPermanentState == $row['state_code'] ? ' selected ' : '');
																	echo "<option value='".$row['state_code']."' $x>".$row['state_name']."</option>";
																} */
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
															<input type="hidden"  name="hidPermanentState" id="hidPermanentState" value="" />
															<select id="cmbPermanentDist" name="cmbPermanentDist" class="form-control" >
																<option value=''>Select District</option>
																<?php
																/*foreach($allDistricts as $row)
																{
																	$x = ($cmbPermanentDist == $row['district_code'] ? ' selected ' : '');
																	echo "<option value='".$row['district_code']."' $x>".$row['district_name']."</option>";
																} */
																?>													
															</select>
														</div>
													</div>

												</div>

												<div class="col-lg-6">
													<div class="form-group">
													<label for="" class="col-lg-5" > &nbsp;&nbsp;<i style="color:red;font-size:18px;">*</i> PIN</label>
													<div class="col-lg-7">
														<input type="hidden"  name="hidPermanentPin" id="hidPermanentPin" value="" />
														<input type="text" class="form-control" name="txtPermanentPin" id="txtPermanentPin" value="" onkeypress="return isNumberKey(event)" maxlength="6" data-placement="top" data-toggle="tooltip" title="Pin must be 6digit Ex:123456">
													</div>
												</div>


												</div>
											</div>
										</div>

										
										<div class="form-group">
											<div class="col-lg-offset-10 col-lg-3">
												<br />
												<a class="btn btn-primary btnNext" style = "color: white;" >Next &raquo;</a>
											</div>
										</div>	
										<br />
									</div>
									
								</div>
								
							</div>

							<!-- second tab-->
							
							<div class="tab-pane" id="academic_tab"> 
							
								<!--***********START OF ACADEMIC INFORMATION SECTION************-->
										
								<div class="col-lg-12" id="divAcademicInfo" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px; margin-top: 35px;">
									<h3 style="text-align: center;margin-top: -6px;color: #666;"> Academic Information </h3>
									<div class="row">
										<div class="col-sm-12">
											<h4><b><i class="glyphicon glyphicon-asterisk" style="color:red;font-size:10px;"></i> Educational Qualification </b></h4>
										</div>
										<div class="col-sm-12">
											<div class="table-responsive">
												
												<table  class="table table-bordered table-striped">
													<thead>
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
													</thead>
													<tr>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtExamName_1" name="txtExamName_1" value="" <?php echo $show==1?'disabled':''; ?>/></div></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtStream_1" name="txtStream_1" value="" <?php echo $show==1?'disabled':''; ?>/></div></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtYearQual_1" onkeypress="return isNumberKey(event)" name="txtYearQual_1" maxlength="4" value="" <?php echo $show==1?'disabled':''; ?>/></div></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtBoardOth_1" name="txtBoardOth_1" maxlength="500" value="" <?php echo $show==1?'disabled':''; ?>/></div></td>
														<!--<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtSub1" name="txtSub1" maxlength="500" value="<?=$txtSub1?>" <?php echo $show==1?'disabled':''; ?>/></div></td>-->
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtDiv_1" name="txtDiv_1" maxlength="500" value="" <?php echo $show==1?'disabled':''; ?>/></div></td>
														<td><div class="form-group">
															<select class="form-control input-sm" name="txtGradingOth1" id="txtGradingOth1">
																<option value='' >Select</option>
																<option value='YES'>Yes</option>
																<option value='NO'>No</option>
															</select>
														</div></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtCGPA1" onkeypress="return isNumberKey(event)" name="txtCGPA1" maxlength="500" value="<?=$txtCGPA1?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
														
													</tr>
													<tr>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtExamName_2" name="txtExamName_2" value=" " <?php echo $show==1?'disabled':''; ?>/></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtStream_2" name="txtStream_2" value=" " <?php echo $show==1?'disabled':''; ?>/></div></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtYearQual_2" onkeypress="return isNumberKey(event)" name="txtYearQual_2" maxlength="4" value=" " <?php echo $show==1?'disabled':''; ?>/></div></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtBoardOth_2" name="txtBoardOth_2" maxlength="500" value=" " <?php echo $show==1?'disabled':''; ?>/></div></td>
														<!--<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtSub2" name="txtSub2" maxlength="500" value="<?=$txtSub2?>" <?php echo $show==1?'disabled':''; ?>/></div></td>-->
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtDiv2" name="txtDiv2" maxlength="500" value=" " <?php echo $show==1?'disabled':''; ?>/></div></td>
														<td><div class="form-group">
															<select class="form-control input-sm" name="txtGradingOth2" id="txtGradingOth2">
																<option value=''>Select</option>
																<option value='YES' >Yes</option>
																<option value='NO' >No</option>
															</select>
														</div></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtCGPA_2" name="txtCGPA_2" maxlength="500" value=" " <?php echo $show==1?'disabled':''; ?>/></div></td>
														
													</tr>
												</table>
												<!--<button class="btn btn-danger" id="btnAddQual" type="button" <?php echo $show==1?'disabled':''; ?>>Add</button>-->
											</div>
											
											
										</div>

										<div class="row">
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
															<select class="form-control input-sm" name="txtGradingOth1" id="txtGradingOth1">
																<option value='' <?php if($txtGradingOth1 == '') { echo "selected";  } ?>>Select</option>
																<option value='YES' <?php if($txtGradingOth1 == 'YES') { echo "selected";  } ?> >Yes</option>
																<option value='NO' <?php if($txtGradingOth1 == 'NO') { echo "selected"; } ?>>No</option>
															</select>
														</div></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtCGPA1" onkeypress="return isNumberKey(event)" name="txtCGPA1" maxlength="500" value="<?=$txtCGPA1?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
														
													</tr>
													<tr>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtExamName2" name="txtExamName2" value="<?=$txtExamName2?>" <?php echo $show==1?'disabled':''; ?>/></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtStream2" name="txtStream2" value="<?=$txtStream2?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtYearQual2" onkeypress="return isNumberKey(event)" name="txtYearQual2" maxlength="4" value="<?=$txtYearQual2?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtBoardOth2" name="txtBoardOth2" maxlength="500" value="<?=$txtBoardOth2?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
														<!--<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtSub2" name="txtSub2" maxlength="500" value="<?=$txtSub2?>" <?php echo $show==1?'disabled':''; ?>/></div></td>-->
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtDiv2" name="txtDiv2" maxlength="500" value="<?=$txtDiv2?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
														<td><div class="form-group">
															<select class="form-control input-sm" name="txtGradingOth2" id="txtGradingOth2">
																<option value='' <?php if($txtGradingOth2 == '') { echo "selected";  } ?>>Select</option>
																<option value='YES' <?php if($txtGradingOth2 == 'YES') { echo "selected";  } ?> >Yes</option>
																<option value='NO' <?php if($txtGradingOth2 == 'NO') { echo "selected"; } ?>>No</option>
															</select>
														</div></td>
														<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtCGPA2" name="txtCGPA2" maxlength="500" value="<?=$txtCGPA2?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
														
													</tr>
												</table>													   
											</div>
										</div>	
									</div>
									<div class="form-group">
										<div class="col-lg-offset-9 col-lg-3">
											<br />
											<a class="btn btn-primary btnPrevious"  style = "color: white;"> &laquo; Previous </a>
											<a class="btn btn-primary btnNext"  style = "color: white;" > Next &raquo; </a>
										</div>
									</div>
									<br />
								</div>
								
							</div>

							<!-- third tab-->
							
							<div class="tab-pane" id="info_tab"> 
								<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;    margin-top: 35px;">
								 	<div class="col-sm-12 form-group">
								        <div class="col-sm-7">
											<label for="" ><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Whether working as a regular employee under the Govt. of Arunachal Pradesh ?</label>
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
									<div id="divEmpSuspendedInfo" class="col-sm-12 form-group">
								        <div class="col-sm-12 table-responsive">
											<table  class="table table-bordered table-striped">
											    <tr>
													<th class="header" style="text-align:center;">Name of the Office</th>
													<th class="header" style="text-align:center;">Date of Joining</th>
													<th class="header" style="text-align:center;">Name of Post</th>
												</tr>

												<tr>
													<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtNameOfOffice" name="txtNameOfOffice" "maxlength="90" value="<?=$txtNameOfOffice?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
													<td><div class="form-group"><input type="text" class="form-control date" style="width:90%" id="txtDOJ" name="txtDOJ" value="<?=$txtDOJ?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
													<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtNameOfPost" name="txtNameOfPost" maxlength="500" value="<?=$txtNameOfPost?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
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
												<input type="radio" name="empDisciplinary" id="empDisciplinaryno" value="NO" <?php if($empDisciplinary=="NO") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> NO
											</label>
											<label class="radio-inline">
												<input type="radio" name="empDisciplinary" id="empDisciplinaryyes" value="YES" <?php if($empDisciplinary=="YES") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?>> YES
											</label>
										</div>
									</div>
									<div id="divEmpDisciplinaryInfo" class="col-sm-12 form-group">
								       <div class="col-sm-12 table-responsive">
											<table  class="table table-bordered table-striped">
											    <tr>
													<th class="header" style="text-align:center;">Date</th>
													<th class="header" style="text-align:center;">Period of Debarrment</th>
												</tr>

												<tr>
													<td><div class="form-group"><input type="text" class="form-control date" style="width:90%" id="txtDateOfDebar" name="txtDateOfDebar" value="<?=$txtDateOfDebar?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
													<td><div class="form-group"><input type="text" class="form-control" style="width:90%" id="txtPeriodOfDebar" name="txtPeriodOfDebar" maxlength="500" value="<?=$txtPeriodOfDebar?>" <?php echo $show==1?'disabled':''; ?>/></div></td>
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
												<input type="radio" name="mode" id="modeOnline" value="Online" checked <?php if($mode=="Online") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?> > Online
											</label>
											<label class="radio-inline">
												<input type="radio" name="mode" id="modeOffline" value="Offline" <?php if($mode=="Offline") { echo "checked"; } ?> <?php echo $show==1?'disabled':''; ?> > Offline (Challan)
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
								<div class="form-group">
									<div class="col-lg-offset-9 col-lg-3">
										</br>
										<a class="btn btn-primary btnPrevious"  style = "color: white;"> &laquo; Previous </a>
										<a class="btn btn-primary btnNext"  style = "color: white;"> Next &raquo; </a>
									</div>
								</div>
								<br />

							</div>

							<!-- fourth tab-->
							
							<div class="tab-pane" id="declaration_tab"> 
							
								<a class="btn btn-primary btnPrevious"  style = "color: white;"> &laquo; Previous </a>
								
								<div class="col-lg-12" style="box-shadow: 0px 7px 20px -6px #090909; background-color: #F1F1F1;border: 1px solid rgb(255, 255, 255); border-radius: 5px; width: 100%;height: auto;padding: 21px;    margin-top: 35px;">
									<h3 style="text-align: center;margin-top: -6px;color: #666;"> Declaration </h3>
									<div class="row">
										<div class="form-group">
											<div class="col-sm-12" align="justify">
												<input type="checkbox" name="chkUndertaking1" id="chkUndertaking1" value="1"  >
												I  hereby declare that I have read the detail information/advertisement before submission of this application.I hereby certify that all statements made and information given by me in this application form are true, complete and correct to the best of my knowledge and belief. In the event of any information is being found false or incorrect before or after the interview or appointment, action can be taken against me by the Corporation and my candidature/appointment shall automatically cancelled/terminated.<br \>
											</div>
										</div>
									</div>
								</div>	

							
								<?php if($show != 1) { ?>
								
								<?php } ?>
							</div>
														
						
						</div>
					</form>
				</div>
			</div>	
			<!--Panel Body-->
			<!--Panel Default-->
		<!--/col-lg-12-->
	
</div>		</div></div>

<!--<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrapValidator.js"></script>-->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/template002.js?v=<?php rand()?>"></script>
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