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
	$query_settings
**/

	/** Get mode **/
	$mode 	  			= $this->application->get_mode('search_mode');	
	/** Get Widget options if there is **/
	$options 			= $this->application->get_settings($widget_key);
	
	
	/** Massage data for display **/
	$minscore 			= element('minscore', $query_settings);
	$mindate 			= element('mindate', $query_settings);
	$maxdate 			= element('maxdate', $query_settings);
	$databasematch		= array_key_exists('databasematch', $query_settings) && !empty($query_settings['databasematch']) ? 
							array_values($query_settings['databasematch']): 
							array();	
	$databases 			= $this->application->get_databases();
	$_daterange 		=  element('daterange', $query_settings);
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
echo form_open('/search/?'. http_build_query($_GET), $attributes, $hidden); 
?>					
<div class="box box-solid o-hidden">	
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
					data-remote="<?=base_url('app/widget_options/?widget=' . $widget_key . '&title=' . urlencode('Advanced Search Options'))?>">
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
	<div class="box-header with-border">
	   <h3 class="box-title"><?=element('title', $options)?></h3>
	  <div class="box-tools pull-right">		
		<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>	
	  </div>	  
	</div>
	<div class="box-body">			
		<?php if(intval(element('sources', $options))===1) :?>
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
		
		
		
		<?php if(intval(element('synonym', $options))===1) :?>
		<div class="form-group">
			<label for="synonym" class="control-label col-md-4">Synonym Search</label>
			<div class="col-md-8 checkbox">
				 <?php	
				$data = array(
				'name'        => 'synonym',
				'id'          => 'synonym',
				'value'       => 'true',
				'checked'     => (bool) strcasecmp('true', element('synonym', $query_settings)) == 0,
				'style'       => 'margin:10px',
				'class'		  => 'm-0 p-absolute',
				'data-bind'	=> 'BootstrapSwitch:{ size: \'mini\' }'
				);
				echo form_checkbox($data); ?>
			</div>
		</div>	
		<?php endif;?>
		
		
		<?php if(intval(element('minscore', $options))===1) :?>
		<div class="form-group">
			<label for="minscore" class="control-label col-md-4">Score</label>
			<div class="col-md-8 checkbox">
				<div class="dark-slider w-100" >
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
		
		
		<?php if(intval(element('daterange', $options))===1) :?>
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
	</div>
	<div class="box-footer clearfix text-center">
	  <button class="btn btn-warning btn-sm btn-flat" type="submit">Submit</button>
	</div>
</div>
<?php echo form_close(); ?>
