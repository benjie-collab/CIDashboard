<!-- Content Header (Page header) -->
<section class="content-header">
  <h1 class="page-header"><?php echo lang('index_heading');?>
	<small><?php echo lang('index_subheading');?></small>
  </h1>
  <?=$this->application->breadcrumb()?>
</section>
<?php 
	$loading_state 		= str_replace('"','\'',$this->template_model->get_box_loading_state()) ;
	$form_to_submit 	= '#dashboard_settings_form';	
	$mode 	  			= $this->application->get_mode('dashboard_mode');
	$dashboard_settings = $this->application->get_settings('dashboard_settings');	
	$delimiter 			= $this->application->get_config('metakey_delimiter', 'template');
?>

<section class="content" >
	
	<!--
	<div data-bind="SigmaNetwork:{}">
		<div class="row">
			<div class="col-sm-3">
				<div id="mainpanel">
					<div class="col">
						<div id="legend">
							<div class="">
								<h2>Legend:</h2>
								<dl>
									<dt class="node"></dt>
									<dd></dd>
									<dt class="edge"></dt>
									<dd></dd>
									<dt class="colours"></dt>
									<dd></dd>		
								</dl>
							</div>
						</div> 
						<div class="b1">
							<form>
							  <div id="search" class=""><h2>Search:</h2>
									<input type="text" name="search" value="Search by name" class="empty"/><div class="state"></div>
									<div class="results"></div>
							  </div>
							  <div class="" id="attributeselect"><h2>Group Selector:</h2>
									<div class="select">Select Group</div>
									<div class="list "></div>
							  </div>
							</form>
						</div>
					</div>
					<div id="information">
					</div>
				</div>
			
			</div>
			<div class="col-sm-9">
				<div class="sigma-parent">
					<div class="sigma-expand widget widget-xl" id="sigma-canvas"></div>
				</div>
			</div>
		</div>
		
				
			
			<div id="zoom">
				<div class="z" rel="in"></div> <div class="z" rel="out"></div> <div class="z" rel="center"></div>
			</div>
			<div id="attributepane">
				<div class="text">
					<div title="Close" class="left-close returntext"><div class="c cf"><span>Return to the full network</span></div></div>	
					<div class="headertext">
						<span>Information Pane</span>
					</div>	
					<div class="nodeattributes">
						<div class="name"></div>
						<div class="data"></div>
						<div class="p">Connections:</div>
						<div class="link">
							<ul>
							</ul>
						</div>
					</div>
				</div>
			</div>


	-->















				<div class="row">
					<div class="col-md-8">
						<div class="p-relative" >
							<div id="left_column" 					
								data-form="<?=$form_to_submit?>" 
								class="<?=$mode? 'connected-widgets widget':''?> widget-xl">	
								<?php 
									if(element('left_column', $dashboard_settings)):
										foreach(element('left_column', $dashboard_settings) as $key=>$widget_key):		
											$this->data['widget_key'] = $widget_key;
											echo '<div class="removable-widget" data-widget="'. $widget_key .'">';
											$this->load->view('widgets/'. extract_metakey($widget_key, $delimiter) . '/view', $this->data);									
											echo '</div>';								
										endforeach;					
									endif;	
								?>
							</div>
							<?php 
							if ($mode)
							echo $loading_state; 
							?>
						</div>			
					</div>
					<div class="col-md-4">			
						<div class="p-relative" >
							<div id="right_column" 
								data-form="<?=$form_to_submit?>" 
								class="<?=$mode? 'connected-widgets widget':''?> widget-xl">	
								<?php 
									if(element('right_column', $dashboard_settings)):
										foreach(element('right_column', $dashboard_settings) as $key=>$widget_key):		
											$this->data['widget_key'] = $widget_key;
											echo '<div class="removable-widget" data-widget="'. $widget_key .'">';
											$this->load->view('widgets/'. extract_metakey($widget_key, $delimiter) . '/view', $this->data);									
											echo '</div>';								
										endforeach;					
									endif;	
								?>
							</div>
							<?php 
							if ($mode)
							echo $loading_state; 
							?>
						</div>		
						
					</div>
				</div>
</section>