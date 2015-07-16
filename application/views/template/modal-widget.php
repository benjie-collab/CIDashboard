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
</div>