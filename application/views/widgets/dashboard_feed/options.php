<?php 	
/*
* Received Parameters:
* 	$widget_key
*/
	
$options 	= $this->application->get_settings($widget_key);	
	
	
	
/** Form attributes with some Knockoutjs bindings for submission. **/
$atts = array(
		'class' => 'form-horizontal',
		'data-bind' => 'submit: $root.formSubmit', 
		'method' => 'POST',
		'onSubmit' => 'return false;',
		'id' => ''
);
/** Add meta_key for options form recognition **/
$hidden 		= array('meta_key' => $widget_key);	



	$feeds 			= $this->rules_model->get_rules(NULL, array('category'=>'feed', 'active'=> true));	
	$feed_settings	= array_column($feeds, 'rule_settings');
	$feed_settings	= unserialize_array_values($feed_settings);
	$feed_ids		= array_column($feeds, 'id');	
	$feeds_select	= array_combine($feed_ids,array_column($feed_settings, 'name'));	
?>

<?php echo form_open( 'app/widget_options', $atts, $hidden ); ?>		
		<div class="form-group">
			<label for="title" class="col-sm-3 control-label">Title</label>	
			<div class="col-sm-9 ">			
			<?php $data = array(
						  'name'        => 'title',
						  'id'          => 'title',
						  'maxlength'   => '30',
						  'class'		=> 'form-control',
						  'value'		=> element('title', $options),												  
						);
			echo form_input($data); ?>	
			</div>			
		</div>
						
						
		<div class="form-group">
			<label class="col-sm-3 control-label" for="feed">Select Feed Type</label>
			<div class="col-sm-9 ">
				<?php
					$feed = element('feed', $options)? element('feed', $options) : '';
					$atts = 'class="selectpicker" data-live-search="true" data-bind="BootstrapSelect:{}"';
					echo form_dropdown('feed', $feeds_select, $feed, $atts);
				?>
			</div>
		</div>
		
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">Document View</legend>
			<ul class="products-list m-b-20">
				<li class="">
				  <div class="product-img bg-gray">
					<img src="http://placehold.it/50x50/d2d6de/ffffff"/>
				  </div>
				  <div class="product-info">
					<span class="bg-black p-t-5 p-b-10 p-l-20 p-r-20 pull-right"></span>
					<div class="bg-orange p-t-10 p-b-10 w-100">
						<a class="product-title " href="javascript::;">							
						</a>
					</div>
					<ul class="list-inline m-0 m-t-5">
						<li class="bg-maroon  p-l-30 p-r-30 p-t-5 p-b-10"></li>
						<li class="bg-maroon  p-l-30 p-r-30 p-t-5 p-b-10"></li>
						<li class="bg-maroon  p-l-30 p-r-30 p-t-5 p-b-10"></li>
						<li class="bg-maroon  p-l-30 p-r-30 p-t-5 p-b-10"></li>
						<li class="bg-maroon  p-l-30 p-r-30 p-t-5 p-b-10"></li>
						<li class="bg-maroon  p-l-30 p-r-30 p-t-5 p-b-10"></li>
					</ul>
					<span class="product-description d-block p-t-20 p-b-20 bg-navy"></span>
				  </div>
				</li><!-- /.item -->
			</ul>
			
			<div class="form-group">
				<label class="col-sm-3 control-label" for="doc_thumbnail"><span class="p-5 bg-gray disabled"></span></label>	
				<div class="col-sm-9" >			
					<?php 
						$elements = $this->document_lib->elements(null, array('action'=>'GetTagNames', 'responseformat'=>'json','text'=>'*', 'FieldType' => 'SOURCE'), false);
						$atts = 'class="form-control selectpicker" data-live-search="true" data-max-options="5" data-size="5" data-bind="BootstrapSelect:{}"';
						$selected = array_key_exists('doc_thumbnail', $options)? $options['doc_thumbnail'] : '';
						echo form_dropdown('doc_thumbnail', $elements, $selected, $atts);
					?>
				</div>	
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="doc_title"><span class="p-5 bg-orange"></span></label>	
				<div class="col-sm-9" >			
					<?php 
						$elements = $this->document_lib->elements(null, array('action'=>'GetTagNames', 'responseformat'=>'json','text'=>'*', 'FieldType' => 'TITLE'), false);
						$atts = 'class="form-control selectpicker" data-live-search="true" data-max-options="5" data-size="5" data-bind="BootstrapSelect:{}"';
						$selected = array_key_exists('doc_title', $options)? $options['doc_title'] : '';
						echo form_dropdown('doc_title', $elements, $selected, $atts);
					?>
				</div>	
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="doc_score"><span class="p-5 bg-black "></span></label>	
				<div class="col-sm-9" >			
					<?php 
						$elements = $this->document_lib->elements(null, array('action'=>'GetTagNames', 'responseformat'=>'json','text'=>'*', 'FieldType' => 'SOURCE'), true);
						$atts = 'class="form-control selectpicker" data-live-search="true" data-max-options="5" data-size="5" data-bind="BootstrapSelect:{}"';
						$selected = array_key_exists('doc_score', $options)? $options['doc_score'] : '';
						echo form_dropdown('doc_score', $elements, $selected, $atts);
					?>
				</div>	
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="doc_meta"><span class="p-5 bg-maroon disabled"></span></label>	
				<div class="col-sm-9" >			
					<?php 
						$elements = array_merge(
								$this->document_lib->elements(null, array('action'=>'GetTagNames', 'responseformat'=>'json','text'=>'*', 'FieldType' => 'SOURCE') ),
								$this->document_lib->elements(null, array('action'=>'GetTagNames', 'responseformat'=>'json','text'=>'*', 'FieldType' => 'DATABASE') ),
								$this->document_lib->elements(null, array('action'=>'GetTagNames', 'responseformat'=>'json','text'=>'*', 'FieldType' => 'EXPIREDATE') ),
								$this->document_lib->elements(null, array('action'=>'GetTagNames', 'responseformat'=>'json','text'=>'*', 'FieldType' => 'LANGUAGE') ),
								$this->document_lib->elements(null, array('action'=>'GetTagNames', 'responseformat'=>'json','text'=>'*', 'FieldType' => 'NUMERICDATE') ),
								$this->document_lib->elements(null, array('action'=>'GetTagNames', 'responseformat'=>'json','text'=>'*', 'FieldType' => 'DATE') ),
								$this->document_lib->elements(null, array('action'=>'GetTagNames', 'responseformat'=>'json','text'=>'*', 'FieldType' => 'INDEX') ),
								$this->document_lib->elements(null, array('action'=>'GetTagNames', 'responseformat'=>'json','text'=>'*', 'FieldType' => 'NUMERIC') )
								
								);
						$atts = 'class="form-control selectpicker" data-live-search="true" data-max-options="5" data-size="5" data-bind="BootstrapSelect:{}" multiple';
						$selected = array_key_exists('doc_meta', $options)? $options['doc_meta'] : array();
						echo form_dropdown('doc_meta[]', $elements, $selected, $atts);
					?>
				</div>	
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="doc_summary"><span class="p-5 bg-navy"></span></label>	
				<div class="col-sm-9" >			
					<?php 
						$elements = array_merge(
								$this->document_lib->elements(null, array('action'=>'GetTagNames', 'responseformat'=>'json','text'=>'*', 'FieldType' => 'HIGHLIGHT'),true),
								$this->document_lib->elements(null, array('action'=>'GetTagNames', 'responseformat'=>'json','text'=>'*', 'FieldType' => 'INDEX') )
								
								);
						$atts = 'class="form-control selectpicker" data-live-search="true" data-max-options="5" multiple data-size="5" data-bind="BootstrapSelect:{}"';
						$selected = array_key_exists('doc_summary', $options)? $options['doc_summary'] : array();
						echo form_dropdown('doc_summary[]', $elements, $selected, $atts);
					?>
				</div>	
			</div>
			
			
		</fieldset>
<?php echo form_close(); ?>