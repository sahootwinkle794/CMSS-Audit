<?php
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d H:i:s', now());
foreach($institute_data as $ins_data)
{
	$institute_code = $ins_data['institute_code'];
	$institute_name = $ins_data['institute_name'];
	$image_url = $ins_data['image_url'];
}
foreach($appl_status as $appl_data)
{
	$appl_statuss = $appl_data['appl_status'];
}
foreach($appl_date as $appl_date)
{
	$appl_start_date = $appl_date['counselling_start_date'];
	$appl_end_date = $appl_date['counselling_end_date'];
	$counselling_start_date = $appl_date['choice_lock_start_date'];
	$counselling_end_date = $appl_date['choice_lock_end_date'];
}
foreach($lock_status as $row)
{
	$lock_btn_status = $row['count'];
}
foreach($choices_count as $row)
{
	$ipb_code_count = $row['ipb_code'];
}
?>
<style>
	
	
	ul.source, ul.target,ul.locked {
      min-height: 50px;
      margin: 0px 25px 10px 0px;
      padding: 2px;
      border-width: 1px;
      border-style: solid;
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
      list-style-type: none;
      list-style-position: inside;
    }
    ul.source {
      border-color: #f8e0b1;
    }
    ol.target {
      border-color: #add38d;
      border-width: 1px;
      	border-style: solid;
    }
    ul.locked {
	  border-color: #add38d;
	}
    .source li, .target li,.locked li {
      margin: 5px;
      padding: 5px;
      -webkit-border-radius: 4px;
      -moz-border-radius: 4px;
      border-radius: 4px;
      text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
    }
    .source li {
      background-color: #fcf8e3;
      border: 1px solid #fbeed5;
      color: #c09853;
    }
    .locked li {
      background-color: #ebf5e6;
      border: 1px solid #d6e9c6;
      color: #468847;
    }
    .target li {
      background-color: #ebf5e6;
      border: 1px solid #d6e9c6;
      color: #468847;
    }
    .sortable-dragging {
      border-color: #ccc !important;
      background-color: #fafafa !important;
      color: #bbb !important;
    }
    .sortable-placeholder {
      height: 40px;
    }
    .source .sortable-placeholder {
      border: 2px dashed #f8e0b1 !important;
      background-color: #fefcf5 !important;
    }
    .target .sortable-placeholder {
      border: 2px dashed #add38d !important;
      background-color: #f6fbf4 !important;
    }
    .divLocked {
	    float: left;
	    width: 50%;
	    padding: 10px;
	}
	.column {
	    float: left;
	    width: 50%;
	    padding: 10px;
	}
	    body > li {
      width: 177px;
      margin: 5px;
      padding: 5px;
      -webkit-border-radius: 4px;
      -moz-border-radius: 4px;
      border-radius: 4px;
      text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
      list-style-type: none;
      list-style-position: inside;
      border-width: 1px;
      border-style: solid;
      border-color: #ccc !important;
      background-color: #fafafa !important;
      color: #bbb !important;
    }
    .listActive {
      border: 1px solid #ccc;
      background-color: #fcfcfc;
      padding: 0.5em 0 3em 0 !important;
    }
    .placeholder {
      list-style-type: none;
      text-align: center;
      font-style: italic;
      border: 1px dashed #ddd !important;
      background-color: #fff !important;
      color: #aaa !important;
    }
    .dismiss {
      float: right;
      position: relative;
      top: -8px;
      line-height: 20px;
      font-size: 12px;
      font-weight: bold;
      text-decoration: none !important;
      color: #468847;
    }
