<h1 class="page-header"><?php echo lang('members_heading');?></h1>
<?=$this->template_model->get_breadcrumb()?>


<p><?php echo lang('members_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<div class="table-responsive">
	<table class="table table-hover table-striped">
	<tr>
		<th><?php echo lang('members_fname_th');?></th>
		<th><?php echo lang('members_lname_th');?></th>
		<th><?php echo lang('members_email_th');?></th>
		<th><?php echo lang('members_groups_th');?></th>
		<th><?php echo lang('members_status_th');?></th>
		<th><?php echo lang('members_action_th');?></th>
	</tr>
	<?php foreach ($users as $user):?>
		<tr>
            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
			<td>
				<?php foreach ($user->groups as $group):?>
					<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                <?php endforeach?>
			</td>
			<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('members_active_link')) : anchor("auth/activate/". $user->id, lang('members_inactive_link'));?></td>
			<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
		</tr>
	<?php endforeach;?>
</table>
</div>

<p><?php echo anchor('auth/create_user', lang('members_create_user_link'))?></p>

