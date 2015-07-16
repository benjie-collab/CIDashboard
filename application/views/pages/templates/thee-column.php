<?php 
/*
* @Title: Three Column
* @Method: three-column
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
		
		<div class="col-md-6">
			<div class="p-relative" >
				<?php $id="page_content"; ?>
				<div id="<?=$id?>" class="<?=$mode? 'connected-widgets widget':''?> widget-md" 
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
			
			<div class="p-relative" >
				<?php $id="page_content_widget"; ?>
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




