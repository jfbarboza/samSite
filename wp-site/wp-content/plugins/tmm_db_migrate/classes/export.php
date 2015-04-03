<?php

class TMM_ImpExp_Export extends TMM_ImpExp_DB {

	public function __construct() {
		//$this->create_upload_folder();
	}

	//ajax
	public function prepare_export_data() {
		$this->create_upload_folder();
		wp_die(json_encode($this->get_wp_tables()));
	}

	//ajax
	public function process_table() {
		global $wpdb;
		$table = $_REQUEST['table'];
		$result = array();
		$query_res = $wpdb->get_results("SELECT * FROM " . $table, ARRAY_A);
		if (!empty($query_res)) {
			foreach ($query_res as $row) {
				if (is_array($row)) {
					foreach ($row as $field_key => $value) {
						if (is_serialized($value)) {
							$row[$field_key] = unserialize($value);
						}
					}
				}
				//***for wp_options
				if ($table == $wpdb->options) {
					$continue_array = array('_site_transient_update_core', '_site_transient_update_plugins', '_site_transient_update_themes');
					if (in_array($row['option_name'], $continue_array)) {
						continue;
					}
				}
				//***
				$result[] = $row;
			}
		}
		//***
		$content = $this->prepare_export_content(var_export($result, true));

		file_put_contents($this->get_upload_dir() . $table . '.dat', $content);
		file_put_contents($this->get_upload_dir() . $table . '.dsc', serialize($wpdb->get_results("DESCRIBE " . $table)));


		wp_die(count($result));
	}

	private function prepare_export_content($content) {
            
                $content = str_replace('\\/', '/', $content);
		$content = str_replace(home_url(), '__tmm_old_home_url__', $content);
		//***
		global $wpdb;
		$tpl_prefix = '__tmm_wpdb_prefix__';
		$content = str_replace($wpdb->prefix, $tpl_prefix, $content);
		$revert_prefix_array_repl = array(
			'wp_inactive_widgets',
			'wp_maybe_auto_update',
			'wp_version_check',
			'wp_update_plugins',
			'wp_update_themes',
			'wp_scheduled_delete',
			'wp_scheduled_auto_draft_delete',
			'wp_list_categories',
			'wp_enqueue_style',
			'wp_enqueue_script',
			'_wp_page_template',
			'dismissed_wp_pointers'
		);
		$revert_prefix_array = array(
			$tpl_prefix . 'inactive_widgets',
			$tpl_prefix . 'maybe_auto_update',
			$tpl_prefix . 'version_check',
			$tpl_prefix . 'update_plugins',
			$tpl_prefix . 'update_themes',
			$tpl_prefix . 'scheduled_delete',
			$tpl_prefix . 'scheduled_auto_draft_delete',
			$tpl_prefix . 'list_categories',
			$tpl_prefix . 'enqueue_style',
			$tpl_prefix . 'enqueue_script',
			'_' . $tpl_prefix . 'page_template',
			'dismissed_' . $tpl_prefix . 'pointers'
		);
		//***
		$content = str_replace($revert_prefix_array, $revert_prefix_array_repl, $content);
		return $content;
	}

	//ajax
	public function zip_export_data() {
		$path = $this->get_upload_dir();
		$tables = $this->get_wp_tables();

		$zip = new ZipArchive();
		if (!empty($tables)) {
			$zip->open($this->get_zip_file_path_exp(), ZipArchive::OVERWRITE);
			foreach ($tables as $table) {
				$file = $table . '.dat';
				$zip->addFile($path . self::DIRSEP . $file, $file);
				$file = $table . '.dsc';
				$zip->addFile($path . self::DIRSEP . $file, $file);
			}
		}
		//create and zip file with wpdb prefix
		global $wpdb;
		file_put_contents($path . 'wpdb.prfx', $wpdb->prefix);
		$zip->addFile($path . self::DIRSEP . 'wpdb.prfx', 'wpdb.prfx');
		//***
		$zip->close();
		wp_die($this->get_zip_dir_link());
	}

}
