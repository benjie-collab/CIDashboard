<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Dynamic Menu
*
* Version: 0.1
*
* Author: Benjie Bantecil
*		  benz_coe25@hotmail.com
*         @benznext
*
*
*
* Created:  12.03.2015
*
* Description:  
*
* Requirements: PHP5 or above
*
*/

/*
| -------------------------------------------------------------------------
| Misc
| -------------------------------------------------------------------------
| Menu item names.
*/

$config['metakey_delimiter'] = '$@$';







/*
| -------------------------------------------------------------------------
| Tables SQL.
| -------------------------------------------------------------------------
| Menu item names.
*/
$config['tables']['user_meta']	 	= 'user_meta';
$config['tables']['widgets'] 		= 'widgets';
$config['tables']['rules'] 			= 'rules';
$config['tables']['categorization']	= 'categorization';
$config['tables']['servers']		= 'servers';
$config['tables']['uploads']		= 'uploads';
$config['tables']['post_meta']		= 'post_meta';
$config['tables']['posts']			= 'posts';

/*
| -------------------------------------------------------------------------
| Skins.
| -------------------------------------------------------------------------
| Menu item names.
*/
$config['skins']['skin-blue'] 		= 'Blue';
$config['skins']['skin-black'] 		= 'Black';
$config['skins']['skin-purple'] 	= 'Purple';
$config['skins']['skin-green'] 		= 'Green';
$config['skins']['skin-red'] 		= 'Red';
$config['skins']['skin-yellow'] 	= 'Yellow';


/*
| -------------------------------------------------------------------------
| Date Formats.
| -------------------------------------------------------------------------
| Menu item names.
*/
$config['dateformat']['F j, Y'] 	= 'December 1, 2015';
$config['dateformat']['M j, Y'] 	= 'Dec 1, 2015';
$config['dateformat']['j M Y'] 		= '1 Dec 2015';
$config['dateformat']['Y/m/d'] 		= '2015/12/01';
$config['dateformat']['m/d/Y'] 		= '12/01/2015';
$config['dateformat']['d/m/Y'] 		= '01/12/2015';



/*
| -------------------------------------------------------------------------
| Buttons.
| -------------------------------------------------------------------------
| Menu item names.
*/
$config['buttons']['btn-default'] 		= 'Default';
$config['buttons']['btn-primary'] 		= 'Primary';
$config['buttons']['btn-success'] 		= 'Success';
$config['buttons']['btn-info'] 			= 'Info';
$config['buttons']['btn-danger'] 		= 'Danger';
$config['buttons']['btn-warning'] 		= 'Warning';


/*
| -------------------------------------------------------------------------
| Buttons.
| -------------------------------------------------------------------------
| Menu item names.
*/
$config['buttons_size']['btn-xs'] 		= 'x-Small';
$config['buttons_size']['btn-sm'] 		= 'Small';
$config['buttons_size']['btn-md'] 		= 'Medium';
$config['buttons_size']['btn-lg'] 		= 'Large';


/*
| -------------------------------------------------------------------------
| Boxes.
| -------------------------------------------------------------------------
| Menu item names.
*/
$config['boxes']['box-default'] 		= 'Default';
$config['boxes']['box-primary'] 		= 'Primary';
$config['boxes']['box-success'] 		= 'Success';
$config['boxes']['box-info'] 			= 'Info';
$config['boxes']['box-danger'] 		= 'Danger';
$config['boxes']['box-warning'] 		= 'Warning';


/*
| -------------------------------------------------------------------------
| Background.
| -------------------------------------------------------------------------
| Menu item names.
*/
$config['background']['bg-gray'] 		= 'gray';
$config['background']['bg-black'] 		= 'black';
$config['background']['bg-red'] 		= 'red';
$config['background']['bg-yellow'] 		= 'yellow';
$config['background']['bg-aqua'] 		= 'aqua';
$config['background']['bg-blue'] 		= 'blue';
$config['background']['bg-light-blue'] 	= 'light blue';
$config['background']['bg-green'] 		= 'green';
$config['background']['bg-navy'] 		= 'navy';
$config['background']['bg-teal'] 		= 'teal';
$config['background']['bg-olive'] 		= 'olive';
$config['background']['bg-lime'] 		= 'lime';
$config['background']['bg-orange'] 		= 'orange';
$config['background']['bg-fuchsia'] 	= 'fuchsia';
$config['background']['bg-purple'] 		= 'purple';
$config['background']['bg-maroon'] 		= 'maroon';

