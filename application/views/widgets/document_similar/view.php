<?php 
/*
* @Title: Similar Documents
* @Method: Document
* @icon: fa fa-copy
* @Description: Similar documents of the current document. Configure the display accordingly.
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

if($document):
	$_response 		= element('autnresponse', $document);
	$_responsedata 	= element('responsedata', $_response);
	$_numhit 		= element('autn:numhits', $_responsedata);
	$_autnhit     	= element('autn:hit', $_responsedata);
	$_autnid     	= element('autn:id', $_autnhit);


	$default_elements	= array_keys($this->document_lib->default_elements());	

	$suggests	= $this->suggest_model->call_suggest(array('id'=> $_autnid,  'irs' => 'true'));
	$response 		= element('autnresponse', $suggests);
	$responsedata = element('responsedata',  $response);
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
					data-remote="<?=base_url('app/widget_options/?widget=' . $widget_key . '&title=' . urlencode('Similar Document Options'))?>">
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
	  </div>
	</div><!-- /.box-header -->

	<div class="box-body" data-bind="NiceScroll: { height: 350}">
		<?php
			$autnhit = array();
			$autnhit = element('autn:hit', $responsedata);
		?>
		
		<?php 		
		if($autnhit):		?>
		<ul class="products-list product-list-in-box m-b-20">
		<?php
		
		foreach($autnhit as $key=>$autnhit):
		
		$content = element('autn:content', $autnhit);
		$document = element('DOCUMENT', $content);	
		
		?>
			
			<li class="item">
			  <div class="product-img bg-gray">
				<img src="http://placehold.it/50x50/d2d6de/ffffff"/>
			  </div>
			  <div class="product-info">
				
					<?php 
						$doc_score = '0';
						$doc_tag = $this->document_lib->get_element_name_from_tag_name(element('doc_score', $options));
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
							$doc_tag = $this->document_lib->get_element_name_from_tag_name(element('doc_title', $options));
							if(in_array($doc_tag, $default_elements))
								$doc_title = element($doc_tag, $autnhit);
							else 
								$doc_title = element($doc_tag, $document)? element($doc_tag, $document): $doc_title;								
						?>
					<a class="product-title" target="_blank" href="<?=base_url('search/document/'. element('autn:id', $autnhit) . '?' . http_build_query($_GET))?> " data-toggle="tooltip" title="<?=$doc_tag?>"><?=$doc_title?></a>
				</div>
				<ul class="list-inline m-0 m-t-5">
					<?php 
						if(is_array(element('doc_meta', $options))):
							foreach(element('doc_meta', $options) as $meta){
								$doc_meta = 'No Meta';
								$doc_tag = $this->document_lib->get_element_name_from_tag_name($meta);
								if(in_array($doc_tag, $default_elements))
									$doc_meta = element($doc_tag, $autnhit);
								else 
									$doc_meta = element($doc_tag, $document)? element($doc_tag, $document): $doc_meta;						
						?>
								<li class="text-muted" data-toggle="tooltip" title="<?=$meta?>"><?=$doc_meta?></li>
						<?php							
							}							
						endif;
					?>
				</ul>
				<?php 
						if(is_array(element('doc_summary', $options))):
							foreach(element('doc_summary', $options) as $meta){
								$doc_summary = '';
								$doc_tag = $this->document_lib->get_element_name_from_tag_name($meta);
								if(in_array($doc_tag, $default_elements))
									$doc_summary = element($doc_tag, $autnhit);
								else 
									$doc_summary = element($doc_tag, $document)? element($doc_tag, $document): $doc_summary;						
						?>
								<p class="d-block" data-toggle="tooltip" title="<?=$meta?>"> 
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
<?php endif; ?>