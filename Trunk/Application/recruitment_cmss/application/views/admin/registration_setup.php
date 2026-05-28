<?php
	$program_start_date = '';
	$program_end_date = '';
	$apply_start_date = '';
	$apply_end_date = '';
	$birth_start_date = '';
	$birth_end_date = '';
	
	foreach($date_apply as $row)
	{
		$program_start_date = $row['program_start_date'];
		$program_end_date = $row['program_end_date'];
		$apply_start_date = $row['apply_start_date'];
		$apply_end_date = $row['apply_end_date'];
	}
	foreach($eligible_date as $row)
	{
		$birth_start_date = $row['birth_start_date'];
		$birth_end_date = $row['birth_end_date'];
	}
?>
<!--<link  rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css"/>-->
	<!--<link  rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css"/>
	<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>public/assets/js/jquery-ui-timepicker-addon.css"/>-->
	<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/datepicker3.css" />-->
	<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/jquery-ui-1.11.4/jquery-ui.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/jquery-ui-1.11.4/jquery-ui.theme.min.css" />-->
	<!--<link href="<?php echo base_url(); ?>public/template_lib/plugins/timeline/timeline.css" rel="stylesheet">-->
	<div class="content-wrapper">
	<!--<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Registration Setup</h1>
        </div>
	</div>-->
	<section class="content-header">
      	<h1>
        	Registration Setup
      	</h1>
    </section>
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-default"">
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
							<form class="form-horizontal" method="post" role="form" id="frmRegistrationSetup" name="frmRegistrationSetup">
								<div class="form-group">
									<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;Registration Start Date</label>
									<div class="col-sm-4">
										<!--<input type="text" class="form-control" id="txtFatherName" name="txtFatherName" placeholder="Enter Father Name" onkeydown="changeCase(this)" onkeyup="changeCase(this)" onblur="changeCase(this)" onclick="changeCase(this)" value="<?=strtoupper($txtFatherName)?>" <?php echo $show==1?'disabled':''; ?>>-->
										<input type="text" class="form-control tooltips" id="txtRegStart" name="txtRegStart"  title="Enter Registration Start Date" placeholder="Registration Start Date" readonly=""  value="<?=strtoupper($program_start_date)?>" >
									</div>
								</div>
								<div class="form-group">
									<label for="inputname" class="col-sm-3 control-label"><i style="color:red;font-size:18px;">*</i>&nbsp;Registration End Date</label>
									<div class="col-sm-4">
										<input type="text" class="form-control tooltips" id="txtRegEnd" name="txtRegEnd"   title="Enter Registration End Date" placeholder="Registration End Date" readonly=""  value="<?=strtoupper($program_end_date)?>" >
									</div>
								</div>
								<!--<div class="form-group">
									<label for="inputname" class="col-sm-2 control-label"><i style="color:red;font-size:18px;">*</i>Apply Start Date</label>
									<div class="col-sm-4">
										<input type="text" class="form-control tooltips" id="txtAppStart" name="txtAppStart"  title="Enter Apply Start Date" placeholder="Apply Start Date"  value="<?=strtoupper($apply_start_date)?>" >
									</div>
								</div>
								<div class="form-group">
									<label for="inputname" class="col-sm-2 control-label"><i style="color:red;font-size:18px;">*</i>Apply End Date</label>
									<div class="col-sm-4">
										<input type="text" class="form-control tooltips" id="txtAppEnd" name="txtAppEnd"  title="Enter Apply End Date" placeholder="Apply End Date" value="<?=strtoupper($apply_end_date)?>" >
									</div>
								</div>-->
								<div class="form-group">
									<label for="inputname" class="col-sm-3 control-label">&nbsp;&nbsp;&nbsp;&nbsp;Eligibility From </label>
									<div class="col-sm-4">
										<input type="text" class="form-control tooltips" id="txtEliFrom" name="txtEliFrom"   title="Enter Eligibility From" placeholder="Eligibility From"	readonly=""  value="<?=strtoupper($birth_start_date)?>" >
									</div>
								</div>
								<div class="form-group">
									<label for="inputname" class="col-sm-3 control-label">&nbsp;&nbsp;&nbsp;&nbsp;Eligibility Upto </label>
									<div class="col-sm-4">
										<input type="text" class="form-control tooltips" id="txtEliUpto" name="txtEliUpto"   title="Enter Eligibility Upto" placeholder="Eligibility Upto" readonly=""  value="<?=strtoupper($birth_end_date)?>" >
									</div>
								</div>
								<!--<div class="modal-footer">-->
								<!--<span id="spanProcessingProgram" style="display: none">Processing... <img src="../images/bx_loader.gif" /></span>-->
								<button type="button" class="btn btn-primary" id="programaddsave">Save</button>
									 
								<!--</div>-->
													
							</form>
							
							<!--<table class="table table-striped table-bordered " id="dtblRegistrationSetup">
													<thead>
														<tr>
															<th class="text-center">#</th>
															<th class="text-center">Registration Start Date</th>
															<th class="text-center">Registration End Date</th>
															<th class="text-center">Apply Start Date</th>
															<th class="text-center">Apply End Date</th>
															<th class="text-center">Eligibility From</th>
															<th class="text-center">Eligibility Upto</th>
															
														</tr>
													</thead>
													<tbody>
													
													</tbody>
							</table>-->
							
						</div>
					</div>
				</div>
			</div>
		</div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!--<script src="<?php echo base_url(); ?>public/template_lib/plugins/jquery-ui-1.11.4/jquery-ui.min.js"></script>-->
<!--<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/daterangepicker/moment.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>-->
<!--<script src="<?php echo base_url(); ?>public/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/js/moment.min.js"></script>-->
<!--<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>-->
<!--<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>public/assets/js/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/js/moment.min.js"></script>-->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/registration_setup.js"></script>			
