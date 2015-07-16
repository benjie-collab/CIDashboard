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
| Server.
| -------------------------------------------------------------------------
| Server name and parameter options.
*/

/**
$config['server']['url'] 					= 'http://smrt-feedback';
$config['server']['port'] 					= '9200';**/


/*
| -------------------------------------------------------------------------
| Search Query Parameters.
| -------------------------------------------------------------------------
| Server name and parameter options.
*/
/**
$config['query']['action']					='query';
$config['query']['anylanguage']				='true';
$config['query']['responseformat']			='json';
$config['query']['databasematch']			='';
$config['query']['text']					='*';
$config['query']['fieldtext']				='';
$config['query']['start']					=1;
$config['query']['maxresults']				=10;
//$config['parameters']['absolute_max_results ']=100;
$config['query']['indexes']					='';
$config['query']['print'] 					='all';
$config['query']['printfields'] 			='';
$config['query']['highlight']				='terms';
$config['query']['mindate']					='';
$config['query']['maxdate']					='';
$config['query']['minscore']				=75;
$config['query']['sort']					='relevance';
$config['query']['totalresults']			='true';
$config['query']['starttag']				='<span class="highlight">';
$config['query']['endtag']					='</span>';
$config['query']['summary']					='context';**/









/*
| -------------------------------------------------------------------------
| Search Suggest Parameters.
| -------------------------------------------------------------------------
| Server name and parameter options.

$config['suggest']['action']				='Suggest';
$config['suggest']['absweight']				='';
$config['suggest']['casesensitive']			='false';
$config['suggest']['characters']			='';
$config['suggest']['cluster']				='';
$config['suggest']['clusterthreshold']		='';
$config['suggest']['clustertitlelength']	='';
$config['suggest']['combine']				='';
$config['suggest']['combinenumber']			='';
$config['suggest']['dahendstate']			='';
$config['suggest']['dahstartstate']			='';
$config['suggest']['databasematch']			='';
$config['suggest']['dontmatchid']			='';
$config['suggest']['dontmatchreference']	='';
$config['suggest']['endtag']				='</span>';
$config['suggest']['fieldcheck']			='';
$config['suggest']['fieldrecurse']			='';
$config['suggest']['fieldtext']				='';
$config['suggest']['highlight']				='terms';
$config['suggest']['highlighttagterm']		='';
$config['suggest']['id']					='';
$config['suggest']['irs']					='';
$config['suggest']['languagetype']			='';
$config['suggest']['linkfieldtext']			='';
$config['suggest']['matchencoding']			='';
$config['suggest']['matchid']				='';
$config['suggest']['matchlanguage']			='';
$config['suggest']['matchlanguagetype']		='';
$config['suggest']['matchreference']		='';
$config['suggest']['maxdate']				='';
$config['suggest']['maxid']					='';
$config['suggest']['maxprintchars']			='';
$config['suggest']['maxresults']			=10;
$config['suggest']['maxscore']				=100;
$config['suggest']['mindate']				='';
$config['suggest']['minid']					=0;
$config['suggest']['minlinks']				=0;
$config['suggest']['minscore']				=10;
$config['suggest']['mintermlength']			='';
$config['suggest']['outputencoding']		='';
$config['suggest']['performanceanalysis']	='';
$config['suggest']['predict']				='';
$config['suggest']['print']					='all';
$config['suggest']['printfields']			='';
$config['suggest']['querysummary']			='';
$config['suggest']['reference']				='';
$config['suggest']['referencefield']		='';
$config['suggest']['securityinfo']			='';
$config['suggest']['sentences']				='';
$config['suggest']['singlematch']			='';
$config['suggest']['sort']					='';
$config['suggest']['start']					=1;
$config['suggest']['starttag']				='<span class="highlight">';
$config['suggest']['statedontmatchid']		='';
$config['suggest']['stateid']				='';
$config['suggest']['statematchid']			='';
$config['suggest']['stemming']				='true';
$config['suggest']['storestate']			='';
$config['suggest']['storedstatefield']		='';
$config['suggest']['storedstatetokenlifetime']='';
$config['suggest']['summary']				='concept';
$config['suggest']['synchronous']			='';
$config['suggest']['timeoutms']				='';
$config['suggest']['totalresults']			='true';
$config['suggest']['weighfieldtext']		='';
$config['suggest']['xmlmeta']				='';
$config['suggest']['responseformat']		='json';*/


