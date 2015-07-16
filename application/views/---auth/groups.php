<h1 class="page-header"><?php echo lang('groups_heading');?></h1>
<p><?php echo lang('groups_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<div class="table-responsive">
	<table class="table table-hover table-striped">
		<tr>
			<th><?php echo lang('groups_id_th');?></th>
			<th><?php echo lang('groups_name_th');?></th>
		</tr>
		<?php foreach ($groups as $group):?>
			<tr>
				<td><?php echo htmlspecialchars($group['id'],ENT_QUOTES,'UTF-8');?></td>
				<td><?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?></td>
			</tr>
		<?php endforeach;?>
	</table>
</div>

<p><?php echo anchor('auth/create_group', lang('groups_create_group_link'))?></p>