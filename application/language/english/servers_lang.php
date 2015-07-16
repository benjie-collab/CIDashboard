<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// servers
$lang['servers_heading']           	= 'Servers';
$lang['servers_subheading']        	= 'Below is a list of the servers.';
$lang['servers_url_th']          	= 'Url';
$lang['servers_port_th']          	= 'Port';
$lang['servers_username_th']        = 'Username';
$lang['servers_password_th']        = 'Password';
$lang['servers_actions_th']         = 'Actions';





$lang['create_server_heading']           	= 'Add Server';
$lang['create_server_subheading']        	= 'Fill the form below to add new server.';

$lang['view_server_heading']           		= 'Server Information';
$lang['view_server_subheading']        		= 'Below are the information of your server.';



$lang['create_server_url_label']         	= 'Url';
$lang['create_server_port_label']         	= 'Port';
$lang['create_server_username_label']       = 'Username';
$lang['create_server_password_label']       = 'Password';


$lang['servers_error_add']         	  		= 'Error encountered while adding the server';
$lang['servers_error_delete']         		= 'Error encountered while removing the server';
$lang['servers_error_update']         		= 'Error encountered while updating the server';

$lang['servers_success_add']          		= 'Success! Server has been added.';
$lang['servers_success_delete']       		= 'Success! Server has been deleted.';
$lang['servers_success_update']       		= 'Success! Server has been updated.';


$lang['create_server_validation_url_label']         = 'Url';
$lang['servers_create_server_link']         		= 'Add New Server';




$lang['statuscode_1']= '<i class="fa fa-check"></i>'; //'Finished' The indexing process is complete.
$lang['statuscode_2']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'Out of disk space'  	IDOL Server ran out of disk space before it completed the indexing process.
$lang['statuscode_3']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'File not found'  	The index file was not found.
$lang['statuscode_4']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'Database not found'  	The database into which you are trying to index was not found.
$lang['statuscode_5']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'Bad parameter'  	The indexing action syntax is incorrect.
$lang['statuscode_6']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'Database exists'  	The database you are trying to create already exists.
$lang['statuscode_7']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'Queued'  	The indexing action is queued and it is run when all preceding indexing actions are complete.
$lang['statuscode_8']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'Unavailable'  	

//IDOL Server is about to shut down or indexing is paused.
//Note: For the DREUNDELETEDOC index action, a status of -8 might mean that the operation is unavailable because NodeTableSecureDelete is turned on.
$lang['statuscode_9']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'Out of Memory'  	IDOL Server ran out of memory before the indexing process was completed.
$lang['statuscode_10']= '<i class="fa fa-stop"></i>'; //'Interrupted'  	The indexing action was interrupted.
$lang['statuscode_11']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'XML is not well formed'  	Indexing failed because the XML is not well formed.
$lang['statuscode_12']= '<i class="fa fa-refresh"></i>'; //'Retrying interrupted command'  	IDOL Server is running an index action that was previously interrupted.
$lang['statuscode_13']= '<i class="fa fa-spinner"></i>'; //'Backup in progress'  	IDOL Server is performing a backup.
$lang['statuscode_14']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'Max index size reached'  	The indexing job exceeds the maximum indexing size (your license determines the maximum indexing size).
$lang['statuscode_15']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'Max number of sections reached'  	The indexing job exceeds the maximum number of sections that you can index. (Your license determines the number of sections you can index).
$lang['statuscode_16']= '<i class="fa fa-pause"></i>'; //'Indexing Paused'  	The indexing process was paused.
$lang['statuscode_17']= '<i class="fa fa-play"></i>'; //'Indexing Resumed'  	The indexing process was restarted.
$lang['statuscode_18']= '<i class="fa fa-times"></i>'; //'Indexing Cancelled'  	The indexing process was cancelled.
$lang['statuscode_19']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'Out of file descriptors'  	IDOL Server ran out of file descriptors.
$lang['statuscode_20']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'LanguageType not found'  	The language type of the index data was not found.
$lang['statuscode_21']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'SecurityType not found'  	The security type of the index data was not found.
$lang['statuscode_22']= '<i class="fa fa-info"></i>'; //'Child engines returned differing messages'  	The child servers returned different messages to the DIH. This code is reported by DIH only.
$lang['statuscode_23']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'Badly formatted index command'  	The indexing action was rejected by a child server because the syntax is invalid.
$lang['statuscode_25']= '<i class="fa fa-spinner"></i>'; //'To be sent to DRE'  	The index action is queued to be sent to the IDOL Server. This code is reported by DIH only.
$lang['statuscode_26']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'DREADDDATA: Data received did not include #DREENDDATA'  	The data in the DREADDDATA action did not contain a #DREEDNDDATA statement indicating the end of the data.
$lang['statuscode_27']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'Command failed more times than the configured retry limit'  	The indexing action exceeded the maximum number of retries specified by the MaximumRetries parameter in the DIH configuration. This code is reported by DIH only.
$lang['statuscode_28']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'The index ID specified is invalid.'  	The index ID returned by the child server is invalid. This code is reported by DIH only.
$lang['statuscode_29']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'Command was redistributed to sibling engines as this engine was either unavailable or not to accept index jobs.'  	The indexing action was sent to sibling servers because the child server was either unavailable or not accepting indexing jobs. This code is reported by DIH only.
$lang['statuscode_30']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'Database name too long'  	The name of the database in which you are indexing documents is too long. The length is defined internally as 63 characters.
$lang['statuscode_31']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'Command ignored due to id match'  	The DREINITIAL action was ignored because it did not match the ID specified in the InitialID parameter.
$lang['statuscode_33']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'' The database cannot be created because the maximum number of databases was exceeded. The maximum is defined internally as 32,767.
$lang['statuscode_34']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'Pending commit'  	The indexing job is complete and the documents become available for searching after the next delayed sync cycle, which is specified in the DelayedSync parameter.
$lang['statuscode_35']= '<i class="fa fa-circle-thin"></i>'; //'Initializing'  	The indexing job is being started. This code is reported by DIH only.
$lang['statuscode_36']= '<i class="fa fa-search"></i>'; //'Reading IDX'  	The IDX file is being read from disk, prior to being sent to the DRE. This code is reported by DIH only.
$lang['statuscode_37']= '<i class="fa animated bounceIn infinite fa-exclamation"></i>'; //'Failed'  	The index action has permanently failed.
$lang['statuscode_38']= '<i class="fa fa-spinner"></i>'; //'Processing in remote engine.'  	The target server of a DREEXPORTREMOTE operation is processing the exported documents. 






