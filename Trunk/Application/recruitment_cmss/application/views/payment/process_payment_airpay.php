<?php
$today_date = date("Y-m-d");
$status = TRUE;
//echo $pg_action_url;die;
?>
<?php
if($status == true)
{
?>
<div >
<div class="container" style="margin-top: 150px; padding-bottom: 280px;text-align: center;">
	Processing... Please wait.Don't press back/refresh button.
</div>
<form action="<?php echo $pg_action_url;?>" name="frmPayment" method="post">
		<input type="hidden" name="privatekey" value="<?php echo $privatekey; ?>">
	    <input type="hidden" name="mercid" value="<?php echo $mercid; ?>">
		<input type="hidden" name="orderid" value="<?php echo $orderid; ?>">
		<input type="hidden" name="currency" value="356">
	    <input type="hidden" name="isocurrency" value="INR">
	    <input type="hidden" name="customvar" value="<?php echo $customvar; ?>">
		<input type="hidden" name="chmod" value="<?php echo $hiddenmod; ?>">					
		<?php
		$this->checksum->outputForm($checksum);
		?>
</form>
</div>
<script language="javascript">
function onLoadSubmit() {
	document.frmPayment.submit();
}onLoadSubmit();
</script>
<?php
}

else
{
?>
<div class="container" style=" padding-bottom: 50px;">
		<div class="row">
		
		
		
		
		
		
			<div class="col-lg-12" style="padding-top:0px;">
				<div class="panel panel-default">
						<div class="panel-heading project-heading" align="center" >
							<h2 class="panel-title project-title"><b><a href="#"><?php echo $admname; ?></a></b></h2>
						</div>
					
				</div>
				
				<h3 style="color: #ffbf6e;">Error</h3>
				<div class="col-lg-12" style="font-size: 14px; line-height: 200%;color: white;">
					<ul>
						<li>
							Please logout from all the tabs.
						</li>
						<li>
							Please Start doing payment in one login and then logout and then payment for other school.
						</li>
						<li>
							Payment will be done one at a time.
						</li>
					</ul>
				</div>
				
			
		
		</div><!--/row-->
	  
	</div><!--/container-->
<?php	
}