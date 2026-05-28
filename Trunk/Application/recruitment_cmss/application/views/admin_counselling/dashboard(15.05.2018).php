	<link href="<?php echo base_url(); ?>public/template_lib/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="../css/plugins/morris/morris-0.4.3.min.css" />
	<style>
		
	</style>
	<div id="page-wrapper">
		<div class="row">
        	<div class="col-lg-12">
                <h1 class="page-header">Application Statistics</h1>
            </div>
    	</div>
        <div class="row">
	    <!-- Main content -->
	    	<!--<section class="content" id="secDashboard">
			</section>-->
			<section class="content">
					<div class="col-lg-12">
						<div class="row table-striped table-bordered" style="height: 6%; background-color: rgb(64, 129, 164);">
							<div class="text-center col-lg-4" style="padding-top: 8px; border: 1px solid wheat;height: 98%;color: #ffffff;">Course Name </div>
							<div class="text-center col-lg-2" style="padding-top: 8px; border: 1px solid wheat;height: 98%;color: #ffffff;">Profile Submitted</div>
							<div class="text-center col-lg-2" style="padding-top: 8px; border: 1px solid wheat;height: 98%;color: #ffffff;">Document Uploaded</div>
							<div class="text-center col-lg-2" style="padding-top: 8px; border: 1px solid wheat;height: 98%;color: #ffffff;">Fee Paid</div>
							<div class="text-center col-lg-2" style="padding-top: 8px; border: 1px solid wheat;height: 98%;color: #ffffff;">Only Registered</div>
						</div>
						<div class="row " style="height: 6%;">
								<?php foreach($application_count as $row)
								{ ?>
								<div style="padding-top: 2%; border: 1px solid wheat;height: 98%;" class="text-center col-lg-4"><?=$row['course_name']?> </div>
								<div id="Profile_Submitted" class="text-center col-lg-2" style="cursor: pointer;padding-top: 2%; border: 1px solid wheat;height: 98%;"  onclick="viewdetails('Student Details Submitted','<?=$row['course_code']?>')" ><?= $row['Profile_Submitted'] ?></div>
								<div id="Document_Uploaded" class="text-center col-lg-2" style="cursor: pointer;padding-top: 2%; border: 1px solid wheat;height: 98%;" onclick="viewdetails('Document Uploaded','<?=$row['course_code']?>')"><?= $row['Document_Uploaded'] ?></div>
								<div id="Fee_Paid" class="text-center col-lg-2" style="cursor: pointer;padding-top: 2%; border: 1px solid wheat;height: 98%;" onclick="viewdetails('Verified','<?=$row['course_code']?>')"><?= $row['Fee_Paid'] ?></div>
							<?php } ?>
								<div class="text-center col-lg-2" style="cursor: pointer;padding-top: 5%;margin-top: -84px; border: 1px solid wheat;height: 125px;" onclick="viewdetails('Only Registred','')"><?= $only_registred[0]['Registered']?></div>
						</div>
					</div>
				<div id="view_details_panel" >	
					<div class="row">
			        	<div class="col-lg-12">
			                <h1 class="page-header">View Details</h1>
			            </div>
			    	</div>
			    	<div class="row">
			        	<div class="col-lg-12">
	        				<table class="table table-striped table-bordered " id="ApplicationDetail">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Candidate Name</th>
										<th class="text-center">Application No</th>
										<th class="text-center">Mobile No</th>
										<th class="text-center">Course Name</th>
										<th class="text-center">Application Date</th>
										<th class="text-center">Application Status</th>
										<th class="text-center">Payment Mode</th>
										<th class="text-center">Payment Status</th>
									</tr>
								</thead>
								<tbody>
								
								</tbody>
							</table>
			            </div>
			    	</div>
		    	</div>	
			</section>
			<section class="content">
			</section>
		<!-- /.content -->
		</div>		
            <!-- /.row -->
	</div><!-- /#page-wrapper -->
	
	<link href="<?php echo base_url(); ?>public/assets/js/buttons.dataTables.min.css" type="text/css" />
	<script src="<?php echo base_url(); ?>public/assets/js/dataTables.buttons.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>public/assets/js/buttons.flash.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>public/assets/js/jszip.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>public/assets/js/pdfmake.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>public/assets/js/vfs_fonts.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>public/assets/js/buttons.html5.min.js" type="text/javascript"></script>

	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/dashboard.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/morris/morris.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/morris/raphael-2.1.0.min.js"></script>
	