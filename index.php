<?php
	include('class_zip.php');

	$files_zip = Zip_Manager::App('tester21.zip');
	var_dump($files_zip->create_archive('img',array('1.jpg','2.jpg')));

?>