<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "berlin+contact@numa.co";
    $email_subject = "Website Contact from berlin.numa.co";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['comments'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $comments = $_POST['comments']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
 
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "<h3>Contact from the berlin.numa.co Website.</h3>";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     $first_name = clean_string($first_name);
     $last_name = clean_string($last_name);
     $email_from = clean_string($email_from);
     $comments = clean_string($comments);
 
    $email_message .= "<strong>First Name:</strong> ".$first_name."<br>";
    $email_message .= "<strong>Last Name:</strong> ".$last_name."<br>";
    $email_message .= "<strong>Email:</strong> ".$email_from."<br>";
    $email_message .= "<strong>Comments:</strong> ".$comments."<br>";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
$headers .= "Reply-To: ". $email_from . "\r\n";
$headers .= "CC: darius.m@numa.co\r\n"; //If you want to cc someone - go ahead
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
@mail($email_to, $email_subject, $email_message, $headers);  
header('location: http://berlin.numa.co/thanks.html');
?>
 
<!-- include your own success html here -->
 
<p>Thank you for contacting us. We will be in touch with you very soon.</p>

<p><a href="http://berlin.numa.co">Back to berlin.numa.co</a></p>
 
<?php

}
?>