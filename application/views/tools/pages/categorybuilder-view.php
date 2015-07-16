<?php 
	$cat_settings   = unserialize(element('cat_settings', $categorization));	
	$cat_settings	= $cat_settings && is_json($cat_settings)? $cat_settings
						: json_encode(array('url' => base_url('data/category-builder-template.js')), JSON_UNESCAPED_SLASHES);
	$cat_settings 	= htmlspecialchars($cat_settings, ENT_QUOTES, 'UTF-8');	
?>
<div class="row">
	<div class="col-md-9">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">
				<i class="fa fa-long-arrow-right"></i>
					<?=element('name', $categorization)?>
				</h3>
				<div class="box-tools pull-right">
					<span class="label <?=(bool)element('active', $categorization)? 'label-primary':'label-warning'?>">
					<?=(bool)element('active', $categorization)? 'Active':'In-Active'?>
					</span>
				</div>
			</div>		
			<div class="box-body" >
				<p><?=element('description', $categorization)?></p>
				<div id="category-builder-edit" data-bind="FancyTree: {
						extensions: ['persist'],
						checkbox: true,
						source: <?=$cat_settings?>,						
						persist: {
							expandLazy: true,
							store: 'auto'
						},
						dnd: {
							autoExpandMS: 400,
							focusOnClick: true,
							preventVoidMoves: true, 
							preventRecursiveMoves: true, 
							dragStart: function(node, data) {
							  return true;
							},
							dragEnter: function(node, data) {
							   return true;
							},
							dragDrop: function(node, data) {
							 
							  data.otherNode.moveTo(node, data.hitMode);
							}
						},
						edit: {
							triggerStart: ['f2', 'dblclick', 'shift+click', 'mac+enter'],
							beforeEdit: function(event, data){
							},
							edit: function(event, data){
								data.input.addClass('form-control input-sm')
							},
							beforeClose: function(event, data){
							},
							save: function(event, data){
								console.log('save...', this, data);
								/**
								setTimeout(function(){
									$(data.node.span).removeClass('pending');
									data.node.setTitle(data.node.title + '!');
								}, 2000);**/
								return true;
							},
							close: function(event, data){
								if( data.save ) {
									$(data.node.span).addClass('pending');
								}
							}
						}
					}

				"></div>
				
				
			</div>
			<div class="box-footer clearfix">				
				<a class="btn btn-default btn-flat btn-sm" href="<?=base_url('tools/categorybuilder')?>" >Cancel</a>
				<a class="btn btn-danger btn-flat btn-sm pull-right" href="<?=base_url('tools/categorybuilder/edit'). '/' . element('id',$categorization) . ''?>" >Edit</a>
			</div>
		</div>
	
	</div>
	
	
	
	
</div>
<?=form_close()?>



