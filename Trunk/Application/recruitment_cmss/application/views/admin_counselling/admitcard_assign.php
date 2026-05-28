
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12 page-header">
				<h3>Admit card - Center Allocation</h3>
			</div>
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
												<label for="" class="control-label" style="text-align:left;">Applied Exam Center:</label>
											</div>
											<div class="col-md-4">
												<select class="form-control" name="cmbExamCenter" id="cmbExamCenter">
												</select>
											</div>
										</div>
										</div><!-- end row -->
										<div class="row">
										<div class="form-group">
											<div class="col-md-3">
												<label for="" class="control-label" style="text-align:left;">Applied Upto:</label>
											</div>
											<div class="col-md-4">
												<input type="text" id="txtApplDate" name="txtApplDate" class="form-control" readonly=""/>
											</div>
										</div>
										</div><!-- end row -->
										<div class="row">
										<div class="form-group">
											<div class="col-md-2">
												
											</div>
											<div class="col-md-3">
												<button class="btn btn-info" value="Show" type="button" id="btnShow" name="btnShow"><i class="fa fa-eye" aria-hidden="true">&nbsp;&nbsp;Show Applicants</i></button>
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
	<link href="<?php echo base_url(); ?>public/css/datepicker3.css" rel="stylesheet" />
	<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/admitcard_assign.js"></script>
	    