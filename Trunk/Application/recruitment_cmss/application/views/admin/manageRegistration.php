<style>
	#dtblApplicationDetail tbody tr:hover, #dtblApplicationDetail tbody tr.active {
		border-left: 4px solid #009efb; 
	}
</style>

<div class="content-wrapper">
	<!--<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Application</h1>
        </div>
	</div>-->
	<section class="content-header">
      	<h1>
        	Manage Registration
      	</h1>
    </section>
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-default">
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
							<table class="table table-striped table-bordered " id="dtblApplicationDetail">
								<thead>
									<tr>
										<th >#</th>
										<th >Name</th>
										<th >Mobile No</th>
										<!--<th >Registration Id</th>-->
										<th >Email Id</th>
										<th >DOB</th>
										<!--<th >State</th>-->
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
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/manageRegistration.js?v=3"></script>

   <?php

?>