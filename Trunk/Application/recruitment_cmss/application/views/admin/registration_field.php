	<div class="content-wrapper">
				<div class="row">
					<br />
					<div class="col-lg-12">
						<!--<div class="panel with-nav-tabs panel-primary">
            				<div class="panel-heading">-->
            				<div class="nav-tabs-custom box box-default">
								<ul class="nav nav-tabs" role="tablist">
									<li class="active"><a href="#assign" data-toggle='tab'>Assign</a></li>
									<li><a href="#view" data-toggle='tab'>Update</a></li>
								</ul>
							<!--</div>
							<div class="panel-body">-->
           						<div class="tab-content">
									<div class="chart tab-pane in active" id="assign">
										<div class="col-lg-12 page-header">
											<label for="" class="col-sm-2 control-label">Program :</label>
											
											<div class="col-sm-3">
												<select class="form-control cmbProgramSelect"  name="cmbProgramSelect[]" title="Select Program" id="cmbProgramSelect" multiple="multiple">
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="dtblRegistrationFields" width="100%">
												<thead>
													<tr>
														<th >#</th>
														<th >Description</th>
														<th >Field Status</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
											<button type="button" class="btn btn-success " name="btnUpdateMultiple" id="btnUpdateMultiple" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>
										</div>
									</div>
									<div class="chart tab-pane" id="view">
										<div class="col-lg-12 page-header">
											<label for="" class="col-sm-2 control-label">Program :</label>
											
											<div class="col-sm-4">
												<select class="form-control"  name="cmbProgramFilter" title="Select Program" id="cmbProgramFilter">
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="dtblRegistrationFieldSingle" width="100%">
												<thead>
													<tr>
														<th >#</th>
														<th >Description</th>
														<th >Field Status</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
											<button type="submit" class="btn btn-warning" name="btnUpdateSingle" id="btnUpdateSingle" /><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;Update</i></button>
										</div>
										<div class="modal fade" id="EditModalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
															&times;
														</button>
														<h4 class="modal-title" id="myModalLabel">Edit records</h4>
													</div>
													<div class="modal-body">
														<form class="form-horizontal" role="form" id="frmRegistrationEditView" name="frmRegistrationEditView">
															<div class="form-group">
																<div class="col-sm-10">
																	<input type="hidden" class="form-control" id="hidUniqueidEditView" name="hidUniqueidEditView">
																</div>
															</div>
															<div class="form-group">
																<label for="" class="col-sm-2 control-label">Description</label>
																<div class="col-sm-10">
																	<input type="text" class="form-control tooltips" id="txtDescriptionEditView" name="txtDescriptionEditView" placeholder="Eg:Date of Birth,...." title="Description">
																</div>
															</div>
															<div class="form-group">
																<label for="" class="col-sm-2 control-label">Field Status</label>
																<div class="col-sm-10">
																	<select class="form-control tooltips" id="cmbFieldStatusEditView" name="cmbFieldStatusEditView" title="Select Field Status"></select>
																</div>
															</div>
															<div class="modal-footer">
																<button type="submit" class="btn btn-primary" id="EditSaveView">Save</button>
																<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
															</div>
														</form>
													</div>	
												</div>
											</div>
										</div>
										<div class="modal fade" id="DeleteModalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
														<button type="button" class="btn btn-danger" id="DeleteRecordView">Delete</button>
														<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--</div>
						</div>-->
					</div>	
				</div>
			</div>
			<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/registration_field.js"></script>