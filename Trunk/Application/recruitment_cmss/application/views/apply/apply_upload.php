<?php
date_default_timezone_set('Asia/Kolkata');
$now = date('Y-m-d h:i:s', now());
$mode = $this->session->userdata('mode');
$ins = $this->session->userdata('institute_code');
$ins_code = encrypt_decrypt('encrypt',$ins);
$data = $this->uri->uri_to_assoc();
$admcode = $data['admcode'];

$show = '';
$edit = "false";

$documentsPath = array();
$documentDetails = array();
$documentDetailsList = array();
$documentsReq = array();
$documentsDesc = array();
$documentsCode = array();
$documentsDescList = '';
$documentsCodeList = '';



if( $appl_status == 'Document Uploaded' || $appl_status == 'Challan Generated' || $appl_status == 'Fee Paid' || $appl_status == 'Verified')
{
	if($mode == "edit")
	{
		$edit="true";
		foreach($doc_path as $row){
			$document_type = $row['document_type'];
			$documentsPath[$document_type] = $row['document_path'];
		}
	}
	else if($mode != "edit")
	{
		foreach($doc_path as $row){
			$document_type = $row['document_type'];
			$documentsPath[$document_type] = $row['document_path'];
		}
	}
}
foreach($document_data as $row)
{
	$documentsReq[] = $row;	
	$documentsDesc[] = $row['document_type'];
	$documentsCode[] = $row['document_type_code'];
}
if(count($documentsDesc) != 0)
{
	$documentsDescList = implode(',',$documentsDesc);
	$documentsCodeList = implode(',',$documentsCode);
}
foreach($documentsReq as $row)
{
	if(array_key_exists($row['document_type_code'],$documentsPath))
		$documentDetails[] = $row['document_type'].'@'.$documentsPath[$row['document_type_code']];
	else
		$documentDetails[] = $row['document_type'].'@';
}
if(count($documentDetails) != 0){
	$documentDetailsList = implode(',',$documentDetails);
}
?>	
<script type="text/javascript">
function validate(){
			var errorMessage = "";
			var message = '<div>';
			var document_desc_list = "<?php echo $documentsDescList;?>";//console.log(document_desc_list);return;
			var document_desc_lists = document_desc_list.split(",");
			var document_code_list = "<?php echo $documentsCodeList;?>";
			var document_code_lists = document_code_list.split(",");
			var i = 0;
			var is_error = 0;							
			//alert(document_desc_list+document_code_list);	return;					
			for(sl_no = 0;sl_no<=document_code_lists.length;sl_no++)
			{
				input_val = $("input[name=fileDocument"+sl_no+"]").val();
			  	if(input_val == '')
			  	{
					errorMessage += document_desc_lists[sl_no]+" is required.<br />";
			  	}
			}
			
			for(j=0;j<document_code_lists.length;j++)
			{
				if(document.getElementById("divMessage"+document_code_lists[j]).innerHTML != '')
				{
					is_error = 1;
				}
			}
			
			if(errorMessage != "")
			{
				message += errorMessage + "</div>";
				document.getElementById("alertmessage").innerHTML=message;
				$('.alert').show();
				window.scrollTo(0,0);
				return false;	 
			}
			else if(is_error == 1)
			{
				document.getElementById("alertmessage").innerHTML = "Please first clear up the errors.";
				$('.alert').show();
				window.scrollTo(0,0);
				return false;
			}
			else
			{
				var formData = new FormData(document.getElementById("formApply"));
				
					$.ajax({	
						url:base_url+"ajax_controller/save_apply_upload_program",	
						type:"POST",
							data:formData,
							cache: false,
					        contentType: false,
					        processData: false,				
						success:function(responsedata)
						{
							var res = jQuery.parseJSON(responsedata);
							if(res.status)
							{
								swal({
									title: "Uploaded Successfully",
									text: "Congratulation!!! Your documents uploaded successfully.",
									//type: "success"
								},
								function(isConfirm) {
								  if (isConfirm) {
								   window.open(base_url+"apply/institute_page/ins/<?php echo $ins_code; ?>",'_self');
								  }
								});
								//window.location.href=(base_url+"apply/institute_page/ins/<?php echo $ins_code; ?>");	
								//window.open(base_url+"apply/institute_page/ins/<?php echo $ins_code; ?>")
							
							}else{
								toastr.error(res.msg);
								//window.location.href=(base_url+"apply/institute_page/ins/<?php echo $ins_code; ?>");	
							}
						},
						error:function(){
							alert("We are unable to Process.Please contact Support");
						}
				});
			}
		}
		
