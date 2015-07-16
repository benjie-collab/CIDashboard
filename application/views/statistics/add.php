<?php 

	$hidden = array(
				'widget_key' => $widget_key,
				'tooltip[enabled]' => 0,
				'legend[visible]' => 0
			);
	$atts = array(
			'class' => 'form',
			'data-bind' => 'submit: $root.formSubmit', 
			'method' => 'POST',
			'onSubmit' => 'return false;',
			'id' => 'widget_add_form'
	);		 	
	echo form_open('/statistics/update_statistics_settings', $atts, $hidden);	
	
$categories 	=  $this->statistics_model->get_categories();
$type 			= $this->uri->segment(3)? $this->uri->segment(3) : '';
$description 	= '';
?>
	<!-- Modal -->
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title text-capitalize"><?=$modal_title;?></h4>
	</div>
	<div class="modal-body">
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
	<div class="modal-footer">
		<button data-dismiss="modal" class="btn btn-default btn-flat pull-left" type="button">Close</button>
		<button data-bind="
			css: { 'has-spinner active' : $root.ajaxProcess},
			click: function(data, event){
				console.log(event);
				$(event.currentTarget).closest('.modal-content').find('.modal-body form').trigger('submit');
				return false;
			}"	
		class="btn btn-primary btn-flat"
		>
			<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
			Save Changes
		</button>
	</div>
	<script>
		var modal_container = $('#modal-add-widget').get(0) ;	
		ko.applyBindings(VMSearchWidgetOptions, modal_container);	
	</script>

<?=form_close()?>		