/*
| -------------------------------------------------------------------------
| Get Document Parameters.
| -------------------------------------------------------------------------
| Server name and parameter options.
*/
$config['document']['action']				='getContent';
//$config['document']['characters']			=0; //The number of characters that a summary can contain.
$config['document']['databasematch']		='';
$config['document']['starttag']				='<span class="highlight">';
$config['document']['endtag']				='</span>';
$config['document']['highlight']			='summaryterms,terms,';
$config['document']['links']				='';
$config['document']['print'] 				='all';
$config['document']['printfields'] 			='';
$config['document']['responseformat']		='json';
$config['document']['summary']				='concept';
$config['document']['id']					='';




/*
| -------------------------------------------------------------------------
| Get Terms Parameters.
| -------------------------------------------------------------------------
| Server name and parameter options.
*/


/*
| -------------------------------------------------------------------------
| Search Suggest Parameters.
| -------------------------------------------------------------------------
| Server name and parameter options.
*/
$config['termexpand']['action']					='TermExpand';
$config['termexpand']['expansion']				='Stem'; //Fuzzy| Synonym | Stem| |Wild
$config['termexpand']['text']					='';
$config['termexpand']['maxterms']				=50;
$config['termexpand']['mindococcs']				=0;
$config['termexpand']['type']					='';
$config['termexpand']['termdetails']			='true';
$config['termexpand']['responseformat']			='json';
$config['termexpand']['stemming']				='true';


$config['termgetall']['action']					='TermGetAll';
$config['termgetall']['maxterms']				=100;
$config['termgetall']['termdetails']			='true';
$config['termgetall']['termanalysis']			='true';
$config['termgetall']['responseformat']			='json';
$config['termgetall']['maxdococcs']				=1000;
$config['termgetall']['mindococcs']				=100;
$config['termgetall']['stemming']				='true';

$config['termgetbest']['action']				='TermGetBest';
$config['termgetbest']['id']					='';
$config['termgetbest']['maxterms']				=50;
$config['termgetbest']['responseformat']		='json';
$config['termgetbest']['mindococcs']			=5;
$config['termgetbest']['stemming']				='true';


$config['termgetinfo']['action']				='termgetinfo';
$config['termgetinfo']['boolean']				='false';
$config['termgetinfo']['matchid']				='';
$config['termgetinfo']['matchreference']		='';
$config['termgetinfo']['maxterms']				=50;
$config['termgetinfo']['mindococcs']			=0;
$config['termgetinfo']['mintermlength']			=3;
$config['termgetinfo']['onlyexisting']			='false';
$config['termgetinfo']['outputencoding']		='';
$config['termgetinfo']['referencefield']		='';
$config['termgetinfo']['statematchid']			='';
$config['termgetinfo']['stemming']				='true';
$config['termgetinfo']['synchronous']			='true';
$config['termgetinfo']['termpositions']			='false';
$config['termgetinfo']['text']					='';
$config['termgetinfo']['textparse']				='false';
$config['termgetinfo']['type']					='apcm';
$config['termgetinfo']['weights']				='true';





