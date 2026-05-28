<?php
	$today = date('d-m-Y');
?>
<div class="content-wrapper">
<div class="row">
    
 	<div class="row container">
 		<div class="col-sm-5">
 			<label style="font-size: 25px">Login Details</label>
 		</div>
        <div class='col-sm-3'>
            <div class="form-group">
                <div class='input-group date' id="txtLoginDate">
                    <input type='text' name="txtLoginDate" id="txtLoginDateVal" class="form-control" value="<?=$today?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class='col-sm-1'>
            <div class="form-group">
                <button type="button" class="btn btn-primary" id="btnShow" name="btnShow">Show</button>
            </div>
        </div>
        <div class='col-sm-2'>
            <div class="form-group">
                <button type="button" class="btn btn-primary" id="btnExport" name="btnExport">Export to Excel</button>
            </div>
        </div>
    </div>
 	<table class="table table-bordered container" id = "tblAllLogin">
 		<thead>
	 		<tr>
	 			<th>#</th>
	 			<th>login_id</th>
	 			<th>IP</th>
	 			<th>Role</th>
	 			<th>Login Time</th>
	 			
	 		</tr>
 		</thead>
 		<tbody>
 		</tbody>
 	</table>
	

	</div>
</div>

	<script src="<?php echo base_url(); ?>public/assets/js/superadmin/report_all_logins.js" type="text/javascript"></script>
    