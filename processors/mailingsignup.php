<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "berlin+newsletter@numa.co";
    $email_subject = "Mailing List Signup from berlin.numa.co";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['email'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 

    $email_from = $_POST['email']; // required
  
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
 
    $email_message = "<h3>Mailing list signup from berlin.numa.co.</h3>";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
 
     $email_from = clean_string($email_from);

 
    $email_message .= "<strong>Email:</strong> ".$email_from."<br>";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
$headers .= "Reply-To: ". $email_from . "\r\n";
//$headers .= "CC: test@example.com\r\n"; //If you want to cc someone - go ahead
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
@mail($email_to, $email_subject, $email_message, $headers);  
header('location:http://berlin.numa.co/thanks-list.html');
?>
 
<!-- include your own success html here -->
<p>Thank you. You are now signed up to the mailing list.</p>

<p><a href="http://berlin.numa.co">Back to berlin.numa.co</a></p>
 
<?php

}
?>