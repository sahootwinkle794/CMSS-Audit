 <?php 
	//$inscode1 = $this->session->set_userdata('ins_code', $institute);
	$logo = '';
	$inscode = '';
	$ins = '';
	$insname = '';
	$ins_type = '';
	foreach($institute as $row){ 
		$ins_code = $row['institute_code'];
		$institute_code = encrypt_decrypt('encrypt',$ins_code);
		$ins_type = $row['type'];
	}
	if($ins_type == "RECRUITMENT")
	{
		$img = "online_recruitment.png";
	}
	else
	{
		$img = "online_admision.png";
	}

?>
<!--!DOCTYPE html>
<html>
	<head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <title>ES Common Portal | Log in</title>
	 
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	 
	  <link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/css/bootstrap.min.css">
	
	  <link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/font-awesome/css/font-awesome.min.css">
	 
	  <link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/css/AdminLTE.min.css">
	 
	  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		-->
		<style>
			/* form starting stylings ------------------------------- */
			.form-group {
			     margin-bottom: 0px; 
			}
			.admin-login-background{
				position: relative;
				background: #224D56;
				margin-left: 32%;
    			padding-right: 0px;
				margin-top: 12px;
				border-radius: 24px;
				box-shadow: 2px 2px 2px 1px #0000005c;
				width: 549px;
			}
			.lMob{
				font-family: Exo 2;
				font-weight: 500;
				font-size: 16px;
				line-height: 19px;
				color: #FFFFFF;
				margin-left: -99px;
			}
			.inpmob{
				margin-left: 140px;
			    top: -36px;
			    border-radius: 6px;
			    border: 1px solid #86E3F0;
			    width: 343px;
			    background: #ADDFE7;
			}
			.center{
				  display: block;
				  margin-left: 48px;
				  margin-right: auto;
				  width: 50%;
			}
			.capinp{
				font-family: Exo 2;
			    height: 46px;
			    background: #FFFFFF;
			    border: 1px solid #A4C2C7;
			    box-sizing: border-box;
			    border-radius: 5px;
			    margin-left: -45px;
			    margin-top: 2px;
			    width: 200px;
			}
			.refreshimg{
				height: 46px;
			    margin-left: -39px;
			    margin-top: 2px;
			}
			.btnlog{
				position: inherit;
		    	background: linear-gradient(180deg, #E48210 0%, #E47610 100%);
			    width: 451px;
			    margin-left: -15px;
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
			.group { 
			  position:relative; 
			  margin-bottom:45px; 
			}
			/*input[type="email"], input[type="password"], input[type="text"] {
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
        }*/
		
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
			.btn-primary {
			    background-color: #a94442;
			    border-color: #a94442;
			}
	
	.ann_label_home {
	font-size: 15px;
    width: 100%;
    cursor: pointer;
    top: 8px;
		    	
	}
</style> 
<style>
	/*@media (max-width: 1024px){
		.admin-login-background {
		    margin-left: 23%;
		}
	}*/
	@media (min-width: 767px) and (max-width: 1024px){
		.admin-login-background {
		    margin-left: 18%;
		}
		.refreshimg {
		    margin-left: 167px;
		    margin-top: -68px;
		}
	}
	@media (min-width: 551px) and (max-width: 766px){
		.admin-login-background {
		    margin-left: 39px;
    		width: 536px;
		}
		.capinp{
			margin-left: 72px;
		}
		.refreshimg {
		    height: 46px;
		    margin-left: 169px;
		    margin-top: -68px;
		}
	}
	@media (min-width: 416px) and (max-width: 550px){
		.logo_img {
		    position: absolute;
		    width: 78%;
		    left: 35px;
		    top: 13px;
		}
		.register_button {
		    height: 107px;
		    width: 11%;
		    left: 364px;
		    top: -7px;
		}
		.login_button {
		    height: 122px;
		    width: 11%;
		    margin-left: 462px;
		    top: -112px;
		}
		.admin-login-background {
		    margin-left: 14px;
		    width: 515px;
		    top: -15px;
		}
		.center {
		    margin-left: 73px;
		}
		.capinp {
		    margin-left: 73px;
		}
		.refreshimg {
		    margin-left: 189px;
		    margin-top: -64px;
		}
	}
	@media (min-width: 377px) and (max-width: 415px){
		.logo_img {
		    position: absolute;
		    width: 80%;
		    left: 29px;
		    top: 13px;
		}
		.reg {
		    width: 44px;
		    height: 40px;
		    left: 152px;
		    top: -9px;
		}
		.regi {
		    left: 146px;
		    top: 13px;
		    font-size: 7px;
		}
		.log{
			width: 44px;
		    height: 40px;
		    left: 189px;
		    top: -109px;
		}
		.log1 {
		    left: 183px;
		    top: -86px;
		    font-size: 7px;
		}
		.register_button {
		    left: 133px;
		}
		.login_button {
		    margin-left: 152px;
		}
		.admin-login-background {
		    width: 343px;
		    margin-left: 28px;
		    top: -77px;
		}
		.inpmob {
		    margin-left: 106px;
		    top: -31px;
		    width: 199px;
		}
		.lMob {
		    margin-left: -68px;
		}
		.center {
		    margin-left: 67px;
		    margin-top: -11px;
		}
		.capinp {
		    margin-left: 11px;
		    margin-top: 5px;
		    width: 200px;
		}
		.refreshimg {
		    height: 45px;
		    margin-left: 205px;
		    margin-top: -69px;
		}
		.btnlog {
		    width: 299px;
		    margin-left: -14px;
		    height: 37px;
		}
		.texlog {
		    font-size: 13px;
		}
	}
	@media (min-width: 200px) and (max-width: 376px){
			.logo_img {
			    position: absolute;
			    width: 79%;
			    left: 25px;
			    top: 15px;
			    height: 35px;
			}
			.reg {
			    width: 44px;
			    height: 40px;
			    left: 152px;
			    top: -9px;
			}
			.regi {
			    left: 146px;
			    top: 13px;
			    font-size: 7px;
			}
			.log{
				width: 44px;
			    height: 40px;
			    left: 189px;
			    top: -109px;
			}
			.log1 {
			    left: 183px;
			    top: -86px;
			    font-size: 7px;
			}
			.admin-login-background {
			    width: 331px;
			    margin-left: 18px;
			    top: -77px;
			}
			.inpmob {
			    margin-left: 106px;
			    top: -31px;
			    width: 199px;
			}
			.lMob {
			    margin-left: -68px;
			}
			.center {
			    margin-left: 67px;
			    margin-top: -11px;
			}
			.capinp {
			    margin-left: 0px;
			    margin-top: -11px;
			    width: 200px;
			}
			.refreshimg {
			    height: 39px;
			    margin-left: 205px;
			    margin-top: -65px;
			}
			.btnlog {
			    width: 280px;
			    margin-left: -10px;
			    height: 33px;
			}
			.texlog {
			    font-size: 13px;
			}
		}
</style>
<link href="<?php echo base_url(); ?>public/assets/css/text-scroll.css" rel="stylesheet" /> 
		<script src='https://www.google.com/recaptcha/api.js'></script>
	<!--</head>-->
	<!--<body class="hold-transition login-page">-->

		<section style=" min-height: 575px;">
		<!--<div class="row" >
			<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 Ann" style="background-color: #2098df;height: 40px;border-radius: 20px;width: 91%;left: 5%;">
	            <div class="hidden-sm hidden-xs col-md-1 col-lg-1 col-xl-1 ">
	            	<label style="position: absolute;color: white;top: 3px;left: -14px;width: 100%;font-size: 15px;margin-top: -3px;z-index: 1;" >
	            	<img src="<?php echo base_url()?>upload/image/ann.png"></label>
	            </div>
	            <div class="col-sm-12 col-xs-12 col-md-11 col-lg-11 col-xl-11" style="">	
		            <div class="scroll-hr">	
						<p style="font-size: 15px; width: 100%;cursor: pointer;top: 8px;">
							
							<a target='_blank' class='viewlink' style='text-decoration:none;color:#fff'  href="#">»&nbsp;Advertisement for the Different Posts of CMSS</a></h2>                           
						</p>
					</div>
				</div>
       		</div>
		</div>-->

		<div class="col-md-12" style="text-align:center; width:100%;height:100%; padding:40px 0px 40px 0px; ">
			<!--<div class="col-md-4"></div>-->
			<!-- <div class="col-md-8">  
			<div style="padding-top: 120px;">
			    <img src="<?php echo base_url()?>upload/image/<?php echo $img; ?>" style="width: 100%;background-color:#484848;">

			</div>
   			</div> -->
	<!-- 		<div class="col-md-6" style="margin-left:25%; padding-right: 0px;"> -->
	
			
			<div class="row admin-login-background">
       			<h3 style="text-align: center;color: white;font-size: 18px;font-weight: 600;padding-top: 10px;">Admin Login</h3>
       			<div class="login-box" style="width: 90%;">
       			<?php include_once(dirname(dirname(__FILE__)) . '/template_config/alerts.php');?>
       				<div class="login-box-body">
       				<?php echo form_open(null, array('class'=>'loginForm', 'id'=>'frmApply', 'name'=>'frmApply' ,'enctype'=>"multipart/form-data")); ?>
	        			<!--<form  class=" login-box-body"  action="" method="post" id="frm_login" name="frm_login">-->
				   		<input type="hidden" id="hidLogin" name="hidLogin">
						<input type="hidden" name="shapassword" id="shapassword"/>
						<div class="row fpad form-group">
							<div class="col-sm-5 col-xs-5">
							    <label for="txtUsername" class="lMob"><i style="color:red;font-size:18px;"></i>&nbsp;&nbsp;<i class="" style="color:#E4791A"></i> User ID  </label>
				  			</div>
				  			<div class="row form-group">
					      		<div class="input-group inpmob">
									<div class="input-group-addon ad" style="background: #ADDFE7;">
										<span class="input-group-text">
											<i class="fa fa-user" style="color:#E4791A"></i>
										</span>                    
									</div>
									<input class="form-control" style="background: #ADDFE7;" type="text" id="txtUsername" name="txtUsername"  autocomplete="off" data-placement="top" placeholder="User ID" oncopy="return false" onpaste="return false">
								</div>
							</div>
						</div>
						<div class="row fpad form-group">
							<div class="col-sm-5 col-xs-5">
							    <label for="txtPassword" class="lMob"><i style="color:red;font-size:18px;"></i>&nbsp;&nbsp;<i class="" style="color:#E4791A"></i> Password  </label>
				  			</div>
				  			<div class="row form-group">
					      		<div class="input-group inpmob">
									<div class="input-group-addon ad" style="background: #ADDFE7;">
										<span class="input-group-text">
											<i class="fa fa-user" style="color:#E4791A"></i>
										</span>                    
									</div>
									<input class="form-control" type="password" style="background: #ADDFE7;" id="txtPassword" name="txtPassword"  autocomplete="off" data-placement="top" placeholder="Password" oncopy="return false" onpaste="return false">
								</div>
							</div>
						</div>
					
						<div class="row">
							<div class="col-sm-6">
								<div class="row" align="right" style="padding-top: 0px;"> 
							        <p id="captImg" class="center"></p>
							    </div>
							</div>
							<div class="col-sm-6">
								<div class="row form-group" style="margin-top: 0;" >
							       	<div class="col-lg-10">
							       		<input class="form-control capinp" type="text" maxlength="6" id="txtCaptcha" name="txtCaptcha" onkeyup="this.value=this.value.toUpperCase()" autocomplete="off" placeholder="Captcha Code" >
							       	</div>
					  			   	<div class="col-lg-2">
					  			   		<a href="javascript:void(0);" onclick="refresh_captcha()" class="refreshCaptcha" id="refreshCaptcha" ><img class="refreshimg" src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
					  			   	</div>
			  		   			</div>
							</div>
						</div>
					
						<div class="row fpad">
						    <div class="col-sm-12 col-xs-6" align="center" >
					   	 			<button class="btnlog" onClick="return do_submit()" type="submit" id="btnlogin" name="btnlogin"><span class="texlog">LOGIN</span></button>
				    		</div>
				    	</div>
					</form>
					</div>
				</div>   
       		</div>
		</div>
		</section>
	
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
						var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha" onclick="refresh_captcha()"  id="refreshCaptcha" ></a>';
						//var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha" onclick="refresh_captcha()"  id="refreshCaptcha" ><img src="'+refresh+'"/></a>';
						$("#captImg").html(res);	
					},
					error:function(){
						toastr.error("We are unable to Process.Please contact Support");
					}
				});
				
				
				$('#frmApply').bootstrapValidator({
					submitButtons: 'button[type="submit"]',
					submitHandler: function(validator, form, submitButton) 
					{
						var formData = new FormData(document.getElementById("frmApply"));
						var shapassword = $("#shapassword").val();
						$.ajax({
							url:base_url+"Index/Admin_login",
							type:"post",
							data:formData,
							cache: false,
					        contentType: false,
					        processData: false,
							success:function(response)
							{  
								var result = JSON.parse(response);
								console.log('result',result);
								//return false;
								if(result.status == true)
								{ 
									var page = base_url+""+result.index_page; 
									window.open(page,"_self");
									
								}
								else 
								{
									if(result.logoutoptAdmin=='YES'){
										usernameval = $('#txtUsername').val();
										swal({
											title: "Failed",
											text: result.msg,
											type: "error",
											showCancelButton: true,
									        closeOnConfirm: false,
									        showLoaderOnConfirm: true,
											},
											function(isConfirm) {
											  if (isConfirm) {
											    $.ajax({
													url:base_url+"ajax_controller/logout_all_system",
													type:"post",
													data:{ txtPhoneNo:  usernameval},
													success:function(response){ 
														window.location.reload();	
													},
													error:function(){
														toastr.error("We are unable to Process.Please contact Support");
													}
												});
											  }else{
											  	window.location.reload();	
											  }
										});
										/*confirmReturn = confirm("You have already sign-in with another system");
										if(confirmReturn){
											 $.ajax({
												url:base_url+"ajax_controller/logout_all_system",
												type:"post",
												data:{ txtPhoneNo:  usernameval},
												success:function(response){ 
													window.location.reload();	
												},
												error:function(){
													toastr.error("We are unable to Process.Please contact Support");
												}
											});
										}*/
									} 
									else if(result.logout == 'NO'){
										usernameval = $('#txtUsername').val();
										swal({
											title: "Failed",
											text: "You have logged in already. Kindly Logout!!",
											type: "error"
											},
											function(isConfirm) {
											  if (isConfirm) {
											    $.ajax({
													url:base_url+"ajax_controller/logout_all_system",
													type:"post",
													data:{ txtPhoneNo:  usernameval}, 
													success:function(response){ 
														window.location.reload();	
													},
													error:function(){
														toastr.error("We are unable to Process.Please contact Support");
													}
												});
											  }else{
											  	window.location.reload();	
											  }
										});
									}
									else if(result.msg == 'Invalid Captcha. Please try again.')
									{ 
										swal({
											title: "Failed",
											text: result.msg,
											type: "error"
											},
											function(isConfirm) {
											  if (isConfirm) {
											    window.location.reload();
											  }
										});
										/*toastr.error(result.msg);	
										$("#txtCaptcha2").val('');
										$('#frmAdminLogin').data('bootstrapValidator').updateStatus('txtCaptcha2', 'NOT_VALIDATED', null).validateField('txtCaptcha2');
										refresh_captcha();
										$('.loadingRPimage').fadeIn(250);*/
									}
									else if(result.msg == 'Invalid username or password')
									{ 
										swal({
											title: "Failed",
											text: result.msg,
											type: "error"
											},
											function(isConfirm) {
											  if (isConfirm) {
											    window.location.reload();
											  }
										});
										/*toastr.error(result.msg);	
										$("#txtCaptcha2").val('');
										$("#txtPassword").val('');
										$('#frmAdminLogin').data('bootstrapValidator').updateStatus('txtPassword', 'NOT_VALIDATED', null).validateField('txtPassword');
										$('#frmAdminLogin').data('bootstrapValidator').updateStatus('txtCaptcha2', 'NOT_VALIDATED', null).validateField('txtCaptcha2');
										refresh_captcha();
										$('.loadingRPimage').fadeIn(250);*/
									}
									else 
									{ 
										swal({
											title: "Failed",
											text: result.msg,
											type: "error"
											},
											function(isConfirm) {
											  if (isConfirm) {
											    window.location.reload();
											  }
										});
										/*toastr.error(result.msg);	
										$('.loadingRPimage').fadeIn(250);*/
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
						txtUsername: {
			                validators: {
			                    notEmpty: {
			                        message: 'Please Enter User Name'
			                    }
			                }
			            },
						txtPassword: {
			                validators: {
			                    notEmpty: {
			                        message: 'Please Enter Password'
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
									message: 'Captcha code must be 6 characters'
								}
			                }
			            },
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
				//document.frmApply.submit();
				var password ="";
				return true;
				
			}
			
			
			  
		</script>
	<!--</body>
</html>
-->