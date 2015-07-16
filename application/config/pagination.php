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
 | Pagination
 | -------------------------------------------------------------------------
 */

 /* Basic */
$config['pagination']['per_page'] 				= 10;
$config['pagination']['base_url'] 				= base_url().'search/index/';
$config['pagination']['total_rows'] 			= 0;

/* Customizing the Pagination */
$config['pagination']['uri_segment'] 			= 3;
$config['pagination']['num_links'] 				= 3;
$config['pagination']['use_page_numbers'] 		= 'true';
$config['pagination']['page_query_string'] 		= 'true';

/* Adding Enclosing Markup */
$config['pagination']['full_tag_open'] 			= '<ul class="pagination pagination-sm m-0">';
$config['pagination']['full_tag_close'] 			= '</ul>';

/* Customizing the First Link */
$config['pagination']['first_link'] 				= 'First';
$config['pagination']['first_tag_open'] 			= '<li>';
$config['pagination']['first_tag_close'] 			= '</li>';

/* Customizing the Last Link */
$config['pagination']['last_link'] 				= 'Last';
$config['pagination']['last_tag_open'] 			= '<li>';
$config['pagination']['last_tag_close'] 			= '</li>';

/* Customizing the "Next" Link */
$config['pagination']['next_link'] 				= '»';
$config['pagination']['next_tag_open'] 			= '<li>';
$config['pagination']['next_tag_close'] 			= '</li>';

/* Customizing the "Previous" Link */
$config['pagination']['prev_link'] 				= '«';
$config['pagination']['prev_tag_open'] 			= '<li>';
$config['pagination']['prev_tag_close'] 			= '</li>';

/* Customizing the "Current Page" Link */
$config['pagination']['cur_tag_open'] 			= '<li class="active"><a>';
$config['pagination']['cur_tag_close'] 			= '</a></li>';

/* Customizing the "Digit" Link */
$config['pagination']['num_tag_open'] 			= '<li>';
$config['pagination']['num_tag_close'] 			= '</li>';

/* Hiding the Pages */
$config['pagination']['display_pages'] 			= 'false';