 <?php 
	$current_user 	= $this->users->user()->row();	
	$template_url 	= base_url('assets/themes/lte/');	
	$application 	= $this->application->data();
	$menu 			= $this->application->menu();	
	$item			= $this->uri->segment(3);	
	$modal_size		= is_statistic()? 'modal-full-screen' : 'modal-lg';
	
 ?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

  <!-- Sidebar user panel (optional) -->
  <div class="user-panel">
	<div class="pull-left image">
	  <img src="<?=base_url($current_user->profile_pic)?>" class="img-circle" alt="<?=$current_user->first_name?> <?=$current_user->last_name?>"/>
	</div>
	<div class="pull-left info">
	  <p><?php echo $current_user->first_name; ?> <?php echo $current_user->last_name; ?> </p>
	  <!-- Status -->
	  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
	</div>
  </div>

  <!-- search form (Optional) -->
  <?php echo form_open('/search', array('class' => 'sidebar-form'));?>
	<div class="input-group">
	  <input type="text" name="text" class="form-control" placeholder="Search..."/>
	  <span class="input-group-btn">
		<button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
	  </span>
	</div>
  <?php echo form_close();?>
  <!-- /.search form -->

  <!-- Sidebar Menu -->
  <ul class="sidebar-menu">
  
	<li class="header">MAIN</li>
	<?php 
	foreach($menu as $mn):
	?>						
		<li class="<?=array_key_exists('submenu',$mn)? 'treeview': ''?> 
			<?php 
				echo strcasecmp($application['current_class'], element('url', $mn))==0 || strcasecmp(element('current_method', $application), element('url', $mn) )==0?  
			'active': ''; ?>">				
			<?php 
			if( array_key_exists('submenu',$mn) && is_array($mn['submenu'])):
			?>
			<a href="#">
				<i class="fa <?php echo $mn['icon']; ?>"></i> 
				<?php echo $mn['name']; ?>				
				<i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<?php 
				foreach($mn['submenu'] as $child):
				?>		
					
						<li class="<?php echo strcasecmp(element('current_method', $application), element('url', $child))==0?  'active': ''; ?>">						
							<a href="<?php echo base_url() . $child['url']; ?>"><i class="<?php echo $child['icon']; ?>"></i> <?php echo $child['name']; ?></a>
						</li>
				<?php	
					endforeach;					
				?>                          
			</ul>
			<?php
			else:
			?>
			<a href="<?php echo base_url() . $mn['url']; ?>"><i class="fa <?php echo $mn['icon']; ?>"></i> <?php echo $mn['name']; ?></a>
			
			<?php
			endif; ?>
			
		</li>						
	<?php					
	
	endforeach;					
	?>
	
	
	
	<li class="treeview <?=strcasecmp($application['current_class'], 'tools')==0? 'active': '' ?>">				
		<a href="#">
			<i class="fa fa-wrench"></i> 
			Tools
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<?php 
			$tool = $application['current_fetch_method'];
			$tools = $this->application->get_methods('application/views/tools/pages/');
			foreach($tools as $tl):
			?>						
					<li class="<?=strcasecmp(element('@method', $tl), $tool)===0 ? 'active':'' ?>">						
						<a href="<?=base_url('/tools/' . element('@method', $tl))?>"><i class="fa <?=element('@icon', $tl)?>"></i> <?=element('@title', $tl)?></a>
					</li>
			<?php	
			endforeach;					
			?>                          
		</ul>
	</li>
	
	
	<?php 
	$user_ids[] = $current_user->id;
	$user_pages 		= $this->pages_model->get_pages(
							$user_ids,
							array()
						);
						
	$user_ids = (array)$this->users->users(1) ;
	$user_ids = array_column($user_ids, 'id');
	$other_pages 		= $this->pages_model->get_pages(
						$user_ids,
						array(
							'active'=> true,
							'user_id !=' => $current_user->id
						)
						);
	
	$user_page_ids = array_map(function($n){ return $n->id; }, $user_pages);
	$other_page_ids = array_map(function($n){ return $n->id; }, $other_pages);
	
	?>
	
	
	<li class="header" id="pages-scroll">Pages</li>	
	<li class="treeview <?=strcasecmp($application['current_class'], 'pages')==0 && in_array($item, $user_page_ids) ? 'active': '' ?>">
		<a href="#"><i class="fa fa-circle-o text-info"></i>My Pages <i class="fa fa-angle-left pull-right"></i></a>
		<ul class="treeview-menu">
			<?php 
			foreach($user_pages as $pg):
			$active = (bool)isset($pg->active)? $pg->active: false;
			?>		
			<li class="<?=$item==$pg->id? 'active': ''?> <?=$item?>">
				<a href="<?=base_url('pages/index')?>/<?=$pg->id?>">
					<i class="ion-ios-albums-outline ion"></i> 
					<?=$pg->post_title?>					
					<small class="label label-danger pull-right <?=$active? 'hidden': ''?>">inactive</small>
				</a>
			</li>
			<?php		
			endforeach;				
			?>
		</ul>
	</li>
	<li class="treeview <?=strcasecmp($application['current_class'], 'pages')==0 && in_array($item, $other_page_ids) ? 'active': '' ?>">
		<a href="#"><i class="fa fa-circle-o text-success"></i>Other Pages <i class="fa fa-angle-left pull-right"></i></a>
		<ul class="treeview-menu">
			<?php 
			foreach($other_pages as $pg):
			?>		
			<li class="<?=$item==$pg->id? 'active': ''?>">
				<a href="<?=base_url('pages/index')?>/<?=$pg->id?>">
					<i class="ion-ios-albums-outline ion"></i> 
					<?=$pg->post_title?>
				</a>
			</li>
			<?php		
			endforeach;				
			?>
		</ul>
	</li>
	
	<li class=""
		data-bbind="ScrollToFixed:{ bottom: 10, limit: $('#pages-scroll').offset().top}"
	>	
		<a class="text-info"
			data-remote="<?=base_url('pages/add/?title='.urlencode('Add New Page'))?>"
			data-backdrop="static" data-toggle="modal" href="#modal-page-options"
		>
			<i class="fa fa-plus"></i> 
			New Page
		</a>
	</li>
	
	
	
  </ul><!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>

<div class="modal fade" id="modal-page-options">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
			<div class="text-center has-spinner active">
				<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>
			</div>
			</div>			
		</div>
	  </div>
</div>

<div class="modal fade" id="modal-user">
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

<div class="modal fade" id="modal-widget-options">
	<div class="modal-dialog <?=$modal_size?>">
		<div class="modal-content">
			<div class="modal-body">
			<div class="text-center has-spinner active">
				<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>
			</div>
			</div>			
		</div>
	</div>
</div>

<div class="modal fade" id="modal-widget">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
			<div class="text-center has-spinner active">
				<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>
			</div>
			</div>			
		</div>
	</div>
</div>

<div class="modal fade" id="modal-add-widget">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
			<div class="text-center has-spinner active">
				<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>
			</div>
			</div>			
		</div>
	</div>
</div>


<div class="modal fade" id="modal-configure-statistics">
	<div class="modal-dialog modal-full-screen">
		<div class="modal-content">
			<div class="modal-body">
			<div class="text-center has-spinner active">
				<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>
			</div>
			</div>			
		</div>
	</div>
</div>








