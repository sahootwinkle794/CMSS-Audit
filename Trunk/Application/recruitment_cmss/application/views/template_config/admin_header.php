<?php
$user_name = $this->session->userdata('user_name');
$user_display_name = $this->session->userdata('user_display_name');
$index_page_url = $this->session->userdata('index_page_url');
$profile_page_url = $this->session->userdata('profile_page_url');
$institute_name = $this->session->userdata('institute_name');
$role_name = $this->session->userdata('role_name');
$user_name = $this->session->userdata('user_name');
$key = $this->session->userdata('key');
/*echo $this->session->userdata('key');die();*/
//print_r($_SESSION);
?>

<!DOCTYPE html>
<html style="height: auto;">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Setup</title>
		<!-- Core CSS - Include with every page -->
		<link href="<?php echo base_url(); ?>public/assets/css/bootstrap_new.min.css" rel="stylesheet">
		<!--<link rel="stylesheet" type="text/css" href="../css/plugins/dataTables/css/jquery.dataTables.min.css" />-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/datatable/css/dataTables.responsive.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/font-awesome/css/font-awesome.min.css">
		
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/css/AdminLTE.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/Ionicons/css/ionicons.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
		   folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/css/skins/_all-skins.css">
	  	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/custom_css.css">
	  	<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/animate.css">
		<link href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/css/bootstrapValidator.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/css/bootstrap-select.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/css/bootstrap-multiselect.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/datepicker3.css">
		<!--<link href="<?php echo base_url(); ?>public/template_lib/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">-->
		<link href="<?php echo base_url(); ?>public/template_lib/plugins/timeline/timeline.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/tooltip/tooltipster.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/tooltip/tooltipster-punk.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.css" />
			<!-- Selctaize picker plugin --><!--
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/assets/selectize/selectize/css/selectize.bootstrap3.css" />-->
		
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/datatable/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/datatable/css/responsive.dataTables.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/datatable/css/rowReorder.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/iCheck/all.css" />
		<!-- Sweet Alert Plugin -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/sweetalert/sweetalert.css"></link>
	<!--	<link href="<?php echo base_url(); ?>public/assets/css/extracss.css" rel="stylesheet">-->
		<link rel="shortcut icon" href="../images/logo1.png" type="image/x-icon" />
		
	
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/fusion-chart/fusioncharts.charts.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/fusion-chart/fusioncharts.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/fusion-chart/fusioncharts.maps.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/fusion-chart/fusioncharts.india.js"></script>
		<!--<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/fusion-chart/fusioncharts.odisha.js"></script>-->
		<!--SCRIPT LIBRARY-->
		
		<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-ui.min.js"></script>
		<script src="<?php echo base_url(); ?>public/assets/js/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.responsive.min.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.rowReorder.min.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/moment.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/bootstrap-datepicker.js" ></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/iCheck/icheck.min.js"></script><!--
		<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/ckeditor_4.2.2/ckeditor.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/selectize/js/standalone/selectize.min.js"></script>-->
		<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrapValidator.js"></script>
		
   
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-select.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/fastclick/lib/fastclick.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/moment/min/moment.min.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/js/adminlte.js"></script>

		<!-- Tooltips Plugin -->
		<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/tooltip/jquery.tooltipster.min.js"></script>
		<!-- Toaster Plugin -->
		<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.js"></script>
		<!-- CKEditor Plugin -->
		<script src="<?php echo base_url(); ?>public/template_lib/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
		
		<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/html5lightbox/html5lightbox.js"></script>
		<!-- Sweet Alert Plugin -->
		<script src="<?php echo base_url(); ?>public/template_lib/plugins/sweetalert/sweetalert.min.js"></script>
		<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-multiselect.js" type="text/javascript"></script>
		<!--
		<script src="<?php echo base_url(); ?>public/assets/selectize/selectize/js/standalone/selectize.min.js"></script>-->
		<!--<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 
		-->  
		<link href="<?php echo base_url(); ?>public/assets/css/roboto.css" rel="stylesheet">
   
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/assets/fonts/Oswald.ttf"> 
		<script type="text/javascript">
		/* CODE FOR TOOLTIP */
		$('.tooltips').tooltipster({
			theme: 'tooltipster-punk',
			animation: 'grow',
	        delay: 200,  
	        touchDevices: false,
	        trigger: 'hover'
	    });	
		/* END OF TOOLTIP */
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
		</script>
		
		<style>
		
			html,body
			{
				/*font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;*/
				font-family: 'Roboto', sans-serif !important;
				font-weight: normal !important;
			}
			.btn{
				font-family: 'Roboto', sans-serif !important;
				font-weight: normal !important;
			}
			/*.fa{
				font-family: 'Font Awesome\ 5 Free', 'Roboto', sans-serif !important;
			}*/
			
			ul.sidebar-menu li a
			{
				font-size: 13px;
				text-transform: capitalize !important;
				font-weight: 400;
				/*letter-spacing: 0.5px;*/
			}
			.skin-purple-light .sidebar-menu > li > a{
				font-weight: 600;
			}
			.dropdown-menu>.active>a, .dropdown-menu>.active>a:hover, .dropdown-menu>.active>a:focus {
			    color: black !important;
			    text-decoration: none;
			    outline: 0;
			    background-color: #ebebeb !important;
			}
			.modalExbottom {
			    color: #397395 !important;
			}
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
			.alignCenter
			{
				text-align: center;
			}
			.alignLeft
			{
				text-align: left;
			}
			.alignRight
			{
				text-align: right;
			}
       		.legend-bordered{
	        	font-family: "Source Sans Pro",sans-serif;
	        	font-size: 14px;
				line-height: 1.42857;
				color: #333;
				font-weight: bold;
			    text-align: left !important;
			    border: 1px groove #737373 !important;
			    padding:0 10px; /* To give a bit of padding on the left and right */
			    width:30%; /* Or auto */
			    margin-bottom: 10px !important;
			}
			.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
			    border: 1px solid #eee;
			}
			.table-bordered {
			    border: 1px solid #eeecec;
			}
			/*.modal-header {
				border-bottom-color: #D1D4D5;
				color: black;
				background: linear-gradient(to right,#d3eafd,#e3f7ce);
			}*/
			.modal-footer {
				border-bottom-color: #E5E5E5 !important;
			}
			.modal-header .close {
			    margin-top: 2px;
			}
			.modal-dialog {
			    margin: 7% auto;
			}
			.form-horizontal {
			    padding: 0px 35px 3px 35px;
			}
			.form-horizontal .control-label{
				text-align: left;
			}
			.treeview-menu {
			    padding: 0px 0px 0px 15px;
		    }
		    .treeview-menu > li > a {
			    font-size: 12px;
			}
			.content {
    			min-height: 550px;
    		}
    		table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
			    vertical-align: middle;
			}
			label{
				color: #000252;
				font-size: 14px;
				top: 3px;
				font-weight: 400;
			}
			.input[type="text"] {
			    border-radius: 0px;
			    -webkit-border-radius: 0px;
			    -moz-border-radius: 0px;
			    -ms-border-radius: 0px;
			    border: 0px;
			    background-image: linear-gradient(#673AB7, #673AB7), linear-gradient(#000, #000);
			    background-size: 0 2px, 100% 1px;
			    background-repeat: no-repeat;
			    background-position: center bottom, center calc(100% - 1px);
			    background-color: transparent;
			    transition: background 0.2s ease-out;
			    float: none;
			    font-weight: 400;
			    outline: 0px !important;
			    box-shadow: none;
			}
				input[type="email"], input[type="password"], input[type="text"] {
	            border-radius: 0px;
	            -webkit-border-radius: 0px;
	            -moz-border-radius: 0px;
	            -ms-border-radius: 0px;
	            border: 0px;
	            background-image: linear-gradient(#673AB7, #673AB7), linear-gradient(#737373, #737373);
	            background-size: 0 2px, 100% 1px;
	            background-repeat: no-repeat;
	            background-position: center bottom, center calc(100% - 1px);
	            background-color: transparent;
	            transition: background 0.2s ease-out;
	            float: none;
	            font-weight: 400; 
	            outline:0px !important;
	            box-shadow: none; 
	        }
			
	        input[type='text']:focus, input[type="password"]:focus, input[type="email"]:focus {
	            background-size: 100% 2px, 100% 1px; 
	            outline:0px !important;
	            box-shadow: none; 
	        }

	        input[type='text']:focus ~ .floating-label, 
	        input[type="password"]:focus ~ .floating-label, 
	        input[type="email"]:focus ~ .floating-label {
	            transform: translateY(-47px);
	            color: #673AB7; 
	        }
			.modal-content{
				background: url(<?=base_url()?>public/photos/rink_background.jpg) ;
				/*background-size: cover;*/
			}
			.modal-dialog{
				width:75%;
				max-width: 1000px;
			}
	        .floating-label {
	            transform: translateY(-27px);
	            transition: transform 0.2s ease-out; 
	        }

	        .static-label {
	            transform: translateY(-47px);
	            transition: transform 0.2s ease-out; 
	        }
	        .form-control::placeholder {

			    color: #737373;
			    opacity: 1;

			}
			/*.table-bordered tbody tr:hover, .table-bordered tbody tr.active {
    			border-left: 4px solid #009efb; 
    		}*/
			/*.content-wrapper {
				width: 97%;
			}*/
			.modal-title{
				margin:0;
				line-height:1.42857143;
				text-align: center;
			}
			.modal-body {
			    position: relative;
			    padding: 0px;
			}
			h4, .h4 {
			    font-size: 20px;
			    color: black;
			}
		</style>
		<script type="text/javascript">
			var base_url = '<?= base_url()?>';
		</script>



	</head>
	<header class="main-header">
		<a href="#" class="logo">
		  	<!-- mini logo for sidebar mini 50x50 pixels -->
		  	 <span class="logo-mini"><img width="50" height="50" src="<?php echo base_url(); ?>upload/image/CMSS.png" class="img-circle"></span>
		  	<!-- logo for regular state and mobile devices -->
		  	<span class="logo-lg" ><img width="100" height="100" src="<?php echo base_url(); ?>upload/image/CMSS.png" class="img-circle">
		  		
		  	</span>
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top">
		  	<!-- Sidebar toggle button-->
		  	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
		    	<span class="sr-only">Toggle navigation</span>
		    	<span class="icon-bar"></span>
		    	<span class="icon-bar"></span>
		    	<span class="icon-bar"></span>
		  	</a>
		  	
		  	<div class="navbar-custom-menu">
		    	<ul class="nav navbar-nav">
		    		<!-- Messages: style can be found in dropdown.less-->
		          	<li class="dropdown messages-menu">
		            	
		            	<ul class="dropdown-menu">
		              		<li class="header">You have 1 messages</li>
		              		<li>
				                <!-- inner menu: contains the actual data -->
				                <ul class="menu">
		                  			<li><!-- start message -->
					                    <a href="<?php echo site_url('admin/communication_process/1'); ?>">
					                    	<div class="pull-left">
					                        	<img src="<?php echo base_url(); ?>public/photos/logo/odgovt.png" class="img-circle" alt="User Image">
					                      	</div>
					                      	<h4>
					                        	Sushree Suman Dash 
					                        	<small><i class="fa fa-clock-o"></i> 5 mins</small>
					                      	</h4>
					                      	<p>Student status.</p>
					                    </a>
		                  			</li>
		                  			<!-- end message -->
		                  			<!--<li>
		                    			<a href="#">
					                      <div class="pull-left">
					                        <img src="<?php echo base_url(); ?>public/photos/logo/odgovt.png" class="img-circle" alt="User Image">
					                      </div>
		                      				<h4>
						                        Lina Mohapatra
						                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
						                    </h4>
				                      		<p>My training period is going on well.</p>
				                    	</a>
		                  			</li>-->
					            </ul>
		              		</li>
		              		<li class="footer"><a href="<?php echo site_url('admin/communication_process'); ?>">See All Messages</a></li>
		            	</ul>
		          	</li>
		          	<!-- Notifications: style can be found in dropdown.less -->
			        <li class="dropdown notifications-menu">
			            
			            <ul class="dropdown-menu">
			              <li class="header">You have 1 notifications</li>
			              <li>
			                <!-- inner menu: contains the actual data -->
			                <ul class="menu">
			                  <li>
			                    <a href="<?php echo site_url('admin/approval_process'); ?>">
			                      <i class="fa fa-users text-aqua"></i> 1 new Applicants Registered today
			                    </a>
			                  </li>
			                 <!-- <li>
			                    <a href="#">
			                      <i class="fa fa-users text-yellow"></i> 30 Applicants Approved today.
			                    </a>
			                  </li>
			                  <li>
			                    <a href="#">
			                      <i class="fa fa-users text-red"></i> 10 Applicants got Admitted.
			                    </a>
			                  </li>-->
							</ul>
			              </li>
			              <li class="footer"><a href="<?php echo site_url('admin/approval_process'); ?>">View all</a></li>
			            </ul>
			        </li>
			        <!-- Tasks: style can be found in dropdown.less -->
			          <li class="dropdown tasks-menu">
			           
			            <ul class="dropdown-menu">
			            
			                <ul class="menu">
			                  
			                </ul>
			              
			            </ul>
			          </li>
			      	<!-- User Account: style can be found in dropdown.less -->
			      	<li class="dropdown user user-menu">
				        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				          	<img src="<?php echo base_url(); ?>public/photos/avatar-sign.png" class="user-image" alt="user-image">
				          	<span class="hidden-xs"><?php echo $this->session->userdata('user_display_name') ?></span>
				        </a>
				        <ul class="dropdown-menu animated flipInY">
				          	<!-- User image -->
				          	<li class="user-header">
				            	<img src="<?php echo base_url(); ?>public/photos/avatar-sign.png" class="img-circle" alt="user-image">
				            	<p><?php echo $this->session->userdata('user_display_name') ?></p>
				          	</li>
				          	<!-- Menu Footer-->
				          	<li class="user-footer">
				            	<div class="pull-left">
				              		<!--<a href="<?php echo site_url('user/change_password'); ?>" class="btn btn-default btn-flat">Change Password</a>-->
				              		<!--<a href="#"  data-toggle="modal" data-target="#password_modal" class="btn btn-default btn-flat">Change Password</a>-->
				              		<button type="button" class="btn btn-default btn-flat" id="openModal">
									  Change Password
									</button>

				            	</div>
				            	<div class="pull-right">
				              		<a href="<?php echo site_url('user/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
				            	</div>
				          	</li>
				          	
			        	</ul>
		      		</li>
		      		<li>
			            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
			        </li>
		      		 <!-- Control Sidebar Toggle Button -->
		          	<!--<li>
		            	<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
		          	</li>-->
		    	</ul>
		  	</div>
		</nav>
	</header>
	<body  class="hold-transition skin-green sidebar-mini">
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-md" role="document" style="width: 50%;">
		    <div class="modal-content">
		      <div class="modal-header">
		      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				&times;</button>
				<h4 class="modal-title" id="myModalLabelHeader1"> Change Password</h4>
		        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>-->
		      </div>
			<form class="form-horizontal" id="frmApply" name="frmApply">
		      	<div class="modal-body">
					<input type="hidden" name="shapasswordOld" id="shapasswordOld"/>
					<!--<input type="hidden" name="passwordNew" id="passwordNew"/>-->
					<input type="hidden" name="shapasswordNew" id="shapasswordNew"/>
					<input type="hidden" name="shapasswordNewOne" id="shapasswordNewOne"/>
					<input type="hidden" name="shapasswordConfirm" id="shapasswordConfirm"/>
					
					<input type="hidden" name="user_name" id="user_name" value="<?php echo $user_name ?>"/>
					<div class="form-group">
						<label for="inputname" class="col-lg-5 control-label"><i style="color:red;font-size:15px;">*</i> Current Password</label>
						<div class="col-lg-7">
							<input type="password" class="form-control" id="txtoldPassword" name="txtoldPassword" placeholder="Current Password">
						</div>
						<br/><br/>
					</div>
					
					<div class="form-group">
						<label for="" class="col-lg-5 control-label"><i style="color:red;font-size:15px;">*</i> New Password</label>
						<div class="col-lg-7">
							<input type="password" id="txtNewPassword" class="form-control tooltips" name="txtNewPassword" placeholder="New Password" title="Enter New Password"></input>
						</div>
						<br/><br/>
					</div>
					
					
					<div class="form-group">
						<label for="" class="col-lg-5 control-label"><i style="color:red;font-size:15px;">*</i> Confirm Password</label>
						<div class="col-lg-7">
							<input type="password" id="txtConfirmPassword" class="form-control tooltips" name="txtConfirmPassword" placeholder="Confirm Password" title="Enter Confirm Password"></input>
						</div>
						<br/><br/>
					</div>
					<div style="color: red;">
						
					</div>
				
			    </div>
			    <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger" id="btnChangePassword" name= "btnChangePassword" >Change Password</button>
			    </div>
			</form>
		    </div>
		  </div>
		</div>
		<div id="wrapper" style=""> 
		
<script src="<?php echo base_url(); ?>public/assets/js/md5_5034.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/profile_sha.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/sha512.js"></script>
<script type="text/javascript">
	
	$('#frmApply').bootstrapValidator({
		message: 'This value is not valid',
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			var md5KeyValue = "<?php echo $this->session->userdata('key');?>";
			console.log('md5KeyValue',md5KeyValue);
			if($("#txtoldPassword").val() == '')
			{
				toastr.error("Please enter Old Password");
				return false;
			}
			else if($("#txtNewPassword").val() == '' || $("#txtConfirmPassword").val() == '')
			{
				toastr.error("Please enter Password and Confirm Password");
				return false;
			}
			//added for CR 5034 - begin.
			//var username ="abcd@abcd";
			var username = document.frmApply.user_name.value;	
			
			var oldpassword = document.frmApply.txtoldPassword.value;
			var regexp = new RegExp("\\d{19}");	
			var newpassword = document.frmApply.txtNewPassword.value;
			var regexp = new RegExp("\\d{19}");
			var confirmpassword = document.frmApply.txtConfirmPassword.value;
			var regexp = new RegExp("\\d{19}");
			
	        var md5keystring = md5KeyValue;//document.quickLookForm.md5key.value ;

			var encSaltPassOld = encryptLoginPassword(md5keystring,username,oldpassword);
			var encSaltSHAPassOld = encryptSha2LoginPassword(md5keystring,username,oldpassword);
			
			var encSaltPassNew = encryptLoginPassword(md5keystring,username,newpassword);
			var encSaltSHAPassNew = encryptSha2LoginPassword(md5keystring,username,newpassword);
			var encSaltSHAPassNewOne = encryptSha2ChangePassword(md5keystring,username,newpassword);
			
			var encSaltPassConfirm = encryptLoginPassword(md5keystring,username,confirmpassword);
			var encSaltSHAPassConfirm = encryptSha2LoginPassword(md5keystring,username,confirmpassword);
			//alert(username);
			document.frmApply.txtoldPassword.value = encSaltPassOld; //changed
			document.frmApply.shapasswordOld.value = encSaltSHAPassOld; //changed
			
			document.frmApply.txtNewPassword.value = encSaltPassNew; //changed
			document.frmApply.shapasswordNew.value = encSaltSHAPassNew; //changed
			document.frmApply.shapasswordNewOne.value = encSaltSHAPassNewOne; //changed
			
			document.frmApply.txtConfirmPassword.value = encSaltPassConfirm; //changed
			document.frmApply.shapasswordConfirm.value = encSaltSHAPassConfirm; //changed
			//alert(document.frmApply.txtConfirmPassword.value);
			
			var formData = new FormData(document.getElementById("frmApply"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/change_password",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response)
				{  
					var result = jQuery.parseJSON(response);
		            if(result.status)
		            {
						swal({
						title: "Change Password",
						text: "Congratulation!!! Password has been changed successfully.",
						type: "success"
						},
						function(isConfirm) {
						  if (isConfirm) {
						  	window.location.href = ("<?php echo base_url() ?>user/logout");
						  }
						});
					}
					else
					{
						swal({
						title: "Change Password",
						text: result.msg,
						type: "error"
						},
						function(isConfirm) {
						  if (isConfirm) {
						  	$("#txtoldPassword").val('');
						  	$("#txtNewPassword").val('');
						  	$("#txtConfirmPassword").val('');
						  	$('#frmApply').data('bootstrapValidator').resetForm(true);
						  	window.location.reload();
						  }
						});
					}
					
					
				},
				error:function()
				{
					toastr.error('Unable to Save.Please Try Again ');	
				}
			});
		},
		fields: {	
				txtoldPassword: {
						validators: {
							notEmpty: {
								message: 'This field can\'t left blank'
							}
						}
					},
				txtNewPassword: {
					validators: {
						notEmpty: {
							message: 'This field can\'t left blank'
						},
                		regexp: {
							regexp: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[$@!%?&]).{6,12}$/,
							message: "The password should contain Minimum 6 and Maximum 12 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character"
						}
					}
				},
				txtConfirmPassword: {
					validators: {
						notEmpty: {
							message: 'This field can\'t left blank'
						},
						regexp: {
							regexp: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[$@!%?&]).{6,12}$/,
							message: "The password should contain Minimum 6 and Maximum 12 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character"
						},
						identical: {
		                    field: 'txtNewPassword',
		                    message: 'New password and its confirm are not the same'
	                	}
					}
				}	
			}
	} );
	$("#openModal").click(function()
	{
		$('#frmApply').data('bootstrapValidator').resetForm(true);
  		$('#exampleModal').modal('show');
	});
	/*$("#btnChangePassword").click(function()
	{
		alert("FDsfds");
		md5KeyValue = "<?php echo $this->session->userdata('key');?>";
		
		if($("#txtoldPassword").val() == '')
		{
			toastr.error("Please enter Old Password");
			return false;
		}
		else if($("#txtNewPassword").val() == '' || $("#txtConfirmPassword").val() == '')
		{
			toastr.error("Please enter Password and Confirm Password");
			return false;
		}
		//added for CR 5034 - begin.
		var username ="abcd@abcd";
		username = document.frmApply.user_name.value;	
		
		var oldpassword = document.frmApply.txtoldPassword.value;
		var regexp = new RegExp("\\d{19}");	
		var newpassword = document.frmApply.txtNewPassword.value;
		var regexp = new RegExp("\\d{19}");
		var confirmpassword = document.frmApply.txtConfirmPassword.value;
		var regexp = new RegExp("\\d{19}");
		
        var md5keystring = md5KeyValue;//document.quickLookForm.md5key.value ;

		var encSaltPassOld = encryptLoginPassword(md5keystring,username,oldpassword);
		var encSaltSHAPassOld = encryptSha2LoginPassword(md5keystring,username,oldpassword);
		
		var encSaltPassNew = encryptLoginPassword(md5keystring,username,newpassword);
		var encSaltSHAPassNew = encryptSha2LoginPassword(md5keystring,username,newpassword);
		var encSaltSHAPassNewOne = encryptSha2ChangePassword(md5keystring,username,newpassword);
		
		var encSaltPassConfirm = encryptLoginPassword(md5keystring,username,confirmpassword);
		var encSaltSHAPassConfirm = encryptSha2LoginPassword(md5keystring,username,confirmpassword);
		//alert(username);
		document.frmApply.txtoldPassword.value = encSaltPassOld; //changed
		document.frmApply.shapasswordOld.value = encSaltSHAPassOld; //changed
		
		document.frmApply.txtNewPassword.value = encSaltPassNew; //changed
		document.frmApply.shapasswordNew.value = encSaltSHAPassNew; //changed
		document.frmApply.shapasswordNewOne.value = encSaltSHAPassNewOne; //changed
		
		document.frmApply.txtConfirmPassword.value = encSaltPassConfirm; //changed
		document.frmApply.shapasswordConfirm.value = encSaltSHAPassConfirm; //changed
		//document.frmApply.key.value = md5keystring; //changed
		//return false;
		document.frmApply.submit();
		var oldpassword ="";
		var newpassword ="";
		var confirmpassword ="";
		return true;
		
	});*/
	
</script>