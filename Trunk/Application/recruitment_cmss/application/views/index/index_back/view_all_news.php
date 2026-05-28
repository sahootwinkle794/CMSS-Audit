 <?php 
	//$inscode1 = $this->session->set_userdata('ins_code', $institute);
	$logo = '';
	$inscode = '';
	$ins = '';
	$insname = '';
	foreach($institute as $row){ 
		$ins_code = $row['institute_code'];
		$ins_name = $row['institute_name'];
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
	foreach($postname as $row) {
		$program_code = $row['program_code'];
		$program_name = $row['program_name'];
		$year = $row['year'];
		$apply_start_date = $row['apply_start_date'];
	}
	foreach($vacancy_details as $row){
		$classification = $row['classification'];
		$ministry = $row['ministry'];
		$department = $row['department'];
		$organisation = $row['organisation'];
		$pay_scale = $row['pay_scale'];
		$age = $row['age'];
		$desired_qualification = $row['desired_qualification'];
		$duties = $row['duties'];
		$probotion_period = $row['probotion_period'];
		$head_quarter = $row['head_quarter'];
		$other_details = $row['other_details'];
	}
	foreach($reservation_details as $row){
		$program_code = $row['program_code'];
		$category_code = $row['category_code'];
		$vacancy_no = $row['vacancy_no'];
	}
?>
<style>
	@import url('https://fonts.googleapis.com/css?family=Montserrat|Open+Sans|Poppins&display=swap');
</style>
<style>

	.table-bordered {
    border: 0px solid #f4f4f4;
}
	p{
		color: #6a0000;
		font-size: 13px;
		font-family: Montserrat !important;
		
	}
	.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
    	border: 0px solid #fff;
    }
    table.front {
    background-color: #ffffff;
    border: 1px solid #29A9EA;
    border-collapse: collapse;
    width: 100%;
	}
	
	table.front td {
    border: 1px solid #29A9EA;
    padding: 8px 10px;
    color: #000000;
    vertical-align: top;
	}
	
	.box-head {
    background: #003;
    height: 32px;
    color: #fff;
    padding: 0 10px;
    line-height: 32px;
    white-space: nowrap;
    border-bottom: solid 1px #fff;
    text-align: center;
	}
	.image { 
	   position: relative; 
	   width: 100%; 
	   padding-left: 0px;left: -16px;
	   /* for IE 6 */
	}
	.imgLabel { 
	   position: absolute; 
	   color: white;
	   top: 5px; 
	   left: 16px; 
	   width: 100%; 
	   font-size: 15px;
	}
	.box_square {
	    float: left;
	    width: 12px;
	    height: 10px;
	    margin: 6px;
	    background: black;
	    margin-left: 32px;
	}
	.box_square_large {
	    width: 95px;
		height: 60px;
		background: black;
	}
	.box_rect {
	    float: left;
		width: 20px;
		height: 8px;
		margin: 8px;
		    
		background: black;
		margin-left: 225px;
	}
	.box_line {
	    float: left;
	    width: 854px;
	    height: 1px;
	    margin: 12px;
	    background: black;
	    margin-left: -8px;
	}
	.welcome{
		top: -3px;
		left: 49px;
		font-size: 22px;
		font-weight: 600;
	}
	.APPSC {
	    top: -2px;
	    left: 196px;
	    font-size: 20px;
	    font-weight: 600;
	}
	.inner-box{
		position: absolute;
		width: 60px;
		height: 60px;
		display: block;
		background: #cbd4a5;
		border-radius: 4px;
		margin: -78% 125px 0;
		z-index: 99;
		
	}
	.img-box{
		
		width: 110px;
		height: 110px;
		position: absolute;
		display: block;
		background: #a1a1a1;
		border-radius: 4px;
		margin: -76% 134px 0;
		z-index: 99;
	}
	.img-box img{
		
		width: 100%;
		height: 100%
	}
	p
	{
		color: black;
	}
	.panel-default {
	    border-color: rgb(235, 33, 47);
	}
	.panel {
	    margin-bottom: 20px;
	    background-color: #fff;
	    border: 0px solid transparent;
	        border-top-color: transparent;
	        border-right-color: transparent;
	        border-bottom-color: transparent;
	        border-left-color: transparent;
	    border-radius: 0px;
	    -webkit-box-shadow: 0 0px 0px rgba(0, 0, 0, .05);
	    box-shadow: 0 0px 0px rgba(0, 0, 0, .05);
	}
	.panel-heading {
	    padding: 10px 15px;
	    border-bottom: 1px solid transparent;
	    border-top-left-radius: 0px;
	    border-top-right-radius: 0px;
	}
	button {
	    position: absolute;
	    background: #151414;
	    border: 1px solid #1e1c1c;
	    padding: 3px;
	}
	.button-black {
	    color: #f5f1f1;
	    width: 81px;
	    height: 39px;
	    margin-top: -10px;
	    float: right;
	    left: 88%;
	    background: black;
	    border: 1px solid #1e1c1c;
	}
	.box_down {
	    width: 83%;
	    height: 365px;
	    background: linear-gradient(to bottom right, #CEFBD2 30%, #5BBADA 100%);
	    border-radius: 5px;
	    
	}
	.inner-box-down
	{
		
		padding: 23px;
		width: 85%;
		left: 8%;
		box-shadow: 3px 4px 4px 0  rgba(0,0,0,0.19), 0 4px 4px 0 rgba(0,0,0,0.19);
		border-radius: 7px;
	}
	.gradient1
	{
		background: linear-gradient(to right, #8FEEAE 30%, #1AA8B4 100%);
		margin-top: 25px;
	}
	.gradient2
	{
		background: linear-gradient(to right, #67D5AE 20%, #0991B7 100%);
		margin-top: 10px;
	}
	.gradient3
	{
		background: linear-gradient(to right, #38BAB2 10%, #0982B9 100%);
		margin-top: 10px;
	}
	body{
		
		background: #fff !important;
	}
	.Ann
	{
		background-color: black;
		height: 38px;
		border-radius: 20px;
		padding-bottom: 20px;
		width: 90%;
		left: 3%;
	}
	.profile-desc{
	    margin-top: -172px;
	    margin-left: 20px;
	    position: absolute;
	    text-align: justify;
	    width: 76%;
	   
	}
	.profile-desc label{
		color:black;
		text-align: center;
		font-size: 12px;
		font-weight: bold;
	}
	.profile-desc label.title{
		left: 40%;
	    position: absolute;
	    top: -30px;
	}
	.profile-desc label.readmore{
	    width: 100px;
	    white-space: nowrap;
	    top: 126px;
	    left:66%;	
	}
	.sideimg{
		left: -45px;
	}
	label.APPSC{
		position: absolute;
	}
	.ann_label
	{
		left: 20%;
		font-size: 14px;
	}
	.marginleft{
		margin-left: 30px;
	}
	.shadow-box:hover {
	    box-shadow: 0 4px 6px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
	}
	@media screen and (max-width:680px){
		
		.marginleft{
			margin-left: 0px;
		}
		.mgandhi{
			
			width:103%;
		}
		.sideimg{
			left: -14px;
		}
		.inner-box{
			margin-top: -318px;
    		margin-left: 100px;
		}
		.img-box{
			 margin-top: -309px;
			margin-left: 109px;
			width: 80px;
			height: 80px;
		}
		.profile-desc{
			margin-left: 10px;
		    position: absolute;
		    text-align: justify;
		    width: 90%;
		}
		.profile-desc label.title{
			color:black;
			text-align: center;
			font-size: 12px;
			font-weight: bold;
			margin-top: -16px;
			left: 53%;
		}
		.profile-desc label.readmore{
			margin-top: 19px;
		    width: 100px;
		    white-space: nowrap;
		    left: 107px;
		}
		.box_square{
			margin-left:14px;
		}
		label.welcome{
			color: #d8021c;
		    position: relative;
		    font-size: 16px;
		    display: inline-block;
		    left: unset;
		    top: unset;
		    width: unset;
		}
		label.APPSC{
			position:relative !important;
			display: inline-block;
			left: 10px;
			font-size: 18px;
		}
		.box_rect, .box_line{
			
			display:none;
		}
		.box_line {
		    float: unset;
		    width: unset;
		    height: unset;
		    margin: unset;
		    background: unset;
		    margin-left: unset;
		}
		.box_rect {
		    float: unset;
		    width: unset;
		    height: unset;
		    margin: unset;
		    background: unset;
		    margin-left: unset;
		}
		.ann_label
		{
			left: 20%;
		    font-size: 12px;
		    color: black;
		    margin-top: 28px;
		}
		.box_square_large{
			
			float:none
		}
		
		
	}
	
	</style>

 <link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet" /> 
<!--<section style="background: url(<?php echo base_url(); ?>upload/image/background_image.jpg);">-->
<section style="background:#fff !important;">
	<div class="container-fluid" style="min-height: 1000px;">
		<div class="row" >
			<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8" style="padding-right: 7px;padding-left: 0px;">
				
				<img class="mgandhi" src="<?php echo base_url()?>public/assets/images/icon/Slider.jpg">
				
			</div>

			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 sideimg" >
				<img style = "height: 338px;"src="<?php echo base_url()?>public/assets/images/icon/Bg.jpg">
				<div class="inner-box"></div>
				<div class="img-box">
				</div>
				<div class="profile-desc">
					<label class="title">Chairman</label>
					<center><p>Arunachal Pradesh Public Service Commission,<br/>
						Pratibha Sadan <br/>
					</p></center>
					
					<p>The Arunachal Pradesh Public Service Commission established in 1988 
					have been performing its role as guardian of</p>
					<label style="" class="readmore">  Read more>></label>
	                
	            </div>
			</div>

		</div>
		<div class="row">
			<div class="col-sm-12 col-xs-12 "style="padding-left: 0px;top: 15px;padding-bottom: 15px;">
	        	<div class="box_square"></div>
	        	<label class= "welcome"style="color: #d8021c">Welcome To</label><label class= "APPSC" style="color:black";> APPSC </label>
				<div class="box_rect"></div>
				<div class="box_line"></div>
				
			</div>
			<div class="col-md-12">
				<label style="color:black;text-align: justify;padding-right: 6%;padding-left: 2%;font-size: 13px;position:relative">The Arunachal Pradesh Public Service Commission (APPSC) is a Constitutional body constituted with effect from 1st April 1988 under Article-315 of the Constitution of India vide Notiﬁcation OM-15/88 dated 29th March 1988. The Commission advice the Government of Arunachal Pradesh on all matters relating to state civil services and publish notiﬁcations inviting applications for selection to various posts as per the requisitions of the appointing authorities, conduct written tests and interview, prepare ranked list based on the performance of the candidates and advice candidates for appointing strictly based on their merit and observing the rules of reservation as and when vacancies are repor are reported</label>
			</div>	
		</div>
       	<div class="row" style="padding:25px 0">
			<div class="col-sm-12 col-xs-12 Ann">
	            <div class="col-sm-3 col-xs-3 image">
	            	<label class="imgLabel"><img src="<?php echo base_url()?>public/assets/images/icon/Annoucements.png">&nbsp;Annoucements</label>
					<img src="<?php echo base_url()?>public/assets/images/icon/Ann.png">
					<label class="ann_label">
						<marquee direction="left" behavior="scroll" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();" style="color: white; padding-top: 0px;">
							<?php
								if(isset($announcements)){
									foreach($announcements as $row)
									{																	
									  echo $row['news_details'];
									  echo "&nbsp;&nbsp;|&nbsp;&nbsp;";
									}
								}
								 
							?>  
						</marquee>
					</label>
					
				</div>
			</div>
       	</div>

		<div class="row" style="padding:25px 0">
			<div class="col-md-7">
				
				<div class="panel panel-default marginleft">
					<div class="panel-heading" style="background-color: rgb(235, 33, 47);height:40px;">
						<h4 class="panel-title" style="color: #fff;cursor: pointer;"><img src="<?php echo base_url()?>public/assets/images/icon/Apply.png"> Latest News
						<button type="button" onclick="window.location.href = '<?=base_url()?>index/all_news/ins/<?=$ins_code?>';"  title="View All" data-placement="top" data-toggle="tooltip" class="pull-right button-black" >
							
								View All 
							
						</button>
						</h4>
						
					</div>
					<style>
						.article-div{
							
							width:100%;
							margin:7px 0;
						}
						.article-div article{
							width: 16.66%;
							float:left;
							display:inline-block;
						}
						.article-div aside{
							width:81.44%;
							float:right;
							display:block;
						}
						@media screen and (max-width:680px){
							.article-div article{
								width: 100%;
								float:none;
								display:inline-block;
							}
							.article-div aside{
								width:100%;
								float:none;
								display:block;
								margin-top:7px;
							}
							.button-black{
								float:none;
								left:unset;
								right:0;
								
							}
						}
					</style>
					
			        	<div class="panel-body" style="background-color:#F2F2F2; height: 300px; overflow-y: scroll;">
			        		<?php foreach($news_details as $row)
							{ 
								$created_date = $row['created_on'];
								$arr_date = explode("-",$created_date);
								$date = $arr_date[0];
								$month = $arr_date[1];
								$year = $arr_date[2];
								$news = $row['news_details'];
							?>
			        		<div class="article-div clearfix">
			        			<article>
				        			<div class="row box_square_large">
				        				<div class="col-sm-12">
				        					<div class="col-sm-4" style="color:#fff;padding-top:10px">
				        						<h2 style="color:#fff;font-size:20px;margin-left:-10px;margin-top:10px;"><?=$date?></h2>
				        					</div>
				        					<div class="col-sm-8" style="color:#fff;margin-left: 26px;margin-top:-42px">
				        						<span><?= $month ?></span>
				        						<span><?= $year ?></span>
				        					</div>
				        					
							        	</div>
				        			</div>
			        				
			        			</article>
			        			<aside style="margin-top: 8px;">
			        				<p><?= $news ?></p>
			        			</aside>
			        		</div>
			        		<?php 
					        	} 
					        ?>
				        </div>
			      	
		    	</div> 
				
			</div>

			<div class="col-md-5">
				<div class="box_down">
					<div class="row-sm-12 row-xs-12" style="" >
						<div class="row-sm-2 row-xs-2"  ></div>
				       <div class="row-sm-3 row-xs-3 " style="cursor: pointer;" >
					        <div  class="col-sm-12 col-xs-12 shadow-box inner-box-down gradient1">

					        	<p align="left" style="color: #fff;font-size: 15px" ><img src="<?php echo base_url()?>public/assets/images/icon/examination.png"> Examination</p>
					         
					        </div>
				       </div>
				       <div class="row-sm-3 row-xs-3" style="cursor: pointer;" >
					        <div  class="col-sm-12 col-xs-12 shadow-box inner-box-down gradient2">

					        	<p align="left" style="color: #fff;font-size: 15px" ><img src="<?php echo base_url()?>public/assets/images/icon/Previous years.png"> Previous years Question Papers </p>
					         
					        </div>
				       </div>
				       <div class="row-sm-3 row-xs-3 " style="cursor: pointer;" >
					        <div  class="col-sm-12 col-xs-12 shadow-box inner-box-down gradient3">

					        	<p align="left" style="color: #fff;font-size: 15px" ><img src="<?php echo base_url()?>public/assets/images/icon/Telephone Directory.png"> Telephone Directory</p>
					         
					        </div>
				       </div>
					</div>
				</div>

			</div>
		</div>
	</div>
	
</section>

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
	}

?>
