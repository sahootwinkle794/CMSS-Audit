$('#frmApply').bootstrapValidator({
		message: 'This value is not valid',
        
	submitButtons: 'button[type="submit"]',
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
					},
					identical: {
	                    field: 'txtconfirmpassword',
	                    message: 'New password and its confirm are not the same'
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

function do_submit()
		{
			//alert(document.getElementById('txtoldPassword').value);
			//var md5KeyValue = "<?php echo $this->session->userdata('key');?>";
			/*if(md5KeyValue == ''){
				alert('Session Expired.Please Try Again!');
				window.location.reload();
				return;
			}*/
			/*if($("#txtUsername").val() == '' || $("#txtPassword").val() == '')
			{
				toastr.error("Please enter username and password");
				return false;
			}*/
			//added for CR 5034 - begin.
			//var username ="abcd@abcd";
			var username = document.frmApply.user_name.value;	
			var md5KeyValue = document.frmApply.key.value;	
			/*arr_user = username.split('@');
			username = arr_user[0];*/
			var oldpassword = document.frmApply.txtoldPassword.value;
			var regexp = new RegExp("\\d{19}");	
			var newpassword = document.frmApply.txtNewPassword.value;
			var regexp = new RegExp("\\d{19}");
			var confirmpassword = document.frmApply.txtConfirmPassword.value;
			var regexp = new RegExp("\\d{19}");
			//document.frmApply.passwordNew.value = newpassword; //changed
			

	        //document.getElementById("btnCheck").disabled=true;
	        var md5keystring = md5KeyValue;//document.quickLookForm.md5key.value ;
	        /*console.log(oldpassword);
			console.log(username);
			console.log(md5keystring);
			alert(oldpassword);
			alert(username);
			alert(md5keystring);*/

			var encSaltPassOld = encryptLoginPassword(md5keystring,username,oldpassword);
			var encSaltSHAPassOld = encryptSha2LoginPassword(md5keystring,username,oldpassword);
			
			var encSaltPassNew = encryptLoginPassword(md5keystring,username,newpassword);
			var encSaltSHAPassNew = encryptSha2LoginPassword(md5keystring,username,newpassword);
			//var encSaltSHAPassNewOne = encryptSha2ChangePassword(md5keystring,username,newpassword);
			var encSaltSHAPassNewOne = encryptShaPassCode(username,newpassword);
			
			var encSaltPassConfirm = encryptLoginPassword(md5keystring,username,confirmpassword);
			//var encSaltSHAPassConfirm = encryptSha2LoginPassword(md5keystring,username,confirmpassword);
			var encSaltSHAPassConfirm = encryptShaPassCode(username,confirmpassword);
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
			
		}