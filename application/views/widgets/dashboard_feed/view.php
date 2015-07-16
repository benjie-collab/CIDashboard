<?php 
/*
* @Title: Feed
* @key: dashboard_feed
* @Method: Profile 
* @icon: ion-ios-paper-outline
* @Description: Feed widget for dashboard. With selections from predefined Feed Rules.
*/ 
?>


<?php 
	$mode 				=  $this->application->get_mode('dashboard_mode');	
	$query_parameters 	=  $this->application->get_config('query', 'actions');	
	$options			= $this->application->get_settings($widget_key);	
	$feed				= $this->rules_model->get_rule(element('feed', $options));
	$feed_setting 		= unserialize(element('rule_settings', $feed));	
	$keywords 			= element('keywords',$feed_setting );	

	$query_settings = array_merge(
							$query_parameters,	
							$this->usermeta_model->get_usermeta(0, array( 'meta_key' => 'settings_query_query')),
							array(
								'text' => $keywords,
								'maxresults' => 5
								)
							);
				
	$results 			= $this->search_model->call_search($query_settings);	
		
	
if(!empty($results)):	
	$responsedata 		= clean_json_response(get_responsedata($results));
	$numhits 			= array_key_exists('autn:numhits', $responsedata)? element('autn:numhits', $responsedata) : 0;	
	$default_elements	= array_keys($this->document_lib->default_elements());
?>


<div class="box box-success o-hidden">	
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
					data-remote="<?=base_url('/app/widget_options?widget=' . $widget_key . '&title=' . urlencode('Feed Options'))?>">
					<i class="fa fa-cog"></i>
				</a>
			</li>
			<li><a class="btn"><i class="fa fa-expand"></i></a></li>
		</ul>
	</div>
	<?php } ?>
	
	<div class="box-header with-border">
		<h3 class="box-title"><?=element('title', $options)?> </h3>	
		<div class="box-tools pull-right">
			<span class="badge bg-yellow"><?=$numhits?></span>
		</div>
	</div><!-- /.box-header -->
	<?php		
	
	$autnhit = ($numhits > 0)?
					($numhits > 1)? 
						element('autn:hit', $responsedata) 
						: array( 0 => element('autn:hit', $responsedata)) 
				: null ;
	?>
	<div class="box-body">	
		<div data-bind="SlimScroll: {height: 350}">
			<?php 		
			if($autnhit):		?>
			<ul class="products-list product-list-in-box m-b-20">
			<?php
			foreach($autnhit as $key=>$autnhit):
			$autncontent = element('autn:content', $autnhit);	
			$document 	= element('DOCUMENT', $autncontent);
			
			
			?>
				
				<li class="item">
				  <div class="product-img bg-gray">
					<img src="http://placehold.it/50x50/d2d6de/ffffff"/>
				  </div>
				  <div class="product-info">				
						<?php 
							$doc_score = '0';
							$doc_tag = end(explode("/", element('doc_score', $options)));
							if(in_array($doc_tag, $default_elements))
								$doc_score = element($doc_tag, $autnhit);
							else 
								$doc_score = element($doc_tag, $document)? element($doc_tag, $document): $doc_score;
						?>
						<span class="bg-yellow p-l-5 p-r-5 pull-right" data-toggle="tooltip" title="<?=$doc_tag?>"><?=$doc_score?>
					</span>
					<div class="w-100">					
							<?php 
								$doc_title = 'No title';
								$doc_tag = end(explode("/", element('doc_title', $options)));
								if(in_array($doc_tag, $default_elements))
									$doc_title = element($doc_tag, $autnhit);
								else 
									$doc_title = element($doc_tag, $document)? element($doc_tag, $document): $doc_title;								
							?>
						<a class="product-title" target="_blank" data-bind="CreateSynonym: {ajax: '<?=base_url('synonyms')?>' }" 
							href="<?=base_url('search/document/'. element('autn:id', $autnhit) . '?' . http_build_query($_GET))?> " data-toggle="tooltip" title="<?=$doc_tag?>"><?=$doc_title?></a>
					</div>
					<ul class="list-inline m-0 m-t-5">
						<?php 
							if(is_array(element('doc_meta', $options))):
								foreach(element('doc_meta', $options) as $meta){
									$doc_meta = '-';
									$doc_tag = end(explode("/", $meta));
									if(in_array($doc_tag, $default_elements))
										$doc_meta = element($doc_tag, $autnhit);
									else 
										$doc_meta = element($doc_tag, $document)? element($doc_tag, $document): $doc_meta;						
							?>
									<?php 
									if(is_array($doc_meta)){
										foreach($doc_meta as $dm){
											$mdate = strtotime($dm);											
											if ($mdate === FALSE){												
												echo '<li class="text-muted" data-toggle="tooltip" title="' . $meta . '">'. $dm . '</li>';								
											}else{
												$mdate = mdate('%d %M %Y %h:%i %a', $mdate);
												echo '<li class="text-muted" data-toggle="tooltip" title="' . $meta . '">'. $mdate . '</li>';
											}
										}
									}else{
										$mdate = strtotime($doc_meta);											
										if ($mdate === FALSE){											
											echo '<li class="text-muted" data-toggle="tooltip" title="' . $meta . '">'. $doc_meta . '</li>';								
										}else{
											$mdate = mdate('%d %M %Y %h:%i %a', $mdate);
											echo '<li class="text-muted" data-toggle="tooltip" title="' . $meta . '">'. $mdate . '</li>';
										}
									} ?>
							
							<?php							
								}							
							endif;
						?>
					</ul>
					<?php 
							if(is_array(element('doc_summary', $options))):
								foreach(element('doc_summary', $options) as $meta){
									$doc_summary = '';
									$doc_tag = end(explode("/", $meta));
									if(in_array($doc_tag, $default_elements))
										$doc_summary = element($doc_tag, $autnhit);
									else 
										$doc_summary = element($doc_tag, $document)? element($doc_tag, $document): $doc_summary;						
							?>
									<p class="d-block" data-toggle="tooltip" title="<?=$meta?>" data-bind="CreateSynonym: { ajax: '<?=base_url('synonyms')?>' }"> 
										<?=strip_tags($doc_summary, '<span><img>'); ?>
									</p>
							<?php							
								}							
							endif;
						?>
				  </div>
				</li><!-- /.item -->
				
				
			
			<?php	
				endforeach;
			?>
			</ul>
			<?php
				endif;
			?>
		</div>
	</div>
</div>
<?php
else:
?>
	<div class="box box-danger">
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
						data-remote="<?=base_url('/app/widget_options?widget=' . $widget_key . '&title=' . urlencode('Feed Options'))?>">
						<i class="fa fa-cog"></i>
					</a>
				</li>
				<li><a class="btn"><i class="fa fa-expand"></i></a></li>
			</ul>
		</div>
		<?php } ?>
		<div class="box-header with-border handle <?=$mode? 'cursor-move' : ''?>">
			<h3 class="box-title"><?=element('title', $options)?> </h3>	 
			<div class="box-tools pull-right">
				
			</div>
		</div><!-- /.box-header -->
		<div class="box-body">	
			<?=$this->application->get_config('error_start_delimiter', 'search').lang('search_error_message').$this->application->get_config('error_end_delimiter', 'search')?>
		</div>
	</div>
<?php
endif;
?>