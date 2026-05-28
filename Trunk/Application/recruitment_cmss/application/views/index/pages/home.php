 <?php 
 date_default_timezone_set('Asia/Kolkata');
 $now = date('Y-m-d H:i:s', now());
  //echo '<pre>';
	 //print_r($notice_data); 
	 //echo "----------------------------------post1------------------------------------";
	 //print_r($corrigendum_data);
	// echo "---------------------post-------------------------------------------------";
	// print_r($post_name);
	//die;
	//$inscode1 = $this->session->set_userdata('ins_code', $institute);
	$logo = '';
	$inscode = '';
	$ins = '';
	$program_data1[0] = $program_data;
	$insname = '';
	$institute_code = $this->uri->segment(4);
	foreach($institute as $row){
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
	$logo = '';
	$inscode = '';
	$ins = '';
	$insname = '';
	foreach($institute as $row){ 
		$inscode = $row['institute_code'];
		$ins =  encrypt_decrypt('encrypt', $inscode);
		$insname = $row['institute_name'];
		$logo = $row['logo_url'];	
	}
	$bg_image_url = 'background.svg';
?>
<style>
	.notice{
		position: inherit;
		width: 248px;
		height: 36px;
		left: 127px;
		top: 360px;

		font-family: Exo 2;
		font-style: normal;
		font-weight: bold;
		font-size: 22px;
		line-height: 36px;
		/* identical to box height */


		color: #FFFFFF;
	}
	
	.tabledesign{
		position: relative;
	    width: 30%;
	    height: 402px;
	    left: 20px;
	    /* top: 424px; */
	    background: #FFFFFF;
	    box-shadow: 0px 4px 4px rgb(0 0 0 / 25%);
	    margin-left: 22px;
	    border-radius: 15px;
	}
	
	.div_bottom{
		padding-left: 0;
		cursor: pointer;
		padding-right: 1px;
		border: 1px solid #ffff00;
	}
	.div-color{
		background: #80040087;
	    height: 60px;
	    padding: 13px;
	}
	.font-style{
		color:#FFF;
		font-size: 18px;
	}
	.fa-2x {
	    font-size: 2em;
	}
	.icon-color
	{
		color: white;
	}
	.login-background {
	    border: 1px solid #20505f;
	    box-shadow: 2px 2px 2px 2px #0000005c;
	    height: 381px;
	    border-radius: 0px 60px 0px 60px;
    	background: none repeat scroll 0% 0% rgba(243, 156, 0, 0);
    	margin-top: 20px;
    	margin-bottom: 30px;
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
	.header {
	    position: absolute;
		width: 1094px;
    	height: 212px;
		left: 164px;
		top: 124px;

		border: 1.2px solid #13434D;
		box-sizing: border-box;
		filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));
		border-radius: 21px;
		background-color: #0e0e0ef5;
	}
	.aaa{
		position: relative;
	    width: 221px;
	    height: 22px;
	    left: 23px;
	    top: 17px;
	    font-family: Exo 2;
	    font-style: normal;
	    font-weight: 500;
	    font-size: 18px;
	    line-height: 22px;
	    letter-spacing: 0.32em;
	    text-transform: uppercase;
	    color: #fffbfb;
	}
	.bbb{
		position: absolute;
	    width: 313px;
	    height: 57px;
	    left: 36px;
	    top: 36px;
	    font-family: Exo 2;
	    font-style: normal;
	    font-weight: bold;
	    font-size: 33px;
	    line-height: 58px;
	    text-transform: uppercase;
	    color: #fffbfb;
	}
	.ccc{
		position: absolute;
		color: #fffbfb;
		font-size: 14px;
		line-height: 25px;
		top: 101px;
    	left: 34px;
    	grid-template-columns: 62% 1fr;
    	display: grid;
    	text-align: justify;
	}
	.job{
		float: left;
	    left: 32px;
	    top: -9px;
	}
	.noticeinnerclass{
		height: 31px;
	    width: 101px;
	    top: 107px;
	    margin-left: 81%;
	    font-size: 15px;
	    background: #03a9f466;
	    outline: none;
	    border: none;
	    border-radius: 4px;
	}
	.design{
		position: absolute;
		width: 106px;
		height: 75px;
		left: 149px;
		top: 443px;
		font-family: Exo 2;
		font-style: normal;
		font-weight: 600;
		font-size: 14px;
		line-height: 180.5%;
		color: #000000;
	}
	.des{
		/*position: absolute;
		width: 330px;
    	padding-left: 36px;
    	margin-top: -7px;
		height: auto;
		left: 137px;
		top: -29px;
		font-family: Exo 2;
		font-style: normal;
		font-weight: normal;
		font-size: 13px;
		line-height: 120.5%;
		text-align: justify;
		font-feature-settings: 'case' on;*/
		
	    width: auto;
	    float: left;
	    margin-left: 24px;
	    padding: 6px;
	    margin-top: -24px;
	    height: auto;
	    /* left: 137px; */
	    font-family: Exo 2;
	    font-style: normal;
	    font-weight: normal;
	    font-size: 13px;
	    line-height: 120.5%;
	    text-align: justify;
	    font-feature-settings: 'case' on;
	}
	.cal{
		position: absolute;
		left: 8.33%;
		right: 8.33%;
		top: 8.33%;
		bottom: 8.33%;
	}
	.notic{
		position: absolute;
	    width: 142px;
	    height: 30px;
	    left: 40px;
	    top: 2px;
	   /* background: #CDE9ED;*/
	    background: #47c8db;
	    border-radius: 7px;
	}
	.notctext{
		position: absolute;
	    width: 70px;
	    height: 16px;
	    left: 35px;
	    top: 8px;
	    font-family: Exo 2;
	    font-style: normal;
	    font-weight: 500;
	    font-size: 13px;
	    line-height: 16px;
	    text-transform: capitalize;
	    color: #002B7D;
	}
	/*.corri{
		position: absolute;
		width: 142px;
		height: 42px;
		left: 3px;
		background: linear-gradient(180deg, #FF8F27 0%, #954700 100%);
		border-radius: 7px;
	}*/
	.corri{
		position: absolute;
		width: 142px;
		height: 30px;
		left: 33px;
		top: 2px;
		/*background: #FFECDB;*/
		background: #eb9d57;
		border-radius: 7px;
	}
	.corritext{
		position: absolute;
		width: 70px;
		height: 16px;
		left: 35px;
		top: 8px;
		font-family: Exo 2;
		font-style: normal;
		font-weight: 500;
		font-size: 13px;
		line-height: 16px;
		text-transform: capitalize;
		color: #352000;
	}
	.fadeInUp {
	    -webkit-animation-name: fadeInUp;
	    animation-name: fadeInUp;
	}
	.single-feature, .single-process {
		margin-top: 30px;
	    padding: 20px 20px;
	    background: #000000de;
	    margin-bottom: 30px;
	    border-radius: 5px;
	    border: 1px solid #ccc;
	    box-shadow: 0px 8px 13px 2px rgb(247 143 25);
	    height: 470px;
	}
		
	.vl{
		border-left: 1px solid #ADADAD;
	    /* height: 129px; */
	    min-height: 206px;
	    position: absolute;
	    left: 53%;
	    top: 225px;
	}
	.applyn{
		position: absolute;
		width: 369px;
		height: 42px;
		left: 31px;
		top: 145px;
		background: linear-gradient(180deg, #0DA653 0%, #006A64 100%);
		border-radius: 7px;
	}
	.img1,.img2{
		vertical-align: middle;
	    border: 0;
	    border-radius: 5px;
	    height: 28px;
	    left: 12px;
	    margin-right: auto;
	}
	.opendt, .closedt{
		margin-top: 0px; 
		margin-bottom:0px; 
		text-align:start;
	}
	.advt{
		margin-right: 17px;
		margin-bottom: 1px;
	}
	.notcli{
		position: absolute;
		width: auto;
		height: auto;
		left: 0;
		top: 5px;
		font-family: Exo 2;
		font-style: normal;
		font-weight: normal;
		font-size: 12px;
		line-height: 120.5%;
		text-transform: capitalize;
		font-feature-settings: 'case' on;
		color: #ffffff;
		text-align: initial;
	}
	.corrili{
		position: absolute;
		width: auto;
		height: auto;
		left: 0;
		top: 5px;
		font-family: Exo 2;
		font-style: normal;
		font-weight: normal;
		font-size: 12px;
		line-height: 120.5%;
		text-transform: capitalize;
		font-feature-settings: 'case' on;
		color: #ffffff;
		text-align: initial;
	}
	.jobdes{
		margin-right: 258px;
	}
	body{
		color: white;
	}
	.mov-title h3 {
	    font-weight: 600;
	    text-transform: uppercase;
	    letter-spacing: 1px;
	    position: relative;
	    padding: 20px 0px 10px 0px;
	    margin-top: -86px;
	    margin-bottom: 16px;
	    color: #efebeb;
	    font-size: 18px;
	    letter-spacing: 2px;
	}
	.mov-title h3::after {
	    position: absolute;
	    content: "";
	    left: 0;
	    bottom: 0;
	    width: 60px;
	    height: 3px;
	    background-color: #f69d39;
	    display: inline-block;
	}
	.mov-title-des {
	    font-weight: 600;
	    text-align: initial;
	    /*text-transform: uppercase;*/
	    letter-spacing: 1px;
	    position: relative;
	    padding: 10px 0px 0px 0px;
	    margin-left: 0px;
	    /* padding: 20px 0px 10px 0px; */
	    margin-top: 0px;
	    margin-bottom: 0px;
	    color: #efebeb;
	    font-size: 12px;
	}
	.mov-title-des ::after {
	    position: absolute;
	    content: "";
	    left: 0;
	    bottom: 0;
	    width: 60px;
	    height: 3px;
	    /*background-color: #f69d39;*/
	    display: inline-block;
	}
	.mov-title p {
		font-weight: 600;
	    text-transform: uppercase;
	    letter-spacing: 1px;
	    position: relative;
	    padding: 10px 0px 10px 0px;
	    /*margin-top: 0;*/
	    margin-bottom: 16px;
	    color: #efebeb;
	    font-size: 12px;
	    letter-spacing: 2px;
    
	    /*font-weight: 600;
	    text-transform: uppercase;
	    letter-spacing: 1px;
	    position: relative;
	    padding: 20px 7px 6px 0px;
	    /*padding: 20px 0px 10px 0px;*/
	     /*margin-top: -86px;
	    margin-bottom: 16px;
	    color: #efebeb;
	    font-size: 12px;
	    letter-spacing: 2px;*/
	}
	.mov-title p::after {
	    position: absolute;
	    content: "";
	    left: 0;
	    bottom: 0;
	    width: 60px;
	    height: 3px;
	    /*background-color: #f69d39;*/
	    display: inline-block;
	}
	a:hover {
	    color: #fb4275;
	}
	.linkBtn {
	    letter-spacing: 3px;
	    font-weight: 600;
	    padding: 10px 40px 10px 20px;
	    border: 2px solid #fff;
	    border-right: 0;
	    position: relative;
	    display: inline-block;
	    vertical-align: top;
	    color: #fff;
	    font-size: 14px;
	    text-transform: uppercase;
	    bottom: 30px;
	}
	.linkBtn:before {
	    content: '';
	    position: absolute;
	    right: 0;
	    top: 0;
	    width: 2px;
	    height: 30%;
	    background: #fff;
	}
	.linkBtn span {
	    display: block;
	    width: 60px;
	    height: 15px;
	    position: absolute;
	    top: 50%;
	    left: 86%;
	    margin-top: -7px;
	    background: url(<?=base_url()?>upload/image/link-arw.png) no-repeat right;
	    -webkit-transition: all .4s ease-in;
	    -moz-transition: all .4s ease-in;
	    -o-transition: all .4s ease-in;
	    transition: all .4s ease-in;
	}
	.linkBtn:after {
	    content: '';
	    position: absolute;
	    right: 0;
	    bottom: 0;
	    width: 2px;
	    height: 30%;
	    background: #fff;
	}
	.linkBtn:hover span {
	    width: 78px;
	}
	
	.linkviewBtn {
	    letter-spacing: 3px;
	    font-weight: 600;
	    padding: 10px 40px 10px 20px;
	    border: 2px solid #fff;
	    border-right: 0;
	    position: relative;
	    display: inline-block;
	    vertical-align: top;
	    color: #fff;
	    font-size: 14px;
	    text-transform: uppercase;
	    margin-top: 20px;
	    margin-bottom: 20px;
	}
	.linkviewBtn:before {
	    content: '';
	    position: absolute;
	    right: 0;
	    top: 0;
	    width: 2px;
	    height: 30%;
	    background: #fff;
	}
	.linkviewBtn span {
	    display: block;
	    width: 60px;
	    height: 15px;
	    position: absolute;
	    top: 50%;
	    left: 86%;
	    margin-top: -7px;
	    background: url(<?=base_url()?>upload/image/link-arw.png) no-repeat right;
	    -webkit-transition: all .4s ease-in;
	    -moz-transition: all .4s ease-in;
	    -o-transition: all .4s ease-in;
	    transition: all .4s ease-in;
	}
	.linkviewBtn:after {
	    content: '';
	    position: absolute;
	    right: 0;
	    bottom: 0;
	    width: 2px;
	    height: 30%;
	    background: #fff;
	}
	.linkviewBtn:hover span {
	    width: 78px;
	}
	.section-title h2 {
	    font-size: 32px;
	    color: #ffffff;
	    background-image: linear-gradient(to right, #e62222, #e62222, #ef6d35, #ef6d35, #ef6d35);
	    -webkit-background-clip: text;
	    -webkit-text-fill-color: transparent;
	    letter-spacing: 3px;
		position: relative;
	}
	.section-title h2:before {
	    position: absolute;
	    bottom: -20px;
	    left: 10px;
	    width: 15px;
	    height: 4px;
	    content: '';
	    z-index: 5;
	    background: #17181a;
	    animation: mover 2s infinite alternate;
	}
	.section-title h2:after {
	    position: absolute;
	    bottom: -20px;
	    left: 0;
	    border: 2px solid;
	    width: 100px;
	    text-align: center;
	    height: 4px;
	    content: '';
	    border-radius: 30px;
	    border-right-color: #36d1dc;
	    border-left: 90px solid #e83727;
	}
	.section-title h2:before, .section-title h2:after {
	    left: 0px;
	    right: 0px;
	    margin: auto;
	}
	.section-title h2:before {
	    left: -60px;
	}
	.section-title {
	  margin-bottom: 22px;
	}
	.contentt {
	    min-height: 37px; 
	    /* padding: 0px; */
	    margin-right: auto;
	    margin-left: auto;
	    padding-left: 15px;
	    padding-right: 15px;
	}
	*, ::after, ::before {
	    box-sizing: border-box;
	}
	.ra{
		padding: 2%;
		margin-top: 16%;
	}
	.progstartdt, .progenddt{
		margin-top: 0px; 
		margin-bottom:0px; 
		text-align:start;
	}
	.corri_div{
		left: 132px;  
	}
	.calndr{
		color:white ; 
		height: 30px;
	}
	.notidiv{
		background-color: ; 
		height: 60px;
	}
	.notice_div{
		background-color: ;
		border-right: 1px solid white;  
		color:white;
	}
	.notice_btn{
		color: white; 
		background: #47c8db;
		padding:2px; 
		border-radius: 7px;
	}
	.notify_list ul{
		color: white; 
		float:left;
		list-style: disc;
	}
	.corrigendum_div{
		background-color: ; 
		color: white;
	}
	.corri_btn{
		color: white; 
		background: #ef6d35;; 
		padding:2px; 
		border-radius: 7px;
	}
	.corri_list ul{
		color: white; 
		float:left;
		list-style: disc;
	}
	.applyBtn_div{
		position: absolute;
		bottom: 7%; 
		width:90%;
	}
	
	@media (min-width: 767px) and (max-width: 1024px){
		.header {
		    margin: 43px;
		    left: 0px;
		    width: 89%;
		}
		.section-title h2 {
		    font-size: 33px;
    		top: -102px;
		}
		.single-feature {
		    height: 470px;
		    margin-top: -14px;
		}
		.aaa {
			font-size: 12px;
		    letter-spacing: 0.2em;
		    top: 10px;
		    left: 15px;
		} 
		.bbb{
			font-size: 24px;
		    line-height: 40px;
		    left: 24px;
		}
		.ccc{
			line-height: 18px;
		    left: 24px;
		    top: 80px;
		}
		.banimg{
			width: 43%;
			height: 84%;
		}
		.ra{
			padding: 2%;
    		margin-top: 47%;
		}
		.mov-title{
			text-align: start;
		}
		.mov-title p {
			letter-spacing: 1px;
			font-size: 12px;
		}
		.mov-title-des{
			margin-top: 0px;
			margin-left: unset;
			font-size: 12px;
		}
		.job {
		    margin-left: -18px;
		}
		.des {
		    margin-left: 9px;
		}
		.progdesc {
		    margin: unset;
		    padding-bottom: 9px;
		    font-size: 12px;
		}
		.opdate{
			padding-left: 0px;
    		left: -15px;
		}
		.img1 {
		    height: 30px;
		    margin-left: 22px;
		    margin-top: 2px;
		}
		.img2{
			height: 30px;
			margin-left: 22px;
			margin-top: 2px;
		}
		.opendt {
    		font-size: 16px;
		}
		.closedt {
			font-size: 16px;
		}
		.progstartdt{
			font-size: 16px;
		}
		.progenddt{
			font-size: 16px;
		}
		.notic{
			left: 20px;
    		width: 110px;
		}
		.notcli {
			left: 0px;
		}
		.notctext{
			left: 20px;
		}
		.corri{
			left: 84px;
		    width: 110px;
		}
		.corritext{
			left: 20px;
		}
		.notidiv {
		    background-color: ;
		    height: 108px;
		    display: flex;
		}
		.notice_div {
		    width: 50%; 
		}
		.corrigendum_div {
		    width: 50%;
		}
		.linkBtn {
		    /*bottom: unset;*/
		}
	}
	@media (min-width: 551px) and (max-width: 766px){
		.header {
		    left: 0px;
		    width: 100%;
		    top: 94px;
		}
		.section-title h2 {
		    font-size: 29px;
		    top: -50px;
		}
		.single-feature {
		    height: 470px;
		    margin-top: -14px;
		}
		.aaa {
			font-size: 12px;
		    letter-spacing: 0.2em;
		    top: 10px;
		    left: 15px;
		} 
		.bbb{
			font-size: 24px;
		    line-height: 40px;
		    left: 24px;
		}
		.ccc{
			line-height: 18px;
		    left: 24px;
		    top: 80px;
		}
		.banimg{
			width: 43%;
			height: 84%;
		}
		.ra{
			padding: 2%;
    		margin-top: 45%;
		}
		.mov-title{
			text-align: start;
		}
		.mov-title p {
			letter-spacing: 1px;
			font-size: 12px;
		}
		.mov-title-des{
			margin-top: 0px;
			margin-left: unset;
			font-size: 12px;
		}
		.job {
		    margin-left: -18px;
		}
		.des {
		    margin-left: 9px;
		}
		.progdesc {
		    margin: unset;
		    padding-bottom: 9px;
		    font-size: 12px;
		}
		.opdate{
			padding-left: 0px;
    		left: -15px;
		}
		.img1{
			height: 25px;
		}
		.img2{
			height: 25px;
		}
		.opendt {
			font-size: 14px;
		}
		.closedt {
			font-size: 14px;
		}
		.progstartdt{
			font-size: 14px;
		}
		.progenddt{
			font-size: 14px;
		}
		.notic{
			left: 20px;
    		width: 110px;
		}
		.notcli {
			left: 0px;
		}
		.notctext{
			left: 20px;
		}
		.corri{
			left: 116px;
    		width: 110px;
		}
		.corritext{
			left: 20px;
		}
		.single-feature .vl{
			top: 190px;
		    min-height: 150px;
		    left: 50%;
		}
		.linkBtn{
			margin-top: 100px;
		}
		.notidiv {
		    background-color: ;
		    height: 108px;
		    display: flex;
		}
		.notice_div {
		    width: 50%; 
		}
		.corrigendum_div {
		    width: 50%;
		}
		.linkviewBtn {
			z-index: 99;
		}
		.linkBtn {
		    bottom: unset;
		}
	}
	@media (min-width: 416px) and (max-width: 550px){
		.header {
		    left: 0px;
		    width: 100%;
		    top: 94px;
		}
		.section-title h2 {
		    font-size: 29px;
		    top: -50px;
		}
		.single-feature {
		    height: 470px;
		    margin-top: -14px;
		}
		.aaa {
			font-size: 12px;
		    letter-spacing: 0.2em;
		    top: 10px;
		    left: 15px;
		} 
		.bbb{
			font-size: 24px;
		    line-height: 40px;
		    left: 24px;
		}
		.ccc{
			line-height: 18px;
		    left: 24px;
		    top: 80px;
		}
		.banimg{
			width: 54%;
			height: 84%;
		}
		.ra{
			padding: 2%;
    		margin-top: 50%;
		}
		.mov-title{
			text-align: start;
		}
		.mov-title p {
			letter-spacing: 1px;
			font-size: 12px;
		}
		.mov-title-des{
			margin-top: 0px;
			margin-left: unset;
			font-size: 12px;
		}
		.job {
		    margin-left: -18px;
		}
		.des {
		    margin-left: 9px;
		}
		.progdesc {
		    margin: unset;
		    padding-bottom: 9px;
		    font-size: 12px;
		}
		.opdate{
			padding-left: 0px;
    		left: -15px;
		}
		.img1{
			height: 25px;
		}
		.img2{
			height: 25px;
		}
		.opendt {
			font-size: 14px;
		}
		.closedt {
			font-size: 14px;
		}
		.progstartdt{
			font-size: 14px;
		}
		.progenddt{
			font-size: 14px;
		}
		.notic{
			left: 20px;
    		width: 110px;
		}
		.notcli {
			left: 0px;
		}
		.notctext{
			left: 20px;
		}
		.corri{
			left: 116px;
    		width: 110px;
		}
		.corritext{
			left: 20px;
		}
		.single-feature .vl{
			top: 190px;
		    min-height: 150px;
		    left: 50%;
		}
		.notice_div{
			border-right: unset;
		}
		.linkviewBtn {
			z-index: 99;
		}
		.linkBtn {
		    bottom: unset;
		}
	}
	@media (min-width: 377px) and (max-width: 415px){
		.logo_img {
		    position: absolute;
		    width: 230px;
		    left: 25px;
		    top: 15px;
		    height: 38px; 
		}
		.header {
		    left: 0px;
		    width: 100%;
		    top: 94px;
		}
		.section-title h2 {
		    font-size: 29px;
		    top: -50px;
		}
		.single-feature {
		    height: 470px;
		    margin-top: -14px;
		}
		.aaa {
			font-size: 12px;
		    letter-spacing: 0.2em;
		    top: 10px;
		    left: 15px;
		} 
		.bbb{
			font-size: 24px;
		    line-height: 40px;
		    left: 24px;
		}
		.ccc{
			line-height: 18px;
		    left: 24px;
		    top: 80px;
		}
		.banimg{
			width: 54%;
			height: 113%;
		}
		.ra{
			padding: 2%;
    		margin-top: 60%;
		}
		.mov-title{
			text-align: start;
		}
		.mov-title p {
			letter-spacing: 1px;
			font-size: 12px;
		}
		.mov-title-des{
			margin-top: 0px;
			margin-left: unset;
			font-size: 12px;
		}
		.job {
		    margin-left: -18px;
		}
		.des {
		    margin-left: 9px;
		}
		.progdesc {
		    margin: unset;
		    padding-bottom: 9px;
		    font-size: 12px;
		}
		.opdate{
			padding-left: 0px;
    		left: -15px;
		}
		.img1 {
		    height: 20px;
		    margin-left: 0px;
		    margin-top: 2px;
		}
		.img2{
			height: 20px;
			margin-left: unset;
		}
		.img_section{
			padding-left: 0px;
		}
		.opendt {
			font-size: 12px;
		}
		.closedt {
			font-size: 12px;
		}
		.progstartdt{
			font-size: 12px;
		}
		.progenddt{
			font-size: 12px;
		}
		.notic{
			left: 20px;
    		width: 110px;
		}
		.notcli {
			left: 0px;
		}
		.notctext{
			left: 20px;
		}
		.corri{
			left: 84px;
		    width: 110px;
		}
		.single-feature .vl{
			top: 190px;
		    min-height: 150px;
		    left: 50%;
		}
		.notice_div{
			border-right: unset;
		}
		.linkviewBtn {
			z-index: 99;
		}
		.linkBtn {
		    bottom: unset;
		}
	} 
	@media (min-width: 200px) and (max-width: 376px){
		.header { 
		    top: 84px;
		    left: 0px;
		    width: 100%;
		}
		.aaa {
		    font-size: 12px;
		    letter-spacing: 0.2em;
		    top: 10px;
		    left: 15px;
		}
		.bbb {
		    font-size: 24px;
		    line-height: 40px;
		    left: 24px;
		}
		.ccc{
			line-height: 18px;
		    left: 24px;
		    top: 80px;
		}
		.banimg{
			width: 54%;
			height: 113%;
		}
		.ra {
		    margin-top: 40%;
		}
		.section-title h2 {
		    font-size: 29px;
		    top: 28px;
		}
		.section-title {
		    margin-bottom: -8px;
		}
		.single-feature {
		    height: 470px;
		    margin-top: 69px;
		}
		.mov-title p {
			letter-spacing: 1px;
			font-size: 12px;
		}
		.mov-title-des{
			margin-top: 0px;
			margin-left: unset;
			font-size: 12px;
		}
		.job {
		    margin-left: -18px;
		}
		.des {
		    margin-left: 9px;
		}
		.progdesc {
		    margin: unset;
		    padding-bottom: 9px;
		    font-size: 12px;
		}
		.img1 {
		    height: 20px;
		    margin-left: 0px;
		    margin-top: 2px;
		}
		.img2{
			height: 20px;
			margin-left: unset;
		}
		.img_section{
			padding-left: 0px;
		}
		.opendt {
			font-size: 12px;
		}
		.closedt {
			font-size: 12px;
		}
		.progstartdt {
			font-size: 12px;
		}
		.progenddt{
			font-size: 12px;
		}
		.notic {
		    left: 11px;
		    width: 110px;
		}
		.single-feature .vl {
		    top: 190px;
		    left: 52%;
		    min-height: 150px;
		}
		.corri {
		    left: 84px;
		    width: 110px;
		}
		.notcli {
			left: 0px;
		} 
		.notice_div{
			border-right: unset;
		}
		.linkviewBtn {
			z-index: 99;
		}
		.linkBtn {
		    bottom: unset;
		}
	}

	/* File info text below the button */
	.file-info {
		display: inline-block;
		margin-top: 6px;
		font-size: 13px;
		font-weight: 500;
		color: #d1e7ff; /* soft bluish tone that’s visible on dark bg */
		background: rgba(255, 255, 255, 0.08);
		border: 1px solid rgba(255, 255, 255, 0.12);
		padding: 4px 10px;
		border-radius: 6px;
		backdrop-filter: blur(6px);
		letter-spacing: 0.3px;
		transition: all 0.3s ease;
	}

	/* When hovering over file info itself */
	.file-info:hover {
		background: rgba(255, 255, 255, 0.15);
		border-color: rgba(255, 255, 255, 0.3);
		transform: translateY(-1px);
		color: #ffffff;
	}

	/* Optional: small file-type icon style (if you add one) */
	.file-info i {
		margin-right: 6px;
		color: #33ccff;
	}


</style> 
 <link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet" /> 
 <link href="<?php echo base_url(); ?>public/assets/css/text-scroll.css" rel="stylesheet" /> 
<section class="sec">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 header">
				<p class="aaa">JOIN OUR TEAM</p>
				<p class="bbb">WE'RE HIRING</p>
				<p class="ccc">Central Medical Services Society (CMSS), a Central Procurement Agency of Ministry of Health and Family Welfare (MoHFW), Government of India, has opening for the following position: </p>
	            <IMG class="banimg" src="<?php echo base_url(); ?>upload/image/banner.svg" align="right" />
	            <!--<div class="hidden-sm hidden-xs col-md-1 col-lg-1 col-xl-1 ">
	            	<label class="imgLabel-1" ><img src="<?php echo base_url()?>upload/image/ann.png"></label>
	            </div>
	            <div class="col-sm-12 col-xs-12 col-md-11 col-lg-11 col-xl-11">	
	            <div class="scroll-hr">	
					<p class="ann_label_home">
						<?php
								if(isset($announcements)){
									foreach($announcements as $row)
									{																	
									  echo "<a target='_blank' class='viewlink' style='text-decoration:none;color:#fff'  href=".$row['link_path'].">»&nbsp;".$row['news_details']."</a></h2>  ";   
								
									}
								} 
								  
							?> 
					</p>
				</div>
			</div>-->
       	</div>
		</div>
		
	  	<div class="row">
	  		<div class="hidden-xs hidden-sm col-md-1 col-lg-1 col-xl-1">
			</div>
			
	  		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ra">
	  			<!-- <div class="row" style="padding: 0;">
	  				<div class="">
				      <img src="<?php echo base_url(); ?>upload/image/<?php echo $img; ?>" style="width: 100%;background-color:black;">
				    </div>
	  			</div> -->
			    <div class="row" style="text-align: center;">
			    <div class="section-title text-center">
                    <h2><b>Current Openings</b></h2>
                </div>
			    <!--<div>
					<span class="notice" style="margin-right: 67%;"><b>Current Openings</b></span>
				</div> -->	
			    
			    <!--<hr style="width: 82%;margin-left: 108px;border-color: #13434D;">-->
			    <div class="row" id="divPostDetail1">
				</div>
			    <div> 
			    	<a class="linkviewBtn" id="btnView" name="btnView" href="<?php echo base_url(); ?>Index/view_all/<?php echo $this->uri->segment(4);?>">VIEW ALL<span></span></a>
					<!--<button type="button" class="btn btn-primary center-block noticeinnerclass" id="btnView" name="btnView" style="float: right" onclick='location.href="<?php echo base_url(); ?>Index/view_all/<?php echo $this->uri->segment(4);?>"'>
						View All
					</button>-->
				</div>
			    
			    	<!--<table class="table table-striped table-bordered" id="tblCounsellingPeriod" width="100%">
			    			<thead>
			    				<tr >
									<td style="text-align: center;">Sl No</td>
									<td style="text-align: center;">Advt.No</td>
									<td style="text-align: center;">Post Name</td>
									<td style="text-align: center;">Start Date</td>
									<td style="text-align: center;">Closing Date</td>
									<td style="text-align: center;">Important Notice</td>
									<td style="text-align: center;">Status</td>
								</tr>
								<tr >
									<?php
									$i = 1;
									$c = "";
									if(sizeof($program_data)!=0)
									{
									?>
								</tr>
									<?php foreach($program_data as $program)
								 	{
									 	$program_advt_data=$program['advt_no'];
									 	$corrigendum_name = isset($program['corrigendum_name'])?$program['corrigendum_name']:'';
									 	$corrigendum_path = isset($program['corrigendum_path'])? $program['corrigendum_path']:'';
									 	$a = strpos($corrigendum_name,"`");
									 	$b = strpos($corrigendum_path,"`");
									 	
									 	if($a)
									 	{
									 		
											$corrigendum_name_array = explode('`',$corrigendum_name);
											//print_r($corrigendum_name_array);
										}
										if($b)
									 	{
											$corrigendum_path_array = explode('`',$corrigendum_path);
										}
										
									 	?>
										<tr>
											<td style="text-align: center;"><?php echo $i?></td>
											<td style="text-align: left;"><a target="_blank" class="btn btn-primary" href="<?php echo $program['advt_path']?>"><?php echo $program['advt_no']?></a></td>
											<td style="text-align: left;"><?php echo $program['program_name']?></td>
											<td style="text-align: left;"><?php echo  date('d-m-Y', strtotime($program['apply_start_date']));?></td>
											<td style="text-align: left;"><?php echo  date('d-m-Y', strtotime($program['apply_end_date'])); ?></td>
											<?php if($a) 
											{ ?>
												<td>
												<?php for($i = 0;$i< sizeof($corrigendum_name_array);$i++)
												{?>
													<a target="_blank" class="btn btn-primary" href="<?php echo $corrigendum_path_array[$i];?>"><?php echo $corrigendum_name_array[$i]; ?></a></br>
												<?php
												} ?>
												</td>
											<?php }elseif($corrigendum_name != ''){ ?>
												<td><a target="_blank" class="btn btn-primary" href="<?php echo $corrigendum_path;?>"><?php echo $corrigendum_name; ?></a></td>
											<?php }else{?>
												<td>-</td>
											<?php } ?>
											<td style="text-align: center;"><?php if(strtotime($program['apply_start_date']) > strtotime($now)){ echo 'Not Started'; }elseif(strtotime($program['apply_end_date']) < strtotime($now)){echo 'Closed'; }else{ echo 'Open';}?></td>
										</tr>
									    <?php	
										$i++;
									}
											
									}else{ ?>
									<div>No Program Avaliable</div>
									<?php }
									?>
								
							</thead>
						
					</table>-->
				
			    </div>
			</div>
			<div class="hidden-xs hidden-sm col-md-1 col-lg-1 col-xl-1">
			</div>
			
			
		</div>
		
    	</div>
</section>
<div class="modal fade" id="date" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header" style="background-color: #00008B;">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;padding-left: 90%;"><span aria-hidden="true">&times;</span></button>
        		<h5 class="modal-title" id="myModalLabel"style="color:#E4791A;"><b> IMPORTANT DATES</b></h5>
      		</div>
      		<div class="modal-body" style="height: 490px;">
	      		<div class="col-sm-12">
	      			<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h5 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Availability of CIPET-JEE 2018 Application Forms Can be filled on-line or downloaded form <a href="www.cipet.gov.in">www.cipet.gov.in</a></h5>
						</div>
						<div class="col-md-1">
							<h5 style="color: #0054ff;">:</h5>
						</div>
						<div class="col-md-4">
							<h5 style="color: #0054ff;padding-right:10px;padding-right:20px;    margin-left: -15px; font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>Last week of February 2018</b></h5>
						</div>
					</div>
					<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h5 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Last date for issue and receipt of duly filled in Application forms</h5>
						</div>
						<div class="col-md-1">
							<h5 style="color: #0054ff;">:</h5>
						</div>
						<div class="col-md-4">
							<h5  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>12<sup>th</sup> May 2018</b></h5>
						</div>
					</div>
					<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h5 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Issue of JEE Hall Tickets(for eligible candidates) - Can be downloaded from <a href="www.cipet.gov.in">www.cipet.gov.in</a></h5>
						</div>
						<div class="col-md-1">
							<h5 style="color: #0054ff;">:</h5>
						</div>
						<div class="col-md-4">
							<h5  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>Third week of May 2018</b></h5>
						</div>
					</div>
					<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h5 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Date of Joint Entrance Examination(JEE)</h5>
						</div>
						<div class="col-md-1">
							<h5 style="color: #0054ff;">:</h5>
						</div>
						<div class="col-md-4">
							<h5  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>3<sup>rd</sup> June 2018</b></h5>
						</div>
					</div>
					<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h5 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Release of JEE Result Can be Downloaded from <a href="www.cipet.gov.in">www.cipet.gov.in</a></h5>
						</div>
						<div class="col-md-1">
							<h5 style="color: #0054ff;">:</h5>
						</div>
						<div class="col-md-4">
							<h5  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>Third week of June 2018</b></h5>
						</div>
					</div>
					<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h5 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Issue of Admission Call Letters(for selected candidates)- Can be downloaded form <a href="www.cipet.gov.in">www.cipet.gov.in</a></h5>
						</div>
						<div class="col-md-1">
							<h5 style="color: #0054ff;">:</h5>
						</div>
						<div class="col-md-4">
							<h5  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>Last week of June 2018</b></h5>
						</div>
					</div>
					<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h5 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b> New session (2018-19) begins</b></h5>
						</div>
						<div class="col-md-1">
							<h5 style="color: #0054ff;">:</h5>
						</div>
						<div class="col-md-4">
							<h5  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>August 1, 2018</b></h5>
						</div>
					</div>
	      		</div>
	    	</div>
    	</div>
   	</div> 
</div>
<div class="modal fade" id="admitcardModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 100%;margin-top: 34%;padding-bottom: 100%;">
    <div class="modal-content" style="">
      <div class="modal-header" style="background-color: #ac6000;color: white;">
      	<button type="button" id="btnCloseModal" class="close" data-dismiss="modal" aria-label="Close" style="color: white;padding-left: 90%;"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="myModalLabel"><b>Admit Card Details</b></h5>
      </div>
      <div class="modal-body" style="overflow-y: scroll;height: 500px;">
      	<div class="col-sm-12" align="center">
     		<div class="col-sm-12" style="font-size: 16px;" id="spanAdmitcard">
	      					
	      	</div>
	      	<br/>
	      	<br/>
	      	<div align="center">
	      		<a id="hrefAdmit" style="display: none;" class="btn btn-success" href="<?=BASE_URL?>Index/institute_login/ins/<?= $ins ?>">Proceed</a>
	      	</div>
	    </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="instructionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 100%;margin-top: 34%;padding-bottom: 100%;">
    <div class="modal-content" style="">
      <div class="modal-header" style="background-color: #ac6000;color: white;">
      	<button type="button" id="btnCloseModalIns" class="close" data-dismiss="modal" aria-label="Close" style="color: white;padding-left: 90%;"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="myModalLabel"><b>Instruction Details</b></h5>
      </div>
      <div class="modal-body" style="overflow-y: scroll;height: 500px;">
      	<div class="col-sm-12" align="center">
     		<div class="col-sm-12" style="font-size: 16px;" id="spanInstruction">
	      					
	      	</div>
	      	<br/>
	      	<br/>
	      	<div align="center">
	      		<a id="hrefAdmit" style="display: none;" class="btn btn-success" href="<?=BASE_URL?>Index/institute_login/ins/<?= $ins ?>">Proceed</a>
	      	</div>
	    </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/datetimepickermoment.js"></script>
<?php 
	/*date_default_timezone_set('Asia/Kolkata');
	$now = date('Y-m-d H:i:s', now());
	$today = date('Y-m-d', now());*/
?>
<script>
base_url = "<?php echo base_url()?>"; 
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip({ trigger: 'hover', delay: { show: 0, hide: 0 } });

		function blink_text() {
		    $('.blink').fadeOut(500);
		    $('.blink').fadeIn(500);
		}
		setInterval(blink_text, 4500);
		$("#btnCloseModal").click(function() {
			$("#admitcardModal").hide();
		});
		$("#btnCloseModalIns").click(function() {
			$("#instructionModal").hide();
		});
		
		function loginPage1(){
			$.ajax({
				url:base_url+"ajax_controller/admit_card_setup_details",
				type:"post",
				data:{'ins_code':'<?=$institute_code?>'},
				success:function(response){ 
					var obj = JSON.parse(response);
					$("#spanAdmitcard").html(obj.msg);	
					$("#admitcardModal").show();
					if(obj.setup_count == 1)
					{
						$("#hrefAdmit").show();
					}	
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
			
		}
		function loginPage(){
			window.open('<?=BASE_URL?>Index/institute_login/ins/<?= $ins ?>','_self');
		}
	});
	function brochurePdf(){
		var brochure = "<?= $inscode ?>_Admission_Brochure.pdf";
		$.get('<?=BASE_URL?>downloads/latest_info/'+brochure)
	    .done(function() { 
	       window.open('<?=BASE_URL?>downloads/latest_info/'+brochure,'_blank');	
	    }).fail(function() { 
	    	window.open('<?=BASE_URL?>Index/document_not_found','_blank');	
	    })
	}
	function datesPdf(){
		var brochure = "<?= $inscode ?>_Importat_Dates.pdf";
		$.get('<?=BASE_URL?>downloads/latest_info/'+brochure)
	    .done(function() { 
	       window.open('<?=BASE_URL?>downloads/latest_info/'+brochure,'_blank');	
	    }).fail(function() { 
	    	window.open('<?=BASE_URL?>Index/document_not_found','_blank');	
	    })
	}
	function instructionPdf(){
		$.ajax({
			url:base_url+"ajax_controller/get_program_instructions",
			type:"post",
			data:{'ins_code':'<?=$institute_code?>'},
			success:function(response){ 
				var obj = JSON.parse(response);
				$("#spanInstruction").html(obj.msg);	
				$("#instructionModal").show();	
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	}
	function generalInfoPdf(){
		var brochure = "<?= $inscode ?>_General_Info.pdf";
		$.get('<?=BASE_URL?>downloads/latest_info/'+brochure)
	    .done(function() { 
	       window.open('<?=BASE_URL?>downloads/latest_info/'+brochure,'_blank');	
	    }).fail(function() { 
	    	window.open('<?=BASE_URL?>Index/document_not_found','_blank');	
	    })
	}
	function AdvertisementPdf(){
		var brochure = "<?= $inscode ?>_Advertisement.pdf";
		$.get('<?=BASE_URL?>downloads/latest_info/'+brochure)
	    .done(function() { 
	       window.open('<?=BASE_URL?>downloads/latest_info/'+brochure,'_blank');	
	    }).fail(function() { 
	    	window.open('<?=BASE_URL?>Index/document_not_found','_blank');	
	    })
	}
	function courseDetailPdf(){
		var brochure = "<?= $inscode ?>_Courses_Offered.pdf?v=10";
		$.get('<?=BASE_URL?>downloads/latest_info/'+brochure)
	    .done(function() { 
	       window.open('<?=BASE_URL?>downloads/latest_info/'+brochure,'_blank');	
	    }).fail(function() { 
	    	window.open('<?=BASE_URL?>Index/document_not_found','_blank');	
	    })
	}
	function loginPage1(){
		$.ajax({
			url:base_url+"ajax_controller/admit_card_setup_details",
			type:"post",
			data:{'ins_code':'<?=$institute_code?>'},
			success:function(response){ 
				var obj = JSON.parse(response);
				$("#spanAdmitcard").html(obj.msg);	
				$("#admitcardModal").show();
				if(obj.setup_count == 1)
				{
					$("#hrefAdmit").show();
				}	
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
		
	}
	function loginPage(){
		window.open('<?=BASE_URL?>Index/institute_login/ins/<?= $ins ?>','_self');
	}
	function btnlogin(){
		window.location.href=(base_url+'Index/institute_login/ins/<?=$ins?>');			
	}
	$(document).ready(function() {
		
		var date = moment();
		var currentDate = date.format('D/MM/YYYY');
		//console.log(currentDate);
		
		var ins = "<?=$ins?>";
		var date = "<?=date('d/m/Y/H/i')?>";
		// var res1 = Array();
		var res1 = <?php echo json_encode($program_data); ?>;
		var notice_data = <?php echo json_encode($notice_data); ?>;
		var corrigendum_data = <?php echo json_encode($corrigendum_data); ?>;
		console.warn(res1);
		/*$.ajax({
			url: base_url+'Index/api_get_postname',
	  		type: 'POST',
	  		success: function(response){*/
	  			//alert("111");  
	  			var html_code='';
				// var res1 = JSON.parse(response); 	  			
				
				for(i=0,j=0;i<res1.length;i++,j++){
					let j = i;
					program_code = res1[i]['program_code'];
				 	advt_no = res1[i]['advt_no'];
				 	advt_date = res1[i]['advt_date'];
				 	advt_path = res1[i]['advt_path'];
					let sizeText = res1[i]['advt_size'] ? formatBytes(res1[i]['advt_size']) : 'Unknown size';
					// $('#fileInfo' + i).text('(PDF, ' + sizeText + ')');
					// $('#advtBtn' + i).attr('title', 'PDF, ' + sizeText).tooltip();

					let advtType = getFileType(advt_path);

				 	program_name = res1[i]['program_name'];
				 	program_desc = res1[i]['program_desc'];
				 	program_start_date = reformatDate(res1[i]['program_start_date']);
				 	program_end_date = reformatDate(res1[i]['program_end_date']);
				 	apply_start_date = reformatDate(res1[i]['apply_start_date']);
				 	apply_end_date = reformatDate(res1[i]['apply_end_date']);
				 	action1_post_start_date = reformatDate(res1[i]['action1_post_start_date']);
				 	action1_post_end_date = reformatDate(res1[i]['action1_post_end_date']);
				 	apply_start_datetime = res1[i]['apply_start_datetime'];
				 	corrigendum_name = res1[i]['corrigendum_name'];
				 	corrigendum_path = res1[i]['corrigendum_path'];
				 	result_name = res1[i]['result_name'];
				 	result_file_path = res1[i]['result_file_path'];
				 	corrigendum_type = res1[i]['corrigendum_type'];
				 	//window.liData = '';
				 	
				 	//liData = hhhh;
				 	//html_code += '<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 tabledesign"><div class="card"><div class="card-head"><div class="row"><div class="col-lg-4"><p style="padding-top: 20px;margin-right: 13px;margin-bottom: 1px;"><b>Position :</b></p></div><div class="col-lg-8"><b><p style="padding-top: 20px;position: absolute;margin-left: -23px;"> '+program_name+'</b></p></div></div></div><div class="card-block "><div class="row"><div class="col-lg-4"><p class="advt"><b>Advt.No : </p></div><div class="col-lg-8"><p style="position: absolute;margin-left: -23px;">'+advt_no+'</b></p></div></div><div class="row"><div><p style="margin-right: 210px;"><b>Job Description: </b></p></div><p class="des">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis blandit erat, vitae efficitur neque.Quisque ac ex quis ipsum blandit suscipit.Quisque ac ex quis ipsum blandit suscipit.</p></div><div class="row"><div class="col-md-6"><div align="left" class="col-sm-2 col-md-2 col-xs-2" style="padding-right:15px; padding-left:15px;"><img src="<?php echo base_url(); ?>upload/image/calender.svg"  class="img1" ></div><div class="opendt">Opening date</div><div style="margin-top:13px;">'+program_start_date+'</div></div><div class="col-md-6"><div align="right" class="col-sm-2 col-md-2 col-xs-2" style="padding-right:15px; padding-left:15px;"><img src="<?php echo base_url(); ?>upload/image/calender.svg"  class="img1" ></div><div class="closedt">Closing date</div><div style="margin-top:13px;">'+program_end_date+'</div></div></div><div class="row"><div class="col-md-6" style="top: 7px;"><button type="button" class="btn btn-info notic">Notification <i class="fa fa-download"></i></button></div><div class="col-md-6" style="top: 7px;"><button type="button" class="btn btn-info corri">Corrigendum <i class="fa fa-file-pdf-o"></i></button></div></div><div class="row"><div class="col-md-12"><button type="button" class="btn btn-info applyn">Apply Now &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button></div></div></div></div></div>';
					//console.log("action1_post_start_date",action1_post_start_date);
					//console.log("currentDate",currentDate);
					//console.log("program_end_date",program_end_date);
					/*var program_end_dateArr = program_end_date.split("/");
					//console.log("program_end_date", program_end_date);
					// month is 0-based, that's why we need startDateArr[0] - 1
					program_end_dateArr[1] = parseInt(program_end_dateArr[1]) - 1;				
					var g1 = new Date(program_end_dateArr[2], program_end_dateArr[1], program_end_dateArr[0], 00, 00, 00);
					//console.log("g1", g1);
					//console.log("g1.time", g1.getTime());
					
					var currentDateArr = currentDate.split("/");
					//console.log("currentDate", currentDate);
					currentDateArr[1] = parseInt(currentDateArr[1]) - 1;				
					var g2 = new Date(currentDateArr[2], currentDateArr[1], currentDateArr[0], 00, 00, 00);*/
					//console.log("g2", g2);
					//console.log("g2.time", g2.getTime());
				
					var action1_post_end_dateArr = action1_post_end_date.split("/");
					console.log("program_end_date", program_end_date);
					// month is 0-based, that's why we need startDateArr[0] - 1
					action1_post_end_dateArr[1] = parseInt(action1_post_end_dateArr[1]) - 1;				
					var g1 = new Date(action1_post_end_dateArr[2], action1_post_end_dateArr[1], action1_post_end_dateArr[0], 00, 00, 00);
					//console.log("g1", g1);
					//console.log("g1.time", g1.getTime());
					
					var currentDateArr = currentDate.split("/");
					//console.log("currentDate", currentDate);
					currentDateArr[1] = parseInt(currentDateArr[1]) - 1;				
					var g2 = new Date(currentDateArr[2], currentDateArr[1], currentDateArr[0], 00, 00, 00);
					//console.log("g2", g2);
					//console.log("g2.time", g2.getTime());
					

					// Current datetime
					var currentDateTime = new Date(); 

					var h1 = parseDateTime(action1_post_end_date);   
					// var h1 = parseDateTime(program_end_date);   // program_end_date with datetime
					var h2 = currentDateTime;                   // current datetime

					// Compare
					if (h1.getTime() > h2.getTime()) {
						console.log("Valid → End date is in the future");
					} else {
						console.log("Invalid → End date already passed");
					}

				
					/*if(program_end_date > currentDate) 
					{*/
					// if(g1.getTime() > g2.getTime()){
					if (h1.getTime() > h2.getTime()) {						
						// html_code +='<div class="pt-80 pb-60 section-pattern sec-vission">\
				 		// 			<div class="fluid-container" style="padding: 0em 4em;">\
				 		// 				<div class= "justify-content-center">\
				 		// 					<div class="col-lg-4 col-md-6 wow fadeInUp">\
				 		// 						<div class="single-feature">\
				 		// 							<div class="row" style="display: flex;">\
						//  								<div class="col-lg-4 mov-title">\
						//  									<p><b>Position:</b></p>\
						//  								</div>\
						//  								<div class="col-lg-8 mov-title-des">\
						//  									<b><p> '+program_name+'</b></p>\
						//  								</div>\
						//  							</div>\
						//  							<div class="row" style="display: flex;">\
						//  								<div class="col-lg-4 mov-title">\
						//  									<p><b>Advt.No: </p>\
						//  								</div>\
						//  								<div class="col-lg-8 mov-title-des">\
						//  									<p>'+advt_no+'</b></p>\
						//  								</div>\
						//  							</div>\
						//  							<div class="row" style="display: block;">\
						//  								<div class="mov-title">\
						//  									<p class="job"><b>Job Description: </b></p>\
						//  								</div>\
						//  							</div>\
						//  							<div class="row">\
						//  								<div class="des">\
						//  									<p class="progdesc">'+program_desc+'</p>\
						//  								</div>\
						//  							</div>\
						//  							<div class="row calndr">\
						//  								<div class="col-md-6 col-sm-6 col-xs-6" style="">\
						//  									<div class="col-md-4 col-sm-3 col-xs-3 img_section" style="">\
						//  										<img src="<?php echo base_url(); ?>upload/image/callender1.jpg"  class="img1" >\
						//  									</div>\
						//  									<div class="col-md-8 col-sm-9 col-xs-9" style="padding-left:0px; padding-right:0px">\
						//  										<h5 class="opendt" style="">Open date</h5>\
						//  										<h5 class="progstartdt" style="">'+action1_post_start_date+'</h5>\
						//  									</div>\
						//  								</div>\
						//  								<div class="col-md-6 col-sm-6 col-xs-6">\
						//  									<div class="col-md-4 col-sm-3 col-xs-3 img_section" style="">\
						//  										<img src="<?php echo base_url(); ?>upload/image/callender1.jpg"  class="img2" >\
						//  									</div>\
						//  									<div class="col-md-8 col-sm-9 col-xs-9" style="padding-left:0px; padding-right:0px">\
						//  										<h5 class="closedt" style="">Close date</h5>\
						//  										<h5 class="progenddt" style="">'+action1_post_end_date+'</h5>\
						//  									</div>\
						//  								</div>\
						//  							</div>\
						//  							<div class="row notidiv" style=" margin-bottom:10px;">\
						//  								<div class="notice_div col-md-6" style="margin-top:15px; margin-bottom: 20px">\
						//  									<div class="notice_btn col-md-12" style="">\
						//  										<a class="btn" href='+advt_path+' target="_blank" >Notification<span></span></a>\
						//  									</div>\
						//  									<div class="notify_list col-md-12" style="">\
						//  										<ul id="notiul'+i+'">\
						//  										</ul>\
						//  									</div>\
						//  								</div>\
						//  								<div class="corrigendum_div col-md-6" style="margin-top:15px;margin-bottom: 20px;">\
						//  									<div class="corri_btn col-md-12" style="">\
						//  										<h6><b>Corrigendum</b></h6>\
						//  									</div>\
						//  									<div class="corri_list col-md-12" style="margin-bottom: 2%;">\
						//  										<ul id="corriul'+i+'" >\
						// 	 									</ul>\
						//  									</div>\
						//  								</div>\
						//  							</div>\
				 		// 						</div>\
				 		// 					</div>\
				 		// 				</div>\
				 		// 			</div>\
				 		// 		</div>'; 	
						
						html_code += '<div class="pt-80 pb-60 section-pattern sec-vission">\
										<div class="fluid-container" style="padding: 0em 4em;">\
											<div class="justify-content-center">\
												<div class="col-lg-4 col-md-6 wow fadeInUp">\
													<div class="single-feature">\
														<div class="row" style="display: flex;">\
															<div class="col-lg-4 mov-title"><p><b>Position:</b></p></div>\
															<div class="col-lg-8 mov-title-des"><b><p>'+program_name+'</b></p></div>\
														</div>\
														<div class="row" style="display: flex;">\
															<div class="col-lg-4 mov-title"><p><b>Advt.No: </b></p></div>\
															<div class="col-lg-8 mov-title-des"><p>'+advt_no+'</p></div>\
														</div>\
														<div class="row"><div class="mov-title"><p class="job"><b>Job Description:</b></p></div></div>\
														<div class="row"><div class="des"><p class="progdesc">'+program_desc+'</p></div></div>\
														<div class="row calndr">\
															<div class="col-md-6 col-sm-6 col-xs-6">\
																<div class="col-md-4 col-sm-3 col-xs-3 img_section">\
																	<img src="<?php echo base_url(); ?>upload/image/callender1.jpg" class="img1">\
																</div>\
																<div class="col-md-8 col-sm-9 col-xs-9" style="padding-left:0; padding-right:0">\
																	<h5 class="opendt">Open date</h5>\
																	<h5 class="progstartdt">'+action1_post_start_date+'</h5>\
																</div>\
															</div>\
															<div class="col-md-6 col-sm-6 col-xs-6">\
																<div class="col-md-4 col-sm-3 col-xs-3 img_section">\
																	<img src="<?php echo base_url(); ?>upload/image/callender1.jpg" class="img2">\
																</div>\
																<div class="col-md-8 col-sm-9 col-xs-9" style="padding-left:0; padding-right:0">\
																	<h5 class="closedt">Close date</h5>\
																	<h5 class="progenddt">'+action1_post_end_date+'</h5>\
																</div>\
															</div>\
														</div>\
														<div class="row notidiv" style="margin-bottom:10px;">\
															<div class="notice_div col-md-6" style="margin-top:15px; margin-bottom:20px">\
																<div class="notice_btn col-md-12">\
																	<a id="advtBtn'+i+'" class="btn btn-notification" href="'+advt_path+'" target="_blank" \
																	data-toggle="tooltip" title="'+advtType+', '+sizeText+'">\
																		Notification <span></span>\
																	</a>\
																</div>\
																<div class="notify_list col-md-12"><ul id="notiul'+i+'"></ul></div>\
															</div>\
															<div class="corrigendum_div col-md-6" style="margin-top:15px; margin-bottom:20px;">\
																<div class="corri_btn col-md-12"><h6><b>Corrigendum</b></h6></div>\
																<div class="corri_list col-md-12" style="margin-bottom:2%;"><ul id="corriul'+i+'"></ul></div>\
															</div>\
														</div>\
													</div>\
												</div>\
											</div>\
										</div>\
									</div>';
					
					}
				 	//html_code += '<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 tabledesign"><div class="card"><div class="card-head"><h5 style="padding-top: 20px;"><b>'+program_name+'</b></h5></div><div class="card-block "><h5 style="margin-right: 161px;"><b>Advt.No : '+advt_no+'</b></h5><h5 style="margin-right: 208px;"><b>Job Description: </b></h5><h5 style="margin-right: 145px"><b>Opening Date : '+program_start_date+'</b></h5><h5 style="margin-right: 128px;"><b>Closing Date : '+program_end_date+'</b></h5><table><tr ><td><button type="button" class="btn btn-success" style="width:100px;margin-top: 43px;margin-left: 29px;">OPEN</button></td><td><button type="button" class="btn btn-info" style="width:50px;margin-top: 43px;margin-left: 151px;"><i class="fa fa-download"></i></button></td><td><button type="button" class="btn btn-info" style="width:50px;margin-top: 43px;margin-left: 221px;"><i class="fa fa-download"></i></button></td></tr></table></div></div></div>';
				 	//console.warn(i,html_code);
				 	
				 	
				 	$.ajax({
						url:base_url+"ajax_controller/corrigendum_info",  
						type:"post",
						data:
						{
							admcode:program_code
						},
						success:function(response){
							var obj = JSON.parse(response);
							var corrilidata = '';
							if(obj.length > 0)
							{
								for(k=0; k<obj.length; k++)
								{
									corrilidata += '<li class="corrili" style="position: relative !important;" type="disc"><a href="'+obj[k]['corrigendum_path']+'" target="_blank" id="corridata'+i+''+k+'" style="color: #ffffff;">'+obj[k]['corrigendum_name']+'</a></li>';
									$("#corriul"+j+"").html(corrilidata);
								}
							}else{
								$("#corriul"+j+"").hide();
								//$("#corridata"+j+"").text('N/A');
							}
						}, 
						error:function(){
							toastr.error("We are unable to Process.Please contact Support"); 
						}
					});

					$.ajax({
						url:base_url+"ajax_controller/notice_info",  
						type:"post",
						data:
						{
							admcode:program_code
						},
						success:function(response){ 
							var obj = JSON.parse(response);
							var notiuldata = '';
							//console.log(i,obj);
							if(obj.length > 0)
							{
								for(k=0; k<obj.length; k++)
								{
									notiuldata += '<li class="notcli" style="position: relative !important;" type="disc"><a href="'+obj[k]['corrigendum_path']+'" target="_blank" id="noticedata'+i+''+k+'" style="color: ##ffffff;">'+obj[k]['corrigendum_name']+'</a></li>';
									$("#notiul"+j+"").html(notiuldata);
								}
							}else{
								$("#notiul"+j+"").hide();
								//$("#corridata"+j+"").text('N/A');
							}
						},
						error:function(){
							toastr.error("We are unable to Process.Please contact Support"); 
						}
					});
				 	
				}
			//html_code+='</div>';		
			
			$('#divPostDetail1').html('');
			$('#divPostDetail1').html(html_code);
			// $('[data-toggle="tooltip"]').tooltip();
			$('[data-toggle="tooltip"]').tooltip({ placement: 'bottom' });
	  		/*},
	  		error:function(e){
			toastr.error('Unable to load.Please Try Again');
			}	
		});*/
		
	});
	/*$.ajax({
		url:base_url+"ajax_controller/corrigendum_info",  
		type:"post",
		data:
		{
			admcode:admcode
		},
		success:function(response){ 
			var obj = JSON.parse(response);
			//console.log('67567',obj);
			if(obj[0]['corrigendum_name'] != undefined && obj[0]['corrigendum_name'] != '')
			{
				$('#corridata'+i).html(obj[0]['corrigendum_name']);	
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
	});*/
	// function reformatDate(datetimeStr)
	// {
	// 	dateStr = datetimeStr.split(" ")[0];
	//   dArr = dateStr.split("-");  // ex input "2010-01-18"
	//   return dArr[2]+ "/" +dArr[1]+ "/" +dArr[0]; //ex out: "18/01/10"
	// }
	function reformatDate(datetimeStr) {
		if (!datetimeStr) return '';

		let datePart = datetimeStr.split(/[ T]/)[0]; // split by space or T
		let dArr = datePart.includes('-') ? datePart.split('-') : datePart.split('/');

		if (dArr.length < 3) return '';

		return dArr[2] + "/" + dArr[1] + "/" + dArr[0];
	}

	// Example: program_end_date = "20/08/2025 18:30"
	function parseDateTime(dateTimeStr) {
		let parts = dateTimeStr.split(" ");
		let dateParts = parts[0].split("/"); // dd/mm/yyyy
		let timeParts = parts[1] ? parts[1].split(":") : ["00","00"]; // HH:ii
		
		// JS months are 0-based
		return new Date(
			parseInt(dateParts[2]),              // yyyy
			parseInt(dateParts[1]) - 1,          // mm
			parseInt(dateParts[0]),              // dd
			parseInt(timeParts[0]),              // HH
			parseInt(timeParts[1])               // ii
		);
	}
	
	// Get file extension from path
	// function getFileType(path) {
	// 	if (!path) return 'Unknown';
	// 	let ext = path.split('.').pop().toUpperCase();
	// 	return ext;
	// }

	// Convert bytes to human-readable size
	// function formatBytes(bytes) {
	// 	if (bytes === 0) return '0 Bytes';
	// 	const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
	// 	const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)), 10);
	// 	return parseFloat((bytes / Math.pow(1024, i)).toFixed(2)) + ' ' + sizes[i];
	// }

	// Get file size asynchronously (via HEAD request)
	function getFileSize(url, callback) {
		$.ajax({
			type: 'HEAD',
			url: url,
			success: function (data, status, xhr) {
				const fileSize = xhr.getResponseHeader('Content-Length');
				callback(fileSize ? formatBytes(fileSize) : 'Unknown size');
			},
			error: function () {
				callback('Unknown size');
			}
		});
	}

	function formatFileDetails(filePath, fileName) {
		// alert('Test');
		// Detect file extension
		const ext = filePath.split('.').pop().toLowerCase();
		let icon = '';
		switch (ext) {
			case 'pdf': icon = '<i class="fa fa-file-pdf-o" style="color:#ff0000;"></i>'; break;
			case 'doc': 
			case 'docx': icon = '<i class="fa fa-file-word-o" style="color:#2b579a;"></i>'; break;
			case 'xls':
			case 'xlsx': icon = '<i class="fa fa-file-excel-o" style="color:#217346;"></i>'; break;
			case 'jpg':
			case 'jpeg':
			case 'png': icon = '<i class="fa fa-file-image-o" style="color:#f0ad4e;"></i>'; break;
			default: icon = '<i class="fa fa-file-o"></i>';
		}

		// Dummy placeholder size (will be fetched via HEAD request if server supports)
		let fileSize = '';

		return new Promise(function(resolve) {
			$.ajax({
				type: 'HEAD',
				url: filePath,
				success: function(data, status, xhr) {
					const size = xhr.getResponseHeader('Content-Length');
					if (size) {
						const mb = (size / (1024 * 1024)).toFixed(2);
						fileSize = mb + ' MB';
					}
					resolve(`${icon} ${fileName} (${ext.toUpperCase()}, ${fileSize || 'unknown size'})`);
				},
				error: function() {
					resolve(`${icon} ${fileName} (${ext.toUpperCase()})`);
				}
			});
		});
	}

	function getFileType(filePath) {
		const ext = filePath.split('.').pop().toLowerCase();
		switch (ext) {
			case 'pdf': return 'PDF';
			case 'doc': case 'docx': return 'DOCX';
			case 'xls': case 'xlsx': return 'XLSX';
			case 'jpg': case 'jpeg': case 'png': return 'Image';
			default: return 'File';
		}
	}

	function formatBytes(bytes) {
		if (isNaN(bytes) || bytes == 0) return 'Unknown size';
		const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
		const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
		return (bytes / Math.pow(1024, i)).toFixed(2) + ' ' + sizes[i];
	}


</script>