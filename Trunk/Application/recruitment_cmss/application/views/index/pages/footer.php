<style>
.link a {
    color: #fff;  
}
.center-text{
	text-align: center;
}
.footlg {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
    margin-top: 33px;
}
.footer-main{
	background: url(<?=base_url()?>upload/image/footer_bg.jpg);
}
.contact-details {
    width: 100%;
    display: inline-block;
    margin-top: -60px;
    margin-bottom: 55px;
}
.contact-details, .contact-details .detail-box {
    position: relative;
}
.contact-details:before,
.contact-details:after {
	/* content: ""; */
	position: absolute;
	border-bottom: 60px solid #0072b5; 
	top: 0;
}
.contact-details:before {
	border-left: 20px solid transparent;
	left: -20px;
}
.contact-details:after {
	border-right: 20px solid transparent;
	right: -20px;
}
.contact-details .detail-box {
	padding: 20px 6px 20px 70px;
	background-color: #00273e;
}
.contact-details .detail-box,
.contact-details .detail-box a { 
	color: #fff;
}
.contact-details .detail-box i {
	width: 56px;
	height: 61px;
	position: absolute;
	left: 0;
	line-height: 60px;
	background-color: #295201;
	text-align: center;
	border-bottom: 1px solid #2098df;
}
.contact-details .detail-box h4 { 
	font-size: 13px;
	margin: 0;
	font-weight: 900;
	text-transform: uppercase;
	letter-spacing: 1px;
	margin-bottom: 10px;
	color: #ffffff;
}
.contact-details .detail-box p { 
	font-size: 13px;
	margin-bottom: 0;
	line-height: 20px;
}
.contact-details .detail-box.phone-box {
    background-color: #064164;
}
.contact-details .detail-box.phone-box i {
	background-color: #295201;
	border-bottom-color: #fff;
}
.contact-details .detail-box.mail-box {
    background-color: #00273e;
}
.contact-details .detail-box.mail-box i {
	background-color: #295201;
}
.footer-logo {
	margin-top: 22px;
    float: left;
    width: 339px;
}
.footer-txt {
    color: #ebf8ff;
    text-align: justify;
    line-height: 25px;
}
.bottom-footer {
    background-color: #004974;
    padding: 15px 0;
    text-align: center;
}
.footer-implinks {
    margin-top: 50px;
}
.bottom-footer p {
    margin-bottom: 0;
    color: #f3f3f3;
    font-size: 12px;
    text-align: left;
}
.footer-implinks ul {
    margin-bottom: 0px;
    text-align: center;
    background: #001623;
    padding: 5px;
}
.footer-implinks ul li {
    display: inline-flex;
	border-right: 1px solid #f3f3f3;
}
.footer-implinks ul li a {
    color: #ffffff;
    padding: 0px 5px;
    font-size: 13px;
}
.footer-implinks ul li:last-child {
    border-right: none;
}
.footer-txt {
    color: #ebf8ff;
    text-align: justify;
}
.social{
	margin-top: -60px;
	float: left;
}
.social ul {
    margin-left: 0px;
    padding-left: 0px;
    padding-top: 20px;
}
.footer-main .widget {
	padding-right: 0px;
	padding-bottom: 0;
	color: #004974;
	background-color: transparent;
	margin-bottom: 0;
	border: none;
}
.footer-main .widget-about h3 {
	margin-bottom: 15px;
	margin-top: 0;
}
.footer-main .widget-about > p {
	margin-bottom: 0;
	line-height: 24px;
}
.footer-main .widget-about .time-schedule {
	padding-right: 45px;
	padding-top: 40px;
}
.footer-main .widget-about .time-schedule p { 
	padding-bottom: 10px;
	border-bottom: 1px solid #26292c;
	margin-bottom: 20px;
	line-height: 18px;
}
.footer-main .widget-about .time-schedule p span {  
	float: right;
}
.footer-main .widget-title {
	font-weight: bold;
	color: #ffffff;
	font-size: 14px;
	text-transform: uppercase;
	padding-bottom: 14px;
	position: relative;
	margin-bottom: 25px;
	margin-left: 0;
	margin-right: 0;
	background-color: transparent;
	border-bottom: none;
}
.footer-main .widget-title:before { 
	content: "";
	width: 20px;
	height: 2px;
	left: 0;
	bottom: 0;
	position: absolute;
	background-color: #33a9ee;
}
.footer-main .widget.widget-newsletter {
	padding-right: 0;
	margin-top: 0px;
}
.footer-main .widget-newsletter p {
	margin-bottom: 20px;
	line-height: 24px;
	color: #ffffff;
}
.footer-main .widget-newsletter .input-group {
	position: relative;
	padding-right: 80px;
	display: inline-block;
	width: 100%;
	margin-bottom: 34px;
}
.footer-main .widget-newsletter .input-group input {
	background-color: #1a1f22;
	border: 1px solid rgba(140,140,140,0.1);
	padding: 16px 15px;
	font-size: 13px;
	height: auto;
	border-radius: 0;
	width: 100%;
	box-shadow: none;
	line-height: 13px;
}
.footer-main .widget-newsletter .input-group span {
	position: absolute;
	right: 0;
	width: 70px;
	height: 50px;
	text-align: center;
	line-height: 50px;
}
.footer-main .widget-newsletter .input-group span button {
	height: 50px;
	width: 100%;
	background-color: #0f89d1;
	border-radius: 0;
	border: none;
	font-size: 25px;
	color: #fff;
}
.footer-main .widget-newsletter .social h6 {
	font-size: 11px;
	font-weight: bold;
	text-transform: uppercase;
	margin-top: 0;
	margin-bottom: 20px;
}
.footer-main .widget-newsletter .social li,
.footer-main .widget-newsletter .social li a {
	display: inline-block;
}
.footer-main .widget-newsletter .social li {
	margin: 0 5px;
}
.footer-main .widget-newsletter .social li:first-child {
	margin-left: 0;
}
.footer-main .widget-newsletter .social li a {
	width: 32px;
	height: 32px;
	border: 2px solid #9a9a9c;
	text-align: center;
	line-height: 28px;
	color: #b1b1b2;
	-webkit-transition: all 1s ease 0s;
    -moz-transition: all 1s ease 0s;
    -o-transition: all 1s ease 0s;
    transition: all 1s ease 0s;
}
.footer-main .widget-newsletter .social li a:hover { 
	background-color: #fff;
	color: #2d3741;
}

