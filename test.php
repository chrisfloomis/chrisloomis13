<?php 
$to = "chrisloomis13@chrisloomis13.com";
$subject = "Test mail";
$message = "Hello! This is a simple test email message.";
$from = "christopherfrenchloomis@gmail.com";
$headers = "From:" . $from;
if(mail($to,$subject,$message,$headers)){
	echo "<p>Success</p>";
} else {
	echo "<p>Fail</p>";
}
echo "Mail Sent.";
?>