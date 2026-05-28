<?php
//$institute_name = $institute;
//$institute_name = $institute;
//$institute_name = $this->session->userdata('institute_code');
$institute_names = '';
foreach($institute_name as $row)
{
	$institute_names = $row['institute_name'];
	$sel_institute = $row['institute_code'];
}
/*echo $sel_institute;
die();*/
?>
<link href="<?php echo base_url(); ?>public/assets/css/bootstrap_new.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/datatable/css/dataTables.bootstrap.min.css" />
<!--<link rel="stylesheet" type="text/css" href="../css/plugins/dataTables/css/jquery.dataTables.min.css" />-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template_lib/plugins/datatable/css/dataTables.responsive.css" />
	<div class="row container">
 		<div class="col-sm-12">
 			<h3>Online Payment Details of <?=$institute_names?></h3>
 		</div>
 	</div>
	<div class="row container">
	<div class="col-lg-12">
		<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;"> <!-- Alert for error -->
			<div id="alertmessage"></div>
		</div>
 		<form name="frmGenerateReport" id="frmGenerateReport" method="POST" action="">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="form-group" id="divRadioButton" >
						<div class="form-inline col-sm-5">
							<label class="control-label">Month Wise</label> &nbsp;
							<input type="radio" name="radPeriod" id="radMonth" value="Month" checked="checked"/>&nbsp;
							<label class="control-label">Date Wise</label> &nbsp;
							<input  type="radio" name="radPeriod" id="radDate" value="Date"/>
						</div>
						<div class="form-inline col-sm-7"  id="divSelectDate">
							<label class="control-label">Date From:</label>
							<input class="form-control" name="txtFromDate" id="txtFromDate" type="text" readonly="readonly" />
							<label class="control-label">Date To:</label>
							<input class="form-control" name="txtToDate" id="txtToDate" type="text" readonly="readonly"/>
						</div>
						<div class="form-inline col-sm-5" id="divSelectMonth" >
							<label class="control-label">Month:</label>
							<select class="form-control" name="cmbMonth" id="cmbMonth">
								<option value="1" <?php if(date('m') == 1) echo 'selected ';?>>Jan</option>
								<option value="2" <?php if(date('m') == 2) echo 'selected ';?>>Feb</option>
								<option value="3" <?php if(date('m') == 3) echo 'selected ';?>>Mar</option>
								<option value="4" <?php if(date('m') == 4) echo 'selected ';?>>Apr</option>
								<option value="5" <?php if(date('m') == 5) echo 'selected ';?>>May</option>
								<option value="6" <?php if(date('m') == 6) echo 'selected ';?>>Jun</option>
								<option value="7" <?php if(date('m') == 7) echo 'selected ';?>>Jul</option>
								<option value=8" <?php if(date('m') == 8) echo 'selected ';?>>Aug</option>
								<option value="9" <?php if(date('m') == 9) echo 'selected ';?>>Sep</option>
								<option value="10" <?php if(date('m') == 10) echo 'selected ';?>>Oct</option>
								<option value="11" <?php if(date('m') == 11) echo 'selected ';?>>Nov</option>
								<option value="12" <?php if(date('m') == 12) echo 'selected ';?>>Dec</option>
							</select>
							<label class="control-label">Year:</label>
							<select class="form-control" name="cmbYear" id="cmbYear">
			<?php
			for ($y=2015; $y<=2030; $y++) 
			{
			$x = ($y == date('Y') ? 'selected ' : '');
			echo "<option value=\"$y\" $x>$y</option>";
			}	
			?>													
							</select>
						</div>
					</div>
					<div class="form-group" style="margin-top: 4%">
						<div class="form-inline col-sm-5">
							<input type="hidden" id="institute_code" value="<?php echo $sel_institute ?>"/>
							<input type="hidden" id="base_url" value="<?php echo  base_url(); ?>"/>
							<label class="control-label">Program:</label>
							<select class="form-control tooltips cmbProgramSelect" id="cmbProgramFilter" name="cmbProgramFilter[]" multiple="multiple" >
						
							</select>						
						</div>
						<div class="form-inline col-sm-3">
							<label class="control-label">Status:</label>
							<select class="form-control tooltips" id="cmbDepositStatus" name="cmbDepositStatus" >
								<option value="">--All--</option>
								<option value="INITIATED">INITIATED</option>
								<option value="SUCCESS">SUCCESS</option>
								<option value="NOT VERIFIED">NOT VERIFIED</option>
								<option value="MULTIPLE_PAYMENT">MULTIPLE PAYMENT</option>
							</select>						
						</div>
						
						<div class="col-sm-2">
							<div class="btngroup">
								<button class="btn btn-primary" name="btnGenerateReport" id="btnGenerateReport" type="button" value="Show">Show</button>
								<button id="btnExportReport" class="btn btn-primary" name="btnExportReport" type="button" onclick="return validate();" title="Ecport to Excel"><i class="fa fa-file-excel-o"></i></button>
							</div>
						</div>
					
					</div>
				</div>
			</div>
			

		</form> 
	</div>
	</div>
	<div class="row">
	<div class="col-lg-11" style="margin-left:1%;margin-right:1%;overflow-x: auto">
 	<table class="table table-bordered" id="dtblOnlinePayments" width="100%">
 		<thead>
	 		<tr>
	 			<th>Slno</th>
	 			<th hidden>Program Code</th>
	 			<th>Application No</th>
				<th>Registered Mobile</th>
				<th>Applicant Name</th>
				<th>Program Name</th>
				<th>Amount</th>
				<th hidden>Request Date</th>
				<th hidden>Response Date</th>
				<th>Request Order Id</th>
				<th hidden>Response Order Id</th>
				<th>Request Date</th>
				<th>Deposit Status</th>
	 			<th>Trasanction No</th>
				<th>Refund Status</th>
	 			<th>Refund Date</th>
				<th>Action</th>
	 		</tr>
 		</thead>
 		<tbody>
 		</tbody>
 	</table>
	</div>
	</div>
	<div class="modal fade" id="onlinePaymentEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title" id="myModalLabel">Edit records</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form" id="frmOnlinePaymentEdit" name="frmOnlinePaymentEdit">
						<div class="form-group">
							<div class="col-sm-10">
								<input type="hidden" class="form-control" id="hidApplNoEdit" name="hidApplNoEdit">
								<input type="hidden" class="form-control" id="hidApplProgramEdit" name="hidApplProgramEdit">
								<input type="hidden" class="form-control" id="hidAmountEdit" name="hidAmountEdit">
								<input type="hidden" class="form-control" id="hidRequestDateEdit" name="hidRequestDateEdit">
							</div>
						</div>
						<div class="form-group">
							<label for="inputname" class="col-sm-3 control-label">Request Date time</label>
							<div class="col-sm-9">
								<input type="text" class="form-control tooltips" id="txtRequestTime" name="txtRequestTime" disabled="disabled">
							</div>
						</div>
						<div class="form-group">
							<label for="inputname" class="col-sm-3 control-label">Deposit Status</label>
							<div class="col-sm-9">
								<select class="form-control tooltips" id="cmbDepositStatusEdit" name="cmbDepositStatusEdit" title="Select Deposit Status">
									<option value="INITIATED">INITIATED</option>
									<option value="SUCCESS">SUCCESS</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Transaction Number</label>
							<div class="col-sm-9">
								<input type="text" class="form-control tooltips" id="txtTransNoEdit" name="txtTransNoEdit" title="Transaction Number" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Response Date Time</label>
							<div class="col-sm-9">
								<input type="text" class="form-control tooltips" id="txtResponseDateEdit" name="txtResponseDateEdit" title="Transaction Number">
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" id="onlinePaymentEditSave">Save</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
						</div>
					</form>
				</div>	
			</div>
		</div>
	</div>

	<div class="modal fade" id="refundPaymentEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title" id="myModalLabel">Refund Payment</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form" id="frmRefundPaymentEdit" name="frmRefundPaymentEdit">
						<div class="form-group">
							<div class="col-sm-10">
								<input type="hidden" class="form-control" id="hidApplNoEdit" name="hidApplNoEdit">
								<input type="hidden" class="form-control" id="hidApplProgramEditRefund" name="hidApplProgramEditRefund">
								<input type="hidden" class="form-control" id="hidAmountEdit" name="hidAmountEdit">
								<input type="hidden" class="form-control" id="hidRequestDateEdit" name="hidRequestDateEdit">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Transaction Number</label>
							<div class="col-sm-9">
								<input type="text" class="form-control tooltips" id="txtTransNumberEdit" readonly="readonly" name="txtTransNumberEdit" title="Transaction Number">
							</div>
						</div>
						<div class="form-group">
							<label for="inputname" class="col-sm-3 control-label">Refund Status</label>
							<div class="col-sm-9">
								<select class="form-control tooltips" id="cmbRefundStatusEdit" name="cmbRefundStatusEdit" title="Select Deposit Status">
									<option value="REFUNDED">REFUNDED</option>
									<option value="NOT REFUNDED">NOT REFUNDED</option>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" id="REFUNDPaymentEditSave">Save</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
						</div>
					</form>
				</div>	
			</div>
		</div>
	</div>
	
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
    <script type="text/javascript">
	$(document).ready(function() {
		var base_url = $("#base_url").val();
		var ins = $("#institute_code").val();
		var categCheck  = $('#cmbProgramFilter').multiselect({
		    includeSelectAllOption: true,
		     enableFiltering : true
		}); 
		//Ajax call to get programs
		//alert(base_url+"ajax_controller/select_program_for_online_details");
		var institutedata=
		{
			program_type:'Current',
			ins: ins
		};	
		$.ajax({
				url:base_url+"ajax_controller/select_program_for_online_details",
				type:"post",
				data:institutedata,
				success:function(response){  
					var options = "<option value =''>Select</option>";
					var res1 = JSON.parse(response);
					 $.each(res1.aaData, function (index, item) {
			            var opt = $('<option />', {
			                value: item.program_code,
			                text: item.program_name
			            });
			            opt.appendTo(categCheck);
			            categCheck.multiselect('rebuild');
					   options = options + "<option value="+item.program_code+">"+item.program_name+"</option>";
		    		});
				},
				error:function(){
					toastr.error("We are unable to Process.Please contact Support");
				}
		});	
		$("#btnGenerateReport").click(function (){
			//var oTable = $('#dtblPaymentReport').dataTable();
			//oTable.fnDestroy();
			//alert("hello");
			//var show_type = $(".checked input[name=radDate]").val();
			if (document.getElementById('radDate').checked) {
  				var show_type = document.getElementById('radDate').value;
			}
			else if (document.getElementById('radMonth').checked) {
  				var show_type = document.getElementById('radMonth').value;
			}

			var from_date = $('#txtFromDate').val();
			var to_date = $('#txtToDate').val();
			var month = $('#cmbMonth').val();
			var year = $('#cmbYear').val();
			var ins = $("#institute_code").val();
			var deposit_status = $('#cmbDepositStatus').val();
			//alert($('.cmbProgramSelect').val());
			//var program_codes = serealizeSelects($('.cmbProgramSelect'));
			var program_codes = $('.cmbProgramSelect').val();
			if(program_codes == null)
			{
				toastr.error("Please select atleast one program");
			}
			else if(show_type =='Month' && program_codes != null)
			{
				//alert(month+"-"+year);
				var institutedata=
				{
					institute_code: ins,
					month:month,
					year:year,
					deposit_status:deposit_status,
					programs:program_codes
				};	
				var paymentdetails = $('#dtblOnlinePayments').dataTable({
					//"responsive": true,
					"ajax":
					{
						"url": base_url+"/ajax_controller/select_online_payment_verification",
						"type": "POST",
						"data": institutedata,
					}, 
					//"sAjaxSource": "db_online_payment_verification.php?type=SELECT&institute_code=<?php echo $sel_institute;?>&month="+month+"&year="+year+"&deposit_status="+deposit_status+"&programs="+program_codes,
					//"sAjaxSource": base_url+"ajax_controller/select_online_payment_verification",
					"bPaginate": true,
			        "bLengthChange": true,
			        "bFilter": true,
			        "bSort": false,
			        "bInfo": true,
					"bDestroy":true,
			        "bAutoWidth":true,    
			        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutegroupbutton' >>><'col-xs-6'p>>",
				    "aoColumns": [    
			                       { "sName": "sl_no"},
								   { "sName": "Program_code","bVisible":false},
								   { "sName": "Application No"},
								   { "sName": "mobile_no" },
								   { "sName": "Applicant_name" },
			                       { "sName": "Program_name" },
								   { "sName": "Amount"},
								   { "sName": "Request Date","bVisible":false},
								   { "sName": "Response Date","bVisible":false},
								   { "sName": "Request Order Id"},
								   { "sName": "Response Order Id","bVisible":false},
								   { "sName": "Request Date"},
								   { "sName": "Deposit Status"},
								   { "sName": "Transaction No"},
								   { "sName": "Refund Status"},
								   { "sName": "Refund Date"},
								   {"sName": "default", "sDefaultContent":" <button type='button' class='btn btn-info' align='center' onclick='editPaymentReport(event);' title='Edit'><i class='fa fa-edit'></i></button>"}
			              	     ]          
				});
			}
			else if(show_type =='Date' && program_codes != null)
			{
				var institutedata=
				{
					institute_code: ins,
					from_date:from_date,
					to_date:to_date,
					deposit_status:deposit_status,
					programs:program_codes
				};	
				var paymentdetails = $('#dtblOnlinePayments').dataTable({
					//"responsive": true,
					"ajax":
					{
						"url": base_url+"/ajax_controller/select_online_payment_verification",
						"type": "POST",
						"data": institutedata,
					}, 
					//"sAjaxSource": "db_online_payment_verification.php?type=SELECT&institute_code=<?php echo $sel_institute;?>&from_date="+from_date+"&to_date="+to_date+"&deposit_status="+deposit_status+"&programs="+program_codes,
					"bPaginate": true,
			        "bLengthChange": true,
			        "bFilter": true,
			        "bSort": false,
			        "bInfo": true,
					"bDestroy":true,
			        "bAutoWidth":true,    
			        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutegroupbutton' >>><'col-xs-6'p>>",
				    "aoColumns": [    
			                       { "sName": "sl_no","sWidth": "10%" },
								   { "sName": "Program_code","bVisible":false},
								   { "sName": "Application No"},
								   { "sName": "mobile_no","sWidth": "30%" },
								   { "sName": "Applicant_name","sWidth": "30%" },
			                       { "sName": "Program_name","sWidth": "20%" },
								   { "sName": "Amount","sWidth": "10%"},
								   { "sName": "Request Date","bVisible":false},
								   { "sName": "Response Date","bVisible":false},
								   { "sName": "Request Order Id"},
								   { "sName": "Response Order Id","bVisible":false},
								   { "sName": "Request Date","sWidth": "20%"},
								   { "sName": "Deposit Status","sWidth": "10%"},
								   { "sName": "Transaction No","sWidth": "10%"},
								   { "sName": "Refund Status","sWidth": "10%"},
								   { "sName": "Refund Date","sWidth": "10%"},
								   {"sName": "default","sWidth": "10%", "sDefaultContent":" <button type='button' class='btn btn-info' align='center' onclick='editPaymentReport(event);' title='Edit'><i class='fa fa-edit'></i></button>"}
			              	     ]          
				});
				
			}
			
			
		});
		

    $('#txtFromDate').datepicker({
	    dateFormat: "dd-mm-yy",
		onSelect: function (date) {
            var date2 = $('#txtFromDate').datepicker('getDate');
			$('#txtToDate').datepicker('option', 'minDate', date2);
			//$('#txtAppEnddate').datetimepicker('option', 'maxDate', date2);
			
        }
    });
	$('#txtToDate').datepicker({
	    dateFormat: "dd-mm-yy",
		onSelect: function (date) {
            var date2 = $('#txtToDate').datepicker('getDate');
			$('#txtFromDate').datepicker('option', 'maxDate', date2);
			//$('#txtAppEnddate').datetimepicker('option', 'maxDate', date2);
			
        }
    });
    /*$('#txtResponseDateEdit').datepicker({
	    dateFormat: "dd-mm-yy H:i:s"
    });*/
	$("#divSelectDate").hide();
  	$("#divSelectMonth").show();
	$('#radDate').on('click', function(event){
		$("#divSelectDate").show();
		$("#divSelectMonth").hide();
	});
    $('#radMonth').on('click', function(event){
        $("#divSelectDate").hide();
		$("#divSelectMonth").show();
	});
	
	$('#frmOnlinePaymentEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
					
			var institutedata={
				hidApplNoEdit:$('#hidApplNoEdit').val(),
				hidApplProgramEdit:$('#hidApplProgramEdit').val(),
				hidAmountEdit:$('#hidAmountEdit').val(),
				txtResponseDateEdit:$('#txtResponseDateEdit').val(),
				hidRequestDateEdit:$('#hidRequestDateEdit').val(),
				cmbDepositStatusEdit:$('#cmbDepositStatusEdit').val(),
				txtTransNoEdit:$('#txtTransNoEdit').val()
			};
			//ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/update_online_payment_verification",
					type:"post",
					data:institutedata,
					success:function(response){ 
						var res = JSON.parse(response);
						$('#onlinePaymentEditModal').modal('hide'); 
						var dtblPayments = $("#dtblOnlinePayments").DataTable();
						if (document.getElementById('radDate').checked) {
			  				var show_type = document.getElementById('radDate').value;
						}
						else if (document.getElementById('radMonth').checked) {
			  				var show_type = document.getElementById('radMonth').value;
						}
						var from_date = $('#txtFromDate').val();
						var to_date = $('#txtToDate').val();
						var month = $('#cmbMonth').val();
						var year = $('#cmbYear').val();
						var status = $('#cmbDepositStatus').val();
						var program = $('#cmbProgramFilter').val();
						if(show_type =='Month' && program != '' )
						{
							var institutedata=
							{
								institute_code: ins,
								month:month,
								year:year,
								deposit_status:status,
								programs:program
							};	
							var paymentdetails = $('#dtblOnlinePayments').dataTable({
								//"responsive": true,
								"ajax":
								{
									"url": base_url+"/ajax_controller/select_online_payment_verification",
									"type": "POST",
									"data": institutedata,
								}, 
								//"sAjaxSource": "db_online_payment_verification.php?type=SELECT&institute_code=<?php echo $sel_institute;?>&month="+month+"&year="+year+"&deposit_status="+deposit_status+"&programs="+program_codes,
								//"sAjaxSource": base_url+"ajax_controller/select_online_payment_verification",
								"bPaginate": true,
						        "bLengthChange": true,
						        "bFilter": true,
						        "bSort": false,
						        "bInfo": true,
								"bDestroy":true,
						        "bAutoWidth":true,    
						        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutegroupbutton' >>><'col-xs-6'p>>",
							    "aoColumns": [    
						                       { "sName": "sl_no"},
											   { "sName": "Program_code","bVisible":false},
											   { "sName": "Application No"},
											   { "sName": "mobile_no" },
											   { "sName": "Applicant_name" },
						                       { "sName": "Program_name" },
											   { "sName": "Amount"},
											   { "sName": "Request Date","bVisible":false},
											   { "sName": "Response Date","bVisible":false},
											   { "sName": "Request Order Id"},
											   { "sName": "Response Order Id","bVisible":false},
											   { "sName": "Request Date"},
											   { "sName": "Deposit Status"},
											   { "sName": "Transaction No"},
											   { "sName": "Refund Status"},
											   { "sName": "Refund Date"},
											   {"sName": "default", "sDefaultContent":" <button type='button' class='btn btn-info' align='center' onclick='editPaymentReport(event);' title='Edit'><i class='fa fa-edit'></i></button>"}
						              	     ]          
							});
			 				//dtblPayments.ajax.url("db_online_payment_verification.php?type=SELECT&institute_code=<?php echo $sel_institute;?>&month="+month+"&year="+year+"&deposit_status="+status+"&program="+program).load();
						}
						if(show_type =='Date' && program != '')
						{
							var institutedata=
							{
								institute_code: ins,
								from_date:from_date,
								to_date:to_date,
								deposit_status:status,
								programs:program
							};	
							var paymentdetails = $('#dtblOnlinePayments').dataTable({
							//"responsive": true,
								"ajax":
								{
									"url": base_url+"/ajax_controller/select_online_payment_verification",
									"type": "POST",
									"data": institutedata,
								}, 
								//"sAjaxSource": "db_online_payment_verification.php?type=SELECT&institute_code=<?php echo $sel_institute;?>&from_date="+from_date+"&to_date="+to_date+"&deposit_status="+deposit_status+"&programs="+program_codes,
								"bPaginate": true,
						        "bLengthChange": true,
						        "bFilter": true,
						        "bSort": false,
						        "bInfo": true,
								"bDestroy":true,
						        "bAutoWidth":true,    
						        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutegroupbutton' >>><'col-xs-6'p>>",
							    "aoColumns": [    
						                       { "sName": "sl_no","sWidth": "10%" },
											   { "sName": "Program_code","bVisible":false},
											   { "sName": "Application No"},
											   { "sName": "mobile_no","sWidth": "30%" },
											   { "sName": "Applicant_name","sWidth": "30%" },
						                       { "sName": "Program_name","sWidth": "20%" },
											   { "sName": "Amount","sWidth": "10%"},
											   { "sName": "Request Date","bVisible":false},
											   { "sName": "Response Date","bVisible":false},
											   { "sName": "Request Order Id"},
											   { "sName": "Response Order Id","bVisible":false},
											   { "sName": "Request Date","sWidth": "20%"},
											   { "sName": "Deposit Status","sWidth": "10%"},
											   { "sName": "Transaction No","sWidth": "10%"},
											   { "sName": "Refund Status","sWidth": "10%"},
											   { "sName": "Refund Date","sWidth": "10%"},
											   {"sName": "default","sWidth": "10%", "sDefaultContent":" <button type='button' class='btn btn-info' align='center' onclick='editPaymentReport(event);' title='Edit'><i class='fa fa-edit'></i></button>"}
						              	     ]          
							});
			 				//dtblPayments.ajax.url("db_online_payment_verification.php?type=SELECT&institute_code=<?php echo $sel_institute;?>&from_date="+from_date+"&to_date="+to_date+"&deposit_status="+status+"&program="+program).load();
						}
						if(res.msg == 'Success')
							toastr.success('Data Successfully Updated');
						else if(res.msg == 'Error_in_pdf_save')
							toastr.error('Error in Saving the Print Application');
						else if(res.msg == 'Error_in_pdf_generate')
							toastr.error('Error in Generating the Print Application');	
						else if(res.msg == 'Error_in_verification')
							toastr.error('Error in Verifying the payment');	
					},
					error:function(){
						toastr.error('Unable to process please contact support');
					}
				});
		},
		fields:{
			cmbDepositStatusEdit: {							//form input type name
				validators: {
					notEmpty: {
						message: 'Required'
					}
				}
			},
			txtTransNoEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
		}
			
	} );
	$('#frmRefundPaymentEdit').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitButtons: 'button[type="submit"]',
		submitHandler: function(validator, form, submitButton) 
		{
					
			var institutedata={
				hidApplNoEdit:$('#hidApplNoEdit').val(),
				hidApplProgramEdit:$('#hidApplProgramEditRefund').val(),
				cmbRefundStatusEdit:$('#cmbRefundStatusEdit').val(),
				txtTransNoEdit:$('#txtTransNumberEdit').val()
			};
			//ajax call to server
				$.ajax({
					url:base_url+"ajax_controller/update_refund_online_payment_verification",
					type:"post",
					data:institutedata,
					success:function(){
						$('#frmRefundPaymentEdit').data('bootstrapValidator').resetForm(true); 
						$('#refundPaymentEditModal').modal('hide'); 
						var dtblPayments = $("#dtblOnlinePayments").DataTable();
						if (document.getElementById('radDate').checked) {
			  				var show_type = document.getElementById('radDate').value;
						}
						else if (document.getElementById('radMonth').checked) {
			  				var show_type = document.getElementById('radMonth').value;
						}

						var from_date = $('#txtFromDate').val();
						var to_date = $('#txtToDate').val();
						var month = $('#cmbMonth').val();
						var year = $('#cmbYear').val();
						var status = $('#cmbDepositStatus').val();
						var program = $('#cmbProgramFilter').val();
						if(show_type =='Month')
						{
							var institutedata=
							{
								institute_code: ins,
								month:month,
								year:year,
								deposit_status:status,
								programs:program
							};	
							var paymentdetails = $('#dtblOnlinePayments').dataTable({
								//"responsive": true,
								"ajax":
								{
									"url": base_url+"/ajax_controller/select_online_payment_verification",
									"type": "POST",
									"data": institutedata,
								}, 
								//"sAjaxSource": "db_online_payment_verification.php?type=SELECT&institute_code=<?php echo $sel_institute;?>&month="+month+"&year="+year+"&deposit_status="+deposit_status+"&programs="+program_codes,
								//"sAjaxSource": base_url+"ajax_controller/select_online_payment_verification",
								"bPaginate": true,
						        "bLengthChange": true,
						        "bFilter": true,
						        "bSort": false,
						        "bInfo": true,
								"bDestroy":true,
						        "bAutoWidth":true,    
						        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutegroupbutton' >>><'col-xs-6'p>>",
							    "aoColumns": [    
						                       { "sName": "sl_no"},
											   { "sName": "Program_code","bVisible":false},
											   { "sName": "Application No"},
											   { "sName": "mobile_no" },
											   { "sName": "Applicant_name" },
						                       { "sName": "Program_name" },
											   { "sName": "Amount"},
											   { "sName": "Request Date","bVisible":false},
											   { "sName": "Response Date","bVisible":false},
											   { "sName": "Request Order Id"},
											   { "sName": "Response Order Id","bVisible":false},
											   { "sName": "Request Date"},
											   { "sName": "Deposit Status"},
											   { "sName": "Transaction No"},
											   { "sName": "Refund Status"},
											   { "sName": "Refund Date"},
											   {"sName": "default", "sDefaultContent":" <button type='button' class='btn btn-info' align='center' onclick='editPaymentReport(event);' title='Edit'><i class='fa fa-edit'></i></button>"}
						              	     ]          
							});
							
			 				//dtblPayments.ajax.url("db_online_payment_verification.php?type=SELECT&institute_code=<?php echo $sel_institute;?>&month="+month+"&year="+year+"&deposit_status="+status).load();
						}
						if(show_type =='Date')
						{
							var institutedata=
							{
								institute_code: ins,
								from_date:from_date,
								to_date:to_date,
								deposit_status:status,
								programs:program
							};	
							var paymentdetails = $('#dtblOnlinePayments').dataTable({
							//"responsive": true,
								"ajax":
								{
									"url": base_url+"/ajax_controller/select_online_payment_verification",
									"type": "POST",
									"data": institutedata,
								}, 
								//"sAjaxSource": "db_online_payment_verification.php?type=SELECT&institute_code=<?php echo $sel_institute;?>&from_date="+from_date+"&to_date="+to_date+"&deposit_status="+deposit_status+"&programs="+program_codes,
								"bPaginate": true,
						        "bLengthChange": true,
						        "bFilter": true,
						        "bSort": false,
						        "bInfo": true,
								"bDestroy":true,
						        "bAutoWidth":true,    
						        "sDom":"<'row'<'col-xs-4'i><'col-xs-4'l><'col-xs-4'f>r>t<'row'<'col-xs-6' <'row' <'col-xs-12 institutegroupbutton' >>><'col-xs-6'p>>",
							    "aoColumns": [    
						                       { "sName": "sl_no","sWidth": "10%" },
											   { "sName": "Program_code","bVisible":false},
											   { "sName": "Application No"},
											   { "sName": "mobile_no","sWidth": "30%" },
											   { "sName": "Applicant_name","sWidth": "30%" },
						                       { "sName": "Program_name","sWidth": "20%" },
											   { "sName": "Amount","sWidth": "10%"},
											   { "sName": "Request Date","bVisible":false},
											   { "sName": "Response Date","bVisible":false},
											   { "sName": "Request Order Id"},
											   { "sName": "Response Order Id","bVisible":false},
											   { "sName": "Request Date","sWidth": "20%"},
											   { "sName": "Deposit Status","sWidth": "10%"},
											   { "sName": "Transaction No","sWidth": "10%"},
											   { "sName": "Refund Status","sWidth": "10%"},
											   { "sName": "Refund Date","sWidth": "10%"},
											   {"sName": "default","sWidth": "10%", "sDefaultContent":" <button type='button' class='btn btn-info' align='center' onclick='editPaymentReport(event);' title='Edit'><i class='fa fa-edit'></i></button>"}
						              	     ]          
							});
			 				//dtblPayments.ajax.url("db_online_payment_verification.php?type=SELECT?institute_code=<?php echo $sel_institute;?>&from_date="+from_date+"&to_date="+to_date+"&deposit_status="+status).load();
						}
						toastr.success('Data Successfully Updated');		
					},
					error:function(){
						toastr.error('Unable to process please contact support');
					}
				});
		},
		fields:{
			cmbDepositStatusEdit: {							//form input type name
				validators: {
					notEmpty: {
						message: 'Required'
					}
				}
			},
			txtTransNumberEdit: {
				validators: {
					notEmpty: {
						message: 'This field can\'t left blank'
					}
				}
			},
		}
			
	} );
	$("#btnExportReport").click(function(){
		if (document.getElementById('radDate').checked) {
			var show_type = document.getElementById('radDate').value;
		}
		else if (document.getElementById('radMonth').checked) {
			var show_type = document.getElementById('radMonth').value;
		}

		var from_date = $('#txtFromDate').val();
		var to_date = $('#txtToDate').val();
		var month = $('#cmbMonth').val();
		var year = $('#cmbYear').val();
		var status = $('#cmbDepositStatus').val();
		var program = $('#cmbProgramFilter').val();
		if(show_type =='Month')
		{
			if(month !='' && year !='' && status !='' )
			{
				if(status == 'MULTIPLE_PAYMENT')
					window.open(base_url+"superadmin/excel_online_payment_report_multiple_month/"+ins+"/"+month+"/"+year+"/"+status,"winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
				else
					window.open(base_url+"superadmin/excel_online_payment_report_month/"+ins+"/"+month+"/"+year+"/"+status,"winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
			}
			else if(month !='' && year !='' && status =='' )
			{
				window.open(base_url+"superadmin/excel_online_payment_report_month/"+ins+"/"+month+"/"+year,"winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
			}
		}
		//alert(from_date);
		/*header("location: excel_online_payment_report.php?institute=$sel_institute&month=$month&year=$year&_s=$MY_SESSION_NAME");
		header("location: excel_online_payment_report.php?institute=$sel_institute&month=$month&year=$year&deposit_status=$deposit_status&_s=$MY_SESSION_NAME");
		header("location: excel_online_payment_report_multiple.php?institute=$sel_institute&month=$month&year=$year&deposit_status=$deposit_status&_s=$MY_SESSION_NAME");
		window.open(base_url+"admin/excel_sc_st_obc/"+program_code,"winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();*/
		var d = new Date(from_date);

		var date = d.getDate();
		var month =  d.getMonth();
		month += 1;  
		var y = d.getFullYear();

		var from_date=(y+ "-" + month + "-" + date);
		
		var d = new Date(to_date);

		var date = d.getDate();
		var month =  d.getMonth();
		month += 1;  
		var y = d.getFullYear();

		var to_date=(y+ "-" + month + "-" + date);
		
		if(show_type =='Date')
		{
			if(from_date !='' && to_date !='' && status =='')
			{
				window.open(base_url+"superadmin/excel_online_payment_report/"+ins+"/"+from_date+"/"+to_date+"/"+status,"winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
			}
			else if(from_date !='' && to_date !='' && status !='')
			{
				//alert(status);
				if(status == 'MULTIPLE_PAYMENT')
					window.open(base_url+"superadmin/excel_online_payment_report_multiple/"+ins+"/"+from_date+"/"+to_date,"winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
				else
					window.open(base_url+"superadmin/excel_online_payment_report/"+ins+"/"+from_date+"/"+to_date+"/"+status,"winadmicardapplicant","left=0,top=0,width=1024,height=700,scrollbars=1,menubar=0,status=0,toolbar=0").focus();
			}
			/*header("location: excel_online_payment_report.php?institute=$sel_institute&from_date=$from_date&to_date=$to_date&deposit_status=$deposit_status&_s=$MY_SESSION_NAME");
			header("location: excel_online_payment_report_multiple.php?institute=$sel_institute&from_date=$from_date&to_date=$to_date&deposit_status=$deposit_status&_s=$MY_SESSION_NAME");
			header("location: excel_online_payment_report.php?institute=$sel_institute&from_date=$from_date&to_date=$to_date&deposit_status=$deposit_status&_s=$MY_SESSION_NAME");*/
		}
	});
	
	/*$('.tooltips').tooltipster({
		theme: 'tooltipster-punk',
		animation: 'grow',
        delay: 200, 
        touchDevices: false,
        trigger: 'hover'
     });	*/
/* END OF TOOLTIP */
	/* CODE FOR TOASTR */
	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "progressBar": false,
	  "positionClass": "toast-bottom-right",//top-right,bottom-left,top-left,top-full-width,bottom-full-width,top-center,bottom-center
	  "onclick": null,
	  "showDuration": "20000",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}
	
	/*$( "#txtResponseDateEdit" ).datetimepicker({
		dateFormat: 'dd-mm-yy',
		/*minDate:'0',*/
		
	/*});*/
	
});
function editPaymentReport(event)
{
	var status = $("#cmbDepositStatus").val();
	//alert(status);
	var oTable = $('#dtblOnlinePayments').dataTable();
	/*$(oTable.fnSettings().aoData).each(function ()
	{
		$(this.nTr).removeClass('success');
	});*/
	var row;
	if(event.target.tagName == "BUTTON" || event.target.tagName == "A")
		row = event.target.parentNode.parentNode;
	else if(event.target.tagName == "I")
		row = event.target.parentNode.parentNode.parentNode;
	var appl_no = oTable.fnGetData( row )['appl_no'];
	var applied_program = oTable.fnGetData( row )[1];
	var request_date = oTable.fnGetData( row )[7];
	var response_date = oTable.fnGetData( row )[8];
	//alert(appl_no);
	$('#hidApplNoEdit').val(appl_no);
	$('#hidApplProgramEdit').val(applied_program);
	$('#hidApplProgramEditRefund').val(applied_program);
	$('#hidRequestDateEdit').val(request_date);
	if(response_date !='')
	{
		$('#txtResponseDateEdit').val(response_date);
	}
	else
	{
		$('#txtResponseDateEdit').datepicker({
		    dateFormat: "dd-mm-yy",
			onSelect: function (date) {
	            var date2 = $('#txtResponseDateEdit').datepicker('getDate');
				$('#txtResponseDateEdit').datepicker('option', 'maxDate', date2);
				//$('#txtAppEnddate').datetimepicker('option', 'maxDate', date2);
				
	        }
	    });
	}
	//$('#txtResponseDateEdit').datetimepicker("setDate", response_date ).datetimepicker('update');
	$('#hidAmountEdit').val(oTable.fnGetData( row )[6]);
	$('#txtRequestTime').val(oTable.fnGetData( row )[7]);
	$('#cmbDepositStatusEdit').val(oTable.fnGetData( row )['deposit_status']);
	if($('#cmbDepositStatusEdit').val() == null)
	{
		$('#cmbDepositStatusEdit').val('INITIATED');
	}
	$('#txtTransNoEdit').val(oTable.fnGetData( row )[9]);
	$('#txtTransNumberEdit').val(oTable.fnGetData( row )[9]);
	//alert($('#cmbDepositStatusEdit').val());
    //alert(row.cells[5].innerHTML);
	if(status == "MULTIPLE_PAYMENT")
	{
		$('#refundPaymentEditModal').modal('show');
	}
	else
	{
		$('#onlinePaymentEditModal').modal('show');
	}
	
	//alert(appl_no);
	//alert(applied_program);
}
function serealizeSelects (select)
{
    var array = [];
    select.each(function(){ array.push($(this).val()) });
    return array;
}
function validate()
{
	var errorMessage = "";
	var message = '<div>';
	if (document.getElementById('radMonth').checked) {
		if(document.getElementById("cmbMonth").value == "")
		{
			errorMessage += "Please select Month from the dropdown.<br/>";
			
		}
		if(document.getElementById("cmbYear").value == "")
		{
			errorMessage += "Please select Year from the dropdown.<br/>";
		}
	}	
	if (document.getElementById('radDate').checked) {
		if(document.getElementById("txtFromDate").value == "")
		{
			errorMessage += "Please Pick the Start date<br/>";
		}
		if(document.getElementById("txtToDate").value == "")
		{
			errorMessage += "Please Pick the End date.<br/>";
		}
	}	
	if(errorMessage != "")
	{
		message += errorMessage + "</div>";
		//alertmessage.innerHTML = message;
		document.getElementById("alertmessage").innerHTML=message;
		$('.alert').show();
		window.scrollTo(0,0);
		return false;	 
	}
	else
		return true;
}
    </script>