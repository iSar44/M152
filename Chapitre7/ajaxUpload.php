<?php
session_start();
require_once("db_connection.php");

$files_arr = array();

if (isset($_FILES['files']) && !empty($_FILES['files'])) {


	foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {

		$target_dir = "uploads/";

		$fileName = $_FILES["files"]["name"][$key];
		$extensionFile = $_FILES["files"]["type"][$key];

		if ($extensionFile == "video/mp4") {
			$typeMedia = "video";
		} else if ($extensionFile == "audio/mp3") {
			$typeMedia = "audio";
		} else {
			$typeMedia = "image";
		}


		if (!file_exists($target_dir . $fileName)) {
			
			move_uploaded_file($_FILES["files"]["tmp_name"][$key], $target_dir . $fileName);
			$conn->beginTransaction();
            $insertImage->execute(array($typeMedia, $fileName, date('Y-m-d H:i:s')));
			$conn->commit();
            $finalPath = $target_dir . $fileName;
			array_push($files_arr, $finalPath);
			// echo json_encode($files_arr);
			//echo "File doesn't exist -> upload successful" . "</br>";
		} else {
			
			$addUniqueid = uniqid();

			move_uploaded_file($_FILES["files"]["tmp_name"][$key], $target_dir . $addUniqueid . $fileName);
			$conn->beginTransaction();
            $insertImage->execute(array($typeMedia, $addUniqueid . $fileName, date('Y-m-d H:i:s')));
			$conn->commit();
            $finalPath = $target_dir . $addUniqueid . $fileName;
			array_push($files_arr, $finalPath);
			// echo json_encode($files_arr);
			//echo "File already exists -> upload successful";
		}
	}

	echo json_encode($files_arr);

} else {
	echo 'Please choose at least one file';
}
?>