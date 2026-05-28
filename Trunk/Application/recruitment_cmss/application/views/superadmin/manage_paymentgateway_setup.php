<style>
	.topNav > a{
		color: #000;
		font-weight: 600;
		border-top: 3px solid #496CAD;
	}
	.alignCenter
	{
		text-align: center;
	}
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
		<div class="col-lg-12">
			<!--<div class="nav-tabs-custom" id="tabs">-->
			<div class="nav-tabs-custom box box-default">
				<ul class="nav nav-tabs" style="margin: 10px 0px 10px 0px;">
					<li class="topNav active"><a href="#tabMasterSetup" data-toggle="tab" id="tabMasterSetupTab">Master Setup</a></li>
					<li class="topNav"><a href="#tabParameter" data-toggle="tab" id="tabParameterTab">Parameter</a></li>																															
					<li class="topNav"><a href="#tabParameterValues" data-toggle="tab" id="tabParameterValuesTab">Parameter Values</a></li>																															
                </ul>
                <div class="tab-content">
                	<div class="chart tab-pane active" id="tabMasterSetup"><!--PAYMENT GATEWAY MASTER TAB -->
                		<div class="row">
                			<div class="col-lg-12" style="overflow-x:auto;">
								<table class="table table-striped table-bordered" id="dtblPgMasterSetup" style="word-wrap: break-word;" width="100%">
									<thead>
										<tr>
											<th >#</th>
											<th >Code</th>
											<th >Name</th>
											<th >Logo</th>
											<th >Remarks</th>
											<th >Process URL</th>
											<th >Action URL</th>
											<th >ID</th>
											<th >Status Code</th>
											<th >Status</th>
											<th >Action</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
                		</div>
            			<div class="modal fade" id="modalPgMasterSetup" tabindex="-1" Resource="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabel">Add Records</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" Resource="form"  id="frmPgMasterSetup" name="frmPgMasterSetup">
											<input type="hidden" id="hidbtnData" name="hidbtnData"/>
											<input type="hidden" id="hidPgMasterId" name="hidPgMasterId"/>
											<input type="hidden" id="hidPgMasterCode" name="hidPgMasterCode"/>
											<div class="form-group">
												<label for="txtPgMasterCode" class="col-lg-3 col-md-3 col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Payment Gateway Code</label>
												<div class="col-lg-9 col-md-9 col-sm-9">
													<input type="text" class="form-control" id="txtPgMasterCode" maxlength="20" name="txtPgMasterCode" placeholder="Payment Gateway Code">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: QUIKFEE, AXIS</p>
											</div>
											<div class="form-group">
												<label for="txtPgMasterName" class="col-lg-3 col-md-3 col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Payment Gateway Name</label>
												<div class="col-lg-9 col-md-9 col-sm-9">
													<input type="text" class="form-control" id="txtPgMasterName" maxlength="100" name="txtPgMasterName" placeholder="Payment Gateway Name">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: Quikfee, Axis</p>
											</div>
											<div class="form-group">
												<label for="fileLogo" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Logo</label>
												<div class="col-sm-9">
													<input type="file" class="form-control tooltips" id="fileLogo" name="fileLogo">
													File-Type: jpg, jpeg, png<br />
													File-Size: 400kb Max<br />
												</div>
											</div>
											<div class="form-group">
												<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Remarks</label>
												<div class="col-sm-9">
													<textarea class="form-control" id="txtRemarks" name="txtRemarks" placeholder="Enter Remarks"></textarea>
												</div>
											</div>
											<div class="form-group">
												<label for="txtPgMasterName" class="col-lg-3 col-md-3 col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Payment Process URL</label>
												<div class="col-lg-9 col-md-9 col-sm-9">
													<input type="text" class="form-control" id="txtPaymentProcessURL" maxlength="200" name="txtPaymentProcessURL" placeholder="Payment Process URL">
												</div>
												<p class="modalExbottom" style="margin-left: 180px;">Ex: payment/process_payment_quikfee,payment/process_payment_axis</p>
											</div>
											<div class="form-group">
												<label for="txtPgMasterName" class="col-lg-3 col-md-3 col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Action URL</label>
												<div class="col-lg-9 col-md-9 col-sm-9">
													<input type="text" class="form-control" id="txtActionURL" maxlength="200"  name="txtActionURL" placeholder="PG Action URL">
												</div>
											</div>
											<div class="form-group">
												<label for="cmbPGCodeStatus" class="col-lg-3 col-md-3 col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Status</label>
												<div class="col-lg-9 col-md-9 col-sm-9">
													<select  class="form-control" id="cmbPGCodeStatus" name="cmbPGCodeStatus">
														<option value="">Select Status</option>
														<option value="1">Active</option>
														<option value="0">In-active</option>
													</select>
												</div>
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-primary" id="btnSavePgMasterSetup"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div><!--PAYMENT GATEWAY MASTER SETUP  MODAL END-->
                	</div><!--PAYMENT GATEWAY MASTER TAB END-->
                	<div class="chart tab-pane" id="tabParameter"><!--PAYMENT GATEWAY PARAMETER TAB  -->
                		<div class="row">
						  	<form class="form-horizontal" role="form"  id="frmSelectPgParameter" name="frmSelectPgParameter">
						   		<div class = "form-group">
								<label for="cmbPgCode" class="control-label col-lg-3 col-md-3 col-sm-3"style="margin-left: 15px;">Select Payment Gateway :</label>
									<div class="col-lg-3 col-md-3 col-lg-3 col-md-3 col-sm-3" style="margin-left: -60px">
										<select class="form-control selectpicker" data-live-search="true"  id="cmbPgCode" name="cmbPgCode">
											<!--<option value="">SELECT</option>-->
										</select>
									</div>
						  		</div>
							</form>
							<div class="col-lg-12">
								<table class="table table-striped table-bordered" id="dtblPgParameter" style="word-wrap: break-word;" width="100%">
									<thead>
										<tr>
											<th >#</th>
											<th >Id</th>
											<th >PG Code</th>
											<th >Payment Gateway</th>
											<th >Parameter Code</th>
											<th >Parameter Name</th>
											<th >Status Code</th>
											<th >Status</th>
											<th >Action</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
							<div class="modal fade" id="modalPgParameter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabelParameters">Add Records</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form"  id="frmPgParameter" name="frmPgParameter">
											<input type="hidden" class="form-control" id="hidPgParameterId" name="hidPgParameterId"/>
											<input type="hidden" class="form-control" id="hidPgParameterCode" name="hidPgParameterCode"/>
											<input type="hidden" class="form-control" id="hidPgParameterName" name="hidPgParameterName"/>
											<input type="hidden" class="form-control" id="hidPgCode" name="hidPgCode"/>
											<input type="hidden" id="hidbtnPgCodeData" name="hidbtnPgCodeData"/>
											<div class="form-group">
												<label for="txtPgCode" class="col-lg-2 col-md-2 col-sm-2 control-label">PG Code</label>
												<div class="col-lg-10 col-md-10 col-sm-10">
													<input type="text" class="form-control" id="txtPgCode" name="txtPgCode" placeholder="Enter Code Here" readonly="readonly">
												</div>
											</div>
											<div class="form-group">
												<label for="txtPgParameterCode" class="col-lg-2 col-md-2 col-sm-2 control-label"><i style="color:red;font-size:15px;">*</i> Parameter Code</label>
												<div class="col-lg-10 col-md-10 col-sm-10">
													<input type="text" class="form-control" maxlength="50"  id="txtPgParameterCode" name="txtPgParameterCode" placeholder="Enter Code Here">
												</div>
												<p class="modalExbottom" style="margin-left: 130px;">Ex: CLIENTID,	CURRENCYCODE</p>
											</div>
											<div class="form-group">
												<label for="txtPgParameterName" class="col-lg-2 col-md-2 col-sm-2 control-label"><i style="color:red;font-size:15px;">*</i> Parameter Name</label>
												<div class="col-lg-10 col-md-10 col-sm-10">
													<input type="text" class="form-control" maxlength="50" id="txtPgParameterName" name="txtPgParameterName" placeholder="Enter Name Here">
												</div>
												<p class="modalExbottom" style="margin-left: 130px;">Ex: Client Id,	Currency Code</p>
											</div>
											<div class="form-group">
												<label for="cmbPGParameterStatus" class="col-lg-2 col-md-2 col-sm-2 control-label"><i style="color:red;font-size:15px;">*</i> Status</label>
												<div class="col-lg-10 col-md-10 col-sm-10">
													<select  class="form-control" id="cmbPGParameterStatus" name="cmbPGParameterStatus">
														<option value="">Select Status</option>
														<option value="1">Active</option>
														<option value="0">In-active</option>
													</select>
												</div>
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-primary" id="btnSavePgParameter"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div>
						</div><!-- /.row -->
                	</div><!--PAYMENT GATEWAY PARAMETER TAB END -->
					<div class="chart tab-pane" id="tabParameterValues"><!--PG PARAMETER VALUES TAB  -->
						<div class="row">
					    	<form class="form-horizontal" role="form"  id="frmParameterValues" name="frmParameterValues">
								<div class="form-group">
									 <div class="col-lg-12 col-md-12 col-sm-12">
									 	<label for="cmbSchool" class="col-lg-2 col-md-2 col-sm-2 control-label"><i style="color:red;font-size:15px;">*</i>Organization:</label>
										<div class="col-lg-3 col-md-3 col-sm-3">
											<select class="form-control selectpicker" data-live-search="true" id="cmbSchool" name="cmbSchool">
											</select>
										</div>
										<label for="cmbPGcode" class="col-lg-2 col-md-2 col-sm-2 control-label"><i style="color:red;font-size:15px;">*</i> Payment Gateway : </label>
										<div class="col-lg-3 col-md-3 col-sm-3">
											<select class="form-control selectpicker" data-live-search="true"  id="cmbPGcode" name="cmbPGcode">
											</select>
										</div>
									</div>
								</div>
							</form>									   
                    	</div>
                    	<div class="col-lg-12">
                    		<table class="table table-striped table-bordered" id="dtblPGParameterValues"style="word-wrap: break-word;" width="100%">
								<thead>
									<tr>
										<th >#</th>
										<th  style="display:none">ID</th>
										<th >PG Code</th>
										<th >PG Parameter Code</th>
										<th >School Code</th>
										<th >School</th>
										<th >Payment Gateway</th>
										<th >Parameter Name</th>
										<th >Parameter Value</th>
										<th >Status Code</th>
										<th >Status</th>
										<th >Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
                    	</div>
                    	<div class="modal fade" id="modalPGParameterValues" tabindex="-1" Resource="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
											&times;
										</button>
										<h4 class="modal-title" id="myModalLabelParameterValue">Add PG ParameterValues</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" id="frmPGParameterValues" name="frmPGParameterValues">
											<input type="hidden" id="hidPgParameterValueId" name="hidPgParameterValueId"/>
											<input type="hidden" id="hidbtnPgParameterData" name="hidbtnPgParameterData"/>
											<!--<input type="hidden" id="hidTemplateTxt" name="hidTemplateTxt"/>-->
											<div class="form-group">
												<label for="" class="col-sm-2 control-label"><i style="color:red;font-size:15px;">*</i>Organization</label>
												<div class="col-sm-10">
													<select class="form-control" id="cmbInstituteMultiselect" name="cmbInstituteMultiselect" multiple="multiple">
														
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="cmbPGCodeModal" class="col-sm-2 control-label"><i style="color:red;font-size:15px;">*</i> Payment Gateway</label>
												<div class="col-sm-10">
													<select class="form-control selectpicker" data-live-search="true"  id="cmbPGCodeModal" name="cmbPGCodeModal">
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="cmbPGParameterModal" class="col-sm-2 control-label"><i style="color:red;font-size:15px;">*</i> Parameter Name</label>
												<div class="col-sm-10">
													<select class="form-control selectpicker" data-live-search="true" id="cmbPGParameterModal" name="cmbPGParameterModal">
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="txtParameterValues" class="col-sm-2 control-label">Parameter Values</label>
												<div class="col-sm-10">
													<input type="input"  class="form-control" maxlength="100" id="txtParameterValues"name="txtParameterValues" placeholder="Enter Parameter Value">
												</div>
												<p class="modalExbottom" style="margin-left: 130px;">Ex: 2545344343TEBSMC, 3398343242ARVIGY</p>
											</div>
											<div class="form-group">
												<label for="cmbPGParameterStatus" class="col-lg-2 col-md-2 col-sm-2 control-label">Status</label>
												<div class="col-lg-10 col-md-10 col-sm-10">
													<select  class="form-control" id="cmbPGParameterValuesStatus" name="cmbPGParameterValuesStatus">
														<option value="1">Active</option>
														<option value="0">In-active</option>
													</select>
												</div>
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-primary" id="btnSaveParameterValues"><i class="fa fa-save"></i>  Save</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
											</div>
										</form>
									</div>	
								</div>
							</div>
						</div><!--TEMPLATE MODAL END-->	
					</div><!--PG PARAMETER VALUES TAB END  -->
                </div>
            </div>
        </div>
    </div>
</div><!-- /#page-wrapper -->
<script type="text/javascript" language="javascript" src="<?=base_url()?>public/assets/js/superadmin/manage_paymentgateway_setup.js"></script>