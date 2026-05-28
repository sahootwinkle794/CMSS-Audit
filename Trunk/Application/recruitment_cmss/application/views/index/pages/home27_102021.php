 <?php 
	//$inscode1 = $this->session->set_userdata('ins_code', $institute);
	$logo = '';
	$inscode = '';
	$ins = '';
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
?>
<style>
	.notice{
		color: #fff2f2;
	}
	
	.tabledesign{
		color: #fff2f2;
		max-height: 350px;
    	overflow-y: scroll;
    	margin-top: 5px;
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
</style>
 <link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet" /> 
 <link href="<?php echo base_url(); ?>public/assets/css/text-scroll.css" rel="stylesheet" /> 
<section >
	<div class="container-fluid">
		<div class="row" >
			<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 Ann">
	            <div class="hidden-sm hidden-xs col-md-1 col-lg-1 col-xl-1 ">
	            	<label class="imgLabel-1" ><img src="<?php echo base_url()?>upload/image/ann.png"></label>
	            </div>
	            <div class="col-sm-12 col-xs-12 col-md-11 col-lg-11 col-xl-11">	
	            <div class="scroll-hr">	
					<p class="ann_label_home">
						<!--<marquee direction="left" behavior="scroll" scrollamount="5" onmouseover="this.stop();" onmouseout="this.start();" style="color: white; padding-top: 0px;">
						-->	
						<?php
								if(isset($announcements)){
									foreach($announcements as $row)
									{																	
									  echo "<a target='_blank' class='viewlink' style='text-decoration:none;color:#fff'  href=".$row['link_path'].">»&nbsp;".$row['news_details']."</a></h2>  ";   
								
									}
								} 
								  
							?>  
						<!--</marquee>-->
					</p>
				</div>
			</div>
       	</div>
		</div>
	  	<div class="row">
	  		<div class="hidden-xs hidden-sm col-md-1 col-lg-1 col-xl-1">
			</div>
			<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
			    <div id="myCarousel" class="carousel slide" data-ride="carousel">
				    <!-- Indicators -->
				    <ol class="carousel-indicators">
				      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				      <li data-target="#myCarousel" data-slide-to="1"></li>
				      <li data-target="#myCarousel" data-slide-to="2"></li>
				    
				    </ol>
				    <!-- Wrapper for slides -->
				    <div class="carousel-inner login-background">
				     <?php 
					    $i = 0;
					    foreach($carouselData as $row) 
					    {
					    	$x = '';
					    	if($i == 0)
					    	{
								$x = 'active';
							}
							$i++;
					    ?>	
					    <div class="item <?php echo $x ?>">
					        <img src="<?php echo base_url();?>upload/image/<?=$row['image_url']; ?>" style="width:100%;height:70%">
					    </div>
					    <?php
					    }
						?>
					    <!--<div class="item active">
					        <img src="<?php echo base_url(); ?>public/assets/images/bg1a_new.jpg" style="width:100%;">
					    </div>
					    <div class="item">
					        <img src="<?php echo base_url(); ?>public/assets/images/bg1a.jpg" style="width:100%;">
					    </div>
					    <div class="item">
					        <img src="<?php echo base_url(); ?>public/assets/images/DAVPKT.jpg" style="width:100%;">
					    </div>-->
					    
				    </div>

				    <!-- Left and right controls -->
				    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
				      <span class="glyphicon glyphicon-chevron-left"></span>
				      <span class="sr-only">Previous</span>
				    </a>
				    <a class="right carousel-control" href="#myCarousel" data-slide="next">
				      <span class="glyphicon glyphicon-chevron-right"></span>
				      <span class="sr-only">Next</span>
				    </a>
				</div>
				<div style="background: white;border-radius: 20px;">
					<h4 style="text-align: center;padding: 5px;border-bottom: 1px solid red;"><b>Technical Support</b></h4>
					<ul style="padding: 15px;color: red;">
						<li><b>Mobile (Tech Support):- 011-21410905/6
					(Within Working Hours Only)</b></li>
					<li><b>Email (Tech Support):- support@cmss.com</b></li>
					</ul>
					<h5>
					</h5>
				</div>
			</div>
	  		<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
	  			<!-- <div class="row" style="padding: 0;">
	  				<div class="">
				      <img src="<?php echo base_url(); ?>upload/image/<?php echo $img; ?>" style="width: 100%;background-color:black;">
				    </div>
	  			</div> -->
			    <div class="row" style="text-align: center;">
			    	<div>&nbsp;&nbsp;&nbsp;</div>
			    <span class="notice" style="color: #2098df;font-size: 16px;"><b>RECRUITMENT NOTICE</b></span>
			    <div class="tabledesign" style="background-color:#2098df; ">
			    	<table class="table table-striped table-bordered" id="tblCounsellingPeriod" width="100%">
			    			<thead>
								<tr style="background: #2f87a2;">
									<td colspan="3">Advertisement No. AD 6B 19/ 04 /2021<a style="float: right!important;padding: 1px 15px;" class="btn btn-warning" href="<?php echo base_url(); ?>upload/files/ADVERTISEMENT-Websites.pdf" target="_blank"><i class="fa fa-download"></i></a></td>
								</tr>
								<tr >
									<td style="text-align: center;">Sl No</td>
									<td style="text-align: center;">Post Name</td>
									<td style="text-align: center;">No of Post</td>
								</tr>
								<tr>
									<td style="text-align: center;">1</td>
									<td style="text-align: left;">Incubation Manager (Consultant) </td>
									<td style="text-align: center;">01</td>
								</tr>
								<tr>
									<td style="text-align: center;">2</td>
									<td style="text-align: left;">Prototype Engineer/Design Engineer (Consultant) </td>
									<td style="text-align: center;">01</td>
								</tr>
								<tr>
									<td style="text-align: center;">3</td>
									<td style="text-align: left;">Rehabilitation Professional faculty(Consultant)</td>
									<td style="text-align: center;">01</td>
								</tr>
								<tr>
									<td style="text-align: center;">4</td>
									<td style="text-align: left;">Visiting faculty (Consultant) </td>
									<td style="text-align: center;">01</td>
								</tr>
								<tr>
									<td colspan="3" style="background: #2f87a2;">Advertisement No. AD 6B 12/ 05 /2021 <a style="float: right!important;padding: 1px 15px;" class="btn btn-warning" href="<?php echo base_url(); ?>upload/files/ADVERTISEMENT-Websites-BALANGIR.pdf" target="_blank"><i class="fa fa-download"></i></a></td>
								</tr>
								<tr>
									<td style="text-align: center;">1</td>
									<td style="text-align: left;">Assistant Professor (Speech & Hearing)(Consultant) </td>
									<td style="text-align: center;">01</td>
								</tr>
								<tr>
									<td style="text-align: center;">2</td>
									<td style="text-align: left;">Assistant Professor (Clinical Psychology)(Consultant) </td>
									<td style="text-align: center;">01</td>
								</tr>
								<tr>
									<td style="text-align: center;">3</td>
									<td style="text-align: left;">Lecturer (Physiotherapy) (Consultant)(Consultant)</td>
									<td style="text-align: center;">01</td>
								</tr>
								<tr>
									<td style="text-align: center;">4</td>
									<td style="text-align: left;">Lecturer (Occupational Therapy) (Consultant) </td>
									<td style="text-align: center;">01</td>
								</tr>
								<tr>
									<td style="text-align: center;">5</td>
									<td style="text-align: left;">Special Educator/ Orientation & Mobility Instructor (Consultant) </td>
									<td style="text-align: center;">02</td>
								</tr>
								<tr>
									<td style="text-align: center;">6</td>
									<td style="text-align: left;">Clinical Assistant (Consultant) </td>
									<td style="text-align: center;">02</td>
								</tr>
							</thead>
						
					</table>
				</div>
			    </div>
			</div>
			<div class="hidden-xs hidden-sm col-md-1 col-lg-1 col-xl-1">
			</div>
			
			
		</div>
		
    	</div>
</section>
</section>
<div class="modal fade" id="date" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header" style="background-color: #00008B;">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;padding-left: 90%;"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel"style="color:#E4791A;"><b> IMPORTANT DATES</b></h4>
      		</div>
      		<div class="modal-body" style="height: 490px;">
	      		<div class="col-sm-12">
	      			<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Availability of CIPET-JEE 2018 Application Forms Can be filled on-line or downloaded form <a href="www.cipet.gov.in">www.cipet.gov.in</a></h4>
						</div>
						<div class="col-md-1">
							<h4 style="color: #0054ff;">:</h4>
						</div>
						<div class="col-md-4">
							<h4 style="color: #0054ff;padding-right:10px;padding-right:20px;    margin-left: -15px; font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>Last week of February 2018</b></h4>
						</div>
					</div>
					<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Last date for issue and receipt of duly filled in Application forms</h4>
						</div>
						<div class="col-md-1">
							<h4 style="color: #0054ff;">:</h4>
						</div>
						<div class="col-md-4">
							<h4  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>12<sup>th</sup> May 2018</b></h4>
						</div>
					</div>
					<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Issue of JEE Hall Tickets(for eligible candidates) - Can be downloaded from <a href="www.cipet.gov.in">www.cipet.gov.in</a></h4>
						</div>
						<div class="col-md-1">
							<h4 style="color: #0054ff;">:</h4>
						</div>
						<div class="col-md-4">
							<h4  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>Third week of May 2018</b></h4>
						</div>
					</div>
					<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Date of Joint Entrance Examination(JEE)</h4>
						</div>
						<div class="col-md-1">
							<h4 style="color: #0054ff;">:</h4>
						</div>
						<div class="col-md-4">
							<h4  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>3<sup>rd</sup> June 2018</b></h4>
						</div>
					</div>
					<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Release of JEE Result Can be Downloaded from <a href="www.cipet.gov.in">www.cipet.gov.in</a></h4>
						</div>
						<div class="col-md-1">
							<h4 style="color: #0054ff;">:</h4>
						</div>
						<div class="col-md-4">
							<h4  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>Third week of June 2018</b></h4>
						</div>
					</div>
					<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"> Issue of Admission Call Letters(for selected candidates)- Can be downloaded form <a href="www.cipet.gov.in">www.cipet.gov.in</a></h4>
						</div>
						<div class="col-md-1">
							<h4 style="color: #0054ff;">:</h4>
						</div>
						<div class="col-md-4">
							<h4  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>Last week of June 2018</b></h4>
						</div>
					</div>
					<div class="row">
	      				<div class="col-md-1">
	      					<span><i class="fa fa-share" aria-hidden="true" style="color:#0054ff;margin-top: 12px;margin-left: 18px;"></i></span>
	      				</div>
						<div class="col-md-6">
							<h4 align="justify" style="color: #0054ff;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b> New session (2018-19) begins</b></h4>
						</div>
						<div class="col-md-1">
							<h4 style="color: #0054ff;">:</h4>
						</div>
						<div class="col-md-4">
							<h4  style="color: #0054ff;padding-right:10px;    margin-left: -15px;font-size: 14px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>August 1, 2018</b></h4>
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
        <h4 class="modal-title" id="myModalLabel"><b>Admit Card Details</b></h4>
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
        <h4 class="modal-title" id="myModalLabel"><b>Instruction Details</b></h4>
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
<div class="modal fade" id="mycourse" tabindex="-1" role="dialog" aria-labelledby="mycourse" aria-hidden="true">
	<div class="modal-dialog" style="width: 600px;">
    	<div class="modal-content">
    		<div class="modal-header" style="background-color: #00008B;">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;padding-left: 90%;"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel"style="color:#E4791A;"><b>Course Details</b></h4>
      		</div>
      		<div class="modal-body" style="height: 490px;">
	      		<div class="col-sm-12">
  					<!--<div class="col-sm-7" style="margin-top: 30px;">-->
		       			<!--<div class="panel panel-default" >-->
			        	   <!--	<div class="panel-heading" style="background-color: #6973B0;border-color: #6973B0; color: #ffffff;text-align: center;">
				      			<h4 style="font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">DIPLOMA PROGRAM DETAILS</h4>
				        	</div>-->
			        		<!--<div class="panel-body" style=" max-height: auto;">-->
	       						<div class="row">	
						       		<div class="col-md-12" style=" margin-top: 10px;">
	       								<div class="panel-group" id="accordion">
						       				<?php
												$i = 1;
												$c = "";
												foreach($program_data as $program)
												{ ?> 
													<div class="panel panel-default ">
														<div class="row" style="">
															<div class="col-lg-12">
																<div class=" ">
																	<div class="panel-heading" style="min-height: 40px; max-height: auto; <?php echo $program['appl_status']!=''?'background-color: #0E7155;':'background-color: #0d367e;'?>">
																		<div class="col-lg-12 ">
																			<h4 class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$i?>" style="color: #d3dbe9;cursor: pointer;"><?php echo $program['program_name'] ?></h4>
																		</div>
																		<!--<div class="col-lg-3 " style="padding-top:2%">
																			<?php if($program['appl_status']=='Verified'){ ?>
																				<span title="Apply Now" class="label pull-right"  onclick="navigate('<?php echo $program['program_code'] ?>')" style="background-color: rgb(228, 121, 26); color: rgb(255, 255, 255);"><i class="fa fa-file"></i>  View</span>
																			<?php }elseif($program['appl_status']!='Verified' && $program['appl_status']!=''){ ?>
																				<span title="Apply Now" class="label pull-right"  onclick="navigate('<?php echo $program['program_code'] ?>')" style="background-color: rgb(228, 121, 26); color: rgb(255, 255, 255);"><i class="fa fa-edit"></i>  Not Completed</span>
																			<?php }else{ ?>
																				<span title="Apply Now" class="label pull-right"  onclick="navigate('<?php echo $program['program_code'] ?>')" style="background-color: rgb(228, 121, 26); color: rgb(255, 255, 255);"><i class="fa fa-send"></i>  Apply</span>
																			<?php } ?>
																		</div>-->
																	</div>
																</div>
															</div>
														</div>
												        <div id="collapse<?=$i?>" class="panel-collapse collapse <?php echo $i==1?'in':''?>">
												        	<div class="panel-body" style="height: 170px;">
													        	<h6 style="color: #0054ff;margin-left:5px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">Course code: <span><b><?php echo $program['program_code'] ?></b></span></h6>
										       					<h6 style="color: #0054ff;margin-left:5px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">Duration: <span>3 years(6 semesters)</span></h6>
										       					<h6 style="color: #0054ff;margin-left:5px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>Minimum age:15 years<sup>*</sup></b></h6>
										       					<h6 style="color: #0054ff;margin-left:5px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;padding-right: 5px;">Entry qualification: 35% marks (all subject together) in X std. with Mathematics,Science and English.</h6>
										       					<!--<span class="glyphicon glyphicon-send fa-lg details-favoriteicon" title="Apply Now" aria-hidden="true" onclick="navigate('<?php echo $program['program_code'] ?>')" style="color: #0054ff;margin-left: 88%;margin-top: -10px;"></span>-->	
										       					<!--<button title="Apply Now" class="btn btn-sm pull-right" type="button" onclick="navigate('<?php echo $program['program_code'] ?>')" style="background-color: rgb(228, 121, 26); color: rgb(255, 255, 255);"><i class="fa fa-send"></i>  Apply Now</button>
													       		
													       		<?php if($program['appl_status']=='Verified'){ ?>
													       		<button title="Print Application" class="btn btn-success btn-sm pull-right" type="button" onclick="printApplication('<?php echo $program['program_code'] ?>')" style="margin-right: 8px;"><i class="fa fa-print"></i>  Print Application</button>	
													       		<?php } ?>
													       		<button title="Course Details" class="btn btn-info btn-sm pull-right" type="button" onclick="viewCourse('<?php echo $program['program_code'] ?>')" style="margin-right: 8px;"><i class="fa fa-file-text"></i>  Course Details</button>	-->
													        
													       
													        </div>
												      	</div>
											    	</div>
												<?php	$i++;
												 }
												?> 
			  							</div> 
								    </div>
			   					</div>		       						
							<!--</div>-->
						<!--</div>-->
					<!--</div> -->
	      		</div>
	    	</div>
    	</div>
   	</div> 
</div>
<?php 
	

?>
<script>
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
</script>