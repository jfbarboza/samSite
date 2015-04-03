<?php

class TMM_ImpExp_DB {

	const folder_key = 'tmm_db_migrate';

	const DIRSEP = '/';

	public function get_upload_dir() {
		$path = wp_upload_dir();
		$basedir = str_replace('\\', self::DIRSEP, $path['basedir']);
		return $basedir . self::DIRSEP . self::folder_key . self::DIRSEP;
	}

	public static function get_zip_file_path() {
		$path = wp_upload_dir();
		$basedir = str_replace('\\', self::DIRSEP, $path['basedir']);
		return $basedir . self::DIRSEP . self::folder_key . self::DIRSEP;
	}
        protected function get_zip_file_path_exp() {
		$path = wp_upload_dir();
		$basedir = str_replace('\\', self::DIRSEP, $path['basedir']);
		return $basedir . self::DIRSEP . self::folder_key . self::DIRSEP . self::folder_key . '.zip';
	}

	public static function is_zip_file_exists() {
		return file_exists(self::get_zip_file_path());
	}

	protected function get_zip_dir_link() {
		$path = wp_upload_dir();
		$baseurl = str_replace('\\', self::DIRSEP, $path['baseurl']);
		return $baseurl . self::DIRSEP . self::folder_key . self::DIRSEP . self::folder_key . '.zip';
	}

	protected function get_wp_tables() {
		global $wpdb;
		$tmp_tables = $wpdb->get_results('SHOW TABLES', ARRAY_N);
		$tables = array();
		if (!empty($tmp_tables) AND is_array($tmp_tables)) {
			foreach ($tmp_tables as $t) {
				$tables[] = $t[0];
			}
		}

		return $tables;
	}

	protected function create_upload_folder() {
		$path = wp_upload_dir();
		$path = $path['basedir'];

		if (!file_exists($path)) {
			mkdir($path, 0777);
		}

		$path = $path . self::DIRSEP . self::folder_key . self::DIRSEP;
		if (!file_exists($path)) {
			$this->delete_dir($path); //remove previous results
			mkdir($path, 0777);
		}

		return $path;
	}

	protected function extract_zip() {
		$zip = new ZipArchive();
		$zip->open($this->get_zip_file_path());
		$zip->extractTo($this->get_upload_dir());
		$zip->close();
		return true;
	}

	protected function delete_dir($path) {
		try {
			if (is_dir($path)) {
				$it = new RecursiveDirectoryIterator($path);
				$files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
				foreach ($files as $file) {
					if ($file->isDir()) {
						@rmdir($file->getRealPath());
					} else {
						try {
							@unlink($file->getRealPath());
						} catch (Exception $e) {
							echo $e->getCode();
						}
					}
				}
				try {
					@rmdir($path);
				} catch (Exception $e) {
					echo $e->getCode();
				}
			}
		} catch (Exception $e) {
			echo $e->getCode();
		}
	}

}