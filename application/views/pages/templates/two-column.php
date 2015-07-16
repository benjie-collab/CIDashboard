<?php 
/*
* @Title: Two Column- Right Sidebar
* @Method: Default
* @icon: fa-search
*/ 
?>

<?php 
	$loading_state 		= str_replace('"','\'',$this->template_model->get_box_loading_state()) ;
	$form_to_submit 	= '#page_settings_form';	
	$mode 	  			= $this->application->get_mode('pages_mode');
	$delimiter 			= $this->application->get_config('metakey_delimiter', 'template');
?>
<!--
<section class="content-header">
  <h1>
	<?=element('page_name', $page); ?>
  </h1>
</section>-->
<section class="content p-0">	
	<!--
	<p>
		<?=element('page_desc', $page); ?>
	</p>-->
	<div class="row">	
		<div class="col-md-12">
			<div class="p-relative" >
				<?php $id="page_widget_top"; ?>
				<div id="<?=$id?>" class="<?=$mode? 'connected-widgets widget':''?>" 
					data-widget="<?=htmlspecialchars(json_encode(element($id, $page)? element($id, $page) : array()), ENT_QUOTES, 'UTF-8')?>"
					data-form="<?=$form_to_submit?>">	
					<?php 
						if(element($id, $page)):
							foreach(element($id, $page) as $key=>$meta_key):	
								$widget_key = extract_metakey($meta_key, $delimiter);
								$options = $this->application->get_widget($widget_key);$data = array();
								
								if($options){
									$data['widget_key'] = $meta_key;
									echo '<div class="removable-widget" data-widget="'. $meta_key .'">';
									$this->load->view('widgets/'. $widget_key . '/view', $data);									
									echo '</div>';	
								}else{
									$keys = $this->statistics_lib->extract_statistics_key($widget_key);
									$data['keys'] = $keys;
									$data['widget_key'] = $widget_key;
									$data['meta_key'] = $meta_key;
									
									$data['widgetize'] = false;
									echo '<div class="removable-widget" data-widget="'. $meta_key .'">';
									$this->load->view('widgets/'. element('type', $keys) . '/view', $data);
									echo '</div>';		
								}												
							endforeach;					
						endif;	
					?>	
					<?php
					if ($mode)
					echo $loading_state;
					?>
					
				</a>
				</div>				
			</div>
		</div>
		
		
		<div class="col-md-8">
			<div class="p-relative" >
				<?php $id="page_tabbed_content";?>
				<div class="widget-sm <?=$mode? 'droppable-widgets widget': ''?>"
				data-widget="<?=htmlspecialchars(json_encode(element($id, $page)? element($id, $page) : array()), ENT_QUOTES, 'UTF-8')?>"
				data-form="<?=$form_to_submit?>"
				id="<?=$id?>">			
					<?php 
						if(element($id, $page)):
						
							
					?>
					
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs pull-right">
							<?php 
								foreach(element($id, $page) as $key=>$meta_key): 
								$widget_key = extract_metakey($meta_key, $delimiter);
								$options 	= $this->application->get_widget($widget_key);
								$title		= '';
								if($options){
									$title 	 = element('@title', $options);	
								}else{									
									$options = $this->application->get_settings($meta_key);
									$title   = element('name', $options);
								}
								$title		= $title? $title : 'Tab '. $key;
								?>
								<li class=" <?=$key==0?'active':''?>">
									<a data-toggle="tab" title="<?=$title?>" href="#page_tabbed_content_<?=$key?>" aria-expanded="true">
										<?= string_limit($title,10) ?>
									</a>
								</li>
							<?php
								endforeach;
							?>
												 
						</ul>
						<div class="tab-content">	

							<?php 
								foreach(element($id, $page) as $key=>$meta_key):	
									$widget_key = extract_metakey($meta_key, $delimiter);
									$options 	= $this->application->get_widget($widget_key);
									
									if($options){
										$data['widget_key'] = $meta_key;
										echo '<div id="page_tabbed_content_' . $key. '" class="removable-widget tab-pane ' . ($key==0?'active':'') . '" data-widget="'. $meta_key .'">';
										$this->load->view('widgets/'. $widget_key . '/view', $data);									
										echo '</div>';	
									}else{
										$keys = $this->statistics_lib->extract_statistics_key($widget_key);
										$data['keys'] = $keys;
										$data['widget_key'] = $widget_key;
										$data['meta_key'] = $meta_key;
										$data['event'] = 'tab';										
										$data['widgetize'] = false;
										echo '<div id="page_tabbed_content_' . $key. '" class="removable-widget tab-pane ' . ($key==0?'active':'') . '" data-widget="'. $meta_key .'">';
										$this->load->view('widgets/'. element('type', $keys) . '/view', $data);
										echo '</div>';		
									}												
								endforeach;	
							?>	
							
							
						</div>						
					</div>	
					<?php	
					endif;	
					?>	
					<?php
					if ($mode)
					echo $loading_state;
					?>	
				</div>
				<div class="drop-here-helper">
					<div class="p-relative">
						<span class="fa fa-arrow-circle-o-down"></span>
					</div>
				</div>							
			</div>	
		</div>
		
		<div class="col-md-4">
			<div class="p-relative" >
				<?php $id="page_widget_left"; ?>
				<div id="<?=$id?>" class="<?=$mode? 'connected-widgets widget':''?> widget-xl" 
					data-widget="<?=htmlspecialchars(json_encode(element($id, $page)? element($id, $page) : array()), ENT_QUOTES, 'UTF-8')?>"
					data-form="<?=$form_to_submit?>">	
					<?php 
						if(element($id, $page)):
							foreach(element($id, $page) as $key=>$meta_key):	
								$widget_key = extract_metakey($meta_key, $delimiter);
								$options = $this->application->get_widget($widget_key);$data = array();
								
								if($options){
									$data['widget_key'] = $meta_key;
									echo '<div class="removable-widget" data-widget="'. $meta_key .'">';
									$this->load->view('widgets/'. $widget_key . '/view', $data);									
									echo '</div>';	
								}else{
									$keys = $this->statistics_lib->extract_statistics_key($widget_key);
									$data['keys'] = $keys;
									$data['widget_key'] = $widget_key;
									$data['meta_key'] = $meta_key;
									
									$data['widgetize'] = false;
									echo '<div class="removable-widget" data-widget="'. $meta_key .'">';
									$this->load->view('widgets/'. element('type', $keys) . '/view', $data);
									echo '</div>';		
								}												
							endforeach;					
						endif;	
					?>	
					<?php
					if ($mode)
					echo $loading_state;
					?>
					
				</a>
				</div>				
			</div>
		</div>
		
		
		
	</div>
</section>




