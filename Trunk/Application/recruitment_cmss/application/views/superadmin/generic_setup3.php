<style>
	.modal-dialog{
		width: 50%;
	}
</style>
<div class="content-wrapper">
	<div class="row">
		<br />
		<div class="col-lg-12">
			<!--<div class="panel with-nav-tabs panel-primary">
				<div class="panel-heading">-->
				<div class="nav-tabs-custom box box-default">
					<ul class="nav nav-tabs" role="tablist">
						<li class="active"><a href="#template" data-toggle='tab'><b>Registration Template</b></a></li>
						<li><a href="#profile_template" data-toggle='tab'><b>Profile Template</b></a></li>
						
					</ul>
				<!--</div>
				<div class="panel-body">-->
	   				<div class="tab-content">
						<div class="chart tab-pane in active" id="template">
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblRegistrationTemplate"width="100%">
									<thead>
										<tr>
											<th >#</th>
											<th >Code</th>
											<th >Name</th>
											<th >Description</th>
											<th >File Name</th>
											<th >File Name</th>
											<th >ID</th><!-- id will be hide -->
											<th >Action</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
						</div>
						<div class="modal fade" id="registrationTemplateAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Add Registration Template</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form"  id="frmRegistrationAddTemplate" name="frmAddTemplate">
											<div id="errorlog_regd_temp_add" style="display: none; color: red; font-size: 12px;"></div>
											<input type="hidden" id="hidRegdTempAdd" name="hidRegdTempAdd">
											<input type="hidden" class="form-control" id="hidUniqueidRegistration" name="hidUniqueidRegistration">
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Code</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtRegistrationTemplateCode" name="txtRegistrationTemplateCode" title="Code of Template" placeholder="Unique Code of Template">
												</div>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtRegistrationTemplateName" name="txtRegistrationTemplateName" placeholder="Name Of Template" title="Name Of Template">
												</div>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Description</label>
												<div class="col-sm-9">
													<textarea name="textRegistrationTemplateDescription" id="textRegistrationTemplateDescription" class="form-control" cols="80" rows="3"></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">File Name:</label>
												<div class="col-sm-9">
													<select class="form-control" id="txtRegistrationFileName" name="txtRegistrationFileName">

													</select>
												</div>
											</div>
											<!--<div class="form-group">
												<label for="" class="col-sm-2 control-label"><i style="color:red;font-size:15px;">*</i> File Name</label>
												<div class="col-sm-10">
													
													<select class="form-control" id = "txtRegistrationFileName" name="txtRegistrationFileName">
													
													</select> 
												</div>
											</div>-->
											
											<div class="modal-footer">
												<span id="spanProcessingRegdTempAdd" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" ><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="registrationTemplateEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Edit Registration Template</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form" id = "frmRegistrationTemplateEdit" name = "frmTemplateEdit">
											<div id="errorlog_regd_temp_edit" style="display: none; color: red; font-size: 12px;"></div>
											<input type="hidden" id="hidRegdTempEdit" name="hidRegdTempEdit">
											<div class="form-group">
												<div class="col-sm-9">
													<input type="hidden" class="form-control" id="hidUniqueidEditRegistration" name="hidUniqueidEditRegistration">
												</div>
											</div>
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Code</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtRegistrationTemplateCodeEdit" name="txtRegistrationTemplateCodeEdit" title="Code of Template" placeholder="Unique Code of Template" readonly="">
												</div>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtRegistrationTemplateNameEdit" name="txtRegistrationTemplateNameEdit" placeholder="Name Of Template" title="Name Of Template">
												</div>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Description</label>
												<div class="col-sm-9">
													<textarea name="textRegistrationTemplateDescriptionEdit" id="textRegistrationTemplateDescriptionEdit" class="form-control" cols="80" rows="3" value=""></textarea>
												</div>
											</div>
											

											
											
											
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> File Name</label>
												<div class="col-sm-9">
													<!--<input type="text" class="form-control tooltips" id="txtFileNameEdit" name="txtFileNameEdit" placeholder="File Name" title="File Name">-->
													<select class="form-control" id = "txtRegistrationFileNameEdit" name="txtRegistrationFileNameEdit">
													    
													</select> 
												</div>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingRegdTempEdit" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" ><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="registrationTemplateDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
										<button type="button" class="btn btn-danger" id="templateRegistrationDeleteRecord"><i class='fa fa-trash'></i>  Delete</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="templateDeleteModalError" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Delete record</h4>
									</div>
									<div class="modal-body">
										<center><h2>This template is used in some programs. So, first unassign this template from the program and then delete it.</h2></center>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary" id="closeDeleteRecord"><i class="fa fa-close"></i>  Close</button>
									</div>
								</div>
							</div>
						</div>	
				
						<!--Profile Template Tab -->
						<div class="chart tab-pane" id="profile_template">
							
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblTemplateMaster"width="100%">
									<thead>
										<tr>
											<th >#</th>
											<th >Code</th>
											<th >Name</th>
											<th >Description</th>
											<th >File Name</th></th>
											<th >File Name</th></th>
											<th >ID</th><!-- id will be hide -->
											<th >Action</th></th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
						</div>
						<div class="modal fade" id="templateAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Add Profile Template</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form"  id="frmAddTemplate" name="frmAddTemplate">
											<div id="errorlog_prof_temp_add" style="display: none; color: red; font-size: 12px;"></div>
											<input type="hidden" id="hidProfTempAdd" name="hidProfTempAdd">
											<div class="form-group">
												<div class="col-sm-9">
													<input type="hidden" class="form-control" id="hidUniqueid" name="hidUniqueid">
												</div>
											</div>
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Code</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtTemplateCode" name="txtTemplateCode" title="Code of Template" placeholder="Unique Code of Template">
												</div>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtTemplateName" name="txtTemplateName" placeholder="Name Of Template" title="Name Of Template">
												</div>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Description</label>
												<div class="col-sm-9">
													<textarea name="textTemplateDescription" id="textTemplateDescription" class="form-control" cols="80" rows="3"></textarea>
												</div>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> File Name</label>
												<div class="col-sm-9">
													<!--<input type="text" class="form-control tooltips" id="txtFileName" name="txtFileName" placeholder="File Name" title="File Name">-->
													<select class="form-control" id = "txtFileName" name="txtFileName">
													</select> 
												</div>
											</div>
											
											<div class="modal-footer">
												<span id="spanProcessingProfTempAdd" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" ><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="templateEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Edit Profile Template</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form" id = "frmTemplateEdit" name = "frmTemplateEdit">
											<div id="errorlog_prof_temp_edit" style="display: none; color: red; font-size: 12px;"></div>
											<input type="hidden" id="hidProfTempEdit" name="hidProfTempEdit">
											<div class="form-group">
												<div class="col-sm-9">
													<input type="hidden" class="form-control" id="hidUniqueidEdit" name="hidUniqueidEdit">
												</div>
											</div>
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Code</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtTemplateCodeEdit" name="txtTemplateCodeEdit" title="Code of Template" placeholder="Unique Code of Template" readonly="">
												</div>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtTemplateNameEdit" name="txtTemplateNameEdit" placeholder="Name Of Template" title="Name Of Template">
												</div>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Description</label>
												<div class="col-sm-9">
													<textarea name="textTemplateDescriptionEdit" id="textTemplateDescriptionEdit" class="form-control" cols="80" rows="3" value=""></textarea>
												</div>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> File Name</label>
												<div class="col-sm-9">
													<!--<input type="text" class="form-control tooltips" id="txtFileNameEdit" name="txtFileNameEdit" placeholder="File Name" title="File Name">-->
													<select class="form-control" id = "txtFileNameEdit" name="txtFileNameEdit">
													
													</select> 
												</div>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingProfTempEdit" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" ><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="templateDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Delete Profile Template</h4>
									</div>
									<div class="modal-body">
										<center><h2>Do You Want to Delete This Record?</h2></center>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" id="templateDeleteRecord"><i class='fa fa-trash'></i>  Delete</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="deleteModalError" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Delete record</h4>
									</div>
									<div class="modal-body">
										<center><h2>This template is used in some programs. So, first unassign this template from the program and then delete it.</h2></center>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary" id="closetemplateDeleteRecord"><i class="fa fa-close"></i>  Close</button>
									</div>
								</div>
							</div>
						</div>	
					</div>
				</div>	
				<!--</div>
			</div>-->
		</div>
	</div>
</div>
<script type="text/javascript" src="<?=base_url()?>public/assets/js/superadmin/generic_setup3.js"></script>