/*
| -------------------------------------------------------------------------
| Layout.
| -------------------------------------------------------------------------
| Menu item names.
*/
$config['layouts']['fixed'] 			= 'Fixed';
$config['layouts']['layout-boxed'] 		= 'Boxed';
//$config['layouts']['layout-top-nav'] 	= 'Top Nav';
$config['layouts']['sidebar-collapse'] 	= 'Sidebar Collapse';




/*
| -------------------------------------------------------------------------
| Themes.
| -------------------------------------------------------------------------
| Menu item names.
*/
$config['application']['title'] 	= 'K2-A Dashboard';
$config['application']['logo'] 		= 'K2-A Dashboard';
$config['application']['tagline'] 	= 'All-in-one BI Tool';

$config['widget_loading_state'] 	= 	'<div class="overlay"><i class="fa fa fa-refresh fa fa-spin"></i></div>';

$config['widget_options']['bg']['teal']				= 	'Teal';
$config['widget_options']['bg']['light-blue']		= 	'Light Blue';
$config['widget_options']['bg']['blue']				= 	'Blue';
$config['widget_options']['bg']['aqua']				= 	'Aqua';
$config['widget_options']['bg']['yellow']			= 	'Yellow';
$config['widget_options']['bg']['purple']			= 	'Purple';
$config['widget_options']['bg']['green']			= 	'Green';
$config['widget_options']['bg']['red']				= 	'Red';
$config['widget_options']['bg']['black']			= 	'Black';
$config['widget_options']['bg']['maroon']			= 	'Maroon';

$config['widget_options']['size']['widget-xs']		= 	'Extra Small';
$config['widget_options']['size']['widget-sm']		= 	'Small';
$config['widget_options']['size']['widget-md']		= 	'Medium';
$config['widget_options']['size']['widget-lg']		= 	'Large';
$config['widget_options']['size']['widget-xl']		= 	'Extra Large';


$config['fonts']['impact']			= 'Impact';
$config['fonts']['verdana']			= 'Verdana';
$config['fonts']['times new roman']	= 'Times New Roman';
$config['fonts']['tahoma']			= 'Tahoma';
$config['fonts']['trebuchet ms']	= 'Trebuchet MS';
$config['fonts']['lucida console']	= 'Lucida Console';
$config['fonts']['georgia']			= 'Georgia';
$config['fonts']['comic sans ms']	= 'Comic Sans MS';
$config['fonts']['Calibri']			= 'Calibri';
$config['fonts']['Arial Black']		= 'Arial Black';
$config['fonts']['Arial']			= 'Arial';



$config['document_options']['elements']['doc_thumbnail']		= 'Thumbnail';
$config['document_options']['elements']['doc_title[]']			= 'Title';
$config['document_options']['elements']['doc_score']			= 'Score';
$config['document_options']['elements']['doc_meta[]']			= 'Meta';
$config['document_options']['elements']['doc_summary[]']		= 'Summary';
$config['document_options']['elements']['doc_content']			= 'Content';
$config['document_options']['elements']['doc_extra[]']			= 'Extra';








/*
| -------------------------------------------------------------------------
| Menu.
| -------------------------------------------------------------------------
| Menu item names.
*/

