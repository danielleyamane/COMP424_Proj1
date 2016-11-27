<!DOCTYPE HTML>
<html lang="en-US">

	<head>
		<title>Forgot My Password</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>

	<body>

		<?php
		//Variables
		$email = $answer1 = $answer2 = "";
		$emailErr = $answerErr1 = $answerErr2 = "";

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
				$securityQ1 = securityQ2 = "";

				//Connect to database, localhost; if not, die process *RECYCLING DANIELLE's CODE*
				if(!($database=mysqli_connect("localhost", "root", "COMP424", "COMP424"))){
					echo "Error: Unable to connect to MySQL." . PHP_EOL;
					echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
					echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
					die ("Could not connect to database </body></html>");
				}

				if((mysqli_query($database, "SELECT email FROM user WHERE email = ' "  . $email . " ' ")) != $email)


			}

			function test_input($data){
				$data=trim($data);
				$data=stripslashes($data);
				$data=strip_tags($data);
				$data=htmlspecialchars($data);
				return $data;
			}	
		?>
		<div class="container">
			<h1>Forgot your password?</h1>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF]);">">

		</div>		
	</body>
