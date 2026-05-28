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
    <title>Online Recruitment Portal</title>
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
    <link href="<?=base_url()?>public/assets/css/rec_style.css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrapValidator.js"></script>
    <!-- Toaster Plugin -->
	<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.js"></script>
	<!--<script type="text/javascript" src="<?php echo base_url(); ?>public/js/interface.js"></script>-->
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118010124-1"></script>
	
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-118010124-1');
	</script>
	
	


	
	<script type="text/javascript">
		/* CODE FOR TOASTR */
		toastr.options = {
		  	"closeButton": true,
		  	"debug": false,
		  	"progressBar": false,
		  	"positionClass": "toast-bottom-right",//top-right,bottom-left,top-left,top-full-width,bottom-full-width,top-center,bottom-center
		 	"onclick": null,
		  	"showDuration": "300",
		  	"hideDuration": "2000",
		  	"timeOut": "3000",
		  	"extendedTimeOut": "2000",
		  	"showEasing": "swing",
		  	"hideEasing": "linear",
		  	"showMethod": "fadeIn",
		  	"hideMethod": "fadeOut"
		}
		
		base_url = "<?php echo base_url()?>"; 
	</script>
	
	
	<!-- End Facebook Pixel Code -->
	
	
  </head>
<?php 
	//$inscode1 = $this->session->set_userdata('ins_code', $institute);
	$logo = '';
	$inscode = '';
	$ins = '';
	$insname = '';
	foreach($institute as $row){ 
		$inscode = $row['institute_code'];
		$ins =  encrypt_decrypt('encrypt', $inscode);
		$insname = $row['institute_name'];
		$logo = $row['image_url'];	
	}
	$cmbState = ' ';
	date_default_timezone_set('Asia/Kolkata');
	$date = date('Y-m-d', now());
	$date1 = date('d-m-Y', now());
	$now = date("Y-m-d H:i:s",now());
	if($this->session->flashdata('post_data')){
		$post_data = $this->session->flashdata('post_data');
		$txtCandidatePhone1 = $post_data['txtCandidatePhone1'];
		$txtdob1 = $post_data['txtdob1'];
		$txtFirstName = $post_data['txtFirstName'];
		$txtMiddleName = $post_data['txtMiddleName'];
		$txtLastName = $post_data['txtLastName'];
		$txtEmail = $post_data['txtEmail'];/*
		$cmbState = $post_data['cmbState'];*/
	}
	if($this->session->flashdata('post_data1')){
		$post_data = $this->session->flashdata('post_data');
		$txtCandidatePhone = $post_data['txtCandidatePhone'];
		$txtdob = $post_data['txtdob'];
	}
	
	$birth_start_date = '';
	$birth_end_date = '';
	foreach($eligibilityDate as $row){ 
		$birth_start_date = $row['birth_start_date'];
		$birth_end_date = $row['birth_end_date'];
	}
	//print_r($dateInfo);die();
	$program_start_date = '';
	$program_end_date = '';
	//print_r($dateInfo);return;
	
	foreach($dateInfo as $row){ 
		$program_start_date = $row['program_start_date'];
		$program_end_date = $row['program_end_date'];
	}
	//print_r($header);

?>
	<?php  if($this->session->userdata('reg_user_id')==''){ $href = base_url().'Index/institute_index/ins/'.$inscode; } else{ $href= '#'; }?>

