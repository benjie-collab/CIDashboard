<?php 
/*
* @Title: DBS Outs. Issues
* @Method: Pages
* @icon: fa-exclamation-triangle
* @Description: Displays the result of the documents with configurable options.
*/ 
?>

<?php 	
/** 
	Received Parameters:
	$widget_key
	$meta_key
	$query_settings
**/
	
	$query_config	= $this->application->get_config('query','actions');
	$query_settings = isset($query_settings)?	$query_settings : $this->application->get_session_userdata('current_search');	
	$dbs_customer 	= $this->application->get_session_userdata('dbs_customer');
	
	$is_page 		= $this->application->is_page();
	$options 		= isset($meta_key)? $this->application->get_settings($meta_key) : array();
	$issues_options	= array_key_exists('issues', $options)? element('issues', $options): array();
	$issues_data_options	= array_key_exists('data', $issues_options)? element('data', $issues_options): array();
	$issues_template_options 	= array_key_exists('template', $issues_options)? element('template', $issues_options): array();
	
	
	
	$get_data		= $_GET;
	
	
?>
<?php 
	if($dbs_customer){	
	
	if(array_key_exists('acct_id', $get_data))	
	$fieldtext[end(explode(  '/', element('fieldname', $issues_data_options)))] = element('acct_id', $get_data);
	
	$fieldtext['CUST_ID_M_FT '] = element('DREREFERENCE', $dbs_customer);
	
	
	$options_closed = element('closed', $issues_options);
	$options_open = element('open', $issues_options);
?>
	
	<?php 
		$fieldtext['ISSUE_STATUS_M_FT_P'] = 'OUTSTANDING';
		$results = array();
		if($query_settings){
			
			$query = array_merge(
						//$query_config,
						$issues_data_options,
						array(
							'fieldtext' => $fieldtext,
							'server' =>  element('server', $page)
						)
						);
						
			
			$results = $this->search_model->call_search($query);
			$results = clean_json_response($results);
		}	
		
		$numhits 	= array_get_value($results, 'autn:numhits');
		$document_options = $this->application->get_config('document_options', 'template');	
		
		$hit 		= array_get_value($results, 'autn:hit');	
		$issues 	= intval($numhits)===1? array( 0 => $hit) : $hit;
	?>
	<div class="nav-tabs-custom <?=element('bgcolor', $options)? 'bg-'.element('bgcolor', $options).'-gradient' : '' ?>">
		<ul class="nav nav-tabs pull-right">	  
		  <li class="pull-left header">
			<i class="fa <?=element('icon', $options)?>"></i> <?=element('title', $options)?>	
		  </li>		  
		  <li class="active"><a data-toggle="tab" href="#dbs-issues-tab-1">
			<?=element('name', $options_open)?>
			<span class="label label-danger"><?=count($issues)?></span>
			</a>
		  </li>
		  <li><a data-toggle="tab" href="#dbs-issues-tab-2">
			<?=element('name', $options_closed)?></a></li>
		</ul>
		<div class="tab-content">
			<div id="dbs-issues-tab-1" class=" tab-pane active">
				
				<?php if($issues){ ?>
					<?php 		
							
					foreach($issues as $key=>$issue){
					$document 	= array_get_value($issue, 'DOCUMENT');
					?>			             
						<div class="info-box bg-<?=element('bgcolor', $options_open)? element('bgcolor', $options_open): 'yellow'?> bounceIn animated"			
						data-toggle="popover"
						data-content="
									<p>
									<?php 
										if(element('doc_meta',$issues_template_options)){
											foreach( element('doc_meta',$issues_template_options) as $meta):
									?>	
											<small class='text-muted'><?=element( end(explode('/', $meta)), $document)?></small> -
									<?php								
											endforeach;
										}
									?>	
									</p>
									<p><small>
									<?php 
										if(element('doc_summary',$issues_template_options)){
											foreach( element('doc_summary',$issues_template_options) as $meta):
									?>	
											<?=element(end(explode('/', $meta)), $document)?>
									<?php								
											endforeach;
										}
									?>
									</small></p>
									<p class='text-center'><small class='btn btn-sm btn-flat <?=element('submit_buttons', $page)?>'
										data-toggle='modal'
										data-target='#modal-widget'
										data-remote='<?=base_url('app/widget_modal/dbs_customer_issues_solution/' . urlencode($meta_key)  
													.'?text=' . urlencode(element('ISSUE_CATEGORY_M_FT', $document))
													.'&title=' . urlencode(element('ISSUE_CATEGORY_M_FT', $document))
													.'&ISSUE_STATUS_M_FT_P=' . urlencode('CLOSED')													
													)?>'									
									>Find Solution</small></p>"
						data-placement="left"
						data-html="true"
						data-container="body"
						title="<i class='ion ion-alert-circled'></i> 
						<?php 
							if(element('doc_title',$issues_template_options)){
								foreach( element('doc_title',$issues_template_options) as $meta):
						?>	
								<?=element(end(explode('/', $meta)), $document)?>
						<?php								
								endforeach;
							}
						?>">
							<span class="info-box-icon"><i class="rubberBand animated infinite fa <?=element('icon', $options_open)? element('icon', $options_open): 'fa-exclamation-triangle'?>"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">
									<?php 
										if(element('doc_title',$issues_template_options)){
											foreach( element('doc_title',$issues_template_options) as $meta):
									?>	
											<?=element(end(explode('/', $meta)), $document)?>
									<?php								
											endforeach;
										}
									?>
								</span>
								<span class="info-box-number">
								<?php 
									if(element('doc_meta',$issues_template_options)){
										foreach( element('doc_meta',$issues_template_options) as $meta):
								?>	
										<?=element(end(explode('/', $meta)), $document)?>-
								<?php								
										endforeach;
									}
								?>
								</span>
								
								<div class="progress">
									<div style="width: 50%" class="progress-bar"></div>
								</div>
								<span class="progress-description">	
									<?php 
										if(element('doc_summary',$issues_template_options)){
											foreach( element('doc_summary',$issues_template_options) as $meta):
									?>	
											<?=element(end(explode('/', $meta)), $document)?>
									<?php								
											endforeach;
										}
									?>
								</span>
							</div>
						</div>	
					<?php		
					
					}				
					?>
					
				
				<?php 
					}else{
				?>	
				<?=$this->application->get_config('info_start_delimiter', 'template')?>
				No issues found on this account...
				<?=$this->application->get_config('info_end_delimiter', 'template')?>
				<?php 
					}
				?>

			</div>
			<div id="dbs-issues-tab-2" class=" tab-pane">
				<?php 
					$fieldtext['ISSUE_STATUS_M_FT_P'] = 'CLOSED';
					$results = array();
					if($query_settings){
						
						$query = array_merge(
									//$query_config,
									$issues_data_options,
									array(
										'fieldtext' => $fieldtext,
										'server' =>  element('server', $page)
									)
									);
									
						
						$results = $this->search_model->call_search($query);
						$results = clean_json_response($results);
						
					}	
					
					$numhits 	= array_get_value($results, 'autn:numhits');
					$document_options = $this->application->get_config('document_options', 'template');	
					
					$hit 		= array_get_value($results, 'autn:hit');	
					$issues 	= intval($numhits)===1? array( 0 => $hit) : $hit;
				?>
				<?php if($issues){ ?>
					<?php 		
							
					foreach($issues as $key=>$issue){
					$document 	= array_get_value($issue, 'DOCUMENT');
					?>			             
						<div class="info-box bg-<?=element('bgcolor', $options_closed)? element('bgcolor', $options_closed): 'yellow'?> bounceIn animated"			
						data-toggle="popover"
						data-content="
									<p>
									<?php 
										if(element('doc_meta',$issues_template_options)){
											foreach( element('doc_meta',$issues_template_options) as $meta):
									?>	
											<small class=''><i class='fa fa-tag'></i> <?=element( end(explode('/', $meta)), $document)?></small>
									<?php								
											endforeach;
										}
									?>	
									</p>
									<p><small>
									<?php 
										if(element('doc_summary',$issues_template_options)){
											foreach( element('doc_summary',$issues_template_options) as $meta):
									?>	
											<?=element(end(explode('/', $meta)), $document)?>
									<?php								
											endforeach;
										}
									?>
									</small></p>
									<p class='text-center'><small class='btn btn-sm btn-flat <?=element('submit_buttons', $page)?>'
										data-toggle='modal'
										data-target='#modal-widget'
										data-remote='<?=base_url('app/widget_modal/dbs_customer_issues_solution/' . urlencode($meta_key)  
													.'?text=' . urlencode(element('ISSUE_CATEGORY_M_FT', $document))
													.'&title=' . urlencode(element('ISSUE_CATEGORY_M_FT', $document))
													.'&ISSUE_STATUS_M_FT_P=' . urlencode('CLOSED')													
													)?>'									
									>Find Solution</small></p>"
						data-placement="left"
						data-html="true"
						data-container="body"
						title="<i class='ion ion-alert-circled'></i> 
						<?php 
							if(element('doc_title',$issues_template_options)){
								foreach( element('doc_title',$issues_template_options) as $meta):
						?>	
								<?=element(end(explode('/', $meta)), $document)?>
						<?php								
								endforeach;
							}
						?>">
							<span class="info-box-icon"><i class="fa <?=element('icon', $options_closed)? element('icon', $options_closed): 'fa-exclamation-triangle'?>"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">
									<?php 
										if(element('doc_title',$issues_template_options)){
											foreach( element('doc_title',$issues_template_options) as $meta):
									?>	
											<?=element(end(explode('/', $meta)), $document)?>
									<?php								
											endforeach;
										}
									?>
								</span>
								<span class="info-box-number">
								<?php 
									if(element('doc_meta',$issues_template_options)){
										foreach( element('doc_meta',$issues_template_options) as $meta):
								?>	
										<?=element(end(explode('/', $meta)), $document)?>-
								<?php								
										endforeach;
									}
								?>
								</span>
								
								<div class="progress">
									<div style="width: 50%" class="progress-bar"></div>
								</div>
								<span class="progress-description">	
									<?php 
										if(element('doc_summary',$issues_template_options)){
											foreach( element('doc_summary',$issues_template_options) as $meta):
									?>	
											<?=element(end(explode('/', $meta)), $document)?>
									<?php								
											endforeach;
										}
									?>
								</span>
							</div>
						</div>	
					<?php			
					}				
					?>
					
				
				<?php 
					}else{
				?>	
				<?=$this->application->get_config('info_start_delimiter', 'template')?>
				No issues found on this account...
				<?=$this->application->get_config('info_end_delimiter', 'template')?>
				<?php 
					}
				?>
			</div>
		</div>
		<div class="box-footer clearfix">
		  <a href="javascript::;" class="btn btn-sm btn-flat pull-right <?=element('info_buttons', $page)?>">View All Issues</a>
		</div>
	</div>
	
<?php 
	}else{
	?>	
	<div class="no-content"></div>
<?php	
}
?>


