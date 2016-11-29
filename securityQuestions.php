<?php
	require_once __DIR__ . '/recaptcha/src/autoload.php';
	$siteKey = '6LcfFQ0UAAAAAE3D0vV5C2T4m1VusBDwENBJbATY';
	$secret = '6LcfFQ0UAAAAAIui17AvFWh6nEQr1bMt4gXj0rSA';
	function test_input($data){
		$data=trim($data);
		$data=stripslashes($data);
		$data=strip_tags($data);
		$data=htmlspecialchars($data);
		return $data;
	}	
	//	echo 'first echo email :' . $_POST["email"];
	//$email = $answer1 = $answer2 = "";
	//$emailErr = $answer1Err = $answer2Err ="";
	$recaptcha = new \ReCaptcha\ReCaptcha($secret);
	$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
	if ($resp->isSuccess()) {
	    //here i will ask the security questions'
	  	//echo 'captcha test success';
	  	if($_SERVER["REQUEST_METHOD"]=="POST"){
	  		//echo 'inside if';
			if(empty($_POST["email"])){
				//echo 'inside if if';
				$emailErr="Email is required.";
			} else {
				//echo 'inside if else';
				$email=test_input($_POST["email"]);

				//Connect to database, localhost; if not, die process *RECYCLING DANIELLE's CODE*
				if(!($database=mysqli_connect("localhost", "root", "COMP424", "COMP424"))){
					echo "Error: Unable to connect to MySQL." . PHP_EOL;
					echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
					echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
					die ("Could not connect to database </body></html>");
				}
				//Attain the matching email address that was inputted by the user (if any)
				//echo 'after sql con email: ' .$email;
		    	$result=mysqli_query($database, "SELECT email, firstQ, firstA, secondQ, secondA FROM user WHERE email = '" . $email . "'");
		    	$row = mysqli_fetch_row($result);
		    	if($row[0] == $email)
		    	{
		    		session_start();
		    		$_SESSION['array'] = $row;
		    		header("Location: resetPasswordChallenge.php");
		    		exit;

		    	}else{
		    		//alert no matching email
		    		//exit??
		    	}
		    	//echo $row; 
			  		/*
<?php
			if($_SERVER["REQUEST_METHOD"]=="POST"){
				if(empty($_POST["answer1"]) || empty($_POST["answer2"])){
					$answerErr = "Answers to the security question is required.";
				}
				else{
					$result = mysqli_query($databse, "SELECT firstQ, firstA, secondQ, secondA FROM user WHERE email = '" . $email . "'");
					$row = mysqli_fetch_row($result);
					echo "grab test to sql finished";
				}

			}
		?>

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
						*/

						//Variables for storing retrieved database question values
						//$securityQ1 = $securityQ2 = "";


						//if((mysqli_query($database, "SELECT email FROM user WHERE email = ' "  . $email . " ' ")) != $email)


			
			}
		}
			
			exit;
	  } else {
	      $errors = $resp->getErrorCodes();
	  }

?>
