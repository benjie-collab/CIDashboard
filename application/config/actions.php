<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Options 
| -------------------------------------------------------------------------
*/
$config['options']['print']['all']				='All';
$config['options']['print']['allsections']		='AllSections';
$config['options']['print']['date']				='Date';
$config['options']['print']['fields']			='Fields';
$config['options']['print']['index']			='Index';
$config['options']['print']['indextext']		='IndexText';
$config['options']['print']['negativefields']	='NegativeFields';
$config['options']['print']['none']				='None';
$config['options']['print']['noresults']		='NoResults';
$config['options']['print']['parametric']		='Parametric';
$config['options']['print']['reference']		='Reference';
$config['options']['print']['source']			='Source';

$config['options']['summary']['concept']		='Concept';
$config['options']['summary']['context']		='Context';
$config['options']['summary']['quick']			='Quick';
$config['options']['summary']['paragraphconcept']='ParagraphConcept';
$config['options']['summary']['paragraphcontext']='ParagraphContext';
$config['options']['summary']['off']			='Off';

$config['options']['highlight']['off']					='Off';
$config['options']['highlight']['sentences']			='Sentences';
$config['options']['highlight']['summarysentences']		='SummarySentences';
$config['options']['highlight']['summaryterms']			='SummaryTerms';
$config['options']['highlight']['agentboolsentences']	='AgentBoolSentences';
$config['options']['highlight']['agentboolterms']		='AgentBoolTerms';
$config['options']['highlight']['terms']				='Terms';

$config['options']['expansion']['fuzzy']				='Fuzzy';
$config['options']['expansion']['synonym']				='Synonym';
$config['options']['expansion']['stem']					='Stem';
$config['options']['expansion']['wild']					='Wild';


$config['options']['combine']['simple']				='Simple';
$config['options']['combine']['referencefield']		='ReferenceField';
$config['options']['combine']['fieldcheck']			='FieldCheck';

$config['options']['dateperiod']['century']			='Century';
$config['options']['dateperiod']['year']			='Year';
$config['options']['dateperiod']['month']			='Month';
$config['options']['dateperiod']['week']			='Week';
$config['options']['dateperiod']['day']				='Day';
$config['options']['dateperiod']['hour']			='Hour';
$config['options']['dateperiod']['second']			='Second';


$config['options']['actions']['query']			='Query';
$config['options']['actions']['SuggestOnText']	='SuggestOnText';
$config['options']['actions']['Suggest']		='Suggest';
$config['options']['actions']['List']			='List';
$config['options']['actions']['GetContent']		='GetContent';
$config['options']['actions']['DocumentStats']	='DocumentStats';


$config['options']['responseformat']['json']	='json';
$config['options']['responseformat']['xml']		='xml';


/** Document Elements **/
$config['options']['tagnames']['autn:reference']			= 'autn:reference';
$config['options']['tagnames']['autn:id']					= 'autn:id';
$config['options']['tagnames']['autn:section']				= 'autn:section';
$config['options']['tagnames']['autn:weight']				= 'autn:weight';
$config['options']['tagnames']['autn:links']				= 'autn:links';
$config['options']['tagnames']['autn:database']				= 'autn:database';
$config['options']['tagnames']['autn:summary']				= 'autn:summary';



/*
| -------------------------------------------------------------------------
| Actions 
| -------------------------------------------------------------------------
*/
$config['actions']['query']						='Query';
$config['actions']['suggest']					='Suggest';
$config['actions']['getcontent']				='GetContent';
$config['actions']['termexpand']				='TermExpand';
$config['actions']['termgetall']				='TermGetAll';
$config['actions']['termgetbest']				='TermGetBest';
$config['actions']['termgetinfo']				='TermGetInfo';
$config['actions']['getquerytagvalues']			='GetQueryTagValues';
$config['actions']['gettagnames']				='GetTagNames';
$config['actions']['gettagvalues']				='GetTagValues';
$config['actions']['getstatus']					='GetStatus';
$config['actions']['getpid']					='GetPid';
$config['actions']['indexergetstatus']			='IndexerGetsStatus';


