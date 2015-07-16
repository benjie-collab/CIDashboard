<?php 
$categories 	=  $this->statistics_model->get_categories();
$type 			= $this->uri->segment(3)? $this->uri->segment(3) : '';
$description 	= '';
?>
	<section class="content-header">
	  <h1>
		<?php echo lang('statistics_heading');?>
		<small><?php echo lang('statistics_subheading');?></small>
	  </h1>
	  <?=$this->template_model->get_breadcrumb()?>
	</section>
	 <section class="content">	
		<div class="small-box bg-gray active">
			<div class="inner">
			  <h3>150</h3>
			  <p>New Orders</p>
			</div>
			<div class="icon">
			  <i class="ion ion-bag"></i>
			</div>
			<a class="small-box-footer" href="#">More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>

		<div class="row">
			<div class="col-sm-3">				
				<div class="k2a-tab-menu scrollable-shadow " data-bind="NiceScroll: {height: 550}">
				  <div class="list-group m-r-20" >
					<?php 
						foreach($categories as $key=>$cat):
						$active = strcasecmp($type,$key)===0? 'active' : '';
						
						if(strcasecmp($type,$key)===0){
							$type = $key;
							$description = lang('statistics_description_'.strtolower($key));
						}
					?>
						<a href="<?=base_url()?>statistics/select/<?=$key?>" class="list-group-item text-center <?=$active?>">
						  <h1 class="<?=$cat['icon']?>"></h1><br/> <?=$cat['name']?>
						</a>
					<?php
						endforeach;			
					?>			
				  </div>
				</div>	
			</div>
			<div class="col-sm-9">	
				<?php if($type){?>
				<div class="row">
					<div class="col-sm-8 text-center">				
						<div class="widget widget-xl" 
							data-bind="DX<?=$type?>: { 
								ajax : '<?=base_url('statistics/get_config')?>', 
								meta_key: '<?=$type?>'
							}"></div>
						<span class="btn btn-warning btn-block" disabled>Preview</span>
					</div>
					<div class="col-sm-4">
						<h4>Description:</h4>
						<p class="text-muted"><?=$description?></p>
						<p class="text-center">
						
						<?php 
							$atts = array(
									'class' => '',
									'method' => 'POST'
							);
							
							$hidden 		= array('category' => $type);					
						?>
						<?php echo form_open( 'statistics/create/', $atts, $hidden ); ?>				
							<button type="submit" class="btn btn-lg btn-success">Create and Configure <i class="fa fa-cog"></i></button>
						<?php echo form_close(); ?>	
						</p>
					</div>
				</div>
				<?php } ?>
				
			</div>
		</div>

	</section>




