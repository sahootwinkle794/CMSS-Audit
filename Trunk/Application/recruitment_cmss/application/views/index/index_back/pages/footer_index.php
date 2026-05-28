
  <style>
  
  .link a {
    color: #fff;
  }
  .tooltip-toggle {
  cursor: pointer;
  position: relative;
}

.tooltip-toggle::before {
  position: absolute;
  top: -50px;
  left: -70px;
  background-color: #0b0000;
  border-radius: 5px;
  color: #fff;
  content: attr(data-tooltip);
  padding: 1rem;
  text-transform: none;
  -webkit-transition: all 0.5s ease;
  transition: all 0.5s ease;
  width: 160px;
}

.tooltip-toggle::after {
  position: absolute;
  top: -12px;
  left: 9px;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-top: 5px solid red;
  content: " ";
  font-size: 0;
  line-height: 0;
  margin-left: -5px;
  width: 0;
}

.tooltip-toggle::before,
.tooltip-toggle::after {
  color: #efefef;
  font-size: 16px;
  opacity: 0;
  pointer-events: none;
  text-align: center;
}

.tooltip-toggle:hover::before,
.tooltip-toggle:hover::after {
  opacity: 1;
  -webkit-transition: all 0.75s ease;
  transition: all 0.75s ease;
}
.btoon_1 {
    padding: 7px;
    width: 140px;
    background: #17a2b8;
    margin-left: -34px;
    margin-top: -38px;
    font-size: 17px;
    color: #fff;
    border: 1px solid #17a2b8;
}
.btoon_1:hover {
    background-color: #08717e;
	border-color: #08717e;
}
.icon
{
	color: #8D8C8A;
	position: absolute;
	top: 10px;
	left: 85%;
	
}
.label1{
	color: #000252;
	font-size: 17px;
	top: 3px;
}

.footer-logo {    
	/*background: #000;  */  
	padding: 7px 15px 0;    
	text-align: center;
}
.footer-logo li {    
	border-left: 1px solid #28282a;    
	display: inline-block;    
	padding: 0 10px;	
	margin-bottom:7px;    
	vertical-align: middle;	
	list-style:none;	 
	box-sizing:border-box; 
	-moz-box-sizing:border-box; 
	-webkit-box-sizing:border-box;
} 
.marque{
	height: 60px;
	width: 100%;
}
@media all and (max-width:640px)
{	
.sub-sites li, .sub-sites li:first-child
{padding:10px; border:1px solid #2c4a63;}	
.sub-sites{padding:15px 10px 5px;} } 
@media all and (max-width:567px)
{	
.footer-logo{overflow:hidden; padding:10px 5px 0;}	
.footer-logo li {
    width: 50%;
    border-left: none;
    padding: 0px;
    float: left;
    margin: 0;
    height: 60px;
}	
.marque{
	height: auto;
	width: 100%;
}
.footer-logo li:nth-child(2n+2){border-left:1px solid #28282a; } }

</style>
<?php 
	$logo = '';
	$inscode = '';
	$ins = '';
	$insname = '';
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
	$reg_user_id = $this->session->userdata('reg_user_id');
	
?>
<style>
	/*@import url("//www.mygov.in/sites/all/themes/mygov/css/front_style.css?ptg87j");*/
	.footer-wrapper .bottom-wrapper {
  background: #021323;
  padding: 0px;
  
}

.footer-wrapper #block-menu-menu-secondary-menu {
  padding: 20px 30px 15px 3%;
  float: right;
  width: 55%;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
}

.footer-wrapper .bottom-right #block-block-25 {
  background: #021323;
  padding: 0 30px 0 110px;
  background: url(../images/mygov_qr.png) no-repeat 0 1px;
  /*margin: 15px 0 0 40px;*/
}

.footer-wrapper .bottom-right #block-block-25 p {
  font-size: 12px;
}

.footer-wrapper .bottom-right #block-common-utils-developed-by-block {
  border-right: 1px solid #2b4071;
  float: left;
  width: 45%;
  margin: 10px 0;
}

.footer-wrapper .bottom-right #block-block-25 .content {
  padding: 0 30px 0 0;
  margin: 0 0 0 10px;
}

.footer-wrapper .bottom-right #block-block-25 .content a {
  margin-bottom: 5px;
  display: inline-block;
}