/*
| -------------------------------------------------------------------------
| Query 
| -------------------------------------------------------------------------
*/
$config['query']['action']					='query';
$config['query']['absweight']				='false'; 	//use absolute weights, rather than percentage relevance. 	 
$config['query']['agentbooleanfield']		=''; 	// 	a field that contains boolean agent expressions. 	 
$config['query']['agentparamsfield']		=''; 	// 	a field that contains extra query parameters for agentboolean queries. 	 
$config['query']['agentsecurityfield']		=''; 	// 	a field that contains the securityinfo for secure documents in agentboolean queries. 	 
$config['query']['anylanguage']				='true'; 	// 	allows idol content component to return documents in any language. 	 
$config['query']['autophrase']				='false'; 	// 	applies automatic phrase quotations to all terms in the query text before sentence-breaking, ngram breaking or decomposition. 	 
$config['query']['casesensitive']			='false'; 	// 	determines the case sensitivity of field specifiers. 	 
$config['query']['characters']				=''; 	// 	the number of characters that a summary can contain. 	 
$config['query']['cluster']					='false'; 	// 	clusters the results that idol content component returns. 	 
$config['query']['clusterthreshold']		=50; 	// 	the percentage relevance that documents must have to each other to be grouped in a cluster. 	 
$config['query']['clustertitlelength']		=4; 	// 	the maximum number of characters in a cluster title. 	 
$config['query']['combine']					=''; 	// 	combine results that derive from the same source. 	 
$config['query']['combinenumber']			=1; 	// 	increases the number of results that the action products, if combine is set to fieldcheck or to reference fields. 	 
$config['query']['dahendstate']				=''; 	// 	define the range of results to return in a batch. 	 
$config['query']['dahstartstate']			=-1; 	// 	returns results in batches. 	 
$config['query']['databasematch']			=''; 	// 	the database to retrieve results from. 	 
$config['query']['detectlanguagetype']		='false'; 	// 	detect the correct language type of the text. 	 
$config['query']['dontmatchid']				=''; 	// 	document ids for documents that you do not want to return. 	 
$config['query']['dontmatchreference']		=''; 	// 	references for documents that you do not want to return. 	 
$config['query']['endtag']					='</span>'; 	// 	the end html tag to apply to highlighted terms. 	 
$config['query']['fieldcheck']				=''; 	// 	match results that have a specified value in a fieldchecktype field. 	 
$config['query']['fieldrecurse']			=''; 	// 	returns the chain of values in a document referencememorymappedtype field. 	 
$config['query']['fieldrestriction']		=''; 	// 	restrict the query terms to a field. 	 
$config['query']['fieldtext']				=''; 	// 	add a field restriction to the query. 	see comments
$config['query']['fieldtextfield']			=''; 	// 	a field that contains a fieldtext expression to use. 	 
$config['query']['hardfieldrestriction']	='false'; 	// 	specifies that the fields in fieldrestriction are the only fields allowed in the matching process for both fieldtext and text. 	 
$config['query']['highlight']				='off'; 	// 	whether to highlight link terms or sentences in the results. 	 
$config['query']['highlighttagterm']		='false'; 	// 	adds an attribute to the starttag to indicate the term that is highlighted. 	 
$config['query']['ignorespecials']			='false'; 	// 	ignore certain special characters. 	 
$config['query']['irs']						='false'; 	// 	send the query to an instant response server (irs). 	 
$config['query']['languagetype']			=''; 	// 	the language type of the query text. 	 
$config['query']['linkfieldtext']			=''; 	// 	the fieldtext expression to match in the linked documents, when fieldtext contains an expression with the link field specifier. 	 
$config['query']['matchallterms']			='false'; 	// 	whether to return only results that match all query terms. 	 
$config['query']['matchencoding']			=''; 	// 	the encoding that a document must have to return. 	 
$config['query']['matchid']					=''; 	// 	document ids for documents that you want to return. 	 
$config['query']['matchlanguage']			=''; 	// 	the language that a document must have to return. 	 
$config['query']['matchlanguagetype']		=''; 	// 	the language type that a document must have to return. 	 
$config['query']['matchreference']			=''; 	// 	document references that can return. 	 
$config['query']['maxdate']					=''; 	// 	the maximum creation date that a document can have to return. 	 
$config['query']['maxlinksperterm']			=''; 	// 	reduce the maximum occurrence of each term for categorization. 	 
$config['query']['maxprintchars']			='unlimited'; 	// 	the maximum number of characters to print in fields. 	 
$config['query']['maxqueryterms']			=''; 	// 	the maximum number of terms to use in the query. 	 
$config['query']['maxresults']				=10; 	// 	the maximum number of results to print. 	 
$config['query']['maxscore']				=100; 	// 	the maximum score that results can obtain. 	 
$config['query']['mindate']					=''; 	// 	the minimum creation date that a document can have to return. 	 
$config['query']['minid']					=''; 	// 	the minimum document id to list. 	 
$config['query']['minlinks']				=0; 	// 	the minimum number of links in results documents. 	 
$config['query']['minscore']				=0; 	// 	the minimum score that results must have. 	 
$config['query']['mintermlength']			=2; 	// 	the minimum length that a term can have after stemming. 	 
$config['query']['multistage']				='false'; 	// 	use multi-stage query for the dah. 	 
$config['query']['multistageinfo']			=''; 	// 	the vdbs to use for the multi-stage query. 	 
$config['query']['multistageminresults']	=''; 	// 	the minimum number of results to return in the multi-stage query. 	 
$config['query']['multistagepagebackward']	=''; 	// 	page backward in the multi-stage query. 	 
$config['query']['multistagestartstate']	=''; 	// 	the start state for the multi-stage query. 	 
$config['query']['multistagetotalstages']	=''; 	// 	the total number of stages for the multi-stage query. 	 
$config['query']['outputencoding']			=''; 	// 	the encoding to convert the results to. 	 
$config['query']['performanceanalysis']		='false'; 	// 	return query performance information. 	 
$config['query']['predict']					='true'; 	// 	whether to predict the total number of results. 	 
$config['query']['print']					='fields'; 	// 	defines the fields to display. 	 
$config['query']['printfields']				=''; 	// 	overrides fields that display by default. 	 
$config['query']['querysummary']			='false'; 	// 	return a summary of the best terms and phrases of the results. 	 
$config['query']['querysummaryadvanced']	='false'; 	// 	whether to enable the advanced algorithm for query summaries, for dynamic summaries and automatic query guidance. 	 
$config['query']['querysummaryids']			='false'; 	// 	whether to include the ids of parent documents for query summary phrases in the response. 	 
$config['query']['querysummarylength']		=10; 	// 	the maximum number of best terms to use in a query summary. 	 
$config['query']['querysummarymaxdoclength']=6000; 	// 	the maximum number of characters per document to use to generate a query summary. 	 
$config['query']['querysummarynumbers']		='false'; 	// 	whether to allow numeric and alphanumeric values in query summaries. 	 
$config['query']['querysummaryplus']		='false'; 	// 	whether to enable the querysummaryplus algorithm for query summaries. 	 
$config['query']['querysummarystopphrasemode']=''; 	// 	disable the configured querysummarystopphrasemode. 	 
$config['query']['querysummaryterms']		=0; 	// 	the number of terms to use to generate a query summary. 	 
$config['query']['querysummarywhitelistmode']=''; 	// 	disable the configured querysummarywhitelistmode. 	 
$config['query']['referencefield']			=''; 	// 	restricts the dontmatchreference and matchreference parameters to the specified reference field. 	 
$config['query']['securityinfo']			=''; 	// 	the security details. 	 
$config['query']['sentences']				=5; 	// 	the number of sentences that the summary can contain. 	 
$config['query']['singlematch']				='false'; 	// 	return a single result. 	 
$config['query']['sort']					='relevance'; 	// 	the display order to use for results.
$config['query']['spellcheck']				='false'; 	// checks the spelling of terms in the text. 	 
$config['query']['start']					=1; 	// 	print results from this position onwards. 	 
$config['query']['starttag']				='<span class="highlight">'; 	// 	the opening html tag to apply to highlighted terms. 	 
$config['query']['statedontmatchid']		=''; 	// 	the state token of a group of documents to not return. 	 
$config['query']['statematchid']			=''; 	// 	the state token of a group of documents to return. 	 
$config['query']['stemming']				='true'; 	// 	whether to use stemming for advanced search. 	 
$config['query']['storedstatedetail']		='false'; 	// 	return engine and engineindex elements for result documents, as well as child server details. 	 
$config['query']['storedstatefield']		=''; 	// 	the field that contains reference values to use to create the state token. 	 
$config['query']['storedstatetokenlifetime']=0; 	// 	the length of time to keep the stored state token. 	 
$config['query']['storestate']				='false'; 	// 	whether to store results in a state token. 	 
$config['query']['summary']					='off'; 	// 	the type of summary to return with the results. 	 
$config['query']['synchronous']				='true'; 	// 	whether to run the action synchronously or asynchronously. 	 
$config['query']['synonym']					='false'; 	// 	whether to run a synonym query. 	 
$config['query']['text']					='*'; 	// 	the query text. 	see comments
$config['query']['textparse']				='false'; 	// 	the format of the text. 	 
$config['query']['timeoutms']				=''; 	// 	the period after which the action times out. 	 
$config['query']['totalresults']			='false'; 	// 	displays the total number of results found. 	 
$config['query']['usermetafields']			=''; 	// 	creates a new metafield by performing a mathematical operation on document fields. 	 
$config['query']['vql']						='false'; 	// 	run a verity query language (vql) query. 	 
$config['query']['weighfieldtext']			='true'; 	// 	adjusts results relevance according to fieldtext matching. 	 
$config['query']['xmlmeta']					='false'; 	// 	whether to return additional metadata for each result.
$config['query']['responseformat']			='json';	

