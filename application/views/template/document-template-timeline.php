<?php 
/*
* @Title: Timeline
* @Method: DocumentTemplate
* @icon: fa-file-text
*/ 



$ts = generate_timestamp();	

$numhits 	= array_key_exists('autn:numhits', $responsedata)?  	element('autn:numhits', $responsedata) : 0;	
$autnhit 	=  ($numhits > 0)?
			($numhits > 1)? 
				element('autn:hit', $responsedata) 
				: array( 0 => element('autn:hit', $responsedata)) 
			: array() ;

if($autnhit){

?>
<ul class="timeline">
	<?php 
		
		foreach($autnhit as $key=>$solution){
		
		$document = array_get_value($solution, 'DOCUMENT');
	?>
	
		<li>
		  <i class="fa fa-hand-o-right bg-red"></i>
		  <div class="timeline-item">
			<span class="time">
				<a class="btn btn-warning btn-xs">
					<?php
						if(array_key_exists('doc_score',$template)) 
						echo element(end(explode('/', element('doc_score',$template))), $document) 
					?> 
						<?=element(element('doc_score',$template), $solution)?> 
						%
				  </a>
			</span>
			<h3 class="timeline-header">
				<?php 
					if(element('doc_title',$template)){
						foreach( element('doc_title',$template) as $meta):
				?>	
						<?=element(end(explode('/', $meta)), $document)?>
				<?php								
						endforeach;
					}
				?>
			</h3>
			<div class="timeline-body">
			 <?php 
					if(element('doc_summary',$template)){
						foreach( element('doc_summary',$template) as $meta):
				?>	
						<p><?=(element(end(explode('/', $meta)), $document))?></p>
						<p><?=(element($meta, $solution))?></p>
				<?php								
						endforeach;
					}
				?>	
				<span class="btn btn-default btn-xs btn-flat" data-toggle="collapse" data-target="#<?=$ts?>-<?=$key?>-collapse">Full Solution</span>
				<div class="attachment collapse bg-green p-10" id="<?=$ts?>-<?=$key?>-collapse">
					<?php 
						if(element('doc_extra',$template)){
							foreach( element('doc_extra',$template) as $meta):
					?>	
							<?=(element(end(explode('/', $meta)), $document))?>
							<?=(element($meta, $solution))?>
					<?php								
							endforeach;
						}
					?>
				</div>
			</div>
			<div class="timeline-footer">
			  
			  <ul class="list-inline ">
				<?php 
					if(element('doc_meta',$template)){
						foreach( element('doc_meta',$template) as $meta):
				?>	
						<li class="text-muted"><?=(element(end(explode('/', $meta)), $document))?></li>
						<li class="text-muted"><?=(element($meta, $solution))?></li>
				<?php								
						endforeach;
					}
				?>
				</ul>
			  
			</div>
		  </div>
		</li>
	
	
		
	<?php						
		} ?>
</ul>
<?php
}else{
	?>
	No results...
<?php 
}
?>




