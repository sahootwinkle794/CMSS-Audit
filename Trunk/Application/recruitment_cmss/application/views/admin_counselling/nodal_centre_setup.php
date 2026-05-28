<div id="page-wrapper">
	<div class="row">
		<br />
		<div class="col-lg-12">
			<div class="panel with-nav-tabs panel-primary">
				<div class="panel-heading">
					<ul class="nav nav-tabs" role="tablist">
						<li class="active"><a href="#nodal_centre" data-toggle='tab'>Nodal Center</a></li>
						<li><a href="#counter_setup" data-toggle='tab'>Counter Setup</a></li>
						<li><a href="#nodal_counter_mapping" data-toggle='tab'>Nodal Centre - Counter Mapping</a></li>
					</ul>
				</div>
				<div class="panel-body">
					<div class="tab-content">
						
						<div class="tab-pane in active" id="nodal_centre">
							<!--<form method="POST" role="form">-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblNodalCentre" width="100%">
									<thead>
										<tr>
											<th class="text-center">Sl No</th>
											<th class="text-center">Center Code</th><!-- id will be hide -->
											<th class="text-center">Center Name</th>
											<th class="text-center">Center Address</th>
											<th class="text-center">Center Capacity</th>
											<th class="text-center">Nodal Centre Admin</th>
											<th class="text-center" hidden="">Nodal Centre Admin</th>
											<th class="text-center">Attendance User</th>
											<th class="text-center" hidden="">Attendance User</th>
											<th class="text-center">Action</th>
											
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
								<!--<button type="button" class="btn btn-success " name="btnUpdateMultiple" id="btnUpdateMultiple" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>-->
							</div>
							
							<div class="modal fade" id="modalNodalCentre" tabindex="-1" Resource="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Add Records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" Resource="form"  id="frmNodalCentre" name="frmNodalCentre">
												<input type="hidden" id="hidNodalCentre" name="hidNodalCentre"/>
												<input type="hidden" id="hidUserCode" name="hidUserCode"/>
												<div class="form-group">
													<label for="txtCodeGroup" class="col-sm-4 control-label">Center Code</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtCenterCode" name="txtCenterCode" placeholder="Center Code">
													</div>
												</div>
												<div class="form-group">
													<label for="txtCodeGroup" class="col-sm-4 control-label">Center Name</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtCenterName" name="txtCenterName" placeholder="Center Name">
													</div>
												</div>
												<div class="form-group">
													<label for="txtCodeGroup" class="col-sm-4 control-label">Center Address</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtCenterAddress" name="txtCenterAddress" placeholder="Center Address">
													</div>
												</div>
												<div class="form-group">
													<label for="txtCodeGroup" class="col-sm-4 control-label">Center Capacity</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtCenterCapacity" name="txtCenterCapacity" placeholder="Center Capacity">
													</div>
												</div>
												<!--<div id="txtCodeGroupAdd" class="form-group">
													<label for="" class="col-sm-4 control-label">User Name</label>
													<div class="col-lg-6 col-sm-6 col-md-6">
														<select id="cmbUserCode" multiple="multiple"   class="form-control tooltips" data-live-search="true" name="cmbUserCode[]"  title="Choose User">
			          										
			          									</select>
													</div>
												</div>
												<div id="txtCodeGroupEdit" class="form-group">
													<label for="txtCodeGroupEdit" class="col-sm-4 control-label">User Name</label>
													<div class="col-sm-8">
														<select class="form-control" id="cmbUserCodeEdit" name="cmbUserCodeEdit">
														</select>
													</div>
												</div>-->
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="btnSaveNodalCentre">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="counter_setup">
							<!--<form method="POST" role="form">-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblCounter" width="100%">
									<thead>
										<tr>
											<th class="text-center">Sl No</th>
											<th class="text-center">Counter Code</th><!-- id will be hide -->
											<th class="text-center">Counter Name</th>
											<th class="text-center">Action</th>
											
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
								<!--<button type="button" class="btn btn-success " name="btnUpdateMultiple" id="btnUpdateMultiple" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>-->
							</div>
							
							<div class="modal fade" id="modalCounter" tabindex="-1" Resource="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabelCounter">Add Records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" Resource="form"  id="frmCounter" name="frmCounter">
												<input type="hidden" id="hidCounter" name="hidCounter"/>
												<div class="form-group">
													<label for="txtCodeGroup" class="col-sm-4 control-label">Counter Code</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtCounterCode" name="txtCounterCode" placeholder="Counter Code">
													</div>
												</div>
												<div class="form-group">
													<label for="txtCodeGroup" class="col-sm-4 control-label">Counter Name</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtCounterName" name="txtCounterName" placeholder="Counter Name">
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="btnSaveCounter">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
						</div>

						
						<div class="tab-pane" id="nodal_counter_mapping">
							<!--<form method="POST" role="form">-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblNodalCounterMapping" width="100%">
									<thead>
										<tr>
											<th class="text-center">Sl No</th>
											<th class="text-center" hidden="">Nodal Center Code</th><!-- id will be hide -->
											<th class="text-center">Nodal Center Name</th>
											<th class="text-center">Counter Name</th>
											<th class="text-center" hidden="">Counter Code</th>
											<th class="text-center">Verification User</th>
											<th class="text-center" hidden="">Counter Number</th>
											<th class="text-center" hidden="">Token Number</th>
											<th class="text-center">Action</th>
											
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
								<!--<button type="button" class="btn btn-success " name="btnUpdateMultiple" id="btnUpdateMultiple" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>-->
							</div>
							
							<div class="modal fade" id="modalNodalCounterMapping" tabindex="-1" Resource="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabelNodalCounterMapping">Add Records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" Resource="form"  id="frmNodalCounterMapping" name="frmNodalCounterMapping">
												<input type="hidden" id="hidNodalCode" name="hidNodalCode"/>
												<input type="hidden" id="hidCounterCode" name="hidCounterCode"/>
												<div class="form-group">
													<label for="txtCodeGroup" class="col-sm-4 control-label">Nodal Center</label>
													<div class="col-sm-8">
														<select class="form-control" id="cmbNodalCode" name="cmbNodalCode">
														</select>
													</div>
												</div>
												<div class="form-group"  id="CounterCode">
													<label for="" class="col-sm-4 control-label">Counter Name</label>
													<div class="col-lg-6 col-sm-6 col-md-6">
														<select id="cmbCounterCode" multiple="multiple"  class="form-control tooltips" data-live-search="true" name="cmbCounterCode[]"  title="Choose Counter">
			          										
			          									</select>
													</div>
												</div>
												<div id="CounterCodeEdit" class="form-group">
													<label for="txtCodeGroupEdit" class="col-sm-4 control-label">Counter Name</label>
													<div class="col-sm-8">
														<select class="form-control" id="cmbCounterCodeEdit" name="cmbCounterCodeEdit">
														</select>
													</div>
												</div>
												<!--<div class="form-group">
													<label for="txtCodeGroup" class="col-sm-4 control-label">Counter Number</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtCounterNumber" name="txtCounterNumber" placeholder="Counter Number">
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label">Token Number</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtTokenNumber" name="txtTokenNumber" placeholder="Token Number">
													</div>
												</div>-->
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="btnSaveNodalCounterMapping">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
						</div>

						
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.row -->
</div><!-- /#page-wrapper -->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin_counselling/nodal_centre_setup.js"></script>
