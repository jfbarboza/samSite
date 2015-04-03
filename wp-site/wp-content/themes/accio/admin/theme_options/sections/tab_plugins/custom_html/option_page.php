<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div>
    <?php if (TMM_ImpExp_DB::is_zip_file_exists()): ?>
        
    <?php  if ((wp_count_posts()->publish > 3)  && (wp_count_posts('page')->publish > 3)){
    ?>
        <h3 style="color: red;"><?php _e('Attention! You already have some content!', 'tmm_db_migrate'); ?><h3>
        <h3 style="color: red;"> <?php _e('It will be rewritten if you press "Demo Data Install"', 'tmm_db_migrate'); ?></h3>
    <?php
    } 
    else{       
    ?>
        <h3 style="color: green;"><?php _e('Data is ready for import', 'tmm_db_migrate'); ?></h3>
    <?php
    }
    ?>       
        <a href="#" class="button button-primary button-large" id="button_prepare_import_data"><?php _e('Demo Data Install', 'tmm_db_migrate'); ?></a>
    <?php else: ?>
        <h3 style="color: red;"><?php _e('Something wrong, folder "wp-content/uploads/tmm_db_migrate" is not uploaded. Please set permissions for "wp-content/uploads/tmm_db_migrate" folder 0777!', 'tmm_db_migrate'); ?></h3>
    <?php endif; ?>		
        <ul id="tmm_db_migrate_process_imp"></ul>
</div>
    
    <?php 
    if (!class_exists('ZipArchive')) {
    ?>
        <h3 style="color: red;"> <?php _e('Your server is not able to export zip files (PHP Class "ZipArchive" not found)', 'tmm_db_migrate'); ?></h3>
    <?php
}
?>

    <a href="#" class="button button-primary button-large" id="button_prepare_export_data"><?php _e('Export Data', 'tmm_db_migrate'); ?></a>	

<ul id="tmm_db_migrate_process"></ul>