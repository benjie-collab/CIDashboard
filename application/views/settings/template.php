<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/nav'); ?>
<?php $this->load->view('template/aside'); ?>
 <div class="content-wrapper">	
	<?php $this->load->view($main_content); ?>
</div>
<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/footer_scripts'); ?>