<?php 
/*
* @Title: Term Synonyms
* @Method: Search 
* @icon: fa-text-width fa
* @Description: Only visible if Synonym search is enabled from advanced search and if current search term has synonyms.
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


	
	$synonym 			= element('synonym', $query_settings);
	$text 				= 	array_key_exists('text', $query_settings) && strcasecmp($query_settings['text'], '*')!==0? 
							$query_settings['text']: '';
	$synonyms = array();
	$autnlinks = '';
	
						



if((bool) strcasecmp('true', element('synonym', $query_settings)) == 0 && $text){
	$autnhit = array();
	if(!empty($responsedata)){
		$autnhit = array_get_value($responsedata, 'autn:hit');	
	}	
	if(is_array($autnhit))
	$autnhit = array_pop($autnhit);
	$autnlinks = array_get_value($autnhit, 'autn:links');	
	
	
	$termexpand = $this->terms_model->call_term_expand(
						array(
							'text' => $autnlinks,
							'termdetails'=> true,
							'expansion' => 'synonym'
						)	
					);
	$autnterm = array_get_value($termexpand, 'autn:term');
	
	if($autnterm){
		if(!is_array($autnterm))
		array_push($synonyms, $autnterm);
		else
		$synonyms = $autnterm;	
	}
}	
	
	
if($synonyms)	{	
	$attributes = array('class' => '');
?>

		<p class="text-center">'<i><?=$text?></i>'</p>
		<b>Also showing results for:</b><br/><br/>
		<ul class="list-inline text-center">
			<?php 
				$template = join('', array(
						'<div class=\'popover synonym-popover\' role=\'tooltip\'>',
						'<div class=\'arrow\'></div>',
						'<h3 class=\'popover-title\'></h3>',
						'<div class=\'popover-content p-0\' style=\'height: 150px\'>',
						'</div>',
						'</div>'
						));
			
			
				foreach($synonyms as $syn ):
				
					if(strcasecmp($syn, $text) != 0)
					echo '<li class="synonym synonym-init m-l-5 m-r-5 m-b-3" 
							data-placement="top"
							data-html="true"
							data-template="' . $template . '"
							title="Synonyms for <i>' . $syn . '</i>"
							data-text="' . $autnlinks . '"
							data-toggle="popover" data-content="' . $autnlinks . '">' . strtolower($syn) . '</li>';
				
				
				endforeach;
			?>
		
		</ul>			
<?php 
}?>
