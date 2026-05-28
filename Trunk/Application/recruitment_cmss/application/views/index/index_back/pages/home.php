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
	/*foreach($postname as $row) {
		$program_code = $row['program_code'];
		$program_name = $row['program_name'];
		$year = $row['year'];
		$apply_start_date = $row['apply_start_date'];
	}*/
	/*foreach($vacancy_details as $row){
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
	}*/
?>
<link href="<?php echo base_url(); ?>public/assets/css/apssb_home_style.css" rel="stylesheet" /><!--


 <link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet" /> -->
<!--<section style="background: url(<?php echo base_url(); ?>upload/image/background_image.jpg);">-->
<a id="back2Top" title="Back to top" href="#" style="display: block;"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
<section>
	<!--<div id="main-menu-container">
    <nav class="navbar navbar-default navbar-static-top" style="background: #62494c;margin-left: -140px;">
      <div class="container" role="main1" id="main1"  style="padding: 0;">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" style="padding-right: 39px;">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
	        </button>
	    </div>
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding: 0; margin: 0;">
	      <ul class="nav navbar-nav ul-top">
			    <li class="nav-color" onclick="window.location.href = '<?=base_url()?>Index/institute_home/ins/<?=$ins_code?>';" style="cursor: pointer">
					<i style = "font-size: 22px;margin-top: 45px;"class="fa fa-home"></i>
				</li>
				<li>
					<a href="" style="color: #fffffb;text-transform: none;font-size: 15px; font-family: Montserrat !important;">Organisation</a>
				</li>
				<li>
					<a href=""  style="color: #fffffb;text-transform: none;font-size: 15px; font-family: Montserrat !important;">Examinations</a>
				</li>
				<li>
					<a href=""  style="color: #fffffb;text-transform: none;font-size: 15px; font-family: Montserrat !important;">Telephone Directory</a>
				</li>
				<li >
					<a href=""  style="color: #fffffb;text-transform: none;font-size: 15px; font-family: Montserrat !important;">Departmental Test</a>
				</li>
				<li>
					<a href=""  style="color: #fffffb;text-transform: none;font-size: 15px; font-family: Montserrat !important;">Recruitment Results</a>
				</li>
				<li>
					<a href=""  style="color: #fffffb;text-transform: none;font-size: 15px; font-family: Montserrat !important;">Annual Reports</a>
				</li>
				<li>
					<a href=""  style="color: #fffffb;text-transform: none;font-size: 15px; font-family: Montserrat !important;">General Information</a>
				</li>
				<li>
					<a href=""  style="color: #fffffb;text-transform: none;font-size: 15px; font-family: Montserrat !important;">RTI</a>
				</li>
				<li>
					<a href=""  style="color: #fffffb;text-transform: none;font-size: 15px; font-family: Montserrat !important;">Contact Us</a>
				</li>

	    	</ul>
		</div>
	  </div>
	</nav>
</div>-->
    <div class="row" >
    		
			<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 Ann">
	            <div class="hidden-sm hidden-xs col-md-1 col-lg-1 col-xl-1 ">
	            	<label class="imgLabel-1" ><img src="<?php echo base_url()?>upload/image/ann.png"></label>
	            </div>
	            <div class="col-sm-12 col-xs-12 col-md-11 col-lg-11 col-xl-11 ">	
					<label class="ann_label_home">
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
</section> 
<section style="background:#fff !important;">
	<div class="container-fluid" style="min-height: auto;">
  <div class="row">
  <!--<div style="color: #ffffff;background-color:rgb(228, 121, 26); bfont-size:15px;padding:1px;margin:3px;"></div>-->
  
  <div class=" col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 " style="margin-left: 5%">
    
    
    <div class="row-sm-12 row-xs-12 row-md-12 row-lg-12 row-xl-12" style="margin-top: 77px;" >
       <div class="row-sm-2 row-xs-2 row-md-2 row-lg-2 row-xl-2" style="padding-left: 0;cursor: pointer;" >
        <div  class="row-sm-12 row-xs-12 row-md-12 row-lg-12 row-xl-12 box-green">
	        <div  class="row-sm-2 row-xs-12 row-md-2 row-lg-2 row-xl-2">
					<center><img class= "img1" src="<?php echo base_url()?>public/assets/images/icon/Application.png " ></center>
			</div>
			<div  class="row-sm-10 row-xs-12 row-md-10 row-lg-10 row-xl-10">
					<p align="center" style="color: white;">आवेदन केलिए अनुदेश  <br />Instructions For Filling <br />Application</p>
			</div>
         </div>
       </div>
		<!--
       <div class="row-sm-2 row-xs-6 " style="padding-left: 0;cursor: pointer" data-toggle="modal" >
            <div  class="row-sm-12 row-xs-12 box-green">
	       		 <div  class="row-sm-2 row-xs-12">
							<center><img class= "img1" src="<?php echo base_url()?>public/assets/images/icon/General Technical Issues.png " ></center>
					</div>
					<div  class="row-sm-10 row-xs-12">
							<p align="center" style="color: white;" >सामान्य तकनीक के मुद्दे <br />General Technique Issues</p>
					</div>
                   
         	</div>
       </div>
       
       <div class="row-sm-2 row-xs-6" style="padding-left: 0; padding-right: 0;cursor: pointer" data-toggle="modal"  >
            <div  class="row-sm-12 row-xs-12 box-green">
				<div  class="row-sm-2 row-xs-12">
							<center><img class= "img1" src="<?php echo base_url()?>public/assets/images/icon/Frequently Asked.png " ></center>
				</div>
				<div  class="row-sm-10 row-xs-12">
							<p align="center" style="color: white;"  onclick="faq_page();" >अक्सर पूछे जाने वाले प्रश्न <br /> Frequently Asked Question(FAQ)</p>
				</div>
            
         	</div>
       </div>-->
    </div>
