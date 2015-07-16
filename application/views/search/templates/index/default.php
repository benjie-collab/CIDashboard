<?php 
/*
* @Title: Default
* @Method: Search
* @icon: fa-search
*/ 
?>
<?php 
	$loading_state 		= str_replace('"','\'',$this->template_model->get_box_loading_state()) ;
	$mode 	  			= $this->application->get_mode('search_mode');
	$delimiter 			= $this->application->get_config('metakey_delimiter', 'template');
	$form_to_submit 	= '#search_settings_form';	
	$settings 			= $this->application->get_settings('search_page_settings');
?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="p-relative" >
			<?php $id= 'widget_top_bar'; ?>
				<div id="<?=$id?>" 
					class="<?=$mode? 'connected-widgets widget':''?>" 
					data-form="<?=$form_to_submit?>">
				<?php 
					if(element($id, $settings)):
						foreach(element($id, $settings) as $key=>$meta_key):		
							$data['meta_key'] = $meta_key;
							$this->load->view('widgets/template', $data);		
						endforeach;					
					endif;					
					if ($mode)
					echo $loading_state;
				?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="p-relative" >
			<?php $id= 'widget_left_sidebar'; ?>
				<div id="<?=$id?>" 
					class="<?=$mode? 'connected-widgets widget':''?> widget-lg" 
					data-form="<?=$form_to_submit?>">
				<?php 
					if(element($id, $settings)):
						foreach(element($id, $settings) as $key=>$meta_key):		
							$data['meta_key'] = $meta_key;
							//echo '<div class="removable-widget" data-widget="'. $meta_key .'">';
							//$this->load->view('widgets/'. extract_metakey($meta_key, $delimiter) . '/view', $data);									
							//echo '</div>';	
							$this->load->view('widgets/template', $data);		
						endforeach;					
					endif;
					
					if ($mode)
					echo $loading_state;
				?>
				</div>
			</div>
		</div>
		<div class="col-md-6">
					
			<div class="p-relative" >
			<?php $id= 'widget_content'; ?>
				<div id="<?=$id?>" 
					class="<?=$mode? 'connected-widgets widget':''?> widget-xl" 
					data-form="<?=$form_to_submit?>">
				<?php 
					if(element($id, $settings)):
						foreach(element($id, $settings) as $key=>$meta_key):		
							$data['meta_key'] = $meta_key;
							//echo '<div class="removable-widget" data-widget="'. $meta_key .'">';
							//$this->load->view('widgets/'. extract_metakey($meta_key, $delimiter) . '/view', $data);									
							//echo '</div>';	
							$this->load->view('widgets/template', $data);		
						endforeach;					
					endif;
					
					if ($mode)
					echo $loading_state;
				?>
				</div>
			</div>
			
		</div>
		
		<div class="col-md-3">
		
		
			<div class="p-relative" >
			<?php $id= 'widget_right_sidebar'; ?>
				<div id="<?=$id?>" 
					class="<?=$mode? 'connected-widgets widget':''?> widget-lg" 
					data-form="<?=$form_to_submit?>">
				<?php 
					if(element($id, $settings)):
						foreach(element($id, $settings) as $key=>$meta_key):		
							$data['meta_key'] = $meta_key;
							//echo '<div class="removable-widget" data-widget="'. $meta_key .'">';
							//$this->load->view('widgets/'. extract_metakey($meta_key, $delimiter) . '/view', $data);									
							//echo '</div>';	
							$this->load->view('widgets/template', $data);		
						endforeach;					
					endif;
					
					if ($mode)
					echo $loading_state;
				?>
				</div>
			</div>		
		</div>
	</div>
</section>