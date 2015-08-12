<?php 	
/*
* 	MODAL SUPPORT OF THIS WIDGET
*
* 	Received Parameters:
* 	$meta_key - urldecode() needed
*/
	
	$query_config	= $this->application->get_config('query','actions');
	$query_settings = isset($query_settings)?	$query_settings : $this->application->get_session_userdata('current_search');	
	$dbs_customer 	= $this->application->get_session_userdata('dbs_customer');
	
	$is_page 		= $this->application->is_page();
	$page 			= $this->session->userdata('current_page');
	$options 		= isset($meta_key)? $this->application->get_settings(urldecode($meta_key)) : array();
	$solution_options = array_key_exists('solution', $options)? element('solution', $options): array();
	
	$solution_template_options 	= array_key_exists('template', $solution_options)? element('template', $solution_options): array();
	$solution_data_options 	= array_key_exists('data', $solution_options)? element('data', $solution_options): array();
	
	$ts = generate_timestamp();		
	$options_other 		= element('other', $solution_options);
	$options_recommended = element('recommended', $solution_options);
	
	$get_data		= $_GET;
	
	
	
	$fieldname = end(explode(  '/', element('fieldname', $solution_data_options)));
	$fieldtext[] = 'MATCH{' . element($fieldname, $get_data) . '}:' .$fieldname;	
	$fieldtext[] = 'EMPTY{}:' .$fieldname;	
	
	
						$query = array_merge(
									//$query_config,
									//$query_settings,
									$solution_data_options,
									$get_data,
									array(
										'fieldtext' => join(' OR ', $fieldtext),									
										'maxresults' => 4,	
										'start' => 1,
										'totalresults' => 'true',
										'action' => 'query',
										'print' => 'all',
										'server' => $page->server,
									)
									);
						$results = $this->idol->QueryAction($query);
						$results = clean_json_response($results);						
						
						$totalhits 	= array_get_value($results, 'autn:totalhits');
						$numhits 	= array_get_value($results, 'autn:numhits');
						$document_options = $this->application->get_config('document_options', 'template');							
						
						$hit 		= array_get_value($results, 'autn:hit');	
						$solutions 	= intval($numhits)===1? array( 0 => $hit) : $hit;
	
						
	
	$template = array_key_exists('name', $solution_template_options) ? element('name', $solution_template_options): 'document-template-chat';	