/* ************************
   02.7: Widget
   ********************* */
.widget:not(:last-child) {
  margin-bottom: 60px;
}

.widget ul:not(.social_icon_list) {
  padding: 0;
  margin: 0;
  list-style: none;
}

.widget ul:not(.social_icon_list) li a {
  position: relative;
}

.widget ul:not(.social_icon_list) li a:before {
  font-family: 'FontAwesome';
  content: "";
  margin-right: 10px;
}

.widget > ul {
  margin-top: -8px;
}

.widget .widget-logo,
.widget .widget-title {
  margin-bottom: 40px;
}

.widget .widget-title * {
  font-weight: 500;
  text-transform: uppercase;
}

.widget.widget_contact_info .single-info:not(:last-child) {
  margin-bottom: 15px;
}

.widget.widget_contact_info .single-info p {
  line-height: 1.5;
}

.widget.widget_contact_info .single-info p a {
  display: block;
}

.widget.widget_contact_info .single-info p a:not(:last-child):after {
  content: ',';
}

.widget.widget_recent_entries .single-post:not(:last-child), .widget.widget_related_post .single-post:not(:last-child) {
  padding-bottom: 30px;
  margin-bottom: 30px;
  border-bottom: 1px solid #e0e0e0;
}

.widget.widget_recent_entries .single-post .post-image, .widget.widget_related_post .single-post .post-image {
  margin-right: 20px;
}

.widget.widget_recent_entries .single-post .post-content h5, .widget.widget_related_post .single-post .post-content h5 {
  font-weight: 500;
  line-height: 1.5;
}

.widget.widget_newsletter .newsletter-content p {
  margin-top: -8px;
  margin-bottom: 25PX;
}

.widget.widget_flicker ul {
  margin-bottom: -15px;
  margin-right: -22px;
  max-width: 100%;
}

.widget.widget_flicker ul li {
  -webkit-box-flex: 0;
  -ms-flex: 0 0 33.33%;
  flex: 0 0 33.33%;
  max-width: 33.33%;
  width: 100%;
}

.widget.widget_flicker ul li a {
  padding: 0;
}

.widget.widget_flicker ul li a:before {
  display: none;
}

.widget.widget_related_post .single-post:not(:last-child) {
  padding-bottom: 20px;
  margin-bottom: 20px;
}

