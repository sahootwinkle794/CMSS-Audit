<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Counselling Period Setup</h1>
        </div>
    	<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<br />
		<div class="col-lg-12">
			<div class="panel panel-default">
				
				<div class="panel-body">
					<div class="tab-pane">
						<!--<form method="POST" role="form">-->
						<div class="col-lg-12">
							<table class="table table-striped table-bordered" id="tblCounsellingPeriod" width="100%">
								<thead>
									<tr>
										<th class="text-center">Sl No</th>
										<th class="text-center">Counselling Peiod Code</th><!-- id will be hide -->
										<th class="text-center">Counselling Peiod Name</th>
										<th class="text-center">Status</th>
										<th class="text-center">Action</th>
										
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
							<!--<button type="button" class="btn btn-success " name="btnUpdateMultiple" id="btnUpdateMultiple" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>-->
						</div>
						
						<div class="modal fade" id="modalCounsellingPeriod" tabindex="-1" Resource="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabelCounsellingPeriod">Add Records</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" Resource="form"  id="frmCounsellingPeriod" name="frmCounsellingPeriod">
											<input type="hidden" id="hidCounsellingPeriod" name="hidCounsellingPeriod"/>
											<div class="form-group">
												<label for="txtCodeGroup" class="col-sm-4 control-label">Counselling Period Code</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="txtCounsellingPeriodCode" name="txtCounsellingPeriodCode" placeholder="Counselling Period Code">
												</div>
											</div>
											<div class="form-group">
												<label for="txtCodeGroup" class="col-sm-4 control-label">Counselling Period Name</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="txtCounsellingPeriodName" name="txtCounsellingPeriodName" placeholder="Counselling Period Name">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label">Status</label>
												<div class="col-sm-8">
													<select class="form-control" id="cmbCounsellingPeriodStatus" name="cmbCounsellingPeriodStatus">
														<option value="">Select Status</option>
														<option value="Active">Active</option>
														<option value="Inactive">Inactive</option>
													</select>
												</div>
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-primary" id="btnSaveCounsellingPeriod">Save</button>
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
	</div><!-- /.row -->
</div><!-- /#page-wrapper -->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin_counselling/counselling_period_setup.js"></script>
