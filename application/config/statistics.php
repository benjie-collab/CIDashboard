<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$config['options']['verticalAlignment']['top']			= 'Top';
$config['options']['verticalAlignment']['bottom']		= 'Bottom';

$config['options']['horizontalAlignment']['right']		= 'Right';
$config['options']['horizontalAlignment']['left']		= 'Left';
$config['options']['horizontalAlignment']['center']		= 'Center';

$config['options']['itemTextPosition']['right']			= 'Right';
$config['options']['itemTextPosition']['left']			= 'Left';
$config['options']['itemTextPosition']['top']			= 'Top';
$config['options']['itemTextPosition']['bottom']		= 'Bottom';

$config['options']['palette']['default']				= 'Default';
$config['options']['palette']['softpastel']				= 'Soft Pastel';
$config['options']['palette']['harmonylight']			= 'Harmony Light';
$config['options']['palette']['pastel']					= 'Pastel';
$config['options']['palette']['bright']					= 'Bright';
$config['options']['palette']['soft']					= 'Soft';
$config['options']['palette']['ocean']					= 'Ocean';
$config['options']['palette']['vintage']				= 'Vintage';
$config['options']['palette']['violet']					= 'Violet';

$config['options']['types']['basic']['line']			= 'line';
$config['options']['types']['basic']['area']			= 'area';
$config['options']['types']['basic']['bar']				= 'bar';
$config['options']['types']['basic']['spline']			= 'spline';
$config['options']['types']['basic']['splinearea']		= 'splinearea';

$config['options']['types']['pie']['pie']				= 'pie';
$config['options']['types']['pie']['doughnut']			= 'doughnut';

$config['options']['labelformat']['currency']			= 'currency';
$config['options']['labelformat']['fixedPoint']			= 'fixedPoint';
$config['options']['labelformat']['percent']			= 'percent';
$config['options']['labelformat']['decimal']			= 'decimal';
$config['options']['labelformat']['exponential']		= 'exponential';
$config['options']['labelformat']['largeNumber']		= 'largeNumber';
$config['options']['labelformat']['thousands']			= 'thousands';
$config['options']['labelformat']['millions']			= 'millions';
$config['options']['labelformat']['billions']			= 'billions';
$config['options']['labelformat']['trillions']			= 'trillions';
$config['options']['labelformat']['longDate']			= 'longDate';
$config['options']['labelformat']['longTime']			= 'longTime';
$config['options']['labelformat']['monthAndDay']		= 'monthAndDay';
$config['options']['labelformat']['monthAndYear']		= 'monthAndYear';
$config['options']['labelformat']['quarterAndYear']		= 'quarterAndYear';
$config['options']['labelformat']['shortDate']			= 'shortDate';
$config['options']['labelformat']['shortTime']			= 'shortTime';
$config['options']['labelformat']['millisecond']		= 'millisecond';
$config['options']['labelformat']['day']				= 'day';
$config['options']['labelformat']['month']				= 'month';
$config['options']['labelformat']['quarter']			= 'quarter';
$config['options']['labelformat']['year']				= 'year';



$config['options']['type']['line']						= 'line';
$config['options']['type']['stackedline']				= 'stackedline';
$config['options']['type']['fullstackedline']			= 'fullstackedline';
$config['options']['type']['area']						= 'area';
$config['options']['type']['stackedarea']				= 'stackedarea';
$config['options']['type']['fullstackedarea']			= 'fullstackedarea';
$config['options']['type']['bar']						= 'bar';
$config['options']['type']['stackedbar']				= 'stackedbar';
$config['options']['type']['fullstackedbar']			= 'fullstackedbar';
$config['options']['type']['spline']					= 'spline';
$config['options']['type']['splinearea']				= 'splinearea';
$config['options']['type']['scatter']					= 'scatter';
$config['options']['type']['candlestick']				= 'candlestick';
$config['options']['type']['stock']						= 'stock';
$config['options']['type']['rangearea']					= 'rangearea';
$config['options']['type']['rangebar']					= 'rangebar';
$config['options']['type']['stepline']					= 'stepline';
$config['options']['type']['steparea']					= 'steparea';
$config['options']['type']['bubble']					= 'bubble';
$config['options']['type']['fullstackedspline']			= 'fullstackedspline';
$config['options']['type']['stackedspline']				= 'stackedspline';
$config['options']['type']['stackedsplinearea']			= 'stackedsplinearea';
$config['options']['type']['fullstackedsplinearea']		= 'fullstackedsplinearea';


$config['options']['argumentType']['numeric']		= 'Numeric';
$config['options']['argumentType']['datetime']		= 'DateTime';
$config['options']['argumentType']['string']		= 'String';

$config['options']['position']['top']		= 'Top';
$config['options']['position']['bottom']	= 'Bottom';
$config['options']['position']['left']		= 'Left';
$config['options']['position']['right']		= 'Right';




