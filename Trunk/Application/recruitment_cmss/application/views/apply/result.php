<?php

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<link href="<?php echo base_url(); ?>public/assets/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/css/bootstrapValidator.css" rel="stylesheet" type="text/css"/>
<title></title>
<meta name="" content="">
</head>
<body>
	<center>
	<div class="jumbotron" style="width: 50%; margin-top: 3%;">
		<div class = "well well-lg"><?php echo $result['html']; ?></div>
      	<button type="button" class="btn btn-default"data-dismiss="modal" onclick="self.close()" id="closeModal">CLOSE</button>
	</div>
    </center>
</body>
</html>
<script src="<?php echo base_url(); ?>public/template_lib/plugins/bootstrap/js/bootstrap.min.js"></script>
