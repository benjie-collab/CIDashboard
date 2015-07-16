<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/nav'); ?>
<?php $this->load->view('template/aside'); ?>

<div class="content-wrapper">	
	<section class="content-header">
	  <h1>
		<?=$title?>
	  </h1>
	  <?=$this->application->breadcrumb()?>
	</section>
	<section class="content">		
		<?php $this->load->view($main_content); ?>
	</section>
</div>
<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/footer_scripts'); ?>
