<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$lang['query_description']			="Allows you to submit a natural language, Boolean, bracketed Boolean, keyword, field or fuzzy query to IDOL Content Component.";
$lang['query_action']				="action api";
$lang['query_absweight']			="use absolute weights, rather than percentage relevance. 	"; 
$lang['query_agentbooleanfield']	="a field that contains boolean agent expressions. 	 ";
$lang['query_agentparamsfield']		="a field that contains extra query parameters for agentboolean queries. 	 ";
$lang['query_agentsecurityfield']	="a field that contains the securityinfo for secure documents in agentboolean queries."; 	 
$lang['query_anylanguage']			="allows idol content component to return documents in any language. 	 ";
$lang['query_autophrase']			="applies automatic phrase quotations to all terms in the query text before sentence-breaking, ngram breaking or decomposition. 	"; 
$lang['query_casesensitive']		="determines the case sensitivity of field specifiers. ";	 
$lang['query_characters']			="the number of characters that a summary can contain. 	 ";
$lang['query_cluster']				="clusters the results that idol content component returns. 	 ";
$lang['query_clusterthreshold']		="the percentage relevance that documents must have to each other to be grouped in a cluster. ";	 
$lang['query_clustertitlelength']	="the maximum number of characters in a cluster title. ";	 
$lang['query_combine']				="combine results that derive from the same source. 	 ";
$lang['query_combinenumber']		="increases the number of results that the action products, if combine is set to fieldcheck or to reference fields. 	"; 
$lang['query_dahendstate']			="define the range of results to return in a batch. 	"; 
$lang['query_dahstartstate']		="returns results in batches. 	 ";
$lang['query_databasematch']		="the database to retrieve results from. 	"; 
$lang['query_detectlanguagetype']	="detect the correct language type of the text. 	 ";
$lang['query_dontmatchid']			="document ids for documents that you do not want to return. 	"; 
$lang['query_dontmatchreference']	="references for documents that you do not want to return. 	"; 
$lang['query_endtag']				="the end html tag to apply to highlighted terms. 	 ";
$lang['query_fieldcheck']			="match results that have a specified value in a fieldchecktype field. ";	 
$lang['query_fieldrecurse']			="returns the chain of values in a document referencememorymappedtype field."; 	 
$lang['query_fieldrestriction']		="restrict the query terms to a field. 	 ";
$lang['query_fieldtext']				="add a field restriction to the query. 	see comments";
$lang['query_fieldtextfield']		="a field that contains a fieldtext expression to use. 	 ";
$lang['query_hardfieldrestriction']	="specifies that the fields in fieldrestriction are the only fields allowed in the matching process for both fieldtext and text. 	"; 
$lang['query_highlight']			="whether to highlight link terms or sentences in the results. 	"; 
$lang['query_highlighttagterm']		="adds an attribute to the starttag to indicate the term that is highlighted. ";	 
$lang['query_ignorespecials']		="ignore certain special characters. 	 ";
$lang['query_irs']					="send the query to an instant response server (irs). 	"; 
$lang['query_languagetype']			="the language type of the query text. 	 ";
$lang['query_linkfieldtext']		="the fieldtext expression to match in the linked documents, when fieldtext contains an expression with the link field specifier."; 	 
$lang['query_matchallterms']		="whether to return only results that match all query terms. 	 ";
$lang['query_matchencoding']		="the encoding that a document must have to return. ";	 
$lang['query_matchid']				="document ids for documents that you want to return. ";	 
$lang['query_matchlanguage']		="the language that a document must have to return. 	"; 
$lang['query_matchlanguagetype']	="the language type that a document must have to return. 	"; 
$lang['query_matchreference']		="document references that can return. 	 ";
$lang['query_maxdate']				="the maximum creation date that a document can have to return. ";	 
$lang['query_maxlinksperterm']		="reduce the maximum occurrence of each term for categorization."; 	 
$lang['query_maxprintchars']		="the maximum number of characters to print in fields. 	"; 
$lang['query_maxqueryterms']		="the maximum number of terms to use in the query. ";	 
$lang['query_maxresults']			="the maximum number of results to print. 	 ";
$lang['query_maxscore']				="the maximum score that results can obtain. 	 ";
$lang['query_mindate']				="the minimum creation date that a document can have to return. 	"; 
$lang['query_minid']				="the minimum document id to list. 	 ";
$lang['query_minlinks']				="the minimum number of links in results documents. ";	 
$lang['query_minscore']				="the minimum score that results must have. 	 ";
$lang['query_mintermlength']		="the minimum length that a term can have after stemming. ";	 
$lang['query_multistage']			="use multi-stage query for the dah. 	 ";
$lang['query_multistageinfo']		="the vdbs to use for the multi-stage query. 	 ";
$lang['query_multistageminresults']	="the minimum number of results to return in the multi-stage query. 	 ";
$lang['query_multistagepagebackward']="page backward in the multi-stage query. 	"; 
$lang['query_multistagestartstate']	="the start state for the multi-stage query."; 	 
$lang['query_multistagetotalstages']="the total number of stages for the multi-stage query. ";	 
$lang['query_outputencoding']		="the encoding to convert the results to. ";	 
$lang['query_performanceanalysis']	="return query performance information. 	 ";
$lang['query_predict']				="whether to predict the total number of results. 	"; 
$lang['query_print']				="defines the fields to display. 	 ";
$lang['query_printfields']			="overrides fields that display by default. 	"; 
$lang['query_querysummary']			="return a summary of the best terms and phrases of the results. 	 ";
$lang['query_querysummaryadvanced']	="whether to enable the advanced algorithm for query summaries, for dynamic summaries and automatic query guidance. ";	 
$lang['query_querysummaryids']		="whether to include the ids of parent documents for query summary phrases in the response. ";	 
$lang['query_querysummarylength']	="the maximum number of best terms to use in a query summary. 	 ";
$lang['query_querysummarymaxdoclength']="the maximum number of characters per document to use to generate a query summary. ";	 
$lang['query_querysummarynumbers']	="whether to allow numeric and alphanumeric values in query summaries. ";	 
$lang['query_querysummaryplus']		="whether to enable the querysummaryplus algorithm for query summaries. ";	 
$lang['query_querysummarystopphrasemode']="disable the configured querysummarystopphrasemode. 	 ";
$lang['query_querysummaryterms']	="the number of terms to use to generate a query summary. 	"; 
$lang['query_querysummarywhitelistmode']="disable the configured querysummarywhitelistmode. 	 ";
$lang['query_referencefield']		="restricts the dontmatchreference and matchreference parameters to the specified reference field. 	"; 
$lang['query_securityinfo']			="the security details. 	 ";
$lang['query_sentences']			="the number of sentences that the summary can contain."; 	 
$lang['query_singlematch']			="return a single result. 	 ";
$lang['query_sort']					="the display order to use for results.";
$lang['query_spellcheck']			="checks the spelling of terms in the text. 	 ";
$lang['query_start']				="print results from this position onwards. 	 ";
$lang['query_starttag']				="the opening html tag to apply to highlighted terms. ";	 
$lang['query_statedontmatchid']		="the state token of a group of documents to not return."; 	 
$lang['query_statematchid']			="the state token of a group of documents to return. 	 ";
$lang['query_stemming']				="whether to use stemming for advanced search. 	 ";
$lang['query_storedstatedetail']	="return engine and engineindex elements for result documents, as well as child server details. ";	 
$lang['query_storedstatefield']		="the field that contains reference values to use to create the state token. 	 ";
$lang['query_storedstatetokenlifetime']="the length of time to keep the stored state token. ";	 
$lang['query_storestate']			="whether to store results in a state token. 	 ";
$lang['query_summary']				="the type of summary to return with the results. 	 ";
$lang['query_synchronous']			="whether to run the action synchronously or asynchronously. 	 ";
$lang['query_synonym']				="whether to run a synonym query. 	 ";
$lang['query_text']					="the query text. 	see comments";
$lang['query_textparse']			="the format of the text. 	 ";
$lang['query_timeoutms']			="the period after which the action times out. 	 ";
$lang['query_totalresults']			="displays the total number of results found. 	 ";
$lang['query_usermetafields']		="creates a new metafield by performing a mathematical operation on document fields. 	"; 
$lang['query_vql']					="run a verity query language (vql) query. 	 ";
$lang['query_weighfieldtext']		="adjusts results relevance according to fieldtext matching. 	"; 
$lang['query_xmlmeta']				="whether to return additional metadata for each result.";
$lang['query_responseformat']		="result format returned";




