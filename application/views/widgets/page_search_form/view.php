<?php 
/*
* @Title: Search Form
* @Method: Pages
* @icon: fa-search
* @Description: Search form for page. With various filters.
*/ 
?>
<?php
/* 
	Parameters
		widget_key		(required)
		query_settings
*/

		$is_page 	= $this->application->is_page();
		$options 	= isset($meta_key)? $this->application->get_settings($meta_key) : array();

		$text 		= array_key_exists('text', $query_settings) && strcasecmp(element('text', $query_settings), '*')!==0? 
					  element('text', $query_settings): '';

				
				
		$is_query 	= $query_settings ? true: false;
$_daterange 		=  isset($query_settings)? element('daterange', $query_settings): NULL;
if($_daterange){
	$daterange	 	= array();	
	$daterange 		= explode("-", $_daterange);
	$maxdate 		= array_pop($daterange);
	$maxdate 		= $maxdate? trim($maxdate) : '';
	$mindate 		= array_pop($daterange);
	$mindate 		= $mindate? trim($mindate) : '';
}
$tagnames = $this->tags_model->call_get_tag_names(
			array(
				'fieldtype'=> 'parametric'
			));
$tagnames = array_key_exists('autn:name', $tagnames)? element('autn:name', $tagnames) : array();	




$hidden = array( 'server' => element('server',$page) );

$suggest = element('suggest', $options);				
$databasematch = element('databasematch', $suggest)? element('databasematch', $suggest): array();
?>

<div id="modal-page-search-form" class="modal modal-static" data-show="<?=element('floating', $options) && !$is_query ? 'true': 'false'?>">	
	<div class="modal-dialog modal-lg" style="">
		<div class="modal-content">
			<div class="modal-header">
				<button data-dismiss="modal" class="close <?=$text? '' : 'hidden'?>" type="button"><span>×</span></button>
				<h4 class="modal-title">
				<i class="fa <?=element('icon', $options)? element('icon', $options) : 'ion-ios-albums-outline' ?>"></i>
				<?=element('title', $options)? element('title', $options) : '' ?>
				</h4>
			  </div>
			<div class="modal-body">
				<?php 
				$attributes = array(
					'class' => '',
					'method' => 'GET'
				);
				
				echo form_open( current_url(). '?' . http_build_query($_GET), $attributes, $hidden); ?>	
					<div class="input-group input-group-lg">
						<div class="form-group has-feedback">						 
						  <input id="customer-search-input-1"
							data-bind=
							"TypeAhead:{
								ajax: {
										url: '<?=base_url('search/query')?>',
										source: 'autn:content',
										params: {
											print: 'all',
											databasematch: '<?=join(',', $databasematch)?>',
											server: '<?=element('server',$page)?>'
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
							type="text" class="form-control input-lg" placeholder="<?=element('placeholder', $options)?>" name="text" value="<?php echo set_value('text', $text); ?>"/>
							<span class="form-control-feedback m-t-5"><i class="fa fa-microphone text-muted"></i></span>
							<span class="form-control-feedback m-t-5 m-r-20 typeahead-spinner"><i class="fa fa fa-spinner fa fa-spin text-muted"></i></span>
						</div>
						<span class="input-group-btn">
						  <button type="submit" class="btn btn-info btn-flat btn-xl"><?=element('button_label', $options)? element('button_label', $options): 'Search'?></button>
						</span>
					</div>
				<?php echo form_close(); ?>
			</div>
			<div class="modal-footer text-left">
				<i class="fa fa-info-circle"></i> Search for customer name or provide <b>exact</b> customer NRIC
			</div>
		</div>
	</div>
</div>

<?php 
	$attributes = array(
		'class' => 'navbar-form',
		'method' => 'GET'
	);
?>

<header class="main-header">
	<a class="logo" 
		data-toggle="popover"
		data-placement="auto"
		data-trigger="hover"
		data-title="Description"
		data-content="<?=element('page_desc', $page); ?>"
		data-html="true"
		href="javascript:void(0)">
		<b><i class="fa <?=element('icon', $options)? element('icon', $options) : 'ion-ios-albums-outline' ?>"></i></b>
		<?=element('page_name', $page); ?></a>
		
	<nav role="navigation" class="navbar navbar-static-top">
	 <?php echo form_open( current_url(), $attributes, $hidden); ?>	
		<div class="form-group">
			<?php $data = array(
				  'name'        => 'daterange',
				  'id'          => 'daterange',							  
				  'class'		=> 'form-control',
				  'value'		=> ($_daterange)?$mindate . ' - ' . $maxdate : '' ,
				  'placeholder'	=> 'DD/MM/YYYY - DD/MM/YYYY',
				  'data-bind'	=> 'BootstrapDateRangePicker:{format:\'DD/MM/YYYY\'}'
				);

			echo form_input($data); ?>
		</div>
		
		
		<?php 
		/**
		$fieldtext =array_key_exists('fieldtext', $query_settings)?  element('fieldtext', $query_settings) : array() ;
		foreach($tagnames as $i=>$tg){
			$name = end(explode('/', $tg ));			
			$tagvalues = $this->tags_model->call_get_tag_values(
						array(
							'fieldname'=> $name
						));
			$tagvalues = array_get_value($tagvalues, 'autn:value');	
			**/
		?>
			<!--
			<div class="form-group">		
				<?php 
				/**
				$elements = $tagvalues? array_combine($tagvalues,$tagvalues): array();
				$atts = 'class="form-control selectpicker" data-container="body" data-max-options="3" data-size="5" multiple title="' . '-' . $name . '-' . '"';	
				$selected =  array_key_exists($name, $fieldtext)? element($name,$fieldtext) : array() ;
				echo form_dropdown('fieldtext[' . $name . '][]', $elements, $selected, $atts);**/
				?>
			</div>	-->	
		<?php		
		//}
		?>	
		<div class="navbar-right">				
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
								server: '<?=element('server',$page)?>'
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