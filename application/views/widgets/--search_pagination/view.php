<?php 
/*
* @Title: Pagination
* @Method:  
* @icon: fa-sort-numeric-asc 
* @Description: Search result pagination. Configure the view accordingly.
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
	$data_options 	= array_key_exists('data', $options)? element('data', $options): array();		
	

$config 					=  $this->application->get_config('pagination','pagination');
$saved_settings			 	= $this->usermeta_model->get_usermeta(0, array( 'meta_key' => 'pagination_settings'));


/** Pagination **/
$totalresults 				= array_key_exists('autn:totalhits', $responsedata)?  element('autn:totalhits', $responsedata ): 0;	
$numhits 					= array_key_exists('autn:numhits', $responsedata)?  element('autn:numhits', $responsedata ) : 0;
$pagination					=  $this->search_model->get_pagination(
											array_merge(
												$config,
												$saved_settings,
												array( 
													'total_rows' => $totalresults, 
													'per_page' => $query_settings['maxresults']
												)
											)
								);
$info						=
								$this->search_model->get_pagination_info(
											array( 
													'total_rows' 	=> intval($totalresults), 
													'per_page' 		=> intval($query_settings['maxresults']),
													'page' 			=> intval($page),
													'start' 		=> intval($query_settings['start']),
												)
										);
							

?>

<div class="pagination-container text-center p-t-3 m-b-3">	
	<?=$pagination;?><br/>
	<?=$info;?>	
</div>