</div>
  <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9 " style="padding-top: 7px;padding-right: 0px;padding-left: 25px;padding-bottom: 25px;">
	
	<div style=" color:#000; padding-top:10px; padding-bottom: " >
						
		<table style="width:100%"><tbody><tr><td align="left" style="font-size:16px;font-weight: 600; text-align: center;"><?= ucwords(strtolower($ins_name)) ?> invites applications for the following Posts:</td></tr></tbody></table>
 
	</div>
	<div class="outer-box" style="height: 450px;width: 98%; overflow-y: auto;overflow-x: hidden; ">
	 	<?php foreach($postname as $row){ 
		 	$program_group_code = $row['program_group_code'];
		 	$application_last_date = $row['application_last_date'];
		 	$program_data = $row['program_data'];
			$arr_program_data = explode(",",$program_data);
			//$arr_date = explode("_",$program_code);
			//$code = $arr_date[0];
			?>
			
		
		
	
		<div class="col-sm-10" style="width: 100.333%;top: 10px;">
	     <table class="table table-bordered table-responsive" style="color: #000; box-shadow: 1px 1px 3px black;">
	         <thead style="background: #115696;color: white;">
	           
	           <th>पद नाम / Post Name</th>
	           <th>विवरण / Details</th>
	           <th>अंतिम तिथी / Last Date</th>
	           <th>आवेदन लिंक / Apply Link</th>
	         </thead>

	         <tbody style="background: white;">
	         	
	         <?php 
			
				foreach($arr_program_data as $row)
				{
					$arr_data = explode("`",$row);
					$program_name = $arr_data[0];
					$program_code = $arr_data[1];
					$year = $arr_data[2];
					$arr_code = explode("_",$program_code);
					$code = $arr_code[0];
		?>	
	        
			 	<tr>
			 	
	           <td><?=$program_name?></td>
	           
	           
	           <td >
	           		<button type="button" onclick="vacancy_details(`<?=$program_code?>`);"  title="Details" data-placement="top" data-toggle="tooltip" style="width: 60%" class="button-orange" >Details</button>
	           		<!--<button type="button" onclick="login(`<?=$program_code?>`);"  title="Apply Link" data-placement="top" data-toggle="modal" class=" button-green" >Apply</button>		
	           --></td>
	           <td><?=$application_last_date?></td>
	           <td><button type="button" id="login"  class="button-orange" style="width: 45%" data-placement="top" data-toggle="tooltip">Apply Online</button></td>
	           </tr>
			
	           <?php } ?>
	         </tbody>
	     </table>
	  </div>
		 
	  
	<?php } ?>
	
	</div>
     
</div>





<!--   <div class="col-sm-12" align="right" style="margin-top: -60px;">
           <img src="upload/image/1.png">
           <img src="upload/image/2.png">
           <img src="upload/image/3.png">
           <img src="upload/image/4.png">
           <img src="upload/image/5.png">

        </div>
 -->

 </div>


</div>

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


<div class="modal fade" id="modal_vacancy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width: 65%;">
    	<div class="modal-content" style="background-size: cover !important; background:url(<?php echo base_url(); ?>public/photos/rink_background.jpg)">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: black;padding-left: 90%;"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel"style="color:#E4791A;"><b>Post Details</b></h4>
				
			</div>
      		<div class="modal-body" style="min-height: 790px;">
	      		<div class="col-sm-12">
	      			<div id="container1" style="overflow-y: auto;height: 750px;" >
						<div class="shell" style=" background-color:#FFFFFF">
							<div class="small-nav" style=" background-color:#FFFFFF; padding-bottom:0px;">
								<div id="main"  >
									<!--<div class="box-head">
										<p style="color:#FFFFFF; font-size:14px; "><strong>Vacancy Details</strong></p>
									</div>-->
								<!-- End Box Head -->	
									<div id="vacancy_post" >
									
									</div>
								</div>
								<div class="box-head">
									<p align="center" style="color:#FFFFFF; font-size:14px; "><strong>Number of Posts and Reservation</strong></p>
								</div>				
							      <table class='table table-bordered table-responsive' style='text-align: center;' id="trseatmatrix">
							       	    
								 </table>
								 
								<div class="box-head">
									<p style="color:#FFFFFF; font-size:14px; "><strong>Post Description</strong></p>
								</div>
								<div align="center" id="vacancy_post1" >
								</div>	
							</div>
						</div>	
					</div>
				</div>
	      	</div>
	    </div>
    </div>
</div> 
<div class="modal fade" id="modal_vacancy_pdf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width: 100%;min-width: 58%">
    	<div class="modal-content" style="background-size: cover !important; background:url(<?php echo base_url(); ?>public/photos/rink_background.jpg)">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: black;padding-left: 90%;"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title" id="myModalLabel"style="color:#E4791A;"><b>Post Details</b></h4>
				
				</div>
      		<div class="modal-body" style="min-height: 790px;">
	      		<div class="col-sm-12">
	      			<div id="container2" style="overflow-y: hidden;height: 750px;" >
						
					</div>

				</div>

<!-- End Container -->


	      	</div>
	    </div>
    </div>
</div> 

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

