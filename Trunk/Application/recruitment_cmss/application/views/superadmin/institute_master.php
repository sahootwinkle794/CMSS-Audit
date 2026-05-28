<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/datatable/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/datatable/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/template_lib/plugins/datatable/css/rowReorder.dataTables.min.css">

<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-ui.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>public/template_lib/plugins/datatable/js/dataTables.rowReorder.min.js"></script>

<!--********************************************************** CONTENT PART ************************************************************************************************************** -->	
	
	<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" >
	<section class="content-header">
      	<h1>Institute Master</h1>
      	<ol class="breadcrumb">
        	<li class="active"><a href="#"><i class="fa fa-user-plus"></i> Institute Master</a></li>
        </ol>
	</section>
	<section class="content">
		<div class="row">
	        <div class="col-xs-8">
	          	<div class="box">
		            <div class="box-body">
		            	<div class="col-lg-12">
	           				<table id="example" class="table table-bordered table-hover">
				                <thead>
			                        <tr>
			                            <th>Slno</th>
			                            <th>Logo</th>
			                            <th>Code</th>
			                            <th>Name</th>
			                            <th>Contact Number</th>
			                            <th>Status</th>
			                            <th>Action</th>
			                        </tr>
			                    </thead>
			                    <tbody>
			                    	<tr>
			                    		<td>1</td>
			                    		<td></td>
			                    		<td>IO</td>
			                            <td>Ide Odisha</td>
			                            <td>9668458796</td>
			                            <td>active</td>
			                            <td> <!--<i class="fa fa-pencil-square-o" id="edit"></i>  <i class="fa  fa-trash-o" id="delete"></i> -->
			                           		 <button type="button" class="btn btn-info btn-circle"  onclick='prog_update()' id="edit" ><i class="fa fa-pencil-square-o"></i></button>&nbsp;<button type="button" class="btn btn-danger btn-circle" onclick="prog_delete()"  id="delete"><i class="fa fa-trash"></i></button>
			                            </td>
			                    	</tr>
			                    </tbody>
				            </table>
						</div>
						
		           	</div>
  					
	          	</div>
	        </div>
	        <div class="col-xs-4" id="program_master_first">
	        	<div class="box">
	        		<div class="box-header with-border">
			          	<h3 class="box-title" id="box_header">Institute Add</h3>
			        </div>
	        		<form class="form-horizontal" id="frm_prog">
			            <div class="box-body">
			             	<div class="form-group col-sm-12">
			             	
				             	<div class="col-sm-12">
									<label class="control-label col-sm-4"></i> Name:</label>
									
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Name" value="" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
										<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
									</div>
									<!--<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">-->
								</div>
								
								<div class="col-sm-12">
									<label class="control-label col-sm-4"></i>Code:</label>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Code" value="" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
										<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
									</div>
									<!--<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">-->
								</div>
								
								<div class="col-sm-12">
									<label class="control-label col-sm-4"></i>Web Address:</label>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Code" value="" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
										<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
									</div>
									<!--<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">-->
								</div>
								
								<div class="col-sm-12">
									<label class="control-label col-sm-4"></i>Email ID:</label>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Code" value="" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
										<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
									</div>
									<!--<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">-->
								</div>
								
								<div class="col-sm-12">
									<label class="control-label col-sm-4"></i>Concat No:</label>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Code" value="" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
										<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
									</div>
									<!--<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">-->
								</div>
								
								<div class="col-sm-12">
									<label class="control-label col-sm-4"></i>Location:</label>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Code" value="" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
										<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
									</div>
									<!--<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">-->
								</div>
								
			             	</div>
			            </div>
			            <div class="box-footer with-border">
				          	<div class="box-tools pull-right">
				          		<button type="button" class="btn btn-success" id="Institute_add">Add</button>
				          		<button type="button" class="btn btn-default" id="button_reset" onclick="form_reset();">Reset</button>
				          	</div>
				        </div>
			        </form>
		        </div>
	        </div>
	        <div class="col-xs-4" id="edit_div" style="display: none;">
	        	<div class="box">
	        		<div class="box-header with-border">
			          	<h3 class="box-title" id="box_header">Institute Edit</h3>
			        </div>
			        <form class="form-horizontal" id="frm_prog">
			            <div class="box-body">
			             	<div class="form-group col-sm-12">
				             	<div class="col-sm-12">
									<label class="control-label col-sm-4"></i> Institute Name:</label>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Name" value="Ide Odisha" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
										<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
									</div>
									<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">
								</div>
								
								<div class="col-sm-12">
									<label class="control-label col-sm-4"></i>Institute Code:</label>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Code" value="IO" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
										<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
									</div>
									<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">
								</div>
								
								<div class="col-sm-12">
									<label class="control-label col-sm-4"></i>Web Address:</label>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Code" value="" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
										<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
									</div>
									<!--<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">-->
								</div>
								
								<div class="col-sm-12">
									<label class="control-label col-sm-4"></i>Email ID:</label>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Code" value="" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
										<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
									</div>
									<!--<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">-->
								</div>
								
								<div class="col-sm-12">
									<label class="control-label col-sm-4"></i>Concat No:</label>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Code" value="" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
										<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
									</div>
									<!--<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">-->
								</div>
								
								<div class="col-sm-12">
									<label class="control-label col-sm-4"></i>Location:</label>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Code" value="" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
										<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
									</div>
									<!--<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">-->
								</div>
								
								<!--<div class="col-sm-12" align="center">
									<button type="button" class="btn btn-success" id='edit2'><i class="fa fa-pencil-square-o"></i></button>
								</div>-->
			             	</div>
			            </div>
			            <div class="box-footer with-border">
				          	<div class="box-tools pull-right">
				          		<button type="button" class="btn btn-success" id='edit2'>Edit</button>
				          		<button type="button" class="btn btn-default" id="button_reset" onclick="form_reset();">Reset</button>
				          	</div>
				        </div>
			        </form>
		        </div>
	        </div>
      	</div>
	</section>
	
</div>

<script>
	$(function () {
		
	    $('#example2').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false
	    });
	    // New record
	    $('a.editor_create').on('click', function (e){
	        e.preventDefault();
	 		editor.create({
	            title: 'Create new record',
	            buttons: 'Add'
	        });
	    });
	    // Edit record
	    $('#example').on('click', 'a.editor_edit', function (e) {
	        e.preventDefault();
	 
	        editor.edit( $(this).closest('tr'), {
	            title: 'Edit record',
	            buttons: 'Update'
	        });
	    });
	   // Delete a record
	    $('#example').on('click', 'a.editor_remove', function (e) {
	        e.preventDefault();
	 		editor.remove( $(this).closest('tr'),{
	            title: 'Delete record',
	            message: 'Are you sure you wish to remove this record?',
	            buttons: 'Delete'
	        });
	    });
		$('#example').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false
	    });
	    

	});
 
 
 	   
	$("#edit").click(function(){
	    $("#edit_div").show();
	    $("#program_master_first").hide();
	});
	 
	$("#delete").click(function(){
	 	toastr.success('record is successfully deleted');
	});
	 
	 
	$("#Institute_add").click(function(){
	 	toastr.success('record is successfully added');
	});
	 
	$("#edit2").click(function(){
	 	toastr.success('record is successfully updated');
	});
	 
</script>	