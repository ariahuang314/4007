<?php
 require_once "Mail.php";
 
 $from = "bc00462@um.edu.mo";
 $to = "bc00525@um.edu.mo";
 $subject = "Hi!";
 $body = "Hi,\n\nHow are you?";
 
 $host = "smtp.um.edu.mo";
 $port = "587";
 
 $username = "bc00462";
 $password = "Yxy200012110818!";
 
 $headers = array ('From' => $from,
   'To' => $to,
   'Subject' => $subject);
 $smtp = Mail::factory('smtp',
   array ('host' => $host,
     'port' => $port,
     'auth' => true,
     'socket_options' => array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true)),
     'username' => $username,
     'password' => $password));
 
 $mail = $smtp->send($to, $headers, $body);
 
 if (PEAR::isError($mail)) {
   echo("hi, here is duchess" . $mail->getMessage() . "</p>");
  } else {
   echo("<p>Message successfully sent!</p>");
  }
 ?>