$config['query']['daterange']				='';	




/*
| -------------------------------------------------------------------------
| Suggest
| -------------------------------------------------------------------------
*/
$config['suggest']['action']				='suggest';
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
$config['suggest']['print']					='fields';
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
$config['suggest']['summary']				='off';
$config['suggest']['synchronous']			='';
$config['suggest']['timeoutms']				='';
$config['suggest']['totalresults']			='true';
$config['suggest']['weighfieldtext']		='';
$config['suggest']['xmlmeta']				='';
$config['suggest']['responseformat']		='json';








/*
| -------------------------------------------------------------------------
| GetContent
| -------------------------------------------------------------------------
*/
$config['getcontent']['action']				='getcontent';
$config['getcontent']['boolean']			='false'; //the format of the terms in the links parameter. 	 
$config['getcontent']['characters']			=''; //the number of characters that a summary can contain. 	 
$config['getcontent']['databasematch']		=''; //the database to retrieve results from. 	 
$config['getcontent']['endtag']				='</span>'; //the end html tag to apply to highlighted terms. 	 
$config['getcontent']['fieldrecurse']		='false'; //returns the chain of values in a document referencememorymappedtype field. 	 
$config['getcontent']['fieldrestriction']	=''; //restricts a query to specified fields. 	see comments
$config['getcontent']['hardfieldrestriction']='false'; //set to true to use only the fields that you list in the fieldrestriction parameter for matching for the text and fieldtext parameters. 	see comments
$config['getcontent']['highlight']			='off'; //whether to highlight link terms or sentences in the results. 	 
$config['getcontent']['highlighttagterm']	='false'; //adds an attribute to the starttag to indicate the term that is highlighted. 	 
$config['getcontent']['id']					=''; //the id of the documents to return. 	see comments
$config['getcontent']['ignorespecials']		='false'; //treat special characters as normal characters in query syntax. 	see comments
$config['getcontent']['languagetype']		=''; //the language type of the terms. 	 
$config['getcontent']['links']				=''; //the terms to highlight. 	 
$config['getcontent']['matchallterms']		='false'; //return only results that match all terms in a query. 	see comments
$config['getcontent']['maxprintchars']		='unlimited'; //the maximum number of terms to print in fields. 	 
$config['getcontent']['outputencoding']		=''; //the encoding to convert the results to. 	 
$config['getcontent']['print']				='fields'; //defines the fields to display. 	 
$config['getcontent']['printfields']		=''; // 	overrides fields that display by default. 	 
$config['getcontent']['reference']			=''; // 	the references of documents to return. 	 
$config['getcontent']['referencefield']		=''; // 	restricts the reference parameter to the specified reference field. 	see comments
$config['getcontent']['securityinfo']		=''; // 	the security details. 	 
$config['getcontent']['sentences']			=''; // 	the number of sentences that the summary can contain. 	 
$config['getcontent']['starttag']			='<span class="highlight">'; // 	the opening html tag to apply to highlighted terms. 	 
$config['getcontent']['stateid']			=''; // 	a state token that specifies the documents to return. 	see comments
$config['getcontent']['stemming']			='true'; // 	disable stemming so that only documents that contain exact matches of query terms can return as results. 	see comments
$config['getcontent']['summary']			='off'; // 	the type of summary to return with the document. 	 
$config['getcontent']['synchronous']		=''; // 	whether to run the action synchronously or asynchronously. 	 
$config['getcontent']['xmlmeta']			=''; // 	whether to return additional metadata for each result.
$config['getcontent']['responseformat']		='json';		












