<div class="content-wrapper">
	<!--<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">News and Announcements</h1>
        </div>
    </div>-->
    <section class="content-header">
      	<h1>
        	Chairman Setup
      	</h1>
    </section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">	
					<div class="panel-body box box-default">
						<!--<button type='button' id='btnAdd' class='btn btn-info btn-sm btn-circle pull-left tooltipTable' onclick='add_news_events()' title='Add'><i class='fa fa-plus'></i></button><br><br>-->
						<div style="border-radius:0px;border: 0px inset;padding-left:20px;padding-right:20px;padding-top:0px;">
						
							<form class="form-horizontal" method="post" role="form" id="frmfaq" name="frmfaq">
								<input type="hidden" name="hidTemplate" id="hidTemplate" value=""/>
								
							    <div class="form-group"
									<input type="hidden" name="removeid" id="removeid" value="" />
									<table class="table table-striped table-bordered " id="tblChairman">
										<thead>
											<tr>
												<th >Sl. No.</th>
												<th  hidden>Id</th>
												<th >Name</th>
												<th >Message</th>
												<th >Profile</th>	
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
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog" style="width: 50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				&times;</button>
				<h4 class="modal-title" id="myModalLabelHeader"> </h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="chairmanForm" name="chairmanForm">
					<div id="errorlog" style="display: none; color: red; font-size: 12px;"></div>
					<input type="hidden" id="hidid" name="hidid" value=""/>
					<input type="hidden" id="hidOperType" name="hidOperType" value="add_chairman"/>
					<div class="form-group" >
						<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i>Name</label>
							<div class="col-sm-8">
								<input type="text" class="form-control tooltips" id="txtName" name="txtName" maxlength = "100" placeholder="Enter Name" title="name">
							</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i>Message</label>
							<div class="col-sm-8">
								<textarea type="text" class="form-control tooltips" id="txtMessage" name="txtMessage" placeholder="Enter Message" title="Message"></textarea>
							</div>
					</div>
					
					<div class="form-group"  id="FileInstitute">
						<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Profile Image</label>
						<div class="col-sm-4">
							<input type="file" id="fileInstituteImage" name="fileInstituteImage" class="form-control"/>
							File-Type: jpg, jpeg, png<br />
							<!--File-Size: 400kb Max<br />-->
							Dimension: 400*400 pixels
							<div id="signMessage" style="color:red;font-size:16px;"></div>
						</div>
						<div class="col-sm-4">
							<img id='imageDisplayarea' src='' style='margin-left:50px;margin-right:50px;margin-bottom: 20px;' width='100' height='100' />
						</div>
						
					</div>
					
					<div class="form-group" id="editFileInstitute">
						<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Profile Image</label>
						<div class="col-sm-4">
							<input type="file" id="editfileInstituteImage" name="editfileInstituteImage" class="form-control"/>
							File-Type: jpg, jpeg, png<br />
							<!--File-Size: 400kb Max<br />-->
							Dimension: 400*400 pixels
							<div id="signMessage" style="color:red;font-size:16px;"></div>
						</div>
						<div class="col-sm-4">
							<img id='editimageDisplayarea' src='' style='margin-left:50px;margin-right:50px;margin-bottom: 20px;' width='100' height='100' />
						</div>
						
					</div>
					
					<!--<div class="form-group">
						<label for="radioType" class="col-sm-3 control-label"><i style="color:red;font-size:15px;">*</i> Type:</label>
						<div class="col-sm-9">
							<input type="radio" name="radioType" value="NEWS"> News<br>
  							<input type="radio" name="radioType" value="ANNOUNCEMENT"> Announcement<br>
						</div>
					</div>-->
					<!--<div class="form-group">
						<label for="txtDate" class="col-sm-3 control-label">Published Date:</label>
						<div class="col-sm-9">
							<input type="text" class="form-control tooltips" id="txtDate" name="txtDate">
						</div>
					</div>-->
					<div class="modal-footer">
					<span id="spanProcessingInstituteImage" style="display: none">Processing... <img src="<?php echo base_url(); ?>public/assets/images/bx_loader.gif" /></span>
						<button type="submit" class="btn btn-primary" id="savecadremaster"><i class="fa fa-save"></i>  Save</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>  
					</div>
				</form>
			</div>	
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/chairman_setup.js"></script>