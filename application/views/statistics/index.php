<section class="content-header">
  <h1>
	<?php echo lang('statistics_heading');?>
	<small><?php echo lang('statistics_subheading');?></small>
  </h1>
  <?=$this->application->breadcrumb()?>
</section>
 <section class="content">

	<?php 
		$statistics = $this->statistics_model->get_statistics(
			array_merge(
				$parameters, 
				array('category' => $category)
			)
		);	
	?>
	<div class="row">
	<?php 	
		foreach($statistics as $stat):
		$widget['meta_key'] = element('widget_key', $stat);
	?>	
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">				
			<?php $this->load->view('/widgets/template-pages', $widget) ?>
		</div>			
	<?php		
		endforeach;	
	?>			
	</div>
</section>	
