<div class="content-wrapper">
	<!--<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">News and Announcements</h1>
        </div>
    </div>-->
    <section class="content-header">
      	<h1>
        	Telephony Directory
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
									<table class="table table-striped table-bordered " id="tbltelephony">
										<thead>
											<tr>
												<th >#</th>
												<th  hidden>Id</th>
												<th >Name</th>
												<th >Designation</th>
												<th >Office No.</th>
												<th >Mobile</th>
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
				<form class="form-horizontal" id="telephonyForm" name="telephonyForm">
					<div id="errorlog" style="display: none; color: red; font-size: 12px;"></div>
					<input type="hidden" id="hidid" name="hidid" value=""/>
					<input type="hidden" id="hidOperType" name="hidOperType" value="add_telephony"/>
					<div class="form-group">
						<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Name</label>
							<div class="col-sm-8">
								<input type="text" class="form-control tooltips" id="txtName" name="txtName"  title="Name" placeholder="Enter Name">
							</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Designation</label>
							<div class="col-sm-8">
								<input type="text" class="form-control tooltips" id="txtDesg" name="txtDesg"  title="Designation" placeholder="Enter Designation">
							</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-4 control-label"> Office No.</label>
							<div class="col-sm-8">
								<input type="text" class="form-control tooltips" id="txtOffice" name="txtOffice" maxlength="10" title="Office Number" placeholder="Enter Office Phone Number">
							</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-4 control-label"><i style="color:red;font-size:15px;">*</i> Mobile</label>
							<div class="col-sm-8">
								<input type="text" class="form-control tooltips" id="txtMobile" name="txtMobile" maxlength="10" title="Mobile Number" placeholder="Enter Mobile Number">
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
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/assets/js/admin/telephony_directory.js"></script>