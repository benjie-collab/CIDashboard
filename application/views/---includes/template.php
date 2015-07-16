<?php $this->load->view('includes/header'); ?>
<div class="row">
	<div class="col-md-3">
	<?php $this->load->view($sidebar); ?>
	</div>
	<div class="col-md-9">
	<?php $this->load->view($main_content); ?>
	</div>
</div>


<?php $this->load->view('includes/footer'); ?>