<!-- Modal -->
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title text-capitalize"><?=$modal_title;?></h4>
</div>
<div class="modal-body">
	<?=$this->load->view($modal_content);?>
</div>
<div class="modal-footer">
	<button data-dismiss="modal" class="btn btn-default btn-flat pull-left" type="button">Close</button>
	<button data-bind="
		css: { 'has-spinner active' : ajaxProcess},
		click: function(data, event){
			console.log(event);
			$(event.currentTarget).closest('.modal-content').find('.modal-body form').trigger('submit');
			return false;
		}"	
	class="btn btn-primary btn-flat"
	>
		<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
		Save
	</button>
</div>
<!--
<script>
	
	<?php
		//$container 	= array_key_exists('container', $parameters) ? element('container', $parameters) : '#modal-widget-options';
		//$model   	= array_key_exists('komodel', $parameters) ? element('komodel', $parameters) : 'WidgetOptions';
	?>
	var modal_container = $('<?=$container?>').get(0) ;	
	ko.applyBindings(<?=$model?>, modal_container);	
</script>-->


