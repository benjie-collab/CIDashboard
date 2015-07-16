<?php 
/*
* @Title: Best Terms
* @Method: Document 
* @icon: ion ion-ios-keypad-outline
* @Description: Best Document terms from a document. Displayed as cloud view.
*/ 
?>

<?php 	
/** 
	Received Parameters:
	$widget_key
	$meta_key
	$query_settings
**/

	
	/** Get Widget options if there is **/
	$options 			= $this->application->get_settings($meta_key);	
	
	
	$_response 		= element('autnresponse', $document);
	$_responsedata 	= element('responsedata', $_response);
	$_numhit 		= element('autn:numhits', $_responsedata);
	$_autnhit     	= element('autn:hit', $_responsedata);
	$_autnid     	= element('autn:id', $_autnhit);
	
	$params = array(
				'id' => $_autnid	
				);
?>

		<?php 
			$atts = array('class' => '');			 
			echo form_open('/search/?'. http_build_query($_GET), $atts); 
		?>
		
		<div id="tag-cloud" class="widget widget-md" data-bind="D3TagCloud:
			{ 
				ajax: '<?=base_url('/terms/get_best/?' . http_build_query($params))?>',				
				height: 300,
				fontMin: '<?=element('fontmin', $options)?>', 
				fontMax: '<?=element('fontmax', $options)?>',
				min:  '<?=element('min', $options)?>',
				max:  '<?=element('max', $options)?>',
				font: '<?=element('font', $options)?>',
				padding: '<?=element('spacing', $options)?>',
				click:  function(d){
					$(this).closest('form')
					.append('<input type=\'hidden\' name=\'text\' value=\'' + d.text + '\'/>')
					.trigger('submit');
				}
			
			}
			"></div>
		<?php echo form_close(); ?>
