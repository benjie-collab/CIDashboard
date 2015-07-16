<?php 
/*
* @Title: Default
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
<section class="content">	
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
								$data = array();
								$data['meta_key'] = $meta_key;
								$this->load->view('widgets/template-pages', $data);	
							endforeach;					
						endif;	
					?>	
					<?php
					if ($mode)
					echo $loading_state;
					?>
				</div>					
			</div>
		</div>
		
		
		<div class="col-md-3">
			<div class="p-relative" >
				<?php $id="page_widget_left"; ?>
				<div id="<?=$id?>" class="<?=$mode? 'connected-widgets widget':''?> widget-xl" 
					data-widget="<?=htmlspecialchars(json_encode(element($id, $page)? element($id, $page) : array()), ENT_QUOTES, 'UTF-8')?>"
					data-form="<?=$form_to_submit?>">	
					<?php 
						if(element($id, $page)):
							foreach(element($id, $page) as $key=>$meta_key):	
								$data['meta_key'] = $meta_key;
								$this->load->view('widgets/template-pages', $data);	
							endforeach;					
						endif;	
					?>	
					<?php
					if ($mode)
					echo $loading_state;
					?>
				</div>					
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="p-relative" >
				<?php $id="page_content_top"; ?>
				<div id="<?=$id?>" class="<?=$mode? 'connected-widgets widget':''?> widget-xs" 
					data-widget="<?=htmlspecialchars(json_encode(element($id, $page)? element($id, $page) : array()), ENT_QUOTES, 'UTF-8')?>"
					data-form="<?=$form_to_submit?>">	
					<?php 
						if(element($id, $page)):
							foreach(element($id, $page) as $key=>$meta_key):	
								$data = array();
								$data['meta_key'] = $meta_key;
								$data['event'] 	= '';
								$this->load->view('widgets/template-pages', $data);	
							endforeach;					
						endif;	
					?>	
					<?php
					if ($mode)
					echo $loading_state;
					?>
				</div>	
			</div>
			<div class="p-relative" >
				<?php $id="page_content";?>
				<div class="widget-sm <?=$mode? 'droppable-widgets widget': ''?> widget-md"
				data-widget="<?=htmlspecialchars(json_encode(element($id, $page)? element($id, $page) : array()), ENT_QUOTES, 'UTF-8')?>"
				data-form="<?=$form_to_submit?>"
				id="<?=$id?>">			
					<?php 
						if(element($id, $page)):
					?>
					
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<?php 
								foreach(element($id, $page) as $key=>$meta_key): 
								$widget_key = extract_metakey($meta_key, $delimiter);
								$options = $this->application->get_settings($meta_key);
								
								$title		= '';
								if($options){
									$title   = element('title', $options);
								}else{					
									$options 	= $this->application->get_widget($widget_key);	
									if($options){
										$title   = element('title', $options);
									}else{
									$title		= $title? $title : 'Tab '. $key;
									}
								}
								
								?>
								<li class=" <?=$key==0?'active':''?>">
									<a data-toggle="tab" title="<?=$title?>" href="#page_tabbed_content_<?=$key?>" aria-expanded="true">
										<i class="fa <?=element('icon', $options)? element('icon', $options) : 'fa fa-list'?>"></i>
										<?= string_limit($title,25) ?>
									</a>
								</li>
							<?php
								endforeach;
							?>
												 
						</ul>
						<div class="tab-content p-0">	

							<?php 
								foreach(element($id, $page) as $key=>$meta_key):	
									$data = array();
									$data['meta_key'] = $meta_key;
									$data['event'] 	= 'tab';
									echo '<div id="page_tabbed_content_' . $key. '" class="tab-pane ' . ($key==0?'active':'') . '">';
									$this->load->view('widgets/template-pages', $data);
									echo '</div>';																		
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
			
			<div class="p-relative" >
				<?php $id="page_content_bottom"; ?>
				<div id="<?=$id?>" class="<?=$mode? 'connected-widgets widget':''?> widget-xs" 
					data-widget="<?=htmlspecialchars(json_encode(element($id, $page)? element($id, $page) : array()), ENT_QUOTES, 'UTF-8')?>"
					data-form="<?=$form_to_submit?>">	
					<?php 
						if(element($id, $page)):
							foreach(element($id, $page) as $key=>$meta_key):	
								$data = array();
								$data['meta_key'] = $meta_key;
								$data['event'] 	= '';
								$this->load->view('widgets/template-pages', $data);	
							endforeach;					
						endif;	
					?>	
					<?php
					if ($mode)
					echo $loading_state;
					?>
				</div>	
			</div>
			
		</div>
		
		<div class="col-md-3">
			<div class="p-relative" >
				<?php $id="page_widget_right"; ?>
				<div id="<?=$id?>" class="<?=$mode? 'connected-widgets widget':''?> widget-xl" 
					data-widget="<?=htmlspecialchars(json_encode(element($id, $page)? element($id, $page) : array()), ENT_QUOTES, 'UTF-8')?>"
					data-form="<?=$form_to_submit?>">	
					<?php 
						if(element($id, $page)):
							foreach(element($id, $page) as $key=>$meta_key):	
								$data = array();
								$data['meta_key'] = $meta_key;
								$data['event'] 	= '';
								$this->load->view('widgets/template-pages', $data);	
							endforeach;					
						endif;	
					?>	
					<?php
					if ($mode)
					echo $loading_state;
					?>
				</div>	
			</div>
		</div>
		
		
	</div>
</section>




