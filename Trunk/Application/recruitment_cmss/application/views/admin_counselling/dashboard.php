	<link href="<?php echo base_url(); ?>public/template_lib/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="../css/plugins/morris/morris-0.4.3.min.css" />
	<style>
	.loadingRPimage {
		position: fixed;
		top: 0;
		left: 0;
		height: 100vh; /* to make it responsive */
		width: 100vw; /* to make it responsive */
		overflow: hidden; /*to remove scrollbars */
		z-index: 99999; /*to make it appear on topmost part of the page */
		display: none; /*to make it visible only on fadeIn() function */
		background: none repeat scroll 0% 0% rgba(104, 136, 164, 0.44); /*to make background blur */
		text-align: center;
	}
		
	</style>
	<div id="page-wrapper">
		<div class="row">
        	<div class="col-lg-12">
                <h1 class="page-header">Application Statistics</h1>
            </div>
  		</div>
       <!-- <div class="row">-->
			<section class="content">
				<div class="row">
					<div class="col-lg-12" style="padding-top:0px;">
						<div class="panel panel-default">	
							<div class="panel-body">
								
			    			</div>
			    		</div>
			    	</div>
			    </div>	
			</section>
			<section class="content">
			</section>
		<!-- /.content -->
		<!--</div>		-->
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
	