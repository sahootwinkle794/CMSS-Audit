<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Document Download</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body">
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
							<form class="form-horizontal" method="post" role="form" id="frmDocument" name="frmDocument">
								<input type="hidden" id="hidApplNo" name="hidApplNo" value=<?=$get_document_list['appl_no']?>>
								<input type="hidden" id="hidProg" name="hidProg" value=<?=$get_document_list['program']?>>
								
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th style="">Sl.No</th>
												<th style="">Document Type</th>
												<th style="width:30%">Browse</th>
												<th style="">Preview</th>
											</tr>
										</thead>
										<tbody>
											<?php $j = 1; 
												for($i = 0; $i < sizeof($get_document_list['data']); $i++){ ?>
											<tr>
													
													<td><?=$j++?></td>
													<td><?=$get_document_list['data'][$i]['document_type']?></td>
													<td><input type="file" class="form-control" placeholder="No File" id="file<?=$get_document_list['data'][$i]['document_type_code']?>" name="fileDocument<?=$i?>"  onchange = "showImage('<?=$get_document_list['data'][$i]['document_type_code']?>',<?=$get_document_list['data'][$i]['document_preview_width']?>,<?=$get_document_list['data'][$i]['document_preview_height']?>,<?=$get_document_list['data'][$i]['document_size_in_kb']?>);">
														<div id="divMessage<?=$get_document_list['data'][$i]['document_type_code']?>" style="color:red;font-size:16px;"></div>
													</td>
													<?php if($get_document_list['data'][$i]['document_path'] != ''){
														$img_path = base_url().$get_document_list['data'][$i]['document_path'];														
													 } 
														else{ 
															$img_path = "";
													 } ?>
													<td><img id="img<?=$get_document_list['data'][$i]['document_type_code']?>" style='width: 170px' src='<?=$img_path?>' /></td>
													<!--<td><a href='<?=base_url()?><?=$get_document_list[$i]['document_path']?>'><i class='fa fa-file fa-2x'></i></a></td>-->
													
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
								<button class="btn btn-success center-block" type="submit" id="btnSubmit" name="btnSubmit"> Submit</button>
							</form>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><!-- /.content -->
</div>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap-filestyle/bootstrap-filestyle.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/apply_3.js"></script>	
<script>
	$(":file").filestyle({classButton: "btn btn-primary"});//for file execution
	
	$('#frmDocument').bootstrapValidator({
		excluded:[':disabled'],
		message: 'This value is not valid',
	    feedbackIcons: 
	    {
	        valid: 'glyphicon glyphicon-ok',
	        invalid: 'glyphicon glyphicon-remove',
	        validating: 'glyphicon glyphicon-refresh'
	    },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
			var formData = new FormData(document.getElementById("frmDocument"));
			//alert(1);
			//console.log(formData);return;
			//ajax call to server
			$.ajax({
				url:base_url+"Ajax_controller/add_document",
				type:"post",
				data:formData,
			    processData: false,
			    contentType: false,
				success:function(response)
				{  
					var obj = jQuery.parseJSON(response);
					//alert(obj.status);
					if(obj.status == true)
					{
						//alert(obj.date);
						swal({
							title: "Document",
							text: obj.msg,
							type: "success"
							},
							function(isConfirm) {
							  if (isConfirm) {
							    window.location.reload();
							  }
						});
			 		}
					else 
					{
						sweetAlert("Document",obj.msg, "error");	
					}
				},
				error:function()
				{
					toastr.error('Unable to Save.Please Try Again ');	
				}
			});
		}	
	});
</script>