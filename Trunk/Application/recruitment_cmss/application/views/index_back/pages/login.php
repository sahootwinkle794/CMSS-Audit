<link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet" /> 
<?php 
if($this->session->flashdata('post_data')){
	$post_data = $this->session->flashdata('post_data');
	$txtCandidatePhone = $post_data['txtCandidatePhone'];
	$txtdob = $post_data['txtdob'];
}
foreach($institute as $row){ 
	$inscode = $row['institute_code'];
	$ins =  encrypt_decrypt('encrypt', $inscode);
	$insname = $row['institute_name'];
	$logo = $row['logo_url'];	
}
$birth_start_date = '';
$birth_end_date = '';
foreach($eligibilityDate as $row){ 
	$birth_start_date = $row['birth_start_date'];
	$birth_end_date = $row['birth_end_date'];
}

$program_start_date = '';
$program_end_date = '';
foreach($dateInfo as $row){ 
	$program_start_date = $row['program_start_date'];
	$program_end_date = $row['program_end_date'];
}

?>
<style type="text/css">
	label {
    	color: #000;
    	font-size: 15px;
    }
	.fpad{
    	padding-top: 0px;
    }

    .form-group {
	    margin-bottom: 10px;
	}
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

</style> 
<link href="<?php echo base_url(); ?>public/template_lib/plugins/jquery.datepick/css/jquery.datepick.css" rel="stylesheet" />
<section style="background: url(<?php echo base_url(); ?>upload/image/background_image.jpg); padding-bottom: 10px;">
<div class="container">
 <div class="row">
 	<input type="hidden" id="birthStartDate" value="<?php echo $birth_start_date; ?>"/>
 	<input type="hidden" id="birthEndDate" value="<?php echo $birth_end_date; ?>"/>
 	<div style="color: #ffffff;background-color:rgb(228, 121, 26); bfont-size:15px;"><center></center></div>
      <div class="col-sm-12">
       <div class="col-sm-6" style="margin-top: 30px;">
			<h4 style="color: rgb(177, 46, 41);font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">INSTRUCTIONS FOR FILLING UP APPLICATION FORM:</h4><hr>
			<p style="color: #000;font-size:15px;">Please read the following documents carefully before filling up the application form</p>
			<!--<p style="color: #fff;font-size:15px;">Read the <a href="<?php base_url() ?>downloads/cipet_brochure.pdf" style="color: rgb(228, 121, 26);" >Information Brochure </a> and <a href="<?php base_url() ?>downloads/payment_cipet.pdf" style="color: rgb(228, 121, 26);" >Payment Instruction Manual</a>.</p>-->
				<ul style="font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif; list-style: outside; color:#000;font-size:15px;" type="disc">
			    	<li>Step 1 - Choose a course of your choice.</li>
			    	<li>Step 2 - Read all the fields carefully and then respond.</li>
			    	<li>Step 3 - Keep scanned copies of all required documents for upload before filling up the application form.
					<br/>(Within the prescribed dimension and size)</li>
			    	<li>Step 4 - Fill up all the relevant fields in the application form.</li>
			    	<li>Step 5 - Upload mandatory documents.</li>
			    	<li>Step 6 - Pay the application fee.</li>
			    	<li>Step 7 - Now you can take a printout of your application.</li>
			    	<b>Important Note: </b> Your mobile number will be your effective login id and your date of birth will be your effective login password for your future login requirement!
				</ul>
			<!--<ul style="color: black;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px;">The application must be filled in English only, in CAPITAL letters except for signature with black pen and shade the corresponding  <b>oval with HB pencils only.</b></h4></li>
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px;">Inadequate information furnished in each relevant column of the application form would entail rejection of candidature.</h4></li>
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px;"><b>No request of examination center will be entertained</b></h4></li>
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px;">Any application received after the closing date will not be considered.</h4></li>
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px;">Any delay in receiving the blank application form by the candidate will not be considered as a valid reason for the late submission of the application form, after the closing date. <b> The institute will not accept any claim or responsibility for any postal delay or loss in transit.</b></h4></li>
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px;">No claim of submission of application form received after the due date will be entertained on any account.<b>Postal and any other delay are at the risk of applicant.</b></h4></li>
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px;">Duly filled-in application form with enclosures in all respects should be sent to <b>CENTER ADDRESS</b></h4></li>
			</ul>-->
			
   		</div>
 


	    <div class="col-sm-6" style="background: #f1f1f1; margin-top: 40px; box-shadow: 10px 10px 2px 1px rgba(0, 0, 0, .2);">
       		<h3 style="text-align: center;">Applicant Login</h3>
       		<?php include_once(dirname(dirname(dirname(__FILE__))) . '/template_config/alerts.php');?>
        	<form  class=" login-box-body"  action="" method="post" id="frm_login" name="frm_login">
			   <input type="hidden" id="insCode" name="insCode" value="<?php echo $inscode; ?>"/>
			    <div class="row fpad form-group" >
				    <div class="col-sm-4 col-xs-4">
				      <label for=""><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-mobile" style="color:#E4791A"></i>  Mobile : </label>
				    </div>
			        <div class="col-sm-8 col-xs-8">
			           <input class="form-control" type="text" maxlength="10"  id="txtCandidatePhone" name="txtCandidatePhone" value="<?=isset($txtCandidatePhone)?$txtCandidatePhone:''?>"  autocomplete="off" placeholder="Mobile Number" data-placement="top" data-toggle="tooltip" title="Mobile Number ex:9040123456" >
			      
			        </div>
				</div>
			 

			   <div class="row fpad form-group" >
					<div class="col-sm-4 col-xs-4">
						<label for=""><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-calendar" style="color:#E4791A"></i> Date of Birth :</label>
				    </div>

						<div class="col-sm-8 col-xs-8">
							<input class="form-control" type="text" name="txtdob" id="txtdob" autocomplete="off" placeholder="Date of Birth(dd-mm-yyyy)" data-placement="left" data-toggle="tooltip" title="Date of Birth ex:01-01-2000" value="<?=isset($txtdob)?$txtdob:''?>" readonly/>
						</div>
					</div>
				

				
		    	<div class="row fpad form-group" >
					<div class="col-md-4 col-xs-4">
                      <label for=""><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-shield" style="color:#E4791A"></i>  Captcha : </label>
					</div>
						<!--<div class="control-label col-sm-4" style="margin-left: 0px;"> -->

						<div class="col-md-8 col-xs-8">
						 <input class="form-control" type="text" maxlength="6" id="txtCaptcha" name="txtCaptcha"  onkeyup="this.value=this.value.toUpperCase()" autocomplete="off" placeholder="Captcha Code" >
							
						<!--</div>-->
					</div>
                   </div>
				     
				       <div class="row" align="right" style="padding-top: 0px;"> 
				          
				         <p id="captImg">
								<a href="javascript:void(0);" class="refreshCaptcha" id="refreshCaptcha" ><img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
							</p>
				        
				    </div>

			    <div class="row fpad">
				    <div class="col-sm-12 col-xs-6" align="center" >
			   	 		<button class="btoon" style="margin-left: 49px;width: 166px;" type="submit" id="btnlogin" name="btnlogin"><i class="fa fa-user-plus"></i> Login</button>
		    		</div>
		    	</div>
			</form>
        
       </div>


     </div>

 </div>

