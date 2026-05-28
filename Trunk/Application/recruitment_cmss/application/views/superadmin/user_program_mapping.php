			
			<style>
				.multiselect
				{
					width: 145%;
				} 
			</style>
			<div class="content-wrapper">
				<div class="row">
					<!--<div class="col-lg-12">
						<h1 class="page-header">User Post Mapping:</h1>
					</div>-->
					<!--<section class="content-header">
				      	<h1>
				        	User Post Mapping
				      	</h1>
				    </section>-->
				    <section class="content">
						<div class="row">
							<div class="col-lg-12 " style="padding-top:10px;">
								<div class="panel panel-default">	
									<div class="panel-body box box-default">
										<div class="col-lg-12 form-group">
											<label  for="" class="col-sm-2  control-label"><i style="color:red;font-size:15px;margin-right: 3px;">*</i>Organization:</label>
											<div class="col-sm-2">
												<select class="form-control"  name="cmbInstitute" title="Select Organization" id="cmbInstitute">
												</select>
											</div>
											<label  for="" class="col-sm-1 control-label"><i style="color:red;font-size:15px; margin-right: 3px;">*</i>User:</label>
											<div class="col-sm-2">
												<select class="form-control cmbUserSelect"  name="cmbUserSelect[]" title="Select User" id="cmbUserSelect" multiple="multiple">
												</select>
											</div>
											<label  for="" class="col-sm-1 control-label" style="margin-left: 35px;"><i style="color:red;font-size:15px;margin-right: 3px;">*</i>Post:</label>
											
											<div class="col-sm-2">
												<select class="form-control cmbProgramSelect"  name="cmbProgramSelect[]" title="Select Post" id="cmbProgramSelect" multiple="multiple">
												</select>
											</div>
											<div class="col-sm-1" style="margin-left: 48px;">
												<button type="button" class="btn btn-warning" name="btnAssign" id="btnAssign" title="Assign"> <i class="fa fa-tasks"></i></button>
											</div>
										</div>	
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="dtblUserProgram" width="100%">
												<thead>
													<tr>
														<th >#</th>
														<th hidden>User Code</th>
														<th >User</th>
														<th >Post</th>
														<th >Action</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
										<div class="modal fade" id="UserProgramEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
															&times;
														</button>
														<h4 class="modal-title" id="myModalLabel">Manage Post <label style="color: #00ff00" id="lblUserName"></label></h4>
													</div>
													<div class="modal-body">
														<form class="form-horizontal" role="form"  id="frmEditUserProgram" name="frmEditUserProgram">
															<input type="hidden" class="form-control tooltips" id="hidUserCode" name="hidUserCode">
															<table class="table table-striped table-bordered" id="dtblManageProgram" width="100%">
																<thead>
																	<tr>
																		<th >Sl No</th>
																		<th hidden>Post Code</th>
																		<th >Post</th>
																		<th >Action</th>
																	</tr>
																</thead>
																<tbody>

																</tbody>
															</table>
														</form>
													</div>	
												</div>
											</div>
										</div>	
									</div>
								</div>
							</div>	
						</div>
					</section>		
				</div><!-- /.row -->
			</div>
			<script type="text/javascript" language="javascript" src="<?=base_url()?>public/assets/js/superadmin/user_program_mapping.js"></script>