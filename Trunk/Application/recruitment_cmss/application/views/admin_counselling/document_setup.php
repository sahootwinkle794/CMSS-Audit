
			<div id="page-wrapper">
				<div class="row">
					<br />
					<div class="col-lg-12">
						<div class="panel with-nav-tabs panel-primary">
            				<div class="panel-heading">
								<ul class="nav nav-tabs" role="tablist">
									<li class="active"><a href="#assign" data-toggle='tab'>Assign</a></li>
									<li><a href="#view" data-toggle='tab'>Update</a></li>
								</ul>
							</div>
							<div class="panel-body">
           						<div class="tab-content">
									<div class="tab-pane in active" id="assign">
										<div class="col-lg-12 page-header">
											<label for="" class="col-sm-2 control-label">Program :</label>
											
											<div class="col-sm-3">
												<select class="form-control cmbProgramSelect"  name="cmbProgramSelect[]" title="Select Program" id="cmbProgramSelect" multiple="multiple">
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="dtblProgramDocument" width="100%">
												<thead>
													<tr>
														<th class="text-center">Sl No</th>
														<th class="text-center">Document Code</th>
														<th class="text-center">Document</th>
														<th class="text-center">Serial No</th>
														<th class="text-center">
															<label class="control control--checkbox" style="margin-top: 5px;">  
																<input type="checkbox" id="chkAll" name="chkAll" value=""/>
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
											<table class="table table-striped table-bordered" id="dtblProgramDocumentSingle" width="100%">
												<thead>
													<tr>
														<th class="text-center">Sl No</th>
														<th class="text-center">Document Code</th>
														<th class="text-center">Document</th>
														<th class="text-center">Serial No</th>
														<th class="text-center">
															<label class="control control--checkbox" style="margin-top: 5px;">  
																<input type="checkbox" id="chkUpdateAll" name="chkUpdateAll" value=""/>
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
								</div>
							</div>
						</div>
					</div>
				<!--</form>-->
				</div><!-- /.row -->
			</div><!-- /#page-wrapper -->
			<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/document_setup.js"></script>
		