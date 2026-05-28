	

   
    <div class="content-wrapper">
 	<div class="row">
		
		<div class="col-lg-12">
		<!--<h4>User details</h4>-->
		<!--<div class="panel with-nav-tabs panel-primary">
        <div class="panel-heading">-->
                <!-- Tabs within a box -->
                <div class="nav-tabs-custom box box-default">
                <ul class="nav nav-tabs" role="tablist">
					<li class="active"><a href="#applicant" data-toggle="tab">Applicant</a></li>
			        <li><a href="#admin" data-toggle="tab">Institute Admin</a></li>
				</ul>
			
			<div class="panel-body">
	 		<div class="tab-content no-padding">
				<div class=" chart tab-pane in active" id="applicant" style="position: relative;">
					<form method="POST">
					<div class="row">
						<label class="col-sm-1" style ="margin-left: 30px"class="control-label">Institute:</label>
						<div class="col-sm-3" >
				            <div class="form-group selectContainer">
				               <select class="form-control" name="cmbInstitute" id="cmbInstitute">
							   		<option  value="">Select Institute</option>
									<?php
										$sel_inst_code = ''; 
										foreach($institute_data as $row)
										{
											$inst_code = $row['institute_code'];
											$inst_name = $row['institute_name'];
											//$s = ($sel_inst_code == $row['institute_code'] ? ' selected ' : '');
												//$selected = 'selected';
											echo "<option value='$inst_code'>$inst_name</option>";
										}
									?>	
								</select>
					        </div>
						</div>
						
				       
					        <!--<div class='col-sm-2 pull-right'>
					            <div class="form-group">
					                <button type="button" class="btn btn-primary" id="btnExportApplicants" name="btnExportApplicants" onclick="funcExcel()"> <a href="<?= base_url(); ?>Superadmin/excel_All_Applicant_details" target="_blank">Export to Excel</a></button>
					            </div>
					        </div>-->
					 	
					</div>
					<table class="table table-bordered table-striped" id="tbApplicants">
				 		<thead>
					 		<tr>
					 			<th>#</th>
					 			<th>Mobile Number</th>
					 			<th>Applied Program</th>
					 			<th>Program Name</th>
					 			<th>Applicant Name</th>
					 			<th>Gender</th>
					 			<th>Institute Code</th>
					 			<th>Institute Name</th>
					 			<th>Application Status</th>
					 		</tr>
				 		</thead>
				 		<tbody>
	
			
 		</tbody>
 	</table>
	
</form>
					
					
				</div>
				
				<div class=" chart tab-pane" id="admin" style="position: relative;">
			        
					<form method="POST">
					<div class="row">
					
				        <!--<div class='col-sm-2 pull-right'>
				            <div class="form-group">
				                <button type="submit" class="btn btn-primary" id="btnExportAdmins" name="btnExportAdmins"><a href="<?=base_url()?>superadmin/excel_All_Admin_details" target="_blank">Export to Excel</a></button>
				            </div>
				        </div>-->
				    
					</div>
					<table class="table table-bordered table-striped" id="tbAdmin">
				 		<thead>
					 		<tr>
					 			<th>#</th>
					 			<th>Admin name</th>
					 			<th>Admin Id</th>
					 			<th>Role</th>
					 			<th>Institute Name</th>
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
       <!--	</div>-->
    </div>
	</div>
	</div>

 
	
    <script type="text/javascript" src="<?=base_url()?>public/assets/js/superadmin/report_all_users.js"></script>
    <script src="<?=base_url()?>public/assets/js/jquery-2.1.0.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>public/assets/js/jquery-ui-1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>public/assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>public/assets/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jszip.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/buttons.html5.min.js"></script>
    
    <!-- AdminLTE App -->
    <script src="<?=base_url()?>public/assets/js/app.min.js" type="text/javascript"></script>
