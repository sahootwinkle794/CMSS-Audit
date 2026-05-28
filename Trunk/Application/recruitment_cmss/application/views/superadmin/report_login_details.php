
<!DOCTYPE html>
<html>
 <head>
	    <meta charset="UTF-8">
	    <title>Superadmin | Dashboard</title>
		<link href="<?=base_url()?>public/assets/css/datepicker3.css" rel="stylesheet" type="text/css" />
  </head>
  <body class="skin-blue">
   <div class="content-wrapper">
    <div class="row">
 	<div class="col-lg-12">
 	<div class="panel panel-default">	
		<div class="panel-body box box-default">
		<!--<h4>User details</h4>-->
		<form method="post" action="">
        <div class='col-sm-12'>
        	<label class="col-sm-2" class="control-label">login Date:</label>
        	<div class='col-sm-3' style="margin-left: -60px">
	            <div class="form-group">
	                <div class='input-group date'>
	                    <input type='text' name="txtLoginDate"  id="txtLoginDate" class="form-control" READONLY value="" />
	                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
	                    </span>
	                </div>
	            </div>
	        </div>
        </div>
        <br /><br />
        <!--<div class='col-sm-1'>
            <div class="form-group">
                <button type="button" class="btn btn-primary" id="btnShow" name="btnShow">Show</button>
            </div>
        </div>-->
	    <table class="table table-bordered"id="tbLoginDetails">
	 		<thead>
		 		<tr>
		 			<th>#</th>
		 			<th>login id</th>
		 			<th>IP</th>
		 			<th>Role</th>
		 			<th>Login Time</th>
		 			
		 		</tr>
	 		</thead>
	 		<tbody>

	 		</tbody>
	 	</table>
		</form>
    </div>
    </div>
    </div>
	</div>
	</div>
</body>
	<script src="<?=base_url()?>public/assets/js/jquery-2.1.0.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>public/assets/js/jquery-ui-1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>public/assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>public/assets/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jszip.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/buttons.html5.min.js"></script>
    
    <!-- AdminLTE App -->
    <script src="<?=base_url()?>public/assets/js/app.min.js" type="text/javascript"></script>
    <script type="text/javascript"src="<?=base_url()?>public/assets/js/superadmin/report_login_details.js"></script>
   
</html>