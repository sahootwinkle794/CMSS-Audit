<?php 
$base = base_url();
//print_r($right_menu);die();
 ?>
<section class="top-head">
<section style=" position: relative;">
	<div class="container-fluid widthrow">
		<div class="row">
			<div class="hidden-xs col-sm-3 col-md-3 col-lg-3 col-xl-3">
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="padding-right: 5px;padding-left: 5px;">
				<div class="panel panel-default " style="border-color: #fff;box-shadow: 0px 0px 5px 2px #dadadacf;margin-top: 7px;">
					<div class="panel-heading news">
						<h3 class="panel-title" style="color: #fff;cursor: pointer;font-size: 24px">
							Notice
						</h3>
					</div>
					<div class=" row article-div notice-text" style="min-height: 500px;margin-top: 1%;overflow: auto;">								
						<table  align="center" cellpadding="4" cellspacing="0" border="1" class="table table-bordered table-striped table-responsive">
					  		<thead style="background-color: #dcb68769">
					                 <td width="10%">SL NO.</td>
					                 <td width="45%">CONTENT</td>
					                 <td  width="20%">PUBLISH DATE</td>
					                <td width="25%">DOWNLOAD</td>
					                  
					        </thead>
					         <?php 
					         $sl_no = 1;
								foreach($news_details as $row)
								{   $created_date = $row['created_on'];
									echo " 
										<tr  class=body-txt' >  
										<td style='text-transform: uppercase;text-align: center;'>".$sl_no."</td>
										<td style='text-transform: uppercase;text-align: left;'>".$row['news_details']."</td>
										<td style='text-transform: uppercase;text-align: center;'>".$created_date."</td>
										<td style= 'text-align: center;'> <span style='background: #2A1D17; padding: 5px;'><img src='$base/upload/image/pdficon.png' style='width: 16px; height: 16px;'>&nbsp; 
										<a target='_blank' href=".$row['link_path']." style='text-decoration: none; color: #fff;'>Download</a>
                             			</span></td></tr > "; 
                             			$sl_no++;
								}
								 
							?> 
						</table> 
					</div>
				</div> 
			</div>
		</div>
	</div>
</section>
</section>