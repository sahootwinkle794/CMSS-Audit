<?php if($this->session->flashdata('info')): ?>
<div class="alert alert-success">
	<!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
	<?php echo $this->session->flashdata('info'); ?>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('error')): ?>
<div class="alert alert-danger">
	<!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
	<?php echo $this->session->flashdata('error'); ?>
</div>
<?php endif; ?>