.footer-wrapper .bottom-right #block-block-25 .content span {
 
    display: block;
    font-size: 10px;
    color: #4E5B64;
    
    font-weight: 200;
    font-family: 'Lato', sans-serif;

}

.bottom-wrapper .footer-container {
  background: none !important;
  margin: 0 auto;
}

.footer-wrapper #block-menu-menu-secondary-menu ul.menu {
  display: inline-block;
  width: 100%;
}

.footer-wrapper #block-menu-menu-secondary-menu ul.menu li {
  color: #7f8080;
  font-size: 84%;
  float: left;
  list-style: outside none none;
  margin: 0;
  padding: 0 0 5px;
  width: 32.5%;
}

.footer-wrapper #block-menu-menu-secondary-menu ul.menu li:last-child:after {
  content: "";
}

.footer-wrapper #block-menu-menu-secondary-menu ul.menu li a {
    color: #3BA7CE;
    padding: 0 5px;
}

.footer-wrapper #block-menu-menu-secondary-menu ul.menu li a:hover {
  color: #fff;
}

.footer-container .footer_logo {
  padding-bottom: 40px;
  padding-left: 60px;
  padding-top: 20px;
  text-align: left;
  width: 591px;
}

.footer-container .footer_logo li {
  float: left;
  margin-right: 50px;
}

.ad_images a {
  width: 140px;
  height: 40px;
  display: inline-block;
  text-indent: -9999px;
  overflow: hidden;
  vertical-align: middle;
  margin-left: 10px;
  padding-right: 10px;
  border-right: 1px solid #28282a;
  margin: 0 0 15px 10px;
}

.ad_images a.di {
  background: url(../images/digital-india-logo.png) left top no-repeat;
  width: 115px;
  margin-left: 0px;
}

.ad_images a.npi {
  background: url(../images/india-gov-logo.png) left top no-repeat;
  width: 61px;
}

.ad_images a.data {
  background: url(../images/data-gov-logo.png) left top no-repeat;
}

.ad_images a.deity {
  background: url(../images/Deity-logo.png) left top no-repeat;
  width: 112px;
}

.ad_images a.pm {
  background: url(../images/pm-india-logo.png) left top no-repeat;
  width: 103px;
  border: none;
}

