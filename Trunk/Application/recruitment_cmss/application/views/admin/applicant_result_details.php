	<div id="page-wrapper">
				<div class="row">
					<form name="frmFilter" role="form" enctype="multipart/form-data" method="POST">
					<div class="col-lg-12">
						<h1 class="page-header">Applicant Councelling:</h1>
					</div>
					<div class="col-lg-12">
						<div class="panel with-nav-tabs panel-primary">
            				<div class="panel-heading">
								<ul class="nav nav-tabs" role="tablist">
									<li class="active"><a href="#tabMark" data-toggle='tab'>Mark Details</a></li>
									<li><a href="#tabResult" data-toggle='tab'>Selection Details</a></li>
								</ul>
							</div>
							<div class="panel-body">
           						<div class="tab-content">
									<div class="tab-pane in active" id="tabMark">
										<div class="col-lg-12 page-header">
											<label for="" class="col-sm-2 control-label">Program :</label>
											
											<div class="col-sm-3">
												<select class="form-control" id="cmbProgram" name="cmbProgram" >
													<option value="">SELECT</option>
													<?php
														foreach($all_programs as $row)
														{
															echo "<option value=\"".$row['program_code']."\">".$row['program_name']."</option>";
														}
													?>							
												</select>
											</div>
											<div class="col-sm-2 pull-right">
												<input type="button" class="btn btn-primary " value="Upload" name="btnUpload" id="btnUpload" />
											</div>
										</div>
										<div class="col-lg-12 col-sm-12 table-responsive" id="tableDiv" style="width:100%;" >
	            						    <table class="table table-bordered table-hover  table-responsive tablesorter" id="dtblMarkDetails">		            						   
		            						    		            					
	            					    	</table>
    									</div>
									</div>	
									<div class="tab-pane" id="tabResult">
										<div class="col-lg-12 page-header">
											<label for="" class="col-sm-2 control-label">Program :</label>
											
											<div class="col-sm-3">
												<select class="form-control"  name="cmbProgramResult" title="Select Program" id="cmbProgramResult">
													<option value="">SELECT</option>
													<?php
														foreach($all_programs as $row)
														{
															echo "<option value=\"".$row['program_code']."\">".$row['program_name']."</option>";
														}
													?>	
												</select>
											</div>
											<div class="col-sm-2 pull-right">
												<input type="button" class="btn btn-primary " value="Upload" name="btnUploadStatus" id="btnUploadStatus" />
											</div>
										</div>
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="dtblStatusDetails" width="100%">
												<thead>
													<tr>
														<th class="text-center">Applicant Id</th>
														<th class="text-center">Applicant Name</th>
														<th class="text-center">Application Status</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				</div><!-- /.row -->
			</div><!-- /#page-wrapper -->
			<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/applicant_result_details.js"></script>