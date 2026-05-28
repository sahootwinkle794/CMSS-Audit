<style>
.link a {
    color: #fff;
   
    
}
.center-text{
	text-align: center;
}
/*.link a:focus::before, a:hover::before, a:focus::after, a:hover::after {
  max-height: 100%;
  transition-delay: .28s;
  border-color: rgba(249,201,153,1);
}
.link a:focus, a:hover {
  padding: 5px 7px;
  border-color: rgba(249,201,153,1);
  outline: none;
  color: #000 !important;
}
.link a:focus, a:hover {
    padding: 5px 7px;
    border-color: #F9C999;
    outline: medium none;
    color: #FF8400 !important;
    cursor: pointer;
}

.web span:focus, span:hover{
	color:blue;
}*/

</style>
<?php 
	$logo = '';
	$inscode = '';
	$ins = '';
	$insname = '';
	$ins_addr = '';
	foreach($institute as $row){ 
		$inscode = $row['institute_code'];
		$ins =  encrypt_decrypt('encrypt', $inscode);
		$insname = $row['institute_name'];
		$logo = $row['logo_url'];	
		$ins_addr = $row['location'];	
		$website = $row['website_address'];	
		$contact_number = $row['contact_number'];	
		$institute_email = $row['institute_email'];	
	}

?>
<footer style=" padding:0; color:#fafafa;">
	<section style="background: black;"> 
		<input type="hidden" id="hidInsCode" value="<?php echo $inscode; ?>"/>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 10px;">
				<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 col-xl-5" style="text-align: center;">
					<span><?php echo $insname; ?></span><br />
					<span>Best viewed with Firefox 16+, Chrome 23</span>
				</div>
				<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 col-xl-5" style="text-align: center;">
					<span><i class="fa fa-envelope" aria-hidden="true"></i> Email: <span id="ins_email" style="color:#fff;">  </span></span><br />
					<span><i class="fa fa-globe" aria-hidden="true"></i> Website: <span id="ins_web_address" style="color:#fff;">  </span></span>
				</div>
				<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2 center-text">
	        		<img src="<?php echo base_url();?>upload/image/admin_icon.png" onclick="adminlogo('<?php echo $ins; ?>')" title="" style="cursor: pointer;">
			    </div>
			</div>
    		<!--<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 col-xl-5 center-text">
        		<p style="font-size: 14px; color: #fff; padding-top: 20px; padding-left: 30px;">&copy; <?php echo $insname; ?>Best viewed with Firefox 16+, Chrome 23+</p>
        	</div>
        	<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2 center-text" style="padding-top: 20px;"> 
            	<p style="font-size: 15px; color: #F9C999;"><a href="#" style="color: #fff" onclick="viewQuickLink('<?php echo $inscode; ?>')" data-text=" Quick Links"><i class="fa fa-link fa-lg" aria-hidden="true"></i> Quick Links</a></p>
            </div>
        	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 center-text">
        		<p  style="font-size: 14px; color: #fff; padding-top: 8px;">
        		<?php echo $insname; ?> &nbsp; <?php echo $ins_addr; ?>
        		 </p>
 		  	</div>
       		<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-xl-2 center-text">
        		<p >
        			<div class="image" >
        			<img src="<?php echo base_url();?>upload/image/admin_icon.png" onclick="adminlogo('<?php echo $ins; ?>')" title="" style="cursor: pointer;">
		            </div>
            	</p>
     		</div>-->
	  	</div>
	</section>
	
  	<div id="contactModal" class="modal fade" role="dialog">
  		<div class="modal-dialog" style="width:80%;">
	    <!-- Modal content-->
		    <div class="modal-content">
		    	<div class="modal-header" style="background-color: #0d367e;">
		        	<button type="button" class="close" data-dismiss="modal" style=" padding: 2px 3px 41px 455px;cursor: pointer;background: transparent;">&times;</button>
		        	<h4 class="modal-title" id="contactheader" style="color: #ff5a00;">Contact us</h4>
		      	</div>
		      	<div class="modal-body">
			      	<div class="container-fluid" style="color:black; ;height:100px;">	
			      		<div class="col-sm-8" style="height:100px;">
				      		<div class="row">
				      			
				      			<p>Tel. No.<span><?php echo $contact_number; ?> </span></p>
				      		</div>
				      		<div class="row">
				      			<p>Email:<span><?php echo $institute_email; ?> </span></p>
				      		</div>	
			      		</div>
			      		<div class="col-sm-4" style="height:100px;">
				      		<div class="row">
				      			<p>Fax:<span> 91-44-22254787</span></p>
				      		</div>
				      		<div class="row">
				      			<p class="web">Web :<span  style="cursor: pointer;"><?php echo $website; ?></span></p>
				      		</div>		
				      	</div>	
				    </div>
			    </div>
		    </div>
    	</div>
  	</div>
  	<!-- Modal for quick links -->
  	<div id="linkModal" class="modal fade" role="dialog">
  		<div class="modal-dialog">
	    <!-- Modal content-->
		    <div class="modal-content">
		    	<div class="modal-header" style="background-color: #0d367e;">
		    		<h4 class="modal-title" id="contactheader" style="color: #fff;">Quick Links</h4>
		        	<button type="button" class="close" data-dismiss="modal" style="margin-left: 90%; margin-top: -3%; cursor: pointer; color: #FFF; background: none repeat scroll 0% 0% transparent; font-weight: bold; opacity: 1;">&times;</button>
		        	
		      	</div>
		      	<div class="modal-body">
			      	<div class="container-fluid" style="color:black; ;height:100px;">	
			      		<div class="col-sm-12" style="height:100px;">
				      		<div class="row" style="margin-top: 10px;">
				      			<p style="font-size: 20px;color:#23bc36;"><i class="fa fa-envelope" aria-hidden="true"></i> Email: <span id="ins_email" style="font-size: 20px;color:#666;">  </span></p>
				      		</div>
				      		<div class="row">
				      			<p style="font-size: 20px;color:#23bc36;"><i class="fa fa-globe" aria-hidden="true"></i> Website: <span id="ins_web_address" style="font-size: 20px;color:#666;">  </span></p>
				      		</div>	
			      		</div>
				    </div>
			    </div>
		    </div>
    	</div>
  	</div>
  	<!--Support modal-->
  <!--	<div id="supportModal" class="modal fade" role="dialog">
  		<div class="modal-dialog modal-lg" style="width:80%;">
	   
		    <div class="modal-content">
		    	<div class="modal-header" style="background-color: #0d367e;">
		    		<h4 class="modal-title" id="contactheader" style="color: #c3cee0;font-size:18px;"><i class="fa fa-users" aria-hidden="true" style="color: #FFF;font-size:18px;"></i> Support</h4>
		        	<button type="button" class="close" data-dismiss="modal" onclick="modalClose()" style="margin-left: 90%; margin-top: -3%; cursor: pointer; color: #FFF; background: none repeat scroll 0% 0% transparent; font-weight: bold; opacity: 1;">&times;</button>
		        	
		      	</div>
		      	<div class="modal-body">
		      		
			      	<div class="container-fluid" style="color: black;">	
				      	<div class="row">
					      	<div class="col-sm-12">
								<p style="font-size: 20px;color:#23bc36;"><i class="fa fa-phone-square" aria-hidden="true"></i> Call Us: <span style="font-size: 20px;color:#666;" id="contact_span">  </span></p>
								<p style="font-size: 20px;color:#23bc36;"><i class="fa fa-envelope" aria-hidden="true"></i> Email: <span id="ins_email1" style="font-size: 20px;color:#666;">  </span></p>
							</div>
				      		<div class="col-sm-12">
					      		<form  class="md-form login-box-body" method="post" role="form" action="" id="form_support" name="form_support" enctype="multipart/form-data" style="background: #fff;border-top: 0;color: #666;">
						      		<div class="row">
						      			<div class="form-group">
											<label class="col-md-4 control-label" style="color:#666;"><i class="fa fa-user" aria-hidden="true"></i> Applicant Name:</label>
											<div class="col-md-8" style="margin-top: 10px;">
												<input type="text" class="form-control" placeholder="Enter Your Name" id="cust_name" name="cust_name"/>
											</div>
										</div>
						      		</div>
						      		
						      		<div class="row" style="margin-top: 5px;">
						      			<div class="form-group">
											<label class="col-md-4 control-label" style="color:#666;"><i class="fa fa-mobile" aria-hidden="true"></i> Applicant Mobile No:</label>
											<div class="col-md-8" style="margin-top: 10px;">
												<input type="text" class="form-control" maxlength="10" placeholder="Enter Your Number" id="cust_no" name="cust_no"/>
											</div>
										</div>
						      		</div>
						      		<div class="row" style="margin-top: 5px;">
						      			<div class="form-group">
											<label class="col-md-4 control-label" style="color:#666;"><i class="fa fa-envelope-o" aria-hidden="true"></i> Applicant Email:</label>
											<div class="col-md-8"  style="margin-top: 10px;">
												<input type="email" class="form-control" placeholder="Enter Your Email Address" id="cust_email" name="cust_email"/>
											</div>
										</div>
						      		</div>
						      		<div class="row" style="margin-top: 10px;">
						      			<div class="form-group">
											<label class="col-md-4 control-label" style="color:#666;"><i class="fa fa-pencil" aria-hidden="true"></i> Query:</label>
											<div class="col-md-8"  style="margin-top: 10px;">
												<textarea class="form-control" rows="3" placeholder="Write Your Query Here..." id="grievance" name="grievance"></textarea>
											</div>
										</div>
						      		</div>
						      		<div class="row" style="margin-top: 20px;margin-bottom: 20px;">
						      			<div class="form-group" style="" >
										  	<center><button type="submit" style="padding-right: 10px;" class="btn btn-success" id="btndocumentUpload" name="btndocumentUpload" style="width: 90%;"><span class="glyphicon glyphicon-send" style=""></span> Submit</button></center> 
										</div>
						      		</div>
						      	</form>	
				      		</div>
				      	</div>	
					</div>
				</div>
		    </div>
    	</div>
  	</div>-->
  	<div id="supportModal" class="modal fade" role="dialog">
  		<div class="modal-dialog modal-lg" style="width:80%;">
	    <!-- Modal content-->
		    <div class="modal-content">
		    	<div class="modal-header" style="background-color: #0d367e;">
		    		<h4 class="modal-title" id="contactheader" style="color: #c3cee0;font-size:18px;"><i class="fa fa-users" aria-hidden="true" style="color: #FFF;font-size:18px;"></i> Support</h4>
		        	<button type="button" class="close" data-dismiss="modal" onclick="modalClose()" style="margin-left: 90%; margin-top: -3%; cursor: pointer; color: #FFF; background: none repeat scroll 0% 0% transparent; font-weight: bold; opacity: 1;">&times;</button>
		        </div>
		      	<div class="modal-body">
			      	<div class="container-fluid" style="color: black;">	
			      		<div class="alert alert-danger" id = "error_mesg" style="display: none;">
							
						</div>
				      	<div class="row">
					      	<div class="col-sm-12">
								<p style="font-size: 20px;color:#23bc36;"><i class="fa fa-phone-square" aria-hidden="true"></i> Call Us (Institute): <span id="mobileno" style="font-size: 20px;color:#666;"> </span></p>
								<!--<p style="font-size: 20px;color:#23bc36;"><i class="fa fa-phone-square" aria-hidden="true"></i> Call Us (Tech Support): <span style="font-size: 20px;color:#666;">Mr. B B Mishra (+91 90405 06551) </span></p>-->

								<p style="font-size: 20px;color:#23bc36;"><i class="fa fa-envelope" aria-hidden="true"></i> Email Us: <span id="email" style="font-size: 20px;color:#666;">  </span></p>
							</div>
				      		<div class="col-sm-12">
					      		<form  class="md-form login-box-body" method="post" role="form" action="" id="form_support" name="form_support" enctype="multipart/form-data" style="background: #fff;border-top: 0;color: #666;">
						      		<div class="row">
						      			<div class="form-group">
											<label class="col-md-4 control-label" style="color:#666;"><i class="fa fa-user" aria-hidden="true"></i> Applicant Name:</label>
											<div class="col-md-8" style="margin-top: 10px;">
												<input type="text" class="form-control" placeholder="Enter Your Name" id="cust_name" name="cust_name"/>
											</div>
										</div>
						      		</div>
						      		
						      		<div class="row" style="margin-top: 5px;">
						      			<div class="form-group">
											<label class="col-md-4 control-label" style="color:#666;"><i class="fa fa-mobile" aria-hidden="true"></i> Applicant Mobile No:</label>
											<div class="col-md-8" style="margin-top: 10px;">
												<input type="text" class="form-control" maxlength="10" placeholder="Enter Your Number" id="cust_no" name="cust_no"/>
											</div>
										</div>
						      		</div>
						      		<div class="row" style="margin-top: 5px;">
						      			<div class="form-group">
											<label class="col-md-4 control-label" style="color:#666;"><i class="fa fa-envelope-o" aria-hidden="true"></i> Applicant Email:</label>
											<div class="col-md-8"  style="margin-top: 10px;">
												<input type="email" class="form-control" placeholder="Enter Your Email Address" id="cust_email" name="cust_email"/>
											</div>
										</div>
						      		</div>
						      		<div class="row" style="margin-top: 10px;">
						      			<div class="form-group">
											<label class="col-md-4 control-label" style="color:#666;"><i class="fa fa-pencil" aria-hidden="true"></i> Grievance:</label>
											<div class="col-md-8"  style="margin-top: 10px;">
												<textarea class="form-control" rows="3" placeholder="Write Yourself..." id="grievance" name="grievance"></textarea>
											</div>
										</div>
						      		</div>
						      		<div class="row" style="margin-top: 10px;">
								    	<div class="form-group">
									        <label class="col-md-4 control-label" ><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-shield" style="color:#E4791A"></i>  Captcha Code </label>
										    <div class="col-sm-8 col-xs-8 " style="margin-top: 10px;">
											    <input class="form-control" type="text" name="txtCaptcha1" id="txtCaptcha1" required="" autocomplete="off" placeholder="Captcha" maxlength="6" onkeyup="this.value=this.value.toUpperCase()">
											</div>
										</div>
									</div>
									<div class="row" style="margin-top: 10px;">
								     	<p id="captImg3" align="right">
									      	<a href="javascript:void(0);" class="refreshCaptcha1" id="refreshCaptcha1" >
									    	<img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
									    </p>
								    </div>
						      		<div class="row" style="margin-top: 20px;">
						      			<div class="form-group" style="" >
											<button type="submit" class="btn btn-success btn-block" id="btndocumentUpload" name="btndocumentUpload" style="width: 90%;"><span class="glyphicon glyphicon-send" style=""></span> Submit</button>
										</div>
						      		</div>
						      	</form>	
				      		</div>
				      	</div>	
					</div>
				</div>
		    </div>
    	</div>
  	</div>
  	
  	
	<!--THIS MODAL IS FOR SIDEBAR CLICK TO OPEN A MODAL WITH DYNAMIC DATA-->
	<div id="modal_info" class="modal fade" role="dialog">
  		<div class="modal-dialog" style="width:80%;">
	    <!-- Modal content-->
		    <div class="modal-content">
		    	<div class="modal-header" style="background-color: #0d367e;"><h4 class="modal-title" id="link_header" style="color: #fff;"></h4>
		        	<button type="button" class="close" data-dismiss="modal" style="margin-left: 90%; margin-top: -3%; cursor: pointer; color: rgb(255, 255, 255); background: none repeat scroll 0% 0% transparent; font-weight: bold; opacity: 1;">&times;</button>
		        	
		      	</div>
		      	<div class="modal-body">
			      	<div class="container-fluid"  id="link_description" style="color:black; ;height:auto;">	
			      		
				    </div>
			    </div>
		    </div>
    	</div>
  	</div>
  	<!--THIS MODAL IS FOR SIDEBAR CLICK TO OPEN A MODAL WITH DYNAMIC DATA-->
