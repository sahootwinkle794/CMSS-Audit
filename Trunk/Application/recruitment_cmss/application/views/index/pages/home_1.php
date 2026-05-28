 <?php 
	//$inscode1 = $this->session->set_userdata('ins_code', $institute);
	$logo = '';
	$inscode = '';
	$ins = '';
	$insname = '';
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
?>
 <link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet" /> 
<section style="background: url(<?php echo base_url(); ?>upload/image/background_image.jpg);">
<div class="container-fluid">
  <div class="row">
  <div style="color: #ffffff;background-color:rgb(228, 121, 26); bfont-size:15px;padding:1px;margin:3px;"></div>
<div class="col-sm-7 co-xs-6">
    <div class="hidden-xs" style="padding-top: 120px;">
      <img src="<?php echo base_url(); ?>upload/image/<?php echo $img; ?>" style="width: 100%;">
    </div>
    <div  style="padding-top: 10px;">
      <p><span style="color: #ff8400;font-size: 20px"><b>* Applicants please register yourself by clicking on "REGISTRATION" before login. </b></span></p>
    </div>
    <div  style="padding-top: 10px;">
      <p><span class="blink" style="color: #ff8400;font-size: 20px"><b>* Applicants please Login by clicking "LOGIN" for downloading admit card. </b></span></p>
    </div>
    <div class="col-sm-12 col-xs-12" style=" background: #191E3C; padding: 5px; margin-top: 86px;" >
       <div class="col-sm-4 col-xs-4 block x1" style="padding-left: 0;cursor: pointer;" >
        <div onclick="broucherPdf();"  class="col-sm-12 col-xs-12" style="background: linear-gradient(#E2E596, #F8FAC8); padding: 20px;">
            <div class="col-sm-3 col-xs-3"  style="padding-left:0;">
               <img src="<?php echo base_url(); ?>upload/image/folder_icon.png">
            </div>
             <div class="col-sm-9 col-xs-9" style="padding-left:0;">
              <span style="color: #FF8400; font-size: 16px; font-weight: 600;">Instructions</span>
             </div>
         </div>
       </div>
		
       <div  onclick="datesPdf();"  class="col-sm-4 col-xs-4 block x1" style="padding-left: 0;cursor: pointer" data-toggle="modal" >
                 <div class="col-sm-12 col-xs-12" style="background: linear-gradient(#E2E596, #F8FAC8); padding: 20px;">
            <div class="col-sm-3 col-xs-3">
              <img src="<?php echo base_url(); ?>upload/image/folder_icon.png" style="padding-left:0;">
            </div>
             <div class="col-sm-9 col-xs-9">
  				<span style="color: #FF8400; font-size: 16px; font-weight: 600;" >Important Dates</span>
             </div>
         </div>
       </div>
       
       <div  onclick="courseDetailPdf();"  class="col-sm-4 col-xs-4 block x1" style="padding-left: 0; padding-right: 0;" data-toggle="modal"  >
            <div class="col-sm-12 col-xs-12" style="background: linear-gradient(#E2E596, #F8FAC8); padding: 20px;">
	            <div class="col-sm-3 col-xs-3">
	              <img src="<?php echo base_url(); ?>upload/image/folder_icon.png">
	            </div>
	             <div class="col-sm-9 col-xs-9">
	  				<span style="color: #FF8400; font-size: 16px; font-weight: 600;">Advertisement</span>
	             </div>
         	</div>
       </div>
    </div>
</div>

<div class="col-sm-5 col-xs-12" style="padding-top: 20px;">
      <!--<div class="row" style="background: url(upload/image/table.png); min-height:379px; width: 417px;">
        <div class="col-sm-12">
          <p style="font-size: 28px; color: #fff; padding-top: 100px; padding-left: 10px;"> Applicant Login </p>
              </div>
              <div class="col-sm-12" style="padding-top: 10px;">
           <p align="left" class="col-sm-6 col-xs-6" style="font-size: 20px; color: #000;" >New User</p> 

          <a href="?p=registration" style="color: #000;"> <p align="center" class="col-sm-5 col-xs-6" style="background: #fff; border-radius: 20px; font-size: 16px; padding: 5px;">Register Yourself</p></a>
            </div>

            <div class="col-sm-12">
            <p class="col-sm-6 col-xs-6" style="font-size: 20px; color: #000;" >Existing User</p> 

          <a href="?p=login" style="color: #000;"><p align="center" class="col-sm-5 col-xs-6 " style="background: #fff; border-radius: 20px; font-size: 16px; padding: 5px;"> Login</p></a>
            </div>

             <div class="col-sm-12" style="padding-top: 10px;">
            <p class="col-sm-6 col-xs-6" style="font-size: 18px; color: #000;" >FAQ</p> 
            <p align="center" class="col-sm-5 col-xs-6" style="font-size: 18px; color: #000;">User Manual</p>
            </div>

            <div class="col-sm-12 col-xs-12" style="padding-top: 20px;">
          
            </div>
   

        </div>-->
        
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
	    <!-- Indicators -->
	    <ol class="carousel-indicators">
	      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	      <li data-target="#myCarousel" data-slide-to="1"></li>
	      <li data-target="#myCarousel" data-slide-to="2"></li>
	    
	    </ol>
	    <!-- Wrapper for slides -->
	    <div class="carousel-inner" style="border-radius: 5px 85px; background: none repeat scroll 0% 0% rgb(243, 156, 0);">
	    
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
	        <img src="<?php echo  BASE_ADM_URL ?>/institute/<?=$row['image_url']; ?>" style="width:100%;">
	    </div>
	    <?php
	    }
	    ?>
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
<script>
	$(document).ready(function() {
		function blink_text() {
		    $('.blink').fadeOut(500);
		    $('.blink').fadeIn(500);
		}
		setInterval(blink_text, 4500);
	});
	function broucherPdf(){
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
	function courseDetailPdf(){
		var brochure = "<?= $inscode ?>_Courses_Offered.pdf?v=10";
		$.get('<?=BASE_URL?>downloads/latest_info/'+brochure)
	    .done(function() { 
	       window.open('<?=BASE_URL?>downloads/latest_info/'+brochure,'_blank');	
	    }).fail(function() { 
	    	window.open('<?=BASE_URL?>Index/document_not_found','_blank');	
	    })
	}
</script>