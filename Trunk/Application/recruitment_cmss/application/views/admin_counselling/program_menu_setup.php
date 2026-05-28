<div id="page-wrapper">
				<div class="row">
					<!--<form name="frmFilter" role="form" enctype="multipart/form-data" method="POST">-->
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
											<form class="form-horizontal" role="form" id="frmMenuAssign" name="frmMenuAssign" method="post" enctype="multipart/form-data">
												<div class="col-lg-12 page-header">
													<!--<form class="form-horizontal" role="form" id = "frmFilter" name = "frmFilter" method="POST" action="">-->
													<label for="" class="col-sm-2 control-label">Program:</label>
													<div class="col-sm-3">
														<select class="form-control cmbProgramSelect" id="cmbProgramSelect" name="cmbProgramSelect[]" title="Select Program" multiple="multiple">
														
														</select>
													</div>
													<!--</form>-->
												</div>
												<div class="col-lg-12">
													<table class="table table-striped table-bordered" id="dtblProgramMenu" width="100%">
														<thead>
															<tr>
																<th class="text-center">#</th>
																<th class="text-center">Menu</th>
																<th class="text-center">Sequence No</th>
																<th class="text-center">
																	<label class="control control--checkbox" style="margin-top: 5px;">  
																		<input type="checkbox" id="chkAll" name="chkAll" value=""/>
																		<div class="control__indicator"></div>
																	</label>
																</th>
																<th class="text-center">Upload</th>
																<th class="text-center">Action</th>
																<th hidden="hidden" class="text-center">ID</th><!-- id will be hide -->
															</tr>
														</thead>
													</table>
													<button type="submit" class="btn btn-success" name="btnUpdateMultiple" id="btnUpdateMultiple" /><i class="fa fa-check-square-o" aria-hidden="true">&nbsp;Assign</i></<button>
												</div>
											</form>
										</div>	
										<div class="tab-pane" id="view">
											<form class="form-horizontal" role="form"  id="frmMenu" name="frmMenu" method="post" enctype="multipart/form-data">
												<div class="col-lg-12 page-header">
													<label for="" class="col-sm-2 control-label">Program :</label>
													
													<div class="col-sm-4">
														<select class="form-control"  name="cmbProgramFilter" title="Select Program" id="cmbProgramFilter">
														</select>
													</div>
												</div>
												<div class="col-lg-12">
													<table class="table table-striped table-bordered" id="dtblProgramMenuSingle" width="100%">
														<thead>
															<tr>
																<th class="text-center">#</th>
																<th hidden="hidden" class="text-center">ID</th><!-- id will be hide -->
																<th class="text-center">Menu</th>
																<th class="text-center">Sequence No</th>
																<th class="text-center">
																	<label class="control control--checkbox" style="margin-top: 5px;">  
																		<input type="checkbox" id="chkUpdate" name="chkUpdate" value=""/>
																		<div class="control__indicator"></div>
																	</label>
																</th>
																<th class="text-center">Upload</th>
																<th class="text-center">Action</th>
																
															</tr>
														</thead>
													</table>
													<button type="submit" class="btn btn-warning" name="btnUpdateSingle" id="btnUpdateSingle" /><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;Update</i></button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					<!--</form>-->
				</div><!-- /.row -->
			</div><!-- /#page-wrapper -->
			<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/program_menu_setup.js"></script>	