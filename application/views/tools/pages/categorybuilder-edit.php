<?php 
	$atts = array(
			'class' => '',
			'data-bind' => 'submit: CategoryBuilder.updateCategorization', 
			'method' => 'POST',
			'id' => ''
	);
	$categorization = (array)$categorization;
	$hidden 		= array('active' => false, 'id' => element('id', $categorization));	
	$cat_settings   = unserialize(element('cat_settings', $categorization));	
	$cat_settings	= $cat_settings && is_json($cat_settings)? $cat_settings
						: json_encode(array('url' => base_url('data/category-builder-template.js')), JSON_UNESCAPED_SLASHES);
	$cat_settings 	= htmlspecialchars($cat_settings, ENT_QUOTES, 'UTF-8');		
	
?>
<?php echo form_open( 'tools/categorybuilder/edit/' . element('id', $categorization), $atts, $hidden ); ?>	
<div class="row">
	<div class="col-md-4 col-sm-3">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">
				<i class="fa fa-info-circle"></i>
					Basic Info
				</h3>
				<div class="box-tools pull-right">
					<a class="btn btn-success btn-flat btn-sm pull-right" href="<?=base_url('tools/categorybuilder/add')?>" >New Categorization</a>
				</div>
			</div>		
			<div class="box-body" >
				<div class="form-group">
					<label class="control-label" for="name"><span class="text-danger">*</span> Name</label>		  
					<?php $data = array(
							  'name'        => 'name',
							  'id'          => 'name',
							  'maxlength'   => '30',
							  'class'		=> 'form-control',
							  'value'		=> element('name', $categorization),
							  'placeholder'	=> 'Enter name'
							);
					echo form_input($data); ?>			
					<p class="help-block"></p>
				</div>
				
				<div class="form-group">
					<label class="control-label" for="description">Description</label>	
					<div class="text-center">
					<?php $data = array(
							  'name'        => 'description',
							  'id'          => 'description',
							  'rows'  		=> '2',
							  'class'		=> 'form-control',
							  'value'		=>  element('description', $categorization),
							  'data-bind'	=> 'BootstrapWYSIhtml5:{ html: true, image: false, \'font-styles\': false, link: false }',
							  'placeholder'	=> 'Some description'
							);
					echo form_textarea($data); ?>			
					</div>
					<p class="help-block"></p>
				</div>
				
				<div class="form-group">
					<label class="control-label" for="description">Activate</label>	
					<div class="">
						<?php $data = array(
							'name'        => 'active',
							'id'          => 'active',
							'value'       => true,
							'checked'     => (bool)element('active', $categorization)==true,
							'style'       => 'margin:10px',
							'class'		  => 'm-0 p-absolute',
							'data-bind'	=> 'BootstrapSwitch:{ size: \'small\'}'
							);
						echo form_checkbox($data); ?>
					</div>
					<p class="help-block"></p>
				</div>
				
				
				
			</div>
			<div class="box-footer clearfix">
				<a class="btn btn-default btn-flat btn-sm" href="<?=base_url('tools/categorybuilder')?>" >Cancel</a>
				<button type="submit" class="btn btn-sm btn-primary btn-flat pull-right" data-bind="css: { 'has-spinner active' : $root.CategoryBuilder.ajaxProcess}">
				<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
				Update</button>
			</div>
		</div>
	
	</div>
	
	
	
	
	<div class="col-md-8 col-sm-9">	
		<div class="box box-solid">
			<div class="box-header">
				<h3 class="box-title"></h3>
				<div class="box-tools pull-right"></div>
			</div>		
			<div class="box-body" >
				
				
				<div id="category-builder-edit" data-bind="FancyTree: {
						extensions: ['persist', 'dnd', 'edit'],
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
				<ul class="list-inline">
					<li> <a class="btn btn-default btn-flat btn-sm" id="category-builder-add-child-edit">Add Child</a></li>
					<li> <a class="btn btn-default btn-flat btn-sm" id="category-builder-add-sibling-edit">Add Sibling</a></li>
				</ul>
			</div>
		</div>
	</div>
	
</div>
<?=form_close()?>



