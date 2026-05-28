<link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet" />
<?php 
$cmbState = ' ';
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d', now());
$now = date("Y-m-d H:i:s",now());
if($this->session->flashdata('post_data')){
	$post_data = $this->session->flashdata('post_data');
	$txtCandidatePhone = $post_data['txtCandidatePhone'];
	$txtdob1 = $post_data['txtdob1'];
	$txtFirstName = $post_data['txtFirstName'];
	$txtMiddleName = $post_data['txtMiddleName'];
	$txtLastName = $post_data['txtLastName'];
	$txtEmail = $post_data['txtEmail'];
	$cmbState = $post_data['cmbState'];
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
	.loadingRPimage {
	    position: fixed;
	    top: 0;
	    left: 0;
	    height: 100vh; /* to make it responsive */
	    width: 100vw; /* to make it responsive */
	    overflow: hidden; /*to remove scrollbars */
	    z-index: 99999; /*to make it appear on topmost part of the page */
	    display: none; /*to make it visible only on fadeIn() function */
	    background: none repeat scroll 0% 0% rgba(104, 136, 164, 0.44); /*to make background blur */
	    text-align:center;
	}
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
	.sweet-alert[data-has-cancel-button="false"] button {
	    margin-left: -47px;
	    margin-top: -3px;
	}
	.sweet-alert {
		height: 211px;
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
<div class="loadingRPimage">
    <img src="<?=base_url()?>upload/image/loader/loading.gif"/>
</div>
<section style="background: url(<?php echo base_url(); ?>upload/image/background_image.jpg); padding-bottom: 15px;">
<div class="container">
 <div class="row">
 	<input type="hidden" id="birthStartDate" value="<?php echo $birth_start_date; ?>"/>
 	<input type="hidden" id="birthEndDate" value="<?php echo $birth_end_date; ?>"/>
 	<div style="color: #ffffff;background-color:rgb(228, 121, 26); bfont-size:15px;"></div>
    <div class="col-sm-12">
        <div class="col-sm-6" style="margin-top: 30px; ">
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
			    	<!--<li>Step 8 - <b>Candidates belonging to North East region are exempted from paying the application fees. Candidate needs to upload a valid attested residential certificate.</b></li>-->
			    	<li>Step 7 - Now you can take a printout of your application.</li>
			    	<b>Important Note: </b> Your mobile number will be your effective login id and your date of birth will be your effective login password for your future login requirement!
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
 		<?php if($program_start_date <= $date && $program_end_date >= $date){ ?>
       <!--  <div class="col-sm-1" style="padding: 0; margin: 0;"></div> -->
	    <div class="col-sm-6" style="background: #f1f1f1; margin-top: 40px; box-shadow: 10px 10px 2px 1px rgba(0, 0, 0, .2);">
	    	<h3 style="text-align: center;">Registration Form</h3>
	    	<?php include_once(dirname(dirname(dirname(__FILE__))) . '/template_config/alerts.php');?>
		    <form class=" login-box-body" action="" method="post"  id="frmApplyNew" name="frmApplyNew" >

		  <!-- <?php $attr=array('class'=> 'login-box-body');echo form_open('?p=registration',$attr); ?> --> 
 				<input type="hidden" id="insCode" name="insCode" value="<?php echo $inscode; ?>"/>
		    	<div class="row fpad form-group">
			    	<div class="col-sm-4 col-xs-4" style="color:#E4791A">
				         <label><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-user" style="color:#E4791A"></i>  First Name</label>
				     </div>
				     <div class="col-sm-8 col-xs-8">
				      <input class="form-control" type="text" name="txtFirstName" id="txtFirstName" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()" maxlength="50" required="" placeholder="First Name" value="<?=isset($txtFirstName)?$txtFirstName:''?>">
				     <!--  <span class="highlight"></span>
				      <span class="bar"></span> -->
				     
				    </div>
				    </div>

                   <div class="row fpad form-group">
				    <div class="col-sm-4 col-xs-4">
					 <label>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-user" style="color:#E4791A"></i>  Middle Name</label>
                    </div>
                    <div class="col-sm-8 col-xs-8">
						<input class="form-control" type="text"  name="txtMiddleName" id="txtMiddleName" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()" maxlength="50"  placeholder="Middle Name" value="<?=isset($txtMiddleName)?$txtMiddleName:''?>">
					   </div>
					</div>

					<div class="row fpad form-group">
					<div class="col-sm-4 col-xs-4">   
					  <label><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-user" style="color:#E4791A"></i>  Last Name</label>
					 </div>
					 <div class="col-sm-8 col-xs-8">
					 	<input class="form-control" type="text" id="txtLastName" name="txtLastName" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()" maxlength="50" required="" placeholder="Last Name" value="<?=isset($txtLastName)?$txtLastName:''?>">
					         (If No last name , Enter First Name)
					</div>
					</div>
				
				<div class="row fpad form-group">
					<div class="col-sm-4 col-xs-4"> 
					 <label><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-mobile" style="color:#E4791A"></i>  Mobile No </label>
					 </div>
					 <div class="col-sm-8 col-xs-8"> 
						 	<input class="form-control" type="text" id="txtCandidatePhone" name="txtCandidatePhone" autocomplete="off" maxlength="10" required="" placeholder="Mobile No" value="<?=isset($txtCandidatePhone)?$txtCandidatePhone:''?>" data-placement="top" data-toggle="tooltip" title="Your mobile no. ex: 9040123456">
						</div>
					</div>

					<div class="row fpad form-group">
						<div class="col-sm-4 col-xs-4"> 
					 		<label><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-envelope" style="color:#E4791A"></i>  Email  </label>
					 	</div>
					 	<div class="col-sm-8 col-xs-8">     
					  		<input class="form-control" type="text" name="txtEmail" id="txtEmail" required="" placeholder="Email" autocomplete="off" maxlength="80" value="<?=isset($txtEmail)?$txtEmail:''?>"  data-placement="top" data-toggle="tooltip" title="Your Email-id. ex: xyz@gmail.com">
					 	</div>
					</div>
					<div class="row fpad form-group">
						<div class="col-sm-4 col-xs-4"> 
					 		<label><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-envelope" style="color:#E4791A"></i>  State  </label>
					 	</div>
					 	<div class="col-sm-8 col-xs-8">  
					 		<select name="cmbState" id="cmbState" class="form-control">
							</select>   
					  	</div>
					</div>    
						

				<div class="row fpad form-group">
				    <div class="col-sm-4 col-xs-4">   
				      <label><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-calendar" style="color:#E4791A"></i>  Date of Birth </label>
				     </div>
				     <div class="col-sm-8 col-xs-8">   
				      <input class="form-control" type="text" name="txtdob1" id="txtdob1" autocomplete="off" placeholder="Date Of Birth" value="<?=isset($txtdob1)?$txtdob1:''?>" data-placement="left" data-toggle="tooltip" title="Your Date of Birth. ex: dd-mm-yyyy" readonly>
				      </div>
				    </div>

				
			    <div class="row fpad form-group">
			    	<div class="col-sm-4 col-xs-4">
				      <label><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-shield" style="color:#E4791A"></i>  Captcha Code </label>
				     </div>
				    <div class="col-sm-8 col-xs-8 ">
					      <input class="form-control" type="text" name="txtCaptcha" id="txtCaptcha" required="" autocomplete="off" placeholder="Captcha" maxlength="6" onkeyup="this.value=this.value.toUpperCase()">
					  </div>
                      
				</div>
				<div class="col-sm-12 col-xs-12">
			     	<p id="captImg" align="right">
				      	<a href="javascript:void(0);" class="refreshCaptcha" id="refreshCaptcha" >
				    	<img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
				    </p>
			    </div>
				<!--     <div class="row fpad">
						 
						    <p id="captImg" align="right">
						      <a href="javascript:void(0);" class="refreshCaptcha" id="refreshCaptcha" >
						      <img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
						    </p>
					</div>
				    		 -->	    
			    <!--<div class="row fpad form-group">
			    	<div class="col-sm-12 col-xs-12" >
					   	<input type="checkbox" id="agree" name="agree"  required  ><span data-toggle="modal" data-target="#Popup" style="cursor: pointer;color:#000;font-size: 15px;"> I agree to terms and conditions</span> 
					</div>
                 </div>-->

                 <div class="row fpad">
				    <div class="col-sm-12 col-xs-6" align="center" >
			   	 		<button class="btoon" style="margin-left: 49px;width: 166px;" type="submit" onclick="return validate();"  id="btnRegister" name="btnRegister"><i class="fa fa-user-plus"></i> Register Now</button>
		    		</div>
		    	</div>
		    </form>
		      
	    </div>
		<?php 
		 }
		 else
		 {
		?>
		 	 <div class="col-sm-6" style="background: #f1f1f1; margin-top: 40px; box-shadow: 10px 10px 2px 1px rgba(0, 0, 0, .2);">
		 	 	<img src="<?php echo base_url(); ?>downloads/sorry.png"/>
		 	 </div>
		<?php 
		 }
		 ?>

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
<script src="<?php echo base_url(); ?>public/template_lib/plugins/jquery.datepick/js/jquery.plugin.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/jquery.datepick/js/jquery.datepick.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/bootstrap-select.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/jquery.datepick/js/jquery.plugin.js"></script> 
<script>
	$(document).ajaxSend(function(){
	    $('.loadingRPimage').fadeIn(250);
	});
	$(document).ajaxComplete(function(){
	    $('.loadingRPimage').fadeOut(250);
	});
	
	function validate(){
		var errorMessage = "";
		var message='<div>';
		if(document.getElementById("txtdob1").value == '' || document.getElementById("txtdob1").value == null)
		{
			errorMessage += "Please Enter Date Of Birth.<br/>";
		}
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
		else{
			<?php if($this->session->flashdata('info')){ ?>
				swal({
					title: "Registration",
					text: "Congratulation!!! Your registration successfully completed. Please check your mail for details.",
					//type: "success"
					},
					function(isConfirm) {
					  if (isConfirm) {
					    window.location.href = ("<?php echo base_url() ?>?p=login");
					  }
					});
			<?php }
			else
			{
			?>
				$('.loadingRPimage').fadeIn(250);
			<?php
			} ?>
			return true;
		}
			
	}//alert(errorMessage);
	
	var cmbState = "<?=$cmbState?>";
	
	$.ajax({
		url:base_url+"ajax_controller/select_state_details",
		type:"post",
		//data:institutedata,
		success:function(response){  
			var options = "<option value =''>Select State</option>";
			var res1 = JSON.parse(response);
			
			//alert(res1[0].state_code);
			for( i = 0;i< res1.length ;i++){
				if(res1[i].state_code == cmbState){
							selected='selected';
						}else{
							selected='';
						}
				options = options + "<option value="+res1[i].state_code+" "+selected+">"+res1[i].state_name+"</option>";
			}
			$('#cmbState').html("");   //campusid from academicPeriod
			$('#cmbState').append(options);
			
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
	$('#frmApplyNew').bootstrapValidator({
		
        message: 'This value is not valid',
        
        fields: {
			
			txtFirstName: {
                validators: {
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
            txtCandidatePhone: {
                validators: {
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
					emailAddress: {
								message: 'The input is not a valid email address'
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
			txtCaptcha: {
                validators: {
                    
					regexp: {
                        regexp: /^([A-Za-z0-9]+)$/,
                        message: "Special characters are not allowed"
					}, 
					stringLength: {
						max: 6,
						min: 6,
						message: 'Captcha code must be 6 characters'
					}
                }
            },
            cmbState: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			},
            txtdob1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
				}
			}
		}
	});
	
	$('input[type="checkbox"]').on('change', function(e){
   		if(e.target.checked){
    		$('#chkbox').modal();
   		}
	});
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
	 	/*$('#txtdob1').datepicker({
	    	format: "dd-mm-yyyy",
		  	todayHighlight:true,
		  	autoclose:true,
		  	//endDate:"+0d",
		  	startDate:"<?=$ageMinDate[0]['birth_start_date']?>",
		  	endDate:"<?=$ageMinDate[0]['birth_end_date']?>",
	    }).on('changeDate', function(e) { 
			$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtdob1', 'VALID', null);
			$(this).data('datepicker').hide();
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
		
		$('#txtdob1').datepicker({ 
			format: 'dd-mm-yyyy',
			startDate: min_Date,
			endDate: max_Date,
			autoclose:true,
			//yearRange: '1980:2003'
		}).on('changeDate', function () {
			$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtdob1', 'VALIDATED').validateField('txtdob1');
	 	});
		//$('#txtdob1').datepick({yearRange: '1980:2003'}); 
    });
	<?php if($this->session->flashdata('info')){ ?>
		swal({
			title: "Registration",
			text: "Congratulation!!! Your registration successfully completed. Please check your sms / mail for details.",
			//type: "success"
			},
			function(isConfirm) {
			  if (isConfirm) {
			  	window.location.href = ("<?php echo base_url() ?>index/institute_login/ins/<?php echo $ins; ?>");
			  }
			});
	<?php } ?>
	
	
	
</script>
