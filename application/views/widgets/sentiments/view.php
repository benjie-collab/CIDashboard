<?php 
/*
* @Title: Sentiments
* @Method: - 
* @icon: fa-tasks
* @Description: Search result pagination. Configure the view accordingly.
*/ 
?>

<?php 
$mode 	  			= $this->application->get_mode('search_mode');
$options	= $this->search_model->get_widget_options('sentiments');
?>

<div class="box box-default">
	<div class="box-header with-border handle <?=$mode? 'cursor-move' : ''?>">
	  <h3 class="box-title"><?=element('title', $options)?>	</h3>	  
	  
	</div>
</div>