<style>
	.multiselect-container {
    height: 200px;
    overflow: auto;
}
</style>
<div class="content-wrapper">
				<div class="row">
					<!--<form name="frmFilter" role="form" enctype="multipart/form-data" method="POST">-->
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
										<div class="chart tab-pane in active" id="assign" >
											<form class="form-horizontal" role="form" id="frmMenuAssign" name="frmMenuAssign" method="post" enctype="multipart/form-data">
												<div class="col-lg-12 page-header">
													<!--<form class="form-horizontal" role="form" id = "frmFilter" name = "frmFilter" method="POST" action="">-->
													<label for="" class="col-sm-2 control-label">Post:</label>
													<div class="col-sm-3">
														<select class="form-control cmbProgramSelect" id="cmbProgramSelect" name="cmbProgramSelect[]" title="Select Program" multiple="multiple" style="overflow-y: scroll; height: 380px;" >
														
														</select>
													</div>
													<!--</form>-->
												</div>
												<div class="col-lg-12">
													<table class="table table-striped table-bordered" id="dtblProgramMenu" width="100%">
														<thead>
															<tr>
																<th >#</th>
																<th >Menu</th>
																<th >Sequence No</th>
																<th  class="alignCenter" >
																	<label class="control control--checkbox" style="margin-top: 5px;">  
																		<input type="checkbox" id="chkAll" name="chkAll" value=""/>
																		<div class="control__indicator"></div>
																	</label>
																</th>
																<th >Upload</th>
																<!--<th >Action</th>-->
																<th hidden="hidden" >ID</th><!-- id will be hide -->
															</tr>
														</thead>
													</table>
													<button type="submit" class="btn btn-success" name="btnUpdateMultiple" id="btnUpdateMultiple" /><i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;Assign</button>
													<br/>
													<span style="color: red;"><br /><i style="color:red;font-size:15px;">*</i> All The documents should be .jpg/.png/.jpeg/.pdf/.xls/.doc/.JPG/.PNG/.JPEG/.PDF/.XLS/.DOC format And maximum size should be 1MB</span>
												</div>
											</form>
										</div>	
										<div class="chart tab-pane" id="view">
											<form class="form-horizontal" role="form"  id="frmMenu" name="frmMenu" method="post" enctype="multipart/form-data">
												<div class="col-lg-12 page-header">
													<label for="" class="col-sm-2 control-label">Post:</label>
													
													<div class="col-sm-4">
														<select class="form-control"  name="cmbProgramFilter" title="Select Program" id="cmbProgramFilter">
														</select>
													</div>
												</div>
												<div class="col-lg-12">
													<table class="table table-striped table-bordered" id="dtblProgramMenuSingle" width="100%">
														<thead>
															<tr>
																<th >#</th>
																<th hidden="hidden" >ID</th><!-- id will be hide -->
																<th >Menu</th>
																<th >Sequence No</th>
																<th >
																	<label class="control control--checkbox" style="margin-top: 5px;">  
																		<input type="checkbox" id="chkUpdate" name="chkUpdate" value=""/>
																		<div class="control__indicator"></div>
																	</label>
																</th>
																<th style="text-align: center;">Upload</th>
																<th style="text-align: center;">Action</th>
																
															</tr>
														</thead>
													</table>
													<button type="submit" class="btn btn-warning" name="btnUpdateSingle" id="btnUpdateSingle" /><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Update</button>
													<br/>
													<span style="color: red;"><br /><i style="color:red;font-size:15px;">*</i> All The documents should be .jpg/.png/.jpeg/.pdf/.xls/.doc/.JPG/.PNG/.JPEG/.PDF/.XLS/.DOC format And maximum size should be 1MB</span>												
												</div>
											</form>
										</div>
									</div>
								</div>
								<!--</div>
							</div>-->
						</div>
					<!--</form>-->
				</div><!-- /.row -->
			</div><!-- /#page-wrapper -->
			<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/program_menu_setup.js"></script>	