</script>
<link href="<?=base_url()?>public/assets/css/datepicker3.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/toastr/toastr.min.css" />
	
<style>
	.btn-warning:hover{
			color: #fff;
			background-color: #ffb27a;
		    border-color: #ffb27a;
		 
		}
		.btn-warning:focus,
		.btn-warning:active,
		.btn-warning.active,
		.btn-warning {
		  	color: #fff;
		     background-color: #ff8260;
		  border-color: #ff8260;
		}
		
		.btn-primary:hover{
		  color: #fff;
		  background-color: #7a3b2c;
		  border-color: #7a3b2c;
		}
		.btn-primary:focus,
		.btn-primary:active,
		.btn-primary.active,
		.btn-primary {
		   color: #fff;
		  background-color: #0d87b8;
			border-color: #0d87b8;
		}
		.btn.btn-sm {
		    padding: .5rem 1.6rem;
		    cursor: pointer;
		}
		.panel-primary > .panel-heading {

		    color: #fff;
		    background: linear-gradient(to left, #ffb27a 30%, #f97962 100%);

		}
		.panel-primary {
		    border-color: #ff8260;
		}
		fieldset {
		    min-width: 0;
		    padding: 15px;
		    margin: 0;
		    border: 1px solid black;
		    border-color:#f2c1a4;
			margin-top: 10px;
		}
		legend{
			width: 15%;
			margin-left: 43%;
			border-bottom: 0px;
			color:#fff;
			background: linear-gradient(to left, #ffb27a 30%, #ff805f 100%);
			border-radius: 6px;
			text-align: center;
		
		}

	</style>
	

		<div class="panel  panel-document">
						
						<div class="panel-heading step-heading">
								<b><i class="fa fa-file"></i> Document Upload</b>
								<!--<span class="pull-right"><b style="color: #FFF;"><?php echo $admname; ?></b></span>-->
						</div>
						<!--<a href="#" class="pull-right" style="margin-top: -4.0%;margin-right: 0.2%" id="btnInstruction" name="btnInstruction" title="Help"><img type="button" src="<?=base_url()?>public/assets/images/helpicon.png" name="btnInstruction" title="Help" id="btnInstruction" style="width:50px;height:50px;cursor:pointer"></img></a>-->
						
						<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;"> <!-- Alert for error -->
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<div id="alertmessage"></div>
						</div>
						<?php include_once(dirname(dirname(__FILE__)) . '/template_config/alerts.php');?>
						<div class="panel-body"style=" padding: 100px; ">
							<fieldset>
							<legend style="width: 20%;">DOCUMENT DETAILS</legend>
								<!--<form class="form-horizontal" method="post" role="form" id="formApply" name="formApply" enctype="multipart/form-data" >-->
								<div class="table-responsive">
									<table class="table table-bordered table-striped">
										<tr>
											<th style="width: 100px;">Sl.No</th>
											<th style="width: 300px;">Document Type</th>
											<th style="">Browse</th>
											<th style="text-align:center;">Preview</th>
										</tr>
									</table>
								</div>
									<form  class="md-form login-box-body" method="post" role="form" action="" id="formApply" name="formApply" enctype="multipart/form-data" style="background: #fff;padding: 20px;border-top: 0;color: #666;">
										<input type="hidden" id="hidProCode" name="hidProCode" value="<?=  $admcode; ?>" />
									<?php 
										if(count($documentsReq) == 0) 
										{
									?>    
										  
						  					<h3>No Documents needed</h3>
						  					<?php 
										} 
										else
										{
											$sl_no = 1;
											foreach($documentsReq as $row)
											{
									?>
									<div class="row">
										<div class="col-lg-1" style="padding-top: 10px;">
											<div class="form-group">
												<label for=""><?=$sl_no?></label>
											</div>
										</div>
										<div class="col-lg-3" style="padding-top: 10px;">
											<div class="form-group">
												<label for=""><?=$row['document_type']?></label>
											</div>
										</div>
										<div class="col-lg-4" style="padding-top: 10px;">
											<div class="form-group">
												<div class="input-group input-file" >
										    		<input type="file" class="form-control" style="width:85%;margin-left: 12px;"  id="file<?=$row['document_type_code']?>" name="fileDocument<?=$sl_no?>" onchange = "showImage('<?=$row['document_type_code']?>',<?=$row['document_preview_width']?>,<?=$row['document_preview_height']?>,<?=$row['document_size_in_kb']?>,'<?=$row['document_extension_type']?>');"  <?php echo $show==1?'disabled':''; ?>/>
										    	</div>	
											</div>
											<?=$row['document_size_description']?>
											<div id="divMessage<?=$row['document_type_code']?>" style="color:red;font-size:16px;"></div>	
										</div>
										<div class="col-lg-4" >
											<div class="form-group" style="text-align: center;">
												<?php 	
													if($row['document_extension_type'] == 'IMG')
													{
														if($mode=='edit' || $appl_status == 'Document Uploaded' || $appl_status == 'Fee Paid' || $appl_status == 'Verified') 
													  	{ 
														  	if(array_key_exists($row['document_type_code'],$documentsPath)) 
															{ 
																echo "<img id='img".$row['document_type_code']."' src='".$documentsPath[$row['document_type_code']]."' style='margin-left:50px;margin-right:50px;' width='".$row['document_preview_width']."' height='".$row['document_preview_height']."' />"; 
															} 
															else 
															{ 
																echo "<img id='img".$row['document_type_code']."' style='margin-left:50px;margin-right:50px;' />"; 
															} 
														} 
														else 
														{ 
															echo "<img id='img".$row['document_type_code']."' style='margin-left:50px;margin-right:50px;' />"; 
														}
													} 
													else
													{
														$base_url =  base_url()."downloads/doc_icon.png";
														if($mode=='edit' || $appl_status == 'Document Uploaded' || $appl_status == 'Fee Paid' || $appl_status == 'Verified') 
													  	{ 
														  	if(array_key_exists($row['document_type_code'],$documentsPath)) 
															{ 
																echo "<a  target='_blank' href = '".$documentsPath[$row['document_type_code']]."'><img id='img".$row['document_type_code']."' src='".$base_url."' style='margin-left:50px;margin-right:50px;' width='".$row['document_preview_width']."' height='".$row['document_preview_height']."' /></a>"; 
															} 
															else 
															{ 
																echo "<img id='img".$row['document_type_code']."' style='margin-left:50px;margin-right:50px;' />"; 
															} 
														} 
														else 
														{ 
															echo "<img id='img".$row['document_type_code']."' style='margin-left:50px;margin-right:50px;' />";
														}
													}	
													
													?>
											</div>
										</div>
									</div>
										
									<?php 
											$sl_no++; 
											}
										} 
										?>
									
								<div class="">
						      <?php if($show !=1) { ?>
													<div class="form-group" style="margin-top: 10px;">
														<div class="col-lg-12">
															<button type="button" class="btn btn-info btn-block" id="btndocumentUpload" name="btndocumentUpload" onclick='validate();'> <span class="glyphicon glyphicon-send" style="font-size:18px;"></span> Save</button>
														</div>
													</div>
												<?php } ?>
						        
						      </div>
							
								</form>
								</fieldset>
							</div>	
						</div><!--Panel Body-->
						
				
					</div>
					
						<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/apply_upload.js"></script>
					<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap-filestyle/bootstrap-filestyle.js"></script>
					<script>
$(":file").filestyle({classButton: "btn btn-primary"});//for file execution
	
</script>	

					