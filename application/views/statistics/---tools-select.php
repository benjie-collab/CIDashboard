<?php 
	$categories = $this->application->get_config('categories','statistics');
	$category = $this->uri->segment(3)? $this->uri->segment(3) : '';
	$mode 				= $this->application->get_mode('statistics_mode');	
	$is_admin 			= $this->users->is_admin();	
	
	
?>

<div id="floating-tool" 
	class="no-print  floating-tools-button">
	<i class="fa fa-gear"></i>
</div>
<div id="floating-tool-content" class="no-print floating-tools-content" data-bind="">
 
	<h4 style="border-bottom: 1px solid #ddd; " class="m-b-5 m-t-0 p-b-15 text-light-blue"><?php echo lang('statistics_heading');?></h4>
	<small><?php echo lang('statistics_subheading');?></small>
	
	<div class="m-t-10" data-bind="SlimScroll: { height: 450, width: '100%'}">
		  <ul class="nav nav-pills nav-stacked">
			<?php 
				foreach($categories as $key=>$cat):
			?>
				<li class="<?=strcasecmp($category, $key)==0? 'active': '' ?>"><a href="<?=base_url()?>statistics/select/<?=$key?>" >
					<i class="<?=$cat['icon']?>"></i> <?=$cat['name']?> 
					</a>
				</li>
			<?php
				endforeach;
			?>				
		  </ul>	
	</div>
</div>

<div class="modal fade modal-success" id="modal-widget-options">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
			<div class="text-center has-spinner active">
				<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>
			</div>
			</div>			
		</div>
	</div>
</div>