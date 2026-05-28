<style>
	.modalExbottom
	{
		color:#d2a9a9;
	}
</style>

<div class="content-wrapper">
				<div class="row">
					<!--<div class="col-lg-12">
						<h1 class="page-header">Code Setup:</h1>
					</div>-->
					<!--<section class="content-header">
				      	<h1>
				        	Code Setup
				      	</h1>
				    </section>-->
					<div class="col-lg-12">
						<!--<div class="panel with-nav-tabs panel-primary">
            				<div class="panel-heading">-->
            				<div class="nav-tabs-custom box box-default">
								<ul class="nav nav-tabs" role="tablist">
									<li id="tabCodeGroup" class="active"><a href="#code_group" data-toggle='tab'><b>Code Group</b></a></li>
									<li id="tabCodeDesc"><a href="#code_description" data-toggle='tab'><b>Code Description</b></a></li>
								</ul>
							<!--</div>
							<div class="panel-body">-->
		           				<div class="tab-content">
		      
									<div class="chart tab-pane in active" id="code_group">
										<!--<div class="col-lg-12">
											<h1 class="page-header">Define Code Group:</h1>
										</div>-->
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="dtblCodeGroup" width="100%">
												<thead>
													<tr>
														<th >#</th>
														<th >Group</th>
														<th >Sequence</th>
														<th >Action</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="modalCodeGroup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog"style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Add Code</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal"  id="frmCodeGroup" name="frmCodeGroup">
														<input type="hidden" id="hidCodeGroup" name="hidCodeGroup"/>
														<input type="hidden" id="hidOperTypeCode" name="hidOperTypeCode"/>
														<div id="errorlog_code" style="display: none; color: red; font-size: 9px;"></div>
														<div class="form-group">
															<label for="txtCodeGroup" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Code Group</label>
															<div class="col-sm-9">
																<input type="text" class="form-control" id="txtCodeGroup" name="txtCodeGroup" placeholder="Code Group" maxlength = "30">
															</div>
															<p class="modalExbottom" style="margin-left: 190px;">Ex: FEILD_TYPE, DOCUMENT_TYPE</p>
														</div>
														<div class="form-group">
															<label for="txtCodeGroup" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Sequence No</label>
															<div class="col-sm-9">
																<input type="text" class="form-control" id="txtSequenceNo" name="txtSequenceNo" placeholder="Sequence No" maxlength="5">
															</div>
															<p class="modalExbottom" style="margin-left: 190px;">Ex: 0, 1,.... Serial Wise</p>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="btnSaveCodeGroup"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
								
									<!-- Tab Pane -->
		                            <!-- Code Description Tab -->
		                            <div class="chart tab-pane" id="code_description">
									  	<!--<div class="col-lg-12">
											<h1 class="page-header">Define Code Description:</h1>
										</div>-->
										<form class="form-horizontal" role="form"  id="frmCodeGroup" name="frmCodeGroup">
										   <div class = "form-group">
												<label for="txtCodeGroup" class="control-label col-lg-2">Select Code Group :</label>
												<div class="col-lg-4">
													<select class="form-control" id="cmbCodeGroup" name="cmbCodeGroup">
													</select>
												</div>
												<!--<div class="col-lg-1">
													<button type="button" id="btnAddCodeDesc" class="btn btn-info custombtn btn-circle tooltips" title="Add Code Description"><i class="fa fa-plus"></i></button>
												</div>-->
										  </div>
										</form>
										<div class="col-lg-12">
											<table class="table table-striped table-bordered" id="dtblCodeGroupDesc" >
												<thead>
													<tr>
														<th >#</th>
														<th >Id</th>
														<th >Group</th>
														<th >Code</th>
														<th >Description</th>
														<th >Sequence No</th>
														<th >Action</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
									<div class="modal fade" id="modalCodeGroupDesc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog"style="width: 50%;">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel1">Add Code Description</h4>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form"  id="frmCodeGroupDesc" name="frmCodeGroupDesc">
														<input type="hidden" class="form-control" id="hidGenCodeId" name="hidGenCodeId"/>
														<input type="hidden" class="form-control" id="hidCodeGroupDesc" name="hidCodeGroupDesc"/>
														<input type="hidden" id="hidOperTypeCodeDesc" name="hidOperTypeCodeDesc"/>
														<div id="errorlog_code_desc" style="display: none; color: red; font-size: 9px;"></div>
														<div class="form-group">
															<label for="Code" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Code</label>
															<div class="col-sm-9">
																<input type="text" class="form-control" id="txtCode" name="txtCode" placeholder="Enter Code Here" maxlength="30">
															</div>
															<p class="modalExbottom" style="margin-left: 190px;">Ex: FEILD_TYPE, DOCUMENT_TYPE</p>
														</div>
														<div class="form-group">
															<label for="CodeDesc" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Description</label>
															<div class="col-sm-9">
																<input type="text" class="form-control" id="txtCodeDesc" name="txtCodeDesc" placeholder="Enter Code Description Here" maxlength = "50">
															</div>
															<p class="modalExbottom" style="margin-left: 190px;">Describe about the code type, etc.</p>
														</div>
														<div class="form-group">
															<label for="CodeDesc" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Sequence No</label>
															<div class="col-sm-9">
																<input type="text" class="form-control" id="txtCodeSequenceNo" name="txtCodeSequenceNo" placeholder="Enter Sequence No" maxlength="10">
															</div>
															<p class="modalExbottom" style="margin-left: 190px;">Ex: 0, 1,.... Serial Wise</p>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-primary" id="btnSaveCodeDesc"><i class="fa fa-save"></i>  Save</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-close"></i>  Close</button>  
														</div>
													</form>
												</div>	
											</div>
										</div>
									</div>
									<div class="modal fade" id="codedescdeletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														&times;
													</button>
													<h4 class="modal-title" id="myModalLabel">Delete record</h4>
												</div>
												<div class="modal-body">
												<form>
													<input type="hidden" class="form-control" id="hidGenCodeIdDlt" name="hidGenCodeIdDlt"/>
													<center><h2>Do You Want to Delete This Record?</h2></center>
												</form>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" id="codedescdeleterec"> <i class="fa fa-trash"></i>  Delete</button>
													<button type="button" class="btn btn-primary" data-dismiss="modal"> <i class="fa fa-close"></i>  Close</button>
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
			</div>
			<script type="text/javascript"  src="<?=base_url()?>public/assets/js/superadmin/code_setup.js"></script>