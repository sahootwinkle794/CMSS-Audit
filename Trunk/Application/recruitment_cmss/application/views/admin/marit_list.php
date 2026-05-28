<div class="content-wrapper">
	<!--<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Marit List</h1>
        </div>
    </div>-->
    <section class="content-header">
      	<h1>
        	Merit List
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
								<input type="hidden" name="hidTemplate" id="hidTemplate" value=""/>
								<div class="form-group" style="padding-top: 12px;padding-bottom:12px;">
									<label for="" class="control-label col-sm-2" >Program Group:</label>
									<div class="col-sm-3">
										<select class="form-control" name="cmbProgramGroup" id="cmbProgramGroup">
											<option value=''>Select</option>
										</select>
									</div>
									
									<label for="" class="control-label col-sm-1" >Program:</label>
									<div class="col-sm-4">
										<select class="form-control" name="cmbProgram" id="cmbProgram">
											<option value=''>Select</option>
										</select>
									</div>
									<div class="col-sm-2">
										<button class="btn btn-primary" name="btnGenerateReport" id="btnGenerateReport" type="button" value="Show">Show</button>&nbsp;
										<button class="btn btn-warning" name="btnsend_email" id="btnsend_email" type="button" value="Send Email" onclick="window.open('send_email')">Email</button>&nbsp;
									</div>
								</div>
							    <div class="form-group"
									<input type="hidden" name="removeid" id="removeid" value="" />
									<table class="table table-striped table-bordered " id="tblMaritList">
										<thead>
					      					<tr>
					      						<th rowspan="2">sl no</th>
					      						<th rowspan="2">Name of Student</th>
					      						<th rowspan="2">Regn.No.</th>
					      						<th rowspan="2">Program</th>
					      						<th rowspan="2">Marks Obtained</th>
					      						<th rowspan="2">Status</th>
					      						<th colspan="5">Category wise Marks Obtained in JEE 2018</th>
					      						<th colspan="3">Option of CIPET Centre Choice</th>
					      						<th rowspan="2" style="border-left: 1px solid rgb(211, 212, 216);">State of Domicile</th>
					      						<th rowspan="2">Mob.No.</th>
					      						<th rowspan="2">Counselling Letter</th>
					      						<th rowspan="2">Yes/No</th>
					      					</tr>
					      					<tr>
					      						<th>SC</th>
					      						<th>ST</th>
					      						<th>OBC-NCL</th>
					      						<th>PH</th>
					      						<th>OBC / General</th>
					      						<th>1st</th>
					      						<th>2nd</th>
					      						<th>3rd</th>
					      					</tr>
				      					</thead>
				      					<tbody>
				      						
				      					</tbody>
									</table>
								</div>
						    </form>	
						</div>
						
						
					</div>
				</div>
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!--Modal for slot cancellation -->
<div class="modal fade" id="slotModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				&times;</button>
				<h4 class="modal-title" id="myModalLabelHeader"> Slot Cancellation</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="SlotCancelForm" name="SlotCancelForm">
					<div id="errorlog" style="display: none; color: red; font-size: 12px;"></div>
					<input type="hidden" id="hidOperType" name="hidOperType" value="CANCEL_SLOT"/>
					<input type="hidden" id="hidslotdate" name="hidslotdate" value="" />
					<input type="hidden" id="hidslottime" name="hidslottime" value=""/>
					
                    <div class="form-group">
						<label for="txtreason" class="col-sm-4 control-label">Reason for Cancellation</label>
						<div class="col-sm-8">
							<textarea class="form-control tooltips" id="txtreason" name="txtreason"></textarea>
						</div>
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" id="savereason">Submit</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
					</div>
				</form>
			</div>	
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/buttons.html5.min.js"></script>	
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/marit_list.js"></script>
