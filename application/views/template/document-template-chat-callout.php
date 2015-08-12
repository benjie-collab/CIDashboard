<?php 
/*
* @Title: Chat Call-out
* @Method: DocumentTemplate
* @icon: fa-file-text
*/ 


$ts = generate_timestamp();	
if(isset($responsedata)){
$numhits 	= array_key_exists('autn:numhits', $responsedata)?  	element('autn:numhits', $responsedata) : 0;	
$autnhit 	=  ($numhits > 0)?
			($numhits > 1)? 
				element('autn:hit', $responsedata) 
				: array( 0 => element('autn:hit', $responsedata)) 
			: array() ;

if($autnhit){

?>
<div class="box-body chat list-unstyled">	
	<?php 
		
		foreach($autnhit as $key=>$solution){
		
		$document = array_get_value($solution, 'DOCUMENT');
	?>
	
		<div class="item direct-chat-msg slideInDown animated">
			<div class="direct-chat-info clearfix">
				<span class="direct-chat-name pull-left">				
				<?php 
					if(element('doc_title',$template)){
						foreach( element('doc_title',$template) as $meta):
				?>	
						<?=element(end(explode('/', $meta)), $document)?>
				<?php								
						endforeach;
					}
				?>
				</span>
				<span class="direct-chat-timestamp pull-right">
				<?php
					if(array_key_exists('doc_score',$template)) 
					echo element(end(explode('/', element('doc_score',$template))), $document) 
				?> 
					<?=element(element('doc_score',$template), $solution)?> 
					%
				</span>
			</div>
			<img class="direct-chat-img" alt="" src="<?=base_url('assets/themes/lte/img/user.jpg')?>"/>
			<div class="direct-chat-text">
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
				<?php 
					if(element('doc_summary',$template)){
						foreach( element('doc_summary',$template) as $meta):
				?>	
						<p data-bind="CreateSynonym:{}">
							<?=(element(end(explode('/', $meta)), $document))?>
							
							<?=(element($meta, $solution))?>
							<a href="javascript:void(0)" class="btn-rm" data-toggle="collapse" data-target="#<?=$ts?>-<?=$key?>-collapse">
								<?=element('read_more_text',$template)? element('read_more_text',$template) : 'Read more..';?>
							</a>
						</p>
				<?php								
						endforeach;
					}
				?>	
				
				
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
		</div>		
	<?php						
		} ?>
</div>
<?php
}else{
	?>
	No results...
<?php 
}
?>
<?php
}else{
	?>
	Cant find response...
<?php 
}
?>