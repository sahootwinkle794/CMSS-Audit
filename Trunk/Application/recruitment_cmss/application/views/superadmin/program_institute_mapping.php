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
      	<h1> Program Institute Mapping</h1>
      	<ol class="breadcrumb">
        	<li class="active"><a href="#"><i class="fa fa-user-plus"></i> Mapping</a></li>
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
			                            <th>Instutute Name</th>
			                            <th>Instutute Code</th>
			                            <th>Program Name</th>
			                            <th>Program Code</th>
			                           	<th>Action</th>
			                        </tr>
			                    </thead>
			                    <tbody>
			                    	<tr>
			                    		<td>Ide Odisha</td>
			                            <td>IO</td>
			                            <td>Self-Financing Programmes on Computers</td>
			                            <td>SFPC</td>
			                            <td> <i class="fa fa-pencil-square-o" id="edit"></i>  <i class="fa  fa-trash-o" id="delete"></i> </td>
			                    	</tr>
			                    </tbody>
				            </table>
						</div>
						
		           	</div>
  					
	          	</div>
	        </div>
	        <div class="col-xs-4" id="program_master_first">
	        	<div class="box">
		            <div class="box-body">
		             	<div class="row">
		             	
		             	<div class="col-sm-12">
							<label class="control-label col-sm-4"></i>  Instutute Name:</label>
							<div class="form-group col-sm-8">
								<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Name" value="" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
								<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
							</div>
							<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">
						</div>
						<div class="col-sm-12">
							<label class="control-label col-sm-4"></i>Instutute Code:</label>
							<div class="form-group col-sm-8">
								<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Code" value="" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
								<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
							</div>
							<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">
						</div>
						<div class="col-sm-12">
							<label class="control-label col-sm-4"></i>  Program Name:</label>
							<div class="form-group col-sm-8">
								<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Name" value="Self-Financing Programmes on Computers" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
								<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
							</div>
							<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">
						</div>
						<div class="col-sm-12">
							<label class="control-label col-sm-4"></i>Program Code:</label>
							<div class="form-group col-sm-8">
								<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Code" value="SFPC" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
								<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
							</div>
							<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">
						</div>
						
						<div class="col-sm-12" align="center">
							<button type="button" class="btn btn-success"  id='plus'><i class="fa fa-plus"></i></button>
						</div>
		             		
		             	</div>
		            </div>
		        </div>
	        </div>
	        <div class="col-xs-4" id="edit_div" style="display: none;">
	        	<div class="box">
		            <div class="box-body">
		             	<div class="row">
		             	
		             	<div class="col-sm-12">
							<label class="control-label col-sm-4"></i> Instutute Name:</label>
							<div class="form-group col-sm-8">
								<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Name" value="Ide Odisha" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
								<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
							</div>
							<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">
						</div>
						<div class="col-sm-12">
							<label class="control-label col-sm-4"></i>Instutute Code:</label>
							<div class="form-group col-sm-8">
								<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Code" value="IO" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
								<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
							</div>
							<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">
						</div>
						<div class="col-sm-12">
							<label class="control-label col-sm-4"></i>  Program Name:</label>
							<div class="form-group col-sm-8">
								<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Name" value="Self-Financing Programmes on Computers" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
								<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
							</div>
							<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">
						</div>
						<div class="col-sm-12">
							<label class="control-label col-sm-4"></i>Program Code:</label>
							<div class="form-group col-sm-8">
								<input type="text" class="form-control" name="txtFirstName" id="txtFirstName" placeholder="Program Code" value="SFPC" required="" onblur="this.value=this.value.toUpperCase()" data-bv-field="txtFirstName">
								<small data-bv-validator="notEmpty" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name is required and can't be empty</small><small data-bv-validator="stringLength" data-bv-validator-for="txtFirstName" class="help-block" style="display: none;">The name must be more than 6 and less than 30 characters long</small>
							</div>
							<input type="hidden" value="" name="hidFirstNameStatus" id="hidFirstNameStatus">
						</div>
						
						<div class="col-sm-12" align="center">
							<button type="button" class="btn btn-success" id='edit2'><i class="fa fa-pencil-square-o"></i></button>
						</div>
		             		
		             	</div>
		            </div>
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
	    $('a.editor_create').on('click', function (e) {
	        e.preventDefault();
	 
	        editor.create( {
	            title: 'Create new record',
	            buttons: 'Add'
	        } );
	    } );
	 
	    // Edit record
	    $('#example').on('click', 'a.editor_edit', function (e) {
	        e.preventDefault();
	 
	        editor.edit( $(this).closest('tr'), {
	            title: 'Edit record',
	            buttons: 'Update'
	        } );
	    } );
	 
	    // Delete a record
	    $('#example').on('click', 'a.editor_remove', function (e) {
	        e.preventDefault();
	 
	        editor.remove( $(this).closest('tr'), {
	            title: 'Delete record',
	            message: 'Are you sure you wish to remove this record?',
	            buttons: 'Delete'
	        } );
	    } );
	  $('#example').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false
	    });	
	   /* $('#example').DataTable( {
	        ajax: "../php/staff.php",
	        columns: [
	            { data: null, render: function ( data, type, row ) {
	                // Combine the first and last names into a single table field
	                return data.first_name+' '+data.last_name;
	            } },
	            { data: "position" },
	            { data: "office" },
	            { data: "extn" },
	            { data: "start_date" },
	            { data: "salary", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) },
	            {
	                data: null,
	                className: "center",
	                defaultContent: '<a href="" class="editor_edit">Edit</a> / <a href="" class="editor_remove">Delete</a>'
	            }
	        ]
	    } );*/
	});
 
 
 	   
	 $("#edit").click(function(){
	    $("#edit_div").show();
	    $("#program_master_first").hide();
	 });
	 
	 $("#delete").click(function(){
	 	
	 	toastr.success('record is successfully deleted');
	   /* $("#edit_div").show();
	    $("#program_master_first").hide();*/
	    
	 });
	 
	 
	 $("#plus").click(function(){
	 	toastr.success('record is successfully added');
	 });
	 
	$("#edit2").click(function(){
	 	toastr.success('record is successfully updated');
	 });
	 
</script>	