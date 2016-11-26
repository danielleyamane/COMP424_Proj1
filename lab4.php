<!DOCTYPE html>
<html>
	<head>
		<title>424 Company</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<h1>Welcome to 424 Company, Please login</h1>
		<br><br>
		<hl>
		
		<?php
			//Creating a variable to determine which webpage is used.
			$pageNum = 0;
			if( isset($_POST["page"]) )
			{
				$pageNum = $_POST["page"];
				settype($pageNum, "integer");
			}
			else
			{
				$pageNum = 1;
			}

			if($pageNum > 3 || $pageNum < 1)
			{
				echo("<strong>Error...this page does not exist!</strong></body></html>");
				die();
			}

			if($pageNum == 1)
			{
		?> 
			<h2>Login</h2>
			<form method="post" 
				action="<?php echo $_SERVER['PHP_SELF']; ?>">
				
				<input type="hidden" name="page" value="2">
				<p><label>Username: 
					<input type="text" name="username">
				</label></p>
				<p><label>Password:
					<input type="password" name="password">
				</label></p>
				<p><input type="submit" value="Login"></p>
			</form>
<!--commented out registration related
			<h2>Register</h2>
			<form method="post" 
				action="<?php echo $_SERVER['PHP_SELF']; ?>">
				
				<input type="hidden" name="page" value="3">
				<p><label for="username">Username: 
					<input type="text" name="username" id="username">
				</label></p>
				<p><label for="password">Password:
					<input type="password" name="password" id="password">
				</label></p>
				<p><label for="fname">First Name: 
					<input type="text" name="firstname" id="fname">
				</label></p>
				<p><label for="lname">Last Name: 
					<input type="text" name="lastname" id="lname">
				</label></p>
				<p><label for = "birthday">Birthday: 
					Year <input type="integer" size="4" maxlength="4" name="YYYY" id="birthdayYear">
					Month <input type="integer" size="2" maxlength="2" name="MM" id="birthdayMonth">
					Day <input type="integer" size="2" maxlength="2" name="DD" id="birthdayDay">
				</label></p>
				<p><label for="email">E-mail:
					<input type="email" name="email" id="email">
				</label></p>
				<p><input type="submit" value="SUBMIT"></p>
			</form>
			-->

		<?php
			} else { // $pageNum == 2
				$username = $pass = "";
				//Check to see if user inputted text  
				if (isset($_POST["username"]) 
					&& $_POST["username"] != ""
					&& isset($_POST["password"])
					&& $_POST["password"] != "")
				{
					$user = $_POST['username']; //Store username
					$pass = $_POST['password']; //Store password
				}
				else
				{
					echo("<p><strong>Error...your info was not received properly...!</strong></p></body></html>");
					die();
				}

				//Connect to database, localhost; if not, die process
				if(!($database = mysql_connect("localhost", "root", "COMP484!")))
					die ("Could not connect to database </body></html>");

				//Open database called lab4; if not, die process
				if(!mysql_select_db("lab4", $database))
					die("Could not open lab4 database </body></html>");
				
				//Login Page
				if($pageNum === 2)
				{
					//Attain the password (hashed) and salt matching the username that was inputted by the user
					$result=mysql_query("SELECT password, salt FROM user WHERE username = '" . $user . "'");

					//Get array containing values of password and salt
					$row = mysql_fetch_row($result);

					//hash the user inputted password with the salt stored to the username
					$hashCheck=hash('sha512', $pass . $row[1]);

					//If the hashes do not match, then login authenication fails
					if($hashCheck != $row[0]) 
					{
						die("<p>Wrong password or username. Please retry.</p></body></html>");
					} 
					else //else login is good
					{
						echo("<p>Hello $user, you have successful logged in!</p>");
					}
				}
/*commented out registration related
				//Register Page
				else if($pageNum === 3)
				{
					//Attain the matching username that was inputted by the user (if any)
					$result=mysql_query("SELECT username FROM user WHERE username = '" . $user . "'");
					//Get array containing values of password and salt
					$row = mysql_fetch_row($result);
					//If there does not exist a row with the same entry for username, then 
					if($row[0] != $user) 
					{
						//Create salt; hash the password and appended salt
						$salt= openssl_random_pseudo_bytes(16);
						$hash= hash('sha512', $pass . $salt);

						//Insert into user table the username, password (hashed), and salt for future reference
						$sql="INSERT INTO user (username, password, salt) VALUES ('" . $user . "', '" . $hash . "', '" . mysql_real_escape_string($salt) . "' )";
						if (!mysql_query($sql, $database)) //Check for errors
							die('Error: ' . mysql_error());
						else 
							echo "Hello $user, your record has been added!"; 
					}
					else //Username exists
					{
						echo("<p>Username already exists. Please retry.</p>");
					}
				}
				*/
		?>

		<form method="post" 
			action="<?php echo $_SERVER['PHP_SELF']; ?>">
				
			<input type="hidden" name="page" value="1">
			<p><input type="submit" value="Back to Login/Registration"></p>
		</form>
			
		<?php
			}
		?>
		<hl><br><br><br>
	</body>
</html>