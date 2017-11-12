<?php

	class Zip_Manager{
		public $images;
		public $dir;
		private $zip;
		private $zip_name;
		private static $instanse;

		/* Инициализация класса */
		static function App($zip_name){
			if(self::$instanse == null){
				self::$instanse = new Zip_Manager($zip_name);
			}
			return self::$instanse;
		}

		function __construct($zip_name = null){
			if($zip_name == null){
				$this->zip_name = $this->new_name();
			}else{
				$this->zip_name = $zip_name;
			}
			$this->zip = new ZipArchive($this->zip_name);
		}
		function __destruct(){
			$this->zip->close();
		}

		/* Создать архив с файлами */
		public function create_archive($dir, $files){
			if ($this->zip->open($this->zip_name, ZipArchive::CREATE)!==TRUE) {
			    return false;
			}
			if(count($files) > 0){
				foreach($files as $file){
					$this->zip->addFile($dir.'/'.$file);
					var_dump($file);
				}
				$this->zip->close();
				header('Content-type: application/zip');
				header('Content-Disposition: attachment; filename="'.$this->zip_name.'"');
				readfile($this->zip_name);
			}else{
				return false;
			}
		}

		/* Добавить файл в архив */
		public function add_files($files){
			if($this->open_new_zip()){
				foreach($files as $file){
					$this->zip->addFile($file);
				}
				return true;
			}
			return false;
		}

		/* Удалить файл из архива */
		public function remove_file($file_name){
			$files_in_arr = array();
			if($this->open_new_zip()){
				for($i = 0; $i < $this->zip->numFiles; $i++){
					if($this->zip->statIndex($i)['name'] == $file_name){
						if($this->zip->deleteName($file_name)){
							return true;
						}
					}
				} 
			}
			return false;
		}

		/* Переименовать файл в архиве */
		public function rename_file($old_name, $new_name){
			if($this->open_new_zip()){
				if($old_name != $new_name){
					$this->zip->renameName($old_name, $new_name);
					return true;
				}
			}
			return false;
		}

		/* Проверить наличие файла в архиве */
		public function in_archive($file_name){
			if($this->open_new_zip()){
				for($i = 0; $i < $this->zip->numFiles; $i++){
					if($this->zip->statIndex($i)['name'] == $file_name){
						return true;
					}
				} 
			}
			return false;
		}

		/* Содержимое файла */
		public function read_file($file_name){
			if($this->open_new_zip()){
				if($this->in_archive($file_name)){
					return $this->zip->getFromName($file_name);
				}
				return false;
			}
			return false;
		}

		/* Извлечение файлов */
		public function extruct($dist_dir,$elems = array()){ 
			if($this->open_new_zip()){
				if(count($elems) > 0){
					foreach($elems as $elem){
						$this->zip->extractTo($dist_dir, $elem);
					}
				}else{
					$this->zip->extractTo($dist_dir);
				}
				return true;
			}
			return false;
		}

		/* Содержимое архива */
		public function content_archive(){
			$arr_elems = array();
			if($this->open_new_zip()){
				for($i = 0; $i < $this->zip->numFiles; $i++){
					$arr_elems[] = $this->zip->statIndex($i);
				}
				return $arr_elems;
			}
			return false;
		}

		private function open_new_zip(){
			if($this->zip->open($this->zip_name)){
				return true;
			}
			return false;
		}

	}

?>