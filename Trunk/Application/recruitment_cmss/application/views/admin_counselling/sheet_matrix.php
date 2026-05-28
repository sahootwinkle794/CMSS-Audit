<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Seat Matrix</h1>
        </div>
    	<!-- /.col-lg-12 -->
	</div>

    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body">
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
							
							
							<table class="table table-striped table-bordered " id="dtblApplicationDetail">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center" hidden="">Ipb Code</th>
										<th class="text-center">Program</th>
										<th class="text-center">Branch</th>
										<th class="text-center">Institute</th>
										<th class="text-center">Action</th>
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
		<div class="modal fade" id="checkAvailabilityModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModalLabel">Status</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" role="form"  id="frmprogramBranchInstituteSeatEdit" name="frmprogramBranchInstituteSeatEdit">
							<input type="hidden" id="hidIpbCode" name="hidIpbCode"/>
							<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
							
							
								<table class="table table-striped table-bordered " id="dtblCheckAvailability">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th class="text-center">Category</th>
											<th class="text-center">Available Seats</th>
											<th class="text-center">Alloted Seats</th>
											<th class="text-center">Vacancy</th>
											<th class="text-center">Reported Seats</th>
										</tr>
									</thead>
									<tbody>
									
									</tbody>
								</table>
								
							</div>
							
							<div class="modal-footer">
								<span id="spanProcessingProgram" style="display: none">Processing... <img src="../images/bx_loader.gif" /></span>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
							</div>
						</form>
					</div>	
				</div>
			</div>
		</div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<link href="<?php echo base_url(); ?>public/css/datepicker3.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin_counselling/sheet_matrix.js"></script>

   