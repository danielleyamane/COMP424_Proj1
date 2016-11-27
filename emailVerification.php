
<?php
// multiple recipients
$to  = 'danielle.yamane.877@my.csun.edu'; //. ', '; // note the comma
//$to .= 'wez@example.com';

// subject
$subject = 'testing424COMP';

// message
$message = '
<html>
<head>
  <title>Test Title</title>
</head>
<body>
  <p>Loving it! Maybe i should eat before i march to Mcdonald</p>
  
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: Kelly <kelly@example.com>' . "\r\n";
$headers .= 'From: COMP424 <noreply@comp424.com>' . "\r\n";


// Mail it
mail($to, $subject, $message, $headers);
?>
