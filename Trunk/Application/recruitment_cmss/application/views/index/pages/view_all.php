 <?php 
 date_default_timezone_set('Asia/Kolkata');
 
 $now = date('Y-m-d H:i:s', now());
	$logo = '';
	$inscode = '';
	$ins = '';
	$program_data1[0] = $program_data;
	$insname = '';
	$institute_code = $this->uri->segment(3);
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
		float: left;
		left: 127px;
		top: 360px;

		font-family: Exo 2;
		font-style: normal;
		font-weight: bold;
		font-size: 25px;
		line-height: 36px;
		color: white;
		/*background-image: linear-gradient(to right, #e62222, #e62222, #ef6d35, #ef6d35, #ef6d35);
	    -webkit-background-clip: text;
	    -webkit-text-fill-color: transparent;*/
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
	.header {
	    position: absolute;
		width: 1094px;
    	height: 212px;
		left: 122px;
		top: 124px;
		border: 1.2px solid #13434D;
		box-sizing: border-box;
		filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));
		border-radius: 21px;
		background-color: #0e0e0ef5;
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
	.tbledesgn{
		background: white;
		margin-bottom: 40px;
	}
	.cal{
		position: absolute;
		left: 8.33%;
		right: 8.33%;
		top: 8.33%;
		bottom: 8.33%;
	}
	.advt{
		margin-right: 17px;
		margin-bottom: 1px;
	}
	.divtbl{
		padding: 0%;
	}
	@media (min-width: 377px) and (max-width: 415px){
		.divtbl{
			top: -42px;
		}
	}
	@media (min-width: 200px) and (max-width: 376px){
		.divtbl{
			top: -42px;
		}	
	}	
</style>
<link href="<?php echo base_url(); ?>public/assets/css/style.css" rel="stylesheet" /> 
<link href="<?php echo base_url(); ?>public/assets/css/text-scroll.css" rel="stylesheet" /> 

