<!-- Content Header (Page header) -->
<section class="content-header">
  <h1 class="page-header"><?php echo lang('pages_heading');?>
	<small><?php echo lang('pages_subheading');?></small>
  </h1>
  <?=$this->template_model->get_breadcrumb()?>
</section>

<!-- Main content -->
<section class="content">
  <div id="infoMessage"><?php echo $message;?></div>
</section><!-- /.content -->