<?php
	$sel_program_code = $program_code;
	$base_url = base_url();
?>
<link href="<?php echo base_url(); ?>public/assets/css/bootstrap_new.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/datatable/css/dataTables.bootstrap.min.css" />
<!--<link rel="stylesheet" type="text/css" href="../css/plugins/dataTables/css/jquery.dataTables.min.css" />-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/datatable/css/dataTables.responsive.css" />
<div class="" style="padding-top: 20px;">  
  <form method="post">
    <!-- Site wrapper -->
    <br />
 	<div class="row">
 		<div class="col-sm-5">
 			<label style="font-size: 25px">SC, ST, EBC Transactions Details</label>
 		</div>
        
        <div class='col-sm-2'>
            <div class="form-group">
            	<input type="hidden" value="<?= $sel_program_code ?>" id="program_code"/>
            	<input type="hidden" value="<?= $base_url ?>" id="base_url"/>
                <button type="submit" class="btn btn-primary" id="btnExport" name="btnExport">Export to Excel</button>
            </div>
        </div>
    </div>
 	<table class="table table-responsive table-bordered">
 		<thead>
	 		<tr>
	 			<th>Slno</th>
	 			<th>Appl. No</th>
	 			<th>Applicant Name</th>
	 			<th>Mobile No.</th>
	 			<th>Payment Mode</th>
	 			<th>Trans. Amount</th>
	 		</tr>
 		</thead>
 		<tbody>
<?php
if(isset($all_sc_st))
{
	$slno = 1;
	foreach($all_sc_st as $row)
	{
		echo "<tr>";
		echo "<td>$slno</td>";
		echo "<td>".$row['appl_no']."</td>";
		echo "<td>".$row['full_name']."</td>";
		echo "<td>".$row['created_by']."</td>";
		echo "<td>".$row['money_deposit_mode']."</td>";
		echo "<td>".$row['amount']."</td>";
		echo "</tr>";
		$slno++;
	}
}
?> 			
 		</tbody>
 	</table>
	
</form>
</div>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-ui.min.js"></script>
<!--<script type="text/javascript" language="javascript" src="../js/bootstrap-datepicker.js"></script>-->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.rowReorder.min.js"></script>


<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/dashboard_reports.js"></script>