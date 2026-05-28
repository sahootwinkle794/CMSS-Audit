

<!-- iCheck for checkboxes and radio inputs -->
 <link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/iCheck/all.css">
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url(); ?>public/template_lib/plugins/iCheck/icheck.min.js"></script>
<!--********************************************************** CONTENT PART ************************************************************************************************************** -->	
	
	<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" >
	<section class="content-header">
      	<h1></h1>
      	<ol class="breadcrumb">
        	<li class="active"><a href="#"><i class="fa fa-server"></i> Demo Table</a></li>
        </ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="col-xs-12 col-sm-12 col-md-12" style="padding-top: 15px;">
			 		<div class="row">
				        <div class="col-xs-12 col-sm-12 col-md-12">
				          	<div class="box box-primary">
					            <div class="box-body">
					            	<div class="col-lg-12 col-xs-12">
				           				<table id="dtbldatatable" class="table table-bordered table-hover">
							                <thead>
						                        <tr>
						                            <th>#</th>
						                            <th hidden="hidden">id</th>
						                            <th>Name</th>
						                            <th>Country</th>
						                           	<th>Department</th>
						                           	<th>Qualification</th>
						                        </tr>
						                    </thead>
							            </table>
									</div>
					           	</div>
				          	</div>
				        </div>
				    </div>
				</div>
	    	</div>
	    </div>
	</section>
</div>
<script> var base_url = '<?php echo base_url(); ?>';</script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/datatable.js?v=<?php rand() ?>"></script>
	