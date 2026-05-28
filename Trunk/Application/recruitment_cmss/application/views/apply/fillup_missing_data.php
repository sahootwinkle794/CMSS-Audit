<?php
date_default_timezone_set('Asia/Kolkata');
$now = date('Y-m-d h:i:s', now());

$data = $this->uri->uri_to_assoc();
$edit_status = isset($data['edit'])?$data['edit']:'';
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

$show = 0;
$edit = "false";

$postcode=array();
$postname='';
$postsize='';
$i='';
 

//********************************************* Details in template *******************************//

foreach($applicant_data as $row)
{   
	
	$txtdate = $row['dob1'];
	$dob1 = explode("-",$row['dob1']);
	$radiogender = $row['gender'];
	$cmbReservedCategory = $row['category'];
	$cmbQuota = $row['is_reserved_quota'];
	
	
}
 
$photo = $document_path['photo'];
$signature = $document_path['signature'];

/*echo $photo;
echo $signature;die();*/

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
	
}
$birth_start_date1 = '';
$birth_end_date1 = '';
foreach($eligibilityDate as $row){ 
	$birth_start_date1 = $row['birth_start_date'];
	$birth_end_date1 = $row['birth_end_date'];
}

$d = '';
$m = '';
$y = '';

$txtDobDateFormat = '';
if(sizeof($dob1)>1)
{
	$d = $dob1[2];
	$m = $dob1[1];
	$y = $dob1[0];
	$txtDobDateFormat = $d.'-'.$m.'-'.$y; 
}

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
$(document).ready(function() {
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
		var min_Date = '';
		var max_Date = '';
		if($('#birthStartDate1').val() == '' || $('#birthStartDate1').val() == null)
		{
			min_Date = '01-01-1900';
		}
		else
		{
			min_Date = $('#birthStartDate1').val();
		}
		
		if($('#birthEndDate1').val() == '' || $('#birthEndDate1').val() == null)
		{
			max_Date = today;
		}
		else
		{
			max_Date = $('#birthEndDate1').val();
		}
		
	$('#txtdateofbirth').datepicker({ 
			format: 'dd-mm-yyyy',
			startDate: min_Date,
			endDate: max_Date,
			autoclose:true,
			//yearRange: '1980:2003'
		});
	$('#frmApply').bootstrapValidator({
		excluded: [':disabled',':hidden', ':not(:visible)'],
        message: 'This value is not valid',
        fields: {
			
			txtdateofbirth: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    } 
                }
            },
			radiogender: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            cmbCommunity: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },/*
            cmbQuota: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },*/
            filePHO: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
            fileSIG: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
        }
      });
});	
var result = '';
	result = '<?=$this->session->flashdata('info'); ?>';
	if(result){
		swal({
			title: "",
			text: "Details Succesfully Submitted.Please Download Your Admit Card",
			showCancelButton: false,
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
function readURL(width,height,id) {
    if (document.getElementById("file"+id).files && document.getElementById("file"+id).files[0]) {
        var reader = new FileReader();
           
        reader.onload = function (e) {
            $('#img'+id).attr('src', e.target.result);
			$('#img'+id).attr('height',height);
			$('#img'+id).attr('width',width);
        }
        
        reader.readAsDataURL(document.getElementById("file"+id).files[0]);
    }
}
function readURLDOC(width,height,id) {
    if (document.getElementById("file"+id).files && document.getElementById("file"+id).files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img'+id).attr('src',base_url+'downloads/doc_icon.png' );
			$('#img'+id).attr('height',100);
			$('#img'+id).attr('width',100);
        }
        
        reader.readAsDataURL(document.getElementById("file"+id).files[0]);
    }
}
function showImage(id,width,height,size,type)
{
	
	var file = document.getElementById("file"+id).files[0];
	var sFileName = file.name;
    var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
    var iFileSize = file.size;
    if((type == 'IMG') && (sFileExtension != "jpg" && sFileExtension != "jpeg" && sFileExtension != "png" && sFileExtension != "JPG" && sFileExtension != "JPEG" && sFileExtension != "PNG" ))
    {
		document.getElementById("divMessage"+id).innerHTML="Error : Invalid File Format";
		//check_errors();
		//$('#btndocumentUpload').attr('disabled', true);
	}
	else if((type == 'DOC') && (sFileExtension != "pdf" && sFileExtension != "PDF"   && sFileExtension != "xls" && sFileExtension != "xlsx" && sFileExtension != "DOC"  && sFileExtension != "doc" && sFileExtension != "docx" && sFileExtension != "DOCX"))
	{
		document.getElementById("divMessage"+id).innerHTML="Error : Invalid File Format";
		//check_errors();
		//$('#btndocumentUpload').attr('disabled', true);
		
	}
	else
	{
		
		if (sFileExtension == "jpg" || sFileExtension == "jpeg" || sFileExtension == "png")
		{ 
			if(iFileSize <= size*1024)
			{
			  	document.getElementById("divMessage"+id).innerHTML="";
			  	readURL(width,height,id);
				//check_errors();
			  	
				/*$('#btndocumentUpload').attr('disabled', false);*/
			}
			else
			{
				
				//$('#btndocumentUpload').attr('disabled', true);
				document.getElementById("divMessage"+id).innerHTML="Error : File size exceeds "+size+" KB";
				$("#file"+id).val("");
				$('#img'+id).attr('src','');
				$('#img'+id).attr('height','0');
				$('#img'+id).attr('width','0');
				//check_errors();
				
			}
	    }
		else if (sFileExtension == "pdf" || sFileExtension == "PDF"   || sFileExtension == "xls" || sFileExtension == "xlsx" || sFileExtension == "DOC"  || sFileExtension == "doc" || sFileExtension == "docx"|| sFileExtension == "DOCX")
		{ 
			if(iFileSize <= size*1024)
			{
			  	document.getElementById("divMessage"+id).innerHTML="";
			  	readURLDOC(width,height,id);
				//check_errors();
				/*$('#btndocumentUpload').attr('disabled', false);*/
			}
			else
			{
				
				//$('#btndocumentUpload').attr('disabled', true);
				document.getElementById("divMessage"+id).innerHTML="Error : File size exceeds "+size+" KB";
				$("#file"+id).val("");
				$('#img'+id).attr('src','');
				$('#img'+id).attr('height','0');
				$('#img'+id).attr('width','0');
				//check_errors();
			}
	    }
		else
		{
			document.getElementById("divMessage"+id).innerHTML="Error : Invalid File Format";
			//$('#btndocumentUpload').attr('disabled', true);
			$("#file"+id).val("");
			$('#img'+id).attr('src','');
			$('#img'+id).attr('height','0');
			$('#img'+id).attr('width','0');
			//check_errors();
		}
	}
    
}
$(document).ready(function() {
	//check_errors();
});
	
	
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
		  background-color: #ff8361;
			border-color: #ff8361;
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
    		background: white;
		}
		legend{
			    width: auto;
			    border-bottom: 0px;
			    color: #fff;
			    background: linear-gradient(to left, #ffb27a 30%, #ff805f 100%);
			    border-radius: 6px;
			    text-align: center;
			    padding: 3px;
		
		}
		.btn-pink{
			    background-color: #f7bcbc;
			    border: 1px solid #b9b9b9;
			    border-radius: 20px;
			    color: #000;
		}
		
	</style>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.css" />
    <!--<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/selectize_master/dist/css/selectize.css">-->
<div class="container-fluid" style=" padding-bottom: 50px;">

	<div class="row" style="background:  linear-gradient(to bottom, #c5875a 0%, #ffb27a45 20%,#fff 100%)" >
		<div class="col-sm-1 col-md-1 col-lg-1 hidden-xs" style="margin-top: 200px;margin-left: -15px;z-index: 1000;">
			<?php include('sidebar/sidebar.php'); ?>
		</div>

		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" style="padding-top:75px;padding-right: 2%;">
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
				<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;"> <!-- Alert for error -->
					<div id="alertmessage"></div>
				</div>
				<span class="pull-right" style="margin-top:10px;margin-right:  34px;margin-bottom: 10px;"><b style="color: #802d06;font-size: 20px;"><?php echo $admname; ?></b></span>
	                    
				<form action="" method="post" id="frmApply" name="frmApply" enctype="multipart/form-data">

			<!--***********START OF ACADEMIC INFORMATION SECTION************-->
				<input type="hidden" id="birthStartDate1" value="<?php echo $birth_start_date1; ?>"/>
	 			<input type="hidden" id="birthEndDate1" value="<?php echo $birth_end_date1; ?>"/>
	 			<input type="hidden" id="birthEndDate1" value="<?php echo $birth_end_date1; ?>"/>
	    		<input type="hidden" name="hidprogram" id="hidprogram" value="<?php echo $admcode; ?>">
            	<div class="row" style="margin-top: 80px; <?php echo $txtdate == '' ||  $radiogender == ''  ||  $cmbReservedCategory == '' /* ||  $cmbQuota == ''*/ ?'display:block;':'display: none;'?>"> 
				<fieldset>
					<legend>Profile Details</legend>
					<h3 style="text-align: center;margin-top: -6px;color: #666;"> </h3>
					
					<div class="row" style="margin-top: 20px;margin-left: -2%; <?php echo $txtdate !='' && $txtdate !='0000-00-00' ?'display:none;':'display: block;'?> ">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="txtDOB" class="col-lg-5" style="text-align:left;"><i class="fa fa-birthday-cake" aria-hidden="true" style="color:#E4791A"></i> Date Of Birth</label>
								<div class="col-lg-7">
									 <input class="form-control" type="text" name="txtdateofbirth" id="txtdateofbirth"  value="<?php echo $txtdate; ?>" autocomplete="off" placeholder="Date Of Birth" data-placement="top" data-toggle="tooltip" title="Your Date of Birth. ex: dd-mm-yyyy"  onfocus="this.blur()">
						    	</div>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top: 20px;margin-left: -2%; <?php echo $radiogender !=''?'display:none;':'display: block;'?> ">
						<div class="col-lg-6">
							<div class="form-group" >
								<label for="" class="col-lg-5 control-label"  ><i style="color:red;font-size:18px;">*</i> <i class="fa fa-venus-mars" aria-hidden="true" style="color:#E4791A;"></i> Gender</label>
								<div class="col-lg-7">
									<label class="radio-inline">
										<input type="radio" name="radiogender" id="radiomale" value="M" <?php if($radiogender=="M") { echo "checked"; } ?> > Male
									</label>
									<label class="radio-inline">
										<input type="radio" name="radiogender" id="radiofemale" value="F" <?php if($radiogender=="F") { echo "checked"; } ?> > Female
									</label>
									<label class="radio-inline">
										<input type="radio" name="radiogender" id="radiotrans" value="T" <?php if($radiogender=="T") { echo "checked"; } ?>> Transgender
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top: 20px;margin-left: -2%; <?php echo $cmbReservedCategory !=''?'display:none;':'display: block;'?> ">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="" class="col-lg-5" ><i style="color:red;font-size:18px;">*</i> <i class="fa fa-users" aria-hidden="true" style="color:#E4791A"></i> Category</label>
								<div class="col-lg-7">
									<select class="form-control" name="cmbCommunity" id="cmbCommunity"  >
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
					<!--<div class="row" style="margin-top: 20px;margin-left: -2%; <?php echo $cmbQuota !=''?'display:none;':'display: block;'?> ">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="" class="col-lg-5" ><i style="color:red;font-size:18px;">*</i> <i class="fa fa-users" aria-hidden="true" style="color:#E4791A"></i>Quota</label>
								<div class="col-lg-7">
									<select class="form-control" name="cmbQuota" id="cmbQuota"  >
										<option value=''>Select Quota</option>
										<?php 
										foreach($allQuota as $row)
										{
											$x = ($cmbQuota == $row['code'] ? ' selected ' : '');
											echo "<option value='".$row['code']."' $x>".$row['description']."</option>";
										} 
										?>
									</select>
								</div>
							</div>
						</div>
					</div>-->
				</fieldset>
				</div>
				<div class="row" style="margin-top: 40px; <?php echo $photo == '' ||  $signature == '' ?'display:block;':'display: none;'?>"> 

				<fieldset>
					<legend >Upload Documents</legend>
					<div class="col-lg-12">
						<span style="color: red">* All the Documents are Mandatory.</span>
						
							<div class="row"  style="margin-top: 20px;margin-left: -2%; <?php echo $photo !=''?'display:none;':'display: block;'?> ">
									<div class="col-lg-4 col-xl-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 10px;">
											<div class="form-group">
												<label for="">Self Photo</label>
											</div>
									</div>
									<div class="col-lg-4 col-xl-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 10px;">
											<div class="form-group" >
												<div class="input-group input-file" >
										    		<input type="file" class="form-control" style="width:85%;margin-left: 12px;"  id="filePHO" name="filePHO" onchange = "showImage('PHO',100,100,100,'IMG');"/>
										    	</div>	
											</div>
											File-Type: jpg, jpeg, png<br>
											<span style="color: red">File-Size: 100kb Max</span>
											<span style="color: red"> Height and Width: 100px and 100px</span>
											
											<div id="divMessagePHO" style="color:red;font-size:16px;"></div>	
									</div>
								<div class="col-lg-4 col-xl-4 col-md-4 col-sm-4 col-xs-12" >
									<div class="form-group" style="text-align: center;">
										<?php 
											echo "<img id='imgPHO' />"; 
										?>
									</div>
								</div>
							</div>
							<div class="row" style="margin-top: 20px;margin-left: -2%; <?php echo $signature !=''?'display:none;':'display: block;'?>">
									<div class="col-lg-4 col-xl-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 10px;">
											<div class="form-group">
												<label for="">Self Signature</label>
											</div>
									</div>
									<div class="col-lg-4 col-xl-4 col-md-4 col-sm-4 col-xs-12" style="padding-top: 10px;">
											<div class="form-group" >
												<div class="input-group input-file" >
										    		<input type="file" class="form-control" style="width:85%;margin-left: 12px;"  id="fileSIG" name="fileSIG" onchange = "showImage('SIG',200,100,50,'IMG');"/>
										    	</div>	
											</div>
											File-Type: jpg, jpeg, png<br>
											<span style="color: red"><span style="color: red">File-Size: 50kb Max</span>
											<span style="color: red">Height and Width: 100px and 200px</span>
											
											<div id="divMessageSIG" style="color:red;font-size:16px;"></div>	
									</div>
								<div class="col-lg-4 col-xl-4 col-md-4 col-sm-4 col-xs-12" >
									<div class="form-group" style="text-align: center;">
										<?php 
											echo "<img id='imgSIG' />"; 
										?>
									</div>
								</div>
							</div>
								
							
					</div> 
				</fieldset>	
				</div>
				<div class="form-group" >
					<div class="col-lg-12">
						<button type="submit" class="btn btn-primary btn-block" id="btnprofile"  name="btnprofile"  style="margin-top: 20px;font-size:16px;"><span class="glyphicon glyphicon-send" style="font-size:18px;"></span>Update</button>
					</div>
				</div>	
				</form>
			</div>
		</div>
		
		<div class="col-sm-1 col-md-1 col-lg-1 hidden-xs" style="margin-top: 200px;margin-left: -15px;z-index: 1000;">
		</div>
			
		</div>
		
	</div>
<!--<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrapValidator.js"></script>-->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/selectize_master/dist/js/standalone/selectize.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.js"></script>
