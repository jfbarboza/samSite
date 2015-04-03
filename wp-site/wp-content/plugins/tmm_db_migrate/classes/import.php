<?php

class TMM_ImpExp_Import extends TMM_ImpExp_DB {

	public function __construct() {
		if (isset($_FILES['tmm_db_import'])) {
			$response_state = 'no_zip';
			if ($_FILES['tmm_db_import']['type'] === 'application/zip') {
				$targetFolder = $this->create_upload_folder();
				move_uploaded_file($_FILES['tmm_db_import']['tmp_name'], $targetFolder . $this->folder_key . '.zip');
				//***
				$this->extract_zip();
				if ($this->is_zip_file_exists()) {
					$response_state = 'ready';
				}
			}
			wp_redirect(admin_url('tools.php?page=tmm_db_migrate&response_state=' . $response_state), 302);
		}
		
	}

	//ajax
	public function import_data() {
		$counter = 0;
		chdir($this->get_upload_dir());

		foreach (glob("*.dat") as $filename) {
			$table = basename($filename, '.dat');
			try {
				$this->process_table($table);
			} catch (Exception $e) {
				
			}

			$counter++;
		}

		wp_die($counter);
	}

	//ajax
	public function process_table($table) {
		global $wpdb;
		$table_dsc = unserialize(file_get_contents($this->get_upload_dir() . $table . '.dsc'));
		$old_wpdb_prefix = file_get_contents($this->get_upload_dir() . 'wpdb.prfx');
		$new_table_name = preg_replace('[^' . $old_wpdb_prefix . ']', $wpdb->prefix, $table);
		//***
		$wpdb->query('DROP TABLE IF EXISTS `' . $new_table_name . '`;');
		//TABLE CREATING
		$table_sql = "CREATE TABLE `" . $new_table_name . "` (";
		if (!empty($table_dsc)) {
			$PRIMARY_KEY = "";
			$UNIQUE_KEY = "";
			$KEY = array();
			foreach ($table_dsc as $col) {
				$table_sql.="`" . $col->Field . "` " . $col->Type;

				if ($col->Null == 'NO') {
					$table_sql.=" NOT NULL";
				}

				if (!empty($col->Default)) {
					$table_sql.=" DEFAULT '" . $col->Default . "'";
				}

				if ($col->Extra == 'auto_increment') {
					$table_sql.=" AUTO_INCREMENT";
				}

				if ($col->Key == 'PRI') {
					$set_pk = true;
					if (($col->Field == 'term_taxonomy_id' OR $col->Field == 'object_id') AND $new_table_name == ($wpdb->prefix . 'term_relationships')) {
						//prevent little bug in db
						$set_pk = false;
					}

					if ($set_pk) {
						$PRIMARY_KEY = $col->Field;
					}
				}

				if ($col->Key == 'UNI') {
					$UNIQUE_KEY = $col->Field;
				}

				if ($col->Key == 'MUL') {
					$KEY[] = $col->Field;
				}

				$table_sql.=',';
			}
			//***
			if (!empty($PRIMARY_KEY)) {
				$table_sql.="PRIMARY KEY (`" . $PRIMARY_KEY . "`),";
			}
			//***
			if (!empty($UNIQUE_KEY)) {
				if ($table == $old_wpdb_prefix . 'term_taxonomy') {
					$table_sql.="`term_id_taxonomy` (`term_id`,`taxonomy`)";
				} else {
					$table_sql.="UNIQUE KEY `" . $UNIQUE_KEY . "` (`$UNIQUE_KEY`),";
				}
			}
			//***
			if (!empty($KEY)) {
				foreach ($KEY as $k) {
					$table_sql.="KEY `" . $k . "` (`" . $k . "`),";
				}
			}
		}
		$table_sql.=");";
		$table_sql = str_replace(",);", ");", $table_sql);
		$wpdb->query($table_sql);

		//*** DATA INSERTING
		$content = str_replace('__tmm_old_home_url__', home_url(), file_get_contents($this->get_upload_dir() . $table . '.dat'));
		$content = str_replace('__tmm_wpdb_prefix__', $wpdb->prefix, $content);


		eval('$table_data=' . $content . ';');
		//stdClass::__set_state - must be delete in files

		if (!empty($table_data) AND is_array($table_data)) {
			foreach ($table_data as $row) {
				$data_string = "";
				if (!empty($row)) {
					$is_first_iter = true;
					$data = array();
					foreach ($row as $key => $value) {
						if (is_array($value) OR is_object($value)) {
							$data[$key] = serialize($value);
						} else {
							$data[$key] = $value;
						}
					}
				}
				$wpdb->insert($new_table_name, $data);
			}
		}



		return true;
	}

