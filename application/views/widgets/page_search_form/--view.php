<?php 
/*
* @Title: Search Form
* @Method: Pages
* @icon: fa-search
* @Description: Search form for page. With various filters.
*/ 
?>

<?php 	
/** 
	Received Parameters:
	$widget_key
	$query_settings
**/

	$mode 	  		= $this->application->get_mode('pages_mode');	
	$options 		= $this->application->get_settings($widget_key);


/** Clean search query for display **/
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
$tagnames = array_get_value($tagnames, 'autn:name');	

$hidden = array();
$attributes = array('class' => 'navbar-form');?>
<header class="main-header">
	<?php if($mode){ ?>
	<div class="removable-widget-tools">
		<ul class="list list-inline m-0">
			<li class="<?=$mode? 'handle':'hidden'?>">
				<span class="btn text-muted cursor-move">
					<i class="fa fa-ellipsis-v "></i> 
					<i class="fa fa-ellipsis-v "></i> 
				</span>
			</li>
			<li class="<?=($mode? '':'hidden')?>">
				<a class="btn " 
					data-toggle="modal"
					data-target="#modal-widget-options"
					data-remote="<?=base_url('app/widget_options/?widget=' . $widget_key . '&title=' . urlencode('Form Options'))?>">
					<i class="fa fa-cog"></i>
				</a>
			</li>
			<li class="<?=($mode? '':'hidden')?>">
				<a class="btn delete-widget-confirm" data-url="<?=base_url('/app/delete_widget')?>">
					<i class="fa fa-trash"></i>
				</a>
			</li>
			<li><a class="btn"><i class="fa fa-expand"></i></a></li>
		</ul>
	</div>
	<?php } ?>

	<a class="logo" 
		data-toggle="popover"
		data-placement="auto"
		data-trigger="hover"
		data-title="Description"
		data-content="<?=element('page_desc', $page); ?>"
		data-html="true"
		href="javascript:void(0)">
		<b><i class="ion-ios-albums-outline"></i></b>
		<?=element('page_name', $page); ?></a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav role="navigation" class="navbar navbar-static-top">
	 <?php echo form_open('/search/?'.http_build_query($_GET), $attributes, $hidden); ?>	
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
		unset($tagnames[0]);
		foreach($tagnames as $tg){
			$name = end(explode('/', $tg ));			
			$tagvalues = $this->tags_model->call_get_tag_values(
						array(
							'fieldname'=> $name
						));
			$tagvalues = array_get_value($tagvalues, 'autn:value');	
			
		?>
			<div class="form-group">		
				<?php 
				$elements = $tagvalues? array_combine($tagvalues,$tagvalues): array();
				array_unshift($elements, '-' . $name . '-');
				$atts = 'class="form-control " data-container="body" data-max-options="5" data-size="5"';
				$selected = array_key_exists($name, $options)? $options[$name] : '';
				echo form_dropdown('fieldtext[]', $elements, $selected, $atts);
				?>
			</div>		
		<?php		
		}
		?>	
		<div class="navbar-right">				
			<div class="form-group has-feedback">
			  <input type="text" class="form-control" placeholder="Serch" name="text" value=""/>
			  <span class="form-control-feedback"><i class="fa fa-search text-muted"></i></span>			  
			</div>
			<button type="submit" class="btn btn-flat btn-outline">
				Search
			</button>	
		</div>
	  <?php echo form_close(); ?>
	  
	</nav>
</header>