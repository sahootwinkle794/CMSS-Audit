<?php
	$sel_program_code = $program_code;
	$base_url = base_url();
	$showdate = $txtTransDate;
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
 			<label style="font-size: 25px">Online Transactions Details</label>
 		</div>
        <div class='col-sm-2'>
            <div class="form-group">
                <div class='input-group date' id="txtTransDate">
                    <input type='text' name="txtTransDate" class="form-control" value="<?=$showdate?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class='col-sm-1'>
            <div class="form-group">
            	<input type="hidden" value="<?= $sel_program_code ?>" id="program_code"/>
            	<input type="hidden" value="<?= $base_url ?>" id="base_url"/>
                <button type="submit" class="btn btn-primary" id="btnShow" name="btnShow">Show</button>
            </div>
        </div>
        <div class='col-sm-2'>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="btnExportOnline" name="btnExportOnline">Export to Excel</button>
            </div>
        </div>
    </div>
 	<table class="table table-bordered">
 		<thead>
	 		<tr>
	 			<th>Slno</th>
	 			<th>Trans. Date</th>
	 			<th>Appl. No</th>
	 			<th>Applicant Name</th>
	 			<th>Mobile No.</th>
	 			<th>Payment Mode</th>
	 			<th>Order. No.</th>
	 			<th>Trans. No.</th>
	 			<th>Trans. Amount</th>
	 		</tr>
 		</thead>
 		<tbody>
<?php
if(isset($allOnlinePayments))
{
	$slno = 1;
	foreach($allOnlinePayments as $row)
	{
		echo "<tr>";
		echo "<td>$slno</td>";
		echo "<td>".$row['response_datetime']."</td>";
		echo "<td>".$row['appl_no']."</td>";
		echo "<td>".$row['full_name']."</td>";
		echo "<td>".$row['created_by']."</td>";
		echo "<td>Online</td>";
		echo "<td>".$row['order_number']."</td>";
		echo "<td>".$row['transaction_number']."</td>";
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
<link href="<?php echo base_url(); ?>public/css/datepicker3.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
<!--<script type="text/javascript" language="javascript" src="../js/bootstrap-datepicker.js"></script>-->
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.rowReorder.min.js"></script>

<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/dashboard_reports.js"></script>
    <script type="text/javascript">
    $('#txtTransDate').datepicker({
	    format: "dd-mm-yyyy",
		todayHighlight:true,
		autoclose:true,
		endDate:"+0d"
    });
    </script>