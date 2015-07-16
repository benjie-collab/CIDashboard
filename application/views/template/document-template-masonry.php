<?php 
/*
* @Title: Masonry
* @Method: DocumentTemplate
* @icon: fa-file-text
*/ 


$ts = generate_timestamp();	

$current_page = $this->application->get_session_userdata('current_page');
$numhits 	= array_key_exists('autn:numhits', $responsedata)?  	element('autn:numhits', $responsedata) : 0;	
$autnhit 	=  ($numhits > 0)?
			($numhits > 1)? 
				element('autn:hit', $responsedata) 
				: array( 0 => element('autn:hit', $responsedata)) 
			: array() ;
			

$boxes = $this->application->get_config('background', 'template');

$boxes = array_keys($boxes);
$databases	= $this->application->get_databases($current_page);
$databases	= element('database', $databases );
$databases	= array_column($databases, 'name');

?>
<div class="box-body p-0">	
<?php
if($autnhit){

?>
	<div class="row">	
	<?php 
		
	
		$colors = array_combine(array_intersect_key($databases, $boxes), array_intersect_key($boxes, $databases));
$solution		= $autnhit[0];
		$document = array_get_value($solution, 'DOCUMENT');
	?>
		
			<div class="col-md-12">
			<div class="box box-solid <?=element( element('DREDBNAME',$document) ,$colors)?>-active m-b-20 animated zoomInDown ">
				<div class="box-header with-border">
				  <h1 class="box-title">
					<?php 
						if(element('doc_title',$template)){
							foreach( element('doc_title',$template) as $meta):
					?>	
							<?=element(end(explode('/', $meta)), $document)?>
					<?php								
							endforeach;
						}
					?>		
				  </h1>		
				  <div class="box-tools pull-right">	
						<span class="box-tool btn <?=element( element('DREDBNAME',$document) ,$colors)?> btn-xs btn-flat" data-toggle="tab" data-target="#solution-full-1">
							<i class="fa fa-file-text-o"></i>
						</span>
						<span class="box-tool btn <?=element( element('DREDBNAME',$document) ,$colors)?> btn-xs btn-flat" data-toggle="tab" data-target="#solution-full-2">
							<i class="fa fa-file-text"></i>
						</span>
					</div>
				</div>
				<div class="box-body">
					<div class="tab-content">
						<div class=" tab-pane active" id="solution-full-1">
							<?php 
								if(element('doc_summary',$template)){
									foreach( element('doc_summary',$template) as $meta):
							?>	
									<?php 
									$string = str_replace(array('.'), '.<br/>', element(end(explode('/', $meta)), $document)); 
									$string = str_replace(array('?'), '?<br/>', $string); 
									$string = str_replace(array('!'), '!<br/>', $string); 
									echo $string;
									?>
									
									<?php 
										$string = str_replace(array('.'), '.<br/>', element($meta, $solution)); 
										$string = str_replace(array('?'), '?<br/>', $string); 
										$string = str_replace(array('!'), '!<br/>', $string); 
										echo $string;
									?>
							<?php								
									endforeach;
								}
							?>	
						</div>
						<div class="tab-pane <?=element( element('DREDBNAME',$document) ,$colors)?>-active p-10 animated bounceIn" id="solution-full-2">
							<?php 
								if(element('doc_extra',$template)){
									foreach( element('doc_extra',$template) as $meta):
							?>	
									<?php 
										$string = str_replace(array('.'), '.<br/>', element(end(explode('/', $meta)), $document)); 
										$string = str_replace(array('?'), '?<br/>', $string); 
										$string = str_replace(array('!'), '!<br/>', $string); 
										echo $string;
									?>
									
									<?php 
										$string = str_replace(array('.'), '.<br/>', element($meta, $solution)); 
										$string = str_replace(array('?'), '?<br/>', $string); 
										$string = str_replace(array('!'), '!<br/>', $string); 
										echo $string;
									?>
									
							<?php								
									endforeach;
								}
							?>	
						</div>
					</div>
				</div>
				<div class="box-footer clearfix <?=element( element('DREDBNAME',$document) ,$colors)?>-active">
					<ul class="list-inline m-0">
					<?php 
						if(element('doc_meta',$template)){
							foreach( element('doc_meta',$template) as $meta):
					?>	
							<li class=""><?=(element(end(explode('/', $meta)), $document))?></li>
							<li class=""><?=(element($meta, $solution))?></li>
					<?php								
							endforeach;
						}
					?>
					</ul>
				</div>
			</div>
			</div>
	</div>		
	<div class="row">			
		<?php 
			array_shift($autnhit);	
			reset($autnhit);	
			$autnhit= array_chunk($autnhit, ceil(sizeof($autnhit)/2), true);
			
			foreach($autnhit as $hit){	
				echo '<div class="col-md-6">';
				foreach($hit as $key=>$solution){		
				$document = array_get_value($solution, 'DOCUMENT');
			?>
				
				<div class="box box-solid <?=element( element('DREDBNAME',$document) ,$colors)?> m-b-20 animated zoomInDown">
					<div class="box-header with-border">
					  <h3 class="box-title">
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
						<div class="box-tools pull-right">	
							<span class="box-tool btn <?=element( element('DREDBNAME',$document) ,$colors)?>-active btn-xs btn-flat" data-toggle="tab" data-target="#solution-full-<?=$key?>-1">
								<i class="fa fa-file-text-o"></i>
							</span>
							<span class="box-tool btn <?=element( element('DREDBNAME',$document) ,$colors)?>-active btn-xs btn-flat" data-toggle="tab" data-target="#solution-full-<?=$key?>-2">
								<i class="fa fa-file-text"></i>
							</span>
						</div>
					</div>
					<div class="box-body">
						<div class="tab-content">
							<div class=" tab-pane active" id="solution-full-<?=$key?>-1">
								<?php 
									if(element('doc_summary',$template)){
										foreach( element('doc_summary',$template) as $meta):
								?>	
										
										
										<?php 
										$string = str_replace(array('.'), '.<br/>', element(end(explode('/', $meta)), $document)); 
										$string = str_replace(array('?'), '?<br/>', $string); 
										$string = str_replace(array('!'), '!<br/>', $string); 
										echo $string;
										?>
										
										<?php 
											$string = str_replace(array('.'), '.<br/>', element($meta, $solution)); 
											$string = str_replace(array('?'), '?<br/>', $string); 
											$string = str_replace(array('!'), '!<br/>', $string); 
											echo $string;
										?>
								<?php								
										endforeach;
									}
								?>	
							</div>
							<div class=" tab-pane <?=element( element('DREDBNAME',$document) ,$colors)?> p-10 animated bounceIn" id="solution-full-<?=$key?>-2">
								<?php 
									if(element('doc_extra',$template)){
										foreach( element('doc_extra',$template) as $meta):
								?>	
										
										<?php 
										$string = str_replace(array('.'), '.<br/>', element(end(explode('/', $meta)), $document)); 
										$string = str_replace(array('?'), '?<br/>', $string); 
										$string = str_replace(array('!'), '!<br/>', $string); 
										echo $string;
										?>
										
										<?php 
											$string = str_replace(array('.'), '.<br/>', element($meta, $solution)); 
											$string = str_replace(array('?'), '?<br/>', $string); 
											$string = str_replace(array('!'), '!<br/>', $string); 
											echo $string;
										?>
								<?php								
										endforeach;
									}
								?>	
							</div>
						</div>
					</div>
					<div class="box-footer clearfix <?=element( element('DREDBNAME',$document) ,$colors)?>">
						<ul class="list-inline m-0">
						<?php 
							if(element('doc_meta',$template)){
								foreach( element('doc_meta',$template) as $meta):
						?>	
								<li class=""><?=(element(end(explode('/', $meta)), $document))?></li>
								<li class=""><?=(element($meta, $solution))?></li>
						<?php								
								endforeach;
							}
						?>
						</ul>
					</div>
				</div>			
			<?php 
				} 
				echo '</div>';
			}
		?>
		
		
		<!--
	
		<div class="item direct-chat-msg slideInDown animated">
			<div class="direct-chat-info clearfix">
				<span class="direct-chat-name pull-left">				
				
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
						<p><?=(element(end(explode('/', $meta)), $document))?></p>
						<p><?=(element($meta, $solution))?></p>
				<?php								
						endforeach;
					}
				?>	
				
				<span class="btn btn-default btn-xs btn-flat" data-toggle="collapse" data-target="#<?=$ts?>-<?=$key?>-collapse">Full Solution</span>
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
		</div>		-->
	</div>
<?php
}else{
	?>
	<div class="box box-default m-b-10">
		<div class="box-body text-center">
			<h5>
				No results...
			</h5>
		</div>
	
	</div>
<?php 
}
?>
</div>