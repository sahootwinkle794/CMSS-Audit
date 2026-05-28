<?php
		if(isset($_REQUEST['p']))
		{
			include ($_REQUEST['p'].'.php');
		}
		else
		{
			include('home.php');
		}
?>