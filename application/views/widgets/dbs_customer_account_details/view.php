<?php 
/*
* @Title: DBS Account Details
* @Method: Pages
* @icon: fa-info-circle
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
	$page 			= $this->session->userdata('current_page');
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
					//$query_config,
					$query_options,
					array(
						'fieldtext' => $match,
						'server' => $page->server,
						'action' => 'query',
						'print' => 'all'
					)
					);
		$results = $this->idol->QueryAction($query);
		$results = clean_json_response($results);
	}	
	
	$numhits 	= array_get_value($results, 'autn:numhits');
	$document_options = $this->application->get_config('document_options', 'template');	
	
	$hit 		= array_get_value($results, 'autn:hit');	
	$accounts 	= intval($numhits)===1? array( 0 => $hit) : $hit;
?>
	
	
	


	<?php if($accounts){ ?>
	
		<div data-bind="CustomScrollbar: { axis:'y', theme:'dark', setHeight: 350 }" class="box-body">
				<?php 
				if($accounts)			
				foreach($accounts as $key=>$acct){
				$document 	= array_get_value($acct, 'DOCUMENT');
				$link = array_merge(
						$_GET, 
						array( 'DREREFERENCE' => element('DREREFERENCE', $document))
						);
				?>
					<table class="table no-margin table-striped table-condensed">
					 <tbody>
					<?php 
					
					foreach($document as $key=>$dm){			
					?>                     
						<tr>
						  <th><?=$key?>: </th>
						  <td><?=$dm?></td>                          
						</tr>		
					<?php			
					}				
					?>
					</tbody>
					</table>			
				<?php			
				}				
				?>
		</div>
		<div class="box-footer clearfix">
		  <a class="btn btn-sm btn-default btn-flat pull-right <?=$accounts? '' : 'disabled'?>" href="javascript::;">View All Details</a>
		</div>
	<?php 
		}else{
	?>	
		<div class="box-body">	
			<?=$this->application->get_config('info_start_delimiter', 'template')?>
			Account not found...
			<?=$this->application->get_config('info_end_delimiter', 'template')?>
		</div>
	<?php 
		}
	
	}else{	
	
	echo '<div class="no-content"></div>';
	}
?>