<?php
	$sel_program = $program_code;
	$round_data = $round_data;
?>  
   <style>
   	html, body
	{
	    width: 100%;
	    height: 100%;
	    background-color: white;
	}
   </style>
   <form method="post" action="" enctype="multipart/form-data">	
   	<br /><br />
	<input type="hidden" id="hidFileName" name="hidFileName" />
	
		<fieldset style="width:95%; margin: auto">
			<legend>Sync Result</legend>
			
			<!--Step 3. Browse and upload. <input type="file" id="fileUpload" name="fileUpload"/>
			<input type="submit" id="btnPreview" name="btnPreview" class="button" value="Preview" style="display: inline" onclick="return validate();"/>-->
		<!--</fieldset>-->
	</form>
	 <script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
    
	<script>
	$(document).ready(function()
	{
		$('#userfile').change(function()			
		{ 
			//alert("hello");
			var file = document.getElementById("userfile").files[0];
			//alert(file);
			var sFileName = file.name;
			//alert(sFileName);
			var file_path = file.path;
			//alert(file.mozFullPath);
	        var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
	        var iFileSize = file.size;
	        //var iConvert = (file.size / 1048576).toFixed(2);
	        if (sFileExtension == "xls" || sFileExtension == "xlsx" || sFileExtension == "XLS" || sFileExtension == "XLSX" )
			{ 
				$('#importfile-id').attr('disabled', false);
				document.getElementById("signMessagelogo").innerHTML="";
	        }
			else
			{
	            //alert("Invalid File Format");
				document.getElementById("signMessagelogo").innerHTML="Error : Invalid File Format. Please choose xls/xlsx/XLS/XLSX file.";
				$('#importfile-id').attr('disabled', true);
				$('#userfile').val("");
				
			}
			
		});
	});
	</script>
<?php
$output = '';
$output .= form_open_multipart('admin/save_applicantResult/'.$sel_program."/".$round_data);
$output .= '<div class="row">';


$output .= '<div class="col-lg-12 col-sm-12"><div class="form-group">';
$data = array(
    'name' => 'importfile',
    'id' => 'importfile-id',
    'class' => 'btn btn-primary',
    'value' => 'Sync',
);
$output .= form_submit($data, 'Import Data');
$output .= '<br/><span style="color:red;">There is no scanned file to sync the result</span></div>
                        </div></div></fieldset>';
$output .= form_close();
echo $output;
?>