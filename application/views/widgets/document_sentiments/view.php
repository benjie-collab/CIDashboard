<?php 
/*
* @Title: Sentiments
* @Method: Document
* @icon: fa fa-tasks
* @Description: Extracted sentiments from a document.
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
$response 		= element('autnresponse', $document);
$responsedata 	= element('responsedata', $response);
$numhit 		= element('autn:numhits', $responsedata);
$autnhit     	= element('autn:hit', $responsedata);
$autncontent    = element('autn:content', $autnhit);
//$document    	= element('DOCUMENT', $autncontent);


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
					data-remote="<?=base_url('app/widget_options/?widget=' . $widget_key . '&title=' . urlencode('Document Sentiments Options'))?>">
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
	<div class="box-body">
		
	
		<div data-bind="NiceScroll: { height: 350}">
		<?php 
			if($document):

			$positive_vibes = get_vibes_value($document, 'POSITIVE_VIBE_VALUE');
			$negative_vibes = get_vibes_value($document, 'NEGATIVE_VIBE_VALUE');
			$neutral_vibes = get_vibes_value($document, 'NEUTRAL_VIBE_VALUE');
			
		
		?>
			
					<ul class="todo-list sentiments-sortable" data-bind="jQuerySortable: {
							connectWith: '.sentiments-sortable',
							placeholder: 'sort-highlight',
							forcePlaceholderSize: true,	
							handle: '.handl',
							revert: true,
							appendTo: document.body,
							zIndex: 1032
							}">   
						<?php 
							foreach ($positive_vibes as $key=>$vibe):						
						?>
						<li>
						  <span class="handl cursor-move">
							<i class="fa fa-ellipsis-v"></i>
							<i class="fa fa-ellipsis-v"></i>
						  </span>                     
						  <span class="text"><?=$vibe?></span>
						  <small class="label label-info"><i class="fa fa-tasks"></i> positive</small>
						  <div class="tools">
							<i class="fa fa-edit"></i>
							<i class="fa fa-trash-o"></i>
						  </div>
						</li>
						<?php 
							endforeach;						
						?>
						<?php 
							foreach ($negative_vibes as $key=>$vibe):						
						?>
						<li>
						  <span class="handl cursor-move">
							<i class="fa fa-ellipsis-v"></i>
							<i class="fa fa-ellipsis-v"></i>
						  </span>                     
						  <span class="text"><?=$vibe?></span>
						  <small class="label label-danger"><i class="fa fa-tasks"></i> negative</small>
						  <div class="tools">
							<i class="fa fa-edit"></i>
							<i class="fa fa-trash-o"></i>
						  </div>
						</li>
						<?php 
							endforeach;						
						?>
						<?php 
							foreach ($neutral_vibes as $key=>$vibe):						
						?>
						<li>
						  <span class="handl cursor-move">
							<i class="fa fa-ellipsis-v"></i>
							<i class="fa fa-ellipsis-v"></i>
						  </span>                     
						  <span class="text"><?=$vibe?></span>
						  <small class="label label-warning"><i class="fa fa-tasks"></i> neutral</small>
						  <div class="tools">
							<i class="fa fa-edit"></i>
							<i class="fa fa-trash-o"></i>
						  </div>
						</li>
						<?php 
							endforeach;						
						?>
					</ul>	
			<?php endif; ?>
		</div>
	</div>
</div>
		
<?php endif; ?>