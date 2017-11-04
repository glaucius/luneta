<?php

require_once('include/PHPMailer/class.phpmailer.php');

$mail = new PHPMailer(true);

$mail->IsSMTP();

try {
  $mail->Host       = "localhost"; // SMTP server
  $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = false;                  // enable SMTP authentication
  $mail->Host       = "localhost"; // sets the SMTP server
  $mail->Port       = 25;                    // set the SMTP port for the GMAIL server
  $mail->Username   = "glaucius@glaucius.com"; // SMTP account username
  $mail->Password   = "drivhus2009";        // SMTP account password
  $mail->AddReplyTo('glacius@gmail.com', 'Glaucius Junior');
  $mail->AddAddress('glaucius@gmail.com', 'Glaucius Gmail');
  $mail->SetFrom('glaucius@gmail.com', 'Glaucius Junior');
  $mail->Subject = 'Envio de email do sistema ';
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML(file_get_contents('contents.html'));
  $mail->AddAttachment('images/phpmailer.gif');      // attachment
  $mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
  $mail->Send();
  echo "Message Sent OK</p>\n";
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
?>