/*
| -------------------------------------------------------------------------
| Default Values.
| -------------------------------------------------------------------------
| Server name and parameter options.
*/
$config['categories']['Bar']				= array(
												'name' => 'Bar',
												'icon' => 'ion ion-stats-bars'
												);
$config['categories']['Bargauge']			= array(
												'name' => 'Bar Gauge',
												'icon' => 'ion ion-android-wifi'
												);
$config['categories']['Scatter']			= array(
												'name' => 'Scatter',
												'icon' => 'ion ion-ios-keypad-outline'
												);
$config['categories']['Circulargauge']		= array(
												'name' => 'Circular Gauge',
												'icon' => 'ion ion-android-wifi'
												);
$config['categories']['Geospatial']			= array(
												'name' => 'Geospatial',
												'icon' => 'ion ion-navigate'
												);
$config['categories']['Line']				= array(
												'name' => 'Line',
												'icon' => 'fa fa-line-chart'
												);
$config['categories']['Lineargauge']		= array(
												'name' => 'Linear Gauge',
												'icon' => 'fa fa-area-chart'
												);
$config['categories']['Map']				= array(
												'name' => 'Vector Map',
												'icon' => 'ion ion-compass'
												);
$config['categories']['Pie']				= array(
												'name' => 'Pie',
												'icon' => 'ion ion-ios-pie-outline'
												);
$config['categories']['Sparkline']			= array(
												'name' => 'Sparkline',
												'icon' => 'fa fa-area-chart'
												);
$config['categories']['Timeline']			= array(
												'name' => 'Timeline',
												'icon' => 'fa fa-area-chart'
												);
$config['categories']['Zooming']			= array(
												'name' => 'Zooming',
												'icon' => 'fa fa-area-chart'
												);



												
												
												
$config['dxbasic']		= 	array(
								'active' => false,
								'widget_key' => '',							
								'data' => array(
									'fieldname' =>'',
									'dateperiod' =>'',
									'maxresults' =>1000000,
									'text' => '*',
									'documentcount' => true,
									'source' => 'autn:value',
									'valuedetails' => true
								),
								'visual' => array(
									'title'		=> "Bar Widget Sample",
									'tooltip'	=> array(
										'enabled' => true
									),
									'legend'			=> array(
										'verticalAlignment'		=> "top",
										'horizontalAlignment'	=> "center",
										'itemTextPosition'		=> 'right',
										'columnCount' => 10
									),
									'dataSource'=> array(
										array( 'state'=> "Illinois", 	'year1998'=> 423.721, 'year2001' => 476.851, 'year2004' => 528.904 ),
										array( 'state'=> "Indiana", 	'year1998'=> 178.719, 'year2001' => 195.769, 'year2004' => 227.271 ),
										array( 'state'=> "Michigan", 	'year1998'=> 308.845, 'year2001' => 335.793, 'year2004' => 372.576 ),
										array( 'state'=> "Ohio", 		'year1998'=> 348.555, 'year2001' => 374.771, 'year2004' => 418.258 ),
										array( 'state'=> "Wisconsin", 	'year1998'=> 160.274, 'year2001' => 182.373, 'year2004' => 211.727 )
									),
									'commonSeriesSettings' => array( 
										'argumentField'		=> 'state',
										'type'		=> 'bar'
									),
									'series'	=> array(
										array( 'valueField'=> "year2004", 'name' => "2004" ),
										array( 'valueField'=> "year2001", 'name' => "2001" ),
										array( 'valueField'=> "year1998", 'name' => "1998" )
									)
								)
						
							);

$config['dxpie']		= 	array(
								'active' => false,
								'widget_key' => '',							
								'data' => array(
									'fieldname' =>'',
									'dateperiod' =>'',
									'maxresults' =>1000000,
									'text' => '*',
									'documentcount' => true,
									'source' => 'autn:value',
									'valuedetails' => true
								),
								'visual' => array(
										'title'		=> "Pie Widget Sample",
										'tooltip'	=> array(
											'enabled' => true
										),
										'legend'			=> array(
											'verticalAlignment'		=> "top",
											'horizontalAlignment'	=> "right",
											'itemTextPosition'		=> 'right',
											'columnCount' => 10
										),
										'dataSource'=> array(
											array( 'country'=> "Russia", 	'area'=> 12),
											array( 'country'=> "Canada", 	'area'=> 7),
											array( 'country'=> "USA", 		'area'=> 7),
											array( 'country'=> "China", 	'area'=> 6),
											array( 'country'=> "Brazil", 	'area'=> 3)
										),
										'commonSeriesSettings' => array( 
											'argumentField'		=> 'state',
											'type'		=> 'bar'
										),
										'series'	=> array( 
												'argumentField'=> "country", 
												'valueField' => "area",
												'label' => array(
																'visible' => true,
																'connector' => array(
																		'visible' => true,           
																		'width' => 1
																	)
														)	
										)
								)
							);						
												
												
												
												
												
