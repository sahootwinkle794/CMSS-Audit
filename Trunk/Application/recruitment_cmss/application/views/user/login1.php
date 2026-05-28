<!DOCTYPE html>
<html>
	<head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <title>ES Common Portal | Log in</title>
	  <!-- Tell the browser to be responsive to screen width -->
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <!-- Bootstrap 3.3.7 -->
	  <link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/css/bootstrap.min.css">
	  <!-- Font Awesome -->
	  <link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/font-awesome/css/font-awesome.min.css">
	  <!-- Ionicons -->
	  <link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/Ionicons/css/ionicons.min.css">
	  <!-- Theme style -->
	  <link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/css/AdminLTE.min.css">
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
		<div class="col-md-12" style="text-align:center; width:100%;height:100%; padding:60px 0px 60px 0px; background-image: url('<?php echo base_url(); ?>public/assets/images/bgimage.png')">
			<div class="col-md-4"></div>
			<div class="col-md-4" style="margin:auto;">
				<div class="box box-primary">
		            <div class="box-body box-profile">
						<h3 class="profile-username text-center">Login</h3>
		              	<div class="login-box">
							<?php include_once(dirname(dirname(__FILE__)) . '/template_config/alerts.php');?>
							<!-- /.login-logo -->
							<div class="login-box-body">
								<?php echo form_open(null, array('class'=>'loginForm', 'id'=>'login_form', 'name'=>'frmApply' ,'enctype'=>"multipart/form-data")); ?>
							    	<input type="hidden" id="hidLogin" name="hidLogin">
									<input type="hidden" name="shapassword" id="shapassword"/>
							    	<div class="group">      
								    	<input id="txtUsername" type="text" class="form-control" name="txtUsername" value="">
            							<label for="txtUsername" class="floating-label" style="float: left;">User ID</label>
								    </div>
							      	<div class="group">      
							      		<input id="txtPassword" type="password" class="form-control" name="txtPassword" value="">
            							<label for="txtPassword" class="floating-label" style="float: left;">Password</label>
							    	</div>
									<div class="row">
								      <div class="form-group">
											<p id="captImg">
										<a href="javascript:void(0);" class="refreshCaptcha" id="refreshCaptcha" ><img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
											</p>
									  </div>
								    </div>
							    	<div class="group">
										<input id="txtCaptcha" type="password" class="form-control" name="txtCaptcha" value="">
            							<label for="txtPassword" class="floating-label" style="float: left;">Enter Above Security Code :</label>
									</div>
										
							      	
									<div class="row">
								      <button type="submit" onClick="return do_submit()" class="btn btn-primary btn-block btn-flat">Log In</button>
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
		<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
		<!-- Bootstrap 3.3.7 -->
		<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
		<script src="<?php echo base_url(); ?>public/assets/js/md5_5034.js"></script>
		<script src="<?php echo base_url(); ?>public/assets/js/profile_sha.js"></script>
		<script src="<?php echo base_url(); ?>public/assets/js/sha512.js"></script>
		<script>
			var base_url = '<?= base_url()?>';
			function recaptchaCallback()
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
		    });
			$(document).ready(function() {
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
			});
			function refresh_captcha()
			{		
				$.get(base_url+'ajax_controller/refresh_captcha', function(data){
					refresh = base_url + 'public/assets/images/refresh.png';
					var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha" onclick="refresh_captcha()"  id="refreshCaptcha" ><img src="'+refresh+'"/></a>';
					$("#captImg").html(data);
			    });
			}
			function do_submit()
			{
				md5KeyValue = "<?php echo $this->session->userdata('key');?>";
				//alert(md5KeyValue);
				/*if(md5KeyValue == ''){
					alert('Session Expired.Please Try Again!');
					window.location.reload();
					return;
				}*/
				//alert(md5KeyValue);
				if($("#txtUsername").val() == '' || $("#txtPassword").val() == '')
				{
					toastr.error("Please enter username and password");
					return false;
				}
				//added for CR 5034 - begin.
				var username ="";
				username = document.frmApply.txtUsername.value;	
				arr_user = username.split('@');
				username = arr_user[0];
				var password = document.frmApply.txtPassword.value;
				var regexp = new RegExp("\\d{19}");

				

		        //document.getElementById("btnCheck").disabled=true;
		        var md5keystring = md5KeyValue;//document.quickLookForm.md5key.value ;

				var encSaltPass = encryptLoginPassword(md5keystring,username,password);
				var encSaltSHAPass = encryptSha2LoginPassword(md5keystring,username,password);
				//alert(username);
				document.frmApply.txtPassword.value = encSaltPass; //changed
				document.frmApply.shapassword.value = encSaltSHAPass; //changed
				//document.frmApply.key.value = md5keystring; //changed
				//return false;
				document.frmApply.submit();
				var password ="";
				return true;
				
			}
		</script>
	</body>
</html>
