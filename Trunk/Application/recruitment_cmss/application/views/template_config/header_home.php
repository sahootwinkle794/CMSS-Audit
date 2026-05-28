 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="https://gov.silicontechlab.com/cmss_new/wp-content/themes/suppliers/favicon.png">
    <meta http-equiv="Content-Language" content="hi">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Online Recruitment Portal</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <!-- Bootstrap 3.3.7 -->
	  <!-- Bootstrap core CSS -->
	  <!--
	<link href="<?php echo base_url(); ?>public/assets/css/cabin.css" rel="stylesheet">-->
    <link href="<?php echo base_url(); ?>public/assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/css/AdminLTE.min.css">
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/animate.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/header.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/css/bootstrap-multiselect.css">
   	<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/font-awesome/css/font-awesome.min.css">
   	<link href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/css/bootstrapValidator.css" rel="stylesheet" type="text/css"/>
   	<!--<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/datepicker3.css">-->
   	<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/sweetalert/sweetalert.css"></link>
   	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.css" />
	<!-- Custom styles for this template -->
    <script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
    
	<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/bootstrap-datepicker.js" ></script>
	<!-- Sweet Alert Plugin -->
	<script src="<?php echo base_url(); ?>public/template_lib/plugins/sweetalert/sweetalert.min.js"></script>
    <link href="<?=base_url()?>public/assets/css/datepicker3.css" rel="stylesheet" />
    <!--<link href="<?=base_url()?>public/assets/css/rec_style.css" rel="stylesheet" />-->
    <script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrapValidator.js"></script>
    <script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-multiselect.js" type="text/javascript"></script>
    <!-- Toaster Plugin --> 
	<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.js"></script>
	<!--<script type="text/javascript" src="<?php echo base_url(); ?>public/js/interface.js"></script>-->
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<style>
	
	.news {
	    background-color: #fb511e !important;
	    height: 50px;
	    border-top-left-radius: 7px;
	    border-top-right-radius: 7px;
	}
	.top-head{
		padding-top: 180px;
	}
		@font-face {
	    font-family: myFirstFont;
	    src: url("upload/fonts/Montserrat/Montserrat-Regular.ttf");
	}

	body{
	    margin: 0px !important;
	    padding: 0px !important;
	    /*font-family: myFirstFont !important;*/
	}
	header {
	    background: #fff
	}
thead{
	font-weight: bold;
	text-align: center;
}
/*#header-scroll{

    width: 100%;
    float: left;
    margin: 0px;
    margin: 0px;
    padding: 0px;
    z-index: 5;
    position: fixed;
    height: 62px;
    border-bottom: 1px #7A0000 solid;
}
*/
.container-fluid {
    padding-right: 0px;
    padding-left: 0px;
    margin-right: 0px;
    margin-left: 0px;
}
.row {
    margin-right: 0px;
    margin-left: 0px;
}


  .anima{
  	transition: transform .2s;
  }
  .anima:hover {
  -ms-transform: scale(1.05); /* IE 9 */
  -webkit-transform: scale(1.05); /* Safari 3-8 */
  transform: scale(1.05); 
    }
    .btn-circle.btn-xl {
        width: 100px;
        height: 100px;
        padding: 10px 16px;
        font-size: 24px;
        line-height: 1.33;
        border-radius: 55px;
    }


ul.footer-link li {
    padding: 8px;
    border-bottom: 1px dashed #404040;
    color: #fff;
}
.twitter-feed li {
  font-size: 13px;
  margin-bottom: 15px;
  margin-top: 0px;
  padding-left: 30px;
}
.twitter-feed li.item {
  position: relative;
}
.twitter-feed li::after {
  content: "\f099";
  font-size: 24px;
  font-family: fontawesome;
  left: 0;
  position: absolute;
  top: 0;
}
.styled-icons li {
  margin-bottom: 0;
  padding-bottom: 0;
  float: left;
  padding: 5px;
}
.styled-icons li a {
  margin-bottom: 0;
}
.styled-icons.icon-dark a {
    background-color: #333333;
    color: #eeeeee;
    display: block;
    font-size: 18px;
    height: 36px;
    line-height: 36px;
    width: 36px;
}
.styled-icons.icon-dark a > i {
    padding-left: 10px;
}
/*Animated Fixed Header*/
.top-header{
    left: 0;
    top: 0;
    width: 100%;   
    background: linear-gradient( 180deg , #000000,#000000,#00000100);
    justify-content: center;
    animation-duration: 0.5s;
    transition: 0.5s;
    padding: 0px;
    color: #000;
   /* border: 1px solid #2098df;*/
    /*position: relative;*/  /*Delete this line to make the header scrollable*/

    li{
        padding: 0.5em 1em;
        color: #fff;
    }

    &.is-fixed{
        position: fixed;
        z-index: 100;
        animation-name: stickySlideDown;
        padding: 0;
        transition: none;
    }
}
.is-fixed .accessbar {
    display: none;
}
.is-fixed img.mainlogo {
    width: 360px !important;
}
.is-fixed .cmmsg{
	width: 162px !important;
}
.is-fixed{
        position: fixed;
        z-index: 100;
        animation-name: stickySlideDown;
        padding: 0;
        transition: none;
}
@keyframes stickySlideDown {
    0% {
        opacity: 0.7;
        transform: translateY(-100%);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.scrollheader {
    -webkit-box-shadow: 0 6px 2px -4px rgba(0, 0, 0, .1);
    -moz-box-shadow: 0 6px 2px -4px rgba(0, 0, 0, .1);
    box-shadow: 0 6px 2px -4px rgba(0, 0, 0, .1)
}

/*.top-header {
  
    padding: 0px;
    
    color: #000;
   
   background-color: #7A0000;
}*/

.top-left {
    float: left;
    padding: 0 0 0 20px;
    line-height: 22px;
}
.top-left a {
    line-height: 30px;
    background: url(../upload/image/grid_list_icon.png) no-repeat scroll -1px -312px;
    font-size: 13px;
    text-transform: uppercase;
    color: #333;
    display: inline-block;
    padding: 0 0 0 40px;
}
.top-header h1 {
    float: left;
    margin: 8px 0 0;
    font-size: 20px;
    font-weight: 600;
    padding-left: 100px;
}

.top-header h1 img {
    height: 100px;
    float: left;
    margin-right: 15px;
    margin-top: -8px;
    transition: all .4s
}

.top-header h1 small {
    display: block;
    font-size: 13px;
    font-weight: 600;
    margin-top: 5px
}

.topmenu {
    /*float: right;*/
    padding: 0px ;
}
.page-body{
	padding: 10px 40px 10px 40px; 
	/*background:#e7f9fd url(../upload/image/section_color.png);*/
	position: relative;
}
.anima:hover {
    -webkit-animation: shake 1s;
    animation: shake 1s;
  }
  

.announcement
{
	background: #e25c02; 
	width: 100%; 
	padding-left: 0px; 
	padding-right: 0px;
}


.font-size,
.theme {
    float: left;
    margin-right: 10px;
    position: relative;
    font-size: .9em
}

.accessbar a:hover{
    color: #cca300 !important;
}

.theme .media {
    margin-top: 1px
}

.theme .media a {
    border: 1px solid #fff;
    display: inline-block;
    height: 12px;
    width: 12px
}

.theme .media a.demo-theme-dark {
    background: #000
}
.theme .media a.demo-theme-light {
    background: #fff
}

.font-size a {
    display: inline-block;
    text-align: center;
    color: #fff;
    padding: 0 5px
}

.other-links {
    float: left
}

.other-links a {
    display: inline-block;
    color: #fff;
    font-size: 1em;
    font-weight: 500;
    padding: 0 10px;
    position: relative
}

.other-links a:after {
    content: '';
    position: absolute;
    width: 2px;
    height: 17px;
    background: #ccc;
    left: -2px;
    top: 2px
}

.box,
.container-3 {
    position: relative
}

.font-size a:hover {
    background-color: rgba(0, 0, 0, .07)
}

.font-size a:focus,
.font-size a:hover,
.other-links a:focus,
.other-links a:hover {
    color: #043f79
}

.box {
    margin: 10px 0 0;
    width: 350px;
    float: right
}
.mainlogo{
    margin-top: 9px;
}
.container-3 {
    width: 100%;
    vertical-align: middle;
    white-space: nowrap
}

.container-3 input#txtSearch {
    width: 100%;
    height: 36px;
    background: #fff;
    font-size: 14px;
    float: left;
    padding-left: 20px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 30px;
    color: #3a3a3a;
    border: 1px solid #b1b1b1
}

.container-3 input#txtSearch:hover {
    background-color: #f2fff9
}

.container-3 input#txtSearch:focus {
    outline: 0;
    background-color: #f2fff9
}

