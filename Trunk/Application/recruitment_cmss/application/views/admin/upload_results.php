<div class="content-wrapper">
	<section class="content-header">
      	<h1>
        	Result Upload
      	</h1>
    </section>
	
	<!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-default">
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
							<form class="form-horizontal" method="post" role="form" id="frmApplyNew" name="frmApplyNew">
								<input type="hidden" name="hidProgram" id="hidProgram" value=""/>
							</form>
							<!--<div class="col-sm-2">
								
							</div>-->
							<div class="row">
								<div class="col-lg-12">
						        	
						            <!--<h1 class="page-header">Result Upload</h1>-->
						            <div class="form-group">
										<label for="" class="control-label col-sm-2" id ="cmbProgramGroupl" >Recruitment Drive:</label>
										<div class="col-sm-2">
											<select class="form-control" name="cmbProgramGroup" id="cmbProgramGroup">
											</select>
										</div>
										<label for="" class="control-label col-sm-1" style="text-align:left;" id="cmbPrograml">Post:</label>
										<div class="col-sm-2">
											<select class="form-control" name="cmbProgram" id="cmbProgram">
												<option value=''>Select Post</option>
											</select>
										</div>
										<label for="" class="control-label col-sm-1" style="text-align:left;">Round:</label>
										<div class="col-sm-2">
											<select class="form-control" name="cmbRound" id="cmbRound">
												<!--<option value=''>Select Round</option>
												<option value='1'>1</option>
												<option value='2'>2</option>
												<option value='3'>3</option>
												<option value='4'>4</option>-->
											</select>
										</div>
										<div class="col-sm-1" >
											<button type="button" class="btn btn-info tooltips" name="btnFilter" id="btnFilter" title="Filter Application"><i class="fa fa-filter"></i> &nbsp;Filter</button>
										</div>
									</div>
									<br /><br /><br />
						        </div>
						    	<!-- /.col-lg-12 -->
							</div>
							 &nbsp; &nbsp;
							<button id="btnUploadReport" class="btn btn-success "><i class="fa fa-upload"></i> Fetch Result</button> &nbsp; &nbsp;
							<button id='btnPublishResult' type="submit" class='btn btn-success tooltips' title='Publish Result'> Publish Result</button>
							<br /><br /><br /><br />
							<table class="table table-striped table-bordered " id="dtblApplicationDetail">
								<thead>
									<tr>
										<th >#</th>
										<th >Name</th>
										<th >Roll No</th>
										<th >Appl No</th>
										<th >Mark</th>
										<th >Result</th>
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
		<div class="modal fade" id="modalNodalCentre" tabindex="-1" Resource="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModalLabel">Add Records</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" Resource="form"  id="frmNodalCentre" name="frmNodalCentre">
							<!--<input type="hidden" id="hidProgramCode" name="hidProgramCode"/>
							<input type="hidden" id="hidRank" name="hidRank"/>-->
							<div class="form-group">
								<label for="txtCodeGroup" class="col-sm-4 control-label">Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="txtName" name="txtName" placeholder="Applicant Name">
								</div>
							</div>
							<div class="form-group">
								<label for="txtCodeGroup" class="col-sm-4 control-label">Appl No</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="txtApplNo" name="txtApplNo" placeholder="Appl No">
								</div>
							</div>
							<div class="form-group">
								<label for="txtCodeGroup" class="col-sm-4 control-label">Roll No</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="txtRollNo" name="txtRollNo" placeholder="Roll No">
								</div>
							</div>
							<div class="form-group">
								<label for="txtCodeGroup" class="col-sm-4 control-label">Mark</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="txtRank" name="txtRank" placeholder="Mark">
								</div>
							</div>
							<div class="form-group">
								<label for="txtCodeGroup" class="col-sm-4 control-label">Result</label>
								<div class="col-sm-8">
									<select id="cmbResult" class="form-control tooltips" name="cmbResult"  title="Choose Result">
  										<option value="">Select Result</option>
  										<option value="Selected">Selected</option>
  										<option value="Not Selected">Not Selected</option>
  									</select>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary" id="btnSaveNodalCentre">Save</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
							</div>
						</form>
					</div>	
				</div>
			</div>
		</div>
		 <!-- Modal for publish result-->
		<div class="modal fade" id="modalPublish" tabindex="-1" Resource="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
			<div class="modal-dialog" style="width: 50%">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModalPublish">Publish</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" Resource="form"  id="frmNodalPublish" name="frmNodalPublish">
							<input type="hidden" id="hidRollNo" name="hidRollNo"/>
							
							<div class="form-group">
											
								<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> From Date</label>
								<div class="col-sm-4">
									<input type="text" class="form-control tooltips" id="txtAvailableFrom" name="txtAvailableFrom" placeholder="Pick Start Date" title="Pick Start Date" value="" readonly=""/>
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> To Date</label>
								<div class="col-sm-4">
									<input type="text" class="form-control tooltips" id="txtAvailableUpto" name="txtAvailableUpto" placeholder="Pick End Date" title="Pick End Date" value="" readonly=""/>
								</div>
							</div>
							
							<div class="form-group">
								<label for="" class="col-sm-8 control-label" style="color: red"><i style="color:red;font-size:15px;">*</i> Do you want to continue for next admit card generation?</label>
								<div class="col-sm-4">
									<label class="radio-inline">
										<input type="radio" name="radioAdmitCard" class="radioAdmitCard" id="radioYes" value="Y"> Yes
									</label>
									<label class="radio-inline">
										<input type="radio" name="radioAdmitCard" class="radioAdmitCard" id="radioNo" value="N"> No
									</label>
								</div>
							</div>
							
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary" id="btnSaveNodalPublish">Save</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
							</div>
						</form>
					</div>	
				</div>
			</div>
		</div>
	
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<link href="<?php echo base_url(); ?>public/assets/js/buttons.dataTables.min.css" type="text/css" />
<script src="<?php echo base_url(); ?>public/assets/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/jszip.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/pdfmake.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/vfs_fonts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/buttons.html5.min.js" type="text/javascript"></script>

<link href="<?php echo base_url(); ?>public/css/datepicker3.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/upload_results.js?v=3"></script>

   