/*
| -------------------------------------------------------------------------
| TermExpand
| -------------------------------------------------------------------------
*/
$config['termexpand']['action']					='termexpand';
$config['termexpand']['expansion']				='';  	//the expansion type to use. 	yes
$config['termexpand']['languagetype']			='';  	//the language type of the text. 	 
$config['termexpand']['maxterms']				=50;  	//the maximum number of terms or term phrases to return. 	 
$config['termexpand']['mindococcs']				='';  	//the minimum number of times a term must occur to return. 	 
$config['termexpand']['outputencoding']			='';  	//the encoding to convert the results to. 	 
$config['termexpand']['stemming']				='true';  	//whether to return the list of terms unstemmed. 	 
$config['termexpand']['synchronous']			='';  	//whether to run the action synchronously or asynchronously. 	 
$config['termexpand']['termdetails']			='false';  	//returns details of the number of documents that each term occurs in. 	 
$config['termexpand']['text']					='';  	//the text or synonym link to expand. 	yes
$config['termexpand']['type']					='none';  	//the value to use to order the result terms.
$config['termexpand']['responseformat']			='json';


/*
| -------------------------------------------------------------------------
| TermGetAll
| -------------------------------------------------------------------------
*/
$config['termgetall']['action']					='termgetall';
$config['termgetall']['maxterms']				=100;
$config['termgetall']['termdetails']			='true';
$config['termgetall']['termanalysis']			='true';
$config['termgetall']['responseformat']			='json';
$config['termgetall']['maxdococcs']				=1000;
$config['termgetall']['mindococcs']				=100;
$config['termgetall']['stemming']				='true';


