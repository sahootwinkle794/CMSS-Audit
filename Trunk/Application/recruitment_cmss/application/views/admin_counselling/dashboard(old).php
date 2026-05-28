	<link href="<?php echo base_url(); ?>public/template_lib/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="../css/plugins/morris/morris-0.4.3.min.css" />
	<?php 
		foreach($all_program_list as $row)
		{
			$program_group_list[] = $row;
			$sel_program_group = $program_group_list[0]['program_group'];
		}
	?>
	<div id="page-wrapper">
		<div class="row">
        	<div class="col-lg-12">
                <h1 class="page-header">Application Statistics</h1>
            </div>
            <!-- /.col-lg-12 -->
    	</div>
            	<!-- /.row -->
    	<div class="row" style="background-color: #9fc6f9; padding-top: 12px;">
        	<form class="form-horizontal" role="form"  id="frmSearch" name="frmSearch" method="post">
		   		<div class = "form-group">
					<label for="cmbProgramGroup" class="control-label col-lg-2 col-sm-2 col-sm-offset-2 col-lg-offset-2" style="font-size:15px;">Program Group :</label>
					<div class="col-lg-3 col-sm-3">
						<select class="form-control" id="cmbProgramGroup" name="cmbProgramGroup" >
						<!--<option value="">SELECT</option>-->
<?php
	foreach($program_group_list as $row)
	{
		$c = '';
		if($row['program_group'] == $sel_program_group)
			$c = 'selected';
		else
			$c = '';
		echo "<option value=\"".$row['program_group']."\" $c>".$row['program_group']."</option>";
	}
?>							
						</select>
					</div>
					<div class="col-lg-2 col-sm-2">
						<button type="button" id="btnFilter" name="btnFilter" class="btn btn-info custombtn"><i class="fa fa-search"></i> Filter</button>
						&nbsp;&nbsp;&nbsp;<span id="spanProcessing" style="display:none;"><img src="../images/bx_loader.gif" /></span>
					</div>
			  	</div>
			</form>
        </div><br>
            	<!-- /.row -->
		<div class="row">
    		<div class="col-lg-12">
    			<div id="divApplicantGraph" style="height:350px;width:100%;">&nbsp;</div>
    		</div>
    	</div>
	        	
        <div class="row">
					
        				
	    <!-- Main content -->
	    	<section class="content" id="secDashboard">
			<!-- Small boxes (Stat box) -->
			</section><!-- /.content -->
		</div>
						
            <!-- /.row -->
	</div><!-- /#page-wrapper -->
	
	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/dashboard.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/morris/morris.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/morris/raphael-2.1.0.min.js"></script>
	