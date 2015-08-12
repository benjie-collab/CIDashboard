<a href="javascript:void(0)" 
	class="no-print floating-tools-button">
	<i class="fa-gear fa"></i>
</a>
<div class="no-print floating-tools-content">	
	<h4 style="border-bottom: 1px solid #ddd; " class="m-b-5 m-t-0 p-b-15 text-light-blue"><?php echo lang('statistics_heading');?></h4>
	<small><?php echo lang('statistics_subheading');?></small>
	
	<div data-bind="CustomScrollbar: { axis:'y', 
			theme:'minimal-dark', 
			scrollbarPosition: 'outside',
			autoExpandScrollbar: true}" class="max-height-320">
		  <ul class="nav nav-pills nav-stacked">
			
			<li class="<?=!$category? 'active': '' ?>"><a href="<?=base_url()?>statistics/index/" >
				<i class="fa fa-area-chart"></i> All 
				<span class="pull-right text-info"><i class="fa fa-sign-in"></i></span></a>
			</li>
			<?php 
				$widgets = $this->application->get_widgets('statistics');
				foreach($widgets as $key=>$widget):				
			?>
				<li class="<?=strcasecmp($category, element('@key', $widget))==0? 'active': '' ?>">
					<a href="<?=base_url()?>statistics/index/<?=$key?><?='?' . http_build_query($_GET)?>" 
						data-toggle="popover" 
						data-html='true' 
						data-placement="left"
						title="<i class='<?=element('@icon', $widget)?>'></i> <?=element('@title', $widget)?>"
						data-content="
						<div class='text-center'><p><small class='text-muted'><?=element('@description', $widget)?></small></p>						
						<a class='btn btn-xs bg-purple btn-flat margin' data-toggle='modal' data-remote='<?=base_url('/statistics/create/'. element('@key', $widget))?>'href='#modal-widget-options'>Add New</a>
						</div>"
					>
					<i class="<?=element('@icon', $widget)?>"></i> <?=element('@title', $widget)?> 
					<span class="pull-right text-info"><i class="fa fa-sign-in"></i></span></a>
				</li>
			<?php
				endforeach;
			?>			
		  </ul>	
	</div>	
</div>