
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
  margin: 15px 0 0 40px;
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
  top: -30px;
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
.content {
    min-height: 112px;
    }
	
</style>
<footer class=" footer-wrapper">
  <div class=" bottom-wrapper">
    <div class="container footer-container">
      <div class="bottom-right">
	  <div class="region region-footer-thirdcolumn">
	    <nav id="block-menu-menu-secondary-menu"
		class=" block-menu" 	role="navigation">

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
			</div>
	</nav>
<div id="block-common-utils-developed-by-block" class="block-common-utils">

    
  <div class="content">
    <div id="block-block-25">
				<div class="content">
					<p><a href="http://www.nic.in" target="_blank" title="NIC Logo" ><img src="https://www.mygov.in/sites/all/themes/mygov/images/nic_logo.png" title="NIC Logo" alt="NIC Logo"></a><span>&copy; Content owned, updated and maintained by the MyGov Cell. MyGov platform is designed, developed and hosted by National Informatics Centre, Ministry of Electronics & Information Technology, Government of India.</span></p>
				</div>
				<div class="ad_img server_info"> mygov-web-sp-82-29 - Last Updated: 21/06/19</div>

			</div>  </div>
</div>
  </div>
	
      </div>
    </div>
  </div>
  <div class="ad_footer_block">
      <div class="region region-footer">
    <div id="block-block-61" class=" block-block">

    
  <div class="content">
    <script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/footer_applicant.js"></script><div class="service-footer-wrapper"></div>
  </div>
</div>
  </div>
            
  </div>
  

</footer>
<script src="<?php echo base_url(); ?>public/assets/js/md5_5034.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/profile_sha.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/sha512.js"></script>



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
