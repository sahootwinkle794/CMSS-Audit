<!DOCTYPE html>
<html>
	<head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <title>AdminLTE 2 | Log in</title>
	  <!-- Tell the browser to be responsive to screen width -->
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <!-- Bootstrap 3.3.7 -->
	  <link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/bower_components/bootstrap/dist/css/bootstrap.min.css">
	  <!-- Font Awesome -->
	  <link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/bower_components/font-awesome/css/font-awesome.min.css">
	  <!-- Ionicons -->
	  <link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/bower_components/Ionicons/css/ionicons.min.css">
	  <!-- Theme style -->
	  <link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/dist/css/AdminLTE.min.css">
	 <!-- Google Font -->
	  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		<style>
			/* form starting stylings ------------------------------- */
			.group 			  { 
			  position:relative; 
			  margin-bottom:45px; 
			}
			input[type="email"], input[type="password"], input[type="text"] {
            border-radius: 0px;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            -ms-border-radius: 0px;
            border: 0px;
            background-image: linear-gradient(#673AB7, #673AB7), linear-gradient(#D2D2D2, #D2D2D2);
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

        .floating-label {
            transform: translateY(-27px);
            transition: transform 0.2s ease-out; 
        }

        .static-label {
            transform: translateY(-47px);
            transition: transform 0.2s ease-out; 
        }
			

			/* ANIMATIONS ================ */
			@-webkit-keyframes inputHighlighter {
				from { background:#5264AE; }
			  to 	{ width:0; background:transparent; }
			}
			@-moz-keyframes inputHighlighter {
				from { background:#5264AE; }
			  to 	{ width:0; background:transparent; }
			}
			@keyframes inputHighlighter {
				from { background:#5264AE; }
			  to 	{ width:0; background:transparent; }
			.login-box, .register-box {
			width: 360px;
			margin: 0% auto;
			}
		</style>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body class="hold-transition login-page">
		
		<div class="col-md-12" style="text-align:center; width:100%;height:100%; padding:60px 0px 60px 0px; background-image: url('<?php echo base_url(); ?>public/photos/logo/scales-pattern1.jpg')">
			<div class="col-md-4"></div>
			<div class="col-md-4" style="margin:auto;">
				<div class="box box-primary">
		            <div class="box-body box-profile">
		            	<img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>public/photos/stl.png" alt="User profile picture">
						<h3 class="profile-username text-center">Login</h3>
						<p class="text-muted text-center">Explode your Creation</p>

		              	<div class="login-box">
							
							<!-- /.login-logo -->
							<div class="login-box-body">
								<?php echo form_open(null, array('class'=>'loginForm', 'id'=>'login_form' ,'enctype'=>"multipart/form-data")); ?>
							    	<input type="hidden" id="hidLogin" name="hidLogin">
							    	<div class="group">      
								    	<input id="txtUsername" type="text" class="form-control" name="txtUsername" value="">
            							<label for="txtUsername" class="floating-label" style="float: left;">User ID</label>
										<?php echo form_error('txtUsername'); ?>								    
								    </div>
							      	<div class="group">      
							      		<input id="txtPassword" type="password" class="form-control" name="txtPassword" value="">
            							<label for="txtPassword" class="floating-label" style="float: left;">Password</label>
							    		<?php echo form_error('txtPassword'); ?>	
							    	</div>
							    	<!--<div class="g-recaptcha" id="captcha" data-sitekey="6LdNRi4UAAAAAGj29Mynz9Ebibm_teVLYPNxdhtK" data-callback="recaptchaCallback"></div>-->
								  <div class="row">
									<div class="col-xs-12" >
										<!--<span style="color:red;"><?=$message; ?></span>-->
									</div>
								  </div>
							      	<div class="row">
								      <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
								    </div>
							    </form>
						 	</div>
					  		<!-- /.login-box-body -->
						</div>
						<!-- /.login-box -->
					</div>
		            <!-- /.box-body -->
		        </div>
		        <!-- /.box -->
		    </div>
		</div>
		

		<!-- jQuery 3 -->
		<script src="<?php echo base_url(); ?>public/template_lib/bower_components/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap 3.3.7 -->
		<script src="<?php echo base_url(); ?>public/template_lib/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
		<script>
			/*function recaptchaCallback()
			{
			 	var onloadCallback = function() {
			        grecaptcha.render('captcha', {
			          'sitekey' : '6LdNRi4UAAAAAGj29Mynz9Ebibm_teVLYPNxdhtK'
			        });
			    };
			}
			var $input = $('.form-control');

		    $input.focusout(function() {
		        if($(this).val().length > 0) {
		            $(this).next('label').removeClass('floating-label').addClass('static-label');
		        }
		        else {
		            $(this).removeClass('input-focus');
		            $(this).next('label').addClass('floating-label').removeClass('static-label');
		        }
		    });*/

		</script>
	</body>
</html>