</style>
<div class="row">
	<div class="col-sm-1" style="margin-top: 30px;">
		<?php include('sidebar/sidebar.php'); ?>
		
	</div>
	<div class="col-sm-11">
		<input type="hidden" id="hidInstituteCode" name="hidInstituteCode" value="<?php echo encrypt_decrypt('encrypt', $institute_code); ?>"/>
		<input type="hidden" id="hidApplStatus" name="hidApplStatus" value="<?php echo $appl_statuss; ?>"/>
		<input type="hidden" id="hidApplStartDate" name="hidApplStartDate" value="<?php echo $appl_start_date; ?>"/>
		<input type="hidden" id="hidApplEndDate" name="hidApplEndDate" value="<?php echo $appl_end_date; ?>"/>
		<input type="hidden" id="hidChoiceLockStartDate" name="hidChoiceLockStartDate" value="<?php echo $counselling_start_date; ?>"/>
		<input type="hidden" id="hidChoiceLockEndDate" name="hidChoiceLockEndDate" value="<?php echo $counselling_end_date;?>"/>
		<input type="hidden" id="hidChoiceLockStatus" name="hidChoiceLockStatus" value="<?php echo $lock_btn_status;?>"/>
		<input type="hidden" id="hidIBPChoices" name="hidIBPChoices" value="<?php echo $ipb_code_count;?>"/>
		<input type="hidden" id="today" name="today" value="<?php echo $today;?>"/>
			
		
		<div class="sideBySide" id="divSave">
		  <div class="column"><center><h4>List of Available Choices</h4></center>
		    <ul class="source" id="branchData" style="overflow: auto;height: 300px;">
		    	<!--<div id="branchData"></div>-->
		    	
		    </ul>
		  </div>
		  <div class="column"><center><h4>Preference wise Filled Choices</h4></center>
		    <ol class="target" id="branchCheckData"  style="overflow: auto;height: 300px;">
		    	<li class="placeholder" id = "id1">Drop your Preferences here</li>
		    </ol>
		  </div>
		</div>
		<div class="sideBySideLocked" id="divLock">
			<div class="divLocked"><center><h4>List of Locked Choices</h4></center>
				<ul class="locked" id="branchSavedData" style="overflow: auto;">
			    </ul>
			</div>
		</div>
		<div id="divSteps" class="column">
			<div><b>Choice Selection Steps:</b>
				<br /><ol>
						<li>To select one choice drag and drop from left box to right box.</li>
						<li>After preference complete save the choices by clicking on save button.</li>
						<li>Choice will be open till date of locking. Choice locking date will be notified in the portal. Based on your locked choices seat will be allocated for counselling.</li>
					</ol>
			</div>
		</div>
		<div class="form-group" >
			<div class="col-lg-6">
			</div>
			<div class="col-lg-2">
				<button type="button" class="btn btn-success btn-block" id="btnSave" name="btnSave" style="margin-top: 20px;font-size:16px;"><span class="glyphicon glyphicon-send" style="font-size:18px;"></span> Save</button>
			</div>
			<div class="col-lg-2">
				<button type="button" class="btn btn-warning btn-block" id="btnLock" name="btnLock" style="margin-top: 20px;font-size:16px;"><i class="fa fa-lock" aria-hidden="true"></i> Lock</button>
			</div>
			<div class="col-lg-2">
				<button type="button" class="btn btn-info btn-block" id="btnPrint" name="btnPrint" style="margin-top: 20px;font-size:16px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Print</button>
			</div>
		</div>	
		<div class="modal fade" id="modalInstruction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header" style="background-color: #496cad;color: white;">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" style="color: white;" id="myModalLabel">OTP</h4>
		      </div>
		      <div class="modal-body" id="divInstruction">
		      	<!--<div class="form-group">
					<label for="usr">Please Enter the OTP sent to your mobile:</label>
					<input type="text" class="form-control" id="otp_lock">
			    </div>-->
			    <div class="form-group">
					<label for="" class="col-sm-7 control-label">Please Enter the OTP sent to your mobile:</label>
					<div class="col-sm-5">
						<input  type="text" class="form-control tooltips" id="otp_save" name="otp_save" title="Enter Amount"/>
					</div>
				</div>
		      		
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary" id="otp_save_submit" data-dismiss="modal">Submit</button>
		      </div>
		    </div>
		  </div>
		</div>

		<div class="modal fade" id="modalInstructionLocks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header" style="background-color: #496cad;color: white;">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" style="color: white;" id="myModalLabel">OTP</h4>
		      </div>
		      <div class="modal-body" id="divInstruction">
		      	<!--<div class="form-group">
					<label for="usr">Please Enter the OTP sent to your mobile:</label>
					<input type="text" class="form-control" id="otp_lock">
			    </div>-->
			    <div class="form-group">
					<label for="" class="col-sm-7 control-label">Please Enter the OTP sent to your mobile:</label>
					<div class="col-sm-5">
						<input  type="text" class="form-control tooltips" id="otp_lock" name="otp_lock" title="Enter Amount"/>
					</div>
				</div>
		      		
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary" id="otp_lock_submit" data-dismiss="modal">Submit</button>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</div>
<br /><br /><br />
<!--<button type="button" id="btnSave" name="btnSave">Save</button>-->

