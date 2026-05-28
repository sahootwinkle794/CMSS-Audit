<link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet"> 
<?php 
//$program_code = $pro_code;
$ins = $this->uri->segment(4); // 1stsegment
$inscode =  encrypt_decrypt('decrypt', $ins);
if($this->session->flashdata('post_data')){
	$post_data = $this->session->flashdata('post_data');
	$txtCandidatePhone = $post_data['txtCandidatePhone'];
	//$txtdob = $post_data['txtdob'];
}



?>
<style type="text/css">
	/*loader design start*/
	/* Absolute Center Spinner */
		.btnlog {
		    position: inherit;
		    background: linear-gradient(180deg, #E48210 0%, #E47610 100%);
		    width: 403px;
		    margin-left: -15px;
		    height: 45px;
		    border-radius: 5px;
		    border: 1px solid #C7BFA4;
		}
		
		.loading {
		  position: fixed;
		  z-index: 999;
		  height: 2em;
		  width: 2em;
		  overflow: show;
		  margin: auto;
		  top: 0;
		  left: 0;
		  bottom: 0;
		  right: 0;
		}
		.ad{
			min-width: 38px;
		}

		/* Transparent Overlay */
		.loading:before {
		  content: '';
		  display: block;
		  position: fixed;
		  top: 0;
		  left: 0;
		  width: 100%;
		  height: 100%;
		    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

		  background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
		}

		/* :not(:required) hides these rules from IE9 and below */
		.loading:not(:required) {
		  /* hide "loading..." text */
		  font: 0/0 a;
		  color: transparent;
		  text-shadow: none;
		  background-color: transparent;
		  border: 0;
		}

		.loading:not(:required):after {
		  content: '';
		  display: block;
		  font-size: 10px;
		  width: 1em;
		  height: 1em;
		  margin-top: -0.5em;
		  -webkit-animation: spinner 150ms infinite linear;
		  -moz-animation: spinner 150ms infinite linear;
		  -ms-animation: spinner 150ms infinite linear;
		  -o-animation: spinner 150ms infinite linear;
		  animation: spinner 150ms infinite linear;
		  border-radius: 0.5em;
		  -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
		box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
		}

		/* Animation */

		@-webkit-keyframes spinner {
		  0% {
		    -webkit-transform: rotate(0deg);
		    -moz-transform: rotate(0deg);
		    -ms-transform: rotate(0deg);
		    -o-transform: rotate(0deg);
		    transform: rotate(0deg);
		  }
		  100% {
		    -webkit-transform: rotate(360deg);
		    -moz-transform: rotate(360deg);
		    -ms-transform: rotate(360deg);
		    -o-transform: rotate(360deg);
		    transform: rotate(360deg);
		  }
		}
		@-moz-keyframes spinner {
		  0% {
		    -webkit-transform: rotate(0deg);
		    -moz-transform: rotate(0deg);
		    -ms-transform: rotate(0deg);
		    -o-transform: rotate(0deg);
		    transform: rotate(0deg);
		  }
		  100% {
		    -webkit-transform: rotate(360deg);
		    -moz-transform: rotate(360deg);
		    -ms-transform: rotate(360deg);
		    -o-transform: rotate(360deg);
		    transform: rotate(360deg);
		  }
		}
		@-o-keyframes spinner {
		  0% {
		    -webkit-transform: rotate(0deg);
		    -moz-transform: rotate(0deg);
		    -ms-transform: rotate(0deg);
		    -o-transform: rotate(0deg);
		    transform: rotate(0deg);
		  }
		  100% {
		    -webkit-transform: rotate(360deg);
		    -moz-transform: rotate(360deg);
		    -ms-transform: rotate(360deg);
		    -o-transform: rotate(360deg);
		    transform: rotate(360deg);
		  }
		}
		@keyframes spinner {
		  0% {
		    -webkit-transform: rotate(0deg);
		    -moz-transform: rotate(0deg);
		    -ms-transform: rotate(0deg);
		    -o-transform: rotate(0deg);
		    transform: rotate(0deg);
		  }
		  100% {
		    -webkit-transform: rotate(360deg);
		    -moz-transform: rotate(360deg);
		    -ms-transform: rotate(360deg);
		    -o-transform: rotate(360deg);
		    transform: rotate(360deg);
		  }
		}
	/*loader design end*/
    .icon {
	    color: #8D8C8A;
	    position: absolute;
	    top: 10px;
	    left: 85%;
	}
    label {
	    display: inline-block;
	    max-width: 100%;
	    margin-bottom: 15px;
	    /*font-weight: bold;*/
	    color: #000;
    	font-size: 15px;
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
	.btoon {
	    padding: 7px;
	    width: 465px;
	    background: #FF8400;
	    margin-left: 0px;
	    font-size: 19px;
	    color: #fff;
	    border: 1px solid #FF8400;
	}
    /*.admin-login-background{
				background:#fffeffe6;
				margin-top: 83px;
				border: 1px solid #20505f;
				border-radius: 5px;
				box-shadow: 2px 2px 2px 1px #0000005c;
			}*/
	.admin-login-background{
		position: relative;
		background: #224D56;
		margin-top: 12px;
		border-radius: 24px;
		box-shadow: 2px 2px 2px 1px #0000005c;
		width: 549px;
	}
	.fpad{
    	padding-top: 0px;
    }

    .form-group {
	    margin-bottom: 10px;
	}
	.tooltip > .tooltip-inner {
	background-color: rgb(252, 243, 207);
	color: #000;
	border: 1px solid black;
	    /*padding: 15px;
	    font-size: 20px;*/
	}

	/* Tooltip on top */
	.tooltip.top > .tooltip-arrow {
		border-top: 5px solid green;
	}

	/* Tooltip on bottom */
	.tooltip.bottom > .tooltip-arrow {
		border-bottom: 5px solid blue;
	}

	/* Tooltip on left */
	.tooltip.left > .tooltip-arrow {
		border-left: 5px solid red;
	}

	/* Tooltip on right */
	.tooltip.right > .tooltip-arrow {
		border-right: 5px solid black;
	} 
	
	.sweet-alert .sa-icon {
	    margin: 25px auto !important;
	}
	.confirm{
		margin-left: -45px !important;
	    margin-top: 11px !important;
	    margin-bottom: 20px !important;
	}
	.sweet-alert {
		padding-bottom: 75px !important;
	}
	.Ann {
    background-color: #2098df;

	height: 40px;
 
	border-radius: 20px;

	width: 91%;
    left: 5%;
	}

	.imgLabel-1 {
	    position: absolute;
	    color: white;
	    top: 3px;
	    left: -14px;
	    width: 100%;
	    font-size: 15px;
	    margin-top: -3px;
	    z-index: 1; 
	}
	.ann_label_home {
	font-size: 15px;
    width: 100%;
    cursor: pointer;
    top: 8px;
		    	
	}
	.center{
		  display: block;
		  margin-left: 59px;
		  margin-right: auto;
		  width: 50%;
	}
	.geninfo{
		/*position: absolute;*/
		color: #FFFFFF;
		width: 234px;
		height: 27px;
		left: 169px;
		top: 168px;
		font-family: Exo 2;
		font-style: normal;
		font-weight: bold;
		font-size: 18px;
		line-height: 150%;
	}
	.genbody{
		/*position: absolute;*/
		width: 492px;
		height: 336px;
		left: 169px;
		top: 215px;
		font-family: Exo 2;
		font-style: normal;
		font-weight: normal;
		font-size: 15px;
		line-height: 120%;
		/* or 18px */
		color: #FFFFFF;
	}
	.lMob{
		font-family: Exo 2;
		font-weight: 500;
		font-size: 16px;
		line-height: 19px;
		color: #FFFFFF;
	}
	.lPass{
		font-family: Exo 2;
		font-weight: 500;
		font-size: 16px;
		line-height: 19px;
		color: #FFFFFF;
	}
	.inpmob{
		margin-left: 174px;
	    top: 4px;
	    border-radius: 6px;
	    border: 1px solid #86E3F0;
	    width: 330px;
	    background: #ADDFE7;
		/*width: 462px;
	    margin-left: 15px;
	    height: 36px;
	    background: #ADDFE7;
	    border: 1px solid #86E3F0;
	    border-radius: 5px;*/
	}
	.inpmobb{
		margin-left: 174px;
	    top: 4px;
	    border-radius: 6px;
	    border: 1px solid #86E3F0;
	    width: 330px;
	    background: #ADDFE7;
	}
	.inpPass{
		margin-left: 174px;
	    top: 4px;
	    border-radius: 6px;
	    border: 1px solid #86E3F0;
	    width: 330px;
	    background: #ADDFE7;
	}
	/*.captImg{
		margin-right: 96px;
	}*/
	.capinp, .capinpp, .capinpass{
		font-family: Exo 2;
	    height: 46px;
	    background: #FFFFFF;
	    border: 1px solid #A4C2C7;
	    box-sizing: border-box;
	    border-radius: 5px;
	    margin-left: -39px;
	    margin-top: 2px;
	    width: 200px;
	}
	.refreshimg{
		height: 46px;
	    margin-left: -39px;
	    margin-top: 2px;
	}
	.refreshimgpass {
	    height: 46px;
	    margin-left: -11px;
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
	.newpassword{
		background: #224D56;
	    border-radius: 8px;
	    height: auto;
	    position: relative;
	    width: 570px;
	    margin-left: 73px;
	}
	.newtxt{
		text-align: center;
		color: white;
		font-size: 18px;
		font-weight: 600;
		padding-top: 10px;
	}
	.newpas{
	    top: 4px;
	    border-radius: 6px;
	    border: 1px solid #86E3F0;
	    background: #ADDFE7;
	    margin-bottom: 6px;
	}
	.lnwpas{
		color: white;
    	margin-top: -5px;
	}
	.forgotmodal{
		background: #224D56;
	    border-radius: 8px;
	    height: auto;
	    position: relative;
	    width: 529px;
	    margin-left: 73px;
	}
	.modal-header {
	    min-height: 16.42857143px;
	    padding: 15px;
	    border-bottom: 1px solid #224D56;
	}
	.modaltext{
		color: #FFFFFF;
		font-family: Exo 2;
		font-style: normal;
		font-size: 20px;
		text-align: center;
	}
	.btnforgot{
	    position: inherit;
	    background: linear-gradient(180deg, #E48210 0%, #E47610 100%);
	    width: 457px;
	    margin-left: 0px;
	    height: 45px;
	    border-radius: 5px;
	    border: 1px solid #C7BFA4;
	}
	.btnpass{
		position: inherit;
	    background: linear-gradient(180deg, #E48210 0%, #E47610 100%);
	    width: 457px;
	    margin-left: 0px;
	    height: 45px;
	    border-radius: 5px;
	    border: 1px solid #C7BFA4;
	}
	.login-box-body{
		padding: 10px 20px 20px 20px;
	    border-top: 0;
	    color: #666;
	}
	.login-box-bodyy{
		padding: 0px 20px 20px 20px;
	    border-top: 0;
	    color: #666;
	}
	.input-group .input-group-addon {
	    border-radius: 10px;
	}
	.form-group.has-error .help-block {
	    color: #dd4b39;
	    margin-left: 180px;
	}
	.alogin{
		text-align: center;
		color: white;
		font-size: 18px;
		font-weight: 600;
		padding-top: 10px;
	}
	.forgotpass{
		color: #fbff00;
		font-size: 15px;
		margin-left: 36px;
		line-height: 35px;
	}
	.refreshimgg{
		margin-top: 5px; 
    	margin-left: -44px;
	}
	/*.modal-dialog img {
	    margin-left: -42px;
	}*/
	.close{
		padding-left: 91%;
		color: #fff;
	}
	.lmb{
		color:white;
	}
	.lmb1{
		color: white;
    	margin-top: -5px;
	}
	.inpotp{
	    top: 4px;
	    border-radius: 6px;
	    border: 1px solid #86E3F0;
	    background: #ADDFE7;
		left: -42px;
    	width: 130%;
	}
	.reotp{
		height: 30px;
    	margin-top: 5px;
	}
	.btnotp{
		position: inherit;
	    background: linear-gradient(180deg, #E48210 0%, #E47610 100%);
	    width: 197px;
	    margin-left: 0px;
	    height: 44px;
	    border-radius: 5px;
	    border: 1px solid #C7BFA4;
	}
	/*button.close {
		padding: unset;
	}*/
	/*@media (max-width: 1024px){
		.genbody {
		    width: 823px;
		    height: auto;
		    font-size: 17px;
		}
		.admin-login-background {
		    margin-top: 12px;
		    width: 579px;
		    margin-left: 182px;
		}
		.center {
		    margin-left: 49px;
		}
		.capinp {
		    margin-left: -64px;
		}
		.refreshimg {
		    margin-left: 147px;
		    margin-top: -67px;
		}
		.forgotmodal {
		    height: 450px;
		    width: 617px;
		    margin-left: -48px;
		}
		.lmb {
		    margin-left: 39px;
		}
		.capinpp {
		    margin-left: -65px;
		}
		.refreshimgg {
		    margin-top: -70px;
		    margin-left: 154px;
		}
	}*/
	@media (min-width: 767px) and (max-width: 1024px){
		.genbody {
		    width: 641px;
		    height: auto;
		    line-height: 127%;
		}
		.admin-login-background {
		    margin-top: 12px;
		    width: 82%;
		    margin-left: 61px;
		}
		.center {
		    margin-left: 51px;
		}
		.capinp {
		    margin-left: -58px;
		}
		.refreshimg {
		    margin-left: 158px;
		    margin-top: -68px;
		}
		.btnlog {
		    margin-left: -2px;
		}
		.forgotmodal {
		    margin-left: -74px;
		}
		.capinpp {
		    margin-left: -54px;
		}
		.refreshimgg {
		    margin-top: -67px;
		    margin-left: 160px;
		}
		.lmb {
		    margin-left: unset;
		}
		.newpassword {
		    width: 570px;
		    margin-left: -68px;
		}
		.capinpass {
		    margin-left: -40px;
		    margin-top: 2px;
		    width: 200px;
		}
		.refreshimgpass {
		    height: 46px;
		    margin-left: 173px;
		    margin-top: -66px;
		}
		.btnpass {
			margin-left: unset;
		}
	}
	@media (min-width: 551px) and (max-width: 766px){
		.genbody{
			height: auto;
		}
		.admin-login-background {
		    width: auto;
		    /*width: 549px;*/
		    /*left: 32px;*/
		    height: 429px; 
		    /*top: -245px;*/
		}
		.capinp{
		    margin-left: 93px;
		}
		.refreshimg {
		    margin-left: 311px;
		    margin-top: -67px;
		}
		.forgotpass {
		    margin-left: -206px;
		}
		.btnlog {
		    margin-left: 55px;
		    top: 46px;
		}
		.forgotmodal {
		    width: 499px;
    		margin-left: 47px;
		}
		.inpmobb {
		    width: 302px;
		}
		.btnforgot {
		    width: 422px;
		    margin-left: 14px;
		}
		.capinpp {
		    margin-left: 83px;
		}
		.refreshimgg {
		    margin-top: -72px; 
		    margin-left: 296px;
		}
		.lmb1 {
		    color: white;
		    margin-top: -5px;
		    margin-left: 46px;
		}
		.inpotp {
		    left: 1px;
		}
		.reotp {
		    height: 30px;
		    margin-top: 5px;
		    margin-left: 37px;
		}
		.btnotp {
		    margin-left: 145px;
		}
		.newpassword {
		    width: 570px;
		    margin-left: 24px;
		}
		 .capinpass {
		    margin-left: 128px;
		    margin-top: 2px;
		}
		.btnpass {
			margin-left: 28px;
		}
	}
	@media (min-width: 416px) and (max-width: 550px){
		.genbody{
			height: auto;
		}
		.admin-login-background {
		    margin-top: 12px;
		    width: 100%;
		    height: 432px;
		}
		.inpmob {
		    margin-left: 159px;
		}
		.inpPass {
    		margin-left: 159px;
		}
		.capinp{
		    margin-left: 93px;
		}
		.refreshimg {
		    margin-left: 322px;
		    margin-top: -67px;
		}
		.forgotpass {
		    margin-left: -198px;
		}
		.btnlog {
		    top: 39px;
		}
		.forgotmodal {
		    width: 472px;
    		margin-left: 25px;
		}
		.inpmobb {
		    width: 279px;
		}
		.btnforgot {
		    width: 426px;
		}
		.capinpp {
		    margin-left: 104px;
		}
		.refreshimgg {
		    margin-top: -68px;
		    margin-left: 314px;
		}
		.lmb1 {
		    margin-left: 57px;
		}
		.inpotp {
		    left: 18px;
		    width: 137%;
		}
		.reotp {
		    height: 30px;
		    margin-top: 5px;
		    margin-left: 46px;
		}
		.btnotp {
		    width: 202px;
		    margin-left: 119px;
		    height: 41px;
		}
		.newpassword {
		    width: 504px;
		    margin-left: 7px;
		}
		.capinpass {
		    margin-left: 94px;
		    margin-top: 2px;
		}
		.refreshimgpass {
		    height: 43px;
		    margin-left: 303px;
		    margin-top: -68px;
		}
		.btnpass {
		    margin-left: 0px;
		    height: 45px;
		}
	}
	@media (min-width: 377px) and (max-width: 415px){
		.geninfo {
		    margin-top: -59px;
		    height: 30px;
		    font-weight: 100;
		}
		.genbody {
		    width: auto;
		    height: auto;
		    margin-left: -4px;
		    margin-top: -9px;
		    /*font-size: 11px;*/
		}
		.admin-login-background {
		    width: 100%;
    		margin-left: 0px;
		}
		.center {
		    margin-left: 70px;
		    margin-top: 5px;
		}
		.inpmob {
		    margin-left: 106px;
		    top: 14px;
		    width: 199px;
		}
		.inpPass{
			margin-left: 106px;
		    top: 14px;
		    width: 199px;
		}
		.alogin{
			/*font-size: 13px;*/
		}
		.mores{
			/*font-size: 10px;*/
		}
		.capinp {
		    height: 42px;
		    margin-left: 34px;
		    margin-top: 0px;
		    width: 195px;
		}
		.refreshimg {
		    height: 39px;
		    margin-left: 240px;
		    margin-top: -64px;
		}
		.forgotpass {
		   /* font-size: 11px;*/
		    margin-top: -24px;
		    float: left;
		    line-height: 30px;
		}
		.btnlog {
		    width: 279px;
		    margin-left: -146px;
		    height: 33px;
		}
		.texlog {
		    font-size: 13px;
		}
		.forgotmodal{
		    width: 352px;
    		margin-left: 12px !important;
		}
		.close{
			padding-left: 87%;
		}
		.lmb{
			margin-left: 10px;
		}
		.inpmobb{
			margin-left: 127px;
		    top: 6px;
		    width: 192px;
		}
		.capinpp{
		    margin-left: 32px;
    		margin-top: 5px;
		}
		.refreshimgg {
		    margin-top: -66px;
		    margin-left: 242px;
		    height: 46px;
		}
		.btnforgot {
		    width: 305px;
    		height: 38px;
		}
		.inpotp {
		    left: -17px;
		    width: 195%;
		}
		.reotp {
		    height: 30px;
		    margin-top: 7px;
		    margin-left: 61px;
		}
		.btnotp {
			top: 9px;
		    margin-left: 74px;
		}
		.form-group.has-error .help-block {
		    margin-left: 38px;
		}
		.newpassword {
		    width: 187%;
		    margin-left: 4px;
		}
		.captImg{
			margin-top: 14px;
		}
		.capinpass {
		    margin-left: 43px;
		    margin-top: 2px;
		    width: 200px;
		}
		.refreshimgpass {
		    height: 42px;
		    margin-left: 251px;
		    margin-top: -71px;
		}
		.btnpass {
		    width: 290px;
		    margin-left: 20px;
		}
	}
	@media (min-width: 200px) and (max-width: 376px){
			.geninfo {
			    margin-top: -73px;
			    height: 30px;
			    font-weight: 100;
			}
			.genbody {
			    width: auto;
			    height: auto;
			    margin-left: -4px;
			    margin-top: -9px;
			    line-height: 16px;
			    font-size: 13px;
			}
			.admin-login-background {
			    width: 100%;
    			margin-left: 0px;
			}
			.inpmob {
			    margin-left: 106px;
			    top: 14px;
			    width: 182px;
			}
			.inpPass{
				margin-left: 106px;
			    top: 14px;
			    width: 182px;
			}
			.alogin{
				/*font-size: 13px;*/
			}
			.mores{
				font-size: 13px;
			}
			.capinp {
			    height: 42px;
			    margin-left: 1px;
			    margin-top: -16px;
			    width: 195px;
			}
			.refreshimg {
			    height: 39px;
			    margin-left: 205px;
			    margin-top: -65px;
			}
			.forgotpass {
			   /* font-size: 11px;*/
			    margin-top: -24px;
			    float: left;
			    line-height: 30px;
			}
			.btnlog {
			    width: 260px;
			    margin-left: 9px;
			    height: 33px;
			}
			.texlog {
			    font-size: 13px;
			}
			.forgotmodal{
			    width: 323px;
			    margin-left: 13px !important;
			}
			.close{
				padding-left: 87%;
			}
			.lmb{
				margin-left: -7px;
			}
			.inpmobb{
				margin-left: 127px;
			    top: 6px;
			    width: 192px;
			}
			.capinpp{
			    margin-left: 7px;
			    margin-top: -9px;
			}
			.refreshimgg {
			    margin-top: -66px;
			    margin-left: 215px;
			    height: 45px;
			}
			.btnforgot {
			    width: 272px;
			    height: 38px;
			}
			.lmb1 {
			    color: white;
			    margin-top: -5px;
			    margin-left: -13px;
			}
			.inpotp {
			    left: -20px;
			    width: 195%;
			}
			.reotp {
			    height: 30px;
			    margin-top: 7px;
			    margin-left: 48px;
			}
			.btnotp {
			    margin-left: 58px;
			    height: 36px;
			    top: 5px;
			}
			.form-group.has-error .help-block {
			    margin-left: 20px;
			}
			.newpassword {
			    width: 187%;
			    margin-left: 4px;
			}
			.captImg{
				margin-top: 14px;
			}
			.capinpass {
			    margin-left: 16px;
			    margin-top: 2px;
			    width: 200px;
			}
			.refreshimgpass {
			    height: 42px;
			    margin-left: 227px;
			    margin-top: -67px;
			}
			.btnpass {
			    width: 290px;
			    margin-left: 4px;
			}
		}
</style> 
<link href="<?php echo base_url(); ?>public/assets/css/text-scroll.css" rel="stylesheet" />

<section style=" padding-bottom: 100px;">
		<!--<div class="row" >
			<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 Ann">
	            <div class="hidden-sm hidden-xs col-md-1 col-lg-1 col-xl-1 ">
	            	<label class="imgLabel-1" ><img src="<?php echo base_url()?>upload/image/ann.png"></label>
	            </div>
	            <div class="col-sm-12 col-xs-12 col-md-11 col-lg-11 col-xl-11">	
		            <div class="scroll-hr">	
						<p class="ann_label_home">
							
							<a target='_blank' class='viewlink' style='text-decoration:none;color:#fff'  href="#">»&nbsp;Advertisement for the Different Posts of CMSS</a></h2>                           
						</p>
					</div>
				</div> 
       		</div>
		</div>-->
<div class="container">
 <div class="row">
 	
     <div class="col-sm-12">

       <div id="generalinfo" class="col-sm-6" style="margin-top: 30px;color: #fdfdfd;">
			<p class="geninfo">GENERAL INSTRUCTIONS:</p>
			<!--<h3 style="color: #E4791A;;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">GENERAL INSTRUCTIONS:</h3><hr>-->
			<!--The Candidates applying online may:--->
				<ul>
				<li id="generalinfo_text" class="genbody" type="disc"></li>
				<!--<ul id="generalinfo_text" style="font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif; list-style: outside;color: #0f89d1;" type="disc">-->
			    	<!--<li>Read the brochure, eligibility criteria and availability of Seats Category-wise thoroughly before filling the application form.</li>
			    	<li>Keep all the information ready before starting to fill the Application Form.</li>
			    	<li>Keep ready the scanned (digital) images of your Photograph, Signature, 10th ,12th, Residence/Domicile and Caste Certificate (if applicable).</li>
			    	<li>OBC candidate has to upload caste certificate as per the GoI format. (State BC certificate will not be considered as proof of OBC) Applications submitted under OBC category without a valid OBC certificate will be rejected and no further correspondence will be entertained.</li>
			    	<li>Please note your Application Number for future reference.</li>
			    	<li>Incomplete application form will be rejected.</li>
			    	<li>After completion of application form download the print application.</li>--><!--
			    	<li>Application form will be considered complete only on receipt of the prescribed fees.</li>
			    	<li>Fees once paid will not be refunded under any circumstances.</li>-->
				</ul>
			<!--<ul style="color: black;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px;">The application must be filled in English only, in CAPITAL letters except for signature with black pen and shade the corresponding  <b>oval with HB pencils only.</b></h4></li>
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px;">Inadequate information furnished in each relevant column of the application form would entail rejection of candidature.</h4></li>
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px;"><b>No request of examination center will be entertained</b></h4></li>
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px;">Any application received after the closing date will not be considered.</h4></li>
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px;">Any delay in receiving the blank application form by the candidate will not be considered as a valid reason for the late submission of the application form, after the closing date. <b> The institute will not accept any claim or responsibility for any postal delay or loss in transit.</b></h4></li>
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px;">No claim of submission of application form received after the due date will be entertained on any account.<b>Postal and any other delay are at the risk of applicant.</b></h4></li>
				<li><h4 align="justify" style="font-size: 15px;padding-right: 20px;">Duly filled-in application form with enclosures in all respects should be sent to <b>CENTER ADDRESS</b></h4></li>
			</ul>-->
			
   		</div>
 

   		<span class="loading" id="spanLoginloader" style="display: none">Processing... </span>
	    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 admin-login-background">
       		<p class="alogin">Applicant Login</p>
       		
        	<form  class=" login-box-body"  action="" method="post" id="frm_login" name="frm_login">
			   <input type="hidden" id="insCode" name="insCode" value="<?php echo $inscode; ?>"/>
			   <input type="hidden" id="insEncCode" name="insEncCode" value="<?php echo $ins; ?>"/>
			<!--<div class="form-group">
				<div class="row form-group" >
				  <label class ="col-lg-4 lMob"for=""><i style="color:red;font-size:18px;">*</i> Mobile </label>
	  			</div>
	  			<div class="row form-group " >
		      		<div class="input-group inpmob">
						<div class="input-group-addon ad" style="background: #ADDFE7;">
							<span class="input-group-text">
								<i class="fa fa-mobile" style="color:#E4791A"></i>
							</span>                    
						</div>
						<input class="form-control" style="background: #ADDFE7;" type="text" maxlength="10"  id="txtCandidatePhone" name="txtCandidatePhone" value="<?=isset($txtCandidatePhone)?$txtCandidatePhone:''?>"  autocomplete="off" placeholder="Mobile Number" data-placement="top" data-toggle="tooltip" title="Mobile Number ex:9040123456" >
						
					</div>
				</div>
			</div>-->
			<div class="row fpad form-group">
				<div class="col-sm-5 col-xs-5" >
				    <label class="mores" style="color:white;"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Mobile Number</label>
	  			</div>
	  			<div class="row form-group " >
		      		<div class="input-group inpmob">
						<div class="input-group-addon ad" style="background: #ADDFE7;">
							<span class="input-group-text">
								<i class="fa fa-mobile" style="color:#E4791A"></i>
							</span>                    
						</div>
						<input class="form-control" style="background: #ADDFE7;" type="text" maxlength="10"  id="txtCandidatePhone" name="txtCandidatePhone" value="<?=isset($txtCandidatePhone)?$txtCandidatePhone:''?>"  autocomplete="off" placeholder="Mobile Number" data-placement="top" data-toggle="tooltip" title="Mobile Number ex:9040123456" >
						
					</div>
				</div>
			</div>
			<div class="row fpad form-group">
				<div class="col-sm-5 col-xs-5" >
				    <label class="mores" style="color:white;"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Password</label>
	  			</div>
	  			<div class="row form-group " >
		      		<div class="input-group inpPass">
						<div class="input-group-addon ad" style="background: #ADDFE7;">
							<span class="input-group-text">
								<i class="fa fa-key" style="color:#E4791A"></i>
							</span>                    
						</div>
						<input class="form-control" style="background: #ADDFE7;" type="password" maxlength="80"  id="txtPwd" name="txtPwd" value=""  autocomplete="off" placeholder="Password" data-placement="top" data-toggle="tooltip" title="Your Password. ex: P@ssw0rd" >
						
					</div>
				</div>
			</div>
			
			<!--<div class="row form-group" >
			  <label class ="col-lg-4"for=""><i style="color:red;font-size:18px;">*</i> Mobile : </label>
  			  <input class="form-control" style="width: 87%;margin-left: 30px;" type="text" maxlength="10"  id="txtCandidatePhone" name="txtCandidatePhone" value="<?=isset($txtCandidatePhone)?$txtCandidatePhone:''?>"  autocomplete="off" placeholder="Mobile Number" data-placement="top" data-toggle="tooltip" title="Mobile Number ex:9040123456" >
  			</div>--> 
			    <!--<div class="row form-group" >
			
			      	<label class ="col-lg-4"for=""><i style="color:red;font-size:18px;">*</i> Mobile : </label>
			      		<div class="input-group ">
							<div class="input-group-addon ad">
								<span class="input-group-text">
									<i class="fa fa-mobile" style="color:#E4791A"></i>
								</span>                    
							</div>
							<input class="form-control" type="text" maxlength="10"  id="txtCandidatePhone" name="txtCandidatePhone" value="<?=isset($txtCandidatePhone)?$txtCandidatePhone:''?>"  autocomplete="off" placeholder="Mobile Number" data-placement="top" data-toggle="tooltip" title="Mobile Number ex:9040123456" >
						</div>
			        
				</div>-->
				
			 <!--<div class="row fpad form-group" >
					<div class="col-sm-4 col-xs-4">
						<label for=""><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-calendar" style="color:#E4791A"></i> Date of Birth :</label>
				    </div>

						<div class="col-sm-8 col-xs-8">
							<input class="form-control" type="text" name="txtdob" id="txtdob" autocomplete="off" placeholder="Date of Birth(dd-mm-yyyy)" data-placement="top" data-toggle="tooltip" title="Date of Birth ex:01-01-2000" value="<?=isset($txtdob)?$txtdob:''?>" readonly/>
						</div>
					</div>-->
				
				<!--<div class="row form-group" style="margin-top: -16px;" >
				  <label class="col-lg-4" for=""><i style="color:red;font-size:18px;">*</i>Password :</label>
	  			  <input class="form-control" style="width: 87%;margin-left: 30px;" type="password" maxlength="80"  id="txtPwd" name="txtPwd" value=""  autocomplete="off" placeholder="Password" data-placement="top" data-toggle="tooltip" title="Your Password. ex: P@ssw0rd" >
	  			</div>-->
			   <!--<div class="row fpad form-group" >
					
						<label class="col-lg-4" for=""><i style="color:red;font-size:18px;">*</i>Password :</label>
				   

						<!--<div class="col-lg-8">-->
							<!--<input class="form-control" type="password" maxlength="80"  id="txtPwd" name="txtPwd" value=""  autocomplete="off" placeholder="Password" data-placement="top" data-toggle="tooltip" title="Your Password. ex: P@ssw0rd" >-->
							<!--<div class="input-group">
							<div class="input-group-addon ad">
								<span class="input-group-text">
									<i class="fa fa-key" style="color:#E4791A"></i>
								</span>                    
							</div>
							<input class="form-control" type="password" maxlength="80"  id="txtPwd" name="txtPwd" value=""  autocomplete="off" placeholder="Password" data-placement="top" data-toggle="tooltip" title="Your Password. ex: P@ssw0rd" >
						</div>-->
						<!--</div>-->
					<!--</div>-->
				

				<!--<p id="captImg12">
					
				</p>-->
				<div class="row">
					<div class="col-sm-6">
						<div class="row" align="right" style="padding-top: 0px;"> 
					        <p id="captImg12" class="center"></p>
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
				
		       
		    	<!--<div class="row fpad form-group" >
					
                      <label class="col-lg-4" for=""><i style="color:red;font-size:18px;">*</i>Captcha : </label>
					
						<!--<div class="control-label col-sm-4" style="margin-left: 0px;"> -->

						<!--<div class="col-lg-8">-->
						<!--<input class="form-control" type="text" maxlength="6" id="txtCaptcha" name="txtCaptcha"  onkeyup="this.value=this.value.toUpperCase()" autocomplete="off" placeholder="Captcha Code" >-->
						<!--<div class="input-group">
							<div class="input-group-addon ad">
								<span class="input-group-text">
									<i class="fa fa-mobile" style="color:#E4791A"></i>
								</span>                    
							</div>
							<input class="form-control" type="text" maxlength="6" id="txtCaptcha" name="txtCaptcha"  onkeyup="this.value=this.value.toUpperCase()" autocomplete="off" placeholder="Captcha Code" >
						</div>-->
						<!--</div>-->
					<!--</div>-->
                   <!--</div>-->
				     
				       <!--<div class="row" align="right" style="padding-top: 0px;"> 
				          
				         <p id="captImg12">
							<a href="javascript:void(0);" class="refreshCaptcha" id="refreshCaptcha" ><img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
						 </p>
				        
				       </div>-->
		    	

				
			
				<div class="row fpad">
			     	<span><a href="javascript:void(0);" id="loginForgotPassword" class="forgotpass">Forgot Password?</a></span>
				    <div class="col-sm-12 col-xs-6" align="center" >
			   	 			<!--<button class="btoon" type="submit" id="btnlogin" name="btnlogin"><i class="fa fa-user-plus"></i> Login</button>-->
			   	 			<button class="btnlog" type="submit" id="btnlogin" name="btnlogin"><span class="texlog">LOGIN</span></button>
		    		</div>
		    	</div>
			     <!--<div class="row fpad">
			     	<span><a href="javascript:void(0);" id="loginForgotPassword" style="color: red;font-size: 15px;margin-left: 50px">Forgot Password?</a></span>
				    <div class="col-sm-12 col-xs-6" align="center" >
			   	 		<button class="btoon" style="margin-left: 49px;width: 166px;" type="submit" id="btnlogin" name="btnlogin"><i class="fa fa-user-plus"></i> Login</button>
		    		</div>
		    	</div>-->
			</form>
        	<form class=" login-box-body" action="" method="post"  id="frmOTP" name="frmOTP" hidden >
					   <input type="hidden" id="insCode" name="insCode" value="<?php echo $inscode; ?>"/>
					   <input type="hidden" id="insEncCode" name="insEncCode" value="<?php echo $ins; ?>"/>
					    <!--<input type="hidden" id="hidProgramCode" name="hidProgramCode" value="<?php echo $program_code; ?>"/> -->

					     
				  <!-- <?php $attr=array('class'=> 'login-box-body');echo form_open('?p=registration',$attr); ?> --> 
				    	<div class="row fpad form-group">
					    	
						         <label class="col-lg-4"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;<i class="fa fa-user" style="color:#E4791A"></i>  OTP</label>
						     
						     <div class="col-lg-8">
						      <input class="form-control" type="text" name="txtOTPP" id="txtOTPP" autocomplete="off"  maxlength="4" required="" placeholder="4 Digit OTP" >
						      <!--<input class="form-control" type="text" name="txtOTP" id="txtOTP" autocomplete="off"  maxlength="4" required="" placeholder="4 Digit OTP" >-->
						     <!--  <span class="highlight"></span>
						      <span class="bar"></span> -->
						     
						    </div>
						    </div>
						     <div class="col-sm-12 col-xs-12">
			     	
							      	<a href="javascript:void(0);" class="resendOTP" id="resendOTP" onclick="resend_OTP()" >
							    	<img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/> Resend OTP</a>
							    </p>
						    </div>
						 

		                  
		                 <div class="row fpad">
						    <div class="col-sm-12 col-xs-6" align="center" >
					   	 		<button class="btoon" style="margin-left: 49px;width: 166px;" type="submit"  onclick="return validate_OTP();" id="btnVerify" name="btnVerify"><i class="fa fa-user-plus"></i> Verify</button>
				    		</div>
				    	</div>
				    </form>
				    
       </div>


     </div>

 </div>

</div>


	<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog"style="width:50%;">
			<div class="modal-content forgotmodal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<!--<h3 style="text-align: center;color: black;">Forgot Password</h3>-->
					<p class="modaltext" style="text-align: center;color: white;font-size: 18px;font-weight: 600;padding-top: 10px;">FORGOT PASSWORD</p>
					
				</div>
				<div class="modal-body" >
				
		        	<form  class="login-box-bodyy"  action="" method="post" id="frmForgotPassword" name="frmForgotPassword">
		        		<input type="hidden" id="insCode" name="insCode" value="<?php echo $inscode; ?>"/>
		        		<div class="row fpad form-group">
							<div class="col-sm-5 col-xs-5" >
							    <label class="lmb">&nbsp;&nbsp;Mobile Number</label>
				  			</div>
				  			<div class="row form-group " >
					      		<div class="input-group inpmobb">
									<div class="input-group-addon ad" style="background: #ADDFE7;">
										<span class="input-group-text">
											<i class="fa fa-mobile" style="color:#E4791A"></i>
										</span>                    
									</div>
									<input class="form-control" style="background: #ADDFE7;" type="text" maxlength="10"  id="txtForgotCandidatePhone" name="txtForgotCandidatePhone" onkeypress="return isNumberKey(event)" value="<?=isset($txtCandidatePhone)?$txtCandidatePhone:''?>"  autocomplete="off" placeholder="Mobile Number" data-placement="top" data-toggle="tooltip" title="Mobile Number ex:9040123456" >
									
								</div>
							</div>
						</div>
		        		<!--<div class="form-group">
							<div class="row form-group" >
							  <label class="col-lg-4 lMob">&nbsp;&nbsp; Mobile : </label>
				  			</div>
				  			<div class="row form-group">
					      		<div class="input-group inpmob">
									<div class="input-group-addon ad" style="background: #ADDFE7;">
										<span class="input-group-text">
											<i class="fa fa-phone" style="color:#E4791A"></i>
										</span>                    
									</div>
									<input class="form-control" style="background: #ADDFE7;" type="text" maxlength="10"  id="txtForgotCandidatePhone" name="txtForgotCandidatePhone" onkeypress="return isNumberKey(event)" value="<?=isset($txtCandidatePhone)?$txtCandidatePhone:''?>"  autocomplete="off" placeholder="Mobile Number" data-placement="top" data-toggle="tooltip" title="Mobile Number ex:9040123456" >
								</div>
							</div>
						</div>-->
					    <!--<div class="row fpad form-group" >
						    <div class="col-sm-4 col-xs-4">
						      <label class="label1">&nbsp;&nbsp; Mobile : </label>
						    </div>
					        <div class="col-sm-8 col-xs-8">
					           <input class="form-control" type="text" maxlength="10"  id="txtForgotCandidatePhone" name="txtForgotCandidatePhone" onkeypress="return isNumberKey(event)" value="<?=isset($txtCandidatePhone)?$txtCandidatePhone:''?>"  autocomplete="off" placeholder="Mobile Number" data-placement="top" data-toggle="tooltip" title="Mobile Number ex:9040123456" >
					      		<i class="fa fa-phone  icon"></i>
					        </div>
						</div>-->
					 	<h5 style="text-align: center; color: #FFF;">OR</h5>
					 	<div class="row fpad form-group">
							<div class="col-sm-5 col-xs-5" >
							    <label class="lmb">&nbsp;&nbsp;Email Id</label>
				  			</div>
				  			<div class="row form-group " >
					      		<div class="input-group inpmobb">
									<div class="input-group-addon ad" style="background: #ADDFE7;">
										<span class="input-group-text">
											<i class="fa fa-envelope" style="color:#E4791A"></i>
										</span>                    
									</div>
									<input class="form-control" style="background: #ADDFE7;" type="text" name="txtForgotEmail" id="txtForgotEmail"  placeholder="Email" autocomplete="off" maxlength="80" value="<?=isset($txtEmail)?$txtEmail:''?>"  data-placement="top" data-toggle="tooltip" title="Your Email-id. ex: xyz@gmail.com">
									
								</div>
							</div>
						</div>
					 	<!--<div class="form-group">
							<div class="row form-group" >
							  <label class="col-lg-4 lMob">&nbsp;&nbsp; Email Id : </label>
				  			</div>
				  			<div class="row form-group">
					      		<div class="input-group inpmob">
									<div class="input-group-addon ad" style="background: #ADDFE7;">
										<span class="input-group-text">
											<i class="fa fa-envelope" style="color:#E4791A"></i>
										</span>                    
									</div>
									<input class="form-control" style="background: #ADDFE7;" type="text" name="txtForgotEmail" id="txtForgotEmail"  placeholder="Email" autocomplete="off" maxlength="80" value="<?=isset($txtEmail)?$txtEmail:''?>"  data-placement="top" data-toggle="tooltip" title="Your Email-id. ex: xyz@gmail.com">
								</div>
							</div>
						</div>-->
					 	<!--<div class="row fpad form-group" >
						    <div class="row form-group" >
							  <label class="col-lg-4 lMob">&nbsp;&nbsp; Email Id : </label>
				  			</div>
					        <div class="col-sm-8 col-xs-8 inpmob">     
						  		<input class="form-control" type="text" name="txtForgotEmail" id="txtForgotEmail"  placeholder="Email" autocomplete="off" maxlength="80" value="<?=isset($txtEmail)?$txtEmail:''?>"  data-placement="top" data-toggle="tooltip" title="Your Email-id. ex: xyz@gmail.com">
						 		<i class="fa fa-envelope icon"></i>
						 	</div>
						</div>-->
						<!--<div class="row fpad form-group" >
						    <div class="col-sm-4 col-xs-4">
						      <label class="label1">&nbsp;&nbsp;Email Id : </label>
						    </div>
					        <div class="col-sm-8 col-xs-8">     
						  		<input class="form-control" type="text" name="txtForgotEmail" id="txtForgotEmail"  placeholder="Email" autocomplete="off" maxlength="80" value="<?=isset($txtEmail)?$txtEmail:''?>"  data-placement="top" data-toggle="tooltip" title="Your Email-id. ex: xyz@gmail.com">
						 		<i class="fa fa-envelope icon"></i>
						 	</div>
						</div>-->
						<div class="row">
							<div class="col-sm-6">
								<div class="row" align="right" style="padding-top: 0px;"> 
							        <p id="captImg5" class="center"></p>
							    </div>
							</div>
							<div class="col-sm-6">
								<div class="row form-group" style="margin-top: 0;" >
							       	<div class="col-lg-10">
							       		<input class="form-control capinpp" type="text" maxlength="6" id="txtCaptcha5" name="txtCaptcha5" onkeyup="this.value=this.value.toUpperCase()" autocomplete="off" placeholder="Captcha Code" >
							       	</div>
					  			   	<div class="col-lg-2">
					  			   		<a href="javascript:void(0);" onclick="refresh_captcha5()" class="refreshCaptcha5" id="refreshCaptcha5" ><img class="refreshimgg" src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
					  			   	</div>
			  		   			</div>
							</div>
						</div>
						
						<!--<div class="col-sm-12 col-xs-12">
					     	<p id="captImg5" align="center">
						    </p>
					    </div>
						<div class="row form-group" style="margin-top: -9px;">
						  <label class="col-lg-4"><i style="color:red;font-size:18px;">*</i>Captcha Code</label>
						  <div class="col-lg-10">
						  		<input class="form-control capinp" type="text" maxlength="6" id="txtCaptcha5" name="txtCaptcha5"  onkeyup="this.value=this.value.toUpperCase()" autocomplete="off" placeholder="Captcha" >
					       </div>
			  			   <div class="col-lg-2">
			  			   		<a href="javascript:void(0);" onclick="refresh_captcha5()" class="refreshCaptcha5" id="refreshCaptcha5" ><img class="refreshimg" src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
			  			   </div>
						</div>-->
				    	<!--<div class="row fpad form-group" >
							<div class="col-md-4 col-xs-4">
		                      <label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;  Captcha : </label>
							</div>

							<div class="col-md-8 col-xs-8">
								 <input class="form-control" type="text" maxlength="6" id="txtCaptcha5" name="txtCaptcha5"  onkeyup="this.value=this.value.toUpperCase()" autocomplete="off" placeholder="Captcha" >
								<i class="fa fa-shield icon"></i>	
							</div>
	                   </div>
						     
					    <div class="row" style="padding-top: 0px;"> 
					          
					         <p id="captImg5" align="right" >
									<a href="javascript:void(0);" class="refreshCaptcha5" id="refreshCaptcha5" ><img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
								</p>
					    </div>-->
					    <div class="row fpad">
						    <div class="col-sm-12 col-xs-6" align="center" >
						    	<button class="btnforgot" type="submit" id="btnForgotPassword" onclick="return validate_forgot_password();"  name="btnForgotPassword"><span class="texlog"> Get OTP</span></button>
					   	 		<!--<button class="btoon_1" style="width: 166px;" type="submit" id="btnForgotPassword" onclick="return validate_forgot_password();"  name="btnForgotPassword"><i class="fa fa-cogs"></i> Get OTP</button>-->
				    		</div>
				    	</div>
				    	
				    	<div class="row fpad form-group" id="newPassword" style="padding-top: 20px;">
							<div class="col-sm-offset-1 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> 
							 		<label class="lmb1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;OTP: </label>
							 	</div>
							 	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 form-group " >
						      		<div class="input-group inpotp">
										<div class="input-group-addon ad" style="background: #ADDFE7;">
											<span class="input-group-text">
												<i class="fa fa-key" style="color:#E4791A"></i>
											</span>                    
										</div>
										<input class="form-control" style="background: #ADDFE7;" type="text" name="txtOTP" id="txtOTP" required="" placeholder="OTP" autocomplete="off" maxlength="80" value=""  data-placement="top" data-toggle="tooltip">
										
									</div>
								</div>
							 	<!--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> 
							 		<label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;OTP: </label>
							 	</div>
							 	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">     
							  		<input class="form-control" type="text" name="txtOTP" id="txtOTP" required="" placeholder="OTP" autocomplete="off" maxlength="80" value=""  data-placement="top" data-toggle="tooltip">
							 		<i class="fa fa-key icon"></i> 
							 	</div>-->
							 	<div class="col-sm-2 col-xs-2">
							 		<a href="javascript:void(0);" class="resendOTP"  data-placement="top" data-toggle="tooltip" title="Resend OTP" id="resendOTP" ><img class="reotp" src="<?php echo base_url().'public/assets/images/resend.png'; ?>"/></a>
							 	</div>
							</div>
							<div class="row" style="margin-top: 14%">
							    <div class="col-sm-12 col-xs-6" align="center" >
							    	<button class="btnotp" type="button" id="btnChangePassword" name="btnChangePassword"><span class="texlog"> Submit</span></button>
						   	 		<!--<button class="btoon_1" style="width: 166px;" type="button" id="btnChangePassword" name="btnChangePassword"><i class="fa fa-user-plus"></i> Submit</button>-->
					    		</div>
					    		</div>
					    	</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="newPasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog"style="width:50%;">
			<div class="modal-content newpassword">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<p class="newtxt">New Password</p>
				</div>
				<div class="modal-body" >
		        	<form  class=" login-box-body"  action="" method="post" id="frmNewPassword" name="frmNewPassword">
		        		<input type="hidden" id="hidRegUserId" name = "hidRegUserId"/>
		        		<input type="hidden" id="hidMailId"  name = "hidMailId"/>
					    <div class="row fpad form-group">
							<div class="col-sm-12 col-xs-12">
								<div class="col-sm-4 col-xs-4"> 
							 		<label class="lnwpas"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Password </label>
							 	</div>
							 	<div class="col-sm-8 col-xs-8">     
							 		<div class="input-group newpas">
										<div class="input-group-addon ad" style="background: #ADDFE7;">
											<span class="input-group-text">
												<i class="fa fa-key" style="color:#E4791A"></i>
											</span>                    
										</div>
										<input class="form-control" style="background: #ADDFE7;" type="password" name="txtPassword2" id="txtPassword2" required="" placeholder="Password" autocomplete="off" maxlength="80" value=""  data-placement="top" data-toggle="tooltip" title="Your Password. ex: P@ssw0rd">
									</div>
							 	</div>
							</div>
						</div>
						<div class="row fpad form-group">
							<div class="col-sm-12 col-xs-12">
								<div class="col-sm-4 col-xs-4"> 
							 		<label class="lnwpas"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Confirm Password  </label>
							 	</div>
							 	<div class="col-sm-8 col-xs-8">     
							  		 <div class="input-group newpas">
										<div class="input-group-addon ad" style="background: #ADDFE7;">
											<span class="input-group-text">
												<i class="fa fa-key" style="color:#E4791A"></i>
											</span>                    
										</div>
										<input class="form-control" style="background: #ADDFE7;" type="password" name="txtConfirmPassword2" id="txtConfirmPassword2" required="" placeholder="Confirm Password" autocomplete="off" maxlength="80" value=""  data-placement="top" data-toggle="tooltip" title="Your Password. ex: P@ssw0rd">
									</div>
							 	</div>
							 	<!--<div class="col-sm-8 col-xs-8">     
							  		<input class="form-control" type="password" name="txtConfirmPassword2" id="txtConfirmPassword2" required="" placeholder="Confirm Password" autocomplete="off" maxlength="80" value=""  data-placement="top" data-toggle="tooltip" title="Your Password. ex: P@ssw0rd">
							 		<i class="fa fa-key icon"></i> 
							 	</div>-->
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-6">
								<p id="captImg6" class="captImg" align="center" >
									<!--<a href="javascript:void(0);" class="refreshCaptcha6" id="refreshCaptcha6" ><img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>-->
								</p>
							</div>
							<div class="col-sm-6">
								<div class="row form-group">
							  		<div class="col-lg-8">
							  			<input class="form-control capinpass" type="text" maxlength="6"  name="txtCaptcha6" id="txtCaptcha6" onkeyup="this.value=this.value.toUpperCase()" autocomplete="off" placeholder="Captcha">
						       		</div>
					  			   	<div class="col-lg-2">
					  			   		<a href="javascript:void(0);" onclick="refresh_captcha6()" class="refreshCaptcha6" id="refreshCaptcha6" ><img class="refreshimgpass" src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
					  			   	</div>
								</div>	
							</div>
						</div>
						
						
						
				    	<!--<div class="row fpad form-group">
				    		<div class="col-sm-12 col-xs-12">
								<div class="col-md-4 col-xs-4">
			                      <label class="label1"><i style="color:red;font-size:18px;">*</i>&nbsp;&nbsp;Captcha : </label>
								</div>

								<div class="col-md-8 col-xs-8">
									 <input class="form-control" type="text" maxlength="6" id="txtCaptcha6" name="txtCaptcha6"  onkeyup="this.value=this.value.toUpperCase()" autocomplete="off" placeholder="Captcha" >
									<i class="fa fa-shield icon"></i>	
								</div>
							</div>
	                   </div>
						     
					    <div class="row" style="padding-top: 0px;"> 
					          
					         <p id="captImg6" align="right" >
									<a href="javascript:void(0);" class="refreshCaptcha6" id="refreshCaptcha6" ><img src="<?php echo base_url().'public/assets/images/refresh.png'; ?>"/></a>
								</p>
					    </div>-->
					    <div class="row fpad">
						    <div class="col-sm-12 col-xs-6" align="center" >
						    	<button class="btnpass" type="submit" id="btnChangePwd" name="btnChangePwd"><span class="texlog"> SUBMIT</span></button>
					   	 		<!--<button class="btoon_1" style="width: 166px;" type="submit" id="btnChangePwd" name="btnChangePwd" ><i class="fa fa-cogs"></i> Submit</button>-->
				    		</div>
				    	</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</section>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrapValidator.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/sha512.js"></script>
<script>

	$.ajax({
		url:base_url+"ajax_controller/general_info",  
		type:"post",
		//data:{'admcode':admcode},
		success:function(response){ 
			var obj = JSON.parse(response);
			//console.log('67567',obj);
			if(obj[0]['instruction'] != undefined && obj[0]['instruction'] != '')
			{
				$('#generalinfo_text').html(obj[0]['instruction']);	
				//$('#generalinfo').show();
			}
			else
			{
				toastr.error("We are unable to Process.Please contact Support");
			}
				
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support"); 
		}
	});

	
	$.ajax({
		url:base_url+"ajax_controller/create_captcha",
		type:"post",
		success:function(response){ 
			var value = 'hello';
			refresh = base_url + 'public/assets/images/refresh.png';
			//var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha" onclick="refresh_captcha()"  id="refreshCaptcha" ><img src="'+refresh+'?v=<?php echo rand();?>"/></a>';
			var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha" onclick="refresh_captcha()"  id="refreshCaptcha" ></a>';
			$("#captImg12").html(res);	
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	//refresh_captcha();
	function refresh_captcha()
	{
		$.get(base_url+'ajax_controller/refresh_captcha', function(data){
			refresh = base_url + 'public/assets/images/refresh.png';
			//var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha" onclick="refresh_captcha()"  id="refreshCaptcha" ><img src="'+refresh+'?v=<?php echo rand();?>"/></a>';
			var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha" onclick="refresh_captcha()"  id="refreshCaptcha" ></a>';
			$("#captImg12").html(data);
			//$("#captImg13").html(data);
	    });
	}
	function resend_OTP()
	{
	  var formData = new FormData(document.getElementById("frm_login"));
	   $("#spanLoginloader").show();
	  $.ajax({
				url:base_url+"ajax_controller/send_pro_otp_login",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response)
				{  
					 $("#spanLoginloader").show();
					var result = JSON.parse(response);
					if(result.status == "SUCCESS")
					{
						//alert("sdfdsfsd");return;
						toastr.success("OTP has been sent successfully.");
						
						
					}
					
					
					
					
				},
				error:function()
				{
					toastr.error('Unable to Save.Please Try Again ');	
				}
			});
		
	}
	function refresh_captcha5()
	{
	   $.get(base_url+'ajax_controller/refresh_captcha', function(data){
	   refresh = base_url + 'public/assets/images/refresh.png';
	   //var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha5" onclick="refresh_captcha5()"  id="refreshCaptcha5" ><img src="'+refresh+'"/></a>';
	   var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha5" onclick="refresh_captcha5()"  id="refreshCaptcha5" ></a>';
	   	$("#captImg5").html(data);
	   });
	   $("#txtCaptcha5").val('');
	   $('#frmForgotPassword').data('bootstrapValidator').updateStatus('txtCaptcha5', 'NOT_VALIDATED', null).validateField('txtCaptcha5');
	}
	
	function refresh_captcha6()
	{
	   $.get(base_url+'ajax_controller/refresh_captcha', function(data){
	   refresh = base_url + 'public/assets/images/refresh.png';
	   //var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha6" onclick="refresh_captcha6()"  id="refreshCaptcha6" ><img src="'+refresh+'"/></a>';
	   var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha6" onclick="refresh_captcha6()"  id="refreshCaptcha6" >';
	   	$("#captImg6").html(data);
	   });
	   $("#txtCaptcha6").val('');
	   $('#frmNewPassword').data('bootstrapValidator').updateStatus('txtCaptcha6', 'NOT_VALIDATED', null).validateField('txtCaptcha6');
	}
	function validate_forgot_password(){
		
		if((document.getElementById('txtForgotCandidatePhone').value == '' || document.getElementById('txtForgotCandidatePhone').value == null) && (document.getElementById('txtForgotEmail').value == '' || document.getElementById('txtForgotEmail').value == null))
		{
			toastr.error("Mobile No Or Email Id One of Them is Required");
			return false;
		}
		return true;
	}
	function validate_OTP(){
		var errorMessage = "";
		var message='<div>';
		//if($("#txtOTP").val() == '')
		if($("#txtOTPP").val() == '')
		{
			$('#frmOTP').data('bootstrapValidator').updateStatus('txtOTPP', 'NOT_VALIDATED', null).validateField('txtOTPP');
			//$('#frmOTP').data('bootstrapValidator').updateStatus('txtOTP', 'NOT_VALIDATED', null).validateField('txtOTP');
			//$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			
			//toastr.error("Please enter username and password");
			//$("#txtOTP").focus();
			$("#txtOTPP").focus();
			return false;
		}
		
		
		
		return true;
			
	}
	
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip(); //for tooltip
		// for disable write click and copy past  code start
			
			$(document).bind("contextmenu",function(e){
			   return false;
			});
			$('body').bind('cut copy paste', function (e) {
		        e.preventDefault();
		    });
		//refresh_captcha();
		$('#frmOTP').bootstrapValidator({
	        message: 'This value is not valid',
	        /*feedbackIcons: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },*/
			submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{
				//document.getElementById('txtPassword').type="password";
				var formData = $('#frmOTP, #frmApplyNew').serialize();
				
				$.ajax({
					url:base_url+"Index/otp_verification",
					type:"post",
					data:formData,
					
					success:function(response)
					{  
						
						var result = JSON.parse(response);
						if(result.status == "SUCCESS")
						{
							//alert("sdfdsfsd");return;
							swal({
								title: "Registration",
								text: "Congratulation!!! Your registration successfully completed. Please proceed for login.",
								//type: "success"
							},
							function(isConfirm) {
							  if (isConfirm) {
							    window.location.href = ("<?php echo base_url() ?>Index/institute_login/ins/<?php echo $ins ?>");
							   
							}
							});
							
						}
						else if(result.status == 'ERROR1')
						{
							swal({
								title: "Registration",
								text: "You have already registered with this mobile no. Please check your mail or sms for OTP Verification.",
								//type: "success"
							},
							function(isConfirm) {
							  if (isConfirm) {
							  	 $("#frmOTP").show();
							   $("#frmApplyNew").hide();
							  
							   
							}
							});
						}
						else
						{
							if(result.status == 'captchaerror')
							{
								swal({
									title: "Captcha Error",
									text: "Invalid Captcha",
									//type: "error"
								},
								function(isConfirm) {
								  if (isConfirm) {
									$("#txtCaptcha").val('');
									$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha');
									refresh_captcha();
									$('.loadingRPimage').fadeIn(250);								}
								});	
								
							}
							else if(result.status == 'ERROR')
							{
								
									$('#frmOTP').data('bootstrapValidator').updateStatus('txtOTPP', 'NOT_VALIDATED', null).validateField('txtOTPP');
									//$('#frmOTP').data('bootstrapValidator').updateStatus('txtOTP', 'NOT_VALIDATED', null).validateField('txtOTP');
									toastr.error("Incorrect OTP");							
									
							}
							else
							{
								swal({
									title: "Error",
									text: result.msg,
									//type: "error"
								},
								function(isConfirm) {
								  if (isConfirm) {
									$("#txtPassword").val('');
									$("#txtConfirmPassword").val('');
									$("#txtEmail").val('');
									$("#txtCaptcha1").val('');
									refresh_captcha();
									$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
									$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtPassword', 'NOT_VALIDATED', null).validateField('txtPassword');
									$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
									$('.loadingRPimage').fadeIn(250);						}
								});	
								
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
				txtOTPP: {
	                validators: {
	                    notEmpty: {
	                        message: 'Please Enter State'
	                    }
					}
				}
			}
		});
		$('#frmForgotPassword').bootstrapValidator({
	        message: 'This value is not valid',
			submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{
				var formData = new FormData(document.getElementById("frmForgotPassword"));
				var insEncCode = $("#insEncCode").val();
				$.ajax({
					url:base_url+"Index/registration_forgot_password",
					type:"post",
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response)
					{  
						var result = JSON.parse(response);
						if(result.status == "SUCCESS")
						{
							refresh_captcha6();
							swal({
								title: "OTP",
								text: "Please check your Mail id  for OTP. To change your password OTP is mandatory",
								//type: "success"
								},
								function(isConfirm) {
								  if (isConfirm) {
								    $("#newPassword").show();
								  }
								});
									
							var phone_no = $("#txtForgotCandidatePhone").val();
							var mail_id = $("#txtForgotEmail").val();
							$('#hidRegUserId').val(phone_no);					
							$('#hidMailId').val(mail_id);					
						}
						else 
						{
							if(result.msg == 'Invalid Captcha. Please try again.')
							{
								swal({
									title: "Captcha Error",
									text: "Invalid Captcha",
									//type: "error"
								},
								function(isConfirm) {
								  if (isConfirm) {
									$("#txtCaptcha5").val('');
									$('#frmForgotPassword').data('bootstrapValidator').updateStatus('txtCaptcha5', 'NOT_VALIDATED', null).validateField('txtCaptcha5');
									refresh_captcha5();
									$('.loadingRPimage').fadeIn(250);								}
								});	
								
							}
							else
							{
								//toastr.error(result.msg);	
								swal({
									title: "Error",
									text: result.msg,
									//type: "error"
								},
								function(isConfirm) {
								  if (isConfirm) {
									$('.loadingRPimage').fadeIn(250);								}
								});	
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
	        
				txtForgotCandidatePhone: {
	                validators: {
	                	/*notEmpty: {
	                        message: 'Please Enter Mobile No'
	                    },*/
	                    integer:{
							message:'Only numbers are allowed'
						}, 
						stringLength: {
							max: 10,
							min: 10,
							message: 'Mobile no must be 10 characters'
						}
	                }
	            },
				txtForgotEmail: {
	                validators: {
	                   
						emailAddress: {
	                        message: 'The value is not a valid email address'
	                    }
	                }
	            },
				txtCaptcha5: {
	                validators: {
	                    notEmpty: {
	                        message: 'Please Enter Captcha'
	                    },
	                    
						regexp: {
	                        regexp: /^([A-Za-z0-9]+)$/,
	                        message: "Special characters are not allowed"
						}, 
						stringLength: {
							max: 6,
							min: 6,
							message: 'Captcha must be 6 characters'
						}
	                }
	            },
				txtOTP: {
	                validators: {
	                    notEmpty: {
	                        message: 'Please Enter OTP'
	                    },
	                    integer:{
							message:'Only numbers are allowed'
						}, 
						stringLength: {
							max: 4,
							min: 4,
							message: 'OTP must be 4 characters'
						}
	                }
	            }
			}	
      	});	
      	/*$('#btnChangePwd').click(function(){ 
			var errorMessage = "";
			var message='<div>';
			if($("#txtPassword2").val() == '')
			{
				$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtPassword2', 'NOT_VALIDATED', null).validateField('txtPassword2');
				$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtConfirmPassword2', 'NOT_VALIDATED', null).validateField('txtConfirmPassword2');
				$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtCaptcha6', 'NOT_VALIDATED', null).validateField('txtCaptcha6');
				//toastr.error("Please enter username and password");
				$("#txtPassword2").focus();
				return false;
			}
			if($("#txtConfirmPassword2").val() == '')
			{
				$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtPassword2', 'NOT_VALIDATED', null).validateField('txtPassword2');
				$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtConfirmPassword2', 'NOT_VALIDATED', null).validateField('txtConfirmPassword2');
				$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtCaptcha6', 'NOT_VALIDATED', null).validateField('txtCaptcha6');
				//toastr.error("Please enter username and password");
				$("#txtConfirmPassword2").focus();
				return false;
			}
			if($("#txtCaptcha6").val() == '')
			{
				$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtPassword2', 'NOT_VALIDATED', null).validateField('txtPassword2');
				$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtConfirmPassword2', 'NOT_VALIDATED', null).validateField('txtConfirmPassword2');
				$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtCaptcha6', 'NOT_VALIDATED', null).validateField('txtCaptcha6');
				//toastr.error("Please enter username and password");
				$("#txtCaptcha6").focus();
				return false;
			}
			
			
			var reg_user_id = document.getElementById("hidRegUserId").value; 
			var txtNewPassword1 = document.getElementById("txtPassword2").value; 
			var encSaltSHAPassMobile = encryptShaPassCode(reg_user_id,txtNewPassword1);
			$('#txtPassword2').val(encSaltSHAPassMobile);
			$('#txtConfirmPassword2').val(encSaltSHAPassMobile);
			
			return true;
			
		});*/
		$('#frmNewPassword').bootstrapValidator({
	        message: 'This value is not valid',
			submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{
				
				var reg_user_id = document.getElementById("hidRegUserId").value; 
				var txtNewPassword1 = document.getElementById("txtPassword2").value; 
				var encSaltSHAPassMobile = encryptShaPassCode(reg_user_id,txtNewPassword1);
				$('#txtPassword2').val(encSaltSHAPassMobile);
				$('#txtConfirmPassword2').val(encSaltSHAPassMobile);
				var str = $("#txtPassword2").val();
				var a = str.match(/TEST/i);
				var b = str.match(/DEMO/i);
				var c = str.match(/PASSWORD/i);
				if(a || b || c)
				{
					toastr.error("Easily Guessable Passwords are not allowed");
					$("#txtPassword2").val('');
					$("#txtConfirmPassword2").val('');
					$("#txtPassword2").focus();
					return false;
				}
				var formData = new FormData(document.getElementById("frmNewPassword"));
				$.ajax({
					url:base_url+"Index/registration_new_password",
					type:"post",
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response)
					{  
						var result = JSON.parse(response);
						if(result.status == "SUCCESS")
						{
							swal({
								title: "Password",
								text: "Congratulation!!! Your password has been changed successfully.",
								//type: "success"
							},
							function(isConfirm) {
							  if (isConfirm) {
							   $('#newPasswordModal').modal('hide');
							   window.location.reload();
							   /*refresh_captcha4();
							   $('#loginModal').modal('show')*/
							  }
							});
							
						}
						else 
						{
							if(result.status == 'captchaerror')
							{
								swal({
									title: "Error",
									text: result.msg,
									//type: "error"
								},
								function(isConfirm) {
								  if (isConfirm) {
									$("#txtPassword2").val('');
									$("#txtConfirmPassword2").val('');
									$("#txtCaptcha6").val('');
									$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtPassword2', 'NOT_VALIDATED', null).validateField('txtPassword2');
									$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtConfirmPassword2', 'NOT_VALIDATED', null).validateField('txtConfirmPassword2');
									$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtCaptcha6', 'NOT_VALIDATED', null).validateField('txtCaptcha6');
									refresh_captcha6();
									$('.loadingRPimage').fadeIn(250);							}
								});	
							}
							else
							{
								swal({
									title: "Error",
									text: result.msg,
									//type: "error"
								},
								function(isConfirm) {
								  if (isConfirm) {
									toastr.error(result.msg);	
									$("#txtPassword2").val('');
									$("#txtConfirmPassword2").val('');
									$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtPassword2', 'NOT_VALIDATED', null).validateField('txtPassword2');
									$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtConfirmPassword2', 'NOT_VALIDATED', null).validateField('txtConfirmPassword2');
									$('.loadingRPimage').fadeIn(250);					}
								});	
								
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
				txtPassword2: {
					validators: {
						notEmpty: {
							message: 'This field can\'t left blank'
						},
	            		regexp: {
							regexp: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[$@!%?&]).{6,12}$/,
							message: "The password should contain Minimum 6 and Maximum 12 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character:"
						}/*,
						identical: {
		                    field: 'txtConfirmPassword2',
		                    message: 'New password and its confirm are not the same'
	                	}*/
					}
				},
				txtConfirmPassword2: {
					validators: {
						notEmpty: {
							message: 'This field can\'t left blank'
						},
						identical: {
		                    field: 'txtPassword2',
		                    message: 'New password and its confirm are not the same'
	                	}
					}
				},
				txtCaptcha6: {
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
							message: 'Captcha must be 6 characters'
						}
	                }
	            }	
			}
		});
		
		$("#txtPassword2").change(function(){
			$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtConfirmPassword2', 'NOT_VALIDATED', null).validateField('txtConfirmPassword2');	
		});
		

		$('#btnChangePassword').click(function(){ 
		//alert(1);
		if($("#txtOTP").val() == '')
		{
			alert(3);
			$('#frmForgotPassword').data('bootstrapValidator').updateStatus('txtOTP', 'NOT_VALIDATED', null).validateField('txtOTP');
			$('#frmForgotPassword').focus(); // Focusing the textbox
		}
		else
		{
			alert(2);
			var institutedata =
			{
				txtOTP:$('#txtOTP').val(),
				txtForgotCandidatePhone:$('#txtForgotCandidatePhone').val(),
				txtForgotEmail:$('#txtForgotEmail').val()
			};		
			$.ajax({
				url:base_url+"ajax_controller/check_forgot_password_otp",
				type:"post",
				data:institutedata,
				success:function(response){  
					
					var res1 = JSON.parse(response);
					if(res1.status == "SUCCESS")
					{
						$('#loginModal').modal('hide');
						$('#forgotPasswordModal').modal('hide');
						$('#registrationModal').modal('hide');
						$('#newPasswordModal').modal('show');
						
						// New Password Captcha
						$.ajax({
						  url:base_url+"ajax_controller/create_captcha",
						  type:"post",
						  success:function(response){ 
						   var value = 'hello';
						   refresh = base_url + 'public/assets/images/refresh.png';
						   //var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha6" onclick="refresh_captcha6()"  id="refreshCaptcha6" ><img src="'+refresh+'"/></a>';
						   var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha6" onclick="refresh_captcha6()"  id="refreshCaptcha6" ></a>';
						   $("#captImg6").html(res); 
						   //$("#captImg1").html(res); 
						  },
						  error:function(){
						   toastr.error("We are unable to Process.Please contact Support");
						  }
						});
						
						refresh_captcha6();
						$("#newPassword").show();		
						var phone_no = $("#txtForgotCandidatePhone").val();
						var mail_id = $("#txtForgotEmail").val();
						$('#hidRegUserId').val(phone_no);					
						$('#hidMailId').val(mail_id);	
						
					}
					else 
					{
						toastr.error(res1.msg);
						$("#txtOTP").val('');
						$('#frmForgotPassword').data('bootstrapValidator').updateStatus('txtOTP', 'NOT_VALIDATED', null).validateField('txtOTP');
						
					}
					
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		}
		
	});
		
		$('#loginForgotPassword').click(function(){ 
			refresh_captcha5();
			$('#frmForgotPassword').bootstrapValidator('resetForm', true);
			$('#loginModal').modal('hide');
			$("#newPassword").hide();
			$('#AdminloginModal').modal('hide');
			$('#registrationModal').modal('hide');
			$('#forgotPasswordModal').modal('show');
			// Forgot Password Captcha
			$.ajax({
			  url:base_url+"ajax_controller/create_captcha",
			  type:"post",
			  success:function(response){ 
			   var value = 'hello';
			   refresh = base_url + 'public/assets/images/refresh.png';
			   //var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha5" onclick="refresh_captcha5()"  id="refreshCaptcha5" ><img src="'+refresh+'"/></a>';
			   var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha5" onclick="refresh_captcha5()"  id="refreshCaptcha5" ></a>';
			   $("#captImg5").html(res); 
			   //$("#captImg1").html(res); 
			  },
			  error:function(){
			   toastr.error("We are unable to Process.Please contact Support");
			  }
			});
			
			$('#forgotPasswordModal').on('shown.bs.modal', function () 
			{ 
				$('#txtForgotCandidatePhone').focus(); // Focusing the textbox
			})
			
		});
		
		/*$('#resendOTP').click(function(){ 
			var institutedata =
			{
				txtForgotCandidatePhone:$('#txtForgotCandidatePhone').val(),
				txtForgotEmail:$('#txtForgotEmail').val(),
				insCode:$('#insCode').val()
			};
			$.ajax({
				url:base_url+"Index/registration_forgot_password",
				type:"post",
				data:institutedata,
				success:function(response)
				{  
					var result = JSON.parse(response);
					if(result.status == "SUCCESS")
					{
						refresh_captcha6();
						$("#newPassword").show();		
						var phone_no = $("#txtForgotCandidatePhone").val();
						var mail_id = $("#txtForgotEmail").val();
						$('#hidRegUserId').val(phone_no);					
						$('#hidMailId').val(mail_id);					
					}
					else 
					{
						if(result.msg == 'Invalid Captcha. Please try again.')
						{
							toastr.error(result.msg);	
							$("#txtCaptcha5").val('');
							$('#frmForgotPassword').data('bootstrapValidator').updateStatus('txtCaptcha5', 'NOT_VALIDATED', null).validateField('txtCaptcha5');
							refresh_captcha5();
							$('.loadingRPimage').fadeIn(250);
						}
						else
						{
							toastr.error(result.msg);	
							$('.loadingRPimage').fadeIn(250);
						}
						
					}
					
				},
				error:function()
				{
					toastr.error('Unable to Save.Please Try Again ');	
				}
			});
			
		});*/
		// for disable write click and copy past code end
	
		/*$('#txtdob').datepicker({
		    format: "dd-mm-yyyy",
			todayHighlight:true,
			autoclose:true,
			endDate:"+0d"
	    }).on('changeDate', function(e) { 
			$('#frm_login').data('bootstrapValidator').updateStatus('txtdob', 'VALID', null);
		});*/
	   
		$('#frm_login').bootstrapValidator({
	        message: 'This value is not valid',
	       /* feedbackIcons: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },*/
			submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{	document.getElementById('txtPwd').type="password";
				md5KeyValue = "<?php echo $this->session->userdata('key');?>";
			
				var reg_user_id = document.getElementById("txtCandidatePhone").value; 
				var confirmpassword = document.getElementById("txtPwd").value; 
				/*alert(reg_user_id);
				alert(md5KeyValue);
				alert(confirmpassword);*/
				var encSaltSHAPassConfirm = encryptSha2LoginPassword(md5KeyValue,reg_user_id,confirmpassword);
				
				document.getElementById("txtPwd").value = encSaltSHAPassConfirm; //changed
				var formData = new FormData(document.getElementById("frm_login"));
				var insEncCode = $("#insEncCode").val();
				$.ajax({
					url:base_url+"Index/registration_login",
					type:"post",
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response)
					{  
						var result = JSON.parse(response);
						//alert(result.status);
						if(result.status == "SUCCESS")
						{
							
							window.open(base_url+"apply/institute_page/ins/"+insEncCode,"_self");
							
						}
						else if(result.status == 'ERROR1')
						{
							swal({
								title: "Registration",
								text: "You have not verified your mobile and email id. Please check your mail or sms for OTP Verification.",
								//type: "success"
							},
							function(isConfirm) {
							  if (isConfirm) {
							   $("#frm_login").hide();
							   $("#frmOTP").show();
							   
							}
							});
						}
						else 
						{
							if(result.msg == 'Invalid Captcha. Please try again.')
							{
							
								swal({
									title: "Error",
									text: result.msg,
									//type: "error"
								},
								function(isConfirm) {
								  if (isConfirm) {
									$("#txtPwd").val('');
									$("#txtCaptcha").val('');
									$('#frm_login').data('bootstrapValidator').updateStatus('txtPwd', 'NOT_VALIDATED', null).validateField('txtPwd');
									$('#frm_login').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha');
									refresh_captcha();
									$('.loadingRPimage').fadeIn(250);					}
								});
								
								//toastr.error(result.msg);	
								
							}
							else
							{
								swal({
									title: "Error",
									text: result.msg,
									//type: "error"
								},
								function(isConfirm) {
								  if (isConfirm) {
									$("#txtPwd").val('');
									$("#txtCaptcha").val('');
									$('#frm_login').data('bootstrapValidator').updateStatus('txtPwd', 'NOT_VALIDATED', null).validateField('txtPwd');
									$('#frm_login').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha');
									refresh_captcha();	
									enable_logout(result.logoutopt);				
									}
								});
								//toastr.error(result.msg);	
								
								//enable_logout(result.logoutopt);
								//$('.loadingRPimage').fadeIn(250);
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
				txtCandidatePhone: {
	                validators: {
	                	notEmpty: {
	                        message: 'Please Enter Mobile No'
	                    },
	                    integer:{
							message:'Only numbers are allowed'
						}, 
						stringLength: {
							max: 10,
							min: 10,
							message: 'Mobile no must be 10 characters'
						}
	                }
	            },
				txtPwd: {
	                validators: {
	                    notEmpty: {
	                        message: 'Required'
	                    }
	                }
	            },
				txtCaptcha: {
	                validators: {
	                    notEmpty: {
	                        message: 'Please Enter Captcha'
	                    }
	                }
	            }
			}	
      	});	
    });
    function enable_logout(logoutopt){
		if(logoutopt=='YES'){
			/*confirmReturn = confirm("You have already sign-in with another system");
			if(confirmReturn){*/
				 $.ajax({
					url:base_url+"ajax_controller/logout_all_system",
					type:"post",
					data:{ txtPhoneNo:$('#txtCandidatePhone').val() },
					success:function(response){ 
						window.location.reload();	
					},
					error:function(){
						toastr.error("We are unable to Process.Please contact Support");
					}
				});
			
		}
	}
</script>