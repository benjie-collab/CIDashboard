<?php 
	$atts = array(
			'class' => '',
			'data-bind' => 'submit: CategoryBuilder.createCategorization', 
			'method' => 'POST',
			'id' => 'add_new_categorization_form'
	);
	$hidden 		= array('active' => false);		
?>
<?php echo form_open( 'tools/categorybuilder/add', $atts, $hidden ); ?>	
<div class="row">
	<div class="col-md-4 col-sm-3">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">
				<i class="fa fa-info-circle"></i>
					Basic Info
				</h3>
				<div class="box-tools pull-right">
					
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
							  'value'		=> '',
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
							  'value'		=>  '',
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
							'checked'     => false,
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
				<button class="btn btn-primary btn-flat btn-sm pull-right" id="category-builder-save">Submit</button>				
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
				<div id="category-builder-create" data-bind="FancyTree: {
						extensions: ['persist', 'dnd', 'edit'],
						checkbox: true,
						source: { url: '<?=base_url('data/category-builder-template.js')?>' },								
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










