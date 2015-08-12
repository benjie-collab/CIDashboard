 <?php 
	$current_user 	= $this->users->user()->row();	
	$template_url 	= base_url('assets/themes/lte/');		
	$application 	= $this->template_model->application_data();
		
	$styles 			= $this->application->styles_setting();
	$settings 			= $this->application->general_setting();
	$header_hidden		= (is_page() || is_search()) ? 'hidden': ''; 
	
 ?>
 <!-- Main Header -->
<header class="main-header <?=$header_hidden?>">

<!-- Logo -->
<a href="<?=base_url()?>" class="logo"><?=element('title', $settings); ?></a>

<!-- Header Navbar -->
<nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
	<span class="sr-only">Toggle navigation</span>
  </a>
  <!-- Navbar Right Menu -->
  <div class="navbar-custom-menu">
	<ul class="nav navbar-nav">
	  <!-- Messages: style can be found in dropdown.less-->
	  <li class="dropdown messages-menu">
		<!-- Menu toggle button -->
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		  <i class="fa fa-envelope-o"></i>
		  <span class="label label-success">4</span>
		</a>
		<ul class="dropdown-menu">
		  <li class="header">You have 4 messages</li>
		  <li>
			<!-- inner menu: contains the messages -->
			<ul class="menu">
			  <li><!-- start message -->
				<a href="#">
				  <div class="pull-left">
					<!-- User Image -->
					<img src="<?=base_url($current_user->profile_pic)?>" class="img-circle" alt="<?=$current_user->first_name?> <?=$current_user->last_name?>"/>
				  </div>
				  <!-- Message title and timestamp -->
				  <h4>                            
					Support Team
					<small><i class="fa fa-clock-o"></i> 5 mins</small>
				  </h4>
				  <!-- The message -->
				  <p>Why not buy a new awesome theme?</p>
				</a>
			  </li><!-- end message -->                      
			</ul><!-- /.menu -->
		  </li>
		  <li class="footer"><a href="#">See All Messages</a></li>
		</ul>
	  </li><!-- /.messages-menu -->

	  <!-- Notifications Menu -->
	  <li class="dropdown notifications-menu">
		<!-- Menu toggle button -->
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		  <i class="fa fa-bell-o"></i>
		  <span class="label label-warning">10</span>
		</a>
		<ul class="dropdown-menu">
		  <li class="header">You have 10 notifications</li>
		  <li>
			<!-- Inner Menu: contains the notifications -->
			<ul class="menu">
			  <li><!-- start notification -->
				<a href="#">
				  <i class="fa fa-users text-aqua"></i> 5 new members joined today
				</a>
			  </li><!-- end notification -->                      
			</ul>
		  </li>
		  <li class="footer"><a href="#">View all</a></li>
		</ul>
	  </li>
	  <!-- Tasks Menu -->
	  <li class="dropdown tasks-menu">
		<!-- Menu Toggle Button -->
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		  <i class="fa fa-flag-o"></i>
		  <span class="label label-danger">9</span>
		</a>
		<ul class="dropdown-menu">
		  <li class="header">You have 9 tasks</li>
		  <li>
			<!-- Inner menu: contains the tasks -->
			<ul class="menu">
			  <li><!-- Task item -->
				<a href="#">
				  <!-- Task title and progress text -->
				  <h3>
					Design some buttons
					<small class="pull-right">20%</small>
				  </h3>
				  <!-- The progress bar -->
				  <div class="progress xs">
					<!-- Change the css width attribute to simulate progress -->
					<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
					  <span class="sr-only">20% Complete</span>
					</div>
				  </div>
				</a>
			  </li><!-- end task item -->                      
			</ul>
		  </li>
		  <li class="footer">
			<a href="#">View all tasks</a>
		  </li>
		</ul>
	  </li>
	  <!-- User Account Menu -->
	  <li class="dropdown user user-menu">
		<!-- Menu Toggle Button -->
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		  <!-- The user image in the navbar-->
		  <img src="<?=base_url($current_user->profile_pic)?>" class="user-image" alt="<?=$current_user->first_name?> <?=$current_user->last_name?>"/>
		  <!-- hidden-xs hides the username on small devices so only the image appears. -->
		  <span class="text-capitalize hidden-xs"><?=$current_user->first_name; ?></span> <span class="text-capitalize hidden-xs"><?=$current_user->last_name; ?></span>
		</a>
		<ul class="dropdown-menu">
		  <!-- The user image in the menu -->
		  <li class="user-header">
			<img src="<?=base_url($current_user->profile_pic)?>" class="img-circle" alt="<?=$current_user->first_name?> <?=$current_user->last_name?>"/>
			<p>
			  <span class="text-capitalize"><?=$current_user->first_name; ?></span> <span class="text-capitalize"><?=$current_user->last_name; ?></span>
			  <small>Member since <?=date('M Y', $current_user->created_on)?></small>
			</p>
		  </li>
		  <!-- Menu Body -->
		  <li class="user-body">
			<div class="col-xs-4 text-center">
			  <a href="#">Followers</a>
			</div>
			<div class="col-xs-4 text-center">
			  <a href="#">Sales</a>
			</div>
			<div class="col-xs-4 text-center">
			  <a href="#">Friends</a>
			</div>
		  </li>
		  <!-- Menu Footer-->
		  <li class="user-footer">
			<div class="pull-left">				
			  <?php echo anchor('user/profile/', 'Profile', 'class="btn btn-default btn-flat"')?> 
			</div>
			<div class="pull-right">
			  <?php echo anchor('user/logout', 'Sign out', 'class="btn btn-default btn-flat"')?> 
			</div>
		  </li>
		</ul>
	  </li>
	</ul>
  </div>
</nav>
</header>