.widget.widget_tag_cloud .tagcloud {
  margin-right: -6px;
  margin-bottom: -15px;
}

.widget.widget_tag_cloud .tagcloud a {
  display: inline-block;
  padding: 8px 5px;
  border: 1px solid #e0e0e0;
  line-height: 1;
  margin-right: 2px;
  margin-bottom: 8px;
}

.widget.widget_search .input-group {
  position: relative;
  z-index: 1;
}

.widget.widget_search .input-group .theme-input-style {
  padding-right: 40px;
}

.widget.widget_search .input-group .submit-btn {
  position: absolute;
  right: 20px;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
  padding: 0;
}

.widget.widget_search .input-group .submit-btn:hover svg path {
  fill: #fb4275;
}
.footerlogo h3 {
    font-size: 30px;
    color: #004974;
    padding: 7px 0px;
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
/*@media (max-width: 1024px){
	.footer-logo {
	    width: 300px;
	}
	.loc {
	    margin-left: -20px;
	}
}*/
@media (min-width: 767px) and (max-width: 1024px){
	.footer-logo {
	    width: 300px;
	}
	.loc {
	    margin-left: -23px;
	}
}
@media (min-width: 551px) and (max-width: 766px){
	.contact-details {
	    width: 100%;
	    display: inline-block;
	    margin-top: -18px;
	    margin-bottom: 55px;
	}
	.footlg {
	    display: inline;
	}
	.footer-logo {
		width: 100%;
	    margin-top: -26px;
	    float: unset;
	    padding-bottom: 11px;
	}
}
@media (min-width: 416px) and (max-width: 550px){
	.contact-details {
	    width: 100%;
	    display: inline-block;
	    margin-top: -18px;
	    margin-bottom: 55px;
	}
	.footlg {
	    display: inline;
	}
	.footer-logo {
		width: 100%;
	    margin-top: -26px;
	    float: unset;
	    padding-bottom: 11px;
	}
}
@media (min-width: 377px) and (max-width: 415px){
	.footlg {
	    margin-top: 70px;
	}
	.boxwidth{
		width: 411px;
	}
	.footer-txt {
	    margin-top: -46px;
	}
	.footer-logo {
	    width: 100%;
	}
	.footer-main .widget {
	    margin-left: -10px;
	}
	/*.loc{
		margin-left: 25px;
	}*/
	.footsub{
		height: 133px;
	}
	.footsubb{
		height: 40px;
    	margin-top: -46px;
	}
}
@media (min-width: 200px) and (max-width: 376px){
	.footlg {
	    margin-top: 61px;
	}
	.boxwidth{
		width: 100%;
	}
	.footer-txt {
	    margin-top: -46px;
	}
	.footer-main .widget {
	    margin-left: -10px;
	}
	/*.loc {
	    padding: 7px;
    	margin-top: -20px;
	}*/
	.footsub{
		height: 133px;
	}
	.footsubb{
		height: 40px;
    	margin-top: -46px;
	}
}
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
</section>
<footer class="footer-main container-fluid no-padding">
	<!-- Container -->
	<div class="container">
		<!-- Contact Detail -->
		<div class="contact-details">
			<div class="row footlg">
			<div class="col-lg-4 col-md-4 col-sm-4 address-box detail-box boxwidth">
				<i><img src="<?=base_url()?>upload/image/ftr-location.png" alt="Loactaion" /></i>
				<h4>Contact Us</h4>
				<p>Pt. Uma Shankar Dikshit Marg, Teen Murti Road, Opp. Police Station, Chanakyapuri, New Delhi - 110 021</p>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 phone-box detail-box boxwidth">
				<i><img src="<?=base_url()?>upload/image/ftr-phone.png" alt="Phone" /></i>
				<h4>Call Us</h4>
				<p>Phone No: 011-21410905/6</p>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 mail-box detail-box boxwidth">
				<i><img src="<?=base_url()?>upload/image/ftr-email.png" alt="Email" /></i>
				<h4>Office Hours</h4>
				<p>Monday - Friday</p>
				<p>9:00 AM - 5:30 PM (IST)</p>
			</div>
			</div>
		</diV><!-- Contact Detail /- -->
		
		<div class="row">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<aside class="widget widget-about">
					<div class="footerlogo">
						<img src="<?php echo base_url()?>public/assets/images/logo1.png" alt="Logo"  class="footer-logo"/>
					</div>
					<div class="footer-txt">Central Medical Services Society (CMSS) has been established with the approval of Cabinet on 24.08.2011 as a Central Procurement Agency (CPA) to streamline drug procurement and distribution system...</div>
				</aside>
				<aside class="widget-newsletter">
					<div class="social">
						
						<ul>
							<li><a href="#" title="Facebook"><i class="fa fa-facebook"></i></a></li>	
							<li><a href="#" title="Twitter"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#" title="Google+"><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
				</aside>	
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<aside class="widget widget-links">
					<h3 class="widget-title ql">Quick Links</h3>
						                
				</aside>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<aside class="widget widget-newsletter">
					<h3 class="widget-title">Location Map</h3>
					<center>
						<p class="loc">
							<!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.8753688705187!2d77.19553656464345!3d28.60351548242924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce3856ac51127%3A0x254ae1e32715bf07!2sVishwa+Yuvak+Kendra!5e0!3m2!1sen!2sin!4v1565155586363!5m2!1sen!2sin" width="350" height="200" frameborder="0" style="border:0" allowfullscreen=""></iframe>-->
							<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d437.858485493533!2d77.195674!3d28.60374!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x65adc9968213a62f!2sCentral%20Medical%20Services%20Society!5e0!3m2!1sen!2sin!4v1643866575867!5m2!1sen!2sin" width="350" height="200" frameborder="0" style="border:0" allowfullscreen=""></iframe>
						</p>							
					</center>
					
				</aside>
			</div>
		</div>
		
	</div>
	<div class="footer-implinks">
		<ul><li id="menu-item-277" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-277"><a href="">Help</a></li>
<li id="menu-item-276" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-276"><a href="">Website Policies</a></li>
<li id="menu-item-275" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-275"><a href="">Terms &#038; Conditions</a></li>
<li id="menu-item-274" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-274"><a href="">Sitemap</a></li>
<li id="menu-item-355" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-355"><a href="">Disclaimer</a></li>
<li id="menu-item-356" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-356" style="cursor: pointer;"><a id="adminlogin">Login</a></li>
</ul>	</div>
	<div class="no-padding bottom-footer">
		<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-12 col-xs-12 footsub">
				<p>Website Content Managed by Central Medical Services Society. Website is designed, developed and hosted by National Informatics Centre( NIC )</p>
				<p>&copy; 2022 Central Medical Services Society. All Rights Reserved.</p>
				
			</div>
			<div class="col-md-3 col-sm-12 col-xs-12 footsubb">
			<p><strong>Last Updated on :</strong> 4 January 2022</p>
			<p><strong>Visitor :</strong> 1,401,984</p>
			</div>
		</div>
		</div>
	</div>
	</footer>
<!--<footer style=" padding:0; color:#fafafa;">   
	<section style="background:#151616">
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
			</div>-->
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
	  	<!--</div>
	</section>-->
	
  	<!--<div id="contactModal" class="modal fade" role="dialog">
  		<div class="modal-dialog" style="width:80%;">
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
			      		<div class="col-sm-4" style="background-color:height:100px;">
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
  	</div>-->
  	<!-- Modal for quick links -->
  	<!--<div id="linkModal" class="modal fade" role="dialog">
  		<div class="modal-dialog">
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
  	</div>-->
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
  	<!--<div id="supportModal" class="modal fade" role="dialog">
  		<div class="modal-dialog modal-lg" style="width:80%;">
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

								<!--<p style="font-size: 20px;color:#23bc36;"><i class="fa fa-envelope" aria-hidden="true"></i> Email Us: <span id="email" style="font-size: 20px;color:#666;">  </span></p>
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
    	</div>-->
  	<!--</div>-->
  	
  	
	<!--THIS MODAL IS FOR SIDEBAR CLICK TO OPEN A MODAL WITH DYNAMIC DATA-->
	<!--<div id="modal_info" class="modal fade" role="dialog">
  		<div class="modal-dialog" style="width:80%;">
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
  	</div>-->
  	<!--THIS MODAL IS FOR SIDEBAR CLICK TO OPEN A MODAL WITH DYNAMIC DATA-->
<!--</footer>-->

<script>
	
	$('#menu-item-356').click(function(){
		adminlogo('<?php echo $ins; ?>');
	})
	
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
