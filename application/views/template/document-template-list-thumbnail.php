<?php 
/*
* @Title: List with Thumbnail
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
<div class="products-list product-list-in-box">
	<?php 
		
		foreach($autnhit as $key=>$solution){
		
		$document = array_get_value($solution, 'DOCUMENT');
		
	?>
	
	
	<div class="item slideInDown animated">
	  <div class="product-img">
		<img alt="Product Image" src="http://placehold.it/50x50/d2d6de/ffffff"/>
	  </div>
	  <div class="product-info">
		<a class="product-title" href="javascript::;">		
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
				%
			</span>
		</a>	
		<ul class="list-inline m-0">
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
		<p class="">
		  <?php 
				if(element('doc_summary',$template)){
					foreach( element('doc_summary',$template) as $meta):
			?>	
					<?=(element(end(explode('/', $meta)), $document))?>
					<?=(element($meta, $solution))?>
			<?php								
					endforeach;
				}
			?>	
		</p>
		
		<span class="btn btn-default btn-xs btn-flat" data-toggle="collapse" data-target="#<?=$ts?>-<?=$key?>-collapse">Full Solution</span>
		<div class="attachment collapse p-10 bg-green" id="<?=$ts?>-<?=$key?>-collapse">
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