/** Tags getquerytagvalues gettagnames gettagvalues **/
$config['getquerytagvalues']['absweight']				='false';
$config['getquerytagvalues']['agentbooleanfield']		='';
$config['getquerytagvalues']['agentparamsfield']		='';
$config['getquerytagvalues']['agentsecurityfield']		='';
$config['getquerytagvalues']['allownonparametricfields']='false';
$config['getquerytagvalues']['anylanguage']				='false';
$config['getquerytagvalues']['autophrase']				='false';
$config['getquerytagvalues']['casesensitive']			='false';
$config['getquerytagvalues']['combine']					='';
$config['getquerytagvalues']['databasematch']			='';
$config['getquerytagvalues']['dateoffset']				='';
$config['getquerytagvalues']['dateperiod']				='';
$config['getquerytagvalues']['detectlanguagetype']		='false';
$config['getquerytagvalues']['documentcount']			='false';
$config['getquerytagvalues']['dontmatchid']				='';
$config['getquerytagvalues']['dontmatchreference']		='';
$config['getquerytagvalues']['fieldcheck']				='';
$config['getquerytagvalues']['fielddependence']			='false';
$config['getquerytagvalues']['fielddependencemultilevel']='false';
$config['getquerytagvalues']['fieldname']				='';
$config['getquerytagvalues']['fieldrestriction']		='';
$config['getquerytagvalues']['fieldtext']				='';
$config['getquerytagvalues']['fieldtextfield']			='';
$config['getquerytagvalues']['hardfieldrestriction']	='false';
$config['getquerytagvalues']['ignorespecials']			='false';
$config['getquerytagvalues']['languagetype']			='';
$config['getquerytagvalues']['linkfieldtext']			='';
$config['getquerytagvalues']['matchallterms']			='false';
$config['getquerytagvalues']['matchencoding']			='';
$config['getquerytagvalues']['matchid']				='';
$config['getquerytagvalues']['matchlanguage']		='';
$config['getquerytagvalues']['matchlanguagetype']	='';
$config['getquerytagvalues']['matchreference']		='';
$config['getquerytagvalues']['maxdate']				='';
$config['getquerytagvalues']['maxid']				='';
$config['getquerytagvalues']['maxlinksperterm']		='';
$config['getquerytagvalues']['maxqueryterms']		='';
$config['getquerytagvalues']['maxresults']			=6;
$config['getquerytagvalues']['maxscore']			=100;
$config['getquerytagvalues']['maxvalues']			='';
$config['getquerytagvalues']['merge']				='false';
$config['getquerytagvalues']['mindate']				='';
$config['getquerytagvalues']['minid']				='';
$config['getquerytagvalues']['minlinks']			=0;
$config['getquerytagvalues']['minscore']			=10;
$config['getquerytagvalues']['mintermlength']		=2;
$config['getquerytagvalues']['outputencoding']		='';
$config['getquerytagvalues']['performanceanalysis']	='false';
$config['getquerytagvalues']['querysort']			='dociddecreasing';
$config['getquerytagvalues']['ranges']				='false';
$config['getquerytagvalues']['referencefield']		='';
$config['getquerytagvalues']['restrictedvalues']	='false';
$config['getquerytagvalues']['securityinfo']		='';
$config['getquerytagvalues']['sort']				='relevance';
$config['getquerytagvalues']['start']				=1;
$config['getquerytagvalues']['statedontmatchid']	='';
$config['getquerytagvalues']['statematchid']		='';
$config['getquerytagvalues']['stemming']			='true';
$config['getquerytagvalues']['synchronous']			='true';
$config['getquerytagvalues']['synonym']				='false';
$config['getquerytagvalues']['text']				='';
$config['getquerytagvalues']['textparse']			='false';
$config['getquerytagvalues']['timeoutms']			='';
$config['getquerytagvalues']['totalvalues']			='true';
$config['getquerytagvalues']['usermetafields']		='';
$config['getquerytagvalues']['valuedetails']		='false';
$config['getquerytagvalues']['vql']					='false';
$config['getquerytagvalues']['weighfieldtext']		='true';

$config['gettagnames']['basefieldcodeonly']		='false';
$config['gettagnames']['fieldcode']				='';
$config['gettagnames']['fieldtype']				='';
$config['gettagnames']['maxvalues']				='';
$config['gettagnames']['outputencoding']		='';
$config['gettagnames']['start']					=1;
$config['gettagnames']['synchronous']			='true';
$config['gettagnames']['typedetails']			='false';


