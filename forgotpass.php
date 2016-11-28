<?php
require_once __DIR__ . '/recaptcha/src/autoload.php';
$siteKey = '6LcfFQ0UAAAAAE3D0vV5C2T4m1VusBDwENBJbATY';
$secret = '6LcfFQ0UAAAAAIui17AvFWh6nEQr1bMt4gXj0rSA';
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
	  <?php
	  $recaptcha = new \ReCaptcha\ReCaptcha($secret);
	  $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
	  if ($resp->isSuccess()) {
	      //here i will ask the security questions'
	  	echo 'test success';
	  	readfile("resetPasswordChallenge.php");
		//Variables
		$email = $_POST["email"]; 
		$answer1 = $answer2 = "";
/*
			if($_SERVER["REQUEST_METHOD"]=="POST"){
				if(empty($_POST["email"])){
					$emailErr="Email is required.";
				} else {
					$email=test_input($_POST["email"]);
				}
				if(empty($_POST["answer1"])){
					$answerErr1="We need your answer to verify that you are the legitimate owner.";
				} else {
					$answer1=test_input($_POST["answer1"]);
				}
				if(empty($_POST["answer2"])){
					$answerErr2="We need your answer to verify that you are the legitimate owner.";
				} else {
					$answer2=test_input($_POST["answer2"]);
				}

				//Variables for storing retrieved database question values
				$securityQ1 = $securityQ2 = "";

				//Connect to database, localhost; if not, die process *RECYCLING DANIELLE's CODE*
				if(!($database=mysqli_connect("localhost", "root", "comp424", "COMP424"))){
					echo "Error: Unable to connect to MySQL." . PHP_EOL;
					echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
					echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
					die ("Could not connect to database </body></html>");
				}

				//if((mysqli_query($database, "SELECT email FROM user WHERE email = ' "  . $email . " ' ")) != $email)


			}
*/
			function test_input($data){
				$data=trim($data);
				$data=stripslashes($data);
				$data=strip_tags($data);
				$data=htmlspecialchars($data);
				return $data;
			}	
			
			exit;
	  } else {
	      $errors = $resp->getErrorCodes();
	  }

	  ?>

		<div class="container">
			<h1>Forgot your info?</h1>
			<form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="email">Email:</label>
			    <div class="col-sm-10">
			      <input type="email" class="form-control" id="email" placeholder="Enter email">
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
