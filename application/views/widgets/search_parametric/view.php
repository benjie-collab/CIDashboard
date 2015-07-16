<?php 
/*
* @Title: Parametric
* @Method: Search
* @icon: fa-sort-numeric-asc 
* @Description: Search parameteric with direct query from IDOL Server. All elements processed as parametric.
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
	
	/** Dropdown options **/
	$sorts				= $this->application->get_config('sorts', 'search');
	$results_per_page	= $this->application->get_config('results_per_page', 'search');
	$default_elements	= array_keys($this->document_lib->default_elements());	


$responsedata 		= $this->tags_model->call_get_tag_names(array('fieldtype'=> 'parametric'));
$attributes = array(
				'class' => ''
				);
				
?>
<?php echo form_open('/search?'.http_build_query($_GET), $attributes); ?>
	<?php
	if($responsedata){

		if(element('autn:number_of_fields', $responsedata) > 0) {
		?>
		<div data-source="ajax" data-bind="
			FancyTree:{ 
				init: function(event, data){
				
				},
				renderNode: function(event, data){	
					var node = data.node;
					var ndata = node.data;
					
					if(ndata.expand == true)
					node.setExpanded();

					return false;
				},
				  checkbox: true,
				  source: $.ajax({
					url: '<?=base_url('parametric')?>',
					dataType: 'json'
				  }),
				  lazyLoad: function(event, data){
					 var node = data.node;
					  data.result = {
						url: '<?=base_url('parametric/tag_values')?>',
						data: {mode: 'children', parent: node.key, fieldname: node.title},
						cache: true
					  };
				  },
				  selectMode: 3,
				  select: function(event, data){
						
						var fieldText = {};
						var selKeys = $.map(data.tree.getSelectedNodes(), function(node){
							return node.key;
						});							
						var selRootNodes = data.tree.getSelectedNodes(false);	
						var selRootKeys = $.map(selRootNodes, function(node){
							return node.key;							
						});
						
						$.each(selRootNodes, function(i, node){
							if(node.isFolder()){
								fieldText[node.title] = [];
							}else{
								if( !(node.parent.title in fieldText))
									fieldText[node.parent.title] = [];									
								
								var selectedSiblings = jQuery.grep(node.parent.children, function(nd) {
														  return nd.isSelected();
														});
								if(selectedSiblings.length < node.parent.children.length)
								fieldText[node.parent.title].push(node.title);		
							}
						});
						
						
						
						fieldText = $.map(fieldText, function(FT, k){
						
							if(FT.length > 0)
								FT = 
								$.map(FT, function(ft, l){								
									return '<input type=\'hidden\' class=\'fieldtext-hidden\' name=\'fieldtext[' + k + '][]\' value=\'' + ft + '\'/>';
								});
							else
								FT = '<input type=\'hidden\' class=\'fieldtext-hidden\' name=\'fieldtext[' + k + '][]\' value=\'' + FT + '\'/>';
							
							return FT;								
						})
								
						
						if(fieldText.length ===0)
						fieldText.unshift('<input type=\'hidden\' name=\'fieldtext[]\' value=\'\'/>')
						
						$(this).closest('form').find('.fieldtext-hidden').remove();					
						$(this).closest('form')
						.append(fieldText.join(' '))
						.trigger('submit')
						
							/**
						$(this).closest('form')
						.append(fieldText.join(' '))
						.trigger('submit')**/
						
						
							/**
							if(fieldText.length ===0)
						fieldText.unshift('<input type=\'hidden\' name=\'fieldtext[]\' value=\'\'/>');
						var selTagValues = jQuery.grep(selRootNodes, function(node) {
						  return !node.isFolder();
						});
						var selTagNames = jQuery.grep(selRootNodes, function(node) {
						  return node.isFolder();
						});
						
						var selTagValues_ = $.map(selTagValues, function(tv){
							return 'MATCH{' + tv.title + '}:' + tv.parent.title;
						})
						var selTagNames_ = $.map(selTagNames, function(tn){
							return 'MATCH{}:' + tn.title;
						})							
						
						var fieldText = $.merge(selTagValues_, selTagNames_);							
						$(this).closest('form')
						.append('<input type=\'hidden\' name=\'fieldtext\' value=\'' + fieldText.join(' AND ') + '\'/>')
						.trigger('submit');**/
				  },
					dblclick: function(event, data) {
						data.node.toggleSelected();
					},
					keydown: function(event, data) {
						if( event.which === 32 ) {
							data.node.toggleSelected();
							return false;
						}
					}
			}">
			<!--
			<ul style="display: none;">
		<?php
			foreach(element('autn:name', $responsedata) as $i=>$param):
			?>
				<li class="folder" data-lazy ='true'>
					<?=$param?>
				</li>
			<?php			
			endforeach;
		?>
			</ul>-->
		</div>
		<?php
		}
	}
	?>
<?php echo form_close(); ?>