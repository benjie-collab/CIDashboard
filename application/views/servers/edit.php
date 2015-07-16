<section class="content-header">
  <h1>
	<?php echo lang('edit_server_heading');?>
	<small><?php echo lang('edit_server_subheading');?></small>
  </h1>
   <?=$this->application->breadcrumb()?>
</section>
<?php 
	$atts = array(
			'class' => 'form-horizontal',
			'data-bind' => 'submit: $root.Servers.updateServer', 
			'onsubmit' => 'return false;', 
			'method' => 'POST',
			'id' => ''
	);
	$hidden 		= array();		
?>
<section class="content">	
	<?php echo $message;?>
	<div class="row">
		<div class="col-md-9">
			<?php echo form_open('servers/edit/' . $id, $atts, $hidden);?>
			<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit Server</h3>
				  <div class="box-tools pull-right">
				  </div>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('create_server_url_label', 'server');?></label>
						<div class="col-sm-9">
						 <?php echo form_input($server);?>
						 </div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('create_server_port_label', 'port');?></label>
						<div class="col-sm-9">
						 <?php echo form_input($port);?>
						 </div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('create_server_username_label', 'username');?></label>
						<div class="col-sm-9">
						 <?php echo form_input($username);?>
						 </div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo lang('create_server_password_label', 'password');?></label>
						<div class="col-sm-9">
						 <?php echo form_input($password);?>
						 </div>
					</div>
				</div>				
				<div class="box-footer clearfix">	
					<a class="btn btn-default btn-flat btn-sm" type="button" href="<?=base_url('servers')?>">Cancel</a>
					<button type="submit" class="btn btn-sm btn-primary btn-flat pull-right" data-bind="css: { 'has-spinner active' : $root.Servers.ajaxProcess}">
					<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>	
					Update</button>
				</div>
			</div>
			<?php echo form_close();?>
		
		</div>
	</div>
	<div class="col-md-3">	
	</div>	
</section>







