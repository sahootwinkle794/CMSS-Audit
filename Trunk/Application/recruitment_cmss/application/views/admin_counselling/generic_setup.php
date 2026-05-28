<div id="page-wrapper">
	<div class="row">
		<br />
		<div class="col-lg-12">
			<div class="panel with-nav-tabs panel-primary">
				<div class="panel-heading">
					<ul class="nav nav-tabs" role="tablist">
						<li class="active"><a href="#document_master" data-toggle='tab'>Document Setup</a></li>
						<li><a href="#category_master" data-toggle='tab'>Category Setup</a></li>
						<li><a href="#special_category_master" data-toggle='tab'>Special Category Setup</a></li>
						<li><a href="#category_document_mapping" data-toggle='tab'>Category Document Mapping</a></li>
						<li><a href="#category_fee_setup" data-toggle='tab'>Category Fee Setup</a></li>
						<li><a href="#remark" data-toggle='tab'>Remark</a></li>
					</ul>
				</div>
				<div class="panel-body">
					<div class="tab-content">
						
						<div class="tab-pane in active" id="document_master">
							<!--<form method="POST" role="form">-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblDocumentSetup" width="100%">
									<thead>
										<tr>
											<th class="text-center">Sl No</th>
											<th class="text-center">Document Code</th><!-- id will be hide -->
											<th class="text-center">Document Name</th>
											<th class="text-center">Document Type</th>
											<th class="text-center">Action</th>
											
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
								<!--<button type="button" class="btn btn-success " name="btnUpdateMultiple" id="btnUpdateMultiple" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>-->
							</div>
							
							<div class="modal fade" id="modalDocumentSetup" tabindex="-1" Resource="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Add Records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" Resource="form"  id="frmDocumentSetup" name="frmDocumentSetup">
												<input type="hidden" id="hidDocumentCode" name="hidDocumentCode"/>
												<div class="form-group">
													<label for="txtCodeGroup" class="col-sm-4 control-label">Document Code</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtDocumentCode" name="txtDocumentCode" placeholder="Document Code">
													</div>
												</div>
												<div class="form-group">
													<label for="txtCodeGroup" class="col-sm-4 control-label">Document Name</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtDocumentName" name="txtDocumentName" placeholder="Document Name">
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-4 control-label">Document Type</label>
													<div class="col-sm-8">
														<select class="form-control" id="cmbDocumentType" name="cmbDocumentType">
															<option value="">Select Type</option>
															<option value="Generic">Generic</option>
															<option value="Specific">Specific</option>
														</select>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="btnSaveDocumentSetup">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="category_master">
							<!--<form method="POST" role="form">-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblCategory" width="100%">
									<thead>
										<tr>
											<th class="text-center">Sl No</th>
											<th class="text-center">Category Code</th><!-- id will be hide -->
											<th class="text-center">Category Name</th>
											<th class="text-center">Action</th>
											
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
								<!--<button type="button" class="btn btn-success " name="btnUpdateMultiple" id="btnUpdateMultiple" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>-->
							</div>
							
							<div class="modal fade" id="modalCategory" tabindex="-1" Resource="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabelCounter">Add Records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" Resource="form"  id="frmCategory" name="frmCategory">
												<input type="hidden" id="hidCategory" name="hidCategory"/>
												<div class="form-group">
													<label for="txtCodeGroup" class="col-sm-4 control-label">Category Code</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtCategoryCode" name="txtCategoryCode" placeholder="Category Code">
													</div>
												</div>
												<div class="form-group">
													<label for="txtCodeGroup" class="col-sm-4 control-label">Category Name</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtCategoryName" name="txtCategoryName" placeholder="Category Name">
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="btnSaveCategory">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
						</div>

						
						<div class="tab-pane" id="special_category_master">
							<!--<form method="POST" role="form">-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblSpecialCategoryMaster" width="100%">
									<thead>
										<tr>
											<th class="text-center">Sl No</th>
											<th class="text-center">Category Code</th><!-- id will be hide -->
											<th class="text-center">Category Name</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
								<!--<button type="button" class="btn btn-success " name="btnUpdateMultiple" id="btnUpdateMultiple" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>-->
							</div>
							
							<div class="modal fade" id="modalSpecialCategory" tabindex="-1" Resource="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabelSpecialCategory">Add Records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" Resource="form"  id="frmSpecialCategory" name="frmSpecialCategory">
												<input type="hidden" id="hidSpecialCategory" name="hidSpecialCategory"/>
												<div class="form-group">
													<label for="txtCodeGroup" class="col-sm-4 control-label">Category Code</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtSpecialCategoryCode" name="txtSpecialCategoryCode" placeholder="Category Code">
													</div>
												</div>
												<div class="form-group">
													<label for="txtCodeGroup" class="col-sm-4 control-label">Category Name</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtSpecialCategoryName" name="txtSpecialCategoryName" placeholder="Category Name">
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="btnSaveSpecialCategory">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="category_document_mapping">
							<!--<form method="POST" role="form">-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblCategoryDocumentMaster" width="100%">
									<thead>
										<tr>
											<th class="text-center">Sl No</th>
											<th class="text-center" hidden="">Category Code</th>
											<th class="text-center">Category</th>
											<th class="text-center">Document</th>
											<th class="text-center" hidden="">Document Code</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
								<!--<button type="button" class="btn btn-success " name="btnUpdateMultiple" id="btnUpdateMultiple" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>-->
							</div>
							
							<div class="modal fade" id="modalCategoryDocument" tabindex="-1" Resource="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabelCategoryDocument">Add Records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" Resource="form"  id="frmCategoryDocument" name="frmCategoryDocument">
												<input type="hidden" id="hidCategoryCode" name="hidCategoryCode"/>
												<input type="hidden" id="hidCatDocumentCode" name="hidCatDocumentCode"/>
												<div class="form-group">
													<label for="txtCodeGroup" class="col-sm-4 control-label">Category</label>
													<div class="col-sm-8">
														<select class="form-control" id="cmbCategoryCode" name="cmbCategoryCode">
														</select>
													</div>
												</div>
												<div class="form-group"  id="DocumentCode">
													<label for="" class="col-sm-4 control-label">Document</label>
													<div class="col-lg-6 col-sm-6 col-md-6">
														<select id="cmbDocumentCode" multiple="multiple"  class="form-control tooltips" data-live-search="true" name="cmbDocumentCode[]"  title="Choose Document">
			          										
			          									</select>
													</div>
												</div>
												<div id="DocumentCodeEdit" class="form-group">
													<label for="txtCodeGroupEdit" class="col-sm-4 control-label">Document</label>
													<div class="col-sm-8">
														<select class="form-control" id="cmbDocumentCodeEdit" name="cmbDocumentCodeEdit">
														</select>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="btnSaveCategoryDocument">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="category_fee_setup">
							<!--<form method="POST" role="form">-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblCategoryFeeMaster" width="100%">
									<thead>
										<tr>
											<th class="text-center">Sl No</th>
											<th class="text-center" hidden="">Category Code</th>
											<th class="text-center">Category</th>
											<th class="text-center">Fee</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
								<!--<button type="button" class="btn btn-success " name="btnUpdateMultiple" id="btnUpdateMultiple" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>-->
							</div>
							
							<div class="modal fade" id="modalCategoryFee" tabindex="-1" Resource="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabelCategoryFee">Add Records</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" Resource="form"  id="frmCategoryFee" name="frmCategoryFee">
												<input type="hidden" id="hidCategoryFeeCode" name="hidCategoryFeeCode"/>
												<div class="form-group">
													<label for="txtCodeGroup" class="col-sm-4 control-label">Category</label>
													<div class="col-sm-8">
														<select class="form-control" id="cmbCategoryFeeCode" name="cmbCategoryFeeCode">
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-4 control-label">Fee</label>
													<div class="col-lg-6 col-sm-6 col-md-6">
														<input class="form-control" type="text" id="txtFee" name="txtFee"/>
														<!--<select id="cmbDocumentCode" multiple="multiple"  class="form-control tooltips" data-live-search="true" name="cmbDocumentCode[]"  title="Choose Document">
			          										
			          									</select>-->
													</div>
												</div>
												
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="btnSaveCategoryFee">Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
												</div>
											</form>
										</div>	
									</div>
								</div>
							</div>
						</div>
						
						<div class="tab-pane" id="remark">
							<!--<form method="POST" role="form">-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblRemark" width="100%">
									<thead>
										<tr>
											<th class="text-center">Sl No</th>
											<th class="text-center">Remark</th>
											<th class="text-center">Delete</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
								<!--<button type="button" class="btn btn-success " name="btnUpdateMultiple" id="btnUpdateMultiple" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>-->
							</div>
							
							<div class="modal fade" id="modalRemark" tabindex="-1" Resource="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabelRemark">Add Remark</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" Resource="form"  id="frmRemark" name="frmRemark">
												<div class="form-group">
													<label for="txtCodeGroup" class="col-sm-4 control-label">Remark</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="txtRemark" name="txtRemark" placeholder="Remark">
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="btnSaveRemark">Save</button>
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
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin_counselling/generic_setup.js"></script>
