<!DOCTYPE html> 
<html lang="en-US">
<head>
	<?php 		
		$application 	= $this->application->data();	
		$styles 		= $this->application->styles_setting();
		$template_url 	= base_url('assets/themes/lte/');
		
		$settings 		= $this->application->general_setting();
		$layout			= element('layout', $styles);
		$layout			 = $layout && is_array($layout)? implode(" ", $layout) : '';
		$layout 		= (is_page() || is_search())? 'sidebar-collapse fixed' : $layout;
		$skin 			= element('skin', $styles);
		
		if(is_page() && isset($page) && isset($page->styles)){		
			$styles_meta = (object)$page->styles;
			$skin = isset($styles_meta->skin)? $styles_meta->skin : $skin;
		}
		
	?>
	<title><?=element('title', $application)?>- <?=isset($title)? $title: ''?></title>
	<meta charset="utf-8">
	<link rel="icon" 
      type="image/png" 
      href="<?=base_url(element('favicon', $settings))?>">
	<link href="<?= base_url('assets/css/global.css'); ?>" rel="stylesheet" type="text/css">  
	<link href="<?= $template_url?>/css/LTE.min.css" rel="stylesheet" type="text/css"> 
	<link href="<?= $template_url?>/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css"> 
	<link href="<?= base_url('assets/lib/magic.suggest/magicsuggest.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/lib/bootstrap.switch/bootstrap-switch.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/lib/bootstrap.slider/css/bootstrap-slider.css'); ?>" rel="stylesheet" type="text/css"> 
	<link href="<?= base_url('assets/lib/bootstrap.jspanel/jsPanel.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/lib/bootstrap.datetimepicker/css/bootstrap-datetimepicker.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/lib/bootstrap.daterangepicker/css/daterangepicker-bs3.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/lib/bootstrap.colorpicker/css/bootstrap-colorpicker.css'); ?>" rel="stylesheet" type="text/css">  
	<link href="<?= base_url('assets/lib/bootstrap.wysihtml5/src/bootstrap-wysihtml5.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/lib/bootstrap.tokenfield/css/bootstrap-tokenfield.min.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/lib/bootstrap.iconpicker/css/fontawesome-iconpicker.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/lib/bootstrap.select/css/bootstrap-select.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/lib/bootstrap.select.ajax/css/ajax-bootstrap-select.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/lib/jquery.treegrid/css/jquery-treegrid.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/lib/jquery.easytree/css/jquery-easytree.css'); ?>" rel="stylesheet" type="text/css">
	<!--<link href="<?= base_url('assets/lib/jquery.anylist.scroller/css/jquery.als.css'); ?>" rel="stylesheet" type="text/css">	-->
	<link href="<?= base_url('assets/lib/jquery.customscrollbar/css/jquery.customscrollbar.css'); ?>" rel="stylesheet" type="text/css">
	<!--<link href="<?= base_url('assets/lib/masonry/css/masonry.css'); ?>" rel="stylesheet" type="text/css">-->
	
	<link href="<?= base_url('assets/lib/jquery.datatables/plugins/integration/bootstrap/3/dataTables.bootstrap.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/lib/jquery.datatables/extensions/Responsive/css/dataTables.responsive.css'); ?>" rel="stylesheet" type="text/css">
	
	<link href="<?= base_url('assets/lib/jquery.jsonview/dist/jquery.jsonview.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?= base_url('assets/lib/bootstrap.fileinput/css/fileinput.css'); ?>" rel="stylesheet" type="text/css">
	
	<link href="<?= base_url('assets/lib/dropzone/dist/dropzone.css'); ?>" rel="stylesheet" type="text/css">
	
	
	
	<link href="<?= base_url('assets/lib/dtree/css/dtree.css'); ?>" rel="stylesheet" type="text/css">  
	<link href="<?= base_url('assets/lib/fancytree/skin-xp/ui.fancytree.css'); ?>" rel="stylesheet" type="text/css">  
	<link href="<?= base_url('assets/lib/bootstrap.tour/bootstrap-tour.css'); ?>" rel="stylesheet" type="text/css">  
	<link href="<?= base_url('assets/lib/awesome.checkbox/build.css'); ?>" rel="stylesheet" type="text/css">	
	<link href="<?= base_url('assets/lib/map-icons/css/map-icons.css'); ?>" rel="stylesheet" type="text/css">	
</head>
<body class="<?=$layout?> <?=$skin?>">
	<div class="wrapper">