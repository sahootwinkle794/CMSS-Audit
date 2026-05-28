
	<div class="content-wrapper">
		<div class="row">
			<!--<div class="col-lg-12 page-header">
				<h3>Admit card - Center Allocation</h3>
			</div>-->
			<section class="content-header">
		      	<h1>
		        	Admit card - Center Allocation
		      	</h1>
		    </section>
			<section class="content">
				<div class="row">
					<div class="col-lg-12" style="padding-top:0px;">
						<div class="nav-tabs-custom box box-default">
							<ul class="nav nav-tabs" role="tablist">
								<li id ="new_tab" class="active"><a href="#menual" data-toggle='tab'>Manual Assign</a></li>
								<!--<li id ="old_tab"><a href="#automatic" data-toggle='tab'>Automatic Assign</a></li>-->
							</ul>
							<div class="tab-content">
								<div class="chart tab-pane in active" id="menual">								
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
													<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:15px;">*</i> Applied Exam Center:</label>
												</div>
												<div class="col-md-4">
													<select class="form-control" name="cmbExamCenter" id="cmbExamCenter">
													</select>
												</div>
											</div>
											</div>--><!-- end row -->
											
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
											</div><!-- end row -->
											<div class="row">
											<!--<div class="form-group">
												<div class="col-md-3">
													<label for="" class="control-label" style="text-align:left;">Course:</label>
												</div>
												<div class="col-md-4">
													<select class="form-control" name="cmbCourse" id="cmbCourse">
													</select>
												</div>
											</div>-->
											</div><!-- end row -->
											<div class="row">
											<div class="form-group">
												<div class="col-md-3">
													<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:15px;">*</i> Applied Upto:</label>
												</div>
												<div class="col-md-4">
													<input type="text" id="txtApplDate" name="txtApplDate" class="form-control" readonly=""/>
												</div>
											</div>
											</div><!-- end row -->
											<div class="row">
											<div class="form-group">
												<!--<div class="col-md-2">
													<button class="btn btn-info" value="Show" type="button" id="btnShowAppl" name="btnShowAppl"><i class="fa fa-eye" aria-hidden="true">&nbsp;&nbsp;Show Applicants</i></button>
												</div>-->
												<div class="col-md-3">
													<button class="btn btn-success" value="Show" type="button" id="btnShow" name="btnShow"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;Assign Applicants</button>
												</div>
											</div>
											</div><!-- end row -->
										</form>
										<div class="col-lg-12" id="tblReport">
											<div class="col-lg-8">
												<table class="table table-striped table-bordered"  id="tblReportMaster" width="100%">
													<thead>
														<tr>
															<th >#</th>
															<th >Exam Venue</th>
															<th >Assigned Students</th>
															<th >Published Students</th>
														</tr>
													</thead>
													<tbody>

													</tbody>
												</table>
											</div>
											
											<div class="col-lg-4">
												<table class="table table-striped table-bordered"  id="tblConsReportMaster" width="100%">
													<thead>
														<tr>
															<th >#</th>
															<th >No. of not assigned students</th>
														</tr>
													</thead>
													<tbody>

													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="chart tab-pane" id="automatic">
									<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
										<form class="form-horizontal" method="post" role="form" id="frmAdmitCardAutomatic" name="frmAdmitCardAutomatic">
											<div class="row">
												<div class="form-group">
													<div class="col-md-3">
														<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:15px;">*</i> Recruitment Drive:</label>
													</div>
													<div class="col-md-4">
														<select class="form-control" name="cmbAutoProgramGroup" id="cmbAutoProgramGroup">
															<option value=''>Select Recruitment Drive</option>
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
													<select class="form-control" name="cmbAutoProgram" id="cmbAutoProgram">
														
													</select>
												</div>												
											</div>
											</div><!-- end row -->
											
											<div class="row">
											<div class="form-group">
												<div class="col-md-3">
													<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:15px;">*</i> Round:</label>
												</div>
												<div class="col-md-4">
													<select class="form-control" name="cmbAutoRound" id="cmbAutoRound">
													</select>
												</div>
											</div>
											</div><!-- end row -->
											<div class="row">
											<div class="form-group">
												<div class="col-md-3">
													<label for="" class="control-label" style="text-align:left;"><i style="color:red;font-size:15px;">*</i> Applied Upto:</label>
												</div>
												<div class="col-md-4">
													<input type="text" id="txtAutoApplDate" name="txtAutoApplDate" class="form-control" readonly=""/>
												</div>
											</div>
											</div><!-- end row -->
											<div class="row">
											<div class="form-group">
												<!--<div class="col-md-2">
													<button class="btn btn-info" value="Show" type="button" id="btnShowAppl" name="btnShowAppl"><i class="fa fa-eye" aria-hidden="true">&nbsp;&nbsp;Show Applicants</i></button>
												</div>-->
												<div class="col-md-3">
													<button class="btn btn-success" type="button" id="btnAutoAssign" name="btnAutoAssign"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;Assign Applicants</button>
												</div>
											</div>
											</div><!-- end row -->
										</form>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
	        </section><!-- /.content -->
		</div>
	</div>
	<link href="<?php echo base_url(); ?>public/css/datepicker3.css" rel="stylesheet" />
	<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/admin/admitcard_assign.js"></script>
	