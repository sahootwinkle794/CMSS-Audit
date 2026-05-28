
			<div class="content-wrapper">
				<div class="row">
					<!--<div class="col-lg-12 page-header">
						<h3>Admit card - Report</h3>
					</div>-->
					<section class="content-header">
				      	<h1>
				        	Admit card - Report
				      	</h1>
				    </section>
					<!-- Main content -->
			        <section class="content">
						<div class="row">
							<div class="col-lg-12" style="padding-top:0px;">
								<div class="panel panel-default">	
									<div class="panel-body box box-default">
										<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
											<form class="form-horizontal" method="post" role="form" id="frmAdmitCard" name="frmAdmitCard" enctype="multipart/form-data">
												<input type="hidden" id="hidAction" name="hidAction"/>
												<div class="row">
													<div class="form-group">
														<div class="col-md-3">
															<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:15px;">*</i> Recruitment Drive:</label>
														</div>
														<div class="col-md-4">
															<select class="form-control" name="cmbProgramGroup" id="cmbProgramGroup">
																<option value=''>Select Recruitment Drive</option>
															<?php 
															foreach($all_program_groups as $row)
															{
															?>		 
																<option value='<?=$row['program_group_name']?>'><?=$row['program_group_name']?></option>
													    <?php } ?>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
												<div class="form-group">
													<div class="col-md-3">
														<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:15px;">*</i> Post:</label>
													</div>
													<div class="col-md-4">
														<select class="form-control" name="cmbProgram" id="cmbProgram">
															
														</select>
													</div>
													<div class="col-md-2"><span id="spanProcessingProgram" style="display: none"><img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span></div>
												</div>
												</div><!-- end row -->
												<!--<div class="row">
												<div class="form-group">
													<div class="col-md-3">
														<label for="" class="control-label" style="text-align:left;">Course:</label>
													</div>
													<div class="col-md-4">
														<select class="form-control" name="cmbCourse" id="cmbCourse">
														</select>
														
													</div>
													<div class="col-md-2"><span id="spanProcessingExam" style="display: none"><img src="../images/bx_loader.gif" /></span></div>
												</div>
												</div>--><!-- end row -->
												<div class="row">
												<div class="form-group">
													<div class="col-md-3">
														<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:15px;">*</i> Assigned Exam Center:</label>
													</div>
													<div class="col-md-4">
														<select class="form-control" name="cmbExamCenter" id="cmbExamCenter">
														</select>
														
													</div>
													<div class="col-md-2"><span id="spanProcessingExam" style="display: none"><img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span></div>
												</div>
												</div><!-- end row -->
												<div class="row">
													<div class="form-group">
														<div class="col-md-3">
															<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:15px;">*</i> Round:</label>
														</div>
														<div class="col-md-4">
															<select class="form-control" name="cmbRound" id="cmbRound">
																<!--<option value="">Select</option>
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>-->
															</select>
														</div>
													</div>
												</div>
												<div class="row">
												<div class="form-group">
													<div class="col-md-3">
														<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:15px;">*</i> Assigned Exam Venue:</label>
													</div>
													<div class="col-md-4">
														<select class="form-control" name="cmbExamVanue" id="cmbExamVanue">
														</select>
													</div>
												</div>
												</div>
												<div class="row">
												<div class="form-group">
													<div class="col-md-2">
														
													</div>
													<div class="col-md-3">
														<button type="button" class="btn btn-info" value="Show" type="button" id="btnShow" name="btnShow"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;Show Assigned Applicants</button>
													</div>
												</div>
												</div><!-- end row -->
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
			        </section><!-- /.content -->
				</div>
			</div>	
	    	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/admitcard_report.js"></script>