?>
<div class="nav-tabs-custom m-0">
	<ul class="nav nav-tabs text-center">	  
	  <li class="active"><a data-toggle="tab" href="#dbs-solution-tab-1">
		<i class="fa <?=element('icon', $options_recommended)? element('icon', $options_recommended): 'fa-list'?>"></i>
		<?=element('name', $options_recommended)?></a>
	  </li>
	  <li class="<?=intval(element('enable', $options_other))==1? '' : 'hidden'  ?>"><a data-toggle="tab" href="#dbs-solution-tab-2">
		<i class="fa <?=element('icon', $options_other)? element('icon', $options_other): 'fa-list'?>"></i>
		<?=element('name', $options_other)?></a></li>
	</ul>
	<div class="tab-content">
		<div id="dbs-solution-tab-1" class=" tab-pane active">
			
			<div class=""  data-bind="jQueryQuickSearch: { 
					input_selector: '#<?=$ts?>-input', 
					elements_to_search: 'div#<?=$ts?>-list div div.item', 
					loader: '#<?=$ts?>-spinner',
					noResults: 'div#<?=$ts?>-list div.noresults'
				} ">
				<form class="form-inline">					
				<div class="text-center">
					<div class="input-group input-group-md">
					<div class="form-group has-feedback">						
						<input type="text" value="" name="text" id="<?=$ts?>-input" class="form-control" placeholder="Filter <?=$totalhits?$totalhits: 0?> Solution/s" size="40"/>	
						<span class="form-control-feedback typeahead-spinner m-r-20" id="<?=$ts?>-spinner"><i class="fa fa fa-spinner fa fa-spin text-muted"></i></span>
						<span class="form-control-feedback"><i class="fa fa-microphone text-muted"></i></span>
					</div>
					<span class="input-group-btn">
					  <button type="submit" class="btn btn-flat btn-xl">Filter</button>
					</span>
					</div>					
				</div>
				<div data-bind="CustomScrollbar: { 
						axis:'y', 
						theme:'dark', 
						autoExpandScrollbar:true,
						advanced:{
							autoExpandHorizontalScroll:true
							}
						}" class="m-t-10 max-height-420">
						
					<div class="" id="<?=$ts?>-list">	
						<div class="noresults item">No results found...</div>
						<?php 
						$data['responsedata'] = array_get_value($results, 'responsedata');
						$data['template'] = $solution_template_options;						
						echo $this->load->view('template/'.$template, $data); 
						?>
					</div>	
					
				</div>
				</form>
			</div>			
		</div>
		<div id="dbs-solution-tab-2" class=" tab-pane <?=intval(element('enable', $options_other))==1? '' : 'hidden'  ?>">
			<?php
			$atts = array(
					'class' => 'form-inline',
					'data-bind' => "jQueryLiveSearch: 
										{ 
											input: '#livesearch-input-" . $ts . "',
											container: '#livesearch-container-" . $ts . "',
											spinner: '#livesearch-spinner-" . $ts . "',
											template: '" . htmlspecialchars(json_encode($solution_template_options, JSON_NUMERIC_CHECK), ENT_QUOTES, 'UTF-8') . "',
											url : '" . base_url('pages/search') . "'
										}", 
					'method' => 'POST',
					'onSubmit' => 'return false;',
					'id' => 'widget_options_form'
					);
			$hidden 		= array_merge(
							$solution_data_options,
							$get_data,
							array(
								'fieldtext' => join(' OR ', $fieldtext),	
								'dataType'=> "html",
								'summary' => 'concept',
								'totalresults' => 'true',	
								//'action' => 'suggestontext'	,
								'template' => $solution_template_options,
								'server' => $page->server
							) );	

			 echo form_open( 'app/widget_options', $atts, $hidden ); ?>			
				<div class="text-center">
				<div class="input-group input-group-md">
					<div class="form-group has-feedback text-left">						 
					  <input id="livesearch-input-<?=$ts?>" type="text" class="form-control input-md" placeholder="Search" name="text" size="40"/>
					  
						<span class="form-control-feedback m-r-20 typeahead-spinner" id="livesearch-spinner-<?=$ts?>"><i class="fa fa fa-spinner fa fa-spin text-muted"></i></span>
						<span class="form-control-feedback"><i class="fa fa-microphone text-muted"></i></span>						
					</div>
					<span class="input-group-btn">
					  <button type="submit" class="btn btn-flat btn-xl">Search</button>
					</span>
				</div>
				</div>
				<div data-bind="CustomScrollbar: { 
						axis:'y', 
						theme:'dark', 
						autoExpandScrollbar:true,
						advanced:{
							autoExpandHorizontalScroll:true
							}
						}" class="m-t-10 max-height-420">
					<div class="" id="livesearch-container-<?=$ts?>">	
						<p class="text-muted">Results will appear here...</p>		
					</div>						
				</div>		
			<?=form_close()?>
		</div>
	</div>	
	<div class="box-footer clearfix">
	  <a class="btn btn-sm btn-flat pull-left " href="javascript::;">Save this Solutions</a>
	  <a class="btn btn-sm btn-flat pull-right " href="javascript::;">View All Solutions</a>
	</div>
</div>
				


	<!-- data-bind=
						"TypeAhead:{
							ajax: {
									url: '<?=base_url('search/query')?>',
									source: 'autn:content',
									params: {
										print: 'all',
										databasematch: '<?=join(',', array())?>'
									}								
								},	
							display: 'NRIC_M_FT',								
							templates: {
								empty: [
									  '<div class=\'empty-message text-danger p-t-5 p-b-5 p-l-10 p-r-10\'>',
										'Can&prime;t find suggestion...',
									  '</div>'
									].join('\n'),
								suggestion:  function(data) {													
												return '<div><strong>' + data.NAME_M_FT + '</strong> – ' + data.NRIC_M_FT + '</div>';
											}
							  }
						}" -->
		


