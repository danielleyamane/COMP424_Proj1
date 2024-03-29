<?php
require_once __DIR__ . '/recaptcha/src/autoload.php';
$siteKey = '6LcfFQ0UAAAAAE3D0vV5C2T4m1VusBDwENBJbATY';
  $secret = '6LcfFQ0UAAAAAIui17AvFWh6nEQr1bMt4gXj0rSA';
?>
<!DOCTYPE HTML>  
<html>
<head>
  <title>424 Company</title>
  <style>
  body.padding{
    padding-left: 1cm;
  }
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>

   <script type="text/javascript">
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


  jQuery(document).ready(function(){
    jQuery("#password").keyup(function() {
      passwordStrength(jQuery(this).val());
    });
  });
  function checkPasswordMatch() {
    var p1 = document.getElementById("password").value;
    var p2 = document.getElementById("passwordc").value;
    var confirm = true;
      //to not display anything if password field is empty 
      if (p1 == ""){
      }else if (p1 != p2){
          $("#divCheckPasswordMatch").html("Passwords do not match!");
      }else{
          $("#divCheckPasswordMatch").html("Passwords match.");
      }
  }

  $(document).ready(function () {
     $("#password, #passwordc").keyup(checkPasswordMatch);
  });
  </script>
  <style>
  .error {color: #FF0000;}
  </style>
</head>
<body class="padding">  

<?php
// define variables and set to empty values
$username = $password = $birthdayYear = $birthdayMonth = $birthdayDay = $birthday = $fname = $lname = $email = $securityAnswer1 = $securityAnswer2 = "";
//Below is the error msg to tell user that it cannot be left blank.
$usernameErr = $passwordErr = $birthdayErr = $nameErr = $emailErr = $securityA1Err = $securityA2Err = "";
$errCount = 0;
$recaptcha = new \ReCaptcha\ReCaptcha($secret);
$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
if ($resp->isSuccess()) {

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
      $usernameErr = "Username is required";
      $errCount++;
    } else {
      $username = test_input($_POST["username"]);
    }
    if (empty($_POST["password"])) {
      $passwordErr = "Password is required";
          $errCount++;

    }else{
      $password = test_input($_POST["password"]);
    }
    if ((empty($_POST["YYYY"])) || (empty($_POST["MM"])) || (empty($_POST["DD"]))) {
      $birthdayErr = "Birthday is required";
          $errCount++;

    }else{
      $birthdayYear = test_input($_POST["YYYY"]);
      $birthdayMonth = test_input($_POST["MM"]);
      $birthdayDay = test_input($_POST["DD"]);
      $birthday = $_POST["YYYY"] . '-'. $_POST["MM"] . '-' . $_POST["DD"];
    }       
    if ((empty($_POST["firstname"])) || (empty($_POST["lastname"]))) {
      $nameErr = "Full name is required";
          $errCount++;

    } else {  
      $fname = test_input($_POST["firstname"]);
      $lname = test_input($_POST["lastname"]);
    }
    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
          $errCount++;

    } else {    
      $email = test_input($_POST["email"]);
    }
    if (empty($_POST["securityAnswer1"])) {
      $securityA1Err = "Answer is required";
          $errCount++;

    }               
    else { 
      $securityAnswer1 = test_input($_POST["securityAnswer1"]);
    }
    if (empty($_POST["securityAnswer2"])) {
      $securityA2Err = "Answer is required";
          $errCount++;

    } else { 
      $securityAnswer2 = test_input($_POST["securityAnswer2"]);
    } 
    
    $securityQ1 = $_POST['securityQuestions1'];
    $securityQ2 = $_POST['securityQuestions2'];
    if($errCount > 0){
        //don't do sql calls
      echo "Please fill all required fields";
    }else{
      //Connect to database, localhost; if not, die process
      if(!($database = mysqli_connect("localhost", "root", "COMP424", "COMP424"))) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        die ("Could not connect to database </body></html>");
      }

      //Attain the matching username that was inputted by the user (if any)
      $result=mysqli_query($database, "SELECT username FROM user WHERE username = '" . $username . "'");
      //Get array containing values of password and 
      $row = mysqli_fetch_row($result);

      //If there does not exist a row with the same entry for username, then 
      if($row[0] != $username) 
      {           
        $password = password_hash($password, PASSWORD_DEFAULT);

        //Insert into user table the information for future reference
        $sql="INSERT INTO user (username, password, firstname, lastname, birthdate, email, firstQ, firstA, secondQ, secondA) VALUES ('" . $username . "', '" . $password  . "', '" . $fname . "', '" . $lname . "', '" . $birthday . "', '" . $email . "', '" . $securityQ1 . "', '" . $securityAnswer1 . "', '" . $securityQ2 . "', '" . $securityAnswer2 . "')";
        if (!mysqli_query($database, $sql))  //Check for errors
          die('Error: ' . mysqli_error());
        else {
          $message = "Hello ".$fname.", your record has been added!"; 
          echo "<script type='text/javascript'>alert('$message');</script>"; 
            
        }
      }
      else //Username exists
      {
        echo("<p>Username already exists. Please retry.</p>");
      }
    } 
    
  }
 
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = strip_tags($data);
  $data = htmlspecialchars($data);
  return $data;
} 
?>

