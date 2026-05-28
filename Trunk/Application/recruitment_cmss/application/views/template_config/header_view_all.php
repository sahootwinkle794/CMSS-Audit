<?php 
	//$inscode1 = $this->session->set_userdata('ins_code', $institute);
	$logo = '';
	$inscode = '';
	$ins = '';
	$insname = '';
	$bg_image_url = '';
	foreach($institute as $row){ 
		$inscode = $row['institute_code'];
		$ins =  encrypt_decrypt('encrypt', $inscode);
		$insname = $row['institute_name'];
		$logo = $row['logo_url'];	
		//$bg_image_url = $row['bg_image_url'];	
	}
	
	$bg_image_url = 'background.svg';
	

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
		.header_section {
		  width: 100%;
		  z-index: 1 !important;
		}

		.fixed {
		  position: fixed;
		  top:0;
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
		.reg{
			position: absolute;
			/*width: 80px;*/
			height: 77px;
			left: 0px;
			top: 9px;
			background: #022830;
			border: 1.5px solid #064E5E;
			box-sizing: border-box;
			border-radius: 10px;
		}
		.regi{
			position: absolute;
		    width: 55px;
		    height: 17px;
		    left: 20px;
		    top: 60px;
		    font-family: Exo 2;
		    font-style: normal;
		    /*font-weight: 550;*/
		    font-size: 14px;
		    line-height: 17px;
			color: #FFFFFF;

		}
		.log{
			position: absolute;
			width: 90px;
			height: 77px;
			left: 0px;
			top: 9px;
			background: #022830;
			border: 1.5px solid #064E5E;
			box-sizing: border-box;
			border-radius: 10px;
			
		}
		.log1{
			position: absolute;
			width: 55px;
			height: 17px;
			left: 17px;
			top: 59px;
			font-family: Exo 2;
			font-style: normal;
			/*font-weight: 550;*/
			font-size: 14px;
			line-height: 17px;
			color: #FFFFFF;
		}
		.headerpart{
			position: absolute;
			width: 388px;
			height: 22px;
			left: 228px;
			top: 28px;
			font-family: Exo 2;
			font-style: normal;
			font-weight: bold;
			font-size: 22px;
			line-height: 26px;
			letter-spacing: 0.055em;
			color: #FFFFFF
		}
		.headerpart1{
			position: absolute;
			/*width: 390px;*/
			height: 30px;
			left: 228px;
			top: 60px;
			font-family: Exo 2;
			font-style: normal;
			font-weight: 600;
			font-size: 13px;
			line-height: 18px;
			color: #FFFFFF;
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
		
	</style>
	<script type="text/javascript">
		$(window).scroll(function(){
			var sticky = $('.header_section'),
			scroll = $(window).scrollTop();

			if (scroll >= 10) 
				sticky.addClass('fixed');
			else 
				sticky.removeClass('fixed');
		});
		/* CODE FOR TOASTR */
		toastr.options = {
		  	"closeButton": true,
		  	"debug": false,
		  	"progressBar": false,
		  	"positionClass": "toast-bottom-right",//top-right,bottom-left,top-left,top-full-width,bottom-full-width,top-center,bottom-center
		 	"onclick": null,
		  	"showDuration": "300",
		  	"hideDuration": "1000",
		  	"timeOut": "2000",
		  	"extendedTimeOut": "1000",
		  	"showEasing": "swing",
		  	"hideEasing": "linear",
		  	"showMethod": "fadeIn",
		  	"hideMethod": "fadeOut"
		}
		base_url = "<?php echo base_url()?>"; 
	</script>
	
	
	<style>
		.main_section
		{
			/*background: url(<?=base_url()?>upload/image/<?=$bg_image_url?>);*/
			/*background-color:ghostwhite;*/
			background-size: cover;
			
		}
		.header_section{
			background: url(<?=base_url()?>upload/image/<?=$bg_image_url?>);
			/*height:104px;*/
		}


		.logo_img{
			position: absolute;
		    width: 87px;
		    left: 134px;
		    top: 21px;
		}
		.register_button {
		    /*background: #36a3c5;*/
		    height: 100px;
		    width: 20%;
		    left: 80px;
		    top: 10px;
		}
		.home_button {
		    background: #0f89d1;
		    height: 100px;
		    width: 30%;
		}
		.login_button{
			/*background: #2f87a2;*/
		    height: 69px;
		    width: 20%;
		    margin-left: 95px;
		    top: 10px;
		}
		.logout_button{
			background:#2f87a2;
			height: 100px;
			width: 30%;
		}
		.font_reg_log{
			font-size: 15px;
			font-weight: 800;
			letter-spacing: 1px;
			color: whitesmoke;
			margin-top: 30%;
			position: absolute;
		}
		.navbar-default {
		    background-color: unset !important;
		    border-color:#e7e7e700 !important;
		}
		.icon-color
		{
			color: white;
		}
		.left{
			display: none !important;
		}
		@media (max-width: 768px){
			.logo_img {
			    position: absolute;
			    width: 72px;
			    left: 83px;
			    top: 35px;
			}
			
			.headerpart {
				height: 22px;
				left: 163px;
				font-size: 15px;
			}
			.headerpart1 {
				width: 45rem;
				left: 163px;
				font-size: 15px;
			}
			.register_button {
			    height: 23px;
			    width: 82px;
			    left: 211%;
			}
			.login_button {
			    height: 23px;
			    width: 82px;
			    left: 182%;
			}
			.logout_button {
			    background: #dc640d;
			    height: 41px;
			    width: unset;
			    left: -103%;
			    margin-top: 1%;
			}
			.home_button {
			     background: #dc640d;
			    height: 41px;
			    width: auto;
			    left: -103%;
			    margin-top: 40%;
			}
			.navbar-collapse {
				border-color:#e7e7e700 !important;
			}
			
		}
		@media (max-width: 360px){
			.logo_img {
			    position: absolute;
			    width: 55px;
			    left: 82px;
			    top: 34px;
			}
			.headerpart {
			    width: auto;
			    left: 139px;
			    font-size: 8px;
			}
		}

	</style>
	
  </head>
<body>
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
		$logo = $row['logo_url'];	
		$image_url = $row['image_url'];	
	}

?>
	<?php  if($this->session->userdata('reg_user_id')==''){ $href = base_url().'/index/institute_index/ins/'.$inscode; } else{ $href= '#'; }?>
	
  	
  	<section class="main_section">
  	<section class="header_section">
  		<div class="row"> 
        <div class="col-md-8">
          <a href="<?php echo $href ?>">
            <img src="<?php echo base_url()?>public/assets/images/<?php echo $image_url ?>" class="logo_img">
          </a>
          <span>
            <a href="<?php echo $href ?>">
              <p class="headerpart">Central Medical Services Society</p>
              <p class="headerpart1">An Autonomous Body under Ministry of Health & Family Welfare,<br/> Government of India</p>
          	</a>
          </span>
        </div>
        <div class="col-md-4" >
        	<div id="main-menu-container">
				    <nav class="navbar navbar-default navbar-static-top">
			        <div class="container" role="main1" id="main1"  style="padding: 0;">					        
					      <ul class="nav navbar-nav ul-top">
					      	 	<?php if($this->session->userdata('reg_user_id')==''){ ?>

							    <li class="register_button" onclick="window.location.href = '<?=base_url()?>Index/institute_register/ins/<?=$ins?>';" style="cursor: pointer">
							    	<center style="padding-top: 10%;"><img class="hidden-xs img-responsive reg" style="width: 150%;" src="<?php echo base_url(); ?>upload/image/registration.svg">
							    		<span class="regi" style="color: white"> Register  </span>
							    	</center>
									</li>
									<li class="login_button" onclick="window.location.href = '<?=base_url()?>Index/institute_login/ins/<?=$ins?>';" style="cursor: pointer">
								    	<center style="padding-top: 10%;margin-left: 2px;margin-left: 37rem;"><img class="hidden-xs img-responsive log"  src="<?php echo base_url(); ?>upload/image/login.svg">
								    		<p class="log1" style="color: white"> Login </p>
								    	</center>
									</li>
									<?php }  else { 
									$url = base_url(uri_string());
									$institute_index = 'institute_index';
									if(strpos($url, $institute_index)){
									?>
										<li class="home_button" onclick="window.location.href = '#';" style="cursor: pointer">
									    	<center style="padding-top: 10%;"><i class="fa fa-home fa-3x icon-color hidden-xs" aria-hidden="true"></i>
									    		<p style="color: white">HOME</p>
									    	</center>
										</li>
										<li class="logout_button" onclick="window.location.href = '<?=base_url()?>Index/applicant_logout/ins/<?=$inscode?>';" style="cursor: pointer">
									    	<center style="padding-top: 10%;"><img class="hidden-xs img-responsive" style="width: 40%;margin-bottom: 2%;" src="<?php echo base_url(); ?>upload/image/Logout_icon.png">
									    		<p style="color: white">LOGOUT</p>
									    	</center>
										</li>
									<?php	
									}	else
									{ ?>
										<li class="home_button" onclick="window.location.href = '<?=base_url()?>apply/institute_page/ins/<?=$ins?>';" style="cursor: pointer">
									    	<center style="padding-top: 10%;"><i class="fa fa-home fa-3x icon-color hidden-xs" aria-hidden="true"></i>
									    		<p style="color: white">HOME</p>
									    	</center>
										</li>
										<li class="logout_button" onclick="window.location.href = '<?=base_url()?>Index/applicant_logout/ins/<?=$inscode?>';" style="cursor: pointer">
									    	<center style="padding-top: 10%;"><img class="hidden-xs img-responsive" style="width: 40%;margin-bottom: 2%;" src="<?php echo base_url(); ?>upload/image/Logout_icon.png">
									    		<p style="color: white">LOGOUT</p>
									    	</center>
										</li>
									<?php		
									}?>
									
									<?php } ?>
					    	</ul>
					  	</div>
						</nav>
					</div>
    		</div>
      </div>
 		</section>
 	

   
