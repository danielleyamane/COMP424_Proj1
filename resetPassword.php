<?php
   session_start(); 
   $email = $_SESSION['email'];
    
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = strip_tags($data);
  $data = htmlspecialchars($data);
  return $data;
} 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["password"])) {
    echo 'Please enter password';    
  }else{
    $password = test_input($_POST["password"]);
    if(!($database = mysqli_connect("localhost", "root", "COMP424", "COMP424"))) {
      echo "Error: Unable to connect to MySQL." . PHP_EOL;
      echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
      echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
      die ("Could not connect to database </body></html>");
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql="UPDATE user SET password='".$password."' WHERE email ='".$email."';";
    if (!mysqli_query($database, $sql))  //Check for errors
        die('Error: ' . mysqli_error());
      else {
        $message = "Your password has been updated.";
        echo "<script type='text/javascript'>alert('$message');</script>"; 
      }
  }
  exit;
}
?>
<html>
<head>
  <title>424 Company</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script>

  //js to track password credencial
  /* Password strength indicator */
function passwordStrength(password) {

  var desc = [{'width':'0px'}, {'width':'20%'}, {'width':'40%'}, {'width':'60%'}, {'width':'80%'}, {'width':'100%'}];
  
  var descClass = ['', 'progress-bar-danger', 'progress-bar-danger', 'progress-bar-warning', 'progress-bar-success', 'progress-bar-success'];

  var score = 0;

  //if password bigger than 6 give 1 point
  if (password.length > 6) score++;

  //if password has both lower and uppercase characters give 1 point  
  if ((password.match(/[a-z]/)) && (password.match(/[A-Z]/))) score++;

  //if password has at least one number give 1 point
  if (password.match(/d+/)) score++;

  //if password has at least one special caracther give 1 point
  if ( password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) ) score++;

  //if password bigger than 12 give another 1 point
  if (password.length > 10) score++;
  
  // display indicator
  $("#jak_pstrength").removeClass(descClass[score-1]).addClass(descClass[score]).css(desc[score]);
}
//jquery to track password input
jQuery(document).ready(function(){
  jQuery("#password").focus();
  jQuery("#password").keyup(function() {
    passwordStrength(jQuery(this).val());
  });
});
function checkPasswordMatch() {
  var password = $("#password").val();
  var confirmPassword = $("#passwordc").val();

    if (password != confirmPassword)
        $("#divCheckPasswordMatch").html("Passwords do not match!");
    else
        $("#divCheckPasswordMatch").html("Passwords match.");
}

$(document).ready(function () {
   $("#password, #passwordc").keyup(checkPasswordMatch);
});
</script>
</head>
<body>
 	<h2>Please reset your password</h2>
 	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
	  <div class ="form-group">
    <label for="password">New Password:
    <input type="password" name="password" id="password">
    </label></div>
    <div class ="form-group">
    <label for="password">Confirm Password:
        <input type="password" name="passwordc" id="passwordc">
        <div class="registrationFromAlert" id="divCheckPasswordMatch"></div>
    </label></div>
    <div class="progress progress-striped active">
    	<div id="jak_pstrength" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
    </form>    
 </body>
 </html>