</footer>

<script>
	
	function refresh_captcha1()
	{
	  $.get(base_url+'ajax_controller/refresh_captcha_feedback', function(data){
	   refresh = base_url + 'public/assets/images/refresh.png';
	   var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha1" onclick="refresh_captcha1()"  id="refreshCaptcha1" ><img src="'+refresh+'"/></a>';
	   $("#captImg3").html(data);
	   });
	}

	function viewContactDetails(){
		
	  	$('#contactModal').modal('show');//modal show
	  	
	}
	function viewSupportDetails(ins_code){
		
	  	$('#supportModal').modal('show');//modal show
			$.ajax({
			  url:base_url+"ajax_controller/create_captcha_feedback",
			  type:"post",
			  success:function(response){ 
			   refresh = base_url + 'public/assets/images/refresh.png';
			   var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha1" onclick="refresh_captcha1()"  id="refreshCaptcha1" ><img src="'+refresh+'"/></a>';
			   $("#captImg3").html(res); 
			  },
			  error:function(){
			   toastr.error("We are unable to Process.Please contact Support");
			  }
			});
			
			$.ajax({
			url:base_url+"ajax_controller/support_modal",
			type:"post",
			data:{'admcode':'abvv','ins_code':ins_code},
			success:function(response){ 
			//alert(response);
				var obj = JSON.parse(response);
				document.getElementById("mobileno").innerHTML = obj[0].contact_number;
				document.getElementById("email").innerHTML = obj[0].institute_email;
			},
			error:function(){
				alert("error");
			}
		});
	}
	institute_code = '<?php echo $inscode; ?>';
	viewQuickLink(institute_code);
	function viewQuickLink(institute_code){
	  	//$('#linkModal').modal('show');modal show
	  	$.ajax({
			url:base_url+"ajax_controller/quicklink_modal",
			type:"post",
			data:{'admcode':'abvv','ins_code':institute_code},
			success:function(response){ 
			//alert(response);
				var obj = JSON.parse(response);
				document.getElementById("ins_email").innerHTML = obj[0].institute_email;
				document.getElementById("ins_web_address").innerHTML = obj[0].website_address;
			
			},
			error:function(){
				alert("error");
			}
		});
	  	
	  	
	}
	$('#form_support').bootstrapValidator({
			message: 'This value is not valid',
		    
			submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{
				var cust_name = $('#cust_name').val();
				var cust_no=$('#cust_no').val();
				var cust_email=$('#cust_email').val();
				var grievance=$('#grievance').val();
				var txtCaptcha1=$('#txtCaptcha1').val();
				var ins_code=$('#hidInsCode').val();
				$.ajax({
					url:base_url+"ajax_controller/support_form_modal",
					type:"post",
					data:{'cust_name':cust_name,
					'cust_no':cust_no,
					'cust_email':cust_email,
					'txtCaptcha1':txtCaptcha1,
					'grievance':grievance,
					'ins_code':ins_code},
					success:function(response){ 
						var obj = JSON.parse(response);
						//alert(obj.status);
						if (obj.status==true){
							$('#supportModal').modal('hide');
							$('#form_support').data('bootstrapValidator').resetForm(true); //to reset the form
							toastr.success('Your grievance is successfully submitted');
							$('#error_mesg').hide();
						}
						if (obj.status==false){
							//$('#supportModal').modal('hide');
							$('#error_mesg').show();
							$('#form_support').data('bootstrapValidator').resetForm(true); //to reset the form
							$('#error_mesg').html(obj.msg);
							//toastr.success('Your grievance is successfully submitted');
						}
					},
					error:function(){
						alert("error");
					}
				});
			},
		    fields:
		    {
		        cust_name: {							//form input type name
		            validators: {
		                notEmpty: {
		                    message: 'Required'
		                }
		                
		            }
		        },
		        grievance: {							//form input type name
		            validators: {
		                notEmpty: {
		                    message: 'Required'
		                }
		            }
		        },
		        cust_no: {							//form input type name
		            validators: {
		                notEmpty: {
		                    message: 'Required'
		                },
		                integer: {
                        	message: 'The value is not a Number'
                    	},
                    	stringLength: {
                        min: 10,
                    	}
		            }
		        },
			    cust_email:  {
			   		validators: {
			   			notEmpty: {
		                    message: 'Required'
		                },
	                	emailAddress: {
	                    	message: 'The value is not a valid email address'
	                	}
                	}
			    },
			    txtCaptcha1: {
			   		validators: {
			   			notEmpty: {
		                    message: 'Required'
		                }
	                	
                	}
			    },
			}	
		});
		//side bar onclick to show modal
		function viewLatestInfo(x){
		  	$('#modal_info').modal('show');//modal show
		  	document.getElementById("link_description").innerHTML ='';
		  	$.ajax({
				url:base_url+"ajax_controller/latestinfo_modal",
				type:"post",
				data:{'info':x},
				success:function(response){ 
				//alert(response);
					var obj = JSON.parse(response);
					console.log(obj);
					document.getElementById("link_header").innerHTML = obj[0].link_name;
					if(obj[0].link_path =='#'){
						document.getElementById("link_description").innerHTML = obj[0].link_description;
					}else{
						document.getElementById("link_description").innerHTML = "<iframe src='"+base_url+obj[0].link_path+"' style='height: 500px; width: 100%;'></iframe>";
					}
					
					
				
				},
				error:function(){
					alert("error");
				}
			});
		  	
		  	
		}	
			
	
	function modalClose(){
		$('#form_support')[0].reset();
	}

	function fblogo(){
		
	  	 window.location.href= '#';
	  	
	}

	function twlogo(){
		
	  	 window.location.href= 'http://twitter.com/share';
	  	
	}

	function inlogo(){
		
	  	 window.location.href= 'http://linkedin.com/share';
	  	
	}

	function ytlogo(){
		
	  	 window.location.href= 'http://youtube.com/share';
	  	
	}

	function gmlogo(){
		
	  	 window.location.href= '#';
	  	
	}
	function adminlogo(ins_code){
		
	  	 window.location.href= base_url+'user/login/ins/'+ins_code;
	  	
	}
</script>



<!--<script id='chat-24-widget-code' type="text/javascript">
function chat24WidgetRun() {
window['cha'+'t2'+'4'+'ID'] = '7b6373c800896de894d3ab025e77c2e0';
window.domain = 'https://eadmission.cipet.gov.in';
var sc = document.createElement('script');
sc.type = 'text/javascript';
sc.async = true;
sc.src = window.domain + '/wp-content/themes/accesspress-parallax/js/widget.min.js';

var c = document['getElement'+'sByTagNa'+'me']('script')[0];
if ( c ) c['p'+'arent'+'Node']['inser'+'tB'+'efo'+'re'](sc, c);
else document['docu'+'me'+'ntEle'+'m'+'ent']['f'+'i'+'r'+'s'+'tChi'+'ld']['appe'+'nd'+'C'+'hild'](sc);
}
window.chat24WidgetCanRun = true;
if (window.chat24WidgetCanRun) {
    chat24WidgetRun();
}
</script>-->
