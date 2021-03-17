<?php
session_start();
require_once("db_connection.php");

$editReplace = filter_input(INPUT_POST, 'replaceMedia', FILTER_SANITIZE_NUMBER_INT);

// ////////////////////////////////////////////
// /////	Upload et sauvegarde des images 
// $submit = filter_input(INPUT_POST, 'submit');
// $extensionsAllowed = array("jpg", "png", "bmp", "gif", "mp3", "mp4");

#region Deprecated Code
// // if ($submit) {

// // 	foreach ($_FILES["image"]["tmp_name"] as $key => $tmp_name) {

// // 		$target_dir = "uploads/";

// // 		$fileName = $_FILES["image"]["name"][$key];
// // 		$fileTempName = $_FILES["image"]["tmp_name"][$key];

// // 		$extensionFile = $_FILES["image"]["type"][$key];
// // 		//$extensionFile = pathinfo($fileName, PATHINFO_EXTENSION);

// // 		if (in_array(substr($extensionFile, -3), $extensionsAllowed)) {

// // 			if ($extensionFile == "video/mp4") {
// // 				$typeMedia = "video";
// // 			} else if ($extensionFile == "audio/mp3") {
// // 				$typeMedia = "audio";
// // 			} else {
// // 				$typeMedia = "image";
// // 			}

// // 			if (!file_exists($target_dir . $fileName)) {

// // 				move_uploaded_file($_FILES["image"]["tmp_name"][$key], $target_dir . $fileName);
// // 				$conn->beginTransaction();
// // 				if($editReplace == null){
// // 					$insertImage->execute(array($typeMedia, $fileName, date('Y-m-d H:i:s')));
// // 				}else{
// // 					$modifMedia->execute(array($typeMedia, $addUniqueid . $fileName, date('Y-m-d H:i:s'), $editReplace));
// // 					header('Location: index.php');
// // 				}
// // 				$conn->commit();
// // 				header("Location: index.php");
// // 			} else {

// // 				$addUniqueid = uniqid();

// // 				move_uploaded_file($_FILES["image"]["tmp_name"][$key], $target_dir . $addUniqueid . $fileName);
// // 				$conn->beginTransaction();
// // 				if ($editReplace == null) {
// // 					$insertImage->execute(array($typeMedia, $addUniqueid . $fileName, date('Y-m-d H:i:s')));
// // 				} else {
// // 					$modifMedia->execute(array($typeMedia, $addUniqueid . $fileName, date('Y-m-d H:i:s'), $editReplace));
// // 					header('Location: index.php');
// // 				}
// // 				$conn->commit();
// // 				header("Location: index.php");
// // 			}
// // 		} else {
// // 			echo "Sorry, only JPG, JPEG, BMP, PNG & GIF files are allowed.";
// // 		}
// // 	}
// // }

// if (isset($_FILES['files']) && !empty($_FILES['files'])) {


// 	foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {

// 		$target_dir = "uploads/";

// 		$fileName = $_FILES["files"]["name"][$key];
// 		$extensionFile = $_FILES["files"]["type"][$key];

// 		if ($extensionFile == "video/mp4") {
// 			$typeMedia = "video";
// 		} else if ($extensionFile == "audio/mp3") {
// 			$typeMedia = "audio";
// 		} else {
// 			$typeMedia = "image";
// 		}


// 		if (!file_exists($target_dir . $fileName)) {

// 			move_uploaded_file($_FILES["files"]["tmp_name"][$key], $target_dir . $fileName);
// 			$conn->beginTransaction();
// 			if ($editReplace == null) {
// 				$insertImage->execute(array($typeMedia, $fileName, date('Y-m-d H:i:s')));
// 			} else {
// 				$modifMedia->execute(array($typeMedia, $addUniqueid . $fileName, date('Y-m-d H:i:s'), $editReplace));
// 				header('Location: index.php');
// 			}
// 			$conn->commit();
// 			echo "File doesn't exist -> upload successful";
// 			// header("Location: index.php");

