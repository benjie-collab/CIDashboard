<h4 class="page-header">
	<?php echo lang('search_heading');?>
	<small><?php //echo lang('search_subheading');?></small>
</h4>

<?php //echo $breadcrumb; ?>
<?php 
	
?>
<?php 
$attributes = array('class' => '');			 
echo form_open('/search/index', $attributes); ?>
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

	<?php echo (!$message)? '':  $message;?>

		
		<?php
			if(!empty($results)):
		
			$res = array_shift($results);
			$action = $res['action']['$'];
			$response = $res['response']['$'];
			$responsedata = $res['responsedata'];
			$numhits = array_shift($responsedata['autn:numhits']);
		?>
		
		<h5 class="page-header m-t-30">
			<span class="badge pull-left m-r-10"><?=$numhits?></span>	
			<?php echo lang('search_result_heading');?>					
		</h5>		
		<?php		
			$counter=0;
			$autnhit = array();
			$autnhit = ($numhits > 0)? ($numhits > 1)? $responsedata['autn:hit'] : array( 0 => $responsedata['autn:hit']) : null ;
			
			if($autnhit):				
				foreach($autnhit as $key=>$res):			
				$document = $res['autn:content']['DOCUMENT'];	
				$sentiment = (array_key_exists('OVERALL_VIBE',$document))? array_shift($document['OVERALL_VIBE']): 'Neutral';
				$sentiment_class = strcmp($sentiment, 'Negative')!==0? strcmp($sentiment, 'Neutral')===0? 'warning': 'primary' : 'danger';
				$sentiments = array();
				
				$i=0;
				if(array_key_exists('NEGATIVE_VIBE_VALUE',$document))
				foreach($document['NEGATIVE_VIBE_VALUE'] as $value) {
					$sentiments['negative'][] = array_merge((array) array_shift($value),(array)array_shift($document['NEGATIVE_VIBE_SCORE'][$i]));
					$i++;
				}
				$i=0;
				if(array_key_exists('POSITIVE_VIBE_VALUE',$document))
				foreach($document['POSITIVE_VIBE_VALUE'] as $value) {
					$sentiments['positive'][] = array_merge((array) array_shift($value),(array)array_shift($document['POSITIVE_VIBE_SCORE'][$i]));
					$i++;
				}
				
			?>
			
			
					<div class="media o-visible m-b-20">
					  <div class="media-left">
						<a href="#">
						  <img alt="64x64" data-src="holder.js/64x64" class="media-object" style="width: 64px; height: 64px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PGRlZnMvPjxyZWN0IHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjEyLjUiIHk9IjMyIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9nPjwvc3ZnPg==" data-holder-rendered="true">
						</a>
					  </div>
					  <div class="media-body o-visible ">
						<span class="label label-warning pull-left m-t-3 m-r-5"><?=array_shift($res['autn:weight'])?></span>						
						<ul class="list-inline pull-right">
							<li>
								<input data-toggle="tab" data-target="#document-sentiments-<?=$key?>" data-bind="BootstrapSwitch:{ size: 'mini', labelText: 'Sentiments' }" checked type="checkbox"/>
							</li>
							<li data-toggle="popover" data-placement="top" 
								data-trigger="hover" 
								data-container="body" 
								data-content="Switch to summary sentiment view">								
								<div class="btn-group" data-toggle="buttons">
									<label class="btn btn-info btn-xs m-0 active" data-toggle="tab" data-target="#document-summary-<?=$key?>">
										<input type="radio" name="document-sentiments" id="document-sentiments" value="document-summary-<?=$key?>" checked=""/>
									<i class="fa fa-align-justify"></i> </label>
									<label class="btn btn-warning btn-xs m-0" data-toggle="tab" data-target="#document-sentiments-<?=$key?>">
										<input type="radio" name="document-sentiments" id="document-sentiments" value="document-sentiments-<?=$key?>"/>
									<i class="fa fa-tasks"></i> </label>
								</div>
							</li>
							<li class="dropdown pull-right active">
								<a class="dropdown-toggle text-muted" data-toggle="dropdown"><i class="fa fa-chevron-down"></i></a>
								 
								<ul class="dropdown-menu">
									<li class="active">
										<a data-toggle="tab" href="#document-summary-<?=$key?>">
											<i class="fa fa-align-left"></i>
											Summary
										</a>
									</li>
									<li>
										<a data-toggle="tab" href="#document-sentiments-<?=$key?>">
											<i class="fa fa-tasks"></i>
											Sentiments
										</a>
									</li>
								</ul>
							</li>
						</ul>
						<h4 class="media-heading">						
							<?=array_key_exists('TITLE', $document)?array_shift($document['TITLE']):''?>
						</h4>
						<ul class="list list-inline ">
							<li>
								<a href="#" class="document-meta text-muted">
								<?=array_key_exists('autn:database', $res)?array_shift($res['autn:database']):''?></a>
							</li>
							<li>
								<a href="#" class="document-meta text-muted">
								<?=array_key_exists('CONTENT-TYPE', $document)?array_shift($document['CONTENT-TYPE']):''?></a>
							</li>
							<li>
								<a href="#" class="document-meta text-muted">
								<?=array_key_exists('DOCUMENTSIZE', $document)?array_shift($document['DOCUMENTSIZE']):''?></a>
							</li>
							<li>
								<a href="#" class="document-meta text-muted text-<?=$sentiment_class?>" 
								data-placement="top" 
								data-toggle="tooltip" 
								title="<?=$sentiment?> Overall Sentiment"><i class="fa fa-comments-o"></i> <?=$sentiment?></a>
							</li>
						</ul>
						
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="document-summary-<?=$key?>">
								<p>
									<?=array_key_exists('DRECONTENT', $document)?array_shift($document['DRECONTENT']):''?>
								</p>
							</div>
							<div role="tabpanel" class="tab-pane fade " id="document-sentiments-<?=$key?>">
							<div class="p-t-20">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="panel panel-default">
											<div class="panel-heading p-10">
												<h6 class="panel-title">
													<span><i class="fa fa-plus-circle"></i> Positive Sentiments</span>
													<a class="pull-right" data-toggle="popover" data-placement="top" data-trigger="hover" data-container="body" data-content="Drag sentiments to change."><i class="fa fa-info-circle"></i></a>
												</h6>
											</div>
											
											<div class="panel-body p-5">
											<ol class="list-unstyled draggable-sentiments sentiments-positive draggable-sentiments-<?=$counter?>" data-bind="jQuerySortable:{ group: 'draggable-sentiments-<?=$counter?>'}">
											<?php if(array_key_exists('positive', $sentiments)):?>	
											<?php foreach($sentiments['positive'] as $key=>$val): ?>
												<li class="m-5">
													<div class="bg-info p-5">
														<span class=""><i class="fa fa-arrows"></i></span>
														<?=$val[0]?>	
													</div>											
												</li>
											<?php endforeach;?>	
											<?php endif;?>
											</ol>		
											</div>	
										</div>
										
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="panel panel-default">
											<div class="panel-heading p-10">
												<h6 class="panel-title">
													<span><i class="fa fa-minus-circle"></i> Negative Sentiments</span>
													<a class="pull-right" data-toggle="popover" data-placement="top" data-trigger="hover" data-container="body" data-content="Drag sentiments to change."><i class="fa fa-info-circle"></i></a>
												</h6>
											</div>
											
											<div class="panel-body p-5">
											<ol class="list-unstyled draggable-sentiments sentiments-negative draggable-sentiments-<?=$counter?>" data-bind="jQuerySortable:{ group: 'draggable-sentiments-<?=$counter?>'}">
											<?php if(array_key_exists('negative', $sentiments)):?>	
											<?php foreach($sentiments['negative'] as $key=>$val): ?>
												<li class="m-5">
													<div class="bg-danger p-5">
														<span class=""><i class="fa fa-arrows"></i></span>
														<?=$val[0]?>	
													</div>											
												</li>
											<?php endforeach;?>	
											<?php endif;?>
											</ol>		
											</div>	
										</div>
																	
										
									</div>
								</div>
							</div>
									
										
								
								
							</div>
							<div role="tabpanel" class="tab-pane fade" id="document-metadata-<?=$key?>">...</div>
						</div>
					  </div>
					</div>
					
			<?php	
				$counter++;
				endforeach;
				endif;
			endif;
		?>
		<div class="text-center"><?=$pagination;?></div>
		
	