<section class="sec">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
			<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10 divtbl">

				<div class="row" style="text-align: center;">
					<!-- <div>
						<span class="notice"><b>Recruitment Notifications</b></span>
					</div>
					<hr style="border-color: #13434D;"> -->

					<div class="nav-tabs-custom box box-default" style="width: 100%;">
						<ul class="nav nav-tabs" role="tablist">
							<li id ="new_tab" class="active"><a href="#new" data-toggle='tab'>Current</a></li>
							<li id ="old_tab"><a href="#old" data-toggle='tab'>Previous / Archived</a></li>
						</ul>
						<div class="tab-content">
							<div class="chart tab-pane in active" id="new">
								<div class="table-responsive mt-3">
									<table class="table table-striped table-bordered tbledesgn" width="100%">
										<thead>
											<tr>
												<td style="text-align: center;">Sl No</td>
												<td style="text-align: center;">Advt.No</td>
												<td style="text-align: center;">Post Name</td>
												<td style="text-align: center;">Start Date</td>
												<td style="text-align: center;">Closing Date</td>
												<td style="text-align: center;">Important Notice</td>
												<td style="text-align: center;">Status</td>
											</tr>
										</thead>
										<tbody>
											<?php
											$i = 1;
											if (sizeof($program_data) != 0) {
												foreach ($program_data as $program) {
													$status = (strtotime($program['action1_post_start_date']) > strtotime($now))
														? 'Not Started'
														: ((strtotime($program['action1_post_end_date']) < strtotime($now)) ? 'Closed' : 'Open');

													if ($status == 'Closed') continue; // skip closed ones here

													$corrigendum_name = isset($program['corrigendum_name']) ? $program['corrigendum_name'] : '';
													$corrigendum_path = isset($program['corrigendum_path']) ? $program['corrigendum_path'] : '';
													$a = strpos($corrigendum_name, "@");
													$b = strpos($corrigendum_path, "@");

													if ($a) $corrigendum_name_array = explode('@', $corrigendum_name);
													if ($b) $corrigendum_path_array = explode('@', $corrigendum_path);
											?>
													<tr>
														<td style="text-align: center;"><?php echo $i; ?></td>

														<!-- ✅ Advt File -->
														<td style="text-align: center;">
															<?php
															$file_path = $program['advt_path'];
															$file_ext = pathinfo($file_path, PATHINFO_EXTENSION);
															$file_icon = '';
															switch (strtolower($file_ext)) {
																case 'pdf': $file_icon = '<i class="fa fa-file-pdf-o" style="color:red"></i>'; break;
																case 'doc':
																case 'docx': $file_icon = '<i class="fa fa-file-word-o" style="color:#2B579A"></i>'; break;
																case 'xls':
																case 'xlsx': $file_icon = '<i class="fa fa-file-excel-o" style="color:green"></i>'; break;
																default: $file_icon = '<i class="fa fa-file-o"></i>';
															}

															$file_size = '';
															$local_path = $_SERVER['DOCUMENT_ROOT'] . parse_url($file_path, PHP_URL_PATH);
															if (file_exists($local_path)) {
																$bytes = filesize($local_path);
																$file_size = round($bytes / 1048576, 2) . ' MB';
															}
															?>
															<a target="_blank" class="btn btn-primary" href="<?php echo $file_path ?>">
																<?php echo $file_icon . ' ' . $program['advt_no']; ?>
															</a><br>
															<small>(<?php echo strtoupper($file_ext) . ($file_size ? ', ' . $file_size : ''); ?>)</small>
														</td>

														<td style="text-align: center;"><?php echo $program['program_name']; ?></td>
														<td style="text-align: center;"><?php echo date('d-m-Y', strtotime($program['apply_start_date'])); ?></td>
														<td style="text-align: center;"><?php echo date('d-m-Y', strtotime($program['apply_end_date'])); ?></td>

														<!-- ✅ Important Notice -->
														<td style="text-align: center;">
															<?php
															if ($a) {
																for ($j = 0; $j < sizeof($corrigendum_name_array); $j++) {
																	$corr_name = $corrigendum_name_array[$j];
																	$corr_path = $corrigendum_path_array[$j];
																	$corr_ext = pathinfo($corr_path, PATHINFO_EXTENSION);
																	$corr_icon = (strtolower($corr_ext) == 'pdf') ? '<i class="fa fa-file-pdf-o" style="color:red"></i>' : '<i class="fa fa-file-o"></i>';

																	$corr_size = '';
																	$local_corr = $_SERVER['DOCUMENT_ROOT'] . parse_url($corr_path, PHP_URL_PATH);
																	if (file_exists($local_corr)) {
																		$bytes = filesize($local_corr);
																		$corr_size = round($bytes / 1048576, 2) . ' MB';
																	}
																	echo '<a target="_blank" class="btn btn-primary" href="' . $corr_path . '">' . $corr_icon . ' ' . $corr_name . '</a><br>';
																	echo '<small>(' . strtoupper($corr_ext) . ($corr_size ? ', ' . $corr_size : '') . ')</small><br>';
																}
															} elseif ($corrigendum_name != '') {
																$corr_ext = pathinfo($corrigendum_path, PATHINFO_EXTENSION);
																$corr_icon = ($corr_ext == 'pdf') ? '<i class="fa fa-file-pdf-o" style="color:red"></i>' : '<i class="fa fa-file-o"></i>';
																echo '<a target="_blank" class="btn btn-primary" href="' . $corrigendum_path . '">' . $corr_icon . ' ' . $corrigendum_name . '</a><br>';
															} else {
																echo '-';
															}
															?>
														</td>

														<td style="text-align: center;"><?php echo $status; ?></td>
													</tr>
											<?php
													$i++;
												}
											} else {
												echo '<tr><td colspan="7" style="text-align:center;">No Current Openings</td></tr>';
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="chart tab-pane" id="old"> 
								<div class="table-responsive mt-3">
									<table class="table table-striped table-bordered tbledesgn" width="100%">
										<thead>
											<tr>
												<td style="text-align: center;">Sl No</td>
												<td style="text-align: center;">Advt.No</td>
												<td style="text-align: center;">Post Name</td>
												<td style="text-align: center;">Start Date</td>
												<td style="text-align: center;">Closing Date</td>
												<td style="text-align: center;">Important Notice</td>
												<td style="text-align: center;">Status</td>
											</tr>
										</thead>
										<tbody>
											<?php
											$j = 1;
											foreach ($program_data as $program) {
												$status = (strtotime($program['action1_post_start_date']) > strtotime($now))
													? 'Not Started'
													: ((strtotime($program['action1_post_end_date']) < strtotime($now)) ? 'Closed' : 'Open');

												if ($status != 'Closed') continue; // only closed ones here

												$corrigendum_name = isset($program['corrigendum_name']) ? $program['corrigendum_name'] : '';
												$corrigendum_path = isset($program['corrigendum_path']) ? $program['corrigendum_path'] : '';
												$a = strpos($corrigendum_name, "@");
												$b = strpos($corrigendum_path, "@");

												if ($a) $corrigendum_name_array = explode('@', $corrigendum_name);
												if ($b) $corrigendum_path_array = explode('@', $corrigendum_path);
											?>
												<tr>
													<td style="text-align: center;"><?php echo $j++; ?></td>
													<!-- <td style="text-align: center;"><?php echo $program['advt_no']; ?></td> -->
													<td style="text-align: center;">
														<?php
														$file_path = $program['advt_path'];
														$file_ext = pathinfo($file_path, PATHINFO_EXTENSION);
														$file_icon = '';
														switch (strtolower($file_ext)) {
															case 'pdf': $file_icon = '<i class="fa fa-file-pdf-o" style="color:red"></i>'; break;
															case 'doc':
															case 'docx': $file_icon = '<i class="fa fa-file-word-o" style="color:#2B579A"></i>'; break;
															case 'xls':
															case 'xlsx': $file_icon = '<i class="fa fa-file-excel-o" style="color:green"></i>'; break;
															default: $file_icon = '<i class="fa fa-file-o"></i>';
														}

														$file_size = '';
														$local_path = $_SERVER['DOCUMENT_ROOT'] . parse_url($file_path, PHP_URL_PATH);
														if (file_exists($local_path)) {
															$bytes = filesize($local_path);
															$file_size = round($bytes / 1048576, 2) . ' MB';
														}
														?>
														<a target="_blank" class="btn btn-primary" href="<?php echo $file_path ?>">
															<?php echo $file_icon . ' ' . $program['advt_no']; ?>
														</a><br>
														<small>(<?php echo strtoupper($file_ext) . ($file_size ? ', ' . $file_size : ''); ?>)</small>
													</td>
													<td style="text-align: center;"><?php echo $program['program_name']; ?></td>
													<td style="text-align: center;"><?php echo date('d-m-Y', strtotime($program['apply_start_date'])); ?></td>
													<td style="text-align: center;"><?php echo date('d-m-Y', strtotime($program['apply_end_date'])); ?></td>
													<!-- <td style="text-align: center;"><?php echo ($corrigendum_name != '') ? $corrigendum_name : '-'; ?></td> -->
													<td style="text-align: center;">
														<?php
														if ($a) {
															for ($j = 0; $j < sizeof($corrigendum_name_array); $j++) {
																$corr_name = $corrigendum_name_array[$j];
																$corr_path = $corrigendum_path_array[$j];
																$corr_ext = pathinfo($corr_path, PATHINFO_EXTENSION);
																$corr_icon = (strtolower($corr_ext) == 'pdf') ? '<i class="fa fa-file-pdf-o" style="color:red"></i>' : '<i class="fa fa-file-o"></i>';

																$corr_size = '';
																$local_corr = $_SERVER['DOCUMENT_ROOT'] . parse_url($corr_path, PHP_URL_PATH);
																if (file_exists($local_corr)) {
																	$bytes = filesize($local_corr);
																	$corr_size = round($bytes / 1048576, 2) . ' MB';
																}
																echo '<a target="_blank" class="btn btn-primary" href="' . $corr_path . '">' . $corr_icon . ' ' . $corr_name . '</a><br>';
																echo '<small>(' . strtoupper($corr_ext) . ($corr_size ? ', ' . $corr_size : '') . ')</small><br>';
															}
														} elseif ($corrigendum_name != '') {
															$corr_ext = pathinfo($corrigendum_path, PATHINFO_EXTENSION);
															$corr_icon = ($corr_ext == 'pdf') ? '<i class="fa fa-file-pdf-o" style="color:red"></i>' : '<i class="fa fa-file-o"></i>';
															echo '<a target="_blank" class="btn btn-primary" href="' . $corrigendum_path . '">' . $corr_icon . ' ' . $corrigendum_name . '</a><br>';
														} else {
															echo '-';
														}
														?>
													</td>
													<td style="text-align: center;"><?php echo $status; ?></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					
				</div> <!-- row -->
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>


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
	// $(window).scroll(function(){
	// 	var sticky = $('.header_section'),
	// 	scroll = $(window).scrollTop();

	// 	if (scroll >= 100) 
	// 		sticky.addClass('fixed');
	// 	else 
	// 		sticky.removeClass('fixed');
	// });
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
	function reformatDate(datetimeStr)
	{
		dateStr = datetimeStr.split(" ")[0];
	  dArr = dateStr.split("-");  // ex input "2010-01-18"
	  return dArr[2]+ "/" +dArr[1]+ "/" +dArr[0]; //ex out: "18/01/10"
	}
</script>