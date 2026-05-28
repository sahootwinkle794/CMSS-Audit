
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
									<!--<li><a href="#selectedassigned" data-toggle='tab'>Selected Assigned</a></li>
									<li><a href="#selected_update" data-toggle='tab'>Selected Update</a></li>-->
								</ul>
							<!--</div>
							<div class="panel-body">-->
           						<div class="tab-content">
									<div class="chart tab-pane in active" id="assign">
										<div class="col-lg-12 page-header">
											<label for="" class="control-label col-sm-2" id ="cmbProgramGroupl" >Recruitment Drive:</label>
											<div class="col-sm-3">
												<select class="form-control" name="cmbProgramGroupDocument" id="cmbProgramGroupDocument">
												</select>
											</div>
											<label for="" class="col-sm-2 control-label">Post :</label>
											
											<div class="col-sm-3">
												<select class="form-control cmbProgramSelect"  name="cmbProgramSelect[]" title="Select Post" id="cmbProgramSelect" multiple="multiple">
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="dtblProgramDocument" width="100%">
												<thead>
													<tr>
														<th >#</th>
														<th >Document Code</th>
														<th >Document</th>
														<th >Serial No</th>
														<th >
															<label class="control control--checkbox" style="margin-top: 5px;">  
																<input type="checkbox" class="tooltips" title="Select All" id="chkAll" name="chkAll" value=""/>
																<div class="control__indicator"></div>
															</label>
														</th>
														<th hidden="hidden" >ID</th><!-- id will be hide -->
													</tr>
												</thead>
											</table>
											<!--<button type="button" class="btn btn-success " name="btnUpdateMultiple" id="btnUpdateMultiple" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>-->
										</div>
									</div>	

									<div class="chart tab-pane" id="selectedassigned">
										<div class="col-lg-12 page-header">
											<label for="" class="col-sm-2 control-label">Post :</label>
											
											<div class="col-sm-3">
												<select class="form-control cmbSelectedAssigned"  name="cmbSelectedAssigned[]" title="Select Post" id="cmbSelectedAssigned" multiple="multiple">
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="dtblSelectedAssigned" width="100%">
												<thead>
													<tr>
														<th >#</th>
														<th >Document Code</th>
														<th >Document</th>
														<th >Serial No</th>
														<th >
															<label class="control control--checkbox" style="margin-top: 5px;">  
																<input type="checkbox" class="tooltips" title="Select All" id="chkAll1" name="chkAll1" value="" />
																<div class="control__indicator"></div>
															</label>
														</th>
														<th hidden="hidden" >ID</th><!-- id will be hide -->
													</tr>
												</thead>
											</table>
											<button type="button" class="btn btn-success " name="btnUpdateMultiple1" id="btnUpdateMultiple1" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>
										</div>
									</div>

									<div class="chart tab-pane" id="view">
										<div class="col-lg-12 page-header">
											<label for="" class="control-label col-sm-2" id ="cmbProgramGroupl" >Recruitment Drive:</label>
											<div class="col-sm-3">
												<select class="form-control" name="cmbProgramGroupDocSingle" id="cmbProgramGroupDocSingle">
												</select>
											</div>
											<label for="" class="col-sm-2 control-label">Post :</label>
											
											<div class="col-sm-4">
												<select class="form-control"  name="cmbProgramFilter" title="Select Post" id="cmbProgramFilter">
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="dtblProgramDocumentSingle" width="100%">
												<thead>
													<tr>
														<th >#</th>
														<th >Document Code</th>
														<th >Document</th>
														<th >Serial No</th>
														<th >
															<label class="control control--checkbox" style="margin-top: 5px;">  
																<input type="checkbox" class="tooltips" title="Select All" id="chkUpdateAll" name="chkUpdateAll" value=""/>
																<div class="control__indicator"></div>
															</label>
														</th>
														<th hidden="hidden" >ID</th><!-- id will be hide -->
													</tr>
												</thead>
											</table>
											<button type="button" class="btn btn-warning" name="btnUpdateSingle" id="btnUpdateSingle" /><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Update</button>
										</div>
									</div>
									<!-- selected update-->
									<div class="chart tab-pane" id="selected_update">
										<div class="col-lg-12 page-header">
											<label for="" class="col-sm-2 control-label">Post :</label>
											
											<div class="col-sm-4">
												<select class="form-control"  name="cmbSelectedProgramFilter" title="Select Post" id="cmbSelectedProgramFilter">
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="dtblSelectedProgramDocumentSingle" width="100%">
												<thead>
													<tr>
														<th >#</th>
														<th >Document Code</th>
														<th >Document</th>
														<th >Serial No</th>
														<th >
															<label class="control control--checkbox" style="margin-top: 5px;">  
																<input type="checkbox" class="tooltips" title="Select All" id="chkSelectedUpdateAll" name="chkSelectedUpdateAll" value=""/>
																<div class="control__indicator"></div>
															</label>
														</th>
														<th hidden="hidden" >ID</th><!-- id will be hide -->
													</tr>
												</thead>
											</table>
											<button type="button" class="btn btn-warning" name="btnSelectedUpdateSingle" id="btnSelectedUpdateSingle" /><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;Update</i></button>
										</div>
									</div>
								</div>
							</div>
							<!--</div>
						</div>-->
					</div>
				<!--</form>-->
				</div><!-- /.row -->
			</div><!-- /#page-wrapper -->
			<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/document_setup.js"></script>
			<!--<link href="<?php echo base_url(); ?>public/assets/js/buttons.dataTables.min.css" type="text/css" />-->
			<script src="<?php echo base_url(); ?>public/assets/js/dataTables.buttons.min.js" type="text/javascript"></script>
			<script src="<?php echo base_url(); ?>public/assets/js/buttons.flash.min.js" type="text/javascript"></script>
			<script src="<?php echo base_url(); ?>public/assets/js/jszip.min.js" type="text/javascript"></script>
			<script src="<?php echo base_url(); ?>public/assets/js/pdfmake.min.js" type="text/javascript"></script>
			<script src="<?php echo base_url(); ?>public/assets/js/vfs_fonts.js" type="text/javascript"></script>
			<script src="<?php echo base_url(); ?>public/assets/js/buttons.html5.min.js" type="text/javascript"></script>