$lang['getcotnent_description']		="allows you to display the content of one or more specified documents or document sections.";
$lang['getcotnent_action']			="action api";
$lang['getcotnent_boolean']			="the format of the terms in the links parameter."; 	 
$lang['getcotnent_characters']		="the number of characters that a summary can contain. ";	 
$lang['getcotnent_databasematch']	="the database to retrieve results from. 	 ";
$lang['getcotnent_endtag']			="the end html tag to apply to highlighted terms. ";	 
$lang['getcotnent_fieldrecurse']	="returns the chain of values in a document referencememorymappedtype field. 	"; 
$lang['getcotnent_fieldrestriction']="restricts a query to specified fields. 	see comments";
$lang['getcotnent_hardfieldrestriction']="set to true to use only the fields that you list in the fieldrestriction parameter for matching for the text and fieldtext parameters. 	see comments";
$lang['getcotnent_highlight']		="whether to highlight link terms or sentences in the results. 	 ";
$lang['getcotnent_highlighttagterm']="adds an attribute to the starttag to indicate the term that is highlighted. ";	 
$lang['getcotnent_id']				="the id of the documents to return. 	see comments";
$lang['getcotnent_ignorespecials']	="treat special characters as normal characters in query syntax. 	see comments";
$lang['getcotnent_languagetype']	="the language type of the terms. 	 ";
$lang['getcotnent_links']			="the terms to highlight. 	 ";
$lang['getcotnent_matchallterms']	="return only results that match all terms in a query. 	see comments";
$lang['getcotnent_maxprintchars']	="the maximum number of terms to print in fields. 	 ";
$lang['getcotnent_outputencoding']	="the encoding to convert the results to. 	"; 
$lang['getcotnent_print']			="defines the fields to display. 	 ";
$lang['getcotnent_printfields']		="overrides fields that display by default."; 	 
$lang['getcotnent_reference']		="the references of documents to return. 	 ";
$lang['getcotnent_referencefield']	="restricts the reference parameter to the specified reference field. 	see comments";
$lang['getcotnent_securityinfo']	="the security details. 	 ";
$lang['getcotnent_sentences']		="the number of sentences that the summary can contain. ";	 
$lang['getcotnent_starttag']		="the opening html tag to apply to highlighted terms."; 	 
$lang['getcotnent_stateid']			="a state token that specifies the documents to return. 	see comments";
$lang['getcotnent_stemming']		="disable stemming so that only documents that contain exact matches of query terms can return as results. 	see comments";
$lang['getcotnent_summary']			="the type of summary to return with the document. 	 ";
$lang['getcotnent_synchronous']		="whether to run the action synchronously or asynchronously. 	 ";
$lang['getcotnent_xmlmeta']			="whether to return additional metadata for each result.";
$lang['getcotnent_responseformat']	="result format returned";