/*
| -------------------------------------------------------------------------
| TermGetBest
| -------------------------------------------------------------------------
*/
$config['termgetbest']['action']				='termgetbest';
$config['termgetbest']['id']					='';
$config['termgetbest']['maxterms']				=50;
$config['termgetbest']['responseformat']		='json';
$config['termgetbest']['mindococcs']			=5;
$config['termgetbest']['stemming']				='true';



/*
| -------------------------------------------------------------------------
| TermGetInfo
| -------------------------------------------------------------------------
*/
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
$config['termgetinfo']['responseformat']		='json';




/*
| -------------------------------------------------------------------------
| GetQueryTagValues
| -------------------------------------------------------------------------
*/
$config['getquerytagvalues']['action']					='getquerytagvalues';
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
$config['getquerytagvalues']['ranges']				= ''; //'false';
$config['getquerytagvalues']['referencefield']		='';
$config['getquerytagvalues']['restrictedvalues']	='false'; //'false';
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
$config['getquerytagvalues']['responseformat']		='json';




/*
| -------------------------------------------------------------------------
| GetTagNames
| -------------------------------------------------------------------------
*/
$config['gettagnames']['action']				='gettagnames';
$config['gettagnames']['basefieldcodeonly']		='false';
$config['gettagnames']['fieldcode']				='';
$config['gettagnames']['fieldtype']				='';
$config['gettagnames']['maxvalues']				='';
$config['gettagnames']['outputencoding']		='';
$config['gettagnames']['start']					=1;
$config['gettagnames']['synchronous']			='true';
$config['gettagnames']['typedetails']			='true';
$config['gettagnames']['responseformat']		='json';




