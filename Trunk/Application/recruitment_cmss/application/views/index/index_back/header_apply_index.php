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

    <title>Online Admission form</title>

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
		
	</style>
	<script type="text/javascript">
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
	
	
	<!-- End Facebook Pixel Code -->
	
	
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
	}

?>
	<?php  if($this->session->userdata('reg_user_id')==''){ $href = base_url().'Index/institute_index/ins/'.$inscode; } else{ $href= '#'; }?>
	

    <!--<section >
<div class="row" style="background: #131A44; padding:10px; margin: 0;">
</div>
</section>-->

   <!-- <section >
<div class="row" style="background: #FF8400;margin: 0;">
  <div class="col-sm-2 col-xs-6" style="padding: 0;">
    <p style="color:#f1f1f1; font-size:16px;margin-top:9px;text-align: center;"><i class="fa fa-bullhorn"></i> &nbsp;&nbsp;Announcement &nbsp;&nbsp; | </p>
</div>

<div class="col-sm-10 col-xs-6" style="padding: 0">
<marquee direction="left" behavior="scroll" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();">  
<p style="color:#f1f1f1; margin-top:9px; font-size:14px;">Admission into MPO Course, Subject to receipt of extension of approval from Rehabilitation Council of India(RCI), New Delhi.</p>
</marquee>
</div>


  </div>
</section>-->
