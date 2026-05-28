
<div id="page-wrapper">
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<form method="post" action="" enctype="multipart/form-data">	
			   	<br /><br />
				<input type="hidden" id="hidFileName" name="hidFileName" />
					<fieldset style="width:95%; margin: auto">
					<legend>Browse Excel</legend>
					Step 1. <a style="color: blue;" href="<?php echo base_url() ?>downloads/candidates_list.xlsx">Download the template</a><br />
					Step 2. Fill the data in the downloaded excel file.<br />
					<!--Step 3. Browse and upload. <input type="file" id="fileUpload" name="fileUpload"/>
					<input type="submit" id="btnPreview" name="btnPreview" class="button" value="Preview" style="display: inline" onclick="return validate();"/>-->
				<!--</fieldset>-->
			</form>
<?php
$output = '';
$output .= form_open_multipart('admin/saveApplicantDetails');
$output .= '<div class="row">';
$output .= '<div class="col-lg-12 col-sm-12"><div class="form-group">';
$output .= form_label('Step 3. Browse and upload.', 'image');
$data = array(
    'name' => 'userfile',
    'id' => 'userfile',
    'class' => 'form-control filestyle',
    'value' => '',
    'data-icon' => 'false'
);
$output .= form_upload($data);
$output .= '</div> <span style="color:red;">*Please choose an Excel file(.xls or .xlxs) as Input</span></div>';
$output .= '<div class="col-lg-12 col-sm-12"><div class="form-group text-right">';
$data = array(
    'name' => 'importfile',
    'id' => 'importfile-id',
    'class' => 'btn btn-primary',
    'value' => 'Upload',
);
$output .= form_submit($data, 'Import Data');
$output .= '</div>
                        </div></div></fieldset>';
$output .= form_close();
echo $output;
?>
		</div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

   