<?php 
	$atts = array(
		'data-bind'=>"submit: deactivateUser",
		'onsubmit'=>"return false;",
		
	);
	$hidden = array(
		'id' => $user->id
	);
?>
<div class="text-center">
	<p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>

	<?php echo form_open("user/deactivate/".$user->id, $atts, $hidden);?>


  <p>
	 <input type="hidden" name="confirm" value="no"/>
	 <input type="checkbox" name="confirm" 
		data-bind="BootstrapSwitch: {
			onColor: 'danger',  						
			offColor: 'warning',
			onText: '<?=lang('deactivate_confirm_y_label');?>', 
			offText: '<?=lang('deactivate_confirm_n_label');?>' }" value="yes" checked="checked" />	
  </p>

	<?php echo form_hidden($csrf); ?>
	<?php echo form_close();?>
</div>


