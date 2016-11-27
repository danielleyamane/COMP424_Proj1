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
 	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
	  <p><label for="password">Password:
    <input type="password" name="password" id="password">
    </label></p>
    <div class="progress progress-striped active">
    	<div id="jak_pstrength" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
    </div>
    <p><labe for="password">Confirm Password:
        <input type="password" name="passwordc" id="passwordc">
	</label></p>
	<div class="registrationFromAlert" id="divCheckPasswordMatch"></div>
 </body>
 </html>
