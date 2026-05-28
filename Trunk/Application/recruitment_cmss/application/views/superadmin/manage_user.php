<style>
.modal-dialog{
	width: 50%
}
.modalExbottom
{
	color:#d2a9a9;
}

</style>
			<div class="content-wrapper">
				<div class="row">
					
					<div class="col-lg-12">
						
            				<div class="nav-tabs-custom box box-default">
								<ul class="nav nav-tabs" role="tablist">
									<li id="tabResource" class="active" ><a href="#resource" data-toggle='tab'><b>Resource</b></a></li>
									<li id="tabRole" ><a href="#Role" data-toggle='tab'><b>Role</b></a></li>
									<li id="tabMenu" ><a href="#menu" data-toggle='tab'><b>Menu</b></a></li>
									<li id="tabUser" ><a href="#user" data-toggle='tab'><b>User</b></a></li>
								</ul>
							<!--</div>
							<div class="panel-body">-->
		           				<div class="tab-content">
		           					<div class="chart tab-pane in active" id="resource">
										<!--<div class="col-lg-12">
											<h1 class="page-header">Define Resource:</h1>
										</div>-->
										<div class="col-lg-12">
									
											<table class="table table-striped table-bordered" id="dtblResource" width="100%">
												<thead>
													<tr>
														<th >#</th>
														<th >Resource</th>
														<th hidden="">Name</th>
														<th hidden="">Is Instruction applicable</th>
														<th  hidden="">Action</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="modalResource" tabindex="-1" Resource="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Add Records</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" Resource="form"  id="frmResource" name="frmResource">
														<input type="hidden" id="hidChkIns" name="hidChkIns"/>
														<input type="hidden" id="hidResourceCode" name="hidResourceCode"/>
														<input type="hidden" id="hidOperTypeResource" name="hidOperTypeResource" value=""/>
														<div id="errorlogResource" style="display: none; color: red; font-size: 12px;"></div>
														<div class="form-group">
															<label for="txtResourceCode" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Resource Code</label>
															<div class="col-sm-8">
																<input type="text" class="form-control tooltips" id="txtResourceCode" name="txtResourceCode" placeholder="Resource Code" maxlength = "50">
															</div>
															<p class="modalExbottom" style="margin-left: 240px;">Ex: admin/dashboard, superadmin/dashboard</p>
														</div>
														<!--<div class="form-group">
															<label for="txtResourceName" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Resource Name</label>
															<div class="col-sm-8">
																<input type="text" class="form-control tooltips" id="txtResourceName" name="txtResourceName" placeholder="Resource Name">
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-4 control-label">Is Instruction Applicable</label>
															<div class="col-sm-8">
																<input type="checkbox" style="margin:2%; width: auto; vertical-align: middle" name="chkIsInstruction" id="chkIsInstruction" value="Yes" class="flat-red"/>
															</div>
														</div>-->
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="btnSaveResource"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
								
									
									<div class="chart tab-pane" id="Role">
										<!--<div class="col-lg-12">
											<h1 class="page-header">Define Role:</h1>
										</div>-->
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="dtblRole" width="100%">
												<thead>
													<tr>
														<th >#</th>
														<th >Id</th>
														<th >Code</th>
														<th >Name</th>
														<th >Landing Page URL</th>
														<th >Profile Page URL</th>
														<th >Action</th>
													</tr>
												</thead>
												<tbody>
													
												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="RoleSetupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog" style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel"><span id="lblModalRoleSetup"> </span> RECORDS </h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form"  id="frmrolesetup" name="frmRoleSetup">
														<div id="errorlogRole" style="display: none; color: red; font-size: 12px;"></div>
														<input type="hidden" id="hidRoleId" name="hidRoleId" value=""/>
														<input type="hidden" id="hidOperTypeRole" name="hidOperTypeRole" value=""/>
														<div class="form-group">
															<label for="txtRoleCode" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Role Code</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips " id="txtRoleCode" name="txtRoleCode" placeholder="Role Code" maxlength = "30">
															</div>
															<p class="modalExbottom" style="margin-left: 190px;">Ex: ADM, SUPADM</p>
														</div>
														<div class="form-group">
															<label for="txtRoleName" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Role Name</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtRoleName" name="txtRoleName" placeholder="Role Name" maxlength = "50">
															</div>
															<p class="modalExbottom" style="margin-left: 190px;">Ex: Admin, Superadmin</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Landing Page URL</label>
															<div class="col-sm-9">
																<!--<input type="text" class="form-control tooltips" id="txtLandingPageUrl" name="txtLandingPageUrl" placeholder="URL of Landing page">-->
																<select class="form-control tooltips selectpicker" data-live-search="true" id="cmbLandingPageUrl" name="cmbLandingPageUrl" >	
																</select>
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Profile Page URL</label>
															<div class="col-sm-9">
																<select class="form-control tooltips selectpicker" data-live-search="true" id="cmbProfilePageUrl" name="cmbProfilePageUrl">	
																</select>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="saveRoleMaster"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="roledeletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
													<button type="button" class="btn btn-danger" id="roledelete"><i class="fa fa-fw fa-trash"></i>&nbsp;Delete</button>
													<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-fw fa-close"></i>&nbsp;Close</button>																
												</div>
											</div>
										</div>
									</div>
									
									
									<div class="chart tab-pane" id="menu">
										<!--<div class="col-lg-12">
											<h1 class="page-header">Define Menu:</h1>
										</div>-->
										<form class="form-horizontal" role="form"  id="frmCopy" name="frmCopy">
											
										   <div class = "form-group">
												<label for="txtRoleCode" class="col-sm-1 control-label">Role:</label>
												<div class="col-sm-3">
													<select class="form-control selectpicker" data-live-search="true" id="cmbRole" name="cmbRole">	
													</select>
												</div>
												<label for="txtRoleCode" class="col-sm-1 control-label">Copy To:</label>
												<div class="col-sm-3">
													<select class="form-control selectpicker" data-live-search="true" id="cmbCopyRole" name="cmbCopyRole">
														
													</select>
												</div>
												<div class="col-sm-2">
													<button type="button" id="btnCopy" name="btnCopy" class="btn btn-info custombtn tooltips" title="Copy"><i class="fa fa-files-o"></i> Copy</button>
												</div>
												<div class="col-sm-2 " style="margin-left: -70px;">
													<button type="button" id="btnPreview" name="btnPreview" class="btn btn-success  tooltips" title="Preview"><i class="fa fa-eye"></i> Preview</button>
												</div>
											</div>
											
											
										</form>
									
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="dtblMenu" >
												<thead>
													<tr>
														<th >#</th>
														<!--<th >Role</th>-->
														<th >Link Text</th>
														<th >Link URL</th>
														<th >Parent</th>
														<th >Sl No</th>
														<th >Has Child</th>
														<th >Is Last Child</th>
														<th >Icon Class</th>
														<!--<th >Parent ID</th>--><!-- Will be hidden-->
														<!--<th >Menu ID</th>--><!-- Will be hidden-->
														<th >Action</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="modalMenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog"style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel1">Add Menu</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form"  id="frmMenu" name="frmMenu">
														<div id="errorlogMenu" style="display: none; color: red; font-size: 12px;"></div>
														<input type="hidden" class="form-control" id="hidRole" name="hidRole"/>
														<input type="hidden" class="form-control" id="hidMenuId" name="hidMenuId"/>
														<input type="hidden" id="hidOperTypeMenu" name="hidOperTypeMenu" value=""/>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Link Text</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtLinkText" name="txtLinkText" placeholder="Enter Link Text" maxlength = "50">
															</div>
															<p class="modalExbottom" style="margin-left: 190px;">Ex: Dashboard, Instiute Setup</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i>  Link URL</label>
															<div class="col-sm-9">
																<!--<input type="text" class="form-control" id="txtLinkURL" name="txtLinkURL" placeholder="Enter Link URL">-->
																<select class="form-control tooltips selectpicker" data-live-search="true" id="cmbLinkUrl" name="cmbLinkUrl">		
																</select>
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Parent</label>
															<div class="col-sm-9">
																<select class="form-control tooltips" id="cmbParent" name="cmbParent">
																	<option value="">Select Parent</option>				
																</select>
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Menu sl</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtMenuSl" name="txtMenuSl" placeholder="Enter Menu Serial Number" maxlength = "10">
															</div>
															<p class="modalExbottom" style="margin-left: 190px;">Ex: 1,2,.. Serial wise</p>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label">Has Child</label>
															<div class="col-sm-9">
																<input type="checkbox" style="margin:2%; width: auto; vertical-align: middle" name="chkHasChild" id="chkHasChild" value="Yes" class="flat-red" />
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label">Is Last Child</label>
															<div class="col-sm-9">
																<input type="checkbox" style="margin:2%; width: auto; vertical-align: middle" name="chkIsLastChild" id="chkIsLastChild" value="Yes" class="flat-red" />
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Icon Class</label>
															<div class="col-sm-9">
																<input type="text" class="form-control tooltips" id="txtIconClass" name="txtIconClass" placeholder="Enter Icon Class" maxlength="50">
															</div>
															<p class="modalExbottom" style="margin-left: 190px;">Ex: fa fa-money</p>
														</div>
														
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="btnSaveMenu"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									
									<div class="chart tab-pane" id="user">
										<!--<div class="col-lg-12">
											<h1 class="page-header">Define User:</h1>
										</div>-->
										<div class="col-lg-12">
											<form class="form-horizontal" role="form"  id="searchForm" method="post">
												<div class="form-group">
													<label for="cmbInstitute" class="col-sm-2 control-label">Organization:</label>
													<div class="col-sm-3">
														<select class="form-control selectpicker" data-live-search="true" id="cmbInstitute" name="cmbInstitute">
														</select>
													</div>
													<!--<div class="col-sm-2">
														<button type="button" id="btnAdd" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
													</div>-->
													<!--<div class="col-sm-2">
														<button type="button" class="btn btn-success tooltips" id="btnRefresh" title="Refresh Page"><span class="glyphicon glyphicon-refresh"></span></button>
													</div>-->
												</div>
											</form>
										</div>
										<div class="col-lg-12" style="overflow-x:auto;">
											<table class="table table-striped table-bordered" id="dtblManageUsers" style="word-wrap: break-word;" width="100%">
												<thead>
													<tr>
														<th >#</th>
														<th  style="display:none;">User Code</th>
														<th >Employee Name</th>
														<th >Username</th>
														<th >Role</th>
														<th >Profile Image</th>
														<th >Status</th>
														<th >Action</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="userAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel2">Add User</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form"  id="usermanageformid" method="post" enctype="multipart/form-data">
														<div id="errorlogUser" style="display: none; color: red; font-size: 12px;"></div>
														<input type="hidden" class="form-control" name="hidUserCode" id="hidUserCode" value="">
														<input type="hidden" class="form-control" name="hidInstituteCode" id="hidInstituteCode" value="">
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Employee Name</label>
															<div class="col-sm-9">
																<input type="text" class="form-control" id="txtEmployeeName" name="txtEmployeeName" maxlength="50" placeholder="Enter Employee Name">
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> User Name</label>
															<div class="col-sm-9">
																<input type="text" onkeyup="this.value=this.value.toUpperCase()" class="form-control" id="txtUserName" name="txtUserName" placeholder="Enter User Name" maxlength = "50">
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Role</label>
															<div class="col-sm-9">
																<select class="form-control selectpicker" data-live-search="true" id="cmbRoleUser" name="cmbRoleUser">
																</select>
															</div>
														</div>
														<div class="form-group">
															<input type="hidden" class="form-control" name="hidImageUpload" id="hidImageUpload">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Profile Image</label>
															<div class="col-sm-4">
																<input type="file" name="userImageUpload" id="userImageUpload" class="form-control" style="margin-top:-5px;">
																File-Type: jpg, jpeg, png<br />
																File-Size: 400kb Max<br />
																Dimension: 100*100 pixels
																<div id="signMessageUser" style="color:red;font-size:16px;"></div>
															</div>
															
															
															<div class="col-sm-5">
																<img id='imageDisplayareaUser' src='' style='margin-left:50px;margin-right:50px;' width='100' height='100' />
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Status</label>
															<div class="col-sm-9">
																<select class="form-control" id="cmbStatus" name="cmbStatus" >
																	<option value="">Select Status</option>
																	<option value="1">ACTIVE</option>
																	<option value="0">INACTIVE</option>
																</select>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="userBtn" ><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<!--<div class="modal fade" id="userEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabelEdit">Edit Record</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form"  id="usermanageformidEdit" method="post" enctype="multipart/form-data">
														<div id="errorlogUser" style="display: none; color: red; font-size: 12px;"></div>
														<input type="hidden" class="form-control" name="hidUserCodeEdit" id="hidUserCodeEdit" value="">
														<input type="hidden" class="form-control" name="hidInstituteCodeEdit" id="hidInstituteCodeEdit" value="">
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Employee Name</label>
															<div class="col-sm-9">
																<input type="text" class="form-control" id="txtEmployeeNameEdit" name="txtEmployeeNameEdit" placeholder="Enter Employee Name">
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> User Name</label>
															<div class="col-sm-9">
																<input type="text" class="form-control" id="txtUserNameEdit" name="txtUserNameEdit" placeholder="Enter User Name">
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Role</label>
															<div class="col-sm-9">
																<select class="form-control selectpicker" data-live-search="true" id="cmbRoleUserEdit" name="cmbRoleUserEdit">
																</select>
															</div>
														</div>
														<div class="form-group">
															<input type="hidden" class="form-control" name="hidImageUploadEdit" id="hidImageUploadEdit">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Profile Image</label>
															<div class="col-sm-9">
																<input type="file" name="userImageUploadEdit" id="userImageUploadEdit" class="form-control" style="margin-top:-5px;">
															</div>
														</div>
														<div class="form-group">
															<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Status</label>
															<div class="col-sm-9">
																<select class="form-control" id="cmbStatusEdit" name="cmbStatusEdit" >
																	<option value="">Select Status</option>
																	<option value="1">ACTIVE</option>
																	<option value="0">INACTIVE</option>
																</select>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="userBtnEdit" >Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>-->
									
								</div>
							<!--</div>
						</div>-->
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				var base_adm_url = '<?php echo BASE_ADM_URL;?>';
			</script>
			<script type="text/javascript" src="<?=base_url()?>public/assets/js/superadmin/manage_user.js"></script>