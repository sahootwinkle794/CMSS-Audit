<div id="page-wrapper">
	<div class="row">
		<br />
		<div class="col-lg-12">
			<div class="panel with-nav-tabs panel-primary">
			<div class="panel-heading">
					<ul class="nav nav-tabs" role="tablist">
						<li class="active"><a href="#assign" data-toggle='tab'>Assign Cat.</a></li>
						<li><a href="#view" data-toggle='tab'>Update Cat.</a></li>
						<!--<li><a href="#add_exam_centre" data-toggle='tab'>Add Exam Centre</a></li>
						<li><a href="#exam_centre" data-toggle='tab'>Update Exam Centre</a></li>-->
						<li><a href="#qualification_assign" data-toggle='tab'>Assign Qualification</a></li>
						<li><a href="#qualification_view" data-toggle='tab'>Update Qualification</a></li>
					</ul>
				</div>
				<div class="panel-body">
					<div class="tab-content">
						<div class="tab-pane in active" id="assign">
							<div class="col-lg-12 page-header">
								<label for="" class="col-sm-2 control-label">Program :</label>
								
								<div class="col-sm-4">
									<select class="form-control cmbProgramSelect"  name="cmbProgramSelect[]" title="Select Program" id="cmbProgramSelect" multiple="multiple">
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="dtblProgramCategory" width="100%">
									<thead>
										<tr>
											<th class="text-center">Sl No</th>
											<th class="text-center">Category Code</th>
											<th class="text-center">Category</th>
											<th class="text-center">
												<label class="control control--checkbox" style="margin-top: 5px;">  
													<input type="checkbox" id="chkCatAll" name="chkCatAll" value=""/>
													<div class="control__indicator"></div>
												</label>
											</th>
											<th hidden="hidden" class="text-center">ID</th><!-- id will be hide -->
										</tr>
									</thead>
								</table>
								<button type="button" class="btn btn-success " name="btnUpdateMultiple" id="btnUpdateMultiple" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>
							</div>
						</div>	
						<div class="tab-pane" id="view">
							<div class="col-lg-12 page-header">
								<label for="" class="col-sm-2 control-label">Program :</label>
								
								<div class="col-sm-4">
									<select class="form-control"  name="cmbProgramFilter" title="Select Program" id="cmbProgramFilter">
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="dtblProgramcategorySingle" width="100%">
									<thead>
										<tr>
											<th class="text-center">Sl No</th>
											<th class="text-center">Category Code</th>
											<th class="text-center">Category</th>
											<th class="text-center">
												<label class="control control--checkbox" style="margin-top: 5px;">  
													<input type="checkbox" id="chkCatUpdate" name="chkCatUpdate" value=""/>
													<div class="control__indicator"></div>
												</label>
											</th>
											<th hidden="hidden" class="text-center">ID</th><!-- id will be hide -->
										</tr>
									</thead>
								</table>
								<button type="button" class="btn btn-warning" name="btnUpdateSingle" id="btnUpdateSingle" /><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;Update</i></button>
							</div>
						</div>
						
						
						
						<div class="tab-pane" id="add_exam_centre">
							<div class="col-lg-12 page-header">
								<label for="" class="col-sm-2 control-label">Program:</label>
								<div class="col-sm-3">
									<select class="form-control cmbProgramMultiple"  name="cmbProgramMultiple[]" title="Select Program" id="cmbProgramMultiple" multiple="multiple">
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<table class="table table-striped table-bordered"  id="tblCenterAdd" width="100%">
									<thead>
										<tr>
											<th class="text-center">Sl No</th>
											<th class="text-center">Exam Center Code</th>
											<th class="text-center">Exam Center Name</th>
											<th class="text-center">
												<label class="control control--checkbox" style="margin-top: 5px;">  
													<input type="checkbox" id="chkAll" name="chkAll" value=""/>
													<div class="control__indicator"></div>
												</label></th>
											<th hidden>Status</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
								<button type="button" class="btn btn-success " name="btnUpdateCentreMultiple" id="btnUpdateCentreMultiple" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>
							</div>
						</div>
						
						
						
						
						<div class="tab-pane" id="exam_centre">
							<div class="col-lg-12 page-header">
								<label for="" class="col-sm-2 control-label">Program:</label>
								
								<div class="col-sm-4">
									<select class="form-control"  name="cmbProgram" id="cmbProgram" title="Select Program">
									</select>
								</div>
							</div>
							<div class="col-lg-12">
								<table class="table table-striped table-bordered"  id="tblCenterMaster" width="100%">
									<thead>
										<tr>
											<th class="text-center">Sl No</th>
											<th hidden>Program Code</th>
											<th hidden>Exam Code</th>
											<th class="text-center">Exam Center Name</th>
											<th class="text-center">
												<label class="control control--checkbox" style="margin-top: 5px;">  
													<input type="checkbox" id="chkCentreUpdate" name="chkCentreUpdate" value=""/>
													<div class="control__indicator"></div>
												</label>
											</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<button type="button" class="btn btn-warning" name="btnUpdateCentre" id="btnUpdateCentre" /><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;Update</i></button>
							</div>
							<div class="modal fade" id="centreAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Add Records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" role="form"  id="frmAddCentre" name="frmAddCentre">
												<div class="form-group">
													<div class="col-sm-10">
														<input type="hidden" class="form-control" id="hidUniqueid" name="hidUniqueid" />
														<input type="hidden" class="form-control" id="hidProgramCode" name="hidProgramCode" />
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label">Exam Centre Code</label>
													<div class="col-sm-9">
														<select class="form-control tooltips" id="txtExamCentreCode" name="txtExamCentreCode" title="Select Exam Center Code">
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label">Exam Centre Name</label>
													<div class="col-sm-9">
														<input type="text" class="form-control tooltips" id="txtExamCentreName" name="txtExamCentreName" placeholder="Enter Exam Center Name" title="Enter Exam Center Name">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label">Status</label>
													<div class="col-sm-9">
														<select class="form-control tooltips" id="cmbStatus" name="cmbStatus" title="Pick Status">
															<option value="ACTIVE">ACTIVE</option>
															<option value="INACTIVE">INACTIVE</option>
														</select>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="centreaddsave">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
							<div class="modal fade" id="centreEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Edit records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" role="form" id = "frmCentreEdit" name = "frmCentreEdit">
												<div class="form-group">
													<div class="col-sm-10">
														<input type="hidden" class="form-control" id="hidUniqueidEdit" name="hidUniqueidEdit">
														<input type="hidden" class="form-control" id="hidProgramCodeEdit" name="hidProgramCodeEdit" />
														<input type="hidden" class="form-control" id="hidCentreCodeEdit" name="hidCentreCodeEdit" />
													</div>
												</div>
												<!--<div class="form-group">
													<label for="" class="col-sm-2 control-label">Code</label>
													<div class="col-sm-10">
														<input type="text" class="form-control tooltips" id="txtExamCentreCodeEdit" name="txtExamCentreCodeEdit" placeholder="Enter Exam Center Code" title="Enter Exam Center Code" readonly="">
													</div>
												</div>-->
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Name</label>
													<div class="col-sm-10">
														<input type="text" class="form-control tooltips" id="txtExamCentreNameEdit" name="txtExamCentreNameEdit" placeholder="Enter Exam Center Name" title="Enter Exam Center Name" readonly="">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Status</label>
													<div class="col-sm-10">
														<select class="form-control tooltips" id="cmbStatusEdit" name="cmbStatusEdit" title="Pick Status">
															<option value="ACTIVE">ACTIVE</option>
															<option value="INACTIVE">INACTIVE</option>
														</select>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="centreeditsave">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
							<div class="modal fade" id="ChallanDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Delete record</h4>
										</div>
										<div class="modal-body">
											<center><h2>Do You Want to Delete This Record?</h2></center>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-danger" id="programDeleteRecord">Delete</button>
											<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>											
						</div>
						<div class="tab-pane" id="qualification_assign">
							<div class="col-lg-12 page-header">
								<label for="" class="col-sm-2 control-label">Program:</label>
								<div class="col-sm-3">
									<select class="form-control cmbSelectProgram"  name="cmbSelectProgram[]" title="Select Program" id="cmbSelectProgram" multiple="multiple">
									</select>
								</div>
							</div>
							<!--<form method="POST" role="form">-->
							<div class="col-lg-12">
								
								<table class="table table-striped table-bordered" id="dtblProgramQualificationAssign" width="100%">
									<thead>
										<tr>
											<th class="text-center">Sl No</th>
											<th class="text-center">Qualification</th>
											<th class="text-center">
												<label class="control control--checkbox" style="margin-top: 5px;">  
													<input type="checkbox" id="chkQualAll" name="chkQualAll" value=""/>
													<div class="control__indicator"></div>
												</label>
											</th>
											<th hidden="hidden" class="text-center">ID</th><!-- id will be hide -->
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<button type="button" class="btn btn-success " name="btnUpdateMultipleQualification" id="btnUpdateMultipleQualification" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>
							</div>
						</div>
						<div class="tab-pane" id="qualification_view">
							<div class="col-lg-12 page-header">
								<label for="" class="col-sm-2 control-label">Program:</label>
								<div class="col-sm-4">
									<select class="form-control"  name="cmbFilter" id="cmbFilter" title="Select Program">
									</select>
								</div>
							</div>
							<!--<form method="POST" role="form">-->
							<div class="col-lg-12">
								
								<table class="table table-striped table-bordered" id="dtblProgramQualification" width="100%">
									<thead>
										<tr>
											<th class="text-center">Sl No</th>
											<th class="text-center">Qualification</th>
											<th class="text-center">
												<label class="control control--checkbox" style="margin-top: 5px;">  
													<input type="checkbox" id="chkQualUpdate" name="chkQualUpdate" value=""/>
													<div class="control__indicator"></div>
												</label>
											</th>
											<th hidden="hidden" class="text-center">ID</th><!-- id will be hide -->
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<button type="button" class="btn btn-warning" name="btnUpdateQualification" id="btnUpdateQualification" /><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;Update</i></button>
							</div>	
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.row -->
</div><!-- /#page-wrapper -->
		
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/profile.js"></script>

