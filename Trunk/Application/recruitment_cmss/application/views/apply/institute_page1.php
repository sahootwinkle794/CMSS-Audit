<?php
	date_default_timezone_set('Asia/Kolkata');
    $now = date('Y-m-d h:i:s', now());
    $reg_user_id = $this->session->userdata('reg_user_id');
	foreach($institute_data as $ins_data)
	{
		$institute_code = $ins_data['institute_code'];
		$institute_name = $ins_data['institute_name'];
		$image_url = $ins_data['image_url'];
	}
	foreach($program_data as $row)
	{
		$apply_date1 = $row['date1'];
		$apply_date2 = $row['date2'];
	}
	//print_r($program_data);
	$active_tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:$program_group_data[0]['program_group_code'];
	$data = $this->uri->uri_to_assoc();
	$institute = $data['ins'];
	
	//print_r($this->session);
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/datatable/css/dataTables.bootstrap.min.css" />
<style>
	.table {
    border-collapse: collapse;
    width: 100%;
    text-align: center;
}

.table td, .table th {
    border: 1px solid #ddd;
    padding: 8px;
}

.table tr:nth-child(even){background-color: #f2f2f2;}

.table tr:hover {background-color: #ddd;}

.table th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #428bca;
    color: white;
}
a:hover, a:active, a:focus {
    color: #0D367E;
}
</style> 

<input type="hidden" name="hidPageCode" id="hidPageCode" value="INSTITUTE"/>
<section style="background: url(<?php echo base_url() ?>upload/image/svnirtar_bacakground.jpg);min-height: 400px">
	<div class="row">
		<div class="col-sm-12">
			<div class="col-sm-1" style="margin-top: 30px; padding-left: 0;">
				<?php include('sidebar/sidebar.php'); ?>
				
			</div>
			<div class="col-sm-11">
		<div class="row">
			<div class="col-sm-12">
				
	       		
	        	<!--<div class="col-sm-1" style="padding: 0; margin: 0;"></div>-->
	       		<div class="col-sm-9" style="margin-top: 20px;">
				       			<div class="panel panel-default" >
					        	   	<div class="panel-heading" style="background-color: #f59607;border-color: #f59607; color: #ffffff;text-align: center;padding: 2px 15px;">
						      			<h4 style="font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">PROGRAM DETAILS</h4>
						        	</div>
					        		<div class="panel-body">
			       	<div class="row">	
								       		<div class="col-md-12" style="margin-top: 10px;">
			       			<div class="panel-group" id="accordion">
			       				<?php
									$i = 1;
									$c = "";
									if(sizeof($program_data)!=0){
									
									foreach($program_data as $program)
									{ ?> 
										<div class="panel panel-default">
											<div class="panel-heading" style="<?php echo $program['appl_status']!=''?'background-color: #f59607;':'background-color: #f59607;'?>">
												<h4 class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$i?>" style="color: #fff;cursor: pointer;"><?php echo $program['program_name'] ?>
															
													<div class="pull-right">
										       		  <?php if($program['appl_status']=='Verified' && $program['B'] != 'B'  ){ ?>
										       		<button title="Print Application" style="padding:2px ; margin-top:-4px;" class="btn btn-success" type="button" onclick="printApplication('<?php echo $program['program_code'] ?>')" style="margin-right: 8px;"><i class="fa fa-print"></i>  Print</button>	
										       		<button title="Download Question Paper" style="padding:2px ; margin-top:-4px;" class="btn btn-success" type="button" onclick="downloadquestion('<?php echo $program['program_code'] ?>')" style="margin-right: 8px;"><i class="fa fa-download"></i></button>	
										       		<?php } ?> 

										       		<?php if($program['appl_status']=='Verified' || $program['appl_status']=='Fee Paid'){ ?>
														<span title="View" class="btn"  onclick="navigate('<?php echo $program['program_code'] ?>')" style="background-color: #5D3C0A; color: rgb(255, 255, 255); padding:2px ; margin-top:-4px;"><i class="fa fa-file"></i>  View</span>
													  <?php }
													 elseif($program['appl_status']!='Verified' && $program['appl_status']!=''){ ?>
														<span title="" class="btn"  onclick="navigate('<?php echo $program['program_code'] ?>')" style="background-color: #5D3C0A; color: rgb(255, 255, 255); padding:2px ; margin-top:-4px;"><i class="fa fa-edit"></i>  Not Completed</span>
													<?php } ?>
													
													<?php if($program['appl_status']==''){ ?>
														<span title="Apply Now" class="btn"  onclick="navigate('<?php echo $program['program_code'] ?>')" style="background-color: #5D3C0A; color: rgb(255, 255, 255); padding:2px ; margin-top:-4px;"><i class="fa fa-send"></i>  Apply Now</span>
													<?php } ?>
													<?php if($program['record_status']=='1'){?>
														<!--<span title="Admit card" class="btn"  onclick="printAdmitCard('<?php echo $program['program_code'] ?>')" style="background-color: rgb(67, 194, 211); color: rgb(255, 255, 255); padding:2px; margin-top:-4px;"><i class="fa fa-file-pdf-o"></i> Admit card</span>-->
														
													<?php } ?>
													<?php if($program['rank_status']=='1'){
															if($program['applicant_status']=='SL'){ ?>
																<span title="Call Letter" class="btn"  onclick="print_rank_detail('<?php echo $program['program_code'] ?>')" style="background-color: rgb(67, 194, 211); color: rgb(255, 255, 255); padding:2px; margin-top:-4px;"><i class="fa fa-file-pdf-o"></i> Call Letter</span>
															<?php } 
															else{ ?>
																<span title="Call Letter" class="btn"  onclick="alert('Please wait till 2nd list to be released on 24th July 2018.')" style="background-color: rgb(67, 194, 211); color: rgb(255, 255, 255); padding:2px; margin-top:-4px;"><i class="fa fa-file-pdf-o"></i> Check Status</span>
															<?php }	
																
													} ?>

													</div>
													
										<!-- <?php if($program['appl_status']=='Verified'){ ?>
														<span title="Apply Now" class="label pull-right"  onclick="navigate('<?php echo $program['program_code'] ?>')" style="background-color: rgb(228, 121, 26); color: rgb(255, 255, 255);"><i class="fa fa-file"></i>  View</span>
													  <?php }elseif($program['appl_status']!='Verified' && $program['appl_status']!=''){ ?>
														<span title="Apply Now" class="label pull-right"  onclick="navigate('<?php echo $program['program_code'] ?>')" style="background-color: rgb(228, 121, 26); color: rgb(255, 255, 255);"><i class="fa fa-edit"></i>  Not Completed</span>
													<?php }else{ ?>
														<span title="Apply Now" class="label pull-right"  onclick="navigate('<?php echo $program['program_code'] ?>')" style="background-color: rgb(228, 121, 26); color: rgb(255, 255, 255);"><i class="fa fa-send"></i>  Apply</span>
													<?php } ?> -->  
												</h4>
											</div>

										

									        <div id="collapse<?=$i?>" class="panel-collapse collapse">
									        	<div class="panel-body" style="height: auto;">
							       					
							       					<?php 
							       					if($program['program_name'] == 'Diploma in Plastics Technology (DPT)') { ?>	
							       					<p style="font-family: sans-serif; font-size:13px;">
													  <b>Course Code &colon;</b> DPT<br>
													  <b>Duration &colon;</b> 3 years<br>
													  <b></b>  No Age Bar<b></b><br>
													  <b>Entry Qualification &colon;</b>
													  X Std. with Maths, Science and English.<br><br>
													  <b>Course Offered at</b>  CIPET : Ahmedabad, Amristar, Aurangabad, Balasore, Bhopal, Bhubaneswar - II , Chennai, Guwahati, Hajipur, Haldia, Hyderabad, Imphal, Jaipur, Kochi, Lucknow, Madurai, Murthal, Mysore, Raipur, Vijayawada, Baddi, Agartala, Ranchi, Chandrapur, Dehradun, Gwalior, Valsad<br><br>	
													  <!--<b>&ast;</b> Minimum age limit will be calculated as on July 31, 2018.<br><br>-->
													  <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;Selection &amp; eligibility as per CIPET Admission Procedure.<br>
													  <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;For admission, Please apply through CIPET JEE.<br>
													  <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;Number of Seats - As per AICTE Intake. <br>
													</p>
							       					<?php } ?>
							       					
							       					<?php 
							       					if($program['program_name'] == 'Diploma in Plastics Mould Technology (DPMT)') { ?>	
							       					<p style="font-family:sans-serif; font-size:13px;">
													  <b>Course Code &colon;</b> DPMT<br>
													  <b>Duration &colon;</b> 3 years<br>
													  <b></b>  No Age Bar<b></b><br>
													  <b>Entry Qualification &colon;</b>
													  X Std. with Maths, Science and English.<br><br>
													  <b>Course Offered at</b>  CIPET : Ahmedabad, Amristar, Aurangabad, Balasore, Bhopal, Bhubaneswar - II , Chennai, Guwahati, Hajipur, Haldia, Hyderabad, Imphal, Jaipur, Lucknow, Madurai, Murthal, Mysore, Raipur, Vijayawada, Baddi, Agartala, Ranchi, Chandrapur, Dehradun, Gwalior, Valsad<br><br>	
													  <!--<b>&ast;</b> Minimum age limit will be calculated as on July 31, 2018.<br><br>-->
													  <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;Selection &amp; eligibility as per CIPET Admission Procedure.<br>
													  <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;For admission, Please apply through CIPET JEE.<br>
													  <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;Number of Seats - As per AICTE Intake. <br>
													</p>
							       					<?php } ?>
							       					
							       					<?php 
							       					if($program['program_name'] == 'Post Diploma in Plastics Mould Design with CAD&sol;CAM (PD-PMD with CAD / CAM)') { ?>	
							       					 <p style="font-family: sans-serif; font-size:13px;">
					  <b>Course Code &colon;</b> PD-PMD with CAD &sol; CAM<br>
					  <b>Duration &colon;</b> 1 &frac12; years<br>
					  No Age Bar<br><br>
					  <b>Entry Qualification &colon;</b> <br>
					  3 year Diploma in Mechanical, Plastics Technology, Tool&sol;Production Engineering, Mechatronics, Automobile Engineering, Tool &amp; Die Making, DPMT&sol;DPT &#40;CIPET&#41; or equivalent. <br><br>										  
					  <b>Course Offered at</b>  CIPET : Ahmedabad, Amristar, Aurangabad, Bhopal, Chennai, Guwahati, Hyderabad, Madurai, Murthal<br><br>
					  
					  <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;Selection &amp; eligibility as per CIPET Admission Procedure.<br>
					  <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;For admission, Please apply through CIPET JEE.<br>
					  <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;Number of Seats - As per AICTE Intake.<br>
					</p>
							       					<?php } ?>
							       					
							       					<?php 
							       					if($program['program_name'] == 'Postgraduate Diploma in Plastics Processing & Testing (PGD-PPT)') { ?>	
							       					 <p style="font-family: sans-serif; font-size:13px;">
		
					  <b>Course Code &colon;</b> PGD-PPT<br>
					  <b>Duration &colon;</b> 1 &frac12; years<br>
					  No Age Bar<br><br>
					  <b>Entry Qualification &colon;</b> <br>
					  3 year Degree in Science with Chemistry as one of the subjects. <br><br>										  
					  <b>Course Offered at</b>  CIPET : Ahmedabad, Amristar, Aurangabad, Balasore, Bhopal, Chennai, Guwahati, Hajipur, Haldia, Hyderabad, Imphal, Jaipur, Kochi, Lucknow, Madurai, Murthal, Mysore, Raipur, Vijayawada, Baddi, Agartala, Ranchi, Chandrapur, Dehradun, Gwalior, Valsad<br><br>
					 
					  <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;Selection &amp; eligibility as per CIPET Admission Procedure.<br>
					  <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;For admission, Please apply through CIPET JEE.<br>
					  <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;Number of Seats - As per AICTE Intake.<br>
					</p>
							       					<?php } ?>
							       					
							       					<?php 
							       					if($program['program_name'] == 'Postgraduate Diploma in Plastics Testing and Quality Control (PGD-PTQC)') { ?>	
							       					 <p style="font-family: sans-serif; font-size:13px;">
		
					  <b>Course Code &colon;</b> PGD-PTQC<br>
					  <b>Duration &colon;</b> 1 &frac12; years<br>
					    No Age Bar<br>
					  <b>Entry Qualification &colon;</b> <br>
					  3 years Degree in Science Chemistry with Physics and Maths. <br><br>										  
					  <b>Course Offered at</b>  CIPET : Chennai, Hajipur, Haldia, Jaipur,Kochi<br><br>								  
					 
					  <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;Selection &amp; eligibility as per CIPET Admission Procedure.<br>
					  <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;For admission, Please apply through CIPET JEE.<br>
					  <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;Number of Seats - As per AICTE Intake.
					</p>
							       					<?php } ?>
							       					
													<!--<b>Post Graduate Courses (Affiliated to Utkal University): </b><br /><br />
													<ol><li style="margin-top: 5px;">Master of Physiotherapy (MPT) - 2 years duration,-->
													<!-- <br /> Four Specializations i.e.- 
													 <ol type='a'><li style="margin-top: 5px;">Rehabilitation </li>
															<li style="margin-top: 5px;">Musculoskeletal conditions </li>
															<li style="margin-top: 5px;">Paediatrics</li>
															<li style="margin-top: 5px;">Neurology</li></ol><br /> -->
													<!--<li style="margin-top: 5px;">Master of Occupational Therapy (MOT) - 2 years duration, -->
													<!-- <br /> Four Specializations i.e.- 
													<!-- <ol type='a'><li style="margin-top: 5px;">Rehabilitation</li>
															<li style="margin-top: 5px;">Developmental Disabilities</li>
															<li style="margin-top: 5px;">Hand Rehabilitation</li>
															<li style="margin-top: 5px;">Neuro Rehabilitation</li></ol><br /> -->
													<!--<li style="margin-top: 5px;">Master of Prosthetics  and Orthotics (MPO) - 2 years duration</li>-->
														
													

							       					<!--<span class="glyphicon glyphicon-send fa-lg details-favoriteicon" title="Apply Now" aria-hidden="true" onclick="navigate('<?php echo $program['program_code'] ?>')" style="color: #0054ff;margin-left: 88%;margin-top: -10px;"></span>-->	
							       					<!--<button title="Apply Now" class="btn btn-sm pull-right" type="button" onclick="navigate('<?php echo $program['program_code'] ?>')" style="background-color: rgb(228, 121, 26); color: rgb(255, 255, 255);"><i class="fa fa-send"></i>  Apply Now</button>-->
										       		  
										       		<!-- <button title="Course Details" class="btn btn-info btn-sm pull-right" type="button" onclick="viewCourse('<?php echo $program['program_code'] ?>')" style="margin-right: 8px;"><i class="fa fa-file-text"></i>  Course Details</button> -->	
										        </div>
									      	</div>
								    	</div> 
										
									<?php	$i++;
									 }
									}else{ ?>
										<div>No Program Avaliable</div>
									<?php }
									?> 
					  							</div> 
										    </div>
					   					</div>		       						
									</div>
								</div>
								<!--<div style="text-align: center;"><a href="<?php echo base_url();?>application/views/apply/exam_sso_cipet.php" target="_blank"><image src="<?php echo base_url() ?>upload/image/exam.png"></image></a></div>-->
								
								<div style="text-align: center;"><a href="<?php echo base_url() ?>Apply/asseso" target="_blank"><image src="<?php echo base_url() ?>upload/image/exam.png"></image></a></div>
							
							</div> 

  							<div class="col-sm-3 col-xs-12" style="margin-top: 20px;">
								 
							        <div class="col-sm-12" style="background-color: #f59607;border-color: #f59607; color: #ffffff;text-align: center; border-radius: 3px; padding: 12px;padding: 2px 15px;">
							         <h5 style="font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">STEPS TO FILL UP THE APPLICATION FORM</h5>
							        </div>


							       <div class="col-sm-12" style="background: #fff; padding: 5px;">
									
									<ul style="color: #000;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">
									<li><h5 align="justify" style="font-size: 14px;padding-right: 20px;">Please read the following documents carefully before filling up the application form.</h5></li >
									<li><h5 align="justify" style="font-size: 14px;padding-right: 20px;">Read the <a href="<?php echo base_url(); ?>downloads/cipet_brochure.pdf" style="color: rgb(228, 121, 26);" >Information Brochure </a> and <a href="<?php echo base_url(); ?>downloads/payment_cipet.pdf" style="color: rgb(228, 121, 26);" >Payment Instruction Manual</a>.</h5></li >
									<li><h5 align="justify" style="font-size: 14px;padding-right: 20px;">Step 1 - Choose a course of your choice.</h5></li>
									<li><h5 align="justify" style="font-size: 14px;padding-right: 20px;margin-top: 15px;">Step 2 - Read all the fields carefully and then respond.</h5></li>
									<li><h5 align="justify" style="font-size: 14px;padding-right: 20px;margin-top: 15px;">Step 3 - Keep scanned copies of all required documents for upload before filling up the application form.<br>(Within the prescribed dimension and size)</h5></li>
									<li><h5 align="justify" style="font-size: 14px;padding-right: 20px;margin-top: 15px;">Step 4 - Fill up all the relevant fields in the application form.</h5></li >						
									<li><h5 align="justify" style="font-size: 14px;padding-right: 20px;margin-top: 15px;">Step 5 – Please choose the mode of payment before declaration.</h5></li >	
									<li><h5 align="justify" style="font-size: 14px;padding-right: 20px;margin-top: 15px;"><b>IMP:</b> If you choose offline mode, please follow the instructions thereafter and keep the scanned copy of the challan ready for the document upload page.</h5></li >					
									<li><h5 align="justify" style="font-size: 14px;padding-right: 20px;margin-top: 15px;">Step 6 - Upload mandatory documents.</h5></li >						
									<li><h5 align="justify" style="font-size: 14px;padding-right: 20px;margin-top: 15px;">Step 7 - Pay the application fee.</h5></li >						
									<li><h5 align="justify" style="font-size: 14px;padding-right: 20px;margin-top: 15px;">Step 8 - Now you can take a printout of your application.</h5></li >						
									</ul>
								</div>
							</div>
					
				       		
					    </div>
   					</div>		       						
			
			</div>
		</div>
	</div>
</section>

	
	<div class="modal fade" id="modalInstruction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header" style="background-color: #496cad;color: white;">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" style="color: white;" id="myModalLabel">Help</h4>
	      </div>
	      <div class="modal-body" id="divInstruction">
	     
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	
	<div id="actionModal" class="modal fade" role="dialog">
  		<div class="modal-dialog">
	    <!-- Modal content-->
		    <div class="modal-content">
		    	<div class="modal-header"style="background-color: #0d367e;">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title" id="modalheader" style="color: #ff5a00;"></h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="row">
		      			<div class="col-sm-12">
			      			<div class="article">
			      				<h4 align="justify" id="modaldescription" style="color: #0054ff;margin-left:15px;    padding: 3px 21px 1px 6px;font-size: 15px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"></h4>
			      			</div>
			      		</div>
		      		</div>
		      	</div>
    		</div>
  		</div>
	</div>
	<div id="RankModal" class="modal fade" role="dialog">
  		<div class="modal-dialog" style="width: 80%;">
	    <!-- Modal content-->
		    <div class="modal-content">
		    	<div class="modal-header"style="background-color: #0d367e;">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title" id="modalheader" style="color: #ffffff;text-align: center;">JEE - 2018 Rank Card</h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="row">
		      			<div class="col-sm-12" style="text-align: center;">
		      				<div style="color: rgb(255, 255, 255); background-color: rgb(228, 121, 26); padding: 7px; margin-top: -17px; font-size: 17px;" align="center">
			      				<center>
			      					<span><a href='<?=base_url()?>downloads/medical_certificate.pdf' target="_blank"><i class="fa fa-download"></i> Click here</a> to download medical certificate. </span>
			      				</center>
		      				</div>
			      			<h4 >ALL INDIA MERIT LIST FOR ADMISSION INTO DIPLOMAT PROGRAMMES- 2018</h4>
			      			<div style="text-align: left;"><b>Name of Course:</b> <span id="span_course"></span></div>
			      			<div>
			      				<table class="table" id="tblRank" style="width: 100%;">
			      					<thead>
				      					<tr>
				      						<th rowspan="2" hidden>sl no</th>
				      						<th rowspan="2" style="vertical-align: middle;">Name of Student</th>
				      						<th rowspan="2" style="vertical-align: middle;">Regn.No.</th>
				      						<th rowspan="2" style="vertical-align: middle;">Progam</th>
				      						<th rowspan="2" style="vertical-align: middle;" hidden>Marks Obtained</th>
				      						<th rowspan="2" style="vertical-align: middle;">Status</th>
				      						<th colspan="5" style="vertical-align: middle;" hidden>Category wise Marks Obtained in JEE 2018</th>
				      						<th colspan="3" style="vertical-align: middle;">Option of CIPET Centre Choice</th>
				      						<th rowspan="2" style="vertical-align: middle;">State of Domicile</th>
				      						<th rowspan="2" style="vertical-align: middle;">Mob.No.</th>
				      						<th rowspan="2" style="vertical-align: middle;">Counselling Letter</th>
				      					</tr>
				      					<tr>
				      						<th hidden>SC</th>
				      						<th hidden>ST</th>
				      						<th hidden>OBC-NCL</th>
				      						<th hidden>PH</th>
				      						<th hidden>OBC / General</th>
				      						<th>1st</th>
				      						<th>2nd</th>
				      						<th>3rd</th>
				      					</tr>
			      					</thead>
			      					<tbody>
			      						
			      					</tbody>
			      				</table>
			      			</div>
			      		</div>
		      		</div>
		      	</div>
    		</div>
  		</div>
	</div>
	
	<!--<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>-->
			<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
	var reg_user_id = '<?=$reg_user_id?>';
	
		/*TO DISABLE BROWSER BACK BUTTON IN THIS PARTICULAR PAGE START */
		history.pushState(null, null, document.URL);
		window.addEventListener('popstate', function () {
		    history.pushState(null, null, document.URL);
		});
		/*TO DISABLE BROWSER BACK BUTTON IN THIS PARTICULAR PAGE END */
		
		function navigate(admcode)
		{
			//alert(admcode);
			$.ajax({
				url:base_url+"ajax_controller/temp_config",
				type:"post",
				data:{'admcode':admcode},
				success:function(response){ 
					var obj = JSON.parse(response);
					console.log('apply/'+obj.file+'/ins/'+obj.ins);
					window.location.href=(base_url+'apply/'+obj.file+'/ins/'+obj.ins);	
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		}
	
		function viewCourse(admcode)
		{
			//alert(admcode);
			$('#actionModal').modal('show');
			$.ajax({
				url:base_url+"ajax_controller/course_modal",
				type:"post",
				data:{'admcode':admcode},
				success:function(response){ 
				//alert(response);
					var obj = JSON.parse(response);
					//alert(obj[0].program_name);
					document.getElementById("modalheader").innerHTML = obj[0].program_name;
					document.getElementById("modaldescription").innerHTML = obj[0].description;
					
				//	console.log('apply/'+obj.file+'/ins/'+obj.ins);
				//	window.location.href=(base_url+'apply/'+obj.file+'/ins/'+obj.ins);	
				},
				error:function(){
					//alert("error");
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		}
		function printApplication(admcode)
		{
			var institutedata={
			program : admcode,
			reg_user_id : reg_user_id,
			mode : 'edit',
			};
			$.ajax({
				url:base_url+"/ajax_controller/edit_manage_appns",
				type:"post",
				data:institutedata,
				success:function(response)
				{  
					var res1 = JSON.parse(response);
					$.each(res1.aaData,function(i,data)
					{
						var strWindowFeatures = "location=yes,height=825,width=1500,scrollbars=yes,status=yes";
						//var URL = base_url+'mpdf_controller/template008_pdf/program/'+admcode ;
						var URL = base_url+"mpdf_controller/template008_pdf/reg_user_id/"+data.file_name+"/program/"+admcode ;
						window.open(URL, "_blank", strWindowFeatures);
						//window.open(base_url+"mpdf_controller/template008_pdf/reg_user_id/"+data.file_name+"/program/"+admcode);
					});	
				},
				error:function()
				{
					toastr.error("We are unable to Process.Please contact Support");
				}
			});
		}
		function downloadquestion(admcode)
		{
			var strWindowFeatures = "location=yes,height=825,width=1500,scrollbars=yes,status=yes";
			var URL = base_url+'downloads/question/'+admcode+'.pdf' ;
			window.open(URL, "_blank", strWindowFeatures);
			
		}
		function printAdmitCard(admcode)
		{
			//alert(admcode);
			var strWindowFeatures = "location=yes,height=825,width=1500,scrollbars=yes,status=yes";
			var URL = base_url+'mpdf_controller/admit_card/app_prog/'+admcode ;
			window.open(URL, "_blank", strWindowFeatures);
			//window.location.href=(base_url+'mpdf_controller/template008_pdf/app_prog/'+admcode);
		}
		function print_rank_detail(admcode)
		{
			$('#RankModal').modal('show');
			var tblRank = $('#tblRank').dataTable({
				"ajax":
				{
					"url": base_url+"/ajax_controller/get_rank_data",
					"type": "POST",
					"data":  {
						applied_program:admcode,
						reg_user_id:'<?=$reg_user_id?>'
						
					},
				},  
				"bPaginate": false,
		        "bLengthChange": false,
		        "bFilter": false,
		        "bSort": false,
		        "bInfo": false,
				"bDestroy":true,
		        "bAutoWidth":true, 
		        "scrollX":false,
		        //"sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutegroupbutton' >>><'col-xs-6'p>>",
			    "aoColumns": [    
		           { "sName": "sl_no","bVisible":false},
		           { "sName": "full_name"},
		           { "sName": "jee_rankno"},
		           { "sName": "program" },
		           { "sName": "mark_obtained" ,"bVisible":false},
		           { "sName": "applicant_status" },
		           { "sName": "rank_sc","bVisible":false },
		           { "sName": "rank_st","bVisible":false },
		           { "sName": "rank_obc","bVisible":false },
		           { "sName": "rank_ph","bVisible":false },
		           { "sName": "rank_gen","bVisible":false },
		           { "sName": "1st_center" },
		           { "sName": "2nd_center" },
		           { "sName": "3rd_center" },
		           { "sName": "state" },
		           { "sName": "reg_user_id" },
				   { "sName": "counselling_letter", "mRender":function(data,type,full){
				   			if(full['applicant_status']=='SL'){
				   				return "<button  type = 'button' class='btn btn-success btn-sm btn-circle tooltipTable' onclick='print_rank_card(event)' title='Call Letter' ><i class='fa fa-download'></i></button>";
				   			}else{
								return "<span></span>";
							}
							//return "<span></span>";
				   		}
				   },
		        ]
			});
		}
		function print_rank_card(event){		
			var oTable = $('#tblRank').dataTable();				
			$(oTable.fnSettings().aoData).each(function (){
				$(this.nTr).removeClass('success');
			});
			var row;
			if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
		  		row = event.target.parentNode.parentNode;
			else if(event.target.tagName == "I")
		  		row = event.target.parentNode.parentNode.parentNode; 
			$(row).addClass('success');
			var applied_program = oTable.fnGetData( row )['applied_program'];
			
			var reg_user_id = oTable.fnGetData( row )['reg_user_id'];
			var URL = base_url+'mpdf_controller/rank_card/app_prog/'+applied_program ;
			var strWindowFeatures = "location=yes,height=825,width=1500,scrollbars=yes,status=yes";
			window.open(URL, "_blank", strWindowFeatures);
		}
	</script>
	
