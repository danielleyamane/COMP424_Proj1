<!DOCTYPE HTML>  
<html>
<head>
  <title>424 Company</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body>
	<h1>Did you forget your info?</h1>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

	<p><label for="email">Enter your E-mail address:
    	<input type="email" name="email" id="email">  
  	</label></p>
  	<!--recapchat-->
	<div class="g-recaptcha" data-sitekey="6LcfFQ0UAAAAAE3D0vV5C2T4m1VusBDwENBJbATY"></div>
  	<p><input type="submit" value="SUBMIT"></p>
  	</form>
</body>
</html>
