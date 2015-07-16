<section class="content-header">
  <h1>
	<?=element('page_name', $page); ?>
  </h1>
</section>
<section class="content">	
	<p>
		<?=element('page_desc', $page); ?>
	</p>
	<div class="row">		
		<div class="col-md-3">
			<?php $name = 'page_widget_left_1'; ?>
			<div id="<?=$name?>" class="">
				<?php 
					if(element($name, $page)):
						foreach(element($name, $page) as $key=>$widget_key):
							
							
							
							$keys = $this->statistics_lib->extract_Key($widget_key);							
							$this->data['keys'] = $keys;
							$this->data['widget_key'] = $widget_key;
							$this->load->view('widgets/'.element('type', $keys). '/view', $this->data);			
						endforeach;					
					endif;					
				?>
			</div>
			<?php $name = 'page_widget_left_2'; ?>
			<div id="<?=$name?>" class="">
				<?php 
					if(element($name, $page)):
						foreach(element($name, $page) as $key=>$widget_key):
							$meta = array( 'widget_key' => $widget_key);
							$keys = $this->statistics_lib->extract_Key($widget_key);
							$this->data['keys'] = $keys;
							$this->data['widget_key'] = $widget_key;
							$this->load->view('widgets/'.$keys['type']. '/view', $this->data);					
						endforeach;					
					endif;					
				?>
			</div>
			<?php $name = 'page_widget_left_3'; ?>
			<div id="<?=$name?>" class="">
				<?php 
					if(element($name, $page)):
						foreach(element($name, $page) as $key=>$widget_key):
							$meta = array( 'widget_key' => $widget_key);
							$keys = $this->statistics_lib->extract_Key($widget_key);
							$this->data['keys'] = $keys;
							$this->data['widget_key'] = $widget_key;
							$this->load->view('widgets/'.$keys['type']. '/view', $this->data);					
						endforeach;					
					endif;					
				?>
			</div>
			<?php $name = 'page_widget_left_4'; ?>
			<div id="<?=$name?>" class="">
				<?php 
					if(element($name, $page)):
						foreach(element($name, $page) as $key=>$widget_key):
							$meta = array( 'widget_key' => $widget_key);
							$keys = $this->statistics_lib->extract_Key($widget_key);
							$this->data['keys'] = $keys;
							$this->data['widget_key'] = $widget_key;
							$this->load->view('widgets/'.$keys['type']. '/view', $this->data);					
						endforeach;					
					endif;					
				?>
			</div>
		</div>
		
		<div class="col-md-6">
			<?php $name = 'page_widget_content_1'; ?>
			<div id="<?=$name?>" class="">
				<?php 
					if(element($name, $page)):
						foreach(element($name, $page) as $key=>$widget_key):
							$meta = array( 'widget_key' => $widget_key);
							$keys = $this->statistics_lib->extract_Key($widget_key);
							$this->data['keys'] = $keys;
							$this->data['widget_key'] = $widget_key;
							$this->load->view('widgets/'.$keys['type']. '/view', $this->data);					
						endforeach;					
					endif;					
				?>
			</div>
		
			<div id="page_content_carousel" class="carousel slide" data-ride="carousel" data-interval="false">
				<ol class="carousel-indicators">
				  <li data-target="#page_content_carousel" data-slide-to="0" class="active"></li>
				  <li data-target="#page_content_carousel" data-slide-to="1" class=""></li>
				  <li data-target="#page_content_carousel" data-slide-to="2" class=""></li>
				</ol>
				<div class="carousel-inner">
				  <div id="page_content_carousel_1" class="item  active">					
						<?php $name = 'page_widget_content_carousel_1'; ?>
						<div id="<?=$name?>" class="">
							<?php 
								if(element($name, $page)):
									foreach(element($name, $page) as $key=>$widget_key):										
										$meta = array( 'widget_key' => $widget_key);
										$keys = $this->statistics_lib->extract_Key($widget_key);
										$this->data['keys'] = $keys;
										$this->data['widget_key'] = $widget_key;
										$this->data['event'] = 'carousel';
										$this->load->view('widgets/'.$keys['type']. '/view', $this->data);					
									endforeach;					
								endif;					
							?>
						</div>
				  </div>
				  <div id="page_content_carousel_2" class="item ">
						<?php $name = 'page_widget_content_carousel_2'; ?>
						<div id="<?=$name?>" class="">
							<?php 
								if(element($name, $page)):
									foreach(element($name, $page) as $key=>$widget_key):
										$meta = array( 'widget_key' => $widget_key);
										$keys = $this->statistics_lib->extract_Key($widget_key);
										$this->data['keys'] = $keys;
										$this->data['widget_key'] = $widget_key;
										$this->data['event'] = 'carousel';
										$this->load->view('widgets/'.$keys['type']. '/view', $this->data);					
									endforeach;					
								endif;					
							?>
						</div>
				  </div>
				  <div id="page_content_carousel_3" class="item ">
						<?php $name = 'page_widget_content_carousel_3'; ?>
						<div id="<?=$name?>" class="">
							<?php 
								if(element($name, $page)):
									foreach(element($name, $page) as $key=>$widget_key):
										$meta = array( 'widget_key' => $widget_key);
										$keys = $this->statistics_lib->extract_Key($widget_key);
										$this->data['keys'] = $keys;
										$this->data['widget_key'] = $widget_key;
										$this->data['event'] = 'carousel';
										$this->load->view('widgets/'.$keys['type']. '/view', $this->data);					
									endforeach;					
								endif;					
							?>
						</div>
				  </div>
				</div>
				<a class="left carousel-control" href="#page_content_carousel" data-slide="prev">
				  <span class="fa fa-angle-left"></span>
				</a>
				<a class="right carousel-control" href="#page_content_carousel" data-slide="next">
				  <span class="fa fa-angle-right"></span>
				</a>
			</div>
		
		
		
		
		
		
		
			<div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right ui-sortable-handle">
                  <li class="active">
					<a data-toggle="tab" href="javascript:void(0)" data-target="#page_content_4_tab_1">
						<?php $name = 'page_widget_content_4_tab_1'; ?>
						<?php 
							$tab_name = 'tab 1';
							if(element($name, $page)):
								foreach(element($name, $page) as $key=>$widget_key):
									$settings = $this->widgets_model->get_widget(NULL, array('widget_key' => $widget_key));
									$settings = json_decode($settings);
									$tab_name= $settings->short_name;
								endforeach;					
							endif;
							echo $tab_name;
						?>
					</a></li>
                  <li>
					<a data-toggle="tab" href="javascript:void(0)" data-target="#page_content_4_tab_2">
						<?php $name = 'page_widget_content_4_tab_2'; ?>
						<?php 
							$tab_name = 'tab 2';
							if(element($name, $page)):
								foreach(element($name, $page) as $key=>$widget_key):
									$settings = $this->widgets_model->get_widget(NULL, array('widget_key' => $widget_key));
									$settings = json_decode($settings);
									$tab_name= $settings->short_name;
								endforeach;					
							endif;	
							echo $tab_name;
						?>
					</a></li>
				  <li>
					<a data-toggle="tab" href="javascript:void(0)" data-target="#page_content_4_tab_3">
						<?php $name = 'page_widget_content_4_tab_3'; ?>
						<?php 
							$tab_name = 'tab 3';
							if(element($name, $page)):
								foreach(element($name, $page) as $key=>$widget_key):
									$settings = $this->widgets_model->get_widget(NULL, array('widget_key' => $widget_key));
									$settings = json_decode($settings);
									$tab_name= $settings->short_name;
								endforeach;					
							endif;
							echo $tab_name;
						?>
					</a></li>
				  <li>
					<a data-toggle="tab" href="javascript:void(0)" data-target="#page_content_4_tab_4">
						<?php $name = 'page_widget_content_4_tab_4'; ?>
						<?php 
							$tab_name = 'tab 4';
							if(element($name, $page)):
								foreach(element($name, $page) as $key=>$widget_key):
									$settings = $this->widgets_model->get_widget(NULL, array('widget_key' => $widget_key));
									$settings = json_decode($settings);
									$tab_name= $settings->short_name;
								endforeach;					
							endif;		
							echo $tab_name;
						?>
					</a></li>
				  <li>
					<a data-toggle="tab" href="javascript:void(0)" data-target="#page_content_4_tab_5">
						<?php $name = 'page_widget_content_4_tab_5'; ?>
						<?php 
							$tab_name = 'tab 5';
							if(element($name, $page)):
								foreach(element($name, $page) as $key=>$widget_key):
									$settings = $this->widgets_model->get_widget(NULL, array('widget_key' => $widget_key));
									$settings = json_decode($settings);
									$tab_name= $settings->short_name;
								endforeach;					
							endif;					
							
							echo $tab_name;
						?>
					</a></li>
                </ul>
                <div class="tab-content no-padding p-relative">
					<div id="page_content_4_tab_1" class="tab-pane active">
						<?php $name = 'page_widget_content_4_tab_1'; ?>
						<div id="<?=$name?>" class="">
							<?php 
								if(element($name, $page)):
									foreach(element($name, $page) as $key=>$widget_key):
										$meta = array( 'widget_key' => $widget_key);
										$keys = $this->statistics_lib->extract_Key($widget_key);
										$this->data['keys'] = $keys;
										$this->data['widget_key'] = $widget_key;
										$this->data['event'] = 'tab';
										$this->load->view('widgets/'.$keys['type']. '/view', $this->data);					
									endforeach;					
								endif;					
							?>
						</div>
					</div>
					<div id="page_content_4_tab_2" class="tab-pane ">
						<?php $name = 'page_widget_content_4_tab_2'; ?>
						<div id="<?=$name?>" class="">
							<?php 
								if(element($name, $page)):
									foreach(element($name, $page) as $key=>$widget_key):
										$meta = array( 'widget_key' => $widget_key);
										$keys = $this->statistics_lib->extract_Key($widget_key);
										$this->data['keys'] = $keys;
										$this->data['widget_key'] = $widget_key;
										$this->data['event'] = 'tab';
										$this->load->view('widgets/'.$keys['type']. '/view', $this->data);					
									endforeach;					
								endif;					
							?>
						</div>
						
					</div>
					<div id="page_content_4_tab_3" class="tab-pane ">
						<?php $name = 'page_widget_content_4_tab_3'; ?>
						<div id="<?=$name?>" class="">
							<?php 
								if(element($name, $page)):
									foreach(element($name, $page) as $key=>$widget_key):
										$meta = array( 'widget_key' => $widget_key);
										$keys = $this->statistics_lib->extract_Key($widget_key);
										$this->data['keys'] = $keys;
										$this->data['widget_key'] = $widget_key;
										$this->data['event'] = 'tab';
										$this->load->view('widgets/'.$keys['type']. '/view', $this->data);					
									endforeach;					
								endif;					
							?>
						</div>
						
					</div>
					<div id="page_content_4_tab_4" class="tab-pane ">
						<?php $name = 'page_widget_content_4_tab_4'; ?>
						<div id="<?=$name?>" class="">
							<?php 
								if(element($name, $page)):
									foreach(element($name, $page) as $key=>$widget_key):
										$meta = array( 'widget_key' => $widget_key);
										$keys = $this->statistics_lib->extract_Key($widget_key);
										$this->data['keys'] = $keys;
										$this->data['widget_key'] = $widget_key;
										$this->data['event'] = 'tab';
										$this->load->view('widgets/'.$keys['type']. '/view', $this->data);					
									endforeach;					
								endif;					
							?>
						</div>						
					</div>
					<div id="page_content_4_tab_5" class="tab-pane ">
						<?php $name = 'page_widget_content_4_tab_4'; ?>
						<div id="<?=$name?>" class="">
							<?php 
								if(element($name, $page)):
									foreach(element($name, $page) as $key=>$widget_key):
										$meta = array( 'widget_key' => $widget_key);
										$keys = $this->statistics_lib->extract_Key($widget_key);
										$this->data['keys'] = $keys;
										$this->data['widget_key'] = $widget_key;
										$this->data['event'] = 'tab';
										$this->load->view('widgets/'.$keys['type']. '/view', $this->data);					
									endforeach;					
								endif;					
							?>
						</div>						
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-3">
			<?php $name = 'page_widget_right_1'; ?>
			<div id="<?=$name?>" class="">
				<?php 
					if(element($name, $page)):
						foreach(element($name, $page) as $key=>$widget_key):
							$meta = array( 'widget_key' => $widget_key);
							$keys = $this->statistics_lib->extract_Key($widget_key);
							$this->data['keys'] = $keys;
							$this->data['widget_key'] = $widget_key;
							$this->load->view('widgets/'.$keys['type']. '/view', $this->data);					
						endforeach;					
					endif;					
				?>
			</div>
			<?php $name = 'page_widget_right_2'; ?>
			<div id="<?=$name?>" class="">
				<?php 
					if(element($name, $page)):
						foreach(element($name, $page) as $key=>$widget_key):
							$meta = array( 'widget_key' => $widget_key);
							$keys = $this->statistics_lib->extract_Key($widget_key);
							$this->data['keys'] = $keys;
							$this->data['widget_key'] = $widget_key;
							$this->load->view('widgets/'.$keys['type']. '/view', $this->data);					
						endforeach;					
					endif;					
				?>
			</div>
			<?php $name = 'page_widget_right_3'; ?>
			<div id="<?=$name?>" class="">
				<?php 
					if(element($name, $page)):
						foreach(element($name, $page) as $key=>$widget_key):
							$meta = array( 'widget_key' => $widget_key);
							$keys = $this->statistics_lib->extract_Key($widget_key);
							$this->data['keys'] = $keys;
							$this->data['widget_key'] = $widget_key;
							$this->load->view('widgets/'.$keys['type']. '/view', $this->data);					
						endforeach;					
					endif;					
				?>
			</div>
			<?php $name = 'page_widget_right_4'; ?>
			<div id="<?=$name?>" class="">
				<?php 
					if(element($name, $page)):
						foreach(element($name, $page) as $key=>$widget_key):
							$meta = array( 'widget_key' => $widget_key);
							$keys = $this->statistics_lib->extract_Key($widget_key);
							$this->data['keys'] = $keys;
							$this->data['widget_key'] = $widget_key;
							$this->load->view('widgets/'.$keys['type']. '/view', $this->data);					
						endforeach;					
					endif;					
				?>
			</div>
		</div>
		
	</div>
</section>


