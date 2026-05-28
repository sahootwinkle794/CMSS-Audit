<style>
	.modal-dialog{
		width: 50%;
	}
	.modalExbottom
	{
		color:#d2a9a9;
	}
</style>
<?php
	$institute_code = $this->session->userdata('institute_code'); 
?>
<div class="content-wrapper">
	<div class="row">
		<input type="hidden" name="hidInsCode" id="hidInsCode" value="<?php echo $institute_code ?>"/>
		<!--<div class="col-lg-12">
			<h1 class="page-header">Communiation Setup:</h1>
		</div>-->
		<section class="content-header">
	      	<!--<h1>
	        	Communiation Setup
	      	</h1>-->
	    </section>
		<div class="col-lg-12">
			<!--<div class="panel with-nav-tabs panel-primary">
				<div class="panel-heading">-->
				<div class="nav-tabs-custom box box-default">
					<ul class="nav nav-tabs" role="tablist">
						<li class="active" id="message"><a href="#divMessage" data-toggle='tab'>Message</a></li>
						<li id="email"><a href="#divEmail"  data-toggle='tab'>Email</a></li>
					</ul>
				<!--</div>
				<div class="panel-body">-->
       				<div class="tab-content">
						<div class="chart tab-pane in active" id="divMessage" style="position: relative;"> 
							<div class="col-lg-12 page-header">
								<form class="form-horizontal"  role="form"  id="showformid" name="showformid" method="post">
									<div class="col-lg-12" style="padding-left: 13%;">
										<label class="control control--radio">
										 <input type="radio" name="radShow" id="providerSetupCheckedMsg" value="ProviderSetup" checked >Provider Setup &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<div class="control__indicator"></div>
										</label>
										<label class="control control--radio">
											<input type="radio"  name="radShow" id="smsSetupChecked" value="EmailSetup" >SMS Setup
											<div class="control__indicator"></div>
										</label>
									</div>
								</form>
							</div>
							<div class="col-lg-12 " id = "smsprovidersetup" style="display: none;">
								<table class="table table-striped table-bordered" id="tblsmsprovidersetup" style="overflow: auto">
									<thead>
										<tr>
											<th >#</th>
											<th >Provider</th>
											<th >SMS Url</th>
											<th >User Name</th>
											<th >Password</th>
											<th >Sender</th>
											<th >ID</th>
											<th >Provider Name</th>
											<th >Action</th>
										</tr>
									</thead>
									<tbody>

												</tbody>
											</table>
										</div>
										<div class="col-lg-12" id = "smssetup" style="display: none;" >
											<table class="table table-striped table-bordered" id="tblsmssetup">
												<thead>
													<tr>
														<th >#</th>
														<th >SMS Type</th>
														<th >Subject</th>
														<th >SMS Content</th>
														<th >Provider</th>
														<th >Status</th><!--  HIDE -->
														<th >Status</th>
														<th >ID</th>
														<th >Action</th>
													</tr>
												</thead>
												<tbody>

									</tbody>
								</table>
							</div>
							<!-- Message setup Modals Starts(provider setup) -->
							<div class="modal fade" id="providersetupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop = "static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Add Provider</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" role="form" id="frmprovidersetup">
												<div id="errorlog_provider" style="display: none; color: red; font-size: 12px;"></div>
												<input type="hidden" id="hidOperProvider" name="hidOperProvider"/>
												<div class="form-group">
													<!--<label for="inputname" class="col-sm-2 control-label">Class ID</label>-->
													<div class="col-sm-10">
														<input type="hidden" class="form-control" id="hidproviderid" name="hidproviderid">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Provider:</label>
													<div class="col-sm-9">
														<input type="text" id="txtprovider" maxlength="20" class="form-control tooltips"name="txtprovider" placeholder="" title="Email Provider name"></input>
													</div>
													<p class="modalExbottom" style="margin-left: 180px;">Ex: Web SMS,SandeshLive</p>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> SMS Url:</label>
													<div class="col-sm-9">
														<textarea id="txtsmsUrl" maxlength="200" class="form-control tooltips"name="txtsmsUrl" placeholder="" title="Enter SMS Url" style = "height: 120px;"></textarea>
													</div>
													<p class="modalExbottom" style="margin-left: 180px;">Ex: HTTP API URL</p>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> User Name:</label>
													<div class="col-sm-9">
														<input type="text" id="txtUserName" maxlength="50" class="form-control tooltips"name="txtUserName" placeholder="User Name" title="Enter User Name"></input>
													</div>
													<p class="modalExbottom" style="margin-left: 180px;">Ex: abcdpqrs</p>
												</div>
												
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Password:</label>
													<div class="col-sm-9">
														<input type="text" id="txtsmspassword" maxlength="50" class="form-control tooltips"name="txtsmspassword" placeholder="SMS Password" title="SMS Password"></input>
													</div>
													<p class="modalExbottom" style="margin-left: 180px;">Ex: password</p>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Sender:</label>
													<div class="col-sm-9">
														<input type="text" id="txtSender"class="form-control tooltips" maxlength="50" name="txtSender" placeholder="Sender Name" title="Sender Name"></input>
													</div>
													<p class="modalExbottom" style="margin-left: 180px;">Ex: EDUSOL</p>
												</div>
												
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="classaddsave"><i class="fa fa-save"></i>  Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>	
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade" id="providersetupModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop = "static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Edit Provider</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" role="form" id="frmprovidersetupEdit">
												<div class="form-group">
													<div id="errorlog_provider_edit" style="display: none; color: red; font-size: 12px;"></div>
													<input type="hidden" id="hidOperProviderEdit" name="hidOperProviderEdit"/>
													<!--<label for="inputname" class="col-sm-2 control-label">Class ID</label>-->
													<div class="col-sm-10">
														<input type="hidden" class="form-control" id="hidprovideridEdit" name="hidprovideridEdit">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Provider:</label>
													<div class="col-sm-9">
														<input type="text" id="txtproviderEdit"class="form-control tooltips" maxlength="20" name="txtproviderEdit" placeholder="" title="Email Provider name"></input>
													</div>
													<p class="modalExbottom" style="margin-left: 180px;">Ex: Web SMS,SandeshLive</p>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> SMS Url:</label>
													<div class="col-sm-9">
														<textarea id="txtsmsUrlEdit"class="form-control tooltips"name="txtsmsUrlEdit" maxlength="200"  placeholder="" title="Enter SMS Url" style = "height: 130px;"></textarea>
													</div>
													<p class="modalExbottom" style="margin-left: 180px;">Ex: HTTP API URL</p>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> User Name:</label>
													<div class="col-sm-9">
														<input type="text" id="txtUserNameEdit"class="form-control tooltips"name="txtUserNameEdit" maxlength="50"  placeholder="" title="Enter User Name"></input>
													</div>
													<p class="modalExbottom" style="margin-left: 180px;">Ex: abcdpqrs</p>
												</div>
												
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Password:</label>
													<div class="col-sm-9">
														<input type="text" id="txtsmspasswordEdit"class="form-control tooltips"name="txtsmspasswordEdit" maxlength="50"  placeholder="SMS Password" title="SMS Password"></input>
													</div>
													<p class="modalExbottom" style="margin-left: 180px;">Ex: password</p>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Sender:</label>
													<div class="col-sm-9">
														<input type="text" id="txtSenderEdit"class="form-control tooltips"name="txtSenderEdit" maxlength="50"  placeholder="" title="Sender Name"></input>
													</div>
													<p class="modalExbottom" style="margin-left: 180px;">Ex: EDUSOL</p>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="save"><i class="fa fa-save"></i>  Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>	
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!-- sms Setup Modals Starts -->
							<div class="modal fade" id="smssetupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop = "static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Add SMS</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" role="form" id="frmsmssetup">
												<div id="errorlog_sms" style="display: none; color: red; font-size: 12px;"></div>
												<div class="form-group">
													<!--<label for="inputname" class="col-sm-2 control-label">Class ID</label>-->
													<div class="col-sm-10">
														<input type="hidden" class="form-control" id="hidsmsid" name="hidsmsid">
														<input type="hidden" id="hidOperSmsSetup" name="hidOperSmsSetup" value="add_sms"/>
													</div>
												</div>
												
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i>SMS Type:</label>
													<div class="col-sm-8">
														<select class="form-control" id = "cmbsmsType" name= "cmbsmsType">
															<option value="">Select SMS Type</option>
															<option value="SUBMISSION OF APPLICATION">SUBMISSION OF APPLICATION</option>
															<option value="BANK DOCUMENT VERIFICATION">BANK DOCUMENT VERIFICATION</option>
															<option value="ADMIT CARD GENERATION">ADMIT CARD GENERATION</option>
															<option value="EXAM ADMIT CARD GENERATION">EXAM ADMIT CARD GENERATION</option>
															<option value="RESULT PUBLICATION">RESULT PUBLICATION</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Subject:</label>
													<div class="col-sm-8">
														<input type="text" id="txtSubject"class="form-control tooltips"name="txtSubject" maxlength="200"  placeholder="" title="Subject"></input>
														<p class="modalExbottom">SMS Subject</p>
													</div>
													
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> SMS Content:</label>
													<div class="col-sm-8">
														<textarea class="form-control tooltips" id = "txtContent" name = "txtContent" title="SMS Content" maxlength="500"  style="height: 100px;">
															
														</textarea>
														<p class="modalExbottom">SMS Content</p>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Provider:</label>
													<div class="col-sm-8">
														<select id="cmbsmsProvider"class="form-control tooltips"name="cmbsmsProvider" title="Provider" maxlength="50"  title="Provider Name">
															<option value="">Select Provider</option>
														</select>
														
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Status:</label>
													<div class="col-sm-8">
														<select class="form-control" id = "cmbStatus" title="Status" name = "cmbStatus">
															<option value="">Select Status</option>
															<option value = "ACTIVE">ACTIVE </option>
															<option value = "INACTIVE">IN-ACTIVE </option>
														</select>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="addsave"><i class="fa fa-save"></i>  Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>	
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade" id="smssetupModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop = "static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Edit SMS</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" role="form" id="frmsmssetupEdit">
												<div class="form-group">
													<div id="errorlog_sms_edit" style="display: none; color: red; font-size: 12px;"></div>
													<!--<label for="inputname" class="col-sm-2 control-label">Class ID</label>-->
													<div class="col-sm-10">
														<input type="hidden" class="form-control" id="hidsmsidEdit" name="hidsmsidEdit">
														<input type="hidden" id="hidOperSmsSetupEdit" name="hidOperSmsSetupEdit" value="edit_sms"/>
													</div>
												</div>
												
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> SMS Type:</label>
													<div class="col-sm-8">
														<input type="hidden" class="form-control" id="hidsmsTypeEdit" name="hidsmsTypeEdit">
														<input type="text" class="form-control" id="cmbsmsTypeEdit" name="cmbsmsTypeEdit" readonly>
														<!--<select class="form-control" id = "cmbsmsTypeEdit" name= "cmbsmsTypeEdit">
															<option value="SUBMISSION OF APPLICATION">SUBMISSION OF APPLICATION</option>
															<option value="BANK DOCUMENT VERIFICATION">BANK DOCUMENT VERIFICATION</option>
															<option value="ADMIT CARD GENERATION">ADMIT CARD GENERATION</option>
															<option value="RESULT PUBLICATION">RESULT PUBLICATION</option>
														</select>-->
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Subject:</label>
													<div class="col-sm-8">
														<input type="text" id="txtSubjectEdit"class="form-control tooltips" maxlength="200" name="txtSubjectEdit" placeholder="" title="Subject"></input>
														<p class="modalExbottom">SMS Subject</p>
													</div>
													
													
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> SMS Content:</label>
													<div class="col-sm-8">
														<textarea class="form-control tooltips" id = "txtContentEdit" maxlength="500"  name = "txtContentEdit" style="height: 100px;">
															
														</textarea>
														<p class="modalExbottom">SMS Content</p>
													</div>
													
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Provider:</label>
													<div class="col-sm-8">
														<select class="form-control tooltips" id = "cmbsmsProviderEdit" maxlength="50"  name="cmbsmsProviderEdit" title="Provider Name">
															
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Status:</label>
													<div class="col-sm-8">
														<select class="form-control" id = "cmbStatusEdit" name = "cmbStatusEdit">
															<option value = "ACTIVE">ACTIVE </option>
															<option value = "INACTIVE">IN-ACTIVE </option>
														</select>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="editsave"><i class="fa fa-save"></i>  Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>	
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div><!-- 1st Tab -->
						<div class="chart tab-pane" id="divEmail" style="position: relative;">
							<div class="col-lg-12 page-header">
								<form class="form-horizontal" role="form"  id="showformid" name="showformid" method="post">
									<input type="hidden" name="hidSession" id="hidSession" value=""/>
									<div class="col-lg-12" style="padding-left: 13%;">
										<label class="control control--radio">
											<input type="radio" name="radShow" id="emailProviderSetupChecked" value="ProviderSetup" checked>Provider Setup &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<div class="control__indicator"></div>
										</label>
										<label class="control control--radio">
										 	<input type="radio" name="radShow" id="emailSetupChecked" value="EmailSetup" >Email Setup
											<div class="control__indicator"></div>
										</label>
									</div>
								</form>
							</div>
							<div class="col-lg-12" id = "emailprovidersetup" >
								<table class="table  table-striped table-bordered" id="tblemailprovidersetup">
									<thead>
										<tr>
											<th >#</th>
											<th >Provider</th>
											<th >Host</th>
											<th >Port</th>
											<th >Mail ID</th>
											<th >Password</th>
											<th >SMTP Auth</th>
											<th >SMTP Secure</th>
											<th >ID</th>
											<th >Provider Name</th>
											<th >Action</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
							<div class="col-lg-12" id = "emailsetup" style="display: none;">
								<table class="table table-striped table-bordered" id="tblemailsetup">
									<thead>
										<tr>
											<th >#</th>
											<th >Mail Type</th>
											<th >Subject</th>
											<th >Content</th>
											<th >Provider</th>
											<th >Status</th><!--  HIDE -->
											<th >Status</th>
											<th >ID</th>
											<th >Action</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
							<!-- Email Setup provider modals starts -->
							<div class="modal fade" id="emailProvidersetupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop = "static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
												&times;
											</button>
											<h4 class="modal-title" id="myModalLabel">Add Provider</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal" role="form" id="frmemailprovidersetup">
												<div id="errorlog_email_provider" style="display: none; color: red; font-size: 12px;"></div>
												<div class="form-group">
													<!--<label for="inputname" class="col-sm-2 control-label">Class ID</label>-->
													<div class="col-sm-10">
														<input type="hidden" class="form-control" id="hidEproviderid" name="hidEproviderid">
														<input type="hidden" id="hidOperEmailProvider" name="hidOperEmailProvider" value="add_email_provider">
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Provider:</label>
													<div class="col-sm-8">
														<input type="text" id="txtproviderEmail"class="form-control tooltips" maxlength="50" name="txtproviderEmail" placeholder="" title="Email Provider name"></input>
														<p class="modalExbottom">Ex: Gmail,Yahoo</p>
													</div>
													
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Host:</label>
													<div class="col-sm-8">
														<input type="text" id="txtHost"class="form-control tooltips"name="txtHost" maxlength="50"  placeholder="" title="Enter Host Name"></input>
														<p class="modalExbottom">Ex: smtp.gmail.com</p>
													</div>
													
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Port:</label>
													<div class="col-sm-8">
														<input type="text" id="txtMailPort"class="form-control tooltips"name="txtMailPort"  maxlength="10" placeholder="" title="Enter Port Number"></input>
														<p class="modalExbottom">Ex: 465</p>
													</div>
													
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Email ID:</label> 
													<div class="col-sm-8">
														<input type="text" id="txtemailID"class="form-control tooltips"name="txtemailID" maxlength="100"  placeholder="" title="Enter Your Email ID"></input>
														<p class="modalExbottom">Ex: xxxxxxx@xxx.com</p>
													</div>
													
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Password:</label>
													<div class="col-sm-8">
														<input type="text" id="txtmailpassword"class="form-control tooltips"name="txtmailpassword" maxlength="50"  placeholder="" title="Email Password"></input>
														<p class="modalExbottom">Email Password</p>
													</div>
													
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> SMTP Auth:</label> 
													<div class="col-sm-8">
														<select class="form-control" id = "txtSmtpauth" title="SMTP Auth" name = "txtSmtpauth">
															<option value="">Select SMTP Auth</option>
															<option value="true" selected>True</option>
															<option value="false">False</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> SMTP Secure:</label>
													<div class="col-sm-8">
														<select class="form-control" id = "txtSmtpsecure" title="SMTP Secure" name = "txtSmtpsecure">
															<option value="">Select SMTP Secure</option>
															<option value="ssl" selected>SSL</option>
															<option value="tsl">TSL</option>
														</select>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" id="classaddsave"><i class="fa fa-save"></i>  Save</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>	
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
								<div class="modal fade" id="emailprovidersetupModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop = "static">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
													&times;
												</button>
												<h4 class="modal-title" id="myModalLabel">Edit Provider</h4>
											</div>
											<div class="modal-body">
												<form class="form-horizontal" role="form" id="frmemailprovidersetupEdit">
													<div id="errorlog_email_provider_edit" style="display: none; color: red; font-size: 12px;"></div>
													<div class="form-group">
														<!--<label for="inputname" class="col-sm-2 control-label">Class ID</label>-->
														<div class="col-sm-10">
															<input type="hidden" class="form-control" id="hidEprovideridEdit" name="hidEprovideridEdit">
															<input type="hidden"  id="hidOperEmailProviderEdit" name="hidOperEmailProviderEdit" value="edit_email_provider">
														</div>
													</div>
													<div class="form-group">
														<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Provider:</label>
														<div class="col-sm-8">
															<input type="text" id="txtMailProviderEdit"class="form-control tooltips" maxlength="100" name="txtMailProviderEdit" placeholder="" title="Email Provider name"></input>
															<p class="modalExbottom">Ex: Gmail,Yahoo</p>
														</div>
														
													</div>
													<div class="form-group">
														<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Host:</label>
														<div class="col-sm-8">
															<input type="text" id="txtMailHostEdit"class="form-control tooltips" maxlength="50" name="txtMailHostEdit" placeholder="" title="Enter Host Name"></input>
															<p class="modalExbottom">Ex: smtp.gmail.com</p>
														</div>
														
													</div>
													<div class="form-group">
														<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Port:</label>
														<div class="col-sm-8">
															<input type="text" id="txtMailPortEdit"class="form-control tooltips" maxlength="50" name="txtMailPortEdit" placeholder="" title="Enter Port Number"></input>
															<p class="modalExbottom">Ex: 465</p>
														</div>
														
													</div>
													<div class="form-group">
														<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Email ID:</label> 
														<div class="col-sm-8 ">
															<input type="text" id="txtemailIDEdit"class="form-control tooltips" maxlength="200" name="txtemailIDEdit" placeholder="" title="Enter Your Email ID"></input>
															<p class="modalExbottom">Ex: xxxxxxx@xxx.com</p>
														</div>
														
													</div>
													<div class="form-group">
														<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Password:</label>
														<div class="col-sm-8">
															<input type="text" id="txtmailpasswordEdit"class="form-control tooltips" maxlength="50" name="txtmailpasswordEdit" placeholder="" title="Email Password"></input>
															<p class="modalExbottom">Email Password</p>
														</div>
														
													</div>
													<div class="form-group">
														<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> SMTP Auth:</label> 
														<div class="col-sm-8">
															<select class="form-control" id = "txtSmtpauthEdit" name = "txtSmtpauthEdit">
																<option value="true">True</option>
																<option value="false">False</option>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> SMTP Secure:</label>
														<div class="col-sm-8">
															<select class="form-control" id = "txtSmtpsecureEdit" name = "txtSmtpsecureEdit">
																<option value="ssl">SSL</option>
																<option value="tsl">TSL</option>
															</select>
														</div>
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-primary" id="save"><i class="fa fa-save"></i>  Save</button>
														<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>	
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<!-- email setup modals starts -->
								<div class="modal fade" id="emailsetupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop = "static">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
													&times;
												</button>
												<h4 class="modal-title" id="myModalLabel">Add Email</h4>
											</div>
											<div class="modal-body">
												<form class="form-horizontal" role="form" id="frmemailsetup">
													<div id="errorlog_email" style="display: none; color: red; font-size: 12px;"></div>
													<div class="form-group">
														<!--<label for="inputname" class="col-sm-2 control-label">Class ID</label>-->
														<div class="col-sm-10">
															<input type="hidden" class="form-control" id="hidemailid" name="hidemailid">
															<input type="hidden" class="form-control" id="hidOperEmail" name="hidOperEmail" value="add_email">
														</div>
													</div>
													
													<div class="form-group">
														<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Mail Type:</label>
														<div class="col-sm-8">
															<select class="form-control" id = "cmbMailType" name= "cmbMailType">
																<option value="">Select Mail Type</option>
																<option value="SUBMISSION OF APPLICATION">SUBMISSION OF APPLICATION</option>
																<option value="BANK DOCUMENT VERIFICATION">BANK DOCUMENT VERIFICATION</option>
																<option value="ADMIT CARD GENERATION">ADMIT CARD GENERATION</option>
																<option value="RESULT PUBLICATION">RESULT PUBLICATION</option>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Subject:</label>
														<div class="col-sm-8">
															<input type="text" id="txtSubject"class="form-control tooltips"name="txtSubject" maxlength="100"  placeholder="" title="Subject"></input>
															<p class="modalExbottom">Subject of Email</p>
														</div>
														
													</div>
													<div class="form-group">
														<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Content:</label>
														<div class="col-sm-8">
															<textarea class="form-control tooltips" id = "txtContent" name = "txtContent" style="height: 100px;">
																
															</textarea>
															<p class="modalExbottom">Content of Email</p>
														</div>
														
													</div>
													<div class="form-group">
														<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Provider:</label>
														<div class="col-sm-8">
															<select id="cmbEmailProvider"class="form-control tooltips"name="cmbEmailProvider" maxlength="50"  title="Provider Name">
																<option value=""> Select Provider </option>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Status:</label>
														<div class="col-sm-8">
															<select class="form-control" id = "cmbStatus" name = "cmbStatus">
																<option value="">Select Status</option>
																<option value = "ACTIVE">ACTIVE </option>
																<option value = "INACTIVE">IN-ACTIVE </option>
															</select>
														</div>
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-primary" id="addsave"><i class="fa fa-save"></i>  Save</button>
														<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>	
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<div class="modal fade" id="emailsetupModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop = "static">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
													&times;
												</button>
												<h4 class="modal-title" id="myModalLabel">Edit Email</h4>
											</div>
											<div class="modal-body">
												<form class="form-horizontal" role="form" id="frmemailsetupEdit">
													<div id="errorlog_email_edit" style="display: none; color: red; font-size: 12px;"></div>
													<div class="form-group">
														<!--<label for="inputname" class="col-sm-2 control-label">Class ID</label>-->
														<div class="col-sm-10">
															<input type="hidden" class="form-control" id="hidemailidEdit" name="hidemailidEdit">
															<input type="hidden" class="form-control" id="hidOperEmailEdit" name="hidOperEmailEdit" value="edit_email">
														</div>
													</div>
													
													<div class="form-group">
														<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Mail Type:</label>
														<div class="col-sm-8">
															<input type="hidden" class="form-control" id="hidMailTypeEdit" name="hidMailTypeEdit">
															<input type="text" class="form-control" id="cmbMailTypeEdit" name="cmbMailTypeEdit" readonly>
															<!--<select class="form-control" id = "cmbMailTypeEdit" name= "cmbMailTypeEdit">
																<option value="SUBMISSION OF APPLICATION">SUBMISSION OF APPLICATION</option>
																<option value="BANK DOCUMENT VERIFICATION">BANK DOCUMENT VERIFICATION</option>
																<option value="ADMIT CARD GENERATION">ADMIT CARD GENERATION</option>
																<option value="RESULT PUBLICATION">RESULT PUBLICATION</option>
															</select>-->
														</div>
													</div>
													<div class="form-group">
														<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Subject:</label>
														<div class="col-sm-8">
															<input type="text" id="txtemailSubjectEdit"class="form-control tooltips" maxlength="100" name="txtemailSubjectEdit" placeholder="" title="Subject"></input>
															<p class="modalExbottom">Subject of Email</p>
														</div>
														
													</div>
													<div class="form-group">
														<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Content:</label>
														<div class="col-sm-8">
															<textarea class="form-control tooltips" id = "txtemailContentEdit" name = "txtemailContentEdit" style="height: 100px;">
																
															</textarea>
															<p class="modalExbottom">Content of Email</p>
														</div>
														
													</div>
													<div class="form-group">
														<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Provider:</label>
														<div class="col-sm-8">
															<select class="form-control tooltips" id = "cmbEmailProviderEdit"  maxlength="50" name="cmbEmailProviderEdit" title="Provider Name">
																
															</select>
														</div>
													</div>
													<div class="form-group">
														<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Status:</label>
														<div class="col-sm-8">
															<select class="form-control" id = "cmbStatusEdit1" name = "cmbStatusEdit1">
																<option value = "ACTIVE">ACTIVE </option>
																<option value = "INACTIVE">IN-ACTIVE </option>
															</select>
														</div>
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-primary" id="editsave"><i class="fa fa-save"></i>  Save</button>
														<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>	
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div><!-- 2nd tab -->
						</div>
					</div>	
					<!--</div>
				</div>-->
			</div>
		</div>
	</div>
	<script type="text/javascript">
$(document).ready(function(){
$("#providerSetupCheckedMsg").click(function(){
	$('#smsprovidersetup').show("slide");
	$('#smssetup').hide("slide");
});
$("#smsSetupChecked").click(function(){
	$('#smssetup').show("slide");
	$('#smsprovidersetup').hide("hide");
});
//--------------------------------------
$("#emailProviderSetupChecked").click(function(){
	$('#emailprovidersetup').show("slide");
	$('#emailsetup').hide("slide");
});
$("#emailSetupChecked").click(function(){
	$('#emailsetup').show("slide");
	$('#emailprovidersetup').hide("slide");
});
});
</script>
<script type="text/javascript" src="<?=base_url()?>public/assets/js/superadmin/communication_setup.js"></script>