<script src="<?php echo base_url(); ?>public/template_lib/plugins/sortable/jquery.sortable5.min.js"></script>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/sortable/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript">
$(function () {
    $(".source li").draggable({
      addClasses: false,
      appendTo: "body",
      helper: "clone"
    }).sortable({
    	connectWith: ".connected"
    });
    $(".target").droppable({
      //addClasses: false,
      activeClass: "listActive",
      accept: ":not(.ui-sortable-helper)",
      drop: function(event, ui) {
        $(this).find(".placeholder").remove();
        var link = $("<a href='#' class='dismiss'>x</a>");
        var list = $("<li></li>").text(ui.draggable.text());
        var dragItam = list[0].firstChild.nodeValue;
        var s = true;
        $("ol.target").children().each(function() {
		  var item = $(this).text();
		  if(item == dragItam){
		  	s = false;
		  }
		});
        
        //$(list).append(link);
        if(s){
			$(list).appendTo(this);
        	//updateMainExample();
		}else{
			toastr.warning(dragItam);
		}
      }
    }).sortable({
    	connectWith: ".connected",
        items: "li:not(.placeholder)",
	    sort: function() {
	        $(this).removeClass("listActive");
	    },
	    update: function() {
	        //updateMainExample();
	    }
    }).on("click", ".dismiss", function(event) {
      event.preventDefault();
      $(this).parent().remove();
      //updateMainExample();
    });
});
var xy = document.getElementById("divSteps");
xy.style.display = "block";
var institute_code = $('#hidInstituteCode').val();
if($('#hidApplStatus').val() != 'Fee Paid' || $('#hidChoiceLockStatus').val() == '0' || (($('#hidChoiceLockStartDate').val() > $('#today').val()) ||( $('#hidChoiceLockEndDate').val() < $('#today').val()) ))
{
	$('#btnLock').prop('disabled', true);
}
if($('#hidApplStatus').val() != 'Choice Locking')
{
	$('#btnPrint').prop('disabled', true);
}
if($('#hidApplStatus').val() == 'Choice Locking' || $('#hidApplStatus').val() == 'Alloted' || $('#hidApplStatus').val() == 'Valid' || $('#hidApplStatus').val() == 'Invalid'  || $('#hidApplStatus').val() == 'Seat Alloted')
{
	$('#btnLock').prop('disabled', true);
	$('#btnSave').prop('disabled', true);
	var x = document.getElementById("divLock");
	x.style.display = "block";
	var y = document.getElementById("divSave");
	y.style.display = "none";
	$.ajax({
		url:base_url+"ajaxcounselling_controller/get_saved_data",
		type:"post",
		success:function(response){  
			var res = JSON.parse(response);
			var string = "" + res.branch + "";
			var ipb = "" + res.ipb_code + "";
			var str_array = string.split(',');
			var ipb_array = ipb.split(',');
			//alert(ipb_array);
			var branch = '';
			//branch += "<li class='placeholder'>Drop your favourites here</li>";
			for(var i = 0; i < str_array.length; i++) {
			  	branch += "<li id="+ipb_array[i]+">"+str_array[i]+"</li>";
			}
			$('#branchSavedData').html(branch);
			$('#divSteps').html("");
			$('#divSteps').html("<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />");
			/*var xy = document.getElementById("divSteps");
			xy.style.display = "none";*/
			/*$(".source, .target").sortable({
		      connectWith: ".connected"
		    });*/
			/*if(res.status == true)
			{
				toastr.success("Data Successfully Saved");
			}*/
			
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
}
if($('#hidChoiceLockEndDate').val() < $('#today').val())
{
	$.ajax({
		url:base_url+"ajaxcounselling_controller/lock_branch_data",
		type:"post",
		success:function(response){  
			var res = JSON.parse(response);
			if(res.status == true)
			{
				$('#btnPrint').prop('disabled', false);
				$('#btnLock').prop('disabled', true);
				$('#btnSave').prop('disabled', true);
				toastr.success("Data Successfully Saved");
				var x = document.getElementById("divLock");
				x.style.display = "block";
				var y = document.getElementById("divSave");
				y.style.display = "none";
				
				$.ajax({
					url:base_url+"ajaxcounselling_controller/get_saved_data",
					type:"post",
					success:function(response){  
						var res = JSON.parse(response);
						var string = "" + res.branch + "";
						var ipb = "" + res.ipb_code + "";
						var str_array = string.split(',');
						var ipb_array = ipb.split(',');
						//alert(ipb_array);
						var branch = '';
						//branch += "<li class='placeholder'>Drop your favourites here</li>";
						for(var i = 0; i < str_array.length; i++) {
						  	branch += "<li id="+ipb_array[i]+">"+str_array[i]+"</li>";
						}
						$('#branchSavedData').html(branch);
						
						$('#divSteps').html("");
						$('#divSteps').html("<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />");
						/*$(".source, .target").sortable({
					      connectWith: ".connected"
					    });*/
						if(res.status == true)
						{
							toastr.success("Data Successfully Saved");
						}
						
					},
					error:function(){
						toastr.error("We are unable to Process.Please contact Support");
					}
				});
			}
			
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
}
$('#btnPrint').click(function()
{
	window.open(base_url+"applyCounselling/choice_locking_pdf");
});

if($('#hidChoiceLockStatus').val() != '0' && $('#hidApplStatus').val() != 'Choice Locking' && $('#hidApplStatus').val() != 'Alloted' && $('#hidApplStatus').val() != 'Valid' && $('#hidApplStatus').val() != 'Invalid'  && $('#hidApplStatus').val() != 'Seat Alloted')
{
	$('#btnLock').prop('disabled', false);
	//get branch data
	var x = document.getElementById("divLock");
	x.style.display = "none";
	var y = document.getElementById("divSave");
	y.style.display = "block";
	$.ajax({
		url:base_url+"ajaxcounselling_controller/select_branch_data",
		type:"post",
		success:function(response){  
			var res = JSON.parse(response);
			var string = "" + res.branch + "";
			var ipb = "" + res.ipb_code + "";
			var str_array = string.split(',');
			var ipb_array = ipb.split(',');
			//alert(ipb_array);
			var branch = '';
			//branch += "<li class='placeholder'>Drop your favourites here</li>";
			for(var i = 0; i < str_array.length; i++) {
			  	branch += "<li data-id="+ipb_array[i]+">"+str_array[i]+"</li>";
			}
			$('#branchData').html(branch);
			$(".source li").draggable({
		      addClasses: false,
		      appendTo: "body",
		      helper: "clone"
		    }).sortable({
		    	connectWith: ".connected"
		    });
		    $(".target").droppable({
		      addClasses: false,
		      activeClass: "listActive",
		      accept: ":not(.ui-sortable-helper)",
		      drop: function(event, ui) {
		        $(this).find(".placeholder").remove();
		        var link = $("<a href='#' class='dismiss'>x</a>");
		        var list = $("<li></li>").text(ui.draggable.text());
		        var dragItam = list[0].firstChild.nodeValue;
		        var s = true;
		        $("ol.target").children().each(function() {
				  var item = $(this).text();
				  if(item == dragItam){
				  	s = false;
				  }
				});
		        
		        //$(list).append(link);
		        if(s){
					$(list).appendTo(this);
		        	//updateMainExample();
				}else{
					toastr.warning("You have already preferred this choice!!");
				}
		      }
		    }).sortable({
		    	connectWith: ".connected",
		        items: "li:not(.placeholder)",
			    sort: function() {
			        $(this).removeClass("listActive");
			    },
			    update: function() {
			        //updateMainExample();
			    }
		    }).on("click", ".dismiss", function(event) {
		      event.preventDefault();
		      $(this).parent().remove();
		      //updateMainExample();
		    });
			/*$(".source, .target").sortable({
		      connectWith: ".connected"
		    });*/
			
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
	$.ajax({
		url:base_url+"ajaxcounselling_controller/get_saved_data",
		type:"post",
		success:function(response){  
			var res = JSON.parse(response);
			var string = "" + res.branch + "";
			var ipb = "" + res.ipb_code + "";
			var str_array = string.split(',');
			var ipb_array = ipb.split(',');
			//alert(ipb_array);
			var branch = '';
			//branch += "<li class='placeholder'>Drop your favourites here</li>";
			for(var i = 0; i < str_array.length; i++) {
			  	branch += "<li data-id="+ipb_array[i]+">"+str_array[i]+"</li>";
			}
			$('#branchCheckData').html(branch);
			$(".source li").draggable({
		      addClasses: false,
		      appendTo: "body",
		      helper: "clone"
		    }).sortable({
		    	connectWith: ".connected"
		    });
		    $(".target").droppable({
		      //addClasses: false,
		      activeClass: "listActive",
		      accept: ":not(.ui-sortable-helper)",
		      drop: function(event, ui) {
		        $(this).find(".placeholder").remove();
		        var link = $("<a href='#' class='dismiss'>x</a>");
		        var list = $("<li></li>").text(ui.draggable.text());
		        var dragItam = list[0].firstChild.nodeValue;
		        var s = true;
		        $("ol.target").children().each(function() {
				  var item = $(this).text();
				  if(item == dragItam){
				  	s = false;
				  }
				});
		        
		        //$(list).append(link);
		        if(s){
					$(list).appendTo(this);
		        	//updateMainExample();
				}else{
					toastr.warning("You have already preferred this choice!!");
				}
		      }
		    }).sortable({
		    	connectWith: ".connected",
		        items: "li:not(.placeholder)",
			    sort: function() {
			        $(this).removeClass("listActive");
			    },
			    update: function() {
			        //updateMainExample();
			    }
		    }).on("click", ".dismiss", function(event) {
		      event.preventDefault();
		      $(this).parent().remove();
		      //updateMainExample();
		    });
			/*$(".source, .target").sortable({
		      connectWith: ".connected"
		    });*/
			if(res.status == true)
			{
				toastr.success("Data Successfully Saved");
			}
			
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});	
}
else
{
	$.ajax({
		url:base_url+"ajaxcounselling_controller/select_branch_data",
		type:"post",
		success:function(response){  
			var res = JSON.parse(response);
			var string = "" + res.branch + "";
			var ipb = "" + res.ipb_code + "";
			var str_array = string.split(',');
			var ipb_array = ipb.split(',');
			//alert(ipb_array);
			var branch = '';
			//branch += "<li class='placeholder'>Drop your favourites here</li>";
			for(var i = 0; i < str_array.length; i++) {
			  	branch += "<li data-id="+ipb_array[i]+">"+str_array[i]+"</li>";
			}
			$('#branchData').html(branch);
			$(".source li").draggable({
		      addClasses: false,
		      appendTo: "body",
		      helper: "clone"
		    }).sortable({
		    	connectWith: ".connected"
		    });
		    $(".target").droppable({
		      addClasses: false,
		      activeClass: "listActive",
		      accept: ":not(.ui-sortable-helper)",
		      drop: function(event, ui) {
		        $(this).find(".placeholder").remove();
		        var link = $("<a href='#' class='dismiss'>x</a>");
		        var list = $("<li></li>").text(ui.draggable.text());
		        var dragItam = list[0].firstChild.nodeValue;
		        var s = true;
		        $("ol.target").children().each(function() {
				  var item = $(this).text();
				  if(item == dragItam){
				  	s = false;
				  }
				});
		        
		        //$(list).append(link);
		        if(s){
					$(list).appendTo(this);
		        	//updateMainExample();
				}else{
					toastr.warning("You have already preferred this choice!!");
				}
		      }
		    }).sortable({
		    	connectWith: ".connected",
		        items: "li:not(.placeholder)",
			    sort: function() {
			        $(this).removeClass("listActive");
			    },
			    update: function() {
			        //updateMainExample();
			    }
		    }).on("click", ".dismiss", function(event) {
		      event.preventDefault();
		      $(this).parent().remove();
		      //updateMainExample();
		    });
			/*$(".source, .target").sortable({
		      connectWith: ".connected"
		    });*/
			
		},
		error:function(){
			toastr.error("We are unable to Process.Please contact Support");
		}
	});
}
$('#btnLock').click(function(){
	//window.location.href=(base_url+'apply/choice_locking_page/ins/'+institute_code);
	$.ajax({
	    url:base_url+"ajaxcounselling_controller/otp_choice_locking", 
	    type:"post",
	    success:function(response)
	    {  
	    	var res = JSON.parse(response); 
	    },
	    error:function()
	    {
	     	toastr.error('We are unable to process please contact support'); 
	    }
    }); 
	$('#modalInstructionLocks').modal('show'); 
	//window.location.href=(base_url+'apply/choice_locking_page/ins/'+institute_code);
});
$('#btnSave').click(function(){
	var items = new Array();
	
	$("ol.target").children().each(function() {
		var item_name = $(this).contents().filter(function() {
			return this.nodeType === 3;
		}).text();
		//console.log(mnfctr);
		//var item = {manufacturer: mnfctr};
		items.push(item_name);
	});
	
	var jsonData = JSON.stringify(items);
	
	var count = $("#hidIBPChoices").val();
	
	if(count != items.length)
	{
		toastr.error("Please drag and drop all the specializations as per your preference from the left box to right box.");
	}
	else
	{
		var institutedata=
		{
			branches:items
		};	
		$.ajax({
			url:base_url+"ajaxcounselling_controller/save_branch_data",
			type:"post",
			data:institutedata,
			success:function(response){  
				var res = JSON.parse(response);
				if(res.status == true)
				{
					$.ajax({
					    url:base_url+"ajaxcounselling_controller/get_lock_statuses", 
					    type:"post",
					    success:function(response)
					    {  
					    	var res = JSON.parse(response); 
					    	$('#hidChoiceLockStatus').val(res.count);
					    	if($('#hidChoiceLockStatus').val() == '0' || (($('#hidChoiceLockStartDate').val() > $('#today').val()) ||( $('#hidChoiceLockEndDate').val() < $('#today').val()) ))
							{
								$('#btnLock').prop('disabled', true);
							}
							else
							{
								$('#btnLock').prop('disabled', false);
							} 
					    	
					    },
					    error:function()
					    {
					     	toastr.error('We are unable to process please contact support'); 
					    }
				    }); 
					if($('#hidChoiceLockStatus').val() == '0' || (($('#hidChoiceLockStartDate').val() > $('#today').val()) ||( $('#hidChoiceLockEndDate').val() < $('#today').val()) ))
					{
						$('#btnLock').prop('disabled', true);
					}
					else
					{
						$('#btnLock').prop('disabled', false);
					}
					toastr.success("Data Successfully Saved");
				}
				
			},
			error:function(){
				toastr.error("We are unable to Process.Please contact Support");
			}
		});
	}			
	
	
});

$('#otp_lock_submit').click(function(){
	var txtOTP = $('#otp_lock').val();
	var otpdata={
		txtOTP : txtOTP
	};
	$.ajax({
	    url:base_url+"ajaxcounselling_controller/otp_choice_locking_submit", 
	    type:"post",
	    data:otpdata,
	    success:function(response)
	    {  
	    	$('#otp_lock').val("");
	   		var res = JSON.parse(response); 
	   		if(res.status)
	    	{
				$.ajax({
					url:base_url+"ajaxcounselling_controller/lock_branch_data",
					type:"post",
					success:function(response){  
						var res = JSON.parse(response);
						if(res.status == true)
						{
							$('#btnPrint').prop('disabled', false);
							$('#btnLock').prop('disabled', true);
							$('#btnSave').prop('disabled', true);
							toastr.success("Data Successfully Saved");
							var x = document.getElementById("divLock");
							x.style.display = "block";
							var y = document.getElementById("divSave");
							y.style.display = "none";
							$.ajax({
								url:base_url+"ajaxcounselling_controller/get_saved_data",
								type:"post",
								success:function(response){  
									var res = JSON.parse(response);
									var string = "" + res.branch + "";
									var ipb = "" + res.ipb_code + "";
									var str_array = string.split(',');
									var ipb_array = ipb.split(',');
									//alert(ipb_array);
									var branch = '';
									//branch += "<li class='placeholder'>Drop your favourites here</li>";
									for(var i = 0; i < str_array.length; i++) {
									  	branch += "<li id="+ipb_array[i]+">"+str_array[i]+"</li>";
									}
									$('#branchSavedData').html(branch);
									/*$(".source, .target").sortable({
								      connectWith: ".connected"
								    });*/
									if(res.status == true)
									{
										toastr.success("Data Successfully Saved");
									}
									
								},
								error:function(){
									toastr.error("We are unable to Process.Please contact Support");
								}
							});
						}
						
					},
					error:function(){
						toastr.error("We are unable to Process.Please contact Support");
					}
				});
			}
			else
			{
				$('#otp_lock').val("");
				toastr.error('You have entered incorrect OTP'); 
			}
				
	    	
			
	    },
	    error:function()
	    {
	     	toastr.error('We are unable to process please contact support'); 
	    }
    }); 
	
});

</script>