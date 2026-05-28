
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12 page-header">
						<h3>Admit card - Report</h3>
					</div>
					<!-- Main content -->
			        <section class="content">
						<div class="row">
							<div class="col-lg-12" style="padding-top:0px;">
								<div class="panel panel-default">	
									<div class="panel-body">
										<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
											<form class="form-horizontal" method="post" role="form" id="frmAdmitCard" name="frmAdmitCard" enctype="multipart/form-data">
												<input type="hidden" id="hidAction" name="hidAction"/>
												<div class="row">
													<div class="form-group">
														<div class="col-md-3">
															<label for="" class="control-label" style="text-align:left;">Program Group:</label>
														</div>
														<div class="col-md-4">
															<select class="form-control" name="cmbProgramGroup" id="cmbProgramGroup">
																<option value=''>Select Program Group</option>
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
														<label for="" class="control-label" style="text-align:left;">Program:</label>
													</div>
													<div class="col-md-4">
														<select class="form-control" name="cmbProgram" id="cmbProgram">
															
														</select>
													</div>
													<div class="col-md-2"><span id="spanProcessingProgram" style="display: none"><img src="../images/bx_loader.gif" /></span></div>
												</div>
												</div><!-- end row -->
												<div class="row">
												<div class="form-group">
													<div class="col-md-3">
														<label for="" class="control-label" style="text-align:left;">Assigned Exam Center:</label>
													</div>
													<div class="col-md-4">
														<select class="form-control" name="cmbExamCenter" id="cmbExamCenter">
														</select>
														
													</div>
													<div class="col-md-2"><span id="spanProcessingExam" style="display: none"><img src="../images/bx_loader.gif" /></span></div>
												</div>
												</div><!-- end row -->
												<div class="row">
												<div class="form-group">
													<div class="col-md-3">
														<label for="" class="control-label" style="text-align:left;">Assigned Exam Venue:</label>
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
														<button type="button" class="btn btn-info" value="Show" type="button" id="btnShow" name="btnShow"><i class="fa fa-eye" aria-hidden="true">&nbsp;&nbsp;Show Assigned Applicants</i></button>
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