$config['dxtimeline']		= 	array(
									'active' => false,
									'widget_key' => '',							
									'data' => array(
										'fieldname' =>'',
										'dateperiod' =>'',
										'maxresults' =>1000000,
										'text' => '*',
										'documentcount' => true,
										'source' => 'autn:value',
										'valuedetails' => true
									),
									'visual' => array(
										'title'		=> "Time Line Sample",
										'tooltip'	=> array(
											'enabled' => true
										),
										'legend'			=> array(
											'verticalAlignment'		=> "top",
											'horizontalAlignment'	=> "center",
											'itemTextPosition'		=> 'right',
											'columnCount' => 10
										),
										'dataSource'=> array(
											array( 'date'=> "1422633600", 	'year1998'=> 423.721, 'year2001' => 476.851, 'year2004' => 528.904 ),
											/**array( 'date'=> "16:00:00 01/02/2015", 	'year1998'=> 178.719, 'year2001' => 195.769, 'year2004' => 227.271 ),
											array( 'date'=> "16:00:00 01/03/2015", 	'year1998'=> 308.845, 'year2001' => 335.793, 'year2004' => 372.576 ),
											array( 'date'=> "16:00:00 01/04/2015", 	'year1998'=> 348.555, 'year2001' => 374.771, 'year2004' => 418.258 ),
											array( 'date'=> "16:00:00 01/05/2015", 	'year1998'=> 160.274, 'year2001' => 182.373, 'year2004' => 211.727 ),
											array( 'date'=> "16:00:00 01/07/2015", 	'year1998'=> 546.274, 'year2001' => 878.373, 'year2004' => 715.727 ),
											array( 'date'=> "16:00:00 01/08/2015", 	'year1998'=> 763.274, 'year2001' => 347.373, 'year2004' => 512.727 ),
											array( 'date'=> "16:00:00 01/09/2015", 	'year1998'=> 382.274, 'year2001' => 426.373, 'year2004' => 345.727 ),
											array( 'date'=> "16:00:00 01/10/2015", 	'year1998'=> 429.274, 'year2001' => 163.373, 'year2004' => 890.727 ),
											array( 'date'=> "16:00:00 01/11/2015", 	'year1998'=> 562.274, 'year2001' => 894.373, 'year2004' => 123.727 ),
											array( 'date'=> "16:00:00 01/12/2015", 	'year1998'=> 848.274, 'year2001' => 452.373, 'year2004' => 456.727 ),**/
										),
										'commonSeriesSettings' => array( 
											'argumentField'		=> 'date',											
											'type'		=> 'bar'
										),
										'argumentAxis' => array( 
											'axisDivisionFactor'=> 100,
											'argumentType'	=> 'datetime',
											'label'			=> array( 
																'format'	=> 'shortdate'
															)
										),
										'series'	=> array(
											array( 'valueField'=> "year2004", 'name' => "2004" ),
											array( 'valueField'=> "year2001", 'name' => "2001" ),
											array( 'valueField'=> "year1998", 'name' => "1998" )
										)
									)
						
								);											
												
												
												
												
												
												
$config['map_icons']['MAP_PIN']		=	'<path d="M50,0C22.382,0,0,21.966,0,49.054C0,76.151,50,165,50,165s50-88.849,50-115.946C100,21.966,77.605,0,50,0z" fill="#000000"/>';
$config['map_icons']['SQUARE_PIN']	=	'<polygon points="100,0 0,0 0,100 36.768,100 50.199,119.876 63.63,100 100,100 " fill="#000000"/>';
$config['map_icons']['SHIELD']		=	'<path d="M92.799,37.081c0.663-7.855,3.029-15.066,7.2-21.675L84.001,0c-5.054,4.189-10.81,6.509-17.332,6.919
										c-5.976,0.52-11.641-0.574-16.971-3.287C44.22,6.258,38.577,7.355,32.696,6.919C26.61,6.396,21.119,4.317,16.201,0.638L0.16,16.036
										c3.945,6.704,6.143,13.72,6.574,21.045c0.205,3.373-0.795,8.016-3.038,14.018c-1.175,3.327-2.061,6.213-2.667,8.628
										c-0.562,2.393-0.911,4.34-1.027,5.8c-0.082,6.396,1.78,12.169,5.602,17.302c2.986,3.745,7.911,7.886,14.748,12.41
										c7.482,3.665,13.272,6.045,17.326,7.06c1.163,0.522,2.301,1.025,3.363,1.505c1.058,0.488,2.192,0.964,3.372,1.483
										c2.552,1.471,4.343,3.067,5.285,4.713c1.159-1.782,2.991-3.338,5.423-4.713c1.717-0.722,3.173-1.346,4.341-1.897
										c1.167-0.493,2.037-0.865,2.54-1.089c0.866-0.414,2.002-0.888,3.376-1.411c1.386-0.526,3.1-1.167,5.143-1.881
										c3.952-1.348,6.831-2.62,8.656-3.77c6.633-4.524,11.48-8.594,14.566-12.235c3.958-5.152,5.879-10.953,5.79-17.475
										c-0.232-2.922-1.519-7.593-3.85-13.959C93.462,45.369,92.478,40.555,92.799,37.081z" fill="#000000"/>';