<body>
	<div class="loadingRPimage">
	    <img height="100px" src="<?=base_url()?>upload/image/loader/loading_2.gif"/>
	</div>
  	<section style=" padding-bottom: 0;padding-bottom: 0; background:#fff;">  <!-- background:#0B3682; -->
  	<div class="col-sm-12 col-xs-12">
  		
		<div class="col-sm-12 col-xs-12">
		
  		<div class="row header" > 
            <div class="col-sm-5 col-xs-12" style="padding-top: 15px;">
              	<a href="<?=base_url()?>Index/institute_home/ins/<?=$inscode?>" >
                <img src="<?php echo base_url()?>public/assets/images/icon/Header for APSSB.png" class="logoimg"></a>
            </div>

            
            <div class="col-sm-7 col-xs-12 col-md-7 col-lg-7 col-xl-7 socialIcons" style="height: 100%">
			
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 back_ground" style="background: url(<?=base_url()?>public/assets/images/icon/top-bar.png);background-size: cover;">
              
            <?php if($this->session->userdata('reg_user_id')==''){ ?>
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-6" style="width:100%;height: 100%;">
            	<div class="hidden-xs hidden-sm hidden-md col-lg-8 col-xl-8" style="">
            		 <span class="helpline">Helpline -</span>
            		 <span class="num">9040365740|assistancearpssb[at]gmail[dot]com</span>
            	</div>
            	<div class="  col-xs-3 col-sm-3 col-md-3 hidden-lg hidden-lg">  </div>
            	<div class="  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
	            
					<a href = "<?=base_url()?>Index/institute_home/ins/<?=$inscode?>" class="login-font social_icon"> 
	                   
	                 	  <i class="fa fa-home"></i>
	                    
	                   </a>
	            </div>
	            
	        	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 " style="background:linear-gradient(to right, #c7764b 40%, #ce4e35 100%);width: auto;height: 100%;">
	            
					<center>
						<a href = "javascript:void(0);" id="login" class="login-font"> 
	                  		&nbsp;Login
	                    </a>
	                </center>
	            </div>
	        	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 " style="background:linear-gradient(to right, #c7764b 40%, #ce4e35 100%);width: auto;height: 100%;">
		            <center>   	
		               	<a  href= "javascript:void(0);" id="registration"class="login-font">
		               		Register
	                    </a>
	                </center>    
	            </div>
            </div>
            <div>&nbsp;</div>
            <?php if($header=='institute_home'){ ?>
            <div id="main-menu-container">
			    <nav class="navbar navbar-default navbar-static-top" >
			      <div class="container" role="main1" id="main1"  style="padding: 0;">
			        <div class="navbar-header">
			          <button type="button" class="navbar-toggle top-mar collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"  style="padding-right: 12px;">
			            <span class="sr-only">Toggle navigation</span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
				        </button>
				    </div>
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding: 0; margin: 0;">
				      <ul class="nav navbar-nav ul-top">
						    <li class="botton" onclick="window.location.href = '<?=base_url()?>Index/institute_index/ins/<?=$inscode?>';" style="cursor: pointer">
								Online Recruitment 
							</li>
							<li class="botton">
								Candidate Corner
							</li>
							<!--<li class=" botton">
								Tender
							</li>-->
							

				    	</ul>
					</div>
				  </div>
				</nav>
			</div>
			 <?php }  ?>
            <?php }
		else{  ?>
            	<div class="container">
			        <!-- Brand and toggle get grouped for better mobile display -->
			        <div class="navbar-header">
			          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-4">
			            <span class="sr-only">Toggle navigation</span>
			            <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>          
			          </button>
			        </div>
			    
			        <!-- Collect the nav links, forms, and other content for toggling -->
			        <div class="collapse navbar-collapse col-sm-12 col-xs-12 col-md-12" id="navbar-collapse-4" style="padding-left: 380px;">
			          
			            <ul class="nav navbar-nav navbar-right">
			           
					        <li class="dropdown user user-menu">
					       
						        <a href="#" class="dropdown-toggle " data-toggle="dropdown" style="">
							        <div style="background: linear-gradient(to right, #e5af85 40%, #ff8262 100%);width: auto;color: white;position: fixed;text-align: center;height: 40px;margin-top: -15px;padding-top: 10px;margin-left: -15px;">
							        <i class="fa fa-user" style="color: #FFF;font-size:20px;margin-left: 10px;"></i><label style="font-weight: unset;padding-right: 10px;"> &nbsp;&nbsp;<?php echo $this->session->userdata('full_name') ?> </label></div>
						        </a>
					        	<div class="dropdown-menu dropdown-menu-right animated flipInY " style="width: 250px; height: 270px; left: 9%;box-shadow: 1px 4px 7px black; border-radius: 6px;">
	                                <ul class="dropdown-user" style="text-align: center;padding-left: 0px;">
		                                <li class="user-header">
							            	<img src="<?php echo base_url(); ?>public/photos/avatar-sign.png" class="img-circle" alt="user-image">
							            	<p><?php echo $this->session->userdata('full_name') ?></p>
							          	</li>
							          
							          	<li class="user-footer">
						              		<div style="text-align: center; " >
						              			<a href="<?php echo base_url();?>Index/applicant_logout/ins/<?=$inscode?>" class="btn btn-default btn-flat" style="background-color: #47b0bc; border-radius: 8px; color: #fff;">LOGOUT</a>
						            		</div>
							          	</li>
	                                </ul>
	                            </div>
					        </li>
			            </ul>
			          
			        </div><!-- /.navbar-collapse -->
			    </div>
            <?php } ?>
            <!--  </div> -->  
            
            
             
            
            </div>
      	</div> 
      	</div>
      	
   		 </div> 
		
    </div> 	
	
		
		

 	</section>
 	<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" >
		<div class="modal-dialog" style="width:80%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close " style="font-size: 37px;position: unset"  data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h3 style="text-align: center;color: black;">Registration Form</h3>
				</div>
				<div class="modal-body">
					
				 	<input type="hidden" id="birthStartDate" value="<?php echo $birth_start_date; ?>"/>
				 	<input type="hidden" id="birthEndDate" value="<?php echo $birth_end_date; ?>"/>
				    
				 		<?php 
				 		/*echo $program_start_date;
				 		echo $program_end_date;
				 		echo $date1;*/
				 		//die();
				 		if(date('Y-m-d',strtotime($program_start_date)) <= date('Y-m-d',strtotime($date1)) && date('Y-m-d',strtotime($program_end_date)) >= date('Y-m-d',strtotime($date1))){ ?>
					    	
					   
						    <form class=" login-box-body" action="" method="post"  id="frmApplyNew" name="frmApplyNew" >
						    	<!--<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;"> 
									<div id="alertmessage"></div>
								</div>-->

						  <!-- <?php $attr=array('class'=> 'login-box-body');echo form_open('?p=registration',$attr); ?> --> 
				 				<input type="hidden" id="insCode" name="insCode" value="<?php echo $inscode; ?>"/>
				 				<input type="hidden" id="btnRegister1" name="btnRegister1" value="Registration"/>
						    	
						    	<div class="row col-sm-12 col-xs-12 ">
						    		<div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 fpad form-group">
								    	<div class="col-sm-4 col-xs-4">
									         <label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;  First Name</label>
									     </div>
									     <div class="col-sm-8 col-xs-8" >
									      <input class="form-control" style="max-width: 90%" type="text" name="txtFirstName" id="txtFirstName" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()" maxlength="50" required="" placeholder="First Name" value="<?=isset($txtFirstName)?$txtFirstName:''?>">
									      <i class="fa  fa-user icon"></i>
									    </div>
									</div>
									<div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 fpad form-group">
								    	<div class="col-sm-4 col-xs-4">
										 <label class="label1" >&nbsp;&nbsp;&nbsp;&nbsp;  Middle Name</label>
					                    </div>
					                    <div class="col-sm-8 col-xs-8" >
											<input class="form-control" type="text" style="max-width: 90%"  name="txtMiddleName" id="txtMiddleName" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()" maxlength="50"  placeholder="Middle Name" value="<?=isset($txtMiddleName)?$txtMiddleName:''?>">
											<i class="fa fa-user icon"></i>
										</div>
									</div>
								</div>
								<div class="row col-sm-12 col-xs-12">
						    		<div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 fpad form-group">
								    	<div class="col-sm-4 col-xs-4">   
										  <label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp; Last Name</label>
										 </div>
										 <div class="col-sm-8 col-xs-8">
										 	<input class="form-control" type="text" id="txtLastName" name="txtLastName" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()" maxlength="50" required="" placeholder="Last Name" value="<?=isset($txtLastName)?$txtLastName:''?>">
										    <i class="fa fa-user icon"></i> 
										         (If No last name , Enter First Name)
										</div>
									</div>
									<div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 fpad form-group">
								    	<div class="col-sm-4 col-xs-4">   
									      <label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;  Date of Birth </label>
									     </div>
									     <div class="col-sm-8 col-xs-8">   
									      <input class="form-control" type="text" name="txtdob1" id="txtdob1" autocomplete="off" placeholder="Date Of Birth" value="<?=isset($txtdob1)?$txtdob1:''?>" data-placement="left" data-toggle="tooltip" title="Your Date of Birth. ex: dd-mm-yyyy"  onfocus="this.blur()">
									     <i class="fa fa-calendar icon" ></i>
									      </div>
									</div>
									
								</div>
								<div class="row col-sm-12 col-xs-12 ">
						    		<div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 fpad form-group">
								    	<div class="col-sm-4 col-xs-4"> 
										 <label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;  Mobile No </label>
										 </div>
										 <div class="col-sm-8 col-xs-8"> 
											 	<input class="form-control" type="text" id="txtCandidatePhone1" name="txtCandidatePhone1" autocomplete="off" maxlength="10" required="" placeholder="Mobile No" value="<?=isset($txtCandidatePhone1)?$txtCandidatePhone1:''?>" data-placement="top" data-toggle="tooltip" onkeypress="return isNumberKey(event)" title="Your mobile no. ex: 9040123456">
												<i class="fa fa-phone  icon"></i>
										</div>
									</div>
									<div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 fpad form-group">
								    	<div class="col-sm-4 col-xs-4"> 
									 		<label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;&nbsp;  Email  </label>
									 	</div>
									 	<div class="col-sm-8 col-xs-8">     
									  		<input class="form-control" type="text" name="txtEmail" id="txtEmail"  placeholder="Email" autocomplete="off" maxlength="80" value="<?=isset($txtEmail)?$txtEmail:''?>"  data-placement="top" data-toggle="tooltip" title="Your Email-id. ex: xyz@abc.com">
									 		<i class="fa fa-envelope icon"></i>
									 	</div>
									</div>
								</div>
								<div class="row col-sm-12 col-xs-12">
									<div class="col-sm-12 col-xs-12 col-md-6 col-lg-6  fpad form-group">
										<div class="col-sm-4 col-xs-4"> 
									 		<label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Password </label>
									 	</div>
									 	<div class="col-sm-8 col-xs-8">     
									  		<input class="form-control" type="password" name="txtPassword1" id="txtPassword1" required="" placeholder="Password" autocomplete="off" maxlength="80" value=""  data-placement="top" data-toggle="tooltip" title="Your Password. ex: P@ssw0rd">
									 		<span id="show_hide" toggle="#password-field" class="fa fa-fw fa-eye field_icon icon toggle-password" data-placement="top" data-toggle="tooltip" style="cursor: pointer" title="Show Password"></span> 
									 	</div>
									</div>
									<div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 fpad form-group">
										<div class="col-sm-4 col-xs-4"> 
									 		<label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Confirm Password  </label>
									 	</div>
									 	<div class="col-sm-8 col-xs-8">     
									  		<input class="form-control" type="password" name="txtConfirmPassword" id="txtConfirmPassword" required="" placeholder="Confirm Password" autocomplete="off" maxlength="80" value=""  data-placement="top" data-toggle="tooltip" title="Your Password. ex: P@ssw0rd">
									 		<i class="fa fa-key icon"></i> 
									 	</div>
									</div>
								</div>
								<div class="row col-sm-12 col-xs-12">
						    		<!--<div class=" col-sm-6 col-xs-6 fpad form-group">
								    	<div class="col-sm-4 col-xs-4"> 
									 		<label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp; State  </label>
									 	</div>
									 	<div class="col-sm-8 col-xs-8">  
									 		<select name="cmbState" id="cmbState" class="form-control">
											</select>   
											
									  	</div>
									</div>-->
									<div class="col-sm-12 col-xs-12 col-md-6 col-lg-6 fpad form-group" style="margin-top: 20px">
								    	<div class="col-sm-4 col-xs-4">
									      <label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;  Captcha </label>
									     </div>
									    <div class="col-sm-8 col-xs-8 ">
										      <input class="form-control" type="text" name="txtCaptcha1" id="txtCaptcha1" required="" autocomplete="off" placeholder="Captcha" maxlength="6" onkeyup="this.value=this.value.toUpperCase()">
											<i class="fa fa-shield icon"></i>
										</div>
									</div>
									<div class="col-sm-12 col-xs-12 col-md-6 col-xl-6 col-lg-6" style="margin-top: 20px">
								     	<p id="captImg3">
									      	<a href="javascript:void(0);" class="refreshCaptcha3" id="refreshCaptcha3" >
									    	<img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
									    </p>
								    </div>
								</div>
								
								
				                <div class="row fpad">
								    <div class="col-sm-12 col-xs-12 col-md-12 col-xl-12 col-lg-12">
							    <br />
							    		 <p><a href="javascript:void(0);" id="registerAlreadyUser"  style="color: red;font-size: 15px;margin-left: 5%">Already Registered?</a></p>
							   	 		<center><button class="btoon_1" type="submit"  onclick="return validate();"   style="width: 166px;text-align: center;" id="btnRegister" name="btnRegister"><i class="fa fa-user-plus"></i> Register Now</button></center>
						    		</div>
						    	</div>
						    </form>
						      
					    
						<?php 
						 }
						 else
						 {
						?>
						<center><h3 style="color: red;">Registration Is closed For This Session.</h3></center>
						 	 <!--<div style="background: #f1f1f1; box-shadow: 10px 10px 2px 1px rgba(0, 0, 0, .2);">
						 	 	<img src="<?php echo base_url(); ?>downloads/sorry.png" width="475px;"/>
						 	 </div>-->
						<?php 
						 }
						 ?>


							
							
					</div>
				</div>
			</div>
	</div>
		
	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog"style="width:50%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close " style="font-size: 37px;position: unset"  data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h3 style="text-align: center;color: black;">Login Form</h3>
				</div>
				<div class="modal-body" >
					
				 	<input type="hidden" id="birthStartDate" value="<?php echo $birth_start_date; ?>"/>
 					<input type="hidden" id="birthEndDate" value="<?php echo $birth_end_date; ?>"/>
					
			        	<form  class=" login-box-body"  action="" method="post" id="frm_login" name="frm_login">
			        		<!--<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;">
								<div id="alertmessage1"></div>
							</div>-->
						   <input type="hidden" id="insCode" name="insCode" value="<?php echo $inscode; ?>"/>
						   <input type="hidden" id="insEncCode" name="insEncCode" value="<?php echo $ins; ?>"/>
						   <input type="hidden" id="hidProgramCode" name="hidProgramCode"/>
						    <div class="row fpad form-group" >
							    <div class="col-sm-4 col-xs-4">
							      <label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp; Mobile : </label>
							    </div>
						        <div class="col-sm-8 col-xs-8">
						           <input class="form-control" type="text" maxlength="10"  id="txtCandidatePhone" name="txtCandidatePhone" onkeypress="return isNumberKey(event)" value="<?=isset($txtCandidatePhone)?$txtCandidatePhone:''?>"  autocomplete="off" placeholder="Mobile Number" data-placement="top" data-toggle="tooltip" title="Mobile Number ex:9040123456" >
						      		<i class="fa fa-phone icon"></i>
						        </div>
							</div>
						   <div class="row fpad form-group" >
								<div class="col-sm-4 col-xs-4">
									<label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp; Date of Birth :</label>
							    </div>

									<div class="col-sm-8 col-xs-8">
										<input class="form-control" type="text" name="txtdob" id="txtdob" autocomplete="off" placeholder="Date of Birth(dd-mm-yyyy)" data-placement="left" data-toggle="tooltip" title="Date of Birth ex:01-01-2000" value="<?=isset($txtdob)?$txtdob:''?>"  readonly onfocus="this.blur()"/>
										 <i class="fa fa-calendar icon" ></i>
									</div>
								</div>-->
							
							<div class="row fpad form-group" >
							    <div class="col-sm-4 col-xs-4">
							      <label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Password : </label>
							    </div>
						        <div class="col-sm-8 col-xs-8">
						           <input class="form-control" type="password" maxlength="80"  id="txtPwd" name="txtPwd" value=""  autocomplete="off" placeholder="Password" data-placement="top" data-toggle="tooltip" title="Your Password. ex: P@ssw0rd" >
						      		<span id="show_hide_login" toggle="#password-field" class="fa fa-fw fa-eye field_icon icon toggle-password_login" data-placement="top" data-toggle="tooltip" style="cursor: pointer" title="Show Password"></span> 
									 	
						        </div>
							</div>
							
					    	<div class="row fpad form-group" >
								<div class="col-md-4 col-xs-4">
			                      <label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;  Captcha : </label>
								</div>
									<!--<div class="control-label col-sm-4" style="margin-left: 0px;"> -->

									<div class="col-md-8 col-xs-8">
									 <input class="form-control" type="text" maxlength="6" id="txtCaptcha" name="txtCaptcha"  onkeyup="this.value=this.value.toUpperCase()" autocomplete="off" placeholder="Captcha" >
									<i class="fa fa-shield icon"></i>	
									<!--</div>-->
								</div>
			                   </div>
							     
							    <div class="row" style="padding-top: 0px;"> 
							          
							         <p id="captImg4" align="right" >
											<a href="javascript:void(0);" class="refreshCaptcha4" id="refreshCaptcha4" ><img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
										</p>
							        <p><a href="javascript:void(0);" id="loginForgotPassword"  style="color: red;font-size: 15px;margin-left: 50px">Forgot Password?</a></p>
										
							        <p><a href="javascript:void(0);" id="loginNewUser"  style="color: red;font-size: 15px;margin-left: 50px">New User?</a></p>
							    </div>
						    <div class="row fpad">
							    <div class="col-sm-12 col-xs-6" align="center" >
						   	 		<button class="btoon_1" style="width: 166px;" type="submit" id="btnlogin" name="btnlogin"><i class="fa fa-user-plus"></i> Login</button>
					    		</div>
					    	</div>
						</form>

							
							
					</div>
				</div>
			</div>
	</div>

	<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog"style="width:50%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close"  style="padding-left: 95%;" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h3 style="text-align: center;color: black;">Forgot Password</h3>
					
				</div>
				<div class="modal-body" >
				
		        	<form  class=" login-box-body"  action="" method="post" id="frmForgotPassword" name="frmForgotPassword">
		        		<input type="hidden" id="insCode" name="insCode" value="<?php echo $inscode; ?>"/>
		        		
					    <div class="row fpad form-group" >
						    <div class="col-sm-4 col-xs-4">
						      <label class="label1">&nbsp;&nbsp; Mobile : </label>
						    </div>
					        <div class="col-sm-8 col-xs-8">
					           <input class="form-control" type="text" maxlength="10"  id="txtForgotCandidatePhone" name="txtForgotCandidatePhone" onkeypress="return isNumberKey(event)" value="<?=isset($txtCandidatePhone)?$txtCandidatePhone:''?>"  autocomplete="off" placeholder="Mobile Number" data-placement="top" data-toggle="tooltip" title="Mobile Number ex:9040123456" >
					      		<i class="fa fa-phone  icon"></i>
					        </div>
						</div>
					 	<h4 style="text-align: center; color: #040e59;">OR</h4>
						<div class="row fpad form-group" >
						    <div class="col-sm-4 col-xs-4">
						      <label class="label1">&nbsp;&nbsp;Email Id : </label>
						    </div>
					        <div class="col-sm-8 col-xs-8">     
						  		<input class="form-control" type="text" name="txtForgotEmail" id="txtForgotEmail"  placeholder="Email" autocomplete="off" maxlength="80" value="<?=isset($txtEmail)?$txtEmail:''?>"  data-placement="top" data-toggle="tooltip" title="Your Email-id. ex: xyz@gmail.com">
						 		<i class="fa fa-envelope icon"></i>
						 	</div>
						</div>
						
				    	<div class="row fpad form-group" >
							<div class="col-md-4 col-xs-4">
		                      <label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;  Captcha : </label>
							</div>

							<div class="col-md-8 col-xs-8">
								 <input class="form-control" type="text" maxlength="6" id="txtCaptcha5" name="txtCaptcha5"  onkeyup="this.value=this.value.toUpperCase()" autocomplete="off" placeholder="Captcha" >
								<i class="fa fa-shield icon"></i>	
							</div>
	                   </div>
						     
					    <div class="row" style="padding-top: 0px;"> 
					          
					         <p id="captImg5" align="right" >
									<a href="javascript:void(0);" class="refreshCaptcha5" id="refreshCaptcha5" ><img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
								</p>
					    </div>
					    <div class="row fpad">
						    <div class="col-sm-12 col-xs-6" align="center" >
					   	 		<button class="btoon_1" style="width: 166px;" type="submit" id="btnForgotPassword" onclick="return validate_forgot_password();"  name="btnForgotPassword"><i class="fa fa-cogs"></i> Get OTP</button>
				    		</div>
				    	</div>
				    	
				    	<div class="row fpad form-group" id="newPassword" style="padding-top: 20px;">
							<div class="col-sm-offset-1 col-sm-12 col-xs-12">
								<div class="col-sm-3 col-xs-3"> 
							 		<label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;OTP: </label>
							 	</div>
							 	<div class="col-sm-5 col-xs-5">     
							  		<input class="form-control" type="text" name="txtOTP" id="txtOTP" required="" placeholder="OTP" autocomplete="off" maxlength="80" value=""  data-placement="top" data-toggle="tooltip">
							 		<i class="fa fa-key icon"></i> 
							 	</div>
							 	<div class="col-sm-2 col-xs-2">
							 		<a href="javascript:void(0);" class="resendOTP"  data-placement="top" data-toggle="tooltip" title="Resend OTP" id="resendOTP" ><img style="height: 30px;" src="<?php echo base_url().'public/assets/images/resend.png'; ?>"/></a>
							 	</div>
							</div>
							<div class="row" style="margin-top: 14%">
							    <div class="col-sm-12 col-xs-6" align="center" >
						   	 		<button class="btoon_1" style="width: 166px;" type="button" id="btnChangePassword" name="btnChangePassword"><i class="fa fa-user-plus"></i> Submit</button>
					    		</div>
					    	</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="newPasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog"style="width:50%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close"  style="padding-left: 95%;" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h3 style="text-align: center;color: black;">New Password</h3>
				</div>
				<div class="modal-body" >
		        	<form  class=" login-box-body"  action="" method="post" id="frmNewPassword" name="frmNewPassword">
		        		<input type="hidden" id="hidRegUserId" name = "hidRegUserId"/>
		        		<input type="hidden" id="hidMailId"  name = "hidMailId"/>
					    <div class="row fpad form-group">
							<div class="col-sm-12 col-xs-12">
								<div class="col-sm-4 col-xs-4"> 
							 		<label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Password </label>
							 	</div>
							 	<div class="col-sm-8 col-xs-8">     
							  		<input class="form-control" type="password" name="txtPassword2" id="txtPassword2" required="" placeholder="Password" autocomplete="off" maxlength="80" value=""  data-placement="top" data-toggle="tooltip" title="Your Password. ex: P@ssw0rd">
							 		<i class="fa fa-key icon"></i> 
							 	</div>
							</div>
						</div>
						<div class="row fpad form-group">
							<div class="col-sm-12 col-xs-12">
								<div class="col-sm-4 col-xs-4"> 
							 		<label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Confirm Password  </label>
							 	</div>
							 	<div class="col-sm-8 col-xs-8">     
							  		<input class="form-control" type="password" name="txtConfirmPassword2" id="txtConfirmPassword2" required="" placeholder="Confirm Password" autocomplete="off" maxlength="80" value=""  data-placement="top" data-toggle="tooltip" title="Your Password. ex: P@ssw0rd">
							 		<i class="fa fa-key icon"></i> 
							 	</div>
							</div>
						</div>
						
				    	<div class="row fpad form-group">
				    		<div class="col-sm-12 col-xs-12">
								<div class="col-md-4 col-xs-4">
			                      <label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Captcha : </label>
								</div>

								<div class="col-md-8 col-xs-8">
									 <input class="form-control" type="text" maxlength="6" id="txtCaptcha6" name="txtCaptcha6"  onkeyup="this.value=this.value.toUpperCase()" autocomplete="off" placeholder="Captcha" >
									<i class="fa fa-shield icon"></i>	
								</div>
							</div>
	                   </div>
						     
					    <div class="row" style="padding-top: 0px;"> 
					          
					         <p id="captImg6" align="right" >
									<a href="javascript:void(0);" class="refreshCaptcha6" id="refreshCaptcha6" ><img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
								</p>
					    </div>
					    <div class="row fpad">
						    <div class="col-sm-12 col-xs-6" align="center" >
					   	 		<button class="btoon_1" style="width: 166px;" type="submit" id="btnChangePwd" name="btnChangePwd" ><i class="fa fa-cogs"></i> Submit</button>
				    		</div>
				    	</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
<a class="brand js-target-scroll"></a>

	<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/bootstrap-datepicker.js" ></script>