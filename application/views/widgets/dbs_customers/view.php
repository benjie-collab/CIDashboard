<?php 
/*
* @Title: DBS Customer
* @Method: Pages
* @icon: ion-person-stalker
* @Description: Displays the result of the documents with configurable options.
*/ 
?>

<?php 	
/** 
	Received Parameters:
	$widget_key
	$meta_key
	$query_settings
**/
	
	$query_config	= $this->application->get_config('query','actions');
	$page 			= $this->session->userdata('current_page');
	$is_page 		= $this->application->is_page();
	$options 		= isset($meta_key)? $this->application->get_settings($meta_key) : array();
	$query_options	= array_key_exists('query', $options)? element('query', $options): array();
	
		
	$results = array();
	if($query_settings){
		$query_settings = isset($query_settings)?	$query_settings : $this->application->get_session_userdata('current_search');	
		$query = array_merge(
					$query_config,					
					$query_options, 
					$query_settings,
					array(
						'action'=> 'query',
						'print'=> 'all',
						'server'=> $page->server,
					));
		$results = $this->idol->QueryAction($query);
		$results = clean_json_response($results);
		
	}	
	
	$numhits 	= array_get_value($results, 'autn:numhits');
	$document_options = $this->application->get_config('document_options', 'template');
	
?>
<?php 
	if(intval($numhits)==1){
	
	$hit 		= array_get_value($results, 'autn:hit');
	$document 	= array_get_value($hit, 'DOCUMENT');
	$this->session->set_userdata('dbs_customer', $document);

?>
<div class="box box-solid">
	<div class="box-body no-padding">		
		<div class="text-center p-10 <?=element('bgcolor',$options)? 'bg-' .element('bgcolor',$options).'-gradient' : 'bg-aqua-gradient'?>">
			<img alt="User Image" class="img-circle" src="<?=base_url('/assets/themes/lte/img/user.jpg')?>">
			<h4><?=element('NAME_M_FT', $document)?></h4>
		</div>
		<ul class="nav nav-pills nav-stacked">
			<?php 
			$doc_meta = element('doc_meta', $options);
			if($doc_meta){
			$dm = $doc_meta[0];
			$dm = end(explode('/', $dm));
			
			
			?>
			<li class="">
				<a href="javascript:void(0)">
					<b><?=reset(explode('_', $dm))?></b> : <?=element($dm , $document)?>			
				</a>	
			</li>			
			<?php			
			}				
			?>
		</ul>
		<div class="collapse" id="acct-details-full"> 
		<ul class="nav nav-pills nav-stacked">
			<?php 
			$doc_meta = element('doc_meta', $options);
			if($doc_meta)
			for($i=1; $i<sizeof($doc_meta); $i++){
			$dm = $doc_meta[$i];
			$dm = end(explode('/', $dm));
			?>
			<li class="">
				<a href="javascript:void(0)">
					<b><?=reset(explode('_', $dm))?></b> : <?=element($dm , $document)?>			
				</a>	
			</li>			
			<?php			
			}				
			?>
		</ul>
		</div>
	</div>
	<div class="box-footer clearfix text-center">
	  <!--<button class="btn btn-flat btn-warning" 
	  data-toggle="modal"
	  data-target="#modal-page-search-form"
	  ><i class="fa fa-toggle-on"></i> Switch Customer</button>-->
	  <button class="btn btn-flat btn-sm"  data-toggle="collapse" data-target="#acct-details-full"
	  ><i class="fa fa-chevron-down"></i> Full Details</button>
	</div>
</div>
<?php 
	}else{	
		$this->session->unset_userdata('dbs_customer');
	}
?>
	
		