$config['gettagvalues']['casesensitive']		='false';
$config['gettagvalues']['fieldname']			='';
$config['gettagvalues']['languagetype']			='';
$config['gettagvalues']['maxvalues']			='';
$config['gettagvalues']['merge']				='false';
$config['gettagvalues']['restriction']			='';
$config['gettagvalues']['sort']					='relevance';
$config['gettagvalues']['start']				=1;
$config['gettagvalues']['synchronous']			='true';
$config['gettagvalues']['totalvalues']			='true';





/** Document Elements **/
$config['elements']['autn:reference']			= 'autn:reference';
$config['elements']['autn:id']					= 'autn:id';
$config['elements']['autn:section']				= 'autn:section';
$config['elements']['autn:weight']				= 'autn:weight';
$config['elements']['autn:links']				= 'autn:links';
$config['elements']['autn:database']			= 'autn:database';
$config['elements']['autn:summary']				= 'autn:summary';





/** Formats **/
$config['format']['xml']			= 'xml';
$config['format']['json']			= 'json';


/** Actions **/
$config['actions']['documentstats']	= 'DocumentStats';
$config['actions']['getcontent']	= 'Get Content';
$config['actions']['list']			= 'List';
$config['actions']['query']			= 'Query';
$config['actions']['suggest']		= 'Suggest';
$config['actions']['suggestontext']	= 'SuggestOnText';


/** Summary **/
$config['summary']['concept']		= 'Concept';
$config['summary']['context']		= 'Context';
$config['summary']['quick']			= 'Quick';
$config['summary']['paragraphconcept']= 'Paragraph Concept';
$config['summary']['paragraphcontext']= 'Paragraph Context';
$config['summary']['off']			= 'Off';

/** Print **/
$config['print']['all']				= 'All';
$config['print']['allsections']		= 'AllSections';
$config['print']['date']			= 'Date';
$config['print']['fields']			= 'Fields';
$config['print']['index']			= 'Index';
$config['print']['indextext']		= 'IndexText';
$config['print']['negativefields']	= 'NegativeFields';
$config['print']['none']			= 'None';
$config['print']['noresults']		= 'NoResults';
$config['print']['parametric']		= 'Parametric';
$config['print']['reference']		= 'Parametric';
$config['print']['source']			= 'Parametric';

/** highlight **/
$config['highlight']['Off']			= 'Off';
$config['highlight']['sentences']	= 'Sentences';
$config['highlight']['summarysentences']= 'SummarySentences';
$config['highlight']['summaryterms']= 'SummaryTerms';
$config['highlight']['agentboolsentences']= 'AgentBoolSentences';
$config['highlight']['agentboolterms']= 'AgentBoolTerms';
$config['highlight']['terms']		= 'Terms';

/** Sorts **/
$config['sorts']['off']				= 'No Sort';
$config['sorts']['autnrank']		= 'Standard Relevance';
$config['sorts']['cluster']			= 'Cluster';
$config['sorts']['database']		= 'Database';
$config['sorts']['date']			= 'Date';
$config['sorts']['distcartesian']	= 'Distcartesian'; //&sort=Distcartesian{coordX,coordY}:X:Y
$config['sorts']['distspherical']	= 'Distspherical'; //&sort=Distspherical{lat,long}:Latfield:Longfield
$config['sorts']['dociddecreasing']	= 'DocIDDecreasing';
$config['sorts']['docidIncreasing']	= 'DocIDIncreasing';
//$config['sorts']['fieldName:sortMethod']			= 'fieldName:sortMethod';
$config['sorts']['random']			= 'Random';
$config['sorts']['relevance']		= 'Relevance';
$config['sorts']['reversedate']		= 'Reverse Date';
$config['sorts']['reverserelevance']= 'Reverse Relevance';

/** Results Per Page **/
$config['results_per_page']['10']		= '10';
$config['results_per_page']['20']		= '20';
$config['results_per_page']['30']		= '30';
$config['results_per_page']['50']		= '50';






/*
| -------------------------------------------------------------------------
| Search Templates.
| -------------------------------------------------------------------------
| Server name and parameter options.
*/

