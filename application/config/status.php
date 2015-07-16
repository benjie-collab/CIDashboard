<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
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

$config['statuscode']["1"]= 'Finished' ; //The indexing process is complete.
$config['statuscode']["2"]= 'Out of disk space' ; // 	IDOL Server ran out of disk space before it completed the indexing process.
$config['statuscode']["3"]= 'File not found' ; // 	The index file was not found.
$config['statuscode']["4"]= 'Database not found' ; // 	The database into which you are trying to index was not found.
$config['statuscode']["5"]= 'Bad parameter' ; // 	The indexing action syntax is incorrect.
$config['statuscode']["6"]= 'Database exists' ; // 	The database you are trying to create already exists.
$config['statuscode']["7"]= 'Queued' ; // 	The indexing action is queued and it is run when all preceding indexing actions are complete.
$config['statuscode']["8"]= 'Unavailable' ; // 	

//IDOL Server is about to shut down or indexing is paused.
//Note: For the DREUNDELETEDOC index action, a status of -8 might mean that the operation is unavailable because NodeTableSecureDelete is turned on.
$config['statuscode']["9"]= 'Out of Memory' ; // 	IDOL Server ran out of memory before the indexing process was completed.
$config['statuscode']["10"]= 'Interrupted' ; // 	The indexing action was interrupted.
$config['statuscode']["11"]= 'XML is not well formed' ; // 	Indexing failed because the XML is not well formed.
$config['statuscode']["12"]= 'Retrying interrupted command' ; // 	IDOL Server is running an index action that was previously interrupted.
$config['statuscode']["13"]= 'Backup in progress' ; // 	IDOL Server is performing a backup.
$config['statuscode']["14"]= 'Max index size reached' ; // 	The indexing job exceeds the maximum indexing size (your license determines the maximum indexing size).
$config['statuscode']["15"]= 'Max number of sections reached' ; // 	The indexing job exceeds the maximum number of sections that you can index. (Your license determines the number of sections you can index).
$config['statuscode']["16"]= 'Indexing Paused' ; // 	The indexing process was paused.
$config['statuscode']["17"]= 'Indexing Resumed' ; // 	The indexing process was restarted.
$config['statuscode']["18"]= 'Indexing Cancelled' ; // 	The indexing process was cancelled.
$config['statuscode']["19"]= 'Out of file descriptors' ; // 	IDOL Server ran out of file descriptors.
$config['statuscode']["20"]= 'LanguageType not found' ; // 	The language type of the index data was not found.
$config['statuscode']["21"]= 'SecurityType not found' ; // 	The security type of the index data was not found.
$config['statuscode']["22"]= 'Child engines returned differing messages' ; // 	The child servers returned different messages to the DIH. This code is reported by DIH only.
$config['statuscode']["23"]= 'Badly formatted index command' ; // 	The indexing action was rejected by a child server because the syntax is invalid.
$config['statuscode']["25"]= 'To be sent to DRE' ; // 	The index action is queued to be sent to the IDOL Server. This code is reported by DIH only.
$config['statuscode']["26"]= 'DREADDDATA: Data received did not include #DREENDDATA' ; // 	The data in the DREADDDATA action did not contain a #DREEDNDDATA statement indicating the end of the data.
$config['statuscode']["27"]= 'Command failed more times than the configured retry limit' ; // 	The indexing action exceeded the maximum number of retries specified by the MaximumRetries parameter in the DIH configuration. This code is reported by DIH only.
$config['statuscode']["28"]= 'The index ID specified is invalid.' ; // 	The index ID returned by the child server is invalid. This code is reported by DIH only.
$config['statuscode']["29"]= 'Command was redistributed to sibling engines as this engine was either unavailable or not to accept index jobs.' ; // 	The indexing action was sent to sibling servers because the child server was either unavailable or not accepting indexing jobs. This code is reported by DIH only.
$config['statuscode']["30"]= 'Database name too long' ; // 	The name of the database in which you are indexing documents is too long. The length is defined internally as 63 characters.
$config['statuscode']["31"]= 'Command ignored due to id match' ; // 	The DREINITIAL action was ignored because it did not match the ID specified in the InitialID parameter.
$config['statuscode']["33"]= '' ; //The database cannot be created because the maximum number of databases was exceeded. The maximum is defined internally as 32,767.
$config['statuscode']["34"]= 'Pending commit' ; // 	The indexing job is complete and the documents become available for searching after the next delayed sync cycle, which is specified in the DelayedSync parameter.
$config['statuscode']["35"]= 'Initializing' ; // 	The indexing job is being started. This code is reported by DIH only.
$config['statuscode']["36"]= 'Reading IDX' ; // 	The IDX file is being read from disk, prior to being sent to the DRE. This code is reported by DIH only.
$config['statuscode']["37"]= 'Failed' ; // 	The index action has permanently failed.
$config['statuscode']["38"]= 'Processing in remote engine.' ; // 	The target server of a DREEXPORTREMOTE operation is processing the exported documents. 


