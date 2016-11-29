<!DOCTYPE html>
<html>
	<head>
		<title>COMP 424 - Project 1/Phase I</title>
	</head>
	<body>
		<h1>Login</h1>
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
			<form method="post" 
				action="<?php echo $_SERVER['PHP_SELF']; ?>">
				
				<input type="hidden" name="page" value="2">
				<p><label>Username: 
					<input type="text" name="username">
				</label></p>
				<p><label>Password:
					<input type="password" name="password">
				</label></p>
				<p><input type="submit" value="SUBMIT"></p>
			</form>

			<a href="/registration.php">New User? Sign up</a>

			<br></br>

			<a href="/forgotpass.php">Forgot Username or Password?</a>

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
				if(!($database = mysqli_connect("localhost", "root", "comp424", "COMP424")))
					die ("Could not connect to database </body></html>");
				
				//Login Page
				if($pageNum === 2)
				{
					//Attain the password (hashed) and salt matching the username that was inputted by the user
					$result=mysqli_query($database, "SELECT password FROM user WHERE username = '" . $user . "'");

					//Get array containing values of password and salt
					$row = mysqli_fetch_array($result, MYSQLI_NUM);

					date_default_timezone_set('America/Los_Angeles');
					$date = date ('m/d/Y h:i:s a');
					echo $date;

					//If the hashes match, then login authenication is a success
					if(password_verify($pass, $row[0])) 
					{
						echo("<p>Hello $user, you have successful logged in!</p>");
					} 
					else //else login fails
					{
						die("<p>Wrong password or username. Please retry.</p></body></html>");
					}
				}

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