$config['templates']['default']					= 'Default';
$config['templates']['one-column']				= 'One Column- No Sidebar';
$config['templates']['three-column']			= 'Three Column';
$config['templates']['two-column-ls']			= 'Two Column- Left Sidebar';
$config['templates']['two-column-rs']			= 'Two Column- Right Sidebar';


/*
| -------------------------------------------------------------------------
| Settings.
| -------------------------------------------------------------------------
| 
*/
$config['settings']['search']			= 'Search';
$config['settings']['pagination']		= 'Pagination';
$config['settings']['facets']			= 'Facets';
$config['settings']['sentiments']		= 'Sentiments';
$config['settings']['statistics']		= 'Statistics';


/*
| -------------------------------------------------------------------------
| Default Values.
| -------------------------------------------------------------------------
| Server name and parameter options.
*/
$config['sources']['News-SMRT']		= 'News';
$config['sources']['facebook']		= 'Facebook';
$config['sources']['twitter']		= 'Twitter';

$config['indexes']['title']			= 'Title';
$config['indexes']['summary']		= 'Summary';
$config['indexes']['content-type']	= 'Content Type';

$config['printfields']['title']		= 'Title';
$config['printfields']['summary']		= 'Summary';
$config['printfields']['content-type']	= 'Content Type';




/*
| -------------------------------------------------------------------------
| Facets.
| -------------------------------------------------------------------------
| Server name and parameter options.
*/
$config['facets']['Facebook']		= array(
										'name' => 'Facebook',
										'uri' => '?action=CategoryQuery&category=958496989228617061',
										'children' => array(
											array(
												'name' => 'Buses',
												'uri' => '?action=CategoryQuery&category=483594613111833678',
												'children' => array(
													array(
														'name' => 'Positive Sentiments',
														'uri' => '?action=CategoryQuery&category=908755843103121730'
													),
													array(
														'name' => 'Negative Sentiments',
														'uri' => '?action=CategoryQuery&category=858502278215604355'
													),
													array(
														'name' => 'Neutral Sentiments',
														'uri' => '?action=CategoryQuery&category=536387481867721213'
													)										
												)
											),
											array(
												'name' => 'Train',
												'uri' => '?action=CategoryQuery&category=898854799740591301',
												'children' => array(
													array(
														'name' => 'Positive Sentiments',
														'uri' => '?action=CategoryQuery&category=908755843103121730'
													),
													array(
														'name' => 'Negative Sentiments',
														'uri' => '?action=CategoryQuery&category=858502278215604355'
													),
													array(
														'name' => 'Neutral Sentiments',
														'uri' => '?action=CategoryQuery&category=536387481867721213'
													)										
												)
											),
											array(
												'name' => 'Taxi',
												'uri' => '?action=CategoryQuery&category=353412859594994532',
												'children' => array(
													array(
														'name' => 'Positive Sentiments',
														'uri' => '?action=CategoryQuery&category=908755843103121730'
													),
													array(
														'name' => 'Negative Sentiments',
														'uri' => '?action=CategoryQuery&category=858502278215604355'
													),
													array(
														'name' => 'Neutral Sentiments',
														'uri' => '?action=CategoryQuery&category=536387481867721213'
													)										
												)
											)										
										)			
									);
