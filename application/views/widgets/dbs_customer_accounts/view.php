<?php 
/*
* @Title: DBS Accounts
* @Method: Pages
* @icon: fa-credit-card
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
	
	$page 			= $this->session->userdata('current_page');
	$ts = generate_timestamp();
?>
<?php 
	if($dbs_customer){	
	$match = 'MATCH{' . element('DREREFERENCE', $dbs_customer) . '}:' . end(explode(  '/', element('fieldname', $options)));
	$results = array();
	if($query_settings){
		
		$query = array_merge(
					$query_config,
					$query_options,
					array(
						'fieldtext' => $match,
						'server' =>  $page->server,
						'action'=> 'query',
						'print'=> 'all'
						
					)
					);
		$results = $this->idol->QueryAction($query);
		$results = clean_json_response($results);
		
	}	
	
	$numhits 	= array_get_value($results, 'autn:numhits');	
	$hit 		= array_get_value($results, 'autn:hit');	
	$accounts 	= intval($numhits)===1? array( 0 => $hit) : $hit;
	$accounts	= intval($numhits)==0? array(): $accounts;	
	
?>
	<div class="box-body p-0 tex-center"  data-bind="
			jQueryQuickSearch: { 
			input_selector: '#<?=$ts?>-input', 
			elements_to_search: 'table#<?=$ts?>-list tbody tr', 
			noResults: 'table#<?=$ts?>-list tbody tr.noresults', 
			loader: '#<?=$ts?>-spinner'} ">
		<form class="form-inline">
			
			
			
			
			<div class="collapse text-center" id="accts-list">
			
			<div class="input-group">
			<div class="form-group has-feedback">
			  <input type="text" value="<?=element('acct_id', $query_settings)?>" name="text" id="<?=$ts?>-input" class="form-control" placeholder="Find..." size=""/>	
			  <span class="form-control-feedback typeahead-spinner" id="<?=$ts?>-spinner"><i class="fa fa fa-spinner fa fa-spin text-muted"></i></span>			  
			</div>	
			<?php 
			$link = $_GET;
			unset($link['acct_id']);
			if(element('acct_id', $query_settings)){?>
			<a class="input-group-addon" href="<?=current_url() . '?' . http_build_query($link)?>"><i class="fa fa-remove"></i></a>
			<?php } ?>
            </div>
			
			<table class="table table-striped table-condensed m-t-10" id="<?=$ts?>-list">
				<thead>
					<tr>
					  <th style="width: 15%">#</th>
					  <th style="width: 50%">Account</th>
					  <th>Type</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if($accounts){
					foreach($accounts as $key=>$acct){
					$document 	= array_get_value($acct, 'DOCUMENT');
					$link = array_merge(
							$_GET, 
							array( 'acct_id' => element('DREREFERENCE', $document))
							);
					?>
					<tr class="bounceIn animated text-left <?=(strcasecmp(element('acct_id', $query_settings), element('DREREFERENCE', $document))==0)? 'active': ''?>">
					  <td><?=$key+1?>.</td>
					  <td>
						<a href="<?=current_url() . '?' . http_build_query($link)?>">
							<?=element('ACCOUNT_NO_N', $document)?> 
						</a>
					  </td>
					  <td>
						<span class="label label-primary"><?=strtolower(element('ACCOUNT_TYPE_M_FT', $document))?></span>
						<small class="hidden"><?=element('DREREFERENCE', $document)?></small>		
					  </td>				 
					</tr>
										
					
					<?php			
					}		
					
					?>
					<?php			
					}		
					?>
					<tr class="bounceIn animated text-left noresults">
						<td cols="3">
						No accounts found...
						</td>
					</tr>
					
			  </tbody></table>
			  </div>
			
			
			<div class="box-footer clearfix text-center">			 
			  <span class="btn btn-flat btn-sm"  data-toggle="collapse" data-target="#accts-list"
			  ><i class="fa fa-chevron-down"></i> Accounts</span>
			</div>
			
			
			
			
			
			
			
			<!--
			
			<div data-bind="CustomScrollbar: { 
						axis:'x', 
						theme:'rounded-dark', 
						autoExpandScrollbar:true,
						advanced:{
							autoExpandHorizontalScroll:true
							}
						}" class="m-t-10">	 
				<ul class="list-inline" id="<?=$ts?>-list">
					<?php 
					if($accounts){
					foreach($accounts as $key=>$acct){
					$document 	= array_get_value($acct, 'DOCUMENT');
					$link = array_merge(
							$_GET, 
							array( 'acct_id' => element('DREREFERENCE', $document))
							);
					?>
					<li>
						<a class="bounceIn animated btn btn-app m-0 p-l-20 p-r-20 h-100 
							<?=(strcasecmp(element('acct_id', $query_settings), element('DREREFERENCE', $document))==0)? 'active': ''?>" 
							href="<?=current_url() . '?' . http_build_query($link)?>">
							<h3 class="m-0 m-b-10"><i class="fa fa-credit-card"></i> </h3>
							<b><?=element('ACCOUNT_TYPE_M_FT', $document)?></b><br/>
							<?=element('ACCOUNT_NO_N', $document)?> 
							<small class="hidden"><?=element('DREREFERENCE', $document)?></small>							
						</a>
					</li>	
					<?php			
					}		
					
					?>
					<?php			
					}		
					?>
					<li class="noresults">
						No accounts found...
					</li>
				</ul>
			</div> -->
		</form>
	</div>
<?php 
	}else{
	?>	
	<div class="no-content"></div>
<?php	
}
?>
	
		


