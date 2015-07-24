<?php 
/*
* @Title: Full Page
* @Method: full-page
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
<section class="content">	
	<div class="row">		
		<div class="col-md-12">
			<div class="p-relative" >-->
				<?php $id="page_content"; ?>
				<div id="<?=$id?>" class="m-0 <?=$mode? 'connected-widgets widget widget-full-page':''?>" 
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
				</div>	<!--				
			</div>
		</div>
	</div>
</section>-->




