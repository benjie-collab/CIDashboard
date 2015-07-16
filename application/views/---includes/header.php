<!DOCTYPE html> 
<html lang="en-US">
<head>
  <title>K2 Dashboard</title>
  <meta charset="utf-8">
  
  <link href="<?php echo base_url(); ?>assets/lib/jquery.sortable/jquery-sortable.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/lib/magic.suggest/magicsuggest.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/lib/bootstrap.switch/bootstrap-switch.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/lib/bootstrap.slider/css/slider.css" rel="stylesheet" type="text/css">
  
  <link href="<?php echo base_url(); ?>assets/lib/bootstrap.tour/bootstrap-tour.css" rel="stylesheet" type="text/css">
  
  <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
  
  
  
  
  <!--<link rel="stylesheet" href="assets/lib/awesome.checkbox/bower_components/Font-Awesome/css/font-awesome.css"/>-->
  <link href="<?php echo base_url(); ?>assets/lib/awesome.checkbox/build.css" rel="stylesheet" type="text/css">
  
  
  <!--<link href="<?php echo base_url(); ?>assets/themes/admin/startbootstrap-sb-admin-1.0.2/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/themes/admin/startbootstrap-sb-admin-1.0.2/css/sb-admin.css" rel="stylesheet" type="text/css">-->
  
  
</head>
<body data-twttr-rendered="true">
	
	
	
		<nav class="navbar navbar-masthead navbar-inverse navbar-fixed-top">
		  <div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="<?php echo base_url(); ?>">
				<?php echo $application['title']; ?>
			  </a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse">
			<div id="main-navigation">
			  <ul class="nav navbar-nav">
				<?php 
				foreach($menu as $mn):
				?>						
					<li class="<?php echo strcmp($application['current_method'], $mn['url'])===0?  'active': ''; ?>">
						<?php 
						if( array_key_exists('children',$mn) && is_array($mn['children'])):
						?>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa <?php echo $mn['icon']; ?>"></i> 
							<?php echo $mn['name']; ?>
							<i class="fa fa-fw fa-caret-down"></i>
						</a>
						<ul class="dropdown-menu">
							<?php 
							foreach($mn['children'] as $child):
							?>		
							<li class="<?php echo strcmp($application['current_method'], $child['url'])===0?  'active': ''; ?>">
								<a href="<?php echo base_url() .'index.php/'. $child['url']; ?>"><i class="fa <?php echo $child['icon']; ?>"></i> <?php echo $child['name']; ?></a>
							</li>
							<?php					
								endforeach;					
							?>                          
						</ul>
						<?php
						else:
						?>
						<a href="<?php echo base_url() .'index.php/'. $mn['url']; ?>"><i class="fa <?php echo $mn['icon']; ?>"></i> <?php echo $mn['name']; ?></a>
						
						<?php
						endif; ?>
						
					</li>						
				<?php					
				
				endforeach;					
				?>
			  </ul>
			  </div>
			 
			  <ul class="nav navbar-nav navbar-right" id="user-profile-menu">
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-user"></i> 
					<?php echo $current_user->first_name; ?> <?php echo $current_user->last_name; ?> 
					<b class="caret"></b>
				  </a>
					<ul class="dropdown-menu">
                        <li><?php echo anchor('auth/member', '<i class="fa fa-user"></i> Profile')?> </li>
                        <li><a href="#"><i class="fa fa-envelope"></i> Inbox</a></li>
                        <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                        <li class="divider"></li>
                        <li><?php echo anchor('auth/logout', '<i class="fa fa-fw fa-power-off"></i>Logout')?> </li>
                    </ul>
				</li>
			  </ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		  
		  
		  
		  
		  
		</nav>
	
		

			<div class="container-fluid m-t-40 p-t-20">