</div>

</section>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrapValidator.js"></script>
<!--<script src="<?php echo base_url(); ?>public/template_lib/plugins/jquery.datepick/js/jquery.plugin.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/jquery.datepick/js/jquery.datepick.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/jquery.datepick/js/jquery.plugin.js"></script> -->
<script>
	$.ajax({
		url:base_url+"ajax_controller/create_captcha",
		type:"post",
		success:function(response){ 
			var value = 'hello';
			refresh = base_url + 'public/assets/images/refresh.png';
			var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha" onclick="refresh_captcha()"  id="refreshCaptcha" ><img src="'+refresh+'"/></a>';
			$("#captImg").html(res);	
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	function refresh_captcha()
	{
		$.get(base_url+'ajax_controller/refresh_captcha', function(data){
			refresh = base_url + 'public/assets/images/refresh.png';
			var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha" onclick="refresh_captcha()"  id="refreshCaptcha" ><img src="'+refresh+'"/></a>';
			$("#captImg").html(data);
	    });
	}
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip(); //for tooltip
		// for disable write click and copy past  code start
			
			$(document).bind("contextmenu",function(e){
			   return false;
			});
			$('body').bind('cut copy paste', function (e) {
		        e.preventDefault();
		    });
			
		
		// for disable write click and copy past code end
	
		/*$('#txtdob').datepicker({
		    format: "dd-mm-yyyy",
			todayHighlight:true,
			autoclose:true,
			endDate:"+0d"
	    }).on('changeDate', function(e) { 
			$('#frm_login').data('bootstrapValidator').updateStatus('txtdob', 'VALID', null);
		});*/
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
		if($('#birthStartDate').val() == '' || $('#birthStartDate').val() == null)
		{
			min_Date = '01-01-1900';
		}
		else
		{
			min_Date = $('#birthStartDate').val();
		}
		if($('#birthEndDate').val() == '' || $('#birthEndDate').val() == null)
		{
			max_Date = today;
		}
		else
		{
			max_Date = $('#birthEndDate').val();
		}
		$('#txtdob').datepicker({ 
			format: 'dd-mm-yyyy',
			startDate: min_Date,
			endDate: max_Date,
			autoclose:true,
			//yearRange: '1980:2003'
		}).on('changeDate', function () {
			$('#frm_login').data('bootstrapValidator').updateStatus('txtdob', 'VALIDATED').validateField('txtdob');
	 	});
		/*var today = new Date();
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
		$('#txtdob').datepick({ 
			dateFormat: 'dd-mm-yyyy',
			//minDate:'31-07-1988',
			//maxDate: '31-07-2003',
			//yearRange: '1980:2003'
		});*/
	    $('#frm_login').bootstrapValidator({
		/*excluded: [':disabled'],*/
        message: 'This value is not valid',
        fields: {
			txtCandidatePhone: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    integer:{
						message:'Only numbers are allowed'
					}, 
					stringLength: {
						max: 10,
						min: 10,
						message: 'Mobile no must be 10 characters'
					}
                }
            },
			txtdob: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
			txtCaptcha: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            },
		}	
      });
    });
</script>