// 			// echo 'File already exists : uploads/' . $_FILES["files"]["name"][$i];
// 		} else {

// 			$addUniqueid = uniqid();

// 			move_uploaded_file($_FILES["files"]["tmp_name"][$key], $target_dir . $addUniqueid . $fileName);
// 			$conn->beginTransaction();
// 			if ($editReplace == null) {
// 				$insertImage->execute(array($typeMedia, $addUniqueid . $fileName, date('Y-m-d H:i:s')));
// 			} else {
// 				$modifMedia->execute(array($typeMedia, $addUniqueid . $fileName, date('Y-m-d H:i:s'), $editReplace));
// 				header('Location: index.php');
// 			}
// 			$conn->commit();
// 			echo "File already exists -> upload successful";
// 			// header("Location: index.php");
// 			// move_uploaded_file($_FILES["files"]["tmp_name"][$i], 'uploads/' . $_FILES["files"]["name"][$i]);
// 			// echo 'File successfully uploaded : uploads/' . $_FILES["files"]["name"][$i] . ' ';
// 		}
// 	}

// } else {
// 	echo 'Please choose at least one file';
// }
#endregion

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).ready(function(e) {
			$('#upload').on('click', function() {

				var form_data = new FormData();
				var countFiles = document.getElementById('multiFiles').files.length;
				
				for (var index = 0; index < countFiles; index++) {
					form_data.append("files[]", document.getElementById('multiFiles').files[index]);
				}
				$.ajax({
					url: 'ajaxUpload.php',
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,
					type: 'post',
					success: function(response) {
						for (var index = 0; index < response.length; index++) {
							var src = response[index];

							$('#preview').append('<img src="' + src + '" width="400px;" height="400px">');
						}
					},
				});
			});
		});
	</script>
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
	<link href="assets/css/facebook.css" rel="stylesheet">
</head>

