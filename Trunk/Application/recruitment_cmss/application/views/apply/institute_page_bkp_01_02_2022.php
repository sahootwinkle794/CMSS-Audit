<?php
	date_default_timezone_set('Asia/Kolkata');
    $now = date('Y-m-d H:i:s', now());
    $today = date('Y-m-d', now());
    $reg_user_id = $this->session->userdata('reg_user_id');
    //echo sizeof($advertise_data);die;
	foreach($institute_data as $ins_data)
	{
		$program_groups = $ins_data['program_view_structure']; 
		$institute_code = $ins_data['institute_code'];
		$institute_name = $ins_data['institute_name'];
		$image_url = $ins_data['image_url'];
	}
	foreach($program_data as $row)
	{
		$apply_date1 = $row['date1'];
		$apply_date2 = $row['date2'];
	}
	$style = "background-color:rgb(217, 217, 217)";
	//$program[] = '';
	$program_coll = array();
	foreach($program_wise_status as $row)
	{
		$program_coll[] = $row['applied_program'];
	}
	//print_r($program_coll);die();
	//print_r($program[0]);die();
	$data = $this->uri->uri_to_assoc();
	$institute = $data['ins'];
	if(isset($program_coll[0]) == '')
	{
		$program_collapse = '';
	}
	else
	{
		$program_collapse = $program_coll[0];
	}
	$program_code_collapse = isset($data['program_code'])?$data['program_code']:$program_collapse;
	//print_r($program_code_collapse);die();
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
.panel-default {
    border-color: rgb(142, 153, 102);
}
.panel-default1 {
    border-color: #ffffff;
}
.panel-primary > .panel-heading1 {
    color: #fff;
    background-color: #e65d3e;
    border-color: #f39c12;
    padding-top: 10px;
    padding-bottom: 10px;
}
.panel-success > .panel-heading1 {
    color: #fff;
    background-color: #027b44;
    border-color: #027b44;
    padding-top: 10px;
    padding-bottom: 10px;
}
.panel-primary > .panel-heading {
    color: #fff;
    background-color: rgb(142, 153, 102);
    border-color: rgb(142, 153, 102);
}
.panel-primary {
    border-color: rgb(142, 153, 102);
}
.btn-info {
    background-color: #e2322f;
    border-color: #e06347;
}
.btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .open > .dropdown-toggle.btn-info {
    color: #fff;
    background-color: #e2322f;
    border-color: #e2322f;
}
.smpl-step {
        margin-top: 40px;
    }
    .smpl-step {
        border-bottom: solid 1px #e0e0e0;
        padding: 0 0 10px 0;
    }

    .smpl-step > .smpl-step-step {
        padding: 0;
        position: relative;
    }   

    .smpl-step > .smpl-step-step .smpl-step-num {
        font-size: 17px;
        margin-top: -36px;
        margin-left: -28px;
    }

    .smpl-step > .smpl-step-step .smpl-step-info {
        font-size: 14px;
        padding-top: 27px;
    }

    .smpl-step > .smpl-step-step > .smpl-step-icon {
        position: absolute;
        width: 144px;
        height: 32px;
        display: block;
        background: #86de86;
        top: 45px;
        left: 50%;
        margin-top: -41px;
        margin-left: -80px;
        border-radius: 5px;
        border-color: black;
        /*border: 1px solid black;*/
    }

    .smpl-step > .smpl-step-step > .progress {
        position: relative;
        border-radius: 0px;
        height: 1px;
        width: 100%;
        box-shadow: none;
        margin-top: 30px;
        margin-left: 40px;
    }

   .smpl-step > .smpl-step-step > .progress > .progress-bar {
       width: 0px;
       box-shadow: none;
       background: #191a1b;
   }

    .smpl-step > .smpl-step-step.complete > .progress > .progress-bar {
        width: 100%;
    }

    .smpl-step > .smpl-step-step.active > .progress > .progress-bar {
        width: 100%;
    }

    .smpl-step > .smpl-step-step:first-child.active > .progress > .progress-bar {
        width: 0%;
    }

    .smpl-step > .smpl-step-step:last-child.active > .progress > .progress-bar {
        width: 100%;
    }

    .smpl-step > .smpl-step-step.disabled > .smpl-step-icon {
        background-color: #e2dfdf;
        border-color: black;
        /*border: 1px solid black;*/
    }

    .smpl-step > .smpl-step-step.disabled > .smpl-step-icon:after {
        opacity: 0;
    }
    

    .smpl-step > .smpl-step-step:first-child > .progress {
        left: 50%;
        width: 50%;
    }

    .smpl-step > .smpl-step-step:last-child > .progress {
        width: 50%;
    }

    .smpl-step > .smpl-step-step.disabled a.smpl-step-icon {
        pointer-events: none;
    }
    .btn-warning {
	    background-color: #f39c12;
	    border-color: rgba(246, 244, 240, 0.02);
	}
	.progress {
    height: 20px;
	    margin-bottom: 20px;
	    overflow: hidden;
	    background-color: #eadede;
	    border-radius: 4px;
	    box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
}

		.back{
			background-color: #191a1b;
		}
		@media only screen and (max-width: 768px) {
			.progress {
	   		 background-color: #fff0;
		}
		.back{
			background-color: #fff0;
		}
		.smpl-step > .smpl-step-step > .progress > .progress-bar {
		    background: #fff0;
		}
		.smpl-step > .smpl-step-step > .progress {
		    margin-top: 0px;
		}
		.smpl-step > .smpl-step-step .smpl-step-num {
		    font-size: 17px;
		    margin-top: 9px;
		    margin-left: -170px;
		}
		.smpl-step > .smpl-step-step > .smpl-step-icon {
			left: 65%;
			}
		.panel-title {
		   margin-bottom: 10px; 
		}	
		}
	.panel-default {
	    border-color: rgb(219, 205, 197);
	}
	.box-green{
		background: linear-gradient(to right,#aaddfb, #a5e2f5);
		width: 100%;
		padding: 10px;
		margin-bottom: 5px;
	}
	.box-white{
		background: linear-gradient(to right,#aaddfb, #a5e2f5);
		width: 100%;
		padding: 15px;
		margin-bottom: 5px;
	}
	.img1
	{
		margin-left: -16px;
		margin-top: 14px;
	}
	.btn {
	    border-radius: 3px;
	    -webkit-box-shadow: none;
	    box-shadow: none;
	    border: 1px solid transparent;
	    margin-top: 8px;
	}
</style> 

<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/progress_wizard/progress_wizard.css" />
<input type="hidden" name="hidPageCode" id="hidPageCode" value="INSTITUTE"/>
<input type="hidden" name="hidInsCode" id="hidInsCode" value="<?=$institute?>"/>
<input type="hidden" name="hidProgColl" id="hidProgColl" value="<?=$program_code_collapse?>"/>
<section style="background: url(<?php echo base_url() ?>upload/image/background.svg);min-height: 400px;padding-top: 105px;padding-left: 95px;">
<!--<section style="min-height: 400px;padding-top: 105px;">-->
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-1 hidden-xs" style="margin-top: 20px;margin-left: -30px;z-index: 1000;">
				<?php include('sidebar/sidebar.php'); ?>
				
			</div>
			<div class="col-md-11 col-xs-12 fpad">
			
			<div class="row">
	       		<div class="col-md-9 col-xs-12 fpad" style="margin-top: 20px;">
	       			<div class="panel panel-default" >
		        	   	<div class="panel-heading" style="background: linear-gradient(to left, #2fa2c5 30%, #1d7a96 100%);color: #ffffff;text-align: center;padding: 2px 15px;">
			      			<h4 style="font-family:'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">POST DETAILS</h4>
			        	</div>
		        		<div class="panel-body fpad" style="overflow-y: auto;height: 400px";>
       						<div class="row">	
					       		<div class="col-md-12" style="margin-top: 10px;">
					       		
					       			<div class="panel-group" id="accordion">
					       				<?php
											$i = 1;
											$c = "";
											if(sizeof($program_data)!=0){
											foreach($advertise_data as $row1)
											{
												$advt_data = $row1['advt_no'];
											?> <h4 style="color: blue;">Advertisement No: <?php echo $advt_data; if($advt_data == 'AD 6B 12/ 05 /2021'){?> <span style="float: right;">Location: Balangir, Odisha</span><?php } ?></h4>											
											<?php foreach($program_data as $program)
												  { 
												  // 	echo "<pre>";
														// print_r($program['program_name'] );exit;
													$program_advt_data=$program['advt_no'];
													if($program_advt_data == $advt_data)
													{
													$menu = 0;
													$menus = array();
													
													$program_code=$program['program_code'];

													// echo "<pre>";print_r($program_code);exit;
													$admitcard_data = $program['admt_crd'];
													$admitcard_all_data =  explode('@',$admitcard_data);
													$admit_card_available_from = $admitcard_all_data[0];
													$admit_card_available_upto = $admitcard_all_data[1];
													$round = $admitcard_all_data[2];
													$template_code = $admitcard_all_data[3];
													$exam_center_code = $admitcard_all_data[4];
													$assigned_exam_vanue = $admitcard_all_data[5];
													$status = TRUE;
													$upload_file_name = $program['upload_file_name'];
													
													$file_path = $program['file_path'];
													$appl_no = $program['appl_no'];
													$course_name = $program['course_name'];
													$template_name = $program['template_name'];
													$file_name = $program['file_name'];
													$reeval_status = $program['reeval_status'];
												?> 
												
												<div class="panel panel-default">
												<?php
												
														if(in_array($program_code,$program_coll))
														{
													?>
															<div class="panel-heading" style="background-color:rgb(176, 173, 173);">
												<?php		
														}
														else
														{
												?>
														<div class="panel-heading" style="background-color: rgb(217, 217, 217);">
												<?php
														}
													
												?>

														<h4 class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?=$program_code?>" style="color: black;cursor: pointer;"><?php echo $program['program_name'] 
														?>
														<img src="<?= base_url(); ?>public/assets/images/down_arrow.jpg" width="18px" style="float: right"/>	
															 
														</h4>
													</div>
											        <div id="collapse_<?=$program_code?>" class="panel-collapse collapse">
											        	<div class="panel-body" style="height: auto;">
												        		<div class="row smpl-step" style="border-bottom: 0;">
												        <div class="col-sm-3 col-xs-12 smpl-step-step complete">
												            <div class="text-center smpl-step-num">Step 1</div>
												            <div class="progress">
												                <div class="progress-bar"></div>
								 				            </div>
												             <a  class="smpl-step-icon"><p style="font-size: 15px; padding-left: 28px; padding-top: 5px; color: black;">Registration &nbsp;<i class="fa fa-share" aria-hidden="true"></i></p></a>
												           
												        </div>

												        <div class="col-sm-3 col-xs-12 smpl-step-step disabled">           
												            <div class="text-center smpl-step-num">Step 2</div>
												            
												            <?php if($program['appl_status'] == 'Student Details Submitted' || $program['appl_status'] == 'Document Uploaded'||$program['appl_status'] == 'Fee Paid' || $program['appl_status'] == 'Verified')
												            {
												            ?>
												            	<div class="progress back" >
													                <div class="progress-bar"></div>
													             </div>
												            	<a class="smpl-step-icon" style="background-color:#86de86;">
												            	<p  style="font-size: 15px; padding-left: 8px; padding-top: 4px; color: black;">Application Form &nbsp;<i class="fa fa-share" aria-hidden="true"></i></p></a>
												            <?php
												            } 
												            else
												            {
															?>
																<div class="progress">
													                <div class="progress-bar" style="padding-top: 10%;"></div>
													            </div>
																<a class="smpl-step-icon">
																<p  style="font-size: 15px; padding-left: 18px; padding-top: 4px; color: black;">Application Form</p></a>
															<?php	 
															}
												            ?>
												           
												        </div>
												        <div class="col-sm-3 col-xs-12 smpl-step-step disabled">          
												            <div class="text-center smpl-step-num">Step 3</div>
												            <?php if($program['appl_status'] == 'Document Uploaded'||$program['appl_status'] == 'Fee Paid' || $program['appl_status'] == 'Verified')
												            {
												            ?>
												            	<div class="progress back" >
													                <div class="progress-bar"></div>
													            </div>
												            	<a class="smpl-step-icon" style="background-color:#86de86;">
												            	<p  style="font-size: 15px; padding-left: 2px; padding-top: 4px; color: black;">Document Upload&nbsp;<i class="fa fa-share" aria-hidden="true"></i></p></a>
												            <?php
												            } 
												            else
												            {
															?>
																<div class="progress">
													                <div class="progress-bar" style="padding-top: 10%;"></div>
													            </div>
																<a class="smpl-step-icon">
																<p  style="font-size: 15px; padding-left: 14px; padding-top: 4px; color: black;">Document Upload</p></a>
															<?php	
															}
												            ?>
												        </div>
												         <div class="col-sm-3 col-xs-12 smpl-step-step disabled">          
												            <div class="text-center smpl-step-num">Step 4</div>
												            <?php if($program['appl_status'] == 'Fee Paid' || $program['appl_status'] == 'Verified')
												            {
												            ?>
												            	<div class="progress back" >
													                <div class="progress-bar"></div>
													            </div>
												            	<a class="smpl-step-icon" style="background-color:#86de86;">
												            	<p  style="font-size: 15px; padding-left: 31px; padding-top: 4px; color: black;">Fee Payment</p></a>
												            <?php
												            } 
												            else
												            {
															?>
																<div class="progress">
													                <div class="progress-bar" style="padding-top: 10%;"></div>
													            </div>
																<a class="smpl-step-icon">
																<p  style="font-size: 15px; padding-left: 31px; padding-top: 4px; color: black;">Fee Payment</p></a>
															<?php	
															}
												            ?>
												        </div>
												    </div>
															
									       					<h4 style="margin-left:5px;padding-right: 5px;font-size: 15px;">
																<b>Post Name</b> : <?php echo $program['program_name'] ?>
																
															</h4>
															<h4 style="margin-left:5px;padding-right: 5px;font-size: 15px;">
																<b>Description</b> : <?php echo $program['program_desc'] ?><br /><br />
															</h4>
															<h4 style="margin-left:5px;padding-right: 5px;font-size: 15px;">
																<b>Instructions</b><br /><br />
																<ol>
																	<li style="margin-top: 5px;">Read all the fields carefully and then respond.</li> 
																	<li style="margin-top: 5px;">Fill up all the relevant fields in the application form.</li>
																</ol>
															</h4>
												       		<?php 
															   //echo '<pre>';print_r($menu);die;
												       		if(sizeof($menus) >= 1)
												       		{
																foreach($menus as $row)
													       		{
													       			$link_url1 = explode('`',$row);
													       			if(isset($link_url1[1]))
													       			{
																		$link_url2 = $link_url1[1];
														       			$link_url2 = explode('*',$link_url2);
														       			$link_url = $link_url2[0];
																	}
																	else
																	{
																		$link_url2 = '' ;
																		$link_url = '' ;
																	}
																	
													       			$link_text1 = explode('@',$row);
													       			if(isset($link_text1[1]))
													       			{
																		$link_text2 = $link_text1[1];
														       			$link_text2 = explode('`',$link_text2);
														       			$link_text = $link_text2[0];
																	}
																	else
																	{
																		$link_text2 = '' ;
																		$link_text = '' ;
																	}
																	
													       			$file_name1 = explode('*',$row);
													       			if(isset($file_name1[1]))
													       			{
																		$file_name = $file_name1[1];
																	}
																	else
																	{
																		$file_name = '' ;
																	}
													       			
													       			//$link = $program['link_url'];
																	//$menus = explode(',',$menu);
													       		?>
													       			<a href='<?= BASE_ADM_URL ?>/DOCUMENTS/<?=$program_code?>/<?= $file_name?>'><button type="button" class="btn btn-warning " style="background-color: #08C5E2; color: rgb(255, 255, 255);"><i class="glyphicon glyphicon-log-in"></i>&nbsp;<?php echo $link_text ?></button></a>
													       		 	<?php
																}
															}
												       		?>
												       		<center>
												       		  <div class="pull-right">
												       		  
												       		  <?php  if($program['appl_status']=='Verified'){ ?>
												       			<button title="Print Application" class="btn btn-success" type="button" onclick="printApplication('<?php echo $program['program_code'] ?>')" style="margin-right: 8px;"><i class="fa fa-print"></i>  Print Application</button>	
												       		<?php } ?> 

												       		<?php if($program['appl_status']=='Verified'){ ?>
																<span title="View" class="btn"  onclick="navigate('<?php echo $program['program_code'] ?>')" style="background-color: rgb(228, 121, 26); color: rgb(255, 255, 255);"><i class="fa fa-file"></i>  View</span>
																<?php if( strtotime($program['apply_end_date']) >= strtotime($now) ){ ?>
																	<!--<span title="Edit" class="btn"  onclick="navigate('<?php echo $program['program_code'] ?>','edit')" style="background-color: rgb(31, 82, 97); color: rgb(255, 255, 255);"><i class="fa fa-edit"></i>  Edit</span>-->
															  <?php }}elseif($program['appl_status']!='Verified' && $program['appl_status']!='' && strtotime($program['apply_end_date']) >= strtotime($now) ){ ?>
																<!--<span title="Not Completed" class="btn"  onclick="navigate('<?php echo $program['program_code'] ?>')" style="background-color: rgb(228, 121, 26); color: rgb(255, 255, 255);"><i class="fa fa-edit"></i>  Not Completed</span>-->
																<span title="Not Completed" class="btn"  onclick="instuction_steps('<?php echo $program['program_code'] ?>',<?php echo $i; ?>);" style="background-color: rgb(228, 121, 26); color: rgb(255, 255, 255);"><i class="fa fa-send"></i>  Not Completed</span>
															<?php }elseif( strtotime($program['apply_start_date']) <= strtotime($now) && strtotime($program['apply_end_date']) >= strtotime($now) ){ ?>
																<!--<span title="Apply Now" class="btn"  onclick="navigate('<?php echo $program['program_code'] ?>')" style="background-color: rgb(228, 121, 26); color: rgb(255, 255, 255);"><i class="fa fa-send"></i>  Apply Now</span>-->
																<span title="Apply Now" class="btn"  onclick="instuction_steps('<?php echo $program['program_code'] ?>',<?php echo $i; ?>);" style="background-color: rgb(228, 121, 26); color: rgb(255, 255, 255);"><i class="fa fa-send"></i>  Apply Now</span>
																<input type="hidden" id="hidadmcode<?php echo $i; ?>" name="hidadmcode<?php echo $i; ?>" value="<?php echo $program['program_code'] ?>"/>
															<?php } 
															if($admit_card_available_from <= $today && $admit_card_available_upto >= $today)
															{
																
																if($program['admit_status'] == 1)
																{
																?>
																		<span title="Admit card" class="btn"  onclick="printAdmitCard('<?php echo $template_code ?>','<?php echo $exam_center_code ?>','<?php echo $assigned_exam_vanue ?>','<?php echo $program['program_code'] ?>')" style="background-color: rgb(67, 194, 211); color: rgb(255, 255, 255);"  ><i class="fa fa-file"></i>  Print Admit Card</span>
																
																
																<?php
																
																	if($status)
																	{ 
																	
																		?>	
																			<!-- <a href="<?=base_url()?>apply/result_html/<?=$program_code?>/<?= $ins?>" target="_blank">
																			<span title="View Result" class="btn " style="background-color: rgb(88, 92, 216); color: rgb(255, 255, 255);"  >
																			<i class="fa fa-info-circle"></i>  View Result</span>
																			</a></br></br>-->
																				<!--<button type="button" class="btn btn-danger" onclick="openForm('<?php echo $program_code ?>');" >Upload Document</button>-->
																		<?php
																			if($upload_file_name)
																			{
																			?>
																				<a href='<?= BASE_ADM_URL ?>/DOCUMENTS/<?=$program_code?>/<?=$appl_no?>/<?= $upload_file_name?>' target="_blank">
																				 <button style="font-family:sans-serif;" type="button" class="btn btn-danger"><i class="fa fa-print"></i>	Scan sheet of Exam Copy</button>
																				 </a>
																				 
																			<?php	
																				if($reeval_status == 'Fee Paid' || $reeval_status == 'Verified')
																				{
																				?>		
																						 
																						<button style="font-family:sans-serif; " type="button" class="btn btn-primary" disabled >Answer Key Challenge</button>
																				<?php	
																				}
																				else
																				{
																					?>
																						
																						<a href="<?=base_url()?>apply/reeval_<?=$template_name?>/ins/<?= $institute?>/admcode/<?=$program_code?>" target="_blank"><button style="font-family:sans-serif; " type="button" class="btn btn-primary">Answer Key Challenge</button></a>
																					<?php
																				}
																			}
																				
																	}
																
																	
																}
																else{
																	
																}
															}
												
															
															?>
															
															</div>
														</center>
												       		</div>
											      	</div>
										    	</div> 
												
											<?php	$i++;
											}
												  }
											
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
					    
					</div> 
			
				<div class="col-md-3 col-xs-12"style="margin-top: -2%;">
    
    				<div class="row-sm-12 row-xs-12" style="margin-top: 77px;" >
				       <div class="row-sm-4 row-xs-4" style="padding-left: 0;cursor: pointer;" >
				        <div  class="col-sm-12 col-xs-12 box-green">
					        <div  class="col-sm-2 col-xs-12">
									<img class= "img1" src="<?php echo base_url()?>public/assets/images/icon/Application.png " >
							</div>
							<div  class="col-sm-10 col-xs-12">
									<p align="left" >आवेदन केलिए अनुदेश <br />Instruction For Filling <br />Application</p>
							</div>
				         </div>
				       </div>
						
				       
				       <div class="row-sm-4 row-xs-4" style="padding-left: 0; padding-right: 0;cursor: pointer" data-toggle="modal"  >
				       		
				            <div  class="col-sm-12 col-xs-12 box-white">
				            	<h4 >Color Description of Post Details</h4>
								<div  class="col-sm-2 col-xs-2">
										
									<div style="background-color: rgb(176, 173, 173);width: 20px;height: 20px;">

									</div>
									
									<div style="background-color: rgb(217, 217, 217);width: 20px;height: 20px;margin-top: 29px;">

									</div>
								</div>
								<div  class="col-sm-10 col-xs-10">
									<p>Already applied Post</p>
									<p style="margin-top: 29px;">Non-applied Post</p>
								</div>
				            
				         	</div>
				       </div>
				       <div class="row-sm-4 row-xs-4" style="padding-left: 0; padding-right: 0;cursor: pointer" data-toggle="modal"  >
				       		
				            <div id="ChangePassword" class="col-sm-12 col-xs-12 box-white">
				            	<h4 style="text-align: center">CHANGE PASSWORD</h4>
								
				         	</div>
				       </div>
				       
				    </div>
				    
				</div>	
			 </div>
   			</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1 hidden-xs" ></div>
			<div class="col-md-8 col-xs-12">
				
	       		
	        	
			</div>
		<div class="col-md-4 hidden-xs" ></div>
	</div> 
</section> 
<div class="modal fade" id="ChangePasswordModal" tabindex="-1" role="dialog" aria-labelledby="ChangePasswordModal" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document" style="width: 50%;">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
		&times;</button>
		<center><h4 class="modal-title" id="myModalLabelHeader1"> Change Password</h4></center>
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
      </div>
	<form class="form-horizontal" id="frmApply" name="frmApply">
      	<div class="modal-body">
			<input type="hidden" name="shapasswordOld" id="shapasswordOld"/>
			<!--<input type="hidden" name="passwordNew" id="passwordNew"/>-->
			<input type="hidden" name="shapasswordNew" id="shapasswordNew"/>
			<input type="hidden" name="shapasswordNewOne" id="shapasswordNewOne"/>
			<input type="hidden" name="shapasswordConfirm" id="shapasswordConfirm"/>
			
			<input type="hidden" name="user_name" id="user_name" value="<?php echo $reg_user_id ?>"/>
			<div class="form-group">
				<label for="inputname" class="col-lg-5 control-label"><i style="color:red;font-size:15px;">*</i> Current Password</label>
				<div class="col-lg-7">
					<input type="password" class="form-control" id="txtoldPassword" name="txtoldPassword" placeholder="Current Password">
				</div>
				<br/><br/>
			</div>
			
			<div class="form-group">
				<label for="" class="col-lg-5 control-label"><i style="color:red;font-size:15px;">*</i> New Password</label>
				<div class="col-lg-7">
					<input type="password" id="txtNewPassword" class="form-control tooltips" name="txtNewPassword" placeholder="New Password" title="Enter New Password"></input>
				</div>
				<br/><br/>
			</div>
			
			
			<div class="form-group">
				<label for="" class="col-lg-5 control-label"><i style="color:red;font-size:15px;">*</i> Confirm Password</label>
				<div class="col-lg-7">
					<input type="password" id="txtConfirmPassword" class="form-control tooltips" name="txtConfirmPassword" placeholder="Confirm Password" title="Enter Confirm Password"></input>
				</div>
				<br/><br/>
			</div>
			<div style="color: red;">
				
			</div>
		
	    </div>
	    <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-danger" id="btnChangePassword" name= "btnChangePassword" >Change Password</button>
	    </div>
	</form>
    </div>
  </div>
</div>
<div id="exampleModal" class="modal fade" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <br />
      </div>
      <div class="modal-body">
        <div id="dataPreview"></div>
      </div>
      <div class="modal-footer">
      	<!--<button type="button" class="btn btn-warning" id="btnEdit" name="btnEdit" onclick="edit_template('<?php echo $file_name; ?>')">Edit</button>-->
      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
	<div class="modal fade" id="FAQ_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width: 50%;min-width: 58%; margin-top: 10%;">
    	<div class="modal-content" style="background-size: 211% !important; background:url(<?php echo base_url(); ?>public/photos/rink_background.jpg)">
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
									<p style="font-weight: 600;">Que: <?=$question?></p>
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
<div class="modal fade" id="instuction_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top: 100px;">
		<div class="modal-dialog" style="width: 60%;" >
	    	<div class="modal-content" style="margin-top: -80px">
					<div class="modal-header">
							<button type="button" class="close"  style="" data-dismiss="modal" aria-hidden="true">
								&times;
							</button>
						<h3 style="text-align: center; color: black;"><b>Instruction For One Time Registration(New User)</b></h3>
					</div>
	      		<div class="modal-body" style="min-height: 430px;" >
		      		<div class="col-sm-12">
			      			<form  action="" method="post" id="instuction_frm" name="instuction_frm" >
			      			<input type="hidden" id="hidadmcodeval" name="hidadmcodeval" />
			      				<div id="geninfo" class="form-group">
			      				
			      					<!--<ul class="body-txt" type="1">
			      						<li>Click on ‘Proceed’ button for new One Time Registration (OTR).</li>
			      						<li>Carefully fill your correct personal details, present and permanent address.</li>
			      						<li>In login details section first create you Password for new OTR.</li>
			      						<li>After filling all the required information click ‘Save & Next’ button to save the information.</li>
			      						<li>OTP will be sent to your registered mobile number and e-mail id.</li>
			      						<li>Enter OTP number and click ‘Save’ to proceed to next section.</li>
			      						<li>Enter your correct academic qualification and work experience details (if any) and click ‘Save & Next’ button.</li>
			      						<li>Fill the information details and click ‘Next’.</li>
			      						<li>Check the Declaration and click ‘Save’.</li>
			      						<li>In document section upload all necessary documents (please check instruction for OTR for size of photo, signature & documents).</li>
			      						<li>Click ‘Save & Next’ after uploading the documents to complete the One Time Registration.</li>
			      						<li>A confirmation message will be displayed on your screen and a message will be sent to your registered mobile number and e-mail id. </li>
			      						<li>Click ‘OK’ to complete your One Time Registration (OTR).</li>
			      					</ul>-->
			      				</div>
			      				 <div class="form-group">
									<div class="col-sm-12 declarationletter" align="justify">
										<input type="checkbox" name="chkUndertaking1[]" id="chkUndertaking1[]" value="1">
										<b>I hereby declare that I have read and understood the above instructions carefully and 
										I accept all the terms and conditions mentioned hereinabove. 
										I also declare that I meet the eligibility conditions (Education, Experience etc.) stipulated in the detailed advertisement.</b><br \>
									</div>
								</div>
			      			</form>
						<!--</div>-->
					</div> 
				</div>
				<div class="modal-footer"><!--(base_url+'apply/'+obj.file+'/ins/'+obj.ins+'/edit/1')-->
			      	<!--<a href="<?php echo base_url(); ?>apply/<?php echo $program['template_code'] ?>/ins/RECINS001"><button type="button" class="btn btn-success center-block" id="btnProceed" name="btnProceed">Proceed</button></a>-->
			      	
			      	<center>
			      		<table>
			      		<tr>
			      			<td style="padding: 10px;">
			      				<button type="button" class="btn btn-danger center-block" id="btnReject" name="btnReject">Reject</button>
			      			</td>
			      			<td>
			      				<button  type="button" class="btn btn-success center-block" id="btnProceed" name="btnProceed">Accept</button>
			      			</td>
			      		</tr>
			      	</table>
			      	</center>
			      	
			      	
			      	
			      	
			      	
			      </div>
			</div>
		</div>
	</div>
	<!--<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>-->
			<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>public/assets/js/md5_5034.js"></script>
		<script src="<?php echo base_url(); ?>public/assets/js/profile_sha.js"></script>
		<script src="<?php echo base_url(); ?>public/assets/js/sha512.js"></script>
	<script type="text/javascript">
	var reg_user_id = '<?=$reg_user_id?>';
	var institute_code = '<?=$institute_code?>';
		//$('#collapse1').collapse("hide");
		//alert($("#hidProgColl").val());
		var collapse = "#collapse_"+$("#hidProgColl").val();
		//$("#collapse_"+$("#hidProgColl").val()).collapse("show");
		/*TO DISABLE BROWSER BACK BUTTON IN THIS PARTICULAR PAGE START */
		history.pushState(null, null, document.URL);
		window.addEventListener('popstate', function () {
		    history.pushState(null, null, document.URL);
		});
		/*TO DISABLE BROWSER BACK BUTTON IN THIS PARTICULAR PAGE END */
		function closeModal()
		{
			$("#myModalResult").hide();
		}
		/*function closeinfo()
		{
			$("#instuction_modal").hide();
		}*/
		$("#btnReject").click(function()
		{
			//$('#frmApply').data('bootstrapValidator').resetForm(true);
	  		$('#instuction_modal').modal('hide');
		});
		
		
		function openForm(program_code)
		{
			window.location.href=(base_url+'apply/apply_upload/ins/<?=$institute?>/admcode/'+program_code);		
		}
		function instuction_steps(admcode,i)
	   	{	 
	   		$('#hidadmcodeval').val(admcode);
	   		
	   		$.ajax({
				url:base_url+"ajax_controller/gen_info",
				type:"post",
				data:{'admcode':admcode},
				success:function(response){ 
					var obj = JSON.parse(response);
					//console.log('obj',obj.length);
					if(obj.length > 0)
					{
						if(obj[0]['general_info'] != undefined && obj[0]['general_info'] != '')
						{
							$('#geninfo').html(obj[0]['general_info']);	
							$('#instuction_modal').modal('show');
						}
						else
						{
							toastr.error("We are unable to Process.Please contact Support");
						}
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
	   		//window.location.href=(base_url+'apply/apply_upload/ins/<?=$institute?>/admcode/'+program_code);
			
			
				
		}
		$('#btnProceed').click(function(){
			if($('input[name="chkUndertaking1[]"]:checked').length > 0){
			navigate($('#hidadmcodeval').val());
			}
			else
			{
				toastr.error("Kindly read the declaration and check the checkbox for apply the post");
			}
		})
		function navigate(admcode,edit = null)
		{ 
			$.ajax({
				url:base_url+"ajax_controller/temp_config",
				type:"post",
				data:{'admcode':admcode},
				success:function(response){ 
					var obj = JSON.parse(response);
					console.log('apply/'+obj.file+'/ins/'+obj.ins);
					if(edit != null)
					{
						window.location.href=(base_url+'apply/'+obj.file+'/ins/'+obj.ins+'/edit/1');	
					}
					else
					{
						window.location.href=(base_url+'apply/'+obj.file+'/ins/'+obj.ins);
					}
						
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support"); 
				}
			});
		}
		function faq_page(){
			$('#FAQ_modal').modal('show');
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
		//alert(institutedata.program);
			$.ajax({
				url:base_url+"/ajax_controller/get_file_name",
				type:"post",
				data:institutedata,
				success:function(response)
				{  
					var res1 = JSON.parse(response);
					$.each(res1.aaData,function(i,data)
					{
						var temp_name = data.file_name+"_pdf";
						//window.open(base_url+"mpdf_controller/template008_pdf/reg_user_id/"+data.file_name+"/program/"+program);
						
						var strWindowFeatures = "location=yes,height=825,width=1500,scrollbars=yes,status=yes";
						var prog = admcode.replace("/", "`");
						//var URL = base_url+'mpdf_controller/template009_pdf/program/'+admcode ;
						var URL = base_url+"mpdf_controller/"+temp_name+"/reg_user_id/"+data.file_name+"/program/"+prog ;
						
						window.open(URL, "_blank", strWindowFeatures);
						
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
		function printAdmitCard(tempCode,exam_centre_code,exam_venue,program_code,dob,is_reserved_quota,category,gender)
		{
			var prog = program_code.replace("/", "`");
			$.ajax({
				url:base_url+"ajax_controller/get_document_path",
				type:"post",
				data:{'admcode':program_code},
				success:function(response){ 
					var obj = JSON.parse(response); 
					var photo = obj.photo;
					var signature = obj.signature;
					 if(dob == '' || /*is_reserved_quota == '' ||*/ category == '' || gender == '' || photo == '' || signature == '' )
		            {
						swal({
						title: "Update Your Details",
						text: "Please update your details for downloading admit card.",
						type: "warning",
					  	showCancelButton: false
						},
						function(isConfirm) {
						  if (isConfirm) {
						  	//alert(base_url+'apply/fillup_missing_data/ins/<?=$institute?>/admcode/'+prog);
						  	//window.location.href = ("<?php echo base_url() ?>Index/applicant_logout/ins/<?=$institute_code?>");
						  	window.location.href=(base_url+'apply/fillup_missing_data/ins/<?=$institute?>/admcode/'+prog);
						  } 
						});
					}
					else{
						
						var code = "admit_card_"+tempCode;
						var exam_venue_code = exam_venue.replace('/', '_');
						var strWindowFeatures = "location=yes,height=825,width=1500,scrollbars=yes,status=yes";
						var URL = base_url+'apply/'+code+'/'+exam_centre_code+'/'+exam_venue_code+'/'+prog;
						window.open(URL, "_blank", strWindowFeatures);
					}
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support"); 
				}
			});	
			
			
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
		
		function preview(pro_code){
			var institutedata=
			{
				pro_code:pro_code,
				hidInsCode : $("#hidInsCode").val()
			};	
			$.ajax({
				url:base_url+"/ajax_controller/get_program_modal_data",
				type:"post",
				data : institutedata,
				success:function(response){  
					var res = JSON.parse(response);
					$('#exampleModal').modal('show');
					$("#dataPreview").html(res.html);
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
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
		$("#ChangePassword").click(function()
		{
			//$('#frmApply').data('bootstrapValidator').resetForm(true);
	  		$('#ChangePasswordModal').modal('show');
		});
		$('#frmApply').bootstrapValidator({
		message: 'This value is not valid',
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			md5KeyValue = "<?php echo $this->session->userdata('key');?>";
			if($("#txtoldPassword").val() == '')
			{
				toastr.error("Please enter Old Password");
				return false;
			} 
			else if($("#txtNewPassword").val() == '' || $("#txtConfirmPassword").val() == '')
			{
				toastr.error("Please enter Password and Confirm Password");
				return false;
			}
			//added for CR 5034 - begin.
			var username ="abcd@abcd";
			username = document.frmApply.user_name.value;	
			
			var oldpassword = document.frmApply.txtoldPassword.value;
			var regexp = new RegExp("\\d{19}");	
			var newpassword = document.frmApply.txtNewPassword.value;
			var regexp = new RegExp("\\d{19}");
			var confirmpassword = document.frmApply.txtConfirmPassword.value;
			var regexp = new RegExp("\\d{19}");
			
	        var md5keystring = md5KeyValue;//document.quickLookForm.md5key.value ;

			var encSaltPassOld = encryptLoginPassword(md5keystring,username,oldpassword);
			var encSaltSHAPassOld = encryptSha2LoginPassword(md5keystring,username,oldpassword);
			
			var encSaltPassNew = encryptLoginPassword(md5keystring,username,newpassword);
			var encSaltSHAPassNew = encryptSha2LoginPassword(md5keystring,username,newpassword);
			var encSaltSHAPassNewOne = encryptSha2ChangePassword(md5keystring,username,newpassword);
			
			var encSaltPassConfirm = encryptLoginPassword(md5keystring,username,confirmpassword);
			var encSaltSHAPassConfirm = encryptSha2LoginPassword(md5keystring,username,confirmpassword);
			//alert(username);
			document.frmApply.txtoldPassword.value = encSaltPassOld; //changed
			document.frmApply.shapasswordOld.value = encSaltSHAPassOld; //changed
			
			document.frmApply.txtNewPassword.value = encSaltPassNew; //changed
			document.frmApply.shapasswordNew.value = encSaltSHAPassNew; //changed
			document.frmApply.shapasswordNewOne.value = encSaltSHAPassNewOne; //changed
			
			document.frmApply.txtConfirmPassword.value = encSaltPassConfirm; //changed
			document.frmApply.shapasswordConfirm.value = encSaltSHAPassConfirm; //changed
			//alert(document.frmApply.txtConfirmPassword.value);
			
			var formData = new FormData(document.getElementById("frmApply"));
			//ajax call to server
			$.ajax({
				url:base_url+"ajax_controller/change_applicant_password",
				type:"post",
				data:formData,
				cache: false,
		        contentType: false,
		        processData: false,
				success:function(response)
				{  
					var result = jQuery.parseJSON(response);
		            if(result.status)
		            {
						swal({
						title: "Change Password",
						text: "Congratulation!!! Password has been changed successfully.",
						type: "success"
						},
						function(isConfirm) {
						  if (isConfirm) {
						  	
						  	//window.location.href = ("<?php echo base_url() ?>Index/applicant_logout/ins/<?=$institute_code?>");
						  	window.location.href=(base_url+'Index/applicant_logout/ins/'+institute_code);
						  } 
						});
					}
					else
					{
						swal({
						title: "Change Password",
						text: result.msg,
						type: "error"
						},
						function(isConfirm) {
						  if (isConfirm) {
						  	$("#txtoldPassword").val('');
						  	$("#txtNewPassword").val('');
						  	$("#txtConfirmPassword").val('');
						  	$('#frmApply').data('bootstrapValidator').resetForm(true);
						  }
						});
					}
					
					
				},
				error:function()
				{
					toastr.error('Unable to Save.Please Try Again ');	
				}
			});
		},
		fields: {	
				txtoldPassword: {
						validators: {
							notEmpty: {
								message: 'This field can\'t left blank'
							}
						}
					},
				txtNewPassword: {
					validators: {
						notEmpty: {
							message: 'This field can\'t left blank'
						},
                		regexp: {
							regexp: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[$@!%?&]).{6,12}$/,
							message: "The password should contain Minimum 6 and Maximum 12 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character"
						}
					}
				},
				txtConfirmPassword: {
					validators: {
						notEmpty: {
							message: 'This field can\'t left blank'
						},
						regexp: {
							regexp: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[$@!%?&]).{6,12}$/,
							message: "The password should contain Minimum 6 and Maximum 12 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character"
						},
						identical: {
		                    field: 'txtNewPassword',
		                    message: 'New password and its confirm are not the same'
	                	}
					}
				}	
			}
	} );
	</script>
	
