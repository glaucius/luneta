<?

include('include/config.inc.php');

$email="glaucius@gmail.com";
$host="drivus.com.br";
$error="merda";
$service="smtp";


function send_email_error($email, $host, $error, $service, $mail_config_smtp) {

$mail = new PHPMailer(true);

$mail->IsSMTP();

try {
  $mail->SMTPAuth   = false;
  $mail->Host       = $mail_config_smtp[1]; // sets the SMTP server
  $mail->Port       = $mail_config_smtp[2];                    // set the SMTP port for the GMAIL server
  $mail->Username   = $mail_config_smtp[3]; // SMTP account username
  $mail->Password   = $mail_config_smtp[4];        // SMTP account password
  $mail->AddAddress($email);
  $mail->SetFrom("$mail_config_smtp[5]", "$mail_config_name[8]");
  $mail->Subject = "$mail_config_smtp[6]  $host ";
  $mail->AltBody = "$mail_config_smtp[7]";
  $mail->MsgHTML(file_get_contents('contents.html'));
  $mail->Body = "Hi, the monitor $host is Down <p> Luneta Team <p> http://luneta.sf.net ";
  $mail->AddAttachment("images/phpmailer.gif");      // attachment
  $mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
  $mail->Send();
  echo "Message Sent OK</p>\n";
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}

}

$mail_config_smtp=array($smtp_auth, $smtp_server, $smtp_port, $smtp_username, $smtp_password, $smtp_from, $send_mail['subject'], $send_mail['body'], $smtp_from_name);

send_email_error($email, $host, $error, $service, $mail_config_smtp);

?>