$config['facets']['Twitter']		= array(
										'name' => 'Twitter',
										'uri' => '?action=CategoryQuery&category=180293764215302976',
										'children' => array(
											array(
												'name' => 'Buses',
												'uri' => '?action=CategoryQuery&category=293200727802722699',
												'children' => array(
													array(
														'name' => 'Positive Sentiments',
														'uri' => '?action=CategoryQuery&category=908755843103121730'
													),
													array(
														'name' => 'Negative Sentiments',
														'uri' => '?action=CategoryQuery&category=858502278215604355'
													),
													array(
														'name' => 'Neutral Sentiments',
														'uri' => '?action=CategoryQuery&category=536387481867721213'
													)										
												)
											),
											array(
												'name' => 'Train',
												'uri' => '?action=CategoryQuery&category=514747502104172908',
												'children' => array(
													array(
														'name' => 'Positive Sentiments',
														'uri' => '?action=CategoryQuery&category=908755843103121730'
													),
													array(
														'name' => 'Negative Sentiments',
														'uri' => '?action=CategoryQuery&category=858502278215604355'
													),
													array(
														'name' => 'Neutral Sentiments',
														'uri' => '?action=CategoryQuery&category=536387481867721213'
													)										
												)
											),
											array(
												'name' => 'Taxi',
												'uri' => '?action=CategoryQuery&category=238557198754746621',
												'children' => array(
													array(
														'name' => 'Positive Sentiments',
														'uri' => '?action=CategoryQuery&category=908755843103121730'
													),
													array(
														'name' => 'Negative Sentiments',
														'uri' => '?action=CategoryQuery&category=858502278215604355'
													),
													array(
														'name' => 'Neutral Sentiments',
														'uri' => '?action=CategoryQuery&category=536387481867721213'
													)										
												)
											)										
										)			
									);
$config['facets']['News-Smrt']		= array(
										'name' => 'News-SMRT',
										'uri' => '?action=CategoryQuery&category=209064410480568162',
										'children' => array(
											array(
												'name' => 'Buses',
												'uri' => '?action=CategoryQuery&category=908755843103121730',
												'children' => array(
													array(
														'name' => 'Positive Sentiments',
														'uri' => '?action=CategoryQuery&category=908755843103121730'
													),
													array(
														'name' => 'Negative Sentiments',
														'uri' => '?action=CategoryQuery&category=858502278215604355'
													),
													array(
														'name' => 'Neutral Sentiments',
														'uri' => '?action=CategoryQuery&category=536387481867721213'
													)										
												)
											),
											array(
												'name' => 'Train',
												'uri' => '?action=CategoryQuery&category=858502278215604355',
												'children' => array(
													array(
														'name' => 'Positive Sentiments',
														'uri' => '?action=CategoryQuery&category=908755843103121730'
													),
													array(
														'name' => 'Negative Sentiments',
														'uri' => '?action=CategoryQuery&category=858502278215604355'
													),
													array(
														'name' => 'Neutral Sentiments',
														'uri' => '?action=CategoryQuery&category=536387481867721213'
													)										
												)	
											),
											array(
												'name' => 'Taxi',
												'uri' => '?action=CategoryQuery&category=536387481867721213',
												'children' => array(
													array(
														'name' => 'Positive Sentiments',
														'uri' => '?action=CategoryQuery&category=908755843103121730'
													),
													array(
														'name' => 'Negative Sentiments',
														'uri' => '?action=CategoryQuery&category=858502278215604355'
													),
													array(
														'name' => 'Neutral Sentiments',
														'uri' => '?action=CategoryQuery&category=536387481867721213'
													)										
												)
											)										
										)			
									);;





