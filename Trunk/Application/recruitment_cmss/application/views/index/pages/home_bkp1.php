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
		font-size: 13px;
		line-height: 20px;
		top: 101px;
    	left: 34px;
    	grid-template-columns: 62% 1fr;
    	display: grid;
    	text-align: justify;
	}
	.noticeinnerclass{
		height: 31px;
	    width: 101px;
	    top: 30px;
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
	    margin-left: 12px;
	    padding: 20px;
	    margin-top: -23px;
	    height: auto;
	    left: 137px;
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
	/*.notic{
		position: absolute;
		width: 142px;
		height: 42px;
		left: 32px;
		/*top: 637px;*/
		/*background: #066055;
		border-radius: 7px;
	}*/
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
	.vl{
		border-left: 1px solid #ADADAD;
	    height: 129px;
	    position: absolute;
	    left: 49%;
	    top: 173px;
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
	.img1{
		vertical-align: middle;
	    border: 0;
	    height: 33px;
	    margin-left: 0px;
	    margin-right: auto;
	}
	.opendt{
		position: absolute;
	    width: 86px;
	    height: 42px;
	    left: 84px;
	    bottom: 1px;
	    /*top: 101px;*/
	    font-family: Exo 2;
	    font-style: normal;
	    font-weight: normal;
	    font-size: 14px;
	    line-height: 150%;
	    color: #000000;
	}
	.closedt{
		position: absolute;
	    width: 86px;
	    height: 42px;
	    left: 83px;
	    bottom: 1px;
	    font-family: Exo 2;
	    font-style: normal;
	    font-weight: normal;
	    font-size: 14px;
	    line-height: 150%;
	    color: #000000;
	}
	.advt{
		margin-right: 17px;
		margin-bottom: 1px;
	}
	.notcli{
		position: absolute;
		width: auto;
		height: auto;
		left: 45px;
		top: 41px;
		font-family: Exo 2;
		font-style: normal;
		font-weight: normal;
		font-size: 12px;
		line-height: 120.5%;
		text-transform: capitalize;
		font-feature-settings: 'case' on;
		color: #0108AF;
		text-align: initial;
	}
	.corrili{
		position: absolute;
		width: auto;
		height: auto;
		left: 45px;
		top: 41px;
		font-family: Exo 2;
		font-style: normal;
		font-weight: normal;
		font-size: 12px;
		line-height: 120.5%;
		text-transform: capitalize;
		font-feature-settings: 'case' on;
		color: #0108AF;
		text-align: initial;
	}
	.jobdes{
		margin-right: 258px;
	}
	@media (max-width: 768px){
		.header{
			width: 605px;
		    height: 212px;
		    left: 87px
		}
	}
	
		
</style>
 <link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet" /> 
 <link href="<?php echo base_url(); ?>public/assets/css/text-scroll.css" rel="stylesheet" /> 
<section class="sec">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 header">
				<p class="aaa">JOIN OUR TEAM</p>
				<p class="bbb">WE'RE HIRING</p>
				<p class="ccc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis blandit erat, vitae efficitur neque. Quisque ac ex quis ipsum blandit suscipit. Vivamus porttitor lorem vel fringilla interdum. Nullam ac nisl velit. Curabitur dictum varius velit, sed sagittis libero. Maecenas id porttitor diam. Nullam pellentesque eros odio, et maximus mauris cursus at. </p>
	            <IMG src="<?php echo base_url(); ?>upload/image/banner.svg" align="right" />
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
			
	  		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 2%;margin-top: 16%;">
	  			<!-- <div class="row" style="padding: 0;">
	  				<div class="">
				      <img src="<?php echo base_url(); ?>upload/image/<?php echo $img; ?>" style="width: 100%;background-color:black;">
				    </div>
	  			</div> -->
			    <div class="row" style="text-align: center;">
			    <!--<div>
					<span class="notice" style="margin-right: 67%;"><b>Current Openings</b></span>
				</div> -->	
			    <!--<div> 
					<button type="button" class="btn btn-primary center-block noticeinnerclass" id="btnView" name="btnView" style="float: right" onclick='location.href="<?php echo base_url(); ?>Index/view_all/<?php echo $this->uri->segment(4);?>"'>View All</button>
				</div>-->
			    
			    <hr style="width: 82%;margin-left: 108px;border-color: #13434D;">
			    <!--<div class="row" id="divPostDetail1">
				</div>-->
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

<?php 
	

?>
<script>
base_url = "<?php echo base_url()?>"; 
	$(document).ready(function() {
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
		var ins = "<?=$ins?>";
		var date = "<?=date('d/m/Y/H/i')?>";
//		var res1 = Array();
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
//	  			var res1 = JSON.parse(response); 
	  			
				
				for(i=0,j=0;i<res1.length;i++,j++){
					let j = i;
					program_code = res1[i]['program_code'];
				 	advt_no = res1[i]['advt_no'];
				 	advt_date = res1[i]['advt_date'];
				 	program_name = res1[i]['program_name'];
				 	program_desc = res1[i]['program_desc'];
				 	program_start_date = reformatDate(res1[i]['program_start_date']);
				 	program_end_date = reformatDate(res1[i]['program_end_date']);
				 	apply_start_date = reformatDate(res1[i]['apply_start_date']);
				 	apply_end_date = reformatDate(res1[i]['apply_end_date']);
				 	apply_start_datetime = res1[i]['apply_start_datetime'];
				 	corrigendum_name = res1[i]['corrigendum_name'];
				 	corrigendum_path = res1[i]['corrigendum_path'];
				 	result_name = res1[i]['result_name'];
				 	result_file_path = res1[i]['result_file_path'];
				 	corrigendum_type = res1[i]['corrigendum_type'];
				 	//window.liData = '';
				 	
				 	//liData = hhhh;
				 	//html_code += '<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 tabledesign"><div class="card"><div class="card-head"><div class="row"><div class="col-lg-4"><p style="padding-top: 20px;margin-right: 13px;margin-bottom: 1px;"><b>Position :</b></p></div><div class="col-lg-8"><b><p style="padding-top: 20px;position: absolute;margin-left: -23px;"> '+program_name+'</b></p></div></div></div><div class="card-block "><div class="row"><div class="col-lg-4"><p class="advt"><b>Advt.No : </p></div><div class="col-lg-8"><p style="position: absolute;margin-left: -23px;">'+advt_no+'</b></p></div></div><div class="row"><div><p style="margin-right: 210px;"><b>Job Description: </b></p></div><p class="des">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis blandit erat, vitae efficitur neque.Quisque ac ex quis ipsum blandit suscipit.Quisque ac ex quis ipsum blandit suscipit.</p></div><div class="row"><div class="col-md-6"><div align="left" class="col-sm-2 col-md-2 col-xs-2" style="padding-right:15px; padding-left:15px;"><img src="<?php echo base_url(); ?>upload/image/calender.svg"  class="img1" ></div><div class="opendt">Opening date</div><div style="margin-top:13px;">'+program_start_date+'</div></div><div class="col-md-6"><div align="right" class="col-sm-2 col-md-2 col-xs-2" style="padding-right:15px; padding-left:15px;"><img src="<?php echo base_url(); ?>upload/image/calender.svg"  class="img1" ></div><div class="closedt">Closing date</div><div style="margin-top:13px;">'+program_end_date+'</div></div></div><div class="row"><div class="col-md-6" style="top: 7px;"><button type="button" class="btn btn-info notic">Notification <i class="fa fa-download"></i></button></div><div class="col-md-6" style="top: 7px;"><button type="button" class="btn btn-info corri">Corrigendum <i class="fa fa-file-pdf-o"></i></button></div></div><div class="row"><div class="col-md-12"><button type="button" class="btn btn-info applyn">Apply Now &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button></div></div></div></div></div>';
				 	html_code += '<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 tabledesign">\
				 					<div class="card">\
				 						<div class="card-head">\
				 							<div class="row">\
				 								<div class="col-lg-4">\
				 									<p style="padding-top: 20px;margin-right: 13px;margin-bottom: 1px;"><b>Position :</b></p>\
				 								</div>\
				 								<div class="col-lg-8">\
				 									<b><p style="padding-top: 20px;position: absolute;margin-left: -23px;"> '+program_name+'</b></p>\
				 								</div>\
				 							</div>\
				 						</div>\
				 						<div class="card-block ">\
				 							<div class="row">\
				 								<div class="col-lg-4">\
				 									<p class="advt"><b>Advt.No : </p>\
				 								</div>\
				 								<div class="col-lg-8">\
				 									<p style="position: absolute;margin-left: -23px;">'+advt_no+'</b></p>\
				 								</div>\
				 							</div>\
				 							<div class="row">\
				 								<div><p class="jobdes" style="margin-left: 13px;margin-bottom: 5px;"><b>Job Description: </b></p></div>\
				 								<p class="des">'+program_desc+'</p>\
				 							</div>\
				 							<div class="row">\
				 								<div class="col-md-6">\
				 									<div align="left" class="col-sm-2 col-md-2 col-xs-2" style="padding-right:15px; padding-left:15px;">\
				 										<img src="<?php echo base_url(); ?>upload/image/calender.svg"  class="img1" >\
				 									</div>\
				 									<div class="opendt">Opening date</div>\
				 										<div style="margin-top:13px;">'+program_start_date+'</div>\
				 									</div>\
				 									<div class="col-md-6">\
				 										<div align="right" class="col-sm-2 col-md-2 col-xs-2" style="padding-right:15px; padding-left:15px;">\
				 											<img src="<?php echo base_url(); ?>upload/image/calender.svg"  class="img1" >\
				 										</div>\
				 										<div class="closedt">Closing date</div>\
				 										<div style="margin-top:13px;">'+program_end_date+'</div>\
				 									</div>\
				 								</div>\
				 							<div class="row">\
				 								<div class="col-md-6" style="top: 7px;">\
				 									<div class="notic"><span class="notctext">Notification</span></div>\
				 										<ul id="notiul'+i+'">\
				 										</ul>\
				 								</div>\
				 								<div class="vl"></div>\
				 								<div class="col-md-6" style="top: 7px;">\
				 									<div class="corri"><span class="corritext">Corrigendum</span></div>\
				 										<ul id="corriul'+i+'">\
				 										</ul>\
				 								</div>\
				 							</div>\
				 							<div class="row">\
				 								<div class="col-md-12">\
				 									<button type="button" class="btn btn-info applyn" onclick="btnlogin()">Apply Now &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>\
				 								</div>\
				 							</div>\
				 						</div>\
				 					</div>\
				 				</div>&nbsp;';
				 	
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
									corrilidata += '<li class="corrili" style="position: relative !important;" type="disc"><a href="'+obj[k]['corrigendum_path']+'" target="_blank" id="corridata'+i+''+k+'" style="color: #0108AF;">'+obj[k]['corrigendum_name']+'</a></li>';
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
									notiuldata += '<li class="notcli" style="position: relative !important;" type="disc"><a href="'+obj[k]['corrigendum_path']+'" target="_blank" id="noticedata'+i+''+k+'" style="color: #0108AF;">'+obj[k]['corrigendum_name']+'</a></li>';
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
	function reformatDate(datetimeStr)
	{
		dateStr = datetimeStr.split(" ")[0];
	  dArr = dateStr.split("-");  // ex input "2010-01-18"
	  return dArr[2]+ "/" +dArr[1]+ "/" +dArr[0]; //ex out: "18/01/10"
	}
</script>