	//CARDEALER FUNCTIONS 1
        /*
	public function cardealer_unzip_import_location() {
		if ($_FILES['tmm_db_import_cardealer']['type'] === 'application/zip') {
			$targetFolder = $this->create_upload_folder();
			move_uploaded_file($_FILES['tmm_db_import_cardealer']['tmp_name'], $targetFolder . $this->folder_key . '.zip');
			//***
			$this->extract_zip();
			if ($this->is_zip_file_exists()) {
				$country_term_id = 0;
				if ($_REQUEST['tmm_db_import_cardealer_mode'] == '3x') {
					$country_name = trim(file_get_contents($this->get_upload_dir() . 'country_name.dat'));
					$args = array(
						'name' => $country_name,
						'parent' => 0
					);
					$country_term = wp_insert_term($country_name, 'carlocation', $args);
					$country_term_id = $country_term['term_id'];
				}
				//***
				wp_redirect(admin_url('tools.php?page=tmm_db_migrate&cardealer_import_location=1&country_term_id=' . $country_term_id), 302);
				//wp_redirect(admin_url('edit-tags.php?taxonomy=carlocation&post_type=' . TMM_Ext_PostType_Car::$slug . '&cardealer_import_location=1&country_term_id=' . $country_term_id), 302);
			}
		}
		exit;
	}
        */
	//ajax - upload cardealer locations 2
        /*
	public function cardealer_get_import_location_files() {
		$result = array();
		foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->get_upload_dir())) as $file) {
			if (pathinfo($file->getFilename(), PATHINFO_EXTENSION) == 'dat') {
				if ($file->getBasename() != 'country_name') {
					if (!substr_count($file->getPathname(), 'country_name.dat')) {
						$result[] = $file->getPathname();
					}
				}
			}
		}

		wp_die(json_encode($result));
	}
        */
	//ajax - upload cardealer locations 3
        /*
	public function cardealer_import_location_file() {

		$state = file_get_contents($_REQUEST['file_path']);
		$state = json_decode($state, true);
		//***
		$args = array(
			'name' => $state['state_name'],
			'parent' => $_REQUEST['country_term_id']
		);
		$state_term = wp_insert_term($state['state_name'], 'carlocation', $args);

		if (!is_a($state_term, 'WP_Error')) {
			$res = array();
			$res['parent_id'] = $state_term['term_id'];
			wp_die(json_encode($res));
		} else {
			$res['parent_id'] = -1;
			wp_die(json_encode($res));
		}
	}
        */
	//ajax - upload cardealer locations 4
        /*
	public function cardealer_import_location_city() {
		set_time_limit(60);
		$one_operation_iterations = 500; //how many terms will be added for one ajax request
		$state = file_get_contents($_REQUEST['file_path']);
		$state = json_decode($state, true);
		for ($i = $_REQUEST['city_index']; $i < $_REQUEST['city_index'] + $one_operation_iterations; $i++) {
			if (isset($state['cities'][$i]['city_name'])) {
				$args = array(
					'name' => $state['cities'][$i]['city_name'],
					'parent' => $_REQUEST['city_parent_id']
				);
				wp_insert_term($state['cities'][$i]['city_name'], 'carlocation', $args);
			} else {
				unset($state);
				echo json_encode(array('city_index' => -1, 'percent' => 100));
				exit;
			}
		}
		echo json_encode(array('city_index' => ($_REQUEST['city_index'] + $one_operation_iterations), 'percent' => round(($_REQUEST['city_index'] + $one_operation_iterations) * 100 / count($state['cities']), 2)));
		exit;
	}*/

}
