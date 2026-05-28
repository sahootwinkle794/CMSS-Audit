<style>
	.modal-dialog{
		width: 50%;
	}
	.modalExbottom
	{
		color:#d2a9a9;
	}
</style>

<div class="content-wrapper">
	<div class="row">
		<!--<div class="col-lg-12">
			<h1 class="page-header">Generic Setup 2:</h1>
		</div>-->
		<!--<section class="content-header">
	      	<h1>
	        	Generic Setup 2
	      	</h1>
	    </section>-->
		<div class="col-lg-12">
			<!--<div class="panel with-nav-tabs panel-primary">
				<div class="panel-heading">-->
				<div class="nav-tabs-custom box box-default">
					<ul class="nav nav-tabs" role="tablist">
						<li class="active"><a href="#country" data-toggle='tab'><b>Country</b></a></li>
						<li><a href="#state" data-toggle='tab'><b>State</b></a></li>
						<li><a href="#district" data-toggle='tab'><b>District</b></a></li>
						<li><a href="#nationality" data-toggle='tab'><b>Nationality</b></a></li>
						<li><a href="#board" data-toggle='tab'><b>Board</b></a></li>
						<li><a href="#standard" data-toggle='tab'><b>Standard</b></a></li>
						<li><a href="#qualification" data-toggle='tab'><b>Qualification</b></a></li>
						<li><a href="#examcenter" data-toggle='tab'><b>Exam Center</b></a></li>
						<!--<li><a href="#registration_fields" data-toggle='tab'><b>Registration Field</b></a></li>-->
					</ul>
				<!--</div>
				<div class="panel-body">-->
       				<div class="tab-content">
						<div class="chart tab-pane in active" id="country">
							<!--<div class="col-lg-12 page-header">
								<label for="" class="col-sm-6 control-label">Define Country:</label>
							</div>-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblCountryMaster" width="100%">
									<thead>
										<tr>
											<th class="text-left">#</th>
											<th class="text-left">Code</th>
											<th class="text-left">Name</th>
											<th class="text-left">ID</th>
											<th class="text-left">Action</th> 
											 <!-- ID WILL BE HIDE -->
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
						<div class="modal fade" id="countryAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog"style="width: 50%;">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Add Country</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form"  id="frmCountryAdd" name="frmCountryAdd">
											<div id="errorlog_country_add" style="display: none; color: red; font-size: 12px;"></div>
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Country Code</label>
												<div class="col-sm-9">
													<input type="hidden" id="hidOperCountry" name="hidOperCountry">
													<input type="text" class="form-control tooltips" id="txtCountryCode" maxlength="8" name="txtCountryCode" title="Country Code" placeholder="">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: AUS</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Country Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtCountryName" maxlength="50" name="txtCountryName" placeholder="" title="Country Name">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: Australia</p>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingCountryAdd" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" id="countryAddSave"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="countryEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog"style="width: 50%;">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Edit Country</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form" id="frmCountryEdit" name="frmCountryEdit">
											<div id="errorlog_country_edit" style="display: none; color: red; font-size: 12px;"></div>	
											<div class="form-group">
												<div class="col-sm-9">
													<input type="hidden" id="hidOperCountryEdit" name="hidOperCountryEdit">
													<input type="hidden" class="form-control" id="hidUniqueidEdit" name="hidUniqueidEdit">
												</div>
											</div>
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Country Code</label>
												<div class="col-sm-9">
													<input type="hidden" class="form-control tooltips" id="hidCountryCodeEdit" name="hidCountryCodeEdit" title="Country Code">
													<input type="text" class="form-control tooltips" id="txtCountryCodeEdit"  name="txtCountryCodeEdit" title="Country Code" readonly>
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: AUS</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Country Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtCountryNameEdit" name="txtCountryNameEdit" maxlength="50" title="Country Name">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: Australia</p>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingCountryEdit" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" id="countryEditSave"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="countryDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Delete Country</h4>
									</div>
									<div class="modal-body">
										<center><h2>Do You Want to Delete This Record?</h2></center>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" id="countryDeleteRecord"><i class='fa fa-trash'></i>  Delete</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
									</div>
								</div>
							</div>
						</div>
						<!--State Tab -->
						<div class="chart tab-pane" id="state">
							<!--<div class="col-lg-12">
								<h1 class="page-header">Define State:</h1>
							</div>-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblStateMaster" width="100%">
									<thead>
										<tr>
											<th class="text-left">#</th>
											<th class="text-left">Country Name</th>
											<th class="text-left">State Code</th>
											<th class="text-left">State Name</th>
											<th class="text-left">ID</th> <!-- ID WILL BE HIDE -->
											<th class="text-left" hidden>Country Code</th>
											<th class="text-left">Action</th> 
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
						<div class="modal fade" id="stateAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Add State</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form"  id="frmStateAdd" name="frmStateAdd">
											<div id="errorlog_state_add" style="display: none; color: red; font-size: 12px;"></div>
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> State Code</label>
												<div class="col-sm-9">
													<input type="hidden" id="hidOperAddState" name="hidOperAddState">	
													<input type="text" class="form-control tooltips" id="txtStateCode" maxlength="8" name="txtStateCode" title="State Code" placeholder="">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: HP</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> State Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtStateName" maxlength="50" name="txtStateName" placeholder="" title="State Name">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: Himachal Pradesh</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Country Name</label>
												<div class="col-sm-9">
													<select class="form-control tooltips" id="cmbCountryName_State" name="cmbCountryName_State" title="Select Country Name"></select>
												</div>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingStateAdd" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" id="stateAddSave"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="stateEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Edit State</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form" id="frmStateEdit" name="frmStateEdit">
											<div id="errorlog_state_edit" style="display: none; color: red; font-size: 12px;"></div>
											<div class="form-group">
												<div class="col-sm-9">
													<input type="hidden" id="hidOperEditState" name="hidOperEditState">
													<input type="hidden" class="form-control" id="hidUniqueidEditState" name="hidUniqueidEditState">
												</div>
											</div>
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> State Code</label>
												<div class="col-sm-9">
													<input type="hidden" class="form-control tooltips" id="hidStateCodeEdit" name="hidStateCodeEdit" title="State Code">
													<input type="text"   class="form-control tooltips" id="txtStateCodeEdit" name="txtStateCodeEdit" title="State Code" readonly>
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: HP</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> State Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtStateNameEdit" maxlength="50"  name="txtStateNameEdit" title="State Name">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: Himachal Pradesh</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Country Name</label>
												<div class="col-sm-9">
													<select class="form-control tooltips" id="cmbCountryNameEdit_State" name="cmbCountryNameEdit_State" title="Select Country Name"></select>
												</div>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingStateEdit" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" id="stateEditSave"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="stateDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Delete State</h4>
									</div>
									<div class="modal-body">
										<center><h2>Do You Want to Delete This Record?</h2></center>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" id="stateDeleteRecord"><i class='fa fa-trash'></i>  Delete</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
									</div>
								</div>
							</div>
						</div>
						<!--District Tab -->
						<div class="chart tab-pane" id="district">
							<!--<div class="col-lg-12">
								<h1 class="page-header">Define District:</h1>
							</div>-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblDistrictMaster" width="100%">
									<thead>
										<tr>
											<th class="text-left">#</th>
											<th class="text-left">Country Name</th>
											<th class="text-left">State Name</th>
											<th class="text-left">District Code</th>
											<th class="text-left">District Name</th>
											<th hidden class="text-left">State Code</th>
											<th hideen class="text-left">country code</th>
											<th class="text-left">ID</th> <!-- ID WILL BE HIDE -->
											<th class="text-left">Action</th> 
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
						<div class="modal fade" id="districtAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Add District</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form"  id="frmDistrictAdd" name="frmDistrictAdd">
											<div id="errorlog_district_add" style="display: none; color: red; font-size: 12px;"></div>
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> District Code</label>
												<div class="col-sm-9">
													<input type="hidden" id="hidOperAddDistrict" name="hidOperAddDistrict">
													<input type="text" class="form-control tooltips" id="txtDistrictCode" maxlength="8" name="txtDistrictCode" title="District Code" placeholder="">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: KHU</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> District Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtDistrictName" maxlength="50" name="txtDistrictName" placeholder="" title="District Name">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: KHURDA</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> State Name</label>
												<div class="col-sm-9">
													<select class="form-control tooltips" id="cmbStateName_District" name="cmbStateName_District" title="Select State Name"></select>
												</div>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Country Name</label>
												<div class="col-sm-9">
													<select class="form-control tooltips" id="cmbCountryName_District" name="cmbCountryName_District" title="Select Country Name"></select>
												</div>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingDistrictAdd" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" id="districtAddSave"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="districtEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Edit District</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form" id="frmDistrictEdit" name="frmDistrictEdit">
											<div id="errorlog_district_edit" style="display: none; color: red; font-size: 12px;"></div>
											<div class="form-group">
												<div class="col-sm-9">
													<input type="hidden" id="hidOperEditDistrict" name="hidOperEditDistrict">
													<input type="hidden" class="form-control" id="hidUniqueidEditDistrict" name="hidUniqueidEditDistrict">
												</div>
											</div>
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> District Code</label>
												<div class="col-sm-9">
													<input type="hidden" class="form-control tooltips" id="hidDistrictCodeEdit" name="hidDistrictCodeEdit" title="District Code">
													<input type="text" class="form-control tooltips"   id="txtDistrictCodeEdit" name="txtDistrictCodeEdit" title="District Code" readonly>
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: KHU</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> District Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtDistrictNameEdit" maxlength="50" name="txtDistrictNameEdit" title="District Name">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: KHURDA</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> State Name</label>
												<div class="col-sm-9">
													<select class="form-control tooltips" id="cmbStateNameEdit_District" name="cmbStateNameEdit_District" title="Select State Name"></select>
												</div>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Country Name</label>
												<div class="col-sm-9">
													<select class="form-control tooltips" id="cmbCountryNameEdit_District" name="cmbCountryNameEdit_District" title="Select Country Name"></select>
												</div>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingDistrictEdit" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" id="districtEditSave"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="districtDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Delete District</h4>
									</div>
									<div class="modal-body">
										<center><h2>Do You Want to Delete This Record?</h2></center>
									</div>
									<div class="modal-footer">
										<span id="spanProcessingMenu" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
										<button type="button" class="btn btn-danger" id="districtDeleteRecord"><i class='fa fa-trash'></i>  Delete</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
									</div>
								</div>
							</div>
						</div>	
						<!-- Nationality Tab -->
						<div class="chart tab-pane" id="nationality">
							<!--<div class="col-lg-12">
								<h1 class="page-header">Define Nationality:</h1>
							</div>-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblNationalityMaster" width="100%">
									<thead>
										<tr>
											<th class="text-left">#</th>
											<th class="text-left">Code</th>
											<th class="text-left">Name</th>
											<th class="text-left">ID</th> <!-- ID WILL BE HIDE -->
											<th class="text-left">Action</th> 
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
						<div class="modal fade" id="nationalityAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Add Nationality</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form"  id="frmNationalityAdd" name="frmNationalityAdd">
											<div id="errorlog_nationality_add" style="display: none; color: red; font-size: 12px;"></div>
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Nationality Code</label>
												<div class="col-sm-9">
													<input type="hidden" id="hidOperAddNationality" name="hidOperAddNationality">
													<input type="text" class="form-control tooltips" id="txtNationalityCode" maxlength="8" name="txtNationalityCode" title="Nationality Code" placeholder="">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: IND</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Nationality Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtNationalityName" maxlength="50" name="txtNationalityName" placeholder="" title="Nationality Name">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: Indian</p>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingNationalityAdd" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" id="nationalityAddSave"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="nationalityEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Edit Nationality</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form" id="frmNationalityEdit" name="frmNationalityEdit">
											<div id="errorlog_nationality_edit" style="display: none; color: red; font-size: 12px;"></div>
											<div class="form-group">
												<div class="col-sm-9">
													<input type="hidden"  id="hidOperEditNationality" name="hidOperEditNationality">
													<input type="hidden" class="form-control" id="hidUniqueidEditNationality" name="hidUniqueidEditNationality">
												</div>
											</div>
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Nationality Code</label>
												<div class="col-sm-9">
													<input type="hidden" class="form-control tooltips" id="hidNationalityCodeEdit" name="hidNationalityCodeEdit" title="Nationality Code">
													<input type="text"   class="form-control tooltips" id="txtNationalityCodeEdit" name="txtNationalityCodeEdit" title="Nationality Code" readonly>
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: IND</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Nationality Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtNationalityNameEdit" maxlength="50" name="txtNationalityNameEdit" title="Nationality Name">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: Indian</p>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingNationalityEdit" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" id="nationalityEditSave"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="nationalityDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Delete Nationality</h4>
									</div>
									<div class="modal-body">
										<center><h2>Do You Want to Delete This Record?</h2></center>
									</div>
									<div class="modal-footer">
										<span id="spanProcessingMenu" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
										<button type="button" class="btn btn-danger" id="nationalityDeleteRecord"><i class='fa fa-trash'></i>  Delete</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Board Tab -->
						<div class="chart tab-pane" id="board">
							<!--<div class="col-lg-12">
								<h1 class="page-header">Define Board:</h1>
							</div>-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblBoardMaster" width="80%">
									<thead>
										<tr>
											<th class="text-left">#</th>
											<th class="text-left">Code</th>
											<th class="text-left">Name</th>
											<th class="text-left">ID</th> <!-- ID WILL BE HIDE -->
											<th class="text-left">Action</th> 
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
						<div class="modal fade" id="boardAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Add Board</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form"  id="frmBoardAdd" name="frmBoardAdd">
											<div id="errorlog_board_add" style="display: none; color: red; font-size: 12px;"></div>
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Board Code</label>
												<div class="col-sm-9">
													<input type="hidden" id="hidOperAddBoard" name="hidOperAddBoard">
													<input type="text" class="form-control tooltips" id="txtBoardCode" name="txtBoardCode" maxlength="8" title="Board Code" placeholder="">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: CBSE</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Board Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtBoardName" name="txtBoardName" maxlength="50" placeholder="" title="Board Name">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: CBSE</p>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingBoardAdd" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" id="boardAddSave"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="boardEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Edit Board</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form" id="frmBoardEdit" name="frmBoardEdit">
											<div id="errorlog_board_edit" style="display: none; color: red; font-size: 12px;"></div>
											<div class="form-group">
												<div class="col-sm-9">
													<input type="hidden" id="hidOperEditBoard" name="hidOperEditBoard">
													<input type="hidden" class="form-control" id="hidUniqueidEditBoard" name="hidUniqueidEditBoard">
												</div>
											</div>
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Board Code</label>
												<div class="col-sm-9">
													<input type="hidden" class="form-control tooltips" id="hidBoardCodeEdit" name="hidBoardCodeEdit" title="Board Code">
													<input type="text"   class="form-control tooltips" id="txtBoardCodeEdit" name="txtBoardCodeEdit" title="Board Code" readonly>
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: CBSE</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Board Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtBoardNameEdit" name="txtBoardNameEdit" maxlength="50" title="Board Name">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: CBSE</p>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingBoardEdit" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" id="boardEditSave"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="boardDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Delete Board</h4>
									</div>
									<div class="modal-body">
										<center><h2>Do You Want to Delete This Record?</h2></center>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" id="boardDeleteRecord"><i class='fa fa-trash'></i>  Delete</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
									</div>
								</div>
							</div>
						</div>
						
						
						
						
						
						<!-- Standard Tab -->
						
						<div class="chart tab-pane" id="standard">
							<!--<div class="col-lg-12">
								<h1 class="page-header">Define Standard:</h1>
							</div>-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="tblStandardMaster" width="100%">
									<thead>
										<tr>
											<th class="text-left">#</th>
											<th class="text-left">Code</th>
											<th class="text-left">Name</th>
											<th class="text-left">Previous Standard</th>
											<th class="text-left">ID</th> <!-- ID WILL BE HIDE -->
											<th class="text-left">Action</th> 
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
						</div>
						<div class="modal fade" id="standardAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Add Standard</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form"  id="frmStandardAdd" name="frmStandardAdd">
											<div id="errorlog_standard_add" style="display: none; color: red; font-size: 12px;"></div>
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Standard Code</label>
												<div class="col-sm-9">
													<input type="hidden" id="hidOperAddStandard" name="hidOperAddStandard">
													<input type="text" class="form-control tooltips" id="txtStandardCode" name="txtStandardCode" maxlength="8" title="Standard Code">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: CLASS11</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Standard Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtStandardName" name="txtStandardName" maxlength="50"  title="Standard Name">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: Class-11</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Previous Standard</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtPreviousStandard" name="txtPreviousStandard"  title="Previous Standard">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: CBSE</p>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingStandardAdd" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" id="standardAddSave"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="standardEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Edit Standard</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form" id="frmStandardEdit" name="frmStandardEdit">
											<div id="errorlog_standard_edit" style="display: none; color: red; font-size: 12px;"></div>
											<input type="hidden"  id="hidUniqueidEditStandard" name="hidUniqueidEditStandard">
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Standard Code</label>
												<div class="col-sm-9">
													<input type="hidden" id="hidOperEditStandard" name="hidOperEditStandard">											
													<input type="text" class="form-control tooltips" id="txtStandardCodeEdit" name="txtStandardCodeEdit" title="Standard Code" readonly>
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: CLASS11</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Standard Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtStandardNameEdit" name="txtStandardNameEdit" maxlength="50"  title="Standard Name">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: Class-11</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Previous Standard</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtPreviousStandardEdit" name="txtPreviousStandardEdit"  title="Previous Standard">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: CBSE</p>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingStandardEdit" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" id="standardEditSave"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="standardDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Delete Standard</h4>
									</div>
									<div class="modal-body">
										<center><h2>Do You Want to Delete This Record?</h2></center>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" id="standardDeleteRecord"><i class='fa fa-trash'></i>  Delete</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
									</div>
								</div>
							</div>
						</div>	
						<!-- Qualification Tab -->
						<div class="chart tab-pane" id="qualification">
							<!--<div class="col-lg-12">
								<h1 class="page-header">Qualification Setup:</h1>
							</div>-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered"  id="tblQualification" width="100%">
									<thead>
										<tr>
											<th class="text-left">#</th>
											<th class="text-left">Code</th>
											<th class="text-left">Name</th>
											<th class="text-left">Status</th>
											<th class="text-left">Status</th>
											<th class="text-left">Action</th> 
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
						<div class="modal fade" id="QualificationAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Add Qualification</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form"  id="frmAddQualification" name="frmAddQualification">
											<div id="errorlog_qualification_add" style="display: none; color: red; font-size: 12px;"></div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Code</label>
												<div class="col-sm-9">
													<input type="hidden" id="hidOperAddQualification" name="hidOperAddQualification">	
													<input type="text" class="form-control tooltips" id="txtQualificationCode" name="txtQualificationCode" maxlength="15" placeholder="" title="Enter Qualification Code">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: SEC</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtQualificationName" name="txtQualificationName" maxlength="50" placeholder="" title="Enter Qualification Name">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: SECONDARY/CLASS X</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Status</label>
												<div class="col-sm-9">
													<select class="form-control tooltips" id="cmbStatus" name="cmbStatus" title="Pick Status">
														<option value="">Select Status</option>
														<option value="1">Active</option>
														<option value="0">Inactive</option>
													</select>
												</div>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingQualificationAdd" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" id="centreaddsave"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="QualificationEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Edit Qualification</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form"  id="frmEditQualification" name="frmEditQualification">
											<div id="errorlog_qualification_edit" style="display: none; color: red; font-size: 12px;"></div>
											<input type="hidden"  id="hidUniqueidEditQualification" name="hidUniqueidEditQualification">
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Code</label>
												<div class="col-sm-9">
													<input type="hidden" id="hidOperEditQualification" name="hidOperEditQualification">	
													<input type="text" class="form-control tooltips" id="txtQualificationCodeEdit" name="txtQualificationCodeEdit" placeholder="" title="Enter Qualification Code" readonly>
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: SEC</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtQualificationNameEdit" name="txtQualificationNameEdit" maxlength="50" placeholder="" title="Enter Qualification Name">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: SECONDARY/CLASS X</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Status</label>
												<div class="col-sm-9">
													<select class="form-control tooltips" id="cmbQualStatusEdit" name="cmbQualStatusEdit" title="Pick Status">
														<option value="">Select Status</option>
														<option value="1">Active</option>
														<option value="0">Inactive</option>
													</select>
												</div>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingQualificationEdit" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" id="centreaddsave"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="QualificationDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Delete Qualification</h4>
									</div>
									<div class="modal-body">
										<center><h2>Do You Want to Delete This Record?</h2></center>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" id="groupDeleteRecord"><i class='fa fa-trash'></i>  Delete</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
									</div>
								</div>
							</div>
						</div>
						<!-- FOR EXAM CENTER TAB -->
						<div class="chart tab-pane" id="examcenter">
							<!--<div class="col-lg-12">
								<h1 class="page-header">Exam Center:</h1>
							</div>-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="dtblExamCenter" width="100%">
									<thead>
										<tr>
											<th class="text-left">#</th>
											<th class="text-left">Code</th>
											<th class="text-left">Name</th>
											<th class="text-left">Status</th>
											<th class="text-left">status</th>
											<th class="text-left">Action</th> 
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
						</div>
						<div class="modal fade" id="AddExamCenterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Add Exam Center</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form"  id="frmExamCenterAdd" name="frmExamCenterAdd">
											<div id="errorlog_exam_center_add" style="display: none; color: red; font-size: 12px;"></div>
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Code</label>
												<div class="col-sm-9">
													<input type="hidden" id="hidOperAddExamCenter" name="hidOperAddExamCenter">	
													<input type="text" class="form-control tooltips" id="txtCenterCode" name="txtCenterCode" maxlength="8" placeholder="" title="Name">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: BBS</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtCenterName" name="txtCenterName" maxlength="50" placeholder="" title="Name">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: Bhubaneswar</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Status</label>
												<div class="col-sm-9">
													<select class="form-control tooltips" id="cmbCenterStatus" name="cmbCenterStatus" title="Select Status">
														<option value="">Select Status</option>
														<option value="1">Active</option>
														<option value="0">Inactive</option>
													</select>
													
												</div>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingExamCenterAdd" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" id="CenterAdd"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="EditExamCenterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Edit Exam Center</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form" id="frmExamCenterEdit" name="frmExamCenterEdit">
											<div id="errorlog_exam_center_edit" style="display: none; color: red; font-size: 12px;"></div>
											<div class="form-group">
												<div class="col-sm-9">
													<input type="hidden" id="hidOperEditExamCenter" name="hidOperEditExamCenter">	
													<input type="hidden" class="form-control" id="hidUniqueidEditCenter" name="hidUniqueidEditCenter">
												</div>
											</div>
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Code</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtCenterCodeEdit" name="txtCenterCodeEdit" placeholder="" title="Code" readonly>
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: BBS</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Name</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtCenterNameEdit" name="txtCenterNameEdit" maxlength="50" placeholder="" title="Name">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: Bhubaneswar</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Status</label>
												<div class="col-sm-9">
													<select class="form-control tooltips" id="cmbCenterStatusEdit" name="cmbCenterStatusEdit" title="Select Status">
														<option value="">Select Status</option>
														<option value="1">Active</option>
														<option value="0">Inactive</option>
													</select>
												</div>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingExamCenterEdit" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" id="CenterEdit"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="DeleteExamCenterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Delete Exam Center</h4>
									</div>
									<div class="modal-body">
										<center><h2>Do You Want to Delete This Record?</h2></center>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" id="CenterDelete"><i class='fa fa-trash'></i>  Delete</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
									</div>
								</div>
							</div>
						</div>	
						<!-- FOR REGISTRATION FIELDS TAB -->
						<div class="chart tab-pane" id="registration_fields">
							<!--<div class="col-lg-12">
								<h1 class="page-header">Registration Fields:</h1>
							</div>-->
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="dtblRegistrationFields" width="100%">
									<thead>
										<tr>
											<th class="text-left">#</th>
											<th class="text-left">Code</th>
											<th class="text-left">Description</th>
											<th class="text-left">Sequence No</th>
											<th class="text-left">Field Status</th>
											<th class="text-left">ID</th> <!-- ID WILL BE HIDE -->
											<th class="text-left">Action</th> 
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
						</div>
						<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Add Registration Field</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form"  id="frmRegistrationAdd" name="frmRegistrationAdd">
											<div id="errorlog_field_add" style="display: none; color: red; font-size: 12px;"></div>
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Code</label>
												<div class="col-sm-9">
													<input type="hidden" id="hidOperAddFields" name="hidOperAddFields">	
													<select class="form-control tooltips" id="cmbCode" name="cmbCode" title="Code"></select>
												</div>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Description</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtDescription" name="txtDescription" placeholder="" maxlength="50" title="Description">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: Date of Birth</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Sl No</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtSlNo" name="txtSlNo" maxlength="10" placeholder="" title="Sl No">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: 1,2,....</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Field Status</label>
												<div class="col-sm-9">
													<select class="form-control tooltips" id="cmbFieldStatus" name="cmbFieldStatus" title="Select Field Status"></select>
												</div>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingFieldAdd" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" id="AddSave"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Edit Registration Field</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form" id="frmRegistrationEdit" name="frmRegistrationEdit">
											<div id="errorlog_field_edit" style="display: none; color: red; font-size: 12px;"></div>
											<div class="form-group">
												<div class="col-sm-9">
													<input type="hidden" class="form-control" id="hidUniqueidEditRegistration" name="hidUniqueidEditRegistration">
												</div>
											</div>
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Code</label>
												<div class="col-sm-9">
													<input type="hidden" id="hidOperEditFields" name="hidOperEditFields">	
													<select class="form-control tooltips" id="cmbCodeEdit" name="cmbCodeEdit" title="Code"></select>
												</div>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Description</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtDescriptionEdit"  maxlength="50" name="txtDescriptionEdit" placeholder="" title="Description">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: Date of Birth</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Sl No</label>
												<div class="col-sm-9">
													<input type="text" class="form-control tooltips" id="txtSlNoEdit" name="txtSlNoEdit" maxlength="10" placeholder="" title="Sl No">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: 1, 2,....</p>
											</div>
											<div class="form-group">
												<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Field Status</label>
												<div class="col-sm-9">
													<select class="form-control tooltips" id="cmbFieldStatusEdit" name="cmbFieldStatusEdit" title="Select Field Status"></select>
												</div>
											</div>
											<div class="modal-footer">
												<span id="spanProcessingFieldEdit" style="display: none">Processing... <img src="<?=base_url()?>public/assets/images/bx_loader.gif" /></span>
												<button type="submit" class="btn btn-primary" id="EditSave"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Delete Registration Field</h4>
									</div>
									<div class="modal-body">
										<center><h2>Do You Want to Delete This Record?</h2></center>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" id="DeleteRecord"><i class='fa fa-trash'></i>  Delete</button>
										<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>
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
<script type="text/javascript" src="<?=base_url()?>public/assets/js/superadmin/generic_setup2.js"></script>