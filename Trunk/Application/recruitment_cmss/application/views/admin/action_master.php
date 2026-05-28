<div class="content-wrapper">
	<!--<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">News and Announcements</h1>
        </div>
    </div>-->
    <section class="content-header">
      	<h1>
        	Action Master
      	</h1>
    </section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-default">
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
						
							<!--<form class="form-horizontal" method="post" role="form" id="frmactionmaster" name="frmactionmaster">
								<input type="hidden" name="hidTemplate" id="hidTemplate" value=""/>
								
							    <div class="form-group"
									<input type="hidden" name="removeid" id="removeid" value="" />-->
									<table class="table table-striped table-bordered " id="tblactionmaster">
										<thead>
											<tr>
												<th >Sl. No.</th>
												<th  hidden="">Id</th>
												<th  hidden="">program code</th>
												<th >Program Name</th>
												<th >Action Name</th>
												<th >Start Date</th>
												<th >End Date</th>
												<th >Status</th>
												<th class="text-center">
													<label class="control control--checkbox" style="margin-top: 5px;">  
														<!--<input type="checkbox" id="chkAll" name="chkAll" value=""/>-->
														<div class="control__indicator"></div>
													</label>Homepage View
												</th>
												<th  hidden="">Round</th>
												<th >Action</th>	
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								<!--</div>
						    </form>-->	
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div class="modal fade" id="actionmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog" style="width: 50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				&times;</button>
				<h4 class="modal-title" id="myModalLabel"> </h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="actionForm" name="actionForm">
					<div id="errorlog" style="display: none; color: red; font-size: 12px;"></div>
					<input type="hidden" id="hidid" name="hidid" value=""/>
					<input type="hidden" id="hidOperType" name="hidOperType" value="add_action_master"/>
					<input type="hidden" class="form-control" id="hidAction" name="hidAction" value="Add">
					
					<div class="form-group">
						<label for="cmbProgramName" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Program Name</label>						
						<div class="col-sm-9">
							 <select class="form-control" name="cmbProgramName" id="cmbProgramName">
								<option value=''>Select Program Name</option>							
							 </select>
						</div>
					</div>
					<!--<div class="form-group">
						<label for="txtactionname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Action Name</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" name="txtactionname" id="txtactionname" value=""autocomplete="off">
						</div>
					</div>-->
					<div class="form-group">
						<label for="txtactionname" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Action Name</label>						
						<div class="col-sm-9">
							 <select class="form-control" name="txtactionname" id="txtactionname">
								<option value="other" id="other">Other</option>							
							 </select>
						</div>
                        
					</div>
					<div class="form-group" id="actionname2" ">
						<label for="txtactionname2" class="col-sm-3 control-label"> </label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" name="txtactionname2" id="txtactionname2" value="" autocomplete="off">
						</div>
				    </div>
					
					<div class="form-group">
						<label for="txtround" class="col-sm-3 control-label">&nbsp;&nbsp;Round No</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" name="txtround" id="txtround" readonly="" value=""autocomplete="off">
						</div>
					</div>
					
					<div class="form-group">
						<label for="txtstartdate" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Start Date</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" name="txtstartdate" id="txtstartdate" readonly="" value=""autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<label for="txtenddate" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> End Date</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" name="txtenddate" id="txtenddate" readonly="" value=""autocomplete="off">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Status</label>
						<div class="col-sm-9">
							<select class="form-control tooltips" id="cmbRecordStatus" name="cmbRecordStatus" title="Select Status">
								<option value="1" selected>Active</option>
								<option value="0" >Inactive</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" id="programaddsave"><i class="fa fa-save"></i>  Save</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
					</div>
				</form>
			</div>	
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/datetimepickermoment.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/datetimepickerjs.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/action_master.js"></script>     