<?php echo form_open( '/search/save_widget_options/' ); ?>

	<div class="form-group">
        <label for="exampleInputEmail1" class="m-0">Title</label>
		  <?php $data = array(
							  'name'        => 'title',
							  'id'          => 'title',
							  'maxlength'   => '100',
							  'class'		=> 'form-control'
							);

				echo form_input($data); ?>
	</div>
	<div class="checkbox checkbox-primary m-l-10">
		
		  <?php $data = array(
					'name'        => 'suggest',
					'id'          => 'suggest_box',
					'value'       => 'accept',
					'checked'     => TRUE,
					'style'       => 'margin:10px',
					'class'		  => 'm-0 p-absolute'
					);

				echo form_checkbox($data); ?>
		<label class="text-capitalize" for="suggest_box">Suggest Box</label>	
	</div>	
<?php echo form_close(); ?>