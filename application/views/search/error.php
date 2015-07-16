<section class="content-header">
  <h1>
	Search
	<small></small>
  </h1>
 <?=$this->template_model->get_breadcrumb()?>
</section>
<section class="content">
  <div class="error-page">
	<h2 class="headline text-red">500</h2>
	<div class="error-content">
	  <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>
	  <p>
		<?=(!$message)? '':  $message;?>
	  </p>
	</div>
  </div><!-- /.error-page -->

</section>