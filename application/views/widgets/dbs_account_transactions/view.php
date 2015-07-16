<?php 
/*
* @Title: DBS Transactions
* @Method: Pages
* @icon: fa-history
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
	$query_options	= array_key_exists('query', $options)? element('query', $options): array();
	
	$get_data		= $_GET;
	
	
	
?>
<?php 
	if($dbs_customer && array_key_exists('acct_id', $get_data)){	
	$match = 'MATCH{' . element('acct_id', $get_data) . '}:' . end(explode(  '/', element('fieldname', $options)));
	$results = array();
	if($query_settings){
		
		$query = array_merge(
					$query_config,
					$query_options,
					array(
						'fieldtext' => $match,
						'server' => element('server', $page)
					)
					);
		$results = $this->search_model->call_search($query);
		$results = clean_json_response($results);
		
	}	
	
	$numhits 	= array_get_value($results, 'autn:numhits');
	$document_options = $this->application->get_config('document_options', 'template');	
	
	$hit 		= array_get_value($results, 'autn:hit');	
	$history 	= intval($numhits)===1? array( 0 => $hit) : $hit;
	
	$ts = generate_timestamp();		
?>


	
	<?php if($history){ ?>
	<div class="box-body"  data-bind="jQueryQuickSearch: { input_selector: '#<?=$ts?>-input', elements_to_search: 'table#<?=$ts?>-table tbody tr', loader: '#<?=$ts?>-spinner'} ">
		<form class="form-inline">
		<div class="form-group has-feedback">
		  <input type="text" value="" name="text" id="<?=$ts?>-input" class="form-control" placeholder="Find...">	
		  <span class="form-control-feedback typeahead-spinner" id="<?=$ts?>-spinner"><i class="fa fa fa-spinner fa fa-spin text-muted"></i></span>			  
		</div>
		<div data-bind="CustomScrollbar: { axis:'y', theme:'dark'}" class="max-height-320">
			<div class="table-responsive">				
				<table class="table no-margin table-striped table-condensed" id="<?=$ts?>-table">
					<thead>
						<tr>
							<th>Transaction Date</th>
							<th>Description</th>
							<th>Inflow/Outflow</th>
							<th>Amount</th>
						</tr>
					</thead>
				<tbody>
					<?php 
					foreach($history as $his){
					$document 	= array_get_value($his, 'DOCUMENT');
					?>
					<tr>
						<td><a href="javascript:void(0)"><?=element('TRANS_DATE_N_S', $document)?></a></td>
						<td><?=element('DESCRIPTION_M_FT', $document)?></td>
						<td><?=intval(element('CREDIT_N_S', $document))? '<i class="fa fa-long-arrow-left text-success "></i>': '<i class="fa fa-long-arrow-right text-danger"></i>'?></td>
						<td><?=intval(element('CREDIT_N_S', $document))? element('CREDIT_N_S', $document): element('DEBIT_N_S', $document)?></td>
					</tr>			
					<?php			
					}				
					?>
					
				</tbody>
				</table>
			</div>
		</div>
		</form>
	</div>
	<?php 
		}else{
	?>		
		<?=$this->application->get_config('info_start_delimiter', 'template')?>
		No transaction so found...
		<?=$this->application->get_config('info_end_delimiter', 'template')?>
	<?php 
		}
	?>
		
	
	<div class="box-footer clearfix">
	  <a class="btn btn-sm btn-flat pull-right <?=element('info_buttons', $page)?> <?=$history? '' : 'disabled'?>" href="javascript::;">View All Transactions</a>
	</div>
<?php 
	}
?>
	
		


