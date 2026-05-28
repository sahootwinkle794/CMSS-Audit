<?php
//print_r($program_group['program_group_code']);die();

$program_group_code = $program_group['program_group_code'];
?>
<style>
	.modal-dialog{
		width: 50%;
	}
	.modalExbottom
	{
		color: #a66;
	}
	.form-padding {
	    padding: 0px 10px 3px 35px;
	}
</style>
<div class="content-wrapper">
				<div class="row">
					<!--<div class="col-lg-12">
						<h1 class="page-header">Generic Setup 1:</h1>
					</div>-->
					<!--<section class="content-header">
				      	<h1>
				        	Generic Setup 1
				      	</h1>
				    </section>-->
					<div class="col-lg-12">
						<!--<div class="panel with-nav-tabs panel-primary">
            				<div class="panel-heading">-->
            				<div class="nav-tabs-custom box box-default">
								<ul class="nav nav-tabs" role="tablist">
								
									<li class="active"><a href="#program_group" data-toggle='tab'><b>Recruitment Drive</b></a></li>
									<li><a href="#template" data-toggle='tab'><b>Template</b></a></li>
									<!--<li><a href="#menu" data-toggle='tab'><b>Menu</b></a></li>-->
									<li><a href="#document" data-toggle='tab'><b>Document</b></a></li>
									<!--TAB CREATION OF SELECTED DOCUMENT -->
									<!--<li><a href="#selected_document" data-toggle='tab'><b>Selected Document</b></a></li>-->
									<!-- SELECTED DOCUMENT-->
									<li><a href="#category" data-toggle='tab'><b>Category</b></a></li>
									<!--<li><a href="#minority_community" data-toggle='tab'><b>Minority Community</b></a></li>-->
									<!--<li><a href="#caste" data-toggle='tab'><b>Caste</b></a></li>
									<li><a href="#religion" data-toggle='tab'><b>Religion</b></a></li>-->
									<!--<li><a href="#instruction" data-toggle='tab'><b>Instruction</b></a></li>-->
									
								</ul>
							<!--</div>
							<div class="panel-body">-->
		           				<div class="tab-content">
									<div class="chart tab-pane" id="template">
										<!--<div class="col-lg-12">
											<h1 class="page-header">Define Template Setup:</h1>
										</div>-->
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="tblTemplateMaster"width="100%">
												<thead>
													<tr>
														<th >#</th>
														<th >Code</th>
														<th >Name</th>
														<th >Description</th>
														<th >File Name</th></th>
														<th >ID</th><!-- id will be hide -->
														<th>Action</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="templateAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog" style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Add Template</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form"  id="frmAddTemplate" name="frmAddTemplate">
														<div class="form-group">
															<div class="col-sm-10">
																<input type="hidden" class="form-control" id="hidUniqueid" name="hidUniqueid">
															</div>
														</div>
														<div class="form-group">
															<label for="inputname" class="col-sm-2 control-label"><i style="color:red;font-size:15px;">*</i> Code</label>
															<div class="col-sm-10">
																<input type="text" class="form-control tooltips" id="txtTemplateCode" name="txtTemplateCode" title="Code of Template" placeholder="Unique Code of Template" maxlength="8">
															</div>
															<p class="modalExbottom" style="margin-left: 140px;">Ex: TEMP0010, TEMP0011</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-2 control-label"><i style="color:red;font-size:15px;">*</i> Name</label>
															<div class="col-sm-10">
																<input type="text" class="form-control tooltips" id="txtTemplateName" name="txtTemplateName" placeholder="Name Of Template" title="Name Of Template" maxlength="50">
															</div>
															<p class="modalExbottom" style="margin-left: 140px;">Ex: template010, template011</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-2 control-label"><i style="color:red;font-size:13px;">*</i>Description</label>
															<div class="col-sm-10">
																<textarea name="textTemplateDescription" id="textTemplateDescription" class="form-control" cols="80" rows="3"></textarea>
															</div>
															<p class="modalExbottom" style="margin-left: 140px;">Describe about the template</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-2 control-label"><i style="color:red;font-size:15px;">*</i> File Name</label>
															<div class="col-sm-10">
																<!--<input type="text" class="form-control tooltips" id="txtFileName" name="txtFileName" placeholder="File Name" title="File Name">-->
																<select class="form-control" id = "txtFileName" name="txtFileName">
																      <option value="" selected="selected">Select Template</option>
																  <?php 
																       foreach(glob(dirname(__FILE__) . '/../../template*.*') as $filename){
																       $filename = basename($filename);
																       echo "<option value='" . $filename . "'>".$filename."</option>";
																    }
																?>
																</select> 
															</div>
														</div>
														
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" ><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="templateEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog" style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Edit Template</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form" id = "frmTemplateEdit" name = "frmTemplateEdit">
														<div class="form-group">
															<div class="col-sm-10">
																<input type="hidden" class="form-control" id="hidUniqueidEdit" name="hidUniqueidEdit">
															</div>
														</div>
														<div class="form-group">
															<label for="inputname" class="col-sm-2 control-label"><i style="color:red;font-size:15px;">*</i> Code</label>
															<div class="col-sm-10">
																<input type="text" class="form-control tooltips" id="txtTemplateCodeEdit" name="txtTemplateCodeEdit" title="Code of Template" placeholder="Unique Code of Template" readonly="">
															</div>
															<p class="modalExbottom" style="margin-left: 140px;">Ex: TEMP0010, TEMP0011</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-2 control-label"><i style="color:red;font-size:15px;">*</i> Name</label>
															<div class="col-sm-10">
																<input type="text" class="form-control tooltips" id="txtTemplateNameEdit" name="txtTemplateNameEdit" placeholder="Name Of Template" title="Name Of Template" maxlength = "50">
															</div>
															<p class="modalExbottom" style="margin-left: 140px;">Ex: template010, template011</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-2 control-label"><i style="color:red;font-size:13px;">*</i>Description</label>
															<div class="col-sm-10">
																<textarea name="textTemplateDescriptionEdit" id="textTemplateDescriptionEdit" class="form-control" cols="80" rows="3" value=""></textarea>
															</div>
															<p class="modalExbottom" style="margin-left: 140px;">Describe about the template</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-2 control-label"><i style="color:red;font-size:15px;">*</i> File Name</label>
															<div class="col-sm-10">
																<!--<input type="text" class="form-control tooltips" id="txtFileNameEdit" name="txtFileNameEdit" placeholder="File Name" title="File Name">-->
																<select class="form-control" id = "txtFileNameEdit" name="txtFileNameEdit">
																      <option value="">Select Template</option>
																  <?php 
																       foreach(glob(dirname(__FILE__) . '/../../template*.*') as $filename){
																       $filename = basename($filename);
																       echo "<option value='" . $filename . "'>".$filename."</option>";
																    }
																?>
																</select> 
															</div>
														</div>
														<div class="modal-footer">
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
													<h4 class="modal-title" id="myModalLabel">Delete record</h4>
												</div>
												<div class="modal-body">
													<center><h2>Do You Want to Delete This Record?</h2></center>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" id="templateDeleteRecord"><i class="fa fa-trash"></i>  Delete</button>
													<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
												</div>
											</div>
										</div>
									</div>	
									<!--Menu Tab -->
									<div class="chart tab-pane" id="menu">
										<!--<div class="col-lg-12">
											<h1 class="page-header">Define Program Menu:</h1>
										</div>-->
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="tblMenuMaster" width="100%">
												<thead>
													<tr>
														<th>#</th>
														<th>Code</th>
														<th>Name</th>
														<th>Link URL</th>
														<th>Is New Window</th>
														<th>Is Document Upload</th>
														<th>Status</th>
														<th>Menu Slno</th>
														<th>ID</th> <!-- ID WILL BE HIDE -->
														<th >Action</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="menuAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog"style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Add Menu</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form"  id="frmMenuAdd" name="frmMenuAdd">
														<div id="errorlog_menu_add" style="display: none; color: red; font-size: 12px;"></div>
														<div class="form-group">
															<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Menu Code</label>
															<div class="col-sm-9">
																<input type="hidden" id="hidOperProgramMenu" name="hidOperProgramMenu">
																<input type="text" class="form-control tooltips" id="txtMenuCode" name="txtMenuCode" title="Menu Code" placeholder="Unique Code Of Menu" maxlength = "8">
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: APPL, ADMIT CARD</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Menu Name</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtLinkText" name="txtLinkText" placeholder="Menu Name" title="Menu Name" maxlength="50">
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: Application, Admit Card</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Link URL</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtLinkURL" name="txtLinkURL" placeholder="Link URL" title="Link URL" maxlength="100">
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: admin/application, admin/admit_card</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Is New Window</label>
															<div class="col-sm-9">
																<select class="form-control tooltips" id="cmbNewWindow" name="cmbNewWindow" title="Open in New Window">
																	<option value="Yes">Yes</option>
																	<option value="No" selected>No</option>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Is Document Upload</label>
															<div class="col-sm-9">
																<select class="form-control tooltips" id="cmbDocumentUpload" name="cmbDocumentUpload" title="Document Upload Require ?">
																	<option value="Yes" >Yes</option>
																	<option value="No" selected>No</option>
																</select>
															</div>
														</div>
														
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Record Status</label>
															<div class="col-sm-9">
																<select class="form-control tooltips" id="cmbRecordStatus" name="cmbRecordStatus" title="Select Status">
																	<option value="Active" selected>Active</option>
																	<option value="Inactive">Inactive</option>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Menu Slno</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtProgramMenuSlno" name="txtProgramMenuSlno" placeholder="Menu Serial Number" title="Menu Serial Number" maxlength = "10">
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: 0, 1,.... Serial Wise</p>
														</div>
														<div class="modal-footer">
														    <span id="spanProcessingMenu" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
															<button type="submit" class="btn btn-primary" id="menuAddSave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="menuEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog"style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Edit Menu</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form" id="frmMenuEditModal" name="frmMenuEditModal">
														<div class="form-group">
															<div class="col-sm-10">
																<input type="hidden" id="hidOperProgramMenuEdit" name="hidOperProgramMenuEdit">
																<input type="hidden" class="form-control" id="hidUniqueidEditMenu" name="hidUniqueidEditMenu" >
															</div>
														</div>
														<div id="errorlog_menu_edit" style="display: none; color: red; font-size: 12px;"></div>
														<div class="form-group">
															<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Menu Code</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtMenuCodeEdit" name="txtMenuCodeEdit" title="Menu Code" placeholder="Unique Code Of Menu" readonly>
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: APPL, ADMIT CARD</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Menu Name</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtLinkTextEdit" name="txtLinkTextEdit" placeholder="Menu Name" title="Menu Name" maxlength = "50">
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: Application, Admit Card</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Link URL</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtLinkURLEdit" name="txtLinkURLEdit" placeholder="Link URL" title="Link URL" maxlength="100">
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: admin/application, admin/admit_card</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Is New Window</label>
															<div class="col-sm-9">
																<select class="form-control tooltips" id="cmbNewWindowEdit" name="cmbNewWindowEdit" title="Open in New Window">
																	<option value="">Select</option>
																	<option value="Yes">Yes</option>
																	<option value="No">No</option>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Is Document Upload</label>
															<div class="col-sm-9">
																<select class="form-control tooltips" id="cmbDocumentUploadEdit" name="cmbDocumentUploadEdit" title="Document Upload Require ?">
																	<option value="Yes">Yes</option>
																	<option value="No">No</option>
																</select>
															</div>
														</div>
														
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Record Status</label>
															<div class="col-sm-9">
																<select class="form-control tooltips" id="cmbRecordStatusEdit" name="cmbRecordStatusEdit" title="Select Status">
																	<option value="Active">Active</option>
																	<option value="Inactive">Inactive</option>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Menu Slno</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtProgramMenuSlnoEdit" name="txtProgramMenuSlnoEdit" placeholder="Menu Serial Number" title="Menu Serial Number">
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: 0, 1,.... Serial Wise</p>
														</div>
														<div class="modal-footer">
															<span id="spanProcessingMenuEdit" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
															<button type="submit" class="btn btn-primary" id="menuEditSave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="menuDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
													<button type="button" class="btn btn-danger" id="menuDeleteRecord"><i class="fa fa-trash"></i>  Delete</button>
													<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
												</div>
											</div>
										</div>
									</div>	
									<!-- For Program Group Tab -->
									<div class="chart tab-pane in active" id="program_group">
										<!--<div class="col-lg-12">
											<h1 class="page-header">Define Program Group:</h1>
										</div>-->
										<div class="col-lg-12">
											<table class="table table-striped table-bordered"  id="tblProgramGroup" width="100%">
												<thead>
													<tr>
														<th>#</th>
														<th>Code</th>
														<th>Name</th>
														<th>Last Date of Application</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="programGroupAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog"style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Create Recruitment Drive</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form"  id="frmAddProgramGroup" name="frmAddProgramGroup">
														<input type="hidden" name="hidfrmAddProgramGroupToken" id="hidfrmAddProgramGroupToken" value="<?php echo generateToken('frmAddProgramGroup');?>"/>
														<input type="hidden"  id="hidOperProgramGroup" name="hidOperProgramGroup">
														<input type="hidden"  id="hidProgramGroupCode" name="hidProgramGroupCode" value="<?php echo $program_group_code; ?>">
														<div id="errorlog_group" style="display: none; color: red; font-size: 12px;"></div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Drive Code</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtProgramGroupCode" name="txtProgramGroupCode" placeholder="Enter Drive Code" title="Enter Program Group" maxlength = "50" value="<?php echo $program_group_code; ?>" readonly>
															</div>
															
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Drive Name</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtProgramGroupName" name="txtProgramGroupName" placeholder="Enter Drive Name" title="Enter Drive Name" maxlength="50">
																<p class="modalExbottom">Ex: Clerk, Officer</p>
															</div>
															
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Last Date of &nbsp;&nbsp;&nbsp;Application</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtLastDate" name="txtLastDate" readonly placeholder="Enter Last Date" title="Last Date of Application">
															</div>
															
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Status</label>
															<div class="col-sm-9">
																<select class="form-control tooltips" id="cmbStatus" name="cmbStatus" title="Pick Status">
																	<option value="">Select</option>
																	<option value="1">Active</option>
																	<option value="0">Inactive</option>
																</select>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="centreaddsave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="programGroupEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog"style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Edit Recruitment Drive</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form"  id="frmEditProgramGroup" name="frmEditProgramGroup">
														<input type="hidden" name="hidfrmEditProgramGroupToken" id="hidfrmEditProgramGroupToken" value="<?php echo generateToken('frmEditProgramGroup');?>"/>
														<div id="errorlog_group_edit" style="display: none; color: red; font-size: 12px;"></div>
														<input type="hidden"  id="hidOperProgramGroupEdit" name="hidOperProgramGroupEdit">
														<input type="hidden" class="form-control tooltips" id="hidProgramGroupCodeEdit" name="hidProgramGroupCodeEdit">
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Drive Code</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtProgramGroupCodeEdit" name="txtProgramGroupCodeEdit" placeholder="Enter Drive Code" title="Enter Drive Code" readonly>
																<p class="modalExbottom">Ex: CLERK, OFFICER</p>
															</div>
															
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Drive Name</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtProgramGroupNameEdit" name="txtProgramGroupNameEdit" placeholder="Enter Drive Name" title="Enter Drive Name" maxlength="100">
																<p class="modalExbottom">Ex: Clerk, Officer</p>
															</div>
															
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Last Date of &nbsp;&nbsp;&nbsp;Application</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtLastDateEdit" name="txtLastDateEdit" readonly placeholder="Enter Last Date" title="Last Date of Application">
															</div>
															
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Status</label>
															<div class="col-sm-9">
																<select class="form-control tooltips" id="cmbStatusEdit" name="cmbStatusEdit" title="Pick Status">
																	<option value="">Select</option>
																	<option value="1">Active</option>
																	<option value="0">Inactive</option>
																</select>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="centreaddsave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="programGroupDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<input type="hidden" id="hidProgramGroupCodeDelete" name="hidProgramGroupCodeDelete"/>
													<h4 class="modal-title" id="myModalLabel">Delete record</h4>
												</div>
												<div class="modal-body">
													<center><h2>Do You Want to Delete This Record?</h2></center>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" id="groupDeleteRecord"><i class="fa fa-trash"></i>  Delete</button>
													<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
												</div>
											</div>
										</div>
									</div>
									<!-- For Document Tab -->
									<div class="chart tab-pane" id="document">
										<!--<div class="col-lg-12">
											<h1 class="page-header">User Document:</h1>
										</div>-->
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="tblDocumentMaster" width="100%">
												<thead>
													<tr>
														<th>#</th>
														<th>Code</th>
														<th>Name</th>
														<th>Description</th>
														<th>Size Description</th>
														<th>Size in KB</th>
														<th>Preview Height</th>
														<th>Preview Width</th>
														<th>ID</th> <!-- ID WILL BE HIDE -->
														<th>TYPE</th>
														<th>Action</th>
														
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="documentAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog">
											<div class="modal-content" style="width: 150%;margin-left: -150px;">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Add Document</h4>
												</div>
												<div id="errorlog_document" style="display: none; color: red; font-size: 12px;"></div>
												<div class="modal-body">
													<form class="form-horizontal form-padding" role="form"  id="frmDocumentAdd" name="frmDocumentAdd">
														<div class="row col-sm-12 col-xs-12 ">
															<div class="col-sm-6 col-xs-6">
																<div class="form-group">
																	<label for="inputname" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Doc Code</label>
																	<div class="col-sm-8">
																		<input type="hidden" id="hidOperDocument" name="hidOperDocument">
																		<input type="text" class="form-control tooltips" id="txtDocumentCode" name="txtDocumentCode" title="Document Code" maxlength = "20" placeholder="Unique Code Of Document">
																	</div>
																	<p class="modalExbottom" style="margin-left: 180px;">Ex: APPL_FORM, CERTIFICATE</p>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Doc Name</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control tooltips" id="txtDocumentName" name="txtDocumentName" placeholder="Document Name" maxlength="50" title="Document Name">
																	</div>
																	<p class="modalExbottom" style="margin-left: 180px;">Ex: Application Form, Certificate</p>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Doc Type</label>
																	<div class="col-sm-8">
																		<select class="form-control" id="cmbDocumentTypeAdd" name="cmbDocumentTypeAdd" title="Choose Document Type">	
																		</select>
																	</div>
																	<p class="modalExbottom" style="margin-left: 180px;">Select Doc type</p>
																</div>
																
																<div class="form-group">
																	<label for="" class="col-sm-2 control-label">Doc Description</label>
																	<div class="col-sm-10">
																		<textarea id="txtDocumentDesc"  class="form-control" name="txtDocumentDesc"></textarea>
																	</div>
																	<p class="modalExbottom" style="margin-left: 180px;">Describe about the document</p>
																</div>
															</div>
															<div class="col-sm-6 col-xs-6">
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label">Doc Size(In KB)</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control tooltips" onkeypress="return isNumber(event)" id="txtDocumentSize" name="txtDocumentSize" >
																	</div>
																	<p class="modalExbottom" style="margin-left: 180px;">Ex: 10, 20</p>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label">Doc Preview Height</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control tooltips" onkeypress="return isNumber(event)" id="txtDocumentHeight" name="txtDocumentHeight" >
																	</div>
																	<p class="modalExbottom" style="margin-left: 180px;">Ex: 100px, 200px</p>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label">Doc Preview Width</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control tooltips" onkeypress="return isNumber(event)" id="txtDocumentWidth" name="txtDocumentWidth" >
																	</div>
																	<p class="modalExbottom" style="margin-left: 180px;">Ex: 100px, 200px</p>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-2 control-label">Doc Size Description</label>
																	<div class="col-sm-10">
																		<textarea id="txtDocumentSizeDesc"  class="form-control" name="txtDocumentSizeDesc"></textarea>
																	</div>
																	<p class="modalExbottom" style="margin-left: 180px;">Describe about document size</p>
																</div>
															</div>
														</div>
																<div class="modal-footer">
																	<button type="submit" class="btn btn-primary" id="documentAddSave"><i class="fa fa-save"></i>  Save</button>
																	<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
																</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="documentEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog">
											<div class="modal-content" style="width: 150%;margin-left: -150px;">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Edit Document</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal form-padding" role="form" id="frmDocumentEdit" name="frmDocumentEdit">
														<div class="form-group">
															<div class="col-sm-10">
																<input type="hidden" id="hidOperDocumentEdit" name="hidOperDocumentEdit">
																<input type="hidden" class="form-control" id="hidDUniqueidEdit" name="hidDUniqueidEdit">
															</div>
														</div>
														<div id="errorlog_document_edit" style="display: none; color: red; font-size: 12px;"></div>
														<div class="row col-sm-12 col-xs-12 ">
															<div class="col-sm-6 col-xs-6">		
																<div class="form-group">
																	<label for="inputname" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Doc Code</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control tooltips" id="txtDocumentCodeEdit" readonly="" name="txtDocumentCodeEdit" maxlength = "20" title="Document Code" placeholder="Unique Code Of Document">
																	</div>
																	<p class="modalExbottom" style="margin-left: 180px;">Ex: APPL_FORM, CERTIFICATE</p>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Doc Name</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control tooltips" id="txtDocumentNameEdit" name="txtDocumentNameEdit" maxlength = "50" placeholder="Document Name" title="Document Name">
																	</div>
																	<p class="modalExbottom" style="margin-left: 180px;">Ex: Application Form, Certificate</p>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Doc Type</label>
																	<div class="col-sm-8">
																		<select class="form-control selectpicker" data-live-search="true" id="cmbDocumentTypeEdit" name="cmbDocumentTypeEdit" title="Choose Document Type">	
																		</select>
																	</div>
																	<p class="modalExbottom" style="margin-left: 180px;">Select Doc type</p>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-2 control-label">Doc Description</label>
																	<div class="col-sm-10">
																		<textarea id="txtDocumentDescEdit"   class="form-control" name="txtDocumentDescEdit"></textarea>
																	</div>
																	<p class="modalExbottom" style="margin-left: 180px;">Describe about the document</p>
																</div>
															</div>
															<div class="col-sm-6 col-xs-6">	
																
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label">Doc Size(In KB)</label>
																	<div class="col-sm-8">
																		<input type="text" onkeypress="return isNumber(event)" class="form-control tooltips" id="txtDocumentSizeEdit" name="txtDocumentSizeEdit" >
																	</div>
																	<p class="modalExbottom" style="margin-left: 180px;">Ex: 10, 20</p>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label">Doc Preview Height</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control tooltips" onkeypress="return isNumber(event)" id="txtDocumentHeightEdit" name="txtDocumentHeightEdit" >
																	</div>
																	<p class="modalExbottom" style="margin-left: 180px;">Ex: 100px, 200px</p>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label">Doc Preview Width</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control tooltips" onkeypress="return isNumber(event)" id="txtDocumentWidthEdit" name="txtDocumentWidthEdit" >
																	</div>
																	<p class="modalExbottom" style="margin-left: 180px;">Ex: 100px, 200px</p>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-2 control-label">Doc Size Description</label>
																	<div class="col-sm-10">
																		<textarea id="txtDocumentSizeDescEdit"  class="form-control" name="txtDocumentSizeDescEdit"></textarea>
																	</div>
																	<p class="modalExbottom" style="margin-left: 180px;">Describe about the document size</p>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="documentEditSave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="documentDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
													<button type="button" class="btn btn-danger" id="documentDeleteRecord"><i class="fa fa-trash"></i>  Delete</button>
													<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
												</div>
											</div>
										</div>
									</div>
									<!-- FOR SELECTED DOCUMENT TAB -->
									<div class="chart tab-pane" id="selected_document">
										<!--<div class="col-lg-12">
											<h1 class="page-header">User Document:</h1>
										</div>-->
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="tblsDocumentMaster" width="100%">
												<thead>
													<tr>
														<th >#</th>
														<th >Code</th>
														<th >Name</th>
														<th >Description</th>
														<th >Size Description</th>
														<th >Size in KB</th>
														<th >Preview Height</th>
														<th >Preview Width</th>
														<th >ID</th> <!-- ID WILL BE HIDE -->
														<th >TYPE</th><!--This will be hidden-->
														
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="sdocumentAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="smyModalLabel">Add Selected Document</h4>
												</div>
												<div id="errorlog_sdocument" style="display: none; color: red; font-size: 12px;"></div>
												<div class="modal-body">
													<form class="form-horizontal" role="form"  id="frmsDocumentAdd" name="frmsDocumentAdd">
														<div class="row col-sm-12 col-xs-12 ">
															<div class="col-sm-6 col-xs-6">
																<div class="form-group">
																	<label for="inputname" class="col-sm-4 control-label">Doc Code</label>
																	<div class="col-sm-8">
																		<input type="hidden" id="hidOpersDocument" name="hidOpersDocument">
																		<input type="text" class="form-control tooltips" id="txtsDocumentCode" maxlength = "20" name="txtsDocumentCode" title="Document Code" placeholder="Unique Code Of Document">
																	</div>
																	<p class="modalExbottom" style="margin-left: 140px;">Ex: APPL_FORM, CERTIFICATE</p>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label">Doc Name</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control tooltips" id="txtsDocumentName" maxlength = "50" name="txtsDocumentName" placeholder="Document Name" title="Document Name">
																	</div>
																	<p class="modalExbottom" style="margin-left: 140px;">Ex: 100px, 200px</p>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label">Doc Type</label>
																	<div class="col-sm-8">
																		<select class="form-control" id="cmbsDocumentTypeAdd" name="cmbsDocumentTypeAdd" title="Choose Document Type">	
																		</select>
																	</div>
																</div>
																
																<div class="form-group">
																	<label for="" class="col-sm-2 control-label">Doc Description</label>
																	<div class="col-sm-10">
																		<textarea id="txtsDocumentDesc"  class="form-control" name="txtsDocumentDesc"></textarea>
																	</div>
																	<p class="modalExbottom" style="margin-left: 140px;">Ex: 100px, 200px</p>
																</div>
															</div>
															
															<div class="col-sm-6 col-xs-6">
																
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label">Doc Size(In KB)</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control tooltips" onkeypress="return isNumber(event)" id="txtsDocumentSize" name="txtsDocumentSize" >
																	</div>
																	<p class="modalExbottom" style="margin-left: 140px;">Ex: 100px, 200px</p>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label">Doc Preview Height</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control tooltips" onkeypress="return isNumber(event)" id="txtsDocumentHeight" name="txtsDocumentHeight" >
																	</div>
																	<p class="modalExbottom" style="margin-left: 140px;">Ex: 100px, 200px</p>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-4 control-label">Doc Preview Width</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control tooltips" onkeypress="return isNumber(event)" id="txtsDocumentWidth" name="txtsDocumentWidth" >
																	</div>
																	<p class="modalExbottom" style="margin-left: 140px;">Ex: 100px, 200px</p>
																</div>
																<div class="form-group">
																	<label for="" class="col-sm-2 control-label">Doc Size Description</label>
																	<div class="col-sm-10">
																		<textarea id="txtsDocumentSizeDesc"  class="form-control" name="txtsDocumentSizeDesc"></textarea>
																	</div>
																	<p class="modalExbottom" style="margin-left: 140px;">Ex: 100px, 200px</p>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="sdocumentAddSave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="sdocumentEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="smyModalLabel">Edit Selected Dpocument</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form" id="frmsDocumentEdit" name="frmsDocumentEdit">
														<div class="form-group">
															<div class="col-sm-10">
																<input type="hidden" id="hidOpersDocumentEdit" name="hidOpersDocumentEdit">
																<input type="hidden" class="form-control" id="shidDUniqueidEdit" name="shidDUniqueidEdit">
															</div>
														</div>
														<div id="errorlog_sdocument_edit" style="display: none; color: red; font-size: 12px;"></div>
														<div class="form-group">
															<label for="inputname" class="col-sm-2 control-label">Doc Code</label>
															<div class="col-sm-10">
																<input type="text" class="form-control tooltips" id="txtsDocumentCodeEdit" name="txtsDocumentCodeEdit" title="Document Code" placeholder="Unique Code Of Document" maxlength = "20">
															</div>
															<p class="modalExbottom" style="margin-left: 140px;">Ex: 100px, 200px</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-2 control-label">Doc Name</label>
															<div class="col-sm-10">
																<input type="text" class="form-control tooltips" id="txtsDocumentNameEdit" name="txtsDocumentNameEdit" placeholder="Document Name" title="Document Name" maxlength = "50">
															</div>
															<p class="modalExbottom" style="margin-left: 140px;">Ex: 100px, 200px</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-2 control-label">Doc Type</label>
															<div class="col-sm-10">
																<select class="form-control selectpicker" data-live-search="true" id="cmbsDocumentTypeEdit" name="cmbsDocumentTypeEdit" title="Choose Document Type">	
																</select>
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-2 control-label">Doc Description</label>
															<div class="col-sm-10">
																<textarea id="txtsDocumentDescEdit"   class="form-control" name="txtsDocumentDescEdit"></textarea>
															</div>
															<p class="modalExbottom" style="margin-left: 140px;">Ex: 100px, 200px</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-2 control-label">Doc Size Description</label>
															<div class="col-sm-10">
																<textarea id="txtsDocumentSizeDescEdit"  class="form-control" name="txtsDocumentSizeDescEdit"></textarea>
															</div>
															<p class="modalExbottom" style="margin-left: 140px;">Ex: 100px, 200px</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-2 control-label">Doc Size(In KB)</label>
															<div class="col-sm-10">
																<input type="text" onkeypress="return isNumber(event)" class="form-control tooltips" id="txtsDocumentSizeEdit" name="txtsDocumentSizeEdit" >
															</div>
															<p class="modalExbottom" style="margin-left: 140px;">Ex: 100px, 200px</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-2 control-label">Doc Preview Height</label>
															<div class="col-sm-10">
																<input type="text" class="form-control tooltips" onkeypress="return isNumber(event)" id="txtsDocumentHeightEdit" name="txtsDocumentHeightEdit" >
															</div>
															<p class="modalExbottom" style="margin-left: 140px;">Ex: 100px, 200px</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-2 control-label">Doc Preview Width</label>
															<div class="col-sm-10">
																<input type="text" class="form-control tooltips" onkeypress="return isNumber(event)" id="txtsDocumentWidthEdit" name="txtsDocumentWidthEdit" >
															</div>
															<p class="modalExbottom" style="margin-left: 140px;">Ex: 100px, 200px</p>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="sdocumentEditSave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="sdocumentDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="smyModalLabel">Delete record</h4>
												</div>
												<div class="modal-body">
													<center><h2>Do You Want to Delete This Record?</h2></center>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" id="sdocumentDeleteRecord"><i class="fa fa-trash"></i>  Delete</button>
													<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
												</div>
											</div>
										</div>
									</div>
									<!-- FOR CATEGORY TAB -->
									<div class="chart tab-pane" id="category">
										<!--<div class="col-lg-12">
											<h1 class="page-header">Define Category:</h1>
										</div>-->
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="tblCategoryMaster" width="100%">
												<thead>
													<tr>
														<th>#</th>
														<th>Code</th>
														<th>Name</th>
														<th>ID</th> <!-- ID WILL BE HIDE -->
														<th>Action</th> 
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="categoryAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog"style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Add Category</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form"  id="frmCategoryAdd" name="frmCategoryAdd">
														<div id="errorlog_category" style="display: none; color: red; font-size: 12px;"></div>
														<div class="form-group">
															<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Category Code</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtCategoryCode" name="txtCategoryCode" maxlength = "8" title="Category Code" placeholder="Enter Category Code">
																<input type="hidden" id="hidOperCategory" name="hidOperCategory">
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: GEN</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Category Name</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtCategoryName" name="txtCategoryName" maxlength = "50" placeholder="Enter Category Name" title="Category Name">
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: General</p>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="categoryAddSave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="categoryEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog"style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Edit Category</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form" id="frmCategoryEdit" name="frmCategoryEdit">
														<div id="errorlog_category_edit" style="display: none; color: red; font-size: 12px;"></div>
														<div class="form-group">
															<div class="col-sm-10">
																<input type="hidden" class="form-control" id="hidCUniqueidEdit" name="hidCUniqueidEdit">
																<input type="hidden" id="hidOperCategoryEdit" name="hidOperCategoryEdit">
															</div>
														</div>
														<div class="form-group">
															<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Category Code</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtCategoryCodeEdit" maxlength = "8" name="txtCategoryCodeEdit" title="Category Code"readonly>
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: GEN</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Category Name</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtCategoryNameEdit" maxlength = "50" name="txtCategoryNameEdit" title="Category Name">
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: General</p>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="categoryEditSave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="categoryDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
													<button type="button" class="btn btn-danger" id="categoryDeleteRecord"><i class="fa fa-trash"></i>  Delete</button>
													<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
												</div>
											</div>
										</div>
									</div>
									<!-- FOR MINORITY COMMUNITY TAB -->
									<div class="chart tab-pane" id="minority_community">
										<!--<div class="col-lg-12">
											<h1 class="page-header">Define Minority Community:</h1>
										</div>-->
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="tblMinorityCommunityMaster" width="100%">
												<thead>
													<tr>
														<th>#</th>
														<th>Code</th>
														<th>Name</th>
														<th>ID</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="minoritycommunityAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog"style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Add Minority Community</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form"  id="frmMinoritycommunityAdd" name="frmMinoritycommunityAdd">
														<div id="errorlog_minority" style="display: none; color: red; font-size: 12px;"></div>
														<div class="form-group">
															<label for="inputname" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Minority Community Code</label>
															<div class="col-sm-8">
																<input type="hidden" id="hidOperMinority" name="hidOperMinority">
																<input type="text" class="form-control tooltips" id="txtMinoritycommunityCode" maxlength = "8" name="txtMinoritycommunityCode" title="Minority Community Code" placeholder="Enter Code">
															</div>
															<p class="modalExbottom" style="margin-left: 140px;">Ex: SIKH</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Minority Community Name</label>
															<div class="col-sm-8">
																<input type="text" class="form-control tooltips" id="txtMinoritycommunityName" maxlength="50" name="txtMinoritycommunityName" placeholder="Enter Name" title="Minority Community Name">
															</div>
															<p class="modalExbottom" style="margin-left: 140px;">Ex: Sikh</p>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="minoritycommunityAddSave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="minoritycommunityEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog"style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Edit Minority Community</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form" id="frmMinoritycommunityEdit" name="frmMinoritycommunityEdit">
														<div id="errorlog_minority_edit" style="display: none; color: red; font-size: 12px;"></div>
														<div class="form-group">
															<div class="col-sm-10">
																<input type="hidden" class="form-control" id="hidMUniqueidEdit" name="hidMUniqueidEdit">
																<input type="hidden" id="hidOperMinorityEdit" name="hidOperMinorityEdit">
															</div>
														</div>
														<div class="form-group">
															<label for="inputname" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Minority Community Code</label>
															<div class="col-sm-8">
																<input type="text" class="form-control tooltips" id="txtMinoritycommunityCodeEdit" maxlength="8" name="txtMinoritycommunityCodeEdit" title="Minority Community Code"readonly>
															</div>
															<p class="modalExbottom" style="margin-left: 140px;">Ex: SIKH</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Minority Community Name</label>
															<div class="col-sm-8">
																<input type="text" class="form-control tooltips" id="txtMinoritycommunityNameEdit" maxlength = "50" name="txtMinoritycommunityNameEdit" title="Minority Community Name">
															</div>
															<p class="modalExbottom" style="margin-left: 140px;">Ex: Sikh</p>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="minoritycommunityEditSave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="minoritycommunityDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
													<button type="button" class="btn btn-danger" id="minoritycommunityDeleteRecord"><i class="fa fa-trash"></i>  Delete</button>
													<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
												</div>
											</div>
										</div>
									</div>
									<!-- FOR CASTE TAB -->
									<div class="chart tab-pane" id="caste">
										<!--<div class="col-lg-12">
											<h1 class="page-header">Define Caste Setup:</h1>
										</div>-->
										<div class="col-lg-12">
											<table class="table table-striped table-bordered"  id="tblCaste" width="100%">
												<thead>
													<tr>
														<th>#</th>
														<th>Code</th>
														<th>Name</th>
														<th>Status</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="CasteAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog"style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Add Caste</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form"  id="frmAddCaste" name="frmAddCaste">
														<div id="errorlog_caste" style="display: none; color: red; font-size: 12px;"></div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Caste Code</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtCasteCode" name="txtCasteCode" maxlength = "8" placeholder="Enter Caste Code" title="Enter Caste Code">
																<input type="hidden" id="hidOperCaste" name="hidOperCaste">
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: GEN</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Caste Name</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtCasteName" name="txtCasteName" maxlength="50" placeholder="Enter Caste Name" title="Enter Caste Name">
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: General</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Status</label>
															<div class="col-sm-9">
																<select class="form-control tooltips" id="cmbStatus" name="cmbStatus" title="Pick Status">
																	<option value="">Select</option>
																	<option value="1">Active</option>
																	<option value="0">Inactive</option>
																</select>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="centreaddsave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="CasteEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog"style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Edit Caste</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form"  id="frmEditCaste" name="frmEditCaste">
														<div id="errorlog_caste_edit" style="display: none; color: red; font-size: 12px;"></div>
														<input type="hidden" class="form-control tooltips" id="hidCasteCodeEdit" name="hidCasteCodeEdit">
														<input type="hidden" id="hidOperCasteEdit" name="hidOperCasteEdit">
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Caste Code</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtCasteCodeEdit" name="txtCasteCodeEdit" maxlength="8" placeholder="Enter Caste Code" title="Enter Caste Code" readonly>
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: GEN</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Caste Name</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtCasteNameEdit" name="txtCasteNameEdit" maxlength="50" placeholder="Enter Caste Name" title="Enter Caste Name">
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: General</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Status</label>
															<div class="col-sm-9">
																<select class="form-control tooltips" id="cmbCasteStatusEdit" name="cmbCasteStatusEdit" title="Pick Status">
																	<option value="1">Active</option>
																	<option value="0">Inactive</option>
																</select>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="centreaddsave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="CasteDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
													<button type="button" class="btn btn-danger" id="casteDeleteRecord"><i class="fa fa-trash"></i>  Delete</button>
													<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
												</div>
											</div>
										</div>
									</div>
									<!-- FOR RELIGION TAB -->
									<div class="chart tab-pane" id="religion">
										<!--<div class="col-lg-12">
											<h1 class="page-header">Define Religion:</h1>
										</div>-->
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="tblReligionMaster" width="100%">
												<thead>
													<tr>
														<th>#</th>
														<th>Code</th>
														<th>Name</th>
														<th>ID</th> <!-- ID WILL BE HIDE -->
														<th>Action</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="religionAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog"style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Add Religion</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form"  id="frmReligionAdd" name="frmReligionAdd">
														<div id="errorlog_religion" style="display: none; color: red; font-size: 12px;"></div>
														
														<div class="form-group">
															<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Religion Code</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtReligionCode" maxlength="8" name="txtReligionCode" title="Religion Code" placeholder="Enter Religion Code">
																<input type="hidden"  id="hidOperReligion" name="hidOperReligion">
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: HINDU</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Religion Name</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtReligionName" maxlength="50" name="txtReligionName" placeholder="Enter Religion Name" title="Religion Name">
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: Hindu</p>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="religionAddSave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="religionEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog"style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Edit Religion</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form" id="frmReligionEdit" name="frmReligionEdit">
														<div id="errorlog_religion_edit" style="display: none; color: red; font-size: 12px;"></div>
														<div class="form-group">
															<div class="col-sm-10">
																<input type="hidden" class="form-control" id="hidRUniqueidEdit" name="hidRUniqueidEdit">
																<input type="hidden"  id="hidOperReligionEdit" name="hidOperReligionEdit">
															</div>
														</div>
														<div class="form-group">
															<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Religion Code</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtReligionCodeEdit" maxlength="8" name="txtReligionCodeEdit" title="Religion Code"readonly>
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: HINDU</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Religion Name</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtReligionNameEdit" maxlength = "50" name="txtReligionNameEdit" title="Religion Name">
															</div>
															<p class="modalExbottom" style="margin-left: 180px;">Ex: Hindu</p>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="religionEditSave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="religionDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
													<button type="button" class="btn btn-danger" id="religionDeleteRecord"><i class="fa fa-trash"></i>  Delete</button>
													<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
												</div>
											</div>
										</div>
									</div>
									<!-- FOR INSTRUCTION TAB -->
									<div class="chart tab-pane" id="instruction">
										<!--<div class="col-lg-12">
											<h1 class="page-header">Instruction Setup:</h1>
										</div>-->
										<div class="col-lg-12">
											<table class="table table-striped table-bordered"  id="tblInstruction" width="100%">
												<thead>
													<tr>
														<th>#</th>
														<th>Page Code</th>
														<th>Text</th>
														<th>Instruction</th>
														<th>Status</th>
														<th>Record Status</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="InstructionAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog"style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Add Instruction</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form"  id="frmAddInstruction" name="frmAddInstruction">
														<div id="errorlog_instruction" style="display: none; color: red; font-size: 12px;"></div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Page Code</label>
															<div class="col-sm-9">
																<select name="cmbPageCode" class="form-control" id="cmbPageCode">
																	<option value="">Select Page</option>
																	<option value="INSTITUTE">INSTITUTE</option>
																	<option value="PROGRAM">PROGRAM</option>
																	<option value="REGISTRATION">REGISTRATION</option>
																	<option value="TEMP001">TEMP001</option>
																	<option value="TEMP002">TEMP002</option>
																	<option value="TEMP003">TEMP003</option>
																	<option value="TEMP004">TEMP004</option>
																	<option value="TEMP005">TEMP005</option>
																	<option value="TEMP006">TEMP006</option>
																	<option value="TEMP007">TEMP007</option>
																	<option value="TEMP008">TEMP008</option>
																	<option value="TEMP009">TEMP009</option>
																	<option value="TEMP010">TEMP010</option>
																	<option value="DOCUMENT UPLOAD">DOCUMENT UPLOAD</option>
																	<option value="PAYMENT">PAYMENT</option>
																</select>
															</div>
														</div>
														<input type="hidden" id="hidOperInstruction" name="hidOperInstruction"/>
														<input type="hidden" id="hidOperInstructionEdit" name="hidOperInstructionEdit"/>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Instruction</label>
															<div class="col-sm-9">
																<textarea rows="10" class="form-control" id="taInstruction" name="taInstruction"  title="Enter Instructions"></textarea>
															</div>
															<p class="modalExbottom" style="margin-left: 140px;">Ex: 100px, 200px</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Status</label>
															<div class="col-sm-9">
																<select class="form-control tooltips" id="cmbInsStatus" name="cmbInsStatus" title="Pick Status">
																	<option value="1">Active</option>
																	<option value="0">Inactive</option>
																</select>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="centreaddsave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="InstructionEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog"style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Edit Instruction</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form"  id="frmEditInstruction" name="frmEditInstruction">
														<div id="errorlog_instruction_edit" style="display: none; color: red; font-size: 12px;"></div>
														<input type="hidden" id="hidOperInstructionEdit" name="hidOperInstructionEdit"/>
														<input type="hidden" class="form-control tooltips" id="hidInstructionCodeEdit" name="hidInstructionCodeEdit">
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Page Code</label>
															<div class="col-sm-9">
																<select name="cmbPageCodeEdit" class="form-control" id="cmbPageCodeEdit" disabled="">
																	<option value="">Select Page</option>
																	<option value="INSTITUTE">INSTITUTE</option>
																	<option value="PROGRAM">PROGRAM</option>
																	<option value="REGISTRATION">REGISTRATION</option>
																	<option value="TEMP001">TEMP001</option>
																	<option value="TEMP002">TEMP002</option>
																	<option value="TEMP003">TEMP003</option>
																	<option value="TEMP004">TEMP004</option>
																	<option value="TEMP005">TEMP005</option>
																	<option value="TEMP006">TEMP006</option>
																	<option value="TEMP007">TEMP007</option>
																	<option value="TEMP008">TEMP008</option>
																	<option value="TEMP009">TEMP009</option>
																	<option value="TEMP010">TEMP010</option>
																	<option value="DOCUMENT UPLOAD">DOCUMENT UPLOAD</option>
																	<option value="PAYMENT">PAYMENT</option>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Instruction</label>
															<div class="col-sm-9">
																<textarea rows="10" cols="60" class="form-control" id="taInstructionEdit" name="taInstructionEdit"  title="Enter Instructions"></textarea>
															</div>
															<p class="modalExbottom" style="margin-left: 140px;">Ex: 100px, 200px</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Status</label>
															<div class="col-sm-9">
																<select class="form-control tooltips" id="cmbInsStatusEdit" name="cmbInsStatusEdit" title="Pick Status">
																	<option value="1">Active</option>
																	<option value="0">Inactive</option>
																</select>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="centreaddsave"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="InstructionDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
													<button type="button" class="btn btn-danger" id="groupDeleteRecord"><i class="fa fa-trash"></i>  Delete</button>
													<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript" src="<?=base_url()?>public/assets/js/admin/generic_setup1.js"></script>