<div class="modal fade" id="FAQ_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width: 100%;min-width: 58%">
    	<div class="modal-content" style="background-size: cover !important; background:url(<?php echo base_url(); ?>public/photos/rink_background.jpg)">
				<div class="modal-header">
					<h3 style="text-align: center;">Frequently Asked Questions(FAQ)</h3>
					<button type="button" class="close"  style="padding-left: 95%;  margin-top: -50px;" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
				</div>
      		<div class="modal-body" style="min-height: 790px; margin-top: 18px;">
	      		<div class="col-sm-12">
	      			<div id="container" style="overflow-y: auto;height: 750px;" >
	      			<?php 
	      			
	      				foreach($faq_data as $row){
	      					$question = $row['question'];
	      					$answer = $row['answer'];
	      				
					?>	
						<table>
							<tr>
								<td>
									<p>Que: <?=$question?></p>
					      			<p style="font-weight: inherit;">Ans: <?=$answer?></p>
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

<script>
	function posts(){
		 window.open('http://appsconline.in/ui/adv_upload/Advt-AsstPro-2018.pdf','_blank');	
	}
	function register(){
		 window.open('<?=base_url()?>index/institute_register/ins/<?php echo $institute_code; ?>','_self');		 	
	}
	
	
	function vacancy_details(program_code){
		$.ajax({
			url:base_url+"/Ajax_controller/get_vacancy_details",
			type:"post",
			data: {program_code:program_code},
			success:function(response){ 
				var res1 = JSON.parse(response);
				$("#container").html('');
				if(res1.res5 !=''){
					console.log("hello");
					
					$("#container2").html(res1.res5);
					$('#modal_vacancy_pdf').modal('show');
				}
				else
				{
					console.log(res1.res2);
					$("#vacancy_post").html(res1.res2);
					$("#trseatmatrix").html(res1.res4);
					$("#vacancy_post1").html(res1.res3);
					$('#modal_vacancy').modal('show');
				}
				
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
		
	}
	function exit1(){
		
		$('#modal_vacancy').modal('hide');
	}
	
	function faq_page(){
		$('#FAQ_modal').modal('show');
	}
</script>
<script>
	function enable_logout(logoutopt){
		if(logoutopt=='YES'){
			confirmReturn = confirm("You have already sign-in with another system");
			if(confirmReturn){
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
	}
	$("body").on('click','.toggle-password',function(){
	    $(this).toggleClass("fa-eye fa-eye-slash");

	    var input_type = document.getElementById('txtPassword1');
		//alert(input);
	    if (input_type.type === "password") {
	        input_type.type="text";
	    } else {
	        input_type.type="password";
	    }
	});
	$("body").on('click','.toggle-password_login',function(){
	    $(this).toggleClass("fa-eye fa-eye-slash");

	    var input_type = document.getElementById('txtPwd');
		//alert(input);
	    if (input_type.type === "password") {
	        input_type.type="text";
	    } else {
	        input_type.type="password";
	    }
	});

	$(document).ajaxSend(function(){
	    $('.loadingRPimage').fadeIn(250);
	});
	$(document).ajaxComplete(function(){
	    $('.loadingRPimage').fadeOut(250);
	});
	function isNumberKey(evt)
	{
	  var charCode = (evt.which) ? evt.which : evt.keyCode;
	  if (charCode != 46 && charCode > 31 
	    && (charCode < 48 || charCode > 57))
	     return false;

	  return true;
	}
	$("#newPassword").hide();
	
	$("#txtEmailId").change(function(){
		if($("#txtEmailId").val() != '')
		{
			if($("#txtCandidatePhone").val() == '')
			{
				var institutedata =
				{
					mail_id:$('#txtEmailId').val()
				};
				$.ajax({
					url:base_url+"ajax_controller/get_mobile_no",
					type:"post",
					data:institutedata,
					success:function(response){ 
						var result = JSON.parse(response);
						$("#hidMobileNo").val(result.mobile);
						//alert($("#hidMobileNo").val());
				  	},
				  	error:function(){
				   		toastr.error("We are unable to Process.Please contact Support");
				  	}
				});
			}
		}
	});
	$('#btnlogin').click(function(){ 
		
		if($("#txtCandidatePhone").val() == '' && $("#txtEmailId").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone', 'NOT_VALIDATED', null).validateField('txtCandidatePhone');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPwd', 'NOT_VALIDATED', null).validateField('txtPwd');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha');
			//toastr.error("Please enter username and password");
			$("#txtCandidatePhone").focus();
			return false;
		}
		if($("#txtPwd").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone', 'NOT_VALIDATED', null).validateField('txtCandidatePhone');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPwd', 'NOT_VALIDATED', null).validateField('txtPwd');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha');
			//toastr.error("Please enter username and password");
			$("#txtPwd").focus();
			return false;
		}
		if($("#txtCaptcha").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone', 'NOT_VALIDATED', null).validateField('txtCandidatePhone');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPwd', 'NOT_VALIDATED', null).validateField('txtPwd');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha');
			//toastr.error("Please enter username and password");
			$("#txtCaptcha").focus();
			return false;
		} 
		md5KeyValue = "<?php echo $this->session->userdata('key');?>";
		
		var reg_user_id = document.getElementById("txtCandidatePhone").value;
		
		if(reg_user_id == '' || reg_user_id == null)
		{   
			var reg_user_id = $("#hidMobileNo").val();
			
		}  
		var confirmpassword = document.getElementById("txtPwd").value; 

		var encSaltSHAPassConfirm = encryptSha2LoginPassword(md5KeyValue,reg_user_id,confirmpassword);
		
		document.getElementById("txtPwd").value = encSaltSHAPassConfirm; //changed
		/*alert(reg_user_id);
		alert(confirmpassword);
		alert(encSaltSHAPassConfirm);*/
		//alert(encSaltSHAPassConfirm);
		
		return true;
	});

	/*$('#txtEmail').change(function(){
		var institutedata =
		{
			txtEmail:$('#txtEmail').val(),
			insCode:$('#insCode').val()
		};		
		$.ajax({
			url:base_url+"ajax_controller/check_email",
			type:"post",
			data:institutedata,
			success:function(response){  
				
				var res1 = JSON.parse(response);
				if(res1.present != 0)
				{
					toastr.error("Email Already Exists");
					$('#txtEmail').val('');
					$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
					$("#txtEmail").focus();
				}
				
				
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	});*/

	$('#registration').click(function(){
		refresh_captcha3();
		$('#frmApplyNew').bootstrapValidator('resetForm', true);
		$('#loginModal').modal('hide');
		$('#AdminloginModal').modal('hide');
		$('#forgotPasswordModal').modal('hide');
		$('#registrationModal').modal('show');
		$('#registrationModal').on('shown.bs.modal', function () 
		{ 
			$('#txtFirstName').focus(); // Focusing the textbox
		})
	});
	$('#login').click(function(){
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
	});
	$('#registerAlreadyUser').click(function(){
		refresh_captcha4();
		$('#frm_login').data('bootstrapValidator').resetForm(true);
		$('#loginModal').modal('show');
		$('#AdminloginModal').modal('hide');
		$('#forgotPasswordModal').modal('hide');
		$('#registrationModal').modal('hide');
		$('#loginModal').on('shown.bs.modal', function () 
		{ 
			$('#txtCandidatePhone').focus(); // Focusing the textbox
		})
	});
	
	$('#loginNewUser').click(function(){ 
		refresh_captcha3();
		$('#frmApplyNew').bootstrapValidator('resetForm', true);
		$('#loginModal').modal('hide');
		$('#AdminloginModal').modal('hide');
		$('#forgotPasswordModal').modal('hide');
		$('#registrationModal').modal('show');
		$('#registrationModal').on('shown.bs.modal', function () 
		{ 
			$('#txtFirstName').focus(); // Focusing the textbox
		})
		
	});

	$('#forgotNewUser').click(function(){ 
		refresh_captcha3();
		$('#frmApplyNew').bootstrapValidator('resetForm', true);
		$('#loginModal').modal('hide');
		$('#AdminloginModal').modal('hide');
		$('#forgotPasswordModal').modal('hide');
		$('#registrationModal').modal('show');
		$('#registrationModal').on('shown.bs.modal', function () 
		{ 
			$('#txtFirstName').focus(); // Focusing the textbox
		})
		
	});
	/*$("#txtCandidatePhone1").change(function(){
		var institutedata = { 
			mobile_no : $("#txtCandidatePhone1").val()
		};
		$.ajax({
			url:base_url+"ajax_controller/check_mobile_no",
			type:"post",
			data:institutedata,
			success:function(response)
			{  
				var obj = jQuery.parseJSON(response);
				if(obj.status != true)
				{
					$("#txtCandidatePhone1").val('');
					$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
					
					$("#txtCandidatePhone1").focus();
					toastr.error(obj.msg);
				}
				
			},
			error:function()
			{
				toastr.error('Unable to Save.Please Try Again ');	
			}
		});
	});
	$("#txtEmail").change(function(){
		var institutedata = {
			email_id : $("#txtEmail").val()
		};
		$.ajax({
			url:base_url+"ajax_controller/check_email_id",
			type:"post",
			data:institutedata,
			success:function(response)
			{  
				var obj = jQuery.parseJSON(response);
				if(obj.status != true)
				{
					$("#txtEmail").val('');
					$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
					$("#txtEmail").focus();
					toastr.error(obj.msg);
				}
				
			},
			error:function()
			{
				toastr.error('Unable to Save.Please Try Again ');	
			}
		});
	});*/
	$('#btnChangePassword').click(function(){ 
		if($("#txtOTP").val() == '')
		{
			$('#frmForgotPassword').data('bootstrapValidator').updateStatus('txtOTP', 'NOT_VALIDATED', null).validateField('txtOTP');
			$('#frmForgotPassword').focus(); // Focusing the textbox
		}
		else
		{
			var institutedata =
			{
				txtOTP:$('#txtOTP').val()
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
						$('#AdminloginModal').modal('hide');
						$('#forgotPasswordModal').modal('hide');
						$('#registrationModal').modal('hide');
						$('#newPasswordModal').modal('show');
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
		$('#forgotPasswordModal').on('shown.bs.modal', function () 
		{ 
			$('#txtForgotCandidatePhone').focus(); // Focusing the textbox
		})
		
	});

	$('#btnChangePwd').click(function(){ 
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
		
	});
	/*var cmbState = "<?=$cmbState?>";
	$.ajax({
		url:base_url+"ajax_controller/select_state_details",
		type:"post",
		//data:institutedata,
		success:function(response){  
			var options = "<option value =''>Select State</option>";
			var res1 = JSON.parse(response);
			
			//alert(res1[0].state_code);
			for( i = 0;i< res1.length ;i++){
				if(res1[i].state_code == cmbState){
							selected='selected';
						}else{
							selected='';
						}
				options = options + "<option value="+res1[i].state_code+" "+selected+">"+res1[i].state_name+"</option>";
			}
			$('#cmbState').html("");   //campusid from academicPeriod
			$('#cmbState').append(options);
			
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});*/
	// Login Captcha
	$.ajax({
	  url:base_url+"ajax_controller/create_captcha",
	  type:"post",
	  success:function(response){ 
	   var value = 'hello';
	   refresh = base_url + 'public/assets/images/refresh.png';
	   var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha4" onclick="refresh_captcha4()"  id="refreshCaptcha4" ><img src="'+refresh+'"/></a>';
	   $("#captImg4").html(res); 
	   //$("#captImg1").html(res); 
	  },
	  error:function(){
	   toastr.error("We are unable to Process.Please contact Support");
	  }
	});
	function refresh_captcha4()
	{
	   $.get(base_url+'ajax_controller/refresh_captcha', function(data){
	   refresh = base_url + 'public/assets/images/refresh.png';
	   var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha4" onclick="refresh_captcha4()"  id="refreshCaptcha4" ><img src="'+refresh+'"/></a>';
	   	$("#captImg4").html(data);
	   });
	   	$("#txtCaptcha").val('');
	   $('#frm_login').bootstrapValidator('updateStatus', 'txtCaptcha', 'NOT_VALIDATED').bootstrapValidator('validateField', 'txtCaptcha');
	   }
	// Registration Captcha
	$.ajax({
	  url:base_url+"ajax_controller/create_captcha",
	  type:"post",
	  success:function(response){ 
	   var value = 'hello';
	   refresh = base_url + 'public/assets/images/refresh.png';
	   var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha3" onclick="refresh_captcha3()"  id="refreshCaptcha3" ><img src="'+refresh+'"/></a>';
	   $("#captImg3").html(res); 
	   //$("#captImg1").html(res); 
	  },
	  error:function(){
	   toastr.error("We are unable to Process.Please contact Support");
	  }
	});
	function refresh_captcha3()
	{
	   $.get(base_url+'ajax_controller/refresh_captcha', function(data){
	   refresh = base_url + 'public/assets/images/refresh.png';
	   var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha3" onclick="refresh_captcha3()"  id="refreshCaptcha3" ><img src="'+refresh+'"/></a>';
	   	$("#captImg3").html(data);
	   });
	   $("#txtCaptcha1").val('');
	   $('#frmApplyNew').bootstrapValidator('updateStatus', 'txtCaptcha1', 'NOT_VALIDATED').bootstrapValidator('validateField', 'txtCaptcha1');
	   //$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
	}

	// Forgot Password Captcha
	$.ajax({
	  url:base_url+"ajax_controller/create_captcha",
	  type:"post",
	  success:function(response){ 
	   var value = 'hello';
	   refresh = base_url + 'public/assets/images/refresh.png';
	   var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha5" onclick="refresh_captcha5()"  id="refreshCaptcha5" ><img src="'+refresh+'"/></a>';
	   $("#captImg5").html(res); 
	   //$("#captImg1").html(res); 
	  },
	  error:function(){
	   toastr.error("We are unable to Process.Please contact Support");
	  }
	});
	function refresh_captcha5()
	{
	   $.get(base_url+'ajax_controller/refresh_captcha', function(data){
	   refresh = base_url + 'public/assets/images/refresh.png';
	   var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha5" onclick="refresh_captcha5()"  id="refreshCaptcha5" ><img src="'+refresh+'"/></a>';
	   	$("#captImg5").html(data);
	   });
	   $("#txtCaptcha5").val('');
	   $('#frmForgotPassword').data('bootstrapValidator').updateStatus('txtCaptcha5', 'NOT_VALIDATED', null).validateField('txtCaptcha5');
	}
	
	// New Password Captcha
	$.ajax({
	  url:base_url+"ajax_controller/create_captcha",
	  type:"post",
	  success:function(response){ 
	   var value = 'hello';
	   refresh = base_url + 'public/assets/images/refresh.png';
	   var res = response + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha6" onclick="refresh_captcha6()"  id="refreshCaptcha6" ><img src="'+refresh+'"/></a>';
	   $("#captImg6").html(res); 
	   //$("#captImg1").html(res); 
	  },
	  error:function(){
	   toastr.error("We are unable to Process.Please contact Support");
	  }
	});
	function refresh_captcha6()
	{
	   $.get(base_url+'ajax_controller/refresh_captcha', function(data){
	   refresh = base_url + 'public/assets/images/refresh.png';
	   var data = data + '&nbsp;<a href="javascript:void(0);" class="refreshCaptcha6" onclick="refresh_captcha6()"  id="refreshCaptcha6" ><img src="'+refresh+'"/></a>';
	   	$("#captImg6").html(data);
	   });
	   $("#txtCaptcha6").val('');
	   $('#frmNewPassword').data('bootstrapValidator').updateStatus('txtCaptcha6', 'NOT_VALIDATED', null).validateField('txtCaptcha6');
	}
	
	$('input[type="checkbox"]').on('change', function(e){
   		if(e.target.checked){
    		$('#chkbox').modal();
   		}
	});
	function validate_forgot_password(){
		
		if((document.getElementById('txtForgotCandidatePhone').value == '' || document.getElementById('txtForgotCandidatePhone').value == null) && (document.getElementById('txtForgotEmail').value == '' || document.getElementById('txtForgotEmail').value == null))
		{
			toastr.error("Mobile No Or Email Id One of Them is Required");
			return false;
		}
		return true;
	}
	function validate(){
		var errorMessage = "";
		var message='<div>';
		if($("#txtFirstName").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtFirstName").focus();
			return false;
		}
		if($("#txtLastName").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtLastName").focus();
			return false;
		}
		if($("#txtdob1").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtdob1").focus();
			return false;
		}
		
		if($("#txtCandidatePhone1").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtCandidatePhone1").focus();
			return false;
		}
		
		if($("#txtEmail").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtEmail").focus();
			return false;
		}
		
		if($("#txtPassword1").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtPassword1").focus();
			return false;
		}
		if($("#txtConfirmPassword").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtConfirmPassword").focus();
			return false;
		}
		if($("#txtCaptcha1").val() == '')
		{
			$('#frmApply').data('bootstrapValidator').updateStatus('txtFirstName', 'NOT_VALIDATED', null).validateField('txtFirstName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtLastName', 'NOT_VALIDATED', null).validateField('txtLastName');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			$('#frmApply').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
			//toastr.error("Please enter username and password");
			$("#txtCaptcha1").focus();
			return false;
		}
		if($("#txtPassword1").val() != $("#txtConfirmPassword").val())
		{
			/*$("#txtPassword1").val('');*/
			$("#txtConfirmPassword").val('');
			$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
			$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
			
		}
		else
		{
			var reg_user_id = document.getElementById("txtCandidatePhone1").value; 
			var txtNewPassword1 = document.getElementById("txtPassword1").value; 
			var encSaltSHAPassMobile = encryptShaPassCode(reg_user_id,txtNewPassword1);
			$('#txtPassword1').val(encSaltSHAPassMobile);
			$('#txtConfirmPassword').val(encSaltSHAPassMobile);
		}
		
		return true;
			
	}
	$('#resendOTP').click(function(){ 
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
		
	});
	function login(program_code){
		$("#hidProgramCode").val(program_code);
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
	$(document).ready(function() {
		$("#txtFirstName").focus();
		function blink_text() {
		    $('.blink').fadeOut(500);
		    $('.blink').fadeIn(500);
		}
		setInterval(blink_text, 4500);

		$('[data-toggle="tooltip"]').tooltip(); //for tooltip
		// for disable write click and copy past  code start
			
		$(document).bind("contextmenu",function(e){
		   return false;
		});
		$('body').bind('cut copy paste', function (e) {
	        e.preventDefault();
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
								text: "Please check your Mail id or Mobile for OTP. To change your password OTP is mandatory",
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
		$('#frmNewPassword').bootstrapValidator({
	        message: 'This value is not valid',
			submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{
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
							   refresh_captcha4();
							   $('#loginModal').modal('show')
							  }
							});
							
						}
						else 
						{
							if(result.status == 'captchaerror')
							{
								toastr.error(result.msg);	
								$("#txtPassword2").val('');
								$("#txtConfirmPassword2").val('');
								$("#txtCaptcha6").val('');
								$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtPassword2', 'NOT_VALIDATED', null).validateField('txtPassword2');
								$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtConfirmPassword2', 'NOT_VALIDATED', null).validateField('txtConfirmPassword2');
								$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtCaptcha6', 'NOT_VALIDATED', null).validateField('txtCaptcha6');
								refresh_captcha6();
								$('.loadingRPimage').fadeIn(250);
							}
							else
							{
								toastr.error(result.msg);	
								$("#txtPassword2").val('');
								$("#txtConfirmPassword2").val('');
								$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtPassword2', 'NOT_VALIDATED', null).validateField('txtPassword2');
								$('#frmNewPassword').data('bootstrapValidator').updateStatus('txtConfirmPassword2', 'NOT_VALIDATED', null).validateField('txtConfirmPassword2');
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
		$('#frm_login').bootstrapValidator({
	        message: 'This value is not valid',
	       /* feedbackIcons: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },*/
			submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{
				
				if((document.getElementById('txtCandidatePhone').value == '' || document.getElementById('txtCandidatePhone').value == null) && (document.getElementById('txtEmailId').value == '' || document.getElementById('txtEmailId').value == null))
				{
					toastr.error("Mobile No Or Email Id One of Them is Required");
				}
				else
				{	
					document.getElementById('txtPwd').type="password";
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
							if(result.status == "SUCCESS")
							{ 
								var program_code = $("#hidProgramCode").val();
								if(program_code == '')
								{ //alert(result.enc_ins);
									window.open(base_url+"apply/institute_page/ins/"+result.enc_ins,"_self");
								} 
								else
								{ 
									window.open(base_url+"apply/institute_page/ins/"+result.enc_ins+"/program_code/"+program_code,"_self");
								}
							}
							else 
							{
								if(result.msg == 'Invalid Captcha. Please try again.')
								{
									toastr.error(result.msg);	
									$("#txtPwd").val('');
									$("#txtCaptcha").val('');
									$('#frm_login').data('bootstrapValidator').updateStatus('txtPwd', 'NOT_VALIDATED', null).validateField('txtPwd');
									$('#frm_login').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha');
									refresh_captcha4();
									$('.loadingRPimage').fadeIn(250);
								}
								else
								{
									toastr.error(result.msg);	
									$("#txtPwd").val('');
									$("#txtCaptcha").val('');
									$('#frm_login').data('bootstrapValidator').updateStatus('txtPwd', 'NOT_VALIDATED', null).validateField('txtPwd');
									$('#frm_login').data('bootstrapValidator').updateStatus('txtCaptcha', 'NOT_VALIDATED', null).validateField('txtCaptcha');
									refresh_captcha4();
									enable_logout(result.logoutopt);
									//$('.loadingRPimage').fadeIn(250);
								}
								
							}
							
						},
						error:function()
						{
							toastr.error('Unable to Save.Please Try Again ');	
						}
					});
				}	
			},
	        fields: {
					txtCandidatePhone: {
	                validators: {
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
				txtEmailId: {
	                validators: {
	                   
						emailAddress: {
	                        message: 'The value is not a valid email address'
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
      	$('#resendOtpReg').click(function(){ 
			var institutedata =
			{
				txtMobileNo:$('#txtMobileNo').val(),
				txtEmail:$('#txtEmail').val(),
				hidInstitute:$('#hidInstitute').val(),
				txtFirstName:$('#txtFirstName').val(),
				txtMiddleName:$('#txtMiddleName').val(),
				txtLastName:$('#txtLastName').val()
			};
			$.ajax({
				url:base_url+"ajax_controller/send_pro_otp",
				type:"post",
				data:institutedata,
				success:function(response)
				{  
					var obj = jQuery.parseJSON(response);
						
					if(obj.status == true)
					{
						var otp = obj.otp;
						$("#hidOTP").val(otp);
			 			$('#OTPForm').data('bootstrapValidator').resetForm(true);
					}
					else
					{
						
						if(obj.status == 'captchaerror')
						{
							$("#txtPassword1").val('');
							$("#txtConfirmPassword").val('');
							$("#txtCaptcha1").val('');
							$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
							$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
							$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
							toastr.error(obj.msg);
						}
						else
						{
							toastr.error(obj.msg);
						}
					}
				},
				error:function()
				{
					toastr.error('Unable to Save.Please Try Again ');	
				}
			});
			
		});
	
      	$('#OTPForm').bootstrapValidator({
	        message: 'This value is not valid',
	        submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{
				var formData = $('#frmApplyNew, #OTPForm').serialize();
				//ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/check_otp_data",
					type:"post",
					data:formData,
					success:function(response)
					{  
						var obj = jQuery.parseJSON(response);
						if(obj.status == true)
						{
							//alert("hello");
							
							var formData = new FormData(document.getElementById("frmApplyNew"));
							//alert(formData);return;
							$("#modalOtp").modal('hide');
							$.ajax({
								url:base_url+"Index/registration",
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
											title: "Registration",
											text: "Congratulation!!! Your registration successfully completed. Please check your mail or sms for details.",
											//type: "success"
										},
										function(isConfirm) { 
										  if (isConfirm) {
										   $('#registrationModal').modal('hide');
										   $('#frm_login').bootstrapValidator('resetForm', true);
										   refresh_captcha4();
										   //setTimeout(function() { $('#registrationModal').modal('hide'); }, 2000);
										   $('#loginModal').modal('show')
										   //setTimeout(function() { $('#loginModal').modal('show')}, 2000);
										  }
										});
										
									}
									else 
									{
										if(result.status == 'captchaerror')
										{
											toastr.error(result.msg);	
											$("#txtCaptcha1").val('');
											$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
											refresh_captcha3();
											$('.loadingRPimage').fadeIn(250);
										}
										else if(result.status == 'ERROR')
										{
											toastr.error(result.msg);	
											$("#txtPassword1").val('');
											$("#txtConfirmPassword").val('');
											$("#txtCandidatePhone1").val('');
											$("#txtCaptcha1").val('');
											refresh_captcha3();
											$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
											$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
											$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
											$('.loadingRPimage').fadeIn(250);
											
										}
										else
										{
											toastr.error(result.msg);	
											$("#txtPassword1").val('');
											$("#txtConfirmPassword").val('');
											$("#txtEmail").val('');
											$("#txtCaptcha1").val('');
											refresh_captcha3();
											$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
											$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
											$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
											$('.loadingRPimage').fadeIn(250);
										}
									}
									
								},
								error:function()
								{
									toastr.error('Unable to Save.Please Try Again ');	
								}
							});
						}
						else
						{
							toastr.error(obj.msg);
						}
						
					},
					error:function()
					{
						toastr.error('Unable to Save.Please Try Again ');	
					}
				});
			},
			fields: { 
				txtOTP: {
	                validators: {
	                	notEmpty: {
	                        message: 'Please Enter First Name'
	                    }, 
						stringLength: {
							min: 4,
							max: 4,
							message: 'OTP Should be 4 character'
						}
	                }
	            }
	        }
	    });
	
		$('#frmApplyNew').bootstrapValidator({
	        message: 'This value is not valid',
	        /*feedbackIcons: {
	            valid: 'glyphicon glyphicon-ok',
	            invalid: 'glyphicon glyphicon-remove',
	            validating: 'glyphicon glyphicon-refresh'
	        },*/
			submitButtons: 'button[type="submit"]',
			submitHandler: function(validator, form, submitButton) 
			{
				document.getElementById('txtPassword1').type="password";
				var formData = new FormData(document.getElementById("frmApplyNew"));
				//alert(formData);
				$.ajax({
					url:base_url+"ajax_controller/send_pro_otp",
					type:"post", 
					data:formData,
					cache: false,
			        contentType: false,
			        processData: false,
					success:function(response)
					{  
						var obj = jQuery.parseJSON(response);
						
						if(obj.status == true)
						{
							var otp = obj.otp;
							$("#hidOTP").val(otp);
				 			$('#OTPForm').data('bootstrapValidator').resetForm(true);
							$("#modalOtp").modal('show');
						}
						else
						{
							
							if(obj.status == 'captchaerror')
							{
								$("#txtPassword1").val('');
								$("#txtConfirmPassword").val('');
								$("#txtCaptcha1").val('');
								$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtPassword1', 'NOT_VALIDATED', null).validateField('txtPassword1');
								$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');
								$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtCaptcha1', 'NOT_VALIDATED', null).validateField('txtCaptcha1');
								toastr.error(obj.msg);
							}
							else
							{
								toastr.error(obj.msg);
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
				txtFirstName: {
	                validators: {
	                	notEmpty: {
	                        message: "Please Enter First Name"
						},
						regexp: {
	                        regexp: /^([A-Za-z ]+)$/,
	                        message: "Special characters and Numbers are not allowed"
						}, 
						stringLength: {
							max: 50,
							min: 1,
							message: 'First name must be 1 to 50 characters'
						}
	                }
	            },
				txtMiddleName: {
	                validators: {
	                    regexp: {
	                        regexp: /^([A-Za-z ]+)$/,
	                        message: "Special characters and Numbers are not allowed"
						}, 
						stringLength: {
							max: 50,
							min: 0,
							message: 'Middle name must be 0 to 50 characters'
						}
	                }
	            },
				txtLastName: {
	                validators: {
	                	notEmpty: {
	                        message: "Please Enter Last Name"
						},
						regexp: {
	                        regexp: /^([A-Za-z ]+)$/,
	                        message: "Special characters and Numbers are not allowed"
						}, 
						stringLength: {
							max: 50, 
							min: 1,
							message: 'Last name must be 1 to 50 characters'
						}
	                }
	            },
				agree: {
	                validators: {
						notEmpty: {
	                        message: "Please check the term and condition"
						}
	                }
	            },
				txtdob1: {
	                validators: {
						notEmpty: {
	                        message: "Please Enter Date of Birth"
						}
	                }
	            },
	            
				txtCandidatePhone1: {
	                validators: {
	                	notEmpty: {
	                        message: "Please Enter Mobile No"
						},
						integer: {
								message: 'The value can contain only numbers'
							}, 
						stringLength: {
							max: 10,
							min: 10,
							message: 'Phone no must be 10 characters'
						}
					}
				},
	            txtEmail: {
	                validators: {
	                	notEmpty: {
	                        message: "Please Enter Email"
						},
						emailAddress: {
	                        message: 'The value is not a valid email address'
	                    }
	                }
	            },
	            
				txtPassword1: {
					validators: {
						notEmpty: {
							message: 'This field can\'t left blank'
						},
	            		regexp: {
							regexp: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[$@!%?&]).{6,12}$/,
							message: "The password should contain Minimum 6 and Maximum 12 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character:"
						}/*,
						identical: {
		                    field: 'txtConfirmPassword',
		                    message: 'New password and its confirm are not the same'
	                	}*/
					}
				},
				txtConfirmPassword: {
					validators: {
						notEmpty: {
							message: 'This field can\'t left blank'
						},
						identical: {
		                    field: 'txtPassword1',
		                    message: 'New password and its confirm are not the same'
	                	}
					}
				},
				txtCaptcha1: {
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
	            }	/*,
	            cmbState: {
	                validators: {
	                    notEmpty: {
	                        message: 'Please Enter State'
	                    }
					}
				}*/
			}
		});
		$("#txtPassword1").change(function(){
			$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtConfirmPassword', 'NOT_VALIDATED', null).validateField('txtConfirmPassword');	
		});
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!

		var yyyy = today.getFullYear();
		if(dd<10){
		    dd='0'+dd;
		} 
		if(mm<10){
		    mm='0'+mm;
		} 
		var today = dd+'-'+mm+'-'+yyyy;
		var min_Date = '';
		var max_Date = '';
		if($('#birthStartDate').val() == '' || $('#birthStartDate').val() == null)
		{
			min_Date = '01-01-1900';
		}
		else
		{
			min_Date = $('#birthStartDate').val();
		}
		
		if($('#birthEndDate').val() == '' || $('#birthEndDate').val() == null)
		{
			max_Date = today;
		}
		else
		{
			max_Date = $('#birthEndDate').val();
		}
		$('#txtdob1').datepicker({ 
			format: 'dd-mm-yyyy',
			startDate: min_Date,
			endDate: max_Date,
			autoclose:true,
			//yearRange: '1980:2003'
		}).on('changeDate', function(e) { 
			$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtdob1', 'NOT_VALIDATED', null).validateField('txtdob1');
			//$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtdob1', 'VALID', null);
		});
		$('#txtdob').datepicker({ 
			format: 'dd-mm-yyyy',
			startDate: min_Date,
			autoclose:true,
			endDate: max_Date,
			//yearRange: '1980:2003'
		}).on('changeDate', function(e) { 
			$('#frm_login').data('bootstrapValidator').updateStatus('txtdob', 'NOT_VALIDATED', null).validateField('txtdob');
			//$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtdob1', 'VALID', null);
		});
		$("#txtCandidatePhone1").change(function(){
		
			var institutedata = {
				mobile_no : $("#txtCandidatePhone1").val()
			};
			$.ajax({
				url:base_url+"ajax_controller/check_mobile_no",
				type:"post",
				data:institutedata,
				success:function(response)
				{  
					var obj = jQuery.parseJSON(response);
					if(obj.status != true) 
					{
						$("#txtCandidatePhone1").val('');
						$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtCandidatePhone1', 'NOT_VALIDATED', null).validateField('txtCandidatePhone1');
						$("#txtCandidatePhone1").focus();
						toastr.error(obj.msg);
					}
					
				},
				error:function()
				{
					toastr.error('Unable to Save.Please Try Again ');	
				}
			});
		});
		$("#txtEmail").change(function(){
			var institutedata = {
				email_id : $("#txtEmail").val()
			};
			$.ajax({
				url:base_url+"ajax_controller/check_email_id",
				type:"post",
				data:institutedata,
				success:function(response)
				{  
					var obj = jQuery.parseJSON(response);
					if(obj.status != true)
					{
						$("#txtEmail").val('');
						$('#frmApplyNew').data('bootstrapValidator').updateStatus('txtEmail', 'NOT_VALIDATED', null).validateField('txtEmail');
						$("#txtEmail").focus();
						toastr.error(obj.msg);
					}
					
				},
				error:function()
				{
					toastr.error('Unable to Save.Please Try Again ');	
				}
			});
		});
		//$('#txtdob1').datepick({yearRange: '1980:2003'}); 
    });
	
	
</script>