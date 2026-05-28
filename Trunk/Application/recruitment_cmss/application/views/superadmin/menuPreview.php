<style>
	.sidebar-mini:not(.sidebar-mini-expand-feature).sidebar-collapse .sidebar-menu > li:hover > .treeview-menu{
		
		width: 250px !important;
	}
	@media (min-width: 768px)
		.sidebar-mini:not(.sidebar-mini-expand-feature).sidebar-collapse .sidebar-menu > li:hover > a > .pull-right-container {
		    position: relative !important;
		    float: right;
		    width: auto !important;
		    left: 252px !important;
		    top: -22px !important;
		    z-index: 900;
		}
		.sidebar-mini:not(.sidebar-mini-expand-feature).sidebar-collapse .sidebar-menu > li:hover > a > span:not(.pull-right) {
			
			width:250px;
		}
	}
	
	 
</style>


    <aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="min-height: 1340px; height: auto;">
    	 <ul class="sidebar-menu" data-widget="tree">
	<?php
	/*global $group;
	global $menuitem;*/
	$dbrolename = '';
	$dbrolename = $preview[0]['role_name'];
	//print_r($preview[0]['role_name']);die();
	foreach($preview as $obj)
	{
		$dbmenuid = $obj['menu_id'];
		$dblinktext = $obj['link_text'];
		$dblinkurl = $obj['link_url'];
		$dbparentid = $obj['parent_id'];
		$dbslno = $obj['sl_no'];
		$dbhaschild = $obj['has_child'];
		$dbislastchild = $obj['is_last_child'];
		$dbiconclass = $obj['icon_class'];
		$dbrolename = $obj['role_name'];
		
		if($dbparentid == 0 && $dbhaschild) //Parent having child
		{	
				echo "<li class=\"active\">			
	                    <a href=\"#\"><i class=\"$dbiconclass\"></i> $dblinktext<span class=\"fa arrow\"></span></a>
	                        <ul class=\"nav nav-second-level\">";	
		}
		else if($dbparentid == 0 && !$dbhaschild) //Parent having No child
		{
				echo "<li>
	                        <a href=\"#\"><i class=\"$dbiconclass\"></i> $dblinktext<span class=\"fa arrow\"></span></a>
	              </li>";
		}
		else if ($dbparentid !=0 && !$dbislastchild)
		{
			echo "<li>
					<a href=\"#\"><i class=\"$dbiconclass\"></i> $dblinktext</a>
				  </li>";
		}
		else if ($dbparentid !=0 && $dbislastchild)
		{
			echo "<li>
					<a href=\"#\"><i class=\"$dbiconclass\"></i> $dblinktext</a>
				  </li>
				  </ul>";
		}
	}
	/*while($obj=mysqli_fetch_object($execution))
	{

		
	}*/
	?>	
				
	<!-- /.sidebar-collapse -->
<?php 
	
	if($dbrolename != '')
	{
?>			</ul>
	    </section>
	    <!-- /.sidebar -->
	</aside>
	
				<!-- /.navbar-static-side -->
				<!--<div id="content-wrapper">
					<div class="row">
						<div class="col-lg-12">
							<h3 class="page-header">Menu of <?php echo $dbrolename; ?></h3>
						</div>
					</div>
				</div>--><!-- /#page-wrapper -->
				
<?php			
	}
?>
	
    
</div>