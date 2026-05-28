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
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="min-height: 1340px; height: auto;">
    	 <ul class="sidebar-menu" data-widget="tree">
<?php
foreach($sidebar as $obj){
	$dbmenuid = $obj['menu_id'];
	$dblinktext = $obj['link_text'];
	$dblinkurl = $obj['link_url'];
	$dbparentid = $obj['parent_id'];
	$dbslno = $obj['sl_no'];
	$dbhaschild = $obj['has_child'];
	$dbislastchild = $obj['is_last_child'];
	$dbiconclass = $obj['icon_class'];
	//$role = $obj['role'];
	$state = $group == $dblinktext ? "groupactive active" : "";
	$menuitemstate = ($menuitem == $dblinktext ? " class=\"active\" " : "");
	
	
	if($dbparentid == 0 && $dbhaschild) //Parent having child
	{	
			
			echo "<li class=\"treeview $state\">			
                    <a href=".site_url($dblinkurl)."><i class=\"$dbiconclass\"></i> <span>$dblinktext</span>
                    	<span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></span>
                    </a>
                        <ul class=\"treeview-menu\">";	
	}
	
	else if($dbparentid == 0 && !$dbhaschild) //Parent having No child
	{
		
		if($dblinktext == 'ANALYTICAL REPORT'){
			echo "<li $menuitemstate>
                    <a href=".$dblinkurl." target='_blank'><i class=\"$dbiconclass\"></i> <span>$dblinktext</span></a>
          </li>";
		}
		else{
			echo "<li $menuitemstate>
                    <a href=".site_url($dblinkurl)."><i class=\"$dbiconclass\"></i> <span>$dblinktext</span></a>
          </li>";
          
		}
			
	}
	else if ($dbparentid !=0 && !$dbislastchild)
	{
		echo "<li $menuitemstate>
				<a href=".site_url($dblinkurl)."><i class=\"$dbiconclass\"></i> <span>$dblinktext</span></a>
			  </li>";
	}
	else if ($dbparentid !=0 && $dbislastchild)
	{
		
		echo "<li $menuitemstate>
			<a href=".site_url($dblinkurl)."><i class=\"$dbiconclass\"></i> <span>$dblinktext</span></a>
		  </li>
		  </ul>";
			
		
	}
	 
}
?>	
	</ul>
    </section>
    <!-- /.sidebar -->
</aside>