<body>

	<div class="wrapper">
		<div class="box">
			<div class="row row-offcanvas row-offcanvas-left">

				<!-- main right col -->
				<div class="column col-sm-10 col-xs-11" id="main">

					<!-- top nav -->
					<div class="navbar navbar-blue navbar-static-top">
						<div class="navbar-header">
							<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a href="http://usebootstrap.com/theme/facebook" class="navbar-brand logo">b</a>
						</div>
						<nav class="collapse navbar-collapse" role="navigation">
							<form class="navbar-form navbar-left">
								<div class="input-group input-group-sm" style="max-width:360px;">
									<input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
									<div class="input-group-btn">
										<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
									</div>
								</div>
							</form>
							<ul class="nav navbar-nav">
								<li>
									<a href="index.php"><i class="glyphicon glyphicon-home"></i> Home</a>
								</li>
								<li>
									<a href="post.php" role="button"><i class="glyphicon glyphicon-plus"></i> Post</a>
								</li>
								<li>
									<a href="#"><span class="badge">badge</span></a>
								</li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i></a>
									<ul class="dropdown-menu">
										<li><a href="">More</a></li>
										<li><a href="">More</a></li>
										<li><a href="">More</a></li>
										<li><a href="">More</a></li>
										<li><a href="">More</a></li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
					<!-- /top nav -->

					<div class="padding">
						<div class="full col-sm-9">

							<!-- content -->
							<div class="row">

								<!-- main col left -->

								<?php
								// include 'affichage.php';
								?>

								<div id="preview"></div>
								<?php
								#region Deprecated Code
								// require_once("db_connection.php");


								// $del = filter_input(INPUT_GET, 'del');

								// $target_dir = "uploads/";

								// while ($affichage = $imageChap5->fetch()) {

								// 	if (file_exists($target_dir . $affichage['nomMedia'])) {
								// 		echo '<div class="col-sm-5">';
								// 		echo '<div class="panel panel-default">';

								// 		if ($affichage['typeMedia'] == "video") {
								// 			echo "<div class='panel-thumbnail'><video width='100%' controls autoplay muted loop><source src='uploads/" . $affichage['nomMedia'] . "'></video></div>";
								// 		} else if ($affichage['typeMedia'] == "audio") {
								// 			echo "<div class='panel-thumbnail'><audio controls><source src='uploads/" . $affichage['nomMedia'] . "'></audio></div>";
								// 		} else {
								// 			echo "<div class='panel-thumbnail'><img src='uploads/" . $affichage['nomMedia'] . "' class='img-responsive'></div>";
								// 		}

								// 		echo '<div class="panel-body">';
								// 		// echo '<p> class="lead">Urbanization</p>';
								// 		echo "<p>Date de création: " . $affichage['creationDate'] . " </p>";

								// 		echo '<p><img src="assets/img/uFp_tsTJboUY7kue5XAsGAs28.png" height="28px" width="28px"></p>';
								// 		echo '</div>';
								// 		echo '<a style="color: red;" href="index.php?del=' . $affichage['idMedia'] . '">Delete</a>';
								// 		echo '<br/>';
								// 		echo '<br/>';
								// 		echo '<a style="color: blue;" href="post.php?edit=' . $affichage['idMedia'] . '">Edit</a>';


								// 		if ($del == $affichage['idMedia']) {
								// 			unlink($target_dir . $affichage['nomMedia']);
								// 			$deleteContent->execute(array($affichage['idMedia']));
								// 			header('Location: index.php');
								// 		}

								// 		// if($edit == $affichage['idMedia']){

								// 		// if($edit == $affichage['idMedia']){
								// 		//     unlink($target_dir . $affichage['nomMedia']);
								// 		//     $modifMedia->execute(array($affichage['idMedia']));
								// 		//     header('Location: index.php');
								// 		// }

								// 		// if (!empty($editReplace)) {
								// 		// 	unlink($target_dir . $affichage['nomMedia']);
								// 		// 	$modifMedia->execute(array($affichage['idMedia']));
								// 		// 	header('Location: index.php');
								// 		// }
								// 		echo '</div>';

								// 		echo '</div>';
								// 	}
								// }
								#endregion
								?>

								<!-- main col right -->
								<div class="col-sm-7">

									<div class="well">
										<p id="msg"></p>
										<input type="file" id="multiFiles" name="files[]" class="form-control-file" accept=".jpg,.jpeg,.png,.gif,.bmp,.mp3,.mp4" multiple />
										<button id="upload">Upload</button>
										<form class="form">
											<h4>Welcome!!!</h4>
											<div class="input-group text-center">

											</div>
										</form>
									</div>

								</div>
							</div>
							<!--/row-->

							<hr>

							<h4 class="text-center">
								<a href="https://edu.ge.ch/site/cfpt/" target="ext">CFPT</a>
							</h4>

							<hr>


						</div><!-- /col-9 -->
					</div><!-- /padding -->
				</div>
				<!-- /main -->

			</div>
		</div>
	</div>


	<!--post modal-->
	<div id="postModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
					Update Status
				</div>
				<div class="modal-body">
					<form class="form center-block">
						<div class="form-group">
							<textarea class="form-control input-lg" autofocus="" placeholder="What do you want to share?"></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<div>
						<button class="btn btn-primary btn-sm" data-dismiss="modal" aria-hidden="true">Post</button>
						<ul class="pull-left list-inline">
							<li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li>
							<li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li>
							<li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('[data-toggle=offcanvas]').click(function() {
				$(this).toggleClass('visible-xs text-center');
				$(this).find('i').toggleClass('glyphicon-chevron-right glyphicon-chevron-left');
				$('.row-offcanvas').toggleClass('active');
				$('#lg-menu').toggleClass('hidden-xs').toggleClass('visible-xs');
				$('#xs-menu').toggleClass('visible-xs').toggleClass('hidden-xs');
				$('#btnShow').toggle();
			});
		});
	</script>
</body>

</html>