.box .container-3 a {
    position: absolute;
    right: 15px;
    top: 6px;
    color: #8c8c8c
}

.container-3 .icon {
    position: absolute;
    top: 50%;
    margin-left: 14px;
    margin-top: 6px;
    z-index: 1;
    color: #4f5b66;
    -webkit-transition: all .55s ease;
    -moz-transition: all .55s ease;
    -ms-transition: all .55s ease;
    -o-transition: all .55s ease;
    transition: all .55s ease;
    right: 18px
}

.container-3 input#search:active,
.container-3 input#search:focus {
    outline: 0
}

.container-3:hover .icon {
    margin-top: 6px;
    color: #93a2ad;
    -webkit-transform: scale(1.5);
    -moz-transform: scale(1.5);
    -ms-transform: scale(1.5);
    -o-transform: scale(1.5);
    transform: scale(1.5)
}

/*.menu-sec {
    background: linear-gradient(to bottom, #fff 39%, #e8e8e8 70%);
    background-image: linear-gradient(90deg, #ec8b08, #f2df9d,#ec8b08);
    position: absolute;
    top: 100px;
    left: 100px;
    z-index: 5;
    padding: 0px;
    border: 2px solid #ee7e2e;
    border-radius: 5px;
    box-shadow: 1px 3px 5px 0px grey;
}*/

.menu-sec {   
    z-index: 5;
    padding: 0px;   
    box-shadow: 1px 3px 5px 0px grey;
    background-color: #005eb5;
    margin-top: 0px;
}

.header-margin{
	padding: 0;
    /* margin: 75px 0px 0px 0px; */
    width: 100%;
    padding-left: 0px;
    padding-right: 0px;
}
.para-margin{
	padding-right: 5px;
    margin-right: 0;
    /*border-right:1px dashed #3e84ec;*/
    min-height: 300px;	
}
.panel-margin{
height: 474px;
margin-left: 10px;	
}
/*.navbar-default{
        float: right !important;
    }*/
.navbar-nav>li>a {
    padding-top: 0;
    padding-bottom: 0
}
.nav-tabs>li>a{
	margin-right: 0px;
    line-height: 1.42857143;
    /* border: 1px solid transparent; */
    border-radius: 0px 0px 0 0;
    color: #fff;
    text-align: left;
    text-transform: uppercase;
}
.nav>li>a:focus, .nav>li>a:hover {
    text-decoration: none;
    background-color: #ccc0;
}
.nav-tabs>li>a:hover {
    border-color: #eee0 #eee0 #ddd0;
}
.mainmenu {
    background-color: transparent;
    margin-bottom: 0;
    border: 0!important;
    /*float: right !important;*/
}

.navbar-nav>li:last-child>a {
    padding-right: 0;
    margin-right: 0
}

.dropdown-menu {
    padding: 0;
    margin: 0;
    border: 0 solid transition!important;
    border-radius: 0
}
/*.navbar-nav>li>{
    background-color: #7A0000 !important;
}*/

.mainmenu .collapse ul ul ul>li>a .caret,
.navbar-default .navbar-nav>li>a .caret {
    float: right;
    margin-top: 8px
}

.navbar-nav .open .dropdown-menu>li>a {
    padding: 16px 15px 16px 25px
}

.header_bottom {
    background: #0071ba
}

.header_area .header_bottom .mainmenu a,
.navbar-default .navbar-nav>li>a {
    color: #fff;
    font-size: 15px;
    text-transform: uppercase;
    padding: 12px 15px;
    /*font-weight: 600;*/
    /*border-right: 1px solid #ccc*/
}

.navbar-default .navbar-nav>li:last-child a {
    border-right: 0
}

.navbar-default .navbar-nav>li.active a {
    background: #4d0000;
    color: #dadada
}

.dropdown-menu>li.active,
.dropdown-menu>li>a:focus,
.dropdown-menu>li>a:hover {
    color: #262626!important;
    text-decoration: none;
    background-color: #e8e8e8!important
}

.dropdown-menu>li>a {
    border-bottom: 1px solid #e2e2e2;
    background: 0 0!important;
    color: #000!important
}

.header_area .mainmenu .active a,
.header_area .mainmenu .active a:focus,
.header_area .mainmenu .active a:hover,
.header_area .mainmenu li a:focus,
.header_area .mainmenu li a:hover,
.navbar-default .navbar-nav>.open>a,
.navbar-default .navbar-nav>.open>a:focus,
.navbar-default .navbar-nav>.open>a:hover {
    background: #eaeaea;
    outline: 0;
    border-color: #ccc
}

.openCloseSocial {
    display: none
}

.navbar-default .navbar-toggle {
    border-color: #fff
}

.navbar-default .navbar-toggle .icon-bar {
    background-color: #fff
}

.mainmenu .collapse ul>li:hover>a {
    background: #4d0000;
    color: #dadada
}

.mainmenu .collapse ul ul>li:hover>a,
.navbar-default .navbar-nav .open .dropdown-menu>li>a:focus,
.navbar-default .navbar-nav .open .dropdown-menu>li>a:hover {
    background-color: transparent;
    color: #000
}

.mainmenu .collapse ul ul ul>li:hover>a {
    background: #828282
}

.mainmenu .collapse ul ul,
.mainmenu .collapse ul ul.dropdown-menu {
    background: #fdfdfd;
    -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .27);
    -moz-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .27);
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .27)
}

.mainmenu .collapse ul ul ul,
.mainmenu .collapse ul ul ul ul,
.mainmenu .collapse ul ul ul ul.dropdown-menu,
.mainmenu .collapse ul ul ul.dropdown-menu {
    background: #dcdcdc
}

.mainmenu .collapse ul ul.dropdown-menu a {
    padding: 10px 20px
}

.mainmenu {
    background: 0 0;
    margin: 0;
    padding: 0;
    min-height: 20px
}
.footer-row {
    margin-right: 0px;
    margin-left: 0px;
}
.sidefixmenu {
    position: fixed;
    z-index: 999;
    top: 205px;
    right: 0;
    width: 75px
}

.sidefixmenu ul {
    margin: 0
}

.sidefixmenu ul li a {
    background: #3ab54a;
    margin-bottom: 3px;
    display: block;
    color: #fff;
    font-size: 11px;
    text-align: center;
    padding: 8px;
    line-height: 12px
}

.sidefixmenu ul li a span {
    display: block
}

.sidefixmenu ul li a:focus,
.sidefixmenu ul li a:hover {
    background: #22bd76
}

.sidefixmenu ul li a img {
    margin-bottom: 4px
}

.sidefixmenu ul li a:hover img {
    -webkit-filter: grayscale(100%);
    -moz-filter: grayscale(100%);
    -o-filter: grayscale(100%)
}



