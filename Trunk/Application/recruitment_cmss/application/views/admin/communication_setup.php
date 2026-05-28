<div class="content-wrapper">
	<div class="row">
		<form name="frmFilter" role="form" enctype="multipart/form-data" method="POST">
			<input type="hidden" id="hidSessionCode" name="hidSessionCode" value=""/>
			<br />
			<div class="col-lg-12">
				<!--<div class="panel with-nav-tabs panel-primary">
    				<div class="panel-heading">-->
    				<div class="nav-tabs-custom box box-default">
						<ul class="nav nav-tabs" role="tablist">
							<li class="active"><a href="#assign" data-toggle='tab'>Assign SMS</a></li>
							<li><a href="#view" data-toggle='tab'>Update SMS</a></li>
							<li><a href="#email_assign" data-toggle='tab'>Assign Email</a></li>
							<li><a href="#email_view" data-toggle='tab'>Update Email</a></li>
						</ul>
					<!--</div>
					<div class="panel-body">-->
   						<div class="tab-content">
							<div class="chart tab-pane in active" id="assign">
								<div class="col-lg-12 page-header">
									<label for="" class="col-sm-2 control-label">Post :</label>
									
									<div class="col-sm-3">
										<select class="form-control cmbProgramSelect"  name="cmbProgramSelect[]" title="Select Post" id="cmbProgramSelect" multiple="multiple">
										</select>
									</div>
								</div>
								<div class="col-lg-12">
									<table class="table table-striped table-bordered" id="dtblProgramSms" width="100%">
										<thead>
											<tr>
												<th >#</th>
												<th >SMS Type Code</th>
												<th >SMS Type</th>
												<th >
													<label class="control control--checkbox" style="margin-top: 5px;">  
														<input type="checkbox" type="checkbox" class="tooltiptext" title="Select All"  id="chksmsAll" name="chksmsAll" value=""/>
														<div class="control__indicator"></div>
													</label>
												</th>
												<th hidden="hidden" >ID</th><!-- id will be hide -->
											</tr>
										</thead>
									</table>
									<button type="button" class="btn btn-success " name="btnUpdateMultiple" id="btnUpdateMultiple" /><i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;Assign</<button>
								</div>
							</div>	
							<div class="chart tab-pane" id="view">
								<div class="col-lg-12 page-header">
									<label for="" class="col-sm-2 control-label">Post :</label>
									
									<div class="col-sm-4">
										<select class="form-control"  name="cmbProgramFilter" title="Select Post" id="cmbProgramFilter">
										</select>
									</div>
								</div>
								<div class="col-lg-12">
									<table class="table table-striped table-bordered" id="dtblProgramSmsSingle" width="100%">
										<thead>
											<tr>
												<th >#</th>
												<th >SMS Type Code</th>
												<th >SMS Type</th>
												<th >
													<label class="control control--checkbox" style="margin-top: 5px;">  
														<input type="checkbox" type="checkbox" class="tooltiptext" title="Select All"  id="chksmsUpdate" name="chksmsUpdate" value=""/>
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
							<div class="chart tab-pane" id="email_assign">
								<div class="col-lg-12 page-header">
									<label for="" class="col-sm-2 control-label">Post:</label>
									
									<div class="col-sm-3">
										<select class="form-control cmbSelectProgram"  name="cmbSelectProgram[]" title="Select Post" id="cmbSelectProgram" multiple="multiple">
										</select>
									</div>
									<input type="hidden" class="form-control" id="hidUniqueidEdit" name="hidUniqueidEdit">
								</div>
								<div class="col-lg-12">
									<table class="table table-striped table-bordered" id="tblAssignEmail"width="100%">
										<thead>
											<tr>
												<th >#</th>
												<th >Email Type</th>
												<th >
													<label class="control control--checkbox" style="margin-top: 5px;">  
														<input type="checkbox" type="checkbox" class="tooltiptext" title="Select All"  id="chkEmailAll" name="chkEmailAll" value=""/>
														<div class="control__indicator"></div>
													</label>
												</th>
												<th hidden="hidden" >ID</th><!-- id will be hide -->
												<th hidden="hidden" >ID</th><!-- id will be hide -->
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
									<button type="button" class="btn btn-success" name="btnAssignEmail" id="btnAssignEmail" /><i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;Assign</button>
								</div>
							</div>
							
							<div class="chart tab-pane" id="email_view">
								<div class="col-lg-12 page-header">
									<label for="" class="col-sm-2 control-label">Post:</label>
									
									<div class="col-sm-4">
										<select class="form-control"  name="cmbFilter" id="cmbFilter" title="Select Post">
										</select>
									</div>
									<input type="hidden" class="form-control" id="hidUniqueidEdit" name="hidUniqueidEdit">
								</div>
								<div class="col-lg-12">
									<table class="table table-striped table-bordered" id="tblProgramDocument"width="100%">
										<thead>
											<tr>
												<th >#</th>
												<th >Email Type</th>
												<th >
													<label class="control control--checkbox" style="margin-top: 5px;">  
														<input type="checkbox" type="checkbox" class="tooltiptext" title="Select All"  id="chkEmailUpdate" name="chkEmailUpdate" value=""/>
														<div class="control__indicator"></div>
													</label>
												</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<button type="button" class="btn btn-warning" name="btnUpdateMenu" id="btnUpdateMenu" /><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Update</button>
							</div>
						</div>
					</div>	
					<!--</div>
				</div>-->
			</div>
		</form>
	</div><!-- /.row -->
</div><!-- /#page-wrapper -->
		
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/communication_setup.js"></script>