.ad_footer_block {
  text-align: center;
  position: relative;
  background: #192236;
  /* Old browsers */
  background: -moz-linear-gradient(top, #192236 0%, #111824 100%);
  /* FF3.6+ */
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #192236), color-stop(100%, #111824));
  /* Chrome,Safari4+ */
  background: -webkit-linear-gradient(top, #192236 0%, #111824 100%);
  /* Chrome10+,Safari5.1+ */
  background: -o-linear-gradient(top, #192236 0%, #111824 100%);
  /* Opera 11.10+ */
  background: -ms-linear-gradient(top, #192236 0%, #111824 100%);
  /* IE10+ */
  background: linear-gradient(to bottom, #192236 0%, #111824 100%);
  /* W3C */
}

.ad_footer_block:after {
  position: absolute;
  height: 1px;
  right: 0px;
  top: 0px;
  width: 100%;
  content: "";
  display: block;
  /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#576990+0,9095a0+100 */
  /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#062f3c+0,2d4b64+50,062f3c+100&amp;0.01+0,1+51,0.01+100 */
  background: -moz-linear-gradient(left, rgba(6, 47, 60, 0.01) 0%, rgba(45, 75, 100, 0.98) 50%, #2c4a63 51%, rgba(6, 47, 60, 0.01) 100%);
  /* FF3.6+ */
  background: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(6, 47, 60, 0.01)), color-stop(50%, rgba(45, 75, 100, 0.98)), color-stop(51%, #2c4a63), color-stop(100%, rgba(6, 47, 60, 0.01)));
  /* Chrome,Safari4+ */
  background: -webkit-linear-gradient(left, rgba(6, 47, 60, 0.01) 0%, rgba(45, 75, 100, 0.98) 50%, #2c4a63 51%, rgba(6, 47, 60, 0.01) 100%);
  /* Chrome10+,Safari5.1+ */
  background: -o-linear-gradient(left, rgba(6, 47, 60, 0.01) 0%, rgba(45, 75, 100, 0.98) 50%, #2c4a63 51%, rgba(6, 47, 60, 0.01) 100%);
  /* Opera 11.10+ */
  background: -ms-linear-gradient(left, rgba(6, 47, 60, 0.01) 0%, rgba(45, 75, 100, 0.98) 50%, #2c4a63 51%, rgba(6, 47, 60, 0.01) 100%);
  /* IE10+ */
  background: linear-gradient(to right, rgba(6, 47, 60, 0.01) 0%, rgba(45, 75, 100, 0.98) 50%, #2c4a63 51%, rgba(6, 47, 60, 0.01) 100%);
  /* W3C */
}

.ad_block_footer {
  padding: 11px 0;
}

.ad_block_footer a {
  display: inline-block;
  margin: 0 15px;
  text-indent: -99999px;
  margin-right: 14px;
  position: relative;
}

.ad_block_footer a:after {
  position: absolute;
  left: -15px;
  top: 0px;
  position: absolute;
  content: "";
  width: 1px;
  height: 100%;
  background: #606777;
  display: block;
}

.ad_block_footer br, .ad_images br {
  display: none;
}

.ad_block_footer a:first-child:after {
  display: none;
}

.ad_block_footer a.analytics {
  background: url(../images/my-gov-analytics.png) left top no-repeat;
  width: 82px;
  height: 25px;
}

.ad_block_footer a.sb {
  background: url(../images/swachh-bharat.png) left top no-repeat;
  width: 144px;
  height: 30px;
}

.ad_block_footer a.tm {
  background: url(../images/task-management.png) left top no-repeat;
  width: 126px;
  height: 25px;
}

.ad_block_footer a.eg {
  background: url(../images/e-greating.png) left top no-repeat;
  width: 73px;
  height: 27px;
}

.ad_block_footer a.news {
  background: url(../images/Newsletter-logo.png) left top no-repeat;
  width: 93px;
  height: 25px;
}

.ad_block_footer a.blog {
  background: url(../images/blog-logo.png) left top no-repeat;
  width: 76px;
  height: 25px;
}

.ad_block_footer a.inv {
  background: url(../images/innovation-logo.png) left top no-repeat;
  width: 93px;
  height: 25px;
}

.ad_block_footer a.transformingindia {
  background: url(../images/Transforming-india-logo.png) left top no-repeat;
  width: 129px;
  height: 25px;
}

.ad_block {
  -moz-binding: none !important;
}

.ad_footer_block p {
  color: #9ca1ae;
  
  text-align: center;
  position: relative;
}

.ad_images {
  text-align: center;
  padding: 14px 14px 0;
  background: #000;
}

.ad_img.server_info {
  position: relative;
  bottom: 10px;
  font-size: 10px;
  width: 115px;
  left: 0px;
  margin: 0 10px;
  width: 300px;
  display: block;
  color: #4E5B64;;
}

#node-86325 {
  display: none;
}

#block-mygov-gratification-user-badge {
  background: #1db5a7;
  /* Old browsers */
  background: -moz-linear-gradient(45deg, #1db5a7 1%, #259fbf 42%, #418dcc 100%);
  /* FF3.6-15 */
  background: -webkit-linear-gradient(45deg, #1db5a7 1%, #259fbf 42%, #418dcc 100%);
  /* Chrome10-25,Safari5.1-6 */
  background: linear-gradient(45deg, #1db5a7 1%, #259fbf 42%, #418dcc 100%);
  /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1db5a7', endColorstr='#418dcc',GradientType=1 );
  /* IE6-9 fallback on horizontal gradient */
  padding: 10px;
  margin-bottom: 7px;
}
#block-mygov-gratification-user-badge .badge-wrapper {
  width: 100%;
  display: inline-block;
  color: #fff;
}
#block-mygov-gratification-user-badge .user-badge {
  float: left;
  width: 70px;
  padding: 3px;
  margin-right: 20px;
  background-color: #fff;
  border-radius: 50%;
  position: relative;
}
#block-mygov-gratification-user-badge .user-badge:after {
  content: "";
  background: rgba(255, 255, 255, 0.3);
  height: 65px;
  position: absolute;
  left: 79px;
  width: 1px;
}
#block-mygov-gratification-user-badge .user-points {
  font-size: 1.643em;
  font-weight: 700;
}
#block-mygov-gratification-user-badge .user-badge-type {
  font-size: 0.929em;
  text-transform: uppercase;
}
.cont{
	color: #fff;padding-left:40px;font-size: 14px;
}
@media screen and (max-width: 900px) {
	.footer-wrapper .bottom-right #block-block-25 {

	    background: #021323;
	    padding: 0 30px 0 110px;
	    background: url(../images/mygov_qr.png) no-repeat 0 1px;
	    margin: 15px 0 0 -91px;

	}
}@media screen and (min-width: 700px) {
	.content {
    min-height: 100px;
    padding: 0px;
    }
}
@media screen and (max-width: 600px) {
		.footer-wrapper .bottom-right #block-block-25 {

	    background: #021323;
	    padding: 0 30px 0 110px;
	    background: url(../images/mygov_qr.png) no-repeat 0 1px;
	    margin: 6px 0 0 -127px;

	}
	.cont{
	color: #fff;padding-left:40px;font-size: 14px;padding-right: 30px;
}
	.left-mar {
   
    margin-left: -25px;
    }
	.footer-wrapper #block-menu-menu-secondary-menu {

    padding: 10px 20px 10px 0px;
    float: left;
    width: 140%;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    margin-left: -58px;
	}
	.footer-wrapper .bottom-right #block-common-utils-developed-by-block {

    border-right: 1px solid #2b4071;
    float: left;
    margin: 10px 0;
    text-align: justify;
	width: unset;
	}
}
</style>
<footer class=" footer-wrapper">
  <div class=" bottom-wrapper">
    <div class="container footer-container">
      <div class="bottom-right">
	  <div class="region region-footer-thirdcolumn">
	    <nav id="block-menu-menu-secondary-menu"
		class=" block-menu" 	role="navigation">
			<input type="hidden" id="baseURL" value="<?php echo base_url(); ?>"/>
	        <div class="content" >
			    <ul class="menu clearfix"><li class="first leaf"><a href="<?php echo base_url(); ?>" class="active">Home</a></li>
					<li class="leaf"><a href="#">Organisation</a></li>
					<li class="leaf"><a href="https://secure.mygov.in/feedback/">Feedback</a></li>
					
					<li class="leaf"><a href="#">FAQ</a></li>
					
					<li class="leaf"><a href="#">Link to us</a></li>
					<li class="leaf"><a href="#">Help</a></li>
					<li class="leaf"><a href="#">Website Policies</a></li>
					<li class="leaf"><a href="#">RTI</a></li>
					<li class="leaf"><a href="#">Contact Us</a></li>
					
			    </ul>  
			    
			    <div  class="cont"style="">
			    	<span style="font-size: 20px">Arunachal Pradesh Staff Selection Board </span>
			    	<br>
			    	e-mail: helpdesk-apssb(at)arn(dot)gov(dot)in
			    	<br>
			    	Phone: +91 94852 31286 , +91 60095 62429  , +91 3602291251(within working hours only) 
			    </div>
			    <ul class="ulfix" style="margin-left: 83%;margin-top: -152px;">
			    	<li class="leaf"><a title="Admin Login" alt="Admin Login"><img title="Admin Login" style="cursor: pointer;" alt="Admin Login" onclick="open_modal()" src="https://apssb.nic.in/public/assets/images/APSSB/APSSB.png"></a></li>
			    </ul>
			</div>
	</nav>
		<div id="block-common-utils-developed-by-block" class="block-common-utils">
		  <div class="content">
		    <div id="block-block-50" class="left-mar">
				<div class="content">
					<p><a href="http://ditc.arunachal.gov.in/" target="_blank" title="ITC AP Logo" ><img src="<?php echo base_url(); ?>upload/image/itc_logo.png" style="height: 55px" title="ITC AP Logo" alt="ITC AP Logo"></a><br /><br /><span style="color: #fff;">&copy; Content owned, updated and maintained by the Arunachal Pradesh Staff Selection Board, Govt. Of Arunachal Pradesh. Website is designed and developed by Dept of IT & Communication, Govt. Of Arunachal Pradesh  and hosted by NIC, A.P State Centre.</span></p>
				</div>
				
			</div> 
			</div>
		</div>
  </div>
	
      </div>
    </div>
  </div>
  <section style="background-size: 100% 100%; background-repeat: no-repeat;width: 100%">
	<div style="width:100%;">
		<div class="row" style="background-color: #000;border-top: 3px solid #0d1c43;"> 	
	 	<marquee direction="left" behavior="scroll" onmouseover="this.stop();" onmouseout="this.start();" class="marque" >	
			<div class="footer-logo">  
				<ul id="ul"> </ul>
					  
			</div> 
		</marquee>
		</div>
		<!--<div class="row" style="margin-top: -10px;background: #000;">
		<marquee direction="left" behavior="scroll" onmouseover="this.stop();" onmouseout="this.start();" style="height: 76px;">	
			<div class="footer-logo">    
				<ul id="ul2"><script>footer_logo(14,0,2)</script></ul>  
			</div>
		</marquee>
		</div>-->
		
	</div>	
</section>
  	<div class="modal fade" id="AdminloginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog"style="width:50%;">
			<div class="modal-content" >
				<div class="modal-header">
					<button type="button" class="close"  style="padding-left: 95%;" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h3 style="text-align: center;color: black;">Admin Login</h3>
				</div>
				<div class="modal-body" >
			        	
							<!-- /.login-logo -->
							<div class="login-box-body">
								<?php echo form_open(null, array('class'=>'loginForm', 'id'=>'frmApplyAdmin', 'name'=>'frmApplyAdmin' ,'enctype'=>"multipart/form-data")); ?>
							    	<input type="hidden" id="hidLogin" name="hidLogin">
									<input type="hidden" name="shapassword" id="shapassword"/>
							    	<!--<div class="group">      
								    	<input id="txtUsername" type="text" class="form-control" name="txtUsername" value="">
            							<label for="txtUsername" class="floating-label" style="float: left; color:#000000; font-size: 12px;">User ID</label>
								    </div>-->
								   
								    <div class="row fpad form-group" >
									    <div class="col-sm-4 col-xs-4">
									    	<label class="label1" for="txtUsername"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp; User ID  </label>
									    </div>
								        <div class="col-sm-8 col-xs-8">
								            <input class="form-control" type="text" autocomplete="off"  id="txtUsername" name="txtUsername"   onkeyup="this.value=this.value.toUpperCase()"  autocomplete="off"  data-placement="top" >
								      		<i class="fa fa-phone  icon"></i>
								      	</div>
									</div>
									
									<div class="row fpad form-group" >
									    <div class="col-sm-4 col-xs-4">
									    	<label class="label1" for="txtPassword"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp; Password  </label>
									    </div>
									    <div class="col-sm-8 col-xs-8">
								            <input class="form-control" type="password" autocomplete="off"  id="txtPassword" name="txtPassword"   autocomplete="off"  data-placement="top" >
								      		<span id="show_hide_admin" toggle="#password-field" class="fa fa-fw fa-eye field_icon icon toggle-password-admin" data-placement="top" data-toggle="tooltip" style="cursor: pointer" title="Show Password"></span> 
								      	</div>
								       
									</div>
									
									<div class="row fpad form-group" >
									    <div class="col-sm-4 col-xs-4">
									    	<label class="label1" for="txtCaptcha2"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp; Captcha  </label>
									    </div>
								        <div class="col-sm-8 col-xs-8">
								            <input class="form-control" type="text"  maxlength="6"  id="txtCaptcha2" name="txtCaptcha2" onkeyup="this.value=this.value.toUpperCase()"  autocomplete="off"  data-placement="top" >
								      		<i class="fa fa-shield icon"></i>	
								      	</div>
									</div>
									<div class="row" align="right" style="padding-top: 0px;"> 
							          
							        <p id="captImg2">
										<a href="javascript:void(0);" class="refreshCaptcha" id="refreshCaptcha" ><img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
									</p>
							        
							    	</div>
									
									<div class="row fpad">
									    <div class="col-sm-12 col-xs-6" align="center" >
								   	 		<button class="btoon_1" onClick="return do_submit()" style="width: 166px;" type="submit"   id="btnAdminlogin" name="btnAdminlogin"><i class="fa fa-user-plus"></i> Login</button>
							    		</div>
							    	</div>
									
							    
						 	</div>
					  		<!-- /.login-box-body -->
						

							
							
					</div>
				</div>
			</div>
		</div>

</footer>
<script src="<?php echo base_url(); ?>public/assets/js/md5_5034.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/profile_sha.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/sha512.js"></script>
<script>
	//alert("hello");
	
	$("body").on('click','.toggle-password-admin',function(){
	    $(this).toggleClass("fa-eye fa-eye-slash");

	    var input_type = document.getElementById('txtPassword');
		//alert(input);
	    if (input_type.type === "password") {
	        input_type.type="text";
	    } else {
	        input_type.type="password";
	    }
	});
	function open_modal(){
		refresh_captcha1();
		$('#frmApplyAdmin').data('bootstrapValidator').resetForm(true);
		$('#AdminloginModal').modal('show');
		$('#AdminloginModal').on('shown.bs.modal', function () 
		{ 
			$('#txtUsername').focus(); // Focusing the textbox
		})
		//$('#AdminloginModal').modal('show');
	}
	
	$(document).ready(function() {
	//alert("hello");
		var baseurl = "<?php echo base_url();?>";
		
		$.ajax({
			url:base_url+"ajax_controller/footer_logo",
			type:"post",
			data:'',
			success:function(response){  
				var output = '';
				var res1 = JSON.parse(response);
				//document.getElementById("hidCatElig").value = res1;
				$.each(res1.aaData,function(i,data){
					output +="<li><a title='"+data.logo_details+"' alt='"+data.logo_details+"' href='"+data.logo_url+"' target='_blank'><img title='"+data.logo_details+"' alt='"+data.logo_details+"' src='"+baseurl+"public/assets/images/footer_logo/"+data.logo_image+"'></a></li>";
				});
				$("#ul").html(output);
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	
		$("#txtUsername").focus();
		$.ajax({
			url:base_url+"ajax_controller/create_captcha",
			type:"post",
			success:function(response){ 
				var value = 'hello';
				refresh = base_url + 'public/assets/images/refresh.png';
				var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha" onclick="refresh_captcha()"  id="refreshCaptcha" ><img src="'+refresh+'"/></a>';
				$("#captImg2").html(res);	
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
		
		
		$('#frmApplyAdmin').bootstrapValidator({
		/*excluded: [':disabled'],*/
	       submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{
				document.getElementById('txtPassword').type="password";
				var formData = new FormData(document.getElementById("frmApplyAdmin"));
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
						
						if(result.status == true)
						{ 
							var page = base_url+""+result.index_page; 
							window.open(page,"_self");
							
						}
						else 
						{
							if(result.msg == 'Invalid Captcha. Please try again.')
							{ 
								toastr.error(result.msg);	
								$("#txtCaptcha2").val('');
								$('#frmApplyAdmin').data('bootstrapValidator').updateStatus('txtCaptcha2', 'NOT_VALIDATED', null).validateField('txtCaptcha2');
								refresh_captcha();
								$('.loadingRPimage').fadeIn(250);
							}
							else
							{ 
								toastr.error(result.msg);	
								$("#txtUsername").val('');
								$("#txtCaptcha2").val('');
								$("#txtPassword").val('');
								$('#frmApplyAdmin').data('bootstrapValidator').updateStatus('txtUsername', 'NOT_VALIDATED', null).validateField('txtUsername');
								$('#frmApplyAdmin').data('bootstrapValidator').updateStatus('txtCaptcha2', 'NOT_VALIDATED', null).validateField('txtCaptcha2');
								$('#frmApplyAdmin').data('bootstrapValidator').updateStatus('txtPassword', 'NOT_VALIDATED', null).validateField('txtPassword');
								refresh_captcha();
								$('.loadingRPimage').fadeIn(250);
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
				txtCaptcha2: {
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
		//alert("hello");		
		$.get(base_url+'ajax_controller/refresh_captcha', function(data){
			refresh = base_url + 'public/assets/images/refresh.png';
			var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha" onclick="refresh_captcha()"  id="refreshCaptcha" ><img src="'+refresh+'"/></a>';
			$("#captImg2").html(data);
			$("#txtCaptcha2").val("");
			
			$('#frmApplyAdmin').bootstrapValidator('updateStatus', 'txtCaptcha2', 'NOT_VALIDATED').bootstrapValidator('validateField', 'txtCaptcha2');
			/*$("#txtCaptcha2").val('');
			
	   		$('#frmApplyAdmin').bootstrapValidator('updateStatus', 'txtCaptcha2', 'NOT_VALIDATED').bootstrapValidator('validateField', 'txtCaptcha2');
	  */
	    });
	}
	function refresh_captcha1()
	{
		//alert("hello");		
		$.get(base_url+'ajax_controller/refresh_captcha', function(data){
			refresh = base_url + 'public/assets/images/refresh.png';
			var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha" onclick="refresh_captcha()"  id="refreshCaptcha" ><img src="'+refresh+'"/></a>';
			$("#captImg2").html(data);
			//$('#frmApply').bootstrapValidator('updateStatus', 'txtCaptcha2', 'NOT_VALIDATED').bootstrapValidator('validateField', 'txtCaptcha2');
			/*$("#txtCaptcha2").val('');
			
	   		$('#frmApplyAdmin').bootstrapValidator('updateStatus', 'txtCaptcha2', 'NOT_VALIDATED').bootstrapValidator('validateField', 'txtCaptcha2');
	  */
	    });
	}
	function do_submit()
	{
		md5KeyValue = "<?php echo $this->session->userdata('key');?>";
		
		if($("#txtUsername").val() == '')
		{
			$('#frmApplyAdmin').data('bootstrapValidator').updateStatus('txtUsername', 'NOT_VALIDATED', null).validateField('txtUsername');
			$('#frmApplyAdmin').data('bootstrapValidator').updateStatus('txtPassword', 'NOT_VALIDATED', null).validateField('txtPassword');
			$('#frmApplyAdmin').data('bootstrapValidator').updateStatus('txtCaptcha2', 'NOT_VALIDATED', null).validateField('txtCaptcha2');
			//toastr.error("Please enter username and password");
			$("#txtUsername").focus();
			return false;
		}
		if($("#txtPassword").val() == '')
		{
			$('#frmApplyAdmin').data('bootstrapValidator').updateStatus('txtUsername', 'NOT_VALIDATED', null).validateField('txtUsername');
			$('#frmApplyAdmin').data('bootstrapValidator').updateStatus('txtPassword', 'NOT_VALIDATED', null).validateField('txtPassword');
			$('#frmApplyAdmin').data('bootstrapValidator').updateStatus('txtCaptcha2', 'NOT_VALIDATED', null).validateField('txtCaptcha2');
			//toastr.error("Please enter username and password");
			$("#txtPassword").focus();
			return false;
		}
		if($("#txtCaptcha2").val() == '')
		{
			$('#frmApplyAdmin').data('bootstrapValidator').updateStatus('txtUsername', 'NOT_VALIDATED', null).validateField('txtUsername');
			$('#frmApplyAdmin').data('bootstrapValidator').updateStatus('txtPassword', 'NOT_VALIDATED', null).validateField('txtPassword');
			$('#frmApplyAdmin').data('bootstrapValidator').updateStatus('txtCaptcha2', 'NOT_VALIDATED', null).validateField('txtCaptcha2');
			//toastr.error("Please enter username and password");
			$("#txtCaptcha2").focus();
			return false;
		}
		//added for CR 5034 - begin.
		var username ="";
		username = document.frmApplyAdmin.txtUsername.value;	
		arr_user = username.split('@');
		username = arr_user[0];
		var password = document.frmApplyAdmin.txtPassword.value;
		var regexp = new RegExp("\\d{19}");

		/*alert(password);
		alert(username);*/
        //document.getElementById("btnCheck").disabled=true;
        var md5keystring = md5KeyValue;//document.quickLookForm.md5key.value ;
		//alert(md5keystring);
		var encSaltPass = encryptLoginPassword(md5keystring,username,password);
		var encSaltSHAPass = encryptSha2LoginPassword(md5keystring,username,password);
		//alert(encSaltSHAPass);
		//alert(encSaltSHAPass);
		document.frmApplyAdmin.txtPassword.value = encSaltPass; //changed
		document.frmApplyAdmin.shapassword.value = encSaltSHAPass; //changed
		//document.frmApplyAdmin.key.value = md5keystring; //changed
		//return false;
		//document.frmApplyAdmin.submit();
		var password ="";
		return true;
		
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
