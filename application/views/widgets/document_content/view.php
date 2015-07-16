<?php 
/*
* @Title: Content
* @Method: Document
* @icon: fa-file-text
* @Description: Displays the content of the document with configurable options.
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
	$document    	= element('DOCUMENT', $autncontent);
	$default_elements= array_keys($this->document_lib->default_elements());	
	
?>

	
		<?php if($document){ ?>
		  <div class="mailbox-read-info">
			<?php
			
				$doc_title = 'No title';
				$doc_tag = $this->document_lib->get_element_name_from_tag_name(element('doc_title', $options));
				if(in_array($doc_tag, $default_elements))
					$doc_title = element($doc_tag, $autnhit);
				else 
					$doc_title = element($doc_tag, $document)? element($doc_tag, $document): $doc_title;							
			?>
			<h3><?=$doc_title?></h3>		
		  </div><!-- /.mailbox-read-info -->
		  <div class="mailbox-controls with-border">
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
		  </div><!-- /.mailbox-controls -->
		  <div class="mailbox-read-message">					
			<div class="widget">
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
		  </div><!-- /.mailbox-read-message -->
		  <?php } ?>
		  
	
	
		<?php 	
			if(is_array(element('doc_comments', $options))):
		?>
				<div class="box-footer">
		<?php
				foreach(element('doc_comments', $options) as $meta){
					$doc_comments = '';
					$doc_tag = $this->document_lib->get_element_name_from_tag_name($meta);
					if(in_array($doc_tag, $default_elements))
						$doc_comments = element($doc_tag, $autnhit);
					else 
						$doc_comments = element($doc_tag, $document)? element($doc_tag, $document): $doc_comments;						

					if(is_array($doc_comments) && is_str_contain($doc_tag, "COMMENTS")){
						$i=0;
						$COMMENTS_DATA_CAN_REMOVE 	= element('COMMENTS_DATA_CAN_REMOVE', $document);
						$COMMENTS_DATA_CREATED_TIME = element('COMMENTS_DATA_CREATED_TIME', $document);
						$COMMENTS_DATA_FROM_ID 		= element('COMMENTS_DATA_FROM_ID', $document);
						$COMMENTS_DATA_FROM_NAME 	= element('COMMENTS_DATA_FROM_NAME', $document);
						$COMMENTS_DATA_ID 			= element('COMMENTS_DATA_ID', $document);
						$COMMENTS_DATA_LIKE_COUNT 	= element('COMMENTS_DATA_LIKE_COUNT', $document);
						$COMMENTS_DATA_MESSAGE 		= element('COMMENTS_DATA_MESSAGE', $document);
						$COMMENTS_DATA_USER_LIKES 	= element('COMMENTS_DATA_USER_LIKES', $document);
						$LIKES_DATA_ID 				= element('LIKES_DATA_ID', $document);
						$LIKES_DATA_NAME 			= element('LIKES_DATA_NAME', $document);
						?>
						<div id="chat-box" class="box-body chat" >
							<?php
							foreach($doc_comments as $comment){
							?>
							
								<div class="item">
									<img class="online" alt="user image" src="http://192.168.2.11/k2-idol/assets/themes/lte/img/user2-160x160.jpg">
									<p class="message">
									  <a class="name" href="#">
										<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 
										<?php											
											$mdate = strtotime(element($i,$COMMENTS_DATA_CREATED_TIME));											
											if ($mdate === FALSE){											
												echo element($i,$COMMENTS_DATA_CREATED_TIME);								
											}else{
												$mdate = mdate('%d %M %Y %h:%i %a', $mdate);
												echo $mdate;
											}
										?>
										
										
										</small>
										<?=element($i,$COMMENTS_DATA_FROM_NAME)?>
									  </a>
									  <?=element($i,$COMMENTS_DATA_MESSAGE) ?>
										<br/>
										<small class="text-muted">
											<i class="fa fa-thumbs-up"></i>
											<?=element($i,$COMMENTS_DATA_LIKE_COUNT) ?> people
										</small>	
									</p>
								</div>					
											
							<?php	
							$i++;
							}?>
						</div>
					<?php
					}		
				}	
		?>
				</div>
		<?php
			endif;
		?>
<?php endif; ?>