$config['menu'] = array(
						array( 
							'name'=> 'Dashboard',
							'url'=> 'dashboard',
							'icon'=> 'fa fa-dashboard',
							'admin'=> false),
						array( 
							'name'=> 'Media',
							'url'=> 'media',
							'icon'=> 'fa fa-image',
							'admin'=> false),
						array( 
							'name'=> 'Documents',
							'url'=> 'document',
							'icon'=> 'fa fa-file-text-o',
							'admin'=> false),
						array( 
								'name'=> 'Users',
								'url'=> 'user/index',
								'icon'=> 'fa ion-person-stalker',
							'admin'=> true),
						array( 
							'name'=> 'Departments',
							'url'=> 'departments/index',
							'icon'=> 'fa fa-building',
							'admin'=> true),
								
						array( 
							'name'=> 'Servers',
							'url'=> 'servers/index',
							'icon'=> 'fa fa-server',
							'admin'=> true),
						array( 
							'name'=> 'Statistics',
							'url'=> 'statistics/index',
							'icon'=> 'fa fa-area-chart',
							'admin'=> false),
						array( 
							'name'=> 'Settings',
							'url'=> 'settings',
							'icon'=> 'fa fa-cog',
							'admin'=> true,
							'submenu' =>
								array(
									array( 
										'name'=> 'General',
										'url'=> 'settings/general',
										'icon'=> 'fa fa-circle-o',
										'admin'=> true),
									array( 
										'name'=> 'Styles',
										'url'=> 'settings/styles',
										'icon'=> 'fa fa-circle-o',
										'admin'=> true),	
									array( 
										'name'=> 'Search',
										'url'=> 'settings/search',
										'icon'=> 'fa fa-circle-o',
										'admin'=> true),	
									
									)
								
							),
				);
/**
$config['menu']['default'] = array(
						array( 
							'name'=> 'Dashboard',
							'url'=> 'dashboard',
							'icon'=> 'fa fa-dashboard'),
						array( 
							'name'=> 'Media',
							'url'=> 'media',
							'icon'=> 'fa fa-image'),
						array( 
							'name'=> 'Documents',
							'url'=> 'document',
							'icon'=> 'fa fa-file-text-o')
						);
$config['menu']['admin'] = 
						array(
							array( 
								'name'=> 'Users',
								'url'=> 'user/index',
								'icon'=> 'fa ion-person-stalker'),
							array( 
								'name'=> 'Departments',
								'url'=> 'departments/index',
								'icon'=> 'fa fa-building'),
									
							array( 
								'name'=> 'Servers',
								'url'=> 'servers/index',
								'icon'=> 'fa fa-server'
								),
							array( 
								'name'=> 'Statistics',
								'url'=> 'statistics/index',
								'icon'=> 'fa fa-area-chart'
								),
							array( 
								'name'=> 'Settings',
								'url'=> 'settings',
								'icon'=> 'fa fa-cog',
								'submenu' =>
									array(
										array( 
											'name'=> 'General',
											'url'=> 'settings/general',
											'icon'=> 'fa fa-circle-o'),
										array( 
											'name'=> 'Styles',
											'url'=> 'settings/styles',
											'icon'=> 'fa fa-circle-o'),	
										array( 
											'name'=> 'Search',
											'url'=> 'settings/search',
											'icon'=> 'fa fa-circle-o'),	
										
										)
									
								),
						);						
						
						
$config['menu']['member'] = array(
								array( 
								'name'=> 'Search',
								'url'=> 'search/index',
								'icon'=> 'fa fa-search'
								),
							array( 
								'name'=> 'Statistics',
								'url'=> 'statistics/index',
								'icon'=> 'fa fa-area-chart'
								)
							);**/
							

							
/*
 | -------------------------------------------------------------------------
 | Message Delimiters.
 | -------------------------------------------------------------------------
 */
//$config['delimiters_source']       = 'config'; 	// "config" = use the settings defined here, "form_validation" = use the settings defined in CI's form validation library
$config['error_start_delimiter'] 		= '<div class="alert alert-dismissable alert-danger"><i class="fa fa-exclamation-circle"></i> '; 
$config['error_end_delimiter']   		= '</div>'; 
$config['info_start_delimiter']   		= '<div class="alert alert-dismissable alert-info"><i class="fa fa-info-circle"></i> ';		
$config['info_end_delimiter']     		= '</div>'; 
$config['warning_start_delimiter'] 		= '<div class="alert alert-dismissable alert-warning"><i class="fa fa-warning"></i> '; 
$config['warning_end_delimiter']   		= '</div>'; 
$config['success_start_delimiter']   	= '<div class="alert alert-dismissable alert-success"><i class="fa fa-check-circle"></i> ';		
$config['success_end_delimiter']     	= '</div>'; 