<?php
	date_default_timezone_set('Asia/Kolkata');
    $now = date('Y-m-d h:i:s', now());
	foreach($institute_data as $ins_data)
	{
		$institute_code = $ins_data['institute_code'];
		$institute_name = $ins_data['institute_name'];
		$image_url = $ins_data['image_url'];
	}
	//print_r($program_data);
	$active_tab = isset($_REQUEST['tab'])?$_REQUEST['tab']:$program_group_data[0]['program_group_code'];
	$data = $this->uri->uri_to_assoc();
	$institute = $data['ins'];
?>

<!-- <style>
	.details-favoriteicon {
	    border: 2px solid #0054ff;
	    padding: 10px 9px 10px 6px;
	    border-radius: 50%;
	    font-size: 21px;
	    cursor: pointer;
	}

	.panel-title{
	color: red;
	}
	.hr{
		color:blue;
	}
</style> -->
<input type="hidden" name="hidPageCode" id="hidPageCode" value="INSTITUTE"/>
<section style="background: url(<?php echo base_url() ?>upload/image/slider_21.jpg);padding-bottom: 180px;">
	<div class="row">
		<div class="col-sm-12">
			<div class="col-sm-1" style="margin-top: 30px; padding-left: 0;">
				<?php include('sidebar/sidebar.php'); ?>
				
			</div>
			<div class="col-sm-11">
		<div class="row">
			<div class="col-sm-12">
				
	       		
	        	<!--<div class="col-sm-1" style="padding: 0; margin: 0;"></div>-->
	       		<div class="col-sm-7" style="margin-top: 20px;">
				       			<div class="panel panel-default" >
					        	   	<div class="panel-heading" style="background-color: #febb2e;border-color: #febb2e; color: #ffffff;text-align: center;">
						      			<h4 style="font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">DIPLOMA PROGRAM DETAILS</h4>
						        	</div>
					        		<div class="panel-body">
			       	<div class="row">	
								       		<div class="col-md-12" style="margin-top: 10px;">
			       			<div class="panel-group" id="accordion">
			       				<?php
									$i = 1;
									$c = "";
									foreach($program_data as $program)
									{ ?> 
										<div class="panel panel-default">
											<div class="panel-heading" style="<?php echo $program['appl_status']!=''?'background-color: #febb2e;':'background-color: #07734F;'?>">
												<h4 class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$i?>" style="color: #fff;cursor: pointer;"><?php echo $program['program_name'] ?>
													<?php if($program['appl_status']=='Verified'){ ?>
														<span title="Apply Now" class="label pull-right"  onclick="navigate('<?php echo $program['program_code'] ?>')" style="background-color: rgb(228, 121, 26); color: rgb(255, 255, 255);"><i class="fa fa-file"></i>  View</span>
													<?php }elseif($program['appl_status']!='Verified' && $program['appl_status']!=''){ ?>
														<span title="Apply Now" class="label pull-right"  onclick="navigate('<?php echo $program['program_code'] ?>')" style="background-color: rgb(228, 121, 26); color: rgb(255, 255, 255);"><i class="fa fa-edit"></i>  Not Completed</span>
													<?php }else{ ?>
														<span title="Apply Now" class="label pull-right"  onclick="navigate('<?php echo $program['program_code'] ?>')" style="background-color: rgb(228, 121, 26); color: rgb(255, 255, 255);"><i class="fa fa-send"></i>  Apply</span>
													<?php } ?>
												</h4>
											</div>
									        <div id="collapse<?=$i?>" class="panel-collapse collapse <?php echo $i==1?'in':''?>">
									        	<div class="panel-body" style="height: 170px;">
										        	<h6 style="color: #0054ff;margin-left:5px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">Course code: <span><b><?php echo $program['program_code'] ?></b></span></h6>
							       					<h6 style="color: #0054ff;margin-left:5px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">Duration: <span>3 years(6 semesters)</span></h6>
							       					<h6 style="color: #0054ff;margin-left:5px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;"><b>Minimum age:15 years<sup>*</sup></b></h6>
							       					<h6 style="color: #0054ff;margin-left:5px;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;padding-right: 5px;">Entry qualification: 35% marks (all subject together) in X std. with Mathematics,Science and English.</h6>
							       					<!--<span class="glyphicon glyphicon-send fa-lg details-favoriteicon" title="Apply Now" aria-hidden="true" onclick="navigate('<?php echo $program['program_code'] ?>')" style="color: #0054ff;margin-left: 88%;margin-top: -10px;"></span>-->	
							       					<!--<button title="Apply Now" class="btn btn-sm pull-right" type="button" onclick="navigate('<?php echo $program['program_code'] ?>')" style="background-color: rgb(228, 121, 26); color: rgb(255, 255, 255);"><i class="fa fa-send"></i>  Apply Now</button>-->
										       		<?php if($program['appl_status']=='Verified'){ ?>
										       		<button title="Print Application" class="btn btn-success btn-sm pull-right" type="button" onclick="printApplication('<?php echo $program['program_code'] ?>')" style="margin-right: 8px;"><i class="fa fa-print"></i>  Print Application</button>	
										       		<?php } ?>
										       		<button title="Course Details" class="btn btn-info btn-sm pull-right" type="button" onclick="viewCourse('<?php echo $program['program_code'] ?>')" style="margin-right: 8px;"><i class="fa fa-file-text"></i>  Course Details</button>	
										        </div>
									      	</div>
								    	</div> 
										
									<?php	$i++;
									 }
									?> 
					  							</div> 
										    </div>
					   					</div>		       						
									</div>
								</div>
							    
  							</div> 


  										<div class="col-sm-5 col-xs-12" style="margin-top: 20px;">
								 
							        <div class="col-sm-12" style="background-color: #febb2e;border-color: #febb2e; color: #ffffff;text-align: center; border-radius: 3px; padding: 12px;">
							         <h4 style="font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">HOW TO APPLY FOR DIPLOMA PROGRAMS</h4>
							        </div>


							        <div class="col-sm-12" style="background: #fff; padding: 5px;">
					<ul style="color: #000;font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">
						<li><h4 align="justify" style="font-size: 15px;padding-right: 20px;">Information Brochure and Application form can be obtained from any of CIPET Centers against payment of Rs. 500 /- for general candidates and Rs.100 /- for SC/ST candidates in cash or Demand Draft drawn in favour of "CIPET______".</h4></li>
						<li><h4 align="justify" style="font-size: 15px;padding-right: 20px;margin-top: 20px;">Candidates belonging to North-Eastern states can get the application forms free of cost by producing their residential proof/ appropriate support documents.</h4></li>
						<li><h4 align="justify" style="font-size: 15px;padding-right: 20px;margin-top: 20px;">Candidates can fill and submit the application form online. The details are given on CIPET website: <a href="www.cipet.gov.in">www.cipet.gov.in</a></h4></li>				
					</ul>
									</div>
								</div>
					
				       		
					    </div>
   					</div>		       						
			
			</div>
		</div>
	</div>
</section>
<div class="modal fade" id="date" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header" style="background-color: #00008B;">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;"><span aria-hidden="true">&times;</span></button>
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
	
	<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	
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
			var strWindowFeatures = "location=yes,height=825,width=1500,scrollbars=yes,status=yes";
			var URL = base_url+'mpdf_controller/template008_pdf/app_prog/'+admcode ;
			window.open(URL, "_blank", strWindowFeatures);
			//window.location.href=(base_url+'mpdf_controller/template008_pdf/app_prog/'+admcode);
		}
	</script>
	
