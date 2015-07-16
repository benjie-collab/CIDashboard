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

echo form_open( 'app/widget_options', $atts, $hidden ); ?>


		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs pull-right">
			  <li class="active"><a data-toggle="tab" data-target="#options-tab-1" href="javascript:void(0)"><i class="fa fa-tasks"></i></a></li>
			  <li class=""><a data-toggle="tab" data-target="#options-tab-2" href="javascript:void(0)"><i class="fa fa-area-chart"></i></a></li>
			</ul>
			<div class="tab-content p-0 p-t-20">
				<div id="options-tab-1" class="tab-pane active">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="title"><?=lang('search_results_options_title_label')?></label>
						<div class="col-sm-9">
						   <?php $data = array(
										  'name'        => 'title',
										  'id'          => 'title',
										  'maxlength'   => '30',
										  'class'		=> 'form-control',
										  'value'		=> element('title',$options),
										  'placeholder'	=> 'Enter Title'
										);

							echo form_input($data); ?>
							<p class="help-block"><?=lang('search_results_options_title_help_text')?></p>
						</div>
					</div>				
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="widgetize">Widgetize</label>	
					<div class="col-sm-9 checkbox" >				
						<input type="hidden" name="widgetize" value="0"/>
					   <?php $data = array(
							'name'        => 'widgetize',
							'id'          => 'widgetize',
							'value'       => 1,
							'checked'     => intval(element('widgetize', $options))==1,
							'style'       => 'margin:10px',
							'class'		  => 'm-0 p-absolute',
							'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
							);
						echo form_checkbox($data); ?>
					</div>
				</div>	
				<div id="options-tab-2" class="tab-pane">
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
				</div>
			</div>
		</div>
				  
				  
		
		
		
		
		<!--
		
		<div class="modal-footer">
		<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary btn-flat" data-bind="css: { 'has-spinner active' : $root.ajaxProcess}">
			<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
			Save changes</button>
		
		</div>-->
<?php echo form_close(); ?>
<script>
	//ko.applyBindings(VMSearchWidgetOptions, $('#widget_options_form').get(0) );
</script>

