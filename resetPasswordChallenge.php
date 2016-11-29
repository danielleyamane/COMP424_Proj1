<?php 

   session_start(); 
   $array = $_SESSION['array'];
   echo $array[0];
   echo $array[1];
   echo $array[2];
   echo $array[3];
   echo $array[4];
	
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		//if any of them are not answered
		if(empty($_POST["answer1"]) || empty($_POST["answer2"]) || empty($_POST["sel1"]) ||empty($_POST["sel2"]) ){
			echo 'PLEASE CHOOSE THE QUESTIONs AND ANSWER THEM.';
		}else{
			//compare answers
			if(($_POST["sel1"] == $array[1]) && ($_POST["answer1"] == $array[2]) && ($_POST["sel2"] == $array[3]) && ($_POST["answer2"] == $array[4])){
				//correct credentials
		    	$_SESSION['email'] = $array[0];
		    	header("Location: resetPassword.php");
			}else{
				echo 'FAIL!';
			}
		}
	}

?>

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
	<br>
	<div class="container">
	 <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <div class="form-group">
	  	<label for="sel1">Select security question:</label>
      	<select class="form-control" id="sel1" name="sel1">
      		<option value=""></option>
			<option value="1">What is the first name of the person you first kissed?</option>
      		<option value="2">What is the last name of the teacher who gave you your first failing grade?</option>
      		<option value="3">What was the name of elementary school?</option>
      	</select>
      	<br>
	    <label for="email">Answer1:</label>
	      <input type="answer1" class="form-control" id="answer1" name="answer1" placeholder="Answer for security question">
	    </div>
	    <br>
	  <div class="form-group">
		<label for="sel1">Select security question:</label>
		<select class="form-control" id="sel2" name="sel2">
			<option value=""></option>
			<option value="4">What was the name of your first pet?</option>
      		<option value="5">In what city/town does your yongest sibling live?</option>
		</select>
		<br>
	    <label for="pwd">Answer2:</label>
	      <input type="answer2" class="form-control" id="answer2" name="answer2" placeholder="Answer for security question">
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