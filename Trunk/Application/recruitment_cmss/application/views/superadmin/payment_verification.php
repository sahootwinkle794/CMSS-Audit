	<?php
		date_default_timezone_set('Asia/Kolkata');
		$today = date('d-m-Y', time());
	?>
			<div class="content-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<input type="hidden" id="hidSession" name="hidSession" value="" />
					<!--<div class="panel with-nav-tabs panel-primary" style="margin-top: 20px">
        				<div class="panel-heading">-->
        				<div class="nav-tabs-custom box box-default">	
							<ul class="nav nav-tabs" role="tablist">
								<li class="active"><a href="#verification" data-toggle='tab'>Verification</a></li>
								<li><a href="#upload" data-toggle='tab'>Upload</a></li>
							</ul>
						<!--</div>
						<div class="panel-body">-->
							<div class="tab-content">
								<div class="chart tab-pane in active" id="verification">
									<!--<div class="col-lg-12">
										<h1 class="page-header">Online Payment List:</h1>
									</div>-->
									<div class="col-lg-12">
										<table class="table table-striped table-bordered" id="dtblOnlinePayments" width="100%">
											<thead>
												<tr>
													<th >#</th>
													<th >Institute Code</th>
													<th >Institute Name</th>
													<th >Online Success Payment(Upto Today )</th>
													<th >Payment Gateway Amount(Upto Today )</th>
													<th >Online Initiated & Success Amount(Upto Today ) </th>
													<th >Action</th>
												</tr>
											</thead>
											<tbody>

											</tbody>
										</table>
									</div>	
								</div>
								<div class="chart tab-pane" id="upload">
									<!--<div class="col-lg-12">
										<h1 class="page-header">Payment Gateway report:</h1>
									</div>-->
									<div class="col-lg-12">
										<div class="col-sm-12">
											<div class="form-group">
												<label class="col-sm-2" class="control-label">Transaction Date:</label>
												<div class="col-sm-3">
													<input type="text" readonly="readonly" class="form-control" name="txtDateFilter" id="txtDateFilter" value="<?=$today?>"/>
												</div>
												<div class="col-sm-2 col-sm-offset-5">
													<button id="btnUploadReport" class="btn btn-info custombtn"><i class="fa fa-upload"></i> Upload</button>
												</div>
											</div>
										</div>
										<div class="col-sm-12">
											<div style="overflow-x: auto">
												<table class="table table-striped table-bordered" id="dtblPgReport" width="100%">
													<thead>
														<tr>
															<th >#</th>
															<th >Order id</th>
															<th >Transaction Id</th>
															<th >Transaction Date</th>
															<th >Payment Date</th>
															<th >Customer Details</th>
															<th >Bank Transaction Id</th>
															<th >Gross Amount</th>
															<th >Payment Gateway charge</th>
															<th >Net Amount</th>
															<th >Bank Name</th>
															<th >Transaction Status</th>
															<th >Merchant Name</th>
															<th >Payment Remark</th>
															<th >Refund Date</th>
															<th >Refund Status</th>
															<th >Refund Amount</th>
														</tr>
													</thead>
													<tbody>

													</tbody>
												</table>
											</div>
										</div>
									</div>	
								</div>
							</div>
						</div>	
						<!--</div>
					</div>-->
					</div>
				</div><!-- /.row -->
			</div>
			<link href="<?=base_url()?>public/assets/css/datepicker3.css" rel="stylesheet" />
			<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/bootstrap-datepicker.js" ></script>

<script type="text/javascript" language="javascript" src="<?=base_url()?>public/assets/js/superadmin/payment_verification.js"></script>