$lang['suggest_description']		="Allows you to retrieve documents that are conceptually similar to one or more specified documents or document sections.";
$lang['suggest_action']				="action apis";
$lang['suggest_absweight']			="use absolute weights, rather than percentage relevance. ";	 
$lang['suggest_casesensitive']		="determines the case sensitivity of field specifiers. 	"; 
$lang['suggest_characters']			="the number of characters that a summary can contain. 	 ";
$lang['suggest_cluster']			="clusters the results that idol content component returns. 	 ";
$lang['suggest_clusterthreshold']	="the percentage relevance that documents must have to each other to be grouped in a cluster. ";	 
$lang['suggest_clustertitlelength']	="the maximum number of characters in a cluster title. 	 ";
$lang['suggest_combine']			="combine results that derive from the same source. 	 ";
$lang['suggest_combinenumber']		="increases the number of results that the action products, if combine is set to fieldcheck or to reference fields. 	"; 
$lang['suggest_dahendstate']		="define the range of results to return in a batch. 	"; 
$lang['suggest_dahstartstate']		="returns results in batches. 	 ";
$lang['suggest_databasematch']		="the database to retrieve results from. 	 ";
$lang['suggest_dontmatchid']		="document ids for documents that you do not want to return."; 	 
$lang['suggest_dontmatchreference']	="references for documents that you do not want to return. ";	 
$lang['suggest_endtag']				="the end html tag to apply to highlighted terms. 	"; 
$lang['suggest_fieldcheck']			="match results that have a specified value in a fieldchecktype field. 	 ";
$lang['suggest_fieldrecurse']		="returns the chain of values in a document referencememorymappedtype field. 	"; 
$lang['suggest_fieldtext']			="add a field restriction to the query. 	see comments";
$lang['suggest_highlight']			="whether to highlight link terms or sentences in the results. ";	 
$lang['suggest_highlighttagterm']	="adds an attribute to the starttag to indicate the term that is highlighted. 	"; 
$lang['suggest_id']					="the id of the documents to return. 	see comments";
$lang['suggest_irs']				="send the query to an instant response server (irs). 	"; 
$lang['suggest_languagetype']		="the language type of the query text. 	 ";
$lang['suggest_linkfieldtext']		="the fieldtext expression to match in the linked documents, when fieldtext contains an expression with the link field specifier. 	"; 
$lang['suggest_matchencoding']		="the encoding that a document must have to return. 	 ";
$lang['suggest_matchid']			="document ids for documents that you want to return. ";	 
$lang['suggest_matchlanguage']		="the language that a document must have to return. ";	 
$lang['suggest_matchlanguagetype']	="the language type that a document must have to return. ";	 
$lang['suggest_matchreference']		="document references that can return. 	 ";
$lang['suggest_maxdate']			="the maximum creation date that a document can have to return. ";	 
$lang['suggest_maxid']				="the highest document id to return. 	 ";
$lang['suggest_maxprintchars']		="the maximum number of characters to print in fields. ";	 
$lang['suggest_maxresults']			="the maximum number of results to print. 	"; 
$lang['suggest_maxscore']			="the maximum score that results can obtain. 	 ";
$lang['suggest_mindate']			="the minimum creation date that a document can have to return."; 	 
$lang['suggest_minid']				="the minimum document id to list. 	 ";
$lang['suggest_minlinks']			="the minimum number of links in results documents. 	 ";
$lang['suggest_minscore']			="the minimum score that results must have. 	 ";
$lang['suggest_mintermlength']		="the minimum length that a term can have after stemming. 	"; 
$lang['suggest_outputencoding']		="the encoding to convert the results to. 	"; 
$lang['suggest_performanceanalysis']="return query performance information. 	 ";
$lang['suggest_predict']			="whether to predict the total number of results. ";	 
$lang['suggest_print']				="defines the fields to display. 	 ";
$lang['suggest_printfields']		="overrides fields that display by default. 	 ";
$lang['suggest_querysummary']		="return a summary of the best terms and phrases of the results. 	 ";
$lang['suggest_reference']			="the references of results to suggest results for. 	see comments";
$lang['suggest_referencefield']		="restricts the reference, dontmatchreference and matchreference parameters to the specified reference field. ";	 
$lang['suggest_securityinfo']		="the security details. 	 ";
$lang['suggest_sentences']			="the number of sentences that the summary can contain. ";	 
$lang['suggest_singlematch']		="return a single result. 	 ";
$lang['suggest_sort']				="the display order to use for results. 	 ";
$lang['suggest_start']				="print results from this position onwards. 	"; 
$lang['suggest_starttag']			="the opening html tag to apply to highlighted terms. 	 ";
$lang['suggest_statedontmatchid']	="	the state token of a group of documents to not return. 	 ";
$lang['suggest_stateid']			="a state token that specifies the documents to suggest on. 	see comments";
$lang['suggest_statematchid']		="the state token of a group of documents to return. 	 ";
$lang['suggest_stemming']			="whether to use stemming for advanced search. 	"; 
$lang['suggest_storestate']			="whether to store results in a state token. 	 ";
$lang['suggest_storedstatefield']	="the field that contains reference values to use to create the state token."; 	 
$lang['suggest_storedstatetokenlifetime']="the length of time to keep the stored state token. 	"; 
$lang['suggest_summary']			="the type of summary to return with the results. 	 ";
$lang['suggest_synchronous']		="whether to run the action synchronously or asynchronously. ";	 
$lang['suggest_timeoutms']			="the period after which the action times out. 	 ";
$lang['suggest_totalresults']		="displays the total number of results found. 	 ";
$lang['suggest_weighfieldtext']		="adjusts results relevance according to fieldtext matching."; 	 
$lang['suggest_xmlmeta']			="whether to return additional metadata for each result.";
$lang['suggest_responseformat']		="result format returned";















$lang['termexpand_description']				="Allows you to specify misspelled or wildcard terms and return all matching terms in IDOL Content Component. You can also use TermExpand to return the term phrases that internal synonym links (returned by a synonym query) correspond to.";
$lang['termexpand_action']					="action apis";
$lang['termexpand_expansion']				="the expansion type to use. 	";
$lang['termexpand_languagetype']			="the language type of the text. ";	 
$lang['termexpand_maxterms']				="the maximum number of terms or term phrases to return. ";	 
$lang['termexpand_mindococcs']				="the minimum number of times a term must occur to return. ";	 
$lang['termexpand_outputencoding']			="the encoding to convert the results to. 	 ";
$lang['termexpand_stemming']				="whether to return the list of terms unstemmed. 	 ";
$lang['termexpand_synchronous']				="whether to run the action synchronously or asynchronously. 	"; 
$lang['termexpand_termdetails']				="returns details of the number of documents that each term occurs in. 	 ";
$lang['termexpand_text']					="the text or synonym link to expand. 	yes";
$lang['termexpand_type']					="the value to use to order the result terms.";
$lang['termexpand_responseformat']			="result format returned";