<h1>My Company User Registration</h1>
<!-- form field -->
<form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <div class = "form-group"><label for="username">Username: 
    <input type="text" name="username" id="username">
    <span class="error">*<?php echo $usernameErr;?></span>
  </label></div>
  <div class = "form-group"><label for="password">Password:
    <input type="password" name="password" id="password">
    <span class="error">*<?php echo $passwordErr;?></span>
    </label></div>
    <div class = "form-group"><label for="password">Confirm Password:
        <input type="password" name="passwordc" id="passwordc">
        <div class="registrationFromAlert" id="divCheckPasswordMatch"></div>
    </label></div>
    <!--password strength bar-->
    <div class="progress progress-striped active">
    <div id="jak_pstrength" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
    </div>
        
  <div class = "form-group"><label for="fname">First Name: 
    <input type="text" name="firstname" id="fname">
    <span class="error">*<?php echo $nameErr;?></span>
  </label></div>
  <div class = "form-group"><label for="lname">Last Name: 
    <input type="text" name="lastname" id="lname">
  </label></div>
  <div class = "form-group"><label for = "birthday">Birthday: 
    Year <input type="integer" size="4" maxlength="4" name="YYYY" id="birthdayYear">
    Month <input type="integer" size="2" maxlength="2" name="MM" id="birthdayMonth">
    Day <input type="integer" size="2" maxlength="2" name="DD" id="birthdayDay">
    <span class="error">*<?php echo $birthdayErr;?></span>
  </label></div>
  <div class = "form-group"><label for="email">E-mail:
    <input type="email" name="email" id="email">  
    <span class="error">*<?php echo $emailErr;?></span>
  </label></div>
  <div class = "form-group"><label for = "securityAnswer"></label>
    <select name="securityQuestions1">
      <option value="">Select Security Question 1</option>
      <option value="1">What is the first name of the person you first kissed?</option>
      <option value="2">What is the last name of the teacher who gave you your first failing grade?</option>
      <option value="3">What was the name of elementary school?</option>
    </select>
    <p>
      <input type="securityAnswer" name="securityAnswer1" id="securityAnswer1">
      <span class="error">*<?php echo $securityA1Err;?></span>
    </p>
  </div>
  <div class = "form-group"><label for = "securityAnswer"></label>
    <select name="securityQuestions2">
      <option value="">Select Security Question 2</option>
      <option value="4">What was the name of your first pet?</option>
      <option value="5">In what city/town does your yongest sibling live?</option>
    </select>
    <p>
      <input type="securityAnswer" name="securityAnswer2" id="securityAnswer2">
      <span class="error">*<?php echo $securityA2Err;?></span>
    </p>
  </div>
    <!--recapchat-->
  <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
  <p><input type="submit" value="SUBMIT"></p>

</form>

</body>
</html>
