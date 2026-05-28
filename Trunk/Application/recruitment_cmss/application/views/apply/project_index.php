<?php
	date_default_timezone_set('Asia/Kolkata');
    $now = date('Y-m-d h:i:s', now());
	foreach($program_data as $row)
	{
		$admcode = $row['program_code'];
		$seladmcode = $row['program_code'];
		$admname = $row['program_name'];
		$app_start_date = $row['apply_start_date'];
		$app_end_date = $row['apply_end_date'];
		//echo $app_start_date."-----------";
		//echo $app_end_date;
		$app_start_date = strtotime($app_start_date);
		$app_end_date = strtotime($app_end_date);
		//$now = date("d-m-Y, h:i A",$now);
		$apply_date1 = date("d-m-Y, h:i A",$app_start_date);
		$apply_date2 = date("d-m-Y, h:i A",$app_end_date);
	    if($app_start_date > $now)
		{
			$time_to_apply = "Start date is:$apply_date1";
		}
		else if($app_start_date <= $now)
		{
			$time_to_apply = "Last date is: $apply_date2";
		}
	}
	foreach($institute_data as $row)
	{
		$institute_code = $row['institute_code'];
		$institute_name = $row['institute_name'];
		$ins = encrypt_decrypt('encrypt',$institute_code);
	}
	/*foreach($program_admit_card_count as $row)
	{
		$adm_count = $row['adm_cnt'];
	}*/
	/*$admit_card_count = 1;
	if($adm_count >= 1)
	{
		$admit_card_count = 2;
	}
	else
	{
		$admit_card_count = 3;
	}*/
	
?>
<link href="<?=base_url()?>public/assets/css/extra-style.css" rel="stylesheet" />
	<style>
		.disabled {
		   pointer-events: none;
		   cursor: default;
		}
	</style>
<div class="container" style="margin-top: 90px; padding-bottom: 50px;">
		<div class="row">
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">
					<div class="panel-heading project-heading" align="center">
						<h2 class="panel-title" style="font-size: 20px"><b><a href="<?=base_url()?>apply/project_index/program/<?=$admcode?>/ins/<?=$ins?>"><?php echo $admname; ?></a></b></h2>
					</div>
				</div>	
			</div>		
		</div>	
	   <input type="hidden" name="hidPageCode" id="hidPageCode" value="PROGRAM"/>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-heading step-heading">

							<b>Steps for Application</b>

					<a href="#" class="pull-right" style="margin-top: -1.3%;margin-right: 0.2%" id="btnInstruction" name="btnInstruction" title="Help"><img type="button" src="<?=base_url()?>public/assets/images/helpicon.png" name="btnInstruction" title="Help" id="btnInstruction" style="width:50px;height:50px;cursor:pointer"></img></a>
					
					</div>	
					<div class="panel-body">
						  <form class="form-horizontal" method="post" role="form" id="frmApply3" name="frmApply3" enctype="multipart/form-data" >
							<?php if($seladmcode!='') { ?>
								<div class="form-group">
									<div class="col-sm-3 col-sm-offset-1" style="margin-top: 4%">
										<img src="<?=base_url()?>public/assets/images/online-admission.jpg" height="200" width="250" />
									</div>
									<div class="col-sm-5 col-sm-offset-1 ">
											<br>
											<ul class="menu">
<?php
$now1 = strtotime($now);
foreach($program_menu_data as $row1)
{
	$link_url = "";
	$link_url = $row1['link_url'];
	//echo $link_url;
	$arr_link_info = explode("?",$link_url);
	if(count($arr_link_info) > 1)
	{
		$link = base_url().$link_url."/ins/".$ins;
	}
	else
	{
		$link = base_url().$link_url."/ins/".$ins;
	}

	//echo $app_start_date;
	//echo $app_end_date;
	
?>

<li class="box "><a  <?php if(($now1 < $app_start_date || $app_end_date <= $now1) && $row1['menu_code']=='APPL' ){?> class="disabled" href="#" <?php } ?> <?php if($row1['menu_code']=='INS' || $row1['menu_code']=='ADV' || $row1['menu_code']=='BROC' || $row1['menu_code']=='SUPSAMP') { echo 'target="_blank"'; } if($row1['menu_code']=='ADMITCRD'  ) { ?> href="#"  class="btnAdmit" <?php } ?> href="<?=$link?>" ><?php echo $row1['link_text']; ?></a>
<span style="color: red">
<?php 
/*if($row1['menu_code']=='APPL'){
	if($time_to_apply !='')
	{
		echo "(".$time_to_apply.")";
	}
}*/
?></span></li>
<?php 
	} ?>
											</ul>

									</div>
									
								</div> 
								 
							<?php } ?>
							
						 </form>
						</div>
					</div><!--Panel Body-->
				</div><!--Panel Default-->
				<marquee style="color: red;">For best view, Please use Google Chrome or Mozilla Firefox.</marquee>
				
			</div><!--/col-lg-12-->

		</div><!-- row -->
	</div><!-- container -->
	<div class="modal fade" id="modalInstruction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header" style="background-color: #496cad;color: white;">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" style="color: white;" id="myModalLabel">Help</h4>
	      </div>
	      <div class="modal-body" id="divInstruction">
	     
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	<script src="<?php echo base_url(); ?>public/template_lib/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
	 <script>
    $('a').click(function(e) {
        if (e.ctrlKey) {
            e.preventDefault();
        }
    });
    $("a").on("contextmenu",function(){
       return false;
    });
	$('.disabled').click(function(e){
    	e.preventDefault();
  	})
     </script>