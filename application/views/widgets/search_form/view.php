<?php 
/*
* @Title: Search Form
* @Method: Search
* @icon: fa-search
* @Description: Search form for search. With auto-suggest feature. Configure the view accordingly.
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

	$query_settings = $search_parameters;
	$text 		= array_key_exists('text', $query_settings) && strcasecmp(element('text', $query_settings), '*')!==0? 
				element('text', $query_settings): '';


$hidden = array();
$suggest = element('suggest', $options);				
$databasematch = element('databasematch', $suggest)? element('databasematch', $suggest): array();
$attributes = array('class' => 'navbar-form');?>

<header class="main-header">
	<a class="logo" 		
		href="javascript:void(0)">
		<b><i class="fa <?=element('icon', $options)? element('icon', $options) : 'fa fa-search' ?>"></i></b>
		<?=element('title', $options); ?></a>
		
	<nav role="navigation" class="navbar navbar-static-top">
	 <?php echo form_open( current_url(), $attributes, $hidden); ?>	
		
		
		<div class="navbar-left">				
			<div class="form-group has-feedback">
			  <input id="customer-search-input-2"
				data-bind=
				"TypeAhead:{
					ajax: {
							url: '<?=base_url('search/query')?>',
							source: 'autn:content',
							params: {
								print: 'all',
								databasematch: '<?=join(',', $databasematch)?>',
								server: '<?=element('server', $query_settings)?>'
							}								
						},	
					display: 'NRIC_M_FT',								
					templates: {
						empty: [
							  '<div class=\'empty-message text-danger p-t-5 p-b-5 p-l-10 p-r-10\'>',
								'Can&prime;t find customer...',
							  '</div>'
							].join('\n'),
						suggestion:  function(data) {													
										return '<div><strong>' + data.NAME_M_FT + '</strong> – ' + data.NRIC_M_FT + '</div>';
									}
					  }
				}" 					
				type="text" class="form-control" placeholder="<?=element('placeholder', $options)?>" name="text" value="<?php echo set_value('text', $text); ?>"/>
			  
			  
			  <span class="form-control-feedback"><i class="fa fa-search text-muted"></i></span>			  
			</div>
			<button type="submit" class="btn btn-flat btn-outline">
				<?=element('button_label', $options)? element('button_label', $options): 'Search'?>
			</button>	
		</div>
	  <?php echo form_close(); ?>
	  
	</nav>
</header>