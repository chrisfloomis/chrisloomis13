<?php	//https://webdesign.tutsplus.com/tutorials/building-a-bootstrap-contact-form-using-php-and-ajax--cms-23068
$to = "chrisloomis13@chrisloomis13.com";
$from = $_POST['email'];
$msg = $_POST['msg'];

$txt = "Hello world!";
$headers = "From: " . $from;

mail($to,$msg,$txt,$headers);

echo "{ email :" . $to . ", msg :" . $msg . "}";
?>