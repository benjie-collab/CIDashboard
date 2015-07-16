<?php 
/*
* @Title: Default
* @Method: Document
* @icon: fa-search
*/ 
?>

<?php 
	$loading_state 		= str_replace('"','\'',$this->template_model->get_box_loading_state()) ;
	$form_to_submit 	= '#document_settings_form';	
	$mode 	  			= $this->application->get_mode('search_mode');
	$delimiter 			= $this->application->get_config('metakey_delimiter', 'template');
	$settings 			= $this->search_model->get_options('document_page_settings');
?>

<section class="content">
	<div class="row">
		<div class="col-md-8">
			<div class="p-relative" >
				<?php $id="widget_content"; ?>
				<div id="<?=$id?>" 
					class="<?=$mode? 'connected-widgets widget':''?> widget-xl" 
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
		<div class="col-md-4">
			<div class="p-relative" >
				<?php $id="widget_right_sidebar"; ?>
				<div id="<?=$id?>" 
					class="<?=$mode? 'connected-widgets widget':''?> widget-xl" 
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
</section>