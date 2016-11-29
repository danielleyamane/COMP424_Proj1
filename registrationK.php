<!DOCTYPE HTML>  
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
  </script>
</head>
<body>  

<?php
// define variables and set to empty values
$username = $password = $birthdayYear = $birthdayMonth = $birthdayDay = $fname = $lname = $email =  "";
//Below is the error msg to tell user that it cannot be left blank.
$usernameErr = $passwordErr = $birthdayErr = $nameErr = $emailErr =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $usernameErr = "Username is required";
  } else {
    $username = test_input($_POST["username"]);
  }
  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  }else{
    $password = test_input($_POST["password"]);
  }
  if ((empty($_POST["birthdayYear"])) ||(empty($_POST["birthdayMonth"])) || (empty($_POST["birthdayDay"]))) {
    $birthdayYear = "Birthday is required";
  }else{
    $birthdayYear = test_input($_POST["birthdayYear"]);
    $birthdayMonth = test_input($_POST["birthdayMonth"]);
    $birthdayDay = test_input($_POST["birthdayDay"]);
  }
  if ((empty($_POST["fname"])) || (empty($_POST["lname"]))) {
    $nameErr = "Full name is required";
  } else {  
    $fname = test_input($_POST["fname"]);
    $lname = test_input($_POST["lname"]);
  }
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
  }
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<h1>My Company User Registration<h1>
<h2>Register</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <input type="hidden" name="page" value="3">
  <p><label for="username">Username: 
    <input type="text" name="username" id="username">
  </label></p>
  <p><label for="password">Password:
    <input type="password" name="password" id="password">
    <div class="progress progress-striped active">
    <div id="jak_pstrength" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
    </div>
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
  <p>
    <select name="securityQuestions1">
      <option value="sq1">What is the first name of the person you first kissed?</option>
      <option value="sq2">What is the last name of the teacher who gave you your first failing grade?</option>
      <option value="sq3">What was the name of elementary school?</option>
    </select>
    <p>
    <input type="securityAnswer" name="securityAnswer1" id="securityAnswer1">
    </p>
    </p>
    <p>
    <select name="securityQuestions2">
      <option value="sq4">What was the name of your first pet?</option>
      <option value="sq5">In what city/town does your yongest sibling live?</option>
    </select>
    <p>
    <input type="securityAnswer" name="securityAnswer2" id="securityAnswer2">
    </p>
    </p>

  <p><input type="submit" value="SUBMIT"></p>

</form>