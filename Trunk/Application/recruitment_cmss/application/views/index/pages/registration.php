<link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet">
<?php 
$ins = $this->uri->segment(4); // 1stsegment
$inscode =  encrypt_decrypt('decrypt', $ins);
if($this->session->flashdata('post_data')){
	$post_data = $this->session->flashdata('post_data');
	$txtCandidatePhone = $post_data['txtCandidatePhone'];
	$txtdob1 = $post_data['txtdob1'];
	$txtFirstName = $post_data['txtFirstName'];
	$txtMiddleName = $post_data['txtMiddleName'];
	$txtLastName = $post_data['txtLastName'];
	$txtEmail = $post_data['txtEmail'];
}
//$program_code = $pro_code;
?>


<style type="text/css">


	/*loader design start*/
	/* Absolute Center Spinner */
		.loading {
		  position: fixed;
		  z-index: 999;
		  height: 2em;
		  width: 2em;
		  overflow: show;
		  margin: auto;
		  top: 0;
		  left: 0;
		  bottom: 0;
		  right: 0;
		}
		.ad{
			min-width: 38px;
		}
		.login-box-body {
			padding-top: 36px;
		}
		.captImg{
			margin-right: 96px;
		}
		/*.txtCaptcha{
			margin-left: -96px;
		    margin-top: 9px;  
		    width: 256px;
		}*/
		.inpfname{
			font-family: Exo 2;
		    right: 36px;
		    top: 4px;
		    border: 1px solid #86E3F0;
		    border-radius: 8px;
		    width: 340px;
		    background: #ADDFE7;
		}
		.inpmname{
			font-family: Exo 2;
		    right: 36px;
		    top: 4px;
		    border: 1px solid #86E3F0;
		    border-radius: 8px;
		    width: 340px;
		    background: #ADDFE7;
		}
		.inplname{
			font-family: Exo 2;
		    right: 36px;
		    top: 4px;
		    border: 1px solid #86E3F0;
		    border-radius: 8px;
		    width: 340px;
		    background: #ADDFE7;
		}
		.inpmob{
			font-family: Exo 2;
		    right: 36px;
		    border: 1px solid #86E3F0;
		    border-radius: 8px;
		    width: 340px;
		    background: #ADDFE7;
		}
		.input-group .input-group-addon {
		    border-radius: 10px;
		}
		/* Transparent Overlay */
		.loading:before {
		  content: '';
		  display: block;
		  position: fixed;
		  top: 0;
		  left: 0;
		  width: 100%;
		  height: 100%;
		    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

		  background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
		}

		/* :not(:required) hides these rules from IE9 and below */
		.loading:not(:required) {
		  /* hide "loading..." text */
		  font: 0/0 a;
		  color: transparent;
		  text-shadow: none;
		  background-color: transparent;
		  border: 0;
		}

		.loading:not(:required):after {
		  content: '';
		  display: block;
		  font-size: 10px;
		  width: 1em;
		  height: 1em;
		  margin-top: -0.5em;
		  -webkit-animation: spinner 150ms infinite linear;
		  -moz-animation: spinner 150ms infinite linear;
		  -ms-animation: spinner 150ms infinite linear;
		  -o-animation: spinner 150ms infinite linear;
		  animation: spinner 150ms infinite linear;
		  border-radius: 0.5em;
		  -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
		box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
		}

		/* Animation */

		@-webkit-keyframes spinner {
		  0% {
		    -webkit-transform: rotate(0deg);
		    -moz-transform: rotate(0deg);
		    -ms-transform: rotate(0deg);
		    -o-transform: rotate(0deg);
		    transform: rotate(0deg);
		  }
		  100% {
		    -webkit-transform: rotate(360deg);
		    -moz-transform: rotate(360deg);
		    -ms-transform: rotate(360deg);
		    -o-transform: rotate(360deg);
		    transform: rotate(360deg);
		  }
		}
		@-moz-keyframes spinner {
		  0% {
		    -webkit-transform: rotate(0deg);
		    -moz-transform: rotate(0deg);
		    -ms-transform: rotate(0deg);
		    -o-transform: rotate(0deg);
		    transform: rotate(0deg);
		  }
		  100% {
		    -webkit-transform: rotate(360deg);
		    -moz-transform: rotate(360deg);
		    -ms-transform: rotate(360deg);
		    -o-transform: rotate(360deg);
		    transform: rotate(360deg);
		  }
		}
		@-o-keyframes spinner {
		  0% {
		    -webkit-transform: rotate(0deg);
		    -moz-transform: rotate(0deg);
		    -ms-transform: rotate(0deg);
		    -o-transform: rotate(0deg);
		    transform: rotate(0deg);
		  }
		  100% {
		    -webkit-transform: rotate(360deg);
		    -moz-transform: rotate(360deg);
		    -ms-transform: rotate(360deg);
		    -o-transform: rotate(360deg);
		    transform: rotate(360deg);
		  }
		}
		@keyframes spinner {
		  0% {
		    -webkit-transform: rotate(0deg);
		    -moz-transform: rotate(0deg);
		    -ms-transform: rotate(0deg);
		    -o-transform: rotate(0deg);
		    transform: rotate(0deg);
		  }
		  100% {
		    -webkit-transform: rotate(360deg);
		    -moz-transform: rotate(360deg);
		    -ms-transform: rotate(360deg);
		    -o-transform: rotate(360deg);
		    transform: rotate(360deg);
		  }
		}
	/*loader design end*/
	label {
		display: inline-block;
	    max-width: 100%;
	    margin-bottom: 15px;
	    /*font-weight: bold;*/
    	color: #000;
    	font-size: 15px;
    }

	@media only screen and (min-width: 1200px){ 
		.container {
		    width: 1246px !important;
		}
	} 
    .fpad{
    	padding-top: 0px;
    }

    .form-group {
	    margin-bottom: 10px;
	}
	.sweet-alert[data-has-cancel-button="false"] button {
	    margin-left: -47px;
	    margin-top: -3px;
	}
	.sweet-alert {
		height: 225px;
	}
	.sa-confirm-button-container
	{
		margin-top: 4%;
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
	/*.admin-login-background{
				background:#fffeffe6;
				margin-top: 85px;
				border: 1px solid #20505f;
				border-radius: 5px;
				box-shadow: 2px 2px 2px 1px #0000005c;
			}*/
	.admin-login-background{
		position: relative;
		background: #224D56;
		margin-top: 12px;
		border-radius: 24px;
		box-shadow: 2px 2px 2px 1px #0000005c;
		height: auto; 
		margin-bottom: 30px;
	}
	.Ann {
    background-color: #2098df;

	height: 40px;
 
	border-radius: 20px;

	width: 91%;
    left: 5%;
	}

	.imgLabel-1 {
	    position: absolute;
	    color: white;
	    top: 3px;
	    left: -14px;
	    width: 100%;
	    font-size: 15px;
	    margin-top: -3px;
	    z-index: 1; 
	}
	.ann_label_home {
	font-size: 15px;
    width: 100%;
    cursor: pointer;
    top: 8px;
		    	
	}
	.btoon {
	    padding: 7px;
	    width: 465px;
	    background: #FF8400;
	    margin-left: -20px;
	    font-size: 19px;
	    color: #fff;
	    border: 1px solid #FF8400;
	}
	.geninfo{
		/*position: absolute;*/
		color: #FFFFFF;
		width: 234px;
		height: 27px;
		left: 169px;
		top: 168px;
		font-family: Exo 2;
		font-style: normal;
		font-weight: bold;
		font-size: 18px;
		line-height: 150%;
	}
	.genbody{
		/*position: absolute;*/
		width: 492px;
		height: 336px;
		left: 169px;
		top: 215px;
		font-family: Exo 2;
		font-style: normal;
		font-weight: normal;
		font-size: 15px;
		line-height: 120%;
		/* or 18px */
		color: #FFFFFF;
	}
	.lMob{
		font-family: Exo 2;
		font-weight: 500;
		font-size: 16px;
		line-height: 19px;
		color: #FFFFFF;
		width: 168px;
	}
	
	.capinp{
		font-family: Exo 2;
	    height: 46px;
	    background: #FFFFFF;
	    border: 1px solid #A4C2C7;
	    box-sizing: border-box;
	    border-radius: 5px;
	    margin-left: 13px;
	    margin-left: -96px;
	    margin-top: 9px;
	    width: 274px;
	}
	.refreshimg{
		height: 46px;
	    margin-top: 7px;
	    margin-left: 7px
	}
	.btnlog{
		position: inherit;
    	background: linear-gradient(180deg, #E48210 0%, #E47610 100%);
	    width: 400px;
    	margin-left: -17px;
	    height: 45px;
	    border-radius: 5px;
	    border: 1px solid #C7BFA4;
	}
	.texlog{
		/* position: absolute; */
	    width: 51px;
	    /* height: 22px; */
	    /* left: 965px; */
	    /* top: 472px; */
	    font-family: Exo 2;
	    font-style: normal;
	    /*font-weight: 600;*/
	    font-size: 18px;
	    line-height: 22px;
	    text-transform: uppercase;
	    color: #FFFFFF;
	}
	.form-group.has-error .help-block {
	    color: #dd4b39;
	    margin-left: 16px;
	}
	/*@media (max-width: 1024px){
		.genbody {
		    width: 912px;
		    height: auto;
		    font-size: 19px;
		}
		.admin-login-background {
		    margin-top: 10px;
		    width: 625px;
		    margin-left: 143px;
		    height: auto;
		    margin-bottom: 30px;
		}
		.capinp {
		    margin-left: -108px;
		}
		.refreshimg {
		    margin-top: -68px;
		    margin-left: 180px;
		}
		.btnlog {
		    width: 514px;
		    margin-left: -8px;
		    height: 53px;
		}
	}*/
	@media (min-width: 767px) and (max-width: 1024px){
		.genbody {
		    width: 727px;
		    height: auto;
		    font-size: 19px;
		}
		.admin-login-background {
		    margin-top: 14px;
		    width: 100%;
		    /*margin-left: 48px;*/
		    height: auto;
		    margin-bottom: 30px;
		}
		.capinp {
		    margin-left: -108px;
		}
		.refreshimg {
		    margin-top: -68px;
		    margin-left: 180px;
		}
		.btnlog {
		    width: 514px;
		    margin-left: -8px;
		    height: 53px;
		}
	}
	@media (min-width: 551px) and (max-width: 766px){
		.genbody{
			height: auto;
			width: auto;
		}
		.admin-login-background {
		    width: auto;
		    left: 0px;
		    height: auto;
		}
		.inpfname{
			margin-left: 213px;
			width: 311px;
		}
		.inpmname{
			margin-left: 213px;
			width: 311px;
		}
		.inplname{
			margin-left: 213px;
			width: 311px;
		}
		.inpmob {
		    margin-left: 213px;
		    width: 311px;
		}
		.captImg {
		    margin-right: -18px;
		}
		.capinp{
		    margin-left: 75px;
		}
		.refreshimg {
		    margin-left: 360px;
		    margin-top: -67px;
		}
		.forgotpass {
		    margin-left: -206px;
		}
		.btnlog {
		    width: 465px;
		    margin-left: 32px;
		    height: 46px;
		}
	}
	@media (min-width: 416px) and (max-width: 550px){
		.genbody{
			height: auto;
			width: 454px; 
		}
		.admin-login-background {
		   	margin-top: 12px;
		    width: 100%;
		    height: auto; 
		    /*left: -47px;*/
		}
		.inpfname{
			margin-left: 178px;
		}
		.inpmname{
			margin-left: 178px;
		}
		.inplname{
			margin-left: 178px;
		}
		.inpmob {
		    margin-left: 178px;
		}
		.inpPass {
    		margin-left: 178px;
		}
		.mores{
			margin-left: -20px;
		}
		.captImg {
		    margin-right: 11px;
		}
		.capinp{
		    margin-left: 46px;
		}
		.refreshimg {
		    margin-left: 330px;
		    margin-top: -67px;
		}
		.forgotpass {
		    margin-left: -198px;
		}
		.btnlog {
		    width: 455px;
		    margin-left: -7px;
		    height: 42px;
		}
	}
	@media (min-width: 377px) and (max-width: 415px){
		.geninfo {
		    margin-top: -59px;
		    height: 30px;
		    font-weight: 100;
		}
		.genbody {
		    width: auto;
		    height: auto;
		    margin-left: -4px;
		    margin-top: -9px;
		    /*font-size: 11px;*/
		}
		.login-box-body {
		    padding-top: 23px;
		}
		.admin-login-background {
			margin-top: 0px;
		    width: auto;
		    margin-left: 0px;
		}
		.center {
		    margin-left: 70px;
		    margin-top: 5px;
		}
		.inpmob {
		    margin-left: 179px;
		    top: 14px;
		    width: 199px;
		}
		.inpfname{
			margin-left: 179px;
		    top: 14px;
		    width: 199px;
		}
		.inpmname{
			margin-left: 179px;
		    top: 14px;
		    width: 199px;
		}
		.inplname{
			margin-left: 179px;
		    top: 14px;
		    width: 199px;
		}
		.captImg {
		    margin-right: 23px;
		    margin-top: 5px;
		}
		.mores{
			margin-left: -19px;
			/*font-size: 10px;*/
		}
		.capinp {
		    height: 42px;
		    margin-left: 34px;
		    margin-top: 12px;
		    width: 195px;
		}
		.refreshimg {
		    height: 43px;
		    margin-left: 240px;
		    margin-top: -64px;
		}
		.forgotpass {
		   /* font-size: 11px;*/
		    margin-top: -24px;
		    float: left;
		    line-height: 30px;
		}
		.btnlog {
		    width: 274px;
		    margin-left: 15px;
		    height: 37px;
		}
		.texlog {
		    font-size: 13px;
		}
	}
	@media (min-width: 200px) and (max-width: 376px){
			.geninfo {
			    margin-top: -73px;
			    height: 30px;
			    font-weight: 100;
			}
			.genbody {
				width: auto;
			    height: auto;
			    margin-left: -4px;
			    margin-top: -9px;
			    line-height: 16px;
			    font-size: 13px;
			}
			.admin-login-background {
				margin-top: 0px;
			    width: 100%;
			    margin-left: 0px;
			}
			.login-box-body {
			    padding-top: 20px;
			}
			.inpmob {
			    margin-left: 148px;
			    top: 14px;
			    width: 199px;
			}
			.inpfname{
				margin-left: 148px;
			    top: 14px;
			    width: 199px;
			}
			.inpmname{
				margin-left: 148px;
			    top: 14px;
			    width: 199px;
			}
			.inplname{
				margin-left: 148px;
			    top: 14px;
			    width: 199px;
			}
			.alogin{
				/*font-size: 13px;*/
			}
			.mores{
				margin-left: -19px;
				/*font-size: 10px;*/
			}
			.capinp {
			    height: 42px;
			    margin-left: 1px;
			    margin-top: 14px;
			    width: 195px;
			}
			.refreshimg {
			    height: 39px;
			    margin-left: 205px;
			    margin-top: -65px;
			}
			.forgotpass {
			   /* font-size: 11px;*/
			    margin-top: -24px;
			    float: left;
			    line-height: 30px;
			}
			.btnlog {
			    width: 280px;
			    margin-left: -10px;
			    height: 33px;
			}
			.texlog {
			    font-size: 13px;
			}
			.captImg {
			    margin-right: 0px;
			}
		} 
</style> 
<link href="<?php echo base_url(); ?>public/assets/css/text-scroll.css" rel="stylesheet" /> 
<section style=" padding-bottom: 35px;">
		<!--<div class="row" >
			<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 Ann">
	            <div class="hidden-sm hidden-xs col-md-1 col-lg-1 col-xl-1 ">
	            	<label class="imgLabel-1" ><img src="<?php echo base_url()?>upload/image/ann.png"></label>
	            </div>
	            <div class="col-sm-12 col-xs-12 col-md-11 col-lg-11 col-xl-11">	
		            <div class="scroll-hr">	
						<p class="ann_label_home">
							
							<a target='_blank' class='viewlink' style='text-decoration:none;color:#fff'  href="#">»&nbsp;Advertisement for the Different Posts of CMSS</a></h2>                           
						</p>
					</div>
				</div>
       		</div>
		</div>-->
<div class="container">
<div class="row">
 
    <div class="col-sm-12">
    	
        <div id="generalinfo" class="col-sm-6" style="margin-top: 30px; color: #fdfdfd;">
			<!--<h3 style="color: #E4791A;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">GENERAL INSTRUCTIONS:</h3><hr>-->
			<p class="geninfo">GENERAL INSTRUCTIONS:</p>
			<!--The Candidates applying online may:--->
				<!--<ul id="generalinfo_text" style="font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif; list-style: outside;color: #0f89d1;" type="disc">-->
				<ul >
					<li id="generalinfo_text" class="genbody" type="disc"></li>
			    	<!--<li>Read the brochure, eligibility criteria and availability of Seats Category-wise thoroughly before filling the application form.</li>
			    	<li>Keep all the information ready before starting to fill the Application Form.</li>
			    	<li>Keep ready the scanned (digital) images of your Photograph, Signature, 10th ,12th, Residence/Domicile and Caste Certificate (if applicable).</li>
			    	<li>OBC candidate has to upload caste certificate as per the GoI format. (State BC certificate will not be considered as proof of OBC) Applications submitted under OBC category without a valid OBC certificate will be rejected and no further correspondence will be entertained.</li>
			    	<li>Please note your Application Number for future reference.</li>
			    	<li>Incomplete application form will be rejected.</li>
			    	<li>After completion of application form download the print application.</li>
			    	<li>Application form will be considered complete only on receipt of the prescribed fees.</li>
			    	<li>Fees once paid will not be refunded under any circumstances.</li>-->
				</ul>
			<!--<ul style="color: white;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px; color: #000;">The application must be filled in English only, in CAPITAL letters except for signature with black pen and shade the corresponding  <b>oval with HB pencils only.</b></h4></li>
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px; color: #000;">Inadequate information furnished in each relevant column of the application form would entail rejection of candidature.</h4></li>
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px; color: #000;"><b>No request of examination center will be entertained</b></h4></li>
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px; color: #000;">Any application received after the closing date will not be considered.</h4></li>
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px; color: #000;">Any delay in receiving the blank application form by the candidate will not be considered as a valid reason for the late submission of the application form, after the closing date. <b> The institute will not accept any claim or responsibility for any postal delay or loss in transit.</b></h4></li>
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px; color: #000;">No claim of submission of application form received after the due date will be entertained on any account.<b>Postal and any other delay are at the risk of applicant.</b></h4></li>
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px; color: #000;">Duly filled-in application form with enclosures in all respects should be sent to <b>CENTER ADDRESS</b></h4></li>
			</ul>-->
			
   		</div>
 	<span class="loading" id="spanRegisterloader" style="display: none">Processing... </span>
       
	    <div class="col-sm-6 admin-login-background">

	    	<!--<h3 style="text-align: center;">Registration Form</h3>-->
	    	
		    <form class=" login-box-body" action="" method="post"  id="frmApplyNew" name="frmApplyNew" >
			   <input type="hidden" id="insCode" name="insCode" value="<?php echo $inscode; ?>"/>
			   <input type="hidden" id="insEncCode" name="insEncCode" value="<?php echo $ins; ?>"/>
			    <!--<input type="hidden" id="hidProgramCode" name="hidProgramCode" value="<?php echo $program_code; ?>"/> -->

			     
		  <!-- <?php $attr=array('class'=> 'login-box-body');echo form_open('?p=registration',$attr); ?> -->
		  		
		  		<!--<div class="col-md-12">
					<div class="form-group col-md-12">
						<div class="field-wrapper" data-validate = "Enter First Name">
					        <input class="input100" type="text" name="txtFirstName" id="txtFirstName" autocomplete="off" >
					        <div class="field-placeholder">
					        	<span>First Name</span>
					        </div>
					    </div>
					</div>
    			</div>--> 
    			<!--<div class="input-block">
				  <input type="text" name="input-text" id="input-text" required spellcheck="false">
				  <span class="placeholder">
				    Placeholder
				  </span>
				</div>-->
				
				<div class="row fpad form-group">
					<div class="col-sm-5 col-xs-5" >
					    <label class="mores" style="color:white;"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp; First Name</label>
		  			</div>
		  			<div class="row form-group " >
			      		<div class="input-group inpfname">
							<div class="input-group-addon ad" style="background: #ADDFE7;">
								<span class="input-group-text">
									<i class="fa fa-user" style="color:#E4791A"></i>
								</span>                    
							</div>
							<input class="form-control" style="background: #ADDFE7;" type="text" name="txtFirstName" id="txtFirstName" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()" maxlength="50" required="" placeholder="First Name" value="<?=isset($txtFirstName)?$txtFirstName:''?>">
							
						</div>
					</div>
				</div>
				<div class="row fpad form-group">
					<div class="col-sm-5 col-xs-5" >
					    <label class="mores" style="color:white;">&nbsp;&nbsp; Middle Name</label>
		  			</div>
		  			<div class="row form-group " >
			      		<div class="input-group inpmname">
							<div class="input-group-addon ad" style="background: #ADDFE7;">
								<span class="input-group-text">
									<i class="fa fa-user" style="color:#E4791A"></i>
								</span>                    
							</div>
							<input class="form-control" style="background: #ADDFE7;" type="text"  name="txtMiddleName" id="txtMiddleName" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()" maxlength="50"  placeholder="Middle Name" value="<?=isset($txtMiddleName)?$txtMiddleName:''?>">
							
						</div>
					</div>
				</div>
				<div class="row fpad form-group">
					<div class="col-sm-5 col-xs-5" >
					    <label class="mores" style="color:white;"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp; Last Name</label>
		  			</div>
		  			<div class="row form-group " >
			      		<div class="input-group inplname">
							<div class="input-group-addon ad" style="background: #ADDFE7;">
								<span class="input-group-text">
									<i class="fa fa-user" style="color:#E4791A"></i>
								</span>                    
							</div>
							<input class="form-control" style="background: #ADDFE7;" type="text" id="txtLastName" name="txtLastName" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()" maxlength="50" required="" placeholder="Last Name" value="<?=isset($txtLastName)?$txtLastName:''?>" data-placement="top" data-toggle="tooltip" title="For no last name put a dot(.)">
							
						</div>
					</div>
				</div>
				<div class="row fpad form-group">
					<div class="col-sm-5 col-xs-5" >
					    <label class="mores" style="color:white;"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp; Mobile No</label>
		  			</div>
		  			<div class="row form-group " >
			      		<div class="input-group inpmob">
							<div class="input-group-addon ad" style="background: #ADDFE7;">
								<span class="input-group-text">
									<i class="fa fa-mobile" style="color:#E4791A"></i>
								</span>                    
							</div>
							<input class="form-control" style="background: #ADDFE7;" type="text" id="txtCandidatePhone" name="txtCandidatePhone" autocomplete="off" maxlength="10" required="" placeholder="Mobile No" value="<?=isset($txtCandidatePhone)?$txtCandidatePhone:''?>" data-placement="top" data-toggle="tooltip" title="Your mobile no. ex: 9040123456">
							
						</div>
					</div>
				</div>
				<div class="row fpad form-group">
					<div class="col-sm-5 col-xs-5" >
					    <label class="mores" style="color:white;"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp; Email</label>
		  			</div>
		  			<div class="row form-group " >
			      		<div class="input-group inpmob">
							<div class="input-group-addon ad" style="background: #ADDFE7;">
								<span class="input-group-text">
									<i class="fa fa-envelope" style="color:#E4791A"></i>
								</span>                    
							</div>
							<input class="form-control" style="background: #ADDFE7;" type="text" name="txtEmail" id="txtEmail" required="" placeholder="Email" autocomplete="off" maxlength="80" value="<?=isset($txtEmail)?$txtEmail:''?>"  data-placement="top" data-toggle="tooltip" title="Your Email-id. ex: xyz@gmail.com">
							
						</div>
					</div>
				</div>
				<div class="row fpad form-group">
					<div class="col-sm-5 col-xs-5" >
					    <label class="mores" style="color:white;"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp; Date of Birth</label>
		  			</div>
		  			<div class="row form-group " >
			      		<div class="input-group inpmob">
							<div class="input-group-addon ad" style="background: #ADDFE7;">
								<span class="input-group-text">
									<i class="fa fa-calendar" style="color:#E4791A"></i>
								</span>                    
							</div>
							<input class="form-control" style="background: #ADDFE7;" type="text" name="txtdob1" id="txtdob1" required="" style="background-color: #fff;" autocomplete="off" placeholder="Date Of Birth" value="<?=isset($txtdob1)?$txtdob1:''?>" data-placement="top" data-toggle="tooltip" title="Your Date of Birth. ex: dd-mm-yyyy" readonly>
							
						</div>
					</div>
				</div>
				<div class="row fpad form-group">
					<div class="col-sm-5 col-xs-5" >
					    <label class="mores" style="color:white;"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp; Password</label>
		  			</div>
		  			<div class="row form-group " >
			      		<div class="input-group inpmob">
							<div class="input-group-addon ad" style="background: #ADDFE7;">
								<span class="input-group-text">
									<i class="fa fa-key" style="color:#E4791A"></i>
								</span>                    
							</div>
							<input class="form-control" style="background: #ADDFE7;" type="password" name="txtPassword" id="txtPassword" required="" autocomplete="off" placeholder="Password" data-placement="top" data-toggle="tooltip" title="Your password ex: P@ssw0rd">
							
						</div>
					</div>
				</div>
				<div class="row fpad form-group">
					<div class="col-sm-5 col-xs-5" >
					    <label class="mores" style="color:white;"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Confirm Password</label>
		  			</div>
		  			<div class="row form-group " >
			      		<div class="input-group inpmob">
							<div class="input-group-addon ad" style="background: #ADDFE7;">
								<span class="input-group-text">
									<i class="fa fa-key" style="color:#E4791A"></i>
								</span>                    
							</div>
							<input class="form-control" style="background: #ADDFE7;" type="password" name="txtConfirmPassword" id="txtConfirmPassword" required="" autocomplete="off" placeholder="Confirm Password" data-placement="top" data-toggle="tooltip" title="Your password ex: P@ssw0rd">
							
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
				     	<p id="captImg" class="captImg" align="center">
					      	<!--<a href="javascript:void(0);" onclick="refresh_captcha()" class="refreshCaptcha" id="refreshCaptcha" >
					    	<img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>-->
					    </p>
			    		
					</div>
					<div class="col-sm-6">
						<div class="row form-group" style="margin-top: -9px;">
				  		<!--<label class="col-lg-4"><i style="color:red;font-size:18px;">*</i>Captcha Code</label>-->
					  		<div class="col-lg-8">
					  			<input class="form-control capinp" type="text"  name="txtCaptcha" id="txtCaptcha" required="" autocomplete="off" placeholder="Captcha" maxlength="6" onkeyup="this.value=this.value.toUpperCase()">
				       		</div>
			  			   	<div class="col-lg-2">
			  			   		<a href="javascript:void(0);" onclick="refresh_captcha()" class="refreshCaptcha" id="refreshCaptcha" ><img class="refreshimg" src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
			  			   	</div>
						</div>	
					</div>
				</div>
				
				    
		
                 <div class="row fpad">
				    <div class="col-sm-12 col-xs-6" align="center" >
			   	 		<button class="btnlog" type="submit"  onclick="return validate();" id="btnRegister" name="btnRegister"><span class="texlog"> REGISTER NOW</span></button>
			   	 		<!--<button class="btoon" style="margin-left: 49px;width: 166px;" type="submit"  onclick="return validate();" id="btnRegister" name="btnRegister"><i class="fa fa-user-plus"></i> Register Now</button>-->
		    		</div>
		    	</div>
		    </form> 
		    <form class=" login-box-body" action="" method="post"  id="frmOTP" name="frmOTP" hidden >
			   <input type="hidden" id="insCode" name="insCode" value="<?php echo $inscode; ?>"/>
			   <input type="hidden" id="insEncCode" name="insEncCode" value="<?php echo $ins; ?>"/>
			    <!--<input type="hidden" id="hidProgramCode" name="hidProgramCode" value="<?php echo $program_code; ?>"/> -->

			     
		  <!-- <?php $attr=array('class'=> 'login-box-body');echo form_open('?p=registration',$attr); ?> --> 
		    	<div class="row fpad form-group">
			    	
				         <label class="col-lg-4"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-user" style="color:#E4791A"></i>  OTP</label>
				     
				     <div class="col-lg-8">
				      <input class="form-control" type="text" name="txtOTP" id="txtOTP" autocomplete="off"  maxlength="4" required="" placeholder="4 Digit OTP" >
				     <!--  <span class="highlight"></span>
				      <span class="bar"></span> -->
				     
				    </div>
				    </div>
				    <div class="col-sm-12 col-xs-12">
			     	
				      	<a href="javascript:void(0);" class="resendOTP" id="resendOTP" onclick="resend_OTP()" >
				    	<img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/> Resend OTP</a>
				    </p>
			    </div>

                  
                 <div class="row fpad">
				    <div class="col-sm-12 col-xs-6" align="center" >
			   	 		<button class="btoon" style="margin-left: 49px;width: 166px;" type="submit"  onclick="return validate_OTP();" id="btnVerify" name="btnVerify"><i class="fa fa-user-plus"></i> Verify</button>
		    		</div>
		    	</div>
		    </form>
		      
	    </div>


     </div>

 </div>

</div>
<!--Agreement Modal  -->
<div class="modal fade" id="Popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header" style="background-color: #00008B;">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: rgb(255, 255, 255); margin-left: 89%;"><span aria-hidden="true">&times;</span></button>
    		<h4 class="modal-title" id="myModalLabel"style="color:#E4791A;"><b> IMPORTANT DATES</b></h4>
  		</div>
      <!--<div class="modal-header" style="background-color: #00008B;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"style="color:#E4791A;"><span><i class="fa fa-info fa-lg details-favoriteicon" style="color: #E4791A;"></i></span><b> TERMS AND CONDITIONS</b></h4>
      </div>-->
      <div class="modal-body" style="height: 430px;">
		    
	    	<ol>
	    		<li><h4 align="justify" style="font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;padding-right: 20px;">The candidates selected for admission must deposit the tuition and other fees on or before the specified date stipulated in Admission call center.</h4></li>
	    		<li><h4 align="justify" style="font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;padding-right: 20px;">Fees for second semester onwards are to be paid within 2 weeks from the date of commencement of the semester.</h4></li>
	    		<li><h4 align="justify" style="font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;padding-right: 20px;">The selected candidates have to sign on Code of Conduct at the time of admission.</h4></li>
	    		<li><h4 align="justify" style="font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;padding-right: 20px;">The selected candidates have to submit original certificates of entry qualification, date of birth , community certificate and reservation quota certificate, if applicable, at the time of admission.</h4></li>
	    		<li><h4 align="justify" style="font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;padding-right: 20px;">Practical training will be provide on industry size machinery in shifts depending o the exigencies. The students have to attend shifts on rotation basis in an industrial environment.</h4></li>
	    		<li><h4 align="justify" style="font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;padding-right: 20px;">Institute has rights to expel any student from the course on the grounds of communicable disease/unsatisfectory performance / lack of attendance / misconduct / ragging / unlawful activities.</h4></li>
	    		<li><h4 align="justify" style="font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;padding-right: 20px;"><b>Ragging is strictly prohibated as per Supreme Court order on writ petition no. (c) 656/1998 in any form will lead to explusion of students from the institute and hostel.</b></h4></li>		
	    	</ol>
	    </div>
      
      <!--<div class="modal-footer">
       
      </div>-->
    </div>
  </div>
</div>
</section>

<script src="<?php echo base_url(); ?>public/assets/js/sha512.js"></script>
<script>

	$.ajax({
		url:base_url+"ajax_controller/general_info",  
		type:"post",
		//data:{'admcode':admcode},
		success:function(response){ 
			var obj = JSON.parse(response);
			//console.log('67567',obj);
			if(obj[0]['instruction'] != undefined && obj[0]['instruction'] != '')
			{
				$('#generalinfo_text').html(obj[0]['instruction']);	
				//$('#generalinfo').show();
			}
			else
			{
				toastr.error("We are unable to Process.Please contact Support");
			}
				
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support"); 
		}
	});
	
	$.ajax({
	  url:base_url+"ajax_controller/create_captcha",
	  type:"post",
	  success:function(response){ 
	   var value = 'hello';
	   refresh = base_url + 'public/assets/images/refresh.png';
	   //var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha" onclick="refresh_captcha()"  id="refreshCaptcha" ><img src="'+refresh+'"/></a>';
	   var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha" onclick="refresh_captcha()"  id="refreshCaptcha" ></a>';
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
	   //var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha" onclick="refresh_captcha()"  id="refreshCaptcha" ><img src="'+refresh+'"/></a>';
	   var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha" onclick="refresh_captcha()"  id="refreshCaptcha" ></a>';
	   $("#captImg").html(data);
	     });
	}
	function resend_OTP()
	{
	  var formData = new FormData(document.getElementById("frmApplyNew"));
	  $.ajax({
				url:base_url+"ajax_controller/send_pro_otp",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response)
				{  
					var result = JSON.parse(response);
					if(result.status == "SUCCESS")
					{
						//alert("sdfdsfsd");return;
						toastr.success("OTP has been sent successfully.");
						
						
					}
					
					
					
					
				},
				error:function()
				{
					toastr.error('Unable to Save.Please Try Again ');	
				}
			});
		
	}
	function validate(){
		var errorMessage = "";
		var message='<div>';
		if($("#txtFirstName").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtFirstName").focus();
			return false;
		}
		if($("#txtLastName").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtLastName").focus();
			return false;
		}
		if($("#txtdob1").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtdob1").focus();
			return false;
		}
		
		if($("#txtCandidatePhone").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtCandidatePhone1").focus();
			return false;
		}
		
		if($("#txtEmail").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtEmail").focus();
			return false;
		}
		
		if($("#txtPassword").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtPassword1").focus();
			return false;
		}
		if($("#txtConfirmPassword").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtConfirmPassword").focus();
			return false;
		}
		if($("#txtCaptcha").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtCaptcha1").focus();
			return false;
		}
		if($("#txtPassword").val() != $("#txtConfirmPassword").val())
		{
			/*$("#txtPassword1").val('');*/
			$("#txtConfirmPassword").val('');
			$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtPassword', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			
		}
		else
		{
			var reg_user_id = document.getElementById("txtCandidatePhone").value; 
			var txtNewPassword1 = document.getElementById("txtPassword").value; 
			var encSaltSHAPassMobile = encryptShaPassCode(reg_user_id,txtNewPassword1);
			$('#txtPassword').val(encSaltSHAPassMobile);
			$('#txtConfirmPassword').val(encSaltSHAPassMobile);
		}
		
		return true;
			
	}
	function validate_OTP(){
		var errorMessage = "";
		var message='<div>';
		if($("#txtOTP").val() == '')
		{
			$('#frmOTP').data('bootstrapValidator').updateStatus('txtOTP', 'NOT_VALIDATED', null).validateField('txtFirstName');
			//$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			
			//toastr.error("Please enter username and password");
			$("#txtOTP").focus();
			return false;
		}
		
		
		
		return true;
			
	}
	$('input[type="checkbox"]').on('change', function(e){
   		if(e.target.checked){
    		$('#chkbox').modal();
   		}
	});
	$(document).ready(function() {
		$(".field-wrapper .field-placeholder").on("click", function () {
            $(this).closest(".field-wrapper").find("input").focus();
            $(this).closest(".field-wrapper").find("select").focus();
        });
        $(".field-wrapper input").on("keyup", function () {
            var value = $.trim($(this).val());
            if (value) {
                $(this).closest(".field-wrapper").addClass("hasValue");
            } else {
                $(this).closest(".field-wrapper").removeClass("hasValue");
            }
        });
        $(".field-wrapper select").on("keyup", function () {
            var value = $.trim($(this).val());
            if (value) {
                $(this).closest(".field-wrapper").addClass("hasValue");
            } else {
                $(this).closest(".field-wrapper").removeClass("hasValue");
            }
        });
        $(".field-wrapper textarea").on("keyup", function () {
            var value = $.trim($(this).val());
            if (value) {
                $(this).closest(".field-wrapper").addClass("hasValue");
            } else {
                $(this).closest(".field-wrapper").removeClass("hasValue");
            }
        });
		$('#frmApplyNew').bootstrapValidator({
	        message: 'This value is not valid',
	        /*feedbackIcons: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },*/
			submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{
				//document.getElementById('txtPassword').type="password";
				var formData = new FormData(document.getElementById("frmApplyNew"));
				 $("#spanRegisterloader").show();
				$.ajax({
					url:base_url+"Index/registration",
					type:"post",
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
			       
					success:function(response)
					{  

					$("#spanRegisterloader").hide();
						var result = JSON.parse(response);
						if(result.status == "SUCCESS")
						{
							//alert("sdfdsfsd");return;
							swal({
								title: "Registration",
								text: "Congratulation!!! Your registration successfully completed. Please check your mail  for OTP Verification.",
								//type: "success"
							},
							function(isConfirm) {
							  if (isConfirm) {
							   $("#frmApplyNew").hide();
							   $("#frmOTP").show();
							   
							}
							});
							
						}
						else if(result.status == 'ERROR1')
						{
							swal({
								title: "Registration",
								text: "You have already registered with this mobile no. Please check your mail  for OTP Verification.",
								//type: "success"
							},
							function(isConfirm) {
							  if (isConfirm) {
							   $("#frmApplyNew").hide();
							   $("#frmOTP").show();
							   
							}
							});
						}
						else
						{
							if(result.status == 'captchaerror')
							{
								swal({
									title: "Captcha Error",
									text: "Invalid Captcha",
									//type: "error"
								},
								function(isConfirm) {
								  if (isConfirm) {
									$("#txtCaptcha").val('');
									$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha');
									refresh_captcha();
									$('.loadingRPimage').fadeIn(250);								}
								});	
								
							}
							else if(result.status == 'ERROR')
							{
								swal({
									title: "Error",
									text: result.msg,
									//type: "error"
								},
								function(isConfirm) {
								  if (isConfirm) {
									$("#txtPassword").val('');
									$("#txtConfirmPassword").val('');
									$("#txtCandidatePhone").val('');
									$("#txtCaptcha1").val('');
									refresh_captcha();
									$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtCandidatePhone', 'NOT_VALIDATED', null).validateField('txtCandidatePhone');
									$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtPassword', 'NOT_VALIDATED', null).validateField('txtPassword');
									$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
									$('.loadingRPimage').fadeIn(250);							}
								});	
							}
							else
							{
								swal({
									title: "Error",
									text: result.msg,
									//type: "error"
								},
								function(isConfirm) {
								  if (isConfirm) {
									$("#txtPassword").val('');
									$("#txtConfirmPassword").val('');
									$("#txtEmail").val('');
									$("#txtCaptcha1").val('');
									refresh_captcha();
									$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
									$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtPassword', 'NOT_VALIDATED', null).validateField('txtPassword');
									$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
									$('.loadingRPimage').fadeIn(250);						}
								});	
								
							}
						}
						
					},
					error:function()
					{
						toastr.error('Unable to Save.Please Try Again ');	
					}
				});
			},
	        fields: {
				txtFirstName: {
	                validators: {
	                	notEmpty: {
	                        message: "Please Enter First Name"
						},
						regexp: {
	                        regexp: /^([A-Za-z._,]+)$/,
	                        message: "Special characters and Numbers are not allowed"
						}, 
						stringLength: {
							max: 50,
							min: 1,
							message: 'First name must be 1 to 50 characters'
						}
	                }
	            },
				txtMiddleName: {
	                validators: {
	                    regexp: {
	                        regexp: /^([A-Za-z._,]+)$/,
	                        message: "Special characters and Numbers are not allowed"
						}, 
						stringLength: {
							max: 50,
							min: 0,
							message: 'Middle name must be 0 to 50 characters'
						}
	                }
	            },
				txtLastName: {
	                validators: {
	                	notEmpty: {
	                        message: "Please Enter Last Name"
						},
						regexp: {
	                        regexp: /^([A-Za-z.,_]+)$/,
	                        message: "Special characters and Numbers are not allowed"
						}, 
						stringLength: {
							max: 50,
							min: 1,
							message: 'Last name must be 1 to 50 characters'
						}
	                }
	            },
				agree: {
	                validators: {
						notEmpty: {
	                        message: "Please check the term and condition"
						}
	                }
	            },
				txtdob1: {
	                validators: {
						notEmpty: {
	                        message: "Please Enter Date of Birth"
						}
	                }
	            },
	            
				txtCandidatePhone: {
	                validators: {
	                	notEmpty: {
	                        message: "Please Enter Mobile No"
						},
						integer: {
								message: 'The value can contain only numbers'
							}, 
						stringLength: {
							max: 10,
							min: 10,
							message: 'Phone no must be 10 characters'
						}
					}
				},
	            txtEmail: {
	                validators: {
	                	notEmpty: {
	                        message: "Please Enter Email"
						},
						emailAddress: {
	                        message: 'The value is not a valid email address'
	                    }
	                }
	            },
	            
				txtPassword: {
					validators: {
						notEmpty: {
							message: 'This field can\'t left blank'
						},
	            		regexp: {
							regexp: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[$@!%?&]).{6,12}$/,
							message: "The password should contain Minimum 6 and Maximum 12 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character:"
						}/*,
						identical: {
		                    field: 'txtConfirmPassword',
		                    message: 'New password and its confirm are not the same'
	                	}*/
					}
				},
				txtConfirmPassword: {
					validators: {
						notEmpty: {
							message: 'This field can\'t left blank'
						},
						identical: {
		                    field: 'txtPassword',
		                    message: 'New password and its confirm are not the same'
	                	}
					}
				},
				txtCaptcha: {
	                validators: {
	                	notEmpty: {
	                        message: "Please Enter Captcha"
						},
	                    
						regexp: {
	                        regexp: /^([A-Za-z0-9]+)$/,
	                        message: "Special characters are not allowed"
						}, 
						stringLength: {
							max: 6,
							min: 6,
							message: 'Captcha must be 6 characters'
						}
	                }
	            }	/*,
	            cmbState: {
	                validators: {
	                    notEmpty: {
	                        message: 'Please Enter State'
	                    }
					}
				}*/
			}
		});
		$('#frmOTP').bootstrapValidator({
	        message: 'This value is not valid',
	        /*feedbackIcons: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },*/
			submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{
				//document.getElementById('txtPassword').type="password";
				var formData = $('#frmOTP, #frmApplyNew').serialize();
				$("#spanRegisterloader").show();

				
				$.ajax({
					url:base_url+"Index/otp_verification",
					type:"post",
					data:formData,
					
					success:function(response)
					{  
						$("#spanRegisterloader").hide();
						var result = JSON.parse(response);
						if(result.status == "SUCCESS")
						{
							//alert("sdfdsfsd");return;
							swal({
								title: "Registration",
								text: "Congratulation!!! Your registration successfully completed. Please proceed for login.",
								//type: "success"
							},
							function(isConfirm) {
							  if (isConfirm) {
							    window.location.href = ("<?php echo base_url() ?>Index/institute_login/ins/<?php echo $ins ?>");
							   
							}
							});
							
						}
						else if(result.status == 'ERROR1')
						{
							swal({
								title: "Registration",
								text: "You have already registered with this mobile no. Please check your mail or sms for OTP Verification.",
								//type: "success"
							},
							function(isConfirm) {
							  if (isConfirm) {
							   $("#frmApplyNew").hide();
							   $("#frmOTP").show();
							   
							}
							});
						}
						else
						{
							if(result.status == 'captchaerror')
							{
								swal({
									title: "Captcha Error",
									text: "Invalid Captcha",
									//type: "error"
								},
								function(isConfirm) {
								  if (isConfirm) {
									$("#txtCaptcha").val('');
									$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha');
									refresh_captcha();
									$('.loadingRPimage').fadeIn(250);								}
								});	
								
							}
							else if(result.status == 'ERROR')
							{
								
									$('#frmOTP').data('bootstrapValidator').updateStatus('txtOTP', 'NOT_VALIDATED', null).validateField('txtOTP');
									toastr.error("Incorrect OTP");							
									
							}
							else
							{
								swal({
									title: "Error",
									text: result.msg,
									//type: "error"
								},
								function(isConfirm) {
								  if (isConfirm) {
									$("#txtPassword").val('');
									$("#txtConfirmPassword").val('');
									$("#txtEmail").val('');
									$("#txtCaptcha1").val('');
									refresh_captcha();
									$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
									$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtPassword', 'NOT_VALIDATED', null).validateField('txtPassword');
									$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
									$('.loadingRPimage').fadeIn(250);						}
								});	
								
							}
						}
						
					},
					error:function()
					{
						toastr.error('Unable to Save.Please Try Again ');	
					}
				});
			},
	        fields: {
				
	            txtOTP: {
	                validators: {
	                    notEmpty: {
	                        message: 'Please Enter State'
	                    }
					}
				}
			}
		});
		$("#txtPassword").change(function(){
			$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');	
		});
		$('[data-toggle="tooltip"]').tooltip(); //for tooltip
		// for disable write click and copy past  code start
			
			$(document).bind("contextmenu",function(e){
			   return false;
			});
			$('body').bind('cut copy paste', function (e) {
		        e.preventDefault();
		    });
			
		
		// for disable write click and copy past code end
	 	$('#txtdob1').datepicker({
	    	format: "dd-mm-yyyy",
		  	todayHighlight:true,
		  	autoclose:true,
		  	endDate:"+0d",
		  	startDate:"<?=$ageMinDate[0]['birth_start_date']?>",
		  	//endDate:"<?=$ageMinDate[0]['birth_end_date']?>",
	    }).on('changeDate', function(e) { 
			$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtdob1', 'VALID', null);
			$(this).data('datepicker').hide();
		});
    });
	
</script>
