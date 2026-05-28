<div class="content-wrapper">
	<!--<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Latest Information</h1>
        </div>
    </div>-->
    <section class="content-header">
      	<h1>
        	Latest Information
      	</h1>
    </section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-default">
						<!--<button type='button' id='btnAdd' class='btn btn-info btn-sm btn-circle pull-left tooltipTable' onclick='add_latest_information()' title='Add'><i class='fa fa-plus'></i></button><br><br>-->
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
						
							<form class="form-horizontal" method="post" role="form" id="frmLatestInformation" name="frmLatestInformation">
								<input type="hidden" name="hidTemplate" id="hidTemplate" value=""/>
								
							    <div class="form-group"
									<input type="hidden" name="removeid" id="removeid" value="" />
									<table class="table table-striped table-bordered " id="tbLatestInformation">
										<thead>
											<tr>
												<th >#</th>
												<th  hidden>Id</th>
												<th >Link Name</th>
												<th >Link</th>
												<th >Published Date</th>
												<th  hidden>Link Path</th>	
												<th >Action</th>	
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
						    </form>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog" style="width: 50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				&times;</button>
				<h4 class="modal-title" id="myModalLabelHeader">Information </h4>
			</div>
			<div class="modal-body">
				<!--<input type="hidden" name="txtLinkName" id="txtLinkName" value=""/>-->
				<input type="hidden" name="txtDate" id="txtDate" value=""/>
				<input type="hidden" name="hidid" id="hidid" value=""/>
				<div class="container-fluid"  id="link_description" style="color:black; ;height:auto;"></div>
			</div>	
		</div>
	</div>
</div>
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog" style="width: 50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				&times;</button>
				<h4 class="modal-title" id="myModalLabelHeader1"> </h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="latestInformationForm" name="latestInformationForm">
					<div id="errorlog" style="display: none; color: red; font-size: 12px;"></div>
					<input type="hidden" id="hidInfoid" name="hidInfoid" value=""/>
					<input type="hidden" id="hidOperType" name="hidOperType" value="add_latest_information"/>
					<div class="form-group">
						<label for="txtLinkName" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Link Name:</label>
						<div class="col-sm-9">
							<!--<textarea name="txtLinkName" class="form-control"></textarea>-->
							<input type="text" class="form-control tooltips" id="txtLinkName" name="txtLinkName" maxlength="80">
						</div>
					</div>
					<!--<div class="form-group">
						<label for="txtInfoDate" class="col-sm-3 control-label">Published Date:</label>
						<div class="col-sm-9">
							<input type="text" class="form-control tooltips" id="txtInfoDate" name="txtInfoDate">
						</div>
					</div>-->
					<div class="form-group">
						<label class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Upload: </label>
						<div class="col-sm-9">
							<input type="radio" name="radioUpload" id="radioUpload1" value="PDF"> Upload Pdf<br>
  							<input type="radio" name="radioUpload" id="radioUpload" value="CODE"> Insert Code<br>
						</div>
					</div>
					<div id="filebox" class="form-group" style="display: none">
					    <label class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Upload Pdf:</label>
						<div class="col-sm-9 input-file" >
							<input type="file" class="form-control" id="filePdf" name="filePdf" />
							File-Type: pdf / PDF<br />
							File-Size: 5Mb Max
						</div>
					    <!--<textarea  id="textareaLink1" name="textbox1" class="col-sm-6 "></textarea>-->
					</div>
					<div id="textbox" class="form-group" style="display: none">
					    <label class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Insert Code:</label>
					    <div class="col-sm-9">
						    <textarea id="textareaLink" name="textareaLink" style="width: 360px; height: 100px;" class=" form-control"></textarea> 
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" id="savecadremaster"><i class="fa fa-save"></i>  Save</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
					</div>
				</form>
			</div>	
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/latest_information.js"></script>