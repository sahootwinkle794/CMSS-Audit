<div class="table-responsive">
    <table class="table table-hover tablesorter">
        <thead>
            <tr>
                <th class="header">Sl No</th>
                <th class="header">JEE Roll No</th>                           
                <th class="header">Applicant Name</th>
                <th class="header">Course</th>
                <th class="header">Exam Centre</th>
                <th class="header">DOB</th>
                <th class="header">Mobile No</th>
                <th class="header">Gender</th>
                <th class="header">Category</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($applicantInfo) && !empty($applicantInfo)) {
            	$sl_no = 1;
                foreach ($applicantInfo as $key => $element) {
                    ?>
                    <tr>
                        <td><?php echo $sl_no; ?></td>   
                        <td><?php echo $element['jee_roll_no']; ?></td> 
                        <td><?php echo $element['full_name']; ?></td>
                        <td><?php echo $element['course']; ?></td>
                        <td><?php echo $element['exam_center_code']; ?></td>
                        <td><?php echo $element['dob']; ?></td>
                        <td><?php echo $element['applicant_mobile']; ?></td>
                        <td><?php echo $element['gender']; ?></td>
                        <td><?php echo $element['category']; ?></td>
                    </tr>
                    <?php
                    $sl_no++;
                }?>
                 <center><b> <p style="color: green; font-size:20px">Data Successfully Inserted</p></b></center>
                 <a href="<?php base_url(); ?>candidate_list"><button type="button" class="btn btn-info" id="btnBack">Back</button></a> 
                 <br>
               
           <?php } else {
                ?>
                <tr>
                    <td colspan="5">There is no data.</td>    
                    <a href="<?php base_url(); ?>candidate_list"><button type="button" class="btn btn-info" id="btnBack">Back</button></a> 
                 	<br>
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