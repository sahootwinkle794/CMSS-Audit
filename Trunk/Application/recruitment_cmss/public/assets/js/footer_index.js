(function() {
	var base_url = $("#baseURL").val();
	var reg_user_id = $("#reg_user_id").val();
// Localize jQuery variable
    var jQuery;

    /******** Load jQuery if not present *********/
    /*  Removed Version check  || window.jQuery.fn.jquery !== '1.10.1' */
    if (window.jQuery === undefined) {
        var script_tag = document.createElement('script');
        script_tag.setAttribute("type","text/javascript");
        script_tag.setAttribute("src",
            "https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js");
        if (script_tag.readyState) {
            script_tag.onreadystatechange = function () { // For old versions of IE
                if (this.readyState == 'complete' || this.readyState == 'loaded') {
                    scriptLoadHandler();
                }
            };
        } else {
            script_tag.onload = scriptLoadHandler;
        }
        // Try to find the head, otherwise default to the documentElement
        (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
    } else {
        // The jQuery version on the window is the one we want to use
        jQuery = window.jQuery;
        main();
    }

    /******** Called once jQuery has loaded ******/
    function scriptLoadHandler() {
        // Restore $ and window.jQuery to their previous values and store the
        // new jQuery in our local jQuery variable
        jQuery = window.jQuery.noConflict(true);
        // Call our main function
        main();
    }

    /******** Our main function ********/
    function main() {
        jQuery(document).ready(function($) {
            var htmldata_admin = '<style type="text/css">.sub-sites{text-align:center; position:relative; padding:10px 15px 0;}.sub-sites li{padding:0 10px; border-left:1px solid #6b6c6f; display:inline-block;  margin-bottom:10px; list-style:none;} .sub-sites li:first-child,.footer-logo li:first-child{border:none;}.sub-sites:after {    background: rgba(0, 0, 0, 0) linear-gradient(to right, rgba(6, 47, 60, 0.01) 0%, rgba(45, 75, 100, 0.98) 50%, #2c4a63 51%, rgba(6, 47, 60, 0.01) 100%) repeat scroll 0 0;    content: "";display: block;    height: 1px;    position: absolute;    right: 0;    top: 0;    width: 100%;}.footer-logo {    background: #000;    padding: 7px 15px 0;    text-align: center;}.footer-logo li {    border-left: 1px solid #28282a;    display: inline-block;    padding: 0 10px;	margin-bottom:7px;    vertical-align: middle;	list-style:none;	 box-sizing:border-box; -moz-box-sizing:border-box; -webkit-box-sizing:border-box;} @media all and (max-width:640px){	.sub-sites li, .sub-sites li:first-child{padding:10px; border:1px solid #2c4a63;}	.sub-sites{padding:15px 10px 5px;} } @media all and (max-width:567px){	.footer-logo{overflow:hidden; padding:10px 5px 0;}	.footer-logo li{width:50%; border-left:none; padding:0px; float:left; margin:10px 0;}	.footer-logo li:nth-child(2n+2){border-left:1px solid #28282a; } }</style><div class="service-footer-wrapper">  <ul class="sub-sites">    <li><a title="Transforming India" alt="Transforming India" href="https://transformingindia.mygov.in" target="_blank"><img title="Transforming India" alt="Transforming India" src="'+base_url+'public/assets/images/footer_logo/Transforming-india-logo.png"></a></li><li><a title="MyGov Innovate" alt="MyGov Innovate" href="https://innovate.mygov.in" target="_blank"><img title="MyGov Innovate" alt="MyGov Innovate" src="'+base_url+'public/assets/images/footer_logo/innovation-logo.png"></a></li><li><a title="Swachhbharat" alt="Swachhbharat" href="https://swachhbharat.mygov.in/" target="_blank"><img title="Swachhbharat" alt="Swachhbharat" src="'+base_url+'public/assets/images/footer_logo/swachh-bharat.png"></a></li><li><a title="MyGov Quiz" alt="MyGov Quiz" href="https://quiz.mygov.in" target="_blank"><img title="MyGov Quiz" alt="MyGov Quiz" src="'+base_url+'public/assets/images/footer_logo/mygov_quiz.png"></a></li><li><a title="MyGov Blog" alt="MyGov Blog" href="https://blog.mygov.in" target="_blank"><img alt="" src="'+base_url+'public/assets/images/footer_logo/blog-logo.png"></a></li><li><a title="Self4Society" alt="Self4Society" href="https://self4society.mygov.in" target="_blank"><img alt="Self4Society Logo" src="'+base_url+'public/assets/images/footer_logo/itowe-logo.png"></a></li><li><a title="E-Greetings" alt="E-Greetings" href="https://egreetings.gov.in" target="_blank"><img title="E-Greetings" alt="E-Greetings" src="'+base_url+'public/assets/images/footer_logo/e-greating.png"></a></li><li><a title="Admin Login" alt="Admin Login"><img title="Admin Login" style="cursor: pointer;" alt="Admin Login" onclick="open_modal()" src="'+base_url+'public/assets/images/APSSB/APSSB.png"></a></li></ul>  <div class="footer-logo">    <ul>      <li><a target="_blank" href="http://www.digitalindia.gov.in"><img title="Digital India (External Site that opens in a new window)" alt="Digital India" src="'+base_url+'public/assets/images/footer_logo/digital-india-logo.png"></a></li>      <li><a target="_blank" href="http://data.gov.in"><img title="Data Portal (External Site that opens in a new window)" alt="Data Portal" src="'+base_url+'public/assets/images/footer_logo/data-gov-logo.png"></a></li>      <li><a target="_blank" href="https://india.gov.in"><img title="National Portal of India (External Site that opens in a new window)" alt="National Portal of India" src="'+base_url+'public/assets/images/footer_logo/india-gov-logo.png"></a></li>      <li><a target="_blank" href="https://www.mygov.in"><img title="MyGov (External Site that opens in a new window)" alt="MyGov" src="'+base_url+'public/assets/images/footer_logo/mygov-footer-logo.png"></a></li>      <li><a title="MeitY (External Site that opens in a new window)" alt="MeitY" target="_blank" href="http://meity.gov.in/"><img title="Meity(External Site that opens in a new window)" alt="Meity" src="'+base_url+'public/assets/images/footer_logo/Meity_logo.png"></a></li>      <li><a target="_blank" href="http://pmindia.gov.in"><img title="PMINDIA(External Site that opens in a new window)" alt="PMINDIA" src="'+base_url+'public/assets/images/footer_logo/pm-india-logo.png"></a></li></ul>  </div></div>';
             var htmldata = '<style type="text/css">.sub-sites{text-align:center; position:relative; padding:10px 15px 0;}.sub-sites li{padding:0 10px; border-left:1px solid #6b6c6f; display:inline-block;  margin-bottom:10px; list-style:none;} .sub-sites li:first-child,.footer-logo li:first-child{border:none;}.sub-sites:after {    background: rgba(0, 0, 0, 0) linear-gradient(to right, rgba(6, 47, 60, 0.01) 0%, rgba(45, 75, 100, 0.98) 50%, #2c4a63 51%, rgba(6, 47, 60, 0.01) 100%) repeat scroll 0 0;    content: "";display: block;    height: 1px;    position: absolute;    right: 0;    top: 0;    width: 100%;}.footer-logo {    background: #000;    padding: 7px 15px 0;    text-align: center;}.footer-logo li {    border-left: 1px solid #28282a;    display: inline-block;    padding: 0 10px;	margin-bottom:7px;    vertical-align: middle;	list-style:none;	 box-sizing:border-box; -moz-box-sizing:border-box; -webkit-box-sizing:border-box;} @media all and (max-width:640px){	.sub-sites li, .sub-sites li:first-child{padding:10px; border:1px solid #2c4a63;}	.sub-sites{padding:15px 10px 5px;} } @media all and (max-width:567px){	.footer-logo{overflow:hidden; padding:10px 5px 0;}	.footer-logo li{width:50%; border-left:none; padding:0px; float:left; margin:10px 0;}	.footer-logo li:nth-child(2n+2){border-left:1px solid #28282a; } }</style><div class="service-footer-wrapper">  <ul class="sub-sites">    <li><a title="Transforming India" alt="Transforming India" href="https://transformingindia.mygov.in" target="_blank"><img title="Transforming India" alt="Transforming India" src="'+base_url+'public/assets/images/footer_logo/Transforming-india-logo.png"></a></li><li><a title="MyGov Innovate" alt="MyGov Innovate" href="https://innovate.mygov.in" target="_blank"><img title="MyGov Innovate" alt="MyGov Innovate" src="'+base_url+'public/assets/images/footer_logo/innovation-logo.png"></a></li><li><a title="Swachhbharat" alt="Swachhbharat" href="https://swachhbharat.mygov.in/" target="_blank"><img title="Swachhbharat" alt="Swachhbharat" src="'+base_url+'public/assets/images/footer_logo/swachh-bharat.png"></a></li><li><a title="MyGov Quiz" alt="MyGov Quiz" href="https://quiz.mygov.in" target="_blank"><img title="MyGov Quiz" alt="MyGov Quiz" src="'+base_url+'public/assets/images/footer_logo/mygov_quiz.png"></a></li><li><a title="MyGov Blog" alt="MyGov Blog" href="https://blog.mygov.in" target="_blank"><img alt="" src="'+base_url+'public/assets/images/footer_logo/blog-logo.png"></a></li><li><a title="Self4Society" alt="Self4Society" href="https://self4society.mygov.in" target="_blank"><img alt="Self4Society Logo" src="'+base_url+'public/assets/images/footer_logo/itowe-logo.png"></a></li><li><a title="E-Greetings" alt="E-Greetings" href="https://egreetings.gov.in" target="_blank"><img title="E-Greetings" alt="E-Greetings" src="'+base_url+'public/assets/images/footer_logo/e-greating.png"></a></li></ul>  <div class="footer-logo">    <ul>      <li><a target="_blank" href="http://www.digitalindia.gov.in"><img title="Digital India (External Site that opens in a new window)" alt="Digital India" src="'+base_url+'public/assets/images/footer_logo/digital-india-logo.png"></a></li>      <li><a target="_blank" href="http://data.gov.in"><img title="Data Portal (External Site that opens in a new window)" alt="Data Portal" src="'+base_url+'public/assets/images/footer_logo/data-gov-logo.png"></a></li>      <li><a target="_blank" href="https://india.gov.in"><img title="National Portal of India (External Site that opens in a new window)" alt="National Portal of India" src="'+base_url+'public/assets/images/footer_logo/india-gov-logo.png"></a></li>      <li><a target="_blank" href="https://www.mygov.in"><img title="MyGov (External Site that opens in a new window)" alt="MyGov" src="'+base_url+'public/assets/images/footer_logo/mygov-footer-logo.png"></a></li>      <li><a title="MeitY (External Site that opens in a new window)" alt="MeitY" target="_blank" href="http://meity.gov.in/"><img title="Meity(External Site that opens in a new window)" alt="Meity" src="'+base_url+'public/assets/images/footer_logo/Meity_logo.png"></a></li>      <li><a target="_blank" href="http://pmindia.gov.in"><img title="PMINDIA(External Site that opens in a new window)" alt="PMINDIA" src="'+base_url+'public/assets/images/footer_logo/pm-india-logo.png"></a></li></ul>  </div></div>';
           
            if(reg_user_id){
				$('.service-footer-wrapper').append(htmldata);
			}
			else{
				 $('.service-footer-wrapper').append(htmldata_admin);
			}
           
        });
    }

})(); // We call our anonymous function immediately