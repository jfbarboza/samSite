<div class="wrap">
	<div class="icon32" id="icon-options-general"><br></div>
	<h2><?php _e('ThemeMakers DB Migrate', 'tmm_db_migrate'); ?></h2>
        <ul>
		
		<li>
                                                      
				<?php if ($this->import->is_zip_file_exists()): ?>
					<h3 style="color: green;"><?php _e('Data is ready for import', 'tmm_db_migrate'); ?></h3>
					<a href="#" class="button button-primary button-large" id="button_prepare_import_data"><?php _e('Demo Data Install', 'tmm_db_migrate'); ?></a>
				<?php else: ?>
					<h3 style="color: red;"><?php _e('Something wrong, folder "wp-content/uploads/tmm_db_migrate" is not uploaded. Set please permissions for "wp-content/uploads/tmm_db_migrate" folder 0777!', 'tmm_db_migrate'); ?></h3>
				<?php endif; ?>		

		</li>
                <li>
			<a href="#" class="button button-primary button-large" id="button_prepare_export_data"><?php _e('Export Data', 'tmm_db_migrate'); ?></a>
		</li>
	</ul>
	<ul id="tmm_db_migrate_process"></ul>

</div>



