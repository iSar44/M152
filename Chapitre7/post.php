<?php
session_start();
require_once("db_connection.php");

$edit = filter_input(INPUT_GET, 'edit', FILTER_SANITIZE_NUMBER_INT);

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Post</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
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


					<!-- content -->
					<div class="row">

						<!-- main col right -->
						<div class="col-sm-7" style="visibility:hidden;">

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4><?= $edit == null ? "Write something here" : "Update your post" ?></h4>
								</div>
							</div>

							<div id="msg"></div>

						</div>

						<!-- main col left -->
						<div class="col-sm-5">

							<div class="well">
								<h4><?= $edit == null ? "What's New" : "Update this post" ?></h4>

								<!-- <form action="#" method="POST" enctype="multipart/form-data"> -->
									<div class='preview'>
										<img src="" id="img" width="100" height="100">
									</div>

									<div class="form-group" style="padding:14px;">
										<textarea class="form-control" name="postEcrit" placeholder="<?= $edit == null ? "Write something here" : "Update your post" ?>"></textarea>
									</div>

									<input type="submit" id="btn_upload" name="submit" value="<?= $edit == null ? "Post" : "Update" ?>" class="btn btn-primary pull-right" />
									<ul class="list-inline">
										<input type="file" id="file" name="image[]" class="form-control-file" id="img" accept=".jpg,.jpeg,.png,.gif,.bmp,.mp3,.mp4" multiple />
									</ul>
									<input type="text" name="replaceMedia" value="<?= $edit == null ? "" : $edit ?>" />
								<!-- </form> -->

							</div>

						</div>
					</div>

					<div class="padding">
						<div class="full col-sm-9">

							<!-- content -->
							<div class="row">

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

		<script type="text/javascript" src="assets/js/jquery.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
		<script type="text/javascript">
			// $(document).ready(function(e) {
			// 	$('#btn_upload').on('click', function() {
			// 		var form_data = new FormData();
			// 		var ins = document.getElementById('file').files.length;
			// 		for (var x = 0; x < ins; x++) {
			// 			form_data.append("image[]", document.getElementById('file').files[x]);
			// 		}
			// 		$.ajax({
			// 			url: 'post.php', // point to server-side PHP script 
			// 			// dataType: 'text', // what to expect back from the PHP script
			// 			cache: false,
			// 			contentType: false,
			// 			processData: false,
			// 			data: form_data,
			// 			type: 'post',
			// 			success: function(response) {
			// 				$('#msg').html(response); // display success response from the PHP script
			// 			},
			// 			error: function(response) {
			// 				$('#msg').html(response); // display error response from the PHP script
			// 			}
			// 		});
			// 	});
			// });
			

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