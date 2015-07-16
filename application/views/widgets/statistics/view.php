<?php 
/*
* @Title: Statistics
* @Method: - 
* @icon: fa-area-chart
* @Description: Search result pagination. Configure the view accordingly.
*/ 
?>


<?php 
$mode 	  			= $this->application->get_mode('search_mode');
?>


<div class="page-header">
<?php 
$attributes = array('class' => '');			 
echo form_open('/search/preview', $attributes); ?>
	<nav class="navbar navbar-toolbar navbar-default m-b-0">
	  <div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".search-menu">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a href="#" class="navbar-brand"><?php echo lang('search_heading');?></a>
			</div>
			
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse search-menu">		
				<div class="navbar-form navbar-left">
					<div class="form-group has-feedback">
					  <input data-bind="TypeAhead:{
						ajax: '<?=base_url()?>index.php/typeahead/index'
						
						}
					  " type="text" class="form-control" placeholder="e.g. 'service disruption'" size="50" name="text" value="<?php echo set_value('text', $text); ?>"/>
					  <span class="form-control-feedback"><i class="fa fa-search text-muted"></i></span>
					  
					  
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			
			  <ul class="nav navbar-nav navbar-right m-r-0">
				<li class="dropdown ">
				  <a href="#" class="collapsed" data-toggle="collapse" data-target="#search-options" >Settings <i class="fa fa-cog"></i></a>			 
				</li>
			  </ul>
			</div><!-- /.navbar-collapse -->
			
		</div><!-- /.container-fluid -->
	</nav>
	<div id="search-options" class="collapse ">
		<div class="row well p-10 m-0">
			<div class="col-md-3">
				<fieldset>
				<label>Sources</label>
				
				<?php 
					foreach($sources as $key=>$src):				
				?>
					<div class="form-group">
					  <div class="checkbox checkbox-primary m-l-10">
						<input type="checkbox" id="databasematch-<?=$key?>" name="databasematch[]" value="<?=$src?>" class="m-0 p-absolute" <?php echo in_array($src, $databasematch)? 'checked': ''; ?>/>
						<?php //echo form_checkbox('databasematch[]', $key, set_checkbox('databasematch[]', $key), 'id="databasematch-' . $key . '" class="m-0 p-absolute"'); ?>
						<label for="databasematch-<?=$key?>" class="text-capitalize"><?=$src?></label>
					  </div>
					</div>
					
				<?php
					endforeach;			
				?>
				</fieldset>
			</div>
			<div class="col-md-3">
				<fieldset>
				<label>Relevancy</label>
				<div class="form-group">
					<input type="text" id="" value="75" class="span12" 					
					data-slider-min="25" 
					data-slider-value="[75,95]" 
					data-slider-orientation="vertical" 
					data-slider-max="100" 
					data-bind="Slider: { orientation: 'vertical', min: 1, max: 10, step: 1, value: 75  }"/>
				</div>
				</fieldset>
			</div>
	  </div>
	</div>
<?php echo form_close(); ?>
</div>