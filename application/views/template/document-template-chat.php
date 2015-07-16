<?php 
/*
* @Title: Chat
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
<div class="box-body chat list-unstyled">	
	<?php 
		
		foreach($autnhit as $key=>$solution){
		
		$document = array_get_value($solution, 'DOCUMENT');
		
	?>
	
	<div class="item slideInDown animated">
		<img class="online" alt="user image" src="<?=base_url('assets/themes/lte/img/user.jpg')?>"/>
		<div class="message">
		  <a class="name" href="javascript:void(0)">
			<?php 
				if(element('doc_title',$template)){
					foreach( element('doc_title',$template) as $meta):
			?>	
					<?=element(end(explode('/', $meta)), $document)?>
			<?php								
					endforeach;
				}
			?>
			<span class="label label-warning pull-right">
			<?php
				if(array_key_exists('doc_score',$template)) 
				echo element(end(explode('/', element('doc_score',$template))), $document) 
			?> 
				<?=element(element('doc_score',$template), $solution)?> 
				% </span>
		  </a>
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
				<p><?=(element(end(explode('/', $meta)), $document))?></p>
				<p><?=(element($meta, $solution))?></p>
		<?php								
				endforeach;
			}
		?>	
			<span class="btn btn-default btn-xs btn-flat" data-toggle="collapse" data-target="#<?=$ts?>-<?=$key?>-collapse">Full Solution</span>
		</div>
			<div class="attachment collapse bg-green" id="<?=$ts?>-<?=$key?>-collapse">
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