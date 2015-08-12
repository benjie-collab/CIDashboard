<?php 
/*
* @Title: PLGN Parametric
* @Method: Pages 
* @icon: fa-sliders
* @Description: Static parametric from Categorization Builder
*/ 
?>
<?php 	
/** 
	Received Parameters:
	$widget_key
	$meta_key
	$query_settings
**/

	$options 	= $this->application->get_settings($meta_key);	
	$data_options= array_get_value($options, 'data');
	$page= $this->session->userdata('current_page');	
	$parametrics = $this->categorization_model->get_categorizations();	
?>

	<div class="box box-solid plgn_parametric">
		<div class="box-header with-border">
			<h4 class="box-title">		
				<i class="fa <?=element('icon', $options)?>"></i>
				<?=element('title', $options)?>
			</h4>
			<div class="box-tools pull-right">				
				<?php 
				echo '<select class="form-control parametric_dp selectpicker show-menu-arrow" data-style="btn-flat btn-sm btn-inverse" data-width="auto">';
				echo '<optgroup label="Static">';
				foreach($parametrics as  $pm):					
					echo '<option value="' . $pm['id'] . '">' . ellipsize($pm['name'], 12, .5)  . '</option>';
				endforeach;
				echo '</optgroup>';
				echo '<optgroup label="Dynamic">';
				foreach($parametrics as  $pm):					
					echo '<option value="' . $pm['id'] . '">' . ellipsize($pm['name'], 12, .5)  . '</option>';
				endforeach;
				echo '</optgroup>';
				echo '</select>';
				?>
			</div>	
		</div>
		<div class="box-body">
			<div class="parametric_view"></div>
		</div>
		<div class="box-footer clearfix">
			
	
		</div>
	</div>