$config['map_icons']['ROUTE']		=	'<path d="M99.986,41.081C99.477,13.45,83.448,2.469,82.791,2.032L80.312,0.34l-2.5,1.689c-4.147,2.817-8.449,4.247-12.782,4.247
										c-7.178,0-12.051-3.864-12.257-4.032L49.977,0l-2.776,2.248c-0.203,0.165-5.074,4.028-12.253,4.028
										c-4.331,0-8.63-1.429-12.788-4.253l-2.486-1.678L17.17,2.037C15.468,3.207,0.546,14.229,0.005,40.944
										C-0.211,43.269,6.208,87.246,49.997,100C97.61,86.088,100.23,43.982,99.986,41.081z" fill="#000000"/>';
$config['map_icons']['ROUNDED']		=	'<path d="M100,20c0-11-9-20-20-20H20C9,0,0,9,0,20v60c0,11,9,20,20,20h60c11,0,20-9,20-20V20z" fill="#000000"/>';


$config['map_themes']['midnightcommander'] = 'Midnight Commander';
$config['map_themes']['neutralblue'] = 'Neutral Blue';
$config['map_themes']['shadesofgrey'] = 'Shades of Grey';
$config['map_themes']['lunarlandscape'] = 'Lunar Landscape';
$config['map_themes']['snazzymaps'] = 'Snazzy Maps';	
												
												
												
												
												
/**
$config['config']['Dxbasic']					= 	array(
													'settings'		=> array(
														'xAxis'		=> array(),
														'yAxis'		=> array(),
														'count'		=> array(),
													),
													'title'		=> "Bar Widget Sample",
													'short_name'=> "bar",
													'tooltip'	=> array(
														'enabled' => true
													),
													'legend'			=> array(
														'verticalAlignment'		=> "top",
														'horizontalAlignment'	=> "center",
														'itemTextPosition'		=> 'right',
														'columnCount' => 10
													),
													'dataSource'=> array(
														array( 'state'=> "Illinois", 	'year1998'=> 423.721, 'year2001' => 476.851, 'year2004' => 528.904 ),
														array( 'state'=> "Indiana", 	'year1998'=> 178.719, 'year2001' => 195.769, 'year2004' => 227.271 ),
														array( 'state'=> "Michigan", 	'year1998'=> 308.845, 'year2001' => 335.793, 'year2004' => 372.576 ),
														array( 'state'=> "Ohio", 		'year1998'=> 348.555, 'year2001' => 374.771, 'year2004' => 418.258 ),
														array( 'state'=> "Wisconsin", 	'year1998'=> 160.274, 'year2001' => 182.373, 'year2004' => 211.727 )
													),
													'commonSeriesSettings' => array( 
														'argumentField'		=> 'state',
														'type'		=> 'bar'
													),
													'series'	=> array(
														array( 'valueField'=> "year2004", 'name' => "2004" ),
														array( 'valueField'=> "year2001", 'name' => "2001" ),
														array( 'valueField'=> "year1998", 'name' => "1998" )
													)
													
												);
$config['config']['Bargauge']				= array(
												'settings'		=> array(
														'xAxis'		=> array(),
														'yAxis'		=> array(),
														'count'		=> array(),
													),
												'title'				=> "Bar Gauge Widget Sample",
												'short_name'=> "bargauge",
												'tooltip'	=> array(
														'enabled' => true
													),
												'legend'			=> array(
													'verticalAlignment'		=> "bottom",
													'horizontalAlignment'	=> "center",
													'itemTextPosition'		=> 'top'
												),
												'startValue'		=> 0,
												'endValue'			=> 100,
												'values'			=> array(47.27, 65.32, 84.59, 71.86)																						
											);
$config['config']['Scatter']				= 'Scatter';
$config['config']['Circulargauge']			= 'Circular Gauge';
$config['config']['Geospatial']				= 'Geospatial';
$config['config']['Line']					= 'Line';
$config['config']['Lineargauge']			= 'Linear Gauge';
$config['config']['Map']					= 'Map';
$config['config']['Pie']					= 'Pie';
$config['config']['Sparkline']				= 'Sparkline';
$config['config']['Timeline']				= 'Timeline';
$config['config']['Zooming']				= 'Zooming';
**/








