<?php 
/*
* @Title: Rules
* @Method: Profile 
* @icon: fa-tasks fa
*/ 
?>


<?php 
	$profile = $this->users->user()->row();	
	$template_url = $this->template_model->get_template_url();	
	$rules = $this->rules_model->get_rules(NULL, array());	
	$categories = $this->application->get_widgets('Profile');
?>
<section class="content-header">
  <h1>
	<?php echo lang('profile_heading');?>
	<small><?php echo lang('profile_subheading');?></small>
  </h1>
   <?=$this->template_model->get_breadcrumb()?>
</section>

<section class="content">
	<div class="col-md-3">
		<?php $this->load->view($sidebar); ?>		
	</div>	
	<div class="col-md-9">
		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Your Rules</h3>
                  <div class="box-tools pull-right">
					<!--
                    <div class="has-feedback">
                      <input type="text" placeholder="Search Mail" class="form-control input-sm">
                      <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>-->
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
                   
                  </div>
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
						<tbody>
							<?php 
								foreach ($rules as $rule):
								$rule_setting = unserialize(element('rule_settings', $rule));
							?>
								<tr>								
									<td class="mailbox-star">
										<a href="#"><i class="fa <?=element('active', $rule_setting)? 'fa-star' : 'fa-star-o'; ?> text-yellow"></i></a>
									</td>
									<td class="mailbox-name text-capitalize"><a href="#"><?=element('category', $rule_setting)?></a></td>
									<td class="mailbox-subject"><b><?=element('name', $rule_setting)?></b></td>
									<td class="mailbox-attachment"></td>
									<td class="mailbox-date">5 mins ago</td>
									<td>
																				
										<a href="#modal-widget-options" 
											class="btn btn-xs text-muted"
											data-toggle="modal"
											data-remote="<?=base_url('profile/edit_rule/dashboard_' . strtolower(element('category', $rule_setting)) . '/' . element('id', $rule))?>"
											>Edit</a>
										<a href="#" 
											class="btn btn-xs text-muted"
											onclick="javascript:confirmDialog('<?=base_url('/profile/delete_rule/' . element('id', $rule))?>')"
											>Delete</a>	
									</td>
								</tr> 
							<?php
								endforeach;							
							?>
							                      
						</tbody>
					</table>
				</div>
				</div>
				
				 <div class="box-footer clearfix">
				 
				 
					<div class="btn-group">
                      <button class="btn btn-primary" type="button">Add New Rule</button>
                      <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button">
                        <span class="caret"></span>
                        <span class="sr-only">Add New Rule</span>
                      </button>
                      <ul role="menu" class="dropdown-menu">
						<?php 
						foreach($categories as $cat):
						?>
							<li>
							<a 
								data-toggle="modal"
								data-remote="<?=base_url('/profile/create_rule/'.element('@key', $cat))?>"
								href="#modal-widget-options"						
							>
							<i class="fa <?=element('@icon', $cat)?>"></i>
							<?=element('@title', $cat)?></a></li>
						<?php
						endforeach;
						?>
                      </ul>
                    </div>
				 
				 
				 </div>
		</div>
		
	</div>
</section>


 






