<!-- Modal -->
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title text-capitalize"><?=$modal_title;?></h4>
</div>
<div class="modal-body">
	<?=$this->load->view($modal_content, $parameters);?>
</div>
<div class="modal-footer">
	<button data-dismiss="modal" class="btn btn-outline btn-flat pull-left" type="button">Close</button>	
	<a 		
		data-bind="
		css: { 'has-spinner active' : $root.ajaxProcess },
		click: function(data, event){
			$(event.currentTarget).closest('.modal-content').find('.modal-body form').trigger('submit');
			
		}"	
	class="btn btn-outline btn-flat"
	>
		<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
		Save
	</a>
</div>
<script>		
	var moda_container = $('#modal-widget-options').get(0) ;	
	ko.applyBindings(WidgetOptions, moda_container);	
</script>