/*
| -------------------------------------------------------------------------
| Settings: Available Widgets
| -------------------------------------------------------------------------
| Server name and parameter options.

$config['widgets']['search_form']		= array(
											'title' => 'Search Form',
											'icon' => 'fa fa-search',
											'function' => '',
											'filename' => '',
											'options' => array(
												'title' => 'Search',
												'placeholder' => 'Search Term',
												'suggestbox' => true,
												'filter' => array( 'sources' => true, 'minscore'=> true)
											),
										);
$config['widgets']['search_results']	= array(
											'title' => 'Search Results',
											'icon' => 'fa fa-list-ol',
											'function' => '',
											'filename' => '',
											'options' => array(
												'title' => 'Search Results',
												'tools' => array( 
													'totalresults'=> true,  
													'sort'=> true,  
													'maxresults'=> true,
													'thumbnail'=> true
													)
											),
										);
$config['widgets']['pagination']		= array(
											'title' => 'Pagination',
											'icon' => 'fa fa-sort-numeric-asc',
											'function' => '',
											'filename' => '',
											'options' => array(
												'bgcolor' => ''
											),
										);
										
$config['widgets']['tag_cloud']			= array(
											'title' => 'Tag Cloud',
											'icon' => 'fa fa-cloud',
											'function' => '',
											'filename' => '',
											'options' => array(
												'title' => 'Tag Cloud',												
												'totalresults'=> true,  
												'sort'=> true,  
												'maxresults'=> true,
												'thumbnail'=> true
											),
										);
$config['widgets']['facets']			= array(
											'title' => 'Facets',
											'icon' => 'fa fa-list-alt ',
											'function' => '',
											'filename' => '',
											'options' => array('beer', 'wine', 'snacks'),
										);
$config['widgets']['sentiments']		= array(
											'title' => 'Sentiments',
											'icon' => 'fa fa-tasks',
											'function' => '',
											'filename' => '',
											'options' => array('beer', 'wine', 'snacks'),
										);
$config['widgets']['statistics']		= array(
											'title' => 'Statistics',
											'icon' => 'fa fa-area-chart',
											'function' => '',
											'filename' => '',
											'options' => array('beer', 'wine', 'snacks'),
										);
*/





							

$config['widget_option']['search_form']		= array(
												'title' => 'Search',
												'placeholder' => 'Search Term',
												'suggestbox' => true,
												'filter' => array( 'sources' => true, 'minscore'=> true)
											);
$config['widget_option']['search_results']	= array(
												'title' => 'Search Results',
												'tools' => array( 
													'totalresults'=> true,  
													'sort'=> true,  
													'maxresults'=> true,
													'thumbnail'=> true
													)
											);
											
$config['widget_option']['pagination']		= array(
													'bgcolor' => ''
											);
										
$config['widget_option']['tag_cloud']		= array(
												'title' => 'Tag Cloud'
											);
$config['widget_option']['facets']			=  array(
												'title' => 'Facets'
											);
$config['widget_option']['sentiments']		=  array(
												'title' => 'Sentiments'
											);
$config['widget_option']['statistics']		=  array(
												'title' => 'statistics'
											);
										
										
										
	
										
										
										
/*
| -------------------------------------------------------------------------
| Settings: Usermeta
| -------------------------------------------------------------------------
| Server name and parameter options.
*/
$config['default_widgets']['content']			= array(
													0 => 'search_results'
												);
$config['default_widgets']['content_bottom_bar']= array(
													0 => 'pagination'
												);
$config['default_widgets']['content_top_bar']	= array(
													0 => 'pagination'
												);
$config['default_widgets']['left_sidebar_1']	= array(
													0 => 'facets'
												);
$config['default_widgets']['left_sidebar_2']	= array(
													0 => 'tag_cloud'
												);
$config['default_widgets']['right_sidebar_1']	= array(
													0 => 'sentiments'
												);
$config['default_widgets']['right_sidebar_2']	= array(
													0 => 'statistics'
												);
$config['default_widgets']['top_bar']			= array(
													0 => 'search_form'
												);





/*
 | -------------------------------------------------------------------------
 | Message Delimiters.
 | -------------------------------------------------------------------------
 */
//$config['delimiters_source']       = 'config'; 	// "config" = use the settings defined here, "form_validation" = use the settings defined in CI's form validation library
$config['error_start_delimiter'] = '<div class="alert alert-dismissable alert-danger"><i class="fa fa-exclamation-circle"></i> '; 
$config['error_end_delimiter']   = '</div>'; 
$config['info_start_delimiter']   = '<div class="alert alert-dismissable alert-info"><i class="fa fa-info-circle"></i> ';		
$config['info_end_delimiter']     = '</div>'; 
$config['warning_start_delimiter'] = '<div class="alert alert-dismissable alert-warning"><i class="fa fa-warning"></i> '; 
$config['warning_end_delimiter']   = '</div>'; 
$config['success_start_delimiter']   = '<div class="alert alert-dismissable alert-success"><i class="fa fa-check-circle"></i> ';		
$config['success_end_delimiter']     = '</div>'; 