.buro{
	padding:0; 
	margin-left: 0; 
	background-image:url('../images/gb1.jpg'); 
	height:100%; 
}
.top-to-bottom {
    border-right-width: 2px;
    border-right-style: solid;
    -webkit-border-image: 
      -webkit-gradient(linear, 0 0, 0 100%, from(#fff705), to(rgba(0, 0, 0, 0))) 1 100%;
    -webkit-border-image: 
      -webkit-linear-gradient(#cecdc8, rgba(0, 0, 0, 0)) 1 100%;
    -moz-border-image:
      -moz-linear-gradient(#cecdc8, rgba(0, 0, 0, 0)) 1 100%;    
    -o-border-image:
      -o-linear-gradient(#cecdc8, rgba(0, 0, 0, 0)) 1 100%;
    border-image:
      linear-gradient(to bottom, #cecdc8, rgba(0, 0, 0, 0)) 1 100%;
}


@media only screen and (min-width:767px) {
    
    /*.mainlogo{
	    margin-top: 9px;
	}*/
    .anndisp{
        display: none;
    }
    .mainmenu .collapse ul li {
        position: relative
    }
    .mainmenu .collapse ul li:hover>ul {
        display: block
    }
    .mainmenu .collapse ul ul {
        position: absolute;
        top: 100%;
        left: 0;
        min-width: 250px;
        display: none
    }
    .mainmenu .collapse ul ul li {
        position: relative
    }
    .mainmenu .collapse ul ul li:hover>ul {
        display: block
    }
    .mainmenu .collapse ul ul ul {
        position: absolute;
        top: 0;
        left: 100%;
        min-width: 250px;
        display: none
    }
    .mainmenu .collapse ul ul ul li {
        position: relative
    }
    .mainmenu .collapse ul ul ul li:hover ul {
        display: block
    }
    .mainmenu .collapse ul ul ul ul {
        position: absolute;
        top: 0;
        left: -100%;
        min-width: 250px;
        display: none;
        z-index: 1
    }
    .mainmenu .collapse ul ul.dropdown-menu a {
        font-weight: 500
    }
}

@media screen and (max-width:1366px) {
    /*.navbar-default{
        float: left !important;
    }*/
    .mainmenu .collapse ul ul li {
        min-width: 240px
    }
    .mainmenu .collapse ul ul,
    .mainmenu .collapse ul ul.dropdown-menu {
        border: 1px solid #d8d8d8
    }
    .dropdown-menu>li>a {
        color: #000!important
    }
    .mainmenu .collapse ul>li:hover>a {
        color: #fff
    }
    .dropdown-menu>li.active,
    .dropdown-menu>li>a:focus,
    .dropdown-menu>li>a:hover {
        color: #490c07!important;
        font-weight: 500
    }
    .dropdown-menu li.active a {
        color: #000!important
    }
    .mainmenu .collapse ul ul.dropdown-menu a {
        padding: 8px 15px
    }
    .mainmenu .collapse ul li.vrticl-LI ul {
        min-width: 160px
    }
}

@media screen and (max-width:1152px) {
    .top-header {
        border-bottom: 0px solid #d8d8d8;
        padding: 10px
    }
    .top-header h1 img {
        height: 60px
    }
     .accessbar{
        display: none;
    }
    .header_area .header_bottom .mainmenu a,
    .navbar-default .navbar-nav>li>a {
        font-size: 13px;
        padding: 8px 12px;
    }
    .box {
        width: 255px;
        margin-top: 6px
    }
    .container-3 input#search {
        height: 32px
    }
    .font-size a,
    .other-links a {
        font-size: 13px
    }
    .sidefixmenu {
        top: 130px
    }
}

@media screen and (max-width:800px) {
       .top-header h1 img {
        height: 45px;
        margin-top: 0;
        margin-right: 0
    }
    .top-header {
        padding: 6px 0
    }
    .navbar-collapse {
        padding-right: 0;
        padding-left: 0;
        max-height: 400px
    }
    .font-size a,
    .other-links a {
        font-size: 12px;
        padding: 0 6px
    }
    .navbar-default .navbar-nav>li {
        margin-bottom: 2px
    }
    .header_area .header_bottom .mainmenu a,
    .navbar-default .navbar-nav>li>a {
        font-size: 15px;
        padding: 10px 8px;
        border: 1px solid #e4e4e4;
        color:#000;
    }
    .sidefixmenu {
        top: 110px
    }
    .navbar-toggle {
        padding: 5px;
        margin-top: 30px;
        background-color: #7A0000;
    }
    .navbar-toggle .icon-bar {
        background-color: #d6cac2
    }
    .mainmenu .collapse ul ul li {
        float: none;
        width: auto;
        margin: auto
    }
    .mainmenu .collapse ul>li:hover>a {
        color: #000;
        background: #f3f3f3
    }
    .header_area .mainmenu li a:focus,
    .header_area .mainmenu li a:hover,
    .navbar-default .navbar-nav>.open>a {
        color: #000;
        background: #dcdcdc;
        outline: 0
    }
    .header_area .mainmenu .active a,
    .header_area .mainmenu .active a:focus,
    .header_area .mainmenu .active a:hover,
    .navbar-default .navbar-nav>.open>a:focus,
    .navbar-default .navbar-nav>.open>a:hover {
        background: #f3f3f3;
        color: #000;
        border-bottom: 0
    }
    .navbar-default .navbar-nav>.active>a,
    .navbar-default .navbar-nav>.active>a:focus,
    .navbar-default .navbar-nav>.active>a:hover {
        color: #fff;
        background-color: #300607
    }
    .dropdown-menu>li:last-child a {
        border-bottom: 0
    }
    .mainmenu {
        min-height: 0
    }
    .mainmenu .collapse ul ul>li:hover>a,
    .navbar-default .navbar-nav .open .dropdown-menu>li>a:focus,
    .navbar-default .navbar-nav .open .dropdown-menu>li>a:hover {
        color: #300607!important
    }
    .menu-sec .navbar-default .navbar-nav .open .dropdown-menu>li>a {
        color: #444343
    }
    .dropdown-menu>li.active,
    .dropdown-menu>li>a:focus,
    .dropdown-menu>li>a:hover {
        font-weight: 400
    }
    .navbar-default .navbar-nav>li.active a {
        background: #300607
    }
    .navbar-default .navbar-nav>li:last-child a {
        border-right: 1px solid #e4e4e4
    }
    .mainmenu .collapse ul ul,
    .mainmenu .collapse ul ul.dropdown-menu {
        box-shadow: none;
        background: #f3f3f3;
        margin-bottom: 5px;
        padding: 0 10px 5px;
        border-top: 0
    }
    /*.top-header h1 img {
        height: 45px !important;
        margin-top: 0;
        margin-right: 0
    }
    .top-header {
        padding: 6px 0
    }
    .navbar-collapse {
        padding-right: 0;
        padding-left: 0;
        max-height: 400px
    }
    .font-size a,
    .other-links a {
        font-size: 12px;
        padding: 0 6px
    }
    .navbar-default .navbar-nav>li {
        margin-bottom: 2px
    }
    .header_area .header_bottom .mainmenu a,
    .navbar-default .navbar-nav>li>a {
        font-size: 15px;
        padding: 10px 8px;
        border: 1px solid #e4e4e4;
        color:#000;
    }
    .sidefixmenu {
        top: 110px
    }
    .navbar-toggle {
        padding: 5px;
        margin-top: 8px
    }
    .navbar-toggle .icon-bar {
        background-color: #d6cac2
    }
    .mainmenu .collapse ul ul li {
        float: none;
        width: auto;
        margin: auto
    }
    .mainmenu .collapse ul>li:hover>a {
        color: #000;
        background: #f3f3f3
    }
    .header_area .mainmenu li a:focus,
    .header_area .mainmenu li a:hover,
    .navbar-default .navbar-nav>.open>a {
        color: #000;
        background: #dcdcdc;
        outline: 0
    }
    .header_area .mainmenu .active a,
    .header_area .mainmenu .active a:focus,
    .header_area .mainmenu .active a:hover,
    .navbar-default .navbar-nav>.open>a:focus,
    .navbar-default .navbar-nav>.open>a:hover {
        background: #f3f3f3;
        color: #000;
        border-bottom: 0
    }
    .navbar-default .navbar-nav>.active>a,
    .navbar-default .navbar-nav>.active>a:focus,
    .navbar-default .navbar-nav>.active>a:hover {
        color: #fff;
        background-color: #043f79
    }
    .dropdown-menu>li:last-child a {
        border-bottom: 0
    }
    .mainmenu {
        min-height: 0
    }
    .mainmenu .collapse ul ul>li:hover>a,
    .navbar-default .navbar-nav .open .dropdown-menu>li>a:focus,
    .navbar-default .navbar-nav .open .dropdown-menu>li>a:hover {
        color: #043f79!important
    }
    .menu-sec .navbar-default .navbar-nav .open .dropdown-menu>li>a {
        color: #444343
    }
    .dropdown-menu>li.active,
    .dropdown-menu>li>a:focus,
    .dropdown-menu>li>a:hover {
        font-weight: 400
    }
    .navbar-default .navbar-nav>li.active a {
        background: #043f79
    }
    .navbar-default .navbar-nav>li:last-child a {
        border-right: 1px solid #e4e4e4
    }
    .mainmenu .collapse ul ul,
    .mainmenu .collapse ul ul.dropdown-menu {
        box-shadow: none;
        background: #f3f3f3;
        margin-bottom: 5px;
        padding: 0 10px 5px;
        border-top: 0
    }*/
}

@media screen and (max-width:750px) {
.col-disp
{
    padding-right: 0px!important; 
    padding-left: 0px!important; 
}
    .navbar-toggle {
        position: absolute;
        border-radius: 0;
        right: 0;
        top: 2px
    }
    .navbar-toggle:hover {
        background-color: #300607
    }
    .navbar-toggle:hover .icon-bar {
        background-color: #FFF
    }
/*.col-disp
{
    padding-right: 0px!important; 
    padding-left: 0px!important; 
}
    .navbar-toggle {
        position: absolute;
        border-radius: 0;
        right: 0;
        top: 2px
    }
    .navbar-toggle:hover {
        background-color: #043f79
    }
    .navbar-toggle:hover .icon-bar {
        background-color: #FFF
    }
    .page-body{
    padding: 0px; 
    /*background:#e7f9fd url(../upload/image/section_color.png);
    position: relative;
}*/
}

@media screen and (max-width:650px) {
   
    .top-header {
        border-bottom: none
    }
    .navbar-collapse {
        background-color: #fff
    }
    .menu-sec
    {
    background-image: linear-gradient(90deg, #ec8b08, #f2df9d,#ec8b08);
    position: initial;
    top: auto;
    left: auto;
    z-index: 5;
    padding: 0px;
    /*border: 2px solid #ee7e2e;*/
    border-radius: 5px;
    box-shadow: 1px 3px 5px 0px grey;
    }
    .header-margin{
    padding: 0;
    /* margin: 120px 0px 0px 0px; */
    width: 100%;
    padding-left: 0px;
    padding-right: 0px;
}
.para-margin{
    min-height: 0px;    
}
.panel-margin{
height: 490px;
margin-left: 0px;   
}
.panel-padding{
    padding-left: 45px;
}
    .menu-sec .navbar-nav {
        margin: 15px 17px
    }
    .navbar-collapse,
    .top-header {
        box-shadow: 0 2px 5px rgba(0, 0, 0, .2)
    }
    .top-header img {
        height: 38px
    }
    .top-header h1 {
    padding-left: 0px;
}
.page-body{
    padding: 0px; 
    /*background:#e7f9fd url(../upload/image/section_color.png);*/
    position: relative;
}
}

@media screen and (max-width:500px) {
    
    .header_area .header_bottom .mainmenu a,
    .navbar-default .navbar-nav>li>a {
        font-size: 13px
    }
    .top-header h1 {
        font-size: 14px;
        margin-top: 0;
        padding-left: 0px;

    }
    .mainmenu .collapse ul ul {
        min-width: inherit
    }
    .dropdown-menu>li.active {
        background-color: transparent!important
    }
    .dropdown-menu li.active a {
        color: #7c7c7c!important
    }
    .mainmenu li.dropdown.active.opne-menu .dropdown-menu {
        display: block;
        position: static;
        float: none
    }
    .page-body{
    padding: 0px; 
    /*background:#e7f9fd url(../upload/image/section_color.png);*/
    position: relative;
}
}
.head-button{
	background: linear-gradient(to right, #36a3c5 0%, #2ea1c4 100%);
	margin-top: 8px;
	width: auto;
	color: white;
	position: relative;
	text-align: center;
	height: 40px;
	padding-top: 10px;
	margin-left: -15px;
	cursor: pointer;
}
@media (min-width: 1024px) and (max-width: 1366px){
	.head-button{
		display: flex;
	}
	.user{
		width: 215px;
	}
}
@media screen and (max-width: 750px){
	
.navbar-toggle {
    position: absolute;
    border-radius: 0;
    right: 0;
    top: 15px;
}
}
.Modalwidth{
	width: 80%;
}
@media screen and (max-width: 750px){

.Modalwidth{
	width: 96%;
}

.fpad{
	padding-right: 0px !important;
    padding-left: 0px !important;
}
}
@media screen and (max-width: 500px){

.already{
	color: red;
	font-size: 15px;
	margin-left: 24% !important;
}
}
.npad{
	padding-right: 5px;
    padding-left: 5px;
} 
.already{
	color: red;
	font-size: 15px;
	margin-left: 5%;
}
.btoon_1 {
    padding: 7px;
    width: 140px;
    background: #17a2b8;
     margin-left: 0px !important;
    margin-top: -38px;
    font-size: 17px; 
    color: #fff;
    border: 1px solid #17a2b8;
}
.head-p{
	color: black;
}
	</style>
	
	  
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-118010124-1');
	</script>
	
	


	
	<script type="text/javascript">
		/* CODE FOR TOASTR */
		toastr.options = {
		  	"closeButton": true,
		  	"debug": false,
		  	"progressBar": false,
		  	"positionClass": "toast-bottom-right",//top-right,bottom-left,top-left,top-full-width,bottom-full-width,top-center,bottom-center
		 	"onclick": null,
		  	"showDuration": "300",
		  	"hideDuration": "2000",
		  	"timeOut": "3000",
		  	"extendedTimeOut": "2000",
		  	"showEasing": "swing",
		  	"hideEasing": "linear",
		  	"showMethod": "fadeIn",
		  	"hideMethod": "fadeOut"
		}
		
		base_url = "<?php echo base_url()?>"; 
	</script>
	
	
	<!-- End Facebook Pixel Code -->
	
	
  </head>
<?php 

	//$inscode1 = $this->session->set_userdata('ins_code', $institute);
	$logo = '';
	$inscode = '';
	$ins = '';
	$insname = '';
	$sub_menu = '';
	$child_menu = ''; 
	foreach($institute as $row){ 
		$inscode = $row['institute_code'];
		$ins =  encrypt_decrypt('encrypt', $inscode);
		$insname = $row['institute_name'];
		$logo = $row['image_url'];	
	}
	$cmbState = ' ';
	date_default_timezone_set('Asia/Kolkata'); 
	$date = date('Y-m-d', now());
	$date1 = date('d-m-Y', now());
	$now = date("Y-m-d H:i:s",now());
	if($this->session->flashdata('post_data')){
		$post_data = $this->session->flashdata('post_data');
		$txtCandidatePhone1 = $post_data['txtCandidatePhone1'];
		$txtdob1 = $post_data['txtdob1'];
		$txtFirstName = $post_data['txtFirstName'];
		$txtMiddleName = $post_data['txtMiddleName'];
		$txtLastName = $post_data['txtLastName'];
		$txtEmail = $post_data['txtEmail'];/*
		$cmbState = $post_data['cmbState'];*/
	}
	if($this->session->flashdata('post_data1')){
		$post_data = $this->session->flashdata('post_data');
		$txtCandidatePhone = $post_data['txtCandidatePhone'];
		$txtdob = $post_data['txtdob'];
	}
	
	$birth_start_date = '';
	$birth_end_date = '';
	foreach($eligibilityDate as $row){ 
		$birth_start_date = $row['birth_start_date'];
		$birth_end_date = $row['birth_end_date'];
	}
	//print_r($dateInfo);die();
	$program_start_date = '';
	$program_end_date = '';
	//print_r($dateInfo);return;
	
	foreach($dateInfo as $row){ 
		$program_start_date = $row['program_start_date'];
		$program_end_date = $row['program_end_date'];
	}
	//dynamic menu
	foreach($main_menu as $row)
	{
		
	}
	

?>
	<?php  if($this->session->userdata('reg_user_id')==''){ $href = base_url().'Index/institute_index/ins/'.$inscode; } else{ $href= '#'; }?>

<body>
	<!--<div class="loadingRPimage">
	    <img height="100px" src="<?=base_url()?>upload/image/loader/loading_2.gif"/>
	</div>-->
  	<section class="top-sec">
  	
  	<header class="top-header" id="fixed">
		<div id="header-full" style="background:url(upload/image/oshec_logo.png) no-repeat top right; width: 100%;">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding-right: 0px;">
					<?php  if($this->session->userdata('reg_user_id')==''){ ?>
					<div class="navbar-header">
						<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
					</div>
					 <?php } ?> 
					<div class="topmenu" >
						<div class="clearfix"></div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
						<div class=" col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
						<a href="<?=base_url()?>Apply/institute_page/ins/<?=$ins?>" > 
						<img class="mainlogo" src="<?php echo base_url()?>public/assets/images/logo1.png" data-rjs="2" alt="">
						<!--<img src = "<?php echo base_url()?>public/assets/images/CMSS.png" alt="APSSB Logo" class="mainlogo" style="max-width: 106%;height: 100px; width: auto; float: left;">-->						
						</a>
                         <span>
                                <!--<a href="<?=base_url()?>Apply/institute_page/ins/<?=$ins?>" >
                                <h3 style="font-weight:bold;font-size: 25px;">Central Medical Services Society</h3>
                                <h4 style="font-size: 12px;">An Autonomous Body under Ministry of Health & Family Welfare, Government of India</h4>
                            </a>-->
                        </span>
						
						</div>  
						<?php  if($this->session->userdata('reg_user_id')==''){ ?>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
							<img src = "<?php echo base_url()?>public/assets/images/apssb-web/right-logo.png" alt="APSSB Logo" class="mainlogo" style="height: auto;float: left;width: 85%;margin-top: 2px;">						
							
						</div>
						 <?php } ?> 
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="float: right; text-align: center !important;  padding-top: 5px; padding-bottom: 5px;border-radius: 0px 0px 0px 50px;">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<?php  if($this->session->userdata('reg_user_id')==''){ ?>
							<div class="hidden-xs col-sm-2 col-md-2 col-lg-2 col-xl-2">
								<!--<img src = "<?php echo base_url()?>public/assets/images/apssb-web/right-logo.png" alt="APSSB Logo" class="mainlogo" style="max-width: 100%;height: auto; width: auto; float: left;">						
								-->
							</div>  
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
								<a href="<?=base_url()?>Index/notice" >
								<img src = "<?php echo base_url()?>public/assets/images/apssb-web/Notices.png" alt="APSSB Logo" class="mainlogo" style="max-width: 100%;height: auto; width: auto; float: left;">						
								<p class="head-p">Notices</p></a>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
								<img src = "<?php echo base_url()?>public/assets/images/apssb-web/Apply_icon.png" alt="APSSB Logo" class="mainlogo" style="max-width: 100%;height: auto; width: auto; float: left;">						
								<p class="head-p">Apply</p>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
								<img id="imgAdmitCard" src = "<?php echo base_url()?>public/assets/images/apssb-web/Admit_Card.png" alt="APSSB Logo" class="mainlogo" style="cursor:pointer;max-width: 100%;height: auto; width: auto; float: left;">						
								<p class="head-p">Admit Card</p>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
								<a href="<?=base_url()?>Index/common_page/doc63528/Syllabus/ins/<?=$inscode?>" >
								<img src = "<?php echo base_url()?>public/assets/images/apssb-web/Answer_key_icon.png" alt="APSSB Logo" class="mainlogo" style="max-width: 100%;height: auto; width: auto; float: left;">						
								<p class="head-p">Syllabus</p></a>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
								<img src = "<?php echo base_url()?>public/assets/images/apssb-web/Result_new.png" alt="APSSB Logo" class="mainlogo" style="max-width: 100%;height: auto; width: auto; float: left;">						
								<p class="head-p">Result</p>
							</div>
							<?php } else { ?>
							<div class="hidden-xs col-sm-1 col-md-1 col-lg-1 col-xl-2">
								
							</div>
							<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3 col-xl-3">
								<a href="<?php echo base_url();?>apply/institute_page/ins/<?=$ins?>" >
								<div class ="head-button" >
							        <i class="fa fa-home" style="color: #FFF;font-size:20px;margin-left: 10px;"></i><label class="hidden-xs" style="font-weight: unset;padding-right: 10px;">&nbsp;&nbsp; Home </label>
							    </div>
							    </a>
							</div>  
							<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3 col-xl-3">
								<div class ="head-button" onclick="profile_view()">
							        <i class="fa fa-eye" style="color: #FFF;font-size:20px;margin-left: 10px;"></i><label class="hidden-xs" style="font-weight: unset;padding-right: 10px;">&nbsp;&nbsp; Profile </label>
							    </div>
							</div>  
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-5 col-xl-4">
								 <li style="list-style: none;" class="dropdown user user-menu">
							       
								        <a href="#" class="dropdown-toggle " data-toggle="dropdown" style="">
									        <div class ="head-button user">
									        <i class="fa fa-user" style="color: #FFF;font-size:20px;margin-left: 10px;"></i><label class="hidden-xs" style="font-weight: unset;"> &nbsp;&nbsp;<?php echo $this->session->userdata('full_name') ?> </label></div>
								        </a>
							        	<div class="dropdown-menu dropdown-menu-right animated flipInY " style="width: 250px;height: auto;box-shadow: 1px 4px 7px black;border-radius: 6px;">
			                                <ul  class="dropdown-user" style="text-align: center;padding-left: 0px;">
				                                <li style="list-style: none;"class="user-header">
									            	<img src="<?php echo base_url(); ?>public/photos/avatar-sign.png" class="img-circle" alt="user-image">
									            	<p><?php echo $this->session->userdata('full_name') ?></p>
									          	</li> 
									          
									          	<li style="list-style: none;"class="user-footer">
								              		<div style="text-align: center; " >
								              			<a href="<?php echo base_url();?>Index/applicant_logout/ins/<?=$inscode?>" class="btn btn-default btn-flat" style="background-color: #ea2f05; border-radius: 8px; color: #fff;">LOGOUT</a>
								            		</div>
									          	</li>
			                                </ul>
			                            </div>
							        </li>
							</div>
							
							<div class="hidden-xs col-sm-1 col-md-1 hidden-lg hidden-xl">
								
							</div>
							
							
					    <?php } ?>
						</div>
					</div>
						
				</div>
			</div>
		</div>
	</header>
	<?php  if($this->session->userdata('reg_user_id')==''){?>
	
			<div class="menu-sec">
		<div class="row">
			<nav class="navbar navbar-default  mainmenu"> 
				<div id="navbarCollapse" class="collapse navbar-collapse">
					<ul id="fresponsive" class="nav navbar-nav dropdown">
						<li class="<?php echo $menu_group=='Home'?'active':'' ?>"><a href="<?=base_url()?>Index/institute_home/ins/<?=$inscode?>" ><i class="fa fa-home"></i></a></li>
						<?php
						
	                    $i1=1;
	                    $sql = "SELECT menu_name,external_url, menu_url, status, menu_id, submenu_status, content_status, content_english 
	                    FROM dbtbl_dynamic_menu 
	                    WHERE status=1 AND delete_status=0 ORDER BY menu_id ASC";
	                    $result = $this->db->query($sql);
						$main_menu = $result->result_array();
	                    if (sizeof($main_menu) == 0){?>

                 <?php }else{

                  foreach($main_menu as $row){
                   	$mmenu_name = $row['menu_name'];
					$mexternalUrl_status = $row['external_url'];
					$mmenu_url = $row['menu_url'];
					$mstatus = $row['status'];
					$mmenu_id = $row['menu_id'];
					$msubmenu_status = $row['submenu_status'];
					$mcontent_status = $row['content_status'];
					$mcontent_english = $row['content_english'];
					$url= base_url().$mmenu_url;
          ?>
          
          <li class="dropdown vrticl-LI <?php echo $menu_group==$mmenu_name?'active':'' ?>" style="">
           <a href="<?php if($msubmenu_status == 1){ echo "#";}else{ if($mcontent_status == 0){ if($mexternalUrl_status == 1){ echo $url; }else{ echo $url;} }else{ echo $url; } } ?>" <?php if($msubmenu_status == 1){ ?> class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" <?php } ?> <?php if($mmenu_url == "index.php"){ ?> target="_blank" <?php } ?> ><?php echo $mmenu_name; ?><?php if($msubmenu_status == 1){ ?> <span class="caret"></span> <?php } ?></a>

            <?php
            $i2=1;
            $status2=1;
            $deleteStatus2=0;
            
            $sql = "SELECT submenu_name, external_url, submenu_url, status, fk_menu_id, submenu_id, childmenu_status, content_status, content_english
            		FROM dbtbl_dynamic_submenu WHERE fk_menu_id = $mmenu_id AND status = $status2 AND delete_status = $deleteStatus2
            		ORDER BY submenu_id";
			$result = $this->db->query($sql);
			$output_data_submenu = $result->result_array();
			foreach ($output_data_submenu as $row2) 
            {
            	
            }
            //print_r($output_data_submenu);return;
            if (sizeof($output_data_submenu) == 0){ ?>
               <?php }else{ ?>
              <ul class="dropdown-menu" >
               <?php foreach($output_data_submenu as $row3){ 
               		$smsubmenu_name = $row3['submenu_name'];
					$smexternaUrl_status = $row3['external_url'];
					$smsubmenu_url = $row3['submenu_url'];
					$smstatus = $row3['status'];
					$smfk_menu_id = $row3['fk_menu_id'];
					$smsubmenu_id = $row3['submenu_id']; 
					$smchildmenu_status = $row3['childmenu_status'];
					$smcontent_status = $row3['content_status'];
					$smcontent_english = $row3['content_english'];
					$url= base_url().$smsubmenu_url;
					?>
					
            <li class="<?php if($smchildmenu_status == 1){ ?> dropdown dropdown-submenu <?php } ?> <?php echo $sub_menu==$smsubmenu_name?'active':'' ?>" >
               <a href="<?php echo $url; ?>"><?php echo $smsubmenu_name; ?></a>
            </li> 
 
                  
              <?php $i2++ ;} ?> </ul> <?php } ?>
             
        </li>
 
          <?php $i1++ ;} } ?>
                                
					</ul>
				</div>
			</nav>
		</div>
	
	</div>
	<?php } ?>
		
 	</section>
 	<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" >
		<div class="modal-dialog Modalwidth">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close " style="font-size: 37px;position: unset"  data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h3 style="text-align: center;color: black;">Registration Form</h3>
				</div>
				<div class="modal-body">
					
				 	<input type="hidden" id="birthStartDate" value="<?php echo $birth_start_date; ?>"/>
				 	<input type="hidden" id="birthEndDate" value="<?php echo $birth_end_date; ?>"/>
				    
				 		<?php 
				 		/*echo $program_start_date;
				 		echo $program_end_date;
				 		echo $date1;*/
				 		//die();
				 		if(date('Y-m-d',strtotime($program_start_date)) <= date('Y-m-d',strtotime($date1)) && date('Y-m-d',strtotime($program_end_date)) >= date('Y-m-d',strtotime($date1))){ ?>
					    	
					   
						    <form class=" login-box-body fpad" action="" method="post"  id="frmApplyNew" name="frmApplyNew" >
						    	<!--<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;"> 
									<div id="alertmessage"></div>
								</div>-->

						  <!-- <?php $attr=array('class'=> 'login-box-body');echo form_open('?p=registration',$attr); ?> --> 
				 				<input type="hidden" id="insCode" name="insCode" value="<?php echo $inscode; ?>"/>
				 				<input type="hidden" id="btnRegister1" name="btnRegister1" value="Registration"/>
						    	
						    	<div class="row col-sm-12 col-xs-12 fpad">
						    		<div class="col-sm-12 col-xs-12 col-md-12 col-lg-6 npad form-group">
								    	<div class="col-sm-4 col-xs-12 npad">
									         <label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;First Name</label>
									     </div>
									     <div class="col-sm-8 col-xs-12 npad" >
									      <input class="form-control"  type="text" name="txtFirstName" id="txtFirstName" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()" maxlength="50" required="" placeholder="First Name" value="<?=isset($txtFirstName)?$txtFirstName:''?>">
									      <i class="fa  fa-user icon"></i>
									    </div>
									</div>
									<div class="col-sm-12 col-xs-12 col-md-12 col-lg-6 npad form-group">
								    	<div class="col-sm-4 col-xs-12 npad">
										 <label class="label1" > Middle Name</label> 
					                    </div>
					                    <div class="col-sm-8 col-xs-12 npad" >
											<input class="form-control" type="text"  name="txtMiddleName" id="txtMiddleName" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()" maxlength="50"  placeholder="Middle Name" value="<?=isset($txtMiddleName)?$txtMiddleName:''?>">
											<i class="fa fa-user icon"></i>
										</div>
									</div>
								</div>
								<div class="row col-sm-12 col-xs-12 fpad">
						    		<div class="col-sm-12 col-xs-12 col-md-12 col-lg-6 npad form-group">
								    	<div class="col-sm-4 col-xs-12 npad">   
										  <label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;Last Name</label>
										 </div>
										 <div class="col-sm-8 col-xs-12 npad">
										 	<input class="form-control" type="text" id="txtLastName" name="txtLastName" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()" maxlength="50" required="" placeholder="Last Name" value="<?=isset($txtLastName)?$txtLastName:''?>">
										    <i class="fa fa-user icon"></i> 
										         (If No last name , Enter First Name)
										</div>
									</div>
									<div class="col-sm-12 col-xs-12 col-md-12 col-lg-6 npad form-group">
								    	<div class="col-sm-4 col-xs-12 npad">   
									      <label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;Date of Birth </label>
									     </div>
									     <div class="col-sm-8 col-xs-12 npad">   
									      <input class="form-control" type="text" name="txtdob1" id="txtdob1" autocomplete="off" placeholder="Date Of Birth" value="<?=isset($txtdob1)?$txtdob1:''?>" data-placement="left" data-toggle="tooltip" title="Your Date of Birth. ex: dd-mm-yyyy"  onfocus="this.blur()">
									     <i class="fa fa-calendar icon" ></i>
									      </div>
									</div>
									
								</div>
								<div class="row col-sm-12 col-xs-12 fpad ">
						    		<div class="col-sm-12 col-xs-12 col-md-12 col-lg-6 npad form-group">
								    	<div class="col-sm-4 col-xs-12 npad"> 
										 <label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;Mobile No </label>
										 </div>
										 <div class="col-sm-8 col-xs-12 npad"> 
											 	<input class="form-control" type="text" id="txtCandidatePhone1" name="txtCandidatePhone1" autocomplete="off" maxlength="10" required="" placeholder="Mobile No" value="<?=isset($txtCandidatePhone1)?$txtCandidatePhone1:''?>" data-placement="top" data-toggle="tooltip" onkeypress="return isNumberKey(event)" title="Your mobile no. ex: 9040123456">
												<i class="fa fa-phone  icon"></i>
										</div>
									</div>
									<div class="col-sm-12 col-xs-12 col-md-12 col-lg-6 npad form-group">
								    	<div class="col-sm-4 col-xs-12 npad"> 
									 		<label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;Email  </label>
									 	</div>
									 	<div class="col-sm-8 col-xs-12 npad">     
									  		<input class="form-control" type="text" name="txtEmail" id="txtEmail"  placeholder="Email" autocomplete="off" maxlength="80" value="<?=isset($txtEmail)?$txtEmail:''?>"  data-placement="top" data-toggle="tooltip" title="Your Email-id. ex: xyz@abc.com">
									 		<i class="fa fa-envelope icon"></i>
									 	</div>
									</div>
								</div>
								<div class="row col-sm-12 col-xs-12 fpad">
									<div class="col-sm-12 col-xs-12 col-md-12 col-lg-6  npad form-group">
										<div class="col-sm-4 col-xs-12 npad"> 
									 		<label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;Password </label>
									 	</div>
									 	<div class="col-sm-8 col-xs-12 npad">     
									  		<input class="form-control" type="password" name="txtPassword1" id="txtPassword1" required="" placeholder="Password" autocomplete="off" maxlength="80" value=""  data-placement="top" data-toggle="tooltip" title="Your Password. ex: P@ssw0rd">
									 		<span id="show_hide" toggle="#password-field" class="fa fa-fw fa-eye field_icon icon toggle-password" data-placement="top" data-toggle="tooltip" style="cursor: pointer" title="Show Password"></span> 
									 	</div>
									</div>
									<div class="col-sm-12 col-xs-12 col-md-12 col-lg-6 npad form-group">
										<div class="col-sm-4 col-xs-12 npad"> 
									 		<label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;Confirm Password  </label>
									 	</div>
									 	<div class="col-sm-8 col-xs-12 npad">     
									  		<input class="form-control" type="password" name="txtConfirmPassword" id="txtConfirmPassword" required="" placeholder="Confirm Password" autocomplete="off" maxlength="80" value=""  data-placement="top" data-toggle="tooltip" title="Your Password. ex: P@ssw0rd">
									 		<i class="fa fa-key icon"></i> 
									 	</div>
									</div>
								</div>
								<div class="row col-sm-12 col-xs-12 fpad">
						    		<!--<div class=" col-sm-6 col-xs-6 fpad form-group">
								    	<div class="col-sm-4 col-xs-4"> 
									 		<label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp; State  </label>
									 	</div>
									 	<div class="col-sm-8 col-xs-8">  
									 		<select name="cmbState" id="cmbState" class="form-control">
											</select>   
											
									  	</div>
									</div>-->
									<div class="col-sm-12 col-xs-12 col-md-12 col-lg-6 npad form-group" style="margin-top: 20px">
								    <div class="col-sm-4 col-xs-12 npad">
									      <label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;Captcha </label>
									     </div>
									    <div class="col-sm-8 col-xs-12  npad">
										      <input class="form-control" type="text" name="txtCaptcha1" id="txtCaptcha1" required="" autocomplete="off" placeholder="Captcha" maxlength="6" onkeyup="this.value=this.value.toUpperCase()">
											<i class="fa fa-shield icon"></i>
										</div>
									</div> 
									<div class="col-sm-12 col-xs-12 col-md-12 col-xl-6 col-lg-6" style="margin-top: 20px">
								     	<p id="captImg3">
									      	<a href="javascript:void(0);" class="refreshCaptcha3" id="refreshCaptcha3" >
									    	<img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
									    </p>
								    </div>
								</div>
								
								
				                <div class="row fpad">
								    <div class="col-sm-12 col-xs-12 col-md-12 col-xl-12 col-lg-12">
							    <br />
							    		 <p><a href="javascript:void(0);" id="registerAlreadyUser" class="already" style="">Already Registered?</a></p>
							   	<br /> 		
							   	 		<center><button class="btoon_1" type="submit"  onclick="return validate();"   style="width: 166px;text-align: center;" id="btnRegister" name="btnRegister"><i class="fa fa-user-plus"></i> Register Now</button></center>
						    		</div>
						    	</div>
						    </form>
						      
					    
						<?php 
						 }
						 else
						 {
						?>
						<center><h3 style="color: red;">Registration Is closed For This Session.</h3></center>
						 	 <!--<div style="background: #f1f1f1; box-shadow: 10px 10px 2px 1px rgba(0, 0, 0, .2);">
						 	 	<img src="<?php echo base_url(); ?>downloads/sorry.png" width="475px;"/>
						 	 </div>-->
						<?php 
						 }
						 ?>


							
							
					</div>
				</div>
			</div>
	</div> 
<div class="modal fade" id="profile_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style=" margin-top: 10%;">
    	<div class="modal-content" style="background-size: 211% !important; background:url(<?php echo base_url(); ?>public/photos/rink_background.jpg)">
				<div class="modal-header">
					<h3 style="text-align: center;">Profile Details</h3>
					<button type="button" class="close"  style="padding-left: 95%;  margin-top: -50px;" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
				</div>
      		<div class="modal-body" style="height: 230px;">
	      		<div class="col-sm-12">
	      			<div id="container table-responsive" style="height: 150px;box-shadow: 1px 1px 4px 0px #6d6766;" >
	      			<?php 
	      			
	      				foreach($profile as $row){
	      					$first_name = $row['first_name'];
	      					$mid_name = $row['mid_name'];
	      					$last_name = $row['last_name'];
	      					$dob = $row['dob'];
	      					$mobile = $row['reg_user_id'];
	      					$email_id = $row['email_id'];
	      				
					?>	
						<table align="center" cellpadding="4" cellspacing="0" border="1" width="80%" class="table table-bordered table-striped ">
							<tr>
								<td>
									<b>Full Name</b>
					      		</td>
					      		<td>
									<?=$first_name.' '.$mid_name.' '.$last_name?>
					      		</td>
					      	</tr>
					      	<tr>
								<td>
									<b>DOB</b>
					      		</td>
					      		<td>
									<?=$dob?>
					      		</td>
					      	</tr>
					      	<tr>
								<td>
									<b>Mobile No</b>
					      		</td>
					      		<td>
									<?=$mobile?>
					      		</td>
					      	</tr>
					      	<tr>
								<td>
									<b>Email Id</b>
					      		</td>
					      		<td>
									<?=$email_id?>
					      		</td>
					      	</tr>
		      			</table>
					<?php } ?>
		      			
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<div class="modal fade" id="modalOtp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog" >
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;</button>
					<h3 class="modal-title" id="myModalLabelHeader">OTP</h3> 
				</div>
				<div class="modal-body">
					<form class="form-horizontal" id="OTPForm" name="OTPForm">
						<input type="hidden" name="hidOTP" id="hidOTP"/>
						
						<div class="row">
						<h5 style="color: #f94d4d;text-align: center;margin-bottom: 30px;">OTP has been sent to your registered Mobile no and Email Id.</h5>
							<div class="col-sm-12 col-xs-12   form-group">
							<div class="col-sm-4 col-xs-4"> 
						 		<label class="control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;OTP  </label>
						 	</div>
						 	<div class="col-sm-6 col-xs-6">     
						  		<input class="form-control" type="text" name="txtOTP" id="txtOTP" required="" placeholder="OTP" autocomplete="off" maxlength="4" value=""  data-placement="top" data-toggle="tooltip" title="Your OTP. ex: 0000">
						 		<i class="fa fa-key icon"></i> 
						 	</div>
						 	<div class="col-sm-2 col-xs-2">
						 		<a href="javascript:void(0);" class="resendOtpReg"  data-placement="top" data-toggle="tooltip" title="Resend OTP" id="resendOtpReg" ><img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
						 	</div>
							</div>
						</div>
						
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" id="savecadremaster"><i class="fa fa-save"></i>  Save</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
						</div>
					</form>
				</div>	
			</div>
		</div>
	</div>
		
	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close " style="font-size: 37px;position: unset"  data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h3 style="text-align: center;color: black;">Login Form</h3>  
				</div>
				<div class="modal-body" >
					
				 	<input type="hidden" id="birthStartDate" value="<?php echo $birth_start_date; ?>"/>
 					<input type="hidden" id="birthEndDate" value="<?php echo $birth_end_date; ?>"/>
					
			        	<form  class=""  action="" method="post" id="frm_login" name="frm_login">
			        		<!--<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;">
								<div id="alertmessage1"></div>
							</div>-->
						   <input type="hidden" id="insCode" name="insCode" value="<?php echo $inscode; ?>"/>
						   <input type="hidden" id="insEncCode" name="insEncCode" value="<?php echo $ins; ?>"/>
						   <input type="hidden" id="hidProgramCode" name="hidProgramCode"/>
						    
			   				<input type="hidden" id="hidMobileNo" name="hidMobileNo"/>
						    <div class="row fpad form-group" >
							    <div class="col-sm-4 col-xs-12">
							      <label class="label1">&nbsp;&nbsp; Mobile : </label>
							    </div>
						        <div class="col-sm-8 col-xs-12">
						           <input class="form-control" type="text" maxlength="10"  id="txtCandidatePhone" name="txtCandidatePhone" onkeypress="return isNumberKey(event)" value="<?=isset($txtCandidatePhone)?$txtCandidatePhone:''?>"  autocomplete="off" placeholder="Mobile Number" data-placement="top" data-toggle="tooltip" title="Mobile Number ex:9040123456" >
						      		<i class="fa fa-phone  icon"></i>
						        </div>
							</div>
						 	<h4 style="text-align: center; color: #040e59;">OR</h4>
							<div class="row fpad form-group" >
							    <div class="col-sm-4 col-xs-12">
							      <label class="label1">&nbsp;&nbsp; Email Id : </label>
							    </div>
						        <div class="col-sm-8 col-xs-12">
						           <input class="form-control" type="text" id="txtEmailId" name="txtEmailId" maxlength="80"  value="<?=isset($txtEmailId)?$txtEmailId:''?>"  autocomplete="off" placeholder="Email" data-placement="top" data-toggle="tooltip" title="Your Email-id. ex: xyz@gmail.com" >
						      		<i class="fa fa-envelope  icon"></i>
						        </div>
							</div>
<!--
						   <div class="row fpad form-group" >
								<div class="col-sm-4 col-xs-4">
									<label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp; Date of Birth :</label>
							    </div>

									<div class="col-sm-8 col-xs-8">
										<input class="form-control" type="text" name="txtdob" id="txtdob" autocomplete="off" placeholder="Date of Birth(dd-mm-yyyy)" data-placement="left" data-toggle="tooltip" title="Date of Birth ex:01-01-2000" value="<?=isset($txtdob)?$txtdob:''?>"  readonly onfocus="this.blur()"/>
										 <i class="fa fa-calendar icon" ></i>
									</div>
								</div>-->
							
							<div class="row fpad form-group" >
							    <div class="col-sm-4 col-xs-12">
							      <label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Password : </label>
							    </div>
						        <div class="col-sm-8 col-xs-12">
						           <input class="form-control" type="password" maxlength="80"  id="txtPwd" name="txtPwd" value=""  autocomplete="off" placeholder="Password" data-placement="top" data-toggle="tooltip" title="Your Password. ex: P@ssw0rd" >
						      		<span id="show_hide_login" toggle="#password-field" class="fa fa-fw fa-eye field_icon icon toggle-password_login" data-placement="top" data-toggle="tooltip" style="cursor: pointer" title="Show Password"></span> 
									 	
						        </div>
							</div>
							
					    	<div class="row fpad form-group" >
								<div class="col-md-4 col-xs-12">
			                      <label class="label1"><i style="color:red;font-size:18px;">*</i>Captcha : </label>
								</div>
									<!--<div class="control-label col-sm-4" style="margin-left: 0px;"> -->

									<div class="col-md-8 col-xs-12">
									 <input class="form-control" type="text" maxlength="6" id="txtCaptcha" name="txtCaptcha"  onkeyup="this.value=this.value.toUpperCase()" autocomplete="off" placeholder="Captcha" >
									<i class="fa fa-shield icon"></i>	
									<!--</div>-->
								</div>
			                   </div>
							     
							    <div class="row" style="padding-top: 0px;"> 
							          
							         <p id="captImg4" align="right" >
											<a href="javascript:void(0);" class="refreshCaptcha4" id="refreshCaptcha4" ><img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
										</p>
							        <p><a href="javascript:void(0);" id="loginForgotPassword"  style="color: red;font-size: 15px;margin-left: 50px">Forgot Password?</a></p>
										
							        <p><a href="javascript:void(0);" id="loginNewUser"  style="color: red;font-size: 15px;margin-left: 50px">New User?</a></p>
							    </div>
						    <div class="row fpad">
							    <div class="col-sm-12 col-xs-12" align="center" >
						   	 		<center>
						   	 		<button class="btoon_1" style="width: 166px;" type="submit" id="btnlogin" name="btnlogin"><i class="fa fa-user-plus"></i> Login</button>
					    			</center>
					    		</div>
					    	</div>
						</form>

							
							
					</div>
				</div>
			</div>
	</div>

	<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close"  style="padding-left: 95%;" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h3 style="text-align: center;color: black;">Forgot Password</h3>
					
				</div>
				<div class="modal-body" >
				
		        	<form  class=" login-box-body"  action="" method="post" id="frmForgotPassword" name="frmForgotPassword">
		        		<input type="hidden" id="insCode" name="insCode" value="<?php echo $inscode; ?>"/>
		        		
					    <div class="row fpad form-group" >
						    <div class="col-sm-4 col-xs-12">
						      <label class="label1">&nbsp;&nbsp; Mobile : </label>
						    </div>
					        <div class="col-sm-8 col-xs-12">
					           <input class="form-control" type="text" maxlength="10"  id="txtForgotCandidatePhone" name="txtForgotCandidatePhone" onkeypress="return isNumberKey(event)" value="<?=isset($txtCandidatePhone)?$txtCandidatePhone:''?>"  autocomplete="off" placeholder="Mobile Number" data-placement="top" data-toggle="tooltip" title="Mobile Number ex:9040123456" >
					      		<i class="fa fa-phone  icon"></i>
					        </div>
						</div>
					 	<h4 style="text-align: center; color: #040e59;">OR</h4>
						<div class="row fpad form-group" >
						    <div class="col-sm-4 col-xs-12">
						      <label class="label1">&nbsp;&nbsp;Email Id : </label>
						    </div>
					        <div class="col-sm-8 col-xs-12">     
						  		<input class="form-control" type="text" name="txtForgotEmail" id="txtForgotEmail"  placeholder="Email" autocomplete="off" maxlength="80" value="<?=isset($txtEmail)?$txtEmail:''?>"  data-placement="top" data-toggle="tooltip" title="Your Email-id. ex: xyz@gmail.com">
						 		<i class="fa fa-envelope icon"></i>
						 	</div>
						</div>
						
				    	<div class="row fpad form-group" >
							<div class="col-md-4 col-xs-12">
		                      <label class="label1"><i style="color:red;font-size:18px;">*</i>Captcha : </label>
							</div>

							<div class="col-md-8 col-xs-12">
								 <input class="form-control" type="text" maxlength="6" id="txtCaptcha5" name="txtCaptcha5"  onkeyup="this.value=this.value.toUpperCase()" autocomplete="off" placeholder="Captcha" >
								<i class="fa fa-shield icon"></i>	
							</div>
	                   </div>
						     
					    <div class="row" style="padding-top: 0px;"> 
					          
					         <p id="captImg5" align="right" >
									<a href="javascript:void(0);" class="refreshCaptcha5" id="refreshCaptcha5" ><img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
								</p>
					    </div>
					    <div class="row fpad">
						    <div class="col-sm-12 col-xs-12" align="center" >
					   	 		<center><button class="btoon_1" style="width: 166px;" type="submit" id="btnForgotPassword" onclick="return validate_forgot_password();"  name="btnForgotPassword"><i class="fa fa-cogs"></i> Get OTP</button>
				    		</center>
				    		</div>
				    	</div>
				    	
				    	<div class="row fpad form-group" id="newPassword" style="padding-top: 20px;">
							<div class="col-sm-offset-1 col-sm-12 col-xs-12">
								<div class="col-sm-3 col-xs-3"> 
							 		<label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;OTP: </label>
							 	</div>
							 	<div class="col-sm-5 col-xs-5">     
							  		<input class="form-control" type="text" name="txtOTP" id="txtOTPfp" required="" placeholder="OTP" autocomplete="off" maxlength="80" value=""  data-placement="top" data-toggle="tooltip">
							 		<i class="fa fa-key icon"></i> 
							 	</div>
							 	<div class="col-sm-2 col-xs-2">
							 		<a href="javascript:void(0);" class="resendOTP"  data-placement="top" data-toggle="tooltip" title="Resend OTP" id="resendOTP" ><img style="height: 30px;" src="<?php echo base_url().'public/assets/images/resend.png'; ?>"/></a>
							 	</div>
							</div>
							<div class="row" style="margin-top: 14%">
							    <div class="col-sm-12 col-xs-12" align="center" >
						   	 		<center><button class="btoon_1" style="width: 166px;" type="button" id="btnChangePassword" name="btnChangePassword"><i class="fa fa-user-plus"></i> Submit</button>
					    		</center>
					    		</div>
					    	</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="newPasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close"  style="padding-left: 95%;" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h3 style="text-align: center;color: black;">New Password</h3>
				</div>
				<div class="modal-body" >
		        	<form  class=" login-box-body"  action="" method="post" id="frmNewPassword" name="frmNewPassword">
		        		<input type="hidden" id="hidRegUserId" name = "hidRegUserId"/>
		        		<input type="hidden" id="hidMailId"  name = "hidMailId"/>
					    <div class="row fpad form-group">
							<div class="col-sm-12 col-xs-12">
								<div class="col-sm-4 col-xs-12"> 
							 		<label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Password </label>
							 	</div>
							 	<div class="col-sm-8 col-xs-12">     
							  		<input class="form-control" type="password" name="txtPassword2" id="txtPassword2" required="" placeholder="Password" autocomplete="off" maxlength="80" value=""  data-placement="top" data-toggle="tooltip" title="Your Password. ex: P@ssw0rd">
							 		<i class="fa fa-key icon"></i> 
							 	</div>
							</div>
						</div>
						<div class="row fpad form-group">
							<div class="col-sm-12 col-xs-12">
								<div class="col-sm-4 col-xs-12"> 
							 		<label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Confirm Password  </label>
							 	</div>
							 	<div class="col-sm-8 col-xs-12">     
							  		<input class="form-control" type="password" name="txtConfirmPassword2" id="txtConfirmPassword2" required="" placeholder="Confirm Password" autocomplete="off" maxlength="80" value=""  data-placement="top" data-toggle="tooltip" title="Your Password. ex: P@ssw0rd">
							 		<i class="fa fa-key icon"></i> 
							 	</div>
							</div>
						</div>
						
				    	<div class="row fpad form-group">
				    		<div class="col-sm-12 col-xs-12">
								<div class="col-md-4 col-xs-12">
			                      <label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Captcha : </label>
								</div>

								<div class="col-md-8 col-xs-12">
									 <input class="form-control" type="text" maxlength="6" id="txtCaptcha6" name="txtCaptcha6"  onkeyup="this.value=this.value.toUpperCase()" autocomplete="off" placeholder="Captcha" >
									<i class="fa fa-shield icon"></i>	
								</div>
							</div>
	                   </div>
						     
					    <div class="row" style="padding-top: 0px;"> 
					          
					         <p id="captImg6" align="right" >
									<a href="javascript:void(0);" class="refreshCaptcha6" id="refreshCaptcha6" ><img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
								</p>
					    </div>
					    <div class="row fpad">
						    <div class="col-sm-12 col-xs-12" align="center" >
					   	 		<center><button class="btoon_1" style="width: 166px;" type="submit" id="btnChangePwd" name="btnChangePwd" ><i class="fa fa-cogs"></i> Submit</button>
				    		</center>
				    		</div>
				    	</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
<a class="brand js-target-scroll"></a>
<script>
	function profile_view(){
		$('#profile_modal').modal('show');
	}
	$("#imgAdmitCard").click(function(){
		var fullDate = new Date()
		console.log(fullDate);
		//Thu May 19 2011 17:25:38 GMT+1000 {}
		 
		//convert month to 2 digits
		var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
		 
		var currentDate = fullDate.getFullYear() + "-" +  twoDigitMonth + "-" + fullDate.getDate();
		console.log(currentDate);
		admitcard_date = '2020-08-24'; 
		if(new Date(currentDate) >= new Date(admitcard_date))
		{
			refresh_captcha4();
			$('#frm_login').data('bootstrapValidator').resetForm(true);
			$('#loginModal').modal('show');
			$('#AdminloginModal').modal('hide');
			$('#registrationModal').modal('hide');
			$('#forgotPasswordModal').modal('hide');
			$('#loginModal').on('shown.bs.modal', function () 
			{ 
				$('#txtCandidatePhone').focus(); // Focusing the textbox
			})
		}
	});
</script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/bootstrap-datepicker.js" ></script>