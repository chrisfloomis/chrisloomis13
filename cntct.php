<?php
//if "email" variable is filled out, send email
  if (isset($_REQUEST['email']))  {
  
  //Email information
  $admin_email = "chrisloomis13@chrisloomis13.com";
  $email = $_REQUEST['email'];
  $subject = "chrisloomis13 - Contact Form";
  $comment = $_REQUEST['msg'];
  
  //send email
  mail($admin_email, $subject, $comment, "From:" . $email);
  
  //Email response
  echo "Thank you for contacting us!";
  }
?>