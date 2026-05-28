<div class="table-responsive">
    <table class="table table-hover tablesorter">
        <thead>
            <tr>
                <th class="header">Sl No</th>
                <th class="header">Transaction Date</th>                           
                <th class="header">Transaction Id</th>                      
                <th class="header">Student Name</th>
                <th class="header">Email ID</th>
                <th class="header">Mobile No</th>
                <th class="header">Bank Reference</th>
                <th class="header">Received Amount</th>
                <th class="header">Transaction Charges</th>
                <th class="header">Settlement Amount</th>
                <th class="header">Payment Mode</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($employeeInfo) && !empty($employeeInfo)) {
            	$sl_no = 1;
                foreach ($employeeInfo as $key => $element) {
                    ?>
                    <tr>
                        <td><?php echo $sl_no; ?></td>   
                        <td><?php echo isset($element['transaction_date'])?$element['transaction_date']:''; ?></td> 
                        <td><?php echo isset($element['transaction_id'])?$element['transaction_id']:''; ?></td> 
                        <td><?php echo isset($element['student_name'])?$element['student_name']:''; ?></td> 
                        <td><?php echo isset($element['email_id'])?$element['email_id']:''; ?></td> 
                        <td><?php echo isset($element['mobile_no'])?$element['mobile_no']:''; ?></td> 
                        <td><?php echo isset($element['bank_transaction_id'])?$element['bank_transaction_id']:''; ?></td> 
                        <td><?php echo isset($element['gross_amount'])?$element['gross_amount']:''; ?></td> 
                        <td><?php echo isset($element['payment_gateway_charge'])?$element['payment_gateway_charge']:''; ?></td> 
                        <td><?php echo isset($element['net_amount'])?$element['net_amount']:''; ?></td> 
                        <td><?php echo isset($element['bank_name'])?$element['bank_name']:''; ?></td> 
                       
                        <!--<td><?php echo $element['transaction_id']; ?></td>                       
                        <td><?php echo $element['student_name']; ?></td>
                        <td><?php echo $element['email_id']; ?></td>
                        <td><?php echo $element['mobile_no']; ?></td>
                        <td><?php echo $element['bank_transaction_id']; ?></td>
                        <td><?php echo $element['gross_amount']; ?></td>
                        <td><?php echo $element['payment_gateway_charge']; ?></td>
                        <td><?php echo $element['net_amount']; ?></td>
                        <td><?php echo $element['bank_name']; ?></td>-->
                    </tr>
                    <?php
                    $sl_no++;
                }?>
                 <center><b> <p style="color: green; font-size:20px">Data Successfully Inserted</p></b></center>
           <?php } else {
                ?>
                <tr>
                    <td colspan="5">There is no data.</td>    
                </tr>
            <?php } ?>
 
        </tbody>
    </table>
  
</div>
<link href="<?php echo base_url(); ?>public/assets/css/bootstrap_new.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/datatable/css/dataTables.bootstrap.min.css" />
<!--<link rel="stylesheet" type="text/css" href="../css/plugins/dataTables/css/jquery.dataTables.min.css" />-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/datatable/css/dataTables.responsive.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/css/bootstrap-multiselect.css" />
<link href="<?=base_url()?>public/assets/css/datepicker3.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/font-awesome/css/font-awesome.min.css" />
<link href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/css/bootstrapValidator.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>public/assets/js/jquery-ui-timepicker-addon.css" />
<!--<link href="<?=base_url()?>public/assets/css/datepicker3.css" rel="stylesheet" />-->
<!--<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>public/assets/js/jquery-ui-timepicker-addon.css" /-->

<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datepicker/bootstrap-datepicker.js" ></script>
<!--<script src="<?php echo base_url(); ?>public/assets/js/jquery-ui-timepicker-addon.js" type="text/javascript"></script>-->
<!--<script type="text/javascript" language="javascript" src="../js/bootstrap-datepicker.js"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrapValidator.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.rowReorder.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/js/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
<!-- Toaster Plugin -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.js"></script>