/*
| -------------------------------------------------------------------------
| GetTagValues
| -------------------------------------------------------------------------
*/
$config['gettagvalues']['action']				='gettagvalues';
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
$config['gettagvalues']['responseformat']		='json';



/*
| -------------------------------------------------------------------------
| GetStatus
| -------------------------------------------------------------------------
*/
$config['getstatus']['action'] 				= 'getstatus';
$config['getstatus']['actionid'] 			= '';
$config['getstatus']['encryptresponse'] 	= 'true';
$config['getstatus']['filename'] 			= '';
$config['getstatus']['forcetemplaterefresh']= 'false';
$config['getstatus']['format'] 				= 'xml';
$config['getstatus']['output'] 				= '';
$config['getstatus']['portonly'] 			= 'false';
$config['getstatus']['responseformat'] 		= 'json';
$config['getstatus']['template'] 			= '';
$config['getstatus']['templateparamcsvs'] 	= '';


/*
| -------------------------------------------------------------------------
| GetPid
| -------------------------------------------------------------------------
*/
$config['getpid']['action'] 				= 'getpid';
$config['getpid']['actionid'] 				= '';
$config['getpid']['encryptresponse'] 		= 'true';
$config['getpid']['filename'] 				= '';
$config['getpid']['forcetemplaterefresh']	= 'false';
$config['getpid']['output'] 				= '';
$config['getpid']['responseformat'] 		= 'json';
$config['getpid']['template'] 				= '';
$config['getpid']['templateparamcsvs'] 		= '';

/*
| -------------------------------------------------------------------------
| IndexerGetStatus
| -------------------------------------------------------------------------
*/
$config['indexergetstatus']['action'] 				= 'indexergetstatus';
$config['indexergetstatus']['actionid'] 			= '';
$config['indexergetstatus']['epochtime'] 			= '';
$config['indexergetstatus']['filename'] 			= '';
$config['indexergetstatus']['forcetemplaterefresh']	= 'false';
$config['indexergetstatus']['index']				= '';
$config['indexergetstatus']['indexaction']			= '';
$config['indexergetstatus']['indexcmd']				= '';
$config['indexergetstatus']['indexstatus']			= '';
$config['indexergetstatus']['maxresults']			= '';
$config['indexergetstatus']['priority']				= 0;
$config['indexergetstatus']['output']				= '';
$config['indexergetstatus']['template']				= '';
$config['indexergetstatus']['templateparamcsvs']		= '';
$config['indexergetstatus']['responseformat'] 		= 'json';