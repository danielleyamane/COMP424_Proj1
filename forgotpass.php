<?php
require_once __DIR__ . '/recaptcha/src/autoload.php';
$siteKey = '6LcfFQ0UAAAAAE3D0vV5C2T4m1VusBDwENBJbATY';
?>
<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<title>Forgot My Password</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		  <script src='https://www.google.com/recaptcha/api.js'></script>

	</head>

	<body>
		<div class="container">
			<h1>Forgot your info?</h1>
			<form class="form-horizontal" method="POST" action="securityQuestions.php">
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="email">Email:</label>
			    <div class="col-sm-10">
			      <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
			    </div>
			  </div>
			  <!--recapchat-->
			  <div class="col-sm-offset-2 col-sm-10">
			  <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-default">Submit</button>
			    </div>
			  </div>
			</form>
		</div>

	</body>
</html>
