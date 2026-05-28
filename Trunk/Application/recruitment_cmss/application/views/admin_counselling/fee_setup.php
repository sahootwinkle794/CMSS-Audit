<div id="page-wrapper">
	<div class="row">
		<br />
		<div class="col-lg-12">
			<div class="panel with-nav-tabs panel-primary">
			<div class="panel-heading">
					<ul class="nav nav-tabs" role="tablist">
						<li class="active"><a href="#fee_assign" data-toggle='tab'>Assign Fee</a></li>
						<li><a href="#fee_view" data-toggle='tab'>Update Fee</a></li>
						<li><a href="#charge" data-toggle='tab'>Manage Transactional Charge</a></li>
					</ul>
				</div>
				<div class="panel-body">
					<div class="tab-content">
						<div class="tab-pane in active" id="fee_assign">
							<div class="col-lg-12 page-header">
								<label for="" class="col-sm-2 control-label">Program:</label>
								<div class="col-sm-3">
									<select class="form-control cmbProgramSelect"  name="cmbProgramSelect[]" title="Select Program" id="cmbProgramSelect" multiple="multiple">
									</select>
								</div>
							</div>
							<!--<form method="POST" role="form">-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblProgramFeeAssign"width="100%">
									<thead>
										<tr>
											<th class="text-center">Sl No</th>
											<th hidden="hidden"  class="text-center">ID</th><!-- id will be hide -->
											<th class="text-center">Category</th>
											<th class="text-center">Amount</th>
											
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
								<button type="button" class="btn btn-success " name="btnUpdateMultiple" id="btnUpdateMultiple" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>
							</div>
						</div>
						<div class="tab-pane" id="fee_view">
							<div class="col-lg-12 page-header">
								<label for="" class="col-sm-2 control-label">Program:</label>
								<div class="col-sm-4">
									<select class="form-control"  name="cmbProgramFilter" title="Select Program" id="cmbProgramFilter">
									</select>
								</div>
							</div>
							<!--<form method="POST" role="form">-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblProgramFee"width="100%">
									<thead>
										<tr>
											<th class="text-center">Sl No</th>
											<th class="text-center">Category</th>
											<th class="text-center">Amount</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
								<button type="button" class="btn btn-warning" name="btnUpdateSingle" id="btnUpdateSingle" /><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;Update</i></button>
							</div>
							<div class="modal fade" id="feeAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Add records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" role="form" id = "frmFeeAdd" name = "frmFeeAdd">
																						
												<!--<div class="form-group">
													<label for="" class="col-sm-2 control-label">Program</label>
													<div class="col-sm-10">
														<select class="form-control tooltips" id="cmbProgramName" name="cmbProgramName" title="Select Program Name">
															
														</select>
													</div>
												</div>-->
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Category</label>
													<div class="col-sm-10">
														<select class="form-control tooltips" id="cmbCategory" name="cmbCategory" title="Select Category">
															
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Amount</label>
													<div class="col-sm-10">
														<input  type="text" class="form-control tooltips" id="txtAmount" name="txtAmount" title="Enter Amount"/>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" >Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
							<div class="modal fade" id="feeEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Edit records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" role="form" id = "frmFeeEdit" name = "frmFeeEdit">
												<div class="form-group">
													<div class="col-sm-10">
														<input type="hidden" class="form-control" id="hidUniqueidEdit" name="hidUniqueidEdit">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Category</label>
													<div class="col-sm-10">
														<select class="form-control tooltips" id="cmbCategoryEdit" name="cmbCategoryEdit" title="Select Category">
															
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Amount</label>
													<div class="col-sm-10">
														<input  type="text" class="form-control tooltips" id="txtAmountEdit" name="txtAmountEdit" title="Enter Amount"/>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="programEditSave">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="charge">
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblTransactionChargeMaster"width="100%">
									<thead>
										<tr>
											<th class="text-center">Sl No</th>
											<th class="text-center">Program Code</th>
											<th class="text-center">Program</th>
											<th class="text-center">Transaction Charge</th>
											<th class="text-center">Status</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
							<div class="modal fade" id="challanAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Add Records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" Resource="form"  id="frmAddCharge" name="frmAddCharge">
												<input type="hidden" id="hidOperTypeFeeAdd" name="hidOperTypeFeeAdd" value=""/>
												<div id="errorlogResource" style="display: none; color: red; font-size: 12px;"></div>
												<div class="form-group">
													<div class="col-sm-10">
														<input type="hidden" class="form-control" id="hidUniqueid" name="hidUniqueid">
													</div>
												</div>
												<div class="form-group">
													<label for="inputname" class="col-sm-2 control-label">Program</label>
													<div class="col-sm-10">
														<!--<select class="form-control tooltips" id="cmbProgramCode" name="cmbProgramCode" title="Code of Program">
														</select>-->
														<select class="form-control cmbProgramCode"  name="cmbProgramCode[]" title="Code of Program" id="cmbProgramCode" multiple="multiple">
														</select>
													</div>
												</div>
				
												
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Transaction Charge</label>
													<div class="col-sm-10">
														<input type="text" class="form-control tooltips" id="txtCharge" name="txtCharge" placeholder="Enter Transaction Charge" title="Enter Transaction Charge">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Status</label>
													<div class="col-sm-10">
														<select class="form-control tooltips" id="cmbStatus" name="cmbStatus" title="Pick Status">
															<option value="">Select</option>
															<option value="1">Active</option>
															<option value="0">Inactive</option>
														</select>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="challanaddsave">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
							<div class="modal fade" id="challanEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Edit records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" resource="form" id = "frmChargeEdit" name = "frmChargeEdit">
												<input type="hidden" id="hidOperTypeFeeEdit" name="hidOperTypeFeeEdit" value=""/>
												<div id="errorlogResource" style="display: none; color: red; font-size: 12px;"></div>
												<div class="form-group">
													<div class="col-sm-10">
														<input type="hidden" class="form-control" id="hidUniqueidEdit" name="hidUniqueidEdit">
													</div>
												</div>
												<div class="form-group">
													<label for="inputname" class="col-sm-2 control-label">Program</label>
													<div class="col-sm-10">
														<!--<select class="form-control tooltips" id="cmbProgramCodeEdit" name="cmbProgramCodeEdit" title="Code of Program" readonly>
															
														</select>-->
														<input type="text" class="form-control tooltips" id="cmbProgramCodeEdit" name="cmbProgramCodeEdit" title="Code of Program" readonly>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Transaction Charge</label>
													<div class="col-sm-10">
														<input type="text" class="form-control tooltips" id="txtChargeEdit" name="txtChargeEdit" placeholder="Transaction Charge" title="Transaction Charge">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-2 control-label">Status</label>
													<div class="col-sm-10">
														<select class="form-control tooltips" id="cmbStatusEdit" name="cmbStatusEdit" title="Pick Status">
															<option value="1">Active</option>
															<option value="0">Inactive</option>
														</select>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="challaneditsave">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
							<div class="modal fade" id="ChargeDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.row -->
</div><!-- /#page-wrapper -->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/fee_setup.js"></script>
