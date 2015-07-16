<?php 
/*
* @Title: Advanced Search
* @Method: Search 
* @icon: fa-gear fa-cog
* @description: Advanced Search widget for Search Page
*/ 
?>

<?php 	
/** 
	Received Parameters:
	$widget_key
	$meta_key
	$search_parameters
**/

	
	/** Get Widget options if there is **/
	$options 			= $this->application->get_settings($meta_key);	
	$filter_options		= array_key_exists('filter', $options)? element('filter', $options): array();	
	
	/** Massage data for display **/
	$minscore 			= element('minscore', $search_parameters);
	$mindate 			= element('mindate', $search_parameters);
	$maxdate 			= element('maxdate', $search_parameters);
	$databasematch		= array_key_exists('databasematch', $search_parameters) && !empty($search_parameters['databasematch']) ? 
							array_values($search_parameters['databasematch']): 
							array();	
							
	$databases 			= $this->application->get_databases($search_settings);
	
	
	$_daterange 		= element('daterange', $search_parameters);
	if($_daterange){
		$daterange	 	=array();	
		$daterange 		= explode("-", $_daterange);
		$maxdate 		= array_pop($daterange);
		$maxdate 		= $maxdate? trim($maxdate) : '';
		$mindate 		= array_pop($daterange);
		$mindate 		= $mindate? trim($mindate) : '';
	}
	

/** Form attributes **/
$attributes = array('class' => 'form-horizontal');

/** Synonym True/False **/
$hidden 	= array(
				'synonym' => 'false'
			);
echo form_open('search/?'. http_build_query($_GET), $attributes, $hidden); 
?>				
		<?php if(element('sources', $filter_options) == 1) :?>
		<div class="box box-solid checkbox-group">
			<div class="box-header with-border">
				<span class="checkbox checkbox-warning m-l-0 p-t-0 pull-left ">
					<input type="checkbox" class="checkbox-all" />
					<label></label>
				</span>
				<h4 class="box-title">					
					Sources
				</h4>
				<div class="box-tools pull-right">
					<button class="btn btn-warning btn-xs btn-flat" type="submit">Submit</button>
				</div>
			  </div>
			<div class="box-body ">
				<div class="row">
				<?php 
					if($databases){
					$database = element('database', $databases);
					$database = array_chunk($database, ceil(count($database)/2));
					
					foreach($database as $key=>$db):						
					echo '<div class="col-md-6">';
						foreach($db as $k=>$src):	
				?>							
					<div class="checkbox checkbox-primary m-l-0">														
						<input type="checkbox" 
							id="databasematch-<?=element('name', $src)?>" name="databasematch[]" 
							value="<?=element('name', $src)?>" 
							class="" <?php echo in_array(element('name', $src), $databasematch)? 'checked': ''; ?>/>
						<label for="databasematch-<?=element('name', $src)?>"><?=element('name', $src)?></label>
					</div>	
				<?php
						endforeach;
					echo '</div>';
					endforeach;
					}						
				?>
				</div>
			</div>
		</div>
		<?php endif;?>
		
		
		
		<?php if(element('synonym', $filter_options) == 1) :?>
		<div class="form-group">
			<label for="synonym" class="control-label col-md-4">Synonym Search</label>
			<div class="col-md-8 checkbox">
				 <?php	
				$data = array(
				'name'        => 'synonym',
				'id'          => 'synonym',
				'value'       => 'true',
				'checked'     => (bool) strcasecmp('true', element('synonym', $search_parameters)) == 0,
				'style'       => 'margin:10px',
				'class'		  => 'm-0 p-absolute',
				'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
				);
				echo form_checkbox($data); ?>
			</div>
		</div>	
		<?php endif;?>
		
		
		<?php if(element('minscore', $filter_options) == 1) :?>
		<div class="form-group">
			<label for="minscore" class="control-label col-md-4">Score</label>
			<div class="col-md-8">
				<div class="dark-slider m-r-10" >
					<input type="text" name="minscore" class="w-100"
					data-slider-orientation="horizontal" 
					data-bind="BootstrapSlider: {
						ticks: [0, 50, 100],
						ticks_labels: ['100%', '50%', '0'],
						ticks_snap_bounds: 1,
						tooltip: 'always',
						reversed: true,
						value: <?=$minscore?$minscore:0?>
					}"/>
				</div>
			</div>
		</div>	
		<?php endif;?>
		
		
		<?php if(element('daterange', $filter_options) == 1) :?>
		<div class="form-group">
			<label for="daterange" class="control-label col-md-4">Date Range</label>
			<div class="col-md-8">
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
		</div>	
		<?php endif;?>
		
	<div class="box-footer clearfix text-center">
	  <button class="btn btn-warning btn-sm btn-flat" type="submit">Submit</button>
	</div>
<?php echo form_close(); ?>
