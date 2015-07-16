<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/nav'); ?>

<h1 class="page-header"><?php echo lang('search_template_heading');?></h1>

<p><?php echo lang('search_template_subheading');?></p>

<div class="p-relative container">

	<div class="edit-template">
		<div class="row">
			<div class="col-sm-8">	
				<div class="draggable-widgets-container p-0">
					<?php 
						$hidden = array('meta_key' => 'widget_top_bar');
						echo form_open('search/save_widget',  array('data-bind' => 'submit: $root.SearchTemplate.formSubmit', 'onSubmit' => 'return false;'), $hidden );						
					?>
					<div class="p-5 droppable-widgets m-0 widget"
							data-bind="
								jQueryDroppable: {
									activeClass: '',
									hoverClass: 'bg-warning droppable-container',	
									accept: ':not(.ui-sortable-helper)'							
								},
								jQuerySortable: {
									connectWith: '.droppable-widgets',
									placeholder: 'placeholder',
									update: function( event, ui ){								
										console.log(ui)
										$(this).closest('form').trigger('submit');
									},
									activate: function( event, ui ){
										 ui.helper.width(250);
									}
								}
							"
						>	
							<?php 
							if(!empty($widgets_current['top_bar'])):
							foreach($widgets_current['top_bar'] as $key=>$widget):				
							$wid = $widgets[$widget];
							?>					
							
							<div class="panel panel-default draggable-widgets m-b-0">
								<div class="panel-heading p-t-10 p-b-10 p-l-15 p-r-15">
									<h5 class="m-0">									
										<div class="dropdown pull-right edit-tools">
										  <a class="text-muted pull-right p-l-5 p-r-5 cursor-pointer dropdown-toggle"  data-toggle="dropdown" >		
											<i class="fa fa-ellipsis-v"></i>
										  </a>
										  <ul class="dropdown-menu" >
											<li ><a  href="#" class="" data-bind="click: $root.SearchTemplate.removeWidget "><i class="fa fa-trash"></i> Delete</a></li>
											<li ><a  href="#modal-search-options" 
													data-toggle="modal" 
													data-backdrop="static"
													data-remote="<?=base_url()?>search/widget_options_modal/?widget=<?=$widget?>&title=<?=urlencode($wid['title'].' Options')?>"
													class=""><i class="fa fa-cog"></i> Configure</a></li>
										  </ul>
										</div>								
										<i class="fa <?=$wid['icon']?> "></i> <?=$wid['title']?>									
									</h5>							
								</div>
								<?php							
									$data = array(
										'name'        => 'widgets[]',
										'value'       => $widget,
										'checked'     => TRUE,
										'class'       => 'hidden',
										);
									echo form_checkbox($data);
								?>
							</div>						
							<?php
							endforeach;	
							endif;						
							?>
					</div>
					<?php 
						echo form_close();				
					?>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-8">
				<div class="draggable-widgets-container p-0 m-b-10">
					<?php 
						$hidden = array('meta_key' => 'widget_content_top_bar');
						echo form_open('search/save_widget',  array('data-bind' => 'submit: $root.SearchTemplate.formSubmit', 'onSubmit' => 'return false;'), $hidden );						
					?>
					<div class="p-5 droppable-widgets m-0 widget"
							data-bind="
								jQueryDroppable: {
									activeClass: '',
									hoverClass: 'bg-warning droppable-container',	
									accept: ':not(.ui-sortable-helper)',							
									drop: function( event, ui ) {		
										$( this ).find( '.placeholder' ).remove();
										var clone_item = ui.draggable.clone();
										$(clone_item).appendTo( this );
										
										$(this).closest('form').trigger('submit');									
									}
								},
								jQuerySortable: {
									connectWith: '.droppable-widgets',
									placeholder: 'placeholder',
									update: function( event, ui ){								
										console.log(ui)
										$(this).closest('form').trigger('submit');
									},
									activate: function( event, ui ){
										 ui.helper.width(250);
									}
								}
							"
						>	
							<?php 
							if(!empty($widgets_current['content_top_bar'])):
							foreach($widgets_current['content_top_bar'] as $key=>$widget):				
							$wid = $widgets[$widget];
							?>					
							
							<div class="panel panel-default draggable-widgets m-b-0">
								<div class="panel-heading p-t-10 p-b-10 p-l-15 p-r-15">
									<h5 class="m-0">	
										
										<div class="dropdown pull-right edit-tools">
										  <a class="text-muted pull-right p-l-5 p-r-5 cursor-pointer dropdown-toggle"  data-toggle="dropdown" >		
											<i class="fa fa-ellipsis-v"></i>
										  </a>
										  <ul class="dropdown-menu" >
											<li ><a  href="#" class="" data-bind="click: $root.SearchTemplate.removeWidget "><i class="fa fa-trash"></i> Delete</a></li>
											<li ><a  href="#modal-search-options" 
													data-toggle="modal" 
													data-backdrop="static"
													data-remote="<?=base_url()?>search/widget_options_modal/?widget=<?=$widget?>&title=<?=urlencode($wid['title'].' Options')?>"
													class=""><i class="fa fa-cog"></i> Configure</a></li>
										  </ul>
										</div>								
										<i class="fa <?=$wid['icon']?> "></i> <?=$wid['title']?>									
									</h5>							
								</div>
								<?php							
									$data = array(
										'name'        => 'widgets[]',
										'value'       => $widget,
										'checked'     => TRUE,
										'class'       => 'hidden',
										);
									echo form_checkbox($data);
								?>
							</div>						
							<?php
							endforeach;	
							endif;						
							?>
					</div>
					<?php 
						echo form_close();				
					?>
				</div>
				
				<div class="draggable-widgets-container p-0  m-b-10">
					<?php 
						$hidden = array('meta_key' => 'widget_content');
						echo form_open('search/save_widget',  array('data-bind' => 'submit: $root.SearchTemplate.formSubmit', 'onSubmit' => 'return false;'), $hidden );						
					?>
					<div class="p-5 droppable-widgets m-0 widget widget-lg"
							data-bind="
								jQueryDroppable: {
									activeClass: '',
									hoverClass: 'bg-warning droppable-container',	
									accept: ':not(.ui-sortable-helper)',							
									drop: function( event, ui ) {		
										$( this ).find( '.placeholder' ).remove();
										var clone_item = ui.draggable.clone();
										$(clone_item).appendTo( this );
										
										$(this).closest('form').trigger('submit');									
									}
								},
								jQuerySortable: {
									connectWith: '.droppable-widgets',
									placeholder: 'placeholder',
									update: function( event, ui ){								
										console.log(ui)
										$(this).closest('form').trigger('submit');
									},
									activate: function( event, ui ){
										 ui.helper.width(250);
									}
								}
							"
						>	
							<?php 
							if(!empty($widgets_current['content'])):
							foreach($widgets_current['content'] as $key=>$widget):				
							$wid = $widgets[$widget];
							?>					
							
							<div class="panel panel-default draggable-widgets m-b-0">
								<div class="panel-heading p-t-10 p-b-10 p-l-15 p-r-15">
									<h5 class="m-0">	
										
										<div class="dropdown pull-right edit-tools">
										  <a class="text-muted pull-right p-l-5 p-r-5 cursor-pointer dropdown-toggle"  data-toggle="dropdown" >		
											<i class="fa fa-ellipsis-v"></i>
										  </a>
										  <ul class="dropdown-menu" >
											<li ><a  href="#" class="" data-bind="click: $root.SearchTemplate.removeWidget "><i class="fa fa-trash"></i> Delete</a></li>
											<li ><a  href="#modal-search-options" 
													data-toggle="modal" 
													data-backdrop="static"
													data-remote="<?=base_url()?>search/widget_options_modal/?widget=<?=$widget?>&title=<?=urlencode($wid['title'].' Options')?>"
													class=""><i class="fa fa-cog"></i> Configure</a></li>
										  </ul>
										</div>								
										<i class="fa <?=$wid['icon']?> "></i> <?=$wid['title']?>									
									</h5>							
								</div>
								<?php							
									$data = array(
										'name'        => 'widgets[]',
										'value'       => $widget,
										'checked'     => TRUE,
										'class'       => 'hidden',
										);
									echo form_checkbox($data);
								?>
							</div>						
							<?php
							endforeach;	
							endif;						
							?>
					</div>
					<?php 
						echo form_close();				
					?>
				</div>
				
				<div class="draggable-widgets-container p-0">
					<?php 
						$hidden = array('meta_key' => 'widget_content_bottom_bar');
						echo form_open('search/save_widget',  array('data-bind' => 'submit: $root.SearchTemplate.formSubmit', 'onSubmit' => 'return false;'), $hidden );						
					?>
					<div class="p-5 droppable-widgets m-0 widget "
							data-bind="
								jQueryDroppable: {
									activeClass: '',
									hoverClass: 'bg-warning droppable-container',	
									accept: ':not(.ui-sortable-helper)',							
									drop: function( event, ui ) {		
										$( this ).find( '.placeholder' ).remove();
										var clone_item = ui.draggable.clone();
										$(clone_item).appendTo( this );
										
										$(this).closest('form').trigger('submit');									
									}
								},
								jQuerySortable: {
									connectWith: '.droppable-widgets',
									placeholder: 'placeholder',
									update: function( event, ui ){								
										console.log(ui)
										$(this).closest('form').trigger('submit');
									},
									activate: function( event, ui ){
										 ui.helper.width(250);
									}
								}
							"
						>	
							<?php 
							if(!empty($widgets_current['content_bottom_bar'])):
							foreach($widgets_current['content_bottom_bar'] as $key=>$widget):				
							$wid = $widgets[$widget];
							?>					
							
							<div class="panel panel-default draggable-widgets m-b-0">
								<div class="panel-heading p-t-10 p-b-10 p-l-15 p-r-15">
									<h5 class="m-0">	
										
										<div class="dropdown pull-right edit-tools">
										  <a class="text-muted pull-right p-l-5 p-r-5 cursor-pointer dropdown-toggle"  data-toggle="dropdown" >		
											<i class="fa fa-ellipsis-v"></i>
										  </a>
										  <ul class="dropdown-menu" >
											<li ><a  href="#" class="" data-bind="click: $root.SearchTemplate.removeWidget "><i class="fa fa-trash"></i> Delete</a></li>
											<li ><a  href="#modal-search-options" 
													data-toggle="modal" 
													data-backdrop="static"
													data-remote="<?=base_url()?>search/widget_options_modal/?widget=<?=$widget?>&title=<?=urlencode($wid['title'].' Options')?>"
													class=""><i class="fa fa-cog"></i> Configure</a></li>
										  </ul>
										</div>								
										<i class="fa <?=$wid['icon']?> "></i> <?=$wid['title']?>									
									</h5>							
								</div>
								<?php							
									$data = array(
										'name'        => 'widgets[]',
										'value'       => $widget,
										'checked'     => TRUE,
										'class'       => 'hidden',
										);
									echo form_checkbox($data);
								?>
							</div>						
							<?php
							endforeach;	
							endif;						
							?>
					</div>
					<?php 
						echo form_close();				
					?>
				</div>
				
			</div>
			<div class="col-sm-4">
				<div class="draggable-widgets-container p-0">
					<?php 
						$hidden = array('meta_key' => 'widget_left_sidebar_1');
						echo form_open('search/save_widget',  array('data-bind' => 'submit: $root.SearchTemplate.formSubmit', 'onSubmit' => 'return false;'), $hidden );						
					?>
					<div class="p-5 droppable-widgets m-0 widget widget-sm"
							data-bind="
								jQueryDroppable: {
									activeClass: '',
									hoverClass: 'bg-warning droppable-container',	
									accept: ':not(.ui-sortable-helper)',							
									drop: function( event, ui ) {		
										$( this ).find( '.placeholder' ).remove();
										var clone_item = ui.draggable.clone();
										$(clone_item).appendTo( this );
										
										$(this).closest('form').trigger('submit');									
									}
								},
								jQuerySortable: {
									connectWith: '.droppable-widgets',
									placeholder: 'placeholder',
									update: function( event, ui ){								
										console.log(ui)
										$(this).closest('form').trigger('submit');
									},
									activate: function( event, ui ){
										 ui.helper.width(250);
									}
								}
							"
						>	
							<?php 
							if(!empty($widgets_current['left_sidebar_1'])):
							foreach($widgets_current['left_sidebar_1'] as $key=>$widget):				
							$wid = $widgets[$widget];
							?>					
							
							<div class="panel panel-default draggable-widgets m-b-0">
								<div class="panel-heading p-t-10 p-b-10 p-l-15 p-r-15">
									<h5 class="m-0">	
										
										<div class="dropdown pull-right edit-tools">
										  <a class="text-muted pull-right p-l-5 p-r-5 cursor-pointer dropdown-toggle"  data-toggle="dropdown" >		
											<i class="fa fa-ellipsis-v"></i>
										  </a>
										  <ul class="dropdown-menu" >
											<li ><a  href="#" class="" data-bind="click: $root.SearchTemplate.removeWidget "><i class="fa fa-trash"></i> Delete</a></li>
											<li ><a  href="#modal-search-options" 
													data-toggle="modal" 
													data-backdrop="static"
													data-remote="<?=base_url()?>search/widget_options_modal/?widget=<?=$widget?>&title=<?=urlencode($wid['title'].' Options')?>"
													class=""><i class="fa fa-cog"></i> Configure</a></li>
										  </ul>
										</div>								
										<i class="fa <?=$wid['icon']?> "></i> <?=$wid['title']?>									
									</h5>							
								</div>
								<?php							
									$data = array(
										'name'        => 'widgets[]',
										'value'       => $widget,
										'checked'     => TRUE,
										'class'       => 'hidden',
										);
									echo form_checkbox($data);
								?>
							</div>						
							<?php
							endforeach;
							endif;							
							?>
					</div>
					<?php 
						echo form_close();				
					?>
				</div>
				
				<div class="draggable-widgets-container p-0">
					<?php 
						$hidden = array('meta_key' => 'widget_left_sidebar_2');
						echo form_open('search/save_widget',  array('data-bind' => 'submit: $root.SearchTemplate.formSubmit', 'onSubmit' => 'return false;'), $hidden );						
					?>
					<div class="p-5 droppable-widgets m-0 widget widget-sm"
							data-bind="
								jQueryDroppable: {
									activeClass: '',
									hoverClass: 'bg-warning droppable-container',	
									accept: ':not(.ui-sortable-helper)',							
									drop: function( event, ui ) {		
										$( this ).find( '.placeholder' ).remove();
										var clone_item = ui.draggable.clone();
										$(clone_item).appendTo( this );
										
										$(this).closest('form').trigger('submit');									
									}
								},
								jQuerySortable: {
									connectWith: '.droppable-widgets',
									placeholder: 'placeholder',
									update: function( event, ui ){								
										console.log(ui)
										$(this).closest('form').trigger('submit');
									},
									activate: function( event, ui ){
										 ui.helper.width(250);
									}
								}
							"
						>	
							<?php 
							if(!empty($widgets_current['left_sidebar_2'])):
							foreach($widgets_current['left_sidebar_2'] as $key=>$widget):				
							$wid = $widgets[$widget];
							?>					
							
							<div class="panel panel-default draggable-widgets m-b-0">
								<div class="panel-heading p-t-10 p-b-10 p-l-15 p-r-15">
									<h5 class="m-0">	
										
										<div class="dropdown pull-right edit-tools">
										  <a class="text-muted pull-right p-l-5 p-r-5 cursor-pointer dropdown-toggle"  data-toggle="dropdown" >		
											<i class="fa fa-ellipsis-v"></i>
										  </a>
										  <ul class="dropdown-menu" >
											<li ><a  href="#" class="" data-bind="click: $root.SearchTemplate.removeWidget "><i class="fa fa-trash"></i> Delete</a></li>
											<li ><a  href="#modal-search-options" 
													data-toggle="modal" 
													data-backdrop="static"
													data-remote="<?=base_url()?>search/widget_options_modal/?widget=<?=$widget?>&title=<?=urlencode($wid['title'].' Options')?>"
													class=""><i class="fa fa-cog"></i> Configure</a></li>
										  </ul>
										</div>								
										<i class="fa <?=$wid['icon']?> "></i> <?=$wid['title']?>									
									</h5>							
								</div>
								<?php							
									$data = array(
										'name'        => 'widgets[]',
										'value'       => $widget,
										'checked'     => TRUE,
										'class'       => 'hidden',
										);
									echo form_checkbox($data);
								?>
							</div>						
							<?php
							endforeach;	
							endif;						
							?>
					</div>
					<?php 
						echo form_close();				
					?>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view($tools);?>
</div>




<div class="modal fade" id="modal-search-options">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
			<div class="text-center has-spinner active">
				<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>
			</div>
			</div>			
		</div>
	  </div>
</div>
<?php $this->load->view('template/footer'); ?>



