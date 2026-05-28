<div class="content-wrapper">
	<!--<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Call Letter Download List</h1>
        </div>
    </div>-->
    <section class="content-header">
      	<h1>
        	Call Letter Download List
      	</h1>
    </section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body">
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
										<!--<button class="btn btn-warning" name="btnsend_email" id="btnsend_email" type="button" value="Send Email" onclick="window.open('send_email')">Email</button>&nbsp;-->
									</div>
								</div>
							    <div class="form-group">
									<input type="hidden" name="removeid" id="removeid" value="" />
									<table class="table table-striped table-bordered " id="tblCallList">
										<thead>
					      					<tr>
					      						<th >sl no</th>
					      						
					      						<th >Mobile.No</th>
					      						<th >Program Name</th>
					      						<th >Download Date</th>
					      						
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

<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/buttons.html5.min.